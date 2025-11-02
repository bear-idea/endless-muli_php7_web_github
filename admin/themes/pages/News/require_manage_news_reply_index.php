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
    GLOBAL $maxRows_RecordNewsReply,$totalRows_RecordNewsReply;
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
					if ($_get_name != "pageReply") {
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
			$firstArray = ($pageNum_Recordset1 > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pageReply=$precedente$_get_vars\">$prev_Recordset1</a>" :  "<span>$prev_Recordset1</span>"/*  css */;
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordNewsReply) + 1;
					$max_l = ($a*$maxRows_RecordNewsReply >= $totalRows_RecordNewsReply) ? $totalRows_RecordNewsReply : ($a*$maxRows_RecordNewsReply);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageNum_Recordset1)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageReply=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "<span>"; /* css */
					$pagesArray .= "$textLink</span>"  . ($theNext < $egp-1 ? $separator : "");
				}
			}
			$theNext = $pageNum_Recordset1+1;
			$offset_end = $totalPages_Recordset1;
			$lastArray = ($pageNum_Recordset1 < $totalPages_Recordset1) ? "<a href=\"$_SERVER[PHP_SELF]?pageReply=$successivo$_get_vars\">$next_Recordset1</a>" : "<span>$next_Record1</span>"; /* css */
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

