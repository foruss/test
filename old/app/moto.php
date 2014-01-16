<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";

//echo "<script type="text/javascript">window.alert("mode edit test")</script>";   exit;

$partners=getPartners();
$smarty->assign("partners", $partners);

$tip_cat = processGetVariable('tip_cat');
$mode = processGetVariable('mode');
if($mode=='add'){
//print_r($config['user']['id']);

$smarty->assign("title", 'Добавление мотоцикла');
$smarty->display("moto_add.tpl");
}
if($mode=='add_submit'){
//print_r($config['user']['id']);
$time1=date( 'd-m-Yг.', time() );
$tip_cat = processPostVariable('tip_cat');
$uid = processPostVariable('uid');
$mark = processPostVariable('mark');
$model = processPostVariable('model');
$year = processPostVariable('year');
$color = processPostVariable('color');
$tip_dv = processPostVariable('tip_dv');
$obem = processPostVariable('obem');
$prob = processPostVariable('prob');
$tprob = processPostVariable('tprob');
$cost = processPostVariable('cost');
$option = processPostVariable('option');
$oth_inf = processPostVariable('oth_inf');
$title = processPostVariable('title');
$vin = processPostVariable('vin');
$raspol = processPostVariable('raspol');
$for_free_text = processPostVariable('for_free_text');
$sost1 = processPostVariable('sost1');
$sost2 = processPostVariable('sost2');
$sost3 = processPostVariable('sost3');
$sost4 = processPostVariable('sost4');
$sost5 = processPostVariable('sost5');
$sost6 = processPostVariable('sost6');

require_once('resize.php');
for($i=1; $i<=21; $i++)
if($_FILES["pic".$i]["error"] == UPLOAD_ERR_OK){
		ereg(".+\.(.{3})",$_FILES["pic".$i]["name"],$nash);
   		$rash=$nash[1];
   		$time=time().$i;
   		$pic[$i]=md5($time).".".$rash;
		//copy($_FILES["pic".$i]["tmp_name"],"../motoimg/".$pic[$i]);
		resizepic($_FILES["pic".$i]["tmp_name"], "../motoimg/".$pic[$i], 700, 400);
		resizepic($_FILES["pic".$i]["tmp_name"], "../motoimg/m-".$pic[$i], 131, 98);
   		unset($nash);
   		unset($time);
   		unset($rash);
	}
	else
	$pic[$i]="";
$id=addMoto($tip_cat, $uid, $mark, $model, $year, $color, $tip_dv, $obem, $prob, $tprob, $cost, $option, $oth_inf, $time1, $pic[1], $pic[2], $pic[3], $pic[4], $pic[5], $pic[6], $pic[7], $pic[8], $pic[9], $pic[10], $title, $vin, $raspol, $for_free_text , $for_free_link, $sost1, $sost2, $sost3, $sost4, $sost5, $sost6, $pic[11], $pic[12], $pic[13], $pic[14], $pic[15], $pic[16], $pic[17], $pic[18], $pic[19], $pic[20], $pic[21]);
if($config['user']['admin']=='1'){
updateShowMotoOk ($id);
updateAdminMoto($id);
}

if ($_FILES['photo_free']["error"] == UPLOAD_ERR_OK) {

			resizepic($_FILES['photo_free']["tmp_name"], "../forfreeimages/".$id."_moto_.jpg", 290, 163);
			
		}
		
$col=rand (100000, 999999);
$smarty->assign("mm", '<h1 style="color:#'.$col.'">Мотоцикл добавлен</h1>');
$smarty->assign("title", 'Добавление мотоцикла');
$smarty->display("moto_add.tpl");
}
if($mode=='spis'){
//print_r($config['user']['id']);
$moto=getAllMotobyID($config['user']['id']);
if($config['user']['admin']==1)
$moto=getAllMotobyAdminSpis();
$smarty->assign("moto", $moto);
$smarty->assign("title", 'Cписок мотоциклов');
$smarty->display("moto_spis.tpl");
}
if($mode=='del'){
//print_r($config['user']['id']);
$col = processPostVariable('colch');

for ($i=1; $i<=$col; $i++){
$ch[$i] = processPostVariable('ch'.$i);
	if($ch[$i]){
	$moto=getAllMotobyID1($ch[$i]);
	if($config['user']['admin']==1)
	$moto=getAllMotobyAdminSpis();
		if($moto['uid']==$config['user']['id'] || $config['user']['admin']==1){
			delMotobyID($ch[$i]);
			for($j=1; $j<=21; $j++){
			unlink("../motoimg/".$moto['pic'.$j]);
		}
		}
	}
	
}

$moto=getAllMotobyID($config['user']['id']);
if($config['user']['admin']==1)
$moto=getAllMotobyAdminSpis();
$smarty->assign("moto", $moto);
$smarty->assign("title", 'Cписок мотоциклов');
$smarty->display("moto_spis.tpl");
}
if($mode=='autoshow1'){
//print_r($config['user']['id']);
$col = processPostVariable('colch');

for ($i=1; $i<=$col; $i++){
$ch[$i] = processPostVariable('ch'.$i);
	if($ch[$i]){
	$moto=getAllMotobyID1($ch[$i]);
	if($config['user']['admin']==1)
	$moto=getAllMotobyAdminSpis();
		if($moto['uid']==$config['user']['id'] || $config['user']['admin']==1){
			updateShowMotoOk($ch[$i]);
		}
	}
	
}

$moto=getAllMotobyID($config['user']['id']);
if($config['user']['admin']==1)
$moto=getAllMotobyAdminSpis();
$smarty->assign("moto", $moto);
$smarty->assign("title", 'Cписок мотоциклов');
$smarty->display("moto_spis.tpl");
}
if($mode=='autoshow2'){
//print_r($config['user']['id']);
$col = processPostVariable('colch');

for ($i=1; $i<=$col; $i++){
$ch[$i] = processPostVariable('ch'.$i);
	if($ch[$i]){
	$moto=getAllMotobyID1($ch[$i]);
	if($config['user']['admin']==1)
	$moto=getAllMotobyAdminSpis();
		if($moto['uid']==$config['user']['id'] || $config['user']['admin']==1){
			updateShowMotoNo($ch[$i]);
		}
	}
	
}

$moto=getAllMotobyID($config['user']['id']);
if($config['user']['admin']==1)
$moto=getAllMotobyAdminSpis();
$smarty->assign("moto", $moto);
$smarty->assign("title", 'Cписок мотоциклов');
$smarty->display("moto_spis.tpl");
}
if($mode=='prod'){
//print_r($config['user']['id']);
$col = processPostVariable('colch');

for ($i=1; $i<=$col; $i++){
$ch[$i] = processPostVariable('ch'.$i);
	if($ch[$i]){
	$moto=getAllMotobyID1($ch[$i]);
	if($config['user']['admin']==1)
	$moto=getAllMotobyAdminSpis();
		if($moto['uid']==$config['user']['id'] || $config['user']['admin']==1){
			prodMoto($ch[$i]);
		}
	}
	
}

$moto=getAllMotobyID($config['user']['id']);
if($config['user']['admin']==1)
$moto=getAllMotobyAdminSpis();
$smarty->assign("moto", $moto);
$smarty->assign("title", 'Cписок мотоциклов');
$smarty->display("moto_spis.tpl");
}
if($mode=='neprod'){
//print_r($config['user']['id']);
$col = processPostVariable('colch');

for ($i=1; $i<=$col; $i++){
$ch[$i] = processPostVariable('ch'.$i);
	if($ch[$i]){
	$moto=getAllMotobyID1($ch[$i]);
	if($config['user']['admin']==1)
	$moto=getAllMotobyAdminSpis();
		if($moto['uid']==$config['user']['id'] || $config['user']['admin']==1){
			unprodMoto($ch[$i]);
		}
	}
	
}

$moto=getAllMotobyID($config['user']['id']);
if($config['user']['admin']==1)
$moto=getAllMotobyAdminSpis();
$smarty->assign("moto", $moto);
$smarty->assign("title", 'Cписок мотоциклов');
$smarty->display("moto_spis.tpl");
}
if($mode=='edit_info'){
//print_r($config['user']['id']);
$id = processGetVariable('id');
$moto=getAllMotobyID1($id);
$smarty->assign("moto", $moto);
$smarty->assign("title", 'Редактирование мотоцикла');
$smarty->display("moto_edit_i.tpl");
}
if($mode=='pic_delete'){
//print_r($config['user']['id']);
$id = processGetVariable('id');
unlink("../forfreeimages/".$id."_moto_.jpg");//////////////////////////////////////////////////////////////////////////////////////////////
$moto=getAllMotobyID1($id);
$smarty->assign("moto", $moto);
$smarty->assign("title", 'Редактирование мотоцикла');
$smarty->display("moto_edit_i.tpl");
}
if($mode=='edit_foto'){
//print_r($config['user']['id']);
$id = processGetVariable('id');
$moto=getAllMotobyID1($id);
$smarty->assign("moto", $moto);
$smarty->assign("title", 'Редактирование фото');
$smarty->display("moto_edit_f.tpl");
}
if($mode=='info_submit'){
//print_r($config['user']['id']);

$id = processPostVariable('id');
$mark = processPostVariable('mark');
$model = processPostVariable('model');
$year = processPostVariable('year');
$color = processPostVariable('color');
$tip_dv = processPostVariable('tip_dv');
$obem = processPostVariable('obem');
$prob = processPostVariable('prob');
$tprob = processPostVariable('tprob');
$cost = processPostVariable('cost');
$option = processPostVariable('option');
$oth_inf = processPostVariable('oth_inf');
$title = processPostVariable('title');
$vin = processPostVariable('vin');
$tip_cat = processPostVariable('tip_cat');
$raspol = processPostVariable('raspol');
$for_free_text = processPostVariable('for_free_text');
$for_free_link = processPostVariable('for_free_link');
$sost1 = processPostVariable('sost1');
$sost2 = processPostVariable('sost2');
$sost3 = processPostVariable('sost3');
$sost4 = processPostVariable('sost4');
$sost5 = processPostVariable('sost5');
$sost6 = processPostVariable('sost6');

		if ($_FILES['photo_free']["error"] == UPLOAD_ERR_OK) {

			resizepic($_FILES['photo_free']["tmp_name"], "../forfreeimages/".$id."_moto_.jpg", 290, 163);
			
		}
updMotoInf($id, $mark, $model, $year, $color, $tip_dv, $obem, $prob, $tprob, $cost, $option, $oth_inf, $title, $vin, $tip_cat, $raspol, $for_free_text , $for_free_link, $sost1, $sost2, $sost3, $sost4, $sost5, $sost6);
$moto=getAllMotobyID($config['user']['id']);
if($config['user']['admin']==1)
$moto=getAllMotobyAdminSpis();
$smarty->assign("moto", $moto);
$smarty->assign("title", 'Cписок мотоциклов');
$smarty->display("moto_spis.tpl");
}
if($mode=='foto_submit'){
//print_r($config['user']['id']);
$id = processPostVariable('id');
$moto=getAllMotobyID1($id);
require_once('resize.php');
for($i=1; $i<=21; $i++)
if($_FILES["pic".$i]["error"] == UPLOAD_ERR_OK){
		ereg(".+\.(.{3})",$_FILES["pic".$i]["name"],$nash);
   		$rash=$nash[1];
   		$time=time().$i;
   		$pic[$i]=md5($time).".".$rash;
		//copy($_FILES["pic".$i]["tmp_name"],"../motoimg/".$pic[$i]);
		resizepic($_FILES["pic".$i]["tmp_name"], "../motoimg/".$pic[$i], 700, 400);
		resizepic($_FILES["pic".$i]["tmp_name"], "../motoimg/m-".$pic[$i], 131, 98);
   		unset($nash);
   		unset($time);
   		unset($rash);
		unlink("../motoimg/".$moto['pic'.$i]);
	}
	else
	$pic[$i]=$moto['pic'.$i];
updMotoFoto($id, $pic[1], $pic[2], $pic[3], $pic[4], $pic[5], $pic[6], $pic[7], $pic[8], $pic[9], $pic[10], $pic[11], $pic[12], $pic[13], $pic[14], $pic[15], $pic[16], $pic[17], $pic[18], $pic[19], $pic[20], $pic[21]);
$moto=getAllMotobyID($config['user']['id']);
if($config['user']['admin']==1)
$moto=getAllMotobyAdminSpis();
$smarty->assign("moto", $moto);
$smarty->assign("title", 'Cписок мотоциклов');
$smarty->display("moto_spis.tpl");
}
if($mode=="del_pic"){
//print_r($config['user']['id']);
$id1 = processGetVariable('id1');
$id2 = processGetVariable('id2');
$moto=getAllMotobyID1($id2);
delFoto($id2, $id1);
unlink("../motoimg/".$moto[$id1]);
$moto=getAllMotobyID1($id2);
$smarty->assign("moto", $moto);
$smarty->assign("title", 'Редактирование фото');
$smarty->display("moto_edit_f.tpl");
}
if($mode=="list"){
//print_r($config['user']['id']);
$page=processGetVariable('id');
if(!$page)
$page=1;
$moto=getAllMotobyAdmin($tip_cat);
$pages=count($moto);
if ($pages<=15)
$pages=2;
else
if($pages % 15 == 0)
$pages=$pages/15+1;
else
$pages=$pages/15+2;
for($i=0; $i<=count($moto); $i++)
$masM[$i]=$moto[$i]['mark'];
$masM=array_unique($masM);
	for($i=0; $i<count($moto); $i++){
	$fileNamePic="../forfreeimages/".$moto[$i]['id']."_moto_.jpg";
	 	if (file_exists($fileNamePic)) {
		$moto[$i]['picc']=1;
		}}
$smarty->assign("masm", $masM);
$smarty->assign("pages", $pages);
$smarty->assign("zaps", (($page-1)*15));
$smarty->assign("page", $page);
$smarty->assign("moto", $moto);
$smarty->assign("tip_cat", $tip_cat);
$smarty->assign("title", 'Мотоциклы в наличии');
$smarty->display("moto_list.tpl");
}
if($mode=="list1"){
//print_r($config['user']['id']);
$brand=processGetVariable('brand');

$page=processGetVariable('id');
$moto=getAllMotobyBrand($brand, $tip_cat);
$pages=count($moto);
if ($pages<=15)
$pages=2;
else
if($pages % 15 == 0)
$pages=$pages/15+1;
else
$pages=$pages/15+2;
for($i=0; $i<=count($moto); $i++)
$masM[$i]=$moto[$i]['mark'];
$masM=array_unique($masM);
	for($i=0; $i<count($moto); $i++){
	$fileNamePic="../forfreeimages/".$moto[$i]['id']."_moto_.jpg";
	 	if (file_exists($fileNamePic)) {
		$moto[$i]['picc']=1;
		}}
$smarty->assign("masm", $masM);
$smarty->assign("pages", $pages);
$smarty->assign("zaps", (($page-1)*15));
$smarty->assign("page", $page);
$smarty->assign("moto", $moto);
$smarty->assign("brand", $brand);
$smarty->assign("title", 'Мотоциклы в наличии');
$smarty->display("moto_blist.tpl");
}
if($mode=="show" || $mode=="show_gift"){
//print_r($config['user']['id']);
$id=processGetVariable('id');
$moto=getAllMotobyID1($id);
$my1=getRandAvailibleMoto(1, $moto['tip_cat'], $id);
//print_r($my1);
if(count($my1)!=0){
	$smarty->assign("haveRand",1);
	$smarty->assign("haveRandpic",$my1[0]['pic1']);
	$smarty->assign("haveRandid",$my1[0]['id']);
	$smarty->assign("haveRandname",$my1[0]['mark'].' '.$my1[0]['model'].' '.$my1[0]['year']);
	}
	else{
	$smarty->assign("haveRand",0);
	}
prosmMoto($id,$moto['prosm']);
$smarty->assign("moto", $moto);
$smarty->assign("title", $moto['mark'].' '.$moto['model'].' '.$moto['year'].'г.');
$j=0;
for($i=2; $i<=21; $i++)
if($moto['pic'.$i]!=""){
$image[$j]=$moto['pic'.$i];
$j++;
}
$fileNamePic="../forfreeimages/".$id."_moto_.jpg";
	 	if (file_exists($fileNamePic)) {
		$smarty->assign("photo_free", '/forfreeimages/'.$id.'_moto_.jpg');
		}
if($mode="show_gift")
$smarty->assign("show_gift", true);
$smarty->assign("image", $image);
$smarty->display("moto_show.tpl");
}


if($mode=='prod1'){
//print_r($config['user']['id']);
$id = processGetVariable('id');
prodMoto($id );

$moto=getAllMotobyID($config['user']['id']);
if($config['user']['admin']==1)
$moto=getAllMotobyAdminSpis();
$smarty->assign("moto", $moto);
$smarty->assign("title", 'Cписок мотоциклов');
$smarty->display("moto_spis.tpl");
}
if($mode=='neprod1'){
//print_r($config['user']['id']);
$id = processGetVariable('id');


unprodMoto($id );
$moto=getAllMotobyID($config['user']['id']);
if($config['user']['admin']==1)
$moto=getAllMotobyAdminSpis();
$smarty->assign("moto", $moto);
$smarty->assign("title", 'Cписок мотоциклов');
$smarty->display("moto_spis.tpl");
}
?>