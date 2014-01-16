<?php 
$do = $_GET['do'];
$id = $_GET['id'];
if ($do == 'show' && is_numeric($id)) {
$metai = $otas['metai'];
echo('<div class="u_block"><div class="u_block-cont">');
echo('<h3 style="margin: 0 0 10px 0">'.$marke.' '.$modelis.', '.$metai.'</h3>');
$kaina = $otas['kaina'];
$ktype = $otas['ktype'];

$marke = $otas['gamintojas'];
$modelis = $otas['pav'];
$tipas = stripslashes($otas['tipas']);
$ilgis = stripslashes($otas['ilgis']);
$variklis = stripslashes($otas['variklis']);
$options = $otas['options'];
$dalnost = stripslashes($otas['dalnost']);
$maxaukstis = stripslashes($otas['maxaukstis']);
$maxgreitis = stripslashes($otas['maxgreitis']);
$bakas = stripslashes($otas['bakas']);
$propeleris = stripslashes($otas['propeleris']);
$maxsvoris = stripslashes($otas['maxsvoris']);
$splotas = stripslashes($otas['splotas']);
$sparnuilgis = stripslashes($otas['sparnuilgis']);
$aukstis = stripslashes($otas['aukstis']);

$title =  stripslashes($otas['title']);
$vin =  stripslashes($otas['vin']);
$pdeze =$otas['pdeze'];
if ($pdeze == '1') {
$pdeze ='Автоматическая';
} else if ($pdeze == '2') {
$pdeze='Комбинированная';
} else if ($pdeze == '3') {
$pdeze='Механическая';
}
$info = stripslashes($otas['info']);
$vieta = stripslashes($otas['vieta']);
if ($ktype == '1') { $kt = '$'; } else if ($ktype == '2') { $kt='€'; } 

$ffoto=mysql_query("Select * from `foto` where `sid`='$id' and `type`='4' order by `id` asc LIMIT 0,1");
$zor=mysql_fetch_array($ffoto);
$foto1 = $zor['url'];
echo('<div style="float: left; padding: 12px; height: 297px; border: 1px solid #cccccc; background: #FFFFFF; width: 358px; text-align: center;"><img src="phpThumb.php?src='.$foto1.'&w=358&h=269" alt="'.$marke.' '.$modelis.', '.$metai.' г." style="border: 1px solid #999999; margin: 0 0 10px 0"><br><font color="#990000" style="font-size: 11pt"><b>'.$kt.' '.$kaina.'</b></font></div>');

echo('<div style="float: right; width: 352px; position:relative; height: 315px; background: #FFFFFF; border: 1px solid #cccccc; padding: 6px">
<div class="scroll"><div class="s_m_cont">');

$gff=mysql_query("Select * from `foto` where `sid`='$id' and `type`='4' order by `id` asc");
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
									<td style="width:140px;"><strong>Год</strong>:</td>
								  <td><div><?php echo $metai; ?></div></td>
								</tr>
								<tr>
									<td><strong>Производитель:</strong></td>
								  <td><div><?php echo $marke; ?></div></td>
								</tr>
								<tr class="gr">
									<td><strong>Название:</strong></td>
								  <td><div><?php echo $modelis; ?></div></td>
								</tr>
								<tr>
									<td><strong>Тип:</strong></td>
									<td><div><?php echo $tipas; ?></div></td>
								</tr>
								<tr class="gr">
									<td><strong>Длина:</strong></td>
								  <td><div><?php echo $ilgis; ?></div></td>
								</tr>
								<tr>
									<td><strong>Высота:</strong></td>
									<td><div><?php echo $aukstis; ?></div></td>
								</tr>
								<tr class="gr">
									<td><strong>Размах крыла:</strong></td>
									<td><div><?php echo $sparnuilgis; ?></div></td>
								</tr>
								<tr>
									<td><strong>Площадь крыла:</strong></td>
									<td><div><?php echo $splotas; ?></div></td>
								</tr>
							<tr class="gr">
									<td><strong>Макс вес:</strong></td>
								  <td><div><?php echo $maxsvoris; ?></div></td>
								</tr>
									<tr>
									<td><strong>Двигатель:</strong></td>
									<td><div><?php echo $variklis; ?></div></td>
								</tr>
								<tr class="gr">
									<td><strong>Винт:</strong></td>
								  <td><div><?php echo $propeleris; ?></div></td>
								</tr>
									<tr>
									<td><strong>Емкость топливных баков:</strong></td>
									<td><div><?php echo $bakas; ?></div></td>
								</tr>	<tr class="gr">
									<td><strong>Макс скорость:</strong></td>
								  <td><div><?php echo $maxgreitis; ?></div></td>
								</tr><tr>
									<td><strong>Макс высота полета:</strong></td>
									<td><div><?php echo $maxaukstis; ?></div></td>
								</tr><tr class="gr">
									<td><strong>Дальность:</strong></td>
								  <td><div><?php echo $dalnost; ?></div></td>
								</tr><tr>
									<td><strong>VIN:</strong></td>
									<td><div><?php  echo $vin; ?></div></td>
								</tr><tr class="gr">
									<td><strong>Местонахождение:</strong></td>
								  <td><div><?php echo $vieta; ?></div></td>
								</tr>
							</table>		
						</div>
						<div class="t_l"></div><div class="t_r"></div><div class="b_l"></div><div class="b_r"></div>
					</div>
				
						<div class="u_block_gift" style="float:right; width:395px; height: 222px; margin-top:-2px;">
						<div class="u_block-cont" align="center">text</div>
						</div>											
					<div class="clear"></div>
			</div>
			<div style="clear: both"></div>
<div class="auto_info" style="margin: 0; padding: 15px 0 0 0">
					
					<!-- Меню информации об авто -->
					<ul class="a_i_menu" style="margin: 0; padding: 0">
                        <li class="act" id="d1"><a href="#"><span>Опции</span></a></li>
                        <li id="d2"><a href="#"><span>Дополнительная информация</span></a></li>
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
                                <h4 class="top">Опции</h4>
								
								<?php echo $otas['option'];
												?>
								</div>									
							</div>
							</div>
							
												<!-- Скроллинг описания 3 -->
							<div class="d_none"class="">
							<div class="a_i_desc">
								<div class="scroll">
							<h4 class="top">Дополнительная информация</h4>
<?php  echo $info; ?>
								</div>									
							</div>
							</div>
							<!--  -->
							<div class="d_none">
							<div class="a_i_desc" style="padding:0px;">
								<div class="scroll">
								<table border="0" width="100%" id="table1" cellpadding="0" style="border-collapse: collapse; margin: 10px 0 0 0">
	<tr>
		<td width="300" valign="top">
		<table border="0" width="275" style="border-collapse: collapse">
		<?php  
	$get_bukle=mysql_query("Select * from `mo_bukle` order by `ru` asc");
	$i=1;
	while($ggl=mysql_fetch_array($get_bukle)) {
$ru = $ggl['ru'];
$bukle = $otas["s".$i];
if ($bukle == '0') {
$buk = '<div style="padding: 2px; margin: 0 0 0 2px; height: 20; background: #0066cc; text-align: center; color: #FFFFFF">Отличное</div>';
} else if ($bukle == '1') {
$buk = '<div style="padding: 2px; margin: 0 0 0 2px; height: 20; background: #009900; text-align: center; color: #FFFFFF">Хорошее</div>';
} else if ($bukle == '2') {
$buk = '<div style="padding: 2px; margin: 0 0 0 2px; height: 20; background: #FF9900; text-align: center; color: #FFFFFF">Среднее</div>';
} if ($bukle == '3') {
$buk = '<div style="padding: 2px; margin: 0 0 0 2px; height: 20; background: #FF0000; text-align: center; color: #FFFFFF">Плохое</div>';
}
	echo('<tr><td align="right" width="145">'.$ru.'</td><td height="20">'.$buk.'</td></tr>');
	$i++;
	}
	?>
</table>
</td>
	</tr>
</table>
								
								
								</div></div></div>
							<div class="t_r"></div><div class="b_l"></div><div class="b_r"></div>
							</div></div>
				</div>
				<?php 
				$id = $otas['id'];
				$updazz=mysql_query("Update `plane` set `viewed`=viewed+1 where `id`='$id'");
}


?>