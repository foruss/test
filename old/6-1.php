<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>automixs.com - </title>
<meta name="Description" content="">
<meta name="Keywords" content="">
<link href="main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.pngFix.js"></script> 
<script type="text/javascript" src="/js/srCheckbox.js"></script>
<script type="text/javascript" src="/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="/js/jScrollPane.js"></script>
<link rel="stylesheet" type="text/css" href="/js/jquery.fancybox.css" media="screen" />
<link rel="shortcut icon" href="favicon.ico">
<script type="text/javascript" src="/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="/js/jquery.fancybox-1.2.1.pack.js"></script>

<script type="text/javascript"> 
<!--
 
$(document).ready(function(){
	$("span#images a").fancybox();
	$('.scroll').jScrollPane({showArrows:true, scrollbarWidth: 13, arrowSize: 16});
 
	/* �������� ������������� ������� */
	var widthDiv = ($('a.m_item').eq(0).width()/1)*($('a.m_item').length);
	$('.move-obj').eq(0).css('width',widthDiv + 'px');
	var widthThreeDivRight = 0;
	var widthThreeDivLeft = ($('a.m_item').eq(0).width()/1)*($('a.m_item').length-6)
	var flag = true;
	
	$("a.arrow_r").click(function(){
		if(flag == true)
			if(widthThreeDivLeft > Math.abs($('.move-obj').eq(0).css('marginLeft').substring(0,$('.move-obj').eq(0).css('marginLeft').indexOf('px'))))
				{
					flag = false;
					$('.move-obj').eq(0).animate({'marginLeft':"-=122px"},400, "swing", function(){
						flag = true;
					});
				};
		return false;
	});
	$("a.arrow_l").click(function(){
		if(flag == true)
			if(widthThreeDivRight > $('.move-obj').eq(0).css('marginLeft').substring(0,$('.move-obj').eq(0).css('marginLeft').indexOf('px'))) {
				flag = false;
				$('.move-obj').eq(0).animate({marginLeft:"+=122px"},400,function(){
					flag = true;
				});
			};
		return false;
	});
	/* ///�������� ������������� ������� */
	
	/* ������������ ������� �������� ���� */
	$('.a_i_menu li a').click(function(){
		$('.a_i_desc').parent().removeClass();
		$('.a_i_desc').parent().addClass('d_none');
		$('.a_i_menu li').removeClass('act');
		$(this).parent().addClass('act');
		for(i=0;i<=$('.a_i_menu li').length;i++)
			{
				if($('.a_i_menu li').eq(i).hasClass('act')){
					$('.a_i_desc').eq(i).parent().removeClass();
					$('.a_i_desc').eq(i).parent().addClass('d_block');
				};
			};
		return false;
	});
	/* ////������������ ������� �������� ���� */
			$('.for_free').click(function(){
		$('.a_i_desc').parent().removeClass();
		$('.a_i_desc').parent().addClass('d_none');
		$('#d1').removeClass('act');
		$('#d2').addClass('act');
		$('#d3').removeClass('act');
		$('#d4').removeClass('act');
		$('#d5').removeClass('act');
		for(i=0;i<=$('.a_i_menu li').length;i++)
			{
				if($('.a_i_menu li').eq(i).hasClass('act')){
					$('.a_i_desc').eq(i).parent().removeClass();
					$('.a_i_desc').eq(i).parent().addClass('d_block');
				};
			};
		return false;
	});
});
//-->
</script>



</head>

// <body onload="use_it()">

<body>

<div align="center">
<div style="width: 990px; text-align: left">
<div id="adv_place"><div style="float: left; width: 190px; height: 90px;  background: #F8F8F8"></div><div style="float: left; width: 580; height: 90px; margin: 0 0 0 15px; background: #F8F8F8"><a onclick="clicked('5')" rel="nofollow" target=_blank href="http://www.automixs.com/advertisement.html"><img src="adv/ce326.gif" width="580" height="90" alt="" border="0"></a></div><div style="float: right; width: 190px; height: 90px;  background: #F8F8F8"></div>
<div style="clear: both"></div></div>
<div id="hmenu" style="margin: 0"><div style="float: left; margin: 11px 0 0 0; width: 800px;"><a href="/">�������</a><a href="show-all.html">� �������</a><a href="order-car.html">����� ����</a><a href="news.html">�������</a><a href="reklama.html">�������</a><a href="contacts.html">��������</a></div><div id="user_log" style="padding: 11px 0 0 0"><a href="my-account.html" style="color: #990000">automixs</a></div>
<div style="clear: both"></div>
</div>

  <div style="float: left; width: 95px; margin: 0 0 3px 0"><div class="u_block">
