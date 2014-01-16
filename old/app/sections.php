<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";
ini_set('display_errors', true);
$qual=100;
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


ImageDestroy($src_img);
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
$mode = processGetVariable('mode');

if($mode=='add'){
	$smarty->assign("title", 'Добавление раздела');
	$smarty->display("sections_add.tpl");
}
if($mode=='del'){
	//print_r(getSectBySect($id));
	
	foreach(getSectBySect($id) as $val){
		echo $val['id'];
		@unlink(ROOT_DIR.'imgsections/'.$id.'.jpg');
		@unlink(ROOT_DIR.'imgsection/'.$id.'-'.$val['id'].'_m.jpg');
		@unlink(ROOT_DIR.'imgsection/'.$id.'-'.$val['id'].'_b.jpg');
		for($i=0; $i<=30; $i++){
			@unlink(ROOT_DIR.'imgsection/'.$id.'-'.$val['id'].'_'.$i.'m.jpg');
			@unlink(ROOT_DIR.'imgsection/'.$id.'-'.$val['id'].'_'.$i.'b.jpg');
		}
	}
	delSect($id);
	
	$razds=getAllSect();
	$smarty->assign("razds", $razds);
	$smarty->assign("title", 'Списok разделов');
	$smarty->display("sections_list.tpl");
}
if($mode=='unshow'){
	updSectShow($id, 0);
	$razds=getAllSect();
	$smarty->assign("razds", $razds);
	$smarty->assign("title", 'Список разделов');
	$smarty->display("sections_list.tpl");
}
if($mode=='show'){
	updSectShow($id, 1);
	$razds=getAllSect();
	$smarty->assign("razds", $razds);
	$smarty->assign("title", 'Список разделов');
	$smarty->display("sections_list.tpl");
}
if($mode=='list'){
	$razds=getAllSect();
	$smarty->assign("razds", $razds);
	$smarty->assign("title", 'Список разделов');
	$smarty->display("sections_list.tpl");
}
if($mode=='edit'){
	$tek_sec=getSectById($id);
	if(file_exists(ROOT_DIR.'imgsections/'.$id.'.jpg')){
		$smarty->assign("photo_razd", '1');
	}
	
	$smarty->assign("id", $id);
	//print_r(getAllSect_namesById($id));
	$smarty->assign("sArr", getAllSect_namesById($id));
	$smarty->assign("count_sArr", count(getAllSect_namesById($id)));
	$smarty->assign("name", $tek_sec['name']);
	$smarty->assign("title", 'Редактирование раздела');
	$smarty->display("sections_edit.tpl");
}
if($mode=='add_subm'){
	$name_razd = processPostVariable('name_razd');
	$photo1 = processPostVariable('photo1');
	$smarty->assign("title", 'Список разделов');
	
	$id=addSect($name_razd);
	$kol= processPostVariable('kol');
	$q_str_m='';
	for($i=1; $i<=(int)$kol; $i++){
		$name_pol[$i]=processPostVariable('name'.($i-1));
		$tip_pol[$i]=processPostVariable('tip'.($i-1));
		$show_m=processPostVariable('show'.($i-1));
		$id_pol[$i]=addNamePolSect($name_pol[$i], $id, $tip_pol[$i], $show_m);
		if($tip_pol[$i]==0){
			$q_str_m.='`'.$id_pol[$i].'` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , ';
		}
		if($tip_pol[$i]==2){
			$q_str_m.='`'.$id_pol[$i].'` INT NOT NULL , ';
		}
		if($tip_pol[$i]==3){
			$q_str_m.='`'.$id_pol[$i].'` FLOAT NOT NULL , ';
		}
		
	}
	//$id=addNamePolSect($name_pol);
	//echo $id;
	$userid = $config['user']['id'];
	$q_str='CREATE TABLE `section_'.$id.'` ( `id` INT NOT NULL AUTO_INCREMENT , `firm` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `other` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `price` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `uid` INT NOT NULL ,';
	$q_str.=$q_str_m;
	$q_str.='PRIMARY KEY ( `id` ));';
	createTableByQstr($q_str);
	//print_r($_FILES);
	if($photo1!=''){
		
		copy($photo1,'../imgsections/'.$id.'.jpg');
	
	}
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
		
		resizepic($im,'../imgsections/'.$id.'.jpg',64,64, $qual);
	}
	$razds=getAllSect();
	$smarty->assign("razds", $razds);
	$smarty->display("sections_list.tpl");
}
if($mode=='edit_subm'){
	$id=processPostVariable('id');
	$name_razd = processPostVariable('name_razd');
	$k_pol = processPostVariable('k_pol');
	$smarty->assign("title", 'Список разделов');
	chNameSect($id, $name_razd);
	for($i=1; $i<=(int)$k_pol; $i++){
		if($_POST['s_del'.$i]==1){
			delSecNamePol($_POST['s_id'.$i]);
			$id=(int)$id;
			$id_p=(int)$_POST['s_id'.$i];
			createTableByQstr('ALTER TABLE `section_'.$id.'` DROP `'.$id_p.'`');
		}
		else{
			$id=(int)$id;
			$id_p=(int)$_POST['s_id'.$i];
			if($_POST['s_tip'.$i]==2){
				createTableByQstr('ALTER TABLE `section_'.$id.'` CHANGE `'.$id_p.'` `'.$id_p.'` INT NOT NULL');
			}
			if($_POST['s_tip'.$i]==3){
				createTableByQstr('ALTER TABLE `section_'.$id.'` CHANGE `'.$id_p.'` `'.$id_p.'` FLOAT NOT NULL');
			}
			if($_POST['s_tip'.$i]==0){
				createTableByQstr('ALTER TABLE `section_'.$id.'` CHANGE `'.$id_p.'` `'.$id_p.'` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL');
			}
			
			chSectsPols($_POST['s_id'.$i], $_POST['s_name'.$i], $_POST['s_tip'.$i], $_POST['s_show'.$i]);
		}
	}
	$kol = processPostVariable('kol');
	for($i=0; $i<=(((int)$kol)-1); $i++){
		$id_t=addNamePolSect($_POST['name'.$i], $id, $_POST['tip'.$i], $_POST['show'.$i]);
		$id=(int)$id;
			if($_POST['tip'.$i]==2){
				createTableByQstr('ALTER TABLE `section_'.$id.'` ADD `'.$id_t.'` INT NOT NULL');
			}
			if($_POST['tip'.$i]==3){
				createTableByQstr('ALTER TABLE `section_'.$id.'` ADD `'.$id_t.'` FLOAT NOT NULL');
			}
			if($_POST['tip'.$i]==0){
				createTableByQstr('ALTER TABLE `section_'.$id.'` ADD `'.$id_t.'` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL');
			}
		
	}
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
		
		resizepic($im,'../imgsections/'.$id.'.jpg',64,64, $qual);
	}
	$razds=getAllSect();
	$smarty->assign("razds", $razds);
	$smarty->display("sections_list.tpl");
}
?>