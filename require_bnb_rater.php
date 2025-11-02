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

$colname_RecordBnbRater = "-1";
if (isset($_GET['id'])) {
  $colname_RecordBnbRater = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordBnbRater = sprintf("SELECT * FROM demo_bnbrater WHERE userid = %s", GetSQLValueString($colname_RecordBnbRater, "int"));
$RecordBnbRater = mysqli_query($DB_Conn, $query_RecordBnbRater) or die(mysqli_error($DB_Conn));
$row_RecordBnbRater = mysqli_fetch_assoc($RecordBnbRater);
$totalRows_RecordBnbRater = mysqli_num_rows($RecordBnbRater);
?>
<style type="text/css">
.number_g{font-size:1.67em;margin-top:-3px;height:18px;width:32px}
.number_s{font-size:3em;font-weight:bold}
div .bnb_inner_board_detailed{margin:0;padding:2px;background-color:#fffaf7;border:1px solid #DDD;height:100%}
</style>
<link rel="stylesheet" href="css/jquery.rater/jquery.rater.css" />
<script type="text/javascript" src="js/jquery.rater/jquery.rater.js"> // 評分</script>
<div class="bnb_inner_board_detailed">
    <table width="99%" border="0" cellspacing="0" cellpadding="0" class="Bnb_Detailed_Right_Board">
          <tr>
            <td width="70" align="center" valign="middle">
            <div style="line-height:60px; vertical-align:central; vertical-align:central;">
            <?php $avgstar=0; // 初始化?>
            <?php do { ?>
                <?php 
                    $avgstartmp = $row_RecordBnbRater['starnumber'] * $row_RecordBnbRater['starvalue']; 
                    $avgstar = $avgstartmp + $avgstar;
                ?>
            <?php } while ($row_RecordBnbRater = mysqli_fetch_assoc($RecordBnbRater)); ?>
            <?php 
                if ($row_RecordBnb['ratercount']!=0) {
                    $str = round($avgstar/$row_RecordBnb['ratercount'], 1);
                    $res=explode(".",$str);
                    //echo $res[0] . $res[1];
                }
            ?>
            <?php 
                if($res[0] == '') {$res[0]=$res[1]=0;}
                if($res[1] == '') {$res[1]=0;}
            ?>
            <span class="number_s"><?php echo $res[0]; ?></span>.<span class="number_g"><?php echo $res[1]; ?></span> 
            </div>
            </td>
            <td>
              <div id="bnb_rater"></div>
                <div style="color:#666666; font-size:11px; text-align: left;">
                    <?php if ($row_RecordBnb['ratercount']!=0) { ?>
              <!--平均：<?php echo round($avgstar/$row_RecordBnb['ratercount'], 1); ?>顆星
                    <br />-->
                    <?php echo "評分人數"; //評分人數： ?><?php echo $row_RecordBnb['ratercount']; ?>
                    <?php } else { ?>
                    <?php echo "尚未評分"; //尚未評分 ?>
                    <?php } ?>
                    &nbsp;<?php echo "瀏覽次數"; //瀏覽次數： ?><?php echo $row_RecordBnb['visit']; ?>
                </div>
            </td>
          </tr>
    </table>
</div>
<script type="text/javascript">
//$(function(){
	//var text = {1:'尚可',2:'普通',3:'滿意',4:'很滿意',5:'太棒了'};
	var options	= {
		image : 'images/star.png', 
		<?php if ($row_RecordBnbRater['ratercount']!=0) { ?>
		value   : <?php echo intval($avgstar/$row_RecordBnbRater['ratercount']) ?>, // 預設值
		<?php } ?>
		min : 1,
		max : 5, // 星星個數 
		step : 1, // 半個星星
		url	: 'ajax/bnb_rater.php?id=<?php echo $_GET['id']; ?>',
		method	:'GET',
		after_ajax	: function(ret) {
			alert(ret.ajax);
		},
		// 點選後不可更改
		after_click : function(ret) {  
			this.value  = ret.value;  
			this.enabled= false;  
			$('#bnb_rater').rater(this);  
    	}/*,
		title_format : function(val) {
			var title = text[val];
			return title;
		}*/
	}
	$('#bnb_rater').rater(options);
//});
</script>
<?php
mysqli_free_result($RecordBnbRater);
?>
