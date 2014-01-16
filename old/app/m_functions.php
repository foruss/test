<?php

		global $cookie_array;
		$cookie_array = array();
function db_connect( )
{
    $result = mysql_connect( DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, true );
    if ( $result )
    {
        return false;
    }
    if ( mysql_select_db( DB_DATABASE ) )
    {
        return false;
    }
    return $result;
}

function get_date( $formt = "", $date )
{
    if ( preg_match( "#\\d+#", $date ) )
    {
        $date = trim( $date );
        return date( $formt, @strtotime( $date ) );
    }
    return $date;
}

function html_search_all( $pattern, $subject )
{
	$matches = array();
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
function html_search_clear( &$array )
{
    if ( isset( $array[0][0] ) )
    {
        unset( $array[0] );
    }
    else
    {
        $n = sizeof( $array );
        $i = 0;
        for ( ; $i < $n; ++$i )
        {
            unset( $array[$i][0] );
        }
    }
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

function found_cookie( $html )
{
    $cookie_found = html_search_all( "#Set-Cookie: ([^\\r\\n]+)#", $html );
    $cookie = array( );
    $i = 0;
    for ( ; $i < sizeof( $cookie_found ); ++$i )
    {
        $cookie[] = $cookie_found[$i][1];
    }
    return $cookie;
}

function get_cookie( $cooke_file )
{
    $file_content = file_get_contents( $cooke_file );
    touch( $cooke_file, time( ) );
    return unserialize( $file_content );
}

function save_cookie( $cooke_file, $cookies )
{
    $fp = fopen( $cooke_file, "w+" );
    fwrite( $fp, serialize( $cookies ) );
    fclose( $fp );
    return true;
}

function get_main_cookie( )
{
    $cooke_file = "main_cookie.txt";
    if ( file_exists( $cooke_file ) && time( ) < filemtime( $cooke_file ) + 3600 )
    {
        $main_cookies = get_cookie( $cooke_file );
        return $main_cookies;
    }
    $html_result = get_main_html( );
    $main_cookies = found_cookie( $html_result );
    save_cookie( "main_cookie.txt", $main_cookies );
    return $main_cookies;
}

function get_main_html( )
{
    global $iaai_config;
    global $login_cookies;
    global $main_cookies;
    $login_cookies = iaai_login( );
    $html_result = http_get( "https://www.iaai-bid.com/aucsearchbyveh.aspx", null, $login_cookies );
    $main_cookies = found_cookie( $html_result );
    save_cookie( "main_cookie.txt", $main_cookies );
    return $html_result;
}

function iaai_login( $new_session = false )
{
    global $iaai_config;
    $login = $iaai_config['login'];
    $password = $iaai_config['password'];
    $cooke_file = "cookie.txt";
    if ( file_exists( $cooke_file ) && time( ) < filemtime( $cooke_file ) + 3600 && $new_session == false )
    {
        echo "file";
        $file_content = file_get_contents( $cooke_file );
        touch( $cooke_file, time( ) );
        return unserialize( $file_content );
    }
    echo "load";
    $ch = curl_init( );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_URL, "https://www.iaai-bid.com/login.aspx?ReturnUrl=%2faucsearchbyveh.aspx&suppress=true" );
    curl_setopt( $ch, CURLOPT_HEADER, 1 );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
    curl_setopt( $ch, CURLOPT_TIMEOUT, 20 );
    $html = curl_exec( $ch );
    curl_close( $ch );
    $basic_cookies = found_cookie( $html );
    $input_found = html_search( "#<input type=\"hidden\" name=\"__VIEWSTATE\" value=\"([^\"]+)\" />#", $html );
    $input = $input_found[1];
    $post = array( );
    $post['__VIEWSTATE'] = urlencode( $input );
    $post['username'] = $login;
    $post['password'] = $password;
    $post['login'] = "Login";
    $post['ReturnUrl'] = urlencode( "/default.aspx" );
    $post['suppress'] = "true";
    $ch = curl_init( );
    curl_setopt( $ch, CURLOPT_URL, "https://www.iaai-bid.com/login.aspx?ReturnUrl=%2faucsearchbyveh.aspx&suppress=true" );
    $post_string = "";
    foreach ( $post as $key => $value )
    {
        $post_string .= $key."=".$value."&";
    }
    curl_setopt( $ch, CURLOPT_POST, 1 );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_string );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT'] );
    curl_setopt( $ch, CURLOPT_URL, "https://www.iaai-bid.com/login.aspx?ReturnUrl=%2faucsearchbyveh.aspx&suppress=true" );
    curl_setopt( $ch, CURLOPT_HEADER, 1 );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
    curl_setopt( $ch, CURLOPT_TIMEOUT, 20 );
    $c = 0;
    for ( ; $c < sizeof( $basic_cookies ); ++$c )
    {
        curl_setopt( $ch, CURLOPT_COOKIE, $basic_cookies[$c] );
    }
    curl_setopt( $ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0 );
    $html = curl_exec( $ch );
    curl_close( $ch );
    $cookies = found_cookie( $html );
    $fp = fopen( $cooke_file, "w+" );
    fwrite( $fp, serialize( array_merge( $basic_cookies, $cookies ) ) );
    fclose( $fp );
    return $cookies;
}

