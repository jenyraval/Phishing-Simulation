<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (isset($_POST['submit'])) {
	$url = $_POST['url'];
	
	if (! trim($url)) {
		header('LOCATION: setup2.php?e=' . urlencode('No URL Specified'));
		exit;
	}
	
	$contentonly = isset($_POST['content']) ? true : false;
	$keepjs = isset($_POST['javascript']) ? true : false;
	$compress = isset($_POST['compress']) ? true : false;

	# include the class
	require_once 'includes/htmlSaveComplete.php';
    $htmlSaveComplete = new htmlSaveComplete($url);
    $html = $htmlSaveComplete->getCompletePage($keepjs, $contentonly, $compress);
	
	if (! $html) {
		header('LOCATION: setup2.php?e=' . urlencode('Error saving the page, please try again later.'));
		exit;	
	}
	
	file_put_contents('output.html', $html);
	header('LOCATION: setup2.php?s=1');
	exit;	
}
else {
	header('LOCATION: setup2.php');
}

