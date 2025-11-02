<?php
use App\Eloquent\Admin\Actnewslist;

$RecordActnewsList = (new Actnewslist)->getList($request);

?>

<div class="card bg-silver-lighter mb-10px" style="overflow:hidden">
  <div class="card-body">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['Actnews']; ?> <small>設定</small> <?php require($page_view_path_vendor."require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <h4 class="panel-title"><i class="fa fa-list-ul"></i> 清單一覽</h4>
      <?php require($page_view_path_vendor."require_panel_heading_btn.php"); ?>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
                        	<!-- begin table-responsive -->
                        	<div class="table-responsive">
								<table class="table table-hover mb-0 text-dark">
									<tbody>
                                    <?php foreach($RecordActnewsList as $row_RecordActnewsList) { ?>
                                       <tr>
                                         <td width="100" valign="middle">清單名稱</td>
                                         <td class="with-btn">
                                         <a class="text-nowrap btn btn-default btn-sm" href="actnews?wshop=<?php echo $wshop;?>&amp;Opt=listitempage&amp;lang=<?php echo $_GET['lang']; ?>&amp;list_id=<?php echo $row_RecordActnewsList['list_id']; ?>"><?php echo $row_RecordActnewsList['listname']; ?> <i class="fa fa-chevron-circle-right"></i></a>
                                         </td>    
                                       </tr>
                                       <?php }  ?>
									</tbody>
								</table>
	</div>
							<!-- end table-responsive -->
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->