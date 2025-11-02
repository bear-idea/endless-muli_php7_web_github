<?php require($page_view_path_vendor."require_panel_heading_title.php"); ?>

<div class="panel panel-inverse bg-white-transparent-9">
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa fa-edit"></i> 修改次分類</h4>
        <div class="btn-group float-end mr-10px"><a href="news?wshop=<?php echo $wshop; ?>&amp;Opt=listpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-bs-original-title="" data-bs-toggle="tooltip" data-bs-placement="top" class="text-nowrap btn btn-default btn-sm"><i class="fa fa-reply fa-fw"></i> 上一頁</a></div>
        <?php require($page_view_path_vendor . "require_panel_heading_btn.php"); ?>
    </div>
    <div class="panel-body">
        <?php if ($totalRows_RecordNewsListItem > 0) { // Show if recordset not empty ?>
            <form id="form_NewsItemEdit" name="form_NewsItemEdit" method="POST"
                  action="<?php echo $request->getRequestUri(); ?>" class="form-horizontal form-bordered"
                  data-parsley-validate>
                <div id="card_sortable">
                    <?php foreach ($RecordNewsListItem as $row_RecordNewsListItem) { ?>
                        <div class="widget-card bg-cyan-transparent-1"
                             data-post-id="<?php echo $row_RecordNewsListItem['item_id']; ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <div class="input-group p-0">
                                                <span class="input-group-text">名稱</span>
                                                <input name="itemname[]" type="text" value="<?php echo $row_RecordNewsListItem['itemname']; ?>" class="form-control" data-parsley-trigger="blur" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group row">
                                            <div class="input-group p-0">
                                                <span class="input-group-text">排序</span>
                                                <input name="sortid[]" type="number" value="<?php echo $row_RecordNewsListItem['sortid']; ?>" class="form-control" maxlength="10" data-parsley-trigger="blur" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group row">
                                            <div class="input-group p-0">
                                                <span class="input-group-text">狀態</span>
                                                <select class="form-control form-select" name="indicate[]">
                                                    <option <?php if ($row_RecordNewsListItem['indicate'] == 1) {echo 'selected';} ?> value="1">顯示</option>
                                                    <option <?php if ($row_RecordNewsListItem['indicate'] == 0) {echo 'selected';} ?> value="0">隱藏</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-1 d-flex align-items-center">
                                        <div class="form-group row">
                                            <div class="input-group p-0">
                                                <div class="checkbox checkbox-css">
                                                    <input name="delid[]" class="form-check-input" type="checkbox" id="delid_<?php echo $row_RecordNewsListItem['item_id']; ?>" value="<?php echo $row_RecordNewsListItem['item_id']; ?>"/>
                                                    <label class="form-check-label" for="delid_<?php echo $row_RecordNewsListItem['item_id']; ?>">是否刪除</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group row">
                                            <div class="input-group p-0">
                                                <button type="submit" class="btn btn-primary w-100 btn-block">送出</button>
                                                <input name="item_id[]" type="hidden" value="<?php echo $row_RecordNewsListItem['item_id']; ?>"/>
                                                <input name="list_id[]" type="hidden" value="<?php echo $row_RecordNewsListItem['list_id']; ?>"/>
                                                <input name="lang[]" type="hidden" value="<?php echo $row_RecordNewsListItem['lang']; ?>"/>
                                                <input name="Operate" type="hidden" value="editSuccess"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <input type="hidden" name="MM_update" value="form_NewsItemEdit"/>
                <input type="hidden" name="_token" value="<?php echo $request->session()->get('_token'); ?>" >
            </form>
        <?php } // Show if recordset not empty ?>
    </div>
</div>

<div class="panel panel-inverse bg-white-transparent-9">
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa-plus"></i> 新增次分類</h4>
        <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
    </div>
    <div class="panel-body">
        <form id="form_NewsItemAdd" name="form_NewsItemAdd" method="POST" action="<?php echo $request->getRequestUri(); ?>" class="form-horizontal form-bordered" data-parsley-validate>
            <div class="widget-card bg-cyan-transparent-1">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group row">
                                <div class="input-group p-0">
                                    <span class="input-group-text">名稱</span>
                                    <input name="itemname" type="text" class="form-control" data-parsley-trigger="blur" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group row">
                                <div class="input-group p-0">
                                    <button type="submit" class="btn btn-primary w-100 btn-block">送出</button>
                                    <input name="list_id" type="hidden" value="<?php echo $_GET['list_id']; ?>" />
                                    <input name="lang" type="hidden" value="<?php echo $_GET['lang']; ?>" />
                                    <input name="Operate" type="hidden" value="addSuccess" />
                                    <input name="subitem_id" type="hidden" value="0" />
                                    <input name="userid" type="hidden" value="<?php echo $w_userid ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="MM_insert" value="form_NewsItemAdd" />
            <input type="hidden" name="_token" value="<?php echo $request->session()->get('_token'); ?>" >
        </form>
    </div>
</div>
