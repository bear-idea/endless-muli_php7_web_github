<?php
	  switch($_GET['Opt'])
	  {
		  case "showpage":
			  $Now_Type_Mobile_Show_Title = $Lang_Title_Cart_Show;	
			  break;
		  case "checkpage":
			  $Now_Type_Mobile_Show_Title = $Lang_Title_Cart_Check;		
			  break;
		  case "purchasepage":
			  $Now_Type_Mobile_Show_Title = $Lang_Title_Cart_Purchase;			
			  break;
		  case "purchasecheckpage":
			  $Now_Type_Mobile_Show_Title = $Lang_Title_Cart_Send;			
			  break;
		  case "payok":
			  $Now_Type_Mobile_Show_Title = $Lang_Title_Cart_Payok;			
			  break;
		  case "paysearch":
		      $Now_Type_Mobile_Show_Title = $Lang_Title_Cart_PaySearch;		
			  break;
		  case "shoppingnotes":
		      $Now_Type_Mobile_Show_Title = $Lang_Title_Cart_Shopping_Notes;		
			  break;
		  case "flow":
		      $Now_Type_Mobile_Show_Title = $Lang_Classify_Shopping_Process_Step_Pay;		
			  break;
		  default:
			  $Now_Type_Mobile_Show_Title = $Lang_Title_Cart_Show;
			  break;
	  }
?>
<?php
$Now_Type_Mobile_Show_skeyword = "";
$Now_Type_Mobile_Show_sdescription = "";

if(isset($Now_Type_Mobile_Show_Title)) {
	$Title_Word = $Now_Type_Mobile_Show_Title . " - " . $ModuleName['Cart'] . " - " . $SiteName;
}else{
	$Title_Word = $ModuleName['Cart'] . " - " . $SiteName;	
}

$Title_Keyword = $SiteKeyWord;

$Title_Desc = $SiteDesc;

?>
