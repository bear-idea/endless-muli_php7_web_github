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

$collang_RecordProductViewLine_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordProductViewLine_l1 = $_GET['lang'];
}
$coluserid_RecordProductViewLine_l1 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordProductViewLine_l1 = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductViewLine_l1 = sprintf("SELECT * FROM demo_productitem WHERE list_id = 1 && lang = %s && indicate = '1' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordProductViewLine_l1, "text"),GetSQLValueString($coluserid_RecordProductViewLine_l1, "int"));
$RecordProductViewLine_l1 = mysqli_query($DB_Conn, $query_RecordProductViewLine_l1) or die(mysqli_error($DB_Conn));
$row_RecordProductViewLine_l1 = mysqli_fetch_assoc($RecordProductViewLine_l1);
$totalRows_RecordProductViewLine_l1 = mysqli_num_rows($RecordProductViewLine_l1);

$colname_RecordProductKeyWord = "-1";
if (isset($_GET['id'])) {
  $colname_RecordProductKeyWord = $_GET['id'];
}
$coluserid_RecordProduct = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordProduct = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductKeyWord = sprintf("SELECT name, sdescription, skeyword, content, ogtitle, ogtype, ogurl, ogimage, ogdescription FROM demo_product WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordProductKeyWord, "int"),GetSQLValueString($coluserid_RecordProduct, "int"));
$RecordProductKeyWord = mysqli_query($DB_Conn, $query_RecordProductKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordProductKeyWord = mysqli_fetch_assoc($RecordProductKeyWord);
$totalRows_RecordProductKeyWord = mysqli_num_rows($RecordProductKeyWord);

if (isset($_GET['type1'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordProductViewLine_l1['item_id'], $_GET['type1']))) { $Now_Type_Mobile_Show_Title = $ViewLinetype1 =  $row_RecordProductViewLine_l1['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordProductViewLine_l1['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordProductViewLine_l1['skeyword'];}
	} while ($row_RecordProductViewLine_l1 = mysqli_fetch_assoc($RecordProductViewLine_l1));
	$rows = mysqli_num_rows($RecordProductViewLine_l1);
	  if($rows > 0) {
		  mysqli_data_seek($RecordProductViewLine_l1, 0);
		  $row_RecordProductViewLine_l1 = mysqli_fetch_assoc($RecordProductViewLine_l1);
	  }
}
if (isset($_GET['type2'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordProductViewLine_l1['item_id'], $_GET['type2']))) { $Now_Type_Mobile_Show_Title = $ViewLinetype2 =  $row_RecordProductViewLine_l1['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordProductViewLine_l1['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordProductViewLine_l1['skeyword'];}
	} while ($row_RecordProductViewLine_l1 = mysqli_fetch_assoc($RecordProductViewLine_l1));
	$rows = mysqli_num_rows($RecordProductViewLine_l1);
	  if($rows > 0) {
		  mysqli_data_seek($RecordProductViewLine_l1, 0);
		  $row_RecordProductViewLine_l1 = mysqli_fetch_assoc($RecordProductViewLine_l1);
	  }
}
if (isset($_GET['type3'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordProductViewLine_l1['item_id'], $_GET['type3']))) { $Now_Type_Mobile_Show_Title = $ViewLinetype3 =  $row_RecordProductViewLine_l1['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordProductViewLine_l1['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordProductViewLine_l1['skeyword'];}
	} while ($row_RecordProductViewLine_l1 = mysqli_fetch_assoc($RecordProductViewLine_l1));
	$rows = mysqli_num_rows($RecordProductViewLine_l1);
	  if($rows > 0) {
		  mysqli_data_seek($RecordProductViewLine_l1, 0);
		  $row_RecordProductViewLine_l1 = mysqli_fetch_assoc($RecordProductViewLine_l1);
	  }
}

if(isset($row_RecordProductKeyWord['name']))
{
	$Title_Word = $row_RecordProductKeyWord['name'] . " - " . $SiteName;
}else {
	if(isset($Now_Type_Mobile_Show_Title)) {
		$Title_Word = $Now_Type_Mobile_Show_Title . " - " . $ModuleName['Product'] . " - " . $SiteName;
	}else{
		$Title_Word = $ModuleName['Product'] . " - " . $SiteName;
	}
}

if(isset($row_RecordProductKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordProductKeyWord['skeyword'];
}else {
	if(isset($Now_Type_Mobile_Show_skeyword)) {
		$Title_Keyword = $Now_Type_Mobile_Show_skeyword;
	}else{
		$Title_Keyword = $SiteKeyWord;
	}
}

if(isset($row_RecordProductKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordProductKeyWord['sdescription'];
}else {
	if(isset($Now_Type_Mobile_Show_sdescription)) {
		$Title_Desc = $Now_Type_Mobile_Show_sdescription;
	}else{
		$Title_Desc = mb_strimwidth(strip_tags(DeleteSpace($row_RecordProductKeyWord['content'])),0,200,'......', 'UTF-8');
	}
}

if(isset($row_RecordProductKeyWord['ogtitle']))
{
	$og_Title = $row_RecordProductKeyWord['ogtitle'];
}else {
	$og_Title = $Title_Word;
}

if(isset($row_RecordProductKeyWord['ogdescription']))
{
	$og_Description = $row_RecordProductKeyWord['ogdescription'];
}else {
	$og_Description = $Title_Desc;
}

if(isset($row_RecordProductKeyWord['ogtype']))
{
	$og_Type = $row_RecordProductKeyWord['ogtype'];
}else {
	$og_Type = "website";
}

if(isset($row_RecordProductKeyWord['ogurl']))
{
	$og_Url = $row_RecordProductKeyWord['ogurl'];
}else {
	if($_SERVER['HTTP_HOST'] == "www.shop3500.com") { $og_Url = $SiteFileUrl . "/" . $_GET['wshop'];} else { $og_Url = "http://" . $_SERVER['HTTP_HOST'];}
}

if(isset($row_RecordProductKeyWord['ogimage']))
{
	$og_Image = $SiteFileUrl . "/site/" . $_GET['wshop'] . "/image/seo/" . $row_RecordProductKeyWord['ogimage'];
}else {
	if ($SiteFBShowImage != "") {
		$og_Image = $SiteFileUrl . "/site/" . $_GET['wshop'] . "/image/" . $SiteFBShowImage;
	}
}

mysqli_free_result($RecordProductKeyWord);
?>
