<?php require_once('../Connections/DB_Conn.php'); ?>
<?php
	if (!isset($_SESSION)) {
  		session_start();
	}
?>
<?php $Lang_GeneralPath = '../lang/' . $_SESSION['lang'] . '/lang_cart.php'; // 通用語系檔 ?>
<?php require_once($Lang_GeneralPath); /* 通用語系檔連結 */ ?>
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

$colname_RecordProduct = "-1";
if (isset($_GET['id'])) {
  $colname_RecordProduct = $_GET['id'];
}
$coluserid_RecordProduct = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordProduct = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProduct = sprintf("SELECT * FROM demo_product WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordProduct, "int"),GetSQLValueString($coluserid_RecordProduct, "int"));
$RecordProduct = mysqli_query($DB_Conn, $query_RecordProduct) or die(mysqli_error($DB_Conn));
$row_RecordProduct = mysqli_fetch_assoc($RecordProduct);
$totalRows_RecordProduct = mysqli_num_rows($RecordProduct);

$colname_RecordProductFormat = "-1";
if (isset($_GET['id'])) {
  $colname_RecordProductFormat = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductFormat = sprintf("SELECT * FROM demo_productformat WHERE aid = %s ORDER BY sortid ASC, pid DESC", GetSQLValueString($colname_RecordProductFormat, "text"));
$RecordProductFormat = mysqli_query($DB_Conn, $query_RecordProductFormat) or die(mysqli_error($DB_Conn));
$row_RecordProductFormat = mysqli_fetch_assoc($RecordProductFormat);
$totalRows_RecordProductFormat = mysqli_num_rows($RecordProductFormat);
?>
<?php
// 自動停賣 $row_RecordProduct['inventorynotsale']
if($row_RecordProduct['inventorynotsale'] == "1" && $row_RecordProduct['inventory'] <= 0) {
	echo $Lang_Classify_Product_Sold_Out; // 該商品已售完
}else if($row_RecordProduct['inventorynotsale'] == "1" && ($row_RecordProduct['inventory']-$_GET['qu'])<=0){
	// 購買數量不可高於庫存量
	echo $Lang_Classify_Product_Insufficient_Number_Of; 
	/*echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip(\"".$Lang_Classify_Product_Insufficient_Number_Of."\", 'warning');});</script>";*/
}else{
}

//echo $row_RecordProduct['inventory']-$_GET['qu'];

?>
<?php
mysqli_free_result($RecordProduct);

mysqli_free_result($RecordProductFormat);
?>
