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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecordNewsAutoListScroll = 30;
$pageAutoListScroll = 0;
if (isset($_GET['pageAutoListScroll'])) {
  $pageAutoListScroll = $_GET['pageAutoListScroll'];
}
$startRow_RecordNewsAutoListScroll = $pageAutoListScroll * $maxRows_RecordNewsAutoListScroll;

$collang_RecordNewsAutoListScroll = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordNewsAutoListScroll = $_GET['lang'];
}
$coluserid_RecordNewsAutoListScroll = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordNewsAutoListScroll = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNewsAutoListScroll = sprintf("SELECT * FROM demo_news WHERE indicate=1 && lang = %s && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString($collang_RecordNewsAutoListScroll, "text"),GetSQLValueString($coluserid_RecordNewsAutoListScroll, "int"));
$query_limit_RecordNewsAutoListScroll = sprintf("%s LIMIT %d, %d", $query_RecordNewsAutoListScroll, $startRow_RecordNewsAutoListScroll, $maxRows_RecordNewsAutoListScroll);
$RecordNewsAutoListScroll = mysqli_query($DB_Conn, $query_limit_RecordNewsAutoListScroll) or die(mysqli_error($DB_Conn));
$row_RecordNewsAutoListScroll = mysqli_fetch_assoc($RecordNewsAutoListScroll);

if (isset($_GET['totalRows_RecordNewsAutoListScroll'])) {
  $totalRows_RecordNewsAutoListScroll = $_GET['totalRows_RecordNewsAutoListScroll'];
} else {
  $all_RecordNewsAutoListScroll = mysqli_query($DB_Conn, $query_RecordNewsAutoListScroll);
  $totalRows_RecordNewsAutoListScroll = mysqli_num_rows($all_RecordNewsAutoListScroll);
}
$totalPages_RecordNewsAutoListScroll = ceil($totalRows_RecordNewsAutoListScroll/$maxRows_RecordNewsAutoListScroll)-1;
?>
<style type="text/css">
.ct_board_title{padding:5px; color:#FFF; background-color:#333; margin-top:5px; margin-right:0px; margin-bottom:0px; margin-left:0px}
.autolist-news-scroll{border:0px solid #DDD; min-height:320px; overflow:hidden; position:relative; text-align:left; margin-right:0px; margin-left:0px}
.autolist-news-scroll ul{position:absolute; padding-left:0px;}
.autolist-news-scroll li{clear:left; padding:5px 0 5px 19px; border-top-width:0px; border-right-width:0px; border-bottom-width:1px; border-left-width:0px; border-top-style:dotted; border-right-style:dotted; border-bottom-style:dotted; border-left-style:dotted; border-top-color:#DDD; border-right-color:#DDD; border-bottom-color:#DDD; border-left-color:#DDD; line-height:19px; vertical-align:middle;}
</style>
<!--<div class="columns on-1 ct_board_title">
  <div class="container">
  	最新訊息
  </div>
</div> -->
<?php if ($totalRows_RecordNewsAutoListScroll > 0) { // Show if recordset not empty ?>
<div class="autolist-news-scroll ">
  <ul>
    <?php do { ?>
      <li><span class="TipTypeStyle">[<?php echo $row_RecordNewsAutoListScroll['type']; ?>]</span><a href="<?php echo $SiteBaseUrl . url_rewrite("news",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordNewsAutoListScroll['id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordNewsAutoListScroll['title']; ?></a></li>
      <?php } while ($row_RecordNewsAutoListScroll = mysqli_fetch_assoc($RecordNewsAutoListScroll)); ?>
  </ul>
</div>
<?php } // Show if recordset not empty ?>
<script type="text/javascript">
$(function(){function b(){a.animate({top:e+"px"},f,function(){var c=a.find("li:last");c.clone().hide().prependTo(a).fadeIn(g,function(){setTimeout(b,d)});a.css("top",0);c.remove()})}var a=$(".autolist-news-scroll ul"),e=a.find("li").outerHeight(!0),f=400,g=400,d=3E3;setTimeout(b,d)});
</script>
<?php
mysqli_free_result($RecordNewsAutoListScroll);
?>
