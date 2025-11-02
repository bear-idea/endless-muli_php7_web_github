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

$colname_RecordBlogKeyWord = "-1";
if (isset($_GET['id'])) {
  $colname_RecordBlogKeyWord = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordBlogKeyWord = sprintf("SELECT title, sdescription, skeyword FROM demo_blog WHERE id = %s", GetSQLValueString($colname_RecordBlogKeyWord, "int"));
$RecordBlogKeyWord = mysqli_query($DB_Conn, $query_RecordBlogKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordBlogKeyWord = mysqli_fetch_assoc($RecordBlogKeyWord);
$totalRows_RecordBlogKeyWord = mysqli_num_rows($RecordBlogKeyWord);

if(isset($row_RecordBlogKeyWord['title']))
{
	$Title_Word = $row_RecordBlogKeyWord['title'] . " - " . $SiteName;
}else {
	$Title_Word = $Lang_Title_Blog . " - " . $SiteName;
}

if(isset($row_RecordBlogKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordBlogKeyWord['skeyword'];
}else {
	$Title_Keyword = $SiteKeyWord;
}

if(isset($row_RecordBlogKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordBlogKeyWord['sdescription'];
}else {
	$Title_Desc = $SiteDesc;
}

mysqli_free_result($RecordBlogKeyWord);
?>
