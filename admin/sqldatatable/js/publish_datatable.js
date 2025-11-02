var handleDataTableDefault = function() {
    "use strict";

    if ($('#data-table-default').length !== 0) {
        var otable = $('#data-table-default').DataTable({       //"dom":"lBfrtip",buttons:[{extend:"copy",className:"btn-sm"},{extend:"csv",className:"btn-sm"},{extend:"excel",className:"btn-sm"},{extend:"pdf",className:"btn-sm"},{extend:"print",className:"btn-sm"},{extend:"colvis",className:"btn-sm"}],
			"dom": "lprtip",
            "autoWidth": false,
            "ajax": {
                "url": "sqldatatable/publish_view.php",
                "type": "post",
				"data": function ( d ) {
					// servermode default value
					//d.tb_filter_title = $('#tb_filter_title').val();
					//d.tb_filter_sortid = $('#tb_filter_sortid').val();
					//d.tb_filter_indicate = $('#tb_filter_indicate').val();
					
					d.search_type = $('#col2_filter').val();
					d.search_indicate = $('#col4_filter').val();
					
					
					//console.log($('#coltype_filter').val());
					// d.custom = $('#myInput').val();
					// etc
				},
                "error": function() {
                    alert("伺服器未回應");
                }
            },
            'columnDefs': [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': function(data, type, full, meta) {
                    return '<input type="checkbox" class="data-check" name="id[]" value="' + $('<div/>').text(data).html() + '">';}
                }],
			"select": true,
			"colReorder": true, /* 標題可拖曳 */
            "order": [[5, 'desc']],
            "columns": [{
                "data": "id",
                "orderable": false
            },
            {
                "data": "title",
                "orderable": true
            },
			{
                "data": "type",
                "orderable": true
            },
            {
                "data": "sortid",
                "orderable": true
            },
            {
                "data": "indicate",
                "orderable": true
            },
			{
                "data": "postdate",
                "orderable": true
            },
            {
                "data": "action",
                "orderable": false,
				"searching":false
            }],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"] // change per page values here
            ],
            "language": //把文本變為中文
            {
                "sProcessing": "處理中...",
                "sLengthMenu": "顯示 _MENU_ 項結果",
                "sZeroRecords": "沒有符合的結果",
                "sInfo": "顯示第 _START_ 至 _END_ 項結果，共 _TOTAL_ 項",
                "sInfoEmpty": "顯示第 0 至 0 項結果，共 0 項",
                "sInfoFiltered": "(由 _MAX_ 項結果過濾)",
                "sInfoPostFix": "",
                "sSearch": "<span class=\"input-group-addon\" style=\"margin-right:-10px; \"><i class=\"fa fa-search\" style=\"\"></i></span>",
                "sUrl": "",
                "sEmptyTable": "目前尚無資料",
                "sLoadingRecords": "載入中...",
                "sInfoThousands": ",",
                "oPaginate": {
                    "sFirst": "首頁",
                    "sPrevious": "上頁",
                    "sNext": "下頁",
                    "sLast": "末頁"
                },
                "oAria": {
                    "sSortAscending": ": 以升序排列此列",
                    "sSortDescending": ": 以降序排列此列"
                },
				"select": {
					rows: {
						_: "選擇 %d 列",
						1: "選擇 1 列"
					}
				},
				"buttons": {
                	'copy': '複製',
					'print': '列印',
					'colvis': '隱藏'
            	}
            },
            "rowReorder": {
                selector: 'td:nth-child(2)'
            },
            "responsive": true,
			//当处理大数据时，延迟渲染数据，有效提高Datatables处理能力
            "deferRender": true,
            "paging": true,
            // 是否開啟分頁功能(默認開啟)
            "info": true,
            // 是否顯示分頁的統計信息(默認開啟)
            "searching": true,
            // 是否開啟搜索功能(默認開啟)
			//"deferLoading":0,
            "ordering": true,
            // 是否開啟排序功能(默認開啟)
            "stateSave": true,
            // 是否保存當前datatables的狀態(刷新後當前保持狀態)
			//保存状态操作
			"stateSaveParams": function (settings, data) {
				console.log("stateSaveParams");
				data.search.field = {
					gsearch: $("#global_filter").val(),
					type: $("#col2_filter").val(),
					indicate: $("#col4_filter").val(),
					
					//title: $("#col1_filter").val(),
					//sortid: $("#col2_filter").val()
					//sortid: "30"
				}
				data.search.tb_field = {
					title: $("#tb_filter_title").val(),
					sortid: $("#tb_filter_sortid").val()
					//sortid: "30"
				}
				
				//console.log(data.search.field);
				
				//console.log(data.search.tb_field);
				
				//这里可以操作保存的数据，写上自己特定的逻辑
				//data.search.search = "";
		
			},
			"stateSaveCallback": function (settings, data) {
				console.log("stateSaveCallback");
				//DT默认保存的key值为DataTables_+表格id+页面名称
				localStorage.setItem('DataTables_' + settings.sInstance, JSON.stringify(data));
				//console.log(data.search.field);
				// 你可以把这些数据保存在服务器上，上面的代码标识使用本地储存来存储这些数据
				/**$.ajax( {
						"url": "/state_save",
						"data": data,
						"dataType": "json",
						"type": "POST",
						"success": function () {}
					} );
				 **/
			},
			//读取状态操作
			"stateLoadParams": function (settings, data) {
				console.log("stateSaveParams");
				
				//console.log("读取状态操作", data.search.field);
				
				//console.log("读取状态操作", data.search.field.title);
				
				$("#global_filter").val(data.search.field.gsearch);
				
				$("#col2_filter").val(data.search.field.type);
				
				$("#col4_filter").val(data.search.field.indicate);
				
				
				
				//$("#col1_filter").val(data.search.field.title);
				//$("#col2_filter").val(data.search.field.sortid);
				
				//$("#tb_filter_title").val(data.search.tb_field.title);
				//$("#tb_filter_sortid").val(data.search.tb_field.sortid);
				
				
				//console.log(data.search.field);
				
				//在读取数据的时候可以改变数据，根据自己逻辑来处理
				//data.search.search = "";
				//或者你可以直接禁用从缓存里读取数据，只要直接返回false即可
				//return false;
			},
			"stateLoadCallback": function (settings) {
				console.log("stateLoadCallback");
				return JSON.parse(localStorage.getItem('DataTables_' + settings.sInstance));
				
				//$("#col1_filter").val("2013-06-21");
				
				//同样你还可以从服务器取数，采用同步的方式获取到保存在服务器里的数据
				/**var o;
				 $.ajax( {
					"url": "/state_load",
					"async": false,
					"dataType": "json",
					"success": function (json) {
						o = json;
					}
				} );
				 return o;**/
		
			},
			//状态加载完后执行的回调函数	
			"stateLoaded": function (settings, data) {
				console.log("stateLoaded");
				//console.log(data.search.field);
				//在这里你可以打印出保存的缓存数据
				console.log(data.search.field);
				//alert( 'Saved filter was: '+data.search.field );
			},
            "processing": true,
            // 顯示處理中的字樣[數量多的時候提示用户在處理中](默認開啟)
            "serverSide": true,    // 是否開啟服務器模式
            // false時，會一次性查詢所有的數據，dataTables幫我們完成分頁等。
            // true時，點擊分頁頁碼就會每次都到後台提取數據。
            // set the initial value
            "pageLength": 25,
            "fnDrawCallback": function(oSettings) {
				$(".imgLiquidFill").imgLiquid({fill:false});
				$(".colorbox_iframe").colorbox({iframe:!0,width:"90%",height:"90%",fixed:!0,rel:"nofollow"});$(".colorbox_iframe_small").colorbox({iframe:!0,width:"1000px",height:"80%",fixed:!0,rel:"nofollow"});$(".colorbox_iframe_cd").colorbox({iframe:!0,width:"99%",height:"99%",fixed:!0,rel:"nofollow"});$(".youtube").colorbox({iframe:true, innerWidth:900, innerHeight:506});
                // EditTable
                $('#data-table-default').editable({
                    selector: ".ed_title",
                    url: 'sqledit/publish_jedit.php',
                    type: 'text',
                    name: 'title',
                    //title: '輸入標題',
                    tpl: "<input type='text' style='width: 100%' maxlength='200'>",
                    select2: {
                        width: '100%',
                        // THIS DOESN'T WORK AS IT SHOULD
                        // hiding search box
                        minimumResultsForSearch: -1
                    },
                    validate: function(value) {
                        if ($.trim(value) == '') {
                            return '值不能為空';
                        }
                    }
                });

                $('#data-table-default').editable({
                    selector: ".ed_sortid",
                    url: 'sqledit/publish_jedit.php',
                    type: 'text',
                    name: 'sortid',
                    //title: '輸入排序',
                    tpl: "<input type='number' style='width: 80px' maxlength='200'>",
                    select2: {
                        width: '100%',
                        // THIS DOESN'T WORK AS IT SHOULD
                        // hiding search box
                        minimumResultsForSearch: -1
                    },
                    validate: function(value) {
                        if ($.trim(value) == '') {
                            return '值不能為空';
                        }
                    }
                });

                $('#data-table-default').editable({
                    selector: ".ed_indicate",
                    url: 'sqledit/publish_jedit.php',
                    name: "indicate",
                    value: '',
                    source: [{
                        value: 1,
                        text: '公佈'
                    },
                    {
                        value: 0,
                        text: '隱藏'
                    }],
                    validate: function(value) {
                        if ($.trim(value) == '') {
                            return '值不能為空';
                        }
                    }

                });
				
				$('#data-table-default').editable({
                    selector: ".ed_type",
                    url: 'sqledit/publish_jedit.php',
                    name: "type",
                    source: "sqledit/publish_get_list.php?list_id=1",
                    validate: function(value) {
                        if ($.trim(value) == '') {
                            return '值不能為空';
                        }
                    }

                });
				
				$('#data-table-default').editable({
                    selector: ".ed_postdate",
                    url: 'sqledit/publish_jedit.php',
                    name: "postdate",
                    validate: function(value) {
                        if ($.trim(value) == '') {
                            return '值不能為空';
                        }
                    }

                });

            },
        });
		
		
        $("#data-table-default thead th input[type=text]").on('keyup change',
        function() {
            otable.column($(this).parent().index() + ':visible').search(this.value).draw();
			//console.log(otable.column($(this).parent().index() + ':visible').search(this.value));
			//$( 'input', table.column( colIdx ).footer() ).val( colSearch.search );
			//otable.fnFilter(this.value);
			//oTable.fnFilter(this.value, $("thead #FitterColumn input").index(this));
        });
        $("#data-table-default thead th select").on('keyup change',
        function() {
            otable.column($(this).parent().index() + ':visible').search(this.value).draw();
			//$( 'input', table.column( colIdx ).footer() ).val( colSearch.search );
			//oTable.fnFilter(this.value, $("thead input").index(this));
        });

		/* 清除儲存狀態 */
		$("#data-table-default #reset_table").on('click',
        function() {
			var confirmation = confirm('確定要重設目前頁面設定及搜尋結果?');
			if(confirmation) {	
				otable.state.clear();
				//otable.fnFilterClear();
				//otable.ajax.reload()
				window.location.reload();
			}
        });

        // Handle click on "Select all" control
        $('#data-table-default-select-all').on('click',
        function() {
            // Get all rows with search applied
            var rows = otable.rows({
                'search': 'applied'
            }).nodes();
            // Check/uncheck checkboxes for all rows in the table
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        // Handle click on checkbox to set state of "Select all" control
        $('#data-table-default tbody').on('change', 'input[type="checkbox"]',
        function() {
            // If checkbox is not checked
            if (!this.checked) {
                var el = $('#data-table-default-select-all').get(0);
                // If "Select all" control is checked and has 'indeterminate' property
                if (el && el.checked && ('indeterminate' in el)) {
                    // Set visual state of "Select all" control
                    // as 'indeterminate'
                    el.indeterminate = true;
                }
            }
        });
		
    }

};

