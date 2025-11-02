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
    GLOBAL $maxRows_RecordTmpMainMenuShow,$totalRows_RecordTmpMainMenuShow;
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
					if ($_get_name != "pageNum_RecordTmpMainMenuShow") {
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
			$firstArray = ($pageNum_Recordset1 > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordTmpMainMenuShow=$precedente$_get_vars\">$prev_Recordset1</a>" :  "<span>$prev_Recordset1</span>"/*  css */;
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordTmpMainMenuShow) + 1;
					$max_l = ($a*$maxRows_RecordTmpMainMenuShow >= $totalRows_RecordTmpMainMenuShow) ? $totalRows_RecordTmpMainMenuShow : ($a*$maxRows_RecordTmpMainMenuShow);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageNum_Recordset1)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordTmpMainMenuShow=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "<span>"; /* css */
					$pagesArray .= "$textLink</span>"  . ($theNext < $egp-1 ? $separator : "");
				}
			}  
			$theNext = $pageNum_Recordset1+1;
			$offset_end = $totalPages_Recordset1;
			$lastArray = ($pageNum_Recordset1 < $totalPages_Recordset1) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordTmpMainMenuShow=$successivo$_get_vars\">$next_Recordset1</a>" : "<span>$next_Record1</span>"; /* css */
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

$maxRows_RecordTmpMainMenuShow = 10;
$pageNum_RecordTmpMainMenuShow = 0;
if (isset($_GET['pageNum_RecordTmpMainMenuShow'])) {
  $pageNum_RecordTmpMainMenuShow = $_GET['pageNum_RecordTmpMainMenuShow'];
}
$startRow_RecordTmpMainMenuShow = $pageNum_RecordTmpMainMenuShow * $maxRows_RecordTmpMainMenuShow;

