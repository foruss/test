<?php
$noimageurl='/images/no-image.gif';
$model=$_POST['mdnm'];
$mark=$_POST['mknm'];
switch ($mark)
{
case 1:
$mark="Acura";
break;
case 3:
$mark="Aston Martin";
break;
case 4:
$mark="Audi";
break;
case 463:
$mark="Avanti Motors";
break;
case 6:
$mark="Bentley";
break;
case 5:
$mark="BMW";
break;
case 7:
$mark="Buick";
break;
case 8:
$mark="Cadillac";
break;
case 9:
$mark="Chevrolet";
break;
case 10:
$mark="Chrysler";
break;
case 12:
$mark="Dodge";
break;
case 51:
$mark="Ferrari";
break;
case 14:
$mark="Ford";
break;
case 15:
$mark="GMC";
break;
case 18:
$mark="Honda";
break;
case 363:
$mark="Hummer";
break;
case 19:
$mark="Hyundai";
break;
case 20:
$mark="Infiniti";
break;
case 186:
$mark="International";
break;
case 21:
$mark="Isuzu";
break;
case 22:
$mark="Jaguar";
break;
case 23:
$mark="Jeep";
break;
case 24:
$mark="Kia";
break;
case 25:
$mark="Lamborghini";
break;
case 26:
$mark="Land Rover";
break;
case 27:
$mark="Lexus";
break;
case 28:
$mark="Lincoln";
break;
case 29:
$mark="Lotus";
break;
case 72:
$mark="Maserati";
break;
case 403:
$mark="Maybach";
break;
case 30:
$mark="Mazda";
break;
case 31:
$mark="Mercedes-Benz";
break;
case 32:
$mark="Mercury";
break;
case 303:
$mark="Mini";
break;
case 34:
$mark="Mitsubishi";
break;
case 36:
$mark="Nissan";
break;
case 79:
$mark="Panoz";
break;
case 40:
$mark="Pontiac";
break;
case 41:
$mark="Porsche";
break;
case 52:
$mark="Rolls-Royce";
break;
case 42:
$mark="Saab";
break;
case 43:
$mark="Saturn";
break;
case 423:
$mark="Scion";
break;
case 563:
$mark="Smart";
break;
case 45:
$mark="Subaru";
break;
case 46:
$mark="Suzuki";
break;
case 47:
$mark="Toyota";
break;
case 48:
$mark="Volkswagen";
break;
case 49:
$mark="Volvo";
break;
}


	
	
	if(isset($_GET['make']))	
	$make=$_GET['make'];
	if(isset($_GET['model']))	
	$model=$_GET['model'];
	if(isset($_GET['maxprice']))	
	$maxprice=$_GET['maxprice'];
	$smarty->assign('make', $make);	
	$smarty->assign('model', $model);	
	$smarty->assign('maxprice', $maxprice);	
	$smarty->assign('rn', $_GET['rn']);	
	
	$mynewurl="index.php?mode=searchresults1&trf=$trf&tracktype=$tracktype&make=$make&model=$model&maxprice=$maxprice";
	$smarty->assign('mynewurl', $mynewurl);	
	#     http://www.cars.com/go/search/search_results.jsp?ct=1500&tracktype=usedcc&searchType=22&cid=&dlid=&dgid=&amid=&cname=&rd=&ddrd=30&zc=10001&makeid=5&modelid=&pageNumber=&numResultsPerPage=250&largeNumResultsPerPage=0&sortorder=descending&sortfield=PRICE%20descending&certifiedOnly=false&criteria=K-|E-ANY|M-_5_|H-|N-N|R-10000|I-1|P-PRICE%20descending|Q-descending|X-popular|Z-10001&aff=national
	$newmystrforurl="";
	if(isset($_GET['searchSource']))
	$newmystrforurl.="&searchSource=".$_GET['searchSource'];
	if(isset($_GET['sf1Nm']))
	$newmystrforurl.="&sf1Nm=".$_GET['sf1Nm'];
	if(isset($_GET['sf1Dir']))
	$newmystrforurl.="&sf1Dir=".$_GET['sf1Dir'];
	if(isset($_GET['sf2Nm']))
	$newmystrforurl.="&sf2Nm=".$_GET['sf2Nm'];
	if(isset($_GET['sf2Dir']))
	$newmystrforurl.="&sf2Dir=".$_GET['sf2Dir'];
	$smarty->assign('newmystrforurl', $newmystrforurl);	
	$newmystrforurl2="";
	if(isset($_GET['ldId']))
	$newmystrforurl2.="&ldId=".$_GET['ldId'];
	$smarty->assign('newmystrforurl2', $newmystrforurl2);	
	

