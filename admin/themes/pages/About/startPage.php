<?php
$useModuleUri = $request->input('useModuleUri');
?>

<?php require($page_view_path_vendor."require_panel_heading_title.php"); ?>

    <div class="panel panel-inverse bg-white-transparent-9">
        <div class="panel-heading">
            <h4 class="panel-title"><i class="fa fa-star"></i> 設定起始頁</h4>
            <!-- Panel Heading Buttons -->
        </div>
        <div class="panel-body p-0">
            <form action="<?php echo htmlspecialchars($request->getRequestUri()); ?>" class="form-horizontal form-bordered" method="post">
                <?php foreach ($RecordAbout as $row_RecordAbout): ?>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="checkbox checkbox-css">
                                <input class="form-check-input" type="radio" id="id_check_<?php echo $row_RecordAbout['id']; ?>" name="id_check" value="<?php echo $row_RecordAbout['id']; ?>" <?php echo ($row_RecordAbout['home'] == 1 ? 'checked' : ''); ?> data-parsley-trigger="blur" required>
                                <label for="id_check_<?php echo $row_RecordAbout['id']; ?>"><?php echo htmlspecialchars($row_RecordAbout['title']); ?></label>
                                <button type="button" class="btn btn-<?php echo ($row_RecordAbout['home'] == 1 ? 'warning' : 'gray'); ?> btn-xs float-end"><i class="fa fa-<?php echo ($row_RecordAbout['home'] == 1 ? 'check-circle' : 'circle'); ?>"></i> 起始頁</button>
                                <input type="hidden" name="id[]" value="<?php echo $row_RecordAbout['id']; ?>">
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="form-group row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary w-100">送出</button>
                    </div>
                </div>
                <input type="hidden" name="lang" value="<?php echo htmlspecialchars($_GET['lang']); ?>">
                <input type="hidden" name="userid" value="<?php echo htmlspecialchars($w_userid); ?>">
                <input type="hidden" name="MM_update" value="form_About">
                <input type="hidden" name="_token" value="<?php echo htmlspecialchars($request->session()->get('_token')); ?>">
            </form>
        </div>
    </div>
