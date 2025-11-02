<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($page,$totalPages_RecordScale,$prev_RecordScale,$next_RecordScale,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordScale,$totalRows_RecordScale;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($page<=$totalPages_RecordScale && $page>=0)
	{
		if ($page > ceil($max_links/2))
		{
			$fgp = $page - ceil($max_links/2) > 0 ? $page - ceil($max_links/2) : 1;
			$egp = $page + ceil($max_links/2);
			if ($egp >= $totalPages_RecordScale)
			{
				$egp = $totalPages_RecordScale+1;
				$fgp = $totalPages_RecordScale - ($max_links-1) > 0 ? $totalPages_RecordScale  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordScale >= $max_links ? $max_links : $totalPages_RecordScale+1;
		}
		if($totalPages_RecordScale >= 1) {
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
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordScale</a>" :  "<span>$prev_RecordScale</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordScale) + 1;
					$max_l = ($a*$maxRows_RecordScale >= $totalRows_RecordScale) ? $totalRows_RecordScale : ($a*$maxRows_RecordScale);
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
			$offset_end = $totalPages_RecordScale;
			$lastArray = ($page < $totalPages_RecordScale) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordScale</a>" : "<span>$next_RecordScale</span>"; /* css */
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

$maxRows_RecordScale = 200;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordScale = $page * $maxRows_RecordScale;

if($_POST['scale'] != "") {
$_POST['scale'] = array_unique($_POST['scale']);
$_POST['scale_bk'] = $_POST['scale'];
$_POST['scale']=implode("|",$_POST['scale']);
$scalelink = "REGEXP";
}else{
	$scalelink = "LIKE";
}


$colname_RecordScale = "%";
if (isset($_POST['scale'])) {
  $colname_RecordScale = $_POST['scale'];
}
$coluserid_RecordScale = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordScale = $_SESSION['userid'];
}
$collang_RecordScale = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordScale = $_GET['lang'];
}
$colbound_RecordScale = "in";
if (isset($_GET['bound'])) {
  $collang_RecordScale = $_GET['bound'];
}

if($_GET['startdate'] != "") {$_POST['startdate'] = $_GET['startdate'];}else{}
if($_GET['enddate'] != "") {$_POST['enddate'] = $_GET['enddate'];}else{}

$colstartdate_RecordScaleorder = "1900-01-01";
if (isset($_POST['startdate']) && $_POST['startdate'] != "") {
  $colstartdate_RecordScaleorder = $_POST['startdate'];
}
$colenddate_RecordScaleorder = date('Y-m-d', strtotime('+1 day'));
if (isset($_POST['enddate']) && $_POST['enddate'] != "") {
  $colenddate_RecordScaleorder = date("Y-m-d", strtotime($_POST['enddate']."+1 day"));
}



//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordScale = sprintf("SELECT * FROM erp_scaleordersourcedetail WHERE (code $scalelink %s) && (indicate=1) && (lang = %s) && userid=%s && bound=%s && postdate BETWEEN %s AND %s ORDER BY postdate DESC, sortid ASC, id DESC", GetSQLValueString( $colname_RecordScale, "text"),GetSQLValueString($collang_RecordScale, "text"),GetSQLValueString($coluserid_RecordScale, "int"),GetSQLValueString($colbound_RecordScale, "text"),GetSQLValueString($colstartdate_RecordScaleorder, "date"),GetSQLValueString($colenddate_RecordScaleorder, "date"));
$query_limit_RecordScale = sprintf("%s LIMIT %d, %d", $query_RecordScale, $startRow_RecordScale, $maxRows_RecordScale);
$RecordScale = mysqli_query($DB_Conn, $query_limit_RecordScale) or die(mysqli_error($DB_Conn));
$row_RecordScale = mysqli_fetch_assoc($RecordScale);

$coluserid_RecordDate = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordDate = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDate = sprintf("SELECT * FROM erp_scalesource WHERE userid=%s ORDER BY sortid ASC, code ASC",GetSQLValueString($coluserid_RecordDate, "int"));
$RecordDate = mysqli_query($DB_Conn, $query_RecordDate) or die(mysqli_error($DB_Conn));
$row_RecordDate = mysqli_fetch_assoc($RecordDate);
$totalRows_RecordDate = mysqli_num_rows($RecordDate);

if (isset($_GET['totalRows_RecordScale'])) {
  $totalRows_RecordScale = $_GET['totalRows_RecordScale'];
} else {
  $all_RecordScale = mysqli_query($DB_Conn, $query_RecordScale);
  $totalRows_RecordScale = mysqli_num_rows($all_RecordScale);
}
$totalPages_RecordScale = ceil($totalRows_RecordScale/$maxRows_RecordScale)-1;

$queryString_RecordScale = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordScale") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordScale = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordScale = sprintf("&totalRows_RecordScale=%d%s", $totalRows_RecordScale, $queryString_RecordScale);
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/scalesource_scale_order_source.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordScale);
?>
