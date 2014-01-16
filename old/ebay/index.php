<?php
include_once("../config.php");
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";

$noimage='images/no-image.gif';
$noimage_full='images/no-image-full.gif';
$partners=getPartners();
$smarty->assign("partners", $partners);
define( "CURRENT_TIME", time( ) );
//define('ROOT_DIR', dirname(__FILE__)."/"); 
define( "INCLUDES_DIR", ROOT_DIR."ebay/functions/" );
define( "CLASSES_DIR", ROOT_DIR."classes/" );
define( "TEMPLATES_DIR", ROOT_DIR."templates/" );
define( "MODULES_DIR", ROOT_DIR."ebay/modules/" );

//@setlocale( @LC_ALL, "ru_RU.CP1251" );
//@setlocale( @LC_CTYPE, "ru_RU.CP1251" );
//@setlocale( @LC_TIME, "ru_RU.CP1251" );


include_once( INCLUDES_DIR."langs.php" );
include_once( INCLUDES_DIR."functions.php" );

$smarty->assign("lhide", true);

$smarty->assign('noimage',$noimage);
$smarty->assign('noimage_full',$noimage_full);
$smarty->assign('referer', urlencode($_SERVER['HTTP_REFERER']));
$mode=isset($_REQUEST["mode"])?$_REQUEST["mode"]:"";

//Список доступных модулей
$avaible_modules= array('main','searchresults','searchresults1','advancedsearch','lot');

$avaible_modules = array_flip ($avaible_modules);
if (!isset($avaible_modules[$mode])) $mode='main';
$search_module = $mode;

//if ($mode=="lot") $smarty->assign("hide", true);

if(file_exists(MODULES_DIR.$search_module.".php")){

    include_once(MODULES_DIR.$search_module.".php");
    $smarty->display(TEMPLATES_DIR."header.tpl");
    $smarty->display(TEMPLATES_DIR."e-".$search_module.".tpl");
}else{
	die ('eroro!');
	
}
 $smarty->display(TEMPLATES_DIR."footer.tpl");
?>
