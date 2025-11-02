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

$collang_RecordForumListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordForumListItem = $_SESSION['lang'];
}
$coluserid_RecordForumListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordForumListItem = $w_userid;
}
$collistid_RecordForumListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordForumListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordForumListItem = sprintf("SELECT demo_forumitem.item_id, demo_forumlist.list_id, demo_forumlist.listname, demo_forumitem.itemname, demo_forumitem.lang FROM demo_forumlist LEFT OUTER JOIN demo_forumitem ON demo_forumlist.list_id = demo_forumitem.list_id WHERE demo_forumlist.list_id = %s && demo_forumitem.lang=%s && demo_forumitem.userid=%s ORDER BY demo_forumitem. sortid ASC", GetSQLValueString($collistid_RecordForumListItem, "int"),GetSQLValueString($collang_RecordForumListItem, "text"),GetSQLValueString($coluserid_RecordForumListItem, "int"));
$RecordForumListItem = mysqli_query($DB_Conn, $query_RecordForumListItem) or die(mysqli_error($DB_Conn));
$row_RecordForumListItem = mysqli_fetch_assoc($RecordForumListItem);
$totalRows_RecordForumListItem = mysqli_num_rows($RecordForumListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordForumListItem['itemname']] = $row_RecordForumListItem['itemname']; ?>
<?php } while ($row_RecordForumListItem = mysqli_fetch_assoc($RecordForumListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordForumListItem);
?>
