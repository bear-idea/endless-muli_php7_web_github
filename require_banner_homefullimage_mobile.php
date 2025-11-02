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

$collang_RecordAds = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordAds = $_GET['lang'];
}
$coluserid_RecordAds = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordAds = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAds = sprintf("SELECT demo_adtype.act_id, demo_adtype.userid, demo_adtype.content, demo_adtype.bhight, demo_adtype.bwight, demo_adtype.velocity, demo_adtype.numbers, demo_adtype.navigation, demo_adtype.thumbs, demo_adtype.label, demo_adtype.interval, demo_adtype.hideTools, demo_adtype.dots, demo_adtype.title, demo_adtype.type, demo_adtype_sub.sdescription, demo_adtype_sub.link, demo_adtype_sub.linktarget, demo_adtype_sub.linkstyle, demo_adtype_sub.linkcolor, demo_adtype_sub.linkword, demo_adtype_sub.linkwordcolor, demo_adtype_sub.pic, demo_adtype_sub.indicate, demo_adtype.dataheight, demo_adtype_sub.datakenburns, demo_adtype_sub.datatransition, demo_adtype_sub.databgposition, demo_adtype_sub.databgzoom, demo_adtype_sub.datacontent, demo_adtype_sub.datacontentlocation, demo_adtype_sub.datacontentoverlay1, demo_adtype_sub.datacontentoverlay2, demo_adtype.author, demo_adtype.startdate, demo_adtype.enddate, demo_adtype.style, demo_adtype.modstyle, demo_adtype.navigationstate, demo_adtype.tool, demo_adtype.theme, demo_adtype_sub.actphoto_id, demo_adtype_sub.animation, demo_adtype.lang FROM demo_adtype LEFT OUTER JOIN demo_adtype_sub ON demo_adtype.act_id = demo_adtype_sub.act_id HAVING (demo_adtype.lang = %s) && userid=%s && demo_adtype_sub.indicate=1 && type='homebannerimage' ORDER BY demo_adtype_sub.sortid ASC, demo_adtype_sub.actphoto_id DESC", GetSQLValueString($collang_RecordAds, "text"),GetSQLValueString($coluserid_RecordAds, "int"));
$RecordAds = mysqli_query($DB_Conn, $query_RecordAds) or die(mysqli_error($DB_Conn));
$row_RecordAds = mysqli_fetch_assoc($RecordAds);
$totalRows_RecordAds = mysqli_num_rows($RecordAds);
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/banner_homefullimage.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordAds);
?>
