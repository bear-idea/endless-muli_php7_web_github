<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($page,$totalPages_RecordImageshow,$prev_RecordImageshow,$next_RecordImageshow,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordImageshow,$totalRows_RecordImageshow;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($page<=$totalPages_RecordImageshow && $page>=0)
	{
		if ($page > ceil($max_links/2))
		{
			$fgp = $page - ceil($max_links/2) > 0 ? $page - ceil($max_links/2) : 1;
			$egp = $page + ceil($max_links/2);
			if ($egp >= $totalPages_RecordImageshow)
			{
				$egp = $totalPages_RecordImageshow+1;
				$fgp = $totalPages_RecordImageshow - ($max_links-1) > 0 ? $totalPages_RecordImageshow  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordImageshow >= $max_links ? $max_links : $totalPages_RecordImageshow+1;
		}
		if($totalPages_RecordImageshow >= 1) {
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
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordImageshow</a>" :  "<span>$prev_RecordImageshow</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordImageshow) + 1;
					$max_l = ($a*$maxRows_RecordImageshow >= $totalRows_RecordImageshow) ? $totalRows_RecordImageshow : ($a*$maxRows_RecordImageshow);
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
			$offset_end = $totalPages_RecordImageshow;
			$lastArray = ($page < $totalPages_RecordImageshow) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordImageshow</a>" : "<span>$next_RecordImageshow</span>"; /* css */
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

$maxRows_RecordImageshow = 24;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordImageshow = $page * $maxRows_RecordImageshow;

$colname_RecordImageshow = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordImageshow = $_GET['searchkey'];
}
$coluserid_RecordImageshow = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordImageshow = $_SESSION['userid'];
}
$colnamelang_RecordImageshow = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordImageshow = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordImageshow = sprintf("SELECT * FROM demo_imageshow WHERE (name LIKE %s || type LIKE %s) && lang = %s && userid=%s && indicate=1 ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordImageshow . "%", "text"),GetSQLValueString("%" . $colname_RecordImageshow . "%", "text"),GetSQLValueString($colnamelang_RecordImageshow, "text"),GetSQLValueString($coluserid_RecordImageshow, "int"));
$query_limit_RecordImageshow = sprintf("%s LIMIT %d, %d", $query_RecordImageshow, $startRow_RecordImageshow, $maxRows_RecordImageshow);
$RecordImageshow = mysqli_query($DB_Conn, $query_limit_RecordImageshow) or die(mysqli_error($DB_Conn));
$row_RecordImageshow = mysqli_fetch_assoc($RecordImageshow);

if (isset($_GET['totalRows_RecordImageshow'])) {
  $totalRows_RecordImageshow = $_GET['totalRows_RecordImageshow'];
} else {
  $all_RecordImageshow = mysqli_query($DB_Conn, $query_RecordImageshow);
  $totalRows_RecordImageshow = mysqli_num_rows($all_RecordImageshow);
}
$totalPages_RecordImageshow = ceil($totalRows_RecordImageshow/$maxRows_RecordImageshow)-1;

$queryString_RecordImageshow = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordImageshow") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordImageshow = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordImageshow = sprintf("&totalRows_RecordImageshow=%d%s", $totalRows_RecordImageshow, $queryString_RecordImageshow);


?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/imageshow_view.php"); ?>
<?php //include($TplPath . "/imageshow_slider.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordImageshow);
?>
