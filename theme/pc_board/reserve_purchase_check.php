<style type="text/css">
.Room_Cart_Purchase tr td{margin:5px;padding:5px;border:1px solid #ddd}
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
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right">線上訂房 - 確認訂單</span></h1>
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
		<?php if(isset($_SESSION['Room_Cart_' . $_GET['wshop']] ) && count($_SESSION['Room_Cart_' . $_GET['wshop']])>0){ ?>
        
        <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
        訂單編號：<font color="#0033FF"><?php echo $_SESSION['Room_Cart_OrderID']; ?></font><input name="D_OrderID" type="hidden" id="D_OrderID" value="<?php echo $_SESSION['Room_Cart_OrderID']; ?>" /> <br />
        <br />
          <table width="100%" border="0" cellspacing="0" cellpadding="0"class="TB_General_style01">
          <tr>
            <td width="50"><strong>編號</strong></td>
            <td width="100"><strong>住宿日期</strong></td>
            <td><strong>房型</strong></td>
            <td width="70"><strong>價格</strong></td>
            <td width="70"><strong>房間數</strong></td>
            <td width="70"><strong>小計</strong></td>
            </tr>
          <?php foreach($_SESSION['Room_Cart_' . $_GET['wshop']] as $i => $val) { ?>
          <tr>
            <td><?php echo $i+1; ?></td>
            <td><?php echo $_SESSION['Room_Date'][$i];  ?>
              <input name="dcroomdate[]" type="hidden" id="dcroomdate[]" value="<?php echo $_SESSION['Room_Date'][$i]; ?>" /></td>
            <td><?php echo $_SESSION['Room_Name'][$i]; ?>
        <input name="dcproductname[]" type="hidden" id="dcproductname[]" value="<?php echo $_SESSION['Room_Name'][$i]; ?>" /></td>
            <td><?php
                           echo $_SESSION['Room_RoomPrice'][$i];
                            
                            ?>
              <input name="dcprice[]" type="hidden" id="dcprice[]" value="<?php echo $_SESSION['Room_RoomPrice'][$i]; ?>" /></td>
            <td><?php echo $_SESSION['Room_Quantity'][$i] ?>
              <input name="dcquantiry[]" type="hidden" id="dcquantiry[]" value="<?php echo $_SESSION['Room_Quantity'][$i]; ?>" /></td>
            <td><?php echo '$' . doFormatMoney($_SESSION['itemTotal'][$i]); ?>
              <input name="dcitemtotal[]" type="hidden" id="dcitemtotal[]" value="<?php echo $_SESSION['itemTotal'][$i]; ?>" />
              <input name="roomid[]" type="hidden" id="roomid[]" value="<?php echo $_SESSION['Room_ID'][$i]; ?>" /></td>
            </tr>
          <?php if(is_array($_SESSION['PlusId'][$val])) {  ?> 
                          <?php // ======== 加購商品列表 ======== ?>
                            
                              <?php foreach($_SESSION['PlusId'][$val] as $k => $val2) { ?>
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><?php echo $_SESSION['PlusName'][$val][$k]; ?>&nbsp;<span style="font-size:9px; background-color:#FF8000; color:#FFF; padding:2px;">加購</span>
                                <input name="dcproductplusname[]" type="hidden" id="dcproductplusname[]" value="<?php echo $_SESSION['PlusName'][$val][$k]; ?>" /></td>
                                <td><?php echo $_SESSION['PlusPrice'][$val][$k]; ?>
                                <input name="dcproductplusprice[]" type="hidden" id="dcproductplusprice[]" value="<?php echo $_SESSION['PlusPrice'][$val][$k]; ?>" /></td>
                                <td><?php echo $_SESSION['PlusQuantity'][$val][$k]; ?>
                                <input name="dcproductplusquantity[]" type="hidden" id="dcproductplusquantity[]" value="<?php echo $_SESSION['PlusQuantity'][$val][$k]; ?>" /></td>
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
        <br />
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Room_Cart_Purchase">
             <tr>
              <td colspan="2" align="left" bgcolor="#DDD"><strong>訂房者資訊</strong></td>
              </tr>
            <tr>
              <td width="150" align="right">訂房者姓名：</td>
              <td><?php echo $_POST['ocname']; ?>
                <input name="ocname" type="hidden" id="ocname" value="<?php echo $_POST['ocname']; ?>" />
                <?php $_SESSION['ocname'] = $_POST['ocname']; ?></td>
            </tr>
            <tr>
              <td align="right">身分證字號/護照號碼：</td>
              <td><?php echo $_POST['ocsn']; ?>
                <input name="ocsn" type="hidden" id="ocsn" value="<?php echo $_POST['ocsn']; ?>" />
                <?php $_SESSION['ocsn'] = $_POST['ocsn']; ?></td>
            </tr>
            <tr>
              <td align="right">居住地：</td>
              <td><?php echo $_POST['occountry']; ?>
                <input name="occountry" type="hidden" id="occountry" value="<?php echo $_POST['occountry']; ?>" /></td>
            </tr>
            <tr>
              <td align="right">電話：</td>
              <td><?php echo $_POST['octel']; ?>
              <input name="octel" type="hidden" id="octel" value="<?php echo $_POST['octel']; ?>" />
              <?php $_SESSION['octel'] = $_POST['octel']; ?></td>
            </tr>
            <tr>
              <td align="right">行動電話：</td>
              <td><?php echo $_POST['ocphone']; ?>
              <input name="ocphone" type="hidden" id="ocphone" value="<?php echo $_POST['ocphone']; ?>" />
              <?php $_SESSION['ocphone'] = $_POST['ocphone']; ?></td>
            </tr>
            <tr>
              <td align="right">信箱：</td>
              <td><?php echo $_POST['ocmail']; ?>
              <input name="ocmail" type="hidden" id="ocmail" value="<?php echo $_POST['ocmail']; ?>" />
              <?php $_SESSION['ocmail'] = $_POST['ocmail']; ?></td>
            </tr>
            <tr>
              <td colspan="2" align="left" bgcolor="#DDD"><strong>住房者資訊</strong></td>
              </tr>
              
              <tr>
                <td width="150" align="right">住房者姓名：</td>
              <td><?php echo $_POST['ocinname']; ?>
                <input name="ocinname" type="hidden" id="ocinname" value="<?php echo $_POST['ocinname']; ?>" />
                <?php $_SESSION['ocinname'] = $_POST['ocinname']; ?></td>
            </tr>
            <tr>
              <td align="right">身分證字號/護照號碼：</td>
              <td><?php echo $_POST['ocinsn']; ?>
                <input name="ocinsn" type="hidden" id="ocinsn" value="<?php echo $_POST['ocinsn']; ?>" />
                <?php $_SESSION['ocinsn'] = $_POST['ocinsn']; ?></td>
            </tr>
            <tr>
              <td colspan="2" align="left" bgcolor="#DDD"><strong>住房需求</strong></td>
              </tr>
            <tr>
              <td align="right" valign="top">補充訊息：</td>
              <td><?php echo $_POST['ocnotes1']; ?>
                <input name="ocnotes1" type="hidden" id="ocnotes1" value="<?php echo $_POST['ocnotes1']; ?>" />
                <?php $_SESSION['ocnotes1'] = $_POST['ocnotes1']; ?></td>
            </tr>
            <tr>
              <td colspan="2" align="left" bgcolor="#DDD"><strong>付款方式</strong></td>
              </tr>
              <tr>
              <td align="right">付款方式：</td>
              <td>
              <?php 
			   switch($_POST['payment'])
			   {
				   case 0:
				    echo "ATM/銀行匯款";
					break;
			   }
			  ?>
              <input name="ocpayment" type="hidden" id="ocpayment" value="<?php echo $_POST['payment']; ?>" /></td>
            </tr>
            <tr>
              <td align="right">備註說明：</td>
              <td><?php echo $RoomDesc; ?></td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td align="right" valign="top">金額：</td>
              <td>
              目前商品總金額：<font color="#FF0000"><?php echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['Total']); ?></font>
              <br />
              
              <?php $OCTotal = $_SESSION['Total'];?>
              總金額：<font color="#FF0000"><?php echo $Lang_Classify_Context_Currency_units . doFormatMoney($OCTotal); ?>
              <input name="ocpdprice" type="hidden" id="ocpdprice" value="<?php echo $_SESSION['Total']; ?>" />
              <!--<input name="ocfreight" type="hidden" id="ocfreight" value="<?php echo $_POST['ocfreight']; ?>" />-->
              <input name="octotal" type="hidden" id="octotal" value="<?php echo $OCTotal; ?>" />
              </font></td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td><input type="button" name="button3" id="button3" value="上一步，填寫房客資料" onclick="history.back(-1)"/>
                <input type="submit" name="button2" id="button2" value="送出訂單資訊"  onclick="javascript:{this.disabled=true;document.form1.submit();}"/>
                <input name="postdate" type="hidden" id="postdate" value="<?php echo date("Y-m-d H-i-s");?>" />
              <input name="userid" type="hidden" id="userid" value="<?php echo $_SESSION['userid'];?>" />
              <input name="wshop" type="hidden" id="wshop" value="<?php echo $_GET['wshop'];?>" /></td>
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
                                  <td width="189">您購物車中的商品已全部移除或尚未選購商品!!</td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td align="center">
                              若您想繼續選購，請按下方「繼續購物」鈕<br />
                              <br /><span class="InnerButtom"><a href="room.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Room&amp;lang=<?php echo $_SESSION['lang']; ?>">繼續購物</a></span></td>
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