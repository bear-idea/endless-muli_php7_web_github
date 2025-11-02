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

$maxRows_RecordProductPopularityLeft = 6;
$pagePopularityLeft = 0;
if (isset($_GET['pagePopularityLeft'])) {
  $pagePopularityLeft = $_GET['pagePopularityLeft'];
}
$startRow_RecordProductPopularityLeft = $pagePopularityLeft * $maxRows_RecordProductPopularityLeft;

$colnamelang_RecordProductPopularityLeft = "zh-tw";
if (isset($_GET['lang'])) {
  $colnamelang_RecordProductPopularityLeft = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductPopularityLeft = sprintf("SELECT * FROM demo_product WHERE lang = %s ORDER BY visit DESC", GetSQLValueString($colnamelang_RecordProductPopularityLeft, "text"));
$query_limit_RecordProductPopularityLeft = sprintf("%s LIMIT %d, %d", $query_RecordProductPopularityLeft, $startRow_RecordProductPopularityLeft, $maxRows_RecordProductPopularityLeft);
$RecordProductPopularityLeft = mysqli_query($DB_Conn, $query_limit_RecordProductPopularityLeft) or die(mysqli_error($DB_Conn));
$row_RecordProductPopularityLeft = mysqli_fetch_assoc($RecordProductPopularityLeft);

if (isset($_GET['totalRows_RecordProductPopularityLeft'])) {
  $totalRows_RecordProductPopularityLeft = $_GET['totalRows_RecordProductPopularityLeft'];
} else {
  $all_RecordProductPopularityLeft = mysqli_query($DB_Conn, $query_RecordProductPopularityLeft);
  $totalRows_RecordProductPopularityLeft = mysqli_num_rows($all_RecordProductPopularityLeft);
}
$totalPages_RecordProductPopularityLeft = ceil($totalRows_RecordProductPopularityLeft/$maxRows_RecordProductPopularityLeft)-1;

// Trim by length (by FELIXONE.it)
/*function TrimByLength($str, $len, $word) {
  $end = "";
  if (strlen($str) > $len) $end = "...";
  $str = mb_substr($str, 0, $len, "UTF-8");
  if ($word) $str = substr($str,0,strrpos($str," ")+1);
  return $str.$end;
}*/
?>

<style type="text/css">
.board_popularity{
	border: 1px solid #DDD;
}
.ct_left_board_popularity_title{
	padding: 5px;	/*text-align: center;*/
	color: #FFF;
	background-color: #333;
	margin-top: 5px;
	margin-right: 0px;
	margin-bottom: 0px;
	margin-left: 0px;
    }

.ct_board_popularity{
	padding: 5px;
	border-top-width: 0px;
	border-right-width: 0px;
	border-bottom-width: 1px;
	border-left-width: 0px;
	border-top-style: dotted;
	border-right-style: dotted;
	border-bottom-style: dotted;
	border-left-style: dotted;
	border-top-color: #DDD;
	border-right-color: #DDD;
	border-bottom-color: #DDD;
	border-left-color: #DDD;	/*margin: 5px;	
	text-align: center;*/
}

div .photoFram_Block_glossy, .div_table-cell_popularity{
	overflow:hidden;
	height: 50px; /* 設定區塊高度 */
	width: 50px;
	margin: 5px;
}

.product_inner_board_context_popularity{
	padding: 5px;
	text-align: left;
}


/* 圖片hide外框 */
.div_table-cell_popularity{
	text-align: center;
	vertical-align: middle;
	/*background-color: #000;*/
	border: 1px solid #DDD;	/*display:table-cell; /* 將此Div區塊當成表格 FF有BUG*/
}


/* IE6 hack */
.div_table-cell_popularity span{
	height:100%;
	display:inline-block;
	background-image: none;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	}

/* 讓table-cell下的所有元素都居中 */
.div_table-cell_popularity *{ vertical-align:middle;}
}
</style>
<div class="columns on-1 ct_left_board_popularity_title">
  <div class="container">
  	人氣商品
  </div>
