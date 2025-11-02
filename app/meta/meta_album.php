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

$collang_RecordAlbumViewLine = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordAlbumViewLine = $_GET['lang'];
}
$coluserid_RecordAlbumViewLine = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordAlbumViewLine = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAlbumViewLine = sprintf("SELECT * FROM demo_albumitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($collang_RecordAlbumViewLine, "text"),GetSQLValueString($coluserid_RecordAlbumViewLine, "int"));
$RecordAlbumViewLine = mysqli_query($DB_Conn, $query_RecordAlbumViewLine) or die(mysqli_error($DB_Conn));
$row_RecordAlbumViewLine = mysqli_fetch_assoc($RecordAlbumViewLine);
$totalRows_RecordAlbumViewLine = mysqli_num_rows($RecordAlbumViewLine);

$colname_RecordAlbumKeyWord = "-1";
if (isset($_GET['id'])) {
  $colname_RecordAlbumKeyWord = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAlbumKeyWord = sprintf("SELECT title, sdescription, skeyword FROM demo_album WHERE act_id = %s", GetSQLValueString($colname_RecordAlbumKeyWord, "int"));
$RecordAlbumKeyWord = mysqli_query($DB_Conn, $query_RecordAlbumKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordAlbumKeyWord = mysqli_fetch_assoc($RecordAlbumKeyWord);
$totalRows_RecordAlbumKeyWord = mysqli_num_rows($RecordAlbumKeyWord);

if (isset($_GET['type'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordAlbumViewLine['itemname'], urldecode($_GET['type'])))) { $Now_Type_Mobile_Show_Title = $ViewLinetype =  $row_RecordAlbumViewLine['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordAlbumViewLine['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordAlbumViewLine['skeyword'];}
	} while ($row_RecordAlbumViewLine = mysqli_fetch_assoc($RecordAlbumViewLine));
			  $rows = mysqli_num_rows($RecordAlbumViewLine);
			  if($rows > 0) {
				  mysqli_data_seek($RecordAlbumViewLine, 0);
				  $row_RecordAlbumViewLine = mysqli_fetch_assoc($RecordAlbumViewLine);
			  }
}

if(isset($row_RecordAlbumKeyWord['title']))
{
	$Title_Word = $row_RecordAlbumKeyWord['title'] . " - " . $SiteName;
}else {
	if(isset($Now_Type_Mobile_Show_Title)) {
		$Title_Word = $Now_Type_Mobile_Show_Title . " - " . $ModuleName['Album'] . " - " . $SiteName;
	}else{
		$Title_Word = $ModuleName['Album'] . " - " . $SiteName;
	}
}

if(isset($row_RecordAlbumKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordAlbumKeyWord['skeyword'];
}else {
	if(isset($Now_Type_Mobile_Show_skeyword)) {
		$Title_Keyword = $Now_Type_Mobile_Show_skeyword;
	}else{
		$Title_Keyword = $SiteKeyWord;
	}
}

if(isset($row_RecordAlbumKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordAlbumKeyWord['sdescription'];
}else {
	if(isset($Now_Type_Mobile_Show_sdescription)) {
		$Title_Desc = $Now_Type_Mobile_Show_sdescription;
	}else{
		$Title_Desc = "";
	}
}

mysqli_free_result($RecordAlbumKeyWord);
?>
