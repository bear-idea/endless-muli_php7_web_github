<?php require_once('../../Connections/DB_Conn.php'); ?>
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

$colitem_id_RecordRoomListItem = "-1";
if (isset($_GET['id'])) {
  $colitem_id_RecordRoomListItem = $_GET['id'];
}
$collevel_RecordRoomListItem = "-1";
if (isset($_GET['lv'])) {
  $collevel_RecordRoomListItem = $_GET['lv'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordRoomListItem = sprintf("SELECT item_id, itemname FROM demo_roomitem WHERE subitem_id = %s && level = %s", GetSQLValueString($colitem_id_RecordRoomListItem, "int"),GetSQLValueString($collevel_RecordRoomListItem, "int"));
$RecordRoomListItem = mysqli_query($DB_Conn, $query_RecordRoomListItem) or die(mysqli_error($DB_Conn));
$row_RecordRoomListItem = mysqli_fetch_assoc($RecordRoomListItem);
$totalRows_RecordRoomListItem = mysqli_num_rows($RecordRoomListItem);
?>

<?php if($row_RecordRoomListItem['itemname'] != ''){ ?>
<?php do { ?>
    <?php $data[$row_RecordRoomListItem['item_id']] = $row_RecordRoomListItem['itemname']; ?>
<?php } while ($row_RecordRoomListItem = mysqli_fetch_assoc($RecordRoomListItem)); ?>
<?php } else { ?>
	<?php $data[$row_RecordRoomListItem['item_id']] = '-1'; ?>
<?php } ?>

<?php 
	echo json_encode($data);
?>

<?php
mysqli_free_result($RecordRoomListItem);
?>
