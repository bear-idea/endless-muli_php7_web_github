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

$collang_RecordYearendListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordYearendListItem = $_SESSION['lang'];
}
$coluserid_RecordYearendListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordYearendListItem = $w_userid;
}
$collistid_RecordYearendListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordYearendListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordYearendListItem = sprintf("SELECT salary_yearenditem.item_id, salary_yearendlist.list_id, salary_yearendlist.listname, salary_yearenditem.itemname, salary_yearenditem.lang FROM salary_yearendlist LEFT OUTER JOIN salary_yearenditem ON salary_yearendlist.list_id = salary_yearenditem.list_id WHERE salary_yearendlist.list_id = %s && salary_yearenditem.lang=%s && salary_yearenditem.userid = %s", GetSQLValueString($collistid_RecordYearendListItem, "int"),GetSQLValueString($collang_RecordYearendListItem, "text"),GetSQLValueString($coluserid_RecordYearendListItem, "int"));
$RecordYearendListItem = mysqli_query($DB_Conn, $query_RecordYearendListItem) or die(mysqli_error($DB_Conn));
$row_RecordYearendListItem = mysqli_fetch_assoc($RecordYearendListItem);
$totalRows_RecordYearendListItem = mysqli_num_rows($RecordYearendListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordYearendListItem['itemname']] = $row_RecordYearendListItem['itemname']; ?>
<?php } while ($row_RecordYearendListItem = mysqli_fetch_assoc($RecordYearendListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordYearendListItem);
?>
