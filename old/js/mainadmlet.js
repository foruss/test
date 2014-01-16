function checkform()
{
if ( (document.forms.admletter.name.value == null) || (document.forms.admletter.name.value.length < 3) )
{
alert("Представьтесь пожалуйста :)");
document.forms.admletter.name.focus();
return false;
}
if ( (document.forms.admletter.email.value == null) || (document.forms.admletter.email.value.length < 7) )
{
alert("Введите ваш e-mail!");
document.forms.admletter.email.focus();
return false;
}
if (! (/\w+@\w+\.[a-z]{2,4}/.test(document.forms.admletter.email.value)) )
{
alert("Вы ошиблись при вводе e-mail!");
document.forms.admletter.email.focus();
return false;
}
if ( (document.forms.admletter.message.value == null) || (document.forms.admletter.message.value.length < 7) )
{
alert("А как же нам написать что- нибудь?");
document.forms.admletter.message.focus();
return false;
}
document.getElementById('admletter').submit();
return true;
}
