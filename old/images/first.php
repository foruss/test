<script lang="javascript">
function getmo(ivesta) {
    with(document.getElementById('model')) {
      
      while(length) remove(0);
      options.add(new Option('- Выберите -', ''));
      
      var sry_loader = document.createElement('script'); 
      document.body.appendChild(sry_loader); 
      sry_loader.src = "getm.php?in=" + ivesta;


    }
  }

function finder(kas) {

	if (kas == 'cars') {
document.getElementById('f1').style.display='';
document.getElementById('f2').style.display='none';
document.getElementById('f3').style.display='none';
	} else if (kas == 'wrecked-cars') {
document.getElementById('f1').style.display='';
document.getElementById('f2').style.display='none';
document.getElementById('f3').style.display='none';
	} else if (kas == 'wrecked-moto' || kas == 'moto') {
document.getElementById('f1').style.display='none';
document.getElementById('f2').style.display='';
document.getElementById('f3').style.display='none';
	} else if (kas == 'wrecked-boats' || kas == 'boats') {
document.getElementById('f1').style.display='none';
document.getElementById('f2').style.display='none';
document.getElementById('f3').style.display='';
	}
}
  </script>
	<div class="u_block">
					<div class="u_block-cont">
				<div style="float: left; width: 345px">	
					<h3>Поиск</h3><form method="get" action="?psl=search"><table border="0" width="340">
				<tr>
		<td height="22" colspan="2">Категория<br>
		<select size="1" name="kat" onchange="finder(this.value)" style="width: 300px; margin: 5px 0 0 0">
		<?php 
		$get_it_ff=mysql_query("Select * from `sand_cat` where `on`='1' order by `id` asc");
		while($oxx=mysql_fetch_array($get_it_ff)) {
		$ru = $oxx['ru'];
		$url = $oxx['url'];
		$ru = str_replace("<br>", "", $ru);
		echo('<option value="'.$url.'">'.$ru.'</option>');
		}
		
		?>
		</select></td>

	</tr></table><table id="f1" border="0" width="340">
	<tr>
		<td>Марка<span class="red">*</span><br><select size="1" name="marke" onchange="getmo(this.value)" style="width: 130px; margin: 5px 0 0 0"><option value="">Выберите марку</option>
		<?php  $get_name=mysql_query("Select * from `marke` order by `name` asc");
		while($mar=mysql_fetch_array($get_name)) {
		$marke=$mar['name'];
		$id = $mar['id'];
		echo('<option value="'.$id.'">'.$marke.'</option>');
		}
		?>
		</select></td>
		<td>Модель<br><select size="1"  id="model" name="modelis" style="width: 130px; margin: 5px 0 0 0"><option value="">Выберите модель</option></select></td>
	</tr>

	<tr>
		<td>Год выпуска<br><input type="hidden" name="psl" value="search"><select size="1" name="nuo" style="width: 62px; margin: 5px 5px 0 0"><option value="">Oт</option><option value="2011">2011</option>
