<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";

$partners=getPartners();
$smarty->assign("partners", $partners);


$project_lang=isset($_REQUEST["l"])?$_REQUEST["l"]:"ru";

include_once("functions/langs.php" );
include_once("functions/functions.php");

$project_encoding = 'utf-8';
$iaai_login['user'] = 'jkauto';
$iaai_login['password'] = 'juleczka';

$smarty->assign('referer', urlencode($_SERVER['HTTP_REFERER']));

$noimage='/images/no-image.gif';
$noimage_full='/images/no-image-full.gif';

$smarty->assign('noimage',$noimage);
$smarty->assign('noimage_full',$noimage_full);
$mode=isset($_REQUEST["mode"])?$_REQUEST["mode"]:"";
$error_results = '';

define("INCLUDES_DIR", ROOT_DIR."iaai/functions/");
define("MODULES_DIR", ROOT_DIR."iaai/modules/" );

//Список доступных модулей
$avaible_modules= array('main','searchresults','advancedsearch','lot','imgpop', 'lotall');
$avaible_modules = array_flip ($avaible_modules);
if (!isset($avaible_modules[$mode])) $mode='main';
$search_module = $mode;
if($search_module=="searchresults") $smarty->assign("hidecont", true);

$smarty->assign("lang",$project_lang);
//session_start();
if ($search_module=="main") {
$publication = getPublication("iaai_descr", "ru");
//print_r($publication);
$smarty->assign("publication", $publication[0]['content']);
$smarty->assign("title", $publication[0]['title']);
$smarty->assign("keywords", $publication[0]['keywords']);
$smarty->assign("description", $publication[0]['description']);
}

if(file_exists("modules/".$search_module.".php")){

    include_once(MODULES_DIR.$search_module.".php");
if ($mode!="lotall") $smarty->display("header.tpl");
    $smarty->display("iaai-".$search_module.".tpl");
}else{
	die ('eroro!');	
}
if ($mode!="lotall") $smarty->display("footer.tpl");
?>