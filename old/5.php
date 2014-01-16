<h1>Редактировать автомобиль</h1><div align="left"><a href="?psl=loged&do=auto&step=photo&id=194">редактировать фото</a></div><div style="float: left; width: 370px; border-right: 1px dashed #e1e1e1"><h2>Основные данные:</h2><form name="nskk" action="update_auto.php" method="post" enctype="multipart/form-data"><table border="0" width="370" cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td height="22" width="130">Марка:</td>
		<td><select size="1" name="marke"  onchange="getmo(this.value)" style="width: 200px"><option value="">- Выберите -</option><option  value="44">Acura</option><option  value="55">Aixam</option><option  value="1">Alfa Romeo</option><option  value="56">Alpina</option><option  value="58">AMC</option><option  value="57">ARO</option><option  value="59">Asia</option><option  value="60">Aston Martin</option><option  value="2">Audi</option><option  value="49">Bentley</option><option  value="3">BMW</option><option  value="61">Brilliance</option><option  value="62">Bugatti</option><option  value="63">Buick</option><option  value="42">Cadillac</option><option  value="64">Caterham</option><option  value="50">Chevrolet</option><option  value="4">Chrysler</option><option  value="5">Citroen</option><option  value="65">Dacia</option><option  value="7">Daewoo</option><option  value="66">Daihatsu</option><option  value="68">Datsun</option><option  value="67">De Lorean</option><option  value="6">DODGE</option><option  value="69">Eagle</option><option  value="70">Ferrari</option><option  value="8">Fiat</option><option  value="9">Ford</option><option  value="72">GAZ</option><option  value="71">Geo</option><option  value="54">GMC</option><option  value="75">Great Wall</option><option  value="73">Grecav</option><option  value="74">GVVM</option><option  value="10">Honda</option><option  value="43">Hummer</option><option  value="11">Hyundai</option><option  value="12">Infinity</option><option  value="76">International</option><option  value="77">Isuzu</option><option  value="78">Iveco</option><option  value="47">Jaguar</option><option  value="13">Jeep</option><option  value="14">KIA</option><option  value="79">Lada</option><option  value="80">Lamborghini</option><option  value="15">Lancia</option><option  value="81">Land Rover</option><option  value="16">Lexus</option><option  value="82">Lincoln</option><option  value="83">Lotus</option><option  value="84">LTI</option><option  value="85">LuAZ</option><option  value="17">MAN</option><option  value="88">Maserati</option><option  value="87">Maybach</option><option  value="18">Mazda</option><option  value="19">Mercedes-Benz</option><option  value="40">Mercury</option><option  value="89">Merkur</option><option  value="46">MG</option><option  value="90">Microcar</option><option  value="48">Mini</option><option  value="20">Mitsubishi</option><option  value="91">Morgan</option><option  value="92">Moskvich</option><option  value="21">Nissan</option><option  value="95">Norster</option><option  value="94">NSU</option><option  value="93">Nysa</option><option  value="22">Oldsmobile</option><option  value="96">Oltcit</option><option  value="23">Opel</option><option  value="97">Panoz</option><option  value="24">Peugeot</option><option  value="98">Plymouth</option><option  value="99">Polonez</option><option  value="51">Pontiac</option><option  value="41">Porsche</option><option  value="101">Proton</option><option  value="100">Qvale</option><option  value="25">Renault</option><option  value="102">Rolls-Royce</option><option  value="26">Rover</option><option  value="27">SAAB</option><option  value="104">Saleen</option><option  value="103">Santana</option><option  value="105">Saturn</option><option  value="53">Scion</option><option  value="28">SEAT</option><option  value="106">Secma</option><option  value="107">Shuanghuan</option><option  value="29">Skoda</option><option  value="52">Smart</option><option  value="110">Spyker</option><option  value="109">SsangYong</option><option  value="111">Sterling</option><option  value="30">Subaru</option><option  value="31">Suzuki</option><option  value="108">Syrena</option><option  value="114">Tarpan</option><option  value="113">Tata</option><option  value="115">Tatra</option><option  value="116">Tavria</option><option  value="112">Tesla</option><option  value="32">Toyota</option><option  value="117">Trabant</option><option  value="118">Triumph</option><option  value="119">TVR</option><option  value="120">UAZ</option><option  value="121">Volga</option><option  value="33">Volkswagen</option><option  value="34">Volvo</option><option  value="124">Warszawa</option><option  value="125">Wartburg</option><option  value="123">Yugo</option><option  value="126">ZAZ</option><option  value="35">ВАЗ</option><option  value="36">ГАЗ</option><option  value="37">Другие а/м</option><option  value="127">ЗАЗ</option><option  value="38">Спецтехника</option><option  value="39">УАЗ</option></select></td>
	</tr>
	<tr>
		<td height="22" width="130">Модель:</td>
		<td><select size="1" name="modelis" id="model" style="width: 200px"><option value="">- Выберите -</option></select></td>
	</tr>
	<tr>
		<td height="22" width="130">Категория:</td>
		<td><select size="1" name="kat" style="width: 200px"><option  selected  value="0">Целое</option><option  value="1">С повреждением</option></select></td>
	</tr>
	<tr>
		<td height="22" width="130">Цвет:</td>
		<td><select size="1" name="color" style="width: 200px"><option value="">- Выберите -</option><option  value="15">Белый</option><option  value="6">Вишневый</option><option  value="3">Голубой</option><option  value="16">Жёлтый</option><option  value="8">Зелёный</option><option  value="7">Золотой</option><option  value="5">Коричневый</option><option  value="13">Красный</option><option  value="11">Оранжевый</option><option  value="17">Песочный</option><option  value="9">Светло-зелёный</option><option  value="10">Светло-серый</option><option  value="14">Серебряный</option><option  value="1">Серый</option><option  value="4">Синий</option><option  value="12">Фиолетовый</option><option  value="2">Чёрный</option></select></td>
	</tr>
		<tr>
		<td height="22" width="130">Цвет салона:</td>
		<td><select size="1" name="scolor" style="width: 200px"><option value="">- Выберите -</option><option  value="4">Бежовый</option><option  value="1">Белый</option><option  value="7">Жёлтый</option><option  value="5">Красный</option><option  value="8">Рыжый</option><option  value="3">Серый</option><option  value="6">Синий</option><option  value="2">Чёрный</option></select></td>
	</tr>
	<tr>
		<td height="22" width="130">Тип документа:</td>
		<td><select size="1" name="title" style="width: 200px"><option value="">- Выберите -</option><option  value="3">Ребилд</option><option  value="1">Салвич</option><option  value="2">Чистый</option></select></td>
	</tr><tr>
		<td height="22" width="130">VIN:</td>
		<td><input type="text" name="vin" value="" style="width: 200px"><input type="hidden" name="uid" value="2"></td>
	</tr><tr>
		<td height="22" width="130">Год выпуска:</td>
		<td><select size="1" name="metai" style="width: 200px"><option value="">- Выберите -</option><option selected value="0">0</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option></select></td>
	</tr><tr>
		<td height="22" width="130">Тип кузова:</td>
		<td><select size="1" name="keb" style="width: 200px"><option value="">- Выберите -</option><option  value="4">внедорожник</option><option  value="8">другой</option><option  value="6">кабриолет</option><option  value="5">купе</option><option  value="2">минивэн</option><option  value="1">седан</option><option  value="7">универсал</option><option  value="3">хэтчбэк</option></select></td>
	</tr><tr>
		<td height="22" width="130">Тип двигателя:</td>
		<td><select size="1" name="variklis" style="width: 200px"><option value="">- Выберите -</option><option  value="1">бензин впрыск</option><option  value="3">бензин турбо</option><option  value="6">впрыск</option><option  value="7">газ-бензин</option><option  value="2">дизель</option><option  value="8">дизель</option><option  value="5">другой</option><option  value="9">инжектор</option><option  value="10">карбюратор</option><option  value="11">моновпрыск</option><option  value="4">турбодизель</option><option  value="12">турбодизель с интеркулером</option></select></td>
	</tr>
