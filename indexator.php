<?php
	set_time_limit(0);


	$categories = [
		"bike-touring",
		"bike-touring-equipment",
		"bikepacking",
		"bikepacking-gear",
		"camping",
		"camping-gear",
	];



	$maindex = '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bike Touring, Bikepacking and Camping Articles.</title>
    <meta name="description" content="Information and articles about Bike Touring, Bikepacking and Camping.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>body{max-width:768px;margin:0 auto;}</style>
</head>
<body><a href = "/">home</a>
<hr />
Bike Touring, Bikepacking and Camping Articles.
<hr />';



	foreach($categories as $category){
		$maindex .= ' <a href = "/'.$category.'/index.html">'.$category.'</a><hr />';
		
		
		$ai = file_get_contents($category . ".txt");
		
		if (strpos($ai, "\r\n") !== false) {
			$url_list = explode("\r\n",$ai);
		} elseif (strpos($ai, "\n") !== false) {
			$url_list = explode("\n",$ai);
		} else {
			$url_list = [$ai];
		}
		
		
				$catindex = '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>'. $category .'</title>
    <meta name="description" content="Information and articles about '. $category .'">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>body{max-width:768px;margin:0 auto;}</style>
</head>
<body><a href = "/">home</a>
<hr />';

		
		
		
		foreach($url_list as $url){
			if(!$url){continue;}
			$url_e = explode("/", $url);
			
			$file = $url_e[3] . "/" . $url_e[4];
			
			$html = file_get_contents($file);
			
			preg_match('#<title>(.*?)</title>#s', $html, $title_raw);
			preg_match('#<meta name="description" content="(.*?)">#s', $html, $desc_raw);
			
			$title = $title_raw[1];
			$desc = $desc_raw[1];
			 
			//echo $url . " - " . $title . " - " . $desc; exit;
			// html dosyasını aç, title ve desc parse et.
			
			$maindex .= '<div><a href = "'. $url .'">'.$title.'</a><br><p>'.$desc.'</p></div><br>';
			$catindex .= '<div><a href = "'. $url .'">'.$title.'</a><br><p>'.$desc.'</p></div><br>';
			
		}
		
		
		
		$catindex .= '</body></html>';
		
		$success = file_put_contents($category . "/index.html", $catindex);

	}
		
		
		
		
		
	$maindex .= '</body></html>';
		

	$success = file_put_contents("index.html", $maindex);



?>