<?
header("Content-type: text/javascript");


$user = addslashes($_GET['user']);
if (!empty($user)) {
	include('web.php'); mysqlconnect();
	$it = mysql_query('SET NAMES utf8'); 
$et = mysql_query('SET CHARACTER SET urf8');
	$bandom = mysql_query("Select * from `users` where `login`='$user'");
	$kiekis = mysql_num_rows($bandom);
	if ($kiekis != 0) {
			echo("document.getElementById('login').className = \"a2\";");
			echo("register.reg.disabled = true;");
			echo("alert('Логин уже занят!');");
	} else {
		echo("document.getElementById('login').className = \"a1\";");
		echo("register.reg.disabled = false;");
	}
	mysqldisconnect();
}
?>