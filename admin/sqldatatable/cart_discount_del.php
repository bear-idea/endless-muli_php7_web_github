<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once("../../inc/inc_function.php"); ?>
<?php //include('mysqli_to_json.class.php'); ?>
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

// 商品庫存修改 ------------------------------------------------------------------------
if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "")) {
	
	  // 取得此分類所有商品
	  $colname_RecordProduct = "-1";
	  if (isset($_GET['id_del'])) {
		$colname_RecordProduct = $_GET['id_del'];
	  }
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $query_RecordProduct = sprintf("SELECT * FROM demo_product WHERE discountid = %s", GetSQLValueString($colname_RecordProduct, "int"));
	  $RecordProduct = mysqli_query($DB_Conn, $query_RecordProduct) or die(mysqli_error($DB_Conn));
	  $row_RecordProduct = mysqli_fetch_assoc($RecordProduct);
	  $totalRows_RecordProduct = mysqli_num_rows($RecordProduct);
	  if($totalRows_RecordProduct > 0) {
	  do { 
		 $updateSQL = sprintf("UPDATE demo_product SET discounttype=%s, discountid=%s WHERE id =%s",
						   GetSQLValueString("", "int"),
						   GetSQLValueString("", "int"),
						   GetSQLValueString($row_RecordProduct['id'], "int"));
		 $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  	  } while ($row_RecordProduct = mysqli_fetch_assoc($RecordProduct));
	  }
}
// 商品庫存修改 ------------------------------------------------------------------------

if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_productdiscount WHERE id=%s",
                       GetSQLValueString($_GET['id_del'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
?>