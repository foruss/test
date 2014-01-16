<?php
	//print_r($_GET);
	
	include_once("config.php");
	
	$url = 'http://www.mobile.de/home/models.html?makeId='.$_GET['makeId'].'&lang='.$_GET['lang'];
	
	header( "Pragma: no-cache" );
	header( "Cache-Control: no-store" );
	header( "Content-Type: text/json;charset=".$project_encoding );
	$html_result = http_load( $url,null,null,null);
	
	$in_charset = 'windows-1251';
//	$html_result = iconv($in_charset , $project_encoding.'//TRANSLIT', $html_result);
	
	
	echo $html_result;
	
	
	
	
	
	
	
	
	
	
exit( );
?>