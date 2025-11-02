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

$collang_RecordEmployeesListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordEmployeesListItem = $_SESSION['lang'];
}
$coluserid_RecordEmployeesListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordEmployeesListItem = $w_userid;
}
$collistid_RecordEmployeesListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordEmployeesListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordEmployeesListItem = sprintf("SELECT demo_employeesitem.item_id, demo_employeeslist.list_id, demo_employeeslist.listname, demo_employeesitem.itemname, demo_employeesitem.lang FROM demo_employeeslist LEFT OUTER JOIN demo_employeesitem ON demo_employeeslist.list_id = demo_employeesitem.list_id WHERE demo_employeeslist.list_id = %s && demo_employeesitem.lang=%s && demo_employeesitem.userid=%s", GetSQLValueString($collistid_RecordEmployeesListItem, "int"),GetSQLValueString($collang_RecordEmployeesListItem, "text"),GetSQLValueString($coluserid_RecordEmployeesListItem, "int"));
$RecordEmployeesListItem = mysqli_query($DB_Conn, $query_RecordEmployeesListItem) or die(mysqli_error($DB_Conn));
$row_RecordEmployeesListItem = mysqli_fetch_assoc($RecordEmployeesListItem);
$totalRows_RecordEmployeesListItem = mysqli_num_rows($RecordEmployeesListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordEmployeesListItem['itemname']] = $row_RecordEmployeesListItem['itemname']; ?>
<?php } while ($row_RecordEmployeesListItem = mysqli_fetch_assoc($RecordEmployeesListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordEmployeesListItem);
?>
