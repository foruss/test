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
$smarty->assign("title", 'Добавление спецтехники');
$smarty->display("machinery_add.tpl");
}
if($mode=='add_submit'){
$time1=date( 'd-m-Yг.', time() );
$tip_cat = processPostVariable('tip_cat');
$uid = processPostVariable('uid');
$mark = processPostVariable('mark');
$model = processPostVariable('model');
$tip = processPostVariable('tip');
$sernomb = processPostVariable('sernomb');
$year = processPostVariable('year');
$option = processPostVariable('option');
$oth_inf = processPostVariable('oth_inf');
$dvig = processPostVariable('dvig');
$transm = processPostVariable('transm');
$vin = processPostVariable('vin');
$title = processPostVariable('title');
$cost = processPostVariable('cost');
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
		//copy($_FILES["pic".$i]["tmp_name"],"../machineryimg/".$pic[$i]);
		resizepic($_FILES["pic".$i]["tmp_name"], "../machineryimg/".$pic[$i], 700, 400);
		resizepic($_FILES["pic".$i]["tmp_name"], "../machineryimg/m-".$pic[$i], 131, 98);
   		unset($nash);
   		unset($time);
   		unset($rash);
	}
	else
	$pic[$i]="";
$id=addMachinery($uid, $mark, $model, $tip, $sernomb, $year, $option, $oth_inf, $tip_cat, $dvig, $transm, $vin, $title, $cost, $pic[1], $pic[2], $pic[3], $pic[4], $pic[5], $pic[6], $pic[7], $pic[8], $pic[9], $pic[10], $raspol, $for_free_text , $for_free_link, $pic[11], $pic[12], $pic[13], $pic[14], $pic[15], $pic[16], $pic[17], $pic[18], $pic[19], $pic[20], $pic[21]);
if($config['user']['admin']=='1'){
updateAdminMachinery($id);
}

if ($_FILES['photo_free']["error"] == UPLOAD_ERR_OK) {

			resizepic($_FILES['photo_free']["tmp_name"], "../forfreeimages/".$id."_machinery_.jpg", 290, 163);
			
		}
