<h1>В наличии</h1>

<?php 
$sand=mysql_query("Select * from `sand_cat` where `on`='1' order by `id` asc");
echo('<div align="center"><div style="width: 721px">');
while($zo=mysql_fetch_array($sand)) {
$img = $zo['img'];
$title = $zo['ru'];
$ztitle = str_replace("<br>","", $title);
$link = $zo['url'];
echo('<div style="float: left; width: 80px; margin: 20px; text-align: center"><a title="'.$ztitle.'" style="color: #666666; font-weight: bold" href="list/'.$link.'.html">'.$title.'</a><br><a title="'.$ztitle.'" href="list/'.$link.'.html"><img alt="'.$ztitle.'" style="border: 0; margin: 4px 0 0 0" src="'.$img.'"></a></div>');
}
echo('<div style="clear: both"></div></div></div>');

?>