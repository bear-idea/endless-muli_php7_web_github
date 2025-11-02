<style type="text/css">
.left_ct_board{padding:5px}
.right_ct_board{padding:5px}
div .room_inner_board_detailed{margin:0;padding:2px;background-color:#FFFAF7;border:1px solid #DDD;height:100%}
.room_inner_board_detailed_title{margin:0;padding:5px;background-color:#FEEFD1;background-repeat:repeat;font-weight:700}
.Room_Detailed_Right_Board{margin:5px;border:0 solid #DDD}
.Room_Detailed_Right_Board tr td{padding:5px;border-bottom-style:dotted;border-color:#FFD5BF;border-width:1px}
.div_table-cell{overflow:hidden;height:380px;width:380px;margin:0;text-align:center;vertical-align:middle;background-color:#FFF;border:1px solid #DDD}
.div_table-cell span,.div_table-cell_type span{height:100%;display:inline-block;background-image:none;border-style:none}
.div_table-cell *{vertical-align:middle}
div .photoFram_Block_glossy,.div_table-cell_plus{overflow:hidden;height:45px;width:45px;margin:1px}
.div_table-cell_plus{text-align:center;vertical-align:middle;border:1px solid #DDD}
.div_table-cell_plus span{height:100%;display:inline-block;background-image:none;border-style:none}
.div_table-cell_plus *{vertical-align:middle}
.acc_trigger{background-image:url(images/la.png);background-repeat:no-repeat;background-position:right center;cursor:pointer}
.acc_trigger:hover{background-color:#FDD788}
.active{background-image:url(images/lb.png);background-repeat:no-repeat;background-position:right center}
.number_g{font-size:1.67em;margin-top:-3px;height:18px;width:32px}
.number_s{font-size:3em;font-weight:700}
.InnerButtom{margin-right:2px;margin-top:5px;margin-bottom:5px;}
.InnerButtom a{font-weight:700;border:1px solid #CCC;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;text-shadow:0 1px 1px #fff;-webkit-box-shadow:0 1px 1px #fff;-moz-box-shadow:0 1px 1px #fff;box-shadow:0 1px 1px #fff;font:bold 11px Sans-Serif;padding:4px 8px;white-space:nowrap;vertical-align:middle;color:#666;background:#FFF;cursor:pointer}
.InnerButtom a:hover,.InnerButtom a:focus{font-weight:700;border-color:#999;background:-webkit-linear-gradient(top,white,#E0E0E0);background:-moz-linear-gradient(top,white,#E0E0E0);background:-ms-linear-gradient(top,white,#E0E0E0);background:-o-linear-gradient(top,white,#E0E0E0);-webkit-box-shadow:0 1px 2px rgba(0,0,0,0.25),inset 0 0 3px #fff;-moz-box-shadow:0 1px 2px rgba(0,0,0,0.25),inset 0 0 3px #fff;box-shadow:0 1px 2px rgba(0,0,0,0.25),inset 0 0 3px #fff;color:#333;text-decoration:none}
.InnerButtom a:active{font-weight:700;color:#666;border:1px solid #AAA;border-bottom-color:#CCC;border-top-color:#999;-webkit-box-shadow:inset 0 1px 2px #aaa;-moz-box-shadow:inset 0 1px 2px #aaa;box-shadow:inset 0 1px 2px #aaa;background:-webkit-linear-gradient(top,#E6E6E6,gainsboro);background:-moz-linear-gradient(top,#E6E6E6,gainsboro);background:-ms-linear-gradient(top,#E6E6E6,gainsboro);background:-o-linear-gradient(top,#E6E6E6,gainsboro)}
</style>
<?php
/*********************************************************************
 # 主頁面產品資訊
 *********************************************************************/
?>
<?php
#
# ============== [title] ============== #
#
# 標題部分
?>
<!--標題外框-->
<div style="position:relative;">
<div class="mdtitle TitleBoardStyle">
	<div class="mdtitle_t">
			<div class="mdtitle_t_l"> </div>
			<div class="mdtitle_t_r"> </div>
			<div class="mdtitle_t_c"><!--標題--></div>
			<div class="mdtitle_t_m"><!--更多--></div>
	</div><!--mdtitle_t-->
	<div class="mdtitle_c g_p_hide">
			<div class="mdtitle_c_l g_p_fill"> </div>
			<div class="mdtitle_c_r g_p_fill"> </div>
			<div class="mdtitle_c_c">
					<!-- <div class="mdtitle_m_t"></div>
					<div class="mdtitle_m_c">  --> 
<!--標題外框--> 
<div class="columns on-1">
        <div class="container">
            <div class="column">
                <div class="container ct_board ct_title">
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Room']; // 標題文字 ?></span></h1>
                </div>
            </div>
        </div>        
</div>
<!--標題外框-->
  				<!--</div>
					<div class="mdtitle_m_b"></div>-->
			</div>
	</div><!--mdtitle_c-->
	<div class="mdtitle_b">
			<div class="mdtitle_b_l"> </div>
			<div class="mdtitle_b_r"> </div>
			<div class="mdtitle_b_c"> </div>
	</div><!--mdtitle_b-->
</div><!--mdtitle-->
</div>
<!-- 標題外框-->
<?php
#
# ============== [/title] ============== #
?> 

<?php 
#
# ============== [if] ============== #
#
# 在此判斷式之內放置要顯示之內容
if ($totalRows_RecordRoom > 0) { // Show if recordset not empty 
?>
<!--外框-->
<div style="position:relative;">
<div class="mdmiddle MiddleBoardStyle">
	<div class="mdmiddle_t">
			<div class="mdmiddle_t_l"> </div>
			<div class="mdmiddle_t_r"> </div>
			<div class="mdmiddle_t_c"><!--標題--></div>
			<div class="mdmiddle_t_m"><!--更多--></div>
	</div><!--mdmiddle_t-->
	<div class="mdmiddle_c g_p_hide">
			<div class="mdmiddle_c_l g_p_fill"> </div>
			<div class="mdmiddle_c_r g_p_fill"> </div>
			<div class="mdmiddle_c_c">
					<!-- <div class="mdmiddle_m_t"></div>
					<div class="mdmiddle_m_c">  --> 
<!--外框--> 
	<!-- 產品詳細頁面上方區塊 -->
    <div class="columns on-3">
        <div class="container board">
            <div class="column span-2 fixed sidebar" style="width:100%; margin-right:0px">
                <div class="container left_ct_board">
                    <!-- 左方圖片區塊 -->
					<?php
						require("require_room_detailed_photoalbum_mobile.php");
					?>
                    <?php //require("require_room_detailed_photoalbum_myfocus.php"); ?>
                    <span style="float:right; margin-top:10px;"><?php // 連結分享
					if($MSRoomShare != '0')
					{	
						require("require_sharelink.php");
					} 
					?></span>
                    
      <?php //require("require_fb_like.php"); ?>
                    <!-- 左方圖片區塊 END -->
              </div>
            </div>
        </div>
	</div>
    <!-- 產品詳細頁面上方區塊 END -->
    <div class="columns on-1">
        <div class="container board">
            <div class="column">
            <?php if($row_RecordRoom['skeyword'] != "") { ?>
                        <div style="border:0px #CCCCCC dotted; padding:5px;" class="keytag">
                        <a>&nbsp;<i class="fa fa-tag"></i>&nbsp;</a><?php
                        $arr_tag = explode(',', $row_RecordRoom['skeyword']);
                        for($i = 0; $i < count($arr_tag); $i++){ echo "<a href=\"room.php?wshop=".$_GET['wshop']."&amp;Opt=search&amp;tp=".$_GET['tp']."&amp;lang=".$_SESSION['lang']."&amp;tag=".$arr_tag[$i] ."\">".$arr_tag[$i]."</a>";}?>
                        </div>
                        <?php } ?>
            </div>
        </div>
	</div>
    
    
    <ul id="myTab" class="nav nav-tabs nav-top-border margin-top-10" role="tablist">
                        <li role="presentation" class="active"><a href="#tabs-1" style="color:#000" role="tab" data-toggle="tab"><?php echo $Lang_Tab_Content_Room //商品說明 ?></a></li>
    </ul>
    
    <div class="tab-content padding-top-20">
                        <div id="tabs-1" class="tab-pane fade in active">
                            <div><?php echo pageBreak($row_RecordRoom['content']); ?></div>
                            <div style=" clear:both; display:block"></div> 
                        </div>
    </div>
                         
   
<!--外框-->
  				<!--</div>
					<div class="mdmiddle_m_b"></div>-->
			</div>
	</div><!--mdmiddle_c-->
	<div class="mdmiddle_b">
			<div class="mdmiddle_b_l"> </div>
			<div class="mdmiddle_b_r"> </div>
			<div class="mdmiddle_b_c"> </div>
	</div><!--mdmiddle_b-->
</div><!--mdmiddle-->
</div>
<!--外框-->
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
if ($totalRows_RecordRoom == 0) { // Show if recordset empty 
?>
<!--外框-->
<div style="position:relative;">
<div class="mdmiddle MiddleBoardStyle">
	<div class="mdmiddle_t">
			<div class="mdmiddle_t_l"> </div>
			<div class="mdmiddle_t_r"> </div>
			<div class="mdmiddle_t_c"><!--標題--></div>
			<div class="mdmiddle_t_m"><!--更多--></div>
	</div><!--mdmiddle_t-->
	<div class="mdmiddle_c g_p_hide">
			<div class="mdmiddle_c_l g_p_fill"> </div>
			<div class="mdmiddle_c_r g_p_fill"> </div>
			<div class="mdmiddle_c_c">
					<!-- <div class="mdmiddle_m_t"></div>
					<div class="mdmiddle_m_c">  --> 
<!--外框-->
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
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Room']; // 標題文字 ?>  →  新增</strong> 來建立該項目<?php } ?></td>
  </tr>
</table>
<br />
<br />
<!--外框-->
  				<!--</div>
					<div class="mdmiddle_m_b"></div>-->
	  </div>
	</div><!--mdmiddle_c-->
	<div class="mdmiddle_b">
			<div class="mdmiddle_b_l"> </div>
			<div class="mdmiddle_b_r"> </div>
			<div class="mdmiddle_b_c"> </div>
	</div><!--mdmiddle_b-->
</div><!--mdmiddle-->
</div>
<!--外框-->
<?php 
} // Show if recordset empty 
#
# ============== [/if] ============== #
?>
