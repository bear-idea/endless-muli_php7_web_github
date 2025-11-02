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

$collang_RecordMenuListNavi = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordMenuListNavi = $_SESSION['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordMenuListNavi = sprintf("SELECT * FROM demo_menu_level0 WHERE demo_menu_level0.lang=%s", GetSQLValueString($collang_RecordMenuListNavi, "text"));
$RecordMenuListNavi = mysqli_query($DB_Conn, $query_RecordMenuListNavi) or die(mysqli_error($DB_Conn));
$row_RecordMenuListNavi = mysqli_fetch_assoc($RecordMenuListNavi);
$totalRows_RecordMenuListNavi = mysqli_num_rows($RecordMenuListNavi);
?>

<?php do { ?>
  <?php $data[$row_RecordMenuListNavi['l0id']] = "上層選單 = " . $row_RecordMenuListNavi['naviname']; ?>
<?php } while ($row_RecordMenuListNavi = mysqli_fetch_assoc($RecordMenuListNavi)); ?>

<?php 
	print json_encode($data);
?>

<?php
mysqli_free_result($RecordMenuListNavi);
?>
