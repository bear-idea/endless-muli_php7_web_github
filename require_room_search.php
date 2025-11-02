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
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordRoom</a>" :  "<span>$prev_RecordRoom</span>";/* css */
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
					$pagesArray .= "<span>"; /* css */
					$pagesArray .= "$textLink</span>"  . ($theNext < $egp-1 ? $separator : "");
				}
			}
			$theNext = $page+1;
			$offset_end = $totalPages_RecordRoom;
			$lastArray = ($page < $totalPages_RecordRoom) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordRoom</a>" : "<span>$next_RecordRoom</span>"; /* css */
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

$maxRows_RecordRoom = 24;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordRoom = $page * $maxRows_RecordRoom;

$colname_RecordRoom = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordRoom = $_GET['searchkey'];
}
$coltag_RecordRoom = "-1";
if (isset($_GET['tag'])) {
  $coltag_RecordRoom = $_GET['tag'];
}
$coluserid_RecordRoom = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordRoom = $_SESSION['userid'];
}
$coltype1_RecordRoom = "%";
if (isset($_GET['type1'])) {
  $coltype1_RecordRoom = $_GET['type1'];
}
$coltype2_RecordRoom = "%";
if (isset($_GET['type2'])) {
  $coltype2_RecordRoom = $_GET['type2'];
}
$coltype3_RecordRoom = "%";
if (isset($_GET['type3'])) {
  $coltype3_RecordRoom = $_GET['type3'];
}
$colnamelang_RecordRoom = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordRoom = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordRoom = sprintf("SELECT * FROM demo_room WHERE ((name LIKE %s) || (pdseries LIKE %s)) && lang = %s && type1 LIKE %s && type2 LIKE %s && type3 LIKE %s && indicate = 1&& userid=%s && indicate=1 && skeyword LIKE %s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordRoom . "%", "text"),GetSQLValueString("%" . $colname_RecordRoom . "%", "text"),GetSQLValueString($colnamelang_RecordRoom, "text"),GetSQLValueString($coltype1_RecordRoom, "text"),GetSQLValueString($coltype2_RecordRoom, "text"),GetSQLValueString($coltype3_RecordRoom, "text"),GetSQLValueString($coluserid_RecordRoom, "int"),GetSQLValueString("%" . $coltag_RecordRoom . "%", "text"));
$RecordRoom = mysqli_query($DB_Conn, $query_RecordRoom) or die(mysqli_error($DB_Conn));
$row_RecordRoom = mysqli_fetch_assoc($RecordRoom);
$totalRows_RecordRoom = mysqli_num_rows($RecordRoom);

$queryString_RecordRoom = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordRoom") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordRoom = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordRoom = sprintf("&totalRows_RecordRoom=%d%s", $totalRows_RecordRoom, $queryString_RecordRoom);


?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/room_view.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordRoom);
?>