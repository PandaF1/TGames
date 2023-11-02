<?php 
session_start();
   include ("dbconnect.php");
	 $Us = mysql_query("SELECT * FROM `users` WHERE `id_user`='".$_SESSION['id_user']."'");
     $User = mysql_fetch_array($Us);
     
     $Health = $User['life']/100*0.5;
     $Test1 = $User['mlife'] + $Health;
     if($Test1 < $User['life']) mysql_query("UPDATE `users` SET `mlife` = `mlife` + ('".$Health."') WHERE `id_user`='".$_SESSION['id_user']."'");
     	else mysql_query("UPDATE `users` SET `mlife` = '".$User['life']."' WHERE `id_user`='".$_SESSION['id_user']."'");
?>