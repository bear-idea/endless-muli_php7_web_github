<?php require_once('Connections/DB_Conn.php'); ?>
<?php if (!isset($_SESSION)) {
  session_start();
}?>
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

$maxRows_RecordBlogPost = 30;
$pageNum_RecordBlogPost = 0;
if (isset($_GET['pageNum_RecordBlogPost'])) {
  $pageNum_RecordBlogPost = $_GET['pageNum_RecordBlogPost'];
}
$startRow_RecordBlogPost = $pageNum_RecordBlogPost * $maxRows_RecordBlogPost;

$colname_RecordBlogPost = "-1";
if (isset($_GET['id'])) {
  $colname_RecordBlogPost = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordBlogPost = sprintf("SELECT * FROM demo_blogpost WHERE pid = %s ORDER BY id DESC", GetSQLValueString($colname_RecordBlogPost, "int"));
$query_limit_RecordBlogPost = sprintf("%s LIMIT %d, %d", $query_RecordBlogPost, $startRow_RecordBlogPost, $maxRows_RecordBlogPost);
$RecordBlogPost = mysqli_query($DB_Conn, $query_limit_RecordBlogPost) or die(mysqli_error($DB_Conn));
$row_RecordBlogPost = mysqli_fetch_assoc($RecordBlogPost);
if (isset($_GET['totalRows_RecordBlogPost'])) {
  $totalRows_RecordBlogPost = $_GET['totalRows_RecordBlogPost'];
} else {
  $all_RecordBlogPost = mysqli_query($DB_Conn, $query_RecordBlogPost);
  $totalRows_RecordBlogPost = mysqli_num_rows($all_RecordBlogPost);
}
$totalPages_RecordBlogPost = ceil($totalRows_RecordBlogPost/$maxRows_RecordBlogPost)-1;

$queryString_RecordBlogPost = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RecordBlogPost") == false && 
        stristr($param, "totalRows_RecordBlogPost") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecordBlogPost = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecordBlogPost = sprintf("&totalRows_RecordBlogPost=%d%s", $totalRows_RecordBlogPost, $queryString_RecordBlogPost);
?>
<?php
/*********************************************************************
 # 主頁面留言訊息
 *********************************************************************/
?>
<?php 
if ($totalRows_RecordBlogPost > 0) { // Show if recordset not empty 
?>

<span id="tishi"></span>        
<?php $floor = $totalRows_RecordBlogPost ?>
<div id="pagetxt"> 
       

                  <?php do { ?>
                  <div style="border: 1px solid #DDD; margin-bottom:5px; padding:5px;">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
                    <tr>
                      <td width="30" valign="top"><h4><strong><?php echo '#' . $floor; ?></strong></h4></td>
                      <td valign="top"><?php echo '發表人' ?>： <font color="#2865A2"><strong><?php echo $row_RecordBlogPost['author']; ?></strong></font></td>
                      <td width="50%" align="right" valign="top"><font color="#666666"><?php echo date('Y-m-d',strtotime($row_RecordBlogPost['postdate'])); ?>&nbsp;&nbsp;<?php echo date('g:i A',strtotime($row_RecordBlogPost['postdate'])); ?>&nbsp;&nbsp;
                          </font></td>
                    </tr>
                    </table>                      
                    <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="TB_General_style00">
                      <tr>
                        <td valign="top">
                        <?php if ($row_RecordBlogPost['blogauthor']== $_SESSION['wshopforckeditor'] || $row_RecordBlogPost['indicate']=='1' || ($row_RecordBlogPost['author'] == $_SESSION['wshopforckeditor'])){ ?>
                        <?php echo nl2br($row_RecordBlogPost['content']);?>                          
						<?php require("require_blogreply.php");?>
                        <?php } else { ?>
                        <div style="color:#F00;">*** 私密留言 ***</div>
                        <?php } ?>
                        </td>
                      </tr>
                    </table>
                    <?php $floor--; ?>
                  </div>
                    <?php } while ($row_RecordBlogPost = mysqli_fetch_assoc($RecordBlogPost)); ?>   
</div> 
<?php if (ceil($totalRows_RecordBlogPost/$maxRows_RecordBlogPost <= 1)) { ?>
<div id="BlogPostPage" style="display:none;"></div> 
<?php } else { ?>
<div id="BlogPostPage"></div> 
<?php } ?>
<?php 
} // Show if recordset not empty 
#
# ============== [/if] ============== #
?>
<?php if ($_SESSION['MM_Username_' . $_GET['wshop']] != '' && ($_SESSION['MM_Username_' . $_GET['wshop']] == 'member' || $_SESSION['MM_Username_' . $_GET['wshop']] == 'superadmin')) { ?>
<div id='Tcha' style="padding:10px; background-color:#f5f5f5; border: 1px solid #CCC;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><input name="radio" type="radio" id="author" value="<?php echo $_SESSION['wshopforckeditor']; ?>" checked="checked" />
    使用會員帳號(<?php echo $_SESSION['wshopforckeditor']; ?>)
    
      <label for="author"></label></td>
    </tr>
    <tr>
    <td><span id="sprytextfield1">
    <label for="remail"></label>
    <input name="remail" type="text" id="remail" maxlength="200" />
    您的信箱...
<span class="textfieldInvalidFormatMsg">格式無效。</span></span></td>
  </tr>
  <tr>
    <td><span id="sprytextfield3">
    <label for="reurl"></label>
    <input name="reurl" type="text" id="reurl" maxlength="200" />
    您的網址...
<span class="textfieldInvalidFormatMsg">格式無效。</span></span></td>
  </tr>
  <tr>
    <td><p>
      <label>
        <input name="indicate" type="radio" id="indicate_0" value="1" checked="checked" />
        公開留言</label>
      
      <label>
        <input type="radio" name="indicate" value="0" id="indicate_1" />
        私密留言</label>
      <br />
    </p></td>
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
      <input name="userid" type="hidden" id="userid" value="<?php echo $_SESSION['userid']; ?>" />
      </td>
    </tr>
  
</table>
</div>
<?php } else { ?>
<div style="padding:10px; background-color:#f5f5f5; border: 1px solid #CCC; color:#F00;">
	此文章限定會員才能回覆！！請先登入會員！！
</div>
<?php } ?>
<script type="text/javascript">
<!--
function CheckFields()
{	
	var email = $('#remail').attr('value');
if(email!=''){
/*	alert('請輸入電子信箱');
	$('#remail').focus();
	return false;
}else{*/
	var emailRegxp = /[\w-]+@([\w-]+\.)+[\w-]+/; //2009-2-12更正為比較簡單的驗證
	if (emailRegxp.test(email) != true){
		alert('電子信箱格式錯誤');
		$('#remail').focus();
		$('#remail').select();
		return false;
	}
}
return true;
}
//-->
</script>
<!--这里不需要form,因为提交时call一个函数-->
<script type="text/javascript"> 
$(function(){ 
    $("#BlogPostPage").paginate({ 
        count         : <?php echo ceil($totalRows_RecordBlogPost/$maxRows_RecordBlogPost); ?>, 
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
                                    $("#pagetxt").load("ajax/blogpost_page.php?pid=<?php echo $_GET['id']; ?>&id="+page); 
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
        var url = "ajax/blog_reply.php";
 
        $.ajax({
            type: "post",
            url: url,
			data: "content="+$("#content").val()+"&pid="+$("#pid").val()+"&author="+$("#author").val()+"&remail="+$("#remail").val()+"&reurl="+$("#reurl").val()+"&indicate="+$("#indicate").val()+"&userid="+$("#userid").val(),
            //dataType: "json",
            //data: params,
            success: function(msg){
				if(msg != '' && CheckFields() == true){
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
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur"], maxChars:150});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "email", {validateOn:["blur"], isRequired:false});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "url", {validateOn:["blur"], isRequired:false});
</script> 
<?php
mysqli_free_result($RecordBlogPost);
?>
