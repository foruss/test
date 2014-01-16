<?php
$step = $_GET['step'];

if ($step =='') {
echo('<h1>Edit Vehicle Make</h1>');
echo('<div align="center"><a href="?psl=app&do=add-make&step=new">Edit Vehicle Make</a><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1">');
echo('<tr>
		<td height="23" bgcolor="#f5f5f5" align="center" width="200">Make</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="150">Manage</td>
	</tr>'); 

$get_itz=mysql_query("Select * from `marke` order by `name` asc");
while($zo=mysql_fetch_array($get_itz)) {
$id = $zo['id'];
$name = $zo['name'];

echo('<tr onmouseover="style.backgroundColor=\'#F8F8F8\'" onmouseout="style.backgroundColor=\'\'">
		<td height="22" align="left" width="200">&nbsp;&nbsp;<a href="?psl=app&do=add-make&step=models&mid='.$id.'">'.$name.'</a></td>
		<td height="22" align="center" width="150" style="font-size: 8pt"><a href="?psl=app&do=add-make&step=edit&id='.$id.'">Edit</a> | <a onClick="if(confirm(\'Are you sir you like to delete this Make?\')); else return false;" href="?psl=app&do=add-make&step=delete&id='.$id.'">Delete</a></td>
	</tr>');

}

echo('</table></div>');

} else if ($step == 'new') {
if (!isset($_POST['submit'])) {
echo('<h1>Editing Vehicle Make</h1>');
echo('<div align="center"><form method="Post" action="?psl=app&do=add-make&step=new"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1"><tr>
		<td height="23" align="center" width="100">Маke</td>
		<td height="23" align="center" width="250"><input type="text" name="marke" style="width: 230px"></td>
	</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save New Make"></td></tr>
	</table></form></div>');
} else {
$marke = $_POST['marke'];
$url = str_replace(" ", "-", $marke);
$insetz=mysql_query("Insert into `marke` set `name`='$marke', `url`='$url'");
   echo('<script type="text/javascript">window.location = "/app/add-make/inserted.msg"</script>'); 
}
} else if ($step == 'edit') {
if (!isset($_POST['submit'])) {
echo('<h1>Edit Info</h1>');
$id = $_GET['id'];
$zzd=mysql_query("Select * from `marke` where `id`='$id'");
$marke = $zzd['name'];
echo('<div align="center"><form method="Post" action="?psl=app&do=add-make&step=edit&id='.$id.'"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1"><tr>
		<td height="23" align="center" width="100">Маke</td>
		<td height="23" align="center" width="250"><input type="text" name="marke" value="'.$marke.'" style="width: 230px"></td>
	</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save"></td></tr>
	</table></form></div>');
} else {
$marke = $_POST['marke'];
$url = str_replace(" ", "-", $marke);
$id = $_GET['id'];
$insetz=mysql_query("Update `marke` set `name`='$marke', `url`='$url' where `id`='$id'");
   echo('<script type="text/javascript">window.location = "/app/add-make/updated.msg"</script>'); 
}
} else if ($step == 'delete') {
$id = $_GET['id'];
$delasz=mysql_query("Delete from `marke` where `id`='$id'");
   echo('<script type="text/javascript">window.location = "/app/add-make/deleted.msg"</script>'); 
} else if ($step == 'models') {
$next = $_GET['next'];

if ($next == '') {
$mid = $_GET['mid'];
$imk_z=mysql_query("Select * from `marke` where `id`='$mid'");
$mzz=mysql_fetch_array($imk_z);
$marke = $mzz['name'];
echo('<h1>Edit Make ('.$marke.')</h1>');
$get_modeliai=mysql_query("Select * from `modelis` where `mid`='$mid' order by `name` asc");


echo('<div align="center"><a href="?psl=app&do=add-make&step=models&next=new&mid='.$mid.'">Edit Vehicle Make</a><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1">');
echo('<tr>
		<td height="23" bgcolor="#f5f5f5" align="center" width="200">Мake</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="150">Manage</td>
	</tr>'); 

while($zzo=mysql_fetch_array($get_modeliai)) {
$name = $zzo['name'];
$id = $zzo['id'];

echo('<tr onmouseover="style.backgroundColor=\'#F8F8F8\'" onmouseout="style.backgroundColor=\'\'">
		<td height="22" align="left" width="200">&nbsp;&nbsp;'.$name.'</td>
		<td height="22" align="center" width="150" style="font-size: 8pt"><a href="?psl=app&do=add-make&step=models&next=edit&id='.$id.'&mid='.$mid.'">Edit</a> | <a onClick="if(confirm(\'Are you sir you like to delete this Model?\')); else return false;" href="?psl=app&do=add-make&step=models&next=delete&id='.$id.'&mid='.$mid.'">Delete</a></td>
	</tr>');
}


echo('</table></div>');

} else if ($next == 'new') {
if (!isset($_POST['submit'])) {
echo('<h1>Edit Model</h1>');
$mid = $_GET['mid'];
echo('<div align="center"><form method="Post" action="?psl=app&do=add-make&step=models&next=new"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1"><tr>
		<td height="23" align="center" width="100">Маke</td>
		<td height="23" align="center" width="250"><select size="1" name="marke" style="width: 230px">');
$get_markes=mysql_query("Select * from `marke` order by `name` asc") or die(mysql_error());
while($zr=mysql_fetch_array($get_markes)) {
$marke = $zr['name'];
$ma_id = $zr['id'];
echo('<option value="'.$ma_id.'" '); if ($ma_id == $mid) { echo " selected "; } else { } echo('>'.$marke.'</option>');
}
echo('</select></td>
	</tr><tr>
		<td height="23" align="center" width="100">Моdel</td>
		<td height="23" align="center" width="250"><input type="text" name="modelis" style="width: 230px"></td>
	</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save"></td></tr>
	</table></form></div>');
} else {
$marke = $_POST['marke'];
$modelis = $_POST['modelis'];
$url = str_replace(" ", "-", $modelis);
$insetz=mysql_query("Insert into `modelis` set `name`='$modelis', `url`='$url', `mid`='$marke'");
   echo('<script type="text/javascript">window.location = "?psl=app&do=add-make&step=models&mid='.$marke.'&msg=ok"</script>'); 
}
} else if ($next == 'edit') {
if (!isset($_POST['submit'])) {
echo('<h1>Edit Model</h1>');

$id = $_GET['id'];
$get_itz=mysql_query("Select * from `modelis` where `id`='$id'");
$otzz=mysql_fetch_array($get_itz);
$mid = $otzz['mid'];
$modelis = $otzz['name'];
echo('<div align="center"><form method="Post" action="?psl=app&do=add-make&step=models&next=edit&id='.$id.'"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1"><tr>
		<td height="23" align="center" width="100">Маke</td>
		<td height="23" align="center" width="250"><select size="1" name="marke" style="width: 230px">');
$get_markes=mysql_query("Select * from `marke` order by `name` asc") or die(mysql_error());
while($zr=mysql_fetch_array($get_markes)) {
$marke = $zr['name'];
$ma_id = $zr['id'];
echo('<option value="'.$ma_id.'" '); if ($ma_id == $mid) { echo " selected "; } else { } echo('>'.$marke.'</option>');
}
echo('</select></td>
	</tr><tr>
		<td height="23" align="center" width="100">Моdel</td>
		<td height="23" align="center" width="250"><input type="text" value="'.$modelis.'" name="modelis" style="width: 230px"></td>
	</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save"></td></tr>
	</table></form></div>');
} else {
$marke = $_POST['marke'];
$modelis = $_POST['modelis'];
$url = str_replace(" ", "-", $modelis);
$id = $_GET['id'];
$insetz=mysql_query("Update `modelis` set `name`='$modelis', `url`='$url', `mid`='$marke' where `id`='$id'");
   echo('<script type="text/javascript">window.location = "?psl=app&do=add-make&step=models&mid='.$marke.'&msg=ok"</script>'); 
}
} else if ($next == 'delete') {
$id = $_GET['id'];
$mid = $_GET['mid'];
$delas=mysql_query("Delete from `modelis` where `id`='$id'");
echo('<script type="text/javascript">window.location = "?psl=app&do=add-make&step=models&mid='.$mid.'&msg=ok"</script>'); 
}


}

?>
