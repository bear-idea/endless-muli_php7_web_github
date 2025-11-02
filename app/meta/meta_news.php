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

$collang_RecordNewsViewLine = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordNewsViewLine = $_GET['lang'];
}
$coluserid_RecordNewsViewLine = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordNewsViewLine = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNewsViewLine = sprintf("SELECT * FROM demo_newsitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($collang_RecordNewsViewLine, "text"),GetSQLValueString($coluserid_RecordNewsViewLine, "int"));
$RecordNewsViewLine = mysqli_query($DB_Conn, $query_RecordNewsViewLine) or die(mysqli_error($DB_Conn));
$row_RecordNewsViewLine = mysqli_fetch_assoc($RecordNewsViewLine);
$totalRows_RecordNewsViewLine = mysqli_num_rows($RecordNewsViewLine);

$colname_RecordNewsKeyWord = "-1";
if (isset($_GET['id'])) {
  $colname_RecordNewsKeyWord = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNewsKeyWord = sprintf("SELECT title, sdescription, skeyword, content, ogtitle, ogtype, ogurl, ogimage, ogdescription FROM demo_news WHERE id = %s", GetSQLValueString($colname_RecordNewsKeyWord, "int"));
$RecordNewsKeyWord = mysqli_query($DB_Conn, $query_RecordNewsKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordNewsKeyWord = mysqli_fetch_assoc($RecordNewsKeyWord);
$totalRows_RecordNewsKeyWord = mysqli_num_rows($RecordNewsKeyWord);

if (isset($_GET['searchkey'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordNewsViewLine['itemname'], urldecode($_GET['searchkey'])))) { $Now_Type_Mobile_Show_Title = $ViewLinetype =  $row_RecordNewsViewLine['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordNewsViewLine['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordNewsViewLine['skeyword'];}
	} while ($row_RecordNewsViewLine = mysqli_fetch_assoc($RecordNewsViewLine));
			  $rows = mysqli_num_rows($RecordNewsViewLine);
			  if($rows > 0) {
				  mysqli_data_seek($RecordNewsViewLine, 0);
				  $row_RecordNewsViewLine = mysqli_fetch_assoc($RecordNewsViewLine);
			  }
}

if(isset($row_RecordNewsKeyWord['title']))
{
	$Title_Word = $row_RecordNewsKeyWord['title'] . " - " . $SiteName;
}else {
	if(isset($Now_Type_Mobile_Show_Title)) {
		$Title_Word = $Now_Type_Mobile_Show_Title . " - " . $ModuleName['News'] . " - " . $SiteName;
	}else{
		$Title_Word = $ModuleName['News'] . " - " . $SiteName;
	}
}

if(isset($row_RecordNewsKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordNewsKeyWord['skeyword'];
}else {
	if(isset($Now_Type_Mobile_Show_skeyword)) {
		$Title_Keyword = $Now_Type_Mobile_Show_skeyword;
	}else{
		$Title_Keyword = $SiteKeyWord;
	}
}

if(isset($row_RecordNewsKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordNewsKeyWord['sdescription'];
}else {
	if(isset($Now_Type_Mobile_Show_sdescription)) {
		$Title_Desc = $Now_Type_Mobile_Show_sdescription;
	}else{
		$Title_Desc = mb_strimwidth(strip_tags(DeleteSpace($row_RecordNewsKeyWord['content'])),0,200,'......', 'UTF-8');
	}
}

if(isset($row_RecordNewsKeyWord['ogtitle']))
{
	$og_Title = $row_RecordNewsKeyWord['ogtitle'];
}else {
	$og_Title = $Title_Word;
}

if(isset($row_RecordNewsKeyWord['ogdescription']))
{
	$og_Description = $row_RecordNewsKeyWord['ogdescription'];
}else {
	$og_Description = $Title_Desc;
}

if(isset($row_RecordNewsKeyWord['ogtype']))
{
	$og_Type = $row_RecordNewsKeyWord['ogtype'];
}else {
	$og_Type = "website";
}

if(isset($row_RecordNewsKeyWord['ogurl']))
{
	$og_Url = $row_RecordNewsKeyWord['ogurl'];
}else {
	if($_SERVER['HTTP_HOST'] == "www.shop3500.com") { $og_Url = $SiteFileUrl . "/" . $_GET['wshop'];} else { $og_Url = "http://" . $_SERVER['HTTP_HOST'];}
}

if(isset($row_RecordNewsKeyWord['ogimage']))
{
	$og_Image = $SiteFileUrl . "/site/" . $_GET['wshop'] . "/image/seo/" . $row_RecordNewsKeyWord['ogimage'];
}else {
	if ($SiteFBShowImage != "") {
		$og_Image = $SiteFileUrl . "/site/" . $_GET['wshop'] . "/image/" . $SiteFBShowImage;
	}
}

mysqli_free_result($RecordNewsKeyWord);
?>
