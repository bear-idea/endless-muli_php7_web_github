<style type="text/css">
.ct_board_activities_title{padding:5px;color:#FFF;background-color:#333;margin:5px 0 0}
.swpboard{text-align:right;padding:5px}
.activities_outer_board tr td{margin:0;padding:0}
div .activities_inner_board{margin:1px}
div .photoFram_Block_glossy,.div_table-cell_activities{overflow:hidden;height:134px;width:180px}
.activities_inner_board_relative{position:relative}
.activities_inner_board_relative_buttom{position:relative}
.div_table-cell_activities{background-color:#FFF;text-align:center;vertical-align:middle;border:1px solid #DDD}
.div_table-cell_activities span{height:100%;display:inline-block;background-image:none;border-style:none}
.div_table-cell_activities *{vertical-align:middle}
div .activities_inner_board_context{margin-top:5px;text-align:center;height:40px;overflow:hidden}
div .activities_inner_board_context a:hover{font-weight:bolder;text-decoration:none}
a:hover.switch_4block,a:hover.switch_3block,a:hover.switch_2block,a:hover.switch_list{filter:alpha(opacity=75);opacity:.5;-ms-filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=75)}
.activities_inner_board_relative .nailthumb-container{overflow:hidden;height:<?php echo floor(floor(($TmpWebWidth-(($TmpWebWidth-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/3)-40-16)*0.75; ?>px;width:<?php echo floor(($TmpWebWidth-(($TmpWebWidth-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/3)-40-16; ?>px; border:1px solid #EEE; margin:auto;}
</style>

<?php
/*********************************************************************
 # 主頁面產品資訊
 *********************************************************************/
?>
<div class="columns on-1">
        <div class="container">
            <div class="column">
                <div class="container ct_board ct_title">
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Activities']; // 標題文字 ?></span></h1>
                </div>
            </div>
        </div>        
</div>
<?php 
#
# ============== [if] ============== #
#
# 在此判斷式之內放置要顯示之內容
if ($totalRows_RecordActivities > 0) { // Show if recordset not empty 
?> 
<?php // 顯示方式 ?>
 <div class="columns on-3">
      <div class="container board Scroll_Bar_horizontal">
	  <?php $i=$startRow_RecordActivities + 1; // 取得頁面第一項商品之編號 ?>
          <?php do { ?> 
          <div class="column">
              <div class="container activities_inner_board">
                <!-- 內容 -->
                <div class="photoFrame_<?php echo $TmpActivitiesBoard; ?>">
                <div class="activities_inner_board_relative">
                <div class='<?php echo $TmpActivitiesBoardIcon; ?>'></div>
                  <div class="nailthumb-container">
                  <?php if ($row_RecordActivities['pic'] != "") { ?>	 
                        <a href="<?php echo $SiteBaseUrl . url_rewrite('activities',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordActivities['act_id']),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/activities/thumb/small_<?php echo GetFileThumbExtend($row_RecordActivities['pic']); ?>" alt="<?php echo $row_RecordActivities['sdescription']; ?>"/></a><span></span>
                  <?php } else { ?>      
                  <a><img src="images/100x100_noimage.jpg"/></a><span></span>
                  <?php } ?>
                  </div> 
                </div>
                <div class="activities_inner_board_context">
                              <a href="<?php echo $SiteBaseUrl . url_rewrite('activities',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordActivities['act_id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordActivities['title']; ?></a>
                 </div>
                </div>
                
                
                <!-- 內容 End-->
              </div>
          </div>
          <?php $i++; ?>
          <?php //if ($i%4 == 1) {echo "<div class=\"column span-4\"><div class=\"container activities_inner_board\"><hr></div></div>";}?>
          <?php } while ($row_RecordActivities = mysqli_fetch_assoc($RecordActivities)); ?>
      </div>
  </div>
<?php 
} // Show if recordset not empty 
#
# ============== [/if] ============== #
?>
<?php 
#
# ============== [if] ============== #
#
# 判斷當無資料顯示時之畫面
if ($totalRows_RecordActivities == 0) { // Show if recordset empty 
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><table width="250" border="0" cellspacing="0" cellpadding="0">
      <tr>
          <td width="61"><img src="<?php echo $SiteBaseUrl; ?>images/error_tip.png" width="60" height="60" /></td>
          <td width="189"><?php echo $Lang_Error_NoSearch; //目前尚無資料 ?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Activities']; // 標題文字 ?>  →  新增</strong> 來建立該項目<?php } ?></td>
  </tr>
</table>
<br />
<br />
<?php 
} // Show if recordset empty 
#
# ============== [/if] ============== #
?>
<script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('.activities_inner_board_relative .nailthumb-container').nailthumb({
				method:'<?php echo $TmpActivitiesImageMethods; ?>', // 'crop' or 'resize'
				fitDirection:'center center'
			});
        });
</script>