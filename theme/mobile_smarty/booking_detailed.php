<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<link href="<?php //if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>admin/assets/plugins/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media='print'/>
<link href="<?php //if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>admin/assets/plugins/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet" />
<script src="<?php //if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>admin/assets/plugins/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="<?php //if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>admin/assets/plugins/fullcalendar/dist/locale/zh-tw.js"></script>
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>jquery-nicelabel.css" rel="stylesheet" type="text/css" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteCssUrlOuter; } else { echo $SiteCssUrl; } ?>jquery.bootstrap-touchspin.min.css" rel="stylesheet">
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.nicelabel.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.bootstrap-touchspin.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/labelauty/1.1.4/jquery-labelauty.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/labelauty/1.1.4/jquery-labelauty.min.js"></script>

<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter; } else { echo $SiteBaseUrl; } ?>SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter; } else { echo $SiteBaseUrl; } ?>SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteJsUrlOuter; } else { echo $SiteJsUrl; } ?>jquery.twzipcode.js" type="text/javascript"></script>
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter; } else { echo $SiteBaseUrl; } ?>SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter; } else { echo $SiteBaseUrl; } ?>SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />

<style type="text/css">
.text_radio{float:left;margin:5px; }
.text-nicelabel + label > span.nicelabel-unchecked,.text-nicelabel  + label > span.nicelabel-checked{ padding: 10px 20px 10px 10px;}

.button-group-pills .active{
	background-color: #269abc !important;
    border-color: none !important;
	}
.button-group-pills .btn{
	line-height:26px;
	}

</style>
   
<?php
/*********************************************************************
 # 主頁面發布資訊
 *********************************************************************/
?>
<?php
#
# ============== [title] ============== #
#
# 標題部分
?>
<!--標題外框-->
<div style="position:relative;">
  <div class="mdtitle TitleBoardStyle">
    <div class="mdtitle_t">
      <div class="mdtitle_t_l"> </div>
      <div class="mdtitle_t_r"> </div>
      <div class="mdtitle_t_c"><!--標題--></div>
      <div class="mdtitle_t_m"><!--更多--></div>
    </div><!--mdtitle_t-->
    <div class="mdtitle_c g_p_hide">
      <div class="mdtitle_c_l g_p_fill"> </div>
      <div class="mdtitle_c_r g_p_fill"> </div>
      <div class="mdtitle_c_c">
        <!-- <div class="mdtitle_m_t"></div>
					<div class="mdtitle_m_c">  --> 
  <!--標題外框--> 
        <div class="ct_title">
          <h1 style="font-size:large"><?php if($TmpTitleBgImage != ''){ ?><span class="titlesicon" data-scroll-reveal="enter top"><img src="<?php if($SiteBaseUrlOuter != "" && $TmpTitleBgWebName == 'playweb') { echo $SiteImgUrlOuter; } else { echo $SiteImgUrl; } ?><?php echo $TmpTitleBgWebName; ?>/image/tmpbackground/<?php echo $TmpTitleBgImage; ?>" /></span><?php } ?> <span class="titlesicon" data-scroll-reveal="enter right"><?php echo $ModuleName_Service; // 標題文字 ?></span></h1>
        </div>
  <!--標題外框-->
        <!--</div>
					<div class="mdtitle_m_b"></div>-->
        </div>
    </div><!--mdtitle_c-->
    <div class="mdtitle_b">
      <div class="mdtitle_b_l"> </div>
      <div class="mdtitle_b_r"> </div>
      <div class="mdtitle_b_c"> </div>
    </div><!--mdtitle_b-->
  </div><!--mdtitle-->
