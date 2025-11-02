<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['Modlink']; ?> <small>選擇</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-list-ul"></i> 模式選擇</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
  
  <a href="manage_modlink.php?wshop=<?php echo $wshop;?>&amp;Opt=addpage_d&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-lg btn-green btn-block"><i class="fa fa-2x fa-image pull-left"></i><i class="fas fa-2x fa-chevron-circle-right pull-right"></i> 預設圖片<br /><small>直接選用現有圖片模板</small></a>
  
  <a href="manage_modlink.php?wshop=<?php echo $wshop;?>&amp;Opt=addpage_c&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-lg btn-danger btn-block"><i class="fa fa-2x fa-cloud-upload-alt pull-left"></i><i class="fas fa-2x fa-chevron-circle-right pull-right"></i> 自訂圖片<br /><small>自行製作上傳圖片</small></a>
  
        
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->
