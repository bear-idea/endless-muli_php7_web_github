<style type="text/css">
.left_ct_board{
	padding: 5px;
}

.right_ct_board{
	padding: 5px;
}

/* 右方詳細內容區塊 */
div .product_inner_board_detailed{
	margin: 0px;
	padding: 2px;
	background-color: #FFFAF7;
	/*width: 200px; /* 圖片寬度 + padding*2 + border*/
	border: 1px solid #DDD;
	height: 100%;
}

/* 右方詳細內容區塊-標題 */
.product_inner_board_detailed_title {
	margin: 0px;
	padding: 5px;
	background-color: #FEEFD1;
	background-repeat: repeat;
	font-weight: bold;
}

/* 右方詳細內容區塊-詳細內容 */
.Product_Detailed_Right_Board {
	margin: 5px;
	border: 0px solid #DDD;
}
.Product_Detailed_Right_Board tr td {
	padding: 5px;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-bottom-style: dotted;
	border-top-color: #FFD5BF;
	border-right-color: #FFD5BF;
	border-bottom-color: #FFD5BF;
	border-left-color: #FFD5BF;
}

/*---------------------------------------*/
.div_table-cell{
	overflow:hidden;
	height: 320px; /* 設定區塊高度 */
	width: 320px;
	margin: 0px;
}

.div_table-cell{
	text-align: center;
	vertical-align: middle;
	background-color: #FFF;
	border: 1px solid #DDD;	/*display:table-cell; /* 將此Div區塊當成表格 FF有BUG*/
}


/* IE6 hack */
.div_table-cell span, .div_table-cell_type span{
	height:100%;
	display:inline-block;
	background-image: none;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	}

/* 讓table-cell下的所有元素都居中 */
.div_table-cell *, .div_table-cell_type *{ vertical-align:middle;}

div .photoFram_Block_glossy, .div_table-cell_plus{
	overflow:hidden;
	height: 45px; /* 設定區塊高度 */
	width: 45px;
	margin: 1px;
}

/* 圖片hide外框 */
.div_table-cell_plus{
	text-align: center;
	vertical-align: middle;
	/*background-color: #000;*/
	border: 1px solid #DDD;	/*display:table-cell; /* 將此Div區塊當成表格 FF有BUG*/
}


/* IE6 hack */
.div_table-cell_plus span{
	height:100%;
	display:inline-block;
	background-image: none;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	}

/* 讓table-cell下的所有元素都居中 */
.div_table-cell_plus *{ vertical-align:middle;}

/*-----------------------------------------------*/

.acc_trigger {
	/*width: 500px;*/
	/*float: left;*/
	/*background-color: #FEEFD1;*/
	background-image: url(images/la.png);
	background-repeat: no-repeat;
	background-position: right center;
	cursor: pointer;

}
.acc_trigger a {
}
.acc_trigger:hover {
	background-color: #FDD788;	/*color: #ccc;*/
}
.active {/*background-position: left bottom*/;
	background-image: url(images/lb.png);
	background-repeat: no-repeat;
	background-position: right center;
}
.acc_container {
	/*margin: 0 0 5px; padding: 0;
	overflow: hidden;
	font-size: 1.2em;
	/*width: 500px;*/
	/*clear: both;
	background: #f0f0f0;
	border: 1px solid #d6d6d6;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;*/
}
.acc_container .block {
	/*padding: 20px;*/
}
.acc_container .block p {
	/*padding: 5px 0;
	margin: 5px 0;*/
}
.acc_container h3 {
	/*margin: 0 0 10px;
	padding: 0 0 5px 0;
	border-bottom: 1px dashed #ccc;*/
}
.acc_container img {
	/*float: left;
	margin: 10px 15px 15px 0;
	padding: 5px;
	background: #ddd;
	border: 1px solid #ccc;*/
}
/* 數字 */
.number_g {
font-size: 1.67em;
margin-top: -3px;
height: 18px;
width: 32px;
}
.number_s {
font-size: 3em;
font-weight: bold;
}
</style>
<?php
/*********************************************************************
 # 主頁面產品資訊
 *********************************************************************/
?>
<?php
#
# ============== [title] ============== #
#
# 標題部分
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
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName['Product']; // 標題文字 ?></span></h1>
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
<?php
#
# ============== [/title] ============== #
?> 

