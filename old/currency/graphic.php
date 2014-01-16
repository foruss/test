<?php
function drawGraphic($DATA, $filename){
	// Задаем изменяемые значения #######################################
	// Размер изображения
	$W=200;
	$H=140;
	// Отступы
	$MB=20; // Нижний
	$ML=0; // Левый
	$M=12; // Верхний и правый отступы.
	// Они меньше, так как там нет текста
	// Ширина одного символа
	$LW=imagefontwidth(1);
	// Подсчитаем количество элементов (точек) на графике
	$count=count($DATA[0]);
	if ($count==0) $count=1;
	// Сглаживаем графики ###############################################
	if ($_GET["smooth"]==1) {
		// Добавим по две точки справа и слева от графиков. Значения в
		// этих точках примем равными крайним. Например, точка если
		// y[0]=16 и y[n]=17, то y[1]=16 и y[-2]=16 и y[n+1]=17 и y[n+2]=17
		// Такое добавление точек необходимо для сглаживания точек
		// в краях графика
		for ($j=0;$j<1;$j++) {
			$DATA[$j][-1]=$DATA[$j][-2]=$DATA[$j][0];
			$DATA[$j][$count]=$DATA[$j][$count+1]=$DATA[$j][$count-1];
		}
		// Сглаживание графики методом усреднения соседних значений
		for ($i=0;$i<$count;$i++) {
			for ($j=0;$j<1;$j++) {
				$DATA[$j][$i]=($DATA[$j][$i-1]+$DATA[$j][$i-2]+
				$DATA[$j][$i]+$DATA[$j][$i+1]+
				$DATA[$j][$i+2])/5;
			}
		}
	}
	// Подсчитаем максимальное значение
	$max=0;
	for ($i=0;$i<$count;$i++) {
		$max=$max<$DATA[0][$i]?$DATA[0][$i]:$max;
	}
	// Увеличим максимальное значение на 10% (для того, чтобы столбик
	// соответствующий максимальному значение не упирался в в границу
	// графика
	$max = $DATA[3];
	$min = $DATA[2];
	$interval = $max-$min;
	// Количество подписей и горизонтальных линий
	// сетки по оси Y.
	$county=10;
	// Работа с изображением ############################################
	// Создадим изображение
	$im=imagecreate($W,$H);
	// Цвет фона (белый)
	$bg[0]=imagecolorallocate($im,255,255,255);
	// Цвет задней грани графика (светло-серый)
	$bg[1]=imagecolorallocate($im,250,250,250);
	// Цвет левой грани графика (серый)
	$bg[2]=imagecolorallocate($im,212,212,212);
	// Цвет заливки графика
	$bg[3]=imagecolorallocate($im,230,230,230);
	// Цвет сетки (серый, темнее)
	$c=imagecolorallocate($im,184,184,184);
	// Цвет текста (темно-серый)
	$text=imagecolorallocate($im,100,100,100);
	// Цвета для линий графиков
	$bar[2]=imagecolorallocate($im,191,65,170);
	$bar[0]=imagecolorallocate($im,100,100,100);
	$bar[1]=imagecolorallocate($im,50,50,50);
	$text_width=0;
	// Вывод подписей по оси Y
	for ($i=1;$i<=$county;$i++) {
		$strl=strlen(($max/$county)*$i)*$LW;
		if ($strl>$text_width) $text_width=$strl;
	}
	// Подравняем левую границу с учетом ширины подписей по оси Y
	$ML+=$text_width;
	// Посчитаем реальные размеры графика (за вычетом подписей и
	// отступов)
	$RW=$W-$ML-$M;
	$RH=$H-$MB-$M;
	// Посчитаем координаты нуля
	$X0=$ML;
	$Y0=$H-$MB;
	$step=$RH/$county;
	imagefilledrectangle($im, $X0, $Y0-$RH, $X0+$RW, $Y0, $bg[1]);
	// Закрашивание области под графиком
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
	// Вывод главной рамки графика
	imagerectangle($im, $X0, $Y0, $X0+$RW, $Y0-$RH, $c);
	// Вывод сетки по оси Y
	for ($i=1;$i<=$county;$i++) {
		$y=$Y0-$step*$i;
		imageline($im,$X0,$y,$X0+$RW,$y,$c);
		imageline($im,$X0,$y,$X0-($ML-$text_width)/4,$y,$text);
	}
	// Вывод сетки по оси X
	// Вывод изменяемой сетки
	for ($i=0;$i<$count;$i+=9) {
		imageline($im,$X0+$i*($RW/$count),$Y0,$X0+$i*($RW/$count),$Y0-$RH,$c);
	}
	// Вывод линий графика
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
	// Уменьшение и пересчет координат
	$ML-=$text_width;
	// Вывод подписей по оси Y
	$certanty = 0;
	if($interval/10<1) $certanty = 1;
	if($interval/10<0.1) $certanty = 2;
	if($interval/10<0.01) $certanty = 3;
	for ($i=0;$i<=$county;$i++) {
		$str=round($DATA[2]+(($DATA[3] - $DATA[2])/$county)*$i,$certanty);
		imagestring($im,1, $X0-strlen($str)*$LW-$ML/4-2,$Y0-$step*$i-imagefontheight(2)/2,$str,$text);
	}
	//Вывод осей координат
	imageline($im,$X0,$Y0,$X0,$Y0-$RH,$bar[1]);
	imageline($im,$X0,$Y0,$X0+$RW,$Y0,$bar[1]);
	//////////////////////
	// Вывод подписей по оси X
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
	// Генерация изображения
	ImagePNG($im,$filename);
	imagedestroy($im); 
}
?>