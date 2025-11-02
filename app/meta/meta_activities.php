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

$collang_RecordActivitiesViewLine = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordActivitiesViewLine = $_GET['lang'];
}
$coluserid_RecordActivitiesViewLine = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordActivitiesViewLine = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordActivitiesViewLine = sprintf("SELECT * FROM demo_actitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($collang_RecordActivitiesViewLine, "text"),GetSQLValueString($coluserid_RecordActivitiesViewLine, "int"));
$RecordActivitiesViewLine = mysqli_query($DB_Conn, $query_RecordActivitiesViewLine) or die(mysqli_error($DB_Conn));
$row_RecordActivitiesViewLine = mysqli_fetch_assoc($RecordActivitiesViewLine);
$totalRows_RecordActivitiesViewLine = mysqli_num_rows($RecordActivitiesViewLine);

$colname_RecordActivitiesKeyWord = "-1";
if (isset($_GET['id'])) {
  $colname_RecordActivitiesKeyWord = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordActivitiesKeyWord = sprintf("SELECT title, sdescription, skeyword FROM demo_actalbum WHERE act_id = %s", GetSQLValueString($colname_RecordActivitiesKeyWord, "int"));
$RecordActivitiesKeyWord = mysqli_query($DB_Conn, $query_RecordActivitiesKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordActivitiesKeyWord = mysqli_fetch_assoc($RecordActivitiesKeyWord);
$totalRows_RecordActivitiesKeyWord = mysqli_num_rows($RecordActivitiesKeyWord);

if (isset($_GET['type'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordActivitiesViewLine['itemname'], urldecode($_GET['type'])))) { $Now_Type_Mobile_Show_Title = $ViewLinetype =  $row_RecordActivitiesViewLine['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordActivitiesViewLine['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordActivitiesViewLine['skeyword'];}
	} while ($row_RecordActivitiesViewLine = mysqli_fetch_assoc($RecordActivitiesViewLine));
			  $rows = mysqli_num_rows($RecordActivitiesViewLine);
			  if($rows > 0) {
				  mysqli_data_seek($RecordActivitiesViewLine, 0);
				  $row_RecordActivitiesViewLine = mysqli_fetch_assoc($RecordActivitiesViewLine);
			  }
}

if(isset($row_RecordActivitiesKeyWord['title']))
{
	$Title_Word = $row_RecordActivitiesKeyWord['title'] . " - " . $SiteName;
}else {
	if(isset($Now_Type_Mobile_Show_Title)) {
		$Title_Word = $Now_Type_Mobile_Show_Title . " - " . $ModuleName['Activities'] . " - " . $SiteName;
	}else{
		$Title_Word = $ModuleName['Activities'] . " - " . $SiteName;
	}
}

if(isset($row_RecordActivitiesKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordActivitiesKeyWord['skeyword'];
}else {
	if(isset($Now_Type_Mobile_Show_skeyword)) {
		$Title_Keyword = $Now_Type_Mobile_Show_skeyword;
	}else{
		$Title_Keyword = $SiteKeyWord;
	}
}

if(isset($row_RecordActivitiesKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordActivitiesKeyWord['sdescription'];
}else {
	if(isset($Now_Type_Mobile_Show_sdescription)) {
		$Title_Desc = $Now_Type_Mobile_Show_sdescription;
	}else{
		$Title_Desc = $Title_Desc = "";
	}
}

mysqli_free_result($RecordActivitiesKeyWord);
?>
