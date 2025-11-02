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
			$lastArray = ($page < $totalPages_RecordActivities) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordActivities</a>" : "<span>$next_RecordActivities</span>"/* 修改樣式 */;
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

$maxRows_RecordActivities = 15;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordActivities = $page * $maxRows_RecordActivities;

$collang_RecordActivities = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordActivities = $_GET['lang'];
}
$coltype_RecordActivities = "%";
if (isset($_GET['type'])) {
  $coltype_RecordActivities = $_GET['type'];
}
$colname_RecordActivities = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordActivities = $_GET['searchkey'];
}
$coluserid_RecordActivities = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordActivities = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
/*$query_RecordActivities = sprintf("SELECT demo_actalbum.act_id, demo_actalbum.userid, demo_actalbum.title, demo_actalbum.type, demo_actalbum.sdescription, demo_actalbum.indicate, demo_actalbum.author, demo_actalbum.postdate, demo_actalbumphoto.pic, demo_actalbumphoto.actphoto_id, demo_actalbum.lang, count(demo_actalbumphoto.act_id) AS photonum FROM demo_actalbum LEFT OUTER JOIN demo_actalbumphoto ON demo_actalbum.act_id = demo_actalbumphoto.act_id GROUP BY demo_actalbum.act_id HAVING (demo_actalbum.lang = %s) && (demo_actalbum.type LIKE %s) && ((demo_actalbum.title LIKE %s) || (demo_actalbum.postdate LIKE %s) || (demo_actalbum.author LIKE %s)) && userid=%s ORDER BY demo_actalbum.sortid ASC, demo_actalbum.act_id DESC", GetSQLValueString($collang_RecordActivities, "text"),GetSQLValueString("%" . $coltype_RecordActivities . "%", "text"),GetSQLValueString("%" . $colname_RecordActivities . "%", "text"),GetSQLValueString("%" . $colname_RecordActivities . "%", "text"),GetSQLValueString("%" . $colname_RecordActivities . "%", "text"),GetSQLValueString($coluserid_RecordActivities, "int"));*/

$query_RecordActivities = sprintf("SELECT * FROM demo_actalbum  WHERE (lang = %s) && (type LIKE %s) && ((title LIKE %s) || (postdate LIKE %s) || (author LIKE %s)) && userid=%s ORDER BY sortid ASC, act_id DESC", GetSQLValueString($collang_RecordActivities, "text"),GetSQLValueString("%" . $coltype_RecordActivities . "%", "text"),GetSQLValueString("%" . $colname_RecordActivities . "%", "text"),GetSQLValueString("%" . $colname_RecordActivities . "%", "text"),GetSQLValueString("%" . $colname_RecordActivities . "%", "text"),GetSQLValueString($coluserid_RecordActivities, "int"));

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

$collang_RecordActivitiesListType = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordActivitiesListType = $_GET['lang'];
}
$coluserid_RecordActivitiesListType = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordActivitiesListType = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordActivitiesListType = sprintf("SELECT * FROM demo_actitem WHERE list_id = 1 && lang = %s && userid=%s", GetSQLValueString($collang_RecordActivitiesListType, "text"),GetSQLValueString($coluserid_RecordActivitiesListType, "int"));
$RecordActivitiesListType = mysqli_query($DB_Conn, $query_RecordActivitiesListType) or die(mysqli_error($DB_Conn));
$row_RecordActivitiesListType = mysqli_fetch_assoc($RecordActivitiesListType);
$totalRows_RecordActivitiesListType = mysqli_num_rows($RecordActivitiesListType);

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

}

/* 外框 */
div .activities_inner_board{
	margin: 0px;
	padding: 0px;
	/*background-color: #FFF;*/
	width: 210px; /* 圖片寬度 + padding*2 + border*/
	/*border: 1px solid #DDD;*/
}

/* 外框 */
div .activities_inner_board .photoFram_Block_glossy, .div_activities_table-cell{	
    overflow:hidden;
    height: 110px; /* 設定區塊高度 */
	width: 150px;		

}

.activities_inner_board_relative{
	position: relative; /* FF 定位 */
}

.activities_inner_board_relative_buttom{
	position: relative; /* FF 定位 */
}

/* 圖片hide外框 */
.div_activities_table-cell{
	text-align: center;
	vertical-align: middle;
	background-color: #F9F9F9;
	border: 1px solid #DDD;	/*display:table-cell; /* 將此Div區塊當成表格 FF有BUG*/
}


