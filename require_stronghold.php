<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($page,$totalPages_RecordStronghold,$prev_RecordStronghold,$next_RecordStronghold,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordStronghold,$totalRows_RecordStronghold;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($page<=$totalPages_RecordStronghold && $page>=0)
	{
		if ($page > ceil($max_links/2))
		{
			$fgp = $page - ceil($max_links/2) > 0 ? $page - ceil($max_links/2) : 1;
			$egp = $page + ceil($max_links/2);
			if ($egp >= $totalPages_RecordStronghold)
			{
				$egp = $totalPages_RecordStronghold+1;
				$fgp = $totalPages_RecordStronghold - ($max_links-1) > 0 ? $totalPages_RecordStronghold  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordStronghold >= $max_links ? $max_links : $totalPages_RecordStronghold+1;
		}
		if($totalPages_RecordStronghold >= 1) {
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
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordStronghold</a>" :  "<span>$prev_RecordStronghold</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordStronghold) + 1;
					$max_l = ($a*$maxRows_RecordStronghold >= $totalRows_RecordStronghold) ? $totalRows_RecordStronghold : ($a*$maxRows_RecordStronghold);
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
			$offset_end = $totalPages_RecordStronghold;
			$lastArray = ($page < $totalPages_RecordStronghold) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordStronghold</a>" : "<span>$next_RecordStronghold</span>"; /* css */
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

$maxRows_RecordStronghold = 24;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordStronghold = $page * $maxRows_RecordStronghold;

$colname_RecordStronghold = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordStronghold = $_GET['searchkey'];
}
$coluserid_RecordStronghold = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordStronghold = $_SESSION['userid'];
}
$colnamelang_RecordStronghold = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordStronghold = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordStronghold = sprintf("SELECT * FROM demo_stronghold WHERE (name LIKE %s || type LIKE %s) && lang = %s && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordStronghold . "%", "text"),GetSQLValueString("%" . $colname_RecordStronghold . "%", "text"),GetSQLValueString($colnamelang_RecordStronghold, "text"),GetSQLValueString($coluserid_RecordStronghold, "int"));
$query_limit_RecordStronghold = sprintf("%s LIMIT %d, %d", $query_RecordStronghold, $startRow_RecordStronghold, $maxRows_RecordStronghold);
$RecordStronghold = mysqli_query($DB_Conn, $query_limit_RecordStronghold) or die(mysqli_error($DB_Conn));
$row_RecordStronghold = mysqli_fetch_assoc($RecordStronghold);

if (isset($_GET['totalRows_RecordStronghold'])) {
  $totalRows_RecordStronghold = $_GET['totalRows_RecordStronghold'];
} else {
  $all_RecordStronghold = mysqli_query($DB_Conn, $query_RecordStronghold);
  $totalRows_RecordStronghold = mysqli_num_rows($all_RecordStronghold);
}
$totalPages_RecordStronghold = ceil($totalRows_RecordStronghold/$maxRows_RecordStronghold)-1;

$coluserid_RecordStrongholdMap = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordStrongholdMap = $_SESSION['userid'];
}
$colnamelang_RecordStrongholdMap = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordStrongholdMap = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordStrongholdMap = sprintf("SELECT * FROM demo_stronghold WHERE lang = %s && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString($colnamelang_RecordStrongholdMap, "text"),GetSQLValueString($coluserid_RecordStrongholdMap, "int"));
$RecordStrongholdMap = mysqli_query($DB_Conn, $query_RecordStrongholdMap) or die(mysqli_error($DB_Conn));
$row_RecordStrongholdMap = mysqli_fetch_assoc($RecordStrongholdMap);
$totalRows_RecordStrongholdMap = mysqli_num_rows($RecordStrongholdMap);

$queryString_RecordStronghold = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordStronghold") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordStronghold = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordStronghold = sprintf("&totalRows_RecordStronghold=%d%s", $totalRows_RecordStronghold, $queryString_RecordStronghold);


?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/stronghold_view.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordStronghold);

mysqli_free_result($RecordStrongholdMap);
?>
