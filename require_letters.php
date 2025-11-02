<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($page,$totalPages_RecordLetters,$prev_RecordLetters,$next_RecordLetters,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordLetters,$totalRows_RecordLetters;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($page<=$totalPages_RecordLetters && $page>=0)
	{
		if ($page > ceil($max_links/2))
		{
			$fgp = $page - ceil($max_links/2) > 0 ? $page - ceil($max_links/2) : 1;
			$egp = $page + ceil($max_links/2);
			if ($egp >= $totalPages_RecordLetters)
			{
				$egp = $totalPages_RecordLetters+1;
				$fgp = $totalPages_RecordLetters - ($max_links-1) > 0 ? $totalPages_RecordLetters  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordLetters >= $max_links ? $max_links : $totalPages_RecordLetters+1;
		}
		if($totalPages_RecordLetters >= 1) {
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
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordLetters</a>" :  "<span>$prev_RecordLetters</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordLetters) + 1;
					$max_l = ($a*$maxRows_RecordLetters >= $totalRows_RecordLetters) ? $totalRows_RecordLetters : ($a*$maxRows_RecordLetters);
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
			$offset_end = $totalPages_RecordLetters;
			$lastArray = ($page < $totalPages_RecordLetters) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordLetters</a>" : "<span>$next_RecordLetters</span>"; /* css */
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

$maxRows_RecordLetters = 25;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordLetters = $page * $maxRows_RecordLetters;

$colname_RecordLetters = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordLetters = $_GET['searchkey'];
}
$coluserid_RecordLetters = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordLetters = $_SESSION['userid'];
}
$collang_RecordLetters = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordLetters = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordLetters = sprintf("SELECT * FROM demo_letters WHERE (type LIKE %s) && (indicate=1) && (lang = %s) && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordLetters . "%", "text"),GetSQLValueString($collang_RecordLetters, "text"),GetSQLValueString($coluserid_RecordLetters, "int"));
$query_limit_RecordLetters = sprintf("%s LIMIT %d, %d", $query_RecordLetters, $startRow_RecordLetters, $maxRows_RecordLetters);
$RecordLetters = mysqli_query($DB_Conn, $query_limit_RecordLetters) or die(mysqli_error($DB_Conn));
$row_RecordLetters = mysqli_fetch_assoc($RecordLetters);

if (isset($_GET['totalRows_RecordLetters'])) {
  $totalRows_RecordLetters = $_GET['totalRows_RecordLetters'];
} else {
  $all_RecordLetters = mysqli_query($DB_Conn, $query_RecordLetters);
  $totalRows_RecordLetters = mysqli_num_rows($all_RecordLetters);
}
$totalPages_RecordLetters = ceil($totalRows_RecordLetters/$maxRows_RecordLetters)-1;

$queryString_RecordLetters = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordLetters") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordLetters = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordLetters = sprintf("&totalRows_RecordLetters=%d%s", $totalRows_RecordLetters, $queryString_RecordLetters);
?>
<?php if ($MSTMP == 'default') { ?>
<?php
/*********************************************************************
 # 主頁面新聞快報
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
                <?php echo $Lang_Content_Title_Letters; // 標題文字 ?></h3>
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
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordLetters + 1) ?> - <?php echo min($startRow_RecordLetters + $maxRows_RecordLetters, $totalRows_RecordLetters) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordLetters ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
      <?php if ($LettersSearchSelect == "1") { ?>
      <form id="form_Letters" name="form_Letters" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search_Letters; ?>" />
        </label>
      </form>
      <?php } ?>  
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordLetters = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordLetters = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordLetters = buildNavigation($page,$totalPages_RecordLetters,$prev_RecordLetters,$next_RecordLetters,$separator,$max_links,true); 
       ?>
      <?php if ($page > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordLetters); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordLetters[0]; ?> 
      <?php print $pages_navigation_RecordLetters[1]; ?> 
      <?php print $pages_navigation_RecordLetters[2]; ?>
      <?php if ($page < $totalPages_RecordLetters) { // Show if not last page ?>
  <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordLetters, $queryString_RecordLetters); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordLetters/$maxRows_RecordLetters) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordLetters/$maxRows_RecordLetters); ?></span><?php } ?>
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
if ($totalRows_RecordLetters > 0) { // Show if recordset not empty 
?>
<div class="columns on-1">
        <div class="container board">
            <div class="column">
                <div class="container ct_board">
                   <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
      <!--
      <tr>
        <td width="20" align="center" valign="top"></td>
        <td align="left" valign="top"><?php echo $Lang_Classify_Context_Title_Letters; // 標題 ?> </td>
        <td width="158" valign="top"><?php echo $Lang_Classify_Context_Date_Letters; // 日期 ?></td>
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
          if(($startRow_RecordLetters)%2 == 0){
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
              if($row_RecordLetters['type'] != "") { 
              ?>
              <span class="TipTypeStyle">[<?php echo $row_RecordLetters['type']; ?>]</span> 
              <?php 
              } 
              # 
			  # ============== [/if] ============== #
              ?>
              <a href="letters.php?Opt=detailed&amp;tp=<?php echo $_GET['tp']; ?>&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id=<?php echo $row_RecordLetters['id']; ?>"><?php echo $row_RecordLetters['title']; ?></a>
              </td>
              <td valign="top">
              <?php echo highLight(date('Y-m-d',strtotime($row_RecordLetters['postdate'])), @$_GET['searchkey'], $HighlightSelect); ?>
              </td> 
            </tr>
           <?php 
		   $startRow_RecordLetters++;
		   #
		   # ============== [/tr color change] ============== #
		   ?>
      <?php 
      #
      # ============== [/while] ============== #
      } while ($row_RecordLetters = mysqli_fetch_assoc($RecordLetters)); 
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
if ($totalRows_RecordLetters == 0) { // Show if recordset empty 
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
<?php include($TplPath . "/letters_view.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordLetters);
?>
