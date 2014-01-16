<?php
	//print_r($_GET);
	
	include_once("config.php");
	
	$url = "http://suchen.mobile.de/fahrzeuge/hitscounter.html?" . $_SERVER['QUERY_STRING'];
	
	header( "Pragma: no-cache" );
	header( "Cache-Control: no-store" );
	header( "Content-Type: text/json;charset=".$project_encoding );
	$html_result = http_load( $url,null,null,null,array(),true,'cookies',"Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)",0);
	
	$in_charset = 'windows-1251';
//	$html_result = iconv($in_charset , $project_encoding.'//TRANSLIT', $html_result);
	
	
	echo $html_result;
	
	
	
	
	
	
	
	
	
	
exit( );
?>