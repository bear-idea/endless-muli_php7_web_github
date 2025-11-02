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

$collang_RecordPublishViewLine = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordPublishViewLine = $_GET['lang'];
}
$coluserid_RecordPublishViewLine = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordPublishViewLine = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPublishViewLine = sprintf("SELECT * FROM demo_publishitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($collang_RecordPublishViewLine, "text"),GetSQLValueString($coluserid_RecordPublishViewLine, "int"));
$RecordPublishViewLine = mysqli_query($DB_Conn, $query_RecordPublishViewLine) or die(mysqli_error($DB_Conn));
$row_RecordPublishViewLine = mysqli_fetch_assoc($RecordPublishViewLine);
$totalRows_RecordPublishViewLine = mysqli_num_rows($RecordPublishViewLine);

$colname_RecordPublishKeyWord = "-1";
if (isset($_GET['id'])) {
  $colname_RecordPublishKeyWord = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPublishKeyWord = sprintf("SELECT title, sdescription, skeyword, content, ogtitle, ogtype, ogurl, ogimage, ogdescription FROM demo_publish WHERE id = %s", GetSQLValueString($colname_RecordPublishKeyWord, "int"));
$RecordPublishKeyWord = mysqli_query($DB_Conn, $query_RecordPublishKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordPublishKeyWord = mysqli_fetch_assoc($RecordPublishKeyWord);
$totalRows_RecordPublishKeyWord = mysqli_num_rows($RecordPublishKeyWord);

if (isset($_GET['type'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordPublishViewLine['itemname'], urldecode($_GET['type'])))) { $Now_Type_Mobile_Show_Title = $ViewLinetype =  $row_RecordPublishViewLine['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordPublishViewLine['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordPublishViewLine['skeyword'];}
	} while ($row_RecordPublishViewLine = mysqli_fetch_assoc($RecordPublishViewLine));
			  $rows = mysqli_num_rows($RecordPublishViewLine);
			  if($rows > 0) {
				  mysqli_data_seek($RecordPublishViewLine, 0);
				  $row_RecordPublishViewLine = mysqli_fetch_assoc($RecordPublishViewLine);
			  }
}

if(isset($row_RecordPublishKeyWord['title']))
{
	$Title_Word = $row_RecordPublishKeyWord['title'] . " - " . $SiteName;
}else {
	if(isset($Now_Type_Mobile_Show_Title)) {
		$Title_Word = $Now_Type_Mobile_Show_Title . " - " . $ModuleName['Publish'] . " - " . $SiteName;
	}else{
		$Title_Word = $ModuleName['Publish'] . " - " . $SiteName;
	}
}

if(isset($row_RecordPublishKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordPublishKeyWord['skeyword'];
}else {
	if(isset($Now_Type_Mobile_Show_skeyword)) {
		$Title_Keyword = $Now_Type_Mobile_Show_skeyword;
	}else{
		$Title_Keyword = $SiteKeyWord;
	}
}

if(isset($row_RecordPublishKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordPublishKeyWord['sdescription'];
}else {
	if(isset($Now_Type_Mobile_Show_sdescription)) {
		$Title_Desc = $Now_Type_Mobile_Show_sdescription;
	}else{
		$Title_Desc = mb_strimwidth(strip_tags(DeleteSpace($row_RecordPublishKeyWord['content'])),0,200,'......', 'UTF-8');
	}
}

if(isset($row_RecordPublishKeyWord['ogtitle']))
{
	$og_Title = $row_RecordPublishKeyWord['ogtitle'];
}else {
	$og_Title = $Title_Word;
}

if(isset($row_RecordPublishKeyWord['ogdescription']))
{
	$og_Description = $row_RecordPublishKeyWord['ogdescription'];
}else {
	$og_Description = $Title_Desc;
}

if(isset($row_RecordPublishKeyWord['ogtype']))
{
	$og_Type = $row_RecordPublishKeyWord['ogtype'];
}else {
	$og_Type = "website";
}

if(isset($row_RecordPublishKeyWord['ogurl']))
{
	$og_Url = $row_RecordPublishKeyWord['ogurl'];
}else {
	if($_SERVER['HTTP_HOST'] == "www.shop3500.com") { $og_Url = $SiteFileUrl . "/" . $_GET['wshop'];} else { $og_Url = "http://" . $_SERVER['HTTP_HOST'];}
}

if(isset($row_RecordPublishKeyWord['ogimage']))
{
	$og_Image = $SiteFileUrl . "/site/" . $_GET['wshop'] . "/image/seo/" . $row_RecordPublishKeyWord['ogimage'];
}else {
	if ($SiteFBShowImage != "") {
		$og_Image = $SiteFileUrl . "/site/" . $_GET['wshop'] . "/image/" . $SiteFBShowImage;
	}
}

mysqli_free_result($RecordPublishKeyWord);
?>
