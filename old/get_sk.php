<?
include('web.php');
mysqlconnect();
header("Content-type: text/javascript");
$it = mysql_query('SET NAMES utf8'); 
$et = mysql_query('SET CHARACTER SET urf8');
?>
with(document.getElementById('skkk')) {
<?
$sritis = $_GET['in'];
$sube = mysql_query("Select * from `d_sub` where `mid`='$sritis' order by `name` asc");
while($su=mysql_fetch_array($sube)) {
$name = $su['name'];
$url = $su['id'];

echo("options.add(new Option('$name', '$url'));\n");

}

mysqldisconnect();

//options.add(new Option('- Kita -', '00'));
?>
disabled = length <= 1;

}
