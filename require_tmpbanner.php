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

/* 讀取資料 */
if (isset($_GET['pageNum_RecordAds'])) {
  $pageNum_RecordAds = $_GET['pageNum_RecordAds'];
}
$startRow_RecordAds = $pageNum_RecordAds * $maxRows_RecordAds;

$coltmpname_RecordAds = "-1";
if (isset($tplid)) {
  $coltmpname_RecordAds = $tplid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAds = sprintf("SELECT demo_tmpbanner.act_id, demo_tmpbanner.tmpname, demo_tmpbanner.content, demo_tmpbanner.bhight, demo_tmpbanner.bwight, demo_tmpbanner.velocity, demo_tmpbanner.numbers, demo_tmpbanner.navigation, demo_tmpbanner.thumbs, demo_tmpbanner.label, demo_tmpbanner.interval, demo_tmpbanner.hideTools, demo_tmpbanner.dots, demo_tmpbanner.title, demo_tmpbanner.type, demo_tmpbanner_sub.sdescription, demo_tmpbanner_sub.link, demo_tmpbanner_sub.pic, demo_tmpbanner.indicate, demo_tmpbanner.author, demo_tmpbanner.startdate, demo_tmpbanner.enddate, demo_tmpbanner.style, demo_tmpbanner_sub.actphoto_id, demo_tmpbanner_sub.webname, demo_tmpbanner_sub.animation, demo_tmpbanner.lang FROM demo_tmpbanner LEFT OUTER JOIN demo_tmpbanner_sub ON demo_tmpbanner.act_id = demo_tmpbanner_sub.act_id HAVING (demo_tmpbanner.tmpname = %s) ORDER BY demo_tmpbanner_sub.sortid DESC, demo_tmpbanner_sub.actphoto_id DESC", GetSQLValueString($coltmpname_RecordAds, "text"));
$RecordAds = mysqli_query($DB_Conn, $query_RecordAds) or die(mysqli_error($DB_Conn));
$row_RecordAds = mysqli_fetch_assoc($RecordAds);
$totalRows_RecordAds = mysqli_num_rows($RecordAds);
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/tmpbanner.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordAds);
?>
