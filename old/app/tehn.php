<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";

$partners=getPartners();
$smarty->assign("partners", $partners);

$smarty->assign("prototype", true);
$mode = processGetVariable('mode');

$search_brands = getMainSearchBrands();
$smarty->assign("search_brands", $search_brands);
//print_r($search_brands);
$search_engine =getMainSearchEngine ();
$smarty->assign("search_engine", $search_engine);
$LeftAutoBrands = getAutoBrands();
$smarty->assign("leftbrands",$LeftAutoBrands);


if ($mode=="all"){
	$smarty->display("all_tehn.tpl");
}
if ($mode=="auto"){
	$smarty->display("all_auto.tpl");
}
if ($mode=="moto"){
	$smarty->display("all_moto.tpl");
}
if ($mode=="boat"){
	$smarty->display("all_boat.tpl");
}
if ($mode=="machinery"){
	$smarty->display("all_machinery.tpl");
}
if ($mode=="spares"){
	$smarty->display("all_spares.tpl");
}
?>