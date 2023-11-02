<?php
session_start();
   include ("dbconnect.php");
    $Us = mysql_query("SELECT * FROM `users` WHERE `id_user`='".$_SESSION['id_user']."'");
    $User = mysql_fetch_array($Us);
    
    $Lf_first = $User['mlife']/$User['life']*100;$Lf_second = ($User['life']-$User['mlife'])/$User['life']*100;
                // Проверяем, пусты ли переменные логина и id пользователя
                if ($_SESSION['side'] == 'Light') echo"     <span style='color:blue;'>Игрок: {$_SESSION['login']}[{$User['lvl']}]</span><br>
                                                            <span style='color:blue;'>Сторона: {$_SESSION['side']}</span><br>
                                                            <span style='color:blue;'>Жизни: {$User['mlife']}/{$User['life']}</span><br>
                                                            <div class='meter' style='width:80%; margin-bottom:5px;'><span class='Sspan' id='green' style='width:".$Lf_first."%'></span><span class='Sspan' id='red'style='width:".$Lf_second."%'></span></div>
                                                            <span style='color:blue;'>Деньги: {$User['money']}</span><br>";
                
                else echo"     <span style='color:dark;'>Игрок: {$_SESSION['login']}[{$User['lvl']}]</span><br>
                               <span style='color:dark;'>Сторона: {$_SESSION['side']}</span><br>
                               <span style='color:dark;'>Жизни: {$User['mlife']}/{$User['life']}</span><br>
                               <div class='meter' style='width:80%; margin-bottom:5px;'><span class='Sspan' id='green' style='width:".$Lf_first."%'></span><span class='Sspan' id='red'style='width:".$Lf_second."%'></span></div>
                               <span style='color:dark;'>Деньги: {$User['money']}</span><br>";
?>
