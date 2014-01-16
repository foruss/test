<?php
$get_men=mysql_query("Select * from `text` where `menu`='2' order by `pos` asc");
$skgl=mysql_num_rows($get_men);
if ($skgl !='0') {
echo('<ul id="left-menu">');
while($zms=mysql_fetch_array($get_men)) {
$url = $zms['url'];
$title = $zms['title'];
echo('<li><a href="'.$url.'.html">'.$title.'</a></li>');
}
echo('</ul>');
}
?>