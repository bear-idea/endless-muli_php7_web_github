<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($page,$totalPages_RecordVideo,$prev_RecordVideo,$next_RecordVideo,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordVideo,$totalRows_RecordVideo;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($page<=$totalPages_RecordVideo && $page>=0)
	{
		if ($page > ceil($max_links/2))
		{
			$fgp = $page - ceil($max_links/2) > 0 ? $page - ceil($max_links/2) : 1;
			$egp = $page + ceil($max_links/2);
			if ($egp >= $totalPages_RecordVideo)
			{
				$egp = $totalPages_RecordVideo+1;
				$fgp = $totalPages_RecordVideo - ($max_links-1) > 0 ? $totalPages_RecordVideo  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordVideo >= $max_links ? $max_links : $totalPages_RecordVideo+1;
		}
		if($totalPages_RecordVideo >= 1) {
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
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordVideo</a>" :  "<span>$prev_RecordVideo</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordVideo) + 1;
					$max_l = ($a*$maxRows_RecordVideo >= $totalRows_RecordVideo) ? $totalRows_RecordVideo : ($a*$maxRows_RecordVideo);
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
			$offset_end = $totalPages_RecordVideo;
			$lastArray = ($page < $totalPages_RecordVideo) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordVideo</a>" : "<span>$next_RecordVideo</span>"; /* css */
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

$maxRows_RecordVideo = 24;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordVideo = $page * $maxRows_RecordVideo;

$colname_RecordVideo = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordVideo = $_GET['searchkey'];
}
$coluserid_RecordVideo = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordVideo = $_SESSION['userid'];
}
$colnamelang_RecordVideo = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordVideo = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordVideo = sprintf("SELECT * FROM demo_video WHERE (name LIKE %s || type LIKE %s) && lang = %s && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordVideo . "%", "text"),GetSQLValueString("%" . $colname_RecordVideo . "%", "text"),GetSQLValueString($colnamelang_RecordVideo, "text"),GetSQLValueString($coluserid_RecordVideo, "int"));
$query_limit_RecordVideo = sprintf("%s LIMIT %d, %d", $query_RecordVideo, $startRow_RecordVideo, $maxRows_RecordVideo);
$RecordVideo = mysqli_query($DB_Conn, $query_limit_RecordVideo) or die(mysqli_error($DB_Conn));
$row_RecordVideo = mysqli_fetch_assoc($RecordVideo);

if (isset($_GET['totalRows_RecordVideo'])) {
  $totalRows_RecordVideo = $_GET['totalRows_RecordVideo'];
} else {
  $all_RecordVideo = mysqli_query($DB_Conn, $query_RecordVideo);
  $totalRows_RecordVideo = mysqli_num_rows($all_RecordVideo);
}
$totalPages_RecordVideo = ceil($totalRows_RecordVideo/$maxRows_RecordVideo)-1;

$queryString_RecordVideo = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordVideo") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordVideo = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordVideo = sprintf("&totalRows_RecordVideo=%d%s", $totalRows_RecordVideo, $queryString_RecordVideo);


?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/video_view.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordVideo);
?>
