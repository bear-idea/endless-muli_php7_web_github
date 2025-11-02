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

$collang_RecordEPaperListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordEPaperListItem = $_SESSION['lang'];
}
$coluserid_RecordEPaperListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordEPaperListItem = $w_userid;
}
$collistid_RecordEPaperListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordEPaperListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordEPaperListItem = sprintf("SELECT demo_epaperitem.item_id, demo_epaperlist.list_id, demo_epaperlist.listname, demo_epaperitem.itemname, demo_epaperitem.lang FROM demo_epaperlist LEFT OUTER JOIN demo_epaperitem ON demo_epaperlist.list_id = demo_epaperitem.list_id WHERE demo_epaperlist.list_id = %s && demo_epaperitem.lang=%s && demo_epaperitem.userid=%s", GetSQLValueString($collistid_RecordEPaperListItem, "int"),GetSQLValueString($collang_RecordEPaperListItem, "text"),GetSQLValueString($coluserid_RecordEPaperListItem, "int"));
$RecordEPaperListItem = mysqli_query($DB_Conn, $query_RecordEPaperListItem) or die(mysqli_error($DB_Conn));
$row_RecordEPaperListItem = mysqli_fetch_assoc($RecordEPaperListItem);
$totalRows_RecordEPaperListItem = mysqli_num_rows($RecordEPaperListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordEPaperListItem['itemname']] = $row_RecordEPaperListItem['itemname']; ?>
<?php } while ($row_RecordEPaperListItem = mysqli_fetch_assoc($RecordEPaperListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordEPaperListItem);
?>
