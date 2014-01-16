<?php 
$get_autos=mysql_query("Select * from `auto` where `onmain`='1' and (`parduota`='0' or `parduota`='') order by rand() LIMIT 0,7");
$i=1;
while($roa=mysql_fetch_array($get_autos)) {
$marke = get_marke($roa['marke']);
$modelis = get_modelis($roa['modelis']);
$metai = $roa['metai'];
$ktype = $roa['ktype'];
if ($ktype == '1') { $ktype ='€'; } else { $ktype='$'; } 
$kaina = $roa['kaina'];
$sid = $roa['id'];
$fotz=mysql_query("Select * from `foto` where `type`='1' and `sid`='$sid' order by `id` asc LIMIT 0,1");
$toz=mysql_fetch_array($fotz);
$foto = $toz['url'];
if ($i == '4') {
echo('<div style="float: left; width:280px; margin: 0 10px 0 10px; height:252px; background: #FFFFFF; border: 1px solid #cccccc"><a title="'.$marke.' '.$modelis.', '.$metai.'" href="http://www.automixs.com/auto/show/'.$sid.'/"><img style="border: 1px solid #cccccc; margin: 12px 13px" onmouseover="style.border=\'1px solid #990000\'" onmouseout="style.border=\'1px solid #cccccc\'" alt="'.$marke.' '.$modelis.', '.$metai.'" src="phpThumb.php?src='.$foto.'&w=252&h=189"></a><div style="float: left; margin: 0 0 12px 13px; width: 150px"><a title="'.$marke.' '.$modelis.', '.$metai.'" class="sslink" href="http://www.automixs.com/auto/show/'.$sid.'/">'.$marke.' '.$modelis.', '.$metai.'</a></div><div style="float: right; margin: 0 13px 12px 0; color: #990000"><b>'.$ktype.' '.$kaina.'</b></div></div>');
} else {
if ($i == '1' || $i == '5') { echo('<div style="float: left;">'); } 
echo('<div style="width: 106px;"><a title="'.$marke.' '.$modelis.', '.$metai.' - '.$ktype.' '.$kaina.'" href="http://www.automixs.com/auto/show/'.$sid.'/"><img width="106" height="78" style="border: 1px solid #cccccc; '); if ($i==2 || $i==6) { echo " margin: 5px 0"; } else { } echo('" onmouseover="style.border=\'1px solid #990000\'" onmouseout="style.border=\'1px solid #cccccc\'" alt="'.$marke.' '.$modelis.', '.$metai.' - '.$ktype.' '.$kaina.'" src="phpThumb.php?src='.$foto.'&w=106&h=78"></a></div>');
if ($i == '3' || $i == '7') { echo('</div>'); }
}
$i++;
}
echo('<div style="clear: both"></div>');
?>