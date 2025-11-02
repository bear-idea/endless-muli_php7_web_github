<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($pageMessage,$totalPages_RecordGuestbookMessage,$prev_RecordGuestbookMessage,$next_RecordGuestbookMessage,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordGuestbookMessage,$totalRows_RecordGuestbookMessage;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($pageMessage<=$totalPages_RecordGuestbookMessage && $pageMessage>=0)
	{
		if ($pageMessage > ceil($max_links/2))
		{
			$fgp = $pageMessage - ceil($max_links/2) > 0 ? $pageMessage - ceil($max_links/2) : 1;
			$egp = $pageMessage + ceil($max_links/2);
			if ($egp >= $totalPages_RecordGuestbookMessage)
			{
				$egp = $totalPages_RecordGuestbookMessage+1;
				$fgp = $totalPages_RecordGuestbookMessage - ($max_links-1) > 0 ? $totalPages_RecordGuestbookMessage  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordGuestbookMessage >= $max_links ? $max_links : $totalPages_RecordGuestbookMessage+1;
		}
		if($totalPages_RecordGuestbookMessage >= 1) {
			#	------------------------
			#	Searching for $_GET vars
			#	------------------------
			$_get_vars = '';			
			if(!empty($_GET) || !empty($HTTP_GET_VARS)){
				$_GET = empty($_GET) ? $HTTP_GET_VARS : $_GET;
				foreach ($_GET as $_get_name => $_get_value) {
					if ($_get_name != "pageMessage") {
						if(is_array($_get_value)){
							$_get_vars .= "&$_get_name=" . urlencode(serialize($_get_value));
							}else {
							$_get_vars .= "&$_get_name=" . urlencode("$_get_value");
						}
					}
				}
			}
			$successivo = $pageMessage+1;
			$precedente = $pageMessage-1;
			$firstArray = ($pageMessage > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pageMessage=$precedente$_get_vars\">$prev_RecordGuestbookMessage</a>" :  "<span>$prev_RecordGuestbookMessage</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordGuestbookMessage) + 1;
					$max_l = ($a*$maxRows_RecordGuestbookMessage >= $totalRows_RecordGuestbookMessage) ? $totalRows_RecordGuestbookMessage : ($a*$maxRows_RecordGuestbookMessage);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageMessage)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageMessage=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "<span>"; /* css */
					$pagesArray .= "$textLink</span>"  . ($theNext < $egp-1 ? $separator : "");
				}
			}
			$theNext = $pageMessage+1;
			$offset_end = $totalPages_RecordGuestbookMessage;
			$lastArray = ($pageMessage < $totalPages_RecordGuestbookMessage) ? "<a href=\"$_SERVER[PHP_SELF]?pageMessage=$successivo$_get_vars\">$next_RecordGuestbookMessage</a>" : "<span>$next_RecordGuestbookMessage</span>"; /* css */
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

$maxRows_RecordGuestbookMessage = 15;
$pageMessage = 0;
if (isset($_GET['pageMessage'])) {
  $pageMessage = $_GET['pageMessage'];
}
$startRow_RecordGuestbookMessage = $pageMessage * $maxRows_RecordGuestbookMessage;

$colname_RecordGuestbookMessage = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordGuestbookMessage = $_GET['lang'];
}
$coluserid_RecordGuestbookMessage = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordGuestbookMessage = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordGuestbookMessage = sprintf("SELECT * FROM demo_guestbookmessage WHERE lang = %s && userid=%s ORDER BY message_id DESC", GetSQLValueString($colname_RecordGuestbookMessage, "text"),GetSQLValueString($coluserid_RecordGuestbookMessage, "int"));
$query_limit_RecordGuestbookMessage = sprintf("%s LIMIT %d, %d", $query_RecordGuestbookMessage, $startRow_RecordGuestbookMessage, $maxRows_RecordGuestbookMessage);
$RecordGuestbookMessage = mysqli_query($DB_Conn, $query_limit_RecordGuestbookMessage) or die(mysqli_error($DB_Conn));
$row_RecordGuestbookMessage = mysqli_fetch_assoc($RecordGuestbookMessage);

if (isset($_GET['totalRows_RecordGuestbookMessage'])) {
  $totalRows_RecordGuestbookMessage = $_GET['totalRows_RecordGuestbookMessage'];
} else {
  $all_RecordGuestbookMessage = mysqli_query($DB_Conn, $query_RecordGuestbookMessage);
  $totalRows_RecordGuestbookMessage = mysqli_num_rows($all_RecordGuestbookMessage);
}
$totalPages_RecordGuestbookMessage = ceil($totalRows_RecordGuestbookMessage/$maxRows_RecordGuestbookMessage)-1;

$queryString_RecordGuestbookMessage = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageMessage") == false && 
        stristr($param, "totalRows_RecordGuestbookMessage") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordGuestbookMessage = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordGuestbookMessage = sprintf("&totalRows_RecordGuestbookMessage=%d%s", $totalRows_RecordGuestbookMessage, $queryString_RecordGuestbookMessage);
?>
<?php 
  switch($_GET['Operate']) 
  {
	  case "addSuccess":
		echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('" . $Lang_Post_Message_Guestbook . "','success');});</script>\n";
		break;
	  case "TimeOut":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('" . $Lang_Post_Message_Guestbook_TimeOut . "','warning');});</script>\n";
		break;
	  case "CheckError":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('" . $Lang_Post_Message_Guestbook_CheckError . "','warning');});</script>\n";
		break;
	  default:
		break;
  }
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/guestbook_view.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordGuestbookMessage);
?>
