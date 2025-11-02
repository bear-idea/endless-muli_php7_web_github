<script language="javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter; } else { echo $SiteBaseUrl; } ?>js/tableExport.js"></script>
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
          <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right">清運明細查詢</span></h1>
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
if ($totalRows_RecordScale > 0 ) { // Show if recordset not empty 
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

<form id="form_Scaleorder" name="form_Scaleorder" method="post" action="<?php echo $SiteBaseUrl . url_rewrite('scaleclearance',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'order'),'',$UrlWriteEnable);?>" >

 
 
 <div class="row">
	<div class="col-md-2">
		<div class="fancy-form">
	<i class="fa fa-calendar"></i>
	<input name="startdate" type="text" class="form-control datepicker" id="postdate" value="" data-format="yyyy-mm-dd" data-from="<?php echo date("Y")?>-01-01" data-to="<?php echo date("Y")?>-12-31" data-lang="zh" data-RTL="false" placeholder="開始日期" autocomplete="off">
    
    

</div>
	</div>
    
    <div class="col-md-2">
		<div class="fancy-form">
	<i class="fa fa-calendar"></i>
	
    <input name="enddate" type="text" class="form-control datepicker" id="postdate" value="" data-format="yyyy-mm-dd" data-from="<?php echo date("Y")?>-01-01" data-to="<?php echo date("Y")?>-12-31" data-lang="zh" data-RTL="false" placeholder="結束日期" autocomplete="off">

</div>
	</div>
    
    <div class="col-md-7">
    <label for="scale[]"></label>
                    
                    <select name="scale[]" id="scale[]" class="form-control SumoSelect2" multiple="multiple"> 
                    <!--<option value="%">-- 選擇物料 --</option>-->
                    <?php if ($totalRows_RecordDate > 0) { ?>
                      <?php
				do {  
				?>
                      <option value="<?php echo $row_RecordDate['code']?>"><?php echo $row_RecordDate['name']?></option>
                      <?php
				} while ($row_RecordDate = mysqli_fetch_assoc($RecordDate));
				  $rows = mysqli_num_rows($RecordDate);
				  if($rows > 0) {
					  mysqli_data_seek($RecordDate, 0);
					  $row_RecordDate = mysqli_fetch_assoc($RecordDate);
				  }
				?>
                <?php } ?>
                    </select>
                  
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
<?php if($_POST['sk'] == "search") { ?>
<div class="panel panel-danger">
<div class="panel-body">
搜尋 <?php if($_POST['startdate'] != "") {echo "開始日期：".$_POST['startdate'];} ?> <?php if($_POST['enddate'] != "") {echo "結束日期：".$_POST['startdate'];} ?> 物料：
<?php 
if($_POST['scale_bk'] != "") {
foreach ($_POST['scale_bk'] as $value) {
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordScaleGet = sprintf("SELECT * FROM erp_scale WHERE code = %s && userid=%s", GetSQLValueString($value, "text"),GetSQLValueString($_SESSION['userid'], "int"));
	$RecordScaleGet = mysqli_query($DB_Conn, $query_RecordScaleGet) or die(mysqli_error($DB_Conn));
	$row_RecordScaleGet = mysqli_fetch_assoc($RecordScaleGet);
	$totalRows_RecordScaleGet = mysqli_num_rows($RecordScaleGet);
	
	echo $row_RecordScaleGet['name'] ." ";
}
}else{
echo "All";
}
?>
</div>
</div>
<?php } ?>
<?php //require("typemenu_scale.php"); ?>
<?php //} ?>

<?php if ($_SESSION['MM_UserGroup_' . $_GET['wshop']] == 'Wshop_Member_Export') { ?>
<div class="panel panel-danger">
    <div class="panel-heading">
        <h2 class="panel-title"><i class="fa fa-mail-forward"></i> 匯出本頁搜尋結果</h2>
    </div>
    <div class="panel-body">
        <div class="col-md-4 col-xs-6">
		<a class="btn btn-block btn-social btn-adn" onClick="return tableExport('TBSort', '現有庫存', 'xls');" >
        <i class="fa fa-file-excel-o"></i> Excel
        </a>
	</div>

	<div class="col-md-4 col-xs-6">
		<a class="btn btn-block btn-social btn-adn" onClick="return tableExport('TBSort', '現有庫存', 'doc');">
        <i class="fa fa-file-word-o"></i> Word
        </a>
	</div>

	

    </div>
</div>
<?php } ?>
<br />

   
<div class="table-responsive">
      <table class="table table-bordered" id="TBSort">
      <tr class= "<?php echo $chahgecolorcount; ?>">
                      <td align="center" valign="middle">&nbsp;</td>
              <td width="300" valign="top">物料</td>
                      <td width="70" valign="top">總重</td>
                      <td width="70" valign="top">扣重</td>
                      <td width="70" valign="top">淨重</td>
                      
                      <td width="100" valign="top">時間</td>
                      <td width="100" valign="top">連單號碼</td>
                      <td width="100" valign="top">備註</td>
            </tr>
      <?php if ($totalRows_RecordScale > 0) { // Show if recordset not empty ?>
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
		  $oddtr="TR_Scale_Odd_Color_Style";
          $eventr="TR_Scale_Even_Color_Style";
          if(($startRow_RecordScale)%2 == 0){
              $chahgecolorcount=$oddtr;
          }else{
              $chahgecolorcount=$eventr;
          }
          ?>
                    <tr class= "<?php echo $chahgecolorcount; ?>">
                      <td width="20" align="center" valign="middle"><img src="<?php echo $TplImagePath; ?>/sicon/icon_newslist.gif" alt="icon" style="max-width:none"/></td>
                      <td valign="top">
                        <?php echo $row_RecordScale['title']; ?>
                        <?php if($row_RecordScale['pic1'] != "" || $row_RecordScale['pic2']) { ?>
                        <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target=".bs-example-modal-lg<?php echo $row_RecordScale['id']; ?>" style=" float:right"><i class="fa fa-file-image-o"> 圖片</i></button>
<div class="modal fade bs-example-modal-lg<?php echo $row_RecordScale['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- header modal -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myLargeModalLabel">Picture</h4>
			</div>

			<!-- body modal -->
			<div class="modal-body">
				<div>
                <img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/scaleorder/<?php echo $row_RecordScale['pic1']; ?>" style="width:100%" />
                </div>
                <div>
                <img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/scaleorder/<?php echo $row_RecordScale['pic2']; ?>" style="width:100%"/>
                </div>
			</div>

		</div>
	</div>
</div>
<?php } ?>

</td>
                      <td valign="top"><?php echo $row_RecordScale['Totalweight']; ?></td>
                      <td valign="top"><?php echo $row_RecordScale['Minweight']; ?></td>
                      <td valign="top"><?php if($row_RecordScale['Oriweight'] == "" || ($row_RecordScale['Totalweight'] > 0 && $row_RecordScale['Oriweight'] == "0")) {echo $row_RecordScale['Totalweight']-$row_RecordScale['Minweight'];}else{echo $row_RecordScale['Oriweight'];} ?></td>
                      
                      <td width="100" valign="top"><?php echo highLight(date('Y-m-d H:i',strtotime($row_RecordScale['postdate'])), @$_GET['searchkey'], $HighlightSelect); ?></td>
                      <td valign="top"><?php echo $row_RecordScale['snumber']; ?></td>
                      <td valign="top"><?php echo $row_RecordScale['notes1']; ?></td>
                      </tr>
                      
                    
                    <?php 
		   $startRow_RecordScale++;
		   #
		   # ============== [/tr color change] ============== #
		   ?>
		    <?php 
			$NowTotalweight += $row_RecordScale['Totalweight'];
			$NowOriweight += ($row_RecordScale['Totalweight']-$row_RecordScale['Minweight']);
			
			$AllTotalweight += $row_RecordScale['Totalweight'];
			$AllOriweight += ($row_RecordScale['Totalweight']-$row_RecordScale['Minweight']);
			//echo $row_RecordScale['Totalweight']; 
			
			?>
                    <?php 
      #
      # ============== [/while] ============== #
      } while ($row_RecordScale = mysqli_fetch_assoc($RecordScale)); 
      ?>
      <?php } ?>
	  <tr>
                      <td align="center" valign="middle"></td>
					  
					  <td></td>
              <td><?php echo "總重:".$NowTotalweight ?></td>
                      <td>&nbsp;</td>
                      <td><?php echo "總淨重:".$NowOriweight ?></td>
                      <td>&nbsp;</td>
                      <td></td>
                      
            </tr>
                  </table>
