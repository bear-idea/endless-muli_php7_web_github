<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($page,$totalPages_RecordRoom,$prev_RecordRoom,$next_RecordRoom,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordRoom,$totalRows_RecordRoom;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($page<=$totalPages_RecordRoom && $page>=0)
	{
		if ($page > ceil($max_links/2))
		{
			$fgp = $page - ceil($max_links/2) > 0 ? $page - ceil($max_links/2) : 1;
			$egp = $page + ceil($max_links/2);
			if ($egp >= $totalPages_RecordRoom)
			{
				$egp = $totalPages_RecordRoom+1;
				$fgp = $totalPages_RecordRoom - ($max_links-1) > 0 ? $totalPages_RecordRoom  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordRoom >= $max_links ? $max_links : $totalPages_RecordRoom+1;
		}
		if($totalPages_RecordRoom >= 1) {
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
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordRoom</a>" :  "<span>$prev_RecordRoom</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordRoom) + 1;
					$max_l = ($a*$maxRows_RecordRoom >= $totalRows_RecordRoom) ? $totalRows_RecordRoom : ($a*$maxRows_RecordRoom);
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
			$offset_end = $totalPages_RecordRoom;
			$lastArray = ($page < $totalPages_RecordRoom) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordRoom</a>" : "<span>$next_RecordRoom</span>"; /* css */
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

$maxRows_RecordRoom = 24;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordRoom = $page * $maxRows_RecordRoom;

$colname_RecordRoom = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordRoom = $_GET['searchkey'];
}
$coluserid_RecordRoom = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordRoom = $_SESSION['userid'];
}
$coltype1_RecordRoom = "%";
if (isset($_GET['type1'])) {
  $coltype1_RecordRoom = $_GET['type1'];
}
$coltype2_RecordRoom = "%";
if (isset($_GET['type2'])) {
  $coltype2_RecordRoom = $_GET['type2'];
}
$coltype3_RecordRoom = "%";
if (isset($_GET['type3'])) {
  $coltype3_RecordRoom = $_GET['type3'];
}
$colnamelang_RecordRoom = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordRoom = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordRoom = sprintf("SELECT * FROM demo_room WHERE ((name LIKE %s) || (pdseries LIKE %s)) && lang = %s && type1 LIKE %s && type2 LIKE %s && type3 LIKE %s && indicate = 1&& userid=%s && indicate=1 ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordRoom . "%", "text"),GetSQLValueString("%" . $colname_RecordRoom . "%", "text"),GetSQLValueString($colnamelang_RecordRoom, "text"),GetSQLValueString($coltype1_RecordRoom, "text"),GetSQLValueString($coltype2_RecordRoom, "text"),GetSQLValueString($coltype3_RecordRoom, "text"),GetSQLValueString($coluserid_RecordRoom, "int"));
$query_limit_RecordRoom = sprintf("%s LIMIT %d, %d", $query_RecordRoom, $startRow_RecordRoom, $maxRows_RecordRoom);
$RecordRoom = mysqli_query($DB_Conn, $query_limit_RecordRoom) or die(mysqli_error($DB_Conn));
$row_RecordRoom = mysqli_fetch_assoc($RecordRoom);

if (isset($_GET['totalRows_RecordRoom'])) {
  $totalRows_RecordRoom = $_GET['totalRows_RecordRoom'];
} else {
  $all_RecordRoom = mysqli_query($DB_Conn, $query_RecordRoom);
  $totalRows_RecordRoom = mysqli_num_rows($all_RecordRoom);
}
$totalPages_RecordRoom = ceil($totalRows_RecordRoom/$maxRows_RecordRoom)-1;

$queryString_RecordRoom = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows_RecordRoom") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordRoom = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordRoom = sprintf("&totalRows_RecordRoom=%d%s", $totalRows_RecordRoom, $queryString_RecordRoom);


?>
<?php if ($MSTMP == 'default') { ?>
<style type="text/css">
.room_outer_board{
}

.room_outer_board tr td{
	margin: 0px;
	padding: 0px;
}

/* 外框 */
div .room_inner_board{
	/*background-color: #FFFDF7;*/
	/*width: 220px; /* 圖片寬度 + padding*2 + border*/
	/*border: 1px solid #FFF1C1;*/
	margin: 5px;
}

/* 外框 */
div .photoFram_Block_glossy, .div_table-cell{
	overflow:hidden;
	height: 135px; /* 設定區塊高度 */
	width: 135px;
	margin: 5px;
}

.room_inner_board_relative{
	position: relative; /* FF 定位 */
}

.room_inner_board_relative_buttom{
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

div .room_inner_board_context{
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
                <?php echo $Lang_Content_Title_Room; // 標題文字 ?></h3>
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
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordRoom + 1) ?> - <?php echo min($startRow_RecordRoom + $maxRows_RecordRoom, $totalRows_RecordRoom) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordRoom ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
      <?php if ($RoomSearchSelect == "1") { ?>
      <form id="form_Room" name="form_Room" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search_Room; ?>" />
        </label>
      </form>
      <?php } ?>
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordRoom = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordRoom = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordRoom = buildNavigation($page,$totalPages_RecordRoom,$prev_RecordRoom,$next_RecordRoom,$separator,$max_links,true); 
       ?>
      <?php if ($page > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordRoom); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordRoom[0]; ?> 
      <?php print $pages_navigation_RecordRoom[1]; ?> 
      <?php print $pages_navigation_RecordRoom[2]; ?>
      <?php if ($page < $totalPages_RecordRoom) { // Show if not last page ?>
  <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordRoom, $queryString_RecordRoom); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordRoom/$maxRows_RecordRoom) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordRoom/$maxRows_RecordRoom); ?></span><?php } ?>
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
if ($totalRows_RecordRoom > 0) { // Show if recordset not empty 
?> 
 <div class="columns on-4">
      <div class="container board">
      <?php $i=$startRow_RecordRoom + 1; // 取得頁面第一項商品之編號 ?>
          <?php do { ?>
          <div class="column">
              <div class="container room_inner_board">
                <!-- 內容 -->
                
                <div class="photoFrame_photographic03">
                <div class="room_inner_board_relative">
                <div class='photoFram_Block_paper-clip'></div>
                  <div class="div_table-cell">
                  <?php // 判斷商品所在之層級
                                if($row_RecordRoom['type1'] != '-1' && $row_RecordRoom['type2'] != '-1' && $row_RecordRoom['type3'] != '-1') { $level='2'; }
                                else if($row_RecordRoom['type1'] != '-1' && $row_RecordRoom['type2'] != '-1' && $row_RecordRoom['type3'] == '-1') { $level='1'; }
                                else if($row_RecordRoom['type1'] != '-1' && $row_RecordRoom['type2'] == '-1' && $row_RecordRoom['type3'] == '-1') { $level='0'; }
                                else { $level=''; }
                            ?>
                  <?php if ($row_RecordRoom['pic'] != "") { ?>	 
                        <a href="room.php?Opt=detailed&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;tp=Room&amp;level=<?php echo $level; ?>&amp;type1=<?php echo $row_RecordRoom['type1']; ?>&amp;type2=<?php echo $row_RecordRoom['type2']; ?>&amp;type3=<?php echo $row_RecordRoom['type3']; ?>&amp;subitem_id=<?php echo $_GET['subitem_id']; ?>&amp;id=<?php echo $row_RecordRoom['id']; ?>" title="<?php echo $row_RecordRoom['name']; ?>"><img src="upload/image/room/thumb/small_<?php echo $row_RecordRoom['pic']; ?>" alt="<?php echo $row_RecordRoom['sdescription']; ?>" alumb="true" _w="135" _h="135"/></a><span></span>
                  <?php } else { ?>      
                  <a><img src="images/100x80_noimage.jpg" width="100" height="80"/></a><span></span>
                  <?php } ?>
                  </div> 
                </div>  
                </div>
                <form id="form1" name="form1" method="post" action="cart.php?Opt=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>">
                    <div class="room_inner_board_context">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="50" align="right" valign="top">名稱：</td>
                            <td>
                            <a href="room.php?Opt=detailed&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;tp=Room&amp;level=<?php echo $level; ?>&amp;type1=<?php echo $row_RecordRoom['type1']; ?>&amp;type2=<?php echo $row_RecordRoom['type2']; ?>&amp;type3=<?php echo $row_RecordRoom['type3']; ?>&amp;subitem_id=<?php echo $_GET['subitem_id']; ?>&amp;id=<?php echo $row_RecordRoom['id']; ?>"><span style="color: #666"><u><?php echo $row_RecordRoom['name']; ?></u></span></a>
                            </td>
                          </tr>
                          <?php if ($row_RecordRoom['pdseries'] !='') { ?>
                          <tr>
                            <td align="right" valign="top">貨號：</td>
                            <td><?php echo $row_RecordRoom['pdseries']; ?></td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordRoom['model'] !='') { ?>
                          <tr>
                            <td align="right" valign="top">規格：</td>
                            <td><?php echo $row_RecordRoom['model']; ?></td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordRoom['price'] !='') { ?>
                          <tr>
                            <td align="right" valign="top">價格：</td>
                            <td><?php echo "$"; ?><?php echo doFormatMoney($row_RecordRoom['price']); ?></td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordRoom['spprice'] !='') { ?>
                          <tr>
                            <td align="right" valign="top">特惠價：</td>
                            <td><?php echo "$"; ?><?php echo doFormatMoney($row_RecordRoom['spprice']); ?></td>
                          </tr>
                          <?php } ?>
                          <?php if ($row_RecordRoom['sdescription'] !='') { ?>
                          <tr>
                            <td align="right" valign="top">描述：</td>
                            <td><?php echo TrimByLength($row_RecordRoom['sdescription'], 25, false); ?></td>
                          </tr>
                          <?php } ?>
                        </table>
                  </div>   
                    <input name="id" type="hidden" id="id" value="<?php echo $row_RecordRoom['id']; ?>" />
                    <input name="pdseries" type="hidden" id="pdseries" value="<?php echo $row_RecordRoom['pdseries']; ?>" />
                    <input name="name" type="hidden" id="name" value="<?php echo $row_RecordRoom['name']; ?>" />
                    <input name="price" type="hidden" id="price" value="<?php echo $row_RecordRoom['price']; ?>" />
                </form>
                
                <!-- 內容 End-->
              </div>
          </div>
          <?php $i++; ?>
          <?php if ($i%4 == 1) {echo "<div class=\"column span-4\"><div class=\"container room_inner_board\"><hr></div></div>";}?>
          <?php } while ($row_RecordRoom = mysqli_fetch_assoc($RecordRoom)); ?>
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
if ($totalRows_RecordRoom == 0) { // Show if recordset empty 
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
<?php } else { ?>
<?php include($TplPath . "/room_view.php"); ?>
<?php } ?>

<?php
mysqli_free_result($RecordRoom);
?>