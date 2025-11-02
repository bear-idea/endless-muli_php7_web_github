<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($page,$totalPages_RecordPublish,$prev_RecordPublish,$next_RecordPublish,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordPublish,$totalRows_RecordPublish;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($page<=$totalPages_RecordPublish && $page>=0)
	{
		if ($page > ceil($max_links/2))
		{
			$fgp = $page - ceil($max_links/2) > 0 ? $page - ceil($max_links/2) : 1;
			$egp = $page + ceil($max_links/2);
			if ($egp >= $totalPages_RecordPublish)
			{
				$egp = $totalPages_RecordPublish+1;
				$fgp = $totalPages_RecordPublish - ($max_links-1) > 0 ? $totalPages_RecordPublish  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordPublish >= $max_links ? $max_links : $totalPages_RecordPublish+1;
		}
		if($totalPages_RecordPublish >= 1) {
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
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordPublish</a>" :  "<span>$prev_RecordPublish</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordPublish) + 1;
					$max_l = ($a*$maxRows_RecordPublish >= $totalRows_RecordPublish) ? $totalRows_RecordPublish : ($a*$maxRows_RecordPublish);
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
			$offset_end = $totalPages_RecordPublish;
			$lastArray = ($page < $totalPages_RecordPublish) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordPublish</a>" : "<span>$next_RecordPublish</span>"; /* css */
		}
	}
	return array($firstArray,$pagesArray,$lastArray);
}
?>
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

$maxRows_RecordPublish = 25;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordPublish = $page * $maxRows_RecordPublish;

$colname_RecordPublish = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordPublish = $_GET['searchkey'];
}
$coluserid_RecordPublish = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordPublish = $_SESSION['userid'];
}
$collang_RecordPublish = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordPublish = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPublish = sprintf("SELECT * FROM demo_publish WHERE (type LIKE %s) && (indicate=1) && (lang = %s) && userid=%s ORDER BY sortid,  id DESC", GetSQLValueString("%" . $colname_RecordPublish . "%", "text"),GetSQLValueString($collang_RecordPublish, "text"),GetSQLValueString($coluserid_RecordPublish, "int"));
$query_limit_RecordPublish = sprintf("%s LIMIT %d, %d", $query_RecordPublish, $startRow_RecordPublish, $maxRows_RecordPublish);
$RecordPublish = mysqli_query($DB_Conn, $query_limit_RecordPublish) or die(mysqli_error($DB_Conn));
$row_RecordPublish = mysqli_fetch_assoc($RecordPublish);

if (isset($_GET['totalRows_RecordPublish'])) {
  $totalRows_RecordPublish = $_GET['totalRows_RecordPublish'];
} else {
  $all_RecordPublish = mysqli_query($DB_Conn, $query_RecordPublish);
  $totalRows_RecordPublish = mysqli_num_rows($all_RecordPublish);
}
$totalPages_RecordPublish = ceil($totalRows_RecordPublish/$maxRows_RecordPublish)-1;
?>
<?php if ($MSTMP == 'default') { ?>
<?php
/*********************************************************************
 # 主頁面發布資訊
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
                <?php echo $Lang_Content_Title_Publish; // 內容標題 ?></h3>
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
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordPublish + 1) ?> - <?php echo min($startRow_RecordPublish + $maxRows_RecordPublish, $totalRows_RecordPublish) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordPublish ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
      <?php if ($PublishSearchSelect == "1") { ?>
      <form id="form_Publish" name="form_Publish" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search_Publish; ?>" />
        </label>
      </form>
      <?php } ?>  
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordPublish = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordPublish = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordPublish = buildNavigation($page,$totalPages_RecordPublish,$prev_RecordPublish,$next_RecordPublish,$separator,$max_links,true); 
       ?>
      <?php if ($page > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordPublish); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordPublish[0]; ?> 
      <?php print $pages_navigation_RecordPublish[1]; ?> 
      <?php print $pages_navigation_RecordPublish[2]; ?>
      <?php if ($page < $totalPages_RecordPublish) { // Show if not last page ?>
  <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordPublish, $queryString_RecordPublish); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordPublish/$maxRows_RecordPublish) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordPublish/$maxRows_RecordPublish); ?></span><?php } ?>
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
if ($totalRows_RecordPublish > 0) { // Show if recordset not empty 
?>
<div class="columns on-1">
        <div class="container board">
            <div class="column">
                <div class="container ct_board">
                	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
                	<!--    <tr>
                      <td width="20" align="center" valign="top"></td>
                      <td align="left" valign="top"><?php echo $Lang_Classify_Context_Title_Publish; // 標題 ?> </td>
                      <td width="158" valign="top"><?php echo $Lang_Classify_Context_Date_Publish; // 日期 ?></td>
                    </tr>-->
                      
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
                          if(($startRow_RecordPublish)%2 == 0){
                              $chahgecolorcount=$oddtr;
                          }else{
                              $chahgecolorcount=$eventr;
                          }
                          ?>
                      <tr class= "<?php echo $chahgecolorcount; ?>">       
                        <td align="center" valign="top"><img src="images/sicon/play.gif" width="11" height="11" /></td>
                        <td valign="top">
                              <?php 
                              #
                              # ============== [if] ============== #
                              #
                              # 判斷是否顯示分類項目
                              if($row_RecordPublish['type'] != "") { 
                              ?>
                              <span class="TipTypeStyle">[<?php echo highLight($row_RecordPublish['type'], @$_GET['searchkey'], $HighlightSelect); ?>]</span> 
                              <?php 
                              } 
                              # 
                              # ============== [/if] ============== #
                              ?>
                              <a href="publish.php?Opt=detailed&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id=<?php echo $row_RecordPublish['id']; ?>"><?php echo $row_RecordPublish['title']; ?></a>
                              </td>
                              <td width="200" align="right" valign="top">
                              <?php echo highLight(date('Y-m-d',strtotime($row_RecordPublish['postdate'])), @$_GET['searchkey'], $HighlightSelect); ?>
                          </td> 
                            </tr>
                           <?php 
                           $startRow_RecordPublish++;
                           #
                           # ============== [/tr color change] ============== #
                           ?>
                      <?php 
                      #
                      # ============== [/while] ============== #
                      } while ($row_RecordPublish = mysqli_fetch_assoc($RecordPublish)); 
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
if ($totalRows_RecordPublish == 0) { // Show if recordset empty 
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
<?php include($TplPath . "/publish_view.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordPublish);
?>
