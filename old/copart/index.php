<?php
include_once("config.php");

$mode=isset($_REQUEST["mode"])?$_REQUEST["mode"]:"";
	$smarty->assign('no_image_full',$no_image_full);
	$smarty->assign('no_image',$no_image);
	$smarty->assign('project_encoding',$project_encoding);
$smarty->assign('referer', urlencode($_SERVER['HTTP_REFERER']));
//Список доступных модулей
$avaible_modules= array('main','results','auction','calendar','showall','showlot','allimgs','vindecode');
		
$avaible_modules = array_flip ($avaible_modules);
if (!isset($avaible_modules[$mode])) $mode='main';
$search_module = $mode;
 

if(file_exists(MODULES_DIR.$search_module.".php")){

    include_once(MODULES_DIR.$search_module.".php");
    if ($search_module!='vindecode') $smarty->display(TEMPLATES_DIR."header.tpl");
    $smarty->display(TEMPLATES_DIR."copart-".$search_module.".tpl");
}else{
	die ('eroro!');
	//die("module $search_module not found");
}
 	if ($search_module!='vindecode') $smarty->display(TEMPLATES_DIR."footer.tpl");
?>