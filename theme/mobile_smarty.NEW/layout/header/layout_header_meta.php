<meta name="viewport" content="initial-scale=1.0,user-scalable=yes,maximum-scale=2">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="HandheldFriendly" content="True">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="keywords" content="<?php echo $Title_Keyword; ?>" />
<meta name="description" content="<?php echo $Title_Desc; ?>" />
<meta name="author" content="<?php if($WshopTopName != ""){echo $WshopTopName;} ?>" />
<meta name="designer" content="<?php echo $WebSiteDesigner; ?>" />
<meta name="publisher" content="<?php echo $WebSitePublisher; ?>" />
<meta name="copyright" content="<?php echo $WebSiteCopyright; ?>" />
<meta name="robots" content="<?php echo $SitePrivate ?>" />
<meta name="googlebot" content="<?php echo $SitePrivate ?>" />
<meta name="distribution" content="global" />
<meta name="content-Language" content="<?php if($_GET['lang'] == "en") {echo "en";} else if($_GET['lang'] == "zh-cn"){echo "zh-cn";} else if($_GET['lang'] == "jp") {echo "jp";}else {echo "zh-tw";}?>">
<link rel="shortcut icon" type="image/x-icon" href="<?php if($SiteIcon != ""){echo $SiteFileUrl; ?>/site/<?php echo $_GET['wshop']; ?>/image/<?php echo $SiteIcon;}else{echo "favicon.ico";} ?>">
<link rel='bookmark' href='<?php if($SiteIcon != ""){echo $SiteFileUrl; ?>/site/<?php echo $_GET['wshop']; ?>/image/<?php echo $SiteIcon;}else{echo "favicon.ico";} ?>' type='image/x-icon'>
<!-- FB發布屬性 -->
<meta property="og:title" content="<?php echo $Title_Word ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php if($_SERVER['HTTP_HOST'] == "www.shopneo.com.tw") { echo $SiteFileUrl . "/" . $_GET['wshop'];} else {echo "http://" . $_SERVER['HTTP_HOST'];} ?>">
<meta name="twitter:image" content="<?php if ($SiteFBShowImage != "") { ?><?php echo $SiteFileUrl; ?>/site/<?php echo $_GET['wshop']; ?>/image/<?php echo $SiteFBShowImage; ?><?php  } ?>">
<meta property="og:image" content="<?php if ($SiteFBShowImage != "") { ?><?php echo $SiteFileUrl; ?>/site/<?php echo $_GET['wshop']; ?>/image/<?php echo $SiteFBShowImage; ?><?php  } ?>">
<meta property="og:site_name" content="<?php echo $SiteName; ?>">
<meta itemprop="image" content="<?php if ($SiteFBShowImage != "") { ?><?php echo $SiteFileUrl; ?>/site/<?php echo $_GET['wshop']; ?>/image/<?php echo $SiteFBShowImage; ?><?php  } ?>">
<meta name="google-site-verification" content="<?php echo $GoogleVerificationCode; ?>">
<meta name="msvalidate.01" content="<?php echo $YahooVerificationCode; ?>">