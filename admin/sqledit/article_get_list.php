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

$collang_RecordArticleListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordArticleListItem = $_SESSION['lang'];
}
$coluserid_RecordArticleListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordArticleListItem = $w_userid;
}
$collistid_RecordArticleListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordArticleListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordArticleListItem = sprintf("SELECT demo_articleitem.item_id, demo_articlelist.list_id, demo_articlelist.listname, demo_articleitem.itemname, demo_articleitem.lang FROM demo_articlelist LEFT OUTER JOIN demo_articleitem ON demo_articlelist.list_id = demo_articleitem.list_id WHERE demo_articlelist.list_id = %s && demo_articleitem.lang=%s && demo_articleitem.userid=%s", GetSQLValueString($collistid_RecordArticleListItem, "int"),GetSQLValueString($collang_RecordArticleListItem, "text"),GetSQLValueString($coluserid_RecordArticleListItem, "int"));
$RecordArticleListItem = mysqli_query($DB_Conn, $query_RecordArticleListItem) or die(mysqli_error($DB_Conn));
$row_RecordArticleListItem = mysqli_fetch_assoc($RecordArticleListItem);
$totalRows_RecordArticleListItem = mysqli_num_rows($RecordArticleListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordArticleListItem['item_id']] = $row_RecordArticleListItem['itemname']; ?>
<?php } while ($row_RecordArticleListItem = mysqli_fetch_assoc($RecordArticleListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordArticleListItem);
?>
