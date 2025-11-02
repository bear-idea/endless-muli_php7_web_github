<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($page,$totalPages_RecordNews,$prev_RecordNews,$next_RecordNews,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordNews,$totalRows_RecordNews;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($page<=$totalPages_RecordNews && $page>=0)
	{
		if ($page > ceil($max_links/2))
		{
			$fgp = $page - ceil($max_links/2) > 0 ? $page - ceil($max_links/2) : 1;
			$egp = $page + ceil($max_links/2);
			if ($egp >= $totalPages_RecordNews)
			{
				$egp = $totalPages_RecordNews+1;
				$fgp = $totalPages_RecordNews - ($max_links-1) > 0 ? $totalPages_RecordNews  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordNews >= $max_links ? $max_links : $totalPages_RecordNews+1;
		}
		if($totalPages_RecordNews >= 1) {
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
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordNews</a>" :  "<span>$prev_RecordNews</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordNews) + 1;
					$max_l = ($a*$maxRows_RecordNews >= $totalRows_RecordNews) ? $totalRows_RecordNews : ($a*$maxRows_RecordNews);
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
			$offset_end = $totalPages_RecordNews;
			$lastArray = ($page < $totalPages_RecordNews) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordNews</a>" : "<span>$next_RecordNews</span>"; /* css */
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

$maxRows_RecordNews = 24;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordNews = $page * $maxRows_RecordNews;

$colname_RecordNews = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordNews = $_GET['searchkey'];
}
$coluserid_RecordNews = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordNews = $_SESSION['userid'];
}
$collang_RecordNews = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordNews = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNews = sprintf("SELECT * FROM demo_news WHERE (type LIKE %s) && (indicate=1) && (lang = %s)  && userid=%s ORDER BY pushtop DESC, sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordNews . "%", "text"),GetSQLValueString($collang_RecordNews, "text"),GetSQLValueString($coluserid_RecordNews, "int"));
$query_limit_RecordNews = sprintf("%s LIMIT %d, %d", $query_RecordNews, $startRow_RecordNews, $maxRows_RecordNews);
$RecordNews = mysqli_query($DB_Conn, $query_limit_RecordNews) or die(mysqli_error($DB_Conn));
$row_RecordNews = mysqli_fetch_assoc($RecordNews);

/*$sql = 'SELECT * FROM demo_news WHERE indicate=1 AND userid = :userid';
$statement = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$statement->execute(array(':userid' => $coluserid_RecordNews));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $row) 
		{
			echo $row['title'];
		}

*/

if (isset($_GET['totalRows_RecordNews'])) {
  $totalRows_RecordNews = $_GET['totalRows_RecordNews'];
} else {
  $all_RecordNews = mysqli_query($DB_Conn, $query_RecordNews);
  $totalRows_RecordNews = mysqli_num_rows($all_RecordNews);
}
$totalPages_RecordNews = ceil($totalRows_RecordNews/$maxRows_RecordNews)-1;

$queryString_RecordNews = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordNews") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordNews = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordNews = sprintf("&totalRows_RecordNews=%d%s", $totalRows_RecordNews, $queryString_RecordNews);
?>
<?php if ($MSTMP == 'default') { ?>
<?php } else { ?>
<?php include($TplPath . "/news_view.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordNews);
?>
