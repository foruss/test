<?php 

$step = $_GET['step'];
$next = $_GET['next'];
if ($step == '') {
echo('<h1>Database</h1>');
echo('<h2>Vehicles</h2>');
echo('<div align="center" style="padding: 0 0 15px 0; border-bottom: 1px dashed #999999; margin: 0 0 10px 0"><table border="1" width="250" id="table1" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#E1E1E1">
	<tr>
		<td height="25" align="left">&nbsp;&nbsp;<b>Select</b></td>
	</tr>
	<tr>
		<td height="25" align="left">&nbsp;&nbsp;<a href="?psl=app&do=database&step=1">Body Type</a></td>
	</tr>
	<tr>
		<td height="25" align="left">&nbsp;&nbsp;<a href="?psl=app&do=database&step=2">Fuel Type</a></td>
	</tr>
	<tr>
		<td height="25" align="left">&nbsp;&nbsp;<a href="?psl=app&do=database&step=3">Vehicle Options</a></td>
	</tr>
	<tr>
		<td height="25" align="left">&nbsp;&nbsp;<a href="?psl=app&do=database&step=4">Mechanical or Cosmetic Condition Report</a></td>
	</tr>
		<tr>
		<td height="25" align="left">&nbsp;&nbsp;<a href="?psl=app&do=database&step=9">Color Exterior</a></td>
	</tr><tr>
		<td height="25" align="left">&nbsp;&nbsp;<a href="?psl=app&do=database&step=10">Color Interior</a></td>
	</tr><tr>
		<td height="25" align="left">&nbsp;&nbsp;<a href="?psl=app&do=database&step=11">Title Type</a></td>
	</tr>
</table></div>
<h2>Vans/Minivans</h2>
<div align="center" style="padding: 0 0 15px 0; border-bottom: 1px dashed #999999; margin: 0 0 10px 0"><table border="1" width="250" id="table1" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#E1E1E1">
	<tr>
		<td height="25" align="left">&nbsp;&nbsp;<b>Select</b></td>
	</tr>
	<tr>
		<td height="25" align="left">&nbsp;&nbsp;<a href="?psl=app&do=database&step=12">Маke/Model</a></td>
	</tr>
</table></div>

<h2>Motorcycles</h2><div align="center" style="padding: 0 0 15px 0; border-bottom: 1px dashed #999999; margin: 0 0 10px 0"><table border="1" width="250" id="table1" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#E1E1E1">
	<tr>
		<td height="25" align="left">&nbsp;&nbsp;<b>Select</b></td>
	</tr>
	<tr>
		<td height="25" align="left">&nbsp;&nbsp;<a href="?psl=app&do=database&step=5">Mechanical or Cosmetic Condition Report</a></td>
	</tr>
</table></div>
<h2>Parts</h2>
<div align="center" style="padding: 0 0 15px 0; border-bottom: 1px dashed #999999; margin: 0 0 10px 0"><table border="1" width="250" id="table1" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#E1E1E1">
	<tr>
		<td height="25" align="left">&nbsp;&nbsp;<b>Select</b></td>
	</tr>
	<tr>
		<td height="25" align="left">&nbsp;&nbsp;<a href="?psl=app&do=database&step=6">Category</a></td>
	</tr>	<tr>
		<td height="25" align="left">&nbsp;&nbsp;<a href="?psl=app&do=database&step=7">Subcategory</a></td>
	</tr>
</table></div>
<h2>Electronics</h2>
<div align="center" style="padding: 0 0 15px 0; border-bottom: 1px dashed #999999; margin: 0 0 10px 0"><table border="1" width="250" id="table1" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#E1E1E1">
	<tr>
		<td height="25" align="left">&nbsp;&nbsp;<b>Select</b></td>
	</tr>
	<tr>
		<td height="25" align="left">&nbsp;&nbsp;<a href="?psl=app&do=database&step=8">Categories</a></td>
	</tr>
</table></div>
');

} else if ($step == '1') {
if ($next =='') {
echo('<h1>Body Type</h1>
<div align="center"><a href="?psl=app&do=database&step=1&next=new">Add Body Tipe</a><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1">');
echo('<tr>
		<td height="23" bgcolor="#f5f5f5" align="center" width="200">Body Tipes</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="150">Manage</td>
	</tr>'); 

$get_keb=mysql_query("Select * from `la_kebulas` order by `id` asc");
while($roz=mysql_fetch_array($get_keb)) {
$id = $roz['id'];
$name = $roz['ru'];
echo('<tr onmouseover="style.backgroundColor=\'#F8F8F8\'" onmouseout="style.backgroundColor=\'\'">
		<td height="22" align="left" width="200">&nbsp;&nbsp;'.$name.'</td>
		<td height="22" align="center" width="150" style="font-size: 8pt"><a href="?psl=app&do=database&step=1&next=edit&id='.$id.'">Edid</a> | <a onClick="if(confirm(\'Are you sure you want to remove this body type?\')); else return false;" href="?psl=app&do=database&step=1&next=delete&id='.$id.'">Delete</a></td>
	</tr>');
}

echo('</table></div>');
} else if ($next == 'edit') {
if (!isset($_POST['submit'])) {
echo('<h1>Edit Body Tipe</h1>');
$id = $_GET['id'];
$get_inf=mysql_query("Select * from `la_kebulas` where `id`='$id'");
$otz=mysql_fetch_array($get_inf);
$ru = $otz['ru'];
echo('<div align="center"><form method="Post" action="?psl=app&do=database&step=1&next=edit&id='.$id.'"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1"><tr>
		<td height="23" align="center" width="100">Body Type</td>
		<td height="23" align="center" width="250"><input type="text" name="ru" value="'.$ru.'" style="width: 230px"></td>
	</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save"></td></tr>
	</table></form></div>');
} else {
$ru = addslashes($_POST['ru']);
$id = $_GET['id'];
$insert=mysql_query("Update `la_kebulas` set `ru`='$ru' where `id`='$id'");
   echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=1&msg=updated"</script>'); 
}
} else if ($next == 'new') {
if (!isset($_POST['submit'])) {
echo('<h1>Add Body Type</h1>');
echo('<div align="center"><form method="Post" action="?psl=app&do=database&step=1&next=new"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1"><tr>
		<td height="23" align="center" width="100">Body Type</td>
		<td height="23" align="center" width="250"><input type="text" name="ru" style="width: 230px"></td>
	</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save"></td></tr>
	</table></form></div>');
} else {
$ru = addslashes($_POST['ru']);
$insert=mysql_query("Insert into `la_kebulas` set `ru`='$ru'");
echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=1&msg=saved"</script>'); 
}
} else if ($next == 'delete') {
$id = $_GET['id'];
$delas=mysql_query("Delete from `la_kebulas` where `id`='$id'");
echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=1&msg=deleted"</script>'); 
}

} else if ($step == '2') {

if ($next =='') {
echo('<h1>Fuel Type</h1>
<div align="center"><a href="?psl=app&do=database&step=2&next=new">Add Fuel Type</a><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1">');
echo('<tr>
		<td height="23" bgcolor="#f5f5f5" align="center" width="200">Fuel Type</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="150">Manage</td>
	</tr>'); 

$get_keb=mysql_query("Select * from `la_variklis` order by `id` asc");
while($roz=mysql_fetch_array($get_keb)) {
$id = $roz['id'];
$name = $roz['ru'];
echo('<tr onmouseover="style.backgroundColor=\'#F8F8F8\'" onmouseout="style.backgroundColor=\'\'">
		<td height="22" align="left" width="200">&nbsp;&nbsp;'.$name.'</td>
		<td height="22" align="center" width="150" style="font-size: 8pt"><a href="?psl=app&do=database&step=2&next=edit&id='.$id.'">Edit</a> | <a onClick="if(confirm(\'Are you sure you want to remove this fuel type?\')); else return false;" href="?psl=app&do=database&step=2&next=delete&id='.$id.'">Delete</a></td>
	</tr>');
}

echo('</table></div>');
} else if ($next == 'edit') {
if (!isset($_POST['submit'])) {
echo('<h1>Edit Fuel Type</h1>');
$id = $_GET['id'];
$get_inf=mysql_query("Select * from `la_variklis` where `id`='$id'");
$otz=mysql_fetch_array($get_inf);
$ru = $otz['ru'];
echo('<div align="center"><form method="Post" action="?psl=app&do=database&step=2&next=edit&id='.$id.'"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1"><tr>
		<td height="23" align="center" width="100">Fuel Type</td>
		<td height="23" align="center" width="250"><input type="text" name="ru" value="'.$ru.'" style="width: 230px"></td>
	</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save"></td></tr>
	</table></form></div>');
} else {
$ru = addslashes($_POST['ru']);
$id = $_GET['id'];
$insert=mysql_query("Update `la_variklis` set `ru`='$ru' where `id`='$id'");
   echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=2&msg=updated"</script>'); 
}
} else if ($next == 'new') {
if (!isset($_POST['submit'])) {
echo('<h1>Add Fuel Type</h1>');
echo('<div align="center"><form method="Post" action="?psl=app&do=database&step=2&next=new"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1"><tr>
		<td height="23" align="center" width="100">Fuel Type</td>
		<td height="23" align="center" width="250"><input type="text" name="ru" style="width: 230px"></td>
	</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save"></td></tr>
	</table></form></div>');
} else {
$ru = addslashes($_POST['ru']);
$insert=mysql_query("Insert into `la_variklis` set `ru`='$ru'");
echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=2&msg=saved"</script>'); 
}
} else if ($next == 'delete') {
$id = $_GET['id'];
$delas=mysql_query("Delete from `la_variklis` where `id`='$id'");
echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=2&msg=deleted"</script>'); 
}


} else if ($step == '3') {

if ($next =='') {
echo('<h1>Vehicle Options</h1>
<div align="center"><a href="?psl=app&do=database&step=3&next=new">Add Vehicle Option</a><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1">');
echo('<tr>
		<td height="23" bgcolor="#f5f5f5" align="center" width="200">Оptions</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="150">Manage</td>
	</tr>'); 

$get_keb=mysql_query("Select * from `la_priv` order by `id` asc");
while($roz=mysql_fetch_array($get_keb)) {
$id = $roz['id'];
$name = $roz['ru'];
echo('<tr onmouseover="style.backgroundColor=\'#F8F8F8\'" onmouseout="style.backgroundColor=\'\'">
		<td height="22" align="left" width="200">&nbsp;&nbsp;'.$name.'</td>
		<td height="22" align="center" width="150" style="font-size: 8pt"><a href="?psl=app&do=database&step=3&next=edit&id='.$id.'">Edit</a> | <a onClick="if(confirm(\'Are you sure you want to remove this vehicle option?\')); else return false;" href="?psl=app&do=database&step=3&next=delete&id='.$id.'">Delete</a></td>
	</tr>');
}

echo('</table></div>');
} else if ($next == 'edit') {
if (!isset($_POST['submit'])) {
echo('<h1>Edit Option</h1>');
$id = $_GET['id'];
$get_inf=mysql_query("Select * from `la_priv` where `id`='$id'");
$otz=mysql_fetch_array($get_inf);
$ru = $otz['ru'];
echo('<div align="center"><form method="Post" action="?psl=app&do=database&step=3&next=edit&id='.$id.'"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1"><tr>
		<td height="23" align="center" width="100">Option</td>
		<td height="23" align="center" width="250"><input type="text" name="ru" value="'.$ru.'" style="width: 230px"></td>
	</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save"></td></tr>
	</table></form></div>');
} else {
$ru = addslashes($_POST['ru']);
$id = $_GET['id'];
$insert=mysql_query("Update `la_priv` set `ru`='$ru' where `id`='$id'");
   echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=3&msg=updated"</script>'); 
}
} else if ($next == 'new') {
if (!isset($_POST['submit'])) {
echo('<h1>Add Option</h1>');
echo('<div align="center"><form method="Post" action="?psl=app&do=database&step=3&next=new"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1"><tr>
		<td height="23" align="center" width="100">Option</td>
		<td height="23" align="center" width="250"><input type="text" name="ru" style="width: 230px"></td>
	</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save"></td></tr>
	</table></form></div>');
} else {
$ru = addslashes($_POST['ru']);
$insert=mysql_query("Insert into `la_priv` set `ru`='$ru'");
echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=3&msg=saved"</script>'); 
}
} else if ($next == 'delete') {
$id = $_GET['id'];
$delas=mysql_query("Delete from `la_priv` where `id`='$id'");
echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=3&msg=deleted"</script>'); 
}

} else if ($step == '4') {

if ($next =='') {
echo('<h1> Report for Vehicle</h1>
<div align="center"><a href="?psl=app&do=database&step=4&next=new">Add Report</a><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1">');
echo('<tr>
		<td height="23" bgcolor="#f5f5f5" align="center" width="200">Report</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="150">Manage</td>
	</tr>'); 

echo('<tr><td colspan="2" height="23" bgcolor="#f8f8f8">&nbsp;&nbsp;<b>Exterior</b></td></tr>');
$get_keb=mysql_query("Select * from `la_bukle` where `kat`='1' order by `id` asc");
while($roz=mysql_fetch_array($get_keb)) {
$id = $roz['id'];
$name = $roz['ru'];
echo('<tr onmouseover="style.backgroundColor=\'#F8F8F8\'" onmouseout="style.backgroundColor=\'\'">
		<td height="22" align="left" width="200">&nbsp;&nbsp;'.$name.'</td>
		<td height="22" align="center" width="150" style="font-size: 8pt"><a href="?psl=app&do=database&step=4&next=edit&id='.$id.'">Edit</a> | <a onClick="if(confirm(\'Are you sure you want to remove this report?\')); else return false;" href="?psl=app&do=database&step=4&next=delete&id='.$id.'">Delete</a></td>
	</tr>');
}
echo('<tr><td colspan="2" height="23" bgcolor="#f8f8f8">&nbsp;&nbsp;<b>Interior</b></td></tr>');
$get_keb=mysql_query("Select * from `la_bukle` where `kat`='2' order by `id` asc");
while($roz=mysql_fetch_array($get_keb)) {
$id = $roz['id'];
$name = $roz['ru'];
echo('<tr onmouseover="style.backgroundColor=\'#F8F8F8\'" onmouseout="style.backgroundColor=\'\'">
		<td height="22" align="left" width="200">&nbsp;&nbsp;'.$name.'</td>
		<td height="22" align="center" width="150" style="font-size: 8pt"><a href="?psl=app&do=database&step=4&next=edit&id='.$id.'">Edit</a> | <a onClick="if(confirm(\'Are you sure you want to remove this report?\')); else return false;" href="?psl=app&do=database&step=4&next=delete&id='.$id.'">Delete</a></td>
	</tr>');
}
echo('<tr><td colspan="2" height="23" bgcolor="#f8f8f8">&nbsp;&nbsp;<b>Меchanical</b></td></tr>');
$get_keb=mysql_query("Select * from `la_bukle` where `kat`='3' order by `id` asc");
while($roz=mysql_fetch_array($get_keb)) {
$id = $roz['id'];
$name = $roz['ru'];
echo('<tr onmouseover="style.backgroundColor=\'#F8F8F8\'" onmouseout="style.backgroundColor=\'\'">
		<td height="22" align="left" width="200">&nbsp;&nbsp;'.$name.'</td>
		<td height="22" align="center" width="150" style="font-size: 8pt"><a href="?psl=app&do=database&step=4&next=edit&id='.$id.'">Edit</a> | <a onClick="if(confirm(\'Are you sure you want to remove this report?\')); else return false;" href="?psl=app&do=database&step=4&next=delete&id='.$id.'">Delete</a></td>
	</tr>');
}
echo('</table></div>');
} else if ($next == 'edit') {
if (!isset($_POST['submit'])) {
echo('<h1>Edit Report for Vehicle</h1>');
$id = $_GET['id'];
$get_inf=mysql_query("Select * from `la_bukle` where `id`='$id'");
$otz=mysql_fetch_array($get_inf);
$ru = $otz['ru'];
$kat = $otz['kat'];
echo('<div align="center"><form method="Post" action="?psl=app&do=database&step=4&next=edit&id='.$id.'"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1">
<tr>
<td height="23" align="center" width="100">Type of Report</td>
<td height="23" align="center" width="250"><select size="1" style="width: 230px" name="kat">
<option '); if ($kat == '1') { echo " selected "; } else { } echo(' value="1">Select</option>
<option '); if ($kat == '2') { echo " selected "; } else { } echo(' value="2">Exterior</option>
<option '); if ($kat == '3') { echo " selected "; } else { } echo(' value="3">Interior</option>
<option '); if ($kat == '4') { echo " selected "; } else { } echo(' value="4">Mechanical</option>
</select></td>
</tr>
<tr>
<td height="23" align="center" width="100">Part for Report</td>
<td height="23" align="center" width="250"><input type="text" name="ru" value="'.$ru.'" style="width: 230px"></td>
</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save"></td></tr>
	</table></form></div>');
} else {
$ru = addslashes($_POST['ru']);
$id = $_GET['id'];
$kat = $_POST['kat'];
$insert=mysql_query("Update `la_bukle` set `ru`='$ru', `kat`='$kat' where `id`='$id'");
   echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=4&msg=updated"</script>'); 
}
} else if ($next == 'new') {
if (!isset($_POST['submit'])) {
echo('<h1>Add Report for Vehicle</h1>');
echo('<div align="center"><form method="Post" action="?psl=app&do=database&step=4&next=new"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1"><tr>
<td height="23" align="center" width="100">Type of Report</td>
<td height="23" align="center" width="250"><select size="1" style="width: 230px" name="kat">
<option>Select</option>
<option value="1">Exterior</option>
<option value="2">Interior</option>
<option value="3">Мechanical</option>
</select></td>
</tr><tr>
		<td height="23" align="center" width="100">Part for Report</td>
		<td height="23" align="center" width="250"><input type="text" name="ru" style="width: 230px"></td>
	</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save"></td></tr>
	</table></form></div>');
} else {
$ru = addslashes($_POST['ru']);
$kat = $_POST['kat'];
$insert=mysql_query("Insert into `la_bukle` set `ru`='$ru', `kat`='$kat'");
echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=4&msg=saved"</script>'); 
}
} else if ($next == 'delete') {
$id = $_GET['id'];
$delas=mysql_query("Delete from `la_bukle` where `id`='$id'");
echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=4&msg=deleted"</script>'); 
}

} else if ($step == '5') {

if ($next =='') {
echo('<h1>Report for Motorcycles</h1>
<div align="center"><a href="?psl=app&do=database&step=5&next=new">Add Report</a><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1">');
echo('<tr>
		<td height="23" bgcolor="#f5f5f5" align="center" width="200">Report</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="150">Manage</td>
	</tr>'); 

$get_keb=mysql_query("Select * from `mo_bukle` order by `id` asc");
while($roz=mysql_fetch_array($get_keb)) {
$id = $roz['id'];
$name = $roz['ru'];
echo('<tr onmouseover="style.backgroundColor=\'#F8F8F8\'" onmouseout="style.backgroundColor=\'\'">
		<td height="22" align="left" width="200">&nbsp;&nbsp;'.$name.'</td>
		<td height="22" align="center" width="150" style="font-size: 8pt"><a href="?psl=app&do=database&step=5&next=edit&id='.$id.'">Edit</a> | <a onClick="if(confirm(\'Are you sure you want to remove this report?\')); else return false;" href="?psl=app&do=database&step=5&next=delete&id='.$id.'">Delete</a></td>
	</tr>');
}
echo('</table></div>');
} else if ($next == 'edit') {
if (!isset($_POST['submit'])) {
echo('<h1>Edit Report for Motorcycle</h1>');
$id = $_GET['id'];
$get_inf=mysql_query("Select * from `mo_bukle` where `id`='$id'");
$otz=mysql_fetch_array($get_inf);
$ru = $otz['ru'];
echo('<div align="center"><form method="post" action="?psl=app&do=database&step=5&next=edit&id='.$id.'"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1">
<tr>
<td height="23" align="center" width="100">Part for Report</td>
<td height="23" align="center" width="250"><input type="text" name="ru" value="'.$ru.'" style="width: 230px"></td>
</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save"></td></tr>
	</table></form></div>');
} else {
$ru = addslashes($_POST['ru']);
$id = $_GET['id'];
$kat = $_POST['kat'];
$insert=mysql_query("Update `mo_bukle` set `ru`='$ru' where `id`='$id'");
   echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=5&msg=updated"</script>'); 
}
} else if ($next == 'new') {
if (!isset($_POST['submit'])) {
echo('<h1>Add Report for Motorcycle</h1>');
echo('<div align="center"><form method="Post" action="?psl=app&do=database&step=5&next=new"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1">
<tr>
		<td height="23" align="center" width="100">Part for Report</td>
		<td height="23" align="center" width="250"><input type="text" name="ru" style="width: 230px"></td>
	</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save"></td></tr>
	</table></form></div>');
} else {
$ru = addslashes($_POST['ru']);
$insert=mysql_query("Insert into `mo_bukle` set `ru`='$ru'");
echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=5&msg=saved"</script>'); 
}
} else if ($next == 'delete') {
$id = $_GET['id'];
$delas=mysql_query("Delete from `mo_bukle` where `id`='$id'");
echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=5&msg=deleted"</script>'); 
}


} else if ($step == '6') {

if ($next == '') {
echo('<h1>Parts Category</h1>
<div align="center"><a href="?psl=app&do=database&step=6&next=new">Add Category</a><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1">');
echo('<tr>
		<td height="23" bgcolor="#f5f5f5" align="center" width="200">Category</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="150">Manage</td>
	</tr>'); 

$get_keb=mysql_query("Select * from `d_kat` order by `name` asc");
while($roz=mysql_fetch_array($get_keb)) {
$id = $roz['id'];
$name = $roz['name'];
echo('<tr onmouseover="style.backgroundColor=\'#F8F8F8\'" onmouseout="style.backgroundColor=\'\'">
		<td height="22" align="left" width="200">&nbsp;&nbsp;'.$name.'</td>
		<td height="22" align="center" width="150" style="font-size: 8pt"><a href="?psl=app&do=database&step=6&next=edit&id='.$id.'">Edit</a> | <a onClick="if(confirm(\'Are you sure you want to remove this category?\')); else return false;" href="?psl=app&do=database&step=6&next=delete&id='.$id.'">Delete</a></td>
	</tr>');
}
echo('</table></div>');
} else if ($next == 'new') {
if (!isset($_POST['submit'])) {
echo('<h1>Add Category</h1>');
echo('<div align="center"><form method="Post" action="?psl=app&do=database&step=6&next=new"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1">
<tr>
		<td height="23" align="center" width="100">Category</td>
		<td height="23" align="center" width="250"><input type="text" name="ru" style="width: 230px"></td>
	</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save"></td></tr>
	</table></form></div>');
} else {
$ru = addslashes($_POST['ru']);
include('funkcijos_ru.php');
$url = make_url($ru);
$insert=mysql_query("Insert into `d_kat` set `name`='$ru', `url`='$url'");
echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=6&msg=saved"</script>'); 
}
} else if ($next == 'edit') {
if (!isset($_POST['submit'])) {
echo('<h1>Edit Category</h1>');
$id = $_GET['id'];
$get_kat=mysql_query("Select * from `d_kat` where `id`='$id'");
$otl=mysql_fetch_array($get_kat);
$name = $otl['name'];
echo('<div align="center"><form method="Post" action="?psl=app&do=database&step=6&next=edit&id='.$id.'"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1">
<tr>
		<td height="23" align="center" width="100">Category</td>
		<td height="23" align="center" width="250"><input type="text" value="'.$name.'" name="ru" style="width: 230px"></td>
	</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save"></td></tr>
	</table></form></div>');
} else {
$ru = addslashes($_POST['ru']);
$url = make_url($ru);
$insert=mysql_query("Insert into `d_kat` set `name`='$ru', `url`='$url'");
echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=6&msg=saved"</script>'); 
}
} else if ($next == 'delete') {
$id = $_GET['id'];
$dezz=mysql_query("Delete from `d_kat` where `id`='$id'");
$usb=mysql_query("Delete from `d_sub` where `mid`='$id'");
echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=6&msg=deleted"</script>'); 
}
 
} else if ($step == '7') {

if ($next == '') {
echo('<h1>Subcategory</h1>
<div align="center"><a href="?psl=app&do=database&step=7&next=new">Add Subcategory</a><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1">');
echo('<tr>
		<td height="23" bgcolor="#f5f5f5" align="center" width="350">Category</td>
	</tr>'); 

$get_keb=mysql_query("Select * from `d_kat` order by `name` asc");
while($roz=mysql_fetch_array($get_keb)) {
$id = $roz['id'];
$name = $roz['name'];
echo('<tr onmouseover="style.backgroundColor=\'#F8F8F8\'" onmouseout="style.backgroundColor=\'\'">
		<td height="22" align="left" width="350">&nbsp;&nbsp;<a href="?psl=app&do=database&step=7&next=view&mid='.$id.'">'.$name.'</a></td>
	</tr>');
}
echo('</table></div>');
} else if ($next == 'view') {
$mid = $_GET['mid'];
$get_kat=mysql_query("Select * from `d_kat` where `id`='$mid'");
$otz=mysql_fetch_array($get_kat);
$name = $otz['name'];
echo('<h1>'.$name.' Subcategories</h1>
<div align="center"><a href="?psl=app&do=database&step=7&next=new&mid='.$mid.'">Add Subcategory</a><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1">');

echo('<tr>
		<td height="23" bgcolor="#f5f5f5" align="center" width="200">Subcategory</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="150">Manage</td>
	</tr>'); 

$get_keb=mysql_query("Select * from `d_sub` where `mid`='$mid' order by `name` asc");
while($roz=mysql_fetch_array($get_keb)) {
$id = $roz['id'];
$name = $roz['name'];
echo('<tr onmouseover="style.backgroundColor=\'#F8F8F8\'" onmouseout="style.backgroundColor=\'\'">
		<td height="22" align="left" width="200">&nbsp;&nbsp;'.$name.'</td>
		<td height="22" align="center" width="150" style="font-size: 8pt"><a href="?psl=app&do=database&step=7&next=edit&id='.$id.'">Edit</a> | <a onClick="if(confirm(\'Are you sure you want to remove this subcategory ?\')); else return false;" href="?psl=app&do=database&step=7&mid='.$mid.'&next=delete&id='.$id.'">Delete</a></td>
	</tr>');
}
echo('</table></div>');

} else if ($next == 'new') {
if (!isset($_POST['submit'])) {
echo('<h1>Add Subcategory</h1>');
echo('<div align="center"><form method="Post" action="?psl=app&do=database&step=7&next=new"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1">
<tr>
		<td height="23" align="center" width="100">Category</td>
		<td height="23" align="center" width="250"><select size="1" name="mid"><option>- Select -</option>');
$get_kats=mysql_query("Select * from `d_kat` order by `name` asc");
while($roz=mysql_fetch_array($get_kats)) {
$name = $roz['name'];
$kid = $roz['id'];
echo('<option value="'.$id.'">'.$name.'</option>');
}
echo('</select></td>
	</tr>
	<tr>
		<td height="23" align="center" width="100">Subcategory</td>
		<td height="23" align="center" width="250"><input type="text" name="name" style="width: 230px"></td>
	</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save"></td></tr>
	</table></form></div>');
} else {
$ru = addslashes($_POST['name']);
include('funkcijos_ru.php');
$url = make_url($ru);
$mid = $_POST['mid'];
$insert=mysql_query("Insert into `d_sub` set `name`='$ru', `url`='$url', `mid`='$mid'");
echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=7&next=view&mid='.$mid.'&msg=saved"</script>'); 
}
} else if ($next == 'edit') {
if (!isset($_POST['submit'])) {
echo('<h1>Edit Subcategory</h1>');
$id = $_GET['id'];
$get_kat=mysql_query("Select * from `d_sub` where `id`='$id'");
$otl=mysql_fetch_array($get_kat);
$name = $otl['name'];
$mid = $otl['mid'];
echo('<div align="center"><form method="Post" action="?psl=app&do=database&step=7&next=edit&id='.$id.'"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1">
<tr>
		<td height="23" align="center" width="100">Category</td>
		<td height="23" align="center" width="250"><select size="1" name="mid"><option>- Select -</option>');
$get_kats=mysql_query("Select * from `d_kat` order by `name` asc");
while($roz=mysql_fetch_array($get_kats)) {
$name = $roz['name'];
$kid = $roz['id'];
echo('<option '); if ($kid == $mid) { echo " selected "; } else { } echo(' value="'.$id.'">'.$name.'</option>');
}
echo('</select></td>
	</tr>
<tr>
		<td height="23" align="center" width="100">Subcategory</td>
		<td height="23" align="center" width="250"><input type="text" value="'.$name.'" name="ru" style="width: 230px"></td>
	</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save"></td></tr>
	</table></form></div>');
} else {
$ru = addslashes($_POST['ru']);
$url = make_url($ru);
$mid = $_POST['mid'];
$insert=mysql_query("Insert into `d_sub` set `name`='$ru', `url`='$url', `mid`='$mid'");
echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=7&next=view&mid='.$mid.'&msg=saved"</script>'); 
}
} else if ($next == 'delete') {
$id = $_GET['id'];
$usb=mysql_query("Delete from `d_sub` where `id`='$id'");
$mid = $_GET['mid'];
echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=7&mid='.$mid.'&next=view&msg=deleted"</script>'); 
}

} else if ($step == 8) {

if ($next == '') {
echo('<h1>Electronic Category</h1>
<div align="center"><a href="?psl=app&do=database&step=8&next=new">Add Category</a><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1">');
echo('<tr>
		<td height="23" bgcolor="#f5f5f5" align="center" width="200">Category</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="150">Manage</td>
	</tr>'); 

$get_keb=mysql_query("Select * from `e_kat` order by `name` asc");
while($roz=mysql_fetch_array($get_keb)) {
$id = $roz['id'];
$name = $roz['name'];
echo('<tr onmouseover="style.backgroundColor=\'#F8F8F8\'" onmouseout="style.backgroundColor=\'\'">
		<td height="22" align="left" width="200">&nbsp;&nbsp;'.$name.'</td>
		<td height="22" align="center" width="150" style="font-size: 8pt"><a href="?psl=app&do=database&step=8&next=edit&id='.$id.'">Edit</a> | <a onClick="if(confirm(\'Are you sure you want to remove this category ?\')); else return false;" href="?psl=app&do=database&step=8&next=delete&id='.$id.'">Delete</a></td>
	</tr>');
}
echo('</table></div>');
} else if ($next == 'new') {
if (!isset($_POST['submit'])) {
echo('<h1>Add Category</h1>');
echo('<div align="center"><form method="Post" action="?psl=app&do=database&step=8&next=new"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1">
<tr>
		<td height="23" align="center" width="100">Category</td>
		<td height="23" align="center" width="250"><input type="text" name="ru" style="width: 230px"></td>
	</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save"></td></tr>
	</table></form></div>');
} else {
$ru = addslashes($_POST['ru']);
include('funkcijos_ru.php');
$url = make_url($ru);
$insert=mysql_query("Insert into `e_kat` set `name`='$ru', `url`='$url'");
echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=8&msg=saved"</script>'); 
}
} else if ($next == 'edit') {
if (!isset($_POST['submit'])) {
echo('<h1>Edit Category</h1>');
$id = $_GET['id'];
$get_kat=mysql_query("Select * from `e_kat` where `id`='$id'");
$otl=mysql_fetch_array($get_kat);
$name = $otl['name'];
echo('<div align="center"><form method="Post" action="?psl=app&do=database&step=8&next=edit&id='.$id.'"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1">
<tr>
		<td height="23" align="center" width="100">Category</td>
		<td height="23" align="center" width="250"><input type="text" value="'.$name.'" name="ru" style="width: 230px"></td>
	</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save"></td></tr>
	</table></form></div>');
} else {
$ru = addslashes($_POST['ru']);
$url = make_url($ru);
$insert=mysql_query("Insert into `e_kat` set `name`='$ru', `url`='$url'");
echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=8&msg=saved"</script>'); 
}
} else if ($next == 'delete') {
$id = $_GET['id'];
$dezz=mysql_query("Delete from `e_kat` where `id`='$id'");
echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=8&msg=deleted"</script>'); 
}
} else if ($step == 9) {

if ($next =='') {
echo('<h1>Exterior Color</h1>
<div align="center"><a href="?psl=app&do=database&step=9&next=new">Add Color</a><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1">');
echo('<tr>
		<td height="23" bgcolor="#f5f5f5" align="center" width="200">Exterior Color</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="150">Manage</td>
	</tr>'); 

$get_keb=mysql_query("Select * from `la_spalva` order by `id` asc");
while($roz=mysql_fetch_array($get_keb)) {
$id = $roz['id'];
$name = $roz['ru'];
echo('<tr onmouseover="style.backgroundColor=\'#F8F8F8\'" onmouseout="style.backgroundColor=\'\'">
		<td height="22" align="left" width="200">&nbsp;&nbsp;'.$name.'</td>
		<td height="22" align="center" width="150" style="font-size: 8pt"><a href="?psl=app&do=database&step=9&next=edit&id='.$id.'">Edit</a> | <a onClick="if(confirm(\'Are you sure you want to remove this color ?\')); else return false;" href="?psl=app&do=database&step=9&next=delete&id='.$id.'">Delete</a></td>
	</tr>');
}

echo('</table></div>');
} else if ($next == 'edit') {
if (!isset($_POST['submit'])) {
echo('<h1>Edit Exterior Color</h1>');
$id = $_GET['id'];
$get_inf=mysql_query("Select * from `la_spalva` where `id`='$id'");
$otz=mysql_fetch_array($get_inf);
$ru = $otz['ru'];
echo('<div align="center"><form method="Post" action="?psl=app&do=database&step=9&next=edit&id='.$id.'"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1"><tr>
		<td height="23" align="center" width="100">Exterior Color</td>
		<td height="23" align="center" width="250"><input type="text" name="ru" value="'.$ru.'" style="width: 230px"></td>
	</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save"></td></tr>
	</table></form></div>');
} else {
$ru = addslashes($_POST['ru']);
$id = $_GET['id'];
$insert=mysql_query("Update `la_spalva` set `ru`='$ru' where `id`='$id'");
   echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=9&msg=updated"</script>'); 
}
} else if ($next == 'new') {
if (!isset($_POST['submit'])) {
echo('<h1>Add Exterior Color</h1>');
echo('<div align="center"><form method="Post" action="?psl=app&do=database&step=9&next=new"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1"><tr>
		<td height="23" align="center" width="100">Exterior Color</td>
		<td height="23" align="center" width="250"><input type="text" name="ru" style="width: 230px"></td>
	</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save"></td></tr>
	</table></form></div>');
} else {
$ru = addslashes($_POST['ru']);
$insert=mysql_query("Insert into `la_spalva` set `ru`='$ru'");
echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=9&msg=saved"</script>'); 
}
} else if ($next == 'delete') {
$id = $_GET['id'];
$delas=mysql_query("Delete from `la_spalva` where `id`='$id'");
echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=9&msg=deleted"</script>'); 
}

} else if ($step == '10') {

if ($next =='') {
echo('<h1>Interior Color</h1>
<div align="center"><a href="?psl=app&do=database&step=10&next=new">Add Iterior Color</a><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1">');
echo('<tr>
		<td height="23" bgcolor="#f5f5f5" align="center" width="200">Interior Color</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="150">Manage</td>
	</tr>'); 

$get_keb=mysql_query("Select * from `la_sspalva` order by `id` asc");
while($roz=mysql_fetch_array($get_keb)) {
$id = $roz['id'];
$name = $roz['ru'];
echo('<tr onmouseover="style.backgroundColor=\'#F8F8F8\'" onmouseout="style.backgroundColor=\'\'">
		<td height="22" align="left" width="200">&nbsp;&nbsp;'.$name.'</td>
		<td height="22" align="center" width="150" style="font-size: 8pt"><a href="?psl=app&do=database&step=10&next=edit&id='.$id.'">Edit</a> | <a onClick="if(confirm(\'Are you sure you want to remove this color ?\')); else return false;" href="?psl=app&do=database&step=10&next=delete&id='.$id.'">Delete</a></td>
	</tr>');
}

echo('</table></div>');
} else if ($next == 'edit') {
if (!isset($_POST['submit'])) {
echo('<h1>Edit Interior Color</h1>');
$id = $_GET['id'];
$get_inf=mysql_query("Select * from `la_sspalva` where `id`='$id'");
$otz=mysql_fetch_array($get_inf);
$ru = $otz['ru'];
echo('<div align="center"><form method="Post" action="?psl=app&do=database&step=10&next=edit&id='.$id.'"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1"><tr>
		<td height="23" align="center" width="100">Interior Color</td>
		<td height="23" align="center" width="250"><input type="text" name="ru" value="'.$ru.'" style="width: 230px"></td>
	</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save"></td></tr>
	</table></form></div>');
} else {
$ru = addslashes($_POST['ru']);
$id = $_GET['id'];
$insert=mysql_query("Update `la_sspalva` set `ru`='$ru' where `id`='$id'");
   echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=10&msg=updated"</script>'); 
}
} else if ($next == 'new') {
if (!isset($_POST['submit'])) {
echo('<h1>Add Interior Color</h1>');
echo('<div align="center"><form method="Post" action="?psl=app&do=database&step=10&next=new"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1"><tr>
		<td height="23" align="center" width="100">Interior Color</td>
		<td height="23" align="center" width="250"><input type="text" name="ru" style="width: 230px"></td>
	</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save"></td></tr>
	</table></form></div>');
} else {
$ru = addslashes($_POST['ru']);
$insert=mysql_query("Insert into `la_sspalva` set `ru`='$ru'");
echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=10&msg=saved"</script>'); 
}
} else if ($next == 'delete') {
$id = $_GET['id'];
$delas=mysql_query("Delete from `la_sspalva` where `id`='$id'");
echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=10&msg=deleted"</script>'); 
}


} else if ($step == '11') {

if ($next =='') {
echo('<h1>Title Type</h1>
<div align="center"><a href="?psl=app&do=database&step=11&next=new">Add Type of Title</a><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1">');
echo('<tr>
		<td height="23" bgcolor="#f5f5f5" align="center" width="200">Тitle Type</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="150">Manage</td>
	</tr>'); 

$get_keb=mysql_query("Select * from `la_title` order by `id` asc");
while($roz=mysql_fetch_array($get_keb)) {
$id = $roz['id'];
$name = $roz['ru'];
echo('<tr onmouseover="style.backgroundColor=\'#F8F8F8\'" onmouseout="style.backgroundColor=\'\'">
		<td height="22" align="left" width="200">&nbsp;&nbsp;'.$name.'</td>
		<td height="22" align="center" width="150" style="font-size: 8pt"><a href="?psl=app&do=database&step=11&next=edit&id='.$id.'">Edit</a> | <a onClick="if(confirm(\'Are you sure you want to remove this type of title ?\')); else return false;" href="?psl=app&do=database&step=11&next=delete&id='.$id.'">Delete</a></td>
	</tr>');
}

echo('</table></div>');
} else if ($next == 'edit') {
if (!isset($_POST['submit'])) {
echo('<h1>Edit Type of Title</h1>');
$id = $_GET['id'];
$get_inf=mysql_query("Select * from `la_title` where `id`='$id'");
$otz=mysql_fetch_array($get_inf);
$ru = $otz['ru'];
echo('<div align="center"><form method="Post" action="?psl=app&do=database&step=11&next=edit&id='.$id.'"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1"><tr>
		<td height="23" align="center" width="100">Type of Title</td>
		<td height="23" align="center" width="250"><input type="text" name="ru" value="'.$ru.'" style="width: 230px"></td>
	</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save"></td></tr>
	</table></form></div>');
} else {
$ru = addslashes($_POST['ru']);
$id = $_GET['id'];
$insert=mysql_query("Update `la_title` set `ru`='$ru' where `id`='$id'");
   echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=11&msg=updated"</script>'); 
}
} else if ($next == 'new') {
if (!isset($_POST['submit'])) {
echo('<h1>Add Type of Title</h1>');
echo('<div align="center"><form method="Post" action="?psl=app&do=database&step=11&next=new"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1"><tr>
		<td height="23" align="center" width="100">Type of Title</td>
		<td height="23" align="center" width="250"><input type="text" name="ru" style="width: 230px"></td>
	</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save"></td></tr>
	</table></form></div>');
} else {
$ru = addslashes($_POST['ru']);
$insert=mysql_query("Insert into `la_title` set `ru`='$ru'");
echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=11&msg=saved"</script>'); 
}
} else if ($next == 'delete') {
$id = $_GET['id'];
$delas=mysql_query("Delete from `la_title` where `id`='$id'");
echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=11&msg=deleted"</script>'); 
}

} else if ($step == '12') {

if ($next =='') {
echo('<h1>Vans/Minivans Make</h1>');
echo('<div align="center"><a href="?psl=app&do=database&step=12&next=new">Add Make</a><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1">');
echo('<tr>
		<td height="23" bgcolor="#f5f5f5" align="center" width="200">Make</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="150">Manage</td>
	</tr>'); 

$get_itz=mysql_query("Select * from `mi_marke` order by `name` asc");
while($zo=mysql_fetch_array($get_itz)) {
$id = $zo['id'];
$name = $zo['name'];

echo('<tr onmouseover="style.backgroundColor=\'#F8F8F8\'" onmouseout="style.backgroundColor=\'\'">
		<td height="22" align="left" width="200">&nbsp;&nbsp;<a href="?psl=app&do=database&step=12&next=models&mid='.$id.'">'.$name.'</a></td>
		<td height="22" align="center" width="150" style="font-size: 8pt"><a href="?psl=app&do=database&step=12&next=edit&id='.$id.'">Edit</a> | <a onClick="if(confirm(\'Are you sure you want to remove this make ?\')); else return false;" href="?psl=app&do=database&step=12&next=delete&id='.$id.'">Delete</a></td>
	</tr>');

}

echo('</table></div>');

} else if ($next == 'new') {
if (!isset($_POST['submit'])) {
echo('<h1>Add Vans/Minivans Make</h1>');
echo('<div align="center"><form method="Post" action="?psl=app&do=database&step=12&next=new"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1"><tr>
		<td height="23" align="center" width="100">Make</td>
		<td height="23" align="center" width="250"><input type="text" name="marke" style="width: 230px"></td>
	</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save"></td></tr>
	</table></form></div>');
} else {
$marke = $_POST['marke'];
$url = str_replace(" ", "-", $marke);
$insetz=mysql_query("Insert into `mi_marke` set `name`='$marke', `url`='$url'");
   echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=12&msg=inserted"</script>'); 
}
} else if ($next == 'edit') {
if (!isset($_POST['submit'])) {
echo('<h1>Edit Vans/Minivans Make</h1>');
$id = $_GET['id'];
$zzd=mysql_query("Select * from `mi_marke` where `id`='$id'");
$marke = $zzd['name'];
echo('<div align="center"><form method="Post" action="?psl=app&do=database&step=12&next=edit&id='.$id.'"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1"><tr>
		<td height="23" align="center" width="100">Маke</td>
		<td height="23" align="center" width="250"><input type="text" name="marke" value="'.$marke.'" style="width: 230px"></td>
	</tr>
	<tr><td colspan="2" height="35" align="center"><input type="submit" name="submit" value="Save"></td></tr>
	</table></form></div>');
} else {
$marke = $_POST['marke'];
$url = str_replace(" ", "-", $marke);
$id = $_GET['id'];
$insetz=mysql_query("Update `mi_marke` set `name`='$marke', `url`='$url' where `id`='$id'");
   echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=12&msg=updated"</script>'); 
}
} else if ($next == 'delete') {
$id = $_GET['id'];
$delasz=mysql_query("Delete from `mi_marke` where `id`='$id'");
   echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=12&msg=deleted"</script>'); 
} else if ($next == 'models') {
$ex = $_GET['ex'];

if ($ex == '') {
$mid = $_GET['mid'];
$imk_z=mysql_query("Select * from `mi_marke` where `id`='$mid'");
$mzz=mysql_fetch_array($imk_z);
$marke = $mzz['name'];
echo('<h1>Add Vans/Minivans Model ('.$marke.')</h1>');
$get_modeliai=mysql_query("Select * from `mi_modelis` where `mid`='$mid' order by `name` asc");


echo('<div align="center"><a href="?psl=app&do=database&step=12&next=models&ex=new&mid='.$mid.'">Add Model</a><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1">');
echo('<tr>
		<td height="23" bgcolor="#f5f5f5" align="center" width="200">Моdel</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="150">Manage</td>
	</tr>'); 

while($zzo=mysql_fetch_array($get_modeliai)) {
$name = $zzo['name'];
$id = $zzo['id'];

echo('<tr onmouseover="style.backgroundColor=\'#F8F8F8\'" onmouseout="style.backgroundColor=\'\'">
		<td height="22" align="left" width="200">&nbsp;&nbsp;'.$name.'</td>
		<td height="22" align="center" width="150" style="font-size: 8pt"><a href="?psl=app&do=database&step=12&next=models&ex=edit&id='.$id.'&mid='.$mid.'">Edit</a> | <a onClick="if(confirm(\'Are you sure you want to remove this model ?\')); else return false;" href="?psl=app&do=database&step=12&next=models&ex=delete&id='.$id.'&mid='.$mid.'">Delete</a></td>
	</tr>');
}


echo('</table></div>');

} else if ($ex == 'new') {
if (!isset($_POST['submit'])) {
echo('<h1>Edit Van/Minivan Model </h1>');
$mid = $_GET['mid'];
echo('<div align="center"><form method="Post" action="?psl=app&do=database&step=12&next=models&ex=new"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1"><tr>
		<td height="23" align="center" width="100">Маke</td>
		<td height="23" align="center" width="250"><select size="1" name="marke" style="width: 230px">');
$get_markes=mysql_query("Select * from `mi_marke` order by `name` asc") or die(mysql_error());
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
$insetz=mysql_query("Insert into `mi_modelis` set `name`='$modelis', `url`='$url', `mid`='$marke'");
   echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=12&next=models&mid='.$marke.'&msg=ok"</script>'); 
}
} else if ($ex == 'edit') {
if (!isset($_POST['submit'])) {
echo('<h1>Edit Van/Minivan Model</h1>');

$id = $_GET['id'];
$get_itz=mysql_query("Select * from `mi_modelis` where `id`='$id'");
$otzz=mysql_fetch_array($get_itz);
$mid = $otzz['mid'];
$modelis = $otzz['name'];
echo('<div align="center"><form method="Post" action="?psl=app&do=database&step=12&next=models&ex=edit&id='.$id.'"><table border="1" width="350" cellspacing="0" cellpadding="0" style="margin: 10px 0 0 0; border-collapse: collapse" bordercolor="#E1E1E1"><tr>
		<td height="23" align="center" width="100">Маke</td>
		<td height="23" align="center" width="250"><select size="1" name="marke" style="width: 230px">');
$get_markes=mysql_query("Select * from `mi_marke` order by `name` asc") or die(mysql_error());
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
$insetz=mysql_query("Update `mi_modelis` set `name`='$modelis', `url`='$url', `mid`='$marke' where `id`='$id'");
   echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=12&next=models&mid='.$marke.'&msg=ok"</script>'); 
}
} else if ($ex == 'delete') {
$id = $_GET['id'];
$mid = $_GET['mid'];
$delas=mysql_query("Delete from `mi_modelis` where `id`='$id'");
echo('<script type="text/javascript">window.location = "?psl=app&do=database&step=12&next=models&mid='.$mid.'&msg=ok"</script>'); 
}


}


}
?>