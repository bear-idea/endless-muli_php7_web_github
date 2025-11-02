<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($pageType,$totalPages_RecordOtrlinkType,$prev_RecordOtrlinkType,$next_RecordOtrlinkType,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordOtrlinkType,$totalRows_RecordOtrlinkType;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($pageType<=$totalPages_RecordOtrlinkType && $pageType>=0)
	{
		if ($pageType > ceil($max_links/2))
		{
			$fgp = $pageType - ceil($max_links/2) > 0 ? $pageType - ceil($max_links/2) : 1;
			$egp = $pageType + ceil($max_links/2);
			if ($egp >= $totalPages_RecordOtrlinkType)
			{
				$egp = $totalPages_RecordOtrlinkType+1;
				$fgp = $totalPages_RecordOtrlinkType - ($max_links-1) > 0 ? $totalPages_RecordOtrlinkType  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordOtrlinkType >= $max_links ? $max_links : $totalPages_RecordOtrlinkType+1;
		}
		if($totalPages_RecordOtrlinkType >= 1) {
			#	------------------------
			#	Searching for $_GET vars
			#	------------------------
			$_get_vars = '';			
			if(!empty($_GET) || !empty($HTTP_GET_VARS)){
				$_GET = empty($_GET) ? $HTTP_GET_VARS : $_GET;
				foreach ($_GET as $_get_name => $_get_value) {
					if ($_get_name != "pageType") {
						if(is_array($_get_value)){
							$_get_vars .= "&$_get_name=" . urlencode(serialize($_get_value));
							}else {
							$_get_vars .= "&$_get_name=" . urlencode("$_get_value");
						}
					}
				}
			}
			$successivo = $pageType+1;
			$precedente = $pageType-1;
			$firstArray = ($pageType > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pageType=$precedente$_get_vars\">$prev_RecordOtrlinkType</a>" :  "<span>$prev_RecordOtrlinkType</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordOtrlinkType) + 1;
					$max_l = ($a*$maxRows_RecordOtrlinkType >= $totalRows_RecordOtrlinkType) ? $totalRows_RecordOtrlinkType : ($a*$maxRows_RecordOtrlinkType);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageType)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageType=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "<span>"; /* css */
					$pagesArray .= "$textLink</span>"  . ($theNext < $egp-1 ? $separator : "");
				}
			}
			$theNext = $pageType+1;
			$offset_end = $totalPages_RecordOtrlinkType;
			$lastArray = ($pageType < $totalPages_RecordOtrlinkType) ? "<a href=\"$_SERVER[PHP_SELF]?pageType=$successivo$_get_vars\">$next_RecordOtrlinkType</a>" : "<span>$next_RecordOtrlinkType</span>"; /* css */
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

$maxRows_RecordOtrlinkType = 24;
$pageType = 0;
if (isset($_GET['pageType'])) {
  $pageType = $_GET['pageType'];
}
$startRow_RecordOtrlinkType = $pageType * $maxRows_RecordOtrlinkType;

$coluserid_RecordOtrlinkType = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordOtrlinkType = $_SESSION['userid'];
}
$colitemname_RecordOtrlinkType = "%";
if (isset($_GET['searchkey'])) {
  $colitemname_RecordOtrlinkType = $_GET['searchkey'];
}
$collang_RecordOtrlinkType = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordOtrlinkType = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordOtrlinkType = sprintf("SELECT * FROM demo_otrlinkitem WHERE list_id = 1 && lang = %s && userid=%s && (itemname LIKE %s) ORDER BY item_id DESC", GetSQLValueString($collang_RecordOtrlinkType, "text"),GetSQLValueString($coluserid_RecordOtrlinkType, "int"),GetSQLValueString("%" . $colitemname_RecordOtrlinkType . "%", "text"));
$query_limit_RecordOtrlinkType = sprintf("%s LIMIT %d, %d", $query_RecordOtrlinkType, $startRow_RecordOtrlinkType, $maxRows_RecordOtrlinkType);
$RecordOtrlinkType = mysqli_query($DB_Conn, $query_limit_RecordOtrlinkType) or die(mysqli_error($DB_Conn));
$row_RecordOtrlinkType = mysqli_fetch_assoc($RecordOtrlinkType);

if (isset($_GET['totalRows_RecordOtrlinkType'])) {
  $totalRows_RecordOtrlinkType = $_GET['totalRows_RecordOtrlinkType'];
} else {
  $all_RecordOtrlinkType = mysqli_query($DB_Conn, $query_RecordOtrlinkType);
  $totalRows_RecordOtrlinkType = mysqli_num_rows($all_RecordOtrlinkType);
}
$totalPages_RecordOtrlinkType = ceil($totalRows_RecordOtrlinkType/$maxRows_RecordOtrlinkType)-1;

$queryString_RecordOtrlinkType = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageType") == false && 
        stristr($param, "totalRows_RecordOtrlinkType") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordOtrlinkType = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordOtrlinkType = sprintf("&totalRows_RecordOtrlinkType=%d%s", $totalRows_RecordOtrlinkType, $queryString_RecordOtrlinkType);


?>
<?php if ($MSTMP == 'default') { ?>
<style type="text/css">
.otrlink_outer_board{
}

.otrlink_outer_board tr td{
	margin: 0px;
	padding: 0px;
}
</style>

<?php
/*********************************************************************
 # 主頁面產品資訊
 *********************************************************************/
?>
<?php
#
# ============== [title] ============== #
#
# 標題部分
?>
<div class="columns on-1">
        <div class="container">
            <div class="column">
                <div class="container ct_board">
                <h3><span class="titlesicon"><img src="images/dot_02.jpg" width="15" height="20" /></span>
                <?php echo $Lang_Content_Title_Otrlink; // 標題文字 ?></h3>
                </div>
            </div>
        </div>        
</div>
<?php
#
# ============== [/title] ============== #
?> 
<?php
#
# ============== [rs date] ============== #
#
# 顯示資料集分頁
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
    <tr>
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordOtrlinkType + 1) ?> - <?php echo min($startRow_RecordOtrlinkType + $maxRows_RecordOtrlinkType, $totalRows_RecordOtrlinkType) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordOtrlinkType ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
      <?php if ($OtrlinkSearchSelect == "1") { ?>
      <form id="form_Otrlink" name="form_Otrlink" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search_Otrlink; ?>" />
        </label>
      </form>
      <?php } ?>
      
      
       
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordOtrlinkType = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordOtrlinkType = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordOtrlinkType = buildNavigation($pageType,$totalPages_RecordOtrlinkType,$prev_RecordOtrlinkType,$next_RecordOtrlinkType,$separator,$max_links,true); 
       ?>
      <?php if ($pageType > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageType=%d%s", $currentPage, 0, $queryString_RecordOtrlinkType); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordOtrlinkType[0]; ?> 
      <?php print $pages_navigation_RecordOtrlinkType[1]; ?> 
      <?php print $pages_navigation_RecordOtrlinkType[2]; ?>
      <?php if ($pageType < $totalPages_RecordOtrlinkType) { // Show if not last page ?>
  <a href="<?php printf("%s?pageType=%d%s", $currentPage, $totalPages_RecordOtrlinkType, $queryString_RecordOtrlinkType); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordOtrlinkType/$maxRows_RecordOtrlinkType) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $pageType+1; ?> / <?php echo ceil($totalRows_RecordOtrlinkType/$maxRows_RecordOtrlinkType); ?></span><?php } ?>
      </div>  
      
      </td>
    </tr>
</table>
<?php
#
# ============== [/rs date] ============== #
?> 
<?php 
#
# ============== [if] ============== #
#
# 在此判斷式之內放置要顯示之內容
if ($totalRows_RecordOtrlinkType > 0) { // Show if recordset not empty 
?> 
 <div class="columns on-1">
      <div class="container board">
	  <?php $i=$startRow_RecordOtrlinkType + 1; // 取得頁面第一項商品之編號 ?>
          <?php do { ?> 
          <div class="column">
              <div class="container otrlink_inner_board">  
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>
                    
                    <?php echo $row_RecordOtrlinkType['itemname']; ?>
					
                    </td>
                  </tr>
                </table>
               
              </div>
          </div>
          <?php $i++; ?>
          <?php if ($i%1 == 0) {echo "<div class=\"column \"><div class=\"container otrlink_inner_board\"><hr></div></div>";}?>
          <?php } while ($row_RecordOtrlinkType = mysqli_fetch_assoc($RecordOtrlinkType)); ?>
      </div>
  </div>
<?php 
} // Show if recordset not empty 
#
# ============== [/if] ============== #
?>
<?php 
#
# ============== [if] ============== #
#
# 判斷當無資料顯示時之畫面
if ($totalRows_RecordOtrlinkType == 0) { // Show if recordset empty 
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><font color="#FF0000">目前尚無資料！！</font></td>
  </tr>
</table>
<?php 
} // Show if recordset empty 
#
# ============== [/if] ============== #
?>
<?php } else { ?>
<?php include($TplPath . "/otrlink_view.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordOtrlinkType);
?>
