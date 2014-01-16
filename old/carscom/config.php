<?php
ini_set('display_errors', true);
error_reporting(E_ALL); 


define( "CURRENT_TIME", time( ) );
define('ROOT_DIR', dirname(__FILE__)."/"); 
define( "INCLUDES_DIR", ROOT_DIR."functions/" );
define( "CLASSES_DIR", ROOT_DIR."classes/" );
define( "TEMPLATES_DIR", ROOT_DIR."templates/" );
define( "MODULES_DIR", ROOT_DIR."modules/" );
define( "CACHE_DIR", ROOT_DIR."cache/" );

require_once ROOT_DIR . "libs/Smarty.class.php";
$smarty = new Smarty();
$smarty->template_dir = ROOT_DIR . 'templates/';
$smarty->compile_dir =  'templates_c/';
$smarty->config_dir = ROOT_DIR . 'configs/';
$smarty->cache_dir = ROOT_DIR . 'cache/';

$config_proxy_listfile = ROOT_DIR.'proxyfilelist.txt';
$config_proxy_enabled = false;
include_once( INCLUDES_DIR."langs.php" );
include_once( INCLUDES_DIR."functions.php" );
