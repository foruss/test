<?php

function parse_cookies2( $html, $cookie_name = "cookies" )
{
	
    $cookie_found = html_search_all( "#Set-Cookie: ([^=]+)=([^;\\n\\r]+)#", $html );
    $cookie = array( );
    $i = 0;
    for ( ; $i < sizeof( $cookie_found ); ++$i )
    {
    	
        $_SESSION[$cookie_name][$cookie_found[$i][1]] = $cookie_found[$i][2];
    }
}	
function http_load2( $url, $referer = null, $cookies = array( ), $login = array( ), $post_fields = array( ), $session_save = true, $cookie_name = "cookies", $user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)", $header = 1, $follow_location = 0 )
{
	global $gebug_post;
    $http_header = array( );
    $http_header[] = "Accept-Language: ru";
    $http_header[] = "Connection: close";
    $http_header[] = "Cache-Control: no-cache";
    $http_header[] = "Pragma: no-cache";
    $ch = curl_init( );
    curl_setopt( $ch, CURLOPT_REFERER, isset( $referer ) ? $referer : $url );
    if ( !empty( $post_fields ) )
    {
        if ( is_array( $post_fields ) )
        {
            $post_string = "";
            foreach ( $post_fields as $key => $value )
            {
                if ( is_array( $value ) )
                {
                    foreach ( $value as $value2 )
                    {
                        $post_string .= urlencode( $key )."=".urlencode( $value2 )."&";
                    }
                }
                else
                {
                    $post_string .= urlencode( $key )."=".urlencode( $value )."&";
                }
            }
        }
        else
        {
            $post_string = $post_fields;
        }
       
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_string );
    }
    
    curl_setopt( $ch, CURLOPT_TIMEOUT, 60 );
    curl_setopt( $ch, CURLOPT_VERBOSE, 1 );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_USERAGENT, $user_agent );
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_HEADER, $header );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
    if ( !empty( $_SESSION[$cookie_name] ) && $session_save )
    {
        $all_cookies = "";
        foreach ( $_SESSION[$cookie_name] as $cookie_name => $cookie_value )
        {
            $all_cookies .= urlencode( $cookie_name )."=".urlencode( $cookie_value ).";";
        }
        curl_setopt( $ch, CURLOPT_COOKIE, $all_cookies );
    }
    if ( isset( $login ) )
    {
        curl_setopt( $ch, CURLOPT_USERPWD, $login['user'].":".$login['password'] );
    }
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, $follow_location );
    $result = curl_exec( $ch );
    curl_close( $ch );
    return $result;
} 


//	$vin = '3VWPE69M93M181347';
	$DATA = array();
	$error_results = '';
	if (strlen($vin)===17) {

	
	$preload_url = 'http://www.autocheck.com/?nf=3&nf=4&siteID=0&WT.mc_id=0';
	$preload_html = http_load2($preload_url,null,null,null,null,true,'cookies');
	
	parse_cookies2($preload_html);	
	$url2 = 'http://www.autocheck.com/consumers/vinSearchAction.do';
	$post2['vin'] = $vin;
	$post2['vinSearchButton.x'] = 46;
	$post2['vinSearchButton.y'] = 5;
	$html2 = http_load2($url2,$preload_url,$_SESSION['cookies'],null,$post2,true);
	
	
	if (strpos($html2,'You entered an invalid VIN')!==false)
			{ $error_results = 'INVALID_VIN' ;}
	else {
	
	$url = 'https://www.autocheck.com/consumers/creditCardAction.do?multiButton.y=-1882017271&multiButton.x=-1882017271&siteID=0&vin=' .$vin. '&sslRedirect=noRedirect';
	$html = http_load2($url,'http://www.autocheck.com/consumers/vinSearchAction.do',$_SESSION['cookies'],null,null,true);
 
	 $report_html = html_search('#Vehicle\s*Record\s*Summary(.*?)</table>#s',$html);
	//echo $report_html;
	 $report_html = isset($report_html[1])?$report_html[1]:'';	
	 if ($report_html==='') $error_results = 'NOPARSED'; else {
	 
    $tmp = html_search('#<span\s*id="vin">([^<>]*)<#', $report_html);
    $DATA['vin'] = trim(isset($tmp[1])?$tmp[1]:'');
    $tmp = html_search('#<span\s*id="year">([^<>]*)<#', $report_html);
    $DATA['year'] = trim(isset($tmp[1])?$tmp[1]:'');
    $tmp = html_search('#<span\s*id="body">([^<>]*)<#', $report_html);
    $DATA['stylebody'] = trim(isset($tmp[1])?$tmp[1]:'');
    $tmp = html_search('#<span\s*id="make">([^<>]*)<#', $report_html);
    $DATA['make'] = trim(isset($tmp[1])?$tmp[1]:'');
    $tmp = html_search('#<span\s*id="engine">([^<>]*)<#', $report_html);
    $DATA['engine'] = trim(isset($tmp[1])?$tmp[1]:'');
    $tmp = html_search('#<span\s*id="model">([^<>]*)<#', $report_html);
    $DATA['model'] = trim(isset($tmp[1])?$tmp[1]:'');
    $tmp = html_search('#<span\s*id="country">([^<>]*)<#', $report_html);
    $DATA['country'] = trim(isset($tmp[1])?$tmp[1]:'');
    $tmp = html_search('#<span\s*id="events">([^<>]*)<#', $report_html);
    $DATA['records'] = trim(isset($tmp[1])?$tmp[1]:'');
	} 
	}
	}
	else $error_results = 'INVALID_VIN_LENGTH';
	
	print $error_results;
	
	
	
	
	
	?>
