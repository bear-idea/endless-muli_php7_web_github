<ul class="xbreadcrumbs" id="breadcrumbs-1" data-scroll-reveal='enter top after 0.8s'>
	<li><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>" class="home"><?php echo $Lang_Home; //首頁 ?></a></li>
      <?php if ($totalRows_RecordStrongholdViewLine > 0 && (isset($_GET['searchkey']) && $_GET['searchkey'] != '')) { // Show if recordset not empty ?>
    <li><i class="fa fa-angle-double-right"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite("stronghold",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Stronghold']; //組織成員 ?></a>
    </li>
    <li class="<?php if (isset($_GET['Opt']) && ($_GET['Opt']=='viewpage' || $_GET['Opt']=='typepage')) {echo 'current';} ?>"><i class="fa fa-angle-double-right"></i> <a href="#"><?php echo $ViewLinetype; ?></a>
    </li>
	<?php } else { // Show if recordset not empty ?>
    <li class="<?php if ($_GET['Opt']!='detailed') {echo 'current';} ?>"><i class="fa fa-angle-double-right"></i> <a href="stronghold"><?php echo $ModuleName['Stronghold']; //組織成員 ?></a></li>
    <?php if (isset($_GET['Opt']) && $_GET['Opt']=='detailed') {?>
    <li class="current"><i class="fa fa-angle-double-right"></i> <a><?php echo $row_RecordStrongholdKeyWord['title']; ?></a></li>
    <?php } ?>
    <?php } ?>
</ul>
<div class="clear" style="clear:both;"></div>
<?php
mysqli_free_result($RecordStrongholdViewLine);
?>