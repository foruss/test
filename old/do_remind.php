<?php 

$login = addslashes($_POST['login']);

if (strlen($login) > '3') {
include('web.php'); mysqlconnect();
$it = mysql_query('SET NAMES utf8'); 
$et = mysql_query('SET CHARACTER SET urf8');

$geto=mysql_query("Select * from `users` where `login`='$login'");
$otzz=mysql_num_rows($geto);

$row=mysql_fetch_array($geto);
$pass = $row['pass'];
$email = stripslashes($row['email']);

$laiskas = "Восстановление пароля пользователя rulein на AUTOMIXS\n\nБыла получена заявка на восстановление пароля.\nЕсли вы желаете восстановить пароль на сайте, перейдите по ссылке:\n
http://www.automixs.com/restore/$login/$pass/\n(или скопируйте ее в браузер)\nСсылка действительна в течение суток.";

$header = "Content-type: text/plain; charset=\"utf-8\"\r\n";
$header .= "From: automixs.com <info@automixs.com>\r\n";

mail("$email", "Automixs.com", $laiskas, $header);

mysqldisconnect();

if ($otzz == '0') {
header("Locartion: user/reminder/false.msg");
} else {
header("Location: user/reminder/ok.msg");
}

} else {
header("Location: user/reminder/false.msg");
}
?>