<?php

$gam = addslashes($_POST['gam']);
$pav = addslashes($_POST['pav']);
$tipas = addslashes($_POST['tipas']);
$vin = addslashes($_POST['vin']);
$metai = addslashes($_POST['metai']);
$ilgis = addslashes($_POST['ilgis']);
$aukstis = addslashes($_POST['aukstis']);
$silgis = addslashes($_POST['silgis']);
$uid = addslashes($_POST['uid']);
$splotas = addslashes($_POST['splotas']);
$maxsvoris = addslashes($_POST['maxsvoris']);
$variklis = addslashes($_POST['variklis']);
$propeleris = addslashes($_POST['propeleris']);
$bakas = addslashes($_POST['bakas']);
$greitis = addslashes($_POST['greitis']);
$maxausktis = addslashes($_POST['maxaukstis']);
$dalnost = addslashes($_POST['dalnost']);
$vieta = addslashes($_POST['vieta']);
$kaina = addslashes($_POST['kaina']);
$ktipas = addslashes($_POST['ktipas']);
$slink = addslashes($_POST['slink']);
$options = addslashes($_POST['options']);
$info = addslashes($_POST['info']);
$akcija = addslashes($_POST['akcija']);
$url = addslashes($_POST['url']);

$data = date("Y-m-d H:i:s");
include('web.php'); mysqlconnect();


//failas jpg/png/bmp/gif
$file_name = $_FILES['dovana']['name'];
$logotype = $_FILES['dovana'];
if (!empty($file_name)) {
$file_size = $_FILES['dovana']['size'];
$file_type = $_FILES['dovana']['type'];
$file_dir = "gift";
$tu = explode(".", $file_name);
$galune = array_pop($tu);
$max_file_size = 1024 * 9048;
$un = substr(md5(uniqid(rand())), 0, 10);
$file_destination = $file_dir . "/" . $un . "." . $galune;
if ($file_type == 'image/pjpeg' || $file_type == 'image/gif' || $file_tye == 'image/bmp' || $file_type == 'image/jpeg' || $file_type == 'image/png' || $file_type == 'image/x-png') {
$funkcija = move_uploaded_file ($logotype["tmp_name"], $file_destination);
$baneris = $file_destination;
} else {
$baneris ='';
}
} else {
	$baneris = '';
}

$it = mysql_query('SET NAMES utf8');
$et = mysql_query('SET CHARACTER SET urf8');
$indek=mysql_query("Insert into `plane` set `gamintojas`='$gam', `pav`='$pav', `url`='$url', `tipas`='$tipas', `vin`='$vin', `metai`='$metai', `ilgis`='$ilgis', `aukstis`='$aukstis', `sparnuilgis`='$silgis', `splotas`='$splotas', `maxsvoris`='$maxsvoris', `variklis`='$variklis', `propeleris`='$propeleris', `bakas`='$bakas', `maxgreitis`='$greitis', `maxaukstis`='$maxausktis', `dalnost`='$dalnost', `vieta`='$vieta', `kaina`='$kaina', `ktype`='$ktipas', `option`='$options', `info`='$info', `uid`='$uid', `data`='$data', `gift`='$baneris', `akcija`='$akcija'");



$get_last_id=mysql_query("Select * from `plane` where `uid`='$uid' order by `id` desc Limit 0,1");
$gli=mysql_fetch_array($get_last_id);
$sid = $gli['id'];
$foto_sk = addslashes($_POST['foto_sk']);
$foto_dir = "photo";
//20 фото.
$foto_sk=20;
for ($i=1; $i<=$foto_sk; $i++) {

$file_name = $_FILES["ff_$i"]['name'];
if (!empty($file_name)) {
$failas = $_FILES["ff_$i"];
$file_size = $_FILES["ff_$i"]['size'];
$file_type = $_FILES["ff_$i"]['type'];

$tu = explode(".", $file_name);
$galune = array_pop($tu);
$un = substr(md5(uniqid(rand())), 0, 5);
$file_destination = $foto_dir . "/" . $sid . "_" . $un . "." . $galune;
if ($file_type == 'image/pjpeg' || $file_type == 'image/gif' || $file_tye == 'image/bmp' || $file_type == 'image/jpeg' || $file_type == 'image/png' || $file_type == 'image/x-png') {
$funkcija = move_uploaded_file ($failas["tmp_name"], $file_destination);
$baneris = $file_destination;
$inser_foto=mysql_query("Insert into `foto` set `type`='4', `url`='$file_destination', `sid`='$sid'");
}
}
}


mysqldisconnect();
header("Location: loged/plane/inserted.msg");

?>