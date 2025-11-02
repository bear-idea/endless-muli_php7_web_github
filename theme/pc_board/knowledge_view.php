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
<div class="columns on-1">
        <div class="container">
            <div class="column">
                <div class="container ct_board ct_title">
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Knowledge']; // 標題文字 ?></span></h1>
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
<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="knowledge_outer_board">
    <tr>
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordKnowledge + 1) ?> - <?php echo min($startRow_RecordKnowledge + $maxRows_RecordKnowledge, $totalRows_RecordKnowledge) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordKnowledge ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
	  <?php if ($KnowledgeSearchSelect == "1") { ?>
      <form id="form_Knowledge" name="form_Knowledge" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <select name="type" id="type">
            <option value="%">-- 選擇類別 --</option>
            <?php
do {  
?>
            <option value="<?php echo $row_RecordKnowledgeListType['itemname']?>"><?php echo $row_RecordKnowledgeListType['itemname']?></option>
            <?php
} while ($row_RecordKnowledgeListType = mysqli_fetch_assoc($RecordKnowledgeListType));
  $rows = mysqli_num_rows($RecordKnowledgeListType);
  if($rows > 0) {
      mysqli_data_seek($RecordKnowledgeListType, 0);
	  $row_RecordKnowledgeListType = mysqli_fetch_assoc($RecordKnowledgeListType);
  }
?>
          </select>
          <img src="images/Search.png" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search; ?>" />
        </label>
      </form>
      <?php } ?>
      
      
       
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordKnowledge = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordKnowledge = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordKnowledge = buildNavigation($page,$totalPages_RecordKnowledge,$prev_RecordKnowledge,$next_RecordKnowledge,$separator,$max_links,true); 
       ?>
      <?php if ($page > 0) { // Show if not first page ?>
  <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordKnowledge); ?>"><i class="fa fa-angle-double-left"></i></a>
  <?php } // Show if not first page ?>
&nbsp;<?php print $pages_navigation_RecordKnowledge[0]; ?> 
      <?php print $pages_navigation_RecordKnowledge[1]; ?> 
      <?php print $pages_navigation_RecordKnowledge[2]; ?>
      <?php if ($page < $totalPages_RecordKnowledge) { // Show if not last page ?>
  <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordKnowledge, $queryString_RecordKnowledge); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
&nbsp;  <?php if (ceil($totalRows_RecordKnowledge/$maxRows_RecordKnowledge) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordKnowledge/$maxRows_RecordKnowledge); ?></span>
<?php } ?>
      </div>  
      
      </td>
    </tr>
    
</table>
<div class="columns on-1">
        <div class="container board">
            <div class="column">
                <div class="container ct_board">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="knowledge_outer_board">
      <!--<tr>
        <td width="125" valign="top"><?php echo $Lang_Classify_Context_ViewPic_Knowledge; // 圖片 ?></td>
        <td align="left" valign="top"><?php echo $Lang_Classify_Context_Title_Knowledge; // 標題 ?></td>
        <td width="80" valign="top"><?php echo $Lang_Classify_Context_PhotoNum_Knowledge; // 照片張數 ?></td>
        <td width="135" valign="top"><?php echo $Lang_Classify_Context_Date_Knowledge; // 日期 ?></td>
      </tr>-->
      
