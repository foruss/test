<?php 
$get_autos=mysql_query("Select * from `auto` order by `id` desc");
echo('<h1>Mailing List for Autos</h1>');
echo('<form method="post" action="snd_auto.php">');
echo('<table border="1" width="100%" id="table1" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#FFFFFF">
	<tr>
		<td height="23" bgcolor="#E0E0E0" height="25" width="25"></td>
		<td height="23" bgcolor="#E0E0E0" height="25" width="130" align="center"><b>Photo</b></td>
		<td height="23" bgcolor="#E0E0E0" height="25" width="60" align="center"><b>Year</b></td>
		<td height="23" bgcolor="#E0E0E0" height="25" align="center"><b>Мake/Model</b></td>
		<td height="23" bgcolor="#E0E0E0" height="25" width="100" align="center"><b>Price</b></td>
		<td height="23" bgcolor="#E0E0E0" height="25" width="110" align="center"><b>Miles</b></td>
		<td height="23" bgcolor="#E0E0E0" height="25" width="80" align="center"><b>Engine</b></td>
	</tr>');
while($viss=mysql_fetch_array($get_autos)) {
$metai = $viss['metai'];
$turis = $viss['turis'];
$marke = get_marke($viss['marke']);
$modelis = get_modelis($viss['modelis']);
$kaina = $viss['kaina'];
$kt = $viss['ktype'];
$rida = $viss['rida'];
$rtype = $viss['rtype'];
if ($rtype == '0') {
$rtype =' км';
} else {
$rtype =' мили';
}

if ($kt == '1') {
$kt ='€ ';
} else {
$kt ='$ ';
}
$sid = $viss['id'];
$get_foto=mysql_query("Select * from `foto` where `sid`='$sid' and `type`='1' order by `id` asc");
$otl=mysql_fetch_array($get_foto);
$foto = $otl['url'];

echo('<tr>
		<td bgcolor="#F1F1F1" width="25" align="center"><input type="checkbox" name="sk[]" value="'.$sid.'" style="border: 0; background: #f1f1f1"></td>
		<td bgcolor="#F1F1F1" width="130" align="center"><a target=_blank href="http://www.automixs.com/auto/show/'.$sid.'/"><img alt="'.$marke.' '.$modelis.', '.$metai.'" src="phpThumb.php?src='.$foto.'&w=122&h=98&zc=1" onmouseover="style.border=\'1px solid #990000\'" onmouseout="style.border=\'1px solid #999999\'" width="122" height="98" style="border: 1px solid #999999; margin: 4px 7px;"></a></td>
		<td bgcolor="#F1F1F1" align="center">'.$metai.'</td>
		<td bgcolor="#F1F1F1">&nbsp;&nbsp;<a target=_blank href="http://www.automixs.com/auto/show/'.$sid.'/">'.$marke.' '.$modelis.'</a></td>
		<td bgcolor="#F1F1F1" width="100" align="center">'.$kt.$kaina.'</td>
		<td bgcolor="#F1F1F1" width="110" align="center">'.$rida.''.$rtype.'</td>
		<td bgcolor="#F1F1F1" width="80" align="center">'.$turis.' cm<sup>3</sup></td>
	</tr>');

}

echo('</table>');
echo('<div style="margin: 5px 0 10px 0"><input type="checkbox" name="allUsers" value="1" style="border: 0" checked> <b><i>Send To All Users</i></b></div>');

echo('<b>Send To Additional Users:</b><br>
						<textarea cols="70" rows="10" name="to"></textarea><input type="hidden" name="scode" value="1311an"><br>
						<br><input type="submit" value="Send" name="submitSearch"/>');

echo('</form>');
?>