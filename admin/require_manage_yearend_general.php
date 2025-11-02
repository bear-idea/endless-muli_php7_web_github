<?php require_once('../Connections/DB_Conn.php'); ?>
<?php require_once('upload_get_admin.php'); ?>
<?php require_once("../inc/inc_function.php"); ?>
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

$maxRows_RecordYearend = 15;
$pageNum_RecordYearend = 0;
if (isset($_GET['pageNum_RecordYearend'])) {
  $pageNum_RecordYearend = $_GET['pageNum_RecordYearend'];
}
$startRow_RecordYearend = $pageNum_RecordYearend * $maxRows_RecordYearend;

$collang_RecordYearend = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordYearend = $_GET['lang'];
}
$coluserid_RecordYearend = "-1";
if (isset($w_userid)) {
  $coluserid_RecordYearend = $w_userid;
}
$colname_RecordYearend = "%";
if (isset($_GET['searchkey'])) {
  $colname_RecordYearend = $_GET['searchkey'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordYearend = sprintf("SELECT * FROM salary_yearend WHERE name LIKE %s && lang = %s && userid=%s GROUP BY particularyear ORDER BY id DESC", GetSQLValueString("%" . $colname_RecordYearend . "%", "text"),GetSQLValueString($collang_RecordYearend, "text"),GetSQLValueString($coluserid_RecordYearend, "int"));
$RecordYearend = mysqli_query($DB_Conn, $query_RecordYearend) or die(mysqli_error($DB_Conn));
$row_RecordYearend = mysqli_fetch_assoc($RecordYearend);
$totalRows_RecordYearend = mysqli_num_rows($RecordYearend);

do{
	$Arr_particularyear[] = $row_RecordYearend['particularyear'];
} while ($row_RecordYearend = mysqli_fetch_assoc($RecordYearend));

if ((isset($_POST["MM_Gen"])) && ($_POST["MM_Gen"] == "form_Yearend_Gen")) {
	/* 取得所有員工資料 */
	$coluserid_RecordStaff = "-1";
	if (isset($w_userid)) {
	  $coluserid_RecordStaff = $w_userid;
	}
	//mysqli_select_db($database_DB_Conn, $DB_Conn);
	$query_RecordStaff = sprintf("SELECT * FROM salary_staff WHERE userid=%s",GetSQLValueString($coluserid_RecordStaff, "int"));
	$RecordStaff = mysqli_query($DB_Conn, $query_RecordStaff) or die(mysqli_error($DB_Conn));
	$row_RecordStaff = mysqli_fetch_assoc($RecordStaff);
	$totalRows_RecordStaff = mysqli_num_rows($RecordStaff);
	
	if($totalRows_RecordStaff > 0) {
	do {
		
		$dt_nowdate = new DateTime();
		$dt_arrivaldate = new DateTime($row_RecordStaff['arrivaldate']);
		$dt_leavedate = new DateTime($row_RecordStaff['leavedate']);
		$dt_yearstartdate = new DateTime($_POST['particularyear'] . "-01-01");
		$dt_yearenddate = new DateTime($_POST['particularyear']+1 . "-01-01"); /* 須由12/21 改成 隔年 1/1 */

		/* 比較就職日期是否等於產生年度範圍 */
		if($_POST['particularyear'] == $dt_arrivaldate->format('Y')) /* 2019 = 2019 */
		{
			// 今年就職(須判斷今年幾月就職) 
			if($row_RecordStaff['leavedate'] != ""){
				if($_POST['particularyear'] == $dt_leavedate->format('Y'))
				{
					/* 此年任職 */
					/* 於今年離職(須判斷今年幾月離職) */
					/* 離職日 - 就職日 */
					$dt_interval_this = $dt_arrivaldate->diff($dt_leavedate);
					//echo "任職天數(今年離職)(離職日 - 就職日)=" . $dt_interval_this->format('%y') . "年" . $dt_interval_this->format('%m') . "個月" . $dt_interval_this->format('%d') . "天";
					//echo "<br>";
					$row_RecordStaff['yearworkday'] = $dt_interval_this->format('%y') . "年" . $dt_interval_this->format('%m') . "個月" . $dt_interval_this->format('%d') . "天";
					
					 /* ------  剩於日數是否需要判斷 ------ */
					 if($row_RecordStaff['dayruletype'] == "1") {
						   if($dt_interval_this->format('%d') >= 15 && $dt_interval_this->format('%d') < 30)
						   {
							   $addmonth = 0.5;
						   }
						   if($dt_interval_this->format('%d') >= 30)
						   {
							   $addmonth = 1;
						   }
					  }
					  if($row_RecordStaff['dayruletype'] == "2") {
						   if($dt_interval_this->format('%d') >= 15)
						   {
							   $addmonth = 0.5;
						   }
					  }
					  if($row_RecordStaff['dayruletype'] == "3") {
						   if($dt_interval_this->format('%d') >= 15)
						   {
							   $addmonth = 1;
						   }
					  }
					 /* ------  剩於日數是否需要判斷 ------ */	
					
					$dt_interval = $dt_arrivaldate->diff($dt_leavedate);
					
					//echo "總年資(今年離職)=" . $dt_interval->format('%y') . "年" . $dt_interval->format('%m') . "個月" . $dt_interval->format('%d') . "天";
					//echo "<br>";
					$row_RecordStaff['totolworkday'] = $dt_interval->format('%y') . "年" . $dt_interval->format('%m') . "個月" . $dt_interval->format('%d') . "天";
					
					switch($row_RecordStaff['bonusYearendtype'])
					{
						case "0":
						// 無
							$endyearprice = 0;
							break;
						case "1":
						// 固定年終
							$endyearprice = $row_RecordStaff["bonusYearendprice"];
							break;
						case "2":
						// 月薪 
						if($dt_interval_this->format('%y') == 1) {
							$endyearprice = $row_RecordStaff["monthprice"] * $row_RecordStaff["bonusYearendparameter1"] * (12/12);
						}else{
							$endyearprice = $row_RecordStaff["monthprice"] * $row_RecordStaff["bonusYearendparameter1"] * (($dt_interval_this->format('%m')+$addmonth)/12);
						}
							break;
						case "3":
						// 月薪
						if($dt_interval_this->format('%y') == 1) {
							$endyearprice = $row_RecordStaff["bonusYearendpricebasic"] * $row_RecordStaff["bonusYearendparameter2"] * (12/12);
						}else{
							$endyearprice = $row_RecordStaff["bonusYearendpricebasic"] * $row_RecordStaff["bonusYearendparameter2"] * ($dt_interval_this->format('%m')/12);
						}
							break;
						default:
							break;
					}
					
					//echo "年終=" . $endyearprice;
					
				}else if ($_POST['particularyear'] < $dt_leavedate->format('Y')){
					// 今年就職(須判斷今年幾月就職)
					/* 今年未離職(計算至12月) */
					/* 12 - 就職日 */
					$dt_interval_this = $dt_arrivaldate->diff($dt_yearenddate);
					//echo "任職天數(未來離職)(12 - 就職日)=" . $dt_interval_this->format('%y') . "年" . $dt_interval_this->format('%m') . "個月" . $dt_interval_this->format('%d') . "天";
					//echo "<br>";
					$row_RecordStaff['yearworkday'] = $dt_interval_this->format('%y') . "年" . $dt_interval_this->format('%m') . "個月" . $dt_interval_this->format('%d') . "天";
					
					/* ------  剩於日數是否需要判斷 ------ */
					 if($row_RecordStaff['dayruletype'] == "1") {
						   if($dt_interval_this->format('%d') >= 15 && $dt_interval_this->format('%d') < 30)
						   {
							   $addmonth = 0.5;
						   }
						   if($dt_interval_this->format('%d') >= 30)
						   {
							   $addmonth = 1;
						   }
					  }
					  if($row_RecordStaff['dayruletype'] == "2") {
						   if($dt_interval_this->format('%d') >= 15)
						   {
							   $addmonth = 0.5;
						   }
					  }
					  if($row_RecordStaff['dayruletype'] == "3") {
						   if($dt_interval_this->format('%d') >= 15)
						   {
							   $addmonth = 1;
						   }
					  }
					 /* ------  剩於日數是否需要判斷 ------ */	
					 
					
					$dt_interval = $dt_arrivaldate->diff($dt_yearenddate);
					
					//echo "總年資(未來離職)=" . $dt_interval->format('%y') . "年" . $dt_interval->format('%m') . "個月" . $dt_interval->format('%d') . "天";
					//echo "<br>";
					$row_RecordStaff['totolworkday'] = $dt_interval->format('%y') . "年" . $dt_interval->format('%m') . "個月" . $dt_interval->format('%d') . "天";
					
					switch($row_RecordStaff['bonusYearendtype'])
					{
						case "0":
						// 無
							$endyearprice = 0;
							break;
						case "1":
						// 固定年終
							$endyearprice = $row_RecordStaff["bonusYearendprice"];
							break;
						case "2":
						// 月薪
						if($dt_interval_this->format('%y') == 1) {
							$endyearprice = $row_RecordStaff["monthprice"] * $row_RecordStaff["bonusYearendparameter1"] * (12/12);
						}else{
							$endyearprice = $row_RecordStaff["monthprice"] * $row_RecordStaff["bonusYearendparameter1"] * ((12-$dt_interval_this->format('%m')+$addmonth)/12);
						}
							break;
						case "3":
						// 月薪
						if($dt_interval_this->format('%y') == 1) {
							$endyearprice = $row_RecordStaff["bonusYearendpricebasic"] * $row_RecordStaff["bonusYearendparameter2"] * (12/12);
						}else{
							$endyearprice = $row_RecordStaff["bonusYearendpricebasic"] * $row_RecordStaff["bonusYearendparameter2"] * ((12-$dt_interval_this->format('%m')+$addmonth)/12);
						}
							break;
						default:
							break;
					}
					
					//echo "年終=" . $endyearprice;
				}
			}else{
				// 未設定離職日
				/* 今年未離職(計算至12月) */
				/* 12 - 就職日 */
				$dt_interval_this = $dt_arrivaldate->diff($dt_yearenddate);	
				//echo "任職天數(在值員工)(12 - 就職日)=" . $dt_interval_this->format('%y') . "年" . $dt_interval_this->format('%m') . "個月" . $dt_interval_this->format('%d') . "天";
				//echo "<br>";
				$row_RecordStaff['yearworkday'] = $dt_interval_this->format('%y') . "年" . $dt_interval_this->format('%m') . "個月" . $dt_interval_this->format('%d') . "天";
				
				/* ------  剩於日數是否需要判斷 ------ */
					 if($row_RecordStaff['dayruletype'] == "1") {
						   if($dt_interval_this->format('%d') >= 15 && $dt_interval_this->format('%d') < 30)
						   {
							   $addmonth = 0.5;
						   }
						   if($dt_interval_this->format('%d') >= 30)
						   {
							   $addmonth = 1;
						   }
					  }
					  if($row_RecordStaff['dayruletype'] == "2") {
						   if($dt_interval_this->format('%d') >= 15)
						   {
							   $addmonth = 0.5;
						   }
					  }
					  if($row_RecordStaff['dayruletype'] == "3") {
						   if($dt_interval_this->format('%d') >= 15)
						   {
							   $addmonth = 1;
						   }
					  }
					 /* ------  剩於日數是否需要判斷 ------ */	
				
				$dt_interval = $dt_arrivaldate->diff($dt_yearenddate);
					
				//echo "總年資(在值員工)=" . $dt_interval->format('%y') . "年" . $dt_interval->format('%m') . "個月" . $dt_interval->format('%d') . "天";
				//echo "<br>";
				$row_RecordStaff['totolworkday'] = $dt_interval->format('%y') . "年" . $dt_interval->format('%m') . "個月" . $dt_interval->format('%d') . "天";
				
				switch($row_RecordStaff['bonusYearendtype'])
				{
					case "0":
					// 無
						$endyearprice = 0;
						break;
					case "1":
					// 固定年終
						$endyearprice = $row_RecordStaff["bonusYearendprice"];
						break;
					case "2":
					// 月薪 
					if($dt_interval_this->format('%y') == 1) {
						$endyearprice = $row_RecordStaff["monthprice"] * $row_RecordStaff["bonusYearendparameter1"] * (12/12);
					}else{
						$endyearprice = $row_RecordStaff["monthprice"] * $row_RecordStaff["bonusYearendparameter1"] * (($dt_interval_this->format('%m')+$addmonth)/12);
					}
						break;
					case "3":
					// 月薪
					if($dt_interval_this->format('%y') == 1) {
						$endyearprice = $row_RecordStaff["bonusYearendpricebasic"] * $row_RecordStaff["bonusYearendparameter2"] * (12/12); 
					}else{
						$endyearprice = $row_RecordStaff["bonusYearendpricebasic"] * $row_RecordStaff["bonusYearendparameter2"] * (($dt_interval_this->format('%m')+$addmonth)/12);
					}
						break;
					default:
						break;
				}
				
				echo "年終=" . $endyearprice;
			}
		}else if ($_POST['particularyear'] > $dt_arrivaldate->format('Y')){ /* 2019 > 2018 */
			/* 比較離職日期是否位於產生年度範圍 */
			// 之前年度就職(須判斷是否離職) 
			if($row_RecordStaff['leavedate'] != ""){
				if($_POST['particularyear'] == $dt_leavedate->format('Y')) /* 2019 = 2019 */
				{
					/* 於今年離職 */
					/* 離職日 - 0 */
					$dt_interval_this = $dt_yearstartdate->diff($dt_leavedate);
					//echo "任職天數(今年離職)(離職日 - 0)=" . $dt_interval_this->format('%y') . "年" . $dt_interval_this->format('%m') . "個月" . $dt_interval_this->format('%d') . "天";
					//echo "<br>";
					$row_RecordStaff['yearworkday'] = $dt_interval_this->format('%y') . "年" . $dt_interval_this->format('%m') . "個月" . $dt_interval_this->format('%d') . "天";
					
					/* ------  剩於日數是否需要判斷 ------ */
					 if($row_RecordStaff['dayruletype'] == "1") {
						   if($dt_interval_this->format('%d') >= 15 && $dt_interval_this->format('%d') < 30)
						   {
							   $addmonth = 0.5;
						   }
						   if($dt_interval_this->format('%d') >= 30)
						   {
							   $addmonth = 1;
						   }
					  }
					  if($row_RecordStaff['dayruletype'] == "2") {
						   if($dt_interval_this->format('%d') >= 15)
						   {
							   $addmonth = 0.5;
						   }
					  }
					  if($row_RecordStaff['dayruletype'] == "3") {
						   if($dt_interval_this->format('%d') >= 15)
						   {
							   $addmonth = 1;
						   }
					  }
					 /* ------  剩於日數是否需要判斷 ------ */	
					
					$dt_interval = $dt_arrivaldate->diff($dt_leavedate);
					
					//echo "總年資(今年離職)=" . $dt_interval->format('%y') . "年" . $dt_interval->format('%m') . "個月" . $dt_interval->format('%d') . "天";
					//echo "<br>";
					$row_RecordStaff['totolworkday'] = $dt_interval->format('%y') . "年" . $dt_interval->format('%m') . "個月" . $dt_interval->format('%d') . "天";
					
					switch($row_RecordStaff['bonusYearendtype'])
					{
						case "0":
						// 無
							$endyearprice = 0;
							break;
						case "1":
						// 固定年終
							$endyearprice = $row_RecordStaff["bonusYearendprice"];
							break;
						case "2":
						// 月薪
						if($dt_interval_this->format('%y') == 1) {
							$endyearprice = $row_RecordStaff["monthprice"] * $row_RecordStaff["bonusYearendparameter1"] * (12/12);
						}else{ 
							$endyearprice = $row_RecordStaff["monthprice"] * $row_RecordStaff["bonusYearendparameter1"] * (($dt_interval_this->format('%m')+$addmonth)/12);
						}
							break;
						case "3":
						// 月薪
						if($dt_interval_this->format('%y') == 1) {
							$endyearprice = $row_RecordStaff["bonusYearendpricebasic"] * $row_RecordStaff["bonusYearendparameter2"] * (12/12);
						}else{
							$endyearprice = $row_RecordStaff["bonusYearendpricebasic"] * $row_RecordStaff["bonusYearendparameter2"] * (($dt_interval_this->format('%m')+$addmonth)/12);
						}
							break;
						default:
							break;
					}
					
					//echo "年終=" . $endyearprice;
					
				}else if ($_POST['particularyear'] < $dt_leavedate->format('Y')){
					/* 今年未離職 */
					/* 整年都在 */
					$dt_interval_this = $dt_yearstartdate->diff($dt_yearenddate);
					//echo "任職天數(未來離職)(12)=" . $dt_interval_this->format('%y') . "年" . $dt_interval_this->format('%m') . "個月" . $dt_interval_this->format('%d') . "天";
					//echo "<br>";
					$row_RecordStaff['yearworkday'] = $dt_interval_this->format('%y') . "年" . $dt_interval_this->format('%m') . "個月" . $dt_interval_this->format('%d') . "天";
					
					/* ------  剩於日數是否需要判斷 ------ */
					 if($row_RecordStaff['dayruletype'] == "1") {
						   if($dt_interval_this->format('%d') >= 15 && $dt_interval_this->format('%d') < 30)
						   {
							   $addmonth = 0.5;
						   }
						   if($dt_interval_this->format('%d') >= 30)
						   {
							   $addmonth = 1;
						   }
					  }
					  if($row_RecordStaff['dayruletype'] == "2") {
						   if($dt_interval_this->format('%d') >= 15)
						   {
							   $addmonth = 0.5;
						   }
					  }
					  if($row_RecordStaff['dayruletype'] == "3") {
						   if($dt_interval_this->format('%d') >= 15)
						   {
							   $addmonth = 1;
						   }
					  }
					 /* ------  剩於日數是否需要判斷 ------ */	
					
					$dt_interval = $dt_arrivaldate->diff($dt_yearenddate);
					
					//echo "總年資(未來離職)=" . $dt_interval->format('%y') . "年" . $dt_interval->format('%m') . "個月" . $dt_interval->format('%d') . "天";
					//echo "<br>";
					$row_RecordStaff['totolworkday'] = $dt_interval->format('%y') . "年" . $dt_interval->format('%m') . "個月" . $dt_interval->format('%d') . "天";
					
					switch($row_RecordStaff['bonusYearendtype'])
					{
						case "0":
						// 無
							$endyearprice = 0;
							break;
						case "1":
						// 固定年終
							$endyearprice = $row_RecordStaff["bonusYearendprice"];
							break;
						case "2":
						// 月薪 
							$endyearprice = $row_RecordStaff["monthprice"] * $row_RecordStaff["bonusYearendparameter1"] * (12/12);
							break;
						case "3":
						// 月薪
							$endyearprice = $row_RecordStaff["bonusYearendpricebasic"] * $row_RecordStaff["bonusYearendparameter2"] * (12/12);
							break;
						default:
							break;
					}
					
					//echo "年終=" . $endyearprice;
				}
			}else{
				/* 整年都在 */
				$dt_interval_this = $dt_yearstartdate->diff($dt_yearenddate);
				//echo "任職天數(在值員工)(12)=" . $dt_interval_this->format('%y') . "年" . $dt_interval_this->format('%m') . "個月" . $dt_interval_this->format('%d') . "天";
				//echo "<br>";
				$row_RecordStaff['yearworkday'] = $dt_interval_this->format('%y') . "年" . $dt_interval_this->format('%m') . "個月" . $dt_interval_this->format('%d') . "天";
				
				/* ------  剩於日數是否需要判斷 ------ */
					 if($row_RecordStaff['dayruletype'] == "1") {
						   if($dt_interval_this->format('%d') >= 15 && $dt_interval_this->format('%d') < 30)
						   {
							   $addmonth = 0.5;
						   }
						   if($dt_interval_this->format('%d') >= 30)
						   {
							   $addmonth = 1;
						   }
					  }
					  if($row_RecordStaff['dayruletype'] == "2") {
						   if($dt_interval_this->format('%d') >= 15)
						   {
							   $addmonth = 0.5;
						   }
					  }
					  if($row_RecordStaff['dayruletype'] == "3") {
						   if($dt_interval_this->format('%d') >= 15)
						   {
							   $addmonth = 1;
						   }
					  }
					 /* ------  剩於日數是否需要判斷 ------ */	
				
				$dt_interval = $dt_arrivaldate->diff($dt_yearenddate);
					
				//echo "總年資(在值員工)=" . $dt_interval->format('%y') . "年" . $dt_interval->format('%m') . "個月" . $dt_interval->format('%d') . "天";
				//echo "<br>";
				$row_RecordStaff['totolworkday'] = $dt_interval->format('%y') . "年" . $dt_interval->format('%m') . "個月" . $dt_interval->format('%d') . "天";
				
				switch($row_RecordStaff['bonusYearendtype'])
				{
					case "0":
					// 無
						$endyearprice = 0;
						break;
					case "1":
					// 固定年終
						$endyearprice = $row_RecordStaff["bonusYearendprice"];
						break;
					case "2":
					// 月薪 
						$endyearprice = $row_RecordStaff["monthprice"] * $row_RecordStaff["bonusYearendparameter1"] * (12/12);
						break;
					case "3":
					// 月薪
						$endyearprice = $row_RecordStaff["bonusYearendpricebasic"] * $row_RecordStaff["bonusYearendparameter2"] * (12/12);
						break;
					default:
						break;
				}
				
				//echo "年終=" . $endyearprice;
			}
		}
		
		/* ------  剩於日數是否需要判斷 ------ */
		 if($row_RecordStaff['dayruletype'] == "1") {
			   if($dt_interval->format('%d') >= 15 && $dt_interval_this->format('%d') < 30)
			   {
				   $addmonth = 0.5;
			   }
			   if($dt_interval->format('%d') >= 30)
			   {
				   $addmonth = 1;
			   }
		  }
		  if($row_RecordStaff['dayruletype'] == "2") {
			   if($dt_interval->format('%d') >= 15)
			   {
				   $addmonth = 0.5;
			   }
		  }
		  if($row_RecordStaff['dayruletype'] == "3") {
			   if($dt_interval->format('%d') >= 15)
			   {
				   $addmonth = 1;
			   }
		  }
		 /* ------  剩於日數是否需要判斷 ------ */	
		
		
		if($row_RecordStaff['bonusspecialindicate'] == "0")
		{
			switch($row_RecordStaff['bonusspecialtype'])
				{
					case "0":
					// 無
						$endyearprice += 0;
						break;
					case "1":
					// 固定年終
						$endyearprice += $row_RecordStaff["bonusspecialprice"];
						break;
					case "2":
					// 月 * 金額 
					if($dt_interval->format('%y') == 1) {
						$totolworkmonth = $dt_interval->format('%y')*12 + $dt_interval->format('%m') + $addmonth;
						$endyearprice += $totolworkmonth * $row_RecordStaff["bonusYearendparameterprice"];
					}else{
						$endyearprice += ($dt_interval->format('%m')+$addmonth ) * $row_RecordStaff["bonusYearendparameterprice"];
					}
						break;
					default:
						break;
				}
		}
		
		$Check_Year = explode("年",$row_RecordStaff['totolworkday']);
		$Check_Month = explode("個月",$Check_Year[1]);
		
		if($row_RecordStaff['bonusspecialindicate'] == "1" && $Check_Year[0] > 0 && $row_RecordStaff['totolworkday'] != "")
		{
			switch($row_RecordStaff['bonusspecialtype'])
				{
					case "0":
					// 無
						$endyearprice += 0;
						break;
					case "1":
					// 固定年終
						$endyearprice += $row_RecordStaff["bonusspecialprice"];
						break;
					case "2":
					// 月 * 金額
					if($dt_interval->format('%y') >= 1) {
						$totolworkmonth = $dt_interval->format('%y')*12 + $dt_interval->format('%m') + $addmonth;
						$endyearprice += $totolworkmonth * $row_RecordStaff["bonusYearendparameterprice"];
					}else{
						$endyearprice += ($dt_interval->format('%m')+$addmonth ) * $row_RecordStaff["bonusYearendparameterprice"];
					}
						break;
					default:
						break;
				}
		}
		
		
		// 低於三個月 無年終
		if($Check_Year[0] == 0 && $row_RecordStaff['totolworkday'] != "" && $Check_Month[0] < 3)
		{
			//echo $row_RecordStaff['totolworkday'];
			$endyearprice = 0;
			//echo $Check_Year[0];
		}
		
		if($row_RecordStaff['totolworkday'] != "") {
		
		$insertSQLYearend = sprintf("INSERT INTO salary_yearend (code, name, job, department, particularyear, arrivaldate, leavedate, yearworkday, totolworkday, endyearprice, lang, userid) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
	                   GetSQLValueString($row_RecordStaff['code'], "text"),
					   GetSQLValueString($row_RecordStaff['name'], "text"),
					   GetSQLValueString($row_RecordStaff['job'], "text"),
					   GetSQLValueString($row_RecordStaff['department'], "text"),
					   GetSQLValueString($_POST['particularyear'], "text"),
					   GetSQLValueString($row_RecordStaff['arrivaldate'], "date"),
					   GetSQLValueString($row_RecordStaff['leavedate'], "date"),
					   GetSQLValueString($row_RecordStaff['yearworkday'], "text"),
					   GetSQLValueString($row_RecordStaff['totolworkday'], "text"),
					   GetSQLValueString($endyearprice, "text"),
					   GetSQLValueString($_SESSION['lang'], "text"),
                       GetSQLValueString($w_userid, "int"));

	  //mysqli_select_db($database_DB_Conn, $DB_Conn);
	  $ResultYearend = mysqli_query($DB_Conn, $insertSQLYearend) or die(mysqli_error($DB_Conn));
	  
	  }
			
	} while ($row_RecordStaff = mysqli_fetch_assoc($RecordStaff));
	}
	
  $_SESSION['DB_Add'] = "Success";

  $insertGoTo = "manage_yearend.php?wshop=" . $_GET['wshop']. "&Opt=viewpage&lang=" . $_SESSION['lang'];
  //$insertGoTo = "tmp_manage_banner.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!-- ================== BEGIN Datatables CSS ================== -->
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Responsive/css/responsive.dataTables.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap4.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/media/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/RowReorder/css/rowReorder.dataTables.min.css" rel="stylesheet" />
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Select/css/select.bootstrap.min.css" rel="stylesheet" />
<!--<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap4.min.css" rel="stylesheet" />-->
<!-- ================== END Datatables CSS ================== -->

<!-- ================== BEGIN X-Editable CSS ================== -->
<link href="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap3-editable/css/bootstrap4-editable.min.css" rel="stylesheet" />
<!-- ================== END X-Editable CSS ================== -->

<!-- ================== BEGIN Datatables JS ================== -->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/media/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Responsive/js/responsive.bootstrap4.min.js"></script>
<!--<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Select/js/dataTables.select.min.js"></script>-->
<!--<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/jszip.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/pdfmake.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js"></script>
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js"></script>-->
<!--<script src="//cdn.datatables.net/plug-ins/1.10.16/api/fnFilterClear.js"></script>-->
<!-- ================== END Datatables JS ================== -->

<!-- ================== BEGIN X-Editable JS ================== -->
<script src="<?php if($SiteBaseUrlOuter != "") { echo $SiteBaseUrlOuter . $SiteBaseAdminPath; } else { echo $SiteBaseUrl . $SiteBaseAdminPath; } ?>assets/plugins/bootstrap3-editable/js/bootstrap4-editable.min.js"></script>
<!-- ================== END X-Editable JS ================== -->

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 年終獎金 <small>產生</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <div class="btn-group pull-right"><a href="javascript:void(0);" onclick="startIntro();" data-original-title="教學導引 Step By Step" data-toggle="tooltip" data-placement="top" id="startButton" class="btn btn-default btn-sm"><i class="far fa-comment-alt fa-fw"></i> 導覽</a></div>
    <h4 class="panel-title"><i class="fa fa-database"></i> 資料一覽</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body">
  
    <div class="alert alert-warning m-t-5"><i class="fa fa-info-circle"></i> <b>年終獎金報表建立時，請確認員工名冊之各人員年終設定是否完整，將以目前資料及時產生報表。</b></div>
    
    <?php //if ($totalRows_RecordYearend == 0) { // Show if recordset not empty ?>
     <form action="<?php echo $editFormAction; ?>" class="form-horizontal form-bordered m-t-0" data-parsley-validate="" method="post"  name="Yearend_Gen" id="Yearend_Gen">
     
     <div class="form-group row">
        <label class="col-md-2 col-form-label">選擇產生年份<span class="text-red">*</span></label>
          <div class="col-md-10">
                 
                    <select name="particularyear" id="particularyear" class="form-control" data-parsley-trigger="blur" required="">
                		<option value="" >-- 選擇產生年份 --</option>
                        <?php 
						$dt = new DateTime(); $dt->format('Y');
						for($y=$dt->format('Y')-2; $y <= $dt->format('Y')+1; $y++) {
						?>
                		<option value="<?php echo $y; ?>" <?php if (in_array($y, $Arr_particularyear)) {echo "disabled='disabled'";} ?>><?php echo $y; ?><?php if (in_array($y, $Arr_particularyear)) {echo "  已建立";} ?></option>
                        <?php 
						}
						?>

				    </select>     
          </div>
      </div>
     <input name="MM_Gen" type="hidden" id="MM_Gen" value="form_Yearend_Gen" />
     <input name="Opt" type="hidden" id="Opt" value="viewpage" />
     <button type="submit" class="btn btn btn-primary btn-block">建立報表</button>
     </form>
    <?php //} ?>
    
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel --> 

<?php
mysqli_free_result($RecordYearend);
?>
