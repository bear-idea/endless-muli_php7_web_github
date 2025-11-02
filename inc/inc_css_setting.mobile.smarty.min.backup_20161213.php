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

// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}


$colname_RecordMobileStyle = "-1";
if (isset($_SESSION['userid'])) {
  $colname_RecordMobileStyle = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordMobileStyle = sprintf("SELECT * FROM demo_setting_fr WHERE userid = %s", GetSQLValueString($colname_RecordMobileStyle, "int"));
$RecordMobileStyle = mysqli_query($DB_Conn, $query_RecordMobileStyle) or die(mysqli_error($DB_Conn));
$row_RecordMobileStyle = mysqli_fetch_assoc($RecordMobileStyle);
$totalRows_RecordMobileStyle = mysqli_num_rows($RecordMobileStyle);

//$row_RecordMobileStyle['Mobile_Body_Bg'];

$colmobilebg_RecordMobileBg = "-1";
if (isset($row_RecordMobileStyle['Mobile_Body_Bg'])) {
  $colmobilebg_RecordMobileBg = $row_RecordMobileStyle['Mobile_Body_Bg'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordMobileBg = sprintf("SELECT * FROM demo_tmpbackground WHERE id = %s", GetSQLValueString($colmobilebg_RecordMobileBg, "int"));
$RecordMobileBg = mysqli_query($DB_Conn, $query_RecordMobileBg) or die(mysqli_error($DB_Conn));
$row_RecordMobileBg = mysqli_fetch_assoc($RecordMobileBg);
$totalRows_RecordMobileBg = mysqli_num_rows($RecordMobileBg);

$TmpMobileBgImage =  $row_RecordMobileBg['bgimage']; // 背景
$TmpMobileBgColor =  $row_RecordMobileBg['bgcolor']; // 底色
$TmpMobileBgRepeat=  $row_RecordMobileBg['bgrepeat']; // 重複
$TmpMobileBgPosition =  $row_RecordMobileBg['bgposition']; // 位置
$TmpMobileBgAttachment =  $row_RecordMobileBg['bgattachment']; // 定位
$TmpMobileBgWebName = $row_RecordMobileBg['webname'];

$TmpMobileBgTitleLine = $row_RecordMobileStyle['Mobile_TitleLine_Bg'];
$TmpMobileThemeColor = $row_RecordMobileStyle['Mobile_Default_Theme_Select'];

$TmpMobileMenuTheme = $row_RecordMobileStyle['Mobile_Menu_Bg'];
$TmpMobileMenuColor = $row_RecordMobileStyle['Mobile_Menu_Font_Color'];

$colmobilebg_RecordMobileTopLineBg = "-1";
if (isset($row_RecordMobileStyle['Mobole_TopLine_Bg'])) {
  $colmobilebg_RecordMobileTopLineBg = $row_RecordMobileStyle['Mobole_TopLine_Bg'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordMobileTopLineBg = sprintf("SELECT * FROM demo_tmpbackground WHERE id = %s", GetSQLValueString($colmobilebg_RecordMobileTopLineBg, "int"));
$RecordMobileTopLineBg = mysqli_query($DB_Conn, $query_RecordMobileTopLineBg) or die(mysqli_error($DB_Conn));
$row_RecordMobileTopLineBg = mysqli_fetch_assoc($RecordMobileTopLineBg);
$totalRows_RecordMobileTopLineBg = mysqli_num_rows($RecordMobileTopLineBg);

$TmpMobileTopLineBgImage =  $row_RecordMobileTopLineBg['bgimage']; // 背景
$TmpMobileTopLineBgColor =  $row_RecordMobileTopLineBg['bgcolor']; // 底色
$TmpMobileTopLineBgRepeat=  $row_RecordMobileTopLineBg['bgrepeat']; // 重複
$TmpMobileTopLineBgPosition =  $row_RecordMobileTopLineBg['bgposition']; // 位置
$TmpMobileTopLineBgAttachment =  $row_RecordMobileTopLineBg['bgattachment']; // 定位
$TmpMobileTopLineBgWebName = $row_RecordMobileTopLineBg['webname'];
//$TmpMobileBgTopLine = $row_RecordMobileStyle['Mobole_TopLine_Bg'];

$coluserid_RecordTmpMobileLogo = "-1";
if (isset($row_RecordMobileStyle['Mobile_Logo'])) {
  $coluserid_RecordTmpMobileLogo = $row_RecordMobileStyle['Mobile_Logo'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpMobileLogo = sprintf("SELECT * FROM demo_tmplogo WHERE id = %s", GetSQLValueString($coluserid_RecordTmpMobileLogo, "int"));
$RecordTmpMobileLogo = mysqli_query($DB_Conn, $query_RecordTmpMobileLogo) or die(mysqli_error($DB_Conn));
$row_RecordTmpMobileLogo = mysqli_fetch_assoc($RecordTmpMobileLogo);
$totalRows_RecordTmpMobileLogo = mysqli_num_rows($RecordTmpMobileLogo);

$TmpMobileLogo =  $row_RecordTmpMobileLogo['logoimage']; // logo
$TmpMobileLogoWidth =  $row_RecordTmpMobileLogo['width']; // logo
$TmpMobileLogoHeight =  $row_RecordTmpMobileLogo['height']; // logo
$TmpMobileLogo_en =  $row_RecordTmpMobileLogo['logoimage_en']; // logo
$TmpMobileLogoWidth_en =  $row_RecordTmpMobileLogo['width_en']; // logo
$TmpMobileLogoHeight_en =  $row_RecordTmpMobileLogo['height_en']; // logo
$TmpMobileLogo_cn =  $row_RecordTmpMobileLogo['logoimage_cn']; // logo
$TmpMobileLogoWidth_cn =  $row_RecordTmpMobileLogo['width_cn']; // logo
$TmpMobileLogoHeight_cn =  $row_RecordTmpMobileLogo['height_cn']; // logo
$TmpMobileLogoWebname =  $row_RecordTmpMobileLogo['webname']; // logo

$TmpMobileLogoName =  $row_RecordTmpMobileLogo['logoname'];
$TmpMobileLogoName_en =  $row_RecordTmpMobileLogo['logoname_en'];
$TmpMobileLogoName_cn =  $row_RecordTmpMobileLogo['logoname_cn'];
$TmpMobileLogoColor =  $row_RecordTmpMobileLogo['logocolor'];
$TmpMobileLogoFontSize =  $row_RecordTmpMobileLogo['logofontsize'];
$TmpMobileLogoType =  $row_RecordTmpMobileLogo['logotype'];

if($TmpMobileBgTitleLine >=8) {
	$TmpMobileBgTitleLineFontColor = "#FFF";
}else{
	$TmpMobileBgTitleLineFontColor = "#000";
}
if($TmpMobileBgTopLine == "2") {
	$TmpMobileBgTopLineStyle = "color-dark";
}else{
	$TmpMobileBgTopLineStyle = "color-light";
}
?>
<style type="text/css">
</style>
<?php
mysqli_free_result($RecordMobileStyle);

mysqli_free_result($RecordMobileBg);

mysqli_free_result($RecordMobileTopLineBg);

mysqli_free_result($RecordTmpMobileLogo);
?>