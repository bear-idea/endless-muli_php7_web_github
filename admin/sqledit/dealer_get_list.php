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

$collang_RecordDealerListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordDealerListItem = $_SESSION['lang'];
}
$coluserid_RecordDealerListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordDealerListItem = $w_userid;
}
$collistid_RecordDealerListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordDealerListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDealerListItem = sprintf("SELECT demo_dealeritem.item_id, demo_dealerlist.list_id, demo_dealerlist.listname, demo_dealeritem.itemname, demo_dealeritem.lang FROM demo_dealerlist LEFT OUTER JOIN demo_dealeritem ON demo_dealerlist.list_id = demo_dealeritem.list_id WHERE demo_dealerlist.list_id = %s && demo_dealeritem.lang=%s && demo_dealeritem.userid=%s", GetSQLValueString($collistid_RecordDealerListItem, "int"),GetSQLValueString($collang_RecordDealerListItem, "text"),GetSQLValueString($coluserid_RecordDealerListItem, "int"));
$RecordDealerListItem = mysqli_query($DB_Conn, $query_RecordDealerListItem) or die(mysqli_error($DB_Conn));
$row_RecordDealerListItem = mysqli_fetch_assoc($RecordDealerListItem);
$totalRows_RecordDealerListItem = mysqli_num_rows($RecordDealerListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordDealerListItem['itemname']] = $row_RecordDealerListItem['itemname']; ?>
<?php } while ($row_RecordDealerListItem = mysqli_fetch_assoc($RecordDealerListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordDealerListItem);
?>
