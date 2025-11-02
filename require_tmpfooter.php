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
<div style="clear:both"></div>
<div style="font-size:small; vertical-align: middle; text-align:center; min-height:<?php echo $TmpFooterMinHeight; ?>px; color:<?php echo $TmpFooterFontColor; ?>;">
<div style="height:10px;"></div>
<?php //echo $row_RecordTmpFooter['content']; ?>
<?php $countmenu=1; ?>
<?php do { ?> 
  <span style="color:<?php echo $TmpFooterFontColor; ?>" data-scroll-reveal='enter left after <?php echo $countmenu/10; ?>s'><?php if ($row_RecordSiteMapMenuList['typemenu'] == 'Link') { ?><a href="<?php echo $row_RecordSiteMapMenuList['link']; ?>"style="color:<?php echo $TmpFooterFontColor; ?>"><?php echo $row_RecordSiteMapMenuList['title']; ?></a><?php } else if ($row_RecordSiteMapMenuList['typemenu'] == 'Home'){ ?><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>"style="color:<?php echo $TmpFooterFontColor; ?>"><?php echo $row_RecordSiteMapMenuList['title']; ?></a><?php } else if ($row_RecordSiteMapMenuList['typemenu'] == 'DfPage' || $row_RecordSiteMapMenuList['typemenu'] == 'DfType'){ ?><a href="<?php echo $SiteBaseUrl . url_rewrite(strtolower($row_RecordSiteMapMenuList['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage','aid'=>$row_RecordSiteMapMenuList['id']),'',$UrlWriteEnable);?>"style="color:<?php echo $TmpFooterFontColor; ?>"><?php echo $row_RecordSiteMapMenuList['title']; ?></a><?php } else if ($row_RecordSiteMapMenuList['typemenu'] == 'LinkPage'){ ?><a href="<?php echo $row_RecordSiteMapMenuList['link']; ?>"style="color:<?php echo $TmpFooterFontColor; ?>"><?php echo $row_RecordSiteMapMenuList['title']; ?></a><?php } else { ?><a href="<?php echo $SiteBaseUrl . url_rewrite(strtolower($row_RecordSiteMapMenuList['typemenu']),array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"style="color:<?php echo $TmpFooterFontColor; ?>"><?php echo $row_RecordSiteMapMenuList['title']; ?></a><?php }  ?><?php if ($countmenu < min($startRow_RecordSiteMapMenuList + $maxRows_RecordSiteMapMenuList, $totalRows_RecordSiteMapMenuList)) { echo ' | '; }?><?php $countmenu++; ?></span>
<?php } while ($row_RecordSiteMapMenuList = mysqli_fetch_assoc($RecordSiteMapMenuList)); ?> <?php if ($LangChooseZHTW == '1') { ?><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>'zh-tw'),'',$UrlWriteEnable);?>" style="color:<?php echo $TmpFooterFontColor; ?>">繁體</a><?php } ?> <?php if ($LangChooseEN == '1') { ?><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>'en'),'',$UrlWriteEnable);?>" style="color:<?php echo $TmpFooterFontColor; ?>">English</a><?php } ?> <?php if ($LangChooseZHCN == '1') { ?><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>'zh-cn'),'',$UrlWriteEnable);?>" style="color:<?php echo $TmpFooterFontColor; ?>">简体</a><?php } ?> <?php if ($LangChooseJP == '1') { ?><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>'jp'),'',$UrlWriteEnable);?>" style="color:<?php echo $TmpFooterFontColor; ?>">日文</a><?php } ?> <?php if ($LangChooseKR == '1') { ?><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>'kr'),'',$UrlWriteEnable);?>" style="color:<?php echo $TmpFooterFontColor; ?>">韓文</a><?php } ?> <?php if ($LangChooseSP == '1') { ?><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>'sp'),'',$UrlWriteEnable);?>" style="color:<?php echo $TmpFooterFontColor; ?>">西班牙語</a><?php } ?><br />
  <span data-scroll-reveal='enter bottom'><?php if ($SitePhone != '') { ?><i class="fa fa-phone"></i> <?php echo $Lang_Footer_Tel; ?>：<?php echo $SitePhone; ?><?php } ?> <?php if ($SiteFax != '') { ?><i class="fa fa-print"></i> <?php echo $Lang_Footer_Fax; ?>：<?php echo $SiteFax; ?><?php } ?> <?php if ($SiteMail != '') { ?><i class="fa fa-envelope-o"></i> <?php echo "Mail"; ?>：<a href="mailto:<?php echo $SiteMail; ?>" style="color:<?php echo $TmpFooterFontColor; ?>"><?php echo $SiteMail; ?></a><?php } ?> <?php if ($SiteCell != '') { ?><i class="fa fa-tablet"></i> <?php echo $Lang_Footer_Cell; ?>：<?php echo $SiteCell; ?><?php } ?></span><br />
  <span data-scroll-reveal='enter bottom over 1s'><?php if ($SiteAddr != '') { ?><i class="fa fa-map-marker"></i> <?php echo $Lang_Footer_Addr; ?>：<?php echo $SiteAddr; ?><?php } ?></span><br />
  <span data-scroll-reveal='enter bottom after 0.1s'><?php echo $SiteSName; ?> Copyright © <?php echo autoUpdatingCopyright(2009); ?> Design by <?php if($web_only_exclusive == '1') { ?><a href="<?php echo $WebSiteDesignerCrossLink2; ?>" title="<?php echo $WebSiteDesignerCrossDesc2; ?>" target="_blank" style="color:<?php echo $TmpFooterFontColor; ?>"><?php echo $WebSiteDesignerCrossName2; ?></a> <i class="fa fa-times"></i> <a href="<?php echo $WebSiteDesignerCrossLink1; ?>" title="<?php echo $WebSiteDesignerCrossDesc1; ?>" target="_blank" style="color:<?php echo $TmpFooterFontColor; ?>"><?php echo $WebSiteDesignerCrossName1; ?></a><?php } else { ?><a href="<?php echo $WebSiteDesignerCrossLink1; ?>" title="<?php echo $WebSiteDesignerCrossDesc1; ?>" target="_blank" style="color:<?php echo $TmpFooterFontColor; ?>"><?php echo $WebSiteDesignerCrossName1; ?></a><?php } ?><!--網頁設計維護--> <?php if ($PrivacyContext != "") { ?><a href="<?php echo $SiteBaseUrl . url_rewrite('privacy',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>" style="color:<?php echo $TmpFooterFontColor; ?>" title=""><?php echo $Lang_Title_Privacy; //隱私權政策 ?></a><?php } ?></span> 
 </div>
<?php if ($SiteCopyLock == '1') { ?>
<script type="text/javascript">
$(document).bind("contextmenu",function(){return!1});$(document).bind("selectstart",function(){return!1});$(document).keydown(function(a){return key(a)});function key(a){var b;window.event?b=a.keyCode:a.which&&(b=a.which);if(17==b)return!1};</script>
<?php } ?>
<?php
mysqli_free_result($RecordSiteMapMenuList);
?>