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

$collang_RecordServiceListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordServiceListItem = $_SESSION['lang'];
}
$coluserid_RecordServiceListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordServiceListItem = $w_userid;
}
$collistid_RecordServiceListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordServiceListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordServiceListItem = sprintf("SELECT demo_serviceitem.item_id, demo_servicelist.list_id, demo_servicelist.listname, demo_serviceitem.itemname, demo_serviceitem.lang FROM demo_servicelist LEFT OUTER JOIN demo_serviceitem ON demo_servicelist.list_id = demo_serviceitem.list_id WHERE demo_servicelist.list_id = %s && demo_serviceitem.lang=%s && demo_serviceitem.userid=%s", GetSQLValueString($collistid_RecordServiceListItem, "int"),GetSQLValueString($collang_RecordServiceListItem, "text"),GetSQLValueString($coluserid_RecordServiceListItem, "int"));
$RecordServiceListItem = mysqli_query($DB_Conn, $query_RecordServiceListItem) or die(mysqli_error($DB_Conn));
$row_RecordServiceListItem = mysqli_fetch_assoc($RecordServiceListItem);
$totalRows_RecordServiceListItem = mysqli_num_rows($RecordServiceListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordServiceListItem['itemname']] = $row_RecordServiceListItem['itemname']; ?>
<?php } while ($row_RecordServiceListItem = mysqli_fetch_assoc($RecordServiceListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordServiceListItem);
?>
