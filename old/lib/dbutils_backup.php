<?php
//require_once("../config.php");
require_once(LIB_DIR . "db.php");
require_once(LIB_DIR . "utils.php");

if( !function_exists( "bcdiv" ) )
{
    function bcdiv( $first, $second, $scale = 0 )
    {
        $res = $first / $second;
        return round( $res, $scale );
    }
}

function dblog ($who, $message) {
	$who = mysql_real_escape_string($who);
	$message = mysql_real_escape_string($message);
	sql_query("INSERT INTO `log`(`time`, `who`, `message`) VALUES (NOW(), '$who', '$message')");
}

/**
 * dd.mm.yyyy -> yyyy-mm-dd
 * 
 * @param $date string Дата для преобразования
 * 
 * @return string
 */
function convertDateToMySQL($date) {
	$res = preg_replace('/(\d{1,2})\.(\d{1,2})\.(19|20)(\d{2})/','\3\4-\2-\1', $date);
	return $res;
}

/**
 * Применяет mysql_real_escape_string к каждому элементу массива
 *
 * @param array $array
 * @return array
 */
function mysql_real_escape_array($array) {
	return array_map('mysql_real_escape_string', $array);
}

////////////////////////////////////////////////////////////////////////////////////////////
// Работа с новостями
////////////////////////////////////////////////////////////////////////////////////////////
function isPublicationURLExists($url) {
	$res = sql_query("SELECT count(*) AS c FROM publications WHERE titleurl = '$url'");
	$count = mysql_fetch_assoc($res);
	return ($count['c'] > 0);
}

function getNewPublicationURL($str) {
	$str = translitString($str);
	$addstring = "";
	$addcounter = 1;
	while (isPublicationURLExists($str . $addstring)) {
		++$addcounter;
		$addstring = "_".$addcounter;
	}
	return $str . $addstring;
}

