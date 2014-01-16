<?php

$uploads_dir = "../../../image/data/";

$myFiles = array();

if(count($_FILES["Filedata"]["error"]) < 2) {
        // Single file
        $tmp_name = $_FILES["Filedata"]["tmp_name"];
        $name = $_FILES["Filedata"]["name"];
        $ext = substr(strrchr($name, '.'), 1);
        switch(strtolower($ext)) {
                case 'jpg':
                case 'jpeg':
                case 'png':
                case 'gif':
                case 'png':
                case 'doc':
                case 'txt':
                        move_uploaded_file($tmp_name, "$uploads_dir/$name");
                break;
                default:
                        exit();
                break;
        }
        
        array_push($myFiles, resize($uploads_dir.$name, 100, 100));
        
} else {
        // Multiple files
        foreach ($_FILES["Filedata"]["error"] as $key => $error) {
                if ($error == UPLOAD_ERR_OK) {
                        $tmp_name = $_FILES["Filedata"]["tmp_name"][$key];
                        $name = $_FILES["Filedata"]["name"][$key];
                        $ext = substr(strrchr($name, '.'), 1);
                        switch(strtolower($ext)) {
                                case 'jpg':
                                case 'jpeg':
                                case 'png':
                                case 'gif':
                                case 'png':
                                case 'doc':
                                case 'txt':
                                        move_uploaded_file($tmp_name, "$uploads_dir/$name");
                                break;
                                default:
                                        exit();
                                break;
                        }

                        array_push($myFiles, resize($uploads_dir.$name, 100, 100));                        
                        
                }
        }
}
//echo 'RETURN DATA!';
echo implode(';', $myFiles);

function resize($filename, $width, $height) {
    require_once('../../../system/library/image.php');
    $image_dir = "../../../image/data/";
    $cache_dir = "../../../image/cache/data/";

    $info = pathinfo($filename);
    $extension = $info['extension'];

    $new_image = substr($info['filename'], 0, strrpos($filename, '.')) . '-' . $width . 'x' . $height . '.' . $extension;

    if (file_exists($image_dir . $info['basename'])){
        $myimage = new Image($image_dir . $info['basename']);
        $myimage->resize($width, $height);
        $myimage->save($cache_dir . $new_image);
    }
    return $info['basename'];
}
?>