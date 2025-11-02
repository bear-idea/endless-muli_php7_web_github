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

$collang_RecordCarnumberListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordCarnumberListItem = $_SESSION['lang'];
}
$coluserid_RecordCarnumberListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCarnumberListItem = $w_userid;
}
$collistid_RecordCarnumberListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordCarnumberListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCarnumberListItem = sprintf("SELECT erp_carnumberitem.item_id, erp_carnumberlist.list_id, erp_carnumberlist.listname, erp_carnumberitem.itemname, erp_carnumberitem.lang FROM erp_carnumberlist LEFT OUTER JOIN erp_carnumberitem ON erp_carnumberlist.list_id = erp_carnumberitem.list_id WHERE erp_carnumberlist.list_id = %s && erp_carnumberitem.lang=%s && erp_carnumberitem.userid = %s", GetSQLValueString($collistid_RecordCarnumberListItem, "int"),GetSQLValueString($collang_RecordCarnumberListItem, "text"),GetSQLValueString($coluserid_RecordCarnumberListItem, "int"));
$RecordCarnumberListItem = mysqli_query($DB_Conn, $query_RecordCarnumberListItem) or die(mysqli_error($DB_Conn));
$row_RecordCarnumberListItem = mysqli_fetch_assoc($RecordCarnumberListItem);
$totalRows_RecordCarnumberListItem = mysqli_num_rows($RecordCarnumberListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordCarnumberListItem['itemname']] = $row_RecordCarnumberListItem['itemname']; ?>
<?php } while ($row_RecordCarnumberListItem = mysqli_fetch_assoc($RecordCarnumberListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordCarnumberListItem);
?>
