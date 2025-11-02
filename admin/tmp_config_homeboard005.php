<?php require_once('../Connections/DB_Conn.php'); ?>
<?php 
header("Content-Type:text/html;charset=utf-8"); // 指定頁面編碼方式 IE BUG 
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Tmp")) {
  $updateSQL = sprintf("UPDATE demo_tmp SET tmpfbfanselect=%s, tmpfbfanbkcolor=%s, tmpfbfanboardcolor=%s, tmpshowblockname=%s, tmpdftmenu_x=%s, tmpdftmenu_y=%s, tmppicmenu_x=%s, tmppicmenu_y=%s, tmppicmenu_style=%s, tmpbannerpicwidth=%s, tmpbannerpicheight=%s, tmplogomargintop=%s, tmplogomarginleft=%s, tmpwordcolor=%s, tmpwordsize=%s, tmplink=%s, tmplinkvisit=%s, tmplinkhover=%s, tmpheaderminheight=%s, tmpleftminheight=%s, tmpmiddleminheight=%s, tmprightminheight=%s, tmpfooterminheight=%s, tmpbanner=%s, tmpdfmenucolor=%s, tmpmenuselect=%s, tmpbodyselect=%s, tmpmeger_t_m=%s, tmpheaderpaddingtop=%s, tmpheaderpaddingbttom=%s, tmpheaderpaddingleft=%s, tmpheaderpaddingright=%s, tmpbannerpaddingtop=%s, tmpbannerpaddingbttom=%s, tmpbannerpaddingleft=%s, tmpbannerpaddingright=%s, tmpleftpaddingtop=%s, tmpleftpaddingbttom=%s, tmpleftpaddingleft=%s, tmpleftpaddingright=%s, tmprightpaddingtop=%s, tmprightpaddingbttom=%s, tmprightpaddingleft=%s, tmprightpaddingright=%s, tmpmiddlepaddingtop=%s, tmpmiddlepaddingbttom=%s, tmpmiddlepaddingleft=%s, tmpmiddlepaddingright=%s, tmpfooterpaddingtop=%s, tmpfooterpaddingbttom=%s, tmpfooterpaddingleft=%s, tmpfooterpaddingright=%s, tmpproductboard=%s, tmpproductboardicon=%s, tmpproductboardfontcolor=%s, tmpprojectboard=%s, tmpprojectboardicon=%s, lang=%s WHERE id=%s",
                       GetSQLValueString($_POST['tmpfbfanselect'], "int"),
                       GetSQLValueString($_POST['tmpfbfanbkcolor'], "text"),
                       GetSQLValueString($_POST['tmpfbfanboardcolor'], "text"),
                       GetSQLValueString($_POST['tmpshowblockname'], "int"),
                       GetSQLValueString($_POST['tmpdftmenu_x'], "int"),
                       GetSQLValueString($_POST['tmpdftmenu_y'], "int"),
                       GetSQLValueString($_POST['tmppicmenu_x'], "int"),
                       GetSQLValueString($_POST['tmppicmenu_y'], "int"),
                       GetSQLValueString($_POST['tmppicmenu_style'], "text"),
                       GetSQLValueString($_POST['tmpbannerpicwidth'], "int"),
                       GetSQLValueString($_POST['tmpbannerpicheight'], "int"),
                       GetSQLValueString($_POST['tmplogomargintop'], "int"),
                       GetSQLValueString($_POST['tmplogomarginleft'], "int"),
                       GetSQLValueString($_POST['tmpwordcolor'], "text"),
                       GetSQLValueString($_POST['tmpwordsize'], "text"),
                       GetSQLValueString($_POST['tmplink'], "text"),
                       GetSQLValueString($_POST['tmplinkvisit'], "text"),
                       GetSQLValueString($_POST['tmplinkhover'], "text"),
                       GetSQLValueString($_POST['tmpheaderminheight'], "int"),
                       GetSQLValueString($_POST['tmpleftminheight'], "int"),
                       GetSQLValueString($_POST['tmpmiddleminheight'], "int"),
                       GetSQLValueString($_POST['tmprightminheight'], "int"),
                       GetSQLValueString($_POST['tmpfooterminheight'], "int"),
                       GetSQLValueString($_POST['tmpbanner'], "int"),
                       GetSQLValueString($_POST['tmpdfmenucolor'], "text"),
                       GetSQLValueString($_POST['tmpmenuselect'], "int"),
                       GetSQLValueString($_POST['TmpBodySelect'], "int"),
                       GetSQLValueString($_POST['tmpmeger_t_m'], "int"),
                       GetSQLValueString($_POST['tmpheaderpaddingtop'], "int"),
                       GetSQLValueString($_POST['tmpheaderpaddingbttom'], "int"),
                       GetSQLValueString($_POST['tmpheaderpaddingleft'], "int"),
                       GetSQLValueString($_POST['tmpheaderpaddingright'], "int"),
                       GetSQLValueString($_POST['tmpbannerpaddingtop'], "int"),
                       GetSQLValueString($_POST['tmpbannerpaddingbttom'], "int"),
                       GetSQLValueString($_POST['tmpbannerpaddingleft'], "int"),
                       GetSQLValueString($_POST['tmpbannerpaddingright'], "int"),
                       GetSQLValueString($_POST['tmpleftpaddingtop'], "int"),
                       GetSQLValueString($_POST['tmpleftpaddingbttom'], "int"),
                       GetSQLValueString($_POST['tmpleftpaddingleft'], "int"),
                       GetSQLValueString($_POST['tmpleftpaddingright'], "int"),
                       GetSQLValueString($_POST['tmprightpaddingtop'], "int"),
                       GetSQLValueString($_POST['tmprightpaddingbttom'], "int"),
                       GetSQLValueString($_POST['tmprightpaddingleft'], "int"),
                       GetSQLValueString($_POST['tmprightpaddingright'], "int"),
                       GetSQLValueString($_POST['tmpmiddlepaddingtop'], "int"),
                       GetSQLValueString($_POST['tmpmiddlepaddingbttom'], "int"),
                       GetSQLValueString($_POST['tmpmiddlepaddingleft'], "int"),
                       GetSQLValueString($_POST['tmpmiddlepaddingright'], "int"),
                       GetSQLValueString($_POST['tmpfooterpaddingtop'], "int"),
                       GetSQLValueString($_POST['tmpfooterpaddingbttom'], "int"),
                       GetSQLValueString($_POST['tmpfooterpaddingleft'], "int"),
                       GetSQLValueString($_POST['tmpfooterpaddingright'], "int"),
                       GetSQLValueString($_POST['tmpproductboard'], "text"),
                       GetSQLValueString($_POST['tmpproductboardicon'], "text"),
                       GetSQLValueString($_POST['tmpproductboardfontcolor'], "text"),
                       GetSQLValueString($_POST['tmpprojectboard'], "text"),
                       GetSQLValueString($_POST['tmpprojectboardicon'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}


$colname_RecordTmp = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordTmp = $_GET['id_edit'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmp = sprintf("SELECT * FROM demo_tmp WHERE id = %s", GetSQLValueString($colname_RecordTmp, "int"));
$RecordTmp = mysqli_query($DB_Conn, $query_RecordTmp) or die(mysqli_error($DB_Conn));
$row_RecordTmp = mysqli_fetch_assoc($RecordTmp);
$totalRows_RecordTmp = mysqli_num_rows($RecordTmp);

$coluserid_RecordTmpBg = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpBg = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpBg = sprintf("SELECT TmpBg FROM demo_setting_fr WHERE userid=%s", GetSQLValueString($coluserid_RecordTmpBg, "int"));
$RecordTmpBg = mysqli_query($DB_Conn, $query_RecordTmpBg) or die(mysqli_error($DB_Conn));
$row_RecordTmpBg = mysqli_fetch_assoc($RecordTmpBg);
$totalRows_RecordTmpBg = mysqli_num_rows($RecordTmpBg);
?>

<?php require_once("inc_setting.php"); ?>
<?php require_once("inc_permission.php"); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php //$startTime = getMicroTime(); //页面开头定义：?>
<?php require_once("inc_lang.php"); // 取得目前語系?>
<?php require_once("inc_mdname.php"); // 取得模組名稱?>
<?php require_once('upload_get_admin.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" /> 
<meta name="DESCRIPTION" content="" />
<meta name ="author" content="富視網科技網頁設計" />  
<meta name="designer" content="富視網科技網頁設計" />
<meta name="abstract" content="富視網科技網頁設計" />
<meta name="publisher" content="富視網科技網頁設計" />
<meta name="copyright" content="富視網科技網頁設計" />
<meta name="robots" content="noindex,nofollow" />
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
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script> 
<script src="../SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryData.js" type="text/javascript">/*此檔案必須在jquery之前執行*/</script>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.abgne-minwt.divalign.js"> // Div自動對齊(齊左齊右齊上齊下) malign:left、right  mvalign:top、bottom div區塊中加入</script>
<script type="text/javascript" src="js/jquery.miniColors.min.js">/*顏色選擇*/</script>
<link type="text/css" rel="stylesheet" href="css/jquery.miniColors.css" />
<link rel="stylesheet" type="text/css" href="css/jQuery-Tags-Input/jquery.tagsinput.css" />
<script type="text/javascript" src="js/jQuery-Tags-Input/jquery.tagsinput.min.js"></script>
<script type="text/javascript">
$(function(){$("#SiteKeyWord,#skeyword").tagsInput({width:"auto",defaultText:"\u52a0\u5165\u95dc\u9375\u5b57"})});
</script>
<script type="text/javascript" src="js/jquery.hint.js"></script>
<style type="text/css">
	input.blur {color: #999;}
</style>
<script type="text/javascript">
	$(function(){$("input[title!='']").hint();}); // data-original-title="?"
</script>
<script type="text/javascript" src="../js/selectboxes.js">/*連動選單*/</script>
<script language="javascript" src="../js/jquery.jeditable.js">/*原地編輯*/</script>
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
<script type='text/javascript' src='js/vertical-accordion-menu/jquery.cookie.js'></script>
<script type='text/javascript' src='js/vertical-accordion-menu/jquery.hoverIntent.minified.js'></script>
<script type='text/javascript' src='js/vertical-accordion-menu/jquery.dcjqaccordion.2.7.min.js'></script> 
<link href="css/vertical-accordion-menu/skins/grey.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
$(document).ready(function(a){a("#accordion-2").dcAccordion({eventType:"click",autoClose:!1,saveState:!0,disableLink:!0,speed:"fast",classActive:"active",showCount:!1})});</script>
<!-- jquery-vertical-accordion-menu END-->
<script type="text/javascript">
$.editable.addInputType("datepicker",{element:function(){var a=$('<input class="input" />');a.attr("readonly","readonly");$(this).append(a);return a},plugin:function(){$("input",this).datepicker({changeMoneth:!0,changeYear:!0,dateFormat:"yy-mm-dd"})}});
</script> 
<script type="text/javascript" src="../js/jquery.corners.min.js"></script>
<script language=javascript src="js/address.js"></script><!--引入郵遞區號.js檔案-->
<script type="text/javascript" src="../js/iframe.js"></script>
<script type="text/javascript" src="../js/fontsizer.jquery.js"></script>
<script src="../js/jquery.d.checkbox.min.js"></script> 
<script>
$(document).ready(function(){$(":checkbox").d_checkbox();$(":radio").d_radio()});
</script>
<script type="text/javascript">
$(document).ready( function(){
  $('.rounded').corners();
});</script>
<!-- [ Sort Table ] -->
<script language="javascript" src="../js/jquery.tablesorter.min.js"></script>
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
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="../css/jquery.d.checkbox.css"></link>
<link rel="stylesheet" href="../css/fontsizer.css" type="text/css" />
<link type="text/css" href="../css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />

<style type="text/css">
.tbutt{float:left; padding:5px; background-color:#666; color:#FFF; margin-right:5px; margin-left:0px; margin-top:0px; margin-bottom:10px}
.button_a{display:inline-block; border-width:1px 0; border-color:#BBB; border-style:solid; vertical-align:middle; text-decoration:none; color:#333}
.button_b{float:left; background:#e3e3e3; border-width:0 1px; border-color:#BBB; border-style:solid; margin:0 -1px; position:relative}
.button_c{display:block; line-height:0.6em; background:#f9f9f9; border-bottom:2px solid #eee}
.button_d{display:block; padding:0.1em 0.6em; margin-top:-0.6em; cursor:pointer}
.button_a:hover{border-color:#999; text-decoration:none}
.button_a:hover .button_b{border-color:#999; text-decoration:none}
#apDiv_config{position:fixed; width:230px; height:115px; z-index:1; float:right; right:0px; top:60px}
#wrapper_config div #apDiv_config div span a{color:#1C590D; font-size:9px}
#v_out_wrp_c{width:980px; border:#CCC dotted 1px; margin-left:auto; margin-right:auto; color:#090}
#v_out_wrp{width:1000px; border:#CCC dotted 1px; margin-left:auto; margin-right:auto;}
.v_out_wrp_font{color:#CCC; font-size:30px; font-weight:bolder; padding:10px}
#v_out_wrp:hover{border:1px dotted #C30}
.v_out_wrp_bk{float:right; margin-right:5px; margin-top:5px; padding:5px; border:#CCC dotted 1px; height:75px}
#v_wrp{width:600px; margin-left:auto; margin-right:auto; margin-top:100px; border:#CCC dotted 1px; position:relative; padding-right:20px; padding-bottom:20px; padding-top:20px; padding-left:20px; background-position:center center; background-repeat:no-repeat}
#v_wrp:hover{border:1px dotted #C30}
#v_wrp_header{border:#CCC dotted 1px; margin:5px; position:relative; min-height:200px; background-color:#EEEEEE;}
#v_wrp_header:hover{border:#C30 dotted 1px}
#v_wrp_header_logo{color:#CCC; font-size:30px; font-weight:bolder; padding:10px; position:absolute; left:5px; top:5px; border:#CCC dotted 1px}
#v_wrp_header_logo:hover{border:#C30 dotted 1px}
#v_wrp_header_menu{color:#CCC; font-size:30px; font-weight:bolder; padding:10px; position:absolute; left:110px; top:5px; border:#CCC dotted 1px; width:450px; height:80px}
#v_wrp_header_menu:hover{border:#C30 dotted 1px}
#v_wrp_banner{border:#CCC dotted 1px; margin:5px; position:relative; min-height:100px;}
#v_wrp_banner:hover{border:#C30 dotted 1px}
#v_wrp_l_column{border:#CCC dotted 1px; margin:5px; float:left; width:200px; position:relative; min-height:700px}
#v_wrp_l_column:hover{border:#C30 dotted 1px}
.v_wrp_l_column_board_style{border:1px #CCC dotted; position:relative; margin:5px}
#v_wrp_l_column_wrp_board_style:hover .v_wrp_l_column_board_style{border:#C30 dotted 1px}
#v_wrp_l_column_menu_style{border:1px #CCC dotted; position:relative; margin:5px; height:210px}
#v_wrp_l_column_menu_style:hover{border:#C30 dotted 1px}
#v_wrp_middle{border:#CCC dotted 1px; margin:5px; margin-left:5px; position:relative; min-height:700px}
#v_wrp_middle:hover{border:#C30 dotted 1px}
#v_wrp_middle_title_sicon{color:#CCC; font-size:30px; font-weight:bolder; padding:10px; position:absolute; left:5px; top:5px; border:#CCC dotted 1px; width:150px; height:75px}
#v_wrp_middle_title_sicon:hover{border:#C30 dotted 1px}
#v_wrp_middle_title{border:#CCC dotted 1px; margin:5px; position:relative; min-height:160px}
#v_wrp_middle_title:hover{border:#C30 dotted 1px}
#v_wrp_middle_content{border:#CCC dotted 1px; margin:5px; position:relative; min-height:300px}
#v_wrp_middle_content:hover{border:#C30 dotted 1px}
#v_wrp_footer{border:#CCC dotted 1px; margin:5px; clear:both; position:relative; min-height:100px;background-color:#EEEEEE;}
#v_wrp_footer:hover{border:#C30 dotted 1px}
#v_wrp_md{width:600px; margin-left:auto; margin-right:auto; margin-top:10px; margin-bottom:100px; border:#CCC dotted 1px; position:relative; padding-right:20px; padding-bottom:20px; padding-top:5px; padding-left:20px; background-position:center center; background-repeat:no-repeat; height:250px}
.v_md{border:#CCC dotted 1px; height:80px; width:70px; padding:5px; text-align:center; margin-left:5px; margin-top:5px; float:left}
.v_md:hover{border:#C30 dotted 1px}
</style>
<script type="text/javascript">
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
<script type="text/javascript">
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
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
<div style="padding:10px; margin:10px; position:relative; min-width:1000px;" id="wrapper_config">
  <div style="background-color:#FFFFFF; padding:5px; border: 1px solid #CCC; min-height:500px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">樣板設定 [<?php echo $langname; ?>編輯介面]</font></strong></h5></td>
            <td align="right"><div>
                  <a href="tmp_config_home.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>" class="button_a">
                     <span class="button_b">
                         <span class="button_c"> </span>
                         <span class="button_d">回上一頁</span>
                      </span>
                   </a>
               </div></td>
      </tr>
    </table>
	<form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form_Tmp" id="form_Tmp">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
    <tr>
      <td>
     
       <div id="v_out_wrp">
       	<span class="v_out_wrp_font">外框架</span>
        <!--獨立背景--><!--獨立背景--><!--獨立背景-->
        <div id="v_wrp"><!--獨立外框--><!--獨立背景--><!--獨立背景-->
          <div style="color: #CCC; font-size: 30px; font-weight: bolder; padding: 10px; position: absolute; left: -36px; top: -41px;">主框架</div>
        	<div id="v_wrp_header">
            <!--獨立背景-->
            <div id="v_wrp_header_logo"><br />
            	  Logo</div>
                <div id="v_wrp_header_menu"><!--獨立選單-->
                選單</div>
                <span style="color: #CCC; font-size: 30px; font-weight: bolder; padding: 10px; position: absolute; right: 5px; bottom: 5px;"><br />
                頁首區塊</span>
            </div>
            <div id="v_wrp_banner">
            	<span style="color: #CCC; font-size:30px; font-weight:bolder; padding:10px; position: absolute; right: 5px; bottom: 5px;"><br />
            	<span style="font-size:16px;"><a href="tmp_config_homeboard_banner.php?id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" data-original-title="您可在此設定橫幅的類型" data-toggle="tooltip" data-placement="right">(更多設定)</a></span><br />
橫幅區塊</span>
            </div>
        	<div style="position:relative; float:right; width:100%; margin-left:-215px; margin-right:0px;">
        	  <div id="v_wrp_middle">
                <div class="v_md"><img src="images/mt_060.png" width="60" height="60" /><br />
          		<a href="#" data-original-title="您可在此加入您要放置的功能，並且可對其做排序。" data-toggle="tooltip" data-placement="right">功能區塊</a>
                <div style="position: absolute; top: 64px; left: 81px;">
                <?php if ($LangChooseEN == '1') { ?>
                <span class = "InnerPage"><a href="tmp_config_homeboard005_block_en.php?id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;lang=en"  data-original-title="英文設定" data-toggle="tooltip" data-placement="top"><i class="fa fa-tachometer"></i>英</a></span>
                <?php } ?>
                <?php if ($LangChooseZHCN == '1') { ?>
                <span class = "InnerPage"><a href="tmp_config_homeboard005_block_cn.php?id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;lang=zh-cn"  data-original-title="簡體設定" data-toggle="tooltip" data-placement="top"><i class="fa fa-tachometer"></i>簡</a></span>
                <?php } ?>
                <span class = "InnerPage"><a href="tmp_config_homeboard005_block.php?id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;lang=zh-tw"  data-original-title="繁體設定" data-toggle="tooltip" data-placement="top"><i class="fa fa-tachometer"></i>繁</a></span>
                </div>
            </div><span style="color: #CCC; font-size:30px; font-weight:bolder; padding:10px; position: absolute; right: 5px; bottom: 5px;"><br />
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
        <br />
       </div></td>
      </tr>
    <tr>
      <td></td>
      </tr>
   
    
  </table>
  <input type="hidden" name="MM_update" value="form_Tmp" />
	</form>
  </div>
  
</div>

<div id="footer_config"></div>
<script type="text/javascript">
$(document).ready(function(){$(".color-picker").miniColors({letterCase:"uppercase"});$("#randomize").click(function(){$(".color-picker").each(function(){$(this).miniColors("value","#"+Math.floor(16777215*Math.random()).toString(16))})})});
</script>
</body>
</html>
<?php
mysqli_free_result($RecordTmp);

mysqli_free_result($RecordTmpBg);
?>