/* 刪除回應資料 */
if ((isset($_GET['reply_del_id'])) && ($_GET['reply_del_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_newsreply WHERE rid=%s",
                       GetSQLValueString($_GET['reply_del_id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
}


/* 讀取資料 */
if (isset($_GET['pageReply'])) {
  $pageReply = $_GET['pageReply'];
}
$startRow_RecordNewsReply = $pageReply * $maxRows_RecordNewsReply;

$maxRows_RecordNewsReply = 25;
$pageReply = 0;
if (isset($_GET['pageReply'])) {
  $pageReply = $_GET['pageReply'];
}
$startRow_RecordNewsReply = $pageReply * $maxRows_RecordNewsReply;

$colpid_RecordNewsReply = "-1";
if (isset($_GET['post_id'])) {
  $colpid_RecordNewsReply = $_GET['post_id'];
}
$coluserid_RecordNewsReply = "-1";
if (isset($w_userid)) {
  $coluserid_RecordNewsReply = $w_userid;
}
$colname_RecordNewsReply = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordNewsReply = $_GET['searchkey'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNewsReply = sprintf("SELECT demo_newspost.id, demo_newsreply.content, demo_newsreply.userid, demo_newspost.author, demo_newspost.postdate, demo_newsreply.rid, demo_newsreply.pid FROM demo_newspost LEFT OUTER JOIN demo_newsreply ON demo_newspost.id = demo_newsreply.pid WHERE (demo_newsreply.pid = %s) &&((demo_newspost.postdate LIKE %s) || (demo_newspost.author LIKE %s) || demo_newsreply.content LIKE %s) && demo_newsreply.userid=%s ORDER BY demo_newsreply.rid DESC", GetSQLValueString($colpid_RecordNewsReply, "int"),GetSQLValueString("%" . $colname_RecordNewsReply . "%", "text"),GetSQLValueString("%" . $colname_RecordNewsReply . "%", "text"),GetSQLValueString("%" . $colname_RecordNewsReply . "%", "text"),GetSQLValueString($coluserid_RecordNewsReply, "int"));
$query_limit_RecordNewsReply = sprintf("%s LIMIT %d, %d", $query_RecordNewsReply, $startRow_RecordNewsReply, $maxRows_RecordNewsReply);
$RecordNewsReply = mysqli_query($DB_Conn, $query_limit_RecordNewsReply) or die(mysqli_error($DB_Conn));
$row_RecordNewsReply = mysqli_fetch_assoc($RecordNewsReply);

if (isset($_GET['totalRows_RecordNewsReply'])) {
  $totalRows_RecordNewsReply = $_GET['totalRows_RecordNewsReply'];
} else {
  $all_RecordNewsReply = mysqli_query($DB_Conn, $query_RecordNewsReply);
  $totalRows_RecordNewsReply = mysqli_num_rows($all_RecordNewsReply);
}
$totalPages_RecordNewsReply = ceil($totalRows_RecordNewsReply/$maxRows_RecordNewsReply)-1;

// 判斷字數顯示限制 For 100 Words
function TrimByLength($str, $len, $word) {
  $end = "";
  if (strlen($str) > $len) $end = "...";
  $str = mb_substr($str, 0, $len, "UTF-8");
  if ($word) $str = substr($str,0,strrpos($str," ")+1);
  return $str.$end;
}
?>
<div>
<div>
      
      <?php 
	  switch($_GET['Operate']) 
	  {
		  case "addSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('資料新增成功！！','success');});</script>\n";
			break;
		  case "editSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('資料修改成功！！','information');});</script>\n";
			break;
		  case "replyeditSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('回應修改成功！！','information');});</script>\n";
			break;
		  case "replySuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('訊息回應成功！！','success');});</script>\n";
			break;
		  case "delSuccess":
		  	echo "<script type=\"text/javascript\">$(document).ready(function() {generatetip('刪除回應成功！！','warning');});</script>\n";
			break;	
		  default:
		  	break;
	  }
	  ?>
       
      
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">回應</font><font color="#756b5b">訊息一覽 [<?php echo $langname; ?>編輯介面]</font></strong></h5></td>
            <td><?php require("fontresize.php"); // 改變字型大小 ?></td>
        </tr>
      </table>
      
         
      
<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
          <tr>
          	<td width="50%"> 顯示 <?php echo ($startRow_RecordNewsReply + 1) ?> -  <?php echo min($startRow_RecordNewsReply + $maxRows_RecordNewsReply, $totalRows_RecordNewsReply) ?> 筆 共計 <?php echo $totalRows_RecordNewsReply ?> 筆</td>
            <td width="50%" align="right">
            
            <?php if ($ManageNewsReplySearchSelect == "1") { // 搜索功能開啟設定?>
            <form id="form_NewsReply" name="form_NewsReply" method="get" action="<?php echo $editFormAction; ?>">
              <label>
                <input name="OptReply" type="hidden" id="OptReply" value="viewpage" />
                <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                <img src="../images/Search.png" width="16" height="16" />
                <input type="text" name="searchkey" id="searchkey" />
                <input type="submit" name="button" id="button" value="搜索" />
              </label>
            </form>
            <?php } ?>
            
             
            <?php 
			# variable declaration
			$prev_RecordNewsReply = "«";
			$next_RecordNewsReply = "»";
			$separator = "&nbsp;";
			$max_links = 6;
			$pages_navigation_RecordNewsReply = buildNavigation($pageReply,$totalPages_RecordNewsReply,$prev_RecordNewsReply,$next_RecordNewsReply,$separator,$max_links,true); 
			
			print $pages_navigation_RecordNewsReply[0]; 
			?>
            <?php print $pages_navigation_RecordNewsReply[1]; ?> 
			<?php print $pages_navigation_RecordNewsReply[2]; ?>
            
            </td>
          </tr>
          <tr>
            <td colspan="2"><hr></td>
          </tr>
    </table>
    
    <?php if ($totalRows_RecordNewsReply > 0 && $row_RecordNewsReply['rid'] != "") { // Show if recordset not empty ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter" id="TBSort">
      <thead>
        <tr>
          <th width="23">&nbsp;</th>
          <th><strong>提問者：<font color="#2865A2"><strong><?php echo highLight($row_RecordNewsReply['author'], @$_GET['searchkey'], $HighlightSelect); ?></strong></font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;提問時間：<font color="#666666"><?php echo highLight(date('Y-m-d',strtotime($row_RecordNewsReply['postdate'])), @$_GET['searchkey'], $HighlightSelect); ?></font></strong>&nbsp;&nbsp;&nbsp;<strong><font color="#666666"><?php echo highLight(date('g:i A',strtotime($row_RecordNewsReply['postdate'])), @$_GET['searchkey'], $HighlightSelect); ?></font></strong></th>
          <th colspan="4" align="left"><strong>回應操作</strong></th>
        </tr>
        </thead>
        <tbody>
          <?php do { ?>
          <tr>
            <td align="center" valign="middle"><img src="images/sicon/play.gif" width="18" height="18" />
</td>
            <td valign="middle">
            <div class="ed_content" id="content_<?php echo  $row_RecordNewsReply['id'];?>">
            <?php echo highLight($row_RecordNewsReply['content'], @$_GET['searchkey'], $HighlightSelect); ?>
            </div>
			<?php if($row_RecordNewsReply['rid'] == "") {echo "<font color=\"#FF0000\">目前尚無資料！！</font>";}?>
            </td>
            <td width="45" align="left" valign="middle"class="MenuViewPage"><img src="images/nsee.gif" width="45" height="18" /></td>
            <td width="45" align="left" valign="middle" class="MenuViewPage"><a href="manage_news.php?wshop=<?php echo $wshop;?>&amp;Opt=replyaddpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;post_id=<?php echo $row_RecordNewsReply['id']; ?>&amp;pd_id=<?php echo $_GET['pd_id']; ?>&amp;pdname=<?php echo $_GET['pdname']; ?>"><img src="images/reply.gif" alt="" width="45" height="18" /></a></td>
            <td width="45" align="left" valign="middle" class="MenuViewPage"><a href="manage_news.php?wshop=<?php echo $wshop;?>&amp;Opt=replyeditpage&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;post_id=<?php echo $row_RecordNewsReply['pid']; ?>&amp;pd_id=<?php echo $_GET['pd_id']; ?>&amp;pdname=<?php echo $_GET['pdname']; ?>&amp;rid=<?php echo $row_RecordNewsReply['rid']; ?>"><img src="images/edit.gif" alt="" width="45" height="18" /></a></td>
            <td width="49" align="left" valign="middle" class="MenuViewPage"><a href="manage_news.php?wshop=<?php echo $wshop;?>&amp;Opt=replypage&amp;reply_del_id=<?php echo $row_RecordNewsReply['rid']; ?>&amp;Operate=delSuccess&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;post_id=<?php echo $row_RecordNewsReply['id']; ?>&amp;pd_id=<?php echo $_GET['pd_id']; ?>"><img src="images/del.gif" width="45" height="18" /></a></td>
          </tr>
          <?php } while ($row_RecordNewsReply = mysqli_fetch_assoc($RecordNewsReply)); ?>
          </tbody>
      </table>
      <?php } // Show if recordset not empty ?>
      <?php if ($totalRows_RecordNewsReply == 0) { // Show if recordset empty ?>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01_hover">
    <tr>
      <td width="23">&nbsp;</td>
      <td><strong>提問者：<font color="#2865A2"><strong><?php echo highLight($row_RecordNewsReply['author'], @$_GET['searchkey'], $HighlightSelect); ?></strong></font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;提問時間：<font color="#666666"><?php echo highLight(date('Y/m/d',strtotime($row_RecordNewsReply['postdate'])), @$_GET['searchkey'], $HighlightSelect); ?></font></strong>&nbsp;&nbsp;&nbsp;<strong><font color="#666666"><?php echo highLight(date('g:i A',strtotime($row_RecordNewsReply['postdate'])), @$_GET['searchkey'], $HighlightSelect); ?></font></strong></td>
      <td width="90"><strong>回應操作</strong></td>
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
$(document).ready(function() {
	$(".ed_content").editable("sqledit/newsreply_jedit.php", 		{
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
mysqli_free_result($RecordNewsReply);
?>
