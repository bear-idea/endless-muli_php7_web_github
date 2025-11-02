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

if($row_RecordArticleListType['item_id'] != "")
{
	$row_RecordArticleListItem['item_id'] = $row_RecordArticleListType['item_id'];
}

$colname_RecordArticleListTypeCount = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordArticleListTypeCount = $_GET['lang'];
}
$colitem_id_RecordArticleListTypeCount = "-1";
if (isset($row_RecordArticleListItem['item_id'])) {
  $colitem_id_RecordArticleListTypeCount = $row_RecordArticleListItem['item_id'];
}
$coluserid_RecordArticleListTypeCount = "-1";
if (isset($w_userid)) {
  $coluserid_RecordArticleListTypeCount = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordArticleListTypeCount = sprintf("SELECT * FROM demo_articleitem WHERE list_id = 1 && lang=%s && subitem_id = %s && userid=%s ORDER BY sortid ASC", GetSQLValueString($colname_RecordArticleListTypeCount, "text"),GetSQLValueString($colitem_id_RecordArticleListTypeCount, "int"),GetSQLValueString($coluserid_RecordArticleListTypeCount, "int"));
$RecordArticleListTypeCount = mysqli_query($DB_Conn, $query_RecordArticleListTypeCount) or die(mysqli_error($DB_Conn));
$row_RecordArticleListTypeCount = mysqli_fetch_assoc($RecordArticleListTypeCount);
$totalRows_RecordArticleListTypeCount = mysqli_num_rows($RecordArticleListTypeCount);
?>
<?php echo "<span class='badge badge-default badge-square pull-right'>" . $totalRows_RecordArticleListTypeCount . "</span>"; ?>
<?php
mysqli_free_result($RecordArticleListTypeCount);
?>
