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
    GLOBAL $maxRows_RecordDfPage,$totalRows_RecordDfPage;
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
					if ($_get_name != "pageNum_RecordDfPage") {
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
			$firstArray = ($pageNum_Recordset1 > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordDfPage=$precedente$_get_vars\">$prev_Recordset1</a>" :  "<span>$prev_Recordset1</span>"/*  css */;
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordDfPage) + 1;
					$max_l = ($a*$maxRows_RecordDfPage >= $totalRows_RecordDfPage) ? $totalRows_RecordDfPage : ($a*$maxRows_RecordDfPage);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageNum_Recordset1)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordDfPage=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "<span>"; /* css */
					$pagesArray .= "$textLink</span>"  . ($theNext < $egp-1 ? $separator : "");
				}
			}
			$theNext = $pageNum_Recordset1+1;
			$offset_end = $totalPages_Recordset1;
			$lastArray = ($pageNum_Recordset1 < $totalPages_Recordset1) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordDfPage=$successivo$_get_vars\">$next_Recordset1</a>" : "<span>$next_Record1</span>"; /* css */
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
  $deleteSQL = sprintf("DELETE FROM demo_dfpage WHERE id=%s",
                       GetSQLValueString($_GET['id_del'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}

/* 刪除多筆資料 */
if ((isset($_POST['deldfpage'])) && ($_POST['deldfpage'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_dfpage WHERE id in (%s)", implode(",", $_POST['deldfpage']));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}

/* 重複區域 */
$maxRows_RecordDfPage = 25;
$pageNum_RecordDfPage = 0;
if (isset($_GET['pageNum_RecordDfPage'])) {
  $pageNum_RecordDfPage = $_GET['pageNum_RecordDfPage'];
}
$startRow_RecordDfPage = $pageNum_RecordDfPage * $maxRows_RecordDfPage;

/* 取得產品資訊 */
$colname_RecordDfPage = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordDfPage = $_GET['searchkey'];
}
$coluserid_RecordDfPage = "-1";
if (isset($w_userid)) {
  $coluserid_RecordDfPage = $w_userid;
}
$coltype1_RecordDfPage = "-1";
if (isset($_GET['type1'])) {
  $coltype1_RecordDfPage = $_GET['type1'];
}
$coltype2_RecordDfPage = "-1";
if (isset($_GET['type2'])) {
  $coltype2_RecordDfPage = $_GET['type2'];
}
$coltype3_RecordDfPage = "-1";
if (isset($_GET['type3'])) {
  $coltype3_RecordDfPage = $_GET['type3'];
}
$colnamelang_RecordDfPage = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordDfPage = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDfPage = sprintf("SELECT * FROM demo_dfpage WHERE ((title LIKE %s)) && lang = %s && type1 = %s && type2 = %s && type3 = %s && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString("%" . $colname_RecordDfPage . "%", "text"),GetSQLValueString($colnamelang_RecordDfPage, "text"),GetSQLValueString($coltype1_RecordDfPage, "text"),GetSQLValueString($coltype2_RecordDfPage, "text"),GetSQLValueString($coltype3_RecordDfPage, "text"),GetSQLValueString($coluserid_RecordDfPage, "int"));
$RecordDfPage = mysqli_query($DB_Conn, $query_RecordDfPage) or die(mysqli_error($DB_Conn));
$row_RecordDfPage = mysqli_fetch_assoc($RecordDfPage);
$totalRows_RecordDfPage = mysqli_num_rows($RecordDfPage);

/* 取得類別資料 */
$colname_RecordDfPageListType = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordDfPageListType = $_GET['lang'];
}
$coluserid_RecordDfPageListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordDfPageListType = $w_userid;
}
$colaid_RecordDfPageListType = "-1";
if (isset($_GET['aid'])) {
  $colaid_RecordDfPageListType = $_GET['aid'];
}
$collevel_RecordDfPageListType = "0";
if (isset($_GET['level'])) {
  $collevel_RecordDfPageListType = $_GET['level'];
}
$colitem_id_RecordDfPageListType = "-1";
if (isset($_GET['item_id'])) {
  $colitem_id_RecordDfPageListType = $_GET['item_id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordDfPageListType = sprintf("SELECT * FROM demo_dfpageitem WHERE aid = %s && lang=%s && level = %s && subitem_id = %s && userid=%s", GetSQLValueString($colaid_RecordDfPageListType, "int"),GetSQLValueString($colname_RecordDfPageListType, "text"),GetSQLValueString($collevel_RecordDfPageListType, "int"),GetSQLValueString($colitem_id_RecordDfPageListType, "int"),GetSQLValueString($coluserid_RecordDfPageListType, "int"));
$RecordDfPageListType = mysqli_query($DB_Conn, $query_RecordDfPageListType) or die(mysqli_error($DB_Conn));
$row_RecordDfPageListType = mysqli_fetch_assoc($RecordDfPageListType);
$totalRows_RecordDfPageListType = mysqli_num_rows($RecordDfPageListType);

/* 取得廠牌資料 */
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
            <td><h5><strong><font color="#756b5b"><span style="color:#CC6600">[<?php echo $row_RecordTpt['title'] ?>]</span> 頁面一覽 [<?php echo $langname; ?>編輯介面]</font></strong></h5></td>
            <td><?php require("fontresize.php"); // 改變字型大小 ?></td>
        </tr>
      </table>
      
         
      
<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
          <tr>
          	<td width="50%"> 顯示 <?php echo ($startRow_RecordDfPage + 1) ?> - <?php echo min($startRow_RecordDfPage + $maxRows_RecordDfPage, $totalRows_RecordDfPage) ?> 筆 共計 <?php echo $totalRows_RecordDfPage ?> 筆</td>
            <td width="50%" align="right">
            
            <?php if ($ManageDfTypeSearchSelect == "1") { ?>
            <form id="form_DfPage" name="form_DfPage" method="get" action="<?php echo $editFormAction; ?>">
              <label for="brand"></label>
              <label>
                <input name="Opt" type="hidden" id="Opt" value="searchpage" />
                <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                <input name="aid" type="hidden" id="aid" value="<?php echo $_GET['aid']; ?>" />
                <input type="hidden" name="tpt" id="tpt" value="<?php echo $row_RecordTpt['title']; ?>" />
                <img src="../images/Search.png" width="20" height="20" align="absmiddle" />
                <input type="text" name="searchkey" id="searchkey" data-original-title="搜尋標題"/>
                <input type="submit" name="button" id="button" value="搜索" />
              </label>
            </form>
            
            <?php } ?>
            
            
            
            <div class="PageSelectBoard">
            <?php 
			# variable declaration
			$prev_RecordDfPage = "<i class=\"fa fa-angle-left\"></i>";
			$next_RecordDfPage = "<i class=\"fa fa-angle-right\"></i>";
			$separator = "&nbsp;";
			$max_links = 15;
			$pages_navigation_RecordDfPage = buildNavigation($pageNum_RecordDfPage,$totalPages_RecordDfPage,$prev_RecordDfPage,$next_RecordDfPage,$separator,$max_links,true); 
			
			print $pages_navigation_RecordDfPage[0]; 
			?>
            <?php print $pages_navigation_RecordDfPage[1]; ?> 
			<?php print $pages_navigation_RecordDfPage[2]; ?></div>     
            
            </td>
          </tr>
          <tr>
            <td colspan="2"><hr></td>
          </tr>
    </table>
    

    <?php if ($totalRows_RecordDfPage > 0 || $row_RecordDfPageListType > 0) { // Show if recordset not empty ?>
    <form id="form1" name="form1" method="post" action="<?php echo $editFormAction; ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter" id="TBSort">
  <thead>
    <tr>
      <th width="23">&nbsp;</th>
      <th><strong>標題/分類</strong></th>
      <th width="100"><strong>排序</strong></th>
      <th width="70"><strong>狀態</strong></th>
      <th colspan="4"><strong>操作</strong></th>
    </tr>
    </thead>
    <tbody>
    <?php if ($row_RecordDfPageListType > 0) { ?>
    <?php do { ?>
    <tr>    
        <td><i class="fa fa-folder" style="color:#4d4d4d"></i></td>
        <td>
		<?php echo $row_RecordDfPageListType['itemname']; ?>
        <span class = "InnerPage" style="float:none">&nbsp;&nbsp;&nbsp;
        <?php if ($_GET['level'] == '') { ?><a href="manage_dfpage.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage_sub&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;item_id=<?php echo $row_RecordDfPageListType['item_id']; ?>&amp;level=1&amp;type1=<?php echo $row_RecordDfPageListType['item_id']; ?>&amp;aid=<?php echo $_GET['aid']; ?>&amp;tpt=<?php echo $row_RecordTpt['title']; ?>" onfocus="undefined" data-original-title="點選查看此項目下的所有文章或分類" data-toggle="tooltip" data-placement="right"><i class="fa fa-files-o"></i> 頁面內容</a><?php } ?>
		<?php if ($_GET['level'] == '1') { ?><a href="manage_dfpage.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage_sub&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;item_id=<?php echo $row_RecordDfPageListType['item_id']; ?>&amp;level=2&amp;type1=<?php echo $_GET['type1']; ?>&amp;type2=<?php echo $row_RecordDfPageListType['item_id']; ?>&amp;aid=<?php echo $_GET['aid']; ?>&amp;tpt=<?php echo $row_RecordTpt['title']; ?>" onfocus="undefined" data-original-title="點選查看此項目下的所有文章或分類" data-toggle="tooltip" data-placement="right"><i class="fa fa-files-o"></i> 頁面內容</a><?php } ?>
		<?php if ($_GET['level'] == '2') { ?><a href="manage_dfpage.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage_sub&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;item_id=<?php echo $row_RecordDfPageListType['item_id']; ?>&amp;level=3&amp;type1=<?php echo $_GET['type1']; ?>&amp;type2=<?php echo $_GET['type2']; ?>&amp;type3=<?php echo $row_RecordDfPageListType['item_id']; ?>&amp;aid=<?php echo $_GET['aid']; ?>&amp;tpt=<?php echo $row_RecordTpt['title']; ?>" onfocus="undefined" data-original-title="點選查看此項目下的所有文章或分類" data-toggle="tooltip" data-placement="right"><i class="fa fa-files-o"></i> 頁面內容</a><?php } ?>
		<?php if ($_GET['level'] == '3') { ?><a href="manage_dfpage.php?wshop=<?php echo $wshop;?>&amp;Opt=viewpage_sub&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;item_id=<?php echo $row_RecordDfPageListType['item_id']; ?>&amp;level=4&amp;type1=<?php echo $_GET['type1']; ?>&amp;type2=<?php echo $_GET['type2']; ?>&amp;type3=<?php echo $_GET['type3']; ?>&amp;aid=<?php echo $_GET['aid']; ?>&amp;tpt=<?php echo $row_RecordTpt['title']; ?>" onfocus="undefined" data-original-title="點選查看此項目下的所有文章或分類" data-toggle="tooltip" data-placement="right"><i class="fa fa-files-o"></i> 頁面內容</a><?php } ?></span>
        <?php if ($_SESSION['MM_UserGroup'] == 'superadmin') {?>
            <font color="#CC6600">&nbsp;&nbsp;&nbsp;&nbsp; *區域識別碼：
            <span class="ed_typemenu" id="typemenu_<?php echo $row_RecordDfPageListType['item_id']; ?>">
		    <?php echo $row_RecordDfPageListType['typemenu']; ?>
            </span></font>
          <?php } ?>
        </td>
        <td><?php echo $row_RecordDfPageListType['sortid']; ?></td>
        <td width="70"><?php 
			/* 判斷訊息是否要顯示 */
			if($row_RecordDfPageListType['indicate'] == "1") { 
				echo "<img src=\"images/indicate_show.gif\" width=\"11\" height=\"11\" /> 公佈\n"; 
			} else { 
				echo "<img src=\"images/indicate_show_not.gif\" width=\"11\" height=\"11\" /> 隱藏\n";
			}
			?></td>
        
        <td width="45" align="left" valign="top" class="MenuViewPage"><img src="images/nsee.gif" width="45" height="18" /></td>
        <td width="45" align="left" valign="top"class="MenuViewPage"><img src="images/nadd.gif" width="45" height="18" /></td>
        <td width="45" align="left" valign="top" class="MenuViewPage"><img src="images/nedit.gif" width="45" height="18" /></td>
        <td width="45" align="left" valign="top" class="MenuViewPage"><img src="images/ndel.gif" width="45" height="18" /></td>       
      </tr>
       <?php } while ($row_RecordDfPageListType = mysqli_fetch_assoc($RecordDfPageListType)); ?>
       <?php } ?>
       <?php if ($totalRows_RecordDfPage > 0 ) { ?>
    <?php do { ?>
      <tr>    
        <td>
        <?php 
		//
		if($ManageDfPageBatchDeleteSelect == "1") { /* 判斷是否開啟批次刪除功能 */
		?>
        <input name="deldfpage[]" type="checkbox" id="deldfpage[]" value="<?php echo $row_RecordDfPage['id']; ?>" />
        <?php } else {?>
        <img src="images/sicon/play.gif" width="18" height="18" />

        <?php
		 } 
		 //
		 ?>
        </td>
        <td>
          <span class="ed_title" id="title_<?php echo $row_RecordDfPage['id']; ?>"><?php echo highLight($row_RecordDfPage['title'], @$_GET['searchkey'], $HighlightSelect); ?></span>
          
          </td>
        <td><div class="sortid" id="sortid_<?php echo  $row_RecordDfPage['id'];?>"><?php echo $row_RecordDfPage['sortid']; ?></div></td>
        <td width="70">
        <span class="ed_indicate" id="indicate_<?php echo $row_RecordDfPage['id']; ?>">
          <?php 
			/* 判斷訊息是否要顯示 */
			if($row_RecordDfPage['indicate'] == "1") { 
				echo "<img src=\"images/indicate_show.gif\" width=\"11\" height=\"11\" /> 公佈\n"; 
			} else { 
				echo "<img src=\"images/indicate_show_not.gif\" width=\"11\" height=\"11\" /> 隱藏\n";
			}
			?>
            </span>
        </td>
        
        <td width="45" align="left" valign="top" class="MenuViewPage"><?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?><img src="images/see.gif" width="45" height="18" /><?php } else { ?><img src="images/nsee.gif" width="45" height="18" /><?php } ?></td>
        <td width="45" align="left" valign="top"class="MenuViewPage"><?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?><a href="manage_dfpage.php?wshop=<?php echo $wshop;?>&amp;Opt=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;aid=<?php echo $_GET['aid']; ?>&amp;tpt=<?php echo $row_RecordTpt['title']; ?>"><img src="images/add.gif" width="45" height="18" /></a><?php } else { ?><img src="images/nadd.gif" width="45" height="18" /><?php } ?></td>
        <td width="45" align="left" valign="top" class="MenuViewPage"><a href="manage_dfpage.php?wshop=<?php echo $wshop;?>&amp;Opt=editpage&amp;id_edit=<?php echo $row_RecordDfPage['id']; ?>&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;aid=<?php echo $_GET['aid']; ?>&amp;tpt=<?php echo $row_RecordTpt['title']; ?>"><img src="images/edit.gif" width="45" height="18" /></a></td>
        <td width="45" align="left" valign="top" class="MenuViewPage"><?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?><a href="manage_dfpage.php?<?php echo $_SERVER[QUERY_STRING]; ?>&amp;id_del=<?php echo $row_RecordDfPage['id']; ?>&amp;Operate=delSuccess"><img src="images/del.gif" width="45" height="18" /></a><?php } else { ?><img src="images/ndel.gif" width="45" height="18" /><?php } ?></td>       
      </tr>
      <?php } while ($row_RecordDfPage = mysqli_fetch_assoc($RecordDfPage)); ?>
      </tbody>
      <?php
	   //
	   if($ManageDfPageBatchDeleteSelect == "1") { /* 判斷是否開啟批次刪除功能 */
	   ?>
       <tfoot>
       <tr>
        <td align="right">└</td>
        <td><input name="button3" type="button" id="button3" onClick="flevToggleCheckboxes('form1',false,true);javascript:$(':checkbox').d_checkbox('check');" value="全選" />
          <input name="button5" type="button" id="button5" onClick="flevToggleCheckboxes('form1',true,false);javascript:$(':checkbox').d_checkbox('click');" value="反選" />          <input name="button4" type="button" id="button4" onClick="flevToggleCheckboxes('form1',false,false);javascript:$(':checkbox').d_checkbox('uncheck');" value="重置" /><input name="Operate" type="hidden" id="Operate" value="editSuccess" />
          <span class = "InnerPage" style="float:none;"><a href="#" data-original-title="您可在左方選取您欲刪除的項目，亦可透過左側之按鈕項目來配合使用，選擇完後點選右側《刪除選取項目》按鈕來進行多筆刪除。" data-toggle="tooltip" data-placement="right">?</a></span></td>
        <td>&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td colspan="4" align="right"><input type="submit" name="button2" id="button2" value="刪除選取項目" onclick="tfm_confirmLink('此動作會刪除所有選取資料！！確定刪除紀錄嗎？');return document.MM_returnValue"/></td>
        </tr>
        </tfoot>
        <?php 
		} 
		//
		?>
        <?php } ?>
  </table>
  </form>
  <?php } // Show if recordset not empty ?>
    <?php if ($totalRows_RecordDfPageListType == 0&& $totalRows_RecordDfPage == 0) { // Show if recordset empty ?>
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
        <td width="49" align="left" valign="middle" class="MenuViewPage"><a href="manage_dfpage.php?wshop=<?php echo $wshop;?>&amp;Opt=addpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;aid=<?php echo $_GET['aid']; ?>&amp;tpt=<?php echo $row_RecordTpt['title']; ?>"><img src="images/add.gif" alt="" width="45" height="18" /></a></td>
        <td width="45" align="left" valign="middle" class="MenuViewPage"><img src="images/nedit.gif" alt="" width="45" height="18" /></td>
        <td width="49" align="left" valign="middle" class="MenuViewPage"><img src="images/ndel.gif" /></td>
      </tr>
    </tbody>
  </table>
      <?php } // Show if recordset empty ?>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$(".sortid").editable("sqledit/dfpage_jedit.php", 	{
		//cancel: '取消',
		submit: '修改',
		select:true,
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		width: "25px"
	});
	
	$(".ed_title").editable("sqledit/dfpage_jedit.php", 		{
		//cancel: '取消',
		submit: '修改',
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		select:true,
		width: "500px"
	});
	
	$(".ed_indicate").editable("sqledit/dfpage_jedit_indicate.php", 	{
		type:   'checkbox',
		select:true,
  		//cancel: 'Cancel',
    	submit: '確認',
   		checkbox: { trueValue: '公佈', falseValue: '隱藏' }
	});
	
	$(".ed_typemenu").editable("sqledit/dfpageitem_jedit.php", 		{
		loadurl : "sqledit/config_get_list.php?lang=<?php echo $_SESSION['lang']; ?>&list_id=1&<?php echo time();?>",
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
mysqli_free_result($RecordDfPage);

mysqli_free_result($RecordDfPageListType);
?>
