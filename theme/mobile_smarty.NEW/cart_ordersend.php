<link rel="stylesheet" href="<?php echo $SiteBaseUrl ?>admin/css/colorbox/colorbox.css" />
<script type="text/javascript" language="javascript" src="<?php echo $SiteBaseUrl ?>admin/js/colorbox/jquery.colorbox-min.js"></script>
<script>
		$(document).ready(function(){
			$(".colorbox_iframe").colorbox({iframe:true, width:"90%", height:"90%", fixed:true});
			$(".colorbox_iframe_small").colorbox({iframe:true, width:"1000px", height:"80%", fixed:true});
			$(".colorbox_iframe_cd").colorbox({iframe:true, width:"99%", height:"99%", fixed:true});
		});
</script>
<style type="text/css">
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

                <div class="ct_title">
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $Lang_Title_Cart_Send; ?></span></h1>
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
<div class="post_content padding-3">
      <?php if($_GET['ID'] != "" && $_GET['PR'] != ""){ ?>
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td height="60" valign="center" align="center"><br />
            
<?php echo $Lang_Classify_Context_Cart_Order_Send_Success; //恭喜，訂單送出成功！ ?><br />
              <br />
              <?php echo $Lang_Classify_Context_Cart_Order_Send_No; //您的訂單號碼是 ?>：<strong><?php echo $_GET['ID']; ?></strong>       <br />
              <?php echo $Lang_Classify_Context_Cart_Order_Send_Money; //本次交易金額為 ?>：<strong><?php echo $_GET['PR']; ?></strong>元</td>
          </tr>
        </table>
        <br />
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><?php echo $Lang_Classify_Context_Cart_Continue_Buy_Buttom; //若您想繼續選購，請按下方「繼續購物」鈕<br />若您想查看您的訂單，請按下方「查看訂單」鈕 ?><br />
                              <br /><span class="InnerButtom"><a href="<?php echo $SiteBaseUrl; ?>cart_orders_see.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;Serial=<?php echo $_GET['ID']; ?>" class="colorbox_iframe" title="<?php echo $Lang_Classify_Context_Cart_Order_See; //查看訂單 ?>"><?php echo $Lang_Classify_Context_Cart_Order_See; //查看訂單 ?></a></span>
<span class="InnerButtom"><a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $Lang_Classify_Context_Cart_Continue_Shopping ?></a></span><br /><br />
</td>
          </tr>
        </table>
        <?php } else { ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><table width="250" border="0" cellspacing="0" cellpadding="0">
              <tr>
                  <td width="61"><img src="<?php echo $SiteBaseUrl; ?>images/error_tip.png" width="60" height="60" /></td>
                  <td width="189"><?php echo $Lang_Classify_Exist_In_Shopping_List; //您所選擇的商品已存在您的購物清單中!! ?></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center">
              <?php echo $Lang_Classify_Context_Cart_Continue_View_Buttom ?><br />
      <?php echo $Lang_Classify_Context_Cart_Continue_Buy_Buttom ?><br /><br />
              <br /><span class="InnerButtom"><a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $Lang_Classify_Context_Cart_Continue_Shopping ?></a></span><span class="InnerButtom"><a href="<?php echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'showpage'),'',$UrlWriteEnable);?>"><?php echo $Lang_Title_Cart_Show ?></a></span></td>
          </tr>
        </table>
        <br />
        <br />
        <?php 
        } 
        ?>

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
<script type="text/javascript" charset="utf-8">
/* prettyPhoto */
$(document).ready(function(){$("a[rel^='prettyPhoto']").prettyPhoto({slideshow:5E3,autoplay_slideshow:!0,keyboard_shortcuts:!0,show_title:!1})});
</script>
