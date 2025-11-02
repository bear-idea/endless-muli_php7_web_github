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

$currentPage = $_SERVER["PHP_SELF"];

$collang_RecordProjectMix = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordProjectMix = $_SESSION['lang'];
}
$coluserid_RecordProjectMix = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordProjectMix = $_SESSION['userid'];
}
$colproductid_RecordProjectMix = "-1";
if (isset($_GET['id'])) {
  $colproductid_RecordProjectMix = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProjectMix = sprintf("SELECT * FROM demo_projectalbumphoto WHERE userid = %s && lang = %s && productmixid = %s ORDER BY sortid ASC, actphoto_id DESC", GetSQLValueString($coluserid_RecordProjectMix, "int"),GetSQLValueString($collang_RecordProjectMix, "text"),GetSQLValueString($colproductid_RecordProjectMix, "int"));
$RecordProjectMix = mysqli_query($DB_Conn, $query_RecordProjectMix) or die(mysqli_error($DB_Conn));
$row_RecordProjectMix = mysqli_fetch_assoc($RecordProjectMix);
$totalRows_RecordProjectMix = mysqli_num_rows($RecordProjectMix);

$queryString_RecordProjectMix = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecordProjectMix") == false && 
        stristr($param, "totalRows_RecordProjectMix") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordProjectMix = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordProjectMix = sprintf("&totalRows_RecordProjectMix=%d%s", $totalRows_RecordProjectMix, $queryString_RecordProjectMix);
?> 
<link rel="stylesheet" type="text/css" href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>jquery.jscrollpane.css" media="all" />
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.alsEN-1.0.min.js" ></script>
<style type="text/css">
.div_table-cell-project-mix{overflow:hidden;height:80px;width:80px;text-align:center;vertical-align:middle;border:1px solid #DDD;display:inline-block}
.div_table-cell-project-mix span{height:100%;display:inline-block;background-image:none;border-style:none}
.div_table-cell-project-mix *{vertical-align:middle}
.ca-container{position:relative;margin:3px auto;width:240px;height:80px}
.ca-wrapper{width:100%;height:100%;position:relative}
.ca-item{position:relative;float:left;width:80px;height:100%;text-align:center}
.ca-more{position:absolute;bottom:10px;right:0;padding:4px 15px;font-weight:700;background:#ccbda2;text-align:center;color:#fff;font-family:"Georgia","Times New Roman",serif;font-style:italic;text-shadow:1px 1px 1px #897c63}
.ca-close{position:absolute;top:10px;right:10px;background:#fff url(images/cross.png) no-repeat center center;width:27px;height:27px;text-indent:-9000px;outline:none;-moz-box-shadow:1px 1px 2px rgba(0,0,0,0.2);-webkit-box-shadow:1px 1px 2px rgba(0,0,0,0.2);box-shadow:1px 1px 2px rgba(0,0,0,0.2);opacity:.7}
.ca-close:hover{opacity:1}
.ca-item-main{padding:0;position:absolute;top:5px;left:5px;right:5px;bottom:5px;background:#fff;overflow:hidden;-moz-box-shadow:1px 1px 2px rgba(0,0,0,0.2);-webkit-box-shadow:1px 1px 2px rgba(0,0,0,0.2);box-shadow:1px 1px 2px rgba(0,0,0,0.2)}
.ca-icon{width:233px;height:189px;position:relative;margin:0 auto;background:transparent url(images/animal1.png) no-repeat center center}
.ca-content-wrapper{background:#b0ccc6;position:absolute;width:0;height:440px;top:5px;text-align:left;z-index:10000;overflow:hidden}
.ca-content{width:660px;overflow:hidden}
.ca-nav span{width:25px;height:38px;background:transparent url(images/arrows.png) no-repeat top left;position:absolute;top:50%;margin-top:-19px;left:-30px;text-indent:-9000px;opacity:.7;cursor:pointer;z-index:100}
.ca-nav span.ca-nav-next{background-position:top right;left:auto;right:-30px}
.ca-nav span:hover{opacity:1}
</style>
<?php if ($totalRows_RecordProjectMix > 0) { // Show if recordset not empty ?>
  <!-- 右方工程實績區塊  -->
  <div style="height:5px;"></div>
  <div class="product_inner_board_detailed">
    <!-- 右方詳細內容區塊標題 -->
    <div class="product_inner_board_detailed_title acc_trigger">
      <?php echo $ModuleName['Project']; ?>
    </div>
    <!-- 右方詳細內容區塊標題 END -->
    <div id="ca-container" class="ca-container">
				<div class="ca-wrapper">
                <?php $i=0; ?>
                    <?php do { ?>
                    <?php if(is_file($SiteImgUrl.$_GET['wshop']."/image/project/". $row_RecordProjectMix['pic'])) {  ?>
					<div class="ca-item">
						<div class="ca-item-main">
							<div class="div_table-cell-project-mix"><a href="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/project/<?php echo $row_RecordProjectMix['pic']; ?>" title="<?php echo $row_RecordProjectMix['name']; ?>" rel="prettyPhoto[pp_gal_mix]"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/project/thumb/small_<?php echo GetFileThumbExtend($row_RecordProjectMix['pic']); ?>" alt="<?php echo $row_RecordProjectMix['sdescription']; ?>" alumb="true" _w="80" _h="80"/></a><span></span></div>
						</div>
					</div>
                    <?php $i++; ?>  
                    <?php } ?> 
                    <?php } while ($row_RecordProjectMix = mysqli_fetch_assoc($RecordProjectMix)); ?>
				</div>
			</div>
  </div>
  <!-- 右方工程實績區塊 END -->
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.contentcarousel.js"></script>
<script type="text/javascript">
  $('#ca-container').contentcarousel();
</script>
<script type="text/javascript">
/* 圖片(不)完全按比例自動縮圖 */
jQuery(document).ready(function(){$(window).load(function(){$(".div_table-cell-project-mix img").each(function(){if("true"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");var c=$(this).width(),d=$(this).height(),a=$(this).attr("_w")/c,b=$(this).attr("_h")/d,e=1,e=a>b?b:a;$(this).width(c*e);$(this).height(d*e)}else if("false"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");$(this).width();$(this).height();c=$(this).attr("_w");d=$(this).attr("_h");
a=$(this).width();b=$(this).height();if(a>c){var e=a,f=b,b=b*(c/a),a=c;b<d&&(a=e*(d/f),b=d)}$(this).attr({width:a,height:b})}})})});
</script>
<?php } // Show if recordset not empty ?>
<!-- the jScrollPane script -->
<?php
mysqli_free_result($RecordProjectMix);
?>