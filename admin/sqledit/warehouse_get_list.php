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

$collang_RecordWarehouseListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordWarehouseListItem = $_SESSION['lang'];
}
$coluserid_RecordWarehouseListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordWarehouseListItem = $w_userid;
}
$collistid_RecordWarehouseListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordWarehouseListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordWarehouseListItem = sprintf("SELECT erp_warehouseitem.item_id, erp_warehouselist.list_id, erp_warehouselist.listname, erp_warehouseitem.itemname, erp_warehouseitem.lang FROM erp_warehouselist LEFT OUTER JOIN erp_warehouseitem ON erp_warehouselist.list_id = erp_warehouseitem.list_id WHERE erp_warehouselist.list_id = %s && erp_warehouseitem.lang=%s && erp_warehouseitem.userid = %s", GetSQLValueString($collistid_RecordWarehouseListItem, "int"),GetSQLValueString($collang_RecordWarehouseListItem, "text"),GetSQLValueString($coluserid_RecordWarehouseListItem, "int"));
$RecordWarehouseListItem = mysqli_query($DB_Conn, $query_RecordWarehouseListItem) or die(mysqli_error($DB_Conn));
$row_RecordWarehouseListItem = mysqli_fetch_assoc($RecordWarehouseListItem);
$totalRows_RecordWarehouseListItem = mysqli_num_rows($RecordWarehouseListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordWarehouseListItem['itemname']] = $row_RecordWarehouseListItem['itemname']; ?>
<?php } while ($row_RecordWarehouseListItem = mysqli_fetch_assoc($RecordWarehouseListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordWarehouseListItem);
?>
