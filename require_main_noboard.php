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
if (isset($_SESSION['lang'])) {
  $collang_RecordMiddleColumn = $_SESSION['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordMiddleColumn = sprintf("SELECT * FROM demo_tmphomeblockcolumn WHERE userid = %s && lang=%s ORDER BY sortid ASC, id ASC", GetSQLValueString($colname_RecordMiddleColumn, "int"),GetSQLValueString($collang_RecordMiddleColumn, "text"));
$RecordMiddleColumn = mysqli_query($DB_Conn, $query_RecordMiddleColumn) or die(mysqli_error($DB_Conn));
$row_RecordMiddleColumn = mysqli_fetch_assoc($RecordMiddleColumn);
$totalRows_RecordMiddleColumn = mysqli_num_rows($RecordMiddleColumn);
?>
<style type="text/css">
.Auto_Block_Wrp{}
.Scroll_Bar{height:240px; overflow:hidden;  padding:5px}
.Scroll_Bar_horizontal{height:240px; overflow:hidden;  padding:5px}
.Auto_Block1{width:220px; padding:5px; overflow:hidden; -webkit-border-radius:8px; -moz-border-radius:8px; border-radius:8px}
.Auto_Block2{width:460px; padding:5px; overflow:hidden; -webkit-border-radius:8px; -moz-border-radius:8px; border-radius:8px}
.Auto_Block3{width:700px; padding:5px; overflow:hidden; -webkit-border-radius:8px; -moz-border-radius:8px; border-radius:8px}
.Auto_Block4{width:940px; padding:5px; overflow:hidden; -webkit-border-radius:8px; -moz-border-radius:8px; border-radius:8px}
.Auto_Block_News,.Auto_Block_Publish,.Auto_Block_Letters,.Auto_Block_Actnews,.Auto_Block_Partner,.Auto_Block_Video,.Auto_Block_Project,.Auto_Block_Product,.Auto_Block_Actitivies,.Auto_Block_Sponsor{width:700px; padding:5px; overflow:hidden; -webkit-border-radius:8px; -moz-border-radius:8px; border-radius:8px}
.Scroll_Bar_Content{margin:40px; width:260px; height:500px; padding:20px; overflow:auto; background:#333; -webkit-border-radius:3px; -moz-border-radius:3px; border-radius:3px}
.Scroll_Bar_Wrp{background:#bba; width:200px; height:200px}
</style>
<script type="text/javascript">
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
<div class="Auto_Block_Wrp">
<?php do { ?>
  <?php if($row_RecordMiddleColumn['type'] == 'News') { ?>
  <style type="text/css">.Auto_Block_News .Scroll_Bar{height:<?php echo $row_RecordMiddleColumn['height']; ?>px;}<?php if ($row_RecordMiddleColumn['indicatetitle'] == '0') { ?>.Auto_Block_News .ct_title{display:none;}<?php } ?></style>
  <div class="Auto_Block Auto_Block_News" style="background-color:<?php echo $row_RecordMiddleColumn['backgroundcolor']; ?>; <?php if ($row_RecordMiddleColumn['boardenable'] == '1') { ?>border:<?php echo $row_RecordMiddleColumn['boardcolor']; ?> solid 1px; <?php } ?>margin:<?php if ($row_RecordMiddleColumn['boardenable'] == '1') {echo "4px";} else {echo "5px";} ?>">
  <?php require("require_news_home.php"); ?>
  </div>
  <?php } ?>
  
  <?php if($row_RecordMiddleColumn['type'] == 'Publish') { ?>
  <style type="text/css">.Auto_Block_Publish .Scroll_Bar{height:<?php echo $row_RecordMiddleColumn['height']; ?>px;}<?php if ($row_RecordMiddleColumn['indicatetitle'] == '0') { ?>.Auto_Block_News .ct_title{display:none;}<?php } ?></style>
  <div class="Auto_Block Auto_Block_Publish" style="background-color:<?php echo $row_RecordMiddleColumn['backgroundcolor']; ?>; <?php if ($row_RecordMiddleColumn['boardenable'] == '1') { ?>border:<?php echo $row_RecordMiddleColumn['boardcolor']; ?> solid 1px; <?php } ?>margin:<?php if ($row_RecordMiddleColumn['boardenable'] == '1') {echo "4px";} else {echo "5px";} ?>">
  <?php require("require_publish_home.php"); ?>
  </div>
  <?php } ?>
  
  <?php if($row_RecordMiddleColumn['type'] == 'Letters') { ?>
  <style type="text/css">.Auto_Block_Letters .Scroll_Bar{height:<?php echo $row_RecordMiddleColumn['height']; ?>px;}<?php if ($row_RecordMiddleColumn['indicatetitle'] == '0') { ?>.Auto_Block_News .ct_title{display:none;}<?php } ?></style>
  <div class="Auto_Block Auto_Block_Letters" style="background-color:<?php echo $row_RecordMiddleColumn['backgroundcolor']; ?>; <?php if ($row_RecordMiddleColumn['boardenable'] == '1') { ?>border:<?php echo $row_RecordMiddleColumn['boardcolor']; ?> solid 1px; <?php } ?>margin:<?php if ($row_RecordMiddleColumn['boardenable'] == '1') {echo "4px";} else {echo "5px";} ?>">
  <?php require("require_letters_home.php"); ?>
  </div>
  <?php } ?>
  
  <?php if($row_RecordMiddleColumn['type'] == 'Actnews') { ?>
  <style type="text/css">.Auto_Block_Actnews .Scroll_Bar{height:<?php echo $row_RecordMiddleColumn['height']; ?>px;}<?php if ($row_RecordMiddleColumn['indicatetitle'] == '0') { ?>.Auto_Block_News .ct_title{display:none;}<?php } ?></style>
  <div class="Auto_Block Auto_Block_Actnews" style="background-color:<?php echo $row_RecordMiddleColumn['backgroundcolor']; ?>; <?php if ($row_RecordMiddleColumn['boardenable'] == '1') { ?>border:<?php echo $row_RecordMiddleColumn['boardcolor']; ?> solid 1px; <?php } ?>margin:<?php if ($row_RecordMiddleColumn['boardenable'] == '1') {echo "4px";} else {echo "5px";} ?>">
  <?php require("require_actnews_home.php"); ?>
  </div>
  <?php } ?>
  
  <?php if($row_RecordMiddleColumn['type'] == 'Partner') { ?>
  <style type="text/css">.Auto_Block_Partner .Scroll_Bar_horizontal{height:<?php echo $row_RecordMiddleColumn['height']; ?>px;}<?php if ($row_RecordMiddleColumn['indicatetitle'] == '0') { ?>.Auto_Block_News .ct_title{display:none;}<?php } ?></style>
  <div class="Auto_Block Auto_Block_Partner" style="background-color:<?php echo $row_RecordMiddleColumn['backgroundcolor']; ?>; <?php if ($row_RecordMiddleColumn['boardenable'] == '1') { ?>border:<?php echo $row_RecordMiddleColumn['boardcolor']; ?> solid 1px; <?php } ?>margin:<?php if ($row_RecordMiddleColumn['boardenable'] == '1') {echo "4px";} else {echo "5px";} ?>">
  <?php require("require_partner_home.php"); ?>
  </div>
  <?php } ?>
  
  <?php if($row_RecordMiddleColumn['type'] == 'Video') { ?>
  <style type="text/css">.Auto_Block_Video .Scroll_Bar_horizontal{height:<?php echo $row_RecordMiddleColumn['height']; ?>px;}<?php if ($row_RecordMiddleColumn['indicatetitle'] == '0') { ?>.Auto_Block_News .ct_title{display:none;}<?php } ?></style>
  <div class="Auto_Block Auto_Block_Video" style="background-color:<?php echo $row_RecordMiddleColumn['backgroundcolor']; ?>; <?php if ($row_RecordMiddleColumn['boardenable'] == '1') { ?>border:<?php echo $row_RecordMiddleColumn['boardcolor']; ?> solid 1px; <?php } ?>margin:<?php if ($row_RecordMiddleColumn['boardenable'] == '1') {echo "4px";} else {echo "5px";} ?>">
  <?php require("require_video_home.php"); ?>
  </div>
  <?php } ?>
  
  <?php if($row_RecordMiddleColumn['type'] == 'Product') { ?>
  <style type="text/css">.Auto_Block_Product .Scroll_Bar_horizontal{height:<?php echo $row_RecordMiddleColumn['height']; ?>px;}<?php if ($row_RecordMiddleColumn['indicatetitle'] == '0') { ?>.Auto_Block_News .ct_title{display:none;}<?php } ?></style>
  <div class="Auto_Block Auto_Block_Product" style="background-color:<?php echo $row_RecordMiddleColumn['backgroundcolor']; ?>; <?php if ($row_RecordMiddleColumn['boardenable'] == '1') { ?>border:<?php echo $row_RecordMiddleColumn['boardcolor']; ?> solid 1px; <?php } ?>margin:<?php if ($row_RecordMiddleColumn['boardenable'] == '1') {echo "4px";} else {echo "5px";} ?>">
  <?php require("require_product_home.php"); ?>
  </div>
  <?php } ?>
  
  <?php if($row_RecordMiddleColumn['type'] == 'Project') { ?>
  <style type="text/css">.Auto_Block_Project .Scroll_Bar_horizontal{height:<?php echo $row_RecordMiddleColumn['height']; ?>px;}<?php if ($row_RecordMiddleColumn['indicatetitle'] == '0') { ?>.Auto_Block_News .ct_title{display:none;}<?php } ?></style>
  <div class="Auto_Block Auto_Block_Project" style="background-color:<?php echo $row_RecordMiddleColumn['backgroundcolor']; ?>; <?php if ($row_RecordMiddleColumn['boardenable'] == '1') { ?>border:<?php echo $row_RecordMiddleColumn['boardcolor']; ?> solid 1px; <?php } ?>margin:<?php if ($row_RecordMiddleColumn['boardenable'] == '1') {echo "4px";} else {echo "5px";} ?>">
  <?php require("require_project_home.php"); ?>
  </div>
  <?php } ?>
  
  <?php if($row_RecordMiddleColumn['type'] == 'Actitivies') { ?>
  <style type="text/css">.Auto_Block_Actitivies .Scroll_Bar_horizontal{height:<?php echo $row_RecordMiddleColumn['height']; ?>px;}<?php if ($row_RecordMiddleColumn['indicatetitle'] == '0') { ?>.Auto_Block_News .ct_title{display:none;}<?php } ?></style>
  <div class="Auto_Block Auto_Block_Actitivies" style="background-color:<?php echo $row_RecordMiddleColumn['backgroundcolor']; ?>; <?php if ($row_RecordMiddleColumn['boardenable'] == '1') { ?>border:<?php echo $row_RecordMiddleColumn['boardcolor']; ?> solid 1px; <?php } ?>margin:<?php if ($row_RecordMiddleColumn['boardenable'] == '1') {echo "4px";} else {echo "5px";} ?>">
  <?php require("require_actitivies_home.php"); ?>
  </div>
  <?php } ?>
  
  <?php if($row_RecordMiddleColumn['type'] == 'Sponsor') { ?>
  <style type="text/css">.Auto_Block_Sponsor .Scroll_Bar_horizontal{height:<?php echo $row_RecordMiddleColumn['height']; ?>px;}<?php if ($row_RecordMiddleColumn['indicatetitle'] == '0') { ?>.Auto_Block_News .ct_title{display:none;}<?php } ?></style>
  <div class="Auto_Block Auto_Block_Sponsor" style="background-color:<?php echo $row_RecordMiddleColumn['backgroundcolor']; ?>; <?php if ($row_RecordMiddleColumn['boardenable'] == '1') { ?>border:<?php echo $row_RecordMiddleColumn['boardcolor']; ?> solid 1px; <?php } ?>margin:<?php if ($row_RecordMiddleColumn['boardenable'] == '1') {echo "4px";} else {echo "5px";} ?>">
  <?php require("require_sponsor_home.php"); ?>
  </div>
  <?php } ?>

  <?php if($row_RecordMiddleColumn['type'] == 'Free1') { ?>  
  <div class="Auto_Block Auto_Block1" style="background-color:<?php echo $row_RecordMiddleColumn['backgroundcolor']; ?>; <?php if ($row_RecordMiddleColumn['boardenable'] == '1') { ?>border:<?php echo $row_RecordMiddleColumn['boardcolor']; ?> solid 1px; <?php } ?>margin:<?php if ($row_RecordMiddleColumn['boardenable'] == '1') {echo "4px";} else {echo "5px";} ?>">
      <?php if ($row_RecordMiddleColumn['indicatetitle'] == '1') { ?>
      <div class="columns on-1">
        <div class="container">
          <div class="column">  
            <div class="container ct_board ct_title">
              <h3><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <?php echo $row_RecordMiddleColumn['customname']; // 標題文字 ?></h3>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
      <div class="Scroll_Bar" style="height:<?php echo $row_RecordMiddleColumn['height']; ?>px;"><?php echo $row_RecordMiddleColumn['content'];?></div>
  </div>
  <?php } ?>
  <?php if($row_RecordMiddleColumn['type'] == 'Free2') { ?>  
  <div class="Auto_Block Auto_Block2" style="background-color:<?php echo $row_RecordMiddleColumn['backgroundcolor']; ?>; <?php if ($row_RecordMiddleColumn['boardenable'] == '1') { ?>border:<?php echo $row_RecordMiddleColumn['boardcolor']; ?> solid 1px; <?php } ?>margin:<?php if ($row_RecordMiddleColumn['boardenable'] == '1') {echo "4px";} else {echo "5px";} ?>">
      <?php if ($row_RecordMiddleColumn['indicatetitle'] == '1') { ?>
      <div class="columns on-1">
        <div class="container">
          <div class="column">  
            <div class="container ct_board ct_title">
              <h3><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <?php echo $row_RecordMiddleColumn['customname']; // 標題文字 ?></h3>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
      <div class="Scroll_Bar" style="height:<?php echo $row_RecordMiddleColumn['height']; ?>px;"><?php echo $row_RecordMiddleColumn['content'];?></div>
  </div>
  <?php } ?>
  <?php if($row_RecordMiddleColumn['type'] == 'Free3') { ?>  
  <div class="Auto_Block Auto_Block3" style="background-color:<?php echo $row_RecordMiddleColumn['backgroundcolor']; ?>; <?php if ($row_RecordMiddleColumn['boardenable'] == '1') { ?>border:<?php echo $row_RecordMiddleColumn['boardcolor']; ?> solid 1px; <?php } ?>margin:<?php if ($row_RecordMiddleColumn['boardenable'] == '1') {echo "4px";} else {echo "5px";} ?>">
  	  <?php if ($row_RecordMiddleColumn['indicatetitle'] == '1') { ?>
      <div class="columns on-1">
        <div class="container">
          <div class="column">  
            <div class="container ct_board ct_title">
              <h3><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <?php echo $row_RecordMiddleColumn['customname']; // 標題文字 ?></h3>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
      <div class="Scroll_Bar" style="height:<?php echo $row_RecordMiddleColumn['height']; ?>px;"><?php echo $row_RecordMiddleColumn['content'];?></div>
  </div>
  <?php } ?>
  <?php if($row_RecordMiddleColumn['type'] == 'Free4') { ?>
  <div class="Auto_Block Auto_Block4" style="background-color:<?php echo $row_RecordMiddleColumn['backgroundcolor']; ?>; <?php if ($row_RecordMiddleColumn['boardenable'] == '1') { ?>border:<?php echo $row_RecordMiddleColumn['boardcolor']; ?> solid 1px; <?php } ?>margin:<?php if ($row_RecordMiddleColumn['boardenable'] == '1') {echo "4px";} else {echo "5px";} ?>">
      <?php if ($row_RecordMiddleColumn['indicatetitle'] == '1') { ?>
      <div class="columns on-1">
        <div class="container">
          <div class="column">  
            <div class="container ct_board ct_title">
              <h3><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <?php echo $row_RecordMiddleColumn['customname']; // 標題文字 ?></h3>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
      <div class="Scroll_Bar" style="height:<?php echo $row_RecordMiddleColumn['height']; ?>px;"><?php echo $row_RecordMiddleColumn['content'];?></div>
  </div>
  <?php } ?>
  <?php } while ($row_RecordMiddleColumn = mysqli_fetch_assoc($RecordMiddleColumn)); ?>
</div>
<div style="clear:both"></div>
<?php
mysqli_free_result($RecordMiddleColumn);
?>
