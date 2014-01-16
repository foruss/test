<?php

$scode = $_GET['scode'];


if ($scode == '2334an') {
include('web.php'); mysqlconnect();

$data = date("Y-m-d H:i:s");
$dat = date("Y-m-d", strtotime($data ."-24 hours"));
$get_sk=mysql_query("Select * from `auto` where `parduota`!='0' and `parduota` like '$dat%'");
while($ox=mysql_fetch_array($get_sk)) {

$sid = $ox['id'];
$get_foto=mysql_query("Select * from `foto` where `type`='1' and `sid`='$sid'");
while($oxx=mysql_fetch_array($get_foto)) {
$url = $oxx['url'];
@unlink("$url");

}

$fdel=mysql_query("Delete from `foto` where `sid`='$sid' and `type`='1'");
$sdel =mysql_query("Delete from `auto` where `id`='$sid'");

}

mysqldisconnect();


}


?>


