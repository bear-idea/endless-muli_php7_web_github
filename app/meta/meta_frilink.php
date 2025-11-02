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

$collang_RecordFrilinkViewLine = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordFrilinkViewLine = $_GET['lang'];
}
$coluserid_RecordFrilinkViewLine = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordFrilinkViewLine = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordFrilinkViewLine = sprintf("SELECT * FROM demo_strongholditem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($collang_RecordFrilinkViewLine, "text"),GetSQLValueString($coluserid_RecordFrilinkViewLine, "int"));
$RecordFrilinkViewLine = mysqli_query($DB_Conn, $query_RecordFrilinkViewLine) or die(mysqli_error($DB_Conn));
$row_RecordFrilinkViewLine = mysqli_fetch_assoc($RecordFrilinkViewLine);
$totalRows_RecordFrilinkViewLine = mysqli_num_rows($RecordFrilinkViewLine);

if (isset($_GET['searchkey'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordFrilinkViewLine['itemname'], urldecode($_GET['searchkey'])))) { $Now_Type_Mobile_Show_Title = $ViewLinetype =  $row_RecordFrilinkViewLine['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordFrilinkViewLine['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordFrilinkViewLine['skeyword'];}
	} while ($row_RecordFrilinkViewLine = mysqli_fetch_assoc($RecordFrilinkViewLine));
			  $rows = mysqli_num_rows($RecordFrilinkViewLine);
			  if($rows > 0) {
				  mysqli_data_seek($RecordFrilinkViewLine, 0);
				  $row_RecordFrilinkViewLine = mysqli_fetch_assoc($RecordFrilinkViewLine);
			  }
}

if(isset($row_RecordFrilinkKeyWord['name']))
{
	$Title_Word = $row_RecordFrilinkKeyWord['name'] . " - " . $SiteName;
}else {
	if(isset($Now_Type_Mobile_Show_Title)) {
		$Title_Word = $Now_Type_Mobile_Show_Title . " - " . $ModuleName['Frilink'] . " - " . $SiteName;
	}else{
		$Title_Word = $ModuleName['Frilink'] . " - " . $SiteName;
	}
}

if(isset($row_RecordFrilinkKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordFrilinkKeyWord['skeyword'];
}else {
	if(isset($Now_Type_Mobile_Show_skeyword)) {
		$Title_Keyword = $Now_Type_Mobile_Show_skeyword;
	}else{
		$Title_Keyword = $SiteKeyWord;
	}
}

if(isset($row_RecordFrilinkKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordFrilinkKeyWord['sdescription'];
}else {
	if(isset($Now_Type_Mobile_Show_sdescription)) {
		$Title_Desc = $Now_Type_Mobile_Show_sdescription;
	}else{
		$Title_Desc = "";
	}
}

?>
