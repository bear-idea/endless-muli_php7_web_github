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

$collang_RecordStrongholdListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordStrongholdListItem = $_SESSION['lang'];
}
$coluserid_RecordStrongholdListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordStrongholdListItem = $w_userid;
}
$collistid_RecordStrongholdListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordStrongholdListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordStrongholdListItem = sprintf("SELECT demo_strongholditem.item_id, demo_strongholdlist.list_id, demo_strongholdlist.listname, demo_strongholditem.itemname, demo_strongholditem.lang FROM demo_strongholdlist LEFT OUTER JOIN demo_strongholditem ON demo_strongholdlist.list_id = demo_strongholditem.list_id WHERE demo_strongholdlist.list_id = %s && demo_strongholditem.lang=%s && demo_strongholditem.userid=%s", GetSQLValueString($collistid_RecordStrongholdListItem, "int"),GetSQLValueString($collang_RecordStrongholdListItem, "text"),GetSQLValueString($coluserid_RecordStrongholdListItem, "int"));
$RecordStrongholdListItem = mysqli_query($DB_Conn, $query_RecordStrongholdListItem) or die(mysqli_error($DB_Conn));
$row_RecordStrongholdListItem = mysqli_fetch_assoc($RecordStrongholdListItem);
$totalRows_RecordStrongholdListItem = mysqli_num_rows($RecordStrongholdListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordStrongholdListItem['itemname']] = $row_RecordStrongholdListItem['itemname']; ?>
<?php } while ($row_RecordStrongholdListItem = mysqli_fetch_assoc($RecordStrongholdListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordStrongholdListItem);
?>
