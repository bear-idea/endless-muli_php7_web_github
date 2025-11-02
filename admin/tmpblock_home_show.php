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
    GLOBAL $maxRows_RecordTmpBlock,$totalRows_RecordTmpBlock;
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
					if ($_get_name != "pageNum_RecordTmpBlock") {
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
			$firstArray = ($pageNum_Recordset1 > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordTmpBlock=$precedente$_get_vars\">$prev_Recordset1</a>" :  "<span>$prev_Recordset1</span>"/*  css */;
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordTmpBlock) + 1;
					$max_l = ($a*$maxRows_RecordTmpBlock >= $totalRows_RecordTmpBlock) ? $totalRows_RecordTmpBlock : ($a*$maxRows_RecordTmpBlock);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageNum_Recordset1)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordTmpBlock=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "<span>"; /* css */
					$pagesArray .= "$textLink</span>"  . ($theNext < $egp-1 ? $separator : "");
				}
			}  
			$theNext = $pageNum_Recordset1+1;
			$offset_end = $totalPages_Recordset1;
			$lastArray = ($pageNum_Recordset1 < $totalPages_Recordset1) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordTmpBlock=$successivo$_get_vars\">$next_Recordset1</a>" : "<span>$next_Record1</span>"; /* css */
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
  $updateSQL = sprintf("UPDATE demo_tmp SET tmpblock=%s WHERE id=%s",
                       GetSQLValueString($_POST['TmpBgSelect'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

$maxRows_RecordTmpBlock = 50;
$pageNum_RecordTmpBlock = 0;
if (isset($_GET['pageNum_RecordTmpBlock'])) {
  $pageNum_RecordTmpBlock = $_GET['pageNum_RecordTmpBlock'];
}
$startRow_RecordTmpBlock = $pageNum_RecordTmpBlock * $maxRows_RecordTmpBlock;

$colname_RecordTmpBlock = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordTmpBlock = $_GET['searchkey'];
}
$coluserid_RecordTmpBlock = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpBlock = $w_userid;
}
$coltype_RecordTmpBlock = "%";
if (isset($_GET['type'])) {
  $coltype_RecordTmpBlock = $_GET['type'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpBlock = sprintf("SELECT * FROM demo_tmpblock WHERE ((name LIKE %s)) && (type LIKE %s) && (userid=%s || userid=1) ORDER BY id DESC", GetSQLValueString("%" . $colname_RecordTmpBlock . "%", "text"),GetSQLValueString("%" . $coltype_RecordTmpBlock . "%", "text"),GetSQLValueString($coluserid_RecordTmpBlock, "int"));
$query_limit_RecordTmpBlock = sprintf("%s LIMIT %d, %d", $query_RecordTmpBlock, $startRow_RecordTmpBlock, $maxRows_RecordTmpBlock);
$RecordTmpBlock = mysqli_query($DB_Conn, $query_limit_RecordTmpBlock) or die(mysqli_error($DB_Conn));
$row_RecordTmpBlock = mysqli_fetch_assoc($RecordTmpBlock);

if (isset($_GET['totalRows_RecordTmpBlock'])) {
  $totalRows_RecordTmpBlock = $_GET['totalRows_RecordTmpBlock'];
} else {
  $all_RecordTmpBlock = mysqli_query($DB_Conn, $query_RecordTmpBlock);
  $totalRows_RecordTmpBlock = mysqli_num_rows($all_RecordTmpBlock);
}
$totalPages_RecordTmpBlock = ceil($totalRows_RecordTmpBlock/$maxRows_RecordTmpBlock)-1;

$colid_RecordTmpBlockSelect = "-1";
if (isset($_GET['id'])) {
  $colid_RecordTmpBlockSelect = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpBlockSelect = sprintf("SELECT * FROM demo_tmp WHERE id = %s", GetSQLValueString($colid_RecordTmpBlockSelect, "int"));
$RecordTmpBlockSelect = mysqli_query($DB_Conn, $query_RecordTmpBlockSelect) or die(mysqli_error($DB_Conn));
$row_RecordTmpBlockSelect = mysqli_fetch_assoc($RecordTmpBlockSelect);
$totalRows_RecordTmpBlockSelect = mysqli_num_rows($RecordTmpBlockSelect);

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpBlockListType = "SELECT * FROM demo_tmpitem WHERE list_id = 7";
$RecordTmpBlockListType = mysqli_query($DB_Conn, $query_RecordTmpBlockListType) or die(mysqli_error($DB_Conn));
$row_RecordTmpBlockListType = mysqli_fetch_assoc($RecordTmpBlockListType);
$totalRows_RecordTmpBlockListType = mysqli_num_rows($RecordTmpBlockListType);

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
.tbutt{float:left;background-color:#666;color:#FFF;margin:0 5px 10px 0;padding:5px}
.div_table-cell{overflow:hidden;height:50px;width:50px;margin:5px}
.div_table-cell{text-align:center;vertical-align:middle;border:1px solid #DDD}
.div_table-cell img{width:50px}
.bg_board:hover{background-color:#E95516}
.bg_active{background-color:#B37583}
.TmpBgSelectIcon{position:absolute;z-index:1;height:65px;width:93px;background-image:url(images/select.png);background-repeat:no-repeat}
.Area_Tag{left:-1px;top:-1px;background-color:#6C6C6C;color:#FFF;padding:2px;-webkit-border-radius:2px;-moz-border-radius:2px;-o-border-radius:2px;border-radius:2px;box-shadow:0 1px 3px rgba(0,0,0,.2);-webkit-box-shadow:0 1px 3px rgba(0,0,0,.2);-moz-box-shadow:0 1px 3px rgba(0,0,0,.2);-o-box-shadow:0 1px 3px rgba(0,0,0,.2);position:absolute;z-index:100;font-size:9px}
.Area_Tag a{color:#FFF}
table.tablesorter tr.even:hover td,table.tablesorter tr:hover td,table.tablesorter tr.odd:hover td { background-color:#FFFFFF;}
</style>
<div class="InnerPage" style="margin-right:8px;"><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt_Tmp=tmpaddblock&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="建立自己的新側邊裝飾外框" target="_blank" data-toggle="tooltip" data-placement="right">新增側邊裝飾外框</a></div>
<div style="background-color:#999; color:#FFF; text-align:center; padding:5px; cursor:pointer;" class="Acc_Title"><span class="Acc_Change"><i class="fa fa-plus-square"></i></span> 側邊裝飾外框</div>
<div style="padding:0px; margin:0px;" class="Acc_Content">
  <div style="background-color:#FFFFFF; padding:5px; border: 1px solid #CCC; overflow-y:scroll; height:500px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
          <tr>
          	<td align="right"><div class="PageSelectBoard">
          	  <?php 
			# variable declaration
			$prev_RecordTmpBlock = "<i class=\"fa fa-angle-left\"></i>";
			$next_RecordTmpBlock = "<i class=\"fa fa-angle-right\"></i>";
			$separator = "&nbsp;";
			$max_links = 6;
			$pages_navigation_RecordTmpBlock = buildNavigation($pageNum_RecordTmpBlock,$totalPages_RecordTmpBlock,$prev_RecordTmpBlock,$next_RecordTmpBlock,$separator,$max_links,true); 
			
			print $pages_navigation_RecordTmpBlock[0]; 
			?>
          	  <?php print $pages_navigation_RecordTmpBlock[1]; ?> 
          	  <?php print $pages_navigation_RecordTmpBlock[2]; ?></div>       	    </td>
          </tr>
         
    </table>
	<form name="form" action="<?php echo $editFormAction; ?>" method="POST"> 
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter" id="TBSort">
      
    <tbody>
    
      <tr>    
       <td>
       <div style="padding:5px; border: 1px dotted #CCC; margin-bottom:2px; width:350px; float:left; margin:5px; text-align:center;" class="<?php if($row_RecordTmpBlockSelect['tmpblock'] == ''){echo "bg_active";} ?> bg_board"><!--無圖片指定-->
         <div class="div_table-cell">
           <a><img src="images/no_bg.jpg" alt="" alumb="true" _w="100" _h="100"/></a><span></span>
         </div>  
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
	        $(".BlockWrp").css({"background-color":"transparent", "border":"none"});
			$(".BlockTitle").css({"color":"!important","line-height":"","padding-left":"0px","background-image":"none"});
			$(".BlockContent").css({"background-image":"none"});
			$(".Block_Bottom").css({"display":"none"});
});
$("#use_tmp_none").click(function(){     
$.ajax({
		type: "POST",
		url: "sqlgettmp/tmpblock_get.php?id=none&Operate=M_Update&tmpid=<?php echo $row_RecordTmp['id']; ?>&<?php echo time();?>",
		success: function(data){
			$(".BlockWrp").css({"background-color":"transparent", "border":"none"});
			$(".BlockTitle").css({"color":"!important","line-height":"","padding-left":"0px","background-image":"none"});
			$(".BlockContent").css({"background-image":"none"});
			$(".Block_Bottom").css({"display":"none"});
			alert("已套用設定項目，您可刷新頁面觀看結果!!"); 
		 }
	  });
});
</script> 
       <?php do { ?>
           <div style="padding:5px; border: 1px dotted #CCC; margin-bottom:2px; width:350px; float:left; margin:5px; text-align:center; position:relative;" class="<?php if($row_RecordTmpBlockSelect['tmpblock'] == $row_RecordTmpBlock['id']){echo "bg_active";} ?> bg_board">
           <div class="Area_Tag">#<?php echo $row_RecordTmpBlock['id']; ?></div>
             <div class="div_table-cell">	
               <div style="border: <?php echo $row_RecordTmpBlock['tmp_block_width']; ?>px <?php echo $row_RecordTmpBlock['tmp_block_style']; ?> <?php echo $row_RecordTmpBlock['tmp_block_color']; ?>; background-color:<?php echo $row_RecordTmpBlock['tmp_block_background_color']; ?>;">
            	<div style="color:<?php echo $row_RecordTmpBlock['tmp_a_font_color']; ?>;line-height: <?php echo $row_RecordTmpBlock['tmp_b_t_hight']; ?>px;text-align: left;padding-left: <?php echo $row_RecordTmpBlock['tmp_b_t_left']; ?>;background-image: url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBlock['webname']; ?>/image/tmpblock/<?php echo $row_RecordTmpBlock['tmp_title_pic']; ?>);background-repeat: <?php echo $row_RecordTmpBlock['tmp_b_t_repet']; ?>;background-position: <?php echo $row_RecordTmpBlock['tmp_b_t_position']; ?>;">&nbsp;</div>
                <div style="background-image: url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBlock['webname']; ?>/image/tmpblock/<?php echo $row_RecordTmpBlock['tmp_middle_pic']; ?>);background-repeat: <?php echo $row_RecordTmpBlock['tmp_b_m_repet']; ?>;background-position: <?php echo $row_RecordTmpBlock['tmp_b_m_position']; ?>;">&nbsp;</div>
                <div style="background-image: url(<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpBlock['webname']; ?>/image/tmpblock/<?php echo $row_RecordTmpBlock['tmp_bottom_pic']; ?>);">&nbsp;</div>
            </div>
      </div>
            <br />
            <label for="TmpBgSelect">
              
              <?php echo highLight($row_RecordTmpBlock['name'], @$_GET['searchkey'], $HighlightSelect); ?></label>
           <input type="button" name="chang_tmp<?php echo $row_RecordTmpBlock['id']; ?>" id="chang_tmp<?php echo $row_RecordTmpBlock['id']; ?>" value="預覽" />
           <input type="button" name="use_tmp<?php echo $row_RecordTmpBlock['id']; ?>" id="use_tmp<?php echo $row_RecordTmpBlock['id']; ?>" value="套用" />
           <input type="button" name="PageRefresh" id="PageRefresh" class="PageRefresh" value="刷新" />
           </div>
<script language="javascript" type="text/javascript">
$("#chang_tmp<?php echo $row_RecordTmpBlock['id']; ?>").click(function(){      
			$(".BlockWrp").css({"background-color":"<?php echo $row_RecordTmpBlock['tmp_block_background_color']; ?>", "border":"<?php echo $row_RecordTmpBlock['tmp_block_width']; ?>px <?php echo $row_RecordTmpBlock['tmp_block_style']; ?> <?php echo $row_RecordTmpBlock['tmp_block_color']; ?>"});
			$(".BlockTitle").css({"color":"<?php echo $row_RecordTmpBlock['tmp_a_font_color']; ?>","line-height":"<?php echo $row_RecordTmpBlock['tmp_b_t_hight']; ?>px","padding-left":"<?php echo $row_RecordTmpBlock['tmp_b_t_left']; ?>px","background-image":"url(<?php echo $SiteImgUrl; ?><?php echo $row_RecordTmpBlock['webname']; ?>/image/tmpblock/<?php echo $row_RecordTmpBlock['tmp_title_pic']; ?>)","background-repeat":"<?php echo $row_RecordTmpBlock['tmp_b_t_repet']; ?>","background-position":"<?php echo $row_RecordTmpBlock['tmp_b_t_position']; ?>"});
			$(".BlockContent").css({"background-image":"url(<?php echo $SiteImgUrl; ?><?php echo $row_RecordTmpBlock['webname']; ?>/image/tmpblock/<?php echo $row_RecordTmpBlock['tmp_middle_pic']; ?>)","background-repeat":"<?php echo $row_RecordTmpBlock['tmp_b_m_repet']; ?>","background-position":"<?php echo $row_RecordTmpBlock['tmp_b_m_position']; ?>"});
			<?php if ($row_RecordTmpBlock['tmp_bottom_pic'] != "") { ?>
			$(".Block_Bottom").html("<img src=\"<?php echo $SiteImgUrl; ?><?php echo $row_RecordTmpBlock['webname']; ?>/image/tmpblock/<?php echo $row_RecordTmpBlock['tmp_bottom_pic']; ?>\" />");
			<?php } ?>		
});
$("#use_tmp<?php echo $row_RecordTmpBlock['id']; ?>").click(function(){     
$.ajax({
		type: "GET",
		url: "sqlgettmp/tmpblock_get.php?id=<?php echo $row_RecordTmpBlock['id']; ?>&Operate=M_Update&tmpid=<?php echo $row_RecordTmp['id']; ?>&<?php echo time();?>",
		success: function(data){
			$(".BlockWrp").css({"background-color":"<?php echo $row_RecordTmpBlock['tmp_block_background_color']; ?>", "border":"<?php echo $row_RecordTmpBlock['tmp_block_width']; ?>px <?php echo $row_RecordTmpBlock['tmp_block_style']; ?> <?php echo $row_RecordTmpBlock['tmp_block_color']; ?>"});
			$(".BlockTitle").css({"color":"<?php echo $row_RecordTmpBlock['tmp_a_font_color']; ?>","line-height":"<?php echo $row_RecordTmpBlock['tmp_b_t_hight']; ?>px","padding-left":"<?php echo $row_RecordTmpBlock['tmp_b_t_left']; ?>px","background-image":"url(<?php echo $SiteImgUrl; ?><?php echo $row_RecordTmpBlock['webname']; ?>/image/tmpblock/<?php echo $row_RecordTmpBlock['tmp_title_pic']; ?>)","background-repeat":"<?php echo $row_RecordTmpBlock['tmp_b_t_repet']; ?>","background-position":"<?php echo $row_RecordTmpBlock['tmp_b_t_position']; ?>"});
			$(".BlockContent").css({"background-image":"url(<?php echo $SiteImgUrl; ?><?php echo $row_RecordTmpBlock['webname']; ?>/image/tmpblock/<?php echo $row_RecordTmpBlock['tmp_middle_pic']; ?>)","background-repeat":"<?php echo $row_RecordTmpBlock['tmp_b_m_repet']; ?>","background-position":"<?php echo $row_RecordTmpBlock['tmp_b_m_position']; ?>"});
			<?php if ($row_RecordTmpBlock['tmp_bottom_pic'] != "") { ?>
			$(".Block_Bottom").html("<img src=\"<?php echo $SiteImgUrl; ?><?php echo $row_RecordTmpBlock['webname']; ?>/image/tmpblock/<?php echo $row_RecordTmpBlock['tmp_bottom_pic']; ?>\" />");
			<?php } ?>
			alert("已套用設定項目，您可刷新頁面觀看結果!!"); 
		 }
	  });
});
</script> 
           
<?php } while ($row_RecordTmpBlock = mysqli_fetch_assoc($RecordTmpBlock)); ?>

       </td>
       </tr>
     
     
      </tbody>
    
       <tfoot>
        <tr>
        <td><input name="id" type="hidden" id="id" value="<?php echo $_GET['id']; ?>" /></td>
        </tr>
      </tfoot>

</table>
	<input type="hidden" name="MM_update" value="form" />
   </form>
    
    
  </div>
</div>
<?php
mysqli_free_result($RecordTmpBlock);

mysqli_free_result($RecordTmpBlockSelect);

mysqli_free_result($RecordTmpBlockListType);

mysqli_free_result($RecordTmpBoardStyle);
?>