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

$collang_RecordImageshowViewLine = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordImageshowViewLine = $_GET['lang'];
}
$coluserid_RecordImageshowViewLine = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordImageshowViewLine = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordImageshowViewLine = sprintf("SELECT * FROM demo_imageshowitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($collang_RecordImageshowViewLine, "text"),GetSQLValueString($coluserid_RecordImageshowViewLine, "int"));
$RecordImageshowViewLine = mysqli_query($DB_Conn, $query_RecordImageshowViewLine) or die(mysqli_error($DB_Conn));
$row_RecordImageshowViewLine = mysqli_fetch_assoc($RecordImageshowViewLine);
$totalRows_RecordImageshowViewLine = mysqli_num_rows($RecordImageshowViewLine);

$colname_RecordImageshowKeyWord = "-1";
if (isset($_GET['id'])) {
  $colname_RecordImageshowKeyWord = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordImageshowKeyWord = sprintf("SELECT name, sdescription, skeyword FROM demo_imageshow WHERE id = %s", GetSQLValueString($colname_RecordImageshowKeyWord, "int"));
$RecordImageshowKeyWord = mysqli_query($DB_Conn, $query_RecordImageshowKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordImageshowKeyWord = mysqli_fetch_assoc($RecordImageshowKeyWord);
$totalRows_RecordImageshowKeyWord = mysqli_num_rows($RecordImageshowKeyWord);

if (isset($_GET['searchkey'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordImageshowViewLine['itemname'], urldecode($_GET['searchkey'])))) { $Now_Type_Mobile_Show_Title = $ViewLinetype =  $row_RecordImageshowViewLine['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordImageshowViewLine['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordImageshowViewLine['skeyword'];}
	} while ($row_RecordImageshowViewLine = mysqli_fetch_assoc($RecordImageshowViewLine));
			  $rows = mysqli_num_rows($RecordImageshowViewLine);
			  if($rows > 0) {
				  mysqli_data_seek($RecordImageshowViewLine, 0);
				  $row_RecordImageshowViewLine = mysqli_fetch_assoc($RecordImageshowViewLine);
			  }
}

if(isset($row_RecordImageshowKeyWord['title']))
{
	$Title_Word = $row_RecordImageshowKeyWord['title'] . " - " . $SiteName;
}else {
	if(isset($Now_Type_Mobile_Show_Title)) {
		$Title_Word = $Now_Type_Mobile_Show_Title . " - " . $ModuleName['Imageshow'] . " - " . $SiteName;
	}else{
		$Title_Word = $ModuleName['Imageshow'] . " - " . $SiteName;
	}
}

if(isset($row_RecordImageshowKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordImageshowKeyWord['skeyword'];
}else {
	if(isset($Now_Type_Mobile_Show_skeyword)) {
		$Title_Keyword = $Now_Type_Mobile_Show_skeyword;
	}else{
		$Title_Keyword = $SiteKeyWord;
	}
}

if(isset($row_RecordImageshowKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordImageshowKeyWord['sdescription'];
}else {
	if(isset($Now_Type_Mobile_Show_sdescription)) {
		$Title_Desc = $Now_Type_Mobile_Show_sdescription;
	}else{
		$Title_Desc = "";
	}
}

mysqli_free_result($RecordImageshowKeyWord);
?>
