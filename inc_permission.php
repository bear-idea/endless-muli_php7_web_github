<?php require_once('Connections/DB_Conn.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}

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

$coluserid_RecordPermissionLevelGroup = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordPermissionLevelGroup = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPermissionLevelGroup = sprintf("SELECT * FROM demo_memberright WHERE userid=%s",GetSQLValueString($coluserid_RecordPermissionLevelGroup, "int"));
$RecordPermissionLevelGroup = mysqli_query($DB_Conn, $query_RecordPermissionLevelGroup) or die(mysqli_error($DB_Conn));
$row_RecordPermissionLevelGroup = mysqli_fetch_assoc($RecordPermissionLevelGroup);
$totalRows_RecordPermissionLevelGroup = mysqli_num_rows($RecordPermissionLevelGroup);
//echo $_SESSION['MM_UserGroup'];

$MM_authorizedUsers = "Wshop_Member";

do { 
    $MM_authorizedUsers = $MM_authorizedUsers . "," . $row_RecordPermissionLevelGroup['level'];
} while ($row_RecordPermissionLevelGroup = mysqli_fetch_assoc($RecordPermissionLevelGroup)); 
//echo $MM_authorizedUsers;

$arr_MM_authorizedUsers = explode(",", $MM_authorizedUsers);

// 登出
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username_' . $_GET['wshop']] = NULL;
  $_SESSION['MM_UserGroup_' . $_GET['wshop']] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username_' . $_GET['wshop']]);
  unset($_SESSION['MM_UserGroup_' . $_GET['wshop']]);
  unset($_SESSION['PrevUrl']);
  unset($_SESSION['success_line_login_backstage_'.$_GET['wshop']]);
  unset($_SESSION['success_google_login_backstage_'.$_GET['wshop']]);
  unset($_SESSION['success_fb_login_backstage_'.$_GET['wshop']]);
	
  $logoutGoTo = $_SERVER['HTTP_REFERER'];
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>