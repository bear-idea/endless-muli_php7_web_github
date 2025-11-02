<style type="text/css">
.ct_board_product_title{padding:5px;color:#FFF;background-color:#333;margin:5px 0 0}
.swpboard{text-align:right;padding:5px}
.product_outer_board tr td{margin:0;padding:0}
div .product_inner_board{margin:1px;}

/* 外框 */
.nailthumb-container{
	border:1px solid #EEE;
	<?php if ($TmpProductViewColumn == '4') { // 預設?>
	<?php if ($TmpProductImageBoard == '0') { ?>
	height: <?php echo floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16; ?>px; /* 設定區塊高度 */
	<?php } else if ($TmpProductImageBoard == '1') { ?>
	height: <?php echo floor(floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16)*0.75; ?>px; /* 設定區塊高度(矩形) */
	<?php } ?>
	width: <?php echo floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16; ?>px;
	<?php } ?>
	<?php if ($TmpProductViewColumn == '3') { ?>
	<?php if ($TmpProductImageBoard == '0') { ?>
	height: <?php echo floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/3)-40-16; ?>px;
	<?php } else if ($TmpProductImageBoard == '1') { ?>
	height: <?php echo floor(floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/3)-40-16)*0.75; ?>px; /* 設定區塊高度(矩形) */
	<?php } ?>
	width: <?php echo floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/3)-40-16; ?>px;
	<?php } ?>
	<?php if ($TmpProductViewColumn == '2') { ?>
	<?php if ($TmpProductImageBoard == '0') { ?>
	height: <?php echo floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16; ?>px;
	<?php } else if ($TmpProductImageBoard == '1') { ?>
	height: <?php echo floor(floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16)*0.75; ?>px; /* 設定區塊高度(矩形) */
	<?php } ?>
	width: <?php echo floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16; ?>px;
	<?php } ?>
	<?php if ($TmpProductViewColumn == '1') { ?>
	<?php if ($TmpProductImageBoard == '0') { ?>
	height: <?php echo floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16; ?>px;
	<?php } else if ($TmpProductImageBoard == '1') { ?>
	height: <?php echo floor(floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16)*0.75; ?>px; /* 設定區塊高度(矩形) */
	<?php } ?>
	width: <?php echo floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16; ?>px;
	<?php } ?>
	margin:auto;
}

.product_inner_board_relative{position:relative}
.product_inner_board_relative_buttom{position:relative}

div .product_inner_board_context{
	<?php if ($TmpProductViewColumn == '4') { // 預設?>
	width: <?php echo floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16; ?>px;
	<?php } ?>
	<?php if ($TmpProductViewColumn == '3') { ?>
	width: <?php echo floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/3)-40-16; ?>px;
	<?php } ?>
	<?php if ($TmpProductViewColumn == '2') { ?>
	width: <?php echo floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16; ?>px;
	<?php } ?>
	<?php if ($TmpProductViewColumn == '1') { ?>
	width: <?php echo floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4)-40-16; ?>px;
	<?php } ?>
	margin-top: 5px;
	text-align: left;
	height: 40px;
	overflow: hidden;
}

div .product_inner_board_context a:hover{font-weight:bolder;text-decoration:none}
a:hover.switch_4block,a:hover.switch_3block,a:hover.switch_2block,a:hover.switch_list{filter:alpha(opacity=75);opacity:.5;-ms-filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=75)}
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
# ============== [rs date] ============== #
#
# 顯示資料集分頁
?>

<?php
#
# ============== [/rs date] ============== #
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
<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
    <tr>
      <td width="30%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordProduct + 1) ?> - <?php echo min($startRow_RecordProduct + $maxRows_RecordProduct, $totalRows_RecordProduct) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordProduct ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="70%" align="right">
      
      <?php if ($ProductSearchSelect == "1") { ?>
      <form id="form_Product" name="form_Product" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search; ?>" />
        </label>
      </form>
      <?php } ?>
      
      
       
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordProduct = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordProduct = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordProduct = buildNavigation($page,$totalPages_RecordProduct,$prev_RecordProduct,$next_RecordProduct,$separator,$max_links,true); 
       ?>
      <?php if ($page > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordProduct); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
        <?php print $pages_navigation_RecordProduct[0]; ?> <?php print $pages_navigation_RecordProduct[1]; ?> <?php print $pages_navigation_RecordProduct[2]; ?>
        <?php if ($page < $totalPages_RecordProduct) { // Show if not last page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordProduct, $queryString_RecordProduct); ?>"><i class="fa fa-angle-double-right"></i></a>
        <?php } // Show if not last page ?>
        <?php if (ceil($totalRows_RecordProduct/$maxRows_RecordProduct) > 1) { ?>
        <span class="Record_Board"><?php echo $Lang_PageNum; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordProduct/$maxRows_RecordProduct); ?></span>
        <?php } ?>
      </div>  
      
      </td>
    </tr>
