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
$s = processGetVariable('s');
$sect = processPostVariable('sect');
$send = processPostVariable('send');
$name = processPostVariable('name_p');
$email1 = processPostVariable('email_1');
$email2 = processPostVariable('email_2');
$smarty->assign('id', $id);
$smarty->assign('sect', $s);
 if ($send) {
 
 		// пишем письма      admin@autoway.by
	
	$to = $email2; //Кому отправлять
	if ($email1!="")
	$from = $email1; // от кого :)
	else
	$from = "noreply@automixs.com";
	
	$subject = "$name предлагает посмотреть вам инфо с сайта automixs.com"; //чего пишем в заголовке
	//само письмо
	$message_text = ""; 
	$message_text.= "$name предлагает посмотреть инфо с сайта automixs.com:<br>";
	$message_text.= "<a href=http://automixs.com/section/$sect/show/$send/>http://automixs.com/section/$sect/show/$send/</a>";

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
	$smarty->assign('id', $send);
	$smarty->assign('sect', $sect);
 }

$smarty->display('show_sec.tpl');