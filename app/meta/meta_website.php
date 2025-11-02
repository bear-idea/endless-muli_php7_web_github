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

$colname_RecordWebSiteKeyWord = "-1";
if (isset($_GET['website_id'])) {
  $colname_RecordWebSiteKeyWord = $_GET['website_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordWebSiteKeyWord = sprintf("SELECT name FROM demo_website WHERE id = %s", GetSQLValueString($colname_RecordWebSiteKeyWord, "int"));
$RecordWebSiteKeyWord = mysqli_query($DB_Conn, $query_RecordWebSiteKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordWebSiteKeyWord = mysqli_fetch_assoc($RecordWebSiteKeyWord);
$totalRows_RecordWebSiteKeyWord = mysqli_num_rows($RecordWebSiteKeyWord);$colname_RecordWebSiteKeyWord = "-1";
if (isset($_GET['website_id'])) {
  $colname_RecordWebSiteKeyWord = $_GET['website_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordWebSiteKeyWord = sprintf("SELECT name, sdescription, skeyword FROM demo_website WHERE id = %s", GetSQLValueString($colname_RecordWebSiteKeyWord, "int"));
$RecordWebSiteKeyWord = mysqli_query($DB_Conn, $query_RecordWebSiteKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordWebSiteKeyWord = mysqli_fetch_assoc($RecordWebSiteKeyWord);
$totalRows_RecordWebSiteKeyWord = mysqli_num_rows($RecordWebSiteKeyWord);

if(isset($row_RecordWebSiteKeyWord['name']))
{
	$Title_Word = $row_RecordWebSiteKeyWord['name'] . " - " . $SiteName;
}else {
	$Title_Word = $Lang_Title_WebSite . " - " . $SiteName;
}

if(isset($row_RecordWebSiteKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordWebSiteKeyWord['skeyword'];
}else {
	$Title_Keyword = $SiteKeyWord;
}

if(isset($row_RecordWebSiteKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordWebSiteKeyWord['sdescription'];
}else {
	$Title_Desc = $SiteDesc;
}

mysqli_free_result($RecordWebSiteKeyWord);
?>
