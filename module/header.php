<?php
$read_post = $db->q("SELECT `id` FROM `post` WHERE `p1`='".$_SESSION['user_id']."' AND `read`='1'");
$num_messages = mysql_num_rows($read_post); # Список полученых и непрочтенных сообщений

# Если найдены непрочтенные сообщения, то выводится их количество
if ($num_messages == 0)    $num_messages = '';
else $num_messages = '(<b>'.$num_messages.'</b>)';

# Если есть непрочтенные сообщения и игрок перешел в модуль почты, то отмечаем сообщения прочтенными
if ($num_messages != '' && $a == 'post') {
      $db->q("UPDATE `post` SET `read`='2' WHERE `p1`='".$_SESSION['user_id']."'");
      $num_messages = '';
}
$User = mysql_fetch_array($db->q("SELECT * FROM `users` WHERE `id_user`='".$_SESSION['id_user']."'"));
if (!empty($_POST['exit'])){unset($_SESSION["login"]);unset($_SESSION["id"]);header("Location: Entry.php"); }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>TGame</title>
		<link rel="stylesheet" type="text/css" href="style/CONTENT.css">
        <link rel="stylesheet" type="text/css" href="style/Navigation.css">
        <link rel="stylesheet" type="text/css" href="style/Main.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script type="text/javascript" language="javascript" src="style/script.js"></script> 
	</head>
<body>
<script>
    function time(){
      $.ajax({
        url: '../Ajax/time.php',
        cache: false,
        success: function(html){
          $("#time").html(html);
        }
      });}
    function info(){
      $.ajax({
        url: '../Ajax/info.php',
        cache: false,
        success: function(html){
          $("#info").html(html);
        }
      });}
      function hp(){
      $.ajax({
        url: '../Ajax/hp.php',
        cache: false,
        success: function(html){
          $("#heee").html(html);
        }
      });}
    $(document).ready(function(){
      time(); info(); hp();
      setInterval('time()',1000);
      setInterval('info()',1500);
	  setInterval('hp()',1000);
    });
</script>
<div class="one">
    <div class="main">
        <br>
        <div style="margin-top:-15px;">
            <center>
            <div style="margin-top:-2px;border: 2px solid #CFCFCF;height:33px;">
            <ul class="hr" style="margin-top:7px;">
                <li><a class="box demo-1" href="?a=main">Персонаж</a></li>
                <li><a class="box demo-1" href="?a=battle">Арена</a></li>
                <li><a class="box demo-1" href="?a=../adm/map">Создание Предметов</a></li>
                <li><a class="box demo-1" href="?a=post">Почта <?php echo $num_messages; ?></a></li>
                <li><a class="box demo-1" href="?a=trade">Аукцион</a></li>
                <li><a class="box demo-1" href="?a=shop">Магазин</a></li>
                <li><a class="box demo-1" href="?a=exit">Exit\Reg</a></li>
            </ul>
        </div></center> 
<div id="left">
    <center>
        <div id="hello" class='hello'>
          <div id="time"></div>
          <img src="../Image/Flag.png" width="190" height="124" alt="Flag">
          <div id="info" style="min-height:120px;color:#9FCFB3;"></div><!-- Бок-Панель -->
        </div>
    </center>
</div>