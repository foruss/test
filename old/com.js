function ifit(f) {

if (quick_form.fio.value.length < 3) {
document.getElementById('f1').style.border='1px solid #cc0000';
quick_form.fio.focus();
alert('Пожалуйста введите свое имя');
return false
} else if (quick_form.email.value.length < 7) {
document.getElementById('f2').style.border='1px solid #cc0000';
quick_form.email.focus();
alert('Пожалуйста введите свое Email');
return false
} else if (quick_form.phon.value.length < 5) {
document.getElementById('f3').style.border='1px solid #cc0000';
quick_form.phon.focus();
alert('Пожалуйста введите телефон');
return false
}else if (quick_form.city.value.length < 2) {
document.getElementById('f4').style.border='1px solid #cc0000';
quick_form.city.focus();
alert('Пожалуйста введите страну');
return false
}   else if (quick_form.skype.value.length < 2) {
document.getElementById('f5').style.border='1px solid #cc0000';
quick_form.skype.focus();
alert('Пожалуйста введите skype');
return false
}  else if (quick_form.text.value.length < 5) {
document.getElementById('f5').style.border='1px solid #cc0000';
quick_form.text.focus();
alert('Пожалуйста введите сообщение');
return false
}

}