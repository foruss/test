<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";

$partners=getPartners();
$smarty->assign("partners", $partners);

$mode = processGetVariable('mode');
if($mode=="spisok"){
$users=getUsersList();
$smarty->assign("users", $users);
$smarty->assign("title", "Список пользователей");
$smarty->display("spis_users.tpl");
}
if($mode=="del"){
$id = processGetVariable('id');
delAllOfUser($id);
$users=getUsersList();
$smarty->assign("users", $users);
$smarty->assign("title", "Список пользователей");
$smarty->display("spis_users.tpl");
}