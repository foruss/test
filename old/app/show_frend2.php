<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";

$search_engine =getMainSearchEngine ();
$smarty->assign("search_engine", $search_engine);
$p = processGetVariable('p');
$p = intval($p);
if ($p=="") $p=24;

$partners=getPartners();
$smarty->assign("partners", $partners);

$smarty->assign('title', 'Показать другу');

$id = processGetVariable('id');
$send = processPostVariable('send');
$name = processPostVariable('name_p');
$email1 = processPostVariable('email_1');
$email2 = processPostVariable('email_2');

 if ($send) {
 
 		// пишем письма      admin@autoway.by
	
	$to = $email2; //Кому отправлять
	if ($email1!="")
	$from = $email1; // от кого :)
	else
	$from = "noreply@automixs.com";
	
	$subject = "$name предлагает посмотреть инфо об лодке"; //чего пишем в заголовке
	//само письмо
	$message_text = ""; 
	$message_text.= "$name предлагает посмотреть инфо об лодке:<br>";
	$boat=getAllBoatbyID1($send);
	$message_text.= "Марка: ".$boat['brand']."<br>";
	$message_text.= "Модель: ".$boat['name']."<br>";
	$message_text.= "Год: ".$boat['year']."<br>";
	$message_text.= "Длина: ".$boat['length']."<br>";
	$message_text.= "Ширина: ".$boat['width']."<br>";
	$message_text.= "Осадка: ".$boat['height']."<br>";
	$message_text.= "Мест: ".$boat['places']."<br>";
	$message_text.= "Потребление топлива: ".$boat['topl_potr']."<br>";
	$message_text.= "Двигатель: ".$boat['dvig']."<br>";
	$message_text.= "Цена: ".$boat['cost']."<br>";
	$message_text.= "<img src=automixs.com/boatimg/".$boat['pic1']."><br>";
	$message_text.= "<a href=http://automixs.com/boat1/show/$send/>Лодка</a>";

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
 }
$smarty->assign('id', $id);

$smarty->display('show_frend2.tpl');