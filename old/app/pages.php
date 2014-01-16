<?php
$step = $_GET['step'];
$msg = $_GET['msg'];
if ($step == '') {
echo('<h1>List of Pages</h1>');
echo('<div align="right"><a class="spec_n" href="app/pages/new.html">+ Create New Page</a></div>');
if ($msg == 'ok') {
echo('<div align="center"><div style="margin: 10px 0; border: 1px dashed #999999; background: #FFFFFF; line-height: 150%; padding: 5px 10px; color: #990000; text-align: center; width: 250px">Successfully Added!</div></div>');
} else if ($msg == 'deleted') {
echo('<div align="center"><div style="margin: 10px 0; border: 1px dashed #999999; background: #FFFFFF; line-height: 150%; padding: 5px 10px; color: #990000; text-align: center; width: 250px">Page Deleted Successfully!</div></div>');
} else if ($msg == 'updated') {
echo('<div align="center"><div style="margin: 10px 0; border: 1px dashed #999999; background: #FFFFFF; line-height: 150%; padding: 5px 10px; color: #990000; text-align: center; width: 250px">Changes Were Successfully Saved!</div></div>');
}
echo('<h2>Top Menu</h2>');
echo('<div align="center"><table border="1" width="450" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#E1E1E1">');

$get_dif=mysql_query("Select distinct `lang` from `text` where `menu`='1' order by `lang` asc");
while($zdi=mysql_fetch_array($get_dif)) {
$lang = $zdi['lang'];
echo('<tr>
		<td height="25" bgcolor="#f0f0f0" colspan="3" style="padding: 0 0 0 10px; text-align: left"><b>Язык: '.$lang.'</b></td>
	</tr>
	<tr>
		<td height="23" bgcolor="#f5f5f5" align="center" width="200">Page</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="100">Position</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="150">Manage</td>
	</tr>');
$get_max = mysql_query("Select max(pos) from `text` where `menu`='1' and `lang`='$lang'");
$ot=mysql_fetch_array($get_max);
$max = $ot['max(pos)'];

$get_izz=mysql_query("Select * from `text` where `menu`='1' and `lang`='$lang' order by `pos` asc");
while($rr=mysql_fetch_array($get_izz)) {
$title = stripslashes($rr['title']);
$pos = $rr['pos'];
$id = $rr['id'];
$plius = $pos + 1;
$keisti = '';
$minus = $pos - 1;
if ($pos == '1' && $pos == $max) {
$keisti ='';
} else if ($pos == $max && $pos > 1) {
$keisti = '<a href="?psl=app&do=pages&step=change&b='.$minus.'&ex='.$pos.'&id='.$id.'&menu=1&lang='.$lang.'"><img src="images/u.gif" border="0"></a>';
} else if ($pos == '1' && $pos < $max) {
$keisti = '<a href="?psl=app&do=pages&step=change&b='.$plius.'&ex='.$pos.'&id='.$id.'&menu=1&lang='.$lang.'"><img src="images/d.gif" border="0"></a>';
} else if ($pos != $max && $pos != 1) {
$keisti = '<a href="?psl=app&do=pages&step=change&b='.$plius.'&ex='.$pos.'&id='.$id.'&menu=1&lang='.$lang.'"><img src="images/d.gif" border="0"></a><a style="margin: 0 0 0 5px" href="?psl=app&do=pages&step=change&b='.$minus.'&ex='.$pos.'&id='.$id.'&menu=1&lang='.$lang.'"><img src="images/u.gif" border="0"></a>';
}
echo('<tr onmouseover="style.backgroundColor=\'#f8f8f8\'" onmouseout="style.backgroundColor=\'\';">
		<td height="22" align="left">&nbsp;'.$title.'</td>
		<td height="22" align="center">'.$keisti.'</td>
		<td height="22" style="font-size: 8.5pt"><a href="?psl=app&do=pages&step=edit&id='.$id.'">Edit</a> | <a onClick="if(confirm(\'Are you sure you want to delete this page?\r\n The page will be deleted permanently\')); else return false;" href="?psl=app&do=pages&step=delete&id='.$id.'">Delete</a></td>
	</tr>');
}

}


echo('</table></div>');
echo('<h2>Left Menu</h2>');

echo('<div align="center"><table border="1" width="450" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#E1E1E1">');

$get_dif=mysql_query("Select distinct `lang` from `text` where `menu`='2' order by `lang` asc");
while($zdi=mysql_fetch_array($get_dif)) {
$lang = $zdi['lang'];
echo('<tr>
		<td height="25" bgcolor="#f0f0f0" colspan="3" style="padding: 0 0 0 10px; text-align: left"><b>Язык: '.$lang.'</b></td>
	</tr>
	<tr>
		<td height="23" bgcolor="#f5f5f5" align="center" width="200">Page</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="100">Position</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="150">Manage</td>
	</tr>');
$get_max = mysql_query("Select max(pos) from `text` where `menu`='2' and `lang`='$lang'");
$ot=mysql_fetch_array($get_max);
$max = $ot['max(pos)'];

$get_izz=mysql_query("Select * from `text` where `menu`='2' and `lang`='$lang' order by `pos` asc");
while($rr=mysql_fetch_array($get_izz)) {
$title = stripslashes($rr['title']);
$pos = $rr['pos'];
$id = $rr['id'];
$plius = $pos + 1;
$keisti = '';
$minus = $pos - 1;
if ($pos == '1' && $pos == $max) {
$keisti ='';
} else if ($pos == $max && $pos > 1) {
$keisti = '<a href="?psl=app&do=pages&step=change&b='.$minus.'&ex='.$pos.'&id='.$id.'&menu=2&lang='.$lang.'"><img src="images/u.gif" border="0"></a>';
} else if ($pos == '1' && $pos < $max) {
$keisti = '<a href="?psl=app&do=pages&step=change&b='.$plius.'&ex='.$pos.'&id='.$id.'&menu=2&lang='.$lang.'"><img src="images/d.gif" border="0"></a>';
} else if ($pos != $max && $pos != 1) {
$keisti = '<a href="?psl=app&do=pages&step=change&b='.$plius.'&ex='.$pos.'&id='.$id.'&menu=2&lang='.$lang.'"><img src="images/d.gif" border="0"></a><a style="margin: 0 0 0 5px" href="?psl=app&do=pages&step=change&b='.$minus.'&ex='.$pos.'&id='.$id.'&menu=2&lang='.$lang.'"><img src="images/u.gif" border="0"></a>';
}
echo('<tr onmouseover="style.backgroundColor=\'#f8f8f8\'" onmouseout="style.backgroundColor=\'\';">
		<td height="22" align="left">&nbsp;'.$title.'</td>
		<td height="22" align="center">'.$keisti.'</td>
		<td height="22" style="font-size: 8.5pt"><a href="?psl=app&do=pages&step=edit&id='.$id.'">Manage</a> | <a onClick="if(confirm(\'Are you sure you want to delete this page?\r\n The page will be deleted permanently\')); else return false;" href="?psl=app&do=pages&step=delete&id='.$id.'">Delete</a></td>
	</tr>');
}

}
echo('</table></div>');

echo('<h2>Bottom Menu</h2>');

echo('<div align="center"><table border="1" width="450" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#E1E1E1">');

$get_dif=mysql_query("Select distinct `lang` from `text` where `menu`='0' order by `lang` asc");
while($zdi=mysql_fetch_array($get_dif)) {
$lang = $zdi['lang'];
echo('<tr>
		<td height="25" bgcolor="#f0f0f0" colspan="3" style="padding: 0 0 0 10px; text-align: left"><b>Язык: '.$lang.'</b></td>
	</tr>
	<tr>
		<td height="23" bgcolor="#f5f5f5" align="center" width="200">Page</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="100">Position</td>
		<td height="23" bgcolor="#f5f5f5" align="center" width="150">Manage</td>
	</tr>');

$get_izz=mysql_query("Select * from `text` where `menu`='0' and `lang`='$lang' order by `id` asc");
while($rr=mysql_fetch_array($get_izz)) {
$title = stripslashes($rr['title']);
$id = $rr['id'];

echo('<tr onmouseover="style.backgroundColor=\'#f8f8f8\'" onmouseout="style.backgroundColor=\'\';">
		<td height="22" align="left">&nbsp;'.$title.'</td>
		<td height="22" align="center"></td>
		<td height="22" style="font-size: 8.5pt"><a href="?psl=app&do=pages&step=edit&id='.$id.'">Edit</a> | <a onClick="if(confirm(\'Are you sure you want to delete this page?\r\n The page will be deleted Permanently!\')); else return false;" href="?psl=app&do=pages&step=delete&id='.$id.'">Delete</a></td>
	</tr>');
}

}
echo('</table></div>');

} else if ($step == 'new') {
if (!isset($_POST['submit'])) {
?>
<script lang="javascript">
	function my_url(){
	document.tform.url.focus();
	alert('Введите пожалуйста URL');
	}
	</script>
<?php
echo('<h1>Add Page</h1><form name="tform" method="post" action="" enctype="multipart/form-data"><div align="center"><table border="0" width="700" id="table1" style="border-collapse: collapse" cellpadding="0">
	<tr>
		<td width="150" style="text-indent: 5px" bgcolor="#F9F9F9" height="25">Name of the page:</td>
		<td width="550" bgcolor="#F9F9F9" height="25"><input type="text" maxlength="150" value="" style="width:95%" name="title"></td>
	</tr>
	<tr>
		<td width="150" style="text-indent: 5px" height="25">Description:</td>
		<td width="550" height="35"><textarea class="mceNoEditor" rows="2" onkeyup="if(this.value.length < 300){ this.pref=this.value } else { this.value=this.pref; }" name="description" style="height: 30px; width: 95%" cols="20"></textarea></td>
	</tr>	<tr>
		<td width="150" style="text-indent: 5px" bgcolor="#F9F9F9" height="25">Keywords:</td>
		<td width="550" bgcolor="#F9F9F9" height="40"><textarea class="mceNoEditor" rows="2" onkeyup="if(this.value.length < 500){ this.pref=this.value } else { this.value=this.pref; }" name="keywords" style="height: 35px; width: 95%" cols="20"></textarea></td>
	</tr><tr>
		<td width="150" style="text-indent: 5px" height="25">URL:</td>
		<td width="550" height="25"><input type="text" style="width:95%" name="url"></td>
	</tr><tr>
		<td width="150" bgcolor="#F9F9F9" style="text-indent: 5px" height="25">Language:</td>
		<td width="550" bgcolor="#F9F9F9" height="25"><select size="1" name="lang" style="width: 95%"><option selected value="ru">RU</option></select></td>
	</tr><tr>
		<td width="150" style="text-indent: 5px" height="25">Menu location:</td>
		<td width="550" height="25"><select size="1" name="menu" style="width: 95%"><option selected value="0">Top Menu</option><option value="1">Left Menu</option><option value="2">Bottom Menu</option></select></td>
	</tr>
	<tr>
		<td colspan="2" width="700">');
		?>
<!-- <script type="text/javascript" src="http://www.automixs.com/fckeditor/fckeditor.js"></script> -->

<script type="text/javascript">
window.onload = function()
{
CKEDITOR.replace( 'FCKeditor1' );
}
</script>

<textarea name="FCKeditor1" id="FCKeditor1"  style="background: #FFFFFF; width: 95%; height:450; padding: 5px"></textarea>

</td>
	</tr>
	<tr>
		<td colspan="2" width="700" height="35"><input type="submit" class="button" name="submit" onclick="if(tfrom.url.value=='') my_url(); else tform.submit();" value="Add Page"></td>
	</tr>
</table></form></div> <?php 

} else {
	$text = addslashes($_POST['FCKeditor1']);
    $title = addslashes($_POST['title']);
    $keywords = addslashes($_POST['keywords']);
    $description = addslashes($_POST['description']);
    $lang = $_POST['lang'];
    $url = $_POST['url'];
    $menu = $_POST['menu'];
    if ($menu !='0') {
    $get_pos=mysql_query("Select * from `text` where `menu`='$menu' and `lang`='$lang' order by `id` desc");
    $zzx=mysql_fetch_array($get_pos);
    $pos = $zzx['pos'] + 1;
    }
    $insertz=mysql_query("Insert into `text` set `url`='$url', `title`='$title', `text`='$text', `keywords`='$keywords', `description`='$description', `lang`='$lang', `menu`='$menu', `pos`='$pos'") or die(mysql_error());
   echo('<script type="text/javascript">window.location = "/app/pages/ok.msg"</script>'); 

}
} else if ($step == 'edit') {
if (!isset($_POST['submit'])) {
$id = $_GET['id'];
$get_it=mysql_query("Select * from `text` where `id`='$id'");
$ozz=mysql_fetch_array($get_it);
$title = $ozz['title'];
$description = stripslashes($ozz['description']);
$keywords = stripslashes($ozz['keywords']);
$url = stripslashes($ozz['url']);
$text = stripslashes($ozz['text']);
$menu = $ozz['menu'];
?>
<script lang="javascript">
	function my_url(){
	document.tform.url.focus();
	alert('Введите пожалуйста URL');
	}
	</script>
<?php
echo('<h1>Edit Page</h1><form name="tform" method="post" action="?psl=app&do=pages&step=edit&id='.$id.'" enctype="multipart/form-data"><div align="center"><table border="0" width="700" id="table1" style="border-collapse: collapse" cellpadding="0">
	<tr>
		<td width="150" style="text-indent: 5px" bgcolor="#F9F9F9" height="25">Name of the page:</td>
		<td width="550" bgcolor="#F9F9F9" height="25"><input type="text" maxlength="150" style="width:95%" value="'.$title.'" name="title"></td>
	</tr>
	<tr>
		<td width="150" style="text-indent: 5px" height="25">Description:</td>
		<td width="550" height="35"><textarea class="mceNoEditor" rows="2" onkeyup="if(this.value.length < 300){ this.pref=this.value } else { this.value=this.pref; }" name="description" style="height: 30px; width: 95%" cols="20">'.$description.'</textarea></td>
	</tr>	<tr>
		<td width="150" style="text-indent: 5px" bgcolor="#F9F9F9" height="25">Keywords:</td>
		<td width="550" bgcolor="#F9F9F9" height="40"><textarea class="mceNoEditor" rows="2" onkeyup="if(this.value.length < 500){ this.pref=this.value } else { this.value=this.pref; }" name="keywords" style="height: 35px; width: 95%" cols="20">'.$keywords.'</textarea></td>
	</tr><tr>
		<td width="150" style="text-indent: 5px" height="25">URL:</td>
		<td width="550" height="25"><input type="text" style="width:95%" value="'.$url.'" name="url"></td>
	</tr><tr>
		<td width="150" bgcolor="#F9F9F9" style="text-indent: 5px" height="25">Language:</td>
		<td width="550" bgcolor="#F9F9F9" height="25"><select size="1" name="lang" style="width: 95%"><option selected value="ru">RU</option></select></td>
	</tr><tr>
		<td width="150" style="text-indent: 5px" height="25">Menu location:</td>
		<td width="550" height="25"><select size="1" name="menu" style="width: 95%"><option '); if ($menu == '0') { echo " selected "; } else { } echo(' value="0">Top Menu</option><option '); if ($menu == '1') { echo " selected "; } else { } echo(' value="1">Left Menu</option><option '); if ($menu == '2') { echo " selected "; } else { } echo(' value="2">Bottom Menu</option></select></td>
	</tr>
	<tr>
		<td colspan="2" width="700">');
		?>
<!--<script type="text/javascript" src="http://www.automixs.com/fckeditor/fckeditor.js"></script> -->
<script type="text/javascript">
window.onload = function()
{
CKEDITOR.replace( 'FCKeditor1' );
}
</script>

<textarea name="FCKeditor1" id="FCKeditor1" style="background: #FFFFFF; width: 95%; height:450; padding: 5px"><?php  echo $text; ?></textarea></td>
	</tr>
	<tr>
		<td colspan="2" width="700" height="35"><input type="submit" class="button" name="submit" onclick="if(tfrom.url.value=='') my_url(); else tform.submit();" value="Save Changes"></td>
	</tr>
</table></form></div> <?php 

} else {
	$text = addslashes($_POST['FCKeditor1']);
    $title = addslashes($_POST['title']);
    $keywords = addslashes($_POST['keywords']);
    $description = addslashes($_POST['description']);
    $lang = $_POST['lang'];
    $url = $_POST['url'];
    $menu = $_POST['menu'];
    
    $id = $_GET['id'];
    
    $check_if=mysql_query("Select * from `text` where `id`='$id'");
    $zz_if=mysql_fetch_array($check_if);
    $old_menu = $zz_if['menu'];
    $old_lang = $zz_if['lang'];
    $old_pos = $zz_if['pos'];
    
    if ($old_menu != $menu || $lang != $old_lang) {
    $get_zz=mysql_query("Select max(pos) from `text` where `menu`='$menu' and `lang`='$lang'");
    $fzz=mysql_fetch_array($get_zz);
    $new_pos = $fzz['max(pos)'];
    
    //keiciam visus kurie sendins
    $updaz=mysql_query("Update `text` set `pos`=pos-1 where `pos` > '$old_pos' and `menu`='$old_menu' and `lang`='$old_lang'");
    } else {
    $new_pos = $old_pos;
    }
    $updd=mysql_query("Update `text` set `url`='$url', `title`='$title', `text`='$text', `keywords`='$keywords', `description`='$description', `lang`='$lang', `menu`='$menu', `pos`='$new_pos' where `id`='$id'") or die(mysql_error());
     
   echo('<script type="text/javascript">window.location = "/app/pages/updated.msg"</script>'); 

}
} else if ($step == 'delete') {
$id = $_GET['id'];
$get_pos=mysql_query("Select * from `text` where `id`='$id'");
$ott=mysql_fetch_array($get_pos);
$menu = $ott['menu'];
if ($menu !='0') {
$pos = $ott['pos'];
$lang = $ott['lang'];
$updaz=mysql_query("Update `text` set `pos`=pos-1 where `pos` > '$pos' and `menu`='$menu' and `lang`='$lang'");

}

$delas=mysql_query("Delete from `text` where `id`='$id'");
  echo('<script type="text/javascript">window.location = "/app/pages/deleted.msg"</script>'); 

} else if ($step == 'change') {
$id = $_GET['id'];
$b = $_GET['b'];
$ex = $_GET['ex'];
$menu = $_GET['menu'];
$lang = $_GET['lang'];
$updatas=mysql_query("Update `text` set `pos`='$ex' where `pos`='$b' and `lang`='$lang' and `menu`='$menu'") or die(mysql_error());
$updatas2=mysql_query("Update `text` set `pos`='$b' where `id`='$id' and `lang`='$lang' and `menu`='$menu'") or die(mysql_error());
echo('<script type="text/javascript">window.location = "/app/pages.html"</script>'); 
}


?>

