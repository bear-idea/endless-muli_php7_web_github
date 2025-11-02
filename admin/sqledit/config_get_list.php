<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php //無語系區分 ?>
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

$collistid_RecordConfigListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordConfigListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordConfigListItem = sprintf("SELECT demo_configitem.item_id, demo_configlist.list_id, demo_configlist.listname, demo_configitem.itemname, demo_configitem.lang, demo_configitem.itemvalue FROM demo_configlist LEFT OUTER JOIN demo_configitem ON demo_configlist.list_id = demo_configitem.list_id WHERE demo_configlist.list_id = %s", GetSQLValueString($collistid_RecordConfigListItem, "int"));
$RecordConfigListItem = mysqli_query($DB_Conn, $query_RecordConfigListItem) or die(mysqli_error($DB_Conn));
$row_RecordConfigListItem = mysqli_fetch_assoc($RecordConfigListItem);
$totalRows_RecordConfigListItem = mysqli_num_rows($RecordConfigListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordConfigListItem['itemvalue']] = $row_RecordConfigListItem['itemname']; ?>
<?php } while ($row_RecordConfigListItem = mysqli_fetch_assoc($RecordConfigListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordConfigListItem);
?>
