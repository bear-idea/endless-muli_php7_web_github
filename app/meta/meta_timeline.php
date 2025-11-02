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

$colname_RecordTimelineKeyWord = "-1";
if (isset($_GET['id'])) {
  $colname_RecordTimelineKeyWord = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTimelineKeyWord = sprintf("SELECT name, sdescription, skeyword FROM demo_timeline WHERE id = %s", GetSQLValueString($colname_RecordTimelineKeyWord, "int"));
$RecordTimelineKeyWord = mysqli_query($DB_Conn, $query_RecordTimelineKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordTimelineKeyWord = mysqli_fetch_assoc($RecordTimelineKeyWord);
$totalRows_RecordTimelineKeyWord = mysqli_num_rows($RecordTimelineKeyWord);

if(isset($row_RecordTimelineKeyWord['name']))
{
	$Title_Word = $row_RecordTimelineKeyWord['name'] . " - " . $SiteName;
}else {
	$Title_Word = $ModuleName['Timeline'] . " - " . $SiteName;
}

if(isset($row_RecordTimelineKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordTimelineKeyWord['skeyword'];
}else {
	$Title_Keyword = $SiteKeyWord;
}

if(isset($row_RecordTimelineKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordTimelineKeyWord['sdescription'];
}else {
	$Title_Desc = "";
}

mysqli_free_result($RecordTimelineKeyWord);
?>
