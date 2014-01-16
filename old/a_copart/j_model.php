<?
	ini_set('display_errors', true);
	include_once("functions/functions.php");
	$m = isset($_REQUEST['selectedMake'])?$_REQUEST['selectedMake']:'';
	$url = 'http://www.copart.com/c2/model.ajax?selectedMake=' . $m;
	$body = http_load( $url, 'http://copart.com/c2/home.html' ,null,null, null, null, null, null, 0 );
	
	$body = str_replace('All Models','Bce модели',$body);
	
	echo $body;
	?>