<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";

$partners=getPartners();
$smarty->assign("partners", $partners);

$smarty->assign("prototype", true);
$mode = processGetVariable('mode');


if ($mode=="add") {
	$smarty->display('prod_add.tpl');
}

elseif ($mode=="addproduct") {
	$name= processPostVariable('name');
	$price = (int)processPostVariable('price');
	$currency = processPostVariable('currency');
	$bestoffers = (int)processPostVariable('bestoffers');
	$for_free_text = processPostVariable('for_free_text');
	$description = processPostVariable('description');
	
	$model = processPostVariable('model');
	$sost = processPostVariable('sost');
	$kol = processPostVariable('kol');
	//удаляем лишние пробелы
	$description=trim($description);
	//переносим строки
	$description = str_replace("\n", "<br />", $description);
	//ADD
	$userid = $config['user']['id'];
	$insid = addProduct($name, $price, $currency, $description, $bestoffers, $for_free_text, $model, $sost, $kol, $userid);
	//print_r($_POST);
	//загружаем фото и все такое :)
	require_once('resize.php');
	$id = $insid;
	$filescount = processPostVariable('filescount');
	$filescount = (int)$filescount; 
	if ($_FILES['photo_free']["error"] == UPLOAD_ERR_OK) {

			resizepic($_FILES['photo_free']["tmp_name"], "../forfreeimages/".$id."_product_.jpg", 290, 163);
			
		}
	if ($_FILES["pic1"]["error"] == UPLOAD_ERR_OK){
		resizepicProd($_FILES["pic1"]["tmp_name"], "../prodimages/".$id."_1m-0.png", 100, 130, 0, $_FILES["pic1"]["type"], 1);
		resizepicProd($_FILES["pic1"]["tmp_name"], "../prodimages/".$id."_1m-1.png", 100, 130, 1, $_FILES["pic1"]["type"], 1);
	}	
	for ($i = 1; $i <= $filescount; ++$i){
				if ($_FILES['pic'.$i]["error"] == UPLOAD_ERR_OK) {
						$pic = $_FILES["pic".$i]["tmp_name"];
						$type = $_FILES["pic".$i]["type"];
						resizepicProd($pic, "../prodimages/".$id."_".$i.".jpg", 700, 400, 0, $type);
						resizepicProd($pic, "../prodimages/".$id."_".$i."m.jpg", 134, 108, 0, $type);
				}
	}		
	if($config['user']['admin']=='1'){
updateAdminProducts($id);
}
	$smarty->assign('showaddit', true);
	$smarty->display("prod_add_ok.tpl");
}
elseif ($mode=="list") {
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
	list($count,$result) = listAllProd($page);
	$pages_count = ($count % 5 == 0 ? $count / 5 : floor($count / 5) + 1);
		$pages = array();
		$dots = false;
		for ($i = 1; $i <= $pages_count; ++$i) {
			if ((abs($i - $page) <= 4) || ($i <= 5) || ($i >= $pages_count - 4)) {
				$pages[] = array('num' => $i, 'link' => "/products/list/$i/");
				$dots = false;
			} else if (!$dots) {
				$pages[] = array('num' => '...');
				$dots = true;
			}
		}
			for($i=0; $i<count($result); $i++){
		$fileNamePic="../forfreeimages/".$result[$i]['id']."_product_.jpg";
	 	if (file_exists($fileNamePic)) {
		$result[$i]['picc']=1;
		}}
		$smarty->assign('pages', $pages);
		$smarty->assign('page', $page);		
		$smarty->assign("auto", $result);
		$mainnewauto = getMainLastAuto();
		$smarty->assign("mainnewauto", $mainnewauto);
		$smarty->assign("title", "Товары в наличии");
		$smarty->assign('showaddit', true);
		$smarty->display("prod_list.tpl");
}


