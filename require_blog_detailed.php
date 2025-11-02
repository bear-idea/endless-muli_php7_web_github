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

$maxRows_RecordBlog = 1;
$pageNum_RecordBlog = 0;
if (isset($_GET['pageNum_RecordBlog'])) {
  $pageNum_RecordBlog = $_GET['pageNum_RecordBlog'];
}
$startRow_RecordBlog = $pageNum_RecordBlog * $maxRows_RecordBlog;

$coltype1_RecordBlog = "-1";
if (isset($_GET['type1'])) {
  $coltype1_RecordBlog = $_GET['type1'];
}
$coluserid_RecordBlog = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordBlog = $_SESSION['userid'];
}
$colid_RecordBlog = "-1";
if (isset($_GET['id'])) {
  $colid_RecordBlog = $_GET['id'];
}
$coltype2_RecordBlog = "-1";
if (isset($_GET['type2'])) {
  $coltype2_RecordBlog = $_GET['type2'];
}
$coltype3_RecordBlog = "-1";
if (isset($_GET['type3'])) {
  $coltype3_RecordBlog = $_GET['type3'];
}
$colnamelang_RecordBlog = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordBlog = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordBlog = sprintf("SELECT * FROM demo_blog WHERE lang = %s && type1 = %s && type2 = %s && type3 = %s && id = %s  && indicate = 1 && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString($colnamelang_RecordBlog, "text"),GetSQLValueString($coltype1_RecordBlog, "int"),GetSQLValueString($coltype2_RecordBlog, "int"),GetSQLValueString($coltype3_RecordBlog, "int"),GetSQLValueString($colid_RecordBlog, "int"),GetSQLValueString($coluserid_RecordBlog, "int"));
$query_limit_RecordBlog = sprintf("%s LIMIT %d, %d", $query_RecordBlog, $startRow_RecordBlog, $maxRows_RecordBlog);
$RecordBlog = mysqli_query($DB_Conn, $query_limit_RecordBlog) or die(mysqli_error($DB_Conn));
$row_RecordBlog = mysqli_fetch_assoc($RecordBlog);

if (isset($_GET['totalRows_RecordBlog'])) {
  $totalRows_RecordBlog = $_GET['totalRows_RecordBlog'];
} else {
  $all_RecordBlog = mysqli_query($DB_Conn, $query_RecordBlog);
  $totalRows_RecordBlog = mysqli_num_rows($all_RecordBlog);
}
$totalPages_RecordBlog = ceil($totalRows_RecordBlog/$maxRows_RecordBlog)-1;


?>
<?php if ($MSTMP == 'default') { ?>
<?php
/*********************************************************************
 # 主頁面產品資訊
 *********************************************************************/
?>
<div class="columns on-1">
        <div class="container">
            <div class="column">
                <div class="container ct_board">
                <h3><span class="titlesicon"><img src="images/dot_02.jpg" width="15" height="20" /></span>
                文章一覽</h3>
                </div>
            </div>
        </div>        
</div>
<?php do { ?>
<?php 
if ($totalRows_RecordBlog > 0) { 
?>
<div class="columns on-1">
    <div class="container board">
    <div class="column">
      <div class="container ct_board">
      <?php require("require_blog_cmenu.php"); ?>
          <div class="cm_wrp_title"><img src="images/sicon/bullet.gif" width="18" height="18" /><?php echo $row_RecordBlog['title']; ?></div>
          <script language="javascript">
var $url = '<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>';
$url = $url.replace(/&amp;/gi, '&');
$url = encodeURIComponent($url);

document.write('<iframe  src="http://www.facebook.com/plugins/like.php?href=' + $url + '" scrolling="no"  frameborder="0" style="height: 25px; width: 100%"  allowTransparency="true"></iframe>');
                     </script>
          <?php echo pageBreak($row_RecordBlog['content']); ?>
          <?php require("require_sharelink.php"); ?>
      </div>
    </div>
    </div>
</div>
<?php } ?>
<?php } while ($row_RecordBlog = mysqli_fetch_assoc($RecordBlog)); ?>
<?php 
# 判斷當無資料顯示時之畫面
if ($totalRows_RecordBlog == 0) { 
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><font color="#FF0000">目前尚無資料！！</font></td>
  </tr>
</table>
<?php 
}
?>
<?php } else { ?>
<?php include($TplPath . "/blog_detailed.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordBlog);
?>