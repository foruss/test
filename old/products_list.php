<div class="u_block"><div class="u_block-cont">
					<?php 
					$get_markes=mysql_query("Select distinct(kat) from `sk` order by `id` asc");
					while($mar=mysql_fetch_array($get_markes)) {
					$mk = $mar['kat'];
					$skk=mysql_num_rows(mysql_query("Select * from `sk` where `kat`='$mk'"));
					$get_minfo=mysql_query("Select * from `e_kat` where `id`='$mk'");
					$otx=mysql_fetch_array($get_minfo);
					$marke = $otx['name'];
					$url = $otx['url'];
					echo('<div style="float: left; width: 151px; height: 22px"><a title="'.$marke.'" href="list/'.$do.'/'.$url.'.html">'.$marke.'</a> <font style="color: #777777">('.$skk.')</font></div>');
				
					}
					?></div><div class="t_l"></div><div class="t_r"></div><div class="b_l"></div><div class="b_r"></div></div>
<?php 

$step = addslashes($_GET['step']);
if (!empty($step)) {
$get_mark=mysql_query("Select * from `e_kat` where `url`='$step'");
$tt=mysql_fetch_array($get_mark);
$mid = $tt['id'];
$where = " where `kat`='$mid'";
$plus = $step.".html";
} else {
$where =" ";
}


if (!isset($_GET['id']) || $_GET['id'] < 1) $nuo = 1;
else $nuo = $_GET['id'];
$kiek=10;


$sk = mysql_num_rows(mysql_query("Select * from `sk` ".$where.""));
$viso = intval($sk/$kiek);
if($sk%$kiek) $viso++;
if ($nuo > $viso) $nuo = 1;
$recordStart = ($nuo*$kiek)-$kiek;

$getitz=mysql_query("Select * from `sk` ".$where." order by `id` desc  LIMIT $recordStart, $kiek") or die(mysql_error());

while($roz=mysql_fetch_array($getitz)) {
$sid = $roz['id'];

$get_foto=mysql_query("Select * from `foto` where `sid`='$sid' and `type`='9' order by `id` asc");
$otl=mysql_fetch_array($get_foto);
$foto = $otl['url'];

$pav = stripslashes($roz['pav']);
$kaina = $roz['kaina'];

$tipas = stripslashes($roz['tipas']);
$ktype = $roz['ktype'];
$marke = $roz['marke'];
$modelis = $roz['modelis'];
if ($ktype == '1') { $kt = '€'; } else if ($ktype == '2') { $kt='$'; } 
echo('<div style="width: 785px; height: 118px; background: #F7F7F7; margin: 6px 0 0 0"><a title="'.$marke.' '.$modelis.'" href="products/show/'.$sid.'/"><div style="float: left; width: 174px"><img alt="'.$marke.' '.$modelis.'" src="phpThumb.php?src='.$foto.'&w=122&h=98&zc=1" onmouseover="style.border=\'1px solid #990000\'" onmouseout="style.border=\'1px solid #999999\'" width="122" height="98" style="border: 1px solid #999999; margin: 9px 7px;"></a></div>
<div style="float: left; width: 442px; margin: 9px 0 0 0"><div style="margin: 0 0 10px 0"><a title="'.$marke.' '.$modelis.'" class="sktop" href="products/show/'.$sid.'/">'.$marke.' '.$modelis.'</a></div>
<div style="clear: both"></div>
</div>
<div style="float: right; width: 169px"><div class="rrd">'.$kt.' '.$kaina.'</div></div>
</div>');

}

echo('<div style="margin: 15px 0 0 0" align="center">Страницы: '); 
$m2 = $nuo;
	if ($m2 > '1') {
$iz = $m2 - 1;
	echo('<a class="pager" href="'.$psl.'/'.$do.'/'.($nuo-1).'/'.$plus.'">«</a> ');
	$fn = $m2 - 5;
	if ($fn > '1') { echo('<a class="pager" href="'.$psl.'/'.$do.'/1/'.$plus.'">1</a> ... '); }
	if ($fn <='0') { $fn = 1; }
	$m2m = $m2 - 1;
	for($i=$fn; $i<=$m2m; $i++) {
	
	if  ($i == $m2) { echo '<font class="pagers">'.$m2.'</font> '; } else {
	echo('<a class="pager" href="'.$psl.'/'.$do.'/'.$i.'/'.$plus.'">'.$i.'</a> ');
	}
	}

	} if (is_numeric($m2)) { echo '<font class="pagers">'.$m2.'</font> '; }
	// i kita puse
	if ($m2 < $viso) {
	$fm = $m2 + 5;
	if ($fm > $viso) { $fm = $viso; }
	$m2n = $m2 + 1;
	for($i=$m2n; $i<=$fm; $i++) {
	if  ($i == '1') { echo '<font class="pagers">1</font> '; } else {
	echo('<a class="pager" href="'.$psl.'/'.$do.'/'.$i.'/'.$plus.'">'.$i.'</a> ');
	}
	} if ($m2 == '0' || $m2 == '') { $max2 = $m2 + 2; } else { $max2 = $m2 + 1; }
	if ($i < $viso) {
	echo('... <a class="pager" href="'.$psl.'/'.$do.'/'.$viso.'/'.$plus.'">'.$viso.'</a> ');
	}
	if ($i!='2') {
	echo('<a class="pager" href="'.$psl.'/'.$do.'/'.($nuo+1).'/'.$plus.'">»</a> ');
	}
	
	}

echo(' </div>');

?>