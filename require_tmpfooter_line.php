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

$collang_RecordTmpFooter = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordTmpFooter = $_GET['lang'];
}
$coluserid_RecordTmpFooter = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTmpFooter = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpFooter = sprintf("SELECT * FROM demo_template WHERE identifier = 'Tmp_Footer' && lang=%s && userid=%s", GetSQLValueString($collang_RecordTmpFooter, "text"),GetSQLValueString($coluserid_RecordTmpFooter, "int"));
$RecordTmpFooter = mysqli_query($DB_Conn, $query_RecordTmpFooter) or die(mysqli_error($DB_Conn));
$row_RecordTmpFooter = mysqli_fetch_assoc($RecordTmpFooter);
$totalRows_RecordTmpFooter = mysqli_num_rows($RecordTmpFooter);
?>
<?php $TmpFooterFontColor = $row_RecordTmpConfig['homefullscreenfooterwordcolor']; ?>
<div style="font-size:small; vertical-align: middle; text-align:center; color:<?php echo $TmpFooterFontColor; ?>;">
<div style="height:10px;"></div>
<?php //echo $row_RecordTmpFooter['content']; ?>
<?php if ($LangChooseZHTW == '1') { ?><i class="fa fa-home"></i> <a href="index.php?wshop=<?php echo $_GET['wshop'] ?>&lang=zh-tw" style="color:<?php echo $TmpFooterFontColor; ?>">繁體</a><?php } ?> <?php if ($LangChooseEN == '1') { ?><i class="fa fa-home"></i> <a href="index.php?wshop=<?php echo $_GET['wshop'] ?>&lang=en" style="color:<?php echo $TmpFooterFontColor; ?>">English</a><?php } ?> <?php if ($LangChooseZHCN == '1') { ?><?php echo $SiteAddr; ?><i class="fa fa-home"></i> <a href="index.php?wshop=<?php echo $_GET['wshop'] ?>&lang=zh-cn" style="color:<?php echo $TmpFooterFontColor; ?>">简体</a><?php } ?> <?php if ($LangChooseJP == '1') { ?><i class="fa fa-home"></i> <a href="index.php?wshop=<?php echo $_GET['wshop'] ?>&lang=jp" style="color:<?php echo $TmpFooterFontColor; ?>">日文</a><?php } ?> <?php if ($LangChooseKR == '1') { ?><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>'kr'),'',$UrlWriteEnable);?>" style="color:<?php echo $TmpFooterFontColor; ?>">韓文</a><?php } ?> <?php if ($LangChooseSP == '1') { ?><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>'sp'),'',$UrlWriteEnable);?>" style="color:<?php echo $TmpFooterFontColor; ?>">西班牙語</a><?php } ?>
  <span data-scroll-reveal='enter bottom'><?php if ($SitePhone != '') { ?><i class="fa fa-phone"></i> <?php echo $Lang_Footer_Tel; ?>：<?php echo $SitePhone; ?><?php } ?> <?php if ($SiteFax != '') { ?><i class="fa fa-print"></i> <?php echo $Lang_Footer_Fax; ?>：<?php echo $SiteFax; ?><?php } ?> <?php if ($SiteMail != '') { ?><i class="fa fa-envelope-o"></i> <?php echo "Mail"; ?>：<a href="mailto:<?php echo $SiteMail; ?>" style="color:<?php echo $TmpFooterFontColor; ?>"><?php echo $SiteMail; ?></a><?php } ?> <?php if ($SiteCell != '') { ?><i class="fa fa-tablet"></i> <?php echo $Lang_Footer_Cell; ?>：<?php echo $SiteCell; ?><?php } ?></span>
  <span data-scroll-reveal='enter bottom over 1s'><?php if ($SiteAddr != '') { ?><i class="fa fa-map-marker"></i> <?php echo $Lang_Footer_Addr; ?>：<?php echo $SiteAddr; ?><?php } ?></span>
  <span data-scroll-reveal='enter bottom after 0.1s'><?php echo $SiteSName; ?> Copyright © <?php echo autoUpdatingCopyright(2009); ?> Design by <a href="<?php echo $WebSiteDesignerCrossLink2; ?>" title="<?php echo $WebSiteDesignerCrossDesc2; ?>" target="_blank" style="color:<?php echo $TmpFooterFontColor; ?>"><?php echo $WebSiteDesignerCrossName2; ?></a> <i class="fa fa-times"></i> <a href="<?php echo $WebSiteDesignerCrossLink1; ?>" title="<?php echo $WebSiteDesignerCrossDesc1; ?>" target="_blank" style="color:<?php echo $TmpFooterFontColor; ?>"><?php echo $WebSiteDesignerCrossName1; ?></a><!--網頁設計維護--></span>
 </div>
<?php if ($SiteCopyLock == '1') { ?>
<script type="text/javascript">
$(document).bind("contextmenu",function(){return!1});$(document).bind("selectstart",function(){return!1});$(document).keydown(function(a){return key(a)});function key(a){var b;window.event?b=a.keyCode:a.which&&(b=a.which);if(17==b)return!1};</script>
<?php } ?>
<?php
mysqli_free_result($RecordTmpFooter);
?>
