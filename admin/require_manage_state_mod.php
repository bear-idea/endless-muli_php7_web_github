<?php require_once('../Connections/DB_Conn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  Global $DB_Conn;
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = mysqli_real_escape_string($DB_Conn, $theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordModList = "SELECT * FROM demo_configitem";
$RecordModList = mysqli_query($DB_Conn, $query_RecordModList) or die(mysqli_error($DB_Conn));
$row_RecordModList = mysqli_fetch_assoc($RecordModList);
$totalRows_RecordModList = mysqli_num_rows($RecordModList);

/* 取得作者列表 */

?>
<style>
.Menu_ListView_Index{padding:5px}
.mod_board{margin:2px;float:left;width:100px;border:1px dotted #DDD;height:160px;position:relative}
.mod_pic{text-align:center;vertical-align:middle;padding:5px}
.mod_text{text-align:center;vertical-align:middle}
.InnerPage{float:none;text-align:center;padding-top:10px}
.mod_tip{height:30px}
</style>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 模組 <small>狀態</small> <?php require("require_lang_show.php"); ?></h4>
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
  
  
  <div class="Menu_ListView_Index">
         <?php do { ?>
         <?php
			switch($row_RecordModList['itemvalue'])
			{
				case "News":  // -------------------------------------------------
         ?>
         
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可自訂分類"><img src="img/ic01.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="WYSIWYG 網頁線上編輯器"><img src="img/ic03.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="首頁版型整合"><img src="img/ic10.png" width="20" height="20"/></a></div>
           <div class="mod_pic"><a href="http://www.shop3500.com/news.php?wshop=playweb" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionNewsSelect == '1') {?><img src="images/mt_001.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /></a>
           <?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/news.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
         
		 <?php
					break;
				case "Picasa":  // -------------------------------------------------
		 ?>
         
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可自訂分類"><img src="img/ic01.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="Google Picasa 相簿整合"><img src="img/ic21.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="主子頁面分類架構"><img src="img/ic06.png" width="20" height="20"/></a></div>
           <div class="mod_pic"><a href="http://www.shop3500.com/picasa.php?wshop=playweb" data-original-title="此模組會和Google之《Picase網路相簿》同步，您必須擁有Google帳戶，而照片資料則須透過《Picase網路相簿》上傳。" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionPicasaSelect == '1') {?><img src="images/mt_052.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /></a>
           <?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/picasa.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>      
		 <?php		
		 ?>
		 <?php		
					break;
				case "About":  // -------------------------------------------------
		 ?>
         
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="WYSIWYG 網頁線上編輯器"><img src="img/ic03.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="自由頁面資料新增"><img src="img/ic18.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="下拉選單分類"><img src="img/ic20.png" width="20" height="20"/></a></div>
           <div class="mod_pic"><a href="http://www.shop3500.com/about.php?wshop=playweb" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionAboutSelect == '1') {?><img src="images/mt_041.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /></a>
           <?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/about.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
         <?php		
					break;
				case "Timeline":  // -------------------------------------------------
		 ?>
         
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="影音圖片整合"><img src="img/ic22.png" width="20" height="20"/></a></div>
           <div class="mod_pic"><a href="http://www.shop3500.com/timeline.php?wshop=playweb" data-original-title="此模組會依您輸入的日期來產生類似於時間軸的效果，除了可新增文字外還允許您使用圖片、影片、網址來加入到時間軸的資料上。" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionTimelineSelect == '1') {?><img src="images/mt_057.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /></a>
           <?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/timeline.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
         <?php		
					break;
				case "Imageshow":  // -------------------------------------------------
		 ?>
         
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可自訂分類"><img src="img/ic01.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="瀑布流效果"><img src="img/ic23.png" width="20" height="20"/></a></div>
           <div class="mod_pic"><a href="http://www.shop3500.com/imageshow.php?wshop=playweb" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionImageshowSelect == '1') {?><img src="images/mt_058.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /></a>
           <?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/imageshow.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
		 <?php		
					break;	
				case "Product":  // -------------------------------------------------
		 ?>
         
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可自訂分類"><img src="img/ic01.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="三層分類"><img src="img/ic04.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="WYSIWYG 網頁線上編輯器"><img src="img/ic03.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="首頁版型整合"><img src="img/ic10.png" width="20" height="20"/></a></div>
           <div class="mod_pic"><a href="http://www.shop3500.com/product.php?wshop=playweb" data-original-title="此模組所新增之分類最多支援至三級選單，您可依據您的需求來做調整。" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionProductSelect == '1') {?><img src="images/mt_002.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /></a>
           <?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/product.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
		 <?php		
					break;	
				case "Guestbook":  // -------------------------------------------------
		 ?>
         
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="悄悄話功能"><img src="img/ic05.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="WYSIWYG 網頁線上編輯器"><img src="img/ic03.png" width="20" height="20"/></a></div>
           <div class="mod_pic"><a href="http://www.shop3500.com/guestbook.php?wshop=playweb" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionGuestbookSelect == '1') {?><img src="images/mt_007.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /></a>
           <?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/guestbook.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
         
		 <?php		
					break;	
				case "Activities":  // -------------------------------------------------
		 ?>
         
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可自訂分類"><img src="img/ic01.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="WYSIWYG 網頁線上編輯器"><img src="img/ic03.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="主子頁面分類架構"><img src="img/ic06.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="首頁版型整合"><img src="img/ic10.png" width="20" height="20"/></a></div>
           <div class="mod_pic"><a href="http://www.shop3500.com/activities.php?wshop=playweb" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionActivitiesSelect == '1') {?><img src="images/mt_014.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /></a>
           <?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/activities.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
         
		 <?php		
					break;	
				case "Project":  // -------------------------------------------------
		 ?>
         
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可自訂分類"><img src="img/ic01.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="WYSIWYG 網頁線上編輯器"><img src="img/ic03.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="主子頁面分類架構"><img src="img/ic06.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="首頁版型整合"><img src="img/ic10.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="商品櫥窗整合"><img src="img/ic11.png" width="20" height="20"/></a></div>
           <div class="mod_pic"><a href="http://www.shop3500.com/project.php?wshop=playweb" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionProjectSelect == '1') {?><img src="images/mt_032.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /></a>
           <?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/project.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
             
         <?php		
					break;	
				case "Album":  // -------------------------------------------------
		 ?>
         
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可自訂分類"><img src="img/ic01.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="主子頁面分類架構"><img src="img/ic06.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="可更換外框樣式"><img src="img/ic12.png" width="20" height="20"/></a></div>
           <div class="mod_pic"><a href="http://www.shop3500.com/album.php?wshop=playweb" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionAlbumSelect == '1') {?><img src="images/mt_012.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /></a>
           <?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/album.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
         
		 <?php		
					break;	
				case "Frilink":  // -------------------------------------------------
		 ?>
         
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可自訂分類"><img src="img/ic01.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="自訂欄位功能附加"><img src="img/ic07.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="內部模組/外網連結"><img src="img/ic08.png" width="20" height="20"/></a></div>
           <div class="mod_pic"><a href="http://www.shop3500.com/frilink.php?wshop=playweb" data-original-title="此模組會顯示於左邊欄位中，若功能開啟後，您可以不加入此模組至選單中而同樣會有效果顯示。" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionFrilinkSelect == '1') {?><img src="images/mt_006.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /></a>
           <?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/frilink.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top" class="tip_img_frilink"><i class="fa fa-eye"></i> Demo</a></div></div>
         
		 <?php		
					break;	
				case "Otrlink":  // -------------------------------------------------
		 ?>
         
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可自訂分類"><img src="img/ic01.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a></div>
           <div class="mod_pic"><a href="http://www.shop3500.com/otrlink.php?wshop=playweb" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionOtrlinkSelect == '1') {?><img src="images/mt_051.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /></a>
           <?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/otrlink.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
         
		 <?php		
					break;	
				case "Sponsor":  // -------------------------------------------------
		 ?>
         
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可自訂分類"><img src="img/ic01.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="首頁版型整合"><img src="img/ic10.png" width="20" height="20"/></a></div>
           <div class="mod_pic"><a href="http://www.shop3500.com/sponsor.php?wshop=playweb" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionSponsorSelect == '1') {?><img src="images/mt_011.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /></a>
           <?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/sponsor.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
         
		 <?php		
					break;	
				case "Publish":  // -------------------------------------------------
		 ?>
         
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可自訂分類"><img src="img/ic01.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="WYSIWYG 網頁線上編輯器"><img src="img/ic03.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="跑馬燈"><img src="img/ic09.png" width="20" height="20"/></a></div>
           <div class="mod_pic"><a href="http://www.shop3500.com/publish.php?wshop=playweb" data-original-title="此模組為跑馬燈,會於橫幅之下顯示一動態切換之訊息，您可以不加入此模組至選單中而同樣會有效果顯示。" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionPublishSelect == '1') {?><img src="images/mt_003.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /></a>
           <?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/publish.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top" class="tip_img_publish"><i class="fa fa-eye"></i> Demo</a></div></div>
         
		 <?php		
					break;	
				case "Letters":  // -------------------------------------------------
		 ?>
         
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可自訂分類"><img src="img/ic01.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="WYSIWYG 網頁線上編輯器"><img src="img/ic03.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="首頁版型整合"><img src="img/ic10.png" width="20" height="20"/></a></div>
           <div class="mod_pic"><a href="http://www.shop3500.com/letters.php?wshop=playweb" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionLettersSelect == '1') {?><img src="images/mt_020.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /></a>
           <?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/letters.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
         
		 <?php		
					break;	
				case "Meeting":  // -------------------------------------------------
		 ?>
         
         <!--<div class="mod_board">
           <div class="mod_pic"><a href="http://www.shop3500.com/meeting.php?wshop=playweb" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionMeetingSelect == '1') {?><img src="images/mt_009.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /></a>
           <?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/meeting.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>-->
         
		 <?php		
					break;	
				case "Donation":  // -------------------------------------------------
		 ?>
         
         <!--<div class="mod_board">
           <div class="mod_pic"><a href="http://www.shop3500.com/donation.php?wshop=playweb" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionDonationSelect == '1') {?><img src="images/mt_015.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /></a>
           <?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/donation.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>-->
         
		 <?php		
					break;	
				case "Org":  // -------------------------------------------------
		 ?>
         
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可自訂分類"><img src="img/ic01.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="WYSIWYG 網頁線上編輯器"><img src="img/ic03.png" width="20" height="20"/></a></div>
           <div class="mod_pic"><a href="http://www.shop3500.com/org.php?wshop=playweb" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionOrgSelect == '1') {?><img src="images/mt_017.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /></a>
           <?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/org.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
         
		 <?php		
					break;	
				case "Member":  // -------------------------------------------------
		 ?>
         
         <div class="mod_board"><div class="mod_tip"><img src="img/ic00.png" width="20" height="20"/></div>
           <div class="mod_pic"><a href="http://www.shop3500.com/member.php?wshop=playweb" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionMemberSelect == '1') {?><img src="images/mt_013.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /></a>
           <?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/member.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
         
		 <?php		
					break;
				case "Careers":  // -------------------------------------------------
		 ?>
         
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可自訂分類"><img src="img/ic01.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="WYSIWYG 網頁線上編輯器"><img src="img/ic03.png" width="20" height="20"/></a></div>
           <div class="mod_pic"><a href="http://www.shop3500.com/careers.php?wshop=playweb" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionCareersSelect == '1') {?><img src="images/mt_016.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /></a>
           <?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/careers.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
         
		 <?php		
					break;	
				case "Actnews":  // -------------------------------------------------
		 ?>
         
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可自訂分類"><img src="img/ic01.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="WYSIWYG 網頁線上編輯器"><img src="img/ic03.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="首頁版型整合"><img src="img/ic10.png" width="20" height="20"/></a></div>
           <div class="mod_pic"><a href="http://www.shop3500.com/actnews.php?wshop=playweb" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionActnewsSelect == '1') {?><img src="images/mt_021.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /></a>
           <?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/actnews.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
         
		 <?php		
					break;	
				case "Faq":  // -------------------------------------------------
		 ?>
         
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可自訂分類"><img src="img/ic01.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="WYSIWYG 網頁線上編輯器"><img src="img/ic03.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="JQUERY特效"><img src="img/ic14.png" width="20" height="20"/></a></div>
           <div class="mod_pic"><a href="http://www.shop3500.com/faq.php?wshop=playweb" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionFaqSelect == '1') {?><img src="images/mt_024.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /></a>
           <?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/faq.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
         
		 <?php		
					break;	
				case "Catalog":  // -------------------------------------------------
		 ?>
         
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可自訂分類"><img src="img/ic01.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="檔案格式自動判斷"><img src="img/ic15.png" width="20" height="20"/></a></div>
           <div class="mod_pic"><a href="http://www.shop3500.com/catalog.php?wshop=playweb" data-original-title="此模組您可新增檔案以供瀏覽者下載。" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionCatalogSelect == '1') {?><img src="images/mt_033.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /></a>
           <?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/catalog.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
         
		 <?php		
					break;	
				case "Forum":  // -------------------------------------------------
		 ?>
         
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可自訂分類"><img src="img/ic01.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="WYSIWYG 網頁線上編輯器"><img src="img/ic03.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="會員中心整合"><img src="img/ic16.png" width="20" height="20"/></a></div><div class="mod_pic"><a href="http://www.shop3500.com/forum.php?wshop=playweb" data-original-title="此模組須配合會員來做搭配，使用者在回覆資料時需登入會員。" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionForumSelect == '1') {?><img src="images/mt_029.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /><?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/forum.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
         
		 <?php		
					break;	
				case "Contact":  // -------------------------------------------------
		 ?>
        
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可自訂分類"><img src="img/ic01.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="WYSIWYG 網頁線上編輯器"><img src="img/ic03.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="表單寄信程式"><img src="img/ic17.png" width="20" height="20"/></a></div><div class="mod_pic"><a href="http://www.shop3500.com/contact.php?wshop=playweb" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"> <?php if ($OptionContactSelect == '1') {?><img src="images/mt_040.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /><?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/contact.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
             
         <?php		
					break;	
				case "Stronghold":  // -------------------------------------------------
		 ?>
        
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可自訂分類"><img src="img/ic01.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="GoogleMap支援"><img src="img/ic24.png" width="20" height="20"/></a></div><div class="mod_pic"><a href="http://www.shop3500.com/stronghold.php?wshop=playweb" data-original-title="此模組允許您新增各地標的基本資訊，並且會產生多個地標在GoogleMap上，您可點選基本資訊的圖標會及時切換至您要的地點。" target="_blank" data-toggle="tooltip" data-placement="right"> <?php if ($OptionStrongholdSelect == '1') {?><img src="images/mt_059.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /><?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/stronghold.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
         
		 <?php		
					break;	
				case "Blog":  // -------------------------------------------------
		 ?>
         
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可自訂分類"><img src="img/ic01.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="三層分類"><img src="img/ic04.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="WYSIWYG 網頁線上編輯器"><img src="img/ic03.png" width="20" height="20"/></a></div><div class="mod_pic"><a href="http://www.shop3500.com/blog.php?wshop=playweb?Opt=viewpage&tp=Blog" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionBlogSelect == '1') {?><img src="images/mt_047.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /><?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/blog.php?wshop=playweb?Opt=viewpage&tp=Blog" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
         
		 <?php		
					break;	
				case "Album":  // -------------------------------------------------
		 ?>
         
         <!--<div class="mod_board"><div class="mod_pic"><a href="http://www.shop3500.com/album.php?wshop=playweb" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionAlbumSelect == '1') {?><img src="images/mt_012.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /><?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/album.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>-->
         
		 <?php		
					break;	
				case "MailSend":  // -------------------------------------------------
		 ?>
         
         <!--<div class="mod_board"><div class="mod_pic"><a href="http://www.shop3500.com/mailsend.php?wshop=playweb" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionMailSendSelect == '1') {?><img src="images/mt_005.png" width="60" height="60" /><?php } else { ?><img src="images/n_mod/mt_005.png" width="60" height="60" /><?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/mailsend.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>-->
         
		 <?php		
					break;
				case "Knowledge":  // -------------------------------------------------
		 ?>
         
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可自訂分類"><img src="img/ic01.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="WYSIWYG 網頁線上編輯器"><img src="img/ic03.png" width="20" height="20"/></a></div><div class="mod_pic"><a href="http://www.shop3500.com/knowledge.php?wshop=playweb" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionKnowledgeSelect == '1') {?><img src="images/mt_031.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /><?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/knowledge.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
         
		 <?php		
					break;	
				case "EPaper":  // -------------------------------------------------
		 ?>
         
         <!--<div class="mod_board"><div class="mod_pic"><a href="http://www.shop3500.com/epaper.php?wshop=playweb" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionEPaperSelect == '1') {?><img src="images/mt_022.png" width="60" height="60" /><?php } else { ?><img src="images/n_mod/mt_022.png" width="60" height="60" /><?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/epaper.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>-->
         
		 <?php		
					break;	
				case "Partner":  // -------------------------------------------------
		 ?>
         
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可自訂分類"><img src="img/ic01.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="首頁版型整合"><img src="img/ic10.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="可更換外框樣式"><img src="img/ic12.png" width="20" height="20"/></a></div><div class="mod_pic"><a href="http://www.shop3500.com/partner.php?wshop=playweb" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionPartnerSelect == '1') {?><img src="images/mt_026.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /><?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/partner.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
         
		 <?php		
					break;
				case "AD":  // -------------------------------------------------
		 ?>
         
         <!--<div class="mod_board"><div class="mod_pic"><a href="http://www.shop3500.com/ad.php?wshop=playweb" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"><?php if (@$OptionADSelect == '1') {?><img src="images/mt_025.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /><?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/ad.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>-->
         
		 <?php		
					break;	
				case "Video":  // -------------------------------------------------
		 ?>
         
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可自訂分類"><img src="img/ic01.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="首頁版型整合"><img src="img/ic10.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="多空間連結支持"><img src="img/ic13.png" width="20" height="20"/></a></div><div class="mod_pic"><a href="http://www.shop3500.com/video.php?wshop=playweb" data-original-title="此模組您必須在所支援之影片空間上傳，而後只需貼上Url網址就可直接讀取影片，使用YouTube上傳則可以自動取得影片縮圖，建議使用。" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionVideoSelect == '1') {?><img src="images/mt_010.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /><?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/video.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
             
          <?php		
					break;	
				case "Cart":  // -------------------------------------------------
		 ?>
         
         <div class="mod_board"><div class="mod_tip"><img src="img/ic00.png" width="20" height="20"/></div>
           <div class="mod_pic"><a href="http://www.shop3500.com/cart.php?wshop=playweb" data-original-title="此模組會替產品模組加上購物車功能，您可以在其查看客戶訂單/填寫運費資訊。" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionCartSelect == '1') {?><img src="images/mt_036.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /><?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/cart.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
         
		 <?php		
					break;	
				case "Artlist":  // -------------------------------------------------
		 ?>
         
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可自訂分類"><img src="img/ic01.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="WYSIWYG 網頁線上編輯器"><img src="img/ic03.png" width="20" height="20"/></a></div><div class="mod_pic"><a href="http://www.shop3500.com/artlist.php?wshop=playweb" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionArtlistSelect == '1') {?><img src="images/mt_027.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /><?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/artlist.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
         
		 <?php		
					break;	
				case "DfPage":  // -------------------------------------------------
		 ?>
        
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="WYSIWYG 網頁線上編輯器"><img src="img/ic03.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="自由頁面資料新增"><img src="img/ic18.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="自設模組選單"><img src="img/ic19.png" width="20" height="20"/></a></div><div class="mod_pic"><a href="http://www.shop3500.com/" data-original-title="此模組允許您替整頁內容做編輯，你可在《自訂頁面》模組的《頁面內容》去編輯您的頁面，並且可排列您的選單順序，此外您可指定各選單項目是連結至哪個模組或是使用預設值，編輯一整個頁面內容，透過此功能您可快速地建立您整個選單的架構和編輯頁面的內容資訊。" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionDfPageSelect == '1') {?><img src="images/mt_043.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /><?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a class="youtube" href="http://www.youtube.com/embed/BO298LPzqyU" data-toggle="tooltip" data-placement="top" data-original-title="點選觀看影片示範"><i class="fa fa-film"></i> Video</a></div></div>
             
         <?php		
					break;	
				case "TmpStyle":  // -------------------------------------------------
		 ?>
         <div class="mod_board"><div class="mod_tip"><a href="#" data-original-title="自行設計版面" data-toggle="tooltip"><img src="img/ic25.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="內建版型更換"><img src="img/ic26.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="此模組包含自訂欄位模組"><img src="img/ic27.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="Logo更換"><img src="img/ic28.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="Banner更換"><img src="img/ic29.png" width="20" height="20"/></a></div>
           <div class="mod_pic"><a href="#" data-original-title="此模組為自訂/選擇版型之模組，您可隨時切換內建的版面外觀，另外更可透過內建的版面修改功能來自訂/選擇網頁各個區塊的樣式，除內建樣式外也可以自行設計，外觀變化等同無限，隨時隨地都是一個新網站。" data-toggle="tooltip" data-placement="right"><?php if ($OptionTmpSelect == '1') {?><img src="images/mt_045.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /><?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a class="tip_img_tmp youtube" href="http://www.youtube.com/embed/-BcAHcWr-j0" data-toggle="tooltip" data-placement="top" data-original-title="點選觀看影片示範"><i class="fa fa-film"></i> Video</a></div></div>
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可加入選單模組"><img src="img/ic30.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="可自行加入HTML語法"><img src="img/ic32.png" width="20" height="20"/></a></div>
           <div class="mod_pic"><a href="#" data-original-title="此模組可更加豐富您的左邊的欄位區塊，例如選擇是否要加入左選單、連結等等...亦或是透過編輯空白的欄位區塊加上YouTube、時鐘、年曆、廣告，類似於部落格新增欄位的功能，網路上更有許多寫好的程式碼可供使用，可搜索《部落格小玩意》。" data-toggle="tooltip" data-placement="right"><?php if ($OptionTmpSelect == '1') {?><img src="images/mt_049.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /><?php } ?></a></div><div class="mod_text">
             <a>自訂欄位</a></div><div class = "InnerPage"><a class="tip_img_column youtube" href="http://www.youtube.com/embed/keuVRTQMzOQ" data-toggle="tooltip" data-placement="top" data-original-title="點選觀看影片示範"><i class="fa fa-film"></i> Video</a></div></div>
             <?php		
					break;	
				case "Room":  // -------------------------------------------------
		 ?>
        
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="WYSIWYG 網頁線上編輯器"><img src="img/ic03.png" width="20" height="20"/></a></div><div class="mod_pic"><a href="http://www.shop3500.com/" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionRoomSelect == '1') {?><img src="images/mt_067.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /><?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/room.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
             
             <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="WYSIWYG 網頁線上編輯器"><img src="img/ic03.png" width="20" height="20"/></a></div><div class="mod_pic"><a href="http://www.shop3500.com/" data-original-title="此模組為訂房展示之擴充功能，可讓使用者訂購房型並產生訂單資訊。" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionRoomSelect == '1') {?><img src="images/mt_075.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /><?php } ?></a></div><div class="mod_text">
             <a>訂房系統</a></div><div class = "InnerPage"><a href="http://www.shop3500.com/room.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>
             
             <?php		
					break;	
				case "Attractions":  // -------------------------------------------------
		 ?>
        
         <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="資料新增無限制"><img src="img/ic02.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="WYSIWYG 網頁線上編輯器"><img src="img/ic03.png" width="20" height="20"/></a></div><div class="mod_pic"><a href="http://www.shop3500.com/" data-original-title="" target="_blank" data-toggle="tooltip" data-placement="right"><?php if ($OptionAttractionsSelect == '1') {?><img src="images/mt_068.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /><?php } ?></a></div><div class="mod_text">
             <a><?php echo $row_RecordModList['customname']; ?></a></div><div class = "InnerPage"><a href="http://www.shop3500.com/attractions.php?wshop=playweb" data-original-title="點選可觀看模組範例" target="_blank" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> Demo</a></div></div>

		 <?php	
		 			break;		
				default:
					break;
			}
			//echo $row_RecordModList['itemvalue'];
		?> 
           <?php } while ($row_RecordModList = mysqli_fetch_assoc($RecordModList)); ?>
           
           <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可放入現有模組"><img src="img/ic31.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="可自行加入HTML語法"><img src="img/ic32.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="自行設計版面"><img src="img/ic25.png" width="20" height="20"/></a><a href="#" data-toggle="tooltip" data-original-title="內建版型更換"><img src="img/ic26.png" width="20" height="20"/></a></div><div class="mod_pic"><a href="#" data-original-title="此模組可在《版型修改》中新增一個《首頁版型設計》的功能，在檢視畫面也會將《版型修改》取代成目前圖示，您可選擇多種的風格來做搭配，某些模組還可選擇您要放置的功能，更有空白的版面讓您自由發揮，讓您網站更為亮眼。" data-toggle="tooltip" data-placement="right"><?php if ($OptionTmpHomeSelect == '1') {?><img src="images/mt_061.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /><?php } ?></a></div><div class="mod_text">
             <a>首頁版型</a></div><div class = "InnerPage"><a class="youtube" href="http://www.youtube.com/embed/-BcAHcWr-j0" data-toggle="tooltip" data-placement="top" data-original-title="點選觀看影片示範"><i class="fa fa-film"></i> Video</a></div></div>
             
             <div class="mod_board"><div class="mod_tip"><a href="#" data-toggle="tooltip" data-original-title="可放入現有模組"></a></div><div class="mod_pic"><a href="#" data-original-title="手機、平板、電腦 一次到位跨螢幕、裝置多元化支援 掌握行動趨勢等於掌握您的商機。" data-toggle="tooltip" data-placement="right"><?php if ($OptionMobileSelect == '1') {?><img src="images/mt_071.png" width="60" height="60" /><?php } else { ?><img src="images/lock.png" alt="" width="60" height="60" /><?php } ?></a></div><div class="mod_text">
             <a>行動裝置</a></div>
             <div class = "InnerPage"><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="" class="tip_img_mobile">QRCode</a></div></div>
      </div>
  
        
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordModList);
?>
