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
/* ------------------------------------------------------------------------------------------ */
if($row_RecordTmpConfig['tmphomeproductshowtype'] == "1") { /* If Start */
/* ------------------------------------------------------------------------------------------ */
	
$collang_RecordProductMultiTypeMenu_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordProductMultiTypeMenu_l1 = $_GET['lang'];
}
$coluserid_RecordProductMultiTypeMenu_l1 = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordProductMultiTypeMenu_l1 = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductMultiTypeMenu_l1 = sprintf("SELECT * FROM demo_productitem WHERE list_id = 1 && lang = %s && level = '0' && indicate = '1' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($collang_RecordProductMultiTypeMenu_l1, "text"),GetSQLValueString($coluserid_RecordProductMultiTypeMenu_l1, "int"));
$RecordProductMultiTypeMenu_l1 = mysqli_query($DB_Conn, $query_RecordProductMultiTypeMenu_l1) or die(mysqli_error($DB_Conn));
$row_RecordProductMultiTypeMenu_l1 = mysqli_fetch_assoc($RecordProductMultiTypeMenu_l1);
$totalRows_RecordProductMultiTypeMenu_l1 = mysqli_num_rows($RecordProductMultiTypeMenu_l1);




if ($totalRows_RecordProductMultiTypeMenu_l1 > 0) {
        
		
		
do { 
/* ------------------------------------------------------------------------------------------ */
/* PD Start */
/* ------------------------------------------------------------------------------------------ */
$_GET['type1'] = $row_RecordProductMultiTypeMenu_l1['item_id'];
if($TmpHomeProductMod == 1) { // 模式判斷
$maxRows_RecordProduct = 12;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordProduct = $page * $maxRows_RecordProduct;

$colname_RecordProduct = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordProduct = $_GET['searchkey'];
}
$coluserid_RecordProduct = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordProduct = $_SESSION['userid'];
}
$coltype1_RecordProduct = "%";
if (isset($_GET['type1'])) {
  $coltype1_RecordProduct = $_GET['type1'];
}
$coltype2_RecordProduct = "%";
if (isset($_GET['type2'])) {
  $coltype2_RecordProduct = $_GET['type2'];
}
$coltype3_RecordProduct = "%";
if (isset($_GET['type3'])) {
  $coltype3_RecordProduct = $_GET['type3'];
}
$colnamelang_RecordProduct = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordProduct = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProduct = sprintf("SELECT * FROM demo_product WHERE ((name LIKE %s) || (pdseries LIKE %s)) && lang = %s && type1 LIKE %s && type2 LIKE %s && type3 LIKE %s && userid=%s && homeshow=1 && indicate=1 ORDER BY rand()", GetSQLValueString("%" . $colname_RecordProduct . "%", "text"),GetSQLValueString("%" . $colname_RecordProduct . "%", "text"),GetSQLValueString($colnamelang_RecordProduct, "text"),GetSQLValueString($coltype1_RecordProduct, "text"),GetSQLValueString($coltype2_RecordProduct, "text"),GetSQLValueString($coltype3_RecordProduct, "text"),GetSQLValueString($coluserid_RecordProduct, "int"));
$query_limit_RecordProduct = sprintf("%s LIMIT %d, %d", $query_RecordProduct, $startRow_RecordProduct, $maxRows_RecordProduct);
$RecordProduct = mysqli_query($DB_Conn, $query_limit_RecordProduct) or die(mysqli_error($DB_Conn));
$row_RecordProduct = mysqli_fetch_assoc($RecordProduct);

if (isset($_GET['totalRows_RecordProduct'])) {
  $totalRows_RecordProduct = $_GET['totalRows_RecordProduct'];
} else {
  $all_RecordProduct = mysqli_query($DB_Conn, $query_RecordProduct);
  $totalRows_RecordProduct = mysqli_num_rows($all_RecordProduct);
}
$totalPages_RecordProduct = ceil($totalRows_RecordProduct/$maxRows_RecordProduct)-1;
}else{ // 模式判斷
$maxRows_RecordProduct = 12;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordProduct = $page * $maxRows_RecordProduct;

$colname_RecordProduct = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordProduct = $_GET['searchkey'];
}
$coluserid_RecordProduct = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordProduct = $_SESSION['userid'];
}
$coltype1_RecordProduct = "%";
if (isset($_GET['type1'])) {
  $coltype1_RecordProduct = $_GET['type1'];
}
$coltype2_RecordProduct = "%";
if (isset($_GET['type2'])) {
  $coltype2_RecordProduct = $_GET['type2'];
}
$coltype3_RecordProduct = "%";
if (isset($_GET['type3'])) {
  $coltype3_RecordProduct = $_GET['type3'];
}
$colnamelang_RecordProduct = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordProduct = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProduct = sprintf("SELECT * FROM demo_product WHERE ((name LIKE %s) || (pdseries LIKE %s)) && lang = %s && type1 LIKE %s && type2 LIKE %s && type3 LIKE %s && userid=%s && indicate=1 ORDER BY rand()", GetSQLValueString("%" . $colname_RecordProduct . "%", "text"),GetSQLValueString("%" . $colname_RecordProduct . "%", "text"),GetSQLValueString($colnamelang_RecordProduct, "text"),GetSQLValueString($coltype1_RecordProduct, "text"),GetSQLValueString($coltype2_RecordProduct, "text"),GetSQLValueString($coltype3_RecordProduct, "text"),GetSQLValueString($coluserid_RecordProduct, "int"));
$query_limit_RecordProduct = sprintf("%s LIMIT %d, %d", $query_RecordProduct, $startRow_RecordProduct, $maxRows_RecordProduct);
$RecordProduct = mysqli_query($DB_Conn, $query_limit_RecordProduct) or die(mysqli_error($DB_Conn));
$row_RecordProduct = mysqli_fetch_assoc($RecordProduct);

