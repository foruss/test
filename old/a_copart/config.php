<?php
ini_set('display_errors', false);
error_reporting(E_ALL); 
$project_encoding = 'UTF-8';

$copart_login = "652441";
$copart_passwd = "b5qm4f";
$passwd = base64_encode($copart_login.":".$copart_passwd);
$login['user']=$copart_login;
$login['password']=$copart_passwd;



define( "CURRENT_TIME", time( ) );
define('ROOT_DIR', dirname(__FILE__)."/"); 
define( "INCLUDES_DIR", ROOT_DIR."functions/" );
define( "CLASSES_DIR", ROOT_DIR."classes/" );
define( "TEMPLATES_DIR", ROOT_DIR."templates/" );
define( "MODULES_DIR", ROOT_DIR."modules/" );

define( "COOKIES_DIR", ROOT_DIR."templates_c/" );

require_once ROOT_DIR . "smarty/Smarty.class.php";
$smarty = new Smarty();
$smarty->template_dir = ROOT_DIR . 'templates/';
$smarty->compile_dir =  'templates_c/';
$smarty->config_dir = ROOT_DIR . 'configs/';
$smarty->cache_dir = ROOT_DIR . 'cache/';


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


include_once("../currency/php/current.php");
include_once("dbutils.php");
include_once("utils.php");

//include_once( INCLUDES_DIR."langs.php" );
require_once( INCLUDES_DIR."functions.php" );
require_once( INCLUDES_DIR."langs.php" );

$no_image_full='images/no-image-full.gif';
$no_image     ='images/no-image.gif'     ;
