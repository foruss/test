<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";


$partners=getPartners();
$smarty->assign("partners", $partners);

$server_loc = "http://j0.j-lab.ru/search_xml/index.php?mode=search";

$makeid = processGetVariable('makeid');
$model = processGetVariable('model');
$yto = processGetVariable('yto');
$yfrom = processGetVariable('yfrom');
$order = processGetVariable('order');
$page = processGetVariable('page');
if (($page=="") or ($page==0)) $page=1;
$pp = processGetVariable('pp');
$sort = processGetVariable('sort');
$auction = processGetVariable('auction');
 
$url = "&yfrom=".$yfrom."&yto=".$yto."&auction=".$auction."&makeid=".$makeid."&model=".$model."&page=".$page;
$url = $server_loc.$url;
//echo $url;
$string = file_get_contents($url);
//echo $string;
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
$found =  $xml->found;

$pages_count = ($found % 50 == 0 ? $found / 50 : floor($found / 50) + 1);
	$pages = array();
	$dots = false;
	for ($i = 1; $i <= $pages_count; ++$i) {
		if ((abs($i - $page) <= 4) || ($i <= 5) || ($i >= $pages_count - 4)) {
			$pages[] = array('num' => $i, 'link' => "auctions_search.php?mode=search&yfrom=".$yfrom."&yto=".$yto."&makeid=".$makeid."&model=".$model."&page=".$i."&auction=".$auction);
			$dots = false;
		} else if (!$dots) {
			$pages[] = array('num' => '...');
			$dots = true;
		}
	}


$ret = object2array($xml);
//print_r($ret['car']);
$smarty->assign("title", "Результаты поиска на аукционе copart");
if ($found==1) $data[0] = $ret['car']; else $data=$ret['car'];
//print_r($data);
$smarty->assign("data", $data);
$smarty->assign("found", $found);
$smarty->assign('pages', $pages);
$smarty->assign('page', $page);	
if ($page==1)
$smarty->assign('ltp', $pages[0]);	
else
$smarty->assign('ltp', $pages[($page-2)]);	
$smarty->assign('gtp', $pages[$page]);	
//print_r($pages);
$smarty->display("auctions_search.tpl");


