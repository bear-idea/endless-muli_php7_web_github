<style type="text/css">
.Forum_Type{float:left;height:30px;margin-right:5px;margin-top:2px}
.Forum_Type a{padding:5px;border:1px solid #DDD;margin:5px 0}
.Forum_Type a:hover{border:1px solid #666;color:#FFF;background-color:#666;text-decoration:none}
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
  
        <div class="ct_title">
          <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Forum']; // 標題文字 ?></span></h1>
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
if ($totalRows_RecordForum > 0 ) { // Show if recordset not empty 
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
  
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="3" align="right"></td>
  </tr>
  <tr>
    <td align="right"><form id="form_Forum" name="form_Forum" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <img src="<?php echo $TplImagePath; ?>/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" title="搜尋標題"/>
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search; ?>" />
        </label>
      </form></td>
  </tr>
  
  </table>

        
<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
  <tr>
    <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordForum + 1) ?> - <?php echo min($startRow_RecordForum + $maxRows_RecordForum, $totalRows_RecordForum) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordForum ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
    <td width="50%" align="right"><?php //if ($ForumSearchSelect == "1") { ?>
      
      <?php //} ?>
      <div class="PageSelectBoard">
        <?php 
      # variable declaration
      $prev_RecordForum = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordForum = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordForum = buildNavigation($page,$totalPages_RecordForum,$prev_RecordForum,$next_RecordForum,$separator,$max_links,true); 
       ?>
        <?php if ($page > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordForum); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
        <?php print $pages_navigation_RecordForum[0]; ?> <?php print $pages_navigation_RecordForum[1]; ?> <?php print $pages_navigation_RecordForum[2]; ?>
        <?php if ($page < $totalPages_RecordForum) { // Show if not last page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordForum, $queryString_RecordForum); ?>"><i class="fa fa-angle-double-right"></i></a>
        <?php } // Show if not last page ?>
        <?php if (ceil($totalRows_RecordForum/$maxRows_RecordForum) > 1) { ?>
        <span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordForum/$maxRows_RecordForum); ?></span>
        <?php } ?>
      </div></td>
  </tr>
</table>

                   <span style="float:right;" class="Forum_Type"><a href="<?php echo $SiteBaseUrl . url_rewrite('forum',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'postpage'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordForum['id']; ?>">發新主題</a></span>
                   <span style="float:right;" class="Forum_Type"><a href="<?php echo $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Member']; // 會員中心 ?></a></span>
                   <?php if ((isset($_SESSION['MM_UserGroup_' . $_GET['wshop']]) && in_array($_SESSION['MM_UserGroup_' . $_GET['wshop']], $arr_MM_authorizedUsers))) {?>
                   <span style="float:right; margin-left:2px;" class="Forum_Type"><a href="<?php echo $logoutAction ?>">登出</a></span>
				   <?php } else { ?>
                   <span style="float:right;" class="Forum_Type"><a href="<?php echo $SiteBaseUrl . url_rewrite('forum',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reg'),'',$UrlWriteEnable);?>">註冊</a></span>   
                   <span style="float:right; margin-left:2px;" class="Forum_Type"><a href="<?php echo $SiteBaseUrl . url_rewrite('forum',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'log'),'',$UrlWriteEnable);?>">登入</a></span>
                   <?php } ?>
                <span style="width:100%;">
                <span class="Forum_Type"><a href="<?php echo $SiteBaseUrl . url_rewrite('forum',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>">全部</a></span>
                <?php do { ?>
                <?php if($row_RecordForum['type1'] != '-1' && $row_RecordForum['type2'] != '-1' && $row_RecordForum['type3'] != '-1') { ?>
                <span class="Forum_Type"><a href="<?php echo $SiteBaseUrl . url_rewrite('forum',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage','type1'=>$_GET['type1'],'type2'=>$_GET['type2'],'type3'=>$_GET['type3']),'',$UrlWriteEnable);?><?php echo $key_params; ?><?php echo $row_RecordForumListClass['itemname']; ?>"><?php echo $row_RecordForumListClass['itemname']; ?></a></span>
                <?php } else if($row_RecordForum['type1'] != '-1' && $row_RecordForum['type2'] != '-1') { ?>
                <span class="Forum_Type"><a href="<?php echo $SiteBaseUrl . url_rewrite('forum',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage','type1'=>$_GET['type1'],'type2'=>$_GET['type2']),'',$UrlWriteEnable);?><?php echo $key_params; ?><?php echo $row_RecordForumListClass['itemname']; ?>"><?php echo $row_RecordForumListClass['itemname']; ?></a></span>
                <?php } else if($row_RecordForum['type1'] != '-1') { ?>
                <span class="Forum_Type"><a href="<?php echo $SiteBaseUrl . url_rewrite('forum',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage','type1'=>$_GET['type1']),'',$UrlWriteEnable);?><?php echo $key_params; ?><?php echo $row_RecordForumListClass['itemname']; ?>"><?php echo $row_RecordForumListClass['itemname']; ?></a></span>
                <?php } else { ?>
                <span class="Forum_Type"><a href="<?php echo $SiteBaseUrl . url_rewrite('forum',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?><?php echo $key_params; ?><?php echo $row_RecordForumListClass['itemname']; ?>"><?php echo $row_RecordForumListClass['itemname']; ?></a></span>
                <?php } ?>
                <?php } while ($row_RecordForumListClass = mysqli_fetch_assoc($RecordForumListClass)); ?>
                </span>

<div style="height:10px;"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
      <tr>
        <td width="20" align="center" valign="top"></td>
        <td align="left" valign="top"><?php echo $Lang_Classify_Context_Title_Forum; // 標題 ?> </td>
        <td width="70" align="left" valign="top">點閱/回覆</td>
        <td width="100" align="left" valign="top">作者/時間</td>
        </tr>
      <?php if ($totalRows_RecordForum > 0) { // Show if recordset not empty ?>
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
		  $oddtr=TR_Odd_Color_Style;
          $eventr=TR_Even_Color_Style;
          if(($startRow_RecordForum)%2 == 0){
              $chahgecolorcount=$oddtr;
          }else{
              $chahgecolorcount=$eventr;
          }
          ?>
           <tr class= "<?php echo $chahgecolorcount; ?>">       
              <td align="center" valign="top"><img src="<?php echo $TplImagePath; ?>/sicon/icon_newslist.gif" alt="icon" width="17" height="17" /></td>
              <td valign="top">
              <?php 
              #
              # ============== [if] ============== #
			  #
              # 判斷是否顯示分類項目
              if($row_RecordForum['type'] != "") { 
              ?>
              <span class="TipTypeStyle">[<?php echo $row_RecordForum['type']; ?>]</span> 
              <?php 
              } 
              # 
			  # ============== [/if] ============== #
              ?>
			  <?php if($row_RecordForum['type1'] != '-1' && $row_RecordForum['type2'] != '-1' && $row_RecordForum['type3'] != '-1') { ?>
              <a href="<?php echo $SiteBaseUrl . url_rewrite('forum',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$_GET['type1'],'type2'=>$_GET['type2'],'type3'=>$_GET['type3']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordForum['id']; ?>"><?php echo highLight($row_RecordForum['name'], @$_GET['searchkey'], $HighlightSelect);?></a>
              <?php } else if($row_RecordForum['type1'] != '-1' && $row_RecordForum['type2'] != '-1') { ?>
              <a href="<?php echo $SiteBaseUrl . url_rewrite('forum',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$_GET['type1'],'type2'=>$_GET['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordForum['id']; ?>"><?php echo highLight($row_RecordForum['name'], @$_GET['searchkey'], $HighlightSelect);?></a>
              <?php } else if($row_RecordForum['type1'] != '-1') { ?>
              <a href="<?php echo $SiteBaseUrl . url_rewrite('forum',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordForum['id']; ?>"><?php echo highLight($row_RecordForum['name'], @$_GET['searchkey'], $HighlightSelect);?></a>
              <?php } else { ?>
              <a href="<?php echo $SiteBaseUrl . url_rewrite('forum',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordForum['id']; ?>"><?php echo highLight($row_RecordForum['name'], @$_GET['searchkey'], $HighlightSelect);?></a>
              <?php } ?>
              </td>
              <td align="center" valign="top"><?php echo $row_RecordForum['visit']; ?>/<?php echo $row_RecordForum['replycount']; ?></td>
              <td valign="top"><span style="font-size:9px;"><?php echo $row_RecordForum['author']; ?></span><br />
<span style="color:#999; font-size:9px;"><?php echo highLight(date('Y-m-d',strtotime($row_RecordForum['postdate'])), @$_GET['searchkey'], $HighlightSelect); ?></span></td>
              </tr>
           <?php 
		   $startRow_RecordForum++;
		   #
		   # ============== [/tr color change] ============== #
		   ?>
      <?php 
      #
      # ============== [/while] ============== #
      } while ($row_RecordForum = mysqli_fetch_assoc($RecordForum)); 
      ?>
      <?php } ?>
                </table>
                
                
                
                <div style="height:10px;"></div>
                    <?php if($totalPages_RecordAbout > 1) { ?>
 				    <div class="col-md-7 col-xs-12">
                        <div style="text-align:center;">
                        <?php //if ($page > 0) { // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordAbout); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-double-left"></i>
                            <span><?php echo $Lang_First; ?></span>
                            </a>
                        </div>
                        <?php //} // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, max(0, $page-1), $queryString_RecordAbout); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-left"></i>
                            <span><?php echo $Lang_Prev; ?></span>
                            </a> 
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, min($totalPages_RecordAbout, $page+1), $queryString_RecordAbout); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-right"></i>
                            <span><?php echo $Lang_Next; ?></span>
                            </a>
                        </div>
                        <?php //if ($page < $totalPages_RecordAbout) { // Show if not last page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordAbout, $queryString_RecordAbout); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
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
                                    <?php for($i=0; $i<ceil($totalRows_RecordAbout/$maxRows_RecordAbout); $i++) { ?>
                                    <option value="<?php printf("%s?page=%d%s", $currentPage, $i,  $queryString_RecordAbout); ?>" <?php if($_GET['page'] == $i) { ?>selected="selected"<?php } ?>><?php echo $i+1; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-6 col-xs-4">
                            <a href="#" class="btn btn-white" style="width:100%; margin:2px 0px 2px 0px;">
                                <span><?php echo $Lang_Content_Count_Total; ?><?php echo $totalRows_RecordAbout; ?><?php echo $Lang_Content_Count_Lots; ?></span>
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
if ($totalRows_RecordForum == 0) { // Show if recordset empty 
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
<div style="height:10px;"></div>
<div class="columns on-1">
        <div class="container">
            <div class="column">
              <div class="container">
              <span style="float:right;" class="Forum_Type"><a href="<?php echo $SiteBaseUrl . url_rewrite('forum',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'postpage'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordForum['id']; ?>">發新主題</a></span>
                   <span style="float:right;" class="Forum_Type"><a href="<?php echo $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Member']; // 會員中心 ?></a></span>
                   <?php if ((isset($_SESSION['MM_UserGroup_' . $_GET['wshop']]) && in_array($_SESSION['MM_UserGroup_' . $_GET['wshop']], $arr_MM_authorizedUsers))) {?>
                   <span style="float:right; margin-left:2px;" class="Forum_Type"><a href="<?php echo $logoutAction ?>">登出</a></span>
				   <?php } else { ?>
                   <span style="float:right;" class="Forum_Type"><a href="<?php echo $SiteBaseUrl . url_rewrite('forum',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reg'),'',$UrlWriteEnable);?>">註冊</a></span>   
                   <span style="float:right; margin-left:2px;" class="Forum_Type"><a href="<?php echo $SiteBaseUrl . url_rewrite('forum',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'log'),'',$UrlWriteEnable);?>">登入</a></span>
                   <?php } ?>
                <span style="width:100%;">
                <span class="Forum_Type"><a href="<?php echo $SiteBaseUrl . url_rewrite('forum',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>">全部</a></span>
                <?php do { ?>
                <?php if($row_RecordForum['type1'] != '-1' && $row_RecordForum['type2'] != '-1' && $row_RecordForum['type3'] != '-1') { ?>
                <span class="Forum_Type"><a href="<?php echo $SiteBaseUrl . url_rewrite('forum',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage','type1'=>$_GET['type1'],'type2'=>$_GET['type2'],'type3'=>$_GET['type3']),'',$UrlWriteEnable);?><?php echo $key_params; ?><?php echo $row_RecordForumListClass['itemname']; ?>"><?php echo $row_RecordForumListClass['itemname']; ?></a></span>
                <?php } else if($row_RecordForum['type1'] != '-1' && $row_RecordForum['type2'] != '-1') { ?>
                <span class="Forum_Type"><a href="<?php echo $SiteBaseUrl . url_rewrite('forum',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage','type1'=>$_GET['type1'],'type2'=>$_GET['type2']),'',$UrlWriteEnable);?><?php echo $key_params; ?><?php echo $row_RecordForumListClass['itemname']; ?>"><?php echo $row_RecordForumListClass['itemname']; ?></a></span>
                <?php } else if($row_RecordForum['type1'] != '-1') { ?>
                <span class="Forum_Type"><a href="<?php echo $SiteBaseUrl . url_rewrite('forum',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage','type1'=>$_GET['type1']),'',$UrlWriteEnable);?><?php echo $key_params; ?><?php echo $row_RecordForumListClass['itemname']; ?>"><?php echo $row_RecordForumListClass['itemname']; ?></a></span>
                <?php } else { ?>
                <span class="Forum_Type"><a href="<?php echo $SiteBaseUrl . url_rewrite('forum',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?><?php echo $key_params; ?><?php echo $row_RecordForumListClass['itemname']; ?>"><?php echo $row_RecordForumListClass['itemname']; ?></a></span>
                <?php } ?>
                <?php } while ($row_RecordForumListClass = mysqli_fetch_assoc($RecordForumListClass)); ?>
                </span>
                </div>
            </div>
        </div>        
</div>
<div style="height:10px;"></div>
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
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Forum']; // 標題文字 ?>  →  新增</strong> 來建立新資料<?php } ?></td>
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
