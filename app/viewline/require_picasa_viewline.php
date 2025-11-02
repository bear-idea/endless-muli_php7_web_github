<?php require_once('Connections/DB_Conn.php'); ?>


<ul class="xbreadcrumbs" id="breadcrumbs-1" data-scroll-reveal='enter top after 0.8s'>
	<li><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>" class="home"><?php echo $Lang_Home; //首頁 ?></a></li>
    <?php if ($totalRows_RecordNewsViewLine > 0 && $_GET['Opt']=='typepage') { // Show if recordset not empty ?>
    <li class="current"><i class="fa fa-angle-double-right"></i> <a href="picasa.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Picasa&amp;lang=<?php echo $_SESSION['lang'] ?>"><?php echo $ModuleName['Picasa']; //雲端相簿 ?></a></li>
    <?php } else { // Show if recordset not empty ?>
    <li class="<?php if ($_GET['Opt']!='detailed') {echo 'current';} ?>"><i class="fa fa-angle-double-right"></i> <a href="picasa.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Picasa&amp;lang=<?php echo $_SESSION['lang'] ?>"><?php echo $ModuleName['Picasa']; //雲端相簿 ?></a></li>
    <?php if (isset($_GET['Opt']) && $_GET['Opt']=='detailed') {?>
    <li class="current"><i class="fa fa-angle-double-right"></i> <a><?php echo $_GET['album']; ?></a></li>
    <?php } ?>
    <?php } ?>
</ul>
<div class="clear" style="clear:both;"></div>