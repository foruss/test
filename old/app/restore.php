<?php
require_once "../config.php";
require_once LIB_DIR . "utils.php";
require_once LIB_DIR . "dbutils.php";
require_once LIB_DIR . "smarty.php";

/*function dateDiff ($interval,$date1,$date2) {
    // получает количество секунд между двумя датами 
    $timedifference = $date2 - $date1;
    switch ($interval) {
        case 'w':
            $retval = bcdiv($timedifference,604800);
            break;
        case 'd':
            $retval = bcdiv($timedifference,86400);
            break;
        case 'h':
            $retval =bcdiv($timedifference,3600);
            break;
        case 'm':
            $retval = bcdiv($timedifference,60);
            break;
        case 's':
            $retval = $timedifference;
            break;
            
    }
    return $retval;
}
*/
$mode = processGetVariable('mode');
if ($mode=='form'){
	$smarty->assign('content','form');
	$smarty->display('restore.tpl');
}
elseif($mode=='sent'){
	$login = processPostVariable('login');
	$email = getUserEmailByLogin($login);
	$to = $email['email'];
	$rand = md5(microtime()*rand(1,10));
	if (setRestore($login, $rand)){
		$link = "http://automixs.j-lab.biz/restore/".$login."/".$rand."/";
		$subject = "AVTOMIXS, восстановление пароля";
		//Текст сообщения
		$mes ="";
		$mes.= "
		<html>
		<head>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
		  <title>Восстановление пароля</title>
		</head>
		<body>";
		$mes.= "
		<b>Восстановление пароля пользователя $login на AVTOMIXS</b><br />
		Была получена заявка на восстановление пароля.<br />
		Если вы желаете восстановить пароль на сайте, перейдите по ссылке:<br />
		<a href='$link' target='_blank'>$link</a><br />
		(или скопируйте ее в браузер)<br />
		<b>Ссылка действительна в течение суток:</b><br />
		<br />
		</body>
		</html>";
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= "FROM: <info@automixs.j-lab.biz>";
		if(!mail($to, $subject, $mes, $headers)) echo "<h1>FAILED!</h1>";
	}
	$smarty->assign('content','sent');
	$smarty->display('restore.tpl');
}
elseif($mode=='changepass'){
	$user=processGetVariable('user');
	$rand=processGetVariable('rand');
	if (!$restore = getRestore($user,$rand)){
		header(null,null,404);
		//$smarty->display('404.tpl');
		die(404);
	}
	else{
		$time = strtotime($restore['datetime']);
		$interval = dateDiff ('h',$time, time());
		if ($interval < 24){
			$smarty->assign('rand',$rand);
			$smarty->assign('content','changepass');
			$smarty->display('restore.tpl');
		}
		else{
			deleteRestore($user, $rand);	
			header(null,null,404);
			//$smarty->display('404.tpl');
			die(404);
		}
	}
}
elseif($mode=='changepassok'){
	$login = processPostVariable('login');
	$rand=processPostVariable('rand');
	if (!getRestore($login,$rand)){
		header(null,null,403);
		//$smarty->display('404.tpl');
		die(403);
	}
	else{
		$password = processPostVariable('pass1');
		if (!changePass($login, $password)) echo "<h1>FAILED!</h1>";
		else{
			deleteRestore($login, $rand);
			$smarty->assign('content','changepassok');
			$smarty->display('restore.tpl');
		}
	}
}
//AJAX
elseif ($mode=="ckecklogin"){
	$login = processPostVariable('login');
	$answer = checklogin($login);
	echo $answer;
}

?>