<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 折扣 <small>選擇</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fab fa-dropbox"></i> 指定商品</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
  
  <a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=discount_add_1&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-lg btn-green btn-block"><i class="fa fa-2x fa-cube pull-left"></i><i class="fa fa-2x fa-percent pull-left m-l-5"></i><i class="fas fa-2x fa-chevron-circle-right pull-right"></i> 滿件折扣<br /><small>指定商品滿x件打x折</small></a>
  
  <a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=discount_add_2&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-lg btn-info btn-block"><i class="fa fa-2x fa-cube pull-left"></i><i class="fa fa-2x fa-minus pull-left m-l-5"></i><i class="fas fa-2x fa-chevron-circle-right pull-right"></i> 滿件減價<br /><small>指定商品滿x件減x元</small></a>
  
  <a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=discount_add_3&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-lg btn-green btn-block"><i class="fa fa-2x fa-dollar-sign pull-left m-l-5"></i><i class="fa fa-2x fa-percent pull-left m-l-10"></i><i class="fas fa-2x fa-chevron-circle-right pull-right"></i> 滿額折扣<br /><small>指定商品滿x元打x折</small></a>
  
  <a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=discount_add_4&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-lg btn-info btn-block"><i class="fa fa-2x fa-dollar-sign pull-left m-l-5"></i><i class="fa fa-2x fa-minus pull-left m-l-10"></i><i class="fas fa-2x fa-chevron-circle-right pull-right"></i> 滿額減價<br /><small>指定商品滿x元減x元</small></a>
  
  <a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=discount_add_5&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-lg btn-danger btn-block"><i class="fa fa-2x fa-plus pull-left"></i><i class="fa fa-2x fa-plus pull-left m-l-5"></i><i class="fas fa-2x fa-chevron-circle-right pull-right"></i> 任選優惠<br /><small>指定商品任選x件x元</small></a>
  
        
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-clipboard"></i> 全單滿額</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
  
  <a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=discount_add_6&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-lg btn-green btn-block"><i class="fa fa-2x fa-dollar-sign pull-left m-l-5"></i><i class="fa fa-2x fa-percent pull-left m-l-10"></i><i class="fas fa-2x fa-chevron-circle-right pull-right"></i> 滿額折扣<br /><small>指定商品滿x件打x折</small></a>
  
  <a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=discount_add_7&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-lg btn-info btn-block"><i class="fa fa-2x fa-dollar-sign pull-left m-l-5"></i><i class="fa fa-2x fa-minus pull-left m-l-10"></i><i class="fas fa-2x fa-chevron-circle-right pull-right"></i> 滿額減價<br /><small>指定商品滿x件減x元</small></a>
  
  <a href="manage_cart.php?wshop=<?php echo $wshop;?>&amp;Opt=discount_add_8&amp;lang=<?php echo $_SESSION['lang']; ?>" class="btn btn-lg btn-warning btn-block"><i class="fa fa-2x fa-dollar-sign pull-left m-l-5"></i><i class="fa fa-2x fa-gift pull-left m-l-10"></i><i class="fas fa-2x fa-chevron-circle-right pull-right"></i> 滿額贈禮<br /><small>指定商品滿x元打x折</small></a>
  
        
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->
