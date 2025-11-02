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

$collang_RecordCareersListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordCareersListItem = $_SESSION['lang'];
}
$coluserid_RecordCareersListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCareersListItem = $w_userid;
}
$collistid_RecordCareersListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordCareersListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCareersListItem = sprintf("SELECT demo_careersitem.item_id, demo_careerslist.list_id, demo_careerslist.listname, demo_careersitem.itemname, demo_careersitem.lang FROM demo_careerslist LEFT OUTER JOIN demo_careersitem ON demo_careerslist.list_id = demo_careersitem.list_id WHERE demo_careerslist.list_id = %s && demo_careersitem.lang=%s && demo_careersitem.userid=%s", GetSQLValueString($collistid_RecordCareersListItem, "int"),GetSQLValueString($collang_RecordCareersListItem, "text"),GetSQLValueString($coluserid_RecordCareersListItem, "int"));
$RecordCareersListItem = mysqli_query($DB_Conn, $query_RecordCareersListItem) or die(mysqli_error($DB_Conn));
$row_RecordCareersListItem = mysqli_fetch_assoc($RecordCareersListItem);
$totalRows_RecordCareersListItem = mysqli_num_rows($RecordCareersListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordCareersListItem['itemname']] = $row_RecordCareersListItem['itemname']; ?>
<?php } while ($row_RecordCareersListItem = mysqli_fetch_assoc($RecordCareersListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordCareersListItem);
?>
