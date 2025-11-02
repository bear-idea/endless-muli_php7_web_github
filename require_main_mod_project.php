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
.Auto_Block_Wrp{}
.Scroll_Bar{height:<?php echo (floor(floor(($TmpWebWidth-(($TmpWebWidth-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/3)-40-16)*0.75)+100+35; ?>px; overflow:hidden;  padding:5px}
.Scroll_Bar_horizontal{height:<?php echo (floor(floor(($TmpWebWidth-(($TmpWebWidth-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/3)-40-16)*0.75)+100; ?>px; overflow:hidden;  padding:5px}
.Auto_Block1{width:24.8%;  overflow:hidden; margin-top:5px;}
.Auto_Block2{width:49.8%;  overflow:hidden; margin-top:5px;}
.Auto_Block3{width:74.8%; overflow:hidden; margin-top:5px;}
.Auto_Block4{width:100%;  overflow:hidden; margin-top:5px;}
.Auto_Block_News,.Auto_Block_Publish,.Auto_Block_Letters,.Auto_Block_Actnews,.Auto_Block_Partner,.Auto_Block_Video,.Auto_Block_Project,.Auto_Block_Product,.Auto_Block_Actitivies,.Auto_Block_Sponsor{width:700px; padding:5px; overflow:hidden;}
.Scroll_Bar_Content{margin:40px; width:260px; height:500px; padding:20px; overflow:auto; background:#333;}
.Scroll_Bar_Wrp{background:#bba; width:200px; height:200px}
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

<div class="Auto_Block_Wrp">

<div class="Auto_Block3" style="float:left;">
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
  <style type="text/css">.Auto_Block_News .Scroll_Bar{}.ct_title{}</style>
  <?php require("require_project_home.php"); ?>

  
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
</div>
<div class="Auto_Block1" style="float:right;">
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
  <div class="Scroll_Bar"><?php require('require_tmphomecontentsmall.php'); ?></div>
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
</div>

</div>



<?php
mysqli_free_result($RecordMiddleColumn);
?>
