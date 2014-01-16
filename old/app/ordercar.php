<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";


$partners=getPartners();

$smarty->assign("partners", $partners);



if(isset($_REQUEST['id_c']))
$smarty->assign("id_c", $_REQUEST['id_c']);
if(isset($_REQUEST['brnd']))
$smarty->assign("brnd", $_REQUEST['brnd']);
if(isset($_REQUEST['sec']))
$smarty->assign("sec", $_REQUEST['sec']);


$skype = processPostVariable('skype');
$name = processPostVariable('name');
$email = processPostVariable('email');
$phone = processPostVariable('phone');
$message = processPostVariable('message');
$message1 = processPostVariable('message1');
$make = processPostVariable('make');
$model = processPostVariable('model');
$year = processPostVariable('year');
$keystring = processPostVariable('keystring');

//cost
$mincost = processPostVariable('mincost');
$maxcost = processPostVariable('maxcost');
//city
$city = processPostVariable('city');
$auctp = processPostVariable('auctp');
$lotp = processPostVariable('lotp');
if($auctp)
$message.="Аукцион: ".$auctp."; ";
if($lotp)
$message.="Лот: ".$lotp."; ";
//city

$smarty->assign("skype", $skype);
$smarty->assign("email", $email);
$smarty->assign("name", $name);
$smarty->assign("phone", $phone);
$smarty->assign("message", $message);

//$smarty->assign("mincost", $mincost);
$smarty->assign("maxcost", $maxcost);
$smarty->assign("make", $make);
$smarty->assign("model", $model);
$smarty->assign("year", $year);

$cid = processGetVariable('cid');
if($cid){

	$cid=(int)$cid;
	$auto =getAuto($cid) ;
	//print_r($auto);
	$mode = processGetVariable('mode');
	if($mode){
	if($mode=="boat")
	{
		$boat=getAllBoatbyID1($cid);
		$smarty->assign("make", $boat['brand']);
		$smarty->assign("model", $boat['name']);
		$smarty->assign("year", $boat['year']);
		$message=$message."Тип заказа: покупка лодки; ID: ". $boat['id']."; ";
		$smarty->assign("message", $message);
	}
	if($mode=="moto")
	{
		$moto=getAllMotobyID1($cid);
		$smarty->assign("make", $moto['mark']);
		$smarty->assign("model", $moto['model']);
		$smarty->assign("year", $moto['year']);
		$message=$message."Тип заказа: покупка мотоцикла; ID: ". $moto['id']."; ";
		$smarty->assign("message", $message);
	}
		if($mode=="plane")
	{
		$moto=getAllPlanebyID1($cid);
		$smarty->assign("mark", $moto['mark']);
		$smarty->assign("model", $moto['model']);
		$smarty->assign("year", $moto['year']);
		$message=$message."Тип заказа: покупка самолета; ID: ". $moto['id']."; ";
		$smarty->assign("message", $message);
	}
	if($mode=="machinery")
	{
		$moto=getAllMachinerybyID1($cid);
		$smarty->assign("mark", $moto['mark']);
		$smarty->assign("model", $moto['model']);
		$smarty->assign("year", $moto['year']);
		$message="Тип заказа: покупка техники; ID: ". $moto['id']."; ";
		$smarty->assign("message", $message);
	}
		if($mode=="spares")
	{
		$moto=getAllSparesbyID1($cid);
		$smarty->assign("mark", $moto['mark']);
		$smarty->assign("model", $moto['model']);
		$message="Тип заказа: покупка запчастей; ID: ". $moto['id']."; ";
		$smarty->assign("message", $message);
	}
	}
	else{
	$smarty->assign("make", $auto['brand_name']);
	$smarty->assign("model", $auto['car_name']);
	$smarty->assign("year", $auto['year']);
	}
}
$auction = processGetVariable('auction');
if($auction){
$make = processGetVariable('make');
$model = processGetVariable('model');
$year = processGetVariable('year');
$vin = processGetVariable('vin');
if($auction=='manheim' || $auction=='copart' || $auction=='Copart' || $auction=='carscom' || $auction=='Carscom' || $auction=='ebay' || $auction=='Ebay'){
$dan = processGetVariable('dan');
$message=$message."Данные: ".$dan."; ";
}
$smarty->assign("make", $make);
$smarty->assign("model", $model);
$smarty->assign("year", $year);
if($auction=='copart')
$message=$message."Аукцион: ".$auction."; lot#: ".$vin.";";
elseif($auction=='carscom' || $auction=='ebay')
$message=$message."Аукцион: ".$auction.";";
else
$message=$message."Аукцион: ".$auction."; VIN: ".$vin.";";
$smarty->assign("message", $message);
}

