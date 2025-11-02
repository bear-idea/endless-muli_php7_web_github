<ul class="xbreadcrumbs" id="breadcrumbs-1" data-scroll-reveal='enter top after 0.8s'>
  <li><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>" class="home"><?php echo $Lang_Home; //首頁 ?></a></li>
  <?php if ($_GET['Opt'] != 'viewpage' && $row_RecordRoomViewLine_l1['itemname'] != '') { // Show if recordset not empty ?>
  <li><i class="fa fa-angle-double-right"></i> 
  <a href="<?php echo $SiteBaseUrl . url_rewrite('room',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Room']; //產品資訊 ?></a>
  </li>
  <!-- 第一層分類 -->
  <?php if (isset($_GET['type1'])) { ?>
  <li class="<?php if ($_GET['Opt'] != 'detailed') { echo 'current';}?>"><i class="fa fa-angle-double-right"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$_GET['type1']),'',$UrlWriteEnable);?>"><?php echo $ViewLinetype1; ?></a>
  </li>
  <?php } ?>
  <!-- 第一層分類 END -->
  <!-- 第二層分類 -->
  <?php if (isset($_GET['type2'])) { ?>
    <li class="<?php if ($_GET['Opt'] != 'detailed') { echo 'current';}?>"><i class="fa fa-angle-double-right"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$_GET['type1'],'type2'=>$_GET['type2']),'',$UrlWriteEnable);?>"><?php echo $ViewLinetype2; ?></a>
  </li>
  <?php } ?>
  <!-- 第二層分類 END -->
  <!-- 第三層分類 -->
  <?php if (isset($_GET['type3'])) { ?>
     <li class="<?php if ($_GET['Opt'] != 'detailed') { echo 'current';}?>"><i class="fa fa-angle-double-right"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'subpage','type1'=>$_GET['type1'],'type2'=>$_GET['type2'],'type3'=>$_GET['type3']),'',$UrlWriteEnable);?>"><?php echo $ViewLinetype3; ?></a>
  </li>
  <?php } ?>
  <!-- 第三層分類 END -->
  <?php if (isset($_GET['Opt']) && $_GET['Opt']=='detailed') {?>
  <li class="current"><i class="fa fa-angle-double-right"></i> <a><?php echo $row_RecordRoomKeyWord['name']; ?></a></li>
  <?php } ?>
  <?php } else { // Show if recordset not empty ?>
  <li class="current"><i class="fa fa-angle-double-right"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Room']; //產品資訊 ?></a></li>
  <?php }  ?>
   <?php
			switch($_GET['Opt'])
			{
				case "reserve":
					echo"<li class=\"current\"><i class=\"fa fa-angle-double-right\"></i> <a>選擇日期</a></li>";	
					break;
				case "roomlist":
					echo"<li class=\"current\"><i class=\"fa fa-angle-double-right\"></i> <a>房型列表</a></li>";	
					break;
				case "showpage":
					echo"<li class=\"current\"><i class=\"fa fa-angle-double-right\"></i> <a>檢視訂購資訊</a></li>";	
					break;
				case "checkpage":
					echo"<li class=\"current\"><i class=\"fa fa-angle-double-right\"></i> <a>確認訂單</a></li>";		
					break;
				case "purchasepage":
					echo"<li class=\"current\"><i class=\"fa fa-angle-double-right\"></i> <a>填寫房客資料</a></li>";			
					break;
				case "purchasecheckpage":
					echo"<li class=\"current\"><i class=\"fa fa-angle-double-right\"></i> <a>再次確認</a></li>";			
					break;
				default:
					break;
			}
		?>
</ul>
<div class="clear" style="clear:both;"></div>
<?php
mysqli_free_result($RecordRoomViewLine_l1);
?>