<option value="2010">2010</option>
<option value="2009">2009</option>
<option value="2008">2008</option>
<option value="2007">2007</option>
<option value="2006">2006</option>
<option value="2005">2005</option>
<option value="2004">2004</option>
<option value="2003">2003</option>
<option value="2002">2002</option>
<option value="2001">2001</option>
<option value="2000">2000</option>
<option value="1999">1999</option>
<option value="1998">1998</option>
<option value="1997">1997</option>
<option value="1996">1996</option>
<option value="1995">1995</option>
<option value="1994">1994</option>
<option value="1993">1993</option>
<option value="1992">1992</option>
<option value="1991">1991</option>
<option value="1990">1990</option>
<option value="1989">1989</option>
<option value="1988">1988</option>
<option value="1987">1987</option>
<option value="1986">1986</option>
<option value="1985">1985</option>
<option value="1984">1984</option>
<option value="1983">1983</option>
<option value="1982">1982</option>
<option value="1981">1981</option>
<option value="1980">1980</option>
<option value="1979">1979</option>
<option value="1978">1978</option>
<option value="1977">1977</option>
<option value="1976">1976</option>
<option value="1975">1975</option>
<option value="1974">1974</option>
<option value="1973">1973</option>
<option value="1972">1972</option>
<option value="1971">1971</option>
<option value="1970">1970</option>
<option value="1969">1969</option>
<option value="1968">1968</option>
<option value="1967">1967</option>
<option value="1966">1966</option>
<option value="1965">1965</option>
<option value="1964">1964</option>
<option value="1963">1963</option>
<option value="1962">1962</option>
<option value="1961">1961</option>
<option value="1960">1960</option>
<option value="1959">1959</option>
<option value="1958">1958</option>
<option value="1957">1957</option>
<option value="1956">1956</option>
<option value="1955">1955</option>
<option value="1954">1954</option>
<option value="1953">1953</option>
<option value="1952">1952</option>
<option value="1951">1951</option>
<option value="1950">1950</option>
<option value="1949">1949</option>
<option value="1948">1948</option>
<option value="1947">1947</option>
<option value="1946">1946</option>
<option value="1945">1945</option>
<option value="1944">1944</option>
<option value="1943">1943</option>
<option value="1942">1942</option>
<option value="1941">1941</option>
<option value="1940">1940</option>
<option value="1939">1939</option>
<option value="1938">1938</option>
<option value="1937">1937</option>
<option value="1936">1936</option>
<option value="1935">1935</option></select><select size="1" name="iki" style="width: 63px"><option value="">До</option><option value="2011">2011</option>
<option value="2010">2010</option>
<option value="2009">2009</option>
<option value="2008">2008</option>
<option value="2007">2007</option>
<option value="2006">2006</option>
<option value="2005">2005</option>
<option value="2004">2004</option>
<option value="2003">2003</option>
<option value="2002">2002</option>
<option value="2001">2001</option>
<option value="2000">2000</option>
<option value="1999">1999</option>
<option value="1998">1998</option>
<option value="1997">1997</option>
<option value="1996">1996</option>
<option value="1995">1995</option>
<option value="1994">1994</option>
<option value="1993">1993</option>
<option value="1992">1992</option>
<option value="1991">1991</option>
<option value="1990">1990</option>
<option value="1989">1989</option>
<option value="1988">1988</option>
<option value="1987">1987</option>
<option value="1986">1986</option>
<option value="1985">1985</option>
<option value="1984">1984</option>
<option value="1983">1983</option>
<option value="1982">1982</option>
<option value="1981">1981</option>
<option value="1980">1980</option>
<option value="1979">1979</option>
<option value="1978">1978</option>
<option value="1977">1977</option>
<option value="1976">1976</option>
<option value="1975">1975</option>
<option value="1974">1974</option>
<option value="1973">1973</option>
<option value="1972">1972</option>
<option value="1971">1971</option>
<option value="1970">1970</option>
<option value="1969">1969</option>
<option value="1968">1968</option>
<option value="1967">1967</option>
<option value="1966">1966</option>
<option value="1965">1965</option>
<option value="1964">1964</option>
<option value="1963">1963</option>
<option value="1962">1962</option>
<option value="1961">1961</option>
<option value="1960">1960</option>
<option value="1959">1959</option>
<option value="1958">1958</option>
<option value="1957">1957</option>
<option value="1956">1956</option>
<option value="1955">1955</option>
<option value="1954">1954</option>
<option value="1953">1953</option>
<option value="1952">1952</option>
<option value="1951">1951</option>
<option value="1950">1950</option>
<option value="1949">1949</option>
<option value="1948">1948</option>
<option value="1947">1947</option>
<option value="1946">1946</option>
<option value="1945">1945</option>
<option value="1944">1944</option>
<option value="1943">1943</option>
<option value="1942">1942</option>
<option value="1941">1941</option>
<option value="1940">1940</option>
<option value="1939">1939</option>
<option value="1938">1938</option>
<option value="1937">1937</option>
<option value="1936">1936</option>
<option value="1935">1935</option></select></td>
		<td>Тип кузова<br>
		<select size="1" name="kebulas" style="width: 130px; margin: 5px 0 0 0">
		<option value="">Выберите тип кузова</option>
		<?php 
		$get_keb=mysql_query("Select * from `la_kebulas` order by `ru` asc");
		while($gkb=mysql_fetch_array($get_keb)) {
		$k_id = $gkb['id'];
		$k_ru = $gkb['ru'];
		echo('<option value="'.$k_id.'">'.$k_ru.'</option>');
		
		}
		?>
		</select></td>
	</tr>
	<tr>
		<td>Тип двигателя<br><select size="1" name="variklis" style="width: 130px; margin: 5px 0 0 0">
		<option value="">Выберите тип двигателя</option>
		<?php 
			$get_kur=mysql_query("Select * from `la_variklis` order by `ru` asc");
		while($gkb=mysql_fetch_array($get_kur)) {
		$d_id = $gkb['id'];
		$d_ru = $gkb['ru'];
		echo('<option value="'.$d_id.'">'.$d_ru.'</option>');
		
		}
		
		
		?>
		</select></td>
		<td height="35" align="center"><input type="submit" name="submit" value="Найти"></td>
	</tr>
