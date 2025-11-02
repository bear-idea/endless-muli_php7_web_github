<style type="text/css">
div .knowledge_inner_board{margin:0;padding:0;width:130px}
div .knowledge_inner_board .photoFram_Block_glossy,.div_knowledge_table-cell{overflow:hidden;height:90px;width:120px}
.knowledge_inner_board_relative{position:relative}
.knowledge_inner_board_relative_buttom{position:relative}
.div_knowledge_table-cell{text-align:center;vertical-align:middle;background:#fff;border:4px solid #fff;position:relative;-webkit-border-radius:4px;-moz-border-radius:4px;-o-border-radius:4px;border-radius:4px;box-shadow:0 1px 4px rgba(0,0,0,.2);-webkit-box-shadow:0 1px 4px rgba(0,0,0,.2);-moz-box-shadow:0 1px 4px rgba(0,0,0,.2);-o-box-shadow:0 1px 4px rgba(0,0,0,.2)}
.div_knowledge_table-cell span{height:100%;display:inline-block;background-image:none;border-style:none}
.div_knowledge_table-cell *{vertical-align:middle}
div .knowledge_inner_board_context{text-align:left}
td.knowledge_down_board{padding:5px}
.knowledge_bottom_hight{height:5px}
.div_right_bottom_Knowledge{width:100px;float:right;right:0;bottom:0;z-index:20;border:0 solid #69c;_position:absolute}
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
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Knowledge']; // 標題文字 ?></span></h1>
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
if ($totalRows_RecordKnowledge > 0) { // Show if recordset not empty 
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
<?php //include('app/typemenu/typemenu_tp.php');// 多層不支援 ?>
<?php } ?>


    <ul class="list-inline row nomargin">  
 	  <?php $i=$startRow_RecordActnews + 1; // 取得頁面第一項商品之編號 ?>
      <?php $m_count=1; ?>
          <?php do { ?> 
                <li class="col-md-3 col-sm-6 col-xs-6">
                <div class="photoFrame_base">
                                <div class="shop-item nomargin"> 
                                <div class="imgLiquid" data-fill="<?php echo 'resize'; /* resize or crop */ ?>" data-board="<?php echo '1'; /* 方型 or 矩形 */ ?>">
                                <?php if ($row_RecordKnowledge['pic'] != "") { ?>	 
									   <?php if($row_RecordKnowledge['type1'] != '-1' && $row_RecordKnowledge['type2'] != '-1' && $row_RecordKnowledge['type3'] != '-1') { ?>
									   <a href="<?php echo $SiteBaseUrl . url_rewrite("knowledge",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordKnowledge['type1'],'type2'=>$row_RecordKnowledge['type2'],'type3'=>$row_RecordKnowledge['type3']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordKnowledge['id']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/knowledge/<?php echo  GetFileThumbExtend($row_RecordKnowledge['pic']);?>" alt="<?php echo $row_RecordKnowledge['sdescription']; ?>"/></a>
									   <?php } else if($row_RecordKnowledge['type1'] != '-1' && $row_RecordKnowledge['type2'] != '-1') { ?>
									   <a href="<?php echo $SiteBaseUrl . url_rewrite("knowledge",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordKnowledge['type1'],'type2'=>$row_RecordKnowledge['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordKnowledge['id']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/knowledge/<?php echo  GetFileThumbExtend($row_RecordKnowledge['pic']);?>" alt="<?php echo $row_RecordKnowledge['sdescription']; ?>"/></a>
									   <?php } else if($row_RecordKnowledge['type1'] != '-1') { ?>
									   <a href="<?php echo $SiteBaseUrl . url_rewrite("knowledge",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordKnowledge['type1']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordKnowledge['id']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/knowledge/<?php echo  GetFileThumbExtend($row_RecordKnowledge['pic']);?>" alt="<?php echo $row_RecordKnowledge['sdescription']; ?>"/></a>
									   <?php } else  { ?>
									   <a href="<?php echo $SiteBaseUrl . url_rewrite("knowledge",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordKnowledge['id']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/knowledge/<?php echo  GetFileThumbExtend($row_RecordKnowledge['pic']);?>" alt="<?php echo $row_RecordKnowledge['sdescription']; ?>"/></a>
									   <?php } ?>
									  <?php } else { ?>      
									  <a><img src="<?php echo $TplNoLangImagePath ?>/198x60_noimage.jpg" width="198" height="60"/></a>
									  <?php } ?>
                
                </div>
                                </div>
                                
                                <div class="actnews_inner_board_context">
									   <?php if($row_RecordKnowledge['type1'] != '-1' && $row_RecordKnowledge['type2'] != '-1' && $row_RecordKnowledge['type3'] != '-1') { ?>
									   <sapn data-scroll-reveal="enter left after 0.2s"><a href="<?php echo $SiteBaseUrl . url_rewrite("knowledge",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordKnowledge['type1'],'type2'=>$row_RecordKnowledge['type2'],'type3'=>$row_RecordKnowledge['type3']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordKnowledge['id']; ?>"><?php echo $row_RecordKnowledge['name']; ?></a></sapn>
									   <?php } else if($row_RecordKnowledge['type1'] != '-1' && $row_RecordKnowledge['type2'] != '-1') { ?>
									   <sapn data-scroll-reveal="enter left after 0.2s"><a href="<?php echo $SiteBaseUrl . url_rewrite("knowledge",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordKnowledge['type1'],'type2'=>$row_RecordKnowledge['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordKnowledge['id']; ?>"><?php echo $row_RecordKnowledge['name']; ?></a></sapn>
									   <?php } else if($row_RecordKnowledge['type1'] != '-1') { ?>
									   <sapn data-scroll-reveal="enter left after 0.2s"><a href="<?php echo $SiteBaseUrl . url_rewrite("knowledge",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordKnowledge['type1']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordKnowledge['id']; ?>"><?php echo $row_RecordKnowledge['name']; ?></a></sapn>
									   <?php } else  { ?>
									   <sapn data-scroll-reveal="enter left after 0.2s"><a href="<?php echo $SiteBaseUrl . url_rewrite("knowledge",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordKnowledge['id']; ?>"><?php echo $row_RecordKnowledge['name']; ?></a></sapn>
									   <?php } ?>
									</div>
								</div>
                                
                   
                 </li>
          <?php $m_count++; ?>
          <?php $i++; ?>
          
          <?php } while ($row_RecordKnowledge = mysqli_fetch_assoc($RecordKnowledge)); ?>
          </ul>

    
    <div style="height:10px;"></div>
                    <?php if($totalPages_RecordKnowledge > 0) { ?>
 				    <div class="col-md-7 col-xs-12">
                        <div style="text-align:center;">
                        <?php //if ($page > 0) { // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordKnowledge); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-double-left"></i>
                            <span><?php echo $Lang_First; ?></span>
                            </a>
                        </div>
                        <?php //} // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, max(0, $page-1), $queryString_RecordKnowledge); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-left"></i>
                            <span><?php echo $Lang_Prev; ?></span>
                            </a> 
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, min($totalPages_RecordKnowledge, $page+1), $queryString_RecordKnowledge); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-right"></i>
                            <span><?php echo $Lang_Next; ?></span>
                            </a>
                        </div>
                        <?php //if ($page < $totalPages_RecordKnowledge) { // Show if not last page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordKnowledge, $queryString_RecordKnowledge); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
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
                                    <?php for($i=0; $i<ceil($totalRows_RecordKnowledge/$maxRows_RecordKnowledge); $i++) { ?>
                                    <option value="<?php printf("%s?page=%d%s", $currentPage, $i,  $queryString_RecordKnowledge); ?>" <?php if($_GET['page'] == $i) { ?>selected="selected"<?php } ?>><?php echo $i+1; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-6 col-xs-4">
                            <a href="#" class="btn btn-white" style="width:100%; margin:2px 0px 2px 0px;">
                                <span><?php echo $Lang_Content_Count_Total; ?><?php echo $totalRows_RecordKnowledge; ?><?php echo $Lang_Content_Count_Lots; ?></span>
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
if ($totalRows_RecordKnowledge == 0) { // Show if recordset empty 
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
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Knowledge']; // 標題文字 ?>  →  新增</strong> 來建立該項目<?php } ?></td>
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
/* 圖片(不)完全按比例自動縮圖 */
jQuery(document).ready(function(){$(window).load(function(){$(".div_knowledge_table-cell img").each(function(){if("true"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");var c=$(this).width(),d=$(this).height(),a=$(this).attr("_w")/c,b=$(this).attr("_h")/d,e=1,e=a>b?b:a;$(this).width(c*e);$(this).height(d*e)}else if("false"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");$(this).width();$(this).height();c=$(this).attr("_w");d=$(this).attr("_h");
a=$(this).width();b=$(this).height();if(a>c){var e=a,f=b,b=b*(c/a),a=c;b<d&&(a=e*(d/f),b=d)}$(this).attr({width:a,height:b})}})})});
</script>

<script type="text/javascript" charset="utf-8">
/* prettyPhoto */
$(document).ready(function(){$("a[rel^='prettyPhoto']").prettyPhoto({slideshow:5E3,autoplay_slideshow:!0,keyboard_shortcuts:!0,show_title:!1})});
</script>