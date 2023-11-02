<?php 
   		include ("dbconnect.php");
    	$Server = mysql_fetch_array(mysql_query("SELECT * FROM `server` WHERE `id`=1"));

	  date_default_timezone_set('Europe/Kiev');
	  #---------------------------------------------------------------------
	  $date_today_Year = date("y");
	  $date_today_month = date("m");
	  #$date_today_day = date("d/");
	  #$date_today = $date_today_day.$date_today_month.$date_today_Year;
	  #---------------------------------------------------------------------

	  $day = $Server['day'];
	  $date_today = "".$day."/".$date_today_month."/".$date_today_Year."";


	  #---------------------------------------------------------------------
	  $time_today = date("H:i:s");
	  if(!($date_today==$Server['servertime'])) {mysql_query("UPDATE `server` SET `servertime` = '".$date_today."' WHERE `id`= 1");}
		echo "Дата:".$date_today."<br>";
		echo "Время:".$time_today."";
	?>