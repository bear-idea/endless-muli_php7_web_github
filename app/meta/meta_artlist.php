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

$collang_RecordArtlistViewLine = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordArtlistViewLine = $_GET['lang'];
}
$coluserid_RecordArtlistViewLine = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordArtlistViewLine = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordArtlistViewLine = sprintf("SELECT * FROM demo_artlistitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($collang_RecordArtlistViewLine, "text"),GetSQLValueString($coluserid_RecordArtlistViewLine, "int"));
$RecordArtlistViewLine = mysqli_query($DB_Conn, $query_RecordArtlistViewLine) or die(mysqli_error($DB_Conn));
$row_RecordArtlistViewLine = mysqli_fetch_assoc($RecordArtlistViewLine);
$totalRows_RecordArtlistViewLine = mysqli_num_rows($RecordArtlistViewLine);

$colname_RecordArtlistKeyWord = "-1";
if (isset($_GET['id'])) {
  $colname_RecordArtlistKeyWord = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordArtlistKeyWord = sprintf("SELECT title, sdescription, skeyword, content FROM demo_artlist WHERE id = %s", GetSQLValueString($colname_RecordArtlistKeyWord, "int"));
$RecordArtlistKeyWord = mysqli_query($DB_Conn, $query_RecordArtlistKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordArtlistKeyWord = mysqli_fetch_assoc($RecordArtlistKeyWord);
$totalRows_RecordArtlistKeyWord = mysqli_num_rows($RecordArtlistKeyWord);

if (isset($_GET['searchkey'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordArtlistViewLine['itemname'], urldecode($_GET['searchkey'])))) { $Now_Type_Mobile_Show_Title = $ViewLinetype =  $row_RecordArtlistViewLine['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordArtlistViewLine['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordArtlistViewLine['skeyword'];}
	} while ($row_RecordArtlistViewLine = mysqli_fetch_assoc($RecordArtlistViewLine));
			  $rows = mysqli_num_rows($RecordArtlistViewLine);
			  if($rows > 0) {
				  mysqli_data_seek($RecordArtlistViewLine, 0);
				  $row_RecordArtlistViewLine = mysqli_fetch_assoc($RecordArtlistViewLine);
			  }
}

if(isset($row_RecordArtlistKeyWord['title']))
{
	$Title_Word = $row_RecordArtlistKeyWord['title'] . " - " . $SiteName;
}else {
	if(isset($Now_Type_Mobile_Show_Title)) {
		$Title_Word = $Now_Type_Mobile_Show_Title . " - " . $ModuleName['Artlist'] . " - " . $SiteName;
	}else{
		$Title_Word = $ModuleName['Artlist'] . " - " . $SiteName;
	}
}

if(isset($row_RecordArtlistKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordArtlistKeyWord['skeyword'];
}else {
	if(isset($Now_Type_Mobile_Show_skeyword)) {
		$Title_Keyword = $Now_Type_Mobile_Show_skeyword;
	}else{
		$Title_Keyword = $SiteKeyWord;
	}
}

if(isset($row_RecordArtlistKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordArtlistKeyWord['sdescription'];
}else {
	if(isset($Now_Type_Mobile_Show_sdescription)) {
		$Title_Desc = $Now_Type_Mobile_Show_sdescription;
	}else{
		$Title_Desc = mb_strimwidth(strip_tags(DeleteSpace($row_RecordArtlistKeyWord['content'])),0,200,'......', 'UTF-8');
	}
}

mysqli_free_result($RecordArtlistKeyWord);
?>
