<style type="text/css">
.ct_board_product_title{padding:5px;color:#FFF;background-color:#333;margin:5px 0 0}
.swpboard{text-align:right;padding:5px}
.product_outer_board tr td{margin:0;padding:0}
div .product_inner_board{margin:1px}
div .photoFram_Block_glossy,.div_table-cell_product{overflow:hidden;height:134px;width:130px}
.product_inner_board_relative{position:relative}
.product_inner_board_relative_buttom{position:relative}
.div_table-cell_product{background-color:#FFF;text-align:center;vertical-align:middle;border:1px solid #DDD}
.div_table-cell_product span{height:100%;display:inline-block;background-image:none;border-style:none}
.div_table-cell_product *{vertical-align:middle}
div .product_inner_board_context{margin-top:5px;text-align:left;min-height:40px;overflow:hidden}
div .product_inner_board_context a:hover{font-weight:bolder;text-decoration:none}
a:hover.switch_4block,a:hover.switch_3block,a:hover.switch_2block,a:hover.switch_list{filter:alpha(opacity=75);opacity:.5;-ms-filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=75)}
.product_inner_board_relative .nailthumb-container{
	border:1px solid #EEE;
	<?php if ($TmpProductImageBoard == '0') { ?>
	height: <?php echo floor(($TmpWebWidth-$TmpWebColumnUseWidth-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16; ?>px; /* 設定區塊高度 */
	<?php } else if ($TmpProductImageBoard == '1') { ?>
	height: <?php echo floor(floor(($TmpWebWidth-$TmpWebColumnUseWidth-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16)*0.75; ?>px; /* 設定區塊高度(矩形) */
	<?php } ?>
	width: <?php echo floor(($TmpWebWidth-$TmpWebColumnUseWidth-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16; ?>px;
	margin:auto;
}
</style>
<?php
/*********************************************************************
 # 主頁面產品資訊
 *********************************************************************/
?>
<div class="columns on-1">
        <div class="container">
            <div class="column">
                <div class="container ct_board ct_title">
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php if($row_RecordTmpConfig['tmphomeproductshowtype'] == "1") {echo $row_RecordProductMultiTypeMenu_l1['itemname']; } else {echo $ModuleName['Product']; } ?></span></h1>
                </div>
            </div>
        </div>        
</div>
<?php 
#
# ============== [if] ============== #
#
# 在此判斷式之內放置要顯示之內容
if ($totalRows_RecordProduct > 0) { // Show if recordset not empty 
?> 
<?php // 顯示方式 ?>
 <div class="columns on-4">
      <div class="container board Scroll_Bar_horizontal">
	  <?php $i=$startRow_RecordProduct + 1; // 取得頁面第一項商品之編號 ?>
          <?php do { ?> 
          <div class="column">
              <div class="container product_inner_board">
                <!-- 內容 -->
                <div class="photoFrame_<?php echo $TmpProductBoard; ?>">
                <div class="product_inner_board_relative">
                <div class='<?php echo $TmpProductBoardIcon; ?>'></div>
                  <div class="nailthumb-container">
                  <?php // 判斷商品所在之層級
                                if($row_RecordProduct['type1'] != '-1' && $row_RecordProduct['type2'] != '-1' && $row_RecordProduct['type3'] != '-1') { $level='2'; }
                                else if($row_RecordProduct['type1'] != '-1' && $row_RecordProduct['type2'] != '-1' && $row_RecordProduct['type3'] == '-1') { $level='1'; }
                                else if($row_RecordProduct['type1'] != '-1' && $row_RecordProduct['type2'] == '-1' && $row_RecordProduct['type3'] == '-1') { $level='0'; }
                                else { $level=''; }
                            ?>
                  <?php if ($level == '2') { ?>          
					  <?php if ($row_RecordProduct['pic'] != "") { ?> 
                      <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1'],'type2'=>$row_RecordProduct['type2'],'type3'=>$row_RecordProduct['type3']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>" title="<?php echo $row_RecordProduct['name']; ?>" ><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/product/thumb/small_<?php echo GetFileThumbExtend($row_RecordProduct['pic']); ?>" alt="<?php echo $row_RecordProduct['sdescription']; ?>"/></a>
                      <?php } else { ?>      
                      <a><img src="images/100x100_noimage.jpg" width="100" height="100"/></a>
                      <?php } ?>
                  <?php } else if ($level == '1') { ?>
                      <?php if ($row_RecordProduct['pic'] != "") { ?> 
                      <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1'],'type2'=>$row_RecordProduct['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>" title="<?php echo $row_RecordProduct['name']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/product/thumb/small_<?php echo GetFileThumbExtend($row_RecordProduct['pic']); ?>" alt="<?php echo $row_RecordProduct['sdescription']; ?>"/></a>
                      <?php } else { ?>      
                      <a><img src="images/100x100_noimage.jpg" width="100" height="100"/></a>
                      <?php } ?>
                  <?php } else if ($level == '0') { ?>
                      <?php if ($row_RecordProduct['pic'] != "") { ?> 
                      <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>" title="<?php echo $row_RecordProduct['name']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/product/thumb/small_<?php echo GetFileThumbExtend($row_RecordProduct['pic']); ?>" alt="<?php echo $row_RecordProduct['sdescription']; ?>"/></a>
                      <?php } else { ?>      
                      <a><img src="images/100x100_noimage.jpg" width="100" height="100"/></a>
                      <?php } ?>
                  <?php } else { ?>
                      <?php if ($row_RecordProduct['pic'] != "") { ?> 
                      <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>" title="<?php echo $row_RecordProduct['name']; ?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/product/thumb/small_<?php echo GetFileThumbExtend($row_RecordProduct['pic']); ?>" alt="<?php echo $row_RecordProduct['sdescription']; ?>"/></a>
                      <?php } else { ?>      
                      <a><img src="images/100x100_noimage.jpg" width="100" height="100"/></a>
                      <?php } ?>
                  <?php } ?>
                  </div> 
                </div>
                <form id="form1" name="form1" method="post" action="<?php echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'addpage'),'',$UrlWriteEnable);?>">
                    <div class="product_inner_board_context">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center" valign="top"><?php //echo $Lang_Classify_Context_Name_Product //名稱： ?>
                              <?php if ($level == '2') { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1'],'type2'=>$row_RecordProduct['type2'],'type3'=>$row_RecordProduct['type3']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } else if ($level == '1') { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1'],'type2'=>$row_RecordProduct['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } else if ($level == '0') { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } else { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } ?>                  
                              </td>
                            </tr>
                          <?php if ($row_RecordProduct['pdseries'] !='') { ?>
                          <?php } ?>
                          <?php if ($row_RecordProduct['model'] !='') { ?>
                          <?php } ?>
                          <?php if ($row_RecordProduct['price'] !='') { ?>
                          <?php } ?>
                          <?php if ($row_RecordProduct['spprice'] !='') { ?>
                          <?php } ?>
                          <?php if ($row_RecordProduct['sdescription'] !='') { ?>
                          <?php } ?>
                        </table>
                  </div>   
                    <input name="id" type="hidden" id="id" value="<?php echo $row_RecordProduct['id']; ?>" />
                    <input name="pdseries" type="hidden" id="pdseries" value="<?php echo $row_RecordProduct['pdseries']; ?>" />
                    <input name="name" type="hidden" id="name" value="<?php echo $row_RecordProduct['name']; ?>" />
                    <input name="price" type="hidden" id="price" value="<?php echo $row_RecordProduct['price']; ?>" />
                </form>  
                </div>
                
                
                <!-- 內容 End-->
              </div>
          </div>
          <?php $i++; ?>
          <?php //if ($i%4 == 1) {echo "<div class=\"column span-4\"><div class=\"container product_inner_board\"><hr></div></div>";}?>
          <?php } while ($row_RecordProduct = mysqli_fetch_assoc($RecordProduct)); ?>
      </div>
  </div>
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
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><table width="250" border="0" cellspacing="0" cellpadding="0">
      <tr>
          <td width="61"><img src="<?php echo $SiteBaseUrl; ?>images/error_tip.png" width="60" height="60" /></td>
          <td width="189"><?php echo $Lang_Error_NoSearch; //目前尚無資料 ?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Product']; // 標題文字 ?>  →  新增</strong> 來建立該項目<?php } ?></td>
  </tr>
</table>
<br />
<br />
<?php 
} // Show if recordset empty 
#
# ============== [/if] ============== #
?>
<script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('.product_inner_board_relative .nailthumb-container').nailthumb({
				method:'<?php echo $TmpProductImageMethods; ?>', // 'crop' or 'resize'
				fitDirection:'center center'
			});
        });
</script>
<script type="text/javascript"> 
    $('.product_inner_board_context').jcolumn();
</script>