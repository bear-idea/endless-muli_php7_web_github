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

$collang_RecordCareersViewLine = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordCareersViewLine = $_GET['lang'];
}
$coluserid_RecordCareersViewLine = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordCareersViewLine = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCareersViewLine = sprintf("SELECT * FROM demo_careersitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($collang_RecordCareersViewLine, "text"),GetSQLValueString($coluserid_RecordCareersViewLine, "int"));
$RecordCareersViewLine = mysqli_query($DB_Conn, $query_RecordCareersViewLine) or die(mysqli_error($DB_Conn));
$row_RecordCareersViewLine = mysqli_fetch_assoc($RecordCareersViewLine);
$totalRows_RecordCareersViewLine = mysqli_num_rows($RecordCareersViewLine);

$colname_RecordCareersKeyWord = "-1";
if (isset($_GET['id'])) {
  $colname_RecordCareersKeyWord = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCareersKeyWord = sprintf("SELECT * FROM demo_careers WHERE id = %s", GetSQLValueString($colname_RecordCareersKeyWord, "int"));
$RecordCareersKeyWord = mysqli_query($DB_Conn, $query_RecordCareersKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordCareersKeyWord = mysqli_fetch_assoc($RecordCareersKeyWord);
$totalRows_RecordCareersKeyWord = mysqli_num_rows($RecordCareersKeyWord);

if (isset($_GET['searchkey'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordCareersViewLine['itemname'], urldecode($_GET['searchkey'])))) { $Now_Type_Mobile_Show_Title = $ViewLinetype =  $row_RecordCareersViewLine['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordCareersViewLine['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordCareersViewLine['skeyword'];}
	} while ($row_RecordCareersViewLine = mysqli_fetch_assoc($RecordCareersViewLine));
			  $rows = mysqli_num_rows($RecordCareersViewLine);
			  if($rows > 0) {
				  mysqli_data_seek($RecordCareersViewLine, 0);
				  $row_RecordCareersViewLine = mysqli_fetch_assoc($RecordCareersViewLine);
			  }
}

if(isset($row_RecordCareersKeyWord['title']))
{
	$Title_Word = $row_RecordCareersKeyWord['title'] . " - " . $SiteName;
}else {
	if(isset($Now_Type_Mobile_Show_Title)) {
		$Title_Word = $Now_Type_Mobile_Show_Title . " - " . $ModuleName['Careers'] . " - " . $SiteName;
	}else{
		$Title_Word = $ModuleName['Careers'] . " - " . $SiteName;
	}
}

if(isset($row_RecordCareersKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordCareersKeyWord['skeyword'];
}else {
	if(isset($Now_Type_Mobile_Show_skeyword)) {
		$Title_Keyword = $Now_Type_Mobile_Show_skeyword;
	}else{
		$Title_Keyword = $SiteKeyWord;
	}
}

if(isset($row_RecordCareersKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordCareersKeyWord['sdescription'];
}else {
	if(isset($Now_Type_Mobile_Show_sdescription)) {
		$Title_Desc = $Now_Type_Mobile_Show_sdescription;
	}else{
		$Title_Desc = mb_strimwidth(strip_tags(DeleteSpace($row_RecordCareersKeyWord['content'])),0,200,'......', 'UTF-8');
	}
}

mysqli_free_result($RecordCareersKeyWord);
?>
