<?php require_once('../Connections/DB_Conn.php'); ?>
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
    GLOBAL $maxRows_RecordNewsPost,$totalRows_RecordNewsPost;
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
					if ($_get_name != "pagePost") {
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
			$firstArray = ($pageNum_Recordset1 > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pagePost=$precedente$_get_vars\">$prev_Recordset1</a>" :  "<span>$prev_Recordset1</span>"/*  css */;
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordNewsPost) + 1;
					$max_l = ($a*$maxRows_RecordNewsPost >= $totalRows_RecordNewsPost) ? $totalRows_RecordNewsPost : ($a*$maxRows_RecordNewsPost);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageNum_Recordset1)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pagePost=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "<span>"; /* css */
					$pagesArray .= "$textLink</span>"  . ($theNext < $egp-1 ? $separator : "");
				}
			}
			$theNext = $pageNum_Recordset1+1;
			$offset_end = $totalPages_Recordset1;
			$lastArray = ($pageNum_Recordset1 < $totalPages_Recordset1) ? "<a href=\"$_SERVER[PHP_SELF]?pagePost=$successivo$_get_vars\">$next_Recordset1</a>" : "<span>$next_Record1</span>"; /* css */
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

/* 刪除提問者資料 */
if ((isset($_GET['message_del_id'])) && ($_GET['message_del_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_newspost WHERE id=%s",
                       GetSQLValueString($_GET['message_del_id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
/* 刪除回應資料 */
if ((isset($_GET['message_del_id'])) && ($_GET['message_del_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_newsreply WHERE pid=%s",
                       GetSQLValueString($_GET['message_del_id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
/* 刪除多筆提問者資料 */
if ((isset($_POST['delnewspost'])) && ($_POST['delnewspost'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_newspost WHERE id in (%s)", implode(",", $_POST['delnewspost']));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}
/* 刪除多筆回應資料 */
if ((isset($_POST['delnewspost'])) && ($_POST['delnewspost'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_newsreply WHERE pid in (%s)", implode(",", $_POST['delnewspost']));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}


/* 讀取資料 */
if (isset($_GET['pagePost'])) {
  $pagePost = $_GET['pagePost'];
}
$startRow_RecordNewsPost = $pagePost * $maxRows_RecordNewsPost;

$maxRows_RecordNewsPost = 50;
$pagePost = 0;
if (isset($_GET['pagePost'])) {
  $pagePost = $_GET['pagePost'];
}
$startRow_RecordNewsPost = $pagePost * $maxRows_RecordNewsPost;

$colname_RecordNewsPost = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordNewsPost = $_GET['searchkey'];
}
$coluserid_RecordNewsPost = "-1";
if (isset($w_userid)) {
  $coluserid_RecordNewsPost = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNewsPost = sprintf("SELECT demo_newspost.id, demo_newspost.pid, demo_newspost.userid, demo_newspost.content, demo_newspost.author, demo_newspost.postdate , demo_newsreply.rid FROM demo_newspost LEFT OUTER JOIN demo_newsreply ON demo_newspost.id = demo_newsreply.pid GROUP BY demo_newspost.id HAVING ((demo_newspost.postdate LIKE %s) || (demo_newspost.author LIKE %s)) && demo_newspost.userid=%s ORDER BY demo_newspost.id DESC", GetSQLValueString("%" . $colname_RecordNewsPost . "%", "text"),GetSQLValueString("%" . $colname_RecordNewsPost . "%", "text"),GetSQLValueString($coluserid_RecordNewsPost, "int"));
$query_limit_RecordNewsPost = sprintf("%s LIMIT %d, %d", $query_RecordNewsPost, $startRow_RecordNewsPost, $maxRows_RecordNewsPost);
$RecordNewsPost = mysqli_query($DB_Conn, $query_limit_RecordNewsPost) or die(mysqli_error($DB_Conn));
$row_RecordNewsPost = mysqli_fetch_assoc($RecordNewsPost);

if (isset($_GET['totalRows_RecordNewsPost'])) {
  $totalRows_RecordNewsPost = $_GET['totalRows_RecordNewsPost'];
} else {
  $all_RecordNewsPost = mysqli_query($DB_Conn, $query_RecordNewsPost);
  $totalRows_RecordNewsPost = mysqli_num_rows($all_RecordNewsPost);
}
$totalPages_RecordNewsPost = ceil($totalRows_RecordNewsPost/$maxRows_RecordNewsPost)-1;

// Trim by length (by FELIXONE.it)
function TrimByLength($str, $len, $word) {
  $end = "";
  if (strlen($str) > $len) $end = "...";
  $str = mb_substr($str, 0, $len, "UTF-8");
  if ($word) $str = substr($str,0,strrpos($str," ")+1);
  return $str.$end;
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

<div>
  <div>
    
    <?php 
	  switch($_POST['Operate']) 
	  {
		  case "addSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('新增提問成功！！','success');});</script>\n";
			break;
		  case "editSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('修改提問成功！！','information');});</script>\n";
			break;
		  case "replySuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('訊息回應成功！！','success');});</script>\n";
			break;
		  case "delSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('刪除提問成功！！','warning');});</script>\n";
			break;	
		  default:
		  	switch($_GET['Operate']) 
	  		{
			  case "addSuccess":
				echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('新增提問成功！！','success');});</script>\n";
				break;
			  case "editSuccess":
				echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('修改提問成功！！','information');});</script>\n";
				break;
			  case "replySuccess":
				echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('訊息回應成功！！','success');});</script>\n";
				break;
			  case "delSuccess":
				echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('刪除提問成功！！','warning');});</script>\n";
				break;	
			  default:
				break;
	 		 }
		  	break;
	  }
	  
	  ?>
     
    
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
      <tr>
        <td><h5><strong><font color="#756b5b">問答紀錄一覽 [<?php echo $langname; ?>編輯介面]</font></strong></h5></td>
        <td><?php require("fontresize.php"); // 改變字型大小 ?></td>
      </tr>
      </table>
    
    
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
      <tr>
        <td width="50%"> 顯示 <?php echo ($startRow_RecordNewsPost + 1) ?> - <?php echo min($startRow_RecordNewsPost + $maxRows_RecordNewsPost, $totalRows_RecordNewsPost) ?> 筆 共計 <?php echo $totalRows_RecordNewsPost ?> 筆</td>
        <td width="50%" align="right">
          
          
          <form id="form_NewsPost" name="form_NewsPost" method="get" action="<?php echo $editFormAction; ?>">
            <label>
              <input name="Opt" type="hidden" id="Opt" value="searchpage" />
              <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
              <img src="../images/Search.png" width="20" height="20" align="absmiddle" />
              <input type="text" name="searchkey" id="searchkey" />
              <input type="submit" name="button" id="button" value="搜索" />
            </label>
          </form>
          
           
          <div class="PageSelectBoard">
          <?php 
			# variable declaration
			$prev_RecordNewsPost = "<i class=\"fa fa-angle-left\"></i>";
			$next_RecordNewsPost = "<i class=\"fa fa-angle-right\"></i>";
			$separator = "&nbsp;";
			$max_links = 15;
			$pages_navigation_RecordNewsPost = buildNavigation($pagePost,$totalPages_RecordNewsPost,$prev_RecordNewsPost,$next_RecordNewsPost,$separator,$max_links,true); 
			
			print $pages_navigation_RecordNewsPost[0]; 
			?>
          <?php print $pages_navigation_RecordNewsPost[1]; ?> 
          <?php print $pages_navigation_RecordNewsPost[2]; ?>
          </div>
          
        </td>
        </tr>
      <tr>
        <td colspan="2"><hr></td>
        </tr>
    </table>
    
    <?php if ($totalRows_RecordNewsPost > 0) { // Show if recordset not empty ?>
    <form id="form1" name="form1" method="post" action="">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter" id="TBSort">
        <thead>
        <tr>
          <th width="23">&nbsp;</th>
          <th width="120"><strong>提問者</strong></th>
          <th><strong> <font color="#2865A2"><?php echo urldecode($_GET['pdname']); ?></font> 提問內容</strong></th>
          <th width="100"><strong>回應操作</strong></th>
          <th width="160"><strong>提問時間</strong></th>
          <th width="100"><strong>狀態</strong></th>
          <th colspan="4" align="left"><strong>提問操作</strong></th>
          </tr>
        </thead>
        <tbody>
        <?php do { ?>
          <tr>
            <td align="center" valign="middle">
            <?php 
		//
		if($ManageNewsPostBatchDeleteSelect == "1") { /* 判斷是否開啟多筆刪除功能 */
		?>
        <input name="delnewspost[]" type="checkbox" id="delnewspost[]" value="<?php echo $row_RecordNewsPost['id']; ?>" />
        <?php } else {?>
        <img src="images/sicon/play.gif" width="18" height="18" />

        <?php
		 } 
		 //
		 ?>
         </td>
            <td valign="middle"><font color="#2865A2"><strong><span class="ed_author" id="author_<?php echo  $row_RecordNewsPost['id'];?>"><?php echo highLight($row_RecordNewsPost['author'], @$_GET['searchkey'], $HighlightSelect); ?></span></strong></font> 
              </td>
            <td valign="middle">
            <?php require("require_manage_news_get.php"); ?>
            <span class="ed_content" id="content_<?php echo  $row_RecordNewsPost['id'];?>"><?php echo $row_RecordNewsPost['content']; ?></span>             <span class = "InnerPage">
            <a href="../news.php?wshop=<?php echo $wshop;?>&amp;Opt=detailed&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id=<?php echo $row_RecordNewsPost['pid']; ?>" class="colorbox_iframe"  data-bs-original-title="您可在此查看目前留言所在之前台位置。" data-bs-toggle="tooltip" data-bs-placement="top"><i class="fa fa-eye"></i> 資料頁面</a>
            </span>
              </td>
            <td align="center" valign="middle"><?php 
			/* 判斷顯示新增回應或者回應一覽 */
			if($row_RecordNewsPost['rid'] == "") {
			?>
            <span class = "InnerPage">
            <a href="manage_news.php?wshop=<?php echo $wshop;?>&amp;Opt=replyaddpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;post_id=<?php echo $row_RecordNewsPost['id']; ?>&amp;pd_id=<?php echo $row_RecordNewsPost['pid']; ?>&amp;pdname=<?php echo $_GET['pdname']; ?>"><i class="fa fa-comments-o"></i> 新增回應</a>
            </span><?php } else {?>
            <span class = "InnerPage">
            <a href="manage_news.php?wshop=<?php echo $wshop;?>&amp;Opt=replypage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;post_id=<?php echo $row_RecordNewsPost['id']; ?>&amp;pd_id=<?php echo $row_RecordNewsPost['pid']; ?>&amp;pdname=<?php echo $_GET['pdname']; ?>"><i class="fa fa-comment-o"></i> 回應一覽</a>
            </span><?php } ?></td>
            <td valign="middle"><font color="#666666"><?php echo highLight(date('Y-m-d g:i A',strtotime($row_RecordNewsPost['postdate'])), @$_GET['searchkey'], $HighlightSelect); ?></font></td>
            <td align="left" valign="middle" class="MenuViewPage">
              <?php 
			/* 判斷是否回覆提問 */
			
			if($row_RecordNewsPost['rid'] != "") { 
				echo "<img src=\"images/indicate_show.gif\" width=\"11\" height=\"11\" /> 已回覆\n"; 
			} else { 
				echo "<img src=\"images/indicate_show_not.gif\" width=\"11\" height=\"11\" /> 未回覆\n";
			}
			
			?>
              
              <?php /* 判斷是否為私密提問 */
			/*echo '<br />';
			if($row_RecordNewsPost['whisper'] == "1") { 
				echo "<img src=\"images/indicate_show_not.gif\" width=\"11\" height=\"11\" /> 私密提問\n"; 
			} else { 
				echo "<img src=\"images/indicate_show.gif\" width=\"11\" height=\"11\" /> 公開詢問\n";
			}*/
			
			?></td>
            <td width="45" align="left" valign="middle"class="MenuViewPage"><img src="images/nsee.gif" width="45" height="18" /></td>
            <td width="49" align="left" valign="middle" class="MenuViewPage"><img src="images/nadd.gif" alt="" width="45" height="18" /></td>
            <td width="49" align="left" valign="middle" class="MenuViewPage"><a href="manage_news.php?wshop=<?php echo $wshop;?>&amp;Opt=posteditpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;post_id=<?php echo $row_RecordNewsPost['id']; ?>&amp;pd_id=<?php echo $_GET['id']; ?>&amp;pdname=<?php echo $_GET['pdname']; ?>"><img src="images/edit.gif" alt="" width="45" height="18" /></a></td>
            <td width="49" align="left" valign="middle" class="MenuViewPage"><a href="manage_news.php?wshop=<?php echo $wshop;?>&amp;Opt=postpage&amp;message_del_id=<?php echo $row_RecordNewsPost['id']; ?>&amp;Operate=delSuccess&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id=<?php echo $_GET['id']; ?>&amp;pdname=<?php echo $_GET['pdname']; ?>" onclick="tfm_confirmLink('此動作會刪除提問以及回應訊息！！確定刪除紀錄嗎？');return document.MM_returnValue"><img src="images/del.gif" width="45" height="18" /></a></td>
          </tr>
          <?php } while ($row_RecordNewsPost = mysqli_fetch_assoc($RecordNewsPost)); ?>
        </tbody>
          <?php
		   //
		   if($ManageNewsPostBatchDeleteSelect == "1") { /* 判斷是否開啟批次刪除功能 */
		   ?>
           <tfoot>
           <tr>
            <td align="right" valign="middle">└</td>
            <td colspan="3" valign="middle">
              <input name="button3" type="button" id="button3" onClick="flevToggleCheckboxes('form1',false,true);javascript:$(':checkbox').d_checkbox('check');" value="全選" />
              <input name="button5" type="button" id="button5" onClick="flevToggleCheckboxes('form1',true,false);javascript:$(':checkbox').d_checkbox('click');" value="反選" />          <input name="button4" type="button" id="button4" onClick="flevToggleCheckboxes('form1',false,false);javascript:$(':checkbox').d_checkbox('uncheck');" value="重置" />
              <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
              <font color="#999999">(刪除選取操作)          </font>
            </td>
            <td valign="middle">&nbsp;</td>
            <td valign="middle">&nbsp;</td>
        <td colspan="5" align="right"><font color="#999999">
          <input type="submit" name="button2" id="button2" value="刪除選取項目" onclick="tfm_confirmLink('此動作會刪除所有選取提問以及回應！！確定刪除紀錄嗎？');return document.MM_returnValue" />
        </font></td> 
          </tr>
          </tfoot>
          <?php 
		} 
		//
		?>
      </table>
    </form>
      <?php } // Show if recordset not empty ?>
    <?php if ($totalRows_RecordNewsPost == 0) { // Show if recordset empty ?>
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
        <td width="49" align="left" valign="middle" class="MenuViewPage"><a href="manage_news.php?wshop=<?php echo $wshop;?>&amp;Opt=postaddpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;pd_id=<?php echo $_GET['id']; ?>&amp;pdname=<?php echo $_GET['pdname']; ?>"><img src="images/add.gif" alt="" width="45" height="18" /></a></td>
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
	$(".ed_author").editable("sqledit/newspost_jedit.php", 	{
		//type:'checkbox',
		//cancel: '取消',
		submit: '修改',
		select:true,
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		width: "50px"
		//checkbox: { trueValue: 'Yes', falseValue: 'No' }
	});

	$(".ed_content").editable("sqledit/newspost_jedit.php", 		{
		//cancel: '取消',
		type: "textarea",
		submit: '修改',
		indicator: '<img src="images/indicator.gif">',
		tooltip: '滑鼠點此可編輯此區塊...',
		//event:"dblclick",
		select:true,
		height: "50px",
		width: "500px"
	});
});
</script>
<?php
mysqli_free_result($RecordNewsPost);
?>
