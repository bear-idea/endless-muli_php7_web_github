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

$collang_RecordDfPageListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordDfPageListItem = $_SESSION['lang'];
}
$coluserid_RecordDfPageListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordDfPageListItem = $w_userid;
}
$collistid_RecordDfPageListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordDfPageListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDfPageListItem = sprintf("SELECT demo_dfpageitem.item_id, demo_dfpagelist.list_id, demo_dfpagelist.listname, demo_dfpageitem.itemname, demo_dfpageitem.lang FROM demo_dfpagelist LEFT OUTER JOIN demo_dfpageitem ON demo_dfpagelist.list_id = demo_dfpageitem.list_id WHERE demo_dfpagelist.list_id = %s && demo_dfpageitem.lang=%s && demo_dfpageitem.userid=%s", GetSQLValueString($collistid_RecordDfPageListItem, "int"),GetSQLValueString($collang_RecordDfPageListItem, "text"),GetSQLValueString($coluserid_RecordDfPageListItem, "int"));
$RecordDfPageListItem = mysqli_query($DB_Conn, $query_RecordDfPageListItem) or die(mysqli_error($DB_Conn));
$row_RecordDfPageListItem = mysqli_fetch_assoc($RecordDfPageListItem);
$totalRows_RecordDfPageListItem = mysqli_num_rows($RecordDfPageListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordDfPageListItem['item_id']] = $row_RecordDfPageListItem['itemname']; ?>
<?php } while ($row_RecordDfPageListItem = mysqli_fetch_assoc($RecordDfPageListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordDfPageListItem);
?>
