<?php
include_once("config.php");

$get_str = "";
if ( 0 < sizeof( $_GET ) )
{
    $get_array = $_GET;
    $get_str = "?";
    foreach ( $get_array as $key => $value )
    {   
    		$get_str .= $key."=".urlencode( $value )."&";
    }
    $get_str = rtrim( $get_str, "&" );
}

$xml = false;

$url = "http://www.cars.com/go/search/mmy.jsp".$get_str;
//header( "Pragma: no-cache" );
//header( "Cache-Control: no-store" );
//if ( $xml )
//{
//    header( "Content-Type: text/xml;charset=windows-1251" );
//}
//else
//{
//    header( "Content-Type: text/json;charset=windows-1251" );
//}
$html_result = http_load( $url, $url,null,null, null, null, null, null, 0 );
$html_result = preg_replace( "#\"label\": \"ALL\"#", "\"label\": \"Все\"", $html_result );
echo $html_result;
exit( );
?>
