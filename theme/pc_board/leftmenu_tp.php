<script type='text/javascript' src='<?php echo $TplJsPath; ?>/vertical-mega-menu/jquery.dcverticalmegamenu.1.1.js'></script>
<script type="text/javascript">
$(document).ready(function($){
	$('#mega-tp').dcVerticalMegaMenu({
		rowItems: '3',
		speed: 'fast',
		effect: 'slide',
		direction: 'right'
	});
});
</script>
<?php //echo $Tp_Page ?>
<?php 
					  if ($TmpLeftMenuTitlePic != '' && $row_RecordLeftMenuColumn['indicatetopmenu'] == '1' && $_GET['tp'] != 'Home') { 
					  echo"<img src=\"".$SiteImgUrl. $TmpLeftMenuWebName. "/image/tmpleftmenu/" . $TmpLeftMenuTitlePic . "\" style=\"display:block; margin:auto\"/>  "."";
                      }
					  echo "<div class=\"dcjq-vertical-mega-menu\">\n"; 
					  echo "        <ul id=\"mega-tp\" class=\"menu\">\n";
?>
             <?php 
			  if($TmpSubMainmenuIndicate == "0" && $_GET['Opt'] == 'stypepage') {$Tp_Page = "DfPage"; /* 子選單隱藏 並且 點選的是左選單 */}
			  switch($Tp_Page) // 抓取 inc_title 中的值(取的目前分類)
			  {
				  case "News":
					  require("leftmenu_news.php");
					  break;	
				  case "About":

					  require("leftmenu_about.php");

					  break;	
				  case "Coupons":

					  require("leftmenu_coupons.php");

					  break;	
				  case "Timeline":

					  require("leftmenu_timeline.php");

					  break;	
				  case "Imageshow":

					  require("leftmenu_imageshow.php");

					  break;	
				  case "Article":
					  require("leftmenu_article.php");
					  break;
				  case "Cart":	
				      require("leftmenu_cart.php");
					  break;	
				  case "Product":
					  require("leftmenu_product.php");
					  break;	
				  case "Knowledge":

					  require("leftmenu_knowledge.php");

					  break;	
				  case "Guestbook":

					  require("leftmenu_guestbook.php");

					  break;	
				  case "Activities":

					  require("leftmenu_activities.php");
	
					  break;	
				  case "Publish":

					  require("leftmenu_publish.php");
	
					  break;
				  case "Project":

					  require("leftmenu_project.php");
	
					  break;	
				  case "Album":

					  require("leftmenu_album.php");
	
					  break;	
				  case "Video":

					  require("leftmenu_video.php");
	
					  break;	
				  case "Frilink":

					  require("leftmenu_frilink.php");
	
					  break;	
				  case "Otrlink":

					  require("leftmenu_otrlink.php");
	
					  break;	
				  case "Sponsor":

					  require("leftmenu_sponsor.php");
	
					  break;	
				  case "Partner":

					  require("leftmenu_partner.php");
	
					  break;	
				  case "Letters":

					  require("leftmenu_letters.php");
	
					  break;	
				  case "Meeting":
					  $tppage = "meeting";
					  break;	
				  case "Donation":
					  $tppage = "donation";
					  break;	
				  case "Artlist":

					  require("leftmenu_artlist.php");
	
					  break;	
				  case "Org":

					  require("leftmenu_org.php");

					  break;	
				  case "Member":

					  require("leftmenu_member.php");

					  break;
				  case "Careers":

					  require("leftmenu_careers.php");

					  break;	
				  case "Actnews":

					  require("leftmenu_actnews.php");
	
					  break;	
				  case "Faq":

					  require("leftmenu_faq.php");
	
					  break;	
				  case "Catalog":

					  require("leftmenu_catalog.php");
	
					  break;		
				  case "Forum":

					  require("leftmenu_forum.php");

					  break;	
				  case "Contact":

					  require("leftmenu_contact.php");
	
					  break;	
				  case "Stronghold":

					  require("leftmenu_stronghold.php");
	
					  break;	
				  case "Blog":
					  $tppage = "blog";
					  break;
				  case "Picasa":

					  require("leftmenu_picasa.php");
	
					  break;
				  case "Room":

					  require("leftmenu_room.php");
	
					  break;
				  case "Attractions":

					  require("leftmenu_attractions.php");
	
					  break;
				  case "Dealer":

					  require("leftmenu_dealer.php");
	
					  break;
				  case "Privacy":

					  require("leftmenu_privacy.php");
	
					  break;	
				  case "DfType":
					  require("leftmenu_dfpage_tp.php");
					  break;	
				  case "DfPage":

					  require("leftmenu_dfpage_tp.php");

					  break;
				  default:
					  require("leftmenu_dfpage_tp.php");
					  break;
			  }
			?>
<?php
					  echo "        </ul>\n"; 
                      echo "</div>\n";
					  if($TmpLeftMenuBottomPic != '' && $row_RecordLeftMenuColumn['indicatebottommenu'] == '1' && $_GET['tp'] != 'Home'){
					  echo"<img src=\"".$SiteImgUrl. $TmpLeftMenuWebName. "/image/tmpleftmenu/" . $TmpLeftMenuBottomPic . "\" style=\"display:block; margin:auto\"/>  "."";} 			
?>