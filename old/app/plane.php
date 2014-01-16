<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";

$partners=getPartners();
$smarty->assign("partners", $partners);


$mode = processGetVariable('mode');
if($mode=='add'){
//print_r($config['user']['id']);
$smarty->assign("title", 'Добавление самолета');
$smarty->display("plane_add.tpl");
}
if($mode=='add_submit'){
$time1=date( 'd-m-Yг.', time() );
$uid = processPostVariable('uid');
$mark = processPostVariable('mark');
$model = processPostVariable('model');
$cost = processPostVariable('cost');
$tip = processPostVariable('tip');
$option = processPostVariable('option');
$oth_inf = processPostVariable('oth_inf');
$year = processPostVariable('year');
$vin = processPostVariable('vin');
$razm_krila = processPostVariable('razm_krila');
$length = processPostVariable('length');
$height = processPostVariable('height');
$pl_krila = processPostVariable('pl_krila');
$max_ves = processPostVariable('max_ves');
$dvigatel = processPostVariable('dvigatel');
$vint = processPostVariable('vint');
$emk_topl_bakov = processPostVariable('emk_topl_bakov');
$max_speed = processPostVariable('max_speed');
$max_polet = processPostVariable('max_polet');
$dalnost = processPostVariable('dalnost');
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
		resizepic($_FILES["pic".$i]["tmp_name"], "../planeimg/".$pic[$i], 700, 400);
		resizepic($_FILES["pic".$i]["tmp_name"], "../planeimg/m-".$pic[$i], 131, 98);
   		unset($nash);
   		unset($time);
   		unset($rash);
	}
	else
	$pic[$i]="";
$id=addPlane($uid, $time1, $mark, $model, $cost, $tip, $option, $oth_inf, $year, $vin, $razm_krila, $length, $height, $pl_krila, $max_ves, $dvigatel, $vint, $emk_topl_bakov, $max_speed, $max_polet, $dalnost, $pic[1], $pic[2], $pic[3], $pic[4], $pic[5], $pic[6], $pic[7], $pic[8], $pic[9], $pic[10], $raspol, $for_free_text , $for_free_link, $pic[11], $pic[12], $pic[13], $pic[14], $pic[15], $pic[16], $pic[17], $pic[18], $pic[19], $pic[20], $pic[21]);
if($config['user']['admin']=='1'){
updateAdminPlane($id);
}
if ($_FILES['photo_free']["error"] == UPLOAD_ERR_OK) {

			resizepic($_FILES['photo_free']["tmp_name"], "../forfreeimages/".$id."_plane_.jpg", 290, 163);
			
		}
