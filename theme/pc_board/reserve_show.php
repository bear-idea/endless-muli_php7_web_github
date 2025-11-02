<style type="text/css">
#notes1{width:120px}
.InnerButtom{margin-right:2px;margin-top:5px;margin-bottom:5px}
.InnerButtom a{font-weight:700;border:1px solid #CCC;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;text-shadow:0 1px 1px #fff;-webkit-box-shadow:0 1px 1px #fff;-moz-box-shadow:0 1px 1px #fff;box-shadow:0 1px 1px #fff;padding:4px 8px;white-space:nowrap;vertical-align:middle;color:#999;background:transparent;cursor:pointer;font-family:Sans-Serif;font-size:11px}
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
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right">線上訂房 - 檢視訂購資訊</span></h1>
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
      <?php if(isset($_SESSION['Room_Cart_' . $_GET['wshop']])  && $_SESSION['Room_Cart_' . $_GET['wshop']] != NULL ){ ?>
        <br />
        購物流程：購物車→填寫資料→選擇付款方式→完成訂購(消費明細)
        <div class="columns on-1">
                <div class="container board">
                    <div class="column">
                        <div class="container ct_board">
                          <form name="form1" method="post" action="">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0"class="TB_General_style01">
                          <tr>
                            <td width="50"><strong>編號</strong></td>
                            <td width="100"><strong>住宿日期</strong></td>
                            <td><strong>房型</strong></td>
                            <td width="100"><strong>價格</strong></td>
                            <td width="70"><strong>間數</strong></td>
                            <td width="30"><strong>更新</strong></td>
                            <td width="30"><strong>刪除</strong></td>
                            <td width="70"><strong>小計</strong></td>
                          </tr>
                          <?php $NO = 1;?>
                          <?php $_SESSION['Total'] = 0; $_SESSION['PlusTotal'] = 0; // 初始化總金額避免累加?>
                          <?php //$val = ''; $i = 0; // 初始化?>
                          <?php // ======== 商品列表 ======== ?>
                          <?php foreach($_SESSION['Room_Cart_' . $_GET['wshop']] as $i => $val) { ?>
                          <?php 
						        // 下方連結所需的值
						  		$N_Date = $_SESSION['Room_Date'][$i];
								$row_RecordRoomCalendar['roomid'] = $_SESSION['Room_ID'][$i];
						  ?>
                          <?php require("require_room_reserve_list_show_chickinpeople.php"); ?>
                          <?php //echo $_SESSION['Room_RoomNum'][$i]; //目前可選間數 ?>
                          <?php //echo $_SESSION['Room_Quantity'][$i] //目前訂房數 ?>
                          <?php
							//if($totalRows_RecordRoomCheckPeople > 0) { // 若訂單有資料則相減
								$CheckRoomNum = $_SESSION['Room_RoomNum'][$i]/*-$Count_Room*/;
							//}
						  ?>
                          <tr>
                            <td><?php echo $NO; ?></td>
                            <td><?php echo $_SESSION['Room_Date'][$i]; ?></td>
                            <td>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite('room',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $_SESSION['Room_ID'][$i]; ?>" target="_blank"><?php echo $_SESSION['Room_Name'][$i]; ?></a>
                            </td>
                            <td>
                            <?php
                                    echo $_SESSION['Room_RoomPrice'][$i]; 
                            ?>
                            
                            
                            </td>
                            <td>
                              <label for="modify"></label>
                              <select name="Modify[]" id="Modify[]">
                              <?php for($j=1;$j<=($CheckRoomNum);$j++) { ?>
                                <option value="<?php echo $j; ?>" <?php if (!(strcmp($j, $_SESSION['Room_Quantity'][$i]))) {echo "selected=\"selected\"";} ?>><?php echo $j; ?></option>
                              <?php } ?>
                              </select></td>
                            <td align="center"><label for="notes1"></label>                              <a href="javascript:document.form1.submit()"><i class="fa fa-refresh" style="font-size:16px"></i></a></td>
                            <td align="center"><a href="<?php echo $SiteBaseUrl . url_rewrite('room',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'showpage'),'',$UrlWriteEnable);?><?php echo $id_del_params; ?><?php echo $i; ?>&amp;pdid=<?php echo $_SESSION['Room_Cart_' . $_GET['wshop']][$i]; ?>"><i class="fa fa-trash" style="font-size:16px"></i></a></td>
                            <td>
                            <?php //小計與總價格
                            if($_SESSION['Room_RoomPrice'][$i] != '')
                            {
                                $_SESSION['itemTotal'][$i] = $_SESSION['Room_RoomPrice'][$i] * $_SESSION['Room_Quantity'][$i];
                                'price=' . $_SESSION['Room_RoomPrice'][$i];
                                //echo 'qu=' . $_SESSION['Room_Quantity'][$i];
                                echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal'][$i]);
                                $_SESSION['Total'] += $_SESSION['itemTotal'][$i];
                            }else{
                                $_SESSION['itemTotal'][$i] = $_SESSION['Room_RoomPrice'][$i] * $_SESSION['Room_Quantity'][$i];
                                'price=' . $_SESSION['Room_RoomPrice'][$i];
                                //echo 'qu=' . $_SESSION['Room_Quantity'][$i];
                                echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['itemTotal'][$i]);
                                $_SESSION['Total'] += $_SESSION['itemTotal'][$i];
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
                                <td><?php echo $_SESSION['PlusName'][$val][$k]; ?>&nbsp;<span style="font-size:9px; background-color:#FF8000; color:#FFF; padding:2px;">加購</span></td>
                                <td><?php echo $_SESSION['PlusPrice'][$val][$k]; ?></td>
                                <td>
                                <?php 
                                // 限制加購商品輸入個數
                                    if($_SESSION['PlusQuantity'][$val][$k] > $_SESSION['Room_Quantity'][$i]) {
                                         $_SESSION['PlusQuantity'][$val][$k] = $_SESSION['Room_Quantity'][$i];
                                    }
                                ?>
                                <label for="modify1"></label>
                                  <select name="Modify1[]" id="Modify1[]">
                                  <?php for($j=1;$j<=50;$j++) { ?>
                                    <option value="<?php echo $j; ?>" <?php if (!(strcmp($j, $_SESSION['PlusQuantity'][$val][$k]))) {echo "selected=\"selected\"";} ?>><?php echo $j; ?></option>
                                  <?php } ?>
                                  </select>
                                </td>
                                <td bgcolor="#EFEFEF"><a href="javascript:document.form1.submit()"><i class="fa fa-refresh" style="font-size:16px"></i></a></td>
                                <td align="center"><a href="<?php echo $SiteBaseUrl . url_rewrite('room',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'showpage'),'',$UrlWriteEnable);?><?php echo $plusid_del_params; ?><?php echo $k; ?>&amp;pdid=<?php echo $_SESSION['Room_Cart_' . $_GET['wshop']][$i]; ?>"><i class="fa fa-trash" style="font-size:16px"></i></a></td>
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
                            <td align="center"><h3><strong>目前商品總金額：<font color="#FF0000">
                            <?php $_SESSION['Total'] = $_SESSION['Total'] + $_SESSION['PlusTotal']; echo $Lang_Classify_Context_Currency_units . doFormatMoney($_SESSION['Total']); ?>
                            </font><br />
                              </strong>
                            </h3>
                                《若您有填寫/更改，請按「更新」鈕！》
        
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
                            <td align="center"><span class="InnerButtom"><a href="<?php echo $SiteBaseUrl . url_rewrite('room',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'roomlist'),'',$UrlWriteEnable);?>">上一步，檢視可訂購房型</a></span><span class="InnerButtom"><a href="<?php echo $SiteBaseUrl . url_rewrite('room',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'purchasepage'),'',$UrlWriteEnable);?>" onclick="$('.steps').steps('prev');">下一步，填寫房客資料</a></span><span class="InnerButtom"><a href="<?php echo $SiteBaseUrl . url_rewrite('room',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'clearpage'),'',$UrlWriteEnable);?>">清空購物車</a></span></td>
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
                                  <td width="189">您購物車中的商品已全部移除或尚未選購商品!!</td>
                                </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td align="center">
                              若您想繼續選購，請按下方「繼續購物」鈕<br />
                              <br /><span class="InnerButtom"><a href="<?php echo $SiteBaseUrl . url_rewrite('room',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>">繼續購物</a></span></td>
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