

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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

<body onload="use_it()">

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


<form name="nskk" action="update_auto.php" method="post" enctype="multipart/form-data">

xvcxv<br><h1>������������� ����������</h1><div align="left"><a href="?psl=loged&do=auto&step=photo&id=194">������������� ����</a></div><div style="float: left; width: 370px; border-right: 1px dashed #e1e1e1"><h2>�������� ������:</h2>


<table border="0" width="370" cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td height="22" width="130">�����:</td>
		<td><select size="1" name="marke"  onchange="getmo(this.value)" style="width: 200px"><option value="">- �������� -</option><option  value="44">Acura</option><option  value="55">Aixam</option><option  value="1">Alfa Romeo</option><option  value="56">Alpina</option><option  value="58">AMC</option><option  value="127">���</option><option  value="38">�����������</option><option  value="39">���</option></select>
		</td>
	</tr>
	</table>
</div>

<div style="float: right; width: 350px"><h2>����� �� ����������:</h2>

<table border="0" width="350" cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td height="22" width="130">����� ���������:</td>
		<td><input type="text" name="turis" value="" style="width: 200px"></td>
	</tr>
	<tr>
		<td height="22" width="130">������:</td>
		<td><input type="text" name="rida" value="" style="width: 150px"><select size="1" name="rtipas" style="width: 45px; margin: 0 0 0 5px"><option  selected  value="0">��</option><option  value="1">����</option></select></td>
	</tr><tr>
		<td height="22" width="130">����������� (���):</td>
		<td><select size="1" name="pavd" style="width: 202px"><option value="">- �������� -</option><option  value="1">��������������</option><option  value="2">���������������</option><option   value="3">������������</option></select></td>
	</tr><tr>
		<td height="22" width="130">����:</td>
		<td><input type="text" name="kaina" value="0" style="width: 150px"><select size="1" name="ktipas" style="width: 45px; margin: 0 0 0 5px"><option  selected   value="1">�</option><option   value="2">$</option></select></td>
	</tr><tr>
		<td height="22" width="130">������:</td>
		<td><input type="text" value="" name="vieta" style="width: 202px"><input type="hidden" name="insider" value="194"><input type="hidden" name="utype" value="f56e82798de1b89f7a4d77479ead7280"></td>
	</tr><tr>
		<td height="22" width="130">�����:</td>
		<td><input type="text" value="" name="miestas" style="width: 202px"></td>
	</tr><tr>
		<td height="22" width="130">������� ����:</td>
		<td><input type="file" name="dovana" style="width: 200px"></td>
	</tr><tr>
		<td height="22" width="130">������(for free):</td>
		<td><input type="text" name="slink" value="" style="width: 200px"></td>
	</tr><tr>
		<td height="22" width="130">�����:</td>
		<td><select name="akcija" style="width: 202px"><option  selected  value="0">�� ��������� � �����</option><option  value="1">���������� �����</option><option  value="2">���������� ��������</option></select></td>
	</tr></table>
	</div>
	
	<div style="clear: both"></div><h2 style="padding: 15px 0 0 0">�����:</h2>
	
	<table border="0" width="750" id="table4" cellpadding="1" style="border-collapse: collapse"><tr>
	<td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_1" style="border: 0" value="a1"></td><td width="225"><label for="priv_1">CD-�������������</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_2" style="border: 0" value="a2"></td><td width="225"><label for="priv_2">���</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_3" style="border: 0" value="a3"></td><td width="225"><label for="priv_3">�����������. �������</label></td></tr><tr><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_6" style="border: 0" value="a6"></td><td width="225"><label for="priv_6">���. �� ����� (�������)</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_7" style="border: 0" value="a7"></td><td width="225"><label for="priv_7">�������� ����.</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_8" style="border: 0" value="a8"></td><td width="225"><label for="priv_8">��������� �����</label></td></tr><tr><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_9" style="border: 0" value="a9"></td><td width="225"><label for="priv_9">�������������� ����</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_10" style="border: 0" value="a10"></td><td width="225"><label for="priv_10">������ �����</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_11" style="border: 0" value="a11"></td><td width="225"><label for="priv_11">������������</label></td></tr><tr><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_12" style="border: 0" value="a12"></td><td width="225"><label for="priv_12">�����������</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_13" style="border: 0" value="a13"></td><td width="225"><label for="priv_13">������-��������</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_14" style="border: 0" value="a14"></td><td width="225"><label for="priv_14">�������� �����</label></td></tr><tr><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_15" style="border: 0" value="a15"></td><td width="225"><label for="priv_15">�����������</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_5" style="border: 0" value="a5"></td><td width="225"><label for="priv_5">��������� ���</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_16" style="border: 0" value="a16"></td><td width="225"><label for="priv_16">�����-��������</label></td></tr><tr><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_17" style="border: 0" value="a17"></td><td width="225"><label for="priv_17">������</label></td><td width="25" align="center"><input type="checkbox"  checked  name="priv[]" id="priv_18" style="border: 0" value="a18"></td><td width="225"><label for="priv_18">����� �����</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_19" style="border: 0" value="a19"></td><td width="225"><label for="priv_19">���</label></td></tr><tr><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_37" style="border: 0" value="a37"></td><td width="225"><label for="priv_37">���������</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_20" style="border: 0" value="a20"></td><td width="225"><label for="priv_20">������� ������</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_22" style="border: 0" value="a22"></td><td width="225"><label for="priv_22">��������� ���</label></td></tr><tr><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_23" style="border: 0" value="a23"></td><td width="225"><label for="priv_23">������� ��� ������</label></td><td width="25" align="center"><input type="checkbox"  checked  name="priv[]" id="priv_24" style="border: 0" value="a24"></td><td width="225"><label for="priv_24">����������</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_21" style="border: 0" value="a21"></td><td width="225"><label for="priv_21">�������� �������</label></td></tr><tr><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_25" style="border: 0" value="a25"></td><td width="225"><label for="priv_25">������� ������������ ��������</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_26" style="border: 0" value="a26"></td><td width="225"><label for="priv_26">������� ������������ ���������</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_27" style="border: 0" value="a27"></td><td width="225"><label for="priv_27">������� ������������ �������</label></td></tr><tr><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_28" style="border: 0" value="a28"></td><td width="225"><label for="priv_28">������� ������������ �������</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_29" style="border: 0" value="a29"></td><td width="225"><label for="priv_29">��������������� ����</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_4" style="border: 0" value="a4"></td><td width="225"><label for="priv_4">���������</label></td></tr><tr><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_30" style="border: 0" value="a30"></td><td width="225"><label for="priv_30">������������</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_31" style="border: 0" value="a31"></td><td width="225"><label for="priv_31">���������������</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_32" style="border: 0" value="a32"></td><td width="225"><label for="priv_32">�����������</label></td></tr><tr><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_33" style="border: 0" value="a33"></td><td width="225"><label for="priv_33">����������� �����</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_34" style="border: 0" value="a34"></td><td width="225"><label for="priv_34">�/�������</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_35" style="border: 0" value="a35"></td><td width="225"><label for="priv_35">������. ����������������</label></td></tr><tr><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_36" style="border: 0" value="a36"></td><td width="225"><label for="priv_36">������������� ������</label></td>
	</table>
	
	<h2>��������� ����:</h2><table border="0" width="600" id="table1" cellpadding="0" style="border-collapse: collapse">
		<tr>
		<td colspan="9" height="25"><b>�������</b></td>
	</tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">�������� ������</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="i_1" value="0" id="bb1_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb1_0" style="color:#0066CC">��������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_1" value="1" id="bb1_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb1_1" style="color:#009900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_1" value="2" id="bb1_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb1_2" style="color:#FF9900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_1" value="3" id="bb1_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb1_3" style="color:#FF0000">������</label></td>
	</tr><tr style="">
		<td style="padding: 0 0 0 10px; ">�������� �������</td>
		<td width="20" style=""><input  checked  style="border: 0; " type="radio" name="i_2" value="0" id="bb2_0"></td>
		<td width="80" style=""><label for="bb2_0" style="color:#0066CC">��������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_2" value="1" id="bb2_1"></td>
		<td width="80" style=""><label for="bb2_1" style="color:#009900">�������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_2" value="2" id="bb2_2"></td>
		<td width="80" style=""><label for="bb2_2" style="color:#FF9900">�������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_2" value="3" id="bb2_3"></td>
		<td width="80" style=""><label for="bb2_3" style="color:#FF0000">������</label></td>
	</tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">������</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="i_3" value="0" id="bb3_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb3_0" style="color:#0066CC">��������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_3" value="1" id="bb3_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb3_1" style="color:#009900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_3" value="2" id="bb3_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb3_2" style="color:#FF9900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_3" value="3" id="bb3_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb3_3" style="color:#FF0000">������</label></td>
	</tr><tr style="">
		<td style="padding: 0 0 0 10px; ">�����</td>
		<td width="20" style=""><input  checked  style="border: 0; " type="radio" name="i_4" value="0" id="bb4_0"></td>
		<td width="80" style=""><label for="bb4_0" style="color:#0066CC">��������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_4" value="1" id="bb4_1"></td>
		<td width="80" style=""><label for="bb4_1" style="color:#009900">�������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_4" value="2" id="bb4_2"></td>
		<td width="80" style=""><label for="bb4_2" style="color:#FF9900">�������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_4" value="3" id="bb4_3"></td>
		<td width="80" style=""><label for="bb4_3" style="color:#FF0000">������</label></td>
	</tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">����� �����</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="i_5" value="0" id="bb5_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb5_0" style="color:#0066CC">��������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_5" value="1" id="bb5_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb5_1" style="color:#009900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_5" value="2" id="bb5_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb5_2" style="color:#FF9900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_5" value="3" id="bb5_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb5_3" style="color:#FF0000">������</label></td>
	</tr><tr style="">
		<td style="padding: 0 0 0 10px; ">�������� ����� �����</td>
		<td width="20" style=""><input  checked  style="border: 0; " type="radio" name="i_6" value="0" id="bb6_0"></td>
		<td width="80" style=""><label for="bb6_0" style="color:#0066CC">��������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_6" value="1" id="bb6_1"></td>
		<td width="80" style=""><label for="bb6_1" style="color:#009900">�������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_6" value="2" id="bb6_2"></td>
		<td width="80" style=""><label for="bb6_2" style="color:#FF9900">�������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_6" value="3" id="bb6_3"></td>
		<td width="80" style=""><label for="bb6_3" style="color:#FF0000">������</label></td>
	</tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">������ ����� �����</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="i_7" value="0" id="bb7_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb7_0" style="color:#0066CC">��������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_7" value="1" id="bb7_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb7_1" style="color:#009900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_7" value="2" id="bb7_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb7_2" style="color:#FF9900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_7" value="3" id="bb7_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb7_3" style="color:#FF0000">������</label></td>
	</tr><tr style="">
		<td style="padding: 0 0 0 10px; ">�������</td>
		<td width="20" style=""><input  checked  style="border: 0; " type="radio" name="i_8" value="0" id="bb8_0"></td>
		<td width="80" style=""><label for="bb8_0" style="color:#0066CC">��������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_8" value="1" id="bb8_1"></td>
		<td width="80" style=""><label for="bb8_1" style="color:#009900">�������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_8" value="2" id="bb8_2"></td>
		<td width="80" style=""><label for="bb8_2" style="color:#FF9900">�������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_8" value="3" id="bb8_3"></td>
		<td width="80" style=""><label for="bb8_3" style="color:#FF0000">������</label></td>
	</tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">������ ������</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="i_9" value="0" id="bb9_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb9_0" style="color:#0066CC">��������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_9" value="1" id="bb9_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb9_1" style="color:#009900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_9" value="2" id="bb9_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb9_2" style="color:#FF9900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_9" value="3" id="bb9_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb9_3" style="color:#FF0000">������</label></td>
	</tr><tr style="">
		<td style="padding: 0 0 0 10px; ">������ �����</td>
		<td width="20" style=""><input  checked  style="border: 0; " type="radio" name="i_10" value="0" id="bb10_0"></td>
		<td width="80" style=""><label for="bb10_0" style="color:#0066CC">��������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_10" value="1" id="bb10_1"></td>
		<td width="80" style=""><label for="bb10_1" style="color:#009900">�������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_10" value="2" id="bb10_2"></td>
		<td width="80" style=""><label for="bb10_2" style="color:#FF9900">�������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_10" value="3" id="bb10_3"></td>
		<td width="80" style=""><label for="bb10_3" style="color:#FF0000">������</label></td>
	</tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">�������� ������ �����</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="i_11" value="0" id="bb11_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb11_0" style="color:#0066CC">��������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_11" value="1" id="bb11_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb11_1" style="color:#009900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_11" value="2" id="bb11_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb11_2" style="color:#FF9900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_11" value="3" id="bb11_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb11_3" style="color:#FF0000">������</label></td>
	</tr><tr style="">
		<td style="padding: 0 0 0 10px; ">������ ������ �����</td>
		<td width="20" style=""><input  checked  style="border: 0; " type="radio" name="i_12" value="0" id="bb12_0"></td>
		<td width="80" style=""><label for="bb12_0" style="color:#0066CC">��������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_12" value="1" id="bb12_1"></td>
		<td width="80" style=""><label for="bb12_1" style="color:#009900">�������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_12" value="2" id="bb12_2"></td>
		<td width="80" style=""><label for="bb12_2" style="color:#FF9900">�������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_12" value="3" id="bb12_3"></td>
		<td width="80" style=""><label for="bb12_3" style="color:#FF0000">������</label></td>
	</tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">��������</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="i_13" value="0" id="bb13_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb13_0" style="color:#0066CC">��������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_13" value="1" id="bb13_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb13_1" style="color:#009900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_13" value="2" id="bb13_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb13_2" style="color:#FF9900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_13" value="3" id="bb13_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb13_3" style="color:#FF0000">������</label></td>
	</tr><tr><td colspan="9" height="25"><b>������</b></td></tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">������</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="v_1" value="0" id="bb14_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb14_0" style="color:#0066CC">��������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="v_1" value="1" id="bb14_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb14_1" style="color:#009900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="v_1" value="2" id="bb14_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb14_2" style="color:#FF9900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="v_1" value="3" id="bb14_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb14_3" style="color:#FF0000">������</label></td>
	</tr><tr style="">
		<td style="padding: 0 0 0 10px; ">������ ��������</td>
		<td width="20" style=""><input  checked  style="border: 0; " type="radio" name="v_2" value="0" id="bb15_0"></td>
		<td width="80" style=""><label for="bb15_0" style="color:#0066CC">��������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="v_2" value="1" id="bb15_1"></td>
		<td width="80" style=""><label for="bb15_1" style="color:#009900">�������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="v_2" value="2" id="bb15_2"></td>
		<td width="80" style=""><label for="bb15_2" style="color:#FF9900">�������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="v_2" value="3" id="bb15_3"></td>
		<td width="80" style=""><label for="bb15_3" style="color:#FF0000">������</label></td>
	</tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">�����������</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="v_3" value="0" id="bb16_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb16_0" style="color:#0066CC">��������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="v_3" value="1" id="bb16_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb16_1" style="color:#009900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="v_3" value="2" id="bb16_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb16_2" style="color:#FF9900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="v_3" value="3" id="bb16_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb16_3" style="color:#FF0000">������</label></td>
	</tr><tr style="">
		<td style="padding: 0 0 0 10px; ">�������� �������</td>
		<td width="20" style=""><input  checked  style="border: 0; " type="radio" name="v_4" value="0" id="bb17_0"></td>
		<td width="80" style=""><label for="bb17_0" style="color:#0066CC">��������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="v_4" value="1" id="bb17_1"></td>
		<td width="80" style=""><label for="bb17_1" style="color:#009900">�������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="v_4" value="2" id="bb17_2"></td>
		<td width="80" style=""><label for="bb17_2" style="color:#FF9900">�������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="v_4" value="3" id="bb17_3"></td>
		<td width="80" style=""><label for="bb17_3" style="color:#FF0000">������</label></td>
	</tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">������������</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="v_5" value="0" id="bb18_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb18_0" style="color:#0066CC">��������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="v_5" value="1" id="bb18_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb18_1" style="color:#009900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="v_5" value="2" id="bb18_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb18_2" style="color:#FF9900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="v_5" value="3" id="bb18_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb18_3" style="color:#FF0000">������</label></td>
	</tr><tr style="">
		<td style="padding: 0 0 0 10px; ">������ �������</td>
		<td width="20" style=""><input  checked  style="border: 0; " type="radio" name="v_6" value="0" id="bb19_0"></td>
		<td width="80" style=""><label for="bb19_0" style="color:#0066CC">��������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="v_6" value="1" id="bb19_1"></td>
		<td width="80" style=""><label for="bb19_1" style="color:#009900">�������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="v_6" value="2" id="bb19_2"></td>
		<td width="80" style=""><label for="bb19_2" style="color:#FF9900">�������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="v_6" value="3" id="bb19_3"></td>
		<td width="80" style=""><label for="bb19_3" style="color:#FF0000">������</label></td>
	</tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">�����������</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="v_7" value="0" id="bb20_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb20_0" style="color:#0066CC">��������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="v_7" value="1" id="bb20_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb20_1" style="color:#009900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="v_7" value="2" id="bb20_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb20_2" style="color:#FF9900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="v_7" value="3" id="bb20_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb20_3" style="color:#FF0000">������</label></td>
	</tr><tr><td colspan="9" height="25"><b>��������</b></td></tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">���������</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="m_1" value="0" id="bb21_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb21_0" style="color:#0066CC">��������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="m_1" value="1" id="bb21_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb21_1" style="color:#009900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="m_1" value="2" id="bb21_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb21_2" style="color:#FF9900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="m_1" value="3" id="bb21_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb21_3" style="color:#FF0000">������</label></td>
	</tr><tr style="">
		<td style="padding: 0 0 0 10px; ">��������� �����</td>
		<td width="20" style=""><input  checked  style="border: 0; " type="radio" name="m_2" value="0" id="bb22_0"></td>
		<td width="80" style=""><label for="bb22_0" style="color:#0066CC">��������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="m_2" value="1" id="bb22_1"></td>
		<td width="80" style=""><label for="bb22_1" style="color:#009900">�������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="m_2" value="2" id="bb22_2"></td>
		<td width="80" style=""><label for="bb22_2" style="color:#FF9900">�������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="m_2" value="3" id="bb22_3"></td>
		<td width="80" style=""><label for="bb22_3" style="color:#FF0000">������</label></td>
	</tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">������� ����������</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="m_3" value="0" id="bb23_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb23_0" style="color:#0066CC">��������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="m_3" value="1" id="bb23_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb23_1" style="color:#009900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="m_3" value="2" id="bb23_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb23_2" style="color:#FF9900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="m_3" value="3" id="bb23_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb23_3" style="color:#FF0000">������</label></td>
	</tr><tr style="">
		<td style="padding: 0 0 0 10px; ">��������</td>
		<td width="20" style=""><input  checked  style="border: 0; " type="radio" name="m_4" value="0" id="bb24_0"></td>
		<td width="80" style=""><label for="bb24_0" style="color:#0066CC">��������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="m_4" value="1" id="bb24_1"></td>
		<td width="80" style=""><label for="bb24_1" style="color:#009900">�������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="m_4" value="2" id="bb24_2"></td>
		<td width="80" style=""><label for="bb24_2" style="color:#FF9900">�������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="m_4" value="3" id="bb24_3"></td>
		<td width="80" style=""><label for="bb24_3" style="color:#FF0000">������</label></td>
	</tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">����</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="m_5" value="0" id="bb25_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb25_0" style="color:#0066CC">��������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="m_5" value="1" id="bb25_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb25_1" style="color:#009900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="m_5" value="2" id="bb25_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb25_2" style="color:#FF9900">�������</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="m_5" value="3" id="bb25_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb25_3" style="color:#FF0000">������</label></td>
	</tr><tr style="">
		<td style="padding: 0 0 0 10px; ">�����������</td>
		<td width="20" style=""><input  checked  style="border: 0; " type="radio" name="m_6" value="0" id="bb26_0"></td>
		<td width="80" style=""><label for="bb26_0" style="color:#0066CC">��������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="m_6" value="1" id="bb26_1"></td>
		<td width="80" style=""><label for="bb26_1" style="color:#009900">�������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="m_6" value="2" id="bb26_2"></td>
		<td width="80" style=""><label for="bb26_2" style="color:#FF9900">�������</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="m_6" value="3" id="bb26_3"></td>
		<td width="80" style=""><label for="bb26_3" style="color:#FF0000">������</label></td>
	</tr><tr><td colspan="9" height="25"></td></tr><tr><td colspan="9" height="22"><b>�������������� ����������:</b></td></tr><tr><td colspan="9"><input type="hidden" name="izz" value="7"><textarea rows="5" name="info" style="width: 600px">xvcxv</textarea></td></tr><tr><td colspan="9" height="35" align="center"><input type="button" value="�������� ���������" onclick="location.href='step/change_it.php?point=1&sec=1&cid=194&uid=2&back=edit'"> <input type="button" value="�������� �����������" onclick="location.href='step/change_it.php?point=1&sec=0&cid=194&uid=2&back=edit'"> <input type="submit" value="��������!"></td></tr></table></form></div><div class="t_l"></div><div class="t_r"></div><div class="b_l"></div><div class="b_r"></div></div></div>

<div style="clear: both"></div>

<div id="footer"><div id="fl">�2010-2012 �Automixs�</div><div style="float: right; width: 785px; text-align: center; margin: 13px 0 0 0;"><a href="auctions.html">��������</a><a href="faq.html">������-�����</a><a href="reklama.html">�������</a><a href="partnrship.html">��������������</a><a href="about-us.html">� ��������</a><a href="contacts.html">��������</a></div>
</div>


</div>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-10877002-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>