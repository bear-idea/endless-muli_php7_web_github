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

/* 取得類別列表 */
$colname_RecordArticleListType = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordArticleListType = $_GET['lang'];
}
$coluserid_RecordArticleListType = "-1";
if (isset($w_userid)) {
  $coluserid_RecordArticleListType = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordArticleListType = sprintf("SELECT * FROM demo_articleitem WHERE list_id = 1 && lang=%s && level='0' && userid=%s ORDER BY subitem_id", GetSQLValueString($colname_RecordArticleListType, "text"),GetSQLValueString($coluserid_RecordArticleListType, "int"));
$RecordArticleListType = mysqli_query($DB_Conn, $query_RecordArticleListType) or die(mysqli_error($DB_Conn));
$row_RecordArticleListType = mysqli_fetch_assoc($RecordArticleListType);
$totalRows_RecordArticleListType = mysqli_num_rows($RecordArticleListType);

$colname_RecordArticle = "-1";
if (isset($_GET['id_edit'])) {
  $colname_RecordArticle = $_GET['id_edit'];
}
$coluserid_RecordArticle = "-1";
if (isset($w_userid)) {
  $coluserid_RecordArticle = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordArticle = sprintf("SELECT * FROM demo_article WHERE id = %s && userid=%s", GetSQLValueString($colname_RecordArticle, "int"),GetSQLValueString($coluserid_RecordArticle, "int"));
$RecordArticle = mysqli_query($DB_Conn, $query_RecordArticle) or die(mysqli_error($DB_Conn));
$row_RecordArticle = mysqli_fetch_assoc($RecordArticle);
$totalRows_RecordArticle = mysqli_num_rows($RecordArticle);

/* 插入資料 */
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Article") && $_POST['sdescription'] == "") { 
	$_POST['sdescription'] = TrimSummary($_POST['content']);
}
/* 當類別無傳值進來時則給定初始值 */
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Article")) {
	if($_POST['type1'] == NULL){$_POST['type1'] = '-1';}
	if($_POST['type2'] == NULL){$_POST['type2'] = '-1';}
	if($_POST['type3'] == NULL){$_POST['type3'] = '-1';}
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Article")) {
  $updateSQL = sprintf("UPDATE demo_article SET title=%s, type1=%s, type2=%s, type3=%s, content=%s, indicate=%s, skeyword=%s, sdescription=%s, notes1=%s, lang=%s, userid=%s WHERE id=%s",
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['type1'], "text"),
                       GetSQLValueString($_POST['type2'], "text"),
                       GetSQLValueString($_POST['type3'], "text"),
                       GetSQLValueString($_POST['content'], "text"),
                       GetSQLValueString($_POST['indicate'], "int"),
					   GetSQLValueString($_POST['skeyword'], "text"),
					   GetSQLValueString($_POST['sdescription'], "text"),
                       GetSQLValueString($_POST['notes1'], "text"),
                       GetSQLValueString($_POST['lang'], "text"),
					   GetSQLValueString($_POST['userid'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

  $_SESSION['DB_Edit'] = "Success";
   
  $updateGoTo = "manage_article.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}
?>
<!-- fck編輯器 -->
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
	<?php $CKEtoolbar = 'Advanced' ?>
<?php } else { ?>
	<?php if ($ManageArticleEditorSelect == '1') {?>
	<?php $CKEtoolbar = 'Full' ?>
    <?php } else if ($ManageArticleEditorSelect == '2') {?>
    <?php $CKEtoolbar = 'Basic' ?>
    <?php } else {?>
    <?php } ?>
<?php } ?>
<?php if ($ManageArticleEditorSelect == '1' || $ManageArticleEditorSelect == '2') { ?>
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
<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['Article']; ?> <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-plus"></i> 修改資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
      <div class="form-group row">
          <label class="col-md-2 col-form-label">標題<span class="text-red">*</span></label>
          <div class="col-md-10">
                      
                      <input name="title" type="text" class="form-control" id="title" value="<?php echo $row_RecordArticle['title']; ?>" maxlength="200" data-parsley-trigger="blur" required=""/>
                      
                 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">分類</label>
          <div class="col-md-10">
                 
                    
                    <select name="type1" id="type1" class="form-control col-md-4" style="display:inline-block">
                      <option value="-1" <?php if (!(strcmp(-1, $row_RecordArticle['type1']))) {echo "selected=\"selected\"";} ?>>-- 選擇分類 --</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_RecordArticleListType['item_id']?>"<?php if (!(strcmp($row_RecordArticleListType['item_id'], $row_RecordArticle['type1']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordArticleListType['itemname']?></option>
                      <?php
} while ($row_RecordArticleListType = mysqli_fetch_assoc($RecordArticleListType));
  $rows = mysqli_num_rows($RecordArticleListType);
  if($rows > 0) {
      mysqli_data_seek($RecordArticleListType, 0);
	  $row_RecordArticleListType = mysqli_fetch_assoc($RecordArticleListType);
  }
?>
                    </select>

                    
                    <select name="type2" id="type2" class="form-control col-md-4" style="display:inline-block">
                      <option value="-1" <?php if (!(strcmp(-1, $row_RecordArticleListType['item_id']))) {echo "selected=\"selected\"";} ?>>-- 選擇分類2 --</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_RecordArticleListType['item_id']?>"<?php if (!(strcmp($row_RecordArticleListType['item_id'], $row_RecordArticleListType['item_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordArticleListType['itemname']?></option>
<?php
} while ($row_RecordArticleListType = mysqli_fetch_assoc($RecordArticleListType));
  $rows = mysqli_num_rows($RecordArticleListType);
  if($rows > 0) {
      mysqli_data_seek($RecordArticleListType, 0);
	  $row_RecordArticleListType = mysqli_fetch_assoc($RecordArticleListType);
  }
?>
                    </select>

                    
                    <select name="type3" id="type3" class="form-control col-4" style="display:inline-block">
                      <option value="-1" <?php if (!(strcmp(-1, $row_RecordArticleListType['item_id']))) {echo "selected=\"selected\"";} ?>>-- 選擇分類3 --</option>
                      <?php
do {  
?>
                      <option value="<?php echo $row_RecordArticleListType['item_id']?>"<?php if (!(strcmp($row_RecordArticleListType['item_id'], $row_RecordArticleListType['item_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecordArticleListType['itemname']?></option>
                      <?php
} while ($row_RecordArticleListType = mysqli_fetch_assoc($RecordArticleListType));
  $rows = mysqli_num_rows($RecordArticleListType);
  if($rows > 0) {
      mysqli_data_seek($RecordArticleListType, 0);
	  $row_RecordArticleListType = mysqli_fetch_assoc($RecordArticleListType);
  }
?>
                    </select>
</div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">狀態<span class="text-red">*</span></label>                       	
          <div class="col-md-10">
          
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordArticle['indicate'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_1" value="1" />
                <label for="indicate_1">公佈</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordArticle['indicate'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="indicate" id="indicate_2" value="0" />
                <label for="indicate_2">隱藏</label>
            </div>
             
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面關鍵字 <i class="fa fa-info-circle text-orange" data-original-title="設定目前頁面的SEO關鍵字，會嵌入至原始碼中。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
               <input name="skeyword" type="text" class="form-control" id="skeyword" value="<?php echo $row_RecordArticle['skeyword']; ?>" maxlength="300" data-role="tagsinput" />
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁面描述 <i class="fa fa-info-circle text-orange" data-original-title="設定目前頁面的SEO描述，會嵌入至原始碼中，此描述會影響搜尋引擎搜尋之摘要。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
                 <input name="sdescription" type="text" class="form-control" id="sdescription" value="<?php echo $row_RecordArticle['sdescription']; ?>" size="100" maxlength="150"/> 
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">詳細內容 <i class="fa fa-info-circle text-orange" data-original-title="註:Shift+Enter為不空行分段/Enter為空行分段。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="table-responsive">
                <textarea name="content" id="content" cols="100%" rows="35" class="form-control"><?php echo $row_RecordArticle['content']; ?></textarea>  
          </div>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">快速排版</label>
          <div class="col-md-10">
              <input type="image" src="images/tmp_smp_00.jpg" id="change_tmp00" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_01.jpg" id="change_tmp01" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_02.jpg" id="change_tmp02" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_03.jpg" id="change_tmp03" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_04.jpg" id="change_tmp04" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_05.jpg" id="change_tmp05" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_06.jpg" id="change_tmp06" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_07.jpg" id="change_tmp07" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_08.jpg" id="change_tmp08" onclick="return false" style="margin-right:5px;"><div style="color:#CC6600;">點選您想要的排版圖示外觀即可將【詳細內容欄位】全部替換。圖片可雙擊滑鼠左鍵，在視窗中點選【上傳】頁面，在上傳您要的圖片即可。</div>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">文繞圖</label>
          <div class="col-md-10">
                <input type="image" src="images/tmp_smp_pic_01.jpg" id="change_unit01" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_pic_02.jpg" id="change_unit02" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_pic_03.jpg" id="change_unit03" onclick="return false" style="margin-right:5px;"><input type="image" src="images/tmp_smp_pic_04.jpg" id="change_unit04" onclick="return false" style="margin-right:5px;"><div style="color:#CC6600;">點選您想要的圖示外觀即可在【詳細內容欄位】之【游標處】加入文繞圖格式。圖片可雙擊滑鼠左鍵，在視窗中點選【上傳】頁面，在上傳您要的圖片即可。</div>  
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">備註</label>
          <div class="col-md-10">
              <input name="notes1" type="text" class="form-control" id="notes1" value="<?php echo $row_RecordArticle['notes1']; ?>" size="50" maxlength="50"/>    
          </div>
      </div>
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button> 
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordArticle['id']; ?>" />
            <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
            <input id="fullIdPath" type="hidden" value="<?php echo $row_RecordArticle['type1']; ?>,<?php echo $row_RecordArticle['type2']; ?>,<?php echo $row_RecordArticle['type3']; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Article" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php require_once("require_template_panel.php"); ?>

<script type="text/javascript">
// 下拉連動選單設定
$(function () {

    // 判斷是否有預設值
    var defaultValue = false;
    if (0 < $.trim($('#fullIdPath').val()).length) {
        $fullIdPath = $('#fullIdPath').val().split(',');
        defaultValue = true;
    }
    
    // 設定預設選項
    if (defaultValue) {
        $('#type1').selectOptions($fullIdPath[0]); 
    }
    
	//$("#type2").hide(); //開始執行時先將第二層的選單藏起來
	//$("#type3").hide(); //開始執行時先將第二層的選單藏起來
    // 開始產生關聯下拉式選單
    $('#type1').change(function () {
        // 觸發第二階下拉式選單
		//$("選單ID").addOption("選單內容物件",false);
		//$("選單ID").removeOption("選單索引/值/陣列");若是要刪掉全部則框號內置入/./
        $('#type2').removeOption(/.?/).ajaxAddOption(
            'selectbox_action/article_add.php?&<?php echo time();?>', 
            { 'id': $(this).val(), 'lv': 1 }, 
            false, // true/false 的功能在於是否要瀏覽器記住次選單的選項
            function () {
                
                // 設定預設選項
                if (defaultValue) {
                    $(this).selectOptions($fullIdPath[1]).trigger('change');
                } else {
                    $(this).selectOptions().trigger('change');
                }
				
				// 設定欄位隱藏/開啟
				if( $('#type1 option:selected').val() != '' && $('#type2 option:selected').val() != '')
				// 值=val() // 標籤=text
				{
					$("#type2").show(); // 
				}else{
					$("#type2").hide(); //
				}
            }
        ).change(function () {
            // 觸發第三階下拉式選單
            $('#type3').removeOption(/.?/).ajaxAddOption(
                'selectbox_action/article_add.php?<?php echo time();?>', 
                { 'id': $(this).val(), 'lv': 2 }, 
                false, 
                function () {
                
                    // 設定預設選項
                    if (defaultValue) {
                        $(this).selectOptions($fullIdPath[2]);
                    }
					// 設定欄位隱藏/開啟
					if( $('#type2 option:selected').val() != '' && $('#type3 option:selected').val() != '')
					// 值=val() // 標籤=text
					{
						$("#type3").show(); // 
					}else{
						$("#type3").hide(); //
					}
					}
            );
        });
    }).trigger('change');

    // 全部選擇完畢後，顯示所選擇的選項
    /*$('#type3').change(function () {
        alert('主機：' + $('#type1 option:selected').text() + 
              '／類型：' + $('#type2 option:selected').text() +
              '／遊戲：' + $('#type3 option:selected').text());
    });*/
});
</script>
<script type="text/javascript">
$(document).ready(function() {
		<?php 
		$Content_Show_Title1 = "☆透視富視網";
		$Content_Show_Title2 = "☆我們的理念";
		$Content_Show_Desc1 = "『<strong>富視網科技</strong>』提供整體網頁規劃設計及維護、網路行銷企劃、網站代管以及程式設計…等服務，以客戶角度出發並堅持客戶至上、細心服務為準則，集結多元且專業領域的團隊，更能提供您客製化的服務，為您提供優秀專業的網站設計方案。<br /><br />因每個網站都有它本身存在的價值及被賦予的任務；而一個好的網站在規劃之初就要考慮到以後管理的方便性，『<strong>富視網科技</strong>』的專業在於完整的詢問委託者需求，並且找尋網路上的準客戶群在哪裡，給予最精準的判斷，讓您的網站與將來的網路行銷可以相輔相成；以最精簡的架構做最完美的呈現出一個最容易讓瀏覽者吸收並符合您企業需求的網站。<br /><br />在製作網站之前，『富視網科技』的專業在於完整的詢問委託者需求, 首先要思考是網站的定位及動線設計；並且依照您所屬的產業作個案分析，再針對競爭對手及特定目標客戶作全盤性的規劃；了解該產業的流行趨勢及本身優勢作最準確的判斷，為您量身訂作出一個真正符合您企業屬性的專業網站，創造出網站的最高價值。"; 
		$Content_Show_Desc2 = "我們是一個堅持做好網頁設計的工作團隊，專注設計網頁水準的提升和服務品質的要求，我們希望給您一份將心比心的尊敬對待，每一次創意都代表一份承諾和一個長久的保障。<br /><br />求精不求快、重質不重量，我們以專業專人專責方式從企劃設計理念到網站應用全程服務到底，不但保障您的權益與滿意，也使每一件成功的網頁設計個案的背後心血都化做我們持續服務客戶的動力。<br /><br />衷心期望能有機會為您服務，並提供我們的專業，把您的各種想法作系統性分析匯整透過我們的專業規劃，我們將呈現給您更多更好的設計提案，幫助解決您網頁設計或網站維護上的任何問題，歡迎來電或E-Mail詢問指教，我們將竭誠為您服務。"; 
		?>
			$("#change_tmp00").click(function(){
					CKEDITOR.instances.content.setData("<div style=\"padding:5px;\"><h2><?php echo $Content_Show_Title1; ?></h2><br /><a href=\"http://www.fullrich.com.tw/html/fullvision/index.php\"></a><?php echo $Content_Show_Desc1; ?><br /><br /><h2><?php echo $Content_Show_Title2; ?></h2><br /><br /> <?php echo $Content_Show_Desc2; ?></div>");
			});
			
			$("#change_tmp01").click(function(){
					CKEDITOR.instances.content.setData("<div style=\"padding:5px;\"><h2><?php echo $Content_Show_Title1; ?></h2><br /><img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px; border:1px solid #CCC; padding:5px; float:right;\" /><a href=\"http://www.fullrich.com.tw/html/fullvision/index.php\"></a><?php echo $Content_Show_Desc1; ?><br /><br /><h2><?php echo $Content_Show_Title2; ?></h2><br /><img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px; border:1px solid #CCC; padding:5px; float:left;\" /><br /> <?php echo $Content_Show_Desc2; ?></div>");
			});
			
			$("#change_tmp02").click(function(){
					CKEDITOR.instances.content.setData("<div style=\"padding:5px;\"><h2><?php echo $Content_Show_Title1; ?></h2><br /><img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px; border:1px solid #CCC; padding:5px; float:right;\" /><a href=\"http://www.fullrich.com.tw/html/fullvision/index.php\"></a><?php echo $Content_Show_Desc1; ?><br /><br /><h2><?php echo $Content_Show_Title2; ?></h2><br /><img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px; border:1px solid #CCC; padding:5px; float:right;\" /><br /> <?php echo $Content_Show_Desc2; ?></div>");
			});
			
			$("#change_tmp03").click(function(){
					CKEDITOR.instances.content.setData("<div style=\"padding:5px;\"><h2><?php echo $Content_Show_Title1; ?></h2><br /><img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px; border:1px solid #CCC; padding:5px; float:left;\" /><a href=\"http://www.fullrich.com.tw/html/fullvision/index.php\"></a><?php echo $Content_Show_Desc1; ?><br /><br /><h2><?php echo $Content_Show_Title2; ?></h2><br /><img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px; border:1px solid #CCC; padding:5px; float:right;\" /><br /> <?php echo $Content_Show_Desc2; ?></div>");
			});
			
			$("#change_tmp04").click(function(){
					CKEDITOR.instances.content.setData("<div style=\"padding:5px;\"><h2><?php echo $Content_Show_Title1; ?></h2><br /><img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px; border:1px solid #CCC; padding:5px; float:left;\" /><a href=\"http://www.fullrich.com.tw/html/fullvision/index.php\"></a><?php echo $Content_Show_Desc1; ?><br /><br /><h2><?php echo $Content_Show_Title2; ?></h2><br /><img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px; border:1px solid #CCC; padding:5px; float:left;\" /><br /> <?php echo $Content_Show_Desc2; ?></div>");
			});
			
			$("#change_tmp05").click(function(){
					CKEDITOR.instances.content.setData("<div style=\"padding:5px;\"><h2><?php echo $Content_Show_Title1; ?></h2><br /><img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px;  border:1px solid #CCC; padding:5px; float:right;\" /><a href=\"http://www.fullrich.com.tw/html/fullvision/index.php\"></a><?php echo $Content_Show_Desc1; ?><br /><br /><h2><?php echo $Content_Show_Title2; ?></h2><br /><?php echo $Content_Show_Desc1; ?><br /><br /><img src=\"http://www.shop3500.com/images/tmp/image_01.jpg\" alt=\"\" width=\"160\" height=\"120\" style=\"margin:2px; border:1px solid #CCC; padding:2px; float:left;\" /><img src=\"http://www.shop3500.com/images/tmp/image_01.jpg\" alt=\"\" width=\"160\" height=\"120\" style=\"margin:2px; border:1px solid #CCC; padding:2px; float:left;\" /><img src=\"http://www.shop3500.com/images/tmp/image_01.jpg\" alt=\"\" width=\"160\" height=\"120\" style=\"margin:2px; border:1px solid #CCC; padding:2px; float:left;\" /><img src=\"http://www.shop3500.com/images/tmp/image_01.jpg\" alt=\"\" width=\"160\" height=\"120\" style=\"margin:2px; border:1px solid #CCC; padding:2px; float:left;\" /><div style=\"clear:both;\"></div></div>	");
			});
			
			$("#change_tmp06").click(function(){
					CKEDITOR.instances.content.setData("<img src=\"http://www.shop3500.com/images/tmp/banner_01.jpg\" alt=\"\" style=\"margin:5px; padding:5px;\" /><br /><div style=\"padding:5px;\"><h2><?php echo $Content_Show_Title1; ?></h2><br /><?php echo $Content_Show_Desc1; ?><br /><br /><h2><?php echo $Content_Show_Title2; ?></h2><br /><img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\"  style=\"margin:5px;  border:1px solid #CCC; padding:5px; float:left;\" /><?php echo $Content_Show_Desc2; ?><br /><br /><div style=\"clear:both;\"></div></div>");
			});
			
			$("#change_tmp07").click(function(){
					CKEDITOR.instances.content.setData("<div style=\"padding:5px;\"><h2><?php echo $Content_Show_Title1; ?></h2><br /><img src=\"http://www.shop3500.com/images/tmp/banner_01.jpg\" alt=\"\" style=\"margin:5px; padding:5px;\" /><br /><br /><?php echo $Content_Show_Desc1; ?><br /><br /><h2><?php echo $Content_Show_Title2; ?></h2><br /><img src=\"http://www.shop3500.com/images/tmp/banner_01.jpg\" alt=\"\" style=\"margin:5px; padding:5px;\" /><br /><br /><?php echo $Content_Show_Desc2; ?><br /><br /><div style=\"clear:both;\"></div></div>");
			});
			
			$("#change_tmp08").click(function(){
					CKEDITOR.instances.content.setData("<div style=\"padding:5px;\"><h2><?php echo $Content_Show_Title1; ?></h2><br /><img src=\"http://www.shop3500.com/images/tmp/image_02.jpg\" alt=\"\" width=\"240\" height=\"180\" style=\"margin:5px;  border:1px solid #CCC; padding:5px; float:right;\" /><a href=\"http://www.fullrich.com.tw/html/fullvision/index.php\"></a><?php echo $Content_Show_Desc1; ?><br /><br /><h2><?php echo $Content_Show_Title2; ?></h2><br /><?php echo $Content_Show_Desc2; ?><br /><br /><img src=\"http://www.shop3500.com/images/tmp/image_03.jpg\" alt=\"\" width=\"320\" height=\"240\" style=\"margin:5px; border:1px solid #CCC; padding:5px; float:left;\" /><img src=\"http://www.shop3500.com/images/tmp/image_03.jpg\" alt=\"\" width=\"320\" height=\"240\" style=\"margin:5px; border:1px solid #CCC; padding:5px; float:left;\" /><img src=\"http://www.shop3500.com/images/tmp/image_03.jpg\" alt=\"\" width=\"320\" height=\"240\" style=\"margin:5px; border:1px solid #CCC; padding:5px; float:left;\" /><img src=\"http://www.shop3500.com/images/tmp/image_03.jpg\" alt=\"\" width=\"320\" height=\"240\" style=\"margin:5px; border:1px solid #CCC; padding:5px; float:left;\" /><div style=\"clear:both;\"></div></div>	");
			});
			
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
<?php
mysqli_free_result($RecordArticleListType);

mysqli_free_result($RecordArticle);
?>
