<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";

$name=processPostVariable('name');
$email=processPostVariable('email');
$message=processPostVariable('message');
$phone = processPostVariable('phone');

$smarty->assign("name", $name);
$smarty->assign("email", $email);
$smarty->assign("message", $message);
$smarty->assign("hide_r", true);

if(($name!="")&&($email!="")&&($message!="")) {
	if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] ==  $_POST['keystring']){
	//echo "ok!"; 
	$smarty->assign("mode", "ok");
	
	$to = "admin@aec.by"; //Кому отправлять
	$from = "no-reply@aec.by"; // от кого :)
	$date = date("d-m-y");
	$subject = "Aec feedback ".$date; //чего пишем в заголовке
	//само письмо
	$message_text = ""; 
	$message_text.= "Имя: $name<br />";
	$message_text.= "Tel: $phone<br />";
	$message_text.= "Email: $email<br />";
	$message_text.= "Сообщение: $message<br />";
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	
	$headers .= "From: <".$from.">";
	//echo "<pre>";
	//echo $subject."<br />";
	//echo $message_text;
	//echo "</pre>";
	mail($to, $subject, $message_text, $headers);
	}else $smarty->assign("mode", "error");	 
}
else {
	$smarty->assign("mode", "error");
	
}

$smarty->display("feedback.tpl");