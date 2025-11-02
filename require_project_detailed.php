<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($pageNum_RecordProject,$totalPages_RecordProject,$prev_RecordProject,$next_RecordProject,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordProject,$totalRows_RecordProject;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($pageNum_RecordProject<=$totalPages_RecordProject && $pageNum_RecordProject>=0)
	{
		if ($pageNum_RecordProject > ceil($max_links/2))
		{
			$fgp = $pageNum_RecordProject - ceil($max_links/2) > 0 ? $pageNum_RecordProject - ceil($max_links/2) : 1;
			$egp = $pageNum_RecordProject + ceil($max_links/2);
			if ($egp >= $totalPages_RecordProject)
			{
				$egp = $totalPages_RecordProject+1;
				$fgp = $totalPages_RecordProject - ($max_links-1) > 0 ? $totalPages_RecordProject  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordProject >= $max_links ? $max_links : $totalPages_RecordProject+1;
		}
		if($totalPages_RecordProject >= 1) {
			#	------------------------
			#	Searching for $_GET vars
			#	------------------------
			$_get_vars = '';			
			if(!empty($_GET) || !empty($HTTP_GET_VARS)){
				$_GET = empty($_GET) ? $HTTP_GET_VARS : $_GET;
				foreach ($_GET as $_get_name => $_get_value) {
					if ($_get_name != "pageNum_RecordProject") {
						$_get_vars .= "&$_get_name=$_get_value";
					}
				}
			}
			$successivo = $pageNum_RecordProject+1;
			$precedente = $pageNum_RecordProject-1;
			$firstArray = ($pageNum_RecordProject > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordProject=$precedente$_get_vars\">$prev_RecordProject</a>" :  "<span>$prev_RecordProject</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordProject) + 1;
					$max_l = ($a*$maxRows_RecordProject >= $totalRows_RecordProject) ? $totalRows_RecordProject : ($a*$maxRows_RecordProject);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageNum_RecordProject)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordProject=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "<span>"; /* css */
					$pagesArray .= "$textLink</span>"  . ($theNext < $egp-1 ? $separator : "");
				}
			}
			$theNext = $pageNum_RecordProject+1;
			$offset_end = $totalPages_RecordProject;
			$lastArray = ($pageNum_RecordProject < $totalPages_RecordProject) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordProject=$successivo$_get_vars\">$next_RecordProject</a>" : "<span>$next_RecordProject</span>"/* css */;
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

$maxRows_RecordProject = 24;
$pageNum_RecordProject = 0;
if (isset($_GET['pageNum_RecordProject'])) {
  $pageNum_RecordProject = $_GET['pageNum_RecordProject'];
}
$startRow_RecordProject = $pageNum_RecordProject * $maxRows_RecordProject;

$collang_RecordProject = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordProject = $_GET['lang'];
}
$coluserid_RecordProject = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordProject = $_SESSION['userid'];
}
$colactid_RecordProject = "-1";
if (isset($_GET['id'])) {
  $colactid_RecordProject = $_GET['id'];
}
$colname_RecordProject = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordProject = $_GET['searchkey'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProject = sprintf("SELECT demo_projectalbum.act_id, demo_projectalbum.userid, demo_projectalbum.title, demo_projectalbum.type, demo_projectalbumphoto.sdescription, demo_projectalbumphoto.pic, demo_projectalbum.indicate, demo_projectalbum.author, demo_projectalbum.startdate, demo_projectalbum.enddate, demo_projectalbum.location, demo_projectalbum.content, demo_projectalbumphoto.actphoto_id, demo_projectalbum.lang, demo_projectalbumphoto.sortid FROM demo_projectalbum LEFT OUTER JOIN demo_projectalbumphoto ON demo_projectalbum.act_id = demo_projectalbumphoto.act_id HAVING (demo_projectalbum.act_id = %s) && (demo_projectalbum.lang = %s) && ((demo_projectalbum.title LIKE %s) || (demo_projectalbum.author LIKE %s)) && demo_projectalbum.userid=%s ORDER BY demo_projectalbumphoto.sortid ASC, demo_projectalbumphoto.actphoto_id DESC", GetSQLValueString($colactid_RecordProject, "int"),GetSQLValueString($collang_RecordProject, "text"),GetSQLValueString("%" . $colname_RecordProject . "%", "text"),GetSQLValueString("%" . $colname_RecordProject . "%", "text"),GetSQLValueString($coluserid_RecordProject, "int"));
$query_limit_RecordProject = sprintf("%s LIMIT %d, %d", $query_RecordProject, $startRow_RecordProject, $maxRows_RecordProject);
$RecordProject = mysqli_query($DB_Conn, $query_limit_RecordProject) or die(mysqli_error($DB_Conn));
$row_RecordProject = mysqli_fetch_assoc($RecordProject);

if (isset($_GET['totalRows_RecordProject'])) {
  $totalRows_RecordProject = $_GET['totalRows_RecordProject'];
} else {
  $all_RecordProject = mysqli_query($DB_Conn, $query_RecordProject);
  $totalRows_RecordProject = mysqli_num_rows($all_RecordProject);
}
$totalPages_RecordProject = ceil($totalRows_RecordProject/$maxRows_RecordProject)-1;

$queryString_RecordProject = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecordProject") == false && 
        stristr($param, "totalRows_RecordProject") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordProject = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordProject = sprintf("&totalRows_RecordProject=%d%s", $totalRows_RecordProject, $queryString_RecordProject);
?>
<?php if ($MSTMP == 'default') { ?>
<style type="text/css">
.project_outer_board{
}

.project_outer_board tr td{
	margin: 0px;
	padding: 0px;
}

/* 外框 */
div .project_inner_board{
	/*background-color: #FFFDF7;*/
	/*width: 220px; /* 圖片寬度 + padding*2 + border*/
	/*border: 1px solid #FFF1C1;*/
	margin: 5px;
}

/* 外框 */
div .photoFram_Block_glossy, .div_table-cell{
	overflow:hidden;
	height: 150px; /* 設定區塊高度 */
	width: 150px;
	margin: 5px;
}

.project_inner_board_relative{
	position: relative; /* FF 定位 */
}

.project_inner_board_relative_buttom{
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

div .project_inner_board_context{
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
                <?php echo $Lang_Content_Title_Project; // 標題文字 ?></h3>
                </div>
            </div>
        </div>        
</div>

<?php
#
# ============== [/title] ============== #
?> 

<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
    <tr>
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordProject + 1) ?> - <?php echo min($startRow_RecordProject + $maxRows_RecordProject, $totalRows_RecordProject) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordProject ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
      <?php if ($ProjectSearchSelect == "1") { ?>
      <form id="form_Project" name="form_Project" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search_Project; ?>" />
        </label>
      </form>
      <?php } ?>
      
      
       
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordProject = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordProject = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordProject = buildNavigation($pageNum_RecordProject,$totalPages_RecordProject,$prev_RecordProject,$next_RecordProject,$separator,$max_links,true); 
       ?>
      <?php if ($pageNum_RecordProject > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RecordProject=%d%s", $currentPage, 0, $queryString_RecordProject); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordProject[0]; ?> 
      <?php print $pages_navigation_RecordProject[1]; ?> 
      <?php print $pages_navigation_RecordProject[2]; ?>
      <?php if ($pageNum_RecordProject < $totalPages_RecordProject) { // Show if not last page ?>
  <a href="<?php printf("%s?pageNum_RecordProject=%d%s", $currentPage, $totalPages_RecordProject, $queryString_RecordProject); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordProject/$maxRows_RecordProject) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $pageNum_RecordProject+1; ?> / <?php echo ceil($totalRows_RecordProject/$maxRows_RecordProject); ?></span><?php } ?>
      </div>  
      
      </td>
    </tr>
</table>

<?php 
#
# ============== [if] ============== #
#
# 在此判斷式之內放置要顯示之內容
if ($totalRows_RecordProject > 0) { // Show if recordset not empty 
?>
 <div class="columns on-1">
      <div class="container board">
      	<div class="column">
        <div class="container ct_board">
        <!-- 主題資訊 -->
        <div class="project_other_board">
        <?php if ($row_RecordProject['location'] != '') { ?>地點：<?php echo $row_RecordProject['location']; ?><?php } ?> <?php if  ($row_RecordProject['startdate'] != '' || $row_RecordProject['enddate'] != '') { ?><strong>時間：</strong><?php echo $row_RecordProject['startdate']; ?><?php if  ($row_RecordProject['startdate'] != '' && $row_RecordProject['enddate'] != '') { ?>~<?php } ?><?php echo $row_RecordProject['enddate']; ?><?php } ?>
        </div>

        <!-- 詳細內容資訊 -->
        <div class="project_context_board">
            <?php echo $row_RecordProject['content']; ?>
        </div>
      </div>
      </div>
     </div>
 </div>
 <hr />
 <div class="columns on-3">
      <div class="container board">
	  <?php $i=$startRow_RecordProject + 1; // 取得頁面第一項商品之編號 ?>
          <?php do { ?> 
          <div class="column">
              <div class="container project_inner_board">
                   <!-- 內容 -->
                   <div class="photoFrame_photographic03">
                	<div class="project_inner_board_relative">
                	<div class='photoFram_Block_paper-clip'></div>
                       <div class="div_table-cell">	 
                       <?php if ($row_RecordProject['pic'] != "") { ?>
                         <a href="upload/image/project/<?php echo $row_RecordProject['pic']; ?>" title="<?php echo $row_RecordProject['name']; ?>" rel="prettyPhoto[pp_gal]"><img src="upload/image/project/thumb/small_<?php echo $row_RecordProject['pic']; ?>" alt="<?php echo $row_RecordProject['sdescription']; ?>" alumb="true" _w="150" _h="150" /></a><span></span>
                         <?php } else { ?>      
                          <a><img src="images/100x80_noimage.jpg" width="100" height="80"/></a><span></span>
                          <?php } ?>
                       </div> 
                     </div>  
                   </div>
                   <div class="project_inner_board_context">
                   </div>
                   <!-- 內容 End-->
              </div>
          </div>
          <?php $i++; ?>
          <?php if ($i%3 == 1) {echo "<div class=\"column span-3\"><div class=\"container project_inner_board\"><hr></div></div>";}?>
          <?php } while ($row_RecordProject = mysqli_fetch_assoc($RecordProject)); ?>
      </div>
  </div>
  
<?php 
} // Show if recordset not empty 
#
# ============== [/if] ============== #
?>
<?php 
if ($totalRows_RecordProject == 0) { // Show if recordset empty 
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
?>
<script type="text/javascript">
/* 圖片(不)完全按比例自動縮圖 */
jQuery(document).ready(function(){$(window).load(function(){$(".div_table-cell img").each(function(){if("true"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");var c=$(this).width(),d=$(this).height(),a=$(this).attr("_w")/c,b=$(this).attr("_h")/d,e=1,e=a>b?b:a;$(this).width(c*e);$(this).height(d*e)}else if("false"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");$(this).width();$(this).height();c=$(this).attr("_w");d=$(this).attr("_h");
a=$(this).width();b=$(this).height();if(a>c){var e=a,f=b,b=b*(c/a),a=c;b<d&&(a=e*(d/f),b=d)}$(this).attr({width:a,height:b})}})})});
</script>

<script language="javascript" type="text/javascript">
    $(document).ready(function () { /* Div 自動調整100%高度 */
        //$(".project_inner_board").css("height", $(".AutoHightTr").height()+"px");
		 //$(".container").css("height", $(".column").height()+"px");
    });
</script>

<script type="text/javascript" charset="utf-8">
/* prettyPhoto */
$(document).ready(function(){$("a[rel^='prettyPhoto']").prettyPhoto({slideshow:5E3,autoplay_slideshow:!0,keyboard_shortcuts:!0,show_title:!1})});
</script>
<?php } else { ?>
<?php include($TplPath . "/project_detailed.php"); ?>
<?php } ?>

<?php
mysqli_free_result($RecordProject);
?>