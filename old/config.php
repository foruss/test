<?php
// Подготавливаем среду выполнения
ini_set('display_errors', true);
error_reporting(E_ALL);
ini_set('magic_quotes_gpc', "0");
ini_set('magic_quotes_runtime', "0");
ini_set('magic_quotes_sybase', "0");
ini_set('register_globals', "0");
ini_set('mbstring.internal_encoding', "UTF-8");

define('ROOT_DIR', dirname(__FILE__)."/");
define('LIB_DIR', dirname(__FILE__)."/lib/");
define('SMARTY_DIR', dirname(__FILE__)."/smarty/");
define('DATA_DIR', dirname(__FILE__)."/data/");

session_start();

global $manheim_login;
$manheim_login["user"]="universalauto8";
$manheim_login["password"]="anatolii8";

include 'currency/php/current.php';

$cache_interval_minutes = 10; //main page
$keep_in_cache_minutes = 240; //other pages
$sitetitle = "Automixs";

define("CACHEDIR", ROOT_DIR.'cache/' );
$cache_interval_minutes = 90;

$project_encoding = 'utf-8';

$config = array();

$config = array();  
$config['db'] = array(); 
$config['db']['host'] = 'localhost'; 
$config['db']['port'] = '3306'; 
$config['db']['user'] = 'automixs_kinaweb'; 
$config['db']['password'] = 'X]kKvRZZJMCm'; 
$config['db']['database'] = 'automixs_automixs';  

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
