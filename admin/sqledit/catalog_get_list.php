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

$collang_RecordCatalogListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordCatalogListItem = $_SESSION['lang'];
}
$coluserid_RecordCatalogListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCatalogListItem = $w_userid;
}
$collistid_RecordCatalogListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordCatalogListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCatalogListItem = sprintf("SELECT demo_catalogitem.item_id, demo_cataloglist.list_id, demo_cataloglist.listname, demo_catalogitem.itemname, demo_catalogitem.lang FROM demo_cataloglist LEFT OUTER JOIN demo_catalogitem ON demo_cataloglist.list_id = demo_catalogitem.list_id WHERE demo_cataloglist.list_id = %s && demo_catalogitem.lang=%s && demo_catalogitem.userid=%s", GetSQLValueString($collistid_RecordCatalogListItem, "int"),GetSQLValueString($collang_RecordCatalogListItem, "text"),GetSQLValueString($coluserid_RecordCatalogListItem, "int"));
$RecordCatalogListItem = mysqli_query($DB_Conn, $query_RecordCatalogListItem) or die(mysqli_error($DB_Conn));
$row_RecordCatalogListItem = mysqli_fetch_assoc($RecordCatalogListItem);
$totalRows_RecordCatalogListItem = mysqli_num_rows($RecordCatalogListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordCatalogListItem['itemname']] = $row_RecordCatalogListItem['itemname']; ?>
<?php } while ($row_RecordCatalogListItem = mysqli_fetch_assoc($RecordCatalogListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordCatalogListItem);
?>
