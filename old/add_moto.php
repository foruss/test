<?php
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
$ktipas= addslashes($_POST['ktipas']);
$vieta = addslashes($_POST['vieta']);
$options = addslashes($_POST['options']);
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


//
$slink = addslashes($_POST['slink']);
$izz = addslashes($_POST['izz']);
$options = addslashes($_POST['options']);
$info = addslashes($_POST['info']);
$uid = $_POST['uid'];
$date = date("Y-m-d H:i:s");

$i1 = addslashes($_POST['i_1']);
$i2 = addslashes($_POST['i_2']);
$i3 = addslashes($_POST['i_3']);
$i4 = addslashes($_POST['i_4']);
$i5 = addslashes($_POST['i_5']);
$i6 = addslashes($_POST['i_6']);

include('web.php'); mysqlconnect();
$it = mysql_query('SET NAMES utf8');
$et = mysql_query('SET CHARACTER SET urf8');
$insertz=mysql_query("Insert into `moto` set `marke`='$marke', `modelis`='$modelis', `kateg`='$kat', `title`='$title', `vin`='$vin', `metai`='$metai', `spalva`='$color', `turis`='$turis', `rida`='$rida', `rtype`='$rtipas', `kaina`='$kaina', `ktype`='$ktipas', `vieta`='$vieta', `info`='$info', `url`='$slink', `akcija`='$akcija', `options`='$options', `s1`='$i1', `s2`='$i2', `s3`='$i3', `s4`='$i4', `s5`='$i5', `s6`='$i6', `uid`='$uid', `data`='$date', `gift`='$baneris'") or die(mysql_error());

$get_last_id=mysql_query("Select * from `moto` where `uid`='$uid' order by `id` desc Limit 0,1");
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
$inser_foto=mysql_query("Insert into `foto` set `type`='2', `url`='$file_destination', `sid`='$sid'");
}
}
}


mysqldisconnect();
header("Location: loged/moto/inserted.msg");

?>