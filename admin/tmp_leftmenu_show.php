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

$colid_RecordTmpLeftMenu = "-1";
if (isset($_GET['id_edit'])) {
  $colid_RecordTmpLeftMenu = $_GET['id_edit'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpLeftMenu = sprintf("SELECT * FROM demo_tmpleftmenu WHERE id=%s", GetSQLValueString($colid_RecordTmpLeftMenu, "int"));
$RecordTmpLeftMenu = mysqli_query($DB_Conn, $query_RecordTmpLeftMenu) or die(mysqli_error($DB_Conn));
$row_RecordTmpLeftMenu = mysqli_fetch_assoc($RecordTmpLeftMenu);
$totalRows_RecordTmpLeftMenu = mysqli_num_rows($RecordTmpLeftMenu);
?>

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
<script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script><script src="../SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryData.js" type="text/javascript">/*此檔案必須在jquery之前執行*/</script>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.abgne-minwt.divalign.js"> // Div自動對齊(齊左齊右齊上齊下) malign:left、right  mvalign:top、bottom div區塊中加入</script>
<!-- Light box -->
<link rel="stylesheet" href="css/colorbox/colorbox.css" />
<script type="text/javascript" language="javascript" src="js/colorbox/jquery.colorbox-min.js"></script>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script>
		$(document).ready(function(){
			$(".colorbox_iframe").colorbox({iframe:true, width:"80%", height:"80%"});
			$(".colorbox_iframe_small").colorbox({iframe:true, width:"1000px", height:"80%"});
			$(".colorbox_iframe_cd").colorbox({iframe:true, width:"99%", height:"99%"});
		});
</script>
<!-- Light box END -->
<link rel="stylesheet" type="text/css" href="css/jQuery-Tags-Input/jquery.tagsinput.css" />
<script type="text/javascript" src="js/jquery.miniColors.min.js">/*顏色選擇*/</script>
<link type="text/css" rel="stylesheet" href="css/jquery.miniColors.css" />
<script type="text/javascript" src="js/jQuery-Tags-Input/jquery.tagsinput.min.js"></script>
<script src="../SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
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
<script type="text/javascript">
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
<link href="css/incstyle.css" rel="stylesheet" type="text/css" />
<link href="css/styleless.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="../css/jquery.d.checkbox.css"></link>
<link rel="stylesheet" href="../css/fontsizer.css" type="text/css" />
<link type="text/css" href="../css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<style type="text/css">
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
.button_a{display:inline-block; border-width:1px 0; border-color:#BBBBBB; border-style:solid; vertical-align:middle;text-decoration:none; color:#333333;}
.button_b{float:left; background:#e3e3e3; border-width:0 1px; border-color:#BBBBBB; border-style:solid; margin:0 -1px; position:relative;}
.button_c{display:block; line-height:0.6em; background:#f9f9f9; border-bottom:2px solid #eeeeee;}
.button_d{display:block; padding:0.1em 0.6em; margin-top:-0.6em; cursor:pointer;}
.button_a:hover{border-color:#999999;text-decoration:none;}
.button_a:hover .button_b{border-color:#999999;text-decoration:none;}
#apDiv_config {
	position: fixed;
	width: 230px;
	height: 115px;
	z-index: 1;
	float: right;
	right: 0px;
	top: 60px;
}
#wrapper_config div #apDiv_config div span a {
	color: #1C590D;
	font-size: 9px;
}

#wrapper_config div #apDiv_config div span a{color:#1C590D; font-size:9px}
#v_out_wrp_c{width:980px; border:#CCC dotted 1px; margin-left:auto; margin-right:auto; color:#090}
#v_out_wrp{width:1000px; border:#CCC dotted 1px; margin-left:auto; margin-right:auto}
.v_out_wrp_font{color:#CCC; font-size:30px; font-weight:bolder; padding:10px}
#v_out_wrp:hover{border:1px dotted #C30;}
.v_out_wrp_bk{float:right; margin-right:5px; margin-top:5px; padding:5px; border:#CCC dotted 1px; height:75px}
#v_wrp{width:960px; margin-left:auto; margin-right:auto; margin-top:100px; border:#CCC dotted 1px; position:relative; padding-right:20px; padding-bottom:20px; padding-top:20px; padding-left:20px; background-position:center center; background-repeat:no-repeat;}
#v_wrp:hover{border:1px dotted #C30}
#v_wrp_header{border:#CCC dotted 1px; margin:5px; position:relative; min-height:200px}
#v_wrp_header:hover{border:#C30 dotted 1px}
#v_wrp_header_logo{color:#CCC; font-size:30px; font-weight:bolder; padding:10px; position:absolute; left:5px; top:5px; border:#CCC dotted 1px}
#v_wrp_header_logo:hover{border:#C30 dotted 1px}
#v_wrp_header_menu{color:#CCC; font-size:30px; font-weight:bolder; padding:10px; position:absolute; left:110px; top:5px; border:#CCC dotted 1px; width:810px; height:80px;<?php if ($row_RecordTmpMainMenu['tmp_mainmenu_location'] == '1') { ?>display:none;<?php } ?>}
#v_wrp_header_menu:hover{border:#C30 dotted 1px}
#v_wrp_banner{border:#CCC dotted 1px; margin:5px; position:relative; min-height:100px}
#v_wrp_banner:hover{border:#C30 dotted 1px}
#v_wrp_menu_full{border:#CCC dotted 1px; margin:5px; position:relative; min-height:100px;<?php if ($row_RecordTmpMainMenu['tmp_mainmenu_location'] == '0') { ?>display:none;<?php } ?>;}
#v_wrp_menu_full:hover{border:#C30 dotted 1px}
#v_wrp_l_column{border:#CCC dotted 1px; margin:5px; float:left; width:225px; position:relative; min-height:700px}
#v_wrp_l_column:hover{border:#C30 dotted 1px}
.v_wrp_l_column_board_style{border:1px #CCC dotted; position:relative; margin:5px}
#v_wrp_l_column_wrp_board_style:hover .v_wrp_l_column_board_style{border:#C30 dotted 1px}
#v_wrp_l_column_menu_style{border:1px #CCC dotted; position:relative; margin:5px; height:370px}
#v_wrp_l_column_menu_style:hover{border:#C30 dotted 1px}
#v_wrp_middle{border:#CCC dotted 1px; margin:5px; margin-left:240px; position:relative; min-height:700px}
#v_wrp_middle:hover{border:#C30 dotted 1px}
#v_wrp_middle_title_sicon{color:#CCC; font-size:30px; font-weight:bolder; padding:10px; position:absolute; left:5px; top:5px; border:#CCC dotted 1px; width:150px; height:75px}
#v_wrp_middle_title_sicon:hover{border:#C30 dotted 1px}
#v_wrp_middle_title{border:#CCC dotted 1px; margin:5px; position:relative; min-height:160px}
#v_wrp_middle_title:hover{border:#C30 dotted 1px}
#v_wrp_middle_content{border:#CCC dotted 1px; margin:5px; position:relative; min-height:300px}
#v_wrp_middle_content:hover{border:#C30 dotted 1px}
#v_wrp_footer{border:#CCC dotted 1px; margin:5px; clear:both; position:relative; min-height:100px;}
#v_wrp_footer:hover{border:#C30 dotted 1px}
#v_wrp_md{width:600px; margin-left:auto; margin-right:auto; margin-top:10px; margin-bottom:100px; border:#CCC dotted 1px; position:relative; padding-right:20px; padding-bottom:20px; padding-top:5px; padding-left:20px; background-position:center center; background-repeat:no-repeat; height:250px}
.v_md{border:#CCC dotted 1px; height:80px; width:70px; padding:5px; text-align:center; margin-left:5px; margin-top:5px; float:left}
.v_md:hover{border:#C30 dotted 1px}

.dcjq-vertical-mega-menu .menu{font-weight:bold}
.dcjq-vertical-mega-menu .menu li a{color:<?php echo $row_RecordTmpLeftMenu['tmp_a_font_color']; ?>; background-image:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpLeftMenu['webname']; ?>/image/tmpleftmenu/<?php echo $row_RecordTmpLeftMenu['tmp_middle_pic']; ?>); background-repeat:repeat-y; background-position:center 0}
.dcjq-vertical-mega-menu #mega-tp li a:hover{color:<?php echo $row_RecordTmpLeftMenu['tmp_a_o_font_color']; ?>; <?php if ($row_RecordTmpLeftMenu['tmp_middle_o_pic'] != ''){ ?>background-image:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpLeftMenu['webname']; ?>/image/tmpleftmenu/<?php echo $row_RecordTmpLeftMenu['tmp_middle_o_pic']; ?>); <?php } ?>background-repeat:repeat-y; background-position:center 0}
</style>
<link href="../SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
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
<div style="padding:10px; margin:10px; position:relative;" id="wrapper_config">
  <div style="background-color:#FFFFFF; padding:5px; border: 1px solid #CCC; min-height:400px;background-color:#F3F3F3;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">側邊選單預覽 [<?php echo $langname; ?>編輯介面]</font></strong></h5></td>
            <td align="right">&nbsp;</td>
      </tr>
    </table>
    <span class="v_out_wrp_font">外框架</span>
    <div id="v_out_wrp_c" style=" margin-top:10px; padding:10px;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="35" align="right" valign="top">*註：</td>
            <td>側邊選單的實際位置會依您的版型設定而有所變動，您可以在 <span style="color:#F60;">版型修改->自訂欄位</span> 調整各區塊順序。</td>
          </tr>
          <tr>
            <td align="right" valign="top">*註：</td>
            <td>本圖僅供參考，為大致位置圖，各區塊高度皆會依您的設定為準。</td>
          </tr>
        </table>
      </div>
    <div id="v_wrp">
      <!--獨立外框-->
      <!--獨立背景-->
        <div style="color: #CCC; font-size: 30px; font-weight: bolder; padding: 10px; position: absolute; left: -36px; top: -41px;">主框架</div>
        	<div id="v_wrp_header">
            <!--獨立背景-->
            <div id="v_wrp_header_logo">Logo</div>
                <div id="v_wrp_header_menu">
                <!--獨立選單-->
                
                <!--獨立選單-->
                選單</div>
                <span style="color: #CCC; font-size: 30px; font-weight: bolder; padding: 10px; position: absolute; right: 5px; bottom: 5px;"><br />
                頁首區塊</span>
            </div>
      <div id="v_wrp_banner">
            	<span style="color: #CCC; font-size:30px; font-weight:bolder; padding:10px; position: absolute; right: 5px; bottom: 5px;"><br />
            	橫幅區塊</span>
            </div>
            <div style="position:relative; float:right; width:100%; margin-left:-215px; margin-right:0px;">
            <div id="v_wrp_l_column">
            <div id="v_wrp_l_column_wrp_board_style">
            <div class="v_wrp_l_column_board_style" style="height:450px;">
            <div id="v_wrp_l_column_menu_style" style="background-image:url(images/ap_p_u.jpg);">
            <!--獨立選單-->
            <div style="width:200px;text-align:center;">
    <link href="../theme/board001/css/vertical-mega-menu/vertical_menu_basic.css" rel="stylesheet" type="text/css" /><script type='text/javascript' src='../js/vertical-mega-menu/jquery.dcverticalmegamenu.1.1.js'></script><script type='text/javascript' src='../js/vertical-mega-menu/jquery.dcverticalmegamenu.1.1.js'></script>
<script type="text/javascript">
$(document).ready(function($){
	$('#mega-tp').dcVerticalMegaMenu({
		rowItems: '3',
		speed: 'fast',
		effect: 'slide',
		direction: 'right'
	});
});
</script>
<?php if ($row_RecordTmpLeftMenu['tmp_title_pic'] != '') { ?>
<img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpLeftMenu['webname']; ?>/image/tmpleftmenu/<?php echo $row_RecordTmpLeftMenu['tmp_title_pic']; ?>" />
<?php } ?>  <div class="dcjq-vertical-mega-menu">
        <ul id="mega-tp" class="menu" style="margin-left:0px;">
                                 
            <li class="">
                        <a href="#">公司簡介</a>
                      </li>
          
                      
            <li class="">
                        <a href="#">特色說明</a>
                      </li>
                                                              
                                                                          
                                                                <li class="">
                                                                            <a href="#">歷史沿革</a>
                                                                          </li>
                                                              
                                                                      </ul>
                                                    </div>
                                                    <?php if ($row_RecordTmpLeftMenu['tmp_bottom_pic'] != '') { ?>
                                                    <img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpLeftMenu['webname']; ?>/image/tmpleftmenu/<?php echo $row_RecordTmpLeftMenu['tmp_bottom_pic']; ?>" /> <?php } ?>   </div>
            <span style="color: #CCC; font-size:30px; font-weight:bolder; padding:5px; position: absolute; right: 0px; bottom: 0px;">選單樣式</span>
            </div>
            <span style="color: #CCC; font-size:30px; font-weight:bolder; padding:5px; position: absolute; right: 0px; bottom: 0px;">側邊裝飾外框</span>
            </div>
            <div class="v_wrp_l_column_board_style" style="height:60px;">
            <span style="color: #CCC; font-size:30px; font-weight:bolder; padding:5px; position: absolute; right: 0px; bottom: 0px;">側邊裝飾外框</span>
            </div>
            <div class="v_wrp_l_column_board_style" style="height:100px;">
            <!--獨立風格-->
            <span style="color: #CCC; font-size:30px; font-weight:bolder; padding:5px; position: absolute; right: 0px; bottom: 0px;">側邊裝飾外框</span>
            </div>
            </div>
            <!--獨立背景-->
            <span style="color: #CCC; font-size:30px; font-weight:bolder; padding:10px; position: absolute; right: 0px; bottom: 5px;"><br />
            	欄位區塊</span>
            </div>
            <div id="v_wrp_middle">
            <div id="v_wrp_middle_title">
            	<div id="v_wrp_middle_title_sicon"><span style="color: #CCC; font-size:30px; font-weight:bolder; padding:2px; position: absolute; right: 5px; top: 5px;">
            	  小圖示</span></div>
                <!--獨立背景-->
                <!--獨立外框-->
                <span style="color: #CCC; font-size:30px; font-weight:bolder; padding:10px; position: absolute; left: 5px; bottom: 5px;">標題區塊</span>
            </div>
            <div id="v_wrp_middle_content">
            	<!--獨立外框-->
            	<span style="color: #CCC; font-size:30px; font-weight:bolder; padding:10px; position: absolute; right: 5px; bottom: 5px;"><br />
            	內文區塊</span>
            </div>
            	<span style="color: #CCC; font-size:30px; font-weight:bolder; padding:10px; position: absolute; right: 5px; bottom: 5px;"><br />
            	中央區塊</span>
                <!--獨立背景-->
            </div>
            </div>
            <div id="v_wrp_footer">
            <!--獨立背景-->
            <span style="color: #CCC; font-size:30px; font-weight:bolder; padding:10px;position: absolute; right: 5px; bottom: 5px;"><br />
            	頁尾區塊</span>
            </div>
        </div>
    
    </div>


</div>
</div>

  </div>
</div>
<div id="footer_config"></div>
</body>
</html>
<?php
mysqli_free_result($RecordTmpLeftMenu);
?>
