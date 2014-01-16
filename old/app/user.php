<?php
require_once "../config.php";
require_once LIB_DIR . "db.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";

$partners=getPartners();
$smarty->assign("partners", $partners);


$mode = processGetVariable('mode');

$search_brands = getMainSearchBrands();
$smarty->assign("search_brands", $search_brands);
$search_engine =getMainSearchEngine ();
$smarty->assign("search_engine", $search_engine);

$processlogin = processPostVariable('processlogin');

if (($config['user']['loggedin']) && ($mode == "" || !isset($mode))) $mode = "info";

if ($mode=="info") {
	$userid = $config['user']['id'];
	$user_data = get_user_data($userid);
	//print_r($user_data);
	$smarty->assign("user_data", $user_data);
	$smarty->display("user-info.tpl");
}
elseif ($mode=="edit") {
	$userid = $config['user']['id'];
	$name = processPostVariable("name");
	$email = processPostVariable("email");
	$city = processPostVariable('city');
	$url =processPostVariable('url');
	$yearsex = processPostVariable('yearsex');
	$business =processPostVariable("business");
	$subscribe = processPostVariable("subscribe");
	if ($subscribe=="on") $subscribe='1'; else $subscribe='0';
	//echo $subscribe;
	save_user($userid, $name, $email,$city,$url, $yearsex,$business,$subscribe);
	$smarty->display("user-save-ok.tpl");
}
else{
     if ($processlogin=="1") {
         $login = processPostVariable('login');
      	 $password = processPostVariable('password');
      	 if (!processUserLogin($login, $password)) {
      		$message = "Login error!";
      		$smarty->assign("message", $message);
      	 } 
      	 else{
      	 	$message = "OK!";
      	 	header('location: /');
      	 	die;
      	 }
     }	
	$smarty->display("user-login.tpl");
}
?>
