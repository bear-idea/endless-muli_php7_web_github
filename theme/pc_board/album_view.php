<style type="text/css">
div .album_inner_board{margin:0;padding:0}
div .album_inner_board .photoFram_Block_glossy,.div_album_table-cell{overflow:hidden;height:130px;width:190px}
.album_inner_board_relative{position:relative}
.album_inner_board_relative_buttom{position:relative}
.album_title{border-bottom:1px solid #ccc;display:block;padding:0 0 5px;margin-top:10px;font-size:14px;height:25px;overflow:hidden;font-weight:bolder;width:<?php echo floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/3)-40-16; ?>px}
.meta{text-align:right;color:#777;font-style:italic}
.nailthumb-container{border:1px solid #EEE;width: <?php echo floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/3)-40-16; ?>px;height: <?php echo floor(floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/3)-40-16)*0.75; ?>px;margin:auto;}
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
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Album']; // 標題文字 ?></span></h1>
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
if ($totalRows_RecordAlbum > 0) { // Show if recordset not empty 
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
<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="album_outer_board">
    <tr>
      <td width="20%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordAlbum + 1) ?> - <?php echo min($startRow_RecordAlbum + $maxRows_RecordAlbum, $totalRows_RecordAlbum) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordAlbum ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
	  <?php if ($AlbumSearchSelect == "1") { ?>
      <form id="form_Album" name="form_Album" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <select name="type" id="type">
            <option value="%">-- 選擇類別 --</option>
            <?php
do {  
?>
            <option value="<?php echo $row_RecordAlbumListType['itemname']?>"><?php echo $row_RecordAlbumListType['itemname']?></option>
            <?php
} while ($row_RecordAlbumListType = mysqli_fetch_assoc($RecordAlbumListType));
  $rows = mysqli_num_rows($RecordAlbumListType);
  if($rows > 0) {
      mysqli_data_seek($RecordAlbumListType, 0);
	  $row_RecordAlbumListType = mysqli_fetch_assoc($RecordAlbumListType);
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
      $prev_RecordAlbum = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordAlbum = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordAlbum = buildNavigation($page,$totalPages_RecordAlbum,$prev_RecordAlbum,$next_RecordAlbum,$separator,$max_links,true); 
       ?>
      <?php if ($page > 0) { // Show if not first page ?>
  <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordAlbum); ?>"><i class="fa fa-angle-double-left"></i></a>
  <?php } // Show if not first page ?>
&nbsp;<?php print $pages_navigation_RecordAlbum[0]; ?> 
      <?php print $pages_navigation_RecordAlbum[1]; ?> 
      <?php print $pages_navigation_RecordAlbum[2]; ?>
      <?php if ($page < $totalPages_RecordAlbum) { // Show if not last page ?>
  <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordAlbum, $queryString_RecordAlbum); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
&nbsp;  <?php if (ceil($totalRows_RecordAlbum/$maxRows_RecordAlbum) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordAlbum/$maxRows_RecordAlbum); ?></span>
<?php } ?>
      </div>  
      
      </td>
    </tr>
    
</table>
<div class="columns on-3">
        <div class="container board">
        <?php $m_count=1; ?>
        <?php do { ?>
            <div class="column" data-scroll-reveal="enter top after <?php echo $m_count/100; ?>s">
                <div class="container ct_board">
              <?php 
			  #
              # ============== [if] ============== #
			  #
              # 判斷花絮中是否有相片，若無則以替代圖片顯示
              if ($row_RecordAlbum['photonum'] > 0 && $row_RecordAlbum['pic'] != "") { 
			  ?>
                <div class="album_inner_board">
                <div class="photoFrame_<?php echo $TmpAlbumBoard; ?>">
                <div class="album_inner_board_relative">
                <div class='<?php echo $TmpAlbumBoardIcon; ?>'></div>
                  <div class="nailthumb-container"><a href="<?php echo $SiteBaseUrl . url_rewrite("album",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordAlbum['act_id']),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/album/thumb/small_<?php echo  GetFileThumbExtend($row_RecordAlbum['pic']);?>"/></a><span></span>
                    </div> 
                </div> 
                <div class="album_title"><?php echo $row_RecordAlbum['title']; ?></div>
                <p></p>
                <div class="meta"><span style="float:left;"><?php echo $row_RecordAlbum['photonum'] . 'photos'; ?></span><?php echo highLight(date('Y-m-d',strtotime($row_RecordAlbum['postdate'])), @$_GET['searchkey'], $HighlightSelect); ?></div>
                </div>
                </div>
              <?php } else { ?>
              <div class="album_inner_board">
                <div class="photoFrame_<?php echo $TmpAlbumBoard; ?>">
                <div class="album_inner_board_relative">
                <div class='<?php echo $TmpAlbumBoardIcon; ?>'></div>
                  <div class="nailthumb-container">	 
                        <a><img src="<?php echo $TplNoLangImagePath ?>/190x130_noimage.jpg"/></a><span></span>
                  </div> 
                </div>  
                <div class="album_title"><?php echo $row_RecordAlbum['title']; ?></div>
                <p></p>
                <div class="meta"><span style="float:left;"><?php echo $row_RecordAlbum['photonum'] . 'photos'; ?></span><?php echo highLight(date('Y-m-d',strtotime($row_RecordAlbum['postdate'])), @$_GET['searchkey'], $HighlightSelect); ?></div>
                </div>
                </div>
                
                <?php } ?>     
            <?php 
			$startRow_RecordAlbum++;
			#
			# ============== [/tr color change] ============== #
			?>
                </div>
            </div>
            <?php $m_count++; ?>
            <?php } while ($row_RecordAlbum = mysqli_fetch_assoc($RecordAlbum)); ?>
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
if ($totalRows_RecordAlbum == 0) { // Show if recordset empty 
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
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Album']; // 標題文字 ?>  →  新增</strong> 來建立該項目<?php } ?></td>
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
				method:'resize', // 'crop' or 'resize'
				fitDirection:'center center'
			});
        });
</script>

<script type="text/javascript" charset="utf-8">
/* prettyPhoto */
$(document).ready(function(){$("a[rel^='prettyPhoto']").prettyPhoto({slideshow:5E3,autoplay_slideshow:!0,keyboard_shortcuts:!0,show_title:!1})});
</script>
<script type="text/javascript"> 
    $('.album_title').jcolumn();
</script>