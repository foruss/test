function checkaddform()
{
if ((document.forms.mailer.company_name.value == null) || (document.forms.mailer.company_name.value < 3))
{
alert("Введите название организации / предприятия!");
document.forms.mailer.company_name.focus();
return false;
}
if ((document.forms.mailer.category.value == null) || (document.forms.mailer.category.value == 0))
{
alert("Выберите категорию!");
document.forms.mailer.category.focus();
return false;
}
if ((document.forms.mailer.company_about.value == null) || (document.forms.mailer.company_about.value == 0))
{
alert("Введите информацию о фирме!");
document.forms.mailer.company_about.focus();
return false;
}
if ((document.forms.mailer.org_prav_form.value == null) || (document.forms.mailer.org_prav_form.value == 0))
{
alert("Выберите организационно- правовую форму!");
document.forms.mailer.org_prav_form.focus();
return false;
}
if ( (document.forms.mailer.email.value == null) || (document.forms.mailer.email.value.length < 7) )
{
alert("Введите e-mail!");
document.forms.mailer.email.focus();
return false;
}
if (! (/\w+@\w+\.[a-z]{2,4}/.test(document.forms.mailer.email.value)) )
{
alert("Введите правильный e-mail!");
document.forms.mailer.email.focus();
return false;
}
if ((document.forms.mailer.country.value == null) || (document.forms.mailer.country.value == 0))
{
alert("Выберите страну!");
document.forms.mailer.country.focus();
return false;
}
if ((document.forms.mailer.index.value == null) || (document.forms.mailer.index.value < 4))
{
alert("Введите индекс!");
document.forms.mailer.index.focus();
return false;
}
if ((document.forms.mailer.legal_address.value == null) || (document.forms.mailer.legal_address.value < 4))
{
alert("Введите юридический адрес!");
document.forms.mailer.legal_address.focus();
return false;
}
return true;
}
