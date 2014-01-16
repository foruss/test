<?php 

$step = $_GET['step'];

if ($step == '') {
echo('<h1>Список разделов</h1>');
echo('<div align="center" style="margin: 10px 0 0 0"><a href="?psl=app&do=categories&step=new">Добавить раздел</a><br><table border="1" width="500" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#E1E1E1">');
echo('<tr>
		<td height="23" bgcolor="#f5f5f5" align="center" width="120">Изображение</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="200">Название</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="180">Управление</td>
	</tr>');
$get_imgz=mysql_query("Select * from `sand_cat` order by `ru` asc");
while($gz=mysql_fetch_array($get_imgz)) {
$on = $gz['on'];
$id = $gz['id'];
$ru = stripslashes($gz['ru']);
$img = $gz['img'];

}
echo('</table></div>');
} else if ($step == 'new')  {
if (!isset($_POST['submit'])) {
echo('<h1>Добавить раздел</h1>');
echo('<div align="center"></div>');
} else {

}
} else if ($step == 'edit') {

} else if ($step == 'delete') {

} else if ($step == 'ch') {

}
?>