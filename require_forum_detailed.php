<?php require_once('Connections/DB_Conn.php'); ?>
<?php
#	BuildNav for Dreamweaver MX v0.2
#              10-02-2002
#	Alessandro Crugnola [TMM]
#	sephiroth: alessandro@sephiroth.it
#	http://www.sephiroth.it
#	
#	Function for navigation build ::
function buildNavigation($pagePost,$totalPages_RecordForumPost,$prev_RecordForumPost,$next_RecordForumPost,$separator=" | ",$max_links=10, $show_page=true)
{
    GLOBAL $maxRows_RecordForumPost,$totalRows_RecordForumPost;
	$pagesArray = ""; $firstArray = ""; $lastArray = "";
	if($max_links<2)$max_links=2;
	if($pagePost<=$totalPages_RecordForumPost && $pagePost>=0)
	{
		if ($pagePost > ceil($max_links/2))
		{
			$fgp = $pagePost - ceil($max_links/2) > 0 ? $pagePost - ceil($max_links/2) : 1;
			$egp = $pagePost + ceil($max_links/2);
			if ($egp >= $totalPages_RecordForumPost)
			{
				$egp = $totalPages_RecordForumPost+1;
				$fgp = $totalPages_RecordForumPost - ($max_links-1) > 0 ? $totalPages_RecordForumPost  - ($max_links-1) : 1;
			}
		}
		else {
			$fgp = 0;
			$egp = $totalPages_RecordForumPost >= $max_links ? $max_links : $totalPages_RecordForumPost+1;
		}
		if($totalPages_RecordForumPost >= 1) {
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
			$successivo = $pagePost+1;
			$precedente = $pagePost-1;
			$firstArray = ($pagePost > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pagePost=$precedente$_get_vars\">$prev_RecordForumPost</a>" :  "<span>$prev_RecordForumPost</span>";/* css */
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordForumPost) + 1;
					$max_l = ($a*$maxRows_RecordForumPost >= $totalRows_RecordForumPost) ? $totalRows_RecordForumPost : ($a*$maxRows_RecordForumPost);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pagePost)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pagePost=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "<span>"; /* css */
					$pagesArray .= "$textLink</span>"  . ($theNext < $egp-1 ? $separator : "");
				}
			}
			$theNext = $pagePost+1;
			$offset_end = $totalPages_RecordForumPost;
			$lastArray = ($pagePost < $totalPages_RecordForumPost) ? "<a href=\"$_SERVER[PHP_SELF]?pagePost=$successivo$_get_vars\">$next_RecordForumPost</a>" : "<span>$next_RecordForumPost</span>"; /* css */
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

