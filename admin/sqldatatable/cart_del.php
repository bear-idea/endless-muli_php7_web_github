<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once("../../inc/inc_function.php"); ?>
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

$coluserid_RecordSystemConfigOtr = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSystemConfigOtr = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSystemConfigOtr = sprintf("SELECT * FROM demo_setting_otr WHERE userid=%s", GetSQLValueString($coluserid_RecordSystemConfigOtr, "int"));
$RecordSystemConfigOtr = mysqli_query($DB_Conn, $query_RecordSystemConfigOtr) or die(mysqli_error($DB_Conn));
$row_RecordSystemConfigOtr = mysqli_fetch_assoc($RecordSystemConfigOtr);
$totalRows_RecordSystemConfigOtr = mysqli_num_rows($RecordSystemConfigOtr);

// 商品庫存修改 ------------------------------------------------------------------------
if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "") && $row_RecordSystemConfigOtr['inventorycorrection'] == "1") {
	
	  // 取得詳細訂單資料
	  $colname_RecordCartDetailed = "-1";
	  if (isset($_GET['id_del'])) {
		$colname_RecordCartDetailed = $_GET['id_del'];
	  }
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $query_RecordCartDetailed = sprintf("SELECT * FROM demo_cartdetail WHERE dcserial = %s", GetSQLValueString($colname_RecordCartDetailed, "text"));
	  $RecordCartDetailed = mysqli_query($DB_Conn, $query_RecordCartDetailed) or die(mysqli_error($DB_Conn));
	  $row_RecordCartDetailed = mysqli_fetch_assoc($RecordCartDetailed);
	  $totalRows_RecordCartDetailed = mysqli_num_rows($RecordCartDetailed);
	  
	  $tipsn = "刪除訂單【" . $_GET['id_del'] . "】<br/>";
	  
	  do 
	  {
		// 取得商品資料	
		$colname_RecordProductGet = "-1";
		if (isset($row_RecordCartDetailed['pid'])) {
		  $colname_RecordProductGet = $row_RecordCartDetailed['pid'];
		}
		//mysqli_select_db($database_DB_Conn, $DB_Conn);
		$query_RecordProductGet = sprintf("SELECT * FROM demo_product WHERE id = %s", GetSQLValueString($colname_RecordProductGet, "int"));
		$RecordProductGet = mysqli_query($DB_Conn, $query_RecordProductGet) or die(mysqli_error($DB_Conn));
		$row_RecordProductGet = mysqli_fetch_assoc($RecordProductGet);
		$totalRows_RecordProductGet = mysqli_num_rows($RecordProductGet);

		// 當有開啟自動停賣功能
		if($row_RecordProductGet['inventorynotsale'] == '1' && $row_RecordProductGet['inventory'] != '')
		{
			// 更新庫存量
			$inventory = $row_RecordProductGet['inventory'] + $row_RecordCartDetailed['dcquantiry'];
			$updateSQL = sprintf("UPDATE demo_product SET inventory=%s WHERE id=%s",
                       GetSQLValueString($inventory, "text"),
                       GetSQLValueString($row_RecordCartDetailed['pid'], "int"));
			
			//mysqli_select_db($database_DB_Conn, $DB_Conn);
			$Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
			
			$tipdesc .= "【".$row_RecordProductGet['name'] . "】已由庫存【" . $row_RecordProductGet['inventory'] . "】更改為庫存【" . $inventory ."】<br/>";  
			
		}
      } while ($row_RecordCartDetailed = mysqli_fetch_assoc($RecordCartDetailed));
	  
	  $tipshow = $tipsn . $tipdesc;
}
// 商品庫存修改 ------------------------------------------------------------------------

if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_cartorders WHERE oserial=%s",
                       GetSQLValueString($_GET['id_del'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_cartdetail WHERE dcserial=%s",
                       GetSQLValueString($_GET['id_del'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}

mysqli_free_result($RecordSystemConfigOtr);
?>