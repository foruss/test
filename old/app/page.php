<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";

$partners=getPartners();
$smarty->assign("partners", $partners);

$url = processGetVariable('url');

$publication =array();
$publication[0] = "";
$publication[0]['title']="";
$publication[0]['keywords']="";
$publication[0]['description']="";

$publication = getPublication($url, "ru");

if (sizeof($publication)==0) {
	//page not found!!!
	header(null,null,404);
	header("Location: /404/");
}

$smarty->assign("publication", $publication[0]);
$smarty->assign("title", $publication[0]['title']);
$smarty->assign("keywords", $publication[0]['keywords']);
$smarty->assign("description", $publication[0]['description']);


$smarty->display("text.tpl");