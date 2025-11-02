<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($page,$totalPages_RecordAttractions,$prev_RecordAttractions,$next_RecordAttractions,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordAttractions,$totalRows_RecordAttractions;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($page<=$totalPages_RecordAttractions && $page>=0)
	{
		if ($page > ceil($max_links/2))
		{
			$fgp = $page - ceil($max_links/2) > 0 ? $page - ceil($max_links/2) : 1;
			$egp = $page + ceil($max_links/2);
			if ($egp >= $totalPages_RecordAttractions)
			{
				$egp = $totalPages_RecordAttractions+1;
				$fgp = $totalPages_RecordAttractions - ($max_links-1) > 0 ? $totalPages_RecordAttractions  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordAttractions >= $max_links ? $max_links : $totalPages_RecordAttractions+1;
		}
		if($totalPages_RecordAttractions >= 1) {
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
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordAttractions</a>" :  "<span>$prev_RecordAttractions</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordAttractions) + 1;
					$max_l = ($a*$maxRows_RecordAttractions >= $totalRows_RecordAttractions) ? $totalRows_RecordAttractions : ($a*$maxRows_RecordAttractions);
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
			$offset_end = $totalPages_RecordAttractions;
			$lastArray = ($page < $totalPages_RecordAttractions) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordAttractions</a>" : "<span>$next_RecordAttractions</span>"; /* css */
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

$maxRows_RecordAttractions = 24;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordAttractions = $page * $maxRows_RecordAttractions;

$colname_RecordAttractions = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordAttractions = $_GET['searchkey'];
}
$coluserid_RecordAttractions = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordAttractions = $_SESSION['userid'];
}
$colnamelang_RecordAttractions = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordAttractions = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAttractions = sprintf("SELECT * FROM demo_attractions WHERE (name LIKE %s || type LIKE %s) && lang = %s && userid=%s && view != 2 ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordAttractions . "%", "text"),GetSQLValueString("%" . $colname_RecordAttractions . "%", "text"),GetSQLValueString($colnamelang_RecordAttractions, "text"),GetSQLValueString($coluserid_RecordAttractions, "int"));
$query_limit_RecordAttractions = sprintf("%s LIMIT %d, %d", $query_RecordAttractions, $startRow_RecordAttractions, $maxRows_RecordAttractions);
$RecordAttractions = mysqli_query($DB_Conn, $query_limit_RecordAttractions) or die(mysqli_error($DB_Conn));
$row_RecordAttractions = mysqli_fetch_assoc($RecordAttractions);

if (isset($_GET['totalRows_RecordAttractions'])) {
  $totalRows_RecordAttractions = $_GET['totalRows_RecordAttractions'];
} else {
  $all_RecordAttractions = mysqli_query($DB_Conn, $query_RecordAttractions);
  $totalRows_RecordAttractions = mysqli_num_rows($all_RecordAttractions);
}
$totalPages_RecordAttractions = ceil($totalRows_RecordAttractions/$maxRows_RecordAttractions)-1;

$coluserid_RecordAttractionsMap = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordAttractionsMap = $_SESSION['userid'];
}
$colnamelang_RecordAttractionsMap = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordAttractionsMap = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAttractionsMap = sprintf("SELECT * FROM demo_attractions WHERE lang = %s && userid=%s && view != 3 ORDER BY sortid ASC, id DESC", GetSQLValueString($colnamelang_RecordAttractionsMap, "text"),GetSQLValueString($coluserid_RecordAttractionsMap, "int"));
$RecordAttractionsMap = mysqli_query($DB_Conn, $query_RecordAttractionsMap) or die(mysqli_error($DB_Conn));
$row_RecordAttractionsMap = mysqli_fetch_assoc($RecordAttractionsMap);
$totalRows_RecordAttractionsMap = mysqli_num_rows($RecordAttractionsMap);

$colname_RecordContactMail = "-1";
if (isset($_SESSION['userid'])) {
  $colname_RecordContactMail = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordContactMail = sprintf("SELECT id, userid, SiteMail, SiteAuthor, contacttitle, contacttitleindicate, contactdesc, contactcontent, SiteSName, SiteAddr, SiteAddrX, SiteAddrY, SiteDecsHome, googlemapindicate, SitePhone, SiteCell, SiteFax FROM demo_setting_fr WHERE userid = %s", GetSQLValueString($colname_RecordContactMail, "int"));
$RecordContactMail = mysqli_query($DB_Conn, $query_RecordContactMail) or die(mysqli_error($DB_Conn));
$row_RecordContactMail = mysqli_fetch_assoc($RecordContactMail);
$totalRows_RecordContactMail = mysqli_num_rows($RecordContactMail);

$queryString_RecordAttractions = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordAttractions") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordAttractions = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordAttractions = sprintf("&totalRows_RecordAttractions=%d%s", $totalRows_RecordAttractions, $queryString_RecordAttractions);


?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/attractions_view.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordAttractions);

mysqli_free_result($RecordAttractionsMap);

mysqli_free_result($RecordContactMail);
?>
