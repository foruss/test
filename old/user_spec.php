<div align="center"><div style="margin: 10px 0; border: 1px dashed #990000; background: #f0d9d9; line-height: 150%; padding: 5px 10px; color: #111111; text-align: center; width: 500px"><b>Внимание!</b> Для того чтобы разместить своё объявление вы должны подключиться.</div>
<div align="center"><h1>Авторизация</h1>
<?php 
$go_url = $_SERVER["REQUEST_URI"];
?>
<form action="user_login.php" method="post" name="loginform" id="loginform">
                        <input type="hidden" name="processlogin" value="1">
                        <table border="0" cellspacing="2" cellpadding="2">
                          <tr>
                            <td colspan="2"><a href="user/register.html">Регистрация</a> | <a href="user/reminder.html">Забыли пароль?</a></td>
                          </tr>
                          <tr>
                            <td colspan="2" height="10"><input type="hidden" name="go_url" value="<?php  echo $go_url;?>"></td>
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
</div></div>