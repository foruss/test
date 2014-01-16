<?php

require_once("../config.php");
require_once(LIB_DIR . "json.php");
require_once(LIB_DIR . "utils.php");
require_once(LIB_DIR . "dbutils.php");

// TODO убить этот лог после того, как все будет отлажено
$out = print_r($_REQUEST,true);
dblog(__FILE__.":".__LINE__,$out);

$result = array();
$result['success'] = true;
$result['errors'] = array();

if (!isset($_REQUEST['action'])) {
	$result['success'] = false;
	echo $json->encode($result);
	exit;
}

switch ($_REQUEST['action']) {
	case 'list': // Получение списка компаний
		$start = processPostVariable('start');
		if ($start == "") {
			$start = 0;
		}
		$limit = processPostVariable('limit');
		if ($limit == "") {
			$limit = 25;
		}
		$list = listCatalogAdmin($start, $limit, NULL, NULL);
		$result = array_merge($result, $list);
		break;
	case 'changestate': // Изменение состояние
		$id = processPostVariable('id');
		$state = processPostVariable('state');
		switch ($state) {
			case 'ok': $state = 'waiting';
				break;
			case 'yes': $state = 'approved';
				break;
			case 'no': $state = 'disapproved';
				break;
			default:
				$result['success'] = false;
		}
		if ($result['success']) {
			changeStateCatalogAdmin($id, $state); 
		}
		break;
	case 'delete':
		$id = processPostVariable('id');
		deleteCatalogAdmin($id);
		break;
	default:
		$result['success'] = false;
}

echo $json->encode($result);
