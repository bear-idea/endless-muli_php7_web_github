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

$collang_RecordTimelineListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordTimelineListItem = $_SESSION['lang'];
}
$coluserid_RecordTimelineListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTimelineListItem = $w_userid;
}
$collistid_RecordTimelineListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordTimelineListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTimelineListItem = sprintf("SELECT demo_timelineitem.item_id, demo_timelinelist.list_id, demo_timelinelist.listname, demo_timelineitem.itemname, demo_timelineitem.lang FROM demo_timelinelist LEFT OUTER JOIN demo_timelineitem ON demo_timelinelist.list_id = demo_timelineitem.list_id WHERE demo_timelinelist.list_id = %s && demo_timelineitem.lang=%s && demo_timelineitem.userid=%s", GetSQLValueString($collistid_RecordTimelineListItem, "int"),GetSQLValueString($collang_RecordTimelineListItem, "text"),GetSQLValueString($coluserid_RecordTimelineListItem, "int"));
$RecordTimelineListItem = mysqli_query($DB_Conn, $query_RecordTimelineListItem) or die(mysqli_error($DB_Conn));
$row_RecordTimelineListItem = mysqli_fetch_assoc($RecordTimelineListItem);
$totalRows_RecordTimelineListItem = mysqli_num_rows($RecordTimelineListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordTimelineListItem['itemname']] = $row_RecordTimelineListItem['itemname']; ?>
<?php } while ($row_RecordTimelineListItem = mysqli_fetch_assoc($RecordTimelineListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordTimelineListItem);
?>
