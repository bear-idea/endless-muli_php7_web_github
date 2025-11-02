<ul class="xbreadcrumbs" id="breadcrumbs-1" data-scroll-reveal='enter top after 0.8s'>
	<li><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>" class="home"><?php echo $Lang_Home; //首頁 ?></a></li>
      <?php if ($totalRows_RecordImageshowViewLine > 0 && $_GET['search'] != '') { // Show if recordset not empty ?>
    <li><i class="fa fa-angle-double-right"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite("imageshow",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Imageshow']; //合作夥伴 ?></a>
    </li>
    <li class="<?php if (isset($_GET['Opt']) && ($_GET['Opt']=='viewpage' || $_GET['Opt']=='typepage')) {echo 'current';} ?>"><i class="fa fa-angle-double-right"></i> <a href="#"><?php echo $ViewLinetype; ?></a>
    </li>
	<?php } else { // Show if recordset not empty ?>
    <li class="<?php if ($_GET['Opt']!='detailed') {echo 'current';} ?>"><i class="fa fa-angle-double-right"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite("imageshow",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Imageshow']; //合作夥伴 ?></a></li>
    <?php if (isset($_GET['Opt']) && $_GET['Opt']=='detailed') {?>
    <li class="current"><i class="fa fa-angle-double-right"></i> <a><?php echo $row_RecordImageshowKeyWord['title']; ?></a></li>
    <?php } ?>
    <?php } ?>
</ul>
<div class="clear" style="clear:both;"></div>
<?php
mysqli_free_result($RecordImageshowViewLine);
?>