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

$maxRows_RecordBlogRList = 6;
$pageNum_RecordBlogRList = 0;
if (isset($_GET['pageNum_RecordBlogRList'])) {
  $pageNum_RecordBlogRList = $_GET['pageNum_RecordBlogRList'];
}
$startRow_RecordBlogRList = $pageNum_RecordBlogRList * $maxRows_RecordBlogRList;

$collang_RecordBlogRList = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordBlogRList = $_SESSION['lang'];
}
$coluserid_RecordBlogRList = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordBlogRList = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordBlogRList = sprintf("SELECT demo_blog.userid, demo_blogpost.author, demo_blogpost.retitle, demo_blogpost.id, demo_blogpost.pid, demo_blogpost.postdate, demo_blogpost.content, demo_blog.type1, demo_blog.type2, demo_blog.type3, demo_blog.indicate, demo_blog.lang, demo_blogpost.postdate FROM demo_blog RIGHT OUTER JOIN demo_blogpost ON demo_blog.id = demo_blogpost.pid HAVING (demo_blog.lang = %s) && (demo_blog.indicate = 1) && (demo_blog.userid = %s) ORDER BY demo_blogpost.postdate DESC", GetSQLValueString($collang_RecordBlogRList, "text"),GetSQLValueString($coluserid_RecordBlogRList, "int"));
$query_limit_RecordBlogRList = sprintf("%s LIMIT %d, %d", $query_RecordBlogRList, $startRow_RecordBlogRList, $maxRows_RecordBlogRList);
$RecordBlogRList = mysqli_query($DB_Conn, $query_limit_RecordBlogRList) or die(mysqli_error($DB_Conn));
$row_RecordBlogRList = mysqli_fetch_assoc($RecordBlogRList);

if (isset($_GET['totalRows_RecordBlogRList'])) {
  $totalRows_RecordBlogRList = $_GET['totalRows_RecordBlogRList'];
} else {
  $all_RecordBlogRList = mysqli_query($DB_Conn, $query_RecordBlogRList);
  $totalRows_RecordBlogRList = mysqli_num_rows($all_RecordBlogRList);
}
$totalPages_RecordBlogRList = ceil($totalRows_RecordBlogRList/$maxRows_RecordBlogRList)-1;
?>
<?php
 // Trim by length (by FELIXONE.it)
function TrimByLengthBlogReply($str, $len, $word) {
  $end = "";
  if (strlen($str) > $len) $end = "...";
  $str = mb_substr($str, 0, $len, "UTF-8");
  if ($word) $str = substr($str,0,strrpos($str," ")+1);
  return $str.$end;
}
?>
<div style="text-align:left; padding: 5px 10px; word-wrap:break-word; overflow:hidden;">
<ul>
<?php if ($totalRows_RecordBlogRList > 0) { // Show if recordset not empty ?>
  <?php do { ?>
  	<?php // 判斷商品所在之層級
                                if($row_RecordBlogRList['type1'] != '-1' && $row_RecordBlogRList['type2'] != '-1' && $row_RecordBlogRList['type3'] != '-1') { $level='2'; }
                                else if($row_RecordBlogRList['type1'] != '-1' && $row_RecordBlogRList['type2'] != '-1' && $row_RecordBlogRList['type3'] == '-1') { $level='1'; }
                                else if($row_RecordBlogRList['type1'] != '-1' && $row_RecordBlogRList['type2'] == '-1' && $row_RecordBlogRList['type3'] == '-1') { $level='0'; }
                                else { $level=''; }
                            ?>
    <li><a href="blog.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=detailed&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;tp=Blog&amp;level=<?php echo $level; ?>&amp;type1=<?php echo $row_RecordBlogRList['type1']; ?>&amp;type2=<?php echo $row_RecordBlogRList['type2']; ?>&amp;type3=<?php echo $row_RecordBlogRList['type3']; ?>&amp;id=<?php echo $row_RecordBlogRList['pid']; ?>#rpdown" title="<?php echo $row_RecordBlogRList['content'];?>"><?php echo TrimByLengthBlogReply(($row_RecordBlogRList['retitle']), 12, false); ?></a> <span style="color:#666;">by <?php echo $row_RecordBlogRList['author'];?> (<?php echo date('M d',$row_RecordBlogRList['postdate']);?>)</span></li>
    <?php } while ($row_RecordBlogRList = mysqli_fetch_assoc($RecordBlogRList)); ?>
<?php } // Show if recordset not empty ?>
</ul>
</div>
<?php
mysqli_free_result($RecordBlogRList);
?>