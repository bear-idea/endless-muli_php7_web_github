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
    GLOBAL $maxRows_RecordTmpLogo,$totalRows_RecordTmpLogo;
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
					if ($_get_name != "pageNum_RecordTmpLogo") {
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
			$firstArray = ($pageNum_Recordset1 > 0) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordTmpLogo=$precedente$_get_vars\">$prev_Recordset1</a>" :  "<span>$prev_Recordset1</span>"/*  css */;
			# ----------------------
			# page numbers
			# ----------------------
			for($a = $fgp+1; $a <= $egp; $a++){
				$theNext = $a-1;
				if($show_page)
				{
					$textLink = $a;
				} else {
					$min_l = (($a-1)*$maxRows_RecordTmpLogo) + 1;
					$max_l = ($a*$maxRows_RecordTmpLogo >= $totalRows_RecordTmpLogo) ? $totalRows_RecordTmpLogo : ($a*$maxRows_RecordTmpLogo);
					$textLink = "$min_l - $max_l";
				}
				$_ss_k = floor($theNext/26);
				if ($theNext != $pageNum_Recordset1)
				{
					$pagesArray .= "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordTmpLogo=$theNext$_get_vars\">";
					$pagesArray .= "$textLink</a>" . ($theNext < $egp-1 ? $separator : "");
				} else {
					$pagesArray .= "<span>"; /* css */
					$pagesArray .= "$textLink</span>"  . ($theNext < $egp-1 ? $separator : "");
				}
			}  
			$theNext = $pageNum_Recordset1+1;
			$offset_end = $totalPages_Recordset1;
			$lastArray = ($pageNum_Recordset1 < $totalPages_Recordset1) ? "<a href=\"$_SERVER[PHP_SELF]?pageNum_RecordTmpLogo=$successivo$_get_vars\">$next_Recordset1</a>" : "<span>$next_Record1</span>"; /* css */
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
  $updateSQL = sprintf("UPDATE demo_tmp SET tmplogoid=%s WHERE id=%s",
                       GetSQLValueString($_POST['TmpBgSelect'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

$maxRows_RecordTmpLogo = 50;
$pageNum_RecordTmpLogo = 0;
if (isset($_GET['pageNum_RecordTmpLogo'])) {
  $pageNum_RecordTmpLogo = $_GET['pageNum_RecordTmpLogo'];
}
$startRow_RecordTmpLogo = $pageNum_RecordTmpLogo * $maxRows_RecordTmpLogo;

$colname_RecordTmpLogo = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordTmpLogo = $_GET['searchkey'];
}
$coluserid_RecordTmpLogo = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpLogo = $w_userid;
}
$coltype_RecordTmpLogo = "%";
if (isset($_GET['type'])) {
  $coltype_RecordTmpLogo = $_GET['type'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpLogo = sprintf("SELECT * FROM demo_tmplogo WHERE ((name LIKE %s)) && (type LIKE %s) && (userid=%s || userid=1) ORDER BY type DESC, id DESC", GetSQLValueString("%" . $colname_RecordTmpLogo . "%", "text"),GetSQLValueString("%" . $coltype_RecordTmpLogo . "%", "text"),GetSQLValueString($coluserid_RecordTmpLogo, "int"));
$query_limit_RecordTmpLogo = sprintf("%s LIMIT %d, %d", $query_RecordTmpLogo, $startRow_RecordTmpLogo, $maxRows_RecordTmpLogo);
$RecordTmpLogo = mysqli_query($DB_Conn, $query_limit_RecordTmpLogo) or die(mysqli_error($DB_Conn));
$row_RecordTmpLogo = mysqli_fetch_assoc($RecordTmpLogo);

if (isset($_GET['totalRows_RecordTmpLogo'])) {
  $totalRows_RecordTmpLogo = $_GET['totalRows_RecordTmpLogo'];
} else {
  $all_RecordTmpLogo = mysqli_query($DB_Conn, $query_RecordTmpLogo);
  $totalRows_RecordTmpLogo = mysqli_num_rows($all_RecordTmpLogo);
}
$totalPages_RecordTmpLogo = ceil($totalRows_RecordTmpLogo/$maxRows_RecordTmpLogo)-1;

$colid_RecordTmpLogoSelect = "-1";
if (isset($_GET['id_edit'])) {
  $colid_RecordTmpLogoSelect = $_GET['id_edit'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpLogoSelect = sprintf("SELECT * FROM demo_tmp WHERE id = %s", GetSQLValueString($colid_RecordTmpLogoSelect, "int"));
$RecordTmpLogoSelect = mysqli_query($DB_Conn, $query_RecordTmpLogoSelect) or die(mysqli_error($DB_Conn));
$row_RecordTmpLogoSelect = mysqli_fetch_assoc($RecordTmpLogoSelect);
$totalRows_RecordTmpLogoSelect = mysqli_num_rows($RecordTmpLogoSelect);

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpLogoListType = "SELECT * FROM demo_tmpitem WHERE list_id = 6";
$RecordTmpLogoListType = mysqli_query($DB_Conn, $query_RecordTmpLogoListType) or die(mysqli_error($DB_Conn));
$row_RecordTmpLogoListType = mysqli_fetch_assoc($RecordTmpLogoListType);
$totalRows_RecordTmpLogoListType = mysqli_num_rows($RecordTmpLogoListType);

$colname_RecordTmpBoardStyle = "-1";
if (isset($_GET['id'])) {
  $colname_RecordTmpBoardStyle = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpBoardStyle = sprintf("SELECT id, name FROM demo_tmp WHERE id = %s", GetSQLValueString($colname_RecordTmpBoardStyle, "int"));
$RecordTmpBoardStyle = mysqli_query($DB_Conn, $query_RecordTmpBoardStyle) or die(mysqli_error($DB_Conn));
$row_RecordTmpBoardStyle = mysqli_fetch_assoc($RecordTmpBoardStyle);
$totalRows_RecordTmpBoardStyle = mysqli_num_rows($RecordTmpBoardStyle);
?>
<style>
.tbutt{float:left;padding:5px;background-color:#666;color:#FFF;margin:0 5px 10px 0}
.div_table-cell{overflow:hidden;height:50px;width:50px;margin:5px;text-align:center;vertical-align:middle;border:1px solid #DDD}
.div_table-cell span{height:100%;display:inline-block;background-image:none;border-style:none}
.div_table-cell *{vertical-align:middle}
.bg_board:hover{background-color:#E95516}
.bg_active{background-color:#B37583}
.TmpBgSelectIcon{position:absolute;z-index:1;height:65px;width:93px;background-image:url(images/select.png);background-repeat:no-repeat}
.button_a{display:inline-block;border-width:1px 0;border-color:#BBB;border-style:solid;vertical-align:middle;text-decoration:none;color:#333}
.button_b{float:left;background:#e3e3e3;border-width:0 1px;border-color:#BBB;border-style:solid;margin:0 -1px;position:relative}
.button_c{display:block;line-height:.6em;background:#f9f9f9;border-bottom:2px solid #eee}
.button_d{display:block;padding:.1em .6em;margin-top:-.6em;cursor:pointer}
.button_a:hover{border-color:#999;text-decoration:none}
.button_a:hover .button_b{border-color:#999;text-decoration:none}
</style>
<div class="InnerPage" style="margin-right:8px;"><a href="manage_tmp.php?wshop=<?php echo $wshop;?>&amp;Opt_Tmp=logoaddpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="建立自己的新LOGO" target="_blank" data-toggle="tooltip" data-placement="right">新增LOGO</a></div>
<div style="background-color:#999; color:#FFF; text-align:center; padding:5px; cursor:pointer;" class="Acc_Title"><span class="Acc_Change"><i class="fa fa-plus-square"></i></span> LOGO</div>
<div style="padding:0px; margin:0px;" class="Acc_Content">
  <div style="background-color:#FFFFFF; padding:5px; border: 1px solid #CCC; overflow-y:scroll; height:500px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
          <tr>
          	<td align="right"><div class="PageSelectBoard">
          	  <?php 
			# variable declaration
			$prev_RecordTmpLogo = "<i class=\"fa fa-angle-left\"></i>";
			$next_RecordTmpLogo = "<i class=\"fa fa-angle-right\"></i>";
			$separator = "&nbsp;";
			$max_links = 6;
			$pages_navigation_RecordTmpLogo = buildNavigation($pageNum_RecordTmpLogo,$totalPages_RecordTmpLogo,$prev_RecordTmpLogo,$next_RecordTmpLogo,$separator,$max_links,true); 
			
			print $pages_navigation_RecordTmpLogo[0]; 
			?>
          	  <?php print $pages_navigation_RecordTmpLogo[1]; ?> 
          	  <?php print $pages_navigation_RecordTmpLogo[2]; ?></div>       	    </td>
          </tr>
          
    </table>
	<form name="form" action="<?php echo $editFormAction; ?>" method="POST"> 
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablesorter" id="TBSort">
      
    <tbody>
    
      <tr>    
       <td>
       
	   <div style="padding:5px; border: 1px dotted #CCC; margin-bottom:2px; width:350px; float:left; margin:5px; text-align:center;" class="<?php if($row_RecordTmpLogoSelect['tmplogoid'] == ''){echo "bg_active";} ?> bg_board"><!--無圖片指定-->
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
$.ajax({
		type: "POST",
		url: "sqlgettmp/tmplogo_get.php?id=none&tmpid=<?php echo $row_RecordTmp['id']; ?>&<?php echo time();?>",
		success: function(data){
			$('#logo').html(data);   
			//$("#logo").css({"height":"0px", "margin-top":"0px"});
			//alert(data); 
		 }
	  });
});
$("#use_tmp_none").click(function(){     
$.ajax({
		type: "GET",
		url: "sqlgettmp/tmplogo_get.php?id=none&Operate=M_Update&tmpid=<?php echo $row_RecordTmp['id']; ?>&<?php echo time();?>",
		success: function(data){
			$('#logo').html(data);   
			//$("#logo").css({"height":"0px", "margin-top":"0px"});
			alert("已套用設定項目，您可刷新頁面觀看結果!!"); 
		 }
	  });
});
</script> 
       <?php do { ?>
           <div style="padding:5px; border: 1px dotted #CCC; margin-bottom:2px; width:350px; float:left; margin:5px; text-align:center;" class="<?php if($row_RecordTmpLogoSelect['tmplogoid'] == $row_RecordTmpLogo['id']){echo "bg_active";} ?> bg_board">
           <?php if ($row_RecordTmpLogo['logotype'] == 0) { ?>
             <?php if ($row_RecordTmpLogo['logoimage'] != "" && GetFileExtend($row_RecordTmpLogo['logoimage']) != '.swf') { ?>
        <div class="div_table-cell">	
        <a><img src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpLogo['webname']; ?>/logo/<?php echo $row_RecordTmpLogo['logoimage']; ?>" alt="" alumb="true" _w="100" _h="100"/></a><span></span>
        </div>
        <?php } else if (GetFileExtend($row_RecordTmpLogo['logoimage']) == '.swf'){ ?>
        <div class="div_table-cell">	
        <a><div align='center'><embed type="application/x-shockwave-flash" width="" height="" src="<?php echo $SiteImgUrlAdmin; ?><?php echo $row_RecordTmpLogo['webname']; ?>/logo/<?php echo $row_RecordTmpLogo['logoimage']; ?>" play="true" loop="true" quality="high"> </embed></div></a><span></span>
        </div>
		<?php } else { ?>
        <div class="div_table-cell">	
        <a><img src="images/100x100_noimage.jpg" alt="" alumb="true" _w="100" _h="100"/></a><span></span>
        </div>
        <?php } ?>
        <?php } else { ?>
        <div class="div_table-cell" style="display:inline-block; overflow:hidden; white-space:nowrap; float:left">	
        <a style="color:<?php echo $row_RecordTmpLogo['logocolor']; ?>; font-size:<?php echo $row_RecordTmpLogo['logofontsize']; ?>"><?php echo $row_RecordTmpLogo['logoname']; ?></a><span></span>
        </div><div style=" clear:both"></div>
        <?php } ?>
            <br />
            <label for="TmpBgSelect">
              
              <?php echo highLight($row_RecordTmpLogo['name'], @$_GET['searchkey'], $HighlightSelect); ?>
          </label>
           <input type="button" name="chang_tmp<?php echo $row_RecordTmpLogo['id']; ?>" id="chang_tmp<?php echo $row_RecordTmpLogo['id']; ?>" value="預覽" />
           <input type="button" name="use_tmp<?php echo $row_RecordTmpLogo['id']; ?>" id="use_tmp<?php echo $row_RecordTmpLogo['id']; ?>" value="套用" />
           <input type="button" name="PageRefresh" id="PageRefresh" class="PageRefresh" value="刷新" />
           </div>
<script language="javascript" type="text/javascript">
$("#chang_tmp<?php echo $row_RecordTmpLogo['id']; ?>").click(function(){     
$.ajax({
		type: "POST",
		url: "sqlgettmp/tmplogo_get.php?id=<?php echo $row_RecordTmpLogo['id']; ?>&tmpid=<?php echo $row_RecordTmp['id']; ?>&<?php echo time();?>",
		success: function(data){
			$('#logo').html(data);   
			//$("#logo").css({"height":"0px", "margin-top":"0px"});
			//alert(data); 
		 }
	  });
});
$("#use_tmp<?php echo $row_RecordTmpLogo['id']; ?>").click(function(){     
$.ajax({
		type: "GET",
		url: "sqlgettmp/tmplogo_get.php?id=<?php echo $row_RecordTmpLogo['id']; ?>&Operate=M_Update&tmpid=<?php echo $row_RecordTmp['id']; ?>&<?php echo time();?>",
		success: function(data){
			$('#logo').html(data);   
			//$("#logo").css({"height":"0px", "margin-top":"0px"});
			alert("已套用設定項目，您可刷新頁面觀看結果!!"); 
		 }
	  });
});
</script> 
<?php } while ($row_RecordTmpLogo = mysqli_fetch_assoc($RecordTmpLogo)); ?>
       </td>
       </tr>
     
     
      </tbody>
    
       <tfoot>
        <tr>
        <td><input name="id" type="hidden" id="id" value="<?php echo $_GET['id_edit']; ?>" /></td>
        </tr>
      </tfoot>

</table>
	<input type="hidden" name="MM_update" value="form" />
   </form>
    
    
  </div>
</div>
<script type="text/javascript">
/* 圖片(不)完全按比例自動縮圖 */
jQuery(document).ready(function(){$(window).load(function(){$(".div_table-cell img").each(function(){if("true"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");var c=$(this).width(),d=$(this).height(),a=$(this).attr("_w")/c,b=$(this).attr("_h")/d,e=1,e=a>b?b:a;$(this).width(c*e);$(this).height(d*e)}else if("false"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");$(this).width();$(this).height();c=$(this).attr("_w");d=$(this).attr("_h");
a=$(this).width();b=$(this).height();if(a>c){var e=a,f=b,b=b*(c/a),a=c;b<d&&(a=e*(d/f),b=d)}$(this).attr({width:a,height:b})}})})});
</script>
<?php
mysqli_free_result($RecordTmpLogo);

mysqli_free_result($RecordTmpLogoSelect);

mysqli_free_result($RecordTmpLogoListType);

mysqli_free_result($RecordTmpBoardStyle);
?>