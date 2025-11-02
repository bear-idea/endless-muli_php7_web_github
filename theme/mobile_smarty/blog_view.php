<?php
/*********************************************************************
 # 主頁面產品資訊
 *********************************************************************/
?>
<style>
.Blog_Type_Img{float:left; background: #fff; border: 4px solid #fff; position: relative; -webkit-border-radius: 4px; -moz-border-radius: 4px; -o-border-radius: 4px; border-radius: 4px; box-shadow: 0 1px 4px rgba(0,0,0,.2); -webkit-box-shadow: 0 1px 4px rgba(0,0,0,.2); -moz-box-shadow: 0 1px 4px rgba(0,0,0,.2); -o-box-shadow: 0 1px 4px rgba(0,0,0,.2); width:110px;}
.Blog_Type_Img img{}
.div_table-cell{overflow:hidden; height:80px; width:100px; margin:5px}
.div_table-cell, .div_table-cell_type{text-align:center; vertical-align:middle;}
.div_table-cell span, .div_table-cell_type span{height:100%; display:inline-block; background-image:none; border-top-style:none; border-right-style:none; border-bottom-style:none; border-left-style:none}
.div_table-cell *, .div_table-cell_type *{vertical-align:middle}
</style>
<?php 
if ($totalRows_RecordBlog > 0) { 
?>
<?php
function getlistrandomimage($text)
{
	preg_match_all('/< *img[^>]*src *= *["\']?([^"\']*)/i', $text, $match);  // 取得圖片路徑
	if(count($match[1]) <= 0)
	{
		$match = "images/shop3500_noimage.jpg";
		echo $match;
	}else{
		$put_open='0';
		for($i=0; $i<count($match[1]); $i++)
		{
				switch(GetFileExtend($match[1][$i]))
				{
					case ".jpg":
					echo $match[1][$i];
					$put_open='1';
					break;
					case ".jpeg":
					echo $match[1][$i];
					$put_open='1';
					break;
					case ".bmp":
					echo $match[1][$i];
					$put_open='1';
					break;
					case ".png":
					echo $match[1][$i];
					$put_open='1';
					break;
				}
			if($put_open == '1')
			{
				break;
			}
			
		}
		
		if($put_open == '0'){
			for($i=0; $i<count($match[1]); $i++)
			{
				if(GetFileExtend($match[1][$i]) == '.gif')
				{
					echo "images/shop3500_noimage.jpg";
					break;
				}
				
			}
		}
	}
}
?>
<?php do { ?>
 <?php // 判斷所在之層級
                                if($row_RecordBlog['type1'] != '-1' && $row_RecordBlog['type2'] != '-1' && $row_RecordBlog['type3'] != '-1') { $level='2'; }
                                else if($row_RecordBlog['type1'] != '-1' && $row_RecordBlog['type2'] != '-1' && $row_RecordBlog['type3'] == '-1') { $level='1'; }
                                else if($row_RecordBlog['type1'] != '-1' && $row_RecordBlog['type2'] == '-1' && $row_RecordBlog['type3'] == '-1') { $level='0'; }
                                else { $level=''; }
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
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $row_RecordBlog['title']; ?></span></h1>
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
<div class="columns on-1">
    <div class="container board">
    <div class="column">
      <div class="container ct_board">
            <span style="float:right; margin-right:5px; width:350px; text-align:right;">
              <?php //require("require_sharelink.php"); ?>
              </span>
            <?php //require("require_fb_like.php"); ?>
            <br />
            <?php if ($row_RecordBlog['pass'] == '' || $row_RecordBlog['userid'] == $_SESSION['w_userid']) { ?>
            <div class="blog_load_img"><div class="Blog_Type_Img div_table-cell"><a><img src="<?php getlistrandomimage($row_RecordBlog['content']); ?>" alt="<?php echo $row_RecordSite['title']; ?>" alumb="false" _w="100" _h="80" /></a></div></div><br />
            <div><?php echo str_replace(array("\r","\n","\t","\s"), '', TrimByLength(strip_tags($row_RecordBlog['content']), 150, false)); ?></div>
            <br /><br />
            <div>
            <a href="blog.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=detailed&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;tp=Blog&amp;level=<?php echo $level; ?>&amp;type1=<?php echo $row_RecordBlog['type1']; ?>&amp;type2=<?php echo $row_RecordBlog['type2']; ?>&amp;type3=<?php echo $row_RecordBlog['type3']; ?>&amp;subitem_id=<?php echo $_GET['subitem_id']; ?>&amp;id=<?php echo $row_RecordBlog['id']; ?>"><?php echo $Lang_Classify_Context_ReadMore_Blog; //(繼續閱讀...) ?></a>
            </div>
			<?php } else { ?>
            <span style="color:#666;">
            <?php echo $Lang_Classify_Context_ReadMoreTip_Blog //閱讀此文章需要提示 ?><br />
            <?php echo $Lang_Classify_Context_PswTip_Blog //密碼提示： ?><?php echo $row_RecordBlog['passtip']; ?><br />   
            <form id="FormPassCheck" name="FormPassCheck" method="post" action="blog.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=detailed&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;tp=Blog&amp;level=<?php echo $level; ?>&amp;type1=<?php echo $row_RecordBlog['type1']; ?>&amp;type2=<?php echo $row_RecordBlog['type2']; ?>&amp;type3=<?php echo $row_RecordBlog['type3']; ?>&amp;subitem_id=<?php echo $_GET['subitem_id']; ?>&amp;id=<?php echo $row_RecordBlog['id']; ?>">
              <label for="pass"><?php echo $Lang_Classify_Context_Psw_Blog //密碼： ?></label>
              <input type="text" name="pass" id="pass" />
            </form>
            <br />
             </span>
            <?php } ?>
            <br /><br />
            
          <div style="border-bottom:dotted 1px #999999; margin:5px;"></div>
          <div style="text-align:right;"><a href="index.php?wshop=<?php echo $_GET['wshop'] ?>"><?php echo $row_RecordBlog['wshop']; ?></a> <?php echo $Lang_Classify_Context_Post_Blog //發表於 ?> <?php echo date('Y-m-d g:i A',strtotime($row_RecordBlog['postdate'])); ?> | <?php echo $Lang_Classify_Context_ViewCount_Blog //人氣 ?>(<?php echo $row_RecordBlog['viewcount']; ?>) | <?php echo $Lang_Classify_Context_ReplyCount_Blog //回應 ?>(<?php echo $row_RecordBlog['replycount']; ?>)</div>
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
<?php } while ($row_RecordBlog = mysqli_fetch_assoc($RecordBlog)); ?>
<?php
#
# ============== [rs date] ============== #
#
# 顯示資料集分頁
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
    <tr>
      <td align="center">
        
        
        <div class="PageSelectBoard">
          <?php 
      # variable declaration
      $prev_RecordBlog = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordBlog = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordBlog = buildNavigation($pageNum_RecordBlog,$totalPages_RecordBlog,$prev_RecordBlog,$next_RecordBlog,$separator,$max_links,true); 
       ?>
          <?php if ($pageNum_RecordBlog > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_RecordBlog=%d%s", $currentPage, 0, $queryString_RecordBlog); ?>"><i class="fa fa-angle-double-left"></i></a>
          <?php } // Show if not first page ?>
  <?php print $pages_navigation_RecordBlog[0]; ?> 
          <?php print $pages_navigation_RecordBlog[1]; ?> 
          <?php print $pages_navigation_RecordBlog[2]; ?>
          <?php if ($pageNum_RecordBlog < $totalPages_RecordBlog) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_RecordBlog=%d%s", $currentPage, $totalPages_RecordBlog, $queryString_RecordBlog); ?>"><i class="fa fa-angle-double-right"></i></a>
          <?php } // Show if not last page ?>
  <?php if (ceil($totalRows_RecordBlog/$maxRows_RecordBlog) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $pageNum_RecordBlog+1; ?> / <?php echo ceil($totalRows_RecordBlog/$maxRows_RecordBlog); ?></span><?php } ?>
        </div>      </td>
    </tr>
</table>
<?php
#
# ============== [/rs date] ============== #
?> 
<?php } ?>
<?php 
# 判斷當無資料顯示時之畫面
if ($totalRows_RecordBlog == 0) { 
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
                <div class="container ct_board">
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $row_RecordBlog['title']; ?></span></h1>
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
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;">文章管理  →  首頁設定</strong> 來設定該項目<br />
      或在 <strong style="color:#090;">文章管理  →  新增文章</strong> 來建立新資料<?php } ?></td>
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
}
?>
<script type="text/javascript">
/* 圖片(不)完全按比例自動縮圖 */
jQuery(document).ready(function(){$(window).load(function(){$(".div_table-cell img").each(function(){if("true"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");var c=$(this).width(),d=$(this).height(),a=$(this).attr("_w")/c,b=$(this).attr("_h")/d,e=1,e=a>b?b:a;$(this).width(c*e);$(this).height(d*e)}else if("false"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");$(this).width();$(this).height();c=$(this).attr("_w");d=$(this).attr("_h");
a=$(this).width();b=$(this).height();if(a>c){var e=a,f=b,b=b*(c/a),a=c;b<d&&(a=e*(d/f),b=d)}$(this).attr({width:a,height:b})}})})});
</script>