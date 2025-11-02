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

/* 取得作者列表 */

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_TmpLogo")) {
  $insertSQL = sprintf("INSERT INTO demo_tmplogo (name, type, logoimage, width, height, notes1, lang, userid, webname) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['type'], "text"),
                       GetSQLValueString($_POST['logoimage'], "text"),
                       GetSQLValueString($_POST['width'], "text"),
                       GetSQLValueString($_POST['height'], "text"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"),
                       GetSQLValueString($_POST['webname'], "text"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));

  $insertGoTo = "manage_tmp.php?Operate=addSuccess&Opt=logoviewpage&lang=" . $_POST['lang'];
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>

<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function CheckFields()
{	
	// 檢查『名稱』欄位
	var fieldvalue = document.getElementById("name").value;
	if (fieldvalue == "") 
	{
		alert("名稱欄位尚未填寫！！");
		document.getElementById("name").focus();
		return false;
	}
	
	// 檢查『分類』欄位
	var fieldvalue = document.getElementById("type").value;
	if (fieldvalue == "-1" || fieldvalue == "") 
	{
		alert("分類欄位尚未選擇！！");
		document.getElementById("type").focus();
		return false;
	}
	
	// 檢查『分類』欄位
	var fieldvalue = document.getElementById("width").value;
	if (fieldvalue == "" || fieldvalue == NULL) 
	{
		alert("寬度欄位尚未填寫！！");
		document.getElementById("width").focus();
		return false;
	}
	
	// 檢查『分類』欄位
	var fieldvalue = document.getElementById("height").value;
	if (fieldvalue == "" || fieldvalue == NULL) 
	{
		alert("高度欄位尚未填寫！！");
		document.getElementById("height").focus();
		return false;
	}
	return true;
}
//-->
</script>
<style type="text/css"> 
#uploadPreview{
	position:absolute; left:700px; top:200px; border:1px #CCCCCC solid;cursor: move;
}
#uploadPreview img{
	max-width:300px;
	max-height:300px;
}
</style>
<script type="text/javascript">
<?php // 取得圖片預覽 ?>
$(document).ready(function() {
// var url = window.URL || window.webkitURL; // alternate use
function readImage(file) {
  
    var reader = new FileReader();
    var image  = new Image();
  
    reader.readAsDataURL(file);  
    reader.onload = function(_file) {
        image.src    = _file.target.result;              // url.createObjectURL(file);
        image.onload = function() {
            var w = this.width,
                h = this.height,
                t = file.type,                           // ext only: // file.type.split('/')[1],
                n = file.name,
                s = (file.size/1024) +'KB';
            //$('#uploadPreview').html('<img src="'+ this.src +'"> '+w+'x'+h+' '+s+' '+t+' '+n+'<br>');
			$('#uploadPreview').html('<div style="background-color:#FFF; padding:10px;"><img src="'+ this.src +'"> '+'<br/>'+w+'x'+h+' '+s+' '+'</div>');
		    $("#width").val(w); // 自動填入寬度
            $("#height").val(h); // 自動填入高度
			$( "#uploadPreview" ).draggable(); // 使此區塊可拖曳
        };
        image.onerror= function() {
			if(file.type == "application/x-shockwave-flash")
			{
			}else{
					alert('Invalid file type: '+ file.type);
			}  
        };      
    };
    
}
$("#logoimage").change(function (e) { // 上傳檔案的ID
    if(this.disabled) return alert('File upload not supported!');
    var F = this.files;
    if(F && F[0]) for(var i=0; i<F.length; i++) readImage( F[i] );
});
});  
</script>
<div>
    <div>
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">新增Logo [<?php echo $langname; ?>
編輯介面]</font><span class="Form_Caption_Word">(</span><span class="Form_Required_Item">*</span><span class="Form_Caption_Word">為必填項目)</span></strong>
</h4>
</td>
</tr>
</table>