<?php 
#
# ============== [if] ============== #
#
# 在此判斷式之內放置要顯示之內容
if ($totalRows_RecordProduct > 0) { // Show if recordset not empty 
?>
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
	<!-- 產品詳細頁面上方區塊 -->
    <div class="columns on-3">
        <div class="container board">
            <div class="column span-2 fixed sidebar" style="width:400px; margin-right:0px">
                <div class="container left_ct_board">
                    <!-- 左方圖片區塊 -->
                    <?php // 產品多圖
					if($MSProductShare == '0')
					{	
					?>
                    <div class="div_table-cell">
						<img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/product/<?php echo $row_RecordProduct['pic']; ?>" alt="<?php echo $row_RecordProduct['sdescription']; ?>" alumb="true" _w="320" _h="320"/></span></span>
                    </div>
                    <?php
					}else if ($MSProductShare == '1'){
						require("require_product_detailed_photoalbum.php");
					}
					?>
                    <?php //require("require_product_detailed_photoalbum_myfocus.php"); ?>
                    <span style="float:right; margin-top:10px;"><?php // 連結分享
					if($MSProductShare != '0')
					{	
						require("require_sharelink.php");
					} 
					?></span>
      <?php //require("require_fb_like.php"); ?>
                    <!-- 左方圖片區塊 END -->
              </div>
            </div>
            <div class="column elastic content">
            	<!--右方大區塊-->
                <div class="container right_ct_board">
                    <!-- 右方詳細內容區塊 -->
                    <div class="product_inner_board_detailed">
                    <!-- 右方詳細內容區塊標題 -->
                        <div class="product_inner_board_detailed_title acc_trigger">
                            <?php echo $row_RecordProduct['name']; ?>
                      	</div>
                    <!-- 右方詳細內容區塊標題 END -->
                    <div class="acc_container">
                    <table width="99%" border="0" cellspacing="0" cellpadding="0" class="Product_Detailed_Right_Board">
                      <?php if ($row_RecordProduct['pdseries'] !='') { ?>
                          <tr>
                            <td width="70" align="right" valign="top"><?php echo $Lang_Classify_Context_Pdseries_Product //貨號： ?></td>
                            <td><?php echo $row_RecordProduct['pdseries']; ?></td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordProduct['model'] !='') { ?>
                          <tr>
                            <td align="right" valign="top"><?php echo $Lang_Classify_Context_Model_Product //規格： ?></td>
                            <td align="left"><?php echo $row_RecordProduct['model']; ?></td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordProduct['price'] !='') { ?>
                          <tr>
                            <td align="right" valign="top"><?php echo $Lang_Classify_Context_Price_Product //價格： ?></td>
                            <td align="left"><?php echo $Lang_Classify_Context_Currency_units; ?><?php echo doFormatMoney($row_RecordProduct['price']); ?></td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordProduct['spprice'] !='') { ?>
                          <tr>
                            <td align="right" valign="top"><?php echo $Lang_Classify_Context_Spprice_Product //特價： ?></td>
                            <td><?php echo $Lang_Classify_Context_Currency_units; ?><?php echo doFormatMoney($row_RecordProduct['spprice']); ?></td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordProduct['sdescription'] !='') { ?>
                          <tr>
                            <td align="right" valign="top"><?php echo $Lang_Classify_Context_Sdescription_Product //描述： ?></td>
                            <td align="left"><?php echo $row_RecordProduct['sdescription']; ?></td>
                          </tr>
                          <?php } ?>
                      </table>
                      </div>
                  </div>
                  <!-- 右方詳細內容區塊 END -->
                  <?php if ($OptionCartSelect == '1') { // 購物功能 ?>
                  <div style="height:5px;"></div>
                  <!-- 右方購物車區塊 -->
                  <form id="form1" name="form1" method="post" action="cart.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=addpage&amp;tp=Cart&amp;lang=<?php echo $_SESSION['lang']; ?>">
                  <div class="product_inner_board_detailed">
                  	<table width="99%" border="0" cellspacing="0" cellpadding="0" class="Product_Detailed_Right_Board">
                          <tr>
                            <td width="70" align="right"><?php echo $Lang_Classify_Context_Num_Product //數量： ?></td>
                            <td>
                              <label for="quantity"></label>
                              <select name="quantity" id="quantity">
                              <?php for($j=1;$j<=50;$j++) { ?>
                        <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                      <?php } ?>

                            </select></td>
                      	  </tr>
                    </table> 
                    <table width="99%" border="0" cellspacing="0" cellpadding="0" class="Product_Detailed_Right_Board">
                          <tr>
                            <td colspan="2" align="center" valign="middle">
                            <input type="image" src="images/cartbuy.png" onclick="document.formname.submit()" style="vertical-align:bottom;" />
                            <a href="cart.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=showpage&amp;tp=Cart&amp;lang=<?php echo $_SESSION['lang']; ?>"><img src="images/cartsee.png" width="100" height="33" align="top" /></a></td>
                      	  </tr>
                         
                    </table>
                      <input name="id" type="hidden" id="id" value="<?php echo $row_RecordProduct['id']; ?>" />
                      <input name="pdseries" type="hidden" id="pdseries" value="<?php echo $row_RecordProduct['pdseries']; ?>" />
                      <input name="name" type="hidden" id="name" value="<?php echo $row_RecordProduct['name']; ?>" />
                      <input name="price" type="hidden" id="price" value="<?php echo $row_RecordProduct['price']; ?>" />
                      <input name="spprice" type="hidden" id="spprice" value="<?php echo $row_RecordProduct['spprice']; ?>" />
                      <input name="wshop" type="hidden" id="wshop" value="<?php echo $_GET['wshop']; ?>" />
                  </div>
                  <?php if ($MSProductPlus == '1') { // 加購專區 ?>
				  <?php if ($totalRows_RecordProductPlus > 0) { // Show if recordset not empty ?>
                  <div style="height:5px;"></div>
                  <div class="product_inner_board_detailed">
                    <!-- 右方詳細內容區塊標題 -->
                    <div class="product_inner_board_detailed_title acc_trigger"><?php echo $Lang_Classify_Context_PlusArea_Product //加購專區 ?></div>
                    <!-- 右方詳細內容區塊標題 END -->
                    <div class="acc_container">
                    <table width="99%" border="0" cellspacing="0" cellpadding="0" class="Product_Detailed_Right_Board">
                    <?php $i=0;?>
                          <?php do { ?>
                            <tr>
                              
                                <td width="20" align="center" valign="top"><input type="checkbox" name="pluscheck[]" id="pluscheck[]" /></td>
                                <td width="50">
                                <div class="div_table-cell_plus">
								  <?php if ($row_RecordProductPlus['pluspic'] != "") { ?>	 
                                  <a href="<?php echo $row_RecordProductPlus['pluslink']; ?>" target="_blank"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/productplus/thumb/small_<?php echo GetFileThumbExtend($row_RecordProductPlus['pluspic']); ?>" alt="<?php echo $row_RecordProductPlus['sdescription']; ?>" width="45" alumb="true" _w="45" _h="45"/></a><span></span>
                                  <?php } else { ?>      
                                  <a><img src="images/50x50_noimage.jpg" width="45" height="45"/></a><span></span>
                                  <?php } ?>
                                </div>
                                </td>
                                <td><label for="pluscheck[]"></label>
                                  <label for="plusquantity[]"></label>
                                  <?php echo $Lang_Classify_Context_Add_Product //加 ?>
                                  <font color="#FF0000">$<?php echo $row_RecordProductPlus['plusprice']; ?></font> <?php echo $Lang_Classify_Context_Buy_Product //買 ?> <?php echo $row_RecordProductPlus['plusname']; ?><br />
                              <select name="plusquantity[]" id="plusquantity[]">
                                <?php for($j=1;$j<=50;$j++) { ?>
                                <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                <?php } ?>
                              </select>
                              <input name="plusprice[]" type="hidden" id="plusprice[]" value="<?php echo $row_RecordProductPlus['plusprice']; ?>" />
                              <input name="plusname[]" type="hidden" id="plusname[]" value="<?php echo $row_RecordProductPlus['plusname']; ?>" />
                              <input name="plusid[]" type="hidden" id="plusid[]" value="<?php echo $row_RecordProductPlus['id']; ?>" /></td>
                                
                                
                          </tr>
                          <?php $i++; ?>
                            <?php } while ($row_RecordProductPlus = mysqli_fetch_assoc($RecordProductPlus)); ?>
							
                         
                    </table>
                    </div>
                  </div>
				  <?php } // Show if recordset not empty ?>
                  <?php } // 加購專區 END ?>
                  </form>
                  <!-- 右方購物車區塊 END -->
                  <?php } // 購物功能 END ?>
                  <?php if ($MSProductStar == '1') { // 星級評分 ?>
                  <div style="height:5px;"></div>
                  <!-- 右方評分區塊 -->
                  <div class="product_inner_board_detailed">
                    <table width="99%" border="0" cellspacing="0" cellpadding="0" class="Product_Detailed_Right_Board">
                          <tr>
                            <td width="70" align="center" valign="middle">
                            <?php $avgstar=0; // 初始化?>
							<?php do { ?>
							    <?php 
									$avgstartmp = $row_RecordProductRater['starnumber'] * $row_RecordProductRater['starvalue']; 
									$avgstar = $avgstartmp + $avgstar;
								?>
							<?php } while ($row_RecordProductRater = mysqli_fetch_assoc($RecordProductRater)); ?>
							<?php 
								if ($row_RecordProduct['ratercount']!=0) {
									$str = round($avgstar/$row_RecordProduct['ratercount'], 1);
									$res=explode(".",$str);
									//echo $res[0] . $res[1];
								}
							?>
                            <?php 
								if($res[0] == '') {$res[0]=$res[1]=0;}
								if($res[1] == '') {$res[1]=0;}
							?>
                            <span class="number_s"><?php echo $res[0]; ?></span>.<span class="number_g"><?php echo $res[1]; ?></span> 
                            </td>
                            <td>
                              <div id="product_rater"></div>
                                <div style="color:#666666; font-size:11px; text-align: left;">
                                	<?php if ($row_RecordProduct['ratercount']!=0) { ?>
                              <!--平均：<?php echo round($avgstar/$row_RecordProduct['ratercount'], 1); ?>顆星
                                    <br />-->
                                    <?php echo $Lang_Classify_Context_Ratercount_Product //評分人數： ?><?php echo $row_RecordProduct['ratercount']; ?>
                                    <?php } else { ?>
                                    <?php echo $Lang_Classify_Context_NoRatercount_Product //尚未評分 ?>
                                    <?php } ?>
                                    &nbsp;<?php echo $Lang_Classify_Context_Visit_Product //瀏覽次數： ?><?php echo $row_RecordProduct['visit']; ?>
                                </div>
                            </td>
                          </tr>
                    </table>
                  </div>
                  <!-- 右方評分區塊 END -->
                  <?php } // 星級評分 END ?>
              </div>
              	<!--右方大區塊 END-->
            </div>
        </div>
	</div>
    <!-- 產品詳細頁面上方區塊 END -->
  <div class="columns on-1">
        <div class="container board">
            <div class="column">
            
			  <script>
                $(function() {
                    $( "#tabs" ).tabs({
                        //event: "mouseover"
							error: function( xhr, status, index, anchor ) {
					$( anchor.hash ).html(
						"Couldn't load this tab. We'll try to fix this as soon as possible. " +
						"If this wouldn't be a demo." );
				}
			
                    });
                });
                </script>
                <!--Tab-->
                <div id="tabs">
                    <ul>
                        <li><a href="#tabs-1"><?php echo $Lang_Tab_Content_Product //商品說明 ?></a></li>
                        <?php if ($row_RecordProduct['content1'] != '' && $MSProductMutiContent == '1') { ?>
                        <li><a href="#tabs-2"><?php echo $Lang_Tab_Content1_Product //退換貨服務 ?></a></li>
                        <?php } ?> 
                        <?php if ($row_RecordProduct['content2'] != '' && $MSProductMutiContent == '1') { ?>
                        <li><a href="#tabs-3"><?php echo $Lang_Tab_Content2_Product //其他注意事項 ?></a></li>
                        <?php } ?>
                        <?php if ($MSProductQA == '1') { ?>
                        <li><a href="require_productpost.php?id=<?php echo $row_RecordProduct['id']; ?>"><?php echo $Lang_Tab_FAQ_Product //問答紀錄 ?></a></li>
                        <?php } ?>
                    </ul>
                    <div id="tabs-1">
                    	<div class="container left_ct_board"><?php echo pageBreak($row_RecordProduct['content']); ?></div> 
                    </div>
                    <?php if ($row_RecordProduct['content1'] != '' && $MSProductMutiContent == '1') { ?>
                    <div id="tabs-2">
                    	<div class="container left_ct_board"><?php echo $row_RecordProduct['content1']; ?></div> 
                    </div>
                    <?php } ?>
                    <?php if ($row_RecordProduct['content2'] != '' && $MSProductMutiContent == '1') { ?>
                    <div id="tabs-3">
                    	<div class="container left_ct_board"><?php echo $row_RecordProduct['content2']; ?></div> 
                    </div>
                    <?php } ?>  
                </div>  
                <!--Tab-->             
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
<?php 
} // Show if recordset not empty 
#
# ============== [/if] ============== #
?>
  
