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

$collang_RecordAlbumListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordAlbumListItem = $_SESSION['lang'];
}
$coluserid_RecordAlbumListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAlbumListItem = $w_userid;
}
$collistid_RecordAlbumListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordAlbumListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAlbumListItem = sprintf("SELECT demo_albumitem.item_id, demo_albumlist.list_id, demo_albumlist.listname, demo_albumitem.itemname, demo_albumitem.lang FROM demo_albumlist LEFT OUTER JOIN demo_albumitem ON demo_albumlist.list_id = demo_albumitem.list_id WHERE demo_albumlist.list_id = %s && demo_albumitem.lang=%s  && demo_albumitem.userid=%s", GetSQLValueString($collistid_RecordAlbumListItem, "int"),GetSQLValueString($collang_RecordAlbumListItem, "text"),GetSQLValueString($coluserid_RecordAlbumListItem, "int"));
$RecordAlbumListItem = mysqli_query($DB_Conn, $query_RecordAlbumListItem) or die(mysqli_error($DB_Conn));
$row_RecordAlbumListItem = mysqli_fetch_assoc($RecordAlbumListItem);
$totalRows_RecordAlbumListItem = mysqli_num_rows($RecordAlbumListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordAlbumListItem['itemname']] = $row_RecordAlbumListItem['itemname']; ?>
<?php } while ($row_RecordAlbumListItem = mysqli_fetch_assoc($RecordAlbumListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordAlbumListItem);
?>
