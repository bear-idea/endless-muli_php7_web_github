<ol class="breadcrumb hidden-xs" data-scroll-reveal='enter top after 0.8s'>
	<li><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>" class="home"><?php echo $Lang_Home; //首頁 ?></a></li>
    <li class="<?php if ($_GET['Opt']!='detailed') {echo 'current';} ?>"><a href="<?php echo $SiteBaseUrl . url_rewrite("faq",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Faq']; //最新訊息 ?></a></li>
    <?php if ($totalRows_RecordFaqViewLine > 0 && ($_GET['Opt'] == 'viewpage' && isset($_GET['searchkey']))) { // Show if recordset not empty ?>
    <li class="current"><a href="#"><?php echo $ViewLinetype; ?></a>
    </li>
    <?php } ?>
    <?php if (isset($_GET['Opt']) && $_GET['Opt']=='detailed') {?>
    <li class="current"><a><?php echo $row_RecordFaqKeyWord['title']; ?></a></li>
    <?php } ?>
    <?php if (isset($_GET['tag'])) {?>
    <li class="current"><a><?php echo $Lang_Form_Search; ?></a></li>
    <?php } ?>
</ol>
<div class="clear" style="clear:both;"></div>
<?php
mysqli_free_result($RecordFaqViewLine);
?>