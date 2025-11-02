<style type="text/css">
div .project_inner_board{margin:0;padding:0;width:210px}
.project_inner_board_relative{position:relative}
.project_inner_board_relative_buttom{position:relative}
.nailthumb-container{overflow:hidden;height:<?php echo floor(floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16)*0.75; ?>px;width:<?php echo floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16; ?>px; border:1px solid #EEE; margin:auto;}
div .project_inner_board_context{text-align:left}
td.project_down_board{padding:5px}
.project_bottom_hight{height:5px}
.div_right_bottom_Project{width:100px;float:right;right:0;bottom:0;z-index:20;border:0 solid #69c;_position:absolute}
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
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Project']; // 標題文字 ?></span></h1>
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
if ($totalRows_RecordProject > 0) { // Show if recordset not empty 
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
<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="project_outer_board">
    <tr>
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordProject + 1) ?> - <?php echo min($startRow_RecordProject + $maxRows_RecordProject, $totalRows_RecordProject) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordProject ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
	  <?php if ($ProjectSearchSelect == "1") { ?>
      <form id="form_Project" name="form_Project" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <select name="type" id="type">
            <option value="%">-- 選擇類別 --</option>
            <?php
do {  
?>
            <option value="<?php echo $row_RecordProjectListType['itemname']?>"><?php echo $row_RecordProjectListType['itemname']?></option>
            <?php
} while ($row_RecordProjectListType = mysqli_fetch_assoc($RecordProjectListType));
  $rows = mysqli_num_rows($RecordProjectListType);
  if($rows > 0) {
      mysqli_data_seek($RecordProjectListType, 0);
	  $row_RecordProjectListType = mysqli_fetch_assoc($RecordProjectListType);
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
      $prev_RecordProject = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordProject = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordProject = buildNavigation($pageNum_RecordProject,$totalPages_RecordProject,$prev_RecordProject,$next_RecordProject,$separator,$max_links,true); 
       ?>
      <?php if ($pageNum_RecordProject > 0) { // Show if not first page ?>
  <a href="<?php printf("%s?pageNum_RecordProject=%d%s", $currentPage, 0, $queryString_RecordProject); ?>"><i class="fa fa-angle-double-left"></i></a>
  <?php } // Show if not first page ?>
&nbsp;<?php print $pages_navigation_RecordProject[0]; ?> 
      <?php print $pages_navigation_RecordProject[1]; ?> 
      <?php print $pages_navigation_RecordProject[2]; ?>
      <?php if ($pageNum_RecordProject < $totalPages_RecordProject) { // Show if not last page ?>
  <a href="<?php printf("%s?pageNum_RecordProject=%d%s", $currentPage, $totalPages_RecordProject, $queryString_RecordProject); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
&nbsp;  <?php if (ceil($totalRows_RecordProject/$maxRows_RecordProject) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $pageNum_RecordProject+1; ?> / <?php echo ceil($totalRows_RecordProject/$maxRows_RecordProject); ?></span>
<?php } ?>
      </div>  
      
      </td>
    </tr>
    
</table>
<div class="columns on-1">
        <div class="container board">
            <div class="column">
                <div class="container ct_board">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="project_outer_board">
                <?php $m_count=1; ?>
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
		  $oddtr='TR_Odd_Color_Style_Project';
          $eventr='TR_Even_Color_Style_Project';
          if(($startRow_RecordProject)%2 == 0){
              $chahgecolorcount=$oddtr;
          }else{
              $chahgecolorcount=$eventr;
          }
          ?>
           <tr class= "<?php echo $chahgecolorcount; ?>">       
              <td width="<?php echo floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4); ?>" valign="middle" class="project_down_board">
              <?php 
			  #
              # ============== [if] ============== #
			  #
              # 判斷花絮中是否有相片，若無則以替代圖片顯示
              if ($row_RecordProject['photonum'] > 0 && $row_RecordProject['pic'] != "") { 
			  ?>
                
                <div class="photoFrame_<?php echo $TmpProjectBoard; ?>">
                <div class="project_inner_board_relative">
                <div class='<?php echo $TmpProjectBoardIcon; ?>'></div>
                  <div class="nailthumb-container"><a href="<?php echo $SiteBaseUrl . url_rewrite('project',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordProject['act_id']),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/project/thumb/small_<?php echo  GetFileThumbExtend($row_RecordProject['pic']);?>"/></a></div> 
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
                <div class="photoFrame_<?php echo $TmpProjectBoard; ?>">
                <div class="project_inner_board_relative">
                <div class='<?php echo $TmpProjectBoardIcon; ?>'></div>
                  <div class="nailthumb-container">	 
                        <a><img src="<?php echo $TplNoLangImagePath ?>/act_noimage.jpg"/></a>
                  </div> 
                </div>  
                </div>
                
                <?php
			  } 
			  # 
			  # ============== [/else] ============== #
			  ?>     
              </td>
             <td align="left" valign="middle"  class="project_down_board">
              <?php 
              #
              # ============== [if] ============== #
			  #
              # 判斷是否顯示分類項目
              if($row_RecordProject['type'] != "") { 
              ?>
                <span class="TipTypeStyle" data-scroll-reveal="enter top after 0.5s">[<?php echo highLight($row_RecordProject['type'], @$_GET['searchkey'], $HighlightSelect); ?>]</span> 
              <?php 
              } 
              # 
			  # ============== [/if] ============== #
              ?>
              <?php 
			  #
              # ============== [if] ============== #
			  #
              # 判斷花絮中是否有相片，若無則連結取消
              if ($row_RecordProject['photonum'] > 0 && $row_RecordProject['pic'] != "") { 
			  ?>
              <span data-scroll-reveal="enter left after 0.2s"><a href="<?php echo $SiteBaseUrl . url_rewrite('project',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordProject['act_id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordProject['title']; ?></a></span><br />
              <?php
			  #
			  # ============== [/if] ============== # 
			  #
			  # ============== [else] ============== # 
			  #
			  #
			  } else {
			  ?>
              <span data-scroll-reveal="enter left after 0.2s"><?php echo $row_RecordProject['title']; ?></span><br />
              <?php 
              } 
              # 
			  # ============== [/else] ============== #
              ?>
			  <?php echo nl2br($row_RecordProject['sdescription']); ?>
             </td>
             <td valign="middle"  class="project_down_board">
			  <?php 
		      #
              # ============== [if] ============== #
			  #
              # 判斷是否顯示照片張數
              if($row_RecordProject['photonum'] != "") {
		  		echo "<span class=\"TipTypeStyle\">";
		  		echo $row_RecordProject['photonum'] . $Lang_Classify_Context_PhotoNum_Project /*張相片*/ ;
				echo "</span>"; 
			  }
			  # 
			  # ============== [/if] ============== #
		 	  ?>
              </td>
              <td valign="middle"  class="project_down_board"><?php echo highLight(date('Y-m-d',strtotime($row_RecordProject['postdate'])), @$_GET['searchkey'], $HighlightSelect); ?></td> 
</tr>
           <tr class= "<?php echo $chahgecolorcount; ?>">
             <td valign="middle" class="project_bottom_hight"></td>
             <td align="left" valign="middle" ></td>
             <td valign="middle"></td>
             <td valign="middle" ></td>
           </tr>
            <?php 
			$startRow_RecordProject++;
			#
			# ============== [/tr color change] ============== #
			?>
            <?php $m_count++; ?>
      <?php 
      #
      # ============== [/while] ============== #
      } while ($row_RecordProject = mysqli_fetch_assoc($RecordProject)); 
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
if ($totalRows_RecordProject == 0) { // Show if recordset empty 
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
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Project']; // 標題文字 ?>  →  新增</strong> 來建立該項目<?php } ?></td>
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
        jQuery(document).ready(function() {
            jQuery('.nailthumb-container').nailthumb({
				method:'<?php echo $TmpProjectImageMethods; ?>', // 'crop' or 'resize'
				fitDirection:'center center'
			});
        });
</script>

<script language="javascript" type="text/javascript">
    $(document).ready(function () { /* Div 自動調整100%高度 */
        $(".project_inner_board").css("height", $("td.AutoHightTr").height()+"px");
    });
</script>

<script type="text/javascript" charset="utf-8">
/* prettyPhoto */
$(document).ready(function(){$("a[rel^='prettyPhoto']").prettyPhoto({slideshow:5E3,autoplay_slideshow:!0,keyboard_shortcuts:!0,show_title:!1})});
</script>