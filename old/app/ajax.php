<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";

$part = processGetVariable('part');
$mode = processGetVariable('mode');

if ($mode=="getpart") {
$part = GetCarParts($part);
$smarty->assign("parts", $part);
$smarty->display("ajax_carparts.tpl");
}
elseif ($mode=="getprice") {
$price = GetCarPartPrice($part);
$smarty->assign("price", $price);
$smarty->display("ajax_price.tpl");
}
elseif ($mode=="getmodel") {
$make = $part;
$modellist = getMainSearchModels($make);

$smarty->assign("models", $modellist);
$smarty->display("ajax_modellist.tpl");
}
elseif ($mode=="getminyear") {
$min = GetMinSearchYear($part);	
}
elseif ($mode=="getmaxyear") {
$max = GetMaxSearchYear($part);
}
