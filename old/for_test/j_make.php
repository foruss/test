<?
	include_once("functions/functions.php");
	$make = isset($_REQUEST['vehicleType'])?$_REQUEST['vehicleType']:'V';
	$url = 'http://www.copart.com/c2/make.ajax?vehicleType='.$make;
	$body = http_load( $url, 'http://copart.com/c2/home.html' ,null,null, null, null, null, null, 0 );
	
	echo $body;
	?>