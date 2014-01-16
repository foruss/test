<?
	ini_set('display_errors', true);
	include_once("functions/functions.php");
	//$m = isset($_REQUEST['selectedMake'])?$_REQUEST['selectedMake']:'';
	$m ="AUDI";
	$url = 'http://www.copart.com/c2/model.ajax?selectedMake='.$_GET['id'];
	$body = http_load( $url, 'http://copart.com/c2/home.html' ,null,null, null, null, null, null, 0 );
	


	$body = str_replace('description="','>',$body);
	$body = str_replace('"/>','</option>',$body);
	$body = str_replace('code','value',$body);
	$body = str_replace('models','select name="mod11"',$body);
	$body = str_replace('model','option',$body);
	$body = str_replace('mod11','model',$body);
	//$body=ereg_replace("</select>", "", $body);


	
	echo $body;
	
	?>