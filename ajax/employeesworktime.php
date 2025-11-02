<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once("../inc/inc_function.php"); ?>
<?php
	if (!isset($_SESSION)) {
  		session_start();
	}
?>
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

//$_GET['startdate'] = "2019-10-30";
//$_GET['aid'] = "1";
//$_SESSION['userid'] = "1";
//$_GET['servicetime'] = "70";

if (isset($_GET['startdate'])) {
  $colstartdate_RecordEmployeesStartdate = $_GET['startdate'];
  $colstartdate_RecordEmployeesWeekday = GetWeekDay($_GET['startdate']); /* 取得星期幾 */
  
  $date = new DateTime($_GET['startdate']);
  $NowDate = $date->format('Y-m-d');

  
  switch($colstartdate_RecordEmployeesWeekday)
	{
		case "1":
			$colstartdate_RecordEmployeesWeekday = "Monday";		
			break;
		case "2":
			$colstartdate_RecordEmployeesWeekday = "Tuesday";		
			break;
		case "3":
			$colstartdate_RecordEmployeesWeekday = "Wednesday";				
			break;
		case "4":
			$colstartdate_RecordEmployeesWeekday = "Thursday";				
			break;
		case "5":
			$colstartdate_RecordEmployeesWeekday = "Friday";				
			break;
		case "6":
			$colstartdate_RecordEmployeesWeekday = "Saturday";				
			break;
		case "0":
			$colstartdate_RecordEmployeesWeekday = "Sunday";		
			break;
	}
	
}

if (isset($_GET['enddate'])) {
  $colenddate_RecordEmployeesEnddate = $_GET['enddate'];
}

$colname_RecordEmployeesWorktime = "-1";
if (isset($_GET['aid'])) {
  $colname_RecordEmployeesWorktime = $_GET['aid'];
}
$coluserid_RecordEmployeesWorktime = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordEmployeesWorktime = $_SESSION['userid'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordEmployeesWorktime = sprintf("SELECT * FROM demo_employeesworktime WHERE aid = %s && day=%s && indicate=1 && userid=%s", GetSQLValueString($colname_RecordEmployeesWorktime, "int"),GetSQLValueString($colstartdate_RecordEmployeesWeekday, "text"),GetSQLValueString($coluserid_RecordEmployeesWorktime, "int"));
$RecordEmployeesWorktime = mysqli_query($DB_Conn, $query_RecordEmployeesWorktime) or die(mysqli_error($DB_Conn));
$row_RecordEmployeesWorktime = mysqli_fetch_assoc($RecordEmployeesWorktime);
$totalRows_RecordEmployeesWorktime = mysqli_num_rows($RecordEmployeesWorktime);
  
  

  
//echo json_encode($_POST);
?>

<?php //do { ?>

    <?php 
	
	    //$rangetimeadd = "PT30M";
		//$row_RecordEmployeesWorktime['LunchBreakFrom'];
		$rangetime = $NowDate . " " . $row_RecordEmployeesWorktime['WorkingTimeFrom'];
	
		
		do
		{
			
			//if(($NowDate . " " . $row_RecordEmployeesWorktime['LunchBreakFrom']) > $rangetime)
			//{
				//echo $rangetime;echo "<br>";
				
				//$data['rangetime'] .= $rangetime . "|";
				
				$date2 = new DateTime($rangetime);
				$data['rangetime'] .= "<label class='btn bg-grey-transparent-6 text-white m-5' onclick='EmployeesRangeTimeGet();'><input type='radio' name='rangetime' value='".$date2->format('H:i')."'><div>".$date2->format('H:i')."</div></label>";
				
				
				
				$date = new DateTime($rangetime);
				$date->modify('+'.$_GET['servicetime'].' minutes');
				$rangetime = $date->format('Y-m-d H:i:s'); 
				 
				 
				
				//echo "<br>";
			//}
		}while($NowDate . " " . $row_RecordEmployeesWorktime['LunchBreakFrom'] > $rangetime);
		
		
		
		$rangetime = $NowDate . " " . $row_RecordEmployeesWorktime['LunchBreakTo'];
		
		do
		{
			
			//if(($NowDate . " " . $row_RecordEmployeesWorktime['LunchBreakFrom']) > $rangetime)
			//{
				//echo $rangetime;echo "<br>";
				
				//$data['rangetime'] .= $rangetime . "|";
				
				$date2 = new DateTime($rangetime);
				$data['rangetime'] .= "<label class='btn bg-grey-transparent-6 text-white m-5' onclick='EmployeesRangeTimeGet();'><input type='radio' name='rangetime' value='".$date2->format('H:i')."'><div>".$date2->format('H:i')."</div></label>";
				
				
				
				$date = new DateTime($rangetime);
				$date->modify('+'.$_GET['servicetime'].' minutes');
				$rangetime = $date->format('Y-m-d H:i:s'); 
				 
				 
				
				//echo "<br>";
			//}
		}while($rangetime < $NowDate . " " . $row_RecordEmployeesWorktime['WorkingTimeTo']);
	
	
	/*
	    $data['aid'] = $row_RecordEmployeesWorktime['aid'];
		//$data['rangetime'] = $data2['rangetime'];
		$data['servicetime'] = $_GET['servicetime'];
		$data['WorkingTimeFrom'] = $row_RecordEmployeesWorktime['WorkingTimeFrom'];
		$data['WorkingTimeTo'] = $row_RecordEmployeesWorktime['WorkingTimeTo'];
		$data['LunchBreakFrom'] = $row_RecordEmployeesWorktime['LunchBreakFrom'];
		$data['LunchBreakTo'] = $row_RecordEmployeesWorktime['LunchBreakTo']; 
		*/
	?>
<?php //} while ($row_RecordProductListItem = mysqli_fetch_assoc($RecordProductListItem)); ?>



      <div class="button-group-pills" data-toggle="buttons">
  <?php 
	//echo json_encode($data);
	
	echo $data['rangetime'];
	
	

	//echo "<input class='text-nicelabel' data-nicelabel='{'position_class': 'text_radio', 'checked_text': 'ttttttttttttt', 'unchecked_text': 'tttttttttttt'}' checked type='radio' name='employeesselect' value='ttttttttttttttt' />";
	
	//echo "------------";
?>     
      </div>