$col=rand (100000, 999999);
$smarty->assign("mm", '<h1 style="color:#'.$col.'">Самолет добавлен</h1>');
$smarty->assign("title", 'Добавление самолета');
$smarty->display("plane_add.tpl");
}
if($mode=='spis'){
$plane=getAllPlanebyID($config['user']['id']);
if($config['user']['admin']==1)
$plane=getAllPlanebyAdmin();
$smarty->assign("plane", $plane);
$smarty->assign("title", 'Cписок самолетов');
$smarty->display("plane_spis.tpl");
}
if($mode=='del'){
$col = processPostVariable('colch');

for ($i=1; $i<=$col; $i++){
$ch[$i] = processPostVariable('ch'.$i);
	if($ch[$i]){
	$plane=getAllPlanebyID1($ch[$i]);
	if($config['user']['admin']==1)
	$plane=getAllPlanebyAdmin();
		if($plane['uid']==$config['user']['id'] || $config['user']['admin']==1){
			delPlanebyID($ch[$i]);
			for($j=1; $j<=21; $j++){
			unlink("../planeimg/".$plane['pic'.$j]);
		}
		}
	}
	
}

$plane=getAllPlanebyID($config['user']['id']);
if($config['user']['admin']==1)
$plane=getAllPlanebyAdmin();
$smarty->assign("plane", $plane);
$smarty->assign("title", 'Cписок самолетов');
$smarty->display("plane_spis.tpl");
}
if($mode=='prod'){
$col = processPostVariable('colch');

for ($i=1; $i<=$col; $i++){
$ch[$i] = processPostVariable('ch'.$i);
	if($ch[$i]){
	$plane=getAllPlanebyID1($ch[$i]);
	if($config['user']['admin']==1)
	$plane=getAllPlanebyAdmin();
		if($plane['uid']==$config['user']['id'] || $config['user']['admin']==1){
			prodplane($ch[$i]);
		}
	}
	
}

$plane=getAllPlanebyID($config['user']['id']);
if($config['user']['admin']==1)
$plane=getAllPlanebyAdmin();
$smarty->assign("plane", $plane);
$smarty->assign("title", 'Cписок самолетов');
$smarty->display("plane_spis.tpl");
}
if($mode=='neprod'){
$col = processPostVariable('colch');

for ($i=1; $i<=$col; $i++){
$ch[$i] = processPostVariable('ch'.$i);
	if($ch[$i]){
	$plane=getAllPlanebyID1($ch[$i]);
	if($config['user']['admin']==1)
	$plane=getAllPlanebyAdmin();
		if($plane['uid']==$config['user']['id'] || $config['user']['admin']==1){
			unprodplane($ch[$i]);
		}
	}
	
}

$plane=getAllPlanebyID($config['user']['id']);
if($config['user']['admin']==1)
$plane=getAllPlanebyAdmin();
$smarty->assign("plane", $plane);
$smarty->assign("title", 'Cписок самолетов');
$smarty->display("plane_spis.tpl");
}
if($mode=='edit_info'){
$id = processGetVariable('id');
$plane=getAllPlanebyID1($id);
$smarty->assign("plane", $plane);
$smarty->assign("title", 'Редактирование инфо');
$smarty->display("plane_edit_i.tpl");
}
if($mode=='pic_delete'){
$id = processGetVariable('id');
unlink("../forfreeimages/".$id."_plane_.jpg");//////////////////////////////////////////////////////////////////////////////////////////////
$plane=getAllPlanebyID1($id);
$smarty->assign("plane", $plane);
$smarty->assign("title", 'Редактирование инфо');
$smarty->display("plane_edit_i.tpl");
}
if($mode=='edit_foto'){
$id = processGetVariable('id');
$plane=getAllPlanebyID1($id);
$smarty->assign("plane", $plane);
$smarty->assign("title", 'Редактирование фото');
$smarty->display("plane_edit_f.tpl");
}
if($mode=='info_submit'){
$id = processPostVariable('id');
$mark = processPostVariable('mark');
$model = processPostVariable('model');
$cost = processPostVariable('cost');
$tip = processPostVariable('tip');
$option = processPostVariable('option');
$oth_inf = processPostVariable('oth_inf');
$year = processPostVariable('year');
$vin = processPostVariable('vin');
$razm_krila = processPostVariable('razm_krila');
$length = processPostVariable('length');
$height = processPostVariable('height');
$pl_krila = processPostVariable('pl_krila');
$max_ves = processPostVariable('max_ves');
$dvigatel = processPostVariable('dvigatel');
$vint = processPostVariable('vint');
$emk_topl_bakov = processPostVariable('emk_topl_bakov');
$max_speed = processPostVariable('max_speed');
$max_polet = processPostVariable('max_polet');
$dalnost = processPostVariable('dalnost');
$raspol = processPostVariable('raspol');
$for_free_text = processPostVariable('for_free_text');
$for_free_link = processPostVariable('for_free_link');
require_once('resize.php');

		if ($_FILES['photo_free']["error"] == UPLOAD_ERR_OK) {

			resizepic($_FILES['photo_free']["tmp_name"], "../forfreeimages/".$id."_plane_.jpg", 290, 163);
			
		}
updPlaneInf($id, $mark, $model, $cost, $tip, $option, $oth_inf, $year, $vin, $razm_krila, $length, $height, $pl_krila, $max_ves, $dvigatel, $vint, $emk_topl_bakov, $max_speed, $max_polet, $dalnost, $raspol, $for_free_text , $for_free_link);
$plane=getAllPlanebyID($config['user']['id']);
if($config['user']['admin']==1)
$plane=getAllPlanebyAdmin();
$smarty->assign("plane", $plane);
$smarty->assign("title", 'Cписок самолетов');
$smarty->display("plane_spis.tpl");
}
if($mode=='foto_submit'){
$id = processPostVariable('id');
$plane=getAllPlanebyID1($id);
require_once('resize.php');
for($i=1; $i<=21; $i++)
if($_FILES["pic".$i]["error"] == UPLOAD_ERR_OK){
		ereg(".+\.(.{3})",$_FILES["pic".$i]["name"],$nash);
   		$rash=$nash[1];
   		$time=time().$i;
   		$pic[$i]=md5($time).".".$rash;
		//copy($_FILES["pic".$i]["tmp_name"],"../planeimg/".$pic[$i]);
		resizepic($_FILES["pic".$i]["tmp_name"], "../planeimg/".$pic[$i], 700, 400);
		resizepic($_FILES["pic".$i]["tmp_name"], "../planeimg/m-".$pic[$i], 131, 98);
   		unset($nash);
   		unset($time);
   		unset($rash);
		unlink("../planeimg/".$plane['pic'.$i]);
	}
	else
	$pic[$i]=$plane['pic'.$i];
updPlaneFoto($id, $pic[1], $pic[2], $pic[3], $pic[4], $pic[5], $pic[6], $pic[7], $pic[8], $pic[9], $pic[10], $pic[11], $pic[12], $pic[13], $pic[14], $pic[15], $pic[16], $pic[17], $pic[18], $pic[19], $pic[20], $pic[21]);
$plane=getAllPlanebyID($config['user']['id']);
if($config['user']['admin']==1)
$plane=getAllPlanebyAdmin();
$smarty->assign("plane", $plane);
$smarty->assign("title", 'Cписок самолетов');
$smarty->display("plane_spis.tpl");
}
if($mode=="del_pic"){
$id1 = processGetVariable('id1');
$id2 = processGetVariable('id2');
$plane=getAllPlanebyID1($id2);
delPlane($id2, $id1);
unlink("../planeimg/".$plane[$id1]);
$plane=getAllPlanebyID1($id2);
$smarty->assign("plane", $plane);
$smarty->assign("title", 'Редактирование фото');
$smarty->display("plane_edit_f.tpl");
}
if($mode=="list"){
$page=processGetVariable('id');
if(!$page)
$page=1;
$plane=getAllPlanebyAdmin();
$pages=count($plane);
if ($pages<=15)
$pages=2;
else
if($pages % 15 == 0)
$pages=$pages/15+1;
else
$pages=$pages/15+2;
for($i=0; $i<=count($plane); $i++)
$masM[$i]=$plane[$i]['mark'];
$masM=array_unique($masM);
	for($i=0; $i<count($plane); $i++){
	$fileNamePic="../forfreeimages/".$plane[$i]['id']."_plane_.jpg";
	 	if (file_exists($fileNamePic)) {
		$plane[$i]['picc']=1;
		}}
$smarty->assign("masm", $masM);
$smarty->assign("pages", $pages);
$smarty->assign("zaps", (($page-1)*15));
$smarty->assign("page", $page);
$smarty->assign("plane", $plane);
$smarty->assign("title", 'Самолеты в наличии');
$smarty->display("plane_list.tpl");
}
if($mode=="list1"){
$brand=processGetVariable('brand');

$page=processGetVariable('id');
$plane=getAllPlanebyBrand($brand);

$pages=count($plane);
if ($pages<=15)
$pages=2;
else
if($pages % 15 == 0)
$pages=$pages/15+1;
else
$pages=$pages/15+2;
for($i=0; $i<=count($plane); $i++)
$masM[$i]=$plane[$i]['brand'];
$masM=array_unique($masM);
	for($i=0; $i<count($plane); $i++){
	$fileNamePic="../forfreeimages/".$plane[$i]['id']."_plane_.jpg";
	 	if (file_exists($fileNamePic)) {
		$plane[$i]['picc']=1;
		}}
$smarty->assign("masm", $masM);
$smarty->assign("pages", $pages);
$smarty->assign("zaps", (($page-1)*15));
$smarty->assign("page", $page);
$smarty->assign("plane", $plane);
$smarty->assign("brand", $brand);
$smarty->assign("title", 'Самолеты в наличии');
$smarty->display("plane_blist.tpl");
}
if($mode=="show" || $mode=="show_gift"){
$id=processGetVariable('id');
$plane=getAllPlanebyID1($id);
$my1=getRandAvailiblePlane(1, $id);

if(count($my1)!=0){
	//print_r($my1[0]);
	$smarty->assign("haveRand",1);
	$smarty->assign("haveRandpic",$my1[0]['pic1']);
	$smarty->assign("haveRandid",$my1[0]['id']);
	$smarty->assign("haveRandname",$my1[0]['mark'].' '.$my1[0]['model'].' '.$my1[0]['year']);
	}
	else{
	$smarty->assign("haveRand",0);
	}
prosmPlane($id,$plane['prosm']);
$smarty->assign("plane", $plane);
$smarty->assign("title", $plane['mark'].' '.$plane['model'].' '.$plane['year'].'г.');
$j=0;
for($i=2; $i<=21; $i++)
if($plane['pic'.$i]!=""){
$image[$j]=$plane['pic'.$i];
$j++;
}
$fileNamePic="../forfreeimages/".$id."_plane_.jpg";
	 	if (file_exists($fileNamePic)) {
		$smarty->assign("photo_free", '/forfreeimages/'.$id.'_plane_.jpg');
		}
if($mode="show_gift")
$smarty->assign("show_gift", true);
$smarty->assign("image", $image);
$smarty->display("plane_show.tpl");
}















if($mode=='prod1'){
$id = processGetVariable('id');
prodPlane($id );

$plane=getAllPlanebyID($config['user']['id']);
if($config['user']['admin']==1)
$plane=getAllPlanebyAdmin();
$smarty->assign("plane", $plane);
$smarty->assign("title", 'Cписок самолетов');
$smarty->display("plane_spis.tpl");
}
if($mode=='neprod1'){
$id = processGetVariable('id');


unprodPlane($id );
$plane=getAllPlanebyID($config['user']['id']);
if($config['user']['admin']==1)
$plane=getAllPlanebyAdmin();
$smarty->assign("plane", $plane);
$smarty->assign("title", 'Cписок самолетов');
$smarty->display("plane_spis.tpl");
}
?>