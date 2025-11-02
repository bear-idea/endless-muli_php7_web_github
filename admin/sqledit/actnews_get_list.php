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

$collang_RecordActnewsListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordActnewsListItem = $_SESSION['lang'];
}
$coluserid_RecordActnewsListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordActnewsListItem = $w_userid;
}
$collistid_RecordActnewsListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordActnewsListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordActnewsListItem = sprintf("SELECT demo_actnewsitem.item_id, demo_actnewslist.list_id, demo_actnewslist.listname, demo_actnewsitem.itemname, demo_actnewsitem.lang FROM demo_actnewslist LEFT OUTER JOIN demo_actnewsitem ON demo_actnewslist.list_id = demo_actnewsitem.list_id WHERE demo_actnewslist.list_id = %s && demo_actnewsitem.lang=%s && demo_actnewsitem.userid=%s", GetSQLValueString($collistid_RecordActnewsListItem, "int"),GetSQLValueString($collang_RecordActnewsListItem, "text"),GetSQLValueString($coluserid_RecordActnewsListItem, "int"));
$RecordActnewsListItem = mysqli_query($DB_Conn, $query_RecordActnewsListItem) or die(mysqli_error($DB_Conn));
$row_RecordActnewsListItem = mysqli_fetch_assoc($RecordActnewsListItem);
$totalRows_RecordActnewsListItem = mysqli_num_rows($RecordActnewsListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordActnewsListItem['itemname']] = $row_RecordActnewsListItem['itemname']; ?>
<?php } while ($row_RecordActnewsListItem = mysqli_fetch_assoc($RecordActnewsListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordActnewsListItem);
?>
