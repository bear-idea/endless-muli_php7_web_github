<link rel="stylesheet" href="css/QapTcha.jquery.css" type="text/css" />
<script type="text/javascript" src="js/jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.touch.js"></script>
<script type="text/javascript" src="js/QapTcha.jquery.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
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
          <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo "訂單查詢"; // 標題文字 ?></span></h1>
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
                <div style="width:100%; text-align:left">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=paysearch&amp;lang=<?php echo $_SESSION['lang']; ?>" method="post" name="LostPass" id="LostPass" onsubmit="YY_checkform('LostPass','mail','#S','2','請輸入email');return document.MM_returnValue">
         <br />

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">

  <tr>
    <td width="80" align="right" valign="top"><span class="Form_Required_Item">*</span>姓名：</td>
    <td><span id="sprytextfield1">
            <label>
              <input type="text" name="name" id="name" />
            </label>
            <span class="textfieldRequiredMsg">需要有一個值。</span></span><br />
</td>
  </tr> 
  <tr>
    <td align="right"><span class="Form_Required_Item">*</span>行動：</td>
    <td><span id="sprytextfield2">
      <label for="phone"></label>
      <input type="text" name="phone" id="phone">
      <span class="textfieldRequiredMsg">需要有一個值。</span></span></td>
  </tr>
  <tr>
    <td align="right"><span class="Form_Required_Item">*</span>驗證：</td>
    <td><div class="QapTcha"></div></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><label>
      <input type="submit" name="button" id="button" value="送出" />
      </label></td>
  </tr>
 
  
</table>
        </form>
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
<script type="text/javascript">
  $(document).ready(function(){
	$('.QapTcha').QapTcha({
		txtLock : '移動按鈕拖曳至右方以解鎖按鈕',
		txtUnlock : '按鈕解鎖',
		disabledSubmit : true,
		autoRevert : true,
		PHPfile : 'Qaptcha.jquery.php'
	});
  });
</script> 
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
</script>
