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

$colname_RecordDfTypeMultiTopMenu_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordDfTypeMultiTopMenu_l1 = $_GET['lang'];
}
$coluserid_RecordDfTypeMultiTopMenu_l1 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordDfTypeMultiTopMenu_l1 = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDfTypeMultiTopMenu_l1 = sprintf("SELECT * FROM demo_dftype WHERE lang = %s && indicate=1 && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString($colname_RecordDfTypeMultiTopMenu_l1, "text"),GetSQLValueString($coluserid_RecordDfTypeMultiTopMenu_l1, "int"));
$RecordDfTypeMultiTopMenu_l1 = mysqli_query($DB_Conn, $query_RecordDfTypeMultiTopMenu_l1) or die(mysqli_error($DB_Conn));
$row_RecordDfTypeMultiTopMenu_l1 = mysqli_fetch_assoc($RecordDfTypeMultiTopMenu_l1);
$totalRows_RecordDfTypeMultiTopMenu_l1 = mysqli_num_rows($RecordDfTypeMultiTopMenu_l1);
?>
<?php 

$Count_TypeMultiTopMenu=0; 

if ($TmpMainMenuLImg != '') {
	echo "<li class='topmainmenu_l'>";
	
	if ($SiteBaseUrlOuter != '' && $TmpMainMenuWebName == 'playweb') {
		echo "<img src='".$SiteImgUrlOuter.$TmpMainMenuWebName."/image/tmpmainmenu/".$TmpMainMenuLImg."'/></li>";
	}else{
		echo "<img src='".$SiteImgUrl.$TmpMainMenuWebName."/image/tmpmainmenu/".$TmpMainMenuLImg."'/></li>";
	}
	
	echo "</li>";
}


do {
	
	// 用主選單名稱取代子選單
	if($Tp_Page == "DfType" || $Tp_Page == "DfPage") { 
		if(isset($_GET['id']) && $_GET['id'] != ""){ 
			$SubMenuName = $row_RecorddfpageKeyWord['title'];
		}else if(isset($_GET['type1']) && $_GET['type1'] != ""){ 
			$SubMenuName = $row_RecorddfpageKeyWordType['title'];
		}else{ $SubMenuName = $row_RecorddfpageKeyWordHome['title'];}
	} else if ($Tp_Page == $row_RecordDfTypeMultiTopMenu_l1['typemenu']) { 
		$SubMenuName=$row_RecordDfTypeMultiTopMenu_l1['title'];
	} 
	
	
	if (isset($_GET['aid']) && $_GET['aid'] == $row_RecordDfTypeMultiTopMenu_l1['id']) {
		echo "<li class='dropdown active'>";
    }else if($Tp_Page == $row_RecordDfTypeMultiTopMenu_l1['typemenu']){
		echo "<li class='dropdown active'>";
	}else{
		echo "<li class='dropdown'>";
	}
	
	if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'Link') {
		echo "<a href='".$row_RecordDfTypeMultiTopMenu_l1['link']."' target='_blank'>".$row_RecordDfTypeMultiTopMenu_l1['title']."</a>";
    } else if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'Cart'){
		echo "<a href='".$SiteBaseUrl . url_rewrite(strtolower($row_RecordDfTypeMultiTopMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable)."' target='_blank'>";
		echo "<span id='cart_counter' class='badge badge-red btn-xs badge-corner' style='z-index:1000;'>";
		
		if($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'] != "" && isset($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID']) && count($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'])) {
			$Cart_Counter=0; $j=0;
			foreach($_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['ID'] as $i => $val) {/*購物車檢視畫面*/
				if(isset($_POST['Modify']) && $_GET['Opt'] == 'showpage'){
					$_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i]=$_POST['Modify'][$j];
					$j++;
				}/*購物車檢視畫面*/
			}
			$Cart_Counter += $_SESSION['Cart_' . $_GET['wshop'] . '_' . $_SESSION['lang']]['Quantity'][$i];
			echo $Cart_Counter;
		}
		echo "</span>";
		echo $row_RecordDfTypeMultiTopMenu_l1['title'] . "</a>";
		
	} else if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'AnchorPoint'){
		echo "<a href='".$SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable)."#AnchorPoint_" . $row_RecordDfTypeMultiTopMenu_l1['link']."'>".$row_RecordDfTypeMultiTopMenu_l1['title']."</a>";
		
	} else if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'LinkPage'){ 
		echo "<a href='".$row_RecordDfTypeMultiTopMenu_l1['link']."'>".$row_RecordDfTypeMultiTopMenu_l1['title']."</a>";
		
	} else if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'Cart_Note'){
		echo "<a href='".$SiteBaseUrl . url_rewrite('cart',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'shoppingnotes','aid'=>$row_RecordDfTypeMultiTopMenu_l1['id']),'',$UrlWriteEnable)."'>".$row_RecordDfTypeMultiTopMenu_l1['title']."</a>";
		
	} else if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'Cart_Pay'){
		echo "<a href='".$SiteBaseUrl . url_rewrite('cart',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'payok','aid'=>$row_RecordDfTypeMultiTopMenu_l1['id']),'',$UrlWriteEnable)."'>".$row_RecordDfTypeMultiTopMenu_l1['title']."</a>";
		
	} else if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'Home'){
		echo "<a href='".$SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable)."'>".$row_RecordDfTypeMultiTopMenu_l1['title']."</a>";
		
	} else if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'DfPage' || $row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'DfType'){
		
		
		
		echo "<a href='".$SiteBaseUrl . url_rewrite(strtolower($row_RecordDfTypeMultiTopMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage','aid'=>$row_RecordDfTypeMultiTopMenu_l1['id']),'',$UrlWriteEnable)."'>".$row_RecordDfTypeMultiTopMenu_l1['title']."</a>";
		
		if($TmpSubMainmenuIndicate == "1" || $TmpSubMainmenuIndicate == "2") {
			require("app/mainmenu/mainmenu_dfpage.php");
		}
		
	} else if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'Product'){
		if($TmpSubMainmenuIndicate == "2" || $TmpSubMainmenuIndicate == "3" || $TmpSubMainmenuIndicate == "4") { require("app/mainmenu/mainmenu_product.php"); }
		
		if($TmpSubMainmenuIndicate != "3" && $TmpSubMainmenuIndicate != "4") { /* 僅顯示商品分類 */
			
			$Class_Dropdown_Toggle = '';
			if (isset($totalRows_RecordProductMultiTopMenu_l1) && $totalRows_RecordProductMultiTopMenu_l1 > 0) { 
				$Class_Dropdown_Toggle = 'dropdown-toggle';
			}
			echo "<a href='".$SiteBaseUrl . url_rewrite(strtolower($row_RecordDfTypeMultiTopMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable)."' "."class='".$Class_Dropdown_Toggle."'".">".$row_RecordDfTypeMultiTopMenu_l1['title']."</a>";
		}
		
		if($TmpSubMainmenuIndicate == "3" || $TmpSubMainmenuIndicate == "4") { require($TplPath . "/mainmenu/mainmenu_product_type.php"); }
		if($TmpSubMainmenuIndicate == "2") { require($TplPath . "/mainmenu/mainmenu_product.php"); }
			
	} else if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'News'){
		if($TmpSubMainmenuIndicate == "2") { require("app/mainmenu/mainmenu_news.php"); }
		$Class_Dropdown_Toggle = '';
		if (isset($totalRows_RecordNewsMultiTopMenu_l1) && $totalRows_RecordNewsMultiTopMenu_l1 > 0) { 
			$Class_Dropdown_Toggle = 'dropdown-toggle';
		}
		echo "<a href='".$SiteBaseUrl . url_rewrite(strtolower($row_RecordDfTypeMultiTopMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable)."' "."class='".$Class_Dropdown_Toggle."'".">".$row_RecordDfTypeMultiTopMenu_l1['title']."</a>";
		if($TmpSubMainmenuIndicate == "2") { require($TplPath . "/mainmenu/mainmenu_news.php"); }

	} else if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'About'){
		if($TmpSubMainmenuIndicate == "2") { require("app/mainmenu/mainmenu_about.php"); }
		$Class_Dropdown_Toggle = '';
		if (isset($totalRows_RecordAboutMultiTopMenu_l1) && $totalRows_RecordAboutMultiTopMenu_l1 > 0) { 
			$Class_Dropdown_Toggle = 'dropdown-toggle';
		}
		echo "<a href='".$SiteBaseUrl . url_rewrite(strtolower($row_RecordDfTypeMultiTopMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable)."' "."class='".$Class_Dropdown_Toggle."'".">".$row_RecordDfTypeMultiTopMenu_l1['title']."</a>";
		if($TmpSubMainmenuIndicate == "2") { require($TplPath . "/mainmenu/mainmenu_about.php"); }

	} else if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'Activities'){
		if($TmpSubMainmenuIndicate == "2") { require("app/mainmenu/mainmenu_activities.php"); }
		$Class_Dropdown_Toggle = '';
		if (isset($totalRows_RecordActivitiesMultiTopMenu_l1) && $totalRows_RecordActivitiesMultiTopMenu_l1 > 0) { 
			$Class_Dropdown_Toggle = 'dropdown-toggle';
		}
		echo "<a href='".$SiteBaseUrl . url_rewrite(strtolower($row_RecordDfTypeMultiTopMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable)."' "."class='".$Class_Dropdown_Toggle."'".">".$row_RecordDfTypeMultiTopMenu_l1['title']."</a>";
		if($TmpSubMainmenuIndicate == "2") { require($TplPath . "/mainmenu/mainmenu_activities.php"); }

	} else if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'Album'){
		if($TmpSubMainmenuIndicate == "2") { require("app/mainmenu/mainmenu_album.php"); }
		$Class_Dropdown_Toggle = '';
		if (isset($totalRows_RecordAlbumMultiTopMenu_l1) && $totalRows_RecordAlbumMultiTopMenu_l1 > 0) { 
			$Class_Dropdown_Toggle = 'dropdown-toggle';
		}
		echo "<a href='".$SiteBaseUrl . url_rewrite(strtolower($row_RecordDfTypeMultiTopMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable)."' "."class='".$Class_Dropdown_Toggle."'".">".$row_RecordDfTypeMultiTopMenu_l1['title']."</a>";
		if($TmpSubMainmenuIndicate == "2") { require($TplPath . "/mainmenu/mainmenu_album.php"); }

	} else if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'Article'){
		if($TmpSubMainmenuIndicate == "2") { require("app/mainmenu/mainmenu_article.php"); }
		$Class_Dropdown_Toggle = '';
		if (isset($totalRows_RecordArticleMultiTopMenu_l1) && $totalRows_RecordArticleMultiTopMenu_l1 > 0) { 
			$Class_Dropdown_Toggle = 'dropdown-toggle';
		}
		echo "<a href='".$SiteBaseUrl . url_rewrite(strtolower($row_RecordDfTypeMultiTopMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable)."' "."class='".$Class_Dropdown_Toggle."'".">".$row_RecordDfTypeMultiTopMenu_l1['title']."</a>";
		if($TmpSubMainmenuIndicate == "2") { require($TplPath . "/mainmenu/mainmenu_article.php"); }

	} else if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'Careers'){
		if($TmpSubMainmenuIndicate == "2") { require("app/mainmenu/mainmenu_careers.php"); }
		$Class_Dropdown_Toggle = '';
		if (isset($totalRows_RecordCareersMultiTopMenu_l1) && $totalRows_RecordCareersMultiTopMenu_l1 > 0) { 
			$Class_Dropdown_Toggle = 'dropdown-toggle';
		}
		echo "<a href='".$SiteBaseUrl . url_rewrite(strtolower($row_RecordDfTypeMultiTopMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable)."' "."class='".$Class_Dropdown_Toggle."'".">".$row_RecordDfTypeMultiTopMenu_l1['title']."</a>";
		if($TmpSubMainmenuIndicate == "2") { require($TplPath . "/mainmenu/mainmenu_careers.php"); }

	} else if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'Catalog'){
		if($TmpSubMainmenuIndicate == "2") { require("app/mainmenu/mainmenu_catalog.php"); }
		$Class_Dropdown_Toggle = '';
		if (isset($totalRows_RecordCatalogMultiTopMenu_l1) && $totalRows_RecordCatalogMultiTopMenu_l1 > 0) { 
			$Class_Dropdown_Toggle = 'dropdown-toggle';
		}
		echo "<a href='".$SiteBaseUrl . url_rewrite(strtolower($row_RecordDfTypeMultiTopMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable)."' "."class='".$Class_Dropdown_Toggle."'".">".$row_RecordDfTypeMultiTopMenu_l1['title']."</a>";
		if($TmpSubMainmenuIndicate == "2") { require($TplPath . "/mainmenu/mainmenu_catalog.php"); }

	} else if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'Letters'){
		if($TmpSubMainmenuIndicate == "2") { require("app/mainmenu/mainmenu_letters.php"); }
		$Class_Dropdown_Toggle = '';
		if (isset($totalRows_RecordLettersMultiTopMenu_l1) && $totalRows_RecordLettersMultiTopMenu_l1 > 0) { 
			$Class_Dropdown_Toggle = 'dropdown-toggle';
		}
		echo "<a href='".$SiteBaseUrl . url_rewrite(strtolower($row_RecordDfTypeMultiTopMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable)."' "."class='".$Class_Dropdown_Toggle."'".">".$row_RecordDfTypeMultiTopMenu_l1['title']."</a>";
		if($TmpSubMainmenuIndicate == "2") { require($TplPath . "/mainmenu/mainmenu_letters.php"); }

	} else if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'Project'){
		if($TmpSubMainmenuIndicate == "2") { require("app/mainmenu/mainmenu_project.php"); }
		$Class_Dropdown_Toggle = '';
		if (isset($totalRows_RecordProjectMultiTopMenu_l1) && $totalRows_RecordProjectMultiTopMenu_l1 > 0) { 
			$Class_Dropdown_Toggle = 'dropdown-toggle';
		}
		echo "<a href='".$SiteBaseUrl . url_rewrite(strtolower($row_RecordDfTypeMultiTopMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable)."' "."class='".$Class_Dropdown_Toggle."'".">".$row_RecordDfTypeMultiTopMenu_l1['title']."</a>";
		if($TmpSubMainmenuIndicate == "2") { require($TplPath . "/mainmenu/mainmenu_project.php"); }

	} else if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'Publish'){
		if($TmpSubMainmenuIndicate == "2") { require("app/mainmenu/mainmenu_publish.php"); }
		$Class_Dropdown_Toggle = '';
		if (isset($totalRows_RecordPublishMultiTopMenu_l1) && $totalRows_RecordPublishMultiTopMenu_l1 > 0) { 
			$Class_Dropdown_Toggle = 'dropdown-toggle';
		}
		echo "<a href='".$SiteBaseUrl . url_rewrite(strtolower($row_RecordDfTypeMultiTopMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable)."' "."class='".$Class_Dropdown_Toggle."'".">".$row_RecordDfTypeMultiTopMenu_l1['title']."</a>";
		if($TmpSubMainmenuIndicate == "2") { require($TplPath . "/mainmenu/mainmenu_publish.php"); }

	} else if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'Room'){
		if($TmpSubMainmenuIndicate == "2") { require("app/mainmenu/mainmenu_room.php"); }
		$Class_Dropdown_Toggle = '';
		if (isset($totalRows_RecordRoomMultiTopMenu_l1) && $totalRows_RecordRoomMultiTopMenu_l1 > 0) { 
			$Class_Dropdown_Toggle = 'dropdown-toggle';
		}
		echo "<a href='".$SiteBaseUrl . url_rewrite(strtolower($row_RecordDfTypeMultiTopMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable)."' "."class='".$Class_Dropdown_Toggle."'".">".$row_RecordDfTypeMultiTopMenu_l1['title']."</a>";
		if($TmpSubMainmenuIndicate == "2") { require($TplPath . "/mainmenu/mainmenu_room.php"); }

	} else if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'Video'){
		if($TmpSubMainmenuIndicate == "2") { require("app/mainmenu/mainmenu_video.php"); }
		$Class_Dropdown_Toggle = '';
		if (isset($totalRows_RecordVideoMultiTopMenu_l1) && $totalRows_RecordVideoMultiTopMenu_l1 > 0) { 
			$Class_Dropdown_Toggle = 'dropdown-toggle';
		}
		echo "<a href='".$SiteBaseUrl . url_rewrite(strtolower($row_RecordDfTypeMultiTopMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable)."' "."class='".$Class_Dropdown_Toggle."'".">".$row_RecordDfTypeMultiTopMenu_l1['title']."</a>";
		if($TmpSubMainmenuIndicate == "2") { require($TplPath . "/mainmenu/mainmenu_video.php"); }

	} else if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'Faq'){
		if($TmpSubMainmenuIndicate == "2") { require("app/mainmenu/mainmenu_faq.php"); }
		$Class_Dropdown_Toggle = '';
		if (isset($totalRows_RecordFaqMultiTopMenu_l1) && $totalRows_RecordFaqMultiTopMenu_l1 > 0) { 
			$Class_Dropdown_Toggle = 'dropdown-toggle';
		}
		echo "<a href='".$SiteBaseUrl . url_rewrite(strtolower($row_RecordDfTypeMultiTopMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable)."' "."class='".$Class_Dropdown_Toggle."'".">".$row_RecordDfTypeMultiTopMenu_l1['title']."</a>";
		if($TmpSubMainmenuIndicate == "2") { require($TplPath . "/mainmenu/mainmenu_faq.php"); }

	} else if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'Artlist'){
		if($TmpSubMainmenuIndicate == "2") { require("app/mainmenu/mainmenu_artlist.php"); }
		$Class_Dropdown_Toggle = '';
		if (isset($totalRows_RecordArtlistMultiTopMenu_l1) && $totalRows_RecordArtlistMultiTopMenu_l1 > 0) { 
			$Class_Dropdown_Toggle = 'dropdown-toggle';
		}
		echo "<a href='".$SiteBaseUrl . url_rewrite(strtolower($row_RecordDfTypeMultiTopMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable)."' "."class='".$Class_Dropdown_Toggle."'".">".$row_RecordDfTypeMultiTopMenu_l1['title']."</a>";
		if($TmpSubMainmenuIndicate == "2") { require($TplPath . "/mainmenu/mainmenu_artlist.php"); }

	} else if ($row_RecordDfTypeMultiTopMenu_l1['typemenu'] == 'Knowledge'){
		if($TmpSubMainmenuIndicate == "2") { require("app/mainmenu/mainmenu_knowledge.php"); }
		$Class_Dropdown_Toggle = '';
		if (isset($totalRows_RecordKnowledgeMultiTopMenu_l1) && $totalRows_RecordKnowledgeMultiTopMenu_l1 > 0) { 
			$Class_Dropdown_Toggle = 'dropdown-toggle';
		}
		echo "<a href='".$SiteBaseUrl . url_rewrite(strtolower($row_RecordDfTypeMultiTopMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable)."' "."class='".$Class_Dropdown_Toggle."'".">".$row_RecordDfTypeMultiTopMenu_l1['title']."</a>";
		if($TmpSubMainmenuIndicate == "2") { require($TplPath . "/mainmenu/mainmenu_knowledge.php"); }

	} else {
		echo "<a href='".$SiteBaseUrl . url_rewrite(strtolower($row_RecordDfTypeMultiTopMenu_l1['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable)."'>".$row_RecordDfTypeMultiTopMenu_l1['title']."</a>";

		
	}
	
	echo "</li>";
	$Count_TypeMultiTopMenu++;

} while ($row_RecordDfTypeMultiTopMenu_l1 = mysqli_fetch_assoc($RecordDfTypeMultiTopMenu_l1));
	
if ($TmpMainMenuRImg != '') {
	echo "<li class='topmainmenu_r'>";
	
	if ($SiteBaseUrlOuter != '' && $TmpMainMenuWebName == 'playweb') {
		echo "<img src='".$SiteImgUrlOuter.$TmpMainMenuWebName."/image/tmpmainmenu/".$TmpMainMenuRImg."'/></li>";
	}else{
		echo "<img src='".$SiteImgUrl.$TmpMainMenuWebName."/image/tmpmainmenu/".$TmpMainMenuRImg."'/></li>";
	}
	
	echo "</li>";
}
	
mysqli_free_result($RecordDfTypeMultiTopMenu_l1);
?>
