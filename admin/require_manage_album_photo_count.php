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

if($row_RecordAlbumListType['item_id'] != "")
{
	$row_RecordAlbumListItem['item_id'] = $row_RecordAlbumListType['item_id'];
}

$colname_RecordAlbumListTypeCount = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordAlbumListTypeCount = $_GET['lang'];
}
$collist_id_RecordAlbumListTypeCount = "-1";
if (isset($_GET['list_id'])) {
  $collist_id_RecordAlbumListTypeCount = $_GET['list_id'];
}
$colitem_id_RecordAlbumListTypeCount = "-1";
if (isset($row_RecordAlbumListItem['item_id'])) {
  $colitem_id_RecordAlbumListTypeCount = $row_RecordAlbumListItem['item_id'];
}
$coluserid_RecordAlbumListTypeCount = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAlbumListTypeCount = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAlbumListTypeCount = sprintf("SELECT * FROM demo_albumitem WHERE list_id = %s && lang=%s && subitem_id = %s && userid=%s ORDER BY sortid ASC", GetSQLValueString($collist_id_RecordAlbumListTypeCount, "int"), GetSQLValueString($colname_RecordAlbumListTypeCount, "text"),GetSQLValueString($colitem_id_RecordAlbumListTypeCount, "int"),GetSQLValueString($coluserid_RecordAlbumListTypeCount, "int"));
$RecordAlbumListTypeCount = mysqli_query($DB_Conn, $query_RecordAlbumListTypeCount) or die(mysqli_error($DB_Conn));
$row_RecordAlbumListTypeCount = mysqli_fetch_assoc($RecordAlbumListTypeCount);
$totalRows_RecordAlbumListTypeCount = mysqli_num_rows($RecordAlbumListTypeCount);
?>
<?php echo "<span class='badge badge-default badge-square pull-right'>" . $totalRows_RecordAlbumListTypeCount . "</span>"; ?>
<?php
mysqli_free_result($RecordAlbumListTypeCount);
?>
