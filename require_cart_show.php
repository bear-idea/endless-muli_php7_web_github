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

/* 取得會員資料 */
require_once('require_member_get.php');	

// 24小時刪除資料 - 未註冊購物車
mysqli_query($DB_Conn, "DELETE FROM demo_cart WHERE memberid IS NULL && postdate<SUBTIME(NOW(),'0 24:0:0')"); // 24小時刪除資料
// 24小時刪除資料 - 未註冊購物車

// 刪除資料
if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_cart WHERE id=%s",
                       GetSQLValueString($_GET['id_del'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}

// 修改商品的數量
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Discount")) {
	foreach($_POST['id'] as $key => $val){
		  $updateSQL = sprintf("UPDATE demo_cart SET quantity=%s, notes1=%s WHERE id=%s",
							   GetSQLValueString($_POST['Modify'][$key], "int"),
							   GetSQLValueString($_POST['notes1'][$key], "text"),
							   GetSQLValueString($_POST['id'][$key], "int"));
		
		  //mysqli_select_db($database_DB_Conn, $DB_Conn);
		  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
	}
}

if($totalRows_RecordMember > 0) 
{
	/* 取得購物車清單 有會員 */
	$coluserid_RecordCartlist = "-1";
	if (isset($_SESSION['userid'])) {
	  $coluserid_RecordCartlist = $_SESSION['userid'];
	}
	$colmemberid_RecordCartlist = "-1";
	if (isset($row_RecordMember['id'])) {
	  $colmemberid_RecordCartlist = $row_RecordMember['id'];
	}
	$collang_RecordCartlist = "-1";
	if (isset($_SESSION['lang'])) {
	  $collang_RecordCartlist = $_SESSION['lang'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordCartlist = sprintf("SELECT * FROM demo_cart WHERE userid=%s && memberid=%s && lang=%s ORDER BY id DESC",GetSQLValueString($coluserid_RecordCartlist, "int"),GetSQLValueString($colmemberid_RecordCartlist, "int"),GetSQLValueString($collang_RecordCartlist, "text"));
	$RecordCartlist = mysqli_query($DB_Conn, $query_RecordCartlist) or die(mysqli_error($DB_Conn));
	$row_RecordCartlist = mysqli_fetch_assoc($RecordCartlist);
	$totalRows_RecordCartlist = mysqli_num_rows($RecordCartlist);
}else{
	/* 取得購物車清單 無會員 */
	$coluserid_RecordCartlist = "-1";
	if (isset($_SESSION['userid'])) {
	  $coluserid_RecordCartlist = $_SESSION['userid'];
	}
	$colUserAccessuniqid_RecordCartlist = "-1";
	if (isset($_SESSION['UserAccess'])) {
	  $colUserAccessuniqid_RecordCartlist = $_SESSION['UserAccess'];
	}
	$collang_RecordCartlist = "-1";
	if (isset($_SESSION['lang'])) {
	  $collang_RecordCartlist = $_SESSION['lang'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordCartlist = sprintf("SELECT * FROM demo_cart WHERE userid=%s && UserAccessuniqid=%s && lang=%s ORDER BY id DESC",GetSQLValueString($coluserid_RecordCartlist, "int"),GetSQLValueString($colUserAccessuniqid_RecordCartlist, "text"),GetSQLValueString($collang_RecordCartlist, "text"));
	$RecordCartlist = mysqli_query($DB_Conn, $query_RecordCartlist) or die(mysqli_error($DB_Conn));
	$row_RecordCartlist = mysqli_fetch_assoc($RecordCartlist);
	$totalRows_RecordCartlist = mysqli_num_rows($RecordCartlist);
}
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
	<?php if ($_SESSION['MM_UserGroup_' . $_GET['wshop']] == 'Wshop_Member' || $CartlistRegSelect == 0) {  ?>
    <?php include($TplPath . "/cart_show.php"); ?>
    <?php } else { ?>
    <?php include($TplPath . "/cart_reg.php"); ?>
    <?php }?>
<?php } ?>

<?php
mysqli_free_result($RecordCartlist);
?>