</table><table id="f2" style="display: none" border="0" width="340">
	<tr>
		<td>Марка<span class="red">*</span><br><input type="text" name="mo_marke" style="width: 130px; margin: 5px 0 0 0"></td>
		<td>Модель<br><input type="text" name="mo_model" style="width: 130px; margin: 5px 0 0 0"></td>
	</tr>

	<tr>
		<td>Год выпуска oт<br><select size="1" name="mo_nuo" style="width: 130px; margin: 5px 5px 0 0"><option value="2011">2011</option>
<option value="2010">2010</option>
<option value="2009">2009</option>
<option value="2008">2008</option>
<option value="2007">2007</option>
<option value="2006">2006</option>
<option value="2005">2005</option>
<option value="2004">2004</option>
<option value="2003">2003</option>
<option value="2002">2002</option>
<option value="2001">2001</option>
<option value="2000">2000</option>
<option value="1999">1999</option>
<option value="1998">1998</option>
<option value="1997">1997</option>
<option value="1996">1996</option>
<option value="1995">1995</option>
<option value="1994">1994</option>
<option value="1993">1993</option>
<option value="1992">1992</option>
<option value="1991">1991</option>
<option value="1990">1990</option>
<option value="1989">1989</option>
<option value="1988">1988</option>
<option value="1987">1987</option>
<option value="1986">1986</option>
<option value="1985">1985</option>
<option value="1984">1984</option>
<option value="1983">1983</option>
<option value="1982">1982</option>
<option value="1981">1981</option>
<option value="1980">1980</option>
<option value="1979">1979</option>
<option value="1978">1978</option>
<option value="1977">1977</option>
<option value="1976">1976</option>
<option value="1975">1975</option>
<option value="1974">1974</option>
<option value="1973">1973</option>
<option value="1972">1972</option>
<option value="1971">1971</option>
<option value="1970">1970</option>
<option value="1969">1969</option>
<option value="1968">1968</option>
<option value="1967">1967</option>
<option value="1966">1966</option>
<option value="1965">1965</option>
<option value="1964">1964</option>
<option value="1963">1963</option>
<option value="1962">1962</option>
<option value="1961">1961</option>
<option value="1960">1960</option>
<option value="1959">1959</option>
<option value="1958">1958</option>
<option value="1957">1957</option>
<option value="1956">1956</option>
<option value="1955">1955</option>
<option value="1954">1954</option>
<option value="1953">1953</option>
<option value="1952">1952</option>
<option value="1951">1951</option>
<option value="1950">1950</option>
<option value="1949">1949</option>
<option value="1948">1948</option>
<option value="1947">1947</option>
<option value="1946">1946</option>
<option value="1945">1945</option>
<option value="1944">1944</option>
<option value="1943">1943</option>
<option value="1942">1942</option>
<option value="1941">1941</option>
<option value="1940">1940</option>
<option value="1939">1939</option>
<option value="1938">1938</option>
<option value="1937">1937</option>
<option value="1936">1936</option>
<option value="1935">1935</option></select></td>
		<td>Год выпуска дo<br><select size="1" name="mo_iki" style="width: 130px; margin: 5px 0 0 0"><option value="2011">2011</option>
