<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter; } else { echo $SiteBaseUrl; } ?>SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter; } else { echo $SiteBaseUrl; } ?>SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.twzipcode.js" type="text/javascript"></script>
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter; } else { echo $SiteBaseUrl; } ?>SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter; } else { echo $SiteBaseUrl; } ?>SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.Cart_Purchase tr td{margin:5px;padding:5px}
.InnerButtom{margin-right:2px;margin-top:5px;margin-bottom:5px}
.InnerButtom a{font-weight:700;border:1px solid #CCC;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;text-shadow:0 1px 1px #fff;-webkit-box-shadow:0 1px 1px #fff;-moz-box-shadow:0 1px 1px #fff;box-shadow:0 1px 1px #fff;font:bold 11px Sans-Serif;padding:4px 8px;white-space:nowrap;vertical-align:middle;color:#666;background:transparent;cursor:pointer}
.InnerButtom a:hover,.InnerButtom a:focus{font-weight:700;border-color:#999;background:-webkit-linear-gradient(top,white,#E0E0E0);background:-moz-linear-gradient(top,white,#E0E0E0);background:-ms-linear-gradient(top,white,#E0E0E0);background:-o-linear-gradient(top,white,#E0E0E0);-webkit-box-shadow:0 1px 2px rgba(0,0,0,0.25),inset 0 0 3px #fff;-moz-box-shadow:0 1px 2px rgba(0,0,0,0.25),inset 0 0 3px #fff;box-shadow:0 1px 2px rgba(0,0,0,0.25),inset 0 0 3px #fff;color:#333;text-decoration:none}
.InnerButtom a:active{font-weight:700;color:#666;border:1px solid #AAA;border-bottom-color:#CCC;border-top-color:#999;-webkit-box-shadow:inset 0 1px 2px #aaa;-moz-box-shadow:inset 0 1px 2px #aaa;box-shadow:inset 0 1px 2px #aaa;background:-webkit-linear-gradient(top,#E6E6E6,gainsboro);background:-moz-linear-gradient(top,#E6E6E6,gainsboro);background:-ms-linear-gradient(top,#E6E6E6,gainsboro);background:-o-linear-gradient(top,#E6E6E6,gainsboro)}
.P_tb tr td{background-color:#EEE;padding:10px}
.s_word{font-size:9px}
.txtImportant{color:red}
.columnName{display:block;width:100%;padding:9px 0;line-height:1.428571429;color:#555;vertical-align:middle}
.form-control{margin-bottom:10px}
.tipHide{display:none}
.tipShow{position:absolute;border:1px solid #cc0;background:#ff0;width:200px;height:200px}
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
        <div class="columns on-1">
          <div class="container">
            <div class="column">
              <div class="container ct_board ct_title">
                <h1 style="font-size:large">
                  <?php if($TmpTitleBgImage != ''){ ?>
                  <span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span>
                  <?php } ?>
                  <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $Lang_Title_Cart_Purchase; // 標題文字 ?></span></h1>
              </div>
            </div>
          </div>
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
        
<div style="height:5px;"></div>

          
          <form id="form1" name="form1" method="post" action="<?php echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'purchasecheckpage'),'',$UrlWriteEnable);?>">
            <fieldset>
            <div style="-moz-box-shadow:0px 0px 1px rgba(0,0,0,.6); -webkit-box-shadow:0px 0px 1px rgba(0,0,0,.6); box-shadow:0px 0px 1px rgba(0,0,0,.6); background-color: rgba(255, 255, 255, 0.6); padding:10px;">
              <?php echo $Lang_Title_Cart_Order_Number ?>：<span style="color:#0033FF"><?php echo $_SESSION['OrderID']; ?></span><br />
              <br />
              
<?php 
////////////////////////////////////////////////////////////////////////////////////////////	
// 訂購人基本資料內容
////////////////////////////////////////////////////////////////////////////////////////////	
?>
              <h4><i class="fa fa-pencil-square-o"></i> <?php echo $Lang_Title_Cart_Subscriber_Basic_Information ?></h4>
              <div style="border:#EEE solid 1px; background-color: rgba(255, 255, 255, 0.6); padding:10px;">
              <div class="form-group">
                <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Cart_Name ?>:<span class="txtImportant">*</span> </span></label>
                <div class="col-md-10 col-sm-10 col-xs-12"> <span id="sprytextfield7">
                  <label for="ocbuyname"></label>
                  <input name="ocbuyname" type="text" class="text form-control" id="ocbuyname" value="<?php echo $row_RecordMember['name'] ?>" maxlength="30"/>
                  <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03 ?></span></span> </div>
              </div>

              <div class="form-group">
                <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Cart_Cell ?>:<span class="txtImportant">*</span></span></label>
                <div class="col-md-10 col-sm-10 col-xs-12"> <span id="sprytextfield8">
                <label for="ocbuyphone"></label>
                <input name="ocbuyphone" type="text" class="text form-control" id="ocbuyphone" value="<?php echo $row_RecordMember['cellphone'] ?>" maxlength="30"/>
                <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03 ?></span><span class="textfieldInvalidFormatMsg">格式無效。</span></span> </div>
              </div>
              
              <div class="form-group">
                <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Cart_Tel ?>:</span></label>
                <div class="col-md-10 col-sm-10 col-xs-12"> <span id="sprytextfield9">
                  <label for="ocbuytel"></label>
                  <input name="ocbuytel" type="text" class="text form-control" id="ocbuytel" value="<?php echo $row_RecordMember['tel'] ?>" maxlength="30"/>
</span> </div>
              </div>
              
                
              <div class="clearfix"></div>   
              </div>         
<?php 
////////////////////////////////////////////////////////////////////////////////////////////	
// \訂購人基本資料內容
////////////////////////////////////////////////////////////////////////////////////////////	
?>

<?php 
////////////////////////////////////////////////////////////////////////////////////////////	
// 同訂購人
////////////////////////////////////////////////////////////////////////////////////////////	
?>              
              <div style="margin-top:10px; margin-bottom:10px;border:#EEE solid 1px; background-color: rgba(255, 255, 255, 0.6); padding:10px;">
              <div class="checkbox checkbox-primary" style="color:#F00">
                  <input name="autoinputpurchaser" type="checkbox" id="autoinputpurchaser" onclick="return AutoPurchaser();" value="1" checked="checked"/>
                  <label for="autoinputpurchaser"> <?php echo $Lang_Classify_Context_Cart_Consignee; //收貨人?><?php echo $Lang_Classify_Context_Cart_With_Order_person ?> </label>
                </div>
              </div>
<?php 
////////////////////////////////////////////////////////////////////////////////////////////	
// \同訂購人
////////////////////////////////////////////////////////////////////////////////////////////	
?> 

<?php 
////////////////////////////////////////////////////////////////////////////////////////////	
// 收貨人基本資料
////////////////////////////////////////////////////////////////////////////////////////////	
?>
              <div id="purchaser_board" class="softhide">
              <h4><i class="fa fa-pencil-square-o"></i> <?php echo $Lang_Title_Cart_Consignee_Basic_Information ?></h4>
              <div style="border:#EEE solid 1px; background-color: rgba(255, 255, 255, 0.6); padding:10px;">
              <div class="form-group">
                <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Cart_Name ?>:<span class="txtImportant">*</span> </span></label>
                <div class="col-md-10 col-sm-10 col-xs-12"> <span id="CartName">
                  <label for="ocname"></label>
                  <input name="ocname" type="text" id="ocname" maxlength="30" class="text form-control"/>
                  <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03 ?></span></span> </div>
              </div>
 
              <div class="form-group">
                <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Cart_Cell ?>:<span class="txtImportant">*</span></span></label>
                <div class="col-md-10 col-sm-10 col-xs-12"> <span id="CartPhone">
                  <label for="ocphone"></label>
                  <input name="ocphone" type="text" id="ocphone" maxlength="30" class="text form-control"/>
                  </span> </div>
              </div>
              
              
              <div class="form-group">
                <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Cart_Tel ?>:</span></label>
                <div class="col-md-10 col-sm-10 col-xs-12"> <span id="Carttel">
                  <label for="octel"></label>
                  <input name="octel" type="text" id="octel" maxlength="30" class="text form-control"/>
                  <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03 ?></span></span> </div>
              </div>
              
              <div class="clearfix"></div>
              </div>
              </div>
              
<?php 
////////////////////////////////////////////////////////////////////////////////////////////	
// \收貨人基本資料
////////////////////////////////////////////////////////////////////////////////////////////	
?>

<h4><i class="fa fa-pencil-square-o"></i> E-mail信箱</h4>
<div style="border:#EEE solid 1px; background-color: rgba(255, 255, 255, 0.6); padding:10px;"> 
              <div class="form-group">
                <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Cart_Mail ?>:<span class="txtImportant">*</span> </span></label>
                <div class="col-md-10 col-sm-10 col-xs-12"> <span id="CartMail">
                  <label for="ocmail"></label>
                  <input name="ocmail" type="text" id="ocmail" size="30" maxlength="100" class="text form-control"/>
                  <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03 ?></span><span class="textfieldInvalidFormatMsg"><?php echo $Lang_Classify_Send_Error05 ?></span></span>
                  <span class="Form_Caption_Word"> 訂單資訊將用E-mail通知您</span></div>
              </div>
              <div class="clearfix"></div>
              </div>
              <div style="height:10px;"></div>
<?php 
////////////////////////////////////////////////////////////////////////////////////////////	
// 地址選擇或設定
////////////////////////////////////////////////////////////////////////////////////////////	
?>            <?php //echo $_POST['ExtraData'] ?>
              <h4><i class="fa fa-pencil-square-o"></i> <?php echo $Lang_Classify_Context_Cart_Receipt_Information; //收貨資訊 ?></h4>
              <?php if($_POST['ocfreightselect'] == "sevenshop" || $_POST['ocfreightselect'] == "sevenshopnopay") { ?>
<?php 
////////////////////////////////////////////////////////////////////////////////////////////	
// 7-11
////////////////////////////////////////////////////////////////////////////////////////////	
?>     
                <div style="border:#EEE solid 1px; background-color: rgba(255, 255, 255, 0.6); padding:10px;">
                <button type="button" class="btn btn-danger btn-3d" onClick="javascript:window.open('<?php echo $SiteBaseUrl; ?>allshop_CvsMap.php?wshop=<?php echo $_GET['wshop']; ?>&Type=UNIMART<?php if($row_RecordSystemConfigOtr['allshopuseC2C'] == "1") { echo "C2C";} ?>&Col=<?php if($_POST['ocfreightselect'] == "sevenshop") {echo "YES";}else{echo "NO";} ?>','mywindow','width=800,height=800')">取得超商門市資訊</button>
                <div class="form-group">
                <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName">取貨超商編號:<span class="txtImportant">*</span> </span></label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <span id="CartCVSStoreID">
                  <label for="ocCVSStoreID"></label>
                  <input name="ocCVSStoreID" type="text" class="text form-control" id="ocCVSStoreID" size="60" maxlength="100"/>
                  <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03 ?></span></span> </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName">取貨超商名稱:<span class="txtImportant">*</span> </span></label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <span id="CartCVSStoreName">
                  <label for="ocCVSStoreName"></label>
                  <input name="ocCVSStoreName" type="text" class="text form-control" id="ocCVSStoreName" size="60" maxlength="100"/>
                  <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03 ?></span></span> </div>
              </div>
                <div class="form-group">
                <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName">取貨超商地址:<span class="txtImportant">*</span> </span></label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <span id="CartAddr">
                  <label for="ocCartAddr"></label>
                  <input name="ocaddr" type="text" class="text form-control" id="ocaddr" size="60" maxlength="100"/>
                  <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03 ?></span></span> </div>
              </div>
              <div class="clearfix"></div>
              </div>
              <script type="text/javascript">
		
		var sprytextfield17 = new Spry.Widget.ValidationTextField("CartCVSStoreID", "none", {validateOn:["blur"]});
		var sprytextfield18 = new Spry.Widget.ValidationTextField("CartCVSStoreName", "none", {validateOn:["blur"]});
		
		</script>
<?php 
////////////////////////////////////////////////////////////////////////////////////////////	
// \7-11
////////////////////////////////////////////////////////////////////////////////////////////	
?>
              <?php } else if ($_POST['ocfreightselect'] == "familyshop" || $_POST['ocfreightselect'] == "familyshopnopay") { ?>
<?php 
////////////////////////////////////////////////////////////////////////////////////////////	
// 全家
////////////////////////////////////////////////////////////////////////////////////////////	
?>     
                <div style="border:#EEE solid 1px; background-color: rgba(255, 255, 255, 0.6); padding:10px;">
                <button type="button" class="btn btn-danger btn-3d" onClick="javascript:window.open('<?php echo $SiteBaseUrl; ?>allshop_CvsMap.php?wshop=<?php echo $_GET['wshop']; ?>&Type=FAMI<?php if($row_RecordSystemConfigOtr['allshopuseC2C'] == "1") { echo "C2C";} ?>&Col=<?php if($_POST['ocfreightselect'] == "familyshop") {echo "YES";}else{echo "NO";} ?>','mywindow','width=800,height=800')">取得超商門市資訊</button>
                <div class="form-group">
                <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName">取貨超商編號:<span class="txtImportant">*</span> </span></label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <span id="CartCVSStoreID">
                  <label for="ocCVSStoreID"></label>
                  <input name="ocCVSStoreID" type="text" class="text form-control" id="ocCVSStoreID" size="60" maxlength="100"/>
                  <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03 ?></span></span> </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName">取貨超商名稱:<span class="txtImportant">*</span> </span></label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <span id="CartCVSStoreName">
                  <label for="ocCVSStoreName"></label>
                  <input name="ocCVSStoreName" type="text" class="text form-control" id="ocCVSStoreName" size="60" maxlength="100"/>
                  <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03 ?></span></span> </div>
              </div>
                <div class="form-group">
                <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName">取貨超商地址:<span class="txtImportant">*</span> </span></label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <span id="CartAddr">
                  <label for="ocCartAddr"></label>
                  <input name="ocaddr" type="text" class="text form-control" id="ocaddr" size="60" maxlength="100"/>
                  <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03 ?></span></span> </div>
              </div>
              <div class="clearfix"></div>
              </div>
              <script type="text/javascript">
		
		var sprytextfield17 = new Spry.Widget.ValidationTextField("CartCVSStoreID", "none", {validateOn:["blur"]});
		var sprytextfield18 = new Spry.Widget.ValidationTextField("CartCVSStoreName", "none", {validateOn:["blur"]});
		
		</script>
<?php 
////////////////////////////////////////////////////////////////////////////////////////////	
// \全家
////////////////////////////////////////////////////////////////////////////////////////////	
?>
              <?php } else { ?>
<?php 
////////////////////////////////////////////////////////////////////////////////////////////	
// 自訂 EX 宅配
////////////////////////////////////////////////////////////////////////////////////////////	
?> 
              <div style="border:#EEE solid 1px; background-color: rgba(255, 255, 255, 0.6); padding:10px;">
              <div class="form-group">
                <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Cart_Addr ?>:<span class="txtImportant">*</span> </span></label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <div id="twzipcode" style="margin-bottom:5px;"> <span data-role="occounty" data-style="occounty" id="occounty"></span> <!--自訂縣市選單容器，以及套用 .county 樣式--> 
                    <span data-role="ocdistrict" data-style="ocdistrict" id="ocdistrict"></span> <!--自訂鄉鎮市區選單容器，以及套用 .district 樣式--> 
                    <span data-role="oczip" data-style="oczip" id="oczip"></span> <!--自訂郵遞區號容器，以及套用 .zipcode 樣式--> 
                  </div>
                  <span id="CartAddr">
                  <label for="ocCVSStoreID"></label>
                  <input name="ocaddr" type="text" id="ocaddr" size="60" maxlength="100" class="text form-control"/>
                  <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03 ?></span></span> </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Cart_Time_Of_Receipt; //收貨時間 ?>:</span></label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <div class="radio">
                    <input name="ocreceipt" type="radio" id="ocreceipt_0" value="不拘" checked="checked" />
                    <label for="ocreceipt_0"> <?php echo $Lang_Classify_Informal; //不拘 ?> </label>
                  </div>
                  <div class="radio">
                    <input type="radio" name="ocreceipt" value="早上" id="ocreceipt_1" />
                    <label for="ocreceipt_1"> <?php echo $Lang_Classify_Morning; //早上 ?> </label>
                  </div>
                  <div class="radio">
                    <input type="radio" name="ocreceipt" value="下午" id="ocreceipt_2" />
                    <label for="ocreceipt_2"> <?php echo $Lang_Classify_Afternoon; //下午 ?> </label>
                  </div>
                  <div class="radio">
                    <input type="radio" name="ocreceipt" value="晚上" id="ocreceipt_3" />
                    <label for="ocreceipt_3"> <?php echo $Lang_Classify_Night; //晚上 ?> </label>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              </div>
<?php 
////////////////////////////////////////////////////////////////////////////////////////////	
// \自訂 EX 宅配
////////////////////////////////////////////////////////////////////////////////////////////	
?>
              <?php } ?>
<?php 
////////////////////////////////////////////////////////////////////////////////////////////	
// \地址選擇或設定
////////////////////////////////////////////////////////////////////////////////////////////	
?>
              <?php if ($row_RecordSystemConfigOtr['invoiceenable'] == '1') { ?>
              <h4><i class="fa fa-pencil-square-o"></i> <?php echo $Lang_Classify_Context_Cart_Invoice_Content ?></h4>
              
              <div style="border:#EEE solid 1px; background-color: rgba(255, 255, 255, 0.6); padding:10px;">
              <div class="form-group">
                <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Cart_Invoice_Type ?>:<span class="txtImportant">*</span> </span></label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <?php if ($row_RecordSystemConfigOtr['invoiceburden'] == '1' && $row_RecordSystemConfigOtr['burdenuserdecide'] == '1') { ?>
                  <div class="radio">
                    <input name="invoiceformat" type="radio" id="invoiceformat_0" value="0" onclick="return Checkinvoiceformat();"/>
                    <label for="invoiceformat_0"> <?php echo $Lang_Classify_Context_Cart_No_nvoicing_Is_Required ?> </label>
                  </div>
                  <?php } ?>
                  <?php if ($row_RecordSystemConfigOtr['invoiceformat1'] == '1') { ?>
                  <div class="radio">
                    <input type="radio" name="invoiceformat" value="1" id="invoiceformat_1" onclick="return Checkinvoiceformat();"/>
                    <label for="invoiceformat_1"> <?php echo $Lang_Classify_Context_Cart_Double_Invoice ?> </label>
                  </div>
                  <?php } ?>
                  <?php if ($row_RecordSystemConfigOtr['invoiceformat2'] == '1') { ?>
                  <div class="radio">
                    <input type="radio" name="invoiceformat" value="2" id="invoiceformat_2" onclick="return Checkinvoiceformat();"/>
                    <label for="invoiceformat_2"> <?php echo $Lang_Classify_Context_Cart_Triple_Invoice ?> </label>
                  </div>
                  <?php } ?>
                  <?php if ($row_RecordSystemConfigOtr['invoiceformat3'] == '1') { ?>
                  <div class="radio">
                    <input type="radio" name="invoiceformat" value="3" id="invoiceformat_3" onclick="return Checkinvoiceformat();"/>
                    <label for="invoiceformat_3"> <?php echo $Lang_Classify_Context_Cart_Electronic_Invoice ?> </label>
                  </div>
                  <?php } ?>
                  <?php if ($row_RecordSystemConfigOtr['invoiceformat4'] == '1') { ?>
                  <div class="radio">
                    <input type="radio" name="invoiceformat" value="4" id="invoiceformat_4" onclick="return Checkinvoiceformat();"/>
                    <label for="invoiceformat_4"> <?php echo $Lang_Classify_Context_Cart_Receipt ?> </label>
                  </div>
                  <?php } ?>
                  <?php if ($row_RecordSystemConfigOtr['invoiceformat5'] == '1') { ?>
                  <div class="radio">
                    <input type="radio" name="invoiceformat" value="5" id="invoiceformat_5" onclick="return Checkinvoiceformat();"/>
                    <label for="invoiceformat_5"> <?php echo $Lang_Classify_Context_Cart_Donated_Charitable ?> </label>
                  </div>
                  <?php } ?>
                  <?php if ($row_RecordSystemConfigOtr['invoiceburden'] == '1') { ?>
                  <div style="color:#F00; margin-left:5px;"><i class="fa fa-info-circle"></i> <?php echo $Lang_Classify_Context_Cart_Plus_Five_Invoice ?></div>
                  <?php } ?>
                  
                </div>
                <div style="clear:both;"></div>
              </div>
              <div class="form-group">
                <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Cart_Electronic_Invoice ?>:</span></label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <div class="radio">
                    <input name="ocinvoiceetselect" type="radio" disabled="disabled" id="ocinvoiceetselect_0" value="0" onclick="return Checkinvoiceformat();" />
                    <label for="ocinvoiceetselect_0"> <?php echo $Lang_Classify_Context_Cart_Print_To_Me ?> </label>
                  </div>
                  <br />
                  <div class="radio">
                    <input type="radio" name="ocinvoiceetselect" value="1" id="ocinvoiceetselect_1" disabled="disabled" onclick="return Checkinvoiceformat();"/>
                    <label for="ocinvoiceetselect_1"> <?php echo $Lang_Classify_Context_Cart_Carrier_Bar_Code ?> </label>
                  </div>
                  <span id="sprytextfield5">
                  <label for="ocinvoicesupportno" class="radio" style="line-height:37px; "></label>
                  <input name="ocinvoicesupportno" type="text" disabled="disabled" id="ocinvoicesupportno" size="15" maxlength="50" class="text form-control"/>
                  </span>
                  <div class="radio">
                    <input type="radio" name="ocinvoiceetselect" value="2" id="ocinvoiceetselect_2" disabled="disabled" onclick="return Checkinvoiceformat();"/>
                    <label for="ocinvoiceetselect_2"> <?php echo $Lang_Classify_Context_Cart_Love_Code ?> </label>
                  </div>
                  <span id="sprytextfield11">
                  <label for="ocinvoiceloveno" class="radio" style="line-height:37px; "></label>
                  <input name="ocinvoiceloveno" type="text" disabled="disabled" id="ocinvoiceloveno" size="15" maxlength="50" class="text form-control"/>
                  </span> </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Cart_Uniform_Numbers ?>:</span></label>
                <div class="col-md-10 col-sm-10 col-xs-12"> <span id="sprytextfield14">
                  <label for="ocinvoicecompanyno"></label>
                  <input name="ocinvoicecompanyno" type="text" disabled="disabled" id="ocinvoicecompanyno" class="text form-control"/>
                  </span> </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Cart_Invoice_Title ?>:</span></label>
                <div class="col-md-10 col-sm-10 col-xs-12"> <span id="sprytextfield12">
                  <label for="ocinvoicetitle"></label>
                  <input name="ocinvoicetitle" type="text" disabled="disabled" id="ocinvoicetitle" maxlength="30" class="text form-control"/>
                  </span> </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Cart_Invoice_Recipient ?>:</span></label>
                <div class="col-md-10 col-sm-10 col-xs-12"> <span id="sprytextfield13">
                  <label for="ocinvoiceusername"></label>
                  <input name="ocinvoiceusername" type="text" disabled="disabled" id="ocinvoiceusername" maxlength="30" class="text form-control"/>
                  </span> </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Cart_Invoice_Receipt_Address ?>:</span></label>
                <div class="col-md-10 col-sm-10 col-xs-12"> <span id="sprytextfield15">
                  <label for="ocCVSStoreID"></label>
                  <input name="ocinvoiceaddr" type="text" disabled="disabled" id="ocinvoiceaddr" size="50" maxlength="300" class="text form-control"/>
                  </span>
                  <div class="checkbox checkbox-primary">
                    <input name="autoinputreceiver" type="checkbox" disabled="disabled" id="autoinputreceiver" onclick="return AutoReceiver();" value="1"/>
                    <label for="autoinputreceiver"> <?php echo $Lang_Classify_Context_Cart_With_The_Consignee ?> </label>
                  </div>
                </div>
              </div>
              <?php if($row_RecordSystemConfigOtr['invoicedesc'] != "") { ?>
              <div class="form-group">
                <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Cart_Supplementary_Explanation ?>:</span></label>
                <div class="col-md-10 col-sm-10 col-xs-12"> <?php echo $row_RecordSystemConfigOtr['invoicedesc']; ?></div>
              </div>
              <?php } ?>
              <?php if($row_RecordSystemConfigOtr['expriceenable'] == "1") { ?>
              <h4><i class="fa fa-pencil-square-o"></i> <?php echo $Lang_Classify_Context_Cart_Additional_Charges ?></h4>
              <hr>
              <div class="form-group">
                <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $row_RecordSystemConfigOtr['expricename']; ?>:</span></label>
                <div class="col-md-10 col-sm-10 col-xs-12">
                  <p>
                    <?php 
				  	// 計算額外費用
					switch($row_RecordSystemConfigOtr['expricecomputeselect'])
			        {
						case "0":
				    		//echo "固定金額";
							$expricecomputedesc = $row_RecordSystemConfigOtr['expricefixed'] . $Lang_Classify_Context_Cart_Money_Unit /* 元 */;
							break;
						case "1":
				    		//echo "比例金額";
							$expercent = ceil($_SESSION['Total']*$row_RecordSystemConfigOtr['expricepercent']/100);
							$expricecomputedesc = $Lang_Classify_Context_Cart_Commodity_Amount /*  商品金額 */. "[". $_SESSION['Total'] . $Lang_Classify_Context_Cart_Money_Unit /* 元 */ . "] * " . $row_RecordSystemConfigOtr['expricepercent'] . "% = " . $expercent . $Lang_Classify_Context_Cart_Money_Unit /* 元 */;
							break;
						case "2":
				    		//echo "比例金額+運費";
							$expricecomputedesc = "[".$Lang_Classify_Context_Cart_Merchandise_Amount_Plus_Freight/* 商品金額+運費 */."] * " . $row_RecordSystemConfigOtr['expricepercentfull'] . "%";
							break;
				    }
				  ?>
                    <?php if ($row_RecordSystemConfigOtr['expriceuserselect'] == '1') { ?>
                    <label class="radio" style="line-height:37px; ">
                      <input type="radio" name="ocexpriceselect" value="0" id="ocexpriceselect_1" checked="checked"/>
                      <i></i> <?php echo $Lang_Classify_No_Need ?></label>
                    <?php } ?>
                    <label class="radio" style="line-height:37px; ">
                      <input name="ocexpriceselect" type="radio" id="ocexpriceselect_0" value="1" <?php if ($row_RecordSystemConfigOtr['expriceuserselect'] == '0') { ?>checked="checked"<?php } ?> />
                      <i></i> <?php echo $Lang_Classify_Need ?> <span style="color:#F00">(<?php echo $expricecomputedesc; ?>)</span></label>
                    <?php if ($row_RecordSystemConfigOtr['expriceuserselect'] == '0') { ?>
                  <div style="color:#F00; margin-left:5px;"><i class="fa fa-info-circle"></i> <?php echo $Lang_Classify_Context_Cart_Must_Be_Included_In_Purchase ?></div>
                  <?php } ?>
                  <br />
                  </p>
                </div>
              </div>
              <?php } ?>
              <div class="clearfix"></div>
              </div>
              <?php } ?>
              <?php 
			  //echo "是否接收到貨運方式:" . $_POST['ocfreightselect']; 1代表沒有貨運方式
			if ($totalRows_RecordCartListFreight == 0 && $_POST['ocfreightselect'] == "") { // 未設定任何貨運價格
			echo "<input name=\"ocfreightselectno\" type=\"hidden\" id=\"ocfreightselectno\" value=\"1\" />";
			}
		?>
              <div style="height:10px;"></div>
              <h4><i class="fa fa-pencil-square-o"></i> <?php echo $Lang_Classify_Context_Cart_Supplementary_Information; //補充訊息 ?></h4>
              <div style="border:#EEE solid 1px; background-color: rgba(255, 255, 255, 0.6); padding:10px;">
              <div class="form-group">
                <label class="col-md-2 col-sm-2 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Cart_Supplementary_Information; //補充訊息 ?>:</span></label>
                <div class="col-md-10 col-sm-10 col-xs-12"> <span id="CartNotes1">
                  <label for="ocnotes1"></label>
                  <input name="ocnotes1" type="text" id="ocnotes1" value="" size="60" class="text form-control"/>
                  <span class="textareaMaxCharsMsg"><?php echo $Lang_Classify_Send_Error06 ?></span></span><span class="Form_Caption_Word"> 可註明填寫貨品其他等要求。</span></div>
              </div>
              <div class="clearfix"></div>
              </div>
              <?php if ($CartDesc != '') { ?>
              <hr>
              <?php echo $CartDesc; ?>
              <hr>
              <?php } ?>
             </div>
              <div class="form-group text-center" >
                <div class="col-md-12 col-sm-12 col-xs-12 margin-top-50">
                  <div class="col-md-6 col-sm-6 col-xs-6">
                    <input type="button" name="button3" id="button3" value="<?php echo $Lang_Classify_Prev ?>" onclick="history.back(-1)" class="btn btn-3d btn-warning btn-block"/>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-6">
                    <input type="submit" name="button2" id="button2" value="<?php echo $Lang_Classify_Next ?>" onclick="return CheckFields();" class="btn btn-3d btn-danger btn-block"/>
                    
                    <input name="ocfreightselect" type="hidden" id="ocfreightselect" value="<?php echo $_POST['ocfreightselect']; ?>" />
                    <input name="ocpaymentselect" type="hidden" id="ocpaymentselect" value="<?php echo $_POST['ocpaymentselect']; ?>" />
                  </div>
                </div>
              </div>
            
            </fieldset>
          </form>
          <script type="text/javascript">
		
		var sprytextfield6 = new Spry.Widget.ValidationTextField("CartAddr", "none", {validateOn:["blur"]});
		var sprytextarea1 = new Spry.Widget.ValidationTextarea("CartNotes1", {validateOn:["blur"], isRequired:false, maxChars:200});
		var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "none", {validateOn:["blur"], hint:"請輸入中文全名"});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "cellphone_taiwan", {validateOn:["blur"]});
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytextfield12", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield13 = new Spry.Widget.ValidationTextField("sprytextfield13", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield14 = new Spry.Widget.ValidationTextField("sprytextfield14", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield15 = new Spry.Widget.ValidationTextField("sprytextfield15", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield4 = new Spry.Widget.ValidationTextField("CartMail", "email", {hint:"請輸入聯絡用E-mail", validateOn:["blur"]});
		  </script>
          
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
$('#twzipcode').twzipcode({
        countyName: 'occounty', //POST googlemaparea1
        districtName: 'ocdistrict',//POST googlemaparea2
        zipcodeName: 'oczip'//POST googlemaparea3
    });
</script> 
<script type="text/javascript">
	$(function () {
		$('.footable').footable();
	});
</script> 
<script type="text/javascript">
<!--
function CheckFields()
{	
    //var item = $("input[name='autoinputpurchaser']:checked"); 
	//var len=item.length; 
	if($("input[name='autoinputpurchaser']:checked").length > 0){ 
		var sprytextfield1 = new Spry.Widget.ValidationTextField("CartName", "none", {isRequired:false});
		var sprytextfield2 = new Spry.Widget.ValidationTextField("Carttel", "cellphone_taiwan", {isRequired:false});
		var sprytextfield3 = new Spry.Widget.ValidationTextField("CartPhone", "none", {isRequired:false});
		//var sprytextfield4 = new Spry.Widget.ValidationTextField("CartMail", "email", {hint:"請輸入聯絡用E-mail", validateOn:["blur"]});
	}else{
		var sprytextfield1 = new Spry.Widget.ValidationTextField("CartName", "none", {validateOn:["blur"]});
		var sprytextfield2 = new Spry.Widget.ValidationTextField("Carttel", "cellphone_taiwan", {isRequired:false, validateOn:["blur"]});
		var sprytextfield3 = new Spry.Widget.ValidationTextField("CartPhone", "none", {validateOn:["blur"]});
		//var sprytextfield4 = new Spry.Widget.ValidationTextField("CartMail", "email", {hint:"請輸入聯絡用E-mail", validateOn:["blur"]});
	}

    <?php if ($totalRows_RecordCartListFreight > 0 && $_POST['ocfreightselect'] == "") { ?>
	//if($('input[name=ocfreightselect]:checked').val() == undefined) {
			alert("<?php echo $Lang_Classify_Context_JS_Tip_Shipping_Method; //需選擇一個貨運方式 ?>");
			return false;
		//}
	<?php } ?>
    <?php if (($row_RecordSystemConfigOtr['linguipaymentenable'] == '1' || $row_RecordSystemConfigOtr['atmpaymentenable'] == '1' || $row_RecordSystemConfigOtr['postofficepaymentenable'] == '1' || $row_RecordSystemConfigOtr['otherpaymentenable'] == '1' || $row_RecordSystemConfigOtr['allpaypaymentenable'] == '1' || $totalRows_RecordCartListPayment > 0) && $_POST['ocpaymentselect'] == "") { ?>
		//if($('input[name=ocpaymentselect]:checked').val() == undefined) {
			alert("<?php echo $Lang_Classify_Context_JS_Tip_Pay_Method; //需選擇一個付款方式 ?>");
			return false;
		//}
	<?php } ?>
	if($('input[name=invoiceformat]:checked').val() == "3") {
		if($('input[name=ocinvoiceetselect]:checked').val() == undefined) {
			alert("<?php echo $Lang_Classify_Context_JS_Tip_Electronic_Invoice_Method; //需設定電子發票格式 ?>");
			return false;
		}
	}
	<?php if ($row_RecordSystemConfigOtr['invoiceenable'] == '1') { ?>
	if($('input[name=invoiceformat]:checked').val() == undefined) {
			alert("<?php echo $Lang_Classify_Context_JS_Tip_Invoice_Method; //需選擇一種發票格式 ?>");
			return false;
		}
	<?php } ?>
	var foo = $('#twzipcode').twzipcode('serialize'); 
	strs = foo.split("&");
	var occounty = strs[0].split("=");
	var ocdistrict = strs[1].split("=");
	var oczip = strs[2].split("=");
	if(occounty[1] == "") {
		alert("<?php echo $Lang_Classify_Context_JS_Tip_Receive_City_Method; //需選擇收件縣市 ?>");
			return false;
	}
}

function AutoPurchaser()
{
	/*if($("#autoinputpurchaser").prop('checked'))
	{
		var ocbuyname = $('#ocbuyname').val();
		var ocbuyphone = $('#ocbuyphone').val();
		var ocbuytel = $('#ocbuytel').val();
		var ocbuymail = $('#ocbuymail').val();
		var ocbuygender = $('input[name="ocbuygender"]:checked').val();
		
		$('#ocname').val(ocbuyname);
		$('#ocphone').val(ocbuyphone);
		$('#octel').val(ocbuytel);
		$('#ocmail').val(ocbuymail);
		$("input[name=ocgender]").prop("checked",false);
		if(ocbuygender == '男'){
			$("input[name=ocgender][value='男']").prop("checked", true);
		}
		if(ocbuygender == '女'){
			$("input[name=ocgender][value='女']").prop("checked", true);
		}
	}*/
}
			
function AutoReceiver()
{
	if($("#autoinputreceiver").prop('checked'))
	{
		var ocname = $('#ocname').val();
		var ocaddr = $('#ocaddr').val();
		var foo = $('#twzipcode').twzipcode('serialize'); 
		strs = foo.split("&");
		var occounty = strs[0].split("=");
		var ocdistrict = strs[1].split("=");
		var oczip = strs[2].split("=");		
		$('#ocinvoiceusername').val(ocname);
		if(occounty[1] == "非台灣地區") {
			$('#ocinvoiceaddr').val(ocaddr);
		}else{
			$('#ocinvoiceaddr').val(oczip[1]+occounty[1]+ocdistrict[1]+ocaddr);
		}
	}
}

function Checkinvoiceformat()
{
	if($('input[name=invoiceformat]:checked').val() == "0" || $('input[name=invoiceformat]:checked').val() == "5") 
	{	
	    $('#ocinvoicetitle').prop('disabled', true);
		$('#ocinvoiceusername').prop('disabled', true);
		$('#ocinvoiceaddr').prop('disabled', true);
		$('#autoinputreceiver').prop('disabled', true);
		$('#ocinvoicesupportno').prop('disabled', true);
		$('#ocinvoiceloveno').prop('disabled', true);
		$('#ocinvoicecompanyno').prop('disabled', true);
		$("input[name=ocinvoiceetselect]").prop("disabled",true);
	}
	if($('input[name=invoiceformat]:checked').val() == "1") 
	{	
		$('#ocinvoicetitle').prop('disabled', false);
		$('#ocinvoiceusername').prop('disabled', false);
		$('#ocinvoiceaddr').prop('disabled', false);
		$('#autoinputreceiver').prop('disabled', false);
		$('#ocinvoicesupportno').prop('disabled', true);
		$('#ocinvoiceloveno').prop('disabled', true);
		$('#ocinvoicecompanyno').prop('disabled', true);
		$("input[name=ocinvoiceetselect]").prop("disabled",true);
		
	}
	if($('input[name=invoiceformat]:checked').val() == "2"  || $('input[name=invoiceformat]:checked').val() == "4") 
	{	
	    $('#ocinvoicetitle').prop('disabled', false);
		$('#ocinvoiceusername').prop('disabled', false);
		$('#ocinvoiceaddr').prop('disabled', false);
		$('#autoinputreceiver').prop('disabled', false);
		$('#ocinvoicesupportno').prop('disabled', true);
		$('#ocinvoiceloveno').prop('disabled', true);
		$('#ocinvoicecompanyno').prop('disabled', false);
		$("input[name=ocinvoiceetselect]").prop("disabled",true);
	}
	
	if($('input[name=invoiceformat]:checked').val() == "3") 
	{	
	    $('#ocinvoicetitle').prop('disabled', true);
		$('#ocinvoiceusername').prop('disabled', true);
		$('#ocinvoiceaddr').prop('disabled', true);
		$('#autoinputreceiver').prop('disabled', true);
		$('#ocinvoicesupportno').prop('disabled', true);
		$('#ocinvoiceloveno').prop('disabled', true);
		$('#ocinvoicecompanyno').prop('disabled', true);
		$("input[name=ocinvoiceetselect]").prop("disabled",false);
		if($('input[name=ocinvoiceetselect]:checked').val() == "0")
		{
			$('#ocinvoicecompanyno').prop('disabled', false);
			$('#ocinvoicetitle').prop('disabled', false);
			$('#ocinvoiceusername').prop('disabled', false);
			$('#ocinvoiceaddr').prop('disabled', false);
			$('#ocinvoicesupportno').prop('disabled', true);
			$('#ocinvoiceloveno').prop('disabled', true);
		}
		if($('input[name=ocinvoiceetselect]:checked').val() == "1")
		{
			$('#ocinvoicecompanyno').prop('disabled', true);
			$('#ocinvoicetitle').prop('disabled', true);
			$('#ocinvoiceusername').prop('disabled', true);
			$('#ocinvoiceaddr').prop('disabled', true);
			$('#ocinvoicesupportno').prop('disabled', false);
			$('#ocinvoiceloveno').prop('disabled', true);
		}
		if($('input[name=ocinvoiceetselect]:checked').val() == "2")
		{
			$('#ocinvoicecompanyno').prop('disabled', true);
			$('#ocinvoicetitle').prop('disabled', true);
			$('#ocinvoiceusername').prop('disabled', true);
			$('#ocinvoiceaddr').prop('disabled', true);
			$('#ocinvoicesupportno').prop('disabled', true);
			$('#ocinvoiceloveno').prop('disabled', false);
		}
	}
}










</script>
<script>
jQuery("#autoinputpurchaser").bind("click", function() {
	jQuery('#purchaser_board').slideToggle(200, function() {
		if(jQuery('#purchaser_board').is(":visible")) {
			_scrollTo('#purchaser_board', 150);
		}
	
	});
});
</script>


<script>
fbq('track', 'InitiateCheckout');
</script>
