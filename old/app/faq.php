<?php 
$msg = $_GET['msg'];
$step = $_GET['step'];
if ($step == '') {
echo('<h1>Вопрос - ответ </h1>');

echo('<div align="center" style="margin: 10px 0 0 0"><table border="1" width="700" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#E1E1E1">');
echo('<tr>
		<td height="23" bgcolor="#f5f5f5" align="center" width="450">Вопрос</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="100">Одобрить!</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="150">Управление</td>
	</tr>');

$get_faq=mysql_query("Select * from `duk` order by `id` desc");
while($zz=mysql_fetch_array($get_faq)) {
$id = $zz['id'];
$kl = stripslashes($zz['kl']);
$kl = str_replace("<br />", "", $kl);
$on = $zz['on'];
$ip = $zz['ip'];
$name = $zz['name'];
$data = $zz['data'];
if ($on == '0') {
$if_on ='<a href="?psl=app&do=faq&step=change&on=1&id='.$id.'">Одобрить</a>';
} else if ($on == '1') {
$if_on ='<a href="?psl=app&do=faq&step=change&on=0&id='.$id.'" style="color: #333333">Oтменить</a>';
}
echo('<tr onmouseover="style.backgroundColor=\'#f8f8f8\'" onmouseout="style.backgroundColor=\'\';">
		<td height="22" align="left"><div style="margin: 2px 3px 3px 3px; font-size: 8pt; color: #333333"><b>'.$name.', '.$data.'</b> (IP: '.$ip.')</div><div style="margin: 3px; line-height: 130%">'.$kl.'</div></td>
		<td height="22" align="center">'.$if_on.'</td>
		<td height="22" style="font-size: 8.5pt"><a href="?psl=app&do=faq&step=edit&id='.$id.'">Редактировать</a> | <a onClick="if(confirm(\'Вы уверены, что хотите удалить этoт вопрос?\')); else return false;" href="?psl=app&do=faq&step=delete&id='.$id.'">Удалить</a></td>
	</tr>');

}

echo('</table></div>');
} else if ($step == 'change') {
$id = $_GET['id'];
$on = $_GET['on'];
$updaite=mysql_query("Update `duk` set `on`='$on' where `id`='$id'");
echo('<script type="text/javascript">window.location = "/app/faq/updated.msg"</script>'); 
} else if ($step == 'edit') {
if (!isset($_POST['submit'])) {
echo('<h1>Редактирование вопросы/ответы</h1>');
$id = $_GET['id'];
$get_inf=mysql_query("Select * from `duk` where `id`='$id'");
$zz=mysql_fetch_array($get_inf);
$name = $zz['name'];
$kl = $zz['kl'];
$kl = str_replace("<br />", "", $kl);
$ats = $zz['ats'];
$uid = $zz['uid'];
$uid_zz=mysql_query("Select * from `users` where `id`='$uid'");
$otz=mysql_fetch_array($uid_zz);
$email = $otz['email'];
$city = $otz['city'];
echo('<div align="center"><form action="?psl=app&do=faq&step=edit&id='.$id.'" method="post">
<table>
<tr>
<td align="left"><b>Имя:</b></td>
<td><input type="text" name="name" value="'.$name.'" style="width:120px;" /></td>
</tr>
<tr>
<td align="left"><b>E-mail:</b></td>
<td><input type="text" name="email" readonly value="'.$email.'" style="width:120px;" /></td>
</tr>
<tr>
<td align="left"><b>Город:</b></td>
<td><input type="text" name="city" readonly value="'.$city.'" style="width:120px;" /></td>
</tr>
<tr>
<td  align="left"colspan="2"><b>Сообщение:</b></td></tr>
<tr>
<td colspan="2"><textarea name="kl" cols="15" rows="8" style="width:300px;">'.$kl.'</textarea></td>
</tr>
<tr>
<td align="left" colspan="2"><b>Ответ:</b></td></tr>
<tr>
<td colspan="2"><textarea name="atsr" cols="15" rows="8" style="width:300px;">'.$ats.'</textarea></td>
</tr>
<tr><td colspan="2"><input type="submit" name="submit" value="Сохранить"></td></tr>
</table>
</form>
</div>');

} else {
$id = $_GET['id'];
$name = addslashes($_POST['name']);
$email = addslashes($_POST['email']);
$city = addslashes($_POST['city']);
$kl = addslashes($_POST['kl']);
$ats = addslashes($_POST['ats']);
$upddd=mysql_query("Update `duk` set `name`='$name', `email`='$email', `city`='$city', `kl`='$kl', `ats`='$ats'");
echo('<script type="text/javascript">window.location = "/app/faq/updated.msg"</script>'); 
}
} else if ($step == 'delete') {
$id =$_GET['id'];
$get_delaz=mysql_query("Delete from `duk` where `id`='$id'");
echo('<script type="text/javascript">window.location = "/app/faq/deleted.msg"</script>'); 
}


?>