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

$colname_RecordModlinkKeyWord = "-1";
if (isset($_GET['modlink_id'])) {
  $colname_RecordModlinkKeyWord = $_GET['modlink_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordModlinkKeyWord = sprintf("SELECT name FROM demo_modlink WHERE id = %s", GetSQLValueString($colname_RecordModlinkKeyWord, "int"));
$RecordModlinkKeyWord = mysqli_query($DB_Conn, $query_RecordModlinkKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordModlinkKeyWord = mysqli_fetch_assoc($RecordModlinkKeyWord);
$totalRows_RecordModlinkKeyWord = mysqli_num_rows($RecordModlinkKeyWord);$colname_RecordModlinkKeyWord = "-1";
if (isset($_GET['modlink_id'])) {
  $colname_RecordModlinkKeyWord = $_GET['modlink_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordModlinkKeyWord = sprintf("SELECT name, sdescription, skeyword FROM demo_modlink WHERE id = %s", GetSQLValueString($colname_RecordModlinkKeyWord, "int"));
$RecordModlinkKeyWord = mysqli_query($DB_Conn, $query_RecordModlinkKeyWord) or die(mysqli_error($DB_Conn));
$row_RecordModlinkKeyWord = mysqli_fetch_assoc($RecordModlinkKeyWord);
$totalRows_RecordModlinkKeyWord = mysqli_num_rows($RecordModlinkKeyWord);

if(isset($row_RecordModlinkKeyWord['name']))
{
	$Title_Word = $row_RecordModlinkKeyWord['name'] . " - " . $SiteName;
}else {
	$Title_Word = $ModuleName['Modlink'] . " - " . $SiteName;
}

if(isset($row_RecordModlinkKeyWord['skeyword']))
{
	$Title_Keyword = $row_RecordModlinkKeyWord['skeyword'];
}else {
	$Title_Keyword = $SiteKeyWord;
}

if(isset($row_RecordModlinkKeyWord['sdescription']))
{
	$Title_Desc = $row_RecordModlinkKeyWord['sdescription'];
}else {
	$Title_Desc = "";
}

mysqli_free_result($RecordModlinkKeyWord);
?>
