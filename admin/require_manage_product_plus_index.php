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
    GLOBAL $maxRows_RecordProductPlus,$totalRows_RecordProductPlus;
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
					if ($_get_name != "pagePlus") {
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
			$firstArray = ($pageNum_Recordset1 > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pagePlus=$precedente$_get_vars\">$prev_Recordset1</a>" :  "<span>$prev_Recordset1</span>"/*  css */;
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordProductPlus) + 1;
					$max_l = ($a*$maxRows_RecordProductPlus >= $totalRows_RecordProductPlus) ? $totalRows_RecordProductPlus : ($a*$maxRows_RecordProductPlus);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageNum_Recordset1)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pagePlus=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "<span>"; /* css */
					$pagesArray .= "$textLink</span>"  . ($theNext < $egp-1 ? $separator : "");
				}
			}
			$theNext = $pageNum_Recordset1+1;
			$offset_end = $totalPages_Recordset1;
			$lastArray = ($pageNum_Recordset1 < $totalPages_Recordset1) ? "<a href=\"$_SERVER[PHP_SELF]?pagePlus=$successivo$_get_vars\">$next_Recordset1</a>" : "<span>$next_Record1</span>"; /* css */
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

/* 刪除資料 */
if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_productplus WHERE id=%s",
                       GetSQLValueString($_GET['id_del'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}

/* 刪除多筆資料 */
if ((isset($_POST['delproductplus'])) && ($_POST['delproductplus'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_productplus WHERE id in (%s)", implode(",", $_POST['delproductplus']));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}

$maxRows_RecordProductPlus = 25;
$pagePlus = 0;
if (isset($_GET['pagePlus'])) {
  $pagePlus = $_GET['pagePlus'];
}
$startRow_RecordProductPlus = $pagePlus * $maxRows_RecordProductPlus;

$colname_RecordProductPlus = "-1";
if (isset($_GET['id'])) {
  $colname_RecordProductPlus = $_GET['id'];
}
$coluserid_RecordProductPlus = "-1";
if (isset($w_userid)) {
  $coluserid_RecordProductPlus = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductPlus = sprintf("SELECT * FROM demo_productplus WHERE pdid = %s && userid=%s", GetSQLValueString($colname_RecordProductPlus, "int"),GetSQLValueString($coluserid_RecordProductPlus, "int"));
$query_limit_RecordProductPlus = sprintf("%s LIMIT %d, %d", $query_RecordProductPlus, $startRow_RecordProductPlus, $maxRows_RecordProductPlus);
$RecordProductPlus = mysqli_query($DB_Conn, $query_limit_RecordProductPlus) or die(mysqli_error($DB_Conn));
$row_RecordProductPlus = mysqli_fetch_assoc($RecordProductPlus);

if (isset($_GET['totalRows_RecordProductPlus'])) {
  $totalRows_RecordProductPlus = $_GET['totalRows_RecordProductPlus'];
} else {
  $all_RecordProductPlus = mysqli_query($DB_Conn, $query_RecordProductPlus);
  $totalRows_RecordProductPlus = mysqli_num_rows($all_RecordProductPlus);
}
$totalPages_RecordProductPlus = ceil($totalRows_RecordProductPlus/$maxRows_RecordProductPlus)-1;

/* 刪除資料 */
if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_productplus WHERE id=%s",
                       GetSQLValueString($_GET['id_del'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  
  @unlink($SiteImgFilePathAdmin . $wshop . '/image/productplus/' . $_GET['pic']);
  @unlink($SiteImgFilePathAdmin . $wshop . '/image/productplus/thumb/small_' . GetFileThumbExtend($_GET['pic']));
}
?>
<script type="text/javascript">
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
</script>
<script type="text/javascript">
function flevToggleCheckboxes() { // v1.1
	// Copyright 2002, Marja Ribbers-de Vroed, FlevOOware (www.flevooware.nl/dreamweaver/)
	var sF = arguments[0], bT = arguments[1], bC = arguments[2], oF = MM_findObj(sF);
    for (var i=0; i<oF.length; i++) {
		if (oF[i].type == "checkbox") {if (bT) {oF[i].checked = !oF[i].checked;} else {oF[i].checked = bC;}}} 
}
</script>
<script type="text/javascript">
function tfm_confirmLink(message) { //v1.0
	if(message == "") message = "Ok to continue?";	
	document.MM_returnValue = confirm(message);
}
</script>
<style type="text/css">
/* 外框 */
div .photoFram_Block_glossy, .div_table-cell{
	overflow:hidden;
	height: 100px; /* 設定區塊高度 */
	width: 100px;
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
}
</style>
<body>
<div>
    <div>
      
      <?php 
	  switch($_POST['Operate']) 
	  {
		  case "addSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('資料新增成功！！','success');});</script>\n";
			break;
		  case "editSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('資料修改成功！！','information');});</script>\n";
			break;
		  case "delSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('資料刪除成功！！','warning');});</script>\n";
			break;	
		  default:
		  	switch($_GET['Operate']) 
	  		{
			  case "addSuccess":
				echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('資料新增成功！！','success');});</script>\n";
				break;
			  case "editSuccess":
				echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('資料修改成功！！','information');});</script>\n";
				break;
			  case "delSuccess":
				echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('資料刪除成功！！','warning');});</script>\n";
				break;	
			  default:
				break;
	 		 }
		  	break;
	  }
	  
	  ?>
       
      
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">加值商品一覽 [<?php echo $langname; ?>編輯介面]</font></strong></h5>
                       </td>
            <td><?php require("fontresize.php"); // 改變字型大小 ?></td>
        </tr>
      </table>
      
         
      
