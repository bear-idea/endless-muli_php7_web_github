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

$collang_RecordWebSiteListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordWebSiteListItem = $_SESSION['lang'];
}
$collistid_RecordWebSiteListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordWebSiteListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordWebSiteListItem = sprintf("SELECT demo_websiteitem.item_id, demo_websitelist.list_id, demo_websitelist.listname, demo_websiteitem.itemname, demo_websiteitem.lang FROM demo_websitelist LEFT OUTER JOIN demo_websiteitem ON demo_websitelist.list_id = demo_websiteitem.list_id WHERE demo_websitelist.list_id = %s && demo_websiteitem.lang=%s", GetSQLValueString($collistid_RecordWebSiteListItem, "int"),GetSQLValueString($collang_RecordWebSiteListItem, "text"));
$RecordWebSiteListItem = mysqli_query($DB_Conn, $query_RecordWebSiteListItem) or die(mysqli_error($DB_Conn));
$row_RecordWebSiteListItem = mysqli_fetch_assoc($RecordWebSiteListItem);
$totalRows_RecordWebSiteListItem = mysqli_num_rows($RecordWebSiteListItem);
?>
<?php $data['-1'] = '未知'; ?>
<?php do { ?>
  <?php $data[$row_RecordWebSiteListItem['itemname']] = $row_RecordWebSiteListItem['itemname']; ?>
<?php } while ($row_RecordWebSiteListItem = mysqli_fetch_assoc($RecordWebSiteListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordWebSiteListItem);
?>
