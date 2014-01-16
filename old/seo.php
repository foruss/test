<?php 
$psl = addslashes($_GET['psl']);
$do = addslashes($_GET['do']);
$pid = addslashes($_GET['id']);
if ($psl == 'news' && !empty($do)) {

$get_newit=mysql_query("Select * from `news` where `url`='$do' and `lang`='ru'");
$nit=mysql_fetch_array($get_newit);
$ntitle = stripslashes($nit['title']);
$title = "- ".$ntitle;
$description = stripslashes($nit['description']);
$keywords = stripslashes($nit['keywords']);
} else if ($psl == 'auto' && is_numeric($pid)) {
$get_inf=mysql_query("Select * from `auto` where `id`='$pid'");
$otas=mysql_fetch_array($get_inf);
$marke = get_marke($otas['marke']);
$modelis = get_modelis($otas['modelis']);

$title = "- $marke $modelis";
$uid = $otas['uid'];
$get_emas=mysql_query("Select * from `users` where `id`='$uid'");
$mmm=mysql_fetch_array($get_emas);
$savininko_email = $mmm['email'];
} else if ($psl == 'moto' && is_numeric($pid)) {

$get_inf=mysql_query("Select * from `moto` where `id`='$pid'");
$otas=mysql_fetch_array($get_inf);
$marke = $otas['marke'];
$modelis = $otas['modelis'];
$uid = $otas['uid'];
$get_emas=mysql_query("Select * from `users` where `id`='$uid'");
$mmm=mysql_fetch_array($get_emas);
$savininko_email = $mmm['email'];
$title = "- $marke $modelis";

} else if ($psl == 'boat' && is_numeric($pid)) {

$get_inf=mysql_query("Select * from `valtis` where `id`='$pid'");
$otas=mysql_fetch_array($get_inf);
$marke = $otas['gamintojas'];
$modelis = $otas['pav'];
$uid = $otas['uid'];
$get_emas=mysql_query("Select * from `users` where `id`='$uid'");
$mmm=mysql_fetch_array($get_emas);
$savininko_email = $mmm['email'];
$title = "- $marke $modelis";

} else if ($psl == 'plane' && is_numeric($pid)) {

$get_inf=mysql_query("Select * from `plane` where `id`='$pid'");
$otas=mysql_fetch_array($get_inf);
$marke = $otas['gamintojas'];
$modelis = $otas['pav'];
$uid = $otas['uid'];
$get_emas=mysql_query("Select * from `users` where `id`='$uid'");
$mmm=mysql_fetch_array($get_emas);
$savininko_email = $mmm['email'];
$title = "- $marke $modelis";

}  else if ($psl == 'machinery' && is_numeric($pid)) {

$get_inf=mysql_query("Select * from `spec` where `id`='$pid'");
$otas=mysql_fetch_array($get_inf);
$marke = $otas['gamintojas'];
$modelis = $otas['pav'];
$uid = $otas['uid'];
$get_emas=mysql_query("Select * from `users` where `id`='$uid'");
$mmm=mysql_fetch_array($get_emas);
$savininko_email = $mmm['email'];
$title = "- $marke $modelis";

} else if ($psl == 'spares' && is_numeric($pid)) {

$get_inf=mysql_query("Select * from `dalys` where `id`='$pid'");
$otas=mysql_fetch_array($get_inf);
$marke = $otas['gamintojas'];
$modelis = $otas['pav'];
$uid = $otas['uid'];
$get_emas=mysql_query("Select * from `users` where `id`='$uid'");
$mmm=mysql_fetch_array($get_emas);
$savininko_email = $mmm['email'];
$title = "- $marke $modelis";

} else if ($psl == 'products' && is_numeric($pid)) {

$get_inf=mysql_query("Select * from `sk` where `id`='$pid'");
$otas=mysql_fetch_array($get_inf);

$modelis = $otas['marke'];
$modelis .= " ".$otas['modelis'];
$uid = $otas['uid'];
$get_emas=mysql_query("Select * from `users` where `id`='$uid'");
$mmm=mysql_fetch_array($get_emas);
$savininko_email = $mmm['email'];
$title = "- $modelis";

} else {

$get_it = mysql_query("Select * from `text` where `url`='$psl'");
$mzz=mysql_fetch_array($get_it);

$text = stripslashes($mzz['text']);
$title = "- ".$mzz['title'];
$description = $mzz['description'];
$keywords = $mzz['keywords'];

}

?>