$url='http://www.cars.com/go/search/search.jsp?tracktype=newcc&srv=adlocator&aff=national&act=search&searchType=21&szc=10001&flt=zr%2Cn_ms%2Cused&fs=&so=desc&sb=vp&trf='.$trf.'&mknm='
	.urlencode($make).'&mdnm='.urlencode($model).'&minp=0&maxp='.$maxprice.'&rd=10000&zc=10001';
	
	
	
$html_result = http_load( $url,null,null,null,null);
	preg_match("#Location: (.*)#i",$html_result,$location);
	$true_url=trim(str_replace(' ','%20',$location[1]));
	if(isset($_GET['rn']))
	$html_result = http_load($true_url.'&rn='.($_GET['rn']*50-50).$newmystrforurl.$newmystrforurl2,null,null,null,null);
	else
	$html_result = http_load($true_url.$newmystrforurl.$newmystrforurl2,null,null,null,null);
	
	
	
#print $html_result;
#---------section parser--------------------------------------------------------------------------
$pattern =  "#<table[^<>]*class=\"vehicleModule[^<>]*>(.*)</table>#sU";
 
$cars_html_array = html_search_all( $pattern, $html_result );
$i=0;
foreach($cars_html_array as $vehicle){
$car=	$vehicle[1];
$pattern = "#<div[^<>]*class=\"priceColumn\"><span[^>]*>([^<]*)</span></div>[^<]*<div[^>]*><span[^>]*>([^<]*)<#sU";
$tmp = html_search( $pattern, $car );
if (isset($tmp[1])){$cost = trim($tmp[1]);
			$cost = str_ireplace('Not Priced','Не оценен',$cost);
		}
if (isset($tmp[2])){$mileage = str_replace('mi.','миль',trim($tmp[2]));}

//<a href=\"detail\.jsp\;\?([^\"<>]*)\"[^<>]*>\s*<span\s*>([^<>]*)</span>\s*<span\s*>([^<>]*)</span>\s*</a>
$pattern = "#<a\sonClick=\"[^\"]*\"\srel=\"[^\"]*\"\shref=\"/go/search/detail.jsp?([^\"]*)\"><span[^>]*>([^<]*)</span>\s<span[^>]*>([^<]*)<#sU";
$tmp = html_search( $pattern, $car );
if (isset($tmp[1])){
$link = $tmp[1];
if (isset($tmp[2])){$year = $tmp[2];;}
$title = $tmp[3];
}else {
$pattern = "#<a href=\"detail\.jsp\;\?([^\"<>]*)\"[^<>]*>\s*<span\s*>([^<>]*)</span>\s*</a>#sU";
$tmp = html_search( $pattern, $car );
$link = $tmp[1];
$title = $tmp[2];
$year = '';
}


$pattern = "#<div\sclass=\"vehicleDescription\">[^<]*(.*)\s</div>#sU";
$tmp = html_search( $pattern, $car );
if (isset($tmp[1])){
		$description = trim($tmp[1]);
		$description_array = explode(',',$description) ;
		
			$search = array ();
			$replace = array ();
			$search[] = 'Stock#';$replace[] = 'Инв.номер:';
			$search[] = 'Cylinders';$replace[] = 'Цил.';
			$search[] = 'CYLINDER';$replace[] = 'Цил.';
			$search[] = 'CYL';$replace[] = 'Цил.';
			
		foreach ( $description_array as $k => $v )
		{
    		$description_array[$k] = translate( $v, $lang['description'] );
			$description_array[$k]=  str_ireplace($search,$replace,$description_array[$k]);

   			#$description_array[$k] = translate( $description_array[$k], $lang['report']['options']['static'], $lang['report']['options']['dynamic'] );
		}

		$description = implode(', ',$description_array);
}else{$description='';};

$pattern = "#<div\s*class=\"sellerPhone\">([^<>]*)</div>#sU";
$tmp = html_search( $pattern, $car );
if (isset($tmp[1])){$phone = trim($tmp[1]);
$phone = str_replace('Daytime','Днем',$phone);
$phone = str_replace('Evening','Вечером',$phone);
$phone = str_replace('Mobile','Мобильный',$phone);
}else $phone='';
//print_r($car);
//$pattern = "<td\sid=\"[^\"]*\"\sclass=\"photoColumn\">([^<]*)<#i";

$pattern = "#(<img src=\"([^<>\"]*)\"[^<>]*></a>|src=\"([^\"]*)\"/)#sU";
$tmp = html_search( $pattern, $car );
//print_r($tmp);
if (isset($tmp[2]) || isset($tmp[3])){
if(isset($tmp[2]))
$img = 'http://www.cars.com'.$tmp[2];
if(isset($tmp[3]))
$img = $tmp[3];
/*
$img = str_replace('http://images.cars.com/','img.php?img=',$img);
$img = str_replace('/search/images/','img.php?img2=',$img);
*/
}else $img=$noimageurl;

$pattern = "#<div class=\"sellerName\">(.*)</div>#sU";
$tmp = html_search( $pattern, $car );
$dealer = trim ($tmp[1]);
$dealer = ereg_replace("\s*~[^<>]*away",'',$dealer);
$dealer = ereg_replace("<span[^<>]*>Dealer</span>",'',$dealer);
$dealer = ereg_replace("<span[^<>]*>:</span>",'',$dealer);

$pattern = "#<a\s*href=\"([^<>\"]*)\"[^<>]*>\s*<div[^<>]*>\s*<span[^<>]*>Email&nbsp;#sU";
$tmp = html_search( $pattern, $car );
if (isset($tmp[1])){$email = trim ($tmp[1]);}else $email='';


$pattern = "#<span[^<>]*>\s*Certified\s*</span>#sU";
$tmp = html_search( $pattern, $car );
if (isset($tmp[0])){$sertified = 'Сертифицирована';}else $sertified='';


$pattern = "#<a\s*href=\"([^<>\"]*)\"[^<>]*><div[^<>]*><span[^<>]*>Free&nbsp;CARFAX#sU";
$tmp = html_search( $pattern, $car );
if (isset($tmp[1])){$report = trim ($tmp[1]);}else $report='';

$pattern = "#<span\s*class=\"availPhotos\">([^<>]*)</span>#sU";
$tmp = html_search( $pattern, $car );
if (isset($tmp[1])){$avaiblephotos = trim ($tmp[1]);}else $avaiblephotos='0';
$carinfo[$i]['cost']=$cost;
$carinfo[$i]['mileage']=$mileage;
$carinfo[$i]['title']=$title;
$carinfo[$i]['link']=$link;
$carinfo[$i]['img']=$img;
$carinfo[$i]['description']=$description;
$carinfo[$i]['dealer']=$dealer;
$carinfo[$i]['phone']=$phone;
$carinfo[$i]['report']=''; //$report;
$carinfo[$i]['avaiblephotos']=$avaiblephotos;
$carinfo[$i]['year']=$year;
$carinfo[$i]['email']=''; //$email;
$carinfo[$i]['sertified']=$sertified;
$i++;
}


