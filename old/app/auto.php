<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";
$tip_cat = processGetVariable('tip_cat');
if ($tip_cat!=1)
$tip_cat=0;
$partners=getPartners();
$smarty->assign("partners", $partners);

$smarty->assign("prototype", true);
$mode = processGetVariable('mode');

$search_brands = getMainSearchBrands();
$smarty->assign("search_brands", $search_brands);
//print_r($search_brands);
$search_engine =getMainSearchEngine ();
$smarty->assign("search_engine", $search_engine);
if ($mode=="search")
$tip_cat=0;
if ($mode=="search1")
$tip_cat=1;
$LeftAutoBrands = getAutoBrands($tip_cat);
$smarty->assign("leftbrands",$LeftAutoBrands);




if ($mode=="autoprod1"){

			$userid = $config['user']['id'];
			if ($config['user']['admin']!='1') $isusers = checkifusercar($id,$userid);
			else $isusers = "1";
			if ($isusers=='1') {
			$kol_chb =processGetVariable('id');
			prod_car1($id);

		
		}
	
	$smarty->assign("mode", 'statok');
	$smarty->display("office-carlist.tpl");
}
if ($mode=="autoprod2"){
	$userid = $config['user']['id'];
			if ($config['user']['admin']!='1') $isusers = checkifusercar($id,$userid);
			else $isusers = "1";
			if ($isusers=='1') {
			$kol_chb =processGetVariable('id');
			prod_car2($id);

		
		}
	
	$smarty->assign("mode", 'statok');
	$smarty->display("office-carlist.tpl");
}





if ($mode=="addphoto1") {
	
	$insid = processPostVariable('insid');
	if ($insid=="") $insid = processGetVariable('insid');
	
	$id = $insid;
	$smarty->assign("insid", $insid);

 	
 //	
	require_once('resize.php');
	$id = $insid;
	//print_r($_FILES);
	
	foreach ($_FILES as $key=>$allFiles) {
	if($allFiles['error']==0){
	//echo $key."--";
	$iter = str_replace("pic", "", $key); 

	//$iter=preg_replace('pic','',$key);
	//echo $iter."--";
	$iter=(int)$iter;
	//echo $iter;
	resizepic($allFiles['tmp_name'], "../carimages/".$id."_".$iter.".jpg", 700, 400);
	resizepic($allFiles['tmp_name'], "../carimages/".$id."_".$iter."m.jpg", 134, 108);
	}
	} 
	/*
	for($j=1;$j<=50; $j++){
	
		if ($_FILES["pic".$j]['error']==0) {
		
			echo $j."--".$_FILES["pic".$j]["error"]."<br>";
			$fname = $_FILES["pic".$j]["tmp_name"];
			resizepic($fname, "../carimages/".$id."_".$j.".jpg", 700, 400);
			resizepic($fname, "../carimages/".$id."_".$j."m.jpg", 134, 108);
		}
		}
		*/

 	//$smarty->assign("data", $DATA);
 		$photos = array();
 		$photos_load = array();
	$it=1;
	while ($it<50) {
  		$filename="../carimages/".$id."_".$it."m.jpg";
		$filename1 ="../carimages/".$id."_".$it.".jpg";
  		if (file_exists($filename) && file_exists($filename1)) {
  		$photos[$it] = array(
  		 	'link_thum'=> $id."_".$it."m.jpg",	
  			'link_thumb'=> $id."_".$it."m.jpg",
  			'link_large'=> $id."_".$it.".jpg",
  			'link_id'=>$it,
  			
  		);			
		}else {
		$photos_load[$it] = array(
  			'link_id'=>$it
  		);	
		} 
		$it++;
 	}
	$smarty->assign("id", $insid);
 	$smarty->assign("photos", $photos);
 	$smarty->assign("photos_load", $photos_load);
 	$smarty->display("auto_add_ok1.tpl");
}




if ($mode=="edit_foto") {
 	
 //	
	
 $id = processGetVariable('insid');
 

 $DATA = array();
	$DATA = "";
		$it=1;
		while ($it<51) {
  		$filename="../carimages/".$id."_".$it."m.jpg";
		$filename1="../carimages/".$id."_".$it.".jpg";
  		if (file_exists($filename) && file_exists($filename1)) {
  		$photos[$it] = array(
  		 	'link_thum'=> $id."_".$it."m.jpg",	
  			'link_thumb'=> $id."_".$it."m.jpg",
  			'link_large'=> $id."_".$it.".jpg",
  			'link_id'=>$it,
  			
  		);			
		}else {
		$photos_load[$it] = array(
  			'link_id'=>$it
  		);	
		} 
		$it++;
 	}
 
 

 $smarty->assign("id", $id);
 
$smarty->assign("photos", $photos);
 	$smarty->assign("photos_load", $photos_load);
 	//print_r($photos_load);
 	//print_r($DATA);
	$smarty->display("auto_add_ok1.tpl");

}


