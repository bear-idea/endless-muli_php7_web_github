<?php
$parameters = ['lang' => $_SESSION['lang'] ?? 'zh_TW'];
$useModuleUri = $request->input('useModuleUri');

// 渲染次分類項目的函數
function renderListItemMenu($items, $level = 0) {
    foreach ($items as $item) {
        ?>
        <div class="widget-card bg-cyan-transparent-1" data-post-id="<?php echo $item['id']; ?>" style="margin-left: <?php echo $level * 20; ?>px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="input-group px-0 py-5px">
                                <span class="input-group-text">名稱</span>
                                <input name="itemname[]" type="text" value="<?php echo $item['itemname']; ?>" class="form-control" data-parsley-trigger="blur" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group row">
                            <div class="input-group px-0 py-5px">
                                <span class="input-group-text">排序</span>
                                <input name="sortid[]" type="number" value="<?php echo $item['sortid']; ?>" class="form-control" maxlength="10" data-parsley-trigger="blur" required/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group row">
                            <div class="input-group px-0 py-5px">
                                <span class="input-group-text">狀態</span>
                                <select class="form-control form-select" name="indicate[]">
                                    <option <?php if ($item['indicate'] == 1) {echo 'selected';} ?> value="1">顯示</option>
                                    <option <?php if ($item['indicate'] == 0) {echo 'selected';} ?> value="0">隱藏</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 py-1">
                        <div class="form-group row">
                            <div class="input-group p-0">
                                <a class="btn btn-info w-100 btn-block" href="<?php echo ADMINURL . generateUrl('/'.toSpinalCase($item['module_uri']).'/multi-listitem/'.$item['list_id'] . '/' . $item['id'], $parameters); ?>" data-bs-original-title="點選查看下層的分類項目" data-bs-toggle="tooltip" data-bs-placement="top">子分類 <i class="fa fa-chevron-circle-right"></i> <span class="badge bg-primary float-end"><?php echo $item['children_count']; ?></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 d-flex align-items-center">
                        <div class="form-group row">
                            <div class="input-group px-0 py-5px">
                                <div class="checkbox checkbox-css">
                                    <input name="delId[]" class="form-check-input" type="checkbox" id="delId_<?php echo $item['id']; ?>" value="<?php echo $item['id']; ?>"/>
                                    <label class="form-check-label" for="delId_<?php echo $item['id']; ?>">是否刪除</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group row">
                            <div class="input-group px-0 py-5px">
                                <button type="submit" class="btn btn-primary w-100 btn-block">送出</button>
                                <input name="id[]" type="hidden" value="<?php echo $item['id']; ?>"/>
                                <input name="list_id[]" type="hidden" value="<?php echo $item['list_id']; ?>"/>
                                <input name="lang[]" type="hidden" value="<?php echo $item['lang']; ?>"/>
                                <input name="list_alias[]" type="hidden" value="<?php echo $item['list_alias']; ?>"/>
                                <input name="parent_id[]" type="hidden" value="<?php echo $item['parent_id']; ?>"/>
                                <input name="Operate" type="hidden" value="editSuccess"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        // 如果有子元素，遞歸調用函數渲染子分類項目
        if (!empty($item['children'])) {
            renderListItemMenu($item['children'], $level + 1);
        }
    }
}
?>

<?php require($page_view_path_vendor."require_panel_heading_title.php"); ?>

<div class="panel panel-inverse bg-white-transparent-9">
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa fa-edit"></i> 修改次分類 <span class="badge bg-primary ms-1"><?php echo $row_RecordListMenu['listname']; ?></span><span class="badge bg-success ms-1"><?php echo $row_RecordListMenu['alias']; ?></span></h4>
        <div class="btn-group float-end mr-10px"><a href="<?php echo ADMINURL . generateUrl('/'.toSpinalCase($useModuleUri).'/multi-listitem/'. $RecordMultiListItemMenu[0]['parent_menu']['list_id'] . '/' . $RecordMultiListItemMenu[0]['parent_menu']['parent_id'], $parameters); ?>" data-bs-original-title="" data-bs-toggle="tooltip" data-bs-placement="top" class="text-nowrap btn btn-default btn-sm me-2"><i class="fa fa-reply fa-fw"></i> 返回 <?php echo $RecordMultiListItemMenu[0]['parent_menu']['itemname']; ?></a></div><div class="btn-group float-end mr-10px"><a href="<?php echo ADMINURL . generateUrl('/'.toSpinalCase($useModuleUri).'/list', $parameters); ?>" data-bs-original-title="" data-bs-toggle="tooltip" data-bs-placement="top" class="text-nowrap btn btn-default btn-sm"><i class="fa fa-reply fa-fw"></i> 清單設定</a></div>
        <?php require($page_view_path_vendor . "require_panel_heading_btn.php"); ?>
    </div>
    <div class="panel-body">
        <form id="form_ListItemMenuEdit" name="form_ListItemMenuEdit" method="POST" action="<?php echo $request->getRequestUri(); ?>" class="form-horizontal form-bordered" data-parsley-validate>
            <div id="card_sortable">
                <?php renderListItemMenu($RecordMultiListItemMenu); ?>
            </div>
            <input type="hidden" name="MM_update" value="form_ListItemMenuEdit"/>
            <input type="hidden" name="_token" value="<?php echo $request->session()->get('_token'); ?>" >
        </form>
    </div>
</div>

<div class="panel panel-inverse bg-white-transparent-9">
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa-plus"></i> 新增次分類 <span class="badge bg-primary ms-1"><?php echo $row_RecordListMenu['listname']; ?></span><span class="badge bg-success ms-1"><?php echo $row_RecordListMenu['alias']; ?></span></h4>
        <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
    </div>
    <div class="panel-body">
        <form id="form_ListItemMenuAdd" name="form_ListItemMenuAdd" method="POST" action="<?php echo $request->getRequestUri(); ?>" class="form-horizontal form-bordered" data-parsley-validate>
            <div class="widget-card bg-cyan-transparent-1">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group row">
                                <div class="input-group px-0 py-5px">
                                    <span class="input-group-text">名稱</span>
                                    <input name="itemname" type="text" class="form-control" data-parsley-trigger="blur" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group row">
                                <div class="input-group px-0 py-5px">
                                    <button type="submit" class="btn btn-primary w-100 btn-block">送出</button>
                                    <input name="list_id" type="hidden" value="<?php echo $row_RecordMultiListItemMenu['list_id']; ?>" />
                                    <input name="list_alias" type="hidden" value="<?php echo $row_RecordListMenu['alias']; ?>"/>
                                    <input name="module_uri" type="hidden" value="<?php echo $row_RecordListMenu['module_uri']; ?>"/>
                                    <input name="lang" type="hidden" value="<?php echo $_GET['lang']; ?>" />
                                    <input name="Operate" type="hidden" value="addSuccess" />
                                    <input name="parent_id" type="hidden" value="<?php echo $RecordMultiListItemMenu[0]['parent_menu']['id'] ?? 0; ?>" />
                                    <input name="userid" type="hidden" value="<?php echo $w_userid ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="MM_insert" value="form_ListItemMenuAdd"/>
            <input type="hidden" name="_token" value="<?php echo $request->session()->get('_token'); ?>" >
        </form>
    </div>
</div>
