<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($page,$totalPages_RecordKnowledge,$prev_RecordKnowledge,$next_RecordKnowledge,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordKnowledge,$totalRows_RecordKnowledge;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($page<=$totalPages_RecordKnowledge && $page>=0)
	{
		if ($page > ceil($max_links/2))
		{
			$fgp = $page - ceil($max_links/2) > 0 ? $page - ceil($max_links/2) : 1;
			$egp = $page + ceil($max_links/2);
			if ($egp >= $totalPages_RecordKnowledge)
			{
				$egp = $totalPages_RecordKnowledge+1;
				$fgp = $totalPages_RecordKnowledge - ($max_links-1) > 0 ? $totalPages_RecordKnowledge  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordKnowledge >= $max_links ? $max_links : $totalPages_RecordKnowledge+1;
		}
		if($totalPages_RecordKnowledge >= 1) {
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
			$firstArray = ($page > 0) ? "<a href=\"$_SERVER[PHP_SELF]?page=$precedente$_get_vars\">$prev_RecordKnowledge</a>" :  "<span>$prev_RecordKnowledge</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordKnowledge) + 1;
					$max_l = ($a*$maxRows_RecordKnowledge >= $totalRows_RecordKnowledge) ? $totalRows_RecordKnowledge : ($a*$maxRows_RecordKnowledge);
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
			$offset_end = $totalPages_RecordKnowledge;
			$lastArray = ($page < $totalPages_RecordKnowledge) ? "<a href=\"$_SERVER[PHP_SELF]?page=$successivo$_get_vars\">$next_RecordKnowledge</a>" : "<span>$next_RecordKnowledge</span>"; /* css */
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

$maxRows_RecordKnowledge = 15;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordKnowledge = $page * $maxRows_RecordKnowledge;

$colname_RecordKnowledge = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordKnowledge = $_GET['searchkey'];
}
$coluserid_RecordKnowledge = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordKnowledge = $_SESSION['userid'];
}
$coltype1_RecordKnowledge = "%";
if (isset($_GET['type1'])) {
  $coltype1_RecordKnowledge = $_GET['type1'];
}
$coltype2_RecordKnowledge = "%";
if (isset($_GET['type2'])) {
  $coltype2_RecordKnowledge = $_GET['type2'];
}
$coltype3_RecordKnowledge = "%";
if (isset($_GET['type3'])) {
  $coltype3_RecordKnowledge = $_GET['type3'];
}
$colnamelang_RecordKnowledge = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordKnowledge = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordKnowledge = sprintf("SELECT * FROM demo_knowledge WHERE ((name LIKE %s)) && lang = %s && type1 LIKE %s && type2 LIKE %s && type3 LIKE %s && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordKnowledge . "%", "text"),GetSQLValueString($colnamelang_RecordKnowledge, "text"),GetSQLValueString($coltype1_RecordKnowledge, "text"),GetSQLValueString($coltype2_RecordKnowledge, "text"),GetSQLValueString($coltype3_RecordKnowledge, "text"),GetSQLValueString($coluserid_RecordKnowledge, "int"));
$query_limit_RecordKnowledge = sprintf("%s LIMIT %d, %d", $query_RecordKnowledge, $startRow_RecordKnowledge, $maxRows_RecordKnowledge);
$RecordKnowledge = mysqli_query($DB_Conn, $query_limit_RecordKnowledge) or die(mysqli_error($DB_Conn));
$row_RecordKnowledge = mysqli_fetch_assoc($RecordKnowledge);

if (isset($_GET['totalRows_RecordKnowledge'])) {
  $totalRows_RecordKnowledge = $_GET['totalRows_RecordKnowledge'];
} else {
  $all_RecordKnowledge = mysqli_query($DB_Conn, $query_RecordKnowledge);
  $totalRows_RecordKnowledge = mysqli_num_rows($all_RecordKnowledge);
}
$totalPages_RecordKnowledge = ceil($totalRows_RecordKnowledge/$maxRows_RecordKnowledge)-1;


?>
<?php if ($MSTMP == 'default') { ?>
<style type="text/css">

.knowledge_outer_board{
}

.knowledge_outer_board tr td{

}

/* 外框 */
div .knowledge_inner_board{
	margin: 0px;
	padding: 0px;
	/*background-color: #FFF;*/
	width: 210px; /* 圖片寬度 + padding*2 + border*/
	/*border: 1px solid #DDD;*/
}

/* 外框 */
div .knowledge_inner_board .photoFram_Block_glossy, .div_knowledge_table-cell{	
    overflow:hidden;
    height: 110px; /* 設定區塊高度 */
	width: 150px;		

}

.knowledge_inner_board_relative{
	position: relative; /* FF 定位 */
}

.knowledge_inner_board_relative_buttom{
	position: relative; /* FF 定位 */
}

/* 圖片hide外框 */
.div_knowledge_table-cell{
	text-align: center;
	vertical-align: middle;
	background-color: #F9F9F9;
	border: 1px solid #DDD;	/*display:table-cell; /* 將此Div區塊當成表格 FF有BUG*/
}


/* IE6 hack */
.div_knowledge_table-cell span{
	height:100%;
	display:inline-block;
	background-image: none;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	}

/* 讓table-cell下的所有元素都居中 */
.div_knowledge_table-cell *{ vertical-align:middle;}

div .knowledge_inner_board_context{
	text-align: left;
}

/* 表格下方橫線 */
td.knowledge_down_board {
	background-color: #FAFAFA;
	padding: 5px;
}

/* 行與行之間高度 */
.knowledge_bottom_hight{
	height: 5px;
}

/* 前台表格隔行變色 */
tr.TR_Odd_Color_Style_Project{
	/*background-color: #f1f1f1;*/
}
	
tr.TR_Even_Color_Style_Project{
	/*background-color: #EAEDE9;*/
}

.div_right_bottom_Project {
width:100px;
float:right;
right:0px;
bottom:0px;
z-index:20;
border:0px solid #69c;
_position:absolute; /* position fixed for IE6 */
}

/*-----------------------------------*/
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
                <?php echo $Lang_Content_Title_Knowledge; // 標題文字 ?></h3>
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
      <td width="50%"><?php echo $Lang_Content_Count_Display; // 顯示 ?> <?php echo ($startRow_RecordKnowledge + 1) ?> - <?php echo min($startRow_RecordKnowledge + $maxRows_RecordKnowledge, $totalRows_RecordKnowledge) ?> <?php echo $Lang_Content_Count_Lots; //筆 ?> <?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordKnowledge ?> <?php echo $Lang_Content_Count_Lots; //筆 ?></td>
      <td width="50%" align="right">
      
      <?php if ($KnowledgeSearchSelect == "1") { ?>
      <form id="form_Knowledge" name="form_Knowledge" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search_Knowledge; ?>" />
        </label>
      </form>
      <?php } ?>
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordKnowledge = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordKnowledge = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordKnowledge = buildNavigation($page,$totalPages_RecordKnowledge,$prev_RecordKnowledge,$next_RecordKnowledge,$separator,$max_links,true); 
       ?>
      <?php if ($page > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?page=%d%s", $currentPage, 0, $queryString_RecordKnowledge); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordKnowledge[0]; ?> 
      <?php print $pages_navigation_RecordKnowledge[1]; ?> 
      <?php print $pages_navigation_RecordKnowledge[2]; ?>
      <?php if ($page < $totalPages_RecordKnowledge) { // Show if not last page ?>
  <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_RecordKnowledge, $queryString_RecordKnowledge); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordKnowledge/$maxRows_RecordKnowledge) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $page+1; ?> / <?php echo ceil($totalRows_RecordKnowledge/$maxRows_RecordKnowledge); ?></span><?php } ?>
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
if ($totalRows_RecordKnowledge > 0) { // Show if recordset not empty 
?> 
 <?php 
#
# ============== [if] ============== #
#
# 在此判斷式之內放置要顯示之內容
if ($totalRows_RecordKnowledge > 0) { // Show if recordset not empty 
?>
<div class="columns on-1">
        <div class="container board">
            <div class="column">
                <div class="container ct_board">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="knowledge_outer_board">
      <!--<tr>
        <td width="125" valign="top"><?php echo $Lang_Classify_Context_ViewPic_Knowledge; // 圖片 ?></td>
        <td align="left" valign="top"><?php echo $Lang_Classify_Context_Title_Knowledge; // 標題 ?></td>
        <td width="80" valign="top"><?php echo $Lang_Classify_Context_PhotoNum_Knowledge; // 照片張數 ?></td>
        <td width="135" valign="top"><?php echo $Lang_Classify_Context_Date_Knowledge; // 日期 ?></td>
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
		  $oddtr='TR_Odd_Color_Style_Knowledge';
          $eventr='TR_Even_Color_Style_Knowledge';
          if(($startRow_RecordKnowledge)%2 == 0){
              $chahgecolorcount=$oddtr;
          }else{
              $chahgecolorcount=$eventr;
          }
          ?>
           <tr class= "<?php echo $chahgecolorcount; ?>">       
              <td width="150" valign="middle" class="knowledge_down_board">
              <?php 
			  #
              # ============== [if] ============== #
			  #
              # 判斷花絮中是否有相片，若無則以替代圖片顯示
              if ($row_RecordKnowledge['photonum'] > 0 && $row_RecordKnowledge['pic'] != "") { 
			  ?>
                <div class="knowledge_inner_board">
                <div class="photoFrame_photographic04">
                <div class="knowledge_inner_board_relative">
                <div class='photoFram_Block_clip'></div>
                  <div class="div_knowledge_table-cell"> <img src="upload/image/knowledge/thumb/small_<?php echo  GetFileNameNoExt($row_RecordKnowledge['pic']) . ".jpg";?>" /><span></span>
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
              <div class="knowledge_inner_board">
                <div class="photoFrame_photographic04">
                <div class="knowledge_inner_board_relative">
                <div class='photoFram_Block_clip'></div>
                  <div class="div_knowledge_table-cell">	 
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
             <td align="left" valign="middle"  class="knowledge_down_board">
              <?php 
              #
              # ============== [if] ============== #
			  #
              # 判斷是否顯示分類項目
              if($row_RecordKnowledge['type'] != "") { 
              ?>
                <span class="TipTypeStyle">[<?php echo highLight($row_RecordKnowledge['type'], @$_GET['searchkey'], $HighlightSelect); ?>]</span> 
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
              if ($row_RecordKnowledge['photonum'] > 0 && $row_RecordKnowledge['pic'] != "") { 
			  ?>
              <a href="knowledge.php?Opt=detailed&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;knowledge_id=<?php echo $row_RecordKnowledge['act_id']; ?>"><?php echo $row_RecordKnowledge['title']; ?></a><br />
              <?php
			  #
			  # ============== [/if] ============== # 
			  #
			  # ============== [else] ============== # 
			  #
			  #
			  } else {
			  ?>
              <?php echo $row_RecordKnowledge['title']; ?><br />
              <?php 
              } 
              # 
			  # ============== [/else] ============== #
              ?>
			  <?php echo nl2br($row_RecordKnowledge['sdescription']); ?>
              <div class="div_right_bottom_Knowledge"></div>
             </td>
             <td valign="middle"  class="knowledge_down_board">
			  <?php 
		      #
              # ============== [if] ============== #
			  #
              # 判斷是否顯示照片張數
              if($row_RecordKnowledge['photonum'] != "") {
		  		echo "<span class=\"TipTypeStyle\">";
		  		echo $row_RecordKnowledge['photonum'] . "張相片";
				echo "</span>"; 
			  }
			  # 
			  # ============== [/if] ============== #
		 	  ?>
              </td>
              <td valign="middle"  class="knowledge_down_board"><?php echo highLight(date('Y-m-d',strtotime($row_RecordKnowledge['postdate'])), @$_GET['searchkey'], $HighlightSelect); ?></td> 
</tr>
           <tr class= "<?php echo $chahgecolorcount; ?>">
             <td valign="middle" class="knowledge_bottom_hight"></td>
             <td align="left" valign="middle" ></td>
             <td valign="middle"></td>
             <td valign="middle" ></td>
           </tr>
            <?php 
			$startRow_RecordKnowledge++;
			#
			# ============== [/tr color change] ============== #
			?>
      <?php 
      #
      # ============== [/while] ============== #
      } while ($row_RecordKnowledge = mysqli_fetch_assoc($RecordKnowledge)); 
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
} // Show if recordset not empty 
#
# ============== [/if] ============== #
?>
<?php 
#
# ============== [if] ============== #
#
# 判斷當無資料顯示時之畫面
if ($totalRows_RecordKnowledge == 0) { // Show if recordset empty 
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
<?php include($TplPath . "/knowledge_view.php"); ?>
<?php } ?>

<?php
mysqli_free_result($RecordKnowledge);
?>