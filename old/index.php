<?php
session_start();

include('web.php'); mysqlconnect();
include('fnc.php');
$it = mysql_query('SET NAMES utf8'); 
$et = mysql_query('SET CHARACTER SET urf8');

$amixs = $_SESSION['amixs'];
if (isset($amixs)) {
$u_check=mysql_query("Select * from `users` where `ses`='$amixs'");
$okk=mysql_num_rows($u_check);
if ($okk == '0') { header("Location: /logout.php"); } else {
$uss=mysql_fetch_array($u_check);
$u_type = $uss['type'];
$uid = $uss['id'];
$login = $uss['login'];
$login_link = '<a href="my-account.html" style="color: #990000">'.$login.'</a>';
}
} else {
$login_link = '<a href="user.html">Login ⇒</a>';
$u_type ='a';
}
include('seo.php');

function ru_date($data) {
$data = explode("-", $data);
$met = $data['0'];
$men = $data['1'];
$dien = $data['2'];
$data = $dien."-".$men."-".$met;

return $data;
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html prefix="og: http://ogp.me/ns#">
<head>
<base href="http://www.automixs.com/">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php 
   $metai = $otas['metai'];
echo('<meta property="og:title" content="FOR SALE: '.$marke.' '.$modelis.', '.$metai.'"/>');
echo('<meta property="og:description" content="Click to view more details about that '.$marke.'."/>');
?>

<!--
<title>automixs.com - test <?php  echo $title; ?></title>
<meta name="Description" content="<?php  echo $description; ?>">
-->

<meta name="Keywords" content="<?php  echo $keywords; ?>">
<link href="main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.pngFix.js"></script> 
<?php  //<script type="text/javascript" src="/js/srSelect.js"></script> ?>
<script type="text/javascript" src="/js/srCheckbox.js"></script>
<script type="text/javascript" src="/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="/js/jScrollPane.js"></script>
<link rel="stylesheet" type="text/css" href="/js/jquery.fancybox.css" media="screen" />
<link rel="shortcut icon" href="favicon.ico">
<script type="text/javascript" src="/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="/js/jquery.fancybox-1.2.1.pack.js"></script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
<script src="/fckeditor/fckeditor.js"></script>
<script src="/ckeditor/ckeditor.js"></script>
<script type="text/javascript"> 
<!--
 
$(document).ready(function(){
	$("span#images a").fancybox();
	$('.scroll').jScrollPane({showArrows:true, scrollbarWidth: 13, arrowSize: 16});
 
	/* Движение анимированной линейки */
	var widthDiv = ($('a.m_item').eq(0).width()/1)*($('a.m_item').length);
	$('.move-obj').eq(0).css('width',widthDiv + 'px');
	var widthThreeDivRight = 0;
	var widthThreeDivLeft = ($('a.m_item').eq(0).width()/1)*($('a.m_item').length-6);
	var flag = true;
	
	$("a.arrow_r").click(function(){
		if(flag == true)
			if(widthThreeDivLeft > Math.abs($('.move-obj').eq(0).css('marginLeft').substring(0,$('.move-obj').eq(0).css('marginLeft').indexOf('px'))))
				{
					flag = false;
					$('.move-obj').eq(0).animate({'marginLeft':"-=122px"},400, "swing", function(){
						flag = true;
					});
				}
		return false;
	});
	$("a.arrow_l").click(function(){
		if(flag == true)
			if(widthThreeDivRight > $('.move-obj').eq(0).css('marginLeft').substring(0,$('.move-obj').eq(0).css('marginLeft').indexOf('px'))) {
				flag = false;
				$('.move-obj').eq(0).animate({marginLeft:"+=122px"},400,function(){
					flag = true;
				});
			}
		return false;
	});
	/* ///Движение анимированной линейки */
	
	/* Переключение пунктов описания авто */
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
				}
			}
		return false;
	});
	/* ////Переключение пунктов описания авто */
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
				}
			}
		return false;
	});
});
//-->
</script>

</head>

