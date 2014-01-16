<?php
//require_once "../config.php";
require_once LIB_DIR . "db.php";
function isUserLoggedIn() {
	global $config;
	if ($config['user']['loggedin'] == null) {
		$res = sql_one("SELECT *
			FROM users
			WHERE session = '".session_id()."' AND ip = '".$_SERVER['REMOTE_ADDR']."' ");
		if ($res) {
			$config['user'] = $res;
			$config['user']['loggedin'] = true;
		
		} else {
			$config['user']['loggedin'] = false;
		}
	}
	return $config['user']['loggedin'];
}

function processUserLogin($login, $password) {
	$login=mysql_real_escape_string($login);
	$password=mysql_real_escape_string($password);
	global $config;
	$q = sql_one("SELECT *
		FROM users
		WHERE STRCMP(login, '$login') = 0 AND password = MD5('$password')");
	if (!$q) {
		return false;
	}
	sql_query("UPDATE users
		SET session = '".session_id()."', ip = '$_SERVER[REMOTE_ADDR]', lastlogin = NOW()
		WHERE id = $q[id]");
		$config['user'] = $q;	
		$config['user']['loggedin'] = true;
	return true;
}