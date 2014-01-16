<?php
require_once "../config.php";
require_once LIB_DIR . "user.php";
require_once LIB_DIR . "utils.php";
$message = "";
if(isset($_POST['processlogin']) && $_POST['processlogin'] == "1") {
	$login = processPostVariable('login');
	$password = processPostVariable('password');
	if (!processUserLogin($login, $password)) {
		$message = "Login error!";
	} else $message = "OK!";
}
if (isUserLoggedIn()) {
	if (!$config['user']['admin']) {
		header(null,null,403);
		die("asdf");
	}
	header('Location: admin.php');
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Twilight Area</title>
<script type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<link href="login.css" rel="stylesheet" type="text/css" />
</head>
<body onload="MM_preloadImages('img/enter_btn2.gif','img/help_btn2.gif')">


<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="middle">
	<!-- body-->
    <br />
    <br />
    <br />
    <br />
<form action="" method="post" name="f1">
<input type="hidden" name="processlogin" value="1" />
<table width="445" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<!-- top table-->
	<table width="445" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td align="right"><img src="img/logo_login.gif" alt="" width="204" height="69" /></td>
    <td>&nbsp;</td>
    <td><img src="img/arrow_login.gif" width="65" height="67" /></td>
  </tr>
  <tr>
    <td colspan="3"><img src="img/red_line.gif" width="380" height="4" /></td>
    <td>&nbsp;</td>
  </tr>
</table>

	<!-- /top table-->	</td>
  </tr>
  <tr>
    <td>
	<table width="405" border="0" cellpadding="0" cellspacing="0" background="img/body_bg.gif">
      <tr>
        <td width="16" rowspan="5"><img src="img/lft_body.gif" width="16" height="132" /></td>
        <td colspan="4"><img src="img/spacer.gif" width="15" height="20" /></td>
        <td width="16" rowspan="5"><img src="img/rght_body.gif" width="16" height="132" /></td>
      </tr>
      <tr>
        <td align="right"><img src="img/login.gif" alt="Логин" width="50" height="29" /></td>
        <td width="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0" background="img/input_bg.gif">
            <tr>
              <td width="15"><img src="img/lft_input.gif" width="15" height="31" /></td>
              <td>
<input type="text" style="font-size: 11px" name="login" size="35" accesskey="u" tabindex="101" value="Введите логин" onfocus="if (this.value == 'User Name') this.value = '';" />
              </td>
              <td width="14"><img src="img/rgt_input.gif" width="14" height="31" /></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td height="3" colspan="4">&nbsp;</td>
        </tr>
      <tr>
        <td width="70" align="right" valign="middle"><img src="img/passw.gif" alt="Пароль" width="61" height="30" /></td>
        <td width="5" valign="middle">&nbsp;</td>
        <td colspan="2" valign="middle"><table width="100%" border="0" cellpadding="0" cellspacing="0" background="img/input_bg.gif">
            <tr>
              <td width="15"><img src="img/lft_input.gif" width="15" height="31" /></td>
              <td>
<input type="password" name="password" size="30" tabindex="102" />
		<input type="hidden" name="s" value="" />
		<input type="hidden" name="do" value="login" />		
		<input type="hidden" name="vb_login_md5password" />
		<input type="hidden" name="vb_login_md5password_utf" />
              </td>
              <td width="14"><img src="img/rgt_input.gif" width="14" height="31" /></td>
            </tr>
        </table>		</td>
      </tr>
    </table>
	</td>
  </tr>
  
  <tr>
    <td><img src="img/spacer.gif" width="10" height="3" /></td>
  </tr>
  <tr>
    <td><table width="405" border="0" cellspacing="0" cellpadding="0">
      <tr align="center" background="img/top_bg.gif">
        <td width="16" background="img/top_bg.gif"><img src="img/lft_top.gif" width="16" height="41" /></td>
        <td background="img/top_bg.gif">
		<table width="373" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td align="center"><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Помощь','','img/help_btn2.gif',1)"><img src="img/help_btn.gif" alt="Помощь" name="Помощь" width="99" height="41" border="0" id="Помощь" /></a></td>
              <td>&nbsp;</td>
              <td><a href="javascript: document.forms['f1'].submit();" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Вход','','img/enter_btn2.gif',1)" onclick="submit"><img src="img/enter_btn.gif" alt="Вход" name="Вход" width="99" height="41" border="0" id="Вход" /></a></td>
            </tr>
        </table>		</td>
        <td width="16" background="img/top_bg.gif"><img src="img/rgt_top.gif" width="16" height="41" /></td>
      </tr>
    </table></td>
  </tr>
</table></form>
<br />
<?=$message;?>
	<!-- /body-->
	</td>
  </tr>
</table>
</body>
</html>
<?php
}
?>
