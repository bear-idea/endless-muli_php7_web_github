<?php require_once($Lang_CartPath); /* 最新訊息語系檔連結 */ ?>
<ul class="list-group">
            <li class="child list-group-item"><?php if($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'] != "" && isset($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID']) && count($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'])) { ?><span id="cart_counter" class="badge"><?php $Cart_Counter=0; $j=0; ?><?php foreach($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'] as $i => $val) {/*購物車檢視畫面*/if(isset($_POST['Modify']) && $_GET['Opt'] == 'showpage'){$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i]=$_POST['Modify'][$j];$j++;}/*\購物車檢視畫面*/$Cart_Counter += $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i];} ?><?php echo $Cart_Counter; ?></span><?php } ?>
            	<a href="<?php echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $Lang_Title_Cart_Show; ?></a>
            </li>
            <li class="child list-group-item">
            	<a href="<?php echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'shoppingnotes'),'',$UrlWriteEnable);?>"><?php echo $Lang_Title_Cart_Shopping_Notes; ?></a>
            </li>
            <?php if($row_RecordSystemConfigFr['CartPayMenuindicate'] == '1') { ?>
            <li class="child list-group-item">
            	<a href="<?php echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'payok'),'',$UrlWriteEnable);?>"><?php echo $Lang_Title_Cart_Payok; ?></a>
            </li>
            <?php } ?>
</ul>