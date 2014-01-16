<?php 

$step = $_GET['step'];
$msg = $_GET['msg'];
if ($step == '') {
echo('<h1>List of Categories</h1>');
if ($msg == 'ok') {
echo('<div align="center"><div style="margin: 10px 0; border: 1px dashed #999999; background: #FFFFFF; line-height: 150%; padding: 5px 10px; color: #990000; text-align: center; width: 250px">Successfully Added!</div></div>');
} else if ($msg == 'deleted') {
echo('<div align="center"><div style="margin: 10px 0; border: 1px dashed #999999; background: #FFFFFF; line-height: 150%; padding: 5px 10px; color: #990000; text-align: center; width: 250px">Category successfully deleted!</div></div>');
} else if ($msg == 'updated') {
echo('<div align="center"><div style="margin: 10px 0; border: 1px dashed #999999; background: #FFFFFF; line-height: 150%; padding: 5px 10px; color: #990000; text-align: center; width: 250px">Changes has been made successfully!</div></div>');
}
echo('<div align="center" style="margin: 10px 0 0 0"><a href="?psl=app&do=categories&step=new">Add Category</a><br><table border="1" width="500" cellspacing="0" cellpadding="0" style="border-collapse: collapse; margin: 10px 0 0 0" bordercolor="#E1E1E1">');
echo('<tr>
		<td height="23" bgcolor="#f5f5f5" align="center" width="100">Photo</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="180">Name</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="220">Manager</td>
	</tr>');
$get_imgz=mysql_query("Select * from `sand_cat` order by `id` asc");
while($gz=mysql_fetch_array($get_imgz)) {
$on = $gz['on'];
$id = $gz['id'];
$ru = stripslashes($gz['ru']);
$img = $gz['img'];
if ($on == '1') {
$onf ='<a href="?psl=app&do=categories&step=ch&w=0&id='.$id.'">Turn Off</a>';
} else if ($on == '0') {
$onf ='<a href="?psl=app&do=categories&step=ch&w=1&id='.$id.'">Turn On</a>';
}
echo('<tr onmouseover="style.backgroundColor=\'#F8F8F8\'" onmouseout="style.backgroundColor=\'\';">
		<td height="23" align="center" width="100"><img src="'.$img.'"></td>
		<td height="23" align="center" width="180">'.$ru.'</td>
		<td height="23" align="center" width="220" style="font-size: 8pt"><a href="?psl=app&do=categories&step=edit&id='.$id.'">Edit</a> | <a onClick="if(confirm(\'Are you sure you want to delete this Category?\')); else return false;" href="?psl=app&do=categories&step=delete&id='.$id.'">Delete</a> | '.$onf.'</td>
	</tr>');

}
echo('</table></div>');
} else if ($step == 'new')  {
if (!isset($_POST['submit'])) {
echo('<h1>Add Category</h1>');
echo('<div align="center">
<form method="POST" enctype="multipart/form-data" action="?psl=app&do=categories&step=new">
<table border="1" width="320" cellspacing="0" cellpadding="0" style="border-collapse: collapse; margin: 10px 0 0 0" bordercolor="#E1E1E1">');
echo('<tr>
		<td height="23" align="left" width="120">&nbsp;&nbsp;Category Name:</td>
		<td height="23" align="center" width="200"><input type="text" name="pav" style="width: 180px"></td>
	</tr><tr>
		<td height="23" align="left" width="120">&nbsp;&nbsp;Photo of Category:</td>
		<td height="23" align="center" width="200"><input type="file" name="foto" style="width: 180px"></td>
	</tr><tr>
		<td height="23" align="left" width="120">&nbsp;&nbsp;Link to:</td>
		<td height="23" align="center" width="200"><input type="text" name="url" style="width: 180px"></td>
	</tr><tr><td colspan="2" height="35" align="center"><input type="submit" value="Submit" name="submit"></td></tr>
	</table></form>
	</div>');
} else {
$pav = addslashes($_POST['pav']);
$url = addslashes($_POST['url']);

	// img upload
$file_name = $_FILES['foto']['name'];
$logotype = $_FILES['foto'];
if (!empty($file_name)) {
$file_size = $_FILES['foto']['size'];
$file_type = $_FILES['foto']['type'];
$file_dir = "cat";
$tu = explode(".", $file_name);
$galune = array_pop($tu);
$max_file_size = 1024 * 9048;
$un = substr(md5(uniqid(rand())), 0, 5);
$file_destination = $file_dir . "/" . $un . "." . $galune;


$funkcija = move_uploaded_file ($logotype["tmp_name"], $file_destination);
$baneris = $file_destination;

} else {
	$baneris = '';
} 
//

$insas=mysql_query("Insert into `sand_cat` set `ru`='$pav', `url`='$url', `img`='$baneris'");
echo('<script type="text/javascript">window.location = "app/categories/inserted.msg"</script>'); 
}
} else if ($step == 'edit') {
if (!isset($_POST['submit'])) {
echo('<h1>Edit Category</h1>');
$id = $_GET['id'];
$get_inf=mysql_query("Select * from `sand_cat` where `id`='$id'");
$zii=mysql_fetch_array($get_inf);
$pav = $zii['ru'];
$img = $zii['img'];
if (empty($img)) { $im='<input type="file" name="foto" style="width: 180px">'; } else {
$im = '<img src="'.$img.'" style="margin: 0 5px 0 0"><a onClick="if(confirm(\'Are you sure you want to delete this photo?\')); else return false;" href="?psl=app&do=categories&step=del_img&id='.$id.'">Delete Photo</a><input type="hidden" name="baneris" value="'.$img.'">';
}
$link = $zii['url'];
echo('<div align="center">
<form method="POST" enctype="multipart/form-data" action="?psl=app&do=categories&step=edit&id='.$id.'">
<table border="1" width="320" cellspacing="0" cellpadding="0" style="border-collapse: collapse; margin: 10px 0 0 0" bordercolor="#E1E1E1">');
echo('<tr>
		<td height="23" align="left" width="120">&nbsp;&nbsp;Category Name:</td>
		<td height="23" align="center" width="200"><input type="text" value="'.$pav.'" name="pav" style="width: 180px"></td>
	</tr><tr>
		<td height="23" align="left" width="120">&nbsp;&nbsp;Photo of Category:</td>
		<td height="23" align="center" width="200">'.$im.'</td>
	</tr><tr>
		<td height="23" align="left" width="120">&nbsp;&nbsp;Link To:</td>
		<td height="23" align="center" width="200"><input type="text" value="'.$link.'" name="url" style="width: 180px"></td>
	</tr><tr><td colspan="2" height="35" align="center"><input type="submit" value="Save Changes" name="submit"></td></tr>
	</table></form>
	</div>');
} else {
$pav = addslashes($_POST['pav']);
$url = addslashes($_POST['url']);
$id = $_GET['id'];
	// img upload
$file_name = $_FILES['foto']['name'];
$logotype = $_FILES['foto'];
if (!empty($file_name)) {
$file_size = $_FILES['foto']['size'];
$file_type = $_FILES['foto']['type'];
$file_dir = "cat";
$tu = explode(".", $file_name);
$galune = array_pop($tu);
$max_file_size = 1024 * 9048;
$un = substr(md5(uniqid(rand())), 0, 5);
$file_destination = $file_dir . "/" . $un . "." . $galune;


$funkcija = move_uploaded_file ($logotype["tmp_name"], $file_destination);
$baneris = $file_destination;

} else {
	$baneris = $_POST['baneris'];;
} 
//

$insas=mysql_query("Update `sand_cat` set `ru`='$pav', `url`='$url', `img`='$baneris' where `id`='$id'");
echo('<script type="text/javascript">window.location = "app/categories/updated.msg"</script>'); 
}
} else if ($step == 'delete') {
$id = $_GET['id'];
$get_img =mysql_query("Select * from `sand_cat` where `id`='$id'");
$zz=mysql_fetch_array($get_img);
$img = $zz['img'];
@unlink("$img");
$dzz=mysql_query("Delete from `sand_cat` where `id`='$id'");
echo('<script type="text/javascript">window.location = "app/categories/deleted.msg"</script>'); 
} else if ($step == 'ch') {
$id = $_GET['id'];
$w = $_GET['w'];
$updaz=mysql_query("Update `sand_cat` set `on`='$w' where `id`='$id'");
echo('<script type="text/javascript">window.location = "app/categories/updated.msg"</script>'); 
} else if ($step == 'del_img') {
$id = $_GET['id'];
$zod=mysql_query("Select * from `sand_cat` where `id`='$id'");
$oz=mysql_fetch_array($zod);

$img = $oz['img'];
@unlink("$img");
$delaz=mysql_query("Update `sand_cat` set `img`='' where `id`='$id'");
echo('<script type="text/javascript">window.location = "/?psl=app&do=categories&step=edit&id='.$id.'"</script>'); 
}
?>