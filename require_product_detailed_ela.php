<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($page,$totalPages_RecordProduct,$prev_RecordProduct,$next_RecordProduct,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordProduct,$totalRows_RecordProduct;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($page<=$totalPages_RecordProduct && $page>=0)
	{
		if ($page > ceil($max_links/2))
		{
			$fgp = $page - ceil($max_links/2) > 0 ? $page - ceil($max_links/2) : 1;
			$egp = $page + ceil($max_links/2);
			if ($egp >= $totalPages_RecordProduct)
			{
				$egp = $totalPages_RecordProduct+1;
				$fgp = $totalPages_RecordProduct - ($max_links-1) > 0 ? $totalPages_RecordProduct  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordProduct >= $max_links ? $max_links : $totalPages_RecordProduct+1;
		}
		if($totalPages_RecordProduct >= 1) {
			#	------------------------
			#	Searching for $_GET vars
			#	------------------------
			$_get_vars = '';			
			if(!empty($_GET) || !empty($HTTP_GET_VARS)){
				$_GET = empty($_GET) ? $HTTP_GET_VARS : $_GET;
				foreach ($_GET as $_get_name => $_get_value) {
					if ($_get_name != "page") {
						$_get_vars .= "&$_get_name=$_get_value";
					}
				}
			}
			$successivo = $page+1;
			$precedente = $page-1;
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordProduct</a>" :  "$prev_RecordProduct";
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordProduct) + 1;
					$max_l = ($a*$maxRows_RecordProduct >= $totalRows_RecordProduct) ? $totalRows_RecordProduct : ($a*$maxRows_RecordProduct);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $page)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?page=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "$textLink"  . ($theNext < $egp-1 ? $separator : "");
				}
			}
			$theNext = $page+1;
			$offset_end = $totalPages_RecordProduct;
			$lastArray = ($page < $totalPages_RecordProduct) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordProduct</a>" : "$next_RecordProduct";
		}
	}
	return array($firstArray,$pagesArray,$lastArray);
}

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

$colname_RecordProduct = "-1";
if (isset($_GET['id'])) {
  $colname_RecordProduct = $_GET['id'];
}
$coluserid_RecordProduct = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordProduct = $_SESSION['userid'];
}
$collang_RecordProduct = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordProduct = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProduct = sprintf("SELECT * FROM demo_product WHERE id = %s && lang=%s && userid=%s && indicate=1", GetSQLValueString($colname_RecordProduct, "int"),GetSQLValueString($collang_RecordProduct, "text"),GetSQLValueString($coluserid_RecordProduct, "int"));
$RecordProduct = mysqli_query($DB_Conn, $query_RecordProduct) or die(mysqli_error($DB_Conn));
$row_RecordProduct = mysqli_fetch_assoc($RecordProduct);
$totalRows_RecordProduct = mysqli_num_rows($RecordProduct);

