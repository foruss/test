<?php 

$key = addslashes($_GET['key']);
$kat = addslashes($_GET['kat']);

if ($kat == '0') {
$key = str_replace(" ", "%",$key);
$page_it=mysql_query("Select * from `text` where (`url` like '%$key%' or `title` like '%$key%') or (`keywords` like '%$key%' or `text` like'%$key%') or `description` like '%$key%'");
$page_2=mysql_query("Select * from `news` where `data` like '%$key%' or `title` like '%$key%' or `url` like '%$key%' or `text` like '%$key%' or `keywords` like '%$key%' or `description` like '%$key%'");
$page_3=mysql_query("Select * from `duk` where (`kl` like '%$key%' or `ats` like '%$key%') or `name` like '%$key%'");

$get_inf=mysql_query("Select * from `auto` where `vin` like '%$key%' or `vieta` like '%$key%' or `info` like '%$key%' or `tags` like '%$key%'");
$get_inf3=mysql_query("Select * from `valtis` where `vin` like'%$key%' or `vieta` like '%$key%' or `info` like '%$key%' or `gamintojas` like '%$key%' or `pav` like '%$key%' or `metai` like '%$key%'");
$get_inf6=mysql_query("Select * from `moto` where `marke` like'%$key%' or `modelis` like '%$key%' or `metai` like '%$key%' or `spalva` like '%$key%' or `spalva` like '%$key%' or `vieta` like '%$key%' or `info` like '%$key%'");

} else if ($kat == 'wrecked-cars') {
$key = str_replace(" ", "%",$key);
$get_inf2=mysql_query("Select * from `auto` where (`vin` like'%$key%' or `vieta` like '%$key%' or `info` like '%$key%' or `tags` like '%$key%') and kateg='1'");

} else if ($kat == 'wrecked-boats') {
$key = str_replace(" ", "%",$key);
$get_inf4=mysql_query("Select * from `valtis` where (`vin` like'%$key%' or `vieta` like '%$key%' or `info` like '%$key%' or `gamintojas` like '%$key%' or `pav` like '%$key%' or `metai` like '%$metai%') and kateg='1'");

} else if ($kat == 'wrecked-moto') {
$key = str_replace(" ", "%",$key);
$get_inf4=mysql_query("Select * from `moto` where (`marke` like'%$key%' or `modelis` like '%$key%' or `metai` like '%$key%' or `spalva` like '%$key%' or `spalva` like '%$key%' or `vieta` like '%$key%' or `info` like '%$key%') and kateg='1'");

} else if ($kat == 'cars') {
$key = str_replace(" ", "%",$key);
$get_inf=mysql_query("Select * from `auto` where (`vin` like'%$key%' or `vieta` like '%$key%' or `info` like '%$key%' or `tags` like '%$key%') and kateg='0'");

} else if ($kat == 'boats') {
$key = str_replace(" ", "%",$key);
$get_inf3=mysql_query("Select * from `valtis` where (`vin` like'%$key%' or `vieta` like '%$key%' or `info` like '%$key%' or `gamintojas` like '%$key%' or `pav` like '%$key%' or `metai` like '%$metai%') and kateg='0'");

} else if ($kat == 'moto') {
$key = str_replace(" ", "%",$key);
$get_inf4=mysql_query("Select * from `moto` where (`marke` like'%$key%' or `modelis` like '%$key%' or `metai` like '%$key%' or `spalva` like '%$key%' or `spalva` like '%$key%' or `vieta` like '%$key%' or `info` like '%$key%') and kateg='0'");



}
//echo('<i><font style="font-size: 11pt; color: #990000">Поиск временно недоступна.</font></i>');
if ($kat == 'cars') { 
$skk_o = mysql_num_rows($get_inf);
if ($skk_o == '0') {
 echo('<div align="center"><div style="margin: 10px 0; border: 1px dashed #990000; background: #f0d9d9; font-size: 10pt; line-height: 150%; padding: 5px 10px; color: #111111; text-align: center;"><b><font style="font-size: 11pt">По данным критериям поиска объявлений не найдено.</font></b><br>Попробуйте выполнить менее детальный поиск. Также предлагаем попробовать расширенный поиск.</div></div>');

} 
while($roz=mysql_fetch_array($get_inf)) {

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
$rtype = $roz['rtype'];
if ($rtype == '0') {
$rida .=" км";
} else {
 $rida .=" мили";
}
$turis=$roz['turis'];
$kaina = $roz['kaina'];
$ktype = $roz['ktype'];
if ($ktype == '1') { $kt = '€'; } else if ($ktype == '2') { $kt='$'; } 

$parduota = $roz['parduota'];
if ($parduota == '0' || empty($parduota)) {
$sold ='';
} else {
$sold ='url(images/sold.png) no-repeat';
}
$akcija = $roz['akcija'];
if ($akcija == '1' || $akcija == '2') {
$box='<div style="width: 42px; height: 42px; position: relative; top: -15px; left: -40px; background: url(images/box.jpg) no-repeat"></div>';
} else {
$box='';
}

echo('<div style="width: 760px; border-bottom: 1px dashed #e9e9e9; height: 118px; margin: 5px 0 0 0"><a title="'.$marke.' '.$modelis.', '.$metai.'" href="auto/show/'.$sid.'/"><div style="float: left; width: 174px"><img alt="'.$marke.' '.$modelis.', '.$metai.'" src="phpThumb.php?src='.$foto.'&w=122&h=98&zc=1" onmouseover="style.border=\'1px solid #990000\'" onmouseout="style.border=\'1px solid #999999\'" width="122" height="98" style="border: 1px solid #999999; margin: 9px 7px;"></a></div>
<div style="float: left; width: 442px; margin: 9px 0 0 0"><div style="margin: 0 0 10px 0"><a title="'.$marke.' '.$modelis.', '.$metai.'" class="sktop" href="auto/show/'.$sid.'/">'.$marke.' '.$modelis.', '.$metai.'</a></div>
<div style="float: left; width: 45px; text-align: right; height: 18px">Пробег:</div><div style="color: #990000; float: left; width: 390px; margin: 0 0 0 5px; height: 18px">'.$rida.'</div>
<div style="float: left; width: 45px; text-align: right; height: 18px">КП:</div><div style="color: #990000; float: left; width: 390px; margin: 0 0 0 5px; height: 18px">'.$pd.'</div>
<div style="float: left; width: 45px; text-align: right; height: 18px">ЦВЕТ:</div><div style="color: #990000; float: left; width: 390px; margin: 0 0 0 5px; height: 18px">'.$color.'</div>
<div style="float: left; width: 45px; text-align: right; height: 18px; padding: 2px 0 0 0">Объем:</div><div style="color: #990000; float: left; width: 390px; margin: 0 0 0 5px; height: 18px">'.$turis.' cm<sup>3</sup></div>
<div style="clear: both"></div>
</div>
<div style="float: right; width: 144px"><div class="rrd">'.$kt.' '.$kaina.'</div>'.$box.'</div>
</div>');

}

} else if ($kat == 'wrecked-cars') { 
$skk_o = mysql_num_rows($get_inf2);
if ($skk_o == '0') {
 echo('<div align="center"><div style="margin: 10px 0; border: 1px dashed #990000; background: #f0d9d9; font-size: 10pt; line-height: 150%; padding: 5px 10px; color: #111111; text-align: center;"><b><font style="font-size: 11pt">По данным критериям поиска объявлений не найдено.</font></b><br>Попробуйте выполнить менее детальный поиск. Также предлагаем попробовать расширенный поиск.</div></div>');

} 
while($roz=mysql_fetch_array($get_inf2)) {

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
$rtype = $roz['rtype'];
if ($rtype == '0') {
$rida .=" км";
} else {
 $rida .=" мили";
}
$turis=$roz['turis'];
$kaina = $roz['kaina'];
$ktype = $roz['ktype'];
if ($ktype == '1') { $kt = '€'; } else if ($ktype == '2') { $kt='$'; } 

$parduota = $roz['parduota'];
if ($parduota == '0' || empty($parduota)) {
$sold ='';
} else {
$sold ='url(images/sold.png) no-repeat';
}

$akcija = $roz['akcija'];
if ($akcija == '1' || $akcija == '2') {
$box='<div style="width: 42px; height: 42px; position: relative; top: -15px; left: -40px; background: url(images/box.jpg) no-repeat"></div>';
} else {
$box='';
}

echo('<div style="width: 760px; border-bottom: 1px dashed #e9e9e9; height: 118px; margin: 5px 0 0 0"><a title="'.$marke.' '.$modelis.', '.$metai.'" href="auto/show/'.$sid.'/"><div style="float: left; width: 174px"><img alt="'.$marke.' '.$modelis.', '.$metai.'" src="phpThumb.php?src='.$foto.'&w=122&h=98&zc=1" onmouseover="style.border=\'1px solid #990000\'" onmouseout="style.border=\'1px solid #999999\'" width="122" height="98" style="border: 1px solid #999999; margin: 9px 7px;"></a></div>
<div style="float: left; width: 442px; margin: 9px 0 0 0"><div style="margin: 0 0 10px 0"><a title="'.$marke.' '.$modelis.', '.$metai.'" class="sktop" href="auto/show/'.$sid.'/">'.$marke.' '.$modelis.', '.$metai.'</a></div>
<div style="float: left; width: 45px; text-align: right; height: 18px">Пробег:</div><div style="color: #990000; float: left; width: 390px; margin: 0 0 0 5px; height: 18px">'.$rida.'</div>
<div style="float: left; width: 45px; text-align: right; height: 18px">КП:</div><div style="color: #990000; float: left; width: 390px; margin: 0 0 0 5px; height: 18px">'.$pd.'</div>
<div style="float: left; width: 45px; text-align: right; height: 18px">ЦВЕТ:</div><div style="color: #990000; float: left; width: 390px; margin: 0 0 0 5px; height: 18px">'.$color.'</div>
<div style="float: left; width: 45px; text-align: right; height: 18px; padding: 2px 0 0 0">Объем:</div><div style="color: #990000; float: left; width: 390px; margin: 0 0 0 5px; height: 18px">'.$turis.' cm<sup>3</sup></div>
<div style="clear: both"></div>
</div>
<div style="float: right; width: 144px"><div class="rrd">'.$kt.' '.$kaina.'</div>'.$box.'</div>
</div>');

}


} else if ($kat == 'boats') {
$skk_o = mysql_num_rows($get_inf3);
if ($skk_o == '0') {
 echo('<div align="center"><div style="margin: 10px 0; border: 1px dashed #990000; background: #f0d9d9; font-size: 10pt; line-height: 150%; padding: 5px 10px; color: #111111; text-align: center;"><b><font style="font-size: 11pt">По данным критериям поиска объявлений не найдено.</font></b><br>Попробуйте выполнить менее детальный поиск. Также предлагаем попробовать расширенный поиск.</div></div>');

} 
while($roz=mysql_fetch_array($get_inf3)) {
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
$akcija = $roz['akcija'];
if ($akcija == '1' || $akcija == '2') {
$box='<div style="width: 42px; height: 42px; position: relative; top: -15px; left: -40px; background: url(images/box.jpg) no-repeat"></div>';
} else {
$box='';
}
if ($ktype == '1') { $kt = '€'; } else if ($ktype == '2') { $kt='$'; } 
echo('<div style="width: 760px; height: 118px; border-bottom: 1px dashed #e9e9e9; margin: 5px 0 0 0"><a title="'.$marke.' '.$modelis.', '.$metai.'" href="boat/show/'.$sid.'/"><div style="float: left; width: 174px"><img alt="'.$marke.' '.$modelis.', '.$metai.'" src="phpThumb.php?src='.$foto.'&w=122&h=98" onmouseover="style.border=\'1px solid #990000\'" onmouseout="style.border=\'1px solid #999999\'" width="122" height="98" style="border: 1px solid #999999; margin: 9px 7px;"></a></div>
<div style="float: left; width: 442px; margin: 9px 0 0 0"><div style="margin: 0 0 10px 0"><a title="'.$marke.' '.$modelis.', '.$metai.'" class="sktop" href="boat/show/'.$sid.'/">'.$marke.' '.$modelis.', '.$metai.'</a></div>
<div style="float: left; width: 65px; text-align: right; height: 18px">Тип:</div><div style="color: #990000; float: left; width: 370px; margin: 0 0 0 5px; height: 18px">'.$tipas.'</div>
<div style="float: left; width: 65px; text-align: right; height: 18px">Мест:</div><div style="color: #990000; float: left; width: 370px; margin: 0 0 0 5px; height: 18px">'.$vietu_sk.'</div>
<div style="float: left; width: 65px; text-align: right; height: 18px;">Двигатель:</div><div style="color: #990000; float: left; width: 370px; margin: 0 0 0 5px; height: 18px">'.$variklis.'</div>
<div style="clear: both"></div>
</div>
<div style="float: right; width: 144px"><div class="rrd">'.$kt.' '.$kaina.'</div>'.$box.'</div>
</div>');

}

} else if ($kat == 'wrecked-boats') {
$skk_o = mysql_num_rows($get_inf4);
if ($skk_o == '0') {
 echo('<div align="center"><div style="margin: 10px 0; border: 1px dashed #990000; background: #f0d9d9; font-size: 10pt; line-height: 150%; padding: 5px 10px; color: #111111; text-align: center;"><b><font style="font-size: 11pt">По данным критериям поиска объявлений не найдено.</font></b><br>Попробуйте выполнить менее детальный поиск. Также предлагаем попробовать расширенный поиск.</div></div>');

} 
while($roz=mysql_fetch_array($get_inf4)) {
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
$akcija = $roz['akcija'];
if ($akcija == '1' || $akcija == '2') {
$box='<div style="width: 42px; height: 42px; position: relative; top: -15px; left: -40px; background: url(images/box.jpg) no-repeat"></div>';
} else {
$box='';
}
if ($ktype == '1') { $kt = '€'; } else if ($ktype == '2') { $kt='$'; } 
echo('<div style="width: 760px; height: 118px; border-bottom: 1px dashed #e9e9e9; margin: 5px 0 0 0"><a title="'.$marke.' '.$modelis.', '.$metai.'" href="boat/show/'.$sid.'/"><div style="float: left; width: 174px"><img alt="'.$marke.' '.$modelis.', '.$metai.'" src="phpThumb.php?src='.$foto.'&w=122&h=98" onmouseover="style.border=\'1px solid #990000\'" onmouseout="style.border=\'1px solid #999999\'" width="122" height="98" style="border: 1px solid #999999; margin: 9px 7px;"></a></div>
<div style="float: left; width: 442px; margin: 9px 0 0 0"><div style="margin: 0 0 10px 0"><a title="'.$marke.' '.$modelis.', '.$metai.'" class="sktop" href="boat/show/'.$sid.'/">'.$marke.' '.$modelis.', '.$metai.'</a></div>
<div style="float: left; width: 65px; text-align: right; height: 18px">Тип:</div><div style="color: #990000; float: left; width: 370px; margin: 0 0 0 5px; height: 18px">'.$tipas.'</div>
<div style="float: left; width: 65px; text-align: right; height: 18px">Мест:</div><div style="color: #990000; float: left; width: 370px; margin: 0 0 0 5px; height: 18px">'.$vietu_sk.'</div>
<div style="float: left; width: 65px; text-align: right; height: 18px;">Двигатель:</div><div style="color: #990000; float: left; width: 370px; margin: 0 0 0 5px; height: 18px">'.$variklis.'</div>
<div style="clear: both"></div>
</div>
<div style="float: right; width: 144px"><div class="rrd">'.$kt.' '.$kaina.'</div>'.$box.'</div>
</div>');

}

} else if ($kat == 'moto') {
$skk_o = mysql_num_rows($get_inf4);
if ($skk_o == '0') {
 echo('<div align="center"><div style="margin: 10px 0; border: 1px dashed #990000; background: #f0d9d9; font-size: 10pt; line-height: 150%; padding: 5px 10px; color: #111111; text-align: center;"><b><font style="font-size: 11pt">По данным критериям поиска объявлений не найдено.</font></b><br>Попробуйте выполнить менее детальный поиск. Также предлагаем попробовать расширенный поиск.</div></div>');

} 
while($roz=mysql_fetch_array($get_inf4)) {
$sid = $roz['id'];

$get_foto=mysql_query("Select * from `foto` where `sid`='$sid' and `type`='2' order by `id` asc");
$otl=mysql_fetch_array($get_foto);
$foto = $otl['url'];
$marke = $roz['marke'];
$modelis = $roz['modelis'];
$metai = $roz['metai'];
$color = $roz['spalva'];
$pd = get_pd($roz['pdeze']);
$rida = $roz['rida'];
$rtype = $roz['rtype'];
if ($rtype == '0') {
$rida .=" км";
} else {
 $rida .=" мили";
}
$turis=$roz['turis'];
$kaina = $roz['kaina'];
$ktype = $roz['ktype'];
if ($ktype == '1') { $kt = '€'; } else if ($ktype == '2') { $kt='$'; } 
$akcija = $roz['akcija'];
if ($akcija == '1' || $akcija == '2') {
$box='<div style="width: 42px; height: 42px; position: relative; top: -15px; left: -40px; background: url(images/box.jpg) no-repeat"></div>';
} else {
$box='';
}
echo('<div style="width: 760px; height: 118px; border-bottom: 1px dashed #e9e9e9; margin: 5px 0 0 0"><a title="'.$marke.' '.$modelis.', '.$metai.'" href="moto/show/'.$sid.'/"><div style="float: left; width: 174px"><img alt="'.$marke.' '.$modelis.', '.$metai.'" src="phpThumb.php?src='.$foto.'&w=122&h=98&zc=1" onmouseover="style.border=\'1px solid #990000\'" onmouseout="style.border=\'1px solid #999999\'" width="122" height="98" style="border: 1px solid #999999; margin: 9px 7px;"></a></div>
<div style="float: left; width: 442px; margin: 9px 0 0 0"><div style="margin: 0 0 10px 0"><a title="'.$marke.' '.$modelis.', '.$metai.'" class="sktop" href="moto/show/'.$sid.'/">'.$marke.' '.$modelis.', '.$metai.'</a></div>
<div style="float: left; width: 45px; text-align: right; height: 18px">Пробег:</div><div style="color: #990000; float: left; width: 390px; margin: 0 0 0 5px; height: 18px">'.$rida.'</div>
<div style="float: left; width: 45px; text-align: right; height: 18px">ЦВЕТ:</div><div style="color: #990000; float: left; width: 390px; margin: 0 0 0 5px; height: 18px">'.$color.'</div>
<div style="float: left; width: 45px; text-align: right; height: 18px; padding: 2px 0 0 0">Объем:</div><div style="color: #990000; float: left; width: 390px; margin: 0 0 0 5px; height: 18px">'.$turis.' cm<sup>3</sup></div>
<div style="clear: both"></div>
</div>
<div style="float: right; width: 144px"><div class="rrd">'.$kt.' '.$kaina.'</div>'.$box.'</div>
</div>');


}


} else if ($kat == 'wrecked-moto') { 
$skk_o = mysql_num_rows($get_inf4);
if ($skk_o == '0') {
 echo('<div align="center"><div style="margin: 10px 0; border: 1px dashed #990000; background: #f0d9d9; font-size: 10pt; line-height: 150%; padding: 5px 10px; color: #111111; text-align: center;"><b><font style="font-size: 11pt">По данным критериям поиска объявлений не найдено.</font></b><br>Попробуйте выполнить менее детальный поиск. Также предлагаем попробовать расширенный поиск.</div></div>');

} 
while($roz=mysql_fetch_array($get_inf4)) {
$sid = $roz['id'];

$get_foto=mysql_query("Select * from `foto` where `sid`='$sid' and `type`='2' order by `id` asc");
$otl=mysql_fetch_array($get_foto);
$foto = $otl['url'];
$marke = $roz['marke'];
$modelis = $roz['modelis'];
$metai = $roz['metai'];
$color = $roz['spalva'];
$pd = get_pd($roz['pdeze']);
$rida = $roz['rida'];
$rtype = $roz['rtype'];
if ($rtype == '0') {
$rida .=" км";
} else {
 $rida .=" мили";
}
$turis=$roz['turis'];
$kaina = $roz['kaina'];
$ktype = $roz['ktype'];
if ($ktype == '1') { $kt = '€'; } else if ($ktype == '2') { $kt='$'; } 
$akcija = $roz['akcija'];
if ($akcija == '1' || $akcija == '2') {
$box='<div style="width: 42px; height: 42px; position: relative; top: -15px; left: -40px; background: url(images/box.jpg) no-repeat"></div>';
} else {
$box='';
}
echo('<div style="width: 760px; height: 118px; border-bottom: 1px dashed #e9e9e9; margin: 5px 0 0 0"><a title="'.$marke.' '.$modelis.', '.$metai.'" href="moto/show/'.$sid.'/"><div style="float: left; width: 174px"><img alt="'.$marke.' '.$modelis.', '.$metai.'" src="phpThumb.php?src='.$foto.'&w=122&h=98&zc=1" onmouseover="style.border=\'1px solid #990000\'" onmouseout="style.border=\'1px solid #999999\'" width="122" height="98" style="border: 1px solid #999999; margin: 9px 7px;"></a></div>
<div style="float: left; width: 442px; margin: 9px 0 0 0"><div style="margin: 0 0 10px 0"><a title="'.$marke.' '.$modelis.', '.$metai.'" class="sktop" href="moto/show/'.$sid.'/">'.$marke.' '.$modelis.', '.$metai.'</a></div>
<div style="float: left; width: 45px; text-align: right; height: 18px">Пробег:</div><div style="color: #990000; float: left; width: 390px; margin: 0 0 0 5px; height: 18px">'.$rida.'</div>
<div style="float: left; width: 45px; text-align: right; height: 18px">ЦВЕТ:</div><div style="color: #990000; float: left; width: 390px; margin: 0 0 0 5px; height: 18px">'.$color.'</div>
<div style="float: left; width: 45px; text-align: right; height: 18px; padding: 2px 0 0 0">Объем:</div><div style="color: #990000; float: left; width: 390px; margin: 0 0 0 5px; height: 18px">'.$turis.' cm<sup>3</sup></div>
<div style="clear: both"></div>
</div>
<div style="float: right; width: 144px"><div class="rrd">'.$kt.' '.$kaina.'</div>'.$box.'</div>
</div>');


}

} else {



mb_internal_encoding("UTF-8");

while($roz=mysql_fetch_array($get_inf)) {

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
$rtype = $roz['rtype'];
if ($rtype == '0') {
$rida .=" км";
} else {
 $rida .=" мили";
}
$turis=$roz['turis'];
$kaina = $roz['kaina'];
$ktype = $roz['ktype'];
if ($ktype == '1') { $kt = '€'; } else if ($ktype == '2') { $kt='$'; } 

$parduota = $roz['parduota'];
if ($parduota == '0' || empty($parduota)) {
$sold ='';
} else {
$sold ='url(images/sold.png) no-repeat';
}

$akcija = $roz['akcija'];
if ($akcija == '1' || $akcija == '2') {
$box='<div style="width: 42px; height: 42px; position: relative; top: -15px; left: -40px; background: url(images/box.jpg) no-repeat"></div>';
} else {
$box='';
}
echo('<div style="width: 760px; border-bottom: 1px dashed #e9e9e9; height: 118px; margin: 5px 0 0 0"><a title="'.$marke.' '.$modelis.', '.$metai.'" href="auto/show/'.$sid.'/"><div style="float: left; width: 174px"><img alt="'.$marke.' '.$modelis.', '.$metai.'" src="phpThumb.php?src='.$foto.'&w=122&h=98&zc=1" onmouseover="style.border=\'1px solid #990000\'" onmouseout="style.border=\'1px solid #999999\'" width="122" height="98" style="border: 1px solid #999999; margin: 9px 7px;"></a></div>
<div style="float: left; width: 442px; margin: 9px 0 0 0"><div style="margin: 0 0 10px 0"><a title="'.$marke.' '.$modelis.', '.$metai.'" class="sktop" href="auto/show/'.$sid.'/">'.$marke.' '.$modelis.', '.$metai.'</a></div>
<div style="float: left; width: 45px; text-align: right; height: 18px">Пробег:</div><div style="color: #990000; float: left; width: 390px; margin: 0 0 0 5px; height: 18px">'.$rida.'</div>
<div style="float: left; width: 45px; text-align: right; height: 18px">КП:</div><div style="color: #990000; float: left; width: 390px; margin: 0 0 0 5px; height: 18px">'.$pd.'</div>
<div style="float: left; width: 45px; text-align: right; height: 18px">ЦВЕТ:</div><div style="color: #990000; float: left; width: 390px; margin: 0 0 0 5px; height: 18px">'.$color.'</div>
<div style="float: left; width: 45px; text-align: right; height: 18px; padding: 2px 0 0 0">Объем:</div><div style="color: #990000; float: left; width: 390px; margin: 0 0 0 5px; height: 18px">'.$turis.' cm<sup>3</sup></div>
<div style="clear: both"></div>
</div>
<div style="float: right; width: 144px"><div class="rrd">'.$kt.' '.$kaina.'</div>'.$box.'</div>
</div>');

}

while($roz=mysql_fetch_array($get_inf3)) {
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
$akcija = $roz['akcija'];
if ($akcija == '1' || $akcija == '2') {
$box='<div style="width: 42px; height: 42px; position: relative; top: -15px; left: -40px; background: url(images/box.jpg) no-repeat"></div>';
} else {
$box='';
}
if ($ktype == '1') { $kt = '€'; } else if ($ktype == '2') { $kt='$'; } 
echo('<div style="width: 760px; height: 118px; border-bottom: 1px dashed #e9e9e9; margin: 5px 0 0 0"><a title="'.$marke.' '.$modelis.', '.$metai.'" href="boat/show/'.$sid.'/"><div style="float: left; width: 174px"><img alt="'.$marke.' '.$modelis.', '.$metai.'" src="phpThumb.php?src='.$foto.'&w=122&h=98" onmouseover="style.border=\'1px solid #990000\'" onmouseout="style.border=\'1px solid #999999\'" width="122" height="98" style="border: 1px solid #999999; margin: 9px 7px;"></a></div>
<div style="float: left; width: 442px; margin: 9px 0 0 0"><div style="margin: 0 0 10px 0"><a title="'.$marke.' '.$modelis.', '.$metai.'" class="sktop" href="boat/show/'.$sid.'/">'.$marke.' '.$modelis.', '.$metai.'</a></div>
<div style="float: left; width: 65px; text-align: right; height: 18px">Тип:</div><div style="color: #990000; float: left; width: 370px; margin: 0 0 0 5px; height: 18px">'.$tipas.'</div>
<div style="float: left; width: 65px; text-align: right; height: 18px">Мест:</div><div style="color: #990000; float: left; width: 370px; margin: 0 0 0 5px; height: 18px">'.$vietu_sk.'</div>
<div style="float: left; width: 65px; text-align: right; height: 18px;">Двигатель:</div><div style="color: #990000; float: left; width: 370px; margin: 0 0 0 5px; height: 18px">'.$variklis.'</div>
<div style="clear: both"></div>
</div>
<div style="float: right; width: 144px"><div class="rrd">'.$kt.' '.$kaina.'</div>'.$box.'</div>
</div>');

}


while($roz=mysql_fetch_array($get_inf6)) {
$sid = $roz['id'];

$get_foto=mysql_query("Select * from `foto` where `sid`='$sid' and `type`='2' order by `id` asc");
$otl=mysql_fetch_array($get_foto);
$foto = $otl['url'];
$marke = $roz['marke'];
$modelis = $roz['modelis'];
$metai = $roz['metai'];
$color = $roz['spalva'];
$pd = get_pd($roz['pdeze']);
$rida = $roz['rida'];
$rtype = $roz['rtype'];
if ($rtype == '0') {
$rida .=" км";
} else {
 $rida .=" мили";
}
$turis=$roz['turis'];
$kaina = $roz['kaina'];
$ktype = $roz['ktype'];
if ($ktype == '1') { $kt = '€'; } else if ($ktype == '2') { $kt='$'; } 
$akcija = $roz['akcija'];
if ($akcija == '1' || $akcija == '2') {
$box='<div style="width: 42px; height: 42px; position: relative; top: -15px; left: -40px; background: url(images/box.jpg) no-repeat"></div>';
} else {
$box='';
}
echo('<div style="width: 760px; height: 118px; border-bottom: 1px dashed #e9e9e9; margin: 5px 0 0 0"><a title="'.$marke.' '.$modelis.', '.$metai.'" href="moto/show/'.$sid.'/"><div style="float: left; width: 174px"><img alt="'.$marke.' '.$modelis.', '.$metai.'" src="phpThumb.php?src='.$foto.'&w=122&h=98&zc=1" onmouseover="style.border=\'1px solid #990000\'" onmouseout="style.border=\'1px solid #999999\'" width="122" height="98" style="border: 1px solid #999999; margin: 9px 7px;"></a></div>
<div style="float: left; width: 442px; margin: 9px 0 0 0"><div style="margin: 0 0 10px 0"><a title="'.$marke.' '.$modelis.', '.$metai.'" class="sktop" href="moto/show/'.$sid.'/">'.$marke.' '.$modelis.', '.$metai.'</a></div>
<div style="float: left; width: 45px; text-align: right; height: 18px">Пробег:</div><div style="color: #990000; float: left; width: 390px; margin: 0 0 0 5px; height: 18px">'.$rida.'</div>
<div style="float: left; width: 45px; text-align: right; height: 18px">ЦВЕТ:</div><div style="color: #990000; float: left; width: 390px; margin: 0 0 0 5px; height: 18px">'.$color.'</div>
<div style="float: left; width: 45px; text-align: right; height: 18px; padding: 2px 0 0 0">Объем:</div><div style="color: #990000; float: left; width: 390px; margin: 0 0 0 5px; height: 18px">'.$turis.' cm<sup>3</sup></div>
<div style="clear: both"></div>
</div>
<div style="float: right; width: 144px"><div class="rrd">'.$kt.' '.$kaina.'</div>'.$box.'</div>
</div>');


}

while($oz=mysql_fetch_array($page_it)) {
$title = stripslashes($oz['title']);
$url = $oz['url'];
$text = stripslashes($oz['text']);
$text =strip_tags($text);
$text = str_replace("  ", " ", $text);
$text = mb_substr($text, 0, 250)."...";
$url = 'www.automixs.com/'.$url.'.html';
echo('<div style="margin: 10px 0 0 0"><a style="font-weight: bold" href="http://'.$url.'">'.$title.'</a><br>'.$text.'<br><a style="font-size: 8pt; color: #42909d; margin: 4px 0 0 0; text-decoration: none" href="http://'.$url.'">'.$url.'</a></div>');
}

while($oz=mysql_fetch_array($page_2)) {
$title = stripslashes($oz['title']);
$url = $oz['url'];
$text = stripslashes($oz['text']);
$text =strip_tags($text);
$text = str_replace("  ", " ", $text);
$text = mb_substr($text, 0, 250)."...";
$url = 'www.automixs.com/news/'.$url.'.html';
echo('<div style="margin: 10px 0 0 0"><a style="font-weight: bold" href="http://'.$url.'">'.$title.'</a><br>'.$text.'<br><a style="font-size: 8pt; color: #42909d; margin: 4px 0 0 0; text-decoration: none" href="http://'.$url.'">'.$url.'</a></div>');
}

while($oz=mysql_fetch_array($page_3)) {
$title = stripslashes($oz['kl']);
if (strlen($title) > 100) {
$title = mb_substr($title, 0, 100)."...";
}
$url = $oz['url'];
$text = stripslashes($oz['ats']);
$text =strip_tags($text);
$text = str_replace("  ", " ", $text);
$text = mb_substr($text, 0, 250)."...";
$url = 'www.automixs.com/faq.html';
echo('<div style="margin: 10px 0 0 0"><a style="font-weight: bold" href="http://'.$url.'">'.$title.'</a><br>'.$text.'<br><a style="font-size: 8pt; color: #42909d; margin: 4px 0 0 0; text-decoration: none" href="http://'.$url.'">'.$url.'</a></div>');
}


}

?>