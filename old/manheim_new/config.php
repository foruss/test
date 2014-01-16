<?php
ini_set('display_errors', false);
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

require_once ROOT_DIR . "libs/Smarty.class.php";
$smarty = new Smarty();
$smarty->template_dir = ROOT_DIR . 'templates/';
$smarty->compile_dir = ROOT_DIR . 'templates_c/';
$smarty->config_dir = ROOT_DIR . 'configs/';
$smarty->cache_dir = ROOT_DIR . 'cache/';

$config = array();

$config = array();  
$config['db'] = array(); 
$config['db']['host'] = 'localhost'; 
$config['db']['port'] = '3306'; 
$config['db']['user'] = 'linas_kinap'; 
$config['db']['password'] = '01566301'; 
$config['db']['database'] = 'linas_automixs';  

$config['db']['vbulletindatabase'] = 'avto_forum';
$config['db']['vbulletintableprefix'] = '';



$config['user'] = array();
$config['user']['loggedin'] = null;
$config['user']['id'] = 0;
$config['user']['adminemail'] = "admin@ae.by";
$config['user']['lang'] = "ru";

$config['vbulletin'] = array();
$config['vbulletin']['url'] = 'http://forum.test.by/';

$config['news'] = array();
$config['news']['itemsperpage'] = 20;

$config['tender'] = array();
$config['tender']['itemsperpage'] = 10;

$config['publication'] = array();
$config['publication']['itemsperpage'] = 10;

$config['notices'] = array();
$config['notices']['itemsperpage'] = 7;

$config['catalog'] = array();
$config['catalog']['itemsperpage'] = 10;

$config['rating'] = array();
$config['rating']['itemsperpage'] = 20;


include_once("../currency/php/current.php");
include_once("dbutils.php");
include_once("utils.php");
include_once( INCLUDES_DIR."langs.php" );
include_once( INCLUDES_DIR."functions.php" );
?>
