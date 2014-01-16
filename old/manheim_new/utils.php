<?php
//require_once("../config.php");

function processPostVariable ($postVar) {
	if (!isset($_POST[$postVar])) {
		return "";
	}
	if (preg_match("/^\s*$/", $_POST[$postVar])) {
		return "";
	}
	return trim($_POST[$postVar]);
}

function processGetVariable ($getVar) {
	if (!isset($_GET[$getVar])) {
		return "";
	}
	if (preg_match("/^\s*$/", $_GET[$getVar])) {
		return "";
	}
	return trim($_GET[$getVar]);
}

function translitString($str) {
	$str = mb_strtolower($str);
	$conversionArray = array("а" => "a", "б" => "b", "в" => "v",
		"г" => "g", "д" => "d", "е" => "e", "ё" => "yo", "ж" => "zh",
		"з" => "z", "и" => "i", "й" => "j", "к" => "k", "л" => "l", "м" => "m",
		"н" => "n", "о" => "o", "п" => "p", "р" => "r", "с" => "s", "т" => "t",
		"у" => "u", "ф" => "f", "х" => "h", "ц" => "c", "ч" => "ch", "ш" => "sh",
		"щ" => "sch", "ъ" => "", "ы" => "y", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya");
	$str = strtr($str, $conversionArray);	
	
	$newstr = "";
	$array = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);
	foreach ($array as $char) {
		if (!strstr("abcdefghijklmnopqrstuvwxyz1234567890", $char)) {
			$newstr .= "_";
		} else {
			$newstr .= $char; 
		}
	}
	return $newstr;
}

function getCountryName($mode) {
	if ($mode == 'by' || $mode == 1) {
		return "Беларусь";
	} else {
		return "Россия";
	}
}

function listSplit($list) {
	$rcount = count($list);
	if ($rcount % 2 == 0) {
		$half = (int)$rcount / 2;
	} else {
		$half = (int)(($rcount + 1) / 2);
	}
	
	$duallist = array();
	for($i = 0; $i < $half; ++$i) {
		if ($i + $half >= $rcount) {
			$duallist[] = array($list[$i], array());
		} else {
			$duallist[] = array($list[$i], $list[$i+$half]);
		}
	}
	return $duallist;
}
