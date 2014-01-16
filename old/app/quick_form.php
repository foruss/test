<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";

$partners=getPartners();
$smarty->assign("partners", $partners);
$fio=processPostVariable('fio');
$email=processPostVariable('email');
$text=processPostVariable('text');
$phon=processPostVariable('phon');
$city=processPostVariable('city');
$skype=processPostVariable('skype');
if(!empty($email)){

$to = "info@automixs.com"; //Кому отправлять
$to2 = "automixs@yahoo.com"; //Кому отправлять

$from = $email; // от кого :)
	$date = date("d-m-y");
	$subject = "Automixs contacts ".$date; //чего пишем в заголовке
	//само письмо
	$message_text = ""; 
	$message_text.= "ФИО: $fio<br />";
	$message_text.= "Email: $email<br />";
	$message_text.= "Телефон: $phon<br />";
	$message_text.= "Город: $city<br />";
	$message_text.= "skype: $skype<br />";
	$message_text.= "Сообщение: $text<br />";
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	
	$headers .= "From: <".$from.">";
	//echo "<pre>";
	//echo $subject."<br />";
	//echo $message_text;
	//echo "</pre>";
	mail($to, $subject, $message_text, $headers);
	mail($to2, $subject, $message_text, $headers);
	$smarty->assign("mode","sent");


}
$url = "contact";

$publication =array();
$publication[0] = "";
$publication[0]['title']="";
$publication[0]['keywords']="";
$publication[0]['description']="";

$publication = getPublication($url, "ru");

if (sizeof($publication)==0) {
	//page not found!!!
	header(null,null,404);
	header("Location: /404/");
}

$smarty->assign("publication", $publication[0]);
$smarty->assign("title", $publication[0]['title']);
$smarty->assign("keywords", $publication[0]['keywords']);
$smarty->assign("description", $publication[0]['description']);


$smarty->display("text.tpl");