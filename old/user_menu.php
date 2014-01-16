<script lang="javascript">
function setCookie(c_name,value,exdays)
{
var exdate=new Date();
exdate.setDate(exdate.getDate() + exdays);
var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
document.cookie=c_name + "=" + c_value;
}
function getCookie(c_name)
{
var i,x,y,ARRcookies=document.cookie.split(";");
for (i=0;i<ARRcookies.length;i++)
{
  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
  x=x.replace(/^\s+|\s+$/g,"");
  if (x==c_name)
    {
    return unescape(y);
    }
  }
}

function user_menu() {

	if (document.getElementById('shd').style.display =='') {
		document.getElementById('shd').style.display = 'none';
		setCookie('user_menu', '1', '30');
		document.getElementById('mme').innerHTML = 'Моё меню &#8595;';
	} else {
		document.getElementById('shd').style.display = '';
		setCookie('user_menu', '2', '30');
		document.getElementById('mme').innerHTML = 'Моё меню &#8593;';
	}
}

function admin_menu() {

	if (document.getElementById('a_shd').style.display =='') {
		document.getElementById('a_shd').style.display = 'none';
		setCookie('admin_menu', '1', '30');
		document.getElementById('mme2').innerHTML = 'Меню администратора &#8595;';
	} else {
		document.getElementById('a_shd').style.display = '';
		setCookie('admin_menu', '2', '30');
		document.getElementById('mme2').innerHTML = 'Меню администратора &#8593;';
	}
}

function use_it() {
	var username=getCookie("user_menu");
if (username == '1') {
	document.getElementById('shd').style.display = 'none';
	document.getElementById('mme').innerHTML = 'Моё меню &#8595;';
} else {
	document.getElementById('shd').style.display = '';
}
var admin=getCookie("admin_menu");
if (admin == '1') {
	document.getElementById('a_shd').style.display = 'none';
	document.getElementById('mme2').innerHTML = 'Меню администратора &#8595;';
} else {
	 document.getElementById('a_shd').style.display = ''; 
}
	
}

</script>
<?php 

if ($u_type == 'f56e82798de1b89f7a4d77479ead7280') {

echo('<ul id="left-menu">
<div align="center" style="margin: 0 0 10px 0;"><a class="stop" href="javascript:admin_menu()"><div id="mme2">Меню администратора &#8595;</div></a></div>
<div id="a_shd">
<li><a href="app/send-news.html">Рассылка</a></li>
<li><a href="app/send-auto.html">Рассылка авто</a></li>
<li><a href="app/add-make.html">Добавить марку</a></li>
<li><a href="app/add-cat.html">Добавить категорию</a></li>
<li><a href="app/pages.html">Страницы</a></li>
<li><a href="app/pages/new.html">Добавить страницу</a></li>
<li><a href="app/news.html">Новости</a></li>
<li><a href="app/news/new.html">Добавить новость</a></li>
<li><a href="app/faq.html">Вопрос - ответ</a></li>
<li><a href="app/users.html">Пользователи</a></li>
<li><a href="app/banners.html">Список баннеров</a></li>
<li><a href="app/categories.html">Список разделов</a></li>
<li><a href="app/database.html">База данных</a></li>
</div>
<div align="center" style="margin: 7px 0 7px 0;"><a class="stop" href="javascript:user_menu()"><div id="mme">Моё меню &#8593;</div></a></div>
<div id="shd">
<li><a class="red" href="loged/auto.html">Мои авто</a></li>
<li><a class="red" href="loged/auto/add.html">Добавить авто</a></li>
<li><a class="red" href="loged/moto.html">Список мотоциклов</a></li>
<li><a class="red" href="loged/moto/add.html">Добавить мотоцикл</a></li>
<li><a class="red" href="loged/boat.html">Список лодок</a></li>
<li><a class="red" href="loged/boat/add.html">Добавить лодку</a></li>
<li><a class="red" href="loged/plane.html">Список самолетов</a></li>
<li><a class="red" href="loged/plane/add.html">Добавить самолет</a></li>
<li><a class="red" href="loged/machinery.html">Список спецтехники</a></li>
<li><a class="red" href="loged/machinery/add.html">Добавить спецтехнику</a></li>
<li><a class="red" href="loged/spares.html">Список запчастей</a></li>
<li><a class="red" href="loged/spares/add.html">Добавить запчасти</a></li>
<li><a class="red" href="loged/products.html">Список товаров</a></li>
<li><a class="red" href="loged/products/add.html">Добавить товар</a></li>
<li><a class="red" href="loged/my-settings.html">Мои данные</a></li>
<li><a class="red" href="/logout.php">Выход</a></li>
</div>
</ul>
');


} else if ($u_type == '4a5a2a0ca560e48ca59b1c898ac5b31b') {

echo('<ul id="left-menu">
<div align="center" style="margin: 7px 0 7px 0;"><a class="stop" href="javascript:user_menu()"><div id="mme">Моё меню &#8593;</div></a></div>
<div id="shd">
<li><a class="red" href="loged/auto.html">Мои авто</a></li>
<li><a class="red" href="loged/auto/add.html">Добавить авто</a></li>
<li><a class="red" href="loged/moto.html">Список мотоциклов</a></li>
<li><a class="red" href="loged/moto/add.html">Добавить мотоцикл</a></li>
<li><a class="red" href="loged/boat.html">Список лодок</a></li>
<li><a class="red" href="loged/boat/add.html">Добавить лодку</a></li>
<li><a class="red" href="loged/plane.html">Список самолетов</a></li>
<li><a class="red" href="loged/plane/add.html">Добавить самолет</a></li>
<li><a class="red" href="loged/machinery.html">Список спецтехники</a></li>
<li><a class="red" href="loged/machinery/add.html">Добавить спецтехнику</a></li>
<li><a class="red" href="loged/spares.html">Список запчастей</a></li>
<li><a class="red" href="loged/spares/add.html">Добавить запчасти</a></li>
<li><a class="red" href="loged/products.html">Список товаров</a></li>
<li><a class="red" href="loged/products/add.html">Добавить товар</a></li>
<li><a class="red" href="loged/my-settings.html">Мои данные</a></li>
<li><a href="/logout.php">Выход</a></li>
</div>
</ul>');

} else {
?><div id="shd" style=""></div><?php 
}



?>