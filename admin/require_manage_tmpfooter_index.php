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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Setting")) {
  $updateSQL = sprintf("UPDATE demo_setting_otr SET tmpfootercontext=%s, tmpfootercontext_cn=%s, tmpfootercontext_en=%s, tmpfootercontext_jp=%s, tmpfootercontext_kr=%s, tmpfootercontext_sp=%s WHERE id=%s",
                       GetSQLValueString($_POST['tmpfootercontext'], "text"),
                       GetSQLValueString($_POST['tmpfootercontext_cn'], "text"),
					   GetSQLValueString($_POST['tmpfootercontext_en'], "text"),
                       GetSQLValueString($_POST['tmpfootercontext_jp'], "text"),
					   GetSQLValueString($_POST['tmpfootercontext_kr'], "text"),
					   GetSQLValueString($_POST['tmpfootercontext_sp'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
}

$coluserid_RecordSettingOtr = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSettingOtr = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSettingOtr = sprintf("SELECT * FROM demo_setting_otr WHERE userid=%s", GetSQLValueString($coluserid_RecordSettingOtr, "int"));
$RecordSettingOtr = mysqli_query($DB_Conn, $query_RecordSettingOtr) or die(mysqli_error($DB_Conn));
$row_RecordSettingOtr = mysqli_fetch_assoc($RecordSettingOtr);
$totalRows_RecordSettingOtr = mysqli_num_rows($RecordSettingOtr);
?>
<!-- fck編輯器 -->
<?php if ($_SESSION['MM_UserGroup'] == 'superadmin') { ?>
	<?php $CKEtoolbar = 'Advanced' ?>
<?php } else { ?>
	<?php $CKEtoolbar = 'Full' ?>
<?php } ?>

<?php //if ($ManageNewsEditorSelect == '1' || $ManageNewsEditorSelect == '2') { ?>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
	CKEDITOR.env.isCompatible = true;
	<?php if ($LangChooseZHTW == 1 || $defaultlang == 'zh-tw') { ?>
	CKEDITOR.replace( 'tmpfootercontext',{width : '99%', toolbar : '<?php echo $CKEtoolbar; ?>'} );
	<?php } ?>
    <?php if ($LangChooseZHCN == 1 || $defaultlang == 'zh-cn') { ?>
	CKEDITOR.replace( 'tmpfootercontext_cn',{width : '99%', toolbar : '<?php echo $CKEtoolbar; ?>'} );
	<?php } ?>
    <?php if ($LangChooseEN == 1 || $defaultlang == 'en') { ?>
	CKEDITOR.replace( 'tmpfootercontext_en',{width : '99%', toolbar : '<?php echo $CKEtoolbar; ?>'} );
	<?php } ?>
    <?php if ($LangChooseJP == 1  || $defaultlang == 'jp') { ?>
	CKEDITOR.replace( 'tmpfootercontext_jp',{width : '99%', toolbar : '<?php echo $CKEtoolbar; ?>'} );
	<?php } ?>
    <?php if ($LangChooseKR == 1  || $defaultlang == 'kr') { ?>
	CKEDITOR.replace( 'tmpfootercontext_kr',{width : '99%', toolbar : '<?php echo $CKEtoolbar; ?>'} );
	<?php } ?>
    <?php if ($LangChooseSP == 1  || $defaultlang == 'sp') { ?>
	CKEDITOR.replace( 'tmpfootercontext_sp',{width : '99%', toolbar : '<?php echo $CKEtoolbar; ?>'} );
	<?php } ?>
};
</script>
<?php //} ?>


<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 頁尾資訊 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="tmp_config_md_footer.php?lang=<?php echo $_SESSION['lang']; ?>&amp;id_edit=<?php echo $_GET['id_edit']; ?>" data-original-title="" data-toggle="tooltip" data-placement="top" class="btn btn-default btn-sm"><i class="fa fa-reply fa-fw"></i> 上一頁</a></div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 修改資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post" >
  
      <?php if ($LangChooseZHTW == 1 || $defaultlang == 'zh-tw') { ?>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁尾內容【繁體】 <i class="fa fa-info-circle text-orange" data-original-title="註:Shift+Enter為不空行分段/Enter為空行分段。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="table-responsive">
                <textarea name="tmpfootercontext" id="tmpfootercontext" cols="100%" rows="35" class="form-control"><?php echo $row_RecordSettingOtr['tmpfootercontext']; ?></textarea>  
          </div>
          </div>
      </div>
      <?php } ?>
      
      <?php if ($LangChooseZHCN == 1 || $defaultlang == 'zh-cn') { ?>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁尾內容【简体】 <i class="fa fa-info-circle text-orange" data-original-title="註:Shift+Enter為不空行分段/Enter為空行分段。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="table-responsive">
                <textarea name="tmpfootercontext_cn" id="tmpfootercontext_cn" cols="100%" rows="35" class="form-control"><?php echo $row_RecordSettingOtr['tmpfootercontext_cn']; ?></textarea>  
          </div>
          </div>
      </div>
      <?php } ?>
      
      <?php if ($LangChooseEN == 1 || $defaultlang == 'en') { ?>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁尾內容【English】 <i class="fa fa-info-circle text-orange" data-original-title="註:Shift+Enter為不空行分段/Enter為空行分段。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="table-responsive">
                <textarea name="tmpfootercontext_en" id="tmpfootercontext_en" cols="100%" rows="35" class="form-control"><?php echo $row_RecordSettingOtr['tmpfootercontext_en']; ?></textarea>  
          </div>
          </div>
      </div>
      <?php } ?>
      
      <?php if ($LangChooseJP == 1 || $defaultlang == 'jp') { ?>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁尾內容【日本语】 <i class="fa fa-info-circle text-orange" data-original-title="註:Shift+Enter為不空行分段/Enter為空行分段。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="table-responsive">
                <textarea name="tmpfootercontext_jp" id="tmpfootercontext_jp" cols="100%" rows="35" class="form-control"><?php echo $row_RecordSettingOtr['tmpfootercontext_jp']; ?></textarea>  
          </div>
          </div>
      </div>
      <?php } ?>
      
      <?php if ($LangChooseKR == 1 || $defaultlang == 'kr') { ?>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁尾內容【한국어】 <i class="fa fa-info-circle text-orange" data-original-title="註:Shift+Enter為不空行分段/Enter為空行分段。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="table-responsive">
                <textarea name="tmpfootercontext_kr" id="tmpfootercontext_kr" cols="100%" rows="35" class="form-control"><?php echo $row_RecordSettingOtr['tmpfootercontext_kr']; ?></textarea>  
          </div>
          </div>
      </div>
      <?php } ?>
      
      <?php if ($LangChooseSP == 1 || $defaultlang == 'sp') { ?>
      <div class="form-group row">
          <label class="col-md-2 col-form-label">頁尾內容【Español】 <i class="fa fa-info-circle text-orange" data-original-title="註:Shift+Enter為不空行分段/Enter為空行分段。" data-toggle="tooltip" data-placement="top"></i></label>
          <div class="col-md-10">
          <div class="table-responsive">
                <textarea name="tmpfootercontext_sp" id="tmpfootercontext_sp" cols="100%" rows="35" class="form-control"><?php echo $row_RecordSettingOtr['tmpfootercontext_sp']; ?></textarea>  
          </div>
          </div>
      </div>
      <?php } ?>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label"></label>
          <div class="col-md-10">
            <button type="submit" class="btn btn btn-primary btn-block">送出</button>
            <input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordSettingOtr['id']; ?>" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Setting" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->

<?php
mysqli_free_result($RecordSettingOtr);
?>
