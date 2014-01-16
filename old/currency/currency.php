<?php
//require_once 'graphic.php';
set_time_limit(0);

function http_load($url, $referer = null, $cookies = array( ), $login = array( ), $post_fields = array( ), $session_save = true, $cookie_name = "cookies", $user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)", $header = 0, $follow_location = 0,$megamode=0){
    $ch = curl_init( );
    curl_setopt( $ch, CURLOPT_REFERER, isset( $referer ) ? $referer : $url );
    if ( !empty( $post_fields ) )
    {
        if ( is_array( $post_fields ) )
        {
            $post_string = "";
            foreach ( $post_fields as $key => $value )
            {
                if ( is_array( $value ) )
                {
                    foreach ( $value as $value2 )
                    {
                        $post_string .= urlencode( $key )."=".urlencode( $value2 )."&";
                    }
                }
                else
                {
                    $post_string .= urlencode( $key )."=".urlencode( $value )."&";
                }
            }
        }
        else
        {
            $post_string = $post_fields;
        }
       
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_string );
    }
    
    curl_setopt( $ch, CURLOPT_TIMEOUT, 60 );
    curl_setopt( $ch, CURLOPT_VERBOSE, 1 );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_USERAGENT, $user_agent );
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_HEADER, $header );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
    if ( !empty( $_SESSION[$cookie_name] ) && $session_save )
    {
        $all_cookies = "";
        foreach ( $_SESSION[$cookie_name] as $cookie_name => $cookie_value )
        {
            $all_cookies .= urlencode( $cookie_name )."=".urlencode( $cookie_value ).";";
        }
        curl_setopt( $ch, CURLOPT_COOKIE, $all_cookies );
    }
    if ( !empty( $login ) )
    {
        curl_setopt( $ch, CURLOPT_USERPWD, $login['user'].":".$login['password'] );
    }

    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, $follow_location );
    $result = curl_exec( $ch );
    curl_close( $ch );
    return $result;
}

function html_search($pattern, $subject ){
    preg_match( $pattern, $subject, $matches );
    return $matches;
}

function getCurrencyOnDate($date, $filename){ // ���� � ������� dd.mm.yyyy , ������ ��� ����� 
	if (!$date) 
	$url = "http://www.cbr.ru/scripts/XML_daily.asp";
	else{
		$year = date("Y",$date);
	$month = date("m", $date);
		$url = "http://www.cbr.ru/scripts/XML_daily.asp?C_month=$month&C_year=$year&date_req=$date";
	}
	//?date_req=30.01.2010
	//echo "-------------";
	//echo $date;
	$html_result = http_load($url, null, null, null, null);
	if (strstr($html_result, '<?xml version="1.0"')){
		  $handle = fopen($filename, 'w');
		  fwrite($handle,$html_result);
		  fclose($handle);
		  return true;
	}	
	return false;
}

function getCurrencyForPeriod($daysCount = 93, $path = "xml/"){
	for ($i = 0; $i <= $daysCount; $i++){
		$iDate = date("d.m.Y",strtotime("-$i days"));
		$iFile = $path.$iDate.'.xml';
		if (!file_exists($iFile)){
			getCurrencyOnDate($iDate, $iFile);
		}
	}
	for ($i = $daysCount + 1; $i < $daysCount + 31; $i++){
		$iDate = date("d.m.Y",strtotime("-$i days"));
		$iFile = $path.$iDate.'.xml';
		if (file_exists($iFile)){
			unlink($iFile);
		}
	}
}

function parseCurrencyFromXMLFile($file){
	global $currency, $currentCurrency, $index;	
	$currency = array();
	$currentCurrency = null;
	$index = null;
	if(!function_exists('saxStartElement')){
		function saxStartElement($parser,$name,$attrs){
		    global $currentCurrency,$index;
		    switch($name){
		        case 'ValCurs':
		            $currency = array();
		            break;
		        case 'Valute':
		            $currentCurrency = array();
		            if (in_array('ID',array_keys($attrs))) $currentCurrency['ID'] = $attrs['ID'];
		            break;
		        default:
		            $index = $name;
		            break;
		    };
		}
		function saxEndElement($parser,$name){
		    global $currency,$currentCurrency,$index;
		    if ((is_array($currentCurrency)) && ($name=='Valute')){
		    	$currentCurrency['Value'] = str_replace(',','.',$currentCurrency['Value']) ;
		        $currency[] = $currentCurrency;
		        $currentCurrency = null;
		    };
		    $index = null;
		}
		function saxCharacterData($parser,$data){
		    global $currentCurrency,$index;
		    if ((is_array($currentCurrency)) && ($index)) $currentCurrency[$index] = $data;
		}
	}
	$parser = xml_parser_create();
	xml_set_element_handler($parser,'saxStartElement','saxEndElement');
	xml_set_character_data_handler($parser,'saxCharacterData');
	xml_parser_set_option($parser,XML_OPTION_CASE_FOLDING,false);
	$xml = join('',file($file));
	//echo'<br>';
	//echo $xml;
	//echo'<br>';
	$xml=iconv('windows-1251', 'UTF-8',$xml); 
	//echo $xml;
	//echo'<br>';
	if (!xml_parse($parser,$xml,true))
	   die(sprintf('error XML in file1: %s  %d',
	        xml_error_string(xml_get_error_code($parser)),
	        xml_get_current_line_number($parser)));
	xml_parser_free($parser);
	return $currency;
}

