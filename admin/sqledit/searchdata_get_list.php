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

$collang_RecordSearchdataListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordSearchdataListItem = $_SESSION['lang'];
}
$coluserid_RecordSearchdataListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSearchdataListItem = $w_userid;
}
$collistid_RecordSearchdataListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordSearchdataListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSearchdataListItem = sprintf("SELECT mail_searchdataitem.item_id, mail_searchdatalist.list_id, mail_searchdatalist.listname, mail_searchdataitem.itemname, mail_searchdataitem.lang FROM mail_searchdatalist LEFT OUTER JOIN mail_searchdataitem ON mail_searchdatalist.list_id = mail_searchdataitem.list_id WHERE mail_searchdatalist.list_id = %s && mail_searchdataitem.lang=%s && mail_searchdataitem.userid = %s", GetSQLValueString($collistid_RecordSearchdataListItem, "int"),GetSQLValueString($collang_RecordSearchdataListItem, "text"),GetSQLValueString($coluserid_RecordSearchdataListItem, "int"));
$RecordSearchdataListItem = mysqli_query($DB_Conn, $query_RecordSearchdataListItem) or die(mysqli_error($DB_Conn));
$row_RecordSearchdataListItem = mysqli_fetch_assoc($RecordSearchdataListItem);
$totalRows_RecordSearchdataListItem = mysqli_num_rows($RecordSearchdataListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordSearchdataListItem['itemname']] = $row_RecordSearchdataListItem['itemname']; ?>
<?php } while ($row_RecordSearchdataListItem = mysqli_fetch_assoc($RecordSearchdataListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordSearchdataListItem);
?>
