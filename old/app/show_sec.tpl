<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{$title}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="author" content="J-lab.by" />
<meta name="keywords" content="{$keywords}" />
<meta name="description" content="{$description}" />
<link rel="stylesheet" type="text/css" href="/css/style.css" />
<script type="text/javascript" src="/js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="/js/jquery.pngFix.js"></script>
{*<script type="text/javascript" src="/js/srSelect.js"></script>*}
<script type="text/javascript" src="/js/srCheckbox.js"></script>
<script type="text/javascript" src="/js/innerh.js"></script>
<script type="text/javascript" src="/js/m_ajaxRefresher.js"></script>
<script type="text/javascript" src="/js/m_searchForm.js"></script>

<script type="text/javascript">
{literal}
<!--
$(document).ready(function(){
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
});
{/literal}
//-->
</script>
<script type="text/javascript">
{literal}
function changeModel(id) {
	 $.get('/app/json.php?id='+id,  function(data){
	  //alert("Data Loaded: " + data);
	  document.getElementById('make_feald').style.display="block";
	  document.getElementById('make_feald').innerHTML = data;
	  });
	};
{/literal}
</script>
</head>
<body>
{if $header_baner1.id!='' && $header_baner2.id!=''}
<div align="center" style="width: 100%; position: absolute;">
	<div align="center" style="margin-top: 0px; height: 23px; width: 1024px; z-index: 1000;">
	
	
		<a href="{$header_baner1.link}" title="" target="_blank"><img width="187" height="140" style="margin-left: 20px;" src="/imgbaners/{$header_baner1.id}.jpg" alt=""></a>
		<a href="{$header_baner2.link}" title="" target="_blank"><img width="773" height="140" alt="" src="/imgbaners/{$header_baner2.id}.jpg" style="margin-left: 20px; margin-right: 20px;"></a>
	</div>
</div>
{/if}
<!-- Контейнер для сайта -->
<div id="wrap">
	<div id="wrap_c">
	
		<!-- Основная часть страницы -->
		<div id="basis" {if $header_baner1.id!='' && $header_baner2.id!=''}style="padding-top:190px;"{/if}>
			
			<!-- Центральный столбец -->
			<div id="center-frame">
				
				<!-- Универсальный блок -->
				<div class="u_block left">
					<div class="u_block-cont">
					
					
			
						<div class="s-light" id="bl1" style="height:630px;">
							<div class="h2">Показать другу:</div>
							<form name="f1" action="" method="post">
							<input type="hidden" value="{$sect}" name="sect">
							<input type="hidden" value="{$id}" name="send">
							<table cellspacing="8" cellpadding="8">
							<tr><td><b>Ваше имя</b></td><td><input type="text" name="name_p"></td></tr>
							<tr><td><b>Ваше email</b></td><td><input type="text" name="email_1"></td></tr>
							<tr><td><b>Email друга</b></td><td><input type="text" name="email_2"></td></tr>
							<tr><td><input type="submit" value="&nbsp;Отправить&nbsp;"></td><td></td></tr>
							</table>
							</form>
							{$mm}
						</div>
						
						<!-- /Мини поиск -->
						
						
											
					</div>
					<div class="t_l"></div><div class="t_r"></div><div class="b_l"></div><div class="b_r"></div>
				</div>
				<!-- /Универсальный блок -->
				
			
				
				
			
{include file='blocks/rotatingblock.tpl'}
			</div>
			<!-- /Центральный столбец -->
			
{include file='blocks/leftcolumn.tpl'}			
		</div>
		<!-- /Основная часть страницы -->
{include file='blocks/topmenu.tpl'}		

{include file="blocks/footer.tpl"}