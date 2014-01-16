<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";
$qual=100;
$tip_width[1]=187;
$tip_width[2]=773;
$tip_width[3]=340;
$tip_width[4]=140;
$tip_width[5]=140;
$tip_width[6]=790;
$tip_width[7]=140;
$tip_width[8]=140;

$tip_height[1]=90;
$tip_height[2]=90;
$tip_height[3]=168;
$tip_height[4]=140;
$tip_height[5]=140;
$tip_height[6]=120;
$tip_height[7]=140;
$tip_height[8]=140;
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
	$smarty->assign("title", 'Добавление банера');
	$smarty->display("baners_add.tpl");
}
if($mode=='add_submit'){
	$link=processPostVariable('link');
	$show=processPostVariable('show');
	$tip=processPostVariable('tip');
	ereg('.+(\..{3,4})$',$_FILES['photo']['name'],$nash);
	$nash[1]=strtolower($nash[1]);
	$id=addBaner($link, $show, $tip, $nash[1]);
	
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
					copy($_FILES['photo']['tmp_name'], '../imgbaners/'.$id.'.gif');
					//$im = imagecreatefromgif($_FILES['photo']['tmp_name']);
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
		if($nash[1]!='gif')
		resizepic($im,'../imgbaners/'.$id.'.jpg',$tip_width[$tip],$tip_height[$tip], $qual);
	}
	
	$arrBaners=getAllBaners();
	$smarty->assign("baners", $arrBaners);
	$smarty->assign("title", 'Cписок банеров');
	$smarty->display("baners_list.tpl");
}
if($mode=='del'){
	delBaners($id);
	$arrBaners=getAllBaners();
	$smarty->assign("baners", $arrBaners);
	$smarty->assign("title", 'Cписок банеров');
	$smarty->display("baners_list.tpl");
	unlink('../imgbaners/'.$id.'.jpg');
}
if($mode=='edit_submit'){
	$link=processPostVariable('link');
	$show=processPostVariable('show');
	$tip=processPostVariable('tip');
	$id=processPostVariable('id');
	
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
					copy($_FILES['photo']['tmp_name'], '../imgbaners/'.$id.'.gif');
					//$im = imagecreatefromgif($_FILES['photo']['tmp_name']);
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
		if($nash[1]!='gif')
		resizepic($im,'../imgbaners/'.$id.'.jpg',$tip_width[$tip],$tip_height[$tip], $qual);
		editBaner($id,$link, $show, $tip, $nash[1]);
	}
	else
	editBaner($id,$link, $show, $tip);
	$arrBaners=getAllBaners();
	$smarty->assign("baners", $arrBaners);
	$smarty->assign("title", 'Cписок банеров');
	$smarty->display("baners_list.tpl");	
}
if($mode=='edit'){
	$smarty->assign("baner", getBanerById($id));
	$smarty->assign("title", 'Редактирование банера');
	$smarty->display("baners_edit.tpl");
}
if($mode=='list'){
	$arrBaners=getAllBaners();
	$smarty->assign("baners", $arrBaners);
	$smarty->assign("title", 'Cписок банеров');
	$smarty->display("baners_list.tpl");
}
if($mode=='show'){
	updBanerShow($id, 1);
	$arrBaners=getAllBaners();
	$smarty->assign("baners", $arrBaners);
	$smarty->assign("title", 'Cписок банеров');
	$smarty->display("baners_list.tpl");
}
if($mode=='unshow'){
	updBanerShow($id, 0);
	$arrBaners=getAllBaners();
	$smarty->assign("baners", $arrBaners);
	$smarty->assign("title", 'Cписок банеров');
	$smarty->display("baners_list.tpl");
}
?>