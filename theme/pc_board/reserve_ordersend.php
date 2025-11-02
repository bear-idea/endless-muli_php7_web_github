<link rel="stylesheet" href="admin/css/colorbox/colorbox.css" />
<script type="text/javascript" language="javascript" src="admin/js/colorbox/jquery.colorbox-min.js"></script>
<script>
		$(document).ready(function(){
			$(".colorbox_iframe").colorbox({iframe:true, width:"90%", height:"90%", fixed:true});
			$(".colorbox_iframe_small").colorbox({iframe:true, width:"1000px", height:"80%", fixed:true});
			$(".colorbox_iframe_cd").colorbox({iframe:true, width:"99%", height:"99%", fixed:true});
		});
</script>
<style type="text/css">
/* 按鈕樣式 */
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
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right">查看訂單</span></h1>
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
      <?php if($_GET['ID'] != "" && $_GET['PR'] != ""){ ?>
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td height="60" valign="center" align="center"><br />
            
恭喜，訂單送出成功！<br />
              <br />
              您的訂單號碼是：<strong><?php echo $_GET['ID']; ?></strong>       <br />
              本次交易金額為：<strong><?php echo $_GET['PR']; ?></strong>元       <br /><br />

              系統已寄送訂購通知至您的信箱中，您可確認查收。
           </td>
          </tr>
        </table>
        <br />
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center">若您想繼續選購，請按下方「繼續購物」鈕<br />若您想查看您的訂單，請按下方「查看訂單」鈕<br />
                              <br /><span class="InnerButtom"><a href="room_orders_see.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;Serial=<?php echo $_GET['ID']; ?>" class="colorbox_iframe" title="查看訂單">查看訂單</a></span>
<span class="InnerButtom"><a href="room.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Room&amp;lang=<?php echo $_SESSION['lang']; ?>">繼續購物</a></span><br /><br />
</td>
          </tr>
        </table>
        <?php } else if($_GET['ST'] == "Error"){ ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><table width="250" border="0" cellspacing="0" cellpadding="0">
              <tr>
                  <td width="61"><img src="<?php echo $SiteBaseUrl; ?>images/error_tip.png" width="60" height="60" /></td>
                  <td width="189">很抱歉!!<br>
                    您所選購的房型已經被訂走!!</td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center">
              
      若您想繼續選購，請按下方「繼續購物」鈕<br /><br />
              <br /><span class="InnerButtom"><a href="room.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Room&amp;lang=<?php echo $_SESSION['lang']; ?>">繼續購物</a></span></td>
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
                  <td width="189">您所選擇的商品已存在您的購物清單中!!</td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center">
             
      若您想繼續選購，請按下方「繼續購物」鈕<br /><br />
              <br /><span class="InnerButtom"><a href="room.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Room&amp;lang=<?php echo $_SESSION['lang']; ?>">繼續購物</a></span></td>
          </tr>
        </table>
        <br />
        <br />
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
<script type="text/javascript" charset="utf-8">
/* prettyPhoto */
$(document).ready(function(){$("a[rel^='prettyPhoto']").prettyPhoto({slideshow:5E3,autoplay_slideshow:!0,keyboard_shortcuts:!0,show_title:!1})});
</script>
