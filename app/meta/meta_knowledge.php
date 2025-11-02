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

$collang_RecordKnowledgeViewLine_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordKnowledgeViewLine_l1 = $_GET['lang'];
}
$coluserid_RecordKnowledgeViewLine_l1 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordKnowledgeViewLine_l1 = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordKnowledgeViewLine_l1 = sprintf("SELECT * FROM demo_knowledgeitem WHERE list_id = 1 && lang = %s && indicate = '1' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordKnowledgeViewLine_l1, "text"),GetSQLValueString($coluserid_RecordKnowledgeViewLine_l1, "int"));
$RecordKnowledgeViewLine_l1 = mysqli_query($DB_Conn, $query_RecordKnowledgeViewLine_l1) or die(mysqli_error($DB_Conn));
$row_RecordKnowledgeViewLine_l1 = mysqli_fetch_assoc($RecordKnowledgeViewLine_l1);
$totalRows_RecordKnowledgeViewLine_l1 = mysqli_num_rows($RecordKnowledgeViewLine_l1);

$colname_RecordKnowledgeKeyWord = "-1";
if (isset($_GET['id'])) {
  $colname_RecordKnowledgeKeyWord = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordKnowledgeKeyWord = sprintf("SELECT name, sdescription, skeyword, content, ogtitle, ogtype, ogurl, ogimage, ogdescription FROM demo_knowledge WHERE id = %s", GetSQLValueString($colname_RecordKnowledgeKeyWord, "int"));
$RecordKnowledgeKeyWord = mysqli_query($DB_Conn, $query_RecordKnowledgeKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordKnowledgeKeyWord = mysqli_fetch_assoc($RecordKnowledgeKeyWord);
$totalRows_RecordKnowledgeKeyWord = mysqli_num_rows($RecordKnowledgeKeyWord);

if (isset($_GET['type1'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordKnowledgeViewLine_l1['item_id'], $_GET['type1']))) { $Now_Type_Mobile_Show_Title = $ViewLinetype1 =  $row_RecordKnowledgeViewLine_l1['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordKnowledgeViewLine_l1['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordKnowledgeViewLine_l1['skeyword'];}
	} while ($row_RecordKnowledgeViewLine_l1 = mysqli_fetch_assoc($RecordKnowledgeViewLine_l1));
	$rows = mysqli_num_rows($RecordKnowledgeViewLine_l1);
	  if($rows > 0) {
		  mysqli_data_seek($RecordKnowledgeViewLine_l1, 0);
		  $row_RecordKnowledgeViewLine_l1 = mysqli_fetch_assoc($RecordKnowledgeViewLine_l1);
	  }
}
if (isset($_GET['type2'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordKnowledgeViewLine_l1['item_id'], $_GET['type2']))) { $Now_Type_Mobile_Show_Title = $ViewLinetype2 =  $row_RecordKnowledgeViewLine_l1['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordKnowledgeViewLine_l1['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordKnowledgeViewLine_l1['skeyword'];}
	} while ($row_RecordKnowledgeViewLine_l1 = mysqli_fetch_assoc($RecordKnowledgeViewLine_l1));
	$rows = mysqli_num_rows($RecordKnowledgeViewLine_l1);
	  if($rows > 0) {
		  mysqli_data_seek($RecordKnowledgeViewLine_l1, 0);
		  $row_RecordKnowledgeViewLine_l1 = mysqli_fetch_assoc($RecordKnowledgeViewLine_l1);
	  }
}
if (isset($_GET['type3'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordKnowledgeViewLine_l1['item_id'], $_GET['type3']))) { $Now_Type_Mobile_Show_Title = $ViewLinetype3 =  $row_RecordKnowledgeViewLine_l1['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordKnowledgeViewLine_l1['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordKnowledgeViewLine_l1['skeyword'];}
	} while ($row_RecordKnowledgeViewLine_l1 = mysqli_fetch_assoc($RecordKnowledgeViewLine_l1));
	$rows = mysqli_num_rows($RecordKnowledgeViewLine_l1);
	  if($rows > 0) {
		  mysqli_data_seek($RecordKnowledgeViewLine_l1, 0);
		  $row_RecordKnowledgeViewLine_l1 = mysqli_fetch_assoc($RecordKnowledgeViewLine_l1);
	  }
}

if(isset($row_RecordKnowledgeKeyWord['name']))
{
	$Title_Word = $row_RecordKnowledgeKeyWord['name'] . " - " . $SiteName;
}else {
	if(isset($Now_Type_Mobile_Show_Title)) {
		$Title_Word = $Now_Type_Mobile_Show_Title . " - " . $ModuleName['Knowledge'] . " - " . $SiteName;
	}else{
		$Title_Word = $ModuleName['Knowledge'] . " - " . $SiteName;
	}
}

if(isset($row_RecordKnowledgeKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordKnowledgeKeyWord['skeyword'];
}else {
	if(isset($Now_Type_Mobile_Show_skeyword)) {
		$Title_Keyword = $Now_Type_Mobile_Show_skeyword;
	}else{
		$Title_Keyword = $SiteKeyWord;
	}
}

if(isset($row_RecordKnowledgeKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordKnowledgeKeyWord['sdescription'];
}else {
	if(isset($Now_Type_Mobile_Show_sdescription)) {
		$Title_Desc = $Now_Type_Mobile_Show_sdescription;
	}else{
		$Title_Desc = mb_strimwidth(strip_tags(DeleteSpace($row_RecordKnowledgeKeyWord['content'])),0,200,'......', 'UTF-8');
	}
}

if(isset($row_RecordKnowledgeKeyWord['ogtitle']))
{
	$og_Title = $row_RecordKnowledgeKeyWord['ogtitle'];
}else {
	$og_Title = $Title_Word;
}

if(isset($row_RecordKnowledgeKeyWord['ogdescription']))
{
	$og_Description = $row_RecordKnowledgeKeyWord['ogdescription'];
}else {
	$og_Description = $Title_Desc;
}

if(isset($row_RecordKnowledgeKeyWord['ogtype']))
{
	$og_Type = $row_RecordKnowledgeKeyWord['ogtype'];
}else {
	$og_Type = "website";
}

if(isset($row_RecordKnowledgeKeyWord['ogurl']))
{
	$og_Url = $row_RecordKnowledgeKeyWord['ogurl'];
}else {
	if($_SERVER['HTTP_HOST'] == "www.shop3500.com") { $og_Url = $SiteFileUrl . "/" . $_GET['wshop'];} else { $og_Url = "http://" . $_SERVER['HTTP_HOST'];}
}

if(isset($row_RecordKnowledgeKeyWord['ogimage']))
{
	$og_Image = $SiteFileUrl . "/site/" . $_GET['wshop'] . "/image/seo/" . $row_RecordKnowledgeKeyWord['ogimage'];
}else {
	if ($SiteFBShowImage != "") {
		$og_Image = $SiteFileUrl . "/site/" . $_GET['wshop'] . "/image/" . $SiteFBShowImage;
	}
}

mysqli_free_result($RecordKnowledgeKeyWord);
?>
