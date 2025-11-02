<style type="text/css">
.sponsor_outer_board tr td{margin:0;padding:0}
div .sponsor_inner_board{margin:0}
.sponsor_inner_board_relative{position:relative}
.sponsor_inner_board_relative_buttom{position:relative}
div .sponsor_inner_board_context{text-align:center;height:40px;overflow:hidden}
.nailthumb-container{
	border:1px solid #EEE;
	height: <?php echo floor(floor(($TmpWebWidth-$TmpWebColumnUseWidth-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16)*0.75; ?>px; /* 設定區塊高度(矩形) */
	margin:auto;
	width: <?php echo floor(($TmpWebWidth-$TmpWebColumnUseWidth-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16; ?>px;
}
</style>
  <div class="columns on-1">
    <div class="container">
      <div class="column">  
        <div class="container ct_board ct_title">
          <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Sponsor']; // 標題文字 ?></span></h1>
                </div>
            </div>
        </div>        
</div>
<?php 
#
# ============== [if] ============== #
#
# 在此判斷式之內放置要顯示之內容
if ($totalRows_RecordSponsor > 0 ) { // Show if recordset not empty 
?>
        <div class="columns on-4">
          <div class="container board Scroll_Bar_horizontal">
 	  <?php $i=$startRow_RecordSponsor + 1; // 取得頁面第一項商品之編號 ?>
       <?php do { ?>
          <div class="column">
              <div class="container sponsor_inner_board"> 
                    <!-- 內容 -->
                    <div class="photoFrame_<?php echo $TmpSponsorBoard; ?>">
                    <div class="sponsor_inner_board_relative">
                    <div class='<?php echo $TmpSponsorBoardIcon; ?>'></div>
                      <div class="nailthumb-container">
                      <?php if ($row_RecordSponsor['pic'] != "") { ?>	 
                            <a href="<?php echo $row_RecordSponsor['link']; ?>" target="_blank"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/sponsor/<?php echo  GetFileThumbExtend($row_RecordSponsor['pic']);?>" alt="<?php echo $row_RecordSponsor['sdescription']; ?>"/></a>
                      <?php } else { ?>      
                      <a><img src="<?php echo $TplNoLangImagePath ?>/198x60_noimage.jpg" width="198" height="60"/></a><span></span>
                      <?php } ?>
                      </div> 
                      <div class="sponsor_inner_board_context">
                      <?php echo $row_RecordSponsor['name']; ?>
                      </div>
                    </div>
                    </div>
                    <!-- 內容 End-->
			   <?php $i++; ?>
              
              </div>
          </div>
         <?php } while ($row_RecordSponsor = mysqli_fetch_assoc($RecordSponsor)); ?>
          
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
if ($totalRows_RecordSponsor == 0) { // Show if recordset empty 
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><table width="250" border="0" cellspacing="0" cellpadding="0">
      <tr>
          <td width="61"><img src="<?php echo $SiteBaseUrl; ?>images/error_tip.png" width="60" height="60" /></td>
          <td width="189"><?php echo $Lang_Error_NoSearch //目前尚無資料 ?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Sponsor']; // 標題文字 ?>  →  新增</strong> 來建立新資料<?php } ?></td>
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
            jQuery('.sponsor_inner_board_relative .nailthumb-container').nailthumb({
				method:'resize', // 'crop' or 'resize'
				fitDirection:'center center'
			});
        });
</script>

<script type="text/javascript" charset="utf-8">
/* prettyPhoto */
$(document).ready(function(){$("a[rel^='prettyPhoto']").prettyPhoto({slideshow:5E3,autoplay_slideshow:!0,keyboard_shortcuts:!0,show_title:!1})});
</script>
