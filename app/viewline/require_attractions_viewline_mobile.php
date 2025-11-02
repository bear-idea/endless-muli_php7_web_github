<ol class="breadcrumb hidden-xs" data-scroll-reveal='enter top after 0.8s'>
	<li><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>" class="home"><?php echo $Lang_Home; //首頁 ?></a></li>
      <?php if ($totalRows_RecordAttractionsViewLine > 0 && $_GET['Opt']=='typepage') { // Show if recordset not empty ?>
    <li><a href="<?php echo $SiteBaseUrl . url_rewrite('attractions',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Attractions']; //組織成員 ?></a>
    </li>
    <li class="<?php if (isset($_GET['Opt']) && ($_GET['Opt']=='viewpage' || $_GET['Opt']=='typepage')) {echo 'current';} ?>"><a href="#"><?php echo $ViewLinetype; ?></a>
    </li>
	<?php } else { // Show if recordset not empty ?>
    <li class="<?php if ($_GET['Opt']!='detailed') {echo 'current';} ?>"><a href="<?php echo $SiteBaseUrl . url_rewrite('attractions',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Attractions']; //組織成員 ?></a></li>
    <?php if (isset($_GET['Opt']) && $_GET['Opt']=='detailed') {?>
    <li class="current"><a><?php echo $row_RecordAttractionsKeyWord['title']; ?></a></li>
    <?php } ?>
    <?php } ?>
</ol>
<div class="clear" style="clear:both;"></div>
<?php
mysqli_free_result($RecordAttractionsViewLine);
?>