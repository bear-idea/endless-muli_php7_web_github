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

$colname_RecordCartListFreight = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordCartListFreight = $_GET['lang'];
}
$coluserid_RecordCartListFreight = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordCartListFreight = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCartListFreight = sprintf("SELECT * FROM demo_cartitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordCartListFreight, "text"),GetSQLValueString($coluserid_RecordCartListFreight, "int"));
$RecordCartListFreight = mysqli_query($DB_Conn, $query_RecordCartListFreight) or die(mysqli_error($DB_Conn));
$row_RecordCartListFreight = mysqli_fetch_assoc($RecordCartListFreight);
$totalRows_RecordCartListFreight = mysqli_num_rows($RecordCartListFreight);

$colname_RecordCartListPayment = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordCartListPayment = $_GET['lang'];
}
$coluserid_RecordCartListPayment = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordCartListPayment = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCartListPayment = sprintf("SELECT * FROM demo_cartitem WHERE list_id = 3 && lang=%s && userid=%s", GetSQLValueString($colname_RecordCartListPayment, "text"),GetSQLValueString($coluserid_RecordCartListPayment, "int"));
$RecordCartListPayment = mysqli_query($DB_Conn, $query_RecordCartListPayment) or die(mysqli_error($DB_Conn));
$row_RecordCartListPayment = mysqli_fetch_assoc($RecordCartListPayment);
$totalRows_RecordCartListPayment = mysqli_num_rows($RecordCartListPayment);

if($totalRows_RecordMember > 0) 
{
	/* 取得購物車清單 有會員 */
	$coluserid_RecordCartlist = "-1";
	if (isset($_SESSION['userid'])) {
	  $coluserid_RecordCartlist = $_SESSION['userid'];
	}
	$colmemberid_RecordCartlist = "-1";
	if (isset($row_RecordMember['id'])) {
	  $colmemberid_RecordCartlist = $row_RecordMember['id'];
	}
	$collang_RecordCartlist = "-1";
	if (isset($_SESSION['lang'])) {
	  $collang_RecordCartlist = $_SESSION['lang'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordCartlist = sprintf("SELECT * FROM demo_cart WHERE userid=%s && memberid=%s && lang=%s ORDER BY id DESC",GetSQLValueString($coluserid_RecordCartlist, "int"),GetSQLValueString($colmemberid_RecordCartlist, "int"),GetSQLValueString($collang_RecordCartlist, "text"));
	$RecordCartlist = mysqli_query($DB_Conn, $query_RecordCartlist) or die(mysqli_error($DB_Conn));
	$row_RecordCartlist = mysqli_fetch_assoc($RecordCartlist);
	$totalRows_RecordCartlist = mysqli_num_rows($RecordCartlist);
}else{
	/* 取得購物車清單 無會員 */
	$coluserid_RecordCartlist = "-1";
	if (isset($_SESSION['userid'])) {
	  $coluserid_RecordCartlist = $_SESSION['userid'];
	}
	$colUserAccessuniqid_RecordCartlist = "-1";
	if (isset($_SESSION['UserAccess'])) {
	  $colUserAccessuniqid_RecordCartlist = $_SESSION['UserAccess'];
	}
	$collang_RecordCartlist = "-1";
	if (isset($_SESSION['lang'])) {
	  $collang_RecordCartlist = $_SESSION['lang'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordCartlist = sprintf("SELECT * FROM demo_cart WHERE userid=%s && UserAccessuniqid=%s && lang=%s ORDER BY id DESC",GetSQLValueString($coluserid_RecordCartlist, "int"),GetSQLValueString($colUserAccessuniqid_RecordCartlist, "text"),GetSQLValueString($collang_RecordCartlist, "text"));
	$RecordCartlist = mysqli_query($DB_Conn, $query_RecordCartlist) or die(mysqli_error($DB_Conn));
	$row_RecordCartlist = mysqli_fetch_assoc($RecordCartlist);
	$totalRows_RecordCartlist = mysqli_num_rows($RecordCartlist);
}

if(!isset($_SESSION['OrderID'])){
		$_SESSION['OrderID'] = date("Ymd") . rand(100000,999999);
}
do
{
	if(isset($ordercount) && $ordercount == 1)
	{
		$_SESSION['OrderID'] = date("Ymd") . rand(100000,999999);  
	}
	$colname_RecordCartOrder = "-1";
	if (isset($_SESSION['OrderID'])) {
	$colname_RecordCartOrder = $_SESSION['OrderID'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordCartOrder = sprintf("SELECT * FROM demo_cartorders WHERE oserial = %s", GetSQLValueString($colname_RecordCartOrder, "text"));
	$RecordCartOrder = mysqli_query($DB_Conn, $query_RecordCartOrder) or die(mysqli_error($DB_Conn));
	$row_RecordCartOrder = mysqli_fetch_assoc($RecordCartOrder);
	$totalRows_RecordCartOrder = mysqli_num_rows($RecordCartOrder);
	$ordercount = 1;
}while($totalRows_RecordCartOrder > 0)
?>

<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/cart_flow.php"); ?>
<?php } ?>
<?php 
mysqli_free_result($RecordCartListFreight);

mysqli_free_result($RecordCartOrder);

mysqli_free_result($RecordCartListPayment);

mysqli_free_result($RecordCartlist);
?>
