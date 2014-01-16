<?php

// var_dump($_POST['priv']);

$yp = $_POST['priv'];

print_r($yp);

// echo $yp;

echo('Priv count: '.count($yp).'<br>');

$priv = '';

if (count($yp) != '0') {
while(list($name, $value) = each($yp)) {
$priv .= "$value ";	
 }
 } else {

 }

echo $priv

// header("Location: loged/auto/update.msg");
?>