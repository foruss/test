<?php
//echo '123456';
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";
require_once LIB_DIR . "user.php";


$partners=getPartners();
$smarty->assign("partners", $partners);

$smarty->assign('showaddit', true);

$action = processGetVariable('action');

$page = processGetVariable('page');

$userid = $config['user']['id'];

if ($action=="autodelete"){
	$id =processGetVariable('id');
	$id = (int)$id;
	$userid = $config['user']['id'];
	if ($config['user']['admin']!='1') $isusers = checkifusercar($id,$userid);
	else $isusers = "1";
	if ($isusers=='1') {
		deleteusercar($id);
		delAutoCondition($id);
	}
	$smarty->assign("mode", 'delok');
	$smarty->display("office-carlist.tpl");
}
if ($action=="autoshow1"){
	$kol_chb =processPostVariable('kol_chb');
	for($i=1; $i<=$kol_chb; $i++)
	{
		$chb =processPostVariable('ch'.$i);
		if($chb>=0 && $chb<=99999999){
		$id = (int)$chb;
			$userid = $config['user']['id'];
			if ($config['user']['admin']!='1') $isusers = checkifusercar($id,$userid);
			else $isusers = "1";
			if ($isusers=='1') {
			updateShowAutoOk ($id);
		
		}
	}
	
	
	
	}
	if($config['user']['admin']) $carlist = getallcars($config['user']['id']);
	else $carlist = getusercars($userid);
	$smarty->assign('carlist', $carlist);
	$smarty->display("office-carlist.tpl");
}
if ($action=="autoshow2"){
	$kol_chb =processPostVariable('kol_chb');
	for($i=1; $i<=$kol_chb; $i++)
	{
		$chb =processPostVariable('ch'.$i);
		if($chb>=0 && $chb<=99999999){
		$id = (int)$chb;
			$userid = $config['user']['id'];
			if ($config['user']['admin']!='1') $isusers = checkifusercar($id,$userid);
			else $isusers = "1";
			if ($isusers=='1') {
			updateShowAutoNo ($id);
		
		}
	}
	
	
	
	}
	if($config['user']['admin']) $carlist = getallcars($config['user']['id']);
	else $carlist = getusercars($userid);
	$smarty->assign('carlist', $carlist);
	$smarty->display("office-carlist.tpl");
}
if ($action=="pic_delete"){
	$id =processGetVariable('id');
	$id = (int)$id;
	unlink("../forfreeimages/".$id."_auto_.jpg");
	$smarty->assign("mode", 'delok');
	$smarty->display("office-carlist.tpl");
}
if ($action=="autodelete1"){
	$kol_chb =processPostVariable('kol_chb');
	for($i=1; $i<=$kol_chb; $i++)
	{
		$chb =processPostVariable('ch'.$i);
		if($chb>=0 && $chb<=99999999){
		$id = (int)$chb;
			$userid = $config['user']['id'];
			if ($config['user']['admin']!='1') $isusers = checkifusercar($id,$userid);
			else $isusers = "1";
			if ($isusers=='1') {
			deleteusercar($id);
			delAutoCondition($id);
		
		}
	}
	
	
	
	}
	$smarty->assign("mode", 'delok');
	$smarty->display("office-carlist.tpl");
}
if ($action=="autoprod1"){
	$kol_chb =processPostVariable('kol_chb');
	for($i=1; $i<=$kol_chb; $i++)
	{
		$chb =processPostVariable('ch'.$i);
		if($chb>=0 && $chb<=99999999){
		$id = (int)$chb;
			$userid = $config['user']['id'];
			if ($config['user']['admin']!='1') $isusers = checkifusercar($id,$userid);
			else $isusers = "1";
			if ($isusers=='1') {
			prod_car1($id);

		
		}
	}
	
	
	
	}
	$smarty->assign("mode", 'statok');
	$smarty->display("office-carlist.tpl");
}
if ($action=="autoprod2"){
	$kol_chb =processPostVariable('kol_chb');
	for($i=1; $i<=$kol_chb; $i++)
	{
		$chb =processPostVariable('ch'.$i);
		if($chb>=0 && $chb<=99999999){
		$id = (int)$chb;
			$userid = $config['user']['id'];
			if ($config['user']['admin']!='1') $isusers = checkifusercar($id,$userid);
			else $isusers = "1";
			if ($isusers=='1') {
			prod_car2($id);

		
		}
	}
	
	
	
	}
	$smarty->assign("mode", 'statok');
	$smarty->display("office-carlist.tpl");
}
if ($action=="productdelete"){
	$id =processGetVariable('id');
	$id = (int)$id;
	if ($config['user']['admin']='1') $isusers = 1;
	if ($isusers=='1') delProduct($id);
	$smarty->assign("mode", 'delok');
	$smarty->display("office-productlist.tpl");
}
if ($action=="productedit"){
	$id =processGetVariable('id');
	$id = (int)$id;
	if ($config['user']['admin']!='1') die(403);
	$product = getProduct($id) ;
	$smarty->assign("product",$product);
	$smarty->display("prod_edit.tpl");
}
if ($action=="productsave"){
	//print_r($_POST);
	$id =processPostVariable('id');
	$id = (int)$id;
	$name= processPostVariable('name');
	$price = (int)processPostVariable('price');
	$currency = processPostVariable('currency');
	$bestoffers = (int)processPostVariable('bestoffers');
	$for_free_text = processPostVariable('for_free_text');
	$description = processPostVariable('description');
	$model = processPostVariable('model');
	$sost = processPostVariable('sost');
	$kol = (int)processPostVariable('kol');
	//удал€ем лишние пробелы
	$description=trim($description);
	//переносим строки
	$description = str_replace("\n", "<br />", $description);
	//require_once('resize.php');
	if ($_FILES['photo_free']["error"] == UPLOAD_ERR_OK) {
//echo "<a href='/forfreeimages/$id _product_.jpg'>1</a>";
			 //resizepic($_FILES['photo_free']["tmp_name"], "/forfreeimages/".$id."_product_.jpg", 290, 163);
			//copy($_FILES['photo_free']['tmp_name'],"/forfreeimages/54_product_.jpg");
			require_once('resize.php');

		if ($_FILES['photo_free']["error"] == UPLOAD_ERR_OK) {

			resizepic($_FILES['photo_free']["tmp_name"], "../forfreeimages/".$id."_product_.jpg", 290, 163);
			
		}
		}
	if ($config['user']['admin']='1') $isusers = 1;
	if ($isusers=='1') editProduct($id, $name, $price, $currency, $description, $bestoffers, $for_free_text, $model, $sost, $kol);
	$smarty->display("prod_edit_ok.tpl");
}
elseif($action=="productlist"){
	list($count,$productlist) = listProducts(1);
	//print_r($productlist);
	$smarty->assign('productlist', $productlist);
	$smarty->display("office-productlist.tpl");	
}
elseif ($action =="autoappr") {
	$id =processGetVariable('id');
	autoapprove($id);
	$smarty->display('office-approved.tpl');
}
elseif ($action == "autoedit") {
	$id = processGetVariable('id');
	$id=(int)$id;
	if ($config['user']['admin']!='1') $isusers = checkifusercar($id,$userid);
	else $isusers = "1";
	$brandcategor = listBrandsNames();
	$smarty->assign('brandcategor',$brandcategor);
	
	if ($isusers=='1') {
	
		//редактируем в общем :)
		$auto = getcardata($id);
		//print_r($auto);
		//print_r($auto);
		$auto['content'] = str_replace("<br />", "\n", $auto['content']);
		
		$smarty->assign("auto", $auto);
		$auto1 =getcardata_new($id);
		//print_r($auto1);
		$smarty->assign("auto1", $auto1);
		//$smarty->assign("id");
		$typeeng = listTypeEngine();
		$smarty->assign("typeeng", $typeeng);
		
		//тип кузова
		$bodytype=listBodyType();
		$smarty->assign("bodytype",$bodytype);
		
		// доп инфа
		$addition = listAddition();
		$smarty->assign("addition", $addition);
		
		//id sobstvenno
		$smarty->assign("id", $id);
	
		$add = getAutoAdd($id);
		$smarty->assign("add", $add);
//		print_r($add);		
		$conditions = getConditions();
		$auto_conditions = getAutoCondition($id);
		foreach($conditions as $k=>$c){
			$conditions[$k]['value'] = $auto_conditions[$c['name_db']];
		}
		$smarty->assign('conditions', $conditions);
		/*echo "<pre>";
		print_r($conditions);
		print_r($auto_conditions);
		echo "</pre>";*/
		//$smarty->assign('auto_condition', $auto_condition);
		
		$smarty->display("auto_edit.tpl");
		
	}
	else {
		header('403');
		die('You have no rights!');
	}
	
}
elseif ($action=="autosave") {

	$id = processPostVariable('id');
	
	// проверка на доступность
	if ($config['user']['admin']!='1') $isusers = checkifusercar($id,$userid);
	else $isusers = "1";
	
	if ($isusers=='1') {
$id=(int)$id;
	deleteCarsPovtAdd($id);
			//geting variables
			$transmission= processPostVariable('transmission');
			$model= processPostVariable('model');
			$modif = processPostVariable('modif');
			$obem = processPostVariable('obem');
			$typeeng = processPostVariable('typeeng');
			$way = processPostVariable('way'); // пробег
			$tp = processPostVariable('tp'); //мили/км
			$kpp =processPostVariable('kpp');
			$typekyzov =processPostVariable("typekyzov");
			$color = processPostVariable('color');
			$year = processPostVariable("year");
			$price =processPostVariable("price");
			$cash =processPostVariable("cash");
			$category=processPostVariable("category");
			$vin = processPostVariable("vin");
			$color_salon = processPostVariable("color_salon");
			$auto_title = processPostVariable("title");
			$tip_cat = processPostVariable("tip_cat");
			
			if (!$config['user']['admin']=='1') {
				$category ='0'; 
				$show = '1';
			}
			else $show = '1';
			
			
			//получаем описание
			$content = processPostVariable('content');
			//удал€ем лишние пробелы
			$content=trim($content);
			//переносим строки
			
			$content = str_replace("\n", "<br />", $content);

			//ADD
			$city = processPostVariable('city');
			$name = processPostVariable('name');
			$surname = processPostVariable('surname');
			$city2 = processPostVariable('city2');
			$phone = processPostVariable('phone'); 
			$oldprice =processPostVariable('priceold');
			if (!$config['user']['admin']=='1') $oldprice ='0';
			
			$periodid = (int)processPostVariable('period');
			switch ($periodid) {
				case 1: $period = '1 WEEK';
					break;
				case 2: $period = '2 WEEK';
					break;
				case 3: $period = '3 WEEK';
					break;
				case 4: $period = '2 MONTH';
					break;
				case 5: $period = '3 MONTH';
					break;
				default:
					$period = '1 SECOND';
			}
			
			//куплен у офиц. диллера
			$diller = processPostVariable('diller');
			//куплен заграницой
			$foreign = processPostVariable('foreign');
			 //обслуж. у офиц. диллера
			 $dilservice = processPostVariable('dilservice');
			//
			$owners =processPostVariable('owners');
			$repair = processPostVariable('repair');
			
			//$userid = GetUserId($id);
			$garanty=processPostVariable('garanty');
			//echo $userid;
			$userid = $config['user']['id'];
			
			//FIX ME
			$conditions = getConditions();
			$auto_conditions = array();			
			foreach ($conditions as $c){
				$auto_conditions[$c['id']] = (int)processPostVariable($c['name_db']);
			}
		$raspol = processPostVariable("raspol");	
		$for_free_text = processPostVariable("for_free_text");	
		$for_free_link = processPostVariable("for_free_link");	
		
		require_once('resize.php');

		if ($_FILES['photo_free']["error"] == UPLOAD_ERR_OK) {

			resizepic($_FILES['photo_free']["tmp_name"], "../forfreeimages/".$id."_auto_.jpg", 290, 163);
			
		}
	SaveCar_for_free($id, $raspol, $for_free_text, $for_free_link);
	SaveCar($id, $userid, $content, $model, $color, $year, $price, $way, $tp, $typeeng,$category ,$modif, $obem, $typekyzov, $kpp, $cash,$city, $name, $surname, $city2, $phone, $oldprice,$period,$diller,$foreign,$dilservice,$owners,$repair,$userid, $show,$garanty, $vin, $auto_title, $tip_cat, $color_salon, $transmission);
	updateAutoCondition($id,$auto_conditions);
	//deleting addittion
	
	//updating addittion
	for ($i = 1; $i<=36; $i++)
  		{
    	$ad = processPostVariable('ad'.$i);
    	if ($ad == '1') addAddition($id,$i);
  		}
	}
	else {
		header('403');
		die('You have no rights!');
	}
	$smarty->display("auto_save.tpl");
}
elseif ($action=="autosold") {
	require_once LIB_DIR.'sold.php';
	
	$id = processGetVariable('id');
	$id=(int)$id;
	// cheking if admin
	if ($config['user']['admin']=='1') {
		addSold($id);
		$smarty->display("sold-ok.tpl");
	}
	else die('no rights');
	
}
elseif($action == "getonaprovalcars"){
	$carlist = getonaprovalcars();
	
	$smarty->assign('carlist', $carlist);
	$smarty->display("office-approve.tpl");		
}
elseif ($action == "faqlist") {
	$page = (int)$page;
	if ($page<1) $page ='1';
	list($count,$faqlist) = faq_alist($page);
	$pages_count = ($count % 12 == 0 ? $count / 12 : floor($count / 12) + 1);
	$pages = array();
	$dots = false;
	for ($i = 1; $i <= $pages_count; ++$i) {
		if ((abs($i - $page) <= 4) || ($i <= 5) || ($i >= $pages_count - 4)) {
			$pages[] = array('num' => $i, 'link' => "/office/faq/$i/");
			$dots = false;
		} else if (!$dots) {
			$pages[] = array('num' => '...');
			$dots = true;
		}
	}
	
	$smarty->assign("faqlist", $faqlist);
	$smarty->assign('pages', $pages);
	$smarty->assign('page', $page);	
	$smarty->display("faq-list.tpl");	
}
elseif ($action=="faqedit"){
	if ($config['user']['admin']=='0') die(403);
	$id = processGetVariable('id');
	$id =(int)$id;
	$faq = faq_get($id);

	$faq['message'] = str_replace("<br />", "\n", $faq['message']);

	$faq['answer'] = str_replace("<br />", "\n", $faq['answer']);

	$smarty->assign("faq", $faq);

	$smarty->display("faq-edit.tpl");

}

