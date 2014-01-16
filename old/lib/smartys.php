<?php

require_once("../config.php");
require_once(SMARTY_DIR . 'Smarty.class.php');
require_once(DATA_DIR . 'site.php');
require_once(LIB_DIR . 'user.php');

if (!isset($smarty)) {
	$smarty = new Smarty;

	$smarty->template_dir = ROOT_DIR . 'templates/';
	$smarty->compile_dir = ROOT_DIR . 'templates_c/';
	$smarty->config_dir = ROOT_DIR . 'configs/';
	$smarty->cache_dir = ROOT_DIR . 'cache/';
	
	// Добавляем переменные по-умолчанию
	$smarty->assign('sitetree', $sitetree);
	$smarty->assign('title', $sitetitle);
	
	isUserLoggedIn();
	$smarty->assign('user', $config["user"]);

}