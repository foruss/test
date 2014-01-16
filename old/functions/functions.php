<?php

function pd($in,$title=''){ //print_debug
	if (empty($in)){
		print '<pre>'.( empty($title)?'':$title.':').'varable empty</pre>';
		return 0;
	}
	if (is_array($in)){
		print '<pre>'.$title;
		print empty($title)?'':':<br>';
		print_r($in);
		print '</pre>';
		return 0;
	}
	if (is_string($in)){
		print '<pre>'.$in.'</pre>';
		return 0;	
	}

	return 1;
} 
function html_search1( $pattern, $subject )
{
    preg_match( $pattern, $subject, $matches );
    return isset($matches[1])?$matches[1]:'';
}
function html_search2( $pattern, $subject )
{
    preg_match( $pattern, $subject, $matches );
    return isset($matches[2])?$matches[2]:'';
}
function html_search_all( $pattern, $subject )
{
    if ( preg_match_all( $pattern, $subject, $matches, PREG_SET_ORDER ) )
    {
    }
    return $matches;
}
function html_search( $pattern, $subject )
{
    preg_match( $pattern, $subject, $matches );
    return $matches;
}

function http_load( $url, $referer = null, $cookies = array( ), $login = array( ), $post_fields = array( ), $session_save = true, $cookie_name = "cookies", $user_agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.0.5) Gecko/2008120122 Firefox/3.0.5", $header = 1, $follow_location = 0 ,$addheaders = array())
{
	$headers  = array(
	"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
	"Accept-Language: ru,en-us;q=0.7,en;q=0.3",
	"Accept-Charset: windows-1251,utf-8;q=0.7,*;q=0.7",
//	"Accept-Encoding: gzip,deflate",
	"Connection: keep-alive",
	"Keep-Alive: 300"	
	);
     if (!empty($addheaders)) $headers = array_merge($headers,$addheaders);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//    echo '<pre>';
//    print_r($headers);
//    echo '</pre>';    
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
//        echo 'POST(str)='.$post_string.'<br>';
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
            $all_cookies .= urlencode( $cookie_name )."=".urlencode( $cookie_value )."; ";
        }
        curl_setopt( $ch, CURLOPT_COOKIE, $all_cookies );
       // echo '<b>COOKs(str)</b>='.$all_cookies.'<br>';
    }	//else echo '<b>No COOKs</b><br>';
    if ( isset( $login ) )
    {
        curl_setopt( $ch, CURLOPT_USERPWD, $login['user'].":".$login['password'] );
    }
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, $follow_location );
    $result = curl_exec( $ch );
    curl_close( $ch );

    return $result;
}
function http_loadIAAI( $url, $referer = null, $cookies = array( ), $login = array( ), $post_fields = array( ), $session_save = true, $cookie_name = "cookies", $user_agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.0.5) Gecko/2008120122 Firefox/3.0.5", $header = 1, $follow_location = 0 ,$addheaders = array())
{
	$headers  = array(
	"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
	"Accept-Language: ru,en-us;q=0.7,en;q=0.3",
	"Accept-Charset: windows-1251,utf-8;q=0.7,*;q=0.7",
//	"Accept-Encoding: gzip,deflate",
	"Connection: keep-alive",
	"Keep-Alive: 300"	
	);
     if (!empty($addheaders)) $headers = array_merge($headers,$addheaders);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//    echo '<pre>';
//    print_r($headers);
//    echo '</pre>';    
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
//        echo 'POST(str)='.$post_string.'<br>';
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
            $all_cookies .= urlencode( $cookie_name )."=".urlencode( $cookie_value )."; ";
        }
        curl_setopt( $ch, CURLOPT_COOKIE, $all_cookies );
       // echo '<b>COOKs(str)</b>='.$all_cookies.'<br>';
    }	//else echo '<b>No COOKs</b><br>';
    if ( isset( $login ) )
    {
        curl_setopt( $ch, CURLOPT_USERPWD, $login['user'].":".$login['password'] );
    }
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, $follow_location );
    $result = curl_exec( $ch );
    curl_close( $ch );

    return $result;
}
function translate_array( $array, $key, $lang, $lang_dynamic = array( ) )
{
    $array_return = array( );
    foreach ( $array as $k => $v )
    {
        $array_return[$k] = $v;
        if ( isset( $v[$key] ) )
        {
            $array_return[$k][$key] = translate( $v[$key], $lang, $lang_dynamic );
        }
    }
    return $array_return;
}

function translate( $string, $lang_static = null, $lang_dynamic = null )
{
    $string = trim( $string );
    if ( !is_null( $lang_static ) && isset( $lang_static[$string] ) )
    {
        $string = $lang_static[$string];
        return $string;
    }
    if ( !is_null( $lang_dynamic ) && is_array( $lang_dynamic ) )
    {
        foreach ( $lang_dynamic as $value )
        {
            if ( !$value['pattern'] || !$value['replace'] )
            {
                $string = preg_replace( $value['pattern'], $value['replace'], $string );
            }
        }
    }
    return $string;
}
function parse_cookies( $html, $cookie_name = "cookies" )
{
	
    $cookie_found = html_search_all( "#Set-Cookie: ([^=]+)=([^;\\n\\r]+)#", $html );
    $cookie = array( );
    $i = 0;
    for ( ; $i < sizeof( $cookie_found ); ++$i )
    {    	
        $_SESSION[$cookie_name][$cookie_found[$i][1]] = $cookie_found[$i][2];
    }
}
	?>