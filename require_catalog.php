<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($pageNum_Recordset1,$totalPages_Recordset1,$prev_Recordset1,$next_Recordset1,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordCatalog,$totalRows_RecordCatalog;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($pageNum_Recordset1<=$totalPages_Recordset1 && $pageNum_Recordset1>=0)
	{
		if ($pageNum_Recordset1 > ceil($max_links/2))
		{
			$fgp = $pageNum_Recordset1 - ceil($max_links/2) > 0 ? $pageNum_Recordset1 - ceil($max_links/2) : 1;
			$egp = $pageNum_Recordset1 + ceil($max_links/2);
			if ($egp >= $totalPages_Recordset1)
			{
				$egp = $totalPages_Recordset1+1;
				$fgp = $totalPages_Recordset1 - ($max_links-1) > 0 ? $totalPages_Recordset1  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_Recordset1 >= $max_links ? $max_links : $totalPages_Recordset1+1;
		}
		if($totalPages_Recordset1 >= 1) {
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
			$successivo = $pageNum_Recordset1+1;
			$precedente = $pageNum_Recordset1-1;
			$firstArray = ($pageNum_Recordset1 > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_Recordset1</a>" :  "<span>$prev_Recordset1</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordCatalog) + 1;
					$max_l = ($a*$maxRows_RecordCatalog >= $totalRows_RecordCatalog) ? $totalRows_RecordCatalog : ($a*$maxRows_RecordCatalog);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageNum_Recordset1)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?page=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "<span>"; /* css */
					$pagesArray .= "$textLink</span>"  . ($theNext < $egp-1 ? $separator : "");
				}
			}
			$theNext = $pageNum_Recordset1+1;
			$offset_end = $totalPages_Recordset1;
			$lastArray = ($pageNum_Recordset1 < $totalPages_Recordset1) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_Recordset1</a>" : "<span>$next_Recordset1</span>"; /* css */
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecordCatalog = 24;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordCatalog = $page * $maxRows_RecordCatalog;

$colname_RecordCatalog = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordCatalog = $_GET['searchkey'];
}
$coluserid_RecordCatalog = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordCatalog = $_SESSION['userid'];
}
$collang_RecordCatalog = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordCatalog = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCatalog = sprintf("SELECT * FROM demo_catalog WHERE (type LIKE %s) && (indicate=1) && (lang = %s) && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordCatalog . "%", "text"),GetSQLValueString($collang_RecordCatalog, "text"),GetSQLValueString($coluserid_RecordCatalog, "int"));
$query_limit_RecordCatalog = sprintf("%s LIMIT %d, %d", $query_RecordCatalog, $startRow_RecordCatalog, $maxRows_RecordCatalog);
$RecordCatalog = mysqli_query($DB_Conn, $query_limit_RecordCatalog) or die(mysqli_error($DB_Conn));
$row_RecordCatalog = mysqli_fetch_assoc($RecordCatalog);

if (isset($_GET['totalRows_RecordCatalog'])) {
  $totalRows_RecordCatalog = $_GET['totalRows_RecordCatalog'];
} else {
  $all_RecordCatalog = mysqli_query($DB_Conn, $query_RecordCatalog);
  $totalRows_RecordCatalog = mysqli_num_rows($all_RecordCatalog);
}
$totalPages_RecordCatalog = ceil($totalRows_RecordCatalog/$maxRows_RecordCatalog)-1;

$queryString_RecordCatalog = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordCatalog") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordCatalog = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordCatalog = sprintf("&totalRows_RecordCatalog=%d%s", $totalRows_RecordCatalog, $queryString_RecordCatalog);
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
                <?php echo $Lang_Content_Title_Catalog; // 標題文字 ?></h3>
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
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordCatalog + 1) ?> - <?php echo min($startRow_RecordCatalog + $maxRows_RecordCatalog, $totalRows_RecordCatalog) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordCatalog ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
      <?php if ($CatalogSearchSelect == "1") { ?>
      <form id="form_Catalog" name="form_Catalog" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search_Catalog; ?>" />
        </label>
      </form>
      <?php } ?>
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordCatalog = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordCatalog = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordCatalog = buildNavigation($page,$totalPages_RecordCatalog,$prev_RecordCatalog,$next_RecordCatalog,$separator,$max_links,true); 
       ?>
      <?php if ($page > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordCatalog); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordCatalog[0]; ?> 
      <?php print $pages_navigation_RecordCatalog[1]; ?> 
      <?php print $pages_navigation_RecordCatalog[2]; ?>
      <?php if ($page < $totalPages_RecordCatalog) { // Show if not last page ?>
  <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordCatalog, $queryString_RecordCatalog); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordCatalog/$maxRows_RecordCatalog) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordCatalog/$maxRows_RecordCatalog); ?></span><?php } ?>
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
if ($totalRows_RecordCatalog > 0) { // Show if recordset not empty 
?>
<div class="columns on-1">
        <div class="container board">
            <div class="column">
                <div class="container ct_board">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
                  <!--
                  <tr>
                    <td width="20" align="center" valign="top"></td>
                    <td align="left" valign="top"><?php echo $Lang_Classify_Context_Title_Catalog; // 標題 ?> </td>
                    <td width="158" valign="top"><?php echo $Lang_Classify_Context_Date_Catalog; // 日期 ?></td>
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
                      if(($startRow_RecordCatalog)%2 == 0){
                          $chahgecolorcount=$oddtr;
                      }else{
                          $chahgecolorcount=$eventr;
                      }
                      ?>
                       <tr class= "<?php echo $chahgecolorcount; ?>">       
                         <td align="center" valign="middle"><img src="<?php echo $TplImagePath ?>/sicon/play.gif" alt="icon" width="11" height="11" /></td>
                         <td valign="middle" style="line-height:35px">
                          <?php 
                          #
                          # ============== [if] ============== #
                          #
                          # 判斷是否顯示分類項目
                          if($row_RecordCatalog['type'] != "") { 
                          ?>
                          <span class="TipTypeStyle">[<?php echo $row_RecordCatalog['type']; ?>]</span> 
                          <?php 
                          } 
                          # 
                          # ============== [/if] ============== #
                          ?>
                          <?php echo $row_RecordCatalog['title']; ?> <?php echo "(" . ShowBytes(filesize("upload/image/catalog/" . $row_RecordCatalog['pic'])) . ")" ?></td>
                         <td width="50" align="center" valign="middle" style="line-height:35px"><?php if ($row_RecordCatalog['pic'] != "") { ?>
                           <?php
                                    switch(GetFileExtend($row_RecordCatalog['pic']))
                                    {
                                        case ".pdf":
                                            echo "<a href=\"download.php?f=" . $row_RecordCatalog['pic']. "&ty=catalog" . "\"><img src=\"images/sicon/cat_01.png\" alt=\"ADOBE PDF\"/></a>\n";
                                            break;
                                        case ".xlsx":
                                            echo "<a href=\"download.php?f=" . $row_RecordCatalog['pic']. "&ty=catalog" . "\"><img src=\"images/sicon/cat_02.png\" alt=\"EXCEL\"/></a>\n";			
                                            break;
                                        case ".xls":
                                            echo "<a href=\"download.php?f=" . $row_RecordCatalog['pic']. "&ty=catalog" . "\"><img src=\"images/sicon/cat_02.png\" alt=\"EXCEL\"/></a>\n";			
                                            break;
                                        case ".doc":
                                            echo "<a href=\"download.php?f=" . $row_RecordCatalog['pic']. "&ty=catalog" . "\"><img src=\"images/sicon/cat_03.png\" alt=\"WORD\"/></a>\n";			
                                            break;
                                        case ".docx":
                                            echo "<a href=\"download.php?f=" . $row_RecordCatalog['pic']. "&ty=catalog" . "\"><img src=\"images/sicon/cat_03.png\" alt=\"WORD\"/></a>\n";			
                                            break;
                                        case ".rar":
                                            echo "<a href=\"download.php?f=" . $row_RecordCatalog['pic']. "&ty=catalog" . "\"><img src=\"images/sicon/cat_04.png\" alt=\"壓縮檔\"/></a>\n";			
                                            break;
                                        case ".zip":
                                            echo "<a href=\"download.php?f=" . $row_RecordCatalog['pic']. "&ty=catalog" . "\"><img src=\"images/sicon/cat_04.png\" alt=\"壓縮檔\"/></a>\n";	
                                            break;
                                        case ".avi":
                                            echo "<a href=\"download.php?f=" . $row_RecordCatalog['pic']. "&ty=catalog" . "\"><img src=\"images/sicon/cat_07.png\" alt=\"影片檔\"/></a>\n";	
                                            break;
                                        case ".ppt":
                                            echo "<a href=\"download.php?f=" . $row_RecordCatalog['pic']. "&ty=catalog" . "\"><img src=\"images/sicon/cat_08.png\" alt=\"POWERPOINT\"/></a>\n";			
                                            break;
                                        case ".pptx":
                                            echo "<a href=\"download.php?f=" . $row_RecordCatalog['pic']. "&ty=catalog" . "\"><img src=\"images/sicon/cat_08.png\" alt=\"POWERPOINT\"/></a>\n";			
                                            break;
                                        case ".jpg":
                                            echo "<a href=\"download.php?f=" . $row_RecordCatalog['pic']. "&ty=catalog" . "\"><img src=\"images/sicon/cat_05.png\" alt=\"圖片檔\"/></a>\n";			
                                            break;
                                        case ".gif":
                                            echo "<a href=\"download.php?f=" . $row_RecordCatalog['pic']. "&ty=catalog" . "\"><img src=\"images/sicon/cat_05.png\" alt=\"圖片檔\"/></a>\n";			
                                            break;
                                        case ".png":
                                            echo "<a href=\"download.php?f=" . $row_RecordCatalog['pic']. "&ty=catalog" . "\"><img src=\"images/sicon/cat_05.png\" alt=\"圖片檔\"/></a>\n";			
                                            break;
                                        case ".bmp":
                                            echo "<a href=\"download.php?f=" . $row_RecordCatalog['pic']. "&ty=catalog" . "\"><img src=\"images/sicon/cat_05.png\" alt=\"圖片檔\"/></a>\n";
                                            break;
                                        case ".jpeg":
                                            echo "<a href=\"download.php?f=" . $row_RecordCatalog['pic']. "&ty=catalog" . "\"><img src=\"images/sicon/cat_05.png\" alt=\"圖片檔\"/></a>\n";	
                                            break;	
                                        default:
                                            echo "<a href=\"download.php?f=" . $row_RecordCatalog['pic']. "&ty=catalog" . "\"><img src=\"images/sicon/cat_06.png\" alt=\"未知格式\"/>\n";
                                            break;
                                    }
                                ?>
                           <?php } else { ?>
                           <img src="images/sicon/cat_09.png" width="35" height="35" />
                         <?php }  ?></td>
                          <td width="150" align="center" valign="middle">
                          <?php echo highLight(date('Y-m-d',strtotime($row_RecordCatalog['postdate'])), @$_GET['searchkey'], $HighlightSelect); ?>
                          </td> 
                  </tr>
                       <?php 
                       $startRow_RecordCatalog++;
                       #
                       # ============== [/tr color change] ============== #
                       ?>
                  <?php 
                  #
                  # ============== [/while] ============== #
                  } while ($row_RecordCatalog = mysqli_fetch_assoc($RecordCatalog)); 
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
if ($totalRows_RecordCatalog == 0) { // Show if recordset empty 
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
<?php include($TplPath . "/catalog_view.php"); ?>
<?php } ?>

<?php
mysqli_free_result($RecordCatalog);
?>
