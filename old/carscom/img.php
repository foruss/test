<?php
//include_once("config.php");
$noimageurl='images/no-image.gif';
$local_cache_dir = 'imagescache/';
if (isset($_GET['img'])){
	$image_url = $_GET['img'];
	$cars_url = "http://images.cars.com/";
} elseif (isset($_GET['img2'])){ 
	$image_url = $_GET['img2'];
	$cars_url = "http://cars.com/search/images/";
} else
$image_url = $noimageurl;

header( "Content-Type: image/gif" );
header('Content-Transfer-Encoding: binary');

$local_url = str_replace('/','-',$image_url);
$local_url = str_replace(':','^',$local_url);
$local_url = str_replace('?','@',$local_url);
$local_url =$local_cache_dir . $local_url;
$net_url = $cars_url.$image_url;

$image_body = file_get_contents($local_url);
if ($image_body===false){
	//Загружаем с cars
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
