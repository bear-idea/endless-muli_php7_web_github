<ol class="breadcrumb hidden-xs" data-scroll-reveal='enter top after 0.8s'>
  <li><i class="fa fa-home"></i> <a href="<?php echo $SiteBaseUrl . url_rewrite('index',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang']),'',$UrlWriteEnable);?>" class="home"><?php echo $Lang_Home; //首頁 ?></a></li>
  <?php if ($_GET['Opt'] != 'viewpage') { // Show if recordset not empty ?>
  <li>
  <a href="<?php echo $SiteBaseUrl . url_rewrite('forum',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewpage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Forum']; //討論專區 ?></a>
  </li>
  <!-- 第一層分類 -->
  <?php if (isset($_GET['type1']) && $_GET['type1'] != "") { ?>
  <li class="<?php if ($_GET['type1'] == "" && $_GET['Opt'] != 'detailed' && $_GET['Opt'] != 'postpage' && $_GET['Opt'] != 'replypage') { echo 'current';}?>"><a href="<?php echo $SiteBaseUrl . url_rewrite('forum',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'typepage','type1'=>$_GET['type1']),'',$UrlWriteEnable);?>">
  <?php
		  	do {  //比較字串
  ?>
		  <?php if (!(strcmp($row_RecordForumViewLine_l1['item_id'], $_GET['type1']))) { echo $row_RecordForumViewLine_l1['itemname']; } ?>
		  <?php
} while ($row_RecordForumViewLine_l1 = mysqli_fetch_assoc($RecordForumViewLine_l1));
  $rows = mysqli_num_rows($RecordForumViewLine_l1);
  if($rows > 0) {
      mysqli_data_seek($RecordForumViewLine_l1, 0);
	  $row_RecordForumViewLine_l1 = mysqli_fetch_assoc($RecordForumViewLine_l1);
  }
  ?></a>
  </li>
  <?php } ?>
  <!-- 第一層分類 END -->
  <!-- 第二層分類 -->
  <?php if ($_GET['type2'] != "") {?>
    <li class="<?php if ($_GET['type2'] != ""  && $_GET['Opt'] != 'detailed' && $_GET['Opt'] != 'postpage' && $_GET['Opt'] != 'replypage') { echo 'current';}?>"><a href="<?php echo $SiteBaseUrl . url_rewrite('forum',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'typepage','type1'=>$_GET['type1'],'type2'=>$_GET['type2']),'',$UrlWriteEnable);?>">
  <?php
		  	do {  //比較字串
  ?>
		  <?php if (!(strcmp($row_RecordForumViewLine_l1['item_id'], $_GET['type2']))) { echo $row_RecordForumViewLine_l1['itemname']; } ?>
		  <?php
} while ($row_RecordForumViewLine_l1 = mysqli_fetch_assoc($RecordForumViewLine_l1));
  $rows = mysqli_num_rows($RecordForumViewLine_l1);
  if($rows > 0) {
      mysqli_data_seek($RecordForumViewLine_l1, 0);
	  $row_RecordForumViewLine_l1 = mysqli_fetch_assoc($RecordForumViewLine_l1);
  }
  ?>
  </a>
  </li>
  <?php } ?>
  <!-- 第二層分類 END -->
  <!-- 第三層分類 -->
  <?php if ($_GET['type3'] != "") {?>
     <li class="<?php if ($_GET['type3'] != "" && $_GET['Opt'] != 'detailed' && $_GET['Opt'] != 'postpage' && $_GET['Opt'] != 'replypage') { echo 'current';}?>"><a href="<?php echo $SiteBaseUrl . url_rewrite('forum',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'typepage','type1'=>$_GET['type1'],'type2'=>$_GET['type2'],'type3'=>$_GET['type3']),'',$UrlWriteEnable);?>">
  <?php
		  	do {  //比較字串
  ?>
		  <?php if (!(strcmp($row_RecordForumViewLine_l1['item_id'], $_GET['type3']))) { echo $row_RecordForumViewLine_l1['itemname']; } ?>
		  <?php
} while ($row_RecordForumViewLine_l1 = mysqli_fetch_assoc($RecordForumViewLine_l1));
  $rows = mysqli_num_rows($RecordForumViewLine_l1);
  if($rows > 0) {
      mysqli_data_seek($RecordForumViewLine_l1, 0);
	  $row_RecordForumViewLine_l1 = mysqli_fetch_assoc($RecordForumViewLine_l1);
  }
  ?>
  </a>
  </li>
  <?php } ?>
  <!-- 第三層分類 END -->
	  <?php if (isset($_GET['Opt']) && $_GET['Opt']=='detailed') {?>
      <li class="current"><a><?php echo $row_RecordForumKeyWord['name']; ?></a></li>
      <?php } ?>
      <?php if ($_GET['Opt'] == 'postpage') {?>
      <li class="current"><a>發新主題</a></li>
      <?php } ?>
      <?php if ($_GET['Opt'] == 'editpostpage') {?>
      <li class="current"><a>修改主題</a></li>
      <?php } ?>
      <?php if ($_GET['Opt'] == 'replypage') {?>
      <li class="current"><a>回覆主題</a></li>
      <?php } ?>
      <?php if ($_GET['Opt'] == 'reg') {?>
      <li class="current"><a>註冊</a></li>
      <?php } ?>
      <?php if ($_GET['Opt'] == 'log') {?>
      <li class="current"><a>登入</a></li>
      <?php } ?>
      <?php if ($_GET['Opt'] == 'pswfgt') {?>
      <li class="current"><a>忘記密碼</a></li>
      <?php } ?>
      <?php if ($_GET['Opt'] == 'pswfgt2') {?>
      <li class="current"><a>忘記密碼</a></li>
      <?php } ?>
  <?php } else { // Show if recordset not empty ?>
  <li class="current"><a href="<?php echo $SiteBaseUrl . url_rewrite('forum',array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'viewepage'),'',$UrlWriteEnable);?>"><?php echo $ModuleName['Forum']; //討論專區 ?></a></li>
  <?php }  ?>
</ol>
<div class="clear" style="clear:both;"></div>
<?php
mysqli_free_result($RecordForumViewLine_l1);
?>