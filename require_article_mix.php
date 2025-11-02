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

$collang_RecordArticleMix = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordArticleMix = $_SESSION['lang'];
}
$coluserid_RecordArticleMix = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordArticleMix = $_SESSION['userid'];
}
$colproductid_RecordArticleMix = "-1";
if (isset($_GET['id'])) {
  $colproductid_RecordArticleMix = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordArticleMix = sprintf("SELECT * FROM demo_article WHERE userid = %s && lang = %s && productmixid = %s ORDER BY sortid ASC, id DESC", GetSQLValueString($coluserid_RecordArticleMix, "int"),GetSQLValueString($collang_RecordArticleMix, "text"),GetSQLValueString($colproductid_RecordArticleMix, "int"));
$RecordArticleMix = mysqli_query($DB_Conn, $query_RecordArticleMix) or die(mysqli_error($DB_Conn));
$row_RecordArticleMix = mysqli_fetch_assoc($RecordArticleMix);
$totalRows_RecordArticleMix = mysqli_num_rows($RecordArticleMix);

$queryString_RecordArticleMix = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageMix") == false && 
        stristr($param, "totalRows_RecordArticleMix") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordArticleMix = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordArticleMix = sprintf("&totalRows_RecordArticleMix=%d%s", $totalRows_RecordArticleMix, $queryString_RecordArticleMix);
?> 
<link rel="stylesheet" type="text/css" href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>jquery.jscrollpane.css" media="all" />
<style type="text/css">
.div_table-cell-article-mix{overflow:hidden;height:70px;width:70px;text-align:center;vertical-align:middle;border:0 solid #DDD;display:inline-block}
.div_table-cell-article-mix span{height:100%;display:inline-block;background-image:none;border-style:none}
.div_table-cell-article-mix *{vertical-align:middle}
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
<?php if ($totalRows_RecordArticleMix > 0) { // Show if recordset not empty ?>
  <!-- 右方工程實績區塊  -->
  <div style="height:5px;"></div>
  <div class="product_inner_board_detailed">
    <!-- 右方詳細內容區塊標題 -->
    <div class="product_inner_board_detailed_title acc_trigger">
      <?php echo $Lang_Mix_Article; ?>
    </div>
    <!-- 右方詳細內容區塊標題 END -->
    <div id="ca-container" class="ca-container">
				<div class="ca-wrapper">
                <?php $i=0; ?>
                    <?php do { ?>
                    <?php // 判斷商品所在之層級
                                if($row_RecordArticleMix['type1'] != '-1' && $row_RecordArticleMix['type2'] != '-1' && $row_RecordArticleMix['type3'] != '-1') { $level='2'; }
                                else if($row_RecordArticleMix['type1'] != '-1' && $row_RecordArticleMix['type2'] != '-1' && $row_RecordArticleMix['type3'] == '-1') { $level='1'; }
                                else if($row_RecordArticleMix['type1'] != '-1' && $row_RecordArticleMix['type2'] == '-1' && $row_RecordArticleMix['type3'] == '-1') { $level='0'; }
                                else { $level=''; }
                            ?>
                    <?php if(is_file($SiteImgUrl.$_GET['wshop']."/image/article/". $row_RecordArticleMix['pic']) && $row_RecordArticleMix['pic'] != '') {  ?>
					<div class="ca-item">
						<div class="ca-item-main">
							<div class="div_table-cell-article-mix">
                            <?php if ($level == '2') { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("article",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordArticleMix['type1'],'type2'=>$row_RecordArticleMix['type2'],'type3'=>$row_RecordArticleMix['type3']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordArticleMix['id']; ?>" title="<?php echo $row_RecordArticleMix['title']; ?>" rel="tipsy_n"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/article/thumb/small_<?php echo GetFileThumbExtend($row_RecordArticleMix['pic']); ?>" alt="<?php echo $row_RecordArticleMix['sdescription']; ?>" alumb="true" _w="70" _h="70"/>
                            <?php } else if ($level == '1') { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("article",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordArticleMix['type1'],'type2'=>$row_RecordArticleMix['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordArticleMix['id']; ?>" title="<?php echo $row_RecordArticleMix['title']; ?>" rel="tipsy_n"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/article/thumb/small_<?php echo GetFileThumbExtend($row_RecordArticleMix['pic']); ?>" alt="<?php echo $row_RecordArticleMix['sdescription']; ?>" alumb="true" _w="70" _h="70"/>
                            <?php } else if ($level == '0') { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("article",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordArticleMix['type1']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordArticleMix['id']; ?>" title="<?php echo $row_RecordArticleMix['title']; ?>" rel="tipsy_n"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/article/thumb/small_<?php echo GetFileThumbExtend($row_RecordArticleMix['pic']); ?>" alt="<?php echo $row_RecordArticleMix['sdescription']; ?>" alumb="true" _w="70" _h="70"/>
                            <?php } else { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("article",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordArticleMix['id']; ?>" title="<?php echo $row_RecordArticleMix['title']; ?>" rel="tipsy_n"><img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/article/thumb/small_<?php echo GetFileThumbExtend($row_RecordArticleMix['pic']); ?>" alt="<?php echo $row_RecordArticleMix['sdescription']; ?>" alumb="true" _w="70" _h="70"/>
                            <?php } ?>
                            </a><span></span></div>
						</div>
					</div>
                    <?php $i++; ?>  
                    <?php } else { ?>
                    <div class="ca-item">
						<div class="ca-item-main">
							<div class="div_table-cell-article-mix">
                            <?php if ($level == '2') { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("article",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordArticleMix['type1'],'type2'=>$row_RecordArticleMix['type2'],'type3'=>$row_RecordArticleMix['type3']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordArticleMix['id']; ?>" title="<?php echo $row_RecordArticleMix['title']; ?>" rel="tipsy_n"><img src="images/article_mix.png" alumb="true" _w="70" _h="70"/>
                            </a><span></span></div>
                            <?php } else if ($level == '1') { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("article",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordArticleMix['type1'],'type2'=>$row_RecordArticleMix['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordArticleMix['id']; ?>" title="<?php echo $row_RecordArticleMix['title']; ?>" rel="tipsy_n"><img src="images/article_mix.png" alumb="true" _w="70" _h="70"/>
                            </a><span></span></div>
                            <?php } else if ($level == '0') { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("article",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','type1'=>$row_RecordArticleMix['type1']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordArticleMix['id']; ?>" title="<?php echo $row_RecordArticleMix['title']; ?>" rel="tipsy_n"><img src="images/article_mix.png" alumb="true" _w="70" _h="70"/>
                            </a><span></span></div>
                            <?php } else { ?>
                            <a href="<?php echo $SiteBaseUrl . url_rewrite("article",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordArticleMix['id']; ?>" title="<?php echo $row_RecordArticleMix['title']; ?>" rel="tipsy_n"><img src="images/article_mix.png" alumb="true" _w="70" _h="70"/>
                            </a><span></span></div>
                            <?php } ?>
						</div>
					</div>
                    <?php $i++; ?>  
                    <?php } ?> 
                    <?php } while ($row_RecordArticleMix = mysqli_fetch_assoc($RecordArticleMix)); ?>
				</div>
			</div>

  </div>
  <!-- 右方工程實績區塊 END -->
<!-- the jScrollPane script -->
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.contentcarousel.js"></script>
<script type="text/javascript">
  $('#ca-container').contentcarousel();
</script>
<script type="text/javascript">
/* 圖片(不)完全按比例自動縮圖 */
jQuery(document).ready(function(){$(window).load(function(){$(".div_table-cell-article-mix img").each(function(){if("true"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");var c=$(this).width(),d=$(this).height(),a=$(this).attr("_w")/c,b=$(this).attr("_h")/d,e=1,e=a>b?b:a;$(this).width(c*e);$(this).height(d*e)}else if("false"==$(this).attr("alumb")){$(this).removeAttr("width");$(this).removeAttr("height");$(this).width();$(this).height();c=$(this).attr("_w");d=$(this).attr("_h");
a=$(this).width();b=$(this).height();if(a>c){var e=a,f=b,b=b*(c/a),a=c;b<d&&(a=e*(d/f),b=d)}$(this).attr({width:a,height:b})}})})});
</script>
<script type="text/javascript">
 $(function() {
   $('a[rel=tipsy_n]').tipsy({fade: true, gravity: 's'});
 });
</script>
<?php } // Show if recordset not empty ?>
<?php
mysqli_free_result($RecordArticleMix);
?>