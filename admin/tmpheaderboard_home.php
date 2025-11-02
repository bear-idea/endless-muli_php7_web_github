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
    GLOBAL $maxRows_RecordTmpBoard,$totalRows_RecordTmpBoard;
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
					if ($_get_name != "pageNum_RecordTmpBoard") {
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
			$firstArray = ($pageNum_Recordset1 > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordTmpBoard=$precedente$_get_vars\">$prev_Recordset1</a>" :  "<span>$prev_Recordset1</span>"/*  css */;
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordTmpBoard) + 1;
					$max_l = ($a*$maxRows_RecordTmpBoard >= $totalRows_RecordTmpBoard) ? $totalRows_RecordTmpBoard : ($a*$maxRows_RecordTmpBoard);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageNum_Recordset1)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordTmpBoard=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "<span>"; /* css */
					$pagesArray .= "$textLink</span>"  . ($theNext < $egp-1 ? $separator : "");
				}
			}  
			$theNext = $pageNum_Recordset1+1;
			$offset_end = $totalPages_Recordset1;
			$lastArray = ($pageNum_Recordset1 < $totalPages_Recordset1) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordTmpBoard=$successivo$_get_vars\">$next_Recordset1</a>" : "<span>$next_Record1</span>"; /* css */
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
  $updateSQL = sprintf("UPDATE demo_tmp SET tmpheaderboard=%s WHERE id=%s",
                       GetSQLValueString($_POST['TmpBgSelect'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

$maxRows_RecordTmpBoard = 48;
$pageNum_RecordTmpBoard = 0;
if (isset($_GET['pageNum_RecordTmpBoard'])) {
  $pageNum_RecordTmpBoard = $_GET['pageNum_RecordTmpBoard'];
}
$startRow_RecordTmpBoard = $pageNum_RecordTmpBoard * $maxRows_RecordTmpBoard;

$colname_RecordTmpBoard = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordTmpBoard = $_GET['searchkey'];
}
$coluserid_RecordTmpBoard = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpBoard = $w_userid;
}
$coltype_RecordTmpBoard = "%";
if (isset($_GET['type'])) {
  $coltype_RecordTmpBoard = $_GET['type'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpBoard = sprintf("SELECT * FROM demo_tmpboard WHERE ((name LIKE %s)) && (type LIKE %s) && (userid=%s || userid=1) ORDER BY id DESC", GetSQLValueString("%" . $colname_RecordTmpBoard . "%", "text"),GetSQLValueString("%" . $coltype_RecordTmpBoard . "%", "text"),GetSQLValueString($coluserid_RecordTmpBoard, "int"));
$query_limit_RecordTmpBoard = sprintf("%s LIMIT %d, %d", $query_RecordTmpBoard, $startRow_RecordTmpBoard, $maxRows_RecordTmpBoard);
$RecordTmpBoard = mysqli_query($DB_Conn, $query_limit_RecordTmpBoard) or die(mysqli_error($DB_Conn));
$row_RecordTmpBoard = mysqli_fetch_assoc($RecordTmpBoard);

if (isset($_GET['totalRows_RecordTmpBoard'])) {
  $totalRows_RecordTmpBoard = $_GET['totalRows_RecordTmpBoard'];
} else {
  $all_RecordTmpBoard = mysqli_query($DB_Conn, $query_RecordTmpBoard);
  $totalRows_RecordTmpBoard = mysqli_num_rows($all_RecordTmpBoard);
}
$totalPages_RecordTmpBoard = ceil($totalRows_RecordTmpBoard/$maxRows_RecordTmpBoard)-1;

$colid_RecordTmpBoardSelect = "-1";
if (isset($_GET['id'])) {
  $colid_RecordTmpBoardSelect = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpBoardSelect = sprintf("SELECT * FROM demo_tmp WHERE id = %s", GetSQLValueString($colid_RecordTmpBoardSelect, "int"));
$RecordTmpBoardSelect = mysqli_query($DB_Conn, $query_RecordTmpBoardSelect) or die(mysqli_error($DB_Conn));
$row_RecordTmpBoardSelect = mysqli_fetch_assoc($RecordTmpBoardSelect);
$totalRows_RecordTmpBoardSelect = mysqli_num_rows($RecordTmpBoardSelect);

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpBoardListType = "SELECT * FROM demo_tmpitem WHERE list_id = 3";
$RecordTmpBoardListType = mysqli_query($DB_Conn, $query_RecordTmpBoardListType) or die(mysqli_error($DB_Conn));
$row_RecordTmpBoardListType = mysqli_fetch_assoc($RecordTmpBoardListType);
$totalRows_RecordTmpBoardListType = mysqli_num_rows($RecordTmpBoardListType);

$colname_RecordTmpBoardStyle = "-1";
if (isset($_GET['id'])) {
  $colname_RecordTmpBoardStyle = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpBoardStyle = sprintf("SELECT name FROM demo_tmp WHERE id = %s", GetSQLValueString($colname_RecordTmpBoardStyle, "int"));
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
.tbutt{float:left;padding:5px;background-color:#666;color:#FFF;margin:0 5px 10px 0}
div .photoFram_Block_glossy,.div_table-cell{overflow:hidden;height:100px;width:100px;margin:5px}
.div_table-cell{text-align:center;vertical-align:middle;border:1px solid #DDD}
.div_table-cell span{height:100%;display:inline-block;background-image:none;border-style:none}
.div_table-cell *{vertical-align:middle}
.InnerPage{display:none}
.bg_board:hover{background-color:#E95516}
.bg_active{background-color:#B37583}
.TmpBgSelectIcon{position:absolute;z-index:1;height:65px;width:93px;background-image:url(images/select.png);background-repeat:no-repeat}
.button_a{display:inline-block;border-width:1px 0;border-color:#BBB;border-style:solid;vertical-align:middle;text-decoration:none;color:#333}
.button_b{float:left;background:#e3e3e3;border-width:0 1px;border-color:#BBB;border-style:solid;margin:0 -1px;position:relative}
.button_c{display:block;line-height:.6em;background:#f9f9f9;border-bottom:2px solid #eee}
.button_d{display:block;padding:.1em .6em;margin-top:-.6em;cursor:pointer}
.button_a:hover{border-color:#999;text-decoration:none}
.button_a:hover .button_b{border-color:#999;text-decoration:none}
.Area_Tag{left:-1px;top:-1px;background-color:#6C6C6C;color:#FFF;padding:2px;-webkit-border-radius:2px;-moz-border-radius:2px;-o-border-radius:2px;border-radius:2px;box-shadow:0 1px 3px rgba(0,0,0,.2);-webkit-box-shadow:0 1px 3px rgba(0,0,0,.2);-moz-box-shadow:0 1px 3px rgba(0,0,0,.2);-o-box-shadow:0 1px 3px rgba(0,0,0,.2);position:absolute;z-index:100;font-size:9px}
.Area_Tag a{color:#FFF}
table.tablesorter tr.even:hover td,table.tablesorter tr:hover td,table.tablesorter tr.odd:hover td { background-color:#FFFFFF;}
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
            <td><h5><strong><font color="#756b5b">外框選擇</font><font color="#756b5b"> [<?php echo $langname; ?>編輯介面]</font></strong></h5></td>
            <td width="155" align="right">
               <div>
                 <a href="tmp_config_<?php echo $row_RecordTmpBoardStyle['name']; ?>.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $_GET['id']; ?>" class="button_a">
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
          	<td width="50%"> 顯示 <?php echo ($startRow_RecordTmpBoard + 1) ?> - <?php echo min($startRow_RecordTmpBoard + $maxRows_RecordTmpBoard, $totalRows_RecordTmpBoard) ?> 筆 共計 <?php echo $totalRows_RecordTmpBoard ?> 筆</td>
            <td width="50%" align="right">
            
            <?php if ($ManageTmpSearchSelect == "1") { ?>
            <form id="form_TmpBoard" name="form_TmpBoard" method="get" action="<?php echo $editFormAction; ?>">
              <input name="Opt_Tmp" type="hidden" id="Opt_Tmp" value="tmpbk" />
                <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                <input name="id" type="hidden" id="id" value="<?php echo $_GET['id']; ?>" />
              <select name="type" id="type">
                <option value="%" selected="selected">-- 選擇類別 --</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_RecordTmpBoardListType['itemname']?>"><?php echo $row_RecordTmpBoardListType['itemname']?></option>
                  <?php
} while ($row_RecordTmpBoardListType = mysqli_fetch_assoc($RecordTmpBoardListType));
  $rows = mysqli_num_rows($RecordTmpBoardListType);
  if($rows > 0) {
      mysqli_data_seek($RecordTmpBoardListType, 0);
	  $row_RecordTmpBoardListType = mysqli_fetch_assoc($RecordTmpBoardListType);
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
			$prev_RecordTmpBoard = "<i class=\"fa fa-angle-left\"></i>";
			$next_RecordTmpBoard = "<i class=\"fa fa-angle-right\"></i>";
			$separator = "&nbsp;";
			$max_links = 15;
			$pages_navigation_RecordTmpBoard = buildNavigation($pageNum_RecordTmpBoard,$totalPages_RecordTmpBoard,$prev_RecordTmpBoard,$next_RecordTmpBoard,$separator,$max_links,true); 
			
			print $pages_navigation_RecordTmpBoard[0]; 
			?>
            <?php print $pages_navigation_RecordTmpBoard[1]; ?> 
			<?php print $pages_navigation_RecordTmpBoard[2]; ?></div>     
            
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
	   <div style="padding:5px; border: 1px dotted #CCC; margin-bottom:2px; width:230px; height:200px; float:left; margin:5px; text-align:center;" class="<?php if($row_RecordTmpBoardSelect['tmpheaderboard'] == ''){echo "bg_active";} ?> bg_board"><!--無圖片指定-->
       <div class="TmpBgSelectIcon" style="display:<?php if($row_RecordTmpBoardSelect['tmpheaderboard'] != ''){echo "none";} ?>;"></div>
       
        <a><img src="images/no_bg.jpg" alt="" alumb="true" _w="100" _h="100"/></a>
         
            <br /> 
           
           <input name="TmpBgSelect" type="checkbox" id="TmpBgSelect" value="" />
           <label for="TmpBgSelect">
		   
			不使用
            </label>
       </div><!--無圖片指定-->
       <?php do { ?>
           <div style="padding:5px; border: 1px dotted #CCC; margin-bottom:2px; width:230px; height:200px; float:left; margin:5px; text-align:center;" class="<?php if($row_RecordTmpBoardSelect['tmpheaderboard'] == $row_RecordTmpBoard['id']){echo "bg_active";} ?> bg_board">
           <div class="Area_Tag">#<?php echo $row_RecordTmpBoard['id']; ?></div>
           <div class="TmpBgSelectIcon" style="display:<?php if($row_RecordTmpBoardSelect['tmpheaderboard'] != $row_RecordTmpBoard['id']){echo "none";} ?>;"></div>
		   <?php //if ($row_RecordTmpBoard['bgimage'] != "") { ?>
           <!--外框樣式-->
           <div class="mdl" style=" background-color:<?php echo $row_RecordTmpBoard['tmp_w_background_color']; ?>;border:<?php echo $row_RecordTmpBoard['tmp_w_board_width']; ?>px <?php echo $row_RecordTmpBoard['tmp_w_board_style']; ?> <?php echo $row_RecordTmpBoard['tmp_w_board_color']; ?>;background-image: url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_w_background_img'] ?>);-webkit-border-radius: <?php echo $row_RecordTmpBoard['borderradius_t_l']; ?>px <?php echo $row_RecordTmpBoard['borderradius_t_r']; ?>px <?php echo $row_RecordTmpBoard['borderradius_b_r']; ?>px <?php echo $row_RecordTmpBoard['borderradius_b_l']; ?>px;-moz-border-radius: <?php echo $row_RecordTmpBoard['borderradius_t_l']; ?>px <?php echo $row_RecordTmpBoard['borderradius_t_r']; ?>px <?php echo $row_RecordTmpBoard['borderradius_b_r']; ?>px <?php echo $row_RecordTmpBoard['borderradius_b_l']; ?>px;border-radius: <?php echo $row_RecordTmpBoard['borderradius_t_l']; ?>px <?php echo $row_RecordTmpBoard['borderradius_t_r']; ?>px <?php echo $row_RecordTmpBoard['borderradius_b_r']; ?>px <?php echo $row_RecordTmpBoard['borderradius_b_l']; ?>px;-webkit-box-shadow: <?php echo $row_RecordTmpBoard['boxshadow_x']; ?>px <?php echo $row_RecordTmpBoard['boxshadow_y']; ?>px <?php echo $row_RecordTmpBoard['boxshadow_size']; ?>px <?php echo $row_RecordTmpBoard['boxshadow_color']; ?>;-moz-box-shadow: <?php echo $row_RecordTmpBoard['boxshadow_x']; ?>px <?php echo $row_RecordTmpBoard['boxshadow_y']; ?>px <?php echo $row_RecordTmpBoard['boxshadow_size']; ?>px <?php echo $row_RecordTmpBoard['boxshadow_color']; ?>;box-shadow: <?php echo $row_RecordTmpBoard['boxshadow_x']; ?>px <?php echo $row_RecordTmpBoard['boxshadow_y']; ?>px <?php echo $row_RecordTmpBoard['boxshadow_size']; ?>px <?php echo $row_RecordTmpBoard['boxshadow_color']; ?>;background: -webkit-gradient(linear, 0 0, 0 bottom, from(<?php echo $row_RecordTmpBoard['lineargradient_top']; ?>), to(<?php echo $row_RecordTmpBoard['lineargradient_bottom']; ?>));background: -webkit-linear-gradient(<?php echo $row_RecordTmpBoard['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoard['lineargradient_bottom']; ?>);background: -moz-linear-gradient(<?php echo $row_RecordTmpBoard['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoard['lineargradient_bottom']; ?>);background: -ms-linear-gradient(<?php echo $row_RecordTmpBoard['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoard['lineargradient_bottom']; ?>);background: -o-linear-gradient(<?php echo $row_RecordTmpBoard['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoard['lineargradient_bottom']; ?>);background: linear-gradient(<?php echo $row_RecordTmpBoard['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoard['lineargradient_bottom']; ?>);-pie-background: linear-gradient(<?php echo $row_RecordTmpBoard['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoard['lineargradient_bottom']; ?>);behavior:url(http://www.shop3500.com/PIE.htc);">
            <div class="mdl_t">
                    <div class="mdl_t_l" style="background:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_l_t_background_img']; ?>) <?php echo $row_RecordTmpBoard['tmp_l_t_repeat']; ?> scroll left top;width:<?php echo $row_RecordTmpBoard['tmp_l_t_width']; ?>px;height:<?php echo $row_RecordTmpBoard['tmp_l_t_height']; ?>px;"> </div>
                    <div class="mdl_t_r" style="background:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_r_t_background_img']; ?>) <?php echo $row_RecordTmpBoard['tmp_r_t_repeat']; ?> scroll left top;width:<?php echo $row_RecordTmpBoard['tmp_r_t_width']; ?>px;height:<?php echo $row_RecordTmpBoard['tmp_r_t_height']; ?>px;"> </div>
                    <div class="mdl_t_c" style="background:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_m_t_background_img']; ?>) <?php echo $row_RecordTmpBoard['tmp_m_t_repeat']; ?> scroll left top;height:<?php echo $row_RecordTmpBoard['tmp_r_t_height']; ?>px;margin:0px <?php echo $row_RecordTmpBoard['tmp_r_t_width']; ?>px 0px <?php echo $row_RecordTmpBoard['tmp_l_t_width']; ?>px;"><!--標題文字--></div>
                    <div class="mdl_t_m"><!--右邊文字--></div>
            </div><!--mdl_t-->
            <div class="mdl_c g_p_hide">
                    <div class="mdl_c_l g_p_fill" style="background:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_l_m_background_img']; ?>) <?php echo $row_RecordTmpBoard['tmp_l_m_repeat']; ?> scroll left top;width:<?php echo $row_RecordTmpBoard['tmp_l_m_width']; ?>px;"> </div>
                    <div class="mdl_c_r g_p_fill" style="background:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_r_m_background_img']; ?>) <?php echo $row_RecordTmpBoard['tmp_r_m_repeat']; ?> scroll left top;width:<?php echo $row_RecordTmpBoard['tmp_r_m_width']; ?>px;"> </div>
                    <div class="mdl_c_c" style="background:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_m_m_background_img']; ?>) <?php echo $row_RecordTmpBoard['tmp_m_m_repeat']; ?> scroll left top;margin:0px <?php echo $row_RecordTmpBoard['tmp_r_m_width']; ?>px 0px <?php echo $row_RecordTmpBoard['tmp_l_m_width']; ?>px;">
                           
                            <div class="mdl_m_c" style="width:50px; height:50px;">
                                
                            </div>
                           
                    </div>
            </div><!--mdl_c-->
            <div class="mdl_b">
                    <div class="mdl_b_l" style="background:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_l_b_background_img']; ?>) <?php echo $row_RecordTmpBoard['tmp_l_b_repeat']; ?> scroll left top;width:<?php echo $row_RecordTmpBoard['tmp_l_b_width']; ?>px;height:<?php echo $row_RecordTmpBoard['tmp_l_b_height']; ?>px;"> </div>
                    <div class="mdl_b_r" style="background:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_r_b_background_img']; ?>) <?php echo $row_RecordTmpBoard['tmp_r_b_repeat']; ?> scroll left top;width:<?php echo $row_RecordTmpBoard['tmp_r_b_width']; ?>px;height:<?php echo $row_RecordTmpBoard['tmp_r_b_height']; ?>px;"> </div>
                    <div class="mdl_b_c" style="background:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoard['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoard['tmp_m_b_background_img']; ?>) <?php echo $row_RecordTmpBoard['tmp_m_b_repeat']; ?> scroll left top;height:<?php echo $row_RecordTmpBoard['tmp_m_b_height']; ?>px;margin:0px <?php echo $row_RecordTmpBoard['tmp_r_b_width']; ?>px 0px <?php echo $row_RecordTmpBoard['tmp_l_b_width']; ?>px;"> </div>
            </div><!--mdl_b-->
        </div><!--mdl-->
           <!--外框樣式 END-->
            <?php //} ?>       
            <br /> 
           
           <input name="TmpBgSelect" type="checkbox" id="TmpBgSelect" value="<?php echo $row_RecordTmpBoard['id']; ?>" />
           <label for="TmpBgSelect">
		   
			<?php echo highLight($row_RecordTmpBoard['name'], @$_GET['searchkey'], $HighlightSelect); ?>
            </label>
           
           </div>
<?php } while ($row_RecordTmpBoard = mysqli_fetch_assoc($RecordTmpBoard)); ?>
</span>
       </td>
       </tr>
     
     
      </tbody>
    
       <tfoot>
        <tr>
        <td><input type="submit" name="button" id="button" value="送出" />
          <input name="id" type="hidden" id="id" value="<?php echo $_GET['id']; ?>" /></td>
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
mysqli_free_result($RecordTmpBoard);

mysqli_free_result($RecordTmpBoardSelect);

mysqli_free_result($RecordTmpBoardListType);

mysqli_free_result($RecordTmpBoardStyle);
?>