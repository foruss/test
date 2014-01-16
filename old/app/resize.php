<?php

function resizepic($src_img,$filename,$max_width,$max_height)
{
$image_quality = 80;
$addborder = 0;
$png_src="../carimages/logo.png";
$logo_img = imagecreatefrompng($png_src);
// Main code
$src_img = imagecreatefromjpeg($src_img);
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
if ($max_width > 300){
	$copy_to_x = $new_x-137;
	$copy_to_y = $new_y-28;
	imagecopy($dst_img,$logo_img,$copy_to_x,$copy_to_y,0,0,132,23);
}

ImageDestroy($src_img);
ImageJpeg($dst_img, $filename);
return;
}

function resizepic2($src_img,$filename,$max_width,$max_height)

{

$image_quality = 80;

$addborder = 1;
$png_src="../carimages/logo.png";
$logo_img = imagecreatefrompng($png_src);

// Main code

$src_img = imagecreatefromjpeg($src_img);

$orig_x = ImageSX($src_img);

$orig_y = ImageSY($src_img);

$new_y = $max_height;

$new_x = $orig_x/($orig_y/$max_height);

if ($new_x > $max_width) {

    $new_x = $max_width;

    $new_y = $orig_y/($orig_x/$max_width);

}

$dst_img = ImageCreateTrueColor($new_x,$new_y);

ImageCopyResampled($dst_img, $src_img, 0, 0, 0, 0, $new_x, $new_y, $orig_x, $orig_y);

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
/*
if ($max_width== 700){

	$copy_to_x = $new_x-150;
	$copy_to_y = $new_y-35;
	
imagecopy($dst_img,$logo_img,$copy_to_x,$copy_to_y,0,0,145,31);

//$white = ImageColorAllocate($dst_img, 255, 255, 255);

//imagefilledrectangle ($dst_img,5,5,153,25, $white);

//ImageString($dst_img, 10, 10,6,"4kolesa.By", $black);    

}
*/
ImageDestroy($src_img);
ImageJpeg($dst_img, $filename);
return;
}

function resizepicProd($src_img, $filename, $max_width,$max_height,$bestoffers, $type, $png = 0){
	$image_quality = 80;
	$png_src="../prodimages/best-offer.png";
	$logo_img = imagecreatefrompng($png_src);

	// Main code
	if ($type == "image/png"){
		$src_img = imagecreatefrompng($src_img);
	}
	else{
		$src_img = imagecreatefromjpeg($src_img);
	}
	
	$orig_x = ImageSX($src_img);
	$orig_y = ImageSY($src_img);
	
	if ($png == 1){
		$dst_img = ImageCreateTrueColor($max_width,$max_height);
		imagesavealpha($dst_img, true);
		$trans_colour = imagecolorallocatealpha($dst_img, 0, 0, 0, 127);
		imagefill($dst_img, 0, 0, $trans_colour);
		$max_width_p = 100;
		$max_height_p = 60;
		$new_y = $max_height_p;
		$new_x = $orig_x/($orig_y/$max_height_p);
		if ($new_x > $max_width_p) {
		    $new_x = $max_width_p;
		    $new_y = $orig_y/($orig_x/$max_width_p);
		}	
		ImageCopyResampled($dst_img, $src_img, abs($max_width-$new_x)/2, abs($max_height-$new_y)/2, 0, 0, $new_x, $new_y, $orig_x, $orig_y);	
	}
	elseif ($max_width < 200){
		$dst_img = ImageCreateTrueColor($max_width,$max_height);
		$white = ImageColorAllocate($dst_img, 255, 255, 255);
		imagefill($dst_img, 0, 0, $white);		
		$new_y = $max_height;
		$new_x = $orig_x/($orig_y/$max_height);
		if ($new_x < $max_width) {
		    $new_x = $max_width;
		    $new_y = $orig_y/($orig_x/$max_width);
		    ImageCopyResampled($dst_img, $src_img, 0, -($new_y-$max_height)/2, 0, 0, $new_x, $new_y, $orig_x, $orig_y);
		}
		else{			
			ImageCopyResampled($dst_img, $src_img,  -($new_x-$max_width)/2, 0, 0, 0, $new_x, $new_y, $orig_x, $orig_y);
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
		$white = ImageColorAllocate($dst_img, 255, 255, 255);
		imagefill($dst_img, 0, 0, $white);		
		ImageCopyResampled($dst_img, $src_img, 0, 0, 0, 0, $new_x, $new_y, $orig_x, $orig_y);	
	}
	if ($bestoffers == 1){
		$copy_to_x = $new_x - 60;
		$copy_to_y = 15;
		imagecopy($dst_img,$logo_img,$copy_to_x,$copy_to_y,0,0,56,55);
	}
	
	ImageDestroy($src_img);
	if ($png == 1) imagepng($dst_img,$filename);
	else ImageJpeg($dst_img, $filename);
	return;
}
?>