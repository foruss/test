<?php
include_once("config.php");

$addpricepercent = 0; # +xx%

$frame=isset($_REQUEST["frame"])?$_REQUEST["frame"]:"";


$url = "https://www.manheim.com/members/powersearch/getModels.do?make=4294960949&inventory=";
$res = http_load( $url, "https://www.manheim.com/members/powersearch/", $_COOKIE, $manheim_login, $post, null, null, null, 0 );
if (strpos($res,'Redirect')!=false){
$res="";
     authorize_manheim($manheim_login['user'],$manheim_login['password']);
}


//Список доступных модулей
$avaible_modules= array('pricesdatasetpage','main','mmrframes','vehicleselector','decoder','blank','pricestab','pricespagedata',
					'transactions','auctionspagedata','reportspagedata','summarypagedata','showreport');
$avaible_modules = array_flip ($avaible_modules);
if (!isset($avaible_modules[$frame])) $frame='main';
$search_module = $frame;


//print PARSERS_DIR.$search_module.".php";
if(file_exists(PARSERS_DIR.'mmr_'.$search_module.".php")){

    include_once(PARSERS_DIR.'mmr_'.$search_module.".php");
    //$smarty->display(TEMPLATES_DIR."header.tpl");
    //$smarty->display(TEMPLATES_DIR.$search_module.".tpl");
}else{
	//die ('eroro!');
	die("Мoдуль $search_module не найден.");
}
 //$smarty->display(TEMPLATES_DIR."footer.tpl");
?>