<?php require_once('Connections/DB_Conn.php'); ?>
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
      break;        case "long":
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

$maxRows_RecordNews = 10;
$page = 0;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_RecordNews = $page * $maxRows_RecordNews;

$collang_RecordNews = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordNews = $_GET['lang'];
}
$coluserid_RecordNews = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordNews = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNews = sprintf("SELECT * FROM demo_news WHERE (indicate=1) && (lang = %s) && userid=%s ORDER BY id DESC", GetSQLValueString($collang_RecordNews, "text"),GetSQLValueString($coluserid_RecordNews, "int"));
$query_limit_RecordNews = sprintf("%s LIMIT %d, %d", $query_RecordNews, $startRow_RecordNews, $maxRows_RecordNews);
$RecordNews = mysqli_query($DB_Conn, $query_limit_RecordNews) or die(mysqli_error($DB_Conn));
$row_RecordNews = mysqli_fetch_assoc($RecordNews);

if (isset($_GET['totalRows_RecordNews'])) {
  $totalRows_RecordNews = $_GET['totalRows_RecordNews'];
} else {
  $all_RecordNews = mysqli_query($DB_Conn, $query_RecordNews);
  $totalRows_RecordNews = mysqli_num_rows($all_RecordNews);
}
$totalPages_RecordNews = ceil($totalRows_RecordNews/$maxRows_RecordNews)-1;
?>
<style type="text/css">
#News_Wrp {
	width: 100%;
	border: 1px solid #999;
	background-color: #FFF;
}

#News_Wrp .Sub_wrp{
	height:35px;
	overflow:hidden;
	width:100%;
}

#News_Wrp .Sub_wrp .content{
	display:block;
	height:70px;
	top:0px;
	position:relative;
	width:100%;
	background-image: url(images/about.jpg);
	background-position: center bottom;
	overflow:hidden;
}

#News_Wrp .Sub_wrp .float_left_type{
	float: left;
	color: #069;
	font-weight: bold;
}

#News_Wrp .Sub_wrp .float_left{
	float: left;
}

#News_Wrp .Sub_wrp .float_right{
	float: right;
}

#News_Wrp .Sub_wrp .float_right_last{
	float: right;
}

</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
    <tr>
      <td width="50%">
	  <?php echo $Lang_Content_Title_News; // 標題文字 ?>
      </td>
      <td align="right">
      <a href="news.php?Opt_News=viewpage&lang=<?php echo $_SESSION['lang']; ?>&amp;type=News"><?php echo $Lang_Content_Title_More; // 更多?></a>
      </td>
    </tr>
</table> 
<?php 
if ($totalRows_RecordNews > 0) { // Show if recordset not empty 
?>
<div id="News_Wrp">
      <?php
      do { 
      ?>
      <div class="Sub_wrp">
      	<div class="content">
              <?php 
              if($row_RecordNews['type'] != "") { 
              ?>
              <span class="float_left_type">[<?php echo highLight($row_RecordNews['type'], @$_GET['searchkey'], $HighlightSelect); ?>]</span> 
              <?php 
              } 
              ?>
              <span class="float_left">
              <a href="news.php?Opt=detailed&amp;navi=<?php echo $_GET['navi']; ?>&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;id=<?php echo $row_RecordNews['id']; ?>&amp;type=News"><?php echo $row_RecordNews['title']; ?></a>
              </span>
  <span  class="float_right_last">
              <?php echo highLight(date('Y-m-d',strtotime($row_RecordNews['postdate'])), @$_GET['searchkey'], $HighlightSelect); ?>
              </span>
           </div>
      </div>
      <?php 
      } while ($row_RecordNews = mysqli_fetch_assoc($RecordNews)); 
      ?>
       
	</div>
<?php 
} // Show if recordset not empty 
?>

<?php 
if ($totalRows_RecordNews == 0) { // Show if recordset empty 
?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
      <tr>
        <td align="center"><font color="#FF0000">目前尚無資料！！</font></td>
      </tr>
    </table>
<?php 
} // Show if recordset empty 
?>
<script type="text/javascript" language="javascript">	
	$(document).ready(function(){
			$("#News_Wrp .Sub_wrp .content").hover(function(){
			$(this).stop().animate({top:"0px"}, "300");
			}, function(){
			$(this).stop().animate({top:"-10px"}, "300");
			});
	});	
</script>
<?php
mysqli_free_result($RecordNews);
?>
