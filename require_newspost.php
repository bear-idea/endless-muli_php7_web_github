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

$maxRows_RecordNewsPost = 30;
$pagePost = 0;
if (isset($_GET['pagePost'])) {
  $pagePost = $_GET['pagePost'];
}
$startRow_RecordNewsPost = $pagePost * $maxRows_RecordNewsPost;

$colname_RecordNewsPost = "-1";
if (isset($_GET['id'])) {
  $colname_RecordNewsPost = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordNewsPost = sprintf("SELECT * FROM demo_newspost WHERE pid = %s ORDER BY id DESC", GetSQLValueString($colname_RecordNewsPost, "int"));
$query_limit_RecordNewsPost = sprintf("%s LIMIT %d, %d", $query_RecordNewsPost, $startRow_RecordNewsPost, $maxRows_RecordNewsPost);
$RecordNewsPost = mysqli_query($DB_Conn, $query_limit_RecordNewsPost) or die(mysqli_error($DB_Conn));
$row_RecordNewsPost = mysqli_fetch_assoc($RecordNewsPost);
if (isset($_GET['totalRows_RecordNewsPost'])) {
  $totalRows_RecordNewsPost = $_GET['totalRows_RecordNewsPost'];
} else {
  $all_RecordNewsPost = mysqli_query($DB_Conn, $query_RecordNewsPost);
  $totalRows_RecordNewsPost = mysqli_num_rows($all_RecordNewsPost);
}
$totalPages_RecordNewsPost = ceil($totalRows_RecordNewsPost/$maxRows_RecordNewsPost)-1;

$queryString_RecordNewsPost = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pagePost") == false && 
        stristr($param, "totalRows_RecordNewsPost") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordNewsPost = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordNewsPost = sprintf("&totalRows_RecordNewsPost=%d%s", $totalRows_RecordNewsPost, $queryString_RecordNewsPost);
?>
<?php
/*********************************************************************
 # 主頁面留言訊息
 *********************************************************************/
?>
<?php 
if ($totalRows_RecordNewsPost > 0) { // Show if recordset not empty 
?>
<span id="tishi"></span>        
<?php $floor = $totalRows_RecordNewsPost ?>
<div id="pagetxt"> 
       

                  <?php do { ?>
                  <div style="border: 1px solid #DDD; margin-bottom:5px; padding:5px;">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
                    <tr>
                      <td width="30" valign="top"><h4><strong><?php echo '#' . $floor; ?></strong></h4></td>
                      <td valign="top"><?php echo '發表人' ?>： <font color="#2865A2"><strong><?php echo $row_RecordNewsPost['author']; ?></strong></font></td>
                      <td width="50%" align="right" valign="top"><font color="#666666"><?php echo date('Y-m-d',strtotime($row_RecordNewsPost['postdate'])); ?>&nbsp;&nbsp;<?php echo date('g:i A',strtotime($row_RecordNewsPost['postdate'])); ?>&nbsp;&nbsp;
                          </font></td>
                    </tr>
                    </table>                      
                    <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
                      <tr>
                        <td valign="top">
                        <?php echo nl2br($row_RecordNewsPost['content']);?>                          
						<?php require("require_newsreply.php");?>
                        </td>
                      </tr>
                    </table>
                    <?php $floor--; ?>
                  </div>
                    <?php } while ($row_RecordNewsPost = mysqli_fetch_assoc($RecordNewsPost)); ?>   
</div> 
<?php if (ceil($totalRows_RecordNewsPost/$maxRows_RecordNewsPost <= 1)) { ?>
<div id="NewsPostPage" style="display:none;"></div> 
<?php } else { ?>
<div id="NewsPostPage"></div> 
<?php } ?>
<?php 
} // Show if recordset not empty 
#
# ============== [/if] ============== #
?>
<div id='Tcha' style="padding:10px; background-color:#f5f5f5; border: 1px solid #CCC;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><span id="NewsPostAuthor">
      <input name="author" type="text" id="author" maxlength="20" />您的暱稱...
      <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
    </tr>
  <tr>
    <td width="100"><span id="sprytextarea1">
      <textarea name="content" cols="50" rows="5" id="content" value=""></textarea>留個言吧...
      <span class="textareaRequiredMsg">欄位不可為空。</span><span class="textareaMaxCharsMsg">已超出字元數目的最大值。</span></span>      <div class="QapTcha"></div> </td>
  </tr>
  <tr>
    <td>
      <input type="submit" name="button" id="button" value="送出問題"/>
      <input name="pid" type="hidden" id="pid" value="<?php echo $_GET['id']; ?>" />    
      <input name="userid" type="hidden" id="userid" value="<?php echo $_SESSION['userid']; ?>" /></td>
    </tr>
</table>
</div>

<!--这里不需要form,因为提交时call一个函数-->
<script type="text/javascript"> 
$(function(){ 
    $("#NewsPostPage").paginate({ 
        count         : <?php echo ceil($totalRows_RecordNewsPost/$maxRows_RecordNewsPost); ?>, 
        start         : 1, 
        display     : 5, 
        border                    : true, 
        border_color            : '#BEF8B8', 
        text_color              : '#79B5E3', 
        background_color        : '#E3F2E1',     
        border_hover_color        : '#68BA64', 
        text_hover_color          : '#2573AF', 
        background_hover_color    : '#CAE6C6',  
        images                    : false, 
        mouse                    : 'press', 
        onChange                 : function(page){ 
                                    $("#pagetxt").load("ajax/newspost_page.php?pid=<?php echo $_GET['id']; ?>&id="+page); 
                                 } 
    }); 
    //$("#pagetxt").ajaxSend(function(event, request, settings){
        $(this).html("<img src='images/loading.gif' />");
    //});
}); 
</script> 
<script type="text/javascript">
$(function() {
    $("#button").click(function() {
        //var params = $('input').serialize();
        var url = "ajax/news_reply.php";
 
        $.ajax({
            type: "post",
            url: url,
			data: "content="+$("#content").val()+"&pid="+$("#pid").val()+"&author="+$("#author").val()+"&userid="+$("#userid").val(),    //输入框writer中的值作为提交的数据 
            //dataType: "json",
            //data: params,
            success: function(msg){
				if(msg != ''){
					alert("提問已送出!!");                     //如果有必要，可以把msg变量的值显示到某个DIV元素中
					window.location.reload();
                	//var tishi = "您提交的姓名为：" + msg.content +
                	//"<br /> 您提交的密码为：" + msg.password;
					$('#button').attr('disabled', 'disabled'); // 停用送出紐
                	$("#tishi").html(msg);
				}
				else{
					alert("請確認您填寫的資料!!");
				}
                //$("#tishi").css({color: "green"});
            }
        });
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
var sprytextfield2 = new Spry.Widget.ValidationTextField("NewsPostAuthor", "none", {validateOn:["blur"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur"], maxChars:150});
</script> 
<?php
mysqli_free_result($RecordNewsPost);
?>
