<?php
/**
 * The htmlSaveComplete class can be used to save specified URLs completely in single file
 * by converting images to data URIs and extracting all CSS.
 *
 * Author: Sarfraz Ahmed
 * http://sarfraznawaz.wordpress.com
 *
 *
 * NOTE: If you are using this class, please keep above author information intact. Thanks
 */

/* Issues
 ---------------------------------------------------------
Does not convert images from @import URLs to data URIs, removed this (eg not using getImportStyles function)
due to performance issue.
*/

set_time_limit(300); // no more than 5 minutes !!!

require_once 'includes/content_extractor.php'; # class to extract "main" content part of given page
require_once 'includes/url_to_absolute.php'; # or implement your own function to convert relative URLs to absolute

class htmlSaveComplete
{

    # set debug mode on or off with 1, 0 or true, false respectively
    const DEBUG = 0;

    # holds debug data
    private $debugOutput = array();
    # url to save complete page from
    private $url = '';
    # set user agent mode on or off with 1, 0 or true, false respectively
    private $useUserAgent = FALSE;
    # holds parsed html
    private $html = '';
    # holds DOM object
    private $dom = '';

    /**
     *  The constructor function. Allows setting url to save data from and whether to use user agent.
     *
     * @param $url - url to save complete page from.
     * @param bool $useUserAgent - whether to use user agent to get page data
     *
     * @throws exception - throws an exception if provided url isn't in proper format
     */
    public function __construct($url, $useUserAgent = FALSE)
    {
        # see if Data URIs are supported by the browser
        $isDatauriSupported = preg_match('#(Opera|Gecko|MSIE 8)#', $_SERVER['HTTP_USER_AGENT']);

        if (! $isDatauriSupported)
        {
            throw new Exception('Your Browser does not support Data URIs');
        }

        # validate the URL
        if (! filter_var($url, FILTER_VALIDATE_URL))
        {
            throw new Exception('Invalid URL. Make sure to specify http(s) part.');
        }

        $this->url = $url;
        $this->useUserAgent = $useUserAgent;

        # suppress DOM parsing errors
        libxml_use_internal_errors(TRUE);

        $this->dom = new DOMDocument();
        $this->dom->preserveWhiteSpace = FALSE;
        # avoid strict error checking
        $this->dom->strictErrorChecking = FALSE;
    }

    /**
     * Gets complete page data and returns generated string
     *
     * @param bool $keepjs - whether to keep javascript
     * @param bool $contentOnly - whether to extract main content part of the page only
     * @param bool $compress - whether to remove extra whitespac
     *
     * @return string|void
     */
    public function getCompletePage($keepjs = FALSE, $contentOnly = FALSE, $compress = FALSE)
    {
        $scriptBuffer = '';
        $cssBuffer = '<style>';

        if ($this->useUserAgent)
        {
            $this->html = $this->getUrlContents($this->url);
        }
        else
        {
            $this->html = file_get_contents($this->url);
        }

        # get document stylesheets
        $stylesheets = $this->getStyleSheets();

        foreach ($stylesheets as $stylesheet)
        {
            $cssBuffer .= $this->getContents($this->getFullUrl($stylesheet)) . "\r\n\r\n";
        }

        # get @import URLS and merge it in CSS
//      $importURLs = $this->getImportStyles();
//
//      foreach ( $importURLs as $importURL )
//      {
//          $cssBuffer .= $this->getContents( $this->getFullUrl($importURL) ) . "\r\n\r\n";
//      }

        $cssBuffer .= '</style>' . "\r\n\r\n";

        # get document scripts
        if ($keepjs)
        {
            $scriptBuffer .= '<script>';
            $scripts = $this->getScripts();

            foreach ($scripts as $script)
            {
                $scriptBuffer .= $this->getContents($this->getFullUrl($script)) . "\r\n\r\n";
            }

            $scriptBuffer .= '</script>' . "\r\n\r\n";
        }

        # convert URLs from CSS styles to data URIs
        $cssBuffer = $this->toDataUri($cssBuffer);

        # remove useless stuff such as <link>, <meta> and <script> tags
        $this->removeUseless($keepjs);

        # convert URLs from @import styles to data URIs
        $this->html = $this->toDataUri($this->html);

        # see if we need to extract main content part
        if ($contentOnly)
        {
            $extractor = new ContentExtractor();
            $this->html = $extractor->extract($this->html);
        }

        # convert <img> tags to data URIs
        $this->convertImageToDataUri();

        # convert all relative links for <a> tags to absolute
        $this->toAbsoluteURLs();

        # finally join the css and html and insert information header
        if (strlen($this->html) > 300)
        { # we did get some html back
            $this->html = $cssBuffer . $scriptBuffer . $this->html;
            $this->insertHeader();

            if (self::DEBUG)
            {
                $this->showDebugInfo();
                exit();
            }

            if ($compress)
            {
                return $this->compress($this->html);
            }
            else
            {
                return $this->html;
            }
        }
        else
        {
            return '';
        }
    }