$colname_RecordProductRater = "-1";
if (isset($_GET['id'])) {
  $colname_RecordProductRater = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductRater = sprintf("SELECT * FROM demo_productrater WHERE pdid = %s", GetSQLValueString($colname_RecordProductRater, "int"));
$RecordProductRater = mysqli_query($DB_Conn, $query_RecordProductRater) or die(mysqli_error($DB_Conn));
$row_RecordProductRater = mysqli_fetch_assoc($RecordProductRater);
$totalRows_RecordProductRater = mysqli_num_rows($RecordProductRater);

$colname_RecordProductPlus = "-1";
if (isset($_GET['id'])) {
  $colname_RecordProductPlus = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductPlus = sprintf("SELECT * FROM demo_productplus WHERE pdid = %s", GetSQLValueString($colname_RecordProductPlus, "int"));
$RecordProductPlus = mysqli_query($DB_Conn, $query_RecordProductPlus) or die(mysqli_error($DB_Conn));
$row_RecordProductPlus = mysqli_fetch_assoc($RecordProductPlus);
$totalRows_RecordProductPlus = mysqli_num_rows($RecordProductPlus);

$colid_RecordProductPrev = "-1";
if (isset($_GET['id'])) {
  $colid_RecordProductPrev = $_GET['id'];
}
$coltype1_RecordProductPrev = "%";
if (isset($_GET['type1'])) {
  $coltype1_RecordProductPrev = $_GET['type1'];
}
$coltype2_RecordProductPrev = "%";
if (isset($_GET['type2'])) {
  $coltype2_RecordProductPrev = $_GET['type2'];
}
$coltype3_RecordProductPrev = "%";
if (isset($_GET['type3'])) {
  $coltype3_RecordProductPrev = $_GET['type3'];
}
$coluserid_RecordProductPrev = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordProductPrev = $_SESSION['userid'];
}
$collang_RecordProductPrev = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordProductPrev = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductPrev = sprintf("SELECT * FROM demo_product WHERE id<%s && lang=%s && (indicate=1) && userid=%s && type1=%s && type2=%s && type3=%s ORDER BY id DESC LIMIT 1", GetSQLValueString($colid_RecordProductPrev, "int"),GetSQLValueString($collang_RecordProductPrev, "text"),GetSQLValueString($coluserid_RecordProductPrev, "int"),GetSQLValueString($coltype1_RecordProductPrev, "text"),GetSQLValueString($coltype2_RecordProductPrev, "text"),GetSQLValueString($coltype3_RecordProductPrev, "text"));
$RecordProductPrev = mysqli_query($DB_Conn, $query_RecordProductPrev) or die(mysqli_error($DB_Conn));
$row_RecordProductPrev = mysqli_fetch_assoc($RecordProductPrev);
$totalRows_RecordProductPrev = mysqli_num_rows($RecordProductPrev);

$colid_RecordProductNext = "-1";
if (isset($_GET['id'])) {
  $colid_RecordProductNext = $_GET['id'];
}
$coltype1_RecordProductNext = "%";
if (isset($_GET['type1'])) {
  $coltype1_RecordProductNext = $_GET['type1'];
}
$coltype2_RecordProductNext = "%";
if (isset($_GET['type2'])) {
  $coltype2_RecordProductNext = $_GET['type2'];
}
$coltype3_RecordProductNext = "%";
if (isset($_GET['type3'])) {
  $coltype3_RecordProductNext = $_GET['type3'];
}
$coluserid_RecordProductNext = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordProductNext = $_SESSION['userid'];
}
$collang_RecordProductNext = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordProductNext = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductNext = sprintf("SELECT * FROM demo_product WHERE id>%s && lang=%s && (indicate=1) && userid=%s && type1=%s && type2=%s && type3=%s ORDER BY id ASC LIMIT 1", GetSQLValueString($colid_RecordProductNext, "int"),GetSQLValueString($collang_RecordProductNext, "text"),GetSQLValueString($coluserid_RecordProductNext, "int"),GetSQLValueString($coltype1_RecordProductNext, "text"),GetSQLValueString($coltype2_RecordProductNext, "text"),GetSQLValueString($coltype3_RecordProductNext, "text"));
$RecordProductNext = mysqli_query($DB_Conn, $query_RecordProductNext) or die(mysqli_error($DB_Conn));
$row_RecordProductNext = mysqli_fetch_assoc($RecordProductNext);
$totalRows_RecordProductNext = mysqli_num_rows($RecordProductNext);

if ($OptionCartSelect == '1' && $row_RecordProduct['pricecheck'] == '1') { // 購物功能
	require("require_product_cart_pay.php");
}

?>
<?php 
// 瀏覽數 - 熱門
  $updateSQL = sprintf("UPDATE demo_product SET visit=visit+1 WHERE id=%s",
                       GetSQLValueString($_GET['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/product_detailed.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordProduct);

mysqli_free_result($RecordProductRater);

mysqli_free_result($RecordProductPlus);

mysqli_free_result($RecordProductPrev);

mysqli_free_result($RecordProductNext);
?>
