<?php require_once('Connections/DB_Conn.php'); ?>


<ol class="breadcrumb hidden-xs" data-scroll-reveal='enter top after 0.8s'>
	<li><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>" class="home"><?php echo $Lang_Home; //首頁 ?></a></li>
    <?php 
	switch($_GET['Opt'])
	{
		case "viewpage":
	?>
    <li class="current"><a href="<?php echo $SiteBaseUrl . url_rewrite('dealer',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Dealer']; //會員專區 ?></a></li>
    <?php 
		break;
		case "editpage":
	?>
    <li><a href="<?php echo $SiteBaseUrl . url_rewrite('dealer',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Dealer']; //會員專區 ?></a></li>
    <li class="current"><a href="<?php echo $SiteBaseUrl . url_rewrite('dealer',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $Lang_Content_Title_Member_UserDate; //修改個人資料 ?></a></li>
    <?php 
		break;
		case "regpage":
	?>
    <li class="current"><a><?php echo $Lang_Content_Title_Member_Reg; //會員註冊 ?></a></li>
    <?php 
		break;
		default:
	?>
    <li class="current"><a href="<?php echo $SiteBaseUrl . url_rewrite('dealer',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Dealer']; //會員專區 ?></a></li>
    <?php 
		break;
	}
	?>
</ol>
<div class="clear" style="clear:both;"></div>