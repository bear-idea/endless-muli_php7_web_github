<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($page,$totalPages_RecordForum,$prev_RecordForum,$next_RecordForum,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordForum,$totalRows_RecordForum;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($page<=$totalPages_RecordForum && $page>=0)
	{
		if ($page > ceil($max_links/2))
		{
			$fgp = $page - ceil($max_links/2) > 0 ? $page - ceil($max_links/2) : 1;
			$egp = $page + ceil($max_links/2);
			if ($egp >= $totalPages_RecordForum)
			{
				$egp = $totalPages_RecordForum+1;
				$fgp = $totalPages_RecordForum - ($max_links-1) > 0 ? $totalPages_RecordForum  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordForum >= $max_links ? $max_links : $totalPages_RecordForum+1;
		}
		if($totalPages_RecordForum >= 1) {
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
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordForum</a>" :  "<span>$prev_RecordForum</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordForum) + 1;
					$max_l = ($a*$maxRows_RecordForum >= $totalRows_RecordForum) ? $totalRows_RecordForum : ($a*$maxRows_RecordForum);
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
			$offset_end = $totalPages_RecordForum;
			$lastArray = ($page < $totalPages_RecordForum) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordForum</a>" : "<span>$next_RecordForum</span>"; /* css */
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

$maxRows_RecordForum = 24;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordForum = $page * $maxRows_RecordForum;

$colname_RecordForum = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordForum = $_GET['searchkey'];
}
$coluserid_RecordForum = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordForum = $_SESSION['userid'];
}
$collang_RecordForum = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordForum = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordForum = sprintf("SELECT * FROM demo_forum WHERE ((name LIKE %s) || (type LIKE %s)) && (indicate=1) && (lang = %s) && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordForum . "%", "text"),GetSQLValueString("%" . $colname_RecordForum . "%", "text"),GetSQLValueString($collang_RecordForum, "text"),GetSQLValueString($coluserid_RecordForum, "int"));
$query_limit_RecordForum = sprintf("%s LIMIT %d, %d", $query_RecordForum, $startRow_RecordForum, $maxRows_RecordForum);
$RecordForum = mysqli_query($DB_Conn, $query_limit_RecordForum) or die(mysqli_error($DB_Conn));
$row_RecordForum = mysqli_fetch_assoc($RecordForum);

if (isset($_GET['totalRows_RecordForum'])) {
  $totalRows_RecordForum = $_GET['totalRows_RecordForum'];
} else {
  $all_RecordForum = mysqli_query($DB_Conn, $query_RecordForum);
  $totalRows_RecordForum = mysqli_num_rows($all_RecordForum);
}
$totalPages_RecordForum = ceil($totalRows_RecordForum/$maxRows_RecordForum)-1;

$colname_RecordForumListClass = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordForumListClass = $_GET['lang'];
}
$coluserid_RecordForumListClass = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordForumListClass = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordForumListClass = sprintf("SELECT * FROM demo_forumitem WHERE list_id = 2 && lang=%s && level = 0 && userid=%s ORDER BY sortid ASC", GetSQLValueString($colname_RecordForumListClass, "text"),GetSQLValueString($coluserid_RecordForumListClass, "int"));
$RecordForumListClass = mysqli_query($DB_Conn, $query_RecordForumListClass) or die(mysqli_error($DB_Conn));
$row_RecordForumListClass = mysqli_fetch_assoc($RecordForumListClass);
$totalRows_RecordForumListClass = mysqli_num_rows($RecordForumListClass);

$colname_RecordForumListType = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordForumListType = $_GET['lang'];
}
$coluserid_RecordForumListType = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordForumListType = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordForumListType = sprintf("SELECT * FROM demo_forumitem WHERE list_id = 1 && lang=%s && level = 0 && userid=%s ORDER BY sortid ASC", GetSQLValueString($colname_RecordForumListType, "text"),GetSQLValueString($coluserid_RecordForumListType, "int"));
$RecordForumListType = mysqli_query($DB_Conn, $query_RecordForumListType) or die(mysqli_error($DB_Conn));
$row_RecordForumListType = mysqli_fetch_assoc($RecordForumListType);
$totalRows_RecordForumListType = mysqli_num_rows($RecordForumListType);

$queryString_RecordForum = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordForum") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordForum = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordForum = sprintf("&totalRows_RecordForum=%d%s", $totalRows_RecordForum, $queryString_RecordForum);
?>
<?php if ($MSTMP == 'default') { ?>
<style type="text/css">
.Forum_Type a{
	padding: 5px;
	border: 1px solid #DDD;
	margin-top: 5px;
	margin-right: 0px;
	margin-bottom: 5px;
	margin-left: 0px;
}
.Forum_Type a:hover{
	border: 1px solid #666;
	color: #FFF;
	background-color: #666666;
}
</style>
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
                <?php echo $Lang_Content_Title_Forum; // 標題文字 ?></h3>
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
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordForum + 1) ?> - <?php echo min($startRow_RecordForum + $maxRows_RecordForum, $totalRows_RecordForum) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordForum ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
      <?php if ($ForumSearchSelect == "1") { ?>
      <form id="form_Forum" name="form_Forum" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search_Forum; ?>" />
        </label>
      </form>
      <?php } ?>  
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordForum = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordForum = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordForum = buildNavigation($page,$totalPages_RecordForum,$prev_RecordForum,$next_RecordForum,$separator,$max_links,true); 
       ?>
      <?php if ($page > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordForum); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordForum[0]; ?> 
      <?php print $pages_navigation_RecordForum[1]; ?> 
      <?php print $pages_navigation_RecordForum[2]; ?>
      <?php if ($page < $totalPages_RecordForum) { // Show if not last page ?>
  <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordForum, $queryString_RecordForum); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordForum/$maxRows_RecordForum) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordForum/$maxRows_RecordForum); ?></span><?php } ?>
      </div>  
      
      </td>
    </tr>