</table>
<?php // 顯示方式 ?>
<?php if ($TmpProductViewColumn == '4') { // 預設?>
 <div class="columns on-4">
      <div class="container board">
	  <?php $i=$startRow_RecordProduct + 1; // 取得頁面第一項商品之編號 ?>
      <?php $m_count=1; ?>
          <?php do { ?> 
          <div class="column" data-scroll-reveal="enter top after <?php echo $m_count/100; ?>s">
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
                            <?php 
								switch($row_RecordProduct['plot'])
									{
										case "1":
											echo"<span style=\"font-size: 9px; color:#F00; border:#F00 solid 1px\">Hot</span>";			
											break;
										case "2":
											echo"<span style=\"font-size: 9px; color:#F00; border:#F00 solid 1px\">Act</span>";			
											break;
										case "3":
											echo"<span style=\"font-size: 9px; color:#F00; border:#F00 solid 1px\">Sale</span>";			
											break;
										case "4":
											echo"<span style=\"font-size: 9px; color:#F00; border:#F00 solid 1px\">New</span>";			
											break;				
									}
							?>
                            <?php if ($level == '2') { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1'],'type2'=>$row_RecordProduct['type2'],'type3'=>$row_RecordProduct['type3']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } else if ($level == '1') { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1'],'type2'=>$row_RecordProduct['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } else if ($level == '0') { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } else { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } ?><br />
                            <?php if ($row_RecordProduct['discounttype'] !='' && $row_RecordProduct['price'] !='' && $totalRows_RecordDiscountShow > 0) { /* 判斷是否有折扣活動 */ ?>
                              <span id="Cg_SpPrice" style="color: #FF0000; font-size:20px"><?php echo $Lang_Classify_Context_Currency_units; ?><?php echo doFormatMoney($row_RecordProduct['price']); ?></span>
                          <?php } else { /* 判斷是否有折扣活動 */ ?>
                            <?php if ($row_RecordProduct['spprice'] !='' && $OptionCartSelect == '1') { ?>
                          <?php //echo $Lang_Classify_Context_Spprice_Product //特價： ?>
                            <span id="Cg_SpPrice" style="color: #FF0000"><?php if ($row_RecordProduct['spprice'] !='') { ?><?php echo $Lang_Classify_Context_Currency_units; ?><?php echo doFormatMoney($row_RecordProduct['spprice']); ?><?php } ?></span>
                          <?php } ?>  
                          <?php if ($row_RecordProduct['price'] !='' && $OptionCartSelect == '1') { ?>
											<?php //echo $Lang_Classify_Context_Price_Product //價格： ?><span id="Cg_Price" style="color:#CCC;"><?php if ($row_RecordProduct['price'] !='') { ?><s><?php echo $Lang_Classify_Context_Currency_units; ?><?php echo doFormatMoney($row_RecordProduct['price']); ?></s><?php } ?></span>
                                            <div style="height:5px;"></div>
                          <?php } ?>
                          <?php } /* \判斷是否有折扣活動 */ ?>
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
          <?php $m_count++; ?>
          <?php if ($i%4 == 1) {echo "<div class=\"column span-4\"><div class=\"container product_inner_board\"><hr></div></div>";}?>
          <?php } while ($row_RecordProduct = mysqli_fetch_assoc($RecordProduct)); ?>
      </div>
  </div>
<?php } ?> 
<?php if ($TmpProductViewColumn == '3') { ?>
 <div class="columns on-3">
      <div class="container board">
	  <?php $i=$startRow_RecordProduct + 1; // 取得頁面第一項商品之編號 ?>
      <?php $m_count=1; ?>
          <?php do { ?> 
          <div class="column Menu_ListView_Icon_Board" data-scroll-reveal="enter top after <?php echo $m_count/100; ?>s">
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
                            <?php 
								switch($row_RecordProduct['plot'])
									{
										case "1":
											echo"<span style=\"font-size: 9px; color:#F00; border:#F00 solid 1px\">Hot</span>";			
											break;
										case "2":
											echo"<span style=\"font-size: 9px; color:#F00; border:#F00 solid 1px\">Act</span>";			
											break;
										case "3":
											echo"<span style=\"font-size: 9px; color:#F00; border:#F00 solid 1px\">Sale</span>";			
											break;
										case "4":
											echo"<span style=\"font-size: 9px; color:#F00; border:#F00 solid 1px\">New</span>";			
											break;				
									}
							?>
                              <?php if ($level == '2') { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1'],'type2'=>$row_RecordProduct['type2'],'type3'=>$row_RecordProduct['type3']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } else if ($level == '1') { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1'],'type2'=>$row_RecordProduct['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } else if ($level == '0') { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } else { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } ?> 
                            <br />
                            <?php if ($row_RecordProduct['spprice'] !='' && $OptionCartSelect == '1') { ?>
                          <?php //echo $Lang_Classify_Context_Spprice_Product //特價： ?>
                            <span id="Cg_SpPrice" style="color: #FF0000"><?php if ($row_RecordProduct['spprice'] !='') { ?><?php echo $Lang_Classify_Context_Currency_units; ?><?php echo doFormatMoney($row_RecordProduct['spprice']); ?><?php } ?></span>
                          <?php } ?>  
                          <?php if ($row_RecordProduct['price'] !='' && $OptionCartSelect == '1') { ?>
											<?php //echo $Lang_Classify_Context_Price_Product //價格： ?><span id="Cg_Price" style="color:#CCC;"><?php if ($row_RecordProduct['price'] !='') { ?><s><?php echo $Lang_Classify_Context_Currency_units; ?><?php echo doFormatMoney($row_RecordProduct['price']); ?></s><?php } ?></span>
                                            <div style="height:5px;"></div>
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
          <?php $m_count++; ?>
          <?php if ($i%3 == 1) {echo "<div class=\"column span-3\"><div class=\"container product_inner_board\"><hr></div></div>";}?>
          <?php } while ($row_RecordProduct = mysqli_fetch_assoc($RecordProduct)); ?>
      </div>
  </div>
<?php } ?> 
<?php if ($TmpProductViewColumn == '2') { ?>
 <div class="columns on-4">
      <div class="container board">
	  <?php $i=$startRow_RecordProduct + 1; // 取得頁面第一項商品之編號 ?>
      <?php $m_count=1; ?>
          <?php do { ?> 
      
          <div class="column" data-scroll-reveal="enter top after <?php echo $m_count/100; ?>s">
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
                </div>
                
                <!-- 內容 End-->
              </div>
          </div>
          <div class="column">
              <div class="container product_inner_board"><br />

              <form id="form1" name="form1" method="post" action="<?php echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'addpage'),'',$UrlWriteEnable);?>">
                    <div class="product_inner_board_context">
                        <table width="95%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="60" align="left" valign="top"><?php echo $Lang_Classify_Context_Name_Product //名稱： ?></td>
                            <td align="left">
                            <?php if ($level == '2') { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1'],'type2'=>$row_RecordProduct['type2'],'type3'=>$row_RecordProduct['type3']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } else if ($level == '1') { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1'],'type2'=>$row_RecordProduct['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } else if ($level == '0') { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } else { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } ?>
                            <?php 
								switch($row_RecordProduct['plot'])
									{
										case "1":
											echo"<span style=\"font-size: 9px; color:#F00; border:#F00 solid 1px\">Hot</span>";			
											break;
										case "2":
											echo"<span style=\"font-size: 9px; color:#F00; border:#F00 solid 1px\">Act</span>";			
											break;
										case "3":
											echo"<span style=\"font-size: 9px; color:#F00; border:#F00 solid 1px\">Sale</span>";			
											break;
										case "4":
											echo"<span style=\"font-size: 9px; color:#F00; border:#F00 solid 1px\">New</span>";			
											break;				
									}
							?></td>
                          </tr>
                          <?php if ($row_RecordProduct['pdseries'] !='') { ?>
                          <tr>
                            <td width="50" align="left" valign="top"><?php echo $Lang_Classify_Context_Pdseries_Product //貨號： ?></td>
                            <td align="left"><?php echo $row_RecordProduct['pdseries']; ?></td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordProduct['model'] !='') { ?>
                          <tr>
                            <td width="50" align="left" valign="top"><?php echo $Lang_Classify_Context_Model_Product //規格： ?></td>
                            <td align="left"><?php echo $row_RecordProduct['model']; ?></td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordProduct['price'] !='') { ?>
                          <tr>
                            <td width="50" align="left" valign="top"><?php echo $Lang_Classify_Context_Price_Product //價格： ?></td>
                            <td align="left"><?php echo $Lang_Classify_Context_Currency_units; ?><?php echo doFormatMoney($row_RecordProduct['price']); ?></td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordProduct['spprice'] !='') { ?>
                          <tr>
                            <td width="50" align="left" valign="top"><?php echo $Lang_Classify_Context_Spprice_Product //特價： ?></td>
                            <td align="left"><?php echo $Lang_Classify_Context_Currency_units; ?><?php echo doFormatMoney($row_RecordProduct['spprice']); ?></td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordProduct['sdescription'] !='') { ?>
                          <tr>
                            <td width="50" align="left" valign="top"><?php echo $Lang_Classify_Context_Sdescription_Product //描述： ?></td>
                            <td align="left"><?php echo TrimByLength($row_RecordProduct['sdescription'], 25, false); ?></td>
                          </tr>
                          <?php } ?>
                        </table>
                  </div>   
                    <input name="id" type="hidden" id="id" value="<?php echo $row_RecordProduct['id']; ?>" />
                    <input name="pdseries" type="hidden" id="pdseries" value="<?php echo $row_RecordProduct['pdseries']; ?>" />
                    <input name="name" type="hidden" id="name" value="<?php echo $row_RecordProduct['name']; ?>" />
                    <input name="price" type="hidden" id="price" value="<?php echo $row_RecordProduct['price']; ?>" />
                </form>
              </div>
          </div>
          <?php $i++; ?>
          <?php $m_count++; ?>
          <?php if ($i%2 == 1) {echo "<div class=\"column span-4\"><div class=\"container product_inner_board\"><hr></div></div>";}?>
          <?php } while ($row_RecordProduct = mysqli_fetch_assoc($RecordProduct)); ?>
      </div>
  </div>
<?php } ?> 

<?php if ($TmpProductViewColumn == '1') { ?>
 <div class="columns on-1">
      <div class="container board">
	  <?php $i=$startRow_RecordProduct + 1; // 取得頁面第一項商品之編號 ?>
      <?php $m_count=1; ?>
          <?php do { ?> 
          <div class="column" data-scroll-reveal="enter top after <?php echo $m_count/100; ?>s">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="<?php echo floor(($TmpWebWidth-200-$Tmp_Middle_L_M_Width-$Tmp_Middle_R_M_Width)/4); ?>" valign="top"><div class="container product_inner_board">
                <!-- 內容 -->
                <div class="photoFrame_<?php echo $TmpProductBoard; ?>" >
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
                </div>
                
                <!-- 內容 End-->
              </div></td>
                    <td align="left" valign="top"><div class="container product_inner_board"><br />

              <form id="form1" name="form1" method="post" action="<?php echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'addpage'),'',$UrlWriteEnable);?>">
                    <div class="product_inner_board_context" style="vertical-align: top;">
                        <table border="0" cellspacing="0" cellpadding="0" style=" min-width:480px;">
                          <tr>
                            <td width="50" align="right"><?php echo $Lang_Classify_Context_Name_Product //名稱： ?></td>
                            <td align="left" valign="top">
                            <?php if ($level == '2') { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1'],'type2'=>$row_RecordProduct['type2'],'type3'=>$row_RecordProduct['type3']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } else if ($level == '1') { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1'],'type2'=>$row_RecordProduct['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } else if ($level == '0') { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordProduct['type1']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } else { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordProduct['id']; ?>"><span style="color:<?php echo $TmpProductBoardFontColor; ?>"><?php echo $row_RecordProduct['name']; ?></span></a>
                            <?php } ?>
                            <?php 
								switch($row_RecordProduct['plot'])
									{
										case "1":
											echo"<span style=\"font-size: 9px; color:#F00; border:#F00 solid 1px\">Hot</span>";			
											break;
										case "2":
											echo"<span style=\"font-size: 9px; color:#F00; border:#F00 solid 1px\">Act</span>";			
											break;
										case "3":
											echo"<span style=\"font-size: 9px; color:#F00; border:#F00 solid 1px\">Sale</span>";			
											break;
										case "4":
											echo"<span style=\"font-size: 9px; color:#F00; border:#F00 solid 1px\">New</span>";			
											break;				
									}
							?></td>
                          </tr>
                          <?php if ($row_RecordProduct['pdseries'] !='') { ?>
                          <tr>
                            <td width="50" align="right" valign="top"><?php echo $Lang_Classify_Context_Pdseries_Product //貨號： ?></td>
                            <td align="left"><?php echo $row_RecordProduct['pdseries']; ?></td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordProduct['model'] !='') { ?>
                          <tr>
                            <td width="50" align="right" valign="top"><?php echo $Lang_Classify_Context_Model_Product //規格： ?></td>
                            <td align="left"><?php echo $row_RecordProduct['model']; ?></td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordProduct['price'] !='') { ?>
                          <tr>
                            <td width="50" align="right" valign="top"><?php echo $Lang_Classify_Context_Price_Product //價格： ?></td>
                            <td align="left"><?php echo $Lang_Classify_Context_Currency_units; ?><?php echo doFormatMoney($row_RecordProduct['price']); ?></td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordProduct['spprice'] !='') { ?>
                          <tr>
                            <td width="50" align="right" valign="top"><?php echo $Lang_Classify_Context_Spprice_Product //特價： ?></td>
                            <td align="left"><?php echo $Lang_Classify_Context_Currency_units; ?><?php echo doFormatMoney($row_RecordProduct['spprice']); ?></td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordProduct['sdescription'] !='') { ?>
                          <tr>
                            <td width="50" align="right" valign="top"><?php echo $Lang_Classify_Context_Sdescription_Product //描述： ?></td>
                            <td align="left"><?php echo TrimByLength($row_RecordProduct['sdescription'], 200, false); ?></td>
                          </tr>
                          <?php } ?>
                        </table>
                  </div>   
                    <input name="id" type="hidden" id="id" value="<?php echo $row_RecordProduct['id']; ?>" />
                    <input name="pdseries" type="hidden" id="pdseries" value="<?php echo $row_RecordProduct['pdseries']; ?>" />
                    <input name="name" type="hidden" id="name" value="<?php echo $row_RecordProduct['name']; ?>" />
                    <input name="price" type="hidden" id="price" value="<?php echo $row_RecordProduct['price']; ?>" />
                </form>
              </div></td>
                  </tr>
              </table>
          </div>
          <?php $i++; ?>
          <?php $m_count++; ?>
          <?php if ($i%1 == 0) {echo "<div class=\"column span-1\"><div class=\"container product_inner_board\"><hr></div></div>";}?>
          <?php } while ($row_RecordProduct = mysqli_fetch_assoc($RecordProduct)); ?>
      </div>
  </div>
<?php } ?> 
<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
    <tr>
      <td align="center">
        
        <?php if ($ProductSearchSelect == "1") { ?>
        <?php } ?>
        
        
        
        <div class="PageSelectBoard">
          <?php 
      # variable declaration
      $prev_RecordProduct = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordProduct = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordProduct = buildNavigation($page,$totalPages_RecordProduct,$prev_RecordProduct,$next_RecordProduct,$separator,$max_links,true); 
       ?>
          <?php if ($page > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordProduct); ?>"><i class="fa fa-angle-double-left"></i></a>
            <?php } // Show if not first page ?>
          <?php print $pages_navigation_RecordProduct[0]; ?> <?php print $pages_navigation_RecordProduct[1]; ?> <?php print $pages_navigation_RecordProduct[2]; ?>
          <?php if ($page < $totalPages_RecordProduct) { // Show if not last page ?>
            <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordProduct, $queryString_RecordProduct); ?>"><i class="fa fa-angle-double-right"></i></a>
            <?php } // Show if not last page ?>
          <?php if (ceil($totalRows_RecordProduct/$maxRows_RecordProduct) > 1) { ?>
          <span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordProduct/$maxRows_RecordProduct); ?></span>
          <?php } ?>
        </div>      </td>
      </tr>
</table> 
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
<script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('.nailthumb-container').nailthumb({
				method:'<?php echo $TmpProductImageMethods; ?>', // 'crop' or 'resize'
				fitDirection:'center center'
			});
        });
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
    $('.product_inner_board_context').jcolumn();
</script>