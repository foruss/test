<script lang="Javascript">

function sup_it(skg) {

	document.getElementById('f_1').style.background='';
	document.getElementById('f_1').style.color='#666666';
	document.getElementById('f_2').style.background='';
	document.getElementById('f_2').style.color='#666666';
	document.getElementById('f_4').style.background='';
	document.getElementById('f_4').style.color='#666666';
	document.getElementById('autos_1').style.display='none';
	document.getElementById('autos_2').style.display='none';
	document.getElementById('autos_4').style.display='none';
	
	document.getElementById('f_'+skg).style.background='#990000';
	document.getElementById('f_'+skg).style.color='#FFFFFF';
	document.getElementById('autos_'+skg).style.display='';
}

</script>

<div class="u_block">
<div class="u_block-cont">
<div style="border-bottom: 3px solid #990000; margin: 0 0 5px 0">
<div id="f_1" onclick="sup_it('1')" style="cursor: pointer; float: left; padding: 3px 10px; font-weight: bold; background: #990000; color: #FFFFFF">Новые</div><div onclick="sup_it('2')" id="f_2" style="cursor: pointer; float: left; font-weight: bold; cursor: pointer; padding: 3px 10px; border-left: 1px solid #990000; font-weight: bold; border-right: 1px solid #990000">Популярные</div><div id="f_4" onclick="sup_it('4')" style="cursor: pointer; font-weight: bold; float: left; padding: 3px 10px">Дорогие</div>
<div style="clear: both"></div>
</div>
<div id="autos_1">
<?php 
$getitz=mysql_query("Select * from `auto` where (`parduota`='0' or `parduota`='') order by `id` desc  LIMIT 0, 5") or die(mysql_error());
while($roz=mysql_fetch_array($getitz)) {
$sid = $roz['id'];

$get_foto=mysql_query("Select * from `foto` where `sid`='$sid' and `type`='1' order by `id` asc");
$otl=mysql_fetch_array($get_foto);
$foto = $otl['url'];
$marke = get_marke($roz['marke']);
$modelis = get_modelis($roz['modelis']);
$metai = $roz['metai'];
$color = get_color($roz['spalva']);
$pd = get_pd($roz['pdeze']);
$rida = $roz['rida'];
$turis=$roz['turis'];
$kaina = $roz['kaina'];
$ktype = $roz['ktype'];
$marke = $marke.' '.$modelis;
if (strlen($marke) > 18) {
$marke = substr("$marke", 0, 16)."...";
}
if ($ktype == '1') { $kt = '€'; } else if ($ktype == '2') { $kt='$'; } 
echo('<div style="float: left; width: 151px; text-align: center"><a title="'.$marke.' '.$modelis.', '.$metai.'" href="auto/show/'.$sid.'/" style="color: #666666; text-decoration: none"><img style="border: 1px solid #999999" onmouseover="style.border=\'1px solid #990000\'" onmouseout="style.border=\'1px solid #999999\'" src="phpThumb.php?src='.$foto.'&w=140&h=105&zc=1"><br><b>'.$marke.'</b></a><br>'.$kt.' '.$kaina.'</div>');

}
?>
<div style="clear: both"></div>
</div>
<div id="autos_2" style="display: none">
<?php 
$getitz=mysql_query("Select * from `auto`  where (`parduota`='0' or `parduota`='') order by `viewed` desc  LIMIT 0, 5") or die(mysql_error());
while($roz=mysql_fetch_array($getitz)) {
$sid = $roz['id'];

$get_foto=mysql_query("Select * from `foto` where `sid`='$sid' and `type`='1' order by `id` asc");
$otl=mysql_fetch_array($get_foto);
$foto = $otl['url'];
$marke = get_marke($roz['marke']);
$modelis = get_modelis($roz['modelis']);
$metai = $roz['metai'];
$color = get_color($roz['spalva']);
$pd = get_pd($roz['pdeze']);
$rida = $roz['rida'];
$turis=$roz['turis'];
$kaina = $roz['kaina'];
$ktype = $roz['ktype'];
$marke = $marke.' '.$modelis;
if (strlen($marke) > 18) {
$marke = substr("$marke", 0, 16)."...";
}
if ($ktype == '1') { $kt = '€'; } else if ($ktype == '2') { $kt='$'; } 
echo('<div style="float: left; width: 151px; text-align: center"><a title="'.$marke.' '.$modelis.', '.$metai.'" href="auto/show/'.$sid.'/" style="color: #666666; text-decoration: none"><img style="border: 1px solid #999999" onmouseover="style.border=\'1px solid #990000\'" onmouseout="style.border=\'1px solid #999999\'" src="phpThumb.php?src='.$foto.'&w=140&h=105&zc=1"><br><b>'.$marke.'</b></a><br>'.$kt.' '.$kaina.'</div>');

}
?>
<div style="clear: both"></div>
</div>
<div id="autos_4" style="display: none">
<?php 
$getitz=mysql_query("Select * from `auto` where (`parduota`='0' or `parduota`='') order by `kaina` desc  LIMIT 0, 5") or die(mysql_error());
while($roz=mysql_fetch_array($getitz)) {
$sid = $roz['id'];

$get_foto=mysql_query("Select * from `foto` where `sid`='$sid' and `type`='1' order by `id` asc");
$otl=mysql_fetch_array($get_foto);
$foto = $otl['url'];
$marke = get_marke($roz['marke']);
$modelis = get_modelis($roz['modelis']);
$metai = $roz['metai'];
$color = get_color($roz['spalva']);
$pd = get_pd($roz['pdeze']);
$rida = $roz['rida'];
$turis=$roz['turis'];
$kaina = $roz['kaina'];
$ktype = $roz['ktype'];
$marke = $marke.' '.$modelis;
if (strlen($marke) > 18) {
$marke = substr("$marke", 0, 16)."...";
}
if ($ktype == '1') { $kt = '€'; } else if ($ktype == '2') { $kt='$'; } 
echo('<div style="float: left; width: 151px; text-align: center"><a title="'.$marke.' '.$modelis.', '.$metai.'" href="auto/show/'.$sid.'/" style="color: #666666; text-decoration: none"><img style="border: 1px solid #999999" onmouseover="style.border=\'1px solid #990000\'" onmouseout="style.border=\'1px solid #999999\'" src="phpThumb.php?src='.$foto.'&w=140&h=105&zc=1"><br><b>'.$marke.'</b></a><br>'.$kt.' '.$kaina.'</div>');

}
?>
<div style="clear: both"></div>
</div>

</div><div class="t_l"></div><div class="t_r"></div><div class="b_l"></div><div class="b_r"></div></div>