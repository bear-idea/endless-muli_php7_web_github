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

$colname_RecordMiddleColumn = "-1";
if (isset($_SESSION['userid'])) {
  $colname_RecordMiddleColumn = $_SESSION['userid'];
}
$collang_RecordMiddleColumn = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordMiddleColumn = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordMiddleColumn = sprintf("SELECT * FROM demo_tmphomeblockcolumn WHERE userid = %s && lang=%s ORDER BY sortid ASC", GetSQLValueString($colname_RecordMiddleColumn, "int"),GetSQLValueString($collang_RecordMiddleColumn, "text"));
$RecordMiddleColumn = mysqli_query($DB_Conn, $query_RecordMiddleColumn) or die(mysqli_error($DB_Conn));
$row_RecordMiddleColumn = mysqli_fetch_assoc($RecordMiddleColumn);
$totalRows_RecordMiddleColumn = mysqli_num_rows($RecordMiddleColumn);
?>
<style type="text/css">
.Auto_Block_Wrp {
}
.Scroll_Bar {overflow:hidden; padding:5px;}
.Scroll_Bar_horizontal {overflow:hidden; padding:5px;}
</style>
<script>
	(function($){
		$(window).load(function(){
			$(".Scroll_Bar").mCustomScrollbar({
				scrollButtons:{
					enable:true
				},
				theme:"dark-thin"
			});
			$(".Scroll_Bar_horizontal").mCustomScrollbar({
				scrollButtons:{
					enable:true
				},
				horizontalScroll:true,
				theme:"dark-thin"
			});
		});
	})(jQuery);
</script>
<?php if ($totalRows_RecordMiddleColumn > 0) { ?>
<?php do { ?>
<?php if ($row_RecordMiddleColumn['type'] != "Free3" && $row_RecordMiddleColumn['type'] != "Free2" && $row_RecordMiddleColumn['type'] != "Free1") { ?>
<!--標題外框-->
<div style="position:relative;">
  <div class="mdhome HomeBoardStyle">
    <div class="mdhome_t">
      <div class="mdhome_t_l"> </div>
      <div class="mdhome_t_r"> </div>
      <div class="mdhome_t_c"><!--標題--></div>
      <div class="mdhome_t_m"><!--更多--></div>
    </div><!--mdhome_t-->
    <div class="mdhome_c g_p_hide">
      <div class="mdhome_c_l g_p_fill"> </div>
      <div class="mdhome_c_r g_p_fill"> </div>
      <div class="mdhome_c_c">
        <!-- <div class="mdhome_m_t"></div>
					<div class="mdhome_m_c">  --> 
  <!--標題外框--> 
  <?php //echo $row_RecordMiddleColumn['type'] ?>
  <?php if($row_RecordMiddleColumn['type'] == 'News') { require("require_news_home.php");  } ?>
  <?php if($row_RecordMiddleColumn['type'] == 'Publish') { require("require_publish_home.php"); } ?>
  <?php if($row_RecordMiddleColumn['type'] == 'Letters') { require("require_letters_home.php"); } ?>
  <?php if($row_RecordMiddleColumn['type'] == 'Actnews') { require("require_actnews_home.php"); } ?>
  <?php if($row_RecordMiddleColumn['type'] == 'Partner') { require("require_partner_home.php"); } ?>
  <?php if($row_RecordMiddleColumn['type'] == 'Video') { require("require_video_home.php"); } ?>
  <?php if($row_RecordMiddleColumn['type'] == 'Product') { require("require_product_home.php"); } ?>
  <?php if($row_RecordMiddleColumn['type'] == 'Project') { require("require_project_home.php"); } ?>
  <?php if($row_RecordMiddleColumn['type'] == 'Activities') { require("require_activities_home.php"); } ?>
  <?php if($row_RecordMiddleColumn['type'] == 'Sponsor') { require("require_sponsor_home.php"); } ?>
  <?php if($row_RecordMiddleColumn['type'] == 'Ads') { require("require_banner_contentimage.php"); } ?>
  <?php if($row_RecordMiddleColumn['type'] == 'Free') { ?>
    
  <div class="columns on-1">
    <div class="container">
      <div class="column">  
        <div class="container ct_board ct_title">
          <h3><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <?php echo $row_RecordMiddleColumn['customname']; // 標題文字 ?></h3>
          </div>
        </div>
      </div>
  </div>
  <div style="height:5px;"></div>
  <?php echo $row_RecordMiddleColumn['content'];?>
  <?php } ?>
  
  <!--標題外框-->
        <!--</div>
					<div class="mdhome_m_b"></div>-->
        </div>
    </div><!--mdhome_c-->
    <div class="mdhome_b">
      <div class="mdhome_b_l"> </div>
      <div class="mdhome_b_r"> </div>
      <div class="mdhome_b_c"> </div>
    </div><!--mdhome_b-->
  </div><!--mdhome-->
</div>
<!-- 標題外框-->
<?php } ?>
<?php } while ($row_RecordMiddleColumn = mysqli_fetch_assoc($RecordMiddleColumn)); ?>
<?php } ?>
<?php
mysqli_free_result($RecordMiddleColumn);
?>
