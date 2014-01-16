<?php 

$get_adv=mysql_query("Select * from `adv` where `pos`='3' and `on`='1' order by rand()");
$sk1 = mysql_num_rows($get_adv);
if ($sk1 == '0') {

} else {
$adv1=mysql_fetch_array($get_adv);

$type = $adv1['type'];

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

}


}
?>