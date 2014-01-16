<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";
ini_set('display_errors', true);
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
	
	$subject = "$name предлагает посмотреть инфо о электронике"; //чего пишем в заголовке
	//само письмо
	$message_text = ""; 
	$message_text.= "$name предлагает посмотреть инфо о электронике:<br>";
	$spares=getProduct($send);
	$message_text.= "Марка: ".$spares['name']."<br>";
	$message_text.= "Модель: ".$spares['model']."<br>";
	$message_text.= "Состояние: ".$spares['sost']."<br>";
	$message_text.= "Количество: ".$spares['kol']."<br>";
	$message_text.= "Цена: ".$spares['price']."<br>";
	$message_text.= "<img src=automixs.com/prodimages/".$send."_1.jpg><br>";
	$message_text.= "<a href=http://automixs.com/products/show/$send/>Электроника</a>";

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

$smarty->display('show_frend4.tpl');
