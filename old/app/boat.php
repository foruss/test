<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";

$partners=getPartners();
$smarty->assign("partners", $partners);

$tip_cat = processGetVariable('tip_cat');
$mode = processGetVariable('mode');
if($mode=='add'){
//print_r($config['user']['id']);
$smarty->assign("title", 'Добавление лодки');
$smarty->display("boat_add.tpl");
}
if($mode=='add_submit'){
$time1=date( 'd-m-Yг.', time() );
$tip_cat = processPostVariable('tip_cat');
$uid = processPostVariable('uid');
$brand = processPostVariable('brand');
$name = processPostVariable('name');
$tip_boat = processPostVariable('tip_boat');
$vin = processPostVariable('vin');
$title = processPostVariable('title');
$year = processPostVariable('year');
$prod = processPostVariable('prod');
$prosm = processPostVariable('prosm');
$cost = processPostVariable('cost');
$length = processPostVariable('length');
$width = processPostVariable('width');
$height = processPostVariable('height');
$places = processPostVariable('places');
$topl_potr = processPostVariable('topl_potr');
$dvig = processPostVariable('dvig');
$oth_inf = processPostVariable('oth_inf');
$option = processPostVariable('option');
$raspol = processPostVariable('raspol');
$for_free_text = processPostVariable('for_free_text');
$for_free_link = processPostVariable('for_free_link');
require_once('resize.php');

for($i=1; $i<=21; $i++)
if($_FILES["pic".$i]["error"] == UPLOAD_ERR_OK){
		ereg(".+\.(.{3})",$_FILES["pic".$i]["name"],$nash);
   		$rash=$nash[1];
   		$time=time().$i;
   		$pic[$i]=md5($time).".".$rash;
		//copy($_FILES["pic".$i]["tmp_name"],"../boatimg/".$pic[$i]);
		resizepic($_FILES["pic".$i]["tmp_name"], "../boatimg/".$pic[$i], 700, 400);
		resizepic($_FILES["pic".$i]["tmp_name"], "../boatimg/m-".$pic[$i], 131, 98);
   		unset($nash);
   		unset($time);
   		unset($rash);
	}
	else
	$pic[$i]="";
	

		
$id=addBoat($uid, $brand, $name, $tip_boat, $vin, $title, $year, $prod, $prosm, $cost, $time, $length, $width, $height, $places, $topl_potr, $dvig, $oth_inf, $option, $pic[1], $pic[2], $pic[3], $pic[4], $pic[5], $pic[6], $pic[7], $pic[8], $pic[9], $pic[10], $tip_cat, $raspol, $for_free_text , $for_free_link, $pic[11], $pic[12], $pic[13], $pic[14], $pic[15], $pic[16], $pic[17], $pic[18], $pic[19], $pic[20], $pic[21]);
if($config['user']['admin']=='1'){
		updateShowBoatOk ($id);
		updateAdminBoat($id);
		}
require_once('resize.php');
if ($_FILES['photo_free']["error"] == UPLOAD_ERR_OK) {

			resizepic($_FILES['photo_free']["tmp_name"], "../forfreeimages/".$id."_boat_.jpg", 290, 163);
			
		}
		
$col=rand (100000, 999999);
$smarty->assign("mm", '<h1 style="color:#'.$col.'">Лодка добавлена</h1>');
$smarty->assign("title", 'Добавление лодки');
$smarty->display("boat_add.tpl");
}
if($mode=='spis'){
$boat=getAllBoatbyID($config['user']['id'], $tip_cat);
if($config['user']['admin']==1)
$boat=getAllBoatbyAdminSpis();
$smarty->assign("boat", $boat);
$smarty->assign("title", 'Cписок лодок');
$smarty->display("boat_spis.tpl");
}
if($mode=='del'){
$col = processPostVariable('colch');

for ($i=1; $i<=$col; $i++){
$ch[$i] = processPostVariable('ch'.$i);
	if($ch[$i]){
	$boat=getAllBoatbyID1($ch[$i], $tip_cat);
	if($config['user']['admin']==1)
	$boat=getAllBoatbyAdmin($tip_cat);
		if($boat['uid']==$config['user']['id'] || $config['user']['admin']==1){
			delBoatbyID($ch[$i]);
			for($j=1; $j<=21; $j++){
			unlink("../boatimg/".$boat['pic'.$j]);
		}
		}
	}
	
}

$boat=getAllBoatbyID($config['user']['id'], $tip_cat);
if($config['user']['admin']==1)
$boat=getAllBoatbyAdminSpis();
$smarty->assign("boat", $boat);
$smarty->assign("title", 'Cписок лодок');
$smarty->display("boat_spis.tpl");
}
if($mode=='autoshow1'){
$col = processPostVariable('colch');

for ($i=1; $i<=$col; $i++){
$ch[$i] = processPostVariable('ch'.$i);
	if($ch[$i]){
	$boat=getAllBoatbyID1($ch[$i], $tip_cat);
	if($config['user']['admin']==1)
	$boat=getAllBoatbyAdmin($tip_cat);
		if($boat['uid']==$config['user']['id'] || $config['user']['admin']==1){
			updateShowBoatOk($ch[$i]);
		}
	}
	
}

$boat=getAllBoatbyID($config['user']['id'], $tip_cat);
if($config['user']['admin']==1)
$boat=getAllBoatbyAdminSpis();
$smarty->assign("boat", $boat);
$smarty->assign("title", 'Cписок лодок');
$smarty->display("boat_spis.tpl");
}
if($mode=='autoshow2'){
$col = processPostVariable('colch');

for ($i=1; $i<=$col; $i++){
$ch[$i] = processPostVariable('ch'.$i);
	if($ch[$i]){
	$boat=getAllBoatbyID1($ch[$i], $tip_cat);
	if($config['user']['admin']==1)
	$boat=getAllBoatbyAdmin($tip_cat);
		if($boat['uid']==$config['user']['id'] || $config['user']['admin']==1){
			updateShowBoatNo($ch[$i]);
		}
	}
	
}

$boat=getAllBoatbyID($config['user']['id'], $tip_cat);
if($config['user']['admin']==1)
$boat=getAllBoatbyAdminSpis();
$smarty->assign("boat", $boat);
$smarty->assign("title", 'Cписок лодок');
$smarty->display("boat_spis.tpl");
}
if($mode=='prod'){
$col = processPostVariable('colch');

for ($i=1; $i<=$col; $i++){
$ch[$i] = processPostVariable('ch'.$i);
	if($ch[$i]){
	$boat=getAllBoatbyID1($ch[$i], $tip_cat);
	if($config['user']['admin']==1)
	$boat=getAllBoatbyAdmin($tip_cat);
		if($boat['uid']==$config['user']['id'] || $config['user']['admin']==1){
			prodBoat($ch[$i]);
		}
	}
	
}

$boat=getAllBoatbyID($config['user']['id'], $tip_cat);
if($config['user']['admin']==1)
$boat=getAllBoatbyAdminSpis();
$smarty->assign("boat", $boat);
$smarty->assign("title", 'Cписок лодок');
$smarty->display("boat_spis.tpl");
}
if($mode=='neprod'){
$col = processPostVariable('colch');

for ($i=1; $i<=$col; $i++){
$ch[$i] = processPostVariable('ch'.$i);
	if($ch[$i]){
	$boat=getAllBoatbyID1($ch[$i], $tip_cat);
	if($config['user']['admin']==1)
	$boat=getAllBoatbyAdmin($tip_cat);
		if($boat['uid']==$config['user']['id'] || $config['user']['admin']==1){
			unprodBoat($ch[$i]);
		}
	}
	
}

$boat=getAllBoatbyID($config['user']['id'], $tip_cat);
if($config['user']['admin']==1)
$boat=getAllBoatbyAdminSpis();
$smarty->assign("boat", $boat);
$smarty->assign("title", 'Cписок лодок');
$smarty->display("boat_spis.tpl");
}
if($mode=='edit_info'){
$id = processGetVariable('id');
$boat=getAllBoatbyID1($id, $tip_cat);
$smarty->assign("boat", $boat);
$smarty->assign("title", 'Редактирование инфо');
$smarty->display("boat_edit_i.tpl");
}
if($mode=='pic_delete'){
$id = processGetVariable('id');
unlink("../forfreeimages/".$id."_boat_.jpg");//////////////////////////////////////////////////////////////////////////////////////////////
$boat=getAllBoatbyID1($id, $tip_cat);
$smarty->assign("boat", $boat);
$smarty->assign("title", 'Редактирование инфо');
$smarty->display("boat_edit_i.tpl");
}
if($mode=='edit_foto'){
$id = processGetVariable('id');
$boat=getAllBoatbyID1($id, $tip_cat);
$smarty->assign("boat", $boat);
$smarty->assign("title", 'Редактирование фото');
$smarty->display("boat_edit_f.tpl");
}
if($mode=='info_submit'){
$id = processPostVariable('id');
$brand = processPostVariable('brand');
$name = processPostVariable('name');
$tip_boat = processPostVariable('tip_boat');
$tip_cat = processPostVariable('tip_cat');
$vin = processPostVariable('vin');
$title = processPostVariable('title');
$year = processPostVariable('year');
$prod = processPostVariable('prod');
$prosm = processPostVariable('prosm');
$cost = processPostVariable('cost');
$time = processPostVariable('time');
$length = processPostVariable('length');
$width = processPostVariable('width');
$height = processPostVariable('height');
$places = processPostVariable('places');
$topl_potr = processPostVariable('topl_potr');
$dvig = processPostVariable('dvig');
$oth_inf = processPostVariable('oth_inf');
$option = processPostVariable('option');
$raspol = processPostVariable('raspol');
$for_free_text = processPostVariable('for_free_text');
$for_free_link = processPostVariable('for_free_link');
require_once('resize.php');

		if ($_FILES['photo_free']["error"] == UPLOAD_ERR_OK) {

			resizepic($_FILES['photo_free']["tmp_name"], "../forfreeimages/".$id."_boat_.jpg", 290, 163);
			
		}
updBoatInf($id, $brand, $name, $tip_boat, $vin, $title, $year, $prod, $prosm, $cost, $time, $length, $width, $height, $places, $topl_potr, $dvig, $oth_inf, $option, $tip_cat, $raspol, $for_free_text , $for_free_link);
$boat=getAllBoatbyID($config['user']['id'], $tip_cat);
if($config['user']['admin']==1)
$boat=getAllBoatbyAdminSpis();
$smarty->assign("boat", $boat);
$smarty->assign("title", 'Cписок лодок');
$smarty->display("boat_spis.tpl");
}
if($mode=='foto_submit'){
$id = processPostVariable('id');
$boat=getAllBoatbyID1($id);
require_once('resize.php');
for($i=1; $i<=21; $i++)
if($_FILES["pic".$i]["error"] == UPLOAD_ERR_OK){
		ereg(".+\.(.{3})",$_FILES["pic".$i]["name"],$nash);
   		$rash=$nash[1];
   		$time=time().$i;
   		$pic[$i]=md5($time).".".$rash;
		//copy($_FILES["pic".$i]["tmp_name"],"../boatimg/".$pic[$i]);
		//copy($_FILES["pic".$i]["tmp_name"],"../boatimg/".$pic[$i]);
		resizepic($_FILES["pic".$i]["tmp_name"], "../boatimg/".$pic[$i], 700, 400);
		resizepic($_FILES["pic".$i]["tmp_name"], "../boatimg/m-".$pic[$i], 131, 98);
   		unset($nash);
   		unset($time);
   		unset($rash);
		unlink("../boatimg/".$boat['pic'.$i]);
	}
	else
	$pic[$i]=$boat['pic'.$i];
updBoatFoto($id, $pic[1], $pic[2], $pic[3], $pic[4], $pic[5], $pic[6], $pic[7], $pic[8], $pic[9], $pic[10], $pic[11], $pic[12], $pic[13], $pic[14], $pic[15], $pic[16], $pic[17], $pic[18], $pic[19], $pic[20], $pic[21]);
$boat=getAllBoatbyID($config['user']['id'], $tip_cat);
if($config['user']['admin']==1)
$boat=getAllBoatbyAdminSpis();
$smarty->assign("boat", $boat);
$smarty->assign("title", 'Cписок лодок');
$smarty->display("boat_spis.tpl");
}
if($mode=="del_pic"){
$id1 = processGetVariable('id1');
$id2 = processGetVariable('id2');
$boat=getAllBoatbyID1($id2, $tip_cat);
delBoat($id2, $id1);
unlink("../boatimg/".$boat[$id1]);
$boat=getAllBoatbyID1($id2);
$smarty->assign("boat", $boat);
$smarty->assign("title", 'Редактирование фото');
$smarty->display("boat_edit_f.tpl");
}
if($mode=="list"){
$page=processGetVariable('id');
if(!$page)
$page=1;
$boat=getAllBoatbyAdmin($tip_cat);
$pages=count($boat);
if ($pages<=15)
$pages=2;
else
if($pages % 15 == 0)
$pages=$pages/15+1;
else
$pages=$pages/15+2;
for($i=0; $i<=count($boat); $i++)
$masM[$i]=$boat[$i]['brand'];
$masM=array_unique($masM);
	for($i=0; $i<count($boat); $i++){
	$fileNamePic="../forfreeimages/".$boat[$i]['id']."_boat_.jpg";
	 	if (file_exists($fileNamePic)) {
		$boat[$i]['picc']=1;
		}}
$smarty->assign("masm", $masM);
$smarty->assign("pages", $pages);
$smarty->assign("zaps", (($page-1)*15));
$smarty->assign("page", $page);
$smarty->assign("boat", $boat);
$smarty->assign("title", 'Лодки в наличии');
$smarty->assign("tip_cat", $tip_cat);
$smarty->display("boat_list.tpl");
}
if($mode=="list1"){
$brand=processGetVariable('brand');

$page=processGetVariable('id');
$boat=getAllBoatbyBrand($brand, $tip_cat);
$pages=count($boat);
if ($pages<=15)
$pages=2;
else
if($pages % 15 == 0)
$pages=$pages/15+1;
else
$pages=$pages/15+2;
for($i=0; $i<=count($boat); $i++)
$masM[$i]=$boat[$i]['brand'];
$masM=array_unique($masM);
	for($i=0; $i<count($boat); $i++){
	$fileNamePic="../forfreeimages/".$boat[$i]['id']."_boat_.jpg";
	 	if (file_exists($fileNamePic)) {
		$boat[$i]['picc']=1;
		}}
$smarty->assign("tip_cat", $tip_cat);
$smarty->assign("masm", $masM);
$smarty->assign("pages", $pages);
$smarty->assign("zaps", (($page-1)*15));
$smarty->assign("page", $page);
$smarty->assign("boat", $boat);
$smarty->assign("brand", $brand);
$smarty->assign("title", 'Лодки в наличии');
$smarty->display("boat_blist.tpl");
}
if($mode=="show" || $mode=="show_gift"){
$id=processGetVariable('id');
$boat=getAllBoatbyID1($id, $tip_cat);
$my1=getRandAvailibleBoat(1, $boat['tip_cat'], $id);
//print_r($my1);
if(count($my1)!=0){
	$smarty->assign("haveRand",1);
	$smarty->assign("haveRandpic",$my1[0]['pic1']);
	$smarty->assign("haveRandid",$my1[0]['id']);
	$smarty->assign("haveRandname",$my1[0]['brand'].' '.$my1[0]['name'].' '.$my1[0]['year']);
	}
	else{
	$smarty->assign("haveRand",0);
	}
prosmBoat($id,$boat['prosm']);
$smarty->assign("boat", $boat);
$smarty->assign("title", $boat['brand'].' '.$boat['name'].' '.$boat['year'].'г.');
$j=0;
for($i=2; $i<=21; $i++)
if($boat['pic'.$i]!=""){
$image[$j]=$boat['pic'.$i];
$j++;
}
$fileNamePic="../forfreeimages/".$id."_boat_.jpg";
	 	if (file_exists($fileNamePic)) {
		$smarty->assign("photo_free", '/forfreeimages/'.$id.'_boat_.jpg');
		}
if($mode="show_gift")
$smarty->assign("show_gift", true);
$smarty->assign("image", $image);
$smarty->display("boat_show.tpl");
}















if($mode=='prod1'){
$id = processGetVariable('id');
prodBoat($id );

$boat=getAllBoatbyID($config['user']['id'], $tip_cat);
if($config['user']['admin']==1)
$boat=getAllBoatbyAdmin($tip_cat);
$smarty->assign("boat", $boat);
$smarty->assign("title", 'Cписок лодок');
$smarty->display("boat_spis.tpl");
}
if($mode=='neprod1'){
$id = processGetVariable('id');


unprodBoat($id );
$boat=getAllBoatbyID($config['user']['id'], $tip_cat);
if($config['user']['admin']==1)
$boat=getAllBoatbyAdmin($tip_cat);
$smarty->assign("boat", $boat);
$smarty->assign("title", 'Cписок лодок');
$smarty->display("boat_spis.tpl");
}
?>