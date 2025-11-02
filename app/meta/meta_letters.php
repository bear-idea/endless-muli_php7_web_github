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

$collang_RecordLettersViewLine = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordLettersViewLine = $_GET['lang'];
}
$coluserid_RecordLettersViewLine = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordLettersViewLine = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordLettersViewLine = sprintf("SELECT * FROM demo_lettersitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($collang_RecordLettersViewLine, "text"),GetSQLValueString($coluserid_RecordLettersViewLine, "int"));
$RecordLettersViewLine = mysqli_query($DB_Conn, $query_RecordLettersViewLine) or die(mysqli_error($DB_Conn));
$row_RecordLettersViewLine = mysqli_fetch_assoc($RecordLettersViewLine);
$totalRows_RecordLettersViewLine = mysqli_num_rows($RecordLettersViewLine);

$colname_RecordLettersKeyWord = "-1";
if (isset($_GET['id'])) {
  $colname_RecordLettersKeyWord = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordLettersKeyWord = sprintf("SELECT title, sdescription, skeyword, content, ogtitle, ogtype, ogurl, ogimage, ogdescription FROM demo_letters WHERE id = %s", GetSQLValueString($colname_RecordLettersKeyWord, "int"));
$RecordLettersKeyWord = mysqli_query($DB_Conn, $query_RecordLettersKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordLettersKeyWord = mysqli_fetch_assoc($RecordLettersKeyWord);
$totalRows_RecordLettersKeyWord = mysqli_num_rows($RecordLettersKeyWord);

if (isset($_GET['searchkey'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordLettersViewLine['itemname'], urldecode($_GET['searchkey'])))) { $Now_Type_Mobile_Show_Title = $ViewLinetype =  $row_RecordLettersViewLine['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordLettersViewLine['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordLettersViewLine['skeyword'];}
	} while ($row_RecordLettersViewLine = mysqli_fetch_assoc($RecordLettersViewLine));
			  $rows = mysqli_num_rows($RecordLettersViewLine);
			  if($rows > 0) {
				  mysqli_data_seek($RecordLettersViewLine, 0);
				  $row_RecordLettersViewLine = mysqli_fetch_assoc($RecordLettersViewLine);
			  }
}

if(isset($row_RecordLettersKeyWord['title']))
{
	$Title_Word = $row_RecordLettersKeyWord['title'] . " - " . $SiteName;
}else {
	if(isset($Now_Type_Mobile_Show_Title)) {
		$Title_Word = $Now_Type_Mobile_Show_Title . " - " . $ModuleName['Letters'] . " - " . $SiteName;
	}else{
		$Title_Word = $ModuleName['Letters'] . " - " . $SiteName;
	}
}

if(isset($row_RecordLettersKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordLettersKeyWord['skeyword'];
}else {
	if(isset($Now_Type_Mobile_Show_skeyword)) {
		$Title_Keyword = $Now_Type_Mobile_Show_skeyword;
	}else{
		$Title_Keyword = $SiteKeyWord;
	}
}

if(isset($row_RecordLettersKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordLettersKeyWord['sdescription'];
}else {
	if(isset($Now_Type_Mobile_Show_sdescription)) {
		$Title_Desc = $Now_Type_Mobile_Show_sdescription;
	}else{
		$Title_Desc = mb_strimwidth(strip_tags(DeleteSpace($row_RecordLettersKeyWord['content'])),0,200,'......', 'UTF-8');
	}
}

if(isset($row_RecordLettersKeyWord['ogtitle']))
{
	$og_Title = $row_RecordLettersKeyWord['ogtitle'];
}else {
	$og_Title = $Title_Word;
}

if(isset($row_RecordLettersKeyWord['ogdescription']))
{
	$og_Description = $row_RecordLettersKeyWord['ogdescription'];
}else {
	$og_Description = $Title_Desc;
}

if(isset($row_RecordLettersKeyWord['ogtype']))
{
	$og_Type = $row_RecordLettersKeyWord['ogtype'];
}else {
	$og_Type = "website";
}

if(isset($row_RecordLettersKeyWord['ogurl']))
{
	$og_Url = $row_RecordLettersKeyWord['ogurl'];
}else {
	if($_SERVER['HTTP_HOST'] == "www.shop3500.com") { $og_Url = $SiteFileUrl . "/" . $_GET['wshop'];} else { $og_Url = "http://" . $_SERVER['HTTP_HOST'];}
}

if(isset($row_RecordLettersKeyWord['ogimage']))
{
	$og_Image = $SiteFileUrl . "/site/" . $_GET['wshop'] . "/image/seo/" . $row_RecordLettersKeyWord['ogimage'];
}else {
	if ($SiteFBShowImage != "") {
		$og_Image = $SiteFileUrl . "/site/" . $_GET['wshop'] . "/image/" . $SiteFBShowImage;
	}
}

mysqli_free_result($RecordLettersKeyWord);
?>
