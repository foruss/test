<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";
require_once LIB_DIR . "calc.php";

	
	require_once('resize.php');
		

	
$id = '9280';

while ($id<'9290') {

$it='1';	
	while ($it<9)
	 {
	  $filename="../carimages/".$id."_".$it.".jpg";
	
		if (file_exists($filename)) 
		
	    {
	    resizepic($filename, "../carimages/".$id."_".$it.".jpg", 700, 400);
	    echo $filename." - Ok<br />";
	    }
	  $it++;
	 
	}
	
	$id++;
}

//again

$id = '9280';

while ($id<'9290') {

$it='1';	
	while ($it<9)
	 {
	  $filename="../carimages/".$id."_".$it."m.jpg";
	
		if (file_exists($filename)) 
		
	    {
	    resizepic($filename, "../carimages/".$id."_".$it."sm.jpg", 96, 60);
	    echo $filename." - <font color=red>Ok</font><br />";
	    }
	  $it++;
	 
	}
	
	$id++;
}

?>
