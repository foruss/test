<?
$db_host="localhost";   // Mysql hostas
$db_user="automixs_kinaweb";  // Mysql useris 
$db_pasw="X]kKvRZZJMCm"; // Mysql paswordas
$db_name="automixs_n2"; // Pasirinkta DB

function mysqlconnect() {
 global $db_host, $db_user, $db_pasw, $db_name, $db;
 $db = mysql_connect("$db_host", "$db_user", "$db_pasw")
  or die ("Negaliu prisijungti");

 mysql_select_db ("$db_name")
  or die ("Negaliu prisijungti prie lenteles");
};

function mysqldisconnect() {
 global $db; 
 mysql_close($db);
};

?>