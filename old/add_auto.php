<?php

$marke = addslashes($_POST['marke']);
$modelis = addslashes($_POST['modelis']);
$kat = addslashes($_POST['kat']);
$color = addslashes($_POST['color']);
$scolor = addslashes($_POST['scolor']);
$title = addslashes($_POST['title']);
$vin = addslashes($_POST['vin']);
$metai = addslashes($_POST['metai']);
$keb = addslashes($_POST['keb']);
$variklis = addslashes($_POST['variklis']);
$turis = addslashes($_POST['turis']);
$rida = addslashes($_POST['rida']);
$rtipas = addslashes($_POST['rtipas']);
$pavd = addslashes($_POST['pavd']);
$kaina = addslashes($_POST['kaina']);
$ktipas= addslashes($_POST['ktipas']);
$vieta = addslashes($_POST['vieta']);
$miestas = addslashes($_POST['miestas']);
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
$funkcija = move_uploaded_file ($logotype["tmp_name"], $file_destination);
$baneris = $file_destination;
} else {
$baneris ='';
}
} else {
	$baneris = '';
}


//  --------------

$slink = addslashes($_POST['slink']);
$akcija = addslashes($_POST['akcija']);
$izz = addslashes($_POST['izz']);

$info = addslashes($_POST['info']);

$yp = $_POST['priv'];


$uid = $_POST['uid'];
$date = date("Y-m-d H:i:s");
$priv = '';
if (count($yp) != '0') {
while(list($name, $value) = each($yp)) {
$priv .= "$value ";
}
} else {

}


$i1 = addslashes($_POST['i_1']);
$i2 = addslashes($_POST['i_2']);
$i3 = addslashes($_POST['i_3']);
$i4 = addslashes($_POST['i_4']);
$i5 = addslashes($_POST['i_5']);
$i6 = addslashes($_POST['i_6']);
$i7 = addslashes($_POST['i_7']);
$i8 = addslashes($_POST['i_8']);
$i9 = addslashes($_POST['i_9']);
$i10 = addslashes($_POST['i_10']);
$i11 = addslashes($_POST['i_11']);
$i12 = addslashes($_POST['i_12']);
$i13 = addslashes($_POST['i_13']);

$v1 = addslashes($_POST['v_1']);
$v2 = addslashes($_POST['v_2']);
$v3 = addslashes($_POST['v_3']);
$v4 = addslashes($_POST['v_4']);
$v5 = addslashes($_POST['v_5']);
$v6 = addslashes($_POST['v_6']);
$v7 = addslashes($_POST['v_7']);
$m1 = addslashes($_POST['m_1']);
$m2 = addslashes($_POST['m_2']);
$m3 = addslashes($_POST['m_3']);
$m4 = addslashes($_POST['m_4']);
$m5 = addslashes($_POST['m_5']);
$m6 = addslashes($_POST['m_6']);

include('web.php'); mysqlconnect();
$it = mysql_query('SET NAMES utf8');
$et = mysql_query('SET CHARACTER SET urf8');
header("Content-Type: text/html; charset=utf-8");
include('fnc.php');
$tags = get_marke($marke);
$tags .= " ".get_modelis($modelis);
$tags .= " ".$metai;
$tags .= " ".get_color($color);
$tags .= " ".get_pd($pavd);
$tags .= " ".get_keb($keb);


$insertz=mysql_query("Insert into `auto` set `marke`='$marke', `modelis`='$modelis', `miestas`='$miestas', `salonosp`='$scolor', `kateg`='$kat', `title`='$title', `vin`='$vin', `metai`='$metai', `spalva`='$color', `kebulas`='$keb', `kuras`='$variklis', `turis`='$turis', `rida`='$rida', `rtype`='$rtipas', `pdeze`='$pavd', `kaina`='$kaina', `ktype`='$ktipas', `vieta`='$vieta', `info`='$info', `url`='$slink', `akcija`='$akcija', `yps`='$priv',
`i1`='$i1', `i2`='$i2', `i3`='$i3', `i4`='$i4', `i5`='$i5', `i6`='$i6', `i7`='$i7', `i8`='$i8', `i9`='$i9', `i10`='$i10', `i11`='$i11', `i12`='$i12', `i13`='$i13', `v1`='$v1', `v2`='$v2', `v3`='$v3', `v4`='$v4', `v5`='$v5', `v6`='$v6', `v7`='$v7', `m1`='$m1', `m2`='$m2', `m3`='$m3', `m4`='$m4', `m5`='$m5', `m6`='$m6', `uid`='$uid', `data`='$date', `gift`='$baneris', `tags`='$tags'") or die(mysql_error());

$get_last_id=mysql_query("Select * from `auto` where `uid`='$uid' order by `id` desc Limit 0,1");
$gli=mysql_fetch_array($get_last_id);
$sid = $gli['id'];
$foto_sk = addslashes($_POST['foto_sk']);
$foto_dir = "photo";
//20 ����.
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
$inser_foto=mysql_query("Insert into `foto` set `type`='1', `url`='$file_destination', `sid`='$sid'");
}
}
}


mysqldisconnect();
header("Location: loged/auto/inserted.msg");

?>