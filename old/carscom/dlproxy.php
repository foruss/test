<?php



	$remote_proxylist = file_get_contents('http://toolz.j-lab.biz/proxycheckerZdhQWF/checkedproxy.txt');

	
	if (strlen($remote_proxylist)>1) {
	$handle1 = fopen('proxyfilelist.txt', 'w');
	fwrite($handle1,$remote_proxylist);
	fclose($handle1);
	echo 'Done';
	}
	else echo 'Failed';

?>