function login( )
{
    global $iaai_config;
    unset( $_SESSION['cookies'] );
    $html_result = http_get( "https://www.iaai-bid.com/login.aspx" );
    $viewstate_found = html_search( "#<input type=\"hidden\" name=\"__VIEWSTATE\" value=\"([^\"]+)\" />#", $html_result );
    $viewstate = $viewstate_found[1];
    $post = "";
    $post .= "__VIEWSTATE=".urlencode( $viewstate );
    $post .= "&username=".urlencode( $iaai_config['login'] );
    $post .= "&password=".urlencode( $iaai_config['password'] );
    $post .= "&login=Login";
    $html_result = http_get( "https://www.iaai-bid.com/login.aspx", null, null, null, $post );
    parse_cookies( $html_result );
    return true;
}

function http_load( $url, $referer = null, $cookies = array( ), $login = array( ), $post_fields = array( ), $session_save = true, $cookie_name = "cookies", $user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)", $header = 1, $follow_location = 0,$megamode=0)
{
	global $gebug_post;
    $http_header = array( );
    $http_header[] = "Accept-Language: ru";
    $http_header[] = "Connection: close";
    $http_header[] = "Cache-Control: no-cache";
    $http_header[] = "Pragma: no-cache";
    if ($megamode=='price'){
    	
    	$http_header[] = "Host: www.manheim.com";
    	$http_header[] = "X-Requested-With: XMLHttpRequest";
    	$http_header[] = "X-Prototype-Version: 1.6.0.1";
    	$http_header[] = "Accept: text/javascript, text/html, application/xml, text/xml, */*";
    	//print_r($http_header);
    }
    
    
    
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
   //print 'DEBUG_post='.$post_string."<br/>";
   // print 'DEBUG_cook='.$all_cookies."<br/>";
    return $result;
}

function parse_image( $url )
{
    if ( preg_match( "#^(?:http:|)//mmsci.manheim.com/activeImg/([^$]+)#", $url, $match ) )
    {
        $type = 1;
        $name = urldecode( $match[1] );
    }
    else if ( preg_match( "#^(?:https:|)//mmsci.manheim.com/dealertools/admanager/([^$]+)#", $url, $match ) )
    {
        $type = 2;
        $name = urldecode( $match[1] );
    }
    else if ( preg_match( "#no-image.gif$#", $url ) )
    {
        $type = 0;
        $name = "no";
    }
    return array( "type" => $type, "name" => $name );
}

function lang_translate( $key, $lang )
{
    $key = trim( $key );
    if ( isset( $lang[$key] ) )
    {
        return $lang[$key];
    }
    return $key;
}

function print_price( $html )
{
    $price = "";
    $html = trim( $html );
    if ( preg_match( "#[0-9]+#", $html ) )
    {
        preg_match( "#([\\d\\s,]+)#", $html, $match );
        $price = trim( $match[1] );
        $price = preg_replace( "#[,\\s]+#", "", $price );
        $price = "\$".number_format( $price );
        return $price;
    }
    return $html;
}

