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
		$section = processPostVariable('section');
		if ($section === "") {
			$success = false;
			$result['errors'][] = array("id" => "section", "msg" => "Нет данных");
		}
		//
		switch ($section) {
			case 'Главная': $section =9; break;
			case 'О компании': $section=10; break;
			case 'Полезная информация': $section=11; break;
			
			case 'Наши партнеры': $section=12; break;
			case 'Консультация онлайн': $section=13; break;
			case 'Отслеживание груза': $section=14; break;
			case 'Запчасти': $section=15; break;
			
			case 'Авто в наличии': $section=16; break;
			case 'Неаварийные авто': $section=17; break;
			case 'Аварийные авто': $section=18; break;
			case 'Торги online': $section=19; break;
			case 'Новые авто': $section=21; break;
			
			case 'Контакты': $section=24; break;
			case 'об авто из сша': $section=25; break;
			case 'об аукционах': $section=26; break;
			case 'типы повреждений': $section=27; break;
			case 'carfax autocheck': $section=28; break;
			case 'доставка - сроки': $section=29; break; 
			default: $success = false;
				$result['errors'][] = array("id" => "section", "msg" => "Неверый параметр"); 
		}
		//
		$title = processPostVariable('title');
		if ($title === "") {
			$success = false;
			$result['errors'][] = array("id" => "title", "msg" => "Нет данных");
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
			addArticle($title, $section, $date, $tags, $long);
		} else {
			editArticle($id, $section, $title, $date, $tags, $long);
		}
		break;
	case 'list': 
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
		$news = listArticlesAdmin($start, $limit, $sort, $sort_dir);
		$result = array_merge($result, $news);
		break;
	case 'edit': // Запрос одной публикации на изменение
		$id = processGetVariable('id');
		if ($id == "") {
			$result = array("id" => 0);
		} else {
			$result = getArticleAdmin($id);
		}
		break;
	case 'delete': // Удаление новости
		$id = processPostVariable('id');
		if ($id == "") {
			$result['success'] = false;
		} else {
			deleteArticle($id);
			$result['success'] = true;
		}
	default:
		$result['success'] = false;	
}

echo $json->encode($result);
