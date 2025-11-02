<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($page,$totalPages_RecordCareers,$prev_RecordCareers,$next_RecordCareers,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordCareers,$totalRows_RecordCareers;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($page<=$totalPages_RecordCareers && $page>=0)
	{
		if ($page > ceil($max_links/2))
		{
			$fgp = $page - ceil($max_links/2) > 0 ? $page - ceil($max_links/2) : 1;
			$egp = $page + ceil($max_links/2);
			if ($egp >= $totalPages_RecordCareers)
			{
				$egp = $totalPages_RecordCareers+1;
				$fgp = $totalPages_RecordCareers - ($max_links-1) > 0 ? $totalPages_RecordCareers  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordCareers >= $max_links ? $max_links : $totalPages_RecordCareers+1;
		}
		if($totalPages_RecordCareers >= 1) {
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
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordCareers</a>" :  "<span>$prev_RecordCareers</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordCareers) + 1;
					$max_l = ($a*$maxRows_RecordCareers >= $totalRows_RecordCareers) ? $totalRows_RecordCareers : ($a*$maxRows_RecordCareers);
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
			$offset_end = $totalPages_RecordCareers;
			$lastArray = ($page < $totalPages_RecordCareers) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordCareers</a>" : "<span>$next_RecordCareers</span>"; /* css */
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

$maxRows_RecordCareers = 24;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordCareers = $page * $maxRows_RecordCareers;

$coltype_RecordCareers = "%";
if (isset($_GET['type'])) {
  $coltype_RecordCareers = $_GET['type'];
}
$colarea_RecordCareers = "%";
if (isset($_GET['area'])) {
  $colarea_RecordCareers = $_GET['area'];
}
$colauthor_RecordCareers = "%";
if (isset($_GET['author'])) {
  $colauthor_RecordCareers = $_GET['author'];
}
$coluserid_RecordCareers = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordCareers = $_SESSION['userid'];
}
$collang_RecordCareers = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordCareers = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCareers = sprintf("SELECT * FROM demo_careers WHERE (type LIKE %s) && (area LIKE %s) && (author LIKE %s) && (indicate=1) && (lang = %s) && userid=%s ORDER BY id DESC", GetSQLValueString("%" . $coltype_RecordCareers . "%", "text"),GetSQLValueString("%" . $colarea_RecordCareers . "%", "text"),GetSQLValueString("%" . $colauthor_RecordCareers . "%", "text"),GetSQLValueString($collang_RecordCareers, "text"),GetSQLValueString($coluserid_RecordCareers, "int"));
$query_limit_RecordCareers = sprintf("%s LIMIT %d, %d", $query_RecordCareers, $startRow_RecordCareers, $maxRows_RecordCareers);
$RecordCareers = mysqli_query($DB_Conn, $query_limit_RecordCareers) or die(mysqli_error($DB_Conn));
$row_RecordCareers = mysqli_fetch_assoc($RecordCareers);

if (isset($_GET['totalRows_RecordCareers'])) {
  $totalRows_RecordCareers = $_GET['totalRows_RecordCareers'];
} else {
  $all_RecordCareers = mysqli_query($DB_Conn, $query_RecordCareers);
  $totalRows_RecordCareers = mysqli_num_rows($all_RecordCareers);
}
$totalPages_RecordCareers = ceil($totalRows_RecordCareers/$maxRows_RecordCareers)-1;

$colname_RecordCareersListType = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordCareersListType = $_GET['lang'];
}
$coluserid_RecordCareersListType = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordCareersListType = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCareersListType = sprintf("SELECT * FROM demo_careersitem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordCareersListType, "text"),GetSQLValueString($coluserid_RecordCareersListType, "int"));
$RecordCareersListType = mysqli_query($DB_Conn, $query_RecordCareersListType) or die(mysqli_error($DB_Conn));
$row_RecordCareersListType = mysqli_fetch_assoc($RecordCareersListType);
$totalRows_RecordCareersListType = mysqli_num_rows($RecordCareersListType);

$colname_RecordCareersListAuthor = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordCareersListAuthor = $_GET['lang'];
}
$coluserid_RecordCareersListAuthor = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordCareersListAuthor = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCareersListAuthor = sprintf("SELECT * FROM demo_careersitem WHERE list_id = 2 && lang=%s && userid=%s", GetSQLValueString($colname_RecordCareersListAuthor, "text"),GetSQLValueString($coluserid_RecordCareersListAuthor, "int"));
$RecordCareersListAuthor = mysqli_query($DB_Conn, $query_RecordCareersListAuthor) or die(mysqli_error($DB_Conn));
$row_RecordCareersListAuthor = mysqli_fetch_assoc($RecordCareersListAuthor);
$totalRows_RecordCareersListAuthor = mysqli_num_rows($RecordCareersListAuthor);

$colname_RecordCareersListArea = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordCareersListArea = $_GET['lang'];
}
$coluserid_RecordCareersListArea = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordCareersListArea = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCareersListArea = sprintf("SELECT * FROM demo_careersitem WHERE list_id = 3 && lang=%s && userid=%s", GetSQLValueString($colname_RecordCareersListArea, "text"),GetSQLValueString($coluserid_RecordCareersListArea, "int"));
$RecordCareersListArea = mysqli_query($DB_Conn, $query_RecordCareersListArea) or die(mysqli_error($DB_Conn));
$row_RecordCareersListArea = mysqli_fetch_assoc($RecordCareersListArea);
$totalRows_RecordCareersListArea = mysqli_num_rows($RecordCareersListArea);

