<?php require_once('../Connections/DB_Conn.php'); ?>
<?php 
header("Content-Type:text/html;charset=utf-8"); // 指定頁面編碼方式 IE BUG 
?>
<?php require_once("inc_setting.php"); ?>
<?php require_once("inc_permission.php"); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php //$startTime = getMicroTime(); //页面开头定义：?>
<?php require_once("inc_lang.php"); // 取得目前語系?>
<?php require_once("inc_mdname.php"); // 取得模組名稱?>
<?php require_once('upload_get_admin.php'); ?>
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
    GLOBAL $maxRows_RecordTmpLogo,$totalRows_RecordTmpLogo;
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
					if ($_get_name != "pageNum_RecordTmpLogo") {
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
			$firstArray = ($pageNum_Recordset1 > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordTmpLogo=$precedente$_get_vars\">$prev_Recordset1</a>" :  "<span>$prev_Recordset1</span>"/*  css */;
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordTmpLogo) + 1;
					$max_l = ($a*$maxRows_RecordTmpLogo >= $totalRows_RecordTmpLogo) ? $totalRows_RecordTmpLogo : ($a*$maxRows_RecordTmpLogo);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageNum_Recordset1)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordTmpLogo=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "<span>"; /* css */
					$pagesArray .= "$textLink</span>"  . ($theNext < $egp-1 ? $separator : "");
				}
			}  
			$theNext = $pageNum_Recordset1+1;
			$offset_end = $totalPages_Recordset1;
			$lastArray = ($pageNum_Recordset1 < $totalPages_Recordset1) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordTmpLogo=$successivo$_get_vars\">$next_Recordset1</a>" : "<span>$next_Record1</span>"; /* css */
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form")) {
  $updateSQL = sprintf("UPDATE demo_setting_fr SET Mobile_Logo=%s WHERE userid=%s",
                       GetSQLValueString($_POST['TmpBgSelect'], "text"),
                       GetSQLValueString($w_userid, "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

$maxRows_RecordTmpLogo = 50;
$pageNum_RecordTmpLogo = 0;
if (isset($_GET['pageNum_RecordTmpLogo'])) {
  $pageNum_RecordTmpLogo = $_GET['pageNum_RecordTmpLogo'];
}
$startRow_RecordTmpLogo = $pageNum_RecordTmpLogo * $maxRows_RecordTmpLogo;

$colname_RecordTmpLogo = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordTmpLogo = $_GET['searchkey'];
}
$coluserid_RecordTmpLogo = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpLogo = $w_userid;
}
$coltype_RecordTmpLogo = "%";
if (isset($_GET['type'])) {
  $coltype_RecordTmpLogo = $_GET['type'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpLogo = sprintf("SELECT * FROM demo_tmplogo WHERE ((name LIKE %s)) && (type LIKE %s) && (userid=%s || userid=1) ORDER BY type DESC, id DESC", GetSQLValueString("%" . $colname_RecordTmpLogo . "%", "text"),GetSQLValueString("%" . $coltype_RecordTmpLogo . "%", "text"),GetSQLValueString($coluserid_RecordTmpLogo, "int"));
$query_limit_RecordTmpLogo = sprintf("%s LIMIT %d, %d", $query_RecordTmpLogo, $startRow_RecordTmpLogo, $maxRows_RecordTmpLogo);
$RecordTmpLogo = mysqli_query($DB_Conn, $query_limit_RecordTmpLogo) or die(mysqli_error($DB_Conn));
$row_RecordTmpLogo = mysqli_fetch_assoc($RecordTmpLogo);

if (isset($_GET['totalRows_RecordTmpLogo'])) {
  $totalRows_RecordTmpLogo = $_GET['totalRows_RecordTmpLogo'];
} else {
  $all_RecordTmpLogo = mysqli_query($DB_Conn, $query_RecordTmpLogo);
  $totalRows_RecordTmpLogo = mysqli_num_rows($all_RecordTmpLogo);
}
$totalPages_RecordTmpLogo = ceil($totalRows_RecordTmpLogo/$maxRows_RecordTmpLogo)-1;

$colid_RecordTmpLogoSelect = "-1";
if (isset($_GET['id_edit'])) {
  $colid_RecordTmpLogoSelect = $_GET['id_edit'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpLogoSelect = "SELECT Mobile_Logo FROM demo_setting_fr WHERE userid = $w_userid";
$RecordTmpLogoSelect = mysqli_query($DB_Conn, $query_RecordTmpLogoSelect) or die(mysqli_error($DB_Conn));
$row_RecordTmpLogoSelect = mysqli_fetch_assoc($RecordTmpLogoSelect);
$totalRows_RecordTmpLogoSelect = mysqli_num_rows($RecordTmpLogoSelect);

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpLogoListType = "SELECT * FROM demo_tmpitem WHERE list_id = 6";
$RecordTmpLogoListType = mysqli_query($DB_Conn, $query_RecordTmpLogoListType) or die(mysqli_error($DB_Conn));
$row_RecordTmpLogoListType = mysqli_fetch_assoc($RecordTmpLogoListType);
$totalRows_RecordTmpLogoListType = mysqli_num_rows($RecordTmpLogoListType);

$colname_RecordTmpBoardStyle = "-1";
if (isset($_GET['id'])) {
  $colname_RecordTmpBoardStyle = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpBoardStyle = sprintf("SELECT id, name FROM demo_tmp WHERE id = %s", GetSQLValueString($colname_RecordTmpBoardStyle, "int"));
$RecordTmpBoardStyle = mysqli_query($DB_Conn, $query_RecordTmpBoardStyle) or die(mysqli_error($DB_Conn));
$row_RecordTmpBoardStyle = mysqli_fetch_assoc($RecordTmpBoardStyle);
$totalRows_RecordTmpBoardStyle = mysqli_num_rows($RecordTmpBoardStyle);
?>


<?php //$startTime = getMicroTime(); //页面开头定义：?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta name="keywords" content="" /> 
<meta name="DESCRIPTION" content="" />
<meta name ="author" content="富視網科技網頁設計" />    
<meta name="designer" content="富視網科技網頁設計" />
<meta name="abstract" content="富視網科技網頁設計" />
<meta name="publisher" content="富視網科技網頁設計" />
<meta name="copyright" content="富視網科技網頁設計" />
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
<title>後台管理系統 - <?php echo $row_RecordAccount['name'];?></title>
<script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryData.js" type="text/javascript">/*此檔案必須在jquery之前執行*/</script>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.abgne-minwt.divalign.js"> // Div自動對齊(齊左齊右齊上齊下) malign:left、right  mvalign:top、bottom div區塊中加入</script>
<link rel="stylesheet" type="text/css" href="css/jQuery-Tags-Input/jquery.tagsinput.css" />
<script type="text/javascript" src="js/jQuery-Tags-Input/jquery.tagsinput.min.js"></script>
<script src="../SpryAssets/SpryValidationCheckbox.js" type="text/javascript"></script>
<script type="text/javascript">
	
	$(function() {

		$('#SiteKeyWord,#skeyword').tagsInput({
			width:'auto',
			defaultText:'加入關鍵字'
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
<script type="text/javascript" src="../js/selectboxes.js">/*連動選單*/</script>
<script language="javascript" src="../js/jquery.jeditable.js">/*原地編輯*/</script>
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
		showCount: false // 選單個數
	});
});
</script>
<!-- jquery-vertical-accordion-menu END-->
<script type="text/javascript">
$(document).ready(function() { /* jeditable 日曆 */
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
	height: 100px; /* 設定區塊高度 */
	width: 100px;
	margin: 5px;
}

/* 圖片hide外框 */
.div_table-cell{
	text-align: center;
	vertical-align: middle;
	/*background-color: #F9F9F9;*/
	border: 1px solid #DDD;	/*display:table-cell; /* 將此Div區塊當成表格 FF有BUG*/
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

/* 讓table-cell下的所有元素都居中 */
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
<link href="../SpryAssets/SpryValidationCheckbox.css" rel="stylesheet" type="text/css" />
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
			$langname = "繁體";
			break;
		case "zh-cn":
			$_SESSION['lang'] = $_GET['lang'];
			$langname = "簡體";
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
			$langname = "繁體";
	}
 ?> 
<div style="padding:10px; margin:10px;">
  <div style="background-color:#FFFFFF; padding:5px; border: 1px solid #CCC; min-height:500px;">
   
   <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">背景</font><font color="#756b5b">選擇 [<?php echo $langname; ?>編輯介面]</font></strong></h5></td>
            <td width="155" align="right">
               <div>
                  <a href="tmp_config_home_logo.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmpLogoSelect['id']; ?>&amp;board=<?php echo $_GET['board']; ?>" class="button_a">
                     <span class="button_b">
                         <span class="button_c"> </span>
                         <span class="button_d">回上一頁</span>
                      </span>
                   </a>
               </div>
            </td>
        </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
          <tr>
          	<td width="50%"> 顯示 <?php echo ($startRow_RecordTmpLogo + 1) ?> - <?php echo min($startRow_RecordTmpLogo + $maxRows_RecordTmpLogo, $totalRows_RecordTmpLogo) ?> 筆 共計 <?php echo $totalRows_RecordTmpLogo ?> 筆</td>
            <td width="50%" align="right">
            
            <?php if ($ManageTmpSearchSelect == "1") { ?>
            <form id="form_TmpLogo" name="form_TmpLogo" method="get" action="<?php echo $editFormAction; ?>">
              <input name="Opt_Tmp" type="hidden" id="Opt_Tmp" value="tmpbk" />
                <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                <input name="id" type="hidden" id="id" value="<?php echo $_GET['id']; ?>" />
              <select name="type" id="type">
                <option value="%" selected="selected">-- 選擇類別 --</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_RecordTmpLogoListType['itemname']?>"><?php echo $row_RecordTmpLogoListType['itemname']?></option>
                  <?php
} while ($row_RecordTmpLogoListType = mysqli_fetch_assoc($RecordTmpLogoListType));
  $rows = mysqli_num_rows($RecordTmpLogoListType);
  if($rows > 0) {
      mysqli_data_seek($RecordTmpLogoListType, 0);
	  $row_RecordTmpLogoListType = mysqli_fetch_assoc($RecordTmpLogoListType);
  }
?>
                </select>
                <img src="../images/Search.png" width="20" height="20" align="absmiddle" />
                <input type="text" name="searchkey" id="searchkey" />
                <input type="submit" name="button" id="button" value="搜索" />
              
            </form>
            
            <?php } ?>
            
            
            
            <div class="PageSelectBoard">
            <?php 
			# variable declaration
			$prev_RecordTmpLogo = "<i class=\"fa fa-angle-left\"></i>";
			$next_RecordTmpLogo = "<i class=\"fa fa-angle-right\"></i>";
			$separator = "&nbsp;";
			$max_links = 15;
			$pages_navigation_RecordTmpLogo = buildNavigation($pageNum_RecordTmpLogo,$totalPages_RecordTmpLogo,$prev_RecordTmpLogo,$next_RecordTmpLogo,$separator,$max_links,true); 
			
			print $pages_navigation_RecordTmpLogo[0]; 
			?>
            <?php print $pages_navigation_RecordTmpLogo[1]; ?> 
			<?php print $pages_navigation_RecordTmpLogo[2]; ?></div>     
            
            </td>
          </tr>
          <tr>
            <td colspan="2"><hr></td>
          </tr>
    </table>
	<form name="form" action="<?php echo $editFormAction; ?>" method="POST"> 
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter" id="TBSort">
      <thead>
    <tr>
      <th align="left"><strong>背景</strong></th>
      </tr>
    </thead>
    <tbody>
    
      <tr>    
       <td>
       <span id="sprycheckbox1">
       <span class="checkboxMinSelectionsMsg">未達到選取數目的最小值。</span><span class="checkboxMaxSelectionsMsg">超出選取數目的最大值。</span><br />
	   <div style="padding:5px; border: 1px dotted #CCC; margin-bottom:2px; width:115px; float:left; margin:5px; text-align:center;" class="<?php if($row_RecordTmpLogoSelect['Mobile_Logo'] == ''){echo "bg_active";} ?> bg_board"><!--無圖片指定-->
       <div class="TmpBgSelectIcon" style="display:<?php if($row_RecordTmpLogoSelect['Mobile_Logo'] != ''){echo "none";} ?>;"></div>
       <div class="div_table-cell">
        <a><img src="images/no_bg.jpg" alt="" alumb="true" _w="100" _h="100"/></a><span></span>
        </div>  
            <br /> 
           
           <input name="TmpBgSelect" type="checkbox" id="TmpBgSelect" value="" />
           <label for="TmpBgSelect">
		   
			不使用
            </label>
       </div><!--無圖片指定-->
       <?php do { ?>
           <div style="padding:5px; border: 1px dotted #CCC; margin-bottom:2px; width:115px; float:left; margin:5px; text-align:center;" class="<?php if($row_RecordTmpLogoSelect['Mobile_Logo'] == $row_RecordTmpLogo['id']){echo "bg_active";} ?> bg_board">
           <div class="TmpBgSelectIcon" style="display:<?php if($row_RecordTmpLogoSelect['Mobile_Logo'] != $row_RecordTmpLogo['id']){echo "none";} ?>;"></div>
           <?php if ($row_RecordTmpLogo['logotype'] == 0) { ?>
		   <?php if ($row_RecordTmpLogo['logoimage'] != "" && GetFileExtend($row_RecordTmpLogo['logoimage']) != '.swf') { ?>
        <div class="div_table-cell">	
        <a><img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpLogo['webname']; ?>/logo/<?php echo $row_RecordTmpLogo['logoimage']; ?>" alt="" alumb="true" _w="100" _h="100"/></a><span></span>
        </div>
        <?php } else if (GetFileExtend($row_RecordTmpLogo['logoimage']) == '.swf'){ ?>
        <div class="div_table-cell">	
        <a><div align='center'><embed type="application/x-shockwave-flash" width="" height="" src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpLogo['webname']; ?>/logo/<?php echo $row_RecordTmpLogo['logoimage']; ?>" play="true" loop="true" quality="high"> </embed></div></a><span></span>
        </div>
		<?php } else { ?>
        <div class="div_table-cell">	
        <a><img src="images/100x100_noimage.jpg" alt="" alumb="true" _w="100" _h="100"/></a><span></span>
        </div>
        <?php } ?>
           <?php } else { ?>
           <div class="div_table-cell" style="display:inline-block; overflow:hidden; white-space:nowrap">	
        <a style="color:<?php echo $row_RecordTmpLogo['logocolor']; ?>; font-size:<?php echo $row_RecordTmpLogo['logofontsize']; ?>"><?php echo $row_RecordTmpLogo['logoname']; ?></a><span></span>
        </div><br />

           <?php } ?>
            <br /> 
           
           <input name="TmpBgSelect" type="checkbox" id="TmpBgSelect" value="<?php echo $row_RecordTmpLogo['id']; ?>" />
           <label for="TmpBgSelect">
		   
			<?php echo highLight($row_RecordTmpLogo['name'], @$_GET['searchkey'], $HighlightSelect); ?>
            </label>
           </div>
<?php } while ($row_RecordTmpLogo = mysqli_fetch_assoc($RecordTmpLogo)); ?>
</span>
       </td>
       </tr>
     
     
      </tbody>
    
       <tfoot>
        <tr>
        <td><input type="submit" name="button" id="button" value="送出" />
          <input name="id" type="hidden" id="id" value="<?php echo $_GET['id_edit']; ?>" /></td>
        </tr>
      </tfoot>

</table>
	<input type="hidden" name="MM_update" value="form" />
   </form>
    
    
  </div>
</div>
<script type="text/javascript">
/* 圖片(不)完全按比例自動縮圖 */
jQuery(document).ready(function(){$(window).load(function(){$(".div_table-cell img").each(function(){if("true"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");var c=$(this).width(),d=$(this).height(),a=$(this).attr("_w")/c,b=$(this).attr("_h")/d,e=1,e=a>b?b:a;$(this).width(c*e);$(this).height(d*e)}else if("false"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");$(this).width();$(this).height();c=$(this).attr("_w");d=$(this).attr("_h");
a=$(this).width();b=$(this).height();if(a>c){var e=a,f=b,b=b*(c/a),a=c;b<d&&(a=e*(d/f),b=d)}$(this).attr({width:a,height:b})}})})});
</script>
<script type="text/javascript">
var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("sprycheckbox1", {validateOn:["blur"], isRequired:false, minSelections:1, maxSelections:1});
</script>
</body>
</html>
<?php
mysqli_free_result($RecordTmpLogo);

mysqli_free_result($RecordTmpLogoSelect);

mysqli_free_result($RecordTmpLogoListType);

mysqli_free_result($RecordTmpBoardStyle);
?>