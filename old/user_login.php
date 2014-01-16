<?php
$login = addslashes($_POST['login']);
$pass = addslashes($_POST['pass']);
$go_url = $_POST['go_url'];
if (!empty($pass) && !empty($login)) {
include('web.php'); mysqlconnect();
$pass = md5($pass);
$un = substr(md5(uniqid(rand())), 0, 6);
$check_if= mysql_query("Select * from `users` where `login`='$login' and `pass`='$pass'") or die(mysql_error());
$osk=mysql_num_rows($check_if);
if ($osk == '0') {

} else {
$last = date("Y-m-d H:i:s");
$updaiz=mysql_query("Update `users` set `ses`='$un', `lastlogin`='$last' where `login`='$login' and `pass`='$pass'") or die(mysql_error());
session_start();
$_SESSION['amixs'] = $un;
}

mysqldisconnect();
if ($osk == '0') {
header("Location: user/false.msg");
} else {
// header("Location: $go_url");
//header("Location: index.php");
header("Location: loged/auto.html"); 

// http://www.automixs.com/
}
} else {
header("location: user/false.msg");
}

?>