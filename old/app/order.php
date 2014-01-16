<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";

$partners=getPartners();
$smarty->assign("partners", $partners);

ini_set('display_errors', true);
$lang=processGetVariable('lang');
if($lang=="") $lang="ru";
$smarty->assign("lang", $lang);

$email = processPostVariable('email');
$title = processPostVariable('title');
$name = processPostVariable('name');
$url = processPostVariable('url');
$phone = processPostVariable('phone');
$dealerid = processPostVariable('dealerid');
if($email&&$title) {
	
	addOrderToBase($email, $title, $name, $url, $phone, $dealerid);
	
}

$smarty->display($lang."/order.tpl");