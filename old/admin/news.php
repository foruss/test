<?php
/**
 * @author Дикун Максим, 2007
 */
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
		$title = processPostVariable('title');
		if ($title === "") {
			$success = false;
			$result['errors'][] = array("id" => "title", "msg" => "Нет данных");
		}
		//
		$section = processPostVariable('section');
		if ($section === "") {
			$success = false;
			$result['errors'][] = array("id" => "section", "msg" => "Нет данных");
		}
		switch ($section) {
			case 'Новости': $section = 'news';
				break;
			case 'Пресса': $section = 'press';
				break;
			case 'Анекдот': $section = 'joke';
				break;
			default: $success = false;
				$result['errors'][] = array("id" => "section", "msg" => "Неверый параметр"); 
		}
		//
		$date = processPostVariable('date');
		if ($date === "") {
			$success = false;
			$result['errors'][] = array("id" => "date", "msg" => "Нет данных");
		}
		//
		$tags = processPostVariable('tags');
		if ($tags === "Список тегов, разделенных пробелами") {
			//Непонятный глюк: если поле не заполнить передается текст
			// 'Список тегов, разделенных пробелами'
			$tags = "";
		}
		//
		$short = processPostVariable('short');
		if ($short === "") {
			$success = false;
			$result['errors'][] = array("id" => "short", "msg" => "Нет данных");
		}
		//
		$long = processPostVariable('long');
		if ($long === "") {
			$success = false;
			$result['errors'][] = array("id" => "long", "msg" => "Нет данных");
		}
		//
		if (!$success) {
			$result['success'] = false;
			break;
		}
		// Преобразование параметров
		$tags = explode(" ", $tags);
		foreach ($tags as $key => $value) {
			if ($value == "") {
				unset($tags[$key]);
			}
		}
		$date = convertDateToMySQL($date);
		if ($id == 0) {
			$date = $date." ".date("h:i:s");
			addNews($title, $section, $date, $tags, $short, $long);
		} else {
			editNews($id, $section, $title, $date, $tags, $short, $long);
		}
		break;
	case 'list': //Получение списка новостей
		$start = processPostVariable('start');
		if ($start == "") {
			$start = 0;
		}
		$limit = processPostVariable('limit');
		if ($limit == "") {
			$limit = 25;
		}
		//
		$sort = processPostVariable('sort');
		//
		$sort_dir = processPostVariable('dir');
		//
		$news = listNewsAdmin($start, $limit, $sort, $sort_dir);
		$result = array_merge($result, $news);
		break;
	case 'edit': // Запрос одной новости на изменение
		$id = processGetVariable('id');
		if ($id == "") {
			$result = array("id" => 0);
		} else {
			$result = getNewsAdmin($id);
			//switch ($result['section']) {
			//	case 'market': $result['section'] = 'Новости рынка';
			//	case 'company': $result['section'] = 'Новости компаний';
			//}
		}
		break;
	case 'delete': // Удаление новости
		$id = processPostVariable('id');
		if ($id == "") {
			$result['success'] = false;
		} else {
			deleteNews($id);
			$result['success'] = true;
		}
	default:
		$result['success'] = false;
}

echo $json->encode($result);
