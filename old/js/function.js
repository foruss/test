/***********************************/
timestr = ":00:00";
timeM = "00";
timeI = "00";
timeN = "00";
timeC = "00";
tid = 0;
pause = 0;
var to;
var bcount;
var tcount;
function writer(){
document.write("test"); 
}
function getHourZone(z){
     h = today.getHours() + (today.getTimezoneOffset()/60+1) + z;
     if(h < 0){
          h = 24 + h} 
     if(h > 23){
          h = h - 24} 
     return h;     
}
function time(n) {
    tid=window.setTimeout("time(1)",to);
    today = new Date()
	todayM = new Date()
	todayI = new Date()
	todayN = new Date()
	todayC = new Date()
    if(today.getMinutes() < 10){ 
        pad = "0"}
    else  
    pad = "";
    if(today.getSeconds() < 10){ 
        pads = "0"}
    else  
    pads = "";
	hoursM = getHourZone(2);
	hoursI = getHourZone(5);
	hoursN = getHourZone(-5);
	hoursC = getHourZone(-9);
	timestr=":"+pad+today.getMinutes();
	//timestr=":"+pad+today.getMinutes()+":"+pads+today.getSeconds();
	timeM= hoursM+timestr;
	timeI= hoursI+timestr;
	timeN= hoursN+timestr;
	timeC= hoursC+timestr;
	document.getElementById('timeM').innerHTML = timeM;
	//document.getElementById('timeI').innerHTML = timeI;
	document.getElementById('timeN').innerHTML = timeN;
	document.getElementById('timeC').innerHTML = timeC;
  window.clearTimeout(tid);
  tid=window.setTimeout("time()",to);
}
function start(x) {
  f=x;
  to=60;
  time(x);
  }
function cleartids() {
 window.clearTimeout(tid);
}


