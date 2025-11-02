<ul class="xbreadcrumbs" id="breadcrumbs-1" data-scroll-reveal='enter top after 0.8s'>
	<li><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>" class="home"><?php echo $Lang_Home; //首頁 ?></a></li>
      <?php if ($totalRows_RecordProjectViewLine > 0 && isset($_GET['type']) && $_GET['type'] != '') { // Show if recordset not empty ?>
    <li><i class="fa fa-angle-double-right"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('project',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Project']; //工程實績 ?></a>
    </li>
    <li class="<?php if (isset($_GET['type']) && $_GET['type'] != '') {echo 'current';} ?>"><i class="fa fa-angle-double-right"></i> <a href="project.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Project&amp;lang=<?php echo $_SESSION['lang'] ?>&amp;type=<?php echo urlencode($_GET['type']); ?>"><?php echo $ViewLinetype; ?></a>
    </li>
	<?php } else { // Show if recordset not empty ?>
    <li class="<?php if ($_GET['Opt']!='detailed') {echo 'current';} ?>"><i class="fa fa-angle-double-right"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('project',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Project']; //工程實績 ?></a></li>
    <?php } ?>
    <?php if (isset($_GET['Opt']) && $_GET['Opt']=='detailed') {?>
    <li class="current"><i class="fa fa-angle-double-right"></i> <a><?php echo $row_RecordProjectKeyWord['title']; ?></a></li>
    <?php } ?>
</ul>
<div class="clear" style="clear:both;"></div>
<?php
mysqli_free_result($RecordProjectViewLine);
?>