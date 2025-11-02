<?php require_once('Connections/DB_Conn.php'); ?>
<?php require_once('require_member_limit_login.php'); // 限制存取頁面?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Member")) {
  $updateSQL = sprintf("UPDATE demo_member SET name=%s, nickname=%s, sex=%s, birthday=%s, mail=%s, auth=%s, tel=%s, cellphone=%s, addr1=%s, fax=%s, serviceunits=%s, web=%s, job=%s, indicate=%s, notes1=%s WHERE id=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['nickname'], "text"),
                       GetSQLValueString($_POST['sex'], "text"),
                       GetSQLValueString($_POST['birthday'], "text"),
                       GetSQLValueString($_POST['mail'], "text"),
                       GetSQLValueString($_POST['auth'], "text"),
                       GetSQLValueString($_POST['tel'], "text"),
                       GetSQLValueString($_POST['cellphone'], "text"),
                       GetSQLValueString($_POST['addr1'], "text"),
                       GetSQLValueString($_POST['fax'], "text"),
                       GetSQLValueString($_POST['serviceunits'], "text"),
                       GetSQLValueString($_POST['web'], "text"),
                       GetSQLValueString($_POST['job'], "text"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

  $updateGoTo = $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'editpage'),'',$UrlWriteEnable) . $operate_params . "editSuccess";
  //if (isset($_SERVER['QUERY_STRING'])) {
    //$updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    //$updateGoTo .= $_SERVER['QUERY_STRING'];
  //}
  header(sprintf("Location: %s", $updateGoTo));
}

/* 取得資料 */
require_once('require_member_get.php');	

?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/member_edit.php"); ?>
<?php } ?>