$queryString_RecordCareers = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordCareers") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordCareers = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordCareers = sprintf("&totalRows_RecordCareers=%d%s", $totalRows_RecordCareers, $queryString_RecordCareers);
?>
<?php if ($MSTMP == 'default') { ?>
<?php
/*********************************************************************
 # 主頁面最新訊息
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
                <?php echo $Lang_Content_Title_Careers; // 標題文字 ?></h3>
                </div>
            </div>
        </div>        
</div>
<?php 
#
# ============== [if] ============== #
#
# 在此判斷式之內放置要顯示之內容
if ($totalRows_RecordCareers > 0) { // Show if recordset not empty 
?>
<div class="columns on-1">
        <div class="container board">
            <div class="column">
                <div class="container ct_board">
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
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordCareers + 1) ?> - <?php echo min($startRow_RecordCareers + $maxRows_RecordCareers, $totalRows_RecordCareers) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordCareers ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
      <?php //if ($CareersSearchSelect == "1") { ?>
      <form id="form_Careers" name="form_Careers" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search_Careers; ?>" />
        </label>
      </form>
      <?php //} ?>  
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordCareers = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordCareers = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordCareers = buildNavigation($page,$totalPages_RecordCareers,$prev_RecordCareers,$next_RecordCareers,$separator,$max_links,true); 
       ?>
      <?php if ($page > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordCareers); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordCareers[0]; ?> 
      <?php print $pages_navigation_RecordCareers[1]; ?> 
      <?php print $pages_navigation_RecordCareers[2]; ?>
      <?php if ($page < $totalPages_RecordCareers) { // Show if not last page ?>
  <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordCareers, $queryString_RecordCareers); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordCareers/$maxRows_RecordCareers) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordCareers/$maxRows_RecordCareers); ?></span><?php } ?>
      </div>  
      
      </td>
    </tr>
</table>
<?php
#
# ============== [/rs date] ============== #
?> 
                   <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
      <!--
      <tr>
        <td width="20" align="center" valign="top"></td>
        <td align="left" valign="top"><?php echo $Lang_Classify_Context_Title_Careers; // 標題 ?> </td>
        <td width="158" valign="top"><?php echo $Lang_Classify_Context_Date_Careers; // 日期 ?></td>
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
          if(($startRow_RecordCareers)%2 == 0){
              $chahgecolorcount=$oddtr;
          }else{
              $chahgecolorcount=$eventr;
          }
          ?>
           <tr class= "<?php echo $chahgecolorcount; ?>">       
              <td align="center" valign="top"><img src="<?php echo $TplImagePath ?>/sicon/play.gif" alt="icon" width="11" height="11" /></td>
              <td valign="top">
              <?php 
              #
              # ============== [if] ============== #
			  #
              # 判斷是否顯示分類項目
              if($row_RecordCareers['type'] != "") { 
              ?>
              <span class="TipTypeStyle">[<?php echo $row_RecordCareers['type']; ?>]</span> 
              <?php 
              } 
              # 
			  # ============== [/if] ============== #
              ?>
              <a href="careers.php?Opt=detailed&amp;tp=<?php echo $_GET['tp']; ?>&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id=<?php echo $row_RecordCareers['id']; ?>"><?php echo $row_RecordCareers['title']; ?></a>
              </td>
              <td valign="top">
              <?php echo highLight(date('Y-m-d',strtotime($row_RecordCareers['postdate'])), @$_GET['searchkey'], $HighlightSelect); ?>
              </td> 
            </tr>
           <?php 
		   $startRow_RecordCareers++;
		   #
		   # ============== [/tr color change] ============== #
		   ?>
      <?php 
      #
      # ============== [/while] ============== #
      } while ($row_RecordCareers = mysqli_fetch_assoc($RecordCareers)); 
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
if ($totalRows_RecordCareers == 0) { // Show if recordset empty 
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
<?php include($TplPath . "/careers_view.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordCareers);

mysqli_free_result($RecordCareersListType);

mysqli_free_result($RecordCareersListAuthor);

mysqli_free_result($RecordCareersListArea);
?>
