<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($pageNum_RecordBlog,$totalPages_RecordBlog,$prev_RecordBlog,$next_RecordBlog,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordBlog,$totalRows_RecordBlog;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($pageNum_RecordBlog<=$totalPages_RecordBlog && $pageNum_RecordBlog>=0)
	{
		if ($pageNum_RecordBlog > ceil($max_links/2))
		{
			$fgp = $pageNum_RecordBlog - ceil($max_links/2) > 0 ? $pageNum_RecordBlog - ceil($max_links/2) : 1;
			$egp = $pageNum_RecordBlog + ceil($max_links/2);
			if ($egp >= $totalPages_RecordBlog)
			{
				$egp = $totalPages_RecordBlog+1;
				$fgp = $totalPages_RecordBlog - ($max_links-1) > 0 ? $totalPages_RecordBlog  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordBlog >= $max_links ? $max_links : $totalPages_RecordBlog+1;
		}
		if($totalPages_RecordBlog >= 1) {
			#	------------------------
			#	Searching for $_GET vars
			#	------------------------
			$_get_vars = '';			
			if(!empty($_GET) || !empty($HTTP_GET_VARS)){
				$_GET = empty($_GET) ? $HTTP_GET_VARS : $_GET;
				foreach ($_GET as $_get_name => $_get_value) {
					if ($_get_name != "pageNum_RecordBlog") {
						if(is_array($_get_value)){
							$_get_vars .= "&$_get_name=" . urlencode(serialize($_get_value));
							}else {
							$_get_vars .= "&$_get_name=" . urlencode("$_get_value");
						}
					}
				}
			}
			$successivo = $pageNum_RecordBlog+1;
			$precedente = $pageNum_RecordBlog-1;
			$firstArray = ($pageNum_RecordBlog > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordBlog=$precedente$_get_vars\">$prev_RecordBlog</a>" :  "<span>$prev_RecordBlog</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordBlog) + 1;
					$max_l = ($a*$maxRows_RecordBlog >= $totalRows_RecordBlog) ? $totalRows_RecordBlog : ($a*$maxRows_RecordBlog);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageNum_RecordBlog)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordBlog=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "<span>"; /* css */
					$pagesArray .= "$textLink</span>"  . ($theNext < $egp-1 ? $separator : "");
				}
			}
			$theNext = $pageNum_RecordBlog+1;
			$offset_end = $totalPages_RecordBlog;
			$lastArray = ($pageNum_RecordBlog < $totalPages_RecordBlog) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordBlog=$successivo$_get_vars\">$next_RecordBlog</a>" : "<span>$next_RecordBlog</span>"; /* css */
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

$maxRows_RecordBlog = 10;
$pageNum_RecordBlog = 0;
if (isset($_GET['pageNum_RecordBlog'])) {
  $pageNum_RecordBlog = $_GET['pageNum_RecordBlog'];
}
$startRow_RecordBlog = $pageNum_RecordBlog * $maxRows_RecordBlog;

$colnamelang_RecordBlog = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordBlog = $_GET['lang'];
}
$YY_RecordBlog = "%";
if (isset($_GET['YY'])) {
  $YY_RecordBlog = $_GET['YY'];
}
$MM_RecordBlog = "%";
if (isset($_GET['MM'])) {
  $MM_RecordBlog = $_GET['MM'];
}
$DD_RecordBlog = "%";
if (isset($_GET['DD'])) {
  $DD_RecordBlog = $_GET['DD'];
}
$coluserid_RecordBlog = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordBlog = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordBlog = sprintf("SELECT * FROM demo_blog WHERE lang = %s  && indicate = 1 && userid=%s && postdate LIKE '%s-%s-%s%%' ORDER BY lastdate DESC, sortid ASC, id DESC", GetSQLValueString($colnamelang_RecordBlog, "text"),GetSQLValueString($coluserid_RecordBlog, "int"),GetSQLValueString($YY_RecordBlog, "none"),GetSQLValueString($MM_RecordBlog, "none"),GetSQLValueString($DD_RecordBlog . "%", "none"));
$query_limit_RecordBlog = sprintf("%s LIMIT %d, %d", $query_RecordBlog, $startRow_RecordBlog, $maxRows_RecordBlog);
$RecordBlog = mysqli_query($DB_Conn, $query_limit_RecordBlog) or die(mysqli_error($DB_Conn));
$row_RecordBlog = mysqli_fetch_assoc($RecordBlog);

if (isset($_GET['totalRows_RecordBlog'])) {
  $totalRows_RecordBlog = $_GET['totalRows_RecordBlog'];
} else {
  $all_RecordBlog = mysqli_query($DB_Conn, $query_RecordBlog);
  $totalRows_RecordBlog = mysqli_num_rows($all_RecordBlog);
}
$totalPages_RecordBlog = ceil($totalRows_RecordBlog/$maxRows_RecordBlog)-1;

$queryString_RecordBlog = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecordBlog") == false && 
        stristr($param, "totalRows_RecordBlog") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordBlog = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordBlog = sprintf("&totalRows_RecordBlog=%d%s", $totalRows_RecordBlog, $queryString_RecordBlog);

?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/blog_view.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordBlog);
?>