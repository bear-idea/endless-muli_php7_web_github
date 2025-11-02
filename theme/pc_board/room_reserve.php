<style type="text/css">
.calendar_room {background: #fff; border: 4px solid #fff; -webkit-border-radius: 4px; -moz-border-radius: 4px; -o-border-radius: 4px; border-radius: 4px; box-shadow: 0 1px 4px rgba(0,0,0,.2); -webkit-box-shadow: 0 1px 4px rgba(0,0,0,.2); -moz-box-shadow: 0 1px 4px rgba(0,0,0,.2); -o-box-shadow: 0 1px 4px rgba(0,0,0,.2); width:95%;  text-align:center; margin-bottom:20px;padding:1px;}
.calendar_room tr td {padding:10px 5px; background-color:#fbf6ee; border-collapse:2px; cursor:pointer;}
.calendar_room_dayline {background: #fff; border: 4px solid #fff; -webkit-border-radius: 4px; -moz-border-radius: 4px; -o-border-radius: 4px; border-radius: 4px; box-shadow: 0 1px 4px rgba(0,0,0,.2); -webkit-box-shadow: 0 1px 4px rgba(0,0,0,.2); -moz-box-shadow: 0 1px 4px rgba(0,0,0,.2); -o-box-shadow: 0 1px 4px rgba(0,0,0,.2); width:95%;  text-align:center; margin-bottom:20px;padding:1px; margin-left:auto; margin-right:auto;}
.calendar_room_dayline tr td {padding:10px 5px; background-color:#fbf6ee; border-collapse:2px;}
.calendar_room .Room_Date_Num_y{width:20px;height:20px; margin-top:2px; background-color:#68c7b2; color: #FFF; padding: 2px; -webkit-border-radius:99em; border-radius:99em; -moz-border-radius: border-radius:99em; -o-border-radius: border-radius:99em;}
.calendar_room .Room_Date_Num_n{width:20px;height:20px; margin-top:2px; background-color:#DDD; color: #FFF; padding: 2px; -webkit-border-radius:99em; border-radius:99em; -moz-border-radius: border-radius:99em; -o-border-radius: border-radius:99em;}
.calendar_room .Room_Date_Num_f{width:20px;height:20px; margin-top:2px; background-color:#FF9DA5; color: #FFF; padding: 2px; -webkit-border-radius:99em; border-radius:99em; -moz-border-radius: border-radius:99em; -o-border-radius: border-radius:99em;}
.calendar_room tr td {padding:10px 5px; background-color:#fbf6ee; border-collapse:2px;}
.calendar_room tr td:hover {background-color:#FDF2DB;}
.calendar_room tr td:active {background-color:#f19d17;}
.blank_color {}
.Room_DayLine { background-color:#e7e6d9}
.calendar{margin:.25em 10px 10px 0;padding-top:5px;float:left;width:60px;background:#ededef;background:-webkit-gradient(linear,left top,left bottom,from(#ededef),to(#ccc));background:-moz-linear-gradient(top,#ededef,#ccc);font:bold 20px/40px Arial Black,Arial,Helvetica,sans-serif;text-align:center;color:#000;text-shadow:#fff 0 1px 0;-moz-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;position:relative;-moz-box-shadow:0 2px 2px #888;-webkit-box-shadow:0 2px 2px #888;box-shadow:0 2px 2px #888; cursor:pointer}
.calendar em{display:block;font:normal bold 11px/30px Arial,Helvetica,sans-serif;color:#fff;text-shadow:#00365a 0 -1px 0;background:#04599a;background:-webkit-gradient(linear,left top,left bottom,from(#04599a),to(#00365a));background:-moz-linear-gradient(top,#04599a,#00365a);-moz-border-radius-bottomright:3px;-webkit-border-bottom-right-radius:3px;border-bottom-right-radius:3px;-moz-border-radius-bottomleft:3px;-webkit-border-bottom-left-radius:3px;border-bottom-left-radius:3px;border-top:1px solid #00365a}

/* em 的伪元素用来创建两个吊环 */ 
.calendar:before,.calendar:after{content:'';float:left;position:absolute;top:5px;width:8px;height:8px;background:#111;z-index:1;-moz-border-radius:10px;-webkit-border-radius:10px;border-radius:10px;-moz-box-shadow:0 1px 1px #fff;-webkit-box-shadow:0 1px 1px #fff;box-shadow:0 1px 1px #fff}
.calendar:before{left:11px}
.calendar:after{right:11px}
.calendar em:before,.calendar em:after{content:'';float:left;position:absolute;top:-5px;width:4px;height:14px;background:#dadada;background:-webkit-gradient(linear,left top,left bottom,from(#f1f1f1),to(#aaa));background:-moz-linear-gradient(top,#f1f1f1,#aaa);z-index:2;-moz-border-radius:2px;-webkit-border-radius:2px;border-radius:2px}
.calendar em:before{left:13px}
.calendar em:after{right:13px}
</style>
<script type="text/javascript">
function getFormattedDate(date) {
	
	var calenderformat  = date.split("-");
	if(calenderformat[1].length == 1){calenderformat[1] = '0' + calenderformat[1]; }
	if(calenderformat[2].length == 1){calenderformat[2] = '0' + calenderformat[2]; }
	//calenderformat[1] = calenderformat[1].length > 1 ? calenderformat[1] : '0' + calenderformat[1];
	//calenderformat[2] = calenderformat[2].length > 1 ? calenderformat[2] : '0' + day;
  
	return calenderformat[0] + "-" + calenderformat[1] + "-" + calenderformat[2];
}

function get_lastDate(ymd,ym,n){  
        ymd=ymd?new Date(ymd.replace(/-/g,"/")):new Date();  
        ym&&(ym=="y"?ymd.setFullYear(ymd.getFullYear()-1):ymd.setMonth(ymd.getMonth()-1));  
        n&&ymd.setDate(ymd.getDate()+n);  
        return ymd.toLocaleDateString().match(/\d+/g).join('-');  
    }  
	
function checkEndTime(s,e){  
    var startTime=s;  
    var start=new Date(startTime.replace("-", "/").replace("-", "/"));  
    var endTime=e;  
    var end=new Date(endTime.replace("-", "/").replace("-", "/"));  
    if(end<start){  
        return false;  
    }  
    return true;  
}  

function DateDiff(sDate1,  sDate2){    //sDate1和sDate2是2002-12-18格式  
       var  aDate,  oDate1,  oDate2,  iDays  
       aDate  =  sDate1.split("-")  
       oDate1  =  new  Date(aDate[1]  +  '-'  +  aDate[2]  +  '-'  +  aDate[0])    //转换为12-18-2002格式  
       aDate  =  sDate2.split("-")  
       oDate2  =  new  Date(aDate[1]  +  '-'  +  aDate[2]  +  '-'  +  aDate[0])  
       iDays  =  parseInt(Math.abs(oDate1  -  oDate2)  /  1000  /  60  /  60  /24)    //把相差的毫秒数转换为天数  
       return  iDays  
}

//儲存Cookie
function SetCookie(name,value,expires,path,domain,secure) {
var expDays = expires*24*60*60*1000;
var expDate = new Date();
expDate.setTime(expDate.getTime()+expDays);
var expString = ((expires==null) ? "" : (";expires="+expDate.toGMTString()))
var pathString = ((path==null) ? "" : (";path="+path))
var domainString = ((domain==null) ? "" : (";domain="+domain))
var secureString = ((secure==true) ? ";secure" : "" )
document.cookie = name + "=" + escape(value) +
expString + pathString + domainString + secureString;
}

//擷取Cookie
function GetCookie(name) {
var result = null;
var myCookie = document.cookie + ";";
var searchName = name + "=";
var startOfCookie = myCookie.indexOf(searchName);
var endOfCookie;
if (startOfCookie != -1) {
startOfCookie += searchName.length;
endOfCookie = myCookie.indexOf(";",startOfCookie);
result = unescape(myCookie.substring(startOfCookie, endOfCookie));
}
return result;
}

//刪除Cookie
function ClearCookie(name) {
var ThreeDays=3*24*60*60*1000;
var expDate = new Date();
expDate.setTime(expDate.getTime()-ThreeDays);
document.cookie=name+"=;expires="+expDate.toGMTString();
}

$(document).ready(function() {  
    if(GetCookie('CheckinDate') != "" && GetCookie('CheckoutDate') != "")
	{
		count = DateDiff(GetCookie('CheckinDate'), GetCookie('CheckoutDate'));
		//N_Date = get_lastDate(GetCookie('CheckinDate'),"",1);
		//alert(N_Date);
		var daulinedate = '';
		var calender = '';
		for(i=0; i<=count; i++)
		{
			Nn_Date = getFormattedDate(get_lastDate(GetCookie('CheckinDate'),"",i));
			//alert(N_Date);
			calender  = Nn_Date.split("-");
			$("#Slt_" + Nn_Date).val(1); // 選擇
			$("#Room_Ck_" + Nn_Date).css("background-color", "#ffd99b");
			daulinedate += "<p class=\"calendar\" onclick=\"RoomDate_Slt('" + Nn_Date + "')\">" + calender[2] + "<em>" + calender[1] + "月</em></p>";
			
		}
		
		$('#Room_Day_Line').html(daulinedate);
	}
});   

function RoomDate_Slt(N_Date)
{
	//alert(N_Date);
	var pre_N_Date = get_lastDate(N_Date,"",1); // 前一天
	var nex_N_Date = get_lastDate(N_Date,"",-1); // 後一天
	var Start_Date = $("#Start_Date").val();
	var End_Date = $("#End_Date").val();
	var daulinedate = '';
	//var N_Date = getFormattedDate(N_Date);
	//alert(checkEndTime("2014-01-02", "2014-01-01"));
	//alert(Start_Date);
	//alert(End_Date);
	//alert(checkEndTime(End_Date, Start_Date));

	if(Start_Date == "" && End_Date == "")
	{
		Start_Date = End_Date = N_Date;
		$("#Start_Date").val(Start_Date);
		$("#End_Date").val(End_Date);
		SetCookie('CheckinDate',Start_Date,null,null,null,null);
		SetCookie('CheckoutDate',End_Date,null,null,null,null);
		if($("#Slt_" + N_Date).val() == "0") {
			$("#Slt_" + N_Date).val(1); // 選擇
			$("#Room_Ck_" + N_Date).css("background-color", "#ffd99b");
		}else{
			$("#Slt_" + N_Date).val(0); // 取消
			$("#Room_Ck_" + N_Date).css("background-color", "#fbf6ee");
		}
		calender  = Start_Date.split("-");
		daulinedate += "<p class=\"calendar\">" + calender[2] + "<em>" + calender[1] + "月</em></p>";
		$('#Room_Day_Line').html(daulinedate);
	}else{
		if(!checkEndTime(Start_Date, N_Date) && getFormattedDate(get_lastDate(Start_Date,"",-1)) == N_Date)
		{
			//alert("輸入日期 < 訂房日"); 
			$("#Start_Date").val(N_Date);
			$("#End_Date").val(End_Date);
			SetCookie('CheckinDate',N_Date,null,null,null,null);
			SetCookie('CheckoutDate',End_Date,null,null,null,null);
			//var count = DateDiff(N_Date, End_Date)
			//alert(DateDiff(N_Date, End_Date));
			L_Date = getFormattedDate(get_lastDate(Start_Date,"",-1));
			//alert(count);
			//alert(N_Date);
			//alert(L_Date);
			//if(N_Date == L_Date) {
			//for(i=0; i<=count; i++)
			//{
				
				if($("#Slt_" + L_Date).val() == "0") {
					$("#Slt_" + L_Date).val(1); // 選擇
					$("#Room_Ck_" + L_Date).css("background-color", "#ffd99b");
				}else{
					$("#Slt_" + L_Date).val(0); // 取消
					$("#Room_Ck_" + L_Date).css("background-color", "#fbf6ee");
				}
			//}	
			//}else{
			//	alert("請選擇連續天數");
			//}
		}else if(Start_Date == N_Date) {
			//alert("訂房日 < 輸入日期 < 退房日s");
				//$("#Start_Date").val(getFormattedDate(get_lastDate(Start_Date,"",1)));
				//$("#End_Date").val(End_Date);
				L_Date = Start_Date;
				if(Start_Date == N_Date && End_Date == N_Date)
				{
					//alert("111");
					ClearCookie('CheckinDate');
					ClearCookie('CheckoutDate');
					$("#Start_Date").attr("value","");
					$("#End_Date").attr("value","");
					$("#Slt_" + L_Date).val(0); // 取消
					$("#Room_Ck_" + L_Date).css("background-color", "#fbf6ee");
					daulinedate = "";
					$('#Room_Day_Line').html(daulinedate);
				}else{
					//alert("222");
					$("#Start_Date").val(getFormattedDate(get_lastDate(Start_Date,"",1)));
				    $("#End_Date").val(End_Date);
					//alert("Start=" + Start_Date + "EndDate=" + End_Date);
					SetCookie('CheckinDate',getFormattedDate(get_lastDate(Start_Date,"",1)),null,null,null,null);
					SetCookie('CheckoutDate',End_Date,null,null,null,null);
					
					//alert(L_Date + " / " + N_Date);
					if($("#Slt_" + L_Date).val() == "0") {
							$("#Slt_" + L_Date).val(1); // 選擇
							$("#Room_Ck_" + L_Date).css("background-color", "#ffd99b");
					  }else{
						  $("#Slt_" + L_Date).val(0); // 取消
						  $("#Room_Ck_" + L_Date).css("background-color", "#fbf6ee");
					  }
				}
		}else if(End_Date == N_Date) {
			//alert("訂房日 < 輸入日期 < 退房日e"); 
			$("#Start_Date").val(Start_Date);
			$("#End_Date").val(getFormattedDate(get_lastDate(End_Date,"",-1)));
			SetCookie('CheckinDate',Start_Date,null,null,null,null);
			SetCookie('CheckoutDate',getFormattedDate(get_lastDate(End_Date,"",-1)),null,null,null,null);
			
			L_Date = End_Date;
			if($("#Slt_" + L_Date).val() == "0") {
					$("#Slt_" + L_Date).val(1); // 選擇
					$("#Room_Ck_" + L_Date).css("background-color", "#ffd99b");
				}else{
					$("#Slt_" + L_Date).val(0); // 取消
					$("#Room_Ck_" + L_Date).css("background-color", "#fbf6ee");
				}
		}else if(getFormattedDate(get_lastDate(End_Date,"",1)) == N_Date){
			//alert("輸入日期 > 退房日"); 
			$("#Start_Date").val(Start_Date);
			$("#End_Date").val(N_Date);
			SetCookie('CheckinDate',Start_Date,null,null,null,null);
			SetCookie('CheckoutDate',N_Date,null,null,null,null);
			
			L_Date = getFormattedDate(get_lastDate(End_Date,"",1));
			if($("#Slt_" + L_Date).val() == "0") {
					$("#Slt_" + L_Date).val(1); // 選擇
					$("#Room_Ck_" + L_Date).css("background-color", "#ffd99b");
				}else{
					$("#Slt_" + L_Date).val(0); // 取消
					$("#Room_Ck_" + L_Date).css("background-color", "#fbf6ee");
				}
		}else{
			alert("請選擇連續天數");
		}
		
		if(GetCookie('CheckinDate') != "" && GetCookie('CheckoutDate') != "" )
		{
			//alert('01');
			count = DateDiff(GetCookie('CheckinDate'), GetCookie('CheckoutDate'));
			//N_Date = get_lastDate(GetCookie('CheckinDate'),"",1);
			//alert(N_Date);
			var daulinedate = '';
			for(i=0; i<=count; i++)
			{
				N_Date = getFormattedDate(get_lastDate(GetCookie('CheckinDate'),"",i));
				//alert(N_Date);
				calender  = N_Date.split("-");
				daulinedate += "<p class=\"calendar\" onclick=\"RoomDate_Slt('" + N_Date + "')\">" + calender[2] + "<em>" + calender[1] + "月</em></p>";
			}
			
			$('#Room_Day_Line').html(daulinedate);
		}
		//var daulinedate = "<p class=\"calendar\">30<em>10月</em></p>"
		//$('#Room_Day_Line').html(daulinedate);

	}
	//alert(get_lastDate($N_Date,"",1));
	<?php
	//date("Y-m-d",strtotime("-1 day")); // 前一天
	//date("Y-m-d",strtotime("+1 day")); // 後一天
	?>
	//$("#Room_Ck_" + $N_Date).addClass("Room_Date_Select");
	
	/*if($("#Slt_" + N_Date).val() == "0") {
		$("#Slt_" + N_Date).val(1); // 選擇
		$("#Room_Ck_" + N_Date).css("background-color", "#ffd99b");
	}else{
		$("#Slt_" + N_Date).val(0); // 取消
		$("#Room_Ck_" + N_Date).css("background-color", "#fbf6ee");
	}*/
}
</script>
<?php
/*********************************************************************
 # 主頁面產品資訊
 *********************************************************************/
?>
<?php
#
# ============== [title] ============== #
#
# 標題部分
?>
<!--標題外框-->
<div style="position:relative;">
<div class="mdtitle TitleBoardStyle">
	<div class="mdtitle_t">
			<div class="mdtitle_t_l"> </div>
			<div class="mdtitle_t_r"> </div>
			<div class="mdtitle_t_c"><!--標題--></div>
			<div class="mdtitle_t_m"><!--更多--></div>
	</div><!--mdtitle_t-->
	<div class="mdtitle_c g_p_hide">
			<div class="mdtitle_c_l g_p_fill"> </div>
			<div class="mdtitle_c_r g_p_fill"> </div>
			<div class="mdtitle_c_c">
					<!-- <div class="mdtitle_m_t"></div>
					<div class="mdtitle_m_c">  --> 
<!--標題外框--> 
<div class="columns on-1">
        <div class="container">
            <div class="column">
                <div class="container ct_board ct_title">
                <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right">線上訂房 - <?php echo $row_RecordRoom['name']; // 標題文字 ?></span></h1>
                </div>
            </div>
        </div>        
</div>
<!--標題外框-->
  				<!--</div>
					<div class="mdtitle_m_b"></div>-->
			</div>
	</div><!--mdtitle_c-->
	<div class="mdtitle_b">
			<div class="mdtitle_b_l"> </div>
			<div class="mdtitle_b_r"> </div>
			<div class="mdtitle_b_c"> </div>
	</div><!--mdtitle_b-->
</div><!--mdtitle-->
</div>
<!-- 標題外框-->
<?php
#
# ============== [/title] ============== #
?> 

<?php 
#
# ============== [if] ============== #
#
# 在此判斷式之內放置要顯示之內容
if ($totalRows_RecordRoom > 0) { // Show if recordset not empty 
?>
<!--外框-->
<div style="position:relative;">
<div class="mdmiddle MiddleBoardStyle">
	<div class="mdmiddle_t">
			<div class="mdmiddle_t_l"> </div>
			<div class="mdmiddle_t_r"> </div>
			<div class="mdmiddle_t_c"><!--標題--></div>
			<div class="mdmiddle_t_m"><!--更多--></div>
	</div><!--mdmiddle_t-->
	<div class="mdmiddle_c g_p_hide">
			<div class="mdmiddle_c_l g_p_fill"> </div>
			<div class="mdmiddle_c_r g_p_fill"> </div>
			<div class="mdmiddle_c_c">
					<!-- <div class="mdmiddle_m_t"></div>
					<div class="mdmiddle_m_c">  --> 
    
    
    <form name="form" id="form">
    <div style="height:5px;"></div>
    <span style="color:#3DA000; font-weight:bolder; padding:5px; margin:5px;"><i class="fa fa-arrow-circle-o-right"></i> 選擇欲查詢房型：</span>
    <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
  
 <?php
do {  
?>
  <?php // 判斷商品所在之層級
                                if($row_RecordRoomList['type1'] != '-1' && $row_RecordRoomList['type2'] != '-1' && $row_RecordRoomList['type3'] != '-1') { $level='2'; }
                                else if($row_RecordRoomList['type1'] != '-1' && $row_RecordRoomList['type2'] != '-1' && $row_RecordRoomList['type3'] == '-1') { $level='1'; }
                                else if($row_RecordRoomList['type1'] != '-1' && $row_RecordRoomList['type2'] == '-1' && $row_RecordRoomList['type3'] == '-1') { $level='0'; }
                                else { $level=''; }
                            ?>
                            <?php if ($level == '2') { ?>
  <option value="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reserve','type1'=>$row_RecordRoomList['type1'],'type2'=>$row_RecordRoomList['type2'],'type3'=>$row_RecordRoomList['type3']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoomList['id']; ?>&MM=<?php echo $_GET['MM']; ?>&YY=<?php echo $_GET['YY']; ?>"<?php if (!(strcmp($row_RecordRoomList['id'], $_GET['id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordRoomList['name']?>  / <?php echo "住房人數：" . $row_RecordRoomList['peoplenum'] . "人" ?></option>
                            <?php } else if ($level == '1') { ?>
                            <option value="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reserve','type1'=>$row_RecordRoomList['type1'],'type2'=>$row_RecordRoomList['type2']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoomList['id']; ?>&MM=<?php echo $_GET['MM']; ?>&YY=<?php echo $_GET['YY']; ?>"<?php if (!(strcmp($row_RecordRoomList['id'], $_GET['id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordRoomList['name']?>  / <?php echo "住房人數：" . $row_RecordRoomList['peoplenum'] . "人" ?></option>
                            <?php } else if ($level == '0') { ?>
                            <option value="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reserve','type1'=>$row_RecordRoomList['type1']),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoomList['id']; ?>&MM=<?php echo $_GET['MM']; ?>&YY=<?php echo $_GET['YY']; ?>"<?php if (!(strcmp($row_RecordRoomList['id'], $_GET['id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordRoomList['name']?>  / <?php echo "住房人數：" . $row_RecordRoomList['peoplenum'] . "人" ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reserve'),'',$UrlWriteEnable);?><?php echo $id_params; ?><?php echo $row_RecordRoomList['id']; ?>&MM=<?php echo $_GET['MM']; ?>&YY=<?php echo $_GET['YY']; ?>"<?php if (!(strcmp($row_RecordRoomList['id'], $_GET['id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordRoomList['name']?>  / <?php echo "住房人數：" . $row_RecordRoomList['peoplenum'] . "人" ?></option>
                            <?php } ?>
  <?php
} while ($row_RecordRoomList = mysqli_fetch_assoc($RecordRoomList));
  $rows = mysqli_num_rows($RecordRoomList);
  if($rows > 0) {
      mysqli_data_seek($RecordRoomList, 0);
	  $row_RecordRoomList = mysqli_fetch_assoc($RecordRoomList);
  }
?>
  </select>
</form>       
<?php

//<-------GET方法提交變更月份,年份;開始-------->

$MM=$_GET["MM"];   
$YYYY=$_GET["YY"];
if($_GET["YY"]=="")
{
$YYYY=date("Y");
}
if($_GET["MM"]=="")
{
$MM=date("m");
}
//<-------GET方法提交變更月份,年份;?束-------->

if($YYYY<1971)//年度最少到1971年，小於1971年，則需回到今年的日曆
{
$YYYY=date("Y");
}
?>
<style type="text/css">
.calendar_blog tr td{
	padding:2px;
}
</style>
<span style="color:#3DA000; font-weight:bolder; padding:5px; margin:5px;"><i class="fa fa-arrow-circle-o-right"></i> 選擇欲訂購日期：</span>
<div style="height:5px;"></div>
<div align="center">
  <table border="0" cellpadding="1px" cellspacing="1px" class="calendar_room">
<tr align="center">
<td colspan="7" style=" background-color:#d8d5be">
<?php
//<-------月份超出1至12的處理;開始------->
if($MM<1)
{
$MM=12;
$YYYY-=1;
}
if($MM>12)
{
$MM=1;
$YYYY+=1;
}
//<-------月份超出1至12的處理;?束------->

//<---------上一年,下一年,上月,下月;開始--------->
/*echo "<a href=$_SERVER[PHP_SELF]?YY=".($YYYY-1)."&MM=".$MM."><<</a>".$YYYY."<a href=$_SERVER[PHP_SELF]?YY=".($YYYY+1)."&MM=".$MM.">>></a>"; //上下年
?>
<?php
echo "<a href=$_SERVER[PHP_SELF]?MM=".($MM-1)."&YY=".$YYYY."><<</a>".$MM."<a href=$_SERVER[PHP_SELF]?MM=".($MM+1)."&YY=".$YYYY.">>></a>";*///上下月
$stringDate = strftime("%d %b %Y",mktime (0,0,0,$MM,1,$YYYY));
        $days = strftime("%d",mktime (0,0,0,$MM+1,0,$YYYY));
        $firstDay = strftime("%w",mktime (0,0,0,$MM,1,$YYYY));
        $lastDay = strftime("%w",mktime (0,0,0,$MM,$days,$YYYY));
        $printDays = $days;
        $preMonth = strftime("%m",mktime (0,0,0,$MM-1,1,$YYYY));
        $preYear = strftime("%Y",mktime (0,0,0,$MM-1,1,$YYYY));
        $nextMonth = strftime("%m",mktime (0,0,0,$MM+1,1,$YYYY));
        $nextYear = strftime("%Y",mktime (0,0,0,$MM+1,1,$YYYY));

          if($_GET['type3'] != "") {
			  echo "<span style=\"font-size:36px; float:left\">" . "<a href=".$SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reserve','type1'=>$_GET['type1'],'type2'=>$_GET['type2'],'type3'=>$_GET['type3']),'',$UrlWriteEnable).$id_params.$_GET['id']."&MM=".$preMonth."&YY=".$preYear."><i class=\"fa fa-chevron-left\"></i></a>" . "</span>";
			  echo "<span style=\"font-size:24px;\">" . $YYYY. "." . $MM . "</span>";
			  echo "<span style=\"font-size:36px; float:right\">" . "<a href=".$SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reserve','type1'=>$_GET['type1'],'type2'=>$_GET['type2'],'type3'=>$_GET['type3']),'',$UrlWriteEnable).$id_params.$_GET['id']."&MM=".$nextMonth."&YY=".$nextYear."><i class=\"fa fa-chevron-right\"></i></a>" . "</span>";		
		  }else if ($_GET['type2'] != "") {
			  echo "<span style=\"font-size:36px; float:left\">" . "<a href=".$SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reserve','type1'=>$_GET['type1'],'type2'=>$_GET['type2']),'',$UrlWriteEnable).$id_params.$_GET['id']."&MM=".$preMonth."&YY=".$preYear."><i class=\"fa fa-chevron-left\"></i></a>" . "</span>";
			  echo "<span style=\"font-size:24px;\">" . $YYYY. "." . $MM . "</span>";
			  echo "<span style=\"font-size:36px; float:right\">" . "<a href=".$SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reserve','type1'=>$_GET['type1'],'type2'=>$_GET['type2']),'',$UrlWriteEnable).$id_params.$_GET['id']."&MM=".$nextMonth."&YY=".$nextYear."><i class=\"fa fa-chevron-right\"></i></a>" . "</span>";	
		  }else if (isset($_GET['type1']) && $_GET['type1'] != "") { 
		      echo "<span style=\"font-size:36px; float:left\">" . "<a href=".$SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reserve','type1'=>$_GET['type1']),'',$UrlWriteEnable).$id_params.$_GET['id']."&MM=".$preMonth."&YY=".$preYear."><i class=\"fa fa-chevron-left\"></i></a>" . "</span>";
			  echo "<span style=\"font-size:24px;\">" . $YYYY. "." . $MM . "</span>";
			  echo "<span style=\"font-size:36px; float:right\">" . "<a href=".$SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reserve','type1'=>$_GET['type1']),'',$UrlWriteEnable).$id_params.$_GET['id']."&MM=".$nextMonth."&YY=".$nextYear."><i class=\"fa fa-chevron-right\"></i></a>" . "</span>";
		  }else {
			  echo "<span style=\"font-size:36px; float:left\">" . "<a href=".$SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reserve'),'',$UrlWriteEnable).$id_params.$_GET['id']."&MM=".$preMonth."&YY=".$preYear."><i class=\"fa fa-chevron-left\"></i></a>" . "</span>";
			  echo "<span style=\"font-size:24px;\">" . $YYYY. "." . $MM . "</span>";
			  echo "<span style=\"font-size:36px; float:right\">" . "<a href=".$SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'reserve'),'',$UrlWriteEnable).$id_params.$_GET['id']."&MM=".$nextMonth."&YY=".$nextYear."><i class=\"fa fa-chevron-right\"></i></a>" . "</span>";
		  }
          

//<--------上一年,下一年,上月,下月;?束--------->
?>
</td>

</td>
</tr>
<tr align=center class="week_text">
<?php
echo "<td style=\"background-color:#e7e6d9\">日</td><td style=\"background-color:#e7e6d9\">一</td><td style=\"background-color:#e7e6d9\">二</td><td style=\"background-color:#e7e6d9\">三</td><td style=\"background-color:#e7e6d9\">四</td><td style=\"background-color:#e7e6d9\">五</td><td style=\"background-color:#e7e6d9\">六</td>";
echo "</tr>";
echo "<tr>";
$d=date("d");
$FirstDay=date("w",mktime(0,0,0,$MM,1,$YYYY));//取得任何一個月的一號是星期幾，來計自一號從第幾格開始。
$bgtoday=date("d");
function font_color($MM,$today,$YYYY)//計算星期天的字體顏色。
{
$sunday=date("w",mktime(0,0,0,$MM,$today,$YYYY));
if($sunday=="0")
{
$FontColor="red";
}
else
{
$FontColor="black";
}
return $FontColor;
}
function bgcolor($MM,$bgtoday,$today_i,$YYYY)//計算當日的背景顏色。
{
$show_today=date("d",mktime(0,0,0,$MM,$today_i,$YYYY));
$sys_today=date("d",mktime(0,0,0,$MM,$bgtoday,$YYYY));
if($show_today==$sys_today)
{
$bgcolor="bgcolor=#6699FF";
}
else
{
$bgcolor="";
}
return $bgcolor;
}
function font_style($MM,$today,$YYYY)//計算星期天的字體風格。
{
$sunday=date("w",mktime(0,0,0,$MM,$today,$YYYY));
if($sunday=="0")
{
$FontStyle="<strong>";
}
else
{
$FontStyle="";
}
return $FontStyle;
}
// 取得價格 1號  ============================================================================================
$colname_RecordRoomFirstCalendar = "-1";
if (isset($_GET['id'])) {
  $colname_RecordRoomFirstCalendar = $_GET['id'];
}
$colroomdate_RecordRoomFirstCalendar = "-1";
//if (isset($i) && $i != "") {
  $c_date = $YYYY . "-" . $MM . "-" . "01";
  $colroomdate_RecordRoomFirstCalendar = date('Y-m-d',strtotime($c_date));;
//}
if (isset($_GET['id'])) {
  $colname_RecordRoomFirstCalendar = $_GET['id'];
}
$coluserid_RecordRoomFirstCalendar = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordRoomFirstCalendar = $_SESSION['userid'];
}
$collang_RecordRoomFirstCalendar = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordRoomFirstCalendar = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordRoomFirstCalendar = sprintf("SELECT * FROM demo_roomcalendar WHERE roomid = %s && roomdate = %s && lang=%s && userid=%s && doublecheck=1", GetSQLValueString($colname_RecordRoomFirstCalendar, "int"), GetSQLValueString($colroomdate_RecordRoomFirstCalendar, "date"),GetSQLValueString($collang_RecordRoomFirstCalendar, "text"),GetSQLValueString($coluserid_RecordRoomFirstCalendar, "int"));
$RecordRoomFirstCalendar = mysqli_query($DB_Conn, $query_RecordRoomFirstCalendar) or die(mysqli_error($DB_Conn));
$row_RecordRoomFirstCalendar = mysqli_fetch_assoc($RecordRoomFirstCalendar);
$totalRows_RecordRoomFirstCalendar = mysqli_num_rows($RecordRoomFirstCalendar);
// 取得價格 1號 ============================================================================================
for($i=0;$i<=$FirstDay;$i++)//用for輸出每個月一號的位置
{
for($i;$i<$FirstDay;$i++)
{
echo "<td align=\"center\">&nbsp;</td>\n";
}
if($i==$FirstDay)
{
// 取得價格 ============================================================================================
$colname_RecordRoomCalendar = "-1";
if (isset($_GET['id'])) {
  $colname_RecordRoomCalendar = $_GET['id'];
}
$colroomdate_RecordRoomCalendar = "-1";
if (isset($i) && $i != "") {
  $c_date = $YYYY . "-" . $MM . "-" . $i;
  $colroomdate_RecordRoomCalendar = date('Y-m-d',strtotime($c_date));;
}
if (isset($_GET['id'])) {
  $colname_RecordRoomCalendar = $_GET['id'];
}
$coluserid_RecordRoomCalendar = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordRoomCalendar = $_SESSION['userid'];
}
$collang_RecordRoomCalendar = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordRoomCalendar = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordRoomCalendar = sprintf("SELECT * FROM demo_roomcalendar WHERE roomid = %s && roomdate = %s && lang=%s && userid=%s && doublecheck=1", GetSQLValueString($colname_RecordRoomCalendar, "int"), GetSQLValueString($colroomdate_RecordRoomCalendar, "date"),GetSQLValueString($collang_RecordRoomCalendar, "text"),GetSQLValueString($coluserid_RecordRoomCalendar, "int"));
$RecordRoomCalendar = mysqli_query($DB_Conn, $query_RecordRoomCalendar) or die(mysqli_error($DB_Conn));
$row_RecordRoomCalendar = mysqli_fetch_assoc($RecordRoomCalendar);
$totalRows_RecordRoomCalendar = mysqli_num_rows($RecordRoomCalendar);
// 取得價格 ============================================================================================
//mysqli_select_db($database_DB_Conn, $DB_Conn);
            //$query_RecordsetCat = "SELECT SUM(dcquantiry) AS chickinpeople FROM demo_roomdetail where date(dcroomdate)='" .($YYYY . "-" . $MM ."-" . substr("0" . 1,-2))."' && userid=". $_SESSION['userid'] . "&& roomid=" . $_GET['id'];
			$query_RecordsetCat = "SELECT * FROM demo_roomdetail where date(dcroomdate)='" .($YYYY . "-" . $MM ."-" . substr("0" . 1,-2))."' && userid=". $_SESSION['userid'] . "&& roomid=" . $_GET['id'];
            $RecordsetCat = mysqli_query($DB_Conn, $query_RecordsetCat) or die(mysqli_error($DB_Conn));
            $row_RecordsetCat = mysqli_fetch_assoc($RecordsetCat);	
		    $Count_RoomCat = 0; 
		    do {
		    $Count_RoomCat += $row_RecordsetCat['dcquantiry'];
		    } while ($row_RecordsetCat = mysqli_fetch_assoc($RecordsetCat)); 
$chickroomnum = $row_RecordRoomFirstCalendar['roomnum'] - $Count_RoomCat;
if($totalRows_RecordRoomFirstCalendar > 0 && (margin(date("Y-m-d"), $YYYY . "-" . $MM . "-01")) >= 0 && $chickroomnum > 0 && $row_RecordRoomFirstCalendar['indicate'] == 1) {
	echo "<td align=center id=\"Room_Ck_$YYYY-$MM-01\" onclick=\"RoomDate_Slt(" . "'" . $YYYY . "-" . $MM . "-" . "01" . "'" . ")\">";
}else{
	echo "<td align=center id=\"Room_Ck_$YYYY-$MM-01\" >";
}
//echo "1";
echo "<input type=\"hidden\" id=\"Slt_$YYYY-$MM-01\" value=\"0\" >";

            //if(($YYYY . "-" . $MM ."-" . substr("0" . 1,-2))==date("Y-m-d",strtotime($row_RecordsetCat['checkindate']))){
           // print("<a href=".$_SERVER['PHP_SELF'] ."?wshop=".$_GET['wshop']."&amp;Opt=viewpage&amp;tp=Blog&amp;lang=".$_SESSION['lang']."&MM=".$MM."&YY=".$YYYY."&DD=" . substr("0" . 1,-2) . "><b>1</b></a>");
            //}else{
				//echo $Count_RoomCat; // 取得目前訂房人數
				//echo margin(date("Y-m-d"), $YYYY . "-" . $MM . "-01");
				if($row_RecordRoomFirstCalendar['indicate'] == 1) {
					
					if($totalRows_RecordRoomFirstCalendar > 0 && (margin(date("Y-m-d"), $YYYY . "-" . $MM . "-01")) >= 0 && $chickroomnum > 0) {
						echo "<div class=\"Room_Date_Num_y\">" . "01" . "</div>"; // 顯示日期幾號
					}else if($totalRows_RecordRoomFirstCalendar > 0  && (margin(date("Y-m-d"), $YYYY . "-" . $MM . "-" . $dd)) >= 0 && $chickroomnum <= 0){
						echo "<div class=\"Room_Date_Num_f\">" . "01" . "</div>"; // 顯示日期幾號
					}else{
						echo "<div class=\"Room_Date_Num_n\">" . "01" . "</div>"; // 顯示日期幾號
					}
				
				}else{
					echo "<div class=\"Room_Date_Num_n\">" . "01" . "</div>";
				}

//echo $totalRows_RecordRoomCalendar;

// 取得價格 ===========================================================================================

if($row_RecordRoomFirstCalendar['indicate'] == 1 && $totalRows_RecordRoomFirstCalendar > 0) {
	
	if($totalRows_RecordRoomFirstCalendar > 0  && (margin(date("Y-m-d"), $YYYY . "-" . $MM . "-" . "01")) >= 0 && $chickroomnum > 0) {
	echo $row_RecordRoomFirstCalendar['roomprice'] . "元";
	//echo $row_RecordRoomFirstCalendar['roomdate'] . "";
	echo "<br>";
	echo "<span style=\"color:#0f5ef0; font-weight:bolder;\">餘" . $chickroomnum . "間<span>";
	}else if($totalRows_RecordRoomFirstCalendar > 0  && (margin(date("Y-m-d"), $YYYY . "-" . $MM . "-" . "01")) >= 0 && $chickroomnum <= 0){ 
		echo "<span style=\"color:#FF9DA5; font-weight:bolder;\">客滿</span>";
	}else{
		echo "<span style=\"color:#DDD; font-weight:bolder;\">未開放</span>";
	}
	
}else if($totalRows_RecordRoomFirstCalendar == 0){
	echo "<span style=\"color:#DDD; font-weight:bolder;\">未開放</span>";
}else{
	echo "<span style=\"color:#DDD; font-weight:bolder;\">保留</span>";
}
mysqli_free_result($RecordRoomFirstCalendar);

// 取得價格 ============================================================================================
           // }
echo "</font></td>\n";
if($FirstDay==6)//判斷1號是否星期六
{
echo "</tr>";
}
}
}
$countMonth=date("t",mktime(0,0,0,$MM,1,$YYYY));//某月的總天數
for($i=2;$i<=$countMonth;$i++)//輸出由1號定位,隨後2號直至月尾的所有號數
{
//echo "<td align=center>";
//echo $i."*";		
			switch($i)
			{
				case '2':
					$dd = "0" . $i;
				break;
				case '3':
					$dd = "0" . $i;
				break;
				case '4':
					$dd = "0" . $i;
				break;
				case '5':
					$dd = "0" . $i;
				break;
				case '6':
					$dd = "0" . $i;
				break;
				case '7':
					$dd = "0" . $i;
				break;
				case '8':
					$dd = "0" . $i;
				break;
				case '9':
					$dd = "0" . $i;
				break;
				default:
					$dd = $i;
				break;
			}
            //mysqli_select_db($database_DB_Conn, $DB_Conn);
            //$query_RecordsetCa = "SELECT SUM(dcquantiry) AS chickinpeople FROM demo_roomdetail where date(dcroomdate)='" .($YYYY . "-" . $MM ."-" . substr("0" . $i,-2))."' && userid=". $_SESSION['userid'] . "&& roomid=" . $_GET['id'];
			$query_RecordsetCa = "SELECT * FROM demo_roomdetail where date(dcroomdate)='" .($YYYY . "-" . $MM ."-" . substr("0" . $i,-2))."' && userid=". $_SESSION['userid'] . "&& roomid=" . $_GET['id'];
			//$query_RecordsetCa = "SELECT checkindate, checkoutdate FROM demo_roomorders where userid=". $_SESSION['userid'];
            $RecordsetCa = mysqli_query($DB_Conn, $query_RecordsetCa) or die(mysqli_error($DB_Conn));
            $row_RecordsetCa = mysqli_fetch_assoc($RecordsetCa);	
			$Count_RoomCa = 0; 
		    do {
		    $Count_RoomCa += $row_RecordsetCa['dcquantiry'];
		    } while ($row_RecordsetCa = mysqli_fetch_assoc($RecordsetCa)); 
            //echo strtotime($YYYY . "-" . $MM ."-" . substr("0" . $i,-2)) . "/n";
            
// 取得價格 ============================================================================================
$colname_RecordRoomCalendar = "-1";
if (isset($_GET['id'])) {
  $colname_RecordRoomCalendar = $_GET['id'];
}
$colroomdate_RecordRoomCalendar = "-1";
if (isset($i) && $i != "") {
  $c_date = $YYYY . "-" . $MM . "-" . $i;
  $colroomdate_RecordRoomCalendar = date('Y-m-d',strtotime($c_date));;
}
if (isset($_GET['id'])) {
  $colname_RecordRoomCalendar = $_GET['id'];
}
$coluserid_RecordRoomCalendar = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordRoomCalendar = $_SESSION['userid'];
}
$collang_RecordRoomCalendar = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordRoomCalendar = $_GET['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordRoomCalendar = sprintf("SELECT * FROM demo_roomcalendar WHERE roomid = %s && roomdate = %s && lang=%s && userid=%s && doublecheck=1", GetSQLValueString($colname_RecordRoomCalendar, "int"), GetSQLValueString($colroomdate_RecordRoomCalendar, "date"),GetSQLValueString($collang_RecordRoomCalendar, "text"),GetSQLValueString($coluserid_RecordRoomCalendar, "int"));
$RecordRoomCalendar = mysqli_query($DB_Conn, $query_RecordRoomCalendar) or die(mysqli_error($DB_Conn));
$row_RecordRoomCalendar = mysqli_fetch_assoc($RecordRoomCalendar);
$totalRows_RecordRoomCalendar = mysqli_num_rows($RecordRoomCalendar);
// 取得價格 ============================================================================================
$chickroomnum = $row_RecordRoomCalendar['roomnum'] - $Count_RoomCa;
if($totalRows_RecordRoomCalendar > 0 && (margin(date("Y-m-d"), $YYYY . "-" . $MM . "-" . $dd)) >= 0 && $chickroomnum > 0 && $row_RecordRoomCalendar['indicate'] == 1) {
				echo "<td align=center id=\"Room_Ck_$YYYY-$MM-$dd\" onclick=\"RoomDate_Slt(" . "'" . $YYYY . "-" . $MM . "-" . $dd . "'" . ")\">";
}else{
	echo "<td align=center id=\"Room_Ck_$YYYY-$MM-$dd\" >";
}
				echo "<input type=\"hidden\" id=\"Slt_$YYYY-$MM-$dd\" value=\"0\">";
				
				if($row_RecordRoomCalendar['indicate'] == 1) {
					 //echo $Count_RoomCa; // 取得目前訂房人數
					 if($totalRows_RecordRoomCalendar > 0 && (margin(date("Y-m-d"), $YYYY . "-" . $MM . "-" . $dd)) >= 0 && $chickroomnum > 0) {
						echo "<div class=\"Room_Date_Num_y\">" . $dd . "</div>"; // 顯示日期幾號
					}else if($totalRows_RecordRoomCalendar > 0  && (margin(date("Y-m-d"), $YYYY . "-" . $MM . "-" . $dd)) >= 0 && $chickroomnum <= 0){
						echo "<div class=\"Room_Date_Num_f\">" . $dd . "</div>"; // 顯示日期幾號
					}else{
						echo "<div class=\"Room_Date_Num_n\">" . $dd . "</div>"; // 顯示日期幾號
					}
				
				 }else{
					echo "<div class=\"Room_Date_Num_n\">" . $dd . "</div>";
				}


//echo $totalRows_RecordRoomCalendar;
// 取得價格 ============================================================================================
if($row_RecordRoomCalendar['indicate'] == 1 && $totalRows_RecordRoomCalendar > 0) {

	if($totalRows_RecordRoomCalendar > 0  && (margin(date("Y-m-d"), $YYYY . "-" . $MM . "-" . $dd)) >= 0 && $chickroomnum > 0) {
	echo $row_RecordRoomCalendar['roomprice'] . "元";
	//echo $row_RecordRoomCalendar['roomdate'] . "";
	echo "<br>";
	echo "<span style=\"color:#0f5ef0; font-weight:bolder;\">餘" . $chickroomnum . "間<span>";
	}else if($totalRows_RecordRoomCalendar > 0  && (margin(date("Y-m-d"), $YYYY . "-" . $MM . "-" . $dd)) >= 0 && $chickroomnum <= 0){ 
		echo "<span style=\"color:#FF9DA5; font-weight:bolder;\">客滿</span>";
	}else{
		echo "<span style=\"color:#DDD; font-weight:bolder;\">未開放</span>";
	}

}else if($totalRows_RecordRoomCalendar == 0){
	echo "<span style=\"color:#DDD; font-weight:bolder;\">未開放</span>";
}else{
	echo "<span style=\"color:#DDD; font-weight:bolder;\">保留</span>";
}


mysqli_free_result($RecordRoomCalendar);

// 取得價格 ============================================================================================


				
				//echo $YYYY . "-" . $MM ."-" . substr("0" . $i,-2); // 目前此格之日期
				//echo $FirstDay; // 0 - 日 / 1 - 一 / ....
				/*$n_week = date("w",mktime(0,0,0,$MM,$i,$YYYY));
				switch($n_week)
				{
					case "0":
					$n_week_cg = "日";
					break;
					case "1":
					$n_week_cg = "一";
					break;
					case "2":
					$n_week_cg = "二";
					break;
					case "3":
					$n_week_cg = "三";
					break;
					case "4":
					$n_week_cg = "四";
					break;
					case "5":
					$n_week_cg = "五";
					break;
					case "6":
					$n_week_cg = "六";
					break;
				}
				echo "(" . $n_week_cg . ")"; // 判斷星期幾 // 0 - 日 / 1 - 一 / ....*/
				echo "</td>\n";
            	//echo "空";
				//echo $YYYY . "-" . $MM ."-" . substr("0" . $i,-2);
            
//echo "</td>\n";

if(date("w",mktime(0,0,0,$MM,$i,$YYYY))==6)//判斷該日是否星期六
{
echo "</tr>\n";
}

}
?>
</table>
</div>

<div>
<form id="form_Room" name="form_Room" method="post" action="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'roomlist'),'',$UrlWriteEnable);?>">
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="calendar_room_dayline">
  <tr>
    <td width="120" align="center" valign="middle" style="font-weight:bolder; color:#A2A2A2;"><i class="fa fa-calendar" style="font-size:36px"></i><br> 所選日期</td>
    <td><div style="width:100%; padding:10px;" id="Room_Day_Line"></div></td>
  </tr>
  </table>
<div style=" clear:both"></div>
<div style="text-align:center;"><input type="submit" form="form_Room" value="下一步，檢視可訂購房型"></div>
<input name="Start_Date" type="hidden" id="Start_Date" value="<?php echo $_COOKIE["CheckinDate"]; ?>">
<input name="End_Date" type="hidden" id="End_Date" value="<?php echo $_COOKIE["CheckoutDate"]; ?>">
<input name="id" type="hidden" id="id" value="<?php echo $row_RecordRoom['id']; ?>" />
<input name="name" type="hidden" id="name" value="<?php echo $row_RecordRoom['name']; ?>" />
<input name="wshop" type="hidden" id="wshop" value="<?php echo $_GET['wshop']; ?>" />
</form>
</div>
<!--◎可訂房：即該飯店之該房型仍有庫存，可進行直接線上立即確認之訂房，並須於線上完成刷卡付款程序。 
◎可候補：即該飯店之該房型已無線上訂房庫存，候補之訂房將直接通知飯店訂房組，進行庫存確認，此時訂房尚未被確認。若有空房時，飯店將以電子郵件通知訂房人，請訂房人上網訂房並完成刷卡付款程序。 
◎客滿：即該飯店之該房型於當日已經完全客滿，無法接受更多訂房。此時建議消費者改訂其他飯店。
-->



			  <!--</div>
					<div class="mdmiddle_m_b"></div>-->
			</div>
	</div><!--mdmiddle_c-->
	<div class="mdmiddle_b">
			<div class="mdmiddle_b_l"> </div>
			<div class="mdmiddle_b_r"> </div>
			<div class="mdmiddle_b_c"> </div>
	</div><!--mdmiddle_b-->
</div><!--mdmiddle-->
</div>
<!--外框-->
<?php 
} // Show if recordset not empty 
#
# ============== [/if] ============== #
?>
  
<?php 
#
# ============== [if] ============== #
#
# 判斷當無資料顯示時之畫面
if ($totalRows_RecordRoom == 0) { // Show if recordset empty 
?>
<!--外框-->
<div style="position:relative;">
<div class="mdmiddle MiddleBoardStyle">
	<div class="mdmiddle_t">
			<div class="mdmiddle_t_l"> </div>
			<div class="mdmiddle_t_r"> </div>
			<div class="mdmiddle_t_c"><!--標題--></div>
			<div class="mdmiddle_t_m"><!--更多--></div>
	</div><!--mdmiddle_t-->
	<div class="mdmiddle_c g_p_hide">
			<div class="mdmiddle_c_l g_p_fill"> </div>
			<div class="mdmiddle_c_r g_p_fill"> </div>
			<div class="mdmiddle_c_c">
					<!-- <div class="mdmiddle_m_t"></div>
					<div class="mdmiddle_m_c">  --> 
<!--外框-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><table width="250" border="0" cellspacing="0" cellpadding="0">
      <tr>
          <td width="61"><img src="<?php echo $SiteBaseUrl; ?>images/error_tip.png" width="60" height="60" /></td>
          <td width="189"><?php echo $Lang_Error_NoSearch //目前尚無資料 ?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><?php if (isset($_SESSION['MM_UserGroup'])) { ?>您可登入後台之維護介面：  <strong style="color:#090;"><?php echo $ModuleName['Room']; // 標題文字 ?>  →  新增</strong> 來建立該項目<?php } ?></td>
  </tr>
</table>
<br />
<br />
<!--外框-->
  				<!--</div>
					<div class="mdmiddle_m_b"></div>-->
	  </div>
	</div><!--mdmiddle_c-->
	<div class="mdmiddle_b">
			<div class="mdmiddle_b_l"> </div>
			<div class="mdmiddle_b_r"> </div>
			<div class="mdmiddle_b_c"> </div>
	</div><!--mdmiddle_b-->
</div><!--mdmiddle-->
</div>
<!--外框-->
<?php 
} // Show if recordset empty 
#
# ============== [/if] ============== #
?>