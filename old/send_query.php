<?php 
$name = addslashes($_POST['name']);
$email = addslashes($_POST['email']);
$skype = addslashes($_POST['skype']);
$back = addslashes($_POST['backurl']);
$koment = addslashes($_POST['koment']);
$owner = addslashes($_POST['owner']);
$scode = $_POST['scode'];
$code = "ms".$_POST['code']."et";
if (((!empty($skype) || !empty($email)) && (!empty($koment) && !empty($back))) && $scode == $code) {
$laiskas ="Объект: www.automixs.com$back\nИмя: $name\nEmail: $email\nSkype: $skype\n\n$koment";
header ('Content-type: text/html; charset=utf-8');

$header = "Content-type: text/plain; charset=\"utf-8\"\r\n";
if (!empty($email)) {
$header .= "From: $email\r\n";
} else {
$header .= "From: $name <$email>\r\n";
}
mail($owner, "from automixs.com", "$laiskas", $header);

echo('<script lang="javascript">alert(\'Вопрос был успешно отправлен.\'); document.location.href=\'http://www.automixs.com'.$back.'\';</script>');

} else {
header("Location: http://www.automixs.com");
}


?>