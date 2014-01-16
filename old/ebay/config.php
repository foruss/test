<?php
ini_set('display_errors', false);
error_reporting(E_ALL); 



$noimage='images/no-image.gif';
$noimage_full='images/no-image-full.gif';

define( "CURRENT_TIME", time( ) );
define('ROOT_DIR', dirname(__FILE__)."/"); 
define( "INCLUDES_DIR", ROOT_DIR."functions/" );
define( "CLASSES_DIR", ROOT_DIR."classes/" );
define( "TEMPLATES_DIR", ROOT_DIR."templates/" );
define( "MODULES_DIR", ROOT_DIR."modules/" );

require_once ROOT_DIR . "libs/Smarty.class.php";
$smarty = new Smarty();
$smarty->template_dir = ROOT_DIR . 'templates/';
$smarty->compile_dir =  'templates_c/';
$smarty->config_dir = ROOT_DIR . 'configs/';
$smarty->cache_dir = ROOT_DIR . 'cache/';
//@setlocale( @LC_ALL, "ru_RU.CP1251" );
//@setlocale( @LC_CTYPE, "ru_RU.CP1251" );
//@setlocale( @LC_TIME, "ru_RU.CP1251" );


include_once( INCLUDES_DIR."langs.php" );
include_once( INCLUDES_DIR."functions.php" );
?>


