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

$colname_RecordLeftMenuColumn = "-1";
if (isset($_SESSION['userid'])) {
  $colname_RecordLeftMenuColumn = $_SESSION['userid'];
}
$collang_RecordLeftMenuColumn = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordLeftMenuColumn = $_SESSION['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordLeftMenuColumn = sprintf("SELECT * FROM demo_tmpcolumn WHERE userid = %s && lang = %s && location='left' ORDER BY sortid ASC", GetSQLValueString($colname_RecordLeftMenuColumn, "int"),GetSQLValueString($collang_RecordLeftMenuColumn, "text"));
$RecordLeftMenuColumn = mysqli_query($DB_Conn, $query_RecordLeftMenuColumn) or die(mysqli_error($DB_Conn));
$row_RecordLeftMenuColumn = mysqli_fetch_assoc($RecordLeftMenuColumn);
$totalRows_RecordLeftMenuColumn = mysqli_num_rows($RecordLeftMenuColumn);
?>
<style>
/* 粉絲頁自動調整寬度 */
.fb-comments, .fb-comments iframe[style] {width: 200px !important;}
.fb_iframe_widget, .fb_iframe_widget span, .fb_iframe_widget span iframe[style] {width: 200px !important;}
</style>
<?php $left_count=1; ?>
<?php if ($totalRows_RecordLeftMenuColumn > 0) { ?>
<?php do { ?>
<?php 
// 當在產品頁面 次選單跟子分類僅會出現一次
if($Tp_Page != "Product" || ($row_RecordLeftMenuColumn['type'] == 'alltypelist' && $tp_product_menu_enable != '1') || ($row_RecordLeftMenuColumn['type'] == 'productlist' && $tp_product_menu_enable != '1') || ($row_RecordLeftMenuColumn['type'] != 'alltypelist' && $row_RecordLeftMenuColumn['type'] != 'productlist')) { 
?>
<div class="<?php if($row_RecordLeftMenuColumn['indicatewrp'] == '1' && $row_RecordLeftMenuColumn['type'] != 'bline') { ?>BlockWrp<?php } else { ?>BlockWrpNone<?php } ?>"><?php if ($row_RecordLeftMenuColumn['indicatetitle'] == '1' && $row_RecordLeftMenuColumn['type'] != 'bline') { ?><div class="BlockTitle">
  <?php if ($TmpShowBlockName == '1') { ?><div class="BlockTitleWord"><?php if($row_RecordLeftMenuColumn['type'] == 'alltypelist' && $SubMenuName != "" && $row_RecordSystemConfigFr['subnamereplaceenable'] == "1") { ?><?php echo $SubMenuName ?><?php } else { ?><?php echo $row_RecordLeftMenuColumn['customname'] ?><?php } ?></div><?php } ?><?php if ($TmpBlockTitlePic != "") { ?><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpBlockWebName; ?>/image/tmpblock/<?php echo $TmpBlockTitlePic; ?>" style="display:block; margin:auto; width:100%"/><?php } ?></div><?php } ?>
  <div class="<?php if($row_RecordLeftMenuColumn['indicatemiddle'] == '1' && $row_RecordLeftMenuColumn['type'] != 'bline') { ?>BlockContent<?php } else { ?>BlockContentNone<?php } ?>">
  <?php if($row_RecordLeftMenuColumn['type'] == 'productlist') { echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s\">";include_once("require_product_leftmenu_vertical_mega_menu.php"); echo "</div>";} ?>
  <?php if($row_RecordLeftMenuColumn['type'] == 'productactlist') { echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s\">"; include_once("require_product_actlist.php"); echo "</div>";} ?>
  <?php if($row_RecordLeftMenuColumn['type'] == 'producthotlist') { echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s\">"; include_once("require_product_hotlist.php"); echo "</div>";} ?>
  <?php if($row_RecordLeftMenuColumn['type'] == 'productsalelist') { echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s\">"; include_once("require_product_salelist.php"); echo "</div>";} ?>
  <?php if($row_RecordLeftMenuColumn['type'] == 'productnewslist') { echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s\">"; include_once("require_product_newslist.php"); echo "</div>";} ?>
  <?php if($row_RecordLeftMenuColumn['type'] == 'articlelist') { echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s\">"; include("require_article_leftmenu_vertical_mega_menu.php"); echo "</div>";} ?>
  <?php if($row_RecordLeftMenuColumn['type'] == 'frilink') { include("require_frilink_qlink.php"); } ?>
  <?php if($row_RecordLeftMenuColumn['type'] == 'modlink') { include("require_modlink_qlink.php"); } ?>
  <?php if($row_RecordLeftMenuColumn['type'] == 'fbfan' && $TmpFBFanSelect == '1' && $SiteFBFan != '') { ?>
  <div style="width:100%; text-align:center; min-height:235px;">
  <div id="fb-root"></div>
  <script>(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(d.getElementById(id)){return}js=d.createElement(s);js.id=id;js.src="//connect.facebook.net/zh_TW/all.js#xfbml=1";fjs.parentNode.insertBefore(js,fjs)}(document,"script","facebook-jssdk"));</script>
  <div class="fb-like-box" data-href="https://www.facebook.com/<?php echo $SiteFBFan; ?>" data-width="200px" data-height="100%" data-show-faces="true" data-stream="false"  data-header="false" data-show-border="false" style="background-color:<?php echo $TmpFBFanBkColor?>;"></div>
  </div>
  <?php } ?>
  <?php if($row_RecordLeftMenuColumn['type'] == 'free') { echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s". "style=\"overflow:hidden\"" . "\">"; echo $row_RecordLeftMenuColumn['content'];   echo "</div>";} ?>
  <?php if($row_RecordLeftMenuColumn['type'] == 'alllist') { echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s\">"; include_once("require_all_leftmenu_vertical_mega_menu.php"); echo "</div>";} ?>
  <?php if($row_RecordLeftMenuColumn['type'] == 'blogcalendar') { echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s\">"; include_once("require_blog_calendar.php"); echo "</div>";} ?>
  <?php if($row_RecordLeftMenuColumn['type'] == 'bloglist') { echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s\">"; include_once("require_blog_leftmenu_vertical_mega_menu.php"); echo "</div>";} ?>
  <?php if($row_RecordLeftMenuColumn['type'] == 'blogplist') { echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s\">"; include_once("require_blog_plist.php"); echo "</div>";} ?>
  <?php if($row_RecordLeftMenuColumn['type'] == 'newslist') { echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s\">"; include_once("require_news_autolist_scroll.php"); echo "</div>";} ?>
  <?php if($row_RecordLeftMenuColumn['type'] == 'siteviewcount') { echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s\">"; include_once("require_viewcount.php"); echo "</div>";} ?>
  <?php if($row_RecordLeftMenuColumn['type'] == 'sitewhoscount') { include_once("require_whosviewcount.php"); } ?>
  <?php if($row_RecordLeftMenuColumn['type'] == 'alltypelist') {echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s\">"; include_once("require_tp_leftmenu_vertical_mega_menu.php"); $tp_product_menu_enable = '1'; echo "</div>";} ?>
  <?php if($row_RecordLeftMenuColumn['type'] == 'productsearch') {include_once("require_column_product_search.php");} ?>
  </div>
  <?php if ($TmpBlockBottomPic != '' && $row_RecordLeftMenuColumn['indicatemiddle'] == '1' && $row_RecordLeftMenuColumn['type'] != 'bline') { ?><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpBlockWebName; ?>/image/tmpblock/<?php echo $TmpBlockBottomPic; ?>" style="display:block; margin:auto; width:100%"/><?php } ?>
  </div>
  <?php if($row_RecordLeftMenuColumn['type'] == 'bline') { echo "<div style=\"height:5px;\"></div>"; } ?>
  <?php $left_count++; ?>
<?php } /* 當在產品頁面 次選單跟子分類僅會出現一次 END */ ?>
  <?php } while ($row_RecordLeftMenuColumn = mysqli_fetch_assoc($RecordLeftMenuColumn)); ?>
  <?php } ?>
<?php
mysqli_free_result($RecordLeftMenuColumn);
?>
