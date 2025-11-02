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

$collang_RecordProjectViewLine = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordProjectViewLine = $_GET['lang'];
}
$coluserid_RecordProjectViewLine = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordProjectViewLine = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProjectViewLine = sprintf("SELECT * FROM demo_projectitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($collang_RecordProjectViewLine, "text"),GetSQLValueString($coluserid_RecordProjectViewLine, "int"));
$RecordProjectViewLine = mysqli_query($DB_Conn, $query_RecordProjectViewLine) or die(mysqli_error($DB_Conn));
$row_RecordProjectViewLine = mysqli_fetch_assoc($RecordProjectViewLine);
$totalRows_RecordProjectViewLine = mysqli_num_rows($RecordProjectViewLine);

$colname_RecordProjectKeyWord = "-1";
if (isset($_GET['id'])) {
  $colname_RecordProjectKeyWord = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProjectKeyWord = sprintf("SELECT title, sdescription, skeyword FROM demo_projectalbum WHERE act_id = %s", GetSQLValueString($colname_RecordProjectKeyWord, "int"));
$RecordProjectKeyWord = mysqli_query($DB_Conn, $query_RecordProjectKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordProjectKeyWord = mysqli_fetch_assoc($RecordProjectKeyWord);
$totalRows_RecordProjectKeyWord = mysqli_num_rows($RecordProjectKeyWord);

if (isset($_GET['type'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordProjectViewLine['itemname'], urldecode($_GET['type'])))) { $Now_Type_Mobile_Show_Title = $ViewLinetype =  $row_RecordProjectViewLine['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordProjectViewLine['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordProjectViewLine['skeyword'];}
	} while ($row_RecordProjectViewLine = mysqli_fetch_assoc($RecordProjectViewLine));
			  $rows = mysqli_num_rows($RecordProjectViewLine);
			  if($rows > 0) {
				  mysqli_data_seek($RecordProjectViewLine, 0);
				  $row_RecordProjectViewLine = mysqli_fetch_assoc($RecordProjectViewLine);
			  }
}

if(isset($row_RecordProjectKeyWord['title']))
{
	$Title_Word = $row_RecordProjectKeyWord['title'] . " - " . $SiteName;
}else {
	if(isset($Now_Type_Mobile_Show_Title)) {
		$Title_Word = $Now_Type_Mobile_Show_Title . " - " . $ModuleName['Project'] . " - " . $SiteName;
	}else{
		$Title_Word = $ModuleName['Project'] . " - " . $SiteName;
	}
}

if(isset($row_RecordProjectKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordProjectKeyWord['skeyword'];
}else {
	if(isset($Now_Type_Mobile_Show_skeyword)) {
		$Title_Keyword = $Now_Type_Mobile_Show_skeyword;
	}else{
		$Title_Keyword = $SiteKeyWord;
	}
}

if(isset($row_RecordProjectKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordProjectKeyWord['sdescription'];
}else {
	if(isset($Now_Type_Mobile_Show_sdescription)) {
		$Title_Desc = $Now_Type_Mobile_Show_sdescription;
	}else{
		$Title_Desc = "";
	}
}

mysqli_free_result($RecordProjectKeyWord);
?>
