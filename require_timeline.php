<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($pageNum_RecordTimelineType,$totalPages_RecordTimelineType,$prev_RecordTimelineType,$next_RecordTimelineType,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordTimelineType,$totalRows_RecordTimelineType;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($pageNum_RecordTimelineType<=$totalPages_RecordTimelineType && $pageNum_RecordTimelineType>=0)
	{
		if ($pageNum_RecordTimelineType > ceil($max_links/2))
		{
			$fgp = $pageNum_RecordTimelineType - ceil($max_links/2) > 0 ? $pageNum_RecordTimelineType - ceil($max_links/2) : 1;
			$egp = $pageNum_RecordTimelineType + ceil($max_links/2);
			if ($egp >= $totalPages_RecordTimelineType)
			{
				$egp = $totalPages_RecordTimelineType+1;
				$fgp = $totalPages_RecordTimelineType - ($max_links-1) > 0 ? $totalPages_RecordTimelineType  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordTimelineType >= $max_links ? $max_links : $totalPages_RecordTimelineType+1;
		}
		if($totalPages_RecordTimelineType >= 1) {
			#	------------------------
			#	Searching for $_GET vars
			#	------------------------
			$_get_vars = '';			
			if(!empty($_GET) || !empty($HTTP_GET_VARS)){
				$_GET = empty($_GET) ? $HTTP_GET_VARS : $_GET;
				foreach ($_GET as $_get_name => $_get_value) {
					if ($_get_name != "pageNum_RecordTimelineType") {
						if(is_array($_get_value)){
							$_get_vars .= "&$_get_name=" . urlencode(serialize($_get_value));
							}else {
							$_get_vars .= "&$_get_name=" . urlencode("$_get_value");
						}
					}
				}
			}
			$successivo = $pageNum_RecordTimelineType+1;
			$precedente = $pageNum_RecordTimelineType-1;
			$firstArray = ($pageNum_RecordTimelineType > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordTimelineType=$precedente$_get_vars\">$prev_RecordTimelineType</a>" :  "<span>$prev_RecordTimelineType</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordTimelineType) + 1;
					$max_l = ($a*$maxRows_RecordTimelineType >= $totalRows_RecordTimelineType) ? $totalRows_RecordTimelineType : ($a*$maxRows_RecordTimelineType);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageNum_RecordTimelineType)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordTimelineType=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "<span>"; /* css */
					$pagesArray .= "$textLink</span>"  . ($theNext < $egp-1 ? $separator : "");
				}
			}
			$theNext = $pageNum_RecordTimelineType+1;
			$offset_end = $totalPages_RecordTimelineType;
			$lastArray = ($pageNum_RecordTimelineType < $totalPages_RecordTimelineType) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordTimelineType=$successivo$_get_vars\">$next_RecordTimelineType</a>" : "<span>$next_RecordTimelineType</span>"; /* css */
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

$maxRows_RecordTimelineType = 999;
$pageNum_RecordTimelineType = 0;
if (isset($_GET['pageNum_RecordTimelineType'])) {
  $pageNum_RecordTimelineType = $_GET['pageNum_RecordTimelineType'];
}
$startRow_RecordTimelineType = $pageNum_RecordTimelineType * $maxRows_RecordTimelineType;

$coluserid_RecordTimelineType = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordTimelineType = $_SESSION['userid'];
}
$collang_RecordTimelineType = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordTimelineType = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTimelineType = sprintf("SELECT * FROM demo_timeline WHERE lang = %s && userid=%s ORDER BY sortid ASC, type DESC, month DESC, day DESC", GetSQLValueString($collang_RecordTimelineType, "text"),GetSQLValueString($coluserid_RecordTimelineType, "int"));
$query_limit_RecordTimelineType = sprintf("%s LIMIT %d, %d", $query_RecordTimelineType, $startRow_RecordTimelineType, $maxRows_RecordTimelineType);
$RecordTimelineType = mysqli_query($DB_Conn, $query_limit_RecordTimelineType) or die(mysqli_error($DB_Conn));
$row_RecordTimelineType = mysqli_fetch_assoc($RecordTimelineType);

if (isset($_GET['totalRows_RecordTimelineType'])) {
  $totalRows_RecordTimelineType = $_GET['totalRows_RecordTimelineType'];
} else {
  $all_RecordTimelineType = mysqli_query($DB_Conn, $query_RecordTimelineType);
  $totalRows_RecordTimelineType = mysqli_num_rows($all_RecordTimelineType);
}
$totalPages_RecordTimelineType = ceil($totalRows_RecordTimelineType/$maxRows_RecordTimelineType)-1;

$queryString_RecordTimelineType = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecordTimelineType") == false && 
        stristr($param, "totalRows_RecordTimelineType") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordTimelineType = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordTimelineType = sprintf("&totalRows_RecordTimelineType=%d%s", $totalRows_RecordTimelineType, $queryString_RecordTimelineType);


?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/timeline_view.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordTimelineType);
?>
