<?php 
$name = addslashes($_POST['name']);
$email = addslashes($_POST['email']);
$femail = addslashes($_POST['femail']);
$back = $_POST['backurl'];
header ('Content-type: text/html; charset=utf-8');

$mailas =$name." предлагает посмотреть инфо об авто: http://www.automixs.com$back";
$header = "Content-type: text/plain; charset=\"iso-8859-1\"\r\n";
$header .= "From: $name <$email>\r\n";

mail($femail, "From automixs.com", $mailas, $header);
echo('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script lang="javascript">alert(\'Сообщение отправлено!\'); document.location.href=\''.$back.'\'</script>');



?>