<form action="require_manage_tmplogo_add.php" method="post" enctype="multipart/form-data" name="form_TmpLogo" id="form_TmpLogo" onsubmit="checkFileUpload(this,'',false,3000,'','',1000,500,'','');showProgressWindow('fileCopyProgress.htm',300,100);return document.MM_returnValue">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
    <tr>
      <td width="100" align="right">名稱：</td>
      <td><span id="TmpLogoName">
        <label>
          <input name="name" type="text" id="name" value="Logo" size="50" maxlength="50" />
        </label>
        <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
    </tr>
    <tr>
      <td align="right">線上製作：</td>
      <td><span class = "InnerPage" style="float:none;"><a href="http://www.twitlogo.com/" data-original-title="輸入想要產生的文字，並選好大小、字體及外框顏色，然後按下 make，就可以做出和 Twitter 一樣字型的 logo 文字(不支援中文)。" target="_blank" data-toggle="tooltip" data-placement="top">Twitlogo</a></span>
      <span class = "InnerPage" style="float:none;"><a href="http://udagawafriday.ifdef.jp/minantoka.html" data-original-title="在圖上滾動滑鼠的滾輪，可以調整圖形的角度,在日文字上雙擊滑鼠左鍵，就可以輸入你想要的文字(支援日文漢字)。" target="_blank" data-toggle="tooltip" data-placement="top">nanto-ka</a></span>
      <span class = "InnerPage" style="float:none;"><a href="http://hgn.ai/" data-original-title="在画像の作成輸入想要產生的文字(支援日文漢字)。" target="_blank" data-toggle="tooltip" data-placement="top">はがないジェネレータ</a></span
      ><span class = "InnerPage" style="float:none;"><a href="http://zh-cn.cooltext.com/" data-original-title="只需選擇您喜歡的圖片類型。再填寫表單，就可獲得自動創建的自定義圖片(支援中文)。" target="_blank" data-toggle="tooltip" data-placement="top">cooltext</a></span></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>分類：</td>
      <td><span id="TmpLogoType">
        <label for="type"></label>
        <select name="type" id="type">
          <option value="-1">-- 選擇分類 --</option>
          <?php
				do {  
				?>
          <option value="<?php echo $row_RecordTmpLogoListType['itemname']?>"><?php echo $row_RecordTmpLogoListType['itemname']?></option>
          <?php
				} while ($row_RecordTmpLogoListType = mysqli_fetch_assoc($RecordTmpLogoListType));
				  $rows = mysqli_num_rows($RecordTmpLogoListType);
				  if($rows > 0) {
					  mysqli_data_seek($RecordTmpLogoListType, 0);
					  $row_RecordTmpLogoListType = mysqli_fetch_assoc($RecordTmpLogoListType);
				  }
				?>
        </select>
        <span class="selectInvalidMsg">請選取有效的項目。</span></span></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>圖片：</td>
      <td><label for="logoimage"></label>
        <input name="logoimage" type="file" id="logoimage" onchange="checkOneFileUpload(this,'',false,3000,'','',1000,500,'','');readImage(this);" size="50" maxlength="200" /> <span class = "InnerPage" style="float:none;"><a href="#" data-original-title="允許上傳 jpg、png、bmp、gif、flash檔。" data-toggle="tooltip" data-placement="right">?</a></span><div id="uploadPreview"></div></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>寬度：</td>
      <td><span id="TmpLogoWidth">
      <label for="width"></label>
      <input name="width" type="text" id="width" size="3" maxlength="3"/>
      <span class="textfieldInvalidFormatMsg">格式無效。</span><span class="textfieldRequiredMsg">需要有一個值。</span></span>px <span class = "InnerPage" style="float:none;"><a href="#" data-original-title="此為圖片寬度。" data-toggle="tooltip" data-placement="right">?</a></span></td>
    </tr>
    <tr>
      <td align="right"><span class="Form_Required_Item">*</span>高度：</td>
      <td><span id="TmpLogoHeight">
      <label for="height"></label>
      <input name="height" type="text" id="height" size="3" maxlength="3" />
      <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span>px <span class = "InnerPage" style="float:none;"><a href="#" data-original-title="此為圖片高度。" data-toggle="tooltip" data-placement="right">?</a></span></td>
    </tr>
    <tr>
      <td align="right">備註：</td>
      <td><label for="notes1"></label>
        <span id="TmpLogoNotes1">
          <label for="notes1"></label>
          <input name="notes1" type="text" id="notes1" size="50" maxlength="50" />
          <span class="textfieldRequiredMsg">欄位不可為空。</span></span></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td><input type="submit" name="button" id="button" value="送出填寫資料" onclick="return CheckFields();" />
        <input type="reset" name="button2" id="button2" value="重置填寫資料" />
        <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
        <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid ?>" />
<input name="webname" type="hidden" id="webname" value="<?php echo $wshop ?>" /></td>
    </tr>
    
  </table>
  <input type="hidden" name="MM_insert" value="form_TmpLogo" />
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
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("TmpLogoName", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("TmpLogoNotes1", "none", {validateOn:["blur"], isRequired:false});
var spryselect1 = new Spry.Widget.ValidationSelect("TmpLogoType", {validateOn:["blur"], isRequired:false, invalidValue:"-1"});
var sprytextfield2 = new Spry.Widget.ValidationTextField("TmpLogoWidth", "integer", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("TmpLogoHeight", "integer", {validateOn:["blur"]});
//-->
</script>
<?php
mysqli_free_result($RecordTmpLogoListType);
?>
