<?php
include_once("config.php");
$smarty->assign('prefix',$prefix);
$smarty->assign('project_encoding',$project_encoding);
$smarty->assign("curs", $curs);

$mode=isset($_REQUEST["mode"])?$_REQUEST["mode"]:"";
/*
$nav_pages=getNavigation();
$smarty->assign("nav_pages", $nav_pages);
$partners=getPartners();
$smarty->assign("partners", $partners);*/

$partners=getPartners();
$smarty->assign("partners", $partners);
$nav_pages=getNavigation();
$smarty->assign("nav_pages", $nav_pages);


//������ ��������� �������
$avaible_modules= array('main','searchresults','lot','creport','mmr','readbid','setbid','step1','step2','step3','step4','msn','lotp');

$avaible_modules = array_flip ($avaible_modules);
if (!isset($avaible_modules[$mode])) $mode='main';
$search_module = $mode;

//print PARSERS_DIR.$search_module.".php";
if(file_exists(PARSERS_DIR.$search_module.".php")){

    include_once(PARSERS_DIR.$search_module.".php");
    $smarty->display(TEMPLATES_DIR."header.tpl");
    $smarty->display(TEMPLATES_DIR.$search_module.".tpl");
}else{
	die ('eroro!');
	die("������ $search_module �� ������.");
}
 $smarty->display(TEMPLATES_DIR."footer.tpl");
?>