</table>
<?php
#
# ============== [/rs date] ============== #
?>

    <?php if ($totalRows_RecordForumListType > 0) { // Show if recordset not empty ?>
	<?php do { ?>
<!--<div class="columns on-1">
        <div class="container board">
            <div class="column">
                <div class="container ct_board">
              
                <?php echo $row_RecordForumListType['itemname']; ?>
                
            </div>
          </div>
        </div>
      </div>
	<br />-->
	<?php } while ($row_RecordForumListType = mysqli_fetch_assoc($RecordForumListType)); ?>
      <?php } // Show if recordset not empty ?>

<?php 
#
# ============== [if] ============== #
#
# 在此判斷式之內放置要顯示之內容
if ($totalRows_RecordForum > 0) { // Show if recordset not empty 
?>
<div class="columns on-1">
        <div class="container">
            <div class="column">
              <div class="container">
              <span style="width:500px;">
                <?php do { ?>
                <?php 
						if($row_RecordForum['type1'] != '-1' && $row_RecordForum['type2'] != '-1' && $row_RecordForum['type3'] != '-1') { $level='2'; }
						else if($row_RecordForum['type1'] != '-1' && $row_RecordForum['type2'] != '-1' && $row_RecordForum['type3'] == '-1') { $level='1'; }
						else if($row_RecordForum['type1'] != '-1' && $row_RecordForum['type2'] == '-1' && $row_RecordForum['type3'] == '-1') { $level='0'; }
						else { $level=''; }
					?>
                  <span class="Forum_Type"><a href="forum.php?Opt=viewpage&amp;tp=Forum&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;searchkey=<?php echo $row_RecordForumListClass['itemname']; ?>"><?php echo $row_RecordForumListClass['itemname']; ?></a></span>
                    <?php } while ($row_RecordForumListClass = mysqli_fetch_assoc($RecordForumListClass)); ?>
                  </span>
                   <span style="float:right;" class="Forum_Type"><a href="forum.php?Opt=postpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;tp=Forum&amp;level=<?php echo $level; ?>&amp;type1=<?php echo $row_RecordForum['type1']; ?>&amp;type2=<?php echo $row_RecordForum['type2']; ?>&amp;type3=<?php echo $row_RecordForum['type3']; ?>&amp;subitem_id=<?php echo $_GET['subitem_id']; ?>&amp;id=<?php echo $row_RecordForum['id']; ?>">發新主題</a></span>
                </div>
            </div>
        </div>        
</div>
<div style="height:10px;"></div>
<div class="columns on-1">
        <div class="container board">
            <div class="column">
                <div class="container ct_board">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
      
      <tr>
        <td width="20" align="center" valign="top"></td>
        <td align="left" valign="top"><?php echo $Lang_Classify_Context_Title_Forum; // 標題 ?> </td>
        <td width="100" align="left" valign="top">作者</td>
        <td width="70" align="left" valign="top">點閱數</td>
        <td width="158" valign="top"><?php echo $Lang_Classify_Context_Date_Forum; // 日期 ?></td>
      </tr>
     
      
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
          if(($startRow_RecordForum)%2 == 0){
              $chahgecolorcount=$oddtr;
          }else{
              $chahgecolorcount=$eventr;
          }
          ?>
           <tr class= "<?php echo $chahgecolorcount; ?>">       
              <td align="center" valign="middle"><img src="images/folder_new.gif" alt="icon" width="17" height="17" /></td>
              <td valign="top">
              <?php 
              #
              # ============== [if] ============== #
			  #
              # 判斷是否顯示分類項目
              if($row_RecordForum['type'] != "") { 
              ?>
              <span class="TipTypeStyle">[<?php echo $row_RecordForum['type']; ?>]</span> 
              <?php 
              } 
              # 
			  # ============== [/if] ============== #
              ?>
              <a href="forum.php?Opt=detailed&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;tp=Forum&amp;level=<?php echo $level; ?>&amp;type1=<?php echo $row_RecordForum['type1']; ?>&amp;type2=<?php echo $row_RecordForum['type2']; ?>&amp;type3=<?php echo $row_RecordForum['type3']; ?>&amp;subitem_id=<?php echo $_GET['subitem_id']; ?>&amp;id=<?php echo $row_RecordForum['id']; ?>"><?php echo $row_RecordForum['name']; ?></a>
              </td>
              <td valign="top"><?php echo $row_RecordForum['author']; ?></td>
              <td valign="top"><?php echo $row_RecordForum['visit']; ?></td>
              <td valign="top">
                <?php echo highLight(date('Y-m-d',strtotime($row_RecordForum['postdate'])), @$_GET['searchkey'], $HighlightSelect); ?>
              </td> 
            </tr>
           <?php 
		   $startRow_RecordForum++;
		   #
		   # ============== [/tr color change] ============== #
		   ?>
      <?php 
      #
      # ============== [/while] ============== #
      } while ($row_RecordForum = mysqli_fetch_assoc($RecordForum)); 
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
if ($totalRows_RecordForum == 0) { // Show if recordset empty 
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
<?php include($TplPath . "/forum_view.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordForum);

mysqli_free_result($RecordForumListClass);

mysqli_free_result($RecordForumListType);
?>
