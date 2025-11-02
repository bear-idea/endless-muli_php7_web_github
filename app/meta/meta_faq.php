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

$collang_RecordFaqViewLine = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordFaqViewLine = $_GET['lang'];
}
$coluserid_RecordFaqViewLine = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordFaqViewLine = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordFaqViewLine = sprintf("SELECT * FROM demo_faqitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($collang_RecordFaqViewLine, "text"),GetSQLValueString($coluserid_RecordFaqViewLine, "int"));
$RecordFaqViewLine = mysqli_query($DB_Conn, $query_RecordFaqViewLine) or die(mysqli_error($DB_Conn));
$row_RecordFaqViewLine = mysqli_fetch_assoc($RecordFaqViewLine);
$totalRows_RecordFaqViewLine = mysqli_num_rows($RecordFaqViewLine);

if (isset($_GET['searchkey'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordFaqViewLine['itemname'], urldecode($_GET['searchkey'])))) { $Now_Type_Mobile_Show_Title = $ViewLinetype =  $row_RecordFaqViewLine['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordFaqViewLine['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordFaqViewLine['skeyword'];}
	} while ($row_RecordFaqViewLine = mysqli_fetch_assoc($RecordFaqViewLine));
			  $rows = mysqli_num_rows($RecordFaqViewLine);
			  if($rows > 0) {
				  mysqli_data_seek($RecordFaqViewLine, 0);
				  $row_RecordFaqViewLine = mysqli_fetch_assoc($RecordFaqViewLine);
			  }
}

if(isset($row_RecordFaqKeyWord['title']))
{
	$Title_Word = $row_RecordFaqKeyWord['title'] . " - " . $SiteName;
}else {
	if(isset($Now_Type_Mobile_Show_Title)) {
		$Title_Word = $Now_Type_Mobile_Show_Title . " - " . $ModuleName['Faq'] . " - " . $SiteName;
	}else{
		$Title_Word = $ModuleName['Faq'] . " - " . $SiteName;
	}
}

if(isset($row_RecordFaqKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordFaqKeyWord['skeyword'];
}else {
	if(isset($Now_Type_Mobile_Show_skeyword)) {
		$Title_Keyword = $Now_Type_Mobile_Show_skeyword;
	}else{
		$Title_Keyword = $SiteKeyWord;
	}
}

if(isset($row_RecordFaqKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordFaqKeyWord['sdescription'];
}else {
	if(isset($Now_Type_Mobile_Show_sdescription)) {
		$Title_Desc = $Now_Type_Mobile_Show_sdescription;
	}else{
		$Title_Desc = "";
	}
}

?>
