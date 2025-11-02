<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($page,$totalPages_RecordMemberFAQ,$prev_RecordMemberFAQ,$next_RecordMemberFAQ,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordMemberFAQ,$totalRows_RecordMemberFAQ;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($page<=$totalPages_RecordMemberFAQ && $page>=0)
	{
		if ($page > ceil($max_links/2))
		{
			$fgp = $page - ceil($max_links/2) > 0 ? $page - ceil($max_links/2) : 1;
			$egp = $page + ceil($max_links/2);
			if ($egp >= $totalPages_RecordMemberFAQ)
			{
				$egp = $totalPages_RecordMemberFAQ+1;
				$fgp = $totalPages_RecordMemberFAQ - ($max_links-1) > 0 ? $totalPages_RecordMemberFAQ  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordMemberFAQ >= $max_links ? $max_links : $totalPages_RecordMemberFAQ+1;
		}
		if($totalPages_RecordMemberFAQ >= 1) {
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
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordMemberFAQ</a>" :  "<span>$prev_RecordMemberFAQ</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordMemberFAQ) + 1;
					$max_l = ($a*$maxRows_RecordMemberFAQ >= $totalRows_RecordMemberFAQ) ? $totalRows_RecordMemberFAQ : ($a*$maxRows_RecordMemberFAQ);
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
			$offset_end = $totalPages_RecordMemberFAQ;
			$lastArray = ($page < $totalPages_RecordMemberFAQ) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordMemberFAQ</a>" : "<span>$next_RecordMemberFAQ</span>"; /* css */
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

// 取得會員ID
require_once('require_member_get.php');

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecordMemberFAQ = 10;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordMemberFAQ = $page * $maxRows_RecordMemberFAQ;

$colname_RecordMemberFAQ = "-1";
if (isset($row_RecordMember['id'])) {
  $colname_RecordMemberFAQ = $row_RecordMember['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordMemberFAQ = sprintf("SELECT * FROM demo_productpost WHERE memberid = %s", GetSQLValueString($colname_RecordMemberFAQ, "int"));
$RecordMemberFAQ = mysqli_query($DB_Conn, $query_RecordMemberFAQ) or die(mysqli_error($DB_Conn));
$query_limit_RecordMemberFAQ = sprintf("%s LIMIT %d, %d", $query_RecordMemberFAQ, $startRow_RecordMemberFAQ, $maxRows_RecordMemberFAQ);
$RecordMemberFAQ = mysqli_query($DB_Conn, $query_limit_RecordMemberFAQ) or die(mysqli_error($DB_Conn));
$row_RecordMemberFAQ = mysqli_fetch_assoc($RecordMemberFAQ);

if (isset($_GET['totalRows_RecordMemberFAQ'])) {
  $totalRows_RecordMemberFAQ = $_GET['totalRows_RecordMemberFAQ'];
} else {
  $all_RecordMemberFAQ = mysqli_query($DB_Conn, $query_RecordMemberFAQ);
  $totalRows_RecordMemberFAQ = mysqli_num_rows($all_RecordMemberFAQ);
}
$totalPages_RecordMemberFAQ = ceil($totalRows_RecordMemberFAQ/$maxRows_RecordMemberFAQ)-1;

$queryString_RecordMemberFAQ = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordMemberFAQ") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordMemberFAQ = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordMemberFAQ = sprintf("&totalRows_RecordMemberFAQ=%d%s", $totalRows_RecordMemberFAQ, $queryString_RecordMemberFAQ);
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/member_faq.php"); ?>
<?php } ?>