<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
          <tr>
          	<td width="50%"> 顯示 <?php echo ($startRow_RecordProductPlus + 1) ?> - <?php echo min($startRow_RecordProductPlus + $maxRows_RecordProductPlus, $totalRows_RecordProductPlus) ?> 筆 共計 <?php echo $totalRows_RecordProductPlus ?> 筆</td>
            <td width="50%" align="right">
            
            <?php if ($ManageProductSearchSelect == "1") { ?>
            <form id="form_Product" name="form_Product" method="get" action="<?php echo $editFormAction; ?>">
              <label>
                <input name="Opt" type="hidden" id="Opt" value="searchpage" />
                <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                <img src="../images/Search.png" width="20" height="20" align="absmiddle" />
                <input type="text" name="searchkey" id="searchkey" />
                <input type="submit" name="button" id="button" value="搜索" />
              </label>
            </form>
            
            <?php } ?>
            
            
            
            <div class="PageSelectBoard">
            <?php 
			# variable declaration
$prev_RecordProductPlus = "<i class=\"fa fa-angle-left\"></i>";
$next_RecordProductPlus = "<i class=\"fa fa-angle-right\"></i>";
$separator = "&nbsp;";
$max_links = 15;
$pages_navigation_RecordProductPlus = buildNavigation($pagePlus,$totalPages_RecordProductPlus,$prev_RecordProductPlus,$next_RecordProductPlus,$separator,$max_links,true); 

