<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it  
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($pageNum_RecordTmp,$totalPages_RecordTmp,$prev_RecordTmp,$next_RecordTmp,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordTmp,$totalRows_RecordTmp;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($pageNum_RecordTmp<=$totalPages_RecordTmp && $pageNum_RecordTmp>=0)
	{
		if ($pageNum_RecordTmp > ceil($max_links/2))
		{
			$fgp = $pageNum_RecordTmp - ceil($max_links/2) > 0 ? $pageNum_RecordTmp - ceil($max_links/2) : 1;
			$egp = $pageNum_RecordTmp + ceil($max_links/2);
			if ($egp >= $totalPages_RecordTmp)
			{
				$egp = $totalPages_RecordTmp+1;
				$fgp = $totalPages_RecordTmp - ($max_links-1) > 0 ? $totalPages_RecordTmp  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordTmp >= $max_links ? $max_links : $totalPages_RecordTmp+1;
		}
		if($totalPages_RecordTmp >= 1) {
			#	------------------------
			#	Searching for $_GET vars
			#	------------------------
			$_get_vars = '';			
			if(!empty($_GET) || !empty($HTTP_GET_VARS)){
				$_GET = empty($_GET) ? $HTTP_GET_VARS : $_GET;
				foreach ($_GET as $_get_name => $_get_value) {
					if ($_get_name != "pageNum_RecordTmp") {
						if(is_array($_get_value)){
							$_get_vars .= "&$_get_name=" . urlencode(serialize($_get_value));
							}else {
							$_get_vars .= "&$_get_name=" . urlencode("$_get_value");
						}
					}
				}
			}
			$successivo = $pageNum_RecordTmp+1;
			$precedente = $pageNum_RecordTmp-1;
			$firstArray = ($pageNum_RecordTmp > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordTmp=$precedente$_get_vars\">$prev_RecordTmp</a>" :  "$prev_RecordTmp";
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordTmp) + 1;
					$max_l = ($a*$maxRows_RecordTmp >= $totalRows_RecordTmp) ? $totalRows_RecordTmp : ($a*$maxRows_RecordTmp);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageNum_RecordTmp)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordTmp=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "<span>"; /* css */
					$pagesArray .= "$textLink</span>"  . ($theNext < $egp-1 ? $separator : "");
				}
			}
			$theNext = $pageNum_RecordTmp+1;
			$offset_end = $totalPages_RecordTmp;
			$lastArray = ($pageNum_RecordTmp < $totalPages_RecordTmp) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordTmp=$successivo$_get_vars\">$next_RecordTmp</a>" : "$next_RecordTmp";
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
if ((isset($_GET['id_del'])) && ($_GET['id_del'] != "") && $_GET['userid'] == $w_userid) {
  $deleteSQL = sprintf("DELETE FROM demo_tmp_source WHERE id=%s",
                       GetSQLValueString($_GET['id_del'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  
  @unlink($SiteImgFilePathAdmin . $wshop . '/image/tmp/' . $_GET['pic']);
  
  // 刪除樣板橫幅
  $deleteSQLBanner = sprintf("DELETE FROM demo_tmpbanner WHERE tmpname=%s",
                       GetSQLValueString($_GET['tmpname'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultBanner = mysqli_query($DB_Conn, $deleteSQLBanner) or die(mysqli_error($DB_Conn));
  
  // 刪除樣板橫幅_SUB
  $deleteSQLBannerSub = sprintf("DELETE FROM demo_tmpbanner_sub WHERE act_id = (SELECT act_id FROM demo_tmpbanner WHERE tmpname=%s)",
                       GetSQLValueString($_GET['tmpname'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultBannerSub = mysqli_query($DB_Conn, $deleteSQLBannerSub) or die(mysqli_error($DB_Conn));
}

/* 刪除多筆資料 */
if ((isset($_POST['deltmp'])) && ($_POST['deltmp'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_tmp_source WHERE id in (%s)", implode(",", $_POST['deltmp']));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}

/* 重複區域 */
$maxRows_RecordTmp = 25;
$pageNum_RecordTmp = 0;
if (isset($_GET['pageNum_RecordTmp'])) {
  $pageNum_RecordTmp = $_GET['pageNum_RecordTmp'];
}
$startRow_RecordTmp = $pageNum_RecordTmp * $maxRows_RecordTmp;

/* 取得贊助企業資訊 */
$colname_RecordTmp = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordTmp = $_GET['searchkey'];
}
$coluserid_RecordTmp = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmp = $w_userid;
}
$coltype_RecordTmp = "%";
if (isset($_GET['type'])) {
  $coltype_RecordTmp = $_GET['type'];
}
$colnamelang_RecordTmp = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordTmp = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmp = sprintf("SELECT * FROM demo_tmp_source WHERE ((name LIKE %s)) && lang = %s  && (type LIKE %s) && (userid=%s || userid=1) ORDER BY postdate DESC, sortid ASC, type DESC", GetSQLValueString("%" . $colname_RecordTmp . "%", "text"),GetSQLValueString($colnamelang_RecordTmp, "text"),GetSQLValueString("%" . $coltype_RecordTmp . "%", "text"),GetSQLValueString($coluserid_RecordTmp, "int"));
$RecordTmp = mysqli_query($DB_Conn, $query_RecordTmp) or die(mysqli_error($DB_Conn));
$row_RecordTmp = mysqli_fetch_assoc($RecordTmp);
$totalRows_RecordTmp = mysqli_num_rows($RecordTmp);

/* 取得類別資料 */
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpListType = "SELECT * FROM demo_tmpitem WHERE list_id = 1";
$RecordTmpListType = mysqli_query($DB_Conn, $query_RecordTmpListType) or die(mysqli_error($DB_Conn));
$row_RecordTmpListType = mysqli_fetch_assoc($RecordTmpListType);
$totalRows_RecordTmpListType = mysqli_num_rows($RecordTmpListType);

/* 取得發佈者資料 */
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
<script type="text/javascript">
$(document).ready(function() {
	$('td.hidebuttom').hover(
			function(){
			$(this).find('.InnerPage').fadeIn(400);
		},
			function(){
			$(this).find('.InnerPage').fadeOut(400,function(){$(this).stop(true);});
	});
});
</script>
<style>
.div_table-cell{
	overflow: hidden;
	height: 100px; /* 設定區塊高度 */
	width: 100px;
	margin-right: auto;
	margin-left: auto;
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
            <td><h5><strong><font color="#756b5b">樣板一覽 [<?php echo $langname; ?>編輯介面]</font></strong></h5></td>
            <td><?php require("fontresize.php"); // 改變字型大小 ?></td>
        </tr>
      </table>
      
         
      
<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
          <tr>
          	<td width="50%"> 顯示 <?php echo ($startRow_RecordTmp + 1) ?> - <?php echo min($startRow_RecordTmp + $maxRows_RecordTmp, $totalRows_RecordTmp) ?> 筆 共計 <?php echo $totalRows_RecordTmp ?> 筆</td>
            <td width="50%" align="right">
            
            <?php if ($ManageTmpSearchSelect == "1") { ?>
            <form id="form_Tmp" name="form_Tmp" method="get" action="<?php echo $editFormAction; ?>">
              <select name="type" id="type">
                <option value="%" selected="selected">-- 選擇類別 --</option>
                <?php
do {  
?>
                <option value="<?php echo $row_RecordTmpListType['itemname']?>"><?php echo $row_RecordTmpListType['itemname']?></option>
                <?php
} while ($row_RecordTmpListType = mysqli_fetch_assoc($RecordTmpListType));
  $rows = mysqli_num_rows($RecordTmpListType);
  if($rows > 0) {
      mysqli_data_seek($RecordTmpListType, 0);
	  $row_RecordTmpListType = mysqli_fetch_assoc($RecordTmpListType);
  }
?>
              </select>
              <input name="Opt" type="hidden" id="Opt" value="viewpage" />
                <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                <img src="../images/Search.png" width="20" height="20" align="absmiddle" />
              <input type="text" name="searchkey" id="searchkey" />
                <input type="submit" name="button" id="button" value="搜索" />
              
            </form>
            
            <?php } ?>
            
            
            
            <div class="PageSelectBoard">
            <?php 
			# variable declaration
			$prev_RecordTmp = "<i class=\"fa fa-angle-left\"></i>";
			$next_RecordTmp = "<i class=\"fa fa-angle-right\"></i>";
			$separator = "&nbsp;";
			$max_links = 15;
			$pages_navigation_RecordTmp = buildNavigation($pageNum_RecordTmp,$totalPages_RecordTmp,$prev_RecordTmp,$next_RecordTmp,$separator,$max_links,true); 
			
			print $pages_navigation_RecordTmp[0]; 
			?>
            <?php print $pages_navigation_RecordTmp[1]; ?> 
			<?php print $pages_navigation_RecordTmp[2]; ?></div>     
            
            </td>
          </tr>
          <tr>
            <td colspan="2"><hr></td>
          </tr>
    </table>
    
    <?php if ($totalRows_RecordTmp > 0) { // Show if recordset not empty ?>
    <form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter" id="TBSort">
  <thead>
    <tr>
      <th width="23">&nbsp;</th>
      <th width="110"><strong>預覽</strong></th>
      <th><strong>名稱 / 描述</strong></th>
      <th width="100"><strong>風格</strong></th>
      <th width="120"><strong>作者</strong></th>
      <th width="70">排序</th>
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
		if($ManageTmpBatchDeleteSelect == "1") { /* 判斷是否開啟批次刪除功能 */
		?>
        <input name="deltmp[]" type="checkbox" id="deltmp[]" value="<?php echo $row_RecordTmp['id']; ?>" />
        <?php } else {?>
        <img src="images/sicon/play.gif" width="18" height="18" />

        <?php
		 } 
		 //
		 ?>
        </td>
        <td valign="middle"><?php if ($row_RecordTmp['pic'] != "") { ?>
        <div class="div_table-cell">
        <img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmp['webname']; ?>/image/tmp/<?php echo $row_RecordTmp['pic']; ?>" alt=""  alumb="true" _w="100" _h="100"/><span></span>
          </div>
        <?php } else { ?>
        <div class="div_table-cell">
        <img src="images/100x100_tmp.jpg" width="100" height="100"  alumb="true" _w="100" _h="100"/><span></span>
        </div>
		<?php } ?>
        </td>
        <td class="hidebuttom">
          <span class="TipTypeStyle">[
          <span <?php if ($row_RecordTmp['userid'] == $w_userid) { ?>class="ed_type"<?php } ?> id="type_<?php echo $row_RecordTmp['id']; ?>">
		  <?php echo highLight($row_RecordTmp['type'], $_GET['type'], $HighlightSelect);?>
          </span>
          ]</span>
          <span <?php if ($row_RecordTmp['userid'] == $w_userid) { ?>class="ed_title"<?php } ?> id="title_<?php echo $row_RecordTmp['id']; ?>"><?php echo highLight($row_RecordTmp['title'], @$_GET['searchkey'], $HighlightSelect); ?></span>
          <span class = "InnerPage">
            <?php if ($row_RecordTmp['userid'] == $w_userid) { // 當目前使用者不為作者則不能修改?><a href="tmp_config_<?php echo $row_RecordTmp['name']; ?>.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>" class="colorbox_iframe" data-original-title="樣板設定">[基本設定]</a><?php } ?>
            </span>
          <div class="descriptionword">
            <span <?php if ($row_RecordTmp['userid'] == $w_userid) { ?>class="ed_sdescription"<?php } ?> id="sdescription_<?php echo $row_RecordTmp['id']; ?>"><?php echo $row_RecordTmp['sdescription']; ?></span>
        </div>
          </td>
        <td><?php echo $row_RecordTmp['name']; ?></td>
        <td class="hidebuttom"><?php echo $row_RecordTmp['webname']; ?></td>
        <td>
          <div <?php if ($row_RecordTmp['userid'] == $w_userid) { ?>class="sortid"<?php } ?> id="sortid_<?php echo  $row_RecordTmp['id'];?>"><?php echo $row_RecordTmp['sortid']; ?></div>
        </td>
        <td width="70" valign="middle">
          <?php 
			/* 判斷訊息是否要顯示 */
			if($row_RecordTmp['indicate'] == "1") { 
				echo "<img src=\"images/indicate_show.gif\" width=\"11\" height=\"11\" /> 公佈\n"; 
			} else { 
				echo "<img src=\"images/indicate_show_not.gif\" width=\"11\" height=\"11\" /> 隱藏\n";
			}
			?>
        </td>
        
        <td width="45" align="left" valign="middle" class="MenuViewPage"><img src="images/nsee.gif" width="45" height="18" /></td>
        <td width="45" align="left" valign="middle"class="MenuViewPage"><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=sourceaddpage&amp;lang=<?php echo $_SESSION['lang']; ?>"><img src="images/add.gif" width="45" height="18" /></a></td>
        <td width="45" align="left" valign="middle" class="MenuViewPage"><?php if ($row_RecordTmp['userid'] == $w_userid) { // 當目前使用者不為作者則不能修改?><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=sourceeditpage&amp;id_edit=<?php echo $row_RecordTmp['id']; ?>&amp;lang=<?php echo $_SESSION['lang']; ?>"><img src="images/edit.gif" width="45" height="18" /></a><?php } else { ?><img src="images/nedit.gif" width="45" height="18" /><?php } ?></td>
        <td width="45" align="left" valign="middle" class="MenuViewPage"><?php if ($row_RecordTmp['userid'] == $w_userid) { // 當目前使用者不為作者則不能修改?><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt=sourceviewpage&amp;id_del=<?php echo $row_RecordTmp['id']; ?>&amp;Operate=delSuccess&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;pic=<?php echo $row_RecordTmp['pic']; ?>&amp;tmpname=<?php echo $row_RecordTmp['id']; ?>&amp;userid=<?php echo $row_RecordTmp['userid']; ?>"><img src="images/del.gif" width="45" height="18" /></a><?php } else { ?><img src="images/ndel.gif" width="45" height="18" /><?php } ?></td>       
      </tr>
      <?php } while ($row_RecordTmp = mysqli_fetch_assoc($RecordTmp)); ?>
      </tbody>
      <?php
	   //
	   if($ManageTmpBatchDeleteSelect == "1") { /* 判斷是否開啟批次刪除功能 */
	   ?>
       <tfoot>
       <tr>
        <td align="right">└</td>
        <td colspan="5"><input name="button3" type="button" id="button3" onClick="flevToggleCheckboxes('form1',false,true);javascript:$(':checkbox').d_checkbox('check');" value="全選" />
          <input name="button5" type="button" id="button5" onClick="flevToggleCheckboxes('form1',true,false);javascript:$(':checkbox').d_checkbox('click');" value="反選" />          <input name="button4" type="button" id="button4" onClick="flevToggleCheckboxes('form1',false,false);javascript:$(':checkbox').d_checkbox('uncheck');" value="重置" /><input name="Operate" type="hidden" id="Operate" value="editSuccess" />
          <span class = "InnerPage" style="float:none;"><a href="#" data-original-title="您可在左方選取您欲刪除的項目，亦可透過左側之按鈕項目來配合使用，選擇完後點選右側《刪除選取項目》按鈕來進行多筆刪除。" data-toggle="tooltip" data-placement="right">?</a></span></td>
        <td align="right">&nbsp;</td>
        <td colspan="4" align="right"><input type="submit" name="button2" id="button2" value="刪除選取項目" onclick="tfm_confirmLink('');return document.MM_returnValue"/></td>
        </tr>
        </tfoot>
        <?php 
		} 
		//
		?>
  </table>
  </form>
  <?php } // Show if recordset not empty ?>
    <?php if ($totalRows_RecordTmp == 0) { // Show if recordset empty ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01_hover">
        <tr></tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><font color="#FF0000">目前尚無資料！！</font></td>
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
	$(".sortid").editable("sqledit/tmp_source_jedit.php", 	{
		//cancel: '取消',
		submit: '修改',
		select:true,
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		width: "25px"
	});
	
	$(".ed_title").editable("sqledit/tmp_source_jedit.php", 	{
		//cancel: '取消',
		submit: '修改',
		select:true,
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		width: "350px"
	});
	
	$(".ed_sdescription").editable("sqledit/tmp_source_jedit.php", 	{
		//cancel: '取消',
		submit: '修改',
		select:true,
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		width: "350px"
	});
	
	$(".ed_type").editable("sqledit/tmp_source_jedit.php", 		{
		loadurl : "sqledit/tmp_get_list.php?lang=<?php echo $_SESSION['lang']; ?>&list_id=<?php echo $row_RecordTmpListType['list_id']?>&<?php echo time();?>",
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
mysqli_free_result($RecordTmp);

mysqli_free_result($RecordTmpListType);
?>