<body onload="use_it()">
<?php  if ($psl == 'auto' || $psl == 'moto' || $psl == 'boat' || $psl == 'plane' || $psl == 'machinery' || $psl == 'products' || $psl == 'spares') {
$id = $_GET['id'];
$code = substr(md5(uniqid(rand())), 0, 6);
?>
<script type="text/javascript">
    var secret = '<?php  echo $code; ?>';
 
function check_bad(f) {
	if (badv.email.value.length < 7 && badv.skype.value.length < 3) {
	badv.email.focus();
	alert('Пожалуйста заполните все поля');
	return false
	} else if (badv.koment.value.length < 7) {
	badv.koment.focus();
	alert('Пожалуйста заполните все поля');
	return false
	}
	else if (badv.code.value != secret) {
	badv.code.focus();
	alert('Неправильно введен код с картинки');
	return false
 
	}
}
 
</script>

<div id="inf" style="display: none; top:0; left: 0; position: absolute; margin: 200px 0 0 0; z-index: 10099; background: #FFFFFF; border: 1px solid #cccccc; height: auto; width: 600px; font-family: Verdana; font-size: 9pt; color: #666666">

<div style="height: 25px; width: 100%; background: #f0f0f0">

<div style="float: left; margin: 4px 0 0 10px; color: #990000"><b>Задать вопрос</b></div>

<div style="height: 25px; float: right; margin: 0 5px 0 0">

<a title="Закрыть" href="javascript:close_this()">
<img style="border: 0; margin: 3px 0 0 0" src="/images/close.gif"></a>

</div>

</div>

<div style="margin: 10px">

    <!--  Attribute name=badv is not allowed here ??? -->


<form method="post" action="/send_query.php" onsubmit="return check_bad(this)" name="badv" style="margin: 0 0 15px 0; padding: 0">

<table border="0" width="560" cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td width="250" style="padding: 2px 0 2px 0; line-height: 150%">Имя:<br><input type="text" style="width: 250px" name="name"></td>
		<td width="60"></td>
		<td width="250" style="padding: 2px 0 2px 0; line-height: 150%">Ваш email:<br><input type="text" style="width: 250px" name="email"></td>
	</tr>	<tr>
		<td width="250" style="padding: 2px 0 2px 0; line-height: 150%">Ваш скайп:<br><input type="text" style="width: 250px" name="skype"><input type="hidden" name="owner" value="<?php echo $savininko_email; ?>"></input></td>
		<td width="60"></td>
		<td width="250" style="padding: 2px 0 2px 0; line-height: 150%"><input type="hidden" value="/<?php echo $psl; ?>/show/<?php  echo $id; ?>/" name="backurl"><input type="hidden" name="scode" value="ms<?php  echo $code; ?>et"></td>
	</tr>
	<tr>
		<td colspan="3" style="padding: 2px 0 2px 0; line-height: 150%">Дополнительно:<br><textarea rows="3" name="koment" style="width: 560px"></textarea></td>
	</tr><tr>
		<td colspan="3" style="padding: 2px 0 2px 0; line-height: 150%;"><div style="float: left; margin: 0 20px 0 0; text-align: center"><img width="79" height="18" style="border: 1px solid #949494; margin: 19px 0 0 0"  src="/phpThumb.php?src=images/pad.gif&w=79&h=18&fltr[]=wmt|<?php  echo $code; ?>|5|C|101010||100&f=png"></div><div style="float: left; text-align: right">Код с картинки:<br><input type="text" name="code" size="12" maxlength="6"></div><div style="clear:both"></div></td>
	</tr>
	<tr><td></td>
		<td colspan="2" height="35" style="text-align: center" align="center"><div align="center" class="button">
    <div>
    <div><input type="submit" name="submit" value="Отправить"></div></div></div></td>
	</tr>
</table></form></div></div>


<div id="fr" style="display: none; z-index: 10099; background: #FFFFFF; border: 1px solid #cccccc; height: auto; width: 300px; font-family: Verdana; font-size: 9pt; color: #666666">
  <div style="height: 25px; width: 100%; background: #f0f0f0">
    <div style="float: left; margin: 4px 0 0 10px; color: #990000"><b>Показать другу</b></div>
	  <div style="height: 25px; float: right; margin: 0 5px 0 0">
      <a title="Закрыть" href="javascript:close_this()"><img style="border: 0; margin: 3px 0 0 0" src="/images/close.gif"></a>
	  </div>
	  </div>

<div style="margin: 10px">

<form method="post" action="/send_ff.php" name="badv" style="margin: 0 0 15px 0; padding: 0">

<table border="0" width="560" cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td width="250" style="padding: 2px 0 2px 0; line-height: 150%">Ваше имя:<br><input type="text" style="width: 250px" name="name"></td>
		</tr>
		<tr>
		<td width="250" style="padding: 2px 0 2px 0; line-height: 150%">Ваше email:<br><input type="text" style="width: 250px" name="email"></td>
	</tr><tr>
		<td width="250" style="padding: 2px 0 2px 0; line-height: 150%">Email друга:<br><input type="text" style="width: 250px" name="femail"><input type="hidden" value="/<?php echo $psl; ?>/show/<?php  echo $id; ?>/" name="backurl"></td></tr>
	<tr><td height="35"> <input type="submit" name="submit" value="Отправить"></td>
	</tr>
</table></form></div></div>


<div id="full" onclick="close_this()" style="display: none; opacity:0.7; z-index: 22; height: 100%; padding: 0; width: 100%; top:0; position: absolute; left: 0; background: #f0f0f0">
<a id="zvopros"> </a>
</div>

<!--
<div id="fulla" style="display: none; opacity:0.7; top:0; left: 0; position: absolute; height: 100; width: 100">
.
</div>

-->

<script lang="javascript"> 
$(window).resize(function detectScrollbar(){
  $('#fr').css({
    position:'fixed',
    left: ($(window).width() - $('#fr').outerWidth())/2,
    top: ($(window).height() - $('#fr').outerHeight())/2
  });

});

function vapros() {
//$(window).resize();
document.getElementById('inf').style.display='';
document.getElementById('fulla').style.display='';	
document.location.href='#zvopros';
}
function friend() {
        $(window).resize();
	document.getElementById('fr').style.display='';
	document.getElementById('fulla').style.display='';	
	document.location.href='#zvopros';
}
function close_this() {
	//var loadingas = document.getElementById('fulla');
	//loadingas.style.display = "none";	
	var loadingas1 = document.getElementById('inf');
	loadingas1.style.display = "none";	
	var loadingas2 = document.getElementById('fr');
	loadingas2.style.display = "none";	
	}
 
var plotis = screen.width;
var sbfleft = (plotis - 600) / 2;
var sbfleft2 = (plotis - 300) / 2;
document.getElementById('inf').style.left=sbfleft+'px';
document.getElementById('fr').style.left=sbfleft2+'px';
</script>	
<?php
}?>

