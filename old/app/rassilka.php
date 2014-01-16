<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";

include_once("../fckeditor/fckeditor.php") ;

$partners=getPartners();
$smarty->assign("partners", $partners);


$mode = processGetVariable('mode');
if($mode=='show'){
ob_start();
  $oFCKeditor = new FCKeditor('text') ;
  $oFCKeditor->BasePath = '/fckeditor/' ;
  $oFCKeditor->Value = '';
  $oFCKeditor->Height = '300px';
  $oFCKeditor->Create();
  $page_contents=ob_get_contents();
ob_end_clean();
$smarty->assign("page_contents", $page_contents);
$smarty->assign("title", 'Рассылка');
$smarty->display("rassilka.tpl");
}
if($mode=='send'){
$smarty->assign("page_contents", $page_contents);
$allUsers = processPostVariable('allUsers');
$subject = processPostVariable('subject');
$to = processPostVariable('to');
$text = processPostVariable('text');

$text=str_replace('src="/userfiles/', 'src="automixs.com/userfiles/' , $text);

if(strpos($to, ",")==false)
$masText = explode("<br />", nl2br($to));
else
$masText = explode(",", nl2br($to));
if($allUsers==1){
$masText2=getAllMailUsers();
for($i=0; $i<=(count($masText2)-1); $i++)
$masText[(count($masText2)+$i)]=$masText2[$i]['email'];}
if(count($masText)>0){
foreach($masText as $val)
   {
$to = $val; //Куда отправлять
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= "From: <noreply@automixs.com>";
mail($to, $subject, $text, $headers);
 
     
   }

}
$smarty->assign("mes", 'Сообщения отправлены');
$smarty->assign("title", 'Рассылка');
$smarty->display("rassilka.tpl");
}