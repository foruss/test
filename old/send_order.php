<?php
$name = addslashes($_POST['name']);
$email = addslashes($_POST['email']);
$city = addslashes($_POST['city']);
$make = addslashes($_POST['make']);
$model = addslashes($_POST['model']);
$year = addslashes($_POST['year']);
$maxcost= addslashes($_POST['maxcost']);
$skype = addslashes($_POST['skype']);
$phone = addslashes($_POST['phone']);
$msg= addslashes($_POST['message']);

if (!empty($name) && !empty($email) && !empty($city) && !empty($make) && !empty($model) && !empty($year) && !empty($maxcost) && !empty($skype) && !empty($phone) && !empty($msg)) {

$laiskas ="";
$laiskas .="ФИО: $name<br />";
$laiskas .="Email: $email<br />";
$laiskas .="Адрес: $city<br />";
$laiskas .="Марка: $make<br />";
$laiskas .="Модель: $model<br />";
$laiskas .="Год выпуска: $year<br />";
$laiskas .="Максимальная цена: $maxcost<br />";
$laiskas .="скайп: $skype<br />";
$laiskas .="телефон: $phone<br />";
$laiskas .="Сообщение: $msg<br />";

$to = "info@automixs.com"; //Кому отправлять
$to2 = "automixs@yahoo.com"; //Кому отправлять

$from = $email; // от кого :)
$date = date("d-m-y");
$subject = "Automixs order car ".$date; 
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= "From: $from\r\n";
mail($to, $subject, $laiskas, $headers);
mail($to2, $subject, $laiskas, $headers);

header("Location: order-car/sent.msg");
} else {
header("Location: order-car/error.msg");
}
?>

