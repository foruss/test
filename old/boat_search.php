<?php 

$marke = $_GET['bo_marke'];

$where = " where `id`!='0' ";
$m_url = '?psl=search';
if (is_numeric($marke)) {
$where .= " and `gamintojas` like '%$marke%' ";
$m_url ="&bo_marke=$marke";
}
$modelis = $_GET['bo_modelis'];
if (is_numeric($modelis)) {
$where .= " and `pav` like '%$modelis%' ";
$m_url .="&bo_modelis=$modelis";
}
$nuo = $_GET['bo_nuo'];
if (is_numeric($nuo)) {
$where .= " and `metai`>='$nuo' ";
$m_url .="&bo_nuo=$nuo";
}
$iki = $_GET['bo_iki'];
if (is_numeric($iki)) {
$where .= " and `metai`<='$iki' ";
$m_url .="&bo_iki=$iki";
}

$kat = $_GET['kat'];
if ($kat == 'wrecked-boats') {
$where .= " and `kateg`='1' ";
$m_url .="&kat=$kat";
}

if (!isset($_GET['id']) || $_GET['id'] < 1) $nuo = 1;
else $nuo = $_GET['id'];
$kiek=10;


$sk = mysql_num_rows(mysql_query("Select * from `valtis` ".$where.""));
if ($sk == '0') { echo('<script lang="javascript">document.location.href=\'\error.msg\';</script> '); }
$viso = intval($sk/$kiek);
if($sk%$kiek) $viso++;
if ($nuo > $viso) $nuo = 1;
$recordStart = ($nuo*$kiek)-$kiek;

$getitz=mysql_query("Select * from `valtis` ".$where." order by `id` desc LIMIT $recordStart, $kiek") or die(mysql_error());

while($roz=mysql_fetch_array($getitz)) {
$sid = $roz['id'];

$get_foto=mysql_query("Select * from `foto` where `sid`='$sid' and `type`='3' order by `id` asc");
$otl=mysql_fetch_array($get_foto);
$foto = $otl['url'];
$marke = $roz['gamintojas'];
$modelis = $roz['pav'];
$metai = $roz['metai'];
$variklis = $roz['variklis'];
$vietos = $roz['vietos'];
$tipas = $roz['tipas'];
$turis=$roz['turis'];
$kaina = $roz['kaina'];
$ktype = $roz['ktype'];
if ($ktype == '1') { $kt = '€'; } else if ($ktype == '2') { $kt='$'; } 
echo('<div style="width: 785px; height: 118px; background: #F7F7F7; margin: 6px 0 0 0"><a title="'.$marke.' '.$modelis.', '.$metai.'" href="boat/show/'.$sid.'/"><div style="float: left; width: 174px"><img alt="'.$marke.' '.$modelis.', '.$metai.'" src="phpThumb.php?src='.$foto.'&w=122&h=98" onmouseover="style.border=\'1px solid #990000\'" onmouseout="style.border=\'1px solid #999999\'" width="122" height="98" style="border: 1px solid #999999; margin: 9px 7px;"></a></div>
<div style="float: left; width: 442px; margin: 9px 0 0 0"><div style="margin: 0 0 10px 0"><a title="'.$marke.' '.$modelis.', '.$metai.'" class="sktop" href="boat/show/'.$sid.'/">'.$marke.' '.$modelis.', '.$metai.'</a></div>
<div style="float: left; width: 65px; text-align: right; height: 18px">Тип:</div><div style="color: #990000; float: left; width: 370px; margin: 0 0 0 5px; height: 18px">'.$tipas.'</div>
<div style="float: left; width: 65px; text-align: right; height: 18px">Мест:</div><div style="color: #990000; float: left; width: 370px; margin: 0 0 0 5px; height: 18px">'.$vietu_sk.'</div>
<div style="float: left; width: 65px; text-align: right; height: 18px;">Двигатель:</div><div style="color: #990000; float: left; width: 370px; margin: 0 0 0 5px; height: 18px">'.$variklis.'</div>
<div style="clear: both"></div>
</div>
<div style="float: right; width: 169px"><div class="rrd">'.$kt.' '.$kaina.'</div></div>
</div>');


}

echo('<div style="margin: 15px 0 0 0" align="center">Страницы: '); 
$m2 = $nuo;
	if ($m2 > '1') {
$iz = $m2 - 1;
	echo('<a class="pager" href="'.$m_url.'&id='.($nuo-1).'">«</a> ');
	$fn = $m2 - 5;
	if ($fn > '1') { echo('<a class="pager" href="'.$m_url.'&id=1">1</a> ... '); }
	if ($fn <='0') { $fn = 1; }
	$m2m = $m2 - 1;
	for($i=$fn; $i<=$m2m; $i++) {
	
	if  ($i == $m2) { echo '<font class="pagers">'.$m2.'</font> '; } else {
	echo('<a class="pager" href="'.$m_url.'&id='.$i.'">'.$i.'</a> ');
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
	echo('<a class="pager" href="'.$m_url.'&id='.$i.'">'.$i.'</a> ');
	}
	} if ($m2 == '0' || $m2 == '') { $max2 = $m2 + 2; } else { $max2 = $m2 + 1; }
	if ($i < $viso) {
	echo('... <a class="pager" href='.$m_url.'&id='.$viso.'">'.$viso.'</a> ');
	}
	if ($i!='2') {
	echo('<a class="pager" href="'.$m_url.'&id='.($nuo+1).'">»</a> ');
	}
	
	}

echo(' </div>');

?>