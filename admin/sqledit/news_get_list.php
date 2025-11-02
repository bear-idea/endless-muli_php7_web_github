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

$collang_RecordNewsListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordNewsListItem = $_SESSION['lang'];
}
$coluserid_RecordNewsListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordNewsListItem = $w_userid;
}
$collistid_RecordNewsListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordNewsListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNewsListItem = sprintf("SELECT demo_newsitem.item_id, demo_newslist.list_id, demo_newslist.listname, demo_newsitem.itemname, demo_newsitem.lang FROM demo_newslist LEFT OUTER JOIN demo_newsitem ON demo_newslist.list_id = demo_newsitem.list_id WHERE demo_newslist.list_id = %s && demo_newsitem.lang=%s && demo_newsitem.userid = %s", GetSQLValueString($collistid_RecordNewsListItem, "int"),GetSQLValueString($collang_RecordNewsListItem, "text"),GetSQLValueString($coluserid_RecordNewsListItem, "int"));
$RecordNewsListItem = mysqli_query($DB_Conn, $query_RecordNewsListItem) or die(mysqli_error($DB_Conn));
$row_RecordNewsListItem = mysqli_fetch_assoc($RecordNewsListItem);
$totalRows_RecordNewsListItem = mysqli_num_rows($RecordNewsListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordNewsListItem['itemname']] = $row_RecordNewsListItem['itemname']; ?>
<?php } while ($row_RecordNewsListItem = mysqli_fetch_assoc($RecordNewsListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordNewsListItem);
?>
