<h1>Personal Info</h1>
<?php 
$name = $uss['name'];
$city = $uss['city'];
$email = $uss['email'];
$tel1 = $uss['tel1'];
$tel2 = $uss['tel2'];
$url = $uss['url'];
$yearsex = $uss['yearsex'];
$business = $uss['business'];
$login = $uss['login'];
$id = $uss['id'];
$msg = $_GET['msg'];
if ($msg == 'ok') {
echo('<div align="center"><div style="margin: 10px 0; border: 1px dashed #999999; background: #FFFFFF; line-height: 150%; padding: 5px 10px; color: #990000; text-align: center; width: 250px">Changes Was Made Successfully</div></div>');
} else if ($msg == 'false') {
echo('<div align="center"><div style="margin: 10px 0; border: 1px dashed #999999; background: #FFFFFF; line-height: 150%; padding: 5px 10px; color: #990000; text-align: center; width: 250px">Ошибка!</div></div>');
} else {

} ?>
<script lang="javascript">
function checkregisterform()
{
if ( (document.forms.register.name.value == null) || (document.forms.register.name.value.length < 3) )
{
alert("Please Enter Your First and Last Name");
document.forms.register.name.focus();
return false;
}

if ( (document.forms.register.email.value == null) || (document.forms.register.email.value.length < 7) )
{
alert("Please Enter You Email");
document.forms.register.email.focus();
return false;
}
if (! (/\w+@\w+\.[a-z]{2,4}/.test(document.forms.register.email.value)) )
{
alert("Please Check Email");
document.forms.register.email.focus();
return false;
}


if ( (document.forms.register.pass1.value != document.forms.register.pass2.value) )
{
alert("Password Does Not Match");
document.forms.register.pass1.focus();
return false;
}
return true;
}
</script>
<div align="center">
<form action="update_info.php" method="post" onsubmit="return checkregisterform(this);" name="register">
                         <table border="0" cellspacing="1" cellpadding="1">
                          <tr>
                            <td align="right">Full Name <span class="date">*</span></td>
                            <td align="right"><input type="text" value="<?php echo $name;?>" name="name" style="width:160px;"></td>
                            </tr>
                          <tr>
                            <td align="right">Country/State/City</td>
                            <td><input type="text" name="city" value="<?php echo $city; ?>" style="width:160px;"></td>
                            </tr>
                          <tr>
                            <td align="right">E-mail <span class="date">*</span></td>
                            <td><input type="text" name="email" value="<?php echo $email; ?>" style="width:160px;"></td>
                            </tr>
                          <tr>
                            <td align="right">Phone# <span class="date">*</span></td>
                            <td><input type="text" name="tel1" value="<?php  echo $tel1; ?>" style="width:160px;"></td>
                            </tr>
                          <tr>
                            <td align="right">Телефон 2</td>
                            <td><input type="text" name="tel2" value="<?php  echo $tel2; ?>" style="width:160px;"><input type="hidden" name="login" value="<?php  echo $login; ?>"></td>
                            </tr>
                          <tr>
                            <td align="right">Web&nbsp;Page</td>
                            <td><input type="text" name="url" value="<?php echo $url; ?>" style="width:160px;"><input type="hidden" name="zz" value="<?php  echo $uid; ?>"></td>
                            </tr>
                          <tr>
                            <td align="right">D.O.B</td>
                            <td><input type="text" name="yearsex" value="<?php  echo $yearsex; ?>" style="width:160px;"></td>
                            </tr>
                          <tr>
                            <td align="right">Род&nbsp;занятий</td>
                            <td><input type="text" name="business" value="<?php echo $business; ?>" style="width:160px;"></td>
                            </tr>
                          <tr>
                            <td align="right">User Name <span class="date">*</span></td>
                            <td><input type="text" style="width:160px;" value="<?php echo $login; ?>" readonly></td>
                            </tr>
                          <tr>
                            <td align="right">New Password </td>
                            <td><input type="password" name="pass1" style="width:160px;"></td>
                            </tr>
                          <tr>
                            <td align="right">Confirm&nbsp;Password</td>
                            <td><input type="password" name="pass2" style="width:160px;"></td>
                            </tr>
                          <tr>
                            <td colspan="2" class="date">*- All fields are required</td>
                            </tr>
                            <tr>
                            <td></td>
                            <td height="30" align="right"><input name="reg" type="submit" value="Update" />
                            </td>
                           </tr>
                        </table>
                        </from> 

</div>