function Expand(id)
{
var $state = document.getElementById('splitter'+id).style.display;
if ($state =='none') document.getElementById('splitter'+id).style.display = 'inline';
else document.getElementById('splitter'+id).style.display = 'none';
}
/* 
-------------------------------
*/
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
if ( (document.forms.register.login.value == null) || (document.forms.register.login.value.length < 3) )
{
alert("Выберите логин!");
document.forms.register.login.focus();
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

/* 
-------------------------------
*/
function changemake(id) {
var ajax = new Ajax.Request('/auto/getmodel/',
          {
               method: 'post', 
               parameters: 'id=' +id,
               onSuccess: function(transport) {
                   document.getElementById('modelselect').innerHTML = transport.responseText;
                        },
               onFailure: function() {
                    alert('Error');
               }
          });
}
/* 
-------------------------------
*/
function checkLogin(login) {
var ajax = new Ajax.Request('/register/ckecklogin/',
          {
               method: 'post', 
               parameters: 'login=' +login,
               onSuccess: function(transport) {
               		document.getElementById('loginok').innerHTML = transport.responseText;
               
               		if (transport.responseText=='0') {
               		document.getElementById('loginok').innerHTML = '';
               		document.getElementById('login').style.color = '';
               		document.getElementById('neclogin').style.display = 'none';
               		document.getElementById('isloginok').value = "1";
               		}
               		else {
               		document.getElementById('loginok').innerHTML = 'Логин уже занят!';
               		document.getElementById('login').style.color = 'red';
               		document.getElementById('neclogin').style.display = 'inline';
               		document.getElementById('isloginok').value = "0";
               		}
               },
               onFailure: function() {
                    alert('Error');
               }
          });

}

/* 
-------------------------------
*/
function checkourform(){
if ( (document.forms.ourform.name.value == null) || (document.forms.ourform.name.value.length < 3) )
{
alert("Представьтесь пожалуйста :)");
document.forms.ourform.name.focus();
return false;
}
if ( (document.forms.ourform.city.value == null) || (document.forms.ourform.city.value.length < 3) )
{
alert("Укажите город!");
document.forms.ourform.city.focus();
return false;
}
if ( (document.forms.ourform.bustype.value == null) || (document.forms.ourform.bustype.value.length < 3) )
{
alert("Укажите наименование юр.лица или  ИП!");
document.forms.ourform.bustype.focus();
return false;
}
if ( (document.forms.ourform.business.value == null) || (document.forms.ourform.business.value.length < 3) )
{
alert("Укажите род занятий!");
document.forms.ourform.business.focus();
return false;
}
if ( (document.forms.ourform.autoexp.value == null) || (document.forms.ourform.autoexp.value.length < 3) )
{
alert("Укажите наличие опыта работы в автомобильном бизнесе");
document.forms.ourform.autoexp.focus();
return false;
}
if ( (document.forms.ourform.phone.value == null) || (document.forms.ourform.phone.value.length < 3) )
{
alert("Укажите телефон");
document.forms.ourform.phone.focus();
return false;
}
if ( (document.forms.ourform.email.value == null) || (document.forms.ourform.email.value.length < 7) )
{
alert("Введите ваш e-mail!");
document.forms.ourform.email.focus();
return false;
}
if (! (/\w+@\w+\.[a-z]{2,4}/.test(document.forms.ourform.email.value)) )
{
alert("Вы ошиблись при вводе e-mail!");
document.forms.ourform.email.focus();
return false;
}

document.forms.ourform.submit();
return true;
}

/* 
-------------------------------
*/
function checkyourform() {
if ( (document.forms.yourform.name.value == null) || (document.forms.yourform.name.value.length < 3) )
{
alert("Представьтесь пожалуйста :)");
document.forms.yourform.name.focus();
return false;
}
if ( (document.forms.yourform.position.value == null) || (document.forms.yourform.position.value.length < 3) )
{
alert("Укажите должность!");
document.forms.yourform.position.focus();
return false;
}
if ( (document.forms.yourform.company.value == null) || (document.forms.yourform.company.value.length < 3) )
{
alert("Укажите компанию!");
document.forms.yourform.company.focus();
return false;
}
if ( (document.forms.yourform.phone.value == null) || (document.forms.yourform.phone.value.length < 3) )
{
alert("Укажите телефон");
document.forms.yourform.phone.focus();
return false;
}
if ( (document.forms.yourform.email.value == null) || (document.forms.yourform.email.value.length < 7) )
{
alert("Введите ваш e-mail!");
document.forms.yourform.email.focus();
return false;
}
if (! (/\w+@\w+\.[a-z]{2,4}/.test(document.forms.yourform.email.value)) )
{
alert("Вы ошиблись при вводе e-mail!");
document.forms.yourform.email.focus();
return false;
}

document.forms.yourform.submit();
return true;
}
/* 
-------------------------------
*/
function checkpartnform() {
if ( (document.forms.register.name.value == null) || (document.forms.register.name.value.length < 3) )
{
alert("Представьтесь пожалуйста :)");
document.forms.register.name.focus();
return false;
}
if ( (document.forms.register.phone.value == null) || (document.forms.register.phone.value.length < 3) )
{
alert("Укажите телефон");
document.forms.register.phone.focus();
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

document.forms.register.submit();
return true;

}

/*
 * -----------------------------------------
 */

function checkyourprice() {
if ( (document.forms.yourform.name.value == null) || (document.forms.yourform.name.value.length < 3) )
{
alert("Представьтесь пожалуйста :)");
document.forms.yourform.name.focus();
return false;
}
if ( (document.forms.yourform.phone.value == null) || (document.forms.yourform.phone.value.length < 3) )
{
alert("Укажите телефон");
document.forms.yourform.phone.focus();
return false;
}
if ( (document.forms.yourform.email.value == null) || (document.forms.yourform.email.value.length < 7) )
{
alert("Введите ваш e-mail!");
document.forms.yourform.email.focus();
return false;
}
if (! (/\w+@\w+\.[a-z]{2,4}/.test(document.forms.yourform.email.value)) )
{
alert("Вы ошиблись при вводе e-mail!");
document.forms.yourform.email.focus();
return false;
}
if ( (document.forms.yourform.price.value == null) || (document.forms.yourform.price.value.length < 2) )
{
alert("Укажите цену");
document.forms.yourform.price.focus();
return false;
}

document.forms.yourform.submit();
return true;

}
/*
 * --------------------------------------
 */
 function checkevalform() {
if ( (document.forms.evaluateform.make.value == null) || (document.forms.evaluateform.make.value.length < 2) )
{
alert("Укажите марку автомобиля!)");
document.forms.evaluateform.make.focus();
return false;
}
if ( (document.forms.evaluateform.model.value == null) || (document.forms.evaluateform.model.value.length < 1) )
{
alert("Укажите модель автомобиля!)");
document.forms.evaluateform.model.focus();
return false;
}
if ((document.forms.evaluateform.way.value == null) || (document.forms.evaluateform.way.value.length < 1) )
{
alert("Укажите пробег автомобиля!)");
document.forms.evaluateform.way.focus();
return false;
}
if ( (document.forms.evaluateform.volume.value == null) || (document.forms.evaluateform.volume.value.length < 2) )
{
alert("Укажите объем двигателя!)");
document.forms.evaluateform.volume.focus();
return false;
}
if ( (document.forms.evaluateform.name.value == null) || (document.forms.evaluateform.name.value.length < 2) )
{
alert("Представьтесь пожалуйста!)");
document.forms.evaluateform.name.focus();
return false;
}
if ( (document.forms.evaluateform.surname.value == null) || (document.forms.evaluateform.surname.value.length < 2) )
{
alert("Представьтесь пожалуйста!)");
document.forms.evaluateform.surname.focus();
return false;
}

if ( (document.forms.evaluateform.city.value == null) || (document.forms.evaluateform.city.value.length < 2) )
{
alert("Укажите город!)");
document.forms.evaluateform.city.focus();
return false;
}
if ( (document.forms.evaluateform.phone.value == null) || (document.forms.evaluateform.phone.value.length < 2) )
{
alert("Укажите контактный телефон!)");
document.forms.evaluateform.phone.focus();
return false;
}

document.forms.evaluateform.submit();
return true;
}
/*
 * 
 * 
 */
function checkrestoreform() {
 if ( (document.forms.restore.login.value == null) || (document.forms.restore.login.value.length < 2) )
{
alert("Введите логин!");
document.forms.restore.login.focus();
return false;
}
if ( (document.forms.restore.email.value == null) || (document.forms.restore.email.value.length < 7) )
{
alert("Введите ваш e-mail!");
document.forms.restore.email.focus();
return false;
}
if (! (/\w+@\w+\.[a-z]{2,4}/.test(document.forms.restore.email.value)) )
{
alert("Вы ошиблись при вводе e-mail!");
document.forms.restore.email.focus();
return false;
}
document.forms.restore.submit();
return true;	
}
/*
 * 
 * 
 */
function checkpassform() {
	if ((document.forms.restorepass.pass1.value.length < 4) || (document.forms.restorepass.pass1.value == null ))
	{
	alert("Проверьте ваш пароль, его длина должна быть не менее 4-х символов!!!");
	document.forms.restorepass.pass1.focus();
	return false;	
	}
	if (document.forms.restorepass.pass1.value !=document.forms.restorepass.pass2.value)
	{
	alert("Ваши новые пароли не совпадают!");
	document.forms.restorepass.pass1.focus();
	return false;	
	}
document.forms.restorepass.submit();
return true;	
}

function addBookmark(title,url) {

  var msg_netscape = "NetScape message";
  var msg_opera    = "This function does not work with this version of Opera.  Please bookmark us manually.";
  var msg_other    = "Your browser does not support automatic bookmarks.  Please bookmark us manually.";
  var agt          = navigator.userAgent.toLowerCase();


  if (agt.indexOf("opera") != -1) 
  {
    if (window.opera && window.print)
    {
      return true;
    } else 
    {
      alert(msg_other);
    }
  }    
  else if (agt.indexOf("firefox") != -1) window.sidebar.addPanel(title,url,"");
  else if ((agt.indexOf("msie") != -1) && (parseInt(navigator.appVersion) >=4)) window.external.AddFavorite(url,title); 
  else if (agt.indexOf("netscape") != -1) window.sidebar.addPanel(title,url,"")         
  else if (window.sidebar && window.sidebar.addPanel) window.sidebar.addPanel(title,url,""); 
  else alert(msg_other);
  
}
function changeloc(id) {
var ajax = new Ajax.Request('/getcity/',
          {
               method: 'post', 
               parameters: 'id=' +id,
               onSuccess: function(transport) {
                   document.getElementById('cityspan').innerHTML = transport.responseText;
                        },
               onFailure: function() {
                    alert('Error');
               }
          });
}
function changelocat(id) {
var ajax = new Ajax.Request('/getcity/',
          {
               method: 'post', 
               parameters: 'id=' +id,
               onSuccess: function(transport) {
                   document.getElementById('cityspan').innerHTML = transport.responseText;
                        },
               onFailure: function() {
                    alert('Error');
               }
          });
}
function checkLoginRestore(login) {
	var ajax = new Ajax.Request('/restore/ckecklogin/',
	          {
	               method: 'post', 
	               parameters: 'login=' +login,
	               onSuccess: function(transport) {
	               		document.getElementById('loginok').innerHTML = transport.responseText;
	               
	               		if (transport.responseText=='0') {
		               		document.getElementById('loginok').innerHTML = 'Такого логина нет в базе!';
		               		document.getElementById('login').style.color = 'red';
		               		document.getElementById('neclogin').style.display = 'inline';
		               		document.getElementById('isloginok').value = "0";
	               		}
	               		else {
		               		document.getElementById('loginok').innerHTML = '';
		               		document.getElementById('login').style.color = '';
		               		document.getElementById('neclogin').style.display = 'none';
		               		document.getElementById('isloginok').value = "1";
	               		}
	               },
	               onFailure: function() {
	                    alert('Error');
	               }
	          });

	}