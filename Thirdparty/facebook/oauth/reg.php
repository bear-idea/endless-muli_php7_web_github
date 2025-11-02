<?php require_once('../../../Connections/DB_Conn.php'); ?>
<?php require_once("../../../inc/inc_function.php"); ?>
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
if (isset($_POST['MM_insert']) && isset($_SESSION["fb_id"])) {
  $loginThirdpartyID=$_SESSION["fb_id"];
  //$loginUsername=$_POST['Wshop_account'];
  //$password=$_POST['psw'];
  $MM_fldUserAuthorization = "level";
  echo $MM_redirectLoginSuccess = "../../../Thirdparty/facebook/oauth/login.php?wshop=" . $_POST['wshop'];
  $MM_redirectLoginFailed = "binding.php?errMsg=n"; // 跳轉到綁定頁面
  $MM_redirectLoginHaveManyThirdpartyID = "binding.php?errMsg=m";
  $MM_redirecttoReferrer = false;
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  	
  $LoginRS__query=sprintf("SELECT account, psw, level FROM demo_member WHERE fbid=%s && userid=%s",
  GetSQLValueString($loginThirdpartyID, "text"),
  GetSQLValueString($_SESSION['userid'], "int")); 
   
  $LoginRS = mysqli_query($DB_Conn, $LoginRS__query) or die(mysqli_error($DB_Conn));
  $row_LoginRS = mysqli_fetch_assoc($LoginRS);
  $loginFoundUser = mysqli_num_rows($LoginRS);
  $totalRows_LoginRS = mysqli_num_rows($LoginRS);
  
  if($totalRows_LoginRS > 0){ // 此ID已被註冊
	  $_SESSION['MM_Username_' . $_GET['wshop']] = "";
      $_SESSION['MM_UserGroup_' . $_GET['wshop']] = "";	
	  header("Location: ". $MM_redirectLoginSuccess);
  }else{
	  echo $insertSQL = sprintf("INSERT INTO demo_member (fbid, name, mail, regdate, level, indicate, agreeprovision, agreemailsend, lang, auth, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_SESSION["fb_id"], "text"),
                       GetSQLValueString($_SESSION["fb_last_name"] . $_SESSION["fb_first_name"], "text"),
                       GetSQLValueString($_SESSION["fb_email"], "text"),
					   GetSQLValueString(date("Y-m-d"), "date"),
					   GetSQLValueString("Wshop_Member", "text"), // 會員權限
                       GetSQLValueString("1", "int"),
					   GetSQLValueString("1", "int"),
					   GetSQLValueString("1", "int"),
                       GetSQLValueString($_SESSION['lang'], "text"),
					   GetSQLValueString("1", "text"),
					   GetSQLValueString($_SESSION['userid'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
	  header("Location: ". $MM_redirectLoginSuccess);
  }
}else{
	//echo $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_POST['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'log'),'',$UrlWriteEnable);
	header("location:".$SiteBaseUrl . url_rewrite('member',array('wshop'=>$_POST['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'log'),'',$UrlWriteEnable));
	return false;
}
?>