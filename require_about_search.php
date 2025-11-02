<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($page,$totalPages_RecordAbout,$prev_RecordAbout,$next_RecordAbout,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordAbout,$totalRows_RecordAbout;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($page<=$totalPages_RecordAbout && $page>=0)
	{
		if ($page > ceil($max_links/2))
		{
			$fgp = $page - ceil($max_links/2) > 0 ? $page - ceil($max_links/2) : 1;
			$egp = $page + ceil($max_links/2);
			if ($egp >= $totalPages_RecordAbout)
			{
				$egp = $totalPages_RecordAbout+1;
				$fgp = $totalPages_RecordAbout - ($max_links-1) > 0 ? $totalPages_RecordAbout  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordAbout >= $max_links ? $max_links : $totalPages_RecordAbout+1;
		}
		if($totalPages_RecordAbout >= 1) {
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
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordAbout</a>" :  "<span>$prev_RecordAbout</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordAbout) + 1;
					$max_l = ($a*$maxRows_RecordAbout >= $totalRows_RecordAbout) ? $totalRows_RecordAbout : ($a*$maxRows_RecordAbout);
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
			$offset_end = $totalPages_RecordAbout;
			$lastArray = ($page < $totalPages_RecordAbout) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordAbout</a>" : "<span>$next_RecordAbout</span>"; /* css */
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

$maxRows_RecordAbout = 24;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordAbout = $page * $maxRows_RecordAbout;

$coltag_RecordAbout = "%";
if (isset($_GET['tag'])) {
  $coltag_RecordAbout = $_GET['tag'];
}else if (isset($_GET['searchkey'])) {
  $coltag_RecordAbout = $_GET['searchkey'];
}
$coluserid_RecordAbout = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordAbout = $_SESSION['userid'];
}
$collang_RecordAbout = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordAbout = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAbout = sprintf("SELECT * FROM demo_about WHERE (title LIKE %s || skeyword LIKE %s) && (indicate=1) && (lang = %s)  && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $coltag_RecordAbout . "%", "text"),GetSQLValueString("%" . $coltag_RecordAbout . "%", "text"),GetSQLValueString($collang_RecordAbout, "text"),GetSQLValueString($coluserid_RecordAbout, "int"));
$query_limit_RecordAbout = sprintf("%s LIMIT %d, %d", $query_RecordAbout, $startRow_RecordAbout, $maxRows_RecordAbout);
$RecordAbout = mysqli_query($DB_Conn, $query_limit_RecordAbout) or die(mysqli_error($DB_Conn));
$row_RecordAbout = mysqli_fetch_assoc($RecordAbout);

if (isset($_GET['totalRows_RecordAbout'])) {
  $totalRows_RecordAbout = $_GET['totalRows_RecordAbout'];
} else {
  $all_RecordAbout = mysqli_query($DB_Conn, $query_RecordAbout);
  $totalRows_RecordAbout = mysqli_num_rows($all_RecordAbout);
}
$totalPages_RecordAbout = ceil($totalRows_RecordAbout/$maxRows_RecordAbout)-1;

$queryString_RecordAbout = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordAbout") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordAbout = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordAbout = sprintf("&totalRows_RecordAbout=%d%s", $totalRows_RecordAbout, $queryString_RecordAbout);
?> 
<?php //print_r($GLOBALS); ?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/about_view.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordAbout);
?>
