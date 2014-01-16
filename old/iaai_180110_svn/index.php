<?php
include_once("config.php");

$smarty->assign('noimage',$noimage);
$smarty->assign('noimage_full',$noimage_full);
$mode=isset($_REQUEST["mode"])?$_REQUEST["mode"]:"";
$error_results = '';

//Список доступных модулей
$avaible_modules= array('main','searchresults','advancedsearch','lot','imgpop');
$avaible_modules = array_flip ($avaible_modules);
if (!isset($avaible_modules[$mode])) $mode='main';
$search_module = $mode;

session_start();
if(file_exists(MODULES_DIR.$search_module.".php")){

    include_once(MODULES_DIR.$search_module.".php");
    $smarty->display(TEMPLATES_DIR."header.tpl");
    $smarty->display(TEMPLATES_DIR.$search_module.".tpl");
}else{
	die ('eroro!');	
}
 $smarty->display(TEMPLATES_DIR."footer.tpl");
?>