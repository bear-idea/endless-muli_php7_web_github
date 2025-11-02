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

$collang_RecordOtrlinkViewLine = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordOtrlinkViewLine = $_GET['lang'];
}
$coluserid_RecordOtrlinkViewLine = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordOtrlinkViewLine = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordOtrlinkViewLine = sprintf("SELECT * FROM demo_otrlinkitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($collang_RecordOtrlinkViewLine, "text"),GetSQLValueString($coluserid_RecordOtrlinkViewLine, "int"));
$RecordOtrlinkViewLine = mysqli_query($DB_Conn, $query_RecordOtrlinkViewLine) or die(mysqli_error($DB_Conn));
$row_RecordOtrlinkViewLine = mysqli_fetch_assoc($RecordOtrlinkViewLine);
$totalRows_RecordOtrlinkViewLine = mysqli_num_rows($RecordOtrlinkViewLine);

$colname_RecordOtrlinkKeyWord = "-1";
if (isset($_GET['id'])) {
  $colname_RecordOtrlinkKeyWord = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordOtrlinkKeyWord = sprintf("SELECT name, sdescription, skeyword, content FROM demo_otrlink WHERE id = %s", GetSQLValueString($colname_RecordOtrlinkKeyWord, "int"));
$RecordOtrlinkKeyWord = mysqli_query($DB_Conn, $query_RecordOtrlinkKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordOtrlinkKeyWord = mysqli_fetch_assoc($RecordOtrlinkKeyWord);
$totalRows_RecordOtrlinkKeyWord = mysqli_num_rows($RecordOtrlinkKeyWord);

if (isset($_GET['searchkey'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordOtrlinkViewLine['itemname'], urldecode($_GET['searchkey'])))) { $Now_Type_Mobile_Show_Title = $ViewLinetype =  $row_RecordOtrlinkViewLine['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordOtrlinkViewLine['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordOtrlinkViewLine['skeyword'];}
	} while ($row_RecordOtrlinkViewLine = mysqli_fetch_assoc($RecordOtrlinkViewLine));
			  $rows = mysqli_num_rows($RecordOtrlinkViewLine);
			  if($rows > 0) {
				  mysqli_data_seek($RecordOtrlinkViewLine, 0);
				  $row_RecordOtrlinkViewLine = mysqli_fetch_assoc($RecordOtrlinkViewLine);
			  }
}

if(isset($row_RecordOtrlinkKeyWord['name']))
{
	$Title_Word = $row_RecordOtrlinkKeyWord['name'] . " - " . $SiteName;
}else {
	if(isset($Now_Type_Mobile_Show_Title)) {
		$Title_Word = $Now_Type_Mobile_Show_Title . " - " . $ModuleName['Otrlink'] . " - " . $SiteName;
	}else{
		$Title_Word = $ModuleName['Otrlink'] . " - " . $SiteName;
	}
}

if(isset($row_RecordOtrlinkKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordOtrlinkKeyWord['skeyword'];
}else {
	if(isset($Now_Type_Mobile_Show_skeyword)) {
		$Title_Keyword = $Now_Type_Mobile_Show_skeyword;
	}else{
		$Title_Keyword = $SiteKeyWord;
	}
}

if(isset($row_RecordOtrlinkKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordOtrlinkKeyWord['sdescription'];
}else {
	if(isset($Now_Type_Mobile_Show_sdescription)) {
		$Title_Desc = $Now_Type_Mobile_Show_sdescription;
	}else{
		$Title_Desc = mb_strimwidth(strip_tags(DeleteSpace($row_RecordOtrlinkKeyWord['content'])),0,200,'......', 'UTF-8');
	}
}

mysqli_free_result($RecordOtrlinkKeyWord);
?>
