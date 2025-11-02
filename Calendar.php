<meta charset="utf-8">
<?php 
 //This gets today's date 

 $date =time () ; 

 //This puts the day, month, and year in seperate variables 

 $day = date('d', $date) ; 

 $month = date('m', $date) ; 

 $year = date('Y', $date) ;



 //Here we generate the first day of the month 

 $first_day = mktime(0,0,0,$month, 1, $year) ; 



 //This gets us the month name 

 $title = date('F', $first_day) ;

 //Here we find out what day of the week the first day of the month falls on 
 $day_of_week = date('D', $first_day) ; 



 //Once we know what day of the week it falls on, we know how many blank days occure before it. If the first day of the week is a Sunday then it would be zero


 switch($day_of_week){ 

 case "Sun": $blank = 0; break; 

 case "Mon": $blank = 1; break; 

 case "Tue": $blank = 2; break; 

 case "Wed": $blank = 3; break; 

 case "Thu": $blank = 4; break; 

 case "Fri": $blank = 5; break; 

 case "Sat": $blank = 6; break; 

 }



 //We then determine how many days are in the current month

 $days_in_month = cal_days_in_month(0, $month, $year) ; 

 //Here we start building the table heads 

 


 //This counts the days in the week, up to 7

 $day_count = 1;



 

 //first we take care of those blank days

 while ( $blank > 0 ) 

 { 



 $blank = $blank-1; 

 $day_count++;

 } 

 //sets the first day of the month to 1 

 $day_num = 1;



 //count up the days, untill we've done all of them in the month

 while ( $day_num <= $days_in_month ) 

 { 


 $n_week = date("w",mktime(0,0,0,$month,$day_num,$year));
  switch($n_week)
  {
	  case "0":
	  $n_week_cg = "日";
	  break;
	  case "1":
	  $n_week_cg = "一";
	  break;
	  case "2":
	  $n_week_cg = "二";
	  break;
	  case "3":
	  $n_week_cg = "三";
	  break;
	  case "4":
	  $n_week_cg = "四";
	  break;
	  case "5":
	  $n_week_cg = "五";
	  break;
	  case "6":
	  $n_week_cg = "六";
	  break;
  }
 //echo $day_num;
 echo $year . "-" . $month ."-" . substr("0" . $day_num,-2); // 目前此格之日期
 echo "(" . $n_week_cg . ")";

  

 $day_num++; 

 $day_count++;



 //Make sure we start a new row every week

 if ($day_count > 7)

 {



 $day_count = 1;

 }

 } 

 //Finaly we finish out the table with some blank details if needed

 while ( $day_count >1 && $day_count <=7 ) 

 { 



 $day_count++; 

 } 

 

?>



<p>