function translate_array( $array, $key, $lang, $lang_dynamic = array( ) )
{
	if (!isset($array)) return false;
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

function html_decode( $string )
{
    return strtr( $string, array_flip( get_html_translation_table( HTML_ENTITIES, ENT_QUOTES ) ) );
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

function damage_translate( $damage )
{
    global $lang_damage_type;
    global $lang_damage;
    $return_string = "";
    $damage = preg_replace( "#\\s+#", " ", $damage );
    $damage = trim( $damage );
    if ( preg_match( "#([^:]+):([^$]+)#", $damage, $found_damage ) )
    {
        $damage_type = $found_damage[1];
        $damage = $found_damage[2];
        if ( isset( $lang_damage_type[$damage_type] ) )
        {
            $damage_type_return = $lang_damage_type[$damage_type];
        }
        else
        {
            $damage_type_return = $damage_type;
        }
        $return_string = $damage_type_return.": ";
    }
    if ( ereg( ",", $damage ) )
    {
        $damage_array = explode( ",", $damage );
    }
    else
    {
        $damage_array = explode( "/", $damage );
    }
    $damage_return = array( );
    foreach ( $damage_array as $damage_value )
    {
        $damage_value = trim( $damage_value );
        if ( isset( $lang_damage[$damage_value] ) )
        {
            $damage_return[] = $lang_damage[$damage_value];
        }
        else
        {
            $damage_return[] = $damage_value;
        }
    }
    $damage_return_string = trim( implode( " / ", $damage_return ), " / " );
    $return_string .= $damage_return_string;
    return $return_string;
}

function translate_date( $auction_date )
{
    $date_month[] = "";
    $date_month[] = "������";
    $date_month[] = "�������";
    $date_month[] = "�����";
    $date_month[] = "������";
    $date_month[] = "���";
    $date_month[] = "����";
    $date_month[] = "����";
    $date_month[] = "�������";
    $date_month[] = "��������";
    $date_month[] = "�������";
    $date_month[] = "������";
    $date_month[] = "�������";
    if ( preg_match( "#(\\w+)\\s+(\\d+)\\s+(\\d+)\\s+(\\d+):(\\d+)(\\w+)#", $auction_date, $found ) )
    {
        $time_string = $found[2]." ".$found[1]." ".$found[3]." ".$found[4].":".$found[5].$found[6];
        $auction_time = strtotime( $time_string );
        $auction_date = date( "j", $auction_time )." ".$date_month[date( "n", $auction_time )]." ".date( "Y", $auction_time ).", ".date( "H:i", $auction_time );
        return $auction_date;
    }
    if ( preg_match( "#(\\d+)/(\\d+)/(\\d+) (\\d{1,2})(\\d{2})(\\d{2}) (\\w{2}) (\\w+)#", $auction_date, $found ) )
    {
        $time_string = $found[3]."-".$found[1]."-".$found[2]." ".$found[4].":".$found[5].":".$found[6].$found[7];
        $auction_time = strtotime( $time_string );
        $auction_date = date( "j", $auction_time )." ".$date_month[date( "n", $auction_time )]." ".date( "Y", $auction_time ).", ".date( "H:i:s", $auction_time );
        return $auction_date;
    }
    if ( preg_match( "#(\\d+)/(\\d+)/(\\d+) (\\d{1,2})(\\d{2})(\\w{2}) (\\w+)#", $auction_date, $found ) )
    {
        $time_string = $found[3]."-".$found[1]."-".$found[2]." ".$found[4].":".$found[5].$found[6];
        $auction_time = strtotime( $time_string );
        $auction_date = date( "j", $auction_time )." ".$date_month[date( "n", $auction_time )]." ".date( "Y", $auction_time ).", ".date( "H:i", $auction_time );
    }
    return $auction_date;
}

function to_upper( $content )
{
    $content = strtr( $content, "��������������������������������", "�����Ũ�������H������������������" );
    return strtoupper( $content );
}

function to_upper_ferst( $str )
{
    $str1 = to_upper( substr( $str, 0, 1 ) );
    $str2 = substr( $str, 1 );
    return $str1.$str2;
}








function load_img($type,$img )
{
	if (!isset($img)){$type=0;$img='';};
	if (!isset($type)){$type=0;$img='';};
switch ($type){
	case 1:
	$image="http://mmsci.manheim.com/activeImg/".$img;break;
	case 2:
	$image="http://mmsci.manheim.com/dealertools/admanager/".$img;break;
	default:
		$image="images/no-image.gif"; }
    return $image;
}

function load_price($var1,$var2,$var3 )
{
 
$linkParams = 'mid='.$var1.'&vin='.$var2.'&mileage='.$var3;
$url = 'https://www.manheim.com/members/powersearch/getMMRPrices.do';#?'.$linkParams;
$post = 'mid='.$var1.'&vin='.$var2.'&mileage='.$var3;

$ANSWER=  http_load($url , 'https://www.manheim.com/members/powersearch/searchSubmit.do', $_SESSION['cookies'], $manheim_login,$post,
true,'cookies', "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)",1,0,'price');


//$GET = "GET https://www.manheim.com/members/powersearch/getMMRPrices.do HTTP/1.0
//User-Agent: Opera/9.0 (Windows NT 5.1; U; en)
//Host: www.copart.com
//Accept: text/html, application/xml;q=0.9, application/xhtml+xml, image/png, image/jpeg, image/gif, image/x-xbitmap, */*;q=0.1
//Accept-Language: ru,en;q=0.9
//Accept-Encoding: deflate, gzip, x-gzip, identity, *;q=0
//POSTDATA=".$post."
//";
//
//$sock = @fsockopen("manheim.com", 443, $errno, $errstr, 30);
//$ANSWER='';
//	if($sock) {
//		fputs($sock, "$GET\n\n");
//		while(!feof($sock))
//			$ANSWER .= fgets($sock,64);
//		fclose($sock);
//	} else {
//		$ANSWER = "<b>Sock error: powersearch2.manheim.com !</b>";}
		
		
		$pattern = "#HTTP.*\{#s";		
	$ANSWER = preg_replace($pattern,'{',$ANSWER );	
	print '<pre>'.$ANSWER.'</pre>';
return $ANSWER;
}











?>
