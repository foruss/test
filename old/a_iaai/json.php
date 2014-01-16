<?php
	include_once("config.php");
	$vtypeid = isset($_REQUEST['section'])?$_REQUEST['section']:'';
	$make = isset($_REQUEST['make'])?$_REQUEST['make']:'';
	if (empty($vtypeid)) die('wrong param!');
	if (empty($make)){
		// VehicleType mode
		$mode=1;
		$url = 'https://www.iaai.com/CarsService.asmx/GetMakesByType';
		$post = '{"knownCategoryValues":"VehicleType:'.$vtypeid.';","category":"Make"}';
	} else {
		// get models for make mode
		$mode=2;
		
		$add_headers = array();
		$add_headers[]='Content-Type: application/json; charset=utf-8';
		
		$url = 'https://www.iaai.com/CarsService.asmx/GetMakesByType';
		$post = '{"knownCategoryValues":"VehicleType:'.$vtypeid.';","category":"Make"}';
		$html_result = http_load( $url,'https://www.iaai.com/Vehicles/VehicleSearch.aspx',null,null,$post,true,'cookies',"Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.0.5) Gecko/2008120122 Firefox/3.0.5",1,0,$add_headers);		
		parse_cookies($html_result);		
		
		
		
		$url = 'https://www.iaai.com/CarsService.asmx/GetModelsByMake';
		$post = '{"knownCategoryValues":"VehicleType:'.$vtypeid.';Make:'.$make.';","category":"Model"}';
	}
	$add_headers = array();
	$add_headers[]='Content-Type: application/json; charset=utf-8';
	$html_result = http_load( $url,'https://www.iaai.com/Vehicles/VehicleSearch.aspx',null,null,$post,true,'cookies',"Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.0.5) Gecko/2008120122 Firefox/3.0.5",1,0,$add_headers);
	parse_cookies($html_result);
	header( "Pragma: no-cache" );
	header( "Cache-Control: no-store" );
	header( "Content-Type: text/json; charset=".$project_encoding );
	
	$html_result = iconv('utf-8' , $project_encoding.'//TRANSLIT', $html_result);
	 
	
	
	
	$pattern = '#"\s*name\s*"\s*:\s*"([^"]*)"\s*,\s*"\s*value\s*"\s*:\s*"([^"]*)"#i';
	// 1 - name
	// 2 - value
	$answer = '';
	$tmp = html_search_all($pattern,$html_result);
	foreach ($tmp as $line) {
		$answer .= '<option value="'.$line[2].'">'.$line[1]."</option>\n";
	}
	$answer = trim($answer);
	
	 if ($mode==2 || empty($answer)) $answer = '<option value="">Bce</option>' .$answer;
	
	
	echo $answer;
//	echo '<!--  $post=>>'.$post.'<<'.$html_result.'-->';
	
	//-------------------------------------------------------
 ////load section	{"knownCategoryValues":"VehicleType:1;","category":"Make"}	
 //load model   	{"knownCategoryValues":"VehicleType:6;Make:CRUSA;","category":"Model"}
//					{"knownCategoryValues":"VehicleType:1;Make:AUDI;","category":"Model"}
//					{"knownCategoryValues":"VehicleType:1;Make:BMW;","category":"Model"}
	
	
	
exit( );
?>