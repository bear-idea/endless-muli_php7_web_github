<?php //echo $Tp_Page ?>
<?php 
   //echo "<ul class=\" \">\n";
?>
             <?php 
			  if($TmpSubMainmenuIndicate == "0" && $_GET['Opt'] == 'stypepage') {$Tp_Page = "DfPage"; /* 子選單隱藏 並且 點選的是左選單 */}
			  switch($Tp_Page) // 抓取 inc_title 中的值(取的目前分類)
			  {
				  case "News":
					  require("typemenu_news.php");
					  break;	
				  case "About":

					  require("typemenu_about.php");

					  break;	
				  case "Coupons":

					  require("typemenu_coupons.php");

					  break;	
				  case "Timeline":

					  require("typemenu_timeline.php");

					  break;	
				  case "Imageshow":

					  require("typemenu_imageshow.php");

					  break;	
				  case "Article":
					  require("typemenu_article.php");
					  break;
				  case "Cart":	
				      require("typemenu_cart.php");
					  break;	
				  case "Product":
					  require("typemenu_product.php");
					  break;	
				  case "Knowledge":

					  require("typemenu_knowledge.php");

					  break;	
				  case "Guestbook":

					  require("typemenu_guestbook.php");

					  break;	
				  case "Activities":

					  require("typemenu_activities.php");
	
					  break;	
				  case "Publish":

					  require("typemenu_publish.php");
	
					  break;
				  case "Project":

					  require("typemenu_project.php");
	
					  break;	
				  case "Album":

					  require("typemenu_album.php");
	
					  break;	
				  case "Video":

					  require("typemenu_video.php");
	
					  break;	
				  case "Frilink":

					  require("typemenu_frilink.php");
	
					  break;	
				  case "Otrlink":

					  require("typemenu_otrlink.php");
	
					  break;	
				  case "Sponsor":

					  require("typemenu_sponsor.php");
	
					  break;	
				  case "Partner":

					  require("typemenu_partner.php");
	
					  break;	
				  case "Letters":

					  require("typemenu_letters.php");
	
					  break;	
				  case "Meeting":
					  $tppage = "meeting";
					  break;	
				  case "Donation":
					  $tppage = "donation";
					  break;	
				  case "Artlist":

					  require("typemenu_artlist.php");
	
					  break;	
				  case "Org":

					  require("typemenu_org.php");

					  break;	
				  case "Member":

					  require("typemenu_member.php");

					  break;
				  case "Careers":

					  require("typemenu_careers.php");

					  break;	
				  case "Actnews":

					  require("typemenu_actnews.php");
	
					  break;	
				  case "Faq":

					  require("typemenu_faq.php");
	
					  break;	
				  case "Catalog":

					  require("typemenu_catalog.php");
	
					  break;	
				  case "Forum":

					  require("typemenu_forum.php");

					  break;	
				  case "Contact":

					  require("typemenu_contact.php");
	
					  break;	
				  case "Stronghold":

					  require("typemenu_stronghold.php");
	
					  break;	
				  case "Blog":
					  $tppage = "blog";
					  break;
				  case "Picasa":

					  require("typemenu_picasa.php");
	
					  break;
				  case "Room":

					  require("typemenu_room.php");
	
					  break;
				  case "Attractions":

					  require("typemenu_attractions.php");
	
					  break;
				  case "Dealer":

					  require("typemenu_dealer.php");
	
					  break;	
				  case "Privacy":

					  require("typemenu_privacy.php");
	
					  break;
				  case "DfType":
					  require("typemenu_dfpage_tp.php");
					  break;	
				  case "DfPage":
					  require("typemenu_dfpage_tp.php");

					  break;
				  default:
					  require("typemenu_dfpage_tp.php");
					  break;
			  }
			?>
<?php
					  //echo "        </ul>\n"; 
                      			
?>