    /**
     * Converts images to data URIs
     */
    private function convertImageToDataUri()
    {
        $tags = $this->getTags('//img');
        $tagsLength = $tags->length;

        # loop over all <img> tags and convert them to data uri
        for ($i = 0; $i < $tagsLength; $i ++)
        {
            $tag = $tags->item($i);
            $src = $this->getFullUrl($tag->getAttribute('src'));

            if ($this->remote_file_exists($src))
            {
                $dataUri = $this->imageToDataUri($src);
                $tag->setAttribute('src', $dataUri);
            }
        }

        # now save html with converted images
        $this->html = $this->dom->saveHTML();
    }

    /**
     * Returns tags list for specified selector
     *
     * @param $selector - xpath selector expression
     *
     * @return DOMNodeList
     */
    private function getTags($selector)
    {
        $this->dom->loadHTML($this->html);
        $xpath = new DOMXpath($this->dom);
        $tags = $xpath->query($selector);

        # free memory
        libxml_use_internal_errors(FALSE);
        libxml_use_internal_errors(TRUE);
        libxml_clear_errors();
        unset($xpath);
        $xpath = NULL;

        return $tags;
    }

    /**
     * Converts URLs with format url(....) to data URIs
     *
     * @param $html
     *
     * @return mixed
     */
    private function toDataUri($html)
    {
        # convert css URLs to data URIs
        $html = preg_replace_callback('#(url\([\'\"]?)([^\"\'\)]+)([\"\']?\))#', array($this, 'createDataUri'), $html);

        return $html;
    }

    /**
     * Inserts htmlSaveComplete information header on very start of page
     */
    private function insertHeader()
    {
        $header = '<!-- This page was saved with htmlSaveComplete (http://sarfraznawaz.wordpress.com) -->' . "\r\n\r\n";
        $this->html = $header . $this->html;
    }