elseif ($mode=="show"){
	$id=processGetVariable("id");
	$id=(int)$id;
	$product = getProduct($id) ;
	$my1=getRandAvailibleProduct(1, $id);
	//print_r($my1);
	if(count($my1)!=0){
	$smarty->assign("haveRand",1);
	$smarty->assign("haveRandpic",$my1[0]['pic1']);
	$smarty->assign("haveRandid",$my1[0]['id']);
	$smarty->assign("haveRandname",$my1[0]['name'].' '.$my1[0]['model'].' '.$my1[0]['year']);
	}
	else{
	$smarty->assign("haveRand",0);
	}
	$smarty->assign("title", $product['name']." ".$product['model']);
	$smarty->assign("product",$product);

	$it=0;
	while ($it<=20) {
  		$filename="../prodimages/".$id."_".$it."m.jpg";
  		if (file_exists($filename)) {
	  		$DATA[$it] = array(
	  			'link_thumb'=> $id."_".$it."m.jpg",
	  			'link_large'=> $id."_".$it.".jpg",
	  		);			
		} 
		$it++;
 	}
	$auto = getRandAvailibleAuto(1);
	$smarty->assign("auto", $auto[0]);
	//print_r($auto[0]);
	$fileNamePic="../forfreeimages/".$id."_product_.jpg";
	 	if (file_exists($fileNamePic)) {
		$smarty->assign("photo_free", '/forfreeimages/'.$id.'_product_.jpg');
		}
 	$smarty->assign("image",$DATA);
 	$smarty->assign('showaddit', true);
 	$smarty->assign("hide", true);
	$smarty->display("prod_show.tpl");
}

elseif ($mode=="photo"){
	$id=processGetVariable("id");
	//$auto =getAuto($id) ;
	//$smarty->assign("title", $auto['brand_name']." ".$auto['car_name']);
	$it=1;
	while ($it<=20) {
  		$filename="../prodimages/".$id."_".$it.".jpg";
  		if (file_exists($filename)) {
			$DATA[$it] = array(
				'link_large'=> $id."_".$it.".jpg", 'n'=> $it, 'link_thumb'=> $id."_".$it."m.jpg"
			);			
		}
		else{
			$DATA[$it] = array(
				'link_large'=> "", 'n'=> $it, 'link_thumb'=> ""
			);		

		}
		$it++;
 	}	
	$smarty->assign("id",$id);
	$smarty->assign("image",$DATA);
	//print_r($DATA);
	$smarty->display("tovar_edit_f.tpl");
}
elseif ($mode=="foto_del"){
	$id=processGetVariable("id");
	$nom=processGetVariable("nom");
	unlink("../prodimages/".$id."_".$nom.".jpg");
	unlink("../prodimages/".$id."_".$nom."m.jpg");
	

	unlink("../prodimages/".$id."_".$nom."_1m-0.png");
	unlink("../prodimages/".$id."_".$nom."_1m-1.png");
  		$it=1;
		while ($it<=20) {
  		$filename="../prodimages/".$id."_".$it.".jpg";
  		if (file_exists($filename)) {
			$DATA[$it] = array(
				'link_large'=> $id."_".$it.".jpg", 'n'=> $it, 'link_thumb'=> $id."_".$it."m.jpg"
			);			
		}
		else{
			$DATA[$it] = array(
				'link_large'=> "", 'n'=> $it, 'link_thumb'=> ""
			);		

		}
		$it++;
 	}		
	$smarty->assign("id",$id);
	$smarty->assign("image",$DATA);
	//print_r($DATA);
	$smarty->display("tovar_edit_f.tpl");
}
elseif ($mode=="foto_submit"){
	$id=processPostVariable("id");
		require_once('resize.php');
	$filescount = 20;
	if ($_FILES["pic1"]["error"] == UPLOAD_ERR_OK){
		resizepicProd($_FILES["pic1"]["tmp_name"], "../prodimages/".$id."_1m-0.png", 100, 130, 0, $_FILES["pic1"]["type"], 1);
		resizepicProd($_FILES["pic1"]["tmp_name"], "../prodimages/".$id."_1m-1.png", 100, 130, 1, $_FILES["pic1"]["type"], 1);
	}	
	for ($i = 1; $i <= $filescount; ++$i){
				if ($_FILES['pic'.$i]["error"] == UPLOAD_ERR_OK) {
						$pic = $_FILES["pic".$i]["tmp_name"];
						$type = $_FILES["pic".$i]["type"];
						resizepicProd($pic, "../prodimages/".$id."_".$i.".jpg", 700, 400, 0, $type);
						resizepicProd($pic, "../prodimages/".$id."_".$i."m.jpg", 134, 108, 0, $type);
				}
	}	
  	list($count,$productlist) = listProducts(1);
	//print_r($productlist);
	$smarty->assign('productlist', $productlist);
	$smarty->display("office-productlist.tpl");	
}
?>

