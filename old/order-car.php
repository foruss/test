<h1>Заказать авто</h1>
<div align="center">
<script lang="javascript">
function checker(f) {

if (document.oc.name.value.length < 1) {
document.oc.name.focus();
alert('Пожалуйста, заполните все поля');
return false;
} else if (document.oc.email.value.length < 1) {
	document.oc.email.focus();
	alert('Пожалуйста, заполните все поля');
	return false;
} else if (document.oc.city.value.length < 1) {
	document.oc.city.focus();
	alert('Пожалуйста, заполните все поля');
	return false;
} else if (document.oc.make.value.length < 1) {
	document.oc.make.focus();
	alert('Пожалуйста, заполните все поля');
	return false;
} else if (document.oc.model.value.length < 1) {
	document.oc.model.focus();
	alert('Пожалуйста, заполните все поля');
	return false;
} else if (document.oc.year.value.length < 1) {
	document.oc.year.focus();
	alert('Пожалуйста, заполните все поля');
	return false;
} else if (document.oc.maxcost.value.length < 1) {
	document.oc.maxcost.focus();
	alert('Пожалуйста, заполните все поля');
	return false;
} else if (document.oc.skype.value.length < 1) {
	document.oc.skype.focus();
	alert('Пожалуйста, заполните все поля');
	return false;
} else if (document.oc.phone.value.length < 1) {
	document.oc.phone.focus();
	alert('Пожалуйста, заполните все поля');
	return false;
} else if (document.oc.message.value.length < 1) {
	document.oc.message.focus();
	alert('Пожалуйста, заполните все поля');
	return false;
}
}
</script>
<form action="send_order.php" method="post" name="oc" onsubmit="return checker(this)" id="questionform">
<table width="400" border="0" cellpadding="0" style="border-collapse: collapse">
								<tr>
									<td width="130" height="21" align="left">Ваше ФИО:</td>
									<td width="270" align="left"><input type="text" name="name" style="width: 200px;" /></td>
								</tr>
								<tr>
									<td width="130" height="21" align="left">Ваш email:</td>
									<td width="270" align="left"><input type="text" name="email" style="width: 200px;" /></td>
								</tr>
								<tr>
									<td width="130" height="21" align="left">Адрес:</td>
									<td width="270" align="left"><input type="text" name="city" style="width: 200px;" /></td>
								</tr>
								<tr>
									<td width="130" height="21" align="left">Марка:</td>
									<td width="270" align="left"><input type="text" name="make" style="width: 200px;"></td>
								</tr>
								<tr>
									<td width="130" height="21" align="left">Модель:</td>
									<td width="270" align="left"><input type="text" name="model" style="width: 200px;"></td>
								</tr>
								<tr>
									<td width="130" height="21" align="left">Год выпуска:</td>
									<td width="270" align="left"><input type="text" name="year" style="width: 200px;"></td>
								</tr>
															<tr>
									<td width="130" height="21" align="left">Максимальная цена:</td>
									<td width="270" align="left"><input type="text" name="maxcost" style="width: 200px;"></td>
								</tr>
								<tr>
									<td width="130" height="21" align="left">Ваш скайп:</td>
									<td width="270" align="left"><input type="text" name="skype" style="width: 200px;" /></td>
								</tr>
							
								<tr>
									<td width="130" height="21" align="left">Ваш телефон:</td>
									<td width="270" align="left"><input type="text" name="phone" style="width: 200px;" /></td>
								</tr>
								<tr>
									<td colspan="2" height="21" align="left">Дополнительно:</td>
								</tr>
								<tr>
									<td  align="left" colspan="2"><textarea name="message" style="width:400px;" rows="7"></textarea></td>
								</tr>
								<tr>
									<td></td>
									<td align="center" height="35"><input type="submit" name="submitSearch" value="Отправить!" /></tr>
								</table>
								</form></div>
