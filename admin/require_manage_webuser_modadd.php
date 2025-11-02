<?php require_once('../Connections/DB_Conn.php'); ?>
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

// 判斷帳號是否重複
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
	$MM_dupKeyRedirect="manage_webuser.php?wshop=&Opt=addpage&RegMsg=error&lang=" . $_POST['lang'];
	$loginUsername = $_POST['account'];
	$loginWebname = $_POST['webname'];
	$LoginRS__query = sprintf("SELECT * FROM demo_admin WHERE account = %s", GetSQLValueString($loginUsername, "text"));
	$LoginRS__query_Webname = sprintf("SELECT * FROM demo_admin WHERE webname = %s", GetSQLValueString($loginWebname, "text"));
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$LoginRS=mysqli_query($DB_Conn, $LoginRS__query) or die(mysqli_error($DB_Conn));
	$row_LoginRS = mysqli_fetch_assoc($LoginRS);
	$totalRows_LoginRS = mysqli_num_rows($LoginRS);
	$loginFoundUser = mysqli_num_rows($LoginRS); //取得結果中列的數目
	
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$LoginRS_Webname=mysqli_query($DB_Conn, $LoginRS__query_Webname) or die(mysqli_error($DB_Conn));
	$row_LoginRS_Webname = mysqli_fetch_assoc($LoginRS_Webname);
	$totalRows_LoginRS_Webname = mysqli_num_rows($LoginRS_Webname);
	$loginFoundUser_Webname = mysqli_num_rows($LoginRS_Webname); //取得結果中列的數目

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser || $loginFoundUser_Webname){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
	ob_end_flush(); // 輸出緩衝區結束
    exit;
  }
}

$Home_Content_Sample01 = "<p style=\"text-align:center\"><img alt=\"\" height=\"374\" src=\"http://www.shop3500.com/images/home_sp01.png\" style=\"display:block; margin:auto;\" width=\"180\" /></p>";
$Home_Content_Sample02 = "<p style=\"text-align:center\"><img alt=\"\" height=\"293\" src=\"http://www.shop3500.com/images/home_sp02.png\" style=\"display:block; margin:auto;\" width=\"180\" /></p>";

