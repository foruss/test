<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";

$mode = processGetVariable('mode');

$settings = processPostVariable('settings');
if ($settings=="true") {
	$password=processPostVariable("pass1");
	$name = processPostVariable("name");
	$email = processPostVariable("email");
	$tel1 = processPostVariable("tel1");
	$tel2 = processPostVariable("tel2");
	$city = processPostVariable('city');
	$url =processPostVariable('url');
	$yearsex = processPostVariable('yearsex');
	$business =processPostVariable("business");
	save_user($config['user']['id'], $password, $name, $email, $tel1, $tel2, $city, $url, $yearsex, $business);
	
	$smarty->assign("hidef","true");
}
$smarty->display("settings.tpl");
?>