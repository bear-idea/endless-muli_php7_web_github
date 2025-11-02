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

$maxRows_RecordSiteLocation = 100;
$pageLocation = 0;
if (isset($_GET['pageLocation'])) {
  $pageLocation = $_GET['pageLocation'];
}
$startRow_RecordSiteLocation = $pageLocation * $maxRows_RecordSiteLocation;

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSiteLocation = "SELECT demo_admin.id, demo_admin.name, demo_admin.webname, demo_admin.hot, demo_setting_fr.SiteDecsHome, demo_setting_fr.userid, demo_setting_fr.SiteFBShowImage, demo_setting_fr.SiteIndicate, demo_setting_fr.SiteAddrX, demo_setting_fr.SiteAddrY, demo_setting_fr.SiteName FROM demo_admin LEFT OUTER JOIN demo_setting_fr ON demo_admin.id = demo_setting_fr.userid WHERE demo_setting_fr.SiteIndicate=1 && (demo_setting_fr.SiteAddrX!=NULL || demo_setting_fr.SiteAddrX!=0) ORDER BY demo_admin.hot DESC, demo_admin.id DESC";
$query_limit_RecordSiteLocation = sprintf("%s LIMIT %d, %d", $query_RecordSiteLocation, $startRow_RecordSiteLocation, $maxRows_RecordSiteLocation);
$RecordSiteLocation = mysqli_query($DB_Conn, $query_limit_RecordSiteLocation) or die(mysqli_error($DB_Conn));
$row_RecordSiteLocation = mysqli_fetch_assoc($RecordSiteLocation);

if (isset($_GET['totalRows_RecordSiteLocation'])) {
  $totalRows_RecordSiteLocation = $_GET['totalRows_RecordSiteLocation'];
} else {
  $all_RecordSiteLocation = mysqli_query($DB_Conn, $query_RecordSiteLocation);
  $totalRows_RecordSiteLocation = mysqli_num_rows($all_RecordSiteLocation);
}
$totalPages_RecordSiteLocation = ceil($totalRows_RecordSiteLocation/$maxRows_RecordSiteLocation)-1;

$queryString_RecordSiteLocation = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageLocation") == false && 
        stristr($param, "totalRows_RecordSiteLocation") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordSiteLocation = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordSiteLocation = sprintf("&totalRows_RecordSiteLocation=%d%s", $totalRows_RecordSiteLocation, $queryString_RecordSiteLocation);
?>
<script src="http://maps.google.com/maps/api/js?sensor=false&key=<?php echo $GoogleMapAPICode; ?>" type="text/javascript"></script>
<script type="text/javascript" src="js/jQuery.bMap.1.3.1.min.js"></script>
<style type="text/css">
<!--
	#map{ width:502px;height:400px;float:left }
	#sideBar{ overflow:auto; width:215px;height:380px;text-align:center;background:#fff;float:right }
	#sideBar div{ padding:2px 0; cursor:pointer }
	#sideBar div:hover{ text-decoration:underline }
	#buttons{ clear:both;text-align:center }
	.bSideSelect{ background:#FEEBCF; } /* clicked items get this class */
-->
</style>
<?php $SiteCounter=1; ?>
<script type="text/javascript">
$(document).ready(function(){ 
	$("#map").bMap({
		mapZoom: 9,
		mapCenter:[24.2332076,120.94173679999994],
		mapSidebar:"sideBar", //id of the div to use as the sidebar
		markers:{"data":[<?php do { ?>{"lat":"<?php echo $row_RecordSiteLocation['SiteAddrX']; ?>","lng":"<?php echo $row_RecordSiteLocation['SiteAddrY']; ?>","title":"<?php echo $row_RecordSiteLocation['SiteName']; ?> <a href=\"<?php echo $row_RecordSiteLocation['webname'];?>\" target=\"_blank\" ><img src=\"images/googlemap/ftype_blog.png\" width=\"26\" height=\"16\" /></a>","rnd":"1","body":"<div style=\"width:350px\"><?php echo DeleteSpace($row_RecordSiteLocation['SiteDecsHome']); ?></div>"}<?php if ($totalRows_RecordSiteLocation > $SiteCounter) { echo ","; }?><?php $SiteCounter++; ?><?php } while ($row_RecordSiteLocation = mysqli_fetch_assoc($RecordSiteLocation)); ?>
		]}
	});
});
<?php //echo $totalRows_RecordSiteLocation ?>
</script>
<div style="background: #fff; border: 4px solid #fff; position: relative; -webkit-border-radius: 4px; -moz-border-radius: 4px; -o-border-radius: 4px; border-radius: 4px; box-shadow: 0 1px 4px rgba(0,0,0,.2); -webkit-box-shadow: 0 1px 4px rgba(0,0,0,.2); -moz-box-shadow: 0 1px 4px rgba(0,0,0,.2); -o-box-shadow: 0 1px 4px rgba(0,0,0,.2); width:722px;  text-align:center; margin-bottom:20px; height:400px;">
	<div id="map"></div>
        <div class="PageSelectBoard" style="height:20px; margin:0px;"><?php if ($pageLocation > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageLocation=%d%s", $currentPage, 0, $queryString_RecordSiteLocation); ?>">‹‹</a>
            <?php } // Show if not first page ?>
        <?php if ($pageLocation > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageLocation=%d%s", $currentPage, max(0, $pageLocation - 1), $queryString_RecordSiteLocation); ?>">‹</a>
            <?php } // Show if not first page ?>
       <?php if ($pageLocation < $totalPages_RecordSiteLocation) { // Show if not last page ?>
            <a href="<?php printf("%s?pageLocation=%d%s", $currentPage, min($totalPages_RecordSiteLocation, $pageLocation + 1), $queryString_RecordSiteLocation); ?>">›</a>
            <?php } // Show if not last page ?></td>
        <?php if ($pageLocation < $totalPages_RecordSiteLocation) { // Show if not last page ?>
            <a href="<?php printf("%s?pageLocation=%d%s", $currentPage, $totalPages_RecordSiteLocation, $queryString_RecordSiteLocation); ?>">››</a>
            <?php } // Show if not last page ?></td>
       </div>
   <div id="sideBar" class="Scroll_Bar"></div>
</div>
<?php
mysqli_free_result($RecordSiteLocation);
?>
