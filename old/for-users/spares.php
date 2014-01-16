<?php
$step = $_GET['step'];

if ($step == '') {
echo('<h1>List of Parts</h1>');
$uid = $uss['id'];
?><script language="javascript">
function checkAll(){
	for (var i=0;i<document.f1.elements.length;i++)
	{
		var e=document.f1.elements[i];
		if (e.type=='checkbox')
		{
		document.f1.elements[i].checked;

		}

	}

}
</script>
<?php

$utype = $uss['type'];
$vipd = $uss['vip'];
$dabar = date("Y-m-d H:i:s");
if ($utype == 'f56e82798de1b89f7a4d77479ead7280' || $vipd >= $dabar) {
$spc = '911';
} else {
$spc ='0';
}
if ($utype == 'f56e82798de1b89f7a4d77479ead7280') {
echo('<form method="POST" style="margin: 0; padding: 0" action="loged/spares.html"><div style="margin: 0 0 10px 0; padding: 0 0 5px 0; border-bottom: 1px solid #e1e1e1">Search by Lot# <input type="text" style="width: 50px" name="lot"><input type="submit" name="submit" value="OK" style="margin: 0 5px 0 5px"></div></form>');

}
echo('<div align="center"><form method="post" name="f1" action=""><table border="1" width="'); if ($spc == '911') { echo "755"; } else { echo"690"; } echo('" cellpadding="0" style="border-collapse: collapse" bordercolor="#FFFFFF">
	<tr>
		<td style="background: url(images/qa_bg.gif) repeat-x; color: #FFFFFF" height="26" colspan="3" align="center">List of Parts</td>');
if ($spc == '911') {
echo('<td style="background: url(images/qa_bg.gif) repeat-x; color: #FFFFFF" height="26" width="65">Main Page</td>');
}

echo('<td style="background: url(images/qa_bg.gif) repeat-x; color: #FFFFFF" height="26" width="90" align="center">Views</td>
		<td style="background: url(images/qa_bg.gif) repeat-x; color: #FFFFFF" height="26" width="170" align="center">Manage Listing</td>
	</tr>');
$lot = $_POST['lot'];
if (is_numeric($lot) && $utype =='f56e82798de1b89f7a4d77479ead7280') {
$ka = "`id`='$lot'";
} else {
$ka ="`uid`='$uid'";
}
$get_autos=mysql_query("Select * from `dalys` where ".$ka." order by `id` desc");

while($zo=mysql_fetch_array($get_autos)) {
$pav = $zo['pav'];
$kat = $zo['kateg'];
$marke = $zo['marke'];
$modelis = $zo['modelis'];
$metai = $zo['metai'];
$kaina = $zo['kaina'];
$ktype = $zo['ktype'];
$viewed = $zo['viewed'];
$data = $zo['data'];
$data = explode(" ", $data);
$id = $zo['id'];
$data = $data['0'];
$parduota = $zo['parduota'];
$intop = $zo['onmain'];
if ($intop == '0') { $pp = '<b>-</b>'; } else if ($intop == '1') { $pp ='<font color="#30af0e"><b>+</b></font>'; }
if ($parduota == '0' || $parduota == '') { $sold= ''; } else { $sold ='<font color="#eb3200">(Sold)</font>'; }
if ($ktype == '1') { $kt = '$'; } else if ($ktype == '2') { $kt = '€'; }
echo('<tr onmouseover="style.backgroundColor=\'#f8f8f8\'" onmouseout="style.backgroundColor=\'\'">
		<td height="22" style="border-bottom: 1px solid #e1e1e1" width="22" align="center"><input type="checkbox" name="c[]" value="'.$id.'" style="border: 0; background: ;"></td>
		<td height="22" style="border-bottom: 1px solid #e1e1e1; text-align: left">&nbsp;<a target=_blank title="'.$pav.' - '.$kaina.' '.$kt.'" href="spares/show/'.$id.'/"><b>'.$pav.'</b> - '.$kaina.' '.$kt.'</a> '.$sold.'</td>
		<td width="140" style="font-size: 8pt; border-bottom: 1px solid #e1e1e1;">posted on: '.$data.'</td>');
if ($spc == '911') {
echo('<td height="22" style="border-bottom: 1px solid #e1e1e1" width="55" align="center">'.$pp.'</td>');
}

echo('<td height="22" style="border-bottom: 1px solid #e1e1e1" width="100" align="center">'.$viewed.'</td>
		<td height="22" width="170" align="center" style="font-size: 8pt; border-bottom: 1px solid #e1e1e1"><a href="?psl=loged&do=spares&step=edit&id='.$id.'">Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onClick="if(confirm(\'Are you sure you want to remove this Part?\')); else return false;" href="?psl=loged&do=spares&step=delete&id='.$id.'">Delete</a></td>
	</tr>');
}
echo('</table></div>');

echo('<div style="margin: 15px 0 0 30px"><input type="button" value="Select All" onclick="checkAll()"> <input type="button" value="Delete Selected Parts" onclick="if (confirm(\'Are you sure you want to remove selected Listings?\')) { f1.action=\'?psl=loged&do=spares&step=del_sel\'; f1.submit(); } else { }"> <input type="button" value="Mark as Sold" onclick="f1.action=\'?psl=loged&do=spares&step=sel_prod\'; f1.submit();"> <input type="button" value="Unmark as Sold" onclick="f1.action=\'?psl=loged&do=spares&step=sel_nprod\'; f1.submit();"></div>');

if ($spc == '911') {
echo('<div style="margin: 10px 0 0 30px"><input type="button" value="Show on Main Page" onclick="f1.action=\'?psl=loged&do=spares&step=intop&w=1\'; f1.submit();"> <input type="button" value="Dont Show on Main Page" onclick="f1.action=\'?psl=loged&do=spares&step=intop&w=0\'; f1.submit();"></div>');
}

echo('</form>');
} else if ($step == 'add') {
?>
<script lang="javascript">
function pfoto(koks) {
	var koks = koks + 1;
	var newdiv = document.createElement('div');
	newdiv.setAttribute('id','ff_'+koks);
	newdiv.setAttribute('style','float: left');
	newdiv.innerHTML ='<input type="file" name="ff_'+koks+'" onchange="pfoto('+koks+')" style="width: 195px; margin: 0 0 5px 5px">';
	document.getElementById('fot').appendChild(newdiv);
	document.getElementById('fotsk').value = koks;
	}

function getmo(ivesta) {
    with(document.getElementById('skkk')) {

      while(length) remove(0);
      options.add(new Option('- Select -', ''));

      var sry_loader = document.createElement('script');
      document.body.appendChild(sry_loader);
      sry_loader.src = "get_sk.php?in=" + ivesta;


    }
  }

</script>
<?php
echo('<h1>Enter Part Information</h1>');
echo('<form name="nskk" action="add_spares.php" method="post" enctype="multipart/form-data"><table border="0" width="400" cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td height="22" width="130">Category:</td>
		<td><select size="1" name="mk" onchange="getmo(this.value)" style="width: 200px"><option value="">- Select -</option>');
$get_kategs=mysql_query("Select * from `d_kat` order by `name` asc");
while($mkk=mysql_fetch_array($get_kategs)) {
$mid = $mkk['id'];
$mname = $mkk['name'];
echo('<option value="'.$mid.'">'.$mname.'</option>');

}
$uid = $uss['id'];
echo('</select></td>
	</tr>
	<tr>
		<td height="22" width="130">Subcategory:</td>
		<td><select size="1" name="sk" id="skkk" style="width: 200px"><option value="">- Select -</option></select></td>
	</tr>
	<tr>
		<td height="22" width="130">Make/Model/Year:</td>
		<td><input type="text" name="marke" style="width: 200px"></td>
	</tr>
	<tr>
		<td height="22" width="130">Description:</td>
		<td><input type="text" name="pav" style="width: 200px"><input type="hidden" name="uid" value="'.$uid.'"></td>
	</tr>
	<tr>
		<td height="22" width="130">Part #:</td>             
		<td><input type="text" name="part" style="width: 200px"></td>
	</tr><tr>
		<td height="22" width="130">Condition:</td>
		<td><select size="1" name="kat" style="width: 200px"><option value="0">New OEM</option><option value="1">Used OEM</option><option value="2">New Aftermarket</option><option value="3">Used Aftermarket </option></select></td>
	</tr>
	<tr>
		<td height="22" width="130">Price:</td>
		<td><input type="text" name="kaina" style="width: 150px"><select size="1" name="ktipas" style="width: 45px; margin: 0 0 0 5px"><option value="1">$</option><option value="2">€</option></select></td>
	</tr>');

$utype = $uss['type'];
$vipd = $uss['vip'];
$dabar = date("Y-m-d H:i:s");
if ($utype == 'f56e82798de1b89f7a4d77479ead7280' || $vipd >= $dabar) {
echo('<tr>
		<td height="22" width="130">Gift Photo:</td>
		<td><input type="file" name="dovana" style="width: 200px"></td>
	</tr><tr>
		<td height="22" width="130">URL(for free):</td>
		<td><input type="text" name="slink" style="width: 200px"><input type="hidden" name="foto_sk" id="fotsk" value="1"></td>
	</tr><tr>
		<td height="22" width="130">Promotion:</td>
		<td><select name="akcija" style="width: 202px"><option value="0">Не участвует в акции</option><option value="1">Бесплатное место</option><option value="2">Бесплатная доставка</option></select></td>
	</tr>');

}

echo('</table>');

echo('<table border="0" width="600" id="table1" cellpadding="0" style="border-collapse: collapse">');

echo('<tr><td colspan="9" height="25"><b>Additional information:</b></td></tr><tr><td colspan="9"><input type="hidden" name="izz" value="'.$izz.'"><textarea rows="5" name="info" style="width: 600px"></textarea></td></tr>');

echo('<tr><td colspan="9" height="25"><b>Attach pictures:</b></td></tr>');
echo('<tr><td id="fot" width="600" colspan="10" align="left">');

//Количество фото
for ($i=1; $i<19; $i++)
echo "<div style=\"float: left\"><input type=\"file\" name=\"ff_$i\" id=\"fotzz\" style=\"width: 195px; margin: 0 0 5px 5px\"></div>";

echo ('</td></tr>');
echo('<tr><td colspan="9" height="35" align="center"><input type="submit" style="cursor: pointer;" value="Submit Add"></td></tr>');
echo('</table></form>');

} else if ($step == 'edit') {
$id = addslashes($_GET['id']);
$uid = $uss['id'];
$utype = $uss['type'];
if ($utype =='f56e82798de1b89f7a4d77479ead7280') {
$get_inf=mysql_query("Select * from `dalys` where `id`='$id'");
} else {
$get_inf=mysql_query("Select * from `dalys` where `id`='$id' and `uid`='$uid'");
}
$otm=mysql_fetch_array($get_inf);
$mk = $otm['mk'];
$sk = $otm['sk'];
$part = $otm['part'];
$marke = $otm['marke'];
$kat = $otm['kateg'];
$kaina = $otm['kaina'];
$ktipas = $otm['ktipas'];
$ktype = $otm['ktype'];
$info = $otm['info'];
$slink = $otm['url'];
$pav = $otm['pav'];



$info = stripslashes($otm['info']);
$dovana = $otm['gift'];
$akcija = $otm['akcija'];



if (empty($dovana)) { $dov ='<input type="file" name="dovana" style="width: 200px">'; } else { $dov ='<input type="hidden" name="gift" value="'.$dovana.'"><img src="phpThumb.php?src='.$dovana.'&w=120&h=100" align="left" style="margin: 0 10px 0 0"><a onClick="if(confirm(\'Are you sure you want to remove this Photo?\')); else return false;" href="?psl=loged&do=spares&step=del_photo&id='.$id.'">Delete Photo</a>'; }

?>
<script lang="javascript">
function pfoto(koks) {
var koks = koks + 1;
	 var myElement = document.createElement('<input type="file" name="ff_'+koks+'" onchange="pfoto('+koks+')" style="width: 195px; margin: 0 0 5px 5px">');
	 document.getElementById('fot').appendChild(myElement);
	 document.getElementById('fotsk').value = koks;
}
function getmo(ivesta) {
    with(document.getElementById('skkk')) {

      while(length) remove(0);
      options.add(new Option('- Select -', ''));

      var sry_loader = document.createElement('script');
      document.body.appendChild(sry_loader);
      sry_loader.src = "get_sk.php?in=" + ivesta;


    }
  }
</script>
<?php
echo('<h1>Eddit Part Information</h1>');
echo('<a href="?psl=loged&do=spares&step=photo&id='.$id.'">Edit Photo</a>');
echo('<form name="nskk" action="update_spares.php" method="post" enctype="multipart/form-data"><table border="0" width="400" cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td height="22" width="130">Category:</td>
		<td><select size="1" name="mk" onchange="getmo(this.value)" style="width: 200px"><option value="">- Select -</option>');
$get_kategs=mysql_query("Select * from `d_kat` order by `name` asc");
while($mkk=mysql_fetch_array($get_kategs)) {
$mid = $mkk['id'];
$mname = $mkk['name'];
echo('<option '); if ($mk == $mid) { echo " selected "; } else { } echo('value="'.$mid.'">'.$mname.'</option>');

}

echo('</select></td>
	</tr>
	<tr>
		<td height="22" width="130">Subcategory:</td>
		<td><select size="1" name="sk" style="width: 200px"><option value="">- Select -</option>');
$get_turgas=mysql_query("Select * from `d_sub` where `mid`='$mk' order by `name` asc");
while($itas=mysql_fetch_array($get_turgas))
{
$sname = $itas['name'];
$isd = $itas['id'];
echo('<option '); if ($sk == $isd) { echo " selected "; } else { } echo(' value="'.$isd.'">'.$sname.'</option>');
}
$uid = $uss['id'];
$id = $_GET['id'];
echo('</select></td>
	</tr>
	<tr>
		<td height="22" width="130">Маke/Model/Year:</td>
		<td><input type="text" name="marke" value="'.$marke.'" style="width: 200px"><input type="hidden" name="uid" value="'.$uid.'"></td>
	</tr>
	<tr>
		<td height="22" width="130">Description:</td>
		<td><input type="text" name="pav" value="'.$pav.'" style="width: 200px"><input type="hidden" name="insider" value="'.$id.'"></td>
	</tr>
	<tr>
		<td height="22" width="130">Part #:</td>
		<td><input type="text" name="part" value="'.$part.'" style="width: 200px"></td>
	</tr><tr>
		<td height="22" width="130">Condition:</td>
		<td><select type="text" name="kat" value="'.$kat.'" style="width: 200px"><option '); if ($kat == '0') { echo " selected "; } else { } echo(' value="0">New OEM</option><option '); if ($kat == '1') { echo " selected "; } else { } echo(' value="1">Used OEM</option><option '); if ($kat == '3') { echo " selected "; } else { } echo(' value="3">New Aftermarket</option><option ');if ($kat == '4') { echo " selected "; } else { } echo(' value="4">Used Aftermarket</option></select></td>

	
	</tr>
	<tr>
		<td height="22" width="130">Price:</td>
		<td><input type="text" name="kaina" value="'.$kaina.'" style="width: 150px"><select size="1" name="ktipas" style="width: 45px; margin: 0 0 0 5px"><option '); if ($ktype == '1') { echo " selected "; } else { } echo(' value="1">$</option><option  '); if ($ktype == '2') { echo " selected "; } else { } echo(' value="2">€</option></select></td>
	</tr>');

$utype = $uss['type'];
$vipd = $uss['vip'];
$dabar = date("Y-m-d H:i:s");
if ($utype == 'f56e82798de1b89f7a4d77479ead7280' || $vipd >= $dabar) {
echo('<tr>
		<td height="22" width="130">Gift Photo:</td>

		<td>'.$dov.'</td>
	</tr><tr>
		<td height="22" width="130">URL(for free):</td>
		<td><input type="text" name="slink" value="'.$slink.'" style="width: 200px"><input type="hidden" name="foto_sk" id="fotsk" value="1"></td>
	</tr><tr>
		<td height="22" width="130">Promotion:</td>
		<td><select name="akcija" style="width: 202px"><option '); if ($akcija == '0') { echo " selected "; } else { } echo(' value="0">Не участвует в акции</option><option '); if ($akcija == '1') { echo " selected "; } else { } echo(' value="1">Бесплатное место</option><option '); if ($akcija == '2') { echo " selected "; } else { } echo(' value="2">Бесплатная доставка</option></select></td>
	</tr>');
}

echo('</table>');
echo('<table border="0" width="600" id="table1" cellpadding="0" style="border-collapse: collapse">');
echo('<tr><td colspan="9" height="25"><b>Additional information:</b></td></tr><tr><td colspan="9"><input type="hidden" name="izz" value="'.$izz.'"><textarea rows="5" name="info" style="width: 600px">'.$info.'</textarea></td></tr>');

//echo('<tr><td colspan="9" height="35" align="center"><input type="button" value="Mark as Sold" onclick="location.href=\'step/change_it.php?point=6&sec=1&cid='.$id.'&uid='.$uid.'&back=edit\'"> <input type="button" value="Unmark as Sold" onclick="location.href=\'step/change_it.php?point=6&sec=0&cid='.$id.'&uid='.$uid.'&back=edit\'"> <input type="submit" value="Renew Add!"></</td></tr>');

echo('<tr><td colspan="9" height="35" align="center"><input type="submit" value="Mark as Sold" name="sel_prod" /><input type="submit" value="Unmark as Sold" name="sel_nonprod"/><input type="submit" value="Renew Add!" name="update"/></td></tr>');


echo('</table></form>');

} else if ($step == 'del_photo') {
$id = $_GET['id'];
$geto=mysql_query("Select * from `dalys` where `id`='$id'");
$gzz=mysql_fetch_array($geto);
$gift = $gzz['gift'];
@unlink("$gift");
$delaz=mysql_query("Update `dalys` set `gift`='' where `id`='$id'");

echo('<script type="text/javascript">window.location = "?psl=loged&do=spares&step=edit&id='.$id.'"</script>');
} else if ($step == 'photo') {
$sid = $_GET['id'];
echo('<h1>Edit/Delete Photo</h1>');
$get_fotos=mysql_query("Select * from `foto` where `type`='8' and `sid`='$sid' order by `id` asc");
while($ozz=mysql_fetch_array($get_fotos)) {
$id = $ozz['id'];
$url = $ozz['url'];
echo('<div style="float: left; background: #FFFFFF; padding: 3px; border: 1px solid #cccccc; text-align: center; height: 135px; margin: 0 4px 10px 4px; width: 134px"><span id="images"><a rel="group" target="_blank" class="images" href="phpThumb.php?src='.$url.'&w=800"><img src="phpThumb.php?src='.$url.'&w=134&h=108" style="margin: 0 0 3px 0; border: 0"></a></span><br><a onClick="if(confirm(\'Are you sure you want to remove this Photo?\')); else return false;" href="?psl=loged&do=spares&step=df&sid='.$sid.'&fid='.$id.'">Delete</a></div>');

}
echo('<div style="clear: both"></div>');

echo('<div align="center" style="margin: 25px 0 0 0">
<div style="width: 250px; height: auto; margin: 25px 0 15px 0; background: #F8F8F8; text-align: left; padding: 0 10px 10px 10px; border: 1px solid #cccccc"><h2>Add Photo</h2>
<form method="post" enctype="multipart/form-data" action="?psl=loged&do=spares&step=up_ff" name="sfoto"><input type="file" onchange="document.sfoto.submit()" name="foto" style="width:250px"><input type="hidden" name="sid" value="'.$sid.'"></form></div></div>');

echo('<div style="width: 100%; padding: 10px; border-top: 1px solid #cccccc"><a href="loged/spares.html">List of Parts</a> | <a href="/">Go to Main Page</a> | <a href="loged/spares/add.html">Add New Part</a></div>');
} else if ($step == 'df') {
$sid = $_GET['sid'];
$fid = $_GET['fid'];
$get_foto=mysql_query("Select * from `foto` where `sid`='$sid' and `id`='$fid'");
$otz=mysql_fetch_array($get_foto);
$url = $otz['url'];
@unlink("$url");
$delasz=mysql_query("Delete from `foto` where `sid`='$sid' and `id`='$fid'");
echo('<script type="text/javascript">window.location = "?psl=loged&do=spares&step=photo&id='.$sid.'"</script>');
} else if ($step == 'up_ff') {
$sid = $_POST['sid'];
$file_name = $_FILES['foto']['name'];
$logotype = $_FILES['foto'];
if (!empty($file_name) && is_numeric($sid)) {
$file_size = $_FILES['foto']['size'];
$file_type = $_FILES['foto']['type'];
$file_dir = "photo";
$tu = explode(".", $file_name);
$galune = array_pop($tu);
$max_file_size = 1024 * 9048;
$un = substr(md5(uniqid(rand())), 0, 5);
$file_destination = $file_dir . "/" . $un . "." . $galune;
if ($file_type == 'image/pjpeg' || $file_type == 'image/gif' || $file_tye == 'image/bmp' || $file_type == 'image/jpeg' || $file_type == 'image/png' || $file_type == 'image/x-png') {
$funkcija = move_uploaded_file($logotype["tmp_name"], $file_destination);
$insas=mysql_query("Insert into `foto` set `url`='$file_destination', `sid`='$sid', `type`='8'");
} else {

}
echo('<script type="text/javascript">window.location = "?psl=loged&do=spares&step=photo&id='.$sid.'"</script>');
}
} else if ($step == 'delete') {

$id = $_GET['id'];
$uid = $uss['id'];
$utype = $uss['type'];

if ($utype =='f56e82798de1b89f7a4d77479ead7280') {
$get_zz=mysql_query("Select * from `dalys` where `id`='$id'");
} else {
$get_zz=mysql_query("Select * from `dalys` where `id`='$id' and `uid`='$uid'");
}
$skkz=mysql_num_rows($get_zz);
//echo '<script type="text/javascript">alert("' .$skkz. '"); </script>';
if ($skkz =='1') {
$delf=mysql_query("Select * from `foto` where `type`='8' and `sid`='$id'");
while($fo=mysql_fetch_array($delf)) {
$url = $fo['url'];
@unlink("$url");
}
$delz=mysql_query("Delete from `foto` where `type`='8' and `sid`='$id'");
if ($utype =='f56e82798de1b89f7a4d77479ead7280') {

//$del_a=mysql_query("Delete from `dalys` where `id`='$id' and `uid`='$uid'");

$del_a=mysql_query("Delete from `dalys` where `id`='$id' and `uid`='$uid'");
} else {

$del_a=mysql_query("Delete from `dalys` where `id`='$id' and `uid`='$uid'");

}
}
echo('<script type="text/javascript">window.location = "?psl=loged&do=spares&msg=deleted"</script>');
} else if ($step == 'del_sel') {
$yp = $_POST['c'];


if (count($yp) != '0') {
while(list($name, $value) = each($yp)) {
$imk_mot=mysql_query("Select * from `foto` where `sid`='$value' and `type`='8'");
while($ff=mysql_fetch_array($imk_mot)) {
$url = $ff['url'];

@unlink("$url");

}
$del_ff=mysql_query("Delete from `foto` where `sid`='$value' and `type`='8'");
$del_mo=mysql_query("Delete from `dalys` where `id`='$value'");

}
}
echo('<script type="text/javascript">window.location = "?psl=loged&do=spares&msg=deleted2"</script>');

} else if ($step == 'sel_prod') {
$yp = $_POST['c'];
if (count($yp) != '0') {
while(list($name, $value) = each($yp)) {
$dt = date("Y-m-d H:i:s");
$updazz=mysql_query("Update `dalys` set `parduota`='$dt' where `id`='$value'");
}
}
echo('<script type="text/javascript">window.location = "?psl=loged&do=spares&msg=prod"</script>');

} else if ($step == 'sel_nprod') {
$yp = $_POST['c'];
if (count($yp) != '0') {
while(list($name, $value) = each($yp)) {

$updazz=mysql_query("Update `dalys` set `parduota`='0' where `id`='$value'");
}
}
echo('<script type="text/javascript">window.location = "?psl=loged&do=spares&msg=nprod"</script>');

} else if ($step == 'intop') {

$utype = $uss['type'];
$vipd = $uss['vip'];
$dabar = date("Y-m-d H:i:s");

$w = addslashes($_GET['w']);
if ($utype == 'f56e82798de1b89f7a4d77479ead7280' || $vipd >= $dabar) {

$yp = $_POST['c'];
if (count($yp) != '0') {

while(list($name, $value) = each($yp)) {

$updazz=mysql_query("Update `dalys` set `onmain`='$w' where `id`='$value'");

}
}

}
echo('<script type="text/javascript">window.location = "?psl=loged&do=spares&msg=intop_'.$w.'"</script>');

}

?>