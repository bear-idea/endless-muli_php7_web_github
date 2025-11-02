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
    GLOBAL $maxRows_RecordTmpBoardShow,$totalRows_RecordTmpBoardShow;
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
					if ($_get_name != "pageNum_RecordTmpBoardShow") {
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
			$firstArray = ($pageNum_Recordset1 > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordTmpBoardShow=$precedente$_get_vars\">$prev_Recordset1</a>" :  "<span>$prev_Recordset1</span>"/*  css */;
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordTmpBoardShow) + 1;
					$max_l = ($a*$maxRows_RecordTmpBoardShow >= $totalRows_RecordTmpBoardShow) ? $totalRows_RecordTmpBoardShow : ($a*$maxRows_RecordTmpBoardShow);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageNum_Recordset1)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordTmpBoardShow=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "<span>"; /* css */
					$pagesArray .= "$textLink</span>"  . ($theNext < $egp-1 ? $separator : "");
				}
			}  
			$theNext = $pageNum_Recordset1+1;
			$offset_end = $totalPages_Recordset1;
			$lastArray = ($pageNum_Recordset1 < $totalPages_Recordset1) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordTmpBoardShow=$successivo$_get_vars\">$next_Recordset1</a>" : "<span>$next_Record1</span>"; /* css */
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form")) {
  $updateSQL = sprintf("UPDATE demo_tmp SET tmptitleboard=%s WHERE id=%s",
                       GetSQLValueString($_POST['TmpBgSelect'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

$maxRows_RecordTmpBoardShow = 10;
$pageNum_RecordTmpBoardShow = 0;
if (isset($_GET['pageNum_RecordTmpBoardShow'])) {
  $pageNum_RecordTmpBoardShow = $_GET['pageNum_RecordTmpBoardShow'];
}
$startRow_RecordTmpBoardShow = $pageNum_RecordTmpBoardShow * $maxRows_RecordTmpBoardShow;

$colname_RecordTmpBoardShow = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordTmpBoardShow = $_GET['searchkey'];
}
$coluserid_RecordTmpBoardShow = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpBoardShow = $w_userid;
}
$coltype_RecordTmpBoardShow = "%";
if (isset($_GET['type'])) {
  $coltype_RecordTmpBoardShow = $_GET['type'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpBoardShow = sprintf("SELECT * FROM demo_tmpboard WHERE ((name LIKE %s)) && (type LIKE %s) && (userid=%s || userid=1) ORDER BY id DESC", GetSQLValueString("%" . $colname_RecordTmpBoardShow . "%", "text"),GetSQLValueString("%" . $coltype_RecordTmpBoardShow . "%", "text"),GetSQLValueString($coluserid_RecordTmpBoardShow, "int"));
$query_limit_RecordTmpBoardShow = sprintf("%s LIMIT %d, %d", $query_RecordTmpBoardShow, $startRow_RecordTmpBoardShow, $maxRows_RecordTmpBoardShow);
$RecordTmpBoardShow = mysqli_query($DB_Conn, $query_limit_RecordTmpBoardShow) or die(mysqli_error($DB_Conn));
$row_RecordTmpBoardShow = mysqli_fetch_assoc($RecordTmpBoardShow);

if (isset($_GET['totalRows_RecordTmpBoardShow'])) {
  $totalRows_RecordTmpBoardShow = $_GET['totalRows_RecordTmpBoardShow'];
} else {
  $all_RecordTmpBoardShow = mysqli_query($DB_Conn, $query_RecordTmpBoardShow);
  $totalRows_RecordTmpBoardShow = mysqli_num_rows($all_RecordTmpBoardShow);
}
$totalPages_RecordTmpBoardShow = ceil($totalRows_RecordTmpBoardShow/$maxRows_RecordTmpBoardShow)-1;

$colid_RecordTmpBoardShowSelect = "-1";
if (isset($_GET['id'])) {
  $colid_RecordTmpBoardShowSelect = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpBoardShowSelect = sprintf("SELECT * FROM demo_tmp WHERE id = %s", GetSQLValueString($colid_RecordTmpBoardShowSelect, "int"));
$RecordTmpBoardShowSelect = mysqli_query($DB_Conn, $query_RecordTmpBoardShowSelect) or die(mysqli_error($DB_Conn));
$row_RecordTmpBoardShowSelect = mysqli_fetch_assoc($RecordTmpBoardShowSelect);
$totalRows_RecordTmpBoardShowSelect = mysqli_num_rows($RecordTmpBoardShowSelect);

$colname_RecordTmpBoardShowStyle = "-1";
if (isset($_GET['id'])) {
  $colname_RecordTmpBoardShowStyle = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpBoardShowStyle = sprintf("SELECT name FROM demo_tmp WHERE id = %s", GetSQLValueString($colname_RecordTmpBoardShowStyle, "int"));
$RecordTmpBoardShowStyle = mysqli_query($DB_Conn, $query_RecordTmpBoardShowStyle) or die(mysqli_error($DB_Conn));
$row_RecordTmpBoardShowStyle = mysqli_fetch_assoc($RecordTmpBoardShowStyle);
$totalRows_RecordTmpBoardShowStyle = mysqli_num_rows($RecordTmpBoardShowStyle);
?>
<style>
.tbutt{float:left; padding:5px; background-color:#666; color:#FFF; margin-right:5px; margin-left:0px; margin-top:0px; margin-bottom:10px}
.div_table-cell{overflow:hidden; height:50px; width:50px; margin:5px}
.div_table-cell{text-align:center; vertical-align:middle; border:1px solid #DDD}
.div_table-cell span{height:100%; display:inline-block; background-image:none; border-top-style:none; border-right-style:none; border-bottom-style:none; border-left-style:none}
.div_table-cell *{vertical-align:middle}

.bg_board:hover{background-color:#E95516}
.bg_active{background-color:#B37583}
.TmpBgSelectIcon{position:absolute; z-index:1; height:65px; width:93px; background-image:url(images/select.png); background-repeat:no-repeat}
.button_a{display:inline-block; border-width:1px 0; border-color:#BBB; border-style:solid; vertical-align:middle; text-decoration:none; color:#333}
.button_b{float:left; background:#e3e3e3; border-width:0 1px; border-color:#BBB; border-style:solid; margin:0 -1px; position:relative}
.button_c{display:block; line-height:0.6em; background:#f9f9f9; border-bottom:2px solid #eee}
.button_d{display:block; padding:0.1em 0.6em; margin-top:-0.6em; cursor:pointer}
.button_a:hover{border-color:#999; text-decoration:none}
.button_a:hover .button_b{border-color:#999; text-decoration:none}
.mdl_show{min-height:1px; _height:1px}
.mdl_show_t{position:relative; font-size:12px}
.mdl_show_t_l, .mdl_show_t_r{position:absolute; top:0px; font-size:1px; overflow:hidden}
.mdl_show_t_l{left:0}
.mdl_show_t_r{right:0; float:right}
.mdl_show_t_m{position:absolute; text-align:left; height:20px; line-height:20px}
.mdl_show_t_m h3{font-size:14px; width:120px}
.mdl_show_t_c{position:relative; text-align:left; overflow:hidden}
.mdl_show_t_c span.a_a{text-decoration:none}
.mdl_show_c{position:relative; overflow:hidden}
.mdl_show_c .mdl_show_m_t, .mdl_show_c .mdl_show_m_c, .mdl_show_c .mdl_show_m_b{padding:0 2px}
.mdl_show_c .mdl_show_m_t, .mdl_show_c .mdl_show_m_b{text-align:left}
.mdl_show_c_l, .mdl_show_c_r{position:absolute; top:0; font-size:1px}
.mdl_show_c_l{left:0}
.mdl_show_c_r{right:0}
.mdl_show_c_c{position:relative; zoom:1}
.mdl_show_b{position:relative; overflow:hidden}
.mdl_show_b_l, .mdl_show_b_r{position:absolute; top:0; font-size:1px}
.mdl_show_b_l{left:0}
.mdl_show_b_r{right:0}
.g_p_fill{padding-bottom:32767px; margin-bottom:-32767px}
.g_p_hide{overflow:hidden; display:block!important; display:inline-block}
.Area_Tag{left:-1px;top:-1px;background-color:#6C6C6C;color:#FFF;padding:2px;-webkit-border-radius:2px;-moz-border-radius:2px;-o-border-radius:2px;border-radius:2px;box-shadow:0 1px 3px rgba(0,0,0,.2);-webkit-box-shadow:0 1px 3px rgba(0,0,0,.2);-moz-box-shadow:0 1px 3px rgba(0,0,0,.2);-o-box-shadow:0 1px 3px rgba(0,0,0,.2);position:absolute;z-index:100;font-size:9px}
.Area_Tag a{color:#FFF}
table.tablesorter tr.even:hover td,table.tablesorter tr:hover td,table.tablesorter tr.odd:hover td { background-color:#FFFFFF;}
</style>
<div class="InnerPage" style="margin-right:8px;"><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt_Tmp=tmpaddboard&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="建立自己的新外框" target="_blank" data-toggle="tooltip" data-placement="right">新增外框</a></div>
<div style="background-color:#999; color:#FFF; text-align:center; padding:5px; cursor:pointer;" class="Acc_Title"><span class="Acc_Change"><i class="fa fa-plus-square"></i></span> 標題區塊 - 內文外框樣式</div>
<div style="padding:0px; margin:0px;" class="Acc_Content">
  <div style="background-color:#FFFFFF; padding:5px; border: 1px solid #CCC; overflow-y:scroll; height:600px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
          <tr>
          	<td align="right"><div class="PageSelectBoard">
          	  <?php 
			# variable declaration
			$prev_RecordTmpBoardShow = "<i class=\"fa fa-angle-left\"></i>";
			$next_RecordTmpBoardShow = "<i class=\"fa fa-angle-right\"></i>";
			$separator = "&nbsp;";
			$max_links = 6;
			$pages_navigation_RecordTmpBoardShow = buildNavigation($pageNum_RecordTmpBoardShow,$totalPages_RecordTmpBoardShow,$prev_RecordTmpBoardShow,$next_RecordTmpBoardShow,$separator,$max_links,true); 
			
			print $pages_navigation_RecordTmpBoardShow[0]; 
			?>
          	  <?php print $pages_navigation_RecordTmpBoardShow[1]; ?> 
          	  <?php print $pages_navigation_RecordTmpBoardShow[2]; ?></div>       	    </td>
          </tr>
         
    </table>

    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter" id="TBSort">
    <tbody>
    
      <tr>    
       <td>
       
	   <div style="padding:5px; border: 1px dotted #CCC; margin-bottom:2px; width:350px;; float:left; margin:5px; text-align:center;" class="<?php if($row_RecordTmpBoardShowSelect['tmptitleboard'] == ''){echo "bg_active";} ?> bg_board"><!--無圖片指定--><a><img src="images/no_bg.jpg" alt="" width="50" height="50" alumb="true" _w="50" _h="50"/></a>
         
            <br />
            <label for="TmpBgSelect">
              
              不使用
            </label>
            <input type="button" name="chang_tmp_none" id="chang_tmp_none" value="預覽" />
           <input type="button" name="use_tmp_none" id="use_tmp_none" value="套用" />
           <input type="button" name="PageRefresh" id="PageRefresh" class="PageRefresh" value="刷新" />
       </div><!--無圖片指定-->
       <script language="javascript" type="text/javascript">
$("#chang_tmp_none").click(function(){     
$.ajax({
		type: "POST",
		url: "sqlgettmp/tmptitleboard_get.php?id=none&tmpid=<?php echo $row_RecordTmp['id']; ?>&<?php echo time();?>",
		success: function(data){
			$(".MiddleBoardStyle").css({"background-image":"none", "background-color":"transparent"});
			if(data == '0') {
			$(".mdmiddle_t_l").css({"background-image":"none", "background-color":"transparent", })
			$(".mdmiddle_t_r").css({"background-image":"none", "background-color":"transparent", })
			$(".mdmiddle_t_c").css({"background-image":"none", "background-color":"transparent", })
			}
			$(".mdmiddle_c_l").css({"background-image":"none", "background-color":"transparent", })
			$(".mdmiddle_c_r").css({"background-image":"none", "background-color":"transparent", })
			$(".mdmiddle_c_c").css({"background-image":"none", "background-color":"transparent", });
			$(".mdmiddle_b_l").css({"background-image":"none", "background-color":"transparent", })
			$(".mdmiddle_b_r").css({"background-image":"none", "background-color":"transparent", })
			$(".mdmiddle_b_c").css({"background-image":"none", "background-color":"transparent", })
			
			//alert("已套用設定項目，您可刷新頁面觀看結果!!"); 
		 }
	  });
});
$("#use_tmp_none").click(function(){     
$.ajax({
		type: "POST",
		url: "sqlgettmp/tmptitleboard_get.php?id=none&Operate=M_Update&tmpid=<?php echo $row_RecordTmp['id']; ?>&<?php echo time();?>",
		success: function(data){
			$(".MiddleBoardStyle").css({"background-image":"none", "background-color":"transparent"});
			if(data == '0') {
			$(".mdmiddle_t_l").css({"background-image":"none", "background-color":"transparent", })
			$(".mdmiddle_t_r").css({"background-image":"none", "background-color":"transparent", })
			$(".mdmiddle_t_c").css({"background-image":"none", "background-color":"transparent", })
			}
			$(".mdmiddle_c_l").css({"background-image":"none", "background-color":"transparent", })
			$(".mdmiddle_c_r").css({"background-image":"none", "background-color":"transparent", })
			$(".mdmiddle_c_c").css({"background-image":"none", "background-color":"transparent", });
			$(".mdmiddle_b_l").css({"background-image":"none", "background-color":"transparent", })
			$(".mdmiddle_b_r").css({"background-image":"none", "background-color":"transparent", })
			$(".mdmiddle_b_c").css({"background-image":"none", "background-color":"transparent", })
			alert("已套用設定項目，您可刷新頁面觀看結果!!"); 
		 }
	  });
});
</script>
       <?php do { ?>
           <div style="padding:5px; border: 1px dotted #CCC; margin-bottom:2px; width:350px; float:left; margin:5px; text-align:center; position:relative;" class="<?php if($row_RecordTmpBoardShowSelect['tmptitleboard'] == $row_RecordTmpBoardShow['id']){echo "bg_active";} ?> bg_board">
           <div class="Area_Tag">#<?php echo $row_RecordTmpBoardShow['id']; ?></div>
             <?php //if ($row_RecordTmpBoardShow['bgimage'] != "") { ?>
           <!--外框樣式-->
           <div class="mdl_show" style=" background-color:<?php echo $row_RecordTmpBoardShow['tmp_w_background_color']; ?>;border:<?php echo $row_RecordTmpBoardShow['tmp_w_board_width']; ?>px <?php echo $row_RecordTmpBoardShow['tmp_w_board_style']; ?> <?php echo $row_RecordTmpBoardShow['tmp_w_board_color']; ?>;background-image: url(upload/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_w_background_img'] ?>);-webkit-border-radius: <?php echo $row_RecordTmpBoardShow['borderradius_t_l']; ?>px <?php echo $row_RecordTmpBoardShow['borderradius_t_r']; ?>px <?php echo $row_RecordTmpBoardShow['borderradius_b_r']; ?>px <?php echo $row_RecordTmpBoardShow['borderradius_b_l']; ?>px;-moz-border-radius: <?php echo $row_RecordTmpBoardShow['borderradius_t_l']; ?>px <?php echo $row_RecordTmpBoardShow['borderradius_t_r']; ?>px <?php echo $row_RecordTmpBoardShow['borderradius_b_r']; ?>px <?php echo $row_RecordTmpBoardShow['borderradius_b_l']; ?>px;border-radius: <?php echo $row_RecordTmpBoardShow['borderradius_t_l']; ?>px <?php echo $row_RecordTmpBoardShow['borderradius_t_r']; ?>px <?php echo $row_RecordTmpBoardShow['borderradius_b_r']; ?>px <?php echo $row_RecordTmpBoardShow['borderradius_b_l']; ?>px;-webkit-box-shadow: <?php echo $row_RecordTmpBoardShow['boxshadow_x']; ?>px <?php echo $row_RecordTmpBoardShow['boxshadow_y']; ?>px <?php echo $row_RecordTmpBoardShow['boxshadow_size']; ?>px <?php echo $row_RecordTmpBoardShow['boxshadow_color']; ?>;-moz-box-shadow: <?php echo $row_RecordTmpBoardShow['boxshadow_x']; ?>px <?php echo $row_RecordTmpBoardShow['boxshadow_y']; ?>px <?php echo $row_RecordTmpBoardShow['boxshadow_size']; ?>px <?php echo $row_RecordTmpBoardShow['boxshadow_color']; ?>;box-shadow: <?php echo $row_RecordTmpBoardShow['boxshadow_x']; ?>px <?php echo $row_RecordTmpBoardShow['boxshadow_y']; ?>px <?php echo $row_RecordTmpBoardShow['boxshadow_size']; ?>px <?php echo $row_RecordTmpBoardShow['boxshadow_color']; ?>;background: -webkit-gradient(linear, 0 0, 0 bottom, from(<?php echo $row_RecordTmpBoardShow['lineargradient_top']; ?>), to(<?php echo $row_RecordTmpBoardShow['lineargradient_bottom']; ?>));background: -webkit-linear-gradient(<?php echo $row_RecordTmpBoardShow['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoardShow['lineargradient_bottom']; ?>);background: -moz-linear-gradient(<?php echo $row_RecordTmpBoardShow['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoardShow['lineargradient_bottom']; ?>);background: -ms-linear-gradient(<?php echo $row_RecordTmpBoardShow['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoardShow['lineargradient_bottom']; ?>);background: -o-linear-gradient(<?php echo $row_RecordTmpBoardShow['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoardShow['lineargradient_bottom']; ?>);background: linear-gradient(<?php echo $row_RecordTmpBoardShow['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoardShow['lineargradient_bottom']; ?>);-pie-background: linear-gradient(<?php echo $row_RecordTmpBoardShow['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoardShow['lineargradient_bottom']; ?>);behavior:url(http://www.shop3500.com/PIE.htc);">
            <div class="mdl_show_t">
                    <div class="mdl_show_t_l" style="background:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoardShow['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_l_t_background_img']; ?>) <?php echo $row_RecordTmpBoardShow['tmp_l_t_repeat']; ?> scroll left top;width:<?php echo $row_RecordTmpBoardShow['tmp_l_t_width']; ?>px;height:<?php echo $row_RecordTmpBoardShow['tmp_l_t_height']; ?>px;"> </div>
                    <div class="mdl_show_t_r" style="background:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoardShow['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_r_t_background_img']; ?>) <?php echo $row_RecordTmpBoardShow['tmp_r_t_repeat']; ?> scroll left top;width:<?php echo $row_RecordTmpBoardShow['tmp_r_t_width']; ?>px;height:<?php echo $row_RecordTmpBoardShow['tmp_r_t_height']; ?>px;"> </div>
                    <div class="mdl_show_t_c" style="background:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoardShow['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_m_t_background_img']; ?>) <?php echo $row_RecordTmpBoardShow['tmp_m_t_repeat']; ?> scroll left top;height:<?php echo $row_RecordTmpBoardShow['tmp_r_t_height']; ?>px;margin:0px <?php echo $row_RecordTmpBoardShow['tmp_r_t_width']; ?>px 0px <?php echo $row_RecordTmpBoardShow['tmp_l_t_width']; ?>px;"><!--標題文字--></div>
                    <div class="mdl_show_t_m"><!--右邊文字--></div>
            </div><!--mdl_show_t-->
            <div class="mdl_show_c g_p_hide">
                    <div class="mdl_show_c_l g_p_fill" style="background:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoardShow['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_l_m_background_img']; ?>) <?php echo $row_RecordTmpBoardShow['tmp_l_m_repeat']; ?> scroll left top;width:<?php echo $row_RecordTmpBoardShow['tmp_l_m_width']; ?>px;"> </div>
                    <div class="mdl_show_c_r g_p_fill" style="background:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoardShow['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_r_m_background_img']; ?>) <?php echo $row_RecordTmpBoardShow['tmp_r_m_repeat']; ?> scroll left top;width:<?php echo $row_RecordTmpBoardShow['tmp_r_m_width']; ?>px;"> </div>
                    <div class="mdl_show_c_c" style="background:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoardShow['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_m_m_background_img']; ?>) <?php echo $row_RecordTmpBoardShow['tmp_m_m_repeat']; ?> scroll left top;margin:0px <?php echo $row_RecordTmpBoardShow['tmp_r_m_width']; ?>px 0px <?php echo $row_RecordTmpBoardShow['tmp_l_m_width']; ?>px;">
                           
                            <div class="mdl_show_m_c" style="width:50px; height:50px;">
                                
                            </div>
                           
                    </div>
            </div><!--mdl_show_c-->
            <div class="mdl_show_b">
                    <div class="mdl_show_b_l" style="background:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoardShow['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_l_b_background_img']; ?>) <?php echo $row_RecordTmpBoardShow['tmp_l_b_repeat']; ?> scroll left top;width:<?php echo $row_RecordTmpBoardShow['tmp_l_b_width']; ?>px;height:<?php echo $row_RecordTmpBoardShow['tmp_l_b_height']; ?>px;"> </div>
                    <div class="mdl_show_b_r" style="background:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoardShow['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_r_b_background_img']; ?>) <?php echo $row_RecordTmpBoardShow['tmp_r_b_repeat']; ?> scroll left top;width:<?php echo $row_RecordTmpBoardShow['tmp_r_b_width']; ?>px;height:<?php echo $row_RecordTmpBoardShow['tmp_r_b_height']; ?>px;"> </div>
                    <div class="mdl_show_b_c" style="background:url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoardShow['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_m_b_background_img']; ?>) <?php echo $row_RecordTmpBoardShow['tmp_m_b_repeat']; ?> scroll left top;height:<?php echo $row_RecordTmpBoardShow['tmp_m_b_height']; ?>px;margin:0px <?php echo $row_RecordTmpBoardShow['tmp_r_b_width']; ?>px 0px <?php echo $row_RecordTmpBoardShow['tmp_l_b_width']; ?>px;"> </div>
            </div><!--mdl_show_b-->
        </div><!--mdl_show-->
           <!--外框樣式 END-->
            <?php //} ?>       
            <br />
            <label for="TmpBgSelect">
              
              <?php echo highLight($row_RecordTmpBoardShow['name'], @$_GET['searchkey'], $HighlightSelect); ?>
          </label>
           <input type="button" name="chang_tmp<?php echo $row_RecordTmpBoardShow['id']; ?>" id="chang_tmp<?php echo $row_RecordTmpBoardShow['id']; ?>" value="預覽" />
           <input type="button" name="use_tmp<?php echo $row_RecordTmpBoardShow['id']; ?>" id="use_tmp<?php echo $row_RecordTmpBoardShow['id']; ?>" value="套用" />
           <input type="button" name="PageRefresh" id="PageRefresh" class="PageRefresh" value="刷新" /> 
           </div>
<script language="javascript" type="text/javascript">
$("#chang_tmp<?php echo $row_RecordTmpBoardShow['id']; ?>").click(function(){     
$.ajax({
		type: "GET",
		url: "sqlgettmp/tmptitleboard_get.php?id=<?php echo $row_RecordTmpBoardShow['id']; ?>&tmpid=<?php echo $row_RecordTmp['id']; ?>&<?php echo time();?>",
		success: function(data){
			$(".MiddleBoardStyle").css({"background-color":"<?php echo $row_RecordTmpBoardShow['tmp_w_background_color']; ?>","border":"<?php echo $row_RecordTmpBoardShow['tmp_w_board_width']; ?>px <?php echo $row_RecordTmpBoardShow['tmp_w_board_style']; ?> <?php echo $row_RecordTmpBoardShow['tmp_w_board_color']; ?>","background-image":"url(upload/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_w_background_img'] ?>)","-webkit-border-radius":"<?php echo $row_RecordTmpBoardShow['borderradius_t_l']; ?>px <?php echo $row_RecordTmpBoardShow['borderradius_t_r']; ?>px <?php echo $row_RecordTmpBoardShow['borderradius_b_r']; ?>px <?php echo $row_RecordTmpBoardShow['borderradius_b_l']; ?>px","-moz-border-radius":"<?php echo $row_RecordTmpBoardShow['borderradius_t_l']; ?>px <?php echo $row_RecordTmpBoardShow['borderradius_t_r']; ?>px <?php echo $row_RecordTmpBoardShow['borderradius_b_r']; ?>px <?php echo $row_RecordTmpBoardShow['borderradius_b_l']; ?>px","border-radius":"<?php echo $row_RecordTmpBoardShow['borderradius_t_l']; ?>px <?php echo $row_RecordTmpBoardShow['borderradius_t_r']; ?>px <?php echo $row_RecordTmpBoardShow['borderradius_b_r']; ?>px <?php echo $row_RecordTmpBoardShow['borderradius_b_l']; ?>px","-webkit-box-shadow":"<?php echo $row_RecordTmpBoardShow['boxshadow_x']; ?>px <?php echo $row_RecordTmpBoardShow['boxshadow_y']; ?>px <?php echo $row_RecordTmpBoardShow['boxshadow_size']; ?>px <?php echo $row_RecordTmpBoardShow['boxshadow_color']; ?>","-moz-box-shadow":"<?php echo $row_RecordTmpBoardShow['boxshadow_x']; ?>px <?php echo $row_RecordTmpBoardShow['boxshadow_y']; ?>px <?php echo $row_RecordTmpBoardShow['boxshadow_size']; ?>px <?php echo $row_RecordTmpBoardShow['boxshadow_color']; ?>","box-shadow":"<?php echo $row_RecordTmpBoardShow['boxshadow_x']; ?>px <?php echo $row_RecordTmpBoardShow['boxshadow_y']; ?>px <?php echo $row_RecordTmpBoardShow['boxshadow_size']; ?>px <?php echo $row_RecordTmpBoardShow['boxshadow_color']; ?>","background":"-webkit-gradient(linear, 0 0, 0 bottom, from(<?php echo $row_RecordTmpBoardShow['lineargradient_top']; ?>), to(<?php echo $row_RecordTmpBoardShow['lineargradient_bottom']; ?>))","background":"-webkit-linear-gradient(<?php echo $row_RecordTmpBoardShow['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoardShow['lineargradient_bottom']; ?>)","background":"-moz-linear-gradient(<?php echo $row_RecordTmpBoardShow['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoardShow['lineargradient_bottom']; ?>)","background":"-ms-linear-gradient(<?php echo $row_RecordTmpBoardShow['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoardShow['lineargradient_bottom']; ?>)","background":"-o-linear-gradient(<?php echo $row_RecordTmpBoardShow['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoardShow['lineargradient_bottom']; ?>)","background":"linear-gradient(<?php echo $row_RecordTmpBoardShow['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoardShow['lineargradient_bottom']; ?>)","-pie-background":"linear-gradient(<?php echo $row_RecordTmpBoardShow['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoardShow['lineargradient_bottom']; ?>)", "behavior": "url(http://easy.fullvision.net/PIE.htc)"});
	if(data == '0') {
	$(".mdmiddle_t_l").css({"background":"url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoardShow['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_l_t_background_img']; ?>) <?php echo $row_RecordTmpBoardShow['tmp_l_t_repeat']; ?> scroll left top","width":"<?php echo $row_RecordTmpBoardShow['tmp_l_t_width']; ?>px","height":"<?php echo $row_RecordTmpBoardShow['tmp_l_t_height']; ?>px"});
	$(".mdmiddle_t_r").css({"background":"url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoardShow['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_r_t_background_img']; ?>) <?php echo $row_RecordTmpBoardShow['tmp_r_t_repeat']; ?> scroll left top","width":"<?php echo $row_RecordTmpBoardShow['tmp_r_t_width']; ?>px","height":"<?php echo $row_RecordTmpBoardShow['tmp_r_t_height']; ?>px"});
	$(".mdmiddle_t_c").css({"background":"url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoardShow['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_m_t_background_img']; ?>) <?php echo $row_RecordTmpBoardShow['tmp_m_t_repeat']; ?> scroll left top","height":"<?php echo $row_RecordTmpBoardShow['tmp_r_t_height']; ?>px","margin":"0px <?php echo $row_RecordTmpBoardShow['tmp_r_t_width']; ?>px 0px <?php echo $row_RecordTmpBoardShow['tmp_l_t_width']; ?>px"});
	} 
	$(".mdmiddle_c_l").css({"background":"url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoardShow['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_l_m_background_img']; ?>) <?php echo $row_RecordTmpBoardShow['tmp_l_m_repeat']; ?> scroll left top","width":"<?php echo $row_RecordTmpBoardShow['tmp_l_m_width']; ?>px"});
	$(".mdmiddle_c_r").css({"background":"url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoardShow['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_r_m_background_img']; ?>) <?php echo $row_RecordTmpBoardShow['tmp_r_m_repeat']; ?> scroll left top","width":"<?php echo $row_RecordTmpBoardShow['tmp_r_m_width']; ?>px"});
	$(".mdmiddle_c_c").css({"background":"url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoardShow['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_m_m_background_img']; ?>) <?php echo $row_RecordTmpBoardShow['tmp_m_m_repeat']; ?> scroll left top","margin":"0px <?php echo $row_RecordTmpBoardShow['tmp_r_m_width']; ?>px 0px <?php echo $row_RecordTmpBoardShow['tmp_l_m_width']; ?>px"});
	$(".mdmiddle_b_l").css({"background":"url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoardShow['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_l_b_background_img']; ?>) <?php echo $row_RecordTmpBoardShow['tmp_l_b_repeat']; ?> scroll left top","width":"<?php echo $row_RecordTmpBoardShow['tmp_l_b_width']; ?>px","height":"<?php echo $row_RecordTmpBoardShow['tmp_l_b_height']; ?>px"});
	$(".mdmiddle_b_r").css({"background":"url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoardShow['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_r_b_background_img']; ?>) <?php echo $row_RecordTmpBoardShow['tmp_r_b_repeat']; ?> scroll left top","width":"<?php echo $row_RecordTmpBoardShow['tmp_r_b_width']; ?>px","height":"<?php echo $row_RecordTmpBoardShow['tmp_r_b_height']; ?>px"});
	$(".mdmiddle_b_c").css({"background":"url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoardShow['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_m_b_background_img']; ?>) <?php echo $row_RecordTmpBoardShow['tmp_m_b_repeat']; ?> scroll left top","height":"<?php echo $row_RecordTmpBoardShow['tmp_m_b_height']; ?>px","margin":"0px <?php echo $row_RecordTmpBoardShow['tmp_r_b_width']; ?>px 0px <?php echo $row_RecordTmpBoardShow['tmp_l_b_width']; ?>px"});
			//alert("已套用設定項目，您可刷新頁面觀看結果!!");
			//alert(data);  
		 }
	  });
});
$("#use_tmp<?php echo $row_RecordTmpBoardShow['id']; ?>").click(function(){     
$.ajax({
		type: "POST",
		url: "sqlgettmp/tmptitleboard_get.php?id=<?php echo $row_RecordTmpBoardShow['id']; ?>&Operate=M_Update&tmpid=<?php echo $row_RecordTmp['id']; ?>&<?php echo time();?>",
		success: function(data){
			$(".MiddleBoardStyle").css({"background-color":"<?php echo $row_RecordTmpBoardShow['tmp_w_background_color']; ?>","border":"<?php echo $row_RecordTmpBoardShow['tmp_w_board_width']; ?>px <?php echo $row_RecordTmpBoardShow['tmp_w_board_style']; ?> <?php echo $row_RecordTmpBoardShow['tmp_w_board_color']; ?>","background-image":"url(upload/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_w_background_img'] ?>)","-webkit-border-radius":"<?php echo $row_RecordTmpBoardShow['borderradius_t_l']; ?>px <?php echo $row_RecordTmpBoardShow['borderradius_t_r']; ?>px <?php echo $row_RecordTmpBoardShow['borderradius_b_r']; ?>px <?php echo $row_RecordTmpBoardShow['borderradius_b_l']; ?>px","-moz-border-radius":"<?php echo $row_RecordTmpBoardShow['borderradius_t_l']; ?>px <?php echo $row_RecordTmpBoardShow['borderradius_t_r']; ?>px <?php echo $row_RecordTmpBoardShow['borderradius_b_r']; ?>px <?php echo $row_RecordTmpBoardShow['borderradius_b_l']; ?>px","border-radius":"<?php echo $row_RecordTmpBoardShow['borderradius_t_l']; ?>px <?php echo $row_RecordTmpBoardShow['borderradius_t_r']; ?>px <?php echo $row_RecordTmpBoardShow['borderradius_b_r']; ?>px <?php echo $row_RecordTmpBoardShow['borderradius_b_l']; ?>px","-webkit-box-shadow":"<?php echo $row_RecordTmpBoardShow['boxshadow_x']; ?>px <?php echo $row_RecordTmpBoardShow['boxshadow_y']; ?>px <?php echo $row_RecordTmpBoardShow['boxshadow_size']; ?>px <?php echo $row_RecordTmpBoardShow['boxshadow_color']; ?>","-moz-box-shadow":"<?php echo $row_RecordTmpBoardShow['boxshadow_x']; ?>px <?php echo $row_RecordTmpBoardShow['boxshadow_y']; ?>px <?php echo $row_RecordTmpBoardShow['boxshadow_size']; ?>px <?php echo $row_RecordTmpBoardShow['boxshadow_color']; ?>","box-shadow":"<?php echo $row_RecordTmpBoardShow['boxshadow_x']; ?>px <?php echo $row_RecordTmpBoardShow['boxshadow_y']; ?>px <?php echo $row_RecordTmpBoardShow['boxshadow_size']; ?>px <?php echo $row_RecordTmpBoardShow['boxshadow_color']; ?>","background":"-webkit-gradient(linear, 0 0, 0 bottom, from(<?php echo $row_RecordTmpBoardShow['lineargradient_top']; ?>), to(<?php echo $row_RecordTmpBoardShow['lineargradient_bottom']; ?>))","background":"-webkit-linear-gradient(<?php echo $row_RecordTmpBoardShow['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoardShow['lineargradient_bottom']; ?>)","background":"-moz-linear-gradient(<?php echo $row_RecordTmpBoardShow['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoardShow['lineargradient_bottom']; ?>)","background":"-ms-linear-gradient(<?php echo $row_RecordTmpBoardShow['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoardShow['lineargradient_bottom']; ?>)","background":"-o-linear-gradient(<?php echo $row_RecordTmpBoardShow['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoardShow['lineargradient_bottom']; ?>)","background":"linear-gradient(<?php echo $row_RecordTmpBoardShow['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoardShow['lineargradient_bottom']; ?>)","-pie-background":"linear-gradient(<?php echo $row_RecordTmpBoardShow['lineargradient_top']; ?>, <?php echo $row_RecordTmpBoardShow['lineargradient_bottom']; ?>)", "behavior": "url(http://easy.fullvision.net/PIE.htc)"});
	if(data == '0') {
	$(".mdmiddle_t_l").css({"background":"url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoardShow['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_l_t_background_img']; ?>) <?php echo $row_RecordTmpBoardShow['tmp_l_t_repeat']; ?> scroll left top","width":"<?php echo $row_RecordTmpBoardShow['tmp_l_t_width']; ?>px","height":"<?php echo $row_RecordTmpBoardShow['tmp_l_t_height']; ?>px"});
	$(".mdmiddle_t_r").css({"background":"url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoardShow['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_r_t_background_img']; ?>) <?php echo $row_RecordTmpBoardShow['tmp_r_t_repeat']; ?> scroll left top","width":"<?php echo $row_RecordTmpBoardShow['tmp_r_t_width']; ?>px","height":"<?php echo $row_RecordTmpBoardShow['tmp_r_t_height']; ?>px"});
	$(".mdmiddle_t_c").css({"background":"url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoardShow['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_m_t_background_img']; ?>) <?php echo $row_RecordTmpBoardShow['tmp_m_t_repeat']; ?> scroll left top","height":"<?php echo $row_RecordTmpBoardShow['tmp_r_t_height']; ?>px","margin":"0px <?php echo $row_RecordTmpBoardShow['tmp_r_t_width']; ?>px 0px <?php echo $row_RecordTmpBoardShow['tmp_l_t_width']; ?>px"});
	}
	$(".mdmiddle_c_l").css({"background":"url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoardShow['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_l_m_background_img']; ?>) <?php echo $row_RecordTmpBoardShow['tmp_l_m_repeat']; ?> scroll left top","width":"<?php echo $row_RecordTmpBoardShow['tmp_l_m_width']; ?>px"});
	$(".mdmiddle_c_r").css({"background":"url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoardShow['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_r_m_background_img']; ?>) <?php echo $row_RecordTmpBoardShow['tmp_r_m_repeat']; ?> scroll left top","width":"<?php echo $row_RecordTmpBoardShow['tmp_r_m_width']; ?>px"});
	$(".mdmiddle_c_c").css({"background":"url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoardShow['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_m_m_background_img']; ?>) <?php echo $row_RecordTmpBoardShow['tmp_m_m_repeat']; ?> scroll left top","margin":"0px <?php echo $row_RecordTmpBoardShow['tmp_r_m_width']; ?>px 0px <?php echo $row_RecordTmpBoardShow['tmp_l_m_width']; ?>px"});
	$(".mdmiddle_b_l").css({"background":"url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoardShow['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_l_b_background_img']; ?>) <?php echo $row_RecordTmpBoardShow['tmp_l_b_repeat']; ?> scroll left top","width":"<?php echo $row_RecordTmpBoardShow['tmp_l_b_width']; ?>px","height":"<?php echo $row_RecordTmpBoardShow['tmp_l_b_height']; ?>px"});
	$(".mdmiddle_b_r").css({"background":"url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoardShow['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_r_b_background_img']; ?>) <?php echo $row_RecordTmpBoardShow['tmp_r_b_repeat']; ?> scroll left top","width":"<?php echo $row_RecordTmpBoardShow['tmp_r_b_width']; ?>px","height":"<?php echo $row_RecordTmpBoardShow['tmp_r_b_height']; ?>px"});
	$(".mdmiddle_b_c").css({"background":"url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBoardShow['webname']; ?>/image/tmpboard/<?php echo $row_RecordTmpBoardShow['tmp_m_b_background_img']; ?>) <?php echo $row_RecordTmpBoardShow['tmp_m_b_repeat']; ?> scroll left top","height":"<?php echo $row_RecordTmpBoardShow['tmp_m_b_height']; ?>px","margin":"0px <?php echo $row_RecordTmpBoardShow['tmp_r_b_width']; ?>px 0px <?php echo $row_RecordTmpBoardShow['tmp_l_b_width']; ?>px"});
			alert("已套用設定項目，您可刷新頁面觀看結果!!"); 
		 }
	  });
});
</script> 
<?php } while ($row_RecordTmpBoardShow = mysqli_fetch_assoc($RecordTmpBoardShow)); ?>

       </td>
       </tr>
     
     
      </tbody>
    
       

</table>
    
    
  </div>
</div>
<script type="text/javascript">
/* 圖片(不)完全按比例自動縮圖 */
jQuery(document).ready(function(){$(window).load(function(){$(".div_table-cell img").each(function(){if("true"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");var c=$(this).width(),d=$(this).height(),a=$(this).attr("_w")/c,b=$(this).attr("_h")/d,e=1,e=a>b?b:a;$(this).width(c*e);$(this).height(d*e)}else if("false"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");$(this).width();$(this).height();c=$(this).attr("_w");d=$(this).attr("_h");
a=$(this).width();b=$(this).height();if(a>c){var e=a,f=b,b=b*(c/a),a=c;b<d&&(a=e*(d/f),b=d)}$(this).attr({width:a,height:b})}})})});
</script>
</body>
</html>
<?php
mysqli_free_result($RecordTmpBoardShow);

mysqli_free_result($RecordTmpBoardShowSelect);

mysqli_free_result($RecordTmpBoardShowStyle);
?>