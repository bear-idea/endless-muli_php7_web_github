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

$colname_RecordCareers = "-1";
if (isset($_GET['id'])) {
  $colname_RecordCareers = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCareers = sprintf("SELECT * FROM demo_careers WHERE id = %s", GetSQLValueString($colname_RecordCareers, "int"));
$RecordCareers = mysqli_query($DB_Conn, $query_RecordCareers) or die(mysqli_error($DB_Conn));
$row_RecordCareers = mysqli_fetch_assoc($RecordCareers);
$totalRows_RecordCareers = mysqli_num_rows($RecordCareers);

$colid_RecordCareersPrev = "-1";
if (isset($_GET['id'])) {
  $colid_RecordCareersPrev = $_GET['id'];
}
$collang_RecordCareersPrev = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordCareersPrev = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCareersPrev = sprintf("SELECT * FROM demo_careers WHERE id>%s && lang=%s && (indicate=1) ORDER BY sortid ASC, id DESC LIMIT 1", GetSQLValueString($colid_RecordCareersPrev, "int"),GetSQLValueString($collang_RecordCareersPrev, "text"));
$RecordCareersPrev = mysqli_query($DB_Conn, $query_RecordCareersPrev) or die(mysqli_error($DB_Conn));
$row_RecordCareersPrev = mysqli_fetch_assoc($RecordCareersPrev);
$totalRows_RecordCareersPrev = mysqli_num_rows($RecordCareersPrev);

$colid_RecordCareersNext = "-1";
if (isset($_GET['id'])) {
  $colid_RecordCareersNext = $_GET['id'];
}
$collang_RecordCareersNext = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordCareersNext = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCareersNext = sprintf("SELECT * FROM demo_careers WHERE id<%s && lang=%s && (indicate=1) ORDER BY sortid DESC, id ASC LIMIT 1", GetSQLValueString($colid_RecordCareersNext, "int"),GetSQLValueString($collang_RecordCareersNext, "text"));
$RecordCareersNext = mysqli_query($DB_Conn, $query_RecordCareersNext) or die(mysqli_error($DB_Conn));
$row_RecordCareersNext = mysqli_fetch_assoc($RecordCareersNext);
$totalRows_RecordCareersNext = mysqli_num_rows($RecordCareersNext);
?>
<style type="text/css">
.container{
	padding: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	margin-left: 0px;
}

.board{
	border: 1px solid #DDD;
}

.ct_board{
	padding: 5px;
}
</style>
<!--前後筆資料-->
<?php if ($row_RecordCareersPrev['id'] != '') { ?>
<div id="left-fixed-center"><a href="careers.php?Opt=detailed&amp;tp=Careers&amp;lang=<?php echo $_GET['lang'] ?>&amp;id=<?php echo $row_RecordCareersPrev['id']; ?>"></a></div>
<?php } ?>
<?php if ($row_RecordCareersNext['id'] != '') { ?>
<div id="right-fixed-center"><a href="careers.php?Opt=detailed&amp;tp=Careers&amp;lang=<?php echo $_GET['lang'] ?>&amp;id=<?php echo $row_RecordCareersNext['id']; ?>"></a></div>
<?php } ?>
<!--前後筆資料 END-->
<div class="columns on-1">
        <div class="container">
            <div class="column">
                <div class="container ct_board">
                <h3><span class="titlesicon"><img src="images/dot_02.jpg" width="15" height="20" /></span>
                <?php echo $Lang_Content_Title_Careers; // 標題文字 ?></h3>
                </div>
            </div>
        </div>        
</div>
<div class="columns on-1">
        <div class="container board">
            <div class="column">
                <div class="container ct_board">
                     <!-- **************************************************************** -->
                     <table width="100%" border="0" cellspacing="0" cellpadding="0">
                       <tr>
                         <td width="50%"><!-- **************************************************************** -->
                           <strong><?php echo $row_RecordCareers['title']; ?></strong>
                           <!-- **************************************************************** --></td>
                         <td width="50%" align="right">&laquo; <a href="javascript:history.back()"><?php echo $Lang_BackPage ?></a></td>
                       </tr>
                     </table>
                     <script language="javascript">
var $url = '<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>';
$url = $url.replace(/&amp;/gi, '&');
$url = encodeURIComponent($url);

document.write('<iframe  src="http://www.facebook.com/plugins/like.php?href=' + $url + '" scrolling="no"  frameborder="0" style="height: 25px; width: 100%"  allowTransparency="true"></iframe>');
                     </script>
                     <!-- **************************************************************** -->
                     <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
                       <tr>
                         <td valign="top"><?php echo $row_RecordNews['content']; ?></td>
                       </tr>
                     </table>
<!-- **************************************************************** -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/zh_TW/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-comments" data-href="<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" data-num-posts="2" data-width="500"></div>
                </div>
            </div>
        </div>        
</div>
<?php
mysqli_free_result($RecordNews);

mysqli_free_result($RecordNewsPrev);

mysqli_free_result($RecordNewsNext);
?>
