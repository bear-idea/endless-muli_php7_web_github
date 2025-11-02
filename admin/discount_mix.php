<?php require_once('../Connections/DB_Conn.php'); ?>
<?php 
header("Content-Type:text/html;charset=utf-8"); // 指定页面编码方式 IE BUG 
?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once("inc_setting.php"); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "superadmin,admin";
$MM_donotCheckaccess = "false"; 

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it 
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($pageNum_Recordset1,$totalPages_Recordset1,$prev_Recordset1,$next_Recordset1,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordProduct,$totalRows_RecordProduct;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($pageNum_Recordset1<=$totalPages_Recordset1 && $pageNum_Recordset1>=0)
	{
		if ($pageNum_Recordset1 > ceil($max_links/2))
		{
			$fgp = $pageNum_Recordset1 - ceil($max_links/2) > 0 ? $pageNum_Recordset1 - ceil($max_links/2) : 1;
			$egp = $pageNum_Recordset1 + ceil($max_links/2);
			if ($egp >= $totalPages_Recordset1)
			{
				$egp = $totalPages_Recordset1+1;
				$fgp = $totalPages_Recordset1 - ($max_links-1) > 0 ? $totalPages_Recordset1  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_Recordset1 >= $max_links ? $max_links : $totalPages_Recordset1+1;
		}
		if($totalPages_Recordset1 >= 1) {
			#	------------------------
			#	Searching for $_GET vars
			#	------------------------
			$_get_vars = '';			
			if(!empty($_GET) || !empty($HTTP_GET_VARS)){
				$_GET = empty($_GET) ? $HTTP_GET_VARS : $_GET;
				foreach ($_GET as $_get_name => $_get_value) {
					if ($_get_name != "page") {
						if(is_array($_get_value)){
							$_get_vars .= "&$_get_name=" . urlencode(serialize($_get_value));
							}else {
							$_get_vars .= "&$_get_name=" . urlencode("$_get_value");
						}
					}
				}
			}
			$successivo = $pageNum_Recordset1+1;
			$precedente = $pageNum_Recordset1-1;
			$firstArray = ($pageNum_Recordset1 > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_Recordset1</a>" :  "<span>$prev_Recordset1</span>"/*  css */;
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordProduct) + 1;
					$max_l = ($a*$maxRows_RecordProduct >= $totalRows_RecordProduct) ? $totalRows_RecordProduct : ($a*$maxRows_RecordProduct);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageNum_Recordset1)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?page=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "<span>"; /* css */
					$pagesArray .= "$textLink</span>"  . ($theNext < $egp-1 ? $separator : "");
				}
			}  
			$theNext = $pageNum_Recordset1+1;
			$offset_end = $totalPages_Recordset1;
			$lastArray = ($pageNum_Recordset1 < $totalPages_Recordset1) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_Recordset1</a>" : "<span>$next_Record1</span>"; /* css */
		}
	}
	return array($firstArray,$pagesArray,$lastArray);
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form" && count($_POST['TmpBgSelect'])>0)) {
	foreach($_POST['TmpBgSelect'] as $i => $val){	
	  $updateSQL = sprintf("UPDATE demo_product SET discounttype=%s, discountid=%s WHERE id =%s",
						   GetSQLValueString($_POST['type'], "int"),
						   GetSQLValueString($_POST['id'], "int"),
						   GetSQLValueString($val, "int"));
	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
	  
	  // 获取含有此商品id订单
	  $query_RecordCartlist = sprintf("SELECT id,pid FROM demo_cart WHERE pid=%s ORDER BY id DESC",GetSQLValueString($val, "int"));
	  $RecordCartlist = mysqli_query($DB_Conn, $query_RecordCartlist) or die(mysqli_error($DB_Conn));
	  $row_RecordCartlist = mysqli_fetch_assoc($RecordCartlist);
	  $totalRows_RecordCartlist = mysqli_num_rows($RecordCartlist);
	  
	  if($totalRows_RecordCartlist > 0) {
		  do {
			  $updateSQLCart = sprintf("UPDATE demo_cart SET discounttype=%s, discountid=%s WHERE id =%s",
							   GetSQLValueString($_POST['type'], "int"),
							   GetSQLValueString($_POST['id'], "int"),
							   GetSQLValueString($row_RecordCartlist['id'], "int"));
		
			  //mysqli_select_db($database_DB_Conn, $DB_Conn);
			  $Result1 = mysqli_query($DB_Conn, $updateSQLCart) or die(mysqli_error($DB_Conn));
		  } while ($row_RecordCartlist = mysqli_fetch_assoc($RecordCartlist));
	  }
	}
}

