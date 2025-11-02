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

$collang_RecordActivitiesListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordActivitiesListItem = $_SESSION['lang'];
}
$coluserid_RecordActivitiesListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordActivitiesListItem = $w_userid;
}
$collistid_RecordActivitiesListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordActivitiesListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordActivitiesListItem = sprintf("SELECT demo_actitem.item_id, demo_actlist.list_id, demo_actlist.listname, demo_actitem.itemname, demo_actitem.lang FROM demo_actlist LEFT OUTER JOIN demo_actitem ON demo_actlist.list_id = demo_actitem.list_id WHERE demo_actlist.list_id = %s && demo_actitem.lang=%s && demo_actitem.userid=%s", GetSQLValueString($collistid_RecordActivitiesListItem, "int"),GetSQLValueString($collang_RecordActivitiesListItem, "text"),GetSQLValueString($coluserid_RecordActivitiesListItem, "int"));
$RecordActivitiesListItem = mysqli_query($DB_Conn, $query_RecordActivitiesListItem) or die(mysqli_error($DB_Conn));
$row_RecordActivitiesListItem = mysqli_fetch_assoc($RecordActivitiesListItem);
$totalRows_RecordActivitiesListItem = mysqli_num_rows($RecordActivitiesListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordActivitiesListItem['itemname']] = $row_RecordActivitiesListItem['itemname']; ?>
<?php } while ($row_RecordActivitiesListItem = mysqli_fetch_assoc($RecordActivitiesListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordActivitiesListItem);
?>
