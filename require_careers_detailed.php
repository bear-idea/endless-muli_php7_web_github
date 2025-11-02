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
$coluserid_RecordCareers = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordCareers = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCareers = sprintf("SELECT * FROM demo_careers WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordCareers, "int"),GetSQLValueString($coluserid_RecordCareers, "int"));
$RecordCareers = mysqli_query($DB_Conn, $query_RecordCareers) or die(mysqli_error($DB_Conn));
$row_RecordCareers = mysqli_fetch_assoc($RecordCareers);
$totalRows_RecordCareers = mysqli_num_rows($RecordCareers);
?>
<!--前後筆資料-->
<?php if ($row_RecordCareersPrev['id'] != '') { ?>
<div id="left-fixed-center"><a href="careers.php?Opt=detailed&amp;tp=Careers&amp;lang=<?php echo $_GET['lang'] ?>&amp;id=<?php echo $row_RecordCareersPrev['id']; ?>"></a></div>
<?php } ?>
<?php if ($row_RecordCareersNext['id'] != '') { ?>
<div id="right-fixed-center"><a href="careers.php?Opt=detailed&amp;tp=Careers&amp;lang=<?php echo $_GET['lang'] ?>&amp;id=<?php echo $row_RecordCareersNext['id']; ?>"></a></div>
<?php } ?>
<!--前後筆資料 END-->
<?php if ($MSTMP == 'default') { ?>
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
                         <td valign="top"><?php echo $row_RecordCareers['content']; ?></td>
                       </tr>
                     </table>
<!-- **************************************************************** -->
                </div>
            </div>
        </div>        
</div>
<?php } else { ?>
<?php include($TplPath . "/careers_detailed.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordCareers);
?>
