<?php 
if (empty($do)) {
echo('<h1>Новости</h1>');

echo('<div style="line-height: 150%">');


$get_news=mysql_query("Select * from `news` order by `data` desc");
while($nws=mysql_fetch_array($get_news)) {
$data = ru_date($nws['data']);
$title = $nws['title'];
$url = $nws['url'];
echo(''.$data.' <a title="Читать новость - '.$title.'" style="margin: 0 0 0 10px" href="news/'.$url.'.html">'.$title.'</a><br>');
}
echo('</div>');

} else {
$text = stripslashes($nit['text']);
echo('<h1>'.$ntitle.'</h1><div style="line-height: 150%">'.$text.'<br><br><a href="news.html">« Назад</a></div>');
}


?>