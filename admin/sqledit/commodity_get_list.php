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

$collang_RecordCommodityListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordCommodityListItem = $_SESSION['lang'];
}
$coluserid_RecordCommodityListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCommodityListItem = $w_userid;
}
$collistid_RecordCommodityListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordCommodityListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCommodityListItem = sprintf("SELECT invoicing_commodityitem.item_id, invoicing_commoditylist.list_id, invoicing_commoditylist.listname, invoicing_commodityitem.itemname, invoicing_commodityitem.lang FROM invoicing_commoditylist LEFT OUTER JOIN invoicing_commodityitem ON invoicing_commoditylist.list_id = invoicing_commodityitem.list_id WHERE invoicing_commoditylist.list_id = %s && invoicing_commodityitem.lang=%s  && invoicing_commodityitem.userid=%s ORDER BY invoicing_commodityitem. sortid ASC", GetSQLValueString($collistid_RecordCommodityListItem, "int"),GetSQLValueString($collang_RecordCommodityListItem, "text"),GetSQLValueString($coluserid_RecordCommodityListItem, "int"));
$RecordCommodityListItem = mysqli_query($DB_Conn, $query_RecordCommodityListItem) or die(mysqli_error($DB_Conn));
$row_RecordCommodityListItem = mysqli_fetch_assoc($RecordCommodityListItem);
$totalRows_RecordCommodityListItem = mysqli_num_rows($RecordCommodityListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordCommodityListItem['itemname']] = $row_RecordCommodityListItem['itemname']; ?>
<?php } while ($row_RecordCommodityListItem = mysqli_fetch_assoc($RecordCommodityListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordCommodityListItem);
?>
