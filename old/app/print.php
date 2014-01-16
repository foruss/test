<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";

$smarty->assign("prototype", true);
$mode = processGetVariable('mode');

$search_brands = getMainSearchBrands();
$smarty->assign("search_brands", $search_brands);
//print_r($search_brands);
$search_engine =getMainSearchEngine ();
$smarty->assign("search_engine", $search_engine);
$LeftAutoBrands = getAutoBrands();
$smarty->assign("leftbrands",$LeftAutoBrands);


	$id=processGetVariable("id");
	$id=(int)$id;
	$auto =getAuto($id) ;
	//print_r($auto);
	$smarty->assign("title", $auto['brand_name']." ".$auto['car_name']);
	$smarty->assign("auto",$auto);
	$addition = getAutoAddition($id);
	$smarty->assign("add", $addition);
	$smarty->assign("id", $id);
	CountView($id);
	$DATA = array();
	$DATA = "";
		$it=0;
		while ($it<21) {
	  		$filename="../carimages/".$id."_".$it."m.jpg";
	  		if (file_exists($filename)) {
	  		$DATA[$it] = array(
	  		 	'link_thum'=> $id."_".$it."sm.jpg",	
	  			'link_thumb'=> $id."_".$it."m.jpg",
	  			'link_large'=> $id."_".$it.".jpg",
	  		);			
			} 
			$it++;
	 	}
	 	
		$conditions = getConditions();
		$auto_conditions = getAutoCondition($id);
		foreach($conditions as $k=>$c){
			$conditions[$k]['value'] = $auto_conditions[$c['name_db']];
		}
		$smarty->assign('conditions', $conditions);
		$smarty->assign("cid",$id);
	$smarty->assign("image",$DATA);
	$smarty->assign('showaddit', true);
	$smarty->assign("hide", true);
	$smarty->display("print.tpl");

?>