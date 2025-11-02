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

$collang_RecordAttractionsViewLine = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordAttractionsViewLine = $_GET['lang'];
}
$coluserid_RecordAttractionsViewLine = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordAttractionsViewLine = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAttractionsViewLine = sprintf("SELECT * FROM demo_attractionsitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($collang_RecordAttractionsViewLine, "text"),GetSQLValueString($coluserid_RecordAttractionsViewLine, "int"));
$RecordAttractionsViewLine = mysqli_query($DB_Conn, $query_RecordAttractionsViewLine) or die(mysqli_error($DB_Conn));
$row_RecordAttractionsViewLine = mysqli_fetch_assoc($RecordAttractionsViewLine);
$totalRows_RecordAttractionsViewLine = mysqli_num_rows($RecordAttractionsViewLine);

$colname_RecordAttractionsKeyWord = "-1";
if (isset($_GET['attractions_id'])) {
  $colname_RecordAttractionsKeyWord = $_GET['attractions_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAttractionsKeyWord = sprintf("SELECT name FROM demo_attractions WHERE id = %s", GetSQLValueString($colname_RecordAttractionsKeyWord, "int"));
$RecordAttractionsKeyWord = mysqli_query($DB_Conn, $query_RecordAttractionsKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordAttractionsKeyWord = mysqli_fetch_assoc($RecordAttractionsKeyWord);
$totalRows_RecordAttractionsKeyWord = mysqli_num_rows($RecordAttractionsKeyWord);$colname_RecordAttractionsKeyWord = "-1";
if (isset($_GET['attractions_id'])) {
  $colname_RecordAttractionsKeyWord = $_GET['attractions_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAttractionsKeyWord = sprintf("SELECT name, sdescription, skeyword FROM demo_attractions WHERE id = %s", GetSQLValueString($colname_RecordAttractionsKeyWord, "int"));
$RecordAttractionsKeyWord = mysqli_query($DB_Conn, $query_RecordAttractionsKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordAttractionsKeyWord = mysqli_fetch_assoc($RecordAttractionsKeyWord);
$totalRows_RecordAttractionsKeyWord = mysqli_num_rows($RecordAttractionsKeyWord);

if (isset($_GET['searchkey'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordAttractionsViewLine['itemname'], urldecode($_GET['searchkey'])))) { $Now_Type_Mobile_Show_Title = $ViewLinetype =  $row_RecordAttractionsViewLine['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordAttractionsViewLine['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordAttractionsViewLine['skeyword'];}
	} while ($row_RecordAttractionsViewLine = mysqli_fetch_assoc($RecordAttractionsViewLine));
			  $rows = mysqli_num_rows($RecordAttractionsViewLine);
			  if($rows > 0) {
				  mysqli_data_seek($RecordAttractionsViewLine, 0);
				  $row_RecordAttractionsViewLine = mysqli_fetch_assoc($RecordAttractionsViewLine);
			  }
}

if(isset($row_RecordAttractionsKeyWord['name']))
{
	$Title_Word = $row_RecordAttractionsKeyWord['name'] . " - " . $SiteName;
}else {
	if(isset($Now_Type_Mobile_Show_Title)) {
		$Title_Word = $Now_Type_Mobile_Show_Title . " - " . $ModuleName['Attractions'] . " - " . $SiteName;
	}else{
		$Title_Word = $ModuleName['Attractions'] . " - " . $SiteName;
	}
}

if(isset($row_RecordAttractionsKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordAttractionsKeyWord['skeyword'];
}else {
	if(isset($Now_Type_Mobile_Show_skeyword)) {
		$Title_Keyword = $Now_Type_Mobile_Show_skeyword;
	}else{
		$Title_Keyword = $SiteKeyWord;
	}
}

if(isset($row_RecordAttractionsKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordAttractionsKeyWord['sdescription'];
}else {
	if(isset($Now_Type_Mobile_Show_sdescription)) {
		$Title_Desc = $Now_Type_Mobile_Show_sdescription;
	}else{
		$Title_Desc = mb_strimwidth(strip_tags(DeleteSpace($row_RecordAttractionsKeyWord['content'])),0,200,'......', 'UTF-8');
	}
}

mysqli_free_result($RecordAttractionsKeyWord);
?>
