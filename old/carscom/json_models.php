<?php
include_once( "config.php" );
if (empty($_REQUEST['makeid'])){
	echo '<option value="">Bce</option>';
	die();
} 
//http://www.cars.com/for-sale/GetModelData.action?mkID=20049&nw=Y&usd=&loc=en
//http://www.cars.com/for-sale/GetModelData.action?mkID=20017&nw=Y&usd=&loc=en
//http://www.cars.com/for-sale/GetModelData.action?mkID=20053&nw=&usd=Y&loc=en

//{'options':[{'name':'All Models', 'value':'', 'time':1253635109101},{'name':'Accord', 'value':'20606'},{'name':'Civic', 'value':'20823'},{'name':'Civic Hybrid', 'value':'20848'},{'name':'CR-V', 'value':'20762'},{'name':'Element', 'value':'21055'},{'name':'Fit', 'value':'21128'},{'name':'Insight', 'value':'21300'},{'name':'Odyssey', 'value':'21734'},{'name':'Pilot', 'value':'21729'},{'name':'Ridgeline', 'value':'21884'},{'name':'S2000', 'value':'21910'}]}



$makeid = $_REQUEST['makeid'];
$section = $_REQUEST['section'];
if ($section=='new'){
	$snew = 'Y';
	$sused = '';
} else {
	$snew = '';
	$sused = 'Y';
}


$net_url = "http://www.cars.com/for-sale/GetModelData.action?mkID=$makeid&nw=$snew&usd=$sused&loc=en";

//echo ">".$net_url.'<';

$local_url = CACHE_DIR."json_mk=$makeid,section=$section.cache";

if (!file_exists($local_url)){
	//Загружаем с internet
	$body = file_get_contents($net_url);
	//сохранение	
	$handle = fopen($local_url, 'w');
	fwrite($handle,$body);
	fclose($handle);		
	
} else{
	$body = file_get_contents($local_url);	
} 
##---parcing-------------

$tmp = html_search_all("#'name':'([^']*)'\s*,\s*'value':'([^']*)#",$body);

$answer = '<option value="">Bce</option>';
foreach ($tmp as $opt){
	if (!empty($opt[2])){
		$answer .= '<option value="'.$opt[2].'">'.$opt[1].'</option>';
	}
	
}
echo $answer;






