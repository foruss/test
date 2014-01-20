1. Установить пакет Денвер http://www.denwer.ru/
Это связка серверов apache, mysql  и пр.
2. Скопировать все файлы в директорию с сайтами
Пример:
C:\WebServers\home\saittest\www
3. По адресу
http://localhost/Tools/phpmyadmin/index.php
импортировать БД. Файл automixs_car.sql  в корне сайта. 
4.
Настроить конфиг файл.
Пример конфиг файла для адреса saittest/

<?php
// HTTP
define('HTTP_SERVER', 'http://saittest/');
define('HTTP_IMAGE', 'http://saittest/image/');
define('HTTP_ADMIN', 'http://saittest/admin/');

// HTTPS
define('HTTPS_SERVER', 'http://saittest/');
define('HTTPS_IMAGE', 'http://saittest/image/');

// DIR
define('DIR_APPLICATION', 'Z:\home\saittest\www/catalog/');
define('DIR_SYSTEM', 'Z:\home\saittest\www/system/');
define('DIR_DATABASE', 'Z:\home\saittest\www/system/database/');
define('DIR_LANGUAGE', 'Z:\home\saittest\www/catalog/language/');
define('DIR_TEMPLATE', 'Z:\home\saittest\www/catalog/view/theme/');
define('DIR_CONFIG', 'Z:\home\saittest\www/system/config/');
define('DIR_IMAGE', 'Z:\home\saittest\www/image/');
define('DIR_CACHE', 'Z:\home\saittest\www/system/cache/');
define('DIR_DOWNLOAD', 'Z:\home\saittest\www/download/');
define('DIR_LOGS', 'Z:\home\saittest\www/system/logs/');

// DB
define('DB_DRIVER', 'mysql');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'saittest');
define('DB_PREFIX', 'oc_');
?>

Диск Z - виртуальный. для работы денвера. 
Далее сайт автоматически должен запуститься по адресу http://saittest/