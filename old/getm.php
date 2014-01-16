<?
include('web.php');
mysqlconnect();
header("Content-type: text/javascript");
$it = mysql_query('SET NAMES utf8'); 
$et = mysql_query('SET CHARACTER SET urf8');
?>
with(document.getElementById('model')) {
<?
$sritis = $_GET['in'];
$sube = mysql_query("Select * from `modelis` where `mid`='$sritis' order by `name` asc");
while($su=mysql_fetch_array($sube)) {
$name = $su['name'];
$url = $su['id'];

?>options.add(new Option("<?php  echo $name; ?>", "<?php  echo $url; ?>"));<?php

}

mysqldisconnect();

//options.add(new Option('- Kita -', '00'));
?>
disabled = length <= 1;

}
