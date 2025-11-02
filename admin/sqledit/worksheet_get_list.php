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

$collang_RecordWorksheetListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordWorksheetListItem = $_SESSION['lang'];
}
$coluserid_RecordWorksheetListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordWorksheetListItem = $w_userid;
}
$collistid_RecordWorksheetListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordWorksheetListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordWorksheetListItem = sprintf("SELECT salary_worksheetitem.item_id, salary_worksheetlist.list_id, salary_worksheetlist.listname, salary_worksheetitem.itemname, salary_worksheetitem.lang FROM salary_worksheetlist LEFT OUTER JOIN salary_worksheetitem ON salary_worksheetlist.list_id = salary_worksheetitem.list_id WHERE salary_worksheetlist.list_id = %s && salary_worksheetitem.lang=%s && salary_worksheetitem.userid = %s", GetSQLValueString($collistid_RecordWorksheetListItem, "int"),GetSQLValueString($collang_RecordWorksheetListItem, "text"),GetSQLValueString($coluserid_RecordWorksheetListItem, "int"));
$RecordWorksheetListItem = mysqli_query($DB_Conn, $query_RecordWorksheetListItem) or die(mysqli_error($DB_Conn));
$row_RecordWorksheetListItem = mysqli_fetch_assoc($RecordWorksheetListItem);
$totalRows_RecordWorksheetListItem = mysqli_num_rows($RecordWorksheetListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordWorksheetListItem['itemname']] = $row_RecordWorksheetListItem['itemname']; ?>
<?php } while ($row_RecordWorksheetListItem = mysqli_fetch_assoc($RecordWorksheetListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordWorksheetListItem);
?>
