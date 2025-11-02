<?php 
$colname_RecordAccounts_summonsListTypeModel = "zh-tw";
if (isset($_GET['lang'])) {
  $colname_RecordAccounts_summonsListTypeModel = $_GET['lang'];
}
$coluserid_RecordAccounts_summonsListTypeModel = "-1";
if (isset($w_userid)) {
  $coluserid_RecordAccounts_summonsListTypeModel = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAccounts_summonsListTypeModel = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE list_id = 1 && lang=%s && level = 0 && userid=%s ORDER BY sortid ASC", GetSQLValueString($colname_RecordAccounts_summonsListTypeModel, "text"),GetSQLValueString($coluserid_RecordAccounts_summonsListTypeModel, "int"));
$RecordAccounts_summonsListTypeModel = mysqli_query($DB_Conn, $query_RecordAccounts_summonsListTypeModel) or die(mysqli_error($DB_Conn));
$row_RecordAccounts_summonsListTypeModel = mysqli_fetch_assoc($RecordAccounts_summonsListTypeModel);
$totalRows_RecordAccounts_summonsListTypeModel = mysqli_num_rows($RecordAccounts_summonsListTypeModel);


$colname_RecordAccounts_summonsListChild = "zh-tw";
if (isset($_GET['lang'])) {
$colname_RecordAccounts_summonsListChild = $_GET['lang'];
}
$coluserid_RecordAccounts_summonsListChild = "-1";
if (isset($w_userid)) {
$coluserid_RecordAccounts_summonsListChild = $w_userid;
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordAccounts_summonsListChild = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE list_id = 1 && lang=%s && level = 0 && userid=%s ORDER BY sortid ASC", GetSQLValueString($colname_RecordAccounts_summonsListChild, "text"),GetSQLValueString($coluserid_RecordAccounts_summonsListChild, "int"));
$RecordAccounts_summonsListChild = mysqli_query($DB_Conn, $query_RecordAccounts_summonsListChild) or die(mysqli_error($DB_Conn));
$row_RecordAccounts_summonsListChild = mysqli_fetch_assoc($RecordAccounts_summonsListChild);
$totalRows_RecordAccounts_summonsListChild = mysqli_num_rows($RecordAccounts_summonsListChild);

?>
<style>
.modal-header {
  cursor: move; 
}
</style>

<!--<a href="#Ajax_detail_type" class="btn btn-primary btn-block" data-toggle="modal">取得編號</a>-->
<div class="modal fade" id="Ajax_detail_type">
    <div class="modal-dialog" style="max-width:50%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
					<ul class="nav nav-pills mb-2">
                        <?php $i=0; ?>
						<?php do { ?>
						<li class="nav-item">
							<a href="#nav-pills-tab-<?php echo $i; ?>" data-toggle="tab" class="nav-link <?php if($i==0) { ?>active<?php } ?>">
								<span class="d-sm-none"><?php echo $row_RecordAccounts_summonsListTypeModel['itemname']?></span>
								<span class="d-sm-block d-none"><?php echo $row_RecordAccounts_summonsListTypeModel['itemname']?></span>
							</a>
						</li>
                        <?php $i++; ?>
                        <?php } while ($row_RecordAccounts_summonsListTypeModel = mysqli_fetch_assoc($RecordAccounts_summonsListTypeModel)); ?>
					</ul>
				</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" data-scrollbar="true" data-height="700">
                    
				   
                    <div class="tab-content p-0 rounded bg-white mb-4">
						<!-- begin tab-pane -->
						<?php $i=0; ?>
				        <?php do { ?>
						<div class="tab-pane fade <?php if($i==0) { ?>active show<?php } ?>" id="nav-pills-tab-<?php echo $i; ?>">
							<table id="data-table-model" class="table table-striped table-bordered table-hover table-condensed data-table-model">
							  <thead>
								<tr>
									<th width="100%">項目</th>
								</tr>
						      </thead>
							  <tbody>
								<?php 
									$colname_RecordAccounts_summonsListJson = "zh-tw";
									if (isset($_GET['lang'])) {
									$colname_RecordAccounts_summonsListJson = $_GET['lang'];
									}
									$coluserid_RecordAccounts_summonsListJson = "-1";
									if (isset($w_userid)) {
									$coluserid_RecordAccounts_summonsListJson = $w_userid;
									}
									//mysqli_select_db($database_DB_Conn, $DB_Conn);
									$query_RecordAccounts_summonsListJson = sprintf("SELECT * FROM invoicing_accounts_summonsitem WHERE list_id = 1 && lang=%s && endnode = 'child' && userid=%s && level >= 2 ORDER BY itemvalue ASC", GetSQLValueString($colname_RecordAccounts_summonsListJson, "text"),GetSQLValueString($coluserid_RecordAccounts_summonsListJson, "int"));
									$RecordAccounts_summonsListJson = mysqli_query($DB_Conn, $query_RecordAccounts_summonsListJson) or die(mysqli_error($DB_Conn));
									$row_RecordAccounts_summonsListJson = mysqli_fetch_assoc($RecordAccounts_summonsListJson);
									$totalRows_RecordAccounts_summonsListJson = mysqli_num_rows($RecordAccounts_summonsListJson);
                                ?>
								<?php do { ?>
								<?php $json_code = json_decode($row_RecordAccounts_summonsListJson['levellistid'], ture); ?>
								<?php if($json_code['0'] == $row_RecordAccounts_summonsListChild['item_id']) { ?>
								<tr>
								  <!-- with checkbox -->
								  <td class="with-checkbox" width="16">
									  
									  <div class="checkbox checkbox-css">
										  <input type="checkbox" id="cssCheckbox<?php echo $json_code['itemvalue']; ?>" class="data-check" value="<?php echo $json_code['itemvalue']; ?>">
										  <label for="cssCheckbox<?php echo $json_code['itemvalue']; ?>"><?php  echo $json_code['itemvalue'] . ' ' . $json_code['itemname']; ?></label>
										</div>
									
								  </td>
								</tr>
								<?php } ?>
								<?php } while ($row_RecordAccounts_summonsListJson = mysqli_fetch_assoc($RecordAccounts_summonsListJson)); ?>
							  </tbody>
							</table>
						</div>
						<?php $i++; ?>
				        <?php } while ($row_RecordAccounts_summonsListChild = mysqli_fetch_assoc($RecordAccounts_summonsListChild)); ?>
						<!-- end tab-pane -->
					</div>
				    
				
            </div>
            <div class="modal-footer">
                <buttom class="btn btn-success btn-block" onClick="ModelSelectItemValue();">取得</buttom>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$('.data-table-model').DataTable({
			"dom": "ft",
			"lengthMenu": [
                [-1],
                ["All"] // change per page values here
            ],
			responsive: true,
		});
});
</script>

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

