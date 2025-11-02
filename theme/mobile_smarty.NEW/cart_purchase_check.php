<?php // 判斷是否勾選同訂購人 ?>
<?php 
if($_POST['autoinputpurchaser'] == "1") {
	$_POST['ocname'] = $_POST['ocbuyname'];
    $_POST['ocphone'] = $_POST['ocbuyphone'];
    $_POST['octel'] = $_POST['ocbuytel'];
	//$_POST['ocmail'] = $_POST['ocbuymail'];
}
?>
<style type="text/css">
.Cart_Purchase tr td{margin:5px;padding:5px; border-bottom:1px solid #DDD}
.InnerButtom{margin-right:2px;margin-top:5px;margin-bottom:5px}
.InnerButtom a{font-weight:700;border:1px solid #CCC;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;text-shadow:0 1px 1px #fff;-webkit-box-shadow:0 1px 1px #fff;-moz-box-shadow:0 1px 1px #fff;box-shadow:0 1px 1px #fff;font:bold 11px Sans-Serif;padding:4px 8px;white-space:nowrap;vertical-align:middle;color:#666;background:transparent;cursor:pointer}
.InnerButtom a:hover,.InnerButtom a:focus{font-weight:700;border-color:#999;background:-webkit-linear-gradient(top,white,#E0E0E0);background:-moz-linear-gradient(top,white,#E0E0E0);background:-ms-linear-gradient(top,white,#E0E0E0);background:-o-linear-gradient(top,white,#E0E0E0);-webkit-box-shadow:0 1px 2px rgba(0,0,0,0.25),inset 0 0 3px #fff;-moz-box-shadow:0 1px 2px rgba(0,0,0,0.25),inset 0 0 3px #fff;box-shadow:0 1px 2px rgba(0,0,0,0.25),inset 0 0 3px #fff;color:#333;text-decoration:none}
.InnerButtom a:active{font-weight:700;color:#666;border:1px solid #AAA;border-bottom-color:#CCC;border-top-color:#999;-webkit-box-shadow:inset 0 1px 2px #aaa;-moz-box-shadow:inset 0 1px 2px #aaa;box-shadow:inset 0 1px 2px #aaa;background:-webkit-linear-gradient(top,#E6E6E6,gainsboro);background:-moz-linear-gradient(top,#E6E6E6,gainsboro);background:-ms-linear-gradient(top,#E6E6E6,gainsboro);background:-o-linear-gradient(top,#E6E6E6,gainsboro)}
</style>
<?php
/*********************************************************************
 # 主頁面產品資訊
 *********************************************************************/
?>
<!--標題外框-->
<div style="position:relative;">
  <div class="mdtitle TitleBoardStyle">
    <div class="mdtitle_t">
      <div class="mdtitle_t_l"> </div>
      <div class="mdtitle_t_r"> </div>
      <div class="mdtitle_t_c"><!--標題--></div>
      <div class="mdtitle_t_m"><!--更多--></div>
    </div>
    <!--mdtitle_t-->
    <div class="mdtitle_c g_p_hide">
      <div class="mdtitle_c_l g_p_fill"> </div>
      <div class="mdtitle_c_r g_p_fill"> </div>
      <div class="mdtitle_c_c"> 
        <!-- <div class="mdtitle_m_t"></div>
					<div class="mdtitle_m_c">  --> 
        <!--標題外框-->
        
        <div class="ct_title">
          <h1 style="font-size:large">
            <?php if($TmpTitleBgImage != ''){ ?>
            <span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span>
            <?php } ?>
            <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $Lang_Title_Cart_Purchase_Check; // 標題文字 ?></span></h1>
        </div>
        
        <!--標題外框--> 
        <!--</div>
					<div class="mdtitle_m_b"></div>--> 
      </div>
    </div>
    <!--mdtitle_c-->
    <div class="mdtitle_b">
      <div class="mdtitle_b_l"> </div>
      <div class="mdtitle_b_r"> </div>
      <div class="mdtitle_b_c"> </div>
    </div>
    <!--mdtitle_b--> 
  </div>
  <!--mdtitle--> 
</div>
<!-- 標題外框--> 
<!--外框-->
<div style="position:relative;">
  <div class="mdmiddle MiddleBoardStyle">
    <div class="mdmiddle_t">
      <div class="mdmiddle_t_l"> </div>
      <div class="mdmiddle_t_r"> </div>
      <div class="mdmiddle_t_c"><!--標題--></div>
      <div class="mdmiddle_t_m"><!--更多--></div>
    </div>
    <!--mdmiddle_t-->
    <div class="mdmiddle_c g_p_hide">
      <div class="mdmiddle_c_l g_p_fill"> </div>
      <div class="mdmiddle_c_r g_p_fill"> </div>
      <div class="mdmiddle_c_c"> 
        <!-- <div class="mdmiddle_m_t"></div>
					<div class="mdmiddle_m_c">  --> 
        <!--外框-->
        <div class="post_content padding-3">
          <div class="row">
            <div style="-moz-box-shadow:0px 0px 1px rgba(0,0,0,.6); -webkit-box-shadow:0px 0px 1px rgba(0,0,0,.6); box-shadow:0px 0px 1px rgba(0,0,0,.6); background-color: rgba(255, 255, 255, 0.6); padding:10px;">
              <div class="row process-wizard process-wizard-info">
                <div class="col-xs-3 process-wizard-step complate">
                  <div class="text-center process-wizard-stepnum">Step 1</div>
                  <div class="progress">
                    <div class="progress-bar"></div>
                  </div>
                  <a href="#" class="process-wizard-dot"></a>
                  <div class="process-wizard-info text-center"><?php echo $Lang_Classify_Shopping_Process_Step_Confirmed; //確認購物車 ?></div>
                </div>
                <div class="col-xs-3 process-wizard-step complate"><!-- complete -->
                  <div class="text-center process-wizard-stepnum">Step 2</div>
                  <div class="progress">
                    <div class="progress-bar"></div>
                  </div>
                  <a href="#" class="process-wizard-dot"></a>
                  <div class="process-wizard-info text-center"><?php echo $Lang_Classify_Shopping_Process_Step_Pay; //付款與運送方式 ?></div>
                </div>
                <div class="col-xs-3 process-wizard-step complate"><!-- complete -->
                  <div class="text-center process-wizard-stepnum">Step 3</div>
                  <div class="progress">
                    <div class="progress-bar"></div>
                  </div>
                  <a href="#" class="process-wizard-dot"></a>
                  <div class="process-wizard-info text-center"><?php echo $Lang_Classify_Shopping_Process_Step_Edit; //資料填寫 ?></div>
                </div>
                <div class="col-xs-3 process-wizard-step active"><!-- active -->
                  <div class="text-center process-wizard-stepnum">Step 4</div>
                  <div class="progress">
                    <div class="progress-bar"></div>
                  </div>
                  <a href="#" class="process-wizard-dot"></a>
                  <div class="process-wizard-info text-center"><?php echo $Lang_Classify_Shopping_Process_Step_Order; //確認訂單?></div>
                </div>
              </div>
            </div>
            <div style="height:5px;"></div>
            <?php //echo $_POST['ocfreightselectno'] . "///////////////////"; ?>
            <?php if($totalRows_RecordCartlist > 0){ ?>
            <?php if($_POST['ocpaymentselect'] == 'allpay' || $_POST['ocpaymentselect'] == 'allpay_Credit' || $_POST['ocpaymentselect'] == 'allpay_BARCODE' || $_POST['ocpaymentselect'] == 'allpay_CVS') { $editFormAction = $SiteBaseUrl . "allpay_order_send_cart.php"; } ?>
            <?php if($_POST['ocpaymentselect'] == 'pchomepay') { $editFormAction = $SiteBaseUrl . "pchomepay_order_send_cart.php"; } ?>
            <?php if($_POST['ocpaymentselect'] == 'paypal') { $editFormAction = $SiteBaseUrl . "paypal_order_send_cart.php"; } ?>
            <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
              <div style="-moz-box-shadow:0px 0px 1px rgba(0,0,0,.6); -webkit-box-shadow:0px 0px 1px rgba(0,0,0,.6); box-shadow:0px 0px 1px rgba(0,0,0,.6); background-color: rgba(255, 255, 255, 0.6); padding:10px;"> <?php echo $Lang_Title_Cart_Order_Number; //訂單編號 ?>：<font color="#0033FF"><?php echo $_SESSION['OrderID']; ?></font>
                <input name="D_OrderID" type="hidden" id="D_OrderID" value="<?php echo $_SESSION['OrderID']; ?>" />
                <br />
                <br />
                <?php echo $Lang_Classify_Context_Cart_Order_Total; //共?> <span style="color:#F00"><?php echo $totalRows_RecordCartlist; ?></span> 項商品 <a style="float:right;" id="CartShowAllBtn">查看優惠及購買商品列表 <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                <div style="height:5px;"></div>
                <div id="CartShowAll" style="display:none;">
                  <?php /* 顯示購物清單 */ ?>
                  <div style="-moz-box-shadow:0px 0px 1px rgba(0,0,0,.6); -webkit-box-shadow:0px 0px 1px rgba(0,0,0,.6); box-shadow:0px 0px 1px rgba(0,0,0,.6); background-color: rgba(255, 255, 255, 0.6); padding:10px;">
                    <?php $NO = 1;?>
                    <?php $_SESSION['Total'] = 0; $_SESSION['PlusTotal'] = 0; $_SESSION['itemTotal'] = 0; $_SESSION['TotalOriginalPrice'] = 0; // 初始化總金額避免累加?>
                    <?php //$val = ''; $i = 0; // 初始化?>
                    <?php // ======== 商品列表 ======== ?>
                    <?php $DiscountShowAll = array(); $DiscountShowAllNot = array(); ?>
                    <?php do { ?>
                    <div class="row nomargin">
                      <div class="col-md-1 col-sm-1 col-xs-2">
                        <div class="shop-item margin-bottom-10">
                          <div class="imgLiquid" data-fill="<?php echo $TmpProductImageMethods; /* resize or crop */ ?>" data-board="<?php echo $TmpProductImageBoard; /* 方型 or 矩形 */ ?>"><a><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/product/<?php echo $row_RecordCartlist['pic']; ?>" alt=""/></a>
                            <div style="clear:both"></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-11 col-sm-11 col-xs-10">
                        <div style="float:right;">
                          <?php
                                /* 判斷是否採用優惠價格 */ 
								require("require_cart_discount_show.php"); /* 取得此商品目前優惠 */
								require("require_cart_discount_show_type.php"); /* 取得此商品該優惠項目所有購物清單 */
								if ($row_RecordDiscountShow['type'] !='' && $row_RecordCartlist['price'] !='' && $totalRows_RecordDiscountShow > 0) { /* 判斷是否有折扣活動 */
								  switch($row_RecordCartlist['discounttype'])
									{
										case "0":
											//echo "滿件折扣";
											if($CanDiscount > 0){
												$discountprice = ceil($row_RecordCartlist['price'] * ($row_RecordDiscountShow['discountFoldnumber']/100)); /* 無條件近位 */
												echo "<span style=\"font-size:16px;\">" . $Lang_Classify_Context_Currency_units . $discountprice . "</span>" . " <s style=\"color:#CCC\">" . $Lang_Classify_Context_Currency_units . $row_RecordCartlist['price'] . "</s>"; 
											}else{
												$discountprice = $row_RecordCartlist['price'];
												echo $Lang_Classify_Context_Currency_units . $discountprice; 
											}
											// 記錄目前優惠
											$DiscountShowAll[$row_RecordDiscountShow['id']]['discountPieces'] = $row_RecordDiscountShow['discountPieces'];
											$DiscountShowAll[$row_RecordDiscountShow['id']]['discountFoldnumber'] = $row_RecordDiscountShow['discountFoldnumber'];
											break;
										case "1":
											//echo "滿件減價";
											$discountprice = $row_RecordCartlist['price'];
											echo $Lang_Classify_Context_Currency_units . $discountprice; 
											// 記錄目前優惠
											$DiscountShowAll[$row_RecordDiscountShow['id']]['discountPieces'] = $row_RecordDiscountShow['discountPieces'];
											$DiscountShowAll[$row_RecordDiscountShow['id']]['discountNowfold'] = $row_RecordDiscountShow['discountNowfold'];
											break;
										case "2":
											//echo "滿額折扣";
											if($CanDiscount > 0){
												$discountprice = ceil($row_RecordCartlist['price'] * ($row_RecordDiscountShow['discountFoldnumber']/100)); /* 無條件近位 */
												echo "<span style=\"font-size:16px;\">" . $Lang_Classify_Context_Currency_units . $discountprice . "</span>" . " <s style=\"color:#CCC\">" . $Lang_Classify_Context_Currency_units . $row_RecordCartlist['price'] . "</s>"; 
											}else{
												$discountprice = $row_RecordCartlist['price'];
												echo $Lang_Classify_Context_Currency_units . $discountprice; 
											}
											// 記錄目前優惠
											$DiscountShowAll[$row_RecordDiscountShow['id']]['discountFullamount'] = $row_RecordDiscountShow['discountFullamount'];
											$DiscountShowAll[$row_RecordDiscountShow['id']]['discountFoldnumber'] = $row_RecordDiscountShow['discountFoldnumber'];
											break;
										case "3":
											//echo "滿額減價";
											$discountprice = $row_RecordCartlist['price'];
											echo $Lang_Classify_Context_Currency_units . $discountprice; 
											// 記錄目前優惠
											$DiscountShowAll[$row_RecordDiscountShow['id']]['discountFullamount'] = $row_RecordDiscountShow['discountFullamount'];
											$DiscountShowAll[$row_RecordDiscountShow['id']]['discountNowfold'] = $row_RecordDiscountShow['discountNowfold'];
											break;
										case "4":
											//echo "任選優惠";
											$discountprice = $row_RecordCartlist['price'];
											echo $Lang_Classify_Context_Currency_units . $discountprice; 
											// 記錄目前優惠
											$DiscountShowAll[$row_RecordDiscountShow['id']]['discountPieces'] = $row_RecordDiscountShow['discountPieces'];
											$DiscountShowAll[$row_RecordDiscountShow['id']]['discountNowfold'] = $row_RecordDiscountShow['discountNowfold'];
											break;
										default:
											break;
									} 	
									//echo $Lang_Classify_Context_Currency_units . $discountprice; 
								} else { /* 判斷是否有折扣活動 */
									if($row_RecordCartlist['spprice'] != "" && $row_RecordCartlist['price'] != "") {
								?>
                          <s style=" color:#999"><?php echo $Lang_Classify_Context_Currency_units . $row_RecordCartlist['price'] ?></s> <?php echo $Lang_Classify_Context_Currency_units . $row_RecordCartlist['spprice']; ?>
                          <?php
									} else if($row_RecordCartlist['spprice'] !='') {	 
									    echo $Lang_Classify_Context_Currency_units . $row_RecordCartlist['spprice']; 
									} else if($row_RecordCartlist['price'] !='') {
										echo $Lang_Classify_Context_Currency_units . $row_RecordCartlist['price']; 
									}
								} /* \判斷是否有折扣活動 */
                        ?>
                          <input name="dcprice[]" type="hidden" id="dcprice[]" value="<?php echo $row_RecordCartlist['price']; ?>">
                          <div style="color:#999; text-align:right;">X<?php echo $row_RecordCartlist['quantity'] ?></div>
                          <input name="dcquantiry[]" type="hidden" id="dcquantiry[]" value="<?php echo $row_RecordCartlist['quantity']; ?>" />
                        </div>
                        <?php if($row_RecordCartlist['pdseries'] == '') {} else { echo $row_RecordCartlist['pdseries']; } ?>
                        <input name="pdseries[]" type="hidden" id="pdseries[]" value="<?php echo $row_RecordCartlist['pdseries']; ?>" />
                        <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'cartdetailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordCartlist['pid']; ?>" style="font-size:16px;"><?php echo $row_RecordCartlist['name']; ?></a>
                        <input name="dcproductname[]" type="hidden" id="dcproductname[]" value="<?php echo $row_RecordCartlist['name']; ?>" />
                        <input name="pid[]" type="hidden" id="pid[]" value="<?php echo $row_RecordCartlist['pid']; ?>" />
                        <input name="id[]" type="hidden" id="id[]" value="<?php echo $row_RecordCartlist['id']; ?>" />
                        <?php if($row_RecordCartlist['Format'] != "") { ?>
                        <br />
                        <span class="keytag">
                        <?php $arr_tag = explode(';', $row_RecordCartlist['Format']); for($fi = 0; $fi < count($arr_tag); $fi++){ echo "<a>".$arr_tag[$fi]."</a>";}?>
                        </span>
                        <?php } ?>
                        <input name="dcformat[]" type="hidden" id="dcformat[]" value="<?php echo $row_RecordCartlist['Format']; ?>" />
                        <?php if($row_RecordCartlist['SpFormat'] != "") { ?>
                        <span class="keytag"><?php echo "<a>".$row_RecordCartlist['SpFormat']."</a>";?></span>
                        <input name="dcspformat[]" type="hidden" id="dcspformat[]" value="<?php echo $row_RecordCartlist['SpFormat']; ?>" />
                        <?php } ?>
                      </div>
                    </div>
                    <div class="row nomargin">
                      <div class="col-md-6 col-sm-6 col-xs-6"> </div>
                      <?php // 數量?>
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <div style="text-align:right; color:#F00; font-size:24px">
                          <?php //小計與總價格
					  $_SESSION['TotalOriginalPrice'] += $row_RecordCartlist['price'] * $row_RecordCartlist['quantity']; /* 記錄原價 */
					  if ($row_RecordDiscountShow['type'] !='' && $row_RecordCartlist['price'] !='' && $totalRows_RecordDiscountShow > 0) { /* 判斷是否有折扣活動 */
							switch($row_RecordCartlist['discounttype'])
							{
								case "0":
									//echo "滿件折扣";
									if($CanDiscountType == 'All'){
										$_SESSION['itemTotal'] = $discountprice * $row_RecordCartlist['quantity'];
										$_SESSION['Total'] += $_SESSION['itemTotal'];	
										echo "<span style=\"font-size:14px;\">折扣後</span>" . $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal']);
										// 記錄目前優惠
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllOk)){$DiscountShowAllOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discount'][$row_RecordCartlist['pid']] = ($row_RecordCartlist['price']*$row_RecordCartlist['quantity']) - $_SESSION['itemTotal'];
										echo "<div style=\"font-size:14px; color:#CCC\">省" . $Lang_Classify_Context_Currency_units . doFormatMoney($DiscountShowAll[$row_RecordDiscountShow['id']]['discount'][$row_RecordCartlist['pid']]) . "</div>";
										
									}else if($CanDiscountType == 'Part'){
										$_SESSION['itemTotal'] = $discountprice * $CanDiscount;
										$_SESSION['itemTotal'] += $row_RecordCartlist['price'] * ($row_RecordCartlist['quantity']-$CanDiscount);
										$_SESSION['Total'] += $_SESSION['itemTotal'];	
										echo "<span style=\"font-size:14px;\">折扣後</span>" .  $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal']);
										// 記錄目前優惠
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllOk)){$DiscountShowAllOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllNotOk)){$DiscountShowAllNotOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discount'][$row_RecordCartlist['pid']] = ($row_RecordCartlist['price']*$row_RecordCartlist['quantity']) - $_SESSION['itemTotal'];
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discountnot'][$row_RecordCartlist['pid']] = ($row_RecordCartlist['price']-$discountprice)*($row_RecordCartlist['quantity']-$CanDiscount);
										$DiscountShowAll[$row_RecordDiscountShow['id']]['numnot'] = $row_RecordDiscountShow['discountPieces']-($totalDiscountCountQuantity%$row_RecordDiscountShow['discountPieces']);
										echo "<div style=\"font-size:14px; color:#CCC\">省" . $Lang_Classify_Context_Currency_units . doFormatMoney($DiscountShowAll[$row_RecordDiscountShow['id']]['discount'][$row_RecordCartlist['pid']]) . "</div>";
										
									}else if($CanDiscountType == 'None'){
										$_SESSION['itemTotal'] = $row_RecordCartlist['price'] * $row_RecordCartlist['quantity'];
										$_SESSION['Total'] += $_SESSION['itemTotal'];	
										echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal']);
										// 記錄目前優惠
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllNotOk)){$DiscountShowAllNotOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discountnot'][$row_RecordCartlist['pid']] = ($row_RecordCartlist['price']-(ceil($row_RecordCartlist['price'] * ($row_RecordDiscountShow['discountFoldnumber']/100))))*($row_RecordCartlist['quantity']);
										$DiscountShowAll[$row_RecordDiscountShow['id']]['numnot'] = $row_RecordDiscountShow['discountPieces']-($totalDiscountCountQuantity%$row_RecordDiscountShow['discountPieces']); /* 未符合條件數量 */
										
									}
									break;
								case "1":
									//echo "滿件減價";
									if($CanDiscountType == 'All'){
										$_SESSION['itemTotal'] = $row_RecordCartlist['price'] * $row_RecordCartlist['quantity'];
										$_SESSION['Total'] += $_SESSION['itemTotal'];	
										echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal']);
										// 記錄目前優惠
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllOk)){$DiscountShowAllOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discount'][$row_RecordCartlist['pid']] = 1; /* 僅判斷是否有折扣 */
										$DiscountShowAll[$row_RecordDiscountShow['id']]['pieces'][$row_RecordCartlist['pid']] = $row_RecordCartlist['quantity']; /* 可折扣總件數 */
											
									}else if($CanDiscountType == 'Part'){
										$_SESSION['itemTotal'] = $row_RecordCartlist['price'] * $row_RecordCartlist['quantity'];
										$_SESSION['Total'] += $_SESSION['itemTotal'];	
										echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal']);
										// 記錄目前優惠
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllOk)){$DiscountShowAllOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllNotOk)){$DiscountShowAllNotOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discount'][$row_RecordCartlist['pid']] = 1; /* 僅判斷是否有折扣 */
										$DiscountShowAll[$row_RecordDiscountShow['id']]['pieces'][$row_RecordCartlist['pid']]  = $CanDiscount; /* 可折扣總件數 需除限制條件 */
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discountnot'][$row_RecordCartlist['pid']] = 0;
										$DiscountShowAll[$row_RecordDiscountShow['id']]['numnot'] = $row_RecordDiscountShow['discountPieces']-($totalDiscountCountQuantity%$row_RecordDiscountShow['discountPieces']);
										
									}else if($CanDiscountType == 'None'){
										$_SESSION['itemTotal'] = $row_RecordCartlist['price'] * $row_RecordCartlist['quantity'];
										$_SESSION['Total'] += $_SESSION['itemTotal'];	
										echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal']);
										// 記錄目前優惠
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllNotOk)){$DiscountShowAllNotOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discountnot'][$row_RecordCartlist['pid']] = 0;
										$DiscountShowAll[$row_RecordDiscountShow['id']]['numnot'] = $row_RecordDiscountShow['discountPieces']-($totalDiscountCountQuantity%$row_RecordDiscountShow['discountPieces']); /* 未符合條件數量 */
										
									}
									break;
								case "2":
									//echo "滿額折扣";
									if($CanDiscountType == 'All'){
										$_SESSION['itemTotal'] = $discountprice * $row_RecordCartlist['quantity'];
										$_SESSION['Total'] += $_SESSION['itemTotal'];	
										echo "<span style=\"font-size:14px;\">折扣後</span>" . $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal']);
										// 記錄目前優惠
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllOk)){$DiscountShowAllOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discount'][$row_RecordCartlist['pid']] = ($row_RecordCartlist['price']*$row_RecordCartlist['quantity']) - $_SESSION['itemTotal'];
										echo "<div style=\"font-size:14px; color:#CCC\">省" . $Lang_Classify_Context_Currency_units . doFormatMoney($DiscountShowAll[$row_RecordDiscountShow['id']]['discount'][$row_RecordCartlist['pid']]) . "</div>";
										
									}else if($CanDiscountType == 'None'){
										$_SESSION['itemTotal'] = $row_RecordCartlist['price'] * $row_RecordCartlist['quantity'];
										$_SESSION['Total'] += $_SESSION['itemTotal'];	
										echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal']);
										// 記錄目前優惠
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllNotOk)){$DiscountShowAllNotOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discountnot'][$row_RecordCartlist['pid']] = ($row_RecordCartlist['price']-(ceil($row_RecordCartlist['price'] * ($row_RecordDiscountShow['discountFoldnumber']/100))))*($row_RecordCartlist['quantity']); /* 可折扣優惠價 */
										$DiscountShowAll[$row_RecordDiscountShow['id']]['numnot'] = $row_RecordDiscountShow['discountFullamount']-$totalDiscountCountPrice; /* 未符合金額數量 */
										
									}
									break;
								case "3":
									//echo "滿額減價";
									if($CanDiscountType == 'All'){
										$_SESSION['itemTotal'] = $row_RecordCartlist['price'] * $row_RecordCartlist['quantity'];
										$_SESSION['Total'] += $_SESSION['itemTotal'];	
										echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal']);
										// 記錄目前優惠
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllOk)){$DiscountShowAllOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discount'][$row_RecordCartlist['pid']] = 1; /* 僅判斷是否有折扣 */
										$DiscountShowAll[$row_RecordDiscountShow['id']]['itemprice'][$row_RecordCartlist['pid']] = $row_RecordCartlist['price'] * $row_RecordCartlist['quantity']; /* 目前總共多少錢 */
											
									}else if($CanDiscountType == 'None'){
										$_SESSION['itemTotal'] = $row_RecordCartlist['price'] * $row_RecordCartlist['quantity'];
										$_SESSION['Total'] += $_SESSION['itemTotal'];	
										echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal']);
										// 記錄目前優惠
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllNotOk)){$DiscountShowAllNotOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discountnot'][$row_RecordCartlist['pid']] = ($row_RecordCartlist['price']-(ceil($row_RecordCartlist['price'] * ($row_RecordDiscountShow['discountFoldnumber']/100))))*($row_RecordCartlist['quantity']); /* 可折扣優惠價 */
										$DiscountShowAll[$row_RecordDiscountShow['id']]['numnot'] = $row_RecordDiscountShow['discountFullamount']-$totalDiscountCountPrice; /* 未符合金額數量 */
										
									}
									break;
								case "4":
									//echo "任選優惠";
									if($CanDiscountType == 'All'){
										$_SESSION['itemTotal'] = $row_RecordCartlist['price'] * $row_RecordCartlist['quantity'];
										$_SESSION['Total'] += $_SESSION['itemTotal'];
										echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal']);	
										// 記錄目前優惠
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllOk)){$DiscountShowAllOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discount'][$row_RecordCartlist['pid']] = 1; /* 僅判斷是否有折扣 */
										$DiscountShowAll[$row_RecordDiscountShow['id']]['itemprice'][$row_RecordCartlist['pid']] = $row_RecordCartlist['price'] * $row_RecordCartlist['quantity']; /* 目前總共多少錢 */
										$DiscountShowAll[$row_RecordDiscountShow['id']]['pieces'][$row_RecordCartlist['pid']] = $row_RecordCartlist['quantity']; /* 可折扣總件數 */
										$DiscountShowAll[$row_RecordDiscountShow['id']]['price'][$row_RecordCartlist['pid']]  = 0;
											
									}else if($CanDiscountType == 'Part'){
										$_SESSION['itemTotal'] = $row_RecordCartlist['price'] * $row_RecordCartlist['quantity'];
										$_SESSION['Total'] += $_SESSION['itemTotal'];	
										echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal']);
										// 記錄目前優惠
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllOk)){$DiscountShowAllOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllNotOk)){$DiscountShowAllNotOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discount'][$row_RecordCartlist['pid']] = 1; /* 僅判斷是否有折扣 */
										$DiscountShowAll[$row_RecordDiscountShow['id']]['itemprice'][$row_RecordCartlist['pid']] = $row_RecordCartlist['price'] * $row_RecordCartlist['quantity']; /* 目前總共多少錢 */
										$DiscountShowAll[$row_RecordDiscountShow['id']]['pieces'][$row_RecordCartlist['pid']]  = $CanDiscount; /* 可折扣總件數 需除限制條件 */
										$DiscountShowAll[$row_RecordDiscountShow['id']]['price'][$row_RecordCartlist['pid']]  = $row_RecordCartlist['price']*($row_RecordCartlist['quantity']-$CanDiscount);
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discountnot'][$row_RecordCartlist['pid']] = 0;
										$DiscountShowAll[$row_RecordDiscountShow['id']]['numnot'] = $row_RecordDiscountShow['discountPieces']-($totalDiscountCountQuantity%$row_RecordDiscountShow['discountPieces']);
										
									}else if($CanDiscountType == 'None'){
										$_SESSION['itemTotal'] = $row_RecordCartlist['price'] * $row_RecordCartlist['quantity'];
										$_SESSION['Total'] += $_SESSION['itemTotal'];	
										echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal']);
										// 記錄目前優惠
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllNotOk)){$DiscountShowAllNotOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										//$DiscountShowAll[$row_RecordDiscountShow['id']]['price']  = $row_RecordCartlist['price'];
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discountnot'][$row_RecordCartlist['pid']] = 0;
										$DiscountShowAll[$row_RecordDiscountShow['id']]['numnot'] = $row_RecordDiscountShow['discountPieces']-($totalDiscountCountQuantity%$row_RecordDiscountShow['discountPieces']); /* 未符合條件數量 */
										
									}
									break;
								default:
									break;
							} 	
					  } else { /* 判斷是否有折扣活動 */
                            if($row_RecordCartlist['SpFormat'] != '')
                            {
                                $_SESSION['itemTotal'] = $row_RecordCartlist['SpFormat'] * $row_RecordCartlist['quantity'];
                                //'price=' . $row_RecordCartlist['SpFormat'];
                                //echo 'qu=' . $row_RecordCartlist['quantity'];
                                echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal']);
                                $_SESSION['Total'] += $_SESSION['itemTotal'];
                            }else{
								if($row_RecordCartlist['spprice'] != "" && $row_RecordCartlist['price'] != "") {
									$_SESSION['itemTotal'] = $row_RecordCartlist['spprice'] * $row_RecordCartlist['quantity'];
									echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal']);
									echo "<div style=\"font-size:14px; color:#CCC\">省" . $Lang_Classify_Context_Currency_units . doFormatMoney(($row_RecordCartlist['price']-$row_RecordCartlist['spprice']) * $row_RecordCartlist['quantity']) . "</div>";
									if(isset($DiscountShowAlldiscount_type_spprice) && $DiscountShowAlldiscount_type_spprice != ""){}else{$DiscountShowAlldiscount_type_spprice=0;}
									$DiscountShowAlldiscount_type_spprice += ($row_RecordCartlist['price']-$row_RecordCartlist['spprice']) * $row_RecordCartlist['quantity'];
								} else if($row_RecordCartlist['spprice'] !='') {
									$_SESSION['itemTotal'] = $row_RecordCartlist['spprice'] * $row_RecordCartlist['quantity'];
									echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal']);	
								} else if($row_RecordCartlist['price'] !='') {
									$_SESSION['itemTotal'] = $row_RecordCartlist['price'] * $row_RecordCartlist['quantity'];
									echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal']);	
								}
                                //echo 'qu=' . $row_RecordCartlist['quantity'];
                                
                                $_SESSION['Total'] += $_SESSION['itemTotal'];
                            }
					  } /* \判斷是否有折扣活動 */
                      ?>
                          <input name="dcitemtotal[]" type="hidden" id="dcitemtotal[]" value="<?php echo $_SESSION['itemTotal']; ?>" />
                        </div>
                      </div>
                      <?php // \小計 ?>
                      <div class="clearfix"></div>
                    </div>
                    <div class="row nomargin">
                      <div style="padding-top:10px;">
                        <?php 
				  if ($row_RecordDiscountShow['type'] !='' && $row_RecordCartlist['price'] !='' && $totalRows_RecordDiscountShow > 0) { /* 判斷是否有折扣活動 */
								echo "<span class=\"label label-primary\" style=\"margin-right:2px;\">指定商品</span>";
								echo "<span class=\"label label-danger\" style=\"margin-right:2px;\">";
								  switch($row_RecordCartlist['discounttype'])
									{
										case "0":
											echo "滿件折扣";
											if($CanDiscountType == 'All'){
												$discountmeets = "<span style=\"color:#428bca;\"><i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i> " . "已符合</span>";
											}else if($CanDiscountType == 'Part'){
												$discountmeets = "<span style=\"color:#f0ad4e;\"><i class=\"fa fa-exclamation-circle\" aria-hidden=\"true\"></i> " . "部分符合，已折扣" . $CanDiscount . "件(同專區價低者優先折扣)</span>";
											}else if($CanDiscountType == 'None'){
												$discountmeets = "<span style=\"color:#d9534f;\"><i class=\"fa fa-exclamation-circle\" aria-hidden=\"true\"></i> " . "未符合</span>";
											}
											break;
										case "1":
											echo "滿件減價";
											if($CanDiscountType == 'All'){
												$discountmeets = "<span style=\"color:#428bca;\"><i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i> " . "已符合</span>";
											}else if($CanDiscountType == 'Part'){
												$discountmeets = "<span style=\"color:#f0ad4e;\"><i class=\"fa fa-exclamation-circle\" aria-hidden=\"true\"></i> " . "部分符合，已選擇" . $CanDiscount . "件(同專區價低者優先選擇)</span>";
											}else if($CanDiscountType == 'None'){
												$discountmeets = "<span style=\"color:#d9534f;\"><i class=\"fa fa-exclamation-circle\" aria-hidden=\"true\"></i> " . "未符合</span>";
											}
											break;
										case "2":
											echo "滿額折扣";
											$discountprice = $discountprice ;
											if($CanDiscountType == 'All'){
												$discountmeets = "<span style=\"color:#428bca;\"><i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i> " . "已符合</span>";
											}else if($CanDiscountType == 'Part'){
												$discountmeets = "<span style=\"color:#f0ad4e;\"><i class=\"fa fa-exclamation-circle\" aria-hidden=\"true\"></i> " . "部分符合，已折扣" . $CanDiscount . "件(同專區價低者優先折扣)</span>";
											}else if($CanDiscountType == 'None'){
												$discountmeets = "<span style=\"color:#d9534f;\"><i class=\"fa fa-exclamation-circle\" aria-hidden=\"true\"></i> " . "未符合</span>";
											}
											break;
										case "3":
											echo "滿額減價";
											if($CanDiscountType == 'All'){
												$discountmeets = "<span style=\"color:#428bca;\"><i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i> " . "已符合</span>";
											}else if($CanDiscountType == 'None'){
												$discountmeets = "<span style=\"color:#d9534f;\"><i class=\"fa fa-exclamation-circle\" aria-hidden=\"true\"></i> " . "未符合</span>";
											}
											break;
										case "4":
											echo "任選優惠";
											if($CanDiscountType == 'All'){
												$discountmeets = "<span style=\"color:#428bca;\"><i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i> " . "已符合</span>";
											}else if($CanDiscountType == 'Part'){
												$discountmeets = "<span style=\"color:#f0ad4e;\"><i class=\"fa fa-exclamation-circle\" aria-hidden=\"true\"></i> " . "部分符合，已折扣" . $CanDiscount . "件(同專區價低者優先折扣)</span>";
											}else if($CanDiscountType == 'None'){
												$discountmeets = "<span style=\"color:#d9534f;\"><i class=\"fa fa-exclamation-circle\" aria-hidden=\"true\"></i> " . "未符合</span>";
											}
											break;
										default:
											break;
									} 	
									echo "</span>";
									echo $row_RecordDiscountShow['name'] . " " . $discountmeets;
									
									// 記錄目前優惠
									$DiscountShowAll[$row_RecordDiscountShow['id']]['name'] = $row_RecordDiscountShow['name'];
									$DiscountShowAll[$row_RecordDiscountShow['id']]['type'] = $row_RecordDiscountShow['type'];
									//$DiscountShowAll[$row_RecordDiscountShow['id']]['discount'][$row_RecordCartlist['pid']];
								}
				  ?>
                      </div>
                      <div class="divider" style="margin:10px 0"></div>
                    </div>
                    <?php } while ($row_RecordCartlist = mysqli_fetch_assoc($RecordCartlist)); ?>
                  </div>
                  <?php require("require_cart_discount_show_all.php");  /* 列出商品全部優惠情形 */?>
                  <div style="height:5px;"></div>
                </div>
                <?php /* \顯示購物清單 */ ?>
                <div style="-moz-box-shadow:0px 0px 1px rgba(0,0,0,.6); -webkit-box-shadow:0px 0px 1px rgba(0,0,0,.6); box-shadow:0px 0px 1px rgba(0,0,0,.6); background-color: rgba(255, 255, 255, 0.6); padding:10px;">
                  <div class="row nomargin">
                    <div class="col-md-4 col-sm-4 col-xs-12"> </div>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666;"><?php echo "商品金額小計"; ?></div>
                        <div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666; font-weight:bolder;"><?php echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['TotalOriginalPrice']); ?></div>
                        <?php if (isset($DiscountShowAlldiscount_type_spprice) && $DiscountShowAlldiscount_type_spprice != "") { ?>
                        <div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666;"><?php echo "特價商品"; ?></div>
                        <div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666;">-<?php echo $Lang_Classify_Context_Currency_units . doFormatMoney($DiscountShowAlldiscount_type_spprice); ?></div>
                        <?php //$_SESSION['Total'] = $_SESSION['Total'] - $DiscountShowAlldiscount_type_spprice; ?>
                        <?php } ?>
                        <?php if ($DiscountShowAlldiscount_type_0 != "") { ?>
                        <div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666;"><?php echo "滿件折扣"; ?></div>
                        <div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666;">-<?php echo $Lang_Classify_Context_Currency_units . doFormatMoney($DiscountShowAlldiscount_type_0); ?></div>
                        <?php //$_SESSION['Total'] = $_SESSION['Total'] - $DiscountShowAlldiscount_type_0; ?>
                        <?php } ?>
                        <?php if ($DiscountShowAlldiscount_type_1 != "") { ?>
                        <div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666;"><?php echo "滿件減價"; ?></div>
                        <div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666;">-<?php echo $Lang_Classify_Context_Currency_units . doFormatMoney($DiscountShowAlldiscount_type_1); ?></div>
                        <?php $_SESSION['Total'] = $_SESSION['Total'] - $DiscountShowAlldiscount_type_1; ?>
                        <?php } ?>
                        <?php if ($DiscountShowAlldiscount_type_2 != "") { ?>
                        <div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666;"><?php echo "滿額折扣"; ?></div>
                        <div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666;">-<?php echo $Lang_Classify_Context_Currency_units . doFormatMoney($DiscountShowAlldiscount_type_2); ?></div>
                        <?php //$_SESSION['Total'] = $_SESSION['Total'] - $DiscountShowAlldiscount_type_2; ?>
                        <?php } ?>
                        <?php if ($DiscountShowAlldiscount_type_3 != "") { ?>
                        <div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666;"><?php echo "滿額減價"; ?></div>
                        <div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666;">-<?php echo $Lang_Classify_Context_Currency_units . doFormatMoney($DiscountShowAlldiscount_type_3); ?></div>
                        <?php $_SESSION['Total'] = $_SESSION['Total'] - $DiscountShowAlldiscount_type_3; ?>
                        <?php } ?>
                        <?php if ($DiscountShowAlldiscount_type_4 != "") { ?>
                        <div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666;"><?php echo "任選優惠"; ?></div>
                        <div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666;">-<?php echo $Lang_Classify_Context_Currency_units . doFormatMoney($DiscountShowAlldiscount_type_4); ?></div>
                        <?php $_SESSION['Total'] = $_SESSION['Total'] - $DiscountShowAlldiscount_type_4; ?>
                        <?php } ?>
                        <?php /* *************運費及滿額免運費計算************* */ ?>
                        <?php require("require_cart_shoppingcosts.php"); ?>
                        <?php /* \*************運費及滿額免運費計算************* */?>
                        <?php 
						//計算總金額
						$_SESSION['Total'] = $_SESSION['Total'] + $_SESSION['PlusTotal'];
						// 商品金額 + 運費 + 
						$OCTotal = $_SESSION['Total'] + $ocfreight + $ocotherprice + $exprice + $invoicetaxprice;
						//echo $Lang_Classify_Context_Currency_units . doFormatMoney($OCTotal);
						?>
                        <?php /* *************訂單滿額折扣計算************* */ ?>
                        <?php require("require_cart_shoppingcosts_order.php"); ?>
                        <?php 
						// 計算全單滿額折扣價格
						$OCTotal = $OCTotal - $DiscountShowAlldiscount_type_5 - $DiscountShowAlldiscount_type_6;
						?>
                        <?php /* \*************訂單滿額折扣計算************* */?>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="divider" style="margin:5px 0" ></div>
                    <div class="col-md-4 col-sm-4 col-xs-12"> </div>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666; padding-top:10px;"><?php echo "折扣後小計"; ?></div>
                        <div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right;">
                          <h3><strong><font color="#FF0000">
                            <?php 
							//計算總金額
							// 商品金額 + 運費 + 
							//$OCTotal = $_SESSION['Total'] + $ocfreight + $ocotherprice + $exprice + $invoicetaxprice;
							echo $Lang_Classify_Context_Currency_units . doFormatMoney($OCTotal);
							?>
                          </font></strong></h3>
                            
							<?php 
                            /* ******************************************************************************************** */
                            // 顯示滿額免運費條件
                            /* ******************************************************************************************** */
						   if($row_RecordSystemConfigOtr['freepriceenable'] == "1") // 是否啟用滿額免運費
						   {
							   echo "<br/><span style=\"color:#090\">※ " . $Lang_Classify_Context_Shopping_Is_Full /* 購物滿 */.$row_RecordSystemConfigOtr['freeprice']. $Lang_Classify_Context_Cart_Money_Unit /* 元 */. $Lang_Classify_Context_Cart_Free_Shipping /* 免運費 */. "</span>";
						   }
						   if($row_RecordSystemConfigOtr['freepriceignorth'] == "1" || $row_RecordSystemConfigOtr['freepriceigcenter'] == "1" || $row_RecordSystemConfigOtr['freepriceigsourth'] == "1" || $row_RecordSystemConfigOtr['freepriceigeast'] == "1" || $row_RecordSystemConfigOtr['freepriceigouter'] == "1" || $row_RecordSystemConfigOtr['freepriceignotaiwan'] == "1") {
							   
							   if($_POST['ocfreightselect'] != "sevenshop" && $_POST['ocfreightselect'] != "sevenshopnopay" && $_POST['ocfreightselect'] != "familyshop" && $_POST['ocfreightselect'] != "familyshopnopay") { /* 使用超商付款不使用此判斷 */
								   
							   echo "<br/><span style=\"color:#090\">※ " . $Lang_Classify_Context_Cart_Full_Free_Delivery_Not_Applicable_Region /*滿額免運費不適用地區*/. "：</span>";
							   if($row_RecordSystemConfigOtr['freepriceignorth'] == 1) {
								   echo "<span style=\"color:#090\">台灣北部 </span>";
							   }
							   if($row_RecordSystemConfigOtr['freepriceigcenter'] == 1) {
								   echo "<span style=\"color:#090\">台灣中部 </span>";
							   }
							   if($row_RecordSystemConfigOtr['freepriceigsourth'] == 1) {
								   echo "<span style=\"color:#090\">台灣南部 </span>";
							   }
							   if($row_RecordSystemConfigOtr['freepriceigeast'] == 1) {
								   echo "<span style=\"color:#090\">台灣東部 </span>";
							   }
							   if($row_RecordSystemConfigOtr['freepriceigouter'] == 1) {
								   echo "<span style=\"color:#090\">台灣外島地區 </span>";
							   }
							   if($row_RecordSystemConfigOtr['freepriceignotaiwan'] == 1) {
								   echo "<span style=\"color:#090\">非台灣地區 </span>";
							   }
							   } /* \ 使用超商付款不使用此判斷 */
						   }
						   
						   if($freepriceok == 1)
						   {
							   $ocfreightstateonly = "3"; // 滿額免運
							   $freepricedesc = $Lang_Classify_Context_Free_Shipping/*滿額免運*/ . "【".$Lang_Classify_Context_Shopping_Is_Full/*購物滿*/.$row_RecordSystemConfigOtr['freeprice'].$Lang_Classify_Context_Cart_Money_Unit /*元*/. $Lang_Classify_Context_Cart_Free_Shipping /*免運費*/."】";
						   }
                            /* ******************************************************************************************** */
                            // \顯示滿額免運費條件
                            /* ******************************************************************************************** */  
                            ?>
                            
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div style="height:5px;"></div>
              <?php // 滿額免運費折抵 ?>
              <div style="-moz-box-shadow:0px 0px 1px rgba(0,0,0,.6); -webkit-box-shadow:0px 0px 1px rgba(0,0,0,.6); box-shadow:0px 0px 1px rgba(0,0,0,.6); background-color: rgba(255, 255, 255, 0.6); padding:10px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Cart_Purchase">
                  <tr>
                    <td colspan="2"><h4><i class="fa fa-pencil-square-o"></i><?php echo $Lang_Title_Cart_Subscriber_Basic_Information ?></h4></td>
                  </tr>
                  <tr>
                    <td width="150" align="right"><?php echo $Lang_Classify_Context_Cart_Name; //姓名 ?>：</td>
                    <td><?php echo $_POST['ocbuyname']; ?>
                      <input name="ocbuyname" type="hidden" id="ocbuyname" value="<?php echo $_POST['ocbuyname']; ?>" /></td>
                  </tr>
                  <tr>
                    <td align="right"><?php echo $Lang_Classify_Context_Cart_Cell; //行動 ?>：</td>
                    <td><?php echo $_POST['ocbuyphone']; ?>
                      <input name="ocbuyphone" type="hidden" id="ocbuyphone" value="<?php echo $_POST['ocbuyphone']; ?>" /></td>
                  </tr>
                  <tr>
                    <td align="right"><?php echo $Lang_Classify_Context_Cart_Tel; //室話 ?>：</td>
                    <td><?php echo $_POST['ocbuytel']; ?>
                      <input name="ocbuytel" type="hidden" id="ocbuytel" value="<?php echo $_POST['ocbuytel']; ?>" /></td>
                  </tr>
                  <tr>
                    <td colspan="2"><h4><i class="fa fa-pencil-square-o"></i> <?php echo $Lang_Title_Cart_Consignee_Basic_Information; //收貨人基本資料 ?></h4></td>
                  </tr>
                  <tr>
                    <td align="right"><?php echo $Lang_Classify_Context_Cart_Name; //姓名 ?>：</td>
                    <td><?php echo $_POST['ocname']; ?>
                      <input name="ocname" type="hidden" id="ocname" value="<?php echo $_POST['ocname']; ?>" /></td>
                  </tr>
                  <tr>
                    <td align="right"><?php echo $Lang_Classify_Context_Cart_Cell; //行動 ?>：</td>
                    <td><?php echo $_POST['ocphone']; ?>
                      <input name="ocphone" type="hidden" id="ocphone" value="<?php echo $_POST['ocphone']; ?>" /></td>
                  </tr>
                  <tr>
                    <td align="right"><?php echo $Lang_Classify_Context_Cart_Tel; //室話 ?>：</td>
                    <td><?php echo $_POST['octel']; ?>
                      <input name="octel" type="hidden" id="octel" value="<?php echo $_POST['octel']; ?>" /></td>
                  </tr>
                  <tr>
                    <td colspan="2"><h4><i class="fa fa-pencil-square-o"></i> E-mail通知信箱</h4></td>
                  </tr>
                  <tr>
                    <td align="right"><?php echo $Lang_Classify_Context_Cart_Mail; //電子郵件 ?>：</td>
                    <td><?php echo $_POST['ocmail']; ?>
                      <input name="ocmail" type="hidden" id="ocmail" value="<?php echo $_POST['ocmail']; ?>" /></td>
                  </tr>
                  <?php if ($row_RecordSystemConfigOtr['invoiceenable'] == '1') { ?>
                  <tr>
                    <td colspan="2"><h4><i class="fa fa-pencil-square-o"></i> <?php echo $Lang_Classify_Context_Cart_Invoice_Content; //發票內容 ?></h4></td>
                  </tr>
                  <tr>
                    <td align="right"><?php echo $Lang_Classify_Context_Cart_Invoice_Type; //發票類型 ?>：</td>
                    <td><?php 
			   switch($_POST['invoiceformat'])
			        {
						case "0":
						echo $Lang_Classify_Context_Cart_No_nvoicing_Is_Required; /*不開發票*/
						$ocinvoiceformat = $Lang_Classify_Context_Cart_No_nvoicing_Is_Required; /*不開發票*/
						break;
						case "1":
						echo $Lang_Classify_Context_Cart_Double_Invoice; /*二聯式發票*/
						$ocinvoiceformat = $Lang_Classify_Context_Cart_Double_Invoice; /*二聯式發票*/
						break;
						case "2":
						echo $Lang_Classify_Context_Cart_Triple_Invoice; /*三聯式發票*/
						$ocinvoiceformat = $Lang_Classify_Context_Cart_Triple_Invoice; /*三聯式發票*/
						break;
						case "3":
						echo $Lang_Classify_Context_Cart_Electronic_Invoice; /*電子式發票*/
						$ocinvoiceformat = $Lang_Classify_Context_Cart_Electronic_Invoice; /*電子式發票*/
						break;
						case "4":
						echo $Lang_Classify_Context_Cart_Receipt; /*收據*/
						$ocinvoiceformat = $Lang_Classify_Context_Cart_Receipt; /*收據*/
						break;
						case "5":
						echo $Lang_Classify_Context_Cart_Donated_Charitable; /*捐給慈善單位*/
						$ocinvoiceformat = $Lang_Classify_Context_Cart_Donated_Charitable; /*捐給慈善單位*/
						break;
					}
			  ?>
                      <input name="ocinvoiceformat" type="hidden" id="ocinvoiceformat" value="<?php echo $_POST['invoiceformat']; ?>" /></td>
                  </tr>
                  <?php if ($_POST['invoiceformat'] == "3") { ?>
                  <tr>
                    <td align="right"><?php echo $Lang_Classify_Context_Cart_Electronic_Invoice; //電子發票 ?>：</td>
                    <td><?php
			  switch($_POST['ocinvoiceetselect'])
			        {
						case "0":
						echo $Lang_Classify_Context_Cart_Print_To_Me; /*列印寄給我*/
						break;
						case "1":
						echo $Lang_Classify_Context_Cart_Carrier_Bar_Code /*載具條碼*/. "：" . $_POST['ocinvoicesupportno'];
			 ?>
                      <input name="ocinvoicesupportno" type="hidden" id="ocinvoicesupportno" value="<?php echo $_POST['ocinvoicesupportno']; ?>" />
                      <?php
						break;
						case "2":
						echo $Lang_Classify_Context_Cart_Carrier_Bar_Code /*愛心碼*/ . "：" . $_POST['ocinvoiceloveno'];		
			 ?>
                      <input name="ocinvoiceloveno" type="hidden" id="ocinvoiceloveno" value="<?php echo $_POST['ocinvoiceloveno']; ?>" />
                      <?php
                        break;
					}
			  ?>
                      <input name="ocinvoiceetselect" type="hidden" id="ocinvoiceetselect" value="<?php echo $_POST['ocinvoiceetselect']; ?>" /></td>
                  </tr>
                  <?php } ?>
                  <?php if ($_POST['ocinvoicecompanyno'] != "" && ($_POST['invoiceformat'] == '2' || ($_POST['invoiceformat'] == '3' && $_POST['ocinvoiceetselect'] == '0') || $_POST['invoiceformat'] == '4')) { ?>
                  <tr>
                    <td align="right"><?php echo $Lang_Classify_Context_Cart_Uniform_Numbers; //統一編號 ?>：</td>
                    <td><?php echo $_POST['ocinvoicecompanyno']; ?>
                      <input name="ocinvoicecompanyno" type="hidden" id="ocinvoicecompanyno" value="<?php echo $_POST['ocinvoicecompanyno']; ?>" /></td>
                  </tr>
                  <?php } ?>
                  <?php if ($_POST['ocinvoicetitle'] != "" && ($_POST['invoiceformat'] == '1' || $_POST['invoiceformat'] == '2' || ($_POST['invoiceformat'] == '3' && $_POST['ocinvoiceetselect'] == '0') || $_POST['invoiceformat'] == '4')) { ?>
                  <tr>
                    <td align="right"><?php echo $Lang_Classify_Context_Cart_Invoice_Title; //發票抬頭 ?>：</td>
                    <td><?php echo $_POST['ocinvoicetitle']; ?>
                      <input name="ocinvoicetitle" type="hidden" id="ocinvoicetitle" value="<?php echo $_POST['ocinvoicetitle']; ?>" /></td>
                  </tr>
                  <?php } ?>
                  <?php if ($_POST['ocinvoiceusername'] != "" && ($_POST['invoiceformat'] == '1' || $_POST['invoiceformat'] == '2' || ($_POST['invoiceformat'] == '3' && $_POST['ocinvoiceetselect'] == '0') || $_POST['invoiceformat'] == '4')) { ?>
                  <tr>
                    <td align="right"><?php echo $Lang_Classify_Context_Cart_Invoice_Recipient; //發票收件人 ?>：</td>
                    <td><?php echo $_POST['ocinvoiceusername']; ?>
                      <input name="ocinvoiceusername" type="hidden" id="ocinvoiceusername" value="<?php echo $_POST['ocinvoiceusername']; ?>" /></td>
                  </tr>
                  <?php } ?>
                  <?php if ($_POST['ocinvoiceusername'] != "" && ($_POST['invoiceformat'] == '1' || $_POST['invoiceformat'] == '2' || ($_POST['invoiceformat'] == '3' && $_POST['ocinvoiceetselect'] == '0') || $_POST['invoiceformat'] == '4')) { ?>
                  <tr>
                    <td align="right"><?php echo $Lang_Classify_Context_Cart_Invoice_Receipt_Address; //發票收件地址 ?>：</td>
                    <td><?php echo $_POST['ocinvoiceaddr']; ?>
                      <input name="ocinvoiceaddr" type="hidden" id="ocinvoiceaddr" value="<?php echo $_POST['ocinvoiceaddr']; ?>" /></td>
                  </tr>
                  <?php } ?>
                  <?php } ?>
                  <tr>
                    <td colspan="2"><h4><i class="fa fa-pencil-square-o"></i> <?php echo $Lang_Classify_Context_Cart_Payment_And_Shipping_Information; //付款、出貨資料 ?></h4></td>
                  </tr>
                  <tr>
                    <td align="right"><?php echo $Lang_Classify_Context_Cart_Payment_Method; //付款方式 ?>：</td>
                    <td><?php 
			  	if ($_POST['ocpaymentselect'] == 'lingui') {
					$ocpaymentselect = $Lang_Classify_Context_Cart_Financial_Remittance; // 金融匯款
				}else if ($_POST['ocpaymentselect'] == 'atm'){
					$ocpaymentselect = $Lang_Classify_Context_Cart_ATM_Transfers; // ATM轉帳
				}else if ($_POST['ocpaymentselect'] == 'postoffice'){
					$ocpaymentselect = $Lang_Classify_Context_Cart_Postal_Allocation; // 郵政劃撥
				}else if ($_POST['ocpaymentselect'] == 'other'){
					$ocpaymentselect = $Lang_Classify_Context_Cart_Other_Payment_Methods; // 其他付款方式
				}else if ($_POST['ocpaymentselect'] == 'payondelivery'){
					$ocpaymentselect = $Lang_Classify_Context_Cart_Cash_On_Delivery; // 貨到付款
				}else if ($_POST['ocpaymentselect'] == 'allpay'){
					$ocpaymentselect = $Lang_Classify_Context_Cart_ECPay; // 綠界金流
				}else if ($_POST['ocpaymentselect'] == 'allpay_Credit'){
					$ocpaymentselect = $Lang_Classify_Context_Cart_ECPay_Credit; // 綠界金流
				}else if ($_POST['ocpaymentselect'] == 'allpay_BARCODE'){
					$ocpaymentselect = $Lang_Classify_Context_Cart_ECPay_BARCODE; // 綠界金流
				}else if ($_POST['ocpaymentselect'] == 'allpay_CVS'){
					$ocpaymentselect = $Lang_Classify_Context_Cart_ECPay_CVS; // 綠界金流
				}else if ($_POST['ocpaymentselect'] == 'pchomepay'){
					$ocpaymentselect = $Lang_Classify_Context_Cart_PCHOMEPay; // PCHOME金流
				}
					echo $ocpaymentselect;
			  ?>
                      <input name="ocpaymentselect" type="hidden" id="ocpaymentselect" value="<?php echo $_POST['ocpaymentselect']; ?>" /></td>
                  </tr>
                  <tr>
                    <td align="right"><?php echo $Lang_Classify_Context_Cart_Addr; //收件地址 ?>：</td>
                    <td><?php echo $_POST['oczip']; ?><?php echo $_POST['occounty']; ?><?php echo $_POST['ocdistrict']; ?><?php echo $_POST['ocaddr']; ?>
                      <input name="oczip" type="hidden" id="oczip" value="<?php echo $_POST['oczip']; ?>" />
                      <input name="occounty" type="hidden" id="occounty" value="<?php echo $_POST['occounty']; ?>" />
                      <input name="ocdistrict" type="hidden" id="ocdistrict" value="<?php echo $_POST['ocdistrict']; ?>" />
                      <input name="ocaddr" type="hidden" id="ocaddr" value="<?php echo $_POST['ocaddr']; ?>" />
                      <?php if($_POST['ocCVSStoreID'] != "") { ?>
                      【<?php echo $_POST['ocCVSStoreName']; // 商店名稱?>】
                      <input name="ocCVSStoreName" type="hidden" id="ocCVSStoreName" value="<?php echo $_POST['ocCVSStoreName']; ?>" />
                      <input name="ocCVSStoreID" type="hidden" id="ocCVSStoreID" value="<?php echo $_POST['ocCVSStoreID']; ?>" />
                      <?php } ?></td>
                  </tr>
                  <tr>
                    <td align="right"><?php echo $Lang_Classify_Context_Cart_Time_Of_Receipt; //收貨時間 ?>：</td>
                    <td><?php echo $_POST['ocreceipt']; ?>
                      <input name="ocreceipt" type="hidden" id="ocreceipt" value="<?php echo $_POST['ocreceipt']; ?>" /></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top"><?php echo $Lang_Classify_Context_Cart_Supplementary_Information; //補充訊息 ?>：</td>
                    <td><?php echo $_POST['ocnotes1']; ?>
                      <input name="ocnotes1" type="hidden" id="ocnotes1" value="<?php echo $_POST['ocnotes1']; ?>" /></td>
                  </tr>
                  <tr>
                    <td align="right">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right">&nbsp;</td>
                    <td><input type="submit" name="button2" id="button2" value="<?php echo $Lang_Classify_Context_Mail_Send_Order_Information; //送出訂單資訊 ?>" onclick="javascript:{this.disabled=true;document.form1.submit();}" <?php if($bt_disable == "1") { ?>disabled="disabled"<?php } ?> class="btn btn-3d btn-danger btn-block"/>
                      <input name="postdate" type="hidden" id="postdate" value="<?php echo date("Y-m-d H-i-s");?>" />
                      <input name="ocinvoiceprice" type="hidden" id="ocinvoiceprice" value="<?php echo $invoicetaxprice; ?>" />
                      <input name="ocexprice" type="hidden" id="ocexprice" value="<?php echo $exprice; ?>" />
                      <input name="ocrfreight" type="hidden" id="ocrfreight" value="<?php echo $rFreight;?>" />
                      <input name="userid" type="hidden" id="userid" value="<?php echo $_SESSION['userid'];?>" />
                      <input name="wshop" type="hidden" id="wshop" value="<?php echo $_GET['wshop'];?>" />
                      <input name="ocfreightselect" type="hidden" id="ocfreightselect" value="<?php echo $_POST['ocfreightselect']; ?>" />
                      <input name="ocfreepriceok" type="hidden" id="ocfreepriceok" value="<?php echo $freepriceok; ?>" />
                      <input name="ocfreepricedesc" type="hidden" id="ocfreepricedesc" value="<?php echo $freepricedesc; ?>" />
                      <font color="#FF0000">
                      <input name="ocpdprice" type="hidden" id="ocpdprice" value="<?php echo $_SESSION['Total']; ?>" />
                      <input name="ocfreightprice" type="hidden" id="ocfreightprice" value="<?php echo $_POST['ocfreight']; ?>" />
                      <input name="octotal" type="hidden" id="octotal" value="<?php echo $OCTotal; ?>" />
                      <input name="ocexpriceselect" type="hidden" id="ocexpriceselect" value="<?php if($_POST['ocexpriceselect'] != "") {  echo $_POST['ocexpriceselect']; }else{echo "0";} ?>" />
                      <input name="ocexpricename" type="hidden" id="ocexpricename" value="<?php echo $row_RecordSystemConfigOtr['expricename']; ?>" />
                      <input name="ocgender" type="hidden" id="ocgender" value="<?php echo $_POST['ocgender']; ?>" />
                      <input name="ocbuygender" type="hidden" id="ocbuygender" value="<?php echo $_POST['ocbuygender']; ?>" />
                      <input name="ocfreightstateonly" type="hidden" id="ocfreightstateonly" value="<?php echo $ocfreightstateonly; ?>" />
                      <input name="ocpdformat" type="hidden" id="ocpdformat" value="<?php echo $ocfreightstateonly; ?>" />
                      <input name="ocDiscountShowAlldiscount_type_0" type="hidden" id="ocDiscountShowAlldiscount_type_0" value="<?php echo $DiscountShowAlldiscount_type_0; ?>" />
                      <input name="ocDiscountShowAlldiscount_type_1" type="hidden" id="ocDiscountShowAlldiscount_type_1" value="<?php echo $DiscountShowAlldiscount_type_1; ?>" />
                      <input name="ocDiscountShowAlldiscount_type_2" type="hidden" id="ocDiscountShowAlldiscount_type_2" value="<?php echo $DiscountShowAlldiscount_type_2; ?>" />
                      <input name="ocDiscountShowAlldiscount_type_3" type="hidden" id="ocDiscountShowAlldiscount_type_3" value="<?php echo $DiscountShowAlldiscount_type_3; ?>" />
                      <input name="ocDiscountShowAlldiscount_type_4" type="hidden" id="ocDiscountShowAlldiscount_type_4" value="<?php echo $DiscountShowAlldiscount_type_4; ?>" />
                      <input name="ocDiscountShowAlldiscount_type_5" type="hidden" id="ocDiscountShowAlldiscount_type_5" value="<?php echo $DiscountShowAlldiscount_type_5; ?>" />
                      <input name="ocDiscountShowAlldiscount_type_6" type="hidden" id="ocDiscountShowAlldiscount_type_6" value="<?php echo $DiscountShowAlldiscount_type_6; ?>" />
                      <input name="ocDiscountShowAlldiscount_type_7" type="hidden" id="ocDiscountShowAlldiscount_type_6" value="<?php echo $DiscountShowAlldiscount_type_7; ?>" /><?php /* 此為贈品ID */ ?>
                      </font></td>
                  </tr>
                </table>
              </div>
              <input type="hidden" name="MM_insert" value="form1" />
            </form>
            <?php } else { ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><table width="250" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="61"><img src="<?php echo $SiteBaseUrl; ?>images/error_tip.png" width="60" height="60" /></td>
                      <td width="189"><?php echo $Lang_Classify_Cart_Removed; //您購物車中的商品已全部移除或尚未選購商品 ?></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td align="center"><?php echo $Lang_Classify_Context_Cart_Continue_Buy_Buttom; //若您想繼續選購，請按下方「繼續購物」鈕 ?><br />
                  <br />
                  <span class="InnerButtom"><a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $Lang_Classify_Context_Cart_Continue_Shopping; //繼續購物 ?></a></span></td>
              </tr>
            </table>
            <?php 
        } 
        ?>
          </div>
        </div>
        <!--外框--> 
        <!--</div>
					<div class="mdmiddle_m_b"></div>--> 
      </div>
    </div>
    <!--mdmiddle_c-->
    <div class="mdmiddle_b">
      <div class="mdmiddle_b_l"> </div>
      <div class="mdmiddle_b_r"> </div>
      <div class="mdmiddle_b_c"> </div>
    </div>
    <!--mdmiddle_b--> 
  </div>
  <!--mdmiddle--> 
</div>
<!--外框-->

<script>
	$(document).ready(function(){
		$("#CartShowAllBtn").click(function () {
			$("#CartShowAll").slideToggle();
			_imgLiquid();
		});
	});
</script>