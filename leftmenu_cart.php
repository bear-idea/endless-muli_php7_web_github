            <li class="child list-group-item">
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