var TableManageDefault = function() {
    "use strict";
    return {
        //main function
        init: function() {
            handleDataTableDefault();
        }
    };
} ();


function reload_table() {
	$('#data-table-default').DataTable().ajax.reload();
}


function delete_datatables(id,e) {
    e.preventDefault(); // prevent form submit
    swal({
        title: '確定删除?',
        text: "此動作將無法恢復",
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: '取消',
        confirmButtonText: '確定',
        showLoaderOnConfirm: true,
        buttonsStyling: false,
        confirmButtonClass: 'btn btn-danger m-5',
        cancelButtonClass: 'btn btn-default m-5',
        preConfirm: function() {
            return new Promise(function(resolve) {

                $.ajax({
                    url: "sqldatatable/publish_del.php?id_del=" + id,
                    type: "GET"
                }).done(function(response) {
                    swal({
                        title: '已刪除',
                        text: '資料刪除成功！',
                        type: 'success',
						buttonsStyling: false,
						confirmButtonText: '確定',
						confirmButtonClass: "btn btn-primary m-5"
                    },
                    response.message, response.status);
                    reload_table();
                    //readProducts();
                }).fail(function() {
                    swal('錯誤', 'Ajax 回應錯誤', 'error');
                });
            });
        },
        allowOutsideClick: false
    });

    //}
}

