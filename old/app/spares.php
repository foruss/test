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
$cat=getAllSparesCategory();
$smarty->assign("cat", $cat);
$smarty->assign("title", 'Добавление запчастей');
$smarty->display("spares_add.tpl");
}
if($mode=='add_submit'){
$time1=date( 'd-m-Yг.', time() );
$cat = processPostVariable('cat');
$part = processPostVariable('part');
$uid = processPostVariable('uid');
$mark = processPostVariable('mark');
$model = processPostVariable('model');
$oth_inf = processPostVariable('oth_inf');
$tip_cat = processPostVariable('tip_cat');
$cost = processPostVariable('cost');
$sp_cat=getSparesCategoryById($cat);
$for_free_text = processPostVariable('for_free_text');

$col=(int)$sp_cat['col']+1;
//echo "col-$col<br>";
//echo "colst-".$sp_cat['col']."<br>";
//echo "id-$cat<br>";
addSparesCategoryCol($cat, $col);
require_once('resize.php');
for($i=1; $i<=21; $i++)
if($_FILES["pic".$i]["error"] == UPLOAD_ERR_OK){
		ereg(".+\.(.{3,4})",$_FILES["pic".$i]["name"],$nash);
   		$rash=$nash[1];
		if($rash!=''){
			$time=time().$i;
			$pic[$i]=md5($time).".".$rash;
			//copy($_FILES["pic".$i]["tmp_name"],"../sparesimg/".$pic[$i]);
			resizepic($_FILES["pic".$i]["tmp_name"], "../sparesimg/".$pic[$i], 700, 400);
			resizepic($_FILES["pic".$i]["tmp_name"], "../sparesimg/m-".$pic[$i], 131, 98);
			unset($nash);
			unset($time);
			unset($rash);
		}
		else
		$pic[$i]="";
	}
	else
	$pic[$i]="";
$id=addSpares($cat, $sp_cat['name'], $uid, $mark, $model,  $oth_inf, $time1, $tip_cat, $cost, $pic[1], $pic[2], $pic[3], $pic[4], $pic[5], $pic[6], $pic[7], $pic[8], $pic[9], $pic[10], $part, $for_free_text, $pic[11], $pic[12], $pic[13], $pic[14], $pic[15], $pic[16], $pic[17], $pic[18], $pic[19], $pic[20], $pic[21]);
if($config['user']['admin']=='1'){
updateAdminSpares($id);
}
require_once('resize.php');
if ($_FILES['photo_free']["error"] == UPLOAD_ERR_OK) {

			resizepic($_FILES['photo_free']["tmp_name"], "../forfreeimages/".$id."_spares_.jpg", 290, 163);
			
		}
		
$col=rand (100000, 999999);
$smarty->assign("mm", '<h1 style="color:#'.$col.'">Запчасть добавлена</h1>');
$smarty->assign("title", 'Добавление запчастей');
$smarty->display("spares_add.tpl");
}
if($mode=='spis'){
$spares=getAllSparesbyID($config['user']['id'], $tip_cat);
if($config['user']['admin']==1)
$spares=getAllSparesbyAdminSpis();
$smarty->assign("spares", $spares);
$smarty->assign("title", 'Cписок запчастей');
$smarty->display("spares_spis.tpl");
}
if($mode=='del'){
$col = processPostVariable('colch');

for ($i=1; $i<=$col; $i++){
$ch[$i] = processPostVariable('ch'.$i);
	if($ch[$i]){
	$spares=getAllSparesbyID1($ch[$i], $tip_cat);
	if($config['user']['admin']==1)
	$spares=getAllSparesbyAdmin($tip_cat);
		if($spares['uid']==$config['user']['id'] || $config['user']['admin']==1){
			
			$spar=getAllSparesbyID1($ch[$i], $tip_cat);
			$spar1=getSparesCategoryById($spar['cat_id']);
			$spar1['col']=(int)$spar1['col']-1;
			
			
		
			
			addSparesCategoryCol($spar['cat_id'], $spar1['col']);
			delSparesbyID($ch[$i]);
			
			for($j=1; $j<=21; $j++){
			unlink("../sparesimg/".$spares['pic'.$j]);
			
		}
		}
	}
	
}

$spares=getAllSparesbyID($config['user']['id'], $tip_cat);
if($config['user']['admin']==1)
$spares=getAllSparesbyAdminSpis();
$smarty->assign("spares", $spares);
$smarty->assign("title", 'Cписок запчастей');
$smarty->display("spares_spis.tpl");
}
if($mode=='prod'){
$col = processPostVariable('colch');

for ($i=1; $i<=$col; $i++){
$ch[$i] = processPostVariable('ch'.$i);
	if($ch[$i]){
	$spares=getAllSparesbyID1($ch[$i], $tip_cat);
	if($config['user']['admin']==1)
	$spares=getAllSparesbyAdmin($tip_cat);
		if($spares['uid']==$config['user']['id'] || $config['user']['admin']==1){
			prodSpares($ch[$i]);
		}
	}
	
}

$spares=getAllSparesbyID($config['user']['id'], $tip_cat);
if($config['user']['admin']==1)
$spares=getAllSparesbyAdminSpis();
$smarty->assign("spares", $spares);
$smarty->assign("title", 'Cписок запчастей');
$smarty->display("spares_spis.tpl");
}
if($mode=='neprod'){
$col = processPostVariable('colch');

for ($i=1; $i<=$col; $i++){
$ch[$i] = processPostVariable('ch'.$i);
	if($ch[$i]){
	$spares=getAllSparesbyID1($ch[$i], $tip_cat);
	if($config['user']['admin']==1)
	$spares=getAllSparesbyAdmin($tip_cat);
		if($spares['uid']==$config['user']['id'] || $config['user']['admin']==1){
			unprodSpares($ch[$i]);
		}
	}
	
}

$spares=getAllSparesbyID($config['user']['id'], $tip_cat);
if($config['user']['admin']==1)
$spares=getAllSparesbyAdminSpis();
$smarty->assign("spares", $spares);
$smarty->assign("title", 'Cписок запчастей');
$smarty->display("spares_spis.tpl");
}
if($mode=='edit_info'){
$id = processGetVariable('id');
$spares=getAllSparesbyID1($id, $tip_cat);
$cat=getAllSparesCategory();
$smarty->assign("cat", $cat);
$smarty->assign("spares", $spares);
$smarty->assign("title", 'Редактирование инфо');
$smarty->display("spares_edit_i.tpl");
}
if($mode=='pic_delete'){
$id = processGetVariable('id');
unlink("../forfreeimages/".$id."_spares_.jpg");//////////////////////////////////////////////////////////////////////////////////////////////
$boat=getAllSparesbyID1($id, $tip_cat);
$smarty->assign("spares", $boat);
$cat=getAllSparesCategory();
$smarty->assign("cat", $cat);
$smarty->assign("title", 'Редактирование инфо');
$smarty->display("spares_edit_i.tpl");
}
if($mode=='edit_foto'){
$id = processGetVariable('id');
$spares=getAllSparesbyID1($id, $tip_cat);
$smarty->assign("spares", $spares);
$smarty->assign("title", 'Редактирование фото');
$smarty->display("spares_edit_f.tpl");
}
if($mode=='info_submit'){
$id = processPostVariable('id');
$old_cat_id = processPostVariable('old_cat_id');
$mark = processPostVariable('mark');
$model = processPostVariable('model');
$oth_inf = processPostVariable('oth_inf');
$cost = processPostVariable('cost');
$tip_cat = processPostVariable('tip_cat');
$cat = processPostVariable('cat');
$part = processPostVariable('part');
$for_free_text = processPostVariable('for_free_text');
require_once('resize.php');

		if ($_FILES['photo_free']["error"] == UPLOAD_ERR_OK) {

			resizepic($_FILES['photo_free']["tmp_name"], "../forfreeimages/".$id."_spares_.jpg", 290, 163);
			
		}
if($cat!=$old_cat_id){
$spar1=getSparesCategoryById($old_cat_id);
$spar1['col']=(int)$spar1['col']-1;
addSparesCategoryCol($old_cat_id, $spar1['col']);
$spar1=getSparesCategoryById($cat);
$spar1['col']=(int)$spar1['col']+1;
addSparesCategoryCol($cat, $spar1['col']);
}

$categoriya=getSparesCategoryById($cat);
updSparesInf($id, $mark, $model, $oth_inf, $cost, $tip_cat, $cat, $categoriya['name'], $part, $for_free_text);
$spares=getAllSparesbyID($config['user']['id'], $tip_cat);
if($config['user']['admin']==1)
$spares=getAllSparesbyAdminSpis();
$smarty->assign("spares", $spares);
$smarty->assign("title", 'Cписок запчастей');
$smarty->display("spares_spis.tpl");
}
if($mode=='foto_submit'){
$id = processPostVariable('id');
$spares=getAllSparesbyID1($id);
require_once('resize.php');
for($i=1; $i<=21; $i++)
if($_FILES["pic".$i]["error"] == UPLOAD_ERR_OK){
		ereg(".+\.(.{3})",$_FILES["pic".$i]["name"],$nash);
   		$rash=$nash[1];
		if($rash!=''){
			$time=time().$i;
			$pic[$i]=md5($time).".".$rash;
			//copy($_FILES["pic".$i]["tmp_name"],"../sparesimg/".$pic[$i]);
			resizepic($_FILES["pic".$i]["tmp_name"], "../sparesimg/".$pic[$i], 700, 400);
			resizepic($_FILES["pic".$i]["tmp_name"], "../sparesimg/m-".$pic[$i], 131, 98);
			unset($nash);
			unset($time);
			unset($rash);
			unlink("../sparesimg/".$spares['pic'.$i]);
		}
		else
		$pic[$i]=$spares['pic'.$i];
	}
	else
	$pic[$i]=$spares['pic'.$i];
updSparesFoto($id, $pic[1], $pic[2], $pic[3], $pic[4], $pic[5], $pic[6], $pic[7], $pic[8], $pic[9], $pic[10], $pic[11], $pic[12], $pic[13], $pic[14], $pic[15], $pic[16], $pic[17], $pic[18], $pic[19], $pic[20], $pic[21]);
$spares=getAllSparesbyID($config['user']['id'], $tip_cat);
if($config['user']['admin']==1)
$spares=getAllSparesbyAdminSpis();
$smarty->assign("spares", $spares);
$smarty->assign("title", 'Cписок запчастей');
$smarty->display("spares_spis.tpl");
}
if($mode=="del_pic"){
$id1 = processGetVariable('id1');
$id2 = processGetVariable('id2');
$spares=getAllSparesbyID1($id2, $tip_cat);
delSpares($id2, $id1);
unlink("../sparesimg/".$spares[$id1]);
$spares=getAllSparesbyID1($id2);
$smarty->assign("spares", $spares);
$smarty->assign("title", 'Редактирование фото');
$smarty->display("spares_edit_f.tpl");
}
if($mode=="list"){
$page=processGetVariable('id');
if(!$page)
$page=1;
$spares=getAllSparesbyAdmin($tip_cat);
$pages=count($spares);
if ($pages<=15)
$pages=2;
else
if($pages % 15 == 0)
$pages=$pages/15+1;
else
$pages=$pages/15+2;
$masM=getMainSearchBrandsSpares($tip_cat);
	for($i=0; $i<count($spares); $i++){
	$fileNamePic="../forfreeimages/".$spares[$i]['id']."_spares_.jpg";
	 	if (file_exists($fileNamePic)) {
		$spares[$i]['picc']=1;
		}}
$smarty->assign("masm", $masM);
$smarty->assign("pages", $pages);
$smarty->assign("zaps", (($page-1)*15));
$smarty->assign("page", $page);
$smarty->assign("spares", $spares);
$smarty->assign("title", 'Запчасти в наличии');
$smarty->assign("tip_cat", $tip_cat);
$smarty->display("spares_list.tpl");
}
if($mode=="list1"){
$brand=processGetVariable('brand');

$page=processGetVariable('id');
$spares=getAllSparesbyBrand($brand, $tip_cat);
$pages=count($spares);
if ($pages<=15)
$pages=2;
else
if($pages % 15 == 0)
$pages=$pages/15+1;
else
$pages=$pages/15+2;
for($i=0; $i<=count($spares); $i++)
$masM[$i]=$spares[$i]['brand'];
$masM=array_unique($masM);
$smarty->assign("tip_cat", $tip_cat);
$smarty->assign("masm", $masM);
$smarty->assign("pages", $pages);
$smarty->assign("zaps", (($page-1)*15));
$smarty->assign("page", $page);
$smarty->assign("spares", $spares);
$smarty->assign("brand", $brand);
$smarty->assign("title", 'Запчасти в наличии');
$smarty->display("spares_blist.tpl");
}
if($mode=="show"){
$id=processGetVariable('id');
$spares=getAllSparesbyID1($id, $tip_cat);
$my1=getRandAvailibleSpares(1, $spares['tip_cat'], $id);
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
prosmSpares($id,$spares['prosm']);
$smarty->assign("spares", $spares);
$smarty->assign("title", $spares['mark'].' '.$spares['model']);
$j=0;
for($i=2; $i<=21; $i++)
if($spares['pic'.$i]!=""){
$image[$j]=$spares['pic'.$i];
$j++;
}
$fileNamePic="../forfreeimages/".$id."_spares_.jpg";
	 	if (file_exists($fileNamePic)) {
		$smarty->assign("photo_free", '/forfreeimages/'.$id.'_spares_.jpg');
		}
$smarty->assign("image", $image);
$smarty->display("spares_show.tpl");
}








if($mode=='add_cat'){
$smarty->assign("title", 'Добавить категорию');
$smarty->display("spares_add_cat.tpl");
}
if($mode=='add_new_cat'){
$cat = processPostVariable('cat');
addCat($cat);
$smarty->assign("mm", 'Категория добавлена');
$smarty->assign("title", 'Добавить категорию');
$smarty->display("spares_add_cat.tpl");
}





if($mode=='prod1'){
$id = processGetVariable('id');
prodSpares($id );

$spares=getAllSparesbyID($config['user']['id'], $tip_cat);
if($config['user']['admin']==1)
$spares=getAllSparesbyAdmin($tip_cat);
$smarty->assign("spares", $spares);
$smarty->assign("title", 'Cписок запчастей');
$smarty->display("spares_spis.tpl");
}
if($mode=='neprod1'){
$id = processGetVariable('id');


unprodSpares($id );
$spares=getAllSparesbyID($config['user']['id'], $tip_cat);
if($config['user']['admin']==1)
$spares=getAllSparesbyAdmin($tip_cat);
$smarty->assign("spares", $spares);
$smarty->assign("title", 'Cписок запчастей');
$smarty->display("spares_spis.tpl");
}
?>