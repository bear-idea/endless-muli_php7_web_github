<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($page,$totalPages_RecordSponsor,$prev_RecordSponsor,$next_RecordSponsor,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordSponsor,$totalRows_RecordSponsor;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($page<=$totalPages_RecordSponsor && $page>=0)
	{
		if ($page > ceil($max_links/2))
		{
			$fgp = $page - ceil($max_links/2) > 0 ? $page - ceil($max_links/2) : 1;
			$egp = $page + ceil($max_links/2);
			if ($egp >= $totalPages_RecordSponsor)
			{
				$egp = $totalPages_RecordSponsor+1;
				$fgp = $totalPages_RecordSponsor - ($max_links-1) > 0 ? $totalPages_RecordSponsor  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordSponsor >= $max_links ? $max_links : $totalPages_RecordSponsor+1;
		}
		if($totalPages_RecordSponsor >= 1) {
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
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordSponsor</a>" :  "<span>$prev_RecordSponsor</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordSponsor) + 1;
					$max_l = ($a*$maxRows_RecordSponsor >= $totalRows_RecordSponsor) ? $totalRows_RecordSponsor : ($a*$maxRows_RecordSponsor);
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
			$offset_end = $totalPages_RecordSponsor;
			$lastArray = ($page < $totalPages_RecordSponsor) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordSponsor</a>" : "<span>$next_RecordSponsor</span>"; /* css */
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

$maxRows_RecordSponsor = 24;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordSponsor = $page * $maxRows_RecordSponsor;

$colname_RecordSponsor = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordSponsor = $_GET['searchkey'];
}
$coluserid_RecordSponsor = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordSponsor = $_SESSION['userid'];
}
$colnamelang_RecordSponsor = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordSponsor = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSponsor = sprintf("SELECT * FROM demo_sponsor WHERE (name LIKE %s || type LIKE %s) && lang = %s && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordSponsor . "%", "text"),GetSQLValueString("%" . $colname_RecordSponsor . "%", "text"),GetSQLValueString($colnamelang_RecordSponsor, "text"),GetSQLValueString($coluserid_RecordSponsor, "int"));
$query_limit_RecordSponsor = sprintf("%s LIMIT %d, %d", $query_RecordSponsor, $startRow_RecordSponsor, $maxRows_RecordSponsor);
$RecordSponsor = mysqli_query($DB_Conn, $query_limit_RecordSponsor) or die(mysqli_error($DB_Conn));
$row_RecordSponsor = mysqli_fetch_assoc($RecordSponsor);

if (isset($_GET['totalRows_RecordSponsor'])) {
  $totalRows_RecordSponsor = $_GET['totalRows_RecordSponsor'];
} else {
  $all_RecordSponsor = mysqli_query($DB_Conn, $query_RecordSponsor);
  $totalRows_RecordSponsor = mysqli_num_rows($all_RecordSponsor);
}
$totalPages_RecordSponsor = ceil($totalRows_RecordSponsor/$maxRows_RecordSponsor)-1;

$queryString_RecordSponsor = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordSponsor") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordSponsor = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordSponsor = sprintf("&totalRows_RecordSponsor=%d%s", $totalRows_RecordSponsor, $queryString_RecordSponsor);


?>
<?php if ($MSTMP == 'default') { ?>
<style type="text/css">
.sponsor_outer_board{
}

.sponsor_outer_board tr td{
	margin: 0px;
	padding: 0px;
}

/* 外框 */
div .sponsor_inner_board{
	/*background-color: #FFFDF7;*/
	/*width: 220px; /* 圖片寬度 + padding*2 + border*/
	/*border: 1px solid #FFF1C1;*/
	margin: 5px;
}

/* 外框 */
div .photoFram_Block_glossy, .div_table-cell{
	overflow:hidden;
	height: 60px; /* 設定區塊高度 */
	width: 198px;
	/*margin: 5px;*/
}

.sponsor_inner_board_relative{
	position: relative; /* FF 定位 */
}

.sponsor_inner_board_relative_buttom{
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

div .sponsor_inner_board_context{
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
                <?php echo $Lang_Content_Title_Sponsor; // 標題文字 ?></h3>
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
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordSponsor + 1) ?> - <?php echo min($startRow_RecordSponsor + $maxRows_RecordSponsor, $totalRows_RecordSponsor) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordSponsor ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
      <?php if ($SponsorSearchSelect == "1") { ?>
      <form id="form_Sponsor" name="form_Sponsor" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search_Sponsor; ?>" />
        </label>
      </form>
      <?php } ?>
      
      
       
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordSponsor = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordSponsor = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordSponsor = buildNavigation($page,$totalPages_RecordSponsor,$prev_RecordSponsor,$next_RecordSponsor,$separator,$max_links,true); 
       ?>
      <?php if ($page > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordSponsor); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordSponsor[0]; ?> 
      <?php print $pages_navigation_RecordSponsor[1]; ?> 
      <?php print $pages_navigation_RecordSponsor[2]; ?>
      <?php if ($page < $totalPages_RecordSponsor) { // Show if not last page ?>
  <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordSponsor, $queryString_RecordSponsor); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordSponsor/$maxRows_RecordSponsor) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordSponsor/$maxRows_RecordSponsor); ?></span><?php } ?>
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
if ($totalRows_RecordSponsor > 0) { // Show if recordset not empty 
?> 
 <div class="columns on-1">
      <div class="container board">
	  <?php $i=$startRow_RecordSponsor + 1; // 取得頁面第一項商品之編號 ?>
          <?php do { ?> 
          <div class="column">
              <div class="container sponsor_inner_board">  
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="250">
                    <!-- 內容 -->
                    <div class="photoFrame_photographic03">
                    <div class="sponsor_inner_board_relative">
                    <div class='photoFram_Block_paper-clip'></div>
                      <div class="div_table-cell">
                      <?php if ($row_RecordSponsor['pic'] != "") { ?>	 
                            <a href="<?php echo $row_RecordSponsor['link']; ?>" target="_blank"><img src="upload/image/sponsor/<?php echo $row_RecordSponsor['pic']; ?>" alt="<?php echo $row_RecordSponsor['sdescription']; ?>" alumb="true" _w="198" _h="60"/></a><span></span>
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
                        if($row_RecordSponsor['type'] != "") { 
                        ?>
                        <span class="TipTypeStyle">[<?php echo $row_RecordSponsor['type']; ?>]</span> 
                        <?php 
                        } 
                        # 
                        # ============== [/if] ============== #
                        ?>
						<?php echo $row_RecordSponsor['name']; ?><br />
                        <?php echo $row_RecordSponsor['sdescription']; ?>
                    </td>
                  </tr>
                </table>
               
              </div>
          </div>
          <?php $i++; ?>
          <?php if ($i%1 == 0) {echo "<div class=\"column \"><div class=\"container sponsor_inner_board\"><hr></div></div>";}?>
          <?php } while ($row_RecordSponsor = mysqli_fetch_assoc($RecordSponsor)); ?>
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
if ($totalRows_RecordSponsor == 0) { // Show if recordset empty 
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
        //$(".sponsor_inner_board").css("height", $(".AutoHightTr").height()+"px");
		 //$(".container").css("height", $(".column").height()+"px");
    });
</script>

<script type="text/javascript" charset="utf-8">
/* prettyPhoto */
$(document).ready(function(){$("a[rel^='prettyPhoto']").prettyPhoto({slideshow:5E3,autoplay_slideshow:!0,keyboard_shortcuts:!0,show_title:!1})});
</script>
<?php } else { ?>
<?php include($TplPath . "/sponsor_view.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordSponsor);
?>
