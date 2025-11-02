<html>
<head>
<title>郵件發送</title>
</head>
<body>

<?php
//$mailbody = "gogog";
require_once 'class.phpmailer.php';

$mail = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch

try {
  $mail->CharSet = "UTF-8"; // 設置編碼
  $mail->Encoding = "base64";
  $mail->AddReplyTo('jack@fullvision.net', '富視網'); //回信Email及名稱
  $mail->AddAddress('jack@fullvision.net', 'John Doe'); // 收件者
  $mail->SetFrom('jack@fullvision.net', '富視網'); // 寄件者
  //$mail->AddReplyTo('jack@fullvision.net', 'First Last');
  $mail->Subject = '郵件主旨';
  $mail->AltBody = '您的郵件系統不支援HTML編碼方式!!'; // optional - MsgHTML will create an alternate automatically
  //郵件內容
  $mail->MsgHTML(file_get_contents('contents.html'));
  //$mail->Body = $mailbody;
  //$mail->AddAttachment('images/phpmailer.gif');      // attachment
  $mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
  $mail->Send();
  echo "郵件已傳送</p>\n";
} catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}
?>
</body>
</html>
