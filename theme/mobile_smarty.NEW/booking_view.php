<style type="text/css">
.ct_board_service_title{padding:5px;color:#FFF;background-color:#333;margin:5px 0 0}
.swpboard{text-align:right;padding:5px}
.service_outer_board tr td{margin:0;padding:0}
div .service_inner_board{margin:1px}
.service_inner_board_relative{position:relative}
.service_inner_board_relative_buttom{position:relative}
div .service_inner_board_context{margin-top:5px;text-align:left;overflow:hidden}
div .service_inner_board_context a:hover{font-weight:bolder;text-decoration:none}
a:hover.switch_4block,a:hover.switch_3block,a:hover.switch_2block,a:hover.switch_list{filter:alpha(opacity=75);opacity:.5;-ms-filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=75)}
.nailthumb-container{overflow:hidden; border:1px solid #EEE; margin:auto;}
.text_radio{float:left;margin:5px;}
.shop-item-info{position:absolute;}
</style>
<?php
/*********************************************************************
 # 主頁面產品資訊
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
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName_Service; // 標題文字 ?></span></h1>
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
if ($totalRows_RecordService > 0) { // Show if recordset not empty 
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
 
<ul class="list-inline row nomargin">
<?php $i=$startRow_RecordService + 1; // 取得頁面第一項商品之編號 ?>
      <?php $m_count=1; ?>
          <?php do { ?>
          <?php //$row_RecordCartlist['discountid'] = $row_RecordService['discountid']; /* 取得折價活動狀態id */ ?>
          <?php //require("require_cart_discount_show.php"); /* 取得折價活動狀態 */ ?>
          
								<li class="col-md-4 col-sm-6 col-xs-6">
                                <div class="photoFrame_<?php echo $TmpServiceBoard; ?>">
                                <div class='<?php echo $TmpServiceBoardIcon; ?> hidden-xs'></div>
                                    <!--<form id="form1" name="form1" method="post" action="<?php echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'addpage'),'',$UrlWriteEnable);?>">-->
									<div class="shop-item margin-bottom-10">                                     
                                    <div class="imgLiquid" data-fill="resize" data-board="<?php echo $TmpServiceImageBoard; /* 方型 or 矩形 */ ?>">
                                        <!-- service more info -->
											<!-- /service more info -->
											<!-- service image(s) -->
						
												  <?php if ($row_RecordService['pic'] != "") { ?> 
												  <a href="<?php echo $SiteBaseUrl . url_rewrite("booking",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordService['id']; ?>" title="<?php echo $row_RecordService['name']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/service/thumb/small_<?php echo GetFileThumbExtend($row_RecordService['pic']); ?>" alt="<?php echo $row_RecordService['sdescription']; ?>"/></a>
												  <?php } else { ?>      
												  <a><img src="<?php echo $SiteBaseUrl; ?>images/100x100_noimage.jpg" width="100" height="100"/></a>
												  <?php } ?>
											<!-- /service image(s) -->
                                            <!--nailthumb-container-->
                                            
											
                                            <?php 
											// <!-- hover buttons -->
											/*<div class="shop-option-over"><!-- replace data-item-id width the real item ID - used by js/view/demo.shop.js -->
												<a class="btn btn-default add-wishlist" href="#" data-item-id="1" data-toggle="tooltip" title="Add To Wishlist"><i class="fa fa-heart nopadding"></i></a>
												<a class="btn btn-default add-compare" href="#" data-item-id="2" data-toggle="tooltip" title="Add To Compare"><i class="fa fa-bar-chart-o nopadding" data-toggle="tooltip"></i></a>
											</div>*/
											?>


											

											<?php
											// 倒數計時顯示
											/*<div class="shop-item-counter">
												<div class="countdown" data-from="January 12, 2018 12:34:55" data-labels="years,months,weeks,days,hour,min,sec"><!-- Example Date From: December 31, 2018 15:03:26 --></div>
											</div>*/
											 ?>
                                      </div> 
										
										<div class="service_inner_board_context">
										<div class="shop-item-summary text-center">
											<h2>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("service",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordService['id']; ?>"><span style="color:<?php echo $TmpServiceBoardFontColor; ?>"><?php echo $row_RecordService['name']; ?></span></a>
                           </h2>
                            
                          
                          <?php if($row_RecordService['price'] !='') { ?>
                          <span id="Cg_SpPrice" style="color: #FF0000; font-size:20px"><?php echo $Lang_Classify_Context_Currency_units; ?><?php echo doFormatMoney($row_RecordService['price']); ?></span>
                          <?php } ?>
                          <div style="height:5px;"></div>
                          
									  
											
										</div><!--\shop-item-summary text-center-->

                                      </div><!-- \service_inner_board_context -->
									</div>
                                    <input name="id<?php echo $row_RecordService['id']; ?>" type="hidden" id="id<?php echo $row_RecordService['id']; ?>" value="<?php echo $row_RecordService['id']; ?>" />
                                    <input name="pdseries<?php echo $row_RecordService['id']; ?>" type="hidden" id="pdseries<?php echo $row_RecordService['id']; ?>" value="<?php echo $row_RecordService['pdseries']; ?>" />
                                    <input name="name<?php echo $row_RecordService['id']; ?>" type="hidden" id="name<?php echo $row_RecordService['id']; ?>" value="<?php echo $row_RecordService['name']; ?>" />
                                    <input name="price<?php echo $row_RecordService['id']; ?>" type="hidden" id="price<?php echo $row_RecordService['id']; ?>" value="<?php echo $row_RecordService['price']; ?>" />
                                    <input name="spprice<?php echo $row_RecordService['id']; ?>" type="hidden" id="spprice<?php echo $row_RecordService['id']; ?>" value="<?php echo $row_RecordService['spprice']; ?>" />
                                    <input name="pic<?php echo $row_RecordService['id']; ?>" type="hidden" id="pic<?php echo $row_RecordService['id']; ?>" value="<?php echo $row_RecordService['pic']; ?>" />
                                    
                                    
                                   
                                    <?php //} // 購物功能 ?>
                                <!--</form> -->
                                <!--</div>-->
                                </div>
					</li>
                                <?php $i++; ?>
          <?php $m_count++; ?>
          <?php } while ($row_RecordService = mysqli_fetch_assoc($RecordService)); ?>
	</ul>
                  <div style="height:10px;"></div>
                    <?php if($totalPages_RecordService > 0) { ?>
 				    <div class="col-md-7 col-xs-12">
                        <div style="text-align:center;">
                        <?php //if ($page > 0) { // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordService); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-double-left"></i>
                            <span><?php echo $Lang_First; ?></span>
                            </a>
                        </div>
                        <?php //} // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, max(0, $page-1), $queryString_RecordService); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-left"></i>
                            <span><?php echo $Lang_Prev; ?></span>
                            </a> 
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, min($totalPages_RecordService, $page+1), $queryString_RecordService); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-right"></i>
                            <span><?php echo $Lang_Next; ?></span>
                            </a>
                        </div>
                        <?php //if ($page < $totalPages_RecordService) { // Show if not last page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordService, $queryString_RecordService); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
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
                                    <?php for($i=0; $i<ceil($totalRows_RecordService/$maxRows_RecordService); $i++) { ?>
                                    <option value="<?php printf("%s?page=%d%s", $currentPage, $i,  $queryString_RecordService); ?>" <?php if($_GET['page'] == $i) { ?>selected="selected"<?php } ?>><?php echo $i+1; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-6 col-xs-4">
                            <a href="#" class="btn btn-white" style="width:100%; margin:2px 0px 2px 0px;">
                                <span><?php echo $Lang_Content_Count_Total; ?><?php echo $totalRows_RecordService; ?><?php echo $Lang_Content_Count_Lots; ?></span>
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
<div id="jcart"></div>
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
if ($totalRows_RecordService == 0) { // Show if recordset empty 
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
          <td width="189"><?php echo $Lang_Error_NoSearch; //目前尚無資料 ?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName_Service; // 標題文字 ?>  →  新增</strong> 來建立該項目<?php } ?></td>
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
<script type="text/javascript"> 
    $('.service_inner_board_context').jcolumn({
    delay: 500,
    maxWidth: 200, 
	resize:true
	});
</script>
<?php if ($OptionCartSelect == "1") { ?>
<script type="text/javascript">    
function AddtoCart(id, fmt, gotoshowcart) {
	var qu = $('#quantity'+id).val();
	var pr = $('#price'+id).val();
	var prsp = $('#spprice'+id).val();
	var pic = $('#pic'+id).val();
    
	var npr;
	
	if(prsp != "") {npr=prsp}else{npr=pr}
	<?php if ($FBPixelCodeID != "") { ?>
	fbq('track', 'AddToCart', {
		value: npr,
		currency: 'TWD'
	});
	<?php } ?>
	
	var arrfmt = new Array();
	arrfmt = fmt.split(';');
	var fmtend = new Array();
	for(i=0; i<arrfmt.length-1; i++)
	{
		fmtend=fmtend+'&fmt'+i+'='+$('input[name=formatselect'+arrfmt[i]+']:checked').val();
	}
	
	<?php if (isset($totalRows_RecordServiceSptFormat) && $totalRows_RecordServiceSptFormat > 0) { ?>
	var spfmt = $('input[name=spformat]:checked').val();
	var arr = new Array();
	arr = spfmt.split('#');
	<?php } ?>
	
	<?php //if($format_counter) ?>
    $.ajax({ 
        type: "GET",
		data: fmtend,
		url:"<?php echo $SiteBaseUrl ?>ajax/cart_add_mobile.php?" + "id=" + id + "&qu=" + qu + "&pr=" + pr + "&prsp=" + prsp + "&pic=" + pic + fmtend + "&wshop=<?php echo $_GET['wshop']; ?>&time()",
        success: function(data){
			generatetip(data, 'warning');
			<?php 
			// 購物車商品計算
			if(isset($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID']) && count($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID']))
			{
				$Cart_Counter=0;
				foreach($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'] as $i => $val) {$Cart_Counter += $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i];} 
			}else{
				$Cart_Counter = 0;
			}
			?>
			if(gotoshowcart == '1') {
					window.location = '<?php echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'showpage'),'',$UrlWriteEnable);?>';
				}
			if(data == "<?php echo $Lang_Classify_Added_To_Cart; ?>") {
				var bscount = <?php echo $Cart_Counter; ?>;
				qu = parseInt(qu)+parseInt(bscount);
				$("#cart_counter").html(qu);
			}
      }
	});
}
</script>
<?php } ?>
<script>
	$('#text-radio > input').nicelabel({ uselabel: false});
</script>