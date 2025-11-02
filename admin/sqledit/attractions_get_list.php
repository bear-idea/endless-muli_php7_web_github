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

$collang_RecordAttractionsListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordAttractionsListItem = $_SESSION['lang'];
}
$coluserid_RecordAttractionsListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAttractionsListItem = $w_userid;
}
$collistid_RecordAttractionsListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordAttractionsListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAttractionsListItem = sprintf("SELECT demo_attractionsitem.item_id, demo_attractionslist.list_id, demo_attractionslist.listname, demo_attractionsitem.itemname, demo_attractionsitem.lang FROM demo_attractionslist LEFT OUTER JOIN demo_attractionsitem ON demo_attractionslist.list_id = demo_attractionsitem.list_id WHERE demo_attractionslist.list_id = %s && demo_attractionsitem.lang=%s && demo_attractionsitem.userid=%s", GetSQLValueString($collistid_RecordAttractionsListItem, "int"),GetSQLValueString($collang_RecordAttractionsListItem, "text"),GetSQLValueString($coluserid_RecordAttractionsListItem, "int"));
$RecordAttractionsListItem = mysqli_query($DB_Conn, $query_RecordAttractionsListItem) or die(mysqli_error($DB_Conn));
$row_RecordAttractionsListItem = mysqli_fetch_assoc($RecordAttractionsListItem);
$totalRows_RecordAttractionsListItem = mysqli_num_rows($RecordAttractionsListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordAttractionsListItem['itemname']] = $row_RecordAttractionsListItem['itemname']; ?>
<?php } while ($row_RecordAttractionsListItem = mysqli_fetch_assoc($RecordAttractionsListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordAttractionsListItem);
?>
