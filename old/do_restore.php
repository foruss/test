<?php 

$login = addslashes($_POST['login']);
$pass1 = addslashes($_POST['pass1']);
$pass2 = addslashes($_POST['pass2']);
$sid = addslashes($_POST['sid']);
if ((!empty($login) && strlen($sid) == '32') && $pass1 == $pass2) {
include('web.php'); mysqlconnect();

$updzz=mysql_query("Select * from `users` where `login`='$login' and `pass`='$sid'");
$skk=mysql_num_rows($updzz);
if ($skk == '0') {

} else {
$pass = md5($pass1);
$updzz=mysql_query("Update `users` set `pass`='$pass' where `login`='$login' and `pass`='$sid'");
}
mysqldisconnect();
if ($skk == '0') {
header("Location: restore/pass/false.msg");
} else {
header("Location: restore/pass/ok.msg");
}

} else {
header("Location: restore/pass/false.msg");
}

?>