<option value="2010">2010</option>
<option value="2009">2009</option>
<option value="2008">2008</option>
<option value="2007">2007</option>
<option value="2006">2006</option>
<option value="2005">2005</option>
<option value="2004">2004</option>
<option value="2003">2003</option>
<option value="2002">2002</option>
<option value="2001">2001</option>
<option value="2000">2000</option>
<option value="1999">1999</option>
<option value="1998">1998</option>
<option value="1997">1997</option>
<option value="1996">1996</option>
<option value="1995">1995</option>
<option value="1994">1994</option>
<option value="1993">1993</option>
<option value="1992">1992</option>
<option value="1991">1991</option>
<option value="1990">1990</option>
<option value="1989">1989</option>
<option value="1988">1988</option>
<option value="1987">1987</option>
<option value="1986">1986</option>
<option value="1985">1985</option>
<option value="1984">1984</option>
<option value="1983">1983</option>
<option value="1982">1982</option>
<option value="1981">1981</option>
<option value="1980">1980</option>
<option value="1979">1979</option>
<option value="1978">1978</option>
<option value="1977">1977</option>
<option value="1976">1976</option>
<option value="1975">1975</option>
<option value="1974">1974</option>
<option value="1973">1973</option>
<option value="1972">1972</option>
<option value="1971">1971</option>
<option value="1970">1970</option>
<option value="1969">1969</option>
<option value="1968">1968</option>
<option value="1967">1967</option>
<option value="1966">1966</option>
<option value="1965">1965</option>
<option value="1964">1964</option>
<option value="1963">1963</option>
<option value="1962">1962</option>
<option value="1961">1961</option>
<option value="1960">1960</option>
<option value="1959">1959</option>
<option value="1958">1958</option>
<option value="1957">1957</option>
<option value="1956">1956</option>
<option value="1955">1955</option>
<option value="1954">1954</option>
<option value="1953">1953</option>
<option value="1952">1952</option>
<option value="1951">1951</option>
<option value="1950">1950</option>
<option value="1949">1949</option>
<option value="1948">1948</option>
<option value="1947">1947</option>
<option value="1946">1946</option>
<option value="1945">1945</option>
<option value="1944">1944</option>
<option value="1943">1943</option>
<option value="1942">1942</option>
<option value="1941">1941</option>
<option value="1940">1940</option>
<option value="1939">1939</option>
<option value="1938">1938</option>
<option value="1937">1937</option>
<option value="1936">1936</option>
<option value="1935">1935</option></select></td>
	</tr>
	<tr>
		<td></td>
		<td height="35" align="center"><input type="submit" name="submit" value="Найти"></td>
	</tr>
</table><table id="f3" style="display: none" border="0" width="340">
	<tr>
		<td>Производитель<span class="red">*</span><br><input type="text" name="bo_marke" style="width: 130px; margin: 5px 0 0 0"></td>
		<td>Название<br><input type="text" name="bo_model" style="width: 130px; margin: 5px 0 0 0"></td>
	</tr>

	<tr>
		<td>Год выпуска oт<br><select size="1" name="bo_nuo" style="width: 130px; margin: 5px 5px 0 0"><option value="2011">2011</option>
