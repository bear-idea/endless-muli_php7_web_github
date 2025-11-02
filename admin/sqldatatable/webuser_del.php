<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php //include('mysqli_to_json.class.php'); ?>
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

if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "")) {
	
  // 清空子帳號
  $colname_RecordAccountGet = "-1";
  if (isset($_GET['id_del'])) {
	$colname_RecordAccountGet = $_GET['id_del'];
  }
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $query_RecordAccountGet = sprintf("SELECT id FROM demo_admin WHERE groupid = %s", GetSQLValueString($colname_RecordAccountGet, "text"));
  $RecordAccountGet = mysqli_query($DB_Conn, $query_RecordAccountGet) or die(mysqli_error($DB_Conn));
  $row_RecordAccountGet = mysqli_fetch_assoc($RecordAccountGet);
  $totalRows_RecordAccountGet = mysqli_num_rows($RecordAccountGet);
  
  do { 
	  
	  $deleteSQL = sprintf("DELETE FROM demo_admin WHERE id=%s", GetSQLValueString($row_RecordAccountGet['id'], "text"));
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn)); 
	  
	  
  } while ($row_RecordAccountGet = mysqli_fetch_assoc($RecordAccountGet));
  
  
  
  // 清空主帳號
  $deleteSQL = sprintf("DELETE FROM demo_admin WHERE id=%s",
                       GetSQLValueString($_GET['id_del'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  
  
  
  $result = mysqli_query($DB_Conn, "SHOW TABLES FROM `$database_DB_Conn`");
	while ($row = mysqli_fetch_array($result)) { 
			//echo $row[0];
			switch($row[0])
			{
				case "demo_aboutlist":
				case "demo_actlist":
				case "demo_actnewslist":
				case "demo_adtypelist":
				case "demo_albumlist":
				case "demo_articlearealist":
				case "demo_articlelist":
				case "demo_articlemenu":
				case "demo_articlesub":
				case "demo_artlistlist":
				case "demo_attractionslist":
				case "demo_bloglist":
				case "demo_bnbtag":
				case "demo_careerslist":
				case "demo_cartlist":
				case "demo_cataloglist":
				case "demo_configlist":
				case "demo_contactlist":
				case "demo_counterbrowser":
				case "demo_counteros":
				case "demo_counterrecord":
				case "demo_counterrefer":
				case "demo_countersetting":
				case "demo_countervisit":
				case "demo_couponslist":
				case "demo_dfpagelist":
				case "demo_donationlist":
				case "demo_epaperlist":
				case "demo_faqlist":
				case "demo_forumlist":
				case "demo_frilinklist":
				case "demo_imageshowlist":
				case "demo_knowledgelist":
				case "demo_langlist":
				case "demo_letterslist":
				case "demo_meetinglist":
				case "demo_menuleft":
				case "demo_menutype":
				case "demo_menu_level0":
				case "demo_menu_level1":
				case "demo_menu_level2":
				case "demo_modlinklist":
				case "demo_newslist":
				case "demo_orglist":
				case "demo_otrlinklist":
				case "demo_partnerlist":
				case "demo_productlist":
				case "demo_projectlist":
				case "demo_publishlist":
				case "demo_roomlist":
				case "demo_roomreservelist":
				case "demo_settinglist":
				case "demo_sitemaillist":
				case "demo_sponsorlist":
				case "demo_strongholdlist":
				case "demo_ticketsdinner":
				case "demo_ticketsitem":
				case "demo_ticketslist":
				case "demo_ticketsview":
				case "demo_timelinelist":
				case "demo_tmpbannerlist":
				case "demo_tmplist":
				case "demo_travellist":
				case "demo_videolist":
				case "demo_website":
				case "demo_websiteitem":
				case "demo_websitelist":
				case "jqcalendar":
				case "weichuncai_table":
				case "demo_admin":
				break;
				default:
						   $deleteSQLSetting = sprintf("DELETE FROM `$row[0]` WHERE `userid`=%s",
						   GetSQLValueString($_GET['id_del'], "int"));
	
						   //mysqli_select_db($database_DB_Conn, $DB_Conn);
						   $ResultSetting = mysqli_query($DB_Conn, $deleteSQLSetting) or die(mysqli_error($DB_Conn));
						   //echo "<BR>"; 
				break;
			}
	}
}
?>
<?php
mysqli_free_result($RecordAbout);
?>
