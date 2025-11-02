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

$collang_RecordOrgListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordOrgListItem = $_SESSION['lang'];
}
$coluserid_RecordOrgListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordOrgListItem = $w_userid;
}
$collistid_RecordOrgListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordOrgListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordOrgListItem = sprintf("SELECT demo_orgitem.item_id, demo_orglist.list_id, demo_orglist.listname, demo_orgitem.itemname, demo_orgitem.lang FROM demo_orglist LEFT OUTER JOIN demo_orgitem ON demo_orglist.list_id = demo_orgitem.list_id WHERE demo_orglist.list_id = %s && demo_orgitem.lang=%s && demo_orgitem.userid=%s", GetSQLValueString($collistid_RecordOrgListItem, "int"),GetSQLValueString($collang_RecordOrgListItem, "text"),GetSQLValueString($coluserid_RecordOrgListItem, "int"));
$RecordOrgListItem = mysqli_query($DB_Conn, $query_RecordOrgListItem) or die(mysqli_error($DB_Conn));
$row_RecordOrgListItem = mysqli_fetch_assoc($RecordOrgListItem);
$totalRows_RecordOrgListItem = mysqli_num_rows($RecordOrgListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordOrgListItem['itemname']] = $row_RecordOrgListItem['itemname']; ?>
<?php } while ($row_RecordOrgListItem = mysqli_fetch_assoc($RecordOrgListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordOrgListItem);
?>
