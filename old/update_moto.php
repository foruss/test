<?php 

$id = $_POST['id'];

if($_POST['sel_prod'] == "Пометить проданным") { 



$parduota = '1';
$uid = addslashes($_POST['uid']);
$utype = addslashes($_POST['utype']);
if ($utype == 'f56e82798de1b89f7a4d77479ead7280') {
$uzid =" `uid`!='aa' ";
} else {
$uzid =" `uid`='$uid' ";
}
$insider = addslashes($_POST['id']);
$id = addslashes($_POST['id']);

include('web.php'); mysqlconnect();


$insertz1=mysql_query("Update `moto` set `parduota`='$parduota' where ".$uzid." and `id`='$id'") or die(mysql_error());
//echo '<script type="text/javascript">alert("'.$id.'"); </script>'; 


} else if($_POST['sel_nonprod'] == "Пометить непроданным") { 


$parduota = '0';
$uid = addslashes($_POST['uid']);
$utype = addslashes($_POST['utype']);
if ($utype == 'f56e82798de1b89f7a4d77479ead7280') {
$uzid =" `uid`!='aa' ";
} else {
$uzid =" `uid`='$uid' ";
}

include('web.php'); mysqlconnect();
$insider = addslashes($_POST['insider']);


$insertz2=mysql_query("Update `moto` set `parduota`='$parduota' where ".$uzid." and `id`='$id'") or die(mysql_error());

}
else{

$marke = addslashes($_POST['marke']);
$modelis = addslashes($_POST['modelis']);
$kat = addslashes($_POST['kat']);
$color = addslashes($_POST['color']);
$title = addslashes($_POST['title']);
$vin = addslashes($_POST['vin']);
$metai = addslashes($_POST['metai']);
$turis = addslashes($_POST['turis']);
$rida = addslashes($_POST['rida']);
$rtipas = addslashes($_POST['rtipas']);
$kaina = addslashes($_POST['kaina']);
$ktipas = addslashes($_POST['ktipas']);
$vieta = addslashes($_POST['vieta']);
$parduota = addslashes($_POST['sec']);

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

$uid = $_POST['uid'];

$slink = addslashes($_POST['slink']); 
$akcija = addslashes($_POST['akcija']);
$izz = addslashes($_POST['izz']);


if (count($yp) != '0') {
while(list($name, $value) = each($yp)) {
$priv .= "$value ";	
}
} else {

}

$info = addslashes($_POST['info']);
$date = date("Y-m-d H:i:s");
$priv = '';


$i1 = $_POST['i_1'];
$i2 = $_POST['i_2'];
$i3 = $_POST['i_3'];
$i4 = $_POST['i_4'];
$i5 = $_POST['i_5'];
$i6 = $_POST['i_6'];
$slink = addslashes($_POST['slink']);
$options = addslashes($_POST['options']);
$info = addslashes($_POST['info']);
$uid = addslashes($_POST['uid']);
$data = date("Y-m-d H:i:s");


include('web.php'); mysqlconnect();

$insider = addslashes($_POST['insider']);
$it = mysql_query('SET NAMES utf8'); 
$et = mysql_query('SET CHARACTER SET urf8');
$utype = addslashes($_POST['utype']);
if ($utype == 'f56e82798de1b89f7a4d77479ead7280') {
$uzid =" `uid`!='aa' ";
} else {
$uzid =" `uid`='$uid' ";
}


$insertz=mysql_query("Update `moto` set `marke`='$marke', `modelis`='$modelis', `kateg`='$kat', `title`='$title', `vin`='$vin', `metai`='$metai', `spalva`='$color', `turis`='$turis', `rida`='$rida', `rtype`='$rtipas', `kaina`='$kaina', `ktype`='$ktipas', `vieta`='$vieta', `info`='$info', `url`='$slink', `akcija`='$akcija', `options`='$options', `s1`='$i1', `s2`='$i2', `s3`='$i3', `s4`='$i4', `s5`='$i5', `s6`='$i6', `gift`='$baneris', `parduota`='$parduota' where ".$uzid." and `id`='$id'") or die(mysql_error());


 //echo("Update `moto` set `marke`='$marke', `modelis`='$modelis', `kateg`='$kat', `title`='$title', `vin`='$vin', `metai`='$metai', `spalva`='$color', `turis`='$turis', `rida`='$rida', `rtype`='$rtipas', `kaina`='$kaina', `ktype`='$ktipas', `vieta`='$vieta', `info`='$info', `url`='$slink', `akcija`='$akcija', `options`='$options', `s1`='$i1', `s2`='$i2', `s3`='$i3', `s4`='$i4', `s5`='$i5', `s6`='$i6', `gift`='$baneris', `parduota`='$parduota' where ".$uzid." and `id`='$insider'"); 

}
mysqldisconnect();
header("Location: loged/moto/update.msg");
?>