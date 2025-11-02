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

$collang_RecordimageshowListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordimageshowListItem = $_SESSION['lang'];
}
$coluserid_RecordimageshowListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordimageshowListItem = $w_userid;
}
$collistid_RecordimageshowListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordimageshowListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordimageshowListItem = sprintf("SELECT demo_imageshowitem.item_id, demo_imageshowlist.list_id, demo_imageshowlist.listname, demo_imageshowitem.itemname, demo_imageshowitem.lang FROM demo_imageshowlist LEFT OUTER JOIN demo_imageshowitem ON demo_imageshowlist.list_id = demo_imageshowitem.list_id WHERE demo_imageshowlist.list_id = %s && demo_imageshowitem.lang=%s  && demo_imageshowitem.userid=%s", GetSQLValueString($collistid_RecordimageshowListItem, "int"),GetSQLValueString($collang_RecordimageshowListItem, "text"),GetSQLValueString($coluserid_RecordimageshowListItem, "int"));
$RecordimageshowListItem = mysqli_query($DB_Conn, $query_RecordimageshowListItem) or die(mysqli_error($DB_Conn));
$row_RecordimageshowListItem = mysqli_fetch_assoc($RecordimageshowListItem);
$totalRows_RecordimageshowListItem = mysqli_num_rows($RecordimageshowListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordimageshowListItem['itemname']] = $row_RecordimageshowListItem['itemname']; ?>
<?php } while ($row_RecordimageshowListItem = mysqli_fetch_assoc($RecordimageshowListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordimageshowListItem);
?>
