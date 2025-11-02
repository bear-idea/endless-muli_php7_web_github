<ol class="breadcrumb hidden-xs" data-scroll-reveal='enter top after 0.8s'>
	<li><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>" class="home"><?php echo $Lang_Home; //首頁 ?></a></li>
      <?php if ($totalRows_RecordPublishViewLine > 0 && isset($_GET['type']) && $_GET['type'] != '') { // Show if recordset not empty ?>
    <li><a href="<?php echo $SiteBaseUrl . url_rewrite("publish",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Publish']; //發布資訊 ?></a>
    </li>
    <li class="current"><a href="#"><?php echo $ViewLinetype; ?></a>
    </li>
	<?php } else { // Show if recordset not empty ?>
    <li class="<?php if ($_GET['Opt']!='detailed') {echo 'current';} ?>"><a href="<?php echo $SiteBaseUrl . url_rewrite("publish",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Publish']; //發布資訊 ?></a></li>
    <?php if (isset($_GET['Opt']) && $_GET['Opt']=='detailed') {?>
    <li class="current"><a><?php echo $row_RecordPublishKeyWord['title']; ?></a></li>
    <?php } ?>
    <?php } ?>
</ol>
<div class="clear" style="clear:both;"></div>
<?php
mysqli_free_result($RecordPublishViewLine);
?>