<?php 
#
# ============== [if] ============== #
#
# 判斷當無資料顯示時之畫面
if ($totalRows_RecordProduct == 0) { // Show if recordset empty 
?>
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
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><table width="250" border="0" cellspacing="0" cellpadding="0">
      <tr>
          <td width="61"><img src="<?php echo $SiteBaseUrl; ?>images/error_tip.png" width="60" height="60" /></td>
          <td width="189"><?php echo $Lang_Error_NoSearch //目前尚無資料 ?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Product']; // 標題文字 ?>  →  新增</strong> 來建立該項目<?php } ?></td>
  </tr>
</table>
<br />
<br />
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
<?php 
} // Show if recordset empty 
#
# ============== [/if] ============== #
?>

<hr>


<script language="javascript" type="text/javascript">
    $(document).ready(function () { /* Div 自動調整100%高度 */
        //$(".product_inner_board_detailed").css("height", $("td.AutoHightTr").height()+"px");
    });
</script>
<script type="text/javascript">
//$(function(){
	//var text = {1:'尚可',2:'普通',3:'滿意',4:'很滿意',5:'太棒了'};
	var options	= {
		image : 'images/star.png', 
		<?php if ($row_RecordProduct['ratercount']!=0) { ?>
		value   : <?php echo intval($avgstar/$row_RecordProduct['ratercount']) ?>, // 預設值
		<?php } ?>
		min : 1,
		max : 5, // 星星個數 
		step : 1, // 半個星星
		url	: 'ajax/product_rater.php?id=<?php echo $_GET['id']; ?>',
		method	:'GET',
		after_ajax	: function(ret) {
			alert(ret.ajax);
		},
		// 點選後不可更改
		after_click : function(ret) {  
			this.value  = ret.value;  
			this.enabled= false;  
			$('#product_rater').rater(this);  
    	}/*,
		title_format : function(val) {
			var title = text[val];
			return title;
		}*/
	}
	$('#product_rater').rater(options);