//------------------------------------------------------------------------------------------------------------------------
// 一般企業網站
//------------------------------------------------------------------------------------------------------------------------
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Webuser") && $_POST["modselect"] == '1') {
  $insertSQL = sprintf("INSERT INTO demo_admin (account, psw, name, webname, `level`, notes1) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['account'], "text"),
                       GetSQLValueString($_POST['psw'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['webname'], "text"),
                       GetSQLValueString($_POST['level'], "text"),
                       GetSQLValueString($_POST['notes1'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  // 取得目前新增資料
	$colname_RecordWebuserUserid = "-1";
	if (isset($_POST['webname'])) {
	  $colname_RecordWebuserUserid = $_POST['webname'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordWebuserUserid = sprintf("SELECT id FROM demo_admin WHERE webname = %s ORDER BY id DESC", GetSQLValueString($colname_RecordWebuserUserid, "text"));
	$RecordWebuserUserid = mysqli_query($DB_Conn, $query_RecordWebuserUserid) or die(mysqli_error($DB_Conn));
	$row_RecordWebuserUserid = mysqli_fetch_assoc($RecordWebuserUserid);
	$totalRows_RecordWebuserUserid = mysqli_num_rows($RecordWebuserUserid);

	//echo $row_RecordWebuserUserid['id']; //抓取之id直
  // 插入設定檔案
  if($_POST['uselangtw'] == '1' && $_POST['uselangcn'] == '0' && $_POST['uselangen'] == '0' && $_POST['uselangjp'] == '0')
  {
	  $_POST['uselangtw'] = '0';
  }
  if($_POST['uselangtw'] != '1') {$_POST['uselangtw'] = "0";}
  if($_POST['uselangcn'] != '1') {$_POST['uselangcn'] = "0";}
  if($_POST['uselangen'] != '1') {$_POST['uselangen'] = "0";}
  if($_POST['uselangjp'] != '1') {$_POST['uselangjp'] = "0";}
  
  $insertSQLSetting = sprintf("INSERT INTO demo_setting (Defaultlang, LangChooseZHTW, LangChooseZHCN, LangChooseEN, LangChooseJP, OptionNewsSelect, OptionFaqSelect, OptionProductSelect, OptionFrilinkSelect, OptionPublishSelect, OptionGuestbookSelect, OptionActivitiesSelect, OptionProjectSelect, OptionArticleSelect, OptionAboutSelect, OptionContactSelect, OptionDfPageSelect, OptionCatalogSelect, OptionCartSelect, OptionMobileSelect, dfpage_limit_page_num, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Defaultlang'], "text"), // 繁
                       GetSQLValueString($_POST['uselangtw'], "int"), // 繁
					   GetSQLValueString($_POST['uselangcn'], "int"), // 簡
					   GetSQLValueString($_POST['uselangen'], "int"), // 英
					   GetSQLValueString($_POST['uselangjp'], "int"), // 日
					   GetSQLValueString("1", "int"), // 最新訊息
					   GetSQLValueString("0", "int"), // 常見問答
					   GetSQLValueString("1", "int"), // 商品櫥窗
					   GetSQLValueString("1", "int"), // 友站連結
					   GetSQLValueString("0", "int"), // 發布資訊
					   GetSQLValueString("0", "int"), // 留言訊息
					   GetSQLValueString("0", "int"), // 活動花絮
					   GetSQLValueString("0", "int"), // 工程實績
					   GetSQLValueString("0", "int"), // 文章管理
					   GetSQLValueString("1", "int"), // 關於我們
					   GetSQLValueString("1", "int"), // 聯絡我們
					   GetSQLValueString("1", "int"), // 自訂頁面
					   GetSQLValueString("0", "int"), // 產品型錄
					   GetSQLValueString("0", "int"), // 購物車
					   GetSQLValueString("1", "int"), // 手機模組
					   GetSQLValueString("5", "int"), // 頁面限制頁數
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultSetting = mysqli_query($DB_Conn, $insertSQLSetting) or die(mysqli_error($DB_Conn));
  
    // 插入logo
  $insertSQLLogo = sprintf("INSERT INTO demo_tmplogo (name, type, logoname, logocolor, logofontsize, logotype, lang, userid, webname) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("我的文字Logo", "text"),
                       GetSQLValueString("個人", "text"),
					   GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString("#000000", "text"),
                       GetSQLValueString("36px", "text"),
					   GetSQLValueString("1", "int"),
                       GetSQLValueString("zh-tw", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"),
                       GetSQLValueString($_POST['webname'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultLogo = mysqli_query($DB_Conn, $insertSQLLogo) or die(mysqli_error($DB_Conn));
  
  // 取得目前logo id
    $colname_RecordMyLogo = "-1";
	if (isset($_POST['webname'])) {
	  $colname_RecordMyLogo = $_POST['webname'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordMyLogo = sprintf("SELECT id FROM demo_tmplogo WHERE webname = %s ORDER BY id DESC", GetSQLValueString($colname_RecordMyLogo, "text"));
	$RecordMyLogo = mysqli_query($DB_Conn, $query_RecordMyLogo) or die(mysqli_error($DB_Conn));
	$row_RecordMyLogo = mysqli_fetch_assoc($RecordMyLogo);
	$totalRows_RecordMyLogo = mysqli_num_rows($RecordMyLogo);
	
  // 取得複製版型資料 
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpShowSlect = sprintf("SELECT * FROM demo_tmp WHERE id = 101");
$RecordTmpShowSlect = mysqli_query($DB_Conn, $query_RecordTmpShowSlect) or die(mysqli_error($DB_Conn));
$row_RecordTmpShowSlect = mysqli_fetch_assoc($RecordTmpShowSlect);
$totalRows_RecordTmpShowSlect = mysqli_num_rows($RecordTmpShowSlect);
  // 新增一筆版型資料
  $insertSQL = sprintf("INSERT INTO demo_tmp (userid, name, title, homeselect, homestyle, tmpwebwidth, tmpwebwidthunit, tmpfbfanselect, tmpfbfanbkcolor, tmpfbfanboardcolor, author, type, pic, content, postdate, indicate, sdescription, skeyword, pushtop, tmplogo, tmplogoid, tmpmainmenu, tmpmainmenuindicate, tmpsubmainmenuindicate, tmpleftmenu, tmpblock, tmpshowblockname, tmpdftmenu_x, tmpdftmenu_y, tmppicmenu_x, tmppicmenu_y, tmppicmenu_style, tmpbannerpic, tmpbannerpicwidth, tmpbannerpicheight, tmpautobanner1, tmpautobanner2, tmpautobanner3, tmpautobanner4, tmpautobanner5, tmpselectbannerid, tmphomeenterselect, tmphomeenterdefaultpic, tmphomeenterpic, tmphomeenterpicsource, tmplogowidth, tmplogoheight, tmplogomargintop, tmplogomarginleft, tmphomelogomargintop, tmphomelogomarginleft, tmphomeentermarginbottom, tmphomeentermarginright, tmpwordcolor, tmpwordsize, tmplink, tmplinkvisit, tmplinkhover, tmpheaderminheight, tmptitlebackground, tmptitlelinebackground, tmpleftminheight, tmpmiddleminheight, tmprightminheight, tmpfooterminheight, tmpbanner, tmpdfmenucolor, tmpmenuselect, tmpbodyselect, tmpmenulimit, tmpbodybackground, tmpanimebackground, tmpbottombackground, tmpheaderbackground, tmpwrpbackground, tmpleftbackground, tmprightbackground, tmpmiddlebackground, tmpfooterbackground, tmphomeboard, tmpwrpboard, tmpbannerboard, tmpheaderboard, tmpleftboard, tmprightboard, tmptitleboard, tmpmiddleboard, tmpfooterboard, tmpmeger_t_m, tmpheaderpaddingtop, tmpheaderpaddingbttom, tmpheaderpaddingleft, tmpheaderpaddingright, tmpbannerpaddingtop, tmpbannerpaddingbttom, tmpbannerpaddingleft, tmpbannerpaddingright, tmpleftpaddingtop, tmpleftpaddingbttom, tmpleftpaddingleft, tmpleftpaddingright, tmprightpaddingtop, tmprightpaddingbttom, tmprightpaddingleft, tmprightpaddingright, tmpmiddlepaddingtop, tmpmiddlepaddingbttom, tmpmiddlepaddingleft, tmpmiddlepaddingright, tmp_middle_title_font_color, tmp_middle_title_x, tmp_middle_title_height, tmpfooterpaddingtop, tmpfooterpaddingbttom, tmpfooterpaddingleft, tmpfooterpaddingright, tmpfooterfontcolor, tmpproductboard, tmpproductboardicon, tmpproductboardfontcolor, tmpproductviewcolumn, tmpnewsoddbackground, tmpnewsevenbackground, tmpnewstopbackground, tmpprojectboard, tmpprojectboardicon, tmpactivitiesboard, tmpactivitiesboardicon, tmpfrilinkboard, tmpfrilinkboardicon, tmporgboard, tmporgboardicon, tmpsponsorboard, tmpsponsorboardicon, tmppartnerboard, tmppartnerboardicon, tmpartlistboard, tmpartlistboardicon, tmppublishindicate, notes1, notes2, sortid, lang, webname, webnameorigin) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['name'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['title'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['homeselect'], "int"),
					   GetSQLValueString($row_RecordTmpShowSlect['homestyle'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpwebwidth'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpwebwidthunit'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfbfanselect'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfbfanbkcolor'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfbfanboardcolor'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['author'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['type'], "text"),
                       GetSQLValueString("", "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['content'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['postdate'], "date"),
                       GetSQLValueString($row_RecordTmpShowSlect['indicate'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['sdescription'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['skeyword'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['pushtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplogo'], "text"),
                       GetSQLValueString($row_RecordMyLogo['id'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmainmenu'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmainmenuindicate'], "int"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmpsubmainmenuindicate'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftmenu'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpblock'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpshowblockname'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpdftmenu_x'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpdftmenu_y'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmppicmenu_x'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmppicmenu_y'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmppicmenu_style'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpic'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpicwidth'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpicheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpautobanner1'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpautobanner2'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpautobanner3'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpautobanner4'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpautobanner5'], "text"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmpselectbannerid'], "int"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomeenterselect'], "int"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomeenterdefaultpic'], "text"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomeenterpic'], "text"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomeenterpicsource'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplogowidth'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplogoheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplogomargintop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplogomarginleft'], "int"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomelogomargintop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmphomelogomarginleft'], "int"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomeentermarginbottom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmphomeentermarginright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpwordcolor'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpwordsize'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplink'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplinkvisit'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplinkhover'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderminheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmptitlebackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmptitlelinebackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftminheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddleminheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightminheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterminheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbanner'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpdfmenucolor'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmenuselect'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbodyselect'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmenulimit'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbodybackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpanimebackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbottombackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpwrpbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddlebackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterbackground'], "text"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomeboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpwrpboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmptitleboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddleboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmeger_t_m'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderpaddingtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderpaddingbttom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderpaddingleft'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderpaddingright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpaddingtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpaddingbttom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpaddingleft'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpaddingright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftpaddingtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftpaddingbttom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftpaddingleft'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftpaddingright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightpaddingtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightpaddingbttom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightpaddingleft'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightpaddingright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddlepaddingtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddlepaddingbttom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddlepaddingleft'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddlepaddingright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmp_middle_title_font_color'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmp_middle_title_x'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmp_middle_title_height'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterpaddingtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterpaddingbttom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterpaddingleft'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterpaddingright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterfontcolor'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpproductboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpproductboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpproductboardfontcolor'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpproductviewcolumn'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpnewsoddbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpnewsevenbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpnewstopbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpprojectboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpprojectboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpactivitiesboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpactivitiesboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfrilinkboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfrilinkboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmporgboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmporgboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpsponsorboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpsponsorboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmppartnerboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmppartnerboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpartlistboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpartlistboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmppublishindicate'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['notes1'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['notes2'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['sortid'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['lang'], "text"),
					   GetSQLValueString($_POST['webname'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['webnameorigin'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  // 取得目前版型id
    $colname_RecordMyTmp = "-1";
	if (isset($_POST['webname'])) {
	  $colname_RecordMyTmp = $_POST['webname'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordMyTmp = sprintf("SELECT id FROM demo_tmp WHERE webname = %s ORDER BY id DESC", GetSQLValueString($colname_RecordMyTmp, "text"));
	$RecordMyTmp = mysqli_query($DB_Conn, $query_RecordMyTmp) or die(mysqli_error($DB_Conn));
	$row_RecordMyTmp = mysqli_fetch_assoc($RecordMyTmp);
	$totalRows_RecordMyTmp = mysqli_num_rows($RecordMyTmp);
  
  // 插入設定檔案
  $insertSQLSettingFr = sprintf("INSERT INTO demo_setting_fr (MSTmpSelect, MSTmpSelectRwd, productlistLock, frilinkLock, alllistLock, homecontenttwsmall, homecontentcnsmall, homecontentensmall, homecontenttwsmall2, homecontentcnsmall2, homecontentensmall2, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($row_RecordMyTmp['id'], "int"), // 版型選擇
					   GetSQLValueString($row_RecordMyTmp['id'], "int"), // 版型選擇
					   GetSQLValueString("1", "int"), // 產品 - 自訂欄位
					   GetSQLValueString("1", "int"), // 友站 - 自訂欄位
					   GetSQLValueString("0", "int"), // 全部選單 - 自訂欄位
					   GetSQLValueString($Home_Content_Sample01, "text"), // 預設圖片
					   GetSQLValueString($Home_Content_Sample01, "text"), // 預設圖片
					   GetSQLValueString($Home_Content_Sample01, "text"), // 預設圖片
					   GetSQLValueString($Home_Content_Sample02, "text"), // 預設圖片
					   GetSQLValueString($Home_Content_Sample02, "text"), // 預設圖片
					   GetSQLValueString($Home_Content_Sample02, "text"), // 預設圖片
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultSettingFr = mysqli_query($DB_Conn, $insertSQLSettingFr) or die(mysqli_error($DB_Conn));
  
  // 插入設定檔案
  $insertSQLSettingOtr = sprintf("INSERT INTO demo_setting_otr (userid) VALUES (%s)",
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultSettingOtr = mysqli_query($DB_Conn, $insertSQLSettingOtr) or die(mysqli_error($DB_Conn));
  
  if($_POST['uselangcn'] == '1'){
	  $updateSQL = sprintf("UPDATE demo_setting_fr SET productlistLock_cn=%s, frilinkLock_cn=%s, alllistLock_cn=%s WHERE userid=%s",
                       GetSQLValueString("1", "int"), // 產品 - 自訂欄位
					   GetSQLValueString("0", "int"), // 友站 - 自訂欄位
					   GetSQLValueString("0", "int"), // 全部選單 - 自訂欄位
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  }
  if($_POST['uselangen'] == '1'){
	  $updateSQL = sprintf("UPDATE demo_setting_fr SET productlistLock_en=%s, frilinkLock_en=%s, alllistLock_en=%s WHERE userid=%s",
                       GetSQLValueString("1", "int"), // 產品 - 自訂欄位
					   GetSQLValueString("0", "int"), // 友站 - 自訂欄位
					   GetSQLValueString("0", "int"), // 全部選單 - 自訂欄位
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  }
  if($_POST['uselangjp'] == '1'){
	  $updateSQL = sprintf("UPDATE demo_setting_fr SET productlistLock_jp=%s, frilinkLock_jp=%s, alllistLock_jp=%s WHERE userid=%s",
                       GetSQLValueString("1", "int"), // 產品 - 自訂欄位
					   GetSQLValueString("0", "int"), // 友站 - 自訂欄位
					   GetSQLValueString("0", "int"), // 全部選單 - 自訂欄位
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  }
  
  // 插入自訂頁面
  $insertSQLDftypeAbout = sprintf("INSERT INTO demo_dftype (title, home, typemenu, sortid, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("關於我們", "text"),
					   GetSQLValueString("1", "int"), // 設定首頁
					   GetSQLValueString("About", "text"),
					   GetSQLValueString("1", "int"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeAbout = mysqli_query($DB_Conn, $insertSQLDftypeAbout) or die(mysqli_error($DB_Conn));
  
  if($_POST['uselangcn'] == '1'){
	  
	  $insertSQLDftypeAbout = sprintf("INSERT INTO demo_dftype (title, home, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("关于我们", "text"),
					   GetSQLValueString("1", "int"), // 設定首頁
					   GetSQLValueString("About", "text"),
					   GetSQLValueString("1", "int"),
					   GetSQLValueString("zh-cn", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeAbout = mysqli_query($DB_Conn, $insertSQLDftypeAbout) or die(mysqli_error($DB_Conn));
  
  }
  
  if($_POST['uselangen'] == '1'){
	  
	  $insertSQLDftypeAbout = sprintf("INSERT INTO demo_dftype (title, home, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("About", "text"),
					   GetSQLValueString("1", "int"), // 設定首頁
					   GetSQLValueString("About", "text"),
					   GetSQLValueString("1", "int"),
					   GetSQLValueString("en", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeAbout = mysqli_query($DB_Conn, $insertSQLDftypeAbout) or die(mysqli_error($DB_Conn));
  
  }
  
  if($_POST['uselangjp'] == '1'){
	  
	  $insertSQLDftypeAbout = sprintf("INSERT INTO demo_dftype (title, home, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("会社の案内書", "text"),
					   GetSQLValueString("1", "int"), // 設定首頁
					   GetSQLValueString("About", "text"),
					   GetSQLValueString("1", "int"),
					   GetSQLValueString("jp", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeAbout = mysqli_query($DB_Conn, $insertSQLDftypeAbout) or die(mysqli_error($DB_Conn));
  
  }
  
  $insertSQLDftypeNews = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, userid) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString("最新訊息", "text"),
					   GetSQLValueString("News", "text"),
					   GetSQLValueString("2", "int"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeNews = mysqli_query($DB_Conn, $insertSQLDftypeNews) or die(mysqli_error($DB_Conn));
  
  if($_POST['uselangcn'] == '1'){
	  $insertSQLDftypeNews = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("最新讯息", "text"),
					   GetSQLValueString("News", "text"),
					   GetSQLValueString("2", "int"),
					   GetSQLValueString("zh-cn", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeNews = mysqli_query($DB_Conn, $insertSQLDftypeNews) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangen'] == '1'){
	  $insertSQLDftypeNews = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("News", "text"),
					   GetSQLValueString("News", "text"),
					   GetSQLValueString("2", "int"),
					   GetSQLValueString("en", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeNews = mysqli_query($DB_Conn, $insertSQLDftypeNews) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangjp'] == '1'){
	  $insertSQLDftypeNews = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("最新の情報", "text"),
					   GetSQLValueString("News", "text"),
					   GetSQLValueString("2", "int"),
					   GetSQLValueString("jp", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeNews = mysqli_query($DB_Conn, $insertSQLDftypeNews) or die(mysqli_error($DB_Conn));
  }
  
  $insertSQLDftypeProduct = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, userid) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString("商品櫥窗", "text"),
					   GetSQLValueString("Product", "text"),
					   GetSQLValueString("3", "int"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeProduct = mysqli_query($DB_Conn, $insertSQLDftypeProduct) or die(mysqli_error($DB_Conn));
  
  if($_POST['uselangcn'] == '1'){
	  $insertSQLDftypeProduct = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("商品橱窗", "text"),
					   GetSQLValueString("Product", "text"),
					   GetSQLValueString("3", "int"),
					   GetSQLValueString("zh-cn", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeProduct = mysqli_query($DB_Conn, $insertSQLDftypeProduct) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangen'] == '1'){
	  $insertSQLDftypeProduct = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("Product", "text"),
					   GetSQLValueString("Product", "text"),
					   GetSQLValueString("3", "int"),
					   GetSQLValueString("en", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeProduct = mysqli_query($DB_Conn, $insertSQLDftypeProduct) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangjp'] == '1'){
	  $insertSQLDftypeProduct = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("製品の情報", "text"),
					   GetSQLValueString("Product", "text"),
					   GetSQLValueString("3", "int"),
					   GetSQLValueString("jp", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeProduct = mysqli_query($DB_Conn, $insertSQLDftypeProduct) or die(mysqli_error($DB_Conn));
  }
  
  $insertSQLDftypeContact = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, userid) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString("聯絡我們", "text"),
					   GetSQLValueString("Contact", "text"),
					   GetSQLValueString("4", "int"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeContact = mysqli_query($DB_Conn, $insertSQLDftypeContact) or die(mysqli_error($DB_Conn));
  
  if($_POST['uselangcn'] == '1'){
	  $insertSQLDftypeContact = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("联络我们", "text"),
					   GetSQLValueString("Contact", "text"),
					   GetSQLValueString("4", "int"),
					   GetSQLValueString("zh-cn", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeContact = mysqli_query($DB_Conn, $insertSQLDftypeContact) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangen'] == '1'){
	  $insertSQLDftypeContact = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("Contact", "text"),
					   GetSQLValueString("Contact", "text"),
					   GetSQLValueString("4", "int"),
					   GetSQLValueString("en", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeContact = mysqli_query($DB_Conn, $insertSQLDftypeContact) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangjp'] == '1'){
	  $insertSQLDftypeContact = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("私達を連絡", "text"),
					   GetSQLValueString("Contact", "text"),
					   GetSQLValueString("4", "int"),
					   GetSQLValueString("jp", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeContact = mysqli_query($DB_Conn, $insertSQLDftypeContact) or die(mysqli_error($DB_Conn));
  }
  
  // 插入自訂頁面 - END
  
  // 插入自訂欄位
  $insertSQLTmpColumnProduct = sprintf("INSERT INTO demo_tmpcolumn (type, style, dftname, customname, sortid, userid) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("productlist", "text"),
					   GetSQLValueString("menu", "text"),
					   GetSQLValueString("產品分類", "text"),
					   GetSQLValueString("產品分類", "text"),
					   GetSQLValueString("1", "int"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultTmpColumnProduct = mysqli_query($DB_Conn, $insertSQLTmpColumnProduct) or die(mysqli_error($DB_Conn));
  
  if($_POST['uselangcn'] == '1'){
	  $insertSQLTmpColumnProduct = sprintf("INSERT INTO demo_tmpcolumn (type, style, dftname, customname, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("productlist", "text"),
					   GetSQLValueString("menu", "text"),
					   GetSQLValueString("產品分類", "text"),
					   GetSQLValueString("产品分类", "text"),
					   GetSQLValueString("1", "int"),
					   GetSQLValueString("zh-cn", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultTmpColumnProduct = mysqli_query($DB_Conn, $insertSQLTmpColumnProduct) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangen'] == '1'){
	  $insertSQLTmpColumnProduct = sprintf("INSERT INTO demo_tmpcolumn (type, style, dftname, customname, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("productlist", "text"),
					   GetSQLValueString("menu", "text"),
					   GetSQLValueString("產品分類", "text"),
					   GetSQLValueString("Product", "text"),
					   GetSQLValueString("1", "int"),
					   GetSQLValueString("en", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultTmpColumnProduct = mysqli_query($DB_Conn, $insertSQLTmpColumnProduct) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangjp'] == '1'){
	  $insertSQLTmpColumnProduct = sprintf("INSERT INTO demo_tmpcolumn (type, style, dftname, customname, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("productlist", "text"),
					   GetSQLValueString("menu", "text"),
					   GetSQLValueString("產品分類", "text"),
					   GetSQLValueString("プロダクト", "text"),
					   GetSQLValueString("1", "int"),
					   GetSQLValueString("jp", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultTmpColumnProduct = mysqli_query($DB_Conn, $insertSQLTmpColumnProduct) or die(mysqli_error($DB_Conn));
  }
  
  $insertSQLTmpColumnFrilink = sprintf("INSERT INTO demo_tmpcolumn (type, style, dftname, customname, sortid, userid) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("frilink", "text"),
					   GetSQLValueString("menu", "text"),
					   GetSQLValueString("友站連結", "text"),
					   GetSQLValueString("友站連結", "text"),
					   GetSQLValueString("2", "int"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultTmpColumnFrilink = mysqli_query($DB_Conn, $insertSQLTmpColumnFrilink) or die(mysqli_error($DB_Conn));
  
  // 插入自訂欄位 - END
  
  // 插入關於我們資料
  $desc_show_about = "<img src=\"http://www.shop3500.com/images/desc_01.jpg\" width=\"700\" height=\"566\" />";
  $insertSQLAbout = sprintf("INSERT INTO demo_about (title, content, home, userid) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString("公司簡介", "text"), // 
					   GetSQLValueString($desc_show_about, "text"), // 
					   GetSQLValueString("1", "int"), // 
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));
  
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultAbout = mysqli_query($DB_Conn, $insertSQLAbout) or die(mysqli_error($DB_Conn));
  
  // 插入商品櫥窗分類資料
  $insertSQLProductListB = sprintf("INSERT INTO demo_productitem (list_id, itemname, level, endnode, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("1", "int"), // 
                       GetSQLValueString("商品分類B", "text"), // 
					   GetSQLValueString("0", "int"), // 
					   GetSQLValueString("child", "text"), // 
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));
  
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultProductListB = mysqli_query($DB_Conn, $insertSQLProductListB) or die(mysqli_error($DB_Conn));
  
  $insertSQLProductListA = sprintf("INSERT INTO demo_productitem (list_id, itemname, level, endnode, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("1", "int"), // 
                       GetSQLValueString("商品分類A", "text"), // 
					   GetSQLValueString("0", "int"), // 
					   GetSQLValueString("child", "text"), // 
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));
  
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultProductListA = mysqli_query($DB_Conn, $insertSQLProductListA) or die(mysqli_error($DB_Conn));
  $_SESSION['DB_Add'] = "Success";
  $insertGoTo = "manage_webuser.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
}

//------------------------------------------------------------------------------------------------------------------------
// \一般企業網站
//------------------------------------------------------------------------------------------------------------------------

//------------------------------------------------------------------------------------------------------------------------
// 購物商城
//------------------------------------------------------------------------------------------------------------------------

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Webuser") && $_POST["modselect"] == '2') {
  $insertSQL = sprintf("INSERT INTO demo_admin (account, psw, name, webname, `level`, notes1) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['account'], "text"),
                       GetSQLValueString($_POST['psw'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['webname'], "text"),
                       GetSQLValueString($_POST['level'], "text"),
                       GetSQLValueString($_POST['notes1'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  // 取得目前新增資料
	$colname_RecordWebuserUserid = "-1";
	if (isset($_POST['webname'])) {
	  $colname_RecordWebuserUserid = $_POST['webname'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordWebuserUserid = sprintf("SELECT id FROM demo_admin WHERE webname = %s ORDER BY id DESC", GetSQLValueString($colname_RecordWebuserUserid, "text"));
	$RecordWebuserUserid = mysqli_query($DB_Conn, $query_RecordWebuserUserid) or die(mysqli_error($DB_Conn));
	$row_RecordWebuserUserid = mysqli_fetch_assoc($RecordWebuserUserid);
	$totalRows_RecordWebuserUserid = mysqli_num_rows($RecordWebuserUserid);

	//echo $row_RecordWebuserUserid['id']; //抓取之id直
  // 插入設定檔案
  $insertSQLSetting = sprintf("INSERT INTO demo_setting (OptionNewsSelect, OptionFaqSelect, OptionProductSelect, OptionFrilinkSelect, OptionPublishSelect, OptionGuestbookSelect, OptionActivitiesSelect, OptionProjectSelect, OptionArticleSelect, OptionAboutSelect, OptionContactSelect, OptionDfPageSelect, OptionCatalogSelect, OptionCartSelect, OptionMobileSelect, dfpage_limit_page_num, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("1", "int"), // 最新訊息
					   GetSQLValueString("1", "int"), // 常見問答
					   GetSQLValueString("1", "int"), // 商品櫥窗
					   GetSQLValueString("1", "int"), // 友站連結
					   GetSQLValueString("0", "int"), // 發布資訊
					   GetSQLValueString("0", "int"), // 留言訊息
					   GetSQLValueString("0", "int"), // 活動花絮
					   GetSQLValueString("0", "int"), // 工程實績
					   GetSQLValueString("0", "int"), // 文章管理
					   GetSQLValueString("1", "int"), // 關於我們
					   GetSQLValueString("1", "int"), // 聯絡我們
					   GetSQLValueString("1", "int"), // 自訂頁面
					   GetSQLValueString("0", "int"), // 產品型錄
					   GetSQLValueString("1", "int"), // 購物車
					   GetSQLValueString("1", "int"), // 手機模組
					   GetSQLValueString("6", "int"), // 頁面限制頁數
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultSetting = mysqli_query($DB_Conn, $insertSQLSetting) or die(mysqli_error($DB_Conn));
  
    // 插入logo
  $insertSQLLogo = sprintf("INSERT INTO demo_tmplogo (name, type, logoname, logocolor, logofontsize, logotype, lang, userid, webname) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("我的文字Logo", "text"),
                       GetSQLValueString("個人", "text"),
					   GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString("#000000", "text"),
                       GetSQLValueString("36px", "text"),
					   GetSQLValueString("1", "int"),
                       GetSQLValueString("zh-tw", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"),
                       GetSQLValueString($_POST['webname'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultLogo = mysqli_query($DB_Conn, $insertSQLLogo) or die(mysqli_error($DB_Conn));
  
  // 取得目前logo id
    $colname_RecordMyLogo = "-1";
	if (isset($_POST['webname'])) {
	  $colname_RecordMyLogo = $_POST['webname'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordMyLogo = sprintf("SELECT id FROM demo_tmplogo WHERE webname = %s ORDER BY id DESC", GetSQLValueString($colname_RecordMyLogo, "text"));
	$RecordMyLogo = mysqli_query($DB_Conn, $query_RecordMyLogo) or die(mysqli_error($DB_Conn));
	$row_RecordMyLogo = mysqli_fetch_assoc($RecordMyLogo);
	$totalRows_RecordMyLogo = mysqli_num_rows($RecordMyLogo);
	
  // 取得複製版型資料 
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpShowSlect = sprintf("SELECT * FROM demo_tmp WHERE id = 1");
$RecordTmpShowSlect = mysqli_query($DB_Conn, $query_RecordTmpShowSlect) or die(mysqli_error($DB_Conn));
$row_RecordTmpShowSlect = mysqli_fetch_assoc($RecordTmpShowSlect);
$totalRows_RecordTmpShowSlect = mysqli_num_rows($RecordTmpShowSlect);
  // 新增一筆版型資料
  $insertSQL = sprintf("INSERT INTO demo_tmp (userid, name, title, homeselect, homestyle, tmpwebwidth, tmpwebwidthunit, tmpfbfanselect, tmpfbfanbkcolor, tmpfbfanboardcolor, author, type, pic, content, postdate, indicate, sdescription, skeyword, pushtop, tmplogo, tmplogoid, tmpmainmenu, tmpmainmenuindicate, tmpsubmainmenuindicate, tmpleftmenu, tmpblock, tmpshowblockname, tmpdftmenu_x, tmpdftmenu_y, tmppicmenu_x, tmppicmenu_y, tmppicmenu_style, tmpbannerpic, tmpbannerpicwidth, tmpbannerpicheight, tmpautobanner1, tmpautobanner2, tmpautobanner3, tmpautobanner4, tmpautobanner5, tmpselectbannerid, tmphomeenterselect, tmphomeenterdefaultpic, tmphomeenterpic, tmphomeenterpicsource, tmplogowidth, tmplogoheight, tmplogomargintop, tmplogomarginleft, tmphomelogomargintop, tmphomelogomarginleft, tmphomeentermarginbottom, tmphomeentermarginright, tmpwordcolor, tmpwordsize, tmplink, tmplinkvisit, tmplinkhover, tmpheaderminheight, tmptitlebackground, tmptitlelinebackground, tmpleftminheight, tmpmiddleminheight, tmprightminheight, tmpfooterminheight, tmpbanner, tmpdfmenucolor, tmpmenuselect, tmpbodyselect, tmpmenulimit, tmpbodybackground, tmpanimebackground, tmpbottombackground, tmpheaderbackground, tmpwrpbackground, tmpleftbackground, tmprightbackground, tmpmiddlebackground, tmpfooterbackground, tmphomeboard, tmpwrpboard, tmpbannerboard, tmpheaderboard, tmpleftboard, tmprightboard, tmptitleboard, tmpmiddleboard, tmpfooterboard, tmpmeger_t_m, tmpheaderpaddingtop, tmpheaderpaddingbttom, tmpheaderpaddingleft, tmpheaderpaddingright, tmpbannerpaddingtop, tmpbannerpaddingbttom, tmpbannerpaddingleft, tmpbannerpaddingright, tmpleftpaddingtop, tmpleftpaddingbttom, tmpleftpaddingleft, tmpleftpaddingright, tmprightpaddingtop, tmprightpaddingbttom, tmprightpaddingleft, tmprightpaddingright, tmpmiddlepaddingtop, tmpmiddlepaddingbttom, tmpmiddlepaddingleft, tmpmiddlepaddingright, tmp_middle_title_font_color, tmp_middle_title_x, tmp_middle_title_height, tmpfooterpaddingtop, tmpfooterpaddingbttom, tmpfooterpaddingleft, tmpfooterpaddingright, tmpfooterfontcolor, tmpproductboard, tmpproductboardicon, tmpproductboardfontcolor, tmpproductviewcolumn, tmpnewsoddbackground, tmpnewsevenbackground, tmpnewstopbackground, tmpprojectboard, tmpprojectboardicon, tmpactivitiesboard, tmpactivitiesboardicon, tmpfrilinkboard, tmpfrilinkboardicon, tmporgboard, tmporgboardicon, tmpsponsorboard, tmpsponsorboardicon, tmppartnerboard, tmppartnerboardicon, tmpartlistboard, tmpartlistboardicon, tmppublishindicate, notes1, notes2, sortid, lang, webname, webnameorigin) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['name'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['title'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['homeselect'], "int"),
					   GetSQLValueString($row_RecordTmpShowSlect['homestyle'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpwebwidth'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpwebwidthunit'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfbfanselect'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfbfanbkcolor'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfbfanboardcolor'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['author'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['type'], "text"),
                       GetSQLValueString("", "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['content'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['postdate'], "date"),
                       GetSQLValueString($row_RecordTmpShowSlect['indicate'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['sdescription'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['skeyword'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['pushtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplogo'], "text"),
                       GetSQLValueString($row_RecordMyLogo['id'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmainmenu'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmainmenuindicate'], "int"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmpsubmainmenuindicate'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftmenu'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpblock'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpshowblockname'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpdftmenu_x'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpdftmenu_y'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmppicmenu_x'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmppicmenu_y'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmppicmenu_style'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpic'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpicwidth'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpicheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpautobanner1'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpautobanner2'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpautobanner3'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpautobanner4'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpautobanner5'], "text"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmpselectbannerid'], "int"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomeenterselect'], "int"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomeenterdefaultpic'], "text"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomeenterpic'], "text"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomeenterpicsource'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplogowidth'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplogoheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplogomargintop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplogomarginleft'], "int"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomelogomargintop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmphomelogomarginleft'], "int"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomeentermarginbottom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmphomeentermarginright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpwordcolor'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpwordsize'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplink'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplinkvisit'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplinkhover'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderminheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmptitlebackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmptitlelinebackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftminheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddleminheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightminheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterminheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbanner'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpdfmenucolor'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmenuselect'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbodyselect'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmenulimit'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbodybackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpanimebackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbottombackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpwrpbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddlebackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterbackground'], "text"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomeboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpwrpboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmptitleboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddleboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmeger_t_m'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderpaddingtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderpaddingbttom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderpaddingleft'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderpaddingright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpaddingtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpaddingbttom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpaddingleft'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpaddingright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftpaddingtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftpaddingbttom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftpaddingleft'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftpaddingright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightpaddingtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightpaddingbttom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightpaddingleft'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightpaddingright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddlepaddingtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddlepaddingbttom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddlepaddingleft'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddlepaddingright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmp_middle_title_font_color'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmp_middle_title_x'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmp_middle_title_height'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterpaddingtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterpaddingbttom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterpaddingleft'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterpaddingright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterfontcolor'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpproductboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpproductboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpproductboardfontcolor'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpproductviewcolumn'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpnewsoddbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpnewsevenbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpnewstopbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpprojectboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpprojectboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpactivitiesboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpactivitiesboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfrilinkboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfrilinkboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmporgboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmporgboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpsponsorboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpsponsorboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmppartnerboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmppartnerboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpartlistboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpartlistboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmppublishindicate'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['notes1'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['notes2'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['sortid'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['lang'], "text"),
					   GetSQLValueString($_POST['webname'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['webnameorigin'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  // 取得目前版型id
    $colname_RecordMyTmp = "-1";
	if (isset($_POST['webname'])) {
	  $colname_RecordMyTmp = $_POST['webname'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordMyTmp = sprintf("SELECT id FROM demo_tmp WHERE webname = %s ORDER BY id DESC", GetSQLValueString($colname_RecordMyTmp, "text"));
	$RecordMyTmp = mysqli_query($DB_Conn, $query_RecordMyTmp) or die(mysqli_error($DB_Conn));
	$row_RecordMyTmp = mysqli_fetch_assoc($RecordMyTmp);
	$totalRows_RecordMyTmp = mysqli_num_rows($RecordMyTmp);
  
  // 插入設定檔案
  $insertSQLSettingFr = sprintf("INSERT INTO demo_setting_fr (MSTmpSelect, MSTmpSelectRwd, alltypelistLock, frilinkLock, alllistLock, homecontenttwsmall, homecontentcnsmall, homecontentensmall, homecontenttwsmall2, homecontentcnsmall2, homecontentensmall2, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($row_RecordMyTmp['id'], "int"), // 版型選擇
					   GetSQLValueString($row_RecordMyTmp['id'], "int"), // 版型選擇
					   GetSQLValueString("1", "int"), // 子分類 - 自訂欄位
					   GetSQLValueString("1", "int"), // 友站 - 自訂欄位
					   GetSQLValueString("0", "int"), // 全部選單 - 自訂欄位
					   GetSQLValueString($Home_Content_Sample01, "text"), // 預設圖片
					   GetSQLValueString($Home_Content_Sample01, "text"), // 預設圖片
					   GetSQLValueString($Home_Content_Sample01, "text"), // 預設圖片
					   GetSQLValueString($Home_Content_Sample02, "text"), // 預設圖片
					   GetSQLValueString($Home_Content_Sample02, "text"), // 預設圖片
					   GetSQLValueString($Home_Content_Sample02, "text"), // 預設圖片
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultSettingFr = mysqli_query($DB_Conn, $insertSQLSettingFr) or die(mysqli_error($DB_Conn));
  
  // 插入設定檔案
  $insertSQLSettingOtr = sprintf("INSERT INTO demo_setting_otr (userid) VALUES (%s)",
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultSettingOtr = mysqli_query($DB_Conn, $insertSQLSettingOtr) or die(mysqli_error($DB_Conn));
  
  // 插入自訂頁面
  $insertSQLDftypeAbout = sprintf("INSERT INTO demo_dftype (title, home, typemenu, sortid, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("關於我們", "text"),
					   GetSQLValueString("1", "int"), // 設定首頁
					   GetSQLValueString("About", "text"),
					   GetSQLValueString("1", "int"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeAbout = mysqli_query($DB_Conn, $insertSQLDftypeAbout) or die(mysqli_error($DB_Conn));
  
  $insertSQLDftypeNews = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, userid) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString("最新訊息", "text"),
					   GetSQLValueString("News", "text"),
					   GetSQLValueString("2", "int"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeNews = mysqli_query($DB_Conn, $insertSQLDftypeNews) or die(mysqli_error($DB_Conn));
  
  $insertSQLDftypeProduct = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, userid) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString("商品櫥窗", "text"),
					   GetSQLValueString("Product", "text"),
					   GetSQLValueString("3", "int"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeProduct = mysqli_query($DB_Conn, $insertSQLDftypeProduct) or die(mysqli_error($DB_Conn)); 
  
  $insertSQLDftypeCart = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, userid) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString("購物車", "text"),
					   GetSQLValueString("Cart", "text"),
					   GetSQLValueString("4", "int"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeCart = mysqli_query($DB_Conn, $insertSQLDftypeCart) or die(mysqli_error($DB_Conn));
  
  $insertSQLDftypeFaq = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, userid) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString("常見問答", "text"),
					   GetSQLValueString("Faq", "text"),
					   GetSQLValueString("5", "int"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeFaq = mysqli_query($DB_Conn, $insertSQLDftypeFaq) or die(mysqli_error($DB_Conn));
  
  $insertSQLDftypeContact = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, userid) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString("聯絡我們", "text"),
					   GetSQLValueString("Contact", "text"),
					   GetSQLValueString("6", "int"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeContact = mysqli_query($DB_Conn, $insertSQLDftypeContact) or die(mysqli_error($DB_Conn));
  
  // 插入自訂頁面 - END
  
  // 插入自訂欄位
  $insertSQLTmpColumnProduct = sprintf("INSERT INTO demo_tmpcolumn (type, style, dftname, customname, sortid, userid) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("alltypelist", "text"),
					   GetSQLValueString("menu", "text"),
					   GetSQLValueString("子分類", "text"),
					   GetSQLValueString("子分類", "text"),
					   GetSQLValueString("1", "int"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultTmpColumnProduct = mysqli_query($DB_Conn, $insertSQLTmpColumnProduct) or die(mysqli_error($DB_Conn));
  
  $insertSQLTmpColumnFrilink = sprintf("INSERT INTO demo_tmpcolumn (type, style, dftname, customname, sortid, userid) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("frilink", "text"),
					   GetSQLValueString("menu", "text"),
					   GetSQLValueString("友站連結", "text"),
					   GetSQLValueString("友站連結", "text"),
					   GetSQLValueString("2", "int"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultTmpColumnFrilink = mysqli_query($DB_Conn, $insertSQLTmpColumnFrilink) or die(mysqli_error($DB_Conn));
  
  // 插入自訂欄位 - END
  
  // 插入關於我們資料
  $desc_show_about = "<img src=\"http://www.shop3500.com/images/desc_01.jpg\" width=\"700\" height=\"566\" />";
  $insertSQLAbout = sprintf("INSERT INTO demo_about (title, content, home, userid) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString("公司簡介", "text"), // 
					   GetSQLValueString($desc_show_about, "text"), // 
					   GetSQLValueString("1", "int"), // 
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));
  
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultAbout = mysqli_query($DB_Conn, $insertSQLAbout) or die(mysqli_error($DB_Conn));
  
  // 插入商品櫥窗分類資料
  $insertSQLProductListB = sprintf("INSERT INTO demo_productitem (list_id, itemname, level, endnode, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("1", "int"), // 
                       GetSQLValueString("商品分類B", "text"), // 
					   GetSQLValueString("0", "int"), // 
					   GetSQLValueString("child", "text"), // 
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));
  
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultProductListB = mysqli_query($DB_Conn, $insertSQLProductListB) or die(mysqli_error($DB_Conn));
  
  $insertSQLProductListA = sprintf("INSERT INTO demo_productitem (list_id, itemname, level, endnode, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("1", "int"), // 
                       GetSQLValueString("商品分類A", "text"), // 
					   GetSQLValueString("0", "int"), // 
					   GetSQLValueString("child", "text"), // 
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));
  
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultProductListA = mysqli_query($DB_Conn, $insertSQLProductListA) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Add'] = "Success";
  $insertGoTo = "manage_webuser.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
}


//------------------------------------------------------------------------------------------------------------------------
// \購物商城
//------------------------------------------------------------------------------------------------------------------------


//------------------------------------------------------------------------------------------------------------------------
// 一般企業網站[基本]
//------------------------------------------------------------------------------------------------------------------------
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Webuser") && $_POST["modselect"] == '3') {
  $insertSQL = sprintf("INSERT INTO demo_admin (account, psw, name, webname, `level`, notes1) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['account'], "text"),
                       GetSQLValueString($_POST['psw'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['webname'], "text"),
                       GetSQLValueString($_POST['level'], "text"),
                       GetSQLValueString($_POST['notes1'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  // 取得目前新增資料
	$colname_RecordWebuserUserid = "-1";
	if (isset($_POST['webname'])) {
	  $colname_RecordWebuserUserid = $_POST['webname'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordWebuserUserid = sprintf("SELECT id FROM demo_admin WHERE webname = %s ORDER BY id DESC", GetSQLValueString($colname_RecordWebuserUserid, "text"));
	$RecordWebuserUserid = mysqli_query($DB_Conn, $query_RecordWebuserUserid) or die(mysqli_error($DB_Conn));
	$row_RecordWebuserUserid = mysqli_fetch_assoc($RecordWebuserUserid);
	$totalRows_RecordWebuserUserid = mysqli_num_rows($RecordWebuserUserid);

	//echo $row_RecordWebuserUserid['id']; //抓取之id直
  // 插入設定檔案
  if($_POST['uselangtw'] == '1' && $_POST['uselangcn'] == '0' && $_POST['uselangen'] == '0' && $_POST['uselangjp'] == '0')
  {
	  $_POST['uselangtw'] = '0';
  }
  if($_POST['uselangtw'] != '1') {$_POST['uselangtw'] = "0";}
  if($_POST['uselangcn'] != '1') {$_POST['uselangcn'] = "0";}
  if($_POST['uselangen'] != '1') {$_POST['uselangen'] = "0";}
  if($_POST['uselangjp'] != '1') {$_POST['uselangjp'] = "0";}
  
  $insertSQLSetting = sprintf("INSERT INTO demo_setting (Defaultlang, LangChooseZHTW, LangChooseZHCN, LangChooseEN, LangChooseJP, OptionNewsSelect, OptionFaqSelect, OptionProductSelect, OptionFrilinkSelect, OptionPublishSelect, OptionGuestbookSelect, OptionActivitiesSelect, OptionProjectSelect, OptionArticleSelect, OptionAboutSelect, OptionContactSelect, OptionDfPageSelect, OptionCatalogSelect, OptionCartSelect, OptionMobileSelect, dfpage_limit_page_num, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Defaultlang'], "text"), // 繁
                       GetSQLValueString($_POST['uselangtw'], "int"), // 繁
					   GetSQLValueString($_POST['uselangcn'], "int"), // 簡
					   GetSQLValueString($_POST['uselangen'], "int"), // 英
					   GetSQLValueString($_POST['uselangjp'], "int"), // 日
					   GetSQLValueString("1", "int"), // 最新訊息
					   GetSQLValueString("0", "int"), // 常見問答
					   GetSQLValueString("1", "int"), // 商品櫥窗
					   GetSQLValueString("1", "int"), // 友站連結
					   GetSQLValueString("0", "int"), // 發布資訊
					   GetSQLValueString("0", "int"), // 留言訊息
					   GetSQLValueString("0", "int"), // 活動花絮
					   GetSQLValueString("0", "int"), // 工程實績
					   GetSQLValueString("0", "int"), // 文章管理
					   GetSQLValueString("1", "int"), // 關於我們
					   GetSQLValueString("1", "int"), // 聯絡我們
					   GetSQLValueString("1", "int"), // 自訂頁面
					   GetSQLValueString("0", "int"), // 產品型錄
					   GetSQLValueString("0", "int"), // 購物車
					   GetSQLValueString("1", "int"), // 手機模組
					   GetSQLValueString("5", "int"), // 頁面限制頁數
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultSetting = mysqli_query($DB_Conn, $insertSQLSetting) or die(mysqli_error($DB_Conn));
  
    // 插入logo
  $insertSQLLogo = sprintf("INSERT INTO demo_tmplogo (name, type, logoname, logocolor, logofontsize, logotype, lang, userid, webname) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("我的文字Logo", "text"),
                       GetSQLValueString("個人", "text"),
					   GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString("#000000", "text"),
                       GetSQLValueString("36px", "text"),
					   GetSQLValueString("1", "int"),
                       GetSQLValueString("zh-tw", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"),
                       GetSQLValueString($_POST['webname'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultLogo = mysqli_query($DB_Conn, $insertSQLLogo) or die(mysqli_error($DB_Conn));
  
  // 取得目前logo id
    $colname_RecordMyLogo = "-1";
	if (isset($_POST['webname'])) {
	  $colname_RecordMyLogo = $_POST['webname'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordMyLogo = sprintf("SELECT id FROM demo_tmplogo WHERE webname = %s ORDER BY id DESC", GetSQLValueString($colname_RecordMyLogo, "text"));
	$RecordMyLogo = mysqli_query($DB_Conn, $query_RecordMyLogo) or die(mysqli_error($DB_Conn));
	$row_RecordMyLogo = mysqli_fetch_assoc($RecordMyLogo);
	$totalRows_RecordMyLogo = mysqli_num_rows($RecordMyLogo);
	
  // 取得複製版型資料 
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpShowSlect = sprintf("SELECT * FROM demo_tmp WHERE id = 101");
$RecordTmpShowSlect = mysqli_query($DB_Conn, $query_RecordTmpShowSlect) or die(mysqli_error($DB_Conn));
$row_RecordTmpShowSlect = mysqli_fetch_assoc($RecordTmpShowSlect);
$totalRows_RecordTmpShowSlect = mysqli_num_rows($RecordTmpShowSlect);
  // 新增一筆版型資料
  $insertSQL = sprintf("INSERT INTO demo_tmp (userid, name, title, homeselect, homestyle, tmpwebwidth, tmpwebwidthunit, tmpfbfanselect, tmpfbfanbkcolor, tmpfbfanboardcolor, author, type, pic, content, postdate, indicate, sdescription, skeyword, pushtop, tmplogo, tmplogoid, tmpmainmenu, tmpmainmenuindicate, tmpsubmainmenuindicate, tmpleftmenu, tmpblock, tmpshowblockname, tmpdftmenu_x, tmpdftmenu_y, tmppicmenu_x, tmppicmenu_y, tmppicmenu_style, tmpbannerpic, tmpbannerpicwidth, tmpbannerpicheight, tmpautobanner1, tmpautobanner2, tmpautobanner3, tmpautobanner4, tmpautobanner5, tmpselectbannerid, tmphomeenterselect, tmphomeenterdefaultpic, tmphomeenterpic, tmphomeenterpicsource, tmplogowidth, tmplogoheight, tmplogomargintop, tmplogomarginleft, tmphomelogomargintop, tmphomelogomarginleft, tmphomeentermarginbottom, tmphomeentermarginright, tmpwordcolor, tmpwordsize, tmplink, tmplinkvisit, tmplinkhover, tmpheaderminheight, tmptitlebackground, tmptitlelinebackground, tmpleftminheight, tmpmiddleminheight, tmprightminheight, tmpfooterminheight, tmpbanner, tmpdfmenucolor, tmpmenuselect, tmpbodyselect, tmpmenulimit, tmpbodybackground, tmpanimebackground, tmpbottombackground, tmpheaderbackground, tmpwrpbackground, tmpleftbackground, tmprightbackground, tmpmiddlebackground, tmpfooterbackground, tmphomeboard, tmpwrpboard, tmpbannerboard, tmpheaderboard, tmpleftboard, tmprightboard, tmptitleboard, tmpmiddleboard, tmpfooterboard, tmpmeger_t_m, tmpheaderpaddingtop, tmpheaderpaddingbttom, tmpheaderpaddingleft, tmpheaderpaddingright, tmpbannerpaddingtop, tmpbannerpaddingbttom, tmpbannerpaddingleft, tmpbannerpaddingright, tmpleftpaddingtop, tmpleftpaddingbttom, tmpleftpaddingleft, tmpleftpaddingright, tmprightpaddingtop, tmprightpaddingbttom, tmprightpaddingleft, tmprightpaddingright, tmpmiddlepaddingtop, tmpmiddlepaddingbttom, tmpmiddlepaddingleft, tmpmiddlepaddingright, tmp_middle_title_font_color, tmp_middle_title_x, tmp_middle_title_height, tmpfooterpaddingtop, tmpfooterpaddingbttom, tmpfooterpaddingleft, tmpfooterpaddingright, tmpfooterfontcolor, tmpproductboard, tmpproductboardicon, tmpproductboardfontcolor, tmpproductviewcolumn, tmpnewsoddbackground, tmpnewsevenbackground, tmpnewstopbackground, tmpprojectboard, tmpprojectboardicon, tmpactivitiesboard, tmpactivitiesboardicon, tmpfrilinkboard, tmpfrilinkboardicon, tmporgboard, tmporgboardicon, tmpsponsorboard, tmpsponsorboardicon, tmppartnerboard, tmppartnerboardicon, tmpartlistboard, tmpartlistboardicon, tmppublishindicate, notes1, notes2, sortid, lang, webname, webnameorigin) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['name'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['title'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['homeselect'], "int"),
					   GetSQLValueString($row_RecordTmpShowSlect['homestyle'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpwebwidth'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpwebwidthunit'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfbfanselect'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfbfanbkcolor'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfbfanboardcolor'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['author'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['type'], "text"),
                       GetSQLValueString("", "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['content'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['postdate'], "date"),
                       GetSQLValueString($row_RecordTmpShowSlect['indicate'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['sdescription'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['skeyword'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['pushtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplogo'], "text"),
                       GetSQLValueString($row_RecordMyLogo['id'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmainmenu'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmainmenuindicate'], "int"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmpsubmainmenuindicate'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftmenu'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpblock'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpshowblockname'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpdftmenu_x'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpdftmenu_y'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmppicmenu_x'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmppicmenu_y'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmppicmenu_style'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpic'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpicwidth'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpicheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpautobanner1'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpautobanner2'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpautobanner3'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpautobanner4'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpautobanner5'], "text"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmpselectbannerid'], "int"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomeenterselect'], "int"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomeenterdefaultpic'], "text"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomeenterpic'], "text"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomeenterpicsource'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplogowidth'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplogoheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplogomargintop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplogomarginleft'], "int"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomelogomargintop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmphomelogomarginleft'], "int"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomeentermarginbottom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmphomeentermarginright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpwordcolor'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpwordsize'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplink'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplinkvisit'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplinkhover'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderminheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmptitlebackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmptitlelinebackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftminheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddleminheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightminheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterminheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbanner'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpdfmenucolor'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmenuselect'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbodyselect'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmenulimit'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbodybackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpanimebackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbottombackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpwrpbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddlebackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterbackground'], "text"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomeboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpwrpboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmptitleboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddleboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmeger_t_m'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderpaddingtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderpaddingbttom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderpaddingleft'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderpaddingright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpaddingtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpaddingbttom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpaddingleft'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpaddingright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftpaddingtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftpaddingbttom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftpaddingleft'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftpaddingright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightpaddingtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightpaddingbttom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightpaddingleft'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightpaddingright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddlepaddingtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddlepaddingbttom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddlepaddingleft'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddlepaddingright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmp_middle_title_font_color'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmp_middle_title_x'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmp_middle_title_height'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterpaddingtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterpaddingbttom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterpaddingleft'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterpaddingright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterfontcolor'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpproductboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpproductboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpproductboardfontcolor'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpproductviewcolumn'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpnewsoddbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpnewsevenbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpnewstopbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpprojectboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpprojectboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpactivitiesboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpactivitiesboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfrilinkboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfrilinkboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmporgboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmporgboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpsponsorboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpsponsorboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmppartnerboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmppartnerboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpartlistboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpartlistboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmppublishindicate'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['notes1'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['notes2'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['sortid'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['lang'], "text"),
					   GetSQLValueString($_POST['webname'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['webnameorigin'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  // 取得目前版型id
    $colname_RecordMyTmp = "-1";
	if (isset($_POST['webname'])) {
	  $colname_RecordMyTmp = $_POST['webname'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordMyTmp = sprintf("SELECT id FROM demo_tmp WHERE webname = %s ORDER BY id DESC", GetSQLValueString($colname_RecordMyTmp, "text"));
	$RecordMyTmp = mysqli_query($DB_Conn, $query_RecordMyTmp) or die(mysqli_error($DB_Conn));
	$row_RecordMyTmp = mysqli_fetch_assoc($RecordMyTmp);
	$totalRows_RecordMyTmp = mysqli_num_rows($RecordMyTmp);
  
  // 插入設定檔案
  $insertSQLSettingFr = sprintf("INSERT INTO demo_setting_fr (MSTmpSelect, MSTmpSelectRwd, productlistLock, frilinkLock, alllistLock, homecontenttwsmall, homecontentcnsmall, homecontentensmall, homecontenttwsmall2, homecontentcnsmall2, homecontentensmall2, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($row_RecordMyTmp['id'], "int"), // 版型選擇
					   GetSQLValueString($row_RecordMyTmp['id'], "int"), // 版型選擇
					   GetSQLValueString("1", "int"), // 產品 - 自訂欄位
					   GetSQLValueString("1", "int"), // 友站 - 自訂欄位
					   GetSQLValueString("0", "int"), // 全部選單 - 自訂欄位
					   GetSQLValueString($Home_Content_Sample01, "text"), // 預設圖片
					   GetSQLValueString($Home_Content_Sample01, "text"), // 預設圖片
					   GetSQLValueString($Home_Content_Sample01, "text"), // 預設圖片
					   GetSQLValueString($Home_Content_Sample02, "text"), // 預設圖片
					   GetSQLValueString($Home_Content_Sample02, "text"), // 預設圖片
					   GetSQLValueString($Home_Content_Sample02, "text"), // 預設圖片
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultSettingFr = mysqli_query($DB_Conn, $insertSQLSettingFr) or die(mysqli_error($DB_Conn));
  
  // 插入設定檔案
  $insertSQLSettingOtr = sprintf("INSERT INTO demo_setting_otr (userid) VALUES (%s)",
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultSettingOtr = mysqli_query($DB_Conn, $insertSQLSettingOtr) or die(mysqli_error($DB_Conn));
  
  if($_POST['uselangcn'] == '1'){
	  $updateSQL = sprintf("UPDATE demo_setting_fr SET productlistLock_cn=%s, frilinkLock_cn=%s, alllistLock_cn=%s WHERE userid=%s",
                       GetSQLValueString("1", "int"), // 產品 - 自訂欄位
					   GetSQLValueString("0", "int"), // 友站 - 自訂欄位
					   GetSQLValueString("0", "int"), // 全部選單 - 自訂欄位
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  }
  if($_POST['uselangen'] == '1'){
	  $updateSQL = sprintf("UPDATE demo_setting_fr SET productlistLock_en=%s, frilinkLock_en=%s, alllistLock_en=%s WHERE userid=%s",
                       GetSQLValueString("1", "int"), // 產品 - 自訂欄位
					   GetSQLValueString("0", "int"), // 友站 - 自訂欄位
					   GetSQLValueString("0", "int"), // 全部選單 - 自訂欄位
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  }
  if($_POST['uselangjp'] == '1'){
	  $updateSQL = sprintf("UPDATE demo_setting_fr SET productlistLock_jp=%s, frilinkLock_jp=%s, alllistLock_jp=%s WHERE userid=%s",
                       GetSQLValueString("1", "int"), // 產品 - 自訂欄位
					   GetSQLValueString("0", "int"), // 友站 - 自訂欄位
					   GetSQLValueString("0", "int"), // 全部選單 - 自訂欄位
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  }
  
  // 插入自訂頁面
  $insertSQLDftypeAbout = sprintf("INSERT INTO demo_dftype (title, home, typemenu, sortid, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("關於我們", "text"),
					   GetSQLValueString("1", "int"), // 設定首頁
					   GetSQLValueString("About", "text"),
					   GetSQLValueString("1", "int"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeAbout = mysqli_query($DB_Conn, $insertSQLDftypeAbout) or die(mysqli_error($DB_Conn));
  
  if($_POST['uselangcn'] == '1'){
	  
	  $insertSQLDftypeAbout = sprintf("INSERT INTO demo_dftype (title, home, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("关于我们", "text"),
					   GetSQLValueString("1", "int"), // 設定首頁
					   GetSQLValueString("About", "text"),
					   GetSQLValueString("1", "int"),
					   GetSQLValueString("zh-cn", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeAbout = mysqli_query($DB_Conn, $insertSQLDftypeAbout) or die(mysqli_error($DB_Conn));
  
  }
  
  if($_POST['uselangen'] == '1'){
	  
	  $insertSQLDftypeAbout = sprintf("INSERT INTO demo_dftype (title, home, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("About", "text"),
					   GetSQLValueString("1", "int"), // 設定首頁
					   GetSQLValueString("About", "text"),
					   GetSQLValueString("1", "int"),
					   GetSQLValueString("en", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeAbout = mysqli_query($DB_Conn, $insertSQLDftypeAbout) or die(mysqli_error($DB_Conn));
  
  }
  
  if($_POST['uselangjp'] == '1'){
	  
	  $insertSQLDftypeAbout = sprintf("INSERT INTO demo_dftype (title, home, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("会社の案内書", "text"),
					   GetSQLValueString("1", "int"), // 設定首頁
					   GetSQLValueString("About", "text"),
					   GetSQLValueString("1", "int"),
					   GetSQLValueString("jp", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeAbout = mysqli_query($DB_Conn, $insertSQLDftypeAbout) or die(mysqli_error($DB_Conn));
  
  }
  
  $insertSQLDftypeNews = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, userid) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString("最新訊息", "text"),
					   GetSQLValueString("News", "text"),
					   GetSQLValueString("2", "int"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeNews = mysqli_query($DB_Conn, $insertSQLDftypeNews) or die(mysqli_error($DB_Conn));
  
  if($_POST['uselangcn'] == '1'){
	  $insertSQLDftypeNews = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("最新讯息", "text"),
					   GetSQLValueString("News", "text"),
					   GetSQLValueString("2", "int"),
					   GetSQLValueString("zh-cn", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeNews = mysqli_query($DB_Conn, $insertSQLDftypeNews) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangen'] == '1'){
	  $insertSQLDftypeNews = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("News", "text"),
					   GetSQLValueString("News", "text"),
					   GetSQLValueString("2", "int"),
					   GetSQLValueString("en", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeNews = mysqli_query($DB_Conn, $insertSQLDftypeNews) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangjp'] == '1'){
	  $insertSQLDftypeNews = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("最新の情報", "text"),
					   GetSQLValueString("News", "text"),
					   GetSQLValueString("2", "int"),
					   GetSQLValueString("jp", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeNews = mysqli_query($DB_Conn, $insertSQLDftypeNews) or die(mysqli_error($DB_Conn));
  }
  
  $insertSQLDftypeProduct = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, userid) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString("商品櫥窗", "text"),
					   GetSQLValueString("Product", "text"),
					   GetSQLValueString("3", "int"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeProduct = mysqli_query($DB_Conn, $insertSQLDftypeProduct) or die(mysqli_error($DB_Conn));
  
  if($_POST['uselangcn'] == '1'){
	  $insertSQLDftypeProduct = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("商品橱窗", "text"),
					   GetSQLValueString("Product", "text"),
					   GetSQLValueString("3", "int"),
					   GetSQLValueString("zh-cn", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeProduct = mysqli_query($DB_Conn, $insertSQLDftypeProduct) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangen'] == '1'){
	  $insertSQLDftypeProduct = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("Product", "text"),
					   GetSQLValueString("Product", "text"),
					   GetSQLValueString("3", "int"),
					   GetSQLValueString("en", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeProduct = mysqli_query($DB_Conn, $insertSQLDftypeProduct) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangjp'] == '1'){
	  $insertSQLDftypeProduct = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("製品の情報", "text"),
					   GetSQLValueString("Product", "text"),
					   GetSQLValueString("3", "int"),
					   GetSQLValueString("jp", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeProduct = mysqli_query($DB_Conn, $insertSQLDftypeProduct) or die(mysqli_error($DB_Conn));
  }
  
  $insertSQLDftypeContact = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, userid) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString("聯絡我們", "text"),
					   GetSQLValueString("Contact", "text"),
					   GetSQLValueString("4", "int"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeContact = mysqli_query($DB_Conn, $insertSQLDftypeContact) or die(mysqli_error($DB_Conn));
  
  if($_POST['uselangcn'] == '1'){
	  $insertSQLDftypeContact = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("联络我们", "text"),
					   GetSQLValueString("Contact", "text"),
					   GetSQLValueString("4", "int"),
					   GetSQLValueString("zh-cn", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeContact = mysqli_query($DB_Conn, $insertSQLDftypeContact) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangen'] == '1'){
	  $insertSQLDftypeContact = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("Contact", "text"),
					   GetSQLValueString("Contact", "text"),
					   GetSQLValueString("4", "int"),
					   GetSQLValueString("en", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeContact = mysqli_query($DB_Conn, $insertSQLDftypeContact) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangjp'] == '1'){
	  $insertSQLDftypeContact = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("私達を連絡", "text"),
					   GetSQLValueString("Contact", "text"),
					   GetSQLValueString("4", "int"),
					   GetSQLValueString("jp", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeContact = mysqli_query($DB_Conn, $insertSQLDftypeContact) or die(mysqli_error($DB_Conn));
  }
  
  // 插入自訂頁面 - END
  
  // 插入自訂欄位
  $insertSQLTmpColumnProduct = sprintf("INSERT INTO demo_tmpcolumn (type, style, dftname, customname, sortid, userid) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("productlist", "text"),
					   GetSQLValueString("menu", "text"),
					   GetSQLValueString("產品分類", "text"),
					   GetSQLValueString("產品分類", "text"),
					   GetSQLValueString("1", "int"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultTmpColumnProduct = mysqli_query($DB_Conn, $insertSQLTmpColumnProduct) or die(mysqli_error($DB_Conn));
  
  if($_POST['uselangcn'] == '1'){
	  $insertSQLTmpColumnProduct = sprintf("INSERT INTO demo_tmpcolumn (type, style, dftname, customname, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("productlist", "text"),
					   GetSQLValueString("menu", "text"),
					   GetSQLValueString("產品分類", "text"),
					   GetSQLValueString("产品分类", "text"),
					   GetSQLValueString("1", "int"),
					   GetSQLValueString("zh-cn", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultTmpColumnProduct = mysqli_query($DB_Conn, $insertSQLTmpColumnProduct) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangen'] == '1'){
	  $insertSQLTmpColumnProduct = sprintf("INSERT INTO demo_tmpcolumn (type, style, dftname, customname, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("productlist", "text"),
					   GetSQLValueString("menu", "text"),
					   GetSQLValueString("產品分類", "text"),
					   GetSQLValueString("Product", "text"),
					   GetSQLValueString("1", "int"),
					   GetSQLValueString("en", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultTmpColumnProduct = mysqli_query($DB_Conn, $insertSQLTmpColumnProduct) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangjp'] == '1'){
	  $insertSQLTmpColumnProduct = sprintf("INSERT INTO demo_tmpcolumn (type, style, dftname, customname, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("productlist", "text"),
					   GetSQLValueString("menu", "text"),
					   GetSQLValueString("產品分類", "text"),
					   GetSQLValueString("プロダクト", "text"),
					   GetSQLValueString("1", "int"),
					   GetSQLValueString("jp", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultTmpColumnProduct = mysqli_query($DB_Conn, $insertSQLTmpColumnProduct) or die(mysqli_error($DB_Conn));
  }
  
  $insertSQLTmpColumnFrilink = sprintf("INSERT INTO demo_tmpcolumn (type, style, dftname, customname, sortid, userid) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("frilink", "text"),
					   GetSQLValueString("menu", "text"),
					   GetSQLValueString("友站連結", "text"),
					   GetSQLValueString("友站連結", "text"),
					   GetSQLValueString("2", "int"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultTmpColumnFrilink = mysqli_query($DB_Conn, $insertSQLTmpColumnFrilink) or die(mysqli_error($DB_Conn));
  
  // 插入自訂欄位 - END
  
  // 插入關於我們資料
  $desc_show_about = "<img src=\"http://www.shop3500.com/images/desc_01.jpg\" width=\"700\" height=\"566\" />";
  $insertSQLAbout = sprintf("INSERT INTO demo_about (title, content, home, userid) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString("公司簡介", "text"), // 
					   GetSQLValueString($desc_show_about, "text"), // 
					   GetSQLValueString("1", "int"), // 
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));
  
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultAbout = mysqli_query($DB_Conn, $insertSQLAbout) or die(mysqli_error($DB_Conn));
  
  // 插入商品櫥窗分類資料
  $insertSQLProductListB = sprintf("INSERT INTO demo_productitem (list_id, itemname, level, endnode, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("1", "int"), // 
                       GetSQLValueString("商品分類B", "text"), // 
					   GetSQLValueString("0", "int"), // 
					   GetSQLValueString("child", "text"), // 
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));
  
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultProductListB = mysqli_query($DB_Conn, $insertSQLProductListB) or die(mysqli_error($DB_Conn));
  
  $insertSQLProductListA = sprintf("INSERT INTO demo_productitem (list_id, itemname, level, endnode, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("1", "int"), // 
                       GetSQLValueString("商品分類A", "text"), // 
					   GetSQLValueString("0", "int"), // 
					   GetSQLValueString("child", "text"), // 
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));
  
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultProductListA = mysqli_query($DB_Conn, $insertSQLProductListA) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Add'] = "Success";
  $insertGoTo = "manage_webuser.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
}

//------------------------------------------------------------------------------------------------------------------------
// \一般企業網站[基本]
//------------------------------------------------------------------------------------------------------------------------

//------------------------------------------------------------------------------------------------------------------------
// 一般企業網站[進階]
//------------------------------------------------------------------------------------------------------------------------
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Webuser") && $_POST["modselect"] == '4') {
  $insertSQL = sprintf("INSERT INTO demo_admin (account, psw, name, webname, `level`, notes1) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['account'], "text"),
                       GetSQLValueString($_POST['psw'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['webname'], "text"),
                       GetSQLValueString($_POST['level'], "text"),
                       GetSQLValueString($_POST['notes1'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  // 取得目前新增資料
	$colname_RecordWebuserUserid = "-1";
	if (isset($_POST['webname'])) {
	  $colname_RecordWebuserUserid = $_POST['webname'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordWebuserUserid = sprintf("SELECT id FROM demo_admin WHERE webname = %s ORDER BY id DESC", GetSQLValueString($colname_RecordWebuserUserid, "text"));
	$RecordWebuserUserid = mysqli_query($DB_Conn, $query_RecordWebuserUserid) or die(mysqli_error($DB_Conn));
	$row_RecordWebuserUserid = mysqli_fetch_assoc($RecordWebuserUserid);
	$totalRows_RecordWebuserUserid = mysqli_num_rows($RecordWebuserUserid);

	//echo $row_RecordWebuserUserid['id']; //抓取之id直
  // 插入設定檔案
  if($_POST['uselangtw'] == '1' && $_POST['uselangcn'] == '0' && $_POST['uselangen'] == '0' && $_POST['uselangjp'] == '0')
  {
	  $_POST['uselangtw'] = '0';
  }
  if($_POST['uselangtw'] != '1') {$_POST['uselangtw'] = "0";}
  if($_POST['uselangcn'] != '1') {$_POST['uselangcn'] = "0";}
  if($_POST['uselangen'] != '1') {$_POST['uselangen'] = "0";}
  if($_POST['uselangjp'] != '1') {$_POST['uselangjp'] = "0";}
  
  $insertSQLSetting = sprintf("INSERT INTO demo_setting (Defaultlang, LangChooseZHTW, LangChooseZHCN, LangChooseEN, LangChooseJP, OptionNewsSelect, OptionFaqSelect, OptionProductSelect, OptionFrilinkSelect, OptionPublishSelect, OptionGuestbookSelect, OptionActivitiesSelect, OptionProjectSelect, OptionArticleSelect, OptionAboutSelect, OptionContactSelect, OptionDfPageSelect, OptionCatalogSelect, OptionCartSelect, OptionMobileSelect, OptionTmpHomeSelect, dfpage_limit_page_num, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Defaultlang'], "text"), // 繁
                       GetSQLValueString($_POST['uselangtw'], "int"), // 繁
					   GetSQLValueString($_POST['uselangcn'], "int"), // 簡
					   GetSQLValueString($_POST['uselangen'], "int"), // 英
					   GetSQLValueString($_POST['uselangjp'], "int"), // 日
					   GetSQLValueString("1", "int"), // 最新訊息
					   GetSQLValueString("1", "int"), // 常見問答
					   GetSQLValueString("1", "int"), // 商品櫥窗
					   GetSQLValueString("1", "int"), // 友站連結
					   GetSQLValueString("0", "int"), // 發布資訊
					   GetSQLValueString("0", "int"), // 留言訊息
					   GetSQLValueString("0", "int"), // 活動花絮
					   GetSQLValueString("1", "int"), // 工程實績
					   GetSQLValueString("0", "int"), // 文章管理
					   GetSQLValueString("1", "int"), // 關於我們
					   GetSQLValueString("1", "int"), // 聯絡我們
					   GetSQLValueString("1", "int"), // 自訂頁面
					   GetSQLValueString("1", "int"), // 產品型錄
					   GetSQLValueString("0", "int"), // 購物車
					   GetSQLValueString("1", "int"), // 手機模組
					   GetSQLValueString("1", "int"), // 首頁模組
					   GetSQLValueString("8", "int"), // 頁面限制頁數
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultSetting = mysqli_query($DB_Conn, $insertSQLSetting) or die(mysqli_error($DB_Conn));
  
    // 插入logo
  $insertSQLLogo = sprintf("INSERT INTO demo_tmplogo (name, type, logoname, logocolor, logofontsize, logotype, lang, userid, webname) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("我的文字Logo", "text"),
                       GetSQLValueString("個人", "text"),
					   GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString("#000000", "text"),
                       GetSQLValueString("36px", "text"),
					   GetSQLValueString("1", "int"),
                       GetSQLValueString("zh-tw", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"),
                       GetSQLValueString($_POST['webname'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultLogo = mysqli_query($DB_Conn, $insertSQLLogo) or die(mysqli_error($DB_Conn));
  
  // 取得目前logo id
    $colname_RecordMyLogo = "-1";
	if (isset($_POST['webname'])) {
	  $colname_RecordMyLogo = $_POST['webname'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordMyLogo = sprintf("SELECT id FROM demo_tmplogo WHERE webname = %s ORDER BY id DESC", GetSQLValueString($colname_RecordMyLogo, "text"));
	$RecordMyLogo = mysqli_query($DB_Conn, $query_RecordMyLogo) or die(mysqli_error($DB_Conn));
	$row_RecordMyLogo = mysqli_fetch_assoc($RecordMyLogo);
	$totalRows_RecordMyLogo = mysqli_num_rows($RecordMyLogo);
	
  // 取得複製版型資料 
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpShowSlect = sprintf("SELECT * FROM demo_tmp WHERE id = 101");
$RecordTmpShowSlect = mysqli_query($DB_Conn, $query_RecordTmpShowSlect) or die(mysqli_error($DB_Conn));
$row_RecordTmpShowSlect = mysqli_fetch_assoc($RecordTmpShowSlect);
$totalRows_RecordTmpShowSlect = mysqli_num_rows($RecordTmpShowSlect);
  // 新增一筆版型資料
  $insertSQL = sprintf("INSERT INTO demo_tmp (userid, name, title, homeselect, homestyle, tmpwebwidth, tmpwebwidthunit, tmpfbfanselect, tmpfbfanbkcolor, tmpfbfanboardcolor, author, type, pic, content, postdate, indicate, sdescription, skeyword, pushtop, tmplogo, tmplogoid, tmpmainmenu, tmpmainmenuindicate, tmpsubmainmenuindicate, tmpleftmenu, tmpblock, tmpshowblockname, tmpdftmenu_x, tmpdftmenu_y, tmppicmenu_x, tmppicmenu_y, tmppicmenu_style, tmpbannerpic, tmpbannerpicwidth, tmpbannerpicheight, tmpautobanner1, tmpautobanner2, tmpautobanner3, tmpautobanner4, tmpautobanner5, tmpselectbannerid, tmphomeenterselect, tmphomeenterdefaultpic, tmphomeenterpic, tmphomeenterpicsource, tmplogowidth, tmplogoheight, tmplogomargintop, tmplogomarginleft, tmphomelogomargintop, tmphomelogomarginleft, tmphomeentermarginbottom, tmphomeentermarginright, tmpwordcolor, tmpwordsize, tmplink, tmplinkvisit, tmplinkhover, tmpheaderminheight, tmptitlebackground, tmptitlelinebackground, tmpleftminheight, tmpmiddleminheight, tmprightminheight, tmpfooterminheight, tmpbanner, tmpdfmenucolor, tmpmenuselect, tmpbodyselect, tmpmenulimit, tmpbodybackground, tmpanimebackground, tmpbottombackground, tmpheaderbackground, tmpwrpbackground, tmpleftbackground, tmprightbackground, tmpmiddlebackground, tmpfooterbackground, tmphomeboard, tmpwrpboard, tmpbannerboard, tmpheaderboard, tmpleftboard, tmprightboard, tmptitleboard, tmpmiddleboard, tmpfooterboard, tmpmeger_t_m, tmpheaderpaddingtop, tmpheaderpaddingbttom, tmpheaderpaddingleft, tmpheaderpaddingright, tmpbannerpaddingtop, tmpbannerpaddingbttom, tmpbannerpaddingleft, tmpbannerpaddingright, tmpleftpaddingtop, tmpleftpaddingbttom, tmpleftpaddingleft, tmpleftpaddingright, tmprightpaddingtop, tmprightpaddingbttom, tmprightpaddingleft, tmprightpaddingright, tmpmiddlepaddingtop, tmpmiddlepaddingbttom, tmpmiddlepaddingleft, tmpmiddlepaddingright, tmp_middle_title_font_color, tmp_middle_title_x, tmp_middle_title_height, tmpfooterpaddingtop, tmpfooterpaddingbttom, tmpfooterpaddingleft, tmpfooterpaddingright, tmpfooterfontcolor, tmpproductboard, tmpproductboardicon, tmpproductboardfontcolor, tmpproductviewcolumn, tmpnewsoddbackground, tmpnewsevenbackground, tmpnewstopbackground, tmpprojectboard, tmpprojectboardicon, tmpactivitiesboard, tmpactivitiesboardicon, tmpfrilinkboard, tmpfrilinkboardicon, tmporgboard, tmporgboardicon, tmpsponsorboard, tmpsponsorboardicon, tmppartnerboard, tmppartnerboardicon, tmpartlistboard, tmpartlistboardicon, tmppublishindicate, notes1, notes2, sortid, lang, webname, webnameorigin) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['name'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['title'], "text"),
                       GetSQLValueString('1', "int"), /* 首頁開啟 */
					   GetSQLValueString($row_RecordTmpShowSlect['homestyle'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpwebwidth'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpwebwidthunit'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfbfanselect'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfbfanbkcolor'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfbfanboardcolor'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['author'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['type'], "text"),
                       GetSQLValueString("", "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['content'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['postdate'], "date"),
                       GetSQLValueString($row_RecordTmpShowSlect['indicate'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['sdescription'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['skeyword'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['pushtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplogo'], "text"),
                       GetSQLValueString($row_RecordMyLogo['id'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmainmenu'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmainmenuindicate'], "int"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmpsubmainmenuindicate'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftmenu'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpblock'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpshowblockname'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpdftmenu_x'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpdftmenu_y'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmppicmenu_x'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmppicmenu_y'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmppicmenu_style'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpic'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpicwidth'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpicheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpautobanner1'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpautobanner2'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpautobanner3'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpautobanner4'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpautobanner5'], "text"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmpselectbannerid'], "int"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomeenterselect'], "int"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomeenterdefaultpic'], "text"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomeenterpic'], "text"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomeenterpicsource'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplogowidth'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplogoheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplogomargintop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplogomarginleft'], "int"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomelogomargintop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmphomelogomarginleft'], "int"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomeentermarginbottom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmphomeentermarginright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpwordcolor'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpwordsize'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplink'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplinkvisit'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmplinkhover'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderminheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmptitlebackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmptitlelinebackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftminheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddleminheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightminheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterminheight'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbanner'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpdfmenucolor'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmenuselect'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbodyselect'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmenulimit'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbodybackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpanimebackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbottombackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpwrpbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddlebackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterbackground'], "text"),
					   GetSQLValueString($row_RecordTmpShowSlect['tmphomeboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpwrpboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmptitleboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddleboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmeger_t_m'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderpaddingtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderpaddingbttom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderpaddingleft'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpheaderpaddingright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpaddingtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpaddingbttom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpaddingleft'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpbannerpaddingright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftpaddingtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftpaddingbttom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftpaddingleft'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpleftpaddingright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightpaddingtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightpaddingbttom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightpaddingleft'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmprightpaddingright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddlepaddingtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddlepaddingbttom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddlepaddingleft'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpmiddlepaddingright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmp_middle_title_font_color'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmp_middle_title_x'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmp_middle_title_height'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterpaddingtop'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterpaddingbttom'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterpaddingleft'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterpaddingright'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfooterfontcolor'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpproductboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpproductboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpproductboardfontcolor'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpproductviewcolumn'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpnewsoddbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpnewsevenbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpnewstopbackground'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpprojectboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpprojectboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpactivitiesboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpactivitiesboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfrilinkboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpfrilinkboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmporgboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmporgboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpsponsorboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpsponsorboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmppartnerboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmppartnerboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpartlistboard'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmpartlistboardicon'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['tmppublishindicate'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['notes1'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['notes2'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['sortid'], "int"),
                       GetSQLValueString($row_RecordTmpShowSlect['lang'], "text"),
					   GetSQLValueString($_POST['webname'], "text"),
                       GetSQLValueString($row_RecordTmpShowSlect['webnameorigin'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  // 取得目前版型id
    $colname_RecordMyTmp = "-1";
	if (isset($_POST['webname'])) {
	  $colname_RecordMyTmp = $_POST['webname'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordMyTmp = sprintf("SELECT id FROM demo_tmp WHERE webname = %s ORDER BY id DESC", GetSQLValueString($colname_RecordMyTmp, "text"));
	$RecordMyTmp = mysqli_query($DB_Conn, $query_RecordMyTmp) or die(mysqli_error($DB_Conn));
	$row_RecordMyTmp = mysqli_fetch_assoc($RecordMyTmp);
	$totalRows_RecordMyTmp = mysqli_num_rows($RecordMyTmp);
  
  // 插入設定檔案
  $insertSQLSettingFr = sprintf("INSERT INTO demo_setting_fr (MSTmpSelect, MSTmpSelectRwd, productlistLock, frilinkLock, alllistLock, homecontenttwsmall, homecontentcnsmall, homecontentensmall, homecontenttwsmall2, homecontentcnsmall2, homecontentensmall2, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($row_RecordMyTmp['id'], "int"), // 版型選擇
					   GetSQLValueString($row_RecordMyTmp['id'], "int"), // 版型選擇
					   GetSQLValueString("1", "int"), // 產品 - 自訂欄位
					   GetSQLValueString("1", "int"), // 友站 - 自訂欄位
					   GetSQLValueString("0", "int"), // 全部選單 - 自訂欄位
					   GetSQLValueString($Home_Content_Sample01, "text"), // 預設圖片
					   GetSQLValueString($Home_Content_Sample01, "text"), // 預設圖片
					   GetSQLValueString($Home_Content_Sample01, "text"), // 預設圖片
					   GetSQLValueString($Home_Content_Sample02, "text"), // 預設圖片
					   GetSQLValueString($Home_Content_Sample02, "text"), // 預設圖片
					   GetSQLValueString($Home_Content_Sample02, "text"), // 預設圖片
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultSettingFr = mysqli_query($DB_Conn, $insertSQLSettingFr) or die(mysqli_error($DB_Conn));
  
  // 插入設定檔案
  $insertSQLSettingOtr = sprintf("INSERT INTO demo_setting_otr (userid) VALUES (%s)",
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultSettingOtr = mysqli_query($DB_Conn, $insertSQLSettingOtr) or die(mysqli_error($DB_Conn));
  
  if($_POST['uselangcn'] == '1'){
	  $updateSQL = sprintf("UPDATE demo_setting_fr SET productlistLock_cn=%s, frilinkLock_cn=%s, alllistLock_cn=%s WHERE userid=%s",
                       GetSQLValueString("1", "int"), // 產品 - 自訂欄位
					   GetSQLValueString("0", "int"), // 友站 - 自訂欄位
					   GetSQLValueString("0", "int"), // 全部選單 - 自訂欄位
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  }
  if($_POST['uselangen'] == '1'){
	  $updateSQL = sprintf("UPDATE demo_setting_fr SET productlistLock_en=%s, frilinkLock_en=%s, alllistLock_en=%s WHERE userid=%s",
                       GetSQLValueString("1", "int"), // 產品 - 自訂欄位
					   GetSQLValueString("0", "int"), // 友站 - 自訂欄位
					   GetSQLValueString("0", "int"), // 全部選單 - 自訂欄位
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  }
  if($_POST['uselangjp'] == '1'){
	  $updateSQL = sprintf("UPDATE demo_setting_fr SET productlistLock_jp=%s, frilinkLock_jp=%s, alllistLock_jp=%s WHERE userid=%s",
                       GetSQLValueString("1", "int"), // 產品 - 自訂欄位
					   GetSQLValueString("0", "int"), // 友站 - 自訂欄位
					   GetSQLValueString("0", "int"), // 全部選單 - 自訂欄位
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  }
  
  // 插入自訂頁面
  $insertSQLDftypeAbout = sprintf("INSERT INTO demo_dftype (title, home, typemenu, sortid, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("關於我們", "text"),
					   GetSQLValueString("1", "int"), // 設定首頁
					   GetSQLValueString("About", "text"),
					   GetSQLValueString("1", "int"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeAbout = mysqli_query($DB_Conn, $insertSQLDftypeAbout) or die(mysqli_error($DB_Conn));
  
  if($_POST['uselangcn'] == '1'){
	  
	  $insertSQLDftypeAbout = sprintf("INSERT INTO demo_dftype (title, home, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("关于我们", "text"),
					   GetSQLValueString("1", "int"), // 設定首頁
					   GetSQLValueString("About", "text"),
					   GetSQLValueString("1", "int"),
					   GetSQLValueString("zh-cn", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeAbout = mysqli_query($DB_Conn, $insertSQLDftypeAbout) or die(mysqli_error($DB_Conn));
  
  }
  
  if($_POST['uselangen'] == '1'){
	  
	  $insertSQLDftypeAbout = sprintf("INSERT INTO demo_dftype (title, home, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("About", "text"),
					   GetSQLValueString("1", "int"), // 設定首頁
					   GetSQLValueString("About", "text"),
					   GetSQLValueString("1", "int"),
					   GetSQLValueString("en", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeAbout = mysqli_query($DB_Conn, $insertSQLDftypeAbout) or die(mysqli_error($DB_Conn));
  
  }
  
  if($_POST['uselangjp'] == '1'){
	  
	  $insertSQLDftypeAbout = sprintf("INSERT INTO demo_dftype (title, home, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("会社の案内書", "text"),
					   GetSQLValueString("1", "int"), // 設定首頁
					   GetSQLValueString("About", "text"),
					   GetSQLValueString("1", "int"),
					   GetSQLValueString("jp", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeAbout = mysqli_query($DB_Conn, $insertSQLDftypeAbout) or die(mysqli_error($DB_Conn));
  
  }
  
  $insertSQLDftypeNews = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, userid) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString("最新訊息", "text"),
					   GetSQLValueString("News", "text"),
					   GetSQLValueString("2", "int"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeNews = mysqli_query($DB_Conn, $insertSQLDftypeNews) or die(mysqli_error($DB_Conn));
  
  if($_POST['uselangcn'] == '1'){
	  $insertSQLDftypeNews = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("最新讯息", "text"),
					   GetSQLValueString("News", "text"),
					   GetSQLValueString("2", "int"),
					   GetSQLValueString("zh-cn", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeNews = mysqli_query($DB_Conn, $insertSQLDftypeNews) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangen'] == '1'){
	  $insertSQLDftypeNews = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("News", "text"),
					   GetSQLValueString("News", "text"),
					   GetSQLValueString("2", "int"),
					   GetSQLValueString("en", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeNews = mysqli_query($DB_Conn, $insertSQLDftypeNews) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangjp'] == '1'){
	  $insertSQLDftypeNews = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("最新の情報", "text"),
					   GetSQLValueString("News", "text"),
					   GetSQLValueString("2", "int"),
					   GetSQLValueString("jp", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeNews = mysqli_query($DB_Conn, $insertSQLDftypeNews) or die(mysqli_error($DB_Conn));
  }
  
  $insertSQLDftypeProduct = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, userid) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString("商品櫥窗", "text"),
					   GetSQLValueString("Product", "text"),
					   GetSQLValueString("3", "int"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeProduct = mysqli_query($DB_Conn, $insertSQLDftypeProduct) or die(mysqli_error($DB_Conn));
  
  if($_POST['uselangcn'] == '1'){
	  $insertSQLDftypeProduct = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("商品橱窗", "text"),
					   GetSQLValueString("Product", "text"),
					   GetSQLValueString("3", "int"),
					   GetSQLValueString("zh-cn", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeProduct = mysqli_query($DB_Conn, $insertSQLDftypeProduct) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangen'] == '1'){
	  $insertSQLDftypeProduct = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("Product", "text"),
					   GetSQLValueString("Product", "text"),
					   GetSQLValueString("3", "int"),
					   GetSQLValueString("en", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeProduct = mysqli_query($DB_Conn, $insertSQLDftypeProduct) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangjp'] == '1'){
	  $insertSQLDftypeProduct = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("製品の情報", "text"),
					   GetSQLValueString("Product", "text"),
					   GetSQLValueString("3", "int"),
					   GetSQLValueString("jp", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeProduct = mysqli_query($DB_Conn, $insertSQLDftypeProduct) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangtw'] == '1'){
	  $insertSQLDftypeCatalog = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, userid) VALUES (%s, %s, %s, %s)",
					   GetSQLValueString("檔案下載", "text"),
					   GetSQLValueString("Catalog", "text"),
					   GetSQLValueString("4", "int"),
					   GetSQLValueString($row_RecordWebuserUserid['id'], "int"));
	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeCatalog = mysqli_query($DB_Conn, $insertSQLDftypeCatalog) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangcn'] == '1'){
	  $insertSQLDftypeCatalog = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("档案下载", "text"),
					   GetSQLValueString("Catalog", "text"),
					   GetSQLValueString("4", "int"),
					   GetSQLValueString("zh-cn", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeCatalog = mysqli_query($DB_Conn, $insertSQLDftypeCatalog) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangen'] == '1'){
	  $insertSQLDftypeCatalog = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("Download", "text"),
					   GetSQLValueString("Catalog", "text"),
					   GetSQLValueString("4", "int"),
					   GetSQLValueString("en", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeCatalog = mysqli_query($DB_Conn, $insertSQLDftypeCatalog) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangjp'] == '1'){
	  $insertSQLDftypeCatalog = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("ダウンロード", "text"),
					   GetSQLValueString("Catalog", "text"),
					   GetSQLValueString("4", "int"),
					   GetSQLValueString("jp", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeCatalog = mysqli_query($DB_Conn, $insertSQLDftypeCatalog) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangtw'] == '1'){
	  $insertSQLDftypeProject = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, userid) VALUES (%s, %s, %s, %s)",
					   GetSQLValueString("客戶實績", "text"),
					   GetSQLValueString("Project", "text"),
					   GetSQLValueString("5", "int"),
					   GetSQLValueString($row_RecordWebuserUserid['id'], "int"));
	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeProject = mysqli_query($DB_Conn, $insertSQLDftypeProject) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangcn'] == '1'){
	  $insertSQLDftypeProject = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("客户实绩", "text"),
					   GetSQLValueString("Project", "text"),
					   GetSQLValueString("5", "int"),
					   GetSQLValueString("zh-cn", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeProject = mysqli_query($DB_Conn, $insertSQLDftypeProject) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangen'] == '1'){
	  $insertSQLDftypeProject = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("Project", "text"),
					   GetSQLValueString("Project", "text"),
					   GetSQLValueString("5", "int"),
					   GetSQLValueString("en", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeProject = mysqli_query($DB_Conn, $insertSQLDftypeProject) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangjp'] == '1'){
	  $insertSQLDftypeProject = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("プロジェクト", "text"),
					   GetSQLValueString("Project", "text"),
					   GetSQLValueString("5", "int"),
					   GetSQLValueString("jp", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeProject = mysqli_query($DB_Conn, $insertSQLDftypeProject) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangtw'] == '1'){
	  $insertSQLDftypeFAQ = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, userid) VALUES (%s, %s, %s, %s)",
					   GetSQLValueString("常見問題", "text"),
					   GetSQLValueString("FAQ", "text"),
					   GetSQLValueString("6", "int"),
					   GetSQLValueString($row_RecordWebuserUserid['id'], "int"));
	
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeFAQ = mysqli_query($DB_Conn, $insertSQLDftypeFAQ) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangcn'] == '1'){
	  $insertSQLDftypeFAQ = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("常见问题", "text"),
					   GetSQLValueString("FAQ", "text"),
					   GetSQLValueString("6", "int"),
					   GetSQLValueString("zh-cn", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeFAQ = mysqli_query($DB_Conn, $insertSQLDftypeFAQ) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangen'] == '1'){
	  $insertSQLDftypeFAQ = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("FAQ", "text"),
					   GetSQLValueString("FAQ", "text"),
					   GetSQLValueString("6", "int"),
					   GetSQLValueString("en", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeFAQ = mysqli_query($DB_Conn, $insertSQLDftypeFAQ) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangjp'] == '1'){
	  $insertSQLDftypeFAQ = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("よくある質問", "text"),
					   GetSQLValueString("FAQ", "text"),
					   GetSQLValueString("6", "int"),
					   GetSQLValueString("jp", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultDftypeFAQ = mysqli_query($DB_Conn, $insertSQLDftypeFAQ) or die(mysqli_error($DB_Conn));
  }
  
  $insertSQLDftypeContact = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, userid) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString("聯絡我們", "text"),
					   GetSQLValueString("Contact", "text"),
					   GetSQLValueString("7", "int"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeContact = mysqli_query($DB_Conn, $insertSQLDftypeContact) or die(mysqli_error($DB_Conn));
  
  if($_POST['uselangcn'] == '1'){
	  $insertSQLDftypeContact = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("联络我们", "text"),
					   GetSQLValueString("Contact", "text"),
					   GetSQLValueString("7", "int"),
					   GetSQLValueString("zh-cn", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeContact = mysqli_query($DB_Conn, $insertSQLDftypeContact) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangen'] == '1'){
	  $insertSQLDftypeContact = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("Contact", "text"),
					   GetSQLValueString("Contact", "text"),
					   GetSQLValueString("7", "int"),
					   GetSQLValueString("en", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeContact = mysqli_query($DB_Conn, $insertSQLDftypeContact) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangjp'] == '1'){
	  $insertSQLDftypeContact = sprintf("INSERT INTO demo_dftype (title, typemenu, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("私達を連絡", "text"),
					   GetSQLValueString("Contact", "text"),
					   GetSQLValueString("7", "int"),
					   GetSQLValueString("jp", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultDftypeContact = mysqli_query($DB_Conn, $insertSQLDftypeContact) or die(mysqli_error($DB_Conn));
  }
  
  // 插入自訂頁面 - END
  
  // 插入自訂欄位
  $insertSQLTmpColumnProduct = sprintf("INSERT INTO demo_tmpcolumn (type, style, dftname, customname, sortid, userid) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("productlist", "text"),
					   GetSQLValueString("menu", "text"),
					   GetSQLValueString("產品分類", "text"),
					   GetSQLValueString("產品分類", "text"),
					   GetSQLValueString("1", "int"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultTmpColumnProduct = mysqli_query($DB_Conn, $insertSQLTmpColumnProduct) or die(mysqli_error($DB_Conn));
  
  if($_POST['uselangcn'] == '1'){
	  $insertSQLTmpColumnProduct = sprintf("INSERT INTO demo_tmpcolumn (type, style, dftname, customname, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("productlist", "text"),
					   GetSQLValueString("menu", "text"),
					   GetSQLValueString("產品分類", "text"),
					   GetSQLValueString("产品分类", "text"),
					   GetSQLValueString("1", "int"),
					   GetSQLValueString("zh-cn", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultTmpColumnProduct = mysqli_query($DB_Conn, $insertSQLTmpColumnProduct) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangen'] == '1'){
	  $insertSQLTmpColumnProduct = sprintf("INSERT INTO demo_tmpcolumn (type, style, dftname, customname, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("productlist", "text"),
					   GetSQLValueString("menu", "text"),
					   GetSQLValueString("產品分類", "text"),
					   GetSQLValueString("Product", "text"),
					   GetSQLValueString("1", "int"),
					   GetSQLValueString("en", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultTmpColumnProduct = mysqli_query($DB_Conn, $insertSQLTmpColumnProduct) or die(mysqli_error($DB_Conn));
  }
  
  if($_POST['uselangjp'] == '1'){
	  $insertSQLTmpColumnProduct = sprintf("INSERT INTO demo_tmpcolumn (type, style, dftname, customname, sortid, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("productlist", "text"),
					   GetSQLValueString("menu", "text"),
					   GetSQLValueString("產品分類", "text"),
					   GetSQLValueString("プロダクト", "text"),
					   GetSQLValueString("1", "int"),
					   GetSQLValueString("jp", "text"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultTmpColumnProduct = mysqli_query($DB_Conn, $insertSQLTmpColumnProduct) or die(mysqli_error($DB_Conn));
  }
  
  $insertSQLTmpColumnFrilink = sprintf("INSERT INTO demo_tmpcolumn (type, style, dftname, customname, sortid, userid) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString("frilink", "text"),
					   GetSQLValueString("menu", "text"),
					   GetSQLValueString("友站連結", "text"),
					   GetSQLValueString("友站連結", "text"),
					   GetSQLValueString("2", "int"),
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultTmpColumnFrilink = mysqli_query($DB_Conn, $insertSQLTmpColumnFrilink) or die(mysqli_error($DB_Conn));
  
  // 插入自訂欄位 - END
  
  // 插入關於我們資料
  $desc_show_about = "<img src=\"http://www.shop3500.com/images/desc_01.jpg\" width=\"700\" height=\"566\" />";
  $insertSQLAbout = sprintf("INSERT INTO demo_about (title, content, home, userid) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString("公司簡介", "text"), // 
					   GetSQLValueString($desc_show_about, "text"), // 
					   GetSQLValueString("1", "int"), // 
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));
  
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultAbout = mysqli_query($DB_Conn, $insertSQLAbout) or die(mysqli_error($DB_Conn));
  
  // 插入商品櫥窗分類資料
  $insertSQLProductListB = sprintf("INSERT INTO demo_productitem (list_id, itemname, level, endnode, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("1", "int"), // 
                       GetSQLValueString("商品分類B", "text"), // 
					   GetSQLValueString("0", "int"), // 
					   GetSQLValueString("child", "text"), // 
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));
  
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultProductListB = mysqli_query($DB_Conn, $insertSQLProductListB) or die(mysqli_error($DB_Conn));
  
  $insertSQLProductListA = sprintf("INSERT INTO demo_productitem (list_id, itemname, level, endnode, userid) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString("1", "int"), // 
                       GetSQLValueString("商品分類A", "text"), // 
					   GetSQLValueString("0", "int"), // 
					   GetSQLValueString("child", "text"), // 
                       GetSQLValueString($row_RecordWebuserUserid['id'], "int"));
  
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultProductListA = mysqli_query($DB_Conn, $insertSQLProductListA) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Add'] = "Success";
  $insertGoTo = "manage_webuser.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
}

//------------------------------------------------------------------------------------------------------------------------
// \一般企業網站[進階]
//------------------------------------------------------------------------------------------------------------------------
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 網站使用者 <small>新增</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-plus"></i> 新增資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
   
      <div class="form-group row">
          <label class="col-md-2 col-form-label">名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="name" type="text" class="form-control" id="name" maxlength="30" data-parsley-trigger="blur" required=""/>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">網站域名<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="webname" type="text" required="" class="form-control" id="webname" maxlength="20" data-parsley-trigger="blur" data-parsley-pattern="/^[a-zA-Z0-9]+$/" data-parsley-length="[4, 20]"  />
                      
                 
          </div>
      </div>
      
       <div class="form-group row">
          <label class="col-md-2 col-form-label">帳號<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="account" type="text" required="" class="form-control" id="account" maxlength="30" data-parsley-trigger="blur" onblur="this.value = this.value.toLowerCase();" data-parsley-length="[4, 30]"  />
                      
                 
          </div>
      </div>
      
       <div class="form-group row">
          <label class="col-md-2 col-form-label">密碼<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="psw" type="password" required="" class="form-control" id="psw" data-parsley-length="[4, 30]" maxlength="30" data-parsley-trigger="blur"/>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
        <label class="col-md-2 col-form-label">確認密碼<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    
                    <input name="pswchk" type="password" class="form-control" id="pswchk" maxlength="100" data-parsley-trigger="blur" required="" data-parsley-length="[3, 30]" data-parsley-equalto="#psw" data-parsley-errors-container="#error_pswchk"/>
                    <div id="error_pswchk"></div>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">預設語系<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <select name="Defaultlang" id="Defaultlang" class="form-control" data-parsley-trigger="blur" required="">
                        <option value="zh-tw" <?php if($_POST['modselect'] == "1" || $_POST['modselect'] == "2") { ?>selected="selected"<?php } ?>>繁體</option>
                        <option value="zh-cn" <?php if($_POST['modselect'] == "3" || $_POST['modselect'] == "4") { ?>selected="selected"<?php } ?>>簡體</option>
                        <option value="en">英文</option>
                        <option value="jp">日文</option>
                    </select>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">等級<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <select name="level" id="level" class="form-control" data-parsley-trigger="blur" required="">
            <option value="">-- 選擇權限 -- </option>
            <option value="superadmin" selected="selected">最高管理者</option>
            <option value="admin">一般會員</option>
          </select>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">語系<span class="text-red">*</span></label>
          <div class="col-md-10">
              <div class="checkbox checkbox-css checkbox-inline">
                  <input name="uselangtw" type="checkbox" id="uselangtw" value="1" checked />
                  <label for="uselangtw">繁</label>
              </div>
              
              <div class="checkbox checkbox-css checkbox-inline">
                  <input name="uselangcn" type="checkbox" id="uselangcn" value="1"  />
                  <label for="uselangcn">簡</label>
              </div>
              
              <div class="checkbox checkbox-css checkbox-inline">
                  <input name="uselangen" type="checkbox" id="uselangen" value="1"  />
                  <label for="uselangen">英</label>
              </div>
              
              <div class="checkbox checkbox-css checkbox-inline">
                  <input name="uselangjp" type="checkbox" id="uselangjp" value="1" />
                  <label for="uselangjp">日</label>
              </div>   
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" size="50" maxlength="50"/>    
          </div>
      </div>
     
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block" onclick="return CheckFields();">送出</button>
           <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                    <input name="modselect" type="hidden" id="modselect" value="<?php echo $_POST['modselect']; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_Webuser" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script type="text/javascript">
<!--
CheckFields();
function CheckFields()
{	
	// 檢查『名稱』欄位
	var fieldvalue = document.getElementById("uselangtw").checked+document.getElementById("uselangcn").checked+document.getElementById("uselangen").checked+document.getElementById("uselangjp").checked;
	
	//console.log(fieldvalue);
	
	if (fieldvalue == "") 
	{
			alert("語系至少選擇一個！！");
			document.getElementById("uselangtw").focus();
			return false;
		
	}
}
//-->
</script>

<script type="text/javascript"> 
// 當用戶點擊提交按鈕後將按鈕添加disabled屬性,禁止點擊.
$("input:submit").each(function(){var srcclick=$(this).attr("onclick");if(typeof(srcclick)=="function"){$(this).click(function(){if(srcclick()){setdisabled(this);return true}return false})}});function setdisabled(obj){setTimeout(function(){obj.disabled=true},100)}
</script>