<script>
	//$.fn.editable.defaults.mode = 'inline';
	function ModelSelectItemValue(){ 
    //$("#data-table-default").find("tr").each(function(){
        console.log('目前總共幾行:'+ $("#data-table-default").DataTable().rows().count());
		console.log('目前總共幾列:'+ $("#data-table-default").DataTable().columns().count());
        
		var i,j;
		var column_data_count_index;
		var row_data_count_use=0; // 判斷目前表格不可填的欄位
		var row_data_count_nouse=0; // 判斷目前表格可填的空欄位
		var row_data_count_add_index = []; // 判斷目前表格新增的index
		var row_data_count = $("#data-table-default").DataTable().rows().count();
		var column_data_count = $("#data-table-default").DataTable().columns().count();
		
		$("#data-table-default").find(".select2").each(function(){
				if ($(this).data('select2')) {
					$(this).select2('destroy');
				}
			});

		var list_id = [];
		$(".data-table-model .data-check:checked").each(function() {
			list_id.push(this.value);
		});
		
		var list_id_count = list_id.length;

		console.log('目前點選的值'+list_id); // 目前點選的值
		console.log('目前新增的數目'+list_id.length); // 目前新增的數目
		
        var row_data = [];
		var row_data_key = ['id','detail_type','debitamount','creditamount','notes1','action'];	
		
		
		//console.log($("#data-table-default").DataTable().column(1).data()[0]); // 目前點選的值
		
		/*$("#data-table-default").DataTable()
		.rows()
		.every( function ( rowIdx, tableLoop, rowLoop ) {
			console.log( 'Data in index: '+rowIdx+' Data in tableLoop:: '+tableLoop +' Data in rowLoop:: '+rowLoop);
		});*/
		
		//$("#data-table-default .clone_group").find('td').each(function(column_data_count_index,element) { // 取得第一筆資料
			
			for(column_data_count_index=0; column_data_count_index<row_data_key.length; column_data_count_index++ ){ // 取得第一筆資料
				//console.log($("#data-table-default").DataTable().cell(0,i).data());
				row_data[row_data_key[column_data_count_index]] = $("#data-table-default").DataTable().cell(0,column_data_count_index).data();
				if(row_data_key[column_data_count_index] == 'action') { 
                	row_data[row_data_key[column_data_count_index]] = "<a href='javascript:;' class='btn btn-danger dictpush-minus btn-block' onclick='delRow(this)'><i class='fa fa-minus'></i></a><input name='detail_id[]' hidden='hidden' id='detail_id[]' class='detail_id' />";
            	}
			}
			/*row_data[row_data_key[column_data_count_index]] = $(this).html();
			if(row_data_key[column_data_count_index] == 'detail_type') { 
                row_data[row_data_key[column_data_count_index]] =  $("#data-table-default").DataTable().cell(0,1).data();
                //row_data[row_data_key[column_data_count_index]] =  row_data[row_data_key[column_data_count_index]].children(".select2 option[value=list_id[i]]").attr('selected', 'selected');
            }*/
            //console.log('欄位值'+column_data_count_index);
            
		//});

		//console.log('新增之後目前總共幾行:'+ $("#data-table-default").DataTable().columns().eq(0).each( function ( index ));
		
		//$("#data-table-default").DataTable().draw();
		
		console.log('新增之後目前總共幾行:'+ $("#data-table-default").DataTable().rows().count());

		var row_data_count_after_add = $("#data-table-default").DataTable().rows().count(); // 新增之後目前總共幾行
		
		$("#data-table-default").DataTable()
		.cells()
		.every( function ( rowIdx, tableLoop, rowLoop ) {
			//console.log( '表格 index: '+rowIdx+' Data in tableLoop:: '+tableLoop +' Data in rowLoop:: '+rowLoop);
			//console.log('目前單元格值='+this.data());
			//console.log(this.node());
			//console.log(this.nodes());
			//console.log('目前的值為'+this.nodes().to$().find('.debitamount').val());
			//this.nodes().to$().find('.debitamount').val(66);
			//console.log(this.cell(rowIdx, tableLoop).data());
			//console.log('目前的值為'+this.node(2).to$().find('.debitamount').val());
			//console.log(this.nodes().data());
			//this.nodes().to$().find('.debitamount').val(66);
			//console.log(this.cell(rowIdx, tableLoop).nodes().to$().find('.select2').val(list_id[list_id_count-1]));
			
			if(tableLoop == 1 && this.cell(rowIdx, tableLoop).nodes().to$().find('.select2').val() != ''){
				//if(this.cell(rowIdx, tableLoop).nodes().to$().find('.select2').val() != ''){
					row_data_count_use++;
					//$("#data-table-default").DataTable().row.add(row_data).draw();
				//}
			} 
			
			//console.log(this.cell(rowIdx, tableLoop).search('.debitamount').val());
		});
		
		console.log('目前表格所有欄位:'+ row_data_count);
		console.log('目前表格不可填的欄位:'+ row_data_count_use);
		console.log('目前表格要新增的欄位:'+ list_id_count);
		console.log('最後要新增的欄位數目:'+ (list_id_count-(row_data_count-row_data_count_use)));
		
		if(list_id_count > (row_data_count-row_data_count_use)){
			console.log('目前表格欄位不夠新增:'+ (list_id_count-(row_data_count-row_data_count_use)));
			for(i=0; i<(list_id_count-(row_data_count-row_data_count_use)); i++){
				$("#data-table-default").DataTable().row.add(row_data).draw();
				row_data_count_add_index.push(row_data_count_use+i);
			}	
		}else{
			console.log('目前表格欄位夠新增');
		}
		
		console.log('需要更新為空值的index'+row_data_count_add_index[0]); // 目前點選的值
		//row_data_count_add_index.pop();
		//console.log('需要更新為空值的index'+row_data_count_add_index[row_data_count_add_index.length-1]); // 目前點選的值
		console.log('需要更新為空值的index'+row_data_count_add_index); // 目前點選的值
		
		$("#data-table-default").DataTable()
		.cells()
		.every( function ( rowIdx, tableLoop, rowLoop ) {
			//console.log( '表格 index: '+rowIdx+' Data in tableLoop:: '+tableLoop +' Data in rowLoop:: '+rowLoop);
			//console.log('目前單元格值='+this.data());
			//console.log(this.node());
			//console.log(this.nodes());
			//console.log('目前的值為'+this.nodes().to$().find('.debitamount').val());
			//this.nodes().to$().find('.debitamount').val(66);
			//console.log(this.cell(rowIdx, tableLoop).data());
			//console.log('目前的值為'+this.node(2).to$().find('.debitamount').val());
			//console.log(this.nodes().data());
			//this.nodes().to$().find('.debitamount').val(66);
			//console.log(this.cell(rowIdx, tableLoop).nodes().to$().find('.select2').val(list_id[list_id_count-1]));
			
			if(tableLoop == 1 && rowIdx == row_data_count_add_index[0])
			{
				this.cell(rowIdx, tableLoop).nodes().to$().find('.select2').val('');
				//console.log(this.cell(rowIdx, tableLoop).nodes().to$().find('.select2').val());
				//console.log(rowIdx);
				//$("#data-table-default").DataTable().draw();
			}
			
			if(tableLoop == 2 && rowIdx == row_data_count_add_index[0])
			{
				this.cell(rowIdx, tableLoop).nodes().to$().find('.debitamount').val(0);
				//console.log(this.cell(rowIdx, tableLoop).nodes().to$().find('.select2').val());
				//console.log(rowIdx);
				//$("#data-table-default").DataTable().draw();
			}
			
			if(tableLoop == 3 && rowIdx == row_data_count_add_index[0])
			{
				this.cell(rowIdx, tableLoop).nodes().to$().find('.creditamount').val(0);
				//console.log(this.cell(rowIdx, tableLoop).nodes().to$().find('.select2').val());刪除)
				//console.log(rowIdx);
				//$("#data-table-default").DataTable().draw();
			}
			
			if(tableLoop == 4 && rowIdx == row_data_count_add_index[0])
			{
				this.cell(rowIdx, tableLoop).nodes().to$().find('.notes1').val('');
				//console.log(this.cell(rowIdx, tableLoop).nodes().to$().find('.select2').val());
				row_data_count_add_index.shift(); // 刪除第一個元素(最後一個才刪除)
				//console.log(rowIdx);
				//$("#data-table-default").DataTable().draw();
			}

			
			if(tableLoop == 1 && this.cell(rowIdx, tableLoop).nodes().to$().find('.select2').val() == ''){
				//if(this.cell(rowIdx, tableLoop).nodes().to$().find('.select2').val() == ''){
					list_id_count = list_id.length;
					this.cell(rowIdx, tableLoop).nodes().to$().find('.select2').val(list_id[list_id_count-1]);
					list_id.pop();
				//}else{
				//}
			}
			
			//console.log(this.cell(rowIdx, tableLoop).search('.debitamount').val());
		});
		
		$("#data-table-default").DataTable().draw();
		
		$(".data-table-model .data-check:checked").each(function() {
			$(this).prop("checked",false);
		});
		
		$("#Ajax_detail_type").modal('hide');
		
		
		
		/*for(i=0; i<row_data_count; i++){
			for(j=0; j<column_data_count; j++){
				//console.log(777);
				//console.log($("#data-table-default").DataTable().cell(i,j).data());
				//console.log($("#data-table-default").DataTable().cell(i,j).nodes().to$().find('input').val());
			}
		}*/
		
		//console.log($("#data-table-default").DataTable().cell(0,2).data());

        //var j=0;
		/*for(i=0; i<list_id.length; i++){

        //console.log($("#data-table-default .clone_group").find('td').html()); // 目前點選的值

			$("#data-table-default .clone_group").find('td').each(function(column_data_count_index,element) { // 取得第一筆資料
				
				    //console.log(this); // 取得每個cell 的內容
			     	//console.log('column_data_count_index='+column_data_count_index); // 取得每個cell 的內容
				    //console.log(row_data_count); // 取得每個cell 的內容
				    //console.log('目前計數'+j); // 
			        //console.log($("#data-table-default").DataTable().cell(this));

					row_data[row_data_key[column_data_count_index]] = $(this).html();
					
					if(row_data_key[column_data_count_index] == 'detail_type') { 
						//console.log(list_id[0]);
						//console.log(row_data[row_data_key[column_data_count_index]]);
						//$('#data-table-default .clone_group td .eq(0).select2').val(list_id[i]);
						//$(this).find('.select2').val(list_id[i]);
						//row_data[row_data_key[column_data_count_index]] =  $(this).find(".accountingsubjects_code").val(list_id[i]);
						//row_data[row_data_key[column_data_count_index]] =  (list_id[i]);
						//console.log(row_data[row_data_key[column_data_count_index]]);
						//console.log($(this).html().find(".accountingsubjects_code"));
						//$('#selectBox option[value=C]').attr('selected', 'selected');
						row_data[row_data_key[column_data_count_index]] =  $("#data-table-default").DataTable().column(1).data()[0];
						//row_data[row_data_key[column_data_count_index]] =  row_data[row_data_key[column_data_count_index]].children(".select2 option[value=list_id[i]]").attr('selected', 'selected');
					}
					
					//console.log('欄位值'+column_data_count_index);
					if(row_data_key[column_data_count_index] == 'action') { 
						row_data[row_data_key[column_data_count_index]] = "<a href='javascript:;' class='btn btn-danger dictpush-minus btn-block' onclick='delRow(this)'><i class='fa fa-minus'></i></a><input name='detail_id[]' hidden='hidden' id='detail_id[]' class='detail_id' />";
					}
				
				    //row_data_count--;
				
				    //j++;
					
					//row_data.push($(this).html());
					
					//console.log($(this).html());
			});
			
			    //console.log(this);
			    //console.log($("#data-table-default").DataTable().cell(this));
			
			    //$("#data-table-default").DataTable().row(0).edit(row_data).draw();

				$("#data-table-default").DataTable().row.add(row_data).draw();
				//$("#data-table-default").DataTable().rows(row_data_count).data()[0]['detail_type'].select('.select2').val(list_id[i]);
			    //$("#data-table-default").DataTable().row(row_data_count).find('.select2').val(list_id[i]);
				//console.log($("#data-table-default").DataTable().rows(row_data_count).data()[0]['detail_type']);
				//console.log(row_data_count);
				//$(this).find('.select2').val(list_id[i]);
				//console.log($('#data-table-default .clone_group td:eq(0').html());
				//$("#data-table-default .clone_group").find('.select2:eq(1)').val(list_id[i]);
				//console.log($("#data-table-default").find('.select2').eq(1));
				row_data_count++;	
		}*/
		
		



		$("#data-table-default .clone_group").find('.select2').each(function() { // 取得第一筆資料
			//console.log($(this));
			//$(this).find('option[value=2222]').val(3333);
			//console.log('val='+$(this).find('option[value=2222]').val());	
		});

		

		
		//console.log(row_data);

		//$("#data-table-default").DataTable().rows.add(row_data).draw();
		
	}
