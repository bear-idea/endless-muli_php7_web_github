<style type="text/css">
#notes1{width:120px}
.InnerButtom{margin-right:2px;margin-top:5px;margin-bottom:5px}
.InnerButtom a{font-weight:700;border:1px solid #CCC;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;text-shadow:0 1px 1px #fff;-webkit-box-shadow:0 1px 1px #fff;-moz-box-shadow:0 1px 1px #fff;box-shadow:0 1px 1px #fff;padding:4px 8px;white-space:nowrap;vertical-align:middle;color:#999;background:transparent;cursor:pointer;font-family:Sans-Serif;font-size:11px}
.InnerButtom a:hover,.InnerButtom a:focus{font-weight:700;border-color:#999;background:-webkit-linear-gradient(top,white,#E0E0E0);background:-moz-linear-gradient(top,white,#E0E0E0);background:-ms-linear-gradient(top,white,#E0E0E0);background:-o-linear-gradient(top,white,#E0E0E0);-webkit-box-shadow:0 1px 2px rgba(0,0,0,0.25),inset 0 0 3px #fff;-moz-box-shadow:0 1px 2px rgba(0,0,0,0.25),inset 0 0 3px #fff;box-shadow:0 1px 2px rgba(0,0,0,0.25),inset 0 0 3px #fff;color:#333;text-decoration:none}
.InnerButtom a:active{font-weight:700;color:#666;border:1px solid #AAA;border-bottom-color:#CCC;border-top-color:#999;-webkit-box-shadow:inset 0 1px 2px #aaa;-moz-box-shadow:inset 0 1px 2px #aaa;box-shadow:inset 0 1px 2px #aaa;background:-webkit-linear-gradient(top,#E6E6E6,gainsboro);background:-moz-linear-gradient(top,#E6E6E6,gainsboro);background:-ms-linear-gradient(top,#E6E6E6,gainsboro);background:-o-linear-gradient(top,#E6E6E6,gainsboro)}
.small-button {width:24px; height:24px; text-align:center; background-color:#FF3300; -webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px; margin:1px;cursor: pointer; color:#FFF; border:none}
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
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $Lang_Title_Cart_Show; // 標題文字 ?></span></h1>
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
      <?php if(isset($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'])  && $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'] != NULL ){ ?>
        <br />
        <?php //echo $Lang_Classify_Shopping_Process; ?>
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
            <li>
                <span class="bubble"></span>
                <?php echo $Lang_Classify_Shopping_Process_Step_Pay; //付款與運送方式 ?>
            </li>
            <li>
                <span class="bubble"></span>
                <?php echo $Lang_Classify_Shopping_Process_Step_Edit; //資料填寫 ?>
            </li>
            <li>
                <span class="bubble"></span>
                <?php echo $Lang_Classify_Shopping_Process_Step_Order; //確認訂單?>
            </li>
        </ul>
        
                          <form name="form1" method="post" action="">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0"class="TB_General_style01">
                          <tr>
                            <td width="50"><strong><?php echo $Lang_Classify_Context_Cart_Number ?></strong></td>
                            <td width="70"><strong><?php echo $Lang_Classify_Context_Pdseries_Product ?></strong></td>
                            <td><strong><?php echo $Lang_Classify_Context_Name_Product ?></strong></td>
                            <td width="100"><strong><?php echo $Lang_Classify_Context_Price_Product ?></strong></td>
                            <td width="120"><strong><?php echo $Lang_Classify_Context_Num_Product ?></strong></td>
                            <td width="120"><strong><?php echo $Lang_Classify_Context_Cart_Note ?></strong></td>
                            <td width="30"><strong><?php echo $Lang_Classify_Context_Cart_Update ?></strong></td>
                            <td width="30"><strong><?php echo $Lang_Classify_Context_Cart_Delete ?></strong></td>
                            <td width="70"><strong><?php echo $Lang_Classify_Context_Cart_Subtotal ?></strong></td>
                          </tr>
                          <?php $NO = 1;?>
                          <?php $_SESSION['Total'] = 0; $_SESSION['PlusTotal'] = 0; // 初始化總金額避免累加?>
                          <?php //$val = ''; $i = 0; // 初始化?>
                          <?php // ======== 商品列表 ======== ?>
                          <?php //echo "共有" . count($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID']); ?>
                          <?php foreach($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'] as $i => $val) { ?>
                          <tr>
                            <td><?php echo $NO; ?></td>
                            <td><?php if($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['PdSeries'][$i] == '') {echo "------";} else { echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['PdSeries'][$i]; } ?></td>
                            <td><a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'cartdetailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'][$i]; ?>"><?php echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Name'][$i]; ?></a><?php if($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Format'][$i] != "") { ?><br /><div class="keytag"><?php $arr_tag = explode(';', $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Format'][$i]); for($fi = 0; $fi < count($arr_tag); $fi++){ echo "<a>".$arr_tag[$fi]."</a>";}?></div><?php } ?><?php if($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['SpFormat'][$i] != "") { ?><div class="keytag"><?php echo "<a>".$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['SpFormat'][$i]."</a>";?></div><?php } ?></td>
                            <td>
                            <?php
                                // 判斷是否採用優惠價格 
                                if($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['SpPrice'][$i] != '')
                                {
                                    echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['SpPrice'][$i];
                            ?>
                                    <span style="font-size:9px; background-color:#FF9393; color:#FFF; padding:2px;"><?php echo $Lang_Classify_Context_Spprice_Product ?></span>
                            <?php
                                     
                                }else{
                                    echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Price'][$i]; 
                                }
                            ?>
                            
                            </td>
                            <td>
                              <!--<label for="modify"></label>
                              <select name="Modify[]" id="Modify[]">
                              <?php for($j=1;$j<=50;$j++) { ?>
                                <option value="<?php echo $j; ?>" <?php if (!(strcmp($j, $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i]))) {echo "selected=\"selected\"";} ?>><?php echo $j; ?></option>
                              <?php } ?>
                              </select>-->
<button class="min-button<?php echo $i; ?> small-button"><i class="fa fa-minus"></i></button><input name="Modify[]" class="spinner" id="Modify[]" value="<?php echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i] ?>" size="2" readonly><button class="add-button<?php echo $i; ?> small-button"><i class="fa fa-plus"></i></button>
<script type="text/javascript">
$('.add-button<?php echo $i; ?>').on('click', function(){
	
	var rtn;
	$.ajax({ //make ajax request to cart_process.php        
		url:"<?php echo $SiteBaseUrl ?>ajax/cart_add_check.php?" + "id=<?php echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'][$i]; ?>" + "&wshop=<?php echo $_GET['wshop']; ?>&qu=<?php echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i] ?>&time()",
        type: "GET",
		async:false, // 同步 
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
		b_value = $('.add-button<?php echo $i; ?>').prev().val();
		b_value++;
		$('.add-button<?php echo $i; ?>').prev().val(b_value);
		//alert(rt);
		//return false; //不送出form 
		document.form1.submit();
	}
});
$('.min-button<?php echo $i; ?>').on('click', function(){
    b_value = $('.min-button<?php echo $i; ?>').next().val();
	b_value--;
	if(b_value <= 0) {b_value = 1;}
	$('.min-button<?php echo $i; ?>').next().val(b_value);
	//alert($b_value);
	//return true; //不送出form 
	document.form1.submit()
});
</script>
                            </td>
                            <td><label for="notes1"></label>
                              <input name="Notes1[]" type="text" id="Notes1[]" value="<?php echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Notes1'][$i]; ?>" size="15" maxlength="200" /></td>
                            <td align="center"><a href="javascript:document.form1.submit()"><i class="fa fa-refresh" style="font-size:16px"></i></a></td>
                            <td align="center"><a href="<?php echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'showpage'),'',$UrlWriteEnable);?><?php echo $id_del_params; ?><?php echo $i; ?>&amp;pdid=<?php echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'][$i]; ?>"><i class="fa fa-trash" style="font-size:16px"></i></a></td>
                            <td>
                            <?php //小計與總價格
                            if($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['SpPrice'][$i] != '')
                            {
                                $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['itemTotal'][$i] = $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['SpPrice'][$i] * $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i];
                                'price=' . $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['SpPrice'][$i];
                                //echo 'qu=' . $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i];
                                echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['itemTotal'][$i]);
                                $_SESSION['Total'] += $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['itemTotal'][$i];
                            }else{
                                $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['itemTotal'][$i] = $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Price'][$i] * $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i];
                                'price=' . $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Price'][$i];
                                //echo 'qu=' . $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i];
                                echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['itemTotal'][$i]);
                                $_SESSION['Total'] += $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['itemTotal'][$i];
                            }
                            ?>
                            </td>
                          </tr>                 
                          <?php  //echo  $_SESSION['PlusId'][$i] ?>
                          <?php if(is_array($_SESSION['PlusId'][$val])) {  ?> 
                          <?php // ======== 加購商品列表 ======== ?>
                              <?php foreach($_SESSION['PlusId'][$val] as $k => $val2) { ?>
                              <tr bgcolor="#EFEFEF">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><?php echo $_SESSION['PlusName'][$val][$k]; ?>&nbsp;<span style="font-size:9px; background-color:#FF8000; color:#FFF; padding:2px;"><?php echo $Lang_Classify_Context_Cart_Purchase_Price ?></span></td>
                                <td><?php echo $_SESSION['PlusPrice'][$val][$k]; ?></td>
                                <td>
                                <?php 
                                // 限制加購商品輸入個數
                                    if($_SESSION['PlusQuantity'][$val][$k] > $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i]) {
                                         $_SESSION['PlusQuantity'][$val][$k] = $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i];
                                    }
                                ?>
                                <label for="modify1"></label>
                                  <select name="Modify1[]" id="Modify1[]">
                                  <?php for($j=1;$j<=50;$j++) { ?>
                                    <option value="<?php echo $j; ?>" <?php if (!(strcmp($j, $_SESSION['PlusQuantity'][$val][$k]))) {echo "selected=\"selected\"";} ?>><?php echo $j; ?></option>
                                  <?php } ?>
                                  </select>
                                </td>
                                <td>&nbsp;</td>
                                <td align="center"><a href="javascript:document.form1.submit()"><i class="fa fa-refresh" style="font-size:16px"></i></a></td>
                                <td align="center"><a href="cart.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=showpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;plusid_del=<?php echo $k; ?>&amp;pdid=<?php echo $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'][$i]; ?>"><i class="fa fa-trash" style="font-size:16px"></i></a></td>
                                <td><?php //小計與總價格
                                $_SESSION['PlusitemTotal'][$k] = $_SESSION['PlusPrice'][$val][$k] * $_SESSION['PlusQuantity'][$val][$k];
                                echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['PlusitemTotal'][$k]);
                                $_SESSION['PlusTotal'] += $_SESSION['PlusitemTotal'][$k];
                            ?></td>
                              </tr>
                              <?php } ?>
                          <?php // ======== 加購商品列表 END======== ?>
                          <?php } // if?>
                          <?php $NO++; ?>
                          <?php } ?>
                          <?php // ======== 商品列表 END======== ?>
                          </table>
                        </form>  
                       </div>
                    </div>
                </div> 
        </div>
                        <br />
        <div class="columns on-1">
                <div class="container board">
                    <div class="column">
                        <div class="container ct_board">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center">
                            <h3><strong><?php echo $Lang_Classify_Context_Cart_Totol_Price ?> <font color="#FF0000"><?php $_SESSION['Total'] = $_SESSION['Total'] + $_SESSION['PlusTotal']; echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['Total']); ?></font><br /></strong></h3>
                            <?php if ($row_RecordSystemConfigOtr['freepriceenable'] == '1' && ($row_RecordSystemConfigOtr['freeprice'] > $_SESSION['Total'])) { ?><h4><strong><?php echo $Lang_Classify_Context_Cart_Plus_Purchase ?><font color="#FF0000"> $<?php echo $row_RecordSystemConfigOtr['freeprice']-$_SESSION['Total']; ?></font> <?php echo $Lang_Classify_Context_Cart_Get_Free_Shipping ?></strong></h4><br /><?php } ?>
                                <?php echo $Lang_Classify_Context_Cart_Change_Buttom ?>
        
                            <strong>      </strong></td>
                          </tr>
                        </table>
                       </div>
                    </div>
                </div> 
        </div>
                        <br />
        <div class="columns on-1">
                <div class="container board">
                    <div class="column">
                        <div class="container ct_board">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center"><span class="InnerButtom"><a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $Lang_Classify_Context_Cart_Continue_Shopping ?></a></span><span class="InnerButtom"><a href="<?php echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'flow'),'',$UrlWriteEnable);?>" onclick="$('.steps').steps('prev');"><?php echo $Lang_Classify_Next ?></a></span><span class="InnerButtom"><a href="<?php echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'clearpage'),'',$UrlWriteEnable);?>"><?php echo $Lang_Classify_Context_Cart_Clear ?></a></span></td>
                          </tr>
                        </table>
                       </div>
                    </div>
                </div> 
        </div>
        <br />          
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
                                  <td width="189"><?php echo $Lang_Classify_Cart_Removed; ?></td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td align="center">
                              <?php echo $Lang_Classify_Context_Cart_Continue_Buy_Buttom ?><br />
                              <br /><span class="InnerButtom"><a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $Lang_Classify_Context_Cart_Continue_Shopping ?></a></span></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                </div>        
        </div>
        <?php 
        } 
        ?>
        <br />
        <div class="columns on-1">
                <div class="container board">
                    <div class="column">
                        <div style="background-color:#EE4128; color:#FFF; padding:10px;"><?php echo $Lang_Classify_Context_Mail_Send_Message ?></div>
                        <div class="container ct_board" style="background-color:#FFF7F0; border:1px #FBC4B0 solid; padding:10px;">
                        
                          <?php echo $CartDesc; ?>
                      </div>
                    </div>
                </div>        
        </div>
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