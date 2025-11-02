<?php require_once('../Connections/DB_Conn.php'); ?>
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

/* 取得類別列表 */
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpLogoListType = "SELECT * FROM demo_tmpitem WHERE list_id = 6";
$RecordTmpLogoListType = mysqli_query($DB_Conn, $query_RecordTmpLogoListType) or die(mysqli_error($DB_Conn));
$row_RecordTmpLogoListType = mysqli_fetch_assoc($RecordTmpLogoListType);
$totalRows_RecordTmpLogoListType = mysqli_num_rows($RecordTmpLogoListType);

$colid_RecordTmpLogo = "-1";
if (isset($_GET['id_edit'])) {
  $colid_RecordTmpLogo = $_GET['id_edit'];
}
$coluserid_RecordTmpLogo = "-1";
if (isset($w_userid)) {
  $coluserid_RecordTmpLogo = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordTmpLogo = sprintf("SELECT * FROM demo_tmplogo WHERE id=%s && userid=%s", GetSQLValueString($colid_RecordTmpLogo, "int"),GetSQLValueString($coluserid_RecordTmpLogo, "int"));
$RecordTmpLogo = mysqli_query($DB_Conn, $query_RecordTmpLogo) or die(mysqli_error($DB_Conn));
$row_RecordTmpLogo = mysqli_fetch_assoc($RecordTmpLogo);
$totalRows_RecordTmpLogo = mysqli_num_rows($RecordTmpLogo);
?>
<div>
    <div>
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">選擇Logo 語系 [<?php echo $langname; ?>
編輯介面]</font><span class="Form_Caption_Word">(</span><span class="Form_Required_Item">*</span><span class="Form_Caption_Word">為必填項目)</span></strong>
</h4>
</td>
</tr>
</table>

<form action="require_manage_tmplogo_add.php" method="post" name="form_TmpLogo" id="form_TmpLogo">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
    <tr>
      <td align="right">名稱：</td>
      <td><?php echo $row_RecordTmpLogo['name']; ?></td>
    </tr>
    <tr>
      <td width="100" align="right">語系選擇：</td>
      <td>
      <?php if ($row_RecordTmpLogo['logotype'] == 0) { ?>
      <span class = "InnerPage" style="float:none"><?php //if ($LangChooseZHTW == 1) { // 當目前使用者不為作者則不能修改?><a href="uplod_tmplogo_tw.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>" class="colorbox_iframe_cd" data-original-title="修改繁體Logo" data-toggle="tooltip" data-placement="top"><i class="fa fa-language"></i> 繁體Logo圖片</a><?php //} ?>
        <?php if ($LangChooseEN == 1) { // 當目前使用者不為作者則不能修改?><a href="uplod_tmplogo_en.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>" class="colorbox_iframe_cd" data-original-title="修改英文Logo" data-toggle="tooltip" data-placement="top"><i class="fa fa-language"></i> 英文Logo圖片</a><?php } ?>
        <?php if ($LangChooseZHCN == 1) { // 當目前使用者不為作者則不能修改?><a href="uplod_tmplogo_cn.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>" class="colorbox_iframe_cd" data-original-title="修改簡體Logo" data-toggle="tooltip" data-placement="top"><i class="fa fa-language"></i> 簡體Logo圖片</a><?php } ?></span>
        <?php } else { ?>
        <span class = "InnerPage" style="float:none"><?php //if ($LangChooseZHTW == 1) { // 當目前使用者不為作者則不能修改?><a href="uplod_tmplogo_word_tw.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>" class="colorbox_iframe_cd" data-original-title="修改繁體Logo" data-toggle="tooltip" data-placement="top"><i class="fa fa-language"></i> 繁體Logo文字</a><?php //} ?>
        <?php if ($LangChooseEN == 1) { // 當目前使用者不為作者則不能修改?><a href="uplod_tmplogo_word_en.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>" class="colorbox_iframe_cd" data-original-title="修改英文Logo" data-toggle="tooltip" data-placement="top"><i class="fa fa-language"></i> 英文Logo文字</a><?php } ?>
        <?php if ($LangChooseZHCN == 1) { // 當目前使用者不為作者則不能修改?><a href="uplod_tmplogo_word_cn.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>" class="colorbox_iframe_cd" data-original-title="修改簡體Logo" data-toggle="tooltip" data-placement="top"><i class="fa fa-language"></i> 簡體Logo文字</a><?php } ?></span>
        <?php } ?>
        </td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td><input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
        <input name="id" type="hidden" id="id" value="<?php echo $_GET['id_edit']; ?>" /></td>
    </tr>
  </table>
</form>

</div>
</div>
<script type="text/javascript">
$(document).ready( function() {
		// 把有 .color-picker 的輸入框轉換成 miniColors 效果
		$(".color-picker").miniColors({
			letterCase: 'uppercase'
		});
 
		$("#randomize").click(function(){
			// 產生隨機顏色
			$(".color-picker").each(function(){
				$(this).miniColors('value', '#' + Math.floor(Math.random() * 16777215).toString(16));
			});
		})
	});
</script>
<?php
mysqli_free_result($RecordTmpLogoListType);

mysqli_free_result($RecordTmpLogo);
?>
