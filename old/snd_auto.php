<?php 

$c = $_POST['sk'];
$scode = addslashes($_POST['scode']);

if ($scode == '1311an') {
include('web.php'); mysqlconnect();
$it = mysql_query('SET NAMES utf8'); 
$et = mysql_query('SET CHARACTER SET urf8');
$allUsers = $_POST['allUsers'];
header('Content-Type:text/html; charset=UTF-8');
include('fnc.php');
$text1 = '<table width="98%"  cellspacing="1" cellpadding="1" border="0"><tr bgcolor="#dddddd"><td width="50" align="center">Фото</td><td height="42" align="center">Год</td><td align="center">Марка, Модель</td><td width="79" align="center">Цена</td><td width="60" align="center">Пробег</td><td width="90" align="center">Цвет</td><td width="60" align="center">Объем</td></tr>';

while(list($name, $value) = each($c)) {
$imk_auto=mysql_query("Select * from `auto` where `id`='$value'");
$auto=mysql_fetch_array($imk_auto);

$metai = $auto['metai'];
$get_foto=mysql_query("Select * from `foto` where `sid`='$value' and `type`='1' order by `id` asc");
$otl=mysql_fetch_array($get_foto);
$furl = $otl['url'];

$marke = get_marke($auto['marke']);
$modelis= get_modelis($auto['modelis']);
$turis = $auto['turis'];
$rida = $auto['rida'];
$spalva = get_color($auto['spalva']);
$kaina = $auto['kaina'];
$rtype = $auto['rtype'];
if ($rtype == '0') {
$rtype =' км';
} else {
$rtype =' мили';
}
$kt = $auto['ktype'];
if ($kt == '1') {
$kt ='€ ';
} else {
$kt ='$ ';
}

$text1.='<tr bgcolor="#ececec"><td width="50"><a target="_blank" href="http://www.automixs.com/auto/show/'.$value.'/"><img src="http://www.automixs.com/phpThumb.php?src='.$furl.'&w=122&h=81" style="border: 1px solid rgb(153, 153, 153); padding: 1px;"> </a></td><td width="42" align="center"> '.$metai.'</td><td>&nbsp;&nbsp;<a target="_blank" href="http://www.automixs.com/auto/show/'.$value.'/">'.$marke.' '.$modelis.'</a></td><td width="79" align="center"> '.$kt.$kaina.'</td><td width="60"><span> '.$rida.' '.$rtype.'</span> </td><td width="90"> '.$spalva.'</td><td width="60"> '.$turis.' cm<sup>3</sup></td></tr>';



}
$to = $_POST['to'];

$text1.='</table>';
$text1.='<a target=_blank href="http://www.automixs.com">www.AutoMixs.com</a><br>
email: info@automixs.com<br>
skype: automixs';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= "From: <noreply@automixs.com>";

if(strpos($to, ",")==false)
$masText = explode("<br />", nl2br($to));
else
$masText = explode(",", nl2br($to));

if($allUsers==1) {

$get_emas=mysql_query("Select * from `users` where `email` like '%@%.%'");
$i = 1;
$masText2 = array();
while($gem=mysql_fetch_array($get_emas)) {
$email = $gem['email'];
$masText2[] = $email;
$i++;
}

//$masText2=getAllMailUsers();
for($i=0; $i<=(count($masText2)-1); $i++)
$masText[(count($masText2)+$i)]=$masText2[$i]; }
if(count($masText)>0){
foreach($masText as $val)
   {
$to = $val; //&#1050;&#1091;&#1076;&#1072; &#1086;&#1090;&#1087;&#1088;&#1072;&#1074;&#1083;&#1103;&#1090;&#1100;
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= "From: <noreply@automixs.com>";
mail($to, $subject, $text1.$text, $headers);
 
   }
   

}


mysqldisconnect();
header("Location: index.php?psl=app&do=send-auto&msg=sent");

}

?>
