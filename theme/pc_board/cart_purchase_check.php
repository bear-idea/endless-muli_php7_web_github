<?php // 判斷是否勾選同訂購人 ?>
<?php 
if($_POST['autoinputpurchaser'] == "1") {
	$_POST['ocname'] = $_POST['ocbuyname'];
    $_POST['ocphone'] = $_POST['ocbuyphone'];
    $_POST['octel'] = $_POST['ocbuytel'];
	$_POST['ocmail'] = $_POST['ocbuymail'];
}
?>
<style type="text/css">
.Cart_Purchase tr td{margin:5px;padding:5px;border:1px solid #ddd}
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
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $Lang_Title_Cart_Purchase_Check; // 標題文字 ?></span></h1>
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
<div class="columns on-1">
    <div class="container board">
    <div class="column">
      <div class="container ct_board">
      
      <ul class="progress-indicator">
            <li class="completed">
                <span class="bubble"></span>
                <i class="fa fa-check-circle"></i>
                <?php echo $Lang_Classify_Shopping_Process_Step_Confirmed; //確認購物車 ?>
            </li>
            <li class="completed">
                <span class="bubble"></span>
                <i class="fa fa-check-circle"></i>
                <?php echo $Lang_Classify_Shopping_Process_Step_Pay; //付款與運送方式 ?>
            </li>
            <li class="completed">
                <span class="bubble"></span>
                <i class="fa fa-check-circle"></i>
                <?php echo $Lang_Classify_Shopping_Process_Step_Edit; //資料填寫 ?>
            </li>
            <li class="completed">
                <span class="bubble"></span>
                <i class="fa fa-check-circle"></i>
                <?php echo $Lang_Classify_Shopping_Process_Step_Order; //確認訂單?>
            </li>
        </ul>
        
		<?php if(isset($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'] ) && count($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'])>0){ ?>
        <?php if($_POST['ocpaymentselect'] == 'allpay' || $_POST['ocpaymentselect'] == 'allpay_Credit' || $_POST['ocpaymentselect'] == 'allpay_BARCODE' || $_POST['ocpaymentselect'] == 'allpay_CVS') { $editFormAction = $SiteBaseUrl . "allpay_order_send_cart.php"; } ?>
        <?php if($_POST['ocpaymentselect'] == 'pchomepay') { $editFormAction = $SiteBaseUrl . "pchomepay_order_send_cart.php"; } ?>
        <?php if($_POST['ocpaymentselect'] == 'paypal') { $editFormAction = $SiteBaseUrl . "paypal_order_send_cart.php"; } ?>
        <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
        <?php echo $Lang_Title_Cart_Order_Number; //訂單編號 ?>：<font color="#0033FF"><?php echo $_SESSION['OrderID']; ?></font><input name="D_OrderID" type="hidden" id="D_OrderID" value="<?php echo $_SESSION['OrderID']; ?>" /> <br />
        <br />
        <div class="table-responsive">
          <table width="100%" border="0" cellspacing="0" cellpadding="0"class="TB_General_style01 table">
          <tr>
            <td width="50"><strong><?php echo $Lang_Classify_Context_Cart_Number; //編號 ?></strong></td>
            <td width="70"><strong><?php echo $Lang_Classify_Context_Pdseries_Product; //貨號 ?></strong></td>
            <td><strong><?php echo $Lang_Classify_Context_Name_Product; //商品名稱 ?></strong></td>
            <td width="100"><strong><?php echo $Lang_Classify_Context_Price_Product; //價格 ?></strong></td>
            <td width="70"><strong><?php echo $Lang_Classify_Context_Num_Product; //數量 ?></strong></td>
            <td width="120"><strong><?php echo $Lang_Classify_Context_Cart_Note; //備註 ?></strong></td>
            <td width="70"><strong><?php echo $Lang_Classify_Context_Cart_Subtotal; //小計 ?></strong></td>
          </tr>
          <?php foreach($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'] as $i => $val) { ?>
          <tr>
            <td><?php echo $i+1; ?></td>
            <td><?php if($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['PdSeries'][$i] == '') {echo "------";} else { echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['PdSeries'][$i]; } ?>
              <input name="pdseries[]" type="hidden" id="pdseries[]" value="<?php echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['PdSeries'][$i]; ?>" /></td>
            <td><?php echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Name'][$i]; ?>
        <input name="dcproductname[]" type="hidden" id="dcproductname[]" value="<?php echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Name'][$i]; ?>" />
        <?php // 取得商品id ------------------------------------- ?>
		<input name="pid[]" type="hidden" id="pid[]" value="<?php echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'][$i]; ?>" />
        <?php // 取得商品id ------------------------------------- ?>
		<?php if($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Format'][$i] != "") { ?><br /><div class="keytag"><?php $arr_tag = explode(';', $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Format'][$i]); for($fi = 0; $fi < count($arr_tag); $fi++){ echo "<a>".$arr_tag[$fi]."</a>";}?></div><?php } ?><input name="dcformat[]" type="hidden" id="dcformat[]" value="<?php echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Format'][$i]; ?>" /><?php if($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['SpFormat'][$i] != "") { ?><div class="keytag"><?php echo "<a>".$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['SpFormat'][$i]."</a>";?></div><input name="dcspformat[]" type="hidden" id="dcspformat[]" value="<?php echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['SpFormat'][$i]; ?>" /><?php } ?></td>
            <td><?php
                                // 判斷是否採用優惠價格 
                                if($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['SpPrice'][$i] != '')
                                {
                                    echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['SpPrice'][$i];
									$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Price'][$i] = $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['SpPrice'][$i];
                            ?>
                                    <span style="font-size:9px; background-color:#FF9393; color:#FFF; padding:2px;"><?php echo $Lang_Classify_Context_Spprice_Product; //特價 ?></span>
                            <?php
                                     
                                }else{
                                    echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Price'][$i]; 
                                }
                            ?>
              <input name="dcprice[]" type="hidden" id="dcprice[]" value="<?php echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Price'][$i]; ?>" /></td>
            <td><?php echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i] ?>
              <input name="dcquantiry[]" type="hidden" id="dcquantiry[]" value="<?php echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i]; ?>" /></td>
            <td><?php echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Notes1'][$i] ?>
              <input name="dcnotes1[]" type="hidden" id="dcnotes1[]" value="<?php echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Notes1'][$i]; ?>" /></td>
            <td><?php echo '$' . doFormatMoney($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['itemTotal'][$i]); ?>
              <input name="dcitemtotal[]" type="hidden" id="dcitemtotal[]" value="<?php echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['itemTotal'][$i]; ?>" /></td>
          </tr>
          <?php if(is_array($_SESSION['PlusId'][$val])) {  ?> 
                          <?php // ======== 加購商品列表 ======== ?>
                            
                              <?php foreach($_SESSION['PlusId'][$val] as $k => $val2) { ?>
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><?php echo $_SESSION['PlusName'][$val][$k]; ?>&nbsp;<span style="font-size:9px; background-color:#FF8000; color:#FFF; padding:2px;"><?php echo $Lang_Classify_Context_Cart_Purchase_Price; //加購 ?></span>
                                <input name="dcproductplusname[]" type="hidden" id="dcproductplusname[]" value="<?php echo $_SESSION['PlusName'][$val][$k]; ?>" /></td>
                                <td><?php echo $_SESSION['PlusPrice'][$val][$k]; ?>
                                <input name="dcproductplusprice[]" type="hidden" id="dcproductplusprice[]" value="<?php echo $_SESSION['PlusPrice'][$val][$k]; ?>" /></td>
                                <td><?php echo $_SESSION['PlusQuantity'][$val][$k]; ?>
                                <input name="dcproductplusquantity[]" type="hidden" id="dcproductplusquantity[]" value="<?php echo $_SESSION['PlusQuantity'][$val][$k]; ?>" /></td>
                                <td>&nbsp;</td>
                                <td><?php //小計與總價格
                                $_SESSION['PlusitemTotal'][$k] = $_SESSION['PlusPrice'][$val][$k] * $_SESSION['PlusQuantity'][$val][$k];
                                echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['PlusitemTotal'][$k]);
                                $_SESSION['PlusTotal'] += $_SESSION['PlusitemTotal'][$k];
                            ?>
                                <input name="dcplusitemtotal[]" type="hidden" id="dcplusitemtotal[]" value="<?php echo $_SESSION['PlusitemTotal'][$k]; ?>" /></td>
                              </tr>
                              <?php } ?>
                              
                          <?php // ======== 加購商品列表 END======== ?>
                          <?php } // if?>
          <?php } ?>
        </table>
        </div>
        <br />
        <?php // 滿額免運費折抵 ?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Cart_Purchase">
            <tr>
              <td colspan="2"><h3><i class="fa fa-pencil-square-o"></i><?php echo $Lang_Title_Cart_Subscriber_Basic_Information ?></h3></td>
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
              <td align="right"><?php echo $Lang_Classify_Context_Cart_Mail; //電子郵件 ?>：</td>
              <td><?php echo $_POST['ocbuymail']; ?>
                <input name="ocbuymail" type="hidden" id="ocbuymail" value="<?php echo $_POST['ocbuymail']; ?>" /></td>
            </tr>
            <tr>
              <td colspan="2"><h3><i class="fa fa-pencil-square-o"></i> <?php echo $Lang_Title_Cart_Consignee_Basic_Information; //收貨人基本資料 ?></h3></td>
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
              <td align="right"><?php echo $Lang_Classify_Context_Cart_Mail; //電子郵件 ?>：</td>
              <td><?php echo $_POST['ocmail']; ?>
                <input name="ocmail" type="hidden" id="ocmail" value="<?php echo $_POST['ocmail']; ?>" /></td>
            </tr>
            <?php if ($row_RecordSystemConfigOtr['invoiceenable'] == '1') { ?>
            <tr>
              <td colspan="2"><h3><i class="fa fa-pencil-square-o"></i> <?php echo $Lang_Classify_Context_Cart_Invoice_Content; //發票內容 ?></h3></td>
              </tr>
            <tr>
              <td align="right"><?php echo $Lang_Classify_Context_Cart_Invoice_Type; //發票類型 ?>：</td>
              <td>
              <?php 
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
              <input name="ocinvoiceformat" type="hidden" id="ocinvoiceformat" value="<?php echo $_POST['invoiceformat']; ?>" />
              </td>
            </tr>
            <?php if ($_POST['invoiceformat'] == "3") { ?>
            <tr>
              <td align="right"><?php echo $Lang_Classify_Context_Cart_Electronic_Invoice; //電子發票 ?>：</td>
              <td>
              <?php
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
              <input name="ocinvoiceetselect" type="hidden" id="ocinvoiceetselect" value="<?php echo $_POST['ocinvoiceetselect']; ?>" />
              
              </td>
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
              <td colspan="2"><h3><i class="fa fa-pencil-square-o"></i> <?php echo $Lang_Classify_Context_Cart_Payment_And_Shipping_Information; //付款、出貨資料 ?></h3></td>
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
<input name="ocaddr" type="hidden" id="ocaddr" value="<?php echo $_POST['ocaddr']; ?>" /><?php if($_POST['ocCVSStoreID'] != "") { ?>【<?php echo $_POST['ocCVSStoreName']; // 商店名稱?>】<input name="ocCVSStoreName" type="hidden" id="ocCVSStoreName" value="<?php echo $_POST['ocCVSStoreName']; ?>" /><input name="ocCVSStoreID" type="hidden" id="ocCVSStoreID" value="<?php echo $_POST['ocCVSStoreID']; ?>" /><?php } ?></td>
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
              <td align="right"><?php echo $Lang_Classify_Context_Cart_Money; //金額 ?>：</td>
              <td>
              <?php echo $Lang_Classify_Context_Cart_Totol_Price; //目前商品總金額 ?>：<font color="#FF0000"><?php echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['Total']); ?></font>
              <?php //echo "是否使用貨運" . $_POST['ocfreightselectno']; ?>
              <?php if ($_POST['ocfreightselectno'] != 1) { // 當有設定貨運方式才會判斷 1代表沒有貨運方式?>
              <?php //echo "是否使用貨運" . $_POST['ocfreightselectno']; ?>
              <br /><?php echo $Lang_Classify_Context_Cart_Current_Shipping_Costs; //目前運費 ?>：
              <?php 
			  switch($_POST['ocfreightselect'])
			  {
				  case "sevenshop": // 7-11 超商取貨付款
				  $_POST['ocfreight'] = $row_RecordSystemConfigOtr['sevenshopshipment'];
				  $rFreight = "7-11 超商取貨(取貨付款)"; // 運費名稱
				  break;
				  case "sevenshopnopay": // 7-11 超商取貨不付款
				  $_POST['ocfreight'] = $row_RecordSystemConfigOtr['sevenshopnopayshipment'];
				  $rFreight = "7-11 超商取貨(純配送)"; // 運費名稱
				  break;
				  case "familyshop": // 全家超商取貨付款
				  $_POST['ocfreight'] = $row_RecordSystemConfigOtr['familyshopshipment'];
				  $rFreight = "全家超商取貨(取貨付款)"; // 運費名稱
				  break;
				  case "familyshopnopay": // 全家超商取貨不付款
				  $_POST['ocfreight'] = $row_RecordSystemConfigOtr['familyshopnopayshipment'];
				  $rFreight = "全家超商取貨(純配送)"; // 運費名稱
				  break;
				  default:
			  ?>
              <?php 
			  /*****************************************************************************************/
			  // 自訂運費判斷
			  /*****************************************************************************************/
			  ?>
			  <?php do {  ?>
              <?php
			  if (!(strcmp($row_RecordCartListFreight['item_id'], $_POST['ocfreightselect']))) {
			  $rFreight = $row_RecordCartListFreight['itemname']; // 運費名稱
			  // --------- 運費價格計算 ----------
			  switch($row_RecordCartListFreight['mode'])
			  {
				case "0":
				    $_POST['ocfreight'] = 0;
					break;
				case "1":
				    if($row_RecordCartListFreight['modeselect'] == 0) // 全國
					{
						$_POST['ocfreight'] = $row_RecordCartListFreight['countryprice'];
					}
					if($row_RecordCartListFreight['modeselect'] == 1) // 分區
					{
						switch($_POST['occounty'])
						{
							//北部
							case "基隆市":
							case "台北市":
							case "新北市":
							case "新竹市":
							case "新竹縣":
							case "桃園市":
							case "桃園縣":
							$_POST['ocfreight'] = $row_RecordCartListFreight['northprice'];
							break;
							//中部
							case "台中市":
							case "彰化縣":
							case "苗栗縣":
							case "南投縣":
							$_POST['ocfreight'] = $row_RecordCartListFreight['centralprice'];
							break;
							//南部
							case "嘉義市":
							case "嘉義縣":
							case "雲林縣":
							case "台南市":
							case "高雄市":
							case "屏東縣":
							$_POST['ocfreight'] = $row_RecordCartListFreight['southprice'];
							break;
							//東部
							case "宜蘭縣":
							case "台東縣":
							case "花蓮縣":
							$_POST['ocfreight'] = $row_RecordCartListFreight['eastprice'];
							break;
							//外島
							case "金門縣":
							case "連江縣":
							case "澎湖縣":
							$_POST['ocfreight'] = $row_RecordCartListFreight['outerprice'];
							break;
							//非本國
							case "非台灣地區":
							$_POST['ocfreight'] = "-1";
							break;
						}
					}
					break;
				case "2":
				    $_POST['ocfreight'] = "-1";
					break;
				case "3":
				    $_POST['ocfreight'] = $_POST['userinputfreight' . $row_RecordCartListFreight['item_id']];
					break;
			  }
			  // --------- 是否要向消費者加收手續費? ----------
			  //echo $row_RecordCartListFreight['productcomeselect'];
			  switch($row_RecordCartListFreight['productcomeselect'])
			  {
				case "0":
				break;
				case "1":
				$ocotherprice = $row_RecordCartListFreight['fixedprice']; // 固定加收
				break;
				case "2":
				// 依代收金額
				for($pi=0; $pi<=7; $pi++){
					if($pi==0)
					{
						$price_arr[] = 0;
					}else{
						if($row_RecordCartListFreight['dynamicprice' . $pi] != "") {
							$price_arr[] = $row_RecordCartListFreight['dynamicprice' . $pi];
						}
					}
				}
				/*for($pi=0; $pi<=count($price_arr); $pi++){
					echo $price_arr[$pi] . "<br/>";
				}*/
				$compare = $_SESSION['Total'];
				$checkprice = "0";
				for($i=0;$i<count($price_arr);$i++){
					//echo "如果" . $compare . "大於等於" . $price_arr[$i] . "且" . "如果" . $compare . "小於等於" . $price_arr[$i+1] . "<br/>";
					if( $compare>=$price_arr[$i] && $compare<=$price_arr[$i+1])
					{
						$checkprice=$i;
					}
				}
				break;
			  }
			  //echo $_POST['ocfreight'];
			  // --------- 運費價格計算 ----------
			   //echo $row_RecordCartListFreight['itemname'];
			   } 
			  ?>
              <?php
        } while ($row_RecordCartListFreight = mysqli_fetch_assoc($RecordCartListFreight));
          $rows = mysqli_num_rows($RecordCartListFreight);
          if($rows > 0) {
              mysqli_data_seek($RecordCartListFreight, 0);
              $row_RecordCartListFreight = mysqli_fetch_assoc($RecordCartListFreight);
          }
              ?>
              <?php 
			  /*****************************************************************************************/
			  // 自訂運費判斷
			  /*****************************************************************************************/
			  ?>
              <?php 
					break;
			  } //\switch
			  ?>
              <?php } // 當有設定貨運方式才會判斷 ?>
              <?php 
			  // --------- 滿額免運費計算 ----------
			  $freepriceok = 0;
			  if($row_RecordSystemConfigOtr['freepriceenable'] == "1") // 是否啟用滿額免運費
			  {
				  // 開始判斷滿額免運費";
				  if($_SESSION['Total'] > $row_RecordSystemConfigOtr['freeprice']) // 金額條件限制
				  {
					  // 超商取貨運費判斷 (超商取貨並不會送出忽略地區)
					  switch($_POST['ocfreightselect'])
					  {
						  case "sevenshop": // 7-11 超商取貨付款
						  case "sevenshopnopay": // 7-11 超商取貨不付款
						  case "familyshop": // 全家超商取貨付款
						  case "familyshopnopay": // 全家超商取貨不付款
						  
						  $_POST['ocfreight'] = 0; // 滿額免運
						  $freepriceok=1; // 滿額免運確認
						  
						  break;
					  }
					  // 
					  // 忽略地區
					  switch($_POST['occounty'])
						{
							//北部
							case "基隆市":
							case "台北市":
							case "新北市":
							case "新竹市":
							case "新竹縣":
							case "桃園市":
							case "桃園縣":
							if($row_RecordSystemConfigOtr['freepriceignorth'] == '1') {
							}else{
								$_POST['ocfreight'] = 0; // 滿額免運
								$freepriceok=1; // 滿額免運確認
							}
							break;
							//中部
							case "台中市":
							case "彰化縣":
							case "苗栗縣":
							case "南投縣":
							if($row_RecordSystemConfigOtr['freepriceigcenter'] == '1') {
							}else{
								$_POST['ocfreight'] = 0; // 滿額免運
								$freepriceok=1; // 滿額免運確認
							}
							break;
							//南部
							case "嘉義市":
							case "嘉義縣":
							case "雲林縣":
							case "台南市":
							case "高雄市":
							case "屏東縣":
							if($row_RecordSystemConfigOtr['freepriceigsourth'] == '1') {
							}else{
								$_POST['ocfreight'] = 0; // 滿額免運
								$freepriceok=1; // 滿額免運確認
							}
							break;
							//東部
							case "宜蘭縣":
							case "台東縣":
							case "花蓮縣":
							if($row_RecordSystemConfigOtr['freepriceigeast'] == '1') {
							}else{
								$_POST['ocfreight'] = 0; // 滿額免運
								$freepriceok=1; // 滿額免運確認
							}
							break;
							//外島
							case "金門縣":
							case "連江縣":
							case "澎湖縣":
							if($row_RecordSystemConfigOtr['freepriceigouter'] == '1') {
							}else{
								$_POST['ocfreight'] = 0; // 滿額免運
								$freepriceok=1; // 滿額免運確認
							}
							break;
							//非本國
							case "非台灣地區":
							if($row_RecordSystemConfigOtr['freepriceignotaiwan'] == '1') {
							}else{
								$_POST['ocfreight'] = 0; // 滿額免運
								$freepriceok=1; // 滿額免運確認
							}
							break;
						}
				  }
				  
			  }
			  ?>
              <?php if ($freepriceok != 1) { ?>
				  <?php if($_POST['ocfreight'] == '-1') { ?>
                      <?php $ocfreight = 0; $ocfreightprice = ""; $ocfreightdesc = "等待商家報價"; $freepricedesc = "等待商家報價"; $ocfreightstateonly = "2"; ?>
                      <span style="color:#FF0000">(<?php echo $Lang_Classify_Context_Waiting_For_Business_Offer; //等待商家報價 ?>)</span>
                  <?php } else if($_POST['ocfreight'] == ''){ ?>
                      <?php if ($_POST['ocfreightselectno'] == 1) { // 當有設定貨運方式才會判斷(1為未設定) ?>
                      	  <?php $ocfreightstateonly = "0"; ?>
                          <!--<span style="color:#FF0000">(購物車無貨運方式)</span>-->
                      <?php } else { // 當有設定貨運方式才會判斷 ?>
						  <?php $ocfreight = 0; $ocfreightprice = ""; $ocfreightdesc = "買家尚未填寫運費"; $freepricedesc = "買家尚未填寫運費"; $ocfreightstateonly = "1"; ?>
                          <span style="color:#FF0000">(<?php echo $Lang_Classify_Context_Buye_Has_Not_Yet_Filled_In_Freight; //買家尚未填寫運費 ?>)</span>
                      <?php } // 當有設定貨運方式才會判斷 ?>
                  <?php } else { ?>
                      <?php $ocfreightstateonly = "0"; ?>
                      <span style="color:#FF0000"><?php echo $Lang_Classify_Context_Currency_units . doFormatMoney($_POST['ocfreight']); ?></span>
                      <?php $ocfreightprice = $ocfreight = $_POST['ocfreight']; ?>
                  <?php } ?>
              <?php } else {  ?>
              	  <?php $ocfreight = 0; $ocfreightprice = 0; $ocfreightdesc = "滿額免運費"; ?>
                  <span style="color:#FF0000"><?php echo $Lang_Classify_Context_Currency_units . doFormatMoney($_POST['ocfreight']); ?></span>
                  <span style="color:#FF0000">(<?php echo $Lang_Classify_Context_Free_Shipping; //滿額免運費 ?>)</span>
              <?php } ?>
              <?php if ($_POST['ocfreightselectno'] != 1) { // 當有設定貨運方式才會判斷(1為未設定) ?>
              【<?php echo $rFreight; // 運費名稱 ?>】
              <?php } // 當有設定貨運方式才會判斷(1為未設定) ?>
              <?php //} // 當有設定貨運方式才會判斷 ?>
              <?php // 比較傳送過來之表單值 將標籤名稱顯示出來 END ?>
              <?php 
			   // 顯示滿額免運費條件
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
			  ?>
              
              <input name="ocfreightdesc" type="hidden" id="ocfreightdesc" value="<?php echo $ocfreightdesc; ?>" />
              <br />
              <?php 
			  switch($checkprice)
			  {
				  case "0":
				  if($row_RecordCartListFreight['dynamicpriceunit1'] == '0'){
				  	$ocotherprice = $row_RecordCartListFreight['dynamicpricepay1'];
				  }else{
					$ocotherprice = ceil($_SESSION['Total']*$row_RecordCartListFreight['dynamicpricepay1']/100);
				  }
				  break;
				  case "1":
				  if($row_RecordCartListFreight['dynamicpriceunit2'] == '0'){
				  	$ocotherprice = $row_RecordCartListFreight['dynamicpricepay2'];
				  }else{
					$ocotherprice = ceil($_SESSION['Total']*$row_RecordCartListFreight['dynamicpricepay2']/100);
				  }
				  break;
				  case "2":
				  if($row_RecordCartListFreight['dynamicpriceunit3'] == '0'){
				  	$ocotherprice = $row_RecordCartListFreight['dynamicpricepay3'];
				  }else{
					$ocotherprice = ceil($_SESSION['Total']*$row_RecordCartListFreight['dynamicpricepay3']/100);
				  }
				  break;
				  case "3":
				  if($row_RecordCartListFreight['dynamicpriceunit4'] == '0'){
				  	$ocotherprice = $row_RecordCartListFreight['dynamicpricepay4'];
				  }else{
					$ocotherprice = ceil($_SESSION['Total']*$row_RecordCartListFreight['dynamicpricepay4']/100);
				  }
				  break;
				  case "4":
				  if($row_RecordCartListFreight['dynamicpriceunit5'] == '0'){
				  	$ocotherprice = $row_RecordCartListFreight['dynamicpricepay5'];
				  }else{
					$ocotherprice = ceil($_SESSION['Total']*$row_RecordCartListFreight['dynamicpricepay5']/100);
				  }
				  break;
				  case "5":
				  if($row_RecordCartListFreight['dynamicpriceunit6'] == '0'){
				  	$ocotherprice = $row_RecordCartListFreight['dynamicpricepay6'];
				  }else{
					$ocotherprice = ceil($_SESSION['Total']*$row_RecordCartListFreight['dynamicpricepay6']/100);
				  }
				  break;
			  }
			  ?>
              
              <?php // 貨到付款加收 -------------------------------------- ?>
              <?php if($_POST['ocpaymentselect'] == 'payondelivery') { // 當貨運為貨到付款時才會計算否則價格為0 ?>
              <?php if($ocotherprice != "") {?>
              <?php echo $Lang_Classify_Context_Cart_Cash_On_Delivery_Plus; //貨到付款外加 ?>：<span style="color:#FF0000"><?php echo $Lang_Classify_Context_Currency_units . doFormatMoney($ocotherprice);  ?></span><font color="#FF0000">
              <input name="ocotherprice" type="hidden" id="ocotherprice" value="<?php echo $ocotherprice; ?>" />
              </font><br />
			  <?php } ?>
              <?php } else { ?>
              <?php $ocotherprice = 0; ?>
              <?php } ?>
              <?php // 貨到付款加收 -------------------------------------- ?>
              
              <?php // 額外金額 -------------------------------------- ?>
              <?php $exprice=0; ?>
              <?php if($row_RecordSystemConfigOtr['expriceenable'] == "1") { ?>
              <?php 
			  		if($_POST['ocexpriceselect'] == '1') // 消費者選擇加收
					{
						// 計算額外費用
						switch($row_RecordSystemConfigOtr['expricecomputeselect'])
						{
							case "0":
								//echo "固定金額";
								$expricecomputedesc = $row_RecordSystemConfigOtr['expricefixed'] . "元";
								$exprice = $row_RecordSystemConfigOtr['expricefixed'];
								echo $row_RecordSystemConfigOtr['expricename'] . "：<span style=\"color:#FF0000\">$" . doFormatMoney($exprice). "</span><br/>";
								break;
							case "1":
								//echo "比例金額";
								$expercent = ceil($_SESSION['Total']*$row_RecordSystemConfigOtr['expricepercent']/100);
								$exprice = $expercent;
								$expricecomputedesc = $Lang_Classify_Context_Cart_Commodity_Amount/*商品金額*/ . "[". $_SESSION['Total'] .$Lang_Classify_Context_Cart_Money_Unit/*元*/."] * " . $row_RecordSystemConfigOtr['expricepercent'] . "% = " . $expercent . $Lang_Classify_Context_Cart_Money_Unit/*元*/;
								echo $row_RecordSystemConfigOtr['expricename'] . "：<span style=\"color:#FF0000\">$" . doFormatMoney($exprice). "</span><br/>";
								break;
							case "2":
								//echo "比例金額+運費";
								if($_POST['ocfreight'] == "-1")
								{
									// 等待廠商報價
									//$ocfreight=0; // 計算用
									//$ocfreightdesc
									//$ocfreightprice = "";
								}
								if($_POST['ocfreight'] == "")
								{
									// 未填運費
									//$ocfreightprice = "";
								}
								if($ocfreightprice == "") {
									// 當運費不可知時
									$expricecomputedesc = "[".$Lang_Classify_Context_Cart_Commodity_Amount/*商品金額*/ . "[". $_SESSION['Total'] .$Lang_Classify_Context_Cart_Money_Unit/*元*/."]+".$Lang_Classify_Context_Cart_Freight/*運費*/."[" . $ocfreightdesc . "]] * " . $row_RecordSystemConfigOtr['expricepercentfull'] . "%";
									$exprice = "-1";
									echo $row_RecordSystemConfigOtr['expricename'] . "：<div style=\"color:#FF0000\">" . $expricecomputedesc. "</div>br/>";
								}else{
									$expercent = ceil(($_SESSION['Total']+$ocfreightprice)*$row_RecordSystemConfigOtr['expricepercent']/100);
									$exprice = $expercent;
									$expricecomputedesc = "[".$Lang_Classify_Context_Cart_Commodity_Amount/*商品金額*/."[". $_SESSION['Total'] .$Lang_Classify_Context_Cart_Money_Unit/*元*/."]+".$Lang_Classify_Context_Cart_Freight/*運費*/."[" . $ocfreightprice . $Lang_Classify_Context_Cart_Money_Unit/*元*/ ."]] * " . $row_RecordSystemConfigOtr['expricepercentfull'] . "%";
									echo $row_RecordSystemConfigOtr['expricename'] . "：<span style=\"color:#FF0000\">$" . doFormatMoney($exprice). "</span><br/>";
								}
								
								break;
						}
					}
			  ?>
              <?php } ?>
              <?php // 額外金額 -------------------------------------- ?>
              
              <?php // 發票5%稅 -------------------------------------- ?>
              <?php
			  $invoicetaxprice = 0;
			  if($_POST['invoiceformat'] != 0 /*選擇開發票*/&& $row_RecordSystemConfigOtr['invoiceenable'] == '1'/*發票功能啟用*/) {
				  // 發票稅 = 商品金額+運費+自訂額外價格
				  // 貨到付款額外加收不計算發票稅
				  if($row_RecordSystemConfigOtr['invoiceburden'] == '1') // 1:消費者負擔 /0:店家負擔
				  {
					  if($row_RecordSystemConfigOtr['burdenuserdecide'] == '1') {
					  }else{
					  	$invoicetaxprice = ceil(($_SESSION['Total'] + $ocfreight + $exprice)*0.05);
					  	echo "發票稅 5%：<span style=\"color:#FF0000\">$".doFormatMoney($invoicetaxprice)."</span><br/>";
					  }
				  }
			  }
			  ?>
              <?php // 發票5%稅 -------------------------------------- ?>
              
			  <?php 
			  //計算總金額
			  // 商品金額 + 運費 + 
			  $OCTotal = $_SESSION['Total'] + $ocfreight + $ocotherprice + $exprice + $invoicetaxprice;
			  ?>
              
              <br />
              <div style="font-size:24px; font-weight:bolder"><?php echo $Lang_Classify_Context_Cart_Current_Total_Amount; //目前總金額 ?>：<span style="color:#FF0000"><?php echo $Lang_Classify_Context_Currency_units . doFormatMoney($OCTotal); 
			  ?></span></div>
              <?php 
			  // 判斷是否可送出金流訂單
			  //echo $_POST['ocpaymentselect'];
			  //echo $freepricedesc;
			  if($_POST['ocpaymentselect'] == 'allpay' || $_POST['ocpaymentselect'] == 'allpay_Credit' || $_POST['ocpaymentselect'] == 'allpay_BARCODE' || $_POST['ocpaymentselect'] == 'allpay_CVS' || $_POST['ocpaymentselect'] == 'pchomepay')
			  {
				  if($ocfreightdesc == "等待商家報價" || $ocfreightdesc == "買家尚未填寫運費")
				  {
					  $bt_disable = "1";
					  echo "<span style=\"color:#FF0000\">".$Lang_Classify_Context_Cart_Orders_Can_Not_Be_Sent/*訂單無法送出，由於運費尚未填寫或需等待商家報價*/."</span>";
				  }
			  }			  
			  ?>
              </td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td><input type="submit" name="button2" id="button2" value="<?php echo $Lang_Classify_Context_Mail_Send_Order_Information; //送出訂單資訊 ?>"  onclick="javascript:{this.disabled=true;document.form1.submit();}" <?php if($bt_disable == "1") { ?>disabled="disabled"<?php } ?>/>
                <input type="button" name="button3" id="button3" value="<?php echo $Lang_Classify_Prev; //回上一頁 ?>" onclick="history.back(-1)"/>
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
                </font></td>
            </tr>
          </table>
          
          <input type="hidden" name="MM_insert" value="form1" />
        </form>
        <?php } else { ?>
        <div class="columns on-1">
                <div class="container board">
                    <div class="column">
                        <div class="container ct_board">
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
                            <td align="center">
                              <?php echo $Lang_Classify_Context_Cart_Continue_Buy_Buttom; //若您想繼續選購，請按下方「繼續購物」鈕 ?><br />
                              <br /><span class="InnerButtom"><a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $Lang_Classify_Context_Cart_Continue_Shopping; //繼續購物 ?></a></span></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                </div>        
        </div>
        <?php 
        } 
        ?>
      </div>
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