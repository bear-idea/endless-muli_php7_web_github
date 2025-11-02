<?php 
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php 
// Top SiteName
if(isset($_GET['lang']) && $_GET['lang'] != "") {
	$_SESSION['lang'] = $_GET['lang'];
if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'en' && isset($SiteSName_en) && $SiteSName_en != ""){$WshopTopName = $SiteSName_en;}else if($_SESSION['lang'] == 'zh-cn' && isset($SiteSName_cn) && $SiteSName_cn != ""){$WshopTopName = $SiteSName_cn;}else if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'zh-tw' && isset($SiteSName) && $SiteSName != ""){$WshopTopName = $SiteSName;}else if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'kr' && isset($SiteSName_kr) && $SiteSName_kr != ""){$WshopTopName = $SiteSName_kr;}else if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'sp' && isset($SiteSName_sp) && $SiteSName_sp != ""){$WshopTopName = $SiteSName_sp;}else{} 
// Footer
switch($_SESSION['lang'])
	{
		case "zh-tw":
			break;
		case "zh-cn":
			$SiteName = $SiteName_cn;
			$SiteKeyWord = $SiteKeyWord_cn;
            $SiteDesc = $SiteDesc_cn;
			$SiteSName = $SiteSName_cn;
			$SitePhone = $SitePhone_cn;
			$SiteCell = $SiteCell_cn;
			$SiteFax = $SiteFax_cn;
			$SiteAddr = $SiteAddr_cn;
			$SiteMail = $SiteMail_cn;
			break;
		case "en":
			$SiteName = $SiteName_en;
			$SiteKeyWord = $SiteKeyWord_en;
            $SiteDesc = $SiteDesc_en;
			$SiteSName = $SiteSName_en;
			$SitePhone = $SitePhone_en;
			$SiteCell = $SiteCell_en;
			$SiteFax = $SiteFax_en;
			$SiteAddr = $SiteAddr_en;
			$SiteMail = $SiteMail_en;
			break;	
		case "jp":
		    $SiteName = $SiteName_jp;
			$SiteKeyWord = $SiteKeyWord_jp;
            $SiteDesc = $SiteDesc_jp;
			$SiteSName = $SiteSName_jp;
			$SitePhone = $SitePhone_jp;
			$SiteCell = $SiteCell_jp;
			$SiteFax = $SiteFax_jp;
			$SiteAddr = $SiteAddr_jp;
			$SiteMail = $SiteMail_jp;
			break;	
		case "kr":
		    $SiteName = $SiteName_kr;
			$SiteKeyWord = $SiteKeyWord_kr;
            $SiteDesc = $SiteDesc_kr;
			$SiteSName = $SiteSName_kr;
			$SitePhone = $SitePhone_kr;
			$SiteCell = $SiteCell_kr;
			$SiteFax = $SiteFax_kr;
			$SiteAddr = $SiteAddr_kr;
			$SiteMail = $SiteMail_kr;
			break;	
		case "sp":
		    $SiteName = $SiteName_sp;
			$SiteKeyWord = $SiteKeyWord_sp;
            $SiteDesc = $SiteDesc_sp;
			$SiteSName = $SiteSName_sp;
			$SitePhone = $SitePhone_sp;
			$SiteCell = $SiteCell_sp;
			$SiteFax = $SiteFax_sp;
			$SiteAddr = $SiteAddr_sp;
			$SiteMail = $SiteMail_sp;
			break;	
		default:
		    break;
	}
}
?>