elseif ($action=="faqsave") {

	if ($config['user']['admin']=='0') die(403);

	$id = processPostVariable('id');

	$name = processPostVariable('name');

	$email = processPostVariable('email');

	$city = processPostVariable('city');

	$category = processPostVariable('category');

	$message = processPostVariable('message');

	//переносим строки

	$message = str_replace("\n", "<br />", $message);

	$answer = processPostVariable('answer');

	//	переносим строки

	$answer = str_replace("\n", "<br />", $answer);	

	

	faq_save ($id, $name, $email, $city, $category, $message, $answer);

	

	$smarty->display("faq-saveok.tpl");

}

elseif ($action=="faqdelete"){

	$id = processGetVariable('id');

	$id =(int)$id;

	if ($config['user']['admin']=='0') die(403);

	faq_delete ($id);

	$smarty->display("faq-delok.tpl");

}
elseif ($action=="faqapprove"){

	$id = processGetVariable('id');
	$id =(int)$id;
	if ($config['user']['admin']=='0') die(403);
	faq_approve($id);
	$smarty->display("faq-approveok.tpl");
}
elseif ($action=="faqdisapprove"){

	$id = processGetVariable('id');
	$id =(int)$id;
	if ($config['user']['admin']=='0') die(403);
	faq_disapprove($id);
	$smarty->display("faq-disapproveok.tpl");
}

