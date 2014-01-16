<?php 
$do = $_GET['do'];

if ($do == 'send-news') { include('app/send_news.php'); }
else if ($do == 'send-auto') { include('app/send_auto.php'); }
else if ($do == 'add-make') { include('app/add-make.php'); } 
else if ($do == 'add-cat') { include('app/add-cat.php'); }
else if ($do == 'pages') { include('app/pages.php'); }
else if ($do == 'news') { include('app/news.php'); }
else if ($do == 'faq') { include('app/faq.php'); }
else if ($do == 'banners') { include('app/banners.php'); }
else if ($do == 'users') { include('app/users.php'); }
else if ($do == 'categories') { include('app/categ.php'); }
else if ($do == 'database') { include('app/database.php'); }
?>