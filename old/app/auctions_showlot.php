<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";


$partners=getPartners();
$smarty->assign("partners", $partners);

$server_loc = "http://j0.j-lab.ru/search_xml/index.php?mode=lot";

$id = processGetVariable('id');
 
$url = $server_loc."&id=".$id;
//echo $url;
$string = file_get_contents($url);
$string = str_replace("&", '&amp;', $string);

$xml = simplexml_load_string($string);

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
//print_r($xml);

$ret = object2array($xml);
if ($ret['auction']=="manheim") {
	$smarty->assign("data", $ret);	
	$smarty->assign("images", $ret['images']['img']);
	$smarty->assign("spec", $ret['specs'][1]['spec']);
	$smarty->assign("options", $ret['options']['o']);
	//echo 1;

}else {
	
$smarty->assign("data", $ret);
$smarty->assign("images", $ret['images']['img']);
$smarty->assign("spec", $ret['specs']['spec']);
$smarty->assign("cond", $ret['signs']['sign']);
$smarty->assign("title", "Просмотр лота");
}

$smarty->display("auctions_showlot.tpl");


//print_r($ret);

