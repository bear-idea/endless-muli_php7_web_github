<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 網站 <small>狀態</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-list-ul"></i> 資料一覽</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
  
  <div class="table-responsive">
								<table class="table table-striped m-b-0">
									<thead>
										<tr>
											<th width="200">#</th>
											<th>&nbsp;</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><strong>網站中文名稱</strong></td>
											<td><?php echo $row_RecordAccount['name']; ?></td>
										</tr>
										<tr>
										  <td width="150" class="TB_General_style01"><strong>本站網址</strong></td>
										  <td><?php if($row_RecordAccount['urlonly'] == '0') {$url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]; echo dirname(dirname($url));?>/<?php echo $row_RecordAccount['webname'];} ?></td>
									  </tr>
										<tr>
										  <td class="TB_General_style01"><strong>網址註冊日</strong></td>
										  <td><span class="font_color">
										    <?php if($row_RecordAccount['urlbuilddate'] == '') {echo "------";}else{$dt = new DateTime($row_RecordAccount['urlbuilddate']); echo $dt->format('Y-m-d');} ?>
										  </span></td>
									  </tr>
										<tr>
										  <td class="TB_General_style01"><strong>網址註冊地</strong></td>
										  <td><span class="font_color">
										    <?php if($row_RecordAccount['urllocalate'] == '') {echo "------";}else{echo $row_RecordAccount['urllocalate'];} ?>
										  </span></td>
									  </tr>
										<tr>
										  <td class="TB_General_style01"><strong>網站啟用日</strong></td>
										  <td><span class="font_color">
										    <?php if($row_RecordAccount['webenabledate'] == '') {echo "------";}else{$dt = new DateTime($row_RecordAccount['webenabledate']); echo $dt->format('Y-m-d');} ?>
										  </span></td>
									  </tr>
										<tr>
										  <td class="TB_General_style01"><strong>網站最後續約日</strong></td>
										  <td><span class="font_color">
										    <?php if($row_RecordAccount['webrenewdate'] == '') {echo "------";}else{$dt = new DateTime($row_RecordAccount['webrenewdate']); echo $dt->format('Y-m-d');} ?>
										  </span></td>
									  </tr>
										<tr>
										  <td class="TB_General_style01"><strong>網站到期日</strong></td>
										  <td><span style="color:#FF0000; font-weight:bolder;">
										    <?php 
									if($row_RecordAccount['webrenewdate'] == ''){$row_RecordAccount['webrenewdate'] = $row_RecordAccount['webenabledate'];}
									if($row_RecordAccount['usetime'] == ''){$row_RecordAccount['usetime'] = 0;}
									if($row_RecordAccount['webenabledate'] != ''){
									$endday = count_date($row_RecordAccount['webrenewdate'],$row_RecordAccount['usetime']);
									echo $endday; 
									} else { echo "------";}
							    ?>
										  </span></td>
									  </tr>
										<tr>
										  <td class="TB_General_style01"><strong>尚餘天數</strong></td>
										  <td><?php if ($row_RecordAccount['webrenewdate'] != '' && $row_RecordAccount['usetime'] != '') { ?>
                    <?php 
					$t_end = count_date($row_RecordAccount['webrenewdate'],$row_RecordAccount['usetime']);
					$t_now = date("Y-m-d");
					$t_dt = margin($t_now, $t_end);
						//echo $t_dt;
					?>
                    <?php 
		if($t_dt <= 0){ 	
			$t_dt = 0;	
		?>
                    <strong><?php echo $t_dt . "天"; ?></strong><span style="background-color:#999; color:#FFF; padding:2px; margin-left:5px;"><?php echo '已到期'; ?></span>
                    <?php 
		} else if ($t_dt <= 90){
		?>
                    <strong><?php echo $t_dt . "天"; ?></strong><span style=" background-color:#FF9933; color:#FFF; padding:2px; margin-left:5px;"><?php echo '<三個月'; ?></span>
                    <?php 
		} else if ($t_dt <= 30){
		?>
                    <strong><?php echo $t_dt . "天"; ?></strong><span style=" background-color:#C00; color:#FFF; padding:2px; margin-left:5px;"><?php echo '<一個月'; ?></span>
                    <?php 
		} else {
		?>
                    <?php echo $t_dt . "天"; ?>
                    <?php 
		}
		?>
                    <?php } ?></td>
									  </tr>
									</tbody>
								</table>
							</div>
  
        
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->
