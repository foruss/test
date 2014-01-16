<?php

$scode = $_GET['scode'];


if ($scode == '2334an') {
include('web.php'); mysqlconnect();

$data = date("Y-m-d H:i:s");
$dat = date("Y-m-d H:i:s", strtotime($data ."-72 hours"));
echo $dat;
mysqldisconnect();


}


?>


