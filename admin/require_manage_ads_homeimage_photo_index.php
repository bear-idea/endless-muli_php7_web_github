<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($pageNum_Recordset1,$totalPages_Recordset1,$prev_Recordset1,$next_Recordset1,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordAds,$totalRows_RecordAds;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($pageNum_Recordset1<=$totalPages_Recordset1 && $pageNum_Recordset1>=0)
	{
		if ($pageNum_Recordset1 > ceil($max_links/2))
		{
			$fgp = $pageNum_Recordset1 - ceil($max_links/2) > 0 ? $pageNum_Recordset1 - ceil($max_links/2) : 1;
			$egp = $pageNum_Recordset1 + ceil($max_links/2);
			if ($egp >= $totalPages_Recordset1)
			{
				$egp = $totalPages_Recordset1+1;
				$fgp = $totalPages_Recordset1 - ($max_links-1) > 0 ? $totalPages_Recordset1  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_Recordset1 >= $max_links ? $max_links : $totalPages_Recordset1+1;
		}
		if($totalPages_Recordset1 >= 1) {
			#	------------------------
			#	Searching for $_GET vars
			#	------------------------
			$_get_vars = '';			
			if(!empty($_GET) || !empty($HTTP_GET_VARS)){
				$_GET = empty($_GET) ? $HTTP_GET_VARS : $_GET;
				foreach ($_GET as $_get_name => $_get_value) {
					if ($_get_name != "pageNum_RecordAds") {
						if(is_array($_get_value)){
							$_get_vars .= "&$_get_name=" . urlencode(serialize($_get_value));
							}else {
							$_get_vars .= "&$_get_name=" . urlencode("$_get_value");
						}
					}
				}
			}
			$successivo = $pageNum_Recordset1+1;
			$precedente = $pageNum_Recordset1-1;
			$firstArray = ($pageNum_Recordset1 > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordAds=$precedente$_get_vars\">$prev_Recordset1</a>" :  "<span>$prev_Recordset1</span>"/*  css */;
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordAds) + 1;
					$max_l = ($a*$maxRows_RecordAds >= $totalRows_RecordAds) ? $totalRows_RecordAds : ($a*$maxRows_RecordAds);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageNum_Recordset1)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordAds=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "<span>"; /* css */
					$pagesArray .= "$textLink</span>"  . ($theNext < $egp-1 ? $separator : "");
				}
			}
			$theNext = $pageNum_Recordset1+1;
			$offset_end = $totalPages_Recordset1;
			$lastArray = ($pageNum_Recordset1 < $totalPages_Recordset1) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordAds=$successivo$_get_vars\">$next_Recordset1</a>" : "<span>$next_Record1</span>"; /* css */
		}
	}
	return array($firstArray,$pagesArray,$lastArray);
}
?>
<?php
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

