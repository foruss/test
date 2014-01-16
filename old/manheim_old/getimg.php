<?php
	
$noimageurl = 'images/no-image.gif';	
$local_cache_dir = 'imagescache/';


header( "Content-Type: image/gif" );
header('Content-Transfer-Encoding: binary');

$net_url = 'https://images.ove.com' . $_SERVER["QUERY_STRING"];
$local_url = $local_cache_dir .'img-'. urlencode($_SERVER["QUERY_STRING"]);

$image_body = file_get_contents($local_url);
if ($image_body===false){
	//��������� � internet
	$image_body = file_get_contents($net_url);
	if ($image_body===false) {
		//������!
		$image_body = file_get_contents($noimageurl);
	} else {
		//����������	
		$handle = fopen($local_url, 'w');
		fwrite($handle,$image_body);
		fclose($handle);		
	}
}

echo	$image_body;
?>