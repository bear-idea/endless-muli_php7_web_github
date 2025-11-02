<?php

use App\Eloquent\Admin\Aboutlist;

$RecordAboutList = (new Aboutlist)->getList($request);

//dd($RecordAboutList);

?>

<div class="card bg-silver-lighter mb-10px" style="overflow:hidden">
  <div class="card-body">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['About']; ?> <small>設定</small> <?php require($page_view_path_vendor."require_lang_show.php"); ?></h4>
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
								<table class="table table-striped">
									<tbody>
                                    <?php foreach($RecordAboutList as $row_RecordAboutList) { ?>
                                       <tr>
                                         <td width="100" valign="middle">清單名稱</td>
                                         <td class="with-btn">
                                         <?php if ($row_RecordAboutList['mulitype'] == '0') { // 單層?>
                                         <a class="text-nowrap btn btn-default btn-sm" href="manage_about.php?wshop=<?php echo $wshop;?>&amp;Opt=listitempage&amp;lang=<?php echo $_GET['lang']; ?>&amp;list_id=<?php echo $row_RecordAboutList['list_id']; ?>"><?php echo $row_RecordAboutList['listname']; ?> <i class="fa fa-chevron-circle-right"></i></a>
                                         <?php } elseif ($row_RecordAboutList['mulitype'] == '1') { // 多層?>
                                         <a class="text-nowrap btn btn-default btn-sm" href="manage_about.php?wshop=<?php echo $wshop;?>&amp;Opt=mulilistitempage&amp;lang=<?php echo $_GET['lang']; ?>&amp;list_id=<?php echo $row_RecordAboutList['list_id']; ?>"><?php echo $row_RecordAboutList['listname']; ?> <i class="fa fa-chevron-circle-right"></i></a>
                                         <?php } ?>
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