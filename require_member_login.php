<?php require_once('Connections/DB_Conn.php'); ?>
<?php $originUrl=$_SERVER['HTTP_REFERER']; ?>
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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['account'])) {
  $loginUsername=$_POST['account'];
  $password=md5($_POST['psw']);
  $MM_fldUserAuthorization = "level";
  $MM_redirectLoginSuccess = $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);
  //$MM_redirectLoginSuccess = $_SERVER['REQUEST_URI'];
  $MM_redirectLoginFailed = $_SERVER['REQUEST_URI'] . $errMsg_params . "y";
  $MM_redirectLoginAuthFailed = $_SERVER['REQUEST_URI'] . $errMsg_params . "auth";
  $MM_redirecttoReferrer = false;
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  	
  $LoginRS__query=sprintf("SELECT account, psw, level, auth FROM demo_member WHERE account=%s AND psw=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysqli_query($DB_Conn, $LoginRS__query) or die(mysqli_error($DB_Conn));
  $row_LoginRS__query = mysqli_fetch_assoc($LoginRS);
  $loginFoundUser = mysqli_num_rows($LoginRS);
  if($row_LoginRS__query['auth'] != "1" && $loginFoundUser)
  {
	  echo("<script language='javascript'>location.href='" . $MM_redirectLoginAuthFailed . "'</script>");
  }else if ($loginFoundUser) {
    
    $loginStrGroup  = mysqli_result($LoginRS,0,'level');  
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username_' . $_GET['wshop']] = $loginUsername;
    $_SESSION['MM_UserGroup_' . $_GET['wshop']] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    //header("Location: " . $MM_redirectLoginSuccess );
	
	$updateSQL = sprintf("UPDATE demo_member SET logdate=NOW() WHERE account=%s",
                       GetSQLValueString($_POST['account'], "text"));
	//mysqli_select_db($database_DB_Conn, $DB_Conn);	
	$Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
	
	echo("<script language='javascript'>location.href='" . $MM_redirectLoginSuccess . "'</script>");
  }
  else {
    //header("Location: ". $MM_redirectLoginFailed );   
	echo("<script language='javascript'>location.href='" . $MM_redirectLoginFailed . "'</script>");
  }
}
?>
<?php //echo $_SERVER['PHP_SELF'] . "?wshop=" . $_POST['wshop'] . "&Opt=viewpage&lang=" . $_SESSION['lang'] ?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php //echo $row_LoginRS__query['auth']; ?>
<?php include($TplPath . "/member_login.php"); ?>
<?php } ?>