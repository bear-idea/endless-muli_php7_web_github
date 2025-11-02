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

$collang_RecordModlinkListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordModlinkListItem = $_SESSION['lang'];
}
$coluserid_RecordModlinkListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordModlinkListItem = $w_userid;
}
$collistid_RecordModlinkListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordModlinkListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordModlinkListItem = sprintf("SELECT demo_modlinkitem.item_id, demo_modlinklist.list_id, demo_modlinklist.listname, demo_modlinkitem.itemname, demo_modlinkitem.lang FROM demo_modlinklist LEFT OUTER JOIN demo_modlinkitem ON demo_modlinklist.list_id = demo_modlinkitem.list_id WHERE demo_modlinklist.list_id = %s && demo_modlinkitem.lang=%s && demo_modlinkitem.userid=%s", GetSQLValueString($collistid_RecordModlinkListItem, "int"),GetSQLValueString($collang_RecordModlinkListItem, "text"),GetSQLValueString($coluserid_RecordModlinkListItem, "int"));
$RecordModlinkListItem = mysqli_query($DB_Conn, $query_RecordModlinkListItem) or die(mysqli_error($DB_Conn));
$row_RecordModlinkListItem = mysqli_fetch_assoc($RecordModlinkListItem);
$totalRows_RecordModlinkListItem = mysqli_num_rows($RecordModlinkListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordModlinkListItem['itemname']] = $row_RecordModlinkListItem['itemname']; ?>
<?php } while ($row_RecordModlinkListItem = mysqli_fetch_assoc($RecordModlinkListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordModlinkListItem);
?>
