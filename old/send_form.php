<script lang="javascript">
<? $codecc =substr(md5(uniqid(rand())), 0, 6);

$smc ="ms".$codecc."et"; ?>
var secret = '<? echo $codecc; ?>';

function check_bad(f) {
	if (badv.email.value.length < 7 && badv.skype.value.length < 3) {
	badv.email.focus();
	alert('Пожалуйста заполните все поля');
	return false
	} else if (badv.koment.value.length < 7) {
	badv.koment.focus();
	alert('Пожалуйста заполните все поля');
	return false
	}
	else if (badv.code.value != secret) {
	badv.code.focus();
	alert('Неправильно введен код с картинки');
	return false

	}
}

</script>
<div id="inf" style="display: none; top:0; left: 0; position: absolute; margin: 200px 0 0 0; z-index: 10099; background: #FFFFFF; border: 1px solid #cccccc; height: auto; width: 600px; font-family: tahoma; font-size: 9pt; color: #666666"><div style="height: 25px; width: 100%; background: #f0f0f0"><div style="float: left; margin: 4px 0 0 10px; color: #990000"><b>Задать вопрос</b></div><div style="height: 25px; float: right; margin: 0 5px 0 0"><a title="Закрыть" href="javascript:close_this()"><img style="border: 0; margin: 3px 0 0 0" src="/images/close.gif"></a></div></div><div style="margin: 10px"><form method="post" action="/send_query.php" onsubmit="return check_bad(this)" name="badv" style="margin: 0 0 15px 0; padding: 0"><table border="0" width="560" cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td width="250" style="padding: 2px 0 2px 0; line-height: 150%">Имя:<br><input type="text" style="width: 250px" name="name"></td>
		<td width="60"></td>
		<td width="250" style="padding: 2px 0 2px 0; line-height: 150%">Ваш email:<br><input type="text" style="width: 250px" name="email"></td>
	</tr>	<tr>
		<td width="250" style="padding: 2px 0 2px 0; line-height: 150%">Ваш скайп:<br><input type="text" style="width: 250px" name="skype"></td>
		<td width="60"></td>
		<td width="250" style="padding: 2px 0 2px 0; line-height: 150%"><input type="hidden" value="<?php  echo $_SERVER['REQUEST_URI']; ?>" name="backurl"><input type="hidden" name="scode" value="<?php  echo $smc; ?>"></td>
	</tr>
	<tr>
		<td colspan="3" style="padding: 2px 0 2px 0; line-height: 150%">Дополнительно:<br><textarea rows="3" name="koment" style="width: 560px"></textarea></td>
	</tr><tr>
		<td colspan="3" style="padding: 2px 0 2px 0; line-height: 150%;"><div style="float: left; margin: 0 20px 0 0; text-align: center"><img width="79" height="18" style="border: 1px solid #949494; margin: 19px 0 0 0"  src="/phpThumb.php?src=images/pad.gif&w=79&h=18&fltr[]=wmt|<?php  echo $codecc;?>|5|C|101010||100&f=png"></div><div style="float: left; text-align: right">Код с картинки:<br><input type="text" name="code" size="12" maxlength="6"></div><div style="clear:both"></div></td>
	</tr>
	<tr><td></td>
		<td colspan="2" height="35" style="text-align: center" align="center"><div align="center" class="button">
    <div>
    <div><input type="submit" name="submit" value="Отправить"></div></div></div></td>
	</tr>
</table></form></div></div>
<div id="full" onclick="close_this()" style="display: none; opacity:0.7; filter:alpha(opacity=70); z-index: 22; height: 100%; padding: 0; width: 100%; top:0; position: absolute; left: 0; background: #f0f0f0"><a id="zvopros"> </a></div>
<script lang="javascript"> 
function vapros() {
document.getElementById('inf').style.display='';
document.getElementById('full').style.display='';	
document.location.href='#zvopros';
}
 
function close_this() {
	var loadingas = document.getElementById('full');
	loadingas.style.display = "none";	
	document.getElementById('inf').style.display="none";
	}

var plotis = screen.width;
var sbfleft = (plotis - 600) / 2;

document.getElementById('inf').style.left=sbfleft+'px';
</script>