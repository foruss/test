<?php
//require_once("../config.php");
require_once(SMARTY_DIR . 'Smarty.class.php');
//require_once(DATA_DIR . 'site.php');
require_once(LIB_DIR . 'user.php');

if (!isset($smarty)) {
	$smarty = new Smarty;

	$smarty->template_dir = ROOT_DIR . 'templates/';
	$smarty->compile_dir = ROOT_DIR . 'templates_c/';
	$smarty->config_dir = ROOT_DIR . 'configs/';
	$smarty->cache_dir = ROOT_DIR . 'cache/';
	
	// Добавляем переменные по-умолчанию
	
	$smarty->assign('title', $sitetitle);
	
	isUserLoggedIn();
	$smarty->assign('user', $config["user"]);
	
	$smarty->assign("curs", $curs);
	
}


if ($config['user']['loggedin']){
	$user_info = getUserInfo($config['user']['id']);
	$smarty->assign("user_info",$user_info);
}

$nav_pages = getPagesList();
$products = listLastProducts(12);
$smarty->assign('products', $products);
$smarty->assign("nav_pages", $nav_pages);


if($_GET['mode']=='all')
$arrBaners=getAllBanersByTip(7);
elseif($_GET['mode']=='list' || $_GET['mode']=='spis')
$arrBaners=getAllBanersByTip(8);
else
$arrBaners=getAllBanersByTip(4);

$smarty->assign("left_baners", $arrBaners);
$arrBaners=getAllBanersByTip(5);
$smarty->assign("right_baners", $arrBaners);
$arrBaners=getAllBanersByTip(3);
if(count($arrBaners)>0){
$rand=rand(1,count($arrBaners));
$rand=$rand-1;
$smarty->assign("main_baner", $arrBaners[$rand]);
}
$arrBaners=getAllBanersByTip(6);
if(count($arrBaners)>0){
$rand=rand(1,count($arrBaners));
$rand=$rand-1;
$smarty->assign("bottom_baner", $arrBaners[$rand]);
}
$arrBaners=getAllBanersByTip(1);
if(count($arrBaners)>0){
$rand=rand(1,count($arrBaners));
$rand=$rand-1;
$smarty->assign("header_baner1", $arrBaners[$rand]);
}
$arrBaners=getAllBanersByTip(2);
if(count($arrBaners)>0){
$rand=rand(1,count($arrBaners));
$rand=$rand-1;
$smarty->assign("header_baner2", $arrBaners[$rand]);
}
$smarty->assign("sec_new", getAllSect());
