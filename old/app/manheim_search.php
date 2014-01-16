<?php
function parse_element( $html_result, $pattern_1, $pattern_2, $__debug = null )
{
    $element_html_info = html_search( $pattern_1, $html_result );
    
    if ( isset( $element_html_info[1] ) )
    {
        $element_list_info = html_search_all( $pattern_2, $element_html_info[1] );
        if (isset($__debug) && $__debug) {
        	echo "DEBUG";
        	print_r($element_list_info);
        }
        if ( sizeof( $element_list_info ) == 0 )
        {
            return false;
        }
        $i = 0;
        for ( ; $i < sizeof( $element_list_info ); ++$i )
        {
            unset( $element_list_info[$i][0] );
        }
        return $element_list_info;
    } else {
    	return false;
        if (isset($__debug) && $__debug) {
        	echo "DEBUG";
        	print_r($element_list_info);
        }
	}
}

#------------cache--------------------------------------------------------
$url = 'https://www.manheim.com/members/powersearch/';
$post = array( );
$post['username'] = $manheim_login['user'];
$post['password'] = $manheim_login['password'];
	$cachefile = CACHEDIR.'main.cache';
	$maxjitter=$cache_interval_minutes*60;
	$cache_exist = file_exists($cachefile);
	if ($cache_exist){	
		$lasttimestamp = filectime($cachefile);
		$first_timestamp =date('U');
		$second_timestamp=date('U',$lasttimestamp);
		$jitter=$first_timestamp-$second_timestamp;
	} else {
		$jitter=1;
		$maxjitter=0;
	}; 
	if (($cache_exist)&&($jitter<$maxjitter)){
		//using cachefile
		$html_result = file_get_contents($cachefile);
	}else {
		//start new connection
		$html_result = http_load( $url, null, null, $manheim_login,$post );
		$handle = fopen($cachefile, 'w');
		fwrite($handle,$html_result);
		fclose($handle);
	}
#------------/cache--------------------------------------------------------
$html['make']=parse_element( $html_result, "#<select name=\"make\"[^>]*>(.*)</select>#sU", "/<option value=\"([^\"]+)\"[^>]*>([^<]+)<\/option>/");
$hiddens_info = html_search_all( "#<input type=\"hidden\" name=\"([^\"]+)\" value=\"([^\"]*)\">#", $html_result );
for ($i = 0; $i < sizeof( $hiddens_info ); ++$i )
{
    $html['hiddens'][$hiddens_info[$i][1]] = $hiddens_info[$i][2];   
} 
unset($html['hiddens']['vehicleTypes']);
$html['make'][0][2] = translate( $html['make'][0][2], $lang['main']['all'] );

$smarty->assign('hiddens', $html['hiddens']);
$smarty->assign('make',$html['make']);
$smarty->assign('sid','ZzZ');
?>