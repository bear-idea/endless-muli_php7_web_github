<style type="text/css">
.ct_board_product_title{padding:5px;color:#FFF;background-color:#333;margin:5px 0 0}
.swpboard{text-align:right;padding:5px}
.product_outer_board tr td{margin:0;padding:0}
div .product_inner_board{margin:1px}
.product_inner_board_relative{position:relative}
.product_inner_board_relative_buttom{position:relative}
div .product_inner_board_context{margin-top:5px;text-align:left;overflow:hidden}
div .product_inner_board_context a:hover{font-weight:bolder;text-decoration:none}
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
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Product']; // 標題文字 ?></span></h1>
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
if ($totalRows_RecordProduct > 0) { // Show if recordset not empty 
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
  
  
<ul class="list-inline row nomargin">
<?php $i=$startRow_RecordProduct + 1; // 取得頁面第一項商品之編號 ?>
<?php 
	if ($TmpProductViewColumn == '4') {
		$column_num = "3";
	}else if ($TmpProductViewColumn == '3'){
		$column_num = "4";
	}else if ($TmpProductViewColumn == '2'){
		$column_num = "6";
	}else if ($TmpProductViewColumn == '1'){
		$column_num = "6";
	}else{
		$column_num = "4";
	}
 ?>
      <?php $m_count=1; ?>
          <?php do { ?>
          <?php $row_RecordCartlist['discountid'] = $row_RecordProduct['discountid']; /* 取得折價活動狀態id */ ?>
          <?php require("require_cart_discount_show.php"); /* 取得折價活動狀態 */ ?>
          
								<li class="col-md-<?php echo $column_num; ?> col-sm-6 col-xs-6">
                                <div class="photoFrame_<?php echo $TmpProductBoard; ?>">
                                <div class='<?php echo $TmpProductBoardIcon; ?> hidden-xs'></div>
                                    <!--<form id="form1" name="form1" method="post" action="<?php echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'addpage'),'',$UrlWriteEnable);?>">-->
									<div class="shop-item margin-bottom-10">                                     
                                    <div class="imgLiquid" data-fill="<?php echo $TmpProductImageMethods; /* resize or crop */ ?>" data-board="<?php echo $TmpProductImageBoard; /* 方型 or 矩形 */ ?>">
                                        <!-- product more info -->
											<div class="shop-item-info">
                                            
												<?php 
								switch($row_RecordProduct['plot'])
									{
										case "1":
											echo"<span class=\"label label-success\">Hot</span>";			
											break;
										case "2":
											echo"<span class=\"label label-success\">Act</span>";			
											break;
										case "3":
											echo"<span class=\"label label-success\">Sale</span>";			
											break;
										case "4":
											echo"<span class=\"label label-success\">New</span>";			
											break;				
									}
							?>
											</div>
											<!-- /product more info -->
											<!-- product image(s) -->
											<?php // 判斷商品所在之層級
												if($row_RecordProduct['type1'] != '-1' && $row_RecordProduct['type2'] != '-1' && $row_RecordProduct['type3'] != '-1') { $level='2'; }
												else if($row_RecordProduct['type1'] != '-1' && $row_RecordProduct['type2'] != '-1' && $row_RecordProduct['type3'] == '-1') { $level='1'; }
												else if($row_RecordProduct['type1'] != '-1' && $row_RecordProduct['type2'] == '-1' && $row_RecordProduct['type3'] == '-1') { $level='0'; }
												else { $level=''; }
												?>
											  <?php if ($level == '2') { ?>          
												  <?php if ($row_RecordProduct['pic'] != "") { ?> 
												  <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1'],'type2'=>$row_RecordProduct['type2'],'type3'=>$row_RecordProduct['type3']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>" title="<?php echo $row_RecordProduct['name']; ?>" ><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/product/thumb/small_<?php echo GetFileThumbExtend($row_RecordProduct['pic']); ?>" alt="<?php echo $row_RecordProduct['sdescription']; ?>"/></a>
												  <?php } else { ?>      
												  <a><img src="<?php echo $SiteBaseUrl; ?>images/100x100_noimage.jpg" width="100" height="100"/></a>
												  <?php } ?>
											  <?php } else if ($level == '1') { ?>
												  <?php if ($row_RecordProduct['pic'] != "") { ?> 
												  <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1'],'type2'=>$row_RecordProduct['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>" title="<?php echo $row_RecordProduct['name']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/product/thumb/small_<?php echo GetFileThumbExtend($row_RecordProduct['pic']); ?>" alt="<?php echo $row_RecordProduct['sdescription']; ?>"/></a>
												  <?php } else { ?>      
												  <a><img src="<?php echo $SiteBaseUrl; ?>images/100x100_noimage.jpg" width="100" height="100"/></a>

												  <?php } ?>
											  <?php } else if ($level == '0') { ?>
												  <?php if ($row_RecordProduct['pic'] != "") { ?> 
												  <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>" title="<?php echo $row_RecordProduct['name']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/product/thumb/small_<?php echo GetFileThumbExtend($row_RecordProduct['pic']); ?>" alt="<?php echo $row_RecordProduct['sdescription']; ?>"/></a>
												  <?php } else { ?>      
												  <a><img src="<?php echo $SiteBaseUrl; ?>images/100x100_noimage.jpg" width="100" height="100"/></a>
												  <?php } ?>
											  <?php } else { ?>
												  <?php if ($row_RecordProduct['pic'] != "") { ?> 
												  <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>" title="<?php echo $row_RecordProduct['name']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/product/thumb/small_<?php echo GetFileThumbExtend($row_RecordProduct['pic']); ?>" alt="<?php echo $row_RecordProduct['sdescription']; ?>"/></a>
												  <?php } else { ?>      
												  <a><img src="<?php echo $SiteBaseUrl; ?>images/100x100_noimage.jpg" width="100" height="100"/></a>
												  <?php } ?>
											  <?php } ?>
											<!-- /product image(s) -->
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
										
										<div class="product_inner_board_context">
										<div class="shop-item-summary text-center">
											<h2><?php if ($row_RecordProduct['pdseries'] !='') {  ?><span class="label label-primary"><?php echo  $row_RecordProduct['pdseries'];?></span><br><?php } ?><?php if ($level == '2') { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1'],'type2'=>$row_RecordProduct['type2'],'type3'=>$row_RecordProduct['type3']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } else if ($level == '1') { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1'],'type2'=>$row_RecordProduct['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } else if ($level == '0') { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } else { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } ?></h2>
                            
                          <?php if ($row_RecordProduct['discounttype'] !='' && $row_RecordProduct['price'] !='' && $totalRows_RecordDiscountShow > 0) { /* 判斷是否有折扣活動 */ ?>
                          <span id="Cg_SpPrice" style="color: #FF0000; font-size:20px"><?php echo $Lang_Classify_Context_Currency_units; ?><?php echo doFormatMoney($row_RecordProduct['price']); ?></span>
                          <?php } else { /* 判斷是否有折扣活動 */ ?>
                          <?php if ($row_RecordProduct['spprice'] !='' && $row_RecordProduct['price'] !='' && $OptionCartSelect == '1') { ?>
                          <span id="Cg_SpPrice" style="color: #FF0000; font-size:20px"><?php echo $Lang_Classify_Context_Currency_units; ?><?php echo doFormatMoney($row_RecordProduct['spprice']); ?></span>
                          <span id="Cg_Price" style="color:#000; font-size:12px"><s><?php echo $Lang_Classify_Context_Cart_Orig; // 原價 ?><?php echo $Lang_Classify_Context_Currency_units; ?><?php echo doFormatMoney($row_RecordProduct['price']); ?></s></span>
                          <?php } else if($row_RecordProduct['spprice'] !='' && $OptionCartSelect == '1') { ?>
                          <span id="Cg_SpPrice" style="color: #FF0000; font-size:20px"><?php echo $Lang_Classify_Context_Currency_units; ?><?php echo doFormatMoney($row_RecordProduct['spprice']); ?></span>
                          <?php } else if($row_RecordProduct['price'] !='' && $OptionCartSelect == '1') { ?>
                          <span id="Cg_SpPrice" style="color: #FF0000; font-size:20px"><?php echo $Lang_Classify_Context_Currency_units; ?><?php echo doFormatMoney($row_RecordProduct['price']); ?></span>
                          <?php } ?>
                          <?php } /* \判斷是否有折扣活動 */ ?>
                          <div style="height:5px;"></div>
                          
									  
											
										</div><!--\shop-item-summary text-center-->

                                      </div><!-- \product_inner_board_context -->
									</div>
                                    <input name="id<?php echo $row_RecordProduct['id']; ?>" type="hidden" id="id<?php echo $row_RecordProduct['id']; ?>" value="<?php echo $row_RecordProduct['id']; ?>" />
                                    <input name="pdseries<?php echo $row_RecordProduct['id']; ?>" type="hidden" id="pdseries<?php echo $row_RecordProduct['id']; ?>" value="<?php echo $row_RecordProduct['pdseries']; ?>" />
                                    <input name="name<?php echo $row_RecordProduct['id']; ?>" type="hidden" id="name<?php echo $row_RecordProduct['id']; ?>" value="<?php echo $row_RecordProduct['name']; ?>" />
                                    <input name="price<?php echo $row_RecordProduct['id']; ?>" type="hidden" id="price<?php echo $row_RecordProduct['id']; ?>" value="<?php echo $row_RecordProduct['price']; ?>" />
                                    <input name="spprice<?php echo $row_RecordProduct['id']; ?>" type="hidden" id="spprice<?php echo $row_RecordProduct['id']; ?>" value="<?php echo $row_RecordProduct['spprice']; ?>" />
                                    <input name="pic<?php echo $row_RecordProduct['id']; ?>" type="hidden" id="pic<?php echo $row_RecordProduct['id']; ?>" value="<?php echo $row_RecordProduct['pic']; ?>" />
                                    
                                    
                                    <?php  // 加入購物車 ?>
                                    <?php if ($OptionCartSelect == '1') { // 購物功能 ?>
                                    <?php if($row_RecordProduct['price'] != "" || $row_RecordProduct['spprice'] != "") { ?>
                                    <?php if(($row_RecordProduct['inventorynotsale'] == "1" && $row_RecordProduct['inventory'] <= 0 ) || $row_RecordProduct['pricecheck'] == '0') { ?>
                                    <a href="#" class="btn btn-3d btn-lg" id="Cart_Add" style="width:100%; margin:2px; background-color:<?php echo $row_RecordTmpConfig['tmpcartbuttonbgcolor']; ?>; color:<?php echo $row_RecordTmpConfig['tmpcartbuttonfontcolor']; ?>;"><i class="fa fa-cart-plus" aria-hidden="true"></i> <span class="hidden-xs"><?php echo $Lang_Classify_Context_Mail_Send_Clear; ?></span></a>
                                    <?php } else { ?>
                                    <!--<a href="#" class="btn btn-3d btn-red btn-lg" id="Cart_Add" onclick="ShowCartSelectList(<?php //echo $row_RecordProduct['id']; ?>)" style="width:100%; margin:2px;"><i class="fa fa-cart-plus" aria-hidden="true"></i> <span class="hidden-xs"><?php //echo $Lang_Classify_Context_Mail_Send_Add; ?></span></a>-->
                                    <a href="#" class="btn btn-3d btn-lg" id="Cart_Add" data-toggle="modal" data-target="#myModal<?php echo $row_RecordProduct['id']; ?>" style="width:100%; margin:2px; background-color:<?php echo $row_RecordTmpConfig['tmpcartbuttonbgcolor']; ?>; color:<?php echo $row_RecordTmpConfig['tmpcartbuttonfontcolor']; ?>;"><i class="fa fa-cart-plus" aria-hidden="true"></i> <span class="hidden-xs"><?php echo $Lang_Classify_Context_Mail_Send_Add; ?></span></a>
                                    <?php } ?>
                                    <?php } else { ?>
                                    <a href="#" class="btn btn-3d btn-white btn-lg" id="Cart_Add" style="width:100%; margin:2px;"><span style="color:#CCC"><i class="fa fa-cart-plus" aria-hidden="true"></i> <span class="hidden-xs">暫無販售</span></span></a>
                                    <?php } ?>
                                    <?php  //\ 加入購物車 ?>
                                    <?php } // 購物功能 ?>
                                <!--</form> -->
                                <!--</div>-->
                                </div>
<div id="myModal<?php echo $row_RecordProduct['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-3 col-sm-6 col-xs-6">
                              <div class="nailthumb-container_no" data-method="resize" data-width="150" data-height="100">
                                <?php if ($row_RecordProduct['pic'] != "") { ?>
                                <a><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/product/thumb/small_<?php echo GetFileThumbExtend($row_RecordProduct['pic']); ?>" alt="<?php echo $row_RecordProduct['sdescription']; ?>"/></a>
                                <?php } else { ?>
                                <img src="images/100x100_noimage.jpg" width="100" height="100"/>
                                <?php } ?>
                              </div>
                            </div>
                            <div class="col-md-9 col-sm-6 col-xs-6" style="text-align:left">
                              <div class="model_title"><?php echo $row_RecordProduct['name']; ?></div>
                              <?php if ($row_RecordProduct['discounttype'] !='' && $row_RecordProduct['price'] !='' && $totalRows_RecordDiscountShow > 0) { /* 判斷是否有折扣活動 */ ?>
                              <span id="Cg_SpPrice" style="color: #FF0000; font-size:20px"><?php echo $Lang_Classify_Context_Currency_units; ?><?php echo doFormatMoney($row_RecordProduct['price']); ?></span>
                          <?php } else { /* 判斷是否有折扣活動 */ ?>
                              <?php if ($row_RecordProduct['spprice'] !='' && $row_RecordProduct['price'] !='' && $OptionCartSelect == '1') { ?>
                              <span id="Cg_SpPrice" style="color: #FF0000; font-size:20px"><?php echo $Lang_Classify_Context_Currency_units; ?><?php echo doFormatMoney($row_RecordProduct['spprice']); ?></span> <span id="Cg_Price" style="color:#CCC; font-size:12px"><s><?php echo $Lang_Classify_Context_Cart_Orig; // 原價 ?><?php echo $Lang_Classify_Context_Currency_units; ?><?php echo doFormatMoney($row_RecordProduct['price']); ?></s></span>
                              <?php } else if($row_RecordProduct['spprice'] !='' && $OptionCartSelect == '1') { ?>
                              <span id="Cg_SpPrice" style="color: #FF0000; font-size:20px"><?php echo $Lang_Classify_Context_Currency_units; ?><?php echo doFormatMoney($row_RecordProduct['spprice']); ?></span>
                              <?php } else if($row_RecordProduct['price'] !='' && $OptionCartSelect == '1') { ?>
                              <span id="Cg_SpPrice" style="color: #FF0000; font-size:20px"><?php echo $Lang_Classify_Context_Currency_units; ?><?php echo doFormatMoney($row_RecordProduct['price']); ?></span>
                              <?php } ?>
                              <?php } /* \判斷是否有折扣活動 */ ?>
                            </div>
                          </div>
                </div>
			</div>

			<!-- Modal Body -->
            <?php // 規格判斷 ?>
			<?php 
				$colname_RecordProductFormat = $row_RecordProduct['id'];
				if (isset($row_RecordProduct['id'])) {
				  $colname_RecordProductFormat = $row_RecordProduct['id'];
				}
				//mysqli_select_db($database_DB_Conn, $DB_Conn);
				$query_RecordProductFormat = sprintf("SELECT * FROM demo_productformat WHERE aid = %s ORDER BY sortid ASC, pid DESC", GetSQLValueString($colname_RecordProductFormat, "text"));
				$RecordProductFormat = mysqli_query($DB_Conn, $query_RecordProductFormat) or die(mysqli_error($DB_Conn));
				$row_RecordProductFormat = mysqli_fetch_assoc($RecordProductFormat);
				$totalRows_RecordProductFormat = mysqli_num_rows($RecordProductFormat);
			?>
            <?php if($totalRows_RecordProductFormat > 0) { ?>
			<div class="modal-body">
            <div class="row">
                
                <?php $ic=0; $fmtpid=""; ?>
  
                <div id="text-radio">
                        <?php do { ?>
                        <div><?php echo $row_RecordProductFormat['formatname']; ?></div>
                        <?php
						$arr_format = explode(';', $row_RecordProductFormat['formatselect']);
						for($i = 0; $i < count($arr_format); $i++){ 
						?>
                        <input class="text-nicelabel" data-nicelabel='{"position_class": "text_radio", "checked_text": "<?php echo $arr_format[$i]; ?>", "unchecked_text": "<?php echo $arr_format[$i]; ?>"}' checked type="radio" name="formatselect<?php echo $row_RecordProductFormat['pid']; ?>" value="<?php echo $arr_format[$i]; ?>"/>	
                        <?php
						}
						?>
                        <div style="clear:both;"></div>
                        <?php $fmtpid.=$row_RecordProductFormat['pid'].";"; // 取得pid?>
                        <?php } while ($row_RecordProductFormat = mysqli_fetch_assoc($RecordProductFormat)); ?>
                </div>

			</div>
            </div>
            <?php } ?>
            <?php // \規格判斷 ?>

			<!-- Modal Footer -->
			<div class="modal-footer">
				<div class="row">
                    <div class="col-md-5 col-sm-5 col-xs-12">
                    <div class="row" style="line-height:50px; vertical-align:middle">
                    <div class="col-md-3 col-sm-3 col-xs-12" style="text-align:left">
                    <?php echo $Lang_Classify_Context_Num_Product; //數量 ?>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                    <input class="touchspin" type="text" value="1" id="quantity<?php echo $row_RecordProduct['id']; ?>" style="margin-top:5px;">
                    <?php if($row_RecordProduct['inventoryshow'] == "1" && $row_RecordProduct['inventory'] != "") { ?>(<?php echo $Lang_Classify_Context_Cart_instock; //庫存: ?><?php echo $row_RecordProduct['inventory']; ?>) <?php } ?>
                
                    <?php if ($row_RecordProduct['inventoryshow'] == "1" && $row_RecordProduct['inventory'] != "" && $row_RecordProduct['inventory'] <= 50) {$invcount = $row_RecordProduct['inventory'];}else{$invcount=50;}?>
                    <script>
                    $("#quantity<?php echo $row_RecordProduct['id']; ?>").TouchSpin({
                        min: 1,
                        max: <?php echo $invcount ?>,
                        stepinterval: 50
                        /*maxboostedstep: 10000000,
                        prefix: '$' */
                    });
                    </script>
                    </div>
                    </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-7">
                    <a href="#" class="btn btn-3d btn-amber btn-lg" id="Cart_Add" onclick="AddtoCart('<?php echo $row_RecordProduct['id']; ?>','<?php if(isset($fmtpid)) { echo $fmtpid; } ?>','0')" style="width:100%;"><?php echo $Lang_Classify_Context_Mail_Send_Add; ?></a>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-5">
                     <?php
                            if (($CartRegSelect =='1' && $totalRows_RecordMember > 0) || $CartRegSelect =='0') { /* 網站需要會原註冊且已登入狀態 */
                                $gotoshowcart = 1; /* 結帳是否跳轉到結帳葉面 */
                            } else {
                                $gotoshowcart = 0;
                            }
                    ?>
                    <a href="#" class="btn btn-3d btn-red btn-lg" onclick="AddtoCart('<?php echo $row_RecordProduct['id']; ?>','<?php if(isset($fmtpid)) { echo $fmtpid; } ?>','<?php echo $gotoshowcart; ?>')" style="width:100%;"><?php echo $Lang_Classify_Context_Mail_Send_Pay; ?></a>
                    </div>
                </div> <!--\row-->
			</div>

		</div>
	</div>
</div>
								</li>
                                <?php $i++; ?>
          <?php $m_count++; ?>
          <?php } while ($row_RecordProduct = mysqli_fetch_assoc($RecordProduct)); ?>
	</ul>
                  <div style="height:10px;"></div>
                    <?php if($totalPages_RecordProduct > 0) { ?>
 				    <div class="col-md-7 col-xs-12">
                        <div style="text-align:center;">
                        <?php //if ($page > 0) { // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordProduct); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-double-left"></i>
                            <span><?php echo $Lang_First; ?></span>
                            </a>
                        </div>
                        <?php //} // Show if not first page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, max(0, $page-1), $queryString_RecordProduct); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-left"></i>
                            <span><?php echo $Lang_Prev; ?></span>
                            </a> 
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, min($totalPages_RecordProduct, $page+1), $queryString_RecordProduct); ?>" class="btn  btn-reveal btn-white" style="width:100%; margin:2px;">
                            <i class="fa fa-angle-right"></i>
                            <span><?php echo $Lang_Next; ?></span>
                            </a>
                        </div>
                        <?php //if ($page < $totalPages_RecordProduct) { // Show if not last page ?>
                        <div class="col-md-3 col-xs-12">
                            <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordProduct, $queryString_RecordProduct); ?>" class="btn btn-reveal btn-white" style="width:100%; margin:2px;">
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
                                    <?php for($i=0; $i<ceil($totalRows_RecordProduct/$maxRows_RecordProduct); $i++) { ?>
                                    <option value="<?php printf("%s?page=%d%s", $currentPage, $i,  $queryString_RecordProduct); ?>" <?php if($_GET['page'] == $i) { ?>selected="selected"<?php } ?>><?php echo $i+1; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-6 col-xs-4">
                            <a href="#" class="btn btn-white" style="width:100%; margin:2px 0px 2px 0px;">
                                <span><?php echo $Lang_Content_Count_Total; ?><?php echo $totalRows_RecordProduct; ?><?php echo $Lang_Content_Count_Lots; ?></span>
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
if ($totalRows_RecordProduct == 0) { // Show if recordset empty 
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
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Product']; // 標題文字 ?>  →  新增</strong> 來建立該項目<?php } ?></td>
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
    $('.product_inner_board_context').jcolumn({
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
	
	<?php if (isset($totalRows_RecordProducSptFormat) && $totalRows_RecordProducSptFormat > 0) { ?>
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