</div>
<!-- 標題外框-->
<?php
#
# ============== [/title] ============== #
?> 
<?php
#
# ============== [rs date] ============== #
#
# 顯示資料集分頁
?>
<?php 
if ($totalRows_RecordService > 0 ) { // Show if recordset not empty 
?>
<!--外框-->
<div style="position:relative;">
  <div class="mdmiddle MiddleBoardStyle">
    <div class="mdmiddle_t">
      <div class="mdmiddle_t_l"> </div>
      <div class="mdmiddle_t_r"> </div>
      <div class="mdmiddle_t_c"><!--標題--></div>
      <div class="mdmiddle_t_m"><!--更多--></div>
      </div><!--mdmiddle_t-->
    <div class="mdmiddle_c g_p_hide">
      <div class="mdmiddle_c_l g_p_fill"> </div>
      <div class="mdmiddle_c_r g_p_fill"> </div>
      <div class="mdmiddle_c_c">
        <!-- <div class="mdmiddle_m_t"></div>
					<div class="mdmiddle_m_c">  --> 
  <!--外框--> 


<?php
#
# ============== [/rs date] ============== #
?> 
<?php 
#
# ============== [if] ============== #
#
# 在此判斷式之內放置要顯示之內容
if ($totalRows_RecordService > 0) { // Show if recordset not empty 
?>

<div class="post_content padding-3">
	
	
<div id="calendar" class="vertical-box-column calendar"></div>
	
       
                 
                    <div style="clear:both;"></div>


                    
                

</div>
<?php 
} // Show if recordset not empty 
#
# ============== [/if] ============== #
?>

  <!--外框-->
        <!--</div>
					<div class="mdmiddle_m_b"></div>-->
        </div>
      </div><!--mdmiddle_c-->
    <div class="mdmiddle_b">
      <div class="mdmiddle_b_l"> </div>
      <div class="mdmiddle_b_r"> </div>
      <div class="mdmiddle_b_c"> </div>
      </div><!--mdmiddle_b-->
  </div><!--mdmiddle-->
</div>
<!--外框-->
<?php 
} // Show if recordset not empty 
#
# ============== [/if] ============== #
?>  
<?php 
#
# ============== [if] ============== #
#
# 判斷當無資料顯示時之畫面
if ($totalRows_RecordService == 0) { // Show if recordset empty 
?>
<!--外框-->
<div style="position:relative;">
<div class="mdmiddle MiddleBoardStyle">
	<div class="mdmiddle_t">
			<div class="mdmiddle_t_l"> </div>
			<div class="mdmiddle_t_r"> </div>
			<div class="mdmiddle_t_c"><!--標題--></div>
			<div class="mdmiddle_t_m"><!--更多--></div>
	</div><!--mdmiddle_t-->
	<div class="mdmiddle_c g_p_hide">
			<div class="mdmiddle_c_l g_p_fill"> </div>
			<div class="mdmiddle_c_r g_p_fill"> </div>
			<div class="mdmiddle_c_c">
					<!-- <div class="mdmiddle_m_t"></div>
					<div class="mdmiddle_m_c">  --> 
<!--外框-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style00">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><table width="250" border="0" cellspacing="0" cellpadding="0">
      <tr>
          <td width="61"><img src="<?php echo $SiteBaseUrl; ?>images/error_tip.png" width="60" height="60" /></td>
          <td width="189">目前尚無資料</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center">您可登入後台之維護介面：  <strong style="color:#090;">公布資訊  →  新增</strong> 來建立該項目</td>
  </tr>
</table>
<br />
<br />
<!--外框-->
  				<!--</div>
					<div class="mdmiddle_m_b"></div>-->
	  </div>
	</div><!--mdmiddle_c-->
	<div class="mdmiddle_b">
			<div class="mdmiddle_b_l"> </div>
			<div class="mdmiddle_b_r"> </div>
			<div class="mdmiddle_b_c"> </div>
	</div><!--mdmiddle_b-->
</div><!--mdmiddle-->
</div>
<!--外框-->
  <?php 
} // Show if recordset empty 
#
# ============== [/if] ============== #
?>

            
<div class="modal fade" id="ModalAdd">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">預約課程</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                
                
                <?php $editFormAction = $SiteBaseUrl . "booking_order_send_cart.php"; ?>
                
                
                <form action="<?php echo $editFormAction; ?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
                  <div class="form-group row">
                      <label class="col-md-3 col-form-label">課程</label>
                      <div class="col-md-9">
                          <?php echo $row_RecordService['name']; ?>   
                      </div>
				  </div>
				  <div class="form-group row">
                      <label class="col-md-3 col-form-label">時間</label>
                      <div class="col-md-9">
                          <div id="selectdate"></div>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-3 col-form-label">訂購人姓名</label>
                      <div class="col-md-9"> <span id="sprytextfield7">
                  <label for="ocbuyname"></label>
                  <input name="ocbuyname" type="text" class="text form-control" id="ocbuyname" value="<?php echo $row_RecordMember['name'] ?>" maxlength="30"/>
                  <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03 ?></span></span> </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-3 col-form-label">手機</label>
                      <div class="col-md-9"> <span id="sprytextfield8">
                        <label for="ocbuyphone"></label>
                        <input name="ocbuyphone" type="text" class="text form-control" id="ocbuyphone" value="<?php echo $row_RecordMember['cellphone'] ?>" maxlength="30"/>
                        <span class="textfieldRequiredMsg"><?php echo $Lang_Classify_Send_Error03 ?></span><span class="textfieldInvalidFormatMsg">格式無效。</span></span> </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-3 col-form-label">服務人員<span class="text-red">*</span></label>
                      <div class="col-md-9">
                      
                      
                      <div class="button-group-pills" data-toggle="buttons">
                      <?php do { ?>
                      	<label class='btn bg-grey-transparent-6 text-white m-5' onclick="EmployeesTimeGet(<?php echo $row_RecordEmployees['id']; ?>);"><input type='radio' name='employeesselect' value='<?php echo $row_RecordEmployees['name']; ?>'><div><?php echo $row_RecordEmployees['name']; ?></div></label>
                        <?php } while ($row_RecordEmployees = mysqli_fetch_assoc($RecordEmployees)); ?>
                      </div>
                      

                          <script>
								$('#text-radio input').nicelabel({ uselabel: false});
						  </script>
                          
                          <script type="text/javascript">	
								function EmployeesTimeGet(aid){
								   //var $employees = $("#employees");
								   var employeesname = $('input:radio:checked[name="employeesselect"]').val();
								   var startdate = $('#startdate').val();
								   var enddate = $('#enddate').val();
								   //console.log(aid);
									 $.ajax({
									  url:'<?php echo $SiteBaseUrl ?>ajax/employeesworktime.php?aid=' + aid + "&startdate=" + startdate + "&enddate=" + enddate+ "&servicetime=" + <?php echo $row_RecordService['servicetime']; ?>,//取得資料的頁面網址
									  //contentType:"json", //傳回的資料格式
									  //ajax 成功後要執行的函式
									  success:function(data){ 
									  //console.log(data);
									  
									  //$(":checkbox").labelauty();
									  
									  $('#get_employees_worktime').html(data);
									  
										  //EmployeeID:資料表的欄位名稱
										  /*$.each(data,function(index,item){                     
											 $get_employees_worktime.append(
											  "<tr><td>" + item.EmployeeID + "</td>" +
												  "<td>" + item.FirstName + "</td>"+
												  "<td>" + item.LastName + "</td></tr>"
											 );
										  })*/
									  }
									   
									 })
									
								}
								
								    function EmployeesRangeTimeGet(){

										//console.log($('input:radio:checked[name="rangetime"]').val());
										
									$('#get_employees_worktime .btn').each(function(){
										
                                        $('#EmployeesSend').removeAttr('disabled');
										//event.preventDefault();
										$(this).attr('class','btn bg-grey-transparent-6 text-white m-5');
										
										//$(this).eq(index()).addClass('your_new_class');
										
										$(this).on('click',function(){
											$(this).siblings().attr('class','btn bg-grey-transparent-6 text-white m-5'); // if you want to remove class from all sibling buttons
											//$(this).removeClass('bg-grey-transparent-6');
											$(this).attr('class','btn btn-info text-white m-5 active');
										});
									});


									/*$("#get_employees_worktime .btn").attr('class','btn bg-grey-transparent-6 text-white m-5');
									$('#get_employees_worktime .btn').on('click', function(){
										$(this).attr('class','btn btn-info text-white m-5');
									  }
									);*/
									//console.log(1111);
								    }
						</script>

                      </div>
                  </div>
                  <div class="form-group row" >
                      <label class="col-md-3 col-form-label">時間<span class="text-red">*</span></label>
                      <div class="col-md-9" id="get_employees_worktime">
                         
                      </div>
                  </div>
				  <?php //require("require_employees_detailed_format.php"); ?>
			      <div class="form-group row">
				  <label class="col-md-3 col-form-label"></label>
				  <div class="col-md-9">
					<button type="submit" class="btn btn btn-primary btn-block" id="EmployeesSend" disabled="disabled ">送出</button> 
					<input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
					<input name="aid" type="hidden" id="aid" value="<?php echo $_GET['aid']; ?>" />
                    <input name="startdate" type="hidden" id="startdate" />
					<input name="enddate" type="hidden" id="enddate" />
                    <input name="userid" type="hidden" id="userid" value="<?php echo $_SESSION['userid'];?>" />
                    <input name="wshop" type="hidden" id="wshop" value="<?php echo $_GET['wshop'];?>" />
					<input name="id" type="hidden" id="id" value="<?php echo $row_RecordService['id']; ?>"/>
                      
                      
                    <input name="dcproductname" type="hidden" id="dcproductname" value="<?php echo $row_RecordService['name']; ?>" />
                    <input name="dcprice" type="hidden" id="dcprice" value="<?php echo $row_RecordService['price']; ?>" />
                    <input name="dcquantiry" type="hidden" id="dcquantiry" value="1" />
                    <input name="dcitemtotal" type="hidden" id="dcitemtotal" value="1" />
                    <input name="octotal" type="hidden" id="octotal" value="<?php echo $row_RecordService['price']; ?>" />
                      
                      
                      
				  </div>
				  </div>
				  <input type="hidden" name="MM_insert" value="form_Employeeshoilday" />
                </form>
                
            </div>
            
        </div>
    </div>