<div style="text-align: center; padding: 5px 0; background:#fff url('images/u_block_c_01.gif') left top repeat-x; margin: 0; height: 30px">
<a href="/"><img src="/images/autmx-mini_logo.png" alt="Automixs" border="0" height="28" width="61"></a></div>
					<div class="t_l"></div><div class="t_r"></div><div class="b_l"></div><div class="b_r"></div>
				<div style="Clear: both"></div></div></div>
<div style="float: right; width: 890px; margin: 0 0 3px 0">
<div class="u_block">
<div style="text-align: center; padding: 5px 0; background:#fff url('images/u_block_c_01.gif') left top repeat-x; margin: 0; height: 30px">
<form method="get" action="?psl=find" style="margin: 0; padding: 0"><div style="margin: 6px 0 0 0"><input type="text" name="key" value="" style="width: 450px; margin: 0 10px 0 0"><select style="margin: 0 10px 0 0" size="1" name="kat" style="width: 150px">
<option value="0">�������� ��� ������</option>
<option  value="wrecked-cars">��������� ����</option><option  value="wrecked-boats">��������� �����</option><option  value="wrecked-moto">��������� ���������</option><option  value="cars">����������� ����</option><option  value="boats">����������� �����</option><option  value="moto">����������� ���������</option></select><input type="hidden" name="psl" value="find"><input type="submit" style="color: #FFFFFF; border: 1px solid #cccccc; padding: 2px 15px; background: url(images/s_r_cost_bg.gif)"  name="submit" value="�����"></div></form></div>
	<div class="t_l"></div><div class="t_r"></div><div class="b_l"></div><div class="b_r"></div>
				<div style="Clear: both"></div>
</div>
</div>
  <div style="clear: both"></div>
<div id="lside" style="float: left; width: 190px; margin: 3px 0 0 0; padding: 0"><script lang="javascript">
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
		document.getElementById('mme').innerHTML = '�� ���� &#8595;';
	} else {
		document.getElementById('shd').style.display = '';
		setCookie('user_menu', '2', '30');
		document.getElementById('mme').innerHTML = '�� ���� &#8593;';
	}
}

function admin_menu() {

	if (document.getElementById('a_shd').style.display =='') {
		document.getElementById('a_shd').style.display = 'none';
		setCookie('admin_menu', '1', '30');
		document.getElementById('mme2').innerHTML = '���� �������������� &#8595;';
	} else {
		document.getElementById('a_shd').style.display = '';
		setCookie('admin_menu', '2', '30');
		document.getElementById('mme2').innerHTML = '���� �������������� &#8593;';
	}
}

function use_it() {
	var username=getCookie("user_menu");
if (username == '1') {
	document.getElementById('shd').style.display = 'none';
	document.getElementById('mme').innerHTML = '�� ���� &#8595;';
} else {
	document.getElementById('shd').style.display = '';
}
var admin=getCookie("admin_menu");
if (admin == '1') {
	document.getElementById('a_shd').style.display = 'none';
	document.getElementById('mme2').innerHTML = '���� �������������� &#8595;';
} else {
	 document.getElementById('a_shd').style.display = ''; 
}
	
}

