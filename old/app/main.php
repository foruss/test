<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";

$partners=getPartners();
$smarty->assign("partners", $partners);
/////////////////////////////////////////////////////////////////////////////
$a=getAllMotoMain();
shuffle($a);
//print_r($a);
if(count($a)<3){
if(count($a)==2){
$b1=1;
$b2=2;
$b3=1;
}else{
$b1=1;
$b2=1;
$b3=1;}
}
else{
$b1=1;
$b2=2;
$b3=3;
}
$picp[0]=$a[($b1-1)]['pic1'];
$picp[1]=$a[($b2-1)]['pic1'];
$picp[2]=$a[($b3-1)]['pic1'];
$picid[0]=$a[($b1-1)]['id'];
$picid[1]=$a[($b2-1)]['id'];
$picid[2]=$a[($b3-1)]['id'];
$picb[0]=$a[($b1-1)]['mark'].' '.$a[$b1]['model'];
$picb[1]=$a[($b2-1)]['mark'].' '.$a[$b1]['model'];
$picb[2]=$a[($b3-1)]['mark'].' '.$a[$b1]['model'];
$smarty->assign('picp', $picp);
$smarty->assign('picid', $picid);
$smarty->assign('picb', $picb);
////////////////////////////////////////////////////////////////////////////////
unset($a);
$a=getAllBoatMain(1);
shuffle($a);
if(count($a)<3){
if(count($a)==2){
$b1=1;
$b2=2;
$b3=1;
}else{
$b1=1;
$b2=1;
$b3=1;}
}
else{
$b1=1;
$b2=2;
$b3=3;
}

$picp[0]=$a[($b1-1)]['pic1'];
$picp[1]=$a[($b2-1)]['pic1'];
$picp[2]=$a[($b3-1)]['pic1'];
$picid[0]=$a[($b1-1)]['id'];
$picid[1]=$a[($b2-1)]['id'];
$picid[2]=$a[($b3-1)]['id'];
$picb[0]=$a[($b1-1)]['brand'].' '.$a[$b1]['name'];
$picb[1]=$a[($b2-1)]['brand'].' '.$a[$b1]['name'];
$picb[2]=$a[($b3-1)]['brand'].' '.$a[$b1]['name'];
$smarty->assign('picp1', $picp);
$smarty->assign('picid1', $picid);
$smarty->assign('picb1', $picb);
////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////
$publication =array();
$publication[0] = "";
$publication[0]['title']="";
$publication[0]['keywords']="";
$publication[0]['description']="";

$publication = getPublication("main", "ru");

$news = listLastNews(5);
$smarty->assign('news', $news);
$smarty->assign("publication", $publication[0]['content']);
$smarty->assign("title", $publication[0]['title']);
$smarty->assign("keywords", $publication[0]['keywords']);
$smarty->assign("description", $publication[0]['description']);

$auto = getRandAvailibleAuto(1);
//print_r($auto[0]);
$smarty->assign("auto", $auto[0]);
///////////////////////////////////
$a=getAllAutoMain($auto[0]['id']);
shuffle($a);
if(count($a)<3){
	if(count($a)==1){
		$carId[0]=$a[0]['id'];
		$carId[1]=$a[0]['id'];
		$carId[2]=$a[0]['id'];
		
	}
	if(count($a)==2){
		$carId[0]=$a[0]['id'];
		$carId[1]=$a[1]['id'];
		$carId[2]=$a[0]['id'];
		
	}
	
}
else{
$carId[0]=$a[0]['id'];
$carId[1]=$a[1]['id'];
$carId[2]=$a[2]['id'];

}

$smarty->assign('carId', $carId);

///////////////////////////////////
/*
$makeslist_url = "http://j0.j-lab.ru/search_xml/index.php?mode=make";

$string = file_get_contents($makeslist_url);
$xml_makes = simplexml_load_string($string);

function object2array($object)
{
    $return = NULL;
      
    if(is_array($object))
    {
        foreach($object as $key => $value)
            $return[$key] = object2array($value);
    }
    else
    {
        $var = get_object_vars($object);
          
        if($var)
        {
            foreach($var as $key => $value)
                $return[$key] = ($key && !$value) ? NULL : object2array($value);
        }
        else return $object;
    }

    return $return;
} 

$ret = object2array($xml_makes);
$smarty->assign("make", $ret['car']);
*/
////for manheim
global $manheim_login;
$manheim_login["user"]="vbauto1";
$manheim_login["password"]="dallas4";
define( "CACHEDIR", '/templates_c/' );
$cache_interval_minutes = 10; //main page
$keep_in_cache_minutes = 240; //other pages
include_once( "m_langs.php" );
include_once( "m_functions.php" );
include_once("manheim_search.php");
////for manheim
$smarty->display("home.tpl");