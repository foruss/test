<?php
$do = $_GET['do'];

if ($do == 'cars') {
$kateg = '0';
include('cars_list.php');
} else if ($do == 'wrecked-cars') {
$kateg='1';
include('cars_list.php');
} else if ($do == 'moto') {
$kateg = '0';
include('moto_list.php');
} else if ($do == 'wrecked-moto') {
$kateg = '1';
include('moto_list.php');
} else if ($do == 'boats') {
$kateg = '0';
include('boat_list.php');
} else if ($do == 'wrecked-boats') {
$kateg = '1';
include('boat_list.php');
} else if ($do == 'planes') {
include('planes_list.php');
} else if ($do == 'machinery') {
$kateg = '0';
include('machinery_list.php');
} else if ($do == 'wrecked-machinery') {
$kateg = '1';
include('machinery_list.php');
} else if ($do == 'spares') {
$kateg ='0';
include('spares_list.php');
} else if ($do == 'used-spares') {
$kateg ='1';
include('spares_list.php');
} else if ($do == 'products') {
include('products_list.php');
}


?>

