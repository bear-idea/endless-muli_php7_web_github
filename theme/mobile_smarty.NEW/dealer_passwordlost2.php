<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function YY_checkform() { //v4.66
//copyright (c)1998,2002 Yaromat.com
  var args = YY_checkform.arguments; var myDot=true; var myV=''; var myErr='';var addErr=false;var myReq;
  for (var i=1; i<args.length;i=i+4){
    if (args[i+1].charAt(0)=='#'){myReq=true; args[i+1]=args[i+1].substring(1);}else{myReq=false}
    var myObj = MM_findObj(args[i].replace(/\[\d+\]/ig,""));
    myV=myObj.value;
    if (myObj.type=='text'||myObj.type=='password'||myObj.type=='hidden'){
      if (myReq&&myObj.value.length==0){addErr=true}
      if ((myV.length>0)&&(args[i+2]==1)){ //fromto
        var myMa=args[i+1].split('_');if(isNaN(myV)||myV<myMa[0]/1||myV > myMa[1]/1){addErr=true}
      } else if ((myV.length>0)&&(args[i+2]==2)){
          var rx=new RegExp("^[\\w\.=-]+@[\\w\\.-]+\\.[a-z]{2,4}$");if(!rx.test(myV))addErr=true;
      } else if ((myV.length>0)&&(args[i+2]==3)){ // date
        var myMa=args[i+1].split("#"); var myAt=myV.match(myMa[0]);
        if(myAt){
          var myD=(myAt[myMa[1]])?myAt[myMa[1]]:1; var myM=myAt[myMa[2]]-1; var myY=myAt[myMa[3]];
          var myDate=new Date(myY,myM,myD);
          if(myDate.getFullYear()!=myY||myDate.getDate()!=myD||myDate.getMonth()!=myM){addErr=true};
        }else{addErr=true}
      } else if ((myV.length>0)&&(args[i+2]==4)){ // time
        var myMa=args[i+1].split("#"); var myAt=myV.match(myMa[0]);if(!myAt){addErr=true}
      } else if (myV.length>0&&args[i+2]==5){ // check this 2
            var myObj1 = MM_findObj(args[i+1].replace(/\[\d+\]/ig,""));
            if(myObj1.length)myObj1=myObj1[args[i+1].replace(/(.*\[)|(\].*)/ig,"")];
            if(!myObj1.checked){addErr=true}
      } else if (myV.length>0&&args[i+2]==6){ // the same
            var myObj1 = MM_findObj(args[i+1]);
            if(myV!=myObj1.value){addErr=true}
      }
    } else
    if (!myObj.type&&myObj.length>0&&myObj[0].type=='radio'){
          var myTest = args[i].match(/(.*)\[(\d+)\].*/i);
          var myObj1=(myObj.length>1)?myObj[myTest[2]]:myObj;
      if (args[i+2]==1&&myObj1&&myObj1.checked&&MM_findObj(args[i+1]).value.length/1==0){addErr=true}
      if (args[i+2]==2){
        var myDot=false;
        for(var j=0;j<myObj.length;j++){myDot=myDot||myObj[j].checked}
        if(!myDot){myErr+='* ' +args[i+3]+'\n'}
      }
    } else if (myObj.type=='checkbox'){
      if(args[i+2]==1&&myObj.checked==false){addErr=true}
      if(args[i+2]==2&&myObj.checked&&MM_findObj(args[i+1]).value.length/1==0){addErr=true}
    } else if (myObj.type=='select-one'||myObj.type=='select-multiple'){
      if(args[i+2]==1&&myObj.selectedIndex/1==0){addErr=true}
    }else if (myObj.type=='textarea'){
      if(myV.length<args[i+1]){addErr=true}
    }
    if (addErr){myErr+='* '+args[i+3]+'\n'; addErr=false}
  }
  if (myErr!=''){alert('The required information is incomplete or contains errors:\t\t\t\t\t\n\n'+myErr)}
  document.MM_returnValue = (myErr=='');
}
//-->
</script>

<h4 class="classic-title"><span><?php echo "忘記密碼"; // 標題文字 ?></span></h4>	
	
