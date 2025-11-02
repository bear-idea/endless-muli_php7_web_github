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

$collang_RecordNewsType = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordNewsType = $_GET['lang'];
}
$coluserid_RecordNewsType = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordNewsType = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNewsType = sprintf("SELECT * FROM demo_newsitem WHERE list_id = 1 && lang = %s && userid=%s", GetSQLValueString($collang_RecordNewsType, "text"),GetSQLValueString($coluserid_RecordNewsType, "int"));
$RecordNewsType = mysqli_query($DB_Conn, $query_RecordNewsType) or die(mysqli_error($DB_Conn));
$row_RecordNewsType = mysqli_fetch_assoc($RecordNewsType);
$totalRows_RecordNewsType = mysqli_num_rows($RecordNewsType);
?>
<style>
.news_tab{
	border: 1px solid #ccc;
	margin: 5px;
}
#nav {
	clear: both;
	overflow: hidden;
	margin-bottom: -1px;
	border-top-width: 0px;
	border-right-width: 0px;
	border-bottom-width: 1px;
	border-left-width: 0px;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-top-color: #CCC;
	border-right-color: #CCC;
	border-bottom-color: #CCC;
	border-left-color: #CCC;
	margin-top: 5px;
	margin-right: 5px;
	margin-left: 5px;
}
#nav ul {}
#nav li {display: inline;}
#nav li a {
	display: block;
	float: left;
	line-height: 30px;
	background: url(images/bg_nav_off.png) repeat-x bottom center;
	text-transform: uppercase;
	color: #fff;
	text-decoration: none;
	margin-right: 1px;
	border-top: 1px solid #000;
	border-right: 1px solid #000;
	border-left: 1px solid #000;
	margin-bottom: -1px;
	padding-top: 0;
	padding-right: 15px;
	padding-bottom: 0;
	padding-left: 15px;
}
#nav li a:visited {display: block; float: left; line-height: 30px; padding: 0 15px; background: url(images/bg_nav_off.png) repeat-x bottom center; text-transform: uppercase; color: #fff; text-decoration: none; margin-right: 1px; border-top: 1px solid #000; border-right: 1px solid #000; border-left: 1px solid #000;}
#nav li a:hover {color: #ccc;}
#nav li a.current {
	background: url(images/bg_nav_on1.png) repeat-x bottom center;
	color: #033333;
	margin-bottom: 0;
	padding-bottom: 0px;
	border-top-color: #ccc;
	border-right-color: #ccc;
	border-left-color: #ccc;
}

#ajax-content {
	overflow-x:hidden;
	overflow: auto;
	height: 250px;
	border: 1px solid #ccc;
	margin-right: 5px;
	margin-bottom: 5px;
	margin-left: 5px;
	padding-top: 10px;
	padding-right: 0;
	padding-bottom: 10px;
	padding-left: 0;
}
#ajax-content h2, #ajax-content p {padding: 0 10px;}
#ajax-content ul {margin: 0 0 0 20px; list-style: disc; line-height: 1.5em;}
.portfolio-box {float: left; margin: 7px; width: 210px; font-size: 12px; text-align: center;}

</style>
<?php
/*********************************************************************
 # 首頁頁面最新訊息
 *********************************************************************/
?>		
<div class="news_tab">
<ul id="nav">
	<li><a href="require_news_index_type_dft.php?lang=<?php echo $_SESSION['lang'] ?>">綜合</a></li>
<?php do { ?>
    <li><a href="require_news_index_type.php?type=<?php echo urlencode($row_RecordNewsType['itemname']); ?>&lang=<?php echo $_SESSION['lang'] ?>"><?php echo $row_RecordNewsType['itemname']; ?></a></li>
<?php } while ($row_RecordNewsType = mysqli_fetch_assoc($RecordNewsType)); ?>
</ul>
<div id="ajax-content"><img src="images/loading.gif" width="32" height="32" /></div>	
</div>	
<script type="text/javascript">			
			
$(document).ready(function() {
    $("#nav li a").click(function() {
        $("#ajax-content").empty().append("<div id='loading'><img src='images/loading.gif' alt='Loading' /></div>");
        $("#nav li a").removeClass('current');
        $(this).addClass('current');
 
        $.ajax({ url: this.href, success: function(html) {
            $("#ajax-content").empty().append(html);
            }
    });
    return false;
    });
 
    $("#ajax-content").empty().append("<div id='loading'><img src='images/loading.gif' alt='Loading' /></div>");
    $.ajax({ url: 'require_news_index_type_dft.php?lang=<?php echo $_SESSION['lang'] ?>', success: function(html) {
            $("#ajax-content").empty().append(html);
    }
    });
});
			
</script>
<?php
mysqli_free_result($RecordNewsType);
?>
