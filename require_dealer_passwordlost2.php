<?php require_once('Connections/DB_Conn.php'); ?>
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

$colname_RecordSendMail = "-1";
if (isset($_POST['mail'])) {
  $colname_RecordSendMail = $_POST['mail'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSendMail = sprintf("SELECT * FROM demo_dealer WHERE mail = %s", GetSQLValueString($colname_RecordSendMail, "text"));
$RecordSendMail = mysqli_query($DB_Conn, $query_RecordSendMail) or die(mysqli_error($DB_Conn));
$row_RecordSendMail = mysqli_fetch_assoc($RecordSendMail);
$totalRows_RecordSendMail = mysqli_num_rows($RecordSendMail);
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
  $MM_redirectLoginSuccess = $_SERVER['REQUEST_URI'];
  $MM_redirectLoginFailed = $_SERVER['REQUEST_URI'] . "&errMsg=y";
  $MM_redirecttoReferrer = false;
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  	
  $LoginRS__query=sprintf("SELECT account, psw, level FROM demo_dealer WHERE account=%s AND psw=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysqli_query($DB_Conn, $LoginRS__query) or die(mysqli_error($DB_Conn));
  $loginFoundUser = mysqli_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysqli_result($LoginRS,0,'level');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username_' . $_GET['wshop']] = $loginUsername;
    $_SESSION['MM_UserGroup_' . $_GET['wshop']] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
     //header("Location: " . $MM_redirectLoginSuccess );
	echo("<script language='javascript'>location.href='" . $MM_redirectLoginSuccess . "'</script>");
  }
  else {
    //header("Location: ". $MM_redirectLoginFailed );
	echo("<script language='javascript'>location.href='" . $MM_redirectLoginFailed . "'</script>");
  }
}
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/dealer_passwordlost2.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordSendMail);
?>
