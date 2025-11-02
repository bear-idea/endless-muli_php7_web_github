<ul class="xbreadcrumbs" id="breadcrumbs-1" data-scroll-reveal='enter top after 0.8s'>
  <li><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>" class="home"><?php echo $Lang_Home; //首頁 ?></a></li>
  <?php if ($_GET['Opt'] != 'viewpage' && $row_RecordProductViewLine_l1['itemname'] != '') { // Show if recordset not empty ?>
  <li><i class="fa fa-angle-double-right"></i> 
  <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Product']; //產品資訊 ?></a>
  </li>
  <!-- 第一層分類 -->
  <?php if (isset($_GET['type1'])) { ?>
  <li class="<?php if ($_GET['Opt'] != 'detailed') { echo 'current';}?>"><i class="fa fa-angle-double-right"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$_GET['type1']),'',$UrlWriteEnable);?>"><?php echo $ViewLinetype1; ?></a>
  </li>
  <?php } ?>
  <!-- 第一層分類 END -->
  <!-- 第二層分類 -->
  <?php if (isset($_GET['type2'])) {?>
    <li class="<?php if ($_GET['Opt'] != 'detailed') { echo 'current';}?>"><i class="fa fa-angle-double-right"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$_GET['type1'],'type2'=>$_GET['type2']),'',$UrlWriteEnable);?>"><?php echo $ViewLinetype2; ?></a>
  </li>
  <?php } ?>
  <!-- 第二層分類 END -->
  <!-- 第三層分類 -->
  <?php if (isset($_GET['type3'])) {?>
     <li class="<?php if ($_GET['Opt'] != 'detailed') { echo 'current';}?>"><i class="fa fa-angle-double-right"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$_GET['type1'],'type2'=>$_GET['type2'],'type3'=>$_GET['type3']),'',$UrlWriteEnable);?>"><?php echo $ViewLinetype3; ?></a>
  </li>
  <?php } ?>
  <!-- 第三層分類 END -->
  <?php if (isset($_GET['Opt']) && $_GET['Opt']=='detailed') {?>
  <li class="current"><i class="fa fa-angle-double-right"></i> <a><?php echo $row_RecordProductKeyWord['name']; ?></a></li>
  <?php } ?>
  <?php } else { // Show if recordset not empty ?>
  <li class="current"><i class="fa fa-angle-double-right"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite("product",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Product']; //產品資訊 ?></a></li>
  <?php }  ?>
</ul>
<div class="clear" style="clear:both;"></div>
<?php
mysqli_free_result($RecordProductViewLine_l1);
?>