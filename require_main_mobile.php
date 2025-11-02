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
<?php if ($row_RecordTmpConfig['tmphomeboardtitleindicate'] == "0") { ?>
.ct_title {display:none}
<?php } ?>
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
<div class="<?php if($HomeStyle == 'homeboard002' && $row_RecordMiddleColumn['boxed'] == '1') { echo "container"; } ?>"> 
<div class="<?php echo $row_RecordMiddleColumn['colclass']; ?>">
<!--<div class="divseparators ss-style-slit margin-top-100">-->

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
  <?php if($row_RecordMiddleColumn['type'] == 'News') { $ModuleName['News'] = $row_RecordMiddleColumn['customname']; require("require_news_home_mobile.php"); } ?>
  <?php if($row_RecordMiddleColumn['type'] == 'Publish') { $ModuleName['Publish'] = $row_RecordMiddleColumn['customname']; require("require_publish_home_mobile.php"); } ?>
  <?php if($row_RecordMiddleColumn['type'] == 'Letters') { $ModuleName['Letters'] = $row_RecordMiddleColumn['customname']; require("require_letters_home_mobile.php"); } ?>
  <?php if($row_RecordMiddleColumn['type'] == 'Actnews') { $ModuleName['Actnews'] = $row_RecordMiddleColumn['customname']; require("require_actnews_home_mobile.php"); } ?>
  <?php if($row_RecordMiddleColumn['type'] == 'Partner') { $ModuleName['Partner'] = $row_RecordMiddleColumn['customname']; require("require_partner_home_mobile.php"); } ?>
  <?php if($row_RecordMiddleColumn['type'] == 'Video') { $ModuleName['Video'] = $row_RecordMiddleColumn['customname']; require("require_video_home_mobile.php"); } ?>
  <?php if($row_RecordMiddleColumn['type'] == 'Product') { $ModuleName['Product'] = $row_RecordMiddleColumn['customname']; require("require_product_home_mobile.php"); } ?>
  <?php if($row_RecordMiddleColumn['type'] == 'Project') { $ModuleName['Project'] = $row_RecordMiddleColumn['customname']; require("require_project_home_mobile.php"); } ?>
  <?php if($row_RecordMiddleColumn['type'] == 'Activities') { $ModuleName['Activities'] = $row_RecordMiddleColumn['customname']; require("require_activities_home_mobile.php"); } ?>
  <?php if($row_RecordMiddleColumn['type'] == 'Sponsor') { $ModuleName['Sponsor'] = $row_RecordMiddleColumn['customname']; require("require_sponsor_home_mobile.php"); } ?>
  <?php if($row_RecordMiddleColumn['type'] == 'Ads') { $ModuleName_Ads = $row_RecordMiddleColumn['customname']; require("require_banner_contentimage_mobile.php"); } ?>
  <?php if($row_RecordMiddleColumn['type'] == 'Free') { ?>
  <div class="ct_title">
          <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $row_RecordMiddleColumn['customname']; // 標題文字 ?></span></h1>
  </div>
   <div class="Scroll_Bar" <?php if($row_RecordMiddleColumn['height'] != "") { ?>style="height:<?php echo $row_RecordMiddleColumn['height']; ?>px;"<?php } ?>> 
               
  <!--<div style="height:5px;"></div>-->
  <?php echo $row_RecordMiddleColumn['content'];?>
  </div> 
  <?php } ?>
		  <div class="clearfix"></div>
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

<!--<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 100 10" preserveAspectRatio="none">
<polygon fill="#000" points="0,0 100,8 100,10 0,10"></polygon>
<polygon fill="#111" points="0,8 100,10 0,10"></polygon>
</svg>

</div>-->

</div>
</div>

<?php } ?>
<?php } while ($row_RecordMiddleColumn = mysqli_fetch_assoc($RecordMiddleColumn)); ?>
<?php } ?>
<?php
mysqli_free_result($RecordMiddleColumn);
?>
