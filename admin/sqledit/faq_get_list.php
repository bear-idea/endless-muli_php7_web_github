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

$collang_RecordFaqListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordFaqListItem = $_SESSION['lang'];
}
$coluserid_RecordFaqListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordFaqListItem = $w_userid;
}
$collistid_RecordFaqListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordFaqListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordFaqListItem = sprintf("SELECT demo_faqitem.item_id, demo_faqlist.list_id, demo_faqlist.listname, demo_faqitem.itemname, demo_faqitem.lang FROM demo_faqlist LEFT OUTER JOIN demo_faqitem ON demo_faqlist.list_id = demo_faqitem.list_id WHERE demo_faqlist.list_id = %s && demo_faqitem.lang=%s && demo_faqitem.userid = %s", GetSQLValueString($collistid_RecordFaqListItem, "int"),GetSQLValueString($collang_RecordFaqListItem, "text"),GetSQLValueString($coluserid_RecordFaqListItem, "int"));
$RecordFaqListItem = mysqli_query($DB_Conn, $query_RecordFaqListItem) or die(mysqli_error($DB_Conn));
$row_RecordFaqListItem = mysqli_fetch_assoc($RecordFaqListItem);
$totalRows_RecordFaqListItem = mysqli_num_rows($RecordFaqListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordFaqListItem['itemname']] = $row_RecordFaqListItem['itemname']; ?>
<?php } while ($row_RecordFaqListItem = mysqli_fetch_assoc($RecordFaqListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordFaqListItem);
?>
