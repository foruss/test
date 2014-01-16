<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";

$smarty->assign("prototype", true);
$mode = processGetVariable('mode');

$search_brands = getMainSearchBrands();
$smarty->assign("search_brands", $search_brands);
//print_r($search_brands);
$search_engine =getMainSearchEngine ();
$smarty->assign("search_engine", $search_engine);
$LeftAutoBrands = getAutoBrands();
$smarty->assign("leftbrands",$LeftAutoBrands);


$id = processGetVariable('id');
$moto=getAllBoatbyID1($id);
$smarty->display("print2.tpl");

?>