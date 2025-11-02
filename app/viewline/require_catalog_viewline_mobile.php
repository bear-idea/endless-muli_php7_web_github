<ol class="breadcrumb hidden-xs" data-scroll-reveal='enter top after 0.8s'>
	<li><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>" class="home"><?php echo $Lang_Home; //首頁 ?></a></li>
      <?php if ($totalRows_RecordCatalogViewLine > 0 && (isset($_GET['searchkey']) && $_GET['searchkey'] != '')) { // Show if recordset not empty ?>
    <li><a href="<?php echo $SiteBaseUrl . url_rewrite('catalog',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Catalog']; //型錄下載 ?></a>
    </li>
    <li class="<?php if (isset($_GET['Opt']) && ($_GET['Opt']=='viewpage' || (isset($_GET['searchkey']) && $_GET['searchkey'] != ''))) {echo 'current';} ?>"><a href="#"><?php echo $ViewLinetype; ?></a>
    </li>
	<?php } else { // Show if recordset not empty ?>
    <li class="<?php if ($_GET['Opt']!='detailed') {echo 'current';} ?>"><a href="<?php echo $SiteBaseUrl . url_rewrite('catalog',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Catalog']; //型錄下載 ?></a></li>
    <?php if (isset($_GET['Opt']) && $_GET['Opt']=='detailed') {?>
    <li class="current"><a><?php echo $row_RecordCatalogKeyWord['title']; ?></a></li>
    <?php } ?>
    <?php } ?>
</ol>
<div class="clear" style="clear:both;"></div>
<?php
mysqli_free_result($RecordCatalogViewLine);
?>