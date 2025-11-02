<!--
<?php
/*********************************************************************
 # 主頁面贊助廠商
 *********************************************************************/
?>
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>贊助廠商</title>
</head>
<body>
<!-- TemplateBeginEditable name="標題" -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
    <tr>
      <td width="50%">贊助廠商</td>
      <td align="right">&nbsp;</td>
    </tr>
</table>
<!-- TemplateEndEditable -->
<!--
<?php 
 echo "dddd";
if ($totalRows_RecordSponsor > 0) {
#
# 在此判斷式之內放置要顯示之內容
# <!-- ╭─────────────────────────────────────╮  
?> 
-->
<br /> 
    <!--
    <?php 
    echo "xdd";
    # 重複印出所有資料
    # ╭─────────────────────────────────────╮ 
    do { 
    ?>
    -->
        <div class="sponsor_board"><a href="<?php echo $row_RecordSponsor['link']; ?>" target="_blank"><img src="upload/image/sponsor/<?php echo $row_RecordSponsor['pic']; ?>" alt="<?php echo $row_RecordSponsor['name']; ?>" /></a>
        </div>
    <!--
    <?php 
    } while ($row_RecordSponsor = mysqli_fetch_assoc($RecordSponsor));
    # ╰─────────────────────────────────────╯  
    ?>
    -->
<!--
<?php 
#  ╰─────────────────────────────────────╯
} 
else {
#
# 在此判斷式之內放置當無資料時顯示之內容
#  ╭─────────────────────────────────────╮ 
?>
-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center"><font color="#FF0000">目前尚無資料！！</font></td>
      </tr>
    </table>
<!--
<?php 
# ╰─────────────────────────────────────╯ 
} 
?>
-->
</body>
</html>