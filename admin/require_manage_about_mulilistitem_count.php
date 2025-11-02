<?php require_once('../Connections/DB_Conn.php'); ?>
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

if($row_RecordAboutListType['item_id'] != "")
{
	$row_RecordAboutListItem['item_id'] = $row_RecordAboutListType['item_id'];
}

$colname_RecordAboutListTypeCount = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordAboutListTypeCount = $_GET['lang'];
}
$colitem_id_RecordAboutListTypeCount = "-1";
if (isset($row_RecordAboutListItem['item_id'])) {
  $colitem_id_RecordAboutListTypeCount = $row_RecordAboutListItem['item_id'];
}
$coluserid_RecordAboutListTypeCount = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAboutListTypeCount = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAboutListTypeCount = sprintf("SELECT * FROM demo_aboutitem WHERE list_id = 1 && lang=%s && subitem_id = %s && userid=%s ORDER BY sortid ASC", GetSQLValueString($colname_RecordAboutListTypeCount, "text"),GetSQLValueString($colitem_id_RecordAboutListTypeCount, "int"),GetSQLValueString($coluserid_RecordAboutListTypeCount, "int"));
$RecordAboutListTypeCount = mysqli_query($DB_Conn, $query_RecordAboutListTypeCount) or die(mysqli_error($DB_Conn));
$row_RecordAboutListTypeCount = mysqli_fetch_assoc($RecordAboutListTypeCount);
$totalRows_RecordAboutListTypeCount = mysqli_num_rows($RecordAboutListTypeCount);
?>
<?php echo "<span class='badge badge-default badge-square pull-right'>" . $totalRows_RecordAboutListTypeCount . "</span>"; ?>
<?php
mysqli_free_result($RecordAboutListTypeCount);
?>
