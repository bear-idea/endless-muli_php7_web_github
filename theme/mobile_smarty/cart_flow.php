<script src="<?php echo $SiteBaseUrl; ?>SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="<?php echo $SiteBaseUrl; ?>SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.twzipcode.js" type="text/javascript"></script>
<link href="<?php echo $SiteBaseUrl; ?>SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl; ?>SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
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
                  <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $Lang_Classify_Shopping_Process_Step_Pay; //付款與運送方式 ?></span></h1>
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
        <div style="-moz-box-shadow:0px 0px 1px rgba(0,0,0,.6); -webkit-box-shadow:0px 0px 1px rgba(0,0,0,.6); box-shadow:0px 0px 1px rgba(0,0,0,.6); background-color: rgba(255, 255, 255, 0.6); padding:10px;">
        <div class="row process-wizard process-wizard-info">

	<div class="col-xs-3 process-wizard-step complate">
		<div class="text-center process-wizard-stepnum">Step 1</div>
		<div class="progress"><div class="progress-bar"></div></div>
		<a href="#" class="process-wizard-dot"></a>
		<div class="process-wizard-info text-center"><?php echo $Lang_Classify_Shopping_Process_Step_Confirmed; //確認購物車 ?></div>
	</div>

	<div class="col-xs-3 process-wizard-step active"><!-- complete -->
		<div class="text-center process-wizard-stepnum">Step 2</div>
		<div class="progress"><div class="progress-bar"></div></div>
		<a href="#" class="process-wizard-dot"></a>
		<div class="process-wizard-info text-center"><?php echo $Lang_Classify_Shopping_Process_Step_Pay; //付款與運送方式 ?></div>
	</div>

	<div class="col-xs-3 process-wizard-step disabled"><!-- complete -->
		<div class="text-center process-wizard-stepnum">Step 3</div>
		<div class="progress"><div class="progress-bar"></div></div>
		<a href="#" class="process-wizard-dot"></a>
		<div class="process-wizard-info text-center"><?php echo $Lang_Classify_Shopping_Process_Step_Edit; //資料填寫 ?></div>
	</div>

	<div class="col-xs-3 process-wizard-step disabled"><!-- active -->
		<div class="text-center process-wizard-stepnum">Step 4</div>
		<div class="progress"><div class="progress-bar"></div></div>
		<a href="#" class="process-wizard-dot"></a>
		<div class="process-wizard-info text-center"><?php echo $Lang_Classify_Shopping_Process_Step_Order; //確認訂單?></div>
	</div>
    </div>