$colname_RecordTmpMainMenuShow = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordTmpMainMenuShow = $_GET['searchkey'];
}
$coluserid_RecordTmpMainMenuShow = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpMainMenuShow = $w_userid;
}
$coltype_RecordTmpMainMenuShow = "%";
if (isset($_GET['type'])) {
  $coltype_RecordTmpMainMenuShow = $_GET['type'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpMainMenuShow = sprintf("SELECT * FROM demo_tmpmainmenu WHERE ((name LIKE %s)) && (type LIKE %s) && (userid=%s || userid=1) ORDER BY id DESC", GetSQLValueString("%" . $colname_RecordTmpMainMenuShow . "%", "text"),GetSQLValueString("%" . $coltype_RecordTmpMainMenuShow . "%", "text"),GetSQLValueString($coluserid_RecordTmpMainMenuShow, "int"));
$query_limit_RecordTmpMainMenuShow = sprintf("%s LIMIT %d, %d", $query_RecordTmpMainMenuShow, $startRow_RecordTmpMainMenuShow, $maxRows_RecordTmpMainMenuShow);
$RecordTmpMainMenuShow = mysqli_query($DB_Conn, $query_limit_RecordTmpMainMenuShow) or die(mysqli_error($DB_Conn));
$row_RecordTmpMainMenuShow = mysqli_fetch_assoc($RecordTmpMainMenuShow);

if (isset($_GET['totalRows_RecordTmpMainMenuShow'])) {
  $totalRows_RecordTmpMainMenuShow = $_GET['totalRows_RecordTmpMainMenuShow'];
} else {
  $all_RecordTmpMainMenuShow = mysqli_query($DB_Conn, $query_RecordTmpMainMenuShow);
  $totalRows_RecordTmpMainMenuShow = mysqli_num_rows($all_RecordTmpMainMenuShow);
}
$totalPages_RecordTmpMainMenuShow = ceil($totalRows_RecordTmpMainMenuShow/$maxRows_RecordTmpMainMenuShow)-1;

$colid_RecordTmpMainMenuSelect = "-1";
if (isset($_GET['id'])) {
  $colid_RecordTmpMainMenuSelect = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpMainMenuSelect = sprintf("SELECT * FROM demo_tmp WHERE id = %s", GetSQLValueString($colid_RecordTmpMainMenuSelect, "int"));
$RecordTmpMainMenuSelect = mysqli_query($DB_Conn, $query_RecordTmpMainMenuSelect) or die(mysqli_error($DB_Conn));
$row_RecordTmpMainMenuSelect = mysqli_fetch_assoc($RecordTmpMainMenuSelect);
$totalRows_RecordTmpMainMenuSelect = mysqli_num_rows($RecordTmpMainMenuSelect);

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpMainMenuListType = "SELECT * FROM demo_tmpitem WHERE list_id = 5";
$RecordTmpMainMenuListType = mysqli_query($DB_Conn, $query_RecordTmpMainMenuListType) or die(mysqli_error($DB_Conn));
$row_RecordTmpMainMenuListType = mysqli_fetch_assoc($RecordTmpMainMenuListType);
$totalRows_RecordTmpMainMenuListType = mysqli_num_rows($RecordTmpMainMenuListType);

$colname_RecordTmpBoardStyle = "-1";
if (isset($_GET['id'])) {
  $colname_RecordTmpBoardStyle = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpBoardStyle = sprintf("SELECT name FROM demo_tmp WHERE id = %s", GetSQLValueString($colname_RecordTmpBoardStyle, "int"));
$RecordTmpBoardStyle = mysqli_query($DB_Conn, $query_RecordTmpBoardStyle) or die(mysqli_error($DB_Conn));
$row_RecordTmpBoardStyle = mysqli_fetch_assoc($RecordTmpBoardStyle);
$totalRows_RecordTmpBoardStyle = mysqli_num_rows($RecordTmpBoardStyle);
?>
<style>
.show_mainmenu_board{ width:50px; height:50px; overflow:hidden; border:1px #CCCCCC solid; margin:5px; background-image:url(images/ap_p_u.jpg);}
.show_mainmenu_board img{float:right}
.bg_board:hover{background-color: #E95516;}
.bg_active{background-color: #B37583;}
.Area_Tag{left:-1px;top:-1px;background-color:#6C6C6C;color:#FFF;padding:2px;-webkit-border-radius:2px;-moz-border-radius:2px;-o-border-radius:2px;border-radius:2px;box-shadow:0 1px 3px rgba(0,0,0,.2);-webkit-box-shadow:0 1px 3px rgba(0,0,0,.2);-moz-box-shadow:0 1px 3px rgba(0,0,0,.2);-o-box-shadow:0 1px 3px rgba(0,0,0,.2);position:absolute;z-index:100;font-size:9px}
.Area_Tag a{color:#FFF}
table.tablesorter tr.even:hover td,table.tablesorter tr:hover td,table.tablesorter tr.odd:hover td{background-color:#FFF}
</style>
<?php //$startTime = getMicroTime(); //页面开头定义：?>
<div class="InnerPage" style="margin-right:8px;"><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt_Tmp=tmpaddmainmenu&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="建立自己的新主選單" target="_blank" data-toggle="tooltip" data-placement="right">新增主選單</a></div>
<div style="background-color:#999; color:#FFF; text-align:center; padding:5px; cursor:pointer;" class="Acc_Title"><span class="Acc_Change"><i class="fa fa-plus-square"></i></span> 主選單</div>
<div style="padding:0px; margin:0px;" class="Acc_Content">
  <div style="background-color:#FFFFFF; padding:5px; border: 1px solid #CCC; overflow-y:scroll; height:500px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
          <tr>
          	<td align="right"><div class="PageSelectBoard">
          	  <?php 
			# variable declaration
			$prev_RecordTmpMainMenuShow = "<i class=\"fa fa-angle-left\"></i>";
			$next_RecordTmpMainMenuShow = "<i class=\"fa fa-angle-right\"></i>";
			$separator = "&nbsp;";
			$max_links = 6;
			$pages_navigation_RecordTmpMainMenuShow = buildNavigation($pageNum_RecordTmpMainMenuShow,$totalPages_RecordTmpMainMenuShow,$prev_RecordTmpMainMenuShow,$next_RecordTmpMainMenuShow,$separator,$max_links,true); 
			
			print $pages_navigation_RecordTmpMainMenuShow[0]; 
			?>
          	  <?php print $pages_navigation_RecordTmpMainMenuShow[1]; ?> 
          	  <?php print $pages_navigation_RecordTmpMainMenuShow[2]; ?></div>       	    </td>
          </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter" id="TBSort">
    <tbody>
    
      <tr>    
       <td>
       <?php $i=0; ?>
       <?php do { ?>
           <div style="padding:5px; position:relative; border: 1px dotted #CCC; margin-bottom:2px; width:350px; float:left; margin:5px; text-align:center;" class="<?php if($row_RecordTmpMainMenuSelect['tmpmainmenu'] == $row_RecordTmpMainMenuShow['id']){echo "bg_active";} ?> bg_board">
           <div class="Area_Tag">#<?php echo $row_RecordTmpMainMenuShow['id']; ?></div>
             <div class="show_mainmenu_board">
               <?php if ($row_RecordTmpMainMenuShow['tmp_mainmenu_o_img'] != "" ) { ?>
               <img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpMainMenuShow['webname']; ?>/image/tmpmainmenu/<?php echo $row_RecordTmpMainMenuShow['tmp_mainmenu_o_img']; ?>" alumb="false" _w="50" _h="50"/><span></span>
               <?php } else if($row_RecordTmpMainMenuShow['tmp_mainmenu_hover_img'] != "" ) { ?>
               <img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpMainMenuShow['webname']; ?>/image/tmpmainmenu/<?php echo $row_RecordTmpMainMenuShow['tmp_mainmenu_hover_img']; ?>" alumb="false" _w="50" _h="50"/><span></span>
               <?php } else { ?>
               <img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpMainMenuShow['webname']; ?>/image/tmpmainmenu/<?php echo $row_RecordTmpMainMenuShow['tmp_mainmenu_img']; ?>" alumb="false" _w="50" _h="50"/><span></span>
               <?php } ?>  
             </div>
		   <label for="TmpBgSelect">
		     
		     <?php echo highLight($row_RecordTmpMainMenuShow['name'], @$_GET['searchkey'], $HighlightSelect); ?>
			<input name="ajaxid<?php echo $row_RecordTmpMainMenuShow['id']; ?>" type="hidden" id="ajaxid<?php echo $row_RecordTmpMainMenuShow['id']; ?>" value="<?php echo $row_RecordTmpMainMenuShow['id']; ?>" />
          </label>
           
           <input type="button" name="chang_tmp<?php echo $row_RecordTmpMainMenuShow['id']; ?>" id="chang_tmp<?php echo $row_RecordTmpMainMenuShow['id']; ?>" value="預覽" />
           <input type="button" name="use_tmp<?php echo $row_RecordTmpMainMenuShow['id']; ?>" id="use_tmp<?php echo $row_RecordTmpMainMenuShow['id']; ?>" value="套用" />
           <input type="button" name="PageRefresh" id="PageRefresh" class="PageRefresh" value="刷新" />
           <?php if ($row_RecordTmpMainMenuShow['tmp_mainmenu_location'] == '1') { ?>
           <br /><span style="color:#F00; font-size:9px;">*此項目不支援選單位移調整</span>
           <?php } ?>
<script language="javascript" type="text/javascript">
$("#chang_tmp<?php echo $row_RecordTmpMainMenuShow['id']; ?>").click(function(){     
$.ajax({
		type: "POST",
		url: "sqlgettmp/mainmenu_get.php?id=<?php echo $row_RecordTmpMainMenuShow['id']; ?>&userid=<?php echo $w_userid; ?>&TmpDftMenu_Y=<?php echo $TmpDftMenu_Y; ?>&TmpDftMenu_X=<?php echo $TmpDftMenu_X; ?>&TmpPicMenu_X=<?php echo $TmpPicMenu_X; ?>&TmpPicMenu_Y=<?php echo $TmpPicMenu_Y; ?>&TmpW=<?php echo ($TmpWebWidth+$Tmp_Wrp_R_M_Width+$Tmp_Wrp_L_M_Width).$TmpWebWidthUnit; ?>",
		success: function(data){
			<?php if ($row_RecordTmpMainMenuShow['tmp_mainmenu_location'] == '0') { ?>
			$('#ajax_mainmenu_location0').html(data); 
			$('#ajax_mainmenu_location1').html("");  
			$("#ajax_mainmenu_location1").css({"height":"0px", "margin-top":"0px"});
			<?php } ?>
			<?php if ($row_RecordTmpMainMenuShow['tmp_mainmenu_location'] == '1') { ?>
			$('#ajax_mainmenu_location1').html(data);  
			$('#ajax_mainmenu_location0').html("");
			$("#ajax_mainmenu_location1").css({"height":"<?php echo $row_RecordTmpMainMenuShow['tmp_mainmenupic_height']; ?>px"});  
			<?php } ?>
			//alert(data); 
		 }
	  });
});
$("#use_tmp<?php echo $row_RecordTmpMainMenuShow['id']; ?>").click(function(){     
$.ajax({
		type: "GET",
		url: "sqlgettmp/mainmenu_get.php?id=<?php echo $row_RecordTmpMainMenuShow['id']; ?>&userid=<?php echo $w_userid; ?>&TmpDftMenu_Y=<?php echo $TmpDftMenu_Y; ?>&TmpDftMenu_X=<?php echo $TmpDftMenu_X; ?>&TmpPicMenu_X=<?php echo $TmpPicMenu_X; ?>&TmpPicMenu_Y=<?php echo $TmpPicMenu_Y; ?>&Operate=M_Update&TmpW=<?php echo ($TmpWebWidth+$Tmp_Wrp_R_M_Width+$Tmp_Wrp_L_M_Width).$TmpWebWidthUnit; ?>&tmpid=<?php echo $row_RecordTmp['id']; ?>&<?php echo time();?>",
		success: function(data){
			<?php if ($row_RecordTmpMainMenuShow['tmp_mainmenu_location'] == '0') { ?>
			$('#ajax_mainmenu_location0').html(data); 
			$('#ajax_mainmenu_location1').html("");  
			$("#ajax_mainmenu_location1").css({"height":"0px", "margin-top":"0px"});
			<?php } ?>
			<?php if ($row_RecordTmpMainMenuShow['tmp_mainmenu_location'] == '1') { ?>
			$('#ajax_mainmenu_location1').html(data);  
			$('#ajax_mainmenu_location0').html("");
			$("#ajax_mainmenu_location1").css({"height":"<?php echo $row_RecordTmpMainMenuShow['tmp_mainmenupic_height']; ?>px"});  
			<?php } ?>
			alert("已套用設定項目，您可刷新頁面觀看結果!!"); 
		 }
	  });
});
</script> 
           
           </div>
           <?php $i++; ?>
<?php } while ($row_RecordTmpMainMenuShow = mysqli_fetch_assoc($RecordTmpMainMenuShow)); ?>
       </td>
       </tr>
     
     
      </tbody>
    
       <tfoot>
      </tfoot>

</table>
    
    
  </div>
</div>
<?php
mysqli_free_result($RecordTmpMainMenuShow);

mysqli_free_result($RecordTmpMainMenuSelect);

mysqli_free_result($RecordTmpMainMenuListType);

mysqli_free_result($RecordTmpBoardStyle);
?>