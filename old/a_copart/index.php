<?php
include_once("config.php");
$smarty->assign("curs", $curs);
$partners=getPartners();
$smarty->assign("partners", $partners);
$nav_pages = getPagesList();
$products = listLastProducts(12);
$smarty->assign('products', $products);
$smarty->assign("nav_pages", $nav_pages);
$arrBaners=getAllBanersByTip(4);
$smarty->assign("left_baners", $arrBaners);
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

$mode=isset($_REQUEST["mode"])?$_REQUEST["mode"]:"";
	$smarty->assign('no_image_full',$no_image_full);
	$smarty->assign('no_image',$no_image);
	$smarty->assign('project_encoding',$project_encoding);
$smarty->assign('referer', urlencode($_SERVER['HTTP_REFERER']));
//Список доступных модулей
$avaible_modules= array('main','results','auction','calendar','showall','showlot','allimgs','vindecode', 'vinsearch');
		
$avaible_modules = array_flip ($avaible_modules);
if (!isset($avaible_modules[$mode])) $mode='main';
$search_module = $mode;
 

if(file_exists(MODULES_DIR.$search_module.".php")){

    include_once(MODULES_DIR.$search_module.".php");
    if ($search_module!='vindecode') $smarty->display(TEMPLATES_DIR."header.tpl");
    $smarty->display(TEMPLATES_DIR.$search_module.".tpl");
}else{
	die ('eroro!');
	//die("module $search_module not found");
}
 	if ($search_module!='vindecode') $smarty->display(TEMPLATES_DIR."footer.tpl");
?>