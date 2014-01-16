<?php
//require_once("../config.php");

mysql_connect($config['db']['host'].':'.$config['db']['port'],
$config['db']['user'],$config['db']['password']) or die('Can\'t connect to database');

mysql_selectdb($config['db']['database']);

mysql_query("SET names utf8");

function sql_query($query) {
	$res = mysql_query($query);
	if (!$res) {
		echo "Error " . mysql_errno() . ": " . mysql_error(). "<br />\n" . $query;
		sql_rollback_transaction();
		die();
	}
	return $res;
}

function sql_query_vbulletin($query) {
	global $config;
	
	if ($config['db']['database'] != $config['db']['vbulletindatabase']) {
		mysql_selectdb($config['db']['vbulletindatabase']);
		$res = sql_query($query);
		mysql_selectdb($config['db']['database']);
		return $res;
	} else {
		return sql_query($query);
	}
}

/**
 * Возвращает первую строку из результата запроса
 * @param string $query запрос
 * @return array первая строка
 */
function sql_one($query) {
	$res = sql_query($query);
	$result = mysql_fetch_assoc($res);
	mysql_free_result($res);
	return $result;
}

/**
 * Возвращает все строки из запроса
 *
 * @param string $query запрос
 * @return array двумерный массив
 */
function sql_all($query) {
	$res = sql_query($query);
	$result = array();
	while ($row = mysql_fetch_assoc($res)) {
		$result[] = $row;
	}
	mysql_free_result($res);
	return $result;
}

/**
 * Возвращает первое значение из первой строки
 *
 * @param string $query запрос
 * @return string значение
 */
function sql_single_value($query) {
	$res = sql_query($query);
	$result = mysql_fetch_row($res);
	mysql_free_result($res);
	return $result[0];
}

$transaction_depth = 0;

/**
 * Начинаем транзакцию
 */
function sql_start_transaction() {
	global $transaction_depth;
	$res = mysql_query("START TRANSACTION");
	++$transaction_depth;
}

/**
 * Коммитим транзакцию
 * 
 * @return boolean
 */
function sql_commit_transaction() {
	global $transaction_depth;
	if ($transaction_depth <= 0) {
		return false;
	}
	mysql_query("COMMIT");
	--$transaction_depth;
	return true;
}

/**
 * Откатываем транзакцию
 * 
 * @return boolean
 */
function sql_rollback_transaction() {
	global $transaction_depth;
	if ($transaction_depth <= 0) {
		return false;
	}
	mysql_query("ROLLBACK");
	$transaction_depth = 0;
	return true;
}