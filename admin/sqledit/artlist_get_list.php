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

$collang_RecordArtlistListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordArtlistListItem = $_SESSION['lang'];
}
$coluserid_RecordArtlistListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordArtlistListItem = $w_userid;
}
$collistid_RecordArtlistListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordArtlistListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordArtlistListItem = sprintf("SELECT demo_artlistitem.item_id, demo_artlistlist.list_id, demo_artlistlist.listname, demo_artlistitem.itemname, demo_artlistitem.lang FROM demo_artlistlist LEFT OUTER JOIN demo_artlistitem ON demo_artlistlist.list_id = demo_artlistitem.list_id WHERE demo_artlistlist.list_id = %s && demo_artlistitem.lang=%s && demo_artlistitem.userid=%s", GetSQLValueString($collistid_RecordArtlistListItem, "int"),GetSQLValueString($collang_RecordArtlistListItem, "text"),GetSQLValueString($coluserid_RecordArtlistListItem, "int"));
$RecordArtlistListItem = mysqli_query($DB_Conn, $query_RecordArtlistListItem) or die(mysqli_error($DB_Conn));
$row_RecordArtlistListItem = mysqli_fetch_assoc($RecordArtlistListItem);
$totalRows_RecordArtlistListItem = mysqli_num_rows($RecordArtlistListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordArtlistListItem['itemname']] = $row_RecordArtlistListItem['itemname']; ?>
<?php } while ($row_RecordArtlistListItem = mysqli_fetch_assoc($RecordArtlistListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordArtlistListItem);
?>
