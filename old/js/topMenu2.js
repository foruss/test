function changemake(id) {
 $.post('/auto/getmodel/', {'id': id},  function(data){
  //alert("Data Loaded: " + data);
  document.getElementById('modelselect').innerHTML = data;
  
  });

}
function LoadMainSearchModels(part) {
	 $.get('/ajax.php?mode=getmodel&part='+part,  function(data){
  document.getElementById('mainsearchmodel').style.display="block";
  document.getElementById('mainsearchmodel').innerHTML = data;
  });
}
function UpdateYears() {
	document.getElementById('year1').disabled=false;
	document.getElementById('year2').disabled=false;
	
}

//
function Expand(id)
{
var $state = document.getElementById('splitter'+id).style.display;
if ($state =='none') document.getElementById('splitter'+id).style.display = 'inline';
else document.getElementById('splitter'+id).style.display = 'none';
}

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
if ( (document.forms.register.login2.value == null) || (document.forms.register.login2.value.length < 3) )
{
alert("Выберите логин!");
document.forms.register.login2.focus();
return false;
}
if (document.getElementById('isloginok').value == "0") {
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