if ($mode=="foto_del") {
 	
 //	
$id = processGetVariable('id');
	$id=(int)$id;
$insid = processGetVariable('insid');
	$insid=(int)$insid;
	$filename="../carimages/".$id."_".$insid."m.jpg";
	if (file_exists($filename))
	unlink($filename);
	unset($filename);
	$filename="../carimages/".$id."_".$insid.".jpg";
	if (file_exists($filename))
	unlink($filename);
	//delAutoPhoto($id,$insid);
	header("Location: /app/auto.php/?mode=edit_foto&insid=".$id);

}




if ($mode=="add") {
	$brandcategor = listBrandsNames();
	$smarty->assign('brandcategor',$brandcategor);
	$typeeng = listTypeEngine();
	$smarty->assign("typeeng", $typeeng);
	//тип кузова
	$bodytype=listBodyType();
	$smarty->assign("bodytype",$bodytype);
	// доп инфа
	$addition = listAddition();
	$smarty->assign("addition", $addition);
	
	$conditions = getConditions();
	$smarty->assign('conditions', $conditions);
	$smarty->display('auto_add.tpl');
}
elseif ($mode=="getmodel") {
	//получаем модели для AJAX
	$id = processPostVariable('id');
	$modelcategor = listModelNames($id);
	$smarty->assign('modelcategor',$modelcategor);
	$smarty->display("auto_model.tpl");
}
elseif ($mode=="addcar") {
	$color_salon= processPostVariable('color_salon');
	$model= processPostVariable('model');
	if(!isset($model) || $model==''){
	echo "Ошибка загрузки - возможно вы отправили очень большие фото!";
	}else{

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
	$tip_cat=processPostVariable("tip_cat");
	$vin = processPostVariable("vin");
	$auto_title = processPostVariable("title");
	
	$transmission = processPostVariable("transmission");

	if (!$config['user']['admin']=='1') {
		$category ='0'; 
		$show = '0';
	}
	else $show = '1';
	$content = processPostVariable('content');
	//удаляем лишние пробелы
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
	$garanty = processPostVariable('garanty');
	if (!$config['user']['admin']=='1') $oldprice ='0';
	$periodid = (int)processPostVariable('period');
	switch ($periodid) {
	case 1: $period = '1 WEEK';
	break;
	case 2: $period = '2 WEEK';
	break;
	case 3: $period = '3 WEEK';
	break;
	case 4: $period = '1 MONTH';
	break;
	case 5: $period = '2 MONTH';
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
			$userid = $config['user']['id'];	

			$conditions = getConditions();
			$auto_conditions = array();
			foreach ($conditions as $c){
				$auto_conditions[$c['id']] = (int)processPostVariable($c['name_db']);
			}
			$raspol = processPostVariable('raspol');
			$for_free_text = processPostVariable('for_free_text');
			$for_free_link = processPostVariable('for_free_link');
			$insid = addCar($raspol, $for_free_text, $for_free_link, $color_salon, $tip_cat, $content, $model, $color, $year, $price, $way, $tp, $typeeng,$category ,$modif, $obem, $typekyzov, $kpp, $cash,$city, $name, $surname, $city2, $phone, $oldprice,$period,$diller,$foreign,$dilservice,$owners,$repair,$userid, $show, $garanty, $vin, $auto_title, $transmission);
			addAutoCondition($insid, $auto_conditions);
			if($config['user']['admin']=='1'){
			updateShowAutoOk ($insid);
			updateAdminAuto($insid);
			}
			for ($i = 1; $i<=36; $i++){
   				$ad = processPostVariable('ad'.$i);
				if ($ad == '1') addAddition($insid,$i);
  			}
	//загружаем фото и все такое :)
	require_once('resize.php');
	$id = $insid;
	$filescount = processPostVariable('filescount');
	$filescount = (int)$filescount; 
	for ($i = 1; $i <= 42; $i++){
				if ($_FILES['pic'.$i]["error"] == UPLOAD_ERR_OK) {
						$pic = $_FILES["pic".$i]["tmp_name"];
						resizepic($pic, "../carimages/".$id."_".$i.".jpg", 700, 400);
						//resizepic($pic, "../carimages/".$id."_".$i."_n.jpg", 187, 600);
						resizepic($pic, "../carimages/".$id."_".$i."m.jpg", 134, 108);
						//resizepic($pic, "../carimages/".$id."_".$i."mk.jpg", 125, 95);
						//resizepic($pic, "../carimages/".$id."_".$i."sm.jpg", 96, 60);						
				}
	}	
	if ($_FILES['photo_free']["error"] == UPLOAD_ERR_OK) {
	$pic = $_FILES['photo_free']["tmp_name"];
	resizepic($pic, "../forfreeimages/".$id."_auto_.jpg", 290, 163);
	}

	$smarty->assign('showaddit', true);
	
	$smarty->display("auto_add_ok.tpl");}
}
elseif ($mode=="list") {
	$tip_cat = processGetVariable('tip_cat');
	if ($tip_cat!=1)
	$tip_cat=0;
	$smarty->assign('tip_cat', $tip_cat);
	$brandcategor = getMainSearchBrands();
	$smarty->assign('brandcategor',$brandcategor);
	$typeeng = listTypeEngine();
	$smarty->assign("typeeng", $typeeng);
	//тип кузова
	$bodytype=listBodyType();
	$smarty->assign("bodytype",$bodytype);
	$page = processGetVariable('page');
	$page = (int)$page;
	if ($page=='0') $page='1';
	
	list($count,$result) = listAllAuto($page, $tip_cat);
	$pages_count = ($count % 15 == 0 ? $count / 15 : floor($count / 15) + 1);
	$pages = array();
	$dots = false;

	for ($i = 1; $i <= $pages_count; ++$i) {

		if ((abs($i - $page) <= 4) || ($i <= 5) || ($i >= $pages_count - 4)) {
			if($tip_cat==0)
			$pages[] = array('num' => $i, 'link' => "/auto/list/$i/");
			else
			$pages[] = array('num' => $i, 'link' => "/auto/list_bu/$i/");
			$dots = false;
		} else if (!$dots) {
			$pages[] = array('num' => '...');
			$dots = true;

		}

	}
	$smarty->assign('pages', $pages);
	$smarty->assign('page', $page);		
	//print_r($result);
	for($i=0; $i<count($result); $i++){
	$fileNamePic="../forfreeimages/".$result[$i]['id']."_auto_.jpg";
	 	if (file_exists($fileNamePic)) {
		$result[$i]['picc']=1;
		}}
	
	//print_r($result);
	$smarty->assign("auto", $result);
	$mainnewauto = getMainLastAuto();
	$smarty->assign("mainnewauto", $mainnewauto);
	$smarty->assign("title", "Автомобили в наличии");
	$smarty->assign('showaddit', true);
	
	/*	
	$availibleauto = getRandAvailibleAuto(100);
	$smarty->assign('availibleauto', $availibleauto);
	*/
	
	$smarty->display("auto_list.tpl");

}

elseif ($mode=="show" || $mode=="show_gift"){
$id=processGetVariable("id");
	$id=(int)$id;
	$auto =getAuto($id) ;
	
	
	$my1=getRandAvailibleCar(1, $auto['tip_cat'], $id);
	if(count($my1)!=0){
	//print_r($my1[0]);
	$smarty->assign("haveRand",1);
	$smarty->assign("haveRandid",$my1[0]['id']);
	$smarty->assign("haveRandname",$my1[0]['brand_name'].' '.$my1[0]['car_name'].' '.$my1[0]['year']);
	}
	else{
	$smarty->assign("haveRand",0);
	}
	
	//ini_set('display_errors', true);
	//
	//print_r(count($my1));
	
	//print_r($auto['tip_cat']);
	
	
	
	//print_r($auto);
	$smarty->assign("title", $auto['brand_name']." ".$auto['car_name']);
	$smarty->assign("auto",$auto);
	$addition = getAutoAddition($id);
	$smarty->assign("add", $addition);
	$smarty->assign("id", $id);
	CountView($id);
	$DATA = array();
	$DATA = "";
		$it=0;
		while ($it<50) {
	  		$filename="../carimages/".$id."_".$it."m.jpg";
			$filename1="../carimages/".$id."_".$it.".jpg";
	  		if (file_exists($filename) && file_exists($filename1)) {
	  		$DATA[$it] = array(
	  		 	'link_thum'=> $id."_".$it."sm.jpg",	
	  			'link_thumb'=> $id."_".$it."m.jpg",
	  			'link_large'=> $id."_".$it.".jpg",
	  		);			
			} 
			$it++;
	 	}
		$fileNamePic="../forfreeimages/".$id."_auto_.jpg";
	 	if (file_exists($fileNamePic)) {
		$smarty->assign("photo_free", '/forfreeimages/'.$id.'_auto_.jpg');
		}
		$conditions = getConditions();
		$auto_conditions = getAutoCondition($id);
		foreach($conditions as $k=>$c){
			$conditions[$k]['value'] = $auto_conditions[$c['name_db']];
		}
		$smarty->assign('conditions', $conditions);
		$smarty->assign("cid",$id);
	$smarty->assign("image",$DATA);
	$smarty->assign('showaddit', true);
	$smarty->assign("hide", true);
	if($mode=="show_gift")
	$smarty->assign("show_gift", '1');
	#print_r($auto);
	$smarty->display("auto_show.tpl");
}
elseif ($mode=="photo"){
	$id=processGetVariable("id");
	$auto =getAuto($id) ;
	$smarty->assign("title", $auto['brand_name']." ".$auto['car_name']);
	$it=0;
	while ($it<11) {
  		$filename="../carimages/".$id."_".$it.".jpg";
  		if (file_exists($filename)) {
			$DATA[$it] = array(
				'link_large'=> $id."_".$it.".jpg",
			);			
		} 
		$it++;
 	}	
	$smarty->assign("image",$DATA);
	$smarty->display("auto_photo.tpl");
}
elseif ($mode=="search" || $mode=="search1") {

	$brandcategor = getMainSearchBrands();
	$smarty->assign('brandcategor',$brandcategor);
	$typeeng = listTypeEngine();
	$smarty->assign("typeeng", $typeeng);
	//тип кузова
	$bodytype=listBodyType();
	$smarty->assign("bodytype",$bodytype);

	$brand = processGetVariable('brand');
	$category = processGetVariable('category');

	$brand=(int)$brand;
	$smarty->assign("search_brand", $brand);
	$fromprice = processGetVariable('fromprice');

	$fromprice=(int)$fromprice;

	$toprice = processGetVariable('toprice');

	$toprice=(int)$toprice;

	$yearstart = processGetVariable('yearstart');

	$yearstart=(int)$yearstart;

	$yearend = processGetVariable('yearend');

	$yearend=(int)$yearend;

	$engine = processGetVariable('engine');

	$engine=(int)$engine;

	$page = processGetVariable('page');

	$page = (int)$page;

	

	$spage = processGetVariable('spage');

	$spage = (int)$spage;

	if ($page=='0') $page='1';
	
	$smarty->assign("brand", $brand);
	
	$smarty->assign("category",$category);
	$smarty->assign("toprice", $toprice);
	$smarty->assign("yearstart", $yearstart);
	$smarty->assign("engine", $engine);
	
if ($mode=="search1")
$tip_cat=1;
else
$tip_cat=0;
	list($count,$result) = searchAllCar($brand, $fromprice, $toprice, $yearstart, $yearend, $engine, $page,$category, $tip_cat);

	

	$pages_count = ($count % 10 == 0 ? $count / 10 : floor($count / 10) + 1);

	

	$pages = array();

	$dots = false;

	for ($i = 1; $i <= $pages_count; ++$i) {

		if ((abs($i - $page) <= 4) || ($i <= 5) || ($i >= $pages_count - 4)) {

			$pages[] = array('num' => $i, 'link' => "/auto/?mode=search&brand=$brand&fromprice=$fromprice&toprice=$toprice&yearstart=$yearstart&yearend=$yearend&engine=$engine&page=$i");

			$dots = false;

		} else if (!$dots) {

			$pages[] = array('num' => '...');

			$dots = true;

		}

	}



	$smarty->assign('pages', $pages);
	$smarty->assign('page', $page);		
	$smarty->assign("auto", $result);
$smarty->assign("tip_cat", $tip_cat);
	$salone= searchSaloneCar($brand, $fromprice, $toprice, $yearstart, $yearend, $engine, $spage);
	$smarty->assign("salone", $salone);
	$smarty->assign('showaddit', true);
	$smarty->display("auto_list.tpl");

}


?>