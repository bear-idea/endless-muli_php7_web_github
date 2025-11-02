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

$collang_RecordVideoViewLine = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordVideoViewLine = $_GET['lang'];
}
$coluserid_RecordVideoViewLine = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordVideoViewLine = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordVideoViewLine = sprintf("SELECT * FROM demo_videoitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($collang_RecordVideoViewLine, "text"),GetSQLValueString($coluserid_RecordVideoViewLine, "int"));
$RecordVideoViewLine = mysqli_query($DB_Conn, $query_RecordVideoViewLine) or die(mysqli_error($DB_Conn));
$row_RecordVideoViewLine = mysqli_fetch_assoc($RecordVideoViewLine);
$totalRows_RecordVideoViewLine = mysqli_num_rows($RecordVideoViewLine);

$colname_RecordVideoKeyWord = "-1";
if (isset($_GET['id'])) {
  $colname_RecordVideoKeyWord = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordVideoKeyWord = sprintf("SELECT name, sdescription, skeyword FROM demo_video WHERE id = %s", GetSQLValueString($colname_RecordVideoKeyWord, "int"));
$RecordVideoKeyWord = mysqli_query($DB_Conn, $query_RecordVideoKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordVideoKeyWord = mysqli_fetch_assoc($RecordVideoKeyWord);
$totalRows_RecordVideoKeyWord = mysqli_num_rows($RecordVideoKeyWord);

if (isset($_GET['searchkey'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordVideoViewLine['itemname'], urldecode($_GET['searchkey'])))) { $Now_Type_Mobile_Show_Title = $ViewLinetype =  $row_RecordVideoViewLine['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordVideoViewLine['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordVideoViewLine['skeyword'];}
	} while ($row_RecordVideoViewLine = mysqli_fetch_assoc($RecordVideoViewLine));
			  $rows = mysqli_num_rows($RecordVideoViewLine);
			  if($rows > 0) {
				  mysqli_data_seek($RecordVideoViewLine, 0);
				  $row_RecordVideoViewLine = mysqli_fetch_assoc($RecordVideoViewLine);
			  }
}

if(isset($row_RecordVideoKeyWord['name']))
{
	$Title_Word = $row_RecordVideoKeyWord['name'] . " - " . $SiteName;
}else {
	if(isset($Now_Type_Mobile_Show_Title)) {
		$Title_Word = $Now_Type_Mobile_Show_Title . " - " . $ModuleName['Video'] . " - " . $SiteName;
	}else{
		$Title_Word = $ModuleName['Video'] . " - " . $SiteName;
	}
}

if(isset($row_RecordVideoKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordVideoKeyWord['skeyword'];
}else {
	if(isset($Now_Type_Mobile_Show_skeyword)) {
		$Title_Keyword = $Now_Type_Mobile_Show_skeyword;
	}else{
		$Title_Keyword = $SiteKeyWord;
	}
}

if(isset($row_RecordVideoKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordVideoKeyWord['sdescription'];
}else {
	if(isset($Now_Type_Mobile_Show_sdescription)) {
		$Title_Desc = $Now_Type_Mobile_Show_sdescription;
	}else{
		$Title_Desc = "";
	}
}

mysqli_free_result($RecordVideoKeyWord);
?>
