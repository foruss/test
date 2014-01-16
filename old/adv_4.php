<?php 

$get_adv=mysql_query("Select * from `adv` where `pos`='4' and `on`='1' and `lang`='ru' order by rand() LIMIT 0,4");
$sk1 = mysql_num_rows($get_adv);
if ($sk1 == '0') {

} else {
while($adv1=mysql_fetch_array($get_adv)) {

$type = $adv1['type'];
echo('<div style="margin: 0 0 5px 0">');
$aid = $adv1['id'];
$showed = $adv1['showed'] + 1;
if ($type == '2') {
$ban = $adv1['ban'];
$width = $adv1['width'];
$height = $adv1['height'];
echo('<object onclick="clicked(\''.$aid.'\')" width="'.$width.'" height="'.$height.'" type="application/x-shockwave-flash" data="'.$ban.'"><param value="'.$ban.'" name="movie"></object>');
} else if ($type == '1') {
$width = $adv1['width'];
$height = $adv1['height'];
$url = $adv1['url'];
$ban = $adv1['ban'];
$title = stripslashes($adv1['title']);
echo('<a onclick="clicked(\''.$aid.'\')" rel="nofollow" target=_blank href="'.$url.'"><img src="'.$ban.'" width="'.$width.'" height="'.$height.'" alt="'.$title.'" border="0"></a>');
} else if ($type == '3') {
$source = stripslashes($adv1['source']);
echo $source;
} if ($type == '4') {
$url = stripslashes($adv1['url']);
$title = stripslashes($adv1['title']);
echo('<a onclick="clicked(\''.$aid.'\')" rel="nofollow" target=_blank href="'.$url.'">'.$title.'</a>');
}

$ltype = $adv1['ltype'];
$updaiz=mysql_query("Update `adv` set `showed`='$showed' where `id`='$aid'");
if ($ltype == '2') {
$maxclick = $adv1['maxclick'];
$clicked = $adv1['clicked'];
if ($maxclick == $clicked) {
$updaiz=mysql_query("Update `adv` set `on`='0' where `id`='$aid'");
} else {

}
} else if ($ltype == '3') {
$maxshow = $adv1['maxshow'];
if ($maxshow == $showed) {
$updaiz=mysql_query("Update `adv` set `on`='0' where `id`='$aid'");
} else {

}
} else {
echo ('</div>');
}
}

}
?>
<div style="margin: 0 0 5px 0">
<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fautomixs&amp;width=181&amp;height=258&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;border_color&amp;header=false&amp;appId=128034380628756" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:181px; height:369px;" allowTransparency="true"></iframe>
</div>
<div style="margin: 0 0 5px 0"><script src="http://odnaknopka.ru/ok3.js" type="text/javascript"></script>
<link href="http://stg.odnoklassniki.ru/share/odkl_share.css" rel="stylesheet">
<script src="http://stg.odnoklassniki.ru/share/odkl_share.js" type="text/javascript" ></script><a class="odkl-klass-s" href="http://automixs.com/" onclick="ODKL.Share(this);return false;" ></a>
 <!-- odnoklassniki --></div>