print $pages_navigation_RecordProductPlus[0]; 
			?>
            <?php print $pages_navigation_RecordProductPlus[1]; ?> 
			<?php print $pages_navigation_RecordProductPlus[2]; ?></div>     
            
            </td>
          </tr>
          <tr>
            <td colspan="2"><hr></td>
          </tr>
    </table>
    
    <?php if ($totalRows_RecordProductPlus > 0) { // Show if recordset not empty ?>
    <form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter" id="TBSort">
    <thead>
    <tr>
      <th width="23">&nbsp;</th>
      <th width="105"><strong>圖片</strong></th>
      <th><strong>名稱</strong><strong></strong></th>
      <th width="100"><strong>價格</strong></th>
      <th width="70"><strong>狀態</strong></th>
      <th colspan="4"><strong>操作</strong></th>
    </tr>
    </thead>
    <tbody>
    <?php do { ?>
      <tr>    
        <td>
        <?php 
		//
		if($ManageProductBatchDeleteSelect == "1") { /* 判斷是否開啟批次刪除功能 */
		?>
        <input name="delproductplus[]" type="checkbox" id="delproductplus[]" value="<?php echo $row_RecordProductPlus['id']; ?>" />
        <?php } else {?>
        <img src="images/sicon/play.gif" width="18" height="18" />

        <?php
		 } 
		 //
		 ?>
        </td>
        <td>
        <?php if ($row_RecordProductPlus['pluspic'] != "") { ?>
          <div class="div_table-cell">	 
            <a href="<?php echo $SiteImgUrlAdmin; ?><?php echo $wshop; ?>/image/productplus/<?php echo $row_RecordProductPlus['pluspic']; ?>" rel="clearbox[gallery=<?php echo $row_RecordProductPlus['name']; ?> title=<?php echo $row_RecordProductPlus['sdescription']; ?>]"><img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $wshop; ?>/image/productplus/thumb/small_<?php echo GetFileThumbExtend($row_RecordProductPlus['pluspic']); ?>" alt="<?php echo $row_RecordProductPlus['sdescription']; ?>" alumb="true" _w="100" _h="100"/></a><span></span>
          </div>
        <?php } else { ?>
          <img src="images/100x80_noimage.jpg" width="100" height="80"/>
        <?php } ?>
        </td>
        <td>
		<?php echo $row_RecordProductPlus['plusname']; ?>
		<?php echo $row_RecordProductPlus['plusdesc']; ?>
        </td>
        <td><?php echo $row_RecordProductPlus['plusprice']; ?></td>
        <td width="70">
          <?php 
			/* 判斷此會員是否要顯示 */
			if($row_RecordProductPlus['indicate'] == "1") { 
				echo "<img src=\"images/indicate_show.gif\" width=\"11\" height=\"11\" /> 公布\n"; 
			} else { 
				echo "<img src=\"images/indicate_show_not.gif\" width=\"11\" height=\"11\" /> 隱藏\n";
			}
			?>          
        </td>
        
        <td width="45" align="left" valign="middle" class="MenuViewPage"><img src="images/nsee.gif" width="45" height="18" /></td>
        <td width="45" align="left" valign="middle"class="MenuViewPage"><a href="manage_product.php?wshop=<?php echo $wshop;?>&amp;Opt=plusaddpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;pdid=<?php echo $_GET['id']; ?>&amp;pdname=<?php echo $_GET['pdname']; ?>"><img src="images/add.gif" width="45" height="18" /></a></td>
        <td width="45" align="left" valign="middle" class="MenuViewPage"><a href="manage_product.php?wshop=<?php echo $wshop;?>&amp;Opt=pluseditpage&amp;id_edit=<?php echo $row_RecordProductPlus['id']; ?>&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;pdid=<?php echo $_GET['id']; ?>&amp;pdname=<?php echo $_GET['pdname']; ?>"><img src="images/edit.gif" width="45" height="18" /></a></td>
        <td width="45" align="left" valign="middle" class="MenuViewPage"><a href="manage_product.php?wshop=<?php echo $wshop;?>&amp;Opt=pluspage&amp;id_del=<?php echo $row_RecordProductPlus['id']; ?>&amp;Operate=delSuccess&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;pic=<?php echo $row_RecordProductPlus['pluspic']; ?>&amp;id=<?php echo $_GET['id']; ?>&amp;pdname=<?php echo $_GET['pdname']; ?>"><img src="images/del.gif" width="45" height="18" /></a></td>       
      </tr>
      <?php } while ($row_RecordProductPlus = mysqli_fetch_assoc($RecordProductPlus)); ?>
      </tbody>
      <?php
	   //
	   if($ManageProductBatchDeleteSelect == "1") { /* 判斷是否開啟批次刪除功能 */
	   ?>
       <tfoot>
       <tr>
        <td align="right">└</td>
        <td colspan="3"><input name="button3" type="button" id="button3" onClick="flevToggleCheckboxes('form1',false,true);javascript:$(':checkbox').d_checkbox('check');" value="全選" />
          <input name="button5" type="button" id="button5" onClick="flevToggleCheckboxes('form1',true,false);javascript:$(':checkbox').d_checkbox('click');" value="反選" />          <input name="button4" type="button" id="button4" onClick="flevToggleCheckboxes('form1',false,false);javascript:$(':checkbox').d_checkbox('uncheck');" value="重置" /><input name="Operate" type="hidden" id="Operate" value="editSuccess" />
          <span class = "InnerPage" style="float:none;"><a href="#" data-original-title="您可在左方選取您欲刪除的項目，亦可透過左側之按鈕項目來配合使用，選擇完後點選右側《刪除選取項目》按鈕來進行多筆刪除。" data-toggle="tooltip" data-placement="right">?</a></span></td>
        <td align="right">&nbsp;</td>
        <td colspan="4" align="right"><input type="submit" name="button2" id="button2" value="刪除選取項目" onClick="tfm_confirmLink('此動作會刪除所有選取資料！！確定刪除紀錄嗎？');return document.MM_returnValue"/></td>
        </tr>
        </tfoot>
        <?php 
		} 
		//
		?>
  </table>
  </form>
  <?php } // Show if recordset not empty ?>
    <?php if ($totalRows_RecordProductPlus == 0) { // Show if recordset empty ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter" id="TBSort">
    <thead>
      <tr>
        <th>&nbsp;</th>
        <th colspan="4"><strong>操作</strong></th>
        </tr>
    </thead>
    <tbody>
      <tr>
        <td align="center" valign="middle"><font color="#FF0000">目前尚無資料！！</font></td>
        <td width="45" align="left" valign="middle"class="MenuViewPage"><img src="images/nsee.gif" width="45" height="18" /></td>
        <td width="49" align="left" valign="middle" class="MenuViewPage"><a href="manage_product.php?wshop=<?php echo $wshop;?>&amp;Opt=plusaddpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;pdid=<?php echo $_GET['id']; ?>&amp;pdname=<?php echo $_GET['pdname']; ?>"><img src="images/add.gif" alt="" width="45" height="18" /></a><a href="manage_product.php?wshop=<?php echo $wshop;?>&amp;Opt=postaddpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;pd_id=<?php echo $_GET['id']; ?>&amp;pdname=<?php echo $_GET['pdname']; ?>"></a></td>
        <td width="45" align="left" valign="middle" class="MenuViewPage"><img src="images/nedit.gif" alt="" width="45" height="18" /></td>
        <td width="49" align="left" valign="middle" class="MenuViewPage"><img src="images/ndel.gif" /></td>
      </tr>
    </tbody>
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
	$(".sortid").editable("sqledit/productplus_jedit.php", 	{
		//cancel: '取消',
		submit: '修改',
		select:true,
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		width: "25px"
	});
	
	$(".title").editable("sqledit/productplus_jedit.php", 		{
		//cancel: '取消',
		submit: '修改',
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		select:true,
		width: "500px"
	});
	
	$(".ed_author").editable("sqledit/productplus_jedit.php", 		{
		loadurl : "sqledit/productplus_get_list.php?lang=<?php echo $_SESSION['lang']; ?>&list_id=<?php echo $row_RecordProductPlusListAuthor['list_id']?>&<?php echo time();?>",
		type: "select",
		//cancel: '取消',
		submit : "修改",
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		indicator: '<img src="images/indicator.gif">'
	});
	
	$(".ed_type").editable("sqledit/productplus_jedit.php", 		{
		loadurl : "sqledit/productplus_get_list.php?lang=<?php echo $_SESSION['lang']; ?>&list_id=<?php echo $row_RecordProductPlusListType['list_id']?>&<?php echo time();?>",
		type: "select",
		//cancel: '取消',
		submit : "修改",
		tooltip: '滑鼠點此可編輯此區塊...',
		indicator: '<img src="images/indicator.gif">',
		//event:"dblclick",
		style: "display: inline;"
	});
});
</script>
<?php
mysqli_free_result($RecordProductPlus);
?>