/* IE6 hack */
.div_activities_table-cell span{
	height:100%;
	display:inline-block;
	background-image: none;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	}

/* 讓table-cell下的所有元素都居中 */
.div_activities_table-cell *{ vertical-align:middle;}

div .activities_inner_board_context{
	text-align: left;
}

/* 表格下方橫線 */
td.activities_down_board {
	background-color: #FAFAFA;
	padding: 5px;
}

/* 行與行之間高度 */
.activities_bottom_hight{
	height: 5px;
}

/* 前台表格隔行變色 */
tr.TR_Odd_Color_Style_Activities{
	/*background-color: #f1f1f1;*/
}
	
tr.TR_Even_Color_Style_Activities{
	/*background-color: #EAEDE9;*/
}

.div_right_bottom_Activities {
width:100px;
float:right;
right:0px;
bottom:0px;
z-index:20;
border:0px solid #69c;
_position:absolute; /* position fixed for IE6 */
}

</style>
<?php
/*********************************************************************
 # 主頁面活動花絮
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
<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="activities_outer_board">
    <tr>
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordActivities + 1) ?> - <?php echo min($startRow_RecordActivities + $maxRows_RecordActivities, $totalRows_RecordActivities) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordActivities ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
	  <?php if ($ActivitiesSearchSelect == "1") { ?>
      <form id="form_Activities" name="form_Activities" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <select name="type" id="type">
            <option value="%">-- 選擇類別 --</option>
            <?php
do {  
?>
            <option value="<?php echo $row_RecordActivitiesListType['itemname']?>"><?php echo $row_RecordActivitiesListType['itemname']?></option>
            <?php
} while ($row_RecordActivitiesListType = mysqli_fetch_assoc($RecordActivitiesListType));
  $rows = mysqli_num_rows($RecordActivitiesListType);
  if($rows > 0) {
      mysqli_data_seek($RecordActivitiesListType, 0);
	  $row_RecordActivitiesListType = mysqli_fetch_assoc($RecordActivitiesListType);
  }
?>
          </select>
          <img src="images/Search.png" width="20" height="20" align="absmiddle" />
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
&nbsp;<?php print $pages_navigation_RecordActivities[0]; ?> 
      <?php print $pages_navigation_RecordActivities[1]; ?> 
      <?php print $pages_navigation_RecordActivities[2]; ?>
      <?php if ($page < $totalPages_RecordActivities) { // Show if not last page ?>
  <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordActivities, $queryString_RecordActivities); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
&nbsp;  <?php if (ceil($totalRows_RecordActivities/$maxRows_RecordActivities) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordActivities/$maxRows_RecordActivities); ?></span>
<?php } ?>
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
if ($totalRows_RecordActivities > 0) { // Show if recordset not empty 
?>
<div class="columns on-1">
        <div class="container board">
            <div class="column">
                <div class="container ct_board">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="activities_outer_board">
      <!--<tr>
        <td width="125" valign="top"><?php echo $Lang_Classify_Context_ViewPic_Activities; // 圖片 ?></td>
        <td align="left" valign="top"><?php echo $Lang_Classify_Context_Title_Activities; // 標題 ?></td>
        <td width="80" valign="top"><?php echo $Lang_Classify_Context_PhotoNum_Activities; // 照片張數 ?></td>
        <td width="135" valign="top"><?php echo $Lang_Classify_Context_Date_Activities; // 日期 ?></td>
      </tr>-->
      
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
		  $oddtr='TR_Odd_Color_Style_Activities';
          $eventr='TR_Even_Color_Style_Activities';
          if(($startRow_RecordActivities)%2 == 0){
              $chahgecolorcount=$oddtr;
          }else{
              $chahgecolorcount=$eventr;
          }
          ?>
           <tr class= "<?php echo $chahgecolorcount; ?>">       
              <td width="150" valign="middle" class="activities_down_board">
              <?php 
			  #
              # ============== [if] ============== #
			  #
              # 判斷花絮中是否有相片，若無則以替代圖片顯示
              if ($row_RecordActivities['photonum'] > 0 && $row_RecordActivities['pic'] != "") { 
			  ?>
                <div class="activities_inner_board">
                <div class="photoFrame_photographic04">
                <div class="activities_inner_board_relative">
                <div class='photoFram_Block_clip'></div>
                  <div class="div_activities_table-cell"> <img src="upload/image/activities/thumb/small_<?php echo  GetFileThumbExtend($row_RecordActivities['pic']);?>" /><span></span>
                    </div> 
                </div>  
                </div>
                </div>
              <?php
			  #
			  # ============== [/if] ============== # 
			  #
			  # ============== [else] ============== # 
			  #
			  #
			  } else {
			  ?>
              <div class="activities_inner_board">
                <div class="photoFrame_photographic04">
                <div class="activities_inner_board_relative">
                <div class='photoFram_Block_clip'></div>
                  <div class="div_activities_table-cell">	 
                        <a><img src="<?php echo $TplImagePath ?>/act_noimage.jpg" width="120" height="80"/></a><span></span>
                  </div> 
                </div>  
                </div>
                </div>
                
                <?php
			  } 
			  # 
			  # ============== [/else] ============== #
			  ?>     
              </td>
             <td align="left" valign="middle"  class="activities_down_board">
              <?php 
              #
              # ============== [if] ============== #
			  #
              # 判斷是否顯示分類項目
              if($row_RecordActivities['type'] != "") { 
              ?>
                <span class="TipTypeStyle">[<?php echo highLight($row_RecordActivities['type'], @$_GET['searchkey'], $HighlightSelect); ?>]</span> 
              <?php 
              } 
              # 
			  # ============== [/if] ============== #
              ?>
              <?php 
			  #
              # ============== [if] ============== #
			  #
              # 判斷花絮中是否有相片，若無則連結取消
              if ($row_RecordActivities['photonum'] > 0 && $row_RecordActivities['pic'] != "") { 
			  ?>
              <a href="activities.php?Opt=detailed&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id=<?php echo $row_RecordActivities['act_id']; ?>"><?php echo $row_RecordActivities['title']; ?></a><br />
              <?php
			  #
			  # ============== [/if] ============== # 
			  #
			  # ============== [else] ============== # 
			  #
			  #
			  } else {
			  ?>
              <?php echo $row_RecordActivities['title']; ?><br />
              <?php 
              } 
              # 
			  # ============== [/else] ============== #
              ?>
			  <?php echo nl2br($row_RecordActivities['sdescription']); ?>
              <div class="div_right_bottom_Activities"></div>
             </td>
             <td valign="middle"  class="activities_down_board">
			  <?php 
		      #
              # ============== [if] ============== #
			  #
              # 判斷是否顯示照片張數
              if($row_RecordActivities['photonum'] != "") {
		  		echo "<span class=\"TipTypeStyle\">";
		  		echo $row_RecordActivities['photonum'] . "張相片";
				echo "</span>"; 
			  }
			  # 
			  # ============== [/if] ============== #
		 	  ?>
              </td>
              <td valign="middle"  class="activities_down_board"><?php echo highLight(date('Y-m-d',strtotime($row_RecordActivities['postdate'])), @$_GET['searchkey'], $HighlightSelect); ?></td> 
</tr>
           <tr class= "<?php echo $chahgecolorcount; ?>">
             <td valign="middle" class="activities_bottom_hight"></td>
             <td align="left" valign="middle" ></td>
             <td valign="middle"></td>
             <td valign="middle" ></td>
           </tr>
            <?php 
			$startRow_RecordActivities++;
			#
			# ============== [/tr color change] ============== #
			?>
      <?php 
      #
      # ============== [/while] ============== #
      } while ($row_RecordActivities = mysqli_fetch_assoc($RecordActivities)); 
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
jQuery(document).ready(function(){
/* 圖片不完全按比例自動 */
    $(window).load(function(){
	$('.div_table-cell img').each(function(){
		var x = 150; // 愈縮小之圖片寬度(目標圖片大小)
		var y = 150; // 愈縮小之圖片高度
		var w=$(this).width(), h=$(this).height();//
		if (w > x) { 
			var w_original=w, h_original=h;
			h = h * (x / w); 
			w = x; 
			if (h < y) { 
				w = w_original * (y / h_original); 
				h = y; 
			}
		}
		$(this).attr({width:w,height:h});
	});
    });
});
</script>

<script language="javascript" type="text/javascript">
    $(document).ready(function () { /* Div 自動調整100%高度 */
        $(".activities_inner_board").css("height", $("td.AutoHightTr").height()+"px");
    });
</script>

<script type="text/javascript" charset="utf-8">
/* prettyPhoto */
$(document).ready(function(){$("a[rel^='prettyPhoto']").prettyPhoto({slideshow:5E3,autoplay_slideshow:!0,keyboard_shortcuts:!0,show_title:!1})});
</script>
<?php } else { ?>
<?php include($TplPath . "/activities_view.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordActivities);

mysqli_free_result($RecordActivitiesListType);
?>
