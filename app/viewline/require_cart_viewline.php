<?php require_once('Connections/DB_Conn.php'); ?>


<ul class="xbreadcrumbs" id="breadcrumbs-1" data-scroll-reveal='enter top after 0.8s'>
	<li><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>" class="home"><?php echo $Lang_Home; //首頁 ?></a></li>
    <li><i class="fa fa-angle-double-right"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Product']; //產品資訊 ?></a></li>
    <li><i class="fa fa-angle-double-right"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite("cart",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'showpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Cart']; //購物車 ?></a></li>
    
    <?php
			switch($_GET['Opt'])
			{
				case "showpage":
					echo"<li class=\"current\"><i class=\"fa fa-angle-double-right\"></i> <a>" . $Lang_Title_Cart_Show . "</a></li>";	
					break;
				case "checkpage":
					echo"<li class=\"current\"><i class=\"fa fa-angle-double-right\"></i> <a>" . $Lang_Title_Cart_Check . "</a></li>";		
					break;
				case "purchasepage":
					echo"<li class=\"current\"><i class=\"fa fa-angle-double-right\"></i> <a>" . $Lang_Title_Cart_Purchase . "</a></li>";			
					break;
				case "purchasecheckpage":
					echo"<li class=\"current\"><i class=\"fa fa-angle-double-right\"></i> <a>" . $Lang_Title_Cart_Send . "</a></li>";			
					break;
				case "payok":
					echo"<li class=\"current\"><i class=\"fa fa-angle-double-right\"></i> <a>" . $Lang_Title_Cart_Payok . "</a></li>";			
					break;
				case "paysearch":
					echo"<li class=\"current\"><i class=\"fa fa-angle-double-right\"></i> <a>" . $Lang_Title_Cart_PaySearch . "</a></li>";			
					break;
				case "shoppingnotes":
				    echo"<li class=\"current\"><i class=\"fa fa-angle-double-right\"></i> <a>" . $Lang_Title_Cart_Shopping_Notes . "</a></li>";	
				    break;
				default:
					echo"<li class=\"current\"><i class=\"fa fa-angle-double-right\"></i> <a>" . $Lang_Title_Cart_Show . "</a></li>";
					break;
			}
		?>
</ul>
<div class="clear" style="clear:both;"></div>