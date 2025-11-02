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

$collang_RecordMeetingListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordMeetingListItem = $_SESSION['lang'];
}
$coluserid_RecordMeetingListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordMeetingListItem = $w_userid;
}
$collistid_RecordMeetingListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordMeetingListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordMeetingListItem = sprintf("SELECT demo_meetingitem.item_id, demo_meetinglist.list_id, demo_meetinglist.listname, demo_meetingitem.itemname, demo_meetingitem.lang FROM demo_meetinglist LEFT OUTER JOIN demo_meetingitem ON demo_meetinglist.list_id = demo_meetingitem.list_id WHERE demo_meetinglist.list_id = %s && demo_meetingitem.lang=%s && demo_meetingitem.userid=%s", GetSQLValueString($collistid_RecordMeetingListItem, "int"),GetSQLValueString($collang_RecordMeetingListItem, "text"),GetSQLValueString($coluserid_RecordMeetingListItem, "int"));
$RecordMeetingListItem = mysqli_query($DB_Conn, $query_RecordMeetingListItem) or die(mysqli_error($DB_Conn));
$row_RecordMeetingListItem = mysqli_fetch_assoc($RecordMeetingListItem);
$totalRows_RecordMeetingListItem = mysqli_num_rows($RecordMeetingListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordMeetingListItem['itemname']] = $row_RecordMeetingListItem['itemname']; ?>
<?php } while ($row_RecordMeetingListItem = mysqli_fetch_assoc($RecordMeetingListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordMeetingListItem);
?>