elseif ($action=="faqblockip"){

	$ip = processGetVariable('ip');

	$ip = mysql_escape_string($ip);

	if ($config['user']['admin']=='0') die(403);

	faq_block_ip ($ip);

	$smarty->display("faq-blockok.tpl");

}
elseif ($action=="addmodel") {
	$brands = listBrandsNames();
	$smarty->assign("brands", $brands);
	$smarty->assign("mode", 'add');
	$smarty->display('office-addmodel.tpl');	
}
elseif ($action=="savemodel") {
	$make=processPostVariable('make');
	$model = processPostVariable('model');
	
	$brands = listBrandsNames();
	$smarty->assign("brands", $brands);
	
	if ($make=="") {
		$smarty->assign("model", $model);
		$smarty->assign("error", "¬ыберите марку!");
		$smarty->assign("mode", "add");		
	}
	elseif ($model=="") {
	
	$smarty->assign("make", $make);
	
	$smarty->assign("error", "¬ведите модель!");
	$smarty->assign("mode", "add");				
	}
	else {
		if (ChechkIfExist($make, $model))	{
		addmodeltobase($make, $model);	
		$smarty->assign("mode", "addok");
		}
		else {
		$smarty->assign("error", "ƒанна€ модель уже есть в базе!");
		$smarty->assign("mode", "add");					
		}
	}
	$smarty->display("office-addmodel.tpl");
}
elseif($action!="productedit") {
	if($config['user']['admin']) $carlist = getallcars($config['user']['id']);
	else $carlist = getusercars($userid);
	$smarty->assign('carlist', $carlist);
	$smarty->display("office-carlist.tpl");
}

?>