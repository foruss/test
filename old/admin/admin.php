<?php
require_once "../config.php";
require_once LIB_DIR . "user.php";

if (!isUserLoggedIn() || $config['user']['admin'] == 0) {
	header(null,null,403);
	exit;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Twilight Area</title>
    <link rel="stylesheet" type="text/css" href="admin.css" />
</head>
<body scroll="no" id="docs">
	<div id="loading-mask" style="width:100%;height:100%;background:#c3daf9;position:absolute;z-index:20000;left:0;top:0;">&#160;</div>
	<div id="loading">
		<div class="loading-indicator"><img src="/images/default/grid/loading.gif" style="width:16px;height:16px;" align="absmiddle">&#160;Загрузка...</div>
	</div> 
	
	<!-- Подключаем библиотеки -->
    <link rel="stylesheet" type="text/css" href="/css/ext-all.css" />
	<link rel="stylesheet" type="text/css" href="/css/ytheme-vista.css" />
	<link rel="stylesheet" type="text/css" href="/js/ProgressBar/Ext.ux.ProgressBar.css" />
	<link rel="stylesheet" type="text/css" href="/js/UploadDialog/css/Ext.ux.UploadDialog.css" />
	<script type="text/javascript" src="/js/yui-utilities.js"></script>
	<script type="text/javascript" src="/js/ext-yui-adapter.js"></script>
	<script type="text/javascript" src="/js/ext-all.js"></script>
	<script type="text/javascript" src="/js/ProgressBar/Ext.ux.ProgressBar.js"></script>
	<script type="text/javascript" src="/js/UploadDialog/Ext.ux.UploadDialog.js"></script>
	<script type="text/javascript" src="/js/UploadDialog/locale/ru.utf-8.js"></script>
	<script type="text/javascript" src="HtmlEditor.js"></script>
	
	<!-- Обработчик -->
	<script type="text/javascript" src="admin.js"></script>
	
	<div id="container">
		<div id="center7" class="x-layout-inactive-content">
		</div>
		<div id="center6" class="x-layout-inactive-content">
		</div>
		<div id="center5" class="x-layout-inactive-content">
		</div>
		<div id="center4" class="x-layout-inactive-content">
		</div>
		<div id="center3" class="x-layout-inactive-content">
		</div>
		<div id="center2" class="x-layout-inactive-content">
		</div>
		<div id="center1" class="x-layout-inactive-content">
		</div>
	</div>
	
	<div id="news-dlg" style="visibility:hidden;">
	</div>
	<div id="articles-dlg" style="visibility:hidden;">
	</div>
	<div id="library-dlg" style="visibility:hidden;">
	</div>
</body>
</html>"