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
$uid = addslashes($_POST['zz']);

if ((!empty($name) && !empty($email)) && (!empty($tel1) && !empty($login)) && $pass1 == $pass2) {

include('web.php'); mysqlconnect();
$it = mysql_query('SET NAMES utf8'); 
$et = mysql_query('SET CHARACTER SET urf8');
$ip = getenv('REMOTE_ADDR');
if (!empty($pass1)) {
$pas = ", `pass`='$pass1' ";
}
$insert_z=mysql_query("Update `users` set `name`='$name', `city`='$city', `email`='$email', `tel1`='$tel1', `tel2`='$tel2', `url`='$url', `yearsex`='$yearsex', `business`='$business', `login`='$login', `ip`='$ip' ".$pas." where `id`='$uid' and `login`='$login'") or die(mysql_error());
mysqldisconnect();

header("Location: index.php?psl=loged&do=my-settings&msg=ok");
} else {
header("Location: index.php?psl=loged&do=my-settings&msg=false");
}
?>