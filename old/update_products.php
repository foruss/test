<?php 

$mk = addslashes($_POST['mk']);
$modelis = addslashes($_POST['modelis']);
$bukle = addslashes($_POST['bukle']);
$sandelyje = addslashes($_POST['sandelyje']);
$marke = addslashes($_POST['marke']);
$kat = addslashes($_POST['kat']);
$kaina = addslashes($_POST['kaina']);
$ktipas = addslashes($_POST['ktipas']);
$info = addslashes($_POST['info']);
$dovana = addslashes($_POST['dovana']);
$slink = addslashes($_POST['slink']);
$akcija = addslashes($_POST['akcija']);
$uid = addslashes($_POST['uid']);
$data = date("Y-m-d H:i:s");
$insider = addslashes($_POST['insider']);
include('web.php'); mysqlconnect();

$it = mysql_query('SET NAMES utf8'); 
$et = mysql_query('SET CHARACTER SET urf8');
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
$indek=mysql_query("Update `sk` set `modelis`='$modelis', `bukle`='$bukle', `sandelyje`='$sandelyje', `marke`='$marke', `kat`='$mk', `url`='$slink', `ktype`='$ktipas', `kaina`='$kaina', `info`='$info', `data`='$data', `gift`='$baneris', `akcija`='$akcija' where `id`='$insider' and ".$uzid."");


mysqldisconnect();
header("Location: loged/products/updated.msg");

?>