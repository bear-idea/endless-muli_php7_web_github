<script type="text/javascript">
$(document).ready(function() {
    $("#EPaper_Mail_Send_Buttom").click(function() {
		var s1 = $("#epaper_mail_send").val();
		var regex = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/;
		if(!regex.exec(s1))
        {
            msg = "格式錯誤!!";
            alert(msg);
			$("form").submit(function () { return false; }); 
        } else {
			$.ajax({
				type: "post", 
				url: "ajax/epaper_mail_check.php", 
				data: 'mail='+ $("#epaper_mail_send").val(), 
				//  cache: false, 
				success: function(msg){ 
					if(msg > 0){ 
						msg = "已訂閱";
						alert(msg);
						//return true;
					}else{
						msg = "感謝您的訂閱";
						alert(msg);
						//return true;
					}
				} 
			}); 
		}
    });
});
</script>
<form action="<?php echo $editFormAction; ?>" method="POST" name="EPaper_Mail_Send" id="EPaper_Mail_Send">
  <label for="epaper_mail_send">訂閱電子報</label>
  <input type="text" name="epaper_mail_send" id="epaper_mail_send" style="width:120px; height:12px;">
  <input type="submit" name="EPaper_Mail_Send_Buttom" id="EPaper_Mail_Send_Buttom" value="送出" >
  <input type="hidden" name="MM_insert" value="EPaper_Mail_Send">
</form>
