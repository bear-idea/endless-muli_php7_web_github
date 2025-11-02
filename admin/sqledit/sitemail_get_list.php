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

$collang_RecordSitemailListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordSitemailListItem = $_SESSION['lang'];
}
$coluserid_RecordSitemailListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSitemailListItem = $w_userid;
}
$collistid_RecordSitemailListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordSitemailListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSitemailListItem = sprintf("SELECT demo_sitemailitem.item_id, demo_sitemaillist.list_id, demo_sitemaillist.listname, demo_sitemailitem.itemname, demo_sitemailitem.lang FROM demo_sitemaillist LEFT OUTER JOIN demo_sitemailitem ON demo_sitemaillist.list_id = demo_sitemailitem.list_id WHERE demo_sitemaillist.list_id = %s && demo_sitemailitem.lang=%s && demo_sitemailitem.userid=%s", GetSQLValueString($collistid_RecordSitemailListItem, "int"),GetSQLValueString($collang_RecordSitemailListItem, "text"),GetSQLValueString($coluserid_RecordSitemailListItem, "int"));
$RecordSitemailListItem = mysqli_query($DB_Conn, $query_RecordSitemailListItem) or die(mysqli_error($DB_Conn));
$row_RecordSitemailListItem = mysqli_fetch_assoc($RecordSitemailListItem);
$totalRows_RecordSitemailListItem = mysqli_num_rows($RecordSitemailListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordSitemailListItem['itemname']] = $row_RecordSitemailListItem['itemname']; ?>
<?php } while ($row_RecordSitemailListItem = mysqli_fetch_assoc($RecordSitemailListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordSitemailListItem);
?>
