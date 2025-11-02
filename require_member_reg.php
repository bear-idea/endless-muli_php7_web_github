<?php require_once('Connections/DB_Conn.php'); ?>
<?php //require_once("inc_setting_fr.php"); ?>
<?php

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  Global $DB_Conn;
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = mysqli_real_escape_string($DB_Conn, $theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Member")) {

// securimage 驗證碼
	require_once ('securimage/securimage.php');
      $securimage = new Securimage();

      if ($securimage->check($_POST['ct_captcha']) == false) {
        //$errors['captcha_error'] = 'Incorrect security code entered<br />';
		$_SESSION['RegStep'] = '1'; // 回到步驟2
		echo $insertGoTo = $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reg'),'',$UrlWriteEnable) . $RegMsg_params . "CodeError";
  if (isset($_SERVER['QUERY_STRING'])) {
    //$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    //$insertGoTo .= $_SERVER['QUERY_STRING'];
	header(sprintf("Location: %s", $insertGoTo));
  //setcookie("CookieGsValue",$_SERVER["REMOTE_ADDR"],time()+360); // 0.5hr
  //ob_end_flush(); // 輸出緩衝區結束

  exit;}
      }
	// securimage END
}


// 判斷帳號是否重複
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect = $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reg'),'',$UrlWriteEnable) . $RegMsg_params . "error";
  $loginUsername = $_POST['account'];
  $loginEmail = $_POST['mail'];
  $LoginRS__query = sprintf("SELECT account FROM demo_member WHERE account=%s", GetSQLValueString($loginUsername, "text"));
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $LoginRS=mysqli_query($DB_Conn, $LoginRS__query) or die(mysqli_error($DB_Conn));
  $loginFoundUser = mysqli_num_rows($LoginRS);
  
  $LoginRSMail__query = sprintf("SELECT account FROM demo_member WHERE mail=%s", GetSQLValueString($loginEmail, "text"));
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $LoginRSMail=mysqli_query($DB_Conn, $LoginRSMail__query) or die(mysqli_error($DB_Conn));
  $loginFoundMail = mysqli_num_rows($LoginRSMail);
  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser > 0 || $loginFoundMail > 0){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    //$MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
	$_SESSION['RegStep'] == '1'; // 回到步驟2
	$MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginFoundUser. $MM_qsChar ."requsermail=".$loginFoundMail;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

// 會員驗證判斷
switch($MemberMailAuthSead)
{
	case "0": // 人工發送認證信
		$MemberAuthLevel = "Wshop_Member"; // 測試會員
	    $MemberAuth = $_POST['auth'];	
		break;
	case "1": // 系統發送認證信
		$MemberAuthLevel = "Wshop_Member"; // 測試會員
	    $MemberAuth = $_POST['auth'];				
		break;
	case "2": // 註冊即可登入會員
		$MemberAuthLevel = "Wshop_Member"; // 測試會員
	    $MemberAuth = "1";		
		break;
}

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Member")) {
  $insertSQL = sprintf("INSERT INTO demo_member (account, psw, name, nickname, sex, birthday, mail, regdate, level, tel, cellphone, addr1, fax, serviceunits, web, job, indicate, agreeprovision, agreemailsend, notes1, lang, auth, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['account'], "text"),
                       GetSQLValueString(md5($_POST['psw']), "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['nickname'], "text"),
                       GetSQLValueString($_POST['sex'], "text"),
                       GetSQLValueString($_POST['birthday'], "text"),
                       GetSQLValueString($_POST['mail'], "text"),
					   GetSQLValueString($_POST['regdate'], "date"),
					   GetSQLValueString($MemberAuthLevel, "text"), // 會員權限
                       GetSQLValueString($_POST['tel'], "text"),
                       GetSQLValueString($_POST['cellphone'], "text"),
                       GetSQLValueString($_POST['addr1'], "text"),
                       GetSQLValueString($_POST['fax'], "text"),
                       GetSQLValueString($_POST['serviceunits'], "text"),
                       GetSQLValueString($_POST['web'], "text"),
                       GetSQLValueString($_POST['job'], "text"),
                       GetSQLValueString($_POST['indicate'], "int"),
					   GetSQLValueString($_POST['agreeprovision'], "int"),
					   GetSQLValueString($_POST['agreemailsend'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_SESSION['lang'], "text"),
					   GetSQLValueString($MemberAuth, "text"),
					   GetSQLValueString($_SESSION['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $_SESSION['RegStep'] = '0'; // 回到步驟1
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  // <!-- ╭─────────────────────────────────────╮ -->
if($MemberMailAuthSead == '1') {
  // 發送認證信
  $servicemail=$DefaultSiteMail;//指定網站管理員服務信箱，請修改為自己的有效mail
  
  $DefaultSiteUrl = $_SERVER['HTTP_HOST'];
  $AuthUrl = "http://" . $DefaultSiteUrl . "/regiest/auth.php?account=" . $_POST['account'] . "&auth=" . $_POST['auth'] . "&wshop=" . $_POST['wshop'] . "&lang=" . $_POST['lang'];
  $Body = "親愛的 " . $_POST['account'] . " 您好！<br>" 
        . "歡迎您加入『" . $DefaultSiteName . "』會員。<br>"
		. "請啟動您的帳號以完成最後的註冊！以下為您的認證網址！<br><br>"
		. "<a href=\"" . $AuthUrl . "\">"
		. "請在此點擊認證您的帳號 </a><br><br>" 
		. "如果認證信重複寄送，請以最後一封認證信啟動，會員資料將以最終啟動會員帳號的 Email 為準！<br>"
		. "本信件為系統自動發送(請勿回信！！！)";

  //$From= "From: " . "=?UTF-8?B?" . base64_encode($DefaultSiteMailAuthor) . "?=" . " <" . $DefaultSiteMail . "> \n\r";
  //$Type= "Content-Type: text/html; charset=UTF-8\n\r" . "Content-Transfer-Encoding: 8bit\n\r";
  //$Header=$From.$Type;
  //$Subject="=?UTF-8?B?" . base64_encode($DefaultSiteMailSubject) . "?=";
  
  $subject=$DefaultSiteMailSubject;//信件標題
  $subject=mb_encode_mimeheader($subject, 'UTF-8');//指定標題將雙位元文字編碼為單位元字串，避免亂碼
  
  $headers = "MIME-Version: 1.0\r\n";//指定MIME(多用途網際網路郵件延伸標準)版本
  $headers .= "Content-type: text/html; charset=utf-8\r\n";//指定郵件類型為HTML格式
  $headers .= "From:".mb_encode_mimeheader($DefaultSiteMailAuthor, 'UTF-8')."<".$servicemail."> \r\n";//指定寄件者資訊
  $headers .= "Reply-To:".mb_encode_mimeheader($DefaultSiteMailAuthor, 'UTF-8')."<".$servicemail.">\r\n";//指定信件回覆位置
  $headers .= "Return-Path:".mb_encode_mimeheader($DefaultSiteMailAuthor, 'UTF-8')."<".$servicemail.">\r\n";//被退信時送回位置
	
  mail($_POST['mail'], $subject, $Body, $headers); 
  }
  //

  $insertGoTo = $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'log'),'',$UrlWriteEnable) . $operate_params . "regSuccess";
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
  exit();
}
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/member_reg.php"); ?>
<?php } ?>