<?php
      #
      # ============== [do] ============== #
	  #
      # 重複印出所有資料
      do { 
      ?>
		  <?php
		  #
		  # ============== [tr color change] ============== #
		  #
		  # 表格隔行換色
		  $oddtr='TR_Odd_Color_Style_Knowledge';
          $eventr='TR_Even_Color_Style_Knowledge';
          if(($startRow_RecordKnowledge)%2 == 0){
              $chahgecolorcount=$oddtr;
          }else{
              $chahgecolorcount=$eventr;
          }
          ?>
           <tr class= "<?php echo $chahgecolorcount; ?>">       
              <td width="130" valign="middle" class="knowledge_down_board">
              <?php 
			  #
              # ============== [if] ============== #
			  #
              # 判斷花絮中是否有相片，若無則以替代圖片顯示
              if ($row_RecordKnowledge['pic'] != "") { 
			  ?>
                <div class="knowledge_inner_board" data-scroll-reveal="enter top after 0.1s">
                <div class="photoFrame_<?php echo $TmpKnowledgeBoard; ?>">
                <div class="knowledge_inner_board_relative">
                <div class='<?php echo $TmpKnowledgeBoardIcon; ?>'></div>
                  <div class="div_knowledge_table-cell"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/knowledge/thumb/small_<?php echo  GetFileThumbExtend($row_RecordKnowledge['pic']);?>" alumb="true" _w="120" _h="90"/><span></span>
                    </div> 
                </div>  
                </div>
                </div>
              <?php
			  #
			  # ============== [/if] ============== # 
			  #
			  # ============== [else] ============== # 
			  #
			  #
			  } else {
			  ?>
              <div class="knowledge_inner_board" data-scroll-reveal="enter top after 0.1s">
                <div class="photoFrame_<?php echo $TmpKnowledgeBoard; ?>">
                <div class="knowledge_inner_board_relative">
                <div class='<?php echo $TmpKnowledgeBoardIcon; ?>'></div>
                  <div class="div_knowledge_table-cell">	 
                       <img src="<?php echo $TplImagePath ?>/act_noimage.jpg" alumb="true" _w="120" _h="90"/><span></span>
                  </div> 
                </div>  
                </div>
                </div>
                
                <?php
			  } 
			  # 
			  # ============== [/else] ============== #
			  ?>     
              </td>
             <td colspan="2" align="left" valign="middle"  class="knowledge_down_board">
               <?php 
              #
              # ============== [if] ============== #
			  #
              # 判斷是否顯示分類項目
              if($row_RecordKnowledge['type'] != "") { 
              ?>
               <span class="TipTypeStyle">[<?php echo highLight($row_RecordKnowledge['type'], @$_GET['searchkey'], $HighlightSelect); ?>]</span>
               <?php 
              } 
              # 
			  # ============== [/if] ============== #
              ?>
              <?php if($row_RecordKnowledge['type1'] != '-1' && $row_RecordKnowledge['type2'] != '-1' && $row_RecordKnowledge['type3'] != '-1') { ?>
               <sapn data-scroll-reveal="enter left after 0.2s"><a href="<?php echo $SiteBaseUrl . url_rewrite("knowledge",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordKnowledge['type1'],'type2'=>$row_RecordKnowledge['type2'],'type3'=>$row_RecordKnowledge['type3']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordKnowledge['id']; ?>"><?php echo $row_RecordKnowledge['name']; ?></a></sapn>
               <?php } else if($row_RecordKnowledge['type1'] != '-1' && $row_RecordKnowledge['type2'] != '-1') { ?>
               <sapn data-scroll-reveal="enter left after 0.2s"><a href="<?php echo $SiteBaseUrl . url_rewrite("knowledge",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordKnowledge['type1'],'type2'=>$row_RecordKnowledge['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordKnowledge['id']; ?>"><?php echo $row_RecordKnowledge['name']; ?></a></sapn>
               <?php } else if($row_RecordKnowledge['type1'] != '-1') { ?>
               <sapn data-scroll-reveal="enter left after 0.2s"><a href="<?php echo $SiteBaseUrl . url_rewrite("knowledge",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordKnowledge['type1']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordKnowledge['id']; ?>"><?php echo $row_RecordKnowledge['name']; ?></a></sapn>
               <?php } else  { ?>
               <sapn data-scroll-reveal="enter left after 0.2s"><a href="<?php echo $SiteBaseUrl . url_rewrite("knowledge",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordKnowledge['id']; ?>"><?php echo $row_RecordKnowledge['name']; ?></a></sapn>
               <?php } ?>
               <br />
               <sapn data-scroll-reveal="enter top after 0.3s"><?php echo nl2br($row_RecordKnowledge['sdescription']); ?></sapn>
               
             </td>
             <td width="120" valign="middle"  class="knowledge_down_board"><?php echo highLight(date('Y-m-d',strtotime($row_RecordKnowledge['postdate'])), @$_GET['searchkey'], $HighlightSelect); ?></td> 
</tr>
           <tr class= "<?php echo $chahgecolorcount; ?>">
             <td valign="middle" class="knowledge_bottom_hight"></td>
             <td align="left" valign="middle" ></td>
             <td valign="middle"></td>
             <td valign="middle" ></td>
           </tr>
            <?php 
			$startRow_RecordKnowledge++;
			#
			# ============== [/tr color change] ============== #
			?>
      <?php 
      #
      # ============== [/while] ============== #
      } while ($row_RecordKnowledge = mysqli_fetch_assoc($RecordKnowledge)); 
      ?>
       
    </table>
                </div>
            </div>
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