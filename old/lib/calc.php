<?php
function getcalcinfo( $stoimost,$avans,$stavka,$srok_kredita)
# $stoimost=��������� ����������   $avans=��������� �����, %     $stavka=������ �� �������, % , $srok_kredita=���� ������� (�������)
{
	$kredit_sum = $stoimost*(1-($avans/100));  
	$result = array();
	$ostatok = $kredit_sum;
	$osnovnoi_dolg_in_month = $kredit_sum / $srok_kredita;
	$total_summ=0;
	for ($i=1;$i <= $srok_kredita;$i++) 
	{	
		$percent_per_month = $ostatok*$stavka/1200;
		$result[$i]['i']=$i;	
		$result[$i]['ostatok']=number_format($ostatok, 0, ',', ' ');
		$result[$i]['osnovnoi_dolg']=number_format($osnovnoi_dolg_in_month, 2, ',', ' ');
		$result[$i]['percent_per_month']=number_format($percent_per_month, 1, ',', ' ');
		$result[$i]['total_paid']=number_format($osnovnoi_dolg_in_month+$percent_per_month, 1, ',', ' ');		
		$ostatok -=$osnovnoi_dolg_in_month;
		$total_summ +=$osnovnoi_dolg_in_month+$percent_per_month;
		$avgpaid = number_format($total_summ/$srok_kredita, 0, ',', ' ');;
	}	
	return array($result,$avgpaid);
    } ;
#------------------eof-----------------------------------
    
    //list ($result,$avgpaid) = getcalcinfo(19800.45,0,12.3,60);
    //echo $avgpaid;
    //print_r($result)
    
    
?>