if (isset($_GET['totalRows_RecordProduct'])) {
  $totalRows_RecordProduct = $_GET['totalRows_RecordProduct'];
} else {
  $all_RecordProduct = mysqli_query($DB_Conn, $query_RecordProduct);
  $totalRows_RecordProduct = mysqli_num_rows($all_RecordProduct);
}
$totalPages_RecordProduct = ceil($totalRows_RecordProduct/$maxRows_RecordProduct)-1;
}// 模式判斷
/* ------------------------------------------------------------------------------------------ */
/* PD End */
/* ------------------------------------------------------------------------------------------ */
 include($TplPath . "/product_home.php");

} while ($row_RecordProductMultiTypeMenu_l1 = mysqli_fetch_assoc($RecordProductMultiTypeMenu_l1));
		
		
		
} 



mysqli_free_result($RecordProductMultiTypeMenu_l1);

/* ------------------------------------------------------------------------------------------ */
}else { /* else Start */
/* ------------------------------------------------------------------------------------------ */


if($TmpHomeProductMod == 1) { // 模式判斷
$maxRows_RecordProduct = 12;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordProduct = $page * $maxRows_RecordProduct;

$colname_RecordProduct = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordProduct = $_GET['searchkey'];
}
$coluserid_RecordProduct = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordProduct = $_SESSION['userid'];
}
$coltype1_RecordProduct = "%";
if (isset($_GET['type1'])) {
  $coltype1_RecordProduct = $_GET['type1'];
}
$coltype2_RecordProduct = "%";
if (isset($_GET['type2'])) {
  $coltype2_RecordProduct = $_GET['type2'];
}
$coltype3_RecordProduct = "%";
if (isset($_GET['type3'])) {
  $coltype3_RecordProduct = $_GET['type3'];
}
$colnamelang_RecordProduct = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordProduct = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProduct = sprintf("SELECT * FROM demo_product WHERE ((name LIKE %s) || (pdseries LIKE %s)) && lang = %s && type1 LIKE %s && type2 LIKE %s && type3 LIKE %s && userid=%s && homeshow=1 && indicate=1 ORDER BY rand()", GetSQLValueString("%" . $colname_RecordProduct . "%", "text"),GetSQLValueString("%" . $colname_RecordProduct . "%", "text"),GetSQLValueString($colnamelang_RecordProduct, "text"),GetSQLValueString($coltype1_RecordProduct, "text"),GetSQLValueString($coltype2_RecordProduct, "text"),GetSQLValueString($coltype3_RecordProduct, "text"),GetSQLValueString($coluserid_RecordProduct, "int"));
$query_limit_RecordProduct = sprintf("%s LIMIT %d, %d", $query_RecordProduct, $startRow_RecordProduct, $maxRows_RecordProduct);
$RecordProduct = mysqli_query($DB_Conn, $query_limit_RecordProduct) or die(mysqli_error($DB_Conn));
$row_RecordProduct = mysqli_fetch_assoc($RecordProduct);

