<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";

$partners=getPartners();
$smarty->assign("partners", $partners);

$search_engine =getMainSearchEngine ();
$smarty->assign("search_engine", $search_engine);
$p = processGetVariable('p');
$p = intval($p);
if ($p=="") $p=24;

$smarty->assign("n_page","contact");
$smarty->assign("hideright", true);

$category = $p;
$publication = getLastArticleUser($category);
$smarty->assign('publication', $publication);
$smarty->assign('title', $publication['title']);
$smarty->assign("category", $category);
$smarty->assign("hide_search", true);

$send = processPostVariable('send');
$name = processPostVariable('name');
$email = processPostVariable('email');
$phone = processPostVariable('phone');
$message = processPostVariable('message');
 if ($send) {
 	$smarty->assign("send_hide", true);
 		// пишем письма
	$to = "admin@autoway.by"; //Кому отправлять
	$from = "no-reply@autoway.by"; // от кого :)
	$subject = "Сообщение со страницы контактов"; //чего пишем в заголовке
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
	//echo $message_text;
	//echo "</pre>";
	mail($to, $subject, $message_text, $headers);	 
 }


$smarty->display('contact.tpl');