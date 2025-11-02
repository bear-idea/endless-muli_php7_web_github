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

$collang_RecordTravelListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordTravelListItem = $_SESSION['lang'];
}
$coluserid_RecordTravelListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTravelListItem = $w_userid;
}
$collistid_RecordTravelListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordTravelListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTravelListItem = sprintf("SELECT demo_travelitem.item_id, demo_travellist.list_id, demo_travellist.listname, demo_travelitem.itemname, demo_travelitem.lang FROM demo_travellist LEFT OUTER JOIN demo_travelitem ON demo_travellist.list_id = demo_travelitem.list_id WHERE demo_travellist.list_id = %s && demo_travelitem.lang=%s && demo_travelitem.userid=%s", GetSQLValueString($collistid_RecordTravelListItem, "int"),GetSQLValueString($collang_RecordTravelListItem, "text"),GetSQLValueString($coluserid_RecordTravelListItem, "int"));
$RecordTravelListItem = mysqli_query($DB_Conn, $query_RecordTravelListItem) or die(mysqli_error($DB_Conn));
$row_RecordTravelListItem = mysqli_fetch_assoc($RecordTravelListItem);
$totalRows_RecordTravelListItem = mysqli_num_rows($RecordTravelListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordTravelListItem['itemname']] = $row_RecordTravelListItem['itemname']; ?>
<?php } while ($row_RecordTravelListItem = mysqli_fetch_assoc($RecordTravelListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordTravelListItem);
?>
