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
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Careers']; // 標題文字 ?></span></h1>
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
if ($totalRows_RecordCareers > 0) { // Show if recordset not empty 
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
<?php include('app/typemenu/typemenu_tp.php');?>
<?php } ?>

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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="5" align="right"></td>
  </tr>
  <tr>
    <td align="right"><?php //if ($CareersSearchSelect == "1") { ?>
      <form id="form_Careers" name="form_Careers" method="get" action="<?php echo $editFormAction; ?>">
          <!--<input name="Opt" type="hidden" id="Opt" value="viewpage" />
          <input name="lang" type="hidden" id="lang" value="<?php //echo $_GET['lang']; ?>" />
          <input name="wshop" type="hidden" id="wshop" value="<?php //echo $_GET['wshop']; ?>" />-->
          <img src="<?php echo $SiteBaseUrl; ?>images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
    
          <select name="area" id="area">
            <option value="%"><?php echo $Lang_ListArea_Select_Careers; //-- 選擇區域 -- ?></option>
            <?php
do {  
?>
            <option value="<?php echo $row_RecordCareersListArea['itemname']?>"><?php echo $row_RecordCareersListArea['itemname']?></option>
            <?php
} while ($row_RecordCareersListArea = mysqli_fetch_assoc($RecordCareersListArea));
  $rows = mysqli_num_rows($RecordCareersListArea);
  if($rows > 0) {
      mysqli_data_seek($RecordCareersListArea, 0);
	  $row_RecordCareersListArea = mysqli_fetch_assoc($RecordCareersListArea);
  }
?>
          </select>
          
          <select name="type" id="type">
            <option value="%" selected="selected"><?php echo $Lang_ListType_Select_Careers; //-- 選擇類別 -- ?></option>
            <?php
do {  
?>
            <option value="<?php echo $row_RecordCareersListType['itemname']?>"><?php echo $row_RecordCareersListType['itemname']?></option>
            <?php
} while ($row_RecordCareersListType = mysqli_fetch_assoc($RecordCareersListType));
  $rows = mysqli_num_rows($RecordCareersListType);
  if($rows > 0) {
      mysqli_data_seek($RecordCareersListType, 0);
	  $row_RecordCareersListType = mysqli_fetch_assoc($RecordCareersListType);
  }
?>
          </select>
          
          <select name="author" id="author">
            <option value="%" selected="selected"><?php echo $Lang_ListAuthor_Select_Careers; //-- 選擇發佈單位 -- ?></option>
            <?php
do {  
?>
            <option value="<?php echo $row_RecordCareersListAuthor['itemname']?>"><?php echo $row_RecordCareersListAuthor['itemname']?></option>
            <?php
} while ($row_RecordCareersListAuthor = mysqli_fetch_assoc($RecordCareersListAuthor));
  $rows = mysqli_num_rows($RecordCareersListAuthor);
  if($rows > 0) {
      mysqli_data_seek($RecordCareersListAuthor, 0);
	  $row_RecordCareersListAuthor = mysqli_fetch_assoc($RecordCareersListAuthor);
  }
?>
        </select>
          <!--<input type="text" name="searchkey" id="searchkey" />-->
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search; ?>" />
      </form>
      <?php //} ?>  </td>
  </tr>
</table>

