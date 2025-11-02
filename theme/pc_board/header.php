<?php 
switch($_GET['lang'])
	{
		case "zh-tw":
			break;
		case "zh-cn":
		    if($TmpLogoDefaultImg_cn != '') {
		    $TmpLogoDefaultImg =  $TmpLogoDefaultImg_cn;
			$TmpLogoDefaultWidth =  $TmpLogoDefaultWidth_cn;
			$TmpLogoDefaultHeight =  $TmpLogoDefaultHeight_cn;
			}
			$TmpLogoDefaultLogoName =  $TmpLogoDefaultLogoName_cn;
			if($TmpLogo_cn != '') {
			$TmpLogo =  $TmpLogo_cn;
			$TmpLogoWidth =  $TmpLogoWidth_cn;
			$TmpLogoHeight =  $TmpLogoHeight_cn;
			}
			$TmpLogoLogoName =  $TmpLogoLogoName_cn;
			break;
		case "en":
		    if($TmpLogoDefaultImg_en != '') {
		    $TmpLogoDefaultImg =  $TmpLogoDefaultImg_en;
			$TmpLogoDefaultWidth =  $TmpLogoDefaultWidth_en;
			$TmpLogoDefaultHeight =  $TmpLogoDefaultHeight_en;
			}
			$TmpLogoDefaultLogoName =  $TmpLogoDefaultLogoName_en;
			if($TmpLogo_en != '') {
			$TmpLogo =  $TmpLogo_en;
			$TmpLogoWidth =  $TmpLogoWidth_en;
			$TmpLogoHeight =  $TmpLogoHeight_en;
			}
			$TmpLogoLogoName =  $TmpLogoLogoName_en;
			break;	
		case "jp":
		    if($TmpLogoDefaultImg_jp != '') {
		    $TmpLogoDefaultImg =  $TmpLogoDefaultImg_jp;
			$TmpLogoDefaultWidth =  $TmpLogoDefaultWidth_jp;
			$TmpLogoDefaultHeight =  $TmpLogoDefaultHeight_kp;
			}
			$TmpLogoDefaultLogoName =  $TmpLogoDefaultLogoName_jp;
			if($TmpLogo_jp != '') {
			$TmpLogo =  $TmpLogo_jp;
			$TmpLogoWidth =  $TmpLogoWidth_jp;
			$TmpLogoHeight =  $TmpLogoHeight_jp;
			}
			$TmpLogoLogoName =  $TmpLogoLogoName_jp;
			break;	
		default:
		    break;
	}
