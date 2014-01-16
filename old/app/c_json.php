<?php
if (isset($_GET['id'])) $id = $_GET['id']; else $id="";
$url = "http://j0.j-lab.ru/search_xml/index.php?mode=model&make=".$id; 

$string = file_get_contents($url);
//$string = preg_replace('#([^<])/#','$1-',$string);
$string = str_replace("&", '&amp;', $string);
//(&lt;, &gt;, &amp;, &quot; and &apos;). 
$xml = simplexml_load_string($string);
function object2array($object)
{
    $return = NULL;
      
    if(is_array($object))
    {
        foreach($object as $key => $value)
            $return[$key] = object2array($value);
    }
    else
    {
        $var = get_object_vars($object);
          
        if($var)
        {
            foreach($var as $key => $value)
                $return[$key] = ($key && !$value) ? NULL : object2array($value);
        }
        else return $object;
    }

    return $return;
} 
$models = object2array($xml);

echo "<select name='model'>";
echo "<option value=''>Все</option>";
if (sizeof($models['car'])>0) {
foreach ($models['car'] as $k=>$v) {
	echo "<option value='".$v['model']."'>".$v['model']."</option>";
}
}
else echo "<option value=''>Все</option>";
echo "</select>";
?>


