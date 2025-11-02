<?php require_once("inc_permission.php"); ?>
<style>
#LeftMenuLogin .acc
{
	width: 100px;
	margin-right: 3px;
	margin-left: 3px;
	height: 14px;
}
#LeftMenuLogin #LoginButtom
{
	/*background-image: url(images/login.png);
	background-repeat: no-repeat;*/
	height: 50px;
	width: 50px;
	margin: 0px;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php if ($_SESSION['MM_Username_' . $_GET['wshop']] == '' || $_SESSION['MM_UserGroup_' . $_GET['wshop']] == 'superadmin') { ?>
<div style="border: 1px solid #CCC; padding:3px; margin-bottom:5px;">
<form action="<?php echo $loginFormAction; ?>" method="POST" name="LeftMenuLogin" id="LeftMenuLogin">
<table width="200" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="35">帳號</td>
    <td><label for="username"></label>
      <input name="username" type="text" id="username" maxlength="20" class="acc"></td>
    <td width="70" rowspan="2" align="center" valign="middle"><input type="image" src="images/login.png" id="LoginButtom"></td>
  </tr>
  <tr>
    <td>密碼</td>
    <td><label for="psw"></label>
      <input name="psw" type="password" id="psw" maxlength="20" class="acc"></td>
  </tr>
  <tr>
    <td colspan="3">»註冊會員 »忘記密碼</td>
    </tr>
</table>
</form>
</div>
<?php } else if ($_SESSION['MM_UserGroup_' . $_GET['wshop']] == 'dealer'){ ?>
<div style="border: 1px solid #CCC; padding:3px; margin-bottom:5px;">
<table width="200" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><span style="color:#0000FF;"><?php echo $_SESSION['MM_Username_' . $_GET['wshop']];?></span> ，您好 </td>
  </tr>
  <tr>
    <td>»<a href="dealer.php?Opt=editpage&amp;tp=Dealer&amp;amplang=<?php echo $_SESSION['lang'] ?>">修改資料</a> »<a href="<?php echo $logoutAction ?>">登出</a></td>
  </tr>
</table>
</div>
<?php } ?>
<script type="text/javascript">
$(function () {// 圖片顯影
$('#LoginButtom').hover(
function() {$(this).fadeTo("fast", 0.5);},
function() {$(this).fadeTo("fast", 1);
});
});
</script>
