<?php
ini_set('display_errors', true);
error_reporting(E_ALL); 
set_time_limit(3600);
$debug=false;



$images_cache_dir = 'imagescache/';
$how_many_days_keep_images = 4;
$max_dir_size_in_mb = 250;




clearstatcache();
	function cmp($a, $b) 
	{
   		if ($a['jitter'] === $b['jitter']) {
   	    	return 0;
    	}
    	return ($a['jitter'] > $b['jitter']) ? 1 : -1;
	}
	function getFilesSize($path)
	{
    	$fileSize = 0;
   		$dir = scandir($path);
    
    		foreach($dir as $file)
    		{
        		if (($file!='.') && ($file!='..'))
            		if(is_dir($path . '/' . $file))
                		$fileSize += getFilesSize($path.'/'.$file);
            		else
                		$fileSize += filesize($path . '/' . $file);
    		}
    
    	return $fileSize;
	}
$maxjitter=$how_many_days_keep_images*60*60*24;
$sorted_by_date_array = array();
$files = scandir($images_cache_dir);
foreach($files as $key => $name) 
            {
                if ($name == '.' || $name == '..') continue;
                $full_name = $images_cache_dir.$name;
                $last_modifed = filemtime($full_name);
                $file_size = filesize($full_name);
                $time_modifed =  idate('U',$last_modifed);
                $time_now = idate('U');
                $jitter=$time_now-$time_modifed;
                if ($jitter>$maxjitter){
                	 unlink($full_name);
                	 if ($debug) print  'file '. $name.' deleted(date)<br>';
                }  
                else {
                	$sorted_by_date_array[$name]['name']   =  $name;
                	$sorted_by_date_array[$name]['jitter'] =  $jitter;
                	$sorted_by_date_array[$name]['size'] =  $file_size;
                }
               // print $full_name.', diff='.$jitter.'<br>';                         
            }    
#-------------------------------
$max_size = $max_dir_size_in_mb*1024*1024;
$current_size = getFilesSize($images_cache_dir);
$diff_size = $current_size - $max_size;
//print 'current_size: '.$current_size.' b<br>';
//print '    max_size: '.$max_size.' b<br>';
//print '   diff size: '.$diff_size.' b<br>';

if ($diff_size>0){
	// if dir is lager than need
	uksort($sorted_by_date_array, "cmp");
	foreach ($sorted_by_date_array as $filename => $record) 
	{
		$diff_size -= $record['size'];
		unlink($images_cache_dir.$filename);
		if ($debug) print 'file '. $filename.' deleted(size)<br>';
		if ($diff_size<0) break; 
	}
}	//end if diff>0 
	
	
	
	
	
	
	
	


?>