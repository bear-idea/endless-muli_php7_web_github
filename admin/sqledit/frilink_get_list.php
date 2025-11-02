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

$collang_RecordFrilinkListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordFrilinkListItem = $_SESSION['lang'];
}
$coluserid_RecordFrilinkListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordFrilinkListItem = $w_userid;
}
$collistid_RecordFrilinkListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordFrilinkListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordFrilinkListItem = sprintf("SELECT demo_frilinkitem.item_id, demo_frilinklist.list_id, demo_frilinklist.listname, demo_frilinkitem.itemname, demo_frilinkitem.lang FROM demo_frilinklist LEFT OUTER JOIN demo_frilinkitem ON demo_frilinklist.list_id = demo_frilinkitem.list_id WHERE demo_frilinklist.list_id = %s && demo_frilinkitem.lang=%s && demo_frilinkitem.userid=%s", GetSQLValueString($collistid_RecordFrilinkListItem, "int"),GetSQLValueString($collang_RecordFrilinkListItem, "text"),GetSQLValueString($coluserid_RecordFrilinkListItem, "int"));
$RecordFrilinkListItem = mysqli_query($DB_Conn, $query_RecordFrilinkListItem) or die(mysqli_error($DB_Conn));
$row_RecordFrilinkListItem = mysqli_fetch_assoc($RecordFrilinkListItem);
$totalRows_RecordFrilinkListItem = mysqli_num_rows($RecordFrilinkListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordFrilinkListItem['itemname']] = $row_RecordFrilinkListItem['itemname']; ?>
<?php } while ($row_RecordFrilinkListItem = mysqli_fetch_assoc($RecordFrilinkListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordFrilinkListItem);
?>
