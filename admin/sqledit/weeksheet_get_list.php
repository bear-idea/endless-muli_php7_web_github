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

$collang_RecordWeeksheetListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordWeeksheetListItem = $_SESSION['lang'];
}
$coluserid_RecordWeeksheetListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordWeeksheetListItem = $w_userid;
}
$collistid_RecordWeeksheetListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordWeeksheetListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordWeeksheetListItem = sprintf("SELECT salary_weeksheetitem.item_id, salary_weeksheetlist.list_id, salary_weeksheetlist.listname, salary_weeksheetitem.itemname, salary_weeksheetitem.lang FROM salary_weeksheetlist LEFT OUTER JOIN salary_weeksheetitem ON salary_weeksheetlist.list_id = salary_weeksheetitem.list_id WHERE salary_weeksheetlist.list_id = %s && salary_weeksheetitem.lang=%s && salary_weeksheetitem.userid = %s", GetSQLValueString($collistid_RecordWeeksheetListItem, "int"),GetSQLValueString($collang_RecordWeeksheetListItem, "text"),GetSQLValueString($coluserid_RecordWeeksheetListItem, "int"));
$RecordWeeksheetListItem = mysqli_query($DB_Conn, $query_RecordWeeksheetListItem) or die(mysqli_error($DB_Conn));
$row_RecordWeeksheetListItem = mysqli_fetch_assoc($RecordWeeksheetListItem);
$totalRows_RecordWeeksheetListItem = mysqli_num_rows($RecordWeeksheetListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordWeeksheetListItem['itemname']] = $row_RecordWeeksheetListItem['itemname']; ?>
<?php } while ($row_RecordWeeksheetListItem = mysqli_fetch_assoc($RecordWeeksheetListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordWeeksheetListItem);
?>
