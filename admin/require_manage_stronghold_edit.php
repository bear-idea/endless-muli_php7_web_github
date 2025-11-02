<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once("../inc/inc_function.php"); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

echo $_POST["MM_update"];

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Stronghold")) {
  $updateSQL = sprintf("UPDATE demo_stronghold SET name=%s, type=%s, phone1=%s, fax=%s, openinghours=%s, mail=%s, addr=%s, addrx=%s, addry=%s, link=%s, content=%s, postdate=%s, indicate=%s, sdescription=%s, skeyword=%s, notes1=%s, lang=%s WHERE id=%s",
      GetSQLValueString($_POST['name'], "text"),
      GetSQLValueString($_POST['type'], "text"),
      GetSQLValueString($_POST['phone1'], "text"),
      GetSQLValueString($_POST['fax'], "text"),
      GetSQLValueString($_POST['openinghours'], "text"),
      GetSQLValueString($_POST['mail'], "text"),
      GetSQLValueString($_POST['addr'], "text"),
      GetSQLValueString($_POST['addrx'], "text"),
      GetSQLValueString($_POST['addry'], "text"),
      GetSQLValueString($_POST['link'], "text"),
      GetSQLValueString($_POST['content'], "text"),
      GetSQLValueString($_POST['postdate'], "date"),
      GetSQLValueString($_POST['indicate'], "int"),
      GetSQLValueString($_POST['sdescription'], "text"),
      GetSQLValueString($_POST['skeyword'], "text"),
      GetSQLValueString($_POST['notes1'], "text"),
      GetSQLValueString($_POST['lang'], "text"),
      GetSQLValueString($_POST['id'], "int"));


  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

  $_SESSION['DB_Edit'] = "Success";

  $updateGoTo = "manage_stronghold.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

/* 取得類別資料 */
$colname_RecordStrongholdListType = "zh-tw";
if (isset($_GET["lang"])) {
  $colname_RecordStrongholdListType = $_GET["lang"];
}
$coluserid_RecordStrongholdListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordStrongholdListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordStrongholdListType = sprintf("SELECT * FROM demo_strongholditem WHERE list_id = 1 && lang=%s && userid=%s", GetSQLValueString($colname_RecordStrongholdListType, "text"),GetSQLValueString($coluserid_RecordStrongholdListType, "int"));
$RecordStrongholdListType = mysqli_query($DB_Conn, $query_RecordStrongholdListType) or die(mysqli_error($DB_Conn));
$row_RecordStrongholdListType = mysqli_fetch_assoc($RecordStrongholdListType);
$totalRows_RecordStrongholdListType = mysqli_num_rows($RecordStrongholdListType);

