<?php
	
$noimageurl = 'images/no-image.gif';	
$local_cache_dir = 'imagescache/';


header( "Content-Type: image/gif" );
header('Content-Transfer-Encoding: binary');

$net_url = 'https://www.iaai.com/VehicleImages/' . $_SERVER["QUERY_STRING"];
$local_url = $local_cache_dir .'iaai-'. md5($_SERVER["QUERY_STRING"]).'.jpg';

$image_body = file_get_contents($local_url);
if ($image_body===false){
	//Загружаем с internet
	$image_body = file_get_contents($net_url);
	if ($image_body===false) {
		//ошибка!
		$image_body = file_get_contents($noimageurl);
	} else {
		//сохранение	
		$handle = fopen($local_url, 'w');
		fwrite($handle,$image_body);
		fclose($handle);		
	}
}
echo	$image_body;
?>