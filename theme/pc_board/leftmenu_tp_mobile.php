<?php //echo $Tp_Page ?>
<?php  
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
				  case "Cart":
					  $tppage = "cart";
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
					   			
?>