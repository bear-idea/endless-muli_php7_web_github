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

$maxRows_RecordArticle = 1;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordArticle = $page * $maxRows_RecordArticle;

$colnamelang_RecordArticle = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordArticle = $_GET['lang'];
}
$coluserid_RecordArticle = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordArticle = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordArticle = sprintf("SELECT * FROM demo_article WHERE lang = %s && home = 1  && indicate = 1 && userid=%s", GetSQLValueString($colnamelang_RecordArticle, "text"),GetSQLValueString($coluserid_RecordArticle, "int"));
$query_limit_RecordArticle = sprintf("%s LIMIT %d, %d", $query_RecordArticle, $startRow_RecordArticle, $maxRows_RecordArticle);
$RecordArticle = mysqli_query($DB_Conn, $query_limit_RecordArticle) or die(mysqli_error($DB_Conn));
$row_RecordArticle = mysqli_fetch_assoc($RecordArticle);

if (isset($_GET['totalRows_RecordArticle'])) {
  $totalRows_RecordArticle = $_GET['totalRows_RecordArticle'];
} else {
  $all_RecordArticle = mysqli_query($DB_Conn, $query_RecordArticle);
  $totalRows_RecordArticle = mysqli_num_rows($all_RecordArticle);
}
$totalPages_RecordArticle = ceil($totalRows_RecordArticle/$maxRows_RecordArticle)-1;


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
if ($totalRows_RecordArticle > 0) { 
?>
<div class="columns on-1">
    <div class="container board">
    <div class="column">
      <div class="container ct_board">
      <?php require("require_article_cmenu.php"); ?>
          <div class="cm_wrp_title"><img src="images/sicon/bullet.gif" width="18" height="18" /><?php echo $row_RecordArticle['title']; ?></div>
          <script language="javascript">
var $url = '<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>';
$url = $url.replace(/&amp;/gi, '&');
$url = encodeURIComponent($url);

document.write('<iframe  src="http://www.facebook.com/plugins/like.php?href=' + $url + '" scrolling="no"  frameborder="0" style="height: 25px; width: 100%"  allowTransparency="true"></iframe>');
                     </script>
          <?php echo pageBreak($row_RecordArticle['content']); ?>
          <?php require("require_sharelink.php"); ?>
      </div>
    </div>
    </div>
</div>
<?php } ?>
<?php } while ($row_RecordArticle = mysqli_fetch_assoc($RecordArticle)); ?>
<?php 
# 判斷當無資料顯示時之畫面
if ($totalRows_RecordArticle == 0) { 
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><font color="#FF0000">尚未指定首頁！！</font></td>
  </tr>
</table>
<?php 
}
?>
<?php } else { ?>
<?php include($TplPath . "/article_view.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordArticle);
?>