?>
<style type="text/css">
#apDiv_outmenu {height: <?php echo $TmpMainMenuHeight; ?>px; width: 100%; z-index: 10; right: 0px; <?php if ($TmpMainMenuLocation == '0') { // 當自定選單採用100%寬度時採用?>position: absolute; top: <?php echo $TmpDftMenu_Y; ?>px;<?php } ?> <?php if ($TmpMainMenuOImg != "") { ?>background-image: url(<?php echo $SiteImgUrl; ?><?php echo $TmpMainMenuWebName; ?>/image/tmpmainmenu/<?php echo $TmpMainMenuOImg; ?>); background-repeat: repeat-x;<?php } ?>}
#apDiv_dftmenu {position: absolute;z-index: 10;margin-left: auto;margin-right: 0px;right: <?php echo $TmpDftMenu_X; ?>px;top: 0px;}
#apDiv_picmenu {position: absolute;z-index: 10;left: <?php echo $TmpPicMenu_X; ?>px;top: <?php echo $TmpPicMenu_Y; ?>px;float: right;}
</style>
<?php if ($_GET['wshop'] == $tplwebname) { //如果目前之網頁為Logo之作者 則 使用個別樣板 之 Logo 設定 會依樣板之logo設定變動 ?>
    <div id="logo" style="position:absolute;z-index:11">
    <?php if ($TmpLogoLogoType == 0) { //類型 ?>
    <?php if ($TmpLogo != "" && GetFileExtend($TmpLogo) != '.swf') { ?>
        <span  data-scroll-reveal='enter top over 1s after 0.5s'><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpLogoWebname; ?>/logo/<?php echo $TmpLogo; ?>" alt="<?php echo $SiteName; ?>"  width="<?php echo $TmpLogoWidth; ?>" height="<?php echo $TmpLogoHeight; ?>"/></a></span>
    <?php } else if (GetFileExtend($TmpLogo) == '.swf'){ ?>
       <span  data-scroll-reveal='enter top over 1s after 0.5s'><embed type="application/x-shockwave-flash" src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop'] ?>/logo/<?php echo $TmpLogo; ?>" width="<?php echo $TmpLogoWidth; ?>" height="<?php echo $TmpLogoHeight; ?>" play="true" loop="true" quality="high" pluginspage="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>" wmode="transparent"></embed></span>
    <?php } else { ?>
    <div id="logo" style="position:absolute;z-index:11">
      <span  data-scroll-reveal='enter top over 1s after 0.5s'><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteBaseUrl ?>images/logo_default_tmp.png" width="149" height="50" /></a></span>
    </div>
    <?php }  ?>
    <?php } else { // 類型 ?>
    <span  data-scroll-reveal='enter top over 1s after 0.5s'><a href="<?php echo $SiteBaseUrl ?>index.php?wshop=<?php echo $_GET['wshop'] ?>"><?php echo $TmpLogoLogoName; ?></a></span>
    <?php }  // 類型 ?>
    </div>
<?php } else { // 若不為作者 則 使用此使用者個別設定黨之預設值 Logo 只有一個?>
	<div id="logo" style="position:absolute; z-index:11">
    <?php if ($TmpLogoDefaultLogoType == 0) { //類型 ?>
       <?php if ($TmpLogoDefaultImg != "" && GetFileExtend($TmpLogoDefaultImg) != '.swf') { ?>
        <span  data-scroll-reveal='enter top over 1s after 0.5s'><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpLogoDefaultWebName; ?>/logo/<?php echo $TmpLogoDefaultImg; ?>" alt="Logo-<?php echo $SiteName; ?>" width="<?php echo $TmpLogoDefaultWidth; ?>" height="<?php echo $TmpLogoDefaultHeight; ?>"/></a></span>
    <?php } else if (GetFileExtend($TmpLogoDefaultImg) == '.swf'){ ?>
      <span  data-scroll-reveal='enter top over 1s after 0.5s'><embed type="application/x-shockwave-flash" src="<?php echo $SiteImgUrl; ?><?php echo $TmpLogoDefaultWebName; ?>/logo/<?php echo $TmpLogoDefaultImg; ?>" width="<?php echo $TmpLogoDefaultWidth; ?>" height="<?php echo $TmpLogoDefaultHeight; ?>" play="true" loop="true" quality="high" pluginspage="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>" wmode="transparent"></embed></span>
    <?php } else { ?>
    <div id="logo" style="position:absolute; z-index:11">
      <span  data-scroll-reveal='enter top over 1s after 0.5s'><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>"><img src="<?php echo $SiteBaseUrl ?>images/logo_default.png" alt="Logo-<?php echo $SiteName; ?>" width="149" height="50" /></a></span>
    </div>
    <?php }  ?>
    <?php } else { // 類型 ?>
    <span  data-scroll-reveal='enter top over 1s after 0.5s'><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>"><?php echo $TmpLogoDefaultLogoName; ?></a></span>
    <?php }  // 類型 ?>
    </div>
<?php } ?>
<div style="text-align:right;"><?php //require_once("require_epaper_send.php"); ?></div>
<?php if ($TmpMainmenuIndicate == 1) { // 如果樣板設定為顯示就顯示主選單  ?>
<?php if ($MSMenu == '1' && $TmpMenuSelect == '1' && $TmpMainMenuLocation == '0') { // 使用獨立樣板選單 - 不可刪 (兩個選單不會同時出現) $TmpMainMenuLocation 為選單位置?>
<div id="apDiv_outmenu" data-scroll-reveal='enter right after 0.3s'><div id="apDiv_dftmenu"><?php require_once("mainmenu_userdfcustom.php"); ?></div></div>
<?php } ?>
<?php //} ?>
<?php //if ($MSLMenu != 1) { //  ?>
<?php if ($MSMenu == '1' && $TmpMenuSelect == '2') { // 使用獨立樣板選單 - 不可刪 (兩個選單不會同時出現)?>
<div id="apDiv_picmenu"><?php require_once($TplPath . "/mainmenu_pic.php"); ?></div>
<?php } ?>
<?php } ?>

