<?php

$step = $_GET['step'];
$msg = $_GET['msg'];

if ($step == '') {

$get_users= mysql_query("Select * from `users` order by `id` asc");
echo('<h1>List of Users</h1>');
if ($msg == 'deleted') {
echo('<div align="center"><div style="margin: 10px 0; border: 1px dashed #999999; background: #FFFFFF; line-height: 150%; padding: 5px 10px; color: #990000; text-align: center; width: 250px">User successfully removed!</div></div>');
}
echo('<div align="center" style="margin: 10px 0 0 0"><table border="1" width="720" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#E1E1E1">');
echo('<tr>
		<td height="23" bgcolor="#f5f5f5" align="center" width="30">ID</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="130">Login</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="150">Name</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="35">Тype</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="140">City</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="140">IP</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="95">Remove</td>
	</tr>');

while($row=mysql_fetch_array($get_users)) {

$id = $row['id'];
$login = $row['login'];
$name = $row['name'];
$type = $row['type'];
if ($type == 'f56e82798de1b89f7a4d77479ead7280') { $type = '<b>Аdmin</b>'; } else { $type ='user'; }
$city = $row['city'];
$ip = $row['ip'];
echo('<tr onmouseover="style.backgroundColor=\'#f8f8f8\'" onmouseout="style.backgroundColor=\'\';">
		<td height="22" align="center">'.$id.'</td>
		<td height="22"width="130" align="left">&nbsp;'.$login.'</td>
		<td height="22" width="150" align="left">&nbsp;'.$name.'</td>
		<td height="22" align="center" width="35">'.$type.'</td>
		<td height="22" width="140" align="left">&nbsp;'.$city.'</td>
		<td height="22" align="center" width="140">'.$ip.'</td>
		<td height="22" align="center" width="95"><a  onClick="if(confirm(\'Are you sure you wanna remove this User?\')); else return false;" href="?psl=app&do=users&step=delete&id='.$id.'">Delete</a></td>
	</tr>');
}

echo('</table></div>');
} else if ($step == 'delete') {
$id = $_GET['id'];
$delz=mysql_query("Delete from `users` where `id`='$id'");
echo('<script type="text/javascript">window.location = "/app/users/deleted.msg"</script>');
}



?>
