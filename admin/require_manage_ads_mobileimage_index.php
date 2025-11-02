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

/* 刪除活動花絮主題資料 */
if ((isset($_GET['act_del_id'])) && ($_GET['act_del_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_adtype WHERE act_id=%s",
                       GetSQLValueString($_GET['act_del_id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
/* 刪除活動花絮相片資料 */
if ((isset($_GET['act_del_id'])) && ($_GET['act_del_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_adtype_sub WHERE act_id=%s",
                       GetSQLValueString($_GET['act_del_id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  
}
/* 刪除多筆活動花絮主題資料 */
if ((isset($_POST['deladsalbum'])) && ($_POST['deladsalbum'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_adtype WHERE act_id in (%s)", implode(",", $_POST['deladsalbum']));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
/* 刪除多筆活動花絮相片資料 */
if ((isset($_POST['deladsalbum'])) && ($_POST['deladsalbum'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_adtype_sub WHERE act_id in (%s)", implode(",", $_POST['deladsalbum']));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}


/* 讀取資料 */
if (isset($_GET['pageNum_RecordAds'])) {
  $pageNum_RecordAds = $_GET['pageNum_RecordAds'];
}
$startRow_RecordAds = $pageNum_RecordAds * $maxRows_RecordAds;

$maxRows_RecordAds = 15;
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
$colname_RecordAds = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordAds = $_GET['searchkey'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAds = sprintf("SELECT demo_adtype.act_id, demo_adtype.userid, demo_adtype.title, demo_adtype.type, demo_adtype.bwight, demo_adtype.bhight, demo_adtype.swight, demo_adtype.shight, demo_adtype.velocity, demo_adtype.numbers, demo_adtype.navigation, demo_adtype.thumbs, demo_adtype.label, demo_adtype.interval, demo_adtype.hideTools, demo_adtype.dots, demo_adtype.sdescription, demo_adtype.indicate, demo_adtype.author, demo_adtype.postdate, demo_adtype_sub.pic, demo_adtype.sortid, demo_adtype_sub.actphoto_id, demo_adtype.lang, count(demo_adtype_sub.act_id) AS photonum FROM demo_adtype LEFT OUTER JOIN demo_adtype_sub ON demo_adtype.act_id = demo_adtype_sub.act_id GROUP BY demo_adtype.act_id HAVING (demo_adtype.lang = %s) && ((demo_adtype.title LIKE %s) || (demo_adtype.postdate LIKE %s) || (demo_adtype.author LIKE %s)) && demo_adtype.userid=%s && demo_adtype.type='mobilebannerimage' ORDER BY demo_adtype.act_id DESC", GetSQLValueString($collang_RecordAds, "text"),GetSQLValueString("%" . $colname_RecordAds . "%", "text"),GetSQLValueString("%" . $colname_RecordAds . "%", "text"),GetSQLValueString("%" . $colname_RecordAds . "%", "text"),GetSQLValueString($coluserid_RecordAds, "int"));
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

/* 取得類別資料 */
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
<div>
  <div>
    
    <?php 
	  switch($_POST['Operate']) 
	  {
		  case "addSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('輪播分類新增成功！！','success');});</script>\n";
			break;
		  case "editSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('輪播分類修改成功！！','information');});</script>\n";
			break;
		  case "photoaddSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('輪播圖片新增成功！！','success');});</script>\n";
			break;
		  case "delSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('輪播分類刪除成功！！','warning');});</script>\n";
			break;	
		  default:
		  	switch($_GET['Operate']) 
	  		{
			  case "addSuccess":
				echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('輪播分類新增成功！！','success');});</script>\n";
				break;
			  case "editSuccess":
				echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('輪播分類修改成功！！','information');});</script>\n";
				break;
			  case "photoaddSuccess":
				echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('輪播圖片新增成功！！','success');});</script>\n";
				break;
			  case "delSuccess":
				echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('輪播分類刪除成功！！','warning');});</script>\n";
				break;	
			  default:
				break;
	 		 }
		  	break;
	  }
	  
	  ?>
     
    
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
      <tr>
        <td><h5><strong><font color="#756b5b">輪播分類 - 首頁橫幅 [<?php echo $langname; ?>編輯介面]</font></strong></h5></td>
        <td><?php require("fontresize.php"); // 改變字型大小 ?></td>
      </tr>
      </table>
    
    
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
      <tr>
        <td width="50%"> 顯示 <?php echo ($startRow_RecordAds + 1) ?> - <?php echo min($startRow_RecordAds + $maxRows_RecordAds, $totalRows_RecordAds) ?> 筆 共計 <?php echo $totalRows_RecordAds ?> 筆</td>
        <td width="50%" align="right">
          
          <?php if ($ManageAdsSearchSelect == "1") { // 搜索功能開啟設定?>
          <form id="form_Ads" name="form_Ads" method="get" action="<?php echo $editFormAction; ?>">
            <label for="type"></label>
            <label>
              <input name="Opt" type="hidden" id="Opt" value="viewpage" />
              <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
              <img src="../images/Search.png" width="20" height="20" align="absmiddle" />
              <input type="text" name="searchkey" id="searchkey" data-original-title="搜尋標題" />
              <input type="submit" name="button" id="button" value="搜索" />
            </label>
          </form>
          <?php } ?>
          
           
          <div class="PageSelectBoard">
          <?php 
			# variable declaration
			$prev_RecordAds = "<i class=\"fa fa-angle-left\"></i>";
			$next_RecordAds = "<i class=\"fa fa-angle-right\"></i>";
			$separator = "&nbsp;";
			$max_links = 15;
			$pages_navigation_RecordAds = buildNavigation($pageNum_RecordAds,$totalPages_RecordAds,$prev_RecordAds,$next_RecordAds,$separator,$max_links,true); 
			
			print $pages_navigation_RecordAds[0]; 
			?>
          <?php print $pages_navigation_RecordAds[1]; ?> 
          <?php print $pages_navigation_RecordAds[2]; ?>
          </div>
          
        </td>
        </tr>
      <tr>
        <td colspan="2"><hr></td>
        </tr>
    </table>
    
    <?php if ($totalRows_RecordAds > 0) { // Show if recordset not empty ?>
    <form id="form1" name="form1" method="post" action="">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter" id="TBSort">
    <thead>
        <tr>
          <th width="23">&nbsp;</th>
          <th><strong>標題 / 描述</strong></th>
          <th width="80">大圖寬度</th>
          <th width="80">大圖高度</th>
          <th width="80">縮圖寬度</th>
          <th width="80">縮圖高度</th>
          <th width="60"><strong>張數</strong></th>
          <th colspan="4"><strong>輪播分類管理操作</strong></th>
          </tr>
        </thead>
        <tbody>  
        <?php do { ?>
          <tr>
            <td align="center" valign="middle">
            <?php 
		//
		if($ManageAdsAlbumBatchDeleteSelect == "1") { /* 判斷是否開啟多筆刪除功能 */
		?>
        <input name="deladsalbum[]" type="checkbox" id="deladsalbum[]" value="<?php echo $row_RecordAds['act_id']; ?>" />
        <?php } else {?>
        <img src="images/sicon/play.gif" width="18" height="18" />

        <?php
		 } 
		 //
		 ?>
         </td>
            <td valign="middle">
              <span class="title" id="title_<?php echo $row_RecordAds['act_id']; ?>"><?php echo highLight($row_RecordAds['title'], @$_GET['searchkey'], $HighlightSelect); ?></span>	&nbsp;&nbsp;&nbsp;&nbsp;
              <?php 
			
			/* 判斷顯示新增回應或者回應一覽 */
			if($row_RecordAds['actphoto_id'] == "") {
			?>
              <span class = "InnerPage">
                <a href="manage_ads.php?wshop=<?php echo $wshop;?>&amp;Opt=photoaddpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;act_id=<?php echo $row_RecordAds['act_id']; ?>"><i class="fa fa-plus"></i> 新增輪播圖片</a>
                </span><?php } else {?>
              <span class = "InnerPage">
                <a href="manage_ads.php?wshop=<?php echo $wshop;?>&amp;Opt=photoviewpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;act_id=<?php echo $row_RecordAds['act_id']; ?>"><i class="fa fa-picture-o"></i> 輪播圖片一覽</a>
                </span>
              
			<?php } ?>
            <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
            <font color="#CC6600">&nbsp;&nbsp;&nbsp;&nbsp; *區域：
            <span class="ed_type" id="type_<?php echo $row_RecordAds['act_id']; ?>">
			<?php echo $row_RecordAds['type']; ?>
            </span></font>
            <?php } ?>
              <br />
              
              <div class="descriptionword">
              <span class="sdescription" id="sdescription_<?php echo $row_RecordAds['act_id']; ?>"><?php echo nl2br($row_RecordAds['sdescription']); ?></span> 
              </div>   
                      </td>
            <td valign="middle"><span class="bwight" id="bwight_<?php echo $row_RecordAds['act_id']; ?>"><?php echo $row_RecordAds['bwight']; ?></span></td>
            <td valign="middle"><span class="bhight" id="bhight_<?php echo $row_RecordAds['act_id']; ?>"><?php echo $row_RecordAds['bhight']; ?></span></td>
            <td valign="middle"><span class="swight" id="swight_<?php echo $row_RecordAds['act_id']; ?>"><?php echo $row_RecordAds['swight']; ?></span></td>
            <td valign="middle"><span class="shight" id="shight_<?php echo $row_RecordAds['act_id']; ?>"><?php echo $row_RecordAds['shight']; ?></span></td>
            <td align="center" valign="middle">
              <?php 
		    /* 顯示相片總數 */
		  	if($row_RecordAds['photonum'] != "") {
		  		echo "<span class=\"TipTypeStyle\">[";
		  		echo $row_RecordAds['photonum'];
				echo "]</span>"; 
			}
		 	?>
            </td>
            <td width="45" align="left" valign="middle"class="MenuViewPage"><img src="images/nsee.gif" width="45" height="18" /></td>
            <td width="45" align="left" valign="middle" class="MenuViewPage"><img src="images/nadd.gif" alt="" width="45" height="18" /></td>
            <td width="45" align="left" valign="middle" class="MenuViewPage"><img src="images/nedit.gif" alt="" width="45" height="18" /></td>
            <td width="49" align="left" valign="middle" class="MenuViewPage"><img src="images/ndel.gif" width="45" height="18" /></td>
          </tr>
           <tr>
             <td align="right" valign="middle">&nbsp;</td>
             <td colspan="16" valign="middle"><strong><i class="fa fa-cog"></i> 細部設定(點選修改)</strong></td>
             </tr>
           <tr>
             <td align="right" valign="middle">&nbsp;</td>
             <td colspan="16" valign="middle">
               <i class="fa fa-arrow-right"></i> 動畫速度：<span class="ed_velocity" id="velocity_<?php echo $row_RecordAds['act_id']; ?>"><?php echo $row_RecordAds['velocity']; ?></span><font color="#999999"> 設定轉場速度</font><br />
			   <i class="fa fa-arrow-right"></i> 顯示編號：<span class="ed_numbers" id="numbers_<?php echo $row_RecordAds['act_id']; ?>"><?php echo $row_RecordAds['numbers']; ?></span><font color="#999999"> 左上角是否顯示編號導覽列</font><br />
               <i class="fa fa-arrow-right"></i> 左右方向按鈕：<span class="ed_navigation" id="navigation_<?php echo $row_RecordAds['act_id']; ?>"><?php echo $row_RecordAds['navigation']; ?></span><font color="#999999">是否顯示左右方向導覽列</font><br />
               <i class="fa fa-arrow-right"></i> 縮圖導覽：<span class="ed_thumbs" id="thumbs_<?php echo $row_RecordAds['act_id']; ?>"><?php echo $row_RecordAds['thumbs']; ?></span><font color="#999999"> 下方是否顯示縮圖導覽列〈須將隱藏工具列選項打開〉</font><br />
               <i class="fa fa-arrow-right"></i> 標籤顯示：<span class="ed_label" id="label_<?php echo $row_RecordAds['act_id']; ?>"><?php echo $row_RecordAds['label']; ?><font color="#999999"> 下方是否顯示該圖片敘述</font></span><font color="#999999">〈縮圖導覽和標籤顯示只能同時存在一種〉</font><br />
               <i class="fa fa-arrow-right"></i> 隱藏工具列：<span class="ed_hideTools" id="hideTools_<?php echo $row_RecordAds['act_id']; ?>"><?php echo $row_RecordAds['hideTools']; ?></span><font color="#999999"> 滑鼠移出時是否會隱藏工具列</font></td>
             </tr>
           <tr>
             <td align="right" valign="middle">&nbsp;</td>
             <td colspan="16" valign="middle">&nbsp;</td>
             </tr>
          <?php } while ($row_RecordAds = mysqli_fetch_assoc($RecordAds)); ?>
          </tbody>
          <?php
		   //
		   if($ManageAdsAlbumBatchDeleteSelect == "1") { /* 判斷是否開啟批次刪除功能 */
		   ?>
           <tfoot>
           <tr>
            <td align="right" valign="middle">└</td>
            <td colspan="6" valign="middle">
              <input name="button3" type="button" id="button3" onClick="flevToggleCheckboxes('form1',false,true);javascript:$(':checkbox').d_checkbox('check');" value="全選" />
              <input name="button5" type="button" id="button5" onClick="flevToggleCheckboxes('form1',true,false);javascript:$(':checkbox').d_checkbox('click');" value="反選" />          <input name="button4" type="button" id="button4" onClick="flevToggleCheckboxes('form1',false,false);javascript:$(':checkbox').d_checkbox('uncheck');" value="重置" />
              <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
          <span class = "InnerPage" style="float:none;"><a href="#" data-original-title="您可在左方選取您欲刪除的項目，亦可透過左側之按鈕項目來配合使用，選擇完後點選右側《刪除選取項目》按鈕來進行多筆刪除。" data-toggle="tooltip" data-placement="right">?</a></span></td>
            <td colspan="10" align="right"><input type="submit" name="button2" id="button2" value="刪除選取項目" onclick="tfm_confirmLink('此動作會刪除所有選取活動花絮及其內容！！確定刪除紀錄嗎？');return document.MM_returnValue" />
            </td>
          </tr>
          <?php 
		} 
		//
		?>
        </tfoot>
      </table>
    </form>
      <?php } // Show if recordset not empty ?>
    <?php if ($totalRows_RecordAds == 0) { // Show if recordset empty ?>
      <form action="<?php echo $editFormAction; ?>" method="post" name="Banner_Gen" id="Banner_Gen">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01_hover">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="center">
          <font color="#FF0000"><br><strong style="font-size:24px;">目前尚未建立橫幅資料庫！！請點選按鈕建立！！</strong></font><br />
<br />

          </td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><input type="submit" name="button" id="button" value="建立橫幅">
            <input name="MM_Gen" type="hidden" id="MM_Gen" value="form_Banner_Gen" />
          <input name="Opt" type="hidden" id="Opt" value="viewpage" /></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
      </table>
  </form>
      <?php } // Show if recordset empty ?>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$(".sortid").editable("sqledit/adtype_jedit.php", 	{
		//cancel: '取消',
		submit: '修改',
		select:true,
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		width: "25px"
	});
	
	$(".title").editable("sqledit/adtype_jedit.php", 		{
		//cancel: '取消',
		submit: '修改',
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		select:true,
		width: "500px"
	});
	
	$(".sdescription").editable("sqledit/adtype_jedit.php", 		{
		//cancel: '取消',
		submit: '修改',
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		select:true,
		width: "500px"
	});
	
	$(".bwight").editable("sqledit/adtype_jedit.php", 		{
		//cancel: '取消',
		submit: '修改',
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		select:true,
		width: "50px"
	});
	
	$(".bhight").editable("sqledit/adtype_jedit.php", 		{
		//cancel: '取消',
		submit: '修改',
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		select:true,
		width: "50px"
	});
	
	$(".swight").editable("sqledit/adtype_jedit.php", 		{
		//cancel: '取消',
		submit: '修改',
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		select:true,
		width: "50px"
	});
	
	$(".shight").editable("sqledit/adtype_jedit.php", 		{
		//cancel: '取消',
		submit: '修改',
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		select:true,
		width: "50px"
	});
	
	$(".ed_numbers").editable("sqledit/adtype_jedit.php", 	{
		//cancel: '取消',
		loadurl : "sqledit/member_get_list_TandF.php?lang=<?php echo $_SESSION['lang']; ?>&<?php echo time();?>",
		type: "select",
		submit: '修改',		
		select:true,
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		style: "display: inline;"
		//event:"dblclick",
	});
	
	$(".ed_navigation").editable("sqledit/adtype_jedit.php", 	{
		//cancel: '取消',
		loadurl : "sqledit/member_get_list_TandF.php?lang=<?php echo $_SESSION['lang']; ?>&<?php echo time();?>",
		type: "select",
		submit: '修改',		
		select:true,
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		style: "display: inline;"
		//event:"dblclick",
	});
	
	$(".ed_thumbs").editable("sqledit/adtype_jedit.php", 	{
		//cancel: '取消',
		loadurl : "sqledit/member_get_list_TandF.php?lang=<?php echo $_SESSION['lang']; ?>&<?php echo time();?>",
		type: "select",
		submit: '修改',		
		select:true,
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		style: "display: inline;"
		//event:"dblclick",
	});
	
	$(".ed_label").editable("sqledit/adtype_jedit.php", 	{
		//cancel: '取消',
		loadurl : "sqledit/member_get_list_TandF.php?lang=<?php echo $_SESSION['lang']; ?>&<?php echo time();?>",
		type: "select",
		submit: '修改',		
		select:true,
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		style: "display: inline;"
		//event:"dblclick",
	});
	
	$(".ed_hideTools").editable("sqledit/adtype_jedit.php", 	{
		//cancel: '取消',
		loadurl : "sqledit/member_get_list_TandF.php?lang=<?php echo $_SESSION['lang']; ?>&<?php echo time();?>",
		type: "select",
		submit: '修改',		
		select:true,
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		style: "display: inline;"
		//event:"dblclick",
	});
	
	$(".ed_velocity").editable("sqledit/adtype_jedit.php", 	{
		//cancel: '取消',
		loadurl : "sqledit/member_get_list_adstype_velocity?lang=<?php echo $_SESSION['lang']; ?>&<?php echo time();?>",
		type: "select",
		submit: '修改',		
		select:true,
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		style: "display: inline;"
		//event:"dblclick",
	});
	
	$(".ed_type").editable("sqledit/adtype_jedit.php", 	{
		//cancel: '取消',
		loadurl : "sqledit/adtype_list_type.php?lang=<?php echo $_SESSION['lang']; ?>&<?php echo time();?>",
		type: "select",
		submit: '修改',		
		select:true,
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		style: "display: inline;"
		//event:"dblclick",
	});
	
});
</script>
<?php
mysqli_free_result($RecordAds);
?>
