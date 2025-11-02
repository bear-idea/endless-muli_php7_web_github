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

$collang_RecordSponsorViewLine = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordSponsorViewLine = $_GET['lang'];
}
$coluserid_RecordSponsorViewLine = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordSponsorViewLine = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSponsorViewLine = sprintf("SELECT * FROM demo_sponsoritem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($collang_RecordSponsorViewLine, "text"),GetSQLValueString($coluserid_RecordSponsorViewLine, "int"));
$RecordSponsorViewLine = mysqli_query($DB_Conn, $query_RecordSponsorViewLine) or die(mysqli_error($DB_Conn));
$row_RecordSponsorViewLine = mysqli_fetch_assoc($RecordSponsorViewLine);
$totalRows_RecordSponsorViewLine = mysqli_num_rows($RecordSponsorViewLine);

if (isset($_GET['searchkey'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordSponsorViewLine['itemname'], urldecode($_GET['searchkey'])))) { $Now_Type_Mobile_Show_Title = $ViewLinetype =  $row_RecordSponsorViewLine['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordSponsorViewLine['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordSponsorViewLine['skeyword'];}
	} while ($row_RecordSponsorViewLine = mysqli_fetch_assoc($RecordSponsorViewLine));
			  $rows = mysqli_num_rows($RecordSponsorViewLine);
			  if($rows > 0) {
				  mysqli_data_seek($RecordSponsorViewLine, 0);
				  $row_RecordSponsorViewLine = mysqli_fetch_assoc($RecordSponsorViewLine);
			  }
}

if(isset($row_RecordSponsorKeyWord['name']))
{
	$Title_Word = $row_RecordSponsorKeyWord['name'] . " - " . $SiteName;
}else {
	if(isset($Now_Type_Mobile_Show_Title)) {
		$Title_Word = $Now_Type_Mobile_Show_Title . " - " . $ModuleName['Sponsor'] . " - " . $SiteName;
	}else{
		$Title_Word = $ModuleName['Sponsor'] . " - " . $SiteName;
	}
}

if(isset($row_RecordSponsorKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordSponsorKeyWord['skeyword'];
}else {
	if(isset($Now_Type_Mobile_Show_skeyword)) {
		$Title_Keyword = $Now_Type_Mobile_Show_skeyword;
	}else{
		$Title_Keyword = $SiteKeyWord;
	}
}

if(isset($row_RecordSponsorKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordSponsorKeyWord['sdescription'];
}else {
	if(isset($Now_Type_Mobile_Show_sdescription)) {
		$Title_Desc = $Now_Type_Mobile_Show_sdescription;
	}else{
		$Title_Desc = "";
	}
}

?>
