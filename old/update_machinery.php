<?php 
$gam = addslashes($_POST['gam']);
$pav = addslashes($_POST['pav']);
$tipas = addslashes($_POST['tipas']);
$sn = addslashes($_POST['sn']);
$kat = addslashes($_POST['kat']);
$title = addslashes($_POST['title']);
$vin = addslashes($_POST['vin']);
$metai = addslashes($_POST['metai']);
$pdeze = addslashes($_POST['pavd']);
$variklis = addslashes($_POST['variklis']);
$vieta = addslashes($_POST['vieta']);
$kaina = addslashes($_POST['kaina']);
$ktype = addslashes($_POST['ktipas']);
$options = addslashes($_POST['options']);
$info = addslashes($_POST['info']);
$uid = addslashes($_POST['uid']);
$data = date("Y-m-d H:i:s");
$insider = $_POST['insider'];
$url = addslashes($_POST['url']);
$akcija = addslashes($_POST['akcija']);
include('web.php'); mysqlconnect();
$it = mysql_query('SET NAMES utf8'); 
$et = mysql_query('SET CHARACTER SET urf8');
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
$utype = addslashes($_POST['utype']);
if ($utype == 'f56e82798de1b89f7a4d77479ead7280') {
$uzid =" `uid`!='aa' ";
} else {
$uzid =" `uid`='$uid' ";
}
$it = mysql_query('SET NAMES utf8'); 
$et = mysql_query('SET CHARACTER SET urf8');
$insertasz=mysql_query("Update `spec` set `gamintojas`='$gam', `pav`='$pav', `gift`='$baneris', `url`='$url', `akcija`='$akcija', `tipas`='$tipas', `sn`='$sn', `kateg`='$kat', `title`='$title', `vin`='$vin', `metai`='$metai', `pdeze`='$pdeze', `variklis`='$variklis', `vieta`='$vieta', `kaina`='$kaina', `ktype`='$ktype', `option`='$options', `info`='$info' where `id`='$insider' and ".$uzid."");



mysqldisconnect();
header("Location: loged/machinery/update.msg");


?>