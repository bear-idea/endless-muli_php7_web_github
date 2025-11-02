<script src="<?php echo $SiteBaseUrl; ?>SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="<?php echo $SiteBaseUrl; ?>SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="<?php echo $SiteBaseUrl; ?>SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="<?php echo $SiteBaseUrl; ?>SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl; ?>SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl; ?>SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.Cart_Purchase tr td{margin:5px;padding:5px;border:1px solid #DDD}
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
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right">線上訂房 - 填寫房客資料</span></h1>
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
      <?php if(isset($_SESSION['Room_Cart_' . $_GET['wshop']] )){ ?>
        <form id="form1" name="form1" method="post" action="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'purchasecheckpage'),'',$UrlWriteEnable);?>">
訂單編號：<font color="#0033FF"><?php echo $_SESSION['Room_Cart_OrderID']; ?></font> <br />
<br />

  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Cart_Purchase">
    <tr>
      <td colspan="2" bgcolor="#DDD" style="font-size:18px"><strong><i class="fa fa-pencil-square-o"></i> 訂房者資訊</strong></td>
      </tr>
    <tr>
      <td width="150" align="right"><span class="Form_Required_Item">*</span>訂房者姓名：</td>
      <td><span id="CartName">
        <label for="ocname"></label>
        <input name="ocname" type="text" id="ocname" value="<?php echo $_SESSION['ocname']; ?>" maxlength="20" />
        <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
      </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>身分證字號/護照號碼：</td>
      <td><span id="CartSN">
          <label for="ocsn"></label>
          <input name="ocsn" type="text" id="ocsn" value="<?php echo $_SESSION['ocsn']; ?>" maxlength="20" />
          <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>居住地：</td>
      <td><span id="CartCountry">
        <select name="occountry" id="occountry" class="validate[required]">
          <option value="" selected>-- 選擇居住地區 --</option>
          <option value="台北市">台北市</option>
          <option value="新北市">新北市</option>
          <option value="基隆市">基隆市</option>
          <option value="宜蘭縣">宜蘭縣</option>
          <option value="桃園縣">桃園縣</option>
          <option value="新竹市">新竹市</option>
          <option value="新竹縣">新竹縣</option>
          <option value="苗栗縣">苗栗縣</option>
          <option value="台中市">台中市</option>
          <option value="彰化縣">彰化縣</option>
          <option value="南投縣">南投縣</option>
          <option value="嘉義市">嘉義市</option>
          <option value="嘉義縣">嘉義縣</option>
          <option value="雲林縣">雲林縣</option>
          <option value="台南市">台南市</option>
          <option value="高雄市">高雄市</option>
          <option value="屏東縣">屏東縣</option>
          <option value="花蓮縣">花蓮縣</option>
          <option value="台東縣">台東縣</option>
          <option value="澎湖縣">澎湖縣</option>
          <option value="金門縣">金門縣</option>
          <option value="連江縣">連江縣</option>
          <option value="其他地區">其他地區</option>
        </select>
        <span class="selectRequiredMsg">請選取項目。</span></span></td>
    </tr>
    <tr>
      <td align="right">電話：</td>
      <td><span id="Carttel">
        <label for="octel"></label>
        <input name="octel" type="text" id="octel" value="<?php echo $_SESSION['octel']; ?>" maxlength="30" />
      <span class="textfieldRequiredMsg">欄位不可為空。</span></span><span class="Form_Caption_Word">建議填寫，以便聯絡。</span></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>行動電話：</td>
      <td><span id="CartPhone">
      <label for="ocphone"></label>
      <input name="ocphone" type="text" id="ocphone" value="<?php echo $_SESSION['ocphone']; ?>" maxlength="20" />
      <span class="textfieldInvalidFormatMsg">格式無效。</span><span class="textfieldRequiredMsg">需要有一個值。</span></span><span class="Form_Caption_Word">建議填寫，以便聯絡。</span></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>信箱：</td>
      <td><span id="CartMail">
      <label for="ocmail"></label>
      <input name="ocmail" type="text" id="ocmail" value="<?php echo $_SESSION['ocmail']; ?>" size="35" maxlength="150" />
      <span class="textfieldRequiredMsg">欄位不可為空。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span><span class="Form_Caption_Word">通知訊息用，務必填寫常用Email，以免發生訊息漏接情形。</span></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#DDD" style="font-size:18px"><strong><i class="fa fa-pencil-square-o"></i> 住房者資訊</strong></td>
      </tr>
      <tr>
        <td width="150" align="right"><span class="Form_Required_Item">*</span>訂房者姓名：</td>
      <td><span id="CartInName">
        <label for="ocinname"></label>
        <input name="ocinname" type="text" id="ocinname" value="<?php echo $_SESSION['ocinname']; ?>" maxlength="20" />
        <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>身分證字號/護照號碼：</td>
      <td><span id="CartInSN">
        <label for="ocinsn"></label>
        <input name="ocinsn" type="text" id="ocinsn" value="<?php echo $_SESSION['ocinsn']; ?>" />
        <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#DDD" style="font-size:18px"><strong><i class="fa fa-pencil-square-o"></i> 住房需求</strong></td>
      </tr>
    <tr>
      <td align="right" valign="top">補充訊息：</td>
      <td><span id="CartNotes1">
        <label for="ocnotes1"></label>
        <textarea name="ocnotes1" id="ocnotes1" cols="45" rows="5"><?php echo $_SESSION['ocnotes1']; ?></textarea>
        <span class="textareaMaxCharsMsg">已超出字元數目的最大值。</span></span></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#DDD" style="font-size:18px"><strong><i class="fa fa-pencil-square-o"></i> 選擇付款方式</strong></td>
      </tr>
      <tr>
      <td align="right">付款方式：</td>
      <td><p>
        <label>
          <input name="payment" type="radio" id="payment_0" value="0" checked="checked" />
          ATM/銀行匯款</label>
        <br />
      </p></td>
    </tr>
    <?php if ($RoomDesc != '') { ?>
            <tr>
              <td align="right">備註說明：</td>
              <td><?php echo $RoomDesc; ?></td>
              </tr>
            <?php } ?>
    <tr>
      <td align="right">&nbsp;</td>
      <td><input type="button" name="button3" id="button3" value="上一步，檢視訂房資訊" onclick="history.back(-1)"/>
        <input type="submit" name="button2" id="button2" value="下一步，確認訂單" />
        <input type="reset" name="button" id="button" value="清空" />
<input type="hidden" name="hiddenField" id="hiddenField" /></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
        <script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("CartName", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("Carttel", "none", {validateOn:["blur"], isRequired:false});
var sprytextfield3 = new Spry.Widget.ValidationTextField("CartPhone", "phone_number", {validateOn:["blur"], format:"phone_custom", pattern:"0000000000"});
var sprytextfield4 = new Spry.Widget.ValidationTextField("CartMail", "email", {validateOn:["blur"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("CartNotes1", {validateOn:["blur"], isRequired:false, maxChars:200});
var sprytextfield5 = new Spry.Widget.ValidationTextField("CartSN", "none", {validateOn:["blur"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("CartInName", "none", {validateOn:["blur"]});
var sprytextfield7 = new Spry.Widget.ValidationTextField("CartInSN", "none", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("CartCountry", {validateOn:["blur"]});
</script>
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
                              <br /><span class="InnerButtom"><a href="product.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Product&amp;lang=<?php echo $_SESSION['lang']; ?>">繼續購物</a></span></td>
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
