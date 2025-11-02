<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&key=<?php echo $GoogleMapAPICode; ?>"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.tinyMap-2.4.4.min.js"></script>
<style type="text/css">

div .stronghold_inner_board{margin:5px}
div .photoFram_Block_glossy,.div_table-cell{overflow:hidden;height:150px;width:150px}
.stronghold_inner_board_relative{position:relative}
.stronghold_inner_board_relative_buttom{position:relative}
div .stronghold_inner_board_context{text-align:left}
.Googlemap_label{font-size:12px;background:rgba(22,22,22,0.6);color:#fff;padding:.25em}
.MapBtn,.MapBtn input,.MapBtn input:hover,.MapBtn input:active{padding:0;border:none}
.stronghold_outer_board { width:<?php echo floor(floor(((1170/12)*9)/6)+40); ?>px; float:left;}
.nailthumb-container{overflow:hidden; border:0px solid #EEE; margin:auto; height: <?php echo floor(floor(((1170/12)*9)/6)); ?>px; width:<?php echo floor(floor(((1170/12)*9)/6)); ?>px}

@media (max-width: 500px){
	.stronghold_outer_board { float:none;}
}
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
          <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Stronghold']; // 標題文字 ?></span></h1>
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
if ($totalRows_RecordStronghold > 0) { // Show if recordset not empty 
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
   <script type="text/javascript">
		  <?php $i=1;?>
			  $(function () {
				  $('#GoogleMap').tinyMap({
					  center: '<?php if($Strongholdcenter == '') {echo $row_RecordStrongholdMap['addrx'] . ',' . $row_RecordStrongholdMap['addry'];} else { echo $Strongholdcenter;} ?>',
					  scaleControl: false,
					  zoom: <?php echo $Strongholdzoom; ?>,
					  marker: [
					  <?php do { ?> 
						  {addr: '<?php echo $row_RecordStrongholdMap['addrx']; ?>,<?php echo $row_RecordStrongholdMap['addry']; ?>', text: '<?php echo $row_RecordStrongholdMap['sdescription']; ?>', label: '<?php echo $row_RecordStrongholdMap['name']; ?>', css: 'Googlemap_label'}<?php if ($totalRows_RecordStrongholdMap > $i) {echo ',';} ?><?php $i++; ?>
				      <?php } while ($row_RecordStrongholdMap = mysqli_fetch_assoc($RecordStrongholdMap)); ?>
					  ]
				  });
			  });
			  </script>
              <a name="Top"></a>
              <div data-scroll-reveal="enter top">
			  <div id="GoogleMap" class="map" style="width:100%; height:350px; float:right; margin-top:5px;"></div>
              </div>
  
  
  
  
  
  
  <?php $i=$startRow_RecordStronghold + 1; // 取得頁面第一項商品之編號 ?>
          <?php do { ?> 
          
                        
               
 
                  
                    <h3 class="margin-top-10"><?php echo $row_RecordStronghold['name']; ?></h3>
                    
                    <?php $Lang_Classify_Context_Addr_Stronghold; //地址：?><?php echo $row_RecordStronghold['addr']; ?><a href="#Top" title="<?php echo $Lang_Classify_Context_SeeMap_Stronghold; ?>" id="top" rel="tipsy" class="MapBtn"><input type="image" name="pencil" src="<?php echo $SiteBaseUrl ?>images/map-icon1.png" id="panto<?php echo $row_RecordStronghold['id']; ?>"/></a>
                    <?php if ($row_RecordStronghold['phone1'] != '') {?>
                    <br />
                    <?php echo $Lang_Classify_Context_Phone_Stronghold; //電話： ?><?php echo $row_RecordStronghold['phone1']; ?><?php if ($row_RecordStronghold['phone2'] != '') { echo '/'; } ?> <?php echo $row_RecordStronghold['phone2']; ?>
                    <?php } ?>
                    <?php if ($row_RecordStronghold['fax'] != '') {?>
                    <br />
                    <?php echo $Lang_Classify_Context_Fax_Stronghold; //傳真： ?><?php echo $row_RecordStronghold['fax']; ?>
                    <?php } ?>
                    <?php if ($row_RecordStronghold['skype'] != '') {?>
                    <br />
                    Skype：<?php echo $row_RecordStronghold['skype']; ?>
                    <?php } ?>
                    <?php if ($row_RecordStronghold['mail'] != '') {?>
                    <br />
                    <?php echo $Lang_Classify_Context_Mail_Stronghold; //信箱： ?><?php echo $row_RecordStronghold['mail']; ?>
                    <?php } ?>
                    <?php if ($row_RecordStronghold['link'] != '') {?>
                    <br />
                    <?php echo $Lang_Classify_Context_Url_Stronghold; //網址： ?><?php echo $row_RecordStronghold['link']; ?>
                    <?php } ?>
                    <?php if ($row_RecordStronghold['supplement'] != '') {?>
                    <br />
                    <?php $Lang_Classify_Context_Supplement_Stronghold; //補充：?><?php echo $row_RecordStronghold['supplement']; ?>
                    <?php } ?>
                    <?php if ($row_RecordStronghold['openinghours'] != '') {?>
                    <br />
                    <?php echo $Lang_Classify_Context_Openinghours_Stronghold; //營業時間： ?><?php echo $row_RecordStronghold['openinghours']; ?>
                    <?php } ?>
                    

                    
                 
             
          <?php $i++; ?>
          <script type="text/javascript">
			//Javascript
			$(document)
						.on('click', 'a[data-url=anchor]', function (e) {
						e.preventDefault();
						$('html,body').animate({
							scrollTop: ($(this.hash).offset().top - 50)
						}, 'slow');
					})
					.on('click', '#panto<?php echo $row_RecordStronghold['id']; ?>', function () {
						$('#GoogleMap').tinyMapPanTo('<?php echo $row_RecordStronghold['addrx']; ?>,<?php echo $row_RecordStronghold['addry']; ?>');
					});
		  </script>
          
          <?php } while ($row_RecordStronghold = mysqli_fetch_assoc($RecordStronghold)); ?>
  
  
  
  
  
  
  
  
  <div style="height:10px;"></div>
                    <?php //if($totalPages_RecordStronghold > 1) { ?>
 				    <div class="col-md-7 col-xs-12">
                        <div style="text-align:center;">
                        <?php //if ($page > 0) { // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordStronghold); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-double-left"></i>
                            <span><?php echo $Lang_First; ?></span>
                            </a>
                        </div>
                        <?php //} // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, max(0, $page-1), $queryString_RecordStronghold); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-left"></i>
                            <span><?php echo $Lang_Prev; ?></span>
                            </a> 
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, min($totalPages_RecordStronghold, $page+1), $queryString_RecordStronghold); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-right"></i>
                            <span><?php echo $Lang_Next; ?></span>
                            </a>
                        </div>
                        <?php //if ($page < $totalPages_RecordStronghold) { // Show if not last page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordStronghold, $queryString_RecordStronghold); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
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
                                    <?php for($i=0; $i<ceil($totalRows_RecordStronghold/$maxRows_RecordStronghold); $i++) { ?>
                                    <option value="<?php printf("%s?page=%d%s", $currentPage, $i,  $queryString_RecordStronghold); ?>" <?php if($_GET['page'] == $i) { ?>selected="selected"<?php } ?>><?php echo $i+1; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-6 col-xs-4">
                            <a href="#" class="btn btn-white" style="width:100%; margin:2px 0px 2px 0px;">
                                <span><?php echo $Lang_Content_Count_Total; ?><?php echo $totalRows_RecordStronghold; ?><?php echo $Lang_Content_Count_Lots; ?></span>
                            </a>
                            </div>
                        </div>
                    </div>
                    
                    <?php //} ?>
                    
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
if ($totalRows_RecordStronghold == 0) { // Show if recordset empty 
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
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Stronghold']; // 標題文字 ?>  →  新增</strong> 來建立新資料<?php } ?></td>
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
