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

$collang_RecordAboutViewLine_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordAboutViewLine_l1 = $_GET['lang'];
}
$coluserid_RecordAboutViewLine_l1 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordAboutViewLine_l1 = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAboutViewLine_l1 = sprintf("SELECT * FROM demo_aboutitem WHERE list_id = 1 && lang = %s && level = '0' && indicate = '1' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordAboutViewLine_l1, "text"),GetSQLValueString($coluserid_RecordAboutViewLine_l1, "int"));
$RecordAboutViewLine_l1 = mysqli_query($DB_Conn, $query_RecordAboutViewLine_l1) or die(mysqli_error($DB_Conn));
$row_RecordAboutViewLine_l1 = mysqli_fetch_assoc($RecordAboutViewLine_l1);
$totalRows_RecordAboutViewLine_l1 = mysqli_num_rows($RecordAboutViewLine_l1);

$colname_RecordAboutKeyWord = "-1";
if (isset($_GET['id'])) {
  $colname_RecordAboutKeyWord = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAboutKeyWord = sprintf("SELECT title, sdescription, skeyword, content, ogtitle, ogtype, ogurl, ogimage, ogdescription FROM demo_about WHERE id = %s", GetSQLValueString($colname_RecordAboutKeyWord, "int"));
$RecordAboutKeyWord = mysqli_query($DB_Conn, $query_RecordAboutKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordAboutKeyWord = mysqli_fetch_assoc($RecordAboutKeyWord);
$totalRows_RecordAboutKeyWord = mysqli_num_rows($RecordAboutKeyWord);

$Now_Type_Mobile_Show_Title = $row_RecordAboutKeyWord['title'];
$Now_Type_Mobile_Show_skeyword = $row_RecordAboutKeyWord['skeyword'];
$Now_Type_Mobile_Show_sdescription = $row_RecordAboutKeyWord['sdescription'];

if(isset($row_RecordAboutKeyWord['title']))
{
	$Title_Word = $row_RecordAboutKeyWord['title'] . " - " . $SiteName;
}else {
	$Title_Word = $ModuleName['About'] . " - " . $SiteName;
}

if(isset($row_RecordAboutKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordAboutKeyWord['skeyword'];
}else {
	$Title_Keyword = $SiteKeyWord;
}

if(isset($_GET['id'])) {
	if(isset($row_RecordAboutKeyWord['sdescription']))
	{
		$Title_Desc = $row_RecordAboutKeyWord['sdescription'];
	}else {
		$Title_Desc = mb_strimwidth(strip_tags(DeleteSpace($row_RecordAboutKeyWord['content'])),0,200,'......', 'UTF-8');
	}
}else {
	if(isset($row_RecordAboutKeyWord['sdescription']))
	{
		$Title_Desc = $row_RecordAboutKeyWord['sdescription'];
	}else {
		$Title_Desc = $Title_Desc = $SiteDesc;
	}
}

if(isset($row_RecordAboutKeyWord['ogtitle']))
{
	$og_Title = $row_RecordAboutKeyWord['ogtitle'];
}else {
	$og_Title = $Title_Word;
}

if(isset($row_RecordAboutKeyWord['ogdescription']))
{
	$og_Description = $row_RecordAboutKeyWord['ogdescription'];
}else {
	$og_Description = $Title_Desc;
}

if(isset($row_RecordAboutKeyWord['ogtype']))
{
	$og_Type = $row_RecordAboutKeyWord['ogtype'];
}else {
	$og_Type = "website";
}

if(isset($row_RecordAboutKeyWord['ogurl']))
{
	$og_Url = $row_RecordAboutKeyWord['ogurl'];
}else {
	if($_SERVER['HTTP_HOST'] == "www.shop3500.com") { $og_Url = $SiteFileUrl . "/" . $_GET['wshop'];} else { $og_Url = "http://" . $_SERVER['HTTP_HOST'];}
}

if(isset($row_RecordAboutKeyWord['ogimage']))
{
	$og_Image = $SiteFileUrl . "/site/" . $_GET['wshop'] . "/image/seo/" . $row_RecordAboutKeyWord['ogimage'];
}else {
	if ($SiteFBShowImage != "") {
		$og_Image = $SiteFileUrl . "/site/" . $_GET['wshop'] . "/image/" . $SiteFBShowImage;
	}
}

mysqli_free_result($RecordAboutKeyWord);
?>
