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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE demo_setting_fr SET SiteDecsHome_cn=%s, SiteMail_cn=%s, SiteAuthor_cn=%s, SiteSName_cn=%s, SitePhone_cn=%s, SiteCell_cn=%s, SiteFax_cn=%s, SiteAddr_cn=%s, SiteAddrX=%s, SiteAddrY=%s, contacttitle_cn=%s, contacttitleindicate=%s, contactcontent_cn=%s, googlemapindicate=%s, formindicate=%s WHERE id=%s",
                       GetSQLValueString($_POST['SiteDecsHome'], "text"),
                       GetSQLValueString($_POST['sitemail'], "text"),
                       GetSQLValueString($_POST['siteauthor'], "text"),
                       GetSQLValueString($_POST['SiteSName'], "text"),
                       GetSQLValueString($_POST['SitePhone'], "text"),
                       GetSQLValueString($_POST['SiteCell'], "text"),
                       GetSQLValueString($_POST['SiteFax'], "text"),
                       GetSQLValueString($_POST['SiteAddr'], "text"),
                       GetSQLValueString($_POST['SiteAddrX'], "text"),
                       GetSQLValueString($_POST['SiteAddrY'], "text"),
                       GetSQLValueString($_POST['contacttitle'], "text"),
                       GetSQLValueString($_POST['contacttitleindicate'], "int"),
                       GetSQLValueString($_POST['contactcontent'], "text"),
                       GetSQLValueString($_POST['googlemapindicate'], "int"),
					   GetSQLValueString($_POST['formindicate'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

$coluserid_RecordSystemConfigFr = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSystemConfigFr = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSystemConfigFr = sprintf("SELECT * FROM demo_setting_fr WHERE userid=%s", GetSQLValueString($coluserid_RecordSystemConfigFr, "int"));
$RecordSystemConfigFr = mysqli_query($DB_Conn, $query_RecordSystemConfigFr) or die(mysqli_error($DB_Conn));
$row_RecordSystemConfigFr = mysqli_fetch_assoc($RecordSystemConfigFr);
$totalRows_RecordSystemConfigFr = mysqli_num_rows($RecordSystemConfigFr);
?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo $GoogleMapAPICode; ?>"></script>
<script type="text/javascript" src="../js/jquery.twzipcode-1.6.0.min.js"></script>
<script>
 $(document).ready(function () {
	 initialize();
	$('#SiteAddr').blur(function(){
	  var addr = $('#SiteAddr').val();
	  if(addr != '') {
	  var opt_direction = {
		center: addr,
		zoom: 15,
		marker: [
            {addr: addr, text: '', label: '', css: 'Googlemap_label'}
        ]
		};
		
		$('#out').empty().html('<div class="alert alert-secondary fade show m-b-10" style="z-index:1000"><span class="close" data-dismiss="alert">×</span>拖曳【<i class="fa fa-map-marker"></i>】可設定更精確座標點<div id="map_canvas" class="" style="width:350px; height:350px;"></div></div>');
		initialize(); // 初始化
		//GetAddressMarker(); // 產生座標
		//$("#SiteAddrX").val("1211");
		//$('#map_canvas').tinyMap(opt_direction);
	  }
	});
 });
</script>
<style>
.Googlemap_label{font-size:12px;background:rgba(22,22,22,0.6);color:#fff;padding:.25em}
</style>
<style type="text/css">
#apDiv_config {
	position: fixed;
	width: 230px;
	height: 115px;
	z-index: 1;
	float: right;
	right: 0px;
	top: 150px;
}
#wrapper_config div #apDiv_config div span a {
	color: #1C590D;
	font-size: 9px;
}
#show_config tr td{
	border: 1px dotted #DDD;
	font-size: 9px;
}

#board_wrp{
	position:relative; top:10px; left:10px; padding:5px;width:233px; margin-left:0px;; margin-right:auto; margin-top:auto; margin-bottom:auto; height:339px; background-image:url(images/mail_wp.png); background-repeat:no-repeat
}

</style>
<!-- fck編輯器 -->
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
	<?php $CKEtoolbar = 'Advanced' ?>
<?php } else { ?>
	<?php $CKEtoolbar = 'Full' ?>
<?php } ?>

<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script src="../SpryAssets/SpryValidationRadio.js" type="text/javascript"></script><script type="text/javascript">
window.onload = function()
{
	CKEDITOR.env.isCompatible = true;
	CKEDITOR.replace( 'contactcontent',{width : '<?php echo $CKeditor_setwidth; ?>px', toolbar : '<?php echo $CKEtoolbar; ?>'} );
};
</script>
<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['Contact']; ?> <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="javascript:void(0);" onclick="startIntro();" data-original-title="教學導引 Step By Step" data-toggle="tooltip" data-placement="top" id="startButton" class="btn btn-default btn-sm"><i class="far fa-comment-alt fa-fw"></i> 導覽</a></div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 修改資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $editFormAction;?>" id="form1" name="form1" class="form-horizontal form-bordered" data-parsley-validate="" method="post">
  <?php if ($row_RecordSystemConfigFr['GoogleMapAPICode1'] == "") { ?>
      <div class="alert alert-warning m-10"><i class="fa fa-info-circle"></i> <b>目前 Google API 尚未設定，因此 Google Map 功能無法使用。<a href="manage_contactmail.php?wshop=<?php echo $wshop;?>&amp;Opt=gapi&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-primary btn-xs" data-original-title="前往更改設定" data-toggle="tooltip" data-placement="top"><i class="fa fa-chevron-right"></i> 設定</a></b></div>
      <?php } ?>
      <div class="form-group row">
        <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 基本設定</span></div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">標題<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="contacttitle" type="text" class="form-control" id="contacttitle" value="<?php echo $row_RecordSystemConfigFr['contacttitle_cn']; ?>" maxlength="200" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">標題區塊<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="您可以選擇是否顯示或將標題隱藏，在內容描述區塊中自訂您的標題。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfigFr['contacttitleindicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="contacttitleindicate" id="contacttitleindicate_1" value="1" />
                <label for="contacttitleindicate_1">顯示</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfigFr['contacttitleindicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="contacttitleindicate" id="contacttitleindicate_2" value="0" />
                <label for="contacttitleindicate_2">隱藏</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row" id="Step_Content">
          <label class="col-md-2 col-form-label">詳細內容 <i class="fa fa-info-circle text-orange" data-original-title="註:Shift+Enter為不空行分段/Enter為空行分段。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="table-responsive">
                <textarea name="contactcontent" id="contactcontent" cols="100%" rows="35" class="form-control"><?php echo $row_RecordSystemConfigFr['contactcontent_cn']; ?></textarea>  
          </div>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文繞圖</label>
          <div class="col-md-10">
                <input type="image" src="images/tmp_smp_pic_01.jpg" id="change_unit01" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_pic_02.jpg" id="change_unit02" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_pic_03.jpg" id="change_unit03" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_pic_04.jpg" id="change_unit04" onclick="return false" style="margin-right:5px;"><div style="color:#CC6600;">點選您想要的圖示外觀即可在【詳細內容欄位】之【游標處】加入文繞圖格式。圖片可雙擊滑鼠左鍵，在視窗中點選【上傳】頁面，在上傳您要的圖片即可。</div>  
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> GoogleMap</span></div>
      </div>
      <div class="form-group row" id="Step_MapIndicate">
          <label class="col-md-2 col-form-label">地圖區塊<span class="text-red">*</span></label>
          <div class="col-md-10">
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfigFr['googlemapindicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="googlemapindicate" id="googlemapindicate_1" value="1" />
                <label for="googlemapindicate_1">隱藏此區域</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfigFr['googlemapindicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="googlemapindicate" id="googlemapindicate_2" value="0" />
                <label for="googlemapindicate_2">顯示在詳細內容區塊上方</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfigFr['googlemapindicate'],"2"))) {echo "checked=\"checked\"";} ?> type="radio" name="googlemapindicate" id="googlemapindicate_3" value="0" />
                <label for="googlemapindicate_3">顯示在詳細內容區塊下方</label>
            </div>
                      
                 
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">名稱<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="SiteSName" type="text" class="form-control" id="SiteSName" value="<?php echo $row_RecordSystemConfigFr['SiteSName_cn']; ?>" maxlength="100" data-parsley-trigger="blur" required="" />
                      
                 
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">描述<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="SiteDecsHome" type="text" class="form-control" id="SiteDecsHome" value="<?php echo $row_RecordSystemConfigFr['SiteDecsHome_cn']; ?>" maxlength="200" data-parsley-trigger="blur" required="" />
                      
                 
        </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">電話</label>
          <div class="col-md-10">
                      
                      <input name="SitePhone" type="text" class="form-control" id="SitePhone" value="<?php echo $row_RecordSystemConfigFr['SitePhone_cn']; ?>" maxlength="30" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">行動</label>
          <div class="col-md-10">
                      
                      <input name="SiteCell" type="text" class="form-control" id="SiteCell" value="<?php echo $row_RecordSystemConfigFr['SiteCell_cn']; ?>" maxlength="15" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">傳真</label>
          <div class="col-md-10">
                      
                      <input name="SiteFax" type="text" class="form-control" id="SiteFax" value="<?php echo $row_RecordSystemConfigFr['SiteFax_cn']; ?>" maxlength="15" data-parsley-trigger="blur" />
                      
                 
          </div>
      </div>
      <div class="form-group row" id="Step_MapMove">
          <label class="col-md-2 col-form-label">完整地址 <i class="fa fa-info-circle text-orange" data-original-title="務必輸入完整地址以便在GoogleMap中標記正確，留空此區功能將不能使用。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                      
                      <input name="SiteAddr" type="text" class="form-control" id="SiteAddr" value="<?php echo $row_RecordSystemConfigFr['SiteAddr_cn']; ?>" maxlength="250" data-parsley-trigger="blur" />
                      <div id="NowLatLng"><i class="fa fa-map-marker"></i> 目前標記位置：【緯度：<?php echo $row_RecordSystemConfigFr['SiteAddrX']; ?>】【經度：<?php echo $row_RecordSystemConfigFr['SiteAddrY']; ?>】</div>
