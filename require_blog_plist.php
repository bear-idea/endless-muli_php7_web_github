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

$maxRows_RecordBlogPList = 10;
$pageNum_RecordBlogPList = 0;
if (isset($_GET['pageNum_RecordBlogPList'])) {
  $pageNum_RecordBlogPList = $_GET['pageNum_RecordBlogPList'];
}
$startRow_RecordBlogPList = $pageNum_RecordBlogPList * $maxRows_RecordBlogPList;

$coluserid_RecordBlogPList = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordBlogPList = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordBlogPList = sprintf("SELECT * FROM demo_blog WHERE userid = %s && indicate=1 ORDER BY postdate", GetSQLValueString($coluserid_RecordBlogPList, "int"));
$query_limit_RecordBlogPList = sprintf("%s LIMIT %d, %d", $query_RecordBlogPList, $startRow_RecordBlogPList, $maxRows_RecordBlogPList);
$RecordBlogPList = mysqli_query($DB_Conn, $query_limit_RecordBlogPList) or die(mysqli_error($DB_Conn));
$row_RecordBlogPList = mysqli_fetch_assoc($RecordBlogPList);

if (isset($_GET['totalRows_RecordBlogPList'])) {
  $totalRows_RecordBlogPList = $_GET['totalRows_RecordBlogPList'];
} else {
  $all_RecordBlogPList = mysqli_query($DB_Conn, $query_RecordBlogPList);
  $totalRows_RecordBlogPList = mysqli_num_rows($all_RecordBlogPList);
}
$totalPages_RecordBlogPList = ceil($totalRows_RecordBlogPList/$maxRows_RecordBlogPList)-1;
?>
<?php
 // Trim by length (by FELIXONE.it)
function TrimByLengthBlog($str, $len, $word) {
  $end = "";
  if (strlen($str) > $len) $end = "...";
  $str = mb_substr($str, 0, $len, "UTF-8");
  if ($word) $str = substr($str,0,strrpos($str," ")+1);
  return $str.$end;
}
?>
<div style="text-align:left; padding: 5px 10px;">
<ul>
<?php if ($totalRows_RecordBlogPList > 0) { // Show if recordset not empty ?>
  <?php do { ?>
  	<?php // 判斷商品所在之層級
                                if($row_RecordBlogPList['type1'] != '-1' && $row_RecordBlogPList['type2'] != '-1' && $row_RecordBlogPList['type3'] != '-1') { $level='2'; }
                                else if($row_RecordBlogPList['type1'] != '-1' && $row_RecordBlogPList['type2'] != '-1' && $row_RecordBlogPList['type3'] == '-1') { $level='1'; }
                                else if($row_RecordBlogPList['type1'] != '-1' && $row_RecordBlogPList['type2'] == '-1' && $row_RecordBlogPList['type3'] == '-1') { $level='0'; }
                                else { $level=''; }
                            ?>
    <li><a href="blog.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=detailed&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;tp=Blog&amp;level=<?php echo $level; ?>&amp;type1=<?php echo $row_RecordBlogPList['type1']; ?>&amp;type2=<?php echo $row_RecordBlogPList['type2']; ?>&amp;type3=<?php echo $row_RecordBlogPList['type3']; ?>&amp;id=<?php echo $row_RecordBlogPList['id']; ?>" title="<?php echo $row_RecordBlogPList['title'];?>"><?php echo TrimByLengthBlog(($row_RecordBlogPList['title']), 12, false); ?></a></li>
    <?php } while ($row_RecordBlogPList = mysqli_fetch_assoc($RecordBlogPList)); ?>
<?php } // Show if recordset not empty ?>
</ul>
</div>
<?php
mysqli_free_result($RecordBlogPList);
?>
