<?php require_once('Connections/DB_Conn.php'); ?>
<ul class="xbreadcrumbs" id="breadcrumbs-1" data-scroll-reveal='enter top after 0.8s'>
	<li><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>" class="home"><?php echo $Lang_Home; //首頁 ?></a></li>
    <?php 
	switch($_GET['Opt'])
	{
		case "viewpage":
	?>
    <li class="current"><i class="fa fa-angle-double-right"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Member']; //會員專區 ?></a></li>
    <?php 
		break;
		case "editpage":
	?>
    <li class="current"><i class="fa fa-angle-double-right"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Member']; //會員專區 ?></a></li>
    <li class="current"><i class="fa fa-angle-double-right"></i> <a href="#">修改個人資料</a></li>
    <?php 
		break;
		case "regpage":
	?>
    <li class="current"><i class="fa fa-angle-double-right"></i> <a>會員註冊</a></li>
    <?php 
		break;
		default:
	?>
    <li class="current"><i class="fa fa-angle-double-right"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('member',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Member']; //會員專區 ?></a></li>
    <?php 
		break;
	}
	?>
</ul>
<div class="clear" style="clear:both;"></div>