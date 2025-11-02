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
?>

<?php require_once("inc_setting.php"); ?>
<?php require_once("inc_permission.php"); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php //$startTime = getMicroTime(); //页面开头定义：?>
<?php require_once("inc_lang.php"); // 取得目前語系?>
<?php require_once("inc_mdname.php"); // 取得模組名稱?>
<?php require_once('upload_get_admin.php'); ?>

<!DOCTYPE html>
<html lang="zh-TW">
<!--<![endif]-->
<head>
<meta charset="utf-8" />
<title>後台管理系統 - <?php echo $row_RecordAccount['name'];?></title> 
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<meta name="robots" content="noindex,nofollow" />
<meta content="" name="description" />
<meta content="" name="author" />
<link rel='icon' href='favicon.ico' type='image/x-icon' />
<link rel='bookmark' href='favicon.ico' type='image/x-icon' />
<link rel='shortcut icon' href='favicon.ico' type='image/x-icon' />
<!-- ================== BEGIN BASE CSS STYLE ================== -->
<?php //$SiteBaseAdminPath="admin_color/"; ?>
<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />-->
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/flag-icon/css/flag-icon.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/jquery-ui-timepicker-addon/dist/jquery-ui-timepicker-addon.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/font-awesome/5.6/css/fontawesome-all.min.css" rel="stylesheet" />
<link href="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>assets/plugins/glyphicon/css/glyphicon.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/animate/animate.min.css" rel="stylesheet" />

<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/css/default/style.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/css/default/style-responsive.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/css/default/theme/default.min.css" rel="stylesheet" id="theme" />
<!-- ================== END BASE CSS STYLE ================== -->

<!-- ================== BEGIN NECESSARY ALL PAGE JS ================== -->
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/intro-js/introjs.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/parsley/src/parsley.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/jquery-smart-wizard/src/css/smart_wizard.min.css" rel="stylesheet" />
<!-- ================== END NECESSARY ALL PAGE JS ================== --> 

<!-- ================== BEGIN FORM CSS STYLE ================== -->
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-fileinput/css/fileinput.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap3-editable/inputs-ext/bootstrap-datetimepicker/css/datetimepicker.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<!-- ================== END FORM CSS STYLE ================== -->

