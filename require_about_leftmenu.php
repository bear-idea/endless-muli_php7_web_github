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

$collang_RecordMultiLeftMenu_l1 = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordMultiLeftMenu_l1 = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordMultiLeftMenu_l1 = sprintf("SELECT * FROM demo_articleitem WHERE list_id = 1 && lang = %s && level = '0'", GetSQLValueString($collang_RecordMultiLeftMenu_l1, "text"));
$RecordMultiLeftMenu_l1 = mysqli_query($DB_Conn, $query_RecordMultiLeftMenu_l1) or die(mysqli_error($DB_Conn));
$row_RecordMultiLeftMenu_l1 = mysqli_fetch_assoc($RecordMultiLeftMenu_l1);
$totalRows_RecordMultiLeftMenu_l1 = mysqli_num_rows($RecordMultiLeftMenu_l1);
?>
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery.dimensions.js"></script> 
<script type="text/javascript" src="js/jquery.accordion.js"></script> 
<script type=text/javascript>
<!--
$(function () {
	$('ul.drawers').accordion({
		active: true, // 是否進入即啟用
		//autoHeight: true,
		header: 'h2.drawer-handle open',
		//navigation: true, 
		selectedClass: 'open',
		//fillSpace: true, 
		//animated: 'bounceslide',
		event: 'mouseover'
	});
});

/*$(function () { 
// same as 
$(document).ready(function () {
	event: 'mouseover' 
}) 
// assuming we have the open class set on the H2 when the HTML is delivered  
$('LI.drawer H2:not(.open)').next().hide();  
$('H2.drawer-handle').click(function () {    
// find the open drawer, remove the class, move to the UL following it and hide it    
$('H2.open').removeClass('open').next().hide();        
// add the open class to this H2, move to the next element (the UL) and show it    
$(this).addClass('open').next().show();
});
//If you want it to slide, we can easily swap .hide() for .slideUp() and .show() for .slideDown()  
});*/
//-->    
</script>
<STYLE type=text/css media=screen>
.drawers-wrapper {
	POSITION: relative; WIDTH: 188px
}
.drawer {
	LINE-HEIGHT: 1.3em; BACKGROUND: url(images/sideboxlight_bg20070611.gif) repeat-y 0pt 50%; COLOR: #76797c; FONT-SIZE: 11px
}
.boxcap {
	Z-INDEX: 100; POSITION: absolute; MARGIN-TOP: -5px; WIDTH: 100%; BACKGROUND: url(images/sidenav_capbottom.png) no-repeat 0% 50%; HEIGHT: 5px; LEFT: 0pt
}
.captop {
	BACKGROUND-IMAGE: url(images/box_188captop.png); MARGIN-TOP: 0px; BOTTOM: auto; TOP: 0pt
}
.drawers {
	LINE-HEIGHT: 18px; MARGIN-BOTTOM: 15px; COLOR: #76797c; FONT-SIZE: 11px
}
.drawers A {
	FONT-VARIANT: normal; FONT-STYLE: normal; FONT-FAMILY: "Lucida Grande", Geneva, Arial, Verdana, sans-serif; COLOR: #666666; FONT-WEIGHT: normal; TEXT-DECORATION: none; font-size-adjust: none
}
.drawer LI {
	BORDER-BOTTOM: #e5e5e5 1px solid; PADDING-BOTTOM: 6px; LINE-HEIGHT: 16px; PADDING-LEFT: 0pt; PADDING-RIGHT: 0pt; PADDING-TOP: 6px
}
UL {
	PADDING-BOTTOM: 0px; LIST-STYLE-TYPE: none; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; LIST-STYLE-IMAGE: none; PADDING-TOP: 0px
}
UL.drawers {
	MARGIN: 0px
}
.drawer-handle {
	LINE-HEIGHT: 25px;
	TEXT-INDENT: 15;
	WIDTH: 100%;
	MARGIN-BOTTOM: 0pt;
	BACKGROUND: url(images/slider_handlebg188.png) #939393 no-repeat 0pt 50%;
	HEIGHT: 25px;
	COLOR: #333333;
	FONT-SIZE: 12px;
	CURSOR: default;
	FONT-WEIGHT: normal;
}
.open.drawer-handle {
	BACKGROUND-COLOR: #72839d; BACKGROUND-POSITION: -188px 0pt; COLOR: #ffffff
}
.drawer UL {
	PADDING-BOTTOM: 0pt; PADDING-LEFT: 12px; PADDING-RIGHT: 12px; PADDING-TOP: 0px
}
.drawer-content UL {
	PADDING-TOP: 7px
}
.drawer-content LI A {
	DISPLAY: block; OVERFLOW: hidden
}
.alldownloads LI {
}
</STYLE>
<div class=drawers-wrapper>
	<div class="boxcap captop"></div>
    <ul class=drawers>
    <?php do { ?>
      <li class=drawer>
      <h2 class="drawer-handle"><?php echo $row_RecordMultiLeftMenu_l1['itemname']; ?></h2>
          <ul class=alldownloads>
          
            <?php
            ?>
            <li><a href="about.php?Opt=viewpage&navi=<?php echo $_GET['navi']; ?>&lang=<?php echo $_GET['lang']; ?>&mtype=Article&article_id=11">關於我們</a></li>
            <li><a href="about.php?Opt=viewpage&navi=<?php echo $_GET['navi']; ?>&lang=<?php echo $_GET['lang']; ?>&mtype=Article&article_id=12">經營理念</a></li>
<?php
?>
          </ul>
  	  </li>
  <?php } while ($row_RecordMultiLeftMenu_l1 = mysqli_fetch_assoc($RecordMultiLeftMenu_l1)); ?>
</ul>
<div class=boxcap></div>
</div>
<br />

<?php
mysqli_free_result($RecordMultiLeftMenu_l1);
?>