if (isset($_GET['totalRows_RecordProduct'])) {
  $totalRows_RecordProduct = $_GET['totalRows_RecordProduct'];
} else {
  $all_RecordProduct = mysqli_query($DB_Conn, $query_RecordProduct);
  $totalRows_RecordProduct = mysqli_num_rows($all_RecordProduct);
}
$totalPages_RecordProduct = ceil($totalRows_RecordProduct/$maxRows_RecordProduct)-1;
}else{ // 模式判斷
$maxRows_RecordProduct = 12;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordProduct = $page * $maxRows_RecordProduct;

$colname_RecordProduct = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordProduct = $_GET['searchkey'];
}
$coluserid_RecordProduct = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordProduct = $_SESSION['userid'];
}
$coltype1_RecordProduct = "%";
if (isset($_GET['type1'])) {
  $coltype1_RecordProduct = $_GET['type1'];
}
$coltype2_RecordProduct = "%";
if (isset($_GET['type2'])) {
  $coltype2_RecordProduct = $_GET['type2'];
}
$coltype3_RecordProduct = "%";
if (isset($_GET['type3'])) {
  $coltype3_RecordProduct = $_GET['type3'];
}
$colnamelang_RecordProduct = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordProduct = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProduct = sprintf("SELECT * FROM demo_product WHERE ((name LIKE %s) || (pdseries LIKE %s)) && lang = %s && type1 LIKE %s && type2 LIKE %s && type3 LIKE %s && userid=%s && indicate=1 ORDER BY rand()", GetSQLValueString("%" . $colname_RecordProduct . "%", "text"),GetSQLValueString("%" . $colname_RecordProduct . "%", "text"),GetSQLValueString($colnamelang_RecordProduct, "text"),GetSQLValueString($coltype1_RecordProduct, "text"),GetSQLValueString($coltype2_RecordProduct, "text"),GetSQLValueString($coltype3_RecordProduct, "text"),GetSQLValueString($coluserid_RecordProduct, "int"));
$query_limit_RecordProduct = sprintf("%s LIMIT %d, %d", $query_RecordProduct, $startRow_RecordProduct, $maxRows_RecordProduct);
$RecordProduct = mysqli_query($DB_Conn, $query_limit_RecordProduct) or die(mysqli_error($DB_Conn));
$row_RecordProduct = mysqli_fetch_assoc($RecordProduct);

if (isset($_GET['totalRows_RecordProduct'])) {
  $totalRows_RecordProduct = $_GET['totalRows_RecordProduct'];
} else {
  $all_RecordProduct = mysqli_query($DB_Conn, $query_RecordProduct);
  $totalRows_RecordProduct = mysqli_num_rows($all_RecordProduct);
}
$totalPages_RecordProduct = ceil($totalRows_RecordProduct/$maxRows_RecordProduct)-1;
}// 模式判斷


include($TplPath . "/product_home.php");

/* ------------------------------------------------------------------------------------------ */
} /* else End */
/* ------------------------------------------------------------------------------------------ */
?>

<?php
mysqli_free_result($RecordProduct);
?>