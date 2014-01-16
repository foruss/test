<h1>Вопрос-ответ</h1><?php 
$get_duks=mysql_query("Select * from `duk` where `lang`='ru' and `on`='1' order by `data` desc");
while($zo=mysql_fetch_array($get_duks)) {
$name = stripslashes($zo['name']);
$data = ru_date($zo['data']);
$kl = stripslashes($zo['kl']);
$ats = stripslashes($zo['ats']);
echo('<div style="width: 750px; height: auto; background: #f5f5f5; color: #336699; line-height: 140%; border-left: 3px solid #cc0000; margin: 0 0 5px 0; padding: 5px">'.$name.'<br><font style="font-size: 8pt">'.$data.'</font><br>'.$kl.'<div style="border-top: 1px solid #999999; padding: 5px 0 10px 0; margin: 10px 0 0 0; line-height: 140%; color: #666666">Администрация<br>'.$ats.'</div></div>');
}

?>