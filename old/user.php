<?php

$do = $_GET['do'];
$msg = $_GET['msg'];
if (is_numeric($uid) && !empty($u_type)) {

} else {
if ($do == '') {
echo('<div align="center"><h1>Авторизация</h1>');
if ($msg == 'false') {
echo('<div style="margin: 10px 0; border: 1px dashed #999999; background: #FFFFFF; line-height: 150%; padding: 5px 10px; color: #990000; text-align: center; width: 300px"><b>Ошибка!</b> Логин или пароль неверны!</div>');
}
echo('<form action="user_login.php" method="post" name="loginform" id="loginform">
                        <input type="hidden" name="processlogin" value="1">
                        <table border="0" cellspacing="2" cellpadding="2">
                          <tr>
                            <td colspan="2"><a href="user/register.html">Регистрация</a> | <a href="user/reminder.html">Забыли пароль?</a></td>
                          </tr>
                          <tr>
                            <td colspan="2" height="10"></td>
                          </tr>                          
                          <tr>
                            <td align="right">Логин:</td>
                            <td align="left" style="width: 150px; height: 22px"><input name="login" type="text" id="login" style="width: 150px;" /></td>
                          </tr>
                          <tr>
                            <td align="right">Пароль:</td>
                            <td align="left" style="width: 150px; height: 22px"><input type="password" name="pass" id="password" style="width: 150px;" /></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td align="right" style="width: 150px;  height: 30px"><input type="submit" value="Войти" /></td>
                          </tr>
                        </table>
                    </form>
</div>');
} else if ($do == 'register' && empty($msg)) {
?>
<script lang="javascript">
function checkregisterform()
{
if ( (document.forms.register.name.value == null) || (document.forms.register.name.value.length < 3) )
{
alert("Представьтесь пожалуйста :)");
document.forms.register.name.focus();
return false;
}
if ( (document.forms.register.email.value == null) || (document.forms.register.email.value.length < 7) )
{
alert("Введите ваш e-mail!");
document.forms.register.email.focus();
return false;
}
if (! (/\w+@\w+\.[a-z]{2,4}/.test(document.forms.register.email.value)) )
{
alert("Вы ошиблись при вводе e-mail!");
document.forms.register.email.focus();
return false;
}
if ( (document.forms.register.login.value == null) || (document.forms.register.login.value.length < 3) )
{
alert("Выберите логин!");
document.forms.register.login.focus();
return false;
}
if (document.getElementById('login').value == "0") {
	alert("Выберите логин!");
	document.forms.register.login.focus();
	return false; 
}
if (document.forms.register.pass1.value.length <3)
{
alert("Пароли слишком короткий!");
document.forms.register.pass1.focus();
return false;
}
if ( (document.forms.register.pass1.value != document.forms.register.pass2.value) )
{
alert("Пароли не совпадают!");
document.forms.register.pass1.focus();
return false;
}
return true;
}

function check_login(lname) {
var sry_loader = document.createElement('script'); 
document.body.appendChild(sry_loader); 
sry_loader.src = "check_user.php?user=" + lname;
    }
</script>
<?php
echo('<div align="center">
<h1>Регистрация</h1>
<form action="registration.php" method="post" onsubmit="return checkregisterform(this);" name="register">
                         <table border="0" cellspacing="1" cellpadding="1">
                          <tr>
                            <td align="right">Ф.И.О. <span class="date">*</span></td>
                            <td align="right"><input type="text" name="name" style="width:160px;"></td>
                            </tr>
                          <tr>
                            <td align="right">Город</td>
                            <td><input type="text" name="city" style="width:160px;"></td>
                            </tr>
                          <tr>
                            <td align="right">E-mail <span class="date">*</span></td>
                            <td><input type="text" name="email" style="width:160px;"></td>
                            </tr>
                          <tr>
                            <td align="right">Телефон 1 <span class="date">*</span></td>
                            <td><input type="text" name="tel1" style="width:160px;"></td>
                            </tr>
                          <tr>
                            <td align="right">Телефон 2</td>
                            <td><input type="text" name="tel2" style="width:160px;"></td>
                            </tr>
                          <tr>
                            <td align="right">Адрес&nbsp;сайта</td>
                            <td><input type="text" name="url" style="width:160px;"></td>
                            </tr>
                          <tr>
                            <td align="right">Дата рождения</td>
                            <td><input type="text" name="yearsex" style="width:160px;"></td>
                            </tr>
                          <tr>
                            <td align="right">Род&nbsp;занятий</td>
                            <td><input type="text" name="business" style="width:160px;"></td>
                            </tr>
                          <tr>
                            <td align="right">Логин <span class="date">*</span></td>
                            <td><input type="text" name="login" id="login" style="width:160px;" maxlength="32" onchange="check_login(this.value);"></td>
                            </tr>
                          <tr>
                            <td align="right">Пароль <span class="date">*</span></td>
                            <td><input type="password" name="pass1" style="width:160px;"></td>
                            </tr>
                          <tr>
                            <td align="right">Подтвержление&nbsp;пароля <span class="date">*</span></td>
                            <td><input type="password" name="pass2" style="width:160px;"></td>
                            </tr>
                          <tr>
                            <td colspan="2" class="date">*- поля, обязательные для заполнения</td>
                            </tr>
                          <tr>
                            <td></td>
                            <td height="30" align="right"><input name="reg" type="submit" value="Зарегистрироваться" />
                            </td>
                           </tr>
                        </table>
                        </from> 

</div>');

} else if ($do == 'register' && $msg == 'ok') { 

echo('<div align="center"><h1>Регистрация</h1><h2>Вы зарегистрированы!</h2></div>');
} else if ($do == 'register' && $msg == 'false') {
echo('<div align="center"><h1>Регистрация</h1><h2>Ошибка!</h2></div>');
} else if ($do == 'reminder' && $msg == 'ok') { 
echo('<h1>Восстановление пароля</h1>');
echo('<div align="center">Дальнейшие указания по восстановлению пароля высланы на почтовый ящик, указанный вами при регистрации.</div>');

} else if ($do == 'reminder') {
echo('<h1>Восстановление пароля</h1>');
echo('<div align="center">');
if ($msg == 'false') { echo('<span class="date" style="margin: 0 0 15px 0">Такого логина нет в базе!</span>'); }
?>
<script lang="javascript">
function chk(f) {

if (document.rmd.login.value.length < 3) {
document.rmd.login.focus();
alert('Введите логин!');
return false
}
}
</script>
<?php 
echo('<form onsubmit="return chk()" name="rmd" action="do_remind.php" method="post">
                        <table border="0" cellspacing="2" cellpadding="2">
                          <tr>
                            <td align="right">Логин:</td>
                            <td align="left" style="width: 150px; height: 22px"><input name="login" type="text" id="login" style="width: 150px;" /></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td align="right" style="width: 150px;  height: 30px"><input type="submit" value="Продолжить" /></td>
                          </tr>
                        </table>
                    </form><br>Дальнейшие указания будут высланный на почтовый ящик, указанный вами при регистрации.</div>');
}

}
?>