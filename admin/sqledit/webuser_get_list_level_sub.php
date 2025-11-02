<?php require_once('../../Connections/DB_Conn.php'); ?>
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

$collistid_RecordPermissionListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordPermissionListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPermissionListItem = sprintf("SELECT demo_permissionitem.item_id, demo_permissionlist.list_id, demo_permissionlist.listname, demo_permissionitem.itemname, demo_permissionitem.itemvalue, demo_permissionitem.lang FROM demo_permissionlist LEFT OUTER JOIN demo_permissionitem ON demo_permissionlist.list_id = demo_permissionitem.list_id WHERE demo_permissionlist.list_id = %s", GetSQLValueString($collistid_RecordPermissionListItem, "int"));
$RecordPermissionListItem = mysqli_query($DB_Conn, $query_RecordPermissionListItem) or die(mysqli_error($DB_Conn));
$row_RecordPermissionListItem = mysqli_fetch_assoc($RecordPermissionListItem);
$totalRows_RecordPermissionListItem = mysqli_num_rows($RecordPermissionListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordPermissionListItem['itemvalue']] = $row_RecordPermissionListItem['itemname']; ?>
<?php } while ($row_RecordPermissionListItem = mysqli_fetch_assoc($RecordPermissionListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordPermissionListItem);
?>

