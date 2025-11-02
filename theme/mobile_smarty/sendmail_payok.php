<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

if ($_SESSION['lang'] == "") {
	$_SESSION['lang'] = $defaultlang; 
}else {
	$_SESSION['lang'] = $_POST['lang'];
}
// 紀錄 cookies
setcookie('Ct_Subject',$_POST['subject'],time()+3600); 
setcookie('Ct_Name',$_POST['name'],time()+3600);    
setcookie('Ct_Mail',$_POST['mail'],time()+3600);  
setcookie('Ct_Message',$_POST['message'],time()+3600);

$Lang_CartPath = 'lang/' . $_POST['lang'] . '/lang_cart.php'; 
require_once($Lang_CartPath);

// securimage 驗證碼
	require_once ('securimage/securimage.php');
      $securimage = new Securimage();

      if ($securimage->check($_POST['ct_captcha']) == false) {
        //$errors['captcha_error'] = 'Incorrect security code entered<br />';
		$insertGoTo = "cart.php?wshop=".$_POST['wshop']."&Opt=payok&lang=" . $_POST['lang'] . "&Operate=CheckError";
  if (isset($_SERVER['QUERY_STRING'])) {
    //$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    //$insertGoTo .= $_SERVER['QUERY_STRING'];
	header(sprintf("Location: %s", $insertGoTo));
  //setcookie("CookieGsValue",$_SERVER["REMOTE_ADDR"],time()+360); // 0.5hr
  //ob_end_flush(); // 輸出緩衝區結束
  exit;}
      }
	// securimage END
//$urlref = parse_url($_SERVER['HTTPREFERER']);
if ((isset($_POST["Mail_Send_Form"])) && ($_POST["Mail_Send_Form"] == "Mail_Send_On") && $_SESSION['Bot_Check_Value'] == true /*&& $urlref['host'] == $_SERVER['HTTP_HOST']*/) {
$mailbody = 
""
. "  <table width=\"550\" border=\"0\" cellpadding=\"5\" cellspacing=\"1\" style=\"border:#77B1F9 1px solid; background-color:#A4DCFD\">\n"
. "				\n"
. "					<tbody>\n"
. "						<tr>\n"
. "							<td colspan=\"2\" align=\"center\" bgcolor=\"#4D92F9\" style=\"color:#FFF;\"><strong>" . $Lang_Title_Cart_Payok . "</strong></td>\n"
. "						</tr>\n"
. "						<tr>\n"
. "							<td colspan=\"2\" align=\"center\">&nbsp;</td>\n"
. "						</tr>\n"
. "						<tr>\n"
. "							<td width=\"160\" \n"
. "class=\"columnName\"><span class=\"txtImportant\">*</span> ".$Lang_Classify_Context_Mail_Send_Title.":</td>\n"
. "							<td width=\"388\" >" . $_POST['subject'] .  "</td>\n"
. "						</tr>\n"
. "						<tr>\n"
. "							<td class=\"columnName\"><span \n"
. "class=\"txtImportant\">*</span> ".$Lang_Classify_Context_Mail_Send_Name.":</td>\n"
. "							<td>" . $_POST['name'] .  "</td>\n"
. "						</tr>\n"
. "							<td class=\"columnName\" ><span \n"
. "class=\"txtImportant\">*</span> ".$Lang_Classify_Context_Mail_Send_Phone.":</td>\n"
. "							<td >" . $_POST['phone'] .  "</td>\n"
. "						</tr>\n"
. "						<tr>\n"
. "							<td class=\"columnName\" ><span \n"
. "class=\"txtImportant\">*</span> Email:</td>\n"
. "							<td >" . $_POST['mail'] .  "</td>\n"
. "						</tr>\n"
. "						<tr>\n"
. "							<td class=\"columnName\"><span \n"
. "class=\"txtImportant\">*</span> ".$Lang_Classify_Context_Mail_Send_PayDate.":</td>\n"
. "							<td>" . $_POST['paydate'] .  "</td>\n"
. "						</tr>\n"
. "						<tr>\n"
. "							<td class=\"columnName\"><span \n"
. "class=\"txtImportant\">*</span> ".$Lang_Classify_Context_Mail_Send_PayNumber.":</td>\n"
. "							<td>" . $_POST['paynumber'] .  "</td>\n"
. "						</tr>\n"
. "						<tr>\n"
. "							<td class=\"columnName\"><span \n"
. "class=\"txtImportant\">*</span> ".$Lang_Classify_Context_Mail_Send_PayMoney.":</td>\n"
. "							<td>" . $_POST['paymoney'] .  "</td>\n"
. "						</tr>\n"
. "						<tr>\n"
. "							<td class=\"columnName\" ><span \n"
. "class=\"txtImportant\" >*</span> ".$Lang_Classify_Context_Mail_Send_Message." :</td>\n"
. "							<td >" . $_POST['message'] .  "</td>\n"
. "						</tr>\n"
. "						<tr>\n"
. "							<td class=\"columnName\" ><span \n"
. "class=\"txtImportant\"></span> </td>\n"
. "							<td >" . "" .  "</td>\n"
. "						</tr>\n"
. "						<tr>\n"
. "							<td class=\"columnName\" ><span \n"
. "class=\"txtImportant\" ></span> Send from :</td>\n"
. "							<td >" . $_SERVER['HTTP_HOST'] .  "</td>\n"
. "						</tr>\n"
. "					\n"
. "\n"
. "    </tbody>\n"
. "  </table>\n";

text;
//echo $mailbody;

require_once 'phpmail/class.phpmailer.php';

$mail = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch

try {
  $mail->SetLanguage("zh", "/phpmail/language/"); 
  $mail->CharSet = "UTF-8"; // 設置編碼
  $mail->Encoding = "base64";
  $mail->AddReplyTo("service@msa.hinet.net", "Server"); //回信Email及名稱 (收件者是誰)
  $mail->AddAddress($_POST['SiteMail'], $_POST['SiteAuthor']); // 收件者 [公司]
  $mail->SetFrom($_POST['SiteMail'], $_POST['SiteAuthor']); // 寄件者 (填寫表單的人)
  //$mail->AddReplyTo('jack@fullvision.net', 'First Last');
  $mail->Subject = $_POST['subject'];
  $mail->AltBody = '您的郵件系統不支援HTML編碼方式!!'; // optional - MsgHTML will create an alternate automatically
  //郵件內容
  //$mail->MsgHTML(file_get_contents('contents.html'));
  $mail->Body = $mailbody;
  //$mail->AddAttachment('images/phpmailer.gif');      // attachment
  //$mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
  $mail->Send();
  $_SESSION['mailsend_message'] = "On";
  //echo "郵件已傳送</p>";
  //echo "<a href=\"javascript:history.go(-1);\">回上一頁</a>\n";
  $insertSuccess = "cart.php?wshop=".$_POST['wshop']."&Opt=payok&lang=" . $_POST['lang'];
  header(sprintf("Location: %s", $insertSuccess));

} catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}
}
?>