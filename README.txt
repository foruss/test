1. ���������� ����� ������ http://www.denwer.ru/
��� ������ �������� apache, mysql  � ��.
2. ����������� ��� ����� � ���������� � �������
������:
C:\WebServers\home\saittest\www
3. �� ������
http://localhost/Tools/phpmyadmin/index.php
������������� ��. ���� automixs_car.sql  � ����� �����. 
4.
��������� ������ ����.
������ ������ ����� ��� ������ saittest/

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

���� Z - �����������. ��� ������ �������. 
����� ���� ������������� ������ ����������� �� ������ http://saittest/