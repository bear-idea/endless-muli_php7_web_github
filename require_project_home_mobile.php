<?php require_once('Connections/DB_Conn.php'); ?>
<?php
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

$maxRows_RecordProject = 6;
$pageNum_RecordProject = 0;
if (isset($_GET['pageNum_RecordProject'])) {
  $pageNum_RecordProject = $_GET['pageNum_RecordProject'];
}
$startRow_RecordProject = $pageNum_RecordProject * $maxRows_RecordProject;

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
$query_RecordProject = sprintf("SELECT demo_projectalbum.act_id, demo_projectalbum.userid, demo_projectalbum.title, demo_projectalbum.type, demo_projectalbum.sdescription, demo_projectalbum.indicate, demo_projectalbum.author, demo_projectalbum.postdate, demo_projectalbumphoto.pic, demo_projectalbumphoto.actphoto_id, demo_projectalbum.lang, count(demo_projectalbumphoto.act_id) AS photonum FROM demo_projectalbum LEFT OUTER JOIN demo_projectalbumphoto ON demo_projectalbum.act_id = demo_projectalbumphoto.act_id GROUP BY demo_projectalbum.act_id HAVING (demo_projectalbum.lang = %s) && (demo_projectalbum.type LIKE %s) && ((demo_projectalbum.title LIKE %s) || (demo_projectalbum.postdate LIKE %s) || (demo_projectalbum.author LIKE %s)) && demo_projectalbum.userid=%s ORDER BY demo_projectalbum.sortid ASC, demo_projectalbum.act_id DESC", GetSQLValueString($collang_RecordProject, "text"),GetSQLValueString("%" . $coltype_RecordProject . "%", "text"),GetSQLValueString("%" . $colname_RecordProject . "%", "text"),GetSQLValueString("%" . $colname_RecordProject . "%", "text"),GetSQLValueString("%" . $colname_RecordProject . "%", "text"),GetSQLValueString($coluserid_RecordProject, "int"));
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

$queryString_RecordProject = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecordProject") == false && 
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
<?php include($TplPath . "/project_home_mobile.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordProject);

mysqli_free_result($RecordProjectListType);
?>
