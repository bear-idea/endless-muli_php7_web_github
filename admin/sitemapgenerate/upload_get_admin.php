<?php require_once('../Connections/DB_Conn.php'); ?>
<?php 
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
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

$colname_RecordAccount = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_RecordAccount = $_SESSION['MM_Username'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAccount = sprintf("SELECT * FROM demo_admin WHERE account = %s", GetSQLValueString($colname_RecordAccount, "text"));
$RecordAccount = mysqli_query($DB_Conn, $query_RecordAccount) or die(mysqli_error($DB_Conn));
$row_RecordAccount = mysqli_fetch_assoc($RecordAccount);
$totalRows_RecordAccount = mysqli_num_rows($RecordAccount);

?>
<?php
/* 判斷是否為子帳號 */
if($row_RecordAccount['grouptype'] == 'sub')
{
	//$groupwebname = $row_RecordAccount['groupwebname'];
	$groupid = $row_RecordAccount['groupid']; 
	
	$colname_RecordSubAccount = "-1";
	if (isset($groupid)) {
	  $colname_RecordSubAccount = $groupid;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordSubAccount = sprintf("SELECT * FROM demo_admin WHERE id = %s", GetSQLValueString($colname_RecordSubAccount, "text"));
	$RecordSubAccount = mysqli_query($DB_Conn, $query_RecordSubAccount) or die(mysqli_error($DB_Conn));
	$row_RecordSubAccount = mysqli_fetch_assoc($RecordSubAccount);
	$totalRows_RecordSubAccount = mysqli_num_rows($RecordSubAccount);
	
	/* 取代資料 */
	$row_RecordAccount['id'] = $row_RecordSubAccount['id'];
	$row_RecordAccount['name'] = $row_RecordSubAccount['name'];
	$row_RecordAccount['email'] = $row_RecordSubAccount['email'];
	$row_RecordAccount['webname'] = $row_RecordSubAccount['webname'];
	$row_RecordAccount['urlbuilddate'] = $row_RecordSubAccount['urlbuilddate'];
	$row_RecordAccount['webenabledate'] = $row_RecordSubAccount['webenabledate'];
	$row_RecordAccount['webrenewdate'] = $row_RecordSubAccount['webrenewdate'];
	$row_RecordAccount['usetime'] = $row_RecordSubAccount['usetime'];
	$row_RecordAccount['urllocalate'] = $row_RecordSubAccount['urllocalate'];
	$row_RecordAccount['urlonly'] = $row_RecordSubAccount['urlonly'];
	$row_RecordAccount['urllink'] = $row_RecordSubAccount['urllink'];
	$row_RecordAccount['urllink2'] = $row_RecordSubAccount['urllink2'];
	$row_RecordAccount['urlenable'] = $row_RecordSubAccount['urlenable'];
	$row_RecordAccount['hot'] = $row_RecordSubAccount['hot'];
	$row_RecordAccount['yhot'] = $row_RecordSubAccount['yhot'];
	$row_RecordAccount['nhot'] = $row_RecordSubAccount['nhot'];
	$row_RecordAccount['mhot'] = $row_RecordSubAccount['mhot'];
	$row_RecordAccount['ymhot'] = $row_RecordSubAccount['ymhot'];
	$row_RecordAccount['yhotdate'] = $row_RecordSubAccount['yhotdate'];
	$row_RecordAccount['plushot'] = $row_RecordSubAccount['plushot'];
	
	mysqli_free_result($RecordSubAccount);
}
?>
<?php $wshop = $row_RecordAccount['webname']; /*需先指定變數後面才會讀*/ ?>
<?php $wshopname = $row_RecordAccount['name']; ?>
<?php $wshopmail = $row_RecordAccount['email']; ?>
<?php $w_userid = $row_RecordAccount['id']; ?>
<?php $testuse = $row_RecordAccount['testuse']; ?>
<?php
mysqli_free_result($RecordAccount);
?>