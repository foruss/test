<?php 

if($_POST['sel_prod'] == "Пометить проданным") { 
$parduota = '1';
$uid = addslashes($_POST['uid']);
$utype = addslashes($_POST['utype']);
if ($utype == 'f56e82798de1b89f7a4d77479ead7280') {
$uzid =" `uid`!='aa' ";
} else {
$uzid =" `uid`='$uid' ";
}
$insider = addslashes($_POST['insider']);
include('web.php'); mysqlconnect();


$insertz1=mysql_query("Update `valtis` set `parduota`='$parduota' where ".$uzid." and `id`='$insider'") or die(mysql_error());



} else if($_POST['sel_nonprod'] == "Пометить непроданным") { 
$parduota = '0';
$uid = addslashes($_POST['uid']);
$utype = addslashes($_POST['utype']);
if ($utype == 'f56e82798de1b89f7a4d77479ead7280') {
$uzid =" `uid`!='aa' ";
} else {
$uzid =" `uid`='$uid' ";
}
$insider = addslashes($_POST['insider']);
include('web.php'); mysqlconnect();


$insertz2=mysql_query("Update `valtis` set `parduota`='$parduota' where ".$uzid." and `id`='$insider'") or die(mysql_error());

}
else{



$gam = addslashes($_POST['gam']);
$pav = addslashes($_POST['pav']);
$tipas= addslashes($_POST['tipas']);
$kat = addslashes($_POST['kat']);
$title = addslashes($_POST['title']);
$vin = addslashes($_POST['vin']);
$metai = addslashes($_POST['metai']);
$ilgis = addslashes($_POST['ilgis']);
$plotis = addslashes($_POST['plotis']);
$grimzle = addslashes($_POST['grimzle']);
$vietos = addslashes($_POST['vietos']);
$ksanaud = addslashes($_POST['ksanaud']);
$variklis = addslashes($_POST['variklis']);
$kaina= addslashes($_POST['kaina']);
$ktype = addslashes($_POST['ktipas']);
$vieta = addslashes($_POST['vieta']);
$url = addslashes($_POST['url']);
$options = addslashes($_POST['options']);
$info = addslashes($_POST['info']);
$uid = addslashes($_POST['uid']);
$data = date("Y-m-d H:i:s");
$izz = addslashes($_POST['izz']);
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


$insider = addslashes($_POST['insider']);
$it = mysql_query('SET NAMES utf8'); 
$et = mysql_query('SET CHARACTER SET urf8');
$utype = addslashes($_POST['utype']);
if ($utype == 'f56e82798de1b89f7a4d77479ead7280') {
$uzid =" `uid`!='aa' ";
} else {
$uzid =" `uid`='$uid' ";
}

//echo($uzid + 'boatid' + $insider);


$insas=mysql_query("Update `valtis` set `gamintojas`='$gam', `pav`='$pav', `tipas`='$tipas', `kateg`='$kat', `akcija`='$akcija', `gift`='$baneris', `title`='$title', `vin`='$vin', `metai`='$metai', `ilgis`='$ilgis', `plotis`='$plotis', `grimzle`='$grimzle', `vietos`='$vietos', `ksanaud`='$ksanaud', `variklis`='$variklis', `kaina`='$kaina', `ktype`='$ktype', `vieta`='$vieta', `url`='$url', `option`='$options', `info`='$info' where ".$uzid." and `id`='$insider'") or die(mysql_error());
}


mysqldisconnect();
header("Location: loged/boat/update.msg");
?>