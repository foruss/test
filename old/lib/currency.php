<?php
require_once("../config.php");
require_once LIB_DIR . "informer.php";

$file1 = ROOT_DIR.'/currency/currency.xml';
$file2 = ROOT_DIR.'/currency/currency_old.xml';
$url1 = 'http://www.nbrb.by/Services/XmlExRates.aspx';
$yearstaday = date("m/d/Y",strtotime("-1 days"));
$url2 = 'http://www.nbrb.by/Services/XmlExRates.aspx?ondate='.$yearstaday;

if (file_exists($file1) && file_exists($file2)){
	 $day = date("d", filemtime($file1));
	 $dayNow = date("d");
	 $change = ($day==$dayNow ? '0':'1');
}
else $change = '1';

if ($change){
  $html_result1251 = http_load_calc($url1, null, null, null, null);
  //$html_result = iconv('WINDOWS-1251', 'UTF-8//TRANSLIT', $html_result1251);

  if (strstr($html_result1251, '<?xml version="1.0"')){
	  $handle = fopen($file1, 'w');
	  fwrite($handle,$html_result1251);
	  fclose($handle);
  }
  
  $html_result1251 = http_load_calc($url2, null, null, null, null);
  //$html_result = iconv('WINDOWS-1251', 'UTF-8//TRANSLIT', $html_result1251);
  if (strstr($html_result1251, '<?xml version="1.0"')){
	  $handle = fopen($file2, 'w');
	  fwrite($handle,$html_result1251);
	  fclose($handle);
  }	  
}


$currency = array();
$currentCurrency = null;
$index = null;

function saxStartElement($parser,$name,$attrs)
{
    global $currentCurrency,$index;
    switch($name)
    {
        case 'DailyExRates':
            $currency = array();
            break;
        case 'Currency':
            $currentCurrency = array();
            if (in_array('Id',array_keys($attrs)))
                $currentCurrency['Id'] = $attrs['Id'];
            break;
        default:
            $index = $name;
            break;
    };
}

function saxEndElement($parser,$name)
{
    global $currency,$currentCurrency,$index;
    if ((is_array($currentCurrency)) && ($name=='Currency'))
    {
        $currency[] = $currentCurrency;
        $currentCurrency = null;
    };
    $index = null;
}

function saxCharacterData($parser,$data)
{
    global $currentCurrency,$index;
    if ((is_array($currentCurrency)) && ($index))
        $currentCurrency[$index] = $data;
}

$parser = xml_parser_create();
xml_set_element_handler($parser,'saxStartElement','saxEndElement');
xml_set_character_data_handler($parser,'saxCharacterData');
xml_parser_set_option($parser,XML_OPTION_CASE_FOLDING,false);
$xml = join('',file($file1));
if (!xml_parse($parser,$xml,true))
    die(sprintf('error XML in file1: %s  %d',
        xml_error_string(xml_get_error_code($parser)),
        xml_get_current_line_number($parser)));
xml_parser_free($parser);

$currencyOld = array();
$currentCurrencyOld = null;
$index = null;

function saxStartElement2($parser,$name,$attrs)
{
    global $currentCurrencyOld,$index;
    switch($name)
    {
        case 'DailyExRates':
            $currencyOld = array();
            break;
        case 'Currency':
            $currentCurrencyOld = array();
            if (in_array('Id',array_keys($attrs)))
                $currentCurrencyOld['Id'] = $attrs['Id'];
            break;
        default:
            $index = $name;
            break;
    };
}

function saxEndElement2($parser,$name)
{
    global $currencyOld,$currentCurrencyOld,$index;
    if ((is_array($currentCurrencyOld)) && ($name=='Currency'))
    {
        $currencyOld[] = $currentCurrencyOld;
        $currentCurrencyOld = null;
    };
    $index = null;
}

function saxCharacterData2($parser,$data)
{
    global $currentCurrencyOld,$index;
    if ((is_array($currentCurrencyOld)) && ($index))
        $currentCurrencyOld[$index] = $data;
}

$parser = xml_parser_create();
xml_set_element_handler($parser,'saxStartElement2','saxEndElement2');
xml_set_character_data_handler($parser,'saxCharacterData2');
xml_parser_set_option($parser,XML_OPTION_CASE_FOLDING,false);
$xml = join('',file($file2));
if (!xml_parse($parser,$xml,true))
    die(sprintf('error XML in file2: %s  %d',
        xml_error_string(xml_get_error_code($parser)),
        xml_get_current_line_number($parser)));
xml_parser_free($parser);
?>
