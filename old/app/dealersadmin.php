<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";
ini_set('display_errors', true);

$mode=processGetVariable('mode');
$id = processGetVariable('id');
$lang = processGetVariable('lang');
if ($lang=="") $lang="ru";
$smarty->assign("lang", $lang);
$uid = $config['user']['id'];

if ($mode=="") $mode="main";
if ($mode=="pages") $mode="list";

if($mode=="login") {
         $login = processPostVariable('login');
      	 $password = processPostVariable('password');
      	 if (!processUserLogin($login, $password)) {
      		$message = "Login error!";
      	 } else $message = "OK!";
      	 $location_string = "/".$lang."/dealeradmin/list/";
         header("location: $location_string");
         //die;		
     //$smarty->display($lang."/dealer-ok.tpl");
}
elseif ($mode=="auth") {
	$smarty->display($lang."/dealer-auth.tpl");
	
}
elseif ($mode=="list") {

	//получаем список языковых версий страниц
	
	$langslist = getDealerPublicationsLangs($uid);
	$smarty->assign("langslist", $langslist);
	
	//получаем собственно сам список страниц
	$pageslist=getDealerPublicationsList($uid);
	$smarty->assign('pageslist', $pageslist);
	//print_r($pageslist);
	
	$smarty->assign("mode", "pageslist");
	
	//$smarty->assign("title", "Список страниц сайта");
	$smarty->display($lang."/dealer-pages.tpl");
}
elseif ($mode=="pagedel") {
	deleteDealerPublication($id, $uid);
	//header(null,null,301);
	$location_string = "/".$lang."/dealeradmin/list/";
	header("Location: $location_string");
}
elseif ($mode=="pageedite") {
	

	
	$publication = getDealerPublicationById($id);
//	print_r($publication);
	$smarty->assign("publication", $publication[0]);
	$smarty->assign("mode", "pageedite");
	$smarty->assign("title", "Page editing");
	
/*
 * include_once '../fckeditor/fckeditor.php';
 
 ob_start();
 $oFCKeditor = new FCKeditor('content') ;
 $oFCKeditor->BasePath = '/fckeditor/' ;
 $oFCKeditor->Value = $publication[0]['content'];
 $oFCKeditor->Create();
 $page_contents=ob_get_contents();
 ob_end_clean();
*/	$page_contents = "<textarea name='content' rows='15' cols='90'>.$publication[0]['content'].</textarea>";
 	$smarty->assign("fckeditor_data", "$page_contents");
	
	$smarty->display($lang."/dealer-pages.tpl");
}
elseif ($mode=="pageupdate") {
	$title = processPostVariable('title');
	$url = processPostVariable('url');
	$keywords = processPostVariable('keywords');
	$description = processPostVariable('description');
	$content = processPostVariable('content');
	$id = processPostVariable('id');
	$lang = processPostVariable('lang');
	
	
	updateDealerPublication ($id, $url, $title, $keywords, $description, $content, $lang, $uid);
	$smarty->assign("mode", "pageupdated");
	$smarty->display($lang."/dealer-pages.tpl");
}
elseif ($mode=="pageadd") {
	
	$smarty->assign("publication", "");
	$smarty->assign("mode", "pageadd");
	$smarty->assign("title", "Adding a page");
	
/*
 * include_once '../fckeditor/fckeditor.php';
 
 ob_start();
 $oFCKeditor = new FCKeditor('content') ;
 $oFCKeditor->BasePath = '/fckeditor/' ;
 $oFCKeditor->Value = $publication[0]['content'];
 $oFCKeditor->Create();
 $page_contents=ob_get_contents();
 ob_end_clean();
*/	$page_contents = "<textarea name='content' rows='15' cols='90'></textarea>";
	 	$smarty->assign("fckeditor_data", "$page_contents");
	
	$smarty->display($lang."/dealer-pages.tpl");
}
elseif ($mode=="pagesave") {
	$title = processPostVariable('title');
	$url = processPostVariable('url');
	$keywords = processPostVariable('keywords');
	$description = processPostVariable('description');
	$content = processPostVariable('content');
	$id = processPostVariable('id');
	$lang = processPostVariable('lang');
	
	addDealerPublication($url, $title, $keywords, $description, $content, $lang, $uid);
	$smarty->assign("mode", "pagesaved");
	$smarty->display($lang."/dealer-pages.tpl");
}	
/*
	//проверка на авторизацию	
	if (!$config['user']['loggedin']||$config['user']['dealer']!='1') { 
		header(null,null,403);
		header("Location: /403/");
		die(403);
	}
*/

?>