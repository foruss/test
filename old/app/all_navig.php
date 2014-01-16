<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";

$partners=getPartners();
$smarty->assign("partners", $partners);

$mode = processGetVariable('mode');
if($mode=="spisok"){
$publ=getAllpublicationsbyVes_Lang('ru');
$publ_top=getAllpublicationsbyVes_Lang('top');
$smarty->assign("publ", $publ);
$smarty->assign("publ_top", $publ_top);
$smarty->assign("title", "spisok navigacii");
$smarty->display("spis_navig.tpl");
}
$mode = processGetVariable('mode');
if($mode=="edit"){
$id = processGetVariable('id');
$publ=getAllpublicationsbyVesbyId($id);
$smarty->assign("publ", $publ);
$smarty->assign("title", "edit navigacii");
$smarty->display("edit_navig.tpl");
}
if($mode=="edit_subm"){
$id = processGetVariable('id');
$publ=getAllpublicationsbyVesbyId($id);
$title = processPostVariable('title');
$ves = processPostVariable('ves');
if ($title=="")
$title=$publ['title'];
if ($ves=="")
$ves=$publ['ves'];
editleftnav($id, $title, $ves);
$publ=getAllpublicationsbyVes_Lang('ru');
$publ_top=getAllpublicationsbyVes_Lang('top');
$smarty->assign("publ", $publ);
$smarty->assign("publ_top", $publ_top);
$smarty->assign("title", "spisok navigacii");
$smarty->display("spis_navig.tpl");
}
