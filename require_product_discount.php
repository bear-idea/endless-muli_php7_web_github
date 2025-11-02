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
						if(is_array($_get_value)){
							$_get_vars .= "&$_get_name=" . urlencode(serialize($_get_value));
							}else {
							$_get_vars .= "&$_get_name=" . urlencode("$_get_value");
						}
					}
				}
			}
			$successivo = $page+1;
			$precedente = $page-1;
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordProduct</a>" :  "<span>$prev_RecordProduct</span>";/* css */
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
					$pagesArray .= "<span>"; /* css */
					$pagesArray .= "$textLink</span>"  . ($theNext < $egp-1 ? $separator : "");
				}
			}
			$theNext = $page+1;
			$offset_end = $totalPages_RecordProduct;
			$lastArray = ($page < $totalPages_RecordProduct) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordProduct</a>" : "<span>$next_RecordProduct</span>"; /* css */
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecordProduct = 24;
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
$colplot_RecordProduct = "%";
if (isset($_GET['plot'])) {
  $colplot_RecordProduct = $_GET['plot'];
}
$coldiscountid_RecordProduct = "%";
if (isset($_GET['discountid'])) {
  $coldiscountid_RecordProduct = $_GET['discountid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProduct = sprintf("SELECT * FROM demo_product WHERE ((name LIKE %s) || (pdseries LIKE %s)) && lang = %s && type1 LIKE %s && type2 LIKE %s && type3 LIKE %s && plot LIKE %s && userid=%s && indicate=1 && discountid LIKE %s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordProduct . "%", "text"),GetSQLValueString("%" . $colname_RecordProduct . "%", "text"),GetSQLValueString($colnamelang_RecordProduct, "text"),GetSQLValueString($coltype1_RecordProduct, "text"),GetSQLValueString($coltype2_RecordProduct, "text"),GetSQLValueString($coltype3_RecordProduct, "text"),GetSQLValueString($colplot_RecordProduct, "text"),GetSQLValueString($coluserid_RecordProduct, "int"),GetSQLValueString($coldiscountid_RecordProduct, "text"));
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

$queryString_RecordProduct = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordProduct") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordProduct = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordProduct = sprintf("&totalRows_RecordProduct=%d%s", $totalRows_RecordProduct, $queryString_RecordProduct);

$colname_RecordDiscount = "-1";
if (isset($_GET['discountid'])) {
  $colname_RecordDiscount = $_GET['discountid'];
}
$coluserid_RecordDiscount = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordDiscount = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDiscount = sprintf("SELECT * FROM demo_productdiscount WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordDiscount, "int"),GetSQLValueString($coluserid_RecordDiscount, "int"));
$RecordDiscount = mysqli_query($DB_Conn, $query_RecordDiscount) or die(mysqli_error($DB_Conn));
$row_RecordDiscount = mysqli_fetch_assoc($RecordDiscount);
$totalRows_RecordDiscount = mysqli_num_rows($RecordDiscount);


?>

<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/product_discount.php"); ?>
<?php } ?>

<?php
mysqli_free_result($RecordProduct);

mysqli_free_result($RecordDiscount);
?>