<?php
/*********************************************************************
 # 主頁面最新訊息
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

                <div class="ct_title">
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Catalog']; // 標題文字 ?></span></h1>
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
if ($totalRows_RecordCatalog > 0) { // Show if recordset not empty 
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

                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
                  <!--
                  <tr>
                    <td width="20" align="center" valign="top"></td>
                    <td align="left" valign="top"><?php echo $Lang_Classify_Context_Title_Catalog; // 標題 ?> </td>
                    <td width="158" valign="top"><?php echo $Lang_Classify_Context_Date_Catalog; // 日期 ?></td>
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
                      $oddtr="TR_Odd_Color_Style";
                      $eventr="TR_Even_Color_Style";
                      if(($startRow_RecordCatalog)%2 == 0){
                          $chahgecolorcount=$oddtr;
                      }else{
                          $chahgecolorcount=$eventr;
                      }
                      ?>
                      <?php if($row_RecordCatalog['menutype'] == "file" || $row_RecordCatalog['menutype'] == "link") { ?>
                       <tr class= "<?php echo $chahgecolorcount; ?>">       
                         <td width="20" align="center" valign="middle"><img src="<?php echo $TplImagePath; ?>/sicon/icon_newslist.gif" alt="icon" width="18" height="18" /></td>
                         <td valign="middle" style="line-height:35px">
                          <?php 
                          #
                          # ============== [if] ============== #
                          #
                          # 判斷是否顯示分類項目
                          if($row_RecordCatalog['type'] != "") { 
                          ?>
                          <span class="TipTypeStyle">[<?php echo $row_RecordCatalog['type']; ?>]</span> 
                          <?php 
                          } 
                          # 
                          # ============== [/if] ============== #
                          ?>
                          <?php echo $row_RecordCatalog['title']; ?> <?php echo "(" . ShowBytes(@filesize("site/" . $_GET['wshop'] . "/image/catalog/" . $row_RecordCatalog['pic'])) . ")" ?></td>
                         <td width="50" align="center" valign="middle" style="line-height:35px">
						 <?php if ($row_RecordCatalog['auth'] == '0' || $_SESSION['MM_UserGroup_' . $_GET['wshop']] == 'Wshop_Dealer' || (isset($_SESSION['MM_UserGroup_' . $_GET['wshop']]) && in_array($_SESSION['MM_UserGroup_' . $_GET['wshop']], $arr_MM_authorizedUsers))) { ?>
						 <?php if ($row_RecordCatalog['pic'] != "") { ?>
                           <?php
                                    switch(GetFileExtend($row_RecordCatalog['pic']))
                                    {
                                        case ".pdf":
                                            echo "<a href=\"" . $SiteBaseUrl . url_rewrite("download",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'ty'=>'catalog'),'',$UrlWriteEnable) . $file_params . $row_RecordCatalog['pic']. "" . "\"><img src=\"". $SiteBaseUrl . "images/sicon/cat_01.png\" alt=\"ADOBE PDF\"/></a>\n";
                                            break;
                                        case ".xlsx":
                                            echo "<a href=\"" . $SiteBaseUrl . url_rewrite("download",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'ty'=>'catalog'),'',$UrlWriteEnable) . $file_params . $row_RecordCatalog['pic']. "" . "\"><img src=\"". $SiteBaseUrl . "images/sicon/cat_02.png\" alt=\"EXCEL\"/></a>\n";			
                                            break;
                                        case ".xls":
                                            echo "<a href=\"" . $SiteBaseUrl . url_rewrite("download",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'ty'=>'catalog'),'',$UrlWriteEnable) . $file_params . $row_RecordCatalog['pic']. "" . "\"><img src=\"". $SiteBaseUrl . "images/sicon/cat_02.png\" alt=\"EXCEL\"/></a>\n";			
                                            break;
                                        case ".doc":
                                            echo "<a href=\"" . $SiteBaseUrl . url_rewrite("download",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'ty'=>'catalog'),'',$UrlWriteEnable) . $file_params . $row_RecordCatalog['pic']. "" . "\"><img src=\"". $SiteBaseUrl . "images/sicon/cat_03.png\" alt=\"WORD\"/></a>\n";			
                                            break;
                                        case ".docx":
                                            echo "<a href=\"" . $SiteBaseUrl . url_rewrite("download",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'ty'=>'catalog'),'',$UrlWriteEnable) . $file_params . $row_RecordCatalog['pic']. "" . "\"><img src=\"". $SiteBaseUrl . "images/sicon/cat_03.png\" alt=\"WORD\"/></a>\n";			
                                            break;
                                        case ".rar":
                                            echo "<a href=\"" . $SiteBaseUrl . url_rewrite("download",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'ty'=>'catalog'),'',$UrlWriteEnable) . $file_params . $row_RecordCatalog['pic']. "" . "\"><img src=\"". $SiteBaseUrl . "images/sicon/cat_04.png\" alt=\"ZIP\"/></a>\n";			
                                            break;
                                        case ".zip":
                                            echo "<a href=\"" . $SiteBaseUrl . url_rewrite("download",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'ty'=>'catalog'),'',$UrlWriteEnable) . $file_params . $row_RecordCatalog['pic']. "" . "\"><img src=\"". $SiteBaseUrl . "images/sicon/cat_04.png\" alt=\"ZIP\"/></a>\n";	
                                            break;
                                        case ".avi":
                                            echo "<a href=\"" . $SiteBaseUrl . url_rewrite("download",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'ty'=>'catalog'),'',$UrlWriteEnable) . $file_params . $row_RecordCatalog['pic']. "" . "\"><img src=\"". $SiteBaseUrl . "images/sicon/cat_07.png\" alt=\"VIDEO\"/></a>\n";	
                                            break;
                                        case ".ppt":
                                            echo "<a href=\"" . $SiteBaseUrl . url_rewrite("download",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'ty'=>'catalog'),'',$UrlWriteEnable) . $file_params . $row_RecordCatalog['pic']. "" . "\"><img src=\"". $SiteBaseUrl . "images/sicon/cat_08.png\" alt=\"POWERPOINT\"/></a>\n";			
                                            break;
                                        case ".pptx":
                                            echo "<a href=\"" . $SiteBaseUrl . url_rewrite("download",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'ty'=>'catalog'),'',$UrlWriteEnable) . $file_params . $row_RecordCatalog['pic']. "" . "\"><img src=\"". $SiteBaseUrl . "images/sicon/cat_08.png\" alt=\"POWERPOINT\"/></a>\n";			
                                            break;
                                        case ".jpg":
                                            echo "<a href=\"" . $SiteBaseUrl . url_rewrite("download",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'ty'=>'catalog'),'',$UrlWriteEnable) . $file_params . $row_RecordCatalog['pic']. "" . "\"><img src=\"". $SiteBaseUrl . "images/sicon/cat_05.png\" alt=\"IMAGE\"/></a>\n";			
                                            break;
                                        case ".gif":
                                            echo "<a href=\"" . $SiteBaseUrl . url_rewrite("download",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'ty'=>'catalog'),'',$UrlWriteEnable) . $file_params . $row_RecordCatalog['pic']. "" . "\"><img src=\"". $SiteBaseUrl . "images/sicon/cat_05.png\" alt=\"IMAGE\"/></a>\n";			
                                            break;
                                        case ".png":
                                            echo "<a href=\"" . $SiteBaseUrl . url_rewrite("download",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'ty'=>'catalog'),'',$UrlWriteEnable) . $file_params . $row_RecordCatalog['pic']. "" . "\"><img src=\"". $SiteBaseUrl . "images/sicon/cat_05.png\" alt=\"IMAGE\"/></a>\n";			
                                            break;
                                        case ".bmp":
                                            echo "<a href=\"" . $SiteBaseUrl . url_rewrite("download",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'ty'=>'catalog'),'',$UrlWriteEnable) . $file_params . $row_RecordCatalog['pic']. "" . "\"><img src=\"". $SiteBaseUrl . "images/sicon/cat_05.png\" alt=\"IMAGE\"/></a>\n";
                                            break;
                                        case ".jpeg":
                                            echo "<a href=\"" . $SiteBaseUrl . url_rewrite("download",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'ty'=>'catalog'),'',$UrlWriteEnable) . $file_params . $row_RecordCatalog['pic']. "" . "\"><img src=\"". $SiteBaseUrl . "images/sicon/cat_05.png\" alt=\"IMAGE\"/></a>\n";	
                                            break;	
                                        default:
                                            echo "<a href=\"" . $SiteBaseUrl . url_rewrite("download",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'ty'=>'catalog'),'',$UrlWriteEnable) . $file_params . $row_RecordCatalog['pic']. "" . "\"><img src=\"". $SiteBaseUrl . "images/sicon/cat_06.png\" alt=\"UNKNOWN\"/>\n";
                                            break;
                                    }
                                ?>
                           <?php } else { ?>
							   <?php if ($row_RecordCatalog['link'] != "") {?>
							   <a href="<?php echo $row_RecordCatalog['link'] ?>" target="_blank"><img src="images/sicon/cat_link.png" width="35" height="35" /></a>
							   <?php } else { ?>
							   <img src="<?php echo $SiteBaseUrl; ?>images/sicon/cat_09.png" width="35" height="35" />
							   <?php } ?>
                           
                         <?php }  ?>
                         <?php } else { ?>
                           <a href="#" title="<?php echo $Lang_Classify_Context_Auth; ?>" rel="tipsy"><img src="<?php echo $SiteBaseUrl; ?>images/sicon/cat_lock.png" width="35" height="35" /></a>
                         <?php } ?>
                         </td>
                          <td width="150" align="center" valign="middle" class="hidden-xs">
                          <?php echo highLight(date('Y-m-d',strtotime($row_RecordCatalog['postdate'])), @$_GET['searchkey'], $HighlightSelect); ?>
                          </td> 
                  </tr>
                       <?php } else if($row_RecordCatalog['menutype'] == "page") { ?>
                       <tr class= "<?php echo $chahgecolorcount; ?>">       
                         <td width="20" align="center" valign="middle"><img src="<?php echo $TplImagePath; ?>/sicon/icon_newslist.gif" alt="icon" width="18" height="18" /></td>
                         <td valign="middle" style="line-height:35px">
                          <?php 
                          #
                          # ============== [if] ============== #
                          #
                          # 判斷是否顯示分類項目
                          if($row_RecordCatalog['type'] != "") { 
                          ?>
                          <span class="TipTypeStyle">[<?php echo $row_RecordCatalog['type']; ?>]</span> 
                          <?php 
                          } 
                          # 
                          # ============== [/if] ============== #
                          ?>
                          <?php if ($row_RecordCatalog['auth'] == '0' || $_SESSION['MM_UserGroup_' . $_GET['wshop']] == 'Wshop_Dealer' || (isset($_SESSION['MM_UserGroup_' . $_GET['wshop']]) && in_array($_SESSION['MM_UserGroup_' . $_GET['wshop']], $arr_MM_authorizedUsers))) { ?>
                          <a href="<?php echo $SiteBaseUrl . url_rewrite("catalog",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordCatalog['id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordCatalog['title']; ?></a>
                          <?php } else { ?>
                          <?php echo $row_RecordCatalog['title']; ?>
                          <?php }  ?>
                          </td>
                         <td width="50" align="center" valign="middle" style="line-height:35px"><?php if ($row_RecordCatalog['auth'] == '0' || $_SESSION['MM_UserGroup_' . $_GET['wshop']] == 'Wshop_Dealer') { ?><?php } else { ?><a href="#" title="<?php echo $Lang_Classify_Context_Auth; ?>" rel="tipsy"><img src="<?php echo $SiteBaseUrl; ?>images/sicon/cat_lock.png" width="35" height="35" /></a><?php } ?></td>
                          <td width="150" align="center" valign="middle" class="hidden-xs">
                          <?php echo highLight(date('Y-m-d',strtotime($row_RecordCatalog['postdate'])), @$_GET['searchkey'], $HighlightSelect); ?>
                          </td> 
                  </tr>
                       <?php } ?>
                       <?php 
                       $startRow_RecordCatalog++;
                       #
                       # ============== [/tr color change] ============== #
                       ?>
                  <?php 
                  #
                  # ============== [/while] ============== #
                  } while ($row_RecordCatalog = mysqli_fetch_assoc($RecordCatalog)); 
                  ?>
                </table>  
                
                
                <div style="height:10px;"></div>
                    <?php if($totalPages_RecordCatalog > 0) { ?>
 				    <div class="col-md-7 col-xs-12">
                        <div style="text-align:center;">
                        <?php //if ($page > 0) { // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordCatalog); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-double-left"></i>
                            <span><?php echo $Lang_First; ?></span>
                            </a>
                        </div>
                        <?php //} // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, max(0, $page-1), $queryString_RecordCatalog); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-left"></i>
                            <span><?php echo $Lang_Prev; ?></span>
                            </a> 
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, min($totalPages_RecordCatalog, $page+1), $queryString_RecordCatalog); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-right"></i>
                            <span><?php echo $Lang_Next; ?></span>
                            </a>
                        </div>
                        <?php //if ($page < $totalPages_RecordCatalog) { // Show if not last page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordCatalog, $queryString_RecordCatalog); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
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
                                    <?php for($i=0; $i<ceil($totalRows_RecordCatalog/$maxRows_RecordCatalog); $i++) { ?>
                                    <option value="<?php printf("%s?page=%d%s", $currentPage, $i,  $queryString_RecordCatalog); ?>" <?php if($_GET['page'] == $i) { ?>selected="selected"<?php } ?>><?php echo $i+1; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-6 col-xs-4">
                            <a href="#" class="btn btn-white" style="width:100%; margin:2px 0px 2px 0px;">
                                <span><?php echo $Lang_Content_Count_Total; ?><?php echo $totalRows_RecordCatalog; ?><?php echo $Lang_Content_Count_Lots; ?></span>
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
if ($totalRows_RecordCatalog == 0) { // Show if recordset empty 
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
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Catalog']; // 標題文字 ?>  →  新增</strong> 來建立新資料<?php } ?></td>
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