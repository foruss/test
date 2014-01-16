<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";

$partners=getPartners();
$smarty->assign("partners", $partners);

$smarty->assign("prototype", true);
$mode = processGetVariable('mode');

	//проверка на администратор ли...	
	if (!$config['user']['loggedin']||$config['user']['admin']!='1') { 
		header(null,null,403);
		header("Location: /403/");
		die(403);
	}
	
$mode=processGetVariable('mode');
$id = processGetVariable('id');

if ($mode=="") $mode="main";

//собственно выбираем что показывать народу:
if ($mode=="userslist"){
	$userslist= getUsersList();
//	print_r($userslist);
	$smarty->assign('userslist', $userslist);
	$smarty->assign("mode", "list");
	$smarty->assign("title", "Список пользователей");
	$smarty->display("admin-users.tpl");
}
elseif ($mode=="userdel") {
	deleteUserFromBase($id);
	//header(null,null,301);
	header("Location: /adminpage/userslist/");
}
elseif ($mode=="moderate") {
	$dealerslist = getModerateDealers();
	$smarty->assign('dealerslist', $dealerslist);
	$smarty->assign("mode", "dealerslist");
	$smarty->assign("title", "Список дилеров в ожидании на одобрение");
	$smarty->display("admin-users.tpl");
	
}
elseif ($mode=="dealeraccept") {
	acceptDealer($id);
	//header(null,null,301);
	$dealer_data = getUserInfo($id);
	//sending confirmation
	$smarty->assign("dealer", $dealer_data);
	$message_text = $smarty->fetch($dealer_data['lang'].'/mail-dealer-conf.tpl');
	$to = $dealer_data['email'];
	$subject = "Americars dealer registration confirmation";
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= "From: Americars <noreply@americars.md>";

	
	
	header("Location: /adminpage/moderate/");
	mail($to, $subject, $message_text, $headers);
}
elseif ($mode=="dealerdeactivate") {

	deAcceptDealer($id);

	
	//$smarty->assign("mail-dealer-conf.tpl");
	//header(null,null,301);
	header("Location: /adminpage/dealers/");
	
}
elseif ($mode=="dealers") {
	$dealerslist=getAllDealers();
	$smarty->assign('dealerslist', $dealerslist);
	$smarty->assign("mode", "alldealerslist");
	$smarty->assign("title", "Список активных дилеров");
	$smarty->display("admin-users.tpl");
}

/*
*
* PAGES ADMIN
*
*/
elseif ($mode=="pages") {
	//получаем список языковых версий страниц
	$langslist = getPublicationsLangs();
	$smarty->assign("langslist", $langslist);
	
	//получаем собственно сам список страниц
	$pageslist=getPublicationsList();
	$smarty->assign('pageslist', $pageslist);
	//print_r($pageslist);
	
	$smarty->assign("mode", "pageslist");
	
	$smarty->assign("title", "Список страниц сайта");
	$smarty->display("admin-pages.tpl");
}
elseif ($mode=="pagedel") {
	deletePublication($id);
	//header(null,null,301);
	header("Location: /adminpage/pages/");
}
elseif ($mode=="pageedite") {
	

	
	$publication = getPublicationById($id);
//	print_r($publication);
	$smarty->assign("publication", $publication[0]);
	$smarty->assign("mode", "pageedite");
	$smarty->assign("title", "Редактирование страницы");
	
include_once '../fckeditor/fckeditor.php';	
 ob_start();
 $oFCKeditor = new FCKeditor('content') ;
 $oFCKeditor->Width = '700';
 $oFCKeditor->Height = '600';
 $oFCKeditor->BasePath = '/fckeditor/' ;
 $oFCKeditor->Value = $publication[0]['content'];
 $oFCKeditor->Create();
 $page_contents=ob_get_contents();
 ob_end_clean();
	
 	$smarty->assign("fckeditor_data", "$page_contents");
	
	$smarty->display("admin-pages.tpl");
}
elseif ($mode=="pageupdate") {
	$title = processPostVariable('title');
	$url = processPostVariable('url');
	$keywords = processPostVariable('keywords');
	$description = processPostVariable('description');
	$content = processPostVariable('content');
	$id = processPostVariable('id');
	$lang = processPostVariable('lang');
	
	updatePublication ($id, $url, $title, $keywords, $description, $content, $lang);
	$smarty->assign("mode", "pageupdated");
	$smarty->display("admin-pages.tpl");
}
elseif ($mode=="pageadd") {
	
	$smarty->assign("publication", "");
	$smarty->assign("mode", "pageadd");
	$smarty->assign("title", "Добавление страницы");
	
	include_once '../fckeditor/fckeditor.php';	
 ob_start();
 $oFCKeditor = new FCKeditor('content') ;
 $oFCKeditor->BasePath = '/fckeditor/' ;
 $oFCKeditor->Value = '';
 $oFCKeditor->Width = '700';
 $oFCKeditor->Height = '600';
 $oFCKeditor->Create();
 $page_contents=ob_get_contents();
 ob_end_clean();
	
 	$smarty->assign("fckeditor_data", "$page_contents");
	
	$smarty->display("admin-pages.tpl");
}
elseif ($mode=="pagesave") {
	$title = processPostVariable('title');
	$url = processPostVariable('url');
	$keywords = processPostVariable('keywords');
	$description = processPostVariable('description');
	$content = processPostVariable('content');
	$id = processPostVariable('id');
	$lang = processPostVariable('lang');
	
	addPublication($url, $title, $keywords, $description, $content, $lang);
	$smarty->assign("mode", "pagesaved");
	$smarty->display("admin-pages.tpl");
}	

