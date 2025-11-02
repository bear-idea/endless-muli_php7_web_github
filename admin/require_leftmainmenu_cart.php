<ul class="nav">
    <li class="has-sub"><a href="javascript:;" data-original-title="" data-toggle="tooltip" data-placement="right"><b class="caret"></b><i class="fa fa-clipboard"></i><span>訂單管理</span></a>
    	<ul class="sub-menu">
            <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>">檢視訂單</a></li> 
            <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=listitempage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;list_id=2">出貨狀態</a></li> 
            <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=export&amp;lang=<?php echo $_SESSION['lang']; ?>">訂單匯出</a></li> 
            <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=ivcpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="啟用時，刪除訂單時會自動扣除庫存" data-toggle="tooltip" data-placement="right">庫存校正設定</a></li> 
            </ul>
    </li>
    <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
    <li class="has-sub"><a href="javascript:;" data-original-title="" data-toggle="tooltip" data-placement="right"><b class="caret"></b><i class="fa fa-heart"></i><span>折扣專區</span></a>
    	<ul class="sub-menu">
             <li class="has-sub expand"><a href="#" data-original-title="" data-toggle="tooltip" data-placement="right"><b class="caret"></b><span>折扣維護</span></a>
             	<ul class="sub-menu" style="display:block">
                     <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=discount&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="" data-toggle="tooltip" data-placement="right">折扣活動(ALL)</a></li>
                     <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=discount_add&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="" data-toggle="tooltip" data-placement="right">新增折扣活動</a></li>
                     <!--<li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=discount_page&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="" data-toggle="tooltip" data-placement="right">折扣活動頁面</a></li>
                     <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=discount_page_add&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="" data-toggle="tooltip" data-placement="right">新增折扣活動頁面</a></li>-->
                     <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=gift&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="" data-toggle="tooltip" data-placement="right">贈品一覽</a></li>
                     <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=gift_add&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="" data-toggle="tooltip" data-placement="right">新增贈品</a></li>
                 </ul>
             </li>
             <li class="has-sub expand"><a href="#" data-original-title="" data-toggle="tooltip" data-placement="right"><b class="caret"></b><span>指定商品</span></a>
                 <ul class="sub-menu" style="display:block">
                     
                     <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=discount&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;type=0" data-original-title="指定商品滿x件打x折，例如：春裝滿2件打八折" data-toggle="tooltip" data-placement="right">滿件折扣(%)</a></li>
                     <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=discount&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;type=1" data-original-title="指定商品滿x件減x元，例如：春裝滿5件減100元" data-toggle="tooltip" data-placement="right">滿件減價(-)</a></li>
                     <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=discount&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;type=2" data-original-title="指定商品滿x元打x折，例如：春裝滿2000元打七折" data-toggle="tooltip" data-placement="right">滿額折扣(%)</a></li>
                     <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=discount&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;type=3" data-original-title="指定商品滿x元減x元，例如：春裝滿2000元減200元" data-toggle="tooltip" data-placement="right">滿額減價(-)</a></li>
                     <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=discount&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;type=4" data-original-title="指定商品任選x件x元，例如：春裝任選3件299元" data-toggle="tooltip" data-placement="right">任選優惠</a></li>
                 </ul>
             </li>
             <li class="has-sub expand"><a href="#" data-original-title="" data-toggle="tooltip" data-placement="right"><b class="caret"></b><span>全單滿額</span></a>
                 <ul class="sub-menu" style="display:block">
                     <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=discount&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;type=5" data-original-title="全單滿x元再打x折，例如：該筆訂單滿2000元再打八折，此折扣可和滿額多重減價(-)並用" data-toggle="tooltip" data-placement="right">滿額多重折扣(%)</a></li>
                     <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=discount&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;type=6" data-original-title="全單滿x元再減x元，例如：該筆訂單滿2000元再減100元，此折扣可和滿額多重折扣(%)並用" data-toggle="tooltip" data-placement="right">滿額多重減價(-)</a></li>
                     <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=discount&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;type=7" data-original-title="訂單滿x元再送贈品" data-toggle="tooltip" data-placement="right">滿額多重贈禮</a></li>
                 </ul>
             </li>
             <!--<li><a href="#" data-original-title="" data-toggle="tooltip" data-placement="right">折價卷</a></li>-->
         </ul>
    </li>
    <?php } ?>
    <li class="has-sub"><a href="javascript:;" data-original-title="" data-toggle="tooltip" data-placement="right"><b class="caret"></b><i class="far fa-credit-card"></i><span>金流設定</span></a>
    	<ul class="sub-menu">
             <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=paymentitempage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;list_id=3" data-original-title="" data-toggle="tooltip" data-placement="right">付款方式</a></li>
             <?php if($row_RecordSystemConfig['OptionCartPayLogisticSelect'] == "1" || $_SESSION['MM_UserGroup'] == 'superadmin') { ?>
             <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=paymentset&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;list_id=3" data-original-title="" data-toggle="tooltip" data-placement="right">金流串接設定</a></li> 
             <?php } ?>
            </ul>
    </li>
    <li class="has-sub"><a href="javascript:;" data-original-title="" data-toggle="tooltip" data-placement="right"><b class="caret"></b><i class="fa fa-truck"></i><span>物流設定</span></a>
    	<ul class="sub-menu">
             <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=transititempage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;list_id=1" data-original-title="新增多組貨運方式，供消費者選擇，您所設定的運費會加入到結帳金額中由消費者支付" data-toggle="tooltip" data-placement="right">貨運及貨到付款</a></li>
             <?php if($row_RecordSystemConfig['OptionCartPaymentSelect'] == "1" || $_SESSION['MM_UserGroup'] == 'superadmin') { ?>
             <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=transitset&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;list_id=3" data-original-title="" data-toggle="tooltip" data-placement="right">物流串接設定</a></li> 
             <?php } ?>
            </ul>
    </li>
    <li class="has-sub"><a href="javascript:;" data-original-title="" data-toggle="tooltip" data-placement="right"><b class="caret"></b><i class="fa fa-shopping-cart"></i><span>購物車設定</span></a>
    	<ul class="sub-menu">
              <!--<li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;list_id=1">特殊商品運費</a></li> -->
             <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=invoice&amp;lang=<?php echo $_SESSION['lang']; ?>">發票設定</a></li> 
             <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=exprice&amp;lang=<?php echo $_SESSION['lang']; ?>"data-original-title="消費者結帳時，除了購物金額外，您可以於此設定額外的費用，例如包裝費等" data-toggle="tooltip" data-placement="right">額外費用</a></li>
             <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=freeprice&amp;lang=<?php echo $_SESSION['lang']; ?>"data-original-title="" data-toggle="tooltip" data-placement="right">滿額免運費設定</a></li> 
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin' || $OptionMemberSelect == '1') { ?>
            <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=setpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="" data-toggle="tooltip" data-placement="right">會員註冊設定</a></li>
            <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=FAQ&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="" data-toggle="tooltip" data-placement="right">商品留言設定</a></li>
            <?php } ?>
            </ul>
    </li>
    <li class="has-sub"><a href="javascript:;" data-original-title="" data-toggle="tooltip" data-placement="right"><b class="caret"></b><i class="far fa-file"></i><span>頁面維護</span></a>
    	<ul class="sub-menu">
             <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=notes&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="可設定購物須知頁面於購物車選單中。" data-toggle="tooltip" data-placement="right">購物須知</a></li>
             <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=odpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="此為填寫使用者在填寫訂單時的補充說明。" data-toggle="tooltip" data-placement="right">補充說明</a></li>
             <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=paytip&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="可設定匯款通知寄送信箱及是否開啟匯款通知頁面於購物車選單中。" data-toggle="tooltip" data-placement="right">匯款通知</a></li>
            </ul>
    </li>
    <li class="has-sub"><a href="javascript:;" data-original-title="" data-toggle="tooltip" data-placement="right"><b class="caret"></b><i class="fa fa-chart-bar"></i><span>即時統計資料</span></a>
    	<ul class="sub-menu">
            <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=anypdsell&amp;lang=<?php echo $_SESSION['lang']; ?>">商品銷售排行</a></li>
            <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=anypdhot&amp;lang=<?php echo $_SESSION['lang']; ?>">商品瀏覽排行</a></li>
            <li><a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=anyusbuy&amp;lang=<?php echo $_SESSION['lang']; ?>">消費者購物排行</a></li>
            </ul>
    </li>      
</ul>

