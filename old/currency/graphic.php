<?php
function drawGraphic($DATA, $filename){
	// ������ ���������� �������� #######################################
	// ������ �����������
	$W=200;
	$H=140;
	// �������
	$MB=20; // ������
	$ML=0; // �����
	$M=12; // ������� � ������ �������.
	// ��� ������, ��� ��� ��� ��� ������
	// ������ ������ �������
	$LW=imagefontwidth(1);
	// ���������� ���������� ��������� (�����) �� �������
	$count=count($DATA[0]);
	if ($count==0) $count=1;
	// ���������� ������� ###############################################
	if ($_GET["smooth"]==1) {
		// ������� �� ��� ����� ������ � ����� �� ��������. �������� �
		// ���� ������ ������ ������� �������. ��������, ����� ����
		// y[0]=16 � y[n]=17, �� y[1]=16 � y[-2]=16 � y[n+1]=17 � y[n+2]=17
		// ����� ���������� ����� ���������� ��� ����������� �����
		// � ����� �������
		for ($j=0;$j<1;$j++) {
			$DATA[$j][-1]=$DATA[$j][-2]=$DATA[$j][0];
			$DATA[$j][$count]=$DATA[$j][$count+1]=$DATA[$j][$count-1];
		}
		// ����������� ������� ������� ���������� �������� ��������
		for ($i=0;$i<$count;$i++) {
			for ($j=0;$j<1;$j++) {
				$DATA[$j][$i]=($DATA[$j][$i-1]+$DATA[$j][$i-2]+
				$DATA[$j][$i]+$DATA[$j][$i+1]+
				$DATA[$j][$i+2])/5;
			}
		}
	}
	// ���������� ������������ ��������
	$max=0;
	for ($i=0;$i<$count;$i++) {
		$max=$max<$DATA[0][$i]?$DATA[0][$i]:$max;
	}
	// �������� ������������ �������� �� 10% (��� ����, ����� �������
	// ��������������� ������������� �������� �� �������� � � �������
	// �������
	$max = $DATA[3];
	$min = $DATA[2];
	$interval = $max-$min;
	// ���������� �������� � �������������� �����
	// ����� �� ��� Y.
	$county=10;
	// ������ � ������������ ############################################
	// �������� �����������
	$im=imagecreate($W,$H);
	// ���� ���� (�����)
	$bg[0]=imagecolorallocate($im,255,255,255);
	// ���� ������ ����� ������� (������-�����)
	$bg[1]=imagecolorallocate($im,250,250,250);
	// ���� ����� ����� ������� (�����)
	$bg[2]=imagecolorallocate($im,212,212,212);
	// ���� ������� �������
	$bg[3]=imagecolorallocate($im,230,230,230);
	// ���� ����� (�����, ������)
	$c=imagecolorallocate($im,184,184,184);
	// ���� ������ (�����-�����)
	$text=imagecolorallocate($im,100,100,100);
	// ����� ��� ����� ��������
	$bar[2]=imagecolorallocate($im,191,65,170);
	$bar[0]=imagecolorallocate($im,100,100,100);
	$bar[1]=imagecolorallocate($im,50,50,50);
	$text_width=0;
	// ����� �������� �� ��� Y
	for ($i=1;$i<=$county;$i++) {
		$strl=strlen(($max/$county)*$i)*$LW;
		if ($strl>$text_width) $text_width=$strl;
	}
	// ���������� ����� ������� � ������ ������ �������� �� ��� Y
	$ML+=$text_width;
	// ��������� �������� ������� ������� (�� ������� �������� �
	// ��������)
	$RW=$W-$ML-$M;
	$RH=$H-$MB-$M;
	// ��������� ���������� ����
	$X0=$ML;
	$Y0=$H-$MB;
	$step=$RH/$county;
	imagefilledrectangle($im, $X0, $Y0-$RH, $X0+$RW, $Y0, $bg[1]);
	// ������������ ������� ��� ��������
	$dx=($RW/$count)/2;
	$pi=$Y0-($RH/$max*$DATA[0][0]);
	$px=intval($X0+$dx);
	$points = array($X0, $Y0);
	$points[] = $X0;
	$points[] = $Y0-($RH/($max-$min)*($DATA[0][0]-$min));
	for ($i=1;$i<$count-1;$i++) {
		$x=intval($X0+$i*($RW/$count)+$dx);
		$y=$Y0-($RH/($max-$min)*($DATA[0][$i]-$min));
		$points[] = $x;
		$points[] = $y;
		$pi=$y;
		$px=$x;
	}
	$points[] = $X0 + $RW;
	$points[] = $Y0-($RH/($max-$min)*($DATA[0][$count-1]-$min));
	$points[] = $X0 + $RW;
	$points[] = $Y0;
	$points[] = $X0;
	$points[] = $Y0;
	imagefilledpolygon($im,$points,$count+2,$bg[3]);
	//////////////////////////////////////////
	// ����� ������� ����� �������
	imagerectangle($im, $X0, $Y0, $X0+$RW, $Y0-$RH, $c);
	// ����� ����� �� ��� Y
	for ($i=1;$i<=$county;$i++) {
		$y=$Y0-$step*$i;
		imageline($im,$X0,$y,$X0+$RW,$y,$c);
		imageline($im,$X0,$y,$X0-($ML-$text_width)/4,$y,$text);
	}
	// ����� ����� �� ��� X
	// ����� ���������� �����
	for ($i=0;$i<$count;$i+=9) {
		imageline($im,$X0+$i*($RW/$count),$Y0,$X0+$i*($RW/$count),$Y0-$RH,$c);
	}
	// ����� ����� �������
	$pi=$Y0-($RH/($max-$min)*($DATA[0][0]-$min));
	$px=$X0;
	for ($i=1;$i<$count-1;$i++) {
		$x=intval($X0+$i*($RW/$count)+$dx);
		$y=$Y0-($RH/($max-$min)*($DATA[0][$i]-$min));
		imageline($im,$px,$pi,$x,$y,$bar[0]);
		$pi=$y;
		$px=$x;
	}
	$x = $X0 + $RW;
	$y = $Y0-($RH/($max-$min)*($DATA[0][$count-1]-$min));
	imageline($im,$px,$pi,$x,$y,$bar[0]);
	/////////////////////////
	// ���������� � �������� ���������
	$ML-=$text_width;
	// ����� �������� �� ��� Y
	$certanty = 0;
	if($interval/10<1) $certanty = 1;
	if($interval/10<0.1) $certanty = 2;
	if($interval/10<0.01) $certanty = 3;
	for ($i=0;$i<=$county;$i++) {
		$str=round($DATA[2]+(($DATA[3] - $DATA[2])/$county)*$i,$certanty);
		imagestring($im,1, $X0-strlen($str)*$LW-$ML/4-2,$Y0-$step*$i-imagefontheight(2)/2,$str,$text);
	}
	//����� ���� ���������
	imageline($im,$X0,$Y0,$X0,$Y0-$RH,$bar[1]);
	imageline($im,$X0,$Y0,$X0+$RW,$Y0,$bar[1]);
	//////////////////////
	// ����� �������� �� ��� X
	$prev=100000;
	$twidth=$RW*3/$count;
	$i=$X0+$RW;
	$y = $count;
	for ($i=0;$i<=$count;$i+=18) {
		$drawx = $X0+$i*($RW/$count);
		imageline($im,$drawx,$Y0,$X0+$i*($RW/$count),$Y0+5,$text);
		$str = $DATA[1][$i];
		imagestring($im,1, $drawx-(strlen($str)*$LW)/2, $Y0+7,$str,$text);
	}
	// ��������� �����������
	ImagePNG($im,$filename);
	imagedestroy($im); 
}
?>