function parseCurrencyForPeriod($daysCount = 93, $path = "xml/"){
	$MonthCurrency = array();
	for ($i = 0; $i <= $daysCount; $i++){
		$iDate = date("d.m.Y",strtotime("-$i days"));
		$iFile = $path.$iDate.'.xml';
		//echo $iFile;
		
		if (file_exists($iFile)){
			$MonthCurrency[$i] = parseCurrencyFromXMLFile($iFile);
		}
		
	}
	
	return $MonthCurrency;
}

function getMainCurrency($currency){
	$eur = $currency[0][10]['Value'];
	$usd = $currency[0][9]['Value'];
	$eurOld = $currency[1][10]['Value'];
	$usdOld = $currency[1][9]['Value'];
	//print_r($currency);
	for($i = 0; $i < 2; $i++){
		if($eurOld==$eur) $eurOld = $currency[$i][10]['Value'];
		if($usdOld==$usd) $usdOld = $currency[$i][9]['Value'];	
	}
	$curs['eur_usd'] = round($eur/$usd,3);
	$curs['eur_rub'] = round($eur,3);
	$curs['usd_rub'] = round($usd,3);
	//echo $eur.'--1--<br>';
	//echo $usd.'---2--<br>';
	//echo $eurOld.'--3--<br>';
	//echo $usdOld.'---4--<br>';
	$curs['eur_usd_rate'] = ($eur/$usd)>=($eurOld/$usdOld)?'up':'';
	$curs['eur_rub_rate'] = ($eur)>=($eurOld)?'up':'';
	$curs['usd_rub_rate'] = ($usd)>=($usdOld)?'up':'';
	return $curs;
}

function loadCurrencyIntoPhp($currency, $filename){
	$curs = getMainCurrency($currency);
	$date = date("d.m.Y");
	$fp=fopen($filename,"w");
	fputs($fp,'<?php'."\n");
	fputs($fp,'$curs = array();'."\n");
	fputs($fp,'$curs["eur_usd"] = '.$curs['eur_usd'].';'."\n");
	fputs($fp,'$curs["eur_rub"] = '.$curs['eur_rub'].';'."\n");
	fputs($fp,'$curs["usd_rub"] = '.$curs['usd_rub'].';'."\n");
	fputs($fp,'$curs["eur_usd_rate"] = "'.$curs['eur_usd_rate'].'";'."\n");
	fputs($fp,'$curs["eur_rub_rate"] = "'.$curs['eur_rub_rate'].'";'."\n");
	fputs($fp,'$curs["usd_rub_rate"] = "'.$curs['usd_rub_rate'].'";'."\n");
	fputs($fp,'$curs["date"] = "'.$date.'";'."\n");
	fputs($fp,'?>');
	fclose($fp);
	return $curs;
}

function getDataForGraphicUSAtoRUB($currency){
	$min = $max = round($currency[1][4]['Value'],3);
	for ($i = 0; $i < 90; $i++){
		$days = 90-$i;
		$dates[$i] = date("d/m",strtotime("-$days days"));
		$points[$i] = round($currency[90-$i][4]['Value'],3);
		$min = min($min,$points[$i]);
		$max = max($max,$points[$i]);
	}
	$dates[] = date("d/m");
	$interval = $max-$min;
	$min -= $interval/20;
	$max += $interval/20;	
	return array($points, $dates, $min, $max);	
}

function getDataForGraphicEURtoUSD($currency){
	$min = $max = round($currency[1][5]['Value']/$currency[1][4]['Value'],3);
	for ($i = 0; $i < 90; $i++){
		$days = 90-$i;
		$dates[$i] = date("d/m",strtotime("-$days days"));
		$points[$i] = round($currency[90-$i][5]['Value']/$currency[90-$i][4]['Value'],3);
		$min = min($min,$points[$i]);
		$max = max($max,$points[$i]);
	}
	$dates[] = date("d/m");
	$interval = $max-$min;
	$min -= $interval/20;
	$max += $interval/20;
	//$min = floor($min);
	//$max = ceil($max);	
	return array($points, $dates, $min, $max);	
}

$currency = array();
$currentCurrency = null;
$index = null;
//��� ������ �� �����
/*
getCurrencyForPeriod();
$result = parseCurrencyForPeriod();
*/
//��� �������� ����� � �����
//echo "--1--";
getCurrencyForPeriod(2,"xml/");
//echo "--2--";
$result = parseCurrencyForPeriod(2,"xml/");
//echo "--3--";
$curs = loadCurrencyIntoPhp($result, 'php/current.php');
//echo "--4--";
// ������ ������� ������ ############################################
/*
$DATA=getDataForGraphicUSAtoRUB($result);
$DATA1=getDataForGraphicEURtoUSD($result);
$today = date("Y-m-d");
$yestoday = date("Y-m-d",strtotime("-1 days"));
drawGraphic($DATA, "png/".$today."_usd-rub.png");
drawGraphic($DATA1, "png/".$today."_eur-usd.png");
if (file_exists("png/".$yestoday."_usd-rub.png")){
	unlink("png/".$yestoday."_usd-rub.png");
}
if (file_exists("png/".$yestoday."_eur-usd.png")){
	unlink("png/".$yestoday."_eur-usd.png");
}
*/
?>