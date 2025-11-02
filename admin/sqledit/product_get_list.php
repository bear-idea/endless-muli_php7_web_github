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

$collang_RecordProductListItem = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordProductListItem = $_SESSION['lang'];
}
$coluserid_RecordProductListItem = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProductListItem = $w_userid;
}
$collistid_RecordProductListItem = "-1";
if (isset($_GET['list_id'])) {
  $collistid_RecordProductListItem = $_GET['list_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductListItem = sprintf("SELECT demo_productitem.item_id, demo_productlist.list_id, demo_productlist.listname, demo_productitem.itemname, demo_productitem.lang FROM demo_productlist LEFT OUTER JOIN demo_productitem ON demo_productlist.list_id = demo_productitem.list_id WHERE demo_productlist.list_id = %s && demo_productitem.lang=%s  && demo_productitem.userid=%s ORDER BY demo_productitem. sortid ASC", GetSQLValueString($collistid_RecordProductListItem, "int"),GetSQLValueString($collang_RecordProductListItem, "text"),GetSQLValueString($coluserid_RecordProductListItem, "int"));
$RecordProductListItem = mysqli_query($DB_Conn, $query_RecordProductListItem) or die(mysqli_error($DB_Conn));
$row_RecordProductListItem = mysqli_fetch_assoc($RecordProductListItem);
$totalRows_RecordProductListItem = mysqli_num_rows($RecordProductListItem);
?>

<?php do { ?>
  <?php $data[$row_RecordProductListItem['itemname']] = $row_RecordProductListItem['itemname']; ?>
<?php } while ($row_RecordProductListItem = mysqli_fetch_assoc($RecordProductListItem)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordProductListItem);
?>