//});
</script>
<script type="text/javascript">
/* 圖片(不)完全按比例自動縮圖 */
jQuery(document).ready(function(){$(window).load(function(){$(".div_table-cell img").each(function(){if("true"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");var c=$(this).width(),d=$(this).height(),a=$(this).attr("_w")/c,b=$(this).attr("_h")/d,e=1,e=a>b?b:a;$(this).width(c*e);$(this).height(d*e)}else if("false"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");$(this).width();$(this).height();c=$(this).attr("_w");d=$(this).attr("_h");
a=$(this).width();b=$(this).height();if(a>c){var e=a,f=b,b=b*(c/a),a=c;b<d&&(a=e*(d/f),b=d)}$(this).attr({width:a,height:b})}})})});
</script>
<script type="text/javascript"> 
$(document).ready(function(){
    $(".acc_container:not('.acc_container:first')").hide();
    $('.acc_trigger').click(function(){
	if( $(this).next().is(':hidden') ) {
            $('.acc_trigger').removeClass('active').next().slideUp();
            $(this).toggleClass('active').next().slideDown();
	}else{
            $(this).toggleClass('active');
            $(this).next().slideUp();
        }
	return false;
    });
	
});
</script> 
<script type="text/javascript">
$(document).ready(function() {
 
	//ACCORDION BUTTON ACTION	
	$('div.accordionButton').click(function() {
		$('div.accordionContent').slideUp('normal');	
		$(this).next().slideDown('normal');
	});
 
	//HIDE THE DIVS ON PAGE LOAD	
	$("div.accordionContent").hide();
 
});
</script>