$maxRows_RecordProduct = 50;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordProduct = $page * $maxRows_RecordProduct;

$colname_RecordProduct = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordProduct = $_GET['searchkey'];
}
$coluserid_RecordProduct = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProduct = $w_userid;
}
$colnamelang_RecordProduct = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordProduct = $_GET['lang'];
}
$colnamediscounttype_RecordProduct = "%";
if (isset($_GET['discounttype'])) {
  $colnamediscounttype_RecordProduct = $_GET['discounttype'];
}
$coltype_RecordProduct = "%";
if (isset($_GET['type1'])) {
  $coltype_RecordProduct = $_GET['type1'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProduct = sprintf("SELECT * FROM demo_product WHERE ((name LIKE %s) || (pdseries LIKE %s)) && (discounttype LIKE %s || discounttype IS NULL) && type1 LIKE %s && lang = %s && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordProduct . "%", "text"),GetSQLValueString("%" . $colname_RecordProduct . "%", "text"),GetSQLValueString("%" . $colnamediscounttype_RecordProduct . "%", "text"),GetSQLValueString("%" . $coltype_RecordProduct . "%", "text"),GetSQLValueString($colnamelang_RecordProduct, "text"),GetSQLValueString($coluserid_RecordProduct, "int"));
$RecordProduct = mysqli_query($DB_Conn, $query_RecordProduct) or die(mysqli_error($DB_Conn));
$query_limit_RecordProduct = sprintf("%s LIMIT %d, %d", $query_RecordProduct, $startRow_RecordProduct, $maxRows_RecordProduct);
$RecordProduct = mysqli_query($DB_Conn, $query_limit_RecordProduct) or die(mysqli_error($DB_Conn));
$row_RecordProduct = mysqli_fetch_assoc($RecordProduct);

if (isset($_GET['totalRows_RecordProduct'])) {
  $totalRows_RecordProduct = $_GET['totalRows_RecordProduct'];
} else {
  $all_RecordProduct = mysqli_query($DB_Conn, $query_RecordProduct);
  $totalRows_RecordProduct = mysqli_num_rows($all_RecordProduct);
}
$totalPages_RecordProduct = ceil($totalRows_RecordProduct/$maxRows_RecordProduct)-1;

$colid_RecordDiscountSelect = "-1";
if (isset($_GET['id'])) {
  $colid_RecordDiscountSelect = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDiscountSelect = sprintf("SELECT * FROM demo_productdiscount WHERE id=%s", GetSQLValueString($colid_RecordDiscountSelect, "int"));
$RecordDiscountSelect = mysqli_query($DB_Conn, $query_RecordDiscountSelect) or die(mysqli_error($DB_Conn));
$row_RecordDiscountSelect = mysqli_fetch_assoc($RecordDiscountSelect);
$totalRows_RecordDiscountSelect = mysqli_num_rows($RecordDiscountSelect);

/* 获取类别资料 */
$colname_RecordProductListType = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordProductListType = $_GET['lang'];
}
$coluserid_RecordProductListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProductListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductListType = sprintf("SELECT * FROM demo_productitem WHERE list_id = 1 && lang=%s && level = 0 && userid=%s ORDER BY sortid ASC", GetSQLValueString($colname_RecordProductListType, "text"),GetSQLValueString($coluserid_RecordProductListType, "int"));
$RecordProductListType = mysqli_query($DB_Conn, $query_RecordProductListType) or die(mysqli_error($DB_Conn));
$row_RecordProductListType = mysqli_fetch_assoc($RecordProductListType);
$totalRows_RecordProductListType = mysqli_num_rows($RecordProductListType);
?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php 
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

if ($_SESSION['lang'] == "") {
	$_SESSION['lang'] = $defaultlang; 
}else {
	$_SESSION['lang'] = $_GET['lang'];
}
?>
<?php //$startTime = getMicroTime(); //页面开头定义：?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta name="keywords" content="" /> 
<meta name="DESCRIPTION" content="" />
<meta name ="author" content="富视网科技网页设计" />    
<meta name="designer" content="富视网科技网页设计" />
<meta name="abstract" content="富视网科技网页设计" />
<meta name="publisher" content="富视网科技网页设计" />
<meta name="copyright" content="富视网科技网页设计" />
<meta name="robots" content="all" />
<meta name="robots" content="index,follow" />
<meta name="revisit-after" content="7 days" />
<meta name="rating" content="general" />
<meta name="distribution" content="global" />
<meta name="content-Language" content="zh-tw" />
<meta http-equiv="expires" content="0" />
<meta name="spiders" content="all" />
<meta name="webcrawlers" content="all" />
<link rel='icon' href='favicon.ico' type='image/x-icon' />
<link rel='bookmark' href='favicon.ico' type='image/x-icon' />
<link rel='shortcut icon' href='favicon.ico' type='image/x-icon' />
<title>后台管理系统</title>
<script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryData.js" type="text/javascript">/*此文件必须在jquery之前执行*/</script>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.abgne-minwt.divalign.js"> // Div自动对齐(齐左齐右齐上齐下) malign:left、right  mvalign:top、bottom div区块中加入</script>
<script language="javascript" src="js/jquery.tipsy.js">/*Tip*/</script>
<link href="css/tipsy.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
 $(function() {
   $('a[rel=tipsy]').tipsy({fade: true, gravity: 'w'});
   $('a[rel=tipsy_n]').tipsy({fade: true, gravity: 's'});
   $('a[rel=tipsy_l]').tipsy({fade: true, gravity: 'ne'});
   $('a[rel=tipsy_html]').tipsy({fade: true, gravity: 's', html: true});
 });
</script>
<link rel="stylesheet" type="text/css" href="css/jQuery-Tags-Input/jquery.tagsinput.css" />
<script type="text/javascript" src="js/jQuery-Tags-Input/jquery.tagsinput.min.js"></script>
<script type="text/javascript">
	
	$(function() {

		$('#SiteKeyWord,#skeyword').tagsInput({
			width:'auto',
			defaultText:'加入关键字'
		});
// Uncomment this line to see the callback functions in action
//			$('input.tags').tagsInput({onAddTag:onAddTag,onRemoveTag:onRemoveTag,onChange: onChangeTag});		

// Uncomment this line to see an input with no interface for adding new tags.
//			$('input.tags').tagsInput({interactive:false});
	});

</script>
<link rel="stylesheet" href="css/colorbox/colorbox.css" />
<script type="text/javascript" language="javascript" src="js/colorbox/jquery.colorbox-min.js"></script>
<script>
		$(document).ready(function(){
			$(".colorbox_iframe_xs").colorbox({iframe:true, width:"90%", height:"90%"});
		});
</script>
<script type="text/javascript" src="../js/selectboxes.js">/*连动选单*/</script>
<script language="javascript" src="../js/jquery.jeditable.js">/*原地编辑*/</script>
<script type='text/javascript' src='js/vertical-accordion-menu/jquery.cookie.js'></script>
<script type='text/javascript' src='js/vertical-accordion-menu/jquery.hoverIntent.minified.js'></script>
<script type='text/javascript' src='js/vertical-accordion-menu/jquery.dcjqaccordion.2.7.min.js'></script> 
<link href="css/vertical-accordion-menu/skins/grey.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
$(document).ready(function($){
	$('#accordion-2').dcAccordion({
		eventType: 'click', // click/hover
		autoClose: false,
		saveState: true,
		disableLink: true,
		speed: 'fast',
		classActive: 'active',
		showCount: false // 选单个数
	});
});
</script>
<!-- jquery-vertical-accordion-menu END-->
<script type="text/javascript">
$(document).ready(function() { /* jeditable 日历 */
	$.editable.addInputType('datepicker', { 
    element : function(settings, original) { 
        var input = $('<input>'); 
        if (settings.width  != 'none') { input.width(settings.width);  } 
    if (settings.height != 'none') { input.height(settings.height); } 
        input.attr('autocomplete','off'); 
    $(this).append(input); 
    return(input); 
    }, 
    plugin : function(settings, original) { 
        /* Workaround for missing parentNode in IE */ 
    var form = this; 
    settings.onblur = 'ignore'; 
    $(this).find('input').datepicker().bind('click', function() { 
    $(this).datepicker('show'); 
            return false; 
        }).bind('dateSelected', function(e, selectedDate, $td) { 
            $(form).submit(); 
        }); 
    } 
}); 
})
</script> 
<script type="text/javascript" src="../js/jquery.corners.min.js"></script>
<script type="text/javascript" src="../js/iframe.js"></script>
<script type="text/javascript" src="../js/fontsizer.jquery.js"></script>
<script src="../js/jquery.d.checkbox.min.js"></script> 
<script>
$(document).ready(function(){
		$(':checkbox').d_checkbox();
		$(':radio').d_radio();
});
</script>
<script>
$(document).ready( function(){
  $('.rounded').corners();
});</script>
<!-- [ Sort Table ] -->
<script language="javascript" src="../js/jquery.tablesorter.js"></script>
<script>
$(document).ready(function(){         
  $("#TBSort").tablesorter({widgets: ['zebra']});
}); 
</script>
<!-- [ Sort Table End ] -->
<!-- [ reflection ] -->
<script type="text/javascript" src="../js/reflection.js"></script> 
<script type="text/javascript">
$(document).ready(function() {
	$("#ref_thumb img").reflect();
})
</script>
<script type="text/javascript">
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
</script>
<!-- [ reflection End ] -->
<!--[if IE 6]>
<script type="text/javascript" src="js/iepngfix_tilebg.js"></script> 
<![endif]-->
<link href="css/incstyle.css" rel="stylesheet" type="text/css" />
<link href="css/styleless.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="../css/jquery.d.checkbox.css"></link>
<link rel="stylesheet" href="../css/fontsizer.css" type="text/css" />
<link type="text/css" href="../css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<style>
.tbutt{
	float:left;
	padding:5px;
	background-color:#666666;
	color:#FFFFFF;
	margin-right:5px;
	margin-left: 0px;
	margin-top: 0px;
	margin-bottom: 10px;
}
/* 外框 */
div .photoFram_Block_glossy, .div_table-cell{
	overflow:hidden;
	height: 100px; /* 设置区块高度 */
	width: 100px;
	margin: 5px;
}

/* 图片hide外框 */
.div_table-cell{
	text-align: center;
	vertical-align: middle;
	/*background-color: #F9F9F9;*/
	border: 1px solid #DDD;	/*display:table-cell; /* 将此Div区块当成表格 FF有BUG*/
}


/* IE6 hack */
.div_table-cell span{
	height:100%;
	display:inline-block;
	background-image: none;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	}

/* 让table-cell下的所有元素都居中 */
.div_table-cell *{ vertical-align:middle;}

.InnerPage{display:none;}
.bg_board:hover{
	background-color: #E95516;
}
.bg_active{
	background-color: #B37583;
}
.TmpBgSelectIcon{
	position: absolute;
	z-index: 1;
	height: 65px;
	width: 93px;
	background-image: url(images/select.png);
	background-repeat: no-repeat;
}
.button_a{display:inline-block; border-width:1px 0; border-color:#BBBBBB; border-style:solid; vertical-align:middle;text-decoration:none; color:#333333;}
.button_b{float:left; background:#e3e3e3; border-width:0 1px; border-color:#BBBBBB; border-style:solid; margin:0 -1px; position:relative;}
.button_c{display:block; line-height:0.6em; background:#f9f9f9; border-bottom:2px solid #eeeeee;}
.button_d{display:block; padding:0.1em 0.6em; margin-top:-0.6em; cursor:pointer;}
.button_a:hover{border-color:#999999;text-decoration:none;}
.button_a:hover .button_b{border-color:#999999;text-decoration:none;}
</style>
<style type="text/css">
.div_table-cell1 {	overflow:hidden;
	height: 100px; /* 设置区块高度 */
	width: 100px;
	margin: 5px;
}
.div_table-cell1 {	text-align: center;
	vertical-align: middle;
	/*background-color: #F9F9F9;*/
	border: 1px solid #DDD;	/*display:table-cell; /* 将此Div区块当成表格 FF有BUG*/
}
</style>
<script type="text/javascript">
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
<script type="text/javascript">
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
</script>
<script type="text/javascript">
function flevToggleCheckboxes() { // v1.1
	// Copyright 2002, Marja Ribbers-de Vroed, FlevOOware (www.flevooware.nl/dreamweaver/)
	var sF = arguments[0], bT = arguments[1], bC = arguments[2], oF = MM_findObj(sF);
    for (var i=0; i<oF.length; i++) {
		if (oF[i].type == "checkbox") {if (bT) {oF[i].checked = !oF[i].checked;} else {oF[i].checked = bC;}}} 
}
</script>
</head>
<body>
<?php
	//initialize the session
	if (!isset($_SESSION)) {
	  session_start();
	}
	
	switch($_GET['lang'])
	{
		case "zh-tw":
			$_SESSION['lang'] = $_GET['lang'];
			$langname = "繁体";
			break;
		case "zh-cn":
			$_SESSION['lang'] = $_GET['lang'];
			$langname = "简体";
			break;
		case "en":
			$_SESSION['lang'] = $_GET['lang'];
			$langname = "英文";
			break;	
		case "jp":
			$_SESSION['lang'] = $_GET['lang'];
			$langname = "日文";
			break;	
		default:
			$_SESSION['lang'] = $defaultlang;
			$langname = "繁体";
	}
 ?> 
<div style="padding:10px; margin:10px;">
  <div style="background-color:#FFFFFF; padding:5px; border: 1px solid #CCC; min-height:500px;">
   
   <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h4><strong><font color="#756b5b"><?php echo $ModuleName['Product']; ?></font><font color="#756b5b">选择 [<?php echo $langname; ?>编辑介面]</font></strong></h4></td>
            <td width="155" align="right">
              <span class = "InnerPage" style=" display:block"><a href="discount_cancel.php?id=<?php echo $_GET['id']; ?>&amp;lang=<?php echo $_SESSION['lang'] ?>" title="取消当前选择的指定商品" class="colorbox_iframe_cd" rel="tipsy_l"><strong> <i class="fa fa-reply-all"></i> 前往取消选择商品</strong></a></span>
            </td>
        </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
          <tr>
          	<td width="50%"> 显示 <?php echo ($startRow_RecordProduct + 1) ?> - <?php echo min($startRow_RecordProduct + $maxRows_RecordProduct, $totalRows_RecordProduct) ?> 笔 共计 <?php echo $totalRows_RecordProduct ?> 笔</td>
            <td width="50%" align="right">
            
            <?php //if ($ManageTmpSearchSelect == "1") { ?>
            <form id="form_TmpBackGround" name="form_TmpBackGround" method="get" action="<?php echo $editFormAction; ?>">
              
              <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
              <input name="id" type="hidden" id="id" value="<?php echo $_GET['id']; ?>" />
              
                <select name="type1" id="type1">
                <option value="">-- 选择分类 --</option>
                <?php
					do {  
					?>
									<option value="<?php echo $row_RecordProductListType['item_id']?>"><?php echo $row_RecordProductListType['itemname']?></option>
					<?php
					} while ($row_RecordProductListType = mysqli_fetch_assoc($RecordProductListType));
					  $rows = mysqli_num_rows($RecordProductListType);
					  if($rows > 0) {
						  mysqli_data_seek($RecordProductListType, 0);
						  $row_RecordProductListType = mysqli_fetch_assoc($RecordProductListType);
					  }
				 ?>
              </select>
              
                <label for="discounttype"></label>
                <select name="discounttype" id="discounttype">
                  <option value="%">-- 选择折扣类别 --</option>
                  <option value="0">指定商品 - 满件折扣(%)</option>
                  <option value="1">指定商品 - 满件减价(-)</option>
                  <option value="2">指定商品 - 满额折扣(%)</option>
                  <option value="3">指定商品 - 满额减价(-)</option>
                  <option value="4">指定商品 - 任选优惠</option>
                </select>
                <img src="../images/Search.png" width="20" height="20" align="absmiddle" />
                <input type="text" name="searchkey" id="searchkey" />
                <input type="submit" name="button" id="button" value="搜索" />
              
            </form>
            
            <?php //} ?>
            
            
            
            <div class="PageSelectBoard">
            <?php 
			# variable declaration
			$prev_RecordProduct = "<i class=\"fa fa-angle-left\"></i>";
			$next_RecordProduct = "<i class=\"fa fa-angle-right\"></i>";
			$separator = "&nbsp;";
			$max_links = 15;
			$pages_navigation_RecordProduct = buildNavigation($page,$totalPages_RecordProduct,$prev_RecordProduct,$next_RecordProduct,$separator,$max_links,true); 
			
			print $pages_navigation_RecordProduct[0]; 
			?>
            <?php print $pages_navigation_RecordProduct[1]; ?> 
			<?php print $pages_navigation_RecordProduct[2]; ?></div>     
            
            </td>
          </tr>
          <tr>
            <td colspan="2"><hr></td>
          </tr>
    </table>
    
    <div style="padding:10px; background-color:#F7EFEB; margin-bottom:10px; border:1px #ECDBD3 solid; color:#B37C67; font-weight:bolder;">
    <i class="fa fa-exclamation-circle"></i> 当前折扣方式 <?php 
		  
		  switch($row_RecordDiscountSelect['type'])
			{
				case "0":
				    echo "指定商品 - 满件折扣(%)";
					break;
				case "1":
				    echo "指定商品 - 满件减价(-)";
					break;
				case "2":
				    echo "指定商品 - 满额折扣(%)";
					break;
				case "3":
				    echo "指定商品 - 满额减价(-)";
					break;
				case "4":
				    echo "指定商品 - 任选优惠";
					break;
				case "5":
				    echo "全单满额 - 满额折扣(%)";
					break;
				case "6":
				    echo "全单满额 - 满额减价(-)";
					break;
				case "7":
				    echo "全单满额 - 满额赠礼";
					break;
				case "8":
					break;
				default:
					break;
			} 	
			echo " " . $row_RecordDiscountSelect['name'];

?></span>
    </div>
    
    <div style="padding:10px; background-color:#F7EFEB; margin-bottom:10px; border:1px #ECDBD3 solid; color:#B37C67; font-weight:bolder;">
    <i class="fa fa-exclamation-circle"></i> 指定商品折扣仅会套用一种，后来套用的折扣会取代为新折扣方式。</span>
    </div>
    
    <div style="padding:10px; background-color:#F7EFEB; margin-bottom:10px; border:1px #ECDBD3 solid; color:#B37C67; font-weight:bolder;">
    <i class="fa fa-exclamation-circle"></i> 未设置原价之商品并不会套用任何折扣。</span>
    </div>
    
    <?php if ($totalRows_RecordProduct > 0) { ?>
    
	<form name="form" action="<?php echo $editFormAction; ?>" method="POST"> 
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter" id="TBSort">
      <thead>
    <tr>
      <th width="20" align="left">&nbsp;</th>
      <th align="left"><strong><?php echo $ModuleName['Product']; ?>选择</strong></th>
      <th align="left">&nbsp;</th>
      <th width="100" align="left">原价</th>
      <th width="300" align="left">当前该商品已套用折扣方式</th>
      </tr>
    </thead>
    <tbody>
    
      
       <?php do { ?>
       <tr class="<?php if($row_RecordProduct['discountid'] == $_GET['id']){echo "bg_active";} ?>">    
        <td>
        <input name="TmpBgSelect[]" type="checkbox" id="TmpBgSelect" value="<?php echo $row_RecordProduct['id']; ?>" />
        </td>
        <td width="105">
        <div class="TmpBgSelectIcon" style="display:<?php if($row_RecordProduct['discountid'] != $_GET['id']){echo "none";} ?>;"></div>
        <?php if ($row_RecordProduct['pic'] != "") { ?>
        <div class="div_table-cell"> 
            <a href="<?php echo $SiteImgUrlAdmin; ?><?php echo $wshop; ?>/image/product/<?php echo GetFileThumbExtend($row_RecordProduct['pic']); ?>" rel="clearbox[gallery=<?php echo $row_RecordProduct['id']; ?> title=<?php echo htmlentities($row_RecordProduct['sdescription']); ?>]"><img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $wshop; ?>/image/product/thumb/small_<?php echo GetFileThumbExtend($row_RecordProduct['pic']); ?>" alt="<?php echo $row_RecordProduct['sdescription']; ?>" alumb="true" _w="100" _h="100"/><span></span></a>
        </div>
        <?php } else { ?>
        <div class="div_table-cell">
          <img src="images/100x80_noimage.jpg" width="100" height="80" alumb="true" _w="100" _h="100"/><span></span>
        </div>
        <?php } ?>
        </td>
        <td class="hidebuttom" id="Step_Edit"><?php 
		    /* 显示货号 */
		  	if($row_RecordProduct['pdseries'] != "") {
		?>
          <span class="TipTypeStyle">[ <span class="ed_pdseries" id="pdseries_<?php echo $row_RecordProduct['id']; ?>"><?php echo highLight($row_RecordProduct['pdseries'], $_GET['searchkey'], $HighlightSelect);?></span> ]</span>
          <?php 
			}
		?>
          <span class="ed_name" id="name_<?php echo $row_RecordProduct['id']; ?>"><?php echo highLight($row_RecordProduct['name'], $_GET['searchkey'], $HighlightSelect); ?></span>
          &nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="hidebuttom" id="Step_Edit"><?php if ($row_RecordProduct['price'] == "") {echo "<span style=\"color:red\">未设置原价无法套用折扣</span>" . "<br>";} ?><span class="ed_price" id="price_<?php echo $row_RecordProduct['id']; ?>"><?php echo $row_RecordProduct['price']; ?></span></td>
        <td class="hidebuttom" id="Step_Edit"><?php require("require_manage_cart_discount_show.php"); ?></td>
        </tr>
     <?php } while ($row_RecordProduct = mysqli_fetch_assoc($RecordProduct)); ?>
     
     
      </tbody>
    
       <tfoot>
        <tr>
        <td colspan="5"><input type="submit" name="button" id="button" value="提交选择" />
          <input name="id" type="hidden" id="id" value="<?php echo $row_RecordDiscountSelect['id']; ?>" />
          <input name="type" type="hidden" id="type" value="<?php echo $row_RecordDiscountSelect['type']; ?>" />
          <span style="float:right"><input name="button3" type="button" id="button3" onClick="flevToggleCheckboxes('form',false,true);javascript:$(':checkbox').d_checkbox('check');" value="全选" />
            <input name="button5" type="button" id="button5" onClick="flevToggleCheckboxes('form',true,false);javascript:$(':checkbox').d_checkbox('click');" value="反选" />          <input name="button4" type="button" id="button4" onClick="flevToggleCheckboxes('form',false,false);javascript:$(':checkbox').d_checkbox('uncheck');" value="重置" /></span>
          </td>
          </tr>
      </tfoot>

</table>
	<input type="hidden" name="MM_update" value="form" />
   </form>
    <?php } ?>
    
    <?php if ($totalRows_RecordProduct == 0) { // Show if recordset empty ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01_hover">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><font color="#FF0000">当前尚无资料！！</font></td>
        </tr>
      </table>
      <?php } // Show if recordset empty ?>
    
  </div>
</div>
<script type="text/javascript">
/* 图片(不)完全按比例自动缩图 */
jQuery(document).ready(function(){$(window).load(function(){$(".div_table-cell img").each(function(){if("true"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");var c=$(this).width(),d=$(this).height(),a=$(this).attr("_w")/c,b=$(this).attr("_h")/d,e=1,e=a>b?b:a;$(this).width(c*e);$(this).height(d*e)}else if("false"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");$(this).width();$(this).height();c=$(this).attr("_w");d=$(this).attr("_h");
a=$(this).width();b=$(this).height();if(a>c){var e=a,f=b,b=b*(c/a),a=c;b<d&&(a=e*(d/f),b=d)}$(this).attr({width:a,height:b})}})})});
</script>
<script type="text/javascript">
$(document).ready(function() {
	$(".ed_name").editable("sqledit/product_jedit.php", 		{
		//cancel: '取消',
		submit: '修改',
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠点此可编辑此区块...',
		//event:"dblclick",
		select:true,
		width: "500px"
	});
	
	$(".ed_price").editable("sqledit/product_jedit.php", 		{
		//cancel: '取消',
		submit: '修改',
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠点此可编辑此区块...',
		//event:"dblclick",
		select:true,
		width: "100px"
	});
});
</script>
</body>
</html>
<?php
mysqli_free_result($RecordProduct);

mysqli_free_result($RecordDiscountSelect);

mysqli_free_result($RecordProductListType);
?>