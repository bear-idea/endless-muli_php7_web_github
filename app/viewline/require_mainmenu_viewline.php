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
?>
<?php
			switch($_GET['Opt'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Activities']/*活動花絮*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_activities.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Activities']/*活動花絮*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_activities.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Activities']/*活動花絮*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯<strong></font>";	
					break;
				case "photoviewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_activities.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Activities']/*活動花絮*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>主題內頁<strong></font>";			
					break;
				case "photoaddpage":
				    $ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_activities.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Activities']/*活動花絮*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_activities.php?wshop=" . $wshop . "&amp;Opt=photoviewpage&amp;lang=" . $_SESSION['lang'] . "&act_id=" . $_GET['act_id']. "\">主題內頁 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "photoeditpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_activities.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Activities']/*活動花絮*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_activities.php?wshop=" . $wshop . "&amp;Opt=photoviewpage&amp;lang=" . $_SESSION['lang'] . "&act_id=" . $_GET['act_id'].  "\">主題內頁 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯<strong></font>";	
					break;
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_activities.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Activities']/*活動花絮*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表<strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_activities.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Activities']/*活動花絮*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_activities.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang']  .  "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理<strong></font>";	
					break;
				default:
					//$ViewLIne_Type = "". $ModuleName['Activities']/*活動花絮*/ . "";	
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Project']/*工程實績*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_project.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Project']/*工程實績*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_project.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Project']/*工程實績*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯<strong></font>";	
					break;
				case "photoviewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_project.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Project']/*工程實績*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>主題內頁<strong></font>";			
					break;
				case "photoaddpage":
				    $ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_project.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Project']/*工程實績*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_project.php?wshop=" . $wshop . "&amp;Opt=photoviewpage&amp;lang=" . $_SESSION['lang'] . "&act_id=" . $_GET['act_id']. "\">主題內頁 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "photoeditpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_project.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Project']/*工程實績*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_project.php?wshop=" . $wshop . "&amp;Opt=photoviewpage&amp;lang=" . $_SESSION['lang'] . "&act_id=" . $_GET['act_id'].  "\">主題內頁 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯<strong></font>";	
					break;
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_project.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Project']/*工程實績*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表<strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_project.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Project']/*工程實績*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_project.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang']  .  "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理<strong></font>";	
					break;
				default:
					//$ViewLIne_Type = "". $ModuleName['Project']/*工程實績*/ . "";	
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Album']/*工程實績*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_album.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Album']/*工程實績*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_album.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Album']/*工程實績*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯<strong></font>";	
					break;
				case "photoviewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_album.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Album']/*工程實績*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>主題內頁<strong></font>";			
					break;
				case "photoaddpage":
				    $ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_album.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Album']/*工程實績*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_album.php?wshop=" . $wshop . "&amp;Opt=photoviewpage&amp;lang=" . $_SESSION['lang'] . "&act_id=" . $_GET['act_id']. "\">主題內頁 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "photoeditpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_album.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Album']/*工程實績*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_album.php?wshop=" . $wshop . "&amp;Opt=photoviewpage&amp;lang=" . $_SESSION['lang'] . "&act_id=" . $_GET['act_id'].  "\">主題內頁 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯<strong></font>";	
					break;
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_album.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Album']/*工程實績*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表<strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_album.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Album']/*工程實績*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_album.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang']  .  "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理<strong></font>";	
					break;
				default:
					//$ViewLIne_Type = "". $ModuleName['Album']/*工程實績*/ . "";	
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>輪播系統</strong></font>";			
					break;
				case "step_map":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_ads.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">輪播系統 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>步驟地圖</strong></font>";	
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_ads.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">輪播系統 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_ads.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">輪播系統 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯<strong></font>";	
					break;
				case "photoviewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_ads.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">輪播系統 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>輪播圖片<strong></font>";			
					break;
				case "photoaddpage":
				case "photoaddpage_mod1":
				case "photoaddpage_mod2":
				case "photoaddpage_mod3":
				case "photoaddpage_mod4":
				case "photoaddpage_mod5":
				case "photoaddpage_mod6":
				case "photoaddpage_mod7":
				case "photoaddpage_mod8":
				    $ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_ads.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">輪播系統 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_ads.php?wshop=" . $wshop . "&amp;Opt=photoviewpage&amp;lang=" . $_SESSION['lang'] . "&act_id=" . $_GET['act_id']. "\">輪播圖片 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "ads_select":
				    $ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_ads.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">輪播系統 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_ads.php?wshop=" . $wshop . "&amp;Opt=photoviewpage&amp;lang=" . $_SESSION['lang'] . "&act_id=" . $_GET['act_id']. "\">輪播圖片 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>選擇</strong></font>";	
					break;
				case "ads_set":
				    $ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_ads.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">輪播系統 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_ads.php?wshop=" . $wshop . "&amp;Opt=photoviewpage&amp;lang=" . $_SESSION['lang'] . "&act_id=" . $_GET['act_id']. "\">輪播圖片 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>參數設定</strong></font>";	
					break;
				case "photoeditpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_ads.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">輪播系統 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_ads.php?wshop=" . $wshop . "&amp;Opt=photoviewpage&amp;lang=" . $_SESSION['lang'] . "&act_id=" . $_GET['act_id'].  "\">輪播圖片 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯<strong></font>";	
					break;
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_ads.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">輪播系統 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表<strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_ads.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">輪播系統 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_ads.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang']  .  "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理<strong></font>";	
					break;
				default:
					//$ViewLIne_Type = "". $ModuleName['Album']/*工程實績*/ . "";	
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['News']/*最新訊息*/ . "</strong></font>";			
					break;
				case "seo":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['News']/*最新訊息*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>SEO</strong></font>";	
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['News']/*最新訊息*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['News']/*最新訊息*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['News']/*最新訊息*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['News']/*最新訊息*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				case "postpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['News']/*最新訊息*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>問答紀錄</strong></font>";	
					break;
				case "searchpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['News']/*最新訊息*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>問答紀錄</strong></font>";	
					break;
				case "postaddpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['News']/*最新訊息*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "posteditpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['News']/*最新訊息*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;
				case "replypage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['News']/*最新訊息*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt=searchpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>回應一覽</strong></font>";	
					break;
				case "replyaddpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['News']/*最新訊息*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt=searchpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt=replypage&amp;lang=" . $_SESSION['lang'] . "&amp;post_id=" . $_GET['post_id'] . "&amp;pd_id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">回應一覽 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
					break;
				case "replyeditpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['News']/*最新訊息*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt=searchpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_news.php?wshop=" . $wshop . "&amp;Opt=replypage&amp;lang=" . $_SESSION['lang'] . "&amp;post_id=" . $_GET['post_id'] . "&amp;pd_id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">回應一覽 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;
				default:
					//$ViewLIne_Type = "". $ModuleName['News']/*最新訊息*/ . "";	
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". "公告資訊"/*最新訊息*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_bulletin.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". "公告資訊"/*最新訊息*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_bulletin.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". "公告資訊"/*最新訊息*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				default:
					//$ViewLIne_Type = "". "公告資訊"/*最新訊息*/ . "";	
					break;
			}
			
			switch($_GET['Opt_Analysis'])
			{
				case "viewpage":
					if($_GET['fun'] == '0')
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_analysis.php?wshop=" . $wshop . "&amp;Opt_Analysis=viewpage&amp;lang=" . $_SESSION['lang'] . "\">統計資料 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>資訊一覽</strong></font>";
					
					if($_GET['fun'] == '1')
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_analysis.php?wshop=" . $wshop . "&amp;Opt_Analysis=viewpage&amp;lang=" . $_SESSION['lang'] . "\">統計資料 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>週統計</strong></font>";		
					
					if($_GET['fun'] == '2')
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_analysis.php?wshop=" . $wshop . "&amp;Opt_Analysis=viewpage&amp;lang=" . $_SESSION['lang'] . "\">統計資料 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>月統計</strong></font>";		
					
					if($_GET['fun'] == '3')
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_analysis.php?wshop=" . $wshop . "&amp;Opt_Analysis=viewpage&amp;lang=" . $_SESSION['lang'] . "\">統計資料 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>年統計</strong></font>";	
						
					if($_GET['fun'] == '4')
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_analysis.php?wshop=" . $wshop . "&amp;Opt_Analysis=viewpage&amp;lang=" . $_SESSION['lang'] . "\">頁面相關統計 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>近期訪客來訪資訊</strong></font>";	
						
					if($_GET['fun'] == '5')
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_analysis.php?wshop=" . $wshop . "&amp;Opt_Analysis=viewpage&amp;lang=" . $_SESSION['lang'] . "\">頁面相關統計 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>來訪頁面統計</strong></font>";		
						
					if($_GET['fun'] == '6')
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_analysis.php?wshop=" . $wshop . "&amp;Opt_Analysis=viewpage&amp;lang=" . $_SESSION['lang'] . "\">頁面相關統計 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>被訪頁面統計</strong></font>";		
						
					if($_GET['fun'] == '7')
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_analysis.php?wshop=" . $wshop . "&amp;Opt_Analysis=viewpage&amp;lang=" . $_SESSION['lang'] . "\">頁面相關統計 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>訪客軟體統計</strong></font>";		
						
					if($_GET['fun'] == '8')
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_analysis.php?wshop=" . $wshop . "&amp;Opt_Analysis=viewpage&amp;lang=" . $_SESSION['lang'] . "\">頁面相關統計 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>排除資訊</strong></font>";					
					break;
				case "settingpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_analysis.php?wshop=" . $wshop . "&amp;Opt_Analysis=viewpage&amp;lang=" . $_SESSION['lang'] . "\">相關設定 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>參數設定</strong></font>";	
					break;
				default:
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Catalog']/*型錄下載*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_catalog.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Catalog']/*型錄下載*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "addpage_l":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_catalog.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Catalog']/*型錄下載*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "addpage_s":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_catalog.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Catalog']/*型錄下載*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>檔案位置選擇</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_catalog.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Catalog']/*型錄下載*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_catalog.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Catalog']/*型錄下載*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_catalog.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Catalog']/*型錄下載*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_catalog.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:
					//$ViewLIne_Type = "". $ModuleName['News']/*最新訊息*/ . "";	
					break;
			}
			
			switch($_GET['Opt_Timeline'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Timeline']/*型錄下載*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_timeline.php?wshop=" . $wshop . "&amp;Opt_Timeline=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Timeline']/*歷史沿革*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_timeline.php?wshop=" . $wshop . "&amp;Opt_Timeline=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Timeline']/*歷史沿革*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_timeline.php?wshop=" . $wshop . "&amp;Opt_Timeline=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Timeline']/*歷史沿革*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_timeline.php?wshop=" . $wshop . "&amp;Opt_Timeline=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Timeline']/*歷史沿革*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_timeline.php?wshop=" . $wshop . "&amp;Opt_Timeline=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:
					//$ViewLIne_Type = "". $ModuleName['News']/*歷史沿革*/ . "";	
					break;
			}
			
			switch($_GET['Opt_Letters'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Letters']/*新聞快報*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_letters.php?wshop=" . $wshop . "&amp;Opt_Letters=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Letters']/*新聞快報*/ . "</a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_letters.php?wshop=" . $wshop . "&amp;Opt_Letters=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Letters']/*新聞快報*/ . "</a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_letters.php?wshop=" . $wshop . "&amp;Opt_Letters=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Letters']/*新聞快報*/ . "</a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_letters.php?wshop=" . $wshop . "&amp;Opt_Letters=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Letters']/*新聞快報*/ . "</a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_letters.php?wshop=" . $wshop . "&amp;Opt_Letters=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:
					//$ViewLIne_Type = "". $ModuleName['News']/*最新訊息*/ . "";	
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Actnews']/*活動快訊*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_actnews.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Actnews']/*活動快訊*/ . "</a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_actnews.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Actnews']/*活動快訊*/ . "</a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_actnews.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Actnews']/*活動快訊*/ . "</a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_actnews.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Actnews']/*活動快訊*/ . "</a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_actnews.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:
					//$ViewLIne_Type = "". $ModuleName['News']/*最新訊息*/ . "";	
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Faq']/*常見問答*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_faq.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Faq']/*常見問答*/ . "</a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_faq.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Faq']/*常見問答*/ . "</a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_faq.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Faq']/*常見問答*/ . "</a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_faq.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Faq']/*常見問答*/ . "</a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_faq.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:
					//$ViewLIne_Type = "". $ModuleName['News']/*最新訊息*/ . "";	
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "settingpage_ap":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>帳密修改</strong></font>";			
					break;
				case "settingpage_fr":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>前台設定</strong></font>";	
					break;
				case "settingpage_bs":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>基本設定</strong></font>";	
					break;
				case "settingpage_otr":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>其他設定</strong></font>";	
					break;
				case "settingpage_user":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>個人基本資料</strong></font>";	
					break;
				case "settingpage_list":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_config.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">基本設定</a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "settingpage_mulilistitem":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_config.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">基本設定 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_config.php?wshop=" . $wshop . "&amp;Opt=settingpage_list&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理(L0)</strong></font>";	
					break;
				case "settingpage_sub_mulilistitempage":
				if($_GET['level'] == '1'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_config.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">基本設定 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_config.php?wshop=" . $wshop . "&amp;Opt=settingpage_list&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_config.php?wshop=" . $wshop . "&amp;Opt=settingpage_mulilistitem&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L1)</strong></font>";	
					}
				if($_GET['level'] == '2'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_config.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">基本設定 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_config.php?wshop=" . $wshop . "&amp;Opt=settingpage_list&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_config.php?wshop=" . $wshop . "&amp;Opt=settingpage_mulilistitem&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_config.php?wshop=" . $wshop . "&amp;Opt=settingpage_sub_mulilistitempage&amp;list_id=" . $_GET['list_id']  . "&amp;level=1" . "&amp;item_id=" . $_GET['subitem_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L2)</strong></font>";	
					}
					break;
				default:;	
					break;
			}
			
			switch($_GET['Opt_Blog'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>Blog維護</strong></font>";			
					break;
				case "viewpage_sub":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>Blog維護</strong></font>";			
					break;
				case "searchpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>文章搜索</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;	
				case "postpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>問答紀錄</strong></font>";	
					break;
				case "postaddpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "posteditpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;
				case "replypage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>回應一覽</strong></font>";	
					break;
				case "replyaddpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=replypage&amp;lang=" . $_SESSION['lang'] . "&amp;post_id=" . $_GET['post_id'] . "&amp;pd_id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">回應一覽 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
					break;
				case "replyeditpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=replypage&amp;lang=" . $_SESSION['lang'] . "&amp;post_id=" . $_GET['post_id'] . "&amp;pd_id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">回應一覽 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;		
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				case "mulilistitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理(L0)</strong></font>";	
					break;
				case "sub_mulilistitempage":
				if($_GET['level'] == '1'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L1)</strong></font>";	
					}
				if($_GET['level'] == '2'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">Blog維護 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_blog.php?wshop=" . $wshop . "&amp;Opt_Blog=sub_mulilistitempage&amp;list_id=" . $_GET['list_id']  . "&amp;level=1" . "&amp;item_id=" . $_GET['subitem_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L2)</strong></font>";	
					}
				/*if($_GET['level'] == '3'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt_Blog=viewpage&amp;lang=" . $_SESSION['lang'] . "\">討論專區 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L2) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L3)</strong></font>";	
					}*/
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Article']/*文章維護*/ . "</strong></font>";			
					break;
				case "viewpage_sub":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Article']/*文章維護*/ . "</strong></font>";			
					break;
				case "searchpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Article']/*文章維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>文章搜索</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Article']/*文章維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Article']/*文章維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Article']/*文章維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Article']/*文章維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				case "mulilistitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Article']/*文章維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理(L0)</strong></font>";	
					break;
				case "sub_mulilistitempage":
				if($_GET['level'] == '1'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Article']/*文章維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L1)</strong></font>";	
					}
				if($_GET['level'] == '2'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Article']/*文章維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt=sub_mulilistitempage&amp;list_id=" . $_GET['list_id']  . "&amp;level=1" . "&amp;item_id=" . $_GET['subitem_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L2)</strong></font>";	
					}
				/*if($_GET['level'] == '3'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_article.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">討論專區 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L2) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L3)</strong></font>";	
					}*/
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "typepage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>分類選單</strong></font>";			
					break;
				case "typeaddpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt=typepage&amp;lang=" . $_SESSION['lang'] . "\">分類選單 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;	
				case "tmp_step_type_map":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt=typepage&amp;lang=" . $_SESSION['lang'] . "\">分類選單 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>步驟地圖</strong></font>";	
					break;	
				case "typeeditpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt=typepage&amp;lang=" . $_SESSION['lang'] . "\">分類選單 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";		
					break;
				case "typelinkeditpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt=typepage&amp;lang=" . $_SESSION['lang'] . "\">分類選單 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";		
					break;
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt=typepage&amp;lang=" . $_SESSION['lang'] . "\">分類選單 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . $row_RecordTpt['title'] . "</strong></font>";			
					break;
				case "viewpage_sub":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt=typepage&amp;lang=" . $_SESSION['lang'] . "\">分類選單 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . $row_RecordTpt['title'] . "</strong></font>";			
					break;
				case "searchpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt=typepage&amp;lang=" . $_SESSION['lang'] . "\">分類選單 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . $row_RecordTpt['title'] . "</strong></font>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>文章搜索</strong></font>";			
					break;
				case "searchallpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt=typepage&amp;lang=" . $_SESSION['lang'] . "\">分類選單 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>文章搜索</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt=typepage&amp;lang=" . $_SESSION['lang'] . "\">分類選單 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "&amp;aid=" . $_GET['aid'] . "&amp;tpt=" . $row_RecordTpt['title'] . "\">" . $row_RecordTpt['title'] . "</a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt=typepage&amp;lang=" . $_SESSION['lang'] . "\">分類選單 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "&amp;aid=" . $_GET['aid'] . "&amp;tpt=" . $row_RecordTpt['title'] . "\">" . $row_RecordTpt['title'] . "</a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">頁面一覽 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt=typepage&amp;lang=" . $_SESSION['lang'] . "\">分類選單 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . $row_RecordTpt['title'] . "</strong></font>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt=listitempage&amp;lang=" . $_SESSION['lang'] . "&amp;aid=" . $_GET['aid'] . "&amp;tpt=" . $row_RecordTpt['title'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				case "mulilistitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt=typepage&amp;lang=" . $_SESSION['lang'] . "\">分類選單 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . $row_RecordTpt['title'] . "</strong></font>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;lang=" . $_SESSION['lang'] . "&amp;aid=" . $_GET['aid'] . "&amp;tpt=" . $row_RecordTpt['title'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理(L0)</strong></font>";	
					break;
				case "sub_mulilistitempage":
				if($_GET['level'] == '1'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt=typepage&amp;lang=" . $_SESSION['lang'] . "\">分類選單 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . $row_RecordTpt['title'] . "</strong></font>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;lang=" . $_SESSION['lang'] . "&amp;aid=" . $_GET['aid'] . "&amp;tpt=" . $row_RecordTpt['title'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "&amp;aid=" . $_GET['aid'] . "&amp;tpt=" . $row_RecordTpt['title'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L1)</strong></font>";	
					}
				if($_GET['level'] == '2'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt=typepage&amp;lang=" . $_SESSION['lang'] . "\">分類選單 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . $row_RecordTpt['title'] . "</strong></font>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;lang=" . $_SESSION['lang'] . "&amp;aid=" . $_GET['aid'] . "&amp;tpt=" . $row_RecordTpt['title'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "&amp;aid=" . $_GET['aid'] . "&amp;tpt=" . $row_RecordTpt['title'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt=sub_mulilistitempage&amp;list_id=" . $_GET['list_id']  . "&amp;level=1" . "&amp;item_id=" . $_GET['subitem_id'] . "&amp;lang=" . $_SESSION['lang'] . "&amp;aid=" . $_GET['aid'] . "&amp;tpt=" . $row_RecordTpt['title'] . "\">項目管理(L1) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L2)</strong></font>";	
					}
				/*if($_GET['level'] == '3'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dfpage.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">討論專區 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L2) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L3)</strong></font>";	
					}*/
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['About']/*關於我們*/ . "</strong></font>";			
					break;
				case "viewpage_sub":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['About']/*關於我們*/ . "</strong></font>";			
					break;
				case "searchpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['About']/*關於我們*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>文章搜索</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['About']/*關於我們*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['About']/*關於我們*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['About']/*關於我們*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['About']/*關於我們*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				case "mulilistitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['About']/*關於我們*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理(L0)</strong></font>";	
					break;
				case "sub_mulilistitempage":
				if($_GET['level'] == '1'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['About']/*關於我們*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L1)</strong></font>";	
					}
				if($_GET['level'] == '2'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['About']/*關於我們*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt=sub_mulilistitempage&amp;list_id=" . $_GET['list_id']  . "&amp;level=1" . "&amp;item_id=" . $_GET['subitem_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L2)</strong></font>";	
					}
				/*if($_GET['level'] == '3'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">討論專區 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L2) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L3)</strong></font>";	
					}*/
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Contact']/*聯絡我們*/ . "</strong></font>";			
					break;
				case "viewpage_sub":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Contact']/*聯絡我們*/ . "</strong></font>";			
					break;
				case "searchpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Contact']/*聯絡我們*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>文章搜索</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Contact']/*聯絡我們*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Contact']/*聯絡我們*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Contact']/*聯絡我們*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Contact']/*聯絡我們*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				case "mulilistitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Contact']/*聯絡我們*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理(L0)</strong></font>";	
					break;
				case "sub_mulilistitempage":
				if($_GET['level'] == '1'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Contact']/*聯絡我們*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L1)</strong></font>";	
					}
				if($_GET['level'] == '2'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Contact']/*聯絡我們*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_contact.php?wshop=" . $wshop . "&amp;Opt=sub_mulilistitempage&amp;list_id=" . $_GET['list_id']  . "&amp;level=1" . "&amp;item_id=" . $_GET['subitem_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L2)</strong></font>";	
					}
				/*if($_GET['level'] == '3'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_about.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">討論專區 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L2) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L3)</strong></font>";	
					}*/
					break;
				default:	
					break;
			}
			
					
			switch($_GET['Opt_Careers'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Careers']/*求職徵才*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_careers.php?wshop=" . $wshop . "&amp;Opt_Careers=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Careers']/*求職徵才*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_careers.php?wshop=" . $wshop . "&amp;Opt_Careers=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Careers']/*求職徵才*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_careers.php?wshop=" . $wshop . "&amp;Opt_Careers=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Careers']/*求職徵才*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_careers.php?wshop=" . $wshop . "&amp;Opt_Careers=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Careers']/*求職徵才*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_careers.php?wshop=" . $wshop . "&amp;Opt_Careers=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Frilink']/*友站連結*/ . "</strong></font>";			
					break;
				case "tmp_step_map":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_frilink.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Frilink']/*友站連結*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>步驟地圖</strong></font>";		
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_frilink.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Frilink']/*友站連結*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_frilink.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Frilink']/*友站連結*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_frilink.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Frilink']/*友站連結*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_frilink.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Frilink']/*友站連結*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_frilink.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Modlink']/*友站連結*/ . "</strong></font>";			
					break;
				case "tmp_step_map":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_modlink.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Modlink']/*友站連結*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>步驟地圖</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_modlink.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Modlink']/*友站連結*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_modlink.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Modlink']/*友站連結*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_modlink.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Modlink']/*友站連結*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_modlink.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Modlink']/*友站連結*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_modlink.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Otrlink'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Otrlink']/*相關連結*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_otrlink.php?wshop=" . $wshop . "&amp;Opt_Otrlink=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Otrlink']/*相關連結*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_otrlink.php?wshop=" . $wshop . "&amp;Opt_Otrlink=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Otrlink']/*相關連結*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_otrlink.php?wshop=" . $wshop . "&amp;Opt_Otrlink=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Otrlink']/*相關連結*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_otrlink.php?wshop=" . $wshop . "&amp;Opt_Otrlink=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Otrlink']/*相關連結*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_otrlink.php?wshop=" . $wshop . "&amp;Opt_Otrlink=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_WebSite'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>網站資訊</strong></font>";			
					break;
				case "chartpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>圖表統計</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_website.php?wshop=" . $wshop . "&amp;Opt_WebSite=viewpage&amp;lang=" . $_SESSION['lang'] . "\">網站資訊 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_website.php?wshop=" . $wshop . "&amp;Opt_WebSite=viewpage&amp;lang=" . $_SESSION['lang'] . "\">網站資訊 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_website.php?wshop=" . $wshop . "&amp;Opt_WebSite=viewpage&amp;lang=" . $_SESSION['lang'] . "\">網站資訊 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_website.php?wshop=" . $wshop . "&amp;Opt_WebSite=viewpage&amp;lang=" . $_SESSION['lang'] . "\">網站資訊 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_website.php?wshop=" . $wshop . "&amp;Opt_WebSite=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Donation'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Donation']/*捐款名錄*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_donation.php?wshop=" . $wshop . "&amp;Opt_Donation=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Donation']/*捐款名錄*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_donation.php?wshop=" . $wshop . "&amp;Opt_Donation=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Donation']/*捐款名錄*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_donation.php?wshop=" . $wshop . "&amp;Opt_Donation=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Donation']/*捐款名錄*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_donation.php?wshop=" . $wshop . "&amp;Opt_Careers=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Donation']/*捐款名錄*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_donation.php?wshop=" . $wshop . "&amp;Opt_Donation=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Guestbook'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Guestbook']/*留言管理*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_guestbook.php?wshop=" . $wshop . "&amp;Opt_Guestbook=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Guestbook']/*留言管理*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_guestbook.php?wshop=" . $wshop . "&amp;Opt_Guestbook=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Guestbook']/*留言管理*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯<strong></font>";	
					break;
				case "replyviewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_guestbook.php?wshop=" . $wshop . "&amp;Opt_Guestbook=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Guestbook']/*留言管理*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>主題回應<strong></font>";			
					break;
				case "replyaddpage":
				    $ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_guestbook.php?wshop=" . $wshop . "&amp;Opt_Guestbook=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Guestbook']/*留言管理*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_guestbook.php?wshop=" . $wshop . "&amp;Opt_Guestbook=replyviewpage&amp;lang=" . $_SESSION['lang'] . "&message_id=" . $_GET['message_id']. "\">主題回應 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "replyeditpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_guestbook.php?wshop=" . $wshop . "&amp;Opt_Guestbook=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Guestbook']/*留言管理*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_guestbook.php?wshop=" . $wshop . "&amp;Opt_Guestbook=replyviewpage&amp;lang=" . $_SESSION['lang'] . "&message_id=" . $_GET['message_id'].  "\">主題回應 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯<strong></font>";	
					break;
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_guestbook.php?wshop=" . $wshop . "&amp;Opt_Guestbook=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Guestbook']/*留言管理*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表<strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_guestbook.php?wshop=" . $wshop . "&amp;Opt_Guestbook=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Guestbook']/*留言管理*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_guestbook.php?wshop=" . $wshop . "&amp;Opt_Guestbook=listpage&amp;lang=" . $_SESSION['lang']  .  "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理<strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Meeting'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Meeting']/*會議紀錄*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_meeting.php?wshop=" . $wshop . "&amp;Opt_Meeting=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Meeting']/*會議紀錄*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_meeting.php?wshop=" . $wshop . "&amp;Opt_Meeting=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Meeting']/*會議紀錄*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_meeting.php?wshop=" . $wshop . "&amp;Opt_Meeting=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Meeting']/*會議紀錄*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_meeting.php?wshop=" . $wshop . "&amp;Opt_Meeting=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Meeting']/*會議紀錄*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_meeting.php?wshop=" . $wshop . "&amp;Opt_Meeting=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Member']/*會員管理*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_member.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Member']/*會員管理*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_member.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Member']/*會員管理*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_member.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Member']/*會員管理*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_member.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Member']/*會員管理*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_member.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				case "addpagepic":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_member.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Member']/*會員管理*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "addpagepureupload":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_member.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Member']/*會員管理*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpagepureupload":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_member.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Member']/*會員管理*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;
				case "editpage_avatar":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_member.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Member']/*會員管理*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;
				case "setpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_member.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Member']/*會員管理*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>功能設定</strong></font>";	
					break;
				case "thirdparty":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_member.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Member']/*會員管理*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>第三方帳號</strong></font>";	
					break;
				default:	
					break;
			}

			switch($_GET['Opt_Dealer'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Dealer']/*經銷專區*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dealer.php?wshop=" . $wshop . "&amp;Opt_Dealer=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Dealer']/*經銷專區*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dealer.php?wshop=" . $wshop . "&amp;Opt_Dealer=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Dealer']/*經銷專區*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dealer.php?wshop=" . $wshop . "&amp;Opt_Dealer=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Dealer']/*經銷專區*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dealer.php?wshop=" . $wshop . "&amp;Opt_Dealer=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Dealer']/*經銷專區*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dealer.php?wshop=" . $wshop . "&amp;Opt_Dealer=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				case "addpagepic":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dealer.php?wshop=" . $wshop . "&amp;Opt_Dealer=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Dealer']/*經銷專區*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "addpagepureupload":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dealer.php?wshop=" . $wshop . "&amp;Opt_Dealer=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Dealer']/*經銷專區*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpagepureupload":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dealer.php?wshop=" . $wshop . "&amp;Opt_Dealer=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Dealer']/*經銷專區*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;
				case "editpage_avatar":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dealer.php?wshop=" . $wshop . "&amp;Opt_Dealer=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Dealer']/*經銷專區*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;
				case "setpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_dealer.php?wshop=" . $wshop . "&amp;Opt_Dealer=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Dealer']/*經銷專區*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>功能設定</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Org'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Org']/*組織成員*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_org.php?wshop=" . $wshop . "&amp;Opt_Org=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Org']/*組織成員*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_org..php?wshop=" . $wshop . "&amp;Opt_Org=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Org']/*組織成員*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_org..php?wshop=" . $wshop . "&amp;Opt_Org=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Org']/*組織成員*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_org..php?wshop=" . $wshop . "&amp;Opt_Org=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Org']/*組織成員*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_org..php?wshop=" . $wshop . "&amp;Opt_Org=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Imageshow']/*圖片展示*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_imageshow.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Imageshow']/*圖片展示*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_imageshow..php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Imageshow']/*圖片展示*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_imageshow..php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Imageshow']/*圖片展示*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_imageshow..php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Imageshow']/*圖片展示*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_imageshow..php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_EPaper'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['EPaper']/*電子期刊*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_epaper.php?wshop=" . $wshop . "&amp;Opt_EPaper=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['EPaper']/*電子期刊*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_epaper.php?wshop=" . $wshop . "&amp;Opt_EPaper=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['EPaper']/*電子期刊*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;	
				case "mailpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>郵件列表</strong></font>";			
					break;
				case "addmailpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_epaper.php?wshop=" . $wshop . "&amp;Opt_EPaper=mailpage&amp;lang=" . $_SESSION['lang'] . "\">郵件列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editmailpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_epaper.php?wshop=" . $wshop . "&amp;Opt_EPaper=mailpage&amp;lang=" . $_SESSION['lang'] . "\">郵件列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_epaper.php?wshop=" . $wshop . "&amp;Opt_EPaper=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['EPaper']/*電子期刊*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_epaper.php?wshop=" . $wshop . "&amp;Opt_EPaper=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['EPaper']/*電子期刊*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_epaper..php?wshop=" . $wshop . "&amp;Opt_EPaper=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Sitemail'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". "站內信件"/*電子期刊*/ . "</strong></font>";			
					break;
				case "advpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". "站內信件"/*電子期刊*/ . "</strong></font>";			
					break;
				case "draftpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". "草稿匣"/*電子期刊*/ . "</strong></font>";			
					break;
				case "backuppage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". "寄件備份匣"/*電子期刊*/ . "</strong></font>";			
					break;
				case "sendpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_sitemail.php?wshop=" . $wshop . "&amp;Opt_Sitemail=mailpage&amp;lang=" . $_SESSION['lang'] . "\">郵件列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>發送信件</strong></font>";
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_sitemail.php?wshop=" . $wshop . "&amp;Opt_Sitemail=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". "站內信件"/*電子期刊*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_sitemail.php?wshop=" . $wshop . "&amp;Opt_Sitemail=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". "站內信件"/*電子期刊*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;	
				case "mailpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>郵件列表</strong></font>";			
					break;
				case "addmailpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_sitemail.php?wshop=" . $wshop . "&amp;Opt_Sitemail=mailpage&amp;lang=" . $_SESSION['lang'] . "\">郵件列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editmailpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_sitemail.php?wshop=" . $wshop . "&amp;Opt_Sitemail=mailpage&amp;lang=" . $_SESSION['lang'] . "\">郵件列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_sitemail.php?wshop=" . $wshop . "&amp;Opt_Sitemail=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". "站內信件"/*電子期刊*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_sitemail.php?wshop=" . $wshop . "&amp;Opt_Sitemail=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". "站內信件"/*電子期刊*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_sitemail..php?wshop=" . $wshop . "&amp;Opt_Sitemail=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Product']/*產品維護*/ . "</strong></font>";			
					break;
				case "seo":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>SEO</strong></font>";		
					break;			
					break;
				case "datachange":
				    $ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>資料轉移</strong></font>";		
					break;
				case "inventory":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>庫存管理</strong></font>";				
					break;
				case "pricecheck":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>價格及審核狀態</strong></font>";				
					break;
				case "pricecheck_st":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>價格審核設定</strong></font>";				
					break;
				case "viewpage_sub":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Product']/*產品維護*/ . "</strong></font>";			
					break;
				case "searchpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>搜索</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;	
				case "edittabpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "photoviewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>主題內頁</strong></font>";			
					break;
				case "photoaddpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=photoviewpage&amp;lang=" . $_SESSION['lang'] . "&aid=" . $_GET['aid']. "\">主題內頁 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";			
					break;
				case "photoeditpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=photoviewpage&amp;lang=" . $_SESSION['lang'] . "&aid=" . $_GET['aid']. "\">主題內頁 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";			
					break;
				case "postpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>問答紀錄</strong></font>";	
					break;
				case "postaddpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "posteditpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;
				case "replypage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>回應一覽</strong></font>";	
					break;
				case "replyaddpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=replypage&amp;lang=" . $_SESSION['lang'] . "&amp;post_id=" . $_GET['post_id'] . "&amp;pd_id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">回應一覽 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
					break;
				case "replyeditpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">問答紀錄 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=replypage&amp;lang=" . $_SESSION['lang'] . "&amp;post_id=" . $_GET['post_id'] . "&amp;pd_id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">回應一覽 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;
				case "pluspage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>加值商品</strong></font>";	
					break;
				case "plusaddpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=pluspage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pdid'] . "&amp;pdname=" . $_GET['pdname'] . "\">加值商品</a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "pluseditpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=pluspage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pdid'] . "&amp;pdname=" . $_GET['pdname'] . "\">加值商品 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				case "mulilistitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理(L0)</strong></font>";	
					break;
				case "sub_mulilistitempage":
				if($_GET['level'] == '1'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L1)</strong></font>";	
					}
				if($_GET['level'] == '2'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Product']/*產品維護*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=sub_mulilistitempage&amp;list_id=" . $_GET['list_id']  . "&amp;level=1" . "&amp;item_id=" . $_GET['subitem_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L2)</strong></font>";	
					}
				/*if($_GET['level'] == '3'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">產品維護 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L2) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L3)</strong></font>";	
					}*/
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Room'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Room']/*房型展示*/ . "</strong></font>";			
					break;
				case "viewpage_sub":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Room']/*房型展示*/ . "</strong></font>";			
					break;
				case "searchpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_room.php?wshop=" . $wshop . "&amp;Opt_Room=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Room']/*房型展示*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>搜索</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_room.php?wshop=" . $wshop . "&amp;Opt_Room=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Room']/*房型展示*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_room.php?wshop=" . $wshop . "&amp;Opt_Room=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Room']/*房型展示*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;	
				case "edittabpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_room.php?wshop=" . $wshop . "&amp;Opt_Room=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Room']/*房型展示*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "photoviewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_room.php?wshop=" . $wshop . "&amp;Opt_Room=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Room']/*房型展示*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>主題內頁</strong></font>";			
					break;
				case "photoaddpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_room.php?wshop=" . $wshop . "&amp;Opt_Room=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Room']/*房型展示*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_room.php?wshop=" . $wshop . "&amp;Opt_Room=photoviewpage&amp;lang=" . $_SESSION['lang'] . "&aid=" . $_GET['aid']. "\">主題內頁 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";			
					break;
				case "photoeditpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_room.php?wshop=" . $wshop . "&amp;Opt_Room=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Room']/*房型展示*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_room.php?wshop=" . $wshop . "&amp;Opt_Room=photoviewpage&amp;lang=" . $_SESSION['lang'] . "&aid=" . $_GET['aid']. "\">主題內頁 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";			
					break;
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_room.php?wshop=" . $wshop . "&amp;Opt_Room=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Room']/*房型展示*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_room.php?wshop=" . $wshop . "&amp;Opt_Room=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Room']/*房型展示*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_room.php?wshop=" . $wshop . "&amp;Opt_Room=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				case "mulilistitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_room.php?wshop=" . $wshop . "&amp;Opt_Room=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Room']/*房型展示*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_room.php?wshop=" . $wshop . "&amp;Opt_Room=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理(L0)</strong></font>";	
					break;
				case "sub_mulilistitempage":
				if($_GET['level'] == '1'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_room.php?wshop=" . $wshop . "&amp;Opt_Room=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Room']/*房型展示*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_room.php?wshop=" . $wshop . "&amp;Opt_Room=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_room.php?wshop=" . $wshop . "&amp;Opt_Room=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L1)</strong></font>";	
					}
				if($_GET['level'] == '2'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_room.php?wshop=" . $wshop . "&amp;Opt_Room=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Room']/*房型展示*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_room.php?wshop=" . $wshop . "&amp;Opt_Room=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_room.php?wshop=" . $wshop . "&amp;Opt_Room=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_room.php?wshop=" . $wshop . "&amp;Opt_Room=sub_mulilistitempage&amp;list_id=" . $_GET['list_id']  . "&amp;level=1" . "&amp;item_id=" . $_GET['subitem_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L2)</strong></font>";	
					}
				/*if($_GET['level'] == '3'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_room.php?wshop=" . $wshop . "&amp;Opt_Room=viewpage&amp;lang=" . $_SESSION['lang'] . "\">房型展示 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt_Room=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L2) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L3)</strong></font>";	
					}*/
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Reserve'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Room']/*房型展示*/ . "</strong></font>";			
					break;
				case "viewpage_sub":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Room']/*房型展示*/ . "</strong></font>";			
					break;
				case "searchpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_reserve.php?wshop=" . $wshop . "&amp;Opt_Reserve=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Room']/*房型展示*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>搜索</strong></font>";			
					break;
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_reserve.php?wshop=" . $wshop . "&amp;Opt_Reserve=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Room']/*房型展示*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_reserve.php?wshop=" . $wshop . "&amp;Opt_Reserve=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Room']/*房型展示*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_reserve.php?wshop=" . $wshop . "&amp;Opt_Reserve=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				case "mulilistitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_reserve.php?wshop=" . $wshop . "&amp;Opt_Reserve=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Room']/*房型展示*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_reserve.php?wshop=" . $wshop . "&amp;Opt_Reserve=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理(L0)</strong></font>";	
					break;
				case "gen":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_reserve.php?wshop=" . $wshop . "&amp;Opt_Reserve=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Room']/*房型展示*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>訂房設定</strong></font>";	
					break;
				case "gen_st":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_reserve.php?wshop=" . $wshop . "&amp;Opt_Reserve=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Room']/*房型展示*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>訂房啟用設定</strong></font>";	
					break;
				case "sv":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_reserve.php?wshop=" . $wshop . "&amp;Opt_Reserve=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Room']/*房型展示*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>訂房保留</strong></font>";	
					break;
				case "state":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_reserve.php?wshop=" . $wshop . "&amp;Opt_Reserve=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Room']/*房型展示*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>訂房狀況</strong></font>";	
					break;
				case "order":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_reserve.php?wshop=" . $wshop . "&amp;Opt_Reserve=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Room']/*房型展示*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>訂單查詢</strong></font>";	
					break;
				case "odpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_reserve.php?wshop=" . $wshop . "&amp;Opt_Reserve=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Room']/*房型展示*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>補充說明</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Forum'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Forum']/*討論專區*/ . "</strong></font>";			
					break;
				case "viewpage_sub":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Forum']/*討論專區*/ . "</strong></font>";			
					break;
				case "searchpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>主題搜索</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;	
				case "edittabpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "postpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>回覆一覽</strong></font>";	
					break;
				case "postaddpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">回覆一覽 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "posteditpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">回覆一覽 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;
				case "replypage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">回覆一覽 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>回應一覽</strong></font>";	
					break;
				case "replyaddpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">回覆一覽 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=replypage&amp;lang=" . $_SESSION['lang'] . "&amp;post_id=" . $_GET['post_id'] . "&amp;pd_id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">回應一覽 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
					break;
				case "replyeditpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=postpage&amp;lang=" . $_SESSION['lang'] . "&amp;id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">回覆一覽 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=replypage&amp;lang=" . $_SESSION['lang'] . "&amp;post_id=" . $_GET['post_id'] . "&amp;pd_id=" . $_GET['pd_id'] . "&amp;pdname=" . $_GET['pdname'] . "\">回應一覽 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				case "mulilistitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理(L0)</strong></font>";	
					break;
				case "sub_mulilistitempage":
				if($_GET['level'] == '1'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L1)</strong></font>";	
					}
				if($_GET['level'] == '2'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Forum']/*討論專區*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=sub_mulilistitempage&amp;list_id=" . $_GET['list_id']  . "&amp;level=1" . "&amp;item_id=" . $_GET['subitem_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L2)</strong></font>";	
					}
				/*if($_GET['level'] == '3'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt_Forum=viewpage&amp;lang=" . $_SESSION['lang'] . "\">討論專區 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_forum.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_product.php?wshop=" . $wshop . "&amp;Opt=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;item_id" . $_GET['item_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L2) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L3)</strong></font>";	
					}*/
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Publish'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Publish']/*公佈資訊*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_publish.php?wshop=" . $wshop . "&amp;Opt_Publish=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Publish']/*公佈資訊*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_publish.php?wshop=" . $wshop . "&amp;Opt_Publish=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Publish']/*公佈資訊*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_publish.php?wshop=" . $wshop . "&amp;Opt_Publish=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Publish']/*公佈資訊*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_publish.php?wshop=" . $wshop . "&amp;Opt_Publish=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Publish']/*公佈資訊*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_publish.php?wshop=" . $wshop . "&amp;Opt_Publish=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Sponsor']/*贊助企業*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_sponsor.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Sponsor']/*贊助企業*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_sponsor.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Sponsor']/*贊助企業*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_sponsor.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Sponsor']/*贊助企業*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_sponsor.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Sponsor']/*贊助企業*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_sponsor.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Stronghold'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Stronghold']/*經營據點*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_stronghold.php?wshop=" . $wshop . "&amp;Opt_Stronghold=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Stronghold']/*經營據點*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "settingpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_stronghold.php?wshop=" . $wshop . "&amp;Opt_Stronghold=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Stronghold']/*經營據點*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>參數設定</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_stronghold.php?wshop=" . $wshop . "&amp;Opt_Stronghold=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Stronghold']/*經營據點*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_stronghold.php?wshop=" . $wshop . "&amp;Opt_Stronghold=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Stronghold']/*經營據點*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_stronghold.php?wshop=" . $wshop . "&amp;Opt_Stronghold=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Stronghold']/*經營據點*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_stronghold.php?wshop=" . $wshop . "&amp;Opt_Stronghold=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Attractions'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Attractions']/*鄰近景點*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_attractions.php?wshop=" . $wshop . "&amp;Opt_Attractions=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Attractions']/*鄰近景點*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "settingpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_attractions.php?wshop=" . $wshop . "&amp;Opt_Attractions=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Attractions']/*鄰近景點*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>參數設定</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_attractions.php?wshop=" . $wshop . "&amp;Opt_Attractions=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Attractions']/*鄰近景點*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_attractions.php?wshop=" . $wshop . "&amp;Opt_Attractions=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Attractions']/*鄰近景點*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_attractions.php?wshop=" . $wshop . "&amp;Opt_Attractions=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Attractions']/*鄰近景點*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_attractions.php?wshop=" . $wshop . "&amp;Opt_Attractions=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Travel'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". "旅遊景點" . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_travel.php?wshop=" . $wshop . "&amp;Opt_Travel=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". "旅遊景點" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "settingpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_travel.php?wshop=" . $wshop . "&amp;Opt_Travel=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". "旅遊景點" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>參數設定</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_travel.php?wshop=" . $wshop . "&amp;Opt_Travel=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". "旅遊景點" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_travel.php?wshop=" . $wshop . "&amp;Opt_Travel=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". "旅遊景點" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_travel.php?wshop=" . $wshop . "&amp;Opt_Travel=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". "旅遊景點" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_travel.php?wshop=" . $wshop . "&amp;Opt_Travel=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Artlist'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Artlist']/*藝文專欄*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_artlist.php?wshop=" . $wshop . "&amp;Opt_Artlist=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Artlist']/*藝文專欄*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_artlist.php?wshop=" . $wshop . "&amp;Opt_Artlist=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Artlist']/*藝文專欄*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_artlist.php?wshop=" . $wshop . "&amp;Opt_Artlist=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Artlist']/*藝文專欄*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_artlist.php?wshop=" . $wshop . "&amp;Opt_Artlist=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Artlist']/*藝文專欄*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_artlist.php?wshop=" . $wshop . "&amp;Opt_Artlist=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Partner']/*合作夥伴*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_partner.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Partner']/*合作夥伴*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_partner.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Partner']/*合作夥伴*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_partner.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Partner']/*合作夥伴*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_partner.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Partner']/*合作夥伴*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_partner.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Video'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Video']/*影音共享*/ . "</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_video.php?wshop=" . $wshop . "&amp;Opt_Video=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Video']/*影音共享*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_video.php?wshop=" . $wshop . "&amp;Opt_Video=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Video']/*影音共享*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_video.php?wshop=" . $wshop . "&amp;Opt_Video=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Video']/*影音共享*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_video.php?wshop=" . $wshop . "&amp;Opt_Video=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Video']/*影音共享*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_video.php?wshop=" . $wshop . "&amp;Opt_Video=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". "Logo"/*影音共享*/ . "</strong></font>";			
					break;
				case "step_map":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_logo.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". "Logo"/*影音共享*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>步驟地圖</strong></font>";				
					break;
				case "logoaddpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_logo.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". "Logo"/*影音共享*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "logoeditpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_logo.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". "Logo"/*影音共享*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;			
				default:	
					break;
			}
			
			switch($_GET['Opt_Knowledge'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Knowledge']/*知識學習*/ . "</strong></font>";			
					break;
				case "viewpage_sub":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Knowledge']/*知識學習*/ . "</strong></font>";			
					break;
				case "searchpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Knowledge']/*知識學習*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>知識學習搜索</strong></font>";			
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Knowledge']/*知識學習*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Knowledge']/*知識學習*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>編輯</strong></font>";	
					break;	
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Knowledge']/*知識學習*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Knowledge']/*知識學習*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				case "mulilistitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Knowledge']/*知識學習*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理(L0)</strong></font>";	
					break;
				case "sub_mulilistitempage":
				if($_GET['level'] == '1'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Knowledge']/*知識學習*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L1)</strong></font>";	
					}
				if($_GET['level'] == '2'){
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Knowledge']/*知識學習*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=mulilistitempage&amp;list_id=" . $_GET['list_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L0) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_knowledge.php?wshop=" . $wshop . "&amp;Opt_Knowledge=sub_mulilistitempage&amp;list_id=" . $_GET['list_id']  . "&amp;level=1" . "&amp;item_id=" . $_GET['subitem_id'] . "&amp;lang=" . $_SESSION['lang'] . "\">項目管理(L1) </a>" . " <i class=\"fa fa-angle-double-right\"></i> " .  "<font color=\"#045178\"><strong>項目管理(L2)</strong></font>";	
					}
				
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_SystemConfig'])
			{
				case "settingpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>後台系統</strong></font>";			
					break;
				case "settingpage_fr":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>前台系統</strong></font>";	
					break;
				case "settingpage_otr":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>其他設定</strong></font>";	
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "settingpage_ky":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>關鍵字設定</strong></font>";			
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Navimenu'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>選單維護</strong></font>";				
					break;
				case "addpage_L1":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_navimenu.php?wshop=" . $wshop . "&amp;Opt_Navimenu=viewpage&amp;lang=" . $_SESSION['lang'] . "\">選單維護 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增一級選單</strong></font>";
					break;
			    case "addpage_L2":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_navimenu.php?wshop=" . $wshop . "&amp;Opt_Navimenu=viewpage&amp;lang=" . $_SESSION['lang'] . "\">選單維護 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增二級選單</strong></font>";
					break;
				case "addpage_L3":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_navimenu.php?wshop=" . $wshop . "&amp;Opt_Navimenu=viewpage&amp;lang=" . $_SESSION['lang'] . "\">選單維護 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增三級選單</strong></font>";
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Play'])
			{
				case "memory":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#cccccc\"><strong>地域の秘密</strong></font>" . "<font color=\"#cccccc\"><strong> <i class=\"fa fa-angle-double-right\"></i> フロップ x メモリ</strong></font>";			
					break;
				default:	
					break;
			}
			
			switch($_GET['Opt_Picasa'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". $ModuleName['Picasa']/*雲端相簿*/ . "</strong></font>";			
					break;
				case "detailed":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_picasa.php?wshop=" . $wshop . "&amp;Opt_Picasa=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Picasa']/*雲端相簿*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . $_GET['album'] . "</strong></font>";	
					break;
				case "install":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_picasa.php?wshop=" . $wshop . "&amp;Opt_Picasa=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". $ModuleName['Picasa']/*雲端相簿*/ . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>安裝</strong></font>";	
					break;
				default:
					//$ViewLIne_Type = "". $ModuleName['Picasa']/*雲端相簿*/ . "";	
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "樣板" . "</strong></font>";					
					break;
				case "tmp_step_map":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "步驟地圖" . "</strong></font>";				
					break;
				case "tmp_column_step_map":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_tmp.php?wshop=" . $wshop . "&amp;Opt=tmpcolumn_setting&amp;lang=" . $_SESSION['lang'] . "\">" . "自訂欄位" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>步驟地圖</strong></font>";				
					break;
				case "addpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_tmp.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">" . "樣板" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";	
					break;
				case "editpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_tmp.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">" . "樣板" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>修改</strong></font>";	
					break;
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_tmp.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">" . "樣板" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>清單列表</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_tmp.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">" . "樣板" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_tmp.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				case "tmpbk":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "區塊背景" . "</strong></font>";	
					break;
				case "tmpaddbk":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_tmp.php?wshop=" . $wshop . "&amp;Opt=tmpbk&amp;lang=" . $_SESSION['lang'] . "\">" . "區塊背景" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";
					break;
				case "tmpeditbk":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_tmp.php?wshop=" . $wshop . "&amp;Opt=tmpbk&amp;lang=" . $_SESSION['lang'] . "\">" . "區塊背景" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>修改</strong></font>";
					break;
				case "logoviewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "Logo" . "</strong></font>";	
					break;
				case "logoaddpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_tmp.php?wshop=" . $wshop . "&amp;Opt=logoviewpage&amp;lang=" . $_SESSION['lang'] . "\">" . "Logo" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";
					break;
				case "logoeditpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_tmp.php?wshop=" . $wshop . "&amp;Opt=logoviewpage&amp;lang=" . $_SESSION['lang'] . "\">" . "Logo" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>修改</strong></font>";
					break;
				case "tmpboard":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "區塊外框" . "</strong></font>";	
					break;
				case "tmpaddboard":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_tmp.php?wshop=" . $wshop . "&amp;Opt=tmpboard&amp;lang=" . $_SESSION['lang'] . "\">" . "區塊外框" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";
					break;
				case "tmpeditboard":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_tmp.php?wshop=" . $wshop . "&amp;Opt=tmpboard&amp;lang=" . $_SESSION['lang'] . "\">" . "區塊外框" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>修改</strong></font>";
					break;
				case "tmpmainmenu":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "主選單" . "</strong></font>";
					break;
				case "tmpaddmainmenu":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_tmp.php?wshop=" . $wshop . "&amp;Opt=tmpmainmenu&amp;lang=" . $_SESSION['lang'] . "\">" . "主選單" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";
					break;
				case "tmpeditmainmenu":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_tmp.php?wshop=" . $wshop . "&amp;Opt=tmpmainmenu&amp;lang=" . $_SESSION['lang'] . "\">" . "主選單" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>修改</strong></font>";
					break;
				case "tmpleftmenu":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "側邊選單" . "</strong></font>";
					break;
				case "tmpaddleftmenu":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_tmp.php?wshop=" . $wshop . "&amp;Opt=tmpleftmenu&amp;lang=" . $_SESSION['lang'] . "\">" . "側邊選單" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";
					break;
				case "tmpeditleftmenu":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_tmp.php?wshop=" . $wshop . "&amp;Opt=tmpleftmenu&amp;lang=" . $_SESSION['lang'] . "\">" . "側邊選單" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>修改</strong></font>";
					break;
				case "tmpblock":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "側邊裝飾外框" . "</strong></font>";
					break;
				case "tmpaddblock":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_tmp.php?wshop=" . $wshop . "&amp;Opt=tmpblock&amp;lang=" . $_SESSION['lang'] . "\">" . "側邊裝飾外框" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>新增</strong></font>";
					break;
				case "tmpeditblock":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_tmp.php?wshop=" . $wshop . "&amp;Opt=tmpblock&amp;lang=" . $_SESSION['lang'] . "\">" . "側邊裝飾外框" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>修改</strong></font>";
					break;
				case "tmpcolumn":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "自訂欄位" . "</strong></font>";
					break;
				case "tmpcolumn_plus":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "自訂欄位(+)" . "</strong></font>";
					break;
				case "tmpcolumn_setting":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_tmp.php?wshop=" . $wshop . "&amp;Opt=tmpcolumn_setting&amp;lang=" . $_SESSION['lang'] . "\">" . "自訂欄位" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>修改</strong></font>";
					break;
				case "tmpcolumn_setting_free":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_tmp.php?wshop=" . $wshop . "&amp;Opt=tmpcolumn&amp;lang=" . $_SESSION['lang'] . "\">" . "自訂欄位" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>修改</strong></font>";
					break;
				case "tmpcolumn_setting_menu":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_tmp.php?wshop=" . $wshop . "&amp;Opt=tmpcolumn&amp;lang=" . $_SESSION['lang'] . "\">" . "自訂欄位" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>修改</strong></font>";
					break;
				case "tmpblogcolumn":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "自訂欄位" . "</strong></font>";
					break;
				case "tmpblogcolumn_setting":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_tmp.php?wshop=" . $wshop . "&amp;Opt=tmpblogcolumn&amp;lang=" . $_SESSION['lang'] . "\">" . "自訂欄位" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>修改</strong></font>";
					break;
				case "tmpblogcolumn_setting_free":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_tmp.php?wshop=" . $wshop . "&amp;Opt=tmpblogcolumn&amp;lang=" . $_SESSION['lang'] . "\">" . "自訂欄位" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>修改</strong></font>";
					break;
				case "tmpblogcolumn_setting_menu":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_tmp.php?wshop=" . $wshop . "&amp;Opt=tmpblogcolumn&amp;lang=" . $_SESSION['lang'] . "\">" . "自訂欄位" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>修改</strong></font>";
					break;
				case "tmp_mobile_config":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "行動裝置參數" . "</strong></font>";	
					break;
				default:
					
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "購物車" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "檢視訂單" . "</strong></font>";	
					break;
				case "odpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "購物車" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "補充說明" . "</strong></font>";	
					break;
				case "paytip":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "購物車" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "匯款通知" . "</strong></font>";	
					break;
				case "listpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "購物車" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "次分類設定" . "</strong></font>";	
					break;
			    case "nvitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_cart.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". "購物車" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_cart.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				case "listitempage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_cart.php?wshop=" . $wshop . "&amp;Opt=viewpage&amp;lang=" . $_SESSION['lang'] . "\">". "購物車" . " </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<a href=\"manage_cart.php?wshop=" . $wshop . "&amp;Opt=listpage&amp;lang=" . $_SESSION['lang'] . "\">清單列表 </a>" . " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>項目管理</strong></font>";	
					break;
				case "setpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "購物車" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "功能設定" . "</strong></font>";	
					break;
				default:
					
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "tmp_mobile_config":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "版型修改" . "</strong></font>". " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>" . "行動裝置參數" . "</strong></font>";	
					break;
				default:
					
					break;
			}
			
			switch($_GET['Opt_Tutorials'])
			{
				default:	
				    //$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". "操作說明"/*雲端相簿*/ . "</strong></font>";	
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". "模組狀態"/*雲端相簿*/ . "</strong></font>";			
					break;
				case "statepage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". "網站狀態"/*雲端相簿*/ . "</strong></font>";			
					break;
				case "settingpage_user":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>個人資料</strong></font>";		
				default:		
					break;
			}
			
			switch($_GET['Opt_Magic'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". "魔法特效"/*魔法特效*/ . "</strong></font>";			
					break;
				default:		
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". "Google Analytics (分析)"/*魔法特效*/ . "</strong></font>";			
					break;
				default:		
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". "網站提交"/*網站提交*/ . "</strong></font>";			
					break;
				default:		
					break;
			}
			
			switch($_GET['Opt'])
			{
				case "viewpage":
					$ViewLIne_Type = " <i class=\"fa fa-angle-double-right\"></i> " . "<font color=\"#045178\"><strong>". "隱私權政策"/*網站提交*/ . "</strong></font>";			
					break;
				default:		
					break;
			}
		?>
        
<div style="float:right;">
<?php if ($_GET['Opt_Play'] == '') { ?><a href="index.php?lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-home"></i></a> 
<?php } else { ?><a href="../index.php?lang=<?php echo $_SESSION['lang']; ?>"><i class="fa fa-home"></i></a><?php } ?>
<?php echo $ViewLIne_Type; ?> 
</div>
<?php 
mysqli_free_result($RecordTpt);
?>