</div>
                  
                  <div style="height:10px;"></div>
                    <?php if($totalPages_RecordScale > 0) { ?>
 				    <div class="col-md-7 col-xs-12">
                        <div style="text-align:center;">
                        <?php //if ($page > 0) { // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordScale); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-double-left"></i>
                            <span><?php echo $Lang_First; ?></span>
                            </a>
                        </div>
                        <?php //} // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, max(0, $page-1), $queryString_RecordScale); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-left"></i>
                            <span><?php echo $Lang_Prev; ?></span>
                            </a> 
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, min($totalPages_RecordScale, $page+1), $queryString_RecordScale); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-right"></i>
                            <span><?php echo $Lang_Next; ?></span>
                            </a>
                        </div>
                        <?php //if ($page < $totalPages_RecordScale) { // Show if not last page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordScale, $queryString_RecordScale); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
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
                                    <?php for($i=0; $i<ceil($totalRows_RecordScale/$maxRows_RecordScale); $i++) { ?>
                                    <option value="<?php printf("%s?page=%d%s", $currentPage, $i,  $queryString_RecordScale); ?>" <?php if($_GET['page'] == $i) { ?>selected="selected"<?php } ?>><?php echo $i+1; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-6 col-xs-4">
                            <a href="#" class="btn btn-white" style="width:100%; margin:2px 0px 2px 0px;">
                                <span><?php echo $Lang_Content_Count_Total; ?><?php echo $totalRows_RecordScale; ?><?php echo $Lang_Content_Count_Lots; ?></span>
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
if ($totalRows_RecordScale == 0) { // Show if recordset empty 
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

<form id="form_Scaleorder" name="form_Scaleorder" method="post" action="<?php echo $editFormAction; ?>">

 
 
 <div class="row">
	<div class="col-md-2">
		<div class="fancy-form">
	<i class="fa fa-calendar"></i>
	<input name="startdate" type="text" class="form-control datepicker" id="postdate" value="" data-format="yyyy-mm-dd" data-from="<?php echo date("Y")?>-01-01" data-to="<?php echo date("Y")?>-12-31" data-lang="zh" data-RTL="false" placeholder="開始日期" autocomplete="off">
    
    

</div>
	</div>
    
    <div class="col-md-2">
		<div class="fancy-form">
	<i class="fa fa-calendar"></i>
	
    <input name="enddate" type="text" class="form-control datepicker" id="postdate" value="" data-format="yyyy-mm-dd" data-from="<?php echo date("Y")?>-01-01" data-to="<?php echo date("Y")?>-12-31" data-lang="zh" data-RTL="false" placeholder="結束日期" autocomplete="off">

</div>
	</div>
    
    <div class="col-md-7">
    <label for="scale[]"></label>
                    
                    <select name="scale[]" id="scale[]" class="form-control SumoSelect2" multiple="multiple"> 
                    <!--<option value="%">-- 選擇物料 --</option>-->
                    
                      <?php if ($totalRows_RecordDate > 0) { ?>
					  <?php
				do {  
				?>
                      <option value="<?php echo $row_RecordDate['code']?>"><?php echo $row_RecordDate['name']?></option>
                      <?php
				} while ($row_RecordDate = mysqli_fetch_assoc($RecordDate));
				  $rows = mysqli_num_rows($RecordDate);
				  if($rows > 0) {
					  mysqli_data_seek($RecordDate, 0);
					  $row_RecordDate = mysqli_fetch_assoc($RecordDate);
				  }
				?>
                <?php } ?>
                    </select>
                  
    </div>

	<div class="col-md-1">
		<button type="submit" class="btn btn-3d btn-teal btn-sm btn-block">
				搜尋
			</button>
	</div>
</div>
	<!-- range picker -->
	 

                <input name="Opt" type="hidden" id="Opt" value="scalein" />
                <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                
                
                
              
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
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName_Scale; // 標題文字 ?>  →  新增</strong> 來建立新資料<?php } ?></td>
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
