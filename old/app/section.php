<?php

require_once "../config.php";
ini_set('display_errors', false);
require_once LIB_DIR . "utils.php";

require_once LIB_DIR . "dbutils.php";

require_once LIB_DIR . "smarty.php";


$qual=51;
$w_b=360;
$h_b=270;
$w_m=134;
$h_m=108;
$kol_photo=30;
function resizepic($src_img,$filename,$max_width,$max_height, $quality)
{
$image_quality = (int)$quality;
$addborder = 0;


// Main code

$dst_img = ImageCreateTrueColor($max_width,$max_height);
$orig_x = ImageSX($src_img);
$orig_y = ImageSY($src_img);


if ($max_width < 200){
	$new_y = $max_height;
	$new_x = $orig_x/($orig_y/$max_height);
	if ($new_x < $max_width) {
	    $new_x = $max_width;
	    $new_y = $orig_y/($orig_x/$max_width);
	    ImageCopyResampled($dst_img, $src_img, 0, -($new_y-$max_height)/2, 0, 0, $new_x, $new_y, $orig_x, $orig_y);
		//ImageCopyResampled($dst_img, $src_img,  -($new_x-$max_width)/2, 0, 0, 0, $max_width, $max_height, $orig_x, $orig_y);
	}
	else{
		ImageCopyResampled($dst_img, $src_img,  -($new_x-$max_width)/2, 0, 0, 0, $new_x, $new_y, $orig_x, $orig_y);
		//ImageCopyResampled($dst_img, $src_img, 0, -($new_y-$max_height)/2, 0, 0, $max_width, $max_height, $orig_x, $orig_y);
	}
}
else{
	$new_y = $max_height;
	$new_x = $orig_x/($orig_y/$max_height);
	if ($new_x > $max_width) {
	    $new_x = $max_width;
	    $new_y = $orig_y/($orig_x/$max_width);
	}
	$dst_img = ImageCreateTrueColor($new_x,$new_y);
	ImageCopyResampled($dst_img, $src_img, 0, 0, 0, 0, $new_x, $new_y, $orig_x, $orig_y);	
}

//$dst_img = ImageCreateTrueColor($new_x,$new_y);


if ($addborder == 1) {
    // Add border
    $black = ImageColorAllocate($dst_img, 0, 0, 0);
    ImageSetThickness($dst_img, 1);
    ImageLine($dst_img, 0, 0, $new_x, 0, $black);
    ImageLine($dst_img, 0, 0, 0, $new_y, $black);
    ImageLine($dst_img, $new_x-1, 0, $new_x-1, $new_y, $black);
    ImageLine($dst_img, 0, $new_y-1, $new_x, $new_y-1, $black);
}
////



ImageJpeg($dst_img, $filename);
return;
}
##################################      СОЗДАНИЕ ИЗ BMP         ###############################################
function imagecreatefrombmp($p_sFile){
	$file=fopen($p_sFile,"rb");
    $read=fread($file,10);
    while(!feof($file)&&($read<>""))
    $read.=fread($file,1024);
    $temp=unpack("H*",$read);
    $hex    =    $temp[1];
	$header    =    substr($hex,0,108);
    if (substr($header,0,4)=="424d"){
      $header_parts=str_split($header,2);
	  $width=hexdec($header_parts[19].$header_parts[18]);
      $height=hexdec($header_parts[23].$header_parts[22]);
      unset($header_parts);
     }
     $x=0;
     $y=1;
     $image=imagecreatetruecolor($width,$height);
     $body=substr($hex,108);
     $body_size=(strlen($body)/2);
     $header_size=($width*$height);
     $usePadding=($body_size>($header_size*3)+4);
     for ($i=0;$i<$body_size;$i+=3){
       if ($x>=$width){
         if ($usePadding)
			$i+=$width%4;
         $x=0;
         $y++;
		 if ($y>$height)
             break;
        }
        $i_pos=$i*2;
        $r=hexdec($body[$i_pos+4].$body[$i_pos+5]);
        $g=hexdec($body[$i_pos+2].$body[$i_pos+3]);
        $b=hexdec($body[$i_pos].$body[$i_pos+1]);
        $color=imagecolorallocate($image,$r,$g,$b);
        imagesetpixel($image,$x,$height-$y,$color);
        $x++;
      }
      unset($body);
      return $image;
}  
###################################         СОЗДАНИЕ ИЗ BMP            ##############################################
$partners=getPartners();
$smarty->assign("partners", $partners);

