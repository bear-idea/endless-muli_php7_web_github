<?php
if (!isset($_SESSION)) {
  session_start();
}
//$urlref = parse_url($_SERVER['HTTPREFERER']);
if ((isset($_POST["Mail_Send_Form"])) && ($_POST["Mail_Send_Form"] == "Mail_Send_On") && $_SESSION['Bot_Check_Value'] == true /*&& $urlref['host'] == $_SERVER['HTTP_HOST']*/) {
$mailbody = 
"客戶意見表"
. "				\n"
. "  <table width=\"550\" cellpadding=\"0\" cellspacing=\"0\" class=\"inquForm\">\n"
. "				\n"
. "					<tbody>\n"
. "						<tr>\n"
. "							<td width=\"160\" \n"
. "class=\"columnName\"  bgcolor=\"#F7FFCE\"><span class=\"txtImportant\">*</span> 主題:</td>\n"
. "							<td width=\"388\" bgcolor=\"#F7FFCE\">" . $_POST['subject'] .  "</td>\n"
. "						</tr>\n"
. "						<tr>\n"
. "							<td class=\"columnName\"><span \n"
. "class=\"txtImportant\">*</span> 姓名:</td>\n"
. "							<td>" . $_POST['neme'] .  "</td>\n"
. "						</tr>\n"
. "						<tr>\n"
. "							<td class=\"columnName\" bgcolor=\"#F7FFCE\"><span \n"
. "class=\"txtImportant\">*</span> 公司名稱:</td>\n"
. "							<td bgcolor=\"#F7FFCE\">" . $_POST['Company'] .  "</td>\n"
. "						</tr>\n"
. "						<tr>\n"
. "							<td class=\"columnName\"><span \n"
. "class=\"txtImportant\">*</span> 通訊地址:</td>\n"
. "							<td>" . $_POST['Address'] .  "</td>\n"
. "						</tr>\n"
. "						<tr>\n"
. "							<td class=\"columnName\" bgcolor=\"#F7FFCE\">城市:\n"
. "</td>\n"
. "							<td bgcolor=\"#F7FFCE\">" . $_POST['City'] .  "</td>\n"
. "						</tr>\n"
. "						<tr>\n"
. "							<td class=\"columnName\">省/縣/州:\n"
. "</td>\n"
. "							<td>" . $_POST['State'] .  "</td>\n"
. "						</tr>\n"
. "						<tr>\n"
. "							<td class=\"columnName\" bgcolor=\"#F7FFCE\">郵遞區號:\n"
. "</td>\n"
. "							<td bgcolor=\"#F7FFCE\">" . $_POST['Zip'] .  "</td>\n"
. "						</tr>\n"
. "						\n"
. "						<tr>\n"
. "							<td class=\"columnName\"><span \n"
. "class=\"txtImportant\">*</span> 國家:</td>\n"
. "							<td>" . $_POST['Country'] .  "</td>\n"
. "						</tr>\n"
. "						<tr>\n"
. "							<td class=\"columnName\" bgcolor=\"#F7FFCE\"><span \n"
. "class=\"txtImportant\">*</span> 電話:</td>\n"
. "							<td bgcolor=\"#F7FFCE\">" . $_POST['phone'] .  "</td>\n"
. "						</tr>\n"
. "						<tr>\n"
. "							<td class=\"columnName\"><span \n"
. "class=\"txtImportant\">*</span> 傳真:</td>\n"
. "							<td>" . $_POST['Fax'] .  "</td>\n"
. "						</tr>\n"
. "						<tr>\n"
. "							<td class=\"columnName\" bgcolor=\"#F7FFCE\"><span \n"
. "class=\"txtImportant\">*</span> Email:</td>\n"
. "							<td bgcolor=\"#F7FFCE\">" . $_POST['mail'] .  "</td>\n"
. "						</tr>\n"
. "						<tr>\n"
. "							<td class=\"columnName\" bgcolor=\"#F7FFCE\"><span \n"
. "class=\"txtImportant\" >*</span> 您的留言 :</td>\n"
. "							<td bgcolor=\"#F7FFCE\">" . $_POST['message'] .  "</td>\n"
. "						</tr>\n"
. "					\n"
. "\n"
. "    </tbody>\n"
. "  </table>\n";

text;
//echo $mailbody;

require_once 'class.phpmailer.php';

$mail = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch

try {
  $mail->SetLanguage("zh", "/language/"); 
  $mail->CharSet = "UTF-8"; // 設置編碼
  $mail->Encoding = "base64";
  $mail->AddReplyTo('jack@fullvision.net', '豪峰冷凍空調有限公司'); //回信Email及名稱
  $mail->AddAddress('jack@fullvision.net', '豪峰冷凍空調有限公司'); // 收件者 [公司]
  $mail->SetFrom($_POST['mail'], $_POST['name']); // 寄件者
  //$mail->AddReplyTo('jack@fullvision.net', 'First Last');
  $mail->Subject = $_POST['subject'];
  $mail->AltBody = '您的郵件系統不支援HTML編碼方式!!'; // optional - MsgHTML will create an alternate automatically
  //郵件內容
  //$mail->MsgHTML(file_get_contents('contents.html'));
  $mail->Body = $mailbody;
  //$mail->AddAttachment('images/phpmailer.gif');      // attachment
  //$mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
  $mail->Send();
  //echo "郵件已傳送</p>";
  //echo "<a href=\"javascript:history.go(-1);\">回上一頁</a>\n";
  header(sprintf("Location: %s", $_SERVER['HTTP_REFERER']));

} catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}
}
?> 