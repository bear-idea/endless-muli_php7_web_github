<style type="text/css">
.ct_board_room_title{padding:5px;color:#FFF;background-color:#333;margin:5px 0 0}
.swpboard{text-align:right;padding:5px}
.room_outer_board tr td{margin:0;padding:0}
div .room_inner_board{background-color:#FFF;margin:1px}
div .photoFram_Block_glossy,.div_table-cell{overflow:hidden;height:120px;width:160px}
.room_inner_board_relative{position:relative}
.room_inner_board_relative_buttom{position:relative}
.nailthumb-container{overflow:hidden;height:<?php echo floor(floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16)*0.75; ?>px;width:<?php echo floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16; ?>px; border:1px solid #EEE; margin:auto;}
div .room_inner_board_context{width:100%;margin-top:5px;text-align:left;overflow:hidden}
div .room_inner_board_context a:hover{font-weight:bolder;text-decoration:none}
a:hover.switch_4block,a:hover.switch_3block,a:hover.switch_2block,a:hover.switch_list{filter:alpha(opacity=75);opacity:.5;-ms-filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=75)}
.InnerButtom{margin-right:2px;margin-top:5px;margin-bottom:5px}
.InnerButtom a{font-weight:700;border:1px solid #CCC;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;text-shadow:0 1px 1px #fff;-webkit-box-shadow:0 1px 1px #fff;-moz-box-shadow:0 1px 1px #fff;box-shadow:0 1px 1px #fff;font:bold 11px Sans-Serif;padding:4px 8px;white-space:nowrap;vertical-align:middle;color:#666;background:transparent;cursor:pointer}
.InnerButtom a:hover,.InnerButtom a:focus{font-weight:700;border-color:#999;background:-webkit-linear-gradient(top,white,#E0E0E0);background:-moz-linear-gradient(top,white,#E0E0E0);background:-ms-linear-gradient(top,white,#E0E0E0);background:-o-linear-gradient(top,white,#E0E0E0);-webkit-box-shadow:0 1px 2px rgba(0,0,0,0.25),inset 0 0 3px #fff;-moz-box-shadow:0 1px 2px rgba(0,0,0,0.25),inset 0 0 3px #fff;box-shadow:0 1px 2px rgba(0,0,0,0.25),inset 0 0 3px #fff;color:#333;text-decoration:none}
.InnerButtom a:active{font-weight:700;color:#666;border:1px solid #AAA;border-bottom-color:#CCC;border-top-color:#999;-webkit-box-shadow:inset 0 1px 2px #aaa;-moz-box-shadow:inset 0 1px 2px #aaa;box-shadow:inset 0 1px 2px #aaa;background:-webkit-linear-gradient(top,#E6E6E6,gainsboro);background:-moz-linear-gradient(top,#E6E6E6,gainsboro);background:-ms-linear-gradient(top,#E6E6E6,gainsboro);background:-o-linear-gradient(top,#E6E6E6,gainsboro)}
.center-cropped-img{width:100%;overflow:hidden;margin:auto;position:relative}
.center-cropped-img img{position:absolute;left:-100%;right:-100%;top:-100%;bottom:-100%;margin:auto;min-height:100%;min-width:100%}
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

                <div class="ct_title">
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Room']; // 標題文字 ?></span></h1>
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
# ============== [rs date] ============== #
#
# 顯示資料集分頁
?>

<?php
#
# ============== [/rs date] ============== #
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

<div class="post_content padding-3">
<?php if ($TmpTypeMenuBtnIndicate == "1") { // 分類標籤 ?>
<?php include('app/typemenu/typemenu_tp.php');?>
<?php } ?>

<?php do { ?>
<div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="photoFrame_base">
        	<div class="shop-item margin-bottom-10">                                     
               	<div class="center-cropped-img">
                
                <?php // 判斷商品所在之層級
                                if($row_RecordRoom['type1'] != '-1' && $row_RecordRoom['type2'] != '-1' && $row_RecordRoom['type3'] != '-1') { $level='2'; }
                                else if($row_RecordRoom['type1'] != '-1' && $row_RecordRoom['type2'] != '-1' && $row_RecordRoom['type3'] == '-1') { $level='1'; }
                                else if($row_RecordRoom['type1'] != '-1' && $row_RecordRoom['type2'] == '-1' && $row_RecordRoom['type3'] == '-1') { $level='0'; }
                                else { $level=''; }
                            ?>
                     <?php if ($level == '2') { ?>          
					  <?php if ($row_RecordRoom['pic'] != "") { ?> 
                      <a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordRoom['type1'],'type2'=>$row_RecordRoom['type2'],'type3'=>$row_RecordRoom['type3']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoom['id']; ?>" title="<?php echo $row_RecordRoom['name']; ?>" ><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/room/thumb/small_<?php echo GetFileThumbExtend($row_RecordRoom['pic']); ?>" alt="<?php echo $row_RecordRoom['sdescription']; ?>"/></a>
                      <?php } else { ?>      
                      <a><img src="images/100x100_noimage.jpg" width="100" height="100"/></a>
                      <?php } ?>
                  <?php } else if ($level == '1') { ?>
                      <?php if ($row_RecordRoom['pic'] != "") { ?> 
                      <a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordRoom['type1'],'type2'=>$row_RecordRoom['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoom['id']; ?>" title="<?php echo $row_RecordRoom['name']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/room/thumb/small_<?php echo GetFileThumbExtend($row_RecordRoom['pic']); ?>" alt="<?php echo $row_RecordRoom['sdescription']; ?>"/></a>
                      <?php } else { ?>      
                      <a><img src="images/100x100_noimage.jpg" width="100" height="100"/></a>
                      <?php } ?>
                  <?php } else if ($level == '0') { ?>
                      <?php if ($row_RecordRoom['pic'] != "") { ?> 
                      <a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordRoom['type1']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoom['id']; ?>" title="<?php echo $row_RecordRoom['name']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/room/thumb/small_<?php echo GetFileThumbExtend($row_RecordRoom['pic']); ?>" alt="<?php echo $row_RecordRoom['sdescription']; ?>"/></a>
                      <?php } else { ?>      
                      <a><img src="images/100x100_noimage.jpg" width="100" height="100"/></a>
                      <?php } ?>
                  <?php } else { ?>
                      <?php if ($row_RecordRoom['pic'] != "") { ?> 
                      <a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoom['id']; ?>" title="<?php echo $row_RecordRoom['name']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/room/thumb/small_<?php echo GetFileThumbExtend($row_RecordRoom['pic']); ?>" alt="<?php echo $row_RecordRoom['sdescription']; ?>"/></a>
                      <?php } else { ?>      
                      <a><img src="images/100x100_noimage.jpg" width="100" height="100"/></a>
                      <?php } ?>
                  <?php } ?>
                </div>
            </div>
        </div>
        
</div>
    <div class="col-md-8 col-sm-6 col-xs-12">
 
                              <?php if ($level == '2') { ?>
                              <h3><a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordRoom['type1'],'type2'=>$row_RecordRoom['type2'],'type3'=>$row_RecordRoom['type3']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoom['id']; ?>"><span style=""><strong><?php echo $row_RecordRoom['name']; ?></strong></span></a></h3>
                              
                              <div style="float:right; <?php if($row_RecordSystemConfigFr['roomreservationsenable'] == '0') { ?>display:none;<?php } ?>"><span class="InnerButtom"><a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reserve','type1'=>$row_RecordRoom['type1'],'type2'=>$row_RecordRoom['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoom['id']; ?>" class="colorbox_iframe" title="線上訂房"><i class="fa fa-arrow-circle-right"></i> 線上訂房</a></span></div><hr/>
                              <?php } else if ($level == '1') { ?>
                              <h3><a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordRoom['type1'],'type2'=>$row_RecordRoom['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoom['id']; ?>"><span style=""><strong><?php echo $row_RecordRoom['name']; ?></strong></span></a></h3>
                              
                              <div style="float:right;<?php if($row_RecordSystemConfigFr['roomreservationsenable'] == '0') { ?>display:none;<?php } ?>"><span class="InnerButtom"><a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reserve','type1'=>$row_RecordRoom['type1'],'type2'=>$row_RecordRoom['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoom['id']; ?>" class="colorbox_iframe" title="線上訂房"><i class="fa fa-arrow-circle-right"></i> 線上訂房</a></span></div><hr/>
                              <?php } else if ($level == '0') { ?>
                              <h3><a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordRoom['type1']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoom['id']; ?>"><span style=""><strong><?php echo $row_RecordRoom['name']; ?></strong></span></a></h3>
                              
                              <div style="float:right;<?php if($row_RecordSystemConfigFr['roomreservationsenable'] == '0') { ?>display:none;<?php } ?>"><span class="InnerButtom"><a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reserve','type1'=>$row_RecordRoom['type1']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoom['id']; ?>" class="colorbox_iframe" title="線上訂房"><i class="fa fa-arrow-circle-right"></i> 線上訂房</a></span></div><hr/>
                              <?php } else { ?>
                              <h3><a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoom['id']; ?>"><span style=""><strong><?php echo $row_RecordRoom['name']; ?></strong></span></a></h3>
                              
                              <div style="float:right;<?php if($row_RecordSystemConfigFr['roomreservationsenable'] == '0') { ?>display:none;<?php } ?>"><span class="InnerButtom"><a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reserve'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoom['id']; ?>" class="colorbox_iframe" title="線上訂房"><i class="fa fa-arrow-circle-right"></i> 線上訂房</a></span></div><hr/>
                              <?php } ?>
<div style="margin-bottom:3px;">訂價：<span style="background-color:#069; color:#FFF; padding:2px;-webkit-border-radius:4px; -moz-border-radius:4px; -o-border-radius:4px; border-radius:4px; box-shadow:0 1px 3px rgba(0,0,0,.2); -webkit-box-shadow:0 1px 3px rgba(0,0,0,.2); -moz-box-shadow:0 1px 3px rgba(0,0,0,.2); -o-box-shadow:0 1px 3px rgba(0,0,0,.2);">住宿</span>$NT <span style="color:#F00;"><?php echo $row_RecordRoom['listprice']; ?></span> 元</div>
                            <div style="margin-bottom:3px;">優惠：<span style="background-color:#093; color:#FFF; padding:2px;-webkit-border-radius:4px; -moz-border-radius:4px; -o-border-radius:4px; border-radius:4px; box-shadow:0 1px 3px rgba(0,0,0,.2); -webkit-box-shadow:0 1px 3px rgba(0,0,0,.2); -moz-box-shadow:0 1px 3px rgba(0,0,0,.2); -o-box-shadow:0 1px 3px rgba(0,0,0,.2);">平日</span>$NT <span style="color:#F00;"><?php echo $row_RecordRoom['weekprice']; ?></span> 元 <span style=" background-color:#C00;color:#FFF; padding:2px;-webkit-border-radius:4px; -moz-border-radius:4px; -o-border-radius:4px; border-radius:4px; box-shadow:0 1px 3px rgba(0,0,0,.2); -webkit-box-shadow:0 1px 3px rgba(0,0,0,.2); -moz-box-shadow:0 1px 3px rgba(0,0,0,.2); -o-box-shadow:0 1px 3px rgba(0,0,0,.2);">假日</span>$NT <span style="color:#F00;"><?php echo $row_RecordRoom['holidayprice']; ?></span> 元</div>
                            <div style="margin-bottom:3px;">住房人數： <span style="color:#F00;"><?php echo $row_RecordRoom['peoplenum']; ?></span> 位 / 房間數： <span style="color:#F00;"><?php echo $row_RecordRoom['roomnum']; ?></span> 間</div>
                           <div style="color:#999"><?php echo $row_RecordRoom['sdescription']; ?></div>
</div>
</div> 
<?php $i++; ?>
        <?php } while ($row_RecordRoom = mysqli_fetch_assoc($RecordRoom)); ?>
       



  
  
  <div style="height:10px;"></div>
                    <?php if($totalPages_RecordRoom > 0) { ?>
 				    <div class="col-md-7 col-xs-12">
                        <div style="text-align:center;">
                        <?php //if ($page > 0) { // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordRoom); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-double-left"></i>
                            <span><?php echo $Lang_First; ?></span>
                            </a>
                        </div>
                        <?php //} // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, max(0, $page-1), $queryString_RecordRoom); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-left"></i>
                            <span><?php echo $Lang_Prev; ?></span>
                            </a> 
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, min($totalPages_RecordRoom, $page+1), $queryString_RecordRoom); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-right"></i>
                            <span><?php echo $Lang_Next; ?></span>
                            </a>
                        </div>
                        <?php //if ($page < $totalPages_RecordRoom) { // Show if not last page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordRoom, $queryString_RecordRoom); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-double-right"></i>
                            <span><?php echo $Lang_Last; ?></span>
                            </a>
                        </div>
                        <?php //} // Show if not first page ?>
                        </div>
                    </div>
                    <div class="col-md-5 col-xs-12">
                        <div> 
                            <div class="col-md-3 col-xs-4">
                            <a href="#" class="btn btn-white" style="width:100%; margin:2px 0px 2px 0px;">
                                <span><?php echo $Lang_PageNum; ?></span>
                            </a>
                            </div>
                            <div class="col-md-3 col-xs-4">
                            <div style="margin:2px 0px 2px 0px;">
                                <select class="form-control" onchange="location = this.options[this.selectedIndex].value;">
                                    <?php for($i=0; $i<ceil($totalRows_RecordRoom/$maxRows_RecordRoom); $i++) { ?>
                                    <option value="<?php printf("%s?page=%d%s", $currentPage, $i,  $queryString_RecordRoom); ?>" <?php if($_GET['page'] == $i) { ?>selected="selected"<?php } ?>><?php echo $i+1; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-6 col-xs-4">
                            <a href="#" class="btn btn-white" style="width:100%; margin:2px 0px 2px 0px;">
                                <span><?php echo $Lang_Content_Count_Total; ?><?php echo $totalRows_RecordRoom; ?><?php echo $Lang_Content_Count_Lots; ?></span>
                            </a>
                            </div>
                        </div>
                    </div>
                    
                    <?php } ?>
                    
                    <div style="clear:both;"></div>
                    
                    


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
          <td width="189"><?php echo $Lang_Error_NoSearch; //目前尚無資料 ?></td>
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
<script type="text/javascript">
$(document).ready(function () {
    heightMan();

    $(window).resize(function () {
        heightMan();
    });
});

function heightMan() {	
	var _dw = jQuery(".shop-item").width();
	var _w = jQuery(".shop-item").width();
	var _wItem	= _w;
	var _hItem = _wItem*0.75;
	
	//console.log(_dw);
    var container_node = $('.center-cropped-img');
    //var container_height = container_node.height();
    container_height = _hItem;

    container_node.css('height', container_height);
}
</script>