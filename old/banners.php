<?php 
$step = $_GET['step'];
if ($step == '') {
echo('<h1>Cписок банеров</h1>');
	echo('<div style="margin: 0 0 15px 0" align="center"><a class="menu" href="?psl=app&do=banners&step=new">Добавить банер</a><a style="margin: 0 0 0 15px" class="menu" href="?psl=app&do=banners&step=pos">Позиции</a></div>');
	
	
	echo('<div align="center"><table border="1" width="275" id="table1" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#E1E1E1">
	<tr>
		<td height="25" bgcolor="#F1F1F1" align="center"><b>Баннер отчетов</b></td>
	</tr>
	<tr><td height="22" style="padding: 0 0 0 5px"><a href="?psl=app&do=banners&step=show&pos=1"><b>1</b> позиция (190x90)</a></td></tr>
	<tr><td height="22" style="padding: 0 0 0 5px"><a href="?psl=app&do=banners&step=show&pos=2"><b>2</b> позиция (785x90)</a></td></tr>
	<tr><td height="22" style="padding: 0 0 0 5px"><a href="?psl=app&do=banners&step=show&pos=3"><b>3</b> позиция (340x168)</a></td></tr>
	<tr><td height="22" style="padding: 0 0 0 5px"><a href="?psl=app&do=banners&step=show&pos=4"><b>4</b> позиция (180x150)</a></td></tr>
	<tr><td height="22" style="padding: 0 0 0 5px"><a href="?psl=app&do=banners&step=show&pos=5"><b>5</b> позиция (140x140)</a></td></tr>
	<tr><td height="22" style="padding: 0 0 0 5px"><a href="?psl=app&do=banners&step=show&pos=6"><b>6</b> позиция (790x120)</a></td></tr>
</table></div>');

} else if ($step == 'new') {
if (!isset($_POST['submit'])) {
		?>
		<script lang="javascript">
		function remake(of) {
			if (of == '0') {
			document.getElementById('b1').style.display='none';	
			document.getElementById('b2').style.display='none';	
			document.getElementById('b3').style.display='none';	
			document.getElementById('b4').style.display='none';	
			} else if (of == '1' || of == '2') {
			document.getElementById('b1').style.display='';	
			document.getElementById('b2').style.display='';	
			document.getElementById('b3').style.display='none';	
			document.getElementById('b4').style.display='';	
			} else {
			document.getElementById('b1').style.display='none';	
			document.getElementById('b2').style.display='none';	
			document.getElementById('b3').style.display='';	
			document.getElementById('b4').style.display='none';		
			}
		}
		
		function whoit(oto) {
			if (oto == '0') {
			document.getElementById('a1').style.display='none';
			document.getElementById('a2').style.display='none';
			document.getElementById('a3').style.display='none';
			document.getElementById('a4').style.display='none';
			
			} else if (oto == '1') {
			document.getElementById('a1').style.display='';
			document.getElementById('a2').style.display='';	
			document.getElementById('a3').style.display='none';
			document.getElementById('a4').style.display='none';
			} else if (oto == '2') {
			document.getElementById('a1').style.display='none';
			document.getElementById('a2').style.display='none';
			document.getElementById('a3').style.display='';
			document.getElementById('a4').style.display='none';
			} else if (oto == '3') {
			document.getElementById('a1').style.display='none';
			document.getElementById('a2').style.display='none';
			document.getElementById('a3').style.display='none';
			document.getElementById('a4').style.display='';
			}
		}
		function cmat(om) {
			if (om == '') {
				fadv.mw.value ='';
				fadv.mh.value = '';
				document.getElementById('e1').style.display='none';
			} else if (om == 'a') {
				fadv.mw.value = '599';
				fadv.mh.value = '100';
				document.getElementById('e1').style.display='none';
			} else if (om == 'b' || om == 'c') {
				fadv.mw.value = '135';
				fadv.mh.value = '100';
				document.getElementById('e1').style.display='none';
			} else if (om == 'd') {
				fadv.mw.value = '213';
				fadv.mh.value = '190';
				document.getElementById('e1').style.display='';
			} else if (om == 'e') {
				fadv.mw.value = '592';
				fadv.mh.value = '100';
				document.getElementById('e1').style.display='none';
			} else if (om == 's') {
				fadv.mw.value = '750';
				fadv.mh.value = '100';
				document.getElementById('e1').style.display='none';
			}
			if (om == 'c') {
				document.getElementById('e1').style.display='';
			}

		}
		</script>
		<?
		$snd = date("Y-m-d");
		echo('<h1>Добавить банер</h1><div align="center"><form method="POST" name="fadv" enctype="multipart/form-data" action=""><table border="1" width="500" id="table1" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#E1E1E1">
	<tr>
		<td height="25" colspan="2" bgcolor="#F1F1F1">Новый баннер</td>
	</tr>
	<tr>
		<td height="22" style="padding: 0 2px 0 2px" width="120">Позиция:</td>
		<td height="22" align="center"><select onchange="cmat(this.value);" style="width: 360px" size="1" name="pos"><option value="">Выберите</option><option value="1">1 позиция (190x90)</option><option value="2">2 позиция (785x90)</option><option value="3">3 позиция (340x168)</option><option value="4">4 позиция (180x150)</option><option value="5">5 позиция (140x140)</option><option value="6">6 позиция (790x120)</option></select></td>
	</tr>	<tr>
		<td height="22" style="padding: 0 2px 0 2px" width="120">Язык:</td>
		<td height="22" align="center"><select style="width: 360px" size="1" onchange="patikra(fadv.pos.value, this.value)" name="lang"><option value="">Выберите</option><option selected value="ru">RU</option></select></td>
	</tr>
	<tr>
		<td height="22" style="padding: 0 2px 0 2px" width="120">Тип баннера:</td>
		<td height="22" align="center"><select onchange="remake(this.value)" style="width: 360px" size="1" name="type"><option value="0">Выберите</option><option value="1">Стандартный баннер (JPG/GIF/PNG/BMP)</option><option value="2">Flash баннер (SWF формат)</option><option value="3">JavaScript код объявления</option></select></td>
	</tr>
	<tr>
		<td height="22" style="padding: 0 2px 0 2px" width="120">Ограниченной:</td>
		<td height="22" align="center"><select style="width: 360px" onchange="whoit(this.value)" size="1" name="limit_by"><option value="">Выберите</option><option value="1">Ограниченная длительности</option><option value="2">Показы ограниченный</option><option value="3">Клики ограниченный</option></select></td>
	</tr>
	<tr id="a1" style="display: none">
		<td height="22" style="padding: 0 2px 0 2px" width="120">Начала показаня:</td>
		<td height="22"><input type="text" value="'.$snd.'" style="width: 180px; margin: 0 0 0 6px" name="sdata"></td>
	</tr><tr id="a2" style="display: none">
		<td height="22" style="padding: 0 2px 0 2px" width="120">Конец показаня:</td>
		<td height="22"><input type="text" value="" style="width: 180px; margin: 0 0 0 6px" name="edata"></td>
	</tr><tr id="a3" style="display: none">
		<td height="22" style="padding: 0 2px 0 2px" width="120">Предел просмотров:</td>
		<td height="22"><input type="text" style="width: 100px; margin: 0 0 0 6px" name="shows"><input type="text" style="width: 50px; border: 1px solid #FFFFFF" value="тыс."></td>
	</tr><tr id="a4" style="display: none">
		<td height="22" style="padding: 0 2px 0 2px" width="120">Предел кликов:</td>
		<td height="22"><input type="text" style="width: 180px; margin: 0 0 0 6px" name="clicks"></td>
	</tr><tr id="b1" style="display: none">
		<td height="22" style="padding: 0 2px 0 2px" width="120">Баннер:</td>
		<td height="22" align="center"><input type="file" name="ban" style="width: 360px"></td>
	</tr><tr id="b2" style="display: none">
		<td height="22" style="padding: 0 2px 0 2px" width="120">Cсылка:</td>
		<td height="22" align="center"><input type="text" style="width: 360px" name="url"></td>
	</tr><tr id="b4" style="display: none">
		<td height="22" style="padding: 0 2px 0 2px" width="120">Размер <font color="#999999">(ШxВ)*</font>:</td>
		<td height="22" align="left"><input type="text" name="mw" style="width: 40px; margin: 0 0 0 6px"><input style="border: 1px solid #FFFFFF; width: 10px" value="x" type="text"><input name="mh" type="text" style="width: 40px;"></td>
	</tr><tr id="b3" style="display: none">
		<td height="22" style="padding: 0 2px 0 2px" width="120">JavaScript код объявлений:</td>
		<td height="22" align="center"><textarea rows="3" name="script" style="width: 360px"></textarea></td>
	</tr><tr id="e1" style="display: none">
		<td height="22" style="padding: 0 2px 0 2px" width="120">Место в положение:</td>
		<td height="22" align="center"><select size="1" name="vieta" id="advv" style="width: 360px"><option value="">Выберите</option></select></td>
	</tr><tr><td height="35" align="center" colspan="2"><input type="submit" name="submit" value="Сохранить" class="button"></td></tr>
</table></form></div>* ШxВ - Ширина Высота в пикселях.');
	} else {
		$pos = $_POST['pos'];
		$lang = $_POST['lang'];
		$type = $_POST['type'];
		$shows = $_POST['shows'] * 1000;
		$sdata = $_POST['sdata'];
		$edata = $_POST['edata'];
		$limit_by = $_POST['limit_by'];
		$clicks = $_POST['clicks'];
		$place = $_POST['vieta'];
		$mw = $_POST['mw'];
		$mh = $_POST['mh'];
		// ban upload
$file_name = $_FILES['ban']['name'];
$logotype = $_FILES['ban'];
if (!empty($file_name)) {
$file_size = $_FILES['ban']['size'];
$file_type = $_FILES['ban']['type'];
$file_dir = "adv";
$tu = explode(".", $file_name);
$galune = array_pop($tu);
$max_file_size = 1024 * 9048;
$un = substr(md5(uniqid(rand())), 0, 5);
$file_destination = $file_dir . "/" . $un . "." . $galune;


$funkcija = move_uploaded_file ($logotype["tmp_name"], $file_destination);
$baneris = $file_destination;

} else {
	$baneris = '';
} 
//
$url = $_POST['url'];
$script = addslashes($_POST['script']);
if ($limit == '1') {
	$snd = date("Y-m-d");
	if ($sdata == $snd) {
		$on = '1';
	} else {
		$on = '0';
	}
} else { $on='1'; }
$reg = date("Y-m-d H:i:s");
$insa=mysql_query("Insert into `adv` set `pos`='$pos', `lang`='$lang', `on`='$on', `type`='$type', `reg`='$rdata', url`='$url', `source`='$script', `ban`='$baneris', `sdata`='$sdata', `edata`='$edata', `maxshow`='$shows', `maxclick`='$clicks', `width`='$mw', `height`='$mh', `ltype`='$limit_by'") or die(mysql_error());
echo('<script lang="javascript">window.location="?psl=app&do=banners&step=show&pos='.$pos.'&lang='.$lang.'"</script>');
}

} else if ($step == 'show') {

$pos = $_GET['pos'];
echo('<div align="center"><a class="menu" href="?psl=app&do=banners&step=new&pos='.$pos.'">Добавить банер</a></div>');

echo('<div align="center" style="margin: 15px 0 0 0">');
$simk=mysql_query("Select * from `adv` where `pos`='$pos' order by `id` asc");
while($ro=mysql_fetch_array($simk)) {
$type = $ro['type'];
$id = $ro['id'];

if ($type == '1') {
$ban = $ro['ban'];
$url = $ro['url'];
$title = stripslashes($ro['title']);
$width = $ro['width'];
$height= $ro['height'];
if ($width !='750') {
$baneris = '<a target=_blank title="'.$title.'" href="'.$url.'"><img border="0" alt="'.$title.'" width="'.$width.'" height="'.$height.'" src="'.$ban.'"></a>';
} else {
$baneris = '<a title="Baneris rodomas naujame lange" target=_blank href="show_adv.php?id='.$id.'">Показать баннер</a>';
}
} else if ($type == '2') {
$ban = $ro['ban'];
$width = $ro['width'];
$height= $ro['height'];

if ($width !='750') {
$baneris = '<object type="application/x-shockwave-flash" data="'.$ban.'" width="'.$width.'" height="'.$height.'"><param name="movie" value="'.$ban.'" /></object>';
} else {
$baneris = '<a title="Показать баннер в новом окне" target=_blank href="show_adv.php?id='.$id.'">Показать баннер</a>';
}

} else if ($type == '3') {
$script = stripslashes($ro['source']);
if ($pos !='1') {
$baneris = $script;
} else {
$baneris = '<a title="Показать баннер в новом окне" target=_blank href="show_adv.php?id='.$id.'">Показать баннер</a>';
}
} else if ($type == '4') {
$title = stripslashes($ro['title']);
$url = $ro['url'];
$baneris = '<a target=_blank href="'.$url.'">'.$title.'</a>';
}

//limitai
$ltype = $ro['ltype'];
if ($ltype == '1') {
$name_limit = 'Ограниченный срок ';
$sdata = $ro['sdata'];
$edata = $ro['edata'];
$riba =$sdata." - ".$edata;
} else if ($ltype == '2') {
$name_limit = 'Клики ограниченной ';
$maxclick = $ro['maxclick'];
$riba = $maxclick." p.";

} else if ($ltype == '3') {
$name_limit = 'Показов ограниченной ';
$maxshow = $ro['maxshow'];
$riba = $maxshow." p.";
}
$on = $ro['on'];
$reg = $ro['reg'];
if ($on == '0') { $status = '<a title="Показать" style="color: #cc0000" href="?psl=app&do=banners&step=ch&id='.$id.'&w=1&pos='.$pos.'">Не показано</a>'; } else if ($on == '1') {
$status = '<a title="Скрыть" style="color: #990000" href="?psl=app&do=banners&step=ch&id='.$id.'&w=0&pos='.$pos.'">Показано</a>'; 
}
$showed = $ro['showed'];
$clicked = $ro['clicked'];
echo('<table border="1" width="300" cellspacing="0" cellpadding="0" style="border-collapse: collapse; margin: 0 0 10px 0" bordercolor="#E1E1E1">
	<tr>
		<td align="center"><div style="margin: 5px">'.$baneris.'</div></td>
	</tr>
	<tr>
		<td><div style="float: left; width: 105px; margin: 2px 0 2px 5px; text-align: left">Размещено</div><div style="float: left; width: 185px; margin: 2px 0 2px 0; text-align: left">'.$reg.'</div><div style="clear: both"></div>
		<div style="float: left; width: 105px; margin: 0 0 2px 5px; text-align: left">Показан</div><div style="float: left; width: 185px; margin: 0 0 2px 0; text-align: left">'.$showed.' p.</div><div style="clear: both"></div>
		<div style="float: left; width: 105px; margin: 0 0 2px 5px; text-align: left">Кликов</div><div style="float: left; width: 185px; margin: 0 0 2px 0; text-align: left"><a title="Paspaudusiųjų ataskaita" target=_blank href="ataskaita.php?aid='.$id.'">'.$clicked.'</a> p.</div><div style="clear: both"></div>
		<div style="float: left; width: 105px; margin: 0 0 2px 5px; text-align: left">'.$name_limit.'</div><div style="float: left; width: 185px; margin: 0 0 2px 0; text-align: left">'.$riba.'</div><div style="clear: both"></div>
		</td>
	</tr>
	<tr>
		<td bgcolor="#F8F8F8" align="right"><div style="float: left; margin: 2px; font-size: 8pt"><a class="spc_m" href="?psl=app&do=banners&step=edit&id='.$id.'">Изменить</a> | <a class="spc_m" onClick="if(confirm(\'Вы уверены, что хотите удалить это объявление?\')); else return false;" href="?psl=app&do=banners&step=delete&pos='.$pos.'&id='.$id.'">Удалить</a></div><div style="float: right; margin: 2px;">'.$status.'</div></td>
	</tr>
</table>');
}
echo('</div>');

} else if ($step == 'edit') {
if (!isset($_POST['submit'])) {
		?>
		<script lang="javascript">
		function remake(of) {
			if (of == '0') {
			document.getElementById('b1').style.display='none';	
			document.getElementById('b2').style.display='none';	
			document.getElementById('b3').style.display='none';	
			document.getElementById('b4').style.display='none';	
			} else if (of == '1' || of == '2') {
			document.getElementById('b1').style.display='';	
			document.getElementById('b2').style.display='';	
			document.getElementById('b3').style.display='none';	
			document.getElementById('b4').style.display='';	
			} else {
			document.getElementById('b1').style.display='none';	
			document.getElementById('b2').style.display='none';	
			document.getElementById('b3').style.display='';	
			document.getElementById('b4').style.display='none';		
			}
		}
		
		function whoit(oto) {
			if (oto == '0') {
			document.getElementById('a1').style.display='none';
			document.getElementById('a2').style.display='none';
			document.getElementById('a3').style.display='none';
			document.getElementById('a4').style.display='none';
			
			} else if (oto == '1') {
			document.getElementById('a1').style.display='';
			document.getElementById('a2').style.display='';	
			document.getElementById('a3').style.display='none';
			document.getElementById('a4').style.display='none';
			} else if (oto == '2') {
			document.getElementById('a1').style.display='none';
			document.getElementById('a2').style.display='none';
			document.getElementById('a3').style.display='';
			document.getElementById('a4').style.display='none';
			} else if (oto == '3') {
			document.getElementById('a1').style.display='none';
			document.getElementById('a2').style.display='none';
			document.getElementById('a3').style.display='none';
			document.getElementById('a4').style.display='';
			}
		}
		function cmat(om) {
			if (om == '') {
				fadv.mw.value ='';
				fadv.mh.value = '';
				document.getElementById('e1').style.display='none';
			} else if (om == 'a') {
				fadv.mw.value = '599';
				fadv.mh.value = '100';
				document.getElementById('e1').style.display='none';
			} else if (om == 'b' || om == 'c') {
				fadv.mw.value = '135';
				fadv.mh.value = '100';
				document.getElementById('e1').style.display='none';
			} else if (om == 'd') {
				fadv.mw.value = '213';
				fadv.mh.value = '190';
				document.getElementById('e1').style.display='';
			} else if (om == 'e') {
				fadv.mw.value = '592';
				fadv.mh.value = '100';
				document.getElementById('e1').style.display='none';
			} else if (om == 's') {
				fadv.mw.value = '750';
				fadv.mh.value = '100';
				document.getElementById('e1').style.display='none';
			}
			if (om == 'c') {
				document.getElementById('e1').style.display='';
			}

		}
		
		function mco(om) {
			if (om == '') {
				document.getElementById('e1').style.display='none';
			} else if (om == 'a') {
				document.getElementById('e1').style.display='none';
			} else if (om == 'b' || om == 'c') {
				document.getElementById('e1').style.display='none';
			} else if (om == 'd') {
				document.getElementById('e1').style.display='';
			} else if (om == 'e') {
				document.getElementById('e1').style.display='none';
			} else if (om == 's') {
				document.getElementById('e1').style.display='none';
			}
			if (om == 'c') {
				document.getElementById('e1').style.display='';
			}

		}
		</script>
		<?

$id = $_GET['id'];
$get_info = mysql_query("Select * from `adv` where `id`='$id'");
$or=mysql_fetch_array($get_info);
$pos = $or['pos'];
$lang = $or['lang'];
$type = $or['type'];
$ltype = $or['ltype'];
$sdata = $or['sdata'];
$edata = $or['edata'];
$shows = $or['limit'] / 1000;
$climit = $or['climit'];
$src = $or['ban'];
$width = $or['width'];
$place = $or['place'];
$height= $or['height'];
$url = $or['link'];
$script = stripslashes($or['script']);

if (!empty($src)) {
if ($pos == '1' || $pos == '2' || $pos == '3') {
	$baneris = '<a target=_blank href="'.$src.'">Показать баннер</a> | <a  onClick="if(confirm(\'Вы уверены, что хотите удалить баннер?\')); else return false;" href="?psl=app&do=banners&step=remove_ban&id='.$id.'">Удалить баннер</a>';
} else {
	if ($type == '1') {
	$baneris = '<img style="margin: 5px" height="'.$height.'" width="'.$width.'" src="'.$src.'"><br><a  onClick="if(confirm(\'Вы уверены, что хотите удалить баннер?\')); else return false;" style="margin: 0 0 5px 0; font-size: 8pt" href="?psl=app&do=banners&step=remove_ban&id='.$id.'">Удалить баннер</a>';
	} else if ($type == '2') {
	$baneris = '<object width="'.$width.'" height="'.$height.'"><param name="movie" value="'.$src.'"><embed src="'.$src.'" width="'.$width.'" height="'.$height.'"></embed></object><br><a onClick="if(confirm(\'Вы уверены, что хотите удалить баннер?\')); else return false;" style="margin: 5px 0; font-size: 8pt" href="?psl=app&do=banners&step=remove_ban&id='.$id.'">Удалить баннер</a>';
	}
}
} else {
	$baneris ='<input type="file" name="ban" style="width: 360px">';
}

$ask=mysql_num_rows($get_info);
		echo('<body onload="mco(\''.$pos.'\'); remake(\''.$type.'\'); whoit(\''.$ltype.'\')"><h2>Изменить объявление</h2><div align="center"><form method="POST" name="fadv" enctype="multipart/form-data" action=""><table border="1" width="500" id="table1" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#E1E1E1">
	<tr>
		<td height="22" style="padding: 0 2px 0 2px" width="120">Позиция:</td>
		<td height="22" align="center"><select onchange="cmat(this.value);" style="width: 360px" size="1" name="pos"><option value="">Выберите</option><option '); if ($pos == '1') { echo " selected "; } else { } echo(' value="1">1 позиция (190x90)</option><option '); if ($pos == '2') { echo " selected "; } else { } echo(' value="2">2 позиция (785x90)</option><option '); if ($pos == '3') { echo " selected "; } else { } echo(' value="3">3 позиция (340x168)</option><option '); if ($pos == '4') { echo " selected "; } else { } echo(' value="4">4 позиция (180x150)</option><option '); if ($pos == '5') { echo " selected "; } else { } echo(' value="5">5 позиция (140x140)</option><option '); if ($pos == '6') { echo " selected "; } else { } echo(' value="6">6 позиция (790x120)</option></select></td>
	</tr>	<tr>
		<td height="22" style="padding: 0 2px 0 2px" width="120">Язык:</td>
		<td height="22" align="center"><select style="width: 360px" size="1" name="lang"><option value="">Выберите</option><option '); if ($lang == 'ru') { echo " selected "; } else { } echo(' value="ru">RU</option></select></td>
	</tr>
	<tr>
		<td height="22" style="padding: 0 2px 0 2px" width="120">Тип баннера:</td>
		<td height="22" align="center"><select onchange="remake(this.value)" style="width: 360px" size="1" name="type"><option value="0">Выберите</option><option '); if ($type == '1') { echo " selected "; } else { } echo(' value="1">Стандартный баннер (JPG/GIF/PNG/BMP)</option><option '); if ($type == '2') { echo " selected "; } else { } echo(' value="2">Flash баннер (SWF формат)</option><option '); if ($type == '3') { echo " selected "; } else { } echo(' value="3">JavaScript код объявления</option></select></td>
	</tr>
	<tr>
		<td height="22" style="padding: 0 2px 0 2px" width="120">Ограниченной:</td>
		<td height="22" align="center"><select style="width: 360px" onchange="whoit(this.value)" size="1" name="limit_by"><option value="">Выберите</option><option '); if ($ltype == '1') { echo " selected "; } else { } echo(' value="1">Ограниченная длительности</option><option '); if ($ltype == '2') { echo " selected "; } else { } echo(' value="2">Показы ограниченный</option><option '); if ($ltype == '3') { echo " selected "; } else { } echo(' value="3">Клики ограниченный</option></select></td>
	</tr>
	<tr id="a1" style="display: none">
		<td height="22" style="padding: 0 2px 0 2px" width="120">Начала показаня:</td>
		<td height="22"><input type="text" value="'.$sdata.'" style="width: 180px; margin: 0 0 0 6px" name="sdata"></td>
	</tr><tr id="a2" style="display: none">
		<td height="22" style="padding: 0 2px 0 2px" width="120">Конец показаня:</td>
		<td height="22"><input type="text" value="'.$edata.'" style="width: 180px; margin: 0 0 0 6px" name="edata"></td>
	</tr><tr id="a3" style="display: none">
		<td height="22" style="padding: 0 2px 0 2px" width="120">Предел просмотров:</td>
		<td height="22"><input value="'.$shows.'" type="text" style="width: 100px; margin: 0 0 0 6px" name="shows"><input type="text" style="width: 50px; border: 1px solid #FFFFFF" value="тыс."></td>
	</tr><tr id="a4" style="display: none">
		<td height="22" style="padding: 0 2px 0 2px" width="120">Предел кликов:</td>
		<td height="22"><input type="text" value="'.$climit.'" style="width: 180px; margin: 0 0 0 6px" name="clicks"></td>
	</tr><tr id="b1" style="display: none">
		<td height="22" style="padding: 0 2px 0 2px" width="120">Баннер:</td>
		<td height="22" align="center">'.$baneris.'</td>
	</tr><tr id="b2" style="display: none">
		<td height="22" style="padding: 0 2px 0 2px" width="120">Cсылка:</td>
		<td height="22" align="center"><input type="text" style="width: 360px" value="'.$url.'" name="url"></td>
	</tr><tr id="b4" style="display: none">
		<td height="22" style="padding: 0 2px 0 2px" width="120">Размер <font color="#999999">(ШxВ)*</font>:</td>
		<td height="22" align="left"><input type="text" name="mw" value="'.$width.'" style="width: 40px; margin: 0 0 0 6px"><input style="border: 1px solid #FFFFFF; width: 10px" value="x" type="text"><input name="mh" value="'.$height.'" type="text" style="width: 40px;"></td>
	</tr><tr id="b3" style="display: none">
		<td height="22" style="padding: 0 2px 0 2px" width="120">JavaScript код объявлений:</td>
		<td height="22" align="center"><textarea rows="3" name="script" style="width: 360px">'.$script.'</textarea></td>
	</tr><tr><td height="35" align="center" colspan="2"><input type="submit" name="submit" value="Сохранить" class="button"></td></tr>
</table></form></div>* ШxВ - Ширина Высота в пикселях.');
	} else {
		$pos = $_POST['pos'];
		$lang = $_POST['lang'];
		$type = $_POST['type'];
		$shows = $_POST['shows'] * 1000;
		$sdata = $_POST['sdata'];
		$edata = $_POST['edata'];
		$limit_by = $_POST['limit_by'];
		$clicks = $_POST['clicks'];
		$place = $_POST['vieta'];
		$mw = $_POST['mw'];
		$mh = $_POST['mh'];
		// ban upload
$file_name = $_FILES['ban']['name'];
$logotype = $_FILES['ban'];
if (!empty($file_name)) {
$file_size = $_FILES['ban']['size'];
$file_type = $_FILES['ban']['type'];
$file_dir = "adv";
$tu = explode(".", $file_name);
$galune = array_pop($tu);
$max_file_size = 1024 * 9048;
$un = substr(md5(uniqid(rand())), 0, 5);
$file_destination = $file_dir . "/" . $un . "." . $galune;



$funkcija = move_uploaded_file ($logotype["tmp_name"], "../".$file_destination);
$baneris = $file_destination;
$ban_src = " `src`='$file_destination', ";

} else {
	$ban_src = '';
} 
//
$url = $_POST['url'];
$script = addslashes($_POST['script']);
if ($limit == '1') {
	$snd = date("Y-m-d");
	if ($sdata == $snd) {
		$on = '1';
	} else {
		$on = '0';
	}
} else { $on='1'; }
$id = $_GET['id'];
$insa=mysql_query("Update `adv` set `pos`='$pos', `lang`='$lang', `place`='$place', `on`='$on', `type`='$type', `link`='$url', `script`='$script', ".$ban_src." `sdata`='$sdata', `edata`='$edata', `limit`='$shows', `climit`='$clicks', `width`='$mw', `height`='$mh', `ltype`='$limit_by' where `id`='$id'") or die(mysql_error());
echo('<script lang="javascript">window.location="?psl=adv&do=show&pos='.$pos.'&lang='.$lang.'"</script>');
}

} else if ($step == 'delete') {
$id = $_GET['id'];
//imam ban
$get_ban=mysql_query("Select * from `adv` where `id`='$id'");
$otl=mysql_fetch_array($get_ban);
$ban = $otl['ban'];
@unlink("../$ban");

//del it 
$delas=mysql_query("Delete from `adv` where `id`='$id'");
$del2=mysql_query("Delete from `clicker` where `aid`='$id'");
$pos = $_GET['pos'];
echo('<script type="text/javascript">window.location = "?psl=app&do=banners&pos='.$pos.'&step=show"</script>'); 
}
?>