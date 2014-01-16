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
	case 'add': // Добавление или правка
		$success = true;
		
		$id = processPostVariable('id');
		if ($id == "") {
			$id = 0; // Если id = 0 добавление, иначе правка
		}
		//
		$category = processPostVariable('category');
		if ($category === "") {
			$success = false;
			$result['errors'][] = array("id" => "category", "msg" => "Нет данных");
		}
		$category = (int)$category;
		//
		$title = processPostVariable('title');
		if ($title === "") {
			$success = false;
			$result['errors'][] = array("id" => "title", "msg" => "Нет данных");
		}
		//
		$short = processPostVariable('short');
		if ($short === "") {
			$success = false;
			$result['errors'][] = array("id" => "short", "msg" => "Нет данных");
		}
		//
		$description = processPostVariable('description');
		if ($description === "") {
			$success = false;
			$result['errors'][] = array("id" => "description", "msg" => "Нет данных");
		}
		//
		if (!$success) {
			$result['success'] = false;
			break;
		}
		if ($id == 0) {
			//addArticle($title, $section, $date, $tags, $long);
		} else {
			editLibrary($id, $category, $title, $short, $description);
		}
		break;
	case 'list': // Получение списка книг
		$start = processPostVariable('start');
		if ($start == "") {
			$start = 0;
		}
		$limit = processPostVariable('limit');
		if ($limit == "") {
			$limit = 25;
		}
		$list = listLibraryAdmin($start, $limit, NULL, NULL);
		$result = array_merge($result, $list);
		break;
	case 'categories': // Получение списка категорий
		$result = array('categories' => listLibraryCategories());
		break;
	case 'edit': // Запрос одной книги на изменение
		$id = processGetVariable('id');
		if ($id == "") {
			$result = array("id" => 0);
		} else {
			$result = getLibraryAdmin($id);
			if ($result['cat'] == 0) {
				unset($result['category']);
				unset($result['cat']);
			}
			if ($result['title'] == '') {
				unset($result['title']);
			}
			if ($result['short'] == '') {
				unset($result['short']);
			}
		}
		break;
	case 'delete':
		$id = processPostVariable('id');
		$r = getLibraryAdmin($id);
		unlink(ROOT_DIR . "library/" . $r['filename']);
		deleteLibraryAdmin($id);
		break;		
	default:
		$result['success'] = false;
}

echo $json->encode($result);
