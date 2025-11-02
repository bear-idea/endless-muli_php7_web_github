<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> <?php echo $ModuleName['Catalog']; ?> <small>選擇</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  <a href="manage_catalog.php?wshop=<?php echo $wshop;?>&amp;Opt=addpage_d&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-lg btn-green btn-block"><i class="fa fa-2x fa-cloud-upload-alt pull-left"></i><i class="fas fa-2x fa-chevron-circle-right pull-right"></i> 本地上傳<br /><small>將檔案放置在主機空間，單檔限制50MB</small></a>
  
  <a href="manage_catalog.php?wshop=<?php echo $wshop;?>&amp;Opt=addpage_l&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-lg btn-danger btn-block"><i class="fa fa-2x fa-link pull-left"></i><i class="fas fa-2x fa-chevron-circle-right pull-right"></i> 外部連結<br /><small>將檔案放置在外部空間，不限制檔案大小</small></a>
  
  <a href="manage_catalog.php?wshop=<?php echo $wshop;?>&amp;Opt=addpage_p&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-lg btn-success btn-block"><i class="fab fa-2x fa-wpforms pull-left"></i><i class="fas fa-2x fa-chevron-circle-right pull-right"></i> 頁面上傳<br /><small>可以透過HTML編輯器的方式將檔案上傳</small></a>
  
        
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->
