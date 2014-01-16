<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";
require_once LIB_DIR . "currency.php";

$partners=getPartners();
$smarty->assign("partners", $partners);

$smarty->assign('title', "Таможенный калькулятор");
//$smarty->assign("category", $category);

//$smarty->assign("mainpage", true);
/*
$availibleauto = getRandAvailibleAuto(100);
$smarty->assign('availibleauto', $availibleauto);
*/
	$eur = $currency[5]['Rate'];
	$usd = $currency[4]['Rate'];
	$rub = $currency[16]['Rate'];
	
	$curs['eur_usd'] = $eur/$usd;
	$curs['usd_rub'] = $usd/$rub;

	$smarty->assign('currency', $curs);

$smarty->display('calc.tpl');
