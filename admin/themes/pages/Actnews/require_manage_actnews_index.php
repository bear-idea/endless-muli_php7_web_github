<?php
use App\Eloquent\Admin\Actnewsitem;

$RecordActnewsListType = (new Actnewsitem)->getItemType( $request);
$RecordActnewsListAuthor = (new Actnewsitem)->getItemAuthor($request);

?>

<script src="<?php echo $SiteAdminPath; ?>sqldatatable/js/actnews_datatable.js?<?php echo time(); ?>"></script>


<div class="card bg-silver-lighter mb-10px" style="overflow:hidden">
    <div class="card-body">
        <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['Actnews']; ?> <small>總覽</small> <?php require($page_view_path_vendor."require_lang_show.php"); ?></h4>
    </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9">
    <!-- begin panel-heading -->
    <div class="panel-heading">
        <h4 class="panel-title"><i class="fa fa-database"></i> 資料一覽</h4>
        <div class="btn-group float-end mr-10px"><a href="javascript:void(0);" onclick="startIntro();" data-bs-original-title="教學導引 Step By Step" data-bs-toggle="tooltip" data-bs-placement="top" id="startButton" class="text-nowrap btn btn-default btn-sm"><i class="far fa-comment-alt fa-fw"></i> 導覽</a></div>
        <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
    </div>
    <!-- end panel-heading -->
    <!-- begin panel-body -->
    <div class="panel-body">
        <div class="row justify-content-end">
            <div class="col-md-2 col-sm-12 m-b-10">
                <div class="input-group" data-column="3"> <span class="input-group-text"><i class="fas fa-search fa-fw"></i> 類別</span>
                    <select name="type" class="form-control form-select search_filter" id="col3_filter">
                        <option value="%" selected="selected">全部</option>
                        <?php foreach($RecordActnewsListType as $row_RecordActnewsListType) { ?>
                            <option value="<?php echo $row_RecordActnewsListType['itemname']?>"><?php echo $row_RecordActnewsListType['itemname']?></option>
                        <?php }  ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-sm-12 m-b-10">
                <div class="input-group" data-column="5"> <span class="input-group-text"><i class="fas fa-search fa-fw"></i> 狀態</span>
                    <select name="indicate" class="form-control form-select search_filter" id="col5_filter">
                        <option value="%">全部</option>
                        <option value="1">公佈</option>
                        <option value="0">隱藏</option>
                    </select>
                </div>
            </div>
            <div class="col-md-5 m-b-10">
                <div class="input-group"> <span class="input-group-text"><i class="fas fa-search fa-fw"></i> 標題</span>
                    <input type="text" class="form-control global_filter" placeholder="" id="global_filter">
                    <div class="input-group-append" style="display:none">
                        <button type="button" class="text-nowrap btn btn-default" data-toggle="collapse" data-target="#collapseOne"> <span class="caret"></span> </button>
                    </div>
                </div>
            </div>
        </div>
        <div id="collapseOne" class="collapse" data-parent="#accordion">
            <div class="card-body bg-cyan-transparent-1 m-t-10">
                <div class="row">
                    <div class="col-md-12">

                    </div>
                </div>
            </div>
        </div>

        <table id="data-table-default" class="table table-striped table-bordered table-hover table-condensed align-middle">
            <thead>
            <tr>
                <th width="16"><input class="form-check-input" type="checkbox" name="select_all" value="1" id="data-table-default-select-all"></th>
                <th width="120">圖片</th>
                <th width="-1" data-priority="1"><strong>標題</strong></th>
                <th width="100" data-priority="1"><strong>類別</strong></th>
                <th width="70"><strong>排序</strong></th>
                <th width="70"><strong>狀態</strong></th>
                <th width="100"><strong>發布日期</strong></th>
                <th width="1%" class="desktop"><strong>操作</strong></th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <td>└</td>
                <td><button type="button" class="text-nowrap btn btn-default btn-sm" onclick="delete_muti_datatables(event);"><i class="far fa-trash-alt"></i> 刪除選取項目</button></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><button type="button" id="reset_table" class="text-nowrap btn btn-default btn-sm float-end"><i class="fa fa-sync"></i> 清除狀態</button></td>
            </tr>
            </tfoot>
        </table>
    </div>
    <!-- end panel-body -->
</div>
<!-- end panel -->

<script type="text/javascript">
    function startIntro(){
        var intro = introJs();
        intro.setOptions({
            steps: [
                {
                    element: '#Step_List',
                    intro: '您可以點選按鈕設置清單或點選下一步繼續導覽。<div style="text-align:center;margin-top:10px;"><span class = "InnerPage" style="float:none"><a href="manage_news.php?wshop=<?php echo $wshop;?>&Opt=listpage&lang=<?php echo $_SESSION['lang']; ?>" target="_blank"><i class="fas fa-chevron-circle-right"></i> 前往設置清單</a></span></div>'
                },
                {
                    element: '#Step_Add',
                    intro: '您可以點選按鈕新增資料或點選下一步繼續導覽。<div style="text-align:center;margin-top:10px;"><span class = "InnerPage" style="float:none"><a href="manage_news.php?wshop=<?php echo $wshop;?>&Opt=addpage&lang=<?php echo $_SESSION['lang']; ?>" target="_blank"><i class="fas fa-chevron-circle-right"></i> 前往新增資料</a></span></div>'
                },
                {
                    element: '#Step_View',
                    intro: '設置完後您可在此頁面觀看資料總覽。',
                    position: 'bottom'
                },
                {
                    element: '#Step_Edit',
                    intro: '<img src="images/tip/tip059.jpg" width="500" height="71" /><br /><br />點選文字可直接修改。',
                    position: 'bottom'
                },
                {
                    element: '#Step_Sort',
                    intro: '<img src="images/tip/tip060.jpg" width="126" height="102" /><br /><br />點選文字可直接修改，更改數字即可排序。',
                    position: 'bottom'
                },
                {
                    element: '#Step_MList',
                    intro: '<img src="images/tip/tip062.jpg" width="123" height="98" /><br /><br />點選文字可直接修改。',
                    position: 'bottom'
                },
                {
                    element: '#Step_Indicate',
                    intro: '<img src="images/tip/tip061.jpg" width="106" height="86" /><br /><br />點選文字可直接修改，勾選為公佈、反之則隱藏。',
                    position: 'bottom'
                }
            ],
            tooltipPosition: 'auto',
            positionPrecedence: ['left', 'right', 'bottom', 'top']
        });

        intro.start();
    }
</script>
