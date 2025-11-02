<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>
<form id="myform" action="https://logistics.ecpay.com.tw/Express/map" class="form-horizontal form-bordered" method="post">
　　<input type="hidden" name="MerchantID" value="2000132" /> <!--廠商編號-->
　　<input type="hidden" name="MerchantTradeNo" value="ducktest001" /> <!--廠商交易編號-->
　　<input type="hidden" name="ServerReplyURL" value="http://<?php echo $_SERVER['HTTP_HOST'] ?> /allpay_order_get_cart1.php?wshop=<?php echo $_POST['wshop'] ?>" />  <!-- Server 回覆網址-->
　　<input type="hidden" name="Device" value="0" />  <!--使用設備-->
　　<input type="hidden" name="LogisticsType" value="CVS" /> <!--物流類型-->
　　<div class="form-horizontal form-bordered" >
　　　　<div id="subStyleDiv" class="form-group" >
　　　　　　<label class="col-md-3 control-label">運送類型：</label>
　　　　　　<div class="col-md-6">
　　　　　　　　<select id="sendSubStyle" name="LogisticsSubType" class="form-control" title="Please select Shoulder" aria-required="true">
　　　　　　　　　　<option id="FAMIC2C" value="FAMIC2C">全家交貨便</option>
　　　　　　　　　　<option id="UNIMARTC2C" value="UNIMARTC2C">統一超商交貨便</option>
　　　　　　　　　　<option id="HILIFEC2C" value="HILIFEC2C">萊爾富店到店</option>
　　　　　　　　　　<option id="FAMI" value="FAMI">全家</option>
　　　　　　　　　　<option id="UNIMART" value="UNIMART">統一超商</option>
　　　　　　　　　　<option id="HILIFE" value="HILIFE">萊爾富</option>
　　　　　　　　</select>
　　　　　　</div>
　　　　</div>
　　　　<div class="form-group" style="text-align: center;">
　　　　　　<label class="col-md-3 control-label"></label>
　　　　　　<div class="col-md-6" style="font-family:'微軟正黑體'"> 
　　　　　　　　<button type="submit" class="btn btn-md btn-warning">下一步</button>
　　　　　　　　<button type="reset" class="btn btn-md btn-default" style="color:#000000;border-color:#ccc;background-color:#FFFFFF">重填</button>　　
　　　　　　</div>
　　　　</div>
　　</div>
</form>
</body>
</html>