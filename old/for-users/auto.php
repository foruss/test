<?php
$step = $_GET['step'];


if ($step == 'add') {
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
    with(document.getElementById('model')) {

      while(length) remove(0);
      options.add(new Option('- Select -', ''));

      var sry_loader = document.createElement('script');
      document.body.appendChild(sry_loader);
      sry_loader.src = "/getm.php?in=" + ivesta;


    }

  }
</script>
<?php
echo('<form name="nskk2" action="add_auto.php" method="post" enctype="multipart/form-data">');
echo('<h1>Enter Vehicle Information</h1>');
echo('<div style="float: left; width: 370px; border-right: 1px dashed #e1e1e1"><h2>Vehicle:</h2>');
echo('<table border="0" width="370" cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td height="22" width="130">Маke:</td>
		<td><select size="1" name="marke"  onchange="getmo(this.value)" style="width: 200px"><option value="">- Select -</option>');
$get_mark=mysql_query("Select * from `marke` order by `name` asc");
while($gmk=mysql_fetch_array($get_mark)) {
$mid = $gmk['id'];
$name = $gmk['name'];
echo('<option value="'.$mid.'">'.$name.'</option>');
}
$uid = $uss['id'];
echo('</select></td>
	</tr>
	<tr>
		<td height="22" width="130">Моdel:</td>
		<td><select size="1" name="modelis" id="model" style="width: 200px"><option value="">- Select -</option></select></td>
	</tr>
	<tr>
		<td height="22" width="130">Category:</td>
		<td><select size="1" name="kat" style="width: 200px"><option value="0">Clean</option><option value="1">With Damage</option></select></td>
	</tr>
	<tr>
		<td height="22" width="130">Color:</td>
		<td><select size="1" name="color" style="width: 200px"><option value="">- Select -</option>');
$get_spp=mysql_query("Select * from `la_spalva` order by `ru` asc");
while($spa=mysql_fetch_array($get_spp)) {
$spid = $spa['id'];
$spname = $spa['ru'];
echo('<option value="'.$spid.'">'.$spname.'</option>');

}
echo('</select></td>
	</tr>
		<tr>
		<td height="22" width="130">Interior:</td>
		<td><select size="1" name="scolor" style="width: 200px"><option value="">- Select -</option>');
$get_sspp=mysql_query("Select * from `la_sspalva` order by `ru` asc");
while($sspa=mysql_fetch_array($get_sspp)) {
$sspid = $sspa['id'];
$sspname = $sspa['ru'];
echo('<option value="'.$sspid.'">'.$sspname.'</option>');

}
echo('</select></td>
	</tr>
	<tr>
		<td height="22" width="130">Title:</td>
		<td><select size="1" name="title" style="width: 200px"><option value="">- Select -</option>');
$get_mark=mysql_query("Select * from `la_title` order by `ru` asc");
while($gmk=mysql_fetch_array($get_mark)) {
$mid = $gmk['id'];
$name = $gmk['ru'];
echo('<option value="'.$mid.'">'.$name.'</option>');
}
echo('</select></td>
	</tr><tr>
		<td height="22" width="130">VIN:</td>
		<td><input type="text" name="vin" style="width: 200px"><input type="hidden" name="uid" value="'.$uid.'"></td>
	</tr><tr>
		<td height="22" width="130">Year:</td>
		<td><select size="1" name="metai" style="width: 200px"><option value="">- Select -</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option></select></td>
	</tr><tr>
		<td height="22" width="130">Body Type:</td>
		<td><select size="1" name="keb" style="width: 200px"><option value="">- Select -</option>');
$get_mark=mysql_query("Select * from `la_kebulas` order by `ru` asc");
while($gmk=mysql_fetch_array($get_mark)) {
$mid = $gmk['id'];
$name = $gmk['ru'];
echo('<option value="'.$mid.'">'.$name.'</option>');
}
echo('</select></td>
	</tr><tr>
		<td height="22" width="130">Fuel:</td>
		<td><select size="1" name="variklis" style="width: 200px"><option value="">- Select -</option>');
$get_mark=mysql_query("Select * from `la_variklis` order by `ru` asc");
while($gmk=mysql_fetch_array($get_mark)) {
$mid = $gmk['id'];
$name = $gmk['ru'];
echo('<option value="'.$mid.'">'.$name.'</option>');
}

echo('</select></td>
	</tr>
</table></div>');

echo('<div style="float: right; width: 350px"><h2>Info:</h2>');
echo('<table border="0" width="350" cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td height="22" width="130">Engine:</td>
		<td><input type="text" name="turis" style="width: 200px"></td>
	</tr>
	<tr>
		<td height="22" width="130">Miles:</td>
		<td><input type="text" name="rida" style="width: 150px"><select size="1" name="rtipas" style="width: 45px; margin: 0 0 0 5px"><option value="0">miles</option><option value="1">km</option></select></td>
	</tr><tr>
		<td height="22" width="130">Transmission:</td>
		<td><select size="1" name="pavd" style="width: 202px"><option value="">- Select -</option><option  value="1">Automatic</option><option value="2">Manual</option><option  value="3">Combo</option></select></td>
	</tr><tr>
		<td height="22" width="130">Price:</td>
		<td><input type="text" name="kaina" style="width: 150px"><select size="1" name="ktipas" style="width: 45px; margin: 0 0 0 5px"><option value="1">$</option><option value="2">€</option></select></td>
	</tr><tr>
		<td height="22" width="130">Country/State:</td>
		<td><input type="text" name="vieta" style="width: 202px"><input type="hidden" name="insider" value="'.$sk_id.'"><input type="hidden" name="utype" value="'.$uss['type'].'"></td>
	</tr><tr>
		<td height="22" width="130">City:</td>
		<td><input type="text" name="miestas" style="width: 202px"></td>
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
		<td height="22" width="130">Prommotion:</td>
		<td><select name="akcija" style="width: 202px"><option value="0">Не участвует в акции</option><option value="1">Бесплатное место</option><option value="2">Бесплатная доставка</option></select></td>
	</tr>');
}
echo('</table></div><div style="clear: both;"></div>');
echo('<h2 style="padding: 15px 0 0 0">Vehicle Options:</h2>');
echo('<table border="0" width="750" id="table1" cellpadding="1" style="border-collapse: collapse">');

$get_priv=mysql_query("Select * from `la_priv` order by `ru` asc");
$i = 1;
while($roz=mysql_fetch_array($get_priv)) {

if ($i == '1') { echo "<tr>"; } else { }
$id = $roz['id'];
$ru = $roz['ru'];
echo('<td width="25" align="center"><input type="checkbox" name="priv[]" id="priv_'.$id.'" style="border: 0" value="a'.$id.'"></td><td width="225"><label for="priv_'.$id.'">'.$ru.'</label></td>');

if ($i == '3') { echo "</tr>"; $i=1; } else {$i++; }
}

echo('</table>');

echo('<h2>Mechanical or Cosmetic Condition Report:</h2>');

echo('<table border="0" width="600" id="table1" cellpadding="0" style="border-collapse: collapse">
		<tr>
		<td colspan="9" height="25"><b>Exterior</b></td>
	</tr>');
$get_privz=mysql_query("Select * from `la_bukle` where `kat`='1'");
$i = 1;
$izz = 1;
while($otz=mysql_fetch_array($get_privz)) {
$ru = $otz['ru'];
$id = $otz['id'];
if ($i == '1') {
$bg = 'background-color: #eeeeff';
$i--;
} else {
$bg ='';
$i++;
}
echo('<tr style="'.$bg.'">
		<td style="padding: 0 0 0 10px; '.$bg.'">'.$ru.'</td>
		<td width="20" style="'.$bg.'"><input checked style="border: 0; '.$bg.'" type="radio" name="i_'.$izz.'" value="0" id="bb'.$id.'_0"></td>
		<td width="80" style="'.$bg.'"><label for="bb'.$id.'_0" style="color:#0066CC">Excellent</label></td>
		<td width="20" style="'.$bg.'"><input style="border: 0; '.$bg.'" type="radio" name="i_'.$izz.'" value="1" id="bb'.$id.'_1"></td>
		<td width="80" style="'.$bg.'"><label for="bb'.$id.'_1" style="color:#009900">Good</label></td>
		<td width="20" style="'.$bg.'"><input style="border: 0; '.$bg.'" type="radio" name="i_'.$izz.'" value="2" id="bb'.$id.'_2"></td>
		<td width="80" style="'.$bg.'"><label for="bb'.$id.'_2" style="color:#FF9900">Fair</label></td>
		<td width="20" style="'.$bg.'"><input style="border: 0; '.$bg.'" type="radio" name="i_'.$izz.'" value="3" id="bb'.$id.'_3"></td>
		<td width="80" style="'.$bg.'"><label for="bb'.$id.'_3" style="color:#FF0000">Bad</label></td>
	</tr>');
$izz++;
}
echo('<tr><td colspan="9" height="25"><b>Interior</b></td></tr>');
$get_privz=mysql_query("Select * from `la_bukle` where `kat`='2'");
$i = 1;
$izz = 1;
while($otz=mysql_fetch_array($get_privz)) {
$ru = $otz['ru'];
$id = $otz['id'];
if ($i == '1') {
$bg = 'background-color: #eeeeff';
$i--;
} else {
$bg ='';
$i++;
}
echo('<tr style="'.$bg.'">
		<td style="padding: 0 0 0 10px; '.$bg.'">'.$ru.'</td>
		<td width="20" style="'.$bg.'"><input checked style="border: 0; '.$bg.'" type="radio" name="v_'.$izz.'" value="0" id="bb'.$id.'_0"></td>
		<td width="80" style="'.$bg.'"><label for="bb'.$id.'_0" style="color:#0066CC">Excellent</label></td>
		<td width="20" style="'.$bg.'"><input style="border: 0; '.$bg.'" type="radio" name="v_'.$izz.'" value="1" id="bb'.$id.'_1"></td>
		<td width="80" style="'.$bg.'"><label for="bb'.$id.'_1" style="color:#009900">Good</label></td>
		<td width="20" style="'.$bg.'"><input style="border: 0; '.$bg.'" type="radio" name="v_'.$izz.'" value="2" id="bb'.$id.'_2"></td>
		<td width="80" style="'.$bg.'"><label for="bb'.$id.'_2" style="color:#FF9900">Fair</label></td>
		<td width="20" style="'.$bg.'"><input style="border: 0; '.$bg.'" type="radio" name="v_'.$izz.'" value="3" id="bb'.$id.'_3"></td>
		<td width="80" style="'.$bg.'"><label for="bb'.$id.'_3" style="color:#FF0000">Bad</label></td>
	</tr>');
$izz++;
}
echo('<tr><td colspan="9" height="25"><b>Меchanical</b></td></tr>');
$get_privz=mysql_query("Select * from `la_bukle` where `kat`='3'");
$i = 1;
$izz =1;
while($otz=mysql_fetch_array($get_privz)) {
$ru = $otz['ru'];
$id = $otz['id'];
if ($i == '1') {
$bg = 'background-color: #eeeeff';
$i--;
} else {
$bg ='';
$i++;
}
echo('<tr style="'.$bg.'">
		<td style="padding: 0 0 0 10px; '.$bg.'">'.$ru.'</td>
		<td width="20" style="'.$bg.'"><input checked style="border: 0; '.$bg.'" type="radio" name="m_'.$izz.'" value="0" id="bb'.$id.'_0"></td>
		<td width="80" style="'.$bg.'"><label for="bb'.$id.'_0" style="color:#0066CC">Excellent</label></td>
		<td width="20" style="'.$bg.'"><input style="border: 0; '.$bg.'" type="radio" name="m_'.$izz.'" value="1" id="bb'.$id.'_1"></td>
		<td width="80" style="'.$bg.'"><label for="bb'.$id.'_1" style="color:#009900">Good</label></td>
		<td width="20" style="'.$bg.'"><input style="border: 0; '.$bg.'" type="radio" name="m_'.$izz.'" value="2" id="bb'.$id.'_2"></td>
		<td width="80" style="'.$bg.'"><label for="bb'.$id.'_2" style="color:#FF9900">Fair</label></td>
		<td width="20" style="'.$bg.'"><input style="border: 0; '.$bg.'" type="radio" name="m_'.$izz.'" value="3" id="bb'.$id.'_3"></td>
		<td width="80" style="'.$bg.'"><label for="bb'.$id.'_3" style="color:#FF0000">Bad</label></td>
	</tr>');
$izz++;
}
echo('<tr><td colspan="9" height="25"></td></tr><tr><td colspan="9" height="22"><b>Additional information:</b></td></tr><tr><td colspan="9"><input type="hidden" name="izz" value="'.$izz.'"><textarea rows="5" name="info" style="width: 600px"></textarea></td></tr>');

echo('<tr><td colspan="9" height="25"><b>Attach pictures:</b></td></tr>');
echo('<tr><td id="fot" width="600" colspan="10" align="left">');

//Количество фото
for ($i=1; $i<22; $i++)
echo "<div style=\"float: left\"><input type=\"file\" name=\"ff_$i\" id=\"fotzz\" style=\"width: 195px; margin: 0 0 5px 5px\"></div>";

echo ('</td></tr>');
echo('<tr><td colspan="9" height="35" align="center"><input type="submit" style="cursor: pointer;" value="Submit Add"></td></tr>');
echo('</table></form>');

} else if ($step == '') {
echo('<h1>List of Cars</h1>');
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

$msg = $_GET['msg'];
if ($msg == 'inserted') {

} else if ($msg == 'update') {

} else if ($msg == 'deleted') {

} else if ($msg == 'deleted2') {

} else if ($msg == 'prod') {

} else if ($msg == 'nprod') {

} else if ($msg == 'intop_1') {

} else if ($msg == 'intop_0') {

}

if ($utype == 'f56e82798de1b89f7a4d77479ead7280' || $vipd >= $dabar) {
$spc = '911';
} else {
$spc = '0';
}
if ($utype == 'f56e82798de1b89f7a4d77479ead7280') {
echo('<form method="POST" style="margin: 0; padding: 0" action="loged/auto.html"><div style="margin: 0 0 10px 0; padding: 0 0 5px 0; border-bottom: 1px solid #e1e1e1">Search by Lot# <input type="text" style="width: 50px" name="lot"><input type="submit" name="submit" value="OK" style="margin: 0 5px 0 5px"></div></form>');

}
echo('<div align="center"><form method="post" name="f1" action=""><table border="1" width="'); if ($spc == '911') { echo "755"; } else { echo"690"; } echo('" cellpadding="0" style="border-collapse: collapse" bordercolor="#FFFFFF">
	<tr>
		<td style="background: url(images/qa_bg.gif) repeat-x; color: #FFFFFF" height="26" colspan="3" align="center">Маke / Model</td>');
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
/*$ka ="`uid`>'0'";*/
}
$get_autos=mysql_query("Select * from `auto` where ".$ka." order by `id` desc");

while($zo=mysql_fetch_array($get_autos)) {
$marke = get_marke($zo['marke']);
$modelis = get_modelis($zo['modelis']);
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
if ($ktype == '1') { $kt = '€'; } else if ($ktype == '2') { $kt = '$'; }
echo('<tr onmouseover="style.backgroundColor=\'#f8f8f8\'" onmouseout="style.backgroundColor=\'\'">
		<td height="22" style="border-bottom: 1px solid #e1e1e1" width="22" align="center"><input type="checkbox" name="c[]" value="'.$id.'" style="border: 0; background: ;"></td>
		<td height="22" style="border-bottom: 1px solid #e1e1e1; text-align: left">&nbsp;<a target=_blank title="'.$marke.' '.$modelis.', '.$metai.' г. - '.$kt.' '.$kaina.'" href="auto/show/'.$id.'/"><b>'.$marke.' '.$modelis.'</b>, '.$metai.' г. - '.$kt.' '.$kaina.'</a> '.$sold.'</td>
		<td width="140" style="font-size: 8pt; border-bottom: 1px solid #e1e1e1;">posted on: '.$data.'</td>');
if ($spc == '911') {
echo('<td height="22" style="border-bottom: 1px solid #e1e1e1" width="55" align="center">'.$pp.'</td>');
}

echo('<td height="22" style="border-bottom: 1px solid #e1e1e1" width="90" align="center">'.$viewed.'</td>
		<td height="22" width="170" align="center" style="font-size: 8pt; border-bottom: 1px solid #e1e1e1"><a href="?psl=loged&do=auto&step=edit&id='.$id.'">Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onClick="if(confirm(\'Are you sure you want to remove this Auto?\')); else return false;" href="?psl=loged&do=auto&step=delete&id='.$id.'">Delete</a></td>
	</tr>');
}
echo('</table></div>');

echo('<div style="margin: 15px 0 0 30px"><input type="button" value="Select All" onclick="checkAll();"> <input type="button" value="Delete Selected" onclick="if (confirm(\'Are you sure you want to remove selected Autos?\')) { f1.action=\'?psl=loged&do=auto&step=del_sel\'; f1.submit(); } else { }"> <input type="button" value="Mark as Sold" onclick="f1.action=\'?psl=loged&do=auto&step=sel_prod\'; f1.submit();"> <input type="button" value="Unmark as Sold" onclick="f1.action=\'?psl=loged&do=auto&step=sel_nprod\'; f1.submit();"></div>');
$utype = $uss['type'];
$vipd = $uss['vip'];
$dabar = date("Y-m-d H:i:s");
if ($utype == 'f56e82798de1b89f7a4d77479ead7280' || $vipd >= $dabar) {

echo('<div style="margin: 10px 0 0 30px"><input type="button" value="Show on Main Page" onclick="f1.action=\'?psl=loged&do=auto&step=intop&w=1\'; f1.submit();"> <input type="button" value="Dont Show on Main Page" onclick="f1.action=\'?psl=loged&do=auto&step=intop&w=0\'; f1.submit();"></div>');

}

echo('</form>');
} else if ($step == 'edit') {
$id = addslashes($_GET['id']);

?>
<script lang="javascript">
function getmo(ivesta) {
    with(document.getElementById('model')) {

      while(length) remove(0);
      options.add(new Option('- Select -', ''));

      var sry_loader = document.createElement('script');
      document.body.appendChild(sry_loader);
      sry_loader.src = "getm.php?in=" + ivesta;


    }
  }
</script>
<?php
echo('<form name="nskk2" action="update_auto.php" method="post" enctype="multipart/form-data">');

$id = addslashes($_POST['id']);
$uid = $uss['id'];
$utype = $uss['type'];
if ($utype =='f56e82798de1b89f7a4d77479ead7280') {
$get_itz=mysql_query("Select * from `auto` where `id`='$id'");

} else {
$get_itz=mysql_query("Select * from `auto` where `id`='$id' and `uid`='$uid'");
}
$aut=mysql_fetch_array($get_itz);
$marke = $aut['marke'];
$modelis = $aut['modelis'];
$kateg = $aut['kateg'];
$color = $aut['spalva'];
$scolor = $aut['salonosp'];
$title = $aut['title'];
$vin = $aut['vin'];
$metai = $aut['metai'];
$kebulas = $aut['kebulas'];
$dovana = $aut['gift'];

$kuras = $aut['kuras'];
$rida = $aut['rida'];
$rtype = $aut['rtype'];
$pavd = $aut['pdeze'];
$kaina = $aut['kaina'];
$ktype = $aut['ktype'];
$slink = $aut['url'];
$akcija = $aut['akcija'];
$turis = $aut['turis'];
$vieta = $aut['vieta'];
$priv = $aut['yps'];
$miestas = $aut['miestas'];
$info = stripslashes($aut['info']);
echo($info.'<br>');
if (empty($dovana)) { $dov ='<input type="file" name="dovana" style="width: 200px">'; } else { $dov ='<input type="hidden" name="gift" value="'.$dovana.'"><img src="phpThumb.php?src='.$dovana.'&w=120&h=100" align="left" style="margin: 0 10px 0 0"><a onClick="if(confirm(\'Are you sure you want to remove this Photo?\')); else return false;" href="?psl=loged&do=auto&step=del_photo&id='.$id.'">Delete</a>'; }
echo('<h1>Edit Vehicle Information</h1>');
echo('<div align="left"><a href="?psl=loged&do=auto&step=photo&id='.$id.'">Edit Photo</a></div>');
echo('<div style="float: left; width: 370px; border-right: 1px dashed #e1e1e1"><h2>Vehicle:</h2>');
echo('<table border="0" width="370" cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td height="22" width="130">Make:</td>
		<td><select size="1" name="marke"  onchange="getmo(this.value)" style="width: 200px"><option value="">- Select -</option>');
$get_mark=mysql_query("Select * from `marke` order by `name` asc");
while($gmk=mysql_fetch_array($get_mark)) {
$mid = $gmk['id'];
$name = $gmk['name'];
echo('<option '); if ($marke == $mid) { echo " selected "; } else { } echo(' value="'.$mid.'">'.$name.'</option>');
}
$uid = $uss['id'];
echo('</select></td>
	</tr>
	<tr>
		<td height="22" width="130">Model:</td>
		<td><select size="1" name="modelis" id="model" style="width: 200px"><option value="">- Select -</option>');
$get_modeliai = mysql_query("Select * from `modelis` where `mid`='$marke' order by `name` asc");
while($gmd=mysql_fetch_array($get_modeliai)) {
$mid = $gmd['id'];
$name = $gmd['name'];
echo('<option '); if ($modelis == $mid) { echo " selected "; } else { } echo(' value="'.$mid.'">'.$name.'</option>');
}
echo('</select></td>
	</tr>
	<tr>
		<td height="22" width="130">Category:</td>
		<td><select size="1" name="kat" style="width: 200px"><option '); if ($kateg == '0') { echo " selected "; } else { } echo(' value="0">Clean</option><option '); if ($kateg == '1') { echo " selected "; } else { } echo(' value="1">With Damage</option></select></td>
	</tr>
	<tr>
		<td height="22" width="130">Color:</td>
		<td><select size="1" name="color" style="width: 200px"><option value="">- Select -</option>');
$get_spp=mysql_query("Select * from `la_spalva` order by `ru` asc");
while($spa=mysql_fetch_array($get_spp)) {
$spid = $spa['id'];
$spname = $spa['ru'];
echo('<option '); if ($color == $spid) { echo " selected "; } else { } echo(' value="'.$spid.'">'.$spname.'</option>');

}
echo('</select></td>
	</tr>
		<tr>
		<td height="22" width="130">Interior:</td>
		<td><select size="1" name="scolor" style="width: 200px"><option value="">- Select -</option>');
$get_sspp=mysql_query("Select * from `la_sspalva` order by `ru` asc");
while($sspa=mysql_fetch_array($get_sspp)) {
$sspid = $sspa['id'];
$sspname = $sspa['ru'];
echo('<option '); if ($scolor == $sspid) { echo " selected "; } else { } echo(' value="'.$sspid.'">'.$sspname.'</option>');

}
echo('</select></td>
	</tr>
	<tr>
		<td height="22" width="130">Тitle:</td>
		<td><select size="1" name="title" style="width: 200px"><option value="">- Select -</option>');
$get_sspp=mysql_query("Select * from `la_title` order by `ru` asc");
while($sspa=mysql_fetch_array($get_sspp)) {
$sspid2 = $sspa['id'];
$sspname2 = $sspa['ru'];
echo('<option '); if ($sspid2 == $title) { echo " selected "; } else { } echo(' value="'.$sspid2.'">'.$sspname2.'</option>');

}
echo('</select></td>
	</tr><tr>
		<td height="22" width="130">VIN:</td> 
		<td><input type="text" name="vin" value="'.$vin.'" style="width: 200px"><input type="hidden" name="uid" value="'.$uid.'"></td>
	</tr><tr>
		<td height="22" width="130">Year:</td>
		<td><select size="1" name="metai" style="width: 200px"><option value="">- Select -</option><option selected value="'.$metai.'">'.$metai.'</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option></select></td>
	</tr><tr>
		<td height="22" width="130">Body Tipe:</td>
		<td><select size="1" name="keb" style="width: 200px"><option value="">- Select -</option>');
$get_mark=mysql_query("Select * from `la_kebulas` order by `ru` asc");
while($gmk=mysql_fetch_array($get_mark)) {
$mid = $gmk['id'];
$name = $gmk['ru'];
echo('<option '); if ($kebulas == $mid) { echo " selected "; } else { } echo(' value="'.$mid.'">'.$name.'</option>');
}
echo('</select></td>
	</tr><tr>
		<td height="22" width="130">Fuel:</td>
		<td><select size="1" name="variklis" style="width: 200px"><option value="">- Select -</option>');
$get_mark=mysql_query("Select * from `la_variklis` order by `ru` asc");
while($gmk=mysql_fetch_array($get_mark)) {
$mid = $gmk['id'];
$name = $gmk['ru'];
echo('<option '); if ($kuras == $mid) { echo " selected "; } else { } echo(' value="'.$mid.'">'.$name.'</option>');
}

echo('</select></td>
	</tr>
</table></div>');
$sk_id = $_GET['id'];
echo('<div style="float: right; width: 350px"><h2>Info:</h2>');

echo('<table border="0" width="350" cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td height="22" width="130">Engine:</td>
		<td><input type="text" name="turis" value="'.$turis.'" style="width: 200px"></td>
	</tr>
	<tr>
		<td height="22" width="130">Miles:</td>
		<td><input type="text" name="rida" value="'.$rida.'" style="width: 150px"><select size="1" name="rtipas" style="width: 45px; margin: 0 0 0 5px"><option '); if ($rtype == '0') { echo " selected "; } else { } echo(' value="0">miles</option><option '); if ($rtype == '1') { echo " selected "; } else { } echo(' value="1">km</option></select></td>
	</tr><tr>
		<td height="22" width="130">Transmission:</td>
		<td><select size="1" name="pavd" style="width: 202px"><option value="">- Select -</option><option '); if ($pavd == '1') { echo " selected "; } else { } echo(' value="1">Аutomatic</option><option '); if ($pavd == '2') { echo " selected "; } else { } echo(' value="2">Manual</option><option '); if ($pavd == '3') { echo " selected "; } else { } echo('  value="3">Combo</option></select></td>
	</tr><tr>
		<td height="22" width="130">Price:</td>
		<td><input type="text" name="kaina" value="'.$kaina.'" style="width: 150px"><select size="1" name="ktipas" style="width: 45px; margin: 0 0 0 5px"><option '); if ($ktype == '1') { echo " selected "; } else { } echo('  value="1">$</option><option '); if ($ktype == '2') { echo " selected "; } else { } echo('  value="2">€</option></select></td>
	</tr><tr>
		<td height="22" width="130">Country/State:</td>
		<td><input type="text" value="'.$vieta.'" name="vieta" style="width: 202px"><input type="hidden" name="insider" value="'.$sk_id.'"><input type="hidden" name="utype" value="'.$uss['type'].'"></td>
	</tr><tr>
		<td height="22" width="130">City:</td>
		<td><input type="text" value="'.$miestas.'" name="miestas" style="width: 202px"></td>
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
		<td><input type="text" name="slink" value="'.$slink.'" style="width: 200px"></td>
	</tr><tr>
		<td height="22" width="130">Promotion:</td>
		<td><select name="akcija" style="width: 202px"><option '); if ($akcija == '0') { echo " selected "; } else { } echo(' value="0">Не участвует в акции</option><option '); if ($akcija == '1') { echo " selected "; } else { } echo(' value="1">Бесплатное место</option><option '); if ($akcija == '2') { echo " selected "; } else { } echo(' value="2">Бесплатная доставка</option></select></td>
	</tr>');
}


	echo('</table></div><div style="clear: both"></div>');
echo('<h2 style="padding: 15px 0 0 0">Vehicle Options:</h2>');
echo('<table border="0" width="750" id="table1" cellpadding="1" style="border-collapse: collapse">');

$get_priv=mysql_query("Select * from `la_priv` order by `ru` asc");
$i = 1;
while($roz=mysql_fetch_array($get_priv)) {

if ($i == '1') { echo "<tr>"; } else { }
$id = $roz['id'];
$ru = $roz['ru'];
echo('<td width="25" align="center"><input type="checkbox" '); if (strripos($priv, "a$id ") === FALSE) {  } else { echo " checked "; } echo(' name="priv[]" id="priv_'.$id.'" style="border: 0" value="a'.$id.'"></td><td width="225"><label for="priv_'.$id.'">'.$ru.'</label></td>');

if ($i == '3') { echo "</tr>"; $i=1; } else {$i++; }
}

echo('</table>');

echo('<h2>Mechanical or Cosmetic Condition Report:</h2>');

echo('<table border="0" width="600" id="table1" cellpadding="0" style="border-collapse: collapse">
		<tr>
		<td colspan="9" height="25"><b>Exterior</b></td>
	</tr>');
$get_privz=mysql_query("Select * from `la_bukle` where `kat`='1'");
$i = 1;
$izz = 1;
while($otz=mysql_fetch_array($get_privz)) {
$ru = $otz['ru'];
$id = $otz['id'];
if ($i == '1') {
$bg = 'background-color: #eeeeff';
$i--;
} else {
$bg ='';
$i++;
}
$kor = $aut["i$izz"];
echo('<tr style="'.$bg.'">
		<td style="padding: 0 0 0 10px; '.$bg.'">'.$ru.'</td>
		<td width="20" style="'.$bg.'"><input '); if ($kor == '0') { echo " checked "; } else { } echo(' style="border: 0; '.$bg.'" type="radio" name="i_'.$izz.'" value="0" id="bb'.$id.'_0"></td>
		<td width="80" style="'.$bg.'"><label for="bb'.$id.'_0" style="color:#0066CC">Excellent</label></td>
		<td width="20" style="'.$bg.'"><input '); if ($kor == '1') { echo " checked "; } else { } echo(' style="border: 0; '.$bg.'" type="radio" name="i_'.$izz.'" value="1" id="bb'.$id.'_1"></td>
		<td width="80" style="'.$bg.'"><label for="bb'.$id.'_1" style="color:#009900">Good</label></td>
		<td width="20" style="'.$bg.'"><input '); if ($kor == '2') { echo " checked "; } else { } echo(' style="border: 0; '.$bg.'" type="radio" name="i_'.$izz.'" value="2" id="bb'.$id.'_2"></td>
		<td width="80" style="'.$bg.'"><label for="bb'.$id.'_2" style="color:#FF9900">Fair</label></td>
		<td width="20" style="'.$bg.'"><input '); if ($kor == '3') { echo " checked "; } else { } echo(' style="border: 0; '.$bg.'" type="radio" name="i_'.$izz.'" value="3" id="bb'.$id.'_3"></td>
		<td width="80" style="'.$bg.'"><label for="bb'.$id.'_3" style="color:#FF0000">Bad</label></td>
	</tr>');
$izz++;
}
echo('<tr><td colspan="9" height="25"><b>Interior</b></td></tr>');
$get_privz=mysql_query("Select * from `la_bukle` where `kat`='2'");
$i = 1;
$izz = 1;
while($otz=mysql_fetch_array($get_privz)) {
$ru = $otz['ru'];
$id = $otz['id'];
if ($i == '1') {
$bg = 'background-color: #eeeeff';
$i--;
} else {
$bg ='';
$i++;
}
$kore = $aut["v$izz"];
echo('<tr style="'.$bg.'">
		<td style="padding: 0 0 0 10px; '.$bg.'">'.$ru.'</td>
		<td width="20" style="'.$bg.'"><input '); if ($kore == '0') { echo " checked "; } else { } echo(' style="border: 0; '.$bg.'" type="radio" name="v_'.$izz.'" value="0" id="bb'.$id.'_0"></td>
		<td width="80" style="'.$bg.'"><label for="bb'.$id.'_0" style="color:#0066CC">Excellent</label></td>
		<td width="20" style="'.$bg.'"><input '); if ($kore == '1') { echo " checked "; } else { } echo(' style="border: 0; '.$bg.'" type="radio" name="v_'.$izz.'" value="1" id="bb'.$id.'_1"></td>
		<td width="80" style="'.$bg.'"><label for="bb'.$id.'_1" style="color:#009900">Good</label></td>
		<td width="20" style="'.$bg.'"><input '); if ($kore == '2') { echo " checked "; } else { } echo(' style="border: 0; '.$bg.'" type="radio" name="v_'.$izz.'" value="2" id="bb'.$id.'_2"></td>
		<td width="80" style="'.$bg.'"><label for="bb'.$id.'_2" style="color:#FF9900">Fair</label></td>
		<td width="20" style="'.$bg.'"><input '); if ($kore == '3') { echo " checked "; } else { } echo(' style="border: 0; '.$bg.'" type="radio" name="v_'.$izz.'" value="3" id="bb'.$id.'_3"></td>
		<td width="80" style="'.$bg.'"><label for="bb'.$id.'_3" style="color:#FF0000">Bad</label></td>
	</tr>');
$izz++;
}
echo('<tr><td colspan="9" height="25"><b>Меchanical</b></td></tr>');
$get_privz=mysql_query("Select * from `la_bukle` where `kat`='3'");
$i = 1;
$izz =1;
while($otz=mysql_fetch_array($get_privz)) {
$ru = $otz['ru'];
$id = $otz['id'];
if ($i == '1') {
$bg = 'background-color: #eeeeff';
$i--;
} else {
$bg ='';
$i++;
}
$korm = $aut["m$izz"];
echo('<tr style="'.$bg.'">
		<td style="padding: 0 0 0 10px; '.$bg.'">'.$ru.'</td>
		<td width="20" style="'.$bg.'"><input '); if ($korm == '0') { echo " checked "; } else { } echo(' style="border: 0; '.$bg.'" type="radio" name="m_'.$izz.'" value="0" id="bb'.$id.'_0"></td>
		<td width="80" style="'.$bg.'"><label for="bb'.$id.'_0" style="color:#0066CC">Excellent</label></td>
		<td width="20" style="'.$bg.'"><input '); if ($korm == '1') { echo " checked "; } else { } echo(' style="border: 0; '.$bg.'" type="radio" name="m_'.$izz.'" value="1" id="bb'.$id.'_1"></td>
		<td width="80" style="'.$bg.'"><label for="bb'.$id.'_1" style="color:#009900">Good</label></td>
		<td width="20" style="'.$bg.'"><input '); if ($korm == '2') { echo " checked "; } else { } echo(' style="border: 0; '.$bg.'" type="radio" name="m_'.$izz.'" value="2" id="bb'.$id.'_2"></td>
		<td width="80" style="'.$bg.'"><label for="bb'.$id.'_2" style="color:#FF9900">Fair</label></td>
		<td width="20" style="'.$bg.'"><input '); if ($korm == '3') { echo " checked "; } else { } echo(' style="border: 0; '.$bg.'" type="radio" name="m_'.$izz.'" value="3" id="bb'.$id.'_3"></td>
		<td width="80" style="'.$bg.'"><label for="bb'.$id.'_3" style="color:#FF0000">Bad</label></td>
	</tr>');
$izz++;
}
$id = $_GET['id'];

echo('<tr><td colspan="9" height="25"></td></tr><tr><td colspan="9" height="22"><b>Additional information:</b></td></tr><tr><td colspan="9"><input type="hidden" name="izz" value="'.$izz.'"><textarea rows="5" name="info" style="width: 600px">'.$info.'</textarea></td></tr>');
echo('<tr><td colspan="9" height="35" align="center"><input type="submit" value="Mark as Sold" name="sel_prod"><input type="submit" value="Unmark as Sold" name="sel_nonprod"> <input type="submit" value="Renew Add!"></td></tr>');
echo('</table></form>');


} else if ($step == 'del_photo') {
$id = $_GET['id'];
$geto=mysql_query("Select * from `auto` where `id`='$id'");
$gzz=mysql_fetch_array($geto);
$gift = $gzz['gift'];
@unlink("$gift");
$delaz=mysql_query("Update `auto` set `gift`='' where `id`='$id'");

echo('<script type="text/javascript">window.location = "?psl=loged&do=auto&step=edit&id='.$id.'"</script>');
} else if ($step == 'photo') {
$sid = $_GET['id'];
echo('<h1>Edit/Delete Photos</h1>');
$get_fotos=mysql_query("Select * from `foto` where `type`='1' and `sid`='$sid' order by `id` asc");
while($ozz=mysql_fetch_array($get_fotos)) {
$id = $ozz['id'];
$url = $ozz['url'];
echo('<div style="float: left; background: #FFFFFF; padding: 3px; border: 1px solid #cccccc; text-align: center; height: 135px; margin: 0 4px 10px 4px; width: 134px"><span id="images"><a rel="group" target="_blank" class="images" href="phpThumb.php?src='.$url.'&w=800"><img src="phpThumb.php?src='.$url.'&w=134&h=108" style="margin: 0 0 3px 0; border: 0"></a></span><br><a onClick="if(confirm(\'Are you sure you want to remove this Photo?\')); else return false;" href="?psl=loged&do=auto&step=df&sid='.$sid.'&fid='.$id.'">Delete</a></div>');

}
echo('<div style="clear: both"></div>');

echo('<div align="center" style="margin: 25px 0 0 0">
<div style="width: 250px; height: auto; margin: 25px 0 15px 0; background: #F8F8F8; text-align: left; padding: 0 10px 10px 10px; border: 1px solid #cccccc"><h2>Add Photo</h2>
<form method="post" enctype="multipart/form-data" action="?psl=loged&do=auto&step=up_ff" name="sfoto"><input type="file" onchange="document.sfoto.submit()" name="foto" style="width:250px"><input type="hidden" name="sid" value="'.$sid.'"></form></div></div>');

echo('<div style="width: 100%; padding: 10px; border-top: 1px solid #cccccc"><a href="loged/auto.html">List of Vehicles</a> | <a href="/">Go to Main Page</a> | <a href="loged/auto/add.html">Add New Vehicle</a></div>');
} else if ($step == 'df') {
$sid = $_GET['sid'];
$fid = $_GET['fid'];
$get_foto=mysql_query("Select * from `foto` where `sid`='$sid' and `id`='$fid'");
$otz=mysql_fetch_array($get_foto);
$url = $otz['url'];
@unlink("$url");
$delasz=mysql_query("Delete from `foto` where `sid`='$sid' and `id`='$fid'");
echo('<script type="text/javascript">window.location = "?psl=loged&do=auto&step=photo&id='.$sid.'"</script>');
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
$insas=mysql_query("Insert into `foto` set `url`='$file_destination', `sid`='$sid', `type`='1'");
} else {

}
echo('<script type="text/javascript">window.location = "?psl=loged&do=auto&step=photo&id='.$sid.'"</script>');
}
} else if ($step == 'delete') {
$id = $_GET['id'];
$uid = $uss['id'];
$utype = $uss['type'];
if ($utype =='f56e82798de1b89f7a4d77479ead7280') {
$get_zz=mysql_query("Select * from `auto` where `id`='$id'");
} else {
$get_zz=mysql_query("Select * from `auto` where `id`='$id' and `uid`='$uid'");
}
$skkz=mysql_num_rows($get_zz);
if ($skkz == 1) {
$delf=mysql_query("Select * from `foto` where `type`='1' and `sid`='$id'");
while($fo=mysql_fetch_array($delf)) {
$url = $fo['url'];
@unlink("$url");
}
$delz=mysql_query("Delete from `foto` where `type`='1' and `sid`='$id'");
if ($utype =='f56e82798de1b89f7a4d77479ead7280') {
$del_a=mysql_query("Delete from `auto` where `id`='$id'");
} else {
$del_a=mysql_query("Delete from `auto` where `id`='$id' and `uid`='$uid'");
}
}
echo('<script type="text/javascript">window.location = "?psl=loged&do=auto&msg=deleted"</script>');
} else if ($step == 'del_sel') {
$yp = $_POST['c'];

if (count($yp) != '0') {
while(list($name, $value) = each($yp)) {

$imk_mot=mysql_query("Select * from `foto` where `sid`='$value' and `type`='1'");
while($ff=mysql_fetch_array($imk_mot)) {
$url = $ff['url'];

@unlink("$url");

}
$del_ff=mysql_query("Delete from `foto` where `sid`='$value' and `type`='1'");
$del_mo=mysql_query("Delete from `auto` where `id`='$value'");

}
}
echo('<script type="text/javascript">window.location = "?psl=loged&do=auto&msg=deleted2"</script>');

} else if ($step == 'sel_prod') {


$yp = $_POST['c'];
if (count($yp) != '0') {
while(list($name, $value) = each($yp)) {
$dt = date("Y-m-d H:i:s");
//$updazz=mysql_query("Update `auto` set `parduota`='$dt' where `id`='$value'");
$updazz=mysql_query("Update `auto` set `parduota`='1' where `id`='$value'");
}
}
echo('<script type="text/javascript">window.location = "?psl=loged&do=auto&msg=prod"</script>');

} else if ($step == 'sel_nprod') {
$yp = $_POST['c'];
if (count($yp) != '0') {
while(list($name, $value) = each($yp)) {

$updazz=mysql_query("Update `auto` set `parduota`='0' where `id`='$value'");
}
}
echo('<script type="text/javascript">window.location = "?psl=loged&do=auto&msg=nprod"</script>');

} else if ($step == 'intop') {
$utype = $uss['type'];
$vipd = $uss['vip'];
$dabar = date("Y-m-d H:i:s");
$w = addslashes($_GET['w']);
if ($utype == 'f56e82798de1b89f7a4d77479ead7280' || $vipd >= $dabar) {

$yp = $_POST['c'];
if (count($yp) != '0') {
while(list($name, $value) = each($yp)) {

$updazz=mysql_query("Update `auto` set `onmain`='$w' where `id`='$value'");
}
}

}
echo('<script type="text/javascript">window.location = "?psl=loged&do=auto&msg=intop_'.$w.'"</script>');

}

?>