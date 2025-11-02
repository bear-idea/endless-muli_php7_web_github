<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($pageNum_RecordWebSite,$totalPages_RecordWebSite,$prev_RecordWebSite,$next_RecordWebSite,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordWebSite,$totalRows_RecordWebSite;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($pageNum_RecordWebSite<=$totalPages_RecordWebSite && $pageNum_RecordWebSite>=0)
	{
		if ($pageNum_RecordWebSite > ceil($max_links/2))
		{
			$fgp = $pageNum_RecordWebSite - ceil($max_links/2) > 0 ? $pageNum_RecordWebSite - ceil($max_links/2) : 1;
			$egp = $pageNum_RecordWebSite + ceil($max_links/2);
			if ($egp >= $totalPages_RecordWebSite)
			{
				$egp = $totalPages_RecordWebSite+1;
				$fgp = $totalPages_RecordWebSite - ($max_links-1) > 0 ? $totalPages_RecordWebSite  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordWebSite >= $max_links ? $max_links : $totalPages_RecordWebSite+1;
		}
		if($totalPages_RecordWebSite >= 1) {
			#	------------------------
			#	Searching for $_GET vars
			#	------------------------
			$_get_vars = '';			
			if(!empty($_GET) || !empty($HTTP_GET_VARS)){
				$_GET = empty($_GET) ? $HTTP_GET_VARS : $_GET;
				foreach ($_GET as $_get_name => $_get_value) {
					if ($_get_name != "pageNum_RecordWebSite") {
						if(is_array($_get_value)){
							$_get_vars .= "&$_get_name=" . urlencode(serialize($_get_value));
							}else {
							$_get_vars .= "&$_get_name=" . urlencode("$_get_value");
						}
					}
				}
			}
			$successivo = $pageNum_RecordWebSite+1;
			$precedente = $pageNum_RecordWebSite-1;
			$firstArray = ($pageNum_RecordWebSite > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordWebSite=$precedente$_get_vars\">$prev_RecordWebSite</a>" :  "<span>$prev_RecordWebSite</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordWebSite) + 1;
					$max_l = ($a*$maxRows_RecordWebSite >= $totalRows_RecordWebSite) ? $totalRows_RecordWebSite : ($a*$maxRows_RecordWebSite);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageNum_RecordWebSite)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordWebSite=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "<span>"; /* css */
					$pagesArray .= "$textLink</span>"  . ($theNext < $egp-1 ? $separator : "");
				}
			}
			$theNext = $pageNum_RecordWebSite+1;
			$offset_end = $totalPages_RecordWebSite;
			$lastArray = ($pageNum_RecordWebSite < $totalPages_RecordWebSite) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordWebSite=$successivo$_get_vars\">$next_RecordWebSite</a>" : "<span>$next_RecordWebSite</span>"; /* css */
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

$maxRows_RecordWebSite = 24;
$pageNum_RecordWebSite = 0;
if (isset($_GET['pageNum_RecordWebSite'])) {
  $pageNum_RecordWebSite = $_GET['pageNum_RecordWebSite'];
}
$startRow_RecordWebSite = $pageNum_RecordWebSite * $maxRows_RecordWebSite;

$colname_RecordWebSite = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordWebSite = $_GET['searchkey'];
}
$colnamelang_RecordWebSite = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordWebSite = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordWebSite = sprintf("SELECT * FROM demo_website WHERE (name LIKE %s || type LIKE %s) && lang = %s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordWebSite . "%", "text"),GetSQLValueString("%" . $colname_RecordWebSite . "%", "text"),GetSQLValueString($colnamelang_RecordWebSite, "text"));
$query_limit_RecordWebSite = sprintf("%s LIMIT %d, %d", $query_RecordWebSite, $startRow_RecordWebSite, $maxRows_RecordWebSite);
$RecordWebSite = mysqli_query($DB_Conn, $query_limit_RecordWebSite) or die(mysqli_error($DB_Conn));
$row_RecordWebSite = mysqli_fetch_assoc($RecordWebSite);

if (isset($_GET['totalRows_RecordWebSite'])) {
  $totalRows_RecordWebSite = $_GET['totalRows_RecordWebSite'];
} else {
  $all_RecordWebSite = mysqli_query($DB_Conn, $query_RecordWebSite);
  $totalRows_RecordWebSite = mysqli_num_rows($all_RecordWebSite);
}
$totalPages_RecordWebSite = ceil($totalRows_RecordWebSite/$maxRows_RecordWebSite)-1;

$queryString_RecordWebSite = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecordWebSite") == false && 
        stristr($param, "totalRows_RecordWebSite") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordWebSite = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordWebSite = sprintf("&totalRows_RecordWebSite=%d%s", $totalRows_RecordWebSite, $queryString_RecordWebSite);


?>

<style type="text/css">
.container{
	margin: 0px;
	padding: 0px;
}

.board{
	border: 1px solid #DDD;
}

.website_outer_board{
}

.website_outer_board tr td{
	margin: 0px;
	padding: 0px;
}

/* 外框 */
div .website_inner_board{
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
	/*margin: 5px;*/
}

.website_inner_board_relative{
	position: relative; /* FF 定位 */
}

.website_inner_board_relative_buttom{
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

div .website_inner_board_context{
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
                <?php echo $Lang_Content_Title_WebSite; // 標題文字 ?></h3>
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
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordWebSite + 1) ?> - <?php echo min($startRow_RecordWebSite + $maxRows_RecordWebSite, $totalRows_RecordWebSite) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordWebSite ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
      <?php if ($WebSiteSearchSelect == "1") { ?>
      <form id="form_WebSite" name="form_WebSite" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search_WebSite; ?>" />
        </label>
      </form>
      <?php } ?>  
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordWebSite = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordWebSite = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordWebSite = buildNavigation($pageNum_RecordWebSite,$totalPages_RecordWebSite,$prev_RecordWebSite,$next_RecordWebSite,$separator,$max_links,true); 
       ?>
      <?php if ($pageNum_RecordWebSite > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_RecordWebSite=%d%s", $currentPage, 0, $queryString_RecordWebSite); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordWebSite[0]; ?> 
      <?php print $pages_navigation_RecordWebSite[1]; ?> 
      <?php print $pages_navigation_RecordWebSite[2]; ?>
      <?php if ($pageNum_RecordWebSite < $totalPages_RecordWebSite) { // Show if not last page ?>
  <a href="<?php printf("%s?pageNum_RecordWebSite=%d%s", $currentPage, $totalPages_RecordWebSite, $queryString_RecordWebSite); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordWebSite/$maxRows_RecordWebSite) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $pageNum_RecordWebSite+1; ?> / <?php echo ceil($totalRows_RecordWebSite/$maxRows_RecordWebSite); ?></span><?php } ?>
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
if ($totalRows_RecordWebSite > 0) { // Show if recordset not empty 
?> 
 <div class="columns on-2">
      <div class="container board">
	  <?php $i=$startRow_RecordWebSite + 1; // 取得頁面第一項商品之編號 ?>
          <?php do { ?> 
          <div class="column">
              <div class="container website_inner_board">  
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="200">
                    <!-- 內容 -->
                    <div class="photoFrame_photographic03">
                    <div class="website_inner_board_relative">
                    <div class='photoFram_Block_paper-clip'></div>
                      <div class="div_table-cell">
                      <?php if ($row_RecordWebSite['pic'] != "") { ?>	 
                            <a href="<?php echo $row_RecordWebSite['link']; ?>" target="_blank"><img src="upload/image/web<?php echo $SiteImgUrl; ?><?php echo $row_RecordWebSite['pic']; ?>" alt="<?php echo $row_RecordWebSite['sdescription']; ?>" alumb="true" _w="150" _h="150"/></a><span></span>
                      <?php } else { ?>      
                      <a><img src="images/100x80_noimage.jpg" width="100" height="80"/></a><span></span>
                      <?php } ?>
                      </div> 
                    </div>
                    </div>
                    <!-- 內容 End-->
                    </td>
                    <td valign="middle">
						<?php 
                        #
                        # ============== [if] ============== #
                        #
                        # 判斷是否顯示分類項目
                        if($row_RecordWebSite['type'] != "") { 
                        ?>
                      <span class="TipTypeStyle">[<?php echo $row_RecordWebSite['type']; ?>]</span> 
                        <?php 
                        } 
                        # 
                        # ============== [/if] ============== #
                        ?>
						<?php echo $row_RecordWebSite['name']; ?><br />
                        <?php echo $row_RecordWebSite['sdescription']; ?>
                    </td>
                  </tr>
                </table>
               
              </div>
          </div>
          <?php $i++; ?>
          <?php if ($i%2 == 1) {echo "<div class=\"column span-2\"><div class=\"container website_inner_board\"><hr></div></div>";}?>
          <?php } while ($row_RecordWebSite = mysqli_fetch_assoc($RecordWebSite)); ?>
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
if ($totalRows_RecordWebSite == 0) { // Show if recordset empty 
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
        //$(".website_inner_board").css("height", $(".AutoHightTr").height()+"px");
		 //$(".container").css("height", $(".column").height()+"px");
    });
</script>

<script type="text/javascript" charset="utf-8">
/* prettyPhoto */
$(document).ready(function(){$("a[rel^='prettyPhoto']").prettyPhoto({slideshow:5E3,autoplay_slideshow:!0,keyboard_shortcuts:!0,show_title:!1})});
</script>

<?php
mysqli_free_result($RecordWebSite);
?>
