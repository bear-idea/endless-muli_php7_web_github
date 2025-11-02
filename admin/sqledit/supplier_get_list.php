<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
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

$collang_RecordSupplierListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordSupplierListItem = $_SESSION['lang'];
}
$coluserid_RecordSupplierListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSupplierListItem = $w_userid;
}
$collistid_RecordSupplierListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordSupplierListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSupplierListItem = sprintf("SELECT invoicing_supplieritem.item_id, invoicing_supplierlist.list_id, invoicing_supplierlist.listname, invoicing_supplieritem.itemname, invoicing_supplieritem.lang FROM invoicing_supplierlist LEFT OUTER JOIN invoicing_supplieritem ON invoicing_supplierlist.list_id = invoicing_supplieritem.list_id WHERE invoicing_supplierlist.list_id = %s && invoicing_supplieritem.lang=%s && invoicing_supplieritem.userid = %s", GetSQLValueString($collistid_RecordSupplierListItem, "int"),GetSQLValueString($collang_RecordSupplierListItem, "text"),GetSQLValueString($coluserid_RecordSupplierListItem, "int"));
$RecordSupplierListItem = mysqli_query($DB_Conn, $query_RecordSupplierListItem) or die(mysqli_error($DB_Conn));
$row_RecordSupplierListItem = mysqli_fetch_assoc($RecordSupplierListItem);
$totalRows_RecordSupplierListItem = mysqli_num_rows($RecordSupplierListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordSupplierListItem['itemname']] = $row_RecordSupplierListItem['itemname']; ?>
<?php } while ($row_RecordSupplierListItem = mysqli_fetch_assoc($RecordSupplierListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordSupplierListItem);
?>
