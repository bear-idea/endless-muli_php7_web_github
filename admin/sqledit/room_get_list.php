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

$collang_RecordRoomListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordRoomListItem = $_SESSION['lang'];
}
$coluserid_RecordRoomListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordRoomListItem = $w_userid;
}
$collistid_RecordRoomListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordRoomListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordRoomListItem = sprintf("SELECT demo_roomitem.item_id, demo_roomlist.list_id, demo_roomlist.listname, demo_roomitem.itemname, demo_roomitem.lang FROM demo_roomlist LEFT OUTER JOIN demo_roomitem ON demo_roomlist.list_id = demo_roomitem.list_id WHERE demo_roomlist.list_id = %s && demo_roomitem.lang=%s  && demo_roomitem.userid=%s ORDER BY demo_roomitem. sortid ASC", GetSQLValueString($collistid_RecordRoomListItem, "int"),GetSQLValueString($collang_RecordRoomListItem, "text"),GetSQLValueString($coluserid_RecordRoomListItem, "int"));
$RecordRoomListItem = mysqli_query($DB_Conn, $query_RecordRoomListItem) or die(mysqli_error($DB_Conn));
$row_RecordRoomListItem = mysqli_fetch_assoc($RecordRoomListItem);
$totalRows_RecordRoomListItem = mysqli_num_rows($RecordRoomListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordRoomListItem['itemname']] = $row_RecordRoomListItem['itemname']; ?>
<?php } while ($row_RecordRoomListItem = mysqli_fetch_assoc($RecordRoomListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordRoomListItem);
?>