<option value="2010">2010</option>
<option value="2009">2009</option>
<option value="2008">2008</option>
<option value="2007">2007</option>
<option value="2006">2006</option>
<option value="2005">2005</option>
<option value="2004">2004</option>
<option value="2003">2003</option>
<option value="2002">2002</option>
<option value="2001">2001</option>
<option value="2000">2000</option>
<option value="1999">1999</option>
<option value="1998">1998</option>
<option value="1997">1997</option>
<option value="1996">1996</option>
<option value="1995">1995</option>
<option value="1994">1994</option>
<option value="1993">1993</option>
<option value="1992">1992</option>
<option value="1991">1991</option>
<option value="1990">1990</option>
<option value="1989">1989</option>
<option value="1988">1988</option>
<option value="1987">1987</option>
<option value="1986">1986</option>
<option value="1985">1985</option>
<option value="1984">1984</option>
<option value="1983">1983</option>
<option value="1982">1982</option>
<option value="1981">1981</option>
<option value="1980">1980</option>
<option value="1979">1979</option>
<option value="1978">1978</option>
<option value="1977">1977</option>
<option value="1976">1976</option>
<option value="1975">1975</option>
<option value="1974">1974</option>
<option value="1973">1973</option>
<option value="1972">1972</option>
<option value="1971">1971</option>
<option value="1970">1970</option>
<option value="1969">1969</option>
<option value="1968">1968</option>
<option value="1967">1967</option>
<option value="1966">1966</option>
<option value="1965">1965</option>
<option value="1964">1964</option>
<option value="1963">1963</option>
<option value="1962">1962</option>
<option value="1961">1961</option>
<option value="1960">1960</option>
<option value="1959">1959</option>
<option value="1958">1958</option>
<option value="1957">1957</option>
<option value="1956">1956</option>
<option value="1955">1955</option>
<option value="1954">1954</option>
<option value="1953">1953</option>
<option value="1952">1952</option>
<option value="1951">1951</option>
<option value="1950">1950</option>
<option value="1949">1949</option>
<option value="1948">1948</option>
<option value="1947">1947</option>
<option value="1946">1946</option>
<option value="1945">1945</option>
<option value="1944">1944</option>
<option value="1943">1943</option>
<option value="1942">1942</option>
<option value="1941">1941</option>
<option value="1940">1940</option>
<option value="1939">1939</option>
<option value="1938">1938</option>
<option value="1937">1937</option>
<option value="1936">1936</option>
<option value="1935">1935</option></select></td>
		<td>Год выпуска дo<br><select size="1" name="bo_iki" style="width: 130px; margin: 5px 0 0 0"><option value="2011">2011</option>
<option value="2010">2010</option>
<option value="2009">2009</option>
<option value="2008">2008</option>
<option value="2007">2007</option>
<option value="2006">2006</option>
<option value="2005">2005</option>
<option value="2004">2004</option>
<option value="2003">2003</option>
<option value="2002">2002</option>
<option value="2001">2001</option>
<option value="2000">2000</option>
<option value="1999">1999</option>
<option value="1998">1998</option>
<option value="1997">1997</option>
<option value="1996">1996</option>
<option value="1995">1995</option>
<option value="1994">1994</option>
<option value="1993">1993</option>
<option value="1992">1992</option>
<option value="1991">1991</option>
<option value="1990">1990</option>
<option value="1989">1989</option>
<option value="1988">1988</option>
<option value="1987">1987</option>
<option value="1986">1986</option>
<option value="1985">1985</option>
<option value="1984">1984</option>
<option value="1983">1983</option>
<option value="1982">1982</option>
<option value="1981">1981</option>
<option value="1980">1980</option>
<option value="1979">1979</option>
<option value="1978">1978</option>
<option value="1977">1977</option>
<option value="1976">1976</option>
<option value="1975">1975</option>
<option value="1974">1974</option>
<option value="1973">1973</option>
<option value="1972">1972</option>
<option value="1971">1971</option>
<option value="1970">1970</option>
<option value="1969">1969</option>
<option value="1968">1968</option>
<option value="1967">1967</option>
<option value="1966">1966</option>
<option value="1965">1965</option>
<option value="1964">1964</option>
<option value="1963">1963</option>
<option value="1962">1962</option>
<option value="1961">1961</option>
<option value="1960">1960</option>
<option value="1959">1959</option>
<option value="1958">1958</option>
<option value="1957">1957</option>
<option value="1956">1956</option>
<option value="1955">1955</option>
<option value="1954">1954</option>
<option value="1953">1953</option>
<option value="1952">1952</option>
<option value="1951">1951</option>
<option value="1950">1950</option>
<option value="1949">1949</option>
<option value="1948">1948</option>
<option value="1947">1947</option>
<option value="1946">1946</option>
<option value="1945">1945</option>
<option value="1944">1944</option>
<option value="1943">1943</option>
<option value="1942">1942</option>
<option value="1941">1941</option>
<option value="1940">1940</option>
<option value="1939">1939</option>
<option value="1938">1938</option>
<option value="1937">1937</option>
<option value="1936">1936</option>
<option value="1935">1935</option></select></td>
	</tr>
	<tr>
		<td></td>
		<td height="35" align="center"><input type="submit" name="submit" value="Найти"></td>
	</tr>
