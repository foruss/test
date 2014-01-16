<?php
/**
 * Created by IntelliJ IDEA.
 * User: Zoooom
 * Date: 13.10.2009
 * Time: 19:20:44
 * To change this template use File | Settings | File Templates.
 */
       include_once("config.php");



       $post = '';
       foreach ($_POST as $k=>$v){

           $post .= '&'.$k."=".urlencode($v);
       }
       $post = trim($post,'&');


       $url =  "http://www.cars.com/for-sale/GetModelData.action?loc=en&classic=N&".$post;
       #$url =  "http://www.cars.com/for-sale/GetMakeData.action?loc=en&classic=N&".$post;

       //echo "url=".  $url;
       $body = http_load( $url, $url,null,null, null, null, null, null, 0 );

       $body = preg_replace('#{[^{}]*\'All\sM[^{}]*},#is','',$body);

echo $body;