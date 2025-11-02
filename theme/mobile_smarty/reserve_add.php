<style type="text/css">
/* 按鈕樣式 */
.InnerButtom{
	margin-right: 2px;
	margin-top: 5px;
	margin-bottom: 5px;
}
.InnerButtom a{
   font-weight: bold;
   border: 1px solid #CCC;
   -webkit-border-radius: 3px;
   -moz-border-radius: 3px;
   border-radius: 3px;
   text-shadow: 0 1px 1px white;
   -webkit-box-shadow: 0 1px 1px #fff;
   -moz-box-shadow:    0 1px 1px #fff;
   box-shadow:         0 1px 1px #fff;
   font: bold 11px Sans-Serif;
   padding: 4px 8px;
   white-space: nowrap;
   vertical-align: middle;
   color: #666;
   background: transparent;
   cursor: pointer;
}
.InnerButtom a:hover, .InnerButtom a:focus {
	font-weight: bold;
	border-color: #999;
	background: -webkit-linear-gradient(top, white, #E0E0E0);
	background: -moz-linear-gradient(top, white, #E0E0E0);
	background: -ms-linear-gradient(top, white, #E0E0E0);
	background: -o-linear-gradient(top, white, #E0E0E0);
	-webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.25), inset 0 0 3px #fff;
	-moz-box-shadow: 0 1px 2px rgba(0,0,0,0.25), inset 0 0 3px #fff;
	box-shadow: 0 1px 2px rgba(0,0,0,0.25), inset 0 0 3px #fff;
	color: #333;
	text-decoration: none;
}
.InnerButtom a:active {
   font-weight: bold;
   color: #666;
   border: 1px solid #AAA;
   border-bottom-color: #CCC;
   border-top-color: #999;
   -webkit-box-shadow: inset 0 1px 2px #aaa;
   -moz-box-shadow:    inset 0 1px 2px #aaa;
   box-shadow:         inset 0 1px 2px #aaa;
   background: -webkit-linear-gradient(top, #E6E6E6, gainsboro);
   background:    -moz-linear-gradient(top, #E6E6E6, gainsboro);
   background:     -ms-linear-gradient(top, #E6E6E6, gainsboro);
   background:      -o-linear-gradient(top, #E6E6E6, gainsboro);
}
</style>
<?php
/*********************************************************************
 # 主頁面產品資訊
 *********************************************************************/
?>


               
<div class="post-content">
<h4 class="classic-title"><span><?php echo $Lang_Title_Cart_Show; ?></span></h4>	

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
              若您想檢視您的購物清單，請按下方「檢視購物車」鈕 <br />
      若您想繼續選購，請按下方「繼續購物」鈕<br /><br />
              <br /><span class="InnerButtom"><a href="room.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Room&amp;lang=<?php echo $_SESSION['lang']; ?>">繼續購物</a></span><span class="InnerButtom"><a href="room.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=showpage&amp;lang=<?php echo $_SESSION['lang']; ?>">檢視購物車</a></span></td>
          </tr>
        </table>
        <br />
        <br />
</div>