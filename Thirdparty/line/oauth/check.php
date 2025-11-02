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

if (isset($_SESSION["line_id"])) {
  $loginThirdpartyID=$_SESSION["line_id"];
  //$loginUsername=$_POST['Wshop_account'];
  //$password=$_POST['psw'];
  $MM_fldUserAuthorization = "level";
  $MM_redirectLoginSuccess = $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);
  $MM_redirectLoginFailed = "binding.php?errMsg=n"; // 跳轉到綁定頁面
  $MM_redirectLoginHaveManyThirdpartyID = "binding.php?errMsg=m";
  $MM_redirecttoReferrer = false;
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  	
  $LoginRS__query=sprintf("SELECT account, psw, level FROM demo_member WHERE lineid=%s && userid=%s",
  GetSQLValueString($loginThirdpartyID, "text"),
  GetSQLValueString($_SESSION['userid'], "int")); 
   
  $LoginRS = mysqli_query($DB_Conn, $LoginRS__query) or die(mysqli_error($DB_Conn));
  $row_LoginRS = mysqli_fetch_assoc($LoginRS);
  $loginFoundUser = mysqli_num_rows($LoginRS);
  $totalRows_LoginRS = mysqli_num_rows($LoginRS);
  
  if($totalRows_LoginRS > 0){
	  $_SESSION['MM_Username_' . $_GET['wshop']] = NULL;
      $_SESSION['MM_UserGroup_' . $_GET['wshop']] = NULL;	
	  header("Location: ". $MM_redirectLoginHaveManyThirdpartyID);
  }
  
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysqli_result($LoginRS,0,'level');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username_' . $_GET['wshop']] = $row_LoginRS['account'];
    $_SESSION['MM_UserGroup_' . $_GET['wshop']] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
	
	// 記住帳密
	/*if($_POST['rember_check'] == '1') {
		setcookie("w_user", $_POST['Wshop_account'], time()+3600*24*30);
		setcookie("w_psw", $_POST['psw'], time()+3600*24*30);
	}*/
	$updateSQL = sprintf("UPDATE demo_member SET logdate=NOW() WHERE lineid=%s",
                       GetSQLValueString($_SESSION["line_id"], "text"));
	//mysqli_select_db($database_DB_Conn, $DB_Conn);	
	$Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
		
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}else{
	header("location:".$SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'log'),'',$UrlWriteEnable)); // redirect user to index page
	return false;
}
?>