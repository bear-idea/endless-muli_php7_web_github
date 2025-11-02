<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($page,$totalPages_RecordRoom,$prev_RecordRoom,$next_RecordRoom,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordRoom,$totalRows_RecordRoom;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($page<=$totalPages_RecordRoom && $page>=0)
	{
		if ($page > ceil($max_links/2))
		{
			$fgp = $page - ceil($max_links/2) > 0 ? $page - ceil($max_links/2) : 1;
			$egp = $page + ceil($max_links/2);
			if ($egp >= $totalPages_RecordRoom)
			{
				$egp = $totalPages_RecordRoom+1;
				$fgp = $totalPages_RecordRoom - ($max_links-1) > 0 ? $totalPages_RecordRoom  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordRoom >= $max_links ? $max_links : $totalPages_RecordRoom+1;
		}
		if($totalPages_RecordRoom >= 1) {
			#	------------------------
			#	Searching for $_GET vars
			#	------------------------
			$_get_vars = '';			
			if(!empty($_GET) || !empty($HTTP_GET_VARS)){
				$_GET = empty($_GET) ? $HTTP_GET_VARS : $_GET;
				foreach ($_GET as $_get_name => $_get_value) {
					if ($_get_name != "page") {
						$_get_vars .= "&$_get_name=$_get_value";
					}
				}
			}
			$successivo = $page+1;
			$precedente = $page-1;
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordRoom</a>" :  "$prev_RecordRoom";
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordRoom) + 1;
					$max_l = ($a*$maxRows_RecordRoom >= $totalRows_RecordRoom) ? $totalRows_RecordRoom : ($a*$maxRows_RecordRoom);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $page)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?page=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "$textLink"  . ($theNext < $egp-1 ? $separator : "");
				}
			}
			$theNext = $page+1;
			$offset_end = $totalPages_RecordRoom;
			$lastArray = ($page < $totalPages_RecordRoom) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordRoom</a>" : "$next_RecordRoom";
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

$colname_RecordRoom = "-1";
if (isset($_GET['id'])) {
  $colname_RecordRoom = $_GET['id'];
}
$coluserid_RecordRoom = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordRoom = $_SESSION['userid'];
}
$collang_RecordRoom = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordRoom = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordRoom = sprintf("SELECT * FROM demo_room WHERE id = %s && lang=%s && userid=%s", GetSQLValueString($colname_RecordRoom, "int"),GetSQLValueString($collang_RecordRoom, "text"),GetSQLValueString($coluserid_RecordRoom, "int"));
$RecordRoom = mysqli_query($DB_Conn, $query_RecordRoom) or die(mysqli_error($DB_Conn));
$row_RecordRoom = mysqli_fetch_assoc($RecordRoom);
$totalRows_RecordRoom = mysqli_num_rows($RecordRoom);

$coluserid_RecordRoomCalendarCheck = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordRoomCalendarCheck = $_SESSION['userid'];
}
$collang_RecordRoomCalendarCheck = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordRoomCalendarCheck = $_SESSION['lang'];
}
$colroomid_RecordRoomCalendarCheck = "-1";
if (isset($_GET['id'])) {
  $colroomid_RecordRoomCalendarCheck = $_GET['id'];
}
$colstartdate_RecordRoomCalendarCheck = date('Y-m-01',strtotime(date("Y-m-d")));
if (isset($_GET['startdate']) && $_GET['startdate'] != "") {
  $colstartdate_RecordRoomCalendarCheck = date('Y-m-01',strtotime($_GET['startdate']));
}else if ($_GET['YYYYdate'] != "" && $_GET['MMdate'] != ""){
  $NN_Date = $_GET['YYYYdate'] . "-" . $_GET['MMdate'] . "-01";
  $colstartdate_RecordRoomCalendarCheck = date('Y-m-01',strtotime($NN_Date));
}
$colenddate_RecordRoomCalendarCheck = date('Y-m-t',strtotime(date("Y-m-d")));;
if (isset($_GET['enddate']) && $_GET['enddate'] != "") {
  $colenddate_RecordRoomCalendarCheck = date('Y-m-t',strtotime($_GET['enddate']));
}else if ($_GET['YYYYdate'] != "" && $_GET['MMdate'] != ""){
  $NN_Date = $_GET['YYYYdate'] . "-" . $_GET['MMdate'] . "-01";
  $colenddate_RecordRoomCalendarCheck = date('Y-m-t',strtotime($NN_Date));
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordRoomCalendarCheck = sprintf("SELECT * FROM demo_roomcalendar WHERE userid = %s && lang = %s  && roomdate BETWEEN %s AND %s && roomid = %s", GetSQLValueString($coluserid_RecordRoomCalendarCheck, "int"),GetSQLValueString($collang_RecordRoomCalendarCheck, "text"),GetSQLValueString($colstartdate_RecordRoomCalendarCheck, "date"),GetSQLValueString($colenddate_RecordRoomCalendarCheck, "text"),GetSQLValueString($colroomid_RecordRoomCalendarCheck, "int"));
$RecordRoomCalendarCheck = mysqli_query($DB_Conn, $query_RecordRoomCalendarCheck) or die(mysqli_error($DB_Conn));
$row_RecordRoomCalendarCheck = mysqli_fetch_assoc($RecordRoomCalendarCheck);
$totalRows_RecordRoomCalendarCheck = mysqli_num_rows($RecordRoomCalendarCheck);

$coluserid_RecordRoomList = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordRoomList = $_SESSION['userid'];
}
$collang_RecordRoomList = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordRoomList = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordRoomList = sprintf("SELECT * FROM demo_room WHERE lang=%s && userid=%s && indicate=1", GetSQLValueString($collang_RecordRoomList, "text"),GetSQLValueString($coluserid_RecordRoomList, "int"));
$RecordRoomList = mysqli_query($DB_Conn, $query_RecordRoomList) or die(mysqli_error($DB_Conn));
$row_RecordRoomList = mysqli_fetch_assoc($RecordRoomList);
$totalRows_RecordRoomList = mysqli_num_rows($RecordRoomList);
?>
<?php 
	//$_SESSION['Room_CheckinDate']; 
?>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/room_reserve.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordRoom);

mysqli_free_result($RecordRoomCalendarCheck);

mysqli_free_result($RecordRoomList);
?>
