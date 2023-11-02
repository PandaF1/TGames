<?php
session_start();
   include ("dbconnect.php");
    $Us = mysql_query("SELECT * FROM `users` WHERE `id_user`='".$_SESSION['id_user']."'");
    $User = mysql_fetch_array($Us);
    
    $Lf_first = $User['mlife']/$User['life']*100;$Lf_second = ($User['life']-$User['mlife'])/$User['life']*100;
                // Проверяем, пусты ли переменные логина и id пользователя
                if ($_SESSION['side'] == 'Light') echo"     <span style=>Игрок: {$_SESSION['login']}[{$User['lvl']}]</span>
                                                            <span style=>Сторона: {$_SESSION['side']}</span>
                                                            <span style=>Деньги: {$User['money']}</span>";
                
                else echo"     <span style='color:dark;'>Игрок: {$_SESSION['login']}[{$User['lvl']}]</span>
                               <span style='color:dark;'>Сторона: {$_SESSION['side']}</span>
                               <span style='color:blue;'>Деньги: {$User['money']}</span>";
?>
