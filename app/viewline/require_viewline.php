<?php require_once('Connections/DB_Conn.php'); ?>


<ul class="xbreadcrumbs" id="breadcrumbs-1" data-scroll-reveal='enter top after 0.8s'>
	<li><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>" class="home"><?php echo $Lang_Home; //首頁 ?></a></li>
	<li><a href="article.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=detailed&amp;tp=Company&amp;lang=<?php echo $_SESSION['lang'] ?>">關於我們</a>
    	<ul>
        	<li><a href="article.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=detailed&amp;tp=Company&amp;mn=About&amp;lang=<?php echo $_SESSION['lang'] ?>">品牌故事</a></li>
        	<li><a href="article.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=detailed&amp;tp=Company&amp;mn=Principle&amp;lang=<?php echo $_SESSION['lang'] ?>">經營理念</a></li>
        	<li><a href="article.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=detailed&amp;tp=Company&amp;mn=Future&amp;lang=<?php echo $_SESSION['lang'] ?>">未來展望</a></li>  
            <li><a href="article.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=detailed&amp;tp=Company&amp;mn=History&amp;lang=<?php echo $_SESSION['lang'] ?>">歷史沿革</a></li>
        </ul>
    </li>
    <li class="current"><a href="#">品牌故事</a></li>
</ul>
<div class="clear" style="clear:both;"></div>
<?php
mysqli_free_result($RecordMultiViewLineMenu_l1);
?>