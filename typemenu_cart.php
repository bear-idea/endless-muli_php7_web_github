            <span class="child btn">
            	<a href="<?php echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $Lang_Title_Cart_Show; ?></a>
            </span>
            <span class="child btn">
            	<a href="<?php echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'shoppingnotes'),'',$UrlWriteEnable);?>">購物須知</a>
            </span>
            <span class="child btn">
            	<a href="<?php echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'payok'),'',$UrlWriteEnable);?>"><?php echo $Lang_Title_Cart_Payok; ?></a>
            </span>
