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
$insider = addslashes($_POST['insider']);
$data = date("Y-m-d H:i:s");
$url =addslashes($_POST['url']);
$akcija = addslashes($_POST['akcija']);
include('web.php'); mysqlconnect();

$file_name = $_FILES['dovana']['name'];
$logotype = $_FILES['dovana'];
if (!empty($file_name)) {
$file_size = $_FILES['dovana']['size'];
$file_type = $_FILES['dovana']['type'];
$file_dir = "gift";
$tu = explode(".", $file_name);
$galune = array_pop($tu);
$max_file_size = 1024 * 9048;
$un = substr(md5(uniqid(rand())), 0, 5);
$file_destination = $file_dir . "/" . $un . "." . $galune;
if ($file_type == 'image/pjpeg' || $file_type == 'image/gif' || $file_tye == 'image/bmp' || $file_type == 'image/jpeg' || $file_type == 'image/png' || $file_type == 'image/x-png') {
$funkcija = move_uploaded_file($logotype["tmp_name"], $file_destination);
$baneris = $file_destination;
} else {
$baneris ='';
}

} else {
$baneris = $_POST['gift'];
}
$it = mysql_query('SET NAMES utf8'); 
$et = mysql_query('SET CHARACTER SET urf8');
$utype = addslashes($_POST['utype']);
if ($utype == 'f56e82798de1b89f7a4d77479ead7280') {
$uzid =" `uid`!='aa' ";
} else {
$uzid =" `uid`='$uid' ";
}
$indek=mysql_query("Update `plane` set `gamintojas`='$gam', `pav`='$pav', `akcija`='$akcija', `gift`='$baneris', `url`='$url', `tipas`='$tipas', `vin`='$vin', `metai`='$metai', `ilgis`='$ilgis', `aukstis`='$aukstis', `sparnuilgis`='$silgis', `splotas`='$splotas', `maxsvoris`='$maxsvoris', `variklis`='$variklis', `propeleris`='$propeleris', `bakas`='$bakas', `maxgreitis`='$greitis', `maxaukstis`='$maxausktis', `dalnost`='$dalnost', `vieta`='$vieta', `kaina`='$kaina', `ktype`='$ktipas', `option`='$options', `info`='$info' where `id`='$insider' and ".$uzid."");
mysqldisconnect();



header("Location: loged/plane/update.msg");

?>