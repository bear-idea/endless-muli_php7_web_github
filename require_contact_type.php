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

$maxRows_RecordContact = 1;
$pageNum_RecordContact = 0;
if (isset($_GET['pageNum_RecordContact'])) {
  $pageNum_RecordContact = $_GET['pageNum_RecordContact'];
}
$startRow_RecordContact = $pageNum_RecordContact * $maxRows_RecordContact;

$colname_RecordContact = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordContact = $_GET['searchkey'];
}
$coluserid_RecordContact = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordContact = $_SESSION['userid'];
}
$coltype1_RecordContact = "-1";
if (isset($_GET['type1'])) {
  $coltype1_RecordContact = $_GET['type1'];
}
$coltype2_RecordContact = "-1";
if (isset($_GET['type2'])) {
  $coltype2_RecordContact = $_GET['type2'];
}
$coltype3_RecordContact = "-1";
if (isset($_GET['type3'])) {
  $coltype3_RecordContact = $_GET['type3'];
}
$colnamelang_RecordContact = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordContact = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordContact = sprintf("SELECT * FROM demo_contact WHERE ((title LIKE %s)) && lang = %s && type1 = %s && type2 = %s && type3 = %s  && indicate = 1 && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordContact . "%", "text"),GetSQLValueString($colnamelang_RecordContact, "text"),GetSQLValueString($coltype1_RecordContact, "int"),GetSQLValueString($coltype2_RecordContact, "int"),GetSQLValueString($coltype3_RecordContact, "int"),GetSQLValueString($coluserid_RecordContact, "int"));
$query_limit_RecordContact = sprintf("%s LIMIT %d, %d", $query_RecordContact, $startRow_RecordContact, $maxRows_RecordContact);
$RecordContact = mysqli_query($DB_Conn, $query_limit_RecordContact) or die(mysqli_error($DB_Conn));
$row_RecordContact = mysqli_fetch_assoc($RecordContact);

if (isset($_GET['totalRows_RecordContact'])) {
  $totalRows_RecordContact = $_GET['totalRows_RecordContact'];
} else {
  $all_RecordContact = mysqli_query($DB_Conn, $query_RecordContact);
  $totalRows_RecordContact = mysqli_num_rows($all_RecordContact);
}
$totalPages_RecordContact = ceil($totalRows_RecordContact/$maxRows_RecordContact)-1;


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
if ($totalRows_RecordContact > 0) { 
?>
<div class="columns on-1">
    <div class="container board">
    <div class="column">
      <div class="container ct_board">
      	  <?php require("require_contact_cmenu.php"); ?>
          <div class="cm_wrp_title"><img src="images/sicon/bullet.gif" width="18" height="18" /><?php echo $row_RecordContact['title']; ?></div>
          <script language="javascript">
var $url = '<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>';
$url = $url.replace(/&amp;/gi, '&');
$url = encodeURIComponent($url);

document.write('<iframe  src="http://www.facebook.com/plugins/like.php?href=' + $url + '" scrolling="no"  frameborder="0" style="height: 25px; width: 100%"  allowTransparency="true"></iframe>');
                     </script>
          <?php echo pageBreak($row_RecordContact['content']); ?>
          <?php require("require_sharelink.php"); ?>
      </div>
    </div>
    </div>
</div>
<?php } ?>
<?php } while ($row_RecordContact = mysqli_fetch_assoc($RecordContact)); ?>
<?php 
# 判斷當無資料顯示時之畫面
if ($totalRows_RecordContact == 0) { 
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
<?php include($TplPath . "/contact_type.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordContact);
?>