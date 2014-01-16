<?php 
$name = addslashes($_POST['name']);
$city = addslashes($_POST['city']);
$email = addslashes($_POST['email']);
$tel1 = addslashes($_POST['tel1']);
$tel2 = addslashes($_POST['tel2']);
$url = addslashes($_POST['url']);
$yearsex = addslashes($_POST['yearsex']);
$business = addslashes($_POST['business']);
$login = addslashes($_POST['login']);
$pass1 = addslashes($_POST['pass1']);
$pass2 = addslashes($_POST['pass2']);

if ((!empty($name) && !empty($email)) && (!empty($tel1) && !empty($login)) && $pass1 == $pass2) {
$pass = md5($pass1);
$type = md5("vartotojas");
include('web.php'); mysqlconnect();
$it = mysql_query('SET NAMES utf8'); 
$et = mysql_query('SET CHARACTER SET urf8');
$ip = getenv('REMOTE_ADDR');
$insert_z=mysql_query("Insert into `users` set `name`='$name', `city`='$city', `email`='$email', `tel1`='$tel1', `tel2`='$tel2', `url`='$url', `yearsex`='$yearsex', `business`='$business', `login`='$login', `pass`='$pass', `ip`='$ip', `type`='$type'") or die(mysql_error());
mysqldisconnect();

header("Location: user/register/ok.msg");
} else {
header("Location: user/register/false.msg");
}
?>