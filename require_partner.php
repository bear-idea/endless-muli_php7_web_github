<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($page,$totalPages_RecordPartner,$prev_RecordPartner,$next_RecordPartner,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordPartner,$totalRows_RecordPartner;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($page<=$totalPages_RecordPartner && $page>=0)
	{
		if ($page > ceil($max_links/2))
		{
			$fgp = $page - ceil($max_links/2) > 0 ? $page - ceil($max_links/2) : 1;
			$egp = $page + ceil($max_links/2);
			if ($egp >= $totalPages_RecordPartner)
			{
				$egp = $totalPages_RecordPartner+1;
				$fgp = $totalPages_RecordPartner - ($max_links-1) > 0 ? $totalPages_RecordPartner  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordPartner >= $max_links ? $max_links : $totalPages_RecordPartner+1;
		}
		if($totalPages_RecordPartner >= 1) {
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
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordPartner</a>" :  "<span>$prev_RecordPartner</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordPartner) + 1;
					$max_l = ($a*$maxRows_RecordPartner >= $totalRows_RecordPartner) ? $totalRows_RecordPartner : ($a*$maxRows_RecordPartner);
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
			$offset_end = $totalPages_RecordPartner;
			$lastArray = ($page < $totalPages_RecordPartner) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordPartner</a>" : "<span>$next_RecordPartner</span>"; /* css */
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

$maxRows_RecordPartner = 24;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordPartner = $page * $maxRows_RecordPartner;

$colname_RecordPartner = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordPartner = $_GET['searchkey'];
}
$coluserid_RecordPartner = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordPartner = $_SESSION['userid'];
}
$colnamelang_RecordPartner = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordPartner = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordPartner = sprintf("SELECT * FROM demo_partner WHERE (name LIKE %s || type LIKE %s) && lang = %s && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordPartner . "%", "text"),GetSQLValueString("%" . $colname_RecordPartner . "%", "text"),GetSQLValueString($colnamelang_RecordPartner, "text"),GetSQLValueString($coluserid_RecordPartner, "int"));
$query_limit_RecordPartner = sprintf("%s LIMIT %d, %d", $query_RecordPartner, $startRow_RecordPartner, $maxRows_RecordPartner);
$RecordPartner = mysqli_query($DB_Conn, $query_limit_RecordPartner) or die(mysqli_error($DB_Conn));
$row_RecordPartner = mysqli_fetch_assoc($RecordPartner);

if (isset($_GET['totalRows_RecordPartner'])) {
  $totalRows_RecordPartner = $_GET['totalRows_RecordPartner'];
} else {
  $all_RecordPartner = mysqli_query($DB_Conn, $query_RecordPartner);
  $totalRows_RecordPartner = mysqli_num_rows($all_RecordPartner);
}
$totalPages_RecordPartner = ceil($totalRows_RecordPartner/$maxRows_RecordPartner)-1;

$queryString_RecordPartner = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordPartner") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordPartner = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordPartner = sprintf("&totalRows_RecordPartner=%d%s", $totalRows_RecordPartner, $queryString_RecordPartner);


?>
<?php if ($MSTMP == 'default') { ?>
<style type="text/css">
.partner_outer_board{
}

.partner_outer_board tr td{
	margin: 0px;
	padding: 0px;
}

/* 外框 */
div .partner_inner_board{
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

.partner_inner_board_relative{
	position: relative; /* FF 定位 */
}

.partner_inner_board_relative_buttom{
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

div .partner_inner_board_context{
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
                <?php echo $Lang_Content_Title_Partner; // 標題文字 ?></h3>
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
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordPartner + 1) ?> - <?php echo min($startRow_RecordPartner + $maxRows_RecordPartner, $totalRows_RecordPartner) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordPartner ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
      <?php if ($PartnerSearchSelect == "1") { ?>
      <form id="form_Partner" name="form_Partner" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search_Partner; ?>" />
        </label>
      </form>
      <?php } ?>
      
      
       
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordPartner = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordPartner = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordPartner = buildNavigation($page,$totalPages_RecordPartner,$prev_RecordPartner,$next_RecordPartner,$separator,$max_links,true); 
       ?>
      <?php if ($page > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordPartner); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordPartner[0]; ?> 
      <?php print $pages_navigation_RecordPartner[1]; ?> 
      <?php print $pages_navigation_RecordPartner[2]; ?>
      <?php if ($page < $totalPages_RecordPartner) { // Show if not last page ?>
  <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordPartner, $queryString_RecordPartner); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordPartner/$maxRows_RecordPartner) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordPartner/$maxRows_RecordPartner); ?></span><?php } ?>
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
if ($totalRows_RecordPartner > 0) { // Show if recordset not empty 
?> 
 <div class="columns on-1">
      <div class="container board">
	  <?php $i=$startRow_RecordPartner + 1; // 取得頁面第一項商品之編號 ?>
          <?php do { ?> 
          <div class="column">
              <div class="container partner_inner_board">  
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="250">
                    <!-- 內容 -->
                    <div class="photoFrame_photographic03">
                    <div class="partner_inner_board_relative">
                    <div class='photoFram_Block_paper-clip'></div>
                      <div class="div_table-cell">
                      <?php if ($row_RecordPartner['pic'] != "") { ?>	 
                            <a href="<?php echo $row_RecordPartner['link']; ?>" target="_blank"><img src="upload/image/partner/<?php echo $row_RecordPartner['pic']; ?>" alt="<?php echo $row_RecordPartner['sdescription']; ?>" alumb="true" _w="198" _h="60"/></a><span></span>
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
                        if($row_RecordPartner['type'] != "") { 
                        ?>
                        <span class="TipTypeStyle">[<?php echo $row_RecordPartner['type']; ?>]</span> 
                        <?php 
                        } 
                        # 
                        # ============== [/if] ============== #
                        ?>
						<?php echo $row_RecordPartner['name']; ?><br />
                        <?php echo $row_RecordPartner['sdescription']; ?>
                    </td>
                  </tr>
                </table>
               
              </div>
          </div>
          <?php $i++; ?>
          <?php if ($i%1 == 0) {echo "<div class=\"column \"><div class=\"container partner_inner_board\"><hr></div></div>";}?>
          <?php } while ($row_RecordPartner = mysqli_fetch_assoc($RecordPartner)); ?>
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
if ($totalRows_RecordPartner == 0) { // Show if recordset empty 
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
        //$(".partner_inner_board").css("height", $(".AutoHightTr").height()+"px");
		 //$(".container").css("height", $(".column").height()+"px");
    });
</script>

<script type="text/javascript" charset="utf-8">
/* prettyPhoto */
$(document).ready(function(){$("a[rel^='prettyPhoto']").prettyPhoto({slideshow:5E3,autoplay_slideshow:!0,keyboard_shortcuts:!0,show_title:!1})});
</script>
<?php } else { ?>
<?php include($TplPath . "/partner_view.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordPartner);
?>
