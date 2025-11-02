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

$collang_RecordPartnerListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordPartnerListItem = $_SESSION['lang'];
}
$coluserid_RecordPartnerListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordPartnerListItem = $w_userid;
}
$collistid_RecordPartnerListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordPartnerListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPartnerListItem = sprintf("SELECT demo_partneritem.item_id, demo_partnerlist.list_id, demo_partnerlist.listname, demo_partneritem.itemname, demo_partneritem.lang FROM demo_partnerlist LEFT OUTER JOIN demo_partneritem ON demo_partnerlist.list_id = demo_partneritem.list_id WHERE demo_partnerlist.list_id = %s && demo_partneritem.lang=%s && demo_partneritem.userid=%s", GetSQLValueString($collistid_RecordPartnerListItem, "int"),GetSQLValueString($collang_RecordPartnerListItem, "text"),GetSQLValueString($coluserid_RecordPartnerListItem, "int"));
$RecordPartnerListItem = mysqli_query($DB_Conn, $query_RecordPartnerListItem) or die(mysqli_error($DB_Conn));
$row_RecordPartnerListItem = mysqli_fetch_assoc($RecordPartnerListItem);
$totalRows_RecordPartnerListItem = mysqli_num_rows($RecordPartnerListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordPartnerListItem['itemname']] = $row_RecordPartnerListItem['itemname']; ?>
<?php } while ($row_RecordPartnerListItem = mysqli_fetch_assoc($RecordPartnerListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordPartnerListItem);
?>
