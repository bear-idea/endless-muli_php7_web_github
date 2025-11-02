<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($page,$totalPages_RecordActivities,$prev_RecordActivities,$next_RecordActivities,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordActivities,$totalRows_RecordActivities;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($page<=$totalPages_RecordActivities && $page>=0)
	{
		if ($page > ceil($max_links/2))
		{
			$fgp = $page - ceil($max_links/2) > 0 ? $page - ceil($max_links/2) : 1;
			$egp = $page + ceil($max_links/2);
			if ($egp >= $totalPages_RecordActivities)
			{
				$egp = $totalPages_RecordActivities+1;
				$fgp = $totalPages_RecordActivities - ($max_links-1) > 0 ? $totalPages_RecordActivities  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordActivities >= $max_links ? $max_links : $totalPages_RecordActivities+1;
		}
		if($totalPages_RecordActivities >= 1) {
			#	------------------------
			#	Searching for $_GET vars
			#	------------------------
			$_get_vars = '';			
			if(!empty($_GET) || !empty($HTTP_GET_VARS)){
				$_GET = empty($_GET) ? $HTTP_GET_VARS : $_GET;
				foreach ($_GET as $_get_name => $_get_value) {
					if ($_get_name != "page") {
						$_get_vars .= "&$_get_name=$_get_value";
					}
				}
			}
			$successivo = $page+1;
			$precedente = $page-1;
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordActivities</a>" :  "<span>$prev_RecordActivities</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordActivities) + 1;
					$max_l = ($a*$maxRows_RecordActivities >= $totalRows_RecordActivities) ? $totalRows_RecordActivities : ($a*$maxRows_RecordActivities);
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
			$offset_end = $totalPages_RecordActivities;
			$lastArray = ($page < $totalPages_RecordActivities) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordActivities</a>" : "<span>$next_RecordActivities</span>"/* css */;
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

$maxRows_RecordActivities = 24;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordActivities = $page * $maxRows_RecordActivities;

$collang_RecordActivities = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordActivities = $_GET['lang'];
}
$colactid_RecordActivities = "-1";
if (isset($_GET['id'])) {
  $colactid_RecordActivities = $_GET['id'];
}
$colname_RecordActivities = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordActivities = $_GET['searchkey'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordActivities = sprintf("SELECT demo_actalbum.act_id, demo_actalbum.title, demo_actalbum.type, demo_actalbumphoto.sdescription, demo_actalbumphoto.pic, demo_actalbum.indicate, demo_actalbum.author, demo_actalbum.startdate, demo_actalbum.enddate, demo_actalbum.location, demo_actalbum.content, demo_actalbumphoto.actphoto_id, demo_actalbum.lang, demo_actalbumphoto.sortid FROM demo_actalbum LEFT OUTER JOIN demo_actalbumphoto ON demo_actalbum.act_id = demo_actalbumphoto.act_id HAVING (demo_actalbum.act_id = %s) && (demo_actalbum.lang = %s) && ((demo_actalbum.title LIKE %s) || (demo_actalbum.author LIKE %s)) ORDER BY demo_actalbumphoto.sortid ASC, demo_actalbumphoto.actphoto_id DESC", GetSQLValueString($colactid_RecordActivities, "int"),GetSQLValueString($collang_RecordActivities, "text"),GetSQLValueString("%" . $colname_RecordActivities . "%", "text"),GetSQLValueString("%" . $colname_RecordActivities . "%", "text"));
$query_limit_RecordActivities = sprintf("%s LIMIT %d, %d", $query_RecordActivities, $startRow_RecordActivities, $maxRows_RecordActivities);
$RecordActivities = mysqli_query($DB_Conn, $query_limit_RecordActivities) or die(mysqli_error($DB_Conn));
$row_RecordActivities = mysqli_fetch_assoc($RecordActivities);

if (isset($_GET['totalRows_RecordActivities'])) {
  $totalRows_RecordActivities = $_GET['totalRows_RecordActivities'];
} else {
  $all_RecordActivities = mysqli_query($DB_Conn, $query_RecordActivities);
  $totalRows_RecordActivities = mysqli_num_rows($all_RecordActivities);
}
$totalPages_RecordActivities = ceil($totalRows_RecordActivities/$maxRows_RecordActivities)-1;

$queryString_RecordActivities = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordActivities") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordActivities = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordActivities = sprintf("&totalRows_RecordActivities=%d%s", $totalRows_RecordActivities, $queryString_RecordActivities);
?>
<?php if ($MSTMP == 'default') { ?>
<style type="text/css">

.activities_outer_board{
}

.activities_outer_board tr td{
	margin: 0px;
	padding: 0px;
}

/* 外框 */
div .activities_inner_board{
	/*background-color: #FFFDF7;*/
	/*width: 220px; /* 圖片寬度 + padding*2 + border*/
	/*border: 1px solid #FFF1C1;*/
	margin: 5px;
}

/* 外框 */
div .photoFram_Block_glossy, .div_table-cell{
	overflow:hidden;
	height: 150px; /* 設定區塊高度 */
	width: 200px;
	margin: 5px;
}

.activities_inner_board_relative{
	position: relative; /* FF 定位 */
}

.activities_inner_board_relative_buttom{
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

div .activities_inner_board_context{
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
                <?php echo $Lang_Content_Title_Activities; // 標題文字 ?></h3>
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
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordActivities + 1) ?> - <?php echo min($startRow_RecordActivities + $maxRows_RecordActivities, $totalRows_RecordActivities) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordActivities ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
      <?php if ($ActivitiesSearchSelect == "1") { ?>
      <form id="form_Activities" name="form_Activities" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search_Activities; ?>" />
        </label>
      </form>
      <?php } ?>
      
      
       
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordActivities = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordActivities = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordActivities = buildNavigation($page,$totalPages_RecordActivities,$prev_RecordActivities,$next_RecordActivities,$separator,$max_links,true); 
       ?>
      <?php if ($page > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordActivities); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordActivities[0]; ?> 
      <?php print $pages_navigation_RecordActivities[1]; ?> 
      <?php print $pages_navigation_RecordActivities[2]; ?>
      <?php if ($page < $totalPages_RecordActivities) { // Show if not last page ?>
  <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordActivities, $queryString_RecordActivities); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordActivities/$maxRows_RecordActivities) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordActivities/$maxRows_RecordActivities); ?></span><?php } ?>
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
if ($totalRows_RecordActivities > 0) { // Show if recordset not empty 
?>
 <div class="columns on-1">
      <div class="container board">
      	<div class="column">
        <div class="container ct_board">
        <!-- 主題資訊 -->
        <div class="activities_other_board">
        <?php if ($row_RecordActivities['location'] != '') { ?>地點：<?php echo $row_RecordActivities['location']; ?><?php } ?> <?php if  ($row_RecordActivities['startdate'] != '' || $row_RecordActivities['enddate'] != '') { ?><strong>時間：</strong><?php echo $row_RecordActivities['startdate']; ?><?php if  ($row_RecordActivities['startdate'] != '' && $row_RecordActivities['enddate'] != '') { ?>~<?php } ?><?php echo $row_RecordActivities['enddate']; ?><?php } ?>
        </div>

        <!-- 詳細內容資訊 -->
        <div class="activities_context_board">
            <?php echo $row_RecordActivities['content']; ?>
        </div>
      </div>
      </div>
     </div>
 </div>
 <hr />
 <div class="columns on-3">
      <div class="container board">
	  <?php $i=$startRow_RecordActivities + 1; // 取得頁面第一項商品之編號 ?>
          <?php do { ?> 
          <div class="column">
              <div class="container activities_inner_board">
                   <!-- 內容 -->
                   <div class="photoFrame_photographic03">
                	<div class="activities_inner_board_relative">
                	<div class='photoFram_Block_paper-clip'></div>
                       <div class="div_table-cell">	 
                       <?php if ($row_RecordActivities['pic'] != "") { ?>
                         <a href="upload/image/activities/<?php echo $row_RecordActivities['pic']; ?>" title="<?php echo $row_RecordActivities['name']; ?>" rel="prettyPhoto[pp_gal]"><img src="upload/image/activities/thumb/small_<?php echo GetFileThumbExtend($row_RecordActivities['pic']); ?>" alt="<?php echo $row_RecordActivities['sdescription']; ?>" alumb="false" _w="200" _h="150" /></a><span></span>
                         <?php } else { ?>      
                          <a><img src="images/100x80_noimage.jpg" width="100" height="80"/></a><span></span>
                          <?php } ?>
                       </div> 
                     </div>  
                   </div>
                   <div class="activities_inner_board_context">
                   </div>
                   <!-- 內容 End-->
              </div>
          </div>
          <?php $i++; ?>
          <?php if ($i%3 == 1) {echo "<div class=\"column span-3\"><div class=\"container activities_inner_board\"><hr></div></div>";}?>
          <?php } while ($row_RecordActivities = mysqli_fetch_assoc($RecordActivities)); ?>
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
if ($totalRows_RecordActivities == 0) { // Show if recordset empty 
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

<script language="javascript" type="text/javascript">
    $(document).ready(function () { /* Div 自動調整100%高度 */
        //$(".activities_inner_board").css("height", $(".AutoHightTr").height()+"px");
		 //$(".container").css("height", $(".column").height()+"px");
    });
</script>

<script type="text/javascript" charset="utf-8">
/* prettyPhoto */
$(document).ready(function(){$("a[rel^='prettyPhoto']").prettyPhoto({slideshow:5E3,autoplay_slideshow:!0,keyboard_shortcuts:!0,show_title:!1})});
</script>
<?php } else { ?>
<?php include($TplPath . "/activities_detailed.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordActivities);
?>