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

$collang_RecordAdsListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordAdsListItem = $_SESSION['lang'];
}
$collistid_RecordAdsListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordAdsListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAdsListItem = sprintf("SELECT demo_adtypeitem.item_id, demo_adtypelist.list_id, demo_adtypelist.listname, demo_adtypeitem.itemname, demo_adtypeitem.lang FROM demo_adtypelist LEFT OUTER JOIN demo_adtypeitem ON demo_adtypelist.list_id = demo_adtypeitem.list_id WHERE demo_adtypelist.list_id = %s", GetSQLValueString($collistid_RecordAdsListItem, "int"));
$RecordAdsListItem = mysqli_query($DB_Conn, $query_RecordAdsListItem) or die(mysqli_error($DB_Conn));
$row_RecordAdsListItem = mysqli_fetch_assoc($RecordAdsListItem);
$totalRows_RecordAdsListItem = mysqli_num_rows($RecordAdsListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordAdsListItem['itemname']] = $row_RecordAdsListItem['itemname']; ?>
<?php } while ($row_RecordAdsListItem = mysqli_fetch_assoc($RecordAdsListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordAdsListItem);
?>
