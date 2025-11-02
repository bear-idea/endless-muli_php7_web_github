<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($page,$totalPages_RecordProduct,$prev_RecordProduct,$next_RecordProduct,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordProduct,$totalRows_RecordProduct;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($page<=$totalPages_RecordProduct && $page>=0)
	{
		if ($page > ceil($max_links/2))
		{
			$fgp = $page - ceil($max_links/2) > 0 ? $page - ceil($max_links/2) : 1;
			$egp = $page + ceil($max_links/2);
			if ($egp >= $totalPages_RecordProduct)
			{
				$egp = $totalPages_RecordProduct+1;
				$fgp = $totalPages_RecordProduct - ($max_links-1) > 0 ? $totalPages_RecordProduct  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordProduct >= $max_links ? $max_links : $totalPages_RecordProduct+1;
		}
		if($totalPages_RecordProduct >= 1) {
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
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordProduct</a>" :  "<span>$prev_RecordProduct</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordProduct) + 1;
					$max_l = ($a*$maxRows_RecordProduct >= $totalRows_RecordProduct) ? $totalRows_RecordProduct : ($a*$maxRows_RecordProduct);
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
			$offset_end = $totalPages_RecordProduct;
			$lastArray = ($page < $totalPages_RecordProduct) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordProduct</a>" : "<span>$next_RecordProduct<span>"/* 修改樣式 */;
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

$maxRows_RecordProduct = 15;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordProduct = $page * $maxRows_RecordProduct;

$colname_RecordProduct = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordProduct = $_GET['searchkey'];
}
$coluserid_RecordProduct = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordProduct = $_SESSION['userid'];
}
$colnamelang_RecordProduct = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordProduct = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProduct = sprintf("SELECT * FROM demo_product WHERE ((name LIKE %s) || (pdseries LIKE %s)) && lang = %s && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordProduct . "%", "text"),GetSQLValueString("%" . $colname_RecordProduct . "%", "text"),GetSQLValueString($colnamelang_RecordProduct, "text"),GetSQLValueString($coluserid_RecordProduct, "int"));
$query_limit_RecordProduct = sprintf("%s LIMIT %d, %d", $query_RecordProduct, $startRow_RecordProduct, $maxRows_RecordProduct);
$RecordProduct = mysqli_query($DB_Conn, $query_limit_RecordProduct) or die(mysqli_error($DB_Conn));
$row_RecordProduct = mysqli_fetch_assoc($RecordProduct);

if (isset($_GET['totalRows_RecordProduct'])) {
  $totalRows_RecordProduct = $_GET['totalRows_RecordProduct'];
} else {
  $all_RecordProduct = mysqli_query($DB_Conn, $query_RecordProduct);
  $totalRows_RecordProduct = mysqli_num_rows($all_RecordProduct);
}
$totalPages_RecordProduct = ceil($totalRows_RecordProduct/$maxRows_RecordProduct)-1;

$queryString_RecordProduct = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordProduct") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordProduct = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordProduct = sprintf("&totalRows_RecordProduct=%d%s", $totalRows_RecordProduct, $queryString_RecordProduct);
?>

<style type="text/css">
.product_outer_board tr td{margin:0;padding:0}
div .product_inner_board{float:left;margin:5px;padding:5px;background-color:#FFFDF7;width:200px;border:1px solid #FFF1C1}
div .product_inner_board .photoFram_Block_glossy,.div_table-cell{overflow:hidden;height:150px;width:150px}
.product_inner_board_relative{position:relative}
.product_inner_board_relative_buttom{position:relative}
.div_table-cell{text-align:center;vertical-align:middle;background-color:#F9F9F9;border:1px solid #DDD}
.div_table-cell span{height:100%;display:inline-block;background-image:none;border-style:none}
.div_table-cell *{vertical-align:middle}
div .product_inner_board_context{text-align:left}
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
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
    <tr>
      <td>
	  <?php echo $Lang_Content_Title_Product; // 標題文字 ?></td>
    </tr>
</table>
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
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordProduct + 1) ?> - <?php echo min($startRow_RecordProduct + $maxRows_RecordProduct, $totalRows_RecordProduct) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordProduct ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
      <?php if ($ProductSearchSelect == "1") { ?>
      <form id="form_Product" name="form_Product" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search_Product; ?>" />
        </label>
      </form>
      <?php } ?>
      
      
       
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordProduct = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordProduct = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordProduct = buildNavigation($page,$totalPages_RecordProduct,$prev_RecordProduct,$next_RecordProduct,$separator,$max_links,true); 
       ?>
      <?php if ($page > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordProduct); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordProduct[0]; ?> 
      <?php print $pages_navigation_RecordProduct[1]; ?> 
      <?php print $pages_navigation_RecordProduct[2]; ?>
      <?php if ($page < $totalPages_RecordProduct) { // Show if not last page ?>
  <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordProduct, $queryString_RecordProduct); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordProduct/$maxRows_RecordProduct) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordProduct/$maxRows_RecordProduct); ?></span><?php } ?>
      </div>  
      
      </td>
    </tr>
    <tr>
      <td height="3" colspan="2"><hr></td>
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
if ($totalRows_RecordProduct > 0) { // Show if recordset not empty 
?>

<table border="0" cellpadding="0" cellspacing="0" class="product_outer_board">
      <tr>
        <?php
$RecordProduct_endRow = 0;
$RecordProduct_columns = 3; // number of columns
$RecordProduct_hloopRow1 = 0; // first row flag
do {
    if($RecordProduct_endRow == 0  && $RecordProduct_hloopRow1++ != 0) echo "<tr>";
   ?>
        <td align="center" valign="top" class="AutoHightTr"> 
        <!-- 內容 -->
        <div class="product_inner_board">
        <div class="photoFrame_photographic01">
        <div class="product_inner_board_relative">
        <div class='photoFram_Block_clip'></div>
       	  <div class="div_table-cell">
		  <?php if ($row_RecordProduct['pic'] != "") { ?>	 
        		<a href="upload/image/product/<?php echo $row_RecordProduct['pic']; ?>" title="<?php echo $row_RecordProduct['name']; ?>" rel="prettyPhoto[pp_gal]"><img src="upload/image/product/thumb/small_<?php echo GetFileThumbExtend($row_RecordProduct['pic']); ?>" alt="<?php echo $row_RecordProduct['sdescription']; ?>" alumb="true" _w="150" _h="150"/></a><span></span>
          <?php } else { ?>      
          <a><img src="images/100x80_noimage.jpg" width="100" height="80"/></a><span></span>
          <?php } ?>
          </div> 
        </div>  
        </div>
        <form id="form1" name="form1" method="post" action="cart.php?Opt=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
            <div class="product_inner_board_context">
            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50">名稱：</td>
                    <td><a href="product.php?Opt=detailed&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;mtype=Product&amp;id=<?php echo $row_RecordProduct['id']; ?>"><span style="color: #666"><u><?php echo $row_RecordProduct['name']; ?></u></span></a></td>
                  </tr>
                  <?php if ($row_RecordProduct['pdseries'] !='') { ?>
                  <tr>
                    <td>貨號：</td>
                    <td><?php echo $row_RecordProduct['pdseries']; ?></td>
                  </tr>
                  <?php } ?>
                  <?php if ($row_RecordProduct['model'] !='') { ?>
                  <tr>
                    <td>規格：</td>
                    <td><?php echo $row_RecordProduct['model']; ?></td>
                  </tr>
                  <?php } ?>
                  <?php if ($row_RecordProduct['price'] !='') { ?>
                  <tr>
                    <td>價格：</td>
                    <td><?php echo "$"; ?><?php echo doFormatMoney($row_RecordProduct['price']); ?>
                    <input type="image" src="images/buy.gif" onClick="document.formname.submit()"></td>
                  </tr>
                  <?php } ?>
                  <?php if ($row_RecordProduct['sdescription'] !='') { ?>
                  <tr>
                    <td valign="top">描述：</td>
                    <td><?php echo $row_RecordProduct['sdescription']; ?></td>
                  </tr>
                  <?php } ?>
                </table>
            </div>   
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordProduct['id']; ?>" />
            <input name="pdseries" type="hidden" id="pdseries" value="<?php echo $row_RecordProduct['pdseries']; ?>" />
			<input name="name" type="hidden" id="name" value="<?php echo $row_RecordProduct['name']; ?>" />
            <input name="price" type="hidden" id="price" value="<?php echo $row_RecordProduct['price']; ?>" />
        </form>
        </div>
        <!-- 內容 End-->
        </td>
        <?php  $RecordProduct_endRow++;
if($RecordProduct_endRow >= $RecordProduct_columns) {
  ?>
      </tr>
      <?php
 $RecordProduct_endRow = 0;
  }
} while ($row_RecordProduct = mysqli_fetch_assoc($RecordProduct));
if($RecordProduct_endRow != 0) {
while ($RecordProduct_endRow < $RecordProduct_columns) {
    echo("<td>&nbsp;</td>");
    $RecordProduct_endRow++;
}
echo("</tr>");
}?>
    </table>
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
if ($totalRows_RecordProduct == 0) { // Show if recordset empty 
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
        $(".product_inner_board").css("height", $("td.AutoHightTr").height()+"px");
    });
</script>

<script type="text/javascript" charset="utf-8">
/* prettyPhoto */
$(document).ready(function(){$("a[rel^='prettyPhoto']").prettyPhoto({slideshow:5E3,autoplay_slideshow:!0,keyboard_shortcuts:!0,show_title:!1})});
</script>

<?php
mysqli_free_result($RecordProduct);
?>
