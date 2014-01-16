<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";

$smarty->assign("lhide", true);
$partners=getPartners();
$smarty->assign("partners", $partners);
$smarty->assign('referer', urlencode($_SERVER['HTTP_REFERER']));
//include_once( "functions/langs.php" );
include_once( "functions/functions.php" );

//ini_set('display_errors', true);

$mode=isset($_REQUEST["mode"])?$_REQUEST["mode"]:"";
switch ($mode) {
  case "main":										// main page of site
    $search_module="main";
    $smarty->assign('hidel',true);					
    break;
  case "searchresults":								// searchresults - main view
  //$smarty->assign("hide", true);
    $search_module="searchresults";
    break;
	case "searchresults1":								// searchresults - main view
  //$smarty->assign("hide", true);
    $search_module="searchresults1";
    break;
  case "searchresults_table":						// searchresults - table view
    //$smarty->assign("hide", true);
    $search_module="searchresults_table";	
    break;
  case "searcholdcars":								// search   old    cars
   // $smarty->assign("hide", true);
    $search_module="searcholdcars";	
    break;
  case "lot":									//details about car
   // $smarty->assign("hide", true);
    $search_module="lot";
    break;
  case "advancedsearch":							//advanced search
    $smarty->assign("hide", true);
    $search_module="advancedsearch";
    break;   
    
    
    
    
    
  default:
    $search_module="main";
    break;
}
if(file_exists("modules/".$search_module.".php")){
                                                  
    include_once('modules/'.$search_module.".php");
    $smarty->assign("hidel", true);
    $smarty->display("header.tpl");
	if($mode=="searchresults1")
	$smarty->display("cars-searchresults.tpl");
	else
    $smarty->display("cars-".$search_module.".tpl");
}else{
	//die ('eroro!');
	die("������ $search_module �� ������.");
}
 $smarty->display("footer.tpl");
?>
