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

if($TmpSubMainmenuIndicate == "0" && $_GET['Opt'] == 'stypepage') {$Tp_Page = "DfPage"; /* 子選單隱藏 並且 點選的是左選單 */}
	  switch($Tp_Page) // 抓取 inc_title 中的值(取的目前分類)
	  {
		  case "News":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "About":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Coupons":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Timeline":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Imageshow":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Article":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Cart":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Product":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_discount.php";
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Knowledge":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Guestbook":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Activities":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Publish":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Project":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Album":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Video":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Frilink":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Otrlink":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Sponsor":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Partner":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Letters":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Meeting":
			  $tppage = "meeting";
			  break;	
		  case "Donation":
			  $tppage = "donation";
			  break;	
		  case "Artlist":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Org":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Member":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Careers":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Actnews":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Faq":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Catalog":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Forum":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Contact":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Stronghold":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Blog":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Picasa":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Room":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Attractions":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Dealer":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "Privacy":
			  $app_module_column_mega_menu_block = "app/".strtolower($Tp_Page)."/column/block/mega_menu_tp.php";
			  break;	
		  case "DfType":
			  $app_module_column_mega_menu_block = "app/dfpage/column/block/mega_menu_tp.php";
			  break;	
		  case "DfPage":
			  $app_module_column_mega_menu_block = "app/dfpage/column/block/mega_menu_tp.php";
			  break;
		  default:
			  $app_module_column_mega_menu_block = "app/dfpage/column/block/mega_menu_tp.php";
			  break;
	  }

	include($TplPath . "/other/column/block/mega_menu_tp.php"); 

?>