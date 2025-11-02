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

$collang_RecordSponsorListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordSponsorListItem = $_SESSION['lang'];
}
$coluserid_RecordSponsorListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSponsorListItem = $w_userid;
}
$collistid_RecordSponsorListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordSponsorListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSponsorListItem = sprintf("SELECT demo_sponsoritem.item_id, demo_sponsorlist.list_id, demo_sponsorlist.listname, demo_sponsoritem.itemname, demo_sponsoritem.lang FROM demo_sponsorlist LEFT OUTER JOIN demo_sponsoritem ON demo_sponsorlist.list_id = demo_sponsoritem.list_id WHERE demo_sponsorlist.list_id = %s && demo_sponsoritem.lang=%s && demo_sponsoritem.userid=%s", GetSQLValueString($collistid_RecordSponsorListItem, "int"),GetSQLValueString($collang_RecordSponsorListItem, "text"),GetSQLValueString($coluserid_RecordSponsorListItem, "int"));
$RecordSponsorListItem = mysqli_query($DB_Conn, $query_RecordSponsorListItem) or die(mysqli_error($DB_Conn));
$row_RecordSponsorListItem = mysqli_fetch_assoc($RecordSponsorListItem);
$totalRows_RecordSponsorListItem = mysqli_num_rows($RecordSponsorListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordSponsorListItem['itemname']] = $row_RecordSponsorListItem['itemname']; ?>
<?php } while ($row_RecordSponsorListItem = mysqli_fetch_assoc($RecordSponsorListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordSponsorListItem);
?>
