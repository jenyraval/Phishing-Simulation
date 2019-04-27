<?php
/*
	*** HTML Content Extractor class *** 
	Copyright 	: Janis Elsts, 2008
	Website 	: http://w-shadow.com/
	License 	: LGPL 
	Notes	 	: If you use it, please consider giving credit / a link :)
*/
class ContentExtractor
{
    var $container_tags = array(
        'div',
        'table',
        'td',
        'th',
        'tr',
        'tbody',
        'thead',
        'tfoot',
        'col',
        'colgroup',
        'ul',
        'ol',
        'html',
        'center',
        'span',
        'article',
        'section'
    );
//   var $removed_tags = array(
//      'script', 'noscript', 'style', 'form', 'meta', 'input', 'iframe', 'embed', 'hr', 'img',
//      '#comment', 'link', 'label'
//   );
    # in our case, removal is already done for needed tags in htmlSaveComplete class.
    var $removed_tags = array('#sidebar, #side, sidebar, aside, #comment, .comment, #comments, .comments, #replies, .replies, #feedback');
    var $ignore_len_tags = array(
        'span'
    );
    var $link_text_ratio = 0.04;
    var $min_text_len = 20;
    var $min_words = 0;
    var $total_links = 0;
    var $total_unlinked_words = 0;
    var $total_unlinked_text = '';
    var $text_blocks = 0;
    var $tree = NULL;
    var $unremoved = array();
    function sanitize_text($text)
    {
        $text = str_ireplace('&nbsp;', ' ', $text);
        $text = html_entity_decode($text, ENT_QUOTES);
        $utf_spaces = array(
            "\xC2\xA0",
            "\xE1\x9A\x80",
            "\xE2\x80\x83",
            "\xE2\x80\x82",
            "\xE2\x80\x84",
            "\xE2\x80\xAF",
            "\xA0"
        );
        $text = str_replace($utf_spaces, ' ', $text);
        return trim($text);
    }
    function extract($text, $ratio = NULL, $min_len = NULL)
    {
        $this->tree = new DOMDocument();
        //$start = microtime(true);
        if (! @$this->tree->loadHTML($text))
        {
            return FALSE;
        }
        $root = $this->tree->documentElement;
        //$start = microtime(true);
        $this->HeuristicRemove($root, (($ratio == NULL) || ($min_len == NULL)));
        if ($ratio == NULL)
        {
            $this->total_unlinked_text = $this->sanitize_text($this->total_unlinked_text);
            $words = preg_split('/[\s\r\n\t\|?!.,]+/', $this->total_unlinked_text);
            $words = array_filter($words);
            $this->total_unlinked_words = count($words);
            unset($words);
            if ($this->total_unlinked_words > 0)
            {
                $this->link_text_ratio = $this->total_links / $this->total_unlinked_words; // + 0.01;
                $this->link_text_ratio *= 1.3;
            }
        }
        else
        {
            $this->link_text_ratio = $ratio;
        }
        ;
        if ($min_len == NULL)
        {
            $this->min_text_len = strlen($this->total_unlinked_text) / $this->text_blocks;
        }
        else
        {
            $this->min_text_len = $min_len;
        }
        //$start = microtime(true);
        $this->ContainerRemove($root);
        return $this->tree->saveHTML();
    }
    function HeuristicRemove($node, $do_stats = FALSE)
    {
        if (in_array($node->nodeName, $this->removed_tags))
        {
            return TRUE;
        }
        ;
        if ($do_stats)
        {
            if ($node->nodeName == 'a')
            {
                $this->total_links ++;
            }
            $found_text = FALSE;
        }
        ;
        $nodes_to_remove = array();
        if ($node->hasChildNodes())
        {
            foreach ($node->childNodes as $child)
            {
                if ($this->HeuristicRemove($child, $do_stats))
                {
                    $nodes_to_remove[] = $child;
                }
                else
                {
                    if ($do_stats && ($node->nodeName != 'a') && ($child->nodeName == '#text'))
                    {
                        $this->total_unlinked_text .= $child->wholeText;
                        if (! $found_text)
                        {
                            $this->text_blocks ++;
                            $found_text = TRUE;
                        }
                    }
                }
                ;
            }
            foreach ($nodes_to_remove as $child)
            {
                $node->removeChild($child);
            }
        }
        return FALSE;
    }
    function ContainerRemove($node)
    {
        if (is_null($node))
        {
            return 0;
        }
        $link_cnt = 0;
        $word_cnt = 0;
        $text_len = 0;
        $delete = FALSE;
        $my_text = '';
        $ratio = 1;
        $nodes_to_remove = array();
        if ($node->hasChildNodes())
        {
            foreach ($node->childNodes as $child)
            {
                $data = $this->ContainerRemove($child);
                if ($data['delete'])
                {
                    $nodes_to_remove[] = $child;
                }
                else
                {
                    $text_len += $data[2];
                }
                $link_cnt += $data[0];
                if ($child->nodeName == 'a')
                {
                    $link_cnt ++;
                }
                else
                {
                    if ($child->nodeName == '#text')
                    {
                        $my_text .= $child->wholeText;
                    }
                    $word_cnt += $data[1];
                }
            }
            foreach ($nodes_to_remove as $child)
            {
                $node->removeChild($child);
            }
            $my_text = $this->sanitize_text($my_text);
            $words = preg_split('/[\s\r\n\t\|?!.,\[\]]+/', $my_text);
            $words = array_filter($words);
            $word_cnt += count($words);
            $text_len += strlen($my_text);
        }
        ;
        if (in_array($node->nodeName, $this->container_tags))
        {
            if ($word_cnt > 0)
            {
                $ratio = $link_cnt / $word_cnt;
            }
            if ($ratio > $this->link_text_ratio)
            {
                $delete = TRUE;
            }
            if (! in_array($node->nodeName, $this->ignore_len_tags))
            {
                if (($text_len < $this->min_text_len) || ($word_cnt < $this->min_words))
                {
                    $delete = TRUE;
                }
            }
        }
        return array($link_cnt, $word_cnt, $text_len, 'delete' => $delete);
    }
}
/****************************
Simple usage example
 *****************************/
//$html = file_get_contents('http://groot.com/simple-cms-powered-site-example/index.php');
//
//$extractor = new ContentExtractor();
//$content = $extractor->extract($html);
//echo $content;