</table></div><div style="float: right; width: 350px"><h2>Данны по автомобилю:</h2><table border="0" width="350" cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td height="22" width="130">Объем двигателя:</td>
		<td><input type="text" name="turis" value="" style="width: 200px"></td>
	</tr>
	<tr>
		<td height="22" width="130">Пробег:</td>
		<td><input type="text" name="rida" value="" style="width: 150px"><select size="1" name="rtipas" style="width: 45px; margin: 0 0 0 5px"><option  selected  value="0">км</option><option  value="1">мили</option></select></td>
	</tr><tr>
		<td height="22" width="130">Трансмиссия (КПП):</td>
		<td><select size="1" name="pavd" style="width: 202px"><option value="">- Выберите -</option><option  value="1">Автоматическая</option><option  value="2">Комбинированная</option><option   value="3">Механическая</option></select></td>
	</tr><tr>
		<td height="22" width="130">Цена:</td>
		<td><input type="text" name="kaina" value="0" style="width: 150px"><select size="1" name="ktipas" style="width: 45px; margin: 0 0 0 5px"><option  selected   value="1">€</option><option   value="2">$</option></select></td>
	</tr><tr>
		<td height="22" width="130">Страна:</td>
		<td><input type="text" value="" name="vieta" style="width: 202px"><input type="hidden" name="insider" value="194"><input type="hidden" name="utype" value="f56e82798de1b89f7a4d77479ead7280"></td>
	</tr><tr>
		<td height="22" width="130">Город:</td>
		<td><input type="text" value="" name="miestas" style="width: 202px"></td>
	</tr><tr>
		<td height="22" width="130">Подарок фото:</td>
		<td><input type="file" name="dovana" style="width: 200px"></td>
	</tr><tr>
		<td height="22" width="130">Ссылка(for free):</td>
		<td><input type="text" name="slink" value="" style="width: 200px"></td>
	</tr><tr>
		<td height="22" width="130">Акция:</td>
		<td><select name="akcija" style="width: 202px"><option  selected  value="0">Не участвует в акции</option><option  value="1">Бесплатное место</option><option  value="2">Бесплатная доставка</option></select></td>
	</tr></table></div><div style="clear: both"></div><h2 style="padding: 15px 0 0 0">Опции:</h2><table border="0" width="750" id="table1" cellpadding="1" style="border-collapse: collapse"><tr><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_1" style="border: 0" value="a1"></td><td width="225"><label for="priv_1">CD-Проигрыватель</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_2" style="border: 0" value="a2"></td><td width="225"><label for="priv_2">АБС</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_3" style="border: 0" value="a3"></td><td width="225"><label for="priv_3">антипробукс. система</label></td></tr><tr><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_6" style="border: 0" value="a6"></td><td width="225"><label for="priv_6">баг. на крыше (релинги)</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_7" style="border: 0" value="a7"></td><td width="225"><label for="priv_7">бортовой комп.</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_8" style="border: 0" value="a8"></td><td width="225"><label for="priv_8">велюровый салон</label></td></tr><tr><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_9" style="border: 0" value="a9"></td><td width="225"><label for="priv_9">гидроусилитель руля</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_10" style="border: 0" value="a10"></td><td width="225"><label for="priv_10">датчик дождя</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_11" style="border: 0" value="a11"></td><td width="225"><label for="priv_11">иммобилайзер</label></td></tr><tr><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_12" style="border: 0" value="a12"></td><td width="225"><label for="priv_12">катализатор</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_13" style="border: 0" value="a13"></td><td width="225"><label for="priv_13">климат-контроль</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_14" style="border: 0" value="a14"></td><td width="225"><label for="priv_14">кожанный салон</label></td></tr><tr><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_15" style="border: 0" value="a15"></td><td width="225"><label for="priv_15">кондиционер</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_5" style="border: 0" value="a5"></td><td width="225"><label for="priv_5">корректор фар</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_16" style="border: 0" value="a16"></td><td width="225"><label for="priv_16">круиз-контроль</label></td></tr><tr><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_17" style="border: 0" value="a17"></td><td width="225"><label for="priv_17">ксенон</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_18" style="border: 0" value="a18"></td><td width="225"><label for="priv_18">литые диски</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_19" style="border: 0" value="a19"></td><td width="225"><label for="priv_19">люк</label></td></tr><tr><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_37" style="border: 0" value="a37"></td><td width="225"><label for="priv_37">Навигация</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_20" style="border: 0" value="a20"></td><td width="225"><label for="priv_20">обогрев зеркал</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_22" style="border: 0" value="a22"></td><td width="225"><label for="priv_22">омыватель фар</label></td></tr><tr><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_23" style="border: 0" value="a23"></td><td width="225"><label for="priv_23">отделка под дерево</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_24" style="border: 0" value="a24"></td><td width="225"><label for="priv_24">парктроник</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_21" style="border: 0" value="a21"></td><td width="225"><label for="priv_21">подогрев сидений</label></td></tr><tr><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_25" style="border: 0" value="a25"></td><td width="225"><label for="priv_25">подушка безопасности водителя</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_26" style="border: 0" value="a26"></td><td width="225"><label for="priv_26">подушка безопасности пассажира</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_27" style="border: 0" value="a27"></td><td width="225"><label for="priv_27">подушки безопасности боковые</label></td></tr><tr><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_28" style="border: 0" value="a28"></td><td width="225"><label for="priv_28">подушки безопасности оконные</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_29" style="border: 0" value="a29"></td><td width="225"><label for="priv_29">притовотуманные фары</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_4" style="border: 0" value="a4"></td><td width="225"><label for="priv_4">серворуль</label></td></tr><tr><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_30" style="border: 0" value="a30"></td><td width="225"><label for="priv_30">сигнализация</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_31" style="border: 0" value="a31"></td><td width="225"><label for="priv_31">стереомагнитола</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_32" style="border: 0" value="a32"></td><td width="225"><label for="priv_32">турбонаддув</label></td></tr><tr><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_33" style="border: 0" value="a33"></td><td width="225"><label for="priv_33">центральный замок</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_34" style="border: 0" value="a34"></td><td width="225"><label for="priv_34">э/сидения</label></td><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_35" style="border: 0" value="a35"></td><td width="225"><label for="priv_35">электр. стеклоподъемники</label></td></tr><tr><td width="25" align="center"><input type="checkbox"  name="priv[]" id="priv_36" style="border: 0" value="a36"></td><td width="225"><label for="priv_36">электропривод зеркал</label></td></table><h2>Состояние авто:</h2><table border="0" width="600" id="table1" cellpadding="0" style="border-collapse: collapse">
		<tr>
		<td colspan="9" height="25"><b>Снаружи</b></td>
	</tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">Передний бампер</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="i_1" value="0" id="bb1_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb1_0" style="color:#0066CC">Отличное</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_1" value="1" id="bb1_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb1_1" style="color:#009900">Хорошее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_1" value="2" id="bb1_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb1_2" style="color:#FF9900">Среднее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_1" value="3" id="bb1_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb1_3" style="color:#FF0000">Плохое</label></td>
	</tr><tr style="">
		<td style="padding: 0 0 0 10px; ">Передняя решетка</td>
		<td width="20" style=""><input  checked  style="border: 0; " type="radio" name="i_2" value="0" id="bb2_0"></td>
		<td width="80" style=""><label for="bb2_0" style="color:#0066CC">Отличное</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_2" value="1" id="bb2_1"></td>
		<td width="80" style=""><label for="bb2_1" style="color:#009900">Хорошее</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_2" value="2" id="bb2_2"></td>
		<td width="80" style=""><label for="bb2_2" style="color:#FF9900">Среднее</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_2" value="3" id="bb2_3"></td>
		<td width="80" style=""><label for="bb2_3" style="color:#FF0000">Плохое</label></td>
	</tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">Стекла</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="i_3" value="0" id="bb3_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb3_0" style="color:#0066CC">Отличное</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_3" value="1" id="bb3_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb3_1" style="color:#009900">Хорошее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_3" value="2" id="bb3_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb3_2" style="color:#FF9900">Среднее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_3" value="3" id="bb3_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb3_3" style="color:#FF0000">Плохое</label></td>
	</tr><tr style="">
		<td style="padding: 0 0 0 10px; ">Капот</td>
		<td width="20" style=""><input  checked  style="border: 0; " type="radio" name="i_4" value="0" id="bb4_0"></td>
		<td width="80" style=""><label for="bb4_0" style="color:#0066CC">Отличное</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_4" value="1" id="bb4_1"></td>
		<td width="80" style=""><label for="bb4_1" style="color:#009900">Хорошее</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_4" value="2" id="bb4_2"></td>
		<td width="80" style=""><label for="bb4_2" style="color:#FF9900">Среднее</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_4" value="3" id="bb4_3"></td>
		<td width="80" style=""><label for="bb4_3" style="color:#FF0000">Плохое</label></td>
	</tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">Левые двери</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="i_5" value="0" id="bb5_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb5_0" style="color:#0066CC">Отличное</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_5" value="1" id="bb5_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb5_1" style="color:#009900">Хорошее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_5" value="2" id="bb5_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb5_2" style="color:#FF9900">Среднее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_5" value="3" id="bb5_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb5_3" style="color:#FF0000">Плохое</label></td>
	</tr><tr style="">
		<td style="padding: 0 0 0 10px; ">Переднее левое крыло</td>
		<td width="20" style=""><input  checked  style="border: 0; " type="radio" name="i_6" value="0" id="bb6_0"></td>
		<td width="80" style=""><label for="bb6_0" style="color:#0066CC">Отличное</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_6" value="1" id="bb6_1"></td>
		<td width="80" style=""><label for="bb6_1" style="color:#009900">Хорошее</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_6" value="2" id="bb6_2"></td>
		<td width="80" style=""><label for="bb6_2" style="color:#FF9900">Среднее</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_6" value="3" id="bb6_3"></td>
		<td width="80" style=""><label for="bb6_3" style="color:#FF0000">Плохое</label></td>
	</tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">Заднее левое крыло</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="i_7" value="0" id="bb7_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb7_0" style="color:#0066CC">Отличное</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_7" value="1" id="bb7_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb7_1" style="color:#009900">Хорошее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_7" value="2" id="bb7_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb7_2" style="color:#FF9900">Среднее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_7" value="3" id="bb7_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb7_3" style="color:#FF0000">Плохое</label></td>
	</tr><tr style="">
		<td style="padding: 0 0 0 10px; ">Окраска</td>
		<td width="20" style=""><input  checked  style="border: 0; " type="radio" name="i_8" value="0" id="bb8_0"></td>
		<td width="80" style=""><label for="bb8_0" style="color:#0066CC">Отличное</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_8" value="1" id="bb8_1"></td>
		<td width="80" style=""><label for="bb8_1" style="color:#009900">Хорошее</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_8" value="2" id="bb8_2"></td>
		<td width="80" style=""><label for="bb8_2" style="color:#FF9900">Среднее</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_8" value="3" id="bb8_3"></td>
		<td width="80" style=""><label for="bb8_3" style="color:#FF0000">Плохое</label></td>
	</tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">Задний бампер</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="i_9" value="0" id="bb9_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb9_0" style="color:#0066CC">Отличное</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_9" value="1" id="bb9_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb9_1" style="color:#009900">Хорошее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_9" value="2" id="bb9_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb9_2" style="color:#FF9900">Среднее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_9" value="3" id="bb9_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb9_3" style="color:#FF0000">Плохое</label></td>
	</tr><tr style="">
		<td style="padding: 0 0 0 10px; ">Правые двери</td>
		<td width="20" style=""><input  checked  style="border: 0; " type="radio" name="i_10" value="0" id="bb10_0"></td>
		<td width="80" style=""><label for="bb10_0" style="color:#0066CC">Отличное</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_10" value="1" id="bb10_1"></td>
		<td width="80" style=""><label for="bb10_1" style="color:#009900">Хорошее</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_10" value="2" id="bb10_2"></td>
		<td width="80" style=""><label for="bb10_2" style="color:#FF9900">Среднее</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_10" value="3" id="bb10_3"></td>
		<td width="80" style=""><label for="bb10_3" style="color:#FF0000">Плохое</label></td>
	</tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">Переднее правое крыло</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="i_11" value="0" id="bb11_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb11_0" style="color:#0066CC">Отличное</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_11" value="1" id="bb11_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb11_1" style="color:#009900">Хорошее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_11" value="2" id="bb11_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb11_2" style="color:#FF9900">Среднее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_11" value="3" id="bb11_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb11_3" style="color:#FF0000">Плохое</label></td>
	</tr><tr style="">
		<td style="padding: 0 0 0 10px; ">Заднее правое крыло</td>
		<td width="20" style=""><input  checked  style="border: 0; " type="radio" name="i_12" value="0" id="bb12_0"></td>
		<td width="80" style=""><label for="bb12_0" style="color:#0066CC">Отличное</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_12" value="1" id="bb12_1"></td>
		<td width="80" style=""><label for="bb12_1" style="color:#009900">Хорошее</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_12" value="2" id="bb12_2"></td>
		<td width="80" style=""><label for="bb12_2" style="color:#FF9900">Среднее</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="i_12" value="3" id="bb12_3"></td>
		<td width="80" style=""><label for="bb12_3" style="color:#FF0000">Плохое</label></td>
	</tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">Багажник</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="i_13" value="0" id="bb13_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb13_0" style="color:#0066CC">Отличное</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_13" value="1" id="bb13_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb13_1" style="color:#009900">Хорошее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_13" value="2" id="bb13_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb13_2" style="color:#FF9900">Среднее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="i_13" value="3" id="bb13_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb13_3" style="color:#FF0000">Плохое</label></td>
	</tr><tr><td colspan="9" height="25"><b>Внутри</b></td></tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">Коврик</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="v_1" value="0" id="bb14_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb14_0" style="color:#0066CC">Отличное</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="v_1" value="1" id="bb14_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb14_1" style="color:#009900">Хорошее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="v_1" value="2" id="bb14_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb14_2" style="color:#FF9900">Среднее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="v_1" value="3" id="bb14_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb14_3" style="color:#FF0000">Плохое</label></td>
	</tr><tr style="">
		<td style="padding: 0 0 0 10px; ">Панель приборов</td>
		<td width="20" style=""><input  checked  style="border: 0; " type="radio" name="v_2" value="0" id="bb15_0"></td>
		<td width="80" style=""><label for="bb15_0" style="color:#0066CC">Отличное</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="v_2" value="1" id="bb15_1"></td>
		<td width="80" style=""><label for="bb15_1" style="color:#009900">Хорошее</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="v_2" value="2" id="bb15_2"></td>
		<td width="80" style=""><label for="bb15_2" style="color:#FF9900">Среднее</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="v_2" value="3" id="bb15_3"></td>
		<td width="80" style=""><label for="bb15_3" style="color:#FF0000">Плохое</label></td>
	</tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">Электроника</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="v_3" value="0" id="bb16_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb16_0" style="color:#0066CC">Отличное</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="v_3" value="1" id="bb16_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb16_1" style="color:#009900">Хорошее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="v_3" value="2" id="bb16_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb16_2" style="color:#FF9900">Среднее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="v_3" value="3" id="bb16_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb16_3" style="color:#FF0000">Плохое</label></td>
	</tr><tr style="">
		<td style="padding: 0 0 0 10px; ">Передние сидения</td>
		<td width="20" style=""><input  checked  style="border: 0; " type="radio" name="v_4" value="0" id="bb17_0"></td>
		<td width="80" style=""><label for="bb17_0" style="color:#0066CC">Отличное</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="v_4" value="1" id="bb17_1"></td>
		<td width="80" style=""><label for="bb17_1" style="color:#009900">Хорошее</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="v_4" value="2" id="bb17_2"></td>
		<td width="80" style=""><label for="bb17_2" style="color:#FF9900">Среднее</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="v_4" value="3" id="bb17_3"></td>
		<td width="80" style=""><label for="bb17_3" style="color:#FF0000">Плохое</label></td>
	</tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">Подголовники</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="v_5" value="0" id="bb18_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb18_0" style="color:#0066CC">Отличное</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="v_5" value="1" id="bb18_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb18_1" style="color:#009900">Хорошее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="v_5" value="2" id="bb18_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb18_2" style="color:#FF9900">Среднее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="v_5" value="3" id="bb18_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb18_3" style="color:#FF0000">Плохое</label></td>
	</tr><tr style="">
		<td style="padding: 0 0 0 10px; ">Задние сидения</td>
		<td width="20" style=""><input  checked  style="border: 0; " type="radio" name="v_6" value="0" id="bb19_0"></td>
		<td width="80" style=""><label for="bb19_0" style="color:#0066CC">Отличное</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="v_6" value="1" id="bb19_1"></td>
		<td width="80" style=""><label for="bb19_1" style="color:#009900">Хорошее</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="v_6" value="2" id="bb19_2"></td>
		<td width="80" style=""><label for="bb19_2" style="color:#FF9900">Среднее</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="v_6" value="3" id="bb19_3"></td>
		<td width="80" style=""><label for="bb19_3" style="color:#FF0000">Плохое</label></td>
	</tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">Кондиционер</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="v_7" value="0" id="bb20_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb20_0" style="color:#0066CC">Отличное</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="v_7" value="1" id="bb20_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb20_1" style="color:#009900">Хорошее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="v_7" value="2" id="bb20_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb20_2" style="color:#FF9900">Среднее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="v_7" value="3" id="bb20_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb20_3" style="color:#FF0000">Плохое</label></td>
	</tr><tr><td colspan="9" height="25"><b>Механика</b></td></tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">Двигатель</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="m_1" value="0" id="bb21_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb21_0" style="color:#0066CC">Отличное</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="m_1" value="1" id="bb21_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb21_1" style="color:#009900">Хорошее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="m_1" value="2" id="bb21_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb21_2" style="color:#FF9900">Среднее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="m_1" value="3" id="bb21_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb21_3" style="color:#FF0000">Плохое</label></td>
	</tr><tr style="">
		<td style="padding: 0 0 0 10px; ">Выхлопная труба</td>
		<td width="20" style=""><input  checked  style="border: 0; " type="radio" name="m_2" value="0" id="bb22_0"></td>
		<td width="80" style=""><label for="bb22_0" style="color:#0066CC">Отличное</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="m_2" value="1" id="bb22_1"></td>
		<td width="80" style=""><label for="bb22_1" style="color:#009900">Хорошее</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="m_2" value="2" id="bb22_2"></td>
		<td width="80" style=""><label for="bb22_2" style="color:#FF9900">Среднее</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="m_2" value="3" id="bb22_3"></td>
		<td width="80" style=""><label for="bb22_3" style="color:#FF0000">Плохое</label></td>
	</tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">Рулевое управление</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="m_3" value="0" id="bb23_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb23_0" style="color:#0066CC">Отличное</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="m_3" value="1" id="bb23_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb23_1" style="color:#009900">Хорошее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="m_3" value="2" id="bb23_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb23_2" style="color:#FF9900">Среднее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="m_3" value="3" id="bb23_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb23_3" style="color:#FF0000">Плохое</label></td>
	</tr><tr style="">
		<td style="padding: 0 0 0 10px; ">Подвеска</td>
		<td width="20" style=""><input  checked  style="border: 0; " type="radio" name="m_4" value="0" id="bb24_0"></td>
		<td width="80" style=""><label for="bb24_0" style="color:#0066CC">Отличное</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="m_4" value="1" id="bb24_1"></td>
		<td width="80" style=""><label for="bb24_1" style="color:#009900">Хорошее</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="m_4" value="2" id="bb24_2"></td>
		<td width="80" style=""><label for="bb24_2" style="color:#FF9900">Среднее</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="m_4" value="3" id="bb24_3"></td>
		<td width="80" style=""><label for="bb24_3" style="color:#FF0000">Плохое</label></td>
	</tr><tr style="background-color: #eeeeff">
		<td style="padding: 0 0 0 10px; background-color: #eeeeff">Шины</td>
		<td width="20" style="background-color: #eeeeff"><input  checked  style="border: 0; background-color: #eeeeff" type="radio" name="m_5" value="0" id="bb25_0"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb25_0" style="color:#0066CC">Отличное</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="m_5" value="1" id="bb25_1"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb25_1" style="color:#009900">Хорошее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="m_5" value="2" id="bb25_2"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb25_2" style="color:#FF9900">Среднее</label></td>
		<td width="20" style="background-color: #eeeeff"><input  style="border: 0; background-color: #eeeeff" type="radio" name="m_5" value="3" id="bb25_3"></td>
		<td width="80" style="background-color: #eeeeff"><label for="bb25_3" style="color:#FF0000">Плохое</label></td>
	</tr><tr style="">
		<td style="padding: 0 0 0 10px; ">Трансмиссия</td>
		<td width="20" style=""><input  checked  style="border: 0; " type="radio" name="m_6" value="0" id="bb26_0"></td>
		<td width="80" style=""><label for="bb26_0" style="color:#0066CC">Отличное</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="m_6" value="1" id="bb26_1"></td>
		<td width="80" style=""><label for="bb26_1" style="color:#009900">Хорошее</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="m_6" value="2" id="bb26_2"></td>
		<td width="80" style=""><label for="bb26_2" style="color:#FF9900">Среднее</label></td>
		<td width="20" style=""><input  style="border: 0; " type="radio" name="m_6" value="3" id="bb26_3"></td>
		<td width="80" style=""><label for="bb26_3" style="color:#FF0000">Плохое</label></td>
	</tr><tr><td colspan="9" height="25"></td></tr><tr><td colspan="9" height="22"><b>Дополнительная информация:</b></td></tr><tr><td colspan="9"><input type="hidden" name="izz" value="7"><textarea rows="5" name="info" style="width: 600px">xvcxv</textarea></td></tr><tr><td colspan="9" height="35" align="center"><input type="button" value="Пометить проданным" onclick="location.href='step/change_it.php?point=1&sec=1&cid=194&uid=2&back=edit'"> <input type="button" value="Пометить непроданным" onclick="location.href='step/change_it.php?point=1&sec=0&cid=194&uid=2&back=edit'"> <input type="submit" value="Обновить!"></td></tr></table></form></div><div class="t_l"></div><div class="t_r"></div><div class="b_l"></div><div class="b_r"></div></div></div>

<div style="clear: both"></div>

<div id="footer"><div id="fl">©2010-2012 «Automixs»</div><div style="float: right; width: 785px; text-align: center; margin: 13px 0 0 0;"><a href="auctions.html">Аукционы</a><a href="faq.html">Вопрос-ответ</a><a href="reklama.html">Реклама</a><a href="partnrship.html">Сотрудничество</a><a href="about-us.html">О компании</a><a href="contacts.html">Контакты</a></div>
</div>
