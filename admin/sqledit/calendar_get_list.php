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

$collang_RecordCalendarListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordCalendarListItem = $_SESSION['lang'];
}
$coluserid_RecordCalendarListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCalendarListItem = $w_userid;
}
$collistid_RecordCalendarListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordCalendarListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCalendarListItem = sprintf("SELECT salary_calendaritem.item_id, salary_calendarlist.list_id, salary_calendarlist.listname, salary_calendaritem.itemname, salary_calendaritem.lang FROM salary_calendarlist LEFT OUTER JOIN salary_calendaritem ON salary_calendarlist.list_id = salary_calendaritem.list_id WHERE salary_calendarlist.list_id = %s && salary_calendaritem.lang=%s && salary_calendaritem.userid=%s", GetSQLValueString($collistid_RecordCalendarListItem, "int"),GetSQLValueString($collang_RecordCalendarListItem, "text"),GetSQLValueString($coluserid_RecordCalendarListItem, "int"));
$RecordCalendarListItem = mysqli_query($DB_Conn, $query_RecordCalendarListItem) or die(mysqli_error($DB_Conn));
$row_RecordCalendarListItem = mysqli_fetch_assoc($RecordCalendarListItem);
$totalRows_RecordCalendarListItem = mysqli_num_rows($RecordCalendarListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordCalendarListItem['item_id']] = $row_RecordCalendarListItem['itemname']; ?>
<?php } while ($row_RecordCalendarListItem = mysqli_fetch_assoc($RecordCalendarListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordCalendarListItem);
?>
