<?php require_once('Connections/DB_Conn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  Global $DB_Conn;
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = mysqli_real_escape_string($DB_Conn, $theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<link href="css/mega_menu_styles/skins/white.css" rel="stylesheet" type="text/css" />
<script type='text/javascript' src='js/mega_menu_styles/jquery.dcmegamenu.1.3.3.min.js'></script>
<div class="white">  
<ul id="mega-menu-3" class="mega-menu">
    <li><a href="about.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=About&amp;lang=<?php echo $_SESSION['lang'] ?>">關於我們</a>
    	<?php require("mainmenu_about.php"); ?>
    </li>
	<li><a href="news.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=News&amp;lang=<?php echo $_SESSION['lang'] ?>">最新訊息</a>
        <?php require("mainmenu_news.php"); ?>
    </li>
    <li><a href="product.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Product&amp;lang=<?php echo $_SESSION['lang'] ?>">產品資訊</a>
    	 <?php require("mainmenu_product.php"); ?>
    </li>
    <li><a href="project.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Project&amp;lang=<?php echo $_SESSION['lang'] ?>">工程實績</a>
         <?php require("mainmenu_project.php"); ?>
    </li>
    <li><a href="faq.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Faq&amp;lang=<?php echo $_SESSION['lang'] ?>">常見問答</a></li>
    <li><a href="catalog.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Catalog&amp;lang=<?php echo $_SESSION['lang'] ?>">型錄下載</a>
         <?php require("mainmenu_catalog.php"); ?>
    </li>
    <li><a>相關連結</a>
    	<ul>
        	<li><a href="guestbook.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Guestbook&amp;lang=<?php echo $_SESSION['lang'] ?>">留言訊息</a></li>
            <li><a href="publish.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Publish&amp;lang=<?php echo $_SESSION['lang'] ?>">發布資訊</a>
            	<?php require("mainmenu_publish.php"); ?>
            </li>
            <li><a href="activities.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Activities&amp;lang=<?php echo $_SESSION['lang'] ?>">活動花絮</a>
            	<?php require("mainmenu_activities.php"); ?>
            </li>
            <li><a href="actnews.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Actnews&amp;lang=<?php echo $_SESSION['lang'] ?>">活動快訊</a>
            	<?php require("mainmenu_actnews.php"); ?>
            </li>
            <li><a href="letters.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Letters&amp;lang=<?php echo $_SESSION['lang'] ?>">新聞快報</a>
            	<?php require("mainmenu_letters.php"); ?>
            </li>
            <li><a href="frilink.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Frilink&amp;lang=<?php echo $_SESSION['lang'] ?>">友站連結</a>
            	<?php require("mainmenu_frilink.php"); ?>
            </li>
            <li><a href="website.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=WebSite&amp;lang=<?php echo $_SESSION['lang'] ?>">網站資訊</a></li>
            <li><a href="member.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Member&amp;lang=<?php echo $_SESSION['lang'] ?>">會員專區</a></li>
            <li><a href="org.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Org&amp;lang=<?php echo $_SESSION['lang'] ?>">組織成員</a></li>
            <li><a href="careers.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Careers&amp;lang=<?php echo $_SESSION['lang'] ?>">求職徵才</a>
            	<?php require("mainmenu_careers.php"); ?>
            </li>
            <li><a href="forum.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Forum&amp;lang=<?php echo $_SESSION['lang'] ?>">討論專區</a></li>
            <li><a href="article.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Article&amp;lang=<?php echo $_SESSION['lang'] ?>">文章一覽</a>
    			<?php require("mainmenu_article.php"); ?>
   			</li>
    		<?php require("mainmenu_dftype.php"); ?>
        </ul>
    </li>
    <li><a href="contact.php?wshop=<?php echo $_GET['wshop'];?>&amp;Opt=viewpage&amp;tp=Contact&amp;lang=<?php echo $_SESSION['lang'] ?>">聯絡我們</a>
    	<?php require("mainmenu_contact.php"); ?>
    </li>
    
</ul>
</div>
<script type="text/javascript">
$(function($){
	$('#mega-menu-3').dcMegaMenu({    
		 rowItems: 3,                  // Number of sub-menus in each row        
		 speed: 'fast',  // Speed of drop down animation // speed,slow       
	     effect: 'fade',  // Type of drop down animation - 'slide' or 'fade'        
	     event: 'hover', // Use either 'hover' or 'click'        
		 fullWidth: false  // Set to true to always show sub-menus at 100% 
	});
});
</script>