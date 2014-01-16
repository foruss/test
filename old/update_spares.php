<?php 

$insider = addslashes($_POST['insider']);

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


$insertz1=mysql_query("Update `dalys` set `parduota`='$parduota' where ".$uzid." and `id`='$insider'") or die(mysql_error());



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


$insertz2=mysql_query("Update `dalys` set `parduota`='$parduota' where ".$uzid." and `id`='$insider'") or die(mysql_error());

}
else{

//category
$mk = addslashes($_POST['mk']);
$sk = addslashes($_POST['sk']);

$part = addslashes($_POST['part']);
$pav = addslashes($_POST['pav']);
$marke = addslashes($_POST['marke']);
$kat = addslashes($_POST['kat']);
//$modelis = addslashes($_POST['modelis']);
$kaina = addslashes($_POST['kaina']);
$ktype = $zo['ktype'];

$ktipas = addslashes($_POST['ktipas']);
$info = addslashes($_POST['info']);
$dovana = addslashes($_POST['dovana']);
$slink = addslashes($_POST['slink']);
$akcija = addslashes($_POST['akcija']);
$uid = addslashes($_POST['uid']);
$data = date("Y-m-d H:i:s");
$izz = addslashes($_POST['izz']);

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
 

$indek=mysql_query("Update `dalys` set `kateg`='$kat',`part`='$part',`pav`='$pav', `marke`='$marke', `tipas`='$tipas', `akcija`='$akcija', `kaina`='$kaina', `ktype`='$ktipas',`info`='$info',`url`='$slink',  `data`='$data', `gift`='$baneris', `parduota`='$parduota',`sk`='$sk', `mk`='$mk' where `uid`='$uid' and ".$uzid." and `id`='$insider'");
}


mysqldisconnect();
header("Location: loged/spares/updated.msg");

?>