if (empty($carinfo)){$error_results = 'noresults';};
$smarty->assign('carinfo',$carinfo);

#------------------------------------------pagination-----number-of-page-section------------

$pattern =  "#<div\sid=\"pagination\">[^<]*<ul>[^<]*(<li[^>]*>[^<]*</li>[^<]* | <li><a[^>]*>[^<]*</a></li>[^<]*|<li><div[^>]*><a[^>]*>[^<]*</a></div><li>)*#";
//$pattern =  "#<div\s*id=\"pagination\">\s*<ul>(.*)</ul>#sU";///////////////////////////////////////////////////////////////////////////////////////////
$pagination_html = html_search( $pattern, $html_result );
//print_r($html_result);

$page_current = html_search("#<li\sclass=\"selected\">([^<>]*)</li>#sU", $pagination_html[0] );
 if (isset($page_current[1])) {$page_current= $page_current[1];}else {$page_current='';};


$pattern =  "#<a\s*href=\"search_results\.jsp\?([^<>\"]*)\"[^<>]*>([^<>]*)</a>#sU";
$pagination_html_array = html_search_all( $pattern, $pagination_html[0] );

$i=0;
$goto='';
$activelastpage=1;
foreach($pagination_html_array as $ppage){

	$page_link='index.php?mode=searchresults1&pagemode=s&'.$ppage[1];
	$page_title=$ppage[2];
	$page_title=str_replace('Previous','Предыдущая',$page_title);
	$page_title=str_replace('Next','Следующая',$page_title);
	if ($page_title == (int)$page_current+1)
		{$goto .= '<span>'.$page_current.'</span>&nbsp;&nbsp;';
		$activelastpage=0;} 
	$goto .= '<a href="'.$page_link.'">'.$page_title.'</a>&nbsp;&nbsp;';
	}
