<?php 
/* 取得類別列表 */
$colname_RecordCommodityListType_Code = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordCommodityListType_Code = $_GET['lang'];
}
$coluserid_RecordCommodityListType_Code = "-1";
if (isset($w_userid)) {
  $coluserid_RecordCommodityListType_Code = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordCommodityListType_Code = sprintf("SELECT * FROM invoicing_commodityitem WHERE list_id = 1 && lang=%s && level='0' && userid=%s ORDER BY sortid ASC, item_id DESC", GetSQLValueString($colname_RecordCommodityListType_Code, "text"),GetSQLValueString($coluserid_RecordCommodityListType_Code, "int"));
$RecordCommodityListType_Code = mysqli_query($DB_Conn, $query_RecordCommodityListType_Code) or die(mysqli_error($DB_Conn));
$row_RecordCommodityListType_Code = mysqli_fetch_assoc($RecordCommodityListType_Code);
$totalRows_RecordCommodityListType_Code = mysqli_num_rows($RecordCommodityListType_Code);

$coluserid_RecordSupplier_Code = "-1";
if (isset($w_userid)) {
  $coluserid_RecordSupplier_Code = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordSupplier_Code = sprintf("SELECT * FROM invoicing_supplier WHERE userid=%s ORDER BY code",GetSQLValueString($coluserid_RecordSupplier_Code, "int"));
$RecordSupplier_Code = mysqli_query($DB_Conn, $query_RecordSupplier_Code) or die(mysqli_error($DB_Conn));
$row_RecordSupplier_Code = mysqli_fetch_assoc($RecordSupplier_Code);
$totalRows_RecordSupplier_Code = mysqli_num_rows($RecordSupplier_Code);

?>
<style>
.modal-header {
  cursor: move; 
}
</style>
<a href="#Ajax_codegenerate" class="btn btn-primary btn-block" data-toggle="modal">取得編號</a>
<div class="modal fade" id="Ajax_codegenerate">
    <div class="modal-dialog" style="max-width:60%; top:25%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">取得編號</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                
				<!--<div class="input-group p-0">
                            <div class="input-group-prepend"><span class="input-group-text">品名</span></div>
                            <input name="itemname[]" type="text" id="itemname[]" value="D-13 廢金屬" class="form-control parsley-success" data-parsley-trigger="blur" required="" data-parsley-id="5">
                                      
                      </div>-->
				
				<div class="card bg-aqua-transparent-1">
                <div class="card-block">
				<div class="row">
							
							<div class="col-md-4">
								  <div class="input-group p-0">	
									<div class="input-group-prepend"><span class="input-group-text">是否使用「-」分隔</span></div>	
										<select name="separator_codegeneral" id="separator_codegeneral" class="form-control" data-parsley-trigger="blur" >
										  <option value="1" selected="selected">是</option>
										  <option value="0">否</option>
										</select>
									  </div>


							</div>
							  
      			</div>
				</div>
				</div>		  
				
				<div class="card bg-aqua-transparent-1">
                <div class="card-block">
				<div class="row">
						  <div class="col-md-12">

 									<div class="input-group p-0">	
									<div class="input-group-prepend"><span class="input-group-text">分類</span></div>	
									<select name="type1_codegeneral" id="type1_codegeneral" class="form-control col-md-4" style="display:inline-block" data-parsley-trigger="blur">
									  <option value="">-- 選擇分類 --</option>
									  <?php
										do {  
										?>
									  <option value="<?php echo $row_RecordCommodityListType['item_id']?>"><?php echo $row_RecordCommodityListType['itemname']?></option>
															  <?php
										} while ($row_RecordCommodityListType = mysqli_fetch_assoc($RecordCommodityListType));
										  $rows = mysqli_num_rows($RecordCommodityListType);
										  if($rows > 0) {
											  mysqli_data_seek($RecordCommodityListType, 0);
											  $row_RecordCommodityListType = mysqli_fetch_assoc($RecordCommodityListType);
										  }
										?>
                                    </select>
									

                                    <select name="type2_codegeneral" id="type2_codegeneral" class="form-control col-md-4" style="display:inline-block">
                                      <option value="-1">-- 選擇分類2 --</option>
                                    </select>


                                    <select name="type3_codegeneral" id="type3_codegeneral" class="form-control col-md-4" style="display:inline-block">
                                      <option value="-1">-- 選擇分類3 --</option>
                                    </select>
									</div>



						</div>

      			</div>
				</div>
				</div>
				
				<div class="card bg-aqua-transparent-1">
                <div class="card-block">
				<div class="row">
							  <div class="col-md-4">
								  <div class="input-group p-0">	
									<div class="input-group-prepend"><span class="input-group-text">供應廠商</span></div>	
										<select name="supplier_codegeneral" id="supplier_codegeneral" class="form-control" data-parsley-trigger="blur" >
										  <option value="">-- 選擇供應廠商 --</option>
										  <?php
											do {  
											?>
																  <option value="<?php echo $row_RecordSupplier_Code['id']?>"><?php echo $row_RecordSupplier_Code['code']?> <?php echo $row_RecordSupplier_Code['name']?></option>
																  <?php
											} while ($row_RecordSupplier_Code = mysqli_fetch_assoc($RecordSupplier_Code));
											  $rows = mysqli_num_rows($RecordSupplier_Code);
											  if($rows > 0) {
												  mysqli_data_seek($RecordSupplier_Code, 0);
												  $row_RecordSupplier_Code = mysqli_fetch_assoc($RecordSupplier_Code);
											  }
											?>
										</select>
									  </div>


							</div>
					
					
							  <div class="col-md-2">
							  <div class="form-group row">
								  <!--<div class="col-md-6" style="border:0">-->
									  <div class="input-group p-0">
											<div class="input-group-prepend"><span class="input-group-text">排序</span></div>
											<input name="supplier_sortid" type="number" id="supplier_sortid" value="50" class=" form-control" maxlength="10" data-parsley-trigger="blur" required=""/>

									  </div>

								  <!--</div>-->
							  </div>
							  </div>
      				</div>
				</div>
				</div>
				
				
				
				
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-success btn-block" onClick="Ajax_codegenerate()">取得</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
// 下拉連動選單設定
$(function () {

    // 判斷是否有預設值
    var defaultValue = false;
    /*if (0 < $.trim($('#fullIdPath').val()).length) {
        $fullIdPath = $('#fullIdPath').val().split(',');
        defaultValue = true;
    }*/
    
    // 設定預設選項
    /*if (defaultValue) {
        $('#type1_codegeneral').selectOptions($fullIdPath[0]); 
    }*/
    
	//$("#type2_codegeneral").hide(); //開始執行時先將第二層的選單藏起來
	//$("#type3_codegeneral").hide(); //開始執行時先將第二層的選單藏起來
    // 開始產生關聯下拉式選單
    $('#type1_codegeneral').change(function () {
        // 觸發第二階下拉式選單
		//$("選單ID").addOption("選單內容物件",false);
		//$("選單ID").removeOption("選單索引/值/陣列");若是要刪掉全部則框號內置入/./
        $('#type2_codegeneral').removeOption(/.?/).ajaxAddOption(
            'selectbox_action/commodity_add.php?&<?php echo time();?>', 
            { 'id': $(this).val(), 'lv': 1 }, 
            false, // true/false 的功能在於是否要瀏覽器記住次選單的選項
            function () {
                
                // 設定預設選項
                if (defaultValue) {
                    $(this).selectOptions($fullIdPath[1]).trigger('change');
                } else {
                    $(this).selectOptions().trigger('change');
                }
				// 設定欄位隱藏/開啟
				if( $('#type1_codegeneral option:selected').val() != '' && $('#type2_codegeneral option:selected').val() != '')
				// 值=val() // 標籤=text
				{
					$("#type2_codegeneral").show(); // 
				}else{
					$("#type2_codegeneral").hide(); //
				}
            }
        ).change(function () {
            // 觸發第三階下拉式選單
            $('#type3_codegeneral').removeOption(/.?/).ajaxAddOption(
                'selectbox_action/commodity_add.php?<?php echo time();?>', 
                { 'id': $(this).val(), 'lv': 2 }, 
                false, 
                function () {
                
                    // 設定預設選項
                    if (defaultValue) {
                        $(this).selectOptions($fullIdPath[2]);
                    }
					// 設定欄位隱藏/開啟
					if( $('#type2_codegeneral option:selected').val() != '' && $('#type3_codegeneral option:selected').val() != '')
					// 值=val() // 標籤=text
					{
						$("#type3_codegeneral").show(); // 
					}else{
						$("#type3_codegeneral").hide(); //
					}
					}
            );
        });
    }).trigger('change');

    // 全部選擇完畢後，顯示所選擇的選項
    /*$('#select3').change(function () {
        alert('主機：' + $('#select1 option:selected').text() + 
              '／類型：' + $('#select2 option:selected').text() +
              '／遊戲：' + $('#select3 option:selected').text());
    });*/
});
</script>

<script type="text/javascript">
	
	$("#Ajax_codegenerate").draggable({
		  handle: ".modal-header"
	  });
	
	function Ajax_codegenerate()
	{
		//$('#code').val() = $('#type1').val();
		$.ajax({
                  type :"GET",
                  url  : "ajax/clientele_code.php",
                  data : { 
                      type1 : $("#type1_codegeneral").val(),
					  type2 : $("#type2_codegeneral").val(),
					  type3 : $("#type3_codegeneral").val(),
					  unit : $("#unit_codegeneral").val(),
					  sourcegenre : $("#sourcegenre_codegeneral").val(),
					  genre : $("#genre_codegeneral").val(),
					  supplier : $("#supplier_codegeneral").val(),
					  supplier_sortid : $("#supplier_sortid").val(),
					  separator : $("#separator_codegeneral").val(),
                      },
                  dataType: "text",
                  success : function(msg) { 
					  //alert(msg);
					  $("#code").val(msg);
              }
        })
	}
</script>