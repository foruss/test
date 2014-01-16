<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";

$partners=getPartners();
$smarty->assign("partners", $partners);

$mode = processGetVariable('mode');
if($mode=="spisok"){
$partners=getPartners();
$smarty->assign("partners", $partners);
$smarty->assign("title", "Обмен баннерами (список)");
$smarty->display("spis_partn.tpl");
}
if($mode=="edit"){
$id = processGetVariable('id');
$partner=getPartnById($id);
$smarty->assign("partner", $partner);
$smarty->assign("title", "Обмен баннерами (редактирование)");
$smarty->display("edit_partn.tpl");
}
if($mode=="del"){
$id = processGetVariable('id');
$pic=getPartnById($id);
delPartn($id);
unlink("../img/partner/".$pic['pic']);

$partners=getPartners();
$smarty->assign("partners", $partners);
$smarty->assign("title", "Обмен баннерами (список)");
$smarty->display("spis_partn.tpl");
}
if($mode=="edit_subm"){
$id = processGetVariable('id');
$pic=getPartnById($id);
$title = processPostVariable('title');
$url = processPostVariable('url');
$width = processPostVariable('width');
$height = processPostVariable('height');
require_once('resize.php');
$partners=getPartners();
//print_r($partners);
if($_FILES["photo"]["error"] == UPLOAD_ERR_OK){

		ereg(".+\.(.{3})",$_FILES["photo"]["name"],$nash);
   		$rash=$nash[1];
   		$time=time();
   		$photo=md5($time).".".$rash;
		//copy($_FILES["photo"]["tmp_name"],"../img/partner/".$photo);
		resizepic($_FILES["photo"]["tmp_name"], "../img/partner/".$photo, 140, 140);
   		unset($nash);
   		unset($time);
   		unset($rash);
		$size = getimagesize($_FILES["photo"]["tmp_name"]);
		ereg("width=\"([0-9]+)\" height=\"([0-9]+)\"",$size[3],$nash);
		$width=$nash[1];
		$height=$nash[2];
		unset($nash);
		unlink("../img/partner/".$pic['pic']);
		editPartn($id, $title, $url, $photo, $width, $height);
}
else{
	$photo=$pic['pic'];
	editPartn22($id, $title, $url);
	}
	//echo $photo;
	




$partners=getPartners();
$smarty->assign("partners", $partners);
$smarty->assign("title", "spisok partnerov");
$smarty->display("spis_partn.tpl");
}
if($mode=="add"){
$smarty->assign("title", "Обмен баннерами (добавление)");
$smarty->display("add_partn.tpl");
}
if($mode=="add_subm"){
$title = processPostVariable('title');
$url = processPostVariable('url');
require_once('resize.php');
if($_FILES["photo"]["error"] == UPLOAD_ERR_OK){
		ereg(".+\.(.{3})",$_FILES["photo"]["name"],$nash);
   		$rash=$nash[1];
   		$time=time();
   		$photo=md5($time).".".$rash;
		//copy($_FILES["photo"]["tmp_name"],"../img/partner/".$photo);
		resizepic($_FILES["photo"]["tmp_name"], "../img/partner/".$photo, 140, 140);
   		unset($nash);
   		unset($time);
   		unset($rash);
}
else{
	$photo="";
	$width="";
	$height="";
	}
//print_r($_FILES["photo"]);
	if($photo!=""){
	$size = getimagesize("../img/partner/".$photo);
	ereg("width=\"([0-9]+)\" height=\"([0-9]+)\"",$size[3],$nash);
	$width=$nash[1];
	$height=$nash[2];
	unset($nash);
	}
    //print_r($nash[1]); width
	//print_r($nash[2]); height
	
	addPartners($title, $url, $photo, $width, $height);
	
$smarty->assign("mes", "<center><h1>успешно добавлено</h1></center>");
$smarty->assign("title", "Обмен баннерами (добавление)");
$smarty->display("add_partn.tpl");
}