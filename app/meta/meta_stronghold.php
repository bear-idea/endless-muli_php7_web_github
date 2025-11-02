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

$collang_RecordStrongholdViewLine = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordStrongholdViewLine = $_GET['lang'];
}
$coluserid_RecordStrongholdViewLine = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordStrongholdViewLine = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordStrongholdViewLine = sprintf("SELECT * FROM demo_strongholditem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($collang_RecordStrongholdViewLine, "text"),GetSQLValueString($coluserid_RecordStrongholdViewLine, "int"));
$RecordStrongholdViewLine = mysqli_query($DB_Conn, $query_RecordStrongholdViewLine) or die(mysqli_error($DB_Conn));
$row_RecordStrongholdViewLine = mysqli_fetch_assoc($RecordStrongholdViewLine);
$totalRows_RecordStrongholdViewLine = mysqli_num_rows($RecordStrongholdViewLine);

if (isset($_GET['searchkey'])) {
	do {  //比較字串
		if (!(strcmp($row_RecordStrongholdViewLine['itemname'], urldecode($_GET['searchkey'])))) { $Now_Type_Mobile_Show_Title = $ViewLinetype =  $row_RecordStrongholdViewLine['itemname']; $Now_Type_Mobile_Show_sdescription = $row_RecordStrongholdViewLine['sdescription']; $Now_Type_Mobile_Show_skeyword = $row_RecordStrongholdViewLine['skeyword'];}
	} while ($row_RecordStrongholdViewLine = mysqli_fetch_assoc($RecordStrongholdViewLine));
			  $rows = mysqli_num_rows($RecordStrongholdViewLine);
			  if($rows > 0) {
				  mysqli_data_seek($RecordStrongholdViewLine, 0);
				  $row_RecordStrongholdViewLine = mysqli_fetch_assoc($RecordStrongholdViewLine);
			  }
}

if(isset($row_RecordStrongholdKeyWord['name']))
{
	$Title_Word = $row_RecordStrongholdKeyWord['name'] . " - " . $SiteName;
}else {
	if(isset($Now_Type_Mobile_Show_Title)) {
		$Title_Word = $Now_Type_Mobile_Show_Title . " - " . $ModuleName['Stronghold'] . " - " . $SiteName;
	}else{
		$Title_Word = $ModuleName['Stronghold'] . " - " . $SiteName;
	}
}

if(isset($row_RecordStrongholdKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordStrongholdKeyWord['skeyword'];
}else {
	if(isset($Now_Type_Mobile_Show_skeyword)) {
		$Title_Keyword = $Now_Type_Mobile_Show_skeyword;
	}else{
		$Title_Keyword = $SiteKeyWord;
	}
}

if(isset($row_RecordStrongholdKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordStrongholdKeyWord['sdescription'];
}else {
	if(isset($Now_Type_Mobile_Show_sdescription)) {
		$Title_Desc = $Now_Type_Mobile_Show_sdescription;
	}else{
		$Title_Desc = "";
	}
}

?>
