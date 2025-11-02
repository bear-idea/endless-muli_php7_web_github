<?php require_once('../Connections/DB_Conn.php'); ?>
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

$colname_RecordTmpBoard = "-1";
if (isset($_GET['id'])) {
  $colname_RecordTmpBoard = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpBoard = sprintf("SELECT * FROM demo_tmpboard WHERE id = %s", GetSQLValueString($colname_RecordTmpBoard, "int"));
$RecordTmpBoard = mysqli_query($DB_Conn, $query_RecordTmpBoard) or die(mysqli_error($DB_Conn));
$row_RecordTmpBoard = mysqli_fetch_assoc($RecordTmpBoard);
$totalRows_RecordTmpBoard = mysqli_num_rows($RecordTmpBoard);
?>
<link href="css/incstyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.bk_wrp {
	height: 100px;
	width: 100px;
	border: 1px solid #DDD;
}
.bk_wrp1 {
	height: 100px;
	width: 100px;
	border: 1px solid #DDD;
}
.bk_wrp img{
	max-width: 50px;
}
.bk_wrp {
}
img {
	border:0px;
	vertical-align:bottom; /* 去除圖片下方5px空隙 */
}
</style>
<?php if ($row_RecordTmpBoard['name'] != "") { ?>
	<?php if ($SiteBaseUrlOuter != '' && $row_RecordTmpBoard['userid'] == '1') { ?>
    <div class="bk_wrp">
    <!--外框樣式-->
               <div class="mdl" style=" background-color:<?php echo $row_RecordTmpBoard['tmp_w_background_color']; ?>;border:<?php echo $row_RecordTmpBoard['tmp_w_board_width']; ?>px <?php echo $row_RecordTmpBoard['tmp_w_board_style']; ?> <?php echo $row_RecordTmpBoard['tmp_w_board_color']; ?>;background-image: url(upload/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_w_background_img'] ?>);-webkit-border-radius: <?php echo $row_RecordTmpBoard['borderradius_t_l']; ?>px <?php echo $row_RecordTmpBoard['borderradius_t_r']; ?>px <?php echo $row_RecordTmpBoard['borderradius_b_r']; ?>px <?php echo $row_RecordTmpBoard['borderradius_b_l']; ?>px;-moz-border-radius: <?php echo $row_RecordTmpBoard['borderradius_t_l']; ?>px <?php echo $row_RecordTmpBoard['borderradius_t_r']; ?>px <?php echo $row_RecordTmpBoard['borderradius_b_r']; ?>px <?php echo $row_RecordTmpBoard['borderradius_b_l']; ?>px;border-radius: <?php echo $row_RecordTmpBoard['borderradius_t_l']; ?>px <?php echo $row_RecordTmpBoard['borderradius_t_r']; ?>px <?php echo $row_RecordTmpBoard['borderradius_b_r']; ?>px <?php echo $row_RecordTmpBoard['borderradius_b_l']; ?>px;-webkit-box-shadow: <?php echo $row_RecordTmpBoard['boxshadow_x']; ?>px <?php echo $row_RecordTmpBoard['boxshadow_y']; ?>px <?php echo $row_RecordTmpBoard['boxshadow_size']; ?>px <?php echo $row_RecordTmpBoard['boxshadow_color']; ?>;-moz-box-shadow: <?php echo $row_RecordTmpBoard['boxshadow_x']; ?>px <?php echo $row_RecordTmpBoard['boxshadow_y']; ?>px <?php echo $row_RecordTmpBoard['boxshadow_size']; ?>px <?php echo $row_RecordTmpBoard['boxshadow_color']; ?>;box-shadow: <?php echo $row_RecordTmpBoard['boxshadow_x']; ?>px <?php echo $row_RecordTmpBoard['boxshadow_y']; ?>px <?php echo $row_RecordTmpBoard['boxshadow_size']; ?>px <?php echo $row_RecordTmpBoard['boxshadow_color']; ?>;background: -webkit-gradient(linear, 0 0, 0 bottom, from(<?php echo $row_RecordTmpBoard['lineargradient_top']; ?>), to(<?php echo $row_RecordTmpBoard['lineargradient_bottom']; ?>));background: -webkit-linear-gradient(<?php echo $row_RecordTmpBoard['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoard['lineargradient_bottom']; ?>);background: -moz-linear-gradient(<?php echo $row_RecordTmpBoard['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoard['lineargradient_bottom']; ?>);background: -ms-linear-gradient(<?php echo $row_RecordTmpBoard['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoard['lineargradient_bottom']; ?>);background: -o-linear-gradient(<?php echo $row_RecordTmpBoard['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoard['lineargradient_bottom']; ?>);background: linear-gradient(<?php echo $row_RecordTmpBoard['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoard['lineargradient_bottom']; ?>);-pie-background: linear-gradient(<?php echo $row_RecordTmpBoard['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoard['lineargradient_bottom']; ?>);behavior:url(http://www.shop3500.com/PIE.htc);">
                <div class="mdl_t">
                        <div class="mdl_t_l" style="background:url(<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_l_t_background_img']; ?>) <?php echo $row_RecordTmpBoard['tmp_l_t_repeat']; ?> scroll left top;width:<?php echo $row_RecordTmpBoard['tmp_l_t_width']; ?>px;height:<?php echo $row_RecordTmpBoard['tmp_l_t_height']; ?>px;"> </div>
                        <div class="mdl_t_r" style="background:url(<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_r_t_background_img']; ?>) <?php echo $row_RecordTmpBoard['tmp_r_t_repeat']; ?> scroll left top;width:<?php echo $row_RecordTmpBoard['tmp_r_t_width']; ?>px;height:<?php echo $row_RecordTmpBoard['tmp_r_t_height']; ?>px;"> </div>
                        <div class="mdl_t_c" style="background:url(<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_m_t_background_img']; ?>) <?php echo $row_RecordTmpBoard['tmp_m_t_repeat']; ?> scroll left top;height:<?php echo $row_RecordTmpBoard['tmp_r_t_height']; ?>px;margin:0px <?php echo $row_RecordTmpBoard['tmp_r_t_width']; ?>px 0px <?php echo $row_RecordTmpBoard['tmp_l_t_width']; ?>px;"><!--標題文字--></div>
                        <div class="mdl_t_m"><!--右邊文字--></div>
                </div><!--mdl_t-->
                <div class="mdl_c g_p_hide">
                        <div class="mdl_c_l g_p_fill" style="background:url(<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_l_m_background_img']; ?>) <?php echo $row_RecordTmpBoard['tmp_l_m_repeat']; ?> scroll left top;width:<?php echo $row_RecordTmpBoard['tmp_l_m_width']; ?>px;"> </div>
                        <div class="mdl_c_r g_p_fill" style="background:url(<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_r_m_background_img']; ?>) <?php echo $row_RecordTmpBoard['tmp_r_m_repeat']; ?> scroll left top;width:<?php echo $row_RecordTmpBoard['tmp_r_m_width']; ?>px;"> </div>
                        <div class="mdl_c_c" style="background:url(<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_m_m_background_img']; ?>) <?php echo $row_RecordTmpBoard['tmp_m_m_repeat']; ?> scroll left top;margin:0px <?php echo $row_RecordTmpBoard['tmp_r_m_width']; ?>px 0px <?php echo $row_RecordTmpBoard['tmp_l_m_width']; ?>px;">
                               
                                <div class="mdl_m_c" style="width:50px; height:50px;">
                                    
                                </div>
                               
                        </div>
                </div><!--mdl_c-->
                <div class="mdl_b">
                        <div class="mdl_b_l" style="background:url(<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_l_b_background_img']; ?>) <?php echo $row_RecordTmpBoard['tmp_l_b_repeat']; ?> scroll left top;width:<?php echo $row_RecordTmpBoard['tmp_l_b_width']; ?>px;height:<?php echo $row_RecordTmpBoard['tmp_l_b_height']; ?>px;"> </div>
                        <div class="mdl_b_r" style="background:url(<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_r_b_background_img']; ?>) <?php echo $row_RecordTmpBoard['tmp_r_b_repeat']; ?> scroll left top;width:<?php echo $row_RecordTmpBoard['tmp_r_b_width']; ?>px;height:<?php echo $row_RecordTmpBoard['tmp_r_b_height']; ?>px;"> </div>
                        <div class="mdl_b_c" style="background:url(<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_m_b_background_img']; ?>) <?php echo $row_RecordTmpBoard['tmp_m_b_repeat']; ?> scroll left top;height:<?php echo $row_RecordTmpBoard['tmp_m_b_height']; ?>px;margin:0px <?php echo $row_RecordTmpBoard['tmp_r_b_width']; ?>px 0px <?php echo $row_RecordTmpBoard['tmp_l_b_width']; ?>px;"> </div>
                </div><!--mdl_b-->
            </div><!--mdl-->
               <!--外框樣式 END-->
               </div>
    <?php } else { ?>
    <div class="bk_wrp">
    <!--外框樣式-->
               <div class="mdl" style=" background-color:<?php echo $row_RecordTmpBoard['tmp_w_background_color']; ?>;border:<?php echo $row_RecordTmpBoard['tmp_w_board_width']; ?>px <?php echo $row_RecordTmpBoard['tmp_w_board_style']; ?> <?php echo $row_RecordTmpBoard['tmp_w_board_color']; ?>;background-image: url(upload/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_w_background_img'] ?>);-webkit-border-radius: <?php echo $row_RecordTmpBoard['borderradius_t_l']; ?>px <?php echo $row_RecordTmpBoard['borderradius_t_r']; ?>px <?php echo $row_RecordTmpBoard['borderradius_b_r']; ?>px <?php echo $row_RecordTmpBoard['borderradius_b_l']; ?>px;-moz-border-radius: <?php echo $row_RecordTmpBoard['borderradius_t_l']; ?>px <?php echo $row_RecordTmpBoard['borderradius_t_r']; ?>px <?php echo $row_RecordTmpBoard['borderradius_b_r']; ?>px <?php echo $row_RecordTmpBoard['borderradius_b_l']; ?>px;border-radius: <?php echo $row_RecordTmpBoard['borderradius_t_l']; ?>px <?php echo $row_RecordTmpBoard['borderradius_t_r']; ?>px <?php echo $row_RecordTmpBoard['borderradius_b_r']; ?>px <?php echo $row_RecordTmpBoard['borderradius_b_l']; ?>px;-webkit-box-shadow: <?php echo $row_RecordTmpBoard['boxshadow_x']; ?>px <?php echo $row_RecordTmpBoard['boxshadow_y']; ?>px <?php echo $row_RecordTmpBoard['boxshadow_size']; ?>px <?php echo $row_RecordTmpBoard['boxshadow_color']; ?>;-moz-box-shadow: <?php echo $row_RecordTmpBoard['boxshadow_x']; ?>px <?php echo $row_RecordTmpBoard['boxshadow_y']; ?>px <?php echo $row_RecordTmpBoard['boxshadow_size']; ?>px <?php echo $row_RecordTmpBoard['boxshadow_color']; ?>;box-shadow: <?php echo $row_RecordTmpBoard['boxshadow_x']; ?>px <?php echo $row_RecordTmpBoard['boxshadow_y']; ?>px <?php echo $row_RecordTmpBoard['boxshadow_size']; ?>px <?php echo $row_RecordTmpBoard['boxshadow_color']; ?>;background: -webkit-gradient(linear, 0 0, 0 bottom, from(<?php echo $row_RecordTmpBoard['lineargradient_top']; ?>), to(<?php echo $row_RecordTmpBoard['lineargradient_bottom']; ?>));background: -webkit-linear-gradient(<?php echo $row_RecordTmpBoard['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoard['lineargradient_bottom']; ?>);background: -moz-linear-gradient(<?php echo $row_RecordTmpBoard['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoard['lineargradient_bottom']; ?>);background: -ms-linear-gradient(<?php echo $row_RecordTmpBoard['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoard['lineargradient_bottom']; ?>);background: -o-linear-gradient(<?php echo $row_RecordTmpBoard['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoard['lineargradient_bottom']; ?>);background: linear-gradient(<?php echo $row_RecordTmpBoard['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoard['lineargradient_bottom']; ?>);-pie-background: linear-gradient(<?php echo $row_RecordTmpBoard['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoard['lineargradient_bottom']; ?>);behavior:url(http://www.shop3500.com/PIE.htc);">
                <div class="mdl_t">
                        <div class="mdl_t_l" style="background:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_l_t_background_img']; ?>) <?php echo $row_RecordTmpBoard['tmp_l_t_repeat']; ?> scroll left top;width:<?php echo $row_RecordTmpBoard['tmp_l_t_width']; ?>px;height:<?php echo $row_RecordTmpBoard['tmp_l_t_height']; ?>px;"> </div>
                        <div class="mdl_t_r" style="background:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_r_t_background_img']; ?>) <?php echo $row_RecordTmpBoard['tmp_r_t_repeat']; ?> scroll left top;width:<?php echo $row_RecordTmpBoard['tmp_r_t_width']; ?>px;height:<?php echo $row_RecordTmpBoard['tmp_r_t_height']; ?>px;"> </div>
                        <div class="mdl_t_c" style="background:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_m_t_background_img']; ?>) <?php echo $row_RecordTmpBoard['tmp_m_t_repeat']; ?> scroll left top;height:<?php echo $row_RecordTmpBoard['tmp_r_t_height']; ?>px;margin:0px <?php echo $row_RecordTmpBoard['tmp_r_t_width']; ?>px 0px <?php echo $row_RecordTmpBoard['tmp_l_t_width']; ?>px;"><!--標題文字--></div>
                        <div class="mdl_t_m"><!--右邊文字--></div>
                </div><!--mdl_t-->
                <div class="mdl_c g_p_hide">
                        <div class="mdl_c_l g_p_fill" style="background:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_l_m_background_img']; ?>) <?php echo $row_RecordTmpBoard['tmp_l_m_repeat']; ?> scroll left top;width:<?php echo $row_RecordTmpBoard['tmp_l_m_width']; ?>px;"> </div>
                        <div class="mdl_c_r g_p_fill" style="background:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_r_m_background_img']; ?>) <?php echo $row_RecordTmpBoard['tmp_r_m_repeat']; ?> scroll left top;width:<?php echo $row_RecordTmpBoard['tmp_r_m_width']; ?>px;"> </div>
                        <div class="mdl_c_c" style="background:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_m_m_background_img']; ?>) <?php echo $row_RecordTmpBoard['tmp_m_m_repeat']; ?> scroll left top;margin:0px <?php echo $row_RecordTmpBoard['tmp_r_m_width']; ?>px 0px <?php echo $row_RecordTmpBoard['tmp_l_m_width']; ?>px;">
                               
                                <div class="mdl_m_c" style="width:50px; height:50px;">
                                    
                                </div>
                               
                        </div>
                </div><!--mdl_c-->
                <div class="mdl_b">
                        <div class="mdl_b_l" style="background:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_l_b_background_img']; ?>) <?php echo $row_RecordTmpBoard['tmp_l_b_repeat']; ?> scroll left top;width:<?php echo $row_RecordTmpBoard['tmp_l_b_width']; ?>px;height:<?php echo $row_RecordTmpBoard['tmp_l_b_height']; ?>px;"> </div>
                        <div class="mdl_b_r" style="background:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_r_b_background_img']; ?>) <?php echo $row_RecordTmpBoard['tmp_r_b_repeat']; ?> scroll left top;width:<?php echo $row_RecordTmpBoard['tmp_r_b_width']; ?>px;height:<?php echo $row_RecordTmpBoard['tmp_r_b_height']; ?>px;"> </div>
                        <div class="mdl_b_c" style="background:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_m_b_background_img']; ?>) <?php echo $row_RecordTmpBoard['tmp_m_b_repeat']; ?> scroll left top;height:<?php echo $row_RecordTmpBoard['tmp_m_b_height']; ?>px;margin:0px <?php echo $row_RecordTmpBoard['tmp_r_b_width']; ?>px 0px <?php echo $row_RecordTmpBoard['tmp_l_b_width']; ?>px;"> </div>
                </div><!--mdl_b-->
            </div><!--mdl-->
               <!--外框樣式 END-->
               </div>
    <?php } ?>
<?php } else { ?>
<div class="bk_wrp1">
<img src="images/no_bg.jpg" width="100" height="100"/> 
</div> 
<?php } ?> 
<?php
mysqli_free_result($RecordTmpBoard);
?>
