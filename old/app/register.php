<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";


$partners=getPartners();
$smarty->assign("partners", $partners);

$mode = processGetVariable('mode');

//AJAX
if ($mode=="ckecklogin"){
	$login = processPostVariable('login');
	$answer = checklogin($login);
	echo $answer;
}
else {
//

$register = processPostVariable('register');
if ($register=="true") {
	$login=processPostVariable('login');
	$password=processPostVariable("pass1");
	$name = processPostVariable("name");
	$email = processPostVariable("email");
	$tel1 = processPostVariable("tel1");
	$tel2 = processPostVariable("tel2");
	$city = processPostVariable('city');
	$url =processPostVariable('url');
	$yearsex = processPostVariable('yearsex');
	$business =processPostVariable("business");
	register($login, $password, $name, $email, $tel1, $tel2, $city, $url, $yearsex,$business);
	
	$smarty->assign("hidef","true");
}
$smarty->display("register.tpl");
//search top
}
?>