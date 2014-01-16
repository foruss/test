<?php
//require_once "../config.php";
function addSold($id){
	//$id = 9076;
	$i=0;
	
	while ($i<9) {
	
	$src_img = ROOT_DIR."carimages/".$id."_".$i.".jpg";
	$srcsm_img = ROOT_DIR."carimages/".$id."_".$i."m.jpg";
	
	if (file_exists($src_img)){
	
	$filename= $src_img;
	$filenamesm= $srcsm_img;
	
	$png_src="../carimages/sold.png";
	$pngsm_src="../carimages/sold_sm.png";

	$src_img = imagecreatefromjpeg($src_img);
	$srcsm_img = imagecreatefromjpeg($srcsm_img);
	
	$sold_img = imagecreatefrompng($png_src);
	$soldsm_img = imagecreatefrompng($pngsm_src);
	
	$orig_x = ImageSX($src_img);
	$orig_y = ImageSY($src_img);

	$origsm_x = ImageSX($srcsm_img);
	$origsm_y = ImageSY($srcsm_img);
	
	imagecopy($src_img,$sold_img,0,0,0,0,333,225);
	
	imagecopy($srcsm_img,$soldsm_img,0,0,0,0,125,92);
	
	imagejpeg($src_img,$filename);
	imagejpeg($srcsm_img,$filenamesm);
	}//else echo "Doesn't exist! ".$src_img;
	
  $i++;
	}
}
?>

