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

$collang_RecordArticleViewLine_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordArticleViewLine_l1 = $_GET['lang'];
}
$coluserid_RecordArticleViewLine_l1 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordArticleViewLine_l1 = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordArticleViewLine_l1 = sprintf("SELECT * FROM demo_articleitem WHERE list_id = 1 && lang = %s && indicate = '1' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordArticleViewLine_l1, "text"),GetSQLValueString($coluserid_RecordArticleViewLine_l1, "int"));
$RecordArticleViewLine_l1 = mysqli_query($DB_Conn, $query_RecordArticleViewLine_l1) or die(mysqli_error($DB_Conn));
$row_RecordArticleViewLine_l1 = mysqli_fetch_assoc($RecordArticleViewLine_l1);
$totalRows_RecordArticleViewLine_l1 = mysqli_num_rows($RecordArticleViewLine_l1);

$colname_RecordarticleKeyWord = "-1";
if (isset($_GET['id'])) {
  $colname_RecordarticleKeyWord = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordarticleKeyWord = sprintf("SELECT title, sdescription, skeyword, content, ogtitle, ogtype, ogurl, ogimage, ogdescription FROM demo_article WHERE id = %s", GetSQLValueString($colname_RecordarticleKeyWord, "int"));
$RecordarticleKeyWord = mysqli_query($DB_Conn, $query_RecordarticleKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordarticleKeyWord = mysqli_fetch_assoc($RecordarticleKeyWord);
$totalRows_RecordarticleKeyWord = mysqli_num_rows($RecordarticleKeyWord);

if (isset($_GET['type1'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordArticleViewLine_l1['item_id'], $_GET['type1']))) { $Now_Type_Mobile_Show_Title = $ViewLinetype1 =  $row_RecordArticleViewLine_l1['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordArticleViewLine_l1['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordArticleViewLine_l1['skeyword'];}
	} while ($row_RecordArticleViewLine_l1 = mysqli_fetch_assoc($RecordArticleViewLine_l1));
	$rows = mysqli_num_rows($RecordArticleViewLine_l1);
	  if($rows > 0) {
		  mysqli_data_seek($RecordArticleViewLine_l1, 0);
		  $row_RecordArticleViewLine_l1 = mysqli_fetch_assoc($RecordArticleViewLine_l1);
	  }
}
if (isset($_GET['type2'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordArticleViewLine_l1['item_id'], $_GET['type2']))) { $Now_Type_Mobile_Show_Title = $ViewLinetype2 =  $row_RecordArticleViewLine_l1['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordArticleViewLine_l1['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordArticleViewLine_l1['skeyword'];}
	} while ($row_RecordArticleViewLine_l1 = mysqli_fetch_assoc($RecordArticleViewLine_l1));
	$rows = mysqli_num_rows($RecordArticleViewLine_l1);
	  if($rows > 0) {
		  mysqli_data_seek($RecordArticleViewLine_l1, 0);
		  $row_RecordArticleViewLine_l1 = mysqli_fetch_assoc($RecordArticleViewLine_l1);
	  }
}
if (isset($_GET['type3'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordArticleViewLine_l1['item_id'], $_GET['type3']))) { $Now_Type_Mobile_Show_Title = $ViewLinetype3 =  $row_RecordArticleViewLine_l1['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordArticleViewLine_l1['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordArticleViewLine_l1['skeyword'];}
	} while ($row_RecordArticleViewLine_l1 = mysqli_fetch_assoc($RecordArticleViewLine_l1));
	$rows = mysqli_num_rows($RecordArticleViewLine_l1);
	  if($rows > 0) {
		  mysqli_data_seek($RecordArticleViewLine_l1, 0);
		  $row_RecordArticleViewLine_l1 = mysqli_fetch_assoc($RecordArticleViewLine_l1);
	  }
}

if(isset($row_RecordArticleKeyWord['title']))
{
	$Title_Word = $row_RecordArticleKeyWord['title'] . " - " . $SiteName;
}else {
	if(isset($Now_Type_Mobile_Show_Title)) {
		$Title_Word = $Now_Type_Mobile_Show_Title . " - " . $ModuleName['Article'] . " - " . $SiteName;
	}else{
		$Title_Word = $ModuleName['Article'] . " - " . $SiteName;
	}
}

if(isset($row_RecordArticleKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordArticleKeyWord['skeyword'];
}else {
	if(isset($Now_Type_Mobile_Show_skeyword)) {
		$Title_Keyword = $Now_Type_Mobile_Show_skeyword;
	}else{
		$Title_Keyword = $SiteKeyWord;
	}
}

if(isset($row_RecordArticleKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordArticleKeyWord['sdescription'];
}else {
	if(isset($Now_Type_Mobile_Show_sdescription)) {
		$Title_Desc = $Now_Type_Mobile_Show_sdescription;
	}else{
		$Title_Desc = mb_strimwidth(strip_tags(DeleteSpace($row_RecordArticleKeyWord['content'])),0,200,'......', 'UTF-8');
	}
}

if(isset($row_RecordArticleKeyWord['ogtitle']))
{
	$og_Title = $row_RecordArticleKeyWord['ogtitle'];
}else {
	$og_Title = $Title_Word;
}

if(isset($row_RecordArticleKeyWord['ogdescription']))
{
	$og_Description = $row_RecordArticleKeyWord['ogdescription'];
}else {
	$og_Description = $Title_Desc;
}

if(isset($row_RecordArticleKeyWord['ogtype']))
{
	$og_Type = $row_RecordArticleKeyWord['ogtype'];
}else {
	$og_Type = "website";
}

if(isset($row_RecordArticleKeyWord['ogurl']))
{
	$og_Url = $row_RecordArticleKeyWord['ogurl'];
}else {
	if($_SERVER['HTTP_HOST'] == "www.shop3500.com") { $og_Url = $SiteFileUrl . "/" . $_GET['wshop'];} else { $og_Url = "http://" . $_SERVER['HTTP_HOST'];}
}

if(isset($row_RecordArticleKeyWord['ogimage']))
{
	$og_Image = $SiteFileUrl . "/site/" . $_GET['wshop'] . "/image/seo/" . $row_RecordArticleKeyWord['ogimage'];
}else {
	if ($SiteFBShowImage != "") {
		$og_Image = $SiteFileUrl . "/site/" . $_GET['wshop'] . "/image/" . $SiteFBShowImage;
	}
}

mysqli_free_result($RecordarticleKeyWord);
?>
