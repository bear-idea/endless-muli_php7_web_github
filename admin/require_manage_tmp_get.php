<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once("../inc/inc_function.php"); ?>
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
  $updateSQL = sprintf("UPDATE demo_setting_fr SET MSTmpSelect=%s WHERE userid=%s",
                       GetSQLValueString($_POST['MSTmpSelect'], "int"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "Form_Get")) {
  $insertSQL = sprintf("INSERT INTO demo_tmp (userid, name, title, homeselect, homestyle, tmpwebwidth, tmpwebwidthunit, tmpfbfanselect, tmpfbfanbkcolor, tmpfbfanboardcolor, author, type, pic, content, postdate, indicate, sdescription, skeyword, pushtop, tmplogo, tmplogoid, tmpmainmenu, tmpmainmenuindicate, tmpsubmainmenuindicate, tmpleftmenu, tmpblock, tmpshowblockname, tmpdftmenu_x, tmpdftmenu_y, tmppicmenu_x, tmppicmenu_y, tmppicmenu_style, tmpbannerpic, tmpbannerpicwidth, tmpbannerpicheight, tmpautobanner1, tmpautobanner2, tmpautobanner3, tmpautobanner4, tmpautobanner5, tmpselectbannerid, tmphomeenterselect, tmphomeenterdefaultpic, tmphomeenterpic, tmphomeenterpicsource, tmplogowidth, tmplogoheight, tmplogomargintop, tmplogomarginleft, tmphomelogomargintop, tmphomelogomarginleft, tmphomeentermarginbottom, tmphomeentermarginright, tmpwordcolor, tmpwordsize, tmplink, tmplinkvisit, tmplinkhover, tmpheaderminheight, tmptitlebackground, tmptitlelinebackground, tmpleftminheight, tmpmiddleminheight, tmprightminheight, tmpfooterminheight, tmpbanner, tmpdfmenucolor, tmpmenuselect, tmpbodyselect, tmpmenulimit, tmpbodybackground, tmpanimebackground, tmpbottombackground, tmpheaderbackground, tmpwrpbackground, tmpleftbackground, tmprightbackground, tmpmiddlebackground, tmpfooterbackground, tmphomeboard, tmpwrpboard, tmpbannerboard, tmpheaderboard, tmpleftboard, tmprightboard, tmptitleboard, tmpmiddleboard, tmpfooterboard, tmpmeger_t_m, tmpheaderpaddingtop, tmpheaderpaddingbttom, tmpheaderpaddingleft, tmpheaderpaddingright, tmpbannerpaddingtop, tmpbannerpaddingbttom, tmpbannerpaddingleft, tmpbannerpaddingright, tmpleftpaddingtop, tmpleftpaddingbttom, tmpleftpaddingleft, tmpleftpaddingright, tmprightpaddingtop, tmprightpaddingbttom, tmprightpaddingleft, tmprightpaddingright, tmpmiddlepaddingtop, tmpmiddlepaddingbttom, tmpmiddlepaddingleft, tmpmiddlepaddingright, tmp_middle_title_font_color, tmp_middle_title_x, tmp_middle_title_height, tmpfooterpaddingtop, tmpfooterpaddingbttom, tmpfooterpaddingleft, tmpfooterpaddingright, tmpfooterfontcolor, tmpproductboard, tmpproductboardicon, tmpproductboardfontcolor, tmpproductviewcolumn, tmpnewsoddbackground, tmpnewsevenbackground, tmpnewstopbackground, tmpprojectboard, tmpprojectboardicon, tmpactivitiesboard, tmpactivitiesboardicon, tmpfrilinkboard, tmpfrilinkboardicon, tmporgboard, tmporgboardicon, tmpsponsorboard, tmpsponsorboardicon, tmppartnerboard, tmppartnerboardicon, tmpartlistboard, tmpartlistboardicon, tmppublishindicate, notes1, notes2, sortid, lang, webname, webnameorigin) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['userid'], "int"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['homeselect'], "int"),
					   GetSQLValueString($_POST['homestyle'], "text"),
                       GetSQLValueString($_POST['tmpwebwidth'], "int"),
                       GetSQLValueString($_POST['tmpwebwidthunit'], "text"),
                       GetSQLValueString($_POST['tmpfbfanselect'], "int"),
                       GetSQLValueString($_POST['tmpfbfanbkcolor'], "text"),
                       GetSQLValueString($_POST['tmpfbfanboardcolor'], "text"),
                       GetSQLValueString($_POST['author'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['pic'], "text"),
                       GetSQLValueString($_POST['content'], "text"),
                       GetSQLValueString($_POST['postdate'], "date"),
                       GetSQLValueString($_POST['indicate'], "int"),
                       GetSQLValueString($_POST['sdescription'], "text"),
                       GetSQLValueString($_POST['skeyword'], "text"),
                       GetSQLValueString($_POST['pushtop'], "int"),
                       GetSQLValueString($_POST['tmplogo'], "text"),
                       GetSQLValueString($_POST['tmplogoid'], "int"),
                       GetSQLValueString($_POST['tmpmainmenu'], "int"),
                       GetSQLValueString($_POST['tmpmainmenuindicate'], "int"),
					   GetSQLValueString($_POST['tmpsubmainmenuindicate'], "int"),
                       GetSQLValueString($_POST['tmpleftmenu'], "int"),
                       GetSQLValueString($_POST['tmpblock'], "int"),
                       GetSQLValueString($_POST['tmpshowblockname'], "int"),
                       GetSQLValueString($_POST['tmpdftmenu_x'], "int"),
                       GetSQLValueString($_POST['tmpdftmenu_y'], "int"),
                       GetSQLValueString($_POST['tmppicmenu_x'], "int"),
                       GetSQLValueString($_POST['tmppicmenu_y'], "int"),
                       GetSQLValueString($_POST['tmppicmenu_style'], "text"),
                       GetSQLValueString($_POST['tmpbannerpic'], "text"),
                       GetSQLValueString($_POST['tmpbannerpicwidth'], "int"),
                       GetSQLValueString($_POST['tmpbannerpicheight'], "int"),
                       GetSQLValueString($_POST['tmpautobanner1'], "text"),
                       GetSQLValueString($_POST['tmpautobanner2'], "text"),
                       GetSQLValueString($_POST['tmpautobanner3'], "text"),
                       GetSQLValueString($_POST['tmpautobanner4'], "text"),
                       GetSQLValueString($_POST['tmpautobanner5'], "text"),
					   GetSQLValueString($_POST['tmpselectbannerid'], "int"),
					   GetSQLValueString($_POST['tmphomeenterselect'], "int"),
					   GetSQLValueString($_POST['tmphomeenterdefaultpic'], "text"),
					   GetSQLValueString($_POST['tmphomeenterpic'], "text"),
					   GetSQLValueString($_POST['tmphomeenterpicsource'], "text"),
                       GetSQLValueString($_POST['tmplogowidth'], "int"),
                       GetSQLValueString($_POST['tmplogoheight'], "int"),
                       GetSQLValueString($_POST['tmplogomargintop'], "int"),
                       GetSQLValueString($_POST['tmplogomarginleft'], "int"),
					   GetSQLValueString($_POST['tmphomelogomargintop'], "int"),
                       GetSQLValueString($_POST['tmphomelogomarginleft'], "int"),
					   GetSQLValueString($_POST['tmphomeentermarginbottom'], "int"),
                       GetSQLValueString($_POST['tmphomeentermarginright'], "int"),
                       GetSQLValueString($_POST['tmpwordcolor'], "text"),
                       GetSQLValueString($_POST['tmpwordsize'], "text"),
                       GetSQLValueString($_POST['tmplink'], "text"),
                       GetSQLValueString($_POST['tmplinkvisit'], "text"),
                       GetSQLValueString($_POST['tmplinkhover'], "text"),
                       GetSQLValueString($_POST['tmpheaderminheight'], "int"),
                       GetSQLValueString($_POST['tmptitlebackground'], "text"),
                       GetSQLValueString($_POST['tmptitlelinebackground'], "text"),
                       GetSQLValueString($_POST['tmpleftminheight'], "int"),
                       GetSQLValueString($_POST['tmpmiddleminheight'], "int"),
                       GetSQLValueString($_POST['tmprightminheight'], "int"),
                       GetSQLValueString($_POST['tmpfooterminheight'], "int"),
                       GetSQLValueString($_POST['tmpbanner'], "int"),
                       GetSQLValueString($_POST['tmpdfmenucolor'], "text"),
                       GetSQLValueString($_POST['tmpmenuselect'], "int"),
                       GetSQLValueString($_POST['tmpbodyselect'], "int"),
                       GetSQLValueString($_POST['tmpmenulimit'], "int"),
                       GetSQLValueString($_POST['tmpbodybackground'], "text"),
                       GetSQLValueString($_POST['tmpanimebackground'], "text"),
                       GetSQLValueString($_POST['tmpbottombackground'], "text"),
                       GetSQLValueString($_POST['tmpheaderbackground'], "text"),
                       GetSQLValueString($_POST['tmpwrpbackground'], "text"),
                       GetSQLValueString($_POST['tmpleftbackground'], "text"),
                       GetSQLValueString($_POST['tmprightbackground'], "text"),
                       GetSQLValueString($_POST['tmpmiddlebackground'], "text"),
                       GetSQLValueString($_POST['tmpfooterbackground'], "text"),
					   GetSQLValueString($_POST['tmphomeboard'], "text"),
                       GetSQLValueString($_POST['tmpwrpboard'], "text"),
                       GetSQLValueString($_POST['tmpbannerboard'], "text"),
                       GetSQLValueString($_POST['tmpheaderboard'], "text"),
                       GetSQLValueString($_POST['tmpleftboard'], "text"),
                       GetSQLValueString($_POST['tmprightboard'], "text"),
                       GetSQLValueString($_POST['tmptitleboard'], "text"),
                       GetSQLValueString($_POST['tmpmiddleboard'], "text"),
                       GetSQLValueString($_POST['tmpfooterboard'], "text"),
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
                       GetSQLValueString($_POST['tmp_middle_title_font_color'], "text"),
                       GetSQLValueString($_POST['tmp_middle_title_x'], "int"),
                       GetSQLValueString($_POST['tmp_middle_title_height'], "int"),
                       GetSQLValueString($_POST['tmpfooterpaddingtop'], "int"),
                       GetSQLValueString($_POST['tmpfooterpaddingbttom'], "int"),
                       GetSQLValueString($_POST['tmpfooterpaddingleft'], "int"),
                       GetSQLValueString($_POST['tmpfooterpaddingright'], "int"),
                       GetSQLValueString($_POST['tmpfooterfontcolor'], "text"),
                       GetSQLValueString($_POST['tmpproductboard'], "text"),
                       GetSQLValueString($_POST['tmpproductboardicon'], "text"),
                       GetSQLValueString($_POST['tmpproductboardfontcolor'], "text"),
                       GetSQLValueString($_POST['tmpproductviewcolumn'], "int"),
                       GetSQLValueString($_POST['tmpnewsoddbackground'], "text"),
                       GetSQLValueString($_POST['tmpnewsevenbackground'], "text"),
                       GetSQLValueString($_POST['tmpnewstopbackground'], "text"),
                       GetSQLValueString($_POST['tmpprojectboard'], "text"),
                       GetSQLValueString($_POST['tmpprojectboardicon'], "text"),
                       GetSQLValueString($_POST['tmpactivitiesboard'], "text"),
                       GetSQLValueString($_POST['tmpactivitiesboardicon'], "text"),
                       GetSQLValueString($_POST['tmpfrilinkboard'], "text"),
                       GetSQLValueString($_POST['tmpfrilinkboardicon'], "text"),
                       GetSQLValueString($_POST['tmporgboard'], "text"),
                       GetSQLValueString($_POST['tmporgboardicon'], "text"),
                       GetSQLValueString($_POST['tmpsponsorboard'], "text"),
                       GetSQLValueString($_POST['tmpsponsorboardicon'], "text"),
                       GetSQLValueString($_POST['tmppartnerboard'], "text"),
                       GetSQLValueString($_POST['tmppartnerboardicon'], "text"),
                       GetSQLValueString($_POST['tmpartlistboard'], "text"),
                       GetSQLValueString($_POST['tmpartlistboardicon'], "text"),
                       GetSQLValueString($_POST['tmppublishindicate'], "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['notes2'], "text"),
                       GetSQLValueString($_POST['sortid'], "int"),
                       GetSQLValueString($_POST['lang'], "text"),
					   GetSQLValueString($_POST['webname'], "text"),
                       GetSQLValueString($_POST['webnameorigin'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  //echo $last_id = mysqli_insert_id($DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  
  
}

$maxRows_RecordTmp = 30;
$pageNum_RecordTmp = 0;
if (isset($_GET['pageNum_RecordTmp'])) {
  $pageNum_RecordTmp = $_GET['pageNum_RecordTmp'];
}
$startRow_RecordTmp = $pageNum_RecordTmp * $maxRows_RecordTmp;

$coluserid_RecordTmp = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmp = $w_userid;
}

$colname_RecordTmp1 = "board001";
$colname_RecordTmp2 = "board002";
$colname_RecordTmp3 = "board003";
$colname_RecordTmp4 = "board004";
$colname_RecordTmp5 = "board005";
$colname_RecordTmp6 = "board006";
$colname_RecordTmp7 = "board007";
$colname_RecordTmp8 = "board008";
$colname_RecordTmp9 = "board009";
$colname_RecordTmp10 = "board010";

if (isset($_GET['s']) && $_GET['s'] == "mobile") {
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmp = sprintf("SELECT * FROM demo_tmp WHERE (userid=%s || userid=1) && (name=%s || name=%s) ORDER BY sortid ASC, id DESC", GetSQLValueString($coluserid_RecordTmp, "int"), GetSQLValueString($colname_RecordTmp9, "text"), GetSQLValueString($colname_RecordTmp10, "text"));
$query_limit_RecordTmp = sprintf("%s LIMIT %d, %d", $query_RecordTmp, $startRow_RecordTmp, $maxRows_RecordTmp);
$RecordTmp = mysqli_query($DB_Conn, $query_limit_RecordTmp) or die(mysqli_error($DB_Conn));
$row_RecordTmp = mysqli_fetch_assoc($RecordTmp);
}else{
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmp = sprintf("SELECT * FROM demo_tmp WHERE (userid=%s || userid=1) && (name=%s || name=%s || name=%s || name=%s || name=%s || name=%s || name=%s || name=%s) ORDER BY sortid ASC, id DESC", GetSQLValueString($coluserid_RecordTmp, "int"), GetSQLValueString($colname_RecordTmp1, "text"), GetSQLValueString($colname_RecordTmp2, "text"), GetSQLValueString($colname_RecordTmp3, "text"), GetSQLValueString($colname_RecordTmp4, "text"), GetSQLValueString($colname_RecordTmp5, "text"), GetSQLValueString($colname_RecordTmp6, "text"), GetSQLValueString($colname_RecordTmp7, "text"), GetSQLValueString($colname_RecordTmp8, "text"));
$query_limit_RecordTmp = sprintf("%s LIMIT %d, %d", $query_RecordTmp, $startRow_RecordTmp, $maxRows_RecordTmp);
$RecordTmp = mysqli_query($DB_Conn, $query_limit_RecordTmp) or die(mysqli_error($DB_Conn));
$row_RecordTmp = mysqli_fetch_assoc($RecordTmp);
}

if (isset($_GET['totalRows_RecordTmp'])) {
  $totalRows_RecordTmp = $_GET['totalRows_RecordTmp'];
} else {
  $all_RecordTmp = mysqli_query($DB_Conn, $query_RecordTmp);
  $totalRows_RecordTmp = mysqli_num_rows($all_RecordTmp);
}
$totalPages_RecordTmp = ceil($totalRows_RecordTmp/$maxRows_RecordTmp)-1;

if (isset($_POST['Step']) && $_POST['Step'] == '2' && $_POST['MSTmpSelect'] != '') {
$colid_RecordTmpTableName = "-1";
if (isset($_POST['MSTmpSelect'])) {
  $colid_RecordTmpTableName = $_POST['MSTmpSelect'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpTableName = sprintf("SELECT * FROM demo_tmp WHERE id=%s ORDER BY sortid ASC, id DESC", GetSQLValueString($colid_RecordTmpTableName, "int"));
$RecordTmpTableName = mysqli_query($DB_Conn, $query_RecordTmpTableName) or die(mysqli_error($DB_Conn));
$row_RecordTmpTableName = mysqli_fetch_assoc($RecordTmpTableName);
$totalRows_RecordTmpTableName = mysqli_num_rows($RecordTmpTableName);

}

if (isset($_POST['Step']) && ($_POST['Step'] == '3' || $_POST['Step'] == '4')) {
$coluserid_RecordTmpTableName = "-1";
if (isset($_POST['userid'])) {
  $coluserid_RecordTmpTableName = $_POST['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpTableName = sprintf("SELECT * FROM demo_tmp WHERE userid=%s ORDER BY id DESC LIMIT 1", GetSQLValueString($coluserid_RecordTmpTableName, "int"));
$RecordTmpTableName = mysqli_query($DB_Conn, $query_RecordTmpTableName) or die(mysqli_error($DB_Conn));
$row_RecordTmpTableName = mysqli_fetch_assoc($RecordTmpTableName);
$totalRows_RecordTmpTableName = mysqli_num_rows($RecordTmpTableName);

}

/* 取得類別資料 */
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpListType = "SELECT * FROM demo_tmpitem WHERE list_id = 1";
$RecordTmpListType = mysqli_query($DB_Conn, $query_RecordTmpListType) or die(mysqli_error($DB_Conn));
$row_RecordTmpListType = mysqli_fetch_assoc($RecordTmpListType);
$totalRows_RecordTmpListType = mysqli_num_rows($RecordTmpListType);
?>


<!-- ================== BEGIN Datatables CSS ================== -->
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Responsive/css/responsive.dataTables.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap4.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/media/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/RowReorder/css/rowReorder.dataTables.min.css" rel="stylesheet" />
<!--<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Select/css/select.bootstrap.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap4.min.css" rel="stylesheet" />-->
<!-- ================== END Datatables CSS ================== -->

<!-- ================== BEGIN X-Editable CSS ================== -->
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap3-editable/css/bootstrap4-editable.min.css" rel="stylesheet" />
<!-- ================== END X-Editable CSS ================== -->

<!-- ================== BEGIN Datatables JS ================== -->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/media/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Responsive/js/responsive.bootstrap4.min.js"></script>
<!--<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Select/js/dataTables.select.min.js"></script>-->
<!--<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/jszip.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/pdfmake.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js"></script>-->
<!--<script src="//cdn.datatables.net/plug-ins/1.10.16/api/fnFilterClear.js"></script>-->
<script src="<?php echo $SiteBaseUrl . $SiteBaseAdminPath; ?>sqldatatable/js/tmpget_datatable.js?<?php echo time(); ?>"></script>
<!-- ================== END Datatables JS ================== -->

<!-- ================== BEGIN X-Editable JS ================== -->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap3-editable/js/bootstrap4-editable.min.js"></script>
<!-- ================== END X-Editable JS ================== -->


<style>
.cards tbody tr{float:left;width:10rem;margin:.3rem;border:none;border-radius:.35rem;box-shadow:0 0 2px rgba(0,0,0,.2),0 4px 4px -2px rgba(0,0,0,.2)}.cards tbody td{display:block}.cards tbody td .hidden-text{width:9rem;overflow:hidden;height:20px} .table.table-bordered.dataTable tbody tr:first-child td {border-top:solid #e2e7eb 1px !important;}
</style>
    
<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 樣板 <small>複製</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="javascript:void(0);" onclick="startIntro();" data-original-title="教學導引 Step By Step" data-toggle="tooltip" data-placement="top" id="startButton" class="btn btn-default btn-sm"><i class="far fa-comment-alt fa-fw"></i> 導覽</a></div>
    <?php if (isset($_POST['Step'])) { ?>
    <?php if ($_POST['Step'] == '2') { ?>
    <h4 class="panel-title"><i class="fa fa-database"></i> 確認板型</h4>
    <?php } else if ($_POST['Step'] == '3') { ?>
    <h4 class="panel-title"><i class="fa fa-database"></i> 確認套用</h4>
    <?php } else if ($_POST['Step'] == '4') { ?>
    <h4 class="panel-title"><i class="fa fa-database"></i> 套用板型</h4>
    <?php } else { ?>
    <h4 class="panel-title"><i class="fa fa-database"></i> 選擇板型</h4>
    <?php } ?>
    <?php } ?>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
    <?php if (isset($_POST['Step']) && $_POST['Step'] == '2') { ?>
    <form action="<?php echo $editFormAction; ?>" name="Form_Get" id="Form_Get" class="form-horizontal form-bordered" data-parsley-validate="" method="post">
    <div class="alert alert-warning m-t-5 "><i class="fa fa-info-circle"></i> <b>您目前選取的板型為 <span class="label label-purple" data-original-title="目前套用版型編號" data-toggle="tooltip" data-placement="top">#No.<?php echo $row_RecordTmpTableName['id']; ?></span> <span class="label label-info"><?php echo $row_RecordTmpTableName['title']; ?></span>，點選按鈕送出後，除版型的橫幅區塊外(橫幅會初始為不使用)將會複製此版型其餘資料至您的樣板資訊中。</b></div>
    <div class="row">
      <div class="col-md-12">
        <div class="card bg-aqua-transparent-1">
          <div class="card-block">
            <?php if($row_RecordTmpTableName['title'] != "" && $row_RecordTmpTableName['type'] != "") { ?>
            <div class="pull-left m-r-10">
              <span class="label label-purple" data-original-title="目前套用版型編號" data-toggle="tooltip" data-placement="right">#No.<?php echo $row_RecordTmpTableName['id']; ?></span>
              <?php if ($row_RecordTmpTableName['pic'] != "") { ?>
                  <?php if ($SiteBaseUrlOuter != '' && $row_RecordTmpTableName['userid'] == '1') { ?>
                  <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"> <img src="<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpTableName['webname']; ?>/image/tmp/<?php echo $row_RecordTmpTableName['pic']; ?>" /></div></div>
                  <?php } else { ?>
                  <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"> <img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpTableName['webname']; ?>/image/tmp/<?php echo $row_RecordTmpTableName['pic']; ?>" /></div></div>
                  <?php } ?>
              <?php } else { ?>
              
              <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"><img src="images/100x100_tmp.jpg"/></div></div>
              <?php } ?>
            </div>
            
            <div class="pull-left m-t-20">
			  <?php if ($row_RecordTmpTableName['userid'] == '1') { ?><span class="label label-danger" data-original-title="不可修改" data-toggle="tooltip" data-placement="top">官方</span><?php } else { ?><span class="label label-warning">個人</span><?php } ?>
              <?php if ($row_RecordTmpTableName['name'] == "board009" || $row_RecordTmpTableName['name'] == "board010") { ?>
              <span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span>
              <?php } ?> 
            <div class="m-t-10"><span class="label label-info"><?php echo $row_RecordTmpTableName['type'];?></span> <?php echo $row_RecordTmpTableName['title']; ?></div>
            
            

            </div>
            <div class="pull-right m-t-20 d-none d-sm-block"><img src="images/rwd_pcmobile.png" width="180" height="90" /></div>
            <div style="clear:both;"></div>
            <?php } else { ?>
            <div class="alert alert-danger m-t-5 m-b-0"><i class="fa fa-info-circle"></i> <b>目前尚未套用任何版型。</b></div>
            
            <?php } ?>
          </div>
        </div>
      </div>
      
    </div>
    <?php
	   for($i=1; $i<mysqli_num_fields($RecordTmpTableName); $i++)
	   {
	    $table_name = mysqli_field_name($RecordTmp, $i); // 印出欄位名稱
		//$row_RecordTmpTableName[$table_name] . "<br />"; // 印出欄位內容
	   ?>
       <?php if ($table_name == 'userid') { ?>
       <input name="<?php echo $table_name ?>" type="hidden" id="<?php echo $table_name ?>" value="<?php echo $w_userid ?>" />
       <?php } else if ($table_name == 'webname') { ?>
       <input name="<?php echo $table_name ?>" type="hidden" id="<?php echo $table_name ?>" value="<?php echo $wshop ?>" />
       <?php } else if ($table_name == 'webnameorigin') { /* 取得來源版型 */ ?>
       <input name="<?php echo $table_name ?>" type="hidden" id="<?php echo $table_name ?>" value="<?php echo $row_RecordTmpTableName['webname']; ?>" />
       <?php } else if ($table_name == 'tmplogoid') { /* Logo */ ?>
       <input name="<?php echo $table_name ?>" type="hidden" id="<?php echo $table_name ?>" value="" />
       <?php } else if ($table_name == 'tmphomelogoid') { /* HomeLogo */ ?>
       <input name="<?php echo $table_name ?>" type="hidden" id="<?php echo $table_name ?>" value="" />
       <?php } else if ($table_name == 'pic') { ?>
       <input name="<?php echo $table_name ?>" type="hidden" id="<?php echo $table_name ?>" value="" />
       <?php } else if ($table_name == 'tmpbanner' && $row_RecordTmpTableName['tmpbanner'] != "3" && $row_RecordTmpTableName['tmpbanner'] != "1") { /* 橫幅設定為不使用 */?>
       <input name="<?php echo $table_name ?>" type="hidden" id="<?php echo $table_name ?>" value="0" />
       <?php } else if ($table_name == 'tmpbannerpic') { ?>
       <input name="<?php echo $table_name ?>" type="hidden" id="<?php echo $table_name ?>" value="" />
       <?php } else if ($table_name == 'tmplogo') { ?>
       <input name="<?php echo $table_name ?>" type="hidden" id="<?php echo $table_name ?>" value="" />
       <?php } else if ($table_name == 'tmpautobanner1') { ?>
       <input name="<?php echo $table_name ?>" type="hidden" id="<?php echo $table_name ?>" value="" />
       <?php } else if ($table_name == 'tmpautobanner2') { ?>
       <input name="<?php echo $table_name ?>" type="hidden" id="<?php echo $table_name ?>" value="" />
       <?php } else if ($table_name == 'tmpautobanner3') { ?>
       <input name="<?php echo $table_name ?>" type="hidden" id="<?php echo $table_name ?>" value="" />
       <?php } else if ($table_name == 'tmpautobanner4') { ?>
       <input name="<?php echo $table_name ?>" type="hidden" id="<?php echo $table_name ?>" value="" />
       <?php } else if ($table_name == 'tmpautobanner5') { ?>
       <input name="<?php echo $table_name ?>" type="hidden" id="<?php echo $table_name ?>" value="" />
       <?php } else if ($table_name == 'notes1') { ?>
       <input name="<?php echo $table_name ?>" type="hidden" id="<?php echo $table_name ?>" value="" />
       <?php } else { ?>
       <input name="<?php echo $table_name ?>" type="hidden" id="<?php echo $table_name ?>" value="<?php echo $row_RecordTmpTableName[$table_name] ?>" />
       <?php } ?>
       <?php
	   }
	   ?>
    <input name="Step" type="hidden" id="Step" value="3" /> 
    <button type="button" class="btn btn btn-primary btn-block" onclick="history.back()">上一步 - 選擇您欲複製的版型</button>
    <button type="submit" class="btn btn btn-primary btn-block">下一步 - 產生並建立您的版型</button>
    <input type="hidden" name="MM_insert" value="Form_Get" />
    </form>
    <script>
	$(document).ready(function() {
		$(".imgLiquidFill").imgLiquid();
	});
	</script>
    <?php } else if (isset($_POST['Step']) && $_POST['Step'] == '3') { ?>
    <div class="alert alert-warning m-t-5 "><i class="fa fa-info-circle"></i> <b>目前已建立新板型為 <span class="label label-purple" data-original-title="目前套用版型編號" data-toggle="tooltip" data-placement="top">#No.<?php echo $row_RecordTmpTableName['id']; ?></span> <span class="label label-info"><?php echo $row_RecordTmpTableName['title']; ?></span>。</b></div>
    
    <div class="row">
      <div class="col-md-12">
        <div class="card bg-aqua-transparent-1">
          <div class="card-block">
            <div class="pull-left m-r-10">
              <span class="label label-purple" data-original-title="目前套用版型編號" data-toggle="tooltip" data-placement="right">#No.<?php echo $row_RecordTmpTableName['id']; ?></span>
              <?php if ($row_RecordTmpTableName['pic'] != "") { ?>
                  <?php if ($SiteBaseUrlOuter != '' && $row_RecordTmpTableName['userid'] == '1') { ?>
                  <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"> <img src="<?php echo $SiteImgUrlOuter; ?><?php echo $row_RecordTmpTableName['webname']; ?>/image/tmp/<?php echo $_POST['pic']; ?>" /></div></div>
                  <?php } else { ?>
                  <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"> <img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpTableName['webname']; ?>/image/tmp/<?php echo $_POST['pic']; ?>" /></div></div>
                  <?php } ?>
              <?php } else { ?>
              
              <div class="img-thumbnail m-b-5 m-t-5"><div class="imgLiquidFill" style="width:100px; height:100px;"><img src="images/100x100_tmp.jpg"/></div></div>
              <?php } ?>
            </div>
            
            <div class="pull-left m-t-20">
			  <?php if ($row_RecordTmpTableName['userid'] == '1') { ?><span class="label label-danger" data-original-title="不可修改" data-toggle="tooltip" data-placement="top">官方</span><?php } else { ?><span class="label label-warning">個人</span><?php } ?>
              <?php if ($row_RecordTmpTableName['name'] == "board009" || $row_RecordTmpTableName['name'] == "board010") { ?>
              <span class="label label-danger" data-original-title="可支援行動裝置瀏覽" data-toggle="tooltip" data-placement="top">RWD</span>
              <?php } ?> 
            <div class="m-t-10"><span class="label label-info"><?php echo $row_RecordTmpTableName['type'];?></span> <?php echo $row_RecordTmpTableName['title']; ?></div>
            
            

            </div>
            <div class="pull-right m-t-20 d-none d-sm-block"><img src="images/rwd_pcmobile.png" width="180" height="90" /></div>
            <div style="clear:both;"></div>
          </div>
        </div>
      </div>
      
    </div>
    
    <form name="form" action="<?php echo $editFormAction; ?>" method="POST">
              <button type="submit" class="btn btn btn-primary btn-block m-t-10">若您要套用此版型請點選此按鈕</button>
              <input name="Step" type="hidden" id="Step" value="4" />
              <input type="hidden" name="MM_update" value="form" />
              <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
              <input name="MSTmpSelect" type="hidden" id="MSTmpSelect" value="<?php echo $row_RecordTmp['id']; ?>" />
    </form>
              
    <?php } else if (isset($_POST['Step']) && $_POST['Step'] == '4') { ?>
    <div class="alert alert-warning m-t-5 "><i class="fa fa-info-circle"></i> <b>已套用 <span class="label label-purple" data-original-title="目前套用版型編號" data-toggle="tooltip" data-placement="top">#No.<?php echo $row_RecordTmpTableName['id']; ?></span> <span class="label label-info"><?php echo $row_RecordTmpTableName['title']; ?></span> 版型於網站，請至前台確認查看或在 <a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="查看目前所有的版型" data-toggle="tooltip" data-placement="right" class="btn btn-primary btn-xs"><i class="fa fa-chevron-right"></i> 樣板一覽</a> 中查看並修改此版型。</b></div>
    <?php } else { ?>
    <form action="<?php echo $editFormAction; ?>" method="POST" name="Form_Choose" id="Form_Choose" data-parsley-validate=""> 
    
    <div class="alert alert-warning"><i class="fa fa-info-circle"></i> <b>一般傳統版型(對電腦瀏覽器相容性高/行動裝置不易閱讀/適於電腦操作)，RWD版型(僅支援IE9+以上瀏覽器/適用行動裝置/適於觸控操作)。請自行對您的客戶群做判斷調整。</b></div>
    
    <div class="alert alert-warning"><i class="fa fa-info-circle"></i> <b>此頁面可選擇您欲複製的樣板，而建立後您可以自由修改。</b></div>
    
    <div class="row justify-content-end">
      <div class="col-md-2 col-sm-12 m-b-10">
        <div class="input-group" data-column="4"> <span class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search fa-fw"></i> 類別</span></span>
            <select name="type" class="form-control search_filter" id="col4_filter">
            <option value="" selected="selected">全部</option>
              <?php
do {  
?>
              <option value="<?php echo $row_RecordTmpListType['itemname']?>"><?php echo $row_RecordTmpListType['itemname']?></option>
                  <?php
} while ($row_RecordTmpListType = mysqli_fetch_assoc($RecordTmpListType));
  $rows = mysqli_num_rows($RecordTmpListType);
  if($rows > 0) {
      mysqli_data_seek($RecordTmpListType, 0);
	  $row_RecordTmpListType = mysqli_fetch_assoc($RecordTmpListType);
  }
?>
          </select>
        </div>
      </div>
      <div class="col-md-2 col-sm-12 m-b-10">
        <div class="input-group" data-column="3"> <span class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search fa-fw"></i> 風格</span></span>
          <select name="name" class="form-control search_filter" id="col4_filter">
              <option value="">全部</option>
              <?php if ($SiteOldMode == '1' || $SiteOldMode == "") { /* 是否使用舊系統相容模式 */ ?>
              <option value="board001">風格1</option>
              <option value="board002">風格2</option>
              <option value="board003">風格3</option>
              <option value="board004">風格4</option>
              <option value="board005">風格5</option>
              <option value="board006">風格6</option>
              <option value="board007">風格7</option>
              <option value="board008">風格8</option>
              <?php } ?>
              <option value="board009">雙欄式版面 - RWD</option>
              <option value="board010">單欄示版面 - RWD</option>
            </select>
        </div>
      </div>
      <div class="col-md-5 m-b-10">
        <div class="input-group"> <span class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search fa-fw"></i> 標題</span></span>
          <input type="text" class="form-control global_filter" placeholder="" id="global_filter">
          <div class="input-group-append" style="display:none">
            <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#collapseOne"> <span class="caret"></span> </button>
          </div>
        </div>
      </div>
    </div>
    <div id="collapseOne" class="collapse" data-parent="#accordion">
      <div class="card-body bg-aqua-transparent-1 m-t-10">
        <div class="row">
          <div class="col-md-12">
            
          </div>
        </div>
      </div>
    </div>
    
    <table id="data-table-default" class="table table-bordered table-hover cards" style="width:100%">
      <thead>
        <tr>
          
          <th data-priority="1"><strong>可選擇版型<div id="error_action"></div></strong></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
         
          <td><button type="button" id="reset_table" class="btn btn-default btn-sm pull-right"><i class="fa fa-sync"></i> 清除狀態</button></td>
        </tr>
      </tfoot>
    </table>
    <button type="submit" class="btn btn btn-primary btn-block m-t-10">下一步 - 確認您所選取的版型</button>
    <input name="Step" type="hidden" id="Step" value="2" />
  </form>  
  	<script>
	//$.fn.editable.defaults.mode = 'inline';
	$(document).ready(function() {	
		TableManageDefault.init();	   
	});
	</script> 
    <?php } ?>
  </div>
  <!-- end panel-body --> 
  
  
</div>
<!-- end panel --> 



<?php
mysqli_free_result($RecordTmpListType);
?>