</script>
<ul id="left-menu">
<div align="center" style="margin: 0 0 10px 0;"><a class="stop" href="javascript:admin_menu()"><div id="mme2">���� �������������� &#8595;</div></a></div>
<div id="a_shd">
<li><a href="app/send-news.html">��������</a></li>
<li><a href="app/send-auto.html">�������� ����</a></li>
<li><a href="app/add-make.html">�������� �����</a></li>
<li><a href="app/add-cat.html">�������� ���������</a></li>
<li><a href="app/pages.html">��������</a></li>
<li><a href="app/pages/new.html">�������� ��������</a></li>
<li><a href="app/news.html">�������</a></li>
<li><a href="app/news/new.html">�������� �������</a></li>
<li><a href="app/faq.html">������ - �����</a></li>
<li><a href="app/users.html">������������</a></li>
<li><a href="app/banners.html">������ ��������</a></li>
<li><a href="app/categories.html">������ ��������</a></li>
<li><a href="app/database.html">���� ������</a></li>
</div>
<div align="center" style="margin: 7px 0 7px 0;"><a class="stop" href="javascript:user_menu()"><div id="mme">�� ���� &#8593;</div></a></div>
<div id="shd">
<li><a class="red" href="loged/auto.html">��� ����</a></li>
<li><a class="red" href="loged/auto/add.html">�������� ����</a></li>
<li><a class="red" href="loged/moto.html">������ ����������</a></li>
<li><a class="red" href="loged/moto/add.html">�������� ��������</a></li>
<li><a class="red" href="loged/boat.html">������ �����</a></li>
<li><a class="red" href="loged/boat/add.html">�������� �����</a></li>
<li><a class="red" href="loged/plane.html">������ ���������</a></li>
<li><a class="red" href="loged/plane/add.html">�������� �������</a></li>
<li><a class="red" href="loged/machinery.html">������ �����������</a></li>
<li><a class="red" href="loged/machinery/add.html">�������� �����������</a></li>
<li><a class="red" href="loged/spares.html">������ ���������</a></li>
<li><a class="red" href="loged/spares/add.html">�������� ��������</a></li>
<li><a class="red" href="loged/products.html">������ �������</a></li>
<li><a class="red" href="loged/products/add.html">�������� �����</a></li>
<li><a class="red" href="loged/my-settings.html">��� ������</a></li>
<li><a class="red" href="/logout.php">�����</a></li>
</div>
</ul>
<div class="u_block" style="margin: 0; padding: 0">
<div class="u_block-cont" style="text-align: center; padding: 5px 0 0 0; margin: 0; height: auto">
<div style="margin: 0 0 5px 0"><a onclick="clicked('32')" rel="nofollow" target=_blank href="http://www.facebook.com/?ref=home#!/pages/Roiel-Tinc/135500433192983"><img src="adv/57761.jpg" width="180" height="150" alt="" border="0"></a></div><div style="margin: 0 0 5px 0"><iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FAutoMixscom%2F152814121431632&amp;width=180&amp;colorscheme=light&amp;show_faces=true&amp;stream=false&amp;header=false&amp;height=220" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:180px; height:220px;" allowTransparency="true"></iframe></div>
<div style="margin: 0 0 5px 0"><script src="http://odnaknopka.ru/ok3.js" type="text/javascript"></script>
<link href="http://stg.odnoklassniki.ru/share/odkl_share.css" rel="stylesheet">
<script src="http://stg.odnoklassniki.ru/share/odkl_share.js" type="text/javascript" ></script><a class="odkl-klass-s" href="http://automixs.com/" onclick="ODKL.Share(this);return false;" ></a>
 <!-- odnoklassniki --></div><div class="t_l"></div><div class="t_r"></div><div class="b_l"></div><div class="b_r"></div>
				<div style="Clear: both"></div></div></div>
</div>
<div id="content" style="float: right; width: 795px; margin: 0 0 5px 0">
<div class="u_block">
					<div class="u_block-cont"><script lang="javascript">
function getmo(ivesta) {
    with(document.getElementById('model')) {

      while(length) remove(0);
      options.add(new Option('- �������� -', ''));

      var sry_loader = document.createElement('script');
      document.body.appendChild(sry_loader);
      sry_loader.src = "getm.php?in=" + ivesta;


    }
  }
</script>
Inspected by Certified Mechanics and is in top running condition. Interior is in great condition. Come over, check it out - we want you to be our next satisfied customer!<br><h1>������������� ����������</h1><div align="left"><a href="?psl=loged&do=auto&step=photo&id=191">������������� ����</a></div><div style="float: left; width: 370px; border-right: 1px dashed #e1e1e1"><h2>�������� ������:</h2>

<form name="form" id="form" action="update_auto.php" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="50000000">


