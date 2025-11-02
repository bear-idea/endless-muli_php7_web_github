<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($pageNum_RecordDfPage,$totalPages_RecordDfPage,$prev_RecordDfPage,$next_RecordDfPage,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordDfPage,$totalRows_RecordDfPage;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($pageNum_RecordDfPage<=$totalPages_RecordDfPage && $pageNum_RecordDfPage>=0)
	{
		if ($pageNum_RecordDfPage > ceil($max_links/2))
		{
			$fgp = $pageNum_RecordDfPage - ceil($max_links/2) > 0 ? $pageNum_RecordDfPage - ceil($max_links/2) : 1;
			$egp = $pageNum_RecordDfPage + ceil($max_links/2);
			if ($egp >= $totalPages_RecordDfPage)
			{
				$egp = $totalPages_RecordDfPage+1;
				$fgp = $totalPages_RecordDfPage - ($max_links-1) > 0 ? $totalPages_RecordDfPage  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordDfPage >= $max_links ? $max_links : $totalPages_RecordDfPage+1;
		}
		if($totalPages_RecordDfPage >= 1) {
			#	------------------------
			#	Searching for $_GET vars
			#	------------------------
			$_get_vars = '';			
			if(!empty($_GET) || !empty($HTTP_GET_VARS)){
				$_GET = empty($_GET) ? $HTTP_GET_VARS : $_GET;
				foreach ($_GET as $_get_name => $_get_value) {
					if ($_get_name != "pageNum_RecordDfPage") {
						if(is_array($_get_value)){
							$_get_vars .= "&$_get_name=" . urlencode(serialize($_get_value));
							}else {
							$_get_vars .= "&$_get_name=" . urlencode("$_get_value");
						}
					}
				}
			}
			$successivo = $pageNum_RecordDfPage+1;
			$precedente = $pageNum_RecordDfPage-1;
			$firstArray = ($pageNum_RecordDfPage > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordDfPage=$precedente$_get_vars\">$prev_RecordDfPage</a>" :  "<span>$prev_RecordDfPage</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordDfPage) + 1;
					$max_l = ($a*$maxRows_RecordDfPage >= $totalRows_RecordDfPage) ? $totalRows_RecordDfPage : ($a*$maxRows_RecordDfPage);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageNum_RecordDfPage)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordDfPage=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "<span>"; /* css */
					$pagesArray .= "$textLink</span>"  . ($theNext < $egp-1 ? $separator : "");
				}
			}
			$theNext = $pageNum_RecordDfPage+1;
			$offset_end = $totalPages_RecordDfPage;
			$lastArray = ($pageNum_RecordDfPage < $totalPages_RecordDfPage) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordDfPage=$successivo$_get_vars\">$next_RecordDfPage</a>" : "<span>$next_RecordDfPage</span>"; /* css */
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

$maxRows_RecordDfPage = 24;
$pageNum_RecordDfPage = 0;
if (isset($_GET['pageNum_RecordDfPage'])) {
  $pageNum_RecordDfPage = $_GET['pageNum_RecordDfPage'];
}
$startRow_RecordDfPage = $pageNum_RecordDfPage * $maxRows_RecordDfPage;

$colname_RecordDfPage = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordDfPage = $_GET['searchkey'];
}
$coluserid_RecordDfPage = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordDfPage = $_SESSION['userid'];
}
$collang_RecordDfPage = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordDfPage = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDfPage = sprintf("SELECT * FROM demo_dfpage WHERE ((title LIKE %s)) && lang = %s && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordDfPage . "%", "text"),GetSQLValueString($collang_RecordDfPage, "text"),GetSQLValueString($coluserid_RecordDfPage, "int"));
$query_limit_RecordDfPage = sprintf("%s LIMIT %d, %d", $query_RecordDfPage, $startRow_RecordDfPage, $maxRows_RecordDfPage);
$RecordDfPage = mysqli_query($DB_Conn, $query_limit_RecordDfPage) or die(mysqli_error($DB_Conn));
$row_RecordDfPage = mysqli_fetch_assoc($RecordDfPage);

if (isset($_GET['totalRows_RecordDfPage'])) {
  $totalRows_RecordDfPage = $_GET['totalRows_RecordDfPage'];
} else {
  $all_RecordDfPage = mysqli_query($DB_Conn, $query_RecordDfPage);
  $totalRows_RecordDfPage = mysqli_num_rows($all_RecordDfPage);
}
$totalPages_RecordDfPage = ceil($totalRows_RecordDfPage/$maxRows_RecordDfPage)-1;

$queryString_RecordDfPage = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecordDfPage") == false && 
        stristr($param, "totalRows_RecordDfPage") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordDfPage = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordDfPage = sprintf("&totalRows_RecordDfPage=%d%s", $totalRows_RecordDfPage, $queryString_RecordDfPage);
?>
<?php if ($MSTMP == 'default') { ?>
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
                <?php echo $Lang_Content_Title_DfPage; // 標題文字 ?></h3>
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
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordDfPage + 1) ?> - <?php echo min($startRow_RecordDfPage + $maxRows_RecordDfPage, $totalRows_RecordDfPage) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordDfPage ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
      <?php if ($DfPageSearchSelect == "1") { ?>
      <form id="form_DfPage" name="form_DfPage" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search_DfPage; ?>" />
        </label>
      </form>
      <?php } ?>  
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordDfPage = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordDfPage = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordDfPage = buildNavigation($pageNum_RecordDfPage,$totalPages_RecordDfPage,$prev_RecordDfPage,$next_RecordDfPage,$separator,$max_links,true); 
       ?>
      <?php if ($pageNum_RecordDfPage > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RecordDfPage=%d%s", $currentPage, 0, $queryString_RecordDfPage); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordDfPage[0]; ?> 
      <?php print $pages_navigation_RecordDfPage[1]; ?> 
      <?php print $pages_navigation_RecordDfPage[2]; ?>
      <?php if ($pageNum_RecordDfPage < $totalPages_RecordDfPage) { // Show if not last page ?>
  <a href="<?php printf("%s?pageNum_RecordDfPage=%d%s", $currentPage, $totalPages_RecordDfPage, $queryString_RecordDfPage); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordDfPage/$maxRows_RecordDfPage) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $pageNum_RecordDfPage+1; ?> / <?php echo ceil($totalRows_RecordDfPage/$maxRows_RecordDfPage); ?></span><?php } ?>
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
if ($totalRows_RecordDfPage > 0) { // Show if recordset not empty 
?>
<div class="columns on-1">
        <div class="container board">
            <div class="column">
                <div class="container ct_board">
                   <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
      <!--
      <tr>
        <td width="20" align="center" valign="top"></td>
        <td align="left" valign="top"><?php echo $Lang_Classify_Context_Title_DfPage; // 標題 ?> </td>
        <td width="158" valign="top"><?php echo $Lang_Classify_Context_Date_DfPage; // 日期 ?></td>
      </tr>
      -->
<?php
      #
      # ============== [do] ============== #
	  #
      # 重複印出所有資料
      do { 
      ?>
		  <?php
		  #
		  # ============== [tr color change] ============== #
		  #
		  # 表格隔行換色
		  $oddtr=TR_Odd_Color_Style;
          $eventr=TR_Even_Color_Style;
          if(($startRow_RecordDfPage)%2 == 0){
              $chahgecolorcount=$oddtr;
          }else{
              $chahgecolorcount=$eventr;
          }
          ?>
           <tr class= "<?php echo $chahgecolorcount; ?>">       
              <td align="center" valign="top"><img src="images/sicon/icon_dfpagelist.gif" width="18" height="18" /></td>
              <td valign="top">
             
              <a href="dfpage.php?Opt=detailed&amp;tp=<?php echo $_GET['tp']; ?>&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;dfpage_id=<?php echo $row_RecordDfPage['id']; ?>"><?php echo $row_RecordDfPage['title']; ?></a>
              </td>
              <td valign="top">
              <?php echo highLight(date('Y-m-d',strtotime($row_RecordDfPage['postdate'])), @$_GET['searchkey'], $HighlightSelect); ?>
              </td> 
            </tr>
           <?php 
		   $startRow_RecordDfPage++;
		   #
		   # ============== [/tr color change] ============== #
		   ?>
      <?php 
      #
      # ============== [/while] ============== #
      } while ($row_RecordDfPage = mysqli_fetch_assoc($RecordDfPage)); 
      ?>
       
    </table>  
                </div>
            </div>
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
if ($totalRows_RecordDfPage == 0) { // Show if recordset empty 
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
<?php include($TplPath . "/dfpage_search.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordDfPage);
?>
