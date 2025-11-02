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

$collang_RecordCatalogViewLine = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordCatalogViewLine = $_GET['lang'];
}
$coluserid_RecordCatalogViewLine = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordCatalogViewLine = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCatalogViewLine = sprintf("SELECT * FROM demo_catalogitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($collang_RecordCatalogViewLine, "text"),GetSQLValueString($coluserid_RecordCatalogViewLine, "int"));
$RecordCatalogViewLine = mysqli_query($DB_Conn, $query_RecordCatalogViewLine) or die(mysqli_error($DB_Conn));
$row_RecordCatalogViewLine = mysqli_fetch_assoc($RecordCatalogViewLine);
$totalRows_RecordCatalogViewLine = mysqli_num_rows($RecordCatalogViewLine);

$colname_RecordCatalogKeyWord = "-1";
if (isset($_GET['id'])) {
  $colname_RecordCatalogKeyWord = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCatalogKeyWord = sprintf("SELECT title, sdescription, skeyword FROM demo_catalog WHERE id = %s", GetSQLValueString($colname_RecordCatalogKeyWord, "int"));
$RecordCatalogKeyWord = mysqli_query($DB_Conn, $query_RecordCatalogKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordCatalogKeyWord = mysqli_fetch_assoc($RecordCatalogKeyWord);
$totalRows_RecordCatalogKeyWord = mysqli_num_rows($RecordCatalogKeyWord);

if (isset($_GET['searchkey'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordCatalogViewLine['itemname'], urldecode($_GET['searchkey'])))) { $Now_Type_Mobile_Show_Title = $ViewLinetype =  $row_RecordCatalogViewLine['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordCatalogViewLine['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordCatalogViewLine['skeyword'];}
	} while ($row_RecordCatalogViewLine = mysqli_fetch_assoc($RecordCatalogViewLine));
			  $rows = mysqli_num_rows($RecordCatalogViewLine);
			  if($rows > 0) {
				  mysqli_data_seek($RecordCatalogViewLine, 0);
				  $row_RecordCatalogViewLine = mysqli_fetch_assoc($RecordCatalogViewLine);
			  }
}

if(isset($row_RecordCatalogKeyWord['title']))
{
	$Title_Word = $row_RecordCatalogKeyWord['title'] . " - " . $SiteName;
}else {
	if(isset($Now_Type_Mobile_Show_Title)) {
		$Title_Word = $Now_Type_Mobile_Show_Title . " - " . $ModuleName['Catalog'] . " - " . $SiteName;
	}else{
		$Title_Word = $ModuleName['Catalog'] . " - " . $SiteName;
	}
}

if(isset($row_RecordCatalogKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordCatalogKeyWord['skeyword'];
}else {
	if(isset($Now_Type_Mobile_Show_skeyword)) {
		$Title_Keyword = $Now_Type_Mobile_Show_skeyword;
	}else{
		$Title_Keyword = $SiteKeyWord;
	}
}

if(isset($row_RecordCatalogKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordCatalogKeyWord['sdescription'];
}else {
	if(isset($Now_Type_Mobile_Show_sdescription)) {
		$Title_Desc = $Now_Type_Mobile_Show_sdescription;
	}else{
		$Title_Desc = mb_strimwidth(strip_tags(DeleteSpace($row_RecordCatalogKeyWord['content'])),0,200,'......', 'UTF-8');
	}
}

mysqli_free_result($RecordCatalogKeyWord);
?>
