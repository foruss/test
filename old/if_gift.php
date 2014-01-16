<?php 


$gift = $otas['gift'];
if (!empty($gift)) {

} else {

$id = $otas['id'];
if ($typo == 'auto') {

$imk_one=mysql_query("Select * from `auto` where `onmain`='1' and `id`!='$id' order by rand() LIMIT 0,1 ");
$zz=mysql_fetch_array($imk_one);

$g_marke = get_marke($zz['marke']);
$g_modelis = get_modelis($zz['modelis']);
$g_id = $zz['id'];
$g_kt = $zz['ktype'];
$g_kaina = $zz['kaina'];
$g_metai = $zz['metai'];

if ($g_kt == '1') { $g_kt = '€'; } else if ($g_kt == '2') { $g_kt='$'; } 
$get_fot=mysql_query("Select * from `foto` where `type`='1' and `sid`='$g_id' order by `id` asc");
$ott=mysql_fetch_array($get_fot);
$foto = $ott['url'];
echo('<a title="'.$g_marke.' '.$g_modelis.', '.$g_metai.' - '.$g_kt.' '.$g_kaina.'" href="/auto/show/'.$g_id.'/"><img onmouseover="style.border=\'1px solid #990000\'" onmouseout="style.border=\'1px solid #cccccc\'" style="border: 1px solid #cccccc"  src="phpThumb.php?src='.$foto.'&w=333&h=245" alt="'.$g_marke.' '.$g_modelis.', '.$g_metai.' - '.$g_kt.' '.$g_kaina.'"></a>');

}


}


?>