</div>


<script type="text/javascript">

$(document).ready(function() {
	/*var date = new Date();
	var currentYear = date.getFullYear();
	var currentMonth = date.getMonth() + 1;
			currentMonth = (currentMonth < 10) ? '0' + currentMonth : currentMonth;*/
  

	$('#calendar').fullCalendar({
		header: {
			left: 'month,agendaWeek,agendaDay, listWeek',
			center: 'title',
			right: 'prev,today,next '
    },
    droppable: true, // this allows things to be dropped onto the calendar
   /* drop: function (date) {

  //Call when you drop any red/green/blue class to the week table.....first time runs only.....
  console.log("dropped");
  console.log(date.format());
  console.log(this.id);
  var defaultDuration = moment.duration($('#calendar').fullCalendar('option', 'defaultTimedEventDuration'));
  var end = date.clone().add(defaultDuration); // on drop we only have date given to us
  console.log('end is ' + end.format());

  //$('#ModalEdit #color').val(event.color);
	$('#ModalAdd #startdate').val(moment(date).format('YYYY-MM-DD HH:mm:ss'));
	$('#ModalAdd #enddate').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
  $('#ModalAdd').modal('show');

  // is the "remove after drop" checkbox checked?
  if ($('#drop-remove').is(':checked')) {
  // if so, remove the element from the "Draggable Events" list
  $(this).remove();
  }
  },*/
	  businessHours: [{   //设置哪些时间段重点标记颜色  
      dow: [1, 2, 3, 4, 5], // Monday - Friday
      start: '08:00',
      end: '12:00',
    }, {
      dow: [1, 2, 3, 4, 5], // Monday - Friday (if adding lunch hours)
      start: '13:00',
      end: '17:00',
    }],
			//defaultView: 'agendaDay',
			
			selectConstraint: "businessHours",
				select: function(start, end, jsEvent, view) {
				  if (start.isAfter(moment())) {
					    $('#ModalAdd #selectdate').html(moment(start).format('YYYY-MM-DD'));
						$('#ModalAdd #startdate').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
						$('#ModalAdd #enddate').val(moment(end).add(0, 'days').format('YYYY-MM-DD HH:mm:ss'));
						$('#ModalAdd').modal('show');
				  } else {
					alert('此預約時段已過期');
				  }
				},
				eventClick: function(calEvent, jsEvent, view) {
				  alert('Event: ' + calEvent.title);
				},
	
			scrollTime: '08:00:00',
		    slotLabelFormat: 'h:mm(:mm)a',
		    timeFormat :  "h:mm",
			//editable: true,
			navLinks: true,
			eventLimit: true, // allow "more" link when there are too many events
			selectable: true,
			selectHelper: true,
		    //eventLimitText  : "更多",
		/*select: function( startDate, endDate, allDay, jsEvent, view ){
			//var start =$.fullCalendar.formatDate(startDate,'yyyy-MM-dd');
			//console.log(moment(endDate).add(-1, 'days').format('YYYY-MM-DD'));
			$('#ModalAdd #startdate').val(moment(startDate).format('YYYY-MM-DD HH:mm:ss'));
            $('#ModalAdd #enddate').val(moment(endDate).add(0, 'days').format('YYYY-MM-DD HH:mm:ss'));
			$('#ModalAdd').modal('show');
    },*/
		displayEventTime:true,
        displayEventEnd:true,
		events: [
			<?php 
			/*if($totalRows_RecordEmployeeshoilday > 0) {
				do { 

        $start = explode(" ", $row_RecordEmployeeshoilday['startdate']);
				$end = explode(" ", $row_RecordEmployeeshoilday['enddate']);
				if($start[1] == '00:00:00'){
					$start = $start[0];
				}else{
					$start = $row_RecordEmployeeshoilday['startdate'];
				}
				if($end[1] == '00:00:00'){
					$end = $end[0];
				}else{
					$end = $row_RecordEmployeeshoilday['enddate'];
                }*/
        
			?>
			{
						'id' : '<?php //echo $row_RecordEmployeeshoilday['id']; ?>1',
						'title' : '<?php //echo $row_RecordEmployeeshoilday['title']; ?>Test',
						'start': '<?php //echo $start; ?>2019-10-24 08:00:00',
						'end': '<?php //echo $end; ?>2019-10-24 08:30:00',
						'url' : '',
						'allDay' : '',
						'color' : ''
			},
			<?php 
				/*} while ($row_RecordEmployeeshoilday = mysqli_fetch_assoc($RecordEmployeeshoilday));
			}*/
			?>	
		], //事件数据源
		/*dayClick: function(date, allDay, jsEvent, view) {
			console.log(startDate);
			$('#ModalAdd #day_start').val($.fullCalendar.formatDate(startDate,'yyyy-MM-dd'));
			console.log($.fullCalendar.formatDate(startDate,'yyyy-mm-dd'));
            $('#ModalAdd #day_end').val($.fullCalendar.formatDate(endDate,'yyyy-MM-dd'));
			$('#ModalAdd').modal('show');
    	},*/
	/*drop: function(date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject');
        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject);

        // assign it the date that was reported
        copiedEventObject.start = date;
        copiedEventObject.allDay = allDay;
        copiedEventObject.className = $(this).attr("data-class");
        $.post('calendar_action/employeeshoilday_add.php'),{'addEvent':copiedEventObject},function(data){
                console.log(copiedEventObject);
        });

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
            // if so, remove the element from the "Draggable Events" list
            $(this).remove();
        };

    },*/
    eventDrop: function(event, delta, revertFunc) { // si changement de position

      edit(event);

    },
    eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

      edit(event);

    },
		
		eventRender: function(event, element) {
                //$(element).addTouch();
				element.bind('click', function() {
					$('#ModalEdit #id').val(event.id);
					$('#ModalEdit #title').val(event.title);
					$('#ModalEdit #color').val(event.color);
					$('#ModalEdit #startdate').val(moment(event.start).format('YYYY-MM-DD HH:mm:ss'));
					$('#ModalEdit #enddate').val(moment(event.end).format('YYYY-MM-DD HH:mm:ss'));
					$('#ModalEdit').modal('show');
				});
		}
		/*eventClick: function(calEvent, jsEvent, view) {
			
			$('#ModalEdit #startdate').val(moment(startDate).format('YYYY-MM-DD HH:mm:ss'));
            $('#ModalEdit #enddate').val(moment(endDate).add(0, 'days').format('YYYY-MM-DD HH:mm:ss'));
			$('#ModalEdit').modal('show');
    }*/
    
  });
  
  function edit(event){
			start = event.start.format('YYYY-MM-DD HH:mm:ss');
			if(event.end){
				end = event.end.format('YYYY-MM-DD HH:mm:ss');
			}else{
				end = start;
			}
			
			id =  event.id;
			
			Event = [];
			Event[0] = id;
			Event[1] = start;
			Event[2] = end;
			
			$.ajax({
			 url: 'calendar_action/employeeshoilday_edit.php',
			 type: "POST",
			 data: {Event:Event},
			 success: function(rep) {
					if(rep == 'Success'){
						alert('Saved');
					}else{
						alert('Could not be saved. try again.'); 
					}
				}
			});
    }

});
</script>

<script type="text/javascript">
		
		
		var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "none", {validateOn:["blur"], hint:"請輸入中文全名"});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "cellphone_taiwan", {validateOn:["blur"]});

		  </script>
