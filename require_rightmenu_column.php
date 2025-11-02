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

$colname_RecordRightMenuColumn = "-1";
if (isset($_SESSION['userid'])) {
  $colname_RecordRightMenuColumn = $_SESSION['userid'];
}
$collang_RecordRightMenuColumn = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordRightMenuColumn = $_SESSION['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordRightMenuColumn = sprintf("SELECT * FROM demo_tmpcolumn WHERE userid = %s && lang = %s && location='right' ORDER BY sortid ASC", GetSQLValueString($colname_RecordRightMenuColumn, "int"),GetSQLValueString($collang_RecordRightMenuColumn, "text"));
$RecordRightMenuColumn = mysqli_query($DB_Conn, $query_RecordRightMenuColumn) or die(mysqli_error($DB_Conn));
$row_RecordRightMenuColumn = mysqli_fetch_assoc($RecordRightMenuColumn);
$totalRows_RecordRightMenuColumn = mysqli_num_rows($RecordRightMenuColumn);
?>
<style>
/* 粉絲頁自動調整寬度 */
.fb-comments, .fb-comments iframe[style] {width: 200px !important;}
.fb_iframe_widget, .fb_iframe_widget span, .fb_iframe_widget span iframe[style] {width: 200px !important;}
</style>
<?php $left_count=1; ?>
<?php do { ?>
<div class="<?php if($row_RecordRightMenuColumn['indicatewrp'] == '1' && $row_RecordRightMenuColumn['type'] != 'bline') { ?>BlockWrp<?php } else { ?>BlockWrpNone<?php } ?>">
  <?php if ($row_RecordRightMenuColumn['indicatetitle'] == '1' && $row_RecordRightMenuColumn['type'] != 'bline') { ?><div class="BlockTitle">
  <?php if ($TmpShowBlockName == '1') { ?><div class="BlockTitleWord"><?php if($row_RecordLeftMenuColumn['type'] == 'alltypelist' && $SubMenuName != "" && $row_RecordSystemConfigFr['subnamereplaceenable'] == "1") { ?><?php echo $SubMenuName ?><?php } else { ?><?php echo $row_RecordLeftMenuColumn['customname'] ?><?php } ?></div><?php } ?><?php if ($TmpBlockTitlePic != "") { ?><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpBlockWebName; ?>/image/tmpblock/<?php echo $TmpBlockTitlePic; ?>" style="display:block; margin:auto; width:100%"/><?php } ?></div><?php } ?>
  <div class="<?php if($row_RecordRightMenuColumn['indicatemiddle'] == '1' && $row_RecordRightMenuColumn['type'] != 'bline') { ?>BlockContent<?php } else { ?>BlockContentNone<?php } ?>">
  <?php if($row_RecordRightMenuColumn['type'] == 'productlist') { echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s\">";include_once("require_product_leftmenu_vertical_mega_menu.php"); echo "</div>";} ?>
  <?php if($row_RecordRightMenuColumn['type'] == 'productactlist') { echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s\">"; include_once("require_product_actlist.php"); echo "</div>";} ?>
  <?php if($row_RecordRightMenuColumn['type'] == 'producthotlist') { echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s\">"; include_once("require_product_hotlist.php"); echo "</div>";} ?>
  <?php if($row_RecordRightMenuColumn['type'] == 'productsalelist') { echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s\">"; include_once("require_product_salelist.php"); echo "</div>";} ?>
  <?php if($row_RecordRightMenuColumn['type'] == 'productnewslist') { echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s\">"; include_once("require_product_newslist.php"); echo "</div>";} ?>
  <?php if($row_RecordRightMenuColumn['type'] == 'articlelist') { echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s\">"; include("require_article_leftmenu_vertical_mega_menu.php"); echo "</div>";} ?>
  <?php if($row_RecordRightMenuColumn['type'] == 'frilink') { include("require_frilink_qlink.php"); } ?>
  <?php if($row_RecordRightMenuColumn['type'] == 'modlink') { include("require_modlink_qlink.php"); } ?>
  <?php if($row_RecordRightMenuColumn['type'] == 'fbfan' && $TmpFBFanSelect == '1' && $SiteFBFan != '') { ?>
  <div style="margin:5px;"></div>
  <div style="width:100%; text-align:center; min-height:235px;">
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/zh_TW/all.js#xfbml=1";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
  <div class="fb-like-box" data-href="https://www.facebook.com/<?php echo $SiteFBFan; ?>" data-width="200px" data-height="100%" data-show-faces="true" data-stream="false"  data-header="false" data-show-border="false" style="background-color:<?php echo $TmpFBFanBkColor?>;"></div>
  </div>
  <?php } ?>
  <?php if($row_RecordRightMenuColumn['type'] == 'free') { echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s". "style=\"overflow:hidden\"" . "\">"; echo $row_RecordRightMenuColumn['content'];   echo "</div>";} ?>
  <?php if($row_RecordRightMenuColumn['type'] == 'alllist') { echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s\">"; include_once("require_all_leftmenu_vertical_mega_menu.php"); echo "</div>";} ?>
  <?php if($row_RecordRightMenuColumn['type'] == 'blogcalendar') { echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s\">"; include_once("require_blog_calendar.php"); echo "</div>";} ?>
  <?php if($row_RecordRightMenuColumn['type'] == 'bloglist') { echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s\">"; include_once("require_blog_leftmenu_vertical_mega_menu.php"); echo "</div>";} ?>
  <?php if($row_RecordRightMenuColumn['type'] == 'blogplist') { echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s\">"; include_once("require_blog_plist.php"); echo "</div>";} ?>
  <?php if($row_RecordRightMenuColumn['type'] == 'newslist') { echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s\">"; include_once("require_news_autolist_scroll.php"); echo "</div>";} ?>
  <?php if($row_RecordRightMenuColumn['type'] == 'siteviewcount') { echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s\">"; include_once("require_viewcount.php"); echo "</div>";} ?>
  <?php if($row_RecordRightMenuColumn['type'] == 'sitewhoscount') { include_once("require_whosviewcount.php"); } ?>
  <?php if($row_RecordRightMenuColumn['type'] == 'alltypelist') {echo"<div data-scroll-reveal=\"enter top after ". $left_count/10 ."s\">"; include_once("require_tp_leftmenu_vertical_mega_menu.php"); echo "</div>";} ?>
  </div>
  <?php if ($TmpBlockBottomPic != '' && $row_RecordRightMenuColumn['indicatemiddle'] == '1' && $row_RecordRightMenuColumn['type'] != 'bline') { ?><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpBlockWebName; ?>/image/tmpblock/<?php echo $TmpBlockBottomPic; ?>" style="display:block; margin:auto; width:100%"/><?php } ?>
  </div>
  <?php if($row_RecordRightMenuColumn['type'] == 'bline') { echo "<div style=\"height:5px;\"></div>"; } ?>
  <?php $left_count++; ?>
  <?php } while ($row_RecordRightMenuColumn = mysqli_fetch_assoc($RecordRightMenuColumn)); ?>
<?php
mysqli_free_result($RecordRightMenuColumn);
?>