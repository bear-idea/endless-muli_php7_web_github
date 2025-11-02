<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($page,$totalPages_RecordArtlist,$prev_RecordArtlist,$next_RecordArtlist,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordArtlist,$totalRows_RecordArtlist;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($page<=$totalPages_RecordArtlist && $page>=0)
	{
		if ($page > ceil($max_links/2))
		{
			$fgp = $page - ceil($max_links/2) > 0 ? $page - ceil($max_links/2) : 1;
			$egp = $page + ceil($max_links/2);
			if ($egp >= $totalPages_RecordArtlist)
			{
				$egp = $totalPages_RecordArtlist+1;
				$fgp = $totalPages_RecordArtlist - ($max_links-1) > 0 ? $totalPages_RecordArtlist  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordArtlist >= $max_links ? $max_links : $totalPages_RecordArtlist+1;
		}
		if($totalPages_RecordArtlist >= 1) {
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
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordArtlist</a>" :  "<span>$prev_RecordArtlist</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordArtlist) + 1;
					$max_l = ($a*$maxRows_RecordArtlist >= $totalRows_RecordArtlist) ? $totalRows_RecordArtlist : ($a*$maxRows_RecordArtlist);
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
			$offset_end = $totalPages_RecordArtlist;
			$lastArray = ($page < $totalPages_RecordArtlist) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordArtlist</a>" : "<span>$next_RecordArtlist</span>"; /* css */
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

$maxRows_RecordArtlist = 24;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordArtlist = $page * $maxRows_RecordArtlist;

$colname_RecordArtlist = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordArtlist = $_GET['searchkey'];
}
$coluserid_RecordArtlist = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordArtlist = $_SESSION['userid'];
}
$colnamelang_RecordArtlist = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordArtlist = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordArtlist = sprintf("SELECT * FROM demo_artlist WHERE (title LIKE %s || type LIKE %s) && lang = %s && userid=%s && (indicate=1) ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordArtlist . "%", "text"),GetSQLValueString("%" . $colname_RecordArtlist . "%", "text"),GetSQLValueString($colnamelang_RecordArtlist, "text"),GetSQLValueString($coluserid_RecordArtlist, "int"));
$query_limit_RecordArtlist = sprintf("%s LIMIT %d, %d", $query_RecordArtlist, $startRow_RecordArtlist, $maxRows_RecordArtlist);
$RecordArtlist = mysqli_query($DB_Conn, $query_limit_RecordArtlist) or die(mysqli_error($DB_Conn));
$row_RecordArtlist = mysqli_fetch_assoc($RecordArtlist);

if (isset($_GET['totalRows_RecordArtlist'])) {
  $totalRows_RecordArtlist = $_GET['totalRows_RecordArtlist'];
} else {
  $all_RecordArtlist = mysqli_query($DB_Conn, $query_RecordArtlist);
  $totalRows_RecordArtlist = mysqli_num_rows($all_RecordArtlist);
}
$totalPages_RecordArtlist = ceil($totalRows_RecordArtlist/$maxRows_RecordArtlist)-1;

$queryString_RecordArtlist = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordArtlist") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordArtlist = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordArtlist = sprintf("&totalRows_RecordArtlist=%d%s", $totalRows_RecordArtlist, $queryString_RecordArtlist);


?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/artlist_view.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordArtlist);
?>