if ($activelastpage==1) $goto .= '<span>'.$page_current.'</span>';
$smarty->assign('pagination',$goto);
#-------------------------------------------------------
# No finded && num per page
$pattern =  "#<div\s*class=\"listingsResultNumber\"\s*id=\"lrnLower\"\s*>(.*)</div>#sU";
$car_finded_arr = html_search( $pattern, $html_result );
$pattern =  "#(\([^\)]*\))#sU";
$car_finded_arr = html_search( $pattern, $car_finded_arr[1] );
$search = array ();
$replace = array ();
$search[] = 'ong> of ';$replace[] = 'ong> из ';
$search[] = 'Vehicles';$replace[] = 'машин';
$search[] = 'Showing:';$replace[] = 'Показать по:';
$search[] = 'Per page';$replace[] = 'на страницу';
$search[] = 'search_results.jsp?';$replace[] = 'index.php?mode=searchresults1&pagemode=s&';
#$search[] = '';$replace[] = '';
$car_finded=str_replace($search,$replace,$car_finded_arr[1]);
$smarty->assign('car_finded',$car_finded);
//$pattern =  "#>([^<]*)</a></li>[^<]*<li><div\sclass=\"next#i";
$pattern =  "#ong>\sof\s([0-9]*)#i";
$car_с = html_search($pattern, $html_result );
$smarty->assign('colpage',(int)($car_с[1]/50));
$pages_count = ($car_с[1] % 50 == 0 ? $car_с[1] / 50 : floor($car_с[1] / 50) + 1);
if(isset($_GET['rn']))
$page=$_GET['rn'];
else
$page=1;
$pages = array();
$dots = false;
for ($i = 1; $i <= $pages_count; ++$i) {
if ((abs($i - $page) <= 4) || ($i <= 5) || ($i >= $pages_count - 4)) {
$pages[] = array('num' => $i, 'link' => "index.php?mode=searchresults1&trf=$trf&tracktype=$tracktype&make=$make&model=$model&maxprice=$maxprice&rn=$i$newmystrforurl$newmystrforurl2");
$dots = false;
} else if (!$dots) {
$pages[] = array('num' => '...');
$dots = true;
}
}
$smarty->assign('page',$page);
$smarty->assign('pages',$pages);
#------------------------------------------------
$pattern =  "#(<select[^<>]*id=\"sortJump\"[^<>]*name=\"sortJump\"[^<>]*>(.*)</select>)#sU";
$sorter_box = html_search( $pattern, $html_result );
$search = array ();
$replace = array ();
$search[] = 'Price: Highest';$replace[] = 'Цена: с дорогих';
$search[] = 'Price: Lowest';$replace[] = 'Цена: с дешевых';
$search[] = 'Year: Newest';$replace[] = 'Год: новее';
$search[] = 'Year: Oldest';$replace[] = 'Год: старше';
$search[] = 'search_results.jsp?';$replace[] = 'index.php?mode=searchresults1&pagemode=s&';
$search[] = 'Mileage: Lowest';$replace[] =  'Пробег: меньше';
$search[] = 'Mileage: Highest';$replace[] = 'Пробег: больше';
$search[] = 'Vehicles:';$replace[] = 'Машины:';
$search[] = 'Color:';$replace[] = 'Цвет:';
$search[] = 'Body Style:';$replace[] = 'Тип кузова:';
$search[] = ': A to Z';$replace[] = ': от A до Z';
$search[] = ': Z to A';$replace[] = ': от Z до A';
$search[] = 'Distance: Nearest';$replace[] = 'Расстояние: ближе';
$search[] = 'Distance: Farthest';$replace[] = 'Расстояние: дальше';
$search[] = 'Photos: Most';      $replace[] = 'Фото: больше';
$search[] = 'Photos: Least/None';$replace[] = 'Фото: меньше/нет';
$search[] = 'Seller:';$replace[] = 'Продавец:';
$search[] = 'Show Certified First';$replace[] = 'Показать сертифицированные первыми';
$search[] = "_hbLink('Jump Sort By ' + this.options[this.selectedIndex].text);jumpSort(document.getElementById('sortJump'))";$replace[] = 'jumpSort(this)';
$sorter_box=str_replace($search,$replace,$sorter_box[1]);
$smarty->assign('sorter_box',$sorter_box);

#------------------------------------------------














$smarty->assign('error_results', $error_results);	
$smarty->assign('title', "Поиск - результаты");	
	



?>
	