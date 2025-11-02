<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($page,$totalPages_RecordAlbum,$prev_RecordAlbum,$next_RecordAlbum,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordAlbum,$totalRows_RecordAlbum;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($page<=$totalPages_RecordAlbum && $page>=0)
	{
		if ($page > ceil($max_links/2))
		{
			$fgp = $page - ceil($max_links/2) > 0 ? $page - ceil($max_links/2) : 1;
			$egp = $page + ceil($max_links/2);
			if ($egp >= $totalPages_RecordAlbum)
			{
				$egp = $totalPages_RecordAlbum+1;
				$fgp = $totalPages_RecordAlbum - ($max_links-1) > 0 ? $totalPages_RecordAlbum  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordAlbum >= $max_links ? $max_links : $totalPages_RecordAlbum+1;
		}
		if($totalPages_RecordAlbum >= 1) {
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
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordAlbum</a>" :  "<span>$prev_RecordAlbum</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordAlbum) + 1;
					$max_l = ($a*$maxRows_RecordAlbum >= $totalRows_RecordAlbum) ? $totalRows_RecordAlbum : ($a*$maxRows_RecordAlbum);
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
			$offset_end = $totalPages_RecordAlbum;
			$lastArray = ($page < $totalPages_RecordAlbum) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordAlbum</a>" : "<span>$next_RecordAlbum</span>"/* css */;
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

$maxRows_RecordAlbum = 24;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordAlbum = $page * $maxRows_RecordAlbum;

$collang_RecordAlbum = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordAlbum = $_GET['lang'];
}
$coluserid_RecordAlbum = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordAlbum = $_SESSION['userid'];
}
$colactid_RecordAlbum = "-1";
if (isset($_GET['id'])) {
  $colactid_RecordAlbum = $_GET['id'];
}
$colname_RecordAlbum = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordAlbum = $_GET['searchkey'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAlbum = sprintf("SELECT demo_album.act_id, demo_album.userid, demo_album.title, demo_album.type, demo_albumphoto.sdescription, demo_albumphoto.pic, demo_album.indicate, demo_album.author, demo_album.startdate, demo_album.enddate, demo_album.location, demo_album.content, demo_albumphoto.actphoto_id, demo_album.lang, demo_albumphoto.sortid FROM demo_album LEFT OUTER JOIN demo_albumphoto ON demo_album.act_id = demo_albumphoto.act_id HAVING (demo_album.act_id = %s) && (demo_album.lang = %s) && ((demo_album.title LIKE %s) || (demo_album.author LIKE %s)) && demo_album.userid=%s ORDER BY demo_albumphoto.sortid ASC, demo_albumphoto.actphoto_id DESC", GetSQLValueString($colactid_RecordAlbum, "int"),GetSQLValueString($collang_RecordAlbum, "text"),GetSQLValueString("%" . $colname_RecordAlbum . "%", "text"),GetSQLValueString("%" . $colname_RecordAlbum . "%", "text"),GetSQLValueString($coluserid_RecordAlbum, "int"));
$query_limit_RecordAlbum = sprintf("%s LIMIT %d, %d", $query_RecordAlbum, $startRow_RecordAlbum, $maxRows_RecordAlbum);
$RecordAlbum = mysqli_query($DB_Conn, $query_limit_RecordAlbum) or die(mysqli_error($DB_Conn));
$row_RecordAlbum = mysqli_fetch_assoc($RecordAlbum);

if (isset($_GET['totalRows_RecordAlbum'])) {
  $totalRows_RecordAlbum = $_GET['totalRows_RecordAlbum'];
} else {
  $all_RecordAlbum = mysqli_query($DB_Conn, $query_RecordAlbum);
  $totalRows_RecordAlbum = mysqli_num_rows($all_RecordAlbum);
}
$totalPages_RecordAlbum = ceil($totalRows_RecordAlbum/$maxRows_RecordAlbum)-1;

$queryString_RecordAlbum = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordAlbum") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordAlbum = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordAlbum = sprintf("&totalRows_RecordAlbum=%d%s", $totalRows_RecordAlbum, $queryString_RecordAlbum);
?>
<?php if ($MSTMP == 'default') { ?>
<style type="text/css">
.album_outer_board{
}

.album_outer_board tr td{
	margin: 0px;
	padding: 0px;
}

/* 外框 */
div .album_inner_board{
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

.album_inner_board_relative{
	position: relative; /* FF 定位 */
}

.album_inner_board_relative_buttom{
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

div .album_inner_board_context{
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
                <?php echo $Lang_Content_Title_Album; // 標題文字 ?></h3>
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
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordAlbum + 1) ?> - <?php echo min($startRow_RecordAlbum + $maxRows_RecordAlbum, $totalRows_RecordAlbum) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordAlbum ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
      <?php if ($AlbumSearchSelect == "1") { ?>
      <form id="form_Album" name="form_Album" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search_Album; ?>" />
        </label>
      </form>
      <?php } ?>
      
      
       
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordAlbum = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordAlbum = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordAlbum = buildNavigation($page,$totalPages_RecordAlbum,$prev_RecordAlbum,$next_RecordAlbum,$separator,$max_links,true); 
       ?>
      <?php if ($page > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordAlbum); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordAlbum[0]; ?> 
      <?php print $pages_navigation_RecordAlbum[1]; ?> 
      <?php print $pages_navigation_RecordAlbum[2]; ?>
      <?php if ($page < $totalPages_RecordAlbum) { // Show if not last page ?>
  <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordAlbum, $queryString_RecordAlbum); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordAlbum/$maxRows_RecordAlbum) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordAlbum/$maxRows_RecordAlbum); ?></span><?php } ?>
      </div>  
      
      </td>
    </tr>
</table>

<?php 
#
# ============== [if] ============== #
#
# 在此判斷式之內放置要顯示之內容
if ($totalRows_RecordAlbum > 0) { // Show if recordset not empty 
?>
 <div class="columns on-1">
      <div class="container board">
      	<div class="column">
        <div class="container ct_board">
        <!-- 主題資訊 -->
        <div class="album_other_board">
        <?php if ($row_RecordAlbum['location'] != '') { ?>地點：<?php echo $row_RecordAlbum['location']; ?><?php } ?> <?php if  ($row_RecordAlbum['startdate'] != '' || $row_RecordAlbum['enddate'] != '') { ?><strong>時間：</strong><?php echo $row_RecordAlbum['startdate']; ?><?php if  ($row_RecordAlbum['startdate'] != '' && $row_RecordAlbum['enddate'] != '') { ?>~<?php } ?><?php echo $row_RecordAlbum['enddate']; ?><?php } ?>
        </div>

        <!-- 詳細內容資訊 -->
        <div class="album_context_board">
            <?php echo $row_RecordAlbum['content']; ?>
        </div>
      </div>
      </div>
     </div>
 </div>
 <hr />
 <div class="columns on-3">
      <div class="container board">
	  <?php $i=$startRow_RecordAlbum + 1; // 取得頁面第一項商品之編號 ?>
          <?php do { ?> 
          <div class="column">
              <div class="container album_inner_board">
                   <!-- 內容 -->
                   <div class="photoFrame_photographic03">
                	<div class="album_inner_board_relative">
                	<div class='photoFram_Block_paper-clip'></div>
                       <div class="div_table-cell">	 
                       <?php if ($row_RecordAlbum['pic'] != "") { ?>
                         <a href="upload/image/album/<?php echo $row_RecordAlbum['pic']; ?>" title="<?php echo $row_RecordAlbum['name']; ?>" rel="prettyPhoto[pp_gal]"><img src="upload/image/album/thumb/small_<?php echo $row_RecordAlbum['pic']; ?>" alt="<?php echo $row_RecordAlbum['sdescription']; ?>" alumb="true" _w="150" _h="150" /></a><span></span>
                         <?php } else { ?>      
                          <a><img src="images/100x80_noimage.jpg" width="100" height="80"/></a><span></span>
                          <?php } ?>
                       </div> 
                     </div>  
                   </div>
                   <div class="album_inner_board_context">
                   </div>
                   <!-- 內容 End-->
              </div>
          </div>
          <?php $i++; ?>
          <?php if ($i%3 == 1) {echo "<div class=\"column span-3\"><div class=\"container album_inner_board\"><hr></div></div>";}?>
          <?php } while ($row_RecordAlbum = mysqli_fetch_assoc($RecordAlbum)); ?>
      </div>
  </div>
  
<?php 
} // Show if recordset not empty 
#
# ============== [/if] ============== #
?>
<?php 
if ($totalRows_RecordAlbum == 0) { // Show if recordset empty 
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
        //$(".album_inner_board").css("height", $(".AutoHightTr").height()+"px");
		 //$(".container").css("height", $(".column").height()+"px");
    });
</script>

<script type="text/javascript" charset="utf-8">
/* prettyPhoto */
$(document).ready(function(){$("a[rel^='prettyPhoto']").prettyPhoto({slideshow:5E3,autoplay_slideshow:!0,keyboard_shortcuts:!0,show_title:!1})});
</script>
<?php } else { ?>
<?php include($TplPath . "/album_detailed.php"); ?>
<?php } ?>

<?php
mysqli_free_result($RecordAlbum);
?>