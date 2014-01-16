<?php 
$fio = addslashes($_POST['fio']);
$email= addslashes($_POST['email']);
$phon = addslashes($_POST['phon']);
$city = addslashes($_POST['city']);
$skype = addslashes($_POST['skype']);
$text = addslashes($_POST['text']);

if (!empty($fio) && !empty($email) && !empty($phon) && !empty($city) && !empty($skype) && !empty($text)) {


$to = "myautomix@gmail.com"; //Кому отправлять myautomix@gmail.com info@automixs.com
$to2 = "myautomix@gmail.com"; //Кому отправлять

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
	

header("Location: contacts/sent.msg");
} else {
header("Location: contacts/error.msg");
}
?>