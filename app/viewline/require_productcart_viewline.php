

<ul class="xbreadcrumbs" id="breadcrumbs-1" data-scroll-reveal='enter top after 0.8s'>
  <li><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>" class="home"><?php echo $Lang_Home; //首頁 ?></a></li>
  <li><i class="fa fa-angle-double-right"></i> <a href="product.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Product&amp;lang=<?php echo $_SESSION['lang'] ?>"><?php echo $ModuleName['Product']; //產品資訊 ?></a></li>
  <li class="current"><i class="fa fa-angle-double-right"></i> <a><?php echo $row_RecordProductKeyWord['name']; ?></a></li>
</ul>
<div class="clear" style="clear:both;"></div>
