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
			if($TmpMobileLogo_cn != '') {
			$TmpMobileLogo =  $TmpMobileLogo_cn;
			$TmpMobileLogoWidth =  $TmpMobileLogoWidth_cn;
			$TmpMobileLogoHeight =  $TmpMobileLogoHeight_cn;
			}
			$TmpMobileLogoName =  $TmpMobileLogoName_cn;
			break;
		case "en":
		    if($TmpLogoDefaultImg_en != '') {
		    $TmpLogoDefaultImg =  $TmpLogoDefaultImg_en;
			$TmpLogoDefaultWidth =  $TmpLogoDefaultWidth_en;
			$TmpLogoDefaultHeight =  $TmpLogoDefaultHeight_en;
			}
			$TmpLogoDefaultLogoName =  $TmpLogoDefaultLogoName_en;
			if($TmpMobileLogo_en != '') {
			$TmpMobileLogo =  $TmpMobileLogo_en;
			$TmpMobileLogoWidth =  $TmpMobileLogoWidth_en;
			$TmpMobileLogoHeight =  $TmpMobileLogoHeight_en;
			}
			$TmpMobileLogoName =  $TmpMobileLogoName_en;
			break;	
		default:
		    break;
	}
?>
<style type="text/css">
#logo {}
.smallogo img{max-width:200px; max-height:46px;}
</style>

    <?php if ($TmpMobileLogoType == 0) { //類型 ?>
    <?php if ($TmpMobileLogo != "" && GetFileExtend($TmpMobileLogo) != '.swf') { ?>
        <a href="index.php?wshop=<?php echo $_GET['wshop'] ?>" class="smallogo"><img src="<?php echo $SiteImgUrl; ?><?php echo $TmpMobileLogoWebname; ?>/logo/<?php echo $TmpMobileLogo; ?>" alt="<?php echo $SiteName; ?>" /></a>
    <?php } else if (GetFileExtend($TmpMobileLogo) == '.swf'){ ?>
       <a href="index.php?wshop=<?php echo $_GET['wshop'] ?>" class="smallogo"><?php echo $TmpMobileLogoName; ?></a>
    <?php } else { ?>
    <a href="index.php?wshop=<?php echo $_GET['wshop'] ?>" style="color:#FFF; font-size:24px;" class="smallogo"><?php echo $SiteSName; ?></a>
    <?php }  ?>
    <?php } else { // 類型 ?>
    <div class="smalllogodiv"><a href="index.php?wshop=<?php echo $_GET['wshop'] ?>"><?php echo $TmpMobileLogoName; ?></a></div>
    <?php }  // 類型 ?>

