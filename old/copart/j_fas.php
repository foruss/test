<?
	include_once("functions/functions.php");
	$m = isset($_REQUEST['statefacility'])?$_REQUEST['statefacility']:'state';
	$url = 'http://www.copart.com/c2/stateFacility.ajax?statefacility=' . $m;
	$body = http_load( $url, 'http://copart.com/c2/home.html' ,null,null, null, null, null, null, 0 );
	
	echo $body;
	?>