<div class="post-content">
                <div style=" width:500px;">
		<?php if ($totalRows_RecordSendMail > 0) { // Show if recordset not empty ?>
  
        <p class="font_black" style="font-size:16px; color:#006600">   <br />
         您的新密碼已經寄出到您的信箱，請收信<br />
          後使用新帳號、密碼登入網站，謝謝。<br />
          <?
  //自訂取得隨機密碼函數
  function getRandNewPassword()
  {
    $password_len = 6;//指定隨機密碼字串字數
    $password = '';
	//指定隨機密碼字串內容
    $word = 'abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
    $len = strlen($word);
    for ($i = 0; $i < $password_len; $i++) {
        $password .= $word[rand() % $len];
    }
    return $password;
  }
  //變數$password取得新的隨機密碼
  $psw=getRandNewPassword();
?>
          <?
  //將新密碼發信給使用者
  mb_internal_encoding('UTF-8');//指定發信使用UTF-8編碼，防止信件標題亂碼
  $servicemail="service@msa.hinet.net";//指定網站管理員服務信箱，請修改為自己的有效mail
  $webname = $SiteName;//"玩轉網頁創意平台";//寫入網站名稱
  $mail=$_POST['mail'];//上一頁中會員輸入的信箱
  $subject=$webname."補發會員密碼";//信件標題
  $subject=mb_encode_mimeheader($subject, 'UTF-8');//指定標題將雙位元文字編碼為單位元字串，避免亂碼
  //指定信件內容
  $body="親愛的會員您好，以下是您的新會員密碼，請妥善保存您的資料，謝謝:<br />
         您的新密碼是".$password."<br />
         如有任何問題歡迎與我們聯絡，謝謝!!any problem，you can touch us，thank you!!";
  //郵件檔頭設定
  $headers = "MIME-Version: 1.0\r\n";//指定MIME(多用途網際網路郵件延伸標準)版本
  $headers .= "Content-type: text/html; charset=utf-8\r\n";//指定郵件類型為HTML格式
  $headers .= "From:".mb_encode_mimeheader($webname, 'UTF-8')."<".$servicemail."> \r\n";//指定寄件者資訊
  $headers .= "Reply-To:".mb_encode_mimeheader($webname, 'UTF-8')."<".$servicemail.">\r\n";//指定信件回覆位置
  $headers .= "Return-Path:".mb_encode_mimeheader($webname, 'UTF-8')."<".$servicemail.">\r\n";//被退信時送回位置
  //使用mail函數寄發信件
  mail ($mail,$subject,$body,$headers);
  //將新密碼發信給使用者結束
?>
          <?
  //更新資料庫的會員密碼資料
  $updateSQL = sprintf("UPDATE demo_dealer SET psw=%s WHERE mail=%s",
                       GetSQLValueString(md5($psw), "text"),
                       GetSQLValueString($_POST['mail'], "text"));
  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
?>
          <br />
          <!--<input name="Submit" type="button" onclick="MM_goToURL('parent','index.php');return document.MM_returnValue" value="回首頁" />-->
          <br />
          </p>
       
  <?php } // Show if recordset not empty ?>
  <?php if ($totalRows_RecordSendMail == 0) { // Show if recordset empty ?>
   <span class="font_black" style="font-size:16px; color:#006600"><br />
對不起!!資料庫中沒有您的會員E-mail，請<br />
回上一頁重新輸入，或是<a href="<?php echo $_SERVER['PHP_SELF']; ?>?wshop=<?php echo $_GET['wshop']; ?>&amp;Opt=reg&amp;lang=<?php echo $_SESSION['lang']; ?>">點此註冊 </a>。<br />
<br />
<!--<input type="button" name="submit" value="回上一頁" onclick="window.history.back();" />-->
<!--<input name="Submit2" type="button" onclick="MM_goToURL('parent','dealerAdd.php');return document.MM_returnValue" value="加入會員" />-->
<!--<input name="Submit2" type="button" onclick="MM_goToURL('parent','index.php');return document.MM_returnValue" value="回首頁" />-->
      </span>
  <?php } // Show if recordset empty ?>
  </div>
</div>

