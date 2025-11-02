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

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSiteLocation = "SELECT demo_admin.id, demo_admin.name, demo_admin.webname, demo_admin.hot, demo_setting_fr.SiteDecsHome  , demo_setting_fr.userid, demo_setting_fr.SiteFBShowImage, demo_setting_fr.SiteIndicate, demo_setting_fr.SiteAddrX, demo_setting_fr.SiteAddrY FROM demo_admin LEFT OUTER JOIN demo_setting_fr ON demo_admin.id = demo_setting_fr.userid WHERE demo_setting_fr.SiteIndicate=1 ORDER BY demo_admin.hot DESC, demo_admin.id DESC";
$RecordSiteLocation = mysqli_query($DB_Conn, $query_RecordSiteLocation) or die(mysqli_error($DB_Conn));
$row_RecordSiteLocation = mysqli_fetch_assoc($RecordSiteLocation);
$totalRows_RecordSiteLocation = mysqli_num_rows($RecordSiteLocation);
?>
<script src="http://maps.google.com/maps/api/js?sensor=false&key=<?php echo $GoogleMapAPICode; ?>" type="text/javascript"></script>
<script type="text/javascript" src="js/jQuery.bMap.1.3.1.min.js"></script>
<style type="text/css">
<!--
	#map{ width:485px;height:300px;float:left }
	#sideBar{ overflow:auto; width:200px;height:300px;text-align:center;background:#fff;float:right }
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
		markers:{"data":[<?php do { ?><?php if($row_RecordSiteLocation['SiteAddrX'] != '') { ?>{"lat":"<?php echo $row_RecordSiteLocation['SiteAddrX']; ?>","lng":"<?php echo $row_RecordSiteLocation['SiteAddrY']; ?>","title":"<?php echo $row_RecordSiteLocation['name']; ?> <a href=\"<?php echo $row_RecordSite['webname'];?>\" target=\"_blank\" ><img src=\"images/googlemap/ftype_web.png\" width=\"26\" height=\"16\" /></a>","rnd":"1","body":"<?php echo $row_RecordSiteLocation['SiteDecsHome']; ?>"}<?php if ($totalRows_RecordSiteLocation >= $SiteCounter) { echo ","; } else {echo "";}?><?php } ?><?php $SiteCounter++; ?><?php } while ($row_RecordSiteLocation = mysqli_fetch_assoc($RecordSiteLocation)); ?>
		]}
	});
});
<?php //echo $totalRows_RecordSiteLocation ?>
</script>

<div style="background: #fff; border: 4px solid #fff; position: relative; -webkit-border-radius: 4px; -moz-border-radius: 4px; -o-border-radius: 4px; border-radius: 4px; box-shadow: 0 1px 4px rgba(0,0,0,.2); -webkit-box-shadow: 0 1px 4px rgba(0,0,0,.2); -moz-box-shadow: 0 1px 4px rgba(0,0,0,.2); -o-box-shadow: 0 1px 4px rgba(0,0,0,.2); width:690px;  text-align:center; margin-bottom:20px; height:300px;">
	<div id="map"></div>
	<div id="sideBar"></div>
</div>
<?php
mysqli_free_result($RecordSiteLocation);
?>
