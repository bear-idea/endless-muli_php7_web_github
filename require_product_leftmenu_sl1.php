<?php require_once('Connections/DB_Conn.php'); ?>
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


$collang_RecordMultiLeftMenu_l2 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordMultiLeftMenu_l2 = $_GET['lang'];
}
$colsubitem_id_RecordMultiLeftMenu_l2 = "-1";
if (isset($row_RecordMultiLeftMenu_l1['item_id'])) {
  $colsubitem_id_RecordMultiLeftMenu_l2 = $row_RecordMultiLeftMenu_l1['item_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordMultiLeftMenu_l2 = sprintf("SELECT * FROM demo_productitem WHERE list_id = 1 && lang = %s && level = '1' && subitem_id = %s", GetSQLValueString($collang_RecordMultiLeftMenu_l2, "text"),GetSQLValueString($colsubitem_id_RecordMultiLeftMenu_l2, "int"));
$RecordMultiLeftMenu_l2 = mysqli_query($DB_Conn, $query_RecordMultiLeftMenu_l2) or die(mysqli_error($DB_Conn));
$row_RecordMultiLeftMenu_l2 = mysqli_fetch_assoc($RecordMultiLeftMenu_l2);
$totalRows_RecordMultiLeftMenu_l2 = mysqli_num_rows($RecordMultiLeftMenu_l2);
?>
<?php do { ?>
  <li id=sn-downloadsmacosx><a 
    href="http://jqueryfordesigners.com/downloads/macosx/">All 
    Categories</a>
  </li>
  <?php } while ($row_RecordMultiLeftMenu_l2 = mysqli_fetch_assoc($RecordMultiLeftMenu_l2)); ?>

<?php
mysqli_free_result($RecordMultiLeftMenu_l2);
?>
