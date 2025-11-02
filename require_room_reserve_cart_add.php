<?php
	if (!isset($_SESSION)) {
  		session_start();
	}
	foreach($_SESSION['Room_Cart_' . $_GET['wshop']] as $i => $val){
		unset ($_SESSION['Room_Cart_' . $_GET['wshop']][$i]);
		unset ($_SESSION['Room_Name'][$i]);
		unset ($_SESSION['Room_RoomPrice'][$i]);
		unset ($_SESSION['Room_RoomNum'][$i]);
		unset ($_SESSION['Room_PeopleNum'][$i]);
		unset ($_SESSION['Room_Date'][$i]);
		unset ($_SESSION['Room_ID'][$i]);
		unset ($_SESSION['Room_Quantity'][$i]);
	}
	        //foreach($_POST['Room_Cart_' . $_GET['wshop']] as $i => $val){
			for($i=0; $i<=$_POST['Room_Count']; $i++) {
				//$_SESSION['Start_Date'][] = $_POST['Start_Date'];
				//$_SESSION['End_Date'][] = $_POST['End_Date'];
				if($_POST['quantity'][$i] == 0) {
				}else{
					$_SESSION['Room_Cart_' . $_GET['wshop']][] = $_POST['id'][$i];
					$_SESSION['Room_Name'][] = $_POST['name'][$i];
					$_SESSION['Room_RoomPrice'][] = $_POST['roomprice'][$i];
					$_SESSION['Room_RoomNum'][] = $_POST['roomnum'][$i];
					$_SESSION['Room_PeopleNum'][] = $_POST['peoplenum'][$i];
					$_SESSION['Room_Date'][] = $_POST['roomdate'][$i];
					$_SESSION['Room_ID'][] = $_POST['roomid'][$i];
					$_SESSION['Room_Quantity'][] = $_POST['quantity'][$i];
				}
			}
			$MM_redirectRoom = $SiteBaseUrl . url_rewrite("room",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'showpage'),'',$UrlWriteEnable);
			
			//header("Location:room.php?wshop=" . $_GET['wshop'] . "&Opt=showpage&tp=Room&lang=" . $_SESSION['lang']);
			
			 echo("<script language='javascript'>location.href='".$MM_redirectRoom."'</script>");
			ob_end_flush(); // 輸出緩衝區結束
?>