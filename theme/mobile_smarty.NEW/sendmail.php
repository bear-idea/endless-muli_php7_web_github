<?php require_once('Connections/DB_Conn.php'); ?>
<?php require_once("app/init/inc_setting_fr.php"); ?>
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
setcookie('Ct_Address',$_POST['Address'],time()+3600); 
setcookie('Ct_Phone',$_POST['phone'],time()+3600); 
setcookie('Ct_Fax',$_POST['Fax'],time()+3600);  
setcookie('Ct_Mail',$_POST['mail'],time()+3600);  
setcookie('Ct_Message',$_POST['message'],time()+3600);

$Lang_ContactPath = 'lang/' . $_POST['lang'] . '/lang_general.php'; 
require_once($Lang_ContactPath);

// securimage 驗證碼
	require_once ('securimage/securimage.php');
      $securimage = new Securimage();

      if ($securimage->check($_POST['ct_captcha']) == false) {
        //$errors['captcha_error'] = 'Incorrect security code entered<br />';
		$insertGoTo = $SiteBaseUrl . url_rewrite('contact',array('wshop'=>$_POST['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable) . $operate_params . "CheckError";
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
. "							<td colspan=\"2\" align=\"center\" bgcolor=\"#4D92F9\" style=\"color:#FFF;\"><strong>" . $_POST['contacttitle'] . "</strong></td>\n"
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
. "							<td width=\"160\" \n"
. "class=\"columnName\"><span class=\"txtImportant\">*</span> ".$Lang_Classify_Context_Mail_Send_Class.":</td>\n"
. "							<td width=\"388\" >" . $_POST['contacttype'] .  "</td>\n"
. "						</tr>\n"
. "						<tr>\n"
. "							<td class=\"columnName\"><span \n"
. "class=\"txtImportant\">*</span> ".$Lang_Classify_Context_Mail_Send_Name.":</td>\n"
. "							<td>" . $_POST['name'] .  "</td>\n"
. "						</tr>\n"
. "						<tr>\n"
. "							<td class=\"columnName\"><span \n"
. "class=\"txtImportant\">*</span> ".$Lang_Classify_Context_Mail_Send_Sex.":</td>\n"
. "							<td>" . $_POST['sex'] .  "</td>\n"
. "						</tr>\n"
. "						<tr>\n"
. "							<td class=\"columnName\"><span \n"
. "class=\"txtImportant\">*</span> ".$Lang_Classify_Context_Mail_Send_Addr.":</td>\n"
. "							<td>" . $_POST['Address'] .  "</td>\n"
. "						</tr>\n"
. "						<tr>\n"
. "							<td class=\"columnName\" ><span \n"
. "class=\"txtImportant\">*</span> ".$Lang_Classify_Context_Mail_Send_Phone.":</td>\n"
. "							<td >" . $_POST['phone'] .  "</td>\n"
. "						</tr>\n"
. "						<tr>\n"
. "							<td class=\"columnName\"><span \n"
. "class=\"txtImportant\">*</span> ".$Lang_Classify_Context_Mail_Send_Fax.":</td>\n"
. "							<td>" . $_POST['Fax'] .  "</td>\n"
. "						</tr>\n"
. "						<tr>\n"
. "							<td class=\"columnName\" ><span \n"
. "class=\"txtImportant\">*</span> Email:</td>\n"
. "							<td >" . $_POST['mail'] .  "</td>\n"
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
  $mail->AddReplyTo($_POST['mail'], $_POST['name']); //回信Email及名稱 (收件者是誰)
  $mail->AddAddress($_POST['SiteMail'], $_POST['SiteAuthor']); // 收件者 [公司]
  //$mail->AddBCC($_POST['mail']);//設定密件副本
  $mail->SetFrom($_POST['SiteMail'], $_POST['SiteAuthor']); // 寄件者 (填寫表單的人)
  //$mail->AddReplyTo('jack@fullvision.net', 'First Last');
  $mail->Subject = "[" . $_POST['contacttype'] . "]" . $_POST['subject'];
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
  //$insertSuccess = "contact.php?wshop=".$_POST['wshop']."&Opt=viewpage&lang=" . $_POST['lang'];
  $insertSuccess = $SiteBaseUrl . url_rewrite("contact",array('wshop'=>$_POST['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);
  header(sprintf("Location: %s", $insertSuccess));

} catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}
}
?>