</div>
<div style="height:5px;"></div>

          <?php if($totalRows_RecordCartlist > 0){ ?>
          
          <form id="form1" name="form1" method="post" action="<?php echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'purchasepage'),'',$UrlWriteEnable);?>">
          
            <fieldset>
            <div style="-moz-box-shadow:0px 0px 1px rgba(0,0,0,.6); -webkit-box-shadow:0px 0px 1px rgba(0,0,0,.6); box-shadow:0px 0px 1px rgba(0,0,0,.6); background-color: rgba(255, 255, 255, 0.6); padding:10px;">  
              <?php 
			if ($totalRows_RecordCartListFreight == 0) { // 未設定任何貨運價格
			echo "<input name=\"ocfreightselectno\" type=\"hidden\" id=\"ocfreightselectno\" value=\"1\" />";
			}
		?>
              <?php if ($totalRows_RecordCartListFreight > 0 || (($row_RecordSystemConfigOtr['sevenshopenable'] == '1' || $row_RecordSystemConfigOtr['sevenshopnopayenable'] == '1' || $row_RecordSystemConfigOtr['familyshopenable'] == '1' || $row_RecordSystemConfigOtr['familyshopnopayenable'] == '1') && $row_RecordSystemConfigOtr['allpaypaymentnumber'] != "")) { ?>
              <h4><i class="fa fa-pencil-square-o"></i> <?php echo $Lang_Classify_Context_Cart_Payment_And_Shipping_Information ?></h4>
              <hr>
              <div class="form-group">
                <label class="col-md-12 col-sm-12 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Cart_Delivery_Method ?>:</span></label>
                <div class="row margin-0">
                <div class="col-md-12 col-sm-12 col-xs-12 padding-10" style="border:#EEE solid 1px; background-color: rgba(255, 255, 255, 0.6);">
                  <?php //echo $totalRows_RecordCartListFreight; ?>
                  
                  
                    <?php $productcome=0; //貨到付款計數初始化 ?>
                    
                    <?php if ($row_RecordSystemConfigOtr['sevenshopenable'] == '1' && $row_RecordSystemConfigOtr['allpaypaymentnumber'] != "") { ?>
                      <div class="row">
                      <?php 
					  /*****************************************************************************************/
					  // 7-11 超商取貨付款
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-5 col-sm-12 col-xs-12">
                      <div class="radio">
                          <input type="radio" name="ocfreightselect" value="sevenshop" id="ocfreightselect_sevenshop" onclick="return checkfreightradio_sevenshop();"/>
                          <label for="ocfreightselect_sevenshop"> 7-11 超商取貨(取貨付款) </label>
                        </div>
                      </div>
                      <script type="text/javascript">
								function checkfreightradio_sevenshop(){ 
									  var item = $("input[name='ocfreightselect']:checked"); 
									  var len=item.length; 
									  if(len>0){ 
										$("input[name='ocpaymentselect']").each(function(){
												   $(this).prop("checked",false);
												   $(this).prop("disabled", true);
												   $("#ocpaymentselect_pay").prop("disabled", true);
											  });
											  $("#ocpaymentselect_pay").prop("checked",true);
										      $("#ocpaymentselect_pay").prop("disabled", false);
									  } 
									  //checkCashFlow<?php echo $row_RecordCartListFreight['item_id']; ?>();
									  }
                                </script>
                      <?php 
					  /*****************************************************************************************/
					  // \7-11 超商取貨付款
					  /*****************************************************************************************/
					  ?>
                      <?php 
					  /*****************************************************************************************/
					  // 7-11 超商取貨付款
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-7 col-sm-12 col-xs-12">
                      <?php if ($row_RecordSystemConfigOtr['sevenshopshipment'] != "") { ?>
                      <div style="color:#C00; font-weight:bolder;" >
                      運費：<?php echo $row_RecordSystemConfigOtr['sevenshopshipment']; ?>
                      </div>
                      <?php } ?>
					  <?php echo $row_RecordSystemConfigOtr['sevenshopdesc']; ?>
                      </div>
                      <?php 
					  /*****************************************************************************************/
					  // \7-11 超商取貨付款
					  /*****************************************************************************************/
					  ?>
                    </div>
                    <div style="border-bottom:1px solid #DDD; margin-bottom:5px"></div> 
                    <?php  } ?>
                    
                    <?php if ($row_RecordSystemConfigOtr['sevenshopnopayenable'] == '1' && $row_RecordSystemConfigOtr['allpaypaymentnumber'] != "") { ?>
                      <div class="row">
                      <?php 
					  /*****************************************************************************************/
					  // 7-11 超商取貨付款(純配送)
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-5 col-sm-12 col-xs-12">
                      <div class="radio">
                          <input type="radio" name="ocfreightselect" value="sevenshopnopay" id="ocfreightselect_sevenshopnopay" onclick="return checkfreightradio_sevenshopnopay();"/>
                          <label for="ocfreightselect_sevenshopnopay"> 7-11 超商取貨(純配送) </label>
                        </div>
                      </div>
                      <script type="text/javascript">
								function checkfreightradio_sevenshopnopay(){ 
									  var item = $("input[name='ocfreightselect']:checked"); 
									  var len=item.length; 
									  if(len>0){ 
									  	$("input[name='payondeliveryenable']").each(function(){
										   $(this).prop("checked",false);
										   $(this).prop("disabled", true);
										});  
										//$("#payondeliveryenable<?php echo $row_RecordCartListFreight['item_id']; ?>").removeAttr('disabled');
										$("input[name='ocpaymentselect']").each(function(){
										   $(this).prop("checked",false);
										   $(this).prop("disabled", false);
										   $("#ocpaymentselect_pay").prop("disabled", true);
										});
									  }
									  //checkCashFlow<?php echo $row_RecordCartListFreight['item_id']; ?>();
								}
                                </script>
                      <?php 
					  /*****************************************************************************************/
					  // \7-11 超商取貨付款(純配送)
					  /*****************************************************************************************/
					  ?>
                      <?php 
					  /*****************************************************************************************/
					  // 7-11 超商取貨付款(純配送)
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-7 col-sm-12 col-xs-12">
                      <?php if ($row_RecordSystemConfigOtr['sevenshopnopayshipment'] != "") { ?>
                      <div style="color:#C00; font-weight:bolder;" >
                      運費：<?php echo $row_RecordSystemConfigOtr['sevenshopnopayshipment']; ?>
                      </div>
                      <?php } ?>
					  <?php echo $row_RecordSystemConfigOtr['sevenshopnopaydesc']; ?>
                      </div>
                      <?php 
					  /*****************************************************************************************/
					  // \7-11 超商取貨付款(純配送)
					  /*****************************************************************************************/
					  ?>
                    </div>
                    <div style="border-bottom:1px solid #DDD; margin-bottom:5px"></div> 
                    <?php  } ?>
                    
                    <?php if ($row_RecordSystemConfigOtr['familyshopenable'] == '1' && $row_RecordSystemConfigOtr['allpaypaymentnumber'] != "") { ?>
                      <div class="row">
                      <?php 
					  /*****************************************************************************************/
					  // 全家超商取貨付款
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-5 col-sm-12 col-xs-12">
                      <div class="radio">
                          <input type="radio" name="ocfreightselect" value="familyshop" id="ocfreightselect_familyshop" onclick="return checkfreightradio_familyshop();"/>
                          <label for="ocfreightselect_familyshop"> 全家超商取貨(取貨付款) </label>
                        </div>
                      </div>
                      <script type="text/javascript">
								function checkfreightradio_familyshop(){ 
									  var item = $("input[name='ocfreightselect']:checked"); 
									  var len=item.length; 
									  if(len>0){ 
										$("input[name='ocpaymentselect']").each(function(){
												   $(this).prop("checked",false);
												   $(this).prop("disabled", true);
												   $("#ocpaymentselect_pay").prop("disabled", true);
											  });
											  $("#ocpaymentselect_pay").prop("checked",true);
										      $("#ocpaymentselect_pay").prop("disabled", false);
									  } 
									  //checkCashFlow<?php echo $row_RecordCartListFreight['item_id']; ?>();
									  }
                                </script>
                      <?php 
					  /*****************************************************************************************/
					  // \全家超商取貨付款
					  /*****************************************************************************************/
					  ?>
                      <?php 
					  /*****************************************************************************************/
					  // 全家超商取貨付款
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-7 col-sm-12 col-xs-12">
                      <?php if ($row_RecordSystemConfigOtr['familyshopshipment'] != "") { ?>
                      <div style="color:#C00; font-weight:bolder;" >
                      運費：<?php echo $row_RecordSystemConfigOtr['familyshopshipment']; ?>
                      </div>
                      <?php } ?>
					  <?php echo $row_RecordSystemConfigOtr['familyshopdesc']; ?>
                      </div>
                      <?php 
					  /*****************************************************************************************/
					  // \全家超商取貨付款
					  /*****************************************************************************************/
					  ?>
                    </div>
                    <div style="border-bottom:1px solid #DDD; margin-bottom:5px"></div> 
                    <?php  } ?>
                    
                    
                    <?php if ($row_RecordSystemConfigOtr['familyshopnopayenable'] == '1' && $row_RecordSystemConfigOtr['allpaypaymentnumber'] != "") { ?>
                      <div class="row">
                      <?php 
					  /*****************************************************************************************/
					  // 全家超商取貨付款(純配送)
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-5 col-sm-12 col-xs-12">
                      <div class="radio">
                          <input type="radio" name="ocfreightselect" value="familyshopnopay" id="ocfreightselect_familyshopnopay" onclick="return checkfreightradio_familyshopnopay();"/>
                          <label for="ocfreightselect_familyshopnopay"> 全家超商取貨(純配送) </label>
                        </div>
                      </div>
                      <script type="text/javascript">
								function checkfreightradio_familyshopnopay(){ 
									  var item = $("input[name='ocfreightselect']:checked"); 
									  var len=item.length; 
									  if(len>0){ 
									  	$("input[name='payondeliveryenable']").each(function(){
										   $(this).prop("checked",false);
										   $(this).prop("disabled", true);
										});  
										//$("#payondeliveryenable<?php echo $row_RecordCartListFreight['item_id']; ?>").removeAttr('disabled');
										$("input[name='ocpaymentselect']").each(function(){
										   $(this).prop("checked",false);
										   $(this).prop("disabled", false);
										   $("#ocpaymentselect_pay").prop("disabled", true);
										});
									  }
									  //checkCashFlow<?php echo $row_RecordCartListFreight['item_id']; ?>();
								}
                                </script>
                      <?php 
					  /*****************************************************************************************/
					  // \全家超商取貨付款(純配送)
					  /*****************************************************************************************/
					  ?>
                      <?php 
					  /*****************************************************************************************/
					  // 全家超商取貨付款(純配送)
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-7 col-sm-12 col-xs-12">
                      <?php if ($row_RecordSystemConfigOtr['familyshopnopayshipment'] != "") { ?>
                      <div style="color:#C00; font-weight:bolder;" >
                      運費：<?php echo $row_RecordSystemConfigOtr['familyshopnopayshipment']; ?>
                      </div>
                      <?php } ?>
					  <?php echo $row_RecordSystemConfigOtr['familyshopnopaydesc']; ?>
                      </div>
                      <?php 
					  /*****************************************************************************************/
					  // \全家超商取貨付款(純配送)
					  /*****************************************************************************************/
					  ?>
                    </div>
                    <div style="border-bottom:1px solid #DDD; margin-bottom:5px"></div> 
                    <?php  } ?>
                    
                    <?php if ($totalRows_RecordCartListFreight > 0) {  ?>
                    <?php do { ?>
                      <div class="row">
                      <?php 
					  /*****************************************************************************************/
					  // 貨運方式主標題
					  /*****************************************************************************************/
					  ?>
                      
                      <div class="col-md-5 col-sm-12 col-xs-12">
                      <div class="radio">
                          <input type="radio" name="ocfreightselect" value="<?php echo $row_RecordCartListFreight['item_id']; ?>" id="ocfreightselect_<?php echo $row_RecordCartListFreight['item_id']; ?>" onclick="return checkfreightradio<?php echo $row_RecordCartListFreight['item_id']; ?>();"/>
                          <label for="ocfreightselect_<?php echo $row_RecordCartListFreight['item_id']; ?>"> <?php echo $row_RecordCartListFreight['itemname']; ?> </label>
                        </div>
                        <div style="color:#06F; font-weight:bolder">
                          <?php
						//  貨到付款判斷
						switch($row_RecordCartListFreight['productcome'])
			            {
							case "0":
				    		//echo "無提供貨到付款";
						?>
                          <script type="text/javascript">
								function checkfreightradio<?php echo $row_RecordCartListFreight['item_id']; ?>(){ 
									  var item = $("input[name='ocfreightselect']:checked"); 
									  var len=item.length; 
									  if(len>0){ 
									  	$("input[name='payondeliveryenable']").each(function(){
										   $(this).prop("checked",false);
										   $(this).prop("disabled", true);
										});  
										$("#payondeliveryenable<?php echo $row_RecordCartListFreight['item_id']; ?>").removeAttr('disabled');
										$("input[name='ocpaymentselect']").each(function(){
										   $(this).prop("checked",false);
										   $(this).prop("disabled", false);
										   $("#ocpaymentselect_pay").prop("disabled", true);
										});
									  }
									  checkCashFlow<?php echo $row_RecordCartListFreight['item_id']; ?>();
								}
                                </script>
                          <?php
							
							break;
							case "1":
							$productcome++; // 貨到付款計數
							if($row_RecordCartListFreight['productcomeprice'] == "") // 有提供，且消費者可選擇是否要貨到付款 不設限金額
							{
					    ?>
                          <div class="checkbox checkbox-primary">
                            <input name="payondeliveryenable" type="checkbox" value="1" id="payondeliveryenable<?php echo $row_RecordCartListFreight['item_id']; ?>" disabled="disabled" onclick="return checkpayondeliverychecked<?php echo $row_RecordCartListFreight['item_id']; ?>();"/>
                            <label for="payondeliveryenable<?php echo $row_RecordCartListFreight['item_id']; ?>"> <?php echo $Lang_Classify_Context_Cart_I_Want_To_Cash_On_Delivery /*  我要貨到付款 */ ?> </label>
                          </div>
                          <script type="text/javascript">        
									  // 判斷radio是否選中並取得選中的值
									  function checkfreightradio<?php echo $row_RecordCartListFreight['item_id']; ?>(){ 
									  var item = $("input[name='ocfreightselect']:checked"); 
									  var len=item.length; 
									  if(len>0){ 
										//$('#payondeliveryenable+$("input[name='ocfreightselect']:checked").val()').prop('disabled', false);
										//alert("yes--選中的值为："+$("input[name='ocfreightselect']:checked").val()); 
										//alert($("input[name='ocfreightselect']:checked").val());
										//n = $("input[name='ocfreightselect']:checked").val();
										$("input[name='payondeliveryenable']").each(function(){
										   $(this).prop("checked",false);
										   $(this).prop("disabled", true);
										});  
										$("#payondeliveryenable<?php echo $row_RecordCartListFreight['item_id']; ?>").removeAttr('disabled');
										$("input[name='ocpaymentselect']").each(function(){
										   $(this).prop("checked",false);
										   $(this).prop("disabled", false);
										   $("#ocpaymentselect_pay").prop("disabled", true);
										});
									  } 
									  checkCashFlow<?php echo $row_RecordCartListFreight['item_id']; ?>();
									  } 
									  // 判斷貨到付款是否選中並取得選中的值
									  function checkpayondeliverychecked<?php echo $row_RecordCartListFreight['item_id']; ?>(){
										  if($("#payondeliveryenable<?php echo $row_RecordCartListFreight['item_id']; ?>").prop('checked')){
											  $("input[name='ocpaymentselect']").each(function(){
												   $(this).prop("checked",false);
												   $(this).prop("disabled", true);
											  });
											  $("#ocpaymentselect_pay").prop("checked",true);
										      $("#ocpaymentselect_pay").prop("disabled", false);
										  }else{
											  $("input[name='ocpaymentselect']").each(function(){
												   $(this).prop("checked",false);
												   $(this).prop("disabled", false);
											  });
											  //$("#ocpaymentselect_pay").prop("checked",true);
										      $("#ocpaymentselect_pay").prop("disabled", true);
										  }
										  <?php if($row_RecordCartListFreight['mode'] == '2' || $row_RecordCartListFreight['mode'] == '3') { // 廠商自填運費 ?>
										  checkCashFlow<?php echo $row_RecordCartListFreight['item_id']; ?>();
										  <?php } ?>
									  }
								</script>
                          <?php
							}else{ // 有提供，且消費者可選擇是否要貨到付款 有設限金額
						?>
                          <div class="checkbox checkbox-primary">
                            <input name="payondeliveryenable" type="checkbox" value="1" id="payondeliveryenable<?php echo $row_RecordCartListFreight['item_id']; ?>" disabled="disabled" onclick="return checkpayondeliverychecked<?php echo $row_RecordCartListFreight['item_id']; ?>();"/>
                            <label for="payondeliveryenable<?php echo $row_RecordCartListFreight['item_id']; ?>"> <?php echo $Lang_Classify_Context_Cart_I_Want_To_Cash_On_Delivery; /*  我要貨到付款 */ ?> </label>
                          </div>
                          <br />
                          (<?php echo $Lang_Classify_Context_Cart_Purchase_Amount_To_Be_Less_Than; /* 購買金額需低於 */?><?php echo $row_RecordCartListFreight['productcomeprice'] ?><?php echo $Lang_Classify_Context_Cart_Money_Unit /* 元 */ ?>)
                          <?php //echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['Total']); // 目前金額 ?>
                          <script type="text/javascript">        
									  // 判斷radio是否選中並取得選中的值
									  function checkfreightradio<?php echo $row_RecordCartListFreight['item_id']; ?>(){ 
									  var item = $("input[name='ocfreightselect']:checked"); 
									  var len=item.length; 
									  if(len>0){ 
										//$('#payondeliveryenable+$("input[name='ocfreightselect']:checked").val()').prop('disabled', false);
										//alert("yes--選中的值为："+$("input[name='ocfreightselect']:checked").val()); 
										//alert($("input[name='ocfreightselect']:checked").val());
										//n = $("input[name='ocfreightselect']:checked").val();
										$("input[name='payondeliveryenable']").each(function(){
										   $(this).prop("checked",false);
										   $(this).prop("disabled", true);
										});
										$("input[name='ocpaymentselect']").each(function(){
										   $(this).prop("checked",false);
										   $(this).prop("disabled", false);
										   $("#ocpaymentselect_pay").prop("disabled", true);
										});
										<?php if($_SESSION['Total'] < $row_RecordCartListFreight['productcomeprice']) { ?>
										$("#payondeliveryenable<?php echo $row_RecordCartListFreight['item_id']; ?>").removeAttr('disabled');
										<?php } ?>
										//$("#ocpaymentselect_pay").prop("disabled", true);
									  } 
									  checkCashFlow<?php echo $row_RecordCartListFreight['item_id']; ?>();
									  } 
									  // 判斷貨到付款是否選中並取得選中的值
									  function checkpayondeliverychecked<?php echo $row_RecordCartListFreight['item_id']; ?>(){
										  if($("#payondeliveryenable<?php echo $row_RecordCartListFreight['item_id']; ?>").prop('checked')){
											  $("input[name='ocpaymentselect']").each(function(){
												   $(this).prop("checked",false);
												   $(this).prop("disabled", true);
											  });
											  $("#ocpaymentselect_pay").prop("checked",true);
										      $("#ocpaymentselect_pay").prop("disabled", false);
										  }else{
											  $("input[name='ocpaymentselect']").each(function(){
												   $(this).prop("checked",false);
												   $(this).prop("disabled", false);
											  });
											  //$("#ocpaymentselect_pay").prop("checked",true);
										      $("#ocpaymentselect_pay").prop("disabled", true);
										  }
										  <?php if($row_RecordCartListFreight['mode'] == '2' || $row_RecordCartListFreight['mode'] == '3') { // 廠商自填運費 ?>
										  checkCashFlow<?php echo $row_RecordCartListFreight['item_id']; ?>();
										  <?php } ?>
									  }
								</script>
                          <?php
								//echo "有提供貨到付款" . "<br/>" . "(需低於" . $row_RecordCartListFreight['productcomeprice'] . "元)";
							}
							break;
							case "2":
							$productcome++; // 貨到付款計數
						?>
                          <div class="checkbox checkbox-primary">
                            <input name="payondeliveryenable" type="checkbox" value="1" id="payondeliveryenable<?php echo $row_RecordCartListFreight['item_id']; ?>" disabled="disabled"/>
                            <label for="payondeliveryenable<?php echo $row_RecordCartListFreight['item_id']; ?>"> <?php echo $Lang_Classify_Context_Cart_I_Want_To_Cash_On_Delivery /*  我要貨到付款 */ ?> </label>
                          </div>
                          <script type="text/javascript">        
									  // 判斷radio是否選中並取得選中的值
									  function checkfreightradio<?php echo $row_RecordCartListFreight['item_id']; ?>(){ 
									  var item = $("input[name='ocfreightselect']:checked"); 
									  var len=item.length; 
									  if(len>0){ 
										//$('#payondeliveryenable+$("input[name='ocfreightselect']:checked").val()').prop('disabled', false);
										//alert("yes--選中的值为："+$("input[name='ocfreightselect']:checked").val()); 
										//alert($("input[name='ocfreightselect']:checked").val());
										//n = $("input[name='ocfreightselect']:checked").val();
										$("input[name='payondeliveryenable']").each(function(){
										   $(this).prop("checked",false);
										   $(this).prop("disabled", true);
										});  
										$("#payondeliveryenable<?php echo $row_RecordCartListFreight['item_id']; ?>").prop("checked",true);
										//$("#payondeliveryenable<?php echo $row_RecordCartListFreight['item_id']; ?>").removeAttr('disabled');
										$("input[name='ocpaymentselect']").each(function(){
												   $(this).prop("checked",false);
												   $(this).prop("disabled", true);
												   $("#ocpaymentselect_pay").prop("disabled", true);
											  });
											  $("#ocpaymentselect_pay").prop("checked",true);
										      $("#ocpaymentselect_pay").prop("disabled", false);
									  } 
									  checkCashFlow<?php echo $row_RecordCartListFreight['item_id']; ?>();
									  }
								</script>
                          <?php
				    		//echo "有提供貨到付款";
							break;
						}
						?>
                        </div>
                        </div>
                        <?php 
					  /*****************************************************************************************/
					  // \貨運方式主標題
					  /*****************************************************************************************/
					  ?>
                        
                        
                        
                       
                      <?php 
					  /*****************************************************************************************/
					  // 貨運方式詳細內容
					  /*****************************************************************************************/
					  ?>
                      
                      
                      <div class="col-md-7 col-sm-12 col-xs-12">
                      <div style="color:#C00; font-weight:bolder;" >
                          <?php
						//  顯示運費狀態
						switch($row_RecordCartListFreight['mode'])
			            {
							case "0":
				    		echo $Lang_Classify_Context_Cart_No_Freight; // 不須運費
							break;
							case "1":
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
                          <script type="text/javascript">
                                function checkCashFlow<?php echo $row_RecordCartListFreight['item_id']; ?>(){
									$("#ocpaymentselect_allpay").prop("disabled", true);
									$("#ocpaymentselect_pchomepay").prop("disabled", true);
									$("#ocpaymentselect_allpay_Credit").prop("disabled", true);
									$("#ocpaymentselect_allpay_BARCODE").prop("disabled", true);
									$("#ocpaymentselect_allpay_CVS").prop("disabled", true);
                                }
							</script>
                          <?php
							break;
							case "3":
				    		echo $Lang_Classify_Context_Cart_Freight_User_Offer; /* 消費者自填運費，此方式不支援金流 */
						?>
                          <script type="text/javascript">
                                function checkCashFlow<?php echo $row_RecordCartListFreight['item_id']; ?>(){
									$("#ocpaymentselect_allpay").prop("disabled", true);
									$("#ocpaymentselect_pchomepay").prop("disabled", true);
									$("#ocpaymentselect_allpay_Credit").prop("disabled", true);
									$("#ocpaymentselect_allpay_BARCODE").prop("disabled", true);
									$("#ocpaymentselect_allpay_CVS").prop("disabled", true);
                                }
							</script>
                          <?php
							break;
						}
						?>
                        </div>
                        <?php if ($row_RecordCartListFreight['mode'] == '3') { ?>
                        <label for="userinputfreight<?php echo $row_RecordCartListFreight['item_id']; ?>"><?php echo $Lang_Classify_Context_Cart_Enter_Your_Own_Shipping_Cost; /* 自行輸入運費 */ ?>：</label>
                        <span id="sprytextfielddynamicprice<?php echo $row_RecordCartListFreight['item_id']; ?>">
                        <input name="userinputfreight<?php echo $row_RecordCartListFreight['item_id']; ?>" type="text" id="userinputfreight<?php echo $row_RecordCartListFreight['item_id']; ?>" size="6" maxlength="11" />
                        <?php echo $Lang_Classify_Context_Cart_Money_Unit /* 元 */ ?> <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03 ?></span><span class="textfieldInvalidFormatMsg"><?php echo $Lang_Classify_Send_Error05 ?>。</span><span class="textfieldMinValueMsg"><?php echo $Lang_Classify_Send_Error10 ?></span></span><br />
                        <?php } ?>
                        <?php echo $row_RecordCartListFreight['content']; ?> 
                        <script type="text/javascript">
						var sprytextfielddynamicprice<?php echo $row_RecordCartListFreight['item_id']; ?> = new Spry.Widget.ValidationTextField("sprytextfielddynamicprice<?php echo $row_RecordCartListFreight['item_id']; ?>", "integer", {validateOn:["blur"], isRequired:false, minValue:0});
						</script>
                        </div>
                        
                        
                        <?php 
					  /*****************************************************************************************/
					  // \貨運方式詳細內容
					  /*****************************************************************************************/
					  ?>
                      </div>  
                      <div style="border-bottom:1px solid #DDD; margin-bottom:5px"></div>                        
                     
                    <?php } while ($row_RecordCartListFreight = mysqli_fetch_assoc($RecordCartListFreight)); ?>
                    <?php }  ?>
                  
                </div>
                </div>
              </div>
              <?php } ?>
              <div class="form-group">
                <label class="col-md-12 col-sm-12 col-xs-12 "><span class="columnName"><?php echo $Lang_Classify_Context_Cart_Payment_Method ?>:</span></label>
                <div class="row margin-0">
                <div class="col-md-12 col-sm-12 col-xs-12 padding-10" style="border:#EEE solid 1px; background-color: rgba(255, 255, 255, 0.6);">
                  
                    <?php if (($totalRows_RecordCartListFreight > 0 && $productcome > 0) || (($row_RecordSystemConfigOtr['sevenshopenable'] == '1' || $row_RecordSystemConfigOtr['familyshopenable'] == '1') && $row_RecordSystemConfigOtr['allpaypaymentnumber'] != "")) { ?>
                    
                      <div class="row">
                      <?php 
					  /*****************************************************************************************/
					  // 貨到付款
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-5 col-sm-12 col-xs-12">
                      <div class="radio radio-inline">
                          <input type="radio" name="ocpaymentselect" value="payondelivery" id="ocpaymentselect_pay" />
                          <label for="ocpaymentselect_pay"> <?php echo $Lang_Classify_Context_Cart_Cash_On_Delivery; //貨到付款 ?></label>
                        </div>
                      </div>
                      <?php 
					  /*****************************************************************************************/
					  // \貨到付款
					  /*****************************************************************************************/
					  ?>  
                     
					  <?php 
					  /*****************************************************************************************/
					  // 貨到付款
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-7 col-sm-12 col-xs-12">
					  <?php echo $row_RecordSystemConfigOtr['productcomedesc']; ?>
                      </div>
                      <?php 
					  /*****************************************************************************************/
					  // \貨到付款
					  /*****************************************************************************************/
					  ?>
                      </div>
                      <div style="border-bottom:1px solid #DDD; margin-bottom:5px"></div> 
                     
                    <?php } ?>
                    <?php if ($row_RecordSystemConfigOtr['linguipaymentenable'] == '1') { ?>
                    
                      <div class="row">
                      <?php 
					  /*****************************************************************************************/
					  // 金融匯款
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-5 col-sm-12 col-xs-12">
                      <div class="radio radio-inline">
                          <input type="radio" name="ocpaymentselect" value="lingui" id="ocpaymentselect_0" />
                          <label for="ocpaymentselect_0"> <?php echo $Lang_Classify_Context_Cart_Financial_Remittance; //金融匯款 ?> </label>
                        </div>
                        </div>
                       <?php 
					  /*****************************************************************************************/
					  // \金融匯款
					  /*****************************************************************************************/
					  ?> 
                        
                       
					  <?php 
					  /*****************************************************************************************/
					  // 金融匯款
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-7 col-sm-12 col-xs-12">
					  <?php echo $row_RecordSystemConfigOtr['linguipaymentdesc']; ?>
                      </div>
                      <?php 
					  /*****************************************************************************************/
					  // \金融匯款
					  /*****************************************************************************************/
					  ?>
                      </div>
                      <div style="border-bottom:1px solid #DDD; margin-bottom:5px"></div> 
                      
                     
                    <?php } ?>
                    <?php if ($row_RecordSystemConfigOtr['atmpaymentenable'] == '1') { ?>
                    
                      <div class="row">
                      <?php 
					  /*****************************************************************************************/
					  // ATM轉帳
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-5 col-sm-12 col-xs-12">
                      <div class="radio radio-inline">
                          <input type="radio" name="ocpaymentselect" value="atm" id="ocpaymentselect_1" />
                          <label for="ocpaymentselect_1"> <?php echo $Lang_Classify_Context_Cart_ATM_Transfers; //ATM轉帳 ?> </label>
                        </div>
                        </div>
                      <?php 
					  /*****************************************************************************************/
					  // \ATM轉帳
					  /*****************************************************************************************/
					  ?>
                        
                       
					  <?php 
					  /*****************************************************************************************/
					  // ATM轉帳
					  /*****************************************************************************************/
					  ?> 
                      <div class="col-md-7 col-sm-12 col-xs-12">
					  <?php echo $row_RecordSystemConfigOtr['atmpaymentdesc']; ?>
                      </div>
                      <?php 
					  /*****************************************************************************************/
					  // \ATM轉帳
					  /*****************************************************************************************/
					  ?>
                      </div>
                      <div style="border-bottom:1px solid #DDD; margin-bottom:5px"></div> 
                      
                    <?php } ?>
                    <?php if ($row_RecordSystemConfigOtr['postofficepaymentenable'] == '1') { ?>
                    
                      <div class="row">
                      <?php 
					  /*****************************************************************************************/
					  // 郵政劃撥
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-5 col-sm-12 col-xs-12">
                      <div class="radio radio-inline">
                          <input type="radio" name="ocpaymentselect" value="postoffice" id="ocpaymentselect_2" />
                          <label for="ocpaymentselect_2"> <?php echo $Lang_Classify_Context_Cart_Postal_Allocation; //郵政劃撥 ?> </label>
                        </div>
                        </div>
                      <?php 
					  /*****************************************************************************************/
					  // \郵政劃撥
					  /*****************************************************************************************/
					  ?>  
                      
					  <?php 
					  /*****************************************************************************************/
					  // 郵政劃撥
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-7 col-sm-12 col-xs-12">
					  <?php echo $row_RecordSystemConfigOtr['postofficepaymentdesc']; ?>
                      </div>
                      <?php 
					  /*****************************************************************************************/
					  // \郵政劃撥
					  /*****************************************************************************************/
					  ?>
                      
                      </div>
                      <div style="border-bottom:1px solid #DDD; margin-bottom:5px"></div> 
                     
                    <?php } ?>
                    <?php if ($row_RecordSystemConfigOtr['otherpaymentenable'] == '1') { ?>
                    
                      <div class="row">
                      <?php 
					  /*****************************************************************************************/
					  // 其他付款方式
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-5 col-sm-12 col-xs-12">
                      <div class="radio radio-inline">
                          <input type="radio" name="ocpaymentselect" value="other" id="ocpaymentselect_3" />
                          <label for="ocpaymentselect_3"> <?php echo $Lang_Classify_Context_Cart_Other_Payment_Methods; //其他付款方式 ?> </label>
                        </div>
                        </div>
                      <?php 
					  /*****************************************************************************************/
					  // \其他付款方式
					  /*****************************************************************************************/
					  ?>  
                       
					  <?php 
					  /*****************************************************************************************/
					  // 其他付款方式
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-7 col-sm-12 col-xs-12">
					  <?php echo $row_RecordSystemConfigOtr['otherpaymentdesc']; ?>
                      </div>
                      <?php 
					  /*****************************************************************************************/
					  // \其他付款方式
					  /*****************************************************************************************/
					  ?>
                      </div>
                      <div style="border-bottom:1px solid #DDD; margin-bottom:5px"></div> 
                      
                    
                    <?php } ?>
                    <?php if ($row_RecordSystemConfigOtr['allpaypaymentenable'] == '1') { ?>
                    
                      <div class="row">
                      <?php 
					  /*****************************************************************************************/
					  // 綠界金流
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-5 col-sm-12 col-xs-12">
                      <div class="radio radio-inline">
                          <input type="radio" name="ocpaymentselect" value="allpay" id="ocpaymentselect_allpay" />
                          <label for="ocpaymentselect_allpay"> <?php echo $Lang_Classify_Context_Cart_ECPay; //綠界金流 ?> <img src="<?php echo $SiteBaseUrl; ?>images/ecpay_slogo.jpg" width="60" height="24"/></label>
                        </div>
                        </div>
                      <?php 
					  /*****************************************************************************************/
					  // \綠界金流
					  /*****************************************************************************************/
					  ?>  
                       
					  <?php 
					  /*****************************************************************************************/
					  // 綠界金流
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-7 col-sm-12 col-xs-12">
					  <?php echo $row_RecordSystemConfigOtr['allpaypaymentdesc']; ?>
                      </div>
                      <?php 
					  /*****************************************************************************************/
					  // \綠界金流
					  /*****************************************************************************************/
					  ?>
                      </div>
                      <div style="border-bottom:1px solid #DDD; margin-bottom:5px"></div> 
                      
                    <?php } ?>
                    <?php if ($row_RecordSystemConfigOtr['allpaypaymentenable_Credit'] == '1') { ?>
                    
                      <div class="row">
                      <?php 
					  /*****************************************************************************************/
					  // 綠界金流 - 信用卡一次付清
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-5 col-sm-12 col-xs-12">
                      <div class="radio radio-inline">
                          <input type="radio" name="ocpaymentselect" value="allpay_Credit" id="ocpaymentselect_allpay_Credit" />
                          <label for="ocpaymentselect_allpay_Credit"> <?php echo $Lang_Classify_Context_Cart_ECPay_Credit; //綠界金流 ?> <img src="<?php echo $SiteBaseUrl; ?>images/ecpay_slogo.jpg" width="60" height="24"/></label>
                        </div>
                        </div>
                      <?php 
					  /*****************************************************************************************/
					  // \綠界金流 - 信用卡一次付清
					  /*****************************************************************************************/
					  ?>  
                       
					  <?php 
					  /*****************************************************************************************/
					  // 綠界金流 - 信用卡一次付清
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-7 col-sm-12 col-xs-12">
					  <?php echo $row_RecordSystemConfigOtr['allpaypaymentdesc_Credit']; ?>
                      </div>
                      <?php 
					  /*****************************************************************************************/
					  // \綠界金流 - 信用卡一次付清
					  /*****************************************************************************************/
					  ?>
                      </div>
                      <div style="border-bottom:1px solid #DDD; margin-bottom:5px"></div> 
                      
                    <?php } ?>
                    <?php if ($row_RecordSystemConfigOtr['allpaypaymentenable_BARCODE'] == '1') { ?>
                    
                      <div class="row">
                      <?php 
					  /*****************************************************************************************/
					  // 綠界金流 - 超商條碼
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-5 col-sm-12 col-xs-12">
                      <div class="radio radio-inline">
                          <input type="radio" name="ocpaymentselect" value="allpay_BARCODE" id="ocpaymentselect_allpay_BARCODE" />
                          <label for="ocpaymentselect_allpay_BARCODE"> <?php echo $Lang_Classify_Context_Cart_ECPay_BARCODE; //綠界金流 ?> <img src="<?php echo $SiteBaseUrl; ?>images/ecpay_slogo.jpg" width="60" height="24"/></label>
                        </div>
                        </div>
                      <?php 
					  /*****************************************************************************************/
					  // \綠界金流 - 超商條碼
					  /*****************************************************************************************/
					  ?>  
                       
					  <?php 
					  /*****************************************************************************************/
					  // 綠界金流 - 超商條碼
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-7 col-sm-12 col-xs-12">
					  <?php echo $row_RecordSystemConfigOtr['allpaypaymentdesc_BARCODE']; ?>
                      </div>
                      <?php 
					  /*****************************************************************************************/
					  // \綠界金流 - 超商條碼
					  /*****************************************************************************************/
					  ?>
                      </div>
                      <div style="border-bottom:1px solid #DDD; margin-bottom:5px"></div> 
                      
                    <?php } ?>
                    <?php if ($row_RecordSystemConfigOtr['allpaypaymentenable_CVS'] == '1') { ?>
                    
                      <div class="row">
                      <?php 
					  /*****************************************************************************************/
					  // 綠界金流 - 超商代碼
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-5 col-sm-12 col-xs-12">
                      <div class="radio radio-inline">
                          <input type="radio" name="ocpaymentselect" value="allpay_CVS" id="ocpaymentselect_allpay_CVS" />
                          <label for="ocpaymentselect_allpay_CVS"> <?php echo $Lang_Classify_Context_Cart_ECPay_CVS; //綠界金流 ?> <img src="<?php echo $SiteBaseUrl; ?>images/ecpay_slogo.jpg" width="60" height="24"/></label>
                        </div>
                        </div>
                      <?php 
					  /*****************************************************************************************/
					  // \綠界金流 - 超商代碼
					  /*****************************************************************************************/
					  ?>  
                       
					  <?php 
					  /*****************************************************************************************/
					  // 綠界金流 - 超商代碼
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-7 col-sm-12 col-xs-12">
					  <?php echo $row_RecordSystemConfigOtr['allpaypaymentdesc_CVS']; ?>
                      </div>
                      <?php 
					  /*****************************************************************************************/
					  // \綠界金流 - 超商代碼
					  /*****************************************************************************************/
					  ?>
                      </div>
                      <div style="border-bottom:1px solid #DDD; margin-bottom:5px"></div> 
                      
                    <?php } ?>
                    <?php if ($row_RecordSystemConfigOtr['pchomepaypaymentenable'] == '1') { ?>
                    
                      <div class="row">
                      <?php 
					  /*****************************************************************************************/
					  // PCHOME金流
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-5 col-sm-12 col-xs-12">
                      <div class="radio radio-inline">
                          <input type="radio" name="ocpaymentselect" value="pchomepay" id="ocpaymentselect_pchomepay" />
                          <label for="ocpaymentselect_pchomepay"> <?php echo $Lang_Classify_Context_Cart_PCHOMEPay; //綠界金流 ?> <img src="<?php echo $SiteBaseUrl; ?>images/pchomepay_slogo.jpg" width="60" height="24"/></label>
                        </div>
                        </div>
                      <?php 
					  /*****************************************************************************************/
					  // \PCHOME金流
					  /*****************************************************************************************/
					  ?>  
                       
					  <?php 
					  /*****************************************************************************************/
					  // PCHOME金流
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-7 col-sm-12 col-xs-12">
					  <?php echo $row_RecordSystemConfigOtr['pchomepaypaymentdesc']; ?>
                      </div>
                      <?php 
					  /*****************************************************************************************/
					  // \PCHOME金流
					  /*****************************************************************************************/
					  ?>
                      </div>
                      <div style="border-bottom:1px solid #DDD; margin-bottom:5px"></div> 
                      
                    <?php } ?>
                    <?php if ($row_RecordSystemConfigOtr['paypalpaymentenable'] == '1') { ?>
                    
                      <div class="row">
                      <?php 
					  /*****************************************************************************************/
					  // Paypal金流
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-5 col-sm-12 col-xs-12">
                      <div class="radio radio-inline">
                          <input type="radio" name="ocpaymentselect" value="paypal" id="ocpaymentselect_paypal" />
                          <label for="ocpaymentselect_paypal"> <?php echo $Lang_Classify_Context_Cart_PAYPAL; //綠界金流 ?> <img src="<?php echo $SiteBaseUrl; ?>images/paypal_slogo.jpg" width="60" height="24"/></label>
                        </div>
                        </div>
                      <?php 
					  /*****************************************************************************************/
					  // \Paypal金流
					  /*****************************************************************************************/
					  ?>  
                       
					  <?php 
					  /*****************************************************************************************/
					  // Paypal金流
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-7 col-sm-12 col-xs-12">
					  <?php echo $row_RecordSystemConfigOtr['paypalpaymentdesc']; ?>
                      </div>
                      <?php 
					  /*****************************************************************************************/
					  // \Paypal金流
					  /*****************************************************************************************/
					  ?>
                      </div>
                      <div style="border-bottom:1px solid #DDD; margin-bottom:5px"></div> 
                      
                    <?php } ?>
                    <?php if ($totalRows_RecordCartListPayment > 0) { ?>
                    <?php $CartListPaymentCount = 0; ?>
                    <?php do { ?>
                   
                      <div class="row">
                      <?php 
					  /*****************************************************************************************/
					  // 自訂付款方式
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-5 col-sm-12 col-xs-12">
                      <div class="radio radio-inline">
                          <input type="radio" name="ocpaymentselect" value="<?php echo $row_RecordCartListPayment['itemname']; ?>" id="ocpaymentselect_CartListPayment_<?php echo $CartListPaymentCount; ?>" />
                          <label for="ocpaymentselect_CartListPayment_<?php echo $CartListPaymentCount; ?>"> <?php echo $row_RecordCartListPayment['itemname']; ?></label>
                        </div>
                        </div>
                          <?php 
					  /*****************************************************************************************/
					  // \自訂付款方式
					  /*****************************************************************************************/
					  ?>
					  <?php 
					  /*****************************************************************************************/
					  // 自訂付款方式
					  /*****************************************************************************************/
					  ?>
                      <div class="col-md-7 col-sm-12 col-xs-12">
					  <?php echo $row_RecordCartListPayment['content']; ?>
                      </div>
                      <?php 
					  /*****************************************************************************************/
					  // \自訂付款方式
					  /*****************************************************************************************/
					  ?>
                      </div>
                      <div style="border-bottom:1px solid #DDD; margin-bottom:5px"></div> 
                    <?php $CartListPaymentCount++; ?>
                    <?php } while ($row_RecordCartListPayment = mysqli_fetch_assoc($RecordCartListPayment)); ?>
                    <?php } ?>
                  
                </div>
              </div>
              </div>
              
              </div>
              
              <div class="form-group text-center" >
                <div class="col-md-12 col-sm-12 col-xs-12 margin-top-50"> 
                  <div class="col-md-6 col-sm-6 col-xs-6">
                    <input type="button" name="button3" id="button3" value="<?php echo $Lang_Classify_Prev ?>" onclick="history.back(-1)" class="btn btn-3d btn-warning btn-block"/>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-6">
                    <input type="submit" name="button2" id="button2" value="<?php echo $Lang_Classify_Next ?>" onclick="return CheckFields();" class="btn btn-3d btn-danger btn-block"/>
                  </div>
                </div>
              </div>
            </fieldset>
          </form>
          
          <?php } else { ?>
          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td align="center">
                <table width="250" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="61"><img src="<?php echo $SiteBaseUrl; ?>images/error_tip.png" width="60" height="60" /></td>
                    <td width="189"><?php echo $Lang_Classify_Cart_Removed ?></td>
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
    <?php if ($totalRows_RecordCartListFreight > 0) { ?>
	if($('input[name=ocfreightselect]:checked').val() == undefined) {
			alert("<?php echo $Lang_Classify_Context_JS_Tip_Shipping_Method; //需選擇一個貨運方式 ?>");
			return false;
		}
	<?php } ?>
    <?php if ($row_RecordSystemConfigOtr['linguipaymentenable'] == '1' || $row_RecordSystemConfigOtr['atmpaymentenable'] == '1' || $row_RecordSystemConfigOtr['postofficepaymentenable'] == '1' || $row_RecordSystemConfigOtr['otherpaymentenable'] == '1' || $row_RecordSystemConfigOtr['allpaypaymentenable'] == '1' || $totalRows_RecordCartListPayment > 0) { ?>
		if($('input[name=ocpaymentselect]:checked').val() == undefined) {
			alert("<?php echo $Lang_Classify_Context_JS_Tip_Pay_Method; //需選擇一個付款方式 ?>");
			return false;
		}
	<?php } ?>
	/*if($('input[name=invoiceformat]:checked').val() == "3") {
		if($('input[name=ocinvoiceetselect]:checked').val() == undefined) {
			alert("<?php echo $Lang_Classify_Context_JS_Tip_Electronic_Invoice_Method; //需設定電子發票格式 ?>");
			return false;
		}
	}*/
	<?php if ($row_RecordSystemConfigOtr['invoiceenable'] == '1') { ?>
	/*if($('input[name=invoiceformat]:checked').val() == undefined) {
			alert("<?php echo $Lang_Classify_Context_JS_Tip_Invoice_Method; //需選擇一種發票格式 ?>");
			return false;
		}*/
	<?php } ?>
	/*var foo = $('#twzipcode').twzipcode('serialize'); 
	strs = foo.split("&");
	var occounty = strs[0].split("=");
	var ocdistrict = strs[1].split("=");
	var oczip = strs[2].split("=");
	if(occounty[1] == "") {
		alert("<?php echo $Lang_Classify_Context_JS_Tip_Receive_City_Method; //需選擇收件縣市 ?>");
			return false;
	}*/
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
	/*if($("#autoinputreceiver").prop('checked'))
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
	}*/
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