$col=rand (100000, 999999);
$smarty->assign("mm", '<h1 style="color:#'.$col.'">Спецтехника добавлена</h1>');
$smarty->assign("title", 'Добавление спецтехники');
$smarty->display("machinery_add.tpl");
}
if($mode=='spis'){
$machinery=getAllMachinerybyID($config['user']['id'], $tip_cat);
if($config['user']['admin']==1)
$machinery=getAllMachinerybyAdminSpis();
$smarty->assign("machinery", $machinery);
$smarty->assign("title", 'Cписок спецтехники');
$smarty->display("machinery_spis.tpl");
}
if($mode=='del'){
$col = processPostVariable('colch');

for ($i=1; $i<=$col; $i++){
$ch[$i] = processPostVariable('ch'.$i);
	if($ch[$i]){
	$machinery=getAllMachinerybyID1($ch[$i], $tip_cat);
	if($config['user']['admin']==1)
	$machinery=getAllMachinerybyAdmin($tip_cat);
		if($machinery['uid']==$config['user']['id'] || $config['user']['admin']==1){
			delMachinerybyID($ch[$i]);
			for($j=1; $j<=21; $j++){
			unlink("../machineryimg/".$machinery['pic'.$j]);
		}
		}
	}
	
}

$machinery=getAllMachinerybyID($config['user']['id'], $tip_cat);
if($config['user']['admin']==1)
$machinery=getAllMachinerybyAdminSpis();
$smarty->assign("machinery", $machinery);
$smarty->assign("title", 'Cписок спецтехники');
$smarty->display("machinery_spis.tpl");
}
if($mode=='prod'){
$col = processPostVariable('colch');

for ($i=1; $i<=$col; $i++){
$ch[$i] = processPostVariable('ch'.$i);
	if($ch[$i]){
	$machinery=getAllMachinerybyID1($ch[$i], $tip_cat);
	if($config['user']['admin']==1)
	$machinery=getAllMachinerybyAdmin($tip_cat);
		if($machinery['uid']==$config['user']['id'] || $config['user']['admin']==1){
			prodMachinery($ch[$i]);
		}
	}
	
}

$machinery=getAllMachinerybyID($config['user']['id'], $tip_cat);
if($config['user']['admin']==1)
$machinery=getAllMachinerybyAdminSpis();
$smarty->assign("machinery", $machinery);
$smarty->assign("title", 'Cписок спецтехники');
$smarty->display("machinery_spis.tpl");
}
if($mode=='neprod'){
$col = processPostVariable('colch');

for ($i=1; $i<=$col; $i++){
$ch[$i] = processPostVariable('ch'.$i);
	if($ch[$i]){
	$machinery=getAllMachinerybyID1($ch[$i], $tip_cat);
	if($config['user']['admin']==1)
	$machinery=getAllMachinerybyAdmin($tip_cat);
		if($machinery['uid']==$config['user']['id'] || $config['user']['admin']==1){
			unprodMachinery($ch[$i]);
		}
	}
	
}

$machinery=getAllMachinerybyID($config['user']['id'], $tip_cat);
if($config['user']['admin']==1)
$machinery=getAllMachinerybyAdminSpis();
$smarty->assign("machinery", $machinery);
$smarty->assign("title", 'Cписок спецтехники');
$smarty->display("machinery_spis.tpl");
}
if($mode=='edit_info'){
$id = processGetVariable('id');
$machinery=getAllMachinerybyID1($id, $tip_cat);
$smarty->assign("machinery", $machinery);
$smarty->assign("title", 'Редактирование инфо');
$smarty->display("machinery_edit_i.tpl");
}
if($mode=='pic_delete'){
$id = processGetVariable('id');
unlink("../forfreeimages/".$id."_machinery_.jpg");//////////////////////////////////////////////////////////////////////////////////////////////
$machinery=getAllMachinerybyID1($id, $tip_cat);
$smarty->assign("machinery", $machinery);
$smarty->assign("title", 'Редактирование инфо');
$smarty->display("machinery_edit_i.tpl");
}
if($mode=='edit_foto'){
$id = processGetVariable('id');
$machinery=getAllMachinerybyID1($id, $tip_cat);
$smarty->assign("machinery", $machinery);
$smarty->assign("title", 'Редактирование фото');
$smarty->display("machinery_edit_f.tpl");
}
if($mode=='info_submit'){
$id = processPostVariable('id');
$tip_cat = processPostVariable('tip_cat');
$uid = processPostVariable('uid');
$mark = processPostVariable('mark');
$model = processPostVariable('model');
$tip = processPostVariable('tip');
$sernomb = processPostVariable('sernomb');
$year = processPostVariable('year');
$option = processPostVariable('option');
$oth_inf = processPostVariable('oth_inf');
$dvig = processPostVariable('dvig');
$transm = processPostVariable('transm');
$vin = processPostVariable('vin');
$title = processPostVariable('title');
$cost = processPostVariable('cost');
$raspol = processPostVariable('raspol');
$for_free_text = processPostVariable('for_free_text');
$for_free_link = processPostVariable('for_free_link');
require_once('resize.php');

		if ($_FILES['photo_free']["error"] == UPLOAD_ERR_OK) {

			resizepic($_FILES['photo_free']["tmp_name"], "../forfreeimages/".$id."_machinery_.jpg", 290, 163);
			
		}
updMachineryInf($id, $mark, $model, $tip, $sernomb, $year, $option, $oth_inf, $tip_cat, $dvig, $transm, $vin, $title, $cost, $raspol, $for_free_text , $for_free_link);
$machinery=getAllMachinerybyID($config['user']['id'], $tip_cat);
if($config['user']['admin']==1)
$machinery=getAllMachinerybyAdminSpis();
$smarty->assign("machinery", $machinery);
$smarty->assign("title", 'Cписок спецтехники');
$smarty->display("machinery_spis.tpl");
}
if($mode=='foto_submit'){
$id = processPostVariable('id');
$machinery=getAllMachinerybyID1($id);
require_once('resize.php');
for($i=1; $i<=21; $i++)
if($_FILES["pic".$i]["error"] == UPLOAD_ERR_OK){
		ereg(".+\.(.{3})",$_FILES["pic".$i]["name"],$nash);
   		$rash=$nash[1];
   		$time=time().$i;
   		$pic[$i]=md5($time).".".$rash;
		//copy($_FILES["pic".$i]["tmp_name"],"../machineryimg/".$pic[$i]);
		resizepic($_FILES["pic".$i]["tmp_name"], "../machineryimg/".$pic[$i], 700, 400);
		resizepic($_FILES["pic".$i]["tmp_name"], "../machineryimg/m-".$pic[$i], 131, 98);
   		unset($nash);
   		unset($time);
   		unset($rash);
		unlink("../machineryimg/".$machinery['pic'.$i]);
	}
	else
	$pic[$i]=$machinery['pic'.$i];
updMachineryFoto($id, $pic[1], $pic[2], $pic[3], $pic[4], $pic[5], $pic[6], $pic[7], $pic[8], $pic[9], $pic[10], $pic[11], $pic[12], $pic[13], $pic[14], $pic[15], $pic[16], $pic[17], $pic[18], $pic[19], $pic[20], $pic[21]);
$machinery=getAllMachinerybyID($config['user']['id'], $tip_cat);
if($config['user']['admin']==1)
$machinery=getAllMachinerybyAdminSpis();
$smarty->assign("machinery", $machinery);
$smarty->assign("title", 'Cписок спецтехники');
$smarty->display("machinery_spis.tpl");
}
if($mode=="del_pic"){
$id1 = processGetVariable('id1');
$id2 = processGetVariable('id2');
$machinery=getAllMachinerybyID1($id2, $tip_cat);
delMachinery($id2, $id1);
unlink("../machineryimg/".$machinery[$id1]);
$machinery=getAllMachinerybyID1($id2);
$smarty->assign("machinery", $machinery);
$smarty->assign("title", 'Редактирование фото');
$smarty->display("machinery_edit_f.tpl");
}
if($mode=="list"){
$page=processGetVariable('id');
if(!$page)
$page=1;
$machinery=getAllMachinerybyAdmin($tip_cat);
$pages=count($machinery);
if ($pages<=15)
$pages=2;
else
if($pages % 15 == 0)
$pages=$pages/15+1;
else
$pages=$pages/15+2;
for($i=0; $i<=count($machinery); $i++)
$masM[$i]=$machinery[$i]['mark'];
$masM=array_unique($masM);
	for($i=0; $i<count($machinery); $i++){
	$fileNamePic="../forfreeimages/".$machinery[$i]['id']."_machinery_.jpg";
	 	if (file_exists($fileNamePic)) {
		$machinery[$i]['picc']=1;
		}}
$smarty->assign("masm", $masM);
$smarty->assign("pages", $pages);
$smarty->assign("zaps", (($page-1)*15));
$smarty->assign("page", $page);
$smarty->assign("machinery", $machinery);
$smarty->assign("title", 'Спецтехника в наличии');
$smarty->assign("tip_cat", $tip_cat);
$smarty->display("machinery_list.tpl");
}
if($mode=="list1"){
$brand=processGetVariable('brand');

$page=processGetVariable('id');
$machinery=getAllMachinerybyBrand($brand, $tip_cat);
$pages=count($machinery);
if ($pages<=15)
$pages=2;
else
if($pages % 15 == 0)
$pages=$pages/15+1;
else
$pages=$pages/15+2;
for($i=0; $i<=count($machinery); $i++)
$masM[$i]=$machinery[$i]['brand'];
$masM=array_unique($masM);
	for($i=0; $i<count($machinery); $i++){
	$fileNamePic="../forfreeimages/".$machinery[$i]['id']."_machinery_.jpg";
	 	if (file_exists($fileNamePic)) {
		$machinery[$i]['picc']=1;
		}}
$smarty->assign("tip_cat", $tip_cat);
$smarty->assign("masm", $masM);
$smarty->assign("pages", $pages);
$smarty->assign("zaps", (($page-1)*15));
$smarty->assign("page", $page);
$smarty->assign("machinery", $machinery);
$smarty->assign("brand", $brand);
$smarty->assign("title", 'Спецтехника в наличии');
$smarty->display("machinery_blist.tpl");
}
if($mode=="show" || $mode=="show_gift"){
$id=processGetVariable('id');
$machinery=getAllMachinerybyID1($id, $tip_cat);
$my1=getRandAvailibleMachinery(1, $machinery['tip_cat'], $id);
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
prosmMachinery($id,$machinery['prosm']);
$smarty->assign("machinery", $machinery);
$smarty->assign("title", $machinery['mark'].' '.$machinery['model'].' '.$machinery['year'].'г.');
$j=0;
for($i=2; $i<=21; $i++)
if($machinery['pic'.$i]!=""){
$image[$j]=$machinery['pic'.$i];
$j++;
}
$fileNamePic="../forfreeimages/".$id."_machinery_.jpg";
	 	if (file_exists($fileNamePic)) {
		$smarty->assign("photo_free", '/forfreeimages/'.$id.'_machinery_.jpg');
		}
if($mode="show_gift")
$smarty->assign("show_gift", true);
$smarty->assign("image", $image);
$smarty->display("machinery_show.tpl");
}















if($mode=='prod1'){
$id = processGetVariable('id');
prodMachinery($id );

$machinery=getAllMachinerybyID($config['user']['id'], $tip_cat);
if($config['user']['admin']==1)
$machinery=getAllMachinerybyAdmin($tip_cat);
$smarty->assign("machinery", $machinery);
$smarty->assign("title", 'Cписок спецтехники');
$smarty->display("machinery_spis.tpl");
}
if($mode=='neprod1'){
$id = processGetVariable('id');


unprodMachinery($id );
$machinery=getAllMachinerybyID($config['user']['id'], $tip_cat);
if($config['user']['admin']==1)
$machinery=getAllMachinerybyAdmin($tip_cat);
$smarty->assign("machinery", $machinery);
$smarty->assign("title", 'Cписок спецтехники');
$smarty->display("machinery_spis.tpl");
}
?>