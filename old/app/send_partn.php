<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";



$partners=getPartners();
$smarty->assign("partners", $partners);

$smarty->assign('title', 'Cообщение отправлено!');

$name = processPostVariable('name');
$activity = processPostVariable('activity');
$surname = processPostVariable('surname');
$position = processPostVariable('position');
$company = processPostVariable('company');
$skill = processPostVariable('skill');
$country = processPostVariable('country');
$city = processPostVariable('city');
$skype = processPostVariable('skype');
$phone = processPostVariable('phone');
$message = processPostVariable('message');
$site = processPostVariable('site');
$email2 = "automixs@yahoo.com";
//$email2 = "root@jerminal.com";
$email1 = processPostVariable('email');


 
 		// пишем письма      admin@autoway.by
	
	$to = $email2; //Кому отправлять
	if ($email1!="")
	$from = $email1; // от кого :)
	else
	$from = "noreply@automixs.com";
	
	$subject = "Partnership"; //чего пишем в заголовке
	//само письмо
	$message_text = ""; 
	$message_text.= "<h1>Сотрудничество</h1><br>";
	$message_text.= "<b>Имя:</b> $name <br>";
	$message_text.= "<b>Фамилия:</b> $surname <br>";
	$message_text.= "<b>Компания:</b> $company <br>";
	$message_text.= "<b>Страна:</b> $country <br>";
	$message_text.= "<b>Город:</b> $city <br>";
	$message_text.= "<b>Телефон:</b> $phone <br>";
	$message_text.= "<b>Вид деятельности:</b> $activity <br>";
	$message_text.= "<b>Должность:</b> $position <br>";
	$message_text.= "<b>Опыт работы:</b> $skill <br>";
	$message_text.= "<b>E-mail:</b> $email <br>";
	$message_text.= "<b>Скайп:</b> $skype <br>";
	$message_text.= "<b>Сайт:</b> $site <br>";
	$message_text.= "<b>Сообщение:</b><br> $message <br>";

	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	
	$headers .= "From: <".$from.">";
	//echo "<pre>";
	//echo $message_text;
	//echo "</pre>";
	mail($to, $subject, $message_text, $headers);	 
	$smarty->assign('mm', '<h1>Сообщение отправлено!</h1>');
	$id=$send;
 
$smarty->assign('id', $id);

$smarty->display('send_mes_ok.tpl');