<div align="center">
<div style="width: 990px; text-align: left">
<div id="adv_place"><div style="float: left; width: 190px; height: 90px;  background: #F8F8F8"><? include('adv_1.php'); ?></div><div style="float: left; width: 580px; height: 90px; margin: 0 0 0 15px; background: #F8F8F8"><? include('adv_2.php'); ?></div><div style="float: right; width: 190px; height: 90px;  background: #F8F8F8"><? include('adv_7.php'); ?></div>
<div style="clear: both"></div></div>
<div id="hmenu" style="margin: 0"><div style="float: left; margin: 11px 0 0 0; width: 800px;"><a href="/">Home</a><a href="show-all.html">Inventory</a><a href="order-car.html">Order Car</a><a href="news.html">News</a><a href="reklama.html">Advertising</a><a href="contacts.html">Contact Us</a></div><div id="user_log" style="padding: 11px 0 0 0"><?php  echo $login_link; ?></div>
<div style="clear: both"></div>
</div>
<!-- Logo   Automixs      -->
  <div style="float: left; width: 95px; margin: 0 0 3px 0"><div class="u_block">
<div style="text-align: center; padding: 5px 0; background:#fff url('images/u_block_c_01.gif') left top repeat-x; margin: 0; height: 30px">
<a href="/"><img src="/images/autmx-mini_logo.png" alt="Automixs" border="0" height="32" width="61"></a></div>
					<div class="t_l"></div><div class="t_r"></div><div class="b_l"></div><div class="b_r"></div>
				<div style="Clear: both"></div></div></div>
