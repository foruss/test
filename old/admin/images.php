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
	case 'list': // Получение списка картинок
		$start = processPostVariable('start');
		if ($start == "") {
			$start = 0;
		}
		$limit = processPostVariable('limit');
		if ($limit == "") {
			$limit = 25;
		}
		$sortdir = processPostVariable('dir');
		$sort = processPostVariable('sort');
		
		$dir = opendir(ROOT_DIR . "img/");
		$namelist = array();
		$mtimelist = array();
		$sizelist = array();
		while ($filename = readdir($dir)) {
			$ffilename = ROOT_DIR . "img/" . $filename;
			if ($filename == "." || $filename == "..") {
				continue;
			}
			$namelist[] = $filename;
			$mtimelist[] = filemtime($ffilename);
			$sizelist[] = filesize($ffilename);
		}
		closedir($dir);
		switch ($sort) {
			case 'filename':
				array_multisort($namelist, ($sortdir == "ASC" ? SORT_ASC : SORT_DESC), SORT_STRING, $mtimelist, $sizelist);
				break;
			case 'size':
				array_multisort($sizelist, ($sortdir == "ASC" ? SORT_ASC : SORT_DESC), SORT_NUMERIC, $mtimelist, $namelist);
				break;
			case 'mtime':
				array_multisort($mtimelist, ($sortdir == "ASC" ? SORT_ASC : SORT_DESC), SORT_NUMERIC, $sizelist, $namelist);
				break;
		}
		$newlist = array();
		foreach ($namelist as $key => $value) {
			if ($key >= $start && $key < $start + $limit) {
				$newlist[] = array("filename" => $namelist[$key], 
					"mtime" => date("j.m.Y H:i:s", $mtimelist[$key]), 
					"size" => $sizelist[$key]);
			}
		}
		$result = array_merge($result, array("images" => $newlist, "totalCount" => sizeof($newlist)));
		break;
	case 'delete':
		$filename = processPostVariable('filename');
		if ($filename != "") {
			$filename = ROOT_DIR . "img/" . $filename;
			if (file_exists($filename)) {
				unlink($filename);
			} else {
				$result['success'] = false;	
			}
		} else {
			$result['success'] = false;	
		}
	default:
		$result['success'] = false;	
}

echo $json->encode($result);