<?php
#
# ============== [/rs date] ============== #
?> 
                   <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
      <!--
      <tr>
        <td width="20" align="center" valign="top"></td>
        <td align="left" valign="top"><?php echo $Lang_Classify_Context_Title_Careers; // 標題 ?> </td>
        <td width="158" valign="top"><?php echo $Lang_Classify_Context_Date_Careers; // 日期 ?></td>
      </tr>
      -->
      
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
          if(($startRow_RecordCareers)%2 == 0){
              $chahgecolorcount=$oddtr;
          }else{
              $chahgecolorcount=$eventr;
          }
          ?>
           <tr class= "<?php echo $chahgecolorcount; ?>">       
              <td width="20" align="center" valign="top"><img src="<?php echo $TplImagePath; ?>/sicon/icon_newslist.gif" width="18" height="18" /></td>
              <td align="left" valign="top">
              <?php if($row_RecordCareers['area'] != "") { ?><span class="TipTypeStyle">[<?php echo $row_RecordCareers['area']; ?>]</span> <?php } ?>
              <?php if($row_RecordCareers['type'] != "") { ?><span class="TipTypeStyle">[<?php echo $row_RecordCareers['type']; ?>]</span> <?php } ?>
              <a href="<?php echo $SiteBaseUrl . url_rewrite("careers",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordCareers['id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordCareers['title']; ?></a>
              </td>
              <td width="120" align="left" valign="top" class="hidden-xs"><?php echo $row_RecordCareers['author']; ?></td>
              <td width="120" align="center" valign="top" class="hidden-xs">
              <?php echo highLight(date('Y-m-d',strtotime($row_RecordCareers['postdate'])), @$_GET['searchkey'], $HighlightSelect); ?>
              </td> 
            </tr>
           <?php 
		   $startRow_RecordCareers++;
		   #
		   # ============== [/tr color change] ============== #
		   ?>
      <?php 
      #
      # ============== [/while] ============== #
      } while ($row_RecordCareers = mysqli_fetch_assoc($RecordCareers)); 
      ?>
       
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
if ($totalRows_RecordCareers == 0) { // Show if recordset empty 
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="5" align="right"></td>
  </tr>
  <tr>
    <td align="right"><?php //if ($CareersSearchSelect == "1") { ?>
      <form id="form_Careers" name="form_Careers" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <!--<input name="Opt" type="hidden" id="Opt" value="viewpage" />
          <input name="lang" type="hidden" id="lang" value="<?php //echo $_GET['lang']; ?>" />
          <input name="wshop" type="hidden" id="wshop" value="<?php //echo $_GET['wshop']; ?>" />-->
          <img src="<?php echo $SiteBaseUrl; ?>images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <select name="area" id="area">
            <option value="%"><?php echo $Lang_ListArea_Select_Careers; //-- 選擇區域 -- ?></option>
            <?php
do {  
?>
            <option value="<?php echo $row_RecordCareersListArea['itemname']?>"><?php echo $row_RecordCareersListArea['itemname']?></option>
            <?php
} while ($row_RecordCareersListArea = mysqli_fetch_assoc($RecordCareersListArea));
  $rows = mysqli_num_rows($RecordCareersListArea);
  if($rows > 0) {
      mysqli_data_seek($RecordCareersListArea, 0);
	  $row_RecordCareersListArea = mysqli_fetch_assoc($RecordCareersListArea);
  }
?>
          </select>
          <select name="type" id="type">
            <option value="%" selected="selected"><?php echo $Lang_ListType_Select_Careers; //-- 選擇類別 -- ?></option>
            <?php
do {  
?>
            <option value="<?php echo $row_RecordCareersListType['itemname']?>"><?php echo $row_RecordCareersListType['itemname']?></option>
            <?php
} while ($row_RecordCareersListType = mysqli_fetch_assoc($RecordCareersListType));
  $rows = mysqli_num_rows($RecordCareersListType);
  if($rows > 0) {
      mysqli_data_seek($RecordCareersListType, 0);
	  $row_RecordCareersListType = mysqli_fetch_assoc($RecordCareersListType);
  }
?>
          </select>
          <select name="author" id="author">
            <option value="%" selected="selected"><?php echo $Lang_ListAuthor_Select_Careers; //-- 選擇發佈單位 -- ?></option>
            <?php
do {  
?>
            <option value="<?php echo $row_RecordCareersListAuthor['itemname']?>"><?php echo $row_RecordCareersListAuthor['itemname']?></option>
            <?php
} while ($row_RecordCareersListAuthor = mysqli_fetch_assoc($RecordCareersListAuthor));
  $rows = mysqli_num_rows($RecordCareersListAuthor);
  if($rows > 0) {
      mysqli_data_seek($RecordCareersListAuthor, 0);
	  $row_RecordCareersListAuthor = mysqli_fetch_assoc($RecordCareersListAuthor);
  }
?>
          </select>
          <!--<input type="text" name="searchkey" id="searchkey" />-->
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search; ?>" />
        </label>
      </form>
      <?php //} ?>  </td>
  </tr>
</table>
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
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Careers']; // 標題文字 ?>  →  新增</strong> 來建立新資料<?php } ?></td>
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