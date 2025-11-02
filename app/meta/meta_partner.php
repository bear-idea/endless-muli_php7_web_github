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

$collang_RecordPartnerViewLine = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordPartnerViewLine = $_GET['lang'];
}
$coluserid_RecordPartnerViewLine = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordPartnerViewLine = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPartnerViewLine = sprintf("SELECT * FROM demo_partneritem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($collang_RecordPartnerViewLine, "text"),GetSQLValueString($coluserid_RecordPartnerViewLine, "int"));
$RecordPartnerViewLine = mysqli_query($DB_Conn, $query_RecordPartnerViewLine) or die(mysqli_error($DB_Conn));
$row_RecordPartnerViewLine = mysqli_fetch_assoc($RecordPartnerViewLine);
$totalRows_RecordPartnerViewLine = mysqli_num_rows($RecordPartnerViewLine);

$colname_RecordPartnerKeyWord = "-1";
if (isset($_GET['id'])) {
  $colname_RecordPartnerKeyWord = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPartnerKeyWord = sprintf("SELECT name, sdescription, skeyword, content FROM demo_partner WHERE id = %s", GetSQLValueString($colname_RecordPartnerKeyWord, "int"));
$RecordPartnerKeyWord = mysqli_query($DB_Conn, $query_RecordPartnerKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordPartnerKeyWord = mysqli_fetch_assoc($RecordPartnerKeyWord);
$totalRows_RecordPartnerKeyWord = mysqli_num_rows($RecordPartnerKeyWord);

if (isset($_GET['searchkey'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordPartnerViewLine['itemname'], urldecode($_GET['searchkey'])))) { $Now_Type_Mobile_Show_Title = $ViewLinetype =  $row_RecordPartnerViewLine['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordPartnerViewLine['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordPartnerViewLine['skeyword'];}
	} while ($row_RecordPartnerViewLine = mysqli_fetch_assoc($RecordPartnerViewLine));
			  $rows = mysqli_num_rows($RecordPartnerViewLine);
			  if($rows > 0) {
				  mysqli_data_seek($RecordPartnerViewLine, 0);
				  $row_RecordPartnerViewLine = mysqli_fetch_assoc($RecordPartnerViewLine);
			  }
}

if(isset($row_RecordPartnerKeyWord['name']))
{
	$Title_Word = $row_RecordPartnerKeyWord['name'] . " - " . $SiteName;
}else {
	if(isset($Now_Type_Mobile_Show_Title)) {
		$Title_Word = $Now_Type_Mobile_Show_Title . " - " . $ModuleName['Partner'] . " - " . $SiteName;
	}else{
		$Title_Word = $ModuleName['Partner'] . " - " . $SiteName;
	}
}

if(isset($row_RecordPartnerKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordPartnerKeyWord['skeyword'];
}else {
	if(isset($Now_Type_Mobile_Show_skeyword)) {
		$Title_Keyword = $Now_Type_Mobile_Show_skeyword;
	}else{
		$Title_Keyword = $SiteKeyWord;
	}
}

if(isset($row_RecordPartnerKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordPartnerKeyWord['sdescription'];
}else {
	if(isset($Now_Type_Mobile_Show_sdescription)) {
		$Title_Desc = $Now_Type_Mobile_Show_sdescription;
	}else{
		$Title_Desc = mb_strimwidth(strip_tags(DeleteSpace($row_RecordPartnerKeyWord['content'])),0,200,'......', 'UTF-8');
	}
}

mysqli_free_result($RecordPartnerKeyWord);
?>
