<?php 

function get_marke($mid) {
$imk_marke=mysql_query("Select * from `marke` where `id`='$mid'");
$im=mysql_fetch_array($imk_marke);
$name = $im['name'];
return $name;

}

function get_modelis($mod) {
$imk_modeli = mysql_query("Select * from `modelis` where `id`='$mod'");
$imd=mysql_fetch_array($imk_modeli);
$name = $imd['name'];
return $name;
}

function get_color($mod) {
$imk_modeli = mysql_query("Select * from `la_spalva` where `id`='$mod'");
$imd=mysql_fetch_array($imk_modeli);
$name = $imd['ru'];
return $name;
}
function get_scolor($mod) {
$imk_modeli = mysql_query("Select * from `la_sspalva` where `id`='$mod'");
$imd=mysql_fetch_array($imk_modeli);
$name = $imd['ru'];
return $name;
}
function get_title($mod) {
$imk_modeli = mysql_query("Select * from `la_title` where `id`='$mod'");
$imd=mysql_fetch_array($imk_modeli);
$name = $imd['ru'];
return $name;
}
function get_pd($pd) {

if ($pd == '1') {
$pd ='Автоматическая';
} else if ($pd == '2') {
$pd='Комбинированная';
} else if ($pd == '3') {
$pd='Механическая';
} else {
$pd = 'n/a';
}
return $pd;
}

function get_keb($kid) {

$get_itk=mysql_query("Select * from `la_kebulas` where `id`='$kid'");
$ott=mysql_fetch_array($get_itk);

$kname = $ott['ru'];
return $kname;
}
?>