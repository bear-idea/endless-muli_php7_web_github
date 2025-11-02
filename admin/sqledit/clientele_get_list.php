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

$collang_RecordClienteleListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordClienteleListItem = $_SESSION['lang'];
}
$coluserid_RecordClienteleListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordClienteleListItem = $w_userid;
}
$collistid_RecordClienteleListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordClienteleListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordClienteleListItem = sprintf("SELECT invoicing_clienteleitem.item_id, invoicing_clientelelist.list_id, invoicing_clientelelist.listname, invoicing_clienteleitem.itemname, invoicing_clienteleitem.lang FROM invoicing_clientelelist LEFT OUTER JOIN invoicing_clienteleitem ON invoicing_clientelelist.list_id = invoicing_clienteleitem.list_id WHERE invoicing_clientelelist.list_id = %s && invoicing_clienteleitem.lang=%s && invoicing_clienteleitem.userid = %s", GetSQLValueString($collistid_RecordClienteleListItem, "int"),GetSQLValueString($collang_RecordClienteleListItem, "text"),GetSQLValueString($coluserid_RecordClienteleListItem, "int"));
$RecordClienteleListItem = mysqli_query($DB_Conn, $query_RecordClienteleListItem) or die(mysqli_error($DB_Conn));
$row_RecordClienteleListItem = mysqli_fetch_assoc($RecordClienteleListItem);
$totalRows_RecordClienteleListItem = mysqli_num_rows($RecordClienteleListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordClienteleListItem['itemname']] = $row_RecordClienteleListItem['itemname']; ?>
<?php } while ($row_RecordClienteleListItem = mysqli_fetch_assoc($RecordClienteleListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordClienteleListItem);
?>
