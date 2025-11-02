<script language="javascript" src="<?php echo $SiteBaseUrl ?>js/tableExport.js"></script>
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
          <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right">物料拆分查詢</span></h1>
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
if ($totalRows_RecordSplitorder > 0 ) { // Show if recordset not empty 
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

<form id="form_Splitorderorder" name="form_Splitorderorder" method="get" action="<?php echo $SiteBaseUrl . url_rewrite('splitorder',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'order'),'',$UrlWriteEnable);?>" >

 
 
 <div class="row">
	<div class="col-md-3">
		<div class="fancy-form">
	<i class="fa fa-calendar"></i>
	<input name="startdate" type="text" class="form-control datepicker" id="postdate" value="" data-format="yyyy-mm-dd" data-from="<?php echo date("Y")?>-01-01" data-to="<?php echo date("Y")?>-12-31" data-lang="zh" data-RTL="false" placeholder="拆分開始日期" autocomplete="off">
    
    

</div>
	</div>
    
    <div class="col-md-3">
		<div class="fancy-form">
	<i class="fa fa-calendar"></i>
	
    <input name="enddate" type="text" class="form-control datepicker" id="postdate" value="" data-format="yyyy-mm-dd" data-from="<?php echo date("Y")?>-01-01" data-to="<?php echo date("Y")?>-12-31" data-lang="zh" data-RTL="false" placeholder="拆分結束日期" autocomplete="off">

</div>
	</div>
    
    

	<div class="col-md-1">
		<button type="submit" class="btn btn-3d btn-teal btn-sm btn-block">
				搜尋
			</button>
	</div>
</div>
	<!-- range picker -->
	 

                <input name="Opt" type="hidden" id="Opt" value="order" />
                <input name="sk" type="hidden" id="sk" value="search" />
                <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                <input name="wshop" type="hidden" id="wshop" value="<?php echo $_GET['wshop']; ?>" />
                
                
                
              
          </form>
            
            
<?php //if ($TmpTypeMenuBtnIndicate == "1") { // 分類標籤 ?>
<?php if($_GET['sk'] == "search") { ?>
<div class="panel panel-danger">
<div class="panel-body">
搜尋 <?php if($_GET['startdate'] != "") {echo "拆分開始日期：".$_GET['startdate'];} ?> <?php if($_GET['enddate'] != "") {echo "拆分結束日期：".$_GET['enddate'];} ?>
</div>
</div>
<?php } ?>


<div class="panel panel-danger">
    <div class="panel-heading">
        <h2 class="panel-title"><i class="fa fa-mail-forward"></i> 匯出本頁搜尋結果</h2>
    </div>
    <div class="panel-body">
        <div class="col-md-4 col-xs-6">
		<a class="btn btn-block btn-social btn-adn" onClick="return tableExport('TBSort', '物料拆分', 'xls');" >
        <i class="fa fa-file-excel-o"></i> Excel
        </a>
	</div>

	<div class="col-md-4 col-xs-6">
		<a class="btn btn-block btn-social btn-adn" onClick="return tableExport('TBSort', '物料拆分', 'doc');">
        <i class="fa fa-file-word-o"></i> Word
        </a>
	</div>

	

    </div>
</div>

   
<div class="table-responsive">
      <table class="table table-bordered table-striped" id="TBSort">
      <thead>
              <tr>
                      <th align="center" valign="middle">&nbsp;</th>
                      <th width="100" valign="top">拆分單號</th>
                      <th width="100" valign="top">拆分日期</th>
                      <th width="70" valign="top">預估天數</th>
                      <th width="100" valign="top">車號</th>
                      <th width="100" valign="top">總重量</th>
                      <th width="100">完工日期</th>
              </tr>
      </thead>
      <tbody>
      <?php if ($totalRows_RecordSplitorder > 0) { // Show if recordset not empty ?>
      <?php
      #
      # ============== [do] ============== #
	  #
      # 重複印出所有資料
      do { 
      ?>
                    <tr class= "<?php echo $chahgecolorcount; ?>">
                      <td width="20" align="center" valign="middle"><img src="<?php echo $TplImagePath; ?>/sicon/icon_newslist.gif" alt="icon" style="max-width:none"/></td>
                      <td valign="top"><a href="splitorder_orders_see.php?Serial=<?php echo $row_RecordSplitorder['oserial']; ?>" target="_blank"><?php echo $row_RecordSplitorder['oserial']; ?></a></td>
                      <td valign="top"><?php echo $row_RecordSplitorder['startdate']; ?></td>
                      <td valign="top"><?php echo $row_RecordSplitorder['Estimatedday']; ?></td>
                      <td valign="top"><?php echo $row_RecordSplitorder['carnumber']; ?></td>
                      <td valign="top"><?php echo $row_RecordSplitorder['bigweight']; ?></td>
                      <td valign="top"><?php echo $row_RecordSplitorder['enddate']; ?></td>
                      </tr>

		    <?php 
			$NowTotalweight += $row_RecordSplitorder['bigweight'];
			//echo $row_RecordSplitorder['Totalweight']; 
			
			?>
                    <?php 
      #
      # ============== [/while] ============== #
      } while ($row_RecordSplitorder = mysqli_fetch_assoc($RecordSplitorder)); 
      ?>
      <?php } ?>
      </tbody>
              <tfoot>
	          <tr>
                      <td align="center" valign="middle"></td>
					  <td></td>
					  <td></td>
                      <td></td>
                      <td>&nbsp;</td>
                      <td><?php echo "總重:".$NowTotalweight ?></td>
                      <td>&nbsp;</td>
              </tr>
              </tfoot>
                  </table>
</div>
                  
                  <div style="height:10px;"></div>
                    <?php if($totalPages_RecordSplitorder > 0) { ?>
 				    <div class="col-md-7 col-xs-12">
                        <div style="text-align:center;">
                        <?php //if ($page > 0) { // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordSplitorder); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-double-left"></i>
                            <span><?php echo $Lang_First; ?></span>
                            </a>
                        </div>
                        <?php //} // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, max(0, $page-1), $queryString_RecordSplitorder); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-left"></i>
                            <span><?php echo $Lang_Prev; ?></span>
                            </a> 
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, min($totalPages_RecordSplitorder, $page+1), $queryString_RecordSplitorder); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-right"></i>
                            <span><?php echo $Lang_Next; ?></span>
                            </a>
                        </div>
                        <?php //if ($page < $totalPages_RecordSplitorder) { // Show if not last page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordSplitorder, $queryString_RecordSplitorder); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
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
                                    <?php for($i=0; $i<ceil($totalRows_RecordSplitorder/$maxRows_RecordSplitorder); $i++) { ?>
                                    <option value="<?php printf("%s?page=%d%s", $currentPage, $i,  $queryString_RecordSplitorder); ?>" <?php if($_GET['page'] == $i) { ?>selected="selected"<?php } ?>><?php echo $i+1; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-6 col-xs-4">
                            <a href="#" class="btn btn-white" style="width:100%; margin:2px 0px 2px 0px;">
                                <span><?php echo $Lang_Content_Count_Total; ?><?php echo $totalRows_RecordSplitorder; ?><?php echo $Lang_Content_Count_Lots; ?></span>
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
if ($totalRows_RecordSplitorder == 0) { // Show if recordset empty 
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

<form id="form_Splitorderorder" name="form_Splitorderorder" method="get" action="<?php echo $SiteBaseUrl . url_rewrite('splitorder',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'order'),'',$UrlWriteEnable);?>">

 
 
 <div class="row">
	<div class="col-md-3">
		<div class="fancy-form">
	<i class="fa fa-calendar"></i>
	<input name="startdate" type="text" class="form-control datepicker" id="postdate" value="" data-format="yyyy-mm-dd" data-from="<?php echo date("Y")?>-01-01" data-to="<?php echo date("Y")?>-12-31" data-lang="zh" data-RTL="false" placeholder="拆分開始日期" autocomplete="off">
    
    

</div>
	</div>
    
    <div class="col-md-3">
		<div class="fancy-form">
	<i class="fa fa-calendar"></i>
	
    <input name="enddate" type="text" class="form-control datepicker" id="postdate" value="" data-format="yyyy-mm-dd" data-from="<?php echo date("Y")?>-01-01" data-to="<?php echo date("Y")?>-12-31" data-lang="zh" data-RTL="false" placeholder="拆分結束日期" autocomplete="off">

</div>
	</div>
 
	<div class="col-md-1">
		<button type="submit" class="btn btn-3d btn-teal btn-sm btn-block">搜尋</button>
	</div>
</div>
	<!-- range picker -->
	 

                <input name="Opt" type="hidden" id="Opt" value="order" />
                <input name="sk" type="hidden" id="sk" value="search" />
                <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                <input name="wshop" type="hidden" id="wshop" value="<?php echo $_GET['wshop']; ?>" />
                
                
                
              
            </form>
            
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><table width="250" border="0" cellspacing="0" cellpadding="0">
      <tr>
          <td width="61"><img src="<?php echo $SiteBaseUrl; ?>images/error_tip.png" width="60" height="60" /></td>
          <td width="189"><?php echo $Lang_Error_NoSearch; //目前尚無資料 ?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName_Splitorder; // 標題文字 ?>  →  新增</strong> 來建立新資料<?php } ?></td>
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

<script>

$(document).ready(function() {
	$(".imgLiquid").imgLiquid();
});

$('.SumoSelect2').SumoSelect({placeholder: '選擇物料', selectAll:true, forceCustomRendering:false});

</script>
