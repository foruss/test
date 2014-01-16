function checkmailform()
{
if ( (document.forms.mailer.name.value == null) || (document.forms.mailer.name.value.length < 3) )
{
alert("Представьтесь пожалуйста :)");
document.forms.mailer.name.focus();
return false;
}
if ( (document.forms.mailer.email.value == null) || (document.forms.mailer.email.value.length < 7) )
{
alert("Введите ваш e-mail!");
document.forms.mailer.email.focus();
return false;
}
if (! (/\w+@\w+\.[a-z]{2,4}/.test(document.forms.mailer.email.value)) )
{
alert("Вы ошиблись при вводе e-mail!");
document.forms.mailer.message.focus();
return false;
}
if ( (document.forms.mailer.message.value == null) || (document.forms.mailer.message.value.length < 7) )
{
alert("А как же нам написать что- нибудь?");
document.forms.mailer.message.focus();
return false;
}
document.forms.mailer.submit();
return true;
}