<div style="float: right; width: 890px; margin: 0 0 3px 0">
<div class="u_block">
<div style="text-align: center; padding: 5px 0; background:#fff url('images/u_block_c_01.gif') left top repeat-x; margin: 0; height: 30px">
<form method="get" action="?psl=find" style="margin: 0; padding: 0"><div style="margin: 6px 0 0 0"><input type="text" name="key" value="<?php $key = $_GET['key']; echo $key; ?>" style="width: 450px; margin: 0 10px 0 0"><select style="margin: 0 10px 0 0" size="1" name="kat" style="width: 150px">
<option value="0">Выберите где искать</option>
<?php 
$get_san=mysql_query("Select * from `sand_cat` where `on`='1' order by `ru` asc");
if ($psl == 'find') { $kat = $_GET['kat']; }
while($tol=mysql_fetch_array($get_san)) {
$surl = $tol['url'];
$sname = stripslashes($tol['ru']);
echo('<option '); if ($kat == $surl) { echo " selected "; } else { } echo(' value="'.$surl.'">'.$sname.'</option>');

}

?>
</select><input type="hidden" name="psl" value="find"><input type="submit" style="color: #FFFFFF; border: 1px solid #cccccc; padding: 2px 15px; background: url(images/s_r_cost_bg.gif)"  name="submit" value="Найти"></div></form></div>
	<div class="t_l"></div><div class="t_r"></div><div class="b_l"></div><div class="b_r"></div>
				<div style="Clear: both"></div>
</div>
</div>
  <div style="clear: both"></div>
<?php  if ($psl !='' ) { ?>
<div id="lside" style="float: left; width: 190px; margin: 3px 0 0 0; padding: 0"><?php include('user_menu.php'); ?><?php  include('left_menu.php'); ?>
<div class="u_block" style="margin: 0; padding: 0">
<div class="u_block-cont" style="text-align: center; padding: 5px 0 0 0; margin: 0; height: auto">
<?php include('adv_4.php'); ?>
<div class="t_l"></div><div class="t_r"></div><div class="b_l"></div><div class="b_r"></div>
				<div style="Clear: both"></div></div></div>
</div>
<div id="content" style="float: right; width: 795px; margin: 0 0 5px 0">
<?php }

$psl = $_GET['psl']; 
if ($psl == '') { include('first.php'); } 
else if ($psl == 'auto') { include('ad_auto.php') ;} 
else if ($psl == 'moto') { include('ad_moto.php');} 
else if ($psl == 'boat') { include('ad_boat.php'); }
else if ($psl == 'plane') { include('ad_plane.php'); }
else if ($psl == 'machinery') { include('ad_machinery.php'); }
else if ($psl == 'spares') { include('ad_spares.php'); }
else if ($psl == 'products') { include('ad_products.php'); }
else if ($psl == 'list') { include('list.php'); } 
else if ($psl == 'search') { include('search.php'); }
else {
echo('<div class="u_block">
					<div class="u_block-cont">');		

					if ($psl == 'user') { include('user.php'); } 
					else if ($psl == 'restore') { include('restore.php'); }
					else if ($psl == 'app' && $u_type == 'f56e82798de1b89f7a4d77479ead7280') { include('apps.php'); }
					else if ($psl == 'news') { include('news.php'); }
					else if ($psl == 'faq') { include('faq.php'); }
				    else if ($psl == 'contacts') { include('contacts.php'); }
				    else if ($psl == 'order-car') { include('order-car.php'); }
				    else if ($psl == 'show-all') { include('show_all.php'); }
                     else if ($psl == 'loged' && $u_type == 'a') { include('user_spec.php'); }
				    else if ($psl == 'loged'  && strlen($u_type) == 32) { include('for-users.php'); }
				   else if ($psl == 'find') { include('find.php'); }
					else { 
					echo ('<div style="line-height: 150%">'.$text.'</div>');
					}
				echo('</div><div class="t_l"></div><div class="t_r"></div><div class="b_l"></div><div class="b_r"></div></div>');
				  } ?>
</div>

<div style="clear: both"></div>

<div id="footer"><div id="fl">©2010-<?php echo date('Y'); ?> «Automixs»</div><div style="float: right; width: 785px; text-align: center; margin: 13px 0 0 0;"><a href="auctions.html">Auctions</a><a href="faq.html">FAQs</a><a href="reklama.html">Advertising</a><a href="partnrship.html">Partnership</a><a href="about-us.html">About Company</a><a href="contacts.html">Contact Us</a></div>
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
<?php  mysqldisconnect(); ?>
</html>