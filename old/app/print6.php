<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";




$id = processGetVariable('id');
$moto=getProduct($id);
$smarty->assign("moto",$moto);
$smarty->display("print6.tpl");

?>