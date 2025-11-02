<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($page,$totalPages_RecordOrg,$prev_RecordOrg,$next_RecordOrg,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordOrg,$totalRows_RecordOrg;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($page<=$totalPages_RecordOrg && $page>=0)
	{
		if ($page > ceil($max_links/2))
		{
			$fgp = $page - ceil($max_links/2) > 0 ? $page - ceil($max_links/2) : 1;
			$egp = $page + ceil($max_links/2);
			if ($egp >= $totalPages_RecordOrg)
			{
				$egp = $totalPages_RecordOrg+1;
				$fgp = $totalPages_RecordOrg - ($max_links-1) > 0 ? $totalPages_RecordOrg  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordOrg >= $max_links ? $max_links : $totalPages_RecordOrg+1;
		}
		if($totalPages_RecordOrg >= 1) {
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
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordOrg</a>" :  "<span>$prev_RecordOrg</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordOrg) + 1;
					$max_l = ($a*$maxRows_RecordOrg >= $totalRows_RecordOrg) ? $totalRows_RecordOrg : ($a*$maxRows_RecordOrg);
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
			$offset_end = $totalPages_RecordOrg;
			$lastArray = ($page < $totalPages_RecordOrg) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordOrg</a>" : "<span>$next_RecordOrg</span>"; /* css */
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

$maxRows_RecordOrg = 24;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordOrg = $page * $maxRows_RecordOrg;

$colname_RecordOrg = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordOrg = $_GET['searchkey'];
}
$coluserid_RecordOrg = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordOrg = $_SESSION['userid'];
}
$colnamelang_RecordOrg = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordOrg = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordOrg = sprintf("SELECT * FROM demo_org WHERE (name LIKE %s || type LIKE %s) && lang = %s && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordOrg . "%", "text"),GetSQLValueString("%" . $colname_RecordOrg . "%", "text"),GetSQLValueString($colnamelang_RecordOrg, "text"),GetSQLValueString($coluserid_RecordOrg, "int"));
$query_limit_RecordOrg = sprintf("%s LIMIT %d, %d", $query_RecordOrg, $startRow_RecordOrg, $maxRows_RecordOrg);
$RecordOrg = mysqli_query($DB_Conn, $query_limit_RecordOrg) or die(mysqli_error($DB_Conn));
$row_RecordOrg = mysqli_fetch_assoc($RecordOrg);

if (isset($_GET['totalRows_RecordOrg'])) {
  $totalRows_RecordOrg = $_GET['totalRows_RecordOrg'];
} else {
  $all_RecordOrg = mysqli_query($DB_Conn, $query_RecordOrg);
  $totalRows_RecordOrg = mysqli_num_rows($all_RecordOrg);
}
$totalPages_RecordOrg = ceil($totalRows_RecordOrg/$maxRows_RecordOrg)-1;

$queryString_RecordOrg = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordOrg") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordOrg = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordOrg = sprintf("&totalRows_RecordOrg=%d%s", $totalRows_RecordOrg, $queryString_RecordOrg);


?>
<?php if ($MSTMP == 'default') { ?>
<style type="text/css">
.org_outer_board{
}
.org_outer_board tr td{
	margin: 0px;
	padding: 0px;
}
/* 外框 */
div .org_inner_board{
	/*background-color: #FFFDF7;*/
	/*width: 220px; /* 圖片寬度 + padding*2 + border*/
	/*border: 1px solid #FFF1C1;*/
	margin: 5px;
}
/* 外框 */
div .photoFram_Block_glossy, .div_table-cell{
	overflow:hidden;
	height: 100px; /* 設定區塊高度 */
	width: 100px;
	/*margin: 5px;*/
}
.org_inner_board_relative{
	position: relative; /* FF 定位 */
}
.org_inner_board_relative_buttom{
	position: relative; /* FF 定位 */
}
/* 圖片hide外框 */
.div_table-cell{
	text-align: center;
	vertical-align: middle;
	/*background-color: #F9F9F9;*/
	border: 1px solid #DDD;	/*display:table-cell; /* 將此Div區塊當成表格 FF有BUG*/
}
/* IE6 hack */
.div_table-cell span{
	height:100%;
	display:inline-block;
	background-image: none;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	}
/* 讓table-cell下的所有元素都居中 */
.div_table-cell *{ vertical-align:middle;}

div .org_inner_board_context{
	text-align: left;
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
                <?php echo $Lang_Content_Title_Org; // 標題文字 ?></h3>
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
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordOrg + 1) ?> - <?php echo min($startRow_RecordOrg + $maxRows_RecordOrg, $totalRows_RecordOrg) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordOrg ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
      <?php if ($OrgSearchSelect == "1") { ?>
      <form id="form_Org" name="form_Org" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search_Org; ?>" />
        </label>
      </form>
      <?php } ?>  
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordOrg = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordOrg = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordOrg = buildNavigation($page,$totalPages_RecordOrg,$prev_RecordOrg,$next_RecordOrg,$separator,$max_links,true); 
       ?>
      <?php if ($page > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordOrg); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordOrg[0]; ?> 
      <?php print $pages_navigation_RecordOrg[1]; ?> 
      <?php print $pages_navigation_RecordOrg[2]; ?>
      <?php if ($page < $totalPages_RecordOrg) { // Show if not last page ?>
  <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordOrg, $queryString_RecordOrg); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordOrg/$maxRows_RecordOrg) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordOrg/$maxRows_RecordOrg); ?></span><?php } ?>
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
if ($totalRows_RecordOrg > 0) { // Show if recordset not empty 
?> 
 <div class="columns on-2">
      <div class="container board">
	  <?php $i=$startRow_RecordOrg + 1; // 取得頁面第一項商品之編號 ?>
          <?php do { ?> 
          <div class="column">
              <div class="container org_inner_board">  
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="150">
                    <!-- 內容 -->
                    <div class="photoFrame_photographic03">
                    <div class="org_inner_board_relative">
                    <div class='photoFram_Block_paper-clip'></div>
                      <div class="div_table-cell">
                      <?php if ($row_RecordOrg['pic'] != "") { ?>	 
                            <a href="<?php echo $row_RecordOrg['link']; ?>" target="_blank"><img src="site/upload/image/org/<?php echo $row_RecordOrg['pic']; ?>" alt="<?php echo $row_RecordOrg['sdescription']; ?>" alumb="true" _w="100" _h="100"/></a><span></span>
                      <?php } else { ?>      
                      <a><img src="images/100x100_noimage.jpg" width="100" height="100"/></a><span></span>
                      <?php } ?>
                      </div> 
                    </div>
                    </div>
                    <!-- 內容 End-->
                    </td>
                    <td>[ 世界各地交易所 ]<br />
姓名：<?php echo $row_RecordOrg['name']; ?><br />
                      職稱：<?php echo $row_RecordOrg['title']; ?><br />
                      學歷：<?php echo $row_RecordOrg['education']; ?><br />
                      專長：<?php echo $row_RecordOrg['speciality']; ?><br />
                      電話：<?php echo $row_RecordOrg['phone']; ?><br />
                      信箱：<?php echo $row_RecordOrg['mail']; ?><br />
                    描述：<?php echo $row_RecordOrg['sdescription']; ?></td>
                  </tr>
                </table>
               
              </div>
          </div>
          <?php $i++; ?>
          <?php if ($i%2 == 1) {echo "<div class=\"column span-2\"><div class=\"container org_inner_board\"><hr></div></div>";}?>
          <?php } while ($row_RecordOrg = mysqli_fetch_assoc($RecordOrg)); ?>
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
if ($totalRows_RecordOrg == 0) { // Show if recordset empty 
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

<script type="text/javascript">
/* 圖片(不)完全按比例自動縮圖 */
jQuery(document).ready(function(){$(window).load(function(){$(".div_table-cell img").each(function(){if("true"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");var c=$(this).width(),d=$(this).height(),a=$(this).attr("_w")/c,b=$(this).attr("_h")/d,e=1,e=a>b?b:a;$(this).width(c*e);$(this).height(d*e)}else if("false"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");$(this).width();$(this).height();c=$(this).attr("_w");d=$(this).attr("_h");
a=$(this).width();b=$(this).height();if(a>c){var e=a,f=b,b=b*(c/a),a=c;b<d&&(a=e*(d/f),b=d)}$(this).attr({width:a,height:b})}})})});
</script>
<script type="text/javascript" charset="utf-8">
/* prettyPhoto */
$(document).ready(function(){$("a[rel^='prettyPhoto']").prettyPhoto({slideshow:5E3,autoplay_slideshow:!0,keyboard_shortcuts:!0,show_title:!1})});
</script>
<?php } else { ?>
<?php include($TplPath . "/org_view.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordOrg);
?>
