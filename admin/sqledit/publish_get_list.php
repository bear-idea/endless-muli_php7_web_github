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

$collang_RecordPublishListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordPublishListItem = $_SESSION['lang'];
}
$coluserid_RecordPublishListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordPublishListItem = $w_userid;
}
$collistid_RecordPublishListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordPublishListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPublishListItem = sprintf("SELECT demo_publishitem.item_id, demo_publishlist.list_id, demo_publishlist.listname, demo_publishitem.itemname, demo_publishitem.lang FROM demo_publishlist LEFT OUTER JOIN demo_publishitem ON demo_publishlist.list_id = demo_publishitem.list_id WHERE demo_publishlist.list_id = %s && demo_publishitem.lang=%s && demo_publishitem.userid = %s", GetSQLValueString($collistid_RecordPublishListItem, "int"),GetSQLValueString($collang_RecordPublishListItem, "text"),GetSQLValueString($coluserid_RecordPublishListItem, "int"));
$RecordPublishListItem = mysqli_query($DB_Conn, $query_RecordPublishListItem) or die(mysqli_error($DB_Conn));
$row_RecordPublishListItem = mysqli_fetch_assoc($RecordPublishListItem);
$totalRows_RecordPublishListItem = mysqli_num_rows($RecordPublishListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordPublishListItem['itemname']] = $row_RecordPublishListItem['itemname']; ?>
<?php } while ($row_RecordPublishListItem = mysqli_fetch_assoc($RecordPublishListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordPublishListItem);
?>
