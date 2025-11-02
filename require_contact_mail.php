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

$colname_RecordContactMail = "-1";
if (isset($_SESSION['userid'])) {
  $colname_RecordContactMail = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordContactMail = sprintf("SELECT id, userid, SiteMail, SiteMail_cn, SiteMail_en, SiteMail_jp, SiteMail_kr, SiteMail_sp, SiteAuthor, SiteAuthor_cn, SiteAuthor_en, SiteAuthor_jp, SiteAuthor_kr, SiteAuthor_sp, SiteSName, SiteSName_cn, SiteSName_en, SiteSName_jp, SiteSName_kr, SiteSName_sp, SitePhone, SitePhone_cn, SitePhone_en, SitePhone_jp, SitePhone_kr, SitePhone_sp, SiteCell, SiteCell_cn, SiteCell_en, SiteCell_jp, SiteCell_kr, SiteCell_sp, SiteFax, SiteFax_cn, SiteFax_en, SiteFax_jp, SiteFax_kr, SiteFax_sp, SiteAddr, SiteAddr_cn, SiteAddr_en, SiteAddr_jp, SiteAddr_kr, SiteAddr_sp, SiteAddrX, SiteAddrX_cn, SiteAddrX_en, SiteAddrX_jp, SiteAddrX_kr, SiteAddrX_sp, SiteAddrY, SiteAddrY_cn, SiteAddrY_en, SiteAddrY_sp, SiteAddrY_kr, SiteAddrY_sp, contacttitle, contacttitle_cn, contacttitle_en, contacttitle_jp, contacttitle_kr, contacttitle_sp, contacttitleindicate, googlemapindicate, formindicate, contactdesc, contactcontent, contactcontent_cn, contactcontent_en, contactcontent_jp, contactcontent_kr, contactcontent_sp FROM demo_setting_fr WHERE userid = %s", GetSQLValueString($colname_RecordContactMail, "int"));
$RecordContactMail = mysqli_query($DB_Conn, $query_RecordContactMail) or die(mysqli_error($DB_Conn));
$row_RecordContactMail = mysqli_fetch_assoc($RecordContactMail);
$totalRows_RecordContactMail = mysqli_num_rows($RecordContactMail);

$colname_RecordContactListType = "zh-tw";
if (isset($_SESSION['lang'])) {
  $colname_RecordContactListType = $_SESSION['lang'];
}
$coluserid_RecordContactListType = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordContactListType = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordContactListType = sprintf("SELECT * FROM demo_contactitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordContactListType, "text"),GetSQLValueString($coluserid_RecordContactListType, "int"));
$RecordContactListType = mysqli_query($DB_Conn, $query_RecordContactListType) or die(mysqli_error($DB_Conn));
$row_RecordContactListType = mysqli_fetch_assoc($RecordContactListType);
$totalRows_RecordContactListType = mysqli_num_rows($RecordContactListType);
?>
<?php if ($MSTMP == 'default') { ?>
<?php echo $row_RecordContactMail['SiteMail']; ?>
<?php echo $row_RecordContactMail['SiteAuthor']; ?>
<?php echo $row_RecordContactMail['contacttitle']; ?>
<?php echo $row_RecordContactMail['contactcontent']; ?>
<?php echo $row_RecordContactMail['contacttitleindicate']; ?>
<?php } else { ?>
<?php 
switch($_SESSION['lang'])
	{
		case "zh-tw":
		    if($row_RecordContactMail['SiteAddr'] == "") // 當地址欄留空 強制隱藏地圖功能
			{
				$row_RecordContactMail['googlemapindicate'] = '0';
			}
			break;
		case "zh-cn":
		    if($row_RecordContactMail['SiteAddr_cn'] == "") // 當地址欄留空 強制隱藏地圖功能
			{
				$row_RecordContactMail['googlemapindicate'] = '0';
			}
			$row_RecordContactMail['contacttitle'] = $row_RecordContactMail['contacttitle_cn'];
			$row_RecordContactMail['contactcontent'] = $row_RecordContactMail['contactcontent_cn'];
			$row_RecordContactMail['SiteSName'] = $row_RecordContactMail['SiteSName_cn'];
			$row_RecordContactMail['SitePhone'] = $row_RecordContactMail['SitePhone_cn'];
			$row_RecordContactMail['SiteCell'] = $row_RecordContactMail['SiteCell_cn'];
			$row_RecordContactMail['SiteFax'] = $row_RecordContactMail['SiteFax_cn'];
			$row_RecordContactMail['SiteAddr'] = $row_RecordContactMail['SiteAddr_cn'];
			break;
		case "en":
		    if($row_RecordContactMail['SiteAddr_en'] == "") // 當地址欄留空 強制隱藏地圖功能
			{
				$row_RecordContactMail['googlemapindicate'] = '0';
			}
			$row_RecordContactMail['contacttitle'] = $row_RecordContactMail['contacttitle_en'];
			$row_RecordContactMail['contactcontent'] = $row_RecordContactMail['contactcontent_en'];
			$row_RecordContactMail['SiteSName'] = $row_RecordContactMail['SiteSName_en'];
			$row_RecordContactMail['SitePhone'] = $row_RecordContactMail['SitePhone_en'];
			$row_RecordContactMail['SiteCell'] = $row_RecordContactMail['SiteCell_en'];
			$row_RecordContactMail['SiteFax'] = $row_RecordContactMail['SiteFax_en'];
			$row_RecordContactMail['SiteAddr'] = $row_RecordContactMail['SiteAddr_en'];
			break;	
		case "jp":
		    if($row_RecordContactMail['SiteAddr_jp'] == "") // 當地址欄留空 強制隱藏地圖功能
			{
				$row_RecordContactMail['googlemapindicate'] = '0';
			}
			$row_RecordContactMail['contacttitle'] = $row_RecordContactMail['contacttitle_jp'];
			$row_RecordContactMail['contactcontent'] = $row_RecordContactMail['contactcontent_jp'];
			$row_RecordContactMail['SiteSName'] = $row_RecordContactMail['SiteSName_jp'];
			$row_RecordContactMail['SitePhone'] = $row_RecordContactMail['SitePhone_jp'];
			$row_RecordContactMail['SiteCell'] = $row_RecordContactMail['SiteCell_jp'];
			$row_RecordContactMail['SiteFax'] = $row_RecordContactMail['SiteFax_jp'];
			$row_RecordContactMail['SiteAddr'] = $row_RecordContactMail['SiteAddr_jp'];
			break;	
		case "kr":
		    if($row_RecordContactMail['SiteAddr_kr'] == "") // 當地址欄留空 強制隱藏地圖功能
			{
				$row_RecordContactMail['googlemapindicate'] = '0';
			}
			$row_RecordContactMail['contacttitle'] = $row_RecordContactMail['contacttitle_kr'];
			$row_RecordContactMail['contactcontent'] = $row_RecordContactMail['contactcontent_kr'];
			$row_RecordContactMail['SiteSName'] = $row_RecordContactMail['SiteSName_kr'];
			$row_RecordContactMail['SitePhone'] = $row_RecordContactMail['SitePhone_kr'];
			$row_RecordContactMail['SiteCell'] = $row_RecordContactMail['SiteCell_kr'];
			$row_RecordContactMail['SiteFax'] = $row_RecordContactMail['SiteFax_kr'];
			$row_RecordContactMail['SiteAddr'] = $row_RecordContactMail['SiteAddr_kr'];
			break;	
		case "sp":
		    if($row_RecordContactMail['SiteAddr_sp'] == "") // 當地址欄留空 強制隱藏地圖功能
			{
				$row_RecordContactMail['googlemapindicate'] = '0';
			}
			$row_RecordContactMail['contacttitle'] = $row_RecordContactMail['contacttitle_sp'];
			$row_RecordContactMail['contactcontent'] = $row_RecordContactMail['contactcontent_sp'];
			$row_RecordContactMail['SiteSName'] = $row_RecordContactMail['SiteSName_sp'];
			$row_RecordContactMail['SitePhone'] = $row_RecordContactMail['SitePhone_sp'];
			$row_RecordContactMail['SiteCell'] = $row_RecordContactMail['SiteCell_sp'];
			$row_RecordContactMail['SiteFax'] = $row_RecordContactMail['SiteFax_sp'];
			$row_RecordContactMail['SiteAddr'] = $row_RecordContactMail['SiteAddr_sp'];
			break;	
		default:
		    break;
	}
?>
<?php include($TplPath . "/contact_mail.php"); ?>
<?php } 
mysqli_free_result($RecordContactMail);

mysqli_free_result($RecordContactListType);
?>