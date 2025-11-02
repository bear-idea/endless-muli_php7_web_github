<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($page,$totalPages_RecordSplitorder,$prev_RecordSplitorder,$next_RecordSplitorder,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordSplitorder,$totalRows_RecordSplitorder;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($page<=$totalPages_RecordSplitorder && $page>=0)
	{
		if ($page > ceil($max_links/2))
		{
			$fgp = $page - ceil($max_links/2) > 0 ? $page - ceil($max_links/2) : 1;
			$egp = $page + ceil($max_links/2);
			if ($egp >= $totalPages_RecordSplitorder)
			{
				$egp = $totalPages_RecordSplitorder+1;
				$fgp = $totalPages_RecordSplitorder - ($max_links-1) > 0 ? $totalPages_RecordSplitorder  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordSplitorder >= $max_links ? $max_links : $totalPages_RecordSplitorder+1;
		}
		if($totalPages_RecordSplitorder >= 1) {
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
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordSplitorder</a>" :  "<span>$prev_RecordSplitorder</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordSplitorder) + 1;
					$max_l = ($a*$maxRows_RecordSplitorder >= $totalRows_RecordSplitorder) ? $totalRows_RecordSplitorder : ($a*$maxRows_RecordSplitorder);
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
			$offset_end = $totalPages_RecordSplitorder;
			$lastArray = ($page < $totalPages_RecordSplitorder) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordSplitorder</a>" : "<span>$next_RecordSplitorder</span>"; /* css */
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

$maxRows_RecordSplitorder = 200;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordSplitorder = $page * $maxRows_RecordSplitorder;

$coluserid_RecordSplitorder = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordSplitorder = $_SESSION['userid'];
}
$collang_RecordSplitorder = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordSplitorder = $_GET['lang'];
}
$colcarnumber_RecordSplitorder = "%";
if (isset($_GET['carnumber']) && $_GET['carnumber'] != "") {
  $colcarnumber_RecordSplitorder = $_GET['carnumber'];
}

if($_GET['startdate'] != "") {$_GET['startdate'] = $_GET['startdate'];}else{}
if($_GET['enddate'] != "") {$_GET['enddate'] = $_GET['enddate'];}else{}

$colstartdate_RecordSplitorder = "1900-01-01";
if (isset($_GET['startdate']) && $_GET['startdate'] != "") {
  $colstartdate_RecordSplitorder = $_GET['startdate'];
}
$colenddate_RecordSplitorder = date('Y-m-d', strtotime('+1 day'));
if (isset($_GET['enddate']) && $_GET['enddate'] != "") {
  $colenddate_RecordSplitorder = date("Y-m-d", strtotime($_GET['enddate']."+1 day"));
}


//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSplitorder = sprintf("SELECT * FROM erp_splitorder WHERE (notes1 LIKE binary %s || notes1 IS NULL) && (carnumber LIKE binary %s || carnumber IS NULL) && indicate=1 && lang = %s && userid=%s && startdate BETWEEN %s AND %s ORDER BY startdate DESC, oid DESC", GetSQLValueString("%" . $colsearch_RecordSplitorder . "%", "text"), GetSQLValueString("%" . $colcarnumber_RecordSplitorder . "%", "text"), GetSQLValueString($collang_RecordSplitorder, "text"),GetSQLValueString($coluserid_RecordSplitorder, "int"),GetSQLValueString($colstartdate_RecordSplitorder, "date"),GetSQLValueString($colenddate_RecordSplitorder, "date"));
$query_limit_RecordSplitorder = sprintf("%s LIMIT %d, %d", $query_RecordSplitorder, $startRow_RecordSplitorder, $maxRows_RecordSplitorder);
$RecordSplitorder = mysqli_query($DB_Conn, $query_limit_RecordSplitorder) or die(mysqli_error($DB_Conn));
$row_RecordSplitorder = mysqli_fetch_assoc($RecordSplitorder);

if (isset($_GET['totalRows_RecordSplitorder'])) {
  $totalRows_RecordSplitorder = $_GET['totalRows_RecordSplitorder'];
} else {
  $all_RecordSplitorder = mysqli_query($DB_Conn, $query_RecordSplitorder);
  $totalRows_RecordSplitorder = mysqli_num_rows($all_RecordSplitorder);
}
$totalPages_RecordSplitorder = ceil($totalRows_RecordSplitorder/$maxRows_RecordSplitorder)-1;

$queryString_RecordSplitorder = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordSplitorder") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordSplitorder = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordSplitorder = sprintf("&totalRows_RecordSplitorder=%d%s", $totalRows_RecordSplitorder, $queryString_RecordSplitorder);

?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/splitorder_order.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordSplitorder);
?>
