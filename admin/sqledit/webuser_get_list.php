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

$collang_RecordWebuserListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordWebuserListItem = $_SESSION['lang'];
}
$collistid_RecordWebuserListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordWebuserListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordWebuserListItem = sprintf("SELECT demo_adminitem.item_id, demo_adminlist.list_id, demo_adminlist.listname, demo_adminitem.itemname, demo_adminitem.lang FROM demo_adminlist LEFT OUTER JOIN demo_adminitem ON demo_adminlist.list_id = demo_adminitem.list_id WHERE demo_adminlist.list_id = %s && demo_adminitem.lang=%s", GetSQLValueString($collistid_RecordWebuserListItem, "int"),GetSQLValueString($collang_RecordWebuserListItem, "text"));
$RecordWebuserListItem = mysqli_query($DB_Conn, $query_RecordWebuserListItem) or die(mysqli_error($DB_Conn));
$row_RecordWebuserListItem = mysqli_fetch_assoc($RecordWebuserListItem);
$totalRows_RecordWebuserListItem = mysqli_num_rows($RecordWebuserListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordWebuserListItem['itemname']] = $row_RecordWebuserListItem['itemname']; ?>
<?php } while ($row_RecordWebuserListItem = mysqli_fetch_assoc($RecordWebuserListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordWebuserListItem);
?>
