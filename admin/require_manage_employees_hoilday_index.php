<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php require_once('upload_get_admin.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_Employeeshoilday")) {
  $insertSQL = sprintf("INSERT INTO demo_employeeshoilday (title, startdate, enddate, indicate, notes1, lang, aid, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['startdate'], "text"),
                       GetSQLValueString($_POST['enddate'], "text"),
                       GetSQLValueString(1, "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
					   GetSQLValueString($_POST['lang'], "text"),
					   GetSQLValueString($_POST['aid'], "int"),
                       GetSQLValueString($_POST['userid'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $insertSQL) or die(mysqli_error($DB_Conn));
  
  //$_SESSION['DB_Add'] = "Success";
 
  $insertGoTo = "inner_Employees.php?Opt=hoildayviewpage&lang=" . $_POST['lang'] . "&aid=" . $_POST['aid'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Employeeshoilday")) {
	
  if($_POST['event-del'] != '1'){
  $updateSQL = sprintf("UPDATE demo_employeeshoilday SET title=%s, startdate=%s, enddate=%s, indicate=%s, notes1=%s, userid=%s WHERE id=%s",
                       GetSQLValueString($_POST['title'], "text"),
                       GetSQLValueString($_POST['startdate'], "text"),
                       GetSQLValueString($_POST['enddate'], "text"),
                       GetSQLValueString(1, "int"),
                       GetSQLValueString($_POST['notes1'], "text"),
					   GetSQLValueString($_POST['userid'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));
  }else{
	
  $deleteSQL = sprintf("DELETE FROM demo_employeeshoilday WHERE id=%s",
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $deleteSQL) or die(mysqli_error($DB_Conn));
  } 
  
  //$_SESSION['DB_Add'] = "Success";
 //echo $_POST['event-del'];
  $updateGoTo = "inner_Employees.php?Opt=hoildayviewpage&lang=" . $_POST['lang'] . "&aid=" . $_POST['aid'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_RecordEmployeeshoilday = "-1";
if (isset($_GET['aid'])) {
  $colname_RecordEmployeeshoilday = $_GET['aid'];
}
$coluserid_RecordEmployeeshoilday = "-1";
if (isset($w_userid)) {
  $coluserid_RecordEmployeeshoilday = $w_userid;
}
$collang_RecordEmployeeshoilday = "zh-tw";
if (isset($_SESSION['lang'])) {
  $collang_RecordEmployeeshoilday = $_SESSION['lang'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordEmployeeshoilday = sprintf("SELECT * FROM demo_employeeshoilday WHERE aid = %s && userid=%s && lang=%s", GetSQLValueString($colname_RecordEmployeeshoilday, "int"),GetSQLValueString($coluserid_RecordEmployeeshoilday, "int"),GetSQLValueString($collang_RecordEmployeeshoilday, "text"));
$RecordEmployeeshoilday = mysqli_query($DB_Conn, $query_RecordEmployeeshoilday) or die(mysqli_error($DB_Conn));
$row_RecordEmployeeshoilday = mysqli_fetch_assoc($RecordEmployeeshoilday);
$totalRows_RecordEmployeeshoilday = mysqli_num_rows($RecordEmployeeshoilday);



?>
<style>
.daterangepicker {z-index:9999999 !important;}
</style>
<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 休假管理 <small>修改</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 修改資料</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
    <div class="p-10 bg-silver-transparent-9">
    <div class="vertical-box">
				<!-- begin event-list -->
				<!--<div class="vertical-box-column p-r-30 d-none d-lg-table-cell" style="width: 215px;">
					<button id="event_delete" type="button" class="btn btn btn-danger btn-block">刪除</button>
					<div id="external-events" class="fc-event-list">
						<h5 class="m-t-0 m-b-15">Draggable Events</h5>
						<div class="fc-event" data-color="#00acac"><div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-success"></i></div> Meeting with Client</div>
						<div class="fc-event" data-color="#348fe2"><div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-primary"></i></div> IOS App Development</div>
						<div class="fc-event" data-color="#f59c1a"><div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-warning"></i></div> Group Discussion</div>
						<div class="fc-event" data-color="#ff5b57"><div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-danger"></i></div> New System Briefing</div>
						<div class="fc-event"><div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-inverse"></i></div> Brainstorming</div>
						<hr class="bg-grey-lighter m-b-15" />
						<h5 class="m-t-0 m-b-15">Other Events</h5>
						<div class="fc-event" data-color="#b6c2c9"><div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-grey"></i></div> Other Event 1</div>
						<div class="fc-event" data-color="#b6c2c9"><div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-grey"></i></div> Other Event 2</div>
						<div class="fc-event" data-color="#b6c2c9"><div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-grey"></i></div> Other Event 3</div>
						<div class="fc-event" data-color="#b6c2c9"><div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-grey"></i></div> Other Event 4</div>
						<div class="fc-event" data-color="#b6c2c9"><div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-grey"></i></div> Other Event 5</div>
					</div>
				</div>-->
				<!-- end event-list -->
				<!-- begin calendar -->
				<div id="calendar" class="vertical-box-column calendar"></div>
				<!-- end calendar -->
			</div>
			<!-- end vertical-box --
    </div>
  
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->


<div class="modal fade" id="ModalAdd">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">新增事件</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                
                <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
                  <div class="form-group row">
                      <label class="col-md-3 col-form-label">行程<span class="text-red">*</span></label>
                      <div class="col-md-9">
                          <input name="title" type="text" required="" class="form-control" id="title" value="休假" data-parsley-trigger="blur" />    
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-3 col-form-label">開始時間<span class="text-red">*</span></label>
                      <div class="col-md-9">
                          <input name="startdate" type="text" class="form-control" id="startdate" data-date-language="zh-TW"  data-parsley-trigger="blur" pattern="/^((\d{2}(([02468][048])|([13579][26]))[\-\/\s]?((((0?[13578])|(1[02]))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[\-\/\s]?((0?[1-9])|([1-2][0-9])))))|(\d{2}(([02468][1235679])|([13579][01345789]))[\-\/\s]?((((0?[13578])|(1[02]))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[\-\/\s]?((0?[1-9])|(1[0-9])|(2[0-8]))))))(\s((([0-1][0-9])|(2?[0-3]))\:([0-5]?[0-9])((\s)|(\:([0-5]?[0-9])))))?$/"/>   
                      </div>
                  </div>
                  <div class="form-group row" >
                      <label class="col-md-3 col-form-label">結束時間<span class="text-red">*</span></label>
                      <div class="col-md-9">
                          <input name="enddate" type="text" class="form-control" id="enddate" data-date-language="zh-TW"  data-parsley-trigger="blur" pattern="/^((\d{2}(([02468][048])|([13579][26]))[\-\/\s]?((((0?[13578])|(1[02]))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[\-\/\s]?((0?[1-9])|([1-2][0-9])))))|(\d{2}(([02468][1235679])|([13579][01345789]))[\-\/\s]?((((0?[13578])|(1[02]))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[\-\/\s]?((0?[1-9])|(1[0-9])|(2[0-8]))))))(\s((([0-1][0-9])|(2?[0-3]))\:([0-5]?[0-9])((\s)|(\:([0-5]?[0-9])))))?$/"/>    
                      </div>
                  </div>
			      <div class="form-group row">
				  <label class="col-md-3 col-form-label"></label>
				  <div class="col-md-9">
					<button type="submit" class="btn btn btn-primary btn-block">送出</button> 
					<input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
					<input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
					<input name="aid" type="hidden" id="aid" value="<?php echo $_GET['aid']; ?>" />
				  </div>
				  </div>
				  <input type="hidden" name="MM_insert" value="form_Employeeshoilday" />
                </form>
                
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade" id="ModalEdit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">修改事件</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                
                <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
                  <div class="form-group row">
                      <label class="col-md-3 col-form-label">行程<span class="text-red">*</span></label>
                      <div class="col-md-9">
                          <input name="title" type="text" required="" class="form-control" id="title" value="休假" data-parsley-trigger="blur" />    
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-3 col-form-label">開始時間<span class="text-red">*</span></label>
                      <div class="col-md-9">
                          <input name="startdate" type="text" class="form-control" id="startdate" data-date-language="zh-TW"  data-parsley-trigger="blur" pattern="/^((\d{2}(([02468][048])|([13579][26]))[\-\/\s]?((((0?[13578])|(1[02]))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[\-\/\s]?((0?[1-9])|([1-2][0-9])))))|(\d{2}(([02468][1235679])|([13579][01345789]))[\-\/\s]?((((0?[13578])|(1[02]))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[\-\/\s]?((0?[1-9])|(1[0-9])|(2[0-8]))))))(\s((([0-1][0-9])|(2?[0-3]))\:([0-5]?[0-9])((\s)|(\:([0-5]?[0-9])))))?$/"/>   
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-3 col-form-label">結束時間<span class="text-red">*</span></label>
                      <div class="col-md-9">
                          <input name="enddate" type="text" class="form-control" id="enddate" data-date-language="zh-TW"  data-parsley-trigger="blur" pattern="/^((\d{2}(([02468][048])|([13579][26]))[\-\/\s]?((((0?[13578])|(1[02]))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[\-\/\s]?((0?[1-9])|([1-2][0-9])))))|(\d{2}(([02468][1235679])|([13579][01345789]))[\-\/\s]?((((0?[13578])|(1[02]))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(3[01])))|(((0?[469])|(11))[\-\/\s]?((0?[1-9])|([1-2][0-9])|(30)))|(0?2[\-\/\s]?((0?[1-9])|(1[0-9])|(2[0-8]))))))(\s((([0-1][0-9])|(2?[0-3]))\:([0-5]?[0-9])((\s)|(\:([0-5]?[0-9])))))?$/"/>  
                      </div>
                  </div>
				  <div class="form-group row">
                      <label class="col-md-3 col-form-label">刪除</label>
                      <div class="col-md-9">
						  <div class="radio radio-css radio-inline">
								<input type="radio" name="event-del" id="event-del_1" value="0" checked />
								<label for="event-del_1">否</label>
							</div>
							<div class="radio radio-css radio-inline">
								<input type="radio" name="event-del" id="event-del_2" value="1" />
								<label for="event-del_2">是</label>
							</div>
                      </div>
                  </div>
			      <div class="form-group row">
				  <label class="col-md-3 col-form-label"></label>
				  <div class="col-md-9">
					<button type="submit" class="btn btn btn-primary btn-block">送出</button> 
					<input name="lang" type="hidden" id="lang" value="<?php echo $_GET['lang']; ?>" />
					<input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
					<input name="aid" type="hidden" id="aid" value="<?php echo $_GET['aid']; ?>" />
					<input name="id" type="hidden" id="id" />
				  </div>
				  </div>
				  <input type="hidden" name="MM_update" value="form_Employeeshoilday" />
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
  
  $('#external-events .fc-event').each(function() {
	
  $(this).data('event', {
      title: $.trim($(this).text()), // use the element's text as the event title
      stick: true, // maintain when user navigates (see docs on the renderEvent method)
      color: ($(this).attr('data-color')) ? $(this).attr('data-color') : ''
  });
  $(this).draggable({
      zIndex: 999,
      revert: true,      // will cause the event to go back to its
      revertDuration: 0  //  original position after the drag
  });
});

	$('#calendar').fullCalendar({
		header: {
			left: 'month,agendaWeek,agendaDay, listWeek',
			center: 'title',
			right: 'prev,today,next '
    },
    droppable: true, // this allows things to be dropped onto the calendar
    drop: function (date) {

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
  },
			businessHours: {
			  dow: [ 1, 2, 3, 4, 5 ],

			  start: '8:00',
			  end: '17:00',
			},
			scrollTime: '08:00:00',
			editable: true,
			navLinks: true,
			eventLimit: true, // allow "more" link when there are too many events
			selectable: true,
			selectHelper: true,
		select: function( startDate, endDate, allDay, jsEvent, view ){
			//var start =$.fullCalendar.formatDate(startDate,'yyyy-MM-dd');
			//console.log(moment(endDate).add(-1, 'days').format('YYYY-MM-DD'));
			$('#ModalAdd #startdate').val(moment(startDate).format('YYYY-MM-DD HH:mm:ss'));
            $('#ModalAdd #enddate').val(moment(endDate).add(0, 'days').format('YYYY-MM-DD HH:mm:ss'));
			$('#ModalAdd').modal('show');
    },
		displayEventTime : false,
		events: [
			<?php 
			if($totalRows_RecordEmployeeshoilday > 0) {
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
                }
        
			?>
			{
						'id' : '<?php echo $row_RecordEmployeeshoilday['id']; ?>',
						'title' : '<?php echo $row_RecordEmployeeshoilday['title']; ?>',
						'start': '<?php echo $start; ?>',
						'end': '<?php echo $end; ?>',
						'url' : '',
						'allDay' : '',
						'color' : ''
			},
			<?php 
				} while ($row_RecordEmployeeshoilday = mysqli_fetch_assoc($RecordEmployeeshoilday));
			}
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
$(document).ready(function() {
  $('#ModalAdd #startdate, #ModalAdd #enddate,#ModalEdit #startdate, #ModalEdit #enddate').datetimepicker({
    format : 'YYYY-MM-DD HH:mm:ss', //控件中from和to 显示的日期格式
  });
});

  </script>