$coluserid_RecordForum = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordForum = $_SESSION['userid'];
}
$colname_RecordForum = "-1";
if (isset($_GET['id'])) {
  $colname_RecordForum = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordForum = sprintf("SELECT * FROM demo_forum WHERE id = %s  && userid=%s", GetSQLValueString($colname_RecordForum, "int"),GetSQLValueString($coluserid_RecordForum, "int"));
$RecordForum = mysqli_query($DB_Conn, $query_RecordForum) or die(mysqli_error($DB_Conn));
$row_RecordForum = mysqli_fetch_assoc($RecordForum);
$totalRows_RecordForum = mysqli_num_rows($RecordForum);

$maxRows_RecordForumPost = 24;
$pagePost = 0;
if (isset($_GET['pagePost'])) {
  $pagePost = $_GET['pagePost'];
}
$startRow_RecordForumPost = $pagePost * $maxRows_RecordForumPost;

$colname_RecordForumPost = "-1";
if (isset($_GET['id'])) {
  $colname_RecordForumPost = $_GET['id'];
}
$coluserid_RecordForumPost = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordForumPost = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordForumPost = sprintf("SELECT * FROM demo_forumpost WHERE pid = %s && userid=%s", GetSQLValueString($colname_RecordForumPost, "int"),GetSQLValueString($coluserid_RecordForumPost, "int"));
$query_limit_RecordForumPost = sprintf("%s LIMIT %d, %d", $query_RecordForumPost, $startRow_RecordForumPost, $maxRows_RecordForumPost);
$RecordForumPost = mysqli_query($DB_Conn, $query_limit_RecordForumPost) or die(mysqli_error($DB_Conn));
$row_RecordForumPost = mysqli_fetch_assoc($RecordForumPost);

if (isset($_GET['totalRows_RecordForumPost'])) {
  $totalRows_RecordForumPost = $_GET['totalRows_RecordForumPost'];
} else {
  $all_RecordForumPost = mysqli_query($DB_Conn, $query_RecordForumPost);
  $totalRows_RecordForumPost = mysqli_num_rows($all_RecordForumPost);
}
$totalPages_RecordForumPost = ceil($totalRows_RecordForumPost/$maxRows_RecordForumPost)-1;
?>
<?php 
if ((isset($_GET['del_postid'])) && ($_GET['del_postid'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_forum WHERE id=%s && author=%s",
                       GetSQLValueString($_GET['del_postid'], "int"),
                       GetSQLValueString($_SESSION['MM_Username_' . $_GET['wshop']], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  
  $deleteSQLPost = sprintf("DELETE FROM demo_forumpost WHERE id=%s && author=%s",
                       GetSQLValueString($_GET['del_postid'], "int"),
                       GetSQLValueString($_SESSION['MM_Username_' . $_GET['wshop']], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $ResultPost = mysqli_query($DB_Conn, $deleteSQLPost) or die(mysqli_error($DB_Conn));
  
  $delGoToUrl = "forum.php?wshop=" . $_GET['wshop'] . "&Opt=viewpage&lang=" . $_SESSION['lang'];
  
  echo("<script language='javascript'>location.href='" . $delGoToUrl . "'</script>");
}
?>
<?php 
if ((isset($_GET['del_id'])) && ($_GET['del_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM demo_forumpost WHERE id=%s && author=%s",
                       GetSQLValueString($_GET['del_id'], "int"),
                       GetSQLValueString($_SESSION['MM_Username_' . $_GET['wshop']], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  
  $updateSQL = "UPDATE demo_forum SET replycount=replycount-1 WHERE id =" . $_GET['id'];
  /*執行更新動作*/
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  
  echo("<script language='javascript'>location.href='" . $_SERVER['HTTP_REFERER'] . "'</script>");
}
?>
<?php 
// 瀏覽數 - 熱門
  $updateSQL = sprintf("UPDATE demo_forum SET visit=visit+1 WHERE id=%s",
                       GetSQLValueString($_GET['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
?>
<?php if ($MSTMP == 'default') { ?>
<div class="columns on-1">
        <div class="container">
            <div class="column">
                <div class="container ct_board">
                <h3><span class="titlesicon"><img src="images/dot_02.jpg" width="15" height="20" /></span>
                <?php echo $Lang_Content_Title_Forum; // 標題文字 ?></h3>
                </div>
            </div>
        </div>        
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
    <tr>
      <td width="50%"><?php echo $Lang_Content_Count_Total; // 共計?> <?php echo $totalRows_RecordForumPost ?> <?php echo $Lang_Content_Count_Lots; //筆 ?>回覆</td>
      <td width="50%" align="right">
      
      <?php if ($ForumPostSearchSelect == "1") { ?>
      <form id="form_ForumPost" name="form_ForumPost" method="get" action="<?php echo $editFormAction; ?>">
        <label>
          <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
          <img src="images/Search.png" alt="搜尋" width="20" height="20" align="absmiddle" />
          <input type="text" name="searchkey" id="searchkey" />
          <input type="submit" name="button" id="button" value="<?php echo $Lang_Form_Search_ForumPost; ?>" />
        </label>
      </form>
      <?php } ?>  
      <div class="PageSelectBoard">
      <?php 
      # variable declaration
      $prev_RecordForumPost = "<i class=\"fa fa-angle-left\"></i>";
      $next_RecordForumPost = "<i class=\"fa fa-angle-right\"></i>";
      $separator = "&nbsp;";
      $max_links = 6;
      $pages_navigation_RecordForumPost = buildNavigation($pagePost,$totalPages_RecordForumPost,$prev_RecordForumPost,$next_RecordForumPost,$separator,$max_links,true); 
       ?>
      <?php if ($pagePost > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pagePost=%d%s", $currentPage, 0, $queryString_RecordForumPost); ?>"><i class="fa fa-angle-double-left"></i></a>
        <?php } // Show if not first page ?>
<?php print $pages_navigation_RecordForumPost[0]; ?> 
      <?php print $pages_navigation_RecordForumPost[1]; ?> 
      <?php print $pages_navigation_RecordForumPost[2]; ?>
      <?php if ($pagePost < $totalPages_RecordForumPost) { // Show if not last page ?>
  <a href="<?php printf("%s?pagePost=%d%s", $currentPage, $totalPages_RecordForumPost, $queryString_RecordForumPost); ?>"><i class="fa fa-angle-double-right"></i></a>
  <?php } // Show if not last page ?>
<?php if (ceil($totalRows_RecordForumPost/$maxRows_RecordForumPost) > 1) { ?><span class="Record_Board"><?php echo $Lang_PageNum;; // 頁數?>：<?php print $pagePost+1; ?> / <?php echo ceil($totalRows_RecordForumPost/$maxRows_RecordForumPost); ?></span><?php } ?>
      </div>  
      
      </td>
    </tr>
</table>
<div class="columns on-1">
        <div class="container board">
            <div class="column">
                <div class="container ct_board">
                   <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
                      <tr>
                        <td bgcolor="#EEE">
                          <strong><span style="font-size:16px;">[<?php echo $row_RecordForum['type']; ?>]<?php echo $row_RecordForum['name']; ?></span></strong>                        </td>
                      </tr>
                      <tr>
                        <td><?php //require("require_forum_member.php"); ?>                          <span style="color:#999; font-size:9px;">發表於<?php echo $row_RecordForum['postdate']; ?></span></td>
                      </tr>
                      <tr>
                        <td><?php echo $row_RecordForum['content']; ?></td>
                      </tr>
                      <tr>
                        <td><hr></td>
                      </tr>
                      <?php if ($totalRows_RecordForumPost > 0) { // Show if recordset not empty ?>
  <?php do { ?>
    <tr>
      <td bgcolor="#EEE">
        <span style="font-size:16px;">RE:<?php echo $row_RecordForumPost['author']; ?></span></td>
    </tr>
    
    <tr>
      <td><span style="color:#999; font-size:9px;">回覆於<?php echo $row_RecordForumPost['postdate']; ?></span><span style="color:#900; font-size:9px;">[刪除]</span></td>
    </tr>
    <tr>
      <td><?php echo $row_RecordForumPost['content']; ?></td>
    </tr>
    <?php } while ($row_RecordForumPost = mysqli_fetch_assoc($RecordForumPost)); ?>
                        <?php } // Show if recordset not empty ?>
                   </table>
                   
				</div>        
			</div>
	    </div>        
</div>
<?php } else { ?>
<?php include($TplPath . "/forum_detailed.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordForum);

mysqli_free_result($RecordForumPost);
?>
