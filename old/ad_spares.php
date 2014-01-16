<?php 
$do = $_GET['do'];
$id = $_GET['id'];
if ($do == 'show' && is_numeric($id)) {
$metai = $otas['metai'];
echo('<div class="u_block"><div class="u_block-cont">');
echo('<h3 style="margin: 0 0 10px 0">'.$modelis.'</h3>');
$kaina = $otas['kaina'];
$ktype = $otas['ktype'];
$part = $otas['part'];
$marke = $otas['marke'];
$modelis = $otas['pav'];
$title =  stripslashes($otas['title']);
$sn =  stripslashes($otas['sn']);
$pdeze =$otas['pdeze'];
$akcija = $otas['akcija'];


//echo '<script type="text/javascript">alert("' . $ . '"); </script>'; 



$info = stripslashes($otas['info']);
$vieta = stripslashes($otas['vieta']);
if ($ktype == '1') { $kt = '$'; } else if ($ktype == '2') { $kt='€'; } 

$ffoto=mysql_query("Select * from `foto` where `sid`='$id' and `type`='8' order by `id` asc LIMIT 0,1");
$zor=mysql_fetch_array($ffoto);

$foto1 = $zor['url'];

echo('<link rel="image_src" href="http://www.automixs.com/'.$foto1.'" />');

$parduota = $otas['parduota'];
if ($parduota == '0' || empty($parduota)) { 
$sold_img ='images/blank.png';
} else {
$sold_img ='images/fsold.png';
}


echo('<div style="float: left; padding: 12px; height: 297px; border: 1px solid #cccccc; background: #FFFFFF; width: 358px; text-align: center;"><div style="border: 1px solid #999999; margin: 0 0 10px 0; background: url(phpThumb.php?src='.$foto1.'&w=358&h=269) no-repeat; width: 358px; height: 269px"><img src="'.$sold_img.'" alt="'.$marke.' '.$modelis.', '.$metai.' г."></div><font color="#990000" style="font-size: 11pt"><b>'.$kt.' '.$kaina.'</b></font></div>');


echo('<div style="float: right; width: 352px; position:relative; height: 315px; background: #FFFFFF; border: 1px solid #cccccc; padding: 6px">
<div class="scroll"><div class="s_m_cont">');

$gff=mysql_query("Select * from `foto` where `sid`='$id' and `type`='8' order by `id` asc");
$i = 1;
while($roz=mysql_fetch_array($gff)) {
$fot = $roz['url'];
echo('<span id="images" style="float:left; margin: 2px; height: 86px;" onmouseover="style.backgroundColor=\'#990000\'" onmouseout="style.backgroundColor=\'\'"><a href="phpThumb.php?src='.$fot.'&w=800" class="images"  rel="group" target="_blank" title="'.$marke.' '.$modelis.', '.$metai.' г."><img class="images" src="phpThumb.php?src='.$fot.'&w=98&h=78" height="78" width="98" style="border: 1px solid #999999; margin: 3px" alt="'.$marke.' '.$modelis.', '.$metai.' г." /></a></span>');

}
echo('</div></div></div>');
echo('<div style="clear: both"></div>');
echo('</div><div class="t_l"></div><div class="t_r"></div><div class="b_l"></div><div class="b_r"></div></div>');


?>				<!-- Центральное меню -->
				<div class="center_menu">
					<div class="c_m_l"><div class="c_m_r">
						<ul>
							<li><a class="ad_cm" href="javascript:friend()">Показать другу</a></li>
							<li><a class="ad_cm" href="javascript:vapros()">Задать вопрос</a></li>
							<li><a class="ad_cm" href="/print/9685/" target="_blank">Распечатать</a></li>
							<li class="end"><a class="ad_cm" href="/tampl_text.html" target="_blank">Таможенные сборы</a></li>
						</ul>
					</div></div>
				</div>
				<!-- /Центральное меню -->
			<div class="price_info">
					<!-- Универсальный блок -->
					<div class="u_block" style="padding: 0">
						<div class="u_block-cont" style="padding: 0">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><strong>lot#:</strong></td>
								  <td><div><?php echo $id; ?></div></td>
								</tr>
								<tr class="gr">
									<td style="width:140px;"><strong>part#</strong>:</td>
								  <td><div><?php echo $part; ?></div></td>
								</tr>
									<tr>
									<td><strong>Тип:</strong></td>
								  <td><div><?php echo $marke; ?></div></td>
								</tr><tr class="gr">
									<td><strong>Название:</strong></td>
								  <td><div><?php echo $modelis; ?></div></td>
								</tr>
							</table>		
						</div>
						<div class="t_l"></div><div class="t_r"></div><div class="b_l"></div><div class="b_r"></div>
					</div>
				
						<div class="u_block_gift" style="float:right; width:395px; height: 222px; margin-top:-2px;">
						
<div class="u_block-cont" align="center"><?php 		if ($akcija == '1') {
						
						echo('<img src="images/1-icon.jpg" width="392" height="206" style="margin: 0 0 0 -10px">');
						
						} else if ($akcija == '2') {
							echo('<img src="images/2-icon.jpg" width="392" height="206" style="margin: 0 0 0 -10px">');
						} else {
						include('if_gift.php'); }
						
						?></div>
						</div>																		
					<div class="clear"></div>
			</div>
			<div style="clear: both"></div>
<div class="auto_info" style="margin: 0; padding: 15px 0 0 0">
					
					<!-- Меню информации об авто -->
					<ul class="a_i_menu" style="margin: 0; padding: 0">
                        <li class="act" id="d1"><a href="#"><span>Дополнительная Информация</span></a></li>                         
<!-- <li id="d2"><a href="#"><span> информация</span></a></li>-->

						<li id="d5">
						
						
						<!-- Блок PayPal -->

							<a href="#"><span onclick="window.open('https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=myautomix@gmail.com&item_name=<?php echo $marke;?>&item_number=<?php echo $id;?>&amount=50&currency_code=USD')">Оставить депозит</span></a></li>
					</ul>
	
				<div class="u_block left" style="margin: 0; padding: 0">
						<div class="u_block-cont">
							<!-- Скроллинг описания 1 -->
 
							<!-- /Скроллинг описания 1 -->
							<!-- Скроллинг описания 2 -->
							<div class="d_block">
							<div class="a_i_desc">
								<div class="scroll">
                                <h4 class="top">Информация</h4>
								
								<?php echo $otas['info'];
												?>
								</div>									
							</div>
							</div>
							
												<!-- Скроллинг описания 3 -->
							<div class="d_none"class="">
							<div class="a_i_desc">
								<div class="scroll">
							<h4 class="top">Заказать</h4>
<?php  echo $info; ?>
								</div>									
							</div>
							</div>
							<!--  -->
							<div class="d_none">
							<div class="a_i_desc" style="padding:0px;">
								<div class="scroll">

								
								
								</div></div></div>
							<div class="t_r"></div><div class="b_l"></div><div class="b_r"></div>
							</div></div>
				</div>
				<?php 
				$id = $otas['id'];
				$updazz=mysql_query("Update `dalys` set `viewed`=viewed+1 where `id`='$id'");
}


?>