function delete_muti_datatables(e) {
    var list_id = [];
    $(".data-check:checked").each(function() {
        list_id.push(this.value);
    });
    if (list_id.length > 0) {
        e.preventDefault(); // prevent form submit
        swal({
            title: '確定删除' + list_id.length + '筆資料?',
            text: "此動作將無法恢復",
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: '取消',
            confirmButtonText: '確定',
            showLoaderOnConfirm: true,
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-danger m-5',
            cancelButtonClass: 'btn btn-default m-5',
            preConfirm: function() {
                return new Promise(function(resolve) {

                    $.ajax({
                        url: "sqldatatable/publish_del_muti.php",
                        data: {
                            id: list_id
                        },
                        type: "POST"
                    }).done(function(response) {
                        swal({
                            title: '已刪除',
                            text: '資料刪除成功！',
                            type: 'success'
                        },
                        response.message, response.status);
                        reload_table();
                        //readProducts();
                    }).fail(function() {
                        swal('錯誤', 'Ajax 回應錯誤', 'error');
                    });
                });
            },
            allowOutsideClick: false
        });
    } else {
        swal('錯誤!', '尚未選擇任何資料', 'warning');
    }

    //}
}


function filterGlobal () {
    $('#data-table-default').DataTable().search(
        $('#global_filter').val()//,
        //$('#global_regex').prop('checked'),
        //$('#global_smart').prop('checked')
    ).draw();
	//console.log($('#data-table-default').DataTable().search($('#global_filter').val()).draw());
}
 
function filterColumn ( i ) {
    $('#data-table-default').DataTable().column( i ).search(
        $('#col'+i+'_filter').val()//,
        //$('#col'+i+'_regex').prop('checked'),
        //$('#col'+i+'_smart').prop('checked')
    ).draw();
	//console.log($('#data-table-default').DataTable().column( i ).search($('#global_filter').val()));
}

$(document).ready(function() {
    $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    } );
 
    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
		//console.log($(this).parents('tr').attr('data-column'));
		//console.log($('#data-table-default').DataTable().column(i).search($('#global_filter').val()).draw());
    } );
	
	$('input.search_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('div').attr('data-column') );
		//console.log($(this).parents('tr').attr('data-column'));
		//console.log($('#data-table-default').DataTable().column(i).search($('#global_filter').val()).draw());
    } );
	
	$('select.search_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('div').attr('data-column') );
		//console.log($(this).parents('tr').attr('data-column'));
		//console.log($('#data-table-default').DataTable().column(i).search($('#global_filter').val()).draw());
    } );

} );
