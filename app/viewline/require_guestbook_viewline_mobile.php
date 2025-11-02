<?php require_once('Connections/DB_Conn.php'); ?>


<ol class="breadcrumb hidden-xs" data-scroll-reveal='enter top after 0.8s'>
	<li><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>" class="home"><?php echo $Lang_Home; //首頁 ?></a></li>
    <li class="current"><a href="<?php echo $SiteBaseUrl . url_rewrite("guestbook",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Guestbook']; //留言訊息 ?></a></li>
</ol>
<div class="clear" style="clear:both;"></div>