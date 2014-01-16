<?php 

function http_load_calc( $url, $referer = null, $cookies = array( ), $login = array( ), $post_fields = array( ), $session_save = true, $cookie_name = "cookies", $user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)", $header = 0, $follow_location = 0,$megamode=0)
{
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
    if ( !empty( $login ) )
    {
        curl_setopt( $ch, CURLOPT_USERPWD, $login['user'].":".$login['password'] );
    }

    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, $follow_location );
    $result = curl_exec( $ch );
    curl_close( $ch );
    return $result;
}
function html_search_calc( $pattern, $subject )
{
    preg_match( $pattern, $subject, $matches );
    return $matches;
}

function getLocationId($auctionId) {
	//
	$url = 'http://www.bidux.com/transport/informer3/lang/ru-utf-8/bgcolor/f4f4f4/';
	$post['facilityName'] = '0';
	$post['auctionId'] = $auctionId;
	$post['locationId'] = '';
	$post['countryId'] = 'BY';
	$post['portId'] = '0';
	$html_result = http_load_calc($url,$url,null, null, $post);
	$pattern = '#<select[^<>]*name="locationId"[^<>]*>(.*?)</select>#is';
	$tmp = html_search_calc($pattern,$html_result);
	$options = isset($tmp[1])?$tmp[1]:'<option value="">--- Выбрать ---</option>';
	return 	$options;
}
function getCostUSA($auctionId,$locationId){
	//returns:	XX USD
	$url = 'http://www.bidux.com/transport/informer3/lang/ru-utf-8/bgcolor/f4f4f4/';
	$post['facilityName'] = '0';
	$post['auctionId'] = $auctionId;
	$post['locationId'] = $locationId;
	$post['countryId'] = 'BY';
	$post['portId'] = '0';
	$html_result = http_load_calc($url,$url,null, null, $post);
	$pattern = '#США:</b>\s*<span\s*class="price"\s*>([^<>]*)</span#is';
	$tmp = html_search_calc($pattern,$html_result);
	$dollars = isset($tmp[1])?$tmp[1]:'';
	return 	$dollars;	
}
function getPortId($countryId){
		//
	$url = 'http://www.bidux.com/transport/informer3/lang/ru-utf-8/bgcolor/f4f4f4/';
	$post['facilityName'] = '0';
	$post['auctionId'] = 'E21CB77D3463754700257346005804C7';
	$post['locationId'] = '6B17CAA8A7D1228700257474004B64BA';
	$post['countryId'] = $countryId;
	$post['portId'] = '0';
	$html_result = http_load_calc($url,$url,null, null, $post);
	$pattern = '#<select[^<>]*name="portId"[^<>]*>(.*?)</select>#is';
	$tmp = html_search_calc($pattern,$html_result);
	$options = isset($tmp[1])?$tmp[1]:'<option value="0">--- Выберите порт ---</option>';
	return 	$options;
}
function getCostSea($countryId,$portId){
	//returns:	XX USD
	$url = 'http://www.bidux.com/transport/informer3/lang/ru-utf-8/bgcolor/f4f4f4/';
	$post['facilityName'] = '0';
	$post['auctionId'] = 'E21CB77D3463754700257346005804C7';
	$post['locationId'] = '6B17CAA8A7D1228700257474004B64BA';
	$post['countryId'] = $countryId;
	$post['portId'] = $portId;
	$html_result = http_load_calc($url,$url,null, null, $post);
	$pattern = '#морю:</b>\s*<span\s*class="price"\s*>([^<>]*)</span#i';
	$tmp = html_search_calc($pattern,$html_result);
	$dollars = isset($tmp[1])?$tmp[1]:'';
	return 	$dollars;	
}





?>