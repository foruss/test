<?php 
include('web.php'); mysqlconnect();
$id = $_GET['id'];
$do = show;
include('fnc.php');

$get_inf=mysql_query("Select * from `auto` where `id`='$id'");
$otas=mysql_fetch_array($get_inf);
$marke = get_marke($otas['marke']);
$modelis = get_modelis($otas['modelis']);

$title = "- $marke $modelis";

$it = mysql_query('SET NAMES utf8'); 
$et = mysql_query('SET CHARACTER SET urf8');
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="http://www.automixs.com/">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>automixs.com <?php  echo $title; ?></title>
<meta name="Description" content="<?php  echo $description; ?>">
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

<script type="text/javascript"> 
<!--
 
$(document).ready(function(){
	$("span#images a").fancybox();
	$('.scroll').jScrollPane({showArrows:true, scrollbarWidth: 13, arrowSize: 16});
 
	/* Движение анимированной линейки */
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
				};
			};
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
				};
			};
		return false;
	});
});
//-->
</script>

</head><?php

echo('<div align="center"><div style="width: 675px; text-align: left">');
include('print_auto.php');
echo('</div></div>');
mysqldisconnect();

?>