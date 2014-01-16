<div style="float: left; width: 365px">
<?php 

$get_moto=mysql_query("Select * from `moto` where `onmain`='1' order by rand() LIMIT 0,3") or die(mysql_error());
$i=1;
while($zo=mysql_fetch_array($get_moto)) {
$moto_id = $zo['id'];
$get_ff=mysql_query("Select * from `foto` where `sid`='$moto_id' and `type`='2' order by `id` asc") or die(mysql_error());
$ftt=mysql_fetch_array($get_ff);
$foto = $ftt['url'];
$marke = $zo['marke'];
$modelis = $zo['modelis'];
$metai = $zo['metai'];
$kt = $zo['ktype'];
if ($kt == '1') { $kt ='€'; } else { $kt='$'; } 
$kaina = $zo['kaina'];
if (!empty($foto)) { $ft=$foto; } else { $ft=''; }
if ($i == '1') {
echo('<div style="float: left; width: 114px; height: 86px; margin: 0 14px 7px 0"><a title="'.$marke.' '.$modelis.', '.$metai.' - '.$kt.' '.$kaina.'" href="moto/show/'.$moto_id.'/"><img onmouseover="style.border=\'1px solid #990000\'" onmouseout="style.border=\'1px solid #cccccc\'" style="border: 1px solid #CCCCCC" src="phpThumb.php?src='.$ft.'&w=112&h=84&zc=1" width="112" height="84" alt="'.$marke.' '.$modelis.', '.$metai.' - '.$kt.' '.$kaina.'"></a></div>');

} else if ($i == '2') {
echo('<div style="float: right; width: 236px; height: 179px;"><a title="'.$marke.' '.$modelis.', '.$metai.' - '.$kt.' '.$kaina.'" href="moto/show/'.$moto_id.'/"><img onmouseover="style.border=\'1px solid #990000\'" onmouseout="style.border=\'1px solid #cccccc\'" style="border: 1px solid #CCCCCC" src="phpThumb.php?src='.$ft.'&w=236&h=177&zc=1" width="236" height="177" alt="'.$marke.' '.$modelis.', '.$metai.' - '.$kt.' '.$kaina.'"></a></div>');

} else if ($i == '3') {
echo('<div style="float: left; width: 114px; height: 86px; margin: 0 14px 0 0"><a title="'.$marke.' '.$modelis.', '.$metai.' - '.$kt.' '.$kaina.'" href="moto/show/'.$moto_id.'/"><img onmouseover="style.border=\'1px solid #990000\'" onmouseout="style.border=\'1px solid #cccccc\'" style="border: 1px solid #CCCCCC" src="phpThumb.php?src='.$ft.'&w=112&h=84&zc=1" width="112" height="84" alt="'.$marke.' '.$modelis.', '.$metai.' - '.$kt.' '.$kaina.'"></a></div>');

}
$i++;
}

?>

</div>


<div style="float: right; width: 365px">
<?php 

$get_moto=mysql_query("Select * from `valtis` where `onmain`='1' order by rand() LIMIT 0,3") or die(mysql_error());
$i=1;
while($zo=mysql_fetch_array($get_moto)) {
$moto_id = $zo['id'];
$get_ff=mysql_query("Select * from `foto` where `sid`='$moto_id' and `type`='3' order by `id` asc") or die(mysql_error());
$ftt=mysql_fetch_array($get_ff);
$foto = $ftt['url'];
$marke = $zo['gamintojas'];
$modelis = $zo['pav'];
$metai = $zo['metai'];
$kt = $zo['ktype'];
if ($kt == '1') { $kt ='€'; } else { $kt='$'; } 
$kaina = $zo['kaina'];
if (!empty($foto)) { $ft=$foto; } else { $ft=''; }
if ($i == '2') {
echo('<div style="float: right; width: 114px; height: 86px; margin: 0 0 7px 14px"><a title="'.$marke.' '.$modelis.', '.$metai.' - '.$kt.' '.$kaina.'" href="boat/show/'.$moto_id.'/"><img onmouseover="style.border=\'1px solid #990000\'" onmouseout="style.border=\'1px solid #cccccc\'" style="border: 1px solid #CCCCCC" src="phpThumb.php?src='.$ft.'&w=112&h=84&zc=1" width="112" height="84" alt="'.$marke.' '.$modelis.', '.$metai.' - '.$kt.' '.$kaina.'"></a></div>');

} else if ($i == '1') {
echo('<div style="float: left; width: 236px; height: 179px;"><a title="'.$marke.' '.$modelis.', '.$metai.' - '.$kt.' '.$kaina.'" href="boat/show/'.$moto_id.'/"><img onmouseover="style.border=\'1px solid #990000\'" onmouseout="style.border=\'1px solid #cccccc\'" style="border: 1px solid #CCCCCC" src="phpThumb.php?src='.$ft.'&w=236&h=177&zc=1" width="236" height="177" alt="'.$marke.' '.$modelis.', '.$metai.' - '.$kt.' '.$kaina.'"></a></div>');

} else if ($i == '3') {
echo('<div style="float: right; width: 114px; height: 86px; margin: 0 0 0 14px"><a title="'.$marke.' '.$modelis.', '.$metai.' - '.$kt.' '.$kaina.'" href="boat/show/'.$moto_id.'/"><img onmouseover="style.border=\'1px solid #990000\'" onmouseout="style.border=\'1px solid #cccccc\'" style="border: 1px solid #CCCCCC" src="phpThumb.php?src='.$ft.'&w=112&h=84&zc=1" width="112" height="84" alt="'.$marke.' '.$modelis.', '.$metai.' - '.$kt.' '.$kaina.'"></a></div>');

}
$i++;
}

?>

</div>
<div style="clear: both"></div>