    /**
     * Checks whether or not remote file exists
     *
     * @param $url
     *
     * @return bool
     */
    private function remote_file_exists($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        # don't download content
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        if (curl_exec($ch) !== FALSE)
        {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Converts images from <img> tags to data URIs
     *
     * @param $path - image path eg src value
     *
     * @return string - generated data uri
     */
    private function imageToDataUri($path)
    {
        $fileType = trim(strtolower(pathinfo($path, PATHINFO_EXTENSION)));
        $mimType = $fileType;

        # since jpg/jpeg images have image/jpeg mime-type
        if (! $fileType || $fileType === 'jpg')
        {
            $mimType = 'jpeg';
        }
        else
        {
            if ($fileType === 'ico')
            {
                $mimType = 'x-icon';
            }
        }

        # make sure that it is an image and convert to data uri
        if (preg_match('#^(gif|png|jp[e]?g|bmp)$#i', $fileType) || $this->isImage($path))
        {
            # in case of images from gravatar, etc
            if ($mimType === 'php' || stripos($mimType, 'php') !== FALSE)
            {
                $mimType = 'jpeg';
            }

            $data = $this->getContents($path);
            $base64 = 'data:image/' . $mimType . ';base64,' . base64_encode($data);

            return $base64;
        }
    }

    /**
     * Removes <link>, <meta> and <script> tags from generated page
     */
    private function removeUseless($keepjs)
    {
        # remove empty lines
        //$this->html = preg_replace('#(\r\n[ \t]*){2,}#', "\r\n", $this->html);

        # remove @import declarations
        //preg_replace('#(@import url\([\'\"]?)([^\"\'\)]+)([\"\']?\))#', '', $this->html);

        # fix showing up of garbage characters
        $this->html = mb_convert_encoding($this->html, 'HTML-ENTITIES', 'UTF-8');

        $tags = $this->getTags('//meta | //link | //script');

        $tagsLength = $tags->length;

        # get all <link>, <meta> and <script> tags and remove them
        for ($i = 0; $i < $tagsLength; $i ++)
        {
            $tag = $tags->item($i);

            # delete only external scripts
            if (strtolower($tag->nodeName) === 'script')
            {
                if ($keepjs)
                {
                    if ($tag->getAttribute('src') !== '')
                    {
                        $tag->parentNode->removeChild($tag);
                    }
                }
                else
                {
                    $tag->parentNode->removeChild($tag);
                }
            }
            elseif (strtolower($tag->nodeName) === 'meta')
            {
                # keep the charset meta
                if (stripos($tag->getAttribute('content'), 'charset') === FALSE)
                {
                    $tag->parentNode->removeChild($tag);
                }
            }
            else
            {
                $tag->parentNode->removeChild($tag);
            }
        }

        $this->html = $this->dom->saveHTML();
    }

    /**
     * Gets all external stylesheets of the page
     *
     * @return array
     */
    private function getStyleSheets()
    {
        $styleSheets = array();
        $links = $this->getTags('//link[contains(@rel, "stylesheet")]');

        foreach ($links as $link)
        {
            if (self::DEBUG)
            {
                $this->debugStore(array('stylesheet' => $link->getAttribute('href')));
            }

            array_push($styleSheets, $link->getAttribute('href'));
        }

        return $styleSheets;
    }

    /**
     * Gets all external scripts of the page.
     *
     * @return array
     */
    private function getScripts()
    {
        $scripts = array();
        $links = $this->getTags('//script[contains(@src, "")]');

        foreach ($links as $link)
        {
            //$src = preg_replace('#\?.*#', '', $link->getAttribute('src'));
            $src = $link->getAttribute('src');

            if (strpos($src, '.js') !== FALSE)
            {
                if (self::DEBUG)
                {
                    $this->debugStore(array('script' => $src));
                }

                array_push($scripts, $src);
            }
        }

        return $scripts;
    }

    /**
     * Gets all
     *
     * @import URLs
     *
     * @return array
     */
    private function getImportStyles()
    {
        $importURLs = array();
        $styles = $this->getTags('//style');

        foreach ($styles as $style)
        {
            $content = $style->textContent;
            preg_match_all('#(@import url\([\'\"]?)([^\"\'\)]+)([\"\']?\))#', $content, $matches);

            if (isset($matches[2]) && count($matches[2]))
            {
                foreach ($matches[2] as $importUrl)
                {
                    $importURLs[] = $importUrl;
                }
            }
        }

        return $importURLs;
    }

    /**
     * Converts relative <a> tag paths to absolute paths
     */
    private function toAbsoluteURLs()
    {
        $links = $this->getTags('//a');

        foreach ($links as $link)
        {
            $link->setAttribute('href', $this->getFullUrl($link->getAttribute('href')));
        }

        $this->html = $this->dom->saveHTML();
    }

    /**
     * Compresses generated page by removing extra whitespace
     */
    private function compress($string)
    {
        # remove whitespace
        return str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $string);
    }

    /**
     * Gets content for given url
     *
     * @param $url
     *
     * @return string
     */
    private function getContents($url)
    {
        $data = @file_get_contents($url);

        if ($data)
        {
            return $data;
        }

        return @file_get_contents(trim($url));
    }

    /**
     * Converts matched URLs to data URIs
     *
     * @param $matches
     *
     * @return string
     */
    private function createDataUri($matches)
    {
        $fileType = explode('.', $matches[2]);
        $fileType = trim(strtolower($fileType[count($fileType) - 1]));

        # replace ?whatever=value from extensions
        $fileType = preg_replace('#\?.*#', '', $fileType);
        $mimeType = $fileType;

        # since jpg/jpeg images have image/jpeg mime-type
        if ($fileType === 'jpg')
        {
            $mimeType = 'jpeg';
        }
        else
        {
            if ($fileType === 'ico')
            {
                $mimeType = 'x-icon';
            }
            else
            {
                if ($fileType === 'css')
                {
                    $mimeType = 'css';
                }
            }
        }

        $datauri = $this->getFullUrl($matches[2]);

        #if the file is an image from CSS URLs convert it to data uri
        if (preg_match('#^(gif|png|jp[e]?g|bmp|css)$#i', $fileType))
        {
            if (self::DEBUG)
            {
                $this->debugStore(array('datauri' => $datauri));
            }

            $data = $this->getContents($datauri);

            if (! $data)
            {
                # return whatever there was originally
                return $matches[0];
            }

            $data = base64_encode($data);

            $mime = $fileType === 'css' ? 'text' : 'image';

            return $matches[1] . 'data:' . $mime . '/' . $mimeType . ';base64,' . $data . $matches[3];
        }
        else
        {
            # return whatever there was originally
            return $matches[0];
        }

    }

    /**
     * Gets content for given url using curl and optionally using user agent
     *
     * @param $url
     * @param int $timeout
     * @param string $userAgent
     *
     * @return int|mixed
     */
    private function getUrlContents(
        $url,
        $timeout = 0,
        $userAgent = 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_8; en-US) AppleWebKit/534.10 (KHTML, like Gecko) Chrome/8.0.552.215 Safari/534.10'
    ) {
        $rawHtml = curl_init();
        curl_setopt($rawHtml, CURLOPT_URL, $url);
        curl_setopt($rawHtml, CURLOPT_RETURNTRANSFER, 1); # return result as string rather than direct output
        curl_setopt($rawHtml, CURLOPT_CONNECTTIMEOUT, $timeout); # set the timeout
        curl_setopt($rawHtml, CURLOPT_USERAGENT, $userAgent); # set our 'user agent'

        curl_setopt($rawHtml, CURLOPT_SSL_VERIFYPEER, false);

        $output = curl_exec($rawHtml);
        curl_close($rawHtml);

        if (! $output)
        {
            return - 1;
        }

        return $output;
    }

    /**
     * Converts relative URLs to absolute URLs
     *
     * @param $url
     *
     * @return bool|string
     */
    private function getFullUrl($url)
    {
        if (strpos($url, '//') === FALSE)
        {
            return url_to_absolute($this->url, $url);
        }

        return $url;
    }

    /**
     * Checks if provided path is an image
     *
     * @param $path
     *
     * @return bool
     */
    private function isImage($path)
    {
        list($width) = @getimagesize($path);

        if (isset($width) && $width)
        {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Stores debug information
     *
     * @param $data
     */
    private function debugStore($data)
    {
        if (self::DEBUG)
        {
            if (is_array($data))
            {
                foreach ($data as $key => $value)
                {
                    if (isset($this->debugOutput[$key]))
                    {
                        $this->debugOutput[$key . count($this->debugOutput)] = $value;
                    }
                    else
                    {
                        $this->debugOutput[$key] = $value;
                    }
                }
            }
            else
            {
                $this->debugOutput[] = $data;
            }
        }
    }

    /**
     * Shows debug information
     */
    private function showDebugInfo()
    {
        echo '<pre>';
        ksort($this->debugOutput);
        print_r($this->debugOutput);
        echo '</pre>';
    }

}