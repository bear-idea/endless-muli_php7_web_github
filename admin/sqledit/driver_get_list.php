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

$collang_RecordDriverListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordDriverListItem = $_SESSION['lang'];
}
$coluserid_RecordDriverListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordDriverListItem = $w_userid;
}
$collistid_RecordDriverListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordDriverListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDriverListItem = sprintf("SELECT erp_driveritem.item_id, erp_driverlist.list_id, erp_driverlist.listname, erp_driveritem.itemname, erp_driveritem.lang FROM erp_driverlist LEFT OUTER JOIN erp_driveritem ON erp_driverlist.list_id = erp_driveritem.list_id WHERE erp_driverlist.list_id = %s && erp_driveritem.lang=%s && erp_driveritem.userid = %s", GetSQLValueString($collistid_RecordDriverListItem, "int"),GetSQLValueString($collang_RecordDriverListItem, "text"),GetSQLValueString($coluserid_RecordDriverListItem, "int"));
$RecordDriverListItem = mysqli_query($DB_Conn, $query_RecordDriverListItem) or die(mysqli_error($DB_Conn));
$row_RecordDriverListItem = mysqli_fetch_assoc($RecordDriverListItem);
$totalRows_RecordDriverListItem = mysqli_num_rows($RecordDriverListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordDriverListItem['itemname']] = $row_RecordDriverListItem['itemname']; ?>
<?php } while ($row_RecordDriverListItem = mysqli_fetch_assoc($RecordDriverListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordDriverListItem);
?>
