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

$collang_RecordVideoListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordVideoListItem = $_SESSION['lang'];
}
$coluserid_RecordVideoListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordVideoListItem = $w_userid;
}
$collistid_RecordVideoListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordVideoListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordVideoListItem = sprintf("SELECT demo_videoitem.item_id, demo_videolist.list_id, demo_videolist.listname, demo_videoitem.itemname, demo_videoitem.lang FROM demo_videolist LEFT OUTER JOIN demo_videoitem ON demo_videolist.list_id = demo_videoitem.list_id WHERE demo_videolist.list_id = %s && demo_videoitem.lang=%s && demo_videoitem.userid = %s", GetSQLValueString($collistid_RecordVideoListItem, "int"),GetSQLValueString($collang_RecordVideoListItem, "text"),GetSQLValueString($coluserid_RecordVideoListItem, "int"));
$RecordVideoListItem = mysqli_query($DB_Conn, $query_RecordVideoListItem) or die(mysqli_error($DB_Conn));
$row_RecordVideoListItem = mysqli_fetch_assoc($RecordVideoListItem);
$totalRows_RecordVideoListItem = mysqli_num_rows($RecordVideoListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordVideoListItem['itemname']] = $row_RecordVideoListItem['itemname']; ?>
<?php } while ($row_RecordVideoListItem = mysqli_fetch_assoc($RecordVideoListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordVideoListItem);
?>
