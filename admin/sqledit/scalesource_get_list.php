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

$collang_RecordScalesourceListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordScalesourceListItem = $_SESSION['lang'];
}
$coluserid_RecordScalesourceListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordScalesourceListItem = $w_userid;
}
$collistid_RecordScalesourceListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordScalesourceListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScalesourceListItem = sprintf("SELECT erp_scalesourceitem.item_id, erp_scalesourcelist.list_id, erp_scalesourcelist.listname, erp_scalesourceitem.itemname, erp_scalesourceitem.lang FROM erp_scalesourcelist LEFT OUTER JOIN erp_scalesourceitem ON erp_scalesourcelist.list_id = erp_scalesourceitem.list_id WHERE erp_scalesourcelist.list_id = %s && erp_scalesourceitem.lang=%s  && erp_scalesourceitem.userid=%s ORDER BY erp_scalesourceitem. sortid ASC", GetSQLValueString($collistid_RecordScalesourceListItem, "int"),GetSQLValueString($collang_RecordScalesourceListItem, "text"),GetSQLValueString($coluserid_RecordScalesourceListItem, "int"));
$RecordScalesourceListItem = mysqli_query($DB_Conn, $query_RecordScalesourceListItem) or die(mysqli_error($DB_Conn));
$row_RecordScalesourceListItem = mysqli_fetch_assoc($RecordScalesourceListItem);
$totalRows_RecordScalesourceListItem = mysqli_num_rows($RecordScalesourceListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordScalesourceListItem['itemname']] = $row_RecordScalesourceListItem['itemname']; ?>
<?php } while ($row_RecordScalesourceListItem = mysqli_fetch_assoc($RecordScalesourceListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordScalesourceListItem);
?>
