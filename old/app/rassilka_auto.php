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
$page=$_REQUEST['page'];
if (!isset($page)){
	$page = 1;
}
$autos=AllAuto($page);
$col= (int)(count($autos[1])/15);
if(((int)(count($autos[1])/15))!=(count($autos[1])/15))
$col++;
$smarty->assign("pcol", $col);
$smarty->assign("col", count($autos[1]));
$smarty->assign("page", $page);
$smarty->assign("autos", $autos[1]);
$smarty->assign("page_contents", $page_contents);
$smarty->assign("title", 'Mailing List for Autos');
$smarty->display("rassilka_auto.tpl");
}
if($mode=='send'){
$smarty->assign("page_contents", $page_contents);
$allUsers = processPostVariable('allUsers');
$subject = processPostVariable('subject');
$to = processPostVariable('to');
$text = processPostVariable('text');
$text1 = '<table width="98%"  cellspacing="1" cellpadding="1" border="0"><tr bgcolor="#dddddd"><td width="50">Фото </td><td height="42">Year </td><td width="95">Маke </td><td>Моdel </td><td width="79">Price </td><td width="60">Miles </td><td width="90">Цвет </td><td width="60">Engine</td></tr>';
$col_cars = processPostVariable('col_cars');
$col_cars = (int)$col_cars;
for($i=1; $i<=$col_cars; $i++){
	unset($per);
	$per = processPostVariable('idcar_'.$i);
	if(isset($per) && $per!=''){
		unset($auto);
		$auto = getAuto($per);
		$text1.='<tr bgcolor="#ececec"><td width="50"><a target="_blank" href="http://www.automixs.com/auto/show/'.$per.'/"><img src="http://www.automixs.com/carimages/'.$per.'_1m.jpg" style="border: 1px solid rgb(153, 153, 153); padding: 1px;"> </a></td><td width="42"> '.$auto['year'].'</td><td width="95"> <a target="_blank" href="http://www.automixs.com/auto/show/'.$per.'/">'.$auto['brand_name'].'</a></td><td><span> <a target="_blank" href="http://www.automixs.com/auto/show/'.$per.'/">'.$auto['car_name'].'<span> </span></a></span></td><td width="79"> $'.$auto['price'].'</td><td width="60"><span> '.$auto['way'].'</span> </td><td width="90"> '.$auto['color'].'</td><td width="60"> '.$auto['obem'].'</td></tr>';
	}
	
}

$text1 .= '</table>';

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
mail($to, $subject, $text1.$text, $headers);
 
     
   }

}
$smarty->assign("mes", 'Listing was Send');
$smarty->assign("title", 'Mailing List');
$smarty->display("rassilka.tpl");
}