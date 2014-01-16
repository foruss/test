<?php
$mode=$_GET['mode'];
$nom=$_GET['nom'];

if (file_exists($_GET['mode'].'/'.$nom=$_GET['nom'])) {
readfile($_GET['mode'].'/'.$nom=$_GET['nom']);
}


?>