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

$collang_RecordOrgViewLine = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordOrgViewLine = $_GET['lang'];
}
$coluserid_RecordOrgViewLine = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordOrgViewLine = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordOrgViewLine = sprintf("SELECT * FROM demo_orgitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($collang_RecordOrgViewLine, "text"),GetSQLValueString($coluserid_RecordOrgViewLine, "int"));
$RecordOrgViewLine = mysqli_query($DB_Conn, $query_RecordOrgViewLine) or die(mysqli_error($DB_Conn));
$row_RecordOrgViewLine = mysqli_fetch_assoc($RecordOrgViewLine);
$totalRows_RecordOrgViewLine = mysqli_num_rows($RecordOrgViewLine);

$colname_RecordOrgKeyWord = "-1";
if (isset($_GET['id'])) {
  $colname_RecordOrgKeyWord = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordOrgKeyWord = sprintf("SELECT title, sdescription, skeyword FROM demo_org WHERE id = %s", GetSQLValueString($colname_RecordOrgKeyWord, "int"));
$RecordOrgKeyWord = mysqli_query($DB_Conn, $query_RecordOrgKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordOrgKeyWord = mysqli_fetch_assoc($RecordOrgKeyWord);
$totalRows_RecordOrgKeyWord = mysqli_num_rows($RecordOrgKeyWord);

if (isset($_GET['searchkey'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordOrgViewLine['itemname'], urldecode($_GET['searchkey'])))) { $Now_Type_Mobile_Show_Title = $ViewLinetype =  $row_RecordOrgViewLine['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordOrgViewLine['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordOrgViewLine['skeyword'];}
	} while ($row_RecordOrgViewLine = mysqli_fetch_assoc($RecordOrgViewLine));
			  $rows = mysqli_num_rows($RecordOrgViewLine);
			  if($rows > 0) {
				  mysqli_data_seek($RecordOrgViewLine, 0);
				  $row_RecordOrgViewLine = mysqli_fetch_assoc($RecordOrgViewLine);
			  }
}

if(isset($row_RecordOrgKeyWord['title']))
{
	$Title_Word = $row_RecordOrgKeyWord['title'] . " - " . $SiteName;
}else {
	if(isset($Now_Type_Mobile_Show_Title)) {
		$Title_Word = $Now_Type_Mobile_Show_Title . " - " . $ModuleName['Org'] . " - " . $SiteName;
	}else{
		$Title_Word = $ModuleName['Org'] . " - " . $SiteName;
	}
}

if(isset($row_RecordOrgKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordOrgKeyWord['skeyword'];
}else {
	if(isset($Now_Type_Mobile_Show_skeyword)) {
		$Title_Keyword = $Now_Type_Mobile_Show_skeyword;
	}else{
		$Title_Keyword = $SiteKeyWord;
	}
}

if(isset($row_RecordOrgKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordOrgKeyWord['sdescription'];
}else {
	if(isset($Now_Type_Mobile_Show_sdescription)) {
		$Title_Desc = $Now_Type_Mobile_Show_sdescription;
	}else{
		$Title_Desc = mb_strimwidth(strip_tags(DeleteSpace($row_RecordOrgKeyWord['content'])),0,200,'......', 'UTF-8');
	}
}

mysqli_free_result($RecordOrgKeyWord);
?>
