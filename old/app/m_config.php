<?php
ini_set('display_errors', true);
error_reporting(E_ALL); 
global $debug;
$debug = false;
global $manheim_login;
$manheim_login["user"]="vbauto1";
$manheim_login["password"]="dallas4";

$cache_interval_minutes = 10; //main page
$keep_in_cache_minutes = 240; //other pages

$project_encoding = 'utf-8';
$prefix = '';


define( "CURRENT_TIME", time() );
define('ROOT_DIR', dirname(__FILE__)."/"); 
define( "INCLUDES_DIR", ROOT_DIR."functions/" );
define( "CLASSES_DIR", ROOT_DIR."classes/" );
define( "TEMPLATES_DIR", ROOT_DIR."templates/" );
define( "PARSERS_DIR", ROOT_DIR."libs/modules/" );
define( "CACHEDIR", ROOT_DIR.'templates_c/' );

require_once "../manheim_new/libs/Smarty.class.php";
$smarty = new Smarty();
$smarty->template_dir = ROOT_DIR . 'templates/';
$smarty->compile_dir = ROOT_DIR . 'templates_c/';
$smarty->config_dir = ROOT_DIR . 'configs/';
$smarty->cache_dir = ROOT_DIR . 'cache/';



include_once("m_langs.php" );
include_once("m_functions.php" );
?>
