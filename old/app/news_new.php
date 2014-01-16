<?php 

$step = $_GET['step'];
$msg = $_GET['msg'];
if ($step == '') {
echo('<h1>Список новостей сайта</h1>');
echo('<div align="right"><a class="spec_n" href="app/news/new.html">+ Создать новую новость</a></div>');
if ($msg == 'ok') {
echo('<div align="center"><div style="margin: 10px 0; border: 1px dashed #999999; background: #FFFFFF; line-height: 150%; padding: 5px 10px; color: #990000; text-align: center; width: 250px">Информация добавлена!</div></div>');
} else if ($msg == 'deleted') {
echo('<div align="center"><div style="margin: 10px 0; border: 1px dashed #999999; background: #FFFFFF; line-height: 150%; padding: 5px 10px; color: #990000; text-align: center; width: 250px">Страница успешно удален!</div></div>');
} else if ($msg == 'updated') {
echo('<div align="center"><div style="margin: 10px 0; border: 1px dashed #999999; background: #FFFFFF; line-height: 150%; padding: 5px 10px; color: #990000; text-align: center; width: 250px">Изменения были сохранены!</div></div>');
}
echo('<div align="center" style="margin: 10px 0 0 0"><table border="1" width="550" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#E1E1E1">');
echo('<tr>
		<td height="23" bgcolor="#f5f5f5" align="center" width="400">Страница</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="150">Управление</td>
	</tr>');
$get_dif=mysql_query("Select * from `news` order by `data` desc");
while($zdi=mysql_fetch_array($get_dif)) {
$title = stripslashes($zdi['title']);
$id = $zdi['id'];
echo('<tr onmouseover="style.backgroundColor=\'#f8f8f8\'" onmouseout="style.backgroundColor=\'\';">
		<td height="22" align="left">&nbsp;'.$title.'</td>
		<td height="22" style="font-size: 8.5pt"><a href="?psl=app&do=news&step=edit&id='.$id.'">Редактировать</a> | <a onClick="if(confirm(\'Вы уверены, что хотите удалить эту новость?\r\nСтраница будет удален навсегда\')); else return false;" href="?psl=app&do=news&step=delete&id='.$id.'">Удалить</a></td>
	</tr>');
}
echo('</table></div>');
} else if ($step == 'new') {
if (!isset($_POST['submit'])) {

echo('<h1>Добавление новостей</h1><form name="tform" method="post" action="" enctype="multipart/form-data"><div align="center"><table border="0" width="700" id="table1" style="border-collapse: collapse" cellpadding="0">
	<tr>
		<td width="150" style="text-indent: 5px" bgcolor="#F9F9F9" height="25">Заголовок:</td>
		<td width="550" bgcolor="#F9F9F9" height="25"><input type="text" value="" style="width:95%" name="title"></td>
	</tr>
	<tr>
		<td width="150" style="text-indent: 5px" height="25">Описание:</td>
		<td width="550" height="35"><textarea class="mceNoEditor" rows="2" onkeyup="if(this.value.length < 300){ this.pref=this.value } else { this.value=this.pref; }" name="description" style="height: 30px; width: 95%" cols="20"></textarea></td>
	</tr>	<tr>
		<td width="150" style="text-indent: 5px" bgcolor="#F9F9F9" height="25">Ключевые слова:</td>
		<td width="550" bgcolor="#F9F9F9" height="40"><textarea class="mceNoEditor" rows="2" onkeyup="if(this.value.length < 500){ this.pref=this.value } else { this.value=this.pref; }" name="keywords" style="height: 35px; width: 95%" cols="20"></textarea></td>
	</tr><tr>
		<td width="150" style="text-indent: 5px" height="25">Язык:</td>
		<td width="550" height="25"><select size="1" name="lang" style="width: 95%"><option selected value="ru">RU</option></select></td>
	</tr><tr>
		<td width="150" style="text-indent: 5px" bgcolor="#F9F9F9" height="25">Дата:</td>
		<td width="550" bgcolor="#F9F9F9" height="25"><input type="text" value="" style="width:150px" name="data"><input type="text" value="Формат даты 2010-12-26" style="width:350px; border: 1px solid #f9f9f9; background: #f9f9f9; color: #999999" ></td>
	</tr>
	<tr>
		<td colspan="2" width="700">');
		?>
<!--<script type="text/javascript" src="fckeditor/fckeditor.js"></script> -->
<script type="text/javascript">
var CKEDITOR_BASEPATH = '/ckeditor/';
</script>
<script src="all_my_scripts.js" type="text/javascript"></script>


<textarea name="FCKeditor1" id=""  style="background: #FFFFFF; width: 95%; height:450; padding: 5px"></textarea>
<script type="text/javascript">
<!--
// Automatically calculates the editor base path based on the _samples directory.
// This is usefull only for these samples. A real application should use something like this:
// oFCKeditor.BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.

 //-->

 window.onload = function()
{
 
//var oFCKeditor = new FCKeditor( 'FCKeditor1' ) ;
//oFCKeditor.BasePath	= 'fckeditor/' ;
//oFCKeditor.Height	= 500 ;
//oFCKeditor.ReplaceTextarea() ;
//}
CKEDITOR.replace( 'FCKeditor1' );
}

		</script>

</td>
	</tr>
	<tr>
		<td colspan="2" width="700" height="35"><input type="submit" class="button" name="submit" onclick="if(tfrom.url.value=='') my_url(); else tform.submit();" value="Добавить"></td>
	</tr>
</table></form></div> <?php 

} else {
	$text = addslashes($_POST['FCKeditor1']);
    $title = addslashes($_POST['title']);
    $keywords = addslashes($_POST['keywords']);
    $description = addslashes($_POST['description']);
    $lang = $_POST['lang'];
   include('funkcijos_ru.php');
   $url = make_url($title);
   $data = $_POST['data'];
   $insertz=mysql_query("Insert into `news` set `url`='$url', `title`='$title', `data`='$data', `text`='$text', `keywords`='$keywords', `description`='$description', `lang`='$lang'") or die(mysql_error());
   echo('<script type="text/javascript">window.location = "/app/news/ok.msg"</script>'); 

}
} else if ($step == 'edit') {
if (!isset($_POST['submit'])) {
$id = $_GET['id'];
$get_itt=mysql_query("Select * from `news` where `id`='$id'");
$otz=mysql_fetch_array($get_itt);
$title = $otz['title'];
$description = stripslashes($otz['description']);
$keywords = stripslashes($otz['keywords']);
$data = stripslashes($otz['data']);
$text = stripslashes($otz['text']);
$url = $otz['url'];
echo('<h1>Редактирования новость</h1><form name="tform" method="post" action="?psl=app&do=news&step=edit&id='.$id.'" enctype="multipart/form-data"><div align="center"><table border="0" width="700" id="table1" style="border-collapse: collapse" cellpadding="0">
	<tr>
		<td width="150" style="text-indent: 5px" bgcolor="#F9F9F9" height="25">Заголовок:</td>
		<td width="550" bgcolor="#F9F9F9" height="25"><input type="text" value="'.$title.'" style="width:95%" name="title"></td>
	</tr>
	<tr>
		<td width="150" style="text-indent: 5px" height="25">Описание:</td>
		<td width="550" height="35"><textarea class="mceNoEditor" rows="2" onkeyup="if(this.value.length < 300){ this.pref=this.value } else { this.value=this.pref; }" name="description" style="height: 30px; width: 95%" cols="20">'.$description.'</textarea></td>
	</tr>	<tr>
		<td width="150" style="text-indent: 5px" bgcolor="#F9F9F9" height="25">Ключевые слова:</td>
		<td width="550" bgcolor="#F9F9F9" height="40"><textarea class="mceNoEditor" rows="2" onkeyup="if(this.value.length < 500){ this.pref=this.value } else { this.value=this.pref; }" name="keywords" style="height: 35px; width: 95%" cols="20">'.$keywords.'</textarea></td>
	</tr><tr>
		<td width="150" style="text-indent: 5px" height="25">Язык:</td>
		<td width="550" height="25"><select size="1" name="lang" style="width: 95%"><option selected value="ru">RU</option></select></td>
	</tr><tr>
		<td width="150" style="text-indent: 5px" bgcolor="#F9F9F9" height="25">Дата:</td>
		<td width="550" bgcolor="#F9F9F9" height="25"><input type="text" value="'.$data.'" style="width:150px" name="data"><input type="text" value="Формат даты 2010-12-26" style="width:350px; border: 1px solid #f9f9f9; background: #f9f9f9; color: #999999" ></td>
	</tr><tr>
		<td width="150" style="text-indent: 5px" height="25">URL:</td>
		<td width="550" height="25"><input type="text" value="'.$url.'" style="width:95%" name="url"></td>
	</tr>
	<tr>
		<td colspan="2" width="700">');
		?>
<script type="text/javascript" src="/fckeditor/fckeditor.js"></script>
<script type="text/javascript">
<!--
// Automatically calculates the editor base path based on the _samples directory.
// This is usefull only for these samples. A real application should use something like this:
// oFCKeditor.BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.

 //window.onload = function()
//{
 
//var oFCKeditor = new FCKeditor( 'FCKeditor1' ) ;
//oFCKeditor.BasePath	= '/fckeditor/' ;
//oFCKeditor.Height	= 500 ;
//oFCKeditor.ReplaceTextarea() ;
//}
//-->
		</script>
		
		<script type="text/javascript">
var CKEDITOR_BASEPATH = '/ckeditor/';
</script>
<script src="all_my_scripts.js" type="text/javascript"></script>


<textarea name="FCKeditor1"  style="background: #FFFFFF; width: 95%; height:450; padding: 5px"><?php  echo $text; ?></textarea></td>
	</tr>
	<tr>
		<td colspan="2" width="700" height="35"><input type="submit" class="button" name="submit" onclick="if(tfrom.url.value=='') my_url(); else tform.submit();" value="Сохранить изменения"></td>
	</tr>
</table></form></div>

<script type="text/javascript">
<!--
// Automatically calculates the editor base path based on the _samples directory.
// This is usefull only for these samples. A real application should use something like this:
// oFCKeditor.BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.

 //-->

 window.onload = function()
{
 
//var oFCKeditor = new FCKeditor( 'FCKeditor1' ) ;
//oFCKeditor.BasePath	= 'fckeditor/' ;
//oFCKeditor.Height	= 500 ;
//oFCKeditor.ReplaceTextarea() ;
//}
CKEDITOR.replace('FCKeditor1');
}

		</script>

 <?php 

} else {
	$text = addslashes($_POST['FCKeditor1']);
    $title = addslashes($_POST['title']);
    $keywords = addslashes($_POST['keywords']);
    $description = addslashes($_POST['description']);
    $lang = $_POST['lang'];
    $url = $_POST['url'];
   //include('funkcijos_ru.php');
  // $url = make_url($title);
   $data = $_POST['data'];
   $id = $_GET['id'];
   $insertz=mysql_query("Update `news` set `url`='$url', `title`='$title', `data`='$data', `text`='$text', `keywords`='$keywords', `description`='$description', `lang`='$lang' where `id`='$id'") or die(mysql_error());
   echo('<script type="text/javascript">window.location = "/app/news/updated.msg"</script>'); 

}
} else if ($step == 'delete') {
$id = $_GET['id'];
$delaz=mysql_query("Delete from `news` where `id`='$id'");
echo('<script type="text/javascript">window.location = "/app/news/deleted.msg"</script>'); 
}

?>