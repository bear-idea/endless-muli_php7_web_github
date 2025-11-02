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

$colname_RecorddfpageKeyWord = "-1";
if (isset($_GET['id'])) {
  $colname_RecorddfpageKeyWord = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecorddfpageKeyWord = sprintf("SELECT title, sdescription, skeyword, content, ogtitle, ogtype, ogurl, ogimage, ogdescription FROM demo_dfpage WHERE id = %s", GetSQLValueString($colname_RecorddfpageKeyWord, "int"));
$RecorddfpageKeyWord = mysqli_query($DB_Conn, $query_RecorddfpageKeyWord) or die(mysqli_error($DB_Conn));
$row_RecorddfpageKeyWord = mysqli_fetch_assoc($RecorddfpageKeyWord);
$totalRows_RecorddfpageKeyWord = mysqli_num_rows($RecorddfpageKeyWord);

$colaid_RecorddfpageKeyWordType = "-1";
if (isset($_GET['aid'])) {
  $colaid_RecorddfpageKeyWordType = $_GET['aid'];
}
$colname_RecorddfpageKeyWordType = "-1";
if (isset($_GET['type1'])) {
  $colname_RecorddfpageKeyWordType = $_GET['type1'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecorddfpageKeyWordType = sprintf("SELECT title, sdescription, skeyword, content FROM demo_dfpage WHERE aid=%s && type1 = %s", GetSQLValueString($colaid_RecorddfpageKeyWordType, "int"), GetSQLValueString($colname_RecorddfpageKeyWordType, "int"));
$RecorddfpageKeyWordType = mysqli_query($DB_Conn, $query_RecorddfpageKeyWordType) or die(mysqli_error($DB_Conn));
$row_RecorddfpageKeyWordType = mysqli_fetch_assoc($RecorddfpageKeyWordType);
$totalRows_RecorddfpageKeyWordType = mysqli_num_rows($RecorddfpageKeyWordType);

$colaid_RecorddfpageKeyWordHome = "-1";
if (isset($_GET['aid'])) {
  $colaid_RecorddfpageKeyWordHome = $_GET['aid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecorddfpageKeyWordHome = sprintf("SELECT title, sdescription, skeyword, content FROM demo_dfpage WHERE aid=%s && home=1", GetSQLValueString($colaid_RecorddfpageKeyWordHome, "int"));
$RecorddfpageKeyWordHome = mysqli_query($DB_Conn, $query_RecorddfpageKeyWordHome) or die(mysqli_error($DB_Conn));
$row_RecorddfpageKeyWordHome = mysqli_fetch_assoc($RecorddfpageKeyWordHome);
$totalRows_RecorddfpageKeyWordHome = mysqli_num_rows($RecorddfpageKeyWordHome);

if(isset($_GET['id']))
{
	$Title_Word = $row_RecorddfpageKeyWord['title'] . " - " . $SiteName;
}else if(isset($_GET['type1'])){
	$Title_Word = $row_RecorddfpageKeyWordType['title'] . " - " . $SiteName;
}else{
	$Title_Word = $row_RecorddfpageKeyWordHome['title'] . " - " . $SiteName;
}

if(isset($row_RecorddfpageKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecorddfpageKeyWord['skeyword'];
}else {
	$Title_Keyword = $SiteKeyWord;
}

if(isset($row_RecorddfpageKeyWord['sdescription']))
{
	$Title_Desc = $row_RecorddfpageKeyWord['sdescription'];
}else {
	if(isset($_GET['id'])) {
		$Title_Desc = mb_strimwidth(strip_tags(DeleteSpace($row_RecorddfpageKeyWord['content'])),0,200,'......', 'UTF-8');
	}else if(isset($_GET['type1'])){
		$Title_Desc = mb_strimwidth(strip_tags(DeleteSpace($row_RecorddfpageKeyWordType['content'])),0,200,'......', 'UTF-8');
    }else{
		$Title_Desc = mb_strimwidth(strip_tags(DeleteSpace($row_RecorddfpageKeyWordHome['content'])),0,200,'......', 'UTF-8');
	}
}

if(isset($row_RecorddfpageKeyWord['ogtitle']))
{
	$og_Title = $row_RecorddfpageKeyWord['ogtitle'];
}else {
	$og_Title = $Title_Word;
}

if(isset($row_RecorddfpageKeyWord['ogdescription']))
{
	$og_Description = $row_RecorddfpageKeyWord['ogdescription'];
}else {
	$og_Description = $Title_Desc;
}

if(isset($row_RecorddfpageKeyWord['ogtype']))
{
	$og_Type = $row_RecorddfpageKeyWord['ogtype'];
}else {
	$og_Type = "website";
}

if(isset($row_RecorddfpageKeyWord['ogurl']))
{
	$og_Url = $row_RecorddfpageKeyWord['ogurl'];
}else {
	if($_SERVER['HTTP_HOST'] == "www.shop3500.com") { $og_Url = $SiteFileUrl . "/" . $_GET['wshop'];} else { $og_Url = "http://" . $_SERVER['HTTP_HOST'];}
}

if(isset($row_RecorddfpageKeyWord['ogimage']))
{
	$og_Image = $SiteFileUrl . "/site/" . $_GET['wshop'] . "/image/seo/" . $row_RecorddfpageKeyWord['ogimage'];
}else {
	if ($SiteFBShowImage != "") {
		$og_Image = $SiteFileUrl . "/site/" . $_GET['wshop'] . "/image/" . $SiteFBShowImage;
	}
}

mysqli_free_result($RecorddfpageKeyWord);

mysqli_free_result($RecorddfpageKeyWordHome);

mysqli_free_result($RecorddfpageKeyWordType);
?>
