<?php require_once('../../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
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

$code[] = '';

if($_GET['type1'] != ''){
	$colname_RecordCommodityListType = "zh-tw";
	if (isset($_GET['lang'])) {
	  $colname_RecordCommodityListType = $_GET['lang'];
	}
	$coluserid_RecordCommodityListType = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordCommodityListType = $w_userid;
	}
	$colitem_id_RecordCommodityListType = "-1";
	if (isset($_GET['type1'])) {
	  $colitem_id_RecordCommodityListType = $_GET['type1'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordCommodityListType = sprintf("SELECT * FROM invoicing_commodityitem WHERE list_id = 1 && lang=%s && level='0' && userid=%s && item_id=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($colname_RecordCommodityListType, "text"),GetSQLValueString($coluserid_RecordCommodityListType, "int"),GetSQLValueString($colitem_id_RecordCommodityListType, "int"));
	$RecordCommodityListType = mysqli_query($DB_Conn, $query_RecordCommodityListType) or die(mysqli_error($DB_Conn));
	$row_RecordCommodityListType = mysqli_fetch_assoc($RecordCommodityListType);
	$totalRows_RecordCommodityListType = mysqli_num_rows($RecordCommodityListType);
	
	$code['type'] .= $row_RecordCommodityListType['itemvalue'];
	
}

if($_GET['type2'] != ''){
	$colname_RecordCommodityListType = "zh-tw";
	if (isset($_GET['lang'])) {
	  $colname_RecordCommodityListType = $_GET['lang'];
	}
	$coluserid_RecordCommodityListType = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordCommodityListType = $w_userid;
	}
	$colitem_id_RecordCommodityListType = "-1";
	if (isset($_GET['type2'])) {
	  $colitem_id_RecordCommodityListType = $_GET['type2'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordCommodityListType = sprintf("SELECT * FROM invoicing_commodityitem WHERE list_id = 1 && lang=%s && level='1' && userid=%s && item_id=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($colname_RecordCommodityListType, "text"),GetSQLValueString($coluserid_RecordCommodityListType, "int"),GetSQLValueString($colitem_id_RecordCommodityListType, "int"));
	$RecordCommodityListType = mysqli_query($DB_Conn, $query_RecordCommodityListType) or die(mysqli_error($DB_Conn));
	$row_RecordCommodityListType = mysqli_fetch_assoc($RecordCommodityListType);
	$totalRows_RecordCommodityListType = mysqli_num_rows($RecordCommodityListType);

	$code['type'] .= $row_RecordCommodityListType['itemvalue'];
}

if($_GET['type3'] != ''){
	$colname_RecordCommodityListType = "zh-tw";
	if (isset($_GET['lang'])) {
	  $colname_RecordCommodityListType = $_GET['lang'];
	}
	$coluserid_RecordCommodityListType = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordCommodityListType = $w_userid;
	}
	$colitem_id_RecordCommodityListType = "-1";
	if (isset($_GET['type3'])) {
	  $colitem_id_RecordCommodityListType = $_GET['type3'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordCommodityListType = sprintf("SELECT * FROM invoicing_commodityitem WHERE list_id = 1 && lang=%s && level='2' && userid=%s && item_id=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($colname_RecordCommodityListType, "text"),GetSQLValueString($coluserid_RecordCommodityListType, "int"),GetSQLValueString($colitem_id_RecordCommodityListType, "int"));
	$RecordCommodityListType = mysqli_query($DB_Conn, $query_RecordCommodityListType) or die(mysqli_error($DB_Conn));
	$row_RecordCommodityListType = mysqli_fetch_assoc($RecordCommodityListType);
	$totalRows_RecordCommodityListType = mysqli_num_rows($RecordCommodityListType);

	$code['type'] .= $row_RecordCommodityListType['itemvalue'];
}

if($_GET['unit'] != ''){
	$colname_RecordCommodityListUnit = "zh-tw";
	if (isset($_GET['lang'])) {
	  $colname_RecordCommodityListUnit = $_GET['lang'];
	}
	$coluserid_RecordCommodityListUnit = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordCommodityListUnit = $w_userid;
	}
	$colunit_RecordCommodityListUnit = "-1";
	if (isset($_GET['unit'])) {
	  $colunit_RecordCommodityListUnit = $_GET['unit'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordCommodityListUnit = sprintf("SELECT * FROM invoicing_commodityitem WHERE list_id = 2 && lang=%s && userid=%s && item_id=%s", GetSQLValueString($colname_RecordCommodityListUnit, "text"),GetSQLValueString($coluserid_RecordCommodityListUnit, "int"),GetSQLValueString($colunit_RecordCommodityListUnit, "int"));
	$RecordCommodityListUnit = mysqli_query($DB_Conn, $query_RecordCommodityListUnit) or die(mysqli_error($DB_Conn));
	$row_RecordCommodityListUnit = mysqli_fetch_assoc($RecordCommodityListUnit);
	$totalRows_RecordCommodityListUnit = mysqli_num_rows($RecordCommodityListUnit);
	
	$code['unit'] = $row_RecordCommodityListUnit['itemvalue'];
}

if($_GET['sourcegenre'] != ''){
	$colname_RecordCommodityListSourcegenre = "zh-tw";
	if (isset($_GET['lang'])) {
	  $colname_RecordCommodityListSourcegenre = $_GET['lang'];
	}
	$coluserid_RecordCommodityListSourcegenre = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordCommodityListSourcegenre = $w_userid;
	}
	$colsourcegenre_RecordCommodityListSourcegenre = "-1";
	if (isset($_GET['sourcegenre'])) {
	  $colsourcegenre_RecordCommodityListSourcegenre = $_GET['sourcegenre'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordCommodityListSourcegenre = sprintf("SELECT * FROM invoicing_commodityitem WHERE list_id = 3 && lang=%s && userid=%s && item_id=%s", GetSQLValueString($colname_RecordCommodityListSourcegenre, "text"),GetSQLValueString($coluserid_RecordCommodityListSourcegenre, "int"),GetSQLValueString($colsourcegenre_RecordCommodityListSourcegenre, "int"));
	$RecordCommodityListSourcegenre = mysqli_query($DB_Conn, $query_RecordCommodityListSourcegenre) or die(mysqli_error($DB_Conn));
	$row_RecordCommodityListSourcegenre = mysqli_fetch_assoc($RecordCommodityListSourcegenre);
	$totalRows_RecordCommodityListSourcegenre = mysqli_num_rows($RecordCommodityListSourcegenre);
	
	$code['sourcegenre'] = $row_RecordCommodityListSourcegenre['itemvalue'];
}

if($_GET['genre'] != ''){
	$colname_RecordCommodityListGenre = "zh-tw";
	if (isset($_GET['lang'])) {
	  $colname_RecordCommodityListGenre = $_GET['lang'];
	}
	$coluserid_RecordCommodityListGenre = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordCommodityListGenre = $w_userid;
	}
	$colgenre_RecordCommodityListGenre = "-1";
	if (isset($_GET['genre'])) {
	  $colgenre_RecordCommodityListGenre = $_GET['genre'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordCommodityListGenre = sprintf("SELECT * FROM invoicing_commodityitem WHERE list_id = 4 && lang=%s && userid=%s && item_id=%s", GetSQLValueString($colname_RecordCommodityListGenre, "text"),GetSQLValueString($coluserid_RecordCommodityListGenre, "int"),GetSQLValueString($colgenre_RecordCommodityListGenre, "int"));
	$RecordCommodityListGenre = mysqli_query($DB_Conn, $query_RecordCommodityListGenre) or die(mysqli_error($DB_Conn));
	$row_RecordCommodityListGenre = mysqli_fetch_assoc($RecordCommodityListGenre);
	$totalRows_RecordCommodityListGenre = mysqli_num_rows($RecordCommodityListGenre);
	
	$code['genre'] = $row_RecordCommodityListGenre['itemvalue'];
}

if($_GET['supplier'] != ''){
	$coluserid_RecordSupplier = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordSupplier = $w_userid;
	}
	$colsupplier_RecordSupplier = "-1";
	if (isset($_GET['supplier'])) {
	  $colsupplier_RecordSupplier = $_GET['supplier'];
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordSupplier = sprintf("SELECT * FROM invoicing_supplier WHERE userid=%s && id=%s ORDER BY code",GetSQLValueString($coluserid_RecordSupplier, "int"),GetSQLValueString($colsupplier_RecordSupplier, "text"));
	$RecordSupplier = mysqli_query($DB_Conn, $query_RecordSupplier) or die(mysqli_error($DB_Conn));
	$row_RecordSupplier = mysqli_fetch_assoc($RecordSupplier);
	$totalRows_RecordSupplier = mysqli_num_rows($RecordSupplier);
	
	$code['supplier'] = $row_RecordSupplier['code'];
}

$separator = '';
if(isset($_GET['separator']) && $_GET['separator'] == '1'){ $separator = '-'; }

$code_end = $code['type'];

if($code['supplier'] != "") { $code_end .= $separator . $code['supplier']; } 


$coluserid_RecordCommodityCheck = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCommodityCheck = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCommodityCheck = sprintf("SELECT * FROM invoicing_commodity WHERE userid=%s ORDER BY id DESC LIMIT 1",GetSQLValueString($coluserid_RecordCommodityCheck, "int"));
$RecordCommodityCheck = mysqli_query($DB_Conn, $query_RecordCommodityCheck) or die(mysqli_error($DB_Conn));
$row_RecordCommodityCheck = mysqli_fetch_assoc($RecordCommodityCheck);
$totalRows_RecordCommodityCheck = mysqli_num_rows($RecordCommodityCheck);

echo $code_end . $separator . str_pad($row_RecordCommodityCheck['id']+1,4,"0",STR_PAD_LEFT);



mysqli_free_result($RecordCommodityListType);

mysqli_free_result($RecordCommodityListUnit);

mysqli_free_result($RecordCommodityListSourcegenre);

mysqli_free_result($RecordCommodityListGenre);

mysqli_free_result($RecordCommodityListCurrency);

mysqli_free_result($RecordSupplier);
?>
