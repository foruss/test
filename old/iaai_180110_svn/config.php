<?php
ini_set('display_errors', true);
error_reporting(E_ALL); 

$project_encoding = 'utf-8';

$iaai_login['user'] = 'jkauto';
$iaai_login['password'] = 'juleczka';



$noimage='images/no-image.gif';
$noimage_full='images/no-image-full.gif';

define( "CURRENT_TIME", time( ) );
define('ROOT_DIR', dirname(__FILE__)."/"); 
define( "INCLUDES_DIR", ROOT_DIR."functions/" );
define( "CLASSES_DIR", ROOT_DIR."classes/" );
define( "TEMPLATES_DIR", ROOT_DIR."templates/" );
define( "MODULES_DIR", ROOT_DIR."modules/" );

require_once ROOT_DIR . "smarty/Smarty.class.php";
$smarty = new Smarty();
$smarty->template_dir = ROOT_DIR . 'templates/';
$smarty->compile_dir =  'templates_c/';
define( "CACHEDIR", ROOT_DIR.'templates_c/' );
$smarty->config_dir = ROOT_DIR . 'configs/';
$smarty->cache_dir = ROOT_DIR . 'cache/';



$cache_interval_minutes = 90;

include_once( INCLUDES_DIR."langs.php" );
include_once( INCLUDES_DIR."functions.php" );
?>