function addNews($title, $section, $date, $tags, $shorttext, $longtext) {
	$titleurl = getNewPublicationURL($title); 
	$title = mysql_real_escape_string($title);
	$section = mysql_real_escape_string($section);
	$date = mysql_real_escape_string($date);
	$tags = mysql_real_escape_array($tags);
	$shorttext = mysql_real_escape_string($shorttext);
	$longtext = mysql_real_escape_string($longtext);
	//echo $longtext; die;
	sql_start_transaction();
	sql_query("INSERT INTO news(shorttext, section) VALUES('$shorttext', '$section')");
	$insertId = mysql_insert_id();
	/*sql_query("INSERT INTO publications(category, date, title, titleurl, text, connectid)
		VALUES (1, '$date', '$title', '$titleurl', '$longtext', '$insertId')");*/
	sql_query("INSERT INTO publications(category, date, title, titleurl, text, connectid)
		VALUES (1, '$date', '$title', '$titleurl', '$longtext', '$insertId')");
	$insertId = mysql_insert_id();
	addTags($tags, $insertId);
	sql_commit_transaction();
}

function addTags($tags, $publicationId) {
	// Сначала ассоциируем существующие
	$tagstr = "'" . implode("', '", $tags) . "'";
	$res = sql_query("SELECT id, tag FROM tags WHERE tag IN ($tagstr)");
	$oldtags = array();
	while($row = mysql_fetch_assoc($res)) {
		sql_query("INSERT INTO tags_in_publications(publicationid, tagid)
			VALUES ($publicationId, $row[id])");
		$oldtags[] = $row['tag'];
	}
	mysql_free_result($res);
	// Добавляем новые
	$newtags = array_diff($tags, $oldtags);
	foreach ($newtags as $tag) {
		sql_query("INSERT INTO tags(tag) VALUES('$tag')");
		$insertId = mysql_insert_id();
		sql_query("INSERT INTO tags_in_publications(publicationid, tagid)
			VALUES ($publicationId, $insertId)");
	}
}

function listNewsAdmin($start, $limit, $sort, $dir) {
	switch ($sort) {
		case 'title':
		case 'tags': $sort = "`$sort`";
			break;
		default: $sort = 'a.`date`';
	}
	switch ($dir) {
		case 'ASC':
		case 'DESC': break;
		default:
			if ($sort == 'a.`date`') {
				$dir = 'DESC';
			} else {
				$dir = 'ASC';
			}
	}
	$start = (int)$start;
	$limit = (int)$limit;

	$result = array();
	$res = sql_all("SELECT SQL_CALC_FOUND_ROWS a.`id`,
			DATE_FORMAT(a.`date`, '%d.%m.%Y') AS `date`, `title`,
			GROUP_CONCAT(c.`tag` ORDER BY c.`tag` ASC SEPARATOR ' ') AS tags
		FROM publications a
		LEFT JOIN tags_in_publications b ON a.`id` = b.`publicationid`
		LEFT JOIN tags c ON b.`tagid` = c.`id`
		WHERE a.`category` = 1
		GROUP BY a.`id`
		ORDER BY $sort $dir
		LIMIT $start, $limit");
	//$news = array();
//	$news = sql_all($res);
	/*while ($row = mysql_fetch_assoc($res)) {
		$row['author'] = 'DikMax';
		$news[] = $row;
	}*/
	//mysql_free_result($res);
	$count = sql_single_value("SELECT FOUND_ROWS() count");
	$result['totalCount'] = $count;
	$result['news'] = $res;
	return $result;
}

function listNewsUser($category, $page) {
	global $config;
	
	$page = (int)$page;
	if ($page < 1) {
		$page = 1;
	}
	$limit = $config['news']['itemsperpage']; 
	$start = ($page - 1) * $limit;
	if ($category != 'news' && $category != 'press') {
		$res = sql_all("SELECT SQL_CALC_FOUND_ROWS DATE_FORMAT(p.`date`, '%d.%m.%y') AS `date`,
				p.title, p.titleurl, n.`shorttext`
			FROM publications AS p
			LEFT JOIN news AS n ON p.connectid = n.id
			WHERE p.category = 1
			ORDER BY p.`date` DESC
			LIMIT $start, $limit");
	} else {
		$res = sql_all("SELECT SQL_CALC_FOUND_ROWS DATE_FORMAT(p.`date`, '%d.%m.%y') AS `date`,
				p.title, p.titleurl, n.`shorttext`
			FROM publications AS p
			LEFT JOIN news AS n ON p.connectid = n.id AND p.category = 1
			WHERE n.section = '$category'
			ORDER BY p.`date` DESC
			LIMIT $start, $limit");
	}
	$count = sql_single_value("SELECT FOUND_ROWS()");
	if ($count % $limit == 0) {
		$pages = $count / $limit;
	} else {
		$pages = $count / $limit + 1;
	}
	return array('data' => $res, 'count' => $count, 'pages' => $pages);
}

function listLastNews($limit) {
	global $config;
		$res = sql_all("SELECT SQL_CALC_FOUND_ROWS DATE_FORMAT(p.`date`, '%d.%m.%Y') AS `date`,
				p.title, p.titleurl, n.`shorttext`
			FROM publications AS p
			LEFT JOIN news AS n ON p.connectid = n.id AND p.category = 1
			WHERE n.section = 'news'
			ORDER BY p.`date` DESC
			LIMIT $limit");

	$count = sql_single_value("SELECT FOUND_ROWS()");

	return $res;
}

function listPressUser($category, $page) {
	global $config;
	
	$page = (int)$page;
	if ($page < 1) {
		$page = 1;
	}
	$limit = $config['news']['itemsperpage']; 
	$start = ($page - 1) * $limit;
	if ($category != 'market' && $category != 'company') {
		$res = sql_all("SELECT SQL_CALC_FOUND_ROWS DATE_FORMAT(p.`date`, '%d.%m.%Y') AS `date`,
				p.title, p.titleurl, n.`shorttext`
			FROM publications AS p
			LEFT JOIN news AS n ON p.connectid = n.id
			WHERE n.section = 'press'
			ORDER BY p.`date` DESC
			LIMIT $start, $limit");
	} else {
		$res = sql_all("SELECT SQL_CALC_FOUND_ROWS DATE_FORMAT(p.`date`, '%d.%m.%Y') AS `date`,
				p.title, p.titleurl, n.`shorttext`
			FROM publications AS p
			LEFT JOIN news AS n ON p.connectid = n.id AND p.category = 1
			WHERE n.section = '$category'
			ORDER BY p.`date` DESC
			LIMIT $start, $limit");
	}
	$count = sql_single_value("SELECT FOUND_ROWS()");
	if ($count % $limit == 0) {
		$pages = $count / $limit;
	} else {
		$pages = $count / $limit + 1;
	}
	return array('data' => $res, 'count' => $count, 'pages' => $pages);
}

function getNewsAdmin($id) {
	$id = (int)$id;
	$result = sql_one("SELECT p.id, p.`title`, n.section,
			DATE_FORMAT(p.`date`, '%d.%m.%Y') AS `date`,
			GROUP_CONCAT(t.tag ORDER BY t.tag ASC SEPARATOR ' ') AS tags, n.shorttext AS `short`,
			`text` AS `long`
		FROM publications AS p
		LEFT JOIN news AS n ON p.connectid = n.id
		LEFT JOIN tags_in_publications AS tp ON tp.publicationid = p.id
		LEFT JOIN tags AS t ON t.id = tp.tagid
		WHERE p.id = $id AND p.category = 1
		GROUP BY p.id");
	return $result;
}

function getNewsUser($titleurl) {
	$titleurl = mysql_real_escape_string($titleurl);
	$news = sql_one("SELECT p.id, n.section, p.`title`, DATE_FORMAT(p.`date`, '%d.%m.%Y') AS `date`,
			GROUP_CONCAT(t.tag ORDER BY t.tag ASC SEPARATOR ' ') AS tags, p.`text`
		FROM publications AS p
		LEFT JOIN news AS n ON p.connectid = n.id
		LEFT JOIN tags_in_publications AS tp ON tp.publicationid = p.id
		LEFT JOIN tags AS t ON t.id = tp.tagid
		WHERE p.titleurl = '$titleurl'
		GROUP BY p.id");
	return $news;
}

function getLastNewsUser() {
	$news = sql_one("SELECT p.id, p.`title`, p.`titleurl`, DATE_FORMAT(p.`date`, '%d.%m.%Y') AS `date`,
			n.`shorttext`
		FROM publications AS p
		LEFT JOIN news AS n ON p.connectid = n.id
		WHERE p.category = 1
		ORDER BY p.`date` DESC
		LIMIT 1");
	return $news;
}

function getRelatedNewsUser($id) {
	$id = (int)$id;
	$related = sql_all("SELECT p2.title, p2.titleurl, DATE_FORMAT(p2.`date`, '%d.%m.%Y') AS `date`
		FROM publications AS p
		LEFT JOIN tags_in_publications AS tp ON tp.publicationid = p.id
		LEFT JOIN tags AS t ON t.id = tp.tagid
		LEFT JOIN tags_in_publications AS tp2 ON t.id = tp2.tagid AND tp.publicationid != tp2.publicationid
		RIGHT JOIN publications AS p2 ON tp2.publicationid = p2.id
		WHERE p.id = $id
		GROUP BY p2.id
		ORDER BY p2.`date` DESC
		LIMIT 5");
	return $related;
}

function editNews($id, $section, $title, $date, $tags, $shorttext, $longtext) {
	$id = (int)$id;
	$unescapedtitle = $title;
	$title = mysql_real_escape_string($title);
	$section = mysql_real_escape_string($section);
	$date = mysql_real_escape_string($date);
	$tags = mysql_real_escape_array($tags);
	$shorttext = mysql_real_escape_string($shorttext);
	$longtext = mysql_real_escape_string($longtext);
	//Если заголовок не менялся то оставляем старый titleurl
	$res = sql_query("SELECT titleurl FROM publications WHERE id = '$id' AND title = '$title'");
	if (mysql_num_rows($res) > 0) {
		$row = mysql_fetch_assoc($res);
		$titleurl = $row['titleurl'];
	} else {
		$titleurl = getNewPublicationURL($unescapedtitle);
	}
	mysql_free_result($res);
	sql_start_transaction();
	// TODO придумать приличный алгоритм для изменения новости без удаления тегов каждый раз
	//Удаляем старые теги
	sql_query("DELETE FROM tags_in_publications WHERE publicationid = '$id'");
	//Меняем короткий текст
	sql_query("UPDATE news SET shorttext = '$shorttext', section = '$section'
		WHERE id IN (SELECT connectid FROM publications WHERE id = '$id' AND category = 1)");
	// Меняем публикацию
/*	sql_query("UPDATE publications SET date = '$date', title = '$title', titleurl = '$titleurl',
			text = '$longtext'
		WHERE id = '$id'");*/
	sql_query("UPDATE publications SET date = '$date', title = '$title', titleurl = '$titleurl',
			text = '$longtext'
		WHERE id = '$id'");
	//Добавляем новые теги
	addTags($tags, $id);
	sql_commit_transaction();
}

function deleteNews($id) {
	$id = (int)$id;
	sql_start_transaction();
	sql_query("DELETE FROM news
		WHERE id = (SELECT connectid FROM publications WHERE id = $id AND category = 1)");
	sql_query("DELETE FROM tags_in_publications
		WHERE publicationid =
			(SELECT connectid FROM publications WHERE id = $id AND category = 1)");
	sql_query("DELETE FROM publications WHERE id = $id");
	sql_commit_transaction();
}

function deleteCarsPovtAdd($id) {
$id = (int)$id;
sql_query("DELETE FROM autocat WHERE auto_id = $id");
}

function delAllOfUser($id) {
	$id = (int)$id;
	sql_query("DELETE FROM `users`
		WHERE `id` = '$id'");
	sql_query("DELETE FROM `auto`
		WHERE `userid` = '$id'");
	sql_query("DELETE FROM `boat`
		WHERE `uid` = '$id'");
		sql_query("DELETE FROM `moto`
		WHERE `uid` = '$id'");
		sql_query("DELETE FROM `machinery`
		WHERE `uid` = '$id'");
		sql_query("DELETE FROM `plane`
		WHERE `uid` = '$id'");
		sql_query("DELETE FROM `spares`
		WHERE `uid` = '$id'");
}
///////////////////////////////////////////////////////////////////////////////////////////
// Работа с каталогом
///////////////////////////////////////////////////////////////////////////////////////////

function listCatalogAdmin($start, $limit, $sort, $dir) {
	$start = (int)$start;
	$limit = (int)$limit;
	$rows = sql_all("SELECT SQL_CALC_FOUND_ROWS `id`, DATE_FORMAT(`add_date`, '%d.%m.%Y') AS `date`,
			`company_name` AS `company`, `company_name`,
			IF(`company_logo` IS NULL OR `company_logo` = '', 0, 1) AS `company_logo`, `company_about`,
			`number_of_employees`, `code_okpo`, `directors_name`, `site`, `email`, `region`,
			`city`, `index`, `legal_address`, `actual_address`, `directorate`,
			`supply_department`, `marketing_department`, `sales_department`,
			`accounting_department`, `legal_department`, `engineering_department`,
			`production`, `state`
		FROM `catalog`
		LIMIT $start, $limit");
	$count = sql_single_value("SELECT FOUND_ROWS() count");
	$result = array('totalCount' => $count, 'catalog' => $rows);
	return $result;	
}

function changeStateCatalogAdmin($id, $state) {
	$id = (int)$id;
	$state = mysql_real_escape_string($state);
	sql_query("UPDATE catalog SET state = '$state', approve_date = NOW()
		WHERE id = $id");
}

function addCatalogData ($country, $category, $category2, $category3, $company_name, $company_logo, $company_about, 
		$number_of_employees, $code_okpo, $directors_name, $site, $email, $region, $city, $index,
		$legal_address, $actual_address, $directorate, $supply_department, $marketing_department,
		$sales_department, $accounting_department, $legal_department, $engineering_department,
		$production, $files, $user) {
			
	$country = (int)$country;
	$category = (int)$category;

	$category2 = (int)$category2;

	$category3 = (int)$category3;
	$company_name = mysql_real_escape_string($company_name);
	$company_logo = mysql_real_escape_string($company_logo);
	$company_about = mysql_real_escape_string($company_about);
	$number_of_employees = (int)$number_of_employees;
	$code_okpo = mysql_real_escape_string($code_okpo);
	$directors_name = mysql_real_escape_string($directors_name);
	$site = mysql_real_escape_string($site);
	$email = mysql_real_escape_string($email);
	$region = mysql_real_escape_string($region);
	$city = mysql_real_escape_string($city);
	$index = mysql_real_escape_string($index);
	$legal_address = mysql_real_escape_string($legal_address);
	$actual_address = mysql_real_escape_string($actual_address);
	$directorate = mysql_real_escape_string($directorate);
	$supply_department = mysql_real_escape_string($supply_department);
	$marketing_department = mysql_real_escape_string($marketing_department);
	$sales_department = mysql_real_escape_string($sales_department);
	$accounting_department = mysql_real_escape_string($accounting_department);
	$legal_department = mysql_real_escape_string($legal_department);
	$engineering_department = mysql_real_escape_string($engineering_department);
	$production = mysql_real_escape_string($production);

	$file1 = mysql_real_escape_string($files[1]["content"]);

	$file1desc = mysql_real_escape_string($files[1]["desc"]);
	$file2 = mysql_real_escape_string($files[2]["content"]);

	$file2desc = mysql_real_escape_string($files[2]["desc"]);

	$file3 = mysql_real_escape_string($files[3]["content"]);

	$file3desc = mysql_real_escape_string($files[3]["desc"]);

	$file4 = mysql_real_escape_string($files[4]["content"]);

	$file4desc = mysql_real_escape_string($files[4]["desc"]);

	$file5 = mysql_real_escape_string($files[5]["content"]);

	$file5desc = mysql_real_escape_string($files[5]["desc"]);

	$file6 = mysql_real_escape_string($files[6]["content"]);

	$file6desc = mysql_real_escape_string($files[6]["desc"]);

	$file7 = mysql_real_escape_string($files[7]["content"]);

	$file7desc = mysql_real_escape_string($files[7]["desc"]);

	$file8 = mysql_real_escape_string($files[8]["content"]);

	$file8desc = mysql_real_escape_string($files[8]["desc"]);

	$file9 = mysql_real_escape_string($files[9]["content"]);

	$file9desc = mysql_real_escape_string($files[9]["desc"]);

	$file10 = mysql_real_escape_string($files[10]["content"]);

	$file10desc = mysql_real_escape_string($files[10]["desc"]);

	$user = (int)$user;
	
	sql_query("INSERT INTO catalog (`country`, `category`, `category2`, `category3`, `company_name`, `company_logo`,
		`company_about`, `number_of_employees`, `code_okpo`, `directors_name`, `site`,
		`email`, `region`, `city`, `index`, `legal_address`, `actual_address`, `directorate`,
		`supply_department`, `marketing_department`, `sales_department`, `accounting_department`,
		`legal_department`, `engineering_department`, `production`, `add_date`,

		`file1`, `file1desc`, 

		`file2`, `file2desc`, 

		`file3`, `file3desc`, 

		`file4`, `file4desc`, 

		`file5`, `file5desc`, 

		`file6`, `file6desc`, 

		`file7`, `file7desc`, 

		`file8`, `file8desc`, 

		`file9`, `file9desc`, 

		`file10`, `file10desc`, 

		`user`)
	VALUES ('$country', '$category', '$category2', '$category3', '$company_name', '$company_logo', 
		'$company_about', '$number_of_employees', '$code_okpo', '$directors_name', '$site',
		'$email', '$region', '$city', '$index', '$legal_address', '$actual_address', '$directorate',
		'$supply_department', '$marketing_department', '$sales_department', '$accounting_department',
		'$legal_department', '$engineering_department', '$production', NOW(),

		'$file1', '$file1desc', 

		'$file2', '$file2desc', 

		'$file3', '$file3desc', 

		'$file4', '$file4desc', 

		'$file5', '$file5desc', 

		'$file6', '$file6desc', 

		'$file7', '$file7desc', 

		'$file8', '$file8desc', 

		'$file9', '$file9desc', 

		'$file10', '$file10desc', 

		$user)");
}

function editCatalogData ($id, $country, $category, $category2, $category3, $company_name, $company_logo, $company_about, 
		$number_of_employees, $code_okpo, $directors_name, $site, $email, $region, $city, $index,
		$legal_address, $actual_address, $directorate, $supply_department, $marketing_department,
		$sales_department, $accounting_department, $legal_department, $engineering_department,
		$production, $files, $user) {
	$id = (int)$id;
	$country = (int)$country;
	$category = (int)$category;

	$category2 = (int)$category2;

	$category3 = (int)$category3;
	$company_name = mysql_real_escape_string($company_name);
	$company_logo = mysql_real_escape_string($company_logo);
	$company_about = mysql_real_escape_string($company_about);
	$number_of_employees = (int)$number_of_employees;
	$code_okpo = mysql_real_escape_string($code_okpo);
	$directors_name = mysql_real_escape_string($directors_name);
	$site = mysql_real_escape_string($site);
	$email = mysql_real_escape_string($email);
	$region = mysql_real_escape_string($region);
	$city = mysql_real_escape_string($city);
	$index = mysql_real_escape_string($index);
	$legal_address = mysql_real_escape_string($legal_address);
	$actual_address = mysql_real_escape_string($actual_address);
	$directorate = mysql_real_escape_string($directorate);
	$supply_department = mysql_real_escape_string($supply_department);
	$marketing_department = mysql_real_escape_string($marketing_department);
	$sales_department = mysql_real_escape_string($sales_department);
	$accounting_department = mysql_real_escape_string($accounting_department);
	$legal_department = mysql_real_escape_string($legal_department);
	$engineering_department = mysql_real_escape_string($engineering_department);
	$production = mysql_real_escape_string($production);
	$file1 = mysql_real_escape_string($files[1]["content"]);

	$file1desc = mysql_real_escape_string($files[1]["desc"]);

	$file2 = mysql_real_escape_string($files[2]["content"]);

	$file2desc = mysql_real_escape_string($files[2]["desc"]);

	$file3 = mysql_real_escape_string($files[3]["content"]);

	$file3desc = mysql_real_escape_string($files[3]["desc"]);

	$file4 = mysql_real_escape_string($files[4]["content"]);

	$file4desc = mysql_real_escape_string($files[4]["desc"]);

	$file5 = mysql_real_escape_string($files[5]["content"]);

	$file5desc = mysql_real_escape_string($files[5]["desc"]);

	$file6 = mysql_real_escape_string($files[6]["content"]);

	$file6desc = mysql_real_escape_string($files[6]["desc"]);

	$file7 = mysql_real_escape_string($files[7]["content"]);

	$file7desc = mysql_real_escape_string($files[7]["desc"]);

	$file8 = mysql_real_escape_string($files[8]["content"]);

	$file8desc = mysql_real_escape_string($files[8]["desc"]);

	$file9 = mysql_real_escape_string($files[9]["content"]);

	$file9desc = mysql_real_escape_string($files[9]["desc"]);

	$file10 = mysql_real_escape_string($files[10]["content"]);

	$file10desc = mysql_real_escape_string($files[10]["desc"]);

	$user = (int)$user;


$cl = "";
if ($company_logo != "") {
	$cl .= "`company_logo` = '$company_logo', ";
}

if ($file1desc != "") {

	$cl .= "`file1` = '$file1', `file1desc` = '$file1desc', ";

}
if ($file2desc != "") {

	$cl .= "`file2` = '$file2', `file2desc` = '$file2desc', ";

}

if ($file3desc != "") {

	$cl .= "`file3` = '$file3', `file3desc` = '$file3desc', ";

}

if ($file4desc != "") {

	$cl .= "`file4` = '$file4', `file4desc` = '$file4desc', ";

}

if ($file5desc != "") {

	$cl .= "`file5` = '$file5', `file5desc` = '$file5desc', ";

}

if ($file6desc != "") {

	$cl .= "`file6` = '$file6', `file6desc` = '$file6desc', ";

}

if ($file7desc != "") {

	$cl .= "`file7` = '$file7', `file7desc` = '$file7desc', ";

}

if ($file8desc != "") {

	$cl .= "`file8` = '$file8', `file8desc` = '$file8desc', ";

}

if ($file9desc != "") {

	$cl .= "`file9` = '$file9', `file9desc` = '$file9desc', ";

}

if ($file10desc != "") {

	$cl .= "`file10` = '$file10', `file10desc` = '$file10desc', ";

}


sql_query("UPDATE catalog SET
`country`= '$country',
`category`= '$category',
`category2`= '$category2',

`category3`= '$category3',

`company_name` = '$company_name',
$cl
`company_about`= '$company_about',
`number_of_employees` = '$number_of_employees',
`code_okpo` = '$code_okpo',
`directors_name` = '$directors_name',
`site` = '$site',
`email` = '$email',
`region` = '$region',
`city` = '$city',
`index` = '$index',
`legal_address` = '$legal_address',
`actual_address` = '$actual_address',
`directorate` = '$directorate',
`supply_department` = '$supply_department',
`marketing_department` = '$marketing_department',
`sales_department` = '$sales_department',
`accounting_department` = '$accounting_department',
`legal_department` = '$legal_department',
`engineering_department` = '$engineering_department', 
`production` = '$production',
`state` = 'waiting' WHERE id = $id AND user = $user");
}

function getCatalogLogo($id) {
	$id = (int)$id;
	return sql_single_value("SELECT company_logo FROM catalog WHERE id = $id");
}


function showCatalogFile($id,$file) {

	$id = (int)$id;

	$file = (int)$file;

	$f = sql_one("SELECT `file".$file."` AS f, `file".$file."desc` AS fd FROM catalog WHERE id = $id");

	header("Content-Type: application/octet-stream");

	header('Content-Disposition: attachment; filename="'.$f['fd'].'"');

	echo $f['f'];

}


function getCompanyVoteData($id) {
	$id = (int)$id;
	return sql_one("SELECT id, company_name, IF(`company_logo` IS NULL OR `company_logo` = '', 0, 1) AS `company_logo`
		FROM catalog
		WHERE id = $id AND state = 'approved'");
}

function getCompanyUser($id) {
	$id = (int)$id;
	return sql_one("SELECT `id`, `country`, DATE_FORMAT(`add_date`, '%d.%m.%Y') AS `date`,
			`company_name` AS `company`, `company_name`,
			IF(`company_logo` IS NULL OR `company_logo` = '', 0, 1) AS `company_logo`, `company_about`,
			`number_of_employees`, `code_okpo`, `directors_name`, `site`, `email`, `region`,
			`city`, `index`, `legal_address`, `actual_address`, `directorate`,
			`supply_department`, `marketing_department`, `sales_department`,
			`accounting_department`, `legal_department`, `engineering_department`, `production`, 
			`sum_of_marks`, `votes_count`, `mark1`, `mark2`, `mark3`, `mark4`, `mark5`, `file1desc`,

			`file2desc`,

			`file3desc`,

			`file4desc`,

			`file5desc`,

			`file6desc`,

			`file7desc`,

			`file8desc`,

			`file9desc`,

			`file10desc`
		FROM `catalog`
		WHERE id=$id AND state = 'approved'");
}

function getCompanyEditUser($id) {
	$id = (int)$id;
	return sql_one("SELECT `id`, `country`, DATE_FORMAT(`add_date`, '%d.%m.%Y') AS `date`,
			`company_name` AS `company`, `company_name`, `category`, `category2`, `category3`,
			IF(`company_logo` IS NULL OR `company_logo` = '', 0, 1) AS `company_logo`, `company_about`,
			`number_of_employees`, `code_okpo`, `directors_name`, `site`, `email`, `region`,
			`city`, `index`, `legal_address`, `actual_address`, `directorate`,
			`supply_department`, `marketing_department`, `sales_department`,
			`accounting_department`, `legal_department`, `engineering_department`,
			`production`
		FROM `catalog`
		WHERE id=$id");
}

function getBestCompanyMain() {
	return sql_one("SELECT `id`, `country`, DATE_FORMAT(`add_date`, '%d.%m.%Y') AS `date`,
			`company_name` AS `company`, `company_name`,
			IF(`company_logo` IS NULL OR `company_logo` = '', 0, 1) AS `company_logo`, `company_about`,
			`number_of_employees`, `code_okpo`, `directors_name`, `site`, `email`, `region`,
			`city`, `index`, `legal_address`, `actual_address`, `directorate`,
			`supply_department`, `marketing_department`, `sales_department`,
			`accounting_department`, `legal_department`, `engineering_department`,
			`production`, IFNULL(sum_of_marks,0) AS average_mark
		FROM `catalog`
		WHERE state = 'approved'
		ORDER BY average_mark DESC
		LIMIT 1");
}

function getCatalogCategories($country = null) {
	if ($country == null) {
		return sql_all("SELECT id, category FROM catalog_categories");
	} else {
		$country = (int)$country;
		return sql_all("SELECT a.id, a.category, count(b.id) AS `count`
			FROM catalog_categories AS a
			LEFT JOIN catalog AS b

				ON (b.category = a.id OR b.category2 = a.id OR b.category3 = a.id) AND country = $country AND b.`state` = 'approved'
			GROUP BY a.id");
	}
}
function getSitesCategories() {
		return sql_all("SELECT id, title
			FROM sites_categories
			GROUP BY id");
}
function getCatalogCategory($id) {
	$id = (int)$id;
	return sql_single_value("SELECT category FROM catalog_categories WHERE id = $id");
}

function listRatingCompanyUser($page, $user) {
	global $config;
	
	$page = (int)$page;
	if ($page < 1) {
		$page = 1;
	}
	$limit = $config['rating']['itemsperpage']; 
	$start = ($page - 1) * $limit;
	
	$res = sql_all("SELECT SQL_CALC_FOUND_ROWS id, company_name, 
			IFNULL(sum_of_marks,0) AS average_mark, votes_count
		FROM `catalog`
		WHERE state = 'approved'
		ORDER BY average_mark DESC 
		LIMIT $start, $limit");
	$count = sql_single_value("SELECT FOUND_ROWS()");
	if ($count % $limit == 0) {
		$pages = $count / $limit;
	} else {
		$pages = $count / $limit + 1;
	}
	return array('data' => $res, 'count' => $count, 'pages' => $pages);
}

function listRatingCompanyMain() {
	return sql_all("SELECT id, company_name, 
			IFNULL(sum_of_marks,0) AS average_mark, votes_count
		FROM `catalog`
		WHERE state = 'approved'
		ORDER BY average_mark DESC 
		LIMIT 10");
}
function listRatingSiteUser($page) {
	global $config;
	
	$page = (int)$page;
	if ($page < 1) {
		$page = 1;
	}
	$limit = $config['rating']['itemsperpage']; 
	$start = ($page - 1) * $limit;
	
	$res = sql_all("SELECT SQL_CALC_FOUND_ROWS id, url, title, mark1 + mark2 + mark3 + mark4 + mark5 AS rating, votes_count
		FROM `sites`

		WHERE `state` = 'approved'
		ORDER BY rating DESC 
		LIMIT $start, $limit");
	$count = sql_single_value("SELECT FOUND_ROWS()");
	if ($count % $limit == 0) {
		$pages = $count / $limit;
	} else {
		$pages = $count / $limit + 1;
	}
	return array('data' => $res, 'count' => $count, 'pages' => $pages);
}

function listRatingSiteMain() {
	return sql_all("SELECT id, title, url,
			mark1 + mark2 + mark3 + mark4 + mark5 AS average_mark, votes_count AS votes_count
		FROM `sites`

		WHERE `state` = 'approved'
		ORDER BY average_mark DESC 
		LIMIT 10");
}

function updateCompanyRating($id, $sum, $mark1, $mark2, $mark3, $mark4, $mark5, $user) {
	$id = (int)$id;
	$sum = (int)$sum;
	$mark1 = (int)$mark1;
	$mark2 = (int)$mark2;
	$mark3 = (int)$mark3;
	$mark4 = (int)$mark4;
	$mark5 = (int)$mark5;
	$user = (int)$user;
	sql_start_transaction();
	sql_query("UPDATE catalog SET sum_of_marks = sum_of_marks + $sum, mark1 = mark1 + $mark1,
		mark2 = mark2 + $mark2, mark3 = mark3 + $mark3, mark4 = mark4 + $mark4, mark5 = mark5 + $mark5,
		votes_count = votes_count + 1
		WHERE id = $id");
	sql_query("UPDATE users SET lastvote = NOW() WHERE forumid = $user");
	sql_commit_transaction();
}

function updateSiteRating($id, $mark1, $mark2, $mark3, $mark4, $mark5, $user) {
	$id = (int)$id;
	$mark1 = (int)$mark1;
	$mark2 = (int)$mark2;
	$mark3 = (int)$mark3;
	$mark4 = (int)$mark4;
	$mark5 = (int)$mark5;

	$user = (int)$user;
	sql_start_transaction();
	sql_query("UPDATE sites SET mark1 = mark1 + $mark1, mark2 = mark2 + $mark2, mark3 = mark3 + $mark3,
		mark4 = mark4 + $mark4, mark5 = mark5 + $mark5, votes_count = votes_count + 1
		WHERE id = $id AND `state` = 'approved'");

	sql_query("UPDATE users SET lastvotesite = NOW() WHERE forumid = $user");

	sql_commit_transaction();
}

function listCatalogUser($country, $category, $page) {
	global $config;
	
	if ($country == "by") {
		$countryn = 1;
	} else {
		$countryn = 2;
	}
	$category = (int)$category;
	
	$page = (int)$page;
	if ($page < 1) {
		$page = 1;
	}
	$limit = $config['catalog']['itemsperpage']; 
	$start = ($page - 1) * $limit;
	
	$res = sql_all("SELECT SQL_CALC_FOUND_ROWS id, company_name, company_about, site
		FROM catalog
		WHERE state = 'approved' AND country = $countryn AND

			(category = $category OR category2 = $category OR category3 = $category)
		ORDER BY company_name ASC 
		LIMIT $start, $limit");
	$count = sql_single_value("SELECT FOUND_ROWS()");
	if ($count % $limit == 0) {
		$pages = $count / $limit;
	} else {
		$pages = $count / $limit + 1;
	}
	return array('data' => $res, 'count' => $count, 'pages' => $pages);
}

function getUserCatalogCount($user) {
	$user = (int)$user;
	return sql_single_value("SELECT count(*)
		FROM catalog
		WHERE user = $user");
}


function getUserCatalogId($user) {

	$user = (int)$user;

	return sql_single_value("SELECT id

		FROM catalog

		WHERE user = $user");

}


function getUserCatalog($user) {
	$user = (int)$user;
	return sql_all("SELECT `id`, `country`, DATE_FORMAT(`add_date`, '%d.%m.%Y') AS `date`,
			`company_name` AS `company`, `company_name`,
			IF(`company_logo` IS NULL OR `company_logo` = '', 0, 1) AS `company_logo`, `company_about`,
			`number_of_employees`, `code_okpo`, `directors_name`, `site`, `email`, `region`,
			`city`, `index`, `legal_address`, `actual_address`, `directorate`,
			`supply_department`, `marketing_department`, `sales_department`,
			`accounting_department`, `legal_department`, `engineering_department`,
			`production`, IFNULL(sum_of_marks,0) AS average_mark
		FROM catalog
		WHERE user = $user");
}

function deleteUserCatalog($user, $id) {
	$user = (int)$user;
	$id = (int)$id;
	sql_query("DELETE FROM catalog WHERE user = $user AND id = $id LIMIT 1");
}

function deleteCatalogAdmin($id) {
	$id = (int)$id;
	sql_query("DELETE FROM catalog WHERE id = $id LIMIT 1");
}

///////////////////////////////////////////////////////////////////////////////////////////
// Работа с сайтами
///////////////////////////////////////////////////////////////////////////////////////////

function getUserSitesCount($user) {
	$user = (int)$user;
	return sql_single_value("SELECT count(*)
		FROM sites
		WHERE user = $user");
}

function addSiteUser($category, $category2, $category3, $url, $title, $description, $user) {

	$category = (int)$category;

	$category2 = (int)$category2;

	$category3 = (int)$category3;
	$url = mysql_real_escape_string($url);
	$title = mysql_real_escape_string($title);
	$description = mysql_real_escape_string($description);
	$user = (int)$user;
	sql_query("INSERT INTO sites(category, category2, category3, url, title, description, user) 
		VALUES('$category', '$category2', '$category3', '$url', '$title', '$description', $user)");
}

function editSiteUser($id, $category, $category2, $category3, $url, $title, $description, $user) {
	$id = (int)$id;

	$category = (int)$category;

	$category2 = (int)$category2;

	$category3 = (int)$category3;
	$url = mysql_real_escape_string($url);
	$title = mysql_real_escape_string($title);
	$description = mysql_real_escape_string($description);
	$user = (int)$user;
	sql_query("UPDATE sites SET category = '$category', category2 = '$category2', category3 = '$category3', 

			url = '$url', title = '$title', description = '$description'
		WHERE id = $id AND user = $user");
}

function getUserSites($user) {
	$user = (int)$user;
	return sql_all("SELECT id, url, title, description
		FROM sites
		WHERE user = $user");
}

function deleteUserSite($user, $id) {
	$user = (int)$user;
	$id = (int)$id;
	sql_query("DELETE FROM sites WHERE user = $user AND id = $id LIMIT 1");
}

function getUserSite($user, $id) {
	$user = (int)$user;
	$id = (int)$id;
	return sql_one("SELECT id, category, category2, category3, url, title, description
		FROM sites
		WHERE user = $user AND id = $id");
}

function getSite($id) {
	$id = (int)$id;
	return sql_one("SELECT id, url, title, description, mark1, mark2, mark3, mark4, mark5,
		mark1 + mark2 + mark3 + mark4 + mark5 as rating, votes_count
		FROM sites
		WHERE id = $id AND `state` = 'approved'");
}



function getSiteCategories() {
	return sql_all("SELECT c.id, c.title, count(s.id) AS `count`
		FROM sites_categories AS c
		LEFT JOIN sites AS s ON (s.category = c.id OR s.category2 = c.id OR s.category3 = c.id) AND s.`state` = 'approved'
		GROUP BY c.id
		");

}



function getSiteCategory($id) {
	$id = (int)$id;
	return sql_single_value("SELECT title FROM sites_categories WHERE id = $id");	
}



function listSiteUser($category, $page) {
	global $config;
	
	$category = (int)$category;
	
	$page = (int)$page;
	if ($page < 1) {
		$page = 1;
	}

	$limit = $config['catalog']['itemsperpage']; 
	$start = ($page - 1) * $limit;
	
	$res = sql_all("SELECT SQL_CALC_FOUND_ROWS id, url, title, description
		FROM sites
		WHERE (category = $category OR category2 = $category OR category3 = $category) AND `state` = 'approved'
		ORDER BY title ASC 
		LIMIT $start, $limit");
	$count = sql_single_value("SELECT FOUND_ROWS()");
	if ($count % $limit == 0) {
		$pages = $count / $limit;
	} else {
		$pages = $count / $limit + 1;
	}
	return array('data' => $res, 'count' => $count, 'pages' => $pages);
}

function listSiteAdmin($start, $limit, $sort, $dir) {

	$start = (int)$start;

	$limit = (int)$limit;

	$rows = sql_all("SELECT SQL_CALC_FOUND_ROWS `id`, `title`,

			`url`, `state`

		FROM `sites`

		LIMIT $start, $limit");

	$count = sql_single_value("SELECT FOUND_ROWS() count");

	$result = array('totalCount' => $count, 'site' => $rows);

	return $result;	

}


function listsastSite($limit) {
	$limit = (int)$limit;
	return sql_all("SELECT `id`, `title`,`url`, `description`, `state`
		FROM `sites`
		WHERE `state` = 'approved'
		ORDER BY id DESC
		LIMIT $limit");
	//$count = sql_single_value("SELECT FOUND_ROWS() count");
	//$result = array('totalCount' => $count, 'site' => $rows);
	//$result = array('site' => $rows);
	//return $result;	
}


function changeStateSiteAdmin($id, $state) {

	$id = (int)$id;

	$state = mysql_real_escape_string($state);

	sql_query("UPDATE sites SET state = '$state', approve_date = NOW()

		WHERE id = $id");

}



function deleteSiteAdmin($id) {

	$id = (int)$id;

	sql_query("DELETE FROM sites WHERE id = $id LIMIT 1");

}


///////////////////////////////////////////////////////////////////////////////////////////
// Работа со статьями (публикациями)
///////////////////////////////////////////////////////////////////////////////////////////

function listArticlesAdmin($start, $limit, $sort, $dir) {
	switch ($sort) {
		case 'title':
		case 'tags': $sort = "`$sort`";
			break;
		default: $sort = 'a.`date`';
	}
	switch ($dir) {
		case 'ASC':
		case 'DESC': break;
		default:
			if ($sort == 'a.`date`') {
				$dir = 'DESC';
			} else {
				$dir = 'ASC';
			}
	}
	$start = (int)$start;
	$limit = (int)$limit;

	$result = array();
	$res = sql_query("SELECT SQL_CALC_FOUND_ROWS a.`id`, a.`category`,
			DATE_FORMAT(a.`date`, '%d.%m.%Y') AS `date`, `title`,
			GROUP_CONCAT(c.`tag` ORDER BY c.`tag` ASC SEPARATOR ' ') AS tags
		FROM publications a
		LEFT JOIN tags_in_publications b ON a.`id` = b.`publicationid`
		LEFT JOIN tags c ON b.`tagid` = c.`id`
		WHERE a.`category` != 1
		GROUP BY a.`id`
		ORDER BY $sort $dir
		LIMIT $start, $limit");
	$news = array();
	while ($row = mysql_fetch_assoc($res)) {
		$row['author'] = 'DikMax';
		$news[] = $row;
	}
	mysql_free_result($res);
	$count = sql_single_value("SELECT FOUND_ROWS() count");
	$result['totalCount'] = $count;
	$result['articles'] = $news;
	return $result;
}

function listArticlesUser($cat, $page) {
	global $config;
	
	$cat = (int)$cat;
	$page = (int)$page;
	if ($page < 1) {
		$page = 1;
	}
	$limit = $config['tender']['itemsperpage']; 
	$start = ($page - 1) * $limit;
	
	$res = sql_all("SELECT SQL_CALC_FOUND_ROWS id, DATE_FORMAT(p.`date`, '%d.%m.%Y') AS `date`, 
			p.title, p.titleurl
		FROM publications AS p
		WHERE p.category = $cat
		ORDER BY p.date DESC
		LIMIT $start, $limit");
	$count = sql_single_value("SELECT FOUND_ROWS()");
	if ($count % $limit == 0) {
		$pages = $count / $limit;
	} else {
		$pages = $count / $limit + 1;
	}
	return array('data' => $res, 'count' => $count, 'pages' => $pages);
	
}

function listArticlesMainUser($cat) {
	$cat = (int)$cat;
	$res = sql_all("SELECT SQL_CALC_FOUND_ROWS id, DATE_FORMAT(p.`date`, '%d.%m.%Y') AS `date`, DATE_FORMAT(p.`date`, '%H:%i') AS `time`, UNIX_TIMESTAMP(p.`date`) AS `unix`,
	p.title, p.titleurl
	FROM publications AS p 
	WHERE p.category = $cat
	ORDER BY p.date DESC
	LIMIT 13");
	return $res;
	
}

function addArticle($title, $section, $date, $tags, $longtext) {
	$titleurl = getNewPublicationURL($title); 
	$title = mysql_real_escape_string($title);
	$section = (int)$section;
	$date = mysql_real_escape_string($date);
	$tags = mysql_real_escape_array($tags);
	$longtext = mysql_real_escape_string($longtext);
	sql_start_transaction();
	sql_query("INSERT INTO publications(category, date, title, titleurl, text, connectid)
		VALUES ($section, '$date', '$title', '$titleurl', '$longtext', '0')");
	$insertId = mysql_insert_id();
	addTags($tags, $insertId);
	sql_commit_transaction();
}

function getArticleAdmin($id) {
	$id = (int)$id;
	$result = sql_one("SELECT p.id, p.`title`, p.category AS `section`,
			DATE_FORMAT(p.`date`, '%d.%m.%Y') AS `date`,
			GROUP_CONCAT(t.tag ORDER BY t.tag ASC SEPARATOR ' ') AS tags,
			`text` AS `long`
		FROM publications AS p
		LEFT JOIN tags_in_publications AS tp ON tp.publicationid = p.id
		LEFT JOIN tags AS t ON t.id = tp.tagid
		WHERE p.id = $id AND p.category != 1
		GROUP BY p.id");
	return $result;
}

function editArticle($id, $section, $title, $date, $tags, $longtext) {
	$id = (int)$id;
	$unescapedtitle = $title;
	$title = mysql_real_escape_string($title);
	$section = (int)$section;
	$date = mysql_real_escape_string($date);
	$tags = mysql_real_escape_array($tags);
	$longtext = mysql_real_escape_string($longtext);
	//Если заголовок не менялся то оставляем старый titleurl
	$res = sql_query("SELECT titleurl FROM publications WHERE id = '$id' AND title = '$title'");
	if (mysql_num_rows($res) > 0) {
		$row = mysql_fetch_assoc($res);
		$titleurl = $row['titleurl'];
	} else {
		$titleurl = getNewPublicationURL($unescapedtitle);
	}
	mysql_free_result($res);
	sql_start_transaction();
	// TODO придумать приличный алгоритм для изменения новости без удаления тегов каждый раз
	//Удаляем старые теги
	sql_query("DELETE FROM tags_in_publications WHERE publicationid = '$id'");
	// Меняем публикацию
	sql_query("UPDATE publications SET date = '$date', title = '$title', titleurl = '$titleurl',
			text = '$longtext', category = $section
		WHERE id = '$id'");
	//Добавляем новые теги
	addTags($tags, $id);
	sql_commit_transaction();
}

function deleteArticle($id) {
	$id = (int)$id;
	sql_start_transaction();
	sql_query("DELETE FROM tags_in_publications
		WHERE publicationid =
			(SELECT connectid FROM publications WHERE id = $id AND category != 1)");
	sql_query("DELETE FROM publications WHERE id = $id");
	sql_commit_transaction();
}

function getLastArticleUser($category) {
	$category = (int)$category;
	$res = sql_one("SELECT text, title, titleurl
		FROM publications
		WHERE category = $category
		ORDER BY date DESC
		LIMIT 1");
	return $res;
}
///////////////////////////////////////////////////////////////////////////////////////////
// Работа с тендерами
///////////////////////////////////////////////////////////////////////////////////////////

function addTenderUser($title, $conditions, $start, $end, $organizer, $contact_face, $phones, $faxes, $email, $user) {
	$title = mysql_real_escape_string($title);
	$conditions = mysql_real_escape_string($conditions);
	$start = mysql_real_escape_string($start);
	$end = mysql_real_escape_string($end);
	$organizer = mysql_real_escape_string($organizer);
	$contact_face = mysql_real_escape_string($contact_face);
	$phones = mysql_real_escape_string($phones);
	$faxes = mysql_real_escape_string($faxes);
	$email = mysql_real_escape_string($email);
	$user = (int)$user;
	
	sql_start_transaction();
	sql_query("INSERT INTO tender(title, conditions, start, end, organizer, contact_face, phones, faxes, email, add_date, user)
		VALUES ('$title', '$conditions', '$start', '$end', '$organizer', '$contact_face', '$phones', '$faxes', '$email', NOW(), $user)");
	sql_commit_transaction();
}

function editTenderUser($id, $title, $conditions, $start, $end, $organizer, $contact_face, $phones, $faxes, $email, $user) {
	$id = (int)$id;
	$title = mysql_real_escape_string($title);
	$conditions = mysql_real_escape_string($conditions);
	$start = mysql_real_escape_string($start);
	$end = mysql_real_escape_string($end);
	$organizer = mysql_real_escape_string($organizer);
	$contact_face = mysql_real_escape_string($contact_face);
	$phones = mysql_real_escape_string($phones);
	$faxes = mysql_real_escape_string($faxes);
	$email = mysql_real_escape_string($email);
	$user = (int)$user;
	
	sql_start_transaction();
	sql_query("UPDATE tender SET title = '$title', conditions = '$conditions', start = '$start', end = '$end', 
		organizer = '$organizer', contact_face = '$contact_face', phones = '$phones', faxes = '$faxes', email = '$email'
		WHERE id = $id AND user = $user");
	sql_commit_transaction();
}

function listTenderAdmin($start, $limit, $sort, $dir) {
	$start = (int)$start;
	$limit = (int)$limit;
	$rows = sql_all("SELECT SQL_CALC_FOUND_ROWS `id`, `title`,
			DATE_FORMAT(`start`, '%d.%m.%Y') AS `start`, DATE_FORMAT(`end`, '%d.%m.%Y') AS `end`,
			`organizer`, `contact_face`, `phones`, `faxes`, `email`, `state`
		FROM `tender`
		LIMIT $start, $limit");
	$count = sql_single_value("SELECT FOUND_ROWS() count");
	$result = array('totalCount' => $count, 'tender' => $rows);
	return $result;	
}

function listTenderUser($page) {
	global $config;
	
	$page = (int)$page;
	if ($page < 1) {
		$page = 1;
	}
	$limit = $config['tender']['itemsperpage']; 
	$start = ($page - 1) * $limit;
	
	$res = sql_all("SELECT SQL_CALC_FOUND_ROWS t.id, DATE_FORMAT(t.`add_date`, '%d.%m.%Y') AS `add_date`, 
			t.title, t.organizer, t.conditions
		FROM tender AS t
		WHERE t.state = 'approved'
		ORDER BY t.add_date DESC
		LIMIT $start, $limit");
	$count = sql_single_value("SELECT FOUND_ROWS()");
	if ($count % $limit == 0) {
		$pages = $count / $limit;
	} else {
		$pages = $count / $limit + 1;
	}
	return array('data' => $res, 'count' => $count, 'pages' => $pages);
	
}

function getTenderUser($id) {
	$id = (int)$id;
	$tender = sql_one("SELECT t.id, t.`title`, t.`conditions`, DATE_FORMAT(t.`start`, '%d.%m.%Y') AS `start`,
			DATE_FORMAT(t.`end`, '%d.%m.%Y') AS `end`, t.`organizer`, t.`contact_face`,
			t.`phones`, t.`faxes`, t.`email`, t.`request_count`
		FROM tender AS t
		WHERE t.id = $id AND t.`state` = 'approved'");
	return $tender;
}

function changeStateTenderAdmin($id, $state) {
	$id = (int)$id;
	$state = mysql_real_escape_string($state);
	sql_query("UPDATE tender SET state = '$state', approve_date = NOW()
		WHERE id = $id");
}

function updateRequestNum($id){
	sql_query("UPDATE tender SET request_count = request_count+1 WHERE id = $id");
}

function getTenderEmail($id) {
	$tender = sql_single_value("SELECT email FROM tender WHERE id = $id AND `state` = 'approved'");
	return $tender;
}

function getUserTenderCount($user) {
	$user = (int)$user;
	return sql_single_value("SELECT count(*)
		FROM tender
		WHERE user = $user");
}

function getUserTender($user) {
	$user = (int)$user;
	return sql_all("SELECT t.id, t.`title`, t.`conditions`, DATE_FORMAT(t.`start`, '%d.%m.%Y') AS `start`,
			DATE_FORMAT(t.`end`, '%d.%m.%Y') AS `end`, t.`organizer`, t.`contact_face`,
			t.`phones`, t.`faxes`, t.`email`, t.`request_count`
		FROM tender AS t
		WHERE t.user = $user");
}

function deleteUserTender($user, $id) {
	$user = (int)$user;
	$id = (int)$id;
	sql_query("DELETE FROM tender WHERE user = $user AND id = $id LIMIT 1");
}

function deleteTenderAdmin($id) {
	$id = (int)$id;
	sql_query("DELETE FROM tender WHERE id = $id LIMIT 1");
}

function getTenderEditUser($id) {
	$id = (int)$id;
	$tender = sql_one("SELECT t.id, t.`title`, t.`conditions`, 
			DATE_FORMAT(t.`start`, '%d') AS `start_day`,
			DATE_FORMAT(t.`start`, '%m') AS `start_month`,
			DATE_FORMAT(t.`start`, '%Y') AS `start_year`,
			DATE_FORMAT(t.`end`, '%d') AS `end_day`,
			DATE_FORMAT(t.`end`, '%m') AS `end_month`,
			DATE_FORMAT(t.`end`, '%Y') As `end_year`,
			t.`organizer`, t.`contact_face`, t.`phones`, t.`faxes`, t.`email`, t.`request_count`
		FROM tender AS t
		WHERE t.id = $id");
	return $tender;
}

///////////////////////////////////////////////////////////////////////////////////////////
// Работа с объявлениями
///////////////////////////////////////////////////////////////////////////////////////////
function getNoticeRubricsList($countnotices = false) {
	if ($countnotices) {
		$res = sql_all("SELECT r.id, r.title, count(n.id) AS `count`
			FROM noticerubrics AS r
			LEFT JOIN notices AS n ON n.rubrics = r.id AND n.end_date > NOW()
			GROUP BY r.id");
	} else {
		$res = sql_all("SELECT id, title
			FROM noticerubrics");
	}
	return $res;
}

function getNoticeCategories() {
	$res = sql_all("SELECT id, title
	FROM noticecategory");
	return $res;
}

function getRubricNameById($id) {
	$id = (int)$id;
	return sql_single_value("SELECT title FROM noticerubrics WHERE id = $id");
}

function addNoticeUser($category, $rubrics, $title, $contents, $period, $firm, $phone, $site, $email, $city, $user) {
	$category = (int)$category;
	$rubrics = (int)$rubrics;
	$title = mysql_real_escape_string($title);
	$contents = mysql_real_escape_string($contents);
	$period = mysql_real_escape_string($period);
	$firm = mysql_real_escape_string($firm);
	$phone = mysql_real_escape_string($phone);
	$site = mysql_real_escape_string($site);
	$email = mysql_real_escape_string($email);
	$city = mysql_real_escape_string($city);
	$user = (int)$user;
	sql_query("INSERT INTO notices(category, rubrics, title, contents, add_date, end_date, firm, phone, site, email, city, user)
		VALUES ($category, $rubrics, '$title', '$contents', NOW(), DATE_ADD(NOW(), INTERVAL $period), '$firm', '$phone', '$site', '$email', '$city', $user)");
}

function editNoticeUser($id, $category, $rubrics, $title, $contents, $period, $firm, $phone, $site, $email, $city, $user) {
	$id = (int)$id;
	$category = (int)$category;
	$rubrics = (int)$rubrics;
	$title = mysql_real_escape_string($title);
	$contents = mysql_real_escape_string($contents);
	$period = mysql_real_escape_string($period);
	$firm = mysql_real_escape_string($firm);
	$phone = mysql_real_escape_string($phone);
	$site = mysql_real_escape_string($site);
	$email = mysql_real_escape_string($email);
	$city = mysql_real_escape_string($city);
	$user = (int)$user;
	if ($period == "") {
		$end_date = "";
	} else {
		$end_date = "end_date = DATE_ADD(NOW(), INTERVAL $period), ";
	}
	sql_query("UPDATE notices SET category = $category, rubrics = $rubrics, title = '$title', contents = '$contents', $end_date
		firm = '$firm', phone = '$phone', site = '$site', email = '$email', city = '$city'
		WHERE id = $id AND user = $user");
}

function getLastNoticesUser($count) {
	$count = (int)$count;
	$notices = sql_all("SELECT id, category, title, DATE_FORMAT(add_date, '%d.%m.%Y') AS date, firm, city
		FROM notices
		WHERE end_date > NOW()
		ORDER BY add_date DESC
		LIMIT $count");
	return $notices;
}

function listNoticesUser($rubrics, $page) {
	global $config;
	
	$page = (int)$page;
	if ($page < 1) {
		$page = 1;
	}
	$limit = $config['notices']['itemsperpage']; 
	$start = ($page - 1) * $limit;
	
	$rubrics = (int)$rubrics;
	$res = sql_all("SELECT SQL_CALC_FOUND_ROWS n.id, n.category, n.title, DATE_FORMAT(n.add_date, '%d.%m.%Y') AS date,

			c.company_name AS firm, c.city, c.id AS company_id
		FROM notices AS n

		LEFT JOIN catalog AS c ON c.user = n.user 
		WHERE end_date > NOW() AND rubrics = $rubrics
		GROUP BY n.id

		ORDER BY n.add_date DESC

		LIMIT $start, $limit");
	$count = sql_single_value("SELECT FOUND_ROWS()");
	if ($count % $limit == 0) {
		$pages = $count / $limit;
	} else {
		$pages = $count / $limit + 1;
	}
	return array('data' => $res, 'count' => $count, 'pages' => $pages);
}

function getNoticeUser($id) {
	$id = (int)$id;
	return sql_one("SELECT n.category, n.rubrics, n.title, n.contents, DATE_FORMAT(n.add_date, '%d.%m.%Y') AS date,
			c.company_name AS firm,

			CONCAT_WS('; ',NULLIF(c.directorate,''),NULLIF(c.supply_department,''),NULLIF(c.marketing_department,''),NULLIF(c.sales_department,''),NULLIF(c.accounting_department,''),NULLIF(c.legal_department,''),NULLIF(c.engineering_department,'')) AS phone,

			c.site, c.email, c.city, c.id AS company_id
		FROM notices AS n

		LEFT JOIN catalog AS c ON c.user = n.user

		WHERE n.id = $id

		LIMIT 1");
}

function getUserNoticesCount($user) {
	$user = (int)$user;
	return sql_single_value("SELECT count(*)
		FROM notices
		WHERE user = $user");
}

function getUserNotices($user) {
	$user = (int)$user;
	return sql_all("SELECT id, category, rubrics, title, contents, DATE_FORMAT(add_date, '%d.%m.%Y') AS date,
			firm, phone, site, email, city
		FROM notices
		WHERE user = $user");
}

function deleteUserNotice($user, $id) {
	$user = (int)$user;
	$id = (int)$id;
	sql_query("DELETE FROM notices WHERE user = $user AND id = $id LIMIT 1");
}
///////////////////////////////////////////////////////////////////////////////////////////
// Работа с форумом
///////////////////////////////////////////////////////////////////////////////////////////
function listLastThreads() {
	$res = sql_query_vbulletin("SELECT threadid, title, forumid, replycount, postusername, postuserid, lastposter, dateline, iconid
		FROM thread
		WHERE sticky = '0' ORDER BY dateline DESC LIMIT 10");
	$result = array();
	while ($row = mysql_fetch_assoc($res)) {
		$result[] = $row;
	}
	mysql_free_result($res);
	return $result;		
}

function getUserInfo($id) {
	$id = (int)$id;
	$res = sql_query_vbulletin("SELECT * FROM users WHERE id = $id");
	$result = mysql_fetch_assoc($res);
	mysql_free_result($res);
	return $result;		
}
////////////////////////////////////////////////////////////////////////////////////////////
// Работа с блогами
////////////////////////////////////////////////////////////////////////////////////////////
function listLastBlogs() {
	$res = sql_all("SELECT blog_id, domain, DATE_FORMAT(last_updated, '%d.%m.%Y') AS date
		FROM wp_blogs
		WHERE public = '1' AND archived = '0' AND mature = '0' AND spam = '0' AND deleted ='0'
		ORDER BY last_updated DESC
		LIMIT 5");
	foreach ($res as $key => $value) {
		$res[$key]['name'] = sql_single_value("SELECT option_value FROM wp_$value[blog_id]_options WHERE option_name = 'blogname'");
		$res[$key]['description'] = sql_single_value("SELECT option_value FROM wp_$value[blog_id]_options WHERE option_name = 'blogdescription'");
	}
	return $res;
}

///////////////////////////////////////////////////////////////////////////////////////////
// Работа с библиотекой
///////////////////////////////////////////////////////////////////////////////////////////
function listLibraryAdmin($start, $limit, $sort, $dir) {
	$start = (int)$start;
	$limit = (int)$limit;
	$rows = sql_all("SELECT SQL_CALC_FOUND_ROWS l.`id`, l.`filename`, l.`title`, l.`short`, l.`description`,
		CONCAT(c.category, ' - ', s.subcategory) AS cat, DATE_FORMAT(l.add_date, '%d.%m.%Y') AS date
		FROM `library` AS l
		LEFT JOIN library_subcategory AS s ON l.`category` = s.id
		LEFT JOIN library_category AS c ON s.category = c.id
		LIMIT $start, $limit");
	$count = sql_single_value("SELECT FOUND_ROWS() count");
	$result = array('totalCount' => $count, 'library' => $rows);
	return $result;	
}

function listLibraryCategories() {
	return sql_all("SELECT s.id AS `value`, CONCAT(s.id, ' ', c.category, ' - ', s.subcategory) AS `text`
		FROM library_subcategory AS s
		LEFT JOIN library_category AS c ON c.id = s.category");
}

function addLibraryFile($filename) {
	$filename = mysql_real_escape_string($filename);
	sql_query("INSERT INTO library(filename, add_date) VALUES ('$filename', NOW())");
}

function getLibraryAdmin($id) {
	$id = (int)$id;
	return sql_one("SELECT l.`id`, l.`title`, l.`short`, l.`description`, l.`filename`,
		CONCAT(s.id, ' ', c.category, ' - ', s.subcategory) AS `category`, l.category AS cat
		FROM `library` AS l
		LEFT JOIN library_subcategory AS s ON l.`category` = s.id
		LEFT JOIN library_category AS c ON s.category = c.id
		WHERE l.`id` = $id");
}

function editLibrary($id, $category, $title, $short, $description) {
	$id = (int)$id;
	$category = (int)$category;
	$title = mysql_real_escape_string($title);
	$short = mysql_real_escape_string($short);
	$description = mysql_real_escape_string($description);
	sql_query("UPDATE library SET title = '$title', short = '$short', description = '$description',
		category = $category
		WHERE id = $id
		LIMIT 1");
}

function deleteLibraryAdmin($id) {
	$id = (int)$id;
	sql_query("DELETE FROM library WHERE id = $id LIMIT 1");
}



function getLibrary($id) {

	$id = (int)$id;

	return sql_one("SELECT l.`id`, l.`title`, l.`short`, l.`description`, l.`filename`,

		CONCAT(c.category, ' - ', s.subcategory) AS `category`, l.category AS cat,

		DATE_FORMAT(l.add_date, '%d.%m.%Y') AS date

		FROM `library` AS l

		LEFT JOIN library_subcategory AS s ON l.`category` = s.id

		LEFT JOIN library_category AS c ON s.category = c.id

		WHERE l.`id` = $id");

}



function listLibraryLast() {

	return sql_all("SELECT l.`id`, l.`filename`, l.`title`, l.`short`, l.`description`,

		CONCAT(c.category, ' - ', s.subcategory) AS category, DATE_FORMAT(l.add_date, '%d.%m.%Y') AS date

		FROM `library` AS l

		LEFT JOIN library_subcategory AS s ON l.`category` = s.id

		LEFT JOIN library_category AS c ON s.category = c.id

		ORDER BY l.`add_date` DESC

		LIMIT 10");	

}



function listLibraryCategoriesUser() {

	return sql_all("SELECT c.id, c.category, count(l.id) AS `count`

		FROM library_category AS c

		LEFT JOIN library_subcategory AS s ON s.category = c.id

		LEFT JOIN library AS l ON l.category = s.id

		GROUP BY c.id");

}



function listLibrarySubcategoriesUser($id) {

	$id = (int)$id;

	return sql_all("SELECT s.id, s.subcategory, count(l.id) AS `count`

		FROM library_subcategory AS s

		LEFT JOIN library AS l ON l.category = s.id

		WHERE s.category = $id

		GROUP BY s.id");

}



function listLibraryUser($subcategory, $page) {

	$subcategory = (int)$subcategory;

	

	$page = (int)$page;

	if ($page < 1) {

		$page = 1;

	}

	$limit = 10; 

	$start = ($page - 1) * $limit;

	

	$res = sql_all("SELECT SQL_CALC_FOUND_ROWS l.`id`, l.`filename`, l.`title`, l.`short`, l.`description`,

		CONCAT(c.category, ' - ', s.subcategory) AS category, DATE_FORMAT(l.add_date, '%d.%m.%Y') AS date

		FROM `library` AS l

		LEFT JOIN library_subcategory AS s ON l.`category` = s.id

		LEFT JOIN library_category AS c ON s.category = c.id

		WHERE l.`category` = $subcategory

		ORDER BY l.`add_date` DESC

		LIMIT $start, $limit");

	

	$count = sql_single_value("SELECT FOUND_ROWS()");

	if ($count % $limit == 0) {

		$pages = $count / $limit;

	} else {

		$pages = $count / $limit + 1;

	}

	return array('data' => $res, 'count' => $count, 'pages' => $pages);

}



function getLibrarySubcategory($id) {

	$id = (int)$id;

	return sql_single_value("SELECT CONCAT(c.category, ' - ', s.subcategory)

		FROM library_subcategory AS s

		LEFT JOIN library_category AS c ON c.id = s.category

		WHERE s.id = $id");

}



function getLibraryCategory($id) {

	$id = (int)$id;

	return sql_single_value("SELECT category

		FROM library_category

		WHERE id = $id");

}

/*avto.tdj.by*/

// выводит имена брендов на главной странице :)
function listBrandsNames() {
	return sql_all("SELECT id,name, col 
		FROM `brands`
		ORDER BY name ASC");
} 
function listModelNames($make) {
	return sql_all("SELECT id,name 
		FROM `cars`
		WHERE `brand`='$make'
		ORDER BY name ASC");
} 
function listTypeEngine() {
	return sql_all("
	SELECT id, name FROM `typeeng`
	ORDER BY id ASC");
}
function listBodyType() {
	return sql_all("
	SELECT id, name FROM `typekyzov`
	ORDER BY id ASC");
}
function listAddition() {
	return sql_all ("SELECT id, name FROM `addition`");
}
function addCar($raspol, $for_free_text, $for_free_link, $color_salon, $tip_cat, $content, $model, $color, $year, $price, $way, $tp, $typeeng,$category ,$modif, $obem, $typekyzov, $kpp, $cash,$city, $name, $surname, $city2, $phone, $oldprice,$period,$diller,$foreign,$dilservice,$owners,$repair,$userid, $show, $garanty, $vin = "", $title = "", $transmission) {
$raspol = mysql_real_escape_string($raspol);
$for_free_text = mysql_real_escape_string($for_free_text);
$for_free_link = mysql_real_escape_string($for_free_link);
$color_salon = mysql_real_escape_string($color_salon);
$tip_cat = mysql_real_escape_string($tip_cat);
	$content = mysql_real_escape_string($content);
	$model = (int)$model;
	$color =mysql_real_escape_string($color);
	$year = (int)$year;
	$price= (int)$price;
	$way = (int)$way;
	$tp = (int)$tp;
	$typeeng = (int)$typeeng;
	//fix на всякий пожарный
	if ($typeeng == '0') $typeeng = '5';
	$modif =mysql_real_escape_string($modif);
	$obem=(int)$obem;
	$typekyzov = (int)$typekyzov;
	$kpp=(int)$kpp;
	$cash =(int)$cash;
	$category =(int)$category;
	
	$city = mysql_real_escape_string($city); //-
	$transmission=mysql_real_escape_string($transmission);//-
	$name = mysql_real_escape_string($name);//-
	$surname = mysql_real_escape_string($surname);
	$city2 = mysql_real_escape_string($city2);
	$phone = mysql_real_escape_string($phone); //tel 
	$vin = mysql_real_escape_string($vin);  
	$title = mysql_real_escape_string($title); 
	$oldprice =(int)$oldprice;
	//DATE_ADD(NOW(), INTERVAL $period)
//	$period = 
	//куплен у офиц. диллера
	$time=date('Y-m-d', time());
	$diller = (int)$diller;
	//куплен заграницой
	$foreign = (int)$foreign;
	//обслуж. у офиц. диллера
	$dilservice = (int)$diller;
	
	$owners =(int)$owners;
	$repair= (int)$repair; 

	//show показывать ли на сайте сразу
	$show = mysql_real_escape_string($show);
	
	$garanty = (int)$garanty;

	
	
	///mysql_real_escape_string
	
	
	sql_query("INSERT INTO `auto` (`raspol`, `for_free_text`, `for_free_link`, `date`,`content`, `name`, `tel`,`adress`,`city`,`model`,`color`,`year`,`price`,`way`,`tp`,`typeeng`,`category` ,`modif`,`obem`,`typekyzov`,`kpp`,`cash`, `show`, `surname`, `oldprice`, `enddate`, `diller`, `foreign`, `dilservice`,`owners`,`repair`, `userid`,`garanty`, `vin`, `title`, `color_salon`, `tip_cat`, `transmission`) 
VALUES ('$raspol', '$for_free_text', '$for_free_link', '$time', '$content','$name', '$phone','$city','$city2','$model','$color','$year','$price','$way','$tp','$typeeng','$category' ,'$modif','$obem','$typekyzov','$kpp','$cash', '$show','$surname','$oldprice', '$time', '$diller', '$foreign','$dilservice','$owners','$repair','$userid','$garanty', '$vin', '$title', '$color_salon', '$tip_cat', '$transmission')");
	return mysql_insert_id();

}
function SaveCar($id,$userid,$content, $model, $color, $year, $price, $way, $tp, $typeeng,$category ,$modif, $obem, $typekyzov, $kpp, $cash,$city, $name, $surname, $city2, $phone, $oldprice,$period,$diller,$foreign,$dilservice,$owners,$repair,$userid, $show,$garanty, $vin, $title, $tip_cat, $color_salon, $transmission) {

	$id = (int)$id;
	$userid = (int)$userid;
	$content = mysql_real_escape_string($content);
	
	$model = (int)$model;
	$color =mysql_real_escape_string($color);
	$year = (int)$year;
	$price= (int)$price;
	$way = (int)$way;
	$tp = (int)$tp;
	$typeeng = (int)$typeeng;
	//fix на всякий пожарный
	if ($typeeng == '0') $typeeng = '5';
	$modif =mysql_real_escape_string($modif);
	$obem=(int)$obem;
	$typekyzov = (int)$typekyzov;
	$kpp=(int)$kpp;
	$cash =(int)$cash;
	$category =(int)$category;
	$transmission = mysql_real_escape_string($transmission); //-
	$city = mysql_real_escape_string($city); //-
	$name = mysql_real_escape_string($name);//-
	$surname = mysql_real_escape_string($surname);
	$city2 = mysql_real_escape_string($city2);
	$phone = mysql_real_escape_string($phone); //tel 
	$vin = mysql_real_escape_string($vin);  
	$title = mysql_real_escape_string($title); 
	$oldprice =(int)$oldprice;
	//DATE_ADD(NOW(), INTERVAL $period)
//	$period = 
	//куплен у офиц. диллера
	$diller = (int)$diller;
	//куплен заграницой
	$foreign = (int)$foreign;
	//обслуж. у офиц. диллера
	$dilservice = (int)$diller;
	
	$owners =(int)$owners;
	$repair= (int)$repair; 

	//show показывать ли на сайте сразу
	$show = mysql_real_escape_string($show);
	$garanty=(int)$garanty;


	mysql_query("UPDATE `auto` SET
		`color_salon` = '$color_salon',
		`date` = NOW(), 
		`tip_cat` = '$tip_cat',
		`content` = '$content',
		`name` = '$name',
		`tel`='$phone',
		`adress` = '$city',
		`city` ='$city2',
		`model` = '$model',
		`color` = '$color',
		`year` = '$year',
		`price` = '$price',
		`way` = '$way',
		`tp` = '$tp',
		`typeeng` = '$typeeng',
		`category` = '$category',     
		`modif` = '$modif',
		`obem` = '$obem',
		`typekyzov` = '$typekyzov',
		`kpp` = '$kpp',
	 	`cash` = '$cash',
		`show` = '$show',
		`surname` = '$surname',
		`oldprice` = '$oldprice',
		`enddate` = DATE_ADD(NOW(), INTERVAL $period),
		`diller` = '$diller',
		`dilservice` = '$dilservice',
		`owners` = '$owners',
		`repair` = '$repair', 
		`userid` = '$userid',
		`garanty` = '$garanty',
		`vin` = '$vin',
		`title` = '$title',
		`transmission` = '$transmission'
		WHERE `id` = '$id'");
}
function SaveCar_for_free($id, $raspol, $for_free_text, $for_free_link) {
$id = (int)$id;
$raspol = mysql_real_escape_string($raspol);
$for_free_text = mysql_real_escape_string($for_free_text);
$for_free_link = mysql_real_escape_string($for_free_link);
mysql_query("UPDATE `auto` SET
			`raspol` = '$raspol',
			`for_free_text` = '$for_free_text',
			`for_free_link` = '$for_free_link'
		   	WHERE `id` = '$id'");
}

function GetUserId($id) {
	$id = (int)$id;
	return sql_query("SELECT `userid` FROM `auto` WHERE `id`='$id'");
	
}
function addAddition ($insid, $i){
	$insid=(int)$insid;
	$i=(int)$i;
		
	sql_query("INSERT INTO `autocat` (`auto_id`, `addition_id`) VALUES ('$insid','$i')");
}
function DelAddition ($id){
	$id=(int)$id;
	sql_query("DELETE FROM `autocat`WHERE `auto_id`='$id'");
}
function getMainNewAuto (){
	return sql_all("SELECT `auto`.`id`,`cars`.`name` as `car_name`,`brands`.`name` as `brand_name`,`auto`.`topic`,`auto`.`price`,`auto`.`oldprice`,`auto`.`year`,`auto`.`show`,`auto`.`cash`,`date` 
	FROM `auto`,`cars`,`brands` WHERE `auto`.`category`='0'&&`cars`.`id`=`auto`.`model`&&`brands`.`id`=`cars`.`brand` ORDER BY `auto`.`date` DESC LIMIT 2");
}

function getMainRecommendAuto(){
	return sql_all("SELECT `auto`.`id`,`cars`.`name` as `car_name`,`brands`.`name` as `brand_name`,`auto`.`topic`,`auto`.`price`,`auto`.`oldprice`,`auto`.`year`,`auto`.`show`,`auto`.`cash`,`date` 
	FROM `auto`,`cars`,`brands` WHERE `auto`.`category`='2'&&`cars`.`id`=`auto`.`model`&&`brands`.`id`=`cars`.`brand` ORDER BY `auto`.`date` DESC LIMIT 1");
}
function getMainSkladAuto (){
	return sql_all("SELECT `auto`.`id`,`cars`.`name` as `car_name`,`brands`.`name` as `brand_name`,`auto`.`topic`,`auto`.`price`,`auto`.`oldprice`,`auto`.`year`,`auto`.`show`,`auto`.`cash`,`date` 
	FROM `auto`,`cars`,`brands` WHERE `auto`.`category`='3'&&`auto`.`show`='1'&&`cars`.`id`=`auto`.`model`&&`brands`.`id`=`cars`.`brand` ORDER BY `auto`.`date` DESC LIMIT 9");
}
function getMainRandAuto ($limit){
	return sql_all("SELECT `auto`.`id`,`cars`.`name` as `car_name`,`brands`.`name` as `brand_name`,`auto`.`topic`,`auto`.`price`,`auto`.`oldprice`,`auto`.`year`,`auto`.`show`,`auto`.`cash`,`date` 
	FROM `auto`,`cars`,`brands` WHERE `auto`.`category`='3'&&`auto`.`show`='1'&&`cars`.`id`=`auto`.`model`&&`brands`.`id`=`cars`.`brand` ORDER BY RAND() LIMIT $limit");
}
function getMainWayAuto (){
	return sql_all("SELECT `auto`.`id`,`cars`.`name` as `car_name`,`brands`.`name` as `brand_name`,`auto`.`topic`,`auto`.`price`,`auto`.`oldprice`,`auto`.`year`,`auto`.`show`,`auto`.`cash`,`date` 
	FROM `auto`,`cars`,`brands` WHERE `auto`.`category`='1'&&`auto`.`show`='1'&&`cars`.`id`=`auto`.`model`&&`brands`.`id`=`cars`.`brand` ORDER BY `auto`.`date` DESC LIMIT 4");
}
function getMainRecomendAuto (){
	return sql_all("SELECT `auto`.`id`,`cars`.`name` as `car_name`,`brands`.`name` as `brand_name`,`auto`.`topic`,`auto`.`price`,`auto`.`oldprice`,`auto`.`year`,`auto`.`show`,`auto`.`cash`,`date` 
	FROM `auto`,`cars`,`brands` WHERE `auto`.`category`='4'&&`auto`.`show`='1'&&`cars`.`id`=`auto`.`model`&&`brands`.`id`=`cars`.`brand` ORDER BY `auto`.`date` DESC LIMIT 4");
}
//getMainWayAuto
function getMainLastAuto (){
	return sql_all("SELECT `auto`.`id`,`auto`.`cash`,`cars`.`name` as `car_name`,`brands`.`name` as `brand_name`,`auto`.`topic`,`auto`.`price`,`auto`.`oldprice`,`auto`.`year`,`auto`.`show`,`date` 
	FROM `auto`,`cars`,`brands` WHERE `cars`.`id`=`auto`.`model`&&`auto`.`show`='1'&&`brands`.`id`=`cars`.`brand`&&`auto`.`category`!='1' ORDER BY `auto`.`id` DESC LIMIT 4");
}
function listAllAuto($page, $tip_cat){
	$page = (int)$page;
	if ($page < 1) {
		$page = 1;
	}
	$limit = 15; 
	$start = ($page - 1) * $limit;
	
	
	$res = sql_all("SELECT SQL_CALC_FOUND_ROWS `auto`.`for_free_text`,`auto`.`prod`,`auto`.`id`,`cars`.`name` as `car_name`,`brands`.`name` as `brand_name`,`auto`.`topic`,`auto`.`cash`,`auto`.`price`,`auto`.`oldprice`,`auto`.`year`,`auto`.`tp`,`auto`.`show`,`auto`.`category`,`date`, `way`, `kpp`, `color`, `obem` 
	FROM `auto`,`cars`,`brands` 
	WHERE `cars`.`id`=`auto`.`model`&&`brands`.`id`=`cars`.`brand`&&`auto`.`tip_cat`='$tip_cat'
	ORDER BY `auto`.`id` DESC ,`auto`.`admin` LIMIT $start,$limit");
	
	$count_rows = sql_one("SELECT FOUND_ROWS() c");
	return array($count_rows['c'], $res);
}
function AllAuto($page){
	$page = (int)$page;
	if ($page < 1) {
		$page = 1;
	}
	$limit = 15; 
	$start = ($page - 1) * $limit;
	
	
	$res = sql_all("SELECT SQL_CALC_FOUND_ROWS `auto`.`for_free_text`,`auto`.`prod`,`auto`.`id`,`cars`.`name` as `car_name`,`brands`.`name` as `brand_name`,`auto`.`topic`,`auto`.`cash`,`auto`.`price`,`auto`.`oldprice`,`auto`.`year`,`auto`.`tp`,`auto`.`show`,`auto`.`category`,`date`, `way`, `kpp`, `color`, `obem` 
	FROM `auto`,`cars`,`brands` 
	WHERE `cars`.`id`=`auto`.`model`&&`brands`.`id`=`cars`.`brand`
	ORDER BY `auto`.`id` DESC ,`auto`.`admin`");
	
	$count_rows = sql_one("SELECT FOUND_ROWS() c");
	return array($count_rows['c'], $res);
}
function listHotAuto($page){
	$page = (int)$page;
	if ($page < 1) {
		$page = 1;
	}
	$limit = 12; 
	$start = ($page - 1) * $limit;
	
	
	$res = sql_all("SELECT SQL_CALC_FOUND_ROWS `auto`.`id`,`cars`.`name` as `car_name`,`brands`.`name` as `brand_name`,`auto`.`topic`,`auto`.`cash`,`auto`.`price`,`auto`.`oldprice`,`auto`.`year`,`auto`.`show`,`auto`.`category`,`date`, `way`, `kpp`, `color`, `obem` 
	FROM `auto`,`cars`,`brands` 
	WHERE `cars`.`id`=`auto`.`model`&&`brands`.`id`=`cars`.`brand`&& `auto`.`show`='1'&&`auto`.`category`='2'
	ORDER BY `auto`.`date` DESC LIMIT $start,$limit");
	
	$count_rows = sql_one("SELECT FOUND_ROWS() c");
	return array($count_rows['c'], $res);
}
function GetAllAutoQuick($limit, $mode) {
	$limit=intval($limit);
	$mode = intval($mode);
	return sql_all("SELECT `auto`.`id`,`cars`.`name` as `car_name`,`brands`.`name` as `brand_name`,`auto`.`price`
	FROM `auto`,`cars`,`brands` 
	WHERE `cars`.`id`=`auto`.`model`&&`brands`.`id`=`cars`.`brand`&&`auto`.`category`='$mode'
	LIMIT $limit");
}
function listDeliveredAuto($page){
	$page = (int)$page;
	if ($page < 1) {
		$page = 1;
	}
	$limit = 12; 
	$start = ($page - 1) * $limit;
	
	
	$res = sql_all("SELECT SQL_CALC_FOUND_ROWS `auto`.`id`,`cars`.`name` as `car_name`,`brands`.`name` as `brand_name`,`auto`.`topic`,`auto`.`cash`,`auto`.`price`,`auto`.`oldprice`,`auto`.`year`,`auto`.`show`,`auto`.`category`,`date` 
	FROM `auto`,`cars`,`brands` 
	WHERE `cars`.`id`=`auto`.`model`&&`brands`.`id`=`cars`.`brand`&& `auto`.`show`='1'&&`auto`.`category`='2'
	ORDER BY `auto`.`date` DESC LIMIT $start,$limit");
	
	$count_rows = sql_one("SELECT FOUND_ROWS() c");
	return array($count_rows['c'], $res);
}
function listSaloneAuto ($start_item,$items_per_page){
	$start_item=(int)$start_item;
	$items_per_page=(int)$items_per_page;
	return sql_all("SELECT `auto`.`id`,`cars`.`name` as `car_name`,`brands`.`name` as `brand_name`,`auto`.`topic`,`auto`.`cash`,`auto`.`price`,`auto`.`oldprice`,`auto`.`year`,`auto`.`show`,`date` 
	FROM `auto`,`cars`,`brands` WHERE `auto`.`category`='1'&&`cars`.`id`=`auto`.`model`&&`brands`.`id`=`cars`.`brand` ORDER BY `auto`.`date` DESC LIMIT $start_item,$items_per_page");
}
function listPSaloneAuto ($page){
	$page = (int)$page;
	if ($page < 1) {
		$page = 1;
	}
	$limit = 12; 
	$start = ($page - 1) * $limit;
	
	$res = sql_all("SELECT SQL_CALC_FOUND_ROWS `auto`.`id`,`cars`.`name` as `car_name`,`brands`.`name` as `brand_name`,`auto`.`topic`,`auto`.`cash`,`auto`.`price`,`auto`.`oldprice`,`auto`.`year`,`auto`.`show`,`date` 
	FROM `auto`,`cars`,`brands` 
	WHERE `auto`.`category`='1'&&`cars`.`id`=`auto`.`model`&&`brands`.`id`=`cars`.`brand`&&`auto`.`show`='1'
	ORDER BY `auto`.`date` DESC LIMIT $start,$limit");
	$count_rows = sql_one("SELECT FOUND_ROWS() c");
	return array($count_rows['c'], $res);
}
function listPriceAuto ($start_item,$items_per_page){
	$start_item=(int)$start_item;
	$items_per_page=(int)$items_per_page;
	return sql_all("SELECT `auto`.`id`,`cars`.`name` as `car_name`,`brands`.`name` as `brand_name`,`auto`.`topic`,`auto`.`cash`,`auto`.`price`,`auto`.`oldprice`,`auto`.`year`,`auto`.`show`,`date` 
	FROM `auto`,`cars`,`brands` WHERE `auto`.`oldprice`>0&&`cars`.`id`=`auto`.`model`&&`auto`.`show`='1'&&`brands`.`id`=`cars`.`brand` ORDER BY `auto`.`date` DESC LIMIT $start_item,$items_per_page");
}
function getAuto($id) {
	return sql_one("SELECT `auto`.`userid` as `userid`, `auto`.`transmission` as `transmission`, `auto`.`tip_cat` as `tip_cat`, `auto`.`for_free_link` as `for_free_link`, `auto`.`for_free_text` as `for_free_text`, `auto`.`raspol` as `raspol`, `auto`.`color_salon` as `color_salon`,`auto`.`prod`,`auto`.`id`,`cars`.`name` as `car_name`,`brands`.`name` as `brand_name`,`typeeng`.`name` as `typeeng_name`,`typekyzov`.`name` as `typekyzov_name` ,`auto`.`topic`,`auto`.`price`,`auto`.`cash`, `auto`.`oldprice`,`auto`.`category`,`auto`.`year`,`auto`.`way`,`auto`.`tp`,`auto`.`obem`,`auto`.`color`,`auto`.`show`,`auto`.`typekyzov`,`auto`.`content` ,`auto`.`kpp`,`auto`.`view_count`, `auto`.`vin`, `auto`.`title`,`date`,`garanty` 
	FROM `auto`,`cars`,`brands`, `typeeng`, `typekyzov` WHERE `auto`.`id`='$id'&&`cars`.`id`=`auto`.`model`&&`brands`.`id`=`cars`.`brand`&&`typeeng`.`id`=`auto`.`typeeng`&&`typekyzov`.`id`=`auto`.`typekyzov`");
}
function CountView($id){
	sql_query("UPDATE auto set view_count=view_count+1 where id='$id'");
}
function getAutoId($id){
	return sql_query("SELECT * FROM auto WHERE id=$id");
}
function getAutoAddition($id){
	return sql_all("SELECT a.addition_id, b.name 
                FROM autocat a LEFT JOIN addition b ON a.addition_id = b.id
                WHERE auto_id=$id");
}
function getAutoAdd($id){
	$a = sql_all("SELECT addition_id
                FROM autocat
                WHERE auto_id=$id");
    $res = array();
    
    foreach ($a as $value){
    	$res[$value['addition_id']] = true;
    }
    return $res;
}

function getMainSearchBrands (){
	return sql_all("SELECT `b`.`id` as `brand_id`, b.name as `brand_name`, count(c.id) as col
	FROM brands b
	INNER JOIN cars c ON c.brand = b.id
	INNER JOIN auto a ON a.model = c.id
	GROUP BY b.id
	ORDER BY b.name ASC");
}
function getMainSearchBrandsSpares ($tip_cat){
	return sql_all("SELECT `c`.`id` as `category`, c.name as `name`, count(s.id) as col
	FROM spares_category c
	INNER JOIN spares s ON s.cat_id = c.id AND s.tip_cat=$tip_cat
	GROUP BY c.id
	ORDER BY c.name ASC");
}
function getMainSearchModels($make) {
	$make=intval($make);
	return sql_all("SELECT DISTINCT `cars`.`name`, `cars`.`id` 
					FROM cars, auto
					WHERE `auto`.`model`=`cars`.`id`&&`cars`.`brand`='$make'
					ORDER BY `cars`.`name` ASC");
}
function GetMinSearchYear($part) {
	$model = intval($part);
	return sql_single_value("SELECT MIN(`year`)
		FROM auto
		WHERE `auto`.`model`='$model'
		ORDER BY `year` ASC");
}
function GetMaxSearchYear($part) {
	$model = intval($part);
	return sql_single_value("SELECT MAX(`year`)
		FROM auto
		WHERE `auto`.`model`='$model'
		ORDER BY `year` DESC");
}
function getMainSearchEngine (){
	return sql_all("SELECT DISTINCT `typeeng`.`name` as `typeeng_name`, `typeeng`.`id` as `typeeng_id` 
	FROM `auto`,`typeeng` WHERE `typeeng`.`id`=`auto`.`typeeng` ORDER BY `typeeng_name` ASC");
}
function searchAllCar($brand, $fromprice, $toprice, $yearstart, $yearend, $engine, $page, $category, $tip_cat){
$category = (int)$category;
	$page = (int)$page;
	if ($page < 1) {
		$page = 1;
	}
	$limit = 10; 
	$start = ($page - 1) * $limit;

	$condition = "";
	
	if ($brand != 0 && $brand != ""){
		if ($condition != "") {
			 $condition .= ' AND ';
		}
		$condition .= 'c.brand = '.$brand;
	}

				
	if ($yearstart > 0) {
		if ($condition != "") {
			 $condition .= ' AND ';
		}
		$condition .= 'a.year >= '.$yearstart;
	}
	if ($category) {
		if ($condition != "") {
			 $condition .= ' AND ';
		}
		$condition .= 'a.category = '.$category;
	}
	
	if ($yearend > 0) {
		if ($condition != "") {
			 $condition .= ' AND ';
		}
		$condition .= 'a.year <= '.$yearend;
	}
	if ($fromprice > 0) {
		if ($condition != "") {
			 $condition .= ' AND ';
		}
		$condition .= 'a.price >= '.$fromprice;
	}
	if ($toprice > 0) {
		if ($condition != "") {
			 $condition .= ' AND ';
		}
		$condition .= 'a.price <= '.$toprice;
	}
	if ($engine != 0 && $engine !="") {
		if ($condition != "") {
			 $condition .= ' AND ';
		}
		$condition .= 'a.typeeng = '.$engine;		
	}
	if ($condition != "") {
			 $condition .= ' AND ';
		}
		$condition .= "a.show = 1";
		$tip_cat = (int)$tip_cat;
		$condition .= " AND a.tip_cat = '".$tip_cat."' ";
			
	if ($condition) {
		$condition = "WHERE ".$condition;
	}
	//,`cars`.`name` as `car_name`,`brands`.`name` as `brand_name`,
	$res = sql_all("SELECT SQL_CALC_FOUND_ROWS a.*, c.name as car_name, b.name as brand_name
		FROM auto AS a
		LEFT JOIN cars AS c ON a.model = c.id
		LEFT JOIN brands AS b ON c.brand = b.id
		$condition
		LIMIT $start, $limit");
	$count_rows = sql_one("SELECT FOUND_ROWS() c");
	return array($count_rows['c'], $res);
}
function searchSaloneCar($brand, $fromprice, $toprice, $yearstart, $yearend, $engine, $page){
	$page = (int)$page;
	if ($page < 1) {
		$page = 1;
	}
	$limit = 10; 
	$start = ($page - 1) * $limit;

	$condition = "";
	if ($brand != 0 && $brand != ""){
		if ($condition != "") {
			 $condition .= ' AND ';
		}
		$condition .= 'c.brand = '.$brand;
	}
	if ($yearstart > 0) {
		if ($condition != "") {
			 $condition .= ' AND ';
		}
		$condition .= 'a.year >= '.$yearstart;
	}
	if ($engine != 0 && $engine !="") {
		if ($condition != "") {
			 $condition .= ' AND ';
		}
		$condition .= 'a.typeeng = '.$engine;		
	}
	
	if ($condition != "") {
			 $condition .= ' AND ';
	}
	$condition .= "a.category = '1'";		
	
	
	if ($condition) {
		$condition = "WHERE ".$condition;
	}
	
	return sql_all("SELECT a.*, c.name model, b.name brand
		FROM auto AS a
		LEFT JOIN cars AS c ON a.model = c.id
		LEFT JOIN brands AS b ON c.brand = b.id
		$condition
		LIMIT $start, $limit");
}

function register($login, $password, $name, $email, $tel1, $tel2 ,$city,$url, $yearsex,$business) {
	$login = mysql_real_escape_string($login);
	$password = mysql_real_escape_string($password);
	$name = mysql_real_escape_string($name);
	$email = mysql_real_escape_string($email);
	$tel1 = mysql_real_escape_string($tel1);
	$tel2 = mysql_real_escape_string($tel2);
	$city = mysql_real_escape_string($city);
	$url=mysql_real_escape_string($url);
	$yearsex = mysql_real_escape_string($yearsex);
	$business=mysql_real_escape_string($business);
	
	$ip = getenv('REMOTE_ADDR');
	sql_query("INSERT into `users` 
	(`login`, `password`, `lastlogin`,`ip`, `name`, `email`, `tel1`, `tel2`, `city`, `url`, `yearsex`, `business`) 
	VALUES ('$login', MD5('$password'),NOW(),'$ip', '$name', '$email', '$tel1', '$tel2','$city','$url', '$yearsex','$business')
	");
	
}
function save_user($userid, $password, $name, $email, $tel1, $tel2, $city, $url, $yearsex,$business) {

	$password = mysql_real_escape_string($password);
	$name = mysql_real_escape_string($name);
	$email = mysql_real_escape_string($email);
	$city = mysql_real_escape_string($city);
	$url=mysql_real_escape_string($url);
	$yearsex = mysql_real_escape_string($yearsex);
	$business=mysql_real_escape_string($business);
	
	if (!$password == ""){
		sql_query("UPDATE `users` SET 
		`password` = MD5('$password'),
		`name` = '$name',
		`email` = '$email',
		`tel1` = '$tel1',
		`tel2` = '$tel2',
		`city` = '$city', 
		`url` = '$url', 
		`yearsex` = '$yearsex',
		`business` = '$business' 
		WHERE `id`='$userid'");
	}
	else{
		sql_query("UPDATE `users` SET 
		`name` = '$name',
		`email` = '$email',
		`tel1` = '$tel1',
		`tel2` = '$tel2',
		`city` = '$city', 
		`url` = '$url', 
		`yearsex` = '$yearsex',
		`business` = '$business' 
		WHERE `id`='$userid'");
	}
	
}
function get_subscr_list() {
	return sql_all("SELECT * FROM users WHERE subscribe=1");
	
}
function get_new_car_list() {
	return sql_all("SELECT a.*, c.name model, b.name brand
		FROM auto AS a
		LEFT JOIN cars AS c ON a.model = c.id
		LEFT JOIN brands AS b ON c.brand = b.id
		WHERE TO_DAYS(NOW()) - TO_DAYS(date) <= 7
		&& `show`='1'");
}
function getusercars($id){
	$id = (int)$id;
	return sql_all("SELECT a.*, c.name model, b.name brand
		FROM auto AS a
		LEFT JOIN cars AS c ON a.model = c.id
		LEFT JOIN brands AS b ON c.brand = b.id
		WHERE `a`.`userid`='$id'
		ORDER BY a.`id` DESC");
}
function getallcars(){
	return sql_all("SELECT a.*, c.name model, b.name brand
		FROM auto AS a
		LEFT JOIN cars AS c ON a.model = c.id
		LEFT JOIN brands AS b ON c.brand = b.id
		ORDER BY a.`id` DESC");
}
function GetLastcars(){
	return sql_all("SELECT a.*, c.name model, b.name brand
		FROM auto AS a
		LEFT JOIN cars AS c ON a.model = c.id
		LEFT JOIN brands AS b ON c.brand = b.id
		WHERE a.category='0'
		ORDER BY rand()
		LIMIT 3");
	//WHERE `a`.`userid`='$id'
	
}
function getonaprovalcars(){
	return sql_all("SELECT a.*, c.name model, b.name brand
		FROM auto AS a
		LEFT JOIN cars AS c ON a.model = c.id
		LEFT JOIN brands AS b ON c.brand = b.id
		WHERE `a`.`show`='0'");
	
}
function autoapprove($id){
$id = (int)$id;
sql_query("UPDATE auto SET `show`='1' WHERE `id`='$id'");
}
//удаляем
function checkifusercar($id,$userid) {
	$res = sql_query("SELECT count(*) AS c FROM auto WHERE `userid` = '$userid' AND `id` = '$id'");
	$count = mysql_fetch_assoc($res);
	return ($count['c']);
}
function deleteusercar($id) {
	
	if(sql_query("DELETE FROM auto WHERE id = $id LIMIT 1")) {
	// deleting images --------------------------
	$it='1';
	while ($it<9)
	 {
	  $filename="../carimages/".$id."_".$it."m.jpg";
	  $filen="../carimages/".$id."_".$it.".jpg";
	if (file_exists($filename)) 
	    {
		unlink($filename);
		unlink($filen);
	    }
	  $it++;
	 }
	 //------------------
   }
}

function getAutoBrands($tip_cat){
$tip_cat = (int)$tip_cat;
	return sql_all("SELECT b.id, b.name, count(c.id) as col
			 FROM brands b
			 INNER JOIN cars c ON c.brand = b.id
		     INNER JOIN auto a ON a.model = c.id
		     WHERE a.tip_cat = ".$tip_cat."
			 GROUP BY b.id");
}
function checklogin($login){
	$login = mysql_real_escape_string($login);
	
	$res = sql_query("SELECT count(*) AS c FROM users WHERE login = '$login'");
	$count = mysql_fetch_assoc($res);
	return ($count['c']);
}
/*
 * выводим новости на главной
 * 
 */
function getMainNews() {
		return 
		sql_all("SELECT DATE_FORMAT(p.`date`, '%d.%m.%Y') AS `date`, DATE_FORMAT(p.`date`, '%H:%i') AS `time`, UNIX_TIMESTAMP(p.`date`) AS `unix`, p.id, p.`title`, p.`titleurl`, DATE_FORMAT(p.`date`, '%d.%m.%Y') AS `date`,
		n.`shorttext`
		FROM publications AS p
		LEFT JOIN news AS n ON p.connectid = n.id
		WHERE n.section = 'news'
		ORDER BY p.`date` DESC
		LIMIT 3");
	}
function getMainPress() {
		return 
		sql_all("SELECT DATE_FORMAT(p.`date`, '%d.%m.%Y') AS `date`, DATE_FORMAT(p.`date`, '%H:%i') AS `time`, UNIX_TIMESTAMP(p.`date`) AS `unix`, p.id, p.`title`, p.`titleurl`, DATE_FORMAT(p.`date`, '%d.%m.%Y') AS `date`,
		n.`shorttext`
		FROM publications AS p
		LEFT JOIN news AS n ON p.connectid = n.id
		WHERE n.section = 'press'
		ORDER BY p.`date` DESC
		LIMIT 2");
	}
function getMainJoke() {
		return 
		sql_one("SELECT DATE_FORMAT(p.`date`, '%d.%m.%Y') AS `date`, DATE_FORMAT(p.`date`, '%H:%i') AS `time`, UNIX_TIMESTAMP(p.`date`) AS `unix`, p.id, p.`title`, p.`titleurl`, DATE_FORMAT(p.`date`, '%d.%m.%Y') AS `date`,
		n.`shorttext`, p.`text`
		FROM publications AS p
		LEFT JOIN news AS n ON p.connectid = n.id
		WHERE n.section = 'joke'
		ORDER BY p.`date` DESC
		LIMIT 1");
	}
/*
SELECT b.id, b.name, count(c.id)
FROM brands b
INNER JOIN cars c ON c.brand = b.id
INNER JOIN auto a ON a.model = c.id
GROUP BY b.id
*/
	
function getsid($login, $email) {
	$login = mysql_escape_string($login);
	$email = mysql_real_escape_string($email);
	return sql_single_value("SELECT `session` FROM `users` WHERE `login` = '$login' && `email` = '$email'");
}	
	
function restorepass($sesid, $password) {
	$sesid = mysql_real_escape_string($sesid);
	$password = mysql_real_escape_string($password);
	sql_query("UPDATE users SET `password` = MD5('$password') WHERE `session` = '$sesid'");
}
function getcardata($id){
	return sql_one("SELECT `auto`.`kpp` as `kpp` ,`auto`.`color_salon`,`auto`.`id`,`auto`.`model`,`cars`.`name` as `car_name`,`brands`.`id` as `brand_id`,`brands`.`name` as `brand_name`,`typeeng`.`name` as `typeeng_name`,`typekyzov`.`name` as `typekyzov_name` ,`auto`.`topic`,`auto`.`price`, `auto`.`oldprice`,`auto`.`category`,`auto`.`year`,`auto`.`way`,`auto`.`tp`,`auto`.`obem`,`auto`.`diller`,`auto`.`foreign`,`auto`.`dilservice`,`auto`.`owners`,`auto`.`repair`,`auto`.`name`,`auto`.`surname`,`auto`.`city`,`auto`.`city2`,`auto`.`color`,`auto`.`tel`,`auto`.`show`,`auto`.`typekyzov`,`auto`.`content` ,`auto`.`kpp`,`auto`.`cash`,`auto`.`view_count`, `auto`.`vin`, `auto`.`title` ,`date`, `garanty` 
	FROM `auto`,`cars`,`brands`, `typeeng`, `typekyzov` WHERE `auto`.`id`='$id'&&`cars`.`id`=`auto`.`model`&&`brands`.`id`=`cars`.`brand`&&`typeeng`.`id`=`auto`.`typeeng`&&`typekyzov`.`id`=`auto`.`typekyzov`");
	
}
function getcardata_new($id){
	return sql_all("SELECT * FROM `auto` WHERE id='$id'");
	
}
function faq_insert($name, $email, $city, $category, $message, $userid) {
	$name = mysql_escape_string($name);
	$email = mysql_escape_string($email);
	$city = mysql_escape_string($city);
	$message = mysql_escape_string($message);
	$category =(int)$category;
	$userid = (int)$userid;
	$ip = getenv('REMOTE_ADDR');

	sql_query("INSERT into `faq` 
	(`name`, `email`, `city`,`message`, `category`, `ip`, `date`, `userid`) 
	VALUES ('$name', '$email', '$city', '$message', '$category','$ip', NOW(), '$userid')");
}

function faq_list ($category, $page){

	$category =(int)$category;
	$page = (int)$page;
		if ($page < 1) {
		$page = 1;
	}
	$limit = 12; 
	$start = ($page - 1) * $limit;
	
	//example
	$res = sql_all("SELECT SQL_CALC_FOUND_ROWS  * 
	FROM `faq` 
	WHERE `category` = '$category'&&`approved`='1'
	ORDER BY `date` DESC LIMIT $start,$limit");
	$count_rows = sql_one("SELECT FOUND_ROWS() c");
	return array($count_rows['c'], $res);
}

function faq_alist ($page){

//	$category =(int)$category;
	$page = (int)$page;
		if ($page < 1) {
	$page = 1;
	}
	$limit = 15; 
	$start = ($page - 1) * $limit;
	//example
	$res = sql_all("SELECT SQL_CALC_FOUND_ROWS  * 
					FROM `faq` 
					LEFT JOIN `blocked_ip` ON `blocked_ip`.`blocked_ip`=`faq`.`ip` 
					ORDER BY `date` DESC 
					LIMIT $start,$limit");

	$count_rows = sql_one("SELECT FOUND_ROWS() c");
	return array($count_rows['c'], $res);
}

function faq_get ($id){

	$id = (int)$id;

	return sql_one("SELECT * FROM `faq`

	WHERE `id`='$id'");

}

function faq_save ($id, $name, $email, $city, $category, $message, $answer) {

	$id = (int)$id;

	$name = mysql_escape_string($name);

	$email = mysql_escape_string($email);

	$city = mysql_escape_string($city);

	$message = mysql_escape_string($message);

	$answer = mysql_escape_string($answer);

	$category =(int)$category;	

	sql_query("UPDATE `faq` SET `name` = '$name', `email`='$email', `city`='$city', `message`='$message', `category`='$category', `answer`='$answer' WHERE `id` = '$id'");

}

function faq_delete ($id) {

	$id = (int)$id;

	sql_query("DELETE FROM `faq` WHERE `id` = '$id' LIMIT 1");		

}
function faq_approve($id) {
	$id = (int)$id;
	sql_query("UPDATE `faq` SET `approved`='1' WHERE `id` = '$id' LIMIT 1");		
}
function faq_disapprove($id) {
	$id = (int)$id;
	sql_query("UPDATE `faq` SET `approved`='0' WHERE `id` = '$id' LIMIT 1");		
}
function faq_block_ip ($ip) {

	$id = (int)$id;

	sql_query("INSERT INTO `blocked_ip`(`blocked_ip`) VALUES ('$ip')");		

}

function checkIp($ip){

	$ip = mysql_escape_string($ip);

	if (sql_one("SELECT `blocked_ip` FROM `blocked_ip` WHERE `blocked_ip` LIKE '$ip'"))	return 1;

	else	return 0;



}



function checkIpInFaq($ip){

	return sql_one("SELECT `ip` FROM `faq` WHERE `ip`='$ip'");

}



function getTimeFaq($ip){

	if ($res = sql_one("SELECT * FROM `faq` WHERE  `ip`='$ip' ORDER BY `id` DESC"))

		return strtotime($res['date']);

	else return false;

}



function dateDiff ($interval,$date1,$date2) {

    // получает количество секунд между двумя датами 

    $timedifference = $date2 - $date1;

    switch ($interval) {

        case 'w':

            $retval = bcdiv($timedifference,604800);

            break;

        case 'd':

            $retval = bcdiv($timedifference,86400);

            break;

        case 'h':

            $retval =bcdiv($timedifference,3600);

            break;

        case 'm':

            $retval = bcdiv($timedifference,60);

            break;

        case 's':

            $retval = $timedifference;

            break;

            

    }

    return $retval;

}
/*
/
/
*/
function get_user_data($userid) {
	return sql_one("SELECT * FROM users WHERE `id`='$userid'");
}
function tax_rf($month=01,$year=2005,$volume=0,$cost=0){

		$data['koef'] = 0;
		$data['diff'] = date("Y",time())-$year;
		if (date("n",time()) >= $month) $data['diff'] = $data['diff']+1;
			
		if ($data['diff'] <= 3){
			if($cost<325000) {$data['koef'] = 2.5; $data['type']=1;}
			elseif($cost<650000) {$data['koef'] = 3.5; $data['type']=1;}
			elseif($cost<1625000) {$data['koef'] = 5.5; $data['type']=1;}
			elseif($cost<3250000) {$data['koef'] = 7.5; $data['type']=1;}
			elseif($cost<6500000) {$data['koef'] = 15; $data['type']=1;}
			else {$data['koef']=20; $data['type'] = 1;}
		$r1 = $cost*0.48;
		$r2 = $volume*$data['koef']*36.65; //(1 euro = 36.65 rur)
		
		if ($r1>$r2) {$data['result'] = $r1; $data['type_1'] = 1;} else {$data['result'] = $r2; $data['type_1']=2;}
		} elseif ($data['diff']<=7){
			if ($volume<=1000) {$data['koef'] = 0.85; $data['type']=2;}
			elseif ($volume<=1500) {$data['koef'] = 1; $data['type']=2;}
			elseif ($volume<=1800) {$data['koef'] = 1.5; $data['type']=2;}	
			elseif ($volume<=2300) {$data['koef'] = 1.75; $data['type']=2;}
			elseif ($volume<=3000) {$data['koef'] = 2; $data['type']=2;}
			else {$data['koef'] = 2.25; $data['type'] = 2;}	
		$data['result'] = $volume*$data['koef']*36.65;
		} else{
			if ($volume <= 2500) {$data['koef'] = 2; $data['type'] = 3;}
			else {$data['koef'] = 3 ;$data['type'] = 3;}
		$data['result'] = $volume*$data['koef']*36.65;
		};
		if ($cost<=200000) $data['t'] = 500;
		elseif ($cost<=450000) $data['t'] = 1000;
		elseif ($cost<=1200000) $data['t'] = 2000;
		elseif ($cost<=2500000) $data['t'] = 5500;
		elseif ($cost<=5000000) $data['t'] = 7500;
		elseif ($cost<=10000000) $data['t'] = 20000;
		elseif ($cost<=30000000) $data['t'] = 50000;
		else $data['t'] = 100000;	
	
		$data['all'] = $data['result'] + $data['t'];
	return $data;
}
function getCopartList() {
	return sql_all("SELECT * FROM copart");
}
function getIAAIList () {
	return sql_all("SELECT * FROM iaai");
}
function getManheimList () {
	return sql_all("SELECT * FROM manheim");
}
function getUsaDelivCopart($city, $port) {
	$city =mysql_escape_string($city);
	if ($port=="f") $port = 'fl'; 
	else $port = 'ny';
	return sql_one("SELECT $port FROM copart WHERE `id` = '$city'");
}
function getUsaDelivManheim($city, $port) {
	$city =mysql_escape_string($city);
	if ($port=="f") $port = 'fl'; 
	else $port = 'ny';
	return sql_one("SELECT $port FROM manheim WHERE `id` = '$city'");
}
function GetDeliveryPlaces() {
	return sql_all("SELECT * FROM `delivery` ORDER BY `place` ASC");
}
function GetShippingLines() {
	return sql_all("SELECT name, url, sealine FROM shippinglines");	
}
function GetPartsNames() {
	return sql_all("SELECT DISTINCT(auto) from carparts ORDER BY auto ASC");	
}
function GetPartsNamesMake($make) {
	$make = mysql_real_escape_string($make);
	return sql_all("SELECT DISTINCT(auto) from carparts
	WHERE `auto` LIKE '$make%'
	ORDER BY auto ASC");	
}
function GetCarParts($part) {
	$part = mysql_real_escape_string($part);
	return sql_all("SELECT * FROM carparts WHERE `auto`='$part' ORDER BY part ASC");	
}
function GetCarPartPrice($part) {
	$part =intval($part);
	return sql_one("SELECT price, value, quantity FROM carparts WHERE `id`='$part' ORDER BY part ASC");	
}

function parcestrtosql ($string,$sqlescape=true) {
	// парсит строку в sql запрос, разделитель: ";"
	$pattern = '#([^;]*);([^;]*);([^;]*);([^;]*);([^;]*)#';
	
	preg_match($pattern,$string,$tmp);
	
	if (!isset($tmp[1])){
		return '';
	}
	$record = array();
	foreach ($tmp as $key =>$value) {
		$record[$key] = $sqlescape ? mysql_real_escape_string($value) : $value;
	}
	return "insert into `carparts` (`auto`, `part`, `quantity`, `price`, `value`) values ('$record[1]', '$record[2]', '$record[3]','$record[4]','$record[5]');";
}
function addmodeltobase($make, $model) {
	$make=(int)$make;
	$model=mysql_real_escape_string($model);
	sql_query("INSERT INTO `cars` (`brand`, `name`) values ('$make', '$model')");	
}
function ChechkIfExist($make, $model) {
	$res = sql_one("SELECT `brand`, `name` from `cars` where `brand`='$make' and `name`='$model'");
	if ($res) return false; else return true;
}
function centrobank_get_valute() {  
  //$fopen = fopen("http://www.cbr.ru/scripts/XML_daily.asp?date_req=".date("d/m/Y"), "r");
  //http://www.nbrb.by/Services/XmlExRates.aspx?ondate=3/7/2008  
  $fopen = fopen("http://www.nbrb.by/Services/XmlExRates.aspx?ondate=".date("d/m/Y"), "r");
  if (!$fopen) {  
    return array('<div style="background-color: #f9f9f9; padding:5px; border: 1px solid #a00;">Не удалось подключиться к центробанку. Валютная цена недоступна.</div>', '', '');  
    exit;  
  } else {  
    $text = "";  
    while (!feof ($fopen)) {  
      $text .= fgets($fopen, 4096);  
    }  
  }  
  fclose($fopen);  
  preg_match_all("#<Currency Id=\"([^\"]+)[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>([^<]+)#i", $text, $final_texts, PREG_SET_ORDER);
    
  foreach($final_texts as $final_text) {  
    
  	if($final_text[2] == 840) {  
      $kurs_dollar = str_replace(",", ".", $final_text[4]);  
    }  
    if($final_text[2] == 978) {  
    $kurs_euro = str_replace(",", ".", $final_text[4]);  
    } 
	 
  }  
  return array(null, $kurs_dollar, $kurs_euro);
  
  //return array($final_texts);  
} 
function getRandAvailibleAuto($limit) {
	$limit=(int)$limit;
	return sql_all("SELECT `auto`.`id`,`cars`.`name` as `car_name`,`brands`.`name` as `brand_name`,`auto`.`topic`,`auto`.`cash`,`auto`.`price`,`auto`.`oldprice`,`auto`.`year`,`auto`.`show`,`auto`.`category`,`date`, `way`, `kpp`, `color`, `obem` 
	FROM `auto`,`cars`,`brands` 
	WHERE `cars`.`id`=`auto`.`model`&&`brands`.`id`=`cars`.`brand` && `auto`.`show_in_main`=1 && `auto`.`prod`=0
	ORDER BY rand() LIMIT $limit");
}
function getRandAvailiblePlane($limit, $id) {
	$limit=(int)$limit;
	$id=(int)$id;
	return sql_all("SELECT * FROM `plane` WHERE `id`!=$id ORDER BY rand() LIMIT $limit");
}
function getRandAvailibleBoat($limit, $tip_cat, $id) {
	$limit=(int)$limit;
	$tip_cat=(int)$tip_cat;
	$id=(int)$id;
	return sql_all("SELECT * FROM `boat` WHERE `tip_cat`=$tip_cat && `id`!=$id ORDER BY rand() LIMIT $limit");
}
function getRandAvailibleMachinery($limit, $tip_cat, $id) {
	$limit=(int)$limit;
	$tip_cat=(int)$tip_cat;
	$id=(int)$id;
	return sql_all("SELECT * FROM `machinery` WHERE `tip_cat`=$tip_cat && `id`!=$id ORDER BY rand() LIMIT $limit");
}
function getRandAvailibleMoto($limit, $tip_cat, $id) {
	$limit=(int)$limit;
	$tip_cat=(int)$tip_cat;
	$id=(int)$id;
	return sql_all("SELECT * FROM `moto` WHERE `tip_cat`=$tip_cat && `id`!=$id ORDER BY rand() LIMIT $limit");
}
function getRandAvailibleSpares($limit, $tip_cat, $id) {
	$limit=(int)$limit;
	$tip_cat=(int)$tip_cat;
	$id=(int)$id;
	return sql_all("SELECT * FROM `spares` WHERE `tip_cat`=$tip_cat && `id`!=$id ORDER BY rand() LIMIT $limit");
}
function getRandAvailibleProduct($limit, $id) {
	$limit=(int)$limit;
	$id=(int)$id;
	return sql_all("SELECT * FROM `product` WHERE `id`!=$id ORDER BY rand() LIMIT $limit");
}
function getRandAvailibleCar($limit, $tip_cat, $id) {
	$limit=(int)$limit;
	$tip_cat=(int)$tip_cat;
	$id=(int)$id;
	return sql_all("SELECT `auto`.`id`,`cars`.`name` as `car_name`,`brands`.`name` as `brand_name`,`auto`.`topic`,`auto`.`cash`,`auto`.`price`,`auto`.`oldprice`,`auto`.`year`,`auto`.`show`,`auto`.`category`,`date`, `way`, `kpp`, `color`, `obem` 
	FROM `auto`,`cars`,`brands` 
	WHERE `cars`.`id`=`auto`.`model`&&`brands`.`id`=`cars`.`brand` && `auto`.`show_in_main`=1 && `auto`.`prod`=0 && `tip_cat`=$tip_cat && `auto`.`id`!=$id
	ORDER BY rand() LIMIT $limit");
}
function searchFaq($good) {
$good = mysql_real_escape_string($good);
$query = "SELECT * FROM `faq` WHERE `message` LIKE '%". str_replace(" ", "%' OR message LIKE '%", $good). "%'or `answer`LIKE '%". str_replace(" ", "%' OR answer LIKE '%", $good). "%'&&`category`='2'&&`approved`='1'";

return sql_all($query);
}
///////////////////
function getPublication($url, $lang) {
	$url = mysql_real_escape_string($url);
	$lang = mysql_real_escape_string($lang);
	
	return sql_all("SELECT * FROM `text_content` WHERE `url`='$url' && (`lang`='$lang' || `lang`='top')");
}
function getPublicationById($id) {
	$id = (int)$id;
	return sql_all("SELECT * FROM `text_content` WHERE `id`='$id'");
}
function getDealerPublicationById($id) {
	$id = (int)$id;
	return sql_all("SELECT * FROM `text_dealers` WHERE `id`='$id'");
}

function deletePublication($id) {
	$id = (int)$id;
	sql_query("DELETE FROM `text_content` WHERE `id`='$id' LIMIT 1");
}
function deleteDealerPublication($id, $uid) {
	$id = (int)$id;
	$uid = (int)$uid;
	sql_query("DELETE FROM `text_dealers` WHERE `id`='$id'&&`uid`='$uid' LIMIT 1");
}
function getPublicationsList() {
	return sql_all("SELECT * FROM `text_content` ORDER BY `ves`,`date` DESC");
}
function getPagesList() {
	return sql_all("SELECT * FROM `text_content` `t` WHERE `t`.`ves`>0 AND `t`.`url` != '404' AND `t`.`url` != 'main' AND `t`.`url` != 'auctions' AND `t`.`url` != 'contact' AND `t`.`url` != 'faq' ORDER BY `t`.`ves` ASC");
}
function getDealerPublicationsList($id) {
	$id = (int)$id;
	return sql_all("SELECT * FROM `text_dealers` WHERE `uid`='$id' ORDER BY `date` DESC");
}
function getPublicationsLangs() {
	return sql_all("SELECT DISTINCT `lang` from `text_content`");
}
function getDealerPublicationsLangs($id) {
	$id = (int)$id;
	return sql_all("SELECT DISTINCT `lang` from `text_dealers` WHERE `uid`='$id'");
}
function addPublication($url, $title, $keywords, $description, $content, $lang) {
	$url = mysql_real_escape_string($url);
	$title = mysql_real_escape_string($title);
	$keywords = mysql_real_escape_string($keywords);
	$description = mysql_real_escape_string($description);
	$content = mysql_real_escape_string($content);
	$lang = mysql_real_escape_string($lang);
	
	sql_query("INSERT INTO `text_content` (`url`, `title`, `keywords`, `description`, `content`, `date`, `lang`) VALUES ('$url', '$title', '$keywords', '$description', '$content', NOW(), '$lang')");
}
function addDealerPublication($url, $title, $keywords, $description, $content, $lang, $uid) {
	$uid = (int)$uid;
	$url = mysql_real_escape_string($url);
	$title = mysql_real_escape_string($title);
	$keywords = mysql_real_escape_string($keywords);
	$description = mysql_real_escape_string($description);
	$content = mysql_real_escape_string($content);
	$lang = mysql_real_escape_string($lang);
	
	sql_query("INSERT INTO `text_dealers` (`url`, `title`, `keywords`, `description`, `content`, `date`, `lang`, `uid`) VALUES ('$url', '$title', '$keywords', '$description', '$content', NOW(), '$lang', '$uid')");
}

function updatePublication ($id, $url, $title, $keywords, $description, $content, $lang) {
	$id = (int)$id;
	$url = mysql_real_escape_string($url);
	$title = mysql_real_escape_string($title);
	$keywords = mysql_real_escape_string($keywords);
	$description = mysql_real_escape_string($description);
	$content = mysql_real_escape_string($content);
	$lang = mysql_real_escape_string($lang);
	
	sql_query("UPDATE `text_content` SET
	`url`='$url',
	`title`='$title',
	`keywords`='$keywords',
	`description`='$description',
	`content`='$content',
	`lang`='$lang'
	WHERE `id`='$id'");	
} 
function updateShowAutoOk ($id) {
	$id = (int)$id;
	sql_query("UPDATE `auto` SET
	`show_in_main`=1
	WHERE `id`='$id'");	
} 
function updateShowAutoNo ($id) {
	$id = (int)$id;
	sql_query("UPDATE `auto` SET
	`show_in_main`=0
	WHERE `id`='$id'");	
} 
function updateShowBoatOk ($id) {
	$id = (int)$id;
	sql_query("UPDATE `boat` SET
	`show`=1
	WHERE `id`='$id'");	
} 
function updateShowBoatNo ($id) {
	$id = (int)$id;
	sql_query("UPDATE `boat` SET
	`show`=0
	WHERE `id`='$id'");	
} 
function updateShowMotoOk ($id) {
	$id = (int)$id;
	sql_query("UPDATE `moto` SET
	`show`=1
	WHERE `id`='$id'");	
} 
function updateShowMotoNo ($id) {
	$id = (int)$id;
	sql_query("UPDATE `moto` SET
	`show`=0
	WHERE `id`='$id'");	
} 
function updateAdminAuto ($id) {
	$id = (int)$id;
	sql_query("UPDATE `auto` SET
	`admin`=1
	WHERE `id`='$id'");	
} 
function updateAdminBoat ($id) {
	$id = (int)$id;
	sql_query("UPDATE `boat` SET
	`admin`=1
	WHERE `id`='$id'");	
} 
function updateAdminMoto ($id) {
	$id = (int)$id;
	sql_query("UPDATE `moto` SET
	`admin`=1
	WHERE `id`='$id'");	
} 
function updateAdminMachinery ($id) {
	$id = (int)$id;
	sql_query("UPDATE `machinery` SET
	`admin`=1
	WHERE `id`='$id'");	
} 
function updateAdminProducts ($id) {
	$id = (int)$id;
	sql_query("UPDATE `product` SET
	`admin`=1
	WHERE `id`='$id'");	
} 
function updateAdminSpares ($id) {
	$id = (int)$id;
	sql_query("UPDATE `spares` SET
	`admin`=1
	WHERE `id`='$id'");	
} 
function updateAdminPlane ($id) {
	$id = (int)$id;
	sql_query("UPDATE `plane` SET
	`admin`=1
	WHERE `id`='$id'");	
} 
function updateDealerPublication ($id, $url, $title, $keywords, $description, $content, $lang, $uid) {
	$id = (int)$id;
	$uid = (int)$uid;
	$url = mysql_real_escape_string($url);
	$title = mysql_real_escape_string($title);
	$keywords = mysql_real_escape_string($keywords);
	$description = mysql_real_escape_string($description);
	$content = mysql_real_escape_string($content);
	$lang = mysql_real_escape_string($lang);
	
	sql_query("UPDATE `text_content` SET
	`url`='$url',
	`title`='$title',
	`keywords`='$keywords',
	`description`='$description',
	`content`='$content',
	`lang`='$lang'
	WHERE `id`='$id'&&`uid`='$uid' LIMIT 1");	
} 

//

function getUsersList() {
	return sql_all("SELECT * FROM `users` WHERE `dealer`='0'");
}
function getModerateDealers() {
	return sql_all("SELECT * FROM `users` WHERE `dealer`='1'&&`active`='0'");
}
function getAllDealers() {
	return sql_all("SELECT * FROM `users` WHERE `dealer`='1'&&`active`='1'");
}
function deleteUserFromBase($id) {
	$id=(int)$id;
	sql_query("DELETE FROM `users` WHERE `id`='$id' LIMIT 1");
}
function acceptDealer($id) {
	$id=(int)$id;
	sql_query("UPDATE `users` SET `active`='1' WHERE `id`='$id' LIMIT 1");
}
function deAcceptDealer($id) {
	$id=(int)$id;
	sql_query("UPDATE `users` SET `active`='0' WHERE `id`='$id' LIMIT 1");
	
}

function addOrderToBase($email, $title, $name, $url,$phone, $dealerid) {
	
	$email =mysql_real_escape_string($email); 
	$title =mysql_real_escape_string($title);
	$name =mysql_real_escape_string($name);
	$url = mysql_real_escape_string($url);
	$phone =mysql_real_escape_string($phone);
	$dealerid = (int)$dealerid;
	
	sql_query("INSERT INTO `orders` (`email`, `title`, `name`, `url`, `phone`, `dealerid`)
	values ('$email', '$title', '$name', '$url', '$phone', '$dealerid')");
}

function getOrdersList() {
	return sql_all("SELECT `orders`.*, `users`.`login` FROM `orders` LEFT JOIN `users` on `orders`.`dealerid`=`users`.`id`");
}
function delOrderFromBase($id) {
	$id=(int)$id;
	sql_query("DELETE FROM `orders` WHERE `id`='$id' LIMIT 1");
}

function addProduct($name, $price, $currency, $description, $bestoffers, $for_free_text, $model, $sost, $kol, $userid){
	$userid = (int)$userid;
	$name = mysql_real_escape_string($name);
	$currency = mysql_real_escape_string($currency);
	$description = mysql_real_escape_string($description);
	$model = mysql_real_escape_string($model);
	$sost = mysql_real_escape_string($sost);
	$kol = (int)$kol;
	$price = (int)$price;
	$bestoffers = (int)$bestoffers;
	sql_query("INSERT INTO `product` (`name`, `price`, `currency`, `description`, `date`, `bestoffers`, `for_free_text`, `model`, `sost`, `kol`, `uid`) VALUES ('$name', $price, '$currency', '$description', now(),'$bestoffers','$for_free_text','$model','$sost','$kol', '$userid')");
	return mysql_insert_id();
}
function editProduct($id, $name, $price, $currency, $description, $bestoffers, $for_free_text, $model, $sost, $kol){
	$name = mysql_real_escape_string($name);
	$currency = mysql_real_escape_string($currency);
	$description = mysql_real_escape_string($description);
	$price = (int)$price;
	$bestoffers = (int)$bestoffers;
	$model = mysql_real_escape_string($model);
	$sost = mysql_real_escape_string($sost);
	$kol = (int)$kol;
	sql_query("UPDATE `product` SET `name`='$name', `price`=$price, `currency` = '$currency', `bestoffers` = '$bestoffers', `for_free_text` = '$for_free_text', `model` = '$model', `sost` = '$sost', `kol` = $kol WHERE `id`=$id");
}
function delProduct($id){
	sql_query("DELETE FROM `product` WHERE `id` = $id LIMIT 1");
}
function getProduct($id){
	return sql_one("SELECT * FROM `product` where `id` = $id");
}
function listProducts($page){
	$page = (int)$page;
	if ($page < 1) {
		$page = 1;
	}
	$limit = 100; 
	$start = ($page - 1) * $limit;
		
	$res = sql_all("SELECT SQL_CALC_FOUND_ROWS * FROM `product` ORDER BY `date` DESC LIMIT $start, $limit");

	$count_rows = sql_one("SELECT FOUND_ROWS() c");
	return array($count_rows['c'], $res);
}
function listLastProducts($limit){
	return sql_all("SELECT * FROM `product` ORDER BY `date` DESC LIMIT $limit");
}
function getConditions(){
	return sql_all("SELECT * FROM `conditions`");
}
function getPartners(){
	return sql_all("SELECT * FROM `partners`");
}
function getNavigation(){
return sql_all("SELECT * FROM `text_content` WHERE `ves`>=0 ORDER BY `ves`");
}
function addPartners($title, $url, $photo, $width, $height){
	$title = mysql_real_escape_string($title);
	$url = mysql_real_escape_string($url);
	$photo = mysql_real_escape_string($photo);
	$width = (int)$width;
	$height = (int)$height;
	sql_query("insert into `partners` (name, url, pic, width, height)
	values
	('$title', '$url', '$photo', $width, $height)");
}
function editPartn($id, $title, $url, $photo, $width, $height){
	$title = mysql_real_escape_string($title);
	$url = mysql_real_escape_string($url);
	$photo = mysql_real_escape_string($photo);
	$id = (int)$id;
	$width = (int)$width;
	$height = (int)$height;
	sql_query("UPDATE `partners` SET `name`='$title', `url`='$url', `pic` = '$photo', `width` = '$width', `height` = '$height' WHERE `id`=$id");
}
function editPartn22($id, $title, $url){
	$title = mysql_real_escape_string($title);
	$url = mysql_real_escape_string($url);
	$photo = mysql_real_escape_string($photo);
	$id = (int)$id;
	$width = (int)$width;
	$height = (int)$height;
	sql_query("UPDATE `partners` SET `name`='$title', `url`='$url' WHERE `id`=$id");
}
function getAutoCondition($auto_id){
	$auto_id = (int)$auto_id;
	return sql_one("SELECT * FROM `auto_condition` WHERE `auto_id` = $auto_id");
}
function addAutoCondition($auto_id, $conditions){
	$auto_id = (int)$auto_id;
	$condition_names = getConditions();
	$query = "INSERT INTO `auto_condition` (";
	foreach ($condition_names as $cn){
		$query .= "`".$cn['name_db']."`, ";
	}	
	$query .= "`auto_id`) VALUES (";
	foreach ($conditions as $c){
		$query .= $c.", ";
	}	
	$query .= "$auto_id)";
	sql_query($query);
}
function updateAutoCondition($auto_id, $conditions){
	$auto_id = (int)$auto_id;
	$condition_names = getConditions();
	$query = "UPDATE `auto_condition` SET ";
	$i = 1;
	foreach ($condition_names as $c){
		$query .= "`".$c['name_db']."` = ".$conditions[$c['id']];
		if ($c['name_db'] != 'transmission') $query .= ", ";
	}		
	$query .= " WHERE `auto_id` = $auto_id";
	sql_query($query);
}
function delAutoCondition($auto_id){
	$auto_id = (int)$auto_id;
	sql_query("DELETE FROM `auto_condition` WHERE `auto_id` = $auto_id LIMIT 1");
}
function setRestore($login, $rand){
	if (sql_one("SELECT * FROM `restore` WHERE `login`='$login'")){
		return sql_query("UPDATE `restore` SET `rand`=MD5('$rand'), `datetime`=NOW() WHERE `login`='$login'");
	}
	else{
		return sql_query("INSERT INTO `restore` (`login`,`rand`,`datetime`) VALUES ('$login',MD5('$rand'), NOW())");
	}
}
function getRestore($login, $rand){
	return sql_one("SELECT * FROM `restore` WHERE `login`='$login' AND `rand`=MD5('$rand')");
}
function changePass($login, $password){
	return sql_query("UPDATE `users` SET `password`=MD5('$password') WHERE `login`='$login'");
}
function deleteRestore($login, $rand){
	return sql_query("DELETE FROM `restore` WHERE `login`='$login' AND `rand`=MD5('$rand')");
}
function getUserEmailByLogin($login){
	return sql_one("SELECT `email` FROM `users` WHERE `login`='$login'");
}
function delPartn($id){
	$id = (int)$id;
	sql_query("DELETE FROM `partners` WHERE `id` = $id LIMIT 1");
}
function getPartnById($id){
	return sql_one("SELECT * FROM `partners` WHERE `id` = $id");
}
function getAllpublicationsbyVes(){
	return sql_all("SELECT * FROM `text_content` order by ves, id");
}
function getAllpublicationsbyVes_Lang($lang){
	$lang = mysql_real_escape_string($lang);
	return sql_all("SELECT * FROM `text_content` WHERE `lang` = '$lang' order by ves, id");
}

function getAllpublicationsbyVesbyId($id){
	return sql_one("SELECT * FROM `text_content` WHERE `id` = $id");
}
function editleftnav($id, $title, $ves){
	$title = mysql_real_escape_string($title);
	$ves = mysql_real_escape_string($ves);
	$id = (int)$id;
	sql_query("UPDATE `text_content` SET `title`='$title', `ves`='$ves' WHERE `id`=$id");
}
function prod_car1 ($id) {

	$id = (int)$id;

	sql_query("UPDATE `auto` SET `prod` = 1 WHERE `id` = '$id'");

}
function prod_car2 ($id) {

	$id = (int)$id;

	sql_query("UPDATE `auto` SET `prod` = 0 WHERE `id` = '$id'");

}
function addMoto($tip_cat, $uid, $mark, $model, $year, $color, $tip_dv, $obem, $prob, $tprob, $cost, $option, $oth_inf, $time, $pic1, $pic2, $pic3, $pic4, $pic5, $pic6, $pic7, $pic8, $pic9, $pic10, $title, $vin, $raspol, $for_free_text , $for_free_link, $sost1, $sost2, $sost3, $sost4, $sost5, $sost6, $pic11, $pic12, $pic13, $pic14, $pic15, $pic16, $pic17, $pic18, $pic19, $pic20, $pic21){
$uid = (int)$uid;
$year = (int)$year;
$prob = (int)$prob;
$cost = (int)$cost;
$tip_cat = (int)$tip_cat;
$for_free_text = mysql_real_escape_string($for_free_text);
$option = mysql_real_escape_string($option);
$oth_inf = mysql_real_escape_string($oth_inf);
$mark = mysql_real_escape_string($mark);
$model = mysql_real_escape_string($model);
	 sql_query("insert into `moto` 
	(`tip_cat`, `uid`, `mark`, `model`, `year`, `color`, `tip_dv`, `obem`, `prob`, `tprob`, `cost`, `option`, `oth_inf`, `time`, `pic1`, `pic2`, `pic3`, `pic4`, `pic5`, `pic6`, `pic7`, `pic8`, `pic9`, `pic10`, `title`, `vin`, `raspol`, `for_free_text`, `for_free_link`, `sost_1`, `sost_2`, `sost_3`, `sost_4`, `sost_5`, `sost_6`, `pic11`, `pic12`, `pic13`, `pic14`, `pic15`, `pic16`, `pic17`, `pic18`, `pic19`, `pic20`, `pic21`)
	values
	('$tip_cat', '$uid', '$mark', '$model', '$year', '$color', '$tip_dv', '$obem', '$prob', '$tprob', '$cost', '$option', '$oth_inf', '$time', '$pic1', '$pic2', '$pic3', '$pic4', '$pic5', '$pic6', '$pic7', '$pic8', '$pic9', '$pic10', '$title', '$vin', '$raspol', '$for_free_text', '$for_free_link', '$sost1', '$sost2', '$sost3', '$sost4', '$sost5', '$sost6', '$pic11', '$pic12', '$pic13', '$pic14', '$pic15', '$pic16', '$pic17', '$pic18', '$pic19', '$pic20', '$pic21')");
return mysql_insert_id();
	}


function getAllMotobyAdmin($tip_cat){
$tip_cat = (int)$tip_cat;
	return sql_all("SELECT * FROM `moto` WHERE `tip_cat`= $tip_cat order by admin DESC, id DESC");
}
function getAllMotobyAdminSpis(){
$tip_cat = (int)$tip_cat;
	return sql_all("SELECT * FROM `moto` order by id");
}
function getAllMotobyID($id){
$id = (int)$id;
	return sql_all("SELECT * FROM `moto` WHERE `uid`=$id order by id");
}
function getAllMotobyID1($id){
$id = (int)$id;
	return sql_one("SELECT * FROM `moto` WHERE `id`=$id");
}
function delMotobyID($id){
$id = (int)$id;
	sql_query("DELETE FROM `moto` WHERE `id` = $id LIMIT 1");
}
function prodMoto($id){
$id = (int)$id;
	sql_query("UPDATE `moto` SET `prod` = 1 WHERE `id` = '$id'");
}
function unprodMoto($id){
$id = (int)$id;
	sql_query("UPDATE `moto` SET `prod` = 0 WHERE `id` = '$id'");
}
function prosmMoto($id,$prosm){
$id = (int)$id;
$prosm = (int)$prosm;
$prosm = $prosm+1;
	sql_query("UPDATE `moto` SET `prosm` = $prosm WHERE `id` = '$id'");
}
function updMotoInf($id, $mark, $model, $year, $color, $tip_dv, $obem, $prob, $tprob, $cost, $option, $oth_inf, $title, $vin, $tip_cat, $raspol, $for_free_text , $for_free_link, $sost1, $sost2, $sost3, $sost4, $sost5, $sost6){
$id = (int)$id;
$for_free_text = mysql_real_escape_string($for_free_text);
$option = mysql_real_escape_string($option);
$oth_inf = mysql_real_escape_string($oth_inf);
$cost = mysql_real_escape_string($cost);
$mark = mysql_real_escape_string($mark);
$model = mysql_real_escape_string($model);
sql_query("UPDATE `moto` SET `tip_cat`='$tip_cat', `title`='$title', `vin`='$vin', `mark`='$mark', `model`='$model', `year`='$year', `color`='$color', `tip_dv`='$tip_dv', `obem`='$obem', `prob`='$prob', `tprob`='$tprob', `oth_inf`='$oth_inf', `cost`='$cost', `option`='$option', `raspol`='$raspol', `for_free_text`='$for_free_text', `for_free_link`='$for_free_link', `sost_1`='$sost1', `sost_2`='$sost2', `sost_3`='$sost3', `sost_4`='$sost4', `sost_5`='$sost5', `sost_6`='$sost6' WHERE `id`=$id");
}
function updMotoFoto($id, $pic1, $pic2, $pic3, $pic4, $pic5, $pic6, $pic7, $pic8, $pic9, $pic10, $pic11, $pic12, $pic13, $pic14, $pic15, $pic16, $pic17, $pic18, $pic19, $pic20, $pic21){
$id = (int)$id;
sql_query("UPDATE `moto` SET `pic1`='$pic1', `pic2`='$pic2', `pic3`='$pic3', `pic4`='$pic4', `pic5`='$pic5', `pic6`='$pic6', `pic7`='$pic7', `pic8`='$pic8', `pic9`='$pic9', `pic10`='$pic10', `pic11`='$pic11', `pic12`='$pic12', `pic13`='$pic13', `pic14`='$pic14', `pic15`='$pic15', `pic16`='$pic16', `pic17`='$pic17', `pic18`='$pic18', `pic19`='$pic19', `pic20`='$pic20', `pic21`='$pic21' WHERE `id`=$id");
}
function delFoto($id, $pic){
$id = (int)$id;
sql_query("UPDATE `moto` SET `$pic`='' WHERE `id`=$id");
}
function getAllMotobyBrand($id, $tip_cat){
return sql_all("SELECT * FROM `moto` WHERE `mark`='$id' AND `tip_cat`='$tip_cat' order by admin DESC");
}
function getAllMotoMain(){
return sql_all("SELECT 	* FROM `moto` WHERE `show`=1 AND `prod`=0 order by id DESC limit 20 ");
}
function getAllAutoMain($id){
$id=(int)$id;
return sql_all("SELECT 	* FROM `auto` WHERE `show_in_main`=1 AND `prod`=0 AND `id`!=$id order by id DESC");
}


function getAllBoatbyAdmin($tip_cat){
	return sql_all("SELECT * FROM `boat` WHERE `tip_cat`=$tip_cat order by id DESC, admin ");
}
function getAllBoatbyAdminSpis(){
	return sql_all("SELECT * FROM `boat` order by id");
}
function getAllBoatbyID($id){
$id = (int)$id;
	return sql_all("SELECT * FROM `boat` WHERE `uid`=$id order by id");
}
function getAllBoatbyID1($id, $tip_cat){
$id = (int)$id;
$tip_cat = (int)$tip_cat;
	return sql_one("SELECT * FROM `boat` WHERE `id`=$id");
}
function delBoatbyID($id){
$id = (int)$id;
	sql_query("DELETE FROM `boat` WHERE `id` = $id LIMIT 1");
}
function prodBoat($id){
$id = (int)$id;
	sql_query("UPDATE `boat` SET `prod` = 1 WHERE `id` = '$id'");
}
function unprodBoat($id){
$id = (int)$id;
	sql_query("UPDATE `boat` SET `prod` = 0 WHERE `id` = '$id'");
}
function prosmBoat($id,$prosm){
$id = (int)$id;
$prosm = (int)$prosm;
$prosm = $prosm+1;
	sql_query("UPDATE `boat` SET `prosm` = $prosm WHERE `id` = '$id'");
}
function updBoatInf($id, $brand, $name, $tip_boat, $vin, $title, $year, $prod, $prosm, $cost, $time, $length, $width, $height, $places, $topl_potr, $dvig, $oth_inf, $option, $tip_cat, $raspol, $for_free_text , $for_free_link){
$id = (int)$id;
$for_free_text = mysql_real_escape_string($for_free_text);
$option = mysql_real_escape_string($option);
$oth_inf = mysql_real_escape_string($oth_inf);
$cost = mysql_real_escape_string($cost);
$brand = mysql_real_escape_string($brand);
$name = mysql_real_escape_string($name);
sql_query("UPDATE `boat` SET `brand`='$brand', `name`='$name', `tip_boat`='$tip_boat', `vin`='$vin', `title`='$title', `year`='$year', `prosm`='$prosm', `cost`='$cost', `time`='$time', `length`='$length', `width`='$width', `height`='$height', `places`='$places', `topl_potr`='$topl_potr', `dvig`='$dvig', `oth_inf`='$oth_inf', `option`='$option', `tip_cat`='$tip_cat', `raspol`='$raspol', `for_free_text`='$for_free_text', `for_free_link`='$for_free_link' WHERE `id`=$id");
}
function updBoatFoto($id, $pic1, $pic2, $pic3, $pic4, $pic5, $pic6, $pic7, $pic8, $pic9, $pic10, $pic11, $pic12, $pic13, $pic14, $pic15, $pic16, $pic17, $pic18, $pic19, $pic20, $pic21){
$id = (int)$id;
sql_query("UPDATE `boat` SET `pic1`='$pic1', `pic2`='$pic2', `pic3`='$pic3', `pic4`='$pic4', `pic5`='$pic5', `pic6`='$pic6', `pic7`='$pic7', `pic8`='$pic8', `pic9`='$pic9', `pic10`='$pic10', `pic11`='$pic11', `pic12`='$pic12', `pic13`='$pic13', `pic14`='$pic14', `pic15`='$pic15', `pic16`='$pic16', `pic17`='$pic17', `pic18`='$pic18', `pic19`='$pic19', `pic20`='$pic20', `pic21`='$pic21' WHERE `id`=$id");
}
function delBoat($id, $pic){
$id = (int)$id;
sql_query("UPDATE `boat` SET `$pic`='' WHERE `id`=$id");
}
function getAllBoatbyBrand($id, $tip_cat){
return sql_all("SELECT * FROM `boat` WHERE `brand`='$id' AND `tip_cat`='$tip_cat' order by admin DESC");
}
function getAllBoatMain($tip_cat){
return sql_all("SELECT 	* FROM `boat` WHERE `show`=1 AND `prod`=0 order by id DESC limit 20 ");
}


function addBoat($uid, $brand, $name, $tip_boat, $vin, $title, $year, $prod, $prosm, $cost, $time, $length, $width, $height, $places, $topl_potr, $dvig, $oth_inf, $option, $pic1, $pic2, $pic3, $pic4, $pic5, $pic6, $pic7, $pic8, $pic9, $pic10, $tip_cat, $raspol, $for_free_text , $for_free_link, $pic11, $pic12, $pic13, $pic14, $pic15, $pic16, $pic17, $pic18, $pic19, $pic20, $pic21){
$for_free_text = mysql_real_escape_string($for_free_text);
$option = mysql_real_escape_string($option);
$oth_inf = mysql_real_escape_string($oth_inf);
$cost = mysql_real_escape_string($cost);
$brand = mysql_real_escape_string($brand);
$name = mysql_real_escape_string($name);
	 sql_query("insert into `boat` 
	(`uid`, `brand`, `name`, `tip_boat`, `vin`, `title`, `year`, `prod`, `prosm`, `cost`, `time`, `length`, `width`, `height`, `places`, `topl_potr`, `dvig`, `oth_inf`, `option`, `pic1`, `pic2`, `pic3`, `pic4`, `pic5`, `pic6`, `pic7`, `pic8`, `pic9`, `pic10`, `tip_cat`, `raspol`, `for_free_text`, `for_free_link`, `pic11`, `pic12`, `pic13`, `pic14`, `pic15`, `pic16`, `pic17`, `pic18`, `pic19`, `pic20`, `pic21`)
	values
	('$uid', '$brand', '$name', '$tip_boat', '$vin', '$title', '$year', '$prod', '$prosm', '$cost', '$time', '$length', '$width', '$height', '$places', '$topl_potr', '$dvig', '$oth_inf', '$option', '$pic1', '$pic2', '$pic3', '$pic4', '$pic5', '$pic6', '$pic7', '$pic8', '$pic9', '$pic10', '$tip_cat', '$raspol', '$for_free_text', '$for_free_link', '$pic11', '$pic12', '$pic13', '$pic14', '$pic15', '$pic16', '$pic17', '$pic18', '$pic19', '$pic20', '$pic21')");
return mysql_insert_id();
	}
function getAllCarsModels(){
return sql_all("SELECT 	* FROM `brands` order by id");
}
function getAllCarsBrands(){
return sql_all("SELECT 	* FROM `cars` order by id");
}
function addNewCarMark($mark){
	 sql_query("insert into `brands` 
	(`name`)
	values
	('$mark')");
}
function addNewCarModel($model, $id){
$id = (int)$id;
	 sql_query("insert into `cars` 
	(`name`, `brand`)
	values
	('$model', $id)");
}









//plane



function getAllPlanebyAdmin(){
	return sql_all("SELECT * FROM `plane` order by id DESC, admin");
}
function getAllPlanebyID($id){
$id = (int)$id;
	return sql_all("SELECT * FROM `plane` WHERE `uid`=$id order by id");
}
function getAllPlanebyID1($id){
$id = (int)$id;
	return sql_one("SELECT * FROM `plane` WHERE `id`=$id");
}
function delPlanebyID($id){
$id = (int)$id;
	sql_query("DELETE FROM `plane` WHERE `id` = $id LIMIT 1");
}
function delCarsMark($id){
$id = (int)$id;
	sql_query("DELETE FROM `brands` WHERE `id` = $id LIMIT 1");
}
function delCarsModel($id){
$id = (int)$id;
	sql_query("DELETE FROM `cars` WHERE `id` = $id LIMIT 1");
}
function delAllCarsModelByBrand($id){
$id = (int)$id;
	sql_query("DELETE FROM `cars` WHERE `brand` = $id");
}
function prodPlane($id){
$id = (int)$id;
	sql_query("UPDATE `plane` SET `prod` = 1 WHERE `id` = '$id'");
}
function unprodPlane($id){
$id = (int)$id;
	sql_query("UPDATE `plane` SET `prod` = 0 WHERE `id` = '$id'");
}
function prosmPlane($id,$prosm){
$id = (int)$id;
$prosm = (int)$prosm;
$prosm = $prosm+1;
	sql_query("UPDATE `plane` SET `prosm` = $prosm WHERE `id` = '$id'");
}
function updPlaneInf($id, $mark, $model, $cost, $tip, $option, $oth_inf, $year, $vin, $razm_krila, $length, $height, $pl_krila, $max_ves, $dvigatel, $vint, $emk_topl_bakov, $max_speed, $max_polet, $dalnost, $raspol, $for_free_text , $for_free_link){
$id = (int)$id;
$for_free_text = mysql_real_escape_string($for_free_text);
$option = mysql_real_escape_string($option);
$oth_inf = mysql_real_escape_string($oth_inf);

$cost = mysql_real_escape_string($cost);
$tip = mysql_real_escape_string($tip);

$razm_krila = (float)$razm_krila;
$length = (float)$length;
$height = (float)$height;
$pl_krila = (float)$pl_krila;
$max_ves = (float)$max_ves;

$dvigatel = mysql_real_escape_string($dvigatel);
$vint = mysql_real_escape_string($vint);


$mark = mysql_real_escape_string($mark);
$model = mysql_real_escape_string($model);
sql_query("UPDATE `plane` SET `mark`='$mark', `model`='$model', `cost`='$cost', `tip`='$tip', `option`='$option', `oth_inf`='$oth_inf', `year`='$year', `vin`='$vin', `razm_krila`='$razm_krila', `length`='$length', `height`='$height', `pl_krila`='$pl_krila', `max_ves`='$max_ves', `dvigatel`='$dvigatel', `vint`='$vint', `emk_topl_bakov`='$emk_topl_bakov', `max_speed`='$max_speed', `dalnost`='$dalnost', `raspol`='$raspol', `for_free_text`='$for_free_text', `for_free_link`='$for_free_link' WHERE `id`=$id");
}
function updPlaneFoto($id, $pic1, $pic2, $pic3, $pic4, $pic5, $pic6, $pic7, $pic8, $pic9, $pic10, $pic11, $pic12, $pic13, $pic14, $pic15, $pic16, $pic17, $pic18, $pic19, $pic20, $pic21){
$id = (int)$id;
sql_query("UPDATE `plane` SET `pic1`='$pic1', `pic2`='$pic2', `pic3`='$pic3', `pic4`='$pic4', `pic5`='$pic5', `pic6`='$pic6', `pic7`='$pic7', `pic8`='$pic8', `pic9`='$pic9', `pic10`='$pic10', `pic11`='$pic11', `pic12`='$pic12', `pic13`='$pic13', `pic14`='$pic14', `pic15`='$pic15', `pic16`='$pic16', `pic17`='$pic17', `pic18`='$pic18', `pic19`='$pic19', `pic20`='$pic20', `pic21`='$pic21' WHERE `id`=$id");
}
function delPlane($id, $pic){
$id = (int)$id;
sql_query("UPDATE `plane` SET `$pic`='' WHERE `id`=$id");
}
function getAllPlanebyBrand($id){
return sql_all("SELECT * FROM `plane` WHERE `mark`='$id' order by admin DESC");
}
function getAllPlaneMain(){
return sql_all("SELECT 	* FROM `plane` order by id DESC limit 20 ");
}


function addPlane($uid, $time, $mark, $model, $cost, $tip, $option, $oth_inf, $year, $vin, $razm_krila, $length, $height, $pl_krila, $max_ves, $dvigatel, $vint, $emk_topl_bakov, $max_speed, $max_polet, $dalnost, $pic1, $pic2, $pic3, $pic4, $pic5, $pic6, $pic7, $pic8, $pic9, $pic10, $raspol, $for_free_text , $for_free_link, $pic11, $pic12, $pic13, $pic14, $pic15, $pic16, $pic17, $pic18, $pic19, $pic20, $pic21){
	$uid = (int)$uid;
	//$tip_cat = (int)$tip_cat;
	$for_free_text = mysql_real_escape_string($for_free_text);
	$oth_inf = mysql_real_escape_string($oth_inf);
	$mark = mysql_real_escape_string($mark);
	$model = mysql_real_escape_string($model);
	 sql_query("insert into `plane` 
	(`uid`, `time`, `mark`, `model`, `cost`, `tip`, `option`, `oth_inf`, `year`, `vin`, `razm_krila`, `length`, `height`, `pl_krila`, `max_ves`, `dvigatel`, `vint`, `emk_topl_bakov`, `max_speed`, `dalnost`, `max_polet`, `pic1`, `pic2`, `pic3`, `pic4`, `pic5`, `pic6`, `pic7`, `pic8`, `pic9`, `pic10`, `raspol`, `for_free_text`, `for_free_link`, `pic11`, `pic12`, `pic13`, `pic14`, `pic15`, `pic16`, `pic17`, `pic18`, `pic19`, `pic20`, `pic21`)
	values
	('$uid', '$time', '$mark', '$model', '$cost', '$tip', '$option', '$oth_inf', '$year', '$vin', '$razm_krila', '$length', '$height', '$pl_krila', '$max_ves', '$dvigatel', '$vint', '$emk_topl_bakov', '$max_speed', '$max_polet', '$dalnost', '$pic1', '$pic2', '$pic3', '$pic4', '$pic5', '$pic6', '$pic7', '$pic8', '$pic9', '$pic10', '$raspol', '$for_free_text', '$for_free_link', '$pic11', '$pic12', '$pic13', '$pic14', '$pic15', '$pic16', '$pic17', '$pic18', '$pic19', '$pic20', '$pic21')");
	return mysql_insert_id();
	}
function listAllProd($page){
	$page = (int)$page;
	if ($page < 1) {
		$page = 1;
	}
	$limit = 15; 
	$start = ($page - 1) * $limit;
	
	
	$res = sql_all("SELECT SQL_CALC_FOUND_ROWS `product`.`id`,`product`.`name`,`product`.`price`,`product`.`currency`,`product`.`description`,`product`.`bestoffers` , `product`.`for_free_text`, `product`.`model`
	FROM `product` 
	ORDER BY `product`.`admin` DESC LIMIT $start,$limit");
	
	$count_rows = sql_one("SELECT FOUND_ROWS() c");
	return array($count_rows['c'], $res);
}
function getMainLastProd (){
	return sql_all("SELECT * FROM `product`");
}





#####machinery MACHINERY


function getAllMachinerybyAdmin($tip_cat){
	return sql_all("SELECT * FROM `machinery` WHERE `tip_cat`=$tip_cat order by id DESC, admin");
}
function getAllMachinerybyAdminSpis(){
	return sql_all("SELECT * FROM `machinery` order by id");
}
function getAllMachinerybyID($id){
$id = (int)$id;
	return sql_all("SELECT * FROM `machinery` WHERE `uid`=$id order by id");
}
function getAllMachinerybyID1($id, $tip_cat){
$id = (int)$id;
$tip_cat = (int)$tip_cat;
	return sql_one("SELECT * FROM `machinery` WHERE `id`=$id");
}
function delMachinerybyID($id){
$id = (int)$id;
	sql_query("DELETE FROM `machinery` WHERE `id` = $id LIMIT 1");
}
function prodMachinery($id){
$id = (int)$id;
	sql_query("UPDATE `machinery` SET `prod` = 1 WHERE `id` = '$id'");
}
function unprodMachinery($id){
$id = (int)$id;
	sql_query("UPDATE `machinery` SET `prod` = 0 WHERE `id` = '$id'");
}
function prosmMachinery($id,$prosm){
$id = (int)$id;
$prosm = (int)$prosm;
$prosm = $prosm+1;
	sql_query("UPDATE `machinery` SET `prosm` = $prosm WHERE `id` = '$id'");
}
function updMachineryInf($id, $mark, $model, $tip, $sernomb, $year, $option, $oth_inf, $tip_cat, $dvig, $transm, $vin, $title, $cost, $raspol, $for_free_text , $for_free_link){
	$id = (int)$id;
	$tip_cat = (int)$tip_cat;
	$for_free_text = mysql_real_escape_string($for_free_text);
	$oth_inf = mysql_real_escape_string($oth_inf);
	$mark = mysql_real_escape_string($mark);
	$model = mysql_real_escape_string($model);
	sql_query("UPDATE `machinery` SET `mark`='$mark', `model`='$model', `tip`='$tip', `sernomb`='$sernomb', `year`='$year', `option`='$option', `oth_inf`='$oth_inf', `tip_cat`='$tip_cat', `dvig`='$dvig', `transm`='$transm', `vin`='$vin', `title`='$title', `cost`='$cost', `raspol`='$raspol', `for_free_text`='$for_free_text', `for_free_link`='$for_free_link' WHERE `id`=$id");
}
function updMachineryFoto($id, $pic1, $pic2, $pic3, $pic4, $pic5, $pic6, $pic7, $pic8, $pic9, $pic10, $pic11, $pic12, $pic13, $pic14, $pic15, $pic16, $pic17, $pic18, $pic19, $pic20, $pic21){
$id = (int)$id;
sql_query("UPDATE `machinery` SET `pic1`='$pic1', `pic2`='$pic2', `pic3`='$pic3', `pic4`='$pic4', `pic5`='$pic5', `pic6`='$pic6', `pic7`='$pic7', `pic8`='$pic8', `pic9`='$pic9', `pic10`='$pic10', `pic11`='$pic11', `pic12`='$pic12', `pic13`='$pic13', `pic14`='$pic14', `pic15`='$pic15', `pic16`='$pic16', `pic17`='$pic17', `pic18`='$pic18', `pic19`='$pic19', `pic20`='$pic20', `pic21`='$pic21' WHERE `id`=$id");
}
function delMachinery($id, $pic){
$id = (int)$id;
sql_query("UPDATE `machinery` SET `$pic`='' WHERE `id`=$id");
}
function getAllMachinerybyBrand($id, $tip_cat){
return sql_all("SELECT * FROM `machinery` WHERE `mark`='$id' AND `tip_cat`='$tip_cat' order by admin DESC");
}
function getAllMachineryMain($tip_cat){
return sql_all("SELECT 	* FROM `machinery` WHERE `tip_cat`='$tip_cat' order by id DESC limit 20 ");
}


function addMachinery($uid, $mark, $model, $tip, $sernomb, $year, $option, $oth_inf, $tip_cat, $dvig, $transm, $vin, $title, $cost, $pic1, $pic2, $pic3, $pic4, $pic5, $pic6, $pic7, $pic8, $pic9, $pic10, $raspol, $for_free_text , $for_free_link, $pic11, $pic12, $pic13, $pic14, $pic15, $pic16, $pic17, $pic18, $pic19, $pic20, $pic21){
$uid = (int)$uid;
$tip_cat = (int)$tip_cat;
$for_free_text = mysql_real_escape_string($for_free_text);

$oth_inf = mysql_real_escape_string($oth_inf);
$mark = mysql_real_escape_string($mark);
$model = mysql_real_escape_string($model);
	 sql_query("insert into `machinery` 
	(`uid`, `mark`, `model`, `tip`, `sernomb`, `year`, `option`, `oth_inf`, `tip_cat`, `dvig`, `transm`, `vin`, `title`, `cost`, `pic1`, `pic2`, `pic3`, `pic4`, `pic5`, `pic6`, `pic7`, `pic8`, `pic9`, `pic10`, `raspol`, `for_free_text`, `for_free_link`, `pic11`, `pic12`, `pic13`, `pic14`, `pic15`, `pic16`, `pic17`, `pic18`, `pic19`, `pic20`, `pic21`)
	values
	('$uid', '$mark', '$model', '$tip', '$sernomb', '$year', '$option', '$oth_inf', '$tip_cat', '$dvig', '$transm', '$vin', '$title', '$cost', '$pic1', '$pic2', '$pic3', '$pic4', '$pic5', '$pic6', '$pic7', '$pic8', '$pic9', '$pic10', '$raspol', '$for_free_text', '$for_free_link', '$pic11', '$pic12', '$pic13', '$pic14', '$pic15', '$pic16', '$pic17', '$pic18', '$pic19', '$pic20', '$pic21')");
	return mysql_insert_id();
}
#####machinery MACHINERY











##### SPARES ######################3


function getAllSparesbyAdmin($tip_cat){
	return sql_all("SELECT * FROM `spares` WHERE `tip_cat`=$tip_cat order by id DESC, admin");
}
function getAllSparesbyAdminSpis(){
	return sql_all("SELECT * FROM `spares` order by id");
}
function getAllSparesbyID($id){
$id = (int)$id;
	return sql_all("SELECT * FROM `spares` WHERE `uid`=$id order by id");
}
function getAllSparesbyID1($id, $tip_cat){
$id = (int)$id;
$tip_cat = (int)$tip_cat;
	return sql_one("SELECT * FROM `spares` WHERE `id`=$id");
}
function delSparesbyID($id){
$id = (int)$id;
	sql_query("DELETE FROM `spares` WHERE `id` = $id LIMIT 1");
}
function prodSpares($id){
$id = (int)$id;
	sql_query("UPDATE `spares` SET `prod` = 1 WHERE `id` = '$id'");
}
function unprodSpares($id){
$id = (int)$id;
	sql_query("UPDATE `spares` SET `prod` = 0 WHERE `id` = '$id'");
}
function prosmSpares($id,$prosm){
$id = (int)$id;
$prosm = (int)$prosm;
$prosm = $prosm+1;
	sql_query("UPDATE `spares` SET `prosm` = $prosm WHERE `id` = '$id'");
}
function updSparesInf($id, $mark, $model, $oth_inf, $cost, $tip_cat, $cat, $cat_name, $part, $for_free_text){
$id = (int)$id;
$cat = (int)$cat;
$tip_cat = (int)$tip_cat;
$part = (int)$part;
$for_free_text = mysql_real_escape_string($for_free_text);
$cat = mysql_real_escape_string($cat);
$oth_inf = mysql_real_escape_string($oth_inf);
$mark = mysql_real_escape_string($mark);
$model = mysql_real_escape_string($model);
sql_query("UPDATE `spares` SET `mark`='$mark', `model`='$model', `oth_inf`='$oth_inf', `cost`='$cost', `tip_cat`='$tip_cat', `cat_id`='$cat', `cat`='$cat_name', `part`='$part', `for_free_text`='$for_free_text' WHERE `id`=$id");
}
function updSparesFoto($id, $pic1, $pic2, $pic3, $pic4, $pic5, $pic6, $pic7, $pic8, $pic9, $pic10, $pic11, $pic12, $pic13, $pic14, $pic15, $pic16, $pic17, $pic18, $pic19, $pic20, $pic21){
$id = (int)$id;
sql_query("UPDATE `spares` SET `pic1`='$pic1', `pic2`='$pic2', `pic3`='$pic3', `pic4`='$pic4', `pic5`='$pic5', `pic6`='$pic6', `pic7`='$pic7', `pic8`='$pic8', `pic9`='$pic9', `pic10`='$pic10', `pic11`='$pic11', `pic12`='$pic12', `pic13`='$pic13', `pic14`='$pic14', `pic15`='$pic15', `pic16`='$pic16', `pic17`='$pic17', `pic18`='$pic18', `pic19`='$pic19', `pic20`='$pic20', `pic21`='$pic21' WHERE `id`=$id");
}
function delSpares($id, $pic){
$id = (int)$id;
sql_query("UPDATE `spares` SET `$pic`='' WHERE `id`=$id");
}
function getAllSparesbyBrand($id, $tip_cat){
return sql_all("SELECT * FROM `spares` WHERE `cat_id`='$id' AND `tip_cat`='$tip_cat' order by admin DESC");
}

function getAllSparesMain($tip_cat){
return sql_all("SELECT 	* FROM `spares` WHERE `tip_cat`='$tip_cat' order by id DESC limit 20 ");
}
function addSparesCategoryCol($id, $col){
$id = (int)$id;
$col = (int)$col;
sql_query("UPDATE `spares_category` SET `col`=$col WHERE `id`=$id");

}

function getSparesCategoryById($id){
$id = (int)$id;
return sql_one("SELECT 	* FROM `spares_category` WHERE `id`=$id order by id");
}
function getAllSparesCategory(){
return sql_all("SELECT 	* FROM `spares_category` order by id");
}
function getAllSparesCategoryNotNull(){
return sql_all("SELECT 	* FROM `spares_category` WHERE `col`>0 order by id");
}
function addCat($cat){
sql_query("insert into `spares_category` 
	(`name`, `col`)
	values
	('$cat', 0)");
}
function addSpares($cat_id, $cat, $uid, $mark, $model,  $oth_inf, $time, $tip_cat, $cost, $pic1, $pic2, $pic3, $pic4, $pic5, $pic6, $pic7, $pic8, $pic9, $pic10, $part, $for_free_text, $pic11, $pic12, $pic13, $pic14, $pic15, $pic16, $pic17, $pic18, $pic19, $pic20, $pic21){
$cat_id = (int)$cat_id;
$uid = (int)$uid;
$tip_cat = (int)$tip_cat;
$part = (int)$part;
$for_free_text = mysql_real_escape_string($for_free_text);
$time = mysql_real_escape_string($time);
$cat = mysql_real_escape_string($cat);
$oth_inf = mysql_real_escape_string($oth_inf);
$mark = mysql_real_escape_string($mark);
$model = mysql_real_escape_string($model);

	 sql_query("insert into `spares` 
	(`cat_id`, `cat`, `uid`, `mark`, `model`, `oth_inf`, `time`, `tip_cat`, `cost`, `pic1`, `pic2`, `pic3`, `pic4`, `pic5`, `pic6`, `pic7`, `pic8`, `pic9`, `pic10`, `part`, `for_free_text`, `pic11`, `pic12`, `pic13`, `pic14`, `pic15`, `pic16`, `pic17`, `pic18`, `pic19`, `pic20`, `pic21`)
	values
	('$cat_id', '$cat', '$uid', '$mark', '$model', '$oth_inf', '$time', '$tip_cat', '$cost', '$pic1', '$pic2', '$pic3', '$pic4', '$pic5', '$pic6', '$pic7', '$pic8', '$pic9', '$pic10', '$part', '$for_free_text', '$pic11', '$pic12', '$pic13', '$pic14', '$pic15', '$pic16', '$pic17', '$pic18', '$pic19', '$pic20', '$pic21')");
return mysql_insert_id();
	}
#####    SPARES    ###############
function getAllMailUsers() {
	
	return sql_all("SELECT `email` FROM `users` where email like '%@%.%'");
}
#####    BANERS    ###############
function getAllBaners() {
	
	return sql_all("SELECT * FROM `baners`");
}
function addBaner($link, $show, $tip, $rash){
	$show = (int)$show;
	$tip = (int)$tip;
	$link = mysql_real_escape_string($link);
	$rash = mysql_real_escape_string($rash);
	 sql_query("insert into `baners` 
	(`link`, `show`, `tip`, `rash`)
	values
	('$link', '$show', '$tip', '$rash')");
	return mysql_insert_id();
	}
function getBanerById($id){
	$id = (int)$id;
	return sql_one("SELECT 	* FROM `baners` WHERE `id`=$id order by id");
}
function editBaner($id,$link, $show, $tip){
	$id = (int)$id;
	$show = (int)$show;
	$tip = (int)$tip;
	$link = mysql_real_escape_string($link);
	sql_query("UPDATE `baners` SET `show`='$show', `tip`='$tip', `link`='$link' WHERE `id`=$id");

}
function editBaner1($id,$link, $show, $tip, $rash){
	$id = (int)$id;
	$show = (int)$show;
	$tip = (int)$tip;
	$link = mysql_real_escape_string($link);
	$rash = mysql_real_escape_string($rash);
	sql_query("UPDATE `baners` SET `show`='$show', `tip`='$tip', `link`='$link', `rash`='$rash' WHERE `id`=$id");

}
function delBaners($id){
	$id = (int)$id;
	sql_query("DELETE FROM `baners` where `id` = $id LIMIT 1");
}
function updBanerShow($id, $show){
	$id = (int)$id;
	$show = (int)$show;
	sql_query("UPDATE `baners` SET `show`='$show' WHERE `id`=$id");
}
function getAllBanersByTip($tip) {
	$tip=(int)$tip;
	return sql_all("SELECT * FROM `baners` WHERE `tip`=$tip && `show`=1");
}
#############  section #############
function addSect($name){
	$name = mysql_real_escape_string($name);
	 sql_query("insert into `sections` 
	(`name`)
	values
	('$name')");
	return mysql_insert_id();
	}
function addNamePolSect($name_pol, $id, $tip, $show){
	$id=(int)$id;
	$tip=(int)$tip;
	$show=(int)$show;
	$name = mysql_real_escape_string($name_pol);
	 sql_query("insert into `section_names` 
	(`name`, `id_sect`, `tip`, `show_main`)
	values
	('$name', '$id', '$tip', '$show')");
	return mysql_insert_id();
	}	
function createTableByQstr($q_str){
	sql_query($q_str);
}
function getAllSect() {
	return sql_all("SELECT * FROM `sections`");
}	
function updSectShow($id, $show){
	$id = (int)$id;
	$show = (int)$show;
	sql_query("UPDATE `sections` SET `show`='$show' WHERE `id`=$id");
}
function delSect($id){
	$id = (int)$id;
	sql_query("DROP TABLE `section_$id`");
	sql_query("DELETE FROM `section_names` where id_sect=$id");
	sql_query("DELETE FROM `sections` where `id`=$id LIMIT 1");
}
function getSectById($id){
	$id = (int)$id;
	return sql_one("SELECT 	* FROM `sections` WHERE `id`=$id LIMIT 1");
}
function getAllSect_namesById($id) {
	$id=(int)$id;
	return sql_all("select * from section_names where id_sect=$id");
}
function getAllSect_namesById_show($id) {
	$id=(int)$id;
	return sql_all("select * from section_names where id_sect=$id && show_main=1");
}
function getSectBySect($id) {
	$id=(int)$id;
	return sql_all("select * from section_$id ORDER BY id");
}
function getSectBySectId($id, $s){
	$id = (int)$id;
	$s = (int)$s;
	return sql_one("SELECT 	* FROM `section_$s` WHERE `id`=$id LIMIT 1");
}
function getNamePolBySparId($id){
	$id = (int)$id;
	return sql_one("SELECT 	* FROM `section_names` WHERE `id`=$id LIMIT 1");
}
function delSecZap($id, $s){
	$id = (int)$id;
	$s = (int)$s;
	sql_query("DELETE FROM `section_$s` where `id` = $id LIMIT 1");
}
function getSectByPage($s, $page) {
	$s=(int)$s;
	$page=(int)$page;
	$page-=1;
	$page*=10;
	if($page!=0)
		$page-=1;
	
		
	return sql_all("select * from section_$s LIMIT $page, 10");
}
function getSectByPageFind($s, $page, $find) {
	$find = mysql_real_escape_string($find);
	$s=(int)$s;
	$page=(int)$page;
	$page-=1;
	$page*=10;
	if($page!=0)
		$page-=1;
		
	return sql_all("select * from section_$s where firm like '%$find%' LIMIT $page, 10");
}
function getCatBySect($s) {
	$s=(int)$s;
	return sql_all("SELECT b.firm, count(b.firm) as col FROM section_$s b  GROUP BY b.firm");
}
function getCountBySectId($s){
	$s = (int)$s;
	return sql_one("SELECT count(firm) as col FROM section_$s");
}
function getCountBySectIdFind($s, $find){
	$find = mysql_real_escape_string($find);
	$s = (int)$s;
	return sql_one("SELECT count(firm) as col FROM section_$s where firm like '%$find%'");
}
function chNameSect ($id, $name) {

	$id = (int)$id;
	$name = mysql_real_escape_string($name);
	sql_query("UPDATE `sections` SET `name` = '$name' WHERE `id` = '$id'");

}
function delSecNamePol($id){
	$id=(int)$id;
	sql_query("DELETE FROM `section_names` where id=$id");
}
function chSectsPols($id, $name, $tip, $show) {
	$id = (int)$id;
	$name = mysql_real_escape_string($name);
	$tip  = (int)$tip;
	$show = (int)$show;
	sql_query("UPDATE `section_names` SET `name` = '$name', `tip` = '$tip', `show_main` = '$show' WHERE `id` = '$id'");

}