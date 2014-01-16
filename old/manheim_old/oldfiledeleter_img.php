<?php
ini_set('display_errors', true);
error_reporting(E_ALL); 
set_time_limit(3600);
$debug=false;



$cache_dir = 'imagescache/';
$how_many_days_keep_files = 4;
$max_dir_size_in_mb = 250;



$deleted_files=0;
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
$maxjitter=$how_many_days_keep_files*60*60*24;
$sorted_by_date_array = array();
$files = scandir($cache_dir);
echo ''.(sizeof($files)-2).' files in cache dir<br>';
foreach($files as $key => $name) 
            {
                if ($name == '.' || $name == '..') continue;
                //if (strpos($name,'.cache')===false) continue;
                $full_name = $cache_dir.$name;
                $last_modifed = filemtime($full_name);
                $file_size = filesize($full_name);
                $time_modifed =  idate('U',$last_modifed);
                $time_now = idate('U');
                $jitter=$time_now-$time_modifed;
                if ($jitter>$maxjitter){
                	 unlink($full_name);
                	 $deleted_files++;
                }  
                else {
                	$sorted_by_date_array[$name]['name']   =  $name;
                	$sorted_by_date_array[$name]['jitter'] =  $jitter;
                	$sorted_by_date_array[$name]['size'] =  $file_size;
                }                       
            }    
#-------------------------------
$max_size = $max_dir_size_in_mb*1024*1024;
$current_size = getFilesSize($cache_dir);
echo 'now cache size: '. round($current_size/1048576,2).' Mb<br>';
echo 'allowed size: '.$max_dir_size_in_mb.' Mb<br>';
$diff_size = $current_size - $max_size;

if ($diff_size>0){
	// if dir is lager than need
	uksort($sorted_by_date_array, "cmp");
	foreach ($sorted_by_date_array as $filename => $record) 
	{
		$diff_size -= $record['size'];
		unlink($cache_dir.$filename);
		$deleted_files++;
		if ($diff_size<0) break; 
	}
}	//end if diff>0 
	
echo 'done';	
if 	($deleted_files>0) echo '<br>deleted '.$deleted_files.' files';
	
	
	
	
	


?>