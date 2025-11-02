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

$collang_RecordOvertimepayListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordOvertimepayListItem = $_SESSION['lang'];
}
$coluserid_RecordOvertimepayListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordOvertimepayListItem = $w_userid;
}
$collistid_RecordOvertimepayListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordOvertimepayListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordOvertimepayListItem = sprintf("SELECT salary_overtimepayitem.item_id, salary_overtimepaylist.list_id, salary_overtimepaylist.listname, salary_overtimepayitem.itemname, salary_overtimepayitem.lang FROM salary_overtimepaylist LEFT OUTER JOIN salary_overtimepayitem ON salary_overtimepaylist.list_id = salary_overtimepayitem.list_id WHERE salary_overtimepaylist.list_id = %s && salary_overtimepayitem.lang=%s && salary_overtimepayitem.userid = %s", GetSQLValueString($collistid_RecordOvertimepayListItem, "int"),GetSQLValueString($collang_RecordOvertimepayListItem, "text"),GetSQLValueString($coluserid_RecordOvertimepayListItem, "int"));
$RecordOvertimepayListItem = mysqli_query($DB_Conn, $query_RecordOvertimepayListItem) or die(mysqli_error($DB_Conn));
$row_RecordOvertimepayListItem = mysqli_fetch_assoc($RecordOvertimepayListItem);
$totalRows_RecordOvertimepayListItem = mysqli_num_rows($RecordOvertimepayListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordOvertimepayListItem['itemname']] = $row_RecordOvertimepayListItem['itemname']; ?>
<?php } while ($row_RecordOvertimepayListItem = mysqli_fetch_assoc($RecordOvertimepayListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordOvertimepayListItem);
?>
