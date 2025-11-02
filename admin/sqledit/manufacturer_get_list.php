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

$collang_RecordManufacturerListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordManufacturerListItem = $_SESSION['lang'];
}
$coluserid_RecordManufacturerListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordManufacturerListItem = $w_userid;
}
$collistid_RecordManufacturerListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordManufacturerListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordManufacturerListItem = sprintf("SELECT erp_manufactureritem.item_id, erp_manufacturerlist.list_id, erp_manufacturerlist.listname, erp_manufactureritem.itemname, erp_manufactureritem.lang FROM erp_manufacturerlist LEFT OUTER JOIN erp_manufactureritem ON erp_manufacturerlist.list_id = erp_manufactureritem.list_id WHERE erp_manufacturerlist.list_id = %s && erp_manufactureritem.lang=%s && erp_manufactureritem.userid = %s", GetSQLValueString($collistid_RecordManufacturerListItem, "int"),GetSQLValueString($collang_RecordManufacturerListItem, "text"),GetSQLValueString($coluserid_RecordManufacturerListItem, "int"));
$RecordManufacturerListItem = mysqli_query($DB_Conn, $query_RecordManufacturerListItem) or die(mysqli_error($DB_Conn));
$row_RecordManufacturerListItem = mysqli_fetch_assoc($RecordManufacturerListItem);
$totalRows_RecordManufacturerListItem = mysqli_num_rows($RecordManufacturerListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordManufacturerListItem['itemname']] = $row_RecordManufacturerListItem['itemname']; ?>
<?php } while ($row_RecordManufacturerListItem = mysqli_fetch_assoc($RecordManufacturerListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordManufacturerListItem);
?>
