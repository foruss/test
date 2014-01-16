<?php
	
$local_cache_dir = 'imagescache/';


header( "Content-Type: image/gif" );
header('Content-Transfer-Encoding: binary');

$net_url = 'https://www.iaai.com/VehicleImages/' . $_SERVER["QUERY_STRING"];
$local_url = $local_cache_dir .'iaai-'. md5($_SERVER["QUERY_STRING"]).'.jpg';


if (!file_exists($local_url)){
	//Загружаем с internet
	$image_body = file_get_contents($net_url);
	//сохранение	
	$handle = fopen($local_url, 'w');
	fwrite($handle,$image_body);
	fclose($handle);		
	
} else{
	$image_body = file_get_contents($local_url);	
}
echo	$image_body;
?>