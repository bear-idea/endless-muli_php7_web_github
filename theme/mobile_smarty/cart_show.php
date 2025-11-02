<style type="text/css">
#notes1{width:120px}
.InnerButtom{margin-right:2px;margin-top:5px;margin-bottom:5px}
.InnerButtom a{font-weight:700;border:1px solid #CCC;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;text-shadow:0 1px 1px #fff;-webkit-box-shadow:0 1px 1px #fff;-moz-box-shadow:0 1px 1px #fff;box-shadow:0 1px 1px #fff;padding:4px 8px;white-space:nowrap;vertical-align:middle;color:#999;background:transparent;cursor:pointer;font-family:Sans-Serif;font-size:11px}
.InnerButtom a:hover,.InnerButtom a:focus{font-weight:700;border-color:#999;background:-webkit-linear-gradient(top,white,#E0E0E0);background:-moz-linear-gradient(top,white,#E0E0E0);background:-ms-linear-gradient(top,white,#E0E0E0);background:-o-linear-gradient(top,white,#E0E0E0);-webkit-box-shadow:0 1px 2px rgba(0,0,0,0.25),inset 0 0 3px #fff;-moz-box-shadow:0 1px 2px rgba(0,0,0,0.25),inset 0 0 3px #fff;box-shadow:0 1px 2px rgba(0,0,0,0.25),inset 0 0 3px #fff;color:#333;text-decoration:none}
.InnerButtom a:active{font-weight:700;color:#666;border:1px solid #AAA;border-bottom-color:#CCC;border-top-color:#999;-webkit-box-shadow:inset 0 1px 2px #aaa;-moz-box-shadow:inset 0 1px 2px #aaa;box-shadow:inset 0 1px 2px #aaa;background:-webkit-linear-gradient(top,#E6E6E6,gainsboro);background:-moz-linear-gradient(top,#E6E6E6,gainsboro);background:-ms-linear-gradient(top,#E6E6E6,gainsboro);background:-o-linear-gradient(top,#E6E6E6,gainsboro)}
.small-button{ cursor: pointer; font-size:30px; vertical-align:middle; color:#999}
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
            <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $Lang_Title_Cart_Show; // 標題文字 ?></span></h1>
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
            <?php if($totalRows_RecordCartlist > 0){ ?>
            <div style="-moz-box-shadow:0px 0px 1px rgba(0,0,0,.6); -webkit-box-shadow:0px 0px 1px rgba(0,0,0,.6); box-shadow:0px 0px 1px rgba(0,0,0,.6); background-color: rgba(255, 255, 255, 0.6); padding:10px;">
            <div class="row process-wizard process-wizard-info">
              <div class="col-xs-3 process-wizard-step active">
                <div class="text-center process-wizard-stepnum">Step 1</div>
                <div class="progress">
                  <div class="progress-bar"></div>
                </div>
                <a href="#" class="process-wizard-dot"></a>
                <div class="process-wizard-info text-center"><?php echo $Lang_Classify_Shopping_Process_Step_Confirmed; /* 確認購物車 */ ?></div>
              </div>
              <div class="col-xs-3 process-wizard-step disabled"><!-- complete -->
                <div class="text-center process-wizard-stepnum">Step 2</div>
                <div class="progress">
                  <div class="progress-bar"></div>
                </div>
                <a href="#" class="process-wizard-dot"></a>
                <div class="process-wizard-info text-center"><?php echo $Lang_Classify_Shopping_Process_Step_Pay; /* 付款與運送方式 */ ?></div>
              </div>
              <div class="col-xs-3 process-wizard-step disabled"><!-- complete -->
                <div class="text-center process-wizard-stepnum">Step 3</div>
                <div class="progress">
                  <div class="progress-bar"></div>
                </div>
                <a href="#" class="process-wizard-dot"></a>
                <div class="process-wizard-info text-center"><?php echo $Lang_Classify_Shopping_Process_Step_Edit; /* 資料填寫 */ ?></div>
              </div>
              <div class="col-xs-3 process-wizard-step disabled"><!-- active -->
                <div class="text-center process-wizard-stepnum">Step 4</div>
                <div class="progress">
                  <div class="progress-bar"></div>
                </div>
                <a href="#" class="process-wizard-dot"></a>
                <div class="process-wizard-info text-center"><?php echo $Lang_Classify_Shopping_Process_Step_Order; /* 確認訂單 */ ?></div>
              </div>
            </div>
            </div>
            <div style="height:5px;"></div>
            <form action="" method="post" name="form_Discount" id="form_Discount">
              
              <div style="-moz-box-shadow:0px 0px 1px rgba(0,0,0,.6); -webkit-box-shadow:0px 0px 1px rgba(0,0,0,.6); box-shadow:0px 0px 1px rgba(0,0,0,.6); background-color: rgba(255, 255, 255, 0.6); padding:10px;">
			    <?php echo $Lang_Classify_Context_Cart_Order_Total; //共?> <span style="color:#F00"><?php echo $totalRows_RecordCartlist; ?></span> 項商品
                <div class="divider" style="margin:10px 0"></div>
                <?php $NO = 1;?>
                <?php $_SESSION['Total'] = 0; $_SESSION['PlusTotal'] = 0; $_SESSION['itemTotal'] = 0; $_SESSION['TotalOriginalPrice'] = 0; // 初始化總金額避免累加?>
                <?php //$val = ''; $i = 0; // 初始化?>
                <?php // ======== 商品列表 ======== ?>
                <?php $DiscountShowAll = array(); $DiscountShowAllNot = array(); ?>
                <?php do { ?>
                <div class="row nomargin">
                  <div class="col-md-2 col-sm-2 col-xs-2">
                    <div class="shop-item margin-bottom-10">
                      <div class="imgLiquid" data-fill="<?php echo $TmpProductImageMethods; /* resize or crop */ ?>" data-board="<?php echo $TmpProductImageBoard; /* 方型 or 矩形 */ ?>"><a><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/product/<?php echo $row_RecordCartlist['pic']; ?>" alt=""/></a>
                        <div style="clear:both"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-10 col-sm-10 col-xs-10"> <span class="label label-danger pull-right"><a href="<?php echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'showpage'),'',$UrlWriteEnable);?><?php echo $id_del_params; ?><?php echo $row_RecordCartlist['id']; ?>" style="color:#FFF"><i class="fa fa-trash"></i></a></span>
                    <?php if($row_RecordCartlist['pdseries'] == '') {} else { echo $row_RecordCartlist['pdseries']; } ?>
                    <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'cartdetailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordCartlist['pid']; ?>" style="font-size:16px;"><?php echo $row_RecordCartlist['name']; ?></a>
                    <input name="id[]" type="hidden" id="id[]" value="<?php echo $row_RecordCartlist['id']; ?>" />
                    <?php if($row_RecordCartlist['Format'] != "") { ?>
                    <br />
                    <span class="keytag">
                    <?php $arr_tag = explode(';', $row_RecordCartlist['Format']); for($fi = 0; $fi < count($arr_tag); $fi++){ echo "<a>".$arr_tag[$fi]."</a>";}?>
                    </span>
                    <?php } ?>
                    <?php if($row_RecordCartlist['SpFormat'] != "") { ?>
                    <span class="keytag"><?php echo "<a>".$row_RecordCartlist['SpFormat']."</a>";?></span>
                    <?php } ?>
                    <br />
                    <?php 
                                /* 判斷是否採用優惠價格 */ 
								require("require_cart_discount_show.php"); /* 取得此商品目前優惠 */
								require("require_cart_discount_show_type.php"); /* 取得此商品該優惠項目所有購物清單 */
								if ($row_RecordDiscountShow['type'] !='' && $row_RecordCartlist['price'] !='' && $totalRows_RecordDiscountShow > 0) { /* 判斷是否有折扣活動 */
								  switch($row_RecordCartlist['discounttype'])
									{
										case "0":
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
									if($row_RecordCartlist['spprice'] != '')
									{
								?>
                    <s style=" color:#999"><?php echo $Lang_Classify_Context_Currency_units . $row_RecordCartlist['price'] ?></s> <?php echo $Lang_Classify_Context_Currency_units . $row_RecordCartlist['spprice']; ?>
                    <?php
										 
									}else{
										echo $Lang_Classify_Context_Currency_units . $row_RecordCartlist['price']; 
									}
								} /* \判斷是否有折扣活動 */
                        ?>
                  </div>
                </div>
                <div class="row nomargin">
                  <div class="col-md-6 col-sm-6 col-xs-6">
                    <div style="min-width:120px;"> <span onclick="MinustoCart('<?php echo $row_RecordCartlist['id']; ?>');" id="min-button<?php echo $row_RecordCartlist['id']; ?>" class="small-button"><i class="fa fa-minus-square" aria-hidden="true"></i></span>
                      <input name="Modify[]" id="Modify[]" value="<?php echo $row_RecordCartlist['quantity'] ?>" size="2" readonly>
                      <span onclick="PlustoCart('<?php echo $row_RecordCartlist['id']; ?>');" id="add-button<?php echo $row_RecordCartlist['id']; ?>" class="small-button"><i class="fa fa-plus-square" aria-hidden="true"></i></span> </div>
                  </div>
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
                                    //echo $CanDiscountType;
									if($CanDiscountType == 'All'){
										$_SESSION['itemTotal'] = $discountprice * $row_RecordCartlist['quantity'];
										$_SESSION['Total'] += $_SESSION['itemTotal'];	
										echo "<span style=\"font-size:14px;\">折扣後</span>" . $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal']);
										// 記錄目前優惠
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllOk)){$DiscountShowAllOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discount'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']] = ($row_RecordCartlist['price']*$row_RecordCartlist['quantity']) - $_SESSION['itemTotal'];
										echo "<div style=\"font-size:14px; color:#CCC\">省" . $Lang_Classify_Context_Currency_units . doFormatMoney($DiscountShowAll[$row_RecordDiscountShow['id']]['discount'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']]) . "</div>";
										
									}else if($CanDiscountType == 'Part'){
										$_SESSION['itemTotal'] = $discountprice * $CanDiscount;
										$_SESSION['itemTotal'] += $row_RecordCartlist['price'] * ($row_RecordCartlist['quantity']-$CanDiscount);
										$_SESSION['Total'] += $_SESSION['itemTotal'];	
										echo "<span style=\"font-size:14px;\">折扣後</span>" .  $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal']);
										// 記錄目前優惠
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllOk)){$DiscountShowAllOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllNotOk)){$DiscountShowAllNotOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discount'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']] = ($row_RecordCartlist['price']*$row_RecordCartlist['quantity']) - $_SESSION['itemTotal'];
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discountnot'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']] = ($row_RecordCartlist['price']-$discountprice)*($row_RecordCartlist['quantity']-$CanDiscount);
										$DiscountShowAll[$row_RecordDiscountShow['id']]['numnot'] = $row_RecordDiscountShow['discountPieces']-($totalDiscountCountQuantity%$row_RecordDiscountShow['discountPieces']);
										echo "<div style=\"font-size:14px; color:#CCC\">省" . $Lang_Classify_Context_Currency_units . doFormatMoney($DiscountShowAll[$row_RecordDiscountShow['id']]['discount'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']]) . "</div>";
										//echo "購物車所有商品總數" . $totalDiscountCountQuantity;
										//echo $row_RecordDiscountShow['discountPieces'];
										
									}else if($CanDiscountType == 'None'){
										$_SESSION['itemTotal'] = $row_RecordCartlist['price'] * $row_RecordCartlist['quantity'];
										$_SESSION['Total'] += $_SESSION['itemTotal'];	
										echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal']);
										// 記錄目前優惠
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllNotOk)){$DiscountShowAllNotOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discountnot'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']] = ($row_RecordCartlist['price']-(ceil($row_RecordCartlist['price'] * ($row_RecordDiscountShow['discountFoldnumber']/100))))*($row_RecordCartlist['quantity']);
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
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discount'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']] = 1; /* 僅判斷是否有折扣 */
										$DiscountShowAll[$row_RecordDiscountShow['id']]['pieces'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']] = $row_RecordCartlist['quantity']; /* 可折扣總件數 */
											
									}else if($CanDiscountType == 'Part'){
										$_SESSION['itemTotal'] = $row_RecordCartlist['price'] * $row_RecordCartlist['quantity'];
										$_SESSION['Total'] += $_SESSION['itemTotal'];	
										echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal']);
										// 記錄目前優惠
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllOk)){$DiscountShowAllOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllNotOk)){$DiscountShowAllNotOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discount'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']] = 1; /* 僅判斷是否有折扣 */
										$DiscountShowAll[$row_RecordDiscountShow['id']]['pieces'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']]  = $CanDiscount; /* 可折扣總件數 需除限制條件 */
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discountnot'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']] = 0;
										$DiscountShowAll[$row_RecordDiscountShow['id']]['numnot'] = $row_RecordDiscountShow['discountPieces']-($totalDiscountCountQuantity%$row_RecordDiscountShow['discountPieces']);
										
									}else if($CanDiscountType == 'None'){
										$_SESSION['itemTotal'] = $row_RecordCartlist['price'] * $row_RecordCartlist['quantity'];
										$_SESSION['Total'] += $_SESSION['itemTotal'];	
										echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal']);
										// 記錄目前優惠
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllNotOk)){$DiscountShowAllNotOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discountnot'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']] = 0;
										$DiscountShowAll[$row_RecordDiscountShow['id']]['numnot'] = $row_RecordDiscountShow['discountPieces']-($totalDiscountCountQuantity%$row_RecordDiscountShow['discountPieces']); /* 未符合條件數量 */
										
									}
									//echo $row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid'];
									//var_dump($DiscountShowAll[$row_RecordDiscountShow['id']]['pieces']);
									break;
								case "2":
									//echo "滿額折扣";
									if($CanDiscountType == 'All'){
										$_SESSION['itemTotal'] = $discountprice * $row_RecordCartlist['quantity'];
										$_SESSION['Total'] += $_SESSION['itemTotal'];	
										echo "<span style=\"font-size:14px;\">折扣後</span>" . $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal']);
										// 記錄目前優惠
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllOk)){$DiscountShowAllOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discount'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']] = ($row_RecordCartlist['price']*$row_RecordCartlist['quantity']) - $_SESSION['itemTotal'];
										echo "<div style=\"font-size:14px; color:#CCC\">省" . $Lang_Classify_Context_Currency_units . doFormatMoney($DiscountShowAll[$row_RecordDiscountShow['id']]['discount'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']]) . "</div>";
										
									}else if($CanDiscountType == 'None'){
										$_SESSION['itemTotal'] = $row_RecordCartlist['price'] * $row_RecordCartlist['quantity'];
										$_SESSION['Total'] += $_SESSION['itemTotal'];	
										echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal']);
										// 記錄目前優惠
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllNotOk)){$DiscountShowAllNotOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discountnot'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']] = ($row_RecordCartlist['price']-(ceil($row_RecordCartlist['price'] * ($row_RecordDiscountShow['discountFoldnumber']/100))))*($row_RecordCartlist['quantity']); /* 可折扣優惠價 */
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
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discount'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']] = 1; /* 僅判斷是否有折扣 */
										$DiscountShowAll[$row_RecordDiscountShow['id']]['itemprice'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']] = $row_RecordCartlist['price'] * $row_RecordCartlist['quantity']; /* 目前總共多少錢 */
											
									}else if($CanDiscountType == 'None'){
										$_SESSION['itemTotal'] = $row_RecordCartlist['price'] * $row_RecordCartlist['quantity'];
										$_SESSION['Total'] += $_SESSION['itemTotal'];	
										echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal']);
										// 記錄目前優惠
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllNotOk)){$DiscountShowAllNotOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discountnot'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']] = ($row_RecordCartlist['price']-(ceil($row_RecordCartlist['price'] * ($row_RecordDiscountShow['discountFoldnumber']/100))))*($row_RecordCartlist['quantity']); /* 可折扣優惠價 */
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
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discount'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']] = 1; /* 僅判斷是否有折扣 */
										$DiscountShowAll[$row_RecordDiscountShow['id']]['itemprice'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']] = $row_RecordCartlist['price'] * $row_RecordCartlist['quantity']; /* 目前總共多少錢 */
										$DiscountShowAll[$row_RecordDiscountShow['id']]['pieces'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']] = $row_RecordCartlist['quantity']; /* 可折扣總件數 */
										$DiscountShowAll[$row_RecordDiscountShow['id']]['price'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']]  = 0;
											
									}else if($CanDiscountType == 'Part'){
										$_SESSION['itemTotal'] = $row_RecordCartlist['price'] * $row_RecordCartlist['quantity'];
										$_SESSION['Total'] += $_SESSION['itemTotal'];	
										echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal']);
										// 記錄目前優惠
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllOk)){$DiscountShowAllOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllNotOk)){$DiscountShowAllNotOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discount'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']] = 1; /* 僅判斷是否有折扣 */
										$DiscountShowAll[$row_RecordDiscountShow['id']]['itemprice'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']] = $row_RecordCartlist['price'] * $row_RecordCartlist['quantity']; /* 目前總共多少錢 */
										$DiscountShowAll[$row_RecordDiscountShow['id']]['pieces'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']]  = $CanDiscount; /* 可折扣總件數 需除限制條件 */
										$DiscountShowAll[$row_RecordDiscountShow['id']]['price'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']]  = $row_RecordCartlist['price']*($row_RecordCartlist['quantity']-$CanDiscount);
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discountnot'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']] = 0;
										$DiscountShowAll[$row_RecordDiscountShow['id']]['numnot'] = $row_RecordDiscountShow['discountPieces']-($totalDiscountCountQuantity%$row_RecordDiscountShow['discountPieces']);
										
									}else if($CanDiscountType == 'None'){
										$_SESSION['itemTotal'] = $row_RecordCartlist['price'] * $row_RecordCartlist['quantity'];
										$_SESSION['Total'] += $_SESSION['itemTotal'];	
										echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal']);
										// 記錄目前優惠
										if(!in_array($row_RecordCartlist['discountid'], (array)$DiscountShowAllNotOk)){$DiscountShowAllNotOk[] = $row_RecordCartlist['discountid']; /* 記錄優惠筆數 */}
										//$DiscountShowAll[$row_RecordDiscountShow['id']]['price']  = $row_RecordCartlist['price'];
										$DiscountShowAll[$row_RecordDiscountShow['id']]['discountnot'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']] = 0;
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
									//$DiscountShowAll[$row_RecordDiscountShow['id']]['discount'][$row_RecordCartlist['id'] . '_' . $row_RecordCartlist['pid']];
								} else { /* 判斷是否有折扣活動 */
									if($row_RecordCartlist['spprice'] != '')
									{
										//echo "<span class=\"label label-danger\" style=\"margin-right:2px;\">特價</span>";
									}else{
									}
								} /* \判斷是否有折扣活動 */
				  ?>
                  </div>
                  <div class="divider" style="margin:10px 0"></div>
                </div>
                <?php } while ($row_RecordCartlist = mysqli_fetch_assoc($RecordCartlist)); ?>
              </div>

              <?php require("require_cart_discount_show_all.php");  /* 列出商品全部優惠情形 */?>
              
              <input type="hidden" name="MM_update" value="form_Discount" />
            </form>
            <div style="height:5px;"></div>
            <div style="-moz-box-shadow:0px 0px 1px rgba(0,0,0,.6); -webkit-box-shadow:0px 0px 1px rgba(0,0,0,.6); box-shadow:0px 0px 1px rgba(0,0,0,.6); background-color: rgba(255, 255, 255, 0.6); padding:10px;">
            <div class="row nomargin">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                  </div>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                      <div class="row">
                      	<div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666;"><?php echo "商品金額小計"; ?></div>
                        <div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666; font-weight:bolder;"><?php echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['TotalOriginalPrice']); ?></div>
                        <?php if ($DiscountShowAlldiscount_type_spprice != "") { ?>
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
                        
                        <?php 
						//計算總金額
						$_SESSION['Total'] = $_SESSION['Total'] + $_SESSION['PlusTotal'];
						// 商品金額 + 運費 + 
						$OCTotal = $_SESSION['Total'];
						//echo $Lang_Classify_Context_Currency_units . doFormatMoney($OCTotal);
						?>
                        <?php require("require_cart_shoppingcosts_order.php"); ?>
                        <?php 
						// 計算全單滿額折扣價格
						$_SESSION['Total'] = $OCTotal - $DiscountShowAlldiscount_type_5 - $DiscountShowAlldiscount_type_6;
						?>
                      </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="divider" style="margin:5px 0" ></div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                  </div>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                      <div class="row">
                      	<div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right; color:#666; padding-top:10px;"><?php echo "折扣後小計"; ?></div>
                        <div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right;"><h3><strong><font color="#FF0000"><?php $_SESSION['Total'] = $_SESSION['Total'] + $_SESSION['PlusTotal']; echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['Total']); ?></font></strong></h3><span style="color:#999"><?php echo $Lang_Classify_Context_Cart_NoFreight; //(不含運費) ?></span></div>
                      </div>
                  </div>
            </div>
            
            </div>
            <br />
            <div class="row nomargin">
              <div class="form-group text-center" >
                <div class="col-md-12 col-sm-12 col-xs-12 margin-top-50">
                  <div class="col-md-4 col-sm-4 col-xs-4"> <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>" class="btn btn-3d label-primary btn-block" style="color:#FFF;"><?php echo $Lang_Classify_Context_Cart_Continue_Shopping ?></a> </div>
                  <div class="col-md-4 col-sm-4 col-xs-4"> <a href="<?php echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'flow'),'',$UrlWriteEnable);?>" onclick="$('.steps').steps('prev');" class="btn btn-3d btn-danger btn-block" style="color:#FFF;"><?php echo $Lang_Classify_Next ?></a> </div>
                  <div class="col-md-4 col-sm-4 col-xs-4"> <a href="<?php echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'clearpage'),'',$UrlWriteEnable);?>" class="btn btn-3d btn-warning btn-block" style="color:#FFF;"><?php echo $Lang_Classify_Context_Cart_Clear ?></a> </div>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
            <br />
            <?php } else { ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><table width="250" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="61"><img src="<?php echo $SiteBaseUrl; ?>images/error_tip.png" width="60" height="60" /></td>
                      <td width="189"><?php echo $Lang_Classify_Cart_Removed; ?></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td align="center"><?php echo $Lang_Classify_Context_Cart_Continue_Buy_Buttom ?><br />
                  <br />
                  <span class="InnerButtom"><a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $Lang_Classify_Context_Cart_Continue_Shopping ?></a></span></td>
              </tr>
            </table>
            <?php 
        } 
        ?>
            <br />
            <div style="background-color:#EE4128; color:#FFF; padding:10px;"><?php echo $Lang_Classify_Context_Mail_Send_Message ?></div>
            <div class="ct_board" style="background-color:#FFF7F0; border:1px #FBC4B0 solid; padding:10px;"> <?php echo $CartDesc; ?> </div>
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
<script type="text/javascript">
function PlustoCart(id) {
	var rtn;
	var qu = $('#add-button'+id).val();
	$.ajax({    
		url:"<?php echo $SiteBaseUrl ?>ajax/cart_add_check.php?" + "id=" + id + "&wshop=<?php echo $_GET['wshop']; ?>&qu=" + qu + "&time()",
		type: "GET",
		async:false, 
		success: function(data){
			if(data != ""){
				var rt = "0"; // 錯誤訊息傳回
				rtn = data;
			}else{
				var rt = "1"; // 正確無訊息
				rtn = data;	
			}	
		} //\ success
	}); // \ ajax
	
	if(rtn != "") {
		alert(rtn);
		return false;
	}else{
		b_value = $('#add-button'+id).prev().val();
		b_value++;
		$('#add-button'+id).prev().val(b_value);
		//alert(rt);
		//return false; //不送出form 
		document.form_Discount.submit();
	}
}

function MinustoCart(id) {
	b_value = $('#min-button'+id).next().val();
	b_value--;
	if(b_value <= 0) {b_value = 1;}
	$('#min-button'+id).next().val(b_value);
	//alert($b_value);
	//return true; //不送出form 
	document.form_Discount.submit()
}
</script> 
