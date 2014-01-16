<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";

$partners=getPartners();
$smarty->assign("partners", $partners);


$mode = processGetVariable('mode');
if (!$mode || $mode=="")
$mode = processPostVariable('mode');
if($mode=='main'){
$br1=getAllCarsBrands();
$br=getAllCarsModels();
for($i=0; $i<=count($br); $i++)
$br2[$br[$i]['id']]=$br[$i]['name'];
$smarty->assign("br2", $br2);
$smarty->assign("br1", $br1);
$smarty->assign("br", $br);
$smarty->assign("title", 'Добавление марки или модели авто');
$smarty->display("auto_new_add.tpl");
}
if($mode=='addmark'){
$mark = processPostVariable('mark');
addNewCarMark($mark);
$br1=getAllCarsBrands();
$br=getAllCarsModels();
for($i=0; $i<=count($br); $i++)
$br2[$br[$i]['id']]=$br[$i]['name'];
$smarty->assign("br2", $br2);
$smarty->assign("br1", $br1);
$smarty->assign("br", $br);
$smarty->assign("mm", 'Марка добавлена');
$smarty->assign("title", 'Добавление марки или модели авто');
$smarty->display("auto_new_add.tpl");
}
if($mode=='addmodel'){
$brand = processPostVariable('brand');
$model = processPostVariable('model');
addNewCarModel($model, $brand);
$br1=getAllCarsBrands();
$br=getAllCarsModels();
for($i=0; $i<=count($br); $i++)
$br2[$br[$i]['id']]=$br[$i]['name'];
$smarty->assign("br2", $br2);
$smarty->assign("br1", $br1);
$smarty->assign("br", $br);
$smarty->assign("mm", 'Модель добавлена');
$smarty->assign("title", 'Добавление марки или модели авто');
$smarty->display("auto_new_add.tpl");
}
if($mode=='delmark'){
$brand = processPostVariable('brand');
delCarsMark($brand);
delAllCarsModelByBrand($brand);
$br1=getAllCarsBrands();
$br=getAllCarsModels();
for($i=0; $i<=count($br); $i++)
$br2[$br[$i]['id']]=$br[$i]['name'];
$smarty->assign("br2", $br2);
$smarty->assign("br1", $br1);
$smarty->assign("br", $br);
$smarty->assign("mm", 'Марка удалена');
$smarty->assign("title", 'Добавление марки или модели авто');
$smarty->display("auto_new_add.tpl");
}
if($mode=='delmodel'){
$brand = processPostVariable('brand');
delCarsModel($brand);
$br1=getAllCarsBrands();
$br=getAllCarsModels();
for($i=0; $i<=count($br); $i++)
$br2[$br[$i]['id']]=$br[$i]['name'];
$smarty->assign("br2", $br2);
$smarty->assign("br1", $br1);
$smarty->assign("br", $br);
$smarty->assign("mm", 'Модель удалена');
$smarty->assign("title", 'Добавление марки или модели авто');
$smarty->display("auto_new_add.tpl");
}
?>