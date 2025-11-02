<?php
/*********************************************************************
 # 主頁面留言訊息
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
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Guestbook']; // 標題文字 ?></span></h1>
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
if ($totalRows_RecordGuestbookMessage > 0) { // Show if recordset not empty 
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
          	<td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?><?php echo ($startRow_RecordGuestbookMessage + 1) ?>  - <?php echo min($startRow_RecordGuestbookMessage + $maxRows_RecordGuestbookMessage, $totalRows_RecordGuestbookMessage) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordGuestbookMessage ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
            <td width="50%" align="right">     
           <img src="<?php echo $SiteBaseUrl; ?>images/message.gif" width="18" height="15" />&nbsp;&nbsp;<a href="<?php echo $SiteBaseUrl . url_rewrite('guestbook',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'addpage'),'',$UrlWriteEnable);?>"><?php echo $Lang_Title_PostMessage; ?></a>
            <br />
            <div class="PageSelectBoard">
			  <?php 
              # variable declaration
              $prev_RecordGuestbookMessage = "<i class=\"fa fa-angle-left\"></i>";
              $next_RecordGuestbookMessage = "<i class=\"fa fa-angle-right\"></i>";
              $separator = "&nbsp;";
              $max_links = 6;
              $pages_navigation_RecordGuestbookMessage = buildNavigation($pageMessage,$totalPages_RecordGuestbookMessage,$prev_RecordGuestbookMessage,$next_RecordGuestbookMessage,$separator,$max_links,true); 
               ?>
              <?php if ($pageMessage > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageMessage=%d%s", $currentPage, 0, $queryString_RecordGuestbookMessage); ?>"><i class="fa fa-angle-double-left"></i></a>
                <?php } // Show if not first page ?>
        <?php print $pages_navigation_RecordGuestbookMessage[0]; ?> 
              <?php print $pages_navigation_RecordGuestbookMessage[1]; ?> 
              <?php print $pages_navigation_RecordGuestbookMessage[2]; ?>
              <?php if ($pageMessage < $totalPages_RecordGuestbookMessage) { // Show if not last page ?>
          <a href="<?php printf("%s?pageMessage=%d%s", $currentPage, $totalPages_RecordGuestbookMessage, $queryString_RecordGuestbookMessage); ?>"><i class="fa fa-angle-double-right"></i></a>
          <?php } // Show if not last page ?>
        <?php if (ceil($totalRows_RecordGuestbookMessage/$maxRows_RecordGuestbookMessage) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $pageMessage+1; ?> / <?php echo ceil($totalRows_RecordGuestbookMessage/$maxRows_RecordGuestbookMessage); ?></span><?php } ?>
            </div>  
                    
            </td>
          </tr>
    </table>
<div class="columns on-1">
        <div class="container board">
            <div class="column">
                <div class="container ct_board">
				  <?php
                  #
                  # ============== [do] ============== #
                  #
                  # 重複印出所有資料
                  do { 
                  ?>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
                    <tr>
                      <td width="1136" valign="top"><?php echo $Lang_Classify_Context_Author_Guestbook; // 發表人 ?>： <font color="#2865A2"><strong><?php echo $row_RecordGuestbookMessage['author']; ?></strong></font>&nbsp;&nbsp;&nbsp;<?php echo $Lang_Classify_Context_Title_Guestbook; // 標題 ?>： <font color="#2865A2"><strong><?php echo $row_RecordGuestbookMessage['title']; ?></strong></font>&nbsp;&nbsp;&nbsp;</td>
                      <td width="150" align="right" valign="top">
                        <?php if($row_RecordGuestbookMessage['ip'] != "") { // 判斷ip是否顯示 ?>
                        <img src="<?php echo $SiteBaseUrl; ?>images/ip.gif" alt="<?php echo $row_RecordGuestbookMessage['ip']; ?>" width="16" height="16" />&nbsp;&nbsp;
                        <?php } ?>
                        <?php if($row_RecordGuestbookMessage['mail'] != "") { // 判斷信箱是否顯示 ?>
                        <a href="mailto:<?php echo $row_RecordGuestbookMessage['mail']; ?>"><img src="<?php echo $SiteBaseUrl; ?>images/mail.gif" width="16" height="16" /></a>&nbsp;&nbsp;
                        <?php } ?>
                        <?php if($row_RecordGuestbookMessage['msn'] != "") { // 判斷Msn是否顯示 ?>
                        <img src="<?php echo $SiteBaseUrl; ?>images/msn.gif" alt="<?php echo $row_RecordGuestbookMessage['msn']; ?>" width="16" height="16" />
                        <?php } ?>
                      </td>
                    </tr>
                    </table>  
                    
                    <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
                      <tr>
                        <td valign="top">
                          <?php 
                        /* 判斷是否為私密留言 */
                        if ($row_RecordGuestbookMessage['whisper'] == 1) {
                            if(($_SESSION['MM_UserGroup_' . $_GET['wshop']] == "superadmin") || ($_SESSION['MM_UserGroup_' . $_GET['wshop']] == "admin")) {
                                echo nl2br($row_RecordGuestbookMessage['content']);
                                echo "<br />";
                                echo $row_RecordGuestbookMessage['notes1'];
                            }
                            else {
                                echo "<font color=\"#ff0000\">此則留言為私密留言‧‧‧</font>";
                            }
                        }
                        else {
                            echo nl2br($row_RecordGuestbookMessage['content']);
                            echo "<br />";
                            echo $row_RecordGuestbookMessage['notes1'];
                        }	
                        ?>            </td>
                      </tr>
                      <tr>
                        <td>
                          <font color="#666666"> <?php echo $Lang_MessagePostDate; // 發表時間 ?>：
                          <?php echo date('Y-m-d',strtotime($row_RecordGuestbookMessage['postdate'])); ?>&nbsp;&nbsp;<?php echo date('g:i A',strtotime($row_RecordGuestbookMessage['postdate'])); ?>&nbsp;&nbsp;
                          </font>            </td>
                      </tr>
                      <tr>
                        <td><?php include("require_guestbook_reply.php");?></td>
                      </tr>
                    </table>
                  <?php 
                  #
                  # ============== [/while] ============== #
                  } while ($row_RecordGuestbookMessage = mysqli_fetch_assoc($RecordGuestbookMessage));
                  ?>
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
if ($totalRows_RecordGuestbookMessage == 0) { // Show if recordset empty 
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
          <td align="right" valign="top"><img src="<?php echo $SiteBaseUrl; ?>images/message.gif" width="18" height="15" />&nbsp;&nbsp;<a href="<?php echo $SiteBaseUrl . url_rewrite("publish",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'addpage'),'',$UrlWriteEnable);?>"><?php echo $Lang_Title_PostMessage; ?></a></td>
        </tr>
        <tr>
          <td align="center" valign="top"><font color="#ff0000">目前尚無留言！！</font></td>
        </tr>
      </table>
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