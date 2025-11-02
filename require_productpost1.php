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

$maxRows_RecordProductPost = 5;
$pagePost = 0;
if (isset($_GET['pagePost'])) {
  $pagePost = $_GET['pagePost'];
}
$startRow_RecordProductPost = $pagePost * $maxRows_RecordProductPost;

$colname_RecordProductPost = "-1";
if (isset($_GET['id'])) {
  $colname_RecordProductPost = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordProductPost = sprintf("SELECT * FROM demo_productpost WHERE pid = %s ORDER BY id DESC", GetSQLValueString($colname_RecordProductPost, "int"));
$query_limit_RecordProductPost = sprintf("%s LIMIT %d, %d", $query_RecordProductPost, $startRow_RecordProductPost, $maxRows_RecordProductPost);
$RecordProductPost = mysqli_query($DB_Conn, $query_limit_RecordProductPost) or die(mysqli_error($DB_Conn));
$row_RecordProductPost = mysqli_fetch_assoc($RecordProductPost);

if (isset($_GET['totalRows_RecordProductPost'])) {
  $totalRows_RecordProductPost = $_GET['totalRows_RecordProductPost'];
} else {
  $all_RecordProductPost = mysqli_query($DB_Conn, $query_RecordProductPost);
  $totalRows_RecordProductPost = mysqli_num_rows($all_RecordProductPost);
}
$totalPages_RecordProductPost = ceil($totalRows_RecordProductPost/$maxRows_RecordProductPost)-1;

$queryString_RecordProductPost = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pagePost") == false && 
        stristr($param, "totalRows_RecordProductPost") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordProductPost = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordProductPost = sprintf("&totalRows_RecordProductPost=%d%s", $totalRows_RecordProductPost, $queryString_RecordProductPost);
?>
<?php
/*********************************************************************
 # 主頁面留言訊息
 *********************************************************************/
?>
<?php 
if ($totalRows_RecordProductPost > 0) { // Show if recordset not empty 
?>     
<div id="pagetxt">    
<?php $floor = $totalRows_RecordProductPost ?>
<span id="tishi"></span>
                  <?php do { ?>
                  <div style="border: 1px solid #DDD; margin-bottom:5px; padding:5px;">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
                    <tr>
                      <td width="30" valign="top"><h4><strong><?php echo '#' . $floor; ?></strong></h4></td>
                      <td valign="top"><?php echo '發表人' ?>： <font color="#2865A2"><strong><?php echo $row_RecordProductPost['author']; ?></strong></font></td>
                      <td width="50%" align="right" valign="top"><font color="#666666"><?php echo date('Y-m-d',strtotime($row_RecordProductPost['postdate'])); ?>&nbsp;&nbsp;<?php echo date('g:i A',strtotime($row_RecordProductPost['postdate'])); ?>&nbsp;&nbsp;
                          </font></td>
                    </tr>
                    </table>                      
                    <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
                      <tr>
                        <td valign="top">
                        <?php echo nl2br($row_RecordProductPost['content']);?>                          
						<?php require("require_productreply.php");?>
                        </td>
                      </tr>
                    </table>
                    <?php $floor--; ?>
                  </div>
                    <?php } while ($row_RecordProductPost = mysqli_fetch_assoc($RecordProductPost)); ?>   
</div>
<div id="ProductPostPage"></div>
<?php 
} // Show if recordset not empty 
#
# ============== [/if] ============== #
?>
<div id='Tcha' style="padding:10px; background-color:#f5f5f5; border: 1px solid #CCC;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><span id="ProductPostAuthor">
      <input name="author" type="text" id="author" maxlength="20" />
      <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
    </tr>
  <tr>
    <td width="100"><span id="sprytextarea1">
      <textarea name="content" cols="50" rows="5" id="content" value=""></textarea>
      <span class="textareaRequiredMsg">欄位不可為空。</span><span class="textareaMinCharsMsg">未達到字元數目的最小值。</span><span class="textareaMaxCharsMsg">已超出字元數目的最大值。</span></span>      <div class="QapTcha"></div> </td>
  </tr>
  <tr>
    <td>
      <input type="submit" name="button" id="button" value="送出問題"/>
      <input name="pid" type="hidden" id="pid" value="<?php echo $_GET['id']; ?>" />
      <input name="postdate" type="hidden" value="<?php echo date("Y-m-d H-i-s"); ?>" />    </td>
    </tr>
</table>
</div>
<!--这里不需要form,因为提交时call一个函数-->
<script type="text/javascript">
$(function() {
    $("#button").click(function() {
        //var params = $('input').serialize();
        var url = "ajax/product_reply.php";
 
        $.ajax({
            type: "post",
            url: url,
			data: "content="+$("#content").val()+"&pid="+$("#pid").val(),    //输入框writer中的值作为提交的数据 
            //dataType: "json",
            //data: params,
            success: function(msg){
				alert("提問已送出!!");                     //如果有必要，可以把msg变量的值显示到某个DIV元素中
                //var tishi = "您提交的姓名为：" + msg.content +
                //"<br /> 您提交的密码为：" + msg.password;
                $("#tishi").html(msg);
                //$("#tishi").css({color: "green"});
            }
        });
    });
 
});
</script>
<script type="text/javascript"> 
$(function(){ 
    $("#ProductPostPage").paginate({ 
        count         : <?php echo $page;?>,// 總記錄數 通過PHP計算出總頁數$page
        start         : 1, // 開始顯示的頁數
        display     : 5, // 分頁條顯示的頁數
        border                    : true, // 是否顯示頁碼的邊框。 (true/false)
        border_color            : '#BEF8B8', // 設置邊框的顏色
        text_color              : '#79B5E3', 
        background_color        : '#E3F2E1',     
        border_hover_color        : '#68BA64', 
        text_hover_color          : '#2573AF', 
        background_hover_color    : '#CAE6C6',  
        images                    : false, // 是否顯示頁碼導航箭頭（方向箭頭）(true/false)
        mouse                    : 'press', // 設置為'press'時，當鼠標滑嚮導航箭頭時，頁碼隨之滾動；設置為'slide'時，鼠標單擊一次導航箭頭頁碼滾動一次。
        onChange                 : function(page){ // 當單擊頁碼時，回調函數.
                                    $("#pagetxt").load("productpost_page.php?id="+page); 
                                 } 
    }); 
}); 
</script>  
<script type="text/javascript">
$(document).ready(function(){
	$('.QapTcha').QapTcha({
		txtLock : '移動按鈕拖曳至右方以解鎖按鈕',
		txtUnlock : '按鈕解鎖',
		disabledSubmit : true,
		autoRevert : true,
		PHPfile : 'Qaptcha.jquery.php'
	});
  });
var sprytextfield2 = new Spry.Widget.ValidationTextField("ProductPostAuthor", "none", {validateOn:["blur"], hint:"您的暱稱..."});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur"], minChars:10, maxChars:150, hint:"留個言吧..."});
</script> 
<?php
mysqli_free_result($RecordProductPost);
?>