<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<!-- ================== END PAGE LEVEL STYLE ================== -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/pace/pace.min.js"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN BASE JS ================== --> 
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script> 
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/jquery-ui-timepicker-addon/dist/jquery-ui-timepicker-addon.min.js"></script> 
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/jquery-ui-timepicker-addon/dist/jquery-ui-sliderAccess.js"></script> 
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>  
<!--[if lt IE 9]>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/crossbrowserjs/html5shiv.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/crossbrowserjs/respond.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/crossbrowserjs/excanvas.min.js"></script>
<![endif]--> 
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script> 
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/js-cookie/js.cookie.min.js"></script> 
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/js/theme/default.min.js"></script> 
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/js/apps.min.js"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN NECESSARY ALL PAGE JS ================== -->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/parsley/dist/parsley.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/parsley/dist/i18n/zh_tw.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/jquery-smart-wizard/src/js/jquery.smartWizard.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/intro-js/intro.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/imgLiquid/js/imgLiquid-min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@7.1.0/dist/promise.min.js"></script>
<!-- ================== END NECESSARY ALL PAGE JS ================== --> 
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
#v_out_wrp_c{width:1000px; border:#CCC dashed 1px; margin-left:auto; margin-right:auto; color:#090}
#v_out_wrp{width:1000px; border:#CCC dashed 1px; margin-left:auto; margin-right:auto;}
.v_out_wrp_font{color:#CCC; font-size:30px; font-weight:bolder; padding:10px}
#v_out_wrp:hover{border:1px dashed #C30}
.v_out_wrp_bk{float:right; margin-right:5px; margin-top:5px; padding:5px; border:#CCC dashed 1px; }
#v_wrp{width:600px; margin-left:auto; margin-right:auto; margin-top:100px; border:#CCC dashed 1px; position:relative; padding-right:20px; padding-bottom:20px; padding-top:20px; padding-left:20px; background-position:center center; background-repeat:no-repeat}
#v_wrp:hover{border:1px dashed #C30}
#v_wrp_header{border:#CCC dashed 1px; margin:5px; position:relative; min-height:230px}
#v_wrp_header:hover{border:#C30 dashed 1px}
#v_wrp_header_logo{color:#CCC; font-size:30px; font-weight:bolder; padding:10px; position:absolute; left:5px; top:5px; border:#CCC dashed 1px}
#v_wrp_header_logo:hover{border:#C30 dashed 1px}
#v_wrp_header_menu{color:#CCC; font-size:30px; font-weight:bolder; padding:10px; position:absolute; left:110px; top:5px; border:#CCC dashed 1px; width:430px; height:115px}
#v_wrp_header_menu:hover{border:#C30 dashed 1px}
#v_wrp_banner{border:#CCC dashed 1px; margin:5px; position:relative; min-height:100px}
#v_wrp_banner:hover{border:#C30 dashed 1px}
#v_wrp_l_column{border:#CCC dotted 1px;margin:5px;float:right;width:200px;position:relative;min-height:200px}
#v_wrp_l_column:hover{border:#C30 dashed 1px}
.v_wrp_l_column_board_style{border:1px #CCC dashed; position:relative; margin:5px}
#v_wrp_l_column_wrp_board_style:hover .v_wrp_l_column_board_style{border:#C30 dashed 1px}
#v_wrp_l_column_menu_style{border:1px #CCC dashed; position:relative; margin:5px; height:210px}
#v_wrp_l_column_menu_style:hover{border:#C30 dashed 1px}
#v_wrp_middle{border:#CCC dotted 1px;margin:5px;margin-right:215px;position:relative;min-height:200px}
#v_wrp_middle:hover{border:#C30 dashed 1px}
#v_wrp_middle_title_sicon{color:#CCC; font-size:30px; font-weight:bolder; padding:10px; position:absolute; left:5px; top:5px; border:#CCC dashed 1px; width:150px; height:85px}
#v_wrp_middle_title_sicon:hover{border:#C30 dashed 1px}
#v_wrp_middle_title{border:#CCC dashed 1px; margin:5px; position:relative; min-height:160px}
#v_wrp_middle_title:hover{border:#C30 dashed 1px}
#v_wrp_middle_viewline{border:#CCC dashed 1px; margin:5px; position:relative; min-height:35px}
#v_wrp_middle_viewline:hover{border:#C30 dashed 1px}
#v_wrp_middle_content{border:#CCC dashed 1px; margin:5px; position:relative; min-height:300px}
#v_wrp_middle_content:hover{border:#C30 dashed 1px}
#v_wrp_footer{border:#CCC dashed 1px; margin:5px; clear:both; position:relative; min-height:120px}
#v_wrp_footer:hover{border:#C30 dashed 1px}
#v_wrp_md{width:600px; margin-left:auto; margin-right:auto; margin-top:10px; margin-bottom:100px; border:#CCC dashed 1px; position:relative; padding-right:20px; padding-bottom:20px; padding-top:5px; padding-left:20px; background-position:center center; background-repeat:no-repeat; min-height:250px}
#v_wrp_sty{width:600px; margin-left:auto; margin-right:auto; margin-top:10px; margin-bottom:10px; border:#CCC dashed 1px; position:relative; padding-right:20px; padding-bottom:20px; padding-top:5px; padding-left:20px; background-position:center center; background-repeat:no-repeat; min-height:250px}
.v_md{border:#CCC dashed 1px; min-width:100px; padding:5px; text-align:center; margin-left:5px; margin-top:5px; float:left}
.v_md:hover{border:#C30 dashed 1px}
.InnerPage_design{float:right; margin-right:2px; margin-top:5px; margin-bottom:5px}
.InnerPage_design a{font-weight:400;-moz-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;border:1px solid #d83526;text-decoration:none;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fa665a',endColorstr='#d34639');background:0 color-stop(100%,#d34639) );background-color:#fa665a;color:#fff;display:inline-block;text-shadow:1px 1px 0 #98231a;-webkit-box-shadow:inset 1px 1px 0 0 #fab3ad;-moz-box-shadow:inset 1px 1px 0 0 #fab3ad;box-shadow:inset 1px 1px 0 0 #fab3ad;padding:0px 4px}
.InnerPage_design a:hover, .InnerPage_design a:focus{filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#d34639',endColorstr='#fa665a');background:0 color-stop(100%,#fa665a) );background-color:#d34639}
.InnerPage_design a:active{ position:relative;top:1px}
</style>
</head>
<body>


<!-- begin #page-loader -->
<!--<div id="page-loader" class="fade show"><span class="spinner"></span></div></div>-->
<!-- end #page-loader --> 
<!-- begin #page-container -->
<div id="page-container" class="page-header-fixed page-sidebar-fixed page-without-sidebar p-0">
  <!-- begin #header -->
  
  <!-- end #header --> 
        
  <!-- begin #content -->
  <div id="content_full" class="content" style="padding:15px">
    <div class="row">
    <div class="col-lg-12">
      
      <div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 首頁樣板 <small>設定</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="tmp_config_home.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>" data-original-title="" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm"><i class="fa fa-reply fa-fw"></i> 上一頁</a></div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 修改資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <?php if($row_RecordTmp['userid'] == $w_userid) { ?> 
  <div class="table-responsive">
<div style="padding:10px; margin:10px; position:relative; min-width:1000px;" id="wrapper_config">
  <div>
    
	<form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form_Tmp" id="form_Tmp">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
    <tr>
      <td>
     
       <div id="v_out_wrp">
       	<span class="v_out_wrp_font">外框架</span>
        <!--獨立背景--><!--獨立背景--><!--獨立背景-->
        <div id="v_wrp">
        <span style="position: absolute; top: 380px; right: -69px;">
        	<img src="images/z_line_g.png" width="101" height="8" /> 
        </span>
        <!--獨立外框-->
        <span style="margin-right: 5px; margin-top: 5px; padding: 5px; border: #CCC dotted 1px; position: absolute; top: 328px; right: -137px;">
        <iframe src="tmp_config_board_view.php?id=<?php echo $row_RecordTmp['tmphomeboard']  ?>" width="102" marginwidth="0" height="102" marginheight="0" scrolling="no" frameborder="0"></iframe><br />
        <a href="tmphomeboard_home.php?id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;lang=<?php echo $_GET['lang']; ?>&amp;id=<?php echo $row_RecordTmp['id']; ?>" data-original-title="選擇您要更換的外框" data-toggle="tooltip" data-placement="right" class="btn btn-primary btn-xs btn-block">外框選擇</a>
        </span>
        <!--獨立背景--><!--獨立背景-->
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
            	<span style="font-size:16px;"><a href="tmp_config_homeboard_banner.php?id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" data-original-title="您可在此設定橫幅的類型" data-toggle="tooltip" data-placement="right" class="btn btn-info btn-circle btn-xs">更多設定 <i class="fa fa-chevron-circle-right"></i></a></span><br />
橫幅區塊</span>
            </div>
            <div style="position:relative; float:right; width:100%; margin-left:-215px; margin-right:0px;">
            
            <div id="v_wrp_l_column">
              <div class="v_md"><img src="images/mt_054.png" width="60" height="60" /><br />
                <a href="#" data-original-title="您可在此加入您要的內容，例如：圖片、Youtube影片、文字等等。" data-toggle="tooltip" data-placement="right" class="btn btn-white btn-xs btn-block disabled">自訂內容</a>
                <?php if ($LangChooseEN == '1' || $defaultlang == "en") { ?>
                <a href="tmp_config_home_content_small.php?id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;lang=en" class="btn btn-primary btn-xs" data-original-title="英文設定" data-toggle="tooltip" data-placement="top">英</a>
                <?php } ?>
                <?php if ($LangChooseZHCN == '1' || $defaultlang == "zh-cn") { ?>
                <a href="tmp_config_home_content_small.php?id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;lang=zh-cn" class="btn btn-primary btn-xs" data-original-title="簡體設定" data-toggle="tooltip" data-placement="top">簡</a>
                <?php } ?>
                <?php if ($LangChooseZHTW == '1' || $defaultlang == "zh-tw") { ?>
                <a href="tmp_config_home_content_small.php?id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;lang=zh-tw" class="btn btn-primary btn-xs" data-original-title="繁體設定" data-toggle="tooltip" data-placement="top">繁</a>
                <?php } ?>
                <?php if ($LangChooseJP == '1' || $defaultlang == "jp") { ?>
                <a href="tmp_config_home_content_small.php?id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;lang=jp" class="btn btn-primary btn-xs" data-original-title="日文設定" data-toggle="tooltip" data-placement="top">日</a>
                <?php } ?>
                <?php if ($LangChooseKR == '1' || $defaultlang == "kr") { ?>
                <a href="tmp_config_home_content_small.php?id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;lang=kr" class="btn btn-primary btn-xs" data-original-title="韓文設定" data-toggle="tooltip" data-placement="top">韓</a>
                <?php } ?>
                <?php if ($LangChooseSP == '1' || $defaultlang == "sp") { ?>
                <a href="tmp_config_home_content_small.php?id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;lang=sp" class="btn btn-primary btn-xs" data-original-title="西班牙語設定" data-toggle="tooltip" data-placement="top">西</a>
                <?php } ?>
              </div><!--獨立背景-->
            <span style="color: #CCC; font-size: 30px; font-weight: bolder; padding: 10px; position: absolute; right: 0px; bottom: 0px;">
            	內容區塊</span>
            </div>
            <div id="v_wrp_middle">
              <div class="v_md"><img src="images/mt_001.png" width="60" height="60" /><br />
          		<a href="#" data-original-title="" data-toggle="tooltip" data-placement="right" class="btn btn-white btn-xs btn-block disabled"><?php echo $ModuleName['News']; ?></a></div><span style="color: #CCC; font-size:30px; font-weight:bolder; padding:10px; position: absolute; right: 5px; bottom: 5px;"><br />
            	模組區塊</span>
                <!--獨立背景-->
            </div>
            
            </div>
            <div id="v_wrp_footer">
              
              <span style="color: #CCC; font-size:30px; font-weight:bolder; padding:10px; position: absolute; right: 5px; bottom: 5px;"><a href="tmp_config_home_wrp_m_column.php?id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;board=<?php echo $_GET['board']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" data-original-title="區塊標題顯示" data-toggle="tooltip" data-placement="right" class="btn btn-info btn-circle btn-xs">更多設定 <i class="fa fa-chevron-circle-right"></i></a><br />
            	中央區塊</span>
                <!--獨立背景-->
        </div>
            
            
            <div id="v_wrp_footer">
            <!--獨立背景-->
            <span style="color: #CCC; font-size:30px; font-weight:bolder; padding:10px;position: absolute; right: 5px; bottom: 5px;"><br />
            	頁尾區塊</span>
            </div>
      </div>
        <br />
       </div>
       
      </td>
      </tr>
    <tr>
      <td></td>
      </tr>
   
    
  </table>
  <input type="hidden" name="MM_update" value="form_Tmp" />
	</form>
  </div>
  
</div>
</div>
<?php } ?>
  
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->
      
    </div>
    </div>
  </div>
  <!-- end #content --> 
  
  <!-- begin scroll to top btn --> 
  <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a> 
  <!-- end scroll to top btn --> 
</div>
<!-- end page container -->

<!-- ================== BEGIN FORM LEVEL JS ================== -->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-fileinput/js/plugins/piexif.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-fileinput/js/fileinput.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-fileinput/js/locales/zh-TW.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/selectboxes/selectboxes.js"></script>
<!--<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-validator/validator.min.js"></script>-->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/select2/dist/js/select2.min.js"></script>
<!-- ================== END FORM LEVEL JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<!-- ================== END PAGE LEVEL JS ================== --> 

<script>
	$(document).ready(function() {
		App.init();
		$(".select2").select2({// 隐藏搜索框 
      minimumResultsForSearch: Infinity});
		//Highlight.init();
		//TableManageDefault.init();
		//Dashboard.init();
		//FormPlugins.init();
	});
</script>

<?php if(isset($_GET['GP_upload']) && $_GET['GP_upload'] == true) { ?>
<script type="text/javascript">
swal({ title: "資料修改成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>
</body>
</html>
<?php
mysqli_free_result($RecordTmp);
?>