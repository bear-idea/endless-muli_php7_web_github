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

$maxRows_RecordActivities = 15;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordActivities = $page * $maxRows_RecordActivities;

$collang_RecordActivities = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordActivities = $_GET['lang'];
}
$coltype_RecordActivities = "%";
if (isset($_GET['type'])) {
  $coltype_RecordActivities = $_GET['type'];
}
$colname_RecordActivities = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordActivities = $_GET['searchkey'];
}
$coluserid_RecordActivities = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordActivities = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordActivities = sprintf("SELECT demo_actalbum.act_id, demo_actalbum.userid, demo_actalbum.title, demo_actalbum.type, demo_actalbum.sdescription, demo_actalbum.indicate, demo_actalbum.author, demo_actalbum.postdate, demo_actalbumphoto.pic, demo_actalbumphoto.actphoto_id, demo_actalbum.lang, count(demo_actalbumphoto.act_id) AS photonum FROM demo_actalbum LEFT OUTER JOIN demo_actalbumphoto ON demo_actalbum.act_id = demo_actalbumphoto.act_id GROUP BY demo_actalbum.act_id HAVING (demo_actalbum.lang = %s) && (demo_actalbum.type LIKE %s) && ((demo_actalbum.title LIKE %s) || (demo_actalbum.postdate LIKE %s) || (demo_actalbum.author LIKE %s)) && userid=%s ORDER BY demo_actalbum.sortid ASC, demo_actalbum.act_id DESC", GetSQLValueString($collang_RecordActivities, "text"),GetSQLValueString("%" . $coltype_RecordActivities . "%", "text"),GetSQLValueString("%" . $colname_RecordActivities . "%", "text"),GetSQLValueString("%" . $colname_RecordActivities . "%", "text"),GetSQLValueString("%" . $colname_RecordActivities . "%", "text"),GetSQLValueString($coluserid_RecordActivities, "int"));
$query_limit_RecordActivities = sprintf("%s LIMIT %d, %d", $query_RecordActivities, $startRow_RecordActivities, $maxRows_RecordActivities);
$RecordActivities = mysqli_query($DB_Conn, $query_limit_RecordActivities) or die(mysqli_error($DB_Conn));
$row_RecordActivities = mysqli_fetch_assoc($RecordActivities);

if (isset($_GET['totalRows_RecordActivities'])) {
  $totalRows_RecordActivities = $_GET['totalRows_RecordActivities'];
} else {
  $all_RecordActivities = mysqli_query($DB_Conn, $query_RecordActivities);
  $totalRows_RecordActivities = mysqli_num_rows($all_RecordActivities);
}
$totalPages_RecordActivities = ceil($totalRows_RecordActivities/$maxRows_RecordActivities)-1;

$collang_RecordActivitiesListType = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordActivitiesListType = $_GET['lang'];
}
$coluserid_RecordActivitiesListType = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordActivitiesListType = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordActivitiesListType = sprintf("SELECT * FROM demo_actitem WHERE list_id = 1 && lang = %s && userid=%s", GetSQLValueString($collang_RecordActivitiesListType, "text"),GetSQLValueString($coluserid_RecordActivitiesListType, "int"));
$RecordActivitiesListType = mysqli_query($DB_Conn, $query_RecordActivitiesListType) or die(mysqli_error($DB_Conn));
$row_RecordActivitiesListType = mysqli_fetch_assoc($RecordActivitiesListType);
$totalRows_RecordActivitiesListType = mysqli_num_rows($RecordActivitiesListType);

$queryString_RecordActivities = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordActivities") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordActivities = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordActivities = sprintf("&totalRows_RecordActivities=%d%s", $totalRows_RecordActivities, $queryString_RecordActivities);
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/activities_home_mobile.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordActivities);

mysqli_free_result($RecordActivitiesListType);
?>
