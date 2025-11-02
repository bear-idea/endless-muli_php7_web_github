<?php 
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php require_once('Connections/DB_Conn.php'); ?>
<?php
// 紀錄 cookies
setcookie("Gs_Title", $_POST['title'],time()+3600); 
setcookie("Gs_Author", $_POST['author'],time()+3600); 
setcookie("Gs_Content", $_POST['content'],time()+3600); 
setcookie("Gs_Mail", $_POST['mail'],time()+3600); 
setcookie("Gs_Msn", $_POST['msn'],time()+3600);  
?>
<?php // 屏蔽boT
// 載入 NoSpamNX class
//include_once('class/NoSpamNX.php');
// 建立物件時可以指定 SESSION 的名稱，或不輸入使用預設值
//$noSpamNX = new NoSpamNX('test_for_NoSpamNX');
// 產生隨機順序的隱藏欄位
//$hidden_fields_for_NoSpamNX = $noSpamNX->addHiddenFields();
?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Guestbook")) {
	
	if($_COOKIE['CookieGsValue']!=$_SERVER["REMOTE_ADDR"] || !isset($_COOKIE['CookieGsValue'])) { 
	
	// securimage 驗證碼
	require_once ('securimage/securimage.php');
      $securimage = new Securimage();

      if ($securimage->check($_POST['ct_captcha']) == false) {
        //$errors['captcha_error'] = 'Incorrect security code entered<br />';
		$insertGoTo = "guestbook.php?Operate=CheckError&Opt=addpage&lang=" . $_POST['lang'] . "&wshop=" . $_POST['wshop'] ;
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
	header(sprintf("Location: %s", $insertGoTo));
  //setcookie("CookieGsValue",$_SERVER["REMOTE_ADDR"],time()+360); // 0.5hr
  ob_end_flush(); // 輸出緩衝區結束
  exit;}
      }
	// securimage END
	  
	$_COOKIE['CookieGsValue'] = $_SERVER["REMOTE_ADDR"];
	//$post_data_for_NoSpamNX = $_POST['nospamnx'];
	/*if (!$noSpamNX->Verify($post_data_for_NoSpamNX)) {
                  $errors[] = '隱藏驗證失敗，NoSpamNX 判定為機器人程式所發送';
				  die();
     }*/
  $insertSQL = sprintf("INSERT INTO demo_guestbookmessage (title, author, content, mail, msn, ip, postdate, whisper, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['author'], "text"),
                       GetSQLValueString(strip_tags($_POST['content']), "text"),
                       GetSQLValueString($_POST['mail'], "text"),
                       GetSQLValueString($_POST['msn'], "text"),
                       GetSQLValueString($_POST['ip'], "text"),
                       GetSQLValueString($_POST['postdate'], "date"),
                       GetSQLValueString($_POST['whisper'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));

  $insertGoTo = "guestbook.php?Operate=addSuccess&Opt=viewpage&lang=" . $_POST['lang'] . "&wshop=" . $_POST['wshop'] ;
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
  setcookie("CookieGsValue",$_SERVER["REMOTE_ADDR"],time()+360); // 0.5hr
  ob_end_flush(); // 輸出緩衝區結束
  exit;
	}else{
		$insertGoTo = "guestbook.php?Operate=TimeOut&Opt=addpage&lang=" . $_POST['lang'] . "&wshop=" . $_POST['wshop'] ;
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
	header(sprintf("Location: %s", $insertGoTo));
  //setcookie("CookieGsValue",$_SERVER["REMOTE_ADDR"],time()+360); // 0.5hr
  ob_end_flush(); // 輸出緩衝區結束
  exit;
  }
	}
}
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/view_guestbook_add.php"); ?>
<?php } ?>