<table border="0" width="370" cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td height="22" width="130">�����:</td>
		<td>

		</tr>
	<tr>
		<td height="22" width="130">������:</td>
		<td><select size="1" name="modelis" id="model" style="width: 200px"><option value="">- �������� -</option><option  value="3">100</option><option  value="4">200</option><option  value="5">5000</option><option  value="1">80</option><option  value="2">90</option><option  value="412">A1</option><option  value="6">A2</option><option  value="7">A3</option><option  value="8">A4</option><option  value="413">A4 Allroad</option><option  value="405">A5</option><option  value="9">A6</option><option  value="414">A6 Allroad</option><option  value="415">A7</option><option  value="10">A8</option><option  selected  value="21">Allroad</option><option  value="20">Cabriolet </option><option  value="416">Coupe</option><option  value="406">Q5</option><option  value="407">Q7</option><option  value="409">Quattro</option><option  value="410">R8</option><option  value="17">RS2</option><option  value="18">RS4</option><option  value="417">RS5</option><option  value="418">RS6</option><option  value="408">RX6</option><option  value="11">S1</option><option  value="12">S2</option><option  value="13">S3</option><option  value="14">S4</option><option  value="411">S5</option><option  value="15">S6</option><option  value="16">S8</option><option  value="22">TT</option><option  value="419">TT RS</option><option  value="420">TTS</option><option  value="19">V8</option></select></td>
	</tr>
	<tr>
		<td height="22" width="130">���������:</td>
		<td><select size="1" name="kat" style="width: 200px"><option  selected  value="0">�����</option><option  value="1">� ������������</option></select></td>
	</tr>
	<tr>
		<td height="22" width="130">����:</td>
		<td><select size="1" name="color" style="width: 200px"><option value="">- �������� -</option><option  value="15">�����</option><option  value="6">��������</option><option  value="3">�������</option><option  value="16">Ƹ����</option><option  selected  value="8">������</option><option  value="7">�������</option><option  value="5">����������</option><option  value="13">�������</option><option  value="11">���������</option><option  value="17">��������</option><option  value="9">������-������</option><option  value="10">������-�����</option><option  value="14">����������</option><option  value="1">�����</option><option  value="4">�����</option><option  value="12">����������</option><option  value="2">׸����</option></select></td>
	</tr>
		<tr>
		<td height="22" width="130">���� ������:</td>
		<td><select size="1" name="scolor" style="width: 200px"><option value="">- �������� -</option><option  value="4">�������</option><option  value="1">�����</option><option  value="7">Ƹ����</option><option  value="5">�������</option><option  value="8">�����</option><option  selected  value="3">�����</option><option  value="6">�����</option><option  value="2">׸����</option></select></td>
	</tr>
	<tr>
		<td height="22" width="130">��� ���������:</td>
		<td><select size="1" name="title" style="width: 200px"><option value="">- �������� -</option><option  value="3">������</option><option  selected  value="1">������</option><option  value="2">������</option></select></td>
	</tr><tr>
		<td height="22" width="130">VIN:</td>
		<td><input type="text" name="vin" value=" WA1YD54B04N031705" style="width: 200px"><input type="hidden" name="uid" value="2"></td>
	</tr><tr>
		<td height="22" width="130">��� �������:</td>
		<td><select size="1" name="metai" style="width: 200px"><option value="">- �������� -</option><option selected value="2004">2004</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option></select></td>
	</tr><tr>
		<td height="22" width="130">��� ������:</td>
		<td><select size="1" name="keb" style="width: 200px"><option value="">- �������� -</option><option  value="4">�����������</option><option  value="8">������</option><option  value="6">���������</option><option  value="5">����</option><option  value="2">�������</option><option  value="1">�����</option><option  selected  value="7">���������</option><option  value="3">�������</option></select></td>
	</tr><tr>
		<td height="22" width="130">��� ���������:</td>
		<td><select size="1" name="variklis" style="width: 200px"><option value="">- �������� -</option><option  value="1">������ ������</option><option  selected  value="3">������ �����</option><option  value="6">������</option><option  value="7">���-������</option><option  value="2">������</option><option  value="8">������</option><option  value="5">������</option><option  value="9">��������</option><option  value="10">����������</option><option  value="11">����������</option><option  value="4">�����������</option><option  value="12">����������� � ������������</option></select></td>
	</tr>
</table>

<h2 style="padding: 15px 0 0 0">�����:</h2>
	
	<table border="0" width="750" id="table1" cellpadding="1" style="border-collapse: collapse"><tr><td width="25" align="center">
	<input type="checkbox"  name="p1[]" id="priv_1" style="border: 0" value="a1"></td><td width="225">
	<label for="priv_1">CD-�������������</label></td><td width="25" align="center"><input type="checkbox"  name="p1[]" id="priv_2" style="border: 0" value="a2">
	</td><td width="225"><label for="priv_2">���</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_3" style="border: 0" value="a3">
	</td><td width="225"><label for="priv_3">�����������. �������</label></td></tr><tr><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_6" style="border: 0" value="a6">
	</td><td width="225"><label for="priv_6">���. �� ����� (�������)</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_7" style="border: 0" value="a7">
	</td></td>
	</table>
	
	
	
	<input type="button" value="�������� ���������" onclick="location.href='step/change_it.php?point=1&sec=1&cid=191&uid=2&back=edit'"> 
	<input type="button" value="�������� �����������" onclick="location.href='step/change_it.php?point=1&sec=0&cid=191&uid=2&back=edit'"> 
	<input type="submit" value="��������!">
	
	</form>

<div id="footer"><div id="fl">�2010-2012 �Automixs�</div><div style="float: right; width: 785px; text-align: center; margin: 13px 0 0 0;"><a href="auctions.html">��������</a><a href="faq.html">������-�����</a><a href="reklama.html">�������</a><a href="partnrship.html">��������������</a><a href="about-us.html">� ��������</a><a href="contacts.html">��������</a></div>
</div>


</div>
</body>
</html>