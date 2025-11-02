
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#form1 .inquForm tbody tr {
	border-top-width: 0px;
	border-right-width: 0px;
	border-bottom-width: 1px;
	border-left-width: 0px;
	border-top-style: dotted;
	border-right-style: dotted;
	border-bottom-style: dotted;
	border-left-style: dotted;
	border-top-color: #399;
	border-right-color: #399;
	border-bottom-color: #399;
	border-left-color: #399;
	padding: 5px;
}
#form1 .inquForm tbody tr td {
	padding: 5px;
}
#form1 .inquForm {
	padding: 8px;
	margin: 5px;
}
#form1 .TB_General_style01 tr td {
	padding-top: 5px;
	padding-right: 10px;
	padding-bottom: 5px;
	padding-left: 10px;
}
#form1 .inquForm tbody tr .columnName .txtImportant {
	color: #F00;
	font-weight: bold;
}
</style>

<form id="form1" name="form1" method="post" action="phpmail/sendmail.php">
  <table width="480" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
    <tr>
      <td align="center" bgcolor="#DBDDC8"><strong>客戶意見表</strong></td>
    </tr>
   
    <tr>
      <td bgcolor="#E6E8D9"><strong>感謝你瀏覽本網站，如果你對本公司的產品有任何建議，或著說對產品有任何疑問的話，請填寫以下表格留下你寶貴的意見，本公司將盡快與你連絡。</strong></td>
    </tr>
  </table><br />

  
  <table width="480" cellpadding="0" cellspacing="0" class="inquForm">
				
					<tbody>
						<tr>
							<td width="160" class="columnName"><span class="txtImportant">*</span> 主題:</td>
							<td><span id="sprytextfield1">
							  <input name="subject" type="text"  class="text" id="subject"/>
						    <span class="textfieldRequiredMsg">需要有一個值。</span></span></td>
						</tr>
						<tr>
							<td class="columnName"><span class="txtImportant">*</span> 姓名:</td>
							<td><span id="sprytextfield2">
							  <input name="name" type="text"  class="text" id="name"/>
						    <span class="textfieldRequiredMsg">需要有一個值。</span></span></td>
						</tr>
						<tr>
							<td class="columnName"><span class="txtImportant">*</span> 公司名稱:</td>
							<td><span id="sprytextfield3">
							  <input name="Company" type="text"  class="text"/>
						    <span class="textfieldRequiredMsg">需要有一個值。</span></span></td>
						</tr>
						<tr>
							<td class="columnName"><span class="txtImportant">*</span> 地址:</td>
							<td><span id="sprytextfield4">
							  <input name="Address" type="text"  class="text" size="50"/>
						    <span class="textfieldRequiredMsg">需要有一個值。</span></span></td>
						</tr>
						<tr>
							<td class="columnName">城市:</td>
							<td><input name="City" type="text"  class="text"/></td>
						</tr>
						<tr>
							<td class="columnName">省/縣/州:</td>
							<td><input name="State" type="text"  class="text"/></td>
						</tr>
						<tr>
							<td class="columnName">郵遞區號:</td>
							<td><input name="Zip" type="text"  class="text"/></td>
						</tr>
						
						<tr>
							<td class="columnName"><span class="txtImportant">*</span> 國家:</td>
							<td><span id="sprytextfield5">
							  <input type="text"  class="text"name="Country" />
						    <span class="textfieldRequiredMsg">需要有一個值。</span></span></td>
						</tr>
						<tr>
							<td class="columnName"><span class="txtImportant">*</span> 電話:</td>
							<td><span id="sprytextfield6">
							  <input name="phone" type="text"  class="text" id="phone"/>
						    <span class="textfieldRequiredMsg">需要有一個值。</span></span></td>
						</tr>
						<tr>
							<td class="columnName"><span class="txtImportant">*</span> 傳真:</td>
							<td><span id="sprytextfield7">
							  <input name="Fax" type="text"  class="text"/>
						    <span class="textfieldRequiredMsg">需要有一個值。</span></span></td>
						</tr>
						<tr>
							<td class="columnName"><span class="txtImportant">*</span> Email:</td>
							<td><span id="sprytextfield8">
                            <input name="mail" type="text"  class="text" id="mail"/>
                            <span class="textfieldRequiredMsg">需要有一個值。</span><span class="textfieldInvalidFormatMsg">格式無效。</span></span></td>
						</tr>
						<tr>
							<td class="columnName"><span class="txtImportant">*</span> 您的留言 :</td>
							<td><span id="sprytextarea1">
							  <label for="message"></label>
							  <textarea name="message" id="message" cols="45" rows="5"></textarea>
						    <span class="textareaRequiredMsg">需要有一個值。</span></span></td>
						</tr>
					

    <tr>
      <td valign="center" align="middle" colspan="2"><input type="submit" value="確定送出" />
        <input type="reset" value="重新輸入" /></td>
    </tr></tbody>
  </table><br />
<br />
<br />

</form>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {validateOn:["blur"]});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "none", {validateOn:["blur"]});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "email", {validateOn:["blur"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur"]});
</script>