</script> 

<script>
	//$.fn.editable.defaults.mode = 'inline';
	function ModelSelectItemValuetest(){ 
    //$("#data-table-default").find("tr").each(function(){
        console.log('目前總共幾行:'+ $("#data-table-default").DataTable().rows().count());
		var $row_data_count = $("#data-table-default").DataTable().rows().count();
        //});
        var $i=1;
			$("#data-table-default").find(".select2").each(function(){
				if ($(this).data('select2')) {
					$(this).select2('destroy');
				}
			});
         
			var row_data = [];
			var row_data_key = ['id','detail_type','debitamount','creditamount','notes1','action'];
			$("#data-table-default").DataTable().find('td').each(function(row_data_count) { // 取得第一筆資料
				
				row_data[row_data_key[row_data_count]] = $(this).html();
				
				if(row_data_key[row_data_count] == 'action') { 
					row_data[row_data_key[row_data_count]] = "<a href='javascript:;' class='btn btn-danger dictpush-minus btn-block' onclick='delRow(this)'><i class='fa fa-minus'></i></a><input name='detail_id[]' hidden='hidden' id='detail_id[]' class='detail_id' />";
				}
				
				//row_data.push($(this).html());
				
				row_data_count++;
				//console.log($(this).html());
			});
			  
			$("#data-table-default").DataTable().row.add(row_data).draw();
			
            //$(this).parents(".clone_group").clone(true).appendTo($("#data-table-default"));
            //$(this).children().removeClass("fa-plus").removeClass("green").addClass("fa-minus").addClass("red");  
            //$(this).removeClass("dictpush-plus").addClass("dictpush-minus");
			
			/* 動態給定值 */
			$(this).parents(".clone_group").find('.detail_id').val("clone"+$i);
			
			$(this).parents(".clone_group").find('.select2').val(1111);
			
			$i++;
			$('.select2').select2();
		}
</script> 