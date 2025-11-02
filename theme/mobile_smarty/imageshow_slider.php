<style type="text/css">
.pikachoose {width: 700px; margin: 0 auto;}
/* Style the thumbnails */
.pika-thumbs{ padding: 0 16px; height: 75px; }
	.pika-thumbs li{ width: 144px; height:74px; margin: 10px 0 0 17px; padding: 0; overflow: hidden;
		float: left; list-style-type: none;padding: 3px; margin: 0 5px; background: #fafafa; border: 1px solid #e5e5e5; cursor: pointer;}
	.pika-thumbs li .clip {position:relative;height:100%;text-align: center; vertical-align: middle; overflow: hidden;}
	
/* The stage is the wrapper. The image fills 100% the height of the stage */
.pika-stage, .pika-textnav {width: 680px;}
.pika-stage {position: relative; background: #fafafa; border: 1px solid #e5e5e5; padding: 10px 10px 10px 10px; text-align:center; height:300px;}
.pika-stage img{max-height:500px;;}
.pika-stage .caption {position: absolute; background: #000; background: rgba(0,0,0,0.75);  border: 1px solid #141414; font-size: 11px; 
			color: #fafafa; padding: 10px; text-align: right; bottom: 50px; right: 10px;}
.pika-stage .caption p {padding: 0; margin: 0; line-height: 14px;}

/* Ths play, pause, prev and next buttons */
.pika-imgnav a {position: absolute; text-indent: -5000px; display: block;z-index:3;}
	.pika-imgnav a.previous {background: url(prev.png) no-repeat left 45%; height: 100%; width: 50px; top: 10px; left: 10px;cursor:pointer;}
	.pika-imgnav a.next {background: url(next.png) no-repeat right 45%; height: 100%; width: 50px; top: 10px; right: 10px;cursor:pointer;}
	.pika-imgnav a.play {background: url(play.png) no-repeat 0% 50%; height: 100px; width: 44px;top:0;left:50%;display: none;cursor:pointer;}
	.pika-imgnav a.pause {background: url(pause.png) no-repeat 0% 50%; height: 100px; width: 44px;top:0;left:50%;display:none;cursor:pointer;}

/* The previous and next textual buttons */
.pika-textnav {overflow: hidden; margin: 10px 0 0 0;bottom:10px; position:absolute;}
.pika-textnav a {font-size: 12px; text-decoration: none; color: #333; padding: 4px;}
	.pika-textnav a.previous {float: left; width: auto; display: block;}
	.pika-textnav a.next {float: right; width: auto; display: block;}

/*for the tool tips*/
.pika-tooltip{font-size:12px;position:absolute;color:white;padding:3px; background-color: rgba(0,0,0,0.7);border:3px solid black;}
.pika-counter{position: absolute;bottom: 45px;left:15px;color:white;background:rgba(0,0,0,0.7);font-size:11px;padding:3px;-moz-border-radius: 5px;border-radius:5px;}

/* If using user thumbnails there's a pause well the new large image loads. This is the loader for that */		
.pika-loader{ background:url(loading.gif) 3px 3px no-repeat #000; background-color:rgba(0,0,0,0.9); color:white; width:60px; font-size:11px; padding:5px 3px; 
	text-align:right; position:absolute; top:15px; right:15px; }

</style>
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
          <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Imageshow']; // 標題文字 ?></span></h1>
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
# ============== [if] ============== #
#
# 在此判斷式之內放置要顯示之內容
if ($totalRows_RecordImageshow > 0 ) { // Show if recordset not empty 
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
  <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
    <tr>
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordImageshow + 1) ?> - <?php echo min($startRow_RecordImageshow + $maxRows_RecordImageshow, $totalRows_RecordImageshow) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordImageshow ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
      <?php if ($ImageshowSearchSelect == "1") { ?>
      <form id="form_Imageshow" name="form_Imageshow" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search_Imageshow; ?>" />
        </label>
      </form>
      <?php } ?>
      
      
       
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordImageshow = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordImageshow = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordImageshow = buildNavigation($page,$totalPages_RecordImageshow,$prev_RecordImageshow,$next_RecordImageshow,$separator,$max_links,true); 
       ?>
      <?php if ($page > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordImageshow); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordImageshow[0]; ?> 
      <?php print $pages_navigation_RecordImageshow[1]; ?> 
      <?php print $pages_navigation_RecordImageshow[2]; ?>
      <?php if ($page < $totalPages_RecordImageshow) { // Show if not last page ?>
  <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordImageshow, $queryString_RecordImageshow); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordImageshow/$maxRows_RecordImageshow) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordImageshow/$maxRows_RecordImageshow); ?></span><?php } ?>
      </div>  
      
      </td>
    </tr>
</table>
                      <!-- 內容 -->
                      <script type="text/javascript" src="js/jquery.jcarousel.min.js"></script>
					  <script type="text/javascript" src="js/jquery.pikachoose.min.js"></script>
                      <script language="javascript">
                        $(document).ready(
                            function (){
                                $("#pikame").PikaChoose({carousel:true,carouselOptions:{wrap:'circular'}});
				});
                      </script>
                      <div class="pikachoose">
                            <ul id="pikame" >
                            <?php do { ?>
                            	<?php if ($row_RecordImageshow['pic'] != "") { ?>	 
                            	<li><a href="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/imageshow/<?php echo $row_RecordImageshow['pic']; ?>" rel="prettyPhoto[pp_gal]" title="<?php echo $row_RecordImageshow['sdescription']; ?>" ><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/imageshow/<?php echo  GetFileThumbExtend($row_RecordImageshow['pic']);?>" alt="<?php echo $row_RecordImageshow['sdescription']; ?>"/></a><span><?php echo $row_RecordImageshow['sdescription']; ?></span></li>
								<?php } else { ?>      
                                <a><img src="<?php echo $TplNoLangImagePath ?>/198x60_noimage.jpg" width="198" height="60"/></a><span></span>
                                <?php } ?>
                            <?php } while ($row_RecordImageshow = mysqli_fetch_assoc($RecordImageshow)); ?>   
                            </ul>
                      </div>
                      <!-- 內容 End-->
                   

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
if ($totalRows_RecordImageshow == 0) { // Show if recordset empty 
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
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Imageshow']; // 標題文字 ?>  →  新增</strong> 來建立新資料<?php } ?></td>
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

<script type="text/javascript" charset="utf-8">
/* prettyPhoto */
$(document).ready(function(){$("a[rel^='prettyPhoto']").prettyPhoto({slideshow:5E3,autoplay_slideshow:!0,keyboard_shortcuts:!0,show_title:!1})});
</script>
