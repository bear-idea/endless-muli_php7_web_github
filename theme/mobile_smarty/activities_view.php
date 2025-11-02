<style type="text/css">
div .activities_inner_board{margin:0;padding:0;width:210px}
div .activities_inner_board .photoFram_Block_glossy,.div_activities_table-cell{overflow:hidden;height:100px;width:150px}
.activities_inner_board_relative{position:relative}
.activities_inner_board_relative_buttom{position:relative}
div .activities_inner_board_context{text-align:left}
td.activities_down_board{padding:5px}
.activities_bottom_hight{height:5px}
.div_right_bottom_Activities{width:100px;float:right;right:0;bottom:0;z-index:20;border:0 solid #69c;_position:absolute}
.center-cropped-img{width:100%;overflow:hidden;margin:auto;position:relative}
.center-cropped-img img{position:absolute;left:-100%;right:-100%;top:-100%;bottom:-100%;margin:auto;min-height:100%;min-width:100%}
</style>
<?php
/*********************************************************************
 # 主頁面活動花絮
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
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Activities']; // 標題文字 ?></span></h1>
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
if ($totalRows_RecordActivities > 0) { // Show if recordset not empty 
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
<ul class="shop-item-list row list-inline nomargin">
        <?php do {  ?>  
        <!-- ITEM -->
        <li class="col-lg-12">

            <div class=" clearfix">
                    <div class="col-md-3 col-sm-6 col-xs-12"> 
                    <div class="photoFrame_<?php echo $TmpActivitiesBoard; ?>">
                    <div class="shop-item nomargin"> 
                    <!-- product image(s) -->
                    <div class="center-cropped-img">
                    <?php if ($row_RecordActivities['photonum'] > 0 && $row_RecordActivities['pic'] != "") { ?>
                    <a href="<?php echo $SiteBaseUrl . url_rewrite("activities",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordActivities['act_id']),'',$UrlWriteEnable);?>">
                        <img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/activities/thumb/small_<?php echo  GetFileThumbExtend($row_RecordActivities['pic']);?>" alt="<?php echo  $row_RecordActivities['sdescription'];?>" />	
                    </a>
                    <?php } else { ?>
                    <a><img src="<?php echo $TplImagePath ?>/act_noimage.jpg"/></a>
                    <?php } ?>
                    </div>
                    <!-- /product image(s) -->
                    </div>
                    </div>
                    </div>
                
                
                <div class="shop-item-summary col-md-9 col-sm-6 col-xs-12">
                    <h2><?php if($row_RecordActivities['type'] != "") { ?><span class="TipTypeStyle" data-scroll-reveal="enter top after 0.5s">[<?php echo highLight($row_RecordActivities['type'], @$_GET['searchkey'], $HighlightSelect); ?>]</span><?php } ?> <?php if ($row_RecordActivities['photonum'] > 0 && $row_RecordActivities['pic'] != "") { ?><span data-scroll-reveal="enter left after 0.2s"><a href="<?php echo $SiteBaseUrl . url_rewrite("activities",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordActivities['act_id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordActivities['title']; ?></a></span><br /><?php } else { ?><span data-scroll-reveal="enter left after 0.2s"><?php echo $row_RecordActivities['title']; ?></span><br /><?php } ?></h2>
                    
                    <ul class="list-inline">
                          <li>
                              <a href="#">
                                  <i class="fa fa-picture-o" aria-hidden="true"></i>
                                  <span class="font-lato"><?php if($row_RecordActivities['photonum'] != "") { echo $row_RecordActivities['photonum']  . $Lang_Classify_Context_PhotoNum_Activities /*張相片*/ ; } ?></span>
                              </a>
                          </li>
                          <li>
                              <a href="#">
                                  <i class="fa fa-clock-o"></i>  
                                  <span class="font-lato"><?php echo date('Y-m-d',strtotime($row_RecordActivities['postdate'])); ?></span>
                              </a>
                          </li>
					</ul>
                    
                    <hr>
                    
                    <?php echo nl2br($row_RecordActivities['sdescription']); ?>
                   
                    <br/>
                    <?php if ($row_RecordActivities['photonum'] > 0 && $row_RecordActivities['pic'] != "") { ?>
                    <a href="<?php echo $SiteBaseUrl . url_rewrite("activities",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordActivities['act_id']),'',$UrlWriteEnable);?>" class="btn btn-reveal btn-default">
								<i class="fa fa-plus"></i>
								<span>More</span>
					</a>
					<?php } else { ?>
					<?php } ?>
                </div>

            </div>

        </li>
        <!-- /ITEM -->
        
        <?php 
			$startRow_RecordActivities++;
			#
			# ============== [/tr color change] ============== #
			?>
            <?php $m_count++; ?>
		  <?php 
          #
          # ============== [/while] ============== #
          } while ($row_RecordActivities = mysqli_fetch_assoc($RecordActivities)); 
          ?>

								
</ul>

    <div style="height:10px;"></div>
                    <?php if($totalPages_RecordActivities > 0) { ?>
 				    <div class="col-md-7 col-xs-12">
                        <div style="text-align:center;">
                        <?php //if ($page > 0) { // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordActivities); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-double-left"></i>
                            <span><?php echo $Lang_First; ?></span>
                            </a>
                        </div>
                        <?php //} // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, max(0, $page-1), $queryString_RecordActivities); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-left"></i>
                            <span><?php echo $Lang_Prev; ?></span>
                            </a> 
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, min($totalPages_RecordActivities, $page+1), $queryString_RecordActivities); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-right"></i>
                            <span><?php echo $Lang_Next; ?></span>
                            </a>
                        </div>
                        <?php //if ($page < $totalPages_RecordActivities) { // Show if not last page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordActivities, $queryString_RecordActivities); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
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
                                    <?php for($i=0; $i<ceil($totalRows_RecordActivities/$maxRows_RecordActivities); $i++) { ?>
                                    <option value="<?php printf("%s?page=%d%s", $currentPage, $i,  $queryString_RecordActivities); ?>" <?php if($_GET['page'] == $i) { ?>selected="selected"<?php } ?>><?php echo $i+1; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-6 col-xs-4">
                            <a href="#" class="btn btn-white" style="width:100%; margin:2px 0px 2px 0px;">
                                <span><?php echo $Lang_Content_Count_Total; ?><?php echo $totalRows_RecordActivities; ?><?php echo $Lang_Content_Count_Lots; ?></span>
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
if ($totalRows_RecordActivities == 0) { // Show if recordset empty 
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
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Activities']; // 標題文字 ?>  →  新增</strong> 來建立該項目<?php } ?></td>
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