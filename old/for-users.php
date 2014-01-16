<?php 
$do = $_GET['do'];

if ($do == 'auto') { include('for-users/auto.php'); }
else if ($do == 'moto') { include('for-users/moto.php'); }
else if ($do == 'boat') { include('for-users/boat.php'); }
else if ($do == 'plane') { include('for-users/plane.php'); }
else if ($do == 'machinery') { include('for-users/machinery.php'); }
else if ($do == 'spares') { include('for-users/spares.php'); }
else if ($do == 'products') { include('for-users/products.php'); }
else if ($do == 'my-settings') { include('for-users/my-settings.php'); }


?>