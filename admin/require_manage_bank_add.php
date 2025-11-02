<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once("../inc/inc_function.php"); ?>
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

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Bank")) {
  $insertSQL = sprintf("INSERT INTO invoicing_bank(name, swiftcode, bankaccount, notes1, lang, userid) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['swiftcode'], "text"),
                       GetSQLValueString($_POST['bankaccount'], "text"),
                       GetSQLValueString($_POST['notes1'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  $_SESSION['DB_Add'] = "Success";
 
  $insertGoTo = "manage_bank.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
} 
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 銀行帳戶 <small>新增</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-plus"></i> 新增資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">銀行帳號名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
          
                      <input name="name" type="text" id="name" maxlength="200" class="form-control" data-parsley-trigger="blur" required=""/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
        <label class="col-md-2 col-form-label">總行代號<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
              <select name="swiftcode" id="swiftcode" class="form-control" data-parsley-trigger="blur" required="">
                  <option value="">-- 選擇總行代號 --</option>
                  <option value="004">004 - 臺灣銀行</option>
                  <option value="005">005 - 土地銀行</option>
                  <option value="006">006 - 合作金庫商業銀行</option>
                  <option value="007">007 - 第一銀行</option>
                  <option value="008">008 - 華南銀行</option>
                  <option value="009">009 - 彰化銀行</option>
                  <option value="011">011 - 上海商業儲蓄銀行</option>
                  <option value="012">012 - 台北富邦銀行</option>
                  <option value="013">013 - 國泰世華銀行</option>
                  <option value="016">016 - 高雄銀行</option>
                  <option value="017">017 - 兆豐國際商業銀行</option>
                  <option value="018">018 - 農業金庫</option>
                  <option value="021">021 - 花旗（台灣）商業銀行</option>
                  <option value="022">022 - 美國銀行</option>
                  <option value="025">025 - 首都銀行</option>
                  <option value="039">039 - 澳商澳盛銀行</option>
                  <option value="040">040 - 中華開發工業銀行</option>
                  <option value="050">050 - 臺灣企銀</option>
                  <option value="052">052 - 渣打國際商業銀行</option>
                  <option value="053">053 - 台中商業銀行</option>
                  <option value="054">054 - 京城商業銀行</option>
                  <option value="072">072 - 德意志銀行</option>
                  <option value="075">075 - 東亞銀行</option>
                  <option value="081">081 - 匯豐（台灣）商業銀行</option>
                  <option value="085">085 - 新加坡商新加坡華僑銀行</option>
                  <option value="101">101 - 瑞興商業銀行</option>
                  <option value="102">102 - 華泰銀行</option>
                  <option value="103">103 - 臺灣新光商銀</option>
                  <option value="104">104 - 台北五信</option>
                  <option value="108">108 - 陽信商業銀行</option>
                  <option value="114">114 - 基隆一信</option>
                  <option value="115">115 - 基隆二信</option>
                  <option value="118">118 - 板信商業銀行</option>
                  <option value="119">119 - 淡水一信</option>
                  <option value="120">120 - 淡水信合社</option>
                  <option value="124">124 - 宜蘭信合社</option>
                  <option value="127">127 - 桃園信合社</option>
                  <option value="130">130 - 新竹一信</option>
                  <option value="132">132 - 新竹三信</option>
                  <option value="146">146 - 台中二信</option>
                  <option value="147">147 - 三信商業銀行</option>
                  <option value="158">158 - 彰化一信</option>
                  <option value="161">161 - 彰化五信</option>
                  <option value="162">162 - 彰化六信</option>
                  <option value="163">163 - 彰化十信</option>
                  <option value="165">165 - 鹿港信合社</option>
                  <option value="178">178 - 嘉義三信</option>
                  <option value="188">188 - 台南三信</option>
                  <option value="204">204 - 高雄三信</option>
                  <option value="215">215 - 花蓮一信</option>
                  <option value="216">216 - 花蓮二信</option>
                  <option value="222">222 - 澎湖一信</option>
                  <option value="223">223 - 澎湖二信</option>
                  <option value="224">224 - 金門信合社</option>
                  <option value="503">503 - 基隆漁會</option>
                  <option value="504">504 - 瑞芳／萬里漁會</option>
                  <option value="505">505 - 頭城／蘇澳漁會</option>
                  <option value="506">506 - 桃園漁會</option>
                  <option value="507">507 - 新竹漁會</option>
                  <option value="512">512 - 雲林區漁會</option>
                  <option value="515">515 - 嘉義區漁會</option>
                  <option value="517">517 - 南市區漁會</option>
                  <option value="518">518 - 南縣區漁會</option>
                  <option value="520">520 - 小港區漁會；高雄區漁會</option>
                  <option value="521">521 - 彌陀／永安／興達港／林園區漁會</option>
                  <option value="523">523 - 東港／琉球／林邊區漁會</option>
                  <option value="524">524 - 新港區漁會</option>
                  <option value="525">525 - 澎湖區漁會</option>
                  <option value="603">603 - 基隆地區農會</option>
                  <option value="605">605 - 高雄市農會</option>
                  <option value="606">606 - 新北市農會</option>
                  <option value="607">607 - 宜蘭地區農會</option>
                  <option value="608">608 - 桃園地區農會</option>
                  <option value="610">610 - 新竹地區農會</option>
                  <option value="611">611 - 後龍農會</option>
                  <option value="612">612 - 豐原市農會；神岡鄉農會</option>
                  <option value="613">613 - 名間農會</option>
                  <option value="614">614 - 彰化地區農會</option>
                  <option value="616">616 - 雲林地區農會</option>
                  <option value="617">617 - 嘉義地區農會</option>
                  <option value="618">618 - 台南地區農會</option>
                  <option value="619">619 - 高雄地區農會</option>
                  <option value="620">620 - 屏東地區農會</option>
                  <option value="621">621 - 花蓮地區農會</option>
                  <option value="622">622 - 台東地區農會</option>
                  <option value="623">623 - 台北市農會</option>
                  <option value="624">624 - 澎湖農會</option>
                  <option value="625">625 - 台中市農會</option>
                  <option value="627">627 - 連江縣農會</option>
                  <option value="700">700 - 中華郵政</option>
                  <option value="803">803 - 聯邦商業銀行</option>
                  <option value="805">805 - 遠東銀行</option>
                  <option value="806">806 - 元大銀行</option>
                  <option value="807">807 - 永豐銀行</option>
                  <option value="808">808 - 玉山銀行</option>
                  <option value="809">809 - 凱基銀行</option>
                  <option value="810">810 - 星展銀行</option>
                  <option value="812">812 - 台新銀行</option>
                  <option value="814">814 - 大眾銀行</option>
                  <option value="815">815 - 日盛銀行</option>
                  <option value="816">816 - 安泰銀行</option>
                  <option value="822">822 - 中國信託</option>
                  <option value="901">901 - 大里市農會</option>
                  <option value="903">903 - 汐止農會</option>
                  <option value="904">904 - 新莊農會</option>
                  <option value="910">910 - 財團法人農漁會聯合資訊中心</option>
                  <option value="912">912 - 冬山農會</option>
                  <option value="916">916 - 草屯農會</option>
                  <option value="922">922 - 台南市農會</option>
                  <option value="928">928 - 板橋農會</option>
                  <option value="951">951 - 北農中心</option>
                  <option value="954">954 - 中南部地區農漁會</option>
				    </select>
                    
 
                   
</div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">銀行帳號<span class="text-red">*</span></label>
          <div class="col-md-10">
          
                      <input name="bankaccount" type="text" id="bankaccount" maxlength="200" class="form-control" data-parsley-trigger="blur" required=""/>
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_1" value="1" checked />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">上傳時間<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="postdate" type="text" class="form-control date-picker" id="postdate" value="<?php $dt = new DateTime(); echo $dt->format('Y-m-d'); ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" data-date-language="zh-TW" required="" autocomplete="off"/> 
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" id="notes1" size="50" maxlength="50" class="form-control"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_insert" value="form_Bank" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<script type="text/javascript">
$(document).ready(function() {
			$("#change_unit01").click(function(){
					CKEDITOR.instances.content.insertHtml("<img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px; padding:5px; float:left;\" />");
			});
			
			$("#change_unit02").click(function(){
					CKEDITOR.instances.content.insertHtml("<img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px; padding:5px; float:right;\" />");
			});
			
			$("#change_unit03").click(function(){
					CKEDITOR.instances.content.insertHtml("<img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px; padding:5px; float:none;\" /><br />");
			});
			
			$("#change_unit04").click(function(){
					CKEDITOR.instances.content.insertHtml("<p style=\"text-align:center\"><img alt=\"\" height=\"180\" src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" style=\"display: block; margin: auto;\" width=\"240\" /></p>");
			});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#postdate').datepicker() 
			.on('changeDate', function(e) { 
			 $(this).parsley().validate(); 
		}); 
	});
</script>
