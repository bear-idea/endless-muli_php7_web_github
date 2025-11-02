<style type="text/css">
.left_ct_board{padding:5px}
.right_ct_board{padding:5px}
div .product_inner_board_detailed{margin:0;padding:2px;background-color:#FFFAF7;border:1px solid #DDD;height:100%}
.product_inner_board_detailed_title{margin:0;padding:5px;background-color:#FEEFD1;background-repeat:repeat;font-weight:700; color:#000}
.Product_Detailed_Right_Board{margin:5px;border:0 solid #DDD}
.Product_Detailed_Right_Board tr td{padding:5px;border-bottom-style:dotted;border-color:#FFD5BF;border-width:1px}
.div_table-cell{overflow:hidden;height:380px;width:380px;margin:0;text-align:center;vertical-align:middle;background-color:#FFF;border:1px solid #DDD}
.div_table-cell span,.div_table-cell_type span{height:100%;display:inline-block;background-image:none;border-style:none}
.div_table-cell *{vertical-align:middle}
div .photoFram_Block_glossy,.div_table-cell_plus{overflow:hidden;height:45px;width:45px;margin:1px}
.div_table-cell_plus{text-align:center;vertical-align:middle;border:1px solid #DDD}
.div_table-cell_plus span{height:100%;display:inline-block;background-image:none;border-style:none}
.div_table-cell_plus *{vertical-align:middle}
.acc_container{}
.acc_trigger{background-image:url(images/la.png);background-repeat:no-repeat;background-position:right center;cursor:pointer}
.acc_trigger:hover{background-color:#FDD788}
.active{background-image:url(images/lb.png);background-repeat:no-repeat;background-position:right center}
.number_g{font-size:1.67em;margin-top:-3px;height:18px;width:32px}
.number_s{font-size:3em;font-weight:700}
.inputcart{padding:5px;border:solid 1px #CCC;outline:0;background:#FFF left top repeat-x;box-shadow:rgba(0,0,0,0.1) 0 0 8px inset;-moz-box-shadow:rgba(0,0,0,0.1) 0 0 8px inset;-webkit-box-shadow:rgba(0,0,0,0.1) 0 0 8px inset;-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px}
.inputcart:hover,inputcart:focus{border-color:#C9C9C9;-webkit-box-shadow:rgba(0,0,0,0.15) 0 0 8px}
.inputcart:disabled{background-color:#EEE}
.submit .inputcart{width:auto;padding:9px 15px;background:#617798;border:0;color:#FFF;-moz-border-radius:5px;-webkit-border-radius:5px}
.InnerButtom{margin-right:2px;margin-top:5px;margin-bottom:5px;}
.InnerButtom a{font-weight:700;border:1px solid #CCC;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;text-shadow:0 1px 1px #fff;-webkit-box-shadow:0 1px 1px #fff;-moz-box-shadow:0 1px 1px #fff;box-shadow:0 1px 1px #fff;font:bold 11px Sans-Serif;padding:4px 8px;white-space:nowrap;vertical-align:middle;color:#666;background:#FFF;cursor:pointer}
.InnerButtom a:hover,.InnerButtom a:focus{font-weight:700;border-color:#999;background:-webkit-linear-gradient(top,white,#E0E0E0);background:-moz-linear-gradient(top,white,#E0E0E0);background:-ms-linear-gradient(top,white,#E0E0E0);background:-o-linear-gradient(top,white,#E0E0E0);-webkit-box-shadow:0 1px 2px rgba(0,0,0,0.25),inset 0 0 3px #fff;-moz-box-shadow:0 1px 2px rgba(0,0,0,0.25),inset 0 0 3px #fff;box-shadow:0 1px 2px rgba(0,0,0,0.25),inset 0 0 3px #fff;color:#333;text-decoration:none}
.InnerButtom a:active{font-weight:700;color:#666;border:1px solid #AAA;border-bottom-color:#CCC;border-top-color:#999;-webkit-box-shadow:inset 0 1px 2px #aaa;-moz-box-shadow:inset 0 1px 2px #aaa;box-shadow:inset 0 1px 2px #aaa;background:-webkit-linear-gradient(top,#E6E6E6,gainsboro);background:-moz-linear-gradient(top,#E6E6E6,gainsboro);background:-ms-linear-gradient(top,#E6E6E6,gainsboro);background:-o-linear-gradient(top,#E6E6E6,gainsboro)}
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
<div class="columns on-1">
        <div class="container">
            <div class="column">
                <div class="container ct_board ct_title">
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Product']; // 標題文字 ?></span></h1>
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
	<!-- 產品詳細頁面上方區塊 -->
    <div class="columns on-3">
        <div class="container board">
            <div class="column span-2 fixed sidebar" style="width:400px; margin-right:0px">
                <div class="container left_ct_board">
                    <!-- 左方圖片區塊 -->
                    <?php // 產品多圖
					$MSProductMutiPic = '1';
					if($MSProductMutiPic == '0')
					{	
					?>
                    <div class="div_table-cell">
						<img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/product/<?php echo $row_RecordProduct['pic']; ?>" alt="<?php echo $row_RecordProduct['sdescription']; ?>" alumb="false" _w="380" _h="380"/><span></span>
                    </div>
					<?php
					}else if ($MSProductMutiPic == '1'){
						require("require_product_detailed_photoalbum.php");
					}
					?>
                    <?php //require("require_product_detailed_photoalbum_myfocus.php"); ?>
                    
      <?php //require("require_fb_like.php"); ?>
                    <!-- 左方圖片區塊 END -->
              </div>
            </div>
            <div class="column elastic content">
            	<!--右方大區塊-->
                <div class="container right_ct_board">
                    <!-- 右方詳細內容區塊 -->
                    <div class="product_inner_board_detailed">
                    <!-- 右方詳細內容區塊標題 -->
                        <div class="product_inner_board_detailed_title acc_trigger">
                            <?php echo $row_RecordProduct['name']; ?>
                      	</div>
                    <!-- 右方詳細內容區塊標題 END -->
                    <div class="acc_container">
                    <table width="99%" border="0" cellspacing="0" cellpadding="0" class="Product_Detailed_Right_Board">
                      <?php if ($row_RecordProduct['pdseries'] !='') { ?>
                          <tr>
                            <td width="70" align="right" valign="top"><?php echo $Lang_Classify_Context_Pdseries_Product //貨號： ?></td>
                            <td><?php echo $row_RecordProduct['pdseries']; ?></td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordProduct['model'] !='') { ?>
                          <tr>
                            <td width="70" align="right" valign="top"><?php echo $Lang_Classify_Context_Model_Product //規格： ?></td>
                            <td align="left"><?php echo $row_RecordProduct['model']; ?></td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordProduct['price'] !='' || $row_RecordProduct['spprice'] !='') { ?>
                          <tr>
                            <td width="70" align="right" valign="top"><?php echo $Lang_Classify_Context_Price_Product //價格： ?></td>
                            <td align="left">
							<?php if ($row_RecordProduct['discounttype'] !='' && $row_RecordProduct['price'] !='' && $totalRows_RecordDiscountShow > 0) { /* 判斷是否有折扣活動 */ ?>
                              <span id="Cg_SpPrice" style="color: #FF0000;"><?php echo $Lang_Classify_Context_Currency_units; ?><?php echo doFormatMoney($row_RecordProduct['price']); ?></span>
                          <?php } else { /* 判斷是否有折扣活動 */ ?>
                            <?php if ($row_RecordProduct['spprice'] !='' && $row_RecordProduct['price'] !='') { ?>
                              <span id="Cg_SpPrice" style="color: #FF0000;"><?php echo $Lang_Classify_Context_Currency_units; ?><?php echo doFormatMoney($row_RecordProduct['spprice']); ?></span>
                              <span id="Cg_Price" style="color:#000; font-size:12px"><s><?php echo $Lang_Classify_Context_Cart_Orig; // 原價 ?><?php echo $Lang_Classify_Context_Currency_units; ?><?php echo doFormatMoney($row_RecordProduct['price']); ?></s></span>
                              <?php } else if($row_RecordProduct['spprice'] !='') { ?>
                              <span id="Cg_SpPrice" style="color: #FF0000;"><?php echo $Lang_Classify_Context_Currency_units; ?><?php echo doFormatMoney($row_RecordProduct['spprice']); ?></span>
                              <?php } else if($row_RecordProduct['price'] !='') { ?>
                              <span id="Cg_SpPrice" style="color: #FF0000;"><?php echo $Lang_Classify_Context_Currency_units; ?><?php echo doFormatMoney($row_RecordProduct['price']); ?></span>
                              <?php } ?>
                          <?php } /* \判斷是否有折扣活動 */ ?>
                          </td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordProduct['sdescription'] !='') { ?>
                          <tr>
                            <td width="70" align="right" valign="top"><?php echo $Lang_Classify_Context_Sdescription_Product //描述： ?></td>
                            <td align="left"><?php echo $row_RecordProduct['sdescription']; ?></td>
                          </tr>
                          <?php } ?>
                      </table>
                      </div>
                  </div>
                  <!-- 右方詳細內容區塊 END --> 
                  <?php require("require_project_mix.php"); ?>       
                  <?php require("require_article_mix.php"); ?> 
                  <?php require("require_catalog_mix.php"); ?>          
                  <?php if ($OptionCartSelect == '1' && $row_RecordProduct['pricecheck'] == '1') { // 購物功能 ?>
                  <?php require("require_product_detailed_format.php"); ?>
                  <?php require("require_product_detailed_spformat.php"); ?>
                  <div style="height:5px;"></div>
                  <!-- 右方購物車區塊 -->
                  <?php if($row_RecordProduct['price'] != "" || $row_RecordProduct['spprice'] != "") { ?>
                  <!--<form id="form1" name="form1" method="post" action="<?php //echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'addpage'),'',$UrlWriteEnable);?>" class="form-item">-->
                  <div class="product_inner_board_detailed">
                  	<table width="99%" border="0" cellspacing="0" cellpadding="0" class="Product_Detailed_Right_Board">
                          <tr>
                            <td width="70" align="right"><?php echo $Lang_Classify_Context_Num_Product //數量： ?></td>
                            <td>
                              <label for="quantity"></label>
                              <select name="quantity" id="quantity">
                              <?php if ($row_RecordProduct['inventoryshow'] == "1" && $row_RecordProduct['inventory'] != "" && $row_RecordProduct['inventory'] <= 50) {$invcount = $row_RecordProduct['inventory'];}else{$invcount=50;}?>
                              <?php for($j=1;$j<=$invcount;$j++) { ?>
                        <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                      <?php } ?>

                            </select>
                            <?php if($row_RecordProduct['inventoryshow'] == "1" && $row_RecordProduct['inventory'] != "") { ?>(庫存:<?php echo $row_RecordProduct['inventory']; ?>) <?php } ?>
                            </td>
                      	  </tr>
                    </table> 
                    <table width="99%" border="0" cellspacing="0" cellpadding="0" class="Product_Detailed_Right_Board">
                          <tr>
                            <td colspan="2" align="center" valign="middle">
                            
                            <input type="image" src="<?php echo $SiteBaseUrl ?>images/<?php if($row_RecordProduct['inventorynotsale'] == "1" && $row_RecordProduct['inventory'] <= 0) { ?>ncartbuy<?php } else { ?>cartbuy<?php } ?>.png"  style="vertical-align:bottom;" id="Cart_Add"/>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'showpage'),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteBaseUrl ?>images/cartsee.png" alt="" width="100" height="33" class="inputcart" style="vertical-align:bottom;"/></a>
                            </td>
                      	  </tr>
                         
                    </table>
                      <input name="id" type="hidden" id="id" value="<?php echo $row_RecordProduct['id']; ?>" />
                      <input name="pdseries" type="hidden" id="pdseries" value="<?php echo $row_RecordProduct['pdseries']; ?>" />
                      <input name="name" type="hidden" id="name" value="<?php echo $row_RecordProduct['name']; ?>" />
                      <?php if ($row_RecordProduct['discounttype'] !='' && $row_RecordProduct['price'] !='' && $totalRows_RecordDiscountShow > 0) { /* 判斷是否有折扣活動 */ ?>
                      <input name="price" type="hidden" id="price" value="<?php echo $row_RecordProduct['price']; ?>" />
                      <input name="spprice" type="hidden" id="spprice" value="" />
                      <?php } else { /* 判斷是否有折扣活動 */ ?>
                      <input name="price" type="hidden" id="price" value="<?php echo $row_RecordProduct['price']; ?>" />
                      <input name="spprice" type="hidden" id="spprice" value="<?php echo $row_RecordProduct['spprice']; ?>" />
                      <?php } /* \判斷是否有折扣活動 */ ?>
                      <input name="wshop" type="hidden" id="wshop" value="<?php echo $_GET['wshop']; ?>" />
                      <input name="pic" type="hidden" id="pic" value="<?php echo $row_RecordProduct['pic']; ?>" />
                  </div>
                  <?php if ($MSProductPlus == '1') { // 加購專區 ?>
				  <?php if ($totalRows_RecordProductPlus > 0) { // Show if recordset not empty ?>
                  <div style="height:5px;"></div>
                  <div class="product_inner_board_detailed">
                    <!-- 右方詳細內容區塊標題 -->
                    <div class="product_inner_board_detailed_title acc_trigger"><?php echo $Lang_Classify_Context_PlusArea_Product //加購專區 ?></div>
                    <!-- 右方詳細內容區塊標題 END -->
                    <div class="acc_container">
                    <table width="99%" border="0" cellspacing="0" cellpadding="0" class="Product_Detailed_Right_Board">
                    <?php $i=0;?>
                          <?php do { ?>
                            <tr>
                              
                                <td width="20" align="center" valign="top"><input type="checkbox" name="pluscheck[]" id="pluscheck[]" /></td>
                                <td width="50">
                                <div class="div_table-cell_plus">
								  <?php if ($row_RecordProductPlus['pluspic'] != "") { ?>	 
                                  <a href="<?php echo $row_RecordProductPlus['pluslink']; ?>" target="_blank"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/productplus/thumb/small_<?php echo GetFileThumbExtend($row_RecordProductPlus['pluspic']); ?>" alt="<?php echo $row_RecordProductPlus['sdescription']; ?>" width="45" alumb="true" _w="45" _h="45"/></a><span></span>
                                  <?php } else { ?>      
                                  <a><img src="images/50x50_noimage.jpg" width="45" height="45"/></a><span></span>
                                  <?php } ?>
                                </div>
                                </td>
                                <td><label for="pluscheck[]"></label>
                                  <label for="plusquantity[]"></label>
                                  <?php echo $Lang_Classify_Context_Add_Product //加 ?>
                                  <font color="#FF0000">$<?php echo $row_RecordProductPlus['plusprice']; ?></font> <?php echo $Lang_Classify_Context_Buy_Product //買 ?> <?php echo $row_RecordProductPlus['plusname']; ?><br />
                              <select name="plusquantity[]" id="plusquantity[]">
                                <?php for($j=1;$j<=50;$j++) { ?>
                                <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                <?php } ?>
                              </select>
                              <input name="plusprice[]" type="hidden" id="plusprice[]" value="<?php echo $row_RecordProductPlus['plusprice']; ?>" />
                              <input name="plusname[]" type="hidden" id="plusname[]" value="<?php echo $row_RecordProductPlus['plusname']; ?>" />
                              <input name="plusid[]" type="hidden" id="plusid[]" value="<?php echo $row_RecordProductPlus['id']; ?>" />
                              <input name="pluspic[]" type="hidden" id="pluspic[]" value="<?php echo $row_RecordProductPlus['pluspic']; ?>" />
                              </td>
                                
                                
                          </tr>
                          <?php $i++; ?>
                            <?php } while ($row_RecordProductPlus = mysqli_fetch_assoc($RecordProductPlus)); ?>
							
                         
                    </table>
                    </div>
                  </div>
				  <?php } // Show if recordset not empty ?>
                  <?php } // 加購專區 END ?>
                  <!--</form>-->
                  <?php } ?>
                  <!-- 右方購物車區塊 END -->
                  <?php } // 購物功能 END ?>
                  <?php if ($MSProductStar == '1') { // 星級評分 ?>
                  <div style="height:5px;"></div>
                  <!-- 右方評分區塊 -->
                  <div class="product_inner_board_detailed">
                    <table width="99%" border="0" cellspacing="0" cellpadding="0" class="Product_Detailed_Right_Board">
                          <tr>
                            <td width="70" align="center" valign="middle">
                            <?php $avgstar=0; // 初始化?>
							<?php do { ?>
							    <?php 
									$avgstartmp = $row_RecordProductRater['starnumber'] * $row_RecordProductRater['starvalue']; 
									$avgstar = $avgstartmp + $avgstar;
								?>
							<?php } while ($row_RecordProductRater = mysqli_fetch_assoc($RecordProductRater)); ?>
							<?php 
								if ($row_RecordProduct['ratercount']!=0) {
									$str = round($avgstar/$row_RecordProduct['ratercount'], 1);
									$res=explode(".",$str);
									//echo $res[0] . $res[1];
								}
							?>
                            <?php 
								if($res[0] == '') {$res[0]=$res[1]=0;}
								if($res[1] == '') {$res[1]=0;}
							?>
                            <span class="number_s"><?php echo $res[0]; ?></span>.<span class="number_g"><?php echo $res[1]; ?></span> 
                            </td>
                            <td>
                              <div id="product_rater"></div>
                                <div style="color:#666666; font-size:11px; text-align: left;">
                                	<?php if ($row_RecordProduct['ratercount']!=0) { ?>
                              <!--平均：<?php echo round($avgstar/$row_RecordProduct['ratercount'], 1); ?>顆星
                                    <br />-->
                                    <?php echo $Lang_Classify_Context_Ratercount_Product //評分人數： ?><?php echo $row_RecordProduct['ratercount']; ?>
                                    <?php } else { ?>
                                    <?php echo $Lang_Classify_Context_NoRatercount_Product //尚未評分 ?>
                                    <?php } ?>
                                    &nbsp;<?php echo $Lang_Classify_Context_Visit_Product //瀏覽次數： ?><?php echo $row_RecordProduct['visit']; ?>
                                </div>
                            </td>
                          </tr>
                    </table>
                  </div>
                  <!-- 右方評分區塊 END -->
                  <?php } // 星級評分 END ?>
                  <span style="float:right; margin-top:10px;"><?php // 連結分享
					$MSProductShare = 1;
					if($MSProductShare != '0')
					{	
						require("require_sharelink.php");
					} 
					?></span>
              </div>
              	<!--右方大區塊 END-->
            </div>
        </div>
	</div>
    <!-- 產品詳細頁面上方區塊 END -->
    <div class="columns on-1">
        <div class="container board">
            <div class="column">
            <?php if($row_RecordProduct['skeyword'] != "" && $row_RecordProduct['skeywordindicate'] == 1) { ?>
                        <div style="border:0px #CCCCCC dotted; padding:5px;" class="keytag">
                        <a>&nbsp;<i class="fa fa-tag"></i>&nbsp;</a><?php
                        $arr_tag = explode(',', $row_RecordProduct['skeyword']);
                        for($i = 0; $i < count($arr_tag); $i++){ echo "<a href=\"".$SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'search'),'',$UrlWriteEnable).$tag_params.$arr_tag[$i] ."\">".$arr_tag[$i]."</a>";}
						
						?>
                        </div>
                        <?php } ?>
            </div>
        </div>
	</div>
  <div class="columns on-1">
        <div class="container board">
            <div class="column">
            
			  <script>
                $(function() {
                    $( "#tabs" ).tabs({
                        //event: "mouseover"
							error: function( xhr, status, index, anchor ) {
					$( anchor.hash ).html(
						"Couldn't load this tab. We'll try to fix this as soon as possible. " +
						"If this wouldn't be a demo." );
				}
			
                    });
                });
                </script>
                <!--Tab-->
                <div id="tabs">
                    <!--<?php if ($row_RecordProductPrev['id'] != '') { ?><?php if($row_RecordProductPrev['type1'] != '-1' && $row_RecordProductPrev['type2'] != '-1' && $row_RecordProductPrev['type3'] != '-1') { $level='2'; }else if($row_RecordProductPrev['type1'] != '-1' && $row_RecordProductPrev['type2'] != '-1' && $row_RecordProductPrev['type3'] == '-1') { $level='1'; }else if($row_RecordProductPrev['type1'] != '-1' && $row_RecordProductPrev['type2'] == '-1' && $row_RecordProductPrev['type3'] == '-1') { $level='0'; }else { $level=''; } ?><span style="float:right; margin-top:12px; margin-right:5px;"><span class="InnerButtom"><a href="product.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=detailed&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;tp=Product&amp;level=<?php echo $level; ?>&amp;type1=<?php echo $row_RecordProductPrev['type1']; ?>&amp;type2=<?php echo $row_RecordProductPrev['type2']; ?>&amp;type3=<?php echo $row_RecordProductPrev['type3']; ?>&amp;subitem_id=<?php echo $_GET['subitem_id']; ?>&amp;id=<?php echo $row_RecordProductPrev['id']; ?>" title="" style="color:#000"><i class="fa fa-arrow-circle-right"></i> <?php echo $Lang_Next; ?></a></span></span><?php } ?><?php if ($row_RecordProductNext['id'] != '') { ?><?php if($row_RecordProductNext['type1'] != '-1' && $row_RecordProductNext['type2'] != '-1' && $row_RecordProductNext['type3'] != '-1') { $level='2'; } else if($row_RecordProductNext['type1'] != '-1' && $row_RecordProductNext['type2'] != '-1' && $row_RecordProductNext['type3'] == '-1') { $level='1'; }else if($row_RecordProductNext['type1'] != '-1' && $row_RecordProductNext['type2'] == '-1' && $row_RecordProductNext['type3'] == '-1') { $level='0'; } else { $level=''; } ?><span style="float:right; margin-top:12px; margin-right:5px;"><span class="InnerButtom"><a href="product.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=detailed&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;tp=Product&amp;level=<?php echo $level; ?>&amp;type1=<?php echo $row_RecordProductNext['type1']; ?>&amp;type2=<?php echo $row_RecordProductNext['type2']; ?>&amp;type3=<?php echo $row_RecordProductNext['type3']; ?>&amp;subitem_id=<?php echo $_GET['subitem_id']; ?>&amp;id=<?php echo $row_RecordProductNext['id']; ?>" title="" style="color:#000"><i class="fa fa-arrow-circle-left"></i> <?php echo $Lang_Prev; ?></a></span></span><?php } ?>-->
                    <ul>
                        <li><a href="#tabs-1" style="color:#000"><?php echo $Lang_Tab_Content_Product //商品說明 ?></a></li>
                        <?php if ($row_RecordProduct['content1'] != '' && $MSProductMutiContent == '1') { ?>
                        <li><a href="#tabs-2" style="color:#000"><?php echo $row_RecordProduct['content1title']; //退換貨服務 ?></a></li>
                        <?php } ?> 
                        <?php if ($row_RecordProduct['content2'] != '' && $MSProductMutiContent == '1') { ?>
                        <li><a href="#tabs-3" style="color:#000"><?php echo $row_RecordProduct['content2title']; //其他注意事項 ?></a></li>
                        <?php } ?>
                        <?php if ($OptionCartSelect == '1' && $OptionMemberSelect == '1') { ?>
                        <li><a href="#tabs-4" style="color:#000"><?php echo $Lang_Tab_FAQ_Product //問答紀錄 ?><span id="Show_QAPost_Count"></span></a></li>
                        <?php } ?>
                    </ul>
                    <div id="tabs-1">
                    	<div class="container left_ct_board"><?php echo pageBreak($row_RecordProduct['content']); ?></div>
                        <div style=" clear:both; display:block"></div> 
                    </div>
                    <?php if ($row_RecordProduct['content1'] != '' && $MSProductMutiContent == '1') { ?>
                    <div id="tabs-2">
                    	<div class="container left_ct_board"><?php echo $row_RecordProduct['content1']; ?></div> 
                        <div style=" clear:both; display:block"></div>
                    </div>
                    <?php } ?>
                    <?php if ($row_RecordProduct['content2'] != '' && $MSProductMutiContent == '1') { ?>
                    <div id="tabs-3">
                    	<div class="container left_ct_board"><?php echo $row_RecordProduct['content2']; ?></div> 
                        <div style=" clear:both; display:block"></div>
                    </div>
                    <?php } ?> 
                    <?php if ($OptionCartSelect == '1' && $OptionMemberSelect == '1') { ?>
                    <div id="tabs-4" class="tab-pane fade">
                            <div><?php require("require_productpost.php"); ?></div> 
                            <div style=" clear:both; display:block"></div>
                    </div>
                    <?php } ?> 
                </div>  
                <!--Tab-->             
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
          <td width="189"><?php echo $Lang_Error_NoSearch //目前尚無資料 ?></td>
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

<hr>
<div id="jcart"></div>
<script language="javascript" type="text/javascript">
    $(document).ready(function () { /* Div 自動調整100%高度 */
        //$(".product_inner_board_detailed").css("height", $("td.AutoHightTr").height()+"px");
    });
</script>
<script type="text/javascript">
//$(function(){
	//var text = {1:'尚可',2:'普通',3:'滿意',4:'很滿意',5:'太棒了'};
	var options	= {
		image : '<?php echo $SiteBaseUrl; ?>images/star.png', 
		<?php if ($row_RecordProduct['ratercount']!=0) { ?>
		value   : <?php echo intval($avgstar/$row_RecordProduct['ratercount']) ?>, // 預設值
		<?php } ?>
		min : 1,
		max : 5, // 星星個數 
		step : 1, // 半個星星
		url	: '<?php echo $SiteBaseUrl ?>ajax/product_rater.php?id=<?php echo $_GET['id']; ?>',
		method	:'GET',
		after_ajax	: function(ret) {
			alert(ret.ajax);
		},
		// 點選後不可更改
		after_click : function(ret) {  
			this.value  = ret.value;  
			this.enabled= false;  
			$('#product_rater').rater(this);  
    	}/*,
		title_format : function(val) {
			var title = text[val];
			return title;
		}*/
	}
	$('#product_rater').rater(options);
//});
</script>
<script type="text/javascript">
/* 圖片(不)完全按比例自動縮圖 */
jQuery(document).ready(function(){$(window).load(function(){$(".div_table-cell img").each(function(){if("true"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");var c=$(this).width(),d=$(this).height(),a=$(this).attr("_w")/c,b=$(this).attr("_h")/d,e=1,e=a>b?b:a;$(this).width(c*e);$(this).height(d*e)}else if("false"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");$(this).width();$(this).height();c=$(this).attr("_w");d=$(this).attr("_h");
a=$(this).width();b=$(this).height();if(a>c){var e=a,f=b,b=b*(c/a),a=c;b<d&&(a=e*(d/f),b=d)}$(this).attr({width:a,height:b})}})})});
</script>
<script type="text/javascript"> 
$(document).ready(function(){
    $(".acc_container:not('.acc_container:first')").hide();

    $('.acc_trigger').click(function(){
	if( $(this).next().is(':hidden') ) {
            $('.acc_trigger').removeClass('active').next().slideUp();
            $(this).toggleClass('active').next().slideDown();
	}else{
            $(this).toggleClass('active');
            $(this).next().slideUp();
        }
	return false;
    });
	
});
</script> 
<script type="text/javascript">
$(document).ready(function() {
 
	//ACCORDION BUTTON ACTION	
	$('div.accordionButton').click(function() {
		$('div.accordionContent').slideUp('normal');	
		$(this).next().slideDown('normal');
	});
 
	//HIDE THE DIVS ON PAGE LOAD	
	$("div.accordionContent").hide();
 
});
</script>
<script type="text/javascript">
//Add Item to Cart
$(document).ready(function(){
	
$("#Cart_Add").click(function(){
	<?php if ($OptionCartSelect == '1') { // 購物功能 ?>
	<?php if ($totalRows_RecordProductAjaxFormat > 0) { // Show if recordset not empty ?>
	<?php $format_counter=0; ?>
	<?php do { ?>
	var fmt<?php echo $format_counter; ?> = $('#formatselect<?php echo $row_RecordProductAjaxFormat['pid']; ?>').val();
	<?php $format_counter++; ?>
    <?php } while ($row_RecordProductAjaxFormat = mysqli_fetch_assoc($RecordProductAjaxFormat)); ?>
	<?php //$totalRows_RecordProductAjaxFormat; // 總數 ?>
	<?php mysqli_free_result($RecordProductAjaxFormat); // ?>
    <?php } // Show if recordset not empty ?>
	<?php } // 購物功能 ?>
	var qu = $('#quantity').val();
	var pr = $('#price').val();
	var prsp = $('#spprice').val();
	var pic = $('#pic').val();
	<?php if (isset($totalRows_RecordProducSptFormat) && $totalRows_RecordProducSptFormat > 0) { ?>
	var spfmt = $('input[name=spformat]:checked').val();
	var arr = new Array();
	arr = spfmt.split('#');//注split可以用字符或字符串分割
	<?php } ?>
	<?php
	for($i=0; $i<$format_counter; $i++) {
		$fmt .= "\"&fmt$i=\"+fmt" . $i . "+";
	}
	//echo $fmt;
	?>
	<?php //if($format_counter) ?>
    $.ajax({ //make ajax request to cart_process.php
        url: "<?php echo $SiteBaseUrl ?>ajax/cart_add.php",
        type: "POST",
        //dataType:"json", //expect json value from server
        data: "id=<?php echo $row_RecordProduct['id']; ?>&qu=" + qu + "&pr=" + pr + "&prsp=" + prsp + "&pic=" + pic + <?php if (isset($totalRows_RecordProducSptFormat) && $totalRows_RecordProducSptFormat > 0) { ?>"&spfmt=" + arr[2] + <?php } ?><?php if ($totalRows_RecordProductAjaxFormat > 0) { ?><?php echo $fmt; ?><?php } ?>"&wshop=<?php echo $_GET['wshop']; ?>&time()",
        success: function(data){
        $("#jcart").html(data);
		<?php 
		// 購物車商品計算
		if(isset($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID']) && count($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID']) != "")
		{
			$Cart_Counter=0;
			foreach($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'] as $i => $val) {$Cart_Counter += $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i];} 
		}else{
			$Cart_Counter = 0;
		}
		?>
		if(data == "<?php echo $Lang_Classify_Added_To_Cart; ?>") {
			var bscount = <?php echo $Cart_Counter; ?>;
			qu = parseInt(qu)+parseInt(bscount);
			$("#cart_counter").html(qu);
		}
      }
	});

});
});
</script>