</div>   
<div class="board_popularity">
<?php $num = $startRow_RecordProductPopularityLeft + 1 ?>
  <?php do { ?>   
<div class="columns on-2 same-height" style="position:relative;">
  <div class="container ct_board_popularity">
    <div class="column fixed sidebar" style="width:60px">
      <div class="container full-height">
       <div style="position:absolute">
      <?php
			switch($num)
			{
				case "1":
					echo"<img src=\"images/king_01.png\" width=\"15\" height=\"15\" align=\"absmiddle\" />";		
					break;
				case "2":
					echo"<img src=\"images/king_02.png\" width=\"15\" height=\"15\" align=\"absmiddle\" />";			
					break;
				case "3":
					echo"<img src=\"images/king_03.png\" width=\"15\" height=\"15\" align=\"absmiddle\" />";				
					break;
				default:
				    echo"<img src=\"images/1x1_alpha_block.png\" width=\"15\" height=\"15\" align=\"absmiddle\" />";
					break;
			}
		?>
      </div> 
         		    <div class="div_table-cell_popularity">
         		      <?php if ($row_RecordProductPopularityLeft['pic'] != "") { ?>	 
         		      <a href="product.php?Opt=detailed&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;tp=Product&amp;level=<?php echo $level; ?>&amp;type1=<?php echo $row_RecordProductPopularityLeft['type1']; ?>&amp;type2=<?php echo $row_RecordProductPopularityLeft['type2']; ?>&amp;type3=<?php echo $row_RecordProductPopularityLeft['type3']; ?>&amp;subitem_id=<?php echo $_GET['subitem_id']; ?>&amp;id=<?php echo $row_RecordProductPopularityLeft['id']; ?>" title="<?php echo $row_RecordProductPopularityLeft['name']; ?>"><img src="upload/image/product/<?php echo $row_RecordProductPopularityLeft['pic']; ?>" alt="<?php echo $row_RecordProductPopularityLeft['sdescription']; ?>" alumb="true" _w="50" _h="50"/></a><span></span>
         		      <?php } else { ?>      
         		      <a><img src="images/100x80_noimage.jpg" width="100" height="80"/></a><span></span>
         		      <?php } ?>
       		        </div>    
      </div>
    </div>
    <div class="column elastic content">
        <div class="container full-height">
          <div class="product_inner_board_context_popularity"> 
         		    <a href="product.php?Opt=detailed&amp;lang=<?php echo $_SESSION['lang']; ?>&amp;tp=Product&amp;level=<?php echo $level; ?>&amp;type1=<?php echo $row_RecordProductPopularityLeft['type1']; ?>&amp;type2=<?php echo $row_RecordProductPopularityLeft['type2']; ?>&amp;type3=<?php echo $row_RecordProductPopularityLeft['type3']; ?>&amp;subitem_id=<?php echo $_GET['subitem_id']; ?>&amp;id=<?php echo $row_RecordProductPopularityLeft['id']; ?>"><span style="color: #666"><u><?php echo $row_RecordProductPopularityLeft['name']; ?><?php //echo TrimByLength($row_RecordProductPopularityLeft['name'], 10, false); ?></u></span></a>
         	 </div>  
        </div>
     </div>
    </div>        
    </div>
    <?php $num++; ?>
    <?php } while ($row_RecordProductPopularityLeft = mysqli_fetch_assoc($RecordProductPopularityLeft)); ?>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
/* <img src="sample.jpg" alumb="true" _w="300" _h="300" width="500"/> */
/* 圖片完全按比例自動縮圖 */
    $(window).load(function(){
	$(".div_table-cell_popularity img").each(function(i){
		if($(this).attr("alumb")=="true"){
			//移除目前設定的影像長寬
			$(this).removeAttr('width');
			$(this).removeAttr('height');
 
			//取得影像實際的長寬
			var imgW = $(this).width();
			var imgH = $(this).height();
 
			//計算縮放比例
			var w=$(this).attr("_w")/imgW;
			var h=$(this).attr("_h")/imgH;
			var pre=1;
			if(w>h){
				pre=h;
			}else{
				pre=w;
			}
 
			//設定目前的縮放比例
			$(this).width(imgW*pre);
			$(this).height(imgH*pre);
		}
/* 圖片不完全按比例自動縮圖 */
		else if($(this).attr("alumb")=="false"){	
			//移除目前設定的影像長寬
			$(this).removeAttr('width');
			$(this).removeAttr('height');
 
			//取得影像實際的長寬
			var w = $(this).width();
			var h = $(this).height();
 
			//計算縮放比例
			var x=$(this).attr("_w");
			var y=$(this).attr("_h");
			
			var w=$(this).width(), h=$(this).height();//
			if (w > x) { 
				var w_original=w, h_original=h;
				h = h * (x / w); 
				w = x; 
				if (h < y) { 
					w = w_original * (y / h_original); 
					h = y; 
				}
			}
			$(this).attr({width:w,height:h});
			}
	});
	});
});
</script>
<?php
mysqli_free_result($RecordProductPopularityLeft);
?>
