<?php 
$do = addslashes($_GET['do']);
$step = addslashes($_GET['step']);
$msg = $_GET['msg'];
if (!empty($do) && !empty($step)) {

echo('<h1>Восстановление пароля</h1>');

$get_iff=mysql_query("Select * from `users` where `login`='$do' and `pass`='$step'");
$skk=mysql_num_rows($get_iff);
if ($skk == '0') {
echo('<div align="center"><h2>Ошибка! Пользователь не найден</h2></div>');
} else {
?>
<script lang="javascript">
function chk(f) {
	if (document.rst.login.value.length < 3)
	{
	document.rst.login.focus();
	alert("Выберите логин!");
	return false;
	} else if (document.rst.pass1.value.length < 3)
	{
		alert("Пароли слишком короткий!");
		document.rst.pass1.focus();
		return false;
		}
		if ( (document.rst.pass1.value != document.rst.pass2.value) )
		{
		alert("Пароли не совпадают!");
		document.rst.pass2.focus();
		return false;
		}
	

} 

</script>
<?php 
echo('<div align="center">Введите ваш логин и новый пароль<form name="rst" action="do_restore.php" method="post" style="margin: 10px 0 0 0" onsubmit="return chk(this)">
                        <input type="hidden" name="processlogin" value="1">
                        <table border="0" cellspacing="2" cellpadding="2">            
                          <tr>
                            <td style="background: #f5f5f5" align="right">Логин<span class="date">*</span>:</td>
                            <td align="left" style="width: 150px; height: 22px; background: #f5f5f5"><input name="login" value="'.$do.'" type="text" id="login" style="width: 150px;" /></td>
                          </tr>
                          <tr>
                            <td align="right">Пароль<span class="date">*</span>:</td>
                            <td align="left" style="width: 150px; height: 22px"><input type="password" name="pass1" style="width: 150px;" /></td>
                          </tr>
                          <tr>
                            <td style="background: #f5f5f5" align="right">Подтвержление пароля<span class="date">*</span>:</td>
                            <td align="left" style="width: 150px; height: 22px; background: #f5f5f5"><input type="password" name="pass2" style="width: 150px;" /><input type="hidden" name="sid" value="'.$step.'"></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td align="right" style="width: 150px;  height: 30px"><input type="submit" value="Изменить" /></td>
                          </tr>
                        </table>
                    </form>
</div>');
}
} else if (!empty($msg)) {
echo('<h1>Восстановление пароля</h1><div align="center"><h2>Ваш пароль изменен.</h2></div>');
} else {

echo('<h1>Ошибка</h1>');
}




?>