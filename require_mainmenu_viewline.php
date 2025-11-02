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

$colname_RecordTpt = "-1";
if (isset($_GET['aid'])) {
  $colname_RecordTpt = $_GET['aid'];
}
$collang_RecordTpt = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordTpt = $_SESSION['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTpt = sprintf("SELECT title FROM demo_dftype WHERE id = %s && lang=%s", GetSQLValueString($colname_RecordTpt, "int"),GetSQLValueString($collang_RecordTpt, "text"));
$RecordTpt = mysqli_query($DB_Conn, $query_RecordTpt) or die(mysqli_error($DB_Conn));
$row_RecordTpt = mysqli_fetch_assoc($RecordTpt);
$totalRows_RecordTpt = mysqli_num_rows($RecordTpt);

			switch($_GET['Opt_Activities'])
			{
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['Activities']/*活動花絮*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_activities.php?wshop=" . $wshop . "&amp;Opt_Activities=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Activities']/*活動花絮*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_activities.php?wshop=" . $wshop . "&amp;Opt_Activities=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Activities']/*活動花絮*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯<strong></font>";	
					break;
				case "photoviewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_activities.php?wshop=" . $wshop . "&amp;Opt_Activities=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Activities']/*活動花絮*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>主題內頁<strong></font>";			
					break;
				case "photoaddpage":
				    $ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_activities.php?wshop=" . $wshop . "&amp;Opt_Activities=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Activities']/*活動花絮*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_activities.php?wshop=" . $wshop . "&amp;Opt_Activities=photoviewpage&amp;lang=" . $_SESSION['lang'] . "&act_id=" . $_GET['act_id']. "\">主題內頁 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "photoeditpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_activities.php?wshop=" . $wshop . "&amp;Opt_Activities=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Activities']/*活動花絮*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_activities.php?wshop=" . $wshop . "&amp;Opt_Activities=photoviewpage&amp;lang=" . $_SESSION['lang'] . "&act_id=" . $_GET['act_id'].  "\">主題內頁 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯<strong></font>";	
					break;
				case "listpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_activities.php?wshop=" . $wshop . "&amp;Opt_Activities=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Activities']/*活動花絮*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>清單列表<strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_activities.php?wshop=" . $wshop . "&amp;Opt_Activities=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Activities']/*活動花絮*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_activities.php?wshop=" . $wshop . "&amp;Opt_Activities=listpage&amp;lang=" . $_SESSION['lang']  .  "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理<strong></font>";	
					break;
				default:
					//$ViewLIne_Type = "". $ModuleName['Activities']/*活動花絮*/ . "";
					break;
			}
			
			switch($_GET['Opt_Project'])
			{
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['Project']/*工程實績*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_project.php?wshop=" . $wshop . "&amp;Opt_Project=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Project']/*工程實績*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_project.php?wshop=" . $wshop . "&amp;Opt_Project=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Project']/*工程實績*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯<strong></font>";	
					break;
				case "photoviewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_project.php?wshop=" . $wshop . "&amp;Opt_Project=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Project']/*工程實績*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>主題內頁<strong></font>";			
					break;
				case "photoaddpage":
				    $ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_project.php?wshop=" . $wshop . "&amp;Opt_Project=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Project']/*工程實績*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_project.php?wshop=" . $wshop . "&amp;Opt_Project=photoviewpage&amp;lang=" . $_SESSION['lang'] . "&act_id=" . $_GET['act_id']. "\">主題內頁 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "photoeditpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_project.php?wshop=" . $wshop . "&amp;Opt_Project=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Project']/*工程實績*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_project.php?wshop=" . $wshop . "&amp;Opt_Project=photoviewpage&amp;lang=" . $_SESSION['lang'] . "&act_id=" . $_GET['act_id'].  "\">主題內頁 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯<strong></font>";	
					break;
				case "listpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_project.php?wshop=" . $wshop . "&amp;Opt_Project=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Project']/*工程實績*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>清單列表<strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_project.php?wshop=" . $wshop . "&amp;Opt_Project=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Project']/*工程實績*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_project.php?wshop=" . $wshop . "&amp;Opt_Project=listpage&amp;lang=" . $_SESSION['lang']  .  "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理<strong></font>";	
					break;
				default:
					//$ViewLIne_Type = "". $ModuleName['Project']/*工程實績*/ . "";	
					break;
			}
			
			switch($_GET['Opt_Ads'])
			{
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>輪播系統</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_ads.php?wshop=" . $wshop . "&amp;Opt_Ads=viewpage&amp;lang=" . $_SESSION['lang'] . "\">輪播系統 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_ads.php?wshop=" . $wshop . "&amp;Opt_Ads=viewpage&amp;lang=" . $_SESSION['lang'] . "\">輪播系統 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯<strong></font>";	
					break;
				case "photoviewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_ads.php?wshop=" . $wshop . "&amp;Opt_Ads=viewpage&amp;lang=" . $_SESSION['lang'] . "\">輪播系統 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>輪播圖片<strong></font>";			
					break;
				case "photoaddpage":
				    $ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_ads.php?wshop=" . $wshop . "&amp;Opt_Ads=viewpage&amp;lang=" . $_SESSION['lang'] . "\">輪播系統 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_ads.php?wshop=" . $wshop . "&amp;Opt_Ads=photoviewpage&amp;lang=" . $_SESSION['lang'] . "&act_id=" . $_GET['act_id']. "\">輪播圖片 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "photoeditpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_ads.php?wshop=" . $wshop . "&amp;Opt_Ads=viewpage&amp;lang=" . $_SESSION['lang'] . "\">輪播系統 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_ads.php?wshop=" . $wshop . "&amp;Opt_Ads=photoviewpage&amp;lang=" . $_SESSION['lang'] . "&act_id=" . $_GET['act_id'].  "\">輪播圖片 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯<strong></font>";	
					break;
				case "listpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_ads.php?wshop=" . $wshop . "&amp;Opt_Ads=viewpage&amp;lang=" . $_SESSION['lang'] . "\">輪播系統 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>清單列表<strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_ads.php?wshop=" . $wshop . "&amp;Opt_Ads=viewpage&amp;lang=" . $_SESSION['lang'] . "\">輪播系統 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_ads.php?wshop=" . $wshop . "&amp;Opt_Ads=listpage&amp;lang=" . $_SESSION['lang']  .  "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理<strong></font>";	
					break;
				default:
					//$ViewLIne_Type = "". $ModuleName['Project']/*工程實績*/ . "";	
					break;
			}
			
			switch($_GET['Opt_News'])
			{
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['News']/*最新訊息*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt_News=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['News']/*最新訊息*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt_News=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['News']/*最新訊息*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt_News=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['News']/*最新訊息*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt_News=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['News']/*最新訊息*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt_News=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				case "postpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt_News=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['News']/*最新訊息*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>問答紀錄</strong></font>";	
					break;
				case "postaddpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt_News=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['News']/*最新訊息*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt_News=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "posteditpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt_News=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['News']/*最新訊息*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt_News=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;
				case "replypage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt_News=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['News']/*最新訊息*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt_News=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>回應一覽</strong></font>";	
					break;
				case "replyaddpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt_News=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['News']/*最新訊息*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt_News=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt_News=replypage&amp;lang=" . $_SESSION['lang'] . "&amp;post_id=" . $_GET['post_id'] . "&amp;pd_id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">回應一覽 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
					break;
				case "replyeditpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt_News=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['News']/*最新訊息*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt_News=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt_News=replypage&amp;lang=" . $_SESSION['lang'] . "&amp;post_id=" . $_GET['post_id'] . "&amp;pd_id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">回應一覽 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;
				default:
					//$ViewLIne_Type = "". $ModuleName['News']/*最新訊息*/ . "";	
					break;
			}
			
			switch($_GET['Opt_Analysis'])
			{
				case "viewpage":
					if($_GET['fun'] == '0')
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_analysis.php?wshop=" . $wshop . "&amp;Opt_Analysis=viewpage&amp;lang=" . $_SESSION['lang'] . "\">統計資料 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>資訊一覽</strong></font>";
					
					if($_GET['fun'] == '1')
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_analysis.php?wshop=" . $wshop . "&amp;Opt_Analysis=viewpage&amp;lang=" . $_SESSION['lang'] . "\">統計資料 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>週統計</strong></font>";		
					
					if($_GET['fun'] == '2')
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_analysis.php?wshop=" . $wshop . "&amp;Opt_Analysis=viewpage&amp;lang=" . $_SESSION['lang'] . "\">統計資料 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>月統計</strong></font>";		
					
					if($_GET['fun'] == '3')
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_analysis.php?wshop=" . $wshop . "&amp;Opt_Analysis=viewpage&amp;lang=" . $_SESSION['lang'] . "\">統計資料 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>年統計</strong></font>";	
						
					if($_GET['fun'] == '4')
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_analysis.php?wshop=" . $wshop . "&amp;Opt_Analysis=viewpage&amp;lang=" . $_SESSION['lang'] . "\">頁面相關統計 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>近期訪客來訪資訊</strong></font>";	
						
					if($_GET['fun'] == '5')
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_analysis.php?wshop=" . $wshop . "&amp;Opt_Analysis=viewpage&amp;lang=" . $_SESSION['lang'] . "\">頁面相關統計 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>來訪頁面統計</strong></font>";		
						
					if($_GET['fun'] == '6')
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_analysis.php?wshop=" . $wshop . "&amp;Opt_Analysis=viewpage&amp;lang=" . $_SESSION['lang'] . "\">頁面相關統計 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>被訪頁面統計</strong></font>";		
						
					if($_GET['fun'] == '7')
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_analysis.php?wshop=" . $wshop . "&amp;Opt_Analysis=viewpage&amp;lang=" . $_SESSION['lang'] . "\">頁面相關統計 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>訪客軟體統計</strong></font>";		
						
					if($_GET['fun'] == '8')
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_analysis.php?wshop=" . $wshop . "&amp;Opt_Analysis=viewpage&amp;lang=" . $_SESSION['lang'] . "\">頁面相關統計 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>排除資訊</strong></font>";					
					break;
				case "settingpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_analysis.php?wshop=" . $wshop . "&amp;Opt_Analysis=viewpage&amp;lang=" . $_SESSION['lang'] . "\">相關設定 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>參數設定</strong></font>";	
					break;
				default:
					break;
			}
			
			switch($_GET['Opt_Catalog'])
			{
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['Catalog']/*型錄下載*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_catalog.php?wshop=" . $wshop . "&amp;Opt_Catalog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Catalog']/*型錄下載*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_catalog.php?wshop=" . $wshop . "&amp;Opt_Catalog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Catalog']/*型錄下載*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_catalog.php?wshop=" . $wshop . "&amp;Opt_Catalog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Catalog']/*型錄下載*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_catalog.php?wshop=" . $wshop . "&amp;Opt_Catalog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Catalog']/*型錄下載*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_catalog.php?wshop=" . $wshop . "&amp;Opt_Catalog=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:
					//$ViewLIne_Type = "". $ModuleName['News']/*最新訊息*/ . "";	
					break;
			}
			
			switch($_GET['Opt_Letters'])
			{
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['Letters']/*新聞快報*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_letters.php?wshop=" . $wshop . "&amp;Opt_Letters=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Letters']/*新聞快報*/ . "</a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_letters.php?wshop=" . $wshop . "&amp;Opt_Letters=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Letters']/*新聞快報*/ . "</a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_letters.php?wshop=" . $wshop . "&amp;Opt_Letters=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Letters']/*新聞快報*/ . "</a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_letters.php?wshop=" . $wshop . "&amp;Opt_Letters=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Letters']/*新聞快報*/ . "</a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_letters.php?wshop=" . $wshop . "&amp;Opt_Letters=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:
					//$ViewLIne_Type = "". $ModuleName['News']/*最新訊息*/ . "";	
					break;
			}
			
			switch($_GET['Opt_Actnews'])
			{
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['Actnews']/*活動快訊*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_actnews.php?wshop=" . $wshop . "&amp;Opt_Actnews=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Actnews']/*活動快訊*/ . "</a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_actnews.php?wshop=" . $wshop . "&amp;Opt_Actnews=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Actnews']/*活動快訊*/ . "</a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_actnews.php?wshop=" . $wshop . "&amp;Opt_Actnews=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Actnews']/*活動快訊*/ . "</a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_actnews.php?wshop=" . $wshop . "&amp;Opt_Actnews=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Actnews']/*活動快訊*/ . "</a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_actnews.php?wshop=" . $wshop . "&amp;Opt_Actnews=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:
					//$ViewLIne_Type = "". $ModuleName['News']/*最新訊息*/ . "";	
					break;
			}
			
			switch($_GET['Opt_Faq'])
			{
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['Faq']/*常見問答*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_faq.php?wshop=" . $wshop . "&amp;Opt_Faq=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Faq']/*常見問答*/ . "</a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_faq.php?wshop=" . $wshop . "&amp;Opt_Faq=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Faq']/*常見問答*/ . "</a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_faq.php?wshop=" . $wshop . "&amp;Opt_Faq=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Faq']/*常見問答*/ . "</a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_faq.php?wshop=" . $wshop . "&amp;Opt_Faq=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Faq']/*常見問答*/ . "</a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_faq.php?wshop=" . $wshop . "&amp;Opt_Faq=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:
					//$ViewLIne_Type = "". $ModuleName['News']/*最新訊息*/ . "";	
					break;
			}
			
			switch($_GET['Opt_Config'])
			{
				case "settingpage_ap":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>帳密修改</strong></font>";			
					break;
				case "settingpage_fr":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>前台設定</strong></font>";	
					break;
				case "settingpage_bs":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>基本設定</strong></font>";	
					break;
				case "settingpage_otr":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>其他設定</strong></font>";	
					break;
				default:;	
					break;
			}
			
			switch($_GET['Opt_Blog'])
			{
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>Blog維護</strong></font>";			
					break;
				case "viewpage_sub":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>Blog維護</strong></font>";			
					break;
				case "searchpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>文章搜索</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;	
				case "postpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>問答紀錄</strong></font>";	
					break;
				case "postaddpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "posteditpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;
				case "replypage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>回應一覽</strong></font>";	
					break;
				case "replyaddpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=replypage&amp;lang=" . $_SESSION['lang'] . "&amp;post_id=" . $_GET['post_id'] . "&amp;pd_id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">回應一覽 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
					break;
				case "replyeditpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=replypage&amp;lang=" . $_SESSION['lang'] . "&amp;post_id=" . $_GET['post_id'] . "&amp;pd_id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">回應一覽 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;		
				case "listpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				case "mulilistitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理(L0)</strong></font>";	
					break;
				case "sub_mulilistitempage":
				if($_GET['level'] == '1'){
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " .  "<font color=\"#045178\"><strong>項目管理(L1)</strong></font>";	
					}
				if($_GET['level'] == '2'){
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=sub_mulilistitempage&amp;list_id=" . $_GET['list_id']  . "&amp;level=1" . "&amp;item_id=" . $_GET['subitem_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " .  "<font color=\"#045178\"><strong>項目管理(L2)</strong></font>";	
					}
				/*if($_GET['level'] == '3'){
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">討論專區 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>". " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L2) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " .  "<font color=\"#045178\"><strong>項目管理(L3)</strong></font>";	
					}*/
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Article'])
			{
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['Article']/*文章維護*/ . "</strong></font>";			
					break;
				case "viewpage_sub":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['Article']/*文章維護*/ . "</strong></font>";			
					break;
				case "searchpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt_Article=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Article']/*文章維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>文章搜索</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt_Article=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Article']/*文章維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt_Article=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Article']/*文章維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt_Article=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Article']/*文章維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt_Article=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Article']/*文章維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt_Article=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				case "mulilistitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt_Article=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Article']/*文章維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt_Article=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理(L0)</strong></font>";	
					break;
				case "sub_mulilistitempage":
				if($_GET['level'] == '1'){
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt_Article=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Article']/*文章維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt_Article=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt_Article=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " .  "<font color=\"#045178\"><strong>項目管理(L1)</strong></font>";	
					}
				if($_GET['level'] == '2'){
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt_Article=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Article']/*文章維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt_Article=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt_Article=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt_Article=sub_mulilistitempage&amp;list_id=" . $_GET['list_id']  . "&amp;level=1" . "&amp;item_id=" . $_GET['subitem_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " .  "<font color=\"#045178\"><strong>項目管理(L2)</strong></font>";	
					}
				/*if($_GET['level'] == '3'){
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt_Article=viewpage&amp;lang=" . $_SESSION['lang'] . "\">討論專區 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>". " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L2) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " .  "<font color=\"#045178\"><strong>項目管理(L3)</strong></font>";	
					}*/
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_DfPage'])
			{
				case "typepage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>分類選單</strong></font>";			
					break;
				case "typeaddpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt_DfPage=typepage&amp;lang=" . $_SESSION['lang'] . "\">分類選單 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;	
				case "typeeditpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt_DfPage=typepage&amp;lang=" . $_SESSION['lang'] . "\">分類選單 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";		
					break;
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt_DfPage=typepage&amp;lang=" . $_SESSION['lang'] . "\">分類選單 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>" . $row_RecordTpt['title'] . "</strong></font>";			
					break;
				case "viewpage_sub":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt_DfPage=typepage&amp;lang=" . $_SESSION['lang'] . "\">分類選單 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>" . $row_RecordTpt['title'] . "</strong></font>";			
					break;
				case "searchpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt_DfPage=typepage&amp;lang=" . $_SESSION['lang'] . "\">分類選單 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>" . $row_RecordTpt['title'] . "</strong></font>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>文章搜索</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt_DfPage=typepage&amp;lang=" . $_SESSION['lang'] . "\">分類選單 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt_DfPage=viewpage&amp;lang=" . $_SESSION['lang'] . "&amp;aid=" . $_GET['aid'] . "&amp;tpt=" . $row_RecordTpt['title'] . "\">" . $row_RecordTpt['title'] . "</a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt_DfPage=typepage&amp;lang=" . $_SESSION['lang'] . "\">分類選單 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt_DfPage=viewpage&amp;lang=" . $_SESSION['lang'] . "&amp;aid=" . $_GET['aid'] . "&amp;tpt=" . $row_RecordTpt['title'] . "\">" . $row_RecordTpt['title'] . "</a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";
					break;			
				case "listpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt_DfPage=viewpage&amp;lang=" . $_SESSION['lang'] . "\">頁面一覽 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt_DfPage=typepage&amp;lang=" . $_SESSION['lang'] . "\">分類選單 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>" . $row_RecordTpt['title'] . "</strong></font>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt_DfPage=listitempage&amp;lang=" . $_SESSION['lang'] . "&amp;aid=" . $_GET['aid'] . "&amp;tpt=" . $row_RecordTpt['title'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				case "mulilistitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt_DfPage=typepage&amp;lang=" . $_SESSION['lang'] . "\">分類選單 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>" . $row_RecordTpt['title'] . "</strong></font>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt_DfPage=mulilistitempage&amp;lang=" . $_SESSION['lang'] . "&amp;aid=" . $_GET['aid'] . "&amp;tpt=" . $row_RecordTpt['title'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理(L0)</strong></font>";	
					break;
				case "sub_mulilistitempage":
				if($_GET['level'] == '1'){
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt_DfPage=typepage&amp;lang=" . $_SESSION['lang'] . "\">分類選單 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>" . $row_RecordTpt['title'] . "</strong></font>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt_DfPage=mulilistitempage&amp;lang=" . $_SESSION['lang'] . "&amp;aid=" . $_GET['aid'] . "&amp;tpt=" . $row_RecordTpt['title'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt_DfPage=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "&amp;aid=" . $_GET['aid'] . "&amp;tpt=" . $row_RecordTpt['title'] . "\">項目管理(L0) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " .  "<font color=\"#045178\"><strong>項目管理(L1)</strong></font>";	
					}
				if($_GET['level'] == '2'){
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt_DfPage=typepage&amp;lang=" . $_SESSION['lang'] . "\">分類選單 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>" . $row_RecordTpt['title'] . "</strong></font>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt_DfPage=mulilistitempage&amp;lang=" . $_SESSION['lang'] . "&amp;aid=" . $_GET['aid'] . "&amp;tpt=" . $row_RecordTpt['title'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt_DfPage=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "&amp;aid=" . $_GET['aid'] . "&amp;tpt=" . $row_RecordTpt['title'] . "\">項目管理(L0) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt_DfPage=sub_mulilistitempage&amp;list_id=" . $_GET['list_id']  . "&amp;level=1" . "&amp;item_id=" . $_GET['subitem_id'] . "&amp;lang=" . $_SESSION['lang'] . "&amp;aid=" . $_GET['aid'] . "&amp;tpt=" . $row_RecordTpt['title'] . "\">項目管理(L1) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " .  "<font color=\"#045178\"><strong>項目管理(L2)</strong></font>";	
					}
				/*if($_GET['level'] == '3'){
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt_DfPage=viewpage&amp;lang=" . $_SESSION['lang'] . "\">討論專區 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>". " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L2) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " .  "<font color=\"#045178\"><strong>項目管理(L3)</strong></font>";	
					}*/
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_About'])
			{
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['About']/*關於我們*/ . "</strong></font>";			
					break;
				case "viewpage_sub":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['About']/*關於我們*/ . "</strong></font>";			
					break;
				case "searchpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt_About=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['About']/*關於我們*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>文章搜索</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt_About=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['About']/*關於我們*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt_About=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['About']/*關於我們*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt_About=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['About']/*關於我們*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt_About=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['About']/*關於我們*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt_About=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				case "mulilistitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt_About=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['About']/*關於我們*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt_About=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理(L0)</strong></font>";	
					break;
				case "sub_mulilistitempage":
				if($_GET['level'] == '1'){
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt_About=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['About']/*關於我們*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt_About=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt_About=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " .  "<font color=\"#045178\"><strong>項目管理(L1)</strong></font>";	
					}
				if($_GET['level'] == '2'){
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt_About=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['About']/*關於我們*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt_About=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt_About=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt_About=sub_mulilistitempage&amp;list_id=" . $_GET['list_id']  . "&amp;level=1" . "&amp;item_id=" . $_GET['subitem_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " .  "<font color=\"#045178\"><strong>項目管理(L2)</strong></font>";	
					}
				/*if($_GET['level'] == '3'){
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt_Article=viewpage&amp;lang=" . $_SESSION['lang'] . "\">討論專區 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>". " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L2) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " .  "<font color=\"#045178\"><strong>項目管理(L3)</strong></font>";	
					}*/
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Contact'])
			{
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['Contact']/*聯絡我們*/ . "</strong></font>";			
					break;
				case "viewpage_sub":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['Contact']/*聯絡我們*/ . "</strong></font>";			
					break;
				case "searchpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt_Contact=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Contact']/*聯絡我們*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>文章搜索</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt_Contact=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Contact']/*聯絡我們*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt_Contact=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Contact']/*聯絡我們*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt_Contact=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Contact']/*聯絡我們*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt_Contact=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Contact']/*聯絡我們*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt_Contact=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				case "mulilistitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt_Contact=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Contact']/*聯絡我們*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt_Contact=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理(L0)</strong></font>";	
					break;
				case "sub_mulilistitempage":
				if($_GET['level'] == '1'){
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt_Contact=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Contact']/*聯絡我們*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt_Contact=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt_Contact=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " .  "<font color=\"#045178\"><strong>項目管理(L1)</strong></font>";	
					}
				if($_GET['level'] == '2'){
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt_Contact=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Contact']/*聯絡我們*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt_Contact=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt_Contact=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt_Contact=sub_mulilistitempage&amp;list_id=" . $_GET['list_id']  . "&amp;level=1" . "&amp;item_id=" . $_GET['subitem_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " .  "<font color=\"#045178\"><strong>項目管理(L2)</strong></font>";	
					}
				/*if($_GET['level'] == '3'){
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt_Article=viewpage&amp;lang=" . $_SESSION['lang'] . "\">討論專區 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>". " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L2) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " .  "<font color=\"#045178\"><strong>項目管理(L3)</strong></font>";	
					}*/
					break;
				default:	
					break;
			}
			
					
			switch($_GET['Opt_Careers'])
			{
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['Careers']/*求職徵才*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_careers.php?wshop=" . $wshop . "&amp;Opt_Careers=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Careers']/*求職徵才*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_careers.php?wshop=" . $wshop . "&amp;Opt_Careers=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Careers']/*求職徵才*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_careers.php?wshop=" . $wshop . "&amp;Opt_Careers=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Careers']/*求職徵才*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_careers.php?wshop=" . $wshop . "&amp;Opt_Careers=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Careers']/*求職徵才*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_careers.php?wshop=" . $wshop . "&amp;Opt_Careers=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Frilink'])
			{
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['Frilink']/*友站連結*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_frilink.php?wshop=" . $wshop . "&amp;Opt_Frilink=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Frilink']/*友站連結*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_frilink.php?wshop=" . $wshop . "&amp;Opt_Frilink=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Frilink']/*友站連結*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_frilink.php?wshop=" . $wshop . "&amp;Opt_Frilink=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Frilink']/*友站連結*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_frilink.php?wshop=" . $wshop . "&amp;Opt_Frilink=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Frilink']/*友站連結*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_frilink.php?wshop=" . $wshop . "&amp;Opt_Frilink=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_WebSite'])
			{
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>網站資訊</strong></font>";			
					break;
				case "chartpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>圖表統計</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_website.php?wshop=" . $wshop . "&amp;Opt_WebSite=viewpage&amp;lang=" . $_SESSION['lang'] . "\">網站資訊 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_website.php?wshop=" . $wshop . "&amp;Opt_WebSite=viewpage&amp;lang=" . $_SESSION['lang'] . "\">網站資訊 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_website.php?wshop=" . $wshop . "&amp;Opt_WebSite=viewpage&amp;lang=" . $_SESSION['lang'] . "\">網站資訊 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_website.php?wshop=" . $wshop . "&amp;Opt_WebSite=viewpage&amp;lang=" . $_SESSION['lang'] . "\">網站資訊 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_website.php?wshop=" . $wshop . "&amp;Opt_WebSite=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Donation'])
			{
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['Donation']/*捐款名錄*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_donation.php?wshop=" . $wshop . "&amp;Opt_Donation=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Donation']/*捐款名錄*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_donation.php?wshop=" . $wshop . "&amp;Opt_Donation=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Donation']/*捐款名錄*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_donation.php?wshop=" . $wshop . "&amp;Opt_Donation=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Donation']/*捐款名錄*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_donation.php?wshop=" . $wshop . "&amp;Opt_Careers=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Donation']/*捐款名錄*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_donation.php?wshop=" . $wshop . "&amp;Opt_Donation=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Guestbook'])
			{
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['Guestbook']/*留言管理*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_guestbook.php?wshop=" . $wshop . "&amp;Opt_Guestbook=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Guestbook']/*留言管理*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_guestbook.php?wshop=" . $wshop . "&amp;Opt_Guestbook=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Guestbook']/*留言管理*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯<strong></font>";	
					break;
				case "replyviewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_guestbook.php?wshop=" . $wshop . "&amp;Opt_Guestbook=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Guestbook']/*留言管理*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>主題回應<strong></font>";			
					break;
				case "replyaddpage":
				    $ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_guestbook.php?wshop=" . $wshop . "&amp;Opt_Guestbook=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Guestbook']/*留言管理*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_guestbook.php?wshop=" . $wshop . "&amp;Opt_Guestbook=replyviewpage&amp;lang=" . $_SESSION['lang'] . "&message_id=" . $_GET['message_id']. "\">主題回應 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "replyeditpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_guestbook.php?wshop=" . $wshop . "&amp;Opt_Guestbook=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Guestbook']/*留言管理*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_guestbook.php?wshop=" . $wshop . "&amp;Opt_Guestbook=replyviewpage&amp;lang=" . $_SESSION['lang'] . "&message_id=" . $_GET['message_id'].  "\">主題回應 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯<strong></font>";	
					break;
				case "listpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_guestbook.php?wshop=" . $wshop . "&amp;Opt_Guestbook=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Guestbook']/*留言管理*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>清單列表<strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_guestbook.php?wshop=" . $wshop . "&amp;Opt_Guestbook=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Guestbook']/*留言管理*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_guestbook.php?wshop=" . $wshop . "&amp;Opt_Guestbook=listpage&amp;lang=" . $_SESSION['lang']  .  "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理<strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Meeting'])
			{
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['Meeting']/*會議紀錄*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_meeting.php?wshop=" . $wshop . "&amp;Opt_Meeting=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Meeting']/*會議紀錄*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_meeting.php?wshop=" . $wshop . "&amp;Opt_Meeting=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Meeting']/*會議紀錄*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_meeting.php?wshop=" . $wshop . "&amp;Opt_Meeting=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Meeting']/*會議紀錄*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_meeting.php?wshop=" . $wshop . "&amp;Opt_Meeting=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Meeting']/*會議紀錄*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_meeting.php?wshop=" . $wshop . "&amp;Opt_Meeting=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Member'])
			{
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['Member']/*會員管理*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_member.php?wshop=" . $wshop . "&amp;Opt_Member=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Member']/*會員管理*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_member.php?wshop=" . $wshop . "&amp;Opt_Member=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Member']/*會員管理*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_member.php?wshop=" . $wshop . "&amp;Opt_Member=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Member']/*會員管理*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_member.php?wshop=" . $wshop . "&amp;Opt_Member=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Member']/*會員管理*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_member.php?wshop=" . $wshop . "&amp;Opt_Member=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				case "addpagepic":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_member.php?wshop=" . $wshop . "&amp;Opt_Member=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Member']/*會員管理*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "addpagepureupload":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_member.php?wshop=" . $wshop . "&amp;Opt_Member=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Member']/*會員管理*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpagepureupload":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_member.php?wshop=" . $wshop . "&amp;Opt_Member=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Member']/*會員管理*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;
				case "editpage_avatar":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_member.php?wshop=" . $wshop . "&amp;Opt_Member=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Member']/*會員管理*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;
				case "setpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_member.php?wshop=" . $wshop . "&amp;Opt_Member=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Member']/*會員管理*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>功能設定</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Org'])
			{
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['Org']/*組織成員*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_org.php?wshop=" . $wshop . "&amp;Opt_Org=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Org']/*組織成員*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_org..php?wshop=" . $wshop . "&amp;Opt_Org=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Org']/*組織成員*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_org..php?wshop=" . $wshop . "&amp;Opt_Org=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Org']/*組織成員*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_org..php?wshop=" . $wshop . "&amp;Opt_Org=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Org']/*組織成員*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_org..php?wshop=" . $wshop . "&amp;Opt_Org=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_EPaper'])
			{
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['EPaper']/*電子期刊*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_epaper.php?wshop=" . $wshop . "&amp;Opt_EPaper=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['EPaper']/*電子期刊*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_epaper.php?wshop=" . $wshop . "&amp;Opt_EPaper=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['EPaper']/*電子期刊*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;	
				case "mailpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>郵件列表</strong></font>";			
					break;
				case "addmailpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_epaper.php?wshop=" . $wshop . "&amp;Opt_EPaper=mailpage&amp;lang=" . $_SESSION['lang'] . "\">郵件列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editmailpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_epaper.php?wshop=" . $wshop . "&amp;Opt_EPaper=mailpage&amp;lang=" . $_SESSION['lang'] . "\">郵件列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_epaper.php?wshop=" . $wshop . "&amp;Opt_EPaper=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['EPaper']/*電子期刊*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_epaper.php?wshop=" . $wshop . "&amp;Opt_EPaper=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['EPaper']/*電子期刊*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_epaper..php?wshop=" . $wshop . "&amp;Opt_EPaper=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Product'])
			{
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['Product']/*產品維護*/ . "</strong></font>";			
					break;
				case "viewpage_sub":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['Product']/*產品維護*/ . "</strong></font>";			
					break;
				case "searchpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>搜索</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;	
				case "edittabpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "photoviewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>主題內頁</strong></font>";			
					break;
				case "photoaddpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=photoviewpage&amp;lang=" . $_SESSION['lang'] . "&aid=" . $_GET['aid']. "\">主題內頁 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";			
					break;
				case "photoeditpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=photoviewpage&amp;lang=" . $_SESSION['lang'] . "&aid=" . $_GET['aid']. "\">主題內頁 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";			
					break;
				case "postpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>問答紀錄</strong></font>";	
					break;
				case "postaddpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "posteditpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;
				case "replypage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>回應一覽</strong></font>";	
					break;

				case "replyaddpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=replypage&amp;lang=" . $_SESSION['lang'] . "&amp;post_id=" . $_GET['post_id'] . "&amp;pd_id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">回應一覽 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
					break;
				case "replyeditpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=replypage&amp;lang=" . $_SESSION['lang'] . "&amp;post_id=" . $_GET['post_id'] . "&amp;pd_id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">回應一覽 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;
				case "pluspage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>加值商品</strong></font>";	
					break;
				case "plusaddpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=pluspage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pdid'] . "&amp;pdname=" . $_GET['pdname'] . "\">加值商品</a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "pluseditpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=pluspage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pdid'] . "&amp;pdname=" . $_GET['pdname'] . "\">加值商品 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;
				case "listpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				case "mulilistitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理(L0)</strong></font>";	
					break;
				case "sub_mulilistitempage":
				if($_GET['level'] == '1'){
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " .  "<font color=\"#045178\"><strong>項目管理(L1)</strong></font>";	
					}
				if($_GET['level'] == '2'){
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=sub_mulilistitempage&amp;list_id=" . $_GET['list_id']  . "&amp;level=1" . "&amp;item_id=" . $_GET['subitem_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " .  "<font color=\"#045178\"><strong>項目管理(L2)</strong></font>";	
					}
				/*if($_GET['level'] == '3'){
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=viewpage&amp;lang=" . $_SESSION['lang'] . "\">產品維護 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>". " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L2) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " .  "<font color=\"#045178\"><strong>項目管理(L3)</strong></font>";	
					}*/
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Forum'])
			{
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['Forum']/*討論專區*/ . "</strong></font>";			
					break;
				case "viewpage_sub":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['Forum']/*討論專區*/ . "</strong></font>";			
					break;
				case "searchpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>主題搜索</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;	
				case "edittabpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "postpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>回覆一覽</strong></font>";	
					break;
				case "postaddpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">回覆一覽 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "posteditpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">回覆一覽 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;
				case "replypage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">回覆一覽 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>回應一覽</strong></font>";	
					break;
				case "replyaddpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">回覆一覽 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=replypage&amp;lang=" . $_SESSION['lang'] . "&amp;post_id=" . $_GET['post_id'] . "&amp;pd_id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">回應一覽 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
					break;
				case "replyeditpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">回覆一覽 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=replypage&amp;lang=" . $_SESSION['lang'] . "&amp;post_id=" . $_GET['post_id'] . "&amp;pd_id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">回應一覽 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;
				case "listpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				case "mulilistitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理(L0)</strong></font>";	
					break;
				case "sub_mulilistitempage":
				if($_GET['level'] == '1'){
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " .  "<font color=\"#045178\"><strong>項目管理(L1)</strong></font>";	
					}
				if($_GET['level'] == '2'){
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=sub_mulilistitempage&amp;list_id=" . $_GET['list_id']  . "&amp;level=1" . "&amp;item_id=" . $_GET['subitem_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " .  "<font color=\"#045178\"><strong>項目管理(L2)</strong></font>";	
					}
				/*if($_GET['level'] == '3'){
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">討論專區 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Product=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Product=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>". " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Product=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L2) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " .  "<font color=\"#045178\"><strong>項目管理(L3)</strong></font>";	
					}*/
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Publish'])
			{
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['Publish']/*公佈資訊*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_publish.php?wshop=" . $wshop . "&amp;Opt_Publish=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Publish']/*公佈資訊*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_publish.php?wshop=" . $wshop . "&amp;Opt_Publish=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Publish']/*公佈資訊*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_publish.php?wshop=" . $wshop . "&amp;Opt_Publish=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Publish']/*公佈資訊*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_publish.php?wshop=" . $wshop . "&amp;Opt_Publish=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Publish']/*公佈資訊*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_publish.php?wshop=" . $wshop . "&amp;Opt_Publish=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Sponsor'])
			{
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['Sponsor']/*贊助企業*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_sponsor.php?wshop=" . $wshop . "&amp;Opt_Sponsor=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Sponsor']/*贊助企業*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_sponsor.php?wshop=" . $wshop . "&amp;Opt_Sponsor=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Sponsor']/*贊助企業*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_sponsor.php?wshop=" . $wshop . "&amp;Opt_Sponsor=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Sponsor']/*贊助企業*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_sponsor.php?wshop=" . $wshop . "&amp;Opt_Sponsor=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Sponsor']/*贊助企業*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_sponsor.php?wshop=" . $wshop . "&amp;Opt_Sponsor=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Knowledge'])
			{
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['Knowledge']/*知識學習*/ . "</strong></font>";			
					break;
				case "viewpage_sub":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>". $ModuleName['Knowledge']/*知識學習*/ . "</strong></font>";			
					break;
				case "searchpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Knowledge']/*知識學習*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>知識學習搜索</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Knowledge']/*知識學習*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Knowledge']/*知識學習*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;	
				case "listpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Knowledge']/*知識學習*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Knowledge']/*知識學習*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				case "mulilistitempage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Knowledge']/*知識學習*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>項目管理(L0)</strong></font>";	
					break;
				case "sub_mulilistitempage":
				if($_GET['level'] == '1'){
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Knowledge']/*知識學習*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " .  "<font color=\"#045178\"><strong>項目管理(L1)</strong></font>";	
					}
				if($_GET['level'] == '2'){
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Knowledge']/*知識學習*/ . " </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=sub_mulilistitempage&amp;list_id=" . $_GET['list_id']  . "&amp;level=1" . "&amp;item_id=" . $_GET['subitem_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " .  "<font color=\"#045178\"><strong>項目管理(L2)</strong></font>";	
					}
				
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_SystemConfig'])
			{
				case "settingpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>後台系統</strong></font>";			
					break;
				case "settingpage_fr":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>前台系統</strong></font>";	
					break;
				case "settingpage_otr":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>其他設定</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_KyConfig'])
			{
				case "settingpage_ky":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>關鍵字設定</strong></font>";			
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Navimenu'])
			{
				case "viewpage":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>選單維護</strong></font>";				
					break;
				case "addpage_L1":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_navimenu.php?wshop=" . $wshop . "&amp;Opt_Navimenu=viewpage&amp;lang=" . $_SESSION['lang'] . "\">選單維護 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增一級選單</strong></font>";
					break;
			    case "addpage_L2":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_navimenu.php?wshop=" . $wshop . "&amp;Opt_Navimenu=viewpage&amp;lang=" . $_SESSION['lang'] . "\">選單維護 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增二級選單</strong></font>";
					break;
				case "addpage_L3":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<a href=\"manage_navimenu.php?wshop=" . $wshop . "&amp;Opt_Navimenu=viewpage&amp;lang=" . $_SESSION['lang'] . "\">選單維護 </a>" . " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#045178\"><strong>新增三級選單</strong></font>";
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Play'])
			{
				case "memory":
					$ViewLIne_Type = " <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> " . "<font color=\"#cccccc\"><strong>地域の秘密</strong></font>" . "<font color=\"#cccccc\"><strong> <img src=\"images/Chevron.gif\" width=\"5\" height=\"20\" align=\"absmiddle\" /> フロップ x メモリ</strong></font>";			
					break;
				default:	
					break;
			}
		?>
        

<?php if ($_GET['Opt_Play'] == '') { ?><a href="index.php?lang=<?php echo $_SESSION['lang']; ?>"><img src="images/IconHome.gif" width="16" height="16" align="absmiddle" /></a> 
<?php } else { ?><a href="../index.php?lang=<?php echo $_SESSION['lang']; ?>"><img src="images/IconHome.gif" width="16" height="16" align="absmiddle" /></a><?php } ?>
<?php echo $ViewLIne_Type; ?> 
<?php
mysqli_free_result($RecordTpt);
?>
