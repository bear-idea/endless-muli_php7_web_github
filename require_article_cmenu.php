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

$coltype1_RecordArticleCMenu = "-1";
if (isset($_GET['type1'])) {
  $coltype1_RecordArticleCMenu = $_GET['type1'];
}
$coluserid_RecordArticleCMenu = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordArticleCMenu = $_SESSION['userid'];
}
$coltype2_RecordArticleCMenu = "-1";
if (isset($_GET['type2'])) {
  $coltype2_RecordArticleCMenu = $_GET['type2'];
}
$coltype3_RecordArticleCMenu = "-1";
if (isset($_GET['type3'])) {
  $coltype3_RecordArticleCMenu = $_GET['type3'];
}
$colnamelang_RecordArticleCMenu = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordArticleCMenu = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordArticleCMenu = sprintf("SELECT * FROM demo_article WHERE lang = %s && type1 = %s && type2 = %s && type3 = %s  && indicate = 1 && userid=%s ORDER BY sortid ASC, id DESC", GetSQLValueString($colnamelang_RecordArticleCMenu, "text"),GetSQLValueString($coltype1_RecordArticleCMenu, "int"),GetSQLValueString($coltype2_RecordArticleCMenu, "int"),GetSQLValueString($coltype3_RecordArticleCMenu, "int"),GetSQLValueString($coluserid_RecordArticleCMenu, "int"));
$RecordArticleCMenu = mysqli_query($DB_Conn, $query_RecordArticleCMenu) or die(mysqli_error($DB_Conn));
$row_RecordArticleCMenu = mysqli_fetch_assoc($RecordArticleCMenu);
$totalRows_RecordArticleCMenu = mysqli_num_rows($RecordArticleCMenu);
?>
<?php if ($MSTMP == 'default') { ?>
<style type="text/css">
.nav-wrap { margin: 5px auto; border-top: 2px solid white; border-bottom: 2px solid white; }

.group:after { visibility: hidden; display: block; font-size: 0; content: " "; clear: both; height: 0; }
*:first-child+html .group { zoom: 1; } /* IE7 */

#sm-one { margin: 0 auto; list-style: none; position: relative; width: 960px; }
#sm-one li { display: inline; }
#sm-one li a { color: #bbb; font-size: 14px; display: block; float: left; padding: 6px 10px 4px 10px; text-decoration: none; text-transform: uppercase; }
#sm-one li a:hover {
	color: #333;
}
#magic-line { position: absolute; bottom: -2px; left: 0; width: 100px; height: 2px; background: #fe4902; }

#example-two { margin: 0 auto; list-style: none; position: relative; width: 960px; }
#example-two li { display: inline; }
#example-two li a { position: relative; z-index: 200; color: #bbb; font-size: 14px; display: block; float: left; padding: 6px 10px 4px 10px; text-decoration: none; text-transform: uppercase; }
#example-two li a:hover { color: black; }
#example-two #magic-line-two { position: absolute; top: 0; left: 0; width: 100px; background: rgba(220, 133, 5, 0.9); z-index: 100; -moz-border-radius: 5px; -webkit-border-radius: 5px; }

.current_page_item a, .current_page_item_two a {
	color: #F00 !important;
}
</style>
<?php if ($totalRows_RecordArticleCMenu > 1 ) { // Show if recordset not empty ?>
<div class="nav-wrap">
  <ul class="group" id="sm-one">
    <?php $menu_act=1; // 選單啟用 ?>
    <?php do { ?>
      <?php if (isset($_GET['Opt']) && $_GET['Opt']=='detailed') { ?> 
      <li class="<?php if ($row_RecordArticleCMenu['id'] == $_GET['id']){echo "current_page_item";} ?>"><a href="article.php?wshop=<?php echo $_GET['wshop']?>&amp;Opt=detailed&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;tp=Article&amp;level=<?php echo $level; ?>&amp;type1=<?php echo $row_RecordArticleCMenu['type1']; ?>&amp;type2=<?php echo $row_RecordArticleCMenu['type2']; ?>&amp;type3=<?php echo $row_RecordArticleCMenu['type3']; ?>&amp;subitem_id=<?php echo $_GET['subitem_id']; ?>&amp;id=<?php echo $row_RecordArticleCMenu['id']; ?>"><?php echo $row_RecordArticleCMenu['title']; ?></a></li>
      <?php } else {?>
      <li class="<?php if ($menu_act == '1') {echo "current_page_item";}?>"><a href="article.php?wshop=<?php echo $_GET['wshop']?>&amp;Opt=detailed&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;tp=Article&amp;level=<?php echo $level; ?>&amp;type1=<?php echo $row_RecordArticleCMenu['type1']; ?>&amp;type2=<?php echo $row_RecordArticleCMenu['type2']; ?>&amp;type3=<?php echo $row_RecordArticleCMenu['type3']; ?>&amp;subitem_id=<?php echo $_GET['subitem_id']; ?>&amp;id=<?php echo $row_RecordArticleCMenu['id']; ?>"><?php echo $row_RecordArticleCMenu['title']; ?></a></li>
       <?php $menu_act = 0;?>
      <?php } ?>   
      <?php } while ($row_RecordArticleCMenu = mysqli_fetch_assoc($RecordArticleCMenu)); ?> 
  </ul>
  
</div>
<?php } // Show if recordset not empty ?>
<script type="text/javascript">
$(function(){

    var $el, leftPos, newWidth,
        $mainNav = $("#sm-one"),
        $mainNav2 = $("#sm-two");
    
    /*
        EXAMPLE ONE
    */
    $mainNav.append("<li id='magic-line'></li>");
    
    var $magicLine = $("#magic-line");
    
    $magicLine
        .width($(".current_page_item").width())
        .css("left", $(".current_page_item a").position().left)
        .data("origLeft", $magicLine.position().left)
        .data("origWidth", $magicLine.width());
        
    $("#sm-one li").find("a").hover(function() {
        $el = $(this);
        leftPos = $el.position().left;
        newWidth = $el.parent().width();
        
        $magicLine.stop().animate({
            left: leftPos,
            width: newWidth
        });
    }, function() {
        $magicLine.stop().animate({
            left: $magicLine.data("origLeft"),
            width: $magicLine.data("origWidth")
        });    
    });
	
	 /*
        EXAMPLE TWO
    */
    $mainNav2.append("<li id='magic-line-two'></li>");
    
    var $magicLineTwo = $("#magic-line-two");
    
    $magicLineTwo
        .width($(".current_page_item_two").width())
        .height($mainNav2.height())
        .css("left", $(".current_page_item_two a").position().left)
        .data("origLeft", $(".current_page_item_two a").position().left)
        .data("origWidth", $magicLineTwo.width())
        .data("origColor", $(".current_page_item_two a").attr("rel"));
                
    $("#example-two li").find("a").hover(function() {
        $el = $(this);
        leftPos = $el.position().left;
        newWidth = $el.parent().width();
        $magicLineTwo.stop().animate({
            left: leftPos,
            width: newWidth,
            backgroundColor: $el.attr("rel")
        })
    }, function() {
        $magicLineTwo.stop().animate({
            left: $magicLineTwo.data("origLeft"),
            width: $magicLineTwo.data("origWidth"),
            backgroundColor: $magicLineTwo.data("origColor")
        });    
    });
});
</script>
<?php } else { ?>
<?php include($TplPath . "/article_cmenu.php"); ?>
<?php } ?>
<?php
mysqli_free_result($RecordArticleCMenu);
?>
