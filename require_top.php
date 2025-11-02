<?php require_once('Connections/DB_Conn.php'); ?>
<?php 
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
?>
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

$colname_RecordUserAccount = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_RecordUserAccount = $_SESSION['MM_Username'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordUserAccount = sprintf("SELECT * FROM demo_admin WHERE account = %s", GetSQLValueString($colname_RecordUserAccount, "text"));
$RecordUserAccount = mysqli_query($DB_Conn, $query_RecordUserAccount) or die(mysqli_error($DB_Conn));
$row_RecordUserAccount = mysqli_fetch_assoc($RecordUserAccount);
$totalRows_RecordUserAccount = mysqli_num_rows($RecordUserAccount);
?>
<?php if($_SERVER['HTTP_HOST'] == 'www.shop3500.com') { ?>
<div class="top_line" style="float:left;">&nbsp;</div>
<div style="float:left;"><a href="http://www.shop3500.com"><img src="<?php echo $SiteBaseUrl ?>images/home/shop3500.png" width="37" height="20" style="border:none;"/></a></div>
<?php } ?>
<div class="top_line" style="float:left;">&nbsp;</div>
<div style="float:left;">
<?php if ($SiteFBShowImage != '') { ?><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/<?php echo $SiteFBShowImage; ?>"/><?php } else { ?><img src="<?php echo $SiteBaseUrl ?>images/no_face.jpg" width="20"/><?php } ?>
</div>
<div class="top_line" style="float:left;">&nbsp;</div>
<div class="top_content" style="float:left;"><a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>"><?php echo $WshopTopName; ?></a></div>
<div class="top_line" style="float:left;">&nbsp;</div>
<?php if ($LangChooseZHTW == '1' || $LangChooseZHCN == '1' || $LangChooseEN == '1' || $LangChooseJP == '1') { // Show if recordset not empty ?> 
  <div class="top_line" style="float:right;">&nbsp;</div>
  <div style="float:right;"><?php require("inc/inc_frontlangselect_shop3500.php"); ?></div>
  <div class="top_line" style="float:right;">&nbsp;</div>
  <?php }  ?>
<?php if ($totalRows_RecordUserAccount > 0) { // Show if recordset not empty ?> 
  
  <div style="float:right;"><a href="<?php echo $SiteBaseUrl ?>admin/index.php"><img src="<?php echo $SiteBaseUrl ?>images/st.png" width="20" height="20" /></a></div>
  
  <div class="top_line" style="float:right;">&nbsp;</div>
  <div style="float:right;">
  <?php if ($row_RecordUserAccount['pic'] != '') { ?><img src="<?php echo $SiteImgUrl; ?><?php echo $row_RecordUserAccount['webname']; ?>/image/<?php echo $row_RecordUserAccount['pic']; ?>" width="20"/><?php } else { ?><img src="<?php echo $SiteBaseUrl ?>images/no_face.jpg" width="20"/><?php } ?>&nbsp;Hi,<?php echo $row_RecordUserAccount['account']; ?></div>
  <div class="top_line" style="float:right;">&nbsp;</div>
  <!--<div class="top_content" style="float:left;"><?php //require("counter/require_countshow.php"); ?></div>-->
  <?php } // Show if recordset not empty ?>
  <?php if($OptionCartSelect == '1') { ?>
  <div style="float:right;"><a href="<?php echo $SiteBaseUrl . url_rewrite('cart',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'showpage'),'',$UrlWriteEnable);?>" class="shopping-cart" onclick="startIntro_Cart();"><img src="<?php echo $SiteBaseUrl ?>images/ctn.png" width="20" height="20" /></a></div>
  <div class="top_line" style="float:right;">&nbsp;</div>
  <?php } ?>
  <div style="float:right;" id="Step_End"><a href="javascript:void(0);" onclick="startIntro_All();" id="startButton"><img src="<?php echo $SiteBaseUrl ?>images/btn.png" width="20" height="20" /></a></div>
  <div class="top_line" style="float:right;">&nbsp;</div>
  
<?php
mysqli_free_result($RecordUserAccount);
?>
