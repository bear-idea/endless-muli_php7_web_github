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

$maxRows_RecordPublishMarquee = 10;
$pageMarquee = 0;
if (isset($_GET['pageMarquee'])) {
  $pageMarquee = $_GET['pageMarquee'];
}
$startRow_RecordPublishMarquee = $pageMarquee * $maxRows_RecordPublishMarquee;

$collang_RecordPublishMarquee = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordPublishMarquee = $_GET['lang'];
}
$coluserid_RecordPublishMarquee = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordPublishMarquee = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPublishMarquee = sprintf("SELECT * FROM demo_publish WHERE (indicate = 1) && (lang = %s) && userid=%s ORDER BY id DESC", GetSQLValueString($collang_RecordPublishMarquee, "text"),GetSQLValueString($coluserid_RecordPublishMarquee, "int"));
$query_limit_RecordPublishMarquee = sprintf("%s LIMIT %d, %d", $query_RecordPublishMarquee, $startRow_RecordPublishMarquee, $maxRows_RecordPublishMarquee);
$RecordPublishMarquee = mysqli_query($DB_Conn, $query_limit_RecordPublishMarquee) or die(mysqli_error($DB_Conn));
$row_RecordPublishMarquee = mysqli_fetch_assoc($RecordPublishMarquee);

if (isset($_GET['totalRows_RecordPublishMarquee'])) {
  $totalRows_RecordPublishMarquee = $_GET['totalRows_RecordPublishMarquee'];
} else {
  $all_RecordPublishMarquee = mysqli_query($DB_Conn, $query_RecordPublishMarquee);
  $totalRows_RecordPublishMarquee = mysqli_num_rows($all_RecordPublishMarquee);
}
$totalPages_RecordPublishMarquee = ceil($totalRows_RecordPublishMarquee/$maxRows_RecordPublishMarquee)-1;
?>
<marquee bgcolor="" border="0" align="middle" scrollamount="<?php echo $Publish_Scrollamount; ?>"  scrolldelay="90" behavior="<?php echo $Publish_Behavior; ?>"  direction="<?php echo $Publish_Direction; ?>" width="100%" style="color: #000; font-size: 14" class="Publish_Marquee" onmouseover= "this.stop();"   onmouseout= "this.start();" >
<?php include($TplPath . "/main_marquee.php"); ?>
</marquee>
<?php
mysqli_free_result($RecordPublishMarquee);
?>
