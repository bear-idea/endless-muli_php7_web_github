<!--前後筆資料 END-->
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
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><span style="font-size:16px;">[<?php echo $row_RecordForum['type']; ?>]<?php echo $row_RecordForum['name']; ?></span></span></h1>
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
<!--標題外框-->
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
                <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
    <tr>
      <td width="50%"><?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordForumPost ?> <?php echo $Lang_Content_Count_Lots; //筆 ?>回覆</td>
      <td width="50%" align="right">
      
      <?php if ($ForumPostSearchSelect == "1") { ?>
      <form id="form_ForumPost" name="form_ForumPost" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search_ForumPost; ?>" />
        </label>
      </form>
      <?php } ?>  
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordForumPost = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordForumPost = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordForumPost = buildNavigation($pagePost,$totalPages_RecordForumPost,$prev_RecordForumPost,$next_RecordForumPost,$separator,$max_links,true); 
       ?>
      <?php if ($pagePost > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pagePost=%d%s", $currentPage, 0, $queryString_RecordForumPost); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordForumPost[0]; ?> 
      <?php print $pages_navigation_RecordForumPost[1]; ?> 
      <?php print $pages_navigation_RecordForumPost[2]; ?>
      <?php if ($pagePost < $totalPages_RecordForumPost) { // Show if not last page ?>
  <a href="<?php printf("%s?pagePost=%d%s", $currentPage, $totalPages_RecordForumPost, $queryString_RecordForumPost); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordForumPost/$maxRows_RecordForumPost) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $pagePost+1; ?> / <?php echo ceil($totalRows_RecordForumPost/$maxRows_RecordForumPost); ?></span><?php } ?>
      </div>  
      
      </td>
    </tr>
</table>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
                      <tr>
                        <td><?php //require("require_forum_member.php"); ?>                          <span style="color:#999; font-size:9px;">發表於<?php echo $row_RecordForum['postdate']; ?></span><?php if ($_SESSION['MM_Username_' . $_GET['wshop']] == $row_RecordForum['author']) { ?><span style="color:#900; font-size:9px;">[<a href="forum.php?wshop=<?php echo $_GET['wshop'] ?>&amp;Opt=editpostpage&amp;lang=<?php echo $_GET['lang']; ?>&amp;id=<?php echo $_GET['id']; ?>&amp;id_edit=<?php echo $row_RecordForum['id']; ?>">修改</a>]</span><span style="color:#900; font-size:9px;">[<a href="forum.php?wshop=<?php echo $_GET['wshop'] ?>&amp;Opt=detailed&amp;lang=<?php echo $_GET['lang']; ?>&amp;id=<?php echo $_GET['id']; ?>&amp;del_postid=<?php echo $row_RecordForum['id']; ?>">刪除</a>]</span><?php } ?></td>
                      </tr>
                      <tr>
                        <td><?php echo $row_RecordForum['content']; ?></td>
                      </tr>
                      <tr>
                        <td><hr></td>
                      </tr>
                      <?php if ($totalRows_RecordForumPost > 0) { // Show if recordset not empty ?>
					  <?php do { ?>
                        <tr>
                          <td bgcolor="#EEE">
                            <span style="font-size:16px;">RE:<?php echo $row_RecordForumPost['author']; ?></span></td>
                        </tr>
                        
                        <tr>
                          <td><span style="color:#999; font-size:9px;">回覆於<?php echo $row_RecordForumPost['postdate']; ?></span><?php if ($_SESSION['MM_Username_' . $_GET['wshop']] == $row_RecordForumPost['author']) { ?><span style="color:#900; font-size:9px;">[<a href="forum.php?wshop=<?php echo $_GET['wshop'] ?>&amp;Opt=detailed&amp;lang=<?php echo $_GET['lang']; ?>&amp;id=<?php echo $_GET['id']; ?>&amp;del_id=<?php echo $row_RecordForumPost['id']; ?>">刪除</a>]</span><?php } ?></td>
                        </tr>
                        <tr>
                          <td><?php echo $row_RecordForumPost['content']; ?></td>
                        </tr>
                        <?php } while ($row_RecordForumPost = mysqli_fetch_assoc($RecordForumPost)); ?>
                        <?php } // Show if recordset not empty ?>
                   </table>   
                   <?php if ((isset($_SESSION['MM_UserGroup_' . $_GET['wshop']]) && in_array($_SESSION['MM_UserGroup_' . $_GET['wshop']], $arr_MM_authorizedUsers))) { ?>
                   <?php require("require_forum_reply.php"); ?>
                   <?php } else { ?>
                   <div id='Tcha' style="padding:10px; background-color:#f5f5f5; border: 1px solid #CCC;">
                   您必須登入後才可回覆
                   </div>
                   <?php } ?>
                            <!-- **************************************************************** -->

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