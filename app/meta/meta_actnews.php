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

$collang_RecordActnewsViewLine = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordActnewsViewLine = $_GET['lang'];
}
$coluserid_RecordActnewsViewLine = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordActnewsViewLine = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordActnewsViewLine = sprintf("SELECT * FROM demo_actnewsitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($collang_RecordActnewsViewLine, "text"),GetSQLValueString($coluserid_RecordActnewsViewLine, "int"));
$RecordActnewsViewLine = mysqli_query($DB_Conn, $query_RecordActnewsViewLine) or die(mysqli_error($DB_Conn));
$row_RecordActnewsViewLine = mysqli_fetch_assoc($RecordActnewsViewLine);
$totalRows_RecordActnewsViewLine = mysqli_num_rows($RecordActnewsViewLine);

$colname_RecordActnewsKeyWord = "-1";
if (isset($_GET['id'])) {
  $colname_RecordActnewsKeyWord = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordActnewsKeyWord = sprintf("SELECT title, sdescription, skeyword, content FROM demo_actnews WHERE id = %s", GetSQLValueString($colname_RecordActnewsKeyWord, "int"));
$RecordActnewsKeyWord = mysqli_query($DB_Conn, $query_RecordActnewsKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordActnewsKeyWord = mysqli_fetch_assoc($RecordActnewsKeyWord);
$totalRows_RecordActnewsKeyWord = mysqli_num_rows($RecordActnewsKeyWord);

if (isset($_GET['searchkey'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordActnewsViewLine['itemname'], urldecode($_GET['searchkey'])))) { $Now_Type_Mobile_Show_Title = $ViewLinetype =  $row_RecordActnewsViewLine['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordActnewsViewLine['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordActnewsViewLine['skeyword'];}
	} while ($row_RecordActnewsViewLine = mysqli_fetch_assoc($RecordActnewsViewLine));
			  $rows = mysqli_num_rows($RecordActnewsViewLine);
			  if($rows > 0) {
				  mysqli_data_seek($RecordActnewsViewLine, 0);
				  $row_RecordActnewsViewLine = mysqli_fetch_assoc($RecordActnewsViewLine);
			  }
}

if(isset($row_RecordActnewsKeyWord['title']))
{
	$Title_Word = $row_RecordActnewsKeyWord['title'] . " - " . $SiteName;
}else {
	if(isset($Now_Type_Mobile_Show_Title)) {
		$Title_Word = $Now_Type_Mobile_Show_Title . " - " . $ModuleName['Actnews'] . " - " . $SiteName;
	}else{
		$Title_Word = $ModuleName['Actnews'] . " - " . $SiteName;
	}
}

if(isset($row_RecordActnewsKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordActnewsKeyWord['skeyword'];
}else {
	if(isset($Now_Type_Mobile_Show_skeyword)) {
		$Title_Keyword = $Now_Type_Mobile_Show_skeyword;
	}else{
		$Title_Keyword = $SiteKeyWord;
	}
}

if(isset($row_RecordActnewsKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordActnewsKeyWord['sdescription'];
}else {
	if(isset($Now_Type_Mobile_Show_sdescription)) {
		$Title_Desc = $Now_Type_Mobile_Show_sdescription;
	}else{
		$Title_Desc = mb_strimwidth(strip_tags(DeleteSpace($row_RecordActnewsKeyWord['content'])),0,200,'......', 'UTF-8');
	}
}

mysqli_free_result($RecordActnewsKeyWord);
?>