if ($message1) {
if(($name!="")&&($email!="")&&($message!="")&&($phone!="")&&($skype!="")&&($city!="")) {
	if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] ==  $_POST['keystring']){
	//echo "ok!"; 
	$smarty->assign("mode", "ok");
	
	
	if(isset($_REQUEST['brnd']) && $_REQUEST['brnd']=='auto'){
		
			$infcar=getAuto($_REQUEST['id_c']);
			$uid=$infcar['userid'];
			$user=get_user_data($uid);
			$to=$user['email'];
	}
	elseif(isset($_REQUEST['brnd']) && $_REQUEST['brnd']=='moto'){
			$infcar=getAllMotobyID1($_REQUEST['id_c']);
			$uid=$infcar['uid'];
			$user=get_user_data($uid);
			$to=$user['email'];
	}
	elseif(isset($_REQUEST['brnd']) && $_REQUEST['brnd']=='boat'){
			$infcar=getAllBoatbyID1($_REQUEST['id_c'], 0);
			$uid=$infcar['uid'];
			$user=get_user_data($uid);
			$to=$user['email'];
	}
	elseif(isset($_REQUEST['brnd']) && $_REQUEST['brnd']=='plane'){
			$infcar=getAllPlanebyID1($_REQUEST['id_c']);
			$uid=$infcar['uid'];
			$user=get_user_data($uid);
			$to=$user['email'];
	}
	elseif(isset($_REQUEST['brnd']) && $_REQUEST['brnd']=='machinery'){
			$infcar=getAllMachinerybyID1($_REQUEST['id_c'], 0);
			$uid=$infcar['uid'];
			$user=get_user_data($uid);
			$to=$user['email'];
	}
	elseif(isset($_REQUEST['brnd']) && $_REQUEST['brnd']=='spares'){
			$infcar=getAllSparesbyID1($_REQUEST['id_c'], 0);
			$uid=$infcar['uid'];
			$user=get_user_data($uid);
			$to=$user['email'];
	}
	elseif(isset($_REQUEST['brnd']) && $_REQUEST['brnd']=='prod'){
			$infcar=getAllSparesbyID1($_REQUEST['id_c'], 0);
			$uid=$infcar['uid'];
			$user=get_user_data($uid);
			$to=$user['email'];
	}
	elseif(isset($_REQUEST['brnd']) && $_REQUEST['brnd']=='sec'){
			$infcar=getSectBySectId($_REQUEST['brnd'], $_REQUEST['sec']);
			$uid=$infcar['uid'];
			$user=get_user_data($uid);
			$to=$user['email'];
	}
	
	else{
	$to = "automixs@yahoo.co"; //Кому отправлять
	}
	
		//echo'<h1>123456789</h1>'.$to;
	
	//$to = "panik@jerminal.com";
	$from = "noreply@automixs.com"; // от кого :)
	$date = date("d-m-y");
	$subject = "Automixs order ".$date; //чего пишем в заголовке
	//само письмо
	$message_text = ""; 
	$message_text.= "<h1>Заказ авто на Automixs</h1><br />";
	$message_text.= "ФИО: $name<br />";
	//city
	$message_text.= "Адрес: $city<br />";
	//city
	
	$message_text.= "Mарка: $make<br />";
	$message_text.= "Модель: $model<br />";
	$message_text.= "Год выпуска: $year<br />";
	
	//
	$message_text.= "Tel: $phone<br />";
	$message_text.= "skype: $skype<br />";
	$message_text.= "Email: $email<br />";
	$message_text.= "Цена до $maxcost;<br />";
	$message_text.= "Сообщение: $message<br />";
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	
	$headers .= "From: <".$from.">";
	//echo "<pre>";
	//echo $subject."<br />";
	//echo $message_text;
	//echo "</pre>";
	mail($to, $subject, $message_text, $headers);
	$smarty->assign("mode","sent");
	}
	else {
	$smarty->assign("mode", "error");
	$smarty->assign("error", "Не правильно введ код с картинки!");
	}	 
}
else {
	$smarty->assign("mode", "error");
	$smarty->assign("error", "Не заполнены все поля!");
	
}
}

$tip=processGetVariable('tip');
if($tip)
$smarty->assign("title", "Задать вопрос");
$smarty->display("ordercar.tpl")
?>