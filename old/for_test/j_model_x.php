<?
	ini_set('display_errors', true);
//	include_once("modules/functions.php");
	$m = isset($_REQUEST['selectedMake'])?$_REQUEST['selectedMake']:'';
	$url = 'http://www.copart.com/c2/model.ajax?selectedMake=' . $m;
     


$add_headers = array();
$add_headers[]='User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.0.5) Gecko/2008120122 Firefox/3.0.5';
$add_headers[]='Accept: text/javascript, text/html, application/xml, text/xml, */*';
$add_headers[]='Accept-Language: ru,en-us;q=0.7,en;q=0.3';
$add_headers[]='Accept-Charset: windows-1251,utf-8;q=0.7,*;q=0.7';
$add_headers[]='Keep-Alive: 300';
$add_headers[]='Connection: keep-alive';
$add_headers[]='X-Requested-With: XMLHttpRequest';
$add_headers[]='X-Prototype-Version: 1.5.0';
$add_headers[]='Referer: http://www.copart.com/c2/home.html';
;

	$body = http_load_cop($url, 'http://copart.com/c2/home.html' ,null,null, null, true, null, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.0.5) Gecko/2008120122 Firefox/3.0.5', 1,0,$add_headers);
  
	$body = str_replace('All Models','Bce модели',$body);
	
	echo $body;
    echo '...+';

    function http_load_cop( $url, $referer = null, $cookies = array( ), $login = array( ), $post_fields = array( ), $session_save = true, $cookie_name = "cookies", $user_agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.0.5) Gecko/2008120122 Firefox/3.0.5", $header = 1, $follow_location = 0 ,$addheaders = array()){
	$headers  = array(
	"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
	"Accept-Language: ru,en-us;q=0.7,en;q=0.3",
	"Accept-Charset: windows-1251,utf-8;q=0.7,*;q=0.7",
//	"Accept-Encoding: gzip,deflate",
	"Connection: keep-alive",
	"Keep-Alive: 300"
	);
     if (!empty($addheaders)) $headers = $addheaders;
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
    curl_setopt( $ch, CURLOPT_HEADER, 0 );
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
	?>