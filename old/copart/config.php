<?php
ini_set('display_errors', true);
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


//include_once( INCLUDES_DIR."langs.php" );
require_once( INCLUDES_DIR."functions.php" );
require_once( INCLUDES_DIR."langs.php" );

$no_image_full='images/no-image-full.gif';
$no_image     ='images/no-image.gif'     ;