/*
*
* END PAGES ADMIN
*
*/
/*
*
* NEWS ADMIN
*
*/
elseif ($mode=="news") {
	$page = processGetVariable('p');
	$page = (int)$page;
	if (!$page) $page = 1;
	$pages = array();
	$dots = false;	


	//$smarty->assign("news", $news);
	$smarty->assign("pages", $pages);
	//получаем собственно сам список
	
	$limit = 50;
	$start = ($page-1)*$limit;
	$sort = 'a.`date`';
	$sort_dir = 'DESC';
	
	$newslist = listNewsAdmin($start, $limit, $sort, $sort_dir);
	$count = $newslist['totalCount'];
	if ($count % $limit == 0) {
		$pagesc = $count / $limit;
	} else {
		$pagesc = $count / $limit + 1;
	}	
	for ($i = 1; $i <= $pagesc; ++$i) {
		if ((abs($i - $page) <= 4) || ($i <= 5) || ($i >= $pagesc - 4)) {
			$pages[] = array('num' => $i, 'link' => "/adminpage/news/page-$i/");
			$dots = false;
		} else if (!$dots) {
			$pages[] = array('num' => '...');
			$dots = true;
		}
	}
	$smarty->assign('pages', $pages);
	$smarty->assign('page', $page);
	$smarty->assign('newslist', $newslist['news']);
	$smarty->assign("mode", "newslist");
	
	$smarty->assign("title", "Список новостей сайта");
	$smarty->display("admin-news.tpl");
}
elseif ($mode=="newsdel") {
	deleteNews($id);
	//header(null,null,301);
	header("Location: /adminpage/news/");
}
elseif ($mode=="newsedite") {
	$id = processGetVariable('id');
	$publication = getNewsAdmin($id);
	//print_r($publication);
	$smarty->assign("publication", $publication);
	$smarty->assign("mode", "newsedite");
	$smarty->assign("title", "Редактирование новости");
	
	include_once '../fckeditor/fckeditor.php';	
	ob_start();
	$oFCKeditor = new FCKeditor('content') ;
	$oFCKeditor->Width = '650';
	$oFCKeditor->Height = '450';
	$oFCKeditor->BasePath = '/fckeditor/' ;
	$oFCKeditor->Value = $publication['long'];
	$oFCKeditor->Create();
	$page_contents=ob_get_contents();
	ob_end_clean();
	
 	$smarty->assign("fckeditor_data", "$page_contents");
	
	$smarty->display("admin-news.tpl");
}
elseif ($mode=="newsupdate") {
	$title = processPostVariable('title');
	//$url = processPostVariable('url');
	$tags = processPostVariable('keywords');
	$description = processPostVariable('description');
	$content = processPostVariable('content');
	$id = processPostVariable('id');
	$lang = processPostVariable('lang');
	if ($tags){
		$tags = explode(" ", $tags);
		foreach ($tags as $key => $value) {
			if ($value == "") {
				unset($tags[$key]);
			}
		}
	}	
		$date = date("Y-m-d");
		$date = convertDateToMySQL($date);	
	//updatePublication ($id, $url, $title, $keywords, $description, $content, $lang);
	editNews($id, "news", $title, $date, $tags, $description, $content);
	
	$smarty->assign("mode", "newsupdated");
	$smarty->display("admin-news.tpl");
}
elseif ($mode=="newsadd") {
	
	$smarty->assign("publication", "");
	$smarty->assign("mode", "newsadd");
	$smarty->assign("title", "Добавление страницы");
	
	include_once '../fckeditor/fckeditor.php';	
 ob_start();
 $oFCKeditor = new FCKeditor('content') ;
 $oFCKeditor->BasePath = '/fckeditor/' ;
 $oFCKeditor->Value = '';
 $oFCKeditor->Height = '450';
 $oFCKeditor->Width = '650';
 $oFCKeditor->Create();
 $page_contents=ob_get_contents();
 ob_end_clean();
	
 	$smarty->assign("fckeditor_data", "$page_contents");
	
	$smarty->display("admin-news.tpl");
}
elseif ($mode=="newssave") {
	$title = processPostVariable('title');
	//$url = processPostVariable('url');
	$tags = processPostVariable('keywords');
	$description = processPostVariable('description');
	$content = processPostVariable('content');
	$id = processPostVariable('id');
	$lang = processPostVariable('lang');
	if ($tags){
		$tags = explode(" ", $tags);
		foreach ($tags as $key => $value) {
			if ($value == "") {
				unset($tags[$key]);
			}
		}
	}	
	$date = date("Y-m-d");
	$date = convertDateToMySQL($date);	
	//addPublication($url, $title, $keywords, $description, $content, $lang);
	addNews($title, "news", $date, $tags, $description, $content);
	$smarty->assign("mode", "newssaved");
	$smarty->display("admin-news.tpl");
}	

/*
*
* END NEWS ADMIN
*
*/
elseif ($mode=="bidslist") {
	$orders = getOrdersList();
	$smarty->assign("orders", $orders);
	
	$smarty->assign("mode", "list");
	$smarty->display("admin-orders.tpl");
	
}
elseif ($mode=="orderdel") {
	delOrderFromBase($id);
	header("Location: /adminpage/bidslist/");
}