$id = processGetVariable('id');
$s = processGetVariable('s');
$mode = processGetVariable('mode');
$page = processGetVariable('page');

if($mode=='add'){
	$tek_sec=getSectById($s);
	$names=getAllSect_namesById($s);
	$smarty->assign("names", $names);
	$smarty->assign("s", $s);
	include_once '../fckeditor/fckeditor.php';	
	ob_start();
	$oFCKeditor = new FCKeditor('other') ;
	$oFCKeditor->BasePath = '/fckeditor/' ;
	$oFCKeditor->Value = '';
	$oFCKeditor->Height = '450';
	$oFCKeditor->Width = '650';
	$oFCKeditor->Create();
	$page_contents=ob_get_contents();
	ob_end_clean();
	
 	$smarty->assign("fckeditor_data", "$page_contents");
	$smarty->assign("title", 'Добавление в раздел '.$tek_sec['name']);
	$smarty->display("section_add.tpl");
}
if($mode=='add_subm'){
	$names=getAllSect_namesById($s);
	//print_r($names);
	$q_n='';
	$q_v='';
	$q_str='';
	foreach($names as $val){
		$q_n.='`'.$val['id'].'`, ';
	}
	foreach($names as $val){
		$tek_val=$_POST['p'.$val['id']];
		if($val['tip']==0)
			$tek_val = mysql_real_escape_string($tek_val);
		if($val['tip']==2)
			$tek_val = (int)($tek_val);
		if($val['tip']==3)
			$tek_val = (float)($tek_val);
		$q_v.='\''.$tek_val.'\', ';
	}
	$firm = processPostVariable('firm');
	$other = processPostVariable('other');
	$price = processPostVariable('price');
	$firm = mysql_real_escape_string($firm);
	$other = mysql_real_escape_string($other);
	$price = mysql_real_escape_string($price);
	$userid = $config['user']['id'];
	$q_str='insert into `section_'.$s.'` ('.$q_n.' `firm`, `other`, `price`, `uid`) values ('.$q_v.' \''.$firm.'\', \''.$other.'\', \''.$price.'\', \''.$userid.'\')';
	//echo $q_str;
	
	@sql_query($q_str);
	@$id=mysql_insert_id();
	if($_FILES['photo']['error'] == UPLOAD_ERR_OK){
	
		ereg('(\..{3,4})$',$_FILES['photo']['name'],$nash);
		$nash[1]=strtolower($nash[1]);
		switch($nash[1]){
					case '.bmp':
					$im = imagecreatefrombmp($_FILES['photo']['tmp_name']);
					break;
					case '.png':
					$im = imagecreatefrompng($_FILES['photo']['tmp_name']);
					break;
					case '.gif':
					$im = imagecreatefromgif($_FILES['photo']['tmp_name']);
					break;
					case '.jpeg':
					$im = imagecreatefromjpeg($_FILES['photo']['tmp_name']);
					break;
					case '.jpg':
					$im = imagecreatefromjpeg($_FILES['photo']['tmp_name']);
					break;
					default:
					echo "<script>alert('Загруженный файл имеет нестандартное расширение - ".$nash[1]." !');</script>";
				}
		//imagePng($im, '../imgbaners/'.$id.'.png');
		$im1=$im;
		resizepic($im,'../imgsection/'.$s.'-'.$id.'_m.jpg',$w_m, $h_m, $qual);
		resizepic($im1,'../imgsection/'.$s.'-'.$id.'_b.jpg',$w_b, $h_b, $qual);
	}
	
	//insert into `section_names` (`name`, `id_sect`, `tip`) values ('$name', '$id', '$tip')
	//$smarty->display("section_list.tpl");
	$col_dop_pol=getAllSect_namesById_show($s);
	if(count($col_dop_pol)!=0){
		//echo $col_dop_pol['0']['id'];
		$smarty->assign("id_pol_dop",$col_dop_pol['0']['id']);
	}
	$all_sod=getSectBySect($s);
	$smarty->assign("all_sod", $all_sod);
	$tek_sec=getSectById($s);
	$smarty->assign("section", $s);
	$smarty->assign("title", 'Cписок раздела '.$tek_sec['name']);
	$smarty->display("section_list.tpl");
}
if($mode=='list'){
	$col_dop_pol=getAllSect_namesById_show($s);
	if(count($col_dop_pol)!=0){
		//echo $col_dop_pol['0']['id'];
		$smarty->assign("id_pol_dop",$col_dop_pol['0']['id']);
	}
	$all_sod=getSectBySect($s);
	$smarty->assign("all_sod", $all_sod);
	//print_r($all_sod);
	$tek_sec=getSectById($s);
	$smarty->assign("section", $s);
	$smarty->assign("title", 'Cписок раздела '.$tek_sec['name']);
	$smarty->display("section_list.tpl");
}
if($mode=='edit'){

	$sod=getSectBySectId($id, $s);
	$smarty->assign("sod", $sod);
	//print_r($sod);
	$arrBar = array();
	$i=1;
	foreach($sod as $key => $val){
		
		if($key!='id' && $key!='firm' && $key!='other' && $key!='price'){
			$name=getNamePolBySparId($key);
			$arrBar[$i]['name']=$name['name'];
			$arrBar[$i]['id']=$key;
			$arrBar[$i]['val']=$val;
			//echo $name['name'].'<br>';
		}
		else{
			$arrBar[$i]['name']=$key;
			$arrBar[$i]['id']=$key;
			$arrBar[$i]['val']=$val;
			//echo $val.'<br>';
		}
		$i++;
	}
	//print_r($arrBar);
	include_once '../fckeditor/fckeditor.php';	
	ob_start();
	$oFCKeditor = new FCKeditor('other') ;
	$oFCKeditor->Width = '650';
	$oFCKeditor->Height = '450';
	$oFCKeditor->BasePath = '/fckeditor/' ;
	$oFCKeditor->Value = $arrBar['3']['val'];
	$oFCKeditor->Create();
	$page_contents=ob_get_contents();
	ob_end_clean();
	
 	$smarty->assign("fckeditor_data", "$page_contents");
	
	$smarty->assign("id", $id);
	$smarty->assign("s", $s);
	$smarty->assign("arrV", $arrBar);
	$smarty->assign("title", 'Редактирование');
	$smarty->display("section_edit.tpl");
}
if($mode=='edit_subm'){
	$sod=getAllSect_namesById($s);
	$s=(int)$s;
	$q_str='UPDATE `section_'.$s.'` SET ';
	foreach($sod as $val){
		$v=processPostVariable($val['id']);
		if($val['tip']==0)
			$v = mysql_real_escape_string($v);
		if($val['tip']==2)
			$v = (int)($v);
		if($val['tip']==3)
			$v = (float)($v);
		$q_str.='`'.$val['id'].'`= \''.$v.'\', ';
	}
	$firm = processPostVariable('firm');
	$other = processPostVariable('other');
	$price = processPostVariable('price');
	$firm = mysql_real_escape_string($firm);
	$other = mysql_real_escape_string($other);
	$price = mysql_real_escape_string($price);
	$id=(int)$id;
		$q_str.='`firm` = \''.$firm.'\', `other` = \''.$other.'\', `price` = \''.$price.'\'';
		$q_str.=' WHERE id = '.$id;
		//echo $q_str;
		@sql_query($q_str);
	$col_dop_pol=getAllSect_namesById_show($s);
	if(count($col_dop_pol)!=0){
		//echo $col_dop_pol['0']['id'];
		$smarty->assign("id_pol_dop",$col_dop_pol['0']['id']);
	}
	$all_sod=getSectBySect($s);
	$smarty->assign("all_sod", $all_sod);
	$tek_sec=getSectById($s);
	$smarty->assign("section", $s);
	$smarty->assign("title", 'Cписок раздела '.$tek_sec['name']);
	$smarty->display("section_list.tpl");
}
if($mode=='edit_photo'){
	$smarty->assign("id", $id);
	$smarty->assign("section", $s);
	$smarty->assign("kol_photo", $kol_photo);
	$smarty->assign("title", 'Редактирование/добавление фото');
	$smarty->display("section_photo.tpl");
}
if($mode=='photo_subm'){
	$w = processPostVariable('w');
	if($_FILES['photo']['error'] == UPLOAD_ERR_OK){
	
		ereg('.+(\..{3,4})$',$_FILES['photo']['name'],$nash);
		$nash[1]=strtolower($nash[1]);
		switch($nash[1]){
					case '.bmp':
					$im = imagecreatefrombmp($_FILES['photo']['tmp_name']);
					break;
					case '.png':
					$im = imagecreatefrompng($_FILES['photo']['tmp_name']);
					break;
					case '.gif':
					$im = imagecreatefromgif($_FILES['photo']['tmp_name']);
					break;
					case '.jpeg':
					$im = imagecreatefromjpeg($_FILES['photo']['tmp_name']);
					break;
					case '.jpg':
					$im = imagecreatefromjpeg($_FILES['photo']['tmp_name']);
					break;
					default:
					echo "<script>alert('Загруженный файл имеет нестандартное расширение - ".$nash[1]." !');</script>";
				}
		//imagePng($im, '../imgbaners/'.$id.'.png');
		$im1=$im;
		ImageJpeg($im1, ROOT_DIR.'imgsection/'.$s.'-'.$id.'_'.$w.'b.jpg');
		resizepic($im,ROOT_DIR.'imgsection/'.$s.'-'.$id.'_'.$w.'m.jpg',$w_m, $h_m, $qual);
		//resizepic($im1,ROOT_DIR.'imgsection/'.$s.'-'.$id.'_'.$w.'b.jpg',$w_b, $h_b, $qual);
		
	}
	$smarty->assign("rand", rand(1,10000));
	$smarty->assign("id", $id);
	$smarty->assign("section", $s);
	$smarty->assign("kol_photo", $kol_photo);
	$smarty->assign("title", 'Редактирование/добавление фото');
	$smarty->display("section_photo.tpl");
}
if($mode=='photo_del'){
	$w = processPostVariable('w');
	@unlink(ROOT_DIR.'imgsection/'.$s.'-'.$id.'_'.$w.'m.jpg');
	@unlink(ROOT_DIR.'imgsection/'.$s.'-'.$id.'_'.$w.'b.jpg');
	$smarty->assign("id", $id);
	$smarty->assign("section", $s);
	$smarty->assign("kol_photo", $kol_photo);
	$smarty->assign("title", 'Редактирование/добавление фото');
	$smarty->display("section_photo.tpl");
}
if($mode=='del'){
	delSecZap($id, $s);
	@unlink(ROOT_DIR.'imgsection/'.$s.'-'.$id.'_m.jpg');
	@unlink(ROOT_DIR.'imgsection/'.$s.'-'.$id.'_b.jpg');
	for($i=0; $i<=$kol_photo; $i++){
		@unlink(ROOT_DIR.'imgsection/'.$s.'-'.$id.'_'.$i.'m.jpg');
		@unlink(ROOT_DIR.'imgsection/'.$s.'-'.$id.'_'.$i.'b.jpg');
	}
	$col_dop_pol=getAllSect_namesById_show($s);
	if(count($col_dop_pol)!=0){
		//echo $col_dop_pol['0']['id'];
		$smarty->assign("id_pol_dop",$col_dop_pol['0']['id']);
	}
	$all_sod=getSectBySect($s);
	$smarty->assign("all_sod", $all_sod);
	$tek_sec=getSectById($s);
	$smarty->assign("section", $s);
	$smarty->assign("title", 'Cписок раздела '.$tek_sec['name']);
	$smarty->display("section_list.tpl");
}
if($mode=='spis'){
	if($id=='')
	$id=1;
	$arr=getSectByPage($s, $id);
	$arrBar = array();
	$i=1;
	foreach($arr as $val){
		foreach($val as $key=>$v){
			if($key!='id' && $key!='firm' && $key!='other' && $key!='price'){
				$n=getNamePolBySparId($key);
				
				if($n['show_main']==1){
					$arrBar[$i][$n['name']]=$v;

				}
			}	
		}
		$i++;
	}
	//print_r($arrBar);
	$page=$id;
	$count=getCountBySectId($s);
	$count=$count['col'];
	$pages_count = ($count % 10 == 0 ? $count / 10 : floor($count / 10) + 1);
	$pages = array();
	$dots = false;

	for ($i = 1; $i <= $pages_count; ++$i) {

		if ((abs($i - $page) <= 4) || ($i <= 5) || ($i >= $pages_count - 4)) {

			$pages[] = array('num' => $i, 'link' => "/section/$s/spis/$i/");

			$dots = false;
		} else if (!$dots) {
			$pages[] = array('num' => '...');
			$dots = true;

		}

	}
	if(count($pages)==1){
		$ltp['link']="/section/$s/spis/";
		$gtp['link']="/section/$s/spis/";
	}
	else{
		if(count($pages)==$page){
			$ltp['link']="/section/$s/spis/".($page-1).'/';
			$gtp['link']="/section/$s/spis/$page/";
		}
		else{
			$ltp['link']="/section/$s/spis/$page/";
			$gtp['link']="/section/$s/spis/".($page+1).'/';
		}
		
	}
	$smarty->assign('ltp', $ltp);
	$smarty->assign('gtp', $gtp);	
	
	$smarty->assign('pages', $pages);
	$smarty->assign('page', $page);		
	$tek_sec=getSectById($s);
	$smarty->assign("title", 'Cписок раздела '.$tek_sec['name']);
	$smarty->assign("cat", getCatBySect($s));
	$smarty->assign("s", $s);
	$smarty->assign("arr", $arr);
	$smarty->assign("arrBar", $arrBar);	
	$smarty->display("section_spis.tpl");
}
if($mode=='find'){
	if($page=='')
	$page=1;
	$arr=getSectByPageFind($s, $page, $id);
	$arrBar = array();
	$i=1;
	foreach($arr as $val){
		foreach($val as $key=>$v){
			if($key!='id' && $key!='firm' && $key!='other' && $key!='price'){
				$n=getNamePolBySparId($key);
				
				if($n['show_main']==1){
					$arrBar[$i][$n['name']]=$v;

				}
			}	
		}
		$i++;
	}
	//print_r($arrBar);
	$count=getCountBySectIdFind($s, $id);
	$count=$count['col'];
	$pages_count = ($count % 10 == 0 ? $count / 10 : floor($count / 10) + 1);
	$pages = array();
	$dots = false;

	for ($i = 1; $i <= $pages_count; ++$i) {

		if ((abs($i - $page) <= 4) || ($i <= 5) || ($i >= $pages_count - 4)) {

			$pages[] = array('num' => $i, 'link' => "/section/$s/spis/$i/");

			$dots = false;
		} else if (!$dots) {
			$pages[] = array('num' => '...');
			$dots = true;

		}

	}
	if(count($pages)==1){
		$ltp['link']="/section/$s/spis/";
		$gtp['link']="/section/$s/spis/";
	}
	else{
		if(count($pages)==$page){
			$ltp['link']="/section/$s/spis/".($page-1).'/';
			$gtp['link']="/section/$s/spis/$page/";
		}
		else{
			$ltp['link']="/section/$s/spis/$page/";
			$gtp['link']="/section/$s/spis/".($page+1).'/';
		}
		
	}
	$smarty->assign('ltp', $ltp);
	$smarty->assign('gtp', $gtp);	
	
	$smarty->assign('pages', $pages);
	$smarty->assign('page', $page);		
		$tek_sec=getSectById($s);
	$smarty->assign("title", 'Cписок раздела '.$tek_sec['name']);
	$smarty->assign("cat", getCatBySect($s));
	$smarty->assign("s", $s);
	$smarty->assign("arr", $arr);
	$smarty->assign("arrBar", $arrBar);	
	$smarty->display("section_spis.tpl");
}
if($mode=='show'){

	$sod=getSectBySectId($id, $s);
	$smarty->assign("sod", $sod);
	$arrBar = array();
	$i=0;
	foreach($sod as $key => $val){
		
		if($key!='id' && $key!='firm' && $key!='other' && $key!='price' && $key!='uid'){
			$name=getNamePolBySparId($key);
			$arrBar[$i]['name']=$name['name'];
			$arrBar[$i]['id']=$key;
			$arrBar[$i]['val']=$val;
			//echo $name['name'].'<br>';
		}
		else{
			$arrBar[$i]['name']=$key;
			$arrBar[$i]['id']=$key;
			$arrBar[$i]['val']=$val;
			//echo $val.'<br>';
		}
		$i++;
	}
	//print_r($arrBar);
	$smarty->assign("id", $id);
	$count=getCountBySectId($s);
	$count=$count['col'];
	$count=(int)$count;
	if($count>1){
	
		$smarty->assign("haveRand", 1);
		$rand1=$id;
		$rArr=getSectBySect($s);
		//print_r($rArr);
		while($rand1==$id){
			$rand=rand(0, $count-1);
			$rand1=$rArr[$rand]['id'];		
		}
		
		$rArr=$rArr[$rand];
		//$smarty->assign("haveRandname", $rand);
		if(!file_exists(ROOT_DIR.'imgsection/'.$s.'-'.$rArr['id'].'_b.jpg')){
			$smarty->assign("rimg_no", 1);
		}
		
		$smarty->assign("haveRandname", $rArr['id']);
		$smarty->assign("haveRandnameN", $rArr['firm']);
		$smarty->assign("haveRandnameP", $rArr['price']);
	}
	$j=0;
	$arrImg = array();
	for($i=0; $i<=$kol_photo; $i++){
		$fileNamePic=ROOT_DIR.'imgsection/'.$s.'-'.$id.'_'.$i.'m.jpg';
	 	if (file_exists($fileNamePic)) {
			$arrImg[$j]=$i;
		}
		$j++;
	}
	$smarty->assign("imgs", $arrImg);
	$smarty->assign("s", $s);
	$smarty->assign("arrV", $arrBar);
	$smarty->assign("title", 'Automixs');
	$smarty->display("section_show.tpl");
}
if($mode=='print'){

	$sod=getSectBySectId($id, $s);
	$smarty->assign("sod", $sod);
	$arrBar = array();
	$i=0;
	foreach($sod as $key => $val){
		
		if($key!='id' && $key!='firm' && $key!='other' && $key!='price'){
			$name=getNamePolBySparId($key);
			$arrBar[$i]['name']=$name['name'];
			$arrBar[$i]['id']=$key;
			$arrBar[$i]['val']=$val;
			//echo $name['name'].'<br>';
		}
		else{
			$arrBar[$i]['name']=$key;
			$arrBar[$i]['id']=$key;
			$arrBar[$i]['val']=$val;
			//echo $val.'<br>';
		}
		$i++;
	}
	//print_r($arrBar);
	$smarty->assign("id", $id);
	$count=getCountBySectId($s);
	$count=$count['col'];
	$count=(int)$count;
	if($count>1){
		$smarty->assign("haveRand", 1);
		$rand=$id;
		while($rand==$id){
			$rand=rand(0, $count-1);
		}
		
		
		$smarty->assign("haveRandname", $rand);
		$rArr=getSectBySect($s);
		$rArr=$rArr[$rand];
		$smarty->assign("haveRandnameN", $rArr['firm']);
		$smarty->assign("haveRandnameP", $rArr['price']);
	}
	$j=0;
	$arrImg = array();
	for($i=0; $i<=$kol_photo; $i++){
		$fileNamePic=ROOT_DIR.'imgsection/'.$s.'-'.$id.'_'.$i.'m.jpg';
	 	if (file_exists($fileNamePic)) {
			$arrImg[$j]=$i;
		}
		$j++;
	}
	$smarty->assign("imgs", $arrImg);
	$smarty->assign("s", $s);
	$smarty->assign("arrV", $arrBar);
	$smarty->assign("title", 'Automixs');
	$smarty->display("section_print.tpl");
}
?>