</table></form>
</div>
<div style="float: left; width: 50px"><img src="images/cars.png" width="41" heght="25" style="margin: 0 0 10px 0"><img src="images/moto.png" width="40" heght="25" style="margin: 0 0 10px 0"><img src="images/boat.png" width="50" heght="25" style="margin: 0 0 10px 0"></div>

<div style="float: right; width: 400px; text-align: left">
<?php include('main_offers.php'); ?>
</div>
					<div style="clear: both"></div>
					
</div>
					<div class="t_l"></div><div class="t_r"></div><div class="b_l"></div><div class="b_r"></div>
				</div>
				<div id="lside" style="float: left; width: 190px">
	<div class="u_block">
					<div class="u_block-cont" style="text-align: center; padding: 5px 0 0 0; margin: 0; height: 62px">
<a href="/"><img src="/images/autmx-mini_logo.png" alt="Automixs" border="0" height="57" width="118"></a></div>
					<div class="t_l"></div><div class="t_r"></div><div class="b_l"></div><div class="b_r"></div>
				<div style="Clear: both"></div></div>
<?php  include('user_menu.php'); ?>
<?php  include('left_menu.php'); ?>
<div class="u_block">
<div class="u_block-cont" style="text-align: center; padding: 5px 0 0 0; margin: 0; height: auto">
<?php include('adv_4.php'); ?>
<div class="t_l"></div><div class="t_r"></div><div class="b_l"></div><div class="b_r"></div>
				<div style="Clear: both"></div></div></div>
</div>
<div id="content" style="float: right; width: 785px; margin: 0 0 5px 0">
				<div style="margin: 10px 0">
				<div style="float: left; width: 340px"><?php  include('adv_3.php'); ?></div>
				<div style="float: right; height: 148px; background: #edecec; width: 403px; padding: 10px">
			<?php 	echo('<div style="line-height: 150%; font-size: 8pt">');


$get_news=mysql_query("Select * from `news` order by `data` desc LIMIT 0,5");
while($nws=mysql_fetch_array($get_news)) {
$data = ru_date($nws['data']);
$title = $nws['title'];
$url = $nws['url'];
echo(''.$data.' <a title="Читать новость - '.$title.'" style="margin: 0 0 0 10px" href="news/'.$url.'.html">'.$title.'</a><br>');
}
echo('</div>');
				 ?>
				</div>
				<div style="clear: both"></div>
				</div>
				
<div class="u_block">
<div class="u_block-cont">
<?php include('fp_blocks.php'); ?>
</div><div class="t_l"></div><div class="t_r"></div><div class="b_l"></div><div class="b_r"></div></div>