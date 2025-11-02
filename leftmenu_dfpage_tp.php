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

$collang_RecordDfPageMultiLeftMenu_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordDfPageMultiLeftMenu_l1 = $_GET['lang'];
}
$colaid_RecordDfPageMultiLeftMenu_l1 = "-1";
if (isset($_GET['aid'])) {
  $colaid_RecordDfPageMultiLeftMenu_l1 = $_GET['aid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDfPageMultiLeftMenu_l1 = sprintf("SELECT * FROM demo_dfpageitem WHERE aid = %s && lang = %s && level = '0' && indicate = '1' ORDER BY sortid ASC, item_id DESC", GetSQLValueString($colaid_RecordDfPageMultiLeftMenu_l1, "int"),GetSQLValueString($collang_RecordDfPageMultiLeftMenu_l1, "text"));
$RecordDfPageMultiLeftMenu_l1 = mysqli_query($DB_Conn, $query_RecordDfPageMultiLeftMenu_l1) or die(mysqli_error($DB_Conn));
$row_RecordDfPageMultiLeftMenu_l1 = mysqli_fetch_assoc($RecordDfPageMultiLeftMenu_l1);
$totalRows_RecordDfPageMultiLeftMenu_l1 = mysqli_num_rows($RecordDfPageMultiLeftMenu_l1);
?>
<?php if ($totalRows_RecordDfPageMultiLeftMenu_l1 > 0) { // Show if recordset not empty ?>
<!--<div class="dcjq-vertical-mega-menu">
        <ul id="mega-tp" class="menu"> 	-->
        <?php do { ?>
        <li class="list-group-item">
            <?php if($row_RecordDfPageMultiLeftMenu_l1['typemenu'] != 'DfPage' && $row_RecordDfPageMultiLeftMenu_l1['typemenu'] != 'DfType') { ?>
            <a href="<?php echo $SiteBaseUrl . url_rewrite(strtolower($row_RecordDfPageMultiLeftMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $row_RecordDfPageMultiLeftMenu_l1['itemname']; ?></a>
            <?php } else { ?>
            
            <a href="<?php echo $SiteBaseUrl . url_rewrite(strtolower($row_RecordDfPageMultiLeftMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','aid'=>$row_RecordDfPageMultiLeftMenu_l1['aid'],'type1'=>$row_RecordDfPageMultiLeftMenu_l1['item_id']),'',$UrlWriteEnable);?>"><?php echo $row_RecordDfPageMultiLeftMenu_l1['itemname']; ?></a>
            <?php } ?>
            <?php
            switch($row_RecordDfPageMultiLeftMenu_l1['typemenu']) // 抓取 inc_title 中的值(取的目前分類)
			  {
				  case "News":
				      echo "<ul>";
					  require("leftmenu_news.php");
					  echo "</ul>";
					  break;	
				  case "About":
				      echo "<ul>";
					  require("leftmenu_about.php");
					  echo "</ul>";
					  break;	
				  case "Coupons":
				      echo "<ul>";
					  require("leftmenu_coupons.php");
					  echo "</ul>";
					  break;	
				  case "Timeline":
				      //echo "<ul>";
					  //require("leftmenu_timeline.php");
					  //echo "</ul>";
					  break;	
				  case "Imageshow":
				      echo "<ul>";
					  require("leftmenu_imageshow.php");
					  echo "</ul>";
					  break;	
				  case "Article":
					  //$tppage = "article";
					  break;
				  case "Cart":	
				  case "Product":
				      echo "<ul>";
					  require("leftmenu_product.php");
					  echo "</ul>";
					  break;	
				  case "Knowledge":
				      echo "<ul>";
					  require("leftmenu_knowledge.php");
					  echo "</ul>";
					  break;	
				  case "Guestbook":
				      //echo "<ul>";
					  //require("leftmenu_guestbook.php");
					  //echo "</ul>";
					  break;	
				  case "Activities":
				      echo "<ul>";
					  require("leftmenu_activities.php");
					  echo "</ul>";	
					  break;	
				  case "Publish":
				      echo "<ul>";
					  require("leftmenu_publish.php");
					  echo "</ul>";
					  break;
				  case "Project":
				      echo "<ul>";
					  require("leftmenu_project.php");
					  echo "</ul>";
					  break;	
				  case "Album":
				      echo "<ul>";
					  require("leftmenu_album.php");
					  echo "</ul>";
					  break;	
				  case "Video":
				      echo "<ul>";
					  require("leftmenu_video.php");
					  echo "</ul>";
					  break;	
				  case "Frilink":
				      echo "<ul>";
					  require("leftmenu_frilink.php");
					  echo "</ul>";
					  break;	
				  case "Otrlink":
				      echo "<ul>";
					  require("leftmenu_otrlink.php");
					  echo "</ul>";
					  break;	
				  case "Sponsor":
				      echo "<ul>";
					  require("leftmenu_sponsor.php");
					  echo "</ul>";
					  break;	
				  case "Partner":
				      echo "<ul>";
					  require("leftmenu_partner.php");
					  echo "</ul>";
					  break;	
				  case "Letters":
				      echo "<ul>";
					  require("leftmenu_letters.php");
					  echo "</ul>";
					  break;	
				  case "Meeting":
					  $tppage = "meeting";
					  break;	
				  case "Donation":
					  $tppage = "donation";
					  break;	
				  case "Artlist":
				      echo "<ul>";
					  require("leftmenu_artlist.php");
					  echo "</ul>";
					  break;	
				  case "Org":
				      echo "<ul>";
					  require("leftmenu_org.php");
					  echo "</ul>";
					  break;	
				  case "Member":
				      //echo "<ul>";
					  //require("leftmenu_member.php");
					  //echo "</ul>";
					  break;
				  case "Careers":
				      echo "<ul>";
					  require("leftmenu_careers.php");
					  echo "</ul>";
					  break;	
				  case "Actnews":
				      echo "<ul>";
					  require("leftmenu_actnews.php");
					  echo "</ul>";
					  break;	
				  case "Faq":
				      //echo "<ul>";
					  //require("leftmenu_faq.php");
                      //echo "</ul>";
					  break;	
				  case "Catalog":
				      echo "<ul>";
					  require("leftmenu_catalog.php");
					  echo "</ul>";	
					  break;	
				  case "Cart":
					  $tppage = "cart";
					  break;	
				  case "Forum":
				      //echo "<ul>";
					  //require("leftmenu_forum.php");
					  //echo "</ul>";
					  break;	
				  case "Contact":
				      //echo "<ul>";
					  //require("leftmenu_contact.php");
					  //echo "</ul>";	
					  break;	
				  case "Stronghold":
				      echo "<ul>";
					  require("leftmenu_stronghold.php");
					  echo "</ul>";	
					  break;	
				  case "Blog":
					  $tppage = "blog";
					  break;
				  case "Picasa":
				      //echo "<ul>";
					  //require("leftmenu_picasa.php");
					  //echo "</ul>";	
					  break;	
				  case "DfType":
					  //require("leftmenu_dfpage_tp.php");
					  break;	
				  case "DfPage":
					  //require("leftmenu_dfpage_tp.php");
					  break;
				  default:
					  //require("leftmenu_dfpage_tp.php");
					  break;
			  }
			?>
          </li>
          <?php } while ($row_RecordDfPageMultiLeftMenu_l1 = mysqli_fetch_assoc($RecordDfPageMultiLeftMenu_l1)); ?>
<!--          </ul>
      </div>-->
<?php } else { ?>
<?php // 無子分類時讀取主選單 ?>
<!--<div class="dcjq-vertical-mega-menu">
        <ul id="mega-tp" class="menu">--> 	
<?php if(isset($row_RecorddfpageKeyWordHome['title'])) { ?>
<li class="list-group-item"><a href="<?php echo $SiteBaseUrl . url_rewrite(strtolower("dfpage"),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','aid'=>$_GET['aid']),'',$UrlWriteEnable);?>"><?php echo $row_RecorddfpageKeyWordHome['title']; ?></a></li>
<?php } ?>
   <!--     </ul>
</div>-->
<?php } ?>

<?php
mysqli_free_result($RecordDfPageMultiLeftMenu_l1);
?>