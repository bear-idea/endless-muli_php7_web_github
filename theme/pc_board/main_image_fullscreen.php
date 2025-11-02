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

$maxRows_RecordSiteMapMenuList = 10;
$pageMapMenuList = 0;
if (isset($_GET['pageMapMenuList'])) {
  $pageMapMenuList = $_GET['pageMapMenuList'];
}
$startRow_RecordSiteMapMenuList = $pageMapMenuList * $maxRows_RecordSiteMapMenuList;

$colname_RecordSiteMapMenuList = "zh-tw";
if (isset($_SESSION['lang'])) {
  $colname_RecordSiteMapMenuList = $_SESSION['lang'];
}
$coluserid_RecordSiteMapMenuList = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordSiteMapMenuList = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSiteMapMenuList = sprintf("SELECT * FROM demo_dftype WHERE lang = %s && indicate=1 && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString($colname_RecordSiteMapMenuList, "text"),GetSQLValueString($coluserid_RecordSiteMapMenuList, "int"));
$query_limit_RecordSiteMapMenuList = sprintf("%s LIMIT %d, %d", $query_RecordSiteMapMenuList, $startRow_RecordSiteMapMenuList, $maxRows_RecordSiteMapMenuList);
$RecordSiteMapMenuList = mysqli_query($DB_Conn, $query_limit_RecordSiteMapMenuList) or die(mysqli_error($DB_Conn));
$row_RecordSiteMapMenuList = mysqli_fetch_assoc($RecordSiteMapMenuList);

if (isset($_GET['totalRows_RecordSiteMapMenuList'])) {
  $totalRows_RecordSiteMapMenuList = $_GET['totalRows_RecordSiteMapMenuList'];
} else {
  $all_RecordSiteMapMenuList = mysqli_query($DB_Conn, $query_RecordSiteMapMenuList);
  $totalRows_RecordSiteMapMenuList = mysqli_num_rows($all_RecordSiteMapMenuList);
}
$totalPages_RecordSiteMapMenuList = ceil($totalRows_RecordSiteMapMenuList/$maxRows_RecordSiteMapMenuList)-1;
?>
<?php $TmpFooterFontColor = "#FFFFFF"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head> 
<meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1,width=device-width">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="HandheldFriendly" content="True">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="keywords" content="<?php echo $Title_Keyword; ?>">
<meta name="description" content="<?php echo $Title_Desc; ?>">
<meta name="author" content="<?php if($WshopTopName != ""){echo $WshopTopName;} ?>"> 
<meta name="designer" content="Fullvision">  
<meta name="publisher" content="Fullvision">
<meta name="copyright" content="Fullvision">
<meta name="robots" content="index,follow"> 
<meta name="googlebot" content="index,follow">
<meta name="distribution" content="global">
<meta name="content-Language" content="<?php if($_GET['lang'] == "en") {echo "en";} else if($_GET['lang'] == "zh-cn"){echo "zh-cn";} else if($_GET['lang'] == "jp") {echo "jp";}else {echo "zh-tw";}?>">
<link rel="shortcut icon" type="image/x-icon" href="<?php if($SiteIcon != ""){echo $SiteFileUrl; ?>/site/<?php echo $_GET['wshop']; ?>/image/<?php echo $SiteIcon;}else{echo "favicon.ico";} ?>">
<link rel='bookmark' href='<?php if($SiteIcon != ""){echo $SiteFileUrl; ?>/site/<?php echo $_GET['wshop']; ?>/image/<?php echo $SiteIcon;}else{echo "favicon.ico";} ?>' type='image/x-icon'>
<!-- FB發布屬性 -->
<meta property="og:title" content="<?php echo $Title_Word ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php if($_SERVER['HTTP_HOST'] == "www.shop3500.com") { echo $SiteFileUrl . "/" . $_GET['wshop'];} else {echo "http://" . $_SERVER['HTTP_HOST'];} ?>">
<meta name="twitter:image" content="<?php if ($SiteFBShowImage != "") { ?><?php echo $SiteFileUrl; ?>/site/<?php echo $_GET['wshop']; ?>/image/<?php echo $SiteFBShowImage; ?><?php  } ?>">
<meta property="og:image" content="<?php if ($SiteFBShowImage != "") { ?><?php echo $SiteFileUrl; ?>/site/<?php echo $_GET['wshop']; ?>/image/<?php echo $SiteFBShowImage; ?><?php  } ?>">
<meta property="og:site_name" content="<?php echo $SiteName; ?>">
<meta itemprop="image" content="<?php if ($SiteFBShowImage != "") { ?><?php echo $SiteFileUrl; ?>/site/<?php echo $_GET['wshop']; ?>/image/<?php echo $SiteFBShowImage; ?><?php  } ?>">
<meta name="google-site-verification" content="<?php echo $GoogleVerificationCode; ?>">
<meta name="msvalidate.01" content="<?php echo $YahooVerificationCode; ?>">
<title><?php echo $Title_Word ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $SiteBaseUrl ?>fonts/font-awesome/css/font-awesome.min.css" />
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery-1.8.2.min.js"></script>
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>thiagosf-SkitterSlideshow/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>thiagosf-SkitterSlideshow/jquery.animate-colors-min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>thiagosf-SkitterSlideshow/jquery.skitter.min.js"></script>
<link rel="stylesheet" href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>jqui/smoothness/jquery-ui-1.8.17.custom.css" />
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.blockUI.js"></script>
<!--[if lte IE 6]>
<script language="javascript">
$(document).ready(function(){$.blockUI({message:'<table width="600" border="0" cellspacing="0" cellpadding="5"><tr><td width="14%" rowspan="2"><img src="ie6die/ie6-die.png" width="100" height="102" /></td><td width="86%" align="left"><span title="" closure_uid_ymkxka="66"><h3><strong>\u60a8\u6b63\u5728\u4f7f\u7528\u7684\u662f\u4ee5IE6\u70ba\u6838\u5fc3\u7684\u700f\u89bd\u5668\u700f\u89bd\u7db2\u9801\uff01</strong></h3><hr /></span> \u70ba\u4e86\u700f\u89bd\u7db2\u9801\u66f4\u5b89\u5168\u3001\u66f4\u5feb\u901f\uff0c\u8cbc\u5fc3\u5efa\u8b70\u60a8\u5347\u7d1a\u5230\u8f03\u65b0\u7684\u7248\u672c\uff0c\u6216\u662f\u6539\u7528\u5176\u4ed6\u7684\u700f\u89bd\u5668\uff0c\u4ee5\u7372\u5f97\u66f4\u597d\u7684\u4f7f\u7528\u9ad4\u9a57\u3002\u4e0b\u9762\u662f\u4e00\u4efd\u76ee\u524d\u5ee3\u53d7\u6b61\u8fce\u7684\u700f\u89bd\u5668\u5217\u8868\u3002\u53ea\u8981\u9ede\u9078\u5716\u793a\uff0c\u5373\u53ef\u9023\u5230\u5404\u81ea\u7684\u5b98\u65b9\u4e0b\u8f09\u9801\u9762\uff01<hr /></td></tr><tr><td  align="left"><a href="http://www.microsoft.com/windows/Internet-explorer/default.aspx"><img src="ie6die/01.png" width="49" height="24" /></a><a href="http://www.mozilla.com/firefox/"><img src="ie6die/02.png" width="95" height="24" /></a><a href="http://www.google.com/chrome"><img src="ie6die/03.png" width="96" height="24" /></a><a href="http://www.apple.com/safari/download/"><img src="ie6die/04.png" width="87" height="24" /></a><a href="http://www.opera.com/download/"><img src="ie6die/05.png" width="83" height="24" /></a></td></tr></table>',
overlayCSS:{backgroundColor:"#fff"},css:{width:"600px",backgroundColor:"#000",opacity:0.6,color:"#fff",padding:"5px"}})});
</script> 
<![endif]-->
<!--[if IE 6]>
<script type="text/javascript" src="js/iepngfix_tilebg.js"></script> 
<![endif]-->
<?php
switch($MSTMP)
{
	case "userdefault":
		echo "<link href=\"". $TplCssPath ."/incstyle_free.css\" rel=\"stylesheet\" type=\"text/css\" />";
		echo "<link href=\"". $TplCssPath ."/styleless.css\" rel=\"stylesheet\" type=\"text/css\" />";
		echo "<link href=\"". $TplCssPath . "/vertical-mega-menu/vertical_menu_basic.css\" rel=\"stylesheet\" type=\"text/css\" />";
		break;		
	default:
?>
<link href="css/incstyle.css" rel="stylesheet" type="text/css" />
<link href="css/styleless.css" rel="stylesheet" type="text/css" />
<?php
		break;
}
?>
<?php require_once("inc/inc_css_setting.min.php"); // 自訂樣式?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
.ac_footer{position:fixed;bottom:0;width:100%;opacity:.9;height:35px;background-color:<?php echo $row_RecordTmpConfig['homefullscreenfooterbackground']; ?>}
.ac_content{opacity:<?php echo $row_RecordTmpConfig['homefullscreenmenuopacity']; ?>;width:100%;position:fixed;height:90px;width:100%;bottom:35px;left:0;background-color:<?php echo $row_RecordTmpConfig['homefullscreenmenubackground']; ?>;min-width:960px}
.ac_content h1{display:block;float:left;height:50px;padding:20px;font-size:36px;font-weight:700;line-height:45px;margin-right:1px;color:#FFF}
.ac_content h1 span{display:block;font-weight:400;font-size:14px}
.ac_menu{opacity:.9;float:left;position:relative;height:90px;width:100%;bottom:90px;padding:0}
.ac_menu > ul{float:right;bottom:90px;margin:0;padding:0;}
.ac_menu > ul > li{float:left;position:relative;height:90px;overflow:hidden}
.ac_menu > ul > li a{display:block;height:90px;padding:0 10px;text-align:center;line-height:90px;outline:none;font-size:18px;font-weight:700;color:<?php echo $row_RecordTmpConfig['homefullscreenmenuwordcolor']; ?>}
</style>
</head>
<body style="background-image:none; background-color:none;">
<div id="Top_Content"><?php require("require_top.php"); ?></div>
<div id="ac_content" class="ac_content">
			<h1 style="position:relative"><span></span><?php require($TplPath . "/homelogo.php"); ?></h1>
            <?php $countmenu=1; ?>
			<div class="ac_menu">
				<ul>
				<?php do { ?> 
					<li>
					  <span style="color:<?php echo $row_RecordTmpConfig['homefullscreenmenuwordcolor']; ?>" data-scroll-reveal='enter left after <?php echo $countmenu/10; ?>s'><?php if ($row_RecordSiteMapMenuList['typemenu'] == 'Link') { ?><a href="<?php echo $row_RecordSiteMapMenuList['link']; ?>" target="_blank" style="color:<?php echo $row_RecordTmpConfig['homefullscreenmenuwordcolor']; ?>"><?php echo $row_RecordSiteMapMenuList['title']; ?></a><?php }else if ($row_RecordSiteMapMenuList['typemenu'] == 'LinkPage') { ?><a href="<?php echo $row_RecordSiteMapMenuList['link']; ?>" style="color:<?php echo $row_RecordTmpConfig['homefullscreenmenuwordcolor']; ?>" ><?php echo $row_RecordSiteMapMenuList['title']; ?></a><?php } else if($row_RecordSiteMapMenuList['typemenu'] == 'DfPage' || $row_RecordSiteMapMenuList['typemenu'] == 'DfType') { ?><a href="<?php echo $SiteBaseUrl . url_rewrite(strtolower($row_RecordSiteMapMenuList['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage','aid'=>$row_RecordSiteMapMenuList['id']),'',$UrlWriteEnable);?>" style="color:<?php echo $row_RecordTmpConfig['homefullscreenmenuwordcolor']; ?>"><?php echo $row_RecordSiteMapMenuList['title']; ?></a><?php } else if ($row_RecordSiteMapMenuList['typemenu'] == 'Home') { ?><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>" style="color:<?php echo $row_RecordTmpConfig['homefullscreenmenuwordcolor']; ?>"><?php echo $row_RecordSiteMapMenuList['title']; ?></a><?php } else { ?><a href="<?php echo $SiteBaseUrl . url_rewrite(strtolower($row_RecordSiteMapMenuList['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"style="color:<?php echo $row_RecordTmpConfig['homefullscreenmenuwordcolor']; ?>"><?php echo $row_RecordSiteMapMenuList['title']; ?></a><?php }  ?></span>
					</li>
				<?php } while ($row_RecordSiteMapMenuList = mysqli_fetch_assoc($RecordSiteMapMenuList)); ?>
				</ul>
			</div>
</div>
<?php require('require_banner_homeimage_fullscreen.php'); ?>
<div class="ac_footer">
			<?php require('require_tmpfooter_line.php'); ?>
</div>

    
    

<!--<div id="board_footer">
	<img src="../images/board_bk.png" width="1000" height="60" /></div>-->
</body>
<script type="text/javascript">
$(function(){$(".light_div img").hover(function(){$(this).fadeTo("fast",0.5)},function(){$(this).fadeTo("fast",1)})});
</script>
<!-- [ 內容分頁 ] -->
<script type="text/javascript">
$(document).ready(function(){$("#page_break .num li:first").addClass("on");$("#page_break .num li").click(function(){$("#page_break div[id^='page_']").hide();$(this).hasClass("on")?$("#page_break #page_"+$(this).text()).show():($("#page_break .num li").removeClass("on"),$(this).addClass("on"),$("#page_break #page_"+$(this).text()).fadeIn("normal"))})});
</script>
<?php
mysqli_free_result($RecordSiteMapMenuList);
?>
</html>