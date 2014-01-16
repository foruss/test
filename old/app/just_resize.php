<?php

function resizepic($src_img,$filename,$max_width,$max_height)

{

$image_quality = 80;

$addborder = 0;
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

if ($max_width== 700){

	$copy_to_x = $new_x-150;
	$copy_to_y = $new_y-35;
	
//imagecopy($dst_img,$logo_img,$copy_to_x,$copy_to_y,0,0,145,31);

//$white = ImageColorAllocate($dst_img, 255, 255, 255);

//imagefilledrectangle ($dst_img,5,5,153,25, $white);

//ImageString($dst_img, 10, 10,6,"4kolesa.By", $black);    

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
?>

