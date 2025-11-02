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

                <div class="ct_title">
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><span style="font-size:16px;">[<?php echo $row_RecordForum['type']; ?>]<?php echo $row_RecordForum['name']; ?></span></span></h1>
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
<div class="post_content padding-3">



               
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