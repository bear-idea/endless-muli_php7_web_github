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

$collang_RecordScaleListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordScaleListItem = $_SESSION['lang'];
}
$coluserid_RecordScaleListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScaleListItem = $w_userid;
}
$collistid_RecordScaleListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordScaleListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScaleListItem = sprintf("SELECT erp_scaleitem.item_id, erp_scalelist.list_id, erp_scalelist.listname, erp_scaleitem.itemname, erp_scaleitem.lang FROM erp_scalelist LEFT OUTER JOIN erp_scaleitem ON erp_scalelist.list_id = erp_scaleitem.list_id WHERE erp_scalelist.list_id = %s && erp_scaleitem.lang=%s  && erp_scaleitem.userid=%s ORDER BY erp_scaleitem. sortid ASC", GetSQLValueString($collistid_RecordScaleListItem, "int"),GetSQLValueString($collang_RecordScaleListItem, "text"),GetSQLValueString($coluserid_RecordScaleListItem, "int"));
$RecordScaleListItem = mysqli_query($DB_Conn, $query_RecordScaleListItem) or die(mysqli_error($DB_Conn));
$row_RecordScaleListItem = mysqli_fetch_assoc($RecordScaleListItem);
$totalRows_RecordScaleListItem = mysqli_num_rows($RecordScaleListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordScaleListItem['itemname']] = $row_RecordScaleListItem['itemname']; ?>
<?php } while ($row_RecordScaleListItem = mysqli_fetch_assoc($RecordScaleListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordScaleListItem);
?>
