<?php require_once('../Connections/DB_Conn.php'); ?>
<?php 
header("Content-Type:text/html;charset=utf-8"); // 指定頁面編碼方式 IE BUG 
?>
<?php require_once("inc_setting.php"); ?>
<?php require_once("inc_permission.php"); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php //$startTime = getMicroTime(); //页面开头定义：?>
<?php require_once("inc_lang.php"); // 取得目前語系?>
<?php require_once("inc_mdname.php"); // 取得模組名稱?>
<?php require_once('upload_get_admin.php'); ?>
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

$colname_RecordEPaper = "-1";
if (isset($_GET['id'])) {
  $colname_RecordEPaper = $_GET['id'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordEPaper = sprintf("SELECT * FROM demo_member WHERE id = %s", GetSQLValueString($colname_RecordEPaper, "int"));
$RecordEPaper = mysqli_query($DB_Conn, $query_RecordEPaper) or die(mysqli_error());
$row_RecordEPaper = mysqli_fetch_assoc($RecordEPaper);
$totalRows_RecordEPaper = mysqli_num_rows($RecordEPaper);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta name="keywords" content="" /> 
<meta name="DESCRIPTION" content="" />
<meta name ="author" content="富視網科技網頁設計" />  
<meta name="designer" content="富視網科技網頁設計" />
<meta name="abstract" content="富視網科技網頁設計" />
<meta name="publisher" content="富視網科技網頁設計" />
<meta name="copyright" content="富視網科技網頁設計" />
<meta name="robots" content="all" />
<meta name="robots" content="index,follow" />
<meta name="revisit-after" content="7 days" />
<meta name="rating" content="general" />
<meta name="distribution" content="global" />
<meta name="content-Language" content="zh-tw" />
<meta http-equiv="expires" content="0" />
<meta name="spiders" content="all" />
<meta name="webcrawlers" content="all" />
<link rel='icon' href='favicon.ico' type='image/x-icon' />
<link rel='bookmark' href='favicon.ico' type='image/x-icon' />
<link rel='shortcut icon' href='favicon.ico' type='image/x-icon' />
<title>後台管理系統 - <?php echo $row_RecordAccount['name'];?></title>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script> 
<script src="../SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryData.js" type="text/javascript">/*此檔案必須在jquery之前執行*/</script>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.abgne-minwt.divalign.js"> // Div自動對齊(齊左齊右齊上齊下) malign:left、right  mvalign:top、bottom div區塊中加入</script>
<link rel="stylesheet" type="text/css" href="css/jQuery-Tags-Input/jquery.tagsinput.css" />
<script type="text/javascript" src="js/jQuery-Tags-Input/jquery.tagsinput.min.js"></script>
<script type="text/javascript">
	
	$(function() {

		$('#SiteKeyWord,#skeyword').tagsInput({
			width:'auto',
			defaultText:'加入關鍵字'
		});
// Uncomment this line to see the callback functions in action
//			$('input.tags').tagsInput({onAddTag:onAddTag,onRemoveTag:onRemoveTag,onChange: onChangeTag});		

// Uncomment this line to see an input with no interface for adding new tags.
//			$('input.tags').tagsInput({interactive:false});
	});

</script>
<script type="text/javascript" src="../js/selectboxes.js">/*連動選單*/</script>
<script language="javascript" src="../js/jquery.jeditable.js">/*原地編輯*/</script>
<script type='text/javascript' src='js/vertical-accordion-menu/jquery.cookie.js'></script>
<script type='text/javascript' src='js/vertical-accordion-menu/jquery.hoverIntent.minified.js'></script>
<script type='text/javascript' src='js/vertical-accordion-menu/jquery.dcjqaccordion.2.7.min.js'></script> 
<link href="css/vertical-accordion-menu/skins/grey.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
$(document).ready(function($){
	$('#accordion-2').dcAccordion({
		eventType: 'click', // click/hover
		autoClose: false,
		saveState: true,
		disableLink: true,
		speed: 'fast',
		classActive: 'active',
		showCount: false // 選單個數
	});
});
</script>
<!-- jquery-vertical-accordion-menu END-->
<script type="text/javascript">
$(document).ready(function() { /* jeditable 日曆 */
	$.editable.addInputType('datepicker', { 
    element : function(settings, original) { 
        var input = $('<input>'); 
        if (settings.width  != 'none') { input.width(settings.width);  } 
    if (settings.height != 'none') { input.height(settings.height); } 
        input.attr('autocomplete','off'); 
    $(this).append(input); 
    return(input); 
    }, 
    plugin : function(settings, original) { 
        /* Workaround for missing parentNode in IE */ 
    var form = this; 
    settings.onblur = 'ignore'; 
    $(this).find('input').datepicker().bind('click', function() { 
    $(this).datepicker('show'); 
            return false; 
        }).bind('dateSelected', function(e, selectedDate, $td) { 
            $(form).submit(); 
        }); 
    } 
}); 
})
</script> 
<script type="text/javascript" src="../js/jquery.corners.min.js"></script>
<script type="text/javascript" src="../js/iframe.js"></script>
<script type="text/javascript" src="../js/fontsizer.jquery.js"></script>
<script src="../js/jquery.d.checkbox.min.js"></script> 
<script>
$(document).ready(function(){
		$(':checkbox').d_checkbox();
		$(':radio').d_radio();
});
</script>
<script>
$(document).ready( function(){
  $('.rounded').corners();
});</script>
<!-- [ Sort Table ] -->
<script language="javascript" src="../js/jquery.tablesorter.js"></script>
<script>
$(document).ready(function(){         
  $("#TBSort").tablesorter({widgets: ['zebra']});
}); 
</script>
<!-- [ Sort Table End ] -->
<!-- [ reflection ] -->
<script type="text/javascript" src="../js/reflection.js"></script> 
<script type="text/javascript">
$(document).ready(function() {
	$("#ref_thumb img").reflect();
})
</script>
<script type="text/javascript">
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
</script>
<!-- [ reflection End ] -->
<!--[if IE 6]>
<script type="text/javascript" src="js/iepngfix_tilebg.js"></script> 
<![endif]-->
<link href="css/incstyle.css" rel="stylesheet" type="text/css" />
<link href="css/styleless.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="../css/jquery.d.checkbox.css"></link>
<link rel="stylesheet" href="../css/fontsizer.css" type="text/css" />
<link type="text/css" href="../css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
</head>

<body>
<?php if($totalRows_RecordEPaper > 0) { ?>
<div style="padding:10px; margin:10px;">
<div style="background-color:#FFFFFF; padding:5px; border: 1px solid #CCC; text-align:center;">會員<span style="color:#0000FF;"> [ <?php echo $row_RecordEPaper['name']; ?> ] [<?php echo $row_RecordEPaper['companyname']; ?>]</span>發送成功</div>
</div>
<?php } ?>
<?php //do { ?>
<?php
// <!-- ╭─────────────────────────────────────╮ -->
if($totalRows_RecordEPaper > 0) {
	

  // 發送認證信
  //$DefaultSiteMail = "jack@fullvision.net";
  //$row_RecordEPaper['mail'] = "jack@fullvision.net";
  $servicemail=$DefaultSiteMail;//指定網站管理員服務信箱，請修改為自己的有效mail
  
  $DefaultSiteUrl = $_SERVER['HTTP_HOST'];
  $AuthUrl = "http://" . $DefaultSiteUrl . "/regiest/auth.php?account=" . $row_RecordEPaper['account'] . "&auth=" . $row_RecordEPaper['auth'] . "&wshop=" . $_GET['wshop'] . "&lang=" . $_GET['lang'];
  $Body = "親愛的 " . $_POST['account'] . " 您好！" 
        . "歡迎您申請『" . $DefaultSiteName . "』會員。"
		. "請啟動您的帳號以完成最後的註冊！以下為您的認證網址！"
		. " " . $AuthUrl 
		. " 請在此點擊認證您的帳號" 
		. "如果認證信重複寄送，請以最後一封認證信啟動，會員資料將以最終啟動會員帳號的 Email 為準！"
		. "本信件為系統自動發送(請勿回信！！！)";

  //$From= "From: " . "=?UTF-8?B?" . base64_encode($DefaultSiteMailAuthor) . "?=" . " <" . $servicemail . "> \n\r";
  //$Type= "Content-Type: text/html; charset=UTF-8\n\r" . "Content-Transfer-Encoding: 8bit\n\r";
  //$Header=$From.$Type;
  //$Subject="=?UTF-8?B?" . base64_encode($DefaultSiteMailSubject) . "?=";
  
  //$subject="=?UTF-8?B?" . base64_encode($DefaultSiteMailSubject) . "?=";
  //$subject="=?UTF-8?B?”.base64_encode('主旨').”?=";//信件標題，解決亂碼問題
  //$subject=mb_encode_mimeheader($subject, 'UTF-8');//指定標題將雙位元文字編碼為單位元字串，避免亂碼
  
  $subject=$DefaultSiteMailSubject;//信件標題
  $subject=mb_encode_mimeheader($subject, 'UTF-8');//指定標題將雙位元文字編碼為單位元字串，避免亂碼
	  
  
  $headers = "MIME-Version: 1.0\r\n";//指定MIME(多用途網際網路郵件延伸標準)版本
  $headers .= "Content-type: text/html; charset=utf-8\r\n";//指定郵件類型為HTML格式
  $headers .= "From:".mb_encode_mimeheader($DefaultSiteMailAuthor, 'UTF-8')."<".$servicemail."> \r\n";//指定寄件者資訊
  $headers .= "Reply-To:".mb_encode_mimeheader($DefaultSiteMailAuthor, 'UTF-8')."<".$servicemail.">\r\n";//指定信件回覆位置
  $headers .= "Return-Path:".mb_encode_mimeheader($DefaultSiteMailAuthor, 'UTF-8')."<".$servicemail.">\r\n";//被退信時送回位置
  
  //$From= "From: " . "=?UTF-8?B?" . base64_encode($DefaultSiteMailAuthor) . "?=" . " <" . "service@ttia-tw.org" . "> \n\r";
  //$Type= "Content-Type: text/html; charset=UTF-8\n\r" . "Content-Transfer-Encoding: 8bit\n\r";
  //$header=$From.$Type;
  //$subject="=?UTF-8?B?" . base64_encode($DefaultSiteMailSubject) . "?=";
  
			
  mail($row_RecordEPaper['mail'], $subject, $Body, $header);
   
  //}
  
  ///////////////////////////////
  
  $servicemail=$DefaultSiteMail;//指定網站管理員服務信箱，請修改為自己的有效mail
  
  $DefaultSiteUrl = $_SERVER['HTTP_HOST'];
  //$AuthUrl = "http://" . $DefaultSiteUrl . "/regiest/auth.php?account=" . $_POST['account'] . "&auth=" . $_POST['auth'] . "&wshop=" . $_POST['wshop'] . "&lang=" . $_POST['lang'];
  $Body = "會員 " . $row_RecordEPaper['account'] . "認證信已發送！";

  $From= "From: " . "=?UTF-8?B?" . base64_encode($DefaultSiteMailAuthor) . "?=" . " <" . $servicemail . "> \n\r";
  $Type= "Content-Type: text/html; charset=UTF-8\n\r" . "Content-Transfer-Encoding: 8bit\n\r";
  $Header=$From.$Type;
  $Subject="=?UTF-8?B?" . base64_encode($DefaultSiteName . "會員認證信發送") . "?=";
  
  $subject=$DefaultSiteName."會員認證信發送";//信件標題
  $subject=mb_encode_mimeheader($subject, 'UTF-8');//指定標題將雙位元文字編碼為單位元字串，避免亂碼
  
  $headers = "MIME-Version: 1.0\r\n";//指定MIME(多用途網際網路郵件延伸標準)版本
  $headers .= "Content-type: text/html; charset=utf-8\r\n";//指定郵件類型為HTML格式
  $headers .= "From:".mb_encode_mimeheader($DefaultSiteMailAuthor, 'UTF-8')."<".$servicemail."> \r\n";//指定寄件者資訊
  $headers .= "Reply-To:".mb_encode_mimeheader($DefaultSiteMailAuthor, 'UTF-8')."<".$servicemail.">\r\n";//指定信件回覆位置
  $headers .= "Return-Path:".mb_encode_mimeheader($DefaultSiteMailAuthor, 'UTF-8')."<".$servicemail.">\r\n";//被退信時送回位置
  
  
	
  mail($servicemail, $Subject, $Body, $Headers);
?>
<?php } else { ?>
錯誤的會員帳號
<?php }  ?>
</body>
</html>
<?php
mysqli_free_result($RecordEPaper);

//mysqli_free_result($RecordEPaperMail);

//$endTime = getMicroTime(); //页面结尾定义
//echo getRunTime($startTime, $endTime); //最后调用函数
?>