/* 刪除活動花絮相片資料 */
if ((isset($_GET['actphoto_del_id'])) && ($_GET['actphoto_del_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_adtype_sub WHERE actphoto_id=%s",
                       GetSQLValueString($_GET['actphoto_del_id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  
  @unlink($SiteImgFilePathAdmin . $wshop . '/image/banner/' . $_GET['pic']);
  @unlink($SiteImgFilePathAdmin . $wshop . '/image/banner/thumb/small_' . GetFileThumbExtend($_GET['pic']));
}


/* 讀取資料 */
if (isset($_GET['pageNum_RecordAds'])) {
  $pageNum_RecordAds = $_GET['pageNum_RecordAds'];
}
$startRow_RecordAds = $pageNum_RecordAds * $maxRows_RecordAds;

$maxRows_RecordAds = 25;
$pageNum_RecordAds = 0;
if (isset($_GET['pageNum_RecordAds'])) {
  $pageNum_RecordAds = $_GET['pageNum_RecordAds'];
}
$startRow_RecordAds = $pageNum_RecordAds * $maxRows_RecordAds;

$collang_RecordAds = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordAds = $_GET['lang'];
}
$coluserid_RecordAds = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAds = $w_userid;
}
$colactid_RecordAds = "-1";
if (isset($_GET['act_id'])) {
  $colactid_RecordAds = $_GET['act_id'];
}
$colname_RecordAds = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordAds = $_GET['searchkey'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAds = sprintf("SELECT demo_adtype.act_id, demo_adtype.userid, demo_adtype.title, demo_adtype.type, demo_adtype_sub.sdescription, demo_adtype_sub.pic, demo_adtype_sub.indicate, demo_adtype_sub.modshow, demo_adtype.modstyle, demo_adtype.author, demo_adtype.startdate, demo_adtype.enddate, demo_adtype.style, demo_adtype.modstyle, demo_adtype.navigationstate, demo_adtype.tool, demo_adtype.theme, demo_adtype_sub.actphoto_id, demo_adtype_sub.sortid, demo_adtype_sub.animation, demo_adtype_sub.datatransition , demo_adtype.lang FROM demo_adtype LEFT OUTER JOIN demo_adtype_sub ON demo_adtype.act_id = demo_adtype_sub.act_id HAVING (demo_adtype.act_id = %s) && (demo_adtype.lang = %s) && ((demo_adtype.title LIKE %s) || (demo_adtype.author LIKE %s)) && demo_adtype.userid=%s ORDER BY demo_adtype_sub.actphoto_id DESC", GetSQLValueString($colactid_RecordAds, "int"),GetSQLValueString($collang_RecordAds, "text"),GetSQLValueString("%" . $colname_RecordAds . "%", "text"),GetSQLValueString("%" . $colname_RecordAds . "%", "text"),GetSQLValueString($coluserid_RecordAds, "int"));
$query_limit_RecordAds = sprintf("%s LIMIT %d, %d", $query_RecordAds, $startRow_RecordAds, $maxRows_RecordAds);
$RecordAds = mysqli_query($DB_Conn, $query_limit_RecordAds) or die(mysqli_error($DB_Conn));
$row_RecordAds = mysqli_fetch_assoc($RecordAds);

if (isset($_GET['totalRows_RecordAds'])) {
  $totalRows_RecordAds = $_GET['totalRows_RecordAds'];
} else {
  $all_RecordAds = mysqli_query($DB_Conn, $query_RecordAds);
  $totalRows_RecordAds = mysqli_num_rows($all_RecordAds);
}
$totalPages_RecordAds = ceil($totalRows_RecordAds/$maxRows_RecordAds)-1;

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAdsListAnimation = sprintf("SELECT * FROM demo_adtypeitem WHERE list_id = 1");
$RecordAdsListAnimation = mysqli_query($DB_Conn, $query_RecordAdsListAnimation) or die(mysqli_error($DB_Conn));
$row_RecordAdsListAnimation = mysqli_fetch_assoc($RecordAdsListAnimation);
$totalRows_RecordAdsListAnimation = mysqli_num_rows($RecordAdsListAnimation);

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAdsListDataTransition = sprintf("SELECT * FROM demo_adtypeitem WHERE list_id = 2");
$RecordAdsListDataTransition = mysqli_query($DB_Conn, $query_RecordAdsListDataTransition) or die(mysqli_error($DB_Conn));
$row_RecordAdsListDataTransition = mysqli_fetch_assoc($RecordAdsListDataTransition);
$totalRows_RecordAdsListDataTransition = mysqli_num_rows($RecordAdsListDataTransition);
?>
<style type="text/css">
/* 外框 */
div .photoFram_Block_glossy, .div_table-cell{
	overflow:hidden;
	height: 100px; /* 設定區塊高度 */
	width: 120px;
	margin: 5px;
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
</style>
<div>
  <div>
    
    <?php 
	  switch($_GET['Operate']) 
	  {
		  case "addSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('輪播分類新增成功！！','success');});</script>\n";
			break;
		  case "editSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('輪播分類修改成功！！','information');});</script>\n";
			break;
		  case "photoeditSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('輪播圖片修改成功！！','information');});</script>\n";
			break;
		  case "photoaddSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('輪播圖片新增成功！！','success');});</script>\n";
			break;
		  case "delSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('輪播圖片刪除成功！！','warning');});</script>\n";
			break;	
		  default:
		  	break;
	  }
	  ?>
     
    
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
      <tr>
        <td><h5><strong><font color="#756b5b">輪播</font><font color="#756b5b">圖</font><font color="#756b5b">片一覽 [<?php echo $langname; ?>編輯介面]</font></strong></h5></td>
        <td><?php require("fontresize.php"); // 改變字型大小 ?></td>
      </tr>
      </table>
    
    
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
      <tr>
        <td width="50%"> 顯示 <?php echo ($startRow_RecordAds + 1) ?> - <?php echo min($startRow_RecordAds + $maxRows_RecordAds, $totalRows_RecordAds) ?> 筆 共計 <?php echo $totalRows_RecordAds ?> 筆</td>
        <td width="50%" align="right">
          
          <?php if ($ManageAdsSearchSelect == "1") { // 搜索功能開啟設定?>
          <form id="form_Ads" name="form_Ads" method="get" action="<?php echo $editFormAction; ?>">
            <label>
              <input name="Opt" type="hidden" id="Opt" value="viewpage" />
              <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
              <img src="../images/Search.png" width="20" height="20" />
              <input type="text" name="searchkey" id="searchkey" data-original-title="搜尋標題" />
              <input type="submit" name="button" id="button" value="搜索" />
            </label>
          </form>
          <?php } ?>
          
           
          <?php 
			# variable declaration
			$prev_RecordAds = "«";
			$next_RecordAds = "»";
			$separator = "&nbsp;";
			$max_links = 6;
			$pages_navigation_RecordAds = buildNavigation($pageNum_RecordAds,$totalPages_RecordAds,$prev_RecordAds,$next_RecordAds,$separator,$max_links,true); 
			
			print $pages_navigation_RecordAds[0]; 
			?>
          <?php print $pages_navigation_RecordAds[1]; ?> 
          <?php print $pages_navigation_RecordAds[2]; ?>
          
        </td>
        </tr>
      <tr>
        <td colspan="2"><hr></td>
        </tr>
    </table>
    
    <?php if ($totalRows_RecordAds > 0 && $row_RecordAds['actphoto_id'] != "") { // Show if recordset not empty ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter" id="TBSort">
    <thead>
      <tr>
        <th width="23">&nbsp;</th>
        <th><strong>預覽</strong></th>
        <th><strong>輪播分類：<font color="#2865A2"><?php echo $row_RecordAds['title']; ?></font></strong>&nbsp;</th>
        <th width="70">排序</th>
        <th width="70"><strong>顯示</strong></th>
        <th width="150"><strong>動畫效果</strong></th>
        <th colspan="4"><strong>輪播圖片管理操作</strong></th>
      </tr>
      </thead>
      <tbody>
      <?php do { ?>
        <tr>
          <td align="left" valign="middle"><img src="images/sicon/play.gif" width="18" height="18" />
</td>
          <td width="130" valign="middle">
		  <?php if ($row_RecordAds['pic'] != "") { ?>
          <div class="div_table-cell">	 
            <a href="<?php echo $SiteImgUrlAdmin; ?><?php echo $wshop; ?>/image/banner/<?php echo $row_RecordAds['pic']; ?>" rel="clearbox[gallery=<?php echo $row_RecordAds['act_id']; ?> title=<?php echo $row_RecordAds['sdescription']; ?>]"><img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $wshop; ?>/image/banner/<?php echo  GetFileThumbExtend($row_RecordAds['pic']); ?>" alt="" alumb="true" _w="120" _h="100"/></a><span></span>
          </div>
            <?php } else { ?>
            <img src="images/actphoto_noimage.jpg" width="120" height="80" class="reflect"/>
          <?php } ?>
          </td>
          <td valign="middle">
            <div class="ed_sdescription" id="sdescription_<?php echo $row_RecordAds['actphoto_id']; ?>">
              <?php echo $row_RecordAds['sdescription']; ?>
              </div>
          </td>
          <td valign="middle"><div class="ed_sortid" id="sortid_<?php echo $row_RecordAds['actphoto_id']; ?>"><?php echo $row_RecordAds['sortid']; ?></div></td>
          <td valign="middle"><span class="ed_indicate" id="indicate_<?php echo $row_RecordAds['actphoto_id']; ?>">
			<?php 
			/* 判斷此會員是否要顯示 */
			if($row_RecordAds['indicate'] == "1") { 
				echo "<img src=\"images/indicate_show.gif\" width=\"11\" height=\"11\" /> 公布\n"; 
			} else { 
				echo "<img src=\"images/indicate_show_not.gif\" width=\"11\" height=\"11\" /> 隱藏\n";
			}
			?>  
        </span></td>
          <td valign="middle">
		  <?php if($row_RecordAds['modstyle'] == "0") { ?>
          <div class="ed_animation" id="animation_<?php echo $row_RecordAds['actphoto_id']; ?>"><?php echo $row_RecordAds['animation']; ?></div>
          <?php } else if ($row_RecordAds['modstyle'] == "1") { ?>
          <div class="ed_datatransition" id="datatransition_<?php echo $row_RecordAds['actphoto_id']; ?>"><?php echo $row_RecordAds['datatransition']; ?></div>
          <?php } ?>
          </td>
          <td width="45" align="left" valign="middle"class="MenuViewPage"><img src="images/nsee.gif" width="45" height="18" /></td>
          <td width="45" align="left" valign="middle" class="MenuViewPage"><a href="manage_ads_home_image.php?wshop=<?php echo $wshop;?>&amp;Opt=photoaddpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;act_id=<?php echo $row_RecordAds['act_id']; ?>"><img src="images/add.gif" alt="" width="45" height="18" /></a></td>
          <td width="45" align="left" valign="middle" class="MenuViewPage"><a href="manage_ads_home_image.php?wshop=<?php echo $wshop;?>&amp;Opt=photoeditpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;act_id=<?php echo $row_RecordAds['act_id']; ?>&amp;actphoto_id=<?php echo $row_RecordAds['actphoto_id']; ?>"><img src="images/edit.gif" alt="" width="45" height="18" /></a></td>
          <td width="49" align="left" valign="middle" class="MenuViewPage"><a href="manage_ads_home_image.php?wshop=<?php echo $wshop;?>&amp;Opt=photoviewpage&amp;actphoto_del_id=<?php echo $row_RecordAds['actphoto_id']; ?>&amp;Operate=delSuccess&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;act_id=<?php echo $row_RecordAds['act_id']; ?>&amp;pic=<?php echo $row_RecordAds['pic']; ?>"><img src="images/del.gif" width="45" height="18" /></a></td>
        </tr>
        <?php } while ($row_RecordAds = mysqli_fetch_assoc($RecordAds)); ?>
        </tbody>
    </table>
    <?php } // Show if recordset not empty ?>
    <?php if ($totalRows_RecordAds == 0) { // Show if recordset empty ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01_hover">
        <tr>
          <td width="23">&nbsp;</td>
          <td>&nbsp;</td>
          <td width="90">&nbsp;</td>
          <td width="45">&nbsp;</td>
          <td width="45">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="5" align="center" valign="top"><font color="#FF0000">目前尚無資料！！</font></td>
        </tr>
      </table>
      <?php } // Show if recordset empty ?>
  </div>
</div>
<script type="text/javascript">
/* 圖片(不)完全按比例自動縮圖 */
jQuery(document).ready(function(){$(window).load(function(){$(".div_table-cell img").each(function(){if("true"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");var c=$(this).width(),d=$(this).height(),a=$(this).attr("_w")/c,b=$(this).attr("_h")/d,e=1,e=a>b?b:a;$(this).width(c*e);$(this).height(d*e)}else if("false"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");$(this).width();$(this).height();c=$(this).attr("_w");d=$(this).attr("_h");
a=$(this).width();b=$(this).height();if(a>c){var e=a,f=b,b=b*(c/a),a=c;b<d&&(a=e*(d/f),b=d)}$(this).attr({width:a,height:b})}})})});
</script>
<script type="text/javascript">
$(document).ready(function() {
	$(".ed_sdescription").editable("sqledit/adtypephoto_jedit.php", 		{
		//cancel: '取消',
		submit: '修改',
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		select:true,
		width: "500px"
	});
	
	$(".ed_sortid").editable("sqledit/adtypephoto_jedit.php", 		{
		//cancel: '取消',
		submit: '修改',
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		select:true,
		width: "50px"
	});
	
	$(".ed_animation").editable("sqledit/adtypephoto_jedit.php", 		{
		loadurl : "sqledit/adtypephoto_get_list.php?lang=<?php echo $_SESSION['lang']; ?>&list_id=<?php echo $row_RecordAdsListAnimation['list_id']?>&<?php echo time();?>",
		type: "select",
		//cancel: '取消',
		submit : "修改",
		tooltip: '滑鼠點此可編輯此區塊...',
		indicator: '<img src="images/indicator.gif">',
		//event:"dblclick",
		style: "display: inline;"
	});
	
	$(".ed_datatransition").editable("sqledit/adtypephoto_jedit.php", 		{
		loadurl : "sqledit/adtypephoto_get_list.php?lang=<?php echo $_SESSION['lang']; ?>&list_id=<?php echo $row_RecordAdsListDataTransition['list_id']?>&<?php echo time();?>",
		type: "select",
		//cancel: '取消',
		submit : "修改",
		tooltip: '滑鼠點此可編輯此區塊...',
		indicator: '<img src="images/indicator.gif">',
		//event:"dblclick",
		style: "display: inline;"
	});
	
	$(".ed_indicate").editable("sqledit/adtypephoto_jedit_indicate.php", 	{
		type:   'checkbox',
		select:true,
  		//cancel: 'Cancel',
    	submit: '確認',
   		checkbox: { trueValue: '公佈', falseValue: '隱藏' }
	});

});
</script>
<?php
mysqli_free_result($RecordAds);

mysqli_free_result($RecordAdsListAnimation);

mysqli_free_result($RecordAdsListDataTransition);
?>
