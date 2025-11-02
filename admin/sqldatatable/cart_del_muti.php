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

if ((isset($_POST['id'])) && ($_POST['id'] != "")) {
  // 商品庫存修改 ------------------------------------------------------------------------  
  // 取得詳細訂單資料
  foreach($_POST['id'] as $i => $val){
	  
	  $colname_RecordCartMuli = "-1";
	  if (isset($val)) {
		$colname_RecordCartMuli = $val;
	  }
	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $query_RecordCartMuli = sprintf("SELECT * FROM demo_cartorders WHERE oid = %s", GetSQLValueString($colname_RecordCartMuli, "text"));
	  $RecordCartMuli = mysqli_query($DB_Conn, $query_RecordCartMuli) or die(mysqli_error($DB_Conn));
	  $row_RecordCartMuli = mysqli_fetch_assoc($RecordCartMuli);
	  $totalRows_RecordCartMuli = mysqli_num_rows($RecordCartMuli);
	  
	  if ($row_RecordSystemConfigOtr['inventorycorrection'] == "1") {
  
		  $colname_RecordCartMuliDetailed = "-1";
		  if (isset($row_RecordCartMuli["oserial"])) {
			$colname_RecordCartMuliDetailed = $row_RecordCartMuli["oserial"];
		  }
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $query_RecordCartMuliDetailed = sprintf("SELECT * FROM demo_cartdetail WHERE dcserial = %s", GetSQLValueString($colname_RecordCartMuliDetailed, "text"));
		  $RecordCartMuliDetailed = mysqli_query($DB_Conn, $query_RecordCartMuliDetailed) or die(mysqli_error($DB_Conn));
		  $row_RecordCartMuliDetailed = mysqli_fetch_assoc($RecordCartMuliDetailed);
		  $totalRows_RecordCartMuliDetailed = mysqli_num_rows($RecordCartMuliDetailed);
		  
		  $tipsn = "刪除訂單【" . $val . "】<br/>";
		  
		  do 
		  {
		  // 取得商品資料
		  $colname_RecordProductMuliGet = "-1";
		  if (isset($row_RecordCartMuliDetailed['pid'])) {
			$colname_RecordProductMuliGet = $row_RecordCartMuliDetailed['pid'];
		  }
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $query_RecordProductMuliGet = sprintf("SELECT * FROM demo_product WHERE id = %s", GetSQLValueString($colname_RecordProductMuliGet, "int"));
		  $RecordProductMuliGet = mysqli_query($DB_Conn, $query_RecordProductMuliGet) or die(mysqli_error($DB_Conn));
		  $row_RecordProductMuliGet = mysqli_fetch_assoc($RecordProductMuliGet);
		  $totalRows_RecordProductMuliGet = mysqli_num_rows($RecordProductMuliGet);
		
		  // 當有開啟自動停賣功能
		  if($row_RecordProductMuliGet['inventorynotsale'] == '1' && $row_RecordProductMuliGet['inventory'] != '')
		  {
			  // 更新庫存量
			  $inventory = $row_RecordProductMuliGet['inventory'] + $row_RecordCartMuliDetailed['dcquantiry'];
			  $updateSQL = sprintf("UPDATE demo_product SET inventory=%s WHERE id=%s",
						 GetSQLValueString($inventory, "text"),
						 GetSQLValueString($row_RecordCartMuliDetailed['pid'], "int"));
			  
			  //mysqli_select_db($database_DB_Conn, $DB_Conn);
			  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));	
			  
			  $tipdesc .= $row_RecordProductMuliGet['name'] . "已由庫存【" . $row_RecordProductMuliGet['inventory'] . "】更改為庫存【" . $inventory ."】<br/>";
			  
		  }
		  } while ($row_RecordCartMuliDetailed = mysqli_fetch_assoc($RecordCartMuliDetailed));
		
		  $tipshow.= $tipsn . $tipdesc;
		  $tipdesc = "";
	  
	  }
	  
	  do
	  {
		  $deleteSQL = sprintf("DELETE FROM demo_cartdetail WHERE dcserial=%s",
                       GetSQLValueString($row_RecordCartMuli["oserial"], "text"));

		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
		  
	  } while ($row_RecordCartMuli = mysqli_fetch_assoc($RecordCartMuli));
	  
	  //if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "")) {
		  $deleteSQL2 = sprintf("DELETE FROM demo_cartorders WHERE oid=%s",
							   GetSQLValueString($val, "text"));
		
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $Result2 = mysqli_query($DB_Conn, $deleteSQL2) or die(mysqli_error($DB_Conn));
	  //} 
	  //}
  }
  
  // 商品庫存修改 ------------------------------------------------------------------------
}
/*if ((isset($_POST['id'])) && ($_POST['id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_cartorders WHERE oserial in (%s)", implode(",", $_POST['id']));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
if ((isset($_POST['id'])) && ($_POST['id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_cartdetail WHERE dcserial in (%s)", implode(",", $_POST['id']));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));  
}*/

mysqli_free_result($RecordSystemConfigOtr);
?>