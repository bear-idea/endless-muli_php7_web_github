<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($page,$totalPages_RecordActnews,$prev_RecordActnews,$next_RecordActnews,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordActnews,$totalRows_RecordActnews;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($page<=$totalPages_RecordActnews && $page>=0)
	{
		if ($page > ceil($max_links/2))
		{
			$fgp = $page - ceil($max_links/2) > 0 ? $page - ceil($max_links/2) : 1;
			$egp = $page + ceil($max_links/2);
			if ($egp >= $totalPages_RecordActnews)
			{
				$egp = $totalPages_RecordActnews+1;
				$fgp = $totalPages_RecordActnews - ($max_links-1) > 0 ? $totalPages_RecordActnews  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordActnews >= $max_links ? $max_links : $totalPages_RecordActnews+1;
		}
		if($totalPages_RecordActnews >= 1) {
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
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordActnews</a>" :  "<span>$prev_RecordActnews</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordActnews) + 1;
					$max_l = ($a*$maxRows_RecordActnews >= $totalRows_RecordActnews) ? $totalRows_RecordActnews : ($a*$maxRows_RecordActnews);
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
			$offset_end = $totalPages_RecordActnews;
			$lastArray = ($page < $totalPages_RecordActnews) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordActnews</a>" : "<span>$next_RecordActnews</span>"; /* css */
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

$maxRows_RecordActnews = 25;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordActnews = $page * $maxRows_RecordActnews;

$colname_RecordActnews = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordActnews = $_GET['searchkey'];
}
$coluserid_RecordActnews = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordActnews = $_SESSION['userid'];
}
$collang_RecordActnews = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordActnews = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordActnews = sprintf("SELECT * FROM demo_actnews WHERE (type LIKE %s) && (indicate=1) && (lang = %s) && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordActnews . "%", "text"),GetSQLValueString($collang_RecordActnews, "text"),GetSQLValueString($coluserid_RecordActnews, "int"));
$query_limit_RecordActnews = sprintf("%s LIMIT %d, %d", $query_RecordActnews, $startRow_RecordActnews, $maxRows_RecordActnews);
$RecordActnews = mysqli_query($DB_Conn, $query_limit_RecordActnews) or die(mysqli_error($DB_Conn));
$row_RecordActnews = mysqli_fetch_assoc($RecordActnews);

if (isset($_GET['totalRows_RecordActnews'])) {
  $totalRows_RecordActnews = $_GET['totalRows_RecordActnews'];
} else {
  $all_RecordActnews = mysqli_query($DB_Conn, $query_RecordActnews);
  $totalRows_RecordActnews = mysqli_num_rows($all_RecordActnews);
}
$totalPages_RecordActnews = ceil($totalRows_RecordActnews/$maxRows_RecordActnews)-1;

$queryString_RecordActnews = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordActnews") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordActnews = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordActnews = sprintf("&totalRows_RecordActnews=%d%s", $totalRows_RecordActnews, $queryString_RecordActnews);


?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/actnews_view.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordActnews);
?>
