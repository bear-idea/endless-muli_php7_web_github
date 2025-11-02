<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($page,$totalPages_RecordProject,$prev_RecordProject,$next_RecordProject,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordProject,$totalRows_RecordProject;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($page<=$totalPages_RecordProject && $page>=0)
	{
		if ($page > ceil($max_links/2))
		{
			$fgp = $page - ceil($max_links/2) > 0 ? $page - ceil($max_links/2) : 1;
			$egp = $page + ceil($max_links/2);
			if ($egp >= $totalPages_RecordProject)
			{
				$egp = $totalPages_RecordProject+1;
				$fgp = $totalPages_RecordProject - ($max_links-1) > 0 ? $totalPages_RecordProject  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordProject >= $max_links ? $max_links : $totalPages_RecordProject+1;
		}
		if($totalPages_RecordProject >= 1) {
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
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordProject</a>" :  "<span>$prev_RecordProject</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordProject) + 1;
					$max_l = ($a*$maxRows_RecordProject >= $totalRows_RecordProject) ? $totalRows_RecordProject : ($a*$maxRows_RecordProject);
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
			$offset_end = $totalPages_RecordProject;
			$lastArray = ($page < $totalPages_RecordProject) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordProject</a>" : "<span>$next_RecordProject</span>"; /* css */
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

$collang_RecordProjectListType = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordProjectListType = $_GET['lang'];
}
$coluserid_RecordProjectListType = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordProjectListType = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProjectListType = sprintf("SELECT * FROM demo_projectitem WHERE list_id = 1 && lang = %s && userid=%s", GetSQLValueString($collang_RecordProjectListType, "text"),GetSQLValueString($coluserid_RecordProjectListType, "int"));
$RecordProjectListType = mysqli_query($DB_Conn, $query_RecordProjectListType) or die(mysqli_error($DB_Conn));
$row_RecordProjectListType = mysqli_fetch_assoc($RecordProjectListType);
$totalRows_RecordProjectListType = mysqli_num_rows($RecordProjectListType);

$maxRows_RecordProject = 10;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordProject = $page * $maxRows_RecordProject;

$collang_RecordProject = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordProject = $_GET['lang'];
}
$coluserid_RecordProject = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordProject = $_SESSION['userid'];
}
$coltype_RecordProject = "%";
if (isset($_GET['type'])) {
  $coltype_RecordProject = $_GET['type'];
}
$colname_RecordProject = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordProject = $_GET['searchkey'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProject = sprintf("SELECT demo_projectalbum.act_id, demo_projectalbum.userid, demo_projectalbum.title, demo_projectalbum.type, demo_projectalbum.sdescription, demo_projectalbum.indicate, demo_projectalbum.author, demo_projectalbum.postdate, demo_projectalbumphoto.pic, demo_projectalbumphoto.actphoto_id, demo_projectalbum.lang, count(demo_projectalbumphoto.act_id) AS photonum FROM demo_projectalbum LEFT OUTER JOIN demo_projectalbumphoto ON demo_projectalbum.act_id = demo_projectalbumphoto.act_id GROUP BY demo_projectalbum.act_id HAVING (demo_projectalbum.lang = %s) && (demo_projectalbum.type LIKE %s) && ((demo_projectalbum.title LIKE %s) || (demo_projectalbum.postdate LIKE %s) || (demo_projectalbum.author LIKE %s)) && demo_projectalbum.indicate=1 && demo_projectalbum.userid=%s ORDER BY demo_projectalbum.sortid ASC, demo_projectalbum.act_id DESC", GetSQLValueString($collang_RecordProject, "text"),GetSQLValueString("%" . $coltype_RecordProject . "%", "text"),GetSQLValueString("%" . $colname_RecordProject . "%", "text"),GetSQLValueString("%" . $colname_RecordProject . "%", "text"),GetSQLValueString("%" . $colname_RecordProject . "%", "text"),GetSQLValueString($coluserid_RecordProject, "int"));
$query_limit_RecordProject = sprintf("%s LIMIT %d, %d", $query_RecordProject, $startRow_RecordProject, $maxRows_RecordProject);
$RecordProject = mysqli_query($DB_Conn, $query_limit_RecordProject) or die(mysqli_error($DB_Conn));
$row_RecordProject = mysqli_fetch_assoc($RecordProject);

if (isset($_GET['totalRows_RecordProject'])) {
  $totalRows_RecordProject = $_GET['totalRows_RecordProject'];
} else {
  $all_RecordProject = mysqli_query($DB_Conn, $query_RecordProject);
  $totalRows_RecordProject = mysqli_num_rows($all_RecordProject);
}
$totalPages_RecordProject = ceil($totalRows_RecordProject/$maxRows_RecordProject)-1;

$queryString_RecordProject = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordProject") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordProject = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordProject = sprintf("&totalRows_RecordProject=%d%s", $totalRows_RecordProject, $queryString_RecordProject);
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/project_view.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordProject);

mysqli_free_result($RecordProjectListType);
?>
