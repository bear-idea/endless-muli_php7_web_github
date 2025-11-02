<?php
use App\Eloquent\Admin\Actnews;
use App\Eloquent\Admin\Actnewsitem;

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Actnews")) {

    $uploadDir = SITEPATH . DIRECTORY_SEPARATOR . $request->input('wshop') . DIRECTORY_SEPARATOR . "image". DIRECTORY_SEPARATOR . "actnews";
    $uploadedFiles = ImageUpload($request, 'pic', $uploadDir);

    // 根據需要處理返回的文件名列表
    foreach ($uploadedFiles as $file) {
        (new Actnews)->insert($request, $file);
    }

    $_SESSION['DB_Add'] = "Success";

    $insertGoTo = "actnews?Opt=viewpage&lang=" . $_POST['lang'];
    /*if (isset($_SERVER['QUERY_STRING'])) {
      $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
      $insertGoTo .= $_SERVER['QUERY_STRING'];
    }*/
    header(sprintf("Location: %s", $insertGoTo));
}

$RecordActnewsListType = (new Actnewsitem)->getItemType($request);

$RecordActnewsListAuthor = (new Actnewsitem)->getItemAuthor($request);

require($page_view_path_vendor."pushjs_ckeditor.php");
require($page_view_path_vendor."pushjs_form.php");
?>

<?php
// 定義表單字段
$formFields = [
    'title' => ['label' => '標題', 'type' => 'text', 'maxlength' => 200, 'required' => true],
    'type' => ['label' => '分類', 'type' => 'select', 'required' => true, 'options' => $RecordActnewsListType],
    'author' => ['label' => '發佈者', 'type' => 'select', 'required' => true, 'options' => $RecordActnewsListAuthor],
    'pic' => ['label' => '圖片', 'type' => 'file', 'required' => true],
    'indicate' => ['label' => '狀態', 'type' => 'radio', 'required' => true, 'options' => ['1' => '公佈', '0' => '隱藏'], 'default' => '1'],
    'skeyword' => ['label' => '頁面關鍵字', 'type' => 'text', 'maxlength' => 300, 'required' => false],
    'skeywordindicate' => ['label' => '關鍵字顯示', 'type' => 'radio', 'required' => false, 'options' => ['1' => '顯示', '0' => '隱藏'], 'default' => '1'],
    'sdescription' => ['label' => '頁面描述', 'type' => 'text', 'maxlength' => 150, 'required' => false, 'tooltip' => '設定目前頁面的SEO描述，會嵌入至原始碼中，此描述會影響搜尋引擎搜尋之摘要。'],
    'pushtop' => ['label' => '置頂', 'type' => 'radio', 'required' => true, 'options' => ['1' => '是', '0' => '否'], 'default' => '0', 'tooltip' => '您可設定此項目來將文章放置於頁面的最頂端。'],
    'content' => ['label' => '詳細內容', 'type' => 'textarea', 'required' => false, 'tooltip' => '註:Shift+Enter為不空行分段/Enter為空行分段。'],
    'postdate' => ['label' => '上傳時間', 'type' => 'date', 'required' => true],
    'notes1' => ['label' => '備註', 'type' => 'text', 'maxlength' => 50, 'required' => false]
];

?>

<div class="card bg-silver-lighter mb-10px" style="overflow:hidden">
    <div class="card-body">
        <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['Actnews']; ?> <small>新增</small> <?php require($page_view_path_vendor . "require_lang_show.php"); ?></h4>
    </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9">
    <!-- begin panel-heading -->
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa-plus"></i> 新增資料</h4>
        <?php require($page_view_path_vendor . "require_panel_heading_btn.php"); ?>
    </div>
    <!-- end panel-heading -->
    <!-- begin panel-body -->
    <div class="panel-body p-0">

        <form action="<?php echo $request->getRequestUri(); ?>" class="form-horizontal form-bordered" data-parsley-validate="" method="post" enctype="multipart/form-data">


            <div class="form-group row">
                <label class="col-md-2 col-form-label"></label>
                <div class="col-md-10">
                    <button type="submit" class="btn btn-primary w-100 btn-block">送出</button>
                    <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
                    <input name="wshop" type="hidden" id="wshop" value="<?php echo $wshop; ?>" />
                    <input name="module_uri" type="hidden" id="module_uri" value="<?php echo $useModuleUri; ?>" />
                    <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
                </div>
            </div>
            <input type="hidden" name="MM_insert" value="form_Actnews" />
            <!-- CSRF Token -->
            <input type="hidden" name="_token" value="<?php echo $request->session()->get('_token'); ?>" >
        </form>
    </div>
    <!-- end panel-body -->
</div>
<!-- end panel -->

<?php //require_once("require_template_panel.php"); ?>

<script type="text/javascript">
<?php
/*
文檔
https://github.com/kartik-v/bootstrap-fileinput/wiki/12.-%E4%B8%80%E4%BA%9B%E6%A0%B7%E4%BE%8B%E4%BB%A3%E7%A0%81
*/
?>
$(document).ready(function() {
	$("#pic").fileinput({
		showUpload:true,
		uploadAsync: false, //设置上传同步异步 此为同步
		//uploadUrl: "index.php", //上传的地址
		allowedFileExtensions: ["jpg","png","gif"],
		//resizeImage: true,
		maxImageWidth: 1500,
		maxImageHeight: 1500,
		//resizePreference: 'width',
		maxFileSize: 3000,
		//uploadExtraData: {id: "somedata"}
		//maxImageWidth: 50,//图片的最大宽度
		});
});
</script>

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
