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
    GLOBAL $maxRows_RecordTmpLeftMenu,$totalRows_RecordTmpLeftMenu;
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
					if ($_get_name != "pageNum_RecordTmpLeftMenu") {
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
			$firstArray = ($pageNum_Recordset1 > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordTmpLeftMenu=$precedente$_get_vars\">$prev_Recordset1</a>" :  "<span>$prev_Recordset1</span>"/*  css */;
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordTmpLeftMenu) + 1;
					$max_l = ($a*$maxRows_RecordTmpLeftMenu >= $totalRows_RecordTmpLeftMenu) ? $totalRows_RecordTmpLeftMenu : ($a*$maxRows_RecordTmpLeftMenu);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageNum_Recordset1)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordTmpLeftMenu=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "<span>"; /* css */
					$pagesArray .= "$textLink</span>"  . ($theNext < $egp-1 ? $separator : "");
				}
			}  
			$theNext = $pageNum_Recordset1+1;
			$offset_end = $totalPages_Recordset1;
			$lastArray = ($pageNum_Recordset1 < $totalPages_Recordset1) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordTmpLeftMenu=$successivo$_get_vars\">$next_Recordset1</a>" : "<span>$next_Record1</span>"; /* css */
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
  $updateSQL = sprintf("UPDATE demo_tmp SET tmpleftmenu=%s WHERE id=%s",
                       GetSQLValueString($_POST['TmpBgSelect'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

$maxRows_RecordTmpLeftMenu = 10;
$pageNum_RecordTmpLeftMenu = 0;
if (isset($_GET['pageNum_RecordTmpLeftMenu'])) {
  $pageNum_RecordTmpLeftMenu = $_GET['pageNum_RecordTmpLeftMenu'];
}
$startRow_RecordTmpLeftMenu = $pageNum_RecordTmpLeftMenu * $maxRows_RecordTmpLeftMenu;

$colname_RecordTmpLeftMenu = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordTmpLeftMenu = $_GET['searchkey'];
}
$coluserid_RecordTmpLeftMenu = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpLeftMenu = $w_userid;
}
$coltype_RecordTmpLeftMenu = "%";
if (isset($_GET['type'])) {
  $coltype_RecordTmpLeftMenu = $_GET['type'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpLeftMenu = sprintf("SELECT * FROM demo_tmpleftmenu WHERE ((name LIKE %s)) && (type LIKE %s) && (userid=%s || userid=1) ORDER BY id DESC", GetSQLValueString("%" . $colname_RecordTmpLeftMenu . "%", "text"),GetSQLValueString("%" . $coltype_RecordTmpLeftMenu . "%", "text"),GetSQLValueString($coluserid_RecordTmpLeftMenu, "int"));
$query_limit_RecordTmpLeftMenu = sprintf("%s LIMIT %d, %d", $query_RecordTmpLeftMenu, $startRow_RecordTmpLeftMenu, $maxRows_RecordTmpLeftMenu);
$RecordTmpLeftMenu = mysqli_query($DB_Conn, $query_limit_RecordTmpLeftMenu) or die(mysqli_error($DB_Conn));
$row_RecordTmpLeftMenu = mysqli_fetch_assoc($RecordTmpLeftMenu);

if (isset($_GET['totalRows_RecordTmpLeftMenu'])) {
  $totalRows_RecordTmpLeftMenu = $_GET['totalRows_RecordTmpLeftMenu'];
} else {
  $all_RecordTmpLeftMenu = mysqli_query($DB_Conn, $query_RecordTmpLeftMenu);
  $totalRows_RecordTmpLeftMenu = mysqli_num_rows($all_RecordTmpLeftMenu);
}
$totalPages_RecordTmpLeftMenu = ceil($totalRows_RecordTmpLeftMenu/$maxRows_RecordTmpLeftMenu)-1;

$colid_RecordTmpLeftMenuSelect = "-1";
if (isset($_GET['id'])) {
  $colid_RecordTmpLeftMenuSelect = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpLeftMenuSelect = sprintf("SELECT * FROM demo_tmp WHERE id = %s", GetSQLValueString($colid_RecordTmpLeftMenuSelect, "int"));
$RecordTmpLeftMenuSelect = mysqli_query($DB_Conn, $query_RecordTmpLeftMenuSelect) or die(mysqli_error($DB_Conn));
$row_RecordTmpLeftMenuSelect = mysqli_fetch_assoc($RecordTmpLeftMenuSelect);
$totalRows_RecordTmpLeftMenuSelect = mysqli_num_rows($RecordTmpLeftMenuSelect);

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpLeftMenuListType = "SELECT * FROM demo_tmpitem WHERE list_id = 4";
$RecordTmpLeftMenuListType = mysqli_query($DB_Conn, $query_RecordTmpLeftMenuListType) or die(mysqli_error($DB_Conn));
$row_RecordTmpLeftMenuListType = mysqli_fetch_assoc($RecordTmpLeftMenuListType);
$totalRows_RecordTmpLeftMenuListType = mysqli_num_rows($RecordTmpLeftMenuListType);

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
.div_table-cell{overflow:hidden;height:50px;width:50px;text-align:center;vertical-align:middle;border:1px solid #DDD;margin:5px}
.div_table-cell img{width:50px}
.bg_board:hover{background-color:#E95516}
.bg_active{background-color:#B37583}
.TmpBgSelectIcon{position:absolute;z-index:1;height:65px;width:93px;background-image:url(images/select.png);background-repeat:no-repeat}
.Area_Tag{left:-1px;top:-1px;background-color:#6C6C6C;color:#FFF;padding:2px;-webkit-border-radius:2px;-moz-border-radius:2px;-o-border-radius:2px;border-radius:2px;box-shadow:0 1px 3px rgba(0,0,0,.2);-webkit-box-shadow:0 1px 3px rgba(0,0,0,.2);-moz-box-shadow:0 1px 3px rgba(0,0,0,.2);-o-box-shadow:0 1px 3px rgba(0,0,0,.2);position:absolute;z-index:100;font-size:9px}
.Area_Tag a{color:#FFF}
table.tablesorter tr.even:hover td,table.tablesorter tr:hover td,table.tablesorter tr.odd:hover td { background-color:#FFFFFF;}
</style>
<div class="InnerPage" style="margin-right:8px;"><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt_Tmp=tmpaddleftmenu&amp;lang=<?php echo $_SESSION['lang']; ?>" title="建立側邊選單樣式" target="_blank" rel="tipsy">新增側邊選單</a></div>
<div style="background-color:#999; color:#FFF; text-align:center; padding:5px; cursor:pointer;" class="Acc_Title"><span class="Acc_Change"><i class="fa fa-plus-square"></i></span> 側邊選單</div>
<div style="padding:0px; margin:0px;" class="Acc_Content">
  <div style="background-color:#FFFFFF; padding:5px; border: 1px solid #CCC; overflow-y:scroll; height:800px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
          <tr>
          	<td align="right"><div class="PageSelectBoard">
          	  <?php 
			# variable declaration
			$prev_RecordTmpLeftMenu = "<i class=\"fa fa-angle-left\"></i>";
			$next_RecordTmpLeftMenu = "<i class=\"fa fa-angle-right\"></i>";
			$separator = "&nbsp;";
			$max_links = 6;
			$pages_navigation_RecordTmpLeftMenu = buildNavigation($pageNum_RecordTmpLeftMenu,$totalPages_RecordTmpLeftMenu,$prev_RecordTmpLeftMenu,$next_RecordTmpLeftMenu,$separator,$max_links,true); 
			
			print $pages_navigation_RecordTmpLeftMenu[0]; 
			?>
          	  <?php print $pages_navigation_RecordTmpLeftMenu[1]; ?> 
          	  <?php print $pages_navigation_RecordTmpLeftMenu[2]; ?></div>       	    </td>
          </tr>
          
    </table>
	<form name="form" action="<?php echo $editFormAction; ?>" method="POST"> 
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter" id="TBSort">
      
    <tbody>
    
      <tr>    
       <td>
       
       
       <?php do { ?>
           <div style="padding:5px; position:relative; border: 1px dotted #CCC; margin-bottom:2px; width:350px; float:left; margin:5px; text-align:center;"" class="<?php if($row_RecordTmpLeftMenuSelect['tmpleftmenu'] == $row_RecordTmpLeftMenu['id']){echo "bg_active";} ?> bg_board">
           <div class="Area_Tag">#<?php echo $row_RecordTmpLeftMenu['id']; ?></div>
             <div class="div_table-cell">	
               <?php if ($row_RecordTmpLeftMenu['tmp_title_pic'] != '') { ?>
               <img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpLeftMenu['webname']; ?>/image/tmpleftmenu/<?php echo $row_RecordTmpLeftMenu['tmp_title_pic']; ?>" alt=""/>
               <?php } ?>
               <img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpLeftMenu['webname']; ?>/image/tmpleftmenu/<?php echo $row_RecordTmpLeftMenu['tmp_middle_pic']; ?>" alt=""/>
               <img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpLeftMenu['webname']; ?>/image/tmpleftmenu/<?php echo $row_RecordTmpLeftMenu['tmp_middle_pic']; ?>" alt=""/>
               <?php if ($row_RecordTmpLeftMenu['tmp_bottom_pic'] != '') { ?>
               <img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpLeftMenu['webname']; ?>/image/tmpleftmenu/<?php echo $row_RecordTmpLeftMenu['tmp_bottom_pic']; ?>" alt=""/>
               <?php } ?>
             </div>
            <br />
            <label for="TmpBgSelect">
              
              <?php echo highLight($row_RecordTmpLeftMenu['name'], @$_GET['searchkey'], $HighlightSelect); ?>
          </label>
          <input type="button" name="chang_tmp<?php echo $row_RecordTmpLeftMenu['id']; ?>" id="chang_tmp<?php echo $row_RecordTmpLeftMenu['id']; ?>" value="預覽" />
           <input type="button" name="use_tmp<?php echo $row_RecordTmpLeftMenu['id']; ?>" id="use_tmp<?php echo $row_RecordTmpLeftMenu['id']; ?>" value="套用" />
           <input type="button" name="PageRefresh" id="PageRefresh" class="PageRefresh" value="刷新" />
           
           </div>
           <script language="javascript" type="text/javascript">
$("#chang_tmp<?php echo $row_RecordTmpLeftMenu['id']; ?>").click(function(){     
$.ajax({
		type: "POST",
		url: "sqlgettmp/leftmenu_get.php?id=<?php echo $row_RecordTmpLeftMenu['id']; ?>&tmpid=<?php echo $row_RecordTmp['id']; ?>&<?php echo time();?>",
		success: function(data){
			$('#ajax_leftmenu_location').html(data);   
			//$("#ajax_leftmenu_location").css({"height":"0px", "margin-top":"0px"});
			//alert(data); 
		 }
	  });
});
$("#use_tmp<?php echo $row_RecordTmpLeftMenu['id']; ?>").click(function(){     
$.ajax({
		type: "GET",
		url: "sqlgettmp/leftmenu_get.php?id=<?php echo $row_RecordTmpLeftMenu['id']; ?>&Operate=M_Update&tmpid=<?php echo $row_RecordTmp['id']; ?>&<?php echo time();?>",
		success: function(data){
			$('#ajax_leftmenu_location').html(data);   
			//$("#ajax_leftmenu_location").css({"height":"0px", "margin-top":"0px"});
			alert("已套用設定項目，您可刷新頁面觀看結果!!"); 
		 }
	  });
});
</script> 
<?php } while ($row_RecordTmpLeftMenu = mysqli_fetch_assoc($RecordTmpLeftMenu)); ?>

       </td>
       </tr>
     
     
      </tbody>
    
       <tfoot>
        <tr>
        <td><input type="submit" name="button" id="button" value="送出" />
          <input name="id" type="hidden" id="id" value="<?php echo $_GET['id']; ?>" /></td>
        </tr>
      </tfoot>

</table>
	<input type="hidden" name="MM_update" value="form" />
   </form>
    
    
  </div>
</div>
<?php
mysqli_free_result($RecordTmpLeftMenu);

mysqli_free_result($RecordTmpLeftMenuSelect);

mysqli_free_result($RecordTmpLeftMenuListType);

mysqli_free_result($RecordTmpBoardStyle);
?>