<div style="position:relative"><div id="out" style="position:absolute;"><div id="map_canvas"></div></div></div>
                      
                 
          </div>
      </div>
      <div class="form-group row" id="Step_MapS">
          <label class="col-md-2 col-form-label">GPS座標 <i class="fa fa-info-circle text-orange" data-original-title="若尚未輸入GoogleMapAPI KEY或欲更精準位置，請手動輸入。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-5">
            <div class="input-group p-0">
              <div class="input-group-prepend"><span class="input-group-text">緯度</span></div>
                  <input name="SiteAddrX" type="text" class="form-control" id="SiteAddrX" value="<?php echo $row_RecordSystemConfigFr['SiteAddrX']; ?>" maxlength="20" data-parsley-trigger="blur" />
                                      
              </div>
                 
          </div>
          <div class="col-md-5">
            <div class="input-group p-0">
              <div class="input-group-prepend"><span class="input-group-text">經度</span></div>
                  <input name="SiteAddrY" type="text" class="form-control" id="SiteAddrY" value="<?php echo $row_RecordSystemConfigFr['SiteAddrY']; ?>" maxlength="20" data-parsley-trigger="blur" />
                                      
              </div>
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-12 col-form-label d-block d-sm-none"></label>
        <div class="col-md-12"><span class="badge badge-primary"><i class="fa fa-paper-plane"></i> 表單寄送設定</span></div>
      </div>

      <div class="form-group row" id="Step_Indicate">
          <label class="col-md-2 col-form-label">表單區塊<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="您可以選擇是否顯示或將寄信表單隱藏。" data-toggle="tooltip" data-placement="top"></i></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfigFr['formindicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="formindicate" id="formindicate_2" value="0" />
                <label for="formindicate_2">顯示</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordSystemConfigFr['formindicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="formindicate" id="formindicate_1" value="1" />
                <label for="formindicate_1">隱藏</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row" id="Step_List">
          <label class="col-md-2 col-form-label">詢問類別<span class="text-red">*</span></label>
          <div class="col-md-10">          
             <a href="manage_contactmail.php?wshop=<?php echo $wshop;?>&amp;Opt=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-warning btn-sm">前往設定 <i class="fa fa-chevron-circle-right"></i></a>           
          </div>
      </div>
      <div class="form-group row" id="Step_Mail">
          <label class="col-md-2 col-form-label">寄件信箱<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="使用者填寫表單後會寄送的信箱。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                      
                      <input name="sitemail" type="email" class="form-control" id="sitemail" value="<?php echo $row_RecordSystemConfigFr['SiteMail_cn']; ?>" maxlength="150" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      <div class="form-group row" id="Step_MailTitle">
          <label class="col-md-2 col-form-label">寄件人<span class="text-red">*</span> <i class="fa fa-info-circle text-orange" data-original-title="用者填寫表單後信件顯示之寄件者。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                      
                      <input name="siteauthor" type="text" class="form-control" id="siteauthor" value="<?php echo $row_RecordSystemConfigFr['SiteAuthor_cn']; ?>" maxlength="150" data-parsley-trigger="blur" required="" />
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordSystemConfigFr['id']; ?>" />
            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
        </div>
      </div>
      <input type="hidden" name="MM_update" value="form1" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php if ($GoogleMapAPICode != "") { ?>
<script type="text/javascript">
  var map;
  var marker;
   
  function initialize() 
  {
	//初始化地圖時的定位經緯度設定
    var latlng = new google.maps.LatLng(23.973875,120.982024); //台灣緯度Latitude、經度Longitude：23.973875,120.982024
    //初始化地圖options設定
	var mapOptions = {
      zoom: 15,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
	//初始化地圖
    map = new google.maps.Map(document.getElementById("map_canvas"),mapOptions);
	//加入標記點
	marker = new google.maps.Marker({
		  draggable:true,
		  position: latlng,
		  title:"台灣 Taiwan",
		  map:map
	});	
	//增加標記點的mouseup事件
	google.maps.event.addListener(marker, 'mouseup', function() {
		LatLng = marker.getPosition();
		$("#NowLatLng").html("<i class=\"fa fa-map-marker\"></i> 移動標記後位置：【緯度：" + LatLng.lat() + "】【經度：" + LatLng.lng() + "】");
		$("#SiteAddrX").val(LatLng.lat());
		$("#SiteAddrY").val(LatLng.lng());
	});
	
  }
  
  function GetAddressMarker()
  {//重新定位地圖位置與標記點位置
	 address = $("#SiteAddr").val();
	 geocoder = new google.maps.Geocoder();
	 geocoder.geocode(
		 {
		  'address':address
		 },function (results,status) 
		 {
			if(status==google.maps.GeocoderStatus.OK) 
			{
			   //console.log(results[0].geometry.location);
			   LatLng = results[0].geometry.location;
			   map.setCenter(LatLng);		//將地圖中心定位到查詢結果
			   marker.setPosition(LatLng);	//將標記點定位到查詢結果
			   marker.setTitle(address);	//重新設定標記點的title
			   $("#NowLatLng").html("<i class=\"fa fa-map-marker\"></i> 目前標記位置：【緯度：" + LatLng.lat() + "】【經度：" + LatLng.lng() + "】");
			   $("#SiteAddrX").val(LatLng.lat());
			   $("#SiteAddrY").val(LatLng.lng());
			}
		 }
	 ); 
  }
   $(document).ready(function() { 
	//綁定地址輸入框的keyup事件以即時重新定位
	$('#SiteAddr').blur(function(){
		GetAddressMarker();
		//$("#NowLatLng").html("【移動標記點後的位置】");
	});	
  });
</script>
<?php } ?>
<script type="text/javascript">
	$(document).ready(function() {
			$("#change_unit01").click(function(){
					CKEDITOR.instances.contactcontent.insertHtml("<img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px; padding:5px; float:left;\" />");
			});
			
			$("#change_unit02").click(function(){
					CKEDITOR.instances.contactcontent.insertHtml("<img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px; padding:5px; float:right;\" />");
			});
			
			$("#change_unit03").click(function(){
					CKEDITOR.instances.contactcontent.insertHtml("<img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px; padding:5px; float:none;\" /><br />");
			});
			
			$("#change_unit04").click(function(){
					CKEDITOR.instances.contactcontent.insertHtml("<p style=\"text-align:center\"><img alt=\"\" height=\"180\" src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" style=\"display: block; margin: auto;\" width=\"240\" /></p>");
			});
	});
</script>
<script type="text/javascript">
      function startIntro(){
        var intro = introJs();
          intro.setOptions({
            steps: [
			  {
                element: '#Step_Tip1',
                intro: '<img src="images/tip/tip054.jpg" width="300" height="300" /><br /><br />此模組最重要的就是寄送信件的功能，透過伺服器來發送信件，不需使用者安裝outlook等發信軟體。',
                position: 'bottom'
              },
			  {
                element: '#Step_Tip2',
                intro: '<img src="images/tip/tip055.jpg" width="300" height="170" /><br /><br />驗證碼機制。',
                position: 'bottom'
              },
			  {
                element: '#Step_Mail',
                intro: '設置寄送的Mail。',
                position: 'bottom'
              },
			  {
                element: '#Step_MailTitle',
                intro: '設置寄送的Mail主旨。',
                position: 'bottom'
              },
			  {
                element: '#Step_List',
                intro: '<img src="images/tip/tip056.jpg" width="300" height="170" /><br /><br />設置客戶詢問類別，請注意至少要設置一個選擇項目，否則使用者無法寄送。<div style="text-align:center;margin-top:10px;"><span class = "InnerPage" style="float:none"><a href="manage_contactmail.php?wshop=<?php echo $wshop;?>&amp;Opt=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" target="_blank"><i class="fa fa-arrow-circle-right"></i> 前往設置清單</a></span></div>'
              },
			  {
                element: '#Step_Indicate',
                intro: '您也可以選擇是否要隱藏發信功能，僅顯示地圖或內容補充說明。'
              },
			  {
                element: '#Step_Content',

                intro: '此為內容補充說明，您可以放入任何您欲補充的資訊。',
                position: 'bottom'
              },
			  {
                element: '#Step_MapMove',
                intro: '<img src="images/tip/tip066.jpg" width="452" height="395" /><br /><br />輸入您的地址，輸入後會產生GoogleMap預覽，點選座標可以拖曳移動，取得更精準座標。',
                position: 'bottom'
              },
			  {
                element: '#Step_MapS',
                intro: '<img src="images/tip/tip122.jpg" width="500" height="350" /><br /><br />GoogleMap手動查詢步驟。',
                position: 'bottom'
              },
			  {
                element: '#Step_MapIndicate',
                intro: '設定GoogleMap是否顯示。',
                position: 'bottom'
              },
              {
                element: '#Step_End',
                intro: '設置完後您可至前台觀看結果。',
                position: 'bottom'
              }
            ],
			tooltipPosition: 'auto',
			positionPrecedence: ['left', 'right', 'bottom', 'top']
          });

          intro.start();
      }
</script>
<?php if(isset($_POST['Operate']) && $_POST['Operate'] == "addSuccess") { ?>
<script type="text/javascript">
swal({ title: "資料新增成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>
<?php if(isset($_POST['Operate']) && $_POST['Operate'] == "editSuccess") { ?>
<script type="text/javascript">
swal({ title: "資料修改成功!", text: "", type: "success",buttonsStyling: false,confirmButtonText: "確認",confirmButtonClass: "btn btn-primary m-5"});
</script>
<?php } ?>

<?php
mysqli_free_result($RecordSystemConfigFr);
?>