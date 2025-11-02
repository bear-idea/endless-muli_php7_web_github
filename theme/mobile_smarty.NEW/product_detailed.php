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
.product_inner_board_detailed .active{background-image:url(images/lb.png);background-repeat:no-repeat;background-position:right center}
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
.text_radio{float:left;margin:5px; }
.text-nicelabel + label > span.nicelabel-unchecked,.text-nicelabel  + label > span.nicelabel-checked{ padding: 10px 20px 10px 10px;}
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
    
    
<div class="post_content padding-3">
		  <div class="row">
							
								<!-- IMAGE -->
								<div class="col-lg-6 col-md-6 col-sm-12">
                               
                                <!-- 左方圖片區塊 -->
								<?php // 產品多圖
                                    require("require_product_detailed_photoalbum_mobile.php");
                                ?>
                                
                                <?php //require("require_fb_like.php"); ?>
                                <!-- 左方圖片區塊 END -->

								</div>
								<!-- /IMAGE -->

								<!-- ITEM DESC -->
								<div class="col-lg-6 col-md-6 col-sm-12">
                                    
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
                            <div style="max-width:150px;"><input class="touchspin" type="text" value="1" id="quantity"></div>
                            
                            <?php if ($row_RecordProduct['inventoryshow'] == "1" && $row_RecordProduct['inventory'] != "" && $row_RecordProduct['inventory'] <= 50) {$invcount = $row_RecordProduct['inventory'];}else{$invcount=50;}?>
                    <script>
                    $("#quantity").TouchSpin({
                        min: 1,
                        max: <?php echo $invcount ?>,
                        stepinterval: 50//,
                        //maxboostedstep: 10000000//,
                        //prefix: '$'
                    });
                    </script>
                          
                             
                            <?php if($row_RecordProduct['inventoryshow'] == "1" && $row_RecordProduct['inventory'] != "") { ?>(庫存:<?php echo $row_RecordProduct['inventory']; ?>) <?php } ?>
                            </td>
                      	  </tr>
                    </table> 
                    <table width="99%" border="0" cellspacing="0" cellpadding="0" class="Product_Detailed_Right_Board">
                          <tr>
                            <td colspan="2" align="center" valign="middle">
                            
                            <?php if($row_RecordProduct['inventorynotsale'] == "1" && $row_RecordProduct['inventory'] <= 0) { ?>
                            
                            <a href="#" class="btn btn-3d btn-white btn-lg" id="Cart_Add"><i class="fa fa-cart-plus" aria-hidden="true"></i><?php echo $Lang_Classify_Context_Mail_Send_Clear; ?></a>
                            
                            <?php } else { ?>
                           
                            <a href="#" class="btn btn-3d btn-warning btn-lg" id="Cart_Add" onclick="AddtoCart('<?php echo $row_RecordProduct['id']; ?>','<?php if(isset($fmtpid)) { echo $fmtpid; } ?>','0')" style="color:#FFF;"><i class="fa fa-cart-plus" aria-hidden="true"></i><?php echo $Lang_Classify_Context_Mail_Send_Add; ?></a>
                           
                            <?php } ?>
                            
                            <?php  
                            if(($CartRegSelect =='1' && $totalRows_RecordMember > 0) || $CartRegSelect =='0'){ /* 網站需要會原註冊且已登入狀態 */
                              $gotoshowcart = 1; /* 結帳是否跳轉到結帳頁面 */
                            }else{
                              $gotoshowcart = 0;
                            }
                            ?>
                            <a href="#" class="btn btn-3d btn-danger btn-lg" onclick="AddtoCart('<?php echo $row_RecordProduct['id']; ?>','<?php if(isset($fmtpid)) { echo $fmtpid; } ?>','<?php echo $gotoshowcart; ?>')" style="color:#FFF;"><i class="fa fa-cart-plus" aria-hidden="true"></i><?php echo $Lang_Classify_Context_Mail_Send_Pay; ?></a>
                           
                            
                            
                            
                            </td>
                      	  </tr>
                         
                    </table>
                      <input name="id" type="hidden" id="id" value="<?php echo $row_RecordProduct['id']; ?>" />
                      <input name="pdseries" type="hidden" id="pdseries" value="<?php echo $row_RecordProduct['pdseries']; ?>" />
                      <input name="name" type="hidden" id="name" value="<?php echo $row_RecordProduct['name']; ?>" />
                      <input name="price" type="hidden" id="price" value="<?php echo $row_RecordProduct['price']; ?>" />
                      <input name="spprice" type="hidden" id="spprice" value="<?php echo $row_RecordProduct['spprice']; ?>" />
                      <input name="wshop" type="hidden" id="wshop" value="<?php echo $_GET['wshop']; ?>" />
                    <input name="pic" type="hidden" id="pic" value="<?php echo $row_RecordProduct['pic']; ?>" />
                  </div>
                  <?php  // 加購專區 END ?>
                  
                  
                  <!--</form>-->
                  <?php } ?>
                  <!-- 右方購物車區塊 END -->
                  <div style="height:5px;"></div>
                  <?php if ($totalRows_RecordDiscountGetType6 > 0 || $totalRows_RecordDiscountGetType5 > 0 || ($row_RecordProduct['discountid'] != '' && $totalRows_RecordDiscountShow > 0)) { ?>
                  <div class="product_inner_board_detailed">
                    <div class="product_inner_board_detailed_title">
                                本商品適用活動
                        </div>
                        <table width="99%" border="0" cellspacing="0" cellpadding="0" class="Product_Detailed_Right_Board">
                          <?php if (($row_RecordProduct['discountid'] != '' && $totalRows_RecordDiscountShow > 0)) { ?>
                          <tr>
                            <td valign="top">
                            <span class="label label-light" style="margin-right:2px;color:#337ab7;font-weight:bolder;">
                            指定商品
                            </span>
                            <span class="label label-light" style="color:#d9534f;font-weight:bolder;">
							<?php   
                              switch($row_RecordProduct['discounttype'])
                                {
                                    case "0":
                                        echo "滿件折扣";
                                        break;
                                    case "1":
                                        echo "滿件減價";
                                        break;
                                    case "2":
                                        echo "滿額折扣";
                                        break;
                                    case "3":
                                        echo "滿額減價";
                                        break;
                                    case "4":
                                        echo "任選優惠";
                                        break;
                                    default:
                                        break;
                                } 	
                    
							?></span>
                            <?php echo $row_RecordDiscountShow['name']; ?>
							</td>
                          </tr>
                          <?php } ?>
                          <?php if ($totalRows_RecordDiscountGetType5 > 0) { ?>
                          <?php do{ ?>
                          <tr>
                            <td valign="top">
                            <span class="label label-light" style="margin-right:2px;color:#337ab7;font-weight:bolder;">
                            全單滿額
                            </span>
                            <span class="label label-light" style="color:#d9534f;font-weight:bolder;">滿額折扣</span>
                            <?php echo $row_RecordDiscountGetType5['name']; ?>
                            </td>
                          </tr>
                          <?php } while ($row_RecordDiscountGetType5 = mysqli_fetch_assoc($RecordDiscountGetType5)); ?>
                          <?php } ?>
                          <?php if ($totalRows_RecordDiscountGetType6 > 0) { ?>
                          <?php do{ ?>
                          <tr>
                            <td valign="top">
                            <span class="label label-light" style="margin-right:2px;color:#337ab7;font-weight:bolder;">
                            全單滿額
                            </span>
                            <span class="label label-light" style="color:#d9534f;font-weight:bolder;">滿額減價</span>
                            <?php echo $row_RecordDiscountGetType6['name']; ?>
                            </td>
                          </tr>
                          <?php } while ($row_RecordDiscountGetType6 = mysqli_fetch_assoc($RecordDiscountGetType6)); ?>
                          <?php } ?>
                          <?php if ($totalRows_RecordDiscountGetType7 > 0) { ?>
                          <?php do{ ?>
                          <tr>
                            <td valign="top">
                            <span class="label label-light" style="margin-right:2px;color:#337ab7;font-weight:bolder;">
                            全單滿額
                            </span>
                            <span class="label label-light" style="color:#d9534f;font-weight:bolder;">滿額贈禮</span>
                            <?php echo $row_RecordDiscountGetType7['name']; ?>
                            </td>
                          </tr>
                          <?php } while ($row_RecordDiscountGetType7 = mysqli_fetch_assoc($RecordDiscountGetType7)); ?>
                          <?php } ?>
                        </table>
                  </div>
                  <div style="height:5px;"></div>
                  <?php } ?>
                  <div class="product_inner_board_detailed">
                    <!-- 右方詳細內容區塊標題 -->
                        <div class="product_inner_board_detailed_title acc_trigger">
                            付款與運送 <div style="float:right; margin-right:15px;"><?php if (($row_RecordSystemConfigOtr['sevenshopenable'] == '1' || $row_RecordSystemConfigOtr['sevenshopnopayenable'] == '1' || $row_RecordSystemConfigOtr['familyshopenable'] == '1' || $row_RecordSystemConfigOtr['familyshopnopayenable'] == '1') && $row_RecordSystemConfigOtr['allpaypaymentnumber'] != "") { ?><a data-toggle="tooltip" data-placement="top" title="便利超商"><span class="twa twa-convenience-store"></span></a><?php } ?><?php if ($row_RecordSystemConfigOtr['allpaypaymentenable_Credit'] == '1' || $row_RecordSystemConfigOtr['allpaypaymentenable'] == '1' || $row_RecordSystemConfigOtr['pchomepaypaymentenable'] == '1' || $row_RecordSystemConfigOtr['paypalpaymentenable'] == '1') { ?><a data-toggle="tooltip" data-placement="top" title="信用卡"><span class="twa twa-credit-card"></span></a><?php } ?><?php if ($row_RecordSystemConfigOtr['atmpaymentenable'] == '1') { ?><a data-toggle="tooltip" data-placement="top" title="<?php echo $Lang_Classify_Context_Cart_ATM_Transfers; //ATM轉帳 ?>"><span class="twa twa-atm"></span></a><?php } ?><?php if ($row_RecordSystemConfigOtr['postofficepaymentenable'] == '1') { ?><a data-toggle="tooltip" data-placement="top" title="<?php echo $Lang_Classify_Context_Cart_Postal_Allocation; //郵政劃撥 ?>"><span class="twa twa-post-office"></span></a><?php } ?><?php if ($row_RecordSystemConfigOtr['linguipaymentenable'] == '1') { ?><a data-toggle="tooltip" data-placement="top" title="<?php echo $Lang_Classify_Context_Cart_Financial_Remittance; //金融匯款 ?>"><span class="twa twa-bank"></span></a><?php } ?></div>
                      	</div>
                    <!-- 右方詳細內容區塊標題 END -->
                    <div class="acc_container">
                    <?php $productcome=0; //貨到付款計數初始化 ?>
                    <table width="99%" border="0" cellspacing="0" cellpadding="0" class="Product_Detailed_Right_Board">
                          <?php if ($totalRows_RecordCartListFreight > 0 || (($row_RecordSystemConfigOtr['sevenshopenable'] == '1' || $row_RecordSystemConfigOtr['sevenshopnopayenable'] == '1' || $row_RecordSystemConfigOtr['familyshopenable'] == '1' || $row_RecordSystemConfigOtr['familyshopnopayenable'] == '1') && $row_RecordSystemConfigOtr['allpaypaymentnumber'] != "")) { ?>
                          <tr>
                            <td valign="top"><i class="fa fa-caret-square-o-right" aria-hidden="true"></i> 運送方式</td>
                          </tr>
                          <?php if ($row_RecordSystemConfigOtr['sevenshopenable'] == '1' && $row_RecordSystemConfigOtr['allpaypaymentnumber'] != "") { ?>
                          <tr>
                            <td valign="top">7-11 超商取貨付款<?php if ($row_RecordSystemConfigOtr['sevenshopshipment'] != "" && $row_RecordSystemConfigOtr['sevenshopshipment'] != "0") { ?>，運費：<?php echo $row_RecordSystemConfigOtr['sevenshopshipment']; ?>元<?php } else { ?>，免運費<?php } ?><span style="float:right;"><a data-toggle="tooltip" data-placement="top" title="7-11"><img src="<?php echo $SiteBaseUrl; ?>images/7-11_logo.jpg" width="16" height="16" /></a></span></td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordSystemConfigOtr['sevenshopnopayenable'] == '1' && $row_RecordSystemConfigOtr['allpaypaymentnumber'] != "") { ?>
                          <tr>
                            <td valign="top">付款後 7-11 超商取貨<?php if ($row_RecordSystemConfigOtr['sevenshopnopayshipment'] != "" && $row_RecordSystemConfigOtr['sevenshopnopayshipment'] != "0") { ?>，運費：<?php echo $row_RecordSystemConfigOtr['sevenshopnopayshipment']; ?>元<?php } else { ?>，免運費<?php } ?><span style="float:right;"><a data-toggle="tooltip" data-placement="top" title="7-11"><img src="<?php echo $SiteBaseUrl; ?>images/7-11_logo.jpg" width="16" height="16" /></a></span></td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordSystemConfigOtr['familyshopenable'] == '1' && $row_RecordSystemConfigOtr['allpaypaymentnumber'] != "") { ?>
                          <tr>
                            <td valign="top">全家 超商取貨付款<?php if ($row_RecordSystemConfigOtr['familyshopshipment'] != "" && $row_RecordSystemConfigOtr['familyshopshipment'] != "0") { ?>，運費：<?php echo $row_RecordSystemConfigOtr['familyshopshipment']; ?>元<?php } else { ?>，免運費<?php } ?><span style="float:right;"><a data-toggle="tooltip" data-placement="top" title="全家"><img src="<?php echo $SiteBaseUrl; ?>images/family_logo.jpg" width="16" height="16" /></a></span></td>
                          </tr>
                           <?php } ?>
                           <?php if ($row_RecordSystemConfigOtr['familyshopnopayenable'] == '1' && $row_RecordSystemConfigOtr['allpaypaymentnumber'] != "") { ?>
                          <tr>
                            <td valign="top">付款後 全家 超商取貨
                            <?php if ($row_RecordSystemConfigOtr['familyshopnopayshipment'] != "" && $row_RecordSystemConfigOtr['familyshopnopayshipment'] != "0") { ?>，運費：<?php echo $row_RecordSystemConfigOtr['familyshopnopayshipment']; ?>元<?php } else { ?>，免運費<?php } ?><span style="float:right;"><a data-toggle="tooltip" data-placement="top" title="全家"><img src="<?php echo $SiteBaseUrl; ?>images/family_logo.jpg" width="16" height="16" /></a></span></td>
                          </tr>
                          <?php } ?>
                          <?php if ($totalRows_RecordCartListFreight > 0) {  ?>
                          <?php do { ?>
                          <tr>
                            <td valign="top">
							<?php echo $row_RecordCartListFreight['itemname']; ?>
                            <?php
							//  顯示運費狀態
							switch($row_RecordCartListFreight['mode'])
							{
								case "0":
								echo $Lang_Classify_Context_Cart_No_Freight; // 不須運費
								break;
								case "1":
								echo "運費：";
								if($row_RecordCartListFreight['modeselect'] == 0) // 全國
								{
									echo $Lang_Classify_Context_Cart_Fixed_Freight /* 固定運費 */ . $row_RecordCartListFreight['countryprice'] . $Lang_Classify_Context_Cart_Money_Unit /* 元 */;
								}
								if($row_RecordCartListFreight['modeselect'] == 1) // 分區
								{
									echo $Lang_Classify_Context_Cart_North /* 北部 */ . $row_RecordCartListFreight['northprice'] . $Lang_Classify_Context_Cart_Money_Unit /* 元 */;
									echo " ";
									echo $Lang_Classify_Context_Cart_Central /* 中部 */ . $row_RecordCartListFreight['centralprice'] . $Lang_Classify_Context_Cart_Money_Unit /* 元 */;
									echo " ";
									echo $Lang_Classify_Context_Cart_South /* 南部 */ . $row_RecordCartListFreight['southprice'] . $Lang_Classify_Context_Cart_Money_Unit /* 元 */;
									echo " ";
									echo $Lang_Classify_Context_Cart_East /* 東部 */ . $row_RecordCartListFreight['eastprice'] . $Lang_Classify_Context_Cart_Money_Unit /* 元 */;
									echo " ";
									echo $Lang_Classify_Context_Cart_Outer_Island /* 外島 */ . $row_RecordCartListFreight['outerprice'] . $Lang_Classify_Context_Cart_Money_Unit /* 元 */;
									echo "<br/>";
									echo $Lang_Classify_Context_Cart_Limited_Use_In_Taiwan; /* 限台灣地區使用 */
								}
								break;
								case "2":
								echo $Lang_Classify_Context_Cart_Freight_Another_Offer; /* 運費另外報價，此方式不支援金流 */
							?>
							<?php
								break;
								case "3":
								echo $Lang_Classify_Context_Cart_Freight_User_Offer; /* 消費者自填運費，此方式不支援金流 */
							?>
							<?php
								break;
							}
							?>
                            <?php
							//  貨到付款判斷
							switch($row_RecordCartListFreight['productcome'])
							{
								case "0":
								echo "，無提供貨到付款";
								break;
								case "1":
								$productcome++; // 貨到付款計數
									if($row_RecordCartListFreight['productcomeprice'] == "") // 有提供，且消費者可選擇是否要貨到付款 不設限金額
									{
					                   echo "有提供，且消費者可選擇是否要貨到付款 不設限金額";
									}else{ // 有提供，且消費者可選擇是否要貨到付款 有設限金額
								echo "有提供貨到付款" . "(需低於" . $row_RecordCartListFreight['productcomeprice'] . "元)";
									}
								break;
								case "2":
								$productcome++; // 貨到付款計數
				    				echo "，貨到付款";
								break;
							}
							?>
                            </td>
                          </tr>
                          <?php } while ($row_RecordCartListFreight = mysqli_fetch_assoc($RecordCartListFreight)); ?>
                          <?php }  ?>
                          <tr>
                            <td valign="top">&nbsp;</td>
                          </tr>
                          <?php } /* \運送方示區塊 */  ?>
                          <tr>
                            <td valign="top"><i class="fa fa-caret-square-o-right" aria-hidden="true"></i> 付款方式</td>
                          </tr>
                          <?php if ($row_RecordSystemConfigOtr['sevenshopenable'] == '1' || $row_RecordSystemConfigOtr['familyshopenable'] == '1') { ?>
                          <tr>
                            <td valign="top">超商取貨付款<?php if ($row_RecordSystemConfigOtr['sevenshopenable'] == '1') { ?><span style="float:right;"><a data-toggle="tooltip" data-placement="top" title="7-11"><img src="<?php echo $SiteBaseUrl; ?>images/7-11_logo.jpg" width="16" height="16" /></a></span><?php } ?> <?php if ($row_RecordSystemConfigOtr['familyshopenable'] == '1') { ?><span style="float:right;"><a data-toggle="tooltip" data-placement="top" title="全家"><img src="<?php echo $SiteBaseUrl; ?>images/family_logo.jpg" width="16" height="16" /></a></span><?php } ?></td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordSystemConfigOtr['allpaypaymentenable_BARCODE'] == '1' || $row_RecordSystemConfigOtr['allpaypaymentenable'] == '1') { ?>
                          <tr>
                            <td valign="top">超商條碼繳費(自行列印)</td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordSystemConfigOtr['allpaypaymentenable_CVS'] == '1' || $row_RecordSystemConfigOtr['allpaypaymentenable'] == '1') { ?>
                          <tr>
                            <td valign="top">超商代碼繳費(超商機台輸入代碼列印)</td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordSystemConfigOtr['allpaypaymentenable_Credit'] == '1' || $row_RecordSystemConfigOtr['allpaypaymentenable'] == '1' || $row_RecordSystemConfigOtr['pchomepaypaymentenable'] == '1' || $row_RecordSystemConfigOtr['paypalpaymentenable'] == '1') { ?>
                          <tr>
                            <td valign="top">信用卡一次付清</td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordSystemConfigOtr['linguipaymentenable'] == '1') { ?>
                          <tr>
                            <td valign="top"><?php echo $Lang_Classify_Context_Cart_Financial_Remittance; //金融匯款 ?></td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordSystemConfigOtr['atmpaymentenable'] == '1') { ?>
                          <tr>
                            <td valign="top"><?php echo $Lang_Classify_Context_Cart_ATM_Transfers; //ATM轉帳 ?></td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordSystemConfigOtr['postofficepaymentenable'] == '1') { ?>
                          <tr>
                            <td valign="top"><?php echo $Lang_Classify_Context_Cart_Postal_Allocation; //郵政劃撥 ?></td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordSystemConfigOtr['otherpaymentenable'] == '1') { ?>
                          <tr>
                            <td valign="top"><?php echo $Lang_Classify_Context_Cart_Other_Payment_Methods; //其他付款方式 ?></td>
                          </tr>
                          <?php } ?>
                          <?php if ($totalRows_RecordCartListPayment > 0) { ?>
                          <?php do { ?>
                          <tr>
                            <td valign="top"><?php echo $row_RecordCartListPayment['itemname']; ?></td>
                          </tr>
                          <?php } while ($row_RecordCartListPayment = mysqli_fetch_assoc($RecordCartListPayment)); ?>
                          <?php } ?>
                          <?php if (($totalRows_RecordCartListFreight > 0 && $productcome > 0) || $row_RecordSystemConfigOtr['sevenshopenable'] == '1' || $row_RecordSystemConfigOtr['familyshopenable'] == '1') { ?>
                          <tr>
                            <td valign="top">
							貨到付款
                            </td>
                          </tr>
                          <?php } ?>
                      </table>
                      </div>
                  </div>
                  <?php } // 購物功能 END ?>
                  
                  <?php if($row_RecordProduct['skeyword'] != "" && $row_RecordProduct['skeywordindicate'] == 1) { ?>
                        <div style="border:0px #CCCCCC dotted; padding:5px;" class="keytag">
                        <a>&nbsp;<i class="fa fa-tag"></i>&nbsp;</a><?php
                        $arr_tag = explode(',', $row_RecordProduct['skeyword']);
                        for($i = 0; $i < count($arr_tag); $i++){ echo "<a href=\"".$SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'search'),'',$UrlWriteEnable).$tag_params.$arr_tag[$i] ."\">".$arr_tag[$i]."</a>";}
						
						?>
                        </div>
                        <?php } ?>
                  <div class="pull-right"><?php require("require_sharelink_mobile.php"); ?></div>


									

							  </div>
								<!-- /ITEM DESC -->

		  </div>

                        <div>
                        <ul id="myTab" class="nav nav-tabs nav-top-border margin-top-10" role="tablist">
                        <li role="presentation" class="active"><a href="#tabs-1" style="color:#000" role="tab" data-toggle="tab"><?php echo $Lang_Tab_Content_Product //商品說明 ?></a></li>
                        <?php if ($row_RecordProduct['content1'] != '' && $MSProductMutiContent == '1') { ?>
                        <li role="presentation"><a href="#tabs-2" style="color:#000" role="tab" data-toggle="tab"><?php echo $row_RecordProduct['content1title']; //退換貨服務 ?></a></li>
                        <?php } ?> 
                        <?php if ($row_RecordProduct['content2'] != '' && $MSProductMutiContent == '1') { ?>
                        <li role="presentation"><a href="#tabs-3" style="color:#000" role="tab" data-toggle="tab"><?php echo $row_RecordProduct['content2title']; //其他注意事項 ?></a></li>
                        <?php } ?>
                        <?php if ($OptionCartSelect == '1' && $OptionMemberSelect == '1') { ?>
                        <li role="presentation"><a href="#tabs-4" style="color:#000" role="tab" data-toggle="tab"><?php echo $Lang_Tab_FAQ_Product //問答紀錄 ?><span id="Show_QAPost_Count"></span></a></li>
                        <?php } ?>
                        </ul>
                        <div class="tab-content padding-top-20">
                        <div id="tabs-1" class="tab-pane fade in active">
                            <div><?php echo pageBreak($row_RecordProduct['content']); ?></div>
                            <div style=" clear:both; display:block"></div> 
                        </div>
                        <?php if ($row_RecordProduct['content1'] != '' && $MSProductMutiContent == '1') { ?>
                        <div id="tabs-2"  class="tab-pane fade">
                            <div><?php echo $row_RecordProduct['content1']; ?></div> 
                            <div style=" clear:both; display:block"></div>
                        </div>
                        <?php } ?>
                        <?php if ($row_RecordProduct['content2'] != '' && $MSProductMutiContent == '1') { ?>
                        <div id="tabs-3" class="tab-pane fade">
                            <div><?php echo $row_RecordProduct['content2']; ?></div> 
                            <div style=" clear:both; display:block"></div>
                        </div>
                        <?php } ?> 
                        <?php if ($OptionCartSelect == '1' && $OptionMemberSelect == '1') { ?>
                        <div id="tabs-4" class="tab-pane">
                            <div><?php require("require_productpost.php"); ?></div> 
                            <div style=" clear:both; display:block"></div>
                        </div>
                        <?php } ?> 
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
<script type="text/javascript"> 
$(document).ready(function(){
    $(".acc_container:not('.acc_container:first')").hide();

    $('.acc_trigger').click(function(){
	if( $(this).next().is(':hidden') ) {
            //$('.acc_trigger').removeClass('active').next().slideUp();
            $(this).toggleClass('active').next().slideDown();
	}else{
            $(this).toggleClass('active');
            $(this).next().slideUp();
        }
	return false;
    });
	
});
</script> 
<?php if($OptionCartSelect == "1") { ?>
<div id="jcart"></div>
<script>
	
function AddtoCart(id, fmt, gotoshowcart) {
	//alert(gotoshowcart);
	var qu = $('#quantity').val();
	var pr = $('#price').val();
	var prsp = $('#spprice').val();
	var pic = $('#pic').val();
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
    $.ajax({ 
        type: "GET",
		url:"<?php echo $SiteBaseUrl ?>ajax/cart_add_mobile.php?" + "id=<?php echo $row_RecordProduct['id']; ?>&qu=" + qu + "&pr=" + pr + "&prsp=" + prsp + "&pic=" + pic + fmtend + "&wshop=<?php echo $_GET['wshop']; ?>&time()",
		data: fmtend,
        
        success: function(data){
            //alert(gotoshowcart);
			generatetip(data, 'warning');
			<?php 
			if(isset($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID']) && count($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID']) != "")
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
<?php if ($FBPixelCodeID != "") { ?>
<script>
fbq('track', 'ViewContent', {
value: <?php if ($row_RecordProduct['spprice'] !='') { echo $row_RecordProduct['spprice']; } else if($row_RecordProduct['price'] !=''){echo $row_RecordProduct['price'];} ?>,
currency: 'TWD'
});
</script>
<?php } ?>