/* 取得最新訊息資料 */
$colname_RecordStronghold = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordStronghold = $_GET['id_edit'];
}
$coluserid_RecordStronghold = "-1";
if (isset($w_userid)) {
  $coluserid_RecordStronghold = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordStronghold = sprintf("SELECT * FROM demo_stronghold WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordStronghold, "int"),GetSQLValueString($coluserid_RecordStronghold, "int"));
$RecordStronghold = mysqli_query($DB_Conn, $query_RecordStronghold) or die(mysqli_error($DB_Conn));
$row_RecordStronghold = mysqli_fetch_assoc($RecordStronghold);
$totalRows_RecordStronghold = mysqli_num_rows($RecordStronghold);
?>
<!-- fck編輯器 -->
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
	<?php $CKEtoolbar = 'Advanced' ?>
<?php } else { ?>
	<?php if ($ManageStrongholdEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageStrongholdEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>

<?php if ($ManageStrongholdEditorSelect == '1' || $ManageStrongholdEditorSelect == '2') { ?>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
	CKEDITOR.env.isCompatible = true;
	if (CKEDITOR.instances['content']) { CKEDITOR.instances['content'].destroy(true); }
	CKEDITOR.replace( 'content',{width : '<?php echo $CKeditor_setwidth; ?>px', toolbar : '<?php echo $CKEtoolbar; ?>'} );
};
</script>
<?php } ?>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo $GoogleMapAPICode; ?>"></script>
<script type="text/javascript" src="../js/jquery.twzipcode-1.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        initialize();
        $('#addr').focus(function(){
            var addr = $('#addr').val();
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

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['Stronghold']; ?> <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9">
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 修改資料</h4>
  </div>
  <!-- end panel-heading -->
  <!-- begin panel-body -->
  <div class="panel-body p-0">

  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post" enctype="multipart/form-data">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">名稱<span class="text-red">*</span></label>
          <div class="col-md-10">

                      <input name="name" type="text" class="form-control" id="name" value="<?php echo $row_RecordStronghold['name']; ?>" maxlength="200" data-parsley-trigger="blur" required="" />


          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label ">分類</label>
          <div class="col-md-10">
              <select name="type" id="type" class="form-control" data-parsley-trigger="blur" required="">
                  <option value="" <?php if (!(strcmp(-1, $row_RecordStronghold['type']))) {echo "selected=\"selected\"";} ?>>-- 選擇類別 --</option>
                  <?php
do {
?>
                  <option value="<?php echo $row_RecordStrongholdListType['itemname']?>"<?php if (!(strcmp($row_RecordStrongholdListType['itemname'], $row_RecordStronghold['type']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordStrongholdListType['itemname']?></option>
                  <?php
} while ($row_RecordStrongholdListType = mysqli_fetch_assoc($RecordStrongholdListType));
  $rows = mysqli_num_rows($RecordStrongholdListType);
  if($rows > 0) {
      mysqli_data_seek($RecordStrongholdListType, 0);
	  $row_RecordStrongholdListType = mysqli_fetch_assoc($RecordStrongholdListType);
  }
?>
                </select>

          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">圖片</label>
          <div class="col-md-10">
          <a href="uplod_stronghold.php?id_edit=<?php echo $row_RecordStronghold['id']; ?>&amp;lang=<?php echo $_GET['lang']; ?>" class="btn btn-warning colorbox_iframe_cd"><i class="fa fa-image"></i> 圖片修改</a>
        </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">電話</label>
          <div class="col-md-10">

              <input name="phone1" type="text" id="phone1" value="<?php echo $row_RecordStronghold['phone1']; ?>" maxlength="30" class="form-control" data-parsley-trigger="blur">


          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">傳真</label>
          <div class="col-md-10">

              <input name="fax" type="text" id="fax" value="<?php echo $row_RecordStronghold['fax']; ?>" maxlength="30" class="form-control" data-parsley-trigger="blur">


          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">電子郵件<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="mail" type="email" value="<?php echo $row_RecordStronghold['mail']; ?>" class="form-control" id="mail" maxlength="100" data-date-format="yyyy-mm-dd" data-parsley-trigger="blur" required="">

          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">網頁</label>
          <div class="col-md-10">

              <input name="link" type="url" id="link" value="<?php echo $row_RecordStronghold['link']; ?>" maxlength="100" class="form-control" data-parsley-trigger="blur">


          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">營業時間</label>
          <div class="col-md-10">

              <input name="openinghours" type="text" id="openinghours" value="<?php echo $row_RecordStronghold['openinghours']; ?>" maxlength="100" class="form-control" data-parsley-trigger="blur">


          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">地址</label>
          <div class="col-md-10">

              <input name="addr" type="text" id="addr" value="<?php echo $row_RecordStronghold['addr']; ?>" maxlength="100" class="form-control" data-parsley-trigger="blur">
              <div id="NowLatLng"><i class="fa fa-map-marker"></i> 目前標記位置：【緯度：<?php echo $row_RecordSystemConfigFr['SiteAddrX']; ?>】【經度：<?php echo $row_RecordSystemConfigFr['SiteAddrY']; ?>】</div>
              <div style="position:relative"><div id="out" style="position:absolute;"><div id="map_canvas"></div></div></div>

          </div>
      </div>

      <div class="form-group row" id="Step_MapS">
          <label class="col-md-2 col-form-label">GPS座標 <i class="fa fa-info-circle text-orange" data-original-title="若尚未輸入GoogleMapAPI KEY或欲更精準位置，請手動輸入。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-5">
              <div class="input-group p-0">
                  <div class="input-group-prepend"><span class="input-group-text">緯度</span></div>
                  <input name="addrx" type="text" class="form-control" id="addrx" value="<?php echo $row_RecordStronghold['addrx']; ?>" maxlength="20" data-parsley-trigger="blur" />

              </div>

          </div>
          <div class="col-md-5">
              <div class="input-group p-0">
                  <div class="input-group-prepend"><span class="input-group-text">經度</span></div>
                  <input name="addry" type="text" class="form-control" id="addry" value="<?php echo $row_RecordStronghold['addry']; ?>" maxlength="20" data-parsley-trigger="blur" />

              </div>

          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>
          <div class="col-md-10">

            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordStronghold['indicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_1" value="1" />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordStronghold['indicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>

          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面關鍵字 <i class="fa fa-info-circle text-orange" data-original-title="設定目前頁面的SEO關鍵字，會嵌入至原始碼中。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
               <input name="skeyword" type="text" class="form-control" id="skeyword" value="<?php echo $row_RecordStronghold['skeyword']; ?>" maxlength="300" data-role="tagsinput" />
          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面描述 <i class="fa fa-info-circle text-orange" data-original-title="設定目前頁面的SEO描述，會嵌入至原始碼中，此描述會影響搜尋引擎搜尋之摘要。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                 <input name="sdescription" type="text" class="form-control" id="sdescription" value="<?php echo $row_RecordStronghold['sdescription']; ?>" size="100" maxlength="150"/>
          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">詳細內容 <i class="fa fa-info-circle text-orange" data-original-title="註:Shift+Enter為不空行分段/Enter為空行分段。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="table-responsive">
                <textarea name="content" id="content" cols="100%" rows="35" class="form-control"><?php echo $row_RecordStronghold['content']; ?></textarea>
          </div>
          </div>
      </div>

      <div class="form-group row">
          <label class="col-md-2 col-form-label">上傳時間<span class="text-red">*</span></label>
          <div class="col-md-10">
              <input name="postdate" type="text" class="form-control" id="postdate" value="<?php $dt = new DateTime($row_RecordStronghold['postdate']); echo $dt->format('Y-m-d'); ?>" maxlength="10" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-language="zh-TW" data-parsley-trigger="blur" required="" autocomplete="off"/>

          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordStronghold['notes1']; ?>" size="50" maxlength="50"/>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
        <div class="col-md-10">
          <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordStronghold['id']; ?>" />
            <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordStronghold['lang']; ?>" />
            <input name="editdate" type="hidden" id="editdate" value="<?php echo date("Y-m-d H-i-s"); ?>" />
            <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
            <input name="oldpic" type="hidden" id="oldpic" value="<?php echo $row_RecordStronghold['pic']; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Stronghold" />
  </form>
  </div>
  <!-- end panel-body -->
</div>
<!-- end panel -->

<?php require_once("require_template_panel.php"); ?>

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
            $("#addrx").val(LatLng.lat());
            $("#addry").val(LatLng.lng());
        });

    }

    function GetAddressMarker()
    {//重新定位地圖位置與標記點位置
        address = $("#addr").val();
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
                    $("#addrx").val(LatLng.lat());
                    $("#addry").val(LatLng.lng());
                }
            }
        );
    }
    $(document).ready(function() {
        //綁定地址輸入框的keyup事件以即時重新定位
        $('#addr').blur(function(){
            GetAddressMarker();
            //$("#NowLatLng").html("【移動標記點後的位置】");
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

<?php
mysqli_free_result($RecordStrongholdListType);

mysqli_free_